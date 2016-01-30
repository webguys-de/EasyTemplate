<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class Frontend
{

    public static function xmlFactory(\DOMNode $xml)
    {
        return new Frontend();
    }

}