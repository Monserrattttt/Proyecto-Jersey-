<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . "/config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $correo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        // Verificamos la contraseña con hash
        if (password_verify($password, $fila['password'])) {
            
            $_SESSION['usuario'] = $fila['correo'];
            $_SESSION['rol'] = $fila['rol'];

            // Si es admin lo mandamos al panel
            if ($fila['rol'] === 'admin') {
                header("Location: admin_panel.php?seccion=jerseys");
            } else {
                // Usuario normal
                header("Location: index.php");
            }
            exit();

        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<link rel="stylesheet" href="css/estilos.css">
<body>
    <div class="form-box">
        <img src="img/login.png" alt="Logo jersey" class="logo">
        <h1 class="titulo">Jersey Pro ⚽</h1>

        <h2>Iniciar Sesión</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
    </div>
</body>
</html>
