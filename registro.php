<?php
$conexion = new mysqli("localhost:3307", "root", "", "gestion_sesiones");
if ($conexion->connect_error) die("Error de conexión: " . $conexion->connect_error);

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if (empty($nombre) || empty($correo) || empty($contraseña)) {
        $mensaje = "<p class='error'>Por favor, completa todos los campos obligatorios.</p>";
    } else {
        // Verificar si el correo ya existe
        $verificar = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $verificar->bind_param("s", $correo);
        $verificar->execute();
        $verificar->store_result();

        if ($verificar->num_rows > 0) {
            $mensaje = "<p class='error'>El correo ya está registrado.</p>";
        } else {
            // Insertar nuevo usuario
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, correo, contraseña) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $apellido, $correo, $contraseña);
            if ($stmt->execute()) {
                $mensaje = "<p class='exito'>Usuario registrado correctamente. <a href='login.php'>Inicia sesión aquí</a>.</p>";
            } else {
                $mensaje = "<p class='error'>Error al registrar el usuario.</p>";
            }
            $stmt->close();
        }
        $verificar->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="form-container">
    <h2>Registro de usuario</h2>
    <?php echo $mensaje; ?>
    <form method="POST" action="">
        <div class="input-group">
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>
        <div class="input-group">
            <label>Apellido</label>
            <input type="text" name="apellido" required>
        </div>
        <div class="input-group">
            <label>Correo electrónico</label>
            <input type="email" name="correo" required>
        </div>
        <div class="input-group">
            <label>Contraseña</label>
            <input type="password" name="contraseña" required>
        </div>
        <button type="submit">Registrarse</button>
        <p class="alt-option">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
    </form>
</div>
</body>
</html>
