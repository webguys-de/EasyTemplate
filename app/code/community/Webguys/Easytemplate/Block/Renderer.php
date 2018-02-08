<?php

/**
 * Class Webguys_Easytemplate_Block_Renderer
 *
 * @method getGroup
 * @method setGroup
 */
class Webguys_Easytemplate_Block_Renderer extends Mage_Core_Block_Template
{
    protected $_cachingAllowed = true;
    protected $parentId = null;

    public function __construct(array $args = array())
    {
        parent::__construct($args);

        if (method_exists($this, 'addCacheTag')) {
            $this->addCacheTag(Webguys_Easytemplate_Helper_Cache::CACHE_TAG);
        }
    }

    public function getCacheKeyInfo()
    {
        return array(
            'BLOCK_TPL_EASYTEMPLATE',
            Mage::app()->getStore()->getCode(),
            (int)Mage::app()->getStore()->isCurrentlySecure(),
            Mage::getSingleton('customer/session')->isLoggedIn(),
            Mage::getSingleton('customer/session')->getCustomerGroupId(),
            $this->getGroup()->getId()
        );
    }

    public function getCacheLifetime()
    {
        /** @var $helper Webguys_Easytemplate_Helper_Cache */
        $helper = Mage::helper('easytemplate/cache');
        return ($this->_cachingAllowed) ? $helper->getCacheLifeTime() : null;
    }

    /**
     * @param $group Webguys_Easytemplate_Model_Group
     * @return $this
     */
    public function setChildsBasedOnGroup($group, $parent = null)
    {
        $this->parentId = $parent;

        if (!$this->countChildren()) {
            Varien_Profiler::start('easytemplate_template_rendering');

            /** @var $configModel Webguys_Easytemplate_Model_Input_Parser */
            $configModel = Mage::getSingleton('easytemplate/input_parser');

            $position = 1;

            $storeDate = Mage::app()->getLocale()->storeDate(Mage::app()->getStore()->getId());
            $time = $storeDate->getTimestamp();

            /** @var $template Webguys_Easytemplate_Model_Template */
            foreach ($group->getTemplateCollection($parent) as $template) {
                $templateCode = $template->getCode();
                if ($model = $configModel->getTemplate($templateCode)) {
                    $active = $template->getActive();
                    $validFrom = ($template->getValidFrom()) ? strtotime($template->getValidFrom()) : false;
                    $validTo = ($template->getValidTo()) ? strtotime($template->getValidTo()) : false;

                    if ($validFrom !== false || $validTo !== false) {
                        $this->_cachingAllowed = false;
                    }

                    Varien_Profiler::start('easytemplate_template_rendering_' . $templateCode);

                    if ($active && (!$validFrom || $validFrom <= $time) && (!$validTo || $validTo >= $time)) {

                        /** @var $childBlock Webguys_Easytemplate_Block_Template */
                        $childBlock = $this->getLayout()->createBlock($model->getType());
                        $childBlock->setTemplate($model->getTemplate());
                        $childBlock->setTemplateModel($template);
                        $childBlock->setTemplateCode($templateCode);
                        $childBlock->setGroup($group);

                        if (!$childBlock->getCacheLifetime()) {
                            $this->_cachingAllowed=false;
                        }

                        /** @var $field Webguys_Easytemplate_Model_Input_Parser_Field */
                        foreach ($model->getFields() as $field) {
                            $fieldCode = $field->getCode();

                            Varien_Profiler::start('easytemplate_template_rendering_' . $templateCode . '_field_' . $fieldCode);

                            /** @var $inputValidator Webguys_Easytemplate_Model_Input_Renderer_Validator_Base */
                            $inputValidator = $field->getInputRendererValidator();
                            $inputValidator->setTemplate($template);
                            $inputValidator->setField($field);

                            $frontendValue = $inputValidator->prepareForFrontend($template->getFieldData($fieldCode));
                            if ($frontendValue) {
                                $valueTransport = new Varien_Object();
                                $valueTransport->setValue($frontendValue);

                                Mage::dispatchEvent(
                                    'easytemplate_frontend_prepared_var',
                                    array(
                                        'template' => $template,
                                        'template_model' => $model,
                                        'field' => $field,
                                        'block' => $childBlock,
                                        'validator' => $inputValidator,
                                        'value' => $valueTransport
                                    )
                                );

                                $childBlock->setData($fieldCode, $valueTransport->getValue());
                            }

                            Varien_Profiler::stop('easytemplate_template_rendering_' . $templateCode . '_field_' . $fieldCode);
                        }

                        $this->setChild('block_' . $position . '_' . $templateCode, $childBlock);
                        $position++;
                    }

                    Varien_Profiler::stop('easytemplate_template_rendering_' . $templateCode);
                }
            }

            Varien_Profiler::stop('easytemplate_template_rendering');
        }

        return $this;
    }

    protected function _beforeToHtml()
    {
        $this->setChildsBasedOnGroup($this->getGroup());

        Mage::dispatchEvent(
            'easytemplate_frontend_before_to_html',
            array(
                'block' => $this
            )
        );

        return parent::_beforeToHtml();
    }

    protected function _toHtml()
    {
        return $this->getChildHtml();
    }
}
