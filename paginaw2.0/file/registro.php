<?php
// Incluir archivo de configuración para la conexión a la base de datos
include('configuracion.php');

// Comprobar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario_reg'];
    $password = $_POST['password_reg'];
    $confirmar_password = $_POST['confirmar_password_reg'];

    // Validar que las contraseñas coincidan
    if ($password !== $confirmar_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Comprobar si el correo electrónico ya está registrado
    $sql_correo = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql_correo);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
        exit;
    }

    // Comprobar si el nombre de usuario ya está registrado
    $sql_usuario = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql_usuario);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "El nombre de usuario ya está registrado.";
        exit;
    }

    // Encriptar la contraseña antes de guardarla
    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $sql_insertar = "INSERT INTO usuarios (nombre, correo, usuario, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insertar);
    $stmt->bind_param("ssss", $nombre, $correo, $usuario, $password_encriptada);

    if ($stmt->execute()) {
        echo "Registro exitoso. Ahora puedes <a href='login.php'>iniciar sesión</a>";
    } else {
        echo "Error en el registro: " . $conn->error;
    }
}
?>
