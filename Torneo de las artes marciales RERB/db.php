<?php
$host = 'localhost';
$db = 'torneo_db';
$user = 'root';
$password = '';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$db, $user, $password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexion: " . $e->getMessage());
}
?>