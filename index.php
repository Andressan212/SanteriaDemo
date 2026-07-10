<?php

require_once("includes/conexion.php");

$productos = $conexion->query(

    "SELECT *

FROM productos

ORDER BY id DESC

LIMIT 8"

);

$categorias = $conexion->query(

    "SELECT *

FROM categorias

ORDER BY nombre"

);

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"

        content="width=device-width, initial-scale=1.0">

    <title>Santería Humos del Norte</title>

    <link rel="stylesheet" href="css/syles.css">

    <link rel="stylesheet" href="css/responsive.css">

    <link rel="preconnect"

        href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"

        rel="stylesheet">

    <script src="https://kit.fontawesome.com/4b7d1b7b0f.js"

        crossorigin="anonymous"></script>

</head>

<body>

    <header>

        <div class="logo">

            <img src="img/logo/logo.png">

            <h1>Santería Humos del Norte</h1>

        </div>

        <nav>

            <ul>

                <li><a href="index.php">Inicio</a></li>

                <li><a href="catalogo.php">Catálogo</a></li>

                <li><a href="#">Ofertas</a></li>

                <li><a href="#">Nosotros</a></li>

                <li><a href="contacto.php">Contacto</a></li>

            </ul>

        </nav>

        <div class="acciones">

            <a href="login.php">

                <button>

                    <i class="fa-solid fa-user"></i>

                    Iniciar Sesión

                </button>

            </a>

            <a href="carrito.php">

                <button>

                    <i class="fa-solid fa-cart-shopping"></i>

                    <span id="contadorCarrito">0</span>

                </button>

            </a>

        </div>

    </header>

    <section class="banner">

        <div class="contenidoBanner">

            <h2>

                Todo para tu fe y espiritualidad

            </h2>

            <p>

                Velas, imágenes religiosas,

                inciensos, perfumes,

                rosarios, aceites y mucho más.

            </p>

            <a

                href="catalogo.php"

                class="botonBanner">

                Ver Catálogo

            </a>

        </div>

    </section>

    <section class="busqueda">

        <h2>Buscar Productos</h2>

        <div class="contenedorBusqueda">

            <input

                type="text"

                id="buscar"

                placeholder="Buscar productos...">

            <button>

                <i class="fa-solid fa-magnifying-glass"></i>

            </button>

        </div>

    </section>

    <section class="categorias">

        <h2>Categorías</h2>

        <div class="gridCategorias">

            <?php

            while ($cat = $categorias->fetch(PDO::FETCH_ASSOC)) {

            ?>

                <div class="categoria">

                    <h3>

                        <?= $cat["nombre"] ?>

                    </h3>

                </div>

            <?php

            }

            ?>

        </div>

    </section>

    <section class="productos">

        <h2>

            Productos Destacados

        </h2>

        <div class="gridProductos">

            <?php

            while ($p = $productos->fetch(PDO::FETCH_ASSOC)) {

            ?>

                <article class="producto">

                    <img

                        src="img/productos/<?= $p["imagen"] ?>">

                    <div class="infoProducto">

                        <h3>

                            <?= $p["nombre"] ?>

                        </h3>

                        <p>

                            <?= substr($p["descripcion"], 0, 80) ?>...

                        </p>

                        <h4>

                            $

                            <?= number_format($p["precio_venta"], 2) ?>

                        </h4>

                        <a

                            href="producto.php?id=<?= $p["id"] ?>">

                            <button>

                                Ver Producto

                            </button>

                        </a>

                    </div>

                </article>

            <?php

            }

            ?>

        </div>

    </section>

    <section class="ofertas">

        <h2>

            Ofertas Especiales

        </h2>

        <div class="contenedorOferta">

            <div>

                <h3>

                    20% OFF

                </h3>

                <p>

                    En productos seleccionados.

                </p>

            </div>

        </div>

    </section>

    <footer>

        <div>

            <h3>

                Santería Humos del Norte

            </h3>

            <p>

                Tu tienda espiritual.

            </p>

        </div>

        <div>

            <h3>

                Contacto

            </h3>

            <p>

                WhatsApp

            </p>

            <p>

                Facebook

            </p>

            <p>

                Instagram

            </p>

        </div>

        <div>

            <h3>

                Horarios

            </h3>

            <p>

                Lunes a Sábado

            </p>

            <p>

                09:00 a 20:00

            </p>

        </div>

    </footer>

    <script src="js/app.js"></script>

    <script src="js/buscador.js"></script>

</body>

</html>