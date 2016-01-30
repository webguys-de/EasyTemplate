<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class Backend extends DataAbstract
{
    protected $sort;
    protected $label;
    protected $comment;

    /**
     * @var Input
     */
    protected $input;

    public function __construct($sort, $label, $comment, Input $input=null)
    {
        $this->sort = $sort;
        $this->label = $label;
        $this->comment = $comment;
        $this->input = $input;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return Input
     */
    public function getInput()
    {
        return $this->input;
    }

    public static function xmlFactory(\DOMNode $xml)
    {
        /** @var \DOMNode $dataAssoc */
        $dataAssoc = array();
        foreach ($xml->childNodes AS $item) {
            /** @var \DOMNode $item */
            $dataAssoc[$item->nodeName] = $item;
        }
        $attr = $xml->attributes;

        return new Backend(
            self::getValueOrNull($attr, 'sort'),
            (isset($dataAssoc['label']) ? $dataAssoc['label']->nodeValue : null),
            (isset($dataAssoc['comment']) ? $dataAssoc['comment']->nodeValue : null),
            (isset($dataAssoc['input']) ? Input::xmlFactory($dataAssoc['input']) : null)
        );
    }

}