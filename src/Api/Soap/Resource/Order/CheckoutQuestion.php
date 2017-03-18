<?php

namespace ThreeDCart\Api\Soap\Resource\Order;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class CheckoutQuestion
 *
 * @package ThreeDCart\Api\Soap\Resource\Order
 */
class CheckoutQuestion extends SoapResource
{
    /** @var int */
    private $Id;
    /** @var string */
    private $Question;
    /** @var string */
    private $Answer;
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }
    
    /**
     * @param int $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }
    
    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->Question;
    }
    
    /**
     * @param string $Question
     */
    public function setQuestion($Question)
    {
        $this->Question = $Question;
    }
    
    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->Answer;
    }
    
    /**
     * @param string $Answer
     */
    public function setAnswer($Answer)
    {
        $this->Answer = $Answer;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitOrderCheckoutQuestion($this);
    }
}
