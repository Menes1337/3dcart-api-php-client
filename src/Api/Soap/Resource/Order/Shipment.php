<?php

namespace ThreeDCart\Api\Soap\Resource\Order;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class Shipment
 *
 * @package ThreeDCart\Api\Soap\Resource\Order
 */
class Shipment extends SoapResource
{
    /** @var int */
    private $ShipmentID;
    /** @var string */
    private $ShipmentDate;
    /** @var float */
    private $Shipping;
    /** @var string */
    private $Method;
    /** @var string */
    private $FirstName;
    /** @var string */
    private $LastName;
    /** @var string */
    private $Company;
    /** @var string */
    private $Address;
    /** @var string */
    private $Address2;
    /** @var string */
    private $City;
    /** @var string */
    private $ZipCode;
    /** @var string */
    private $StateCode;
    /** @var string */
    private $CountryCode;
    /** @var string */
    private $Phone;
    /** @var float */
    private $Weight;
    /** @var string */
    private $Status;
    /** @var string */
    private $InternalComment;
    /** @var string */
    private $TrackingCode;
    
    /**
     * @return int
     */
    public function getShipmentID()
    {
        return $this->ShipmentID;
    }
    
    /**
     * @param int $ShipmentID
     */
    public function setShipmentID($ShipmentID)
    {
        $this->ShipmentID = $ShipmentID;
    }
    
    /**
     * @return string
     */
    public function getShipmentDate()
    {
        return $this->ShipmentDate;
    }
    
    /**
     * @param string $ShipmentDate
     */
    public function setShipmentDate($ShipmentDate)
    {
        $this->ShipmentDate = $ShipmentDate;
    }
    
    /**
     * @return float
     */
    public function getShipping()
    {
        return $this->Shipping;
    }
    
    /**
     * @param float $Shipping
     */
    public function setShipping($Shipping)
    {
        $this->Shipping = $Shipping;
    }
    
    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->Method;
    }
    
    /**
     * @param string $Method
     */
    public function setMethod($Method)
    {
        $this->Method = $Method;
    }
    
    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }
    
    /**
     * @param string $FirstName
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
    }
    
    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->LastName;
    }
    
    /**
     * @param string $LastName
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;
    }
    
    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->Company;
    }
    
    /**
     * @param string $Company
     */
    public function setCompany($Company)
    {
        $this->Company = $Company;
    }
    
    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->Address;
    }
    
    /**
     * @param string $Address
     */
    public function setAddress($Address)
    {
        $this->Address = $Address;
    }
    
    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->Address2;
    }
    
    /**
     * @param string $Address2
     */
    public function setAddress2($Address2)
    {
        $this->Address2 = $Address2;
    }
    
    /**
     * @return string
     */
    public function getCity()
    {
        return $this->City;
    }
    
    /**
     * @param string $City
     */
    public function setCity($City)
    {
        $this->City = $City;
    }
    
    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->ZipCode;
    }
    
    /**
     * @param string $ZipCode
     */
    public function setZipCode($ZipCode)
    {
        $this->ZipCode = $ZipCode;
    }
    
    /**
     * @return string
     */
    public function getStateCode()
    {
        return $this->StateCode;
    }
    
    /**
     * @param string $StateCode
     */
    public function setStateCode($StateCode)
    {
        $this->StateCode = $StateCode;
    }
    
    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->CountryCode;
    }
    
    /**
     * @param string $CountryCode
     */
    public function setCountryCode($CountryCode)
    {
        $this->CountryCode = $CountryCode;
    }
    
    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->Phone;
    }
    
    /**
     * @param string $Phone
     */
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;
    }
    
    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->Weight;
    }
    
    /**
     * @param float $Weight
     */
    public function setWeight($Weight)
    {
        $this->Weight = $Weight;
    }
    
    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->Status;
    }
    
    /**
     * @param string $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
    }
    
    /**
     * @return string
     */
    public function getInternalComment()
    {
        return $this->InternalComment;
    }
    
    /**
     * @param string $InternalComment
     */
    public function setInternalComment($InternalComment)
    {
        $this->InternalComment = $InternalComment;
    }
    
    /**
     * @return string
     */
    public function getTrackingCode()
    {
        return $this->TrackingCode;
    }
    
    /**
     * @param string $TrackingCode
     */
    public function setTrackingCode($TrackingCode)
    {
        $this->TrackingCode = $TrackingCode;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitOrderShipment($this);
    }
}
