<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['vaciar_carrito'])) {
    unset($_SESSION['carrito']);
    header("Location: carrito.php");
    exit();
}

$carrito = $_SESSION['carrito'];
$total = 0;

foreach ($carrito as $producto) {
    $total += $producto['precio'] * $producto['cantidad'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/galeria.css">
    <style>
        .barra-superior {
            background-color: #0056b3;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #004c99;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color: #f4f4f4;
        }
        input[type="number"] {
            width: 60px;
            padding: 5px;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 5%;
        }
    </style>
</head>
<body>

<div class="barra-superior">
    <a href="galeria.php" class="btn">🔙 Seguir Comprando</a>
    <a href="index.php" class="btn">🏠 Inicio</a>
</div>

<h1 style="text-align:center;">🛒 Tu Carrito</h1>

<?php if (!empty($carrito)) { ?>
<form action="actualizar_carrito.php" method="post">
    <table>
        <tr>
            <th>Eliminar</th>
            <th>Producto</th>
            <th>Talla</th>
            <th>Nombre</th>
            <th>Número</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($carrito as $index => $item): ?>
        <tr>
            <td>
                <input type="checkbox" name="eliminar[]" value="<?php echo $index; ?>">
            </td>
            <td><?php echo htmlspecialchars($item['equipo']); ?></td>
            <td><?php echo htmlspecialchars($item['talla']); ?></td>
            <td><?php echo htmlspecialchars($item['nombre']); ?></td>
            <td><?php echo htmlspecialchars($item['numero']); ?></td>
            <td><?php echo "$" . number_format($item['precio'], 2); ?></td>
            <td>
                <input type="number" name="cantidades[<?php echo $index; ?>]" 
                       value="<?php echo $item['cantidad']; ?>" min="1">
            </td>
            <td><?php echo "$" . number_format($item['precio'] * $item['cantidad'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="total">Total: $<?php echo number_format($total, 2); ?></div>

    <div style="text-align:center; display:flex; gap:10px; justify-content:center; flex-wrap:wrap;">
        <button type="submit" class="btn">Actualizar Carrito</button>
        <a href="pago.php" class="btn" style="background: green;">Finalizar Compra</a>
    </div>
</form>

<form method="POST" style="text-align:center; margin-top:10px;">
    <button type="submit" name="vaciar_carrito" class="btn" style="background:red;">
        🗑 Vaciar carrito
    </button>
</form>

<?php } else { ?>
    <p style="text-align:center;">Tu carrito está vacío</p>
<?php } ?>

</body>
</html>
