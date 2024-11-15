<?php
//Configuracion de la base de datos

$host = 'db';
$dbname = 'dwes_t3_rpg_clase';
$username = 'user';
$password = 'userpassword';


try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );
    $db->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    //echo "Conexion realizada";
} catch (PDOException $exception) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
};

/*
Php
Data
Object
*/