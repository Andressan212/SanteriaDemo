<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

/*=====================================
OBTENER CLIENTES
=====================================*/

$clientes = $conexion->query("

SELECT

id,
nombre

FROM clientes

ORDER BY nombre ASC

");

/*=====================================
OBTENER PRODUCTOS
=====================================*/

$productos = $conexion->query("

SELECT

id,
nombre,
precio_venta,
stock

FROM productos

WHERE stock > 0

ORDER BY nombre ASC

");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nueva Venta</title>

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

                        Nueva Venta

                    </h1>

                    <p>

                        Registrar una nueva venta.

                    </p>

                </div>

                <a href="ventas.php" class="btnCancelar">

                    <i class="fa-solid fa-arrow-left"></i>

                    Volver

                </a>

            </div>

            <form action="../acciones/guardar_venta.php" method="POST">

                <div class="formAdmin">

                    <div class="grupo">

                        <label>

                            Cliente

                        </label>

                        <select name="cliente" required>

                            <option value="">
                                Seleccione un cliente
                            </option>

                            <?php while ($cliente = $clientes->fetch(PDO::FETCH_ASSOC)) { ?>

                                <option value="<?php echo $cliente["id"]; ?>">

                                    <?php echo $cliente["nombre"]; ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="grupo">

                        <label>

                            Método de Pago

                        </label>

                        <select name="metodo_pago" required>

                            <option value="Efectivo">Efectivo</option>

                            <option value="Transferencia">Transferencia</option>

                            <option value="Tarjeta">Tarjeta</option>

                            <option value="Mercado Pago">Mercado Pago</option>

                        </select>

                    </div>
                    <hr>

                    <h2>Agregar Producto</h2>

                    <div class="grupo">

                        <label>Producto</label>

                        <select id="producto">

                            <option value="">Seleccione un producto</option>

                            <?php while ($producto = $productos->fetch(PDO::FETCH_ASSOC)) { ?>

                                <option
                                    value="<?php echo $producto["id"]; ?>"
                                    data-precio="<?php echo $producto["precio_venta"]; ?>"
                                    data-stock="<?php echo $producto["stock"]; ?>">

                                    <?php echo $producto["nombre"]; ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="grupo">

                        <label>Precio</label>

                        <input
                            type="text"
                            id="precio"
                            readonly>

                    </div>

                    <div class="grupo">

                        <label>Stock Disponible</label>

                        <input
                            type="text"
                            id="stock"
                            readonly>

                    </div>

                    <div class="grupo">

                        <label>Cantidad</label>

                        <input
                            type="number"
                            id="cantidad"
                            min="1"
                            value="1">

                    </div>

                    <button
                        type="button"
                        class="btnNuevo"
                        id="agregar">

                        <i class="fa-solid fa-cart-plus"></i>

                        Agregar al Carrito

                    </button>

                    <hr>
                    <!--body-->
                    <script>
                        const producto = document.getElementById("producto");
                        const precio = document.getElementById("precio");
                        const stock = document.getElementById("stock");

                        producto.addEventListener("change", function() {

                            let opcion = this.options[this.selectedIndex];

                            precio.value = opcion.dataset.precio || "";

                            stock.value = opcion.dataset.stock || "";

                        });
                    </script>

                    <hr>

                    <h2>Carrito de Venta</h2>

                    <table class="tablaAdmin" id="tablaCarrito">

                        <thead>

                            <tr>

                                <th>Producto</th>

                                <th>Precio</th>

                                <th>Cantidad</th>

                                <th>Subtotal</th>

                                <th>Acción</th>

                            </tr>

                        </thead>

                        <tbody>

                        </tbody>

                    </table>

                    <br>

                    <h2>

                        Total: $

                        <span id="totalVenta">

                            0.00

                        </span>

                    </h2>

                    <input
                        type="hidden"
                        name="detalle"
                        id="detalle">

                    <input
                        type="hidden"
                        name="total"
                        id="totalInput">

                    <!--body-->
                    <script>
                        let carrito = [];

                        let total = 0;

                        document.getElementById("agregar").addEventListener("click", function() {

                            let select = document.getElementById("producto");

                            if (select.value == "") {

                                alert("Seleccione un producto");

                                return;

                            }

                            let opcion = select.options[select.selectedIndex];

                            let id = opcion.value;

                            let nombre = opcion.text;

                            let precio = parseFloat(opcion.dataset.precio);

                            let stock = parseInt(opcion.dataset.stock);

                            let cantidad = parseInt(document.getElementById("cantidad").value);

                            if (cantidad <= 0) {

                                alert("Cantidad inválida");

                                return;

                            }

                            if (cantidad > stock) {

                                alert("No hay suficiente stock.");

                                return;

                            }

                            let subtotal = precio * cantidad;

                            carrito.push({

                                id: id,

                                nombre: nombre,

                                precio: precio,

                                cantidad: cantidad,

                                subtotal: subtotal

                            });

                            actualizarTabla();

                        });

                        function actualizarTabla() {

                            let tbody = document.querySelector("#tablaCarrito tbody");

                            tbody.innerHTML = "";

                            total = 0;

                            carrito.forEach((item, index) => {

                                total += item.subtotal;

                                tbody.innerHTML += `

        <tr>

        <td>${item.nombre}</td>

        <td>$${item.precio.toFixed(2)}</td>

        <td>${item.cantidad}</td>

        <td>$${item.subtotal.toFixed(2)}</td>

        <td>

        <button

        type="button"

        onclick="eliminar(${index})">

        X

        </button>

        </td>

        </tr>

        `;

                            });

                            document.getElementById("totalVenta").innerHTML = total.toFixed(2);

                            document.getElementById("totalInput").value = total;

                            document.getElementById("detalle").value = JSON.stringify(carrito);

                        }

                        function eliminar(posicion) {

                            carrito.splice(posicion, 1);

                            actualizarTabla();

                        }
                    </script>
                    <br>

                    <div class="botonesFormulario">

                        <button
                            type="submit"
                            class="btnGuardar">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Guardar Venta

                        </button>

                        <a
                            href="ventas.php"
                            class="btnCancelar">

                            <i class="fa-solid fa-xmark"></i>

                            Cancelar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</body>

</html>