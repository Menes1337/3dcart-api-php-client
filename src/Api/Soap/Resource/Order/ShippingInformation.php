<?php

namespace ThreeDCart\Api\Soap\Resource\Order;

use ThreeDCart\Api\Soap\Resource\SoapResource;
use ThreeDCart\Api\Soap\Resource\VisitorInterface;

/**
 * Class ShippingInformation
 *
 * @package ThreeDCart\Api\Soap\Resource\Order
 */
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
