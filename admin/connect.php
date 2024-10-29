<?php
$severname="localhost";
$username="root";
$password="";
$dbname="ecom_database1";
try{
    $pdo=new PDO("mysql:host=$severname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (Exception $e){
    die("Fail to Connect".$e->getMessage());
}
?>