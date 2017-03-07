<?php

namespace sheanie\procook;

class Client
{
    private $config;
    private $orderItemsList;
    private $orderList;
    public function __construct($config)
    {
        $this->config = $config;
    }
    public function getOrders()
    {
        return $this->orderList;
    }

    public function getOrderItems($orderId)
    {
        return $this->orderItemsList;
    }

    public function setOrderItemsList($list)
    {
        $this->orderItemsList = $list;
    }
    public function setOrderList($list)
    {
        $this->orderList = $list;
    }
}