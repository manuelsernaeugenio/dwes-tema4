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
            <li><a href="index.php"><strong>Home</strong></a></li>
            <li><a href="pagina_publica.php">Página pública</a></li>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/pagina_privada.php'>Página privada</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/tienda.php'>Tienda</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/carrito.php'>Carrito (" . getTotalQuantity() . ")</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/logout.php'>Cerrar sesión (" . $_SESSION['usuario'] . ")</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='login.php'>Iniciar sesión</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='registro.php'>Regístrate</a></li>" : "" ?>
        </ul>
    </nav>

    <main>
        <section>
            <article>
                <h1>Página inicial</h1>
                <p>
                    Esta es la página principal de la web de ejemplo con un sistema de autenticación
                    de usuarios con PHP.
                </p>
            </article>
        </section>
    </main>

    <footer>
        <small>&copy; sitio web</small>
    </footer>
</body>

</html>