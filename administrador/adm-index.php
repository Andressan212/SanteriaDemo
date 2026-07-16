<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*==========================
CONSULTAS
==========================*/

$totalProductos = $conexion->query("
SELECT COUNT(*)
FROM productos
")->fetchColumn();

$totalClientes = $conexion->query("
SELECT COUNT(*)
FROM usuarios
")->fetchColumn();

$totalVentas = $conexion->query("
SELECT COUNT(*)
FROM ventas
")->fetchColumn();

$totalDinero = $conexion->query("
SELECT IFNULL(SUM(total),0)
FROM ventas
")->fetchColumn();

?>
<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel de Administración</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <div class="adminLayout">

        <?php require_once("../includes/menu.php"); ?>

        <div class="content">

            <div class="encabezadoDashboard">

                <div>

                    <h1>Interface visual</h1>

                    <p>

                        Bienvenido nuevamente,

                        <strong>

                            <?php echo $_SESSION["admin_nombre"]; ?>

                        </strong>

                    </p>

                </div>

                <div class="fecha">

                    <?php

                    date_default_timezone_set("America/Argentina/Salta");

                    echo date("d/m/Y H:i");

                    ?>

                </div>

            </div>

            <div class="cards">

                <div class="card verde">

                    <i class="fa-solid fa-box"></i>

                    <div>

                        <h3>Productos</h3>

                        <h2><?php echo $totalProductos; ?></h2>

                    </div>

                </div>

                <div class="card azul">

                    <i class="fa-solid fa-users"></i>

                    <div>

                        <h3>Clientes</h3>

                        <h2><?php echo $totalClientes; ?></h2>

                    </div>

                </div>

                <div class="card naranja">

                    <i class="fa-solid fa-cart-shopping"></i>

                    <div>

                        <h3>Ventas</h3>

                        <h2><?php echo $totalVentas; ?></h2>

                    </div>

                </div>

                <div class="card rojo">

                    <i class="fa-solid fa-dollar-sign"></i>

                    <div>

                        <h3>Ingresos</h3>

                        <h2>$<?php echo number_format($totalDinero, 0, ",", "."); ?></h2>

                    </div>

                </div>

            </div>

            <div class="grafico">

                <h2>Resumen de Ventas</h2>

                <canvas id="ventasChart"></canvas>

            </div>

        </div>

        <script src="../js/dashboard.js"></script>

</body>

</html>