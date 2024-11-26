<?php
function getProducts($pdo){
    $sql= "select product_id as ID, name as Name, product_type as Product_Type, price as Price, description as Description, qty as Stock, discount_percent as Discount, photo as Photo from products";
    $stmt=$pdo->query($sql);
    $products=$stmt->fetchALL(PDO::FETCH_ASSOC);
    return $products;
}

function getSpecificProduct($pdo, $id){
    $sql="SELECT * FROM products WHERE product_id= :id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([':id'=> $id]);
    $product =$stmt->fetch(PDO::FETCH_ASSOC);
    return $product;
}

function getSpecificUser($pdo, $id){
    $sql="SELECT * FROM users WHERE user_id= :id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([':id'=> $id]);
    $user =$stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function nullConvert($string) {
    if (strlen($string) == 0) {
        return null;
    }
    else 
        return $string;
}

function getUsers($pdo)
{
    $sql = "SELECT user_id,name,email,address,phone,user_type,password FROM users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchALL(PDO::FETCH_ASSOC);
    return $users;
}

function getOrders($pdo)
{
    $sql = "SELECT user_id,name,email,address,phone,user_type,password FROM users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchALL(PDO::FETCH_ASSOC);
    return $users;
}

function getSpecificOrder($pdo, $id){
    $sql="SELECT * FROM orders WHERE order_id= :id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([':id'=> $id]);
    $order =$stmt->fetch(PDO::FETCH_ASSOC);
    return $order;
}


?>
