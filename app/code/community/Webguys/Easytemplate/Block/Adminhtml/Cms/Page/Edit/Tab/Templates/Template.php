<?php

class Webguys_Easytemplate_Block_Adminhtml_Cms_Page_Edit_Tab_Templates_Template extends Mage_Adminhtml_Block_Widget
{
    protected $_page;

    protected $_pageInstance;

    protected $_values;

    protected $_itemCount = 1;

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('easytemplate/cms/page/edit/templates/template.phtml');
        $this->setCanReadPrice(true);
        $this->setCanEditPrice(true);
    }

    public function getItemCount()
    {
        return $this->_itemCount;
    }

    public function setItemCount($itemCount)
    {
        $this->_itemCount = max($this->_itemCount, $itemCount);
        return $this;
    }

    /**
     * Get Product
     *
     * @return Mage_Cms_Model_Page
     */
    public function getPage()
    {
        if (!$this->_pageInstance) {
            if ($page = Mage::registry('cms_page')) {
                $this->_pageInstance = $page;
            } else {
                $this->_pageInstance = Mage::getSingleton('cms/page');
            }
        }

        return $this->_pageInstance;
    }

    public function setPage($product)
    {
        $this->_pageInstance = $product;
        return $this;
    }

    /**
     * Retrieve options field name prefix
     *
     * @return string
     */
    public function getFieldName()
    {
        return 'page[templates]';
    }

    /**
     * Retrieve options field id prefix
     *
     * @return string
     */
    public function getFieldId()
    {
        return 'page_template';
    }

    /**
     * Check block is readonly
     *
     * @return boolean
     */
    public function isReadonly()
    {
        return false;
        //return $this->getPage()->getOptionsReadonly();
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

        /*
        $path = 'global/catalog/product/options/custom/groups';

        foreach (Mage::getConfig()->getNode($path)->children() as $group) {
            $this->setChild($group->getName() . '_option_type',
                $this->getLayout()->createBlock(
                    (string) Mage::getConfig()->getNode($path . '/' . $group->getName() . '/render')
                )
            );
        }
        */

        return parent::_prepareLayout();
    }

    public function getAddButtonId()
    {
        $buttonId = $this->getLayout()
            ->getBlock('cms_page_edit_tab_templates')
            ->getChild('add_button')->getId();
        return $buttonId;
    }

    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }

    public function getTypeSelectHtml()
    {
        $select = $this->getLayout()->createBlock('adminhtml/html_select')
            ->setData(array(
                'id' => $this->getFieldId().'_{{id}}_type',
                'class' => 'select select-page-template-type required-template-select'
            ))
            ->setName($this->getFieldName().'[{{id}}][type]')
            ->setOptions(Mage::getSingleton('adminhtml/system_config_source_product_options_type')->toOptionArray());

        // TODO: Liste der möglichen Templates ausliefern

        return $select->getHtml();
    }

    /**
     * Retrieve html templates for different types of product custom options
     *
     * @return string
     */
    public function getTemplatesHtml()
    {
        // TODO: Ausgeben der verschiedenen JavaScript-Funktionalitäten

        /*
        $canEditPrice = $this->getCanEditPrice();
        $canReadPrice = $this->getCanReadPrice();
        $this->getChild('select_option_type')
            ->setCanReadPrice($canReadPrice)
            ->setCanEditPrice($canEditPrice);

        $this->getChild('file_option_type')
            ->setCanReadPrice($canReadPrice)
            ->setCanEditPrice($canEditPrice);

        $this->getChild('date_option_type')
            ->setCanReadPrice($canReadPrice)
            ->setCanEditPrice($canEditPrice);

        $this->getChild('text_option_type')
            ->setCanReadPrice($canReadPrice)
            ->setCanEditPrice($canEditPrice);

        $templates = $this->getChildHtml('text_option_type') . "\n" .
            $this->getChildHtml('file_option_type') . "\n" .
            $this->getChildHtml('select_option_type') . "\n" .
            $this->getChildHtml('date_option_type');

        return $templates;*/
    }

    public function getOptionValues()
    {
        $optionsArr = array_reverse($this->getPage()->getOptions(), true);

        if (!$this->_values) {
            $showPrice = $this->getCanReadPrice();
            $values = array();
            $scope = (int) Mage::app()->getStore()->getConfig(Mage_Core_Model_Store::XML_PATH_PRICE_SCOPE);
            foreach ($optionsArr as $option) {
                /* @var $option Mage_Catalog_Model_Product_Option */

                $this->setItemCount($option->getOptionId());

                $value = array();

                $value['id'] = $option->getOptionId();
                $value['item_count'] = $this->getItemCount();
                $value['option_id'] = $option->getOptionId();
                $value['title'] = $this->htmlEscape($option->getTitle());
                $value['type'] = $option->getType();
                $value['is_require'] = $option->getIsRequire();
                $value['sort_order'] = $option->getSortOrder();
                $value['can_edit_price'] = $this->getCanEditPrice();

                if ($this->getPage()->getStoreId() != '0') {
                    $value['checkboxScopeTitle'] = $this->getCheckboxScopeHtml($option->getOptionId(), 'title',
                        is_null($option->getStoreTitle()));
                    $value['scopeTitleDisabled'] = is_null($option->getStoreTitle())?'disabled':null;
                }

                if ($option->getGroupByType() == Mage_Catalog_Model_Product_Option::OPTION_GROUP_SELECT) {
                    $i = 0;
                    $itemCount = 0;
                    foreach ($option->getValues() as $_value) {
                        /* @var $_value Mage_Catalog_Model_Product_Option_Value */
                        $value['optionValues'][$i] = array(
                            'item_count' => max($itemCount, $_value->getOptionTypeId()),
                            'option_id' => $_value->getOptionId(),
                            'option_type_id' => $_value->getOptionTypeId(),
                            'title' => $this->htmlEscape($_value->getTitle()),
                            'price' => '',
                            'price_type' => ($showPrice) ? $_value->getPriceType() : 0,
                            'sku' => $this->htmlEscape($_value->getSku()),
                            'sort_order' => $_value->getSortOrder(),
                        );

                        if ($this->getPage()->getStoreId() != '0') {
                            $value['optionValues'][$i]['checkboxScopeTitle'] = $this->getCheckboxScopeHtml(
                                $_value->getOptionId(), 'title', is_null($_value->getStoreTitle()),
                                $_value->getOptionTypeId());
                            $value['optionValues'][$i]['scopeTitleDisabled'] = is_null($_value->getStoreTitle())
                                ? 'disabled' : null;
                            if ($scope == Mage_Core_Model_Store::PRICE_SCOPE_WEBSITE) {
                                $value['optionValues'][$i]['checkboxScopePrice'] = $this->getCheckboxScopeHtml(
                                    $_value->getOptionId(), 'price', is_null($_value->getstorePrice()),
                                    $_value->getOptionTypeId());
                                $value['optionValues'][$i]['scopePriceDisabled'] = is_null($_value->getStorePrice())
                                    ? 'disabled' : null;
                            }
                        }
                        $i++;
                    }
                } else {
                    $value['price'] = '';
                    $value['price_type'] = $option->getPriceType();
                    $value['sku'] = $this->htmlEscape($option->getSku());
                    $value['max_characters'] = $option->getMaxCharacters();
                    $value['file_extension'] = $option->getFileExtension();
                    $value['image_size_x'] = $option->getImageSizeX();
                    $value['image_size_y'] = $option->getImageSizeY();
                    if ($this->getPage()->getStoreId() != '0' &&
                        $scope == Mage_Core_Model_Store::PRICE_SCOPE_WEBSITE) {
                        $value['checkboxScopePrice'] = $this->getCheckboxScopeHtml($option->getOptionId(),
                            'price', is_null($option->getStorePrice()));
                        $value['scopePriceDisabled'] = is_null($option->getStorePrice())?'disabled':null;
                    }
                }
                $values[] = new Varien_Object($value);
            }
            $this->_values = $values;
        }

        return $this->_values;
    }

    /**
     * Retrieve html of scope checkbox
     *
     * @param string $id
     * @param string $name
     * @param boolean $checked
     * @param string $select_id
     * @return string
     */
    public function getCheckboxScopeHtml($id, $name, $checked=true, $select_id='-1')
    {
        $checkedHtml = '';

        if ($checked) {
            $checkedHtml = ' checked="checked"';
        }

        $selectNameHtml = '';
        $selectIdHtml = '';

        if ($select_id != '-1') {
            $selectNameHtml = '[values][' . $select_id . ']';
            $selectIdHtml = 'select_' . $select_id . '_';
        }

        $checkbox = '<input type="checkbox" id="' . $this->getFieldId() . '_' . $id . '_' .
            $selectIdHtml . $name . '_use_default" class="product-option-scope-checkbox" name="' .
            $this->getFieldName() . '['.$id.']' . $selectNameHtml . '[scope][' . $name . ']" value="1" ' .
            $checkedHtml . '/>';

        $checkbox .= '<label class="normal" for="' . $this->getFieldId() . '_' . $id . '_' .
            $selectIdHtml . $name . '_use_default">' . $this->__('Use Default Value') . '</label>';

        return $checkbox;
    }
}
