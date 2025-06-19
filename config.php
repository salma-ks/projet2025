<?php
$dsn="mysql:host=localhost;dbname=projetassociations2025";
$user="root";
$pass= "";

try{
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    echo "error de connexion". $e->getMessage();
}


?>