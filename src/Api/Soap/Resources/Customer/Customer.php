<?php

namespace ThreeDCart\Api\Soap\Resources\Customer;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class Customer extends SoapResource
{
    /** @var int */
    private $CustomerID = '';
    /** @var string */
    private $UserID = '';
    /** @var Address */
    private $BillingAddress = '';
    /** @var Address */
    private $ShippingAddress = '';
    /** @var string */
    private $Comments = '';
    /** @var string */
    private $LastLoginDate = '';
    /** @var string */
    private $WebSite = '';
    /** @var int */
    private $DiscountGroup = '';
    /** @var string */
    private $AccountNumber = '';
    /** @var bool */
    private $MailList = '';
    /** @var bool */
    private $CustomerType = '';
    /** @var string */
    private $LastUpdate = '';
    /** @var bool */
    private $CustEnabled = '';
    /** @var AdditionalFields The variable name is a typo in the ThreeDCart api object */
    private $AditionalFields = '';
    /** @var string */
    private $AdditionalField4 = '';
    
    /**
     * @return int
     */
    public function getCustomerID()
    {
        return $this->CustomerID;
    }
    
    /**
     * @param int $CustomerID
     */
    public function setCustomerID($CustomerID)
    {
        $this->CustomerID = $CustomerID;
    }
    
    /**
     * @return string
     */
    public function getUserID()
    {
        return $this->UserID;
    }
    
    /**
     * @param string $UserID
     */
    public function setUserID($UserID)
    {
        $this->UserID = $UserID;
    }
    
    /**
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->BillingAddress;
    }
    
    /**
     * @param Address $BillingAddress
     */
    public function setBillingAddress($BillingAddress)
    {
        $this->BillingAddress = $BillingAddress;
    }
    
    /**
     * @return Address
     */
    public function getShippingAddress()
    {
        return $this->ShippingAddress;
    }
    
    /**
     * @param Address $ShippingAddress
     */
    public function setShippingAddress($ShippingAddress)
    {
        $this->ShippingAddress = $ShippingAddress;
    }
    
    /**
     * @return string
     */
    public function getComments()
    {
        return $this->Comments;
    }
    
    /**
     * @param string $Comments
     */
    public function setComments($Comments)
    {
        $this->Comments = $Comments;
    }
    
    /**
     * @return string
     */
    public function getLastLoginDate()
    {
        return $this->LastLoginDate;
    }
    
    /**
     * @param string $LastLoginDate
     */
    public function setLastLoginDate($LastLoginDate)
    {
        $this->LastLoginDate = $LastLoginDate;
    }
    
    /**
     * @return string
     */
    public function getWebSite()
    {
        return $this->WebSite;
    }
    
    /**
     * @param string $WebSite
     */
    public function setWebSite($WebSite)
    {
        $this->WebSite = $WebSite;
    }
    
    /**
     * @return int
     */
    public function getDiscountGroup()
    {
        return $this->DiscountGroup;
    }
    
    /**
     * @param int $DiscountGroup
     */
    public function setDiscountGroup($DiscountGroup)
    {
        $this->DiscountGroup = $DiscountGroup;
    }
    
    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->AccountNumber;
    }
    
    /**
     * @param string $AccountNumber
     */
    public function setAccountNumber($AccountNumber)
    {
        $this->AccountNumber = $AccountNumber;
    }
    
    /**
     * @return boolean
     */
    public function isMailList()
    {
        return $this->MailList;
    }
    
    /**
     * @param boolean $MailList
     */
    public function setMailList($MailList)
    {
        $this->MailList = $MailList;
    }
    
    /**
     * @return boolean
     */
    public function isCustomerType()
    {
        return $this->CustomerType;
    }
    
    /**
     * @param boolean $CustomerType
     */
    public function setCustomerType($CustomerType)
    {
        $this->CustomerType = $CustomerType;
    }
    
    /**
     * @return string
     */
    public function getLastUpdate()
    {
        return $this->LastUpdate;
    }
    
    /**
     * @param string $LastUpdate
     */
    public function setLastUpdate($LastUpdate)
    {
        $this->LastUpdate = $LastUpdate;
    }
    
    /**
     * @return boolean
     */
    public function isCustEnabled()
    {
        return $this->CustEnabled;
    }
    
    /**
     * @param boolean $CustEnabled
     */
    public function setCustEnabled($CustEnabled)
    {
        $this->CustEnabled = $CustEnabled;
    }
    
    /**
     * @return AdditionalFields
     */
    public function getAditionalFields()
    {
        return $this->AditionalFields;
    }
    
    /**
     * @param AdditionalFields $AditionalFields
     */
    public function setAditionalFields($AditionalFields)
    {
        $this->AditionalFields = $AditionalFields;
    }
    
    /**
     * @return string
     */
    public function getAdditionalField4()
    {
        return $this->AdditionalField4;
    }
    
    /**
     * @param string $AdditionalField4
     */
    public function setAdditionalField4($AdditionalField4)
    {
        $this->AdditionalField4 = $AdditionalField4;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitCustomer($this);
    }
}
