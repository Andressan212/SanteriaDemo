<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

if (!isset($_GET["id"])) {

    header("Location: clientes.php");
    exit();
}

$id = intval($_GET["id"]);

$sql = $conexion->prepare("

SELECT *

FROM clientes

WHERE id=?

LIMIT 1

");

$sql->execute([$id]);

if ($sql->rowCount() == 0) {

    header("Location: clientes.php");
    exit();
}

$cliente = $sql->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Editar Cliente</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <h1>Editar Cliente</h1>

            <form
                action="../acciones/actualizar_cliente.php"
                method="POST"
                class="formAdmin">

                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $cliente["id"]; ?>">

                <label>Nombre</label>

                <input
                    type="text"
                    name="nombre"
                    value="<?php echo htmlspecialchars($cliente["nombre"]); ?>"
                    required>

                <label>Teléfono</label>

                <input
                    type="text"
                    name="telefono"
                    value="<?php echo htmlspecialchars($cliente["telefono"]); ?>">

                <label>Correo</label>

                <input
                    type="email"
                    name="correo"
                    value="<?php echo htmlspecialchars($cliente["correo"]); ?>">

                <label>Dirección</label>

                <textarea
                    name="direccion"
                    rows="4"><?php echo htmlspecialchars($cliente["direccion"]); ?></textarea>

                <br>

                <button
                    type="submit"
                    class="btnGuardar">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Actualizar Cliente

                </button>

                <a
                    href="clientes.php"
                    class="btnCancelar">

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</body>

</html>