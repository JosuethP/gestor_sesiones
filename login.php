<?php
session_start();
$conexion = new mysqli("localhost:3307", "root", "", "gestion_sesiones");
if ($conexion->connect_error) die("Error de conexión: " . $conexion->connect_error);

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $_SESSION['captcha_result'] = $num1 + $num2;
    $_SESSION['captcha_num1'] = $num1;
    $_SESSION['captcha_num2'] = $num2;
} else {
    $num1 = $_SESSION['captcha_num1'];
    $num2 = $_SESSION['captcha_num2'];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $captcha_user = $_POST['captcha'] ?? '';

    if (!isset($_SESSION['captcha_result']) || $captcha_user != $_SESSION['captcha_result']) {
        $mensaje = "<p class='error'>CAPTCHA incorrecto. Intenta de nuevo.</p>";
    } else {
        
        unset($_SESSION['captcha_result']);// este codigo limpiara el captcha

    $stmt = $conexion->prepare("SELECT id, nombre, contraseña FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        if ($contraseña === $fila['contraseña']) {
            $_SESSION['usuario_id'] = $fila['id'];
            $_SESSION['usuario_nombre'] = $fila['nombre'];
            header("Location: html/index.php");
            exit;
        } else {
            $mensaje = "<p class='error'>Contraseña incorrecta.</p>";
        }
    } else {
        $mensaje = "<p class='error'>El correo no está registrado.</p>";
    }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="form-container">
    <h2>Iniciar sesión</h2>
    <?php echo $mensaje; ?>
    <form method="POST" action="">
        <div class="input-group">
            <label>Correo electrónico</label>
            <input type="email" name="correo" required>
        </div>

        <div class="input-group">
            <label>Contraseña</label>
            <input type="password" name="contraseña" required>
        </div>

        <div class="input-group">
            <label>¿Cuánto es <?php echo $num1; ?> + <?php echo $num2; ?>?</label>
            <input type="text" name="captcha" required>
        </div>

        <button type="submit">Entrar</button>
        <p class="alt-option">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
    </form>
</div>
</body>
</html>
