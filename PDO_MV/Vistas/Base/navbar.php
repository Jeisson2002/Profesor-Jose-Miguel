<?php
    define('BASE_URL', '/PDO_MV/Vistas/')
?>

<div class="navbar">
    <a href="<?= BASE_URL ?>inicio.php">Inicio</a>
    <div class="dropdown">
        <button class="dropbtn">Empleados
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="<?= BASE_URL ?>Empleados/lista-empleados.php">Lista Empleados</a>
            <a href="<?= BASE_URL ?>Empleados/crear-empleado.php">Subir Empleado</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Clientes
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="<?= BASE_URL ?>Clientes/lista-clientes.php">Lista Clientes</a>
            <a href="<?= BASE_URL ?>Clientes/crear-cliente.php">Subir Cliente</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Productos
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="<?= BASE_URL ?>Productos/lista-productos.php">Lista Productos</a>
            <a href="<?= BASE_URL ?>Productos/crear-producto.php">Subir Producto</a>
            <a href="<?= BASE_URL ?>Productos/Categorias/lista-categorias.php">Categorías</a>
            <a href="<?= BASE_URL ?>Productos/Estados/lista-estados.php">Estados</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Ventas
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="<?= BASE_URL ?>Ventas/lista-ventas.php">Lista Ventas</a>
            <a href="<?= BASE_URL ?>Ventas/crear-venta.php">Subir Venta</a>
            <a href="<?= BASE_URL ?>Ventas/TiposVenta/lista-tipos-venta.php">Tipos Venta</a>
        </div>
    </div>
    <a href="#news">Configuración</a>
</div>