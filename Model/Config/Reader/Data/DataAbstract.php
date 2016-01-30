<?php

namespace Webguys\Easytemplate\Model\Config\Reader\Data;

class DataAbstract
{

    protected static function getValueOrNull($attr,$code) {
        if( $obj = $attr->getNamedItem($code) ) {
            return $obj->nodeValue;
        }
        return null;
    }



}