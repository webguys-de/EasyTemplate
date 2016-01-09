<?php

namespace Webguys\Easytemplate\Model;

use Webguys\Easytemplate\Model\Config as Config;;

/**
 * Class Template
 * @package Webguys\Easytemplate\Model
 *
 * @method setGroupId($id)
 * @method getGroupId
 * @method setCode($string)
 * @method getCode
 * @method setName($string)
 * @method getName
 * @method setActive($bool)
 * @method getActive
 * @method setPosition($int)
 * @method getPosition
 * @method setValidFrom($date)
 * @method getValidFrom
 * @method setValidTo($date)
 * @method getValidTo
 */
class Template extends \Magento\Framework\Model\AbstractModel implements TemplateInterface
{
    /**
     * Array of Fielddata
     */
    protected $_fieldData = null;

    /**
     * @var Config
     */
    protected $easytemplateConfig;

    protected $configTemplate;

    /**
     * @var string
     */
    protected $code;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [],
        Config $easytemplateConfigTemplate
    )
    {
        $this->easytemplateConfig = $easytemplateConfig;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }


    protected function _construct()
    {
        $this->_eventPrefix = 'easytemplate_template';
        $this->_init('Webguys\Easytemplate\Model\ResourceModel\Template');
    }

    public function importData(Array $data)
    {
        $this->setCode($data['code']);
        $this->setName($data['name']);
        $this->setActive(isset($data['active']) ? $data['active'] : 0);
        $this->setPosition($data['sort_order']);

        if (($time = strtotime($data['valid_from'])) !== false) {
            $this->setValidFrom(date('Y-m-d', $time));
        }

        if (($time = strtotime($data['valid_to'])) !== false) {
            $this->setValidTo(date('Y-m-d', $time));
        }

        $this->_fieldData = $data['fields'];
    }

    public function getFields()
    {
        $this->easytemplateConfig->getFieldsByTemplateCode($this->code);
    }

    public function getFieldData($field = null)
    {
        if ($field === null) {
            return $this->_fieldData;
        }
        return $this->_fieldData[$field];
    }

}