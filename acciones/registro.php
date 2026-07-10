<?php
require_once("../includes/conexion.php");

// Inicializamos variables para mensajes
$mensaje = "";
$clase_mensaje = "";

// Solo procesamos si se envía el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST["nombre"];
    $usuario  = $_POST["usuario"];
    $correo   = $_POST["correo"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $rol      = "Administrador";

    try {
        $sql = $conexion->prepare(
            "INSERT INTO usuarios (nombre, usuario, correo, password, rol) 
             VALUES (?, ?, ?, ?, ?)"
        );

        $resultado = $sql->execute([$nombre, $usuario, $correo, $password, $rol]);

        if ($resultado) {
            // Si el registro es exitoso, redirigimos al login
            header("Location: ../login.php");
            exit();
        } else {
            $mensaje = "Hubo un problema al registrar el usuario.";
            $clase_mensaje = "error";
        }
    } catch (Exception $e) {
        $mensaje = "Error en la base de datos: " . $e->getMessage();
        $clase_mensaje = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .alerta {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 14px;
        }

        .alerta.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s ease;
            margin-top: 15px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Estado del Registro</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="alerta <?php echo $clase_mensaje; ?>">
                <?php echo $mensaje; ?>
            </div>
            <a href="javascript:history.back()" class="btn">Volver a intentar</a>
        <?php else: ?>
            <p>Procesando registro...</p>
        <?php endif; ?>
    </div>

</body>

</html>