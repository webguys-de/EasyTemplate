<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class Group
{
    protected $id;
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
    public function __construct($id,$label,$enabled,Array $templates)
    {
        $this->id = $id;
        $this->label = $label;
        $this->templates = $templates;
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

}