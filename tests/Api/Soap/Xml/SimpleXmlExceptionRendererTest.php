<?php

namespace tests\Api\Soap\Xml;

use tests\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\Xml\SimpleXmlExceptionRenderer;

class SimpleXmlExceptionRendererTest extends ThreeDCartTestCase
{
    public function testRenderArray()
    {
        libxml_use_internal_errors(true);
        libxml_clear_errors();
    
        $messages = '';
        try {
            new \SimpleXMLElement("<?xml version='1.0'><broken><xml></broken>");
        } catch (\Exception $ex) {
            $simpleXmlExceptionRenderer = new SimpleXmlExceptionRenderer(libxml_get_errors());
            $messages = $simpleXmlExceptionRenderer->getErrorMessage();
        }
        
        $testMessages = explode("\n", $messages);
        
        $this->assertCount(4, $testMessages);
        $this->assertEquals($testMessages[0], 'Fatal Error 65: Blank needed here on line 1 in column 20');
        $this->assertEquals($testMessages[1], 'Fatal Error 57: parsing XML declaration: \'?>\' expected on line 1 in column 20');
        $this->assertEquals($testMessages[2], 'Fatal Error 76: Opening and ending tag mismatch: xml line 1 and broken on line 1 in column 43');
        $this->assertEquals($testMessages[3], 'Fatal Error 77: Premature end of data in tag broken line 1 on line 1 in column 43');
    }
    
}
