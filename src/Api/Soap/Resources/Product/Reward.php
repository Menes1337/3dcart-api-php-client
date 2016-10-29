<?php

namespace ThreeDCart\Api\Soap\Resources\Product;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class Reward extends SoapResource
{
    /** @var float */
    private $RewardPoints;
    /** @var bool */
    private $RewardDisable;
    /** @var float */
    private $RewardRedeem;
    
    /**
     * @return float
     */
    public function getRewardPoints()
    {
        return $this->RewardPoints;
    }
    
    /**
     * @param float $RewardPoints
     */
    public function setRewardPoints($RewardPoints)
    {
        $this->RewardPoints = $RewardPoints;
    }
    
    /**
     * @return boolean
     */
    public function isRewardDisable()
    {
        return $this->RewardDisable;
    }
    
    /**
     * @param boolean $RewardDisable
     */
    public function setRewardDisable($RewardDisable)
    {
        $this->RewardDisable = $RewardDisable;
    }
    
    /**
     * @return float
     */
    public function getRewardRedeem()
    {
        return $this->RewardRedeem;
    }
    
    /**
     * @param float $RewardRedeem
     */
    public function setRewardRedeem($RewardRedeem)
    {
        $this->RewardRedeem = $RewardRedeem;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitProductReward($this);
    }
}
