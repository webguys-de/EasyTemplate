<?php

/**
 * Class Webguys_Easytemplate_Helper_Data
 *
 */
class Webguys_Easytemplate_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Saves template information to database
     *
     * @param $group Webguys_Easytemplate_Model_Group
     */
    public function saveTemplateInformation($group)
    {
        $request = Mage::app()->getRequest();
        $templateData = $request->getPost('template');

        if (is_array($templateData)) {

            // Merge file information of $_FILES to $_POST
            if (isset($_FILES['template']['name']) && is_array($_FILES['template']['name'])) {
                foreach ($_FILES['template']['name'] as $templateId => $data) {
                    if (is_array($data)) {
                        foreach ($data['fields'] as $fieldName => $field) {
                            $templateData[$templateId]['fields'][$fieldName]['value'] = $field;
                        }
                    }
                }
            }

            $group->importData($templateData);
        }

        switch ($request->getParam('easytemplate_publish')) {

            case 'publish':
                if ($group->getCopyOf()) {
                    $mainGroup = Mage::getModel('easytemplate/group');
                    $mainGroup->load($group->getCopyOf());
                    $mainGroup->delete();

                    $group->setCopyOf(null);
                    $group->save();
                }
                break;

            case 'reset':
                $group->delete();
                break;

            case 'clone':
                $group->duplicate();
                break;
        }
    }
}