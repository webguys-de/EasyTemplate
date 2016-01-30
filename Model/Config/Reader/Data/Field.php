<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class Field extends DataAbstract
{
    protected $code;
    protected $modelname;
    protected $frontend;
    protected $backend;

    public function __construct($code, $modelname, Frontend $frontend=null, Backend $backend=null)
    {
        $this->code = $code;
        $this->modelname = $modelname;
        $this->frontend = $frontend;
        $this->backend = $backend;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return Backend
     */
    public function getBackend()
    {
        return $this->backend;
    }

    /**
     * @return Frontend
     */
    public function getFrontend()
    {
        return $this->frontend;
    }

    /**
     * @return mixed
     */
    public function getModelname()
    {
        return $this->modelname;
    }

    public static function xmlFactory(\DOMNode $fieldNode)
    {
        if ($fieldNode->hasChildNodes()) {

            /** @var \DOMNode $dataAssoc */
            $dataAssoc = array();
            foreach ($fieldNode->childNodes AS $item) {
                /** @var \DOMNode $item */
                $dataAssoc[$item->nodeName] = $item;
            }

            $attr = $fieldNode->attributes;
            return new Field(
                self::getValueOrNull($attr, 'code'),
                self::getValueOrNull($attr, 'model'),
                (isset($dataAssoc['frontend']) ? Frontend::xmlFactory($dataAssoc['frontend']) : null),
                (isset($dataAssoc['backend']) ? Backend::xmlFactory($dataAssoc['backend']) : null)
            );
        }
        return null;
    }

}