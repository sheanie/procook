<?php

namespace sheanie\procook;

use sheanie\procook\Service\Amazon;
use PDO;
use sheanie\procook\Service\Database;

class Bootstrap
{
    public function __invoke()
    {
        $config = include '../config/config.php';
        $orderList = file_get_contents('../data/ordersList.xml');
        $orderItemsList = file_get_contents('../data/orderItemsList.xml');
        $client = new Client($config['amazon']);
        $client->setOrderList($orderList);
        $client->setOrderItemsList($orderItemsList);
        $pdo = new PDO("mysql:host=" . $config['database']['host'] . ";dbname=" . $config['database']['dbname'], $config['database']['dbuser'], $config['database']['dbpass']);
        $databaseService = new Database($pdo);
        $amazonService = new Amazon($client);

        $orders = $amazonService->getOrders();
        foreach ($orders as $order)
        {
            $pk = $databaseService->saveOrder($order);
            $orderItems = $amazonService->getOrderItems($order->getAmazonOrderId());
            foreach ($orderItems as $item) {
                $databaseService->saveOrderItem($item, $pk);
            }
        }
    }
}
