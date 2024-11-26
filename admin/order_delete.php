<?php
include("connect.php");
$id=$_GET['id'];
    $sql="DELETE FROM orders WHERE order_id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(params: [
        ':id'=> $id,
    ]);
    echo "Order deleted successfully!";

header("Location: order_table.php");

?>