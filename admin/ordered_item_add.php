<?php
include("connect.php");
include("data.php");
$oi_id = "";
$product_id = $_GET['product_id'];
$order_id = $_GET['o_id'];
$qty = $_GET['qty'];
$buying_price;
$total_items_price;

$product = getSpecificProduct($pdo, $product_id);
$price = (int)$product['price'];
$discount_percent = (int) $product['discount_percent'];
$discount = (100 - $discount_percent) / 100;
$buying_price = $price * $discount;
$total_items_price = $buying_price * $qty;

var_dump($oi_id, $product_id, $order_id, $qty, $price, $buying_price, $total_items_price);

try {

    $sql = "INSERT INTO ordered_items
            VALUES (
                :oi_id,
                :product_id,
                :order_id,
                :qty,
                :buying_price,
                :total_items_price
            )
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('oi_id', $oi_id, PDO::PARAM_INT);
    $stmt->bindParam('product_id', $product_id, PDO::PARAM_INT);
    $stmt->bindParam('order_id', $order_id, PDO::PARAM_INT);
    $stmt->bindParam('qty', $qty, PDO::PARAM_INT);
    $stmt->bindParam('buying_price', $buying_price, PDO::PARAM_INT);
    $stmt->bindParam('total_items_price', $total_items_price, PDO::PARAM_INT);
    $stmt->execute();
    echo "Item added successfully!";

    header("Location: order_edit.php?id=" . $order_id);
} catch (Exception $e) {
    die("Couldn't add product to order" . $e->getMessage());
}
