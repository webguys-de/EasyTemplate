<?php

namespace Webguys\Easytemplate\Model\Config\Reader;

use \Webguys\Easytemplate\Model\Config\Reader\Data\Template AS DataTemplate;
use \Webguys\Easytemplate\Model\Config\Reader\Data\Field AS DataField;
use \Webguys\Easytemplate\Model\Config\Reader\Data\Group AS DataGroup;

class Converter implements \Magento\Framework\Config\ConverterInterface
{
    /**
     * Convert dom node tree to array
     *
     * @param \DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $result = array();

        $groups = $source->getElementsByTagName('group');
        foreach ($groups as $group) {
            /** @var \DOMNode $group */

            if ($group->hasChildNodes()) {

                $attr = $group->attributes;
                $id = $this->getValueOrNull($attr,'id');


                /** @var \DOMNode $groupAssoc */
                $groupAssoc = array();
                foreach ($group->childNodes AS $item) {
                    /** @var \DOMNode $item */
                    $groupAssoc[$item->nodeName] = $item;
                }

                $templates = $this->_convertTemplates($groupAssoc['templates']);
                if( $id && count($templates) )
                {
                    $result[ $id ] = new DataGroup(
                        $id,
                        (isset($dataAssoc['label']) ? $dataAssoc['label']->nodeValue : null),
                        $this->getValueOrNull($attr,'enabled'),
                        $templates
                    );
                }
            }
        }

        return $result;
    }

    protected function _convertTemplates(\DOMNode $templates)
    {
        $result = array();

        foreach ($templates->childNodes AS $templateNode) {
            /** @var \DOMNode $templateNode */

            if ($templateNode->hasChildNodes()) {

                /** @var \DOMNode $dataAssoc */
                $dataAssoc = array();
                foreach ($templateNode->childNodes AS $item) {
                    /** @var \DOMNode $item */
                    $dataAssoc[$item->nodeName] = $item;
                }

                $fields = array();
                if( isset($dataAssoc['fields']) ) {
                    $fields = $this->_convertFields($dataAssoc['fields']);
                }

                $attr = $templateNode->attributes;
                $result[] = new DataTemplate(
                    $this->getValueOrNull($attr,'id'),
                    $this->getValueOrNull($attr,'template'),
                    $this->getValueOrNull($attr,'enabled'),
                    $this->getValueOrNull($attr,'type'),
                    (isset($dataAssoc['label']) ? $dataAssoc['label']->nodeValue : null),
                    (isset($dataAssoc['comment']) ? $dataAssoc['comment']->nodeValue : null),
                    $this->getValueOrNull($attr,'min_sizex'),
                    $this->getValueOrNull($attr,'min_sizey'),
                    $this->getValueOrNull($attr,'max_sizex'),
                    $this->getValueOrNull($attr,'max_sizey'),
                    $fields
                );

            }

        }

        return $result;
    }

    protected function _convertFields(\DOMNode $fields)
    {
        $result = array();

        foreach ($fields->childNodes AS $fieldNode) {
            /** @var \DOMNode $fieldNode */

            if ($fieldNode->hasChildNodes()) {

                /** @var \DOMNode $dataAssoc */
                $dataAssoc = array();
                foreach ($fieldNode->childNodes AS $item) {
                    /** @var \DOMNode $item */
                    $dataAssoc[$item->nodeName] = $item;
                }

                $attr = $fieldNode->attributes;
                $result[] = new DataField(
                    $this->getValueOrNull($attr,'id'),
                    $this->getValueOrNull($attr,'inputRenderer'),
                    $this->getValueOrNull($attr,'backendModel'),
                    $this->getValueOrNull($attr,'required'),
                    $this->getValueOrNull($attr,'sortOrder'),
                    (isset($dataAssoc['label']) ? $dataAssoc['label']->nodeValue : null),
                    (isset($dataAssoc['comment']) ? $dataAssoc['comment']->nodeValue : null)
                );

            }
        }

        return $result;
    }

    protected function getValueOrNull($attr,$code) {
        if( $obj = $attr->getNamedItem($code) ) {
            return $obj->nodeValue;
        }
        return null;
    }

}
