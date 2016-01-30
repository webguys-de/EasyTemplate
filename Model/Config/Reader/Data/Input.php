<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class Input
{

    public static function xmlFactory(\DOMNode $xml)
    {
        return new Input();
    }

}