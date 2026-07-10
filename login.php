<?php

session_start();

if (isset($_SESSION["usuario"])) {

    header("Location: index.php");

    exit();
}

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>

    <div class="loginContainer">

        <div class="loginBox">

            <h1>Iniciar Sesión</h1>

            <form action="acciones/login.php" method="POST">

                <label>Usuario</label>

                <input
                    type="text"
                    name="usuario"
                    required>

                <label>Contraseña</label>

                <input
                    type="password"
                    name="password"
                    required>

                <button type="submit">

                    Ingresar

                </button>

            </form>

            <br>

            <a href="index.php">

                Crear una cuenta

            </a>

        </div>

    </div>

</body>

</html>