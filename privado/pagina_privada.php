<?php
require '../modelo.php';
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
    <title>Sistema de autenticación</title>
</head>

<body>
    <header>
        <h1>Sistema de autenticación</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../pagina_publica.php">Página pública</a></li>
            <?= isset($_SESSION['usuario']) ? "<li><strong><a href='pagina_privada.php'>Página privada</a></strong></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='tienda.php'>Tienda</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='carrito.php'>Carrito (" . getTotalQuantity() . ")</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='logout.php'>Cerrar sesión (" . $_SESSION['usuario'] . ")</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='../login.php'>Iniciar sesión</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='../registro.php'>Regístrate</a></li>" : "" ?>
        </ul>
    </nav>

    <main>
        <section>
            <article>
                <h1>Página privada</h1>
                <p>
                    Esta es la página privada, aquí solo debería acceder usuarios
                    registrados y que hayan iniciado sesión.
                </p>
            </article>
        </section>
    </main>

    <footer>
        <small>&copy; sitio web</small>
    </footer>
</body>

</html>