<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");


/*=========================================
        ESTADÍSTICAS GENERALES
=========================================*/

$totalVentas = $conexion->query("
    SELECT COUNT(*)
    FROM ventas
")->fetchColumn();


$totalIngresos = $conexion->query("
    SELECT IFNULL(SUM(total),0)
    FROM ventas
    WHERE estado='PAGADA'
")->fetchColumn();


$totalClientes = $conexion->query("
    SELECT COUNT(*)
    FROM clientes
")->fetchColumn();


$totalProductos = $conexion->query("
    SELECT COUNT(*)
    FROM productos
")->fetchColumn();


$ventasHoy = $conexion->query("
    SELECT COUNT(*)
    FROM ventas
    WHERE DATE(fecha)=CURDATE()
")->fetchColumn();


$stockBajo = $conexion->query("
    SELECT COUNT(*)
    FROM productos
    WHERE stock<=5
")->fetchColumn();



/*=========================================
        PRODUCTO MÁS VENDIDO
=========================================*/

$productoMasVendido = $conexion->query("
    SELECT nombre, mas_vendido
    FROM productos
    ORDER BY mas_vendido DESC
    LIMIT 1
")->fetch(PDO::FETCH_ASSOC);



/*=========================================
        ÚLTIMAS VENTAS
=========================================*/

$ultimasVentas = $conexion->query("

    SELECT

    ventas.id,
    ventas.total,
    ventas.fecha,
    clientes.nombre AS cliente

    FROM ventas

    INNER JOIN clientes

    ON ventas.cliente = clientes.id

    ORDER BY ventas.fecha DESC

    LIMIT 5

");



/*=========================================
        ÚLTIMOS CLIENTES
=========================================*/

$ultimosClientes = $conexion->query("

    SELECT *

    FROM clientes

    ORDER BY id DESC

    LIMIT 5

");



/*=========================================
        VENTAS POR MES
=========================================*/

$ventasMes = [];


for ($i = 1; $i <= 12; $i++) {


    $sqlMes = $conexion->prepare("

        SELECT IFNULL(SUM(total),0)

        FROM ventas

        WHERE MONTH(fecha)=?

        AND YEAR(fecha)=YEAR(CURDATE())

        AND estado='PAGADA'

    ");


    $sqlMes->execute([$i]);


    $ventasMes[] = (float)$sqlMes->fetchColumn();
}



/*=========================================
        PRODUCTOS CON POCO STOCK
=========================================*/


$productosStock = $conexion->query("

    SELECT nombre,stock

    FROM productos

    WHERE stock<=5

    ORDER BY stock ASC

    LIMIT 5

");



/*=========================================
        MÉTODOS DE PAGO
=========================================*/


$sqlMetodo = $conexion->query("

    SELECT

    metodo_pago,

    COUNT(*) AS cantidad

    FROM ventas

    WHERE estado='PAGADA'

    GROUP BY metodo_pago

");



$metodos = [];

$cantidades = [];



while ($fila = $sqlMetodo->fetch(PDO::FETCH_ASSOC)) {


    $metodos[] = $fila["metodo_pago"];

    $cantidades[] = $fila["cantidad"];
}



?>


<!DOCTYPE html>

<html lang="es">


<head>


    <meta charset="UTF-8">


    <title>Dashboard</title>


    <link rel="stylesheet" href="../css/administrador.css">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <style>
        .dashboard {


            display: grid;

            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));

            gap: 20px;

            margin-top: 20px;


        }



        .cardDashboard {


            background: #fff;

            padding: 20px;

            border-radius: 10px;

            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);

            text-align: center;

            min-height: 220px;

            transition: .3s;


        }



        .cardDashboard:hover {


            transform: translateY(-5px);

            box-shadow: 0 10px 25px rgba(0, 0, 0, .15);


        }



        .cardDashboard i {


            font-size: 40px;

            margin-bottom: 15px;

            color: #7b2cbf;


        }



        .cardDashboard h2 {


            font-size: 30px;

            margin: 10px 0;


        }



        .cardDashboard p {


            font-size: 18px;

            color: #666;


        }



        .segundaFila {


            margin-top: 30px;


        }
    </style>


</head>

<body>


    <div class="adminLayout">


        <?php include("../includes/menu.php"); ?>


        <div class="content">


            <h1>

                <i class="fa-solid fa-chart-line"></i>

                Reportes y Estadísticas

            </h1>



            <div class="dashboard">



                <!-- INGRESOS -->

                <div class="cardDashboard">

                    <i class="fa-solid fa-money-bill-wave"></i>

                    <h2>
                        $
                        <?php echo number_format($totalIngresos, 2, ",", "."); ?>
                    </h2>

                    <p>
                        Ingresos Totales
                    </p>

                </div>



                <!-- VENTAS -->

                <div class="cardDashboard">

                    <i class="fa-solid fa-cart-shopping"></i>

                    <h2>
                        <?php echo $totalVentas; ?>
                    </h2>

                    <p>
                        Ventas Registradas
                    </p>

                </div>




                <!-- CLIENTES -->

                <div class="cardDashboard">

                    <i class="fa-solid fa-users"></i>

                    <h2>
                        <?php echo $totalClientes; ?>
                    </h2>

                    <p>
                        Clientes
                    </p>

                </div>




                <!-- PRODUCTOS -->

                <div class="cardDashboard">

                    <i class="fa-solid fa-box"></i>

                    <h2>
                        <?php echo $totalProductos; ?>
                    </h2>

                    <p>
                        Productos
                    </p>

                </div>




                <!-- VENTAS HOY -->

                <div class="cardDashboard">

                    <i class="fa-solid fa-calendar-day"></i>

                    <h2>
                        <?php echo $ventasHoy; ?>
                    </h2>

                    <p>
                        Ventas Hoy
                    </p>

                </div>




                <!-- STOCK BAJO -->

                <div class="cardDashboard">

                    <i class="fa-solid fa-triangle-exclamation"></i>

                    <h2>
                        <?php echo $stockBajo; ?>
                    </h2>

                    <p>
                        Productos con Poco Stock
                    </p>

                </div>



            </div>




            <!-- GRAFICO VENTAS -->

            <div class="cardDashboard">


                <h2>

                    <i class="fa-solid fa-chart-column"></i>

                    Ventas por Mes

                </h2>



                <canvas id="graficoVentas"></canvas>


            </div>



        </div>


    </div>





    <!-- SEGUNDA FILA -->


    <div class="dashboard segundaFila">





        <!-- PRODUCTO MÁS VENDIDO -->


        <div class="cardDashboard">


            <h2>

                <i class="fa-solid fa-fire"></i>

                Producto más vendido

            </h2>



            <?php if ($productoMasVendido) { ?>


                <h3>

                    <?php echo $productoMasVendido["nombre"]; ?>

                </h3>



                <p>

                    Vendidos:

                    <strong>

                        <?php echo $productoMasVendido["mas_vendido"]; ?>

                    </strong>


                </p>



            <?php } else { ?>


                <p>
                    No hay datos.
                </p>



            <?php } ?>


        </div>





        <!-- ÚLTIMAS VENTAS -->


        <div class="cardDashboard">


            <h2>

                <i class="fa-solid fa-receipt"></i>

                Últimas Ventas

            </h2>



            <?php while ($venta = $ultimasVentas->fetch(PDO::FETCH_ASSOC)) { ?>


                <p>


                    <strong>

                        #<?php echo $venta["id"]; ?>

                    </strong>


                    <br>


                    <?php echo $venta["cliente"]; ?>


                    <br>


                    $

                    <?php echo number_format($venta["total"], 2, ",", "."); ?>


                </p>


                <hr>



            <?php } ?>



        </div>







        <!-- PRODUCTOS STOCK BAJO -->


        <div class="cardDashboard">


            <h2>


                <i class="fa-solid fa-triangle-exclamation"></i>


                Productos por Reponer


            </h2>




            <?php while ($producto = $productosStock->fetch(PDO::FETCH_ASSOC)) { ?>



                <p>


                    <?php echo $producto["nombre"]; ?>


                    <br>


                    Stock:


                    <strong>

                        <?php echo $producto["stock"]; ?>

                    </strong>


                </p>


                <hr>



            <?php } ?>



        </div>





        <!-- ÚLTIMOS CLIENTES -->


        <div class="cardDashboard">


            <h2>


                <i class="fa-solid fa-user-plus"></i>


                Últimos Clientes


            </h2>




            <?php while ($cliente = $ultimosClientes->fetch(PDO::FETCH_ASSOC)) { ?>


                <p>

                    <?php echo $cliente["nombre"]; ?>

                </p>


                <hr>


            <?php } ?>



        </div>



    </div>
    <!-- MÉTODOS DE PAGO -->


    <div class="cardDashboard">


        <h2>

            <i class="fa-solid fa-credit-card"></i>

            Métodos de Pago

        </h2>



        <canvas id="graficoMetodos"></canvas>



    </div>





    <script>
        /*=========================================
        GRÁFICO VENTAS POR MES
=========================================*/


        const ctxVentas = document.getElementById('graficoVentas');



        new Chart(ctxVentas, {


            type: 'bar',


            data: {


                labels: [

                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'

                ],



                datasets: [{


                    label: 'Ventas',


                    data:

                        <?php echo json_encode($ventasMes); ?>


                }]


            },



            options: {


                responsive: true,


                plugins: {


                    legend: {


                        display: false


                    }


                }


            }



        });






        /*=========================================
                GRÁFICO MÉTODOS DE PAGO
        =========================================*/



        const ctxMetodo = document.getElementById('graficoMetodos');



        new Chart(ctxMetodo, {



            type: 'pie',



            data: {



                labels:

                    <?php echo json_encode($metodos); ?>,



                datasets: [{


                    data:

                        <?php echo json_encode($cantidades); ?>


                }]



            },



            options: {


                responsive: true


            }



        });
    </script>




</body>


</html>