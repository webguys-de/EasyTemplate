<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class Field
{
    protected $id;
    protected $inputRenderer;
    protected $backendModel;
    protected $required;
    protected $sortOrder;
    protected $label;
    protected $comment;

    public function __construct($id, $inputRenderer, $backendModel, $required, $sortOrder, $label, $comment)
    {
        $this->id = $id;
        $this->inputRenderer = $inputRenderer;
        $this->backendModel = $backendModel;
        $this->required = $required;
        $this->sortOrder = $sortOrder;
        $this->label = $label;
        $this->comment = $comment;
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
    public function getInputRenderer()
    {
        return $this->inputRenderer;
    }

    /**
     * @return mixed
     */
    public function getBackendModel()
    {
        return $this->backendModel;
    }

    /**
     * @return mixed
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
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

}