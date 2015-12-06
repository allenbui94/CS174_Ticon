<?php
require 'php/connection.php';
$orderID = "";
$orderTime  = "N/A";
$shippingType  = "Unknown";
$shippingPrice = "Unknown";
$tax = "Unknown";
$products = "No products bought";

if (isset($_GET['orderID'])) {
    $query   = "SELECT * FROM orderedItems join orderInfo on orderedItems.orderID = orderInfo.orderID WHERE orderID = "+orderID+";";
    $results = db2_exec($_SESSION['connection'], $query);
    //only one entry
    while ($row = db2_fetch_object($results)) {
        $orderID = $row->orderID;
        $orderTime  = $row->orderTime;
        $shippingType = $row ->shippingType;
        $shippingPrice = $row->shippingPrice;
        $tax = $row->tax;
        $productID  = $row->productID;
    }
}
