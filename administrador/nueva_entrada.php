<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

$productos = $conexion->query("

SELECT

id,
nombre,
stock

FROM productos

ORDER BY nombre ASC

");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nueva Entrada</title>

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

                    <h1>

                        Nueva Entrada de Inventario

                    </h1>

                    <p>

                        Registrar ingreso de productos al stock.

                    </p>

                </div>

            </div>

            <div class="formAdmin">

                <form

                    action="../acciones/guardar_entrada.php"

                    method="POST">

                    <div class="grupo">

                        <label>

                            Producto

                        </label>

                        <select

                            name="producto_id"

                            required>

                            <option value="">

                                Seleccione un producto

                            </option>

                            <?php while ($producto = $productos->fetch(PDO::FETCH_ASSOC)) { ?>

                                <option

                                    value="<?php echo $producto["id"]; ?>">

                                    <?php

                                    echo $producto["nombre"];

                                    ?>

                                    (Stock:

                                    <?php

                                    echo $producto["stock"];

                                    ?>

                                    )

                                </option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="grupo">

                        <label>

                            Cantidad a ingresar

                        </label>

                        <input

                            type="number"

                            name="cantidad"

                            min="1"

                            value="1"

                            required>

                    </div>

                    <div class="grupo">

                        <label>

                            Observación

                        </label>

                        <textarea

                            name="observacion"

                            rows="4"

                            placeholder="Ejemplo: Compra al proveedor, devolución, ajuste de inventario..."></textarea>

                    </div>

                    <div class="botonesFormulario">

                        <button

                            type="submit"

                            class="btnGuardar">

                            <i class="fa-solid fa-box-open"></i>

                            Registrar Entrada

                        </button>

                        <a

                            href="inventario.php"

                            class="btnCancelar">

                            <i class="fa-solid fa-arrow-left"></i>

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>