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

        switch ($request->getParam('easytemplate_action')) {

            case 'upload':

                if (isset($_FILES['template_archive']['name'])) {
                    $file = $_FILES['template_archive']['tmp_name'];

                    $zip = new ZipArchive();
                    $zip->open($file);

                    $data = json_decode($zip->getFromName('data.txt'), true);
                    if ($data) {
                        foreach ($data as $i => $subdata) {
                            $data['new_' . $i] = $data[$i];
                            $data['new_' . $i]['id'] = 'new_' . $data[$i]['id'];

                            if ($data[$i]['parent_id']) {
                                $data['new_' . $i]['parent_id'] = 'new_' . $data[$i]['parent_id'];
                            }

                            unset($data[$i]);
                        }
                    }

                    $fileList = array();
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $fileList[$i] = $zip->getNameIndex($i);
                    }

                    $new2IdMapping = $group->importData($data);

                    $helper = Mage::helper('easytemplate/file');

                    foreach ($new2IdMapping as $importId => $dbId) {
                        $importId = substr($importId, 4); // Remove new_

                        foreach ($fileList as $fileI => $file) {
                            $cleanFile = str_replace('//', '/', $file);
                            $mustBe = 'media/' . $importId;

                            if (substr($cleanFile, 0, strlen($mustBe)) == $mustBe) {
                                $destFile = $helper->getDestinationFilePath($group->getId(), $dbId) . DS . basename($file);
                                file_put_contents($destFile, $zip->getFromIndex($fileI));
                            }
                        }
                    }
                }

                break;

            case 'download':

                $content = $this->getArchive($templateData, $group);
                $fileName = 'EasyTemplate-' . $group->getId() . '.zip';

                $response = Mage::app()->getResponse();
                $response->clearBody();

                $response
                    ->setHttpResponseCode(200)
                    ->setHeader('Pragma', 'public', true)
                    ->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true)
                    ->setHeader('Content-type', 'application/octet-stream', true)
                    ->setHeader('Content-Length', strlen($content), true)
                    ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"', true)
                    ->setHeader('Last-Modified', date('r'), true);

                $response->setBody($content);
                $response->sendResponse();
                exit; // Sorry, gerade keine Idee wie wir das sonst abbrechen können

                break;

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

    public function getArchive($templatePost, Webguys_Easytemplate_Model_Group $mainGroup)
    {
        $tmpFile = Mage::getBaseDir('tmp') . '/' . $mainGroup->getId() . '.zip';

        try {
            $zip = new ZipArchive();

            if ($zip->open($tmpFile, ZipArchive::CREATE) !== true) {
                throw new Exception("cannot open $tmpFile");
            }

            $zip->addFromString('data.txt', json_encode($templatePost));

            $groupPath = Mage::getBaseDir('media') . DS . 'easytemplate/' . $mainGroup->getId();
            foreach (glob($groupPath . '/*/*') as $file) {
                if (is_file($file)) {
                    $localFile = substr($file, strlen($groupPath));
                    $zip->addFile($file, 'media/' . $localFile);
                }
            }

            $zip->close();
        } catch (Exception $e) {
            unlink($tmpFile);
            throw $e;
        }

        $content = file_get_contents($tmpFile);
        unlink($tmpFile);
        return $content;
    }
}
