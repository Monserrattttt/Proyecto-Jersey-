<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jersey Pro - Inicio</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<link rel="stylesheet" href="css/index.css">

<body>

    <!-- Barra superior -->
    <header class="top-bar">
        <img src="img/LogoJersey.jpg" alt="Logo" class="logo">
        <h1 class="titulo-barra">Bienvenidos a Jersey Pro</h1>
    </header>


    <!-- Barra de navegación -->
    <nav class="nav-bar">
        <a href="galeria.php" class="nav-btn">Catálogo de Jersey</a>
        <a href="contacto.php" class="nav-btn">Contacto</a>
        <a href="logout.php" class="nav-btn cerrar">Cerrar sesión</a>
    </nav>

    <!-- Contenido principal -->
    <main>
        <h2>Explora nuestros productos</h2>
        <p>Selecciona una categoría para comenzar</p>
        
        <!-- Sección de información de la marca -->
<section class="info-marca">
    <h3>Sobre Jersey Pro</h3>
    <p>En <strong>Jersey Pro</strong> nos apasiona el fútbol tanto como a ti. 
       Ofrecemos jerseys originales de tus equipos favoritos, con la mejor calidad y al mejor precio. 
       ¡Luce tu pasión en cada partido!</p>
</section>
    </main>
</body>
</html>
