<?php
$conexion = new mysqli("localhost", "root", "", "login_db");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$clave = $_POST['clave'];
$repetir_clave = $_POST['repetir_clave'];

if ($clave != $repetir_clave) {
    echo "<h3>Las claves no coinciden</h3><a href='registro.html'>Volver</a>";
    exit();
}

$hoy = date('Y-m-d');
$edad = date_diff(date_create($fecha_nacimiento), date_create($hoy))->y;

if ($edad < 18) {
    echo "<h3>Debes ser mayor de 18 años para registrarte</h3><a href='registro.html'>Volver</a>";
    exit();
}

$sql_verificar = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$resultado = $conexion->query($sql_verificar);

if ($resultado->num_rows > 0) {
    echo "<h3>El nombre de usuario ya existe</h3><a href='registro.html'>Volver</a>";
    exit();
}

$clave_md5 = md5($clave);
$sql_insertar = "INSERT INTO usuarios (usuario, clave, correo, fecha_nacimiento)
                 VALUES ('$usuario', '$clave_md5', '$correo', '$fecha_nacimiento')";

if ($conexion->query($sql_insertar) === TRUE) {
    echo "<h3>Usuario registrado exitosamente</h3><a href='index.html'>Iniciar Sesión</a>";
} else {
    echo "Error: " . $conexion->error;
}

$conexion->close();
?>
