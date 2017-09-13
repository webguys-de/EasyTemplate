<?php

class Webguys_Easytemplate_Exception_RedirectException extends Mage_Core_Controller_Varien_Exception
{
    public function prepareRedirect($path, $arguments = [])
    {
        $this->_resultCallback       = self::RESULT_REDIRECT;
        $this->_resultCallbackParams = [$path, $arguments];
        return $this;
    }
}
