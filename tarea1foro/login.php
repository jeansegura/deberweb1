<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "login_db");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$usuario = $_POST['usuario'];
$clave = md5($_POST['clave']);

$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows == 1) {
    $datos = $resultado->fetch_assoc();
    $_SESSION['usuario'] = $datos['usuario'];
    $_SESSION['correo'] = $datos['correo'];
    $_SESSION['fecha_nacimiento'] = $datos['fecha_nacimiento'];
    header("Location: bienvenido.php");
    exit();
} else {
    echo "<h3>Usuario o clave incorrectos</h3><a href='index.html'>Volver</a>";
}

$conexion->close();
?>
