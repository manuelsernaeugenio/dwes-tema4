<?php

session_start();

if (isset($_SESSION['usuario'])) {
    header('location: index.php');
    exit();
}

require 'lib/gestionUsuarios.php';

$errorLogin = false;

if ($_POST) {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $clave = isset($_POST['clave']) ? $_POST['clave'] : '';

    $login = loginUsuario($usuario, $clave);

    if ($login) {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
        exit();
    } else {
        $errorLogin = true;
    }
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
            <li><a href="index.php">Home</a></li>
            <li><a href="pagina_publica.php">Página pública</a></li>
            <?= isset($_SESSION['usuario']) ? "<li><strong><a href='privado/pagina_privada.php'>Página privada</a></strong></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/tienda.php'>Tienda</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/carrito.php'>Carrito (" . getTotalQuantity() . ")</a></li>" : "" ?>
            <?= isset($_SESSION['usuario']) ? "<li><a href='privado/logout.php'>Cerrar sesión (" . $_SESSION['usuario'] . ")</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='login.php'><strong>Iniciar sesión</strong></a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='registro.php'>Regístrate</a></li>" : "" ?>
        </ul>
    </nav>

    <main>
        <h1>Inicia sesión</h1>
        <?= $errorLogin == true ? "El usuario o la contraseña son erroneos." : "" ?>

        <form action="login.php" method="post">
            <p>
                <label for="usuario">Nombre de usuario</label><br>
                <input type="text" name="usuario" id="usuario" value="<?= $_POST && isset($_POST['usuario']) ? $_POST['usuario'] : '' ?>">
            </p>
            <p>
                <label for="clave">Contraseña</label><br>
                <input type="password" name="clave" id="clave">
            </p>
            <p>
                <input type="submit" value="Inicia sesión">
            </p>
        </form>
    </main>

    <footer>
        <small>&copy; sitio web</small>
    </footer>
</body>

</html>