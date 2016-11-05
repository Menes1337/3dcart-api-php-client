<?php

namespace ThreeDCart\Api\Soap\Resources\Customer;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class Address extends SoapResource
{
    /** @var string */
    private $FirstName;
    /** @var string */
    private $LastName;
    /** @var string */
    private $Address;
    /** @var string */
    private $Address2;
    /** @var string */
    private $City;
    /** @var string */
    private $StateCode;
    /** @var string */
    private $ZipCode;
    /** @var string */
    private $CountryCode;
    /** @var string */
    private $Company;
    /** @var string */
    private $Phone;
    /** @var string */
    private $Email;
    
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
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }
    
    /**
     * @param string $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitCustomerAddress($this);
    }
}
