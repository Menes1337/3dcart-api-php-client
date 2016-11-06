<?php

namespace ThreeDCart\Api\Soap\Resources\Order;

use ThreeDCart\Api\Soap\Resources\SoapResource;
use ThreeDCart\Api\Soap\Resources\VisitorInterface;

class ShippingInformation extends SoapResource
{
    /** @var Shipment */
    private $Shipment;
    /** @var Item[] */
    private $OrderItems;
    
    /**
     * @return Shipment
     */
    public function getShipment()
    {
        return $this->Shipment;
    }
    
    /**
     * @param Shipment $Shipment
     */
    public function setShipment($Shipment)
    {
        $this->Shipment = $Shipment;
    }
    
    /**
     * @return Item[]
     */
    public function getOrderItems()
    {
        return $this->OrderItems;
    }
    
    /**
     * @param Item[] $OrderItems
     */
    public function setOrderItems($OrderItems)
    {
        $this->OrderItems = $OrderItems;
    }
    
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitOrderShippingInformation($this);
    }
}
