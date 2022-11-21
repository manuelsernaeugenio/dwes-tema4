<?php
require 'modelo.php';
session_start();

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
            <li><a href="index.php">Home</a></li>
            <li><a href="pagina_publica.php"><strong>Página pública</strong></a></li>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/pagina_privada.php'>Página privada</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/tienda.php'>Tienda</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/carrito.php'>Carrito (" . getTotalQuantity() . ")</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/logout.php'>Cerrar sesión (" . $_SESSION['usuario'] . ")</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='login.php'><strong>Iniciar sesión</strong></a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='registro.php'>Regístrate</a></li>" : "" ?>
        </ul>
    </nav>

    <main>
        <section>
            <article>
                <h1>Página pública</h1>
                <p>
                    Esta es la página pública, aquí puede acceder todo el mundo, estén o
                    registrados y hayan o no iniciado sesión.
                </p>
            </article>
        </section>
    </main>

    <footer>
        <small>&copy; sitio web</small>
    </footer>
</body>

</html>