<?php
function getProducts($pdo)
{
    $sql = "select product_id as ID, name as Name, product_type as Product_Type, price as Price, description as Description, qty as Stock, photo as Photo from products";
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
    return $products;
}

function getSpecificProduct($pdo, $id)
{
    $sql = "SELECT * FROM products WHERE product_id= :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    return $product;
}

function nullConvert($string)
{
    if (strlen($string) == 0) {
        return null;
    } else
        return $string;
}

function getUsers($pdo)
{
    $sql = "SELECT user_id,name,email,address,phone,user_type,password FROM users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchALL(PDO::FETCH_ASSOC);
    return $users;
}

function getOrderByUser($pdo, $user_id)
{
    $sql = "SELECT order_id FROM orders WHERE user_id= :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => $user_id]);
    $orders = $stmt->fetchALL(PDO::FETCH_ASSOC);
    return $orders;
}

function getProductsByType($pdo, $type)
{
    switch ($type) {
        case 'knives':
            $sql = "SELECT * FROM products WHERE product_type = :product_type";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':product_type' => 'Kitchen Knives']);
            $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $products;
        case 'cookware':
            $sql = "SELECT * FROM products WHERE product_type = :product_type";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':product_type' => 'Cookware']);
            $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $products;
        case 'appliances':
            $sql = "SELECT * FROM products WHERE product_type = :product_type";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':product_type' => 'Appliances']);
            $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $products;
        case 'accessories':
            $sql = "SELECT * FROM products WHERE product_type = :product_type";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':product_type' => 'Accessories']);
            $products = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $products;
        default:
            $products = getProducts($pdo);
            return $products;
    }
}
