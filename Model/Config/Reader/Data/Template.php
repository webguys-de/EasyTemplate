<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class Template extends DataAbstract
{
    protected $code;
    protected $templateFile;
    protected $enabled;
    protected $type;
    protected $label;
    protected $comment;
    protected $min_sizex;
    protected $min_sizey;
    protected $max_sizex;
    protected $max_sizey;

    /** @var \Webguys\Easytemplate\Model\Config\Reader\Data\Field[] */
    protected $fields = array();

    /**
     * @param $id
     * @param $templateFile
     * @param $enabled
     * @param $type
     * @param $label
     * @param $comment
     * @param \Webguys\Easytemplate\Model\Config\Reader\Data\Template[] $fields
     */
    public function __construct($code, $templateFile, $enabled, $type, $label, $comment, $min_sizex, $min_sizey, $max_sizex, $max_sizey, Array $fields)
    {
        $this->code = $code;
        $this->templateFile = $templateFile;
        $this->enabled = $enabled;
        $this->type = $type;
        $this->label = $label;
        $this->comment = $comment;
        $this->fields = $fields;
        $this->min_sizex = $min_sizex;
        $this->min_sizey = $min_sizey;
        $this->max_sizex = $max_sizex;
        $this->max_sizey = $max_sizey;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTemplateFile()
    {
        return $this->templateFile;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
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
     * @return \Webguys\Easytemplate\Model\Config\Reader\Data\Field[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return mixed
     */
    public function getMinSizex()
    {
        return $this->min_sizex;
    }

    /**
     * @return mixed
     */
    public function getMinSizey()
    {
        return $this->min_sizey;
    }

    /**
     * @return mixed
     */
    public function getMaxSizex()
    {
        return $this->max_sizex;
    }

    /**
     * @return mixed
     */
    public function getMaxSizey()
    {
        return $this->max_sizey;
    }

    public static function xmlFactory(\DOMNode $templateNode)
    {
        /** @var \DOMNode $dataAssoc */
        $dataAssoc = array();
        foreach ($templateNode->childNodes AS $item) {
            /** @var \DOMNode $item */
            $dataAssoc[$item->nodeName] = $item;
        }

        $fields = array();
        if (isset($dataAssoc['fields']) && isset($dataAssoc['fields']->childNodes)) {
            foreach ($dataAssoc['fields']->childNodes AS $fieldNode) {
                if ($field = Field::xmlFactory($fieldNode)) {
                    $fields[] = $field;
                }
            }
        }

        $attr = $templateNode->attributes;
        return new Template(
            self::getValueOrNull($attr, 'code'),
            self::getValueOrNull($attr, 'template'),
            self::getValueOrNull($attr, 'enabled'),
            self::getValueOrNull($attr, 'type'),
            (isset($dataAssoc['label']) ? $dataAssoc['label']->nodeValue : null),
            (isset($dataAssoc['comment']) ? $dataAssoc['comment']->nodeValue : null),
            self::getValueOrNull($attr, 'min_sizex'),
            self::getValueOrNull($attr, 'min_sizey'),
            self::getValueOrNull($attr, 'max_sizex'),
            self::getValueOrNull($attr, 'max_sizey'),
            $fields
        );
    }

}