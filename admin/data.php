<?php
function getProducts($pdo){
    $sql= "select product_id as ID, product_name as Name, product_category as Category,  product_stock as Stock, product_price as Price, product_image as Image from products";
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
?>