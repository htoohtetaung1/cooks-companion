<?php
function calculatePrice($product) {
    $price = $product['price'];
    $discount = 1 - ($product['discount_percent'] / 100);
    $result = $price * $discount;
    return round($result);
}   
?>