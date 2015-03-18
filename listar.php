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
<section id="listart">
<h2>Listar Inmuebles</h2>
<div id="busquedas">
	<form>
		<label>Busquedas por: </label><input type="number" placeholder="Codigo"> <input type="number" placeholder="Id Propietario"> <select>
			<option>Selecciona</option>
			<option>Bloqueados</option>
			<option>Desbloqueados</option>
			<option>Activados</option>
			<option>Desactivados</option>
		</select>
		<input type="submit" value="Buscar">
	</form>
</div>
<table>
	<thead>
		<td>Codigo</td>
		<td>T/Servicio</td>
		<td>Id Propietario</td>
		<td>Id Arrendatario</td>
		<td>Bloquear</td>
		<td>Desactivar</td>
		<td>Editar</td>
		<td>ligar</td>
	</thead>
	<tbody>
	<tr>
		<td>003</td>
		<td>Venta</td>
		<td>80360011</td>
		<td></td>
		<td><input type="checkbox" name="bloqueo" value=""></td>
		<td><input type="checkbox" name="bloqueo" value=""></td>
		<td><a href="">Editar</a></td>
		<td></td>

	</tr>
	<tr>
		<td>002</td>
		<td>Arriendo</td>
		<td>80360011</td>
		<td></td>
		<td><input type="checkbox" name="bloqueo" value=""></td>
		<td><input type="checkbox" name="bloqueo" value=""></td>
		<td><a href="">Editar</a></td>
		<td><a href="">ligar</a></td>

	</tr>
	<tr>
		<td>001</td>
		<td>Arriendo</td>
		<td>80360011</td>
		<td>1032406721</td>
		<td><input type="checkbox" name="bloqueo" value=""></td>
		<td><input type="checkbox" name="bloqueo" value=""></td>
		<td><a href="">Editar</a></td>
		<td></td>

	</tr>

	</tbody>
</table>

</section>
<!-- <footer>
<div id="foot">
<div class="footersec">
	<h2>Información de contacto</h2>
	<p><strong>Email:</strong> correo@inmobiliariaandapref.com</p>
	<p><strong>Telefono:</strong> (8) 671 60 46 - 668 44 11</p>
	<p><strong>Celular:</strong> +57 311 232 7508 - 311 207 20 22</p>
	<p><strong>Dirección:</strong> Calle 15 No 371-53 Ofc 102 Bloque 7 Esperanza 8va. Etapa</p>
</div>

<div class="footersec">
	<h2>Deseas recibir mas Información</h2>
	<p>Ingresa tu correo para recibir mas informacion</p><p>acerca de novedades en nuestros productos.</p>
	<form>
		<input type="email" placeholder="Email" required>
		<input type="submit" value="Enviar">
	</form>
</div>

<div class="footersec">
	<h2>Con el respaldo de:</h2>
	<img src="images/seguros_bolivar.png">
	<img src="images/libertador.png">

</div>
	<hr class="divi1">
	<div id="copyright">
            <p>Copyright © Inmobiliaria Andapref SAS, 2015.Todos los derechos reservados diseñado por <a href="http://inngeniate.com/"> Inngeniate.com</a></p>
            <div id="logo">
                <img src="images/logoinn.png">
            </div>
        </div>
        </div>
</footer> -->
</body>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/script-menu.js"></script>
</html>