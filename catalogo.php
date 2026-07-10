<?php

require_once("includes/conexion.php");

$buscar = $_GET['buscar'] ?? "";
$categoria = $_GET['categoria'] ?? "";
$orden = $_GET['orden'] ?? "recientes";

$sql = "SELECT productos.*,
categorias.nombre AS categoria

FROM productos

INNER JOIN categorias
ON productos.categoria = categorias.id

WHERE 1";

if ($buscar != "") {

    $sql .= " AND productos.nombre LIKE '%$buscar%'";
}

if ($categoria != "") {

    $sql .= " AND productos.categoria = '$categoria'";
}

switch ($orden) {

    case "precioAsc":

        $sql .= " ORDER BY productos.precio_venta ASC";

        break;

    case "precioDesc":

        $sql .= " ORDER BY productos.precio_venta DESC";

        break;

    case "nombre":

        $sql .= " ORDER BY productos.nombre ASC";

        break;

    default:

        $sql .= " ORDER BY productos.id DESC";
}

$productos = $conexion->query($sql);

$categorias = $conexion->query("SELECT * FROM categorias ORDER BY nombre");

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>

        Catálogo | Santería Humos del Norte

    </title>

    <link rel="stylesheet" href="css/catalogo.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

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

                Santería Humos del Norte

            </h1>

        </div>

        <nav>

            <ul>

                <li><a href="index.php">Inicio</a></li>

                <li><a class="activo" href="catalogo.php">Catálogo</a></li>

                <li><a href="ofertas.php">Ofertas</a></li>

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

                <span id="contadorCarrito">0</span>

            </a>

        </div>

    </header>

    <section class="bannerCatalogo">

        <div class="overlayBanner">

            <h1>

                Catálogo Completo

            </h1>

            <p>

                Velas • Sahumerios • Polvos • Perfumes • Imágenes • Rosarios • Amuletos

            </p>

        </div>

    </section>

    <section class="contenedorFiltros">

        <form action="catalogo.php" method="GET">

            <input

                type="text"

                name="buscar"

                placeholder="🔍 Buscar productos..."

                value="<?= htmlspecialchars($buscar) ?>">

            <select name="categoria">

                <option value="">

                    Todas las categorías

                </option>

                <?php

                while ($cat = $categorias->fetch(PDO::FETCH_ASSOC)) {

                ?>

                    <option

                        value="<?= $cat["id"] ?>"

                        <?= $categoria == $cat["id"] ? "selected" : ""; ?>>

                        <?= $cat["nombre"] ?>

                    </option>

                <?php } ?>

            </select>

            <select name="orden">

                <option value="recientes">

                    Más recientes

                </option>

                <option value="precioAsc">

                    Menor precio

                </option>

                <option value="precioDesc">

                    Mayor precio

                </option>

                <option value="nombre">

                    A-Z

                </option>

            </select>

            <button type="submit">

                <i class="fa-solid fa-magnifying-glass"></i>

                Buscar

            </button>

        </form>

    </section>

    <section class="catalogo">

        <div class="gridProductos">

            <?php

            if ($productos->rowCount() > 0) {

                while ($p = $productos->fetch(PDO::FETCH_ASSOC)) {

            ?>

                    <div class="producto">

                        <?php if ($p["oferta"] == 1) { ?>

                            <div class="etiqueta oferta">

                                OFERTA

                            </div>

                        <?php } ?>

                        <?php if ($p["nuevo"] == 1) { ?>

                            <div class="etiqueta nuevo">

                                NUEVO

                            </div>

                        <?php } ?>

                        <?php if ($p["mas_vendido"] == 1) { ?>

                            <div class="etiqueta top">

                                TOP

                            </div>

                        <?php } ?>

                        <div class="favorito">

                            <i class="fa-regular fa-heart"></i>

                        </div>

                        <div class="imagenProducto">

                            <img
                                src="img/productos/<?= $p["imagen"] ?>"
                                alt="<?= $p["nombre"] ?>">

                        </div>

                        <div class="infoProducto">

                            <span class="categoriaProducto">

                                <?= $p["categoria"] ?>

                            </span>

                            <h3>

                                <?= $p["nombre"] ?>

                            </h3>

                            <p>

                                <?= substr($p["descripcion"], 0, 110) ?>...

                            </p>

                            <div class="estrellas">

                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>

                            </div>

                            <div class="precios">

                                <?php if ($p["precio_anterior"] > 0) { ?>

                                    <span class="precioAnterior">

                                        $<?= number_format($p["precio_anterior"], 0, ",", ".") ?>

                                    </span>

                                <?php } ?>

                                <span class="precio">

                                    $<?= number_format($p["precio_venta"], 0, ",", ".") ?>

                                </span>

                            </div>

                            <?php

                            if ($p["precio_anterior"] > 0) {

                                $descuento = 100 - (($p["precio_venta"] * 100) / $p["precio_anterior"]);

                            ?>

                                <span class="descuento">

                                    <?= round($descuento) ?>% OFF

                                </span>

                            <?php } ?>

                            <div class="stock">

                                <?php

                                if ($p["stock"] > 20) {

                                ?>

                                    <span class="stockDisponible">

                                        <i class="fa-solid fa-circle-check"></i>

                                        Stock Disponible

                                    </span>

                                <?php

                                } elseif ($p["stock"] > 0) {

                                ?>

                                    <span class="stockBajo">

                                        <i class="fa-solid fa-triangle-exclamation"></i>

                                        Últimas unidades

                                    </span>

                                <?php

                                } else {

                                ?>

                                    <span class="stockAgotado">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        Agotado

                                    </span>

                                <?php

                                }

                                ?>

                            </div>

                            <div class="stockBarra">

                                <span
                                    style="width:<?= min(100, $p["stock"]) ?>%;">

                                </span>

                            </div>

                            <div class="botonesProducto">

                                <a
                                    href="producto.php?id=<?= $p["id"] ?>"
                                    class="btnVer">

                                    <i class="fa-solid fa-eye"></i>

                                    Ver

                                </a>

                                <?php if ($p["stock"] > 0) { ?>

                                    <button

                                        class="agregarCarrito"

                                        data-id="<?= $p["id"] ?>">

                                        <i class="fa-solid fa-cart-shopping"></i>

                                        Agregar

                                    </button>

                                <?php } else { ?>

                                    <button disabled>

                                        Sin Stock

                                    </button>

                                <?php } ?>

                            </div>

                        </div>

                    </div>

                <?php

                }
            } else {

                ?>

                <div class="sinProductos">

                    <i class="fa-solid fa-box-open"></i>

                    <h2>

                        No hay productos disponibles.

                    </h2>

                    <p>

                        Prueba otra búsqueda o categoría.

                    </p>

                </div>

            <?php

            }

            ?>
        </div>

    </section>

    <!-- ================= PAGINACIÓN ================= -->

    <section class="paginacion">

        <a href="#">

            <i class="fa-solid fa-angle-left"></i>

        </a>

        <a class="activo" href="#">1</a>

        <a href="#">2</a>

        <a href="#">3</a>

        <a href="#">4</a>

        <a href="#">

            <i class="fa-solid fa-angle-right"></i>

        </a>

    </section>

    <!-- ================= BENEFICIOS ================= -->

    <section class="beneficios">

        <div class="beneficio">

            <i class="fa-solid fa-truck-fast"></i>

            <h3>Envíos</h3>

            <p>

                Envíos a todo el país.

            </p>

        </div>

        <div class="beneficio">

            <i class="fa-solid fa-shield-heart"></i>

            <h3>Compra Segura</h3>

            <p>

                Protección en todas las compras.

            </p>

        </div>

        <div class="beneficio">

            <i class="fa-solid fa-credit-card"></i>

            <h3>Pagos</h3>

            <p>

                Tarjetas, Transferencia y Efectivo.

            </p>

        </div>

        <div class="beneficio">

            <i class="fa-brands fa-whatsapp"></i>

            <h3>Soporte</h3>

            <p>

                Atención por WhatsApp.

            </p>

        </div>

    </section>

    <!-- ================= NEWSLETTER ================= -->

    <section class="newsletter">

        <div class="newsletterContenido">

            <h2>

                Recibe nuestras ofertas

            </h2>

            <p>

                Suscríbete para enterarte de promociones y nuevos productos.

            </p>

            <form>

                <input

                    type="email"

                    placeholder="Correo electrónico">

                <button>

                    Suscribirme

                </button>

            </form>

        </div>

    </section>

    <!-- ================= FOOTER ================= -->

    <footer>

        <div class="footerGrid">

            <div>

                <img

                    src="img/logo/logo.png"

                    class="logoFooter"

                    alt="Logo">

                <p>

                    Santería Humos del Norte.

                </p>

                <p>

                    Todo para tu espiritualidad.

                </p>

            </div>

            <div>

                <h3>

                    Navegación

                </h3>

                <ul>

                    <li><a href="index.php">Inicio</a></li>

                    <li><a href="catalogo.php">Catálogo</a></li>

                    <li><a href="contacto.php">Contacto</a></li>

                    <li><a href="login.php">Mi Cuenta</a></li>

                </ul>

            </div>

            <div>

                <h3>

                    Categorías

                </h3>

                <ul>

                    <li>Velas</li>

                    <li>Sahumerios</li>

                    <li>Polvos</li>

                    <li>Perfumes</li>

                    <li>Rosarios</li>

                    <li>Amuletos</li>

                </ul>

            </div>

            <div>

                <h3>

                    Contacto

                </h3>

                <p>

                    <i class="fa-solid fa-location-dot"></i>

                    Salta Capital

                </p>

                <p>

                    <i class="fa-solid fa-phone"></i>

                    +54 387 XXX-XXXX

                </p>

                <p>

                    <i class="fa-solid fa-envelope"></i>

                    info@humosdelnorte.com

                </p>

                <div class="redes">

                    <a href="#">

                        <i class="fa-brands fa-facebook"></i>

                    </a>

                    <a href="#">

                        <i class="fa-brands fa-instagram"></i>

                    </a>

                    <a href="#">

                        <i class="fa-brands fa-whatsapp"></i>

                    </a>

                </div>

            </div>

        </div>

        <div class="copyright">

            © <?= date("Y") ?>

            Santería Humos del Norte.

            Todos los derechos reservados.

        </div>

    </footer>

    <script src="js/app.js"></script>

    <script src="js/catalogo.js"></script>

    <script src="js/carrito.js"></script>

</body>

</html>