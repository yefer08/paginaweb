<?php
// Incluir archivo de configuración para la conexión a la base de datos
include('configuracion.php');

// Iniciar la sesión si no está iniciada
session_start();

// Comprobar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Verificar si el usuario existe
    $sql = "SELECT id, nombre, password FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar si la contraseña es correcta
        if (password_verify($password, $row['password'])) {
            // La contraseña es correcta, iniciar sesión
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            echo "Bienvenido, " . $row['nombre'] . ". Ahora estás conectado.";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }
}
?>
