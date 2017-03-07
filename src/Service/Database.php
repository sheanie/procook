<?php

namespace sheanie\procook\Service;

class Database
{
    private $database;

    /**
     * SQL string to insert Order item.
     *
     * @var string
     */
    private $insertOrderItemSql = 'INSERT INTO amazon_mws_items (ami_amo_uid, ami_ASIN, ami_SellerSKU, ami_Title, ami_QuantityOrdered,
ami_ItemPriceValue, ami_ItemPriceCurrency, ami_ShippingPriceValue, ami_ShippingPriceCurrrency) VALUES (:ami_amo_uid, :ami_ASIN, :ami_SellerSKU, :ami_Title, :ami_QuantityOrdered,
:ami_ItemPriceValue, :ami_ItemPriceCurrency, :ami_ShippingPriceValue, :ami_ShippingPriceCurrrency)';

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function saveOrder(\MarketplaceWebServiceOrders_Model_Order $order)
    {
        $stmt = $this->database->prepare("INSERT INTO amazon_mws_orders (amo_AmazonOrderId, amo_PurchaseDate, amo_OrderStatus, 
amo_FulfillmentChannel, amo_OrderTotal, amo_OrderTotalCurrency, amo_BuyerName, amo_BuyerEmail, amo_ShipmentServiceLevelCategory, amo_OrderType, 
amo_ShippingAddressName, amo_ShippingAddressLine1, amo_ShippingAddressLine2, amo_ShippingAddressLine3, amo_ShippingAddressCity, 
amo_ShippingAddressCounty, amo_ShippingAddressDistrict, amo_ShippingAddressStateOrRegion, amo_ShippingAddressPostalCode, 
amo_ShippingAddressCountryCode, amo_ShippingAddressPhone, amo_IsPrime)
    VALUES (:amo_AmazonOrderId, :amo_PurchaseDate, :amo_OrderStatus, 
:amo_FulfillmentChannel, :amo_OrderTotal, :amo_OrderTotalCurrency, :amo_BuyerName, :amo_BuyerEmail, :amo_ShipmentServiceLevelCategory,
:amo_OrderType,
:amo_ShippingAddressName, :amo_ShippingAddressLine1, :amo_ShippingAddressLine2, :amo_ShippingAddressLine3, :amo_ShippingAddressCity, 
:amo_ShippingAddressCounty, :amo_ShippingAddressDistrict, :amo_ShippingAddressStateOrRegion, :amo_ShippingAddressPostalCode, 
:amo_ShippingAddressCountryCode, :amo_ShippingAddressPhone, :amo_IsPrime)");

        $stmt->bindParam(':amo_AmazonOrderId', $order->getAmazonOrderId());
        $stmt->bindParam(':amo_PurchaseDate', $order->getPurchaseDate());
        $stmt->bindParam(':amo_OrderStatus', $order->getOrderStatus());
        $stmt->bindParam(':amo_FulfillmentChannel', $order->getFulfillmentChannel());
        $stmt->bindParam(':amo_OrderTotal', $order->getOrderTotal());
        $stmt->bindParam(':amo_OrderTotalCurrency', $order->get);
        $stmt->bindParam(':amo_BuyerName', $order->getBuyerName());
        $stmt->bindParam(':amo_BuyerEmail', $order->getBuyerEmail());
        $stmt->bindParam(':amo_ShipmentServiceLevelCategory', $order->getShipmentServiceLevelCategory());
        $stmt->bindParam(':amo_OrderType', $order->getOrderType());
        $stmt->bindParam(':amo_ShippingAddressName', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressLine1', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressLine2', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressLine3', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressCity', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressCounty', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressDistrict', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressStateOrRegion', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressPostalCode', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressCountryCode', $order->getShippingAddress());
        $stmt->bindParam(':amo_ShippingAddressPhone', $order->getShippingAddress());
        $stmt->bindParam(':amo_IsPrime', $order->getIsPrime());

        $stmt->execute();

        return $this->database->lastInsertId();
    }

    public function saveOrderItem(\MarketplaceWebServiceOrders_Model_OrderItem $item, $orderId)
    {
        $stmt = $this->database->prepare($this->insertOrderItemSql);
        $stmt->bind(':ami_amo_uid', $orderId);
        $stmt->bind(':ami_ASIN', $item->getASIN());
        $stmt->bind(':ami_SellerSKU', $item->getSellerSKU());
        $stmt->bind(':ami_Title', $item->getTitle());
        $stmt->bind(':ami_QuantityOrdered', $item->getQuantityOrdered());
        $stmt->bind(':ami_ItemPriceValue', $item->getItemPrice());
        $stmt->bind(':ami_ItemPriceCurrency', $item->getItemPrice());
        $stmt->bind(':ami_ShippingPriceValue', $item->getShippingPrice());
        $stmt->bind(':ami_ShippingPriceCurrrency', $item->getShippingPrice());

        $stmt->execute();

        return $this->database->lastInsertId();
    }
}