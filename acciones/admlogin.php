<?php

session_start();

require_once("../includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../administrador/adm-index.php?ok=1");
    exit();
}

$usuario = trim($_POST["usuario"]);
$password = $_POST["password"];

$sql = $conexion->prepare("

SELECT *

FROM administrador

WHERE usuario = ?

AND estado = 1

LIMIT 1

");

$sql->execute([$usuario]);

if ($sql->rowCount() == 1) {

    $datos = $sql->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $datos["password"])) {

        $_SESSION["admin_id"] = $datos["id"];
        $_SESSION["admin_nombre"] = $datos["nombre"];
        $_SESSION["admin_apellido"] = $datos["apellido"];
        $_SESSION["admin_usuario"] = $datos["usuario"];
        $_SESSION["admin_rol"] = $datos["rol"];

        // Guardar último acceso
        $actualizar = $conexion->prepare("

        UPDATE administrador

        SET ultimo_acceso = NOW()

        WHERE id = ?

        ");

        $actualizar->execute([$datos["id"]]);

        header("Location: ../administrador/adm-index.php");
        exit();
    }
}

header("Location: ../admlogin.php?error=1");
exit();
