<?php

namespace Webguys\Easytemplate\Model\Data;

use Webguys\Easytemplate\Model\Field\FieldInterface as Field;
use Webguys\Easytemplate\Model\TemplateInterface as Template;

abstract class DataAbstract
    extends \Magento\Framework\Model\AbstractModel
{
    protected $field = null;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     * @param Field $field
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [],
        Field  $field
    )
    {
        $this->_eventPrefix = $this->getInitEventPrefix();
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->field = $field;
    }

    abstract protected function getInitEventPrefix();

    /**
     * Imports POST-Data
     *
     * @param $data
     * @return $this
     */
    public function importData($data)
    {
        $this->setData('value',$data);
        return $this;
    }

    public function getValue()
    {
        return $this->getData('value');
    }

    /**
     * Loads existing values for given template
     *
     * @return $this
     */
    public function loadByTemplate(Template $template)
    {
        $collection = $this->getCollection()
            ->addFieldToFilter('template_id', $template->getId())
            ->addFieldToFilter('field', $this->field->getCode())
            ->setPageSize(1)
            ->setCurPage(1)
            ->load();

        if ($collection->getSize() > 0) {
            $this->load($collection->getFirstItem()->getId());
        }

        return $this;
    }

    /**
     * Checks if provided data is valid
     * Will be overwritten by child classes to implement specific behaviour
     *
     * @return bool
     */
    public function isValid()
    {
        return true;
    }
}
