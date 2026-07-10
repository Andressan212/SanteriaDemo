<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin | Inventario</title>

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
<li><a href="inventario.html"> Inventario</a></li>

</ul>

<button onclick="logout()">Cerrar Sesión</button>

</aside>

<main class="content">

<h1>Control de Inventario</h1>

<table>

<thead>

<tr>

<th>Producto</th>
<th>Categoría</th>
<th>Stock</th>
<th>Estado</th>

</tr>

</thead>

<tbody id="tablaInventario">

</tbody>

</table>

</main>

</div>

<script src="../js/inventario.js"></script>

<script>

function logout(){

localStorage.removeItem("usuarioLogueado");

window.location="../login.html";

}

</script>

</body>

</html>