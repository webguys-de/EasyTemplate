<?php

namespace Webguys\Easytemplate\Test\Model\Config\Reader;

class ConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Framework\Event\Config\Converter
     */
    protected $_model;

    /**
     * @var string
     */
    protected $_filePath;

    /**
     * @var \DOMDocument
     */
    protected $_source;

    protected function setUp()
    {
        $this->_filePath = __DIR__ . '/_files/';
        $this->_source = new \DOMDocument();
        $this->_model = new \Webguys\Easytemplate\Model\Config\Reader\Converter();
    }

    public function testConvert()
    {
        $this->_source->loadXML(file_get_contents($this->_filePath . 'easytemplate.xml'));
        $convertedFile = file_get_contents( $this->_filePath . 'easytemplate_converted.txt' );
        $result = var_export( $this->_model->convert($this->_source), true);

        // file_put_contents( $this->_filePath . 'easytemplate_converted.php', $result ); // In case of new data-schema write it to php-file

        $this->assertEquals($convertedFile, $result);
    }

}
