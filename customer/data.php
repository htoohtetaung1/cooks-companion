<?php
function getProducts($pdo){
    $sql= "select product_id as ID, name as Name, product_type as Product_Type, price as Price, description as Description, qty as Stock, photo as Photo from products";
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

function nullConvert($string) {
    if (strlen($string) == 0) {
        return null;
    }
    else 
        return $string;
}

?>
