<?php
// Datos de conexión a tu base de datos
$servername = "192.168.1.9";
$username = "root";
$password = "nubytek";
$dbname = "nubytek_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>