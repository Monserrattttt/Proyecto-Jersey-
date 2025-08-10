<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['cantidades']) && is_array($_POST['cantidades'])) {
        foreach ($_POST['cantidades'] as $index => $cantidad) {
            if (isset($_SESSION['carrito'][$index])) {
                $_SESSION['carrito'][$index]['cantidad'] = max(1, intval($cantidad));
            }
        }
    }

    if (isset($_POST['eliminar']) && is_array($_POST['eliminar'])) {
        foreach ($_POST['eliminar'] as $index) {
            if (isset($_SESSION['carrito'][$index])) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

header("Location: carrito.php");
exit();
?>
