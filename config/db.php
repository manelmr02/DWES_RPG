<?php
//Configuracion de la base de datos

$host = 'localhost';
$dbname = 'dwes_t3_rpg';
$username = 'root';
$password = '';


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
    echo "Conexion realizada";
} catch (PDOException $exception) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
};

/*
Php
Data
Object
*/