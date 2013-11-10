<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Edit_Box
 *
 * @method getCode
 */
class Webguys_Easytemplate_Block_Adminhtml_Edit_Box
    extends Mage_Adminhtml_Block_Widget
{
    protected $_locale;

    protected $_template_model;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/edit/box.phtml');
    }

    public function getOpenButton($id)
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'id' => 'atwixtweaks_button',
                'label' => $this->helper('easytemplate')->__('Edit'),
                'onclick' => '$(\'template_content_' . $id . '\').show();$(\'template_overview_' . $id . '\').hide();',
                'class' => 'scalable back',
                'title' => $this->helper('easytemplate')->__('Edit'),
                'style' => 'margin-top: 5px;'
            ));
        return $button->toHtml();
    }

    public function getCloseButton($id)
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'id' => 'atwixtweaks_button',
                'label' => $this->helper('easytemplate')->__('Close'),
                'onclick' => '$(\'template_content_' . $id . '\').hide();$(\'template_overview_' . $id . '\').show();',
                'class' => 'scalable back',
                'title' => $this->helper('easytemplate')->__('Close')
            ));
        return $button->toHtml();
    }

    public function getDatePicker()
    {

        $ret = <<<EOF
        <script type="text/javascript">
            //<![CDATA[
            Calendar.setup({
                inputField : '_dob',
                ifFormat : '%m/%e/%y',
                button : '_dob_trig',
                align : 'Bl',
                singleClick : true
            });
            //]]>
        </script>
EOF;
    }

    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }

    /**
     * Retrieve locale
     *
     * @return Mage_Core_Model_Locale
     */
    public function getLocale()
    {
        if (!$this->_locale) {
            $this->_locale = Mage::app()->getLocale();
        }
        return $this->_locale;
    }

    public function getDateStrFormat()
    {
        return $this->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
    }

    public function _toHtml()
    {

        /** @var $input Webguys_Easytemplate_Block_Adminhtml_Edit_Renderer */
        $input = $this->getLayout()->createBlock('easytemplate/adminhtml_edit_renderer');
        $input->setTemplateModel($this->getTemplateModel());
        $this->setChild('input', $input);

        $html = parent::_toHtml();

        if ($this->getTemplateModel() && $this->getTemplateModel()->getId()) {

            foreach ($this->getTemplateModel()->getData() AS $replace => $to) {
                if (in_array($replace, array('valid_from', 'valid_to'))) {
                    $html = str_replace('{{' . $replace . '}}', strftime($this->getDateStrFormat(), strtotime($to)), $html);
                } else {
                    $html = str_replace('{{' . $replace . '}}', $to, $html);
                }
            }

        }

        return $html;
    }

    protected function _prepareLayout()
    {
        $this->setChild('delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label' => Mage::helper('easytemplate')->__('Delete Template'),
                    'class' => 'delete delete-page-template '
                ))
        );

        return parent::_prepareLayout();
    }

    /**
     * @return Webguys_Easytemplate_Model_Template
     */
    public function getTemplateModel()
    {
        return $this->_template_model;
    }

    public function setTemplateModel(Webguys_Easytemplate_Model_Template $model)
    {
        $this->_template_model = $model;
        return $this;
    }

}
