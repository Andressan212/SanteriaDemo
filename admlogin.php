<?php

session_start();

if (isset($_SESSION["admin_id"])) {

    header("Location: ../administrador/adm-index.php?ok=1");
    exit();
}

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Login Administrador</title>

    <link rel="stylesheet" href="css/login.css">

</head>

<body>

    <div class="loginContainer">

        <div class="loginBox">

            <h1>Administrador</h1>

            <form action="acciones/admlogin.php" method="POST">

                <label>Usuario</label>

                <input type="text" name="usuario" required>

                <label>Contraseña</label>

                <input type="password" name="password" required>

                <button type="submit">

                    Ingresar

                </button>
                <?php

                require_once("includes/conexion.php");

                $total = $conexion->query("SELECT COUNT(*) FROM administrador")->fetchColumn();

                ?>
                <!--<?php if ($total == 0) { ?>-->

                <hr>

                <!-- <div class="primerAdmin">-->

                <!--<p>No existe ningún administrador.</p>-->

                <a href="crear_admin.php" class="btnCrearAdmin">

                    Crear el primer administrador

                </a>

                <!-- </div>

                <?php } ?>-->
            </form>

        </div>

    </div>

</body>

</html>