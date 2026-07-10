<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin | Ganancias</title>

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
<li><a href="inventario.html">Inventario</a></li>
<li><a href="ganancias.html">Ganancias</a></li>

</ul>

<button onclick="logout()">Cerrar Sesión</button>

</aside>

<main class="content">

<h1>Ganancias del Sistema</h1>

<div class="cards">

<div class="card">

<h3>Total Ventas</h3>

<p id="totalVentas">$0</p>

</div>

<div class="card">

<h3>Costo Total</h3>

<p id="totalCosto">$0</p>

</div>

<div class="card">

<h3>Ganancia Neta</h3>

<p id="ganancia">$0</p>

</div>

</div>

</main>

</div>

<script src="../js/ganancias.js"></script>

<script>

function logout(){

localStorage.removeItem("usuarioLogueado");

window.location="../login.html";

}

</script>

</body>

</html>