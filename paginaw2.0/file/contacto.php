<?php
// Incluir el archivo de configuración para la conexión a la base de datos
include('configuracion2.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener y sanitizar los datos del formulario
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $correo = htmlspecialchars(trim($_POST['email']));
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));

    // Validar el correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico no válido.";
        exit();
    }

    // Insertar los datos en la base de datos
    $sql_insertar = "INSERT INTO contactos (nombre, correo, mensaje) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insertar);  // Usar la conexión incluida desde 'configuracion.php'
    $stmt->bind_param("sss", $nombre, $correo, $mensaje);  // "sss" indica que son 3 cadenas

    if ($stmt->execute()) {
        // Mostrar un alert de éxito y redirigir a la página principal
        echo "<script>
                alert('¡Mensaje enviado con éxito!');
                window.location.href =  '../index.html';  // Redirige a index.html desde la subcarpeta
              </script>";
        exit();
    } else {
        echo "Error en el registro: " . $conn->error;  // Mostrar el error si algo sale mal
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>




