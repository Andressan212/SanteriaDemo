<?php

session_start();

require_once("../includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../administrador.php");
    exit();
}

$id = intval($_POST["id"]);

$nombre = trim($_POST["nombre"]);
$apellido = trim($_POST["apellido"]);
$usuario = trim($_POST["usuario"]);
$email = trim($_POST["email"]);
$telefono = trim($_POST["telefono"]);
$rol = $_POST["rol"];
$estado = $_POST["estado"];
$password = trim($_POST["password"]);

$foto = $_POST["fotoActual"];

/*=========================================
VALIDAR USUARIO REPETIDO
=========================================*/

$sql = $conexion->prepare("

SELECT id

FROM administrador

WHERE usuario=?

AND id<>?

LIMIT 1

");

$sql->execute([$usuario, $id]);

if ($sql->rowCount() > 0) {

    header("Location: ../editar_admin.php?id=" . $id . "&error=usuario");
    exit();
}

/*=========================================
VALIDAR EMAIL REPETIDO
=========================================*/

$sql = $conexion->prepare("

SELECT id

FROM administrador

WHERE email=?

AND id<>?

LIMIT 1

");

$sql->execute([$email, $id]);

if ($sql->rowCount() > 0) {

    header("Location: ../editar_admin.php?id=" . $id . "&error=email");
    exit();
}

/*=========================================
SUBIR FOTO
=========================================*/

if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {

    $permitidos = [

        "image/jpeg",

        "image/png",

        "image/webp"

    ];

    if (in_array($_FILES["foto"]["type"], $permitidos)) {

        if ($foto != "usuario.png" && file_exists("../../img/usuarios/" . $foto)) {

            unlink("../../img/usuarios/" . $foto);
        }

        $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);

        $foto = uniqid() . "." . $extension;

        move_uploaded_file(

            $_FILES["foto"]["tmp_name"],

            "../../img/usuarios/" . $foto

        );
    }
}

/*=========================================
ACTUALIZAR
=========================================*/

if (!empty($password)) {

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = $conexion->prepare("

    UPDATE administrador SET

    nombre=?,

    apellido=?,

    usuario=?,

    email=?,

    password=?,

    telefono=?,

    rol=?,

    foto=?,

    estado=?

    WHERE id=?

    ");

    $sql->execute([

        $nombre,

        $apellido,

        $usuario,

        $email,

        $password,

        $telefono,

        $rol,

        $foto,

        $estado,

        $id

    ]);
} else {

    $sql = $conexion->prepare("

    UPDATE administrador SET

    nombre=?,

    apellido=?,

    usuario=?,

    email=?,

    telefono=?,

    rol=?,

    foto=?,

    estado=?

    WHERE id=?

    ");

    $sql->execute([

        $nombre,

        $apellido,

        $usuario,

        $email,

        $telefono,

        $rol,

        $foto,

        $estado,

        $id

    ]);
}

header("Location: ../administradores.php?ok=2");

exit();
