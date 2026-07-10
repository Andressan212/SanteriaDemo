<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width,initial-scale=1.0">

    <title>Registro</title>

    <link rel="stylesheet" href="css/registros.css">

</head>

<body>

    <div class="loginContainer">

        <div class="loginBox">

            <h1>Registro</h1>

            <form

                action="acciones/registro.php"

                method="POST">

                <input

                    type="text"

                    name="nombre"

                    placeholder="Nombre"

                    required>

                <input

                    type="text"

                    name="usuario"

                    placeholder="Usuario"

                    required>

                <input

                    type="email"

                    name="correo"

                    placeholder="Correo"

                    required>

                <input

                    type="password"

                    name="password"

                    placeholder="Contraseña"

                    required>

                <button>

                    Registrarse

                </button>

            </form>

        </div>

    </div>

</body>

</html>