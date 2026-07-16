<div class="sidebar">

    <div class="logoAdmin">

        <img src="../img/logo/logo.png" alt="Logo">

        <h2>Humos del Norte</h2>

        <div class="adminInfo">

            <div class="avatar">

                <i class="fa-solid fa-user-shield"></i>

            </div>

            <h3>

                <?= $_SESSION["admin_nombre"] . " " . $_SESSION["admin_apellido"]; ?>

            </h3>

            <span>

                <?= $_SESSION["admin_rol"]; ?>

            </span>

        </div>

    </div>

    <ul class="menuAdmin">

        <li><!--idashboard-->
            <a href="adm-index.php">
                <i class="fa-solid fa-gauge-high"></i>
                Interface visual
            </a>
        </li>

        <li>
            <a href="productos.php">
                <i class="fa-solid fa-box"></i>
                Productos
            </a>
        </li>
        <li>

            <a href="inventario.php">
                <i class="fa-solid fa-boxes-stacked"></i>
                Inventario

            </a>

        </li>
        <li>
            <a href="categorias.php">
                <i class="fa-solid fa-layer-group"></i>
                Categorías
            </a>
        </li>

        <li>
            <a href="inventario.php">
                <i class="fa-solid fa-warehouse"></i>
                Inventario
            </a>
        </li>

        <li>
            <a href="ventas.php">
                <i class="fa-solid fa-cash-register"></i>
                Ventas
            </a>
        </li>

        <li>
            <a href="clientes.php">
                <i class="fa-solid fa-users"></i>
                Clientes
            </a>
        </li>

        <li>
            <a href="pedidos.php">
                <i class="fa-solid fa-cart-shopping"></i>
                Pedidos
            </a>
        </li>

        <li>
            <a href="ganancias.php">
                <i class="fa-solid fa-chart-line"></i>
                Ganancias
            </a>
        </li>

        <li>
            <a href="reportes.php">
                <i class="fa-solid fa-file-lines"></i>
                Reportes
            </a>
        </li>

        <li>
            <a href="administradores.php">
                <i class="fa-solid fa-user-shield"></i>
                Administradores
            </a>
        </li>

        <li>
            <a href="configuracion.php">
                <i class="fa-solid fa-gear"></i>
                Configuración
            </a>
        </li>
        <li>

            <a href="historial_inventario.php">
                <i class="fa-solid fa-clipboard-list"></i>
                Historial Inventario

            </a>

        </li>
        <li class="salir">
            <a href="../logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Cerrar Sesión
            </a>
        </li>

    </ul>

</div>