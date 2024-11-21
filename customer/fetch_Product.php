<?php
include("connect.php");

function fetchProducts($pdo, $productType)
{
    switch ($productType) {
        case "newest":
            $sql = "SELECT * FROM products ORDER BY product_id DESC";
            break;
        case "promos":
            $sql = "SELECT * FROM products ORDER BY discount_percent DESC";
            break;
        case "knives":
            $sql = "SELECT * FROM products WHERE product_type = 'Kitchen Knives'";
            break;
        case "cookware":
            $sql = "SELECT * FROM products WHERE product_type = 'Cookware'";
            break;
        case "accessories":
            $sql = "SELECT * FROM products WHERE product_type = 'Accessories'";
            break;
        case "appliances":
            $sql = "SELECT * FROM products WHERE product_type = 'Appliances'";
            break;
        default :
            $sql = "SELECT * FROM products";
    }
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
    return $products;
}

?>