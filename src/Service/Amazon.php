<?php

namespace sheanie\procook\Service;

use sheanie\procook\Client;

class Amazon
{
    /**
     * @var Client;
     */
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function getOrders()
    {
        $ordersXml = $this->client->getOrders();
        $dom = new \DOMDocument();
        $dom->loadXML($ordersXml);
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $listOrdersResponse = new \MarketplaceWebServiceOrders_Model_ListOrdersResponse($dom->documentElement);
        $listOrdersResult = $listOrdersResponse->getListOrdersResult();
        $listOrders = $listOrdersResult->getOrders();

        return $listOrders;
    }

    public function getOrderItems($orderId)
    {
        $orderItemsXml = $this->client->getOrderItems($orderId);
        $dom = new \DOMDocument();
        $dom->loadXML($orderItemsXml);
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $listOrderItemsResponse = new \MarketplaceWebServiceOrders_Model_ListOrderItemsResponse($dom->documentElement);
        $listOrderItemsResult = $listOrderItemsResponse->getListOrdersResult();
        $listOrderItems = $listOrderItemsResult->getOrders();

        return $listOrderItems;
    }
}
