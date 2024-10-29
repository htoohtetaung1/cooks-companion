<?php
function showAllProducts($pdo){
$sql="select * from products";
$stmt=$pdo->query($sql);
return $stmt->fetchALL(PDO::FETCH_ASSOC);
}
function showSpecificProduct($pdo, $id){
    $sql="select * from products where product_id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        ':id'=>$id
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


?>