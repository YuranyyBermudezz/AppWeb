<?php

include_once './config.php';
include_once './conexion_be.php';
include_once './registro_usuario_be.php';
include_once './RepositorioUsuario.php';
include_once './ValidarRegistro.php';

Conexion::abrirConexion();
$conexion = Conexion::obtenerConexion();

$validador = new ValidadorRegistro($_POST['nombrecompleto'], $_POST['correo'], $_POST['telefono'], $_POST['usuario'], htmlspecialchars($_POST['password1']), $conexion);

if ($validador->registroValido()) {
    $usuario = new registro_usuario_be('', $validador->obtenerNombre(), $validador->obtenerCorreo(), $validador->obtenerTelefono(), $validador->obtenerUsuario(), password_hash($validador->obtenerPassword(), PASSWORD_DEFAULT));
    $usuarioInsertado = RepositorioUsuario::insertarUsuario($conexion, $usuario);

    if ($usuarioInsertado) {
        echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'errorGeneral' => 'No se pudo registrar el usuario. Inténtelo de nuevo.']);
    }
} else {
    $error = array(
        'errorNombrecompleto' => $validador->obtenerErrorNombreCompleto(),
        'errorCorreo' => $validador->obtenerErrorCorreo(),
        'errorTelefono' => $validador->obtenerErrorTelefono(),
        'errorUsuario' => $validador->obtenerErrorUsuario(),
        'errorPassword' => $validador->obtenerErrorPassword(),
    );

    echo json_encode(['success' => false, 'errors' => $error]);
}

Conexion::cerrarConexion();

?>