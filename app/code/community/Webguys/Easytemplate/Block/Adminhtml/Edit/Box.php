<?php

/**
 * Class Webguys_Easytemplate_Block_Adminhtml_Edit_Box
 *
 * @method getCode
 */
class Webguys_Easytemplate_Block_Adminhtml_Edit_Box extends Mage_Adminhtml_Block_Widget
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
        /** @var $button Mage_Core_Block_Abstract */
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(
                array(
                    'id' => $id,
                    'label' => $this->helper('easytemplate')->__('Edit'),
                    'onclick' => '$(\'' . $id . '\').hide();$(\'template_content_' . $id . '\').show();$(\'' . $id . '_top\').show();',
                    'class' => 'scalable back',
                    'title' => $this->helper('easytemplate')->__('Edit'),
                    'style' => 'margin-top: 5px;'
                )
            );
        return $button->toHtml();
    }

    public function getCloseButton($id, $position)
    {
        /** @var $button Mage_Core_Block_Abstract */
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(
                array(
                    'id' => $id . '_' . $position,
                    'label' => $this->helper('easytemplate')->__('Close'),
                    'onclick' => '$(\'' . $id . '_top\').hide();$(\'template_content_' . $id . '\').hide();$(\'' . $id . '\').show();',
                    'class' => 'easytemplate scalable back f-right ' . $position,
                    'title' => $this->helper('easytemplate')->__('Close'),
                    'style' => 'display: none;'
                )
            );
        return $button->toHtml();
    }

    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }
    
    public function getColor()
    {
        $code = $this->getTemplateModel()->getCode();
        $template = Mage::getSingleton('easytemplate/input_parser')->getTemplate($code);
        $color = $template->getColor();
        
        if (!$color) {
            $color = '#e7efef';
        }
        
        return sprintf('background: %s;', $color);
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
            foreach ($this->getTemplateModel()->getData() as $replace => $to) {
                if (in_array($replace, array('valid_from', 'valid_to'))) {
                    $date = strftime($this->getDateStrFormat(), strtotime($to));
                    $html = str_replace('{{' . $replace . '}}', $to ? $date : '--', $html);
                } else {
                    $html = str_replace('{{' . $replace . '}}', $to, $html);
                }
            }
        }

        return $html;
    }

    protected function _prepareLayout()
    {
        $this->setChild(
            'delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(
                    array(
                        'label' => Mage::helper('easytemplate')->__('Delete Template'),
                        'class' => 'delete delete-easy-template '
                    )
                )
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

    public function setTemplateModel($model)
    {
        $this->_template_model = $model;
        return $this;
    }
}
