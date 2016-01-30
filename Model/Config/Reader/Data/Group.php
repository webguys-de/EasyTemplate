<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class Group extends DataAbstract
{
    protected $code;
    protected $label;
    protected $enabled;

    /**
     * @var array|Template[]
     */
    protected $templates;

    /**
     * @param $id
     * @param $label
     * @param $enabled
     * @param Template[] $templates
     */
    public function __construct($code, $label, $enabled, Array $templates)
    {
        $this->code = $code;
        $this->label = $label;
        $this->enabled = $enabled;
        $this->templates = $templates;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
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
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return array|Template[]
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    public static function xmlFactory(\DOMNode $group)
    {
        $attr = $group->attributes;
        $code = self::getValueOrNull($attr, 'code');

        /** @var \DOMNode $groupAssoc */
        $groupAssoc = array();
        foreach ($group->childNodes AS $item) {
            /** @var \DOMNode $item */
            $groupAssoc[$item->nodeName] = $item;
        }

        $templates = array();
        if ($groupAssoc['templates'] && isset($groupAssoc['templates']->childNodes)) {
            foreach ($groupAssoc['templates']->childNodes AS $templateNode) {
                /** @var \DOMNode $templateNode */
                if ($templateNode->hasChildNodes()) {
                    $templates[] = Template::xmlFactory($templateNode);
                }
            }
        }

        if ($code && count($templates)) {
            return new Group(
                $code,
                (isset($groupAssoc['label']) ? $groupAssoc['label']->nodeValue : null),
                self::getValueOrNull($attr, 'enabled'),
                $templates
            );
        }

        return null;
    }


}