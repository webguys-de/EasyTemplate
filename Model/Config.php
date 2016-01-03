<?php

namespace Webguys\Easytemplate\Model;

class Config
{
    const VIEW_MODE_DEFAULT = 'default';
    const VIEW_MODE_EASYTEMPLATE = 'easytemplate';

    public function getViewModes() {
        return array(
            self::VIEW_MODE_DEFAULT => 'Default',
            self::VIEW_MODE_EASYTEMPLATE => 'EasyTemplate'
        );
    }

}

