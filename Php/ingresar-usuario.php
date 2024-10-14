<?php
include_once './config.php';
include_once './conexion_be.php';
include_once './registro_usuario_be.php';
include_once './RepositorioUsuario.php';
include_once './ValidadorLogin.php';

Conexion::abrirConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['correo']) && isset($_POST['password'])) {
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $validador = new ValidadorLogin($correo, $password, Conexion::obtenerConexion());

        // Verifica las credenciales
        if ($validador->obtenerError() === "" && !is_null($validador->obtenerUsuario())) {
            // Credenciales válidas, iniciar sesión y redirigir al usuario
            header('Location: /paginaweb/soluciones_nr/index.php');
            exit();
            // Aquí puedes agregar la lógica para iniciar sesión y redirigir al usuario
        } else {
            // Credenciales inválidas, mostrar un mensaje de error
            echo $validador->obtenerError();
        }
    } else {
        echo "Correo y/o contraseña no proporcionados.";
    }
} else {
    // Si no es una solicitud POST, muestra un mensaje de error
    echo "Método de solicitud no permitido.";
}

// Cierra la conexión a la base de datos
Conexion::cerrarConexion();
?>
