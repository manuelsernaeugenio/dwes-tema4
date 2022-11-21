<?php
require '../modelo.php';

session_start();

if (!$_SESSION || !isset($_SESSION['usuario'])) {
    header('HTTP/1.0 401 Unauthorized');
    echo "No puedes acceder a esta página, <a href='../login.php'>inicia sesión</a>";
    exit();
}

function sanitize($post)
{
    return htmlspecialchars(trim($post));
}


if ($_POST) {

    $productoInput = array_key_exists('producto', $_POST) ? $_POST['producto'] : null;
    $cantidadInput = array_key_exists('cantidad', $_POST) ? $_POST['cantidad'] : null;

    if (!isset($_SESSION['productos'])) {
        $_SESSION['productos'] = array();
    }

    if (existe($_POST['producto']) && $_POST['cantidad'] > 0) {
        $producto = [
            'name' => $productoInput,
            'cantidad' => $cantidadInput
        ];

        array_push($_SESSION['productos'], $producto);
    }
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
            <?= isset($_SESSION['usuario']) ? "<li><strong><a href='tienda.php'>Tienda</a></strong></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='carrito.php'>Carrito (" . getTotalQuantity() . ")</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='logout.php'>Cerrar sesión (" . $_SESSION['usuario'] . ")</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='../login.php'>Iniciar sesión</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='../registro.php'>Regístrate</a></li>" : "" ?>
        </ul>
    </nav>

    <main>
        <section>
            <form action="" method="post">
                <p>
                    <label for="producto">Elige un producto</label>
                    <select name="producto" id="producto">
                        <?php
                        foreach ($productos as $producto) {
                            echo "<option value='{$producto['id']}'>{$producto['valor']}</option>";
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="cantidad">Elige la cantidad</label>
                    <input type="number" name="cantidad" id="cantidad">
                </p>
                <p>
                    <input type="submit" value="Añadir al carrito">
                </p>
            </form>
        </section>
    </main>

    <footer>
        <small><em>&copy; El SuperCarrito de la compra</em></small>
    </footer>
</body>

</html>