<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$hoy = date('Y-m-d');
$fecha_nacimiento = $_SESSION['fecha_nacimiento'];
$edad = date_diff(date_create($fecha_nacimiento), date_create($hoy))->y;

$consejos = [
    "Escucha más de lo que hablas.",
    "Ayuda a los demás sin esperar nada a cambio.",
    "Sé amable contigo mismo.",
    "Practica la gratitud todos los días.",
    "Aprende algo nuevo cada semana.",
    "Evita compararte con los demás.",
    "Perdona a quienes te han hecho daño."
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>¡Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h2>
        <p><strong>Correo:</strong> <?php echo $_SESSION['correo']; ?></p>
        <p><strong>Edad:</strong> <?php echo $edad; ?> años</p>

        <h3>Consejos para ser mejor persona:</h3>
        <ul class="consejos">
            <?php foreach ($consejos as $c): ?>
                <li><?php echo $c; ?></li>
            <?php endforeach; ?>
        </ul>

        <br>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>
</body>
</html>
