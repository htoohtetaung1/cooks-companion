<?php
include("connect.php");
$id=$_GET['id'];
    $sql="DELETE FROM feedback WHERE feedback_id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(params: [
        ':id'=> $id,
    ]);
    echo "Feedback deleted successfully!";

header("Location: customer_feedback.php");

?>