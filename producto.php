<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Producto</title>

<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/producto.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

<script src="https://kit.fontawesome.com/4b7d1b7b0f.js" crossorigin="anonymous"></script>

</head>

<body>

<header>

<div class="logo">

<img src="img/logo/logo.png">

<h1>Santería Luz Divina</h1>

</div>

<nav>

<ul>

<li><a href="index.html">Inicio</a></li>
<li><a href="catalogo.html">Catálogo</a></li>
<li><a href="carrito.html">Carrito</a></li>

</ul>

</nav>

<div class="acciones">

<button class="login">

<i class="fa-solid fa-user"></i>

Iniciar Sesión

</button>

<button class="carrito">

🛒

<span id="contadorCarrito">0</span>

</button>

</div>

</header>

<section class="productoDetalle">

<div class="galeria">

<img src="img/productos/vela1.jpg" id="imagenPrincipal">

<div class="miniaturas">

<img src="img/productos/vela1.jpg">

<img src="img/productos/vela2.jpg">

<img src="img/productos/incienso.jpg">

<img src="img/productos/rosario.jpg">

</div>

</div>

<div class="detalle">

<h1>Veladora Blanca</h1>

<div class="estrellas">

★★★★★

</div>

<h2>$3500</h2>

<p>

Veladora utilizada para limpiezas espirituales,
protección y armonización del hogar.

</p>

<label>

Cantidad

</label>

<input
type="number"
value="1"
min="1"
max="50">

<div class="botones">

<button id="comprar">

Comprar Ahora

</button>

<button id="carritoBtn">

Agregar al Carrito

</button>

</div>

<h3>

Descripción

</h3>

<p>

Producto artesanal de excelente calidad.

Duración aproximada de 7 días.

</p>

<h3>

Características

</h3>

<ul>

<li>✔ Cera Premium</li>

<li>✔ Hecha a mano</li>

<li>✔ Larga duración</li>

<li>✔ Excelente calidad</li>

<li>✔ Industria Argentina</li>

</ul>

</div>

</section>

<section class="relacionados">

<h2>

Productos Relacionados

</h2>

<div class="gridProductos">

<div class="producto">

<img src="img/productos/aceite.jpg">

<div class="infoProducto">

<h3>Aceite de Ruda</h3>

<h4>$4100</h4>

<button>

Ver

</button>

</div>

</div>

<div class="producto">

<img src="img/productos/sanbenito.jpg">

<div class="infoProducto">

<h3>San Benito</h3>

<h4>$4600</h4>

<button>

Ver

</button>

</div>

</div>

<div class="producto">

<img src="img/productos/incienso.jpg">

<div class="infoProducto">

<h3>Incienso Premium</h3>

<h4>$2900</h4>

<button>

Ver

</button>

</div>

</div>

</div>

</section>

<script src="js/app.js"></script>
<script src="js/producto.js"></script>

</body>

</html>