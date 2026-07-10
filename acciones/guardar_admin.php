<?php

session_start();

require_once("../includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../adm-index.php");
    exit();
}

/*=========================================
RECIBIR DATOS
=========================================*/

$nombre = trim($_POST["nombre"]);
$apellido = trim($_POST["apellido"]);
$usuario = trim($_POST["usuario"]);
$email = trim($_POST["email"]);
$telefono = trim($_POST["telefono"]);
$rol = $_POST["rol"];
$password = $_POST["password"];
$confirmar = $_POST["confirmar"];
$estado = $_POST["estado"];

/*=========================================
VALIDAR CONTRASEÑAS
=========================================*/

if ($password != $confirmar) {

    header("Location: ../agregar_admin.php?error=password");

    exit();
}

/*=========================================
USUARIO REPETIDO
=========================================*/

$sql = $conexion->prepare("

SELECT id

FROM administrador

WHERE usuario=?

LIMIT 1

");

$sql->execute([$usuario]);

if ($sql->rowCount() > 0) {

    header("Location: ../agregar_admin.php?error=usuario");

    exit();
}

/*=========================================
EMAIL REPETIDO
=========================================*/

$sql = $conexion->prepare("

SELECT id

FROM administrador

WHERE email=?

LIMIT 1

");

$sql->execute([$email]);

if ($sql->rowCount() > 0) {

    header("Location: ../agregar_admin.php?error=email");

    exit();
}

/*=========================================
SUBIR FOTO
=========================================*/

$foto = "usuario.png";

if (

    isset($_FILES["foto"])

    &&

    $_FILES["foto"]["error"] == 0

) {

    $permitidos = [

        "image/jpeg",

        "image/png",

        "image/webp"

    ];

    if (in_array($_FILES["foto"]["type"], $permitidos)) {

        $extension = pathinfo(

            $_FILES["foto"]["name"],

            PATHINFO_EXTENSION

        );

        $foto = uniqid() . "." . $extension;

        move_uploaded_file(

            $_FILES["foto"]["tmp_name"],

            "../../img/usuarios/" . $foto

        );
    }
}

/*=========================================
ENCRIPTAR PASSWORD
=========================================*/

$password = password_hash(

    $password,

    PASSWORD_DEFAULT

);

/*=========================================
GUARDAR
=========================================*/

$sql = $conexion->prepare("

INSERT INTO administrador(

nombre,

apellido,

usuario,

email,

password,

telefono,

rol,

foto,

estado

)

VALUES(

?,?,?,?,?,?,?,?,?

)

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

    $estado

]);

header("Location: ../administradores.php?ok=1");

exit();
