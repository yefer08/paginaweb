<?php

// Configuración de la base de datos
$servername = "localhost";  // Cambia esto si no usas localhost
$username = "root";         // Nombre de usuario de la base de datos
$password = "";             // Contraseña de la base de datos
$dbname = "yeye_games";     // Nombre de la base de datos



// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>
