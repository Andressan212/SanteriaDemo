<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin | Ventas</title>

<link rel="stylesheet" href="../css/estilos.css">
<link rel="stylesheet" href="../css/responsive.css">
<link rel="stylesheet" href="../css/admin.css">

</head>

<body>

<div class="adminLayout">

<aside class="sidebar">

<h2>Panel Admin</h2>

<ul>

<li><a href="index.html"> Dashboard</a></li>
<li><a href="productos.html"> Productos</a></li>
<li><a href="ventas.html"> Ventas</a></li>

</ul>

<button onclick="logout()">Cerrar Sesión</button>

</aside>

<main class="content">

<h1>Registro de Ventas</h1>

<!-- FORM VENTA -->

<div class="formBox">

<input type="text" id="cliente" placeholder="Cliente">

<input type="text" id="producto" placeholder="Producto">

<input type="number" id="cantidad" placeholder="Cantidad">

<input type="number" id="precio" placeholder="Precio Unitario">

<button onclick="registrarVenta()">

Registrar Venta

</button>

</div>

<!-- TABLA -->

<table>

<thead>

<tr>

<th>Cliente</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Total</th>
<th>Fecha</th>

</tr>

</thead>

<tbody id="tablaVentas">

</tbody>

</table>

</main>

</div>

<script src="../js/ventas.js"></script>

<script>

function logout(){

localStorage.removeItem("usuarioLogueado");

window.location="../login.html";

}

</script>

</body>

</html>