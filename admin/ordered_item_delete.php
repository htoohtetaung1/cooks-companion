<?php
include("connect.php");
$order_id = $_GET['o_id'];
$id=$_GET['od_id'];
    $sql="DELETE FROM ordered_items WHERE ordered_items_id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(params: [
        ':id'=> $id,
    ]);
    echo "Item deleted successfully!";

header("Location: order_edit.php?id=".$order_id);

?>