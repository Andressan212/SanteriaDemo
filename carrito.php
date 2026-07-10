<?php

session_start();

require_once "includes/conexion.php";

/*
|--------------------------------------------------------------------------
| CONFIGURACIÓN
|--------------------------------------------------------------------------
*/

$nombreTienda = "Humos del Norte";

$categorias = [

    [
        "id" => 1,
        "nombre" => "Velas",
        "icono" => "🕯️",
        "boton" => "btnVelas"
    ],

    [
        "id" => 2,
        "nombre" => "Velones",
        "icono" => "🔥",
        "boton" => "btnVelones"
    ],

    [
        "id" => 3,
        "nombre" => "Sahumerios",
        "icono" => "🌿",
        "boton" => "btnSahumerios"
    ],

    [
        "id" => 4,
        "nombre" => "Polvos",
        "icono" => "✨",
        "boton" => "btnPolvos"
    ],

    [
        "id" => 5,
        "nombre" => "Perfumes",
        "icono" => "💧",
        "boton" => "btnPerfumes"
    ],

    [
        "id" => 6,
        "nombre" => "Aceites",
        "icono" => "🧴",
        "boton" => "btnAceites"
    ],

    [
        "id" => 7,
        "nombre" => "Rosarios",
        "icono" => "📿",
        "boton" => "btnRosarios"
    ],

    [
        "id" => 8,
        "nombre" => "Imágenes",
        "icono" => "🙏",
        "boton" => "btnImagenes"
    ],

    [
        "id" => 9,
        "nombre" => "Amuletos",
        "icono" => "🪬",
        "boton" => "btnAmuletos"
    ],

    [
        "id" => 10,
        "nombre" => "Jabones",
        "icono" => "🧼",
        "boton" => "btnJabones"
    ],

    [
        "id" => 11,
        "nombre" => "Baños",
        "icono" => "🛁",
        "boton" => "btnBanos"
    ],

    [
        "id" => 12,
        "nombre" => "Carbones",
        "icono" => "🔥",
        "boton" => "btnCarbones"
    ]

];

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>

        Carrito | <?= $nombreTienda ?>

    </title>

    <link rel="stylesheet" href="css/carrito.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <header>

        <div class="logo">

            <a href="index.php">

                <img src="img/logo/logo.png" alt="Logo">

            </a>

            <h1>

                <?= $nombreTienda ?>

            </h1>

        </div>

        <nav>

            <ul>

                <li><a href="index.php">Inicio</a></li>

                <li><a href="catalogo.php">Catálogo</a></li>

                <li><a class="activo" href="carrito.php">Carrito</a></li>

                <li><a href="contacto.php">Contacto</a></li>

            </ul>

        </nav>

        <div class="acciones">

            <a href="login.php" class="btnLogin">

                <i class="fa-solid fa-user"></i>

                Ingresar

            </a>

            <a href="carrito.php" class="btnCarrito">

                <i class="fa-solid fa-cart-shopping"></i>

                <span id="contadorCarrito">

                    <?= isset($_SESSION["carrito"]) ? count($_SESSION["carrito"]) : 0 ?>

                </span>

            </a>

        </div>

    </header>

    <section class="bannerCarrito">

        <div>

            <h1>

                Mi Carrito

            </h1>

            <p>

                Revisa tus productos antes de finalizar tu compra.

            </p>

        </div>

    </section>

    <section class="categoriasCompra">

        <h2>

            Agregar productos rápidamente

        </h2>

        <p>

            Selecciona una categoría para elegir varios productos.

        </p>

        <div class="gridCategoriasCompra">

            <?php foreach ($categorias as $categoria) { ?>

                <button

                    class="abrirCategoria"

                    data-id="<?= $categoria["id"] ?>"

                    data-nombre="<?= $categoria["nombre"] ?>"

                    id="<?= $categoria["boton"] ?>">

                    <?= $categoria["icono"] ?>

                    <span>

                        <?= $categoria["nombre"] ?>

                    </span>

                </button>

            <?php } ?>

        </div>

    </section>
    <!--=========================================
            CONTENIDO
==========================================-->

    <section class="contenedorCarritoNuevo">

        <!--=========================================
                PRODUCTOS
    ==========================================-->

        <section class="productosCarrito">

            <div id="listaCarrito">

                <?php

                if (isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) > 0) {

                    foreach ($_SESSION["carrito"] as $item) {

                ?>

                        <article class="itemCarrito">

                            <img
                                src="img/productos/<?= $item["imagen"] ?>"
                                alt="<?= $item["nombre"] ?>">

                            <div class="infoCarrito">

                                <h3>

                                    <?= $item["nombre"] ?>

                                </h3>

                                <p>

                                    Precio:

                                    <strong>

                                        $<?= number_format($item["precio"], 0, ",", ".") ?>

                                    </strong>

                                </p>

                                <div class="controlesCantidad">

                                    <button
                                        class="menos"
                                        data-id="<?= $item["id"] ?>">

                                        -

                                    </button>

                                    <input

                                        type="number"

                                        value="<?= $item["cantidad"] ?>"

                                        min="1"

                                        readonly>

                                    <button
                                        class="mas"
                                        data-id="<?= $item["id"] ?>">

                                        +

                                    </button>

                                </div>

                            </div>

                            <div class="accionesProducto">

                                <span class="subtotalProducto">

                                    $<?= number_format($item["precio"] * $item["cantidad"], 0, ",", ".") ?>

                                </span>

                                <button

                                    class="btnEliminar"

                                    data-id="<?= $item["id"] ?>">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </div>

                        </article>

                    <?php

                    }
                } else {

                    ?>

                    <div class="carritoVacio">

                        <i class="fa-solid fa-cart-shopping"></i>

                        <h2>

                            Tu carrito está vacío

                        </h2>

                        <p>

                            Presiona una categoría para comenzar a agregar productos.

                        </p>

                    </div>

                <?php

                }

                ?>

            </div>

        </section>

        <!--=========================================
                RESUMEN
    ==========================================-->

        <aside class="resumenCompra">

            <h2>

                Resumen

            </h2>

            <div class="lineaResumen">

                <span>

                    Productos

                </span>

                <strong id="cantidadProductos">

                    <?= isset($_SESSION["carrito"]) ? count($_SESSION["carrito"]) : 0 ?>

                </strong>

            </div>

            <div class="lineaResumen">

                <span>

                    Subtotal

                </span>

                <strong id="subtotal">

                    $0

                </strong>

            </div>

            <div class="lineaResumen">

                <span>

                    IVA (21%)

                </span>

                <strong id="iva">

                    $0

                </strong>

            </div>

            <div class="lineaResumen total">

                <span>

                    Total

                </span>

                <strong id="total">

                    $0

                </strong>

            </div>

            <button id="vaciar">

                <i class="fa-solid fa-trash"></i>

                Vaciar carrito

            </button>

            <button id="comprar">

                <i class="fa-solid fa-credit-card"></i>

                Finalizar compra

            </button>

        </aside>

    </section>

    <!--=========================================
            MODAL ÚNICO
==========================================-->

    <div
        class="modalProductos"
        id="modalProductos">

        <div class="contenidoModal">

            <div class="tituloModal">

                <h2 id="tituloCategoria">

                    Productos

                </h2>

                <span
                    class="cerrar">

                    &times;

                </span>

            </div>

            <div
                id="listaProductosCategoria"
                class="listaSeleccionProductos">

                <!--

            Aquí NO van productos escritos.

            JavaScript cargará automáticamente
            los productos desde PHP.

            -->

            </div>

            <button
                class="btnAgregarSeleccion"
                id="agregarSeleccionados">

                <i class="fa-solid fa-cart-plus"></i>

                Agregar al carrito

            </button>

        </div>

    </div>
    <!--=========================================
            FOOTER
==========================================-->

    <footer>

        <div class="footerSuperior">

            <div>

                <h3>

                    Humos del Norte

                </h3>

                <p>

                    Todo para la fe, la espiritualidad y el bienestar.

                </p>

            </div>

            <div>

                <h3>

                    Enlaces

                </h3>

                <ul>

                    <li>

                        <a href="index.php">

                            Inicio

                        </a>

                    </li>

                    <li>

                        <a href="catalogo.php">

                            Catálogo

                        </a>

                    </li>

                    <li>

                        <a href="contacto.php">

                            Contacto

                        </a>

                    </li>

                </ul>

            </div>

            <div>

                <h3>

                    Contacto

                </h3>

                <p>

                    <i class="fa-solid fa-phone"></i>

                    +54 387 XXXXXXX

                </p>

                <p>

                    <i class="fa-solid fa-envelope"></i>

                    ventas@humosdelnorte.com

                </p>

                <p>

                    <i class="fa-solid fa-location-dot"></i>

                    Salta - Argentina

                </p>

            </div>

        </div>

        <div class="footerInferior">

            © <?= date("Y") ?>

            Humos del Norte - Todos los derechos reservados.

        </div>

    </footer>

    <!--=========================================
            LOADER
==========================================-->

    <div id="loader" class="loaderOculto">

        <div class="spinner"></div>

    </div>

    <!--=========================================
            TOAST
==========================================-->

    <div id="toast" class="toast">

        Producto agregado correctamente.

    </div>

    <!--=========================================
            JAVASCRIPT
==========================================-->

    <script>
        const modal = document.getElementById("modalProductos");

        const cerrar = document.querySelector(".cerrar");

        document.querySelectorAll(".abrirCategoria").forEach(boton => {

            boton.addEventListener("click", function() {

                modal.classList.add("mostrar");

                document.getElementById("tituloCategoria").innerHTML = this.dataset.nombre;

                /*
                En la siguiente etapa se realizará
                una petición AJAX a:

                obtener_productos.php

                enviando:

                categoria=this.dataset.id

                y la respuesta llenará:

                #listaProductosCategoria

                */

            });

        });

        cerrar.onclick = function() {

            modal.classList.remove("mostrar");

        }

        window.onclick = function(e) {

            if (e.target == modal) {

                modal.classList.remove("mostrar");

            }

        }
    </script>

    <script src="js/app.js"></script>

    <script src="js/carrito.js"></script>

</body>

</html>