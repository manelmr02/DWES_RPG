<?php
require_once 'config/db.php';

//var_dump($_POST);
//echo "Nombre".$POST["name"];
//echo "Descripción".$POST["description"];

$name=$_POST["name"];
$description=$_POST["description"];

//$db->query("INSERT INTO characters (name,description) VALUES ('Manel','Manel')");
$stmt=$db->prepare("INSERT INTO characters (name,description) VALUES (:name,:description)");
$stmt->bindParam(':name',$name);
$stmt->bindParam(':description',$description);

if($stmt->execute()){
    echo "Personaje creado correctamente";
}else{
    echo "ERROR: Personaje no creado";
}