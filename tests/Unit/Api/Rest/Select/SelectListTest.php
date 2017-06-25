<?php

namespace tests\Unit\Api\Rest\Request;

use tests\Unit\ThreeDCartTestCase;
use ThreeDCart\Api\Rest\Select\AbstractSelect;
use ThreeDCart\Api\Rest\Select\SelectList;
use ThreeDCart\Primitive\StringValueObject;

/**
 * Class SelectListTest
 *
 * @package tests\Unit\Api\Rest\Select
 */
class SelectListTest extends ThreeDCartTestCase
{
    /** @var SelectList */
    private $subjectUnderTest;
    
    public function setup()
    {
        $this->subjectUnderTest = new SelectList();
    }
    
    public function testGenerationOfQueryStringOneEntry()
    {
        /** @var AbstractSelect $select */
        $select = $this->getMockBuilder(AbstractSelect::class)
                       ->setConstructorArgs([
                           new StringValueObject('test')
                       ])
                       ->getMockForAbstractClass();
        
        $this->subjectUnderTest->addSelect($select);
        
        $this->assertEquals(new StringValueObject('test'), $this->subjectUnderTest->getQueryString());
    }
    
    public function testGenerationOfQueryStringTwoEntries()
    {
        /** @var AbstractSelect $select */
        $select = $this->getMockBuilder(AbstractSelect::class)
                       ->setConstructorArgs([
                           new StringValueObject('first select')
                       ])
                       ->getMockForAbstractClass();
        
        $this->subjectUnderTest->addSelect($select);
        
        /** @var AbstractSelect $secondSelect */
        $secondSelect = $this->getMockBuilder(AbstractSelect::class)
                             ->setConstructorArgs([
                                 new StringValueObject('second select')
                             ])
                             ->getMockForAbstractClass();
        
        $this->subjectUnderTest->addSelect($secondSelect);
        
        $this->assertEquals(new StringValueObject('first select,second select'),
            $this->subjectUnderTest->getQueryString());
    }
}
