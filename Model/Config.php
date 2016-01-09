<?php

namespace Webguys\Easytemplate\Model;

class Config
{
    const VIEW_MODE_DEFAULT = 'default';
    const VIEW_MODE_EASYTEMPLATE = 'easytemplate';

    protected $reader;

    function __construct(
        \Webguys\Easytemplate\Model\Config\Reader $reader
    )
    {
        $this->reader = $reader;
    }

    public function getViewModes() {
        return array(
            self::VIEW_MODE_DEFAULT => 'Default',
            self::VIEW_MODE_EASYTEMPLATE => 'EasyTemplate'
        );
    }

    public function getTemplates()
    {
        return $this->reader->read();
    }

}

