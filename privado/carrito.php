<?php
include '../modelo.php';
session_start();

if (!$_SESSION || !isset($_SESSION['usuario'])) {
    header('HTTP/1.0 401 Unauthorized');
    echo "No puedes acceder a esta página, <a href='../login.php'>inicia sesión</a>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de la compra</title>
</head>

<body>
    <header>
        <h1>SuperCarrito Shop</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../pagina_publica.php">Página pública</a></li>
            <?= isset($_SESSION['usuario']) ? "<li><a href='pagina_privada.php'>Página privada</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='tienda.php'>Tienda</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><strong><a href='carrito.php'>Carrito (" . getTotalQuantity() . ")</a></strong></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='logout.php'>Cerrar sesión (" . $_SESSION['usuario'] . ")</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='../login.php'>Iniciar sesión</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='../registro.php'>Regístrate</a></li>" : "" ?>
        </ul>
    </nav>

    <main>
        <section>
            <h1>Cesta de la compra</h1>
            <ul>
                <?php
                if (isset($_SESSION['productos'])) {
                    foreach ($_SESSION['productos'] as $producto) {
                        echo "<li><b>" . getValue($producto['name']) . "</b>: " . $producto['cantidad'] . "</li>";
                    }
                } else {
                    echo "<p>No hay productos en el carrito de la compra.</p>";
                }
                ?>
            </ul>
        </section>
    </main>

    <footer>
        <small><em>&copy; El SuperCarrito de la compra</em></small>
    </footer>
</body>

</html>