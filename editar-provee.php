<?php
session_start();
if (!isset($_SESSION['tipousu'])){
  	header('Location: admin');
}
else
	if($_SESSION['tipousu']!='admin')
		header('Location: admin');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width , initial-scale=1 ,maximum-scale=1 user-scalable=no" />
<title>Inmobiliaria Andapref</title>
<link rel="stylesheet" href="css/normalize.css" />
<link rel="stylesheet" href="css/stylesheet.css" />
<link rel="stylesheet" href="css/style1.css" />
<link rel="stylesheet" type="text/css" href="css/style-menu.css">
<link rel="stylesheet" type="text/css" href="css/msj.css">
<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
</head>
<body>
<header>
	<div id="top-lado1"><a href="#"><img src="images/logo.png"></a></div>
	<div id="top-lado2"><a href="#">correo@inmobiliariaandapref.com</a></div>
</header>
<nav>
	<div class="container">
<a class="toggleMenu" href="#">Menu</a>
<ul class="nav">
	<li  class="test">
		<a href="adminpref">Crear Inmueble</a>
	</li>
	<li>
		<a href="crear-proveedor">Crear Proveedor</a>
	</li>
	<li>
		<a href="#">Editar</a>
		<ul>
			<li>
				<a href="editar-provee">Editar Proveedor</a>
			</li>
			<li>
				<a href="editar-inmueble">Editar Inmueble</a>
			</li>
			<li>
				<a href="editar-arren">Editar Arrendatario</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="ligar">Ligar</a>
	</li>
	<li>
		<a href="listar">Listar</a>
	</li>
	<li>
		<a href="estadosadmin">Est de Cuenta</a>
	</li>
	<li>
		<a href="facturacion">Facturación</a>
	</li>
	<li>
		<a href="libs/logout">Cerrar Sesión</a>
	</li>
</ul>
</div>
</nav>
<section id="crearpref">
<div id="crear1">
	<h2>Editar Proveedor</h2>
	<p>Ingresa la identificación del propietario para editar.</p>
	<form id="edit_prov">
		<input type="number" placeholder="Id Propietario" name="id_prop" id="id_prop" required>
		<input type="text" placeholder="Nombre" name="nombre" required>
		<input type="text" placeholder="Apellido" name="apellido" required>
		<input type="text" placeholder="Telefono fijo" name="telefono" required>
		<input type="text" placeholder="Movil" name="movil" required>
		<input type="text" placeholder="Email" name="email">
		<input type="text" placeholder="Direccion" name="direccion" required>
</div>
<div id="crear2">
	<h2>Contrato</h2>
	<div id="existente"></div>
	<h2>Agregar</h2>
		<div class="subir"><input type="file" name="contrato[]"> <a href="javascript:void(0)" class="agrega">Mas</a></div>
	<input type="submit" value="Guardar">
	</form>
</div>


</section>
</body>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/script-menu.js"></script>
<script type="text/javascript" src="js/script_editprop.js"></script>
</html>