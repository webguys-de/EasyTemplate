<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class Template
{
    protected $id;
    protected $templateFile;
    protected $enabled;
    protected $type;
    protected $label;
    protected $comment;

    /** @var \Webguys\Easytemplate\Model\Config\Reader\Data\Template[] */
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
    public function __construct($id, $templateFile, $enabled, $type, $label, $comment, Array $fields)
    {
        $this->id = $id;
        $this->templateFile = $templateFile;
        $this->enabled = $enabled;
        $this->type = $type;
        $this->label = $label;
        $this->comment = $comment;
        $this->fields = $fields;
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
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

}