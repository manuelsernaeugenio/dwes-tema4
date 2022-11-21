<?php

session_start();

if (isset($_SESSION['usuario'])) {
    header('location: index.php');
    exit();
}

require 'lib/gestionUsuarios.php';

$errores = [];
$imprimirFormulario = true;

if ($_POST) {
    $errores = registroUsuario(
        isset($_POST['usuario']) ? $_POST['usuario'] : '',
        isset($_POST['clave']) ? $_POST['clave'] : '',
        isset($_POST['repite_clave']) ? $_POST['repite_clave'] : ''
    );

    if ($errores == null) {
        $imprimirFormulario = false;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro de usuarios</title>
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
            <?= !isset($_SESSION['usuario']) ? "<li><a href='login.php'>Iniciar sesión</a></li>" : "" ?>
            <?= !isset($_SESSION['usuario']) ? "<li><a href='registro.php'><strong>Regístrate</strong></a></li>" : "" ?>
        </ul>
    </nav>

    <main>
        <h1>Regístrate</h1>
        <?php if ($imprimirFormulario) { ?>
            <form action="registro.php" method="post">
                <p>
                    <label for="usuario">Nombre de usuario</label><br>
                    <input type="text" name="usuario" id="usuario" value="<?= isset($_POST['usuario']) ? $_POST['usuario'] : null ?>">
                </p>
                <p><?= isset($errores['usuario']) ? $errores['usuario'] : "" ?></p>
                <p>
                    <label for="clave">Contraseña</label><br>
                    <input type="password" name="clave" id="clave">
                </p>
                </p><?= isset($errores['clave']) ? $errores['clave'] : "" ?></p>
                <p>
                    <label for="repite_clave">Repite la contraseña</label><br>
                    <input type="password" name="repite_clave" id="repite_clave">
                </p>
                <p>
                    <input type="submit" value="Registrarse">
                </p>
            </form>
        <?php } else {
            echo "Registro completado. Ve a la pestaña de <a href='login.php'>inicio de sesión</a>";
        } ?>
    </main>

    <footer>
        <small>&copy; sitio web</small>
    </footer>
</body>

</html>