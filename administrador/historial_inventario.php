<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

$sql = $conexion->query("

SELECT

inventario.*,

productos.nombre

FROM inventario

INNER JOIN productos

ON inventario.producto_id = productos.id

ORDER BY inventario.fecha DESC

");

$totalMovimientos = $conexion->query("

SELECT COUNT(*)

FROM inventario

")->fetchColumn();

$totalEntradas = $conexion->query("

SELECT COUNT(*)

FROM inventario

WHERE tipo='ENTRADA'

")->fetchColumn();

$totalSalidas = $conexion->query("

SELECT COUNT(*)

FROM inventario

WHERE tipo='SALIDA'

")->fetchColumn();

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Historial Inventario</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <div class="encabezadoDashboard">

                <div>

                    <h1>Historial de Inventario</h1>

                    <p>Registro de todos los movimientos realizados.</p>

                </div>

                <a href="inventario.php" class="btnNuevo">

                    <i class="fa-solid fa-arrow-left"></i>

                    Volver

                </a>

            </div>

            <div class="cards">

                <div class="card">

                    <h3>Total Movimientos</h3>

                    <h2><?php echo $totalMovimientos; ?></h2>

                </div>

                <div class="card">

                    <h3>Entradas</h3>

                    <h2><?php echo $totalEntradas; ?></h2>

                </div>

                <div class="card">

                    <h3>Salidas</h3>

                    <h2><?php echo $totalSalidas; ?></h2>

                </div>

            </div>

            <br>

            <div class="barraSuperior">

                <input

                    type="text"

                    id="buscar"

                    placeholder="Buscar producto...">

            </div>

            <div class="tablaAdmin">

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Fecha</th>

                            <th>Producto</th>

                            <th>Movimiento</th>

                            <th>Cantidad</th>

                            <th>Stock Antes</th>

                            <th>Stock Después</th>

                            <th>Administrador</th>

                            <th>Observación</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) { ?>

                            <tr>

                                <td>

                                    <?php echo $fila["id"]; ?>

                                </td>

                                <td>

                                    <?php echo date("d/m/Y H:i", strtotime($fila["fecha"])); ?>

                                </td>

                                <td>

                                    <?php echo $fila["nombre"]; ?>

                                </td>

                                <td>

                                    <?php

                                    if ($fila["tipo"] == "ENTRADA") {

                                        echo "<span class='stockAlto'>ENTRADA</span>";
                                    } else {

                                        echo "<span class='stockBajo'>SALIDA</span>";
                                    }

                                    ?>

                                </td>

                                <td>

                                    <?php echo $fila["cantidad"]; ?>

                                </td>

                                <td>

                                    <?php echo $fila["stock_anterior"]; ?>

                                </td>

                                <td>

                                    <?php echo $fila["stock_actual"]; ?>

                                </td>

                                <td>

                                    <?php echo htmlspecialchars($fila["usuario"]); ?>

                                </td>

                                <td>

                                    <?php echo htmlspecialchars($fila["observacion"]); ?>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>