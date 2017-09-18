<?php

/**
 * Class Webguys_Easytemplate_Model_Input_Parser_Template
 *
 * @method setCategory
 * @method getCategory
 * @method getImage
 */
class Webguys_Easytemplate_Model_Input_Parser_Template extends Webguys_Easytemplate_Model_Input_Parser_Abstract
{

    /**
     * check if template is hidden
     *
     * @return bool - template is hidden
     */
    public function isHidden()
    {
        $hidden = $this->getData('hidden');
        return '' == $hidden ? false : (bool)$hidden;
    }

    /**
     * check if template is enabled
     *
     * @return bool - template is enabled
     */
    public function isEnabled()
    {
        $enabled = $this->getData('enabled');
        return '' == $enabled ? true : (bool)$enabled;
    }

    public function getLabel()
    {
        return $this->getData('label');
    }

    public function getComment()
    {
        return $this->getData('comment');
    }

    public function getSortOrder()
    {
        return $this->getData('sort_order');
    }

    public function getTemplate()
    {
        return $this->_getAttribute('template');
    }

    public function getType()
    {
        return $this->_getAttribute('type');
    }

    public function getAttribute($name)
    {
        return (string)$this->_getAttribute($name);
    }

    protected function _getAttribute($name)
    {
        return $this->getConfig()->getNode()->getAttribute($name);
    }

    /**
     * Orders field by sort_order attribute
     *
     * @param $a Webguys_Easytemplate_Model_Input_Parser_Field
     * @param $b Webguys_Easytemplate_Model_Input_Parser_Field
     */
    private function orderFields($a, $b)
    {
        if ($a->getSortOrder() == $b->getSortOrder()) {
            return 0;
        }
        return ($a->getSortOrder() < $b->getSortOrder()) ? -1 : 1;
    }

    /**
     * @return Webguys_Easytemplate_Model_Input_Parser_Field[]
     */
    public function getFields()
    {
        $fields = $this->getConfig()->getNode('fields');
        $result = array();

        if ($fields && $fields->hasChildren()) {
            foreach ($fields->children() as $data) {
                /** @var $parser Webguys_Easytemplate_Model_Input_Parser_Field */
                $parser = Mage::getModel('easytemplate/input_parser_field');
                $parser->setConfig($data);
                $parser->setTemplate($this);

                if ($parser->isEnabled()) {
                    $result[] = $parser;
                }
            }

            // Sort fields by sort_order
            usort($result, array($this, 'orderFields'));
        }

        return $result;
    }

    public function getCode()
    {
        return $this->getCategory() . '_' . parent::getCode();
    }

    public function cleanDatabase()
    {
        $fields = $this->getFields();

        // Collect different backend models
        $usedTypes = array();
        foreach ($fields as $field) {
            $usedTypes[] = get_class($field->getBackendModel());
        }
        $usedTypes = array_unique($usedTypes);

        foreach ($usedTypes as $type) {

            // Delete all fields of type which do not belong to this template type
            $validFields = array();
            foreach ($fields as $field) {
                if (get_class($field->getBackendModel()) == $type) {
                    $validFields[] = $field->getCode();
                }
            }

            /** @var $model Webguys_Easytemplate_Model_Template_Data_Abstract */
            $model = Mage::getModel($type);

            $resource = $model->getResource();

            /** @var $collection Webguys_Easytemplate_Model_Resource_Template_Data_Collection_Abstract */
            $collection = $model->getCollection();
            $collection->getSelect()
                ->join(
                    array('template' => $resource->getTable('easytemplate/template')),
                    'main_table.template_id = template.id',
                    array()
                )
                ->where('template.code = ?', $this->getCode())
                ->where('main_table.field NOT IN (?)', $validFields);

            $collection->load();
            $collection->walk('delete');
        }
    }
}
