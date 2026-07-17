<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*=============================
BUSCADOR
=============================*/

$buscar = isset($_GET["buscar"]) ? trim($_GET["buscar"]) : "";

if ($buscar != "") {

    $sql = $conexion->prepare("
    SELECT *
    FROM clientes
    WHERE nombre LIKE ?
    ORDER BY nombre ASC
    ");

    $sql->execute(["%" . $buscar . "%"]);
} else {

    $sql = $conexion->query("
    SELECT *
    FROM clientes
    ORDER BY nombre ASC
    ");
}
$mensaje = "";

if (isset($_GET["ok"])) {

    switch ($_GET["ok"]) {

        case "1":
            $mensaje = "Cliente registrado correctamente.";
            break;

        case "actualizado":
            $mensaje = "Cliente actualizado correctamente.";
            break;

        case "eliminado":
            $mensaje = "Cliente eliminado correctamente.";
            break;
    }
}

if (isset($_GET["error"])) {

    switch ($_GET["error"]) {

        case "tieneventas":
            $mensaje = "No se puede eliminar el cliente porque tiene ventas registradas.";
            break;
    }
}

/*antes de clientes*/
$mensaje = "";

if (isset($_GET["ok"])) {

    switch ($_GET["ok"]) {

        case "1":
            $mensaje = "Cliente registrado correctamente.";
            break;

        case "actualizado":
            $mensaje = "Cliente actualizado correctamente.";
            break;

        case "eliminado":
            $mensaje = "Cliente eliminado correctamente.";
            break;
    }
}

if (isset($_GET["error"])) {

    switch ($_GET["error"]) {

        case "tieneventas":
            $mensaje = "No se puede eliminar el cliente porque tiene ventas registradas.";
            break;
    }
}
/*=============================
TOTAL CLIENTES
=============================*/

$totalClientes = $conexion->query("
SELECT COUNT(*)
FROM clientes
")->fetchColumn();

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Clientes</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">
            <!---->
            <?php if ($mensaje != "") { ?>

                <div class="mensajeExito">

                    <?php echo $mensaje; ?>

                </div>

                <br>

            <?php } ?>
            <!---->
            <h1>Clientes</h1>

            <a href="nuevo_cliente.php" class="btnGuardar">

                <i class="fa-solid fa-user-plus"></i>

                Nuevo Cliente

            </a>

            <br><br>

            <div class="card">

                <h3>Total de Clientes</h3>

                <h2><?php echo $totalClientes; ?></h2>

            </div>

            <br>

            <form method="GET" class="buscador">

                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar cliente..."
                    value="<?php echo $buscar; ?>">

                <button class="btnGuardar">

                    <i class="fa-solid fa-search"></i>

                    Buscar

                </button>

            </form>

            <br>

            <table class="tablaAdmin">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Nombre</th>

                        <th>Teléfono</th>

                        <th>Correo</th>

                        <th>Dirección</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($cliente = $sql->fetch(PDO::FETCH_ASSOC)) { ?>

                        <tr>

                            <td><?php echo $cliente["id"]; ?></td>

                            <td><?php echo $cliente["nombre"]; ?></td>

                            <td><?php echo $cliente["telefono"]; ?></td>

                            <td><?php echo $cliente["correo"]; ?></td>

                            <td><?php echo $cliente["direccion"]; ?></td>

                            <td>

                                <a
                                    href="historial_cliente.php?id=<?php echo $cliente["id"]; ?>"
                                    class="btnEditar"
                                    title="Historial">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                                <a
                                    href="editar_cliente.php?id=<?php echo $cliente["id"]; ?>"
                                    class="btnEditar"
                                    title="Editar">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <a
                                    href="../acciones/eliminar_cliente.php?id=<?php echo $cliente["id"]; ?>"
                                    class="btnEliminar"
                                    onclick="return confirm('¿Eliminar cliente?')"
                                    title="Eliminar">

                                    <i class="fa-solid fa-trash"></i>

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>