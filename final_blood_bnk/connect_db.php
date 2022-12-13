<?php 

$dsn = "mysql:host=localhost;port=3307;dbname=blood_bank";
$user = "root";
$pass="";

try{
    $con = new PDO($dsn , $user , $pass);
    
}catch(PDOException $e){
    echo "error" . $e->getMessage();
}


?>

