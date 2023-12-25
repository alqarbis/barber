<?php

$dns ="mysql:host=localhost;dbname=barbership";//charset=utf8
$user ="root";
$pass ="";

$option =array(
    PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",
);




try{
   $conn = new PDO($dns , $user ,$pass ,$option);
    
}
catch(PDOException $e){
    echo $e->getMessage();
}