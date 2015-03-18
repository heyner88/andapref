<?php
session_start();
if (!isset($_SESSION['tipousu'])){
  	header('Location: arrenda');
}
else
	if($_SESSION['tipousu']!='arrendatario')
		header('Location: arrenda');
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
		<a href="arrendatario">Facturación</a>
	</li>
	<li>
		<a href="solicitud-arrendatario">Solicitudes</a>
	</li>
	<li>
		<a href="libs/logout">Cerrar Sesión</a>
	</li>


</ul>
</div>
</nav>
<section id="listart">
<h2>Facturación</h2>
<div id="busq1">
<div id="busquedas">

	<h2>Busqueda entre fechas </h2>

	<br>
	<form>
		<label>Busquedar por:
		<input type="date"> <input type="date">
		<input type="submit" value="Buscar">
	</form>
</div>
</div>
<div id="busq2">

</div>
<table>
	<thead>
		<td>No</td>
		<td>Id Arrendatario</td>
		<td>Periodo Inicial</td>
		<td>Periodo Final</td>
		<td>Factura</td>
		<td>Acción</td>

	</thead>
	<tbody>
	<tr>
		<td>003</td>
		<td>80360011</td>
		<td>12-02-2015</td>
		<td>12-02-2015</td>
		<td><a href="">Fact08104192015</a></td>
		<td><a href="">Descargar</a></td>


	</tr>
	<tr>
		<td>002</td>
		<td>80360011</td>
		<td>12-02-2015</td>
		<td>12-02-2015</td>
		<td><a href="">Fact08103192015</a></td>
		<td><a href="">Descargar</a></td>


	</tr>
	<tr>
		<td>001</td>
		<td>80360011</td>
		<td>12-02-2015</td>
		<td>12-02-2015</td>
		<td><a href="">Fact08102192015</a></td>
		<td><a href="">Descargar</a></td>


	</tr>

	</tbody>
</table>

</section>

</body>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/script-menu.js"></script>
</html>