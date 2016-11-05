<?php

namespace tests\Api\Soap;

use tests\ThreeDCartTestCase;
use ThreeDCart\Api\Soap\Exceptions\ApiErrorException;
use ThreeDCart\Api\Soap\Exceptions\Exception;
use ThreeDCart\Api\Soap\Exceptions\MalFormedApiResponseException;
use ThreeDCart\Api\Soap\Exceptions\ResponseBodyEmptyException;
use ThreeDCart\Api\Soap\ResponseHandler;
use ThreeDCart\Api\Soap\ResponseHandlerInterface;

class ResponseHandlerTest extends ThreeDCartTestCase
{
    /** @var ResponseHandlerInterface */
    private $responseHandler;
    
    public function setup()
    {
        $this->responseHandler = new ResponseHandler();
    }
    
    public function testProcessXMLToArray()
    {
        $mock      = new \stdClass();
        $mock->any =
            '<runQueryResponse xmlns=""><runQueryRecord><id>1</id><category_name>Sample Category</category_name><category_description/><category_main>True</category_main><category_parent>0</category_parent><category_header><![CDATA[<DIV>This is a Sample Category for your Store. Click on the Subcategories below to browse the products.</DIV><DIV>&nbsp;</DIV>]]></category_header><category_footer/><category_title/><category_meta/><sorting>20</sorting><numtolist>0</numtolist><displaytype>0</displaytype><columnum>0</columnum><iconimage/><special_numtolist>0</special_numtolist><special_displaytype>0</special_displaytype><special_columnum>0</special_columnum><category_columnum>2</category_columnum><category_displaytype>0</category_displaytype><related_displaytype>0</related_displaytype><related_columnum>0</related_columnum><listing_displaytype>0</listing_displaytype><hide>0</hide><category_defaultsorting>0</category_defaultsorting><userid>Administrator</userid><last_update>2/27/2015 4:40:32 AM</last_update><itemicon>0</itemicon><redirectto/><accessgroup>0</accessgroup><link/><link_target/><upsellitems_displaytype>0</upsellitems_displaytype><upsellitems_columnum>0</upsellitems_columnum><filename/><isFilter>0</isFilter><keywords/><smartcategory>0</smartcategory><smartcategory_keyword/><hide_left>0</hide_left><hide_right>0</hide_right><hide_framemenu>0</hide_framemenu><homespecial>0</homespecial><dynamic_filter>0</dynamic_filter><menu_group>0</menu_group><extra_field_1/></runQueryRecord><runQueryRecord><id>3</id><category_name>Gifts</category_name><category_description/><category_main>True</category_main><category_parent>1</category_parent><category_header/><category_footer/><category_title/><category_meta/><sorting>1</sorting><numtolist>0</numtolist><displaytype>0</displaytype><columnum>2</columnum><iconimage>assets/images/default/button_thumbnail.jpg</iconimage><special_numtolist>0</special_numtolist><special_displaytype>0</special_displaytype><special_columnum>0</special_columnum><category_columnum>0</category_columnum><category_displaytype>0</category_displaytype><related_displaytype>0</related_displaytype><related_columnum>0</related_columnum><listing_displaytype>0</listing_displaytype><hide>0</hide><category_defaultsorting>0</category_defaultsorting><userid>Administrator</userid><last_update>6/22/2009</last_update><itemicon>0</itemicon><redirectto/><accessgroup>0</accessgroup><link/><link_target/><upsellitems_displaytype>0</upsellitems_displaytype><upsellitems_columnum>0</upsellitems_columnum><filename/><isFilter>0</isFilter><keywords/><smartcategory>0</smartcategory><smartcategory_keyword/><hide_left>0</hide_left><hide_right>0</hide_right><hide_framemenu>0</hide_framemenu><homespecial>0</homespecial><dynamic_filter>0</dynamic_filter><menu_group>0</menu_group><extra_field_1/></runQueryRecord></runQueryResponse>';
        
        $response = $this->responseHandler->processXMLToArray($mock, 'runQueryRecord');
        
        $this->assertCount(2, $response);
    }
    
    public function testProcessXMLToArrayInvalidLogin()
    {
        $mock      = new \stdClass();
        $mock->any = '<Error xmlns=""><Id>17</Id><Description>Login Error</Description></Error>';
        
        $this->expectException(ApiErrorException::class);
        
        $this->responseHandler->processXMLToArray($mock, 'runQueryRecord');
    }
    
    public function testProcessXMLToArraySQLTableNotFound()
    {
        $mock      = new \stdClass();
        $mock->any =
            '<runQueryResponse xmlns=""><Error><Id>99</Id><Description>The Microsoft Jet database engine cannot find the input table or query \'categories\'.  Make sure it exists and that its name is spelled correctly.</Description></Error></runQueryResponse>';
        
        $this->expectException(ApiErrorException::class);
        
        $this->responseHandler->processXMLToArray($mock, 'runQueryRecord');
    }
    
    public function testProcessXMLToArrayEmptyObject()
    {
        $mock      = new \stdClass();
        $mock->any = '';
        
        $this->expectException(ResponseBodyEmptyException::class);
        
        $this->responseHandler->processXMLToArray($mock, 'runQueryRecord');
    }
    
    public function testProcessXMLToArrayInvalidXML()
    {
        $mock      = new \stdClass();
        $mock->any = '<somexmls><id>4<test></id></somexmls>';
        
        $this->expectException(MalFormedApiResponseException::class);
        
        $response = $this->responseHandler->processXMLToArray($mock, 'runQueryRecord');
        
        $this->assertEmpty($response);
    }
    
    public function testProcessXMLToArrayInvalidXMLResponseXML()
    {
        $mock      = new \stdClass();
        $mock->any = '<somexmls><id>4<test></id></somexmls>';
        
        try {
            $this->responseHandler->processXMLToArray($mock, 'runQueryRecord');
        } catch (Exception $ex) {
            $this->assertInstanceOf(MalFormedApiResponseException::class, $ex);
            if ($ex instanceof MalFormedApiResponseException) {
                $this->assertEquals($mock->any, $ex->getXmlResponse());
            }
        }
    }
    
    public function testProcessXMLToArrayResponseXmlTagMissing()
    {
        $mock      = new \stdClass();
        $mock->any =
            '<runQueryResponse xmlns=""><id>1</id><category_name>Sample Category</category_name><category_description/><category_main>True</category_main><category_parent>0</category_parent><category_header><![CDATA[<DIV>This is a Sample Category for your Store. Click on the Subcategories below to browse the products.</DIV><DIV>&nbsp;</DIV>]]></category_header><category_footer/><category_title/><category_meta/><sorting>20</sorting><numtolist>0</numtolist><displaytype>0</displaytype><columnum>0</columnum><iconimage/><special_numtolist>0</special_numtolist><special_displaytype>0</special_displaytype><special_columnum>0</special_columnum><category_columnum>2</category_columnum><category_displaytype>0</category_displaytype><related_displaytype>0</related_displaytype><related_columnum>0</related_columnum><listing_displaytype>0</listing_displaytype><hide>0</hide><category_defaultsorting>0</category_defaultsorting><userid>Administrator</userid><last_update>2/27/2015 4:40:32 AM</last_update><itemicon>0</itemicon><redirectto/><accessgroup>0</accessgroup><link/><link_target/><upsellitems_displaytype>0</upsellitems_displaytype><upsellitems_columnum>0</upsellitems_columnum><filename/><isFilter>0</isFilter><keywords/><smartcategory>0</smartcategory><smartcategory_keyword/><hide_left>0</hide_left><hide_right>0</hide_right><hide_framemenu>0</hide_framemenu><homespecial>0</homespecial><dynamic_filter>0</dynamic_filter><menu_group>0</menu_group><extra_field_1/></runQueryResponse>';
        
        $this->expectException(MalFormedApiResponseException::class);
        
        $this->responseHandler->processXMLToArray($mock, 'runQueryRecord');
    }
}
