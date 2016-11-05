<?php

namespace tests\Api\Soap\Xml;

use tests\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\Xml\SimpleXmlExceptionRenderer;

class SimpleXmlExceptionRendererTest extends ThreeDCartTestCase
{
    public function testParseLibXMLErrors()
    {
        libxml_use_internal_errors(true);
        libxml_clear_errors();
        
        $messages = '';
        try {
            new \SimpleXMLElement("<?xml version='1.0'><broken><xml></broken>");
        } catch (\Exception $ex) {
            $simpleXmlExceptionRenderer = new SimpleXmlExceptionRenderer(libxml_get_errors());
            $messages                   = $simpleXmlExceptionRenderer->getErrorMessage();
        }
        
        $testMessages = explode("\n", $messages);
        
        $this->assertCount(4, $testMessages);
        $this->assertEquals($testMessages[0], 'Fatal Error 65: Blank needed here on line 1 in column 20');
        $this->assertEquals($testMessages[1],
            'Fatal Error 57: parsing XML declaration: \'?>\' expected on line 1 in column 20');
        $this->assertEquals($testMessages[2],
            'Fatal Error 76: Opening and ending tag mismatch: xml line 1 and broken on line 1 in column 43');
        $this->assertEquals($testMessages[3],
            'Fatal Error 77: Premature end of data in tag broken line 1 on line 1 in column 43');
    }
    
    public function testParseLibXMLWarning()
    {
        $simpleXmlExceptionRenderer = new SimpleXmlExceptionRenderer(
            [
                $this->createLibXMLError(LIBXML_ERR_WARNING, 11, 12, 'test', 13)
            ]
        );
        $messages                   = $simpleXmlExceptionRenderer->getErrorMessage();
        
        $testMessages = explode("\n", $messages);
        
        $this->assertCount(1, $testMessages);
        $this->assertEquals($testMessages[0], 'Warning 11: test on line 13 in column 12');
    }
    
    public function testParseLibXMLError()
    {
        $simpleXmlExceptionRenderer = new SimpleXmlExceptionRenderer(
            [
                $this->createLibXMLError(LIBXML_ERR_ERROR, 14, 15, 'test', 16),
            ]
        );
        $messages                   = $simpleXmlExceptionRenderer->getErrorMessage();
        
        $testMessages = explode("\n", $messages);
        
        $this->assertCount(1, $testMessages);
        $this->assertEquals($testMessages[0], 'Error 14: test on line 16 in column 15');
    }
    
    public function testParseLibXMLFatalError()
    {
        $simpleXmlExceptionRenderer = new SimpleXmlExceptionRenderer(
            [
                $this->createLibXMLError(LIBXML_ERR_FATAL, 14, 15, 'test', 16),
            ]
        );
        $messages                   = $simpleXmlExceptionRenderer->getErrorMessage();
        
        $testMessages = explode("\n", $messages);
        
        $this->assertCount(1, $testMessages);
        $this->assertEquals($testMessages[0], 'Fatal Error 14: test on line 16 in column 15');
    }
    
    public function testErrorLevelNotAnInt()
    {
        $simpleXmlExceptionRenderer = new SimpleXmlExceptionRenderer(
            [
                $this->createLibXMLError('wrong datatype', 14, 15, 'test', 16),
            ]
        );
        $messages                   = $simpleXmlExceptionRenderer->getErrorMessage();
        
        $testMessages = explode("\n", $messages);
        
        $this->assertCount(1, $testMessages);
        $this->assertEquals($testMessages[0], ' 14: test on line 16 in column 15');
    }
    
    /**
     * @param int    $level
     * @param int    $code
     * @param int    $column
     * @param string $message
     * @param int    $line
     * @param string $file
     *
     * @return \LibXMLError
     */
    private function createLibXMLError($level, $code, $column, $message, $line, $file = '')
    {
        $libXMLError          = new \LibXMLError();
        $libXMLError->level   = $level;
        $libXMLError->code    = $code;
        $libXMLError->column  = $column;
        $libXMLError->message = $message;
        $libXMLError->file    = $file;
        $libXMLError->line    = $line;
        
        return $libXMLError;
    }
    
}
