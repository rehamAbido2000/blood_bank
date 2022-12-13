<?php 
ob_start();
session_start();
include 'init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])){
    $order_idd=$_POST['order_id'];
    $stmt = $con->prepare("DELETE FROM purchase_order WHERE id = :order_id");
    $stmt->bindParam(":order_id" , $order_idd);
    $stmt->execute();
    header("Location:qrcode_reader.php");
}else{
    header("Location:qrcode_reader.php");
}

?>