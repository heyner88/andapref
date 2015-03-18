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
	<h2>Editar Inmueble</h2>
	<form id="edit_inm">
		<input type="number" placeholder="Codigo" name="codigo" id="cod_inm" required>
		<input type="number" placeholder="Id Propietario" name="id_prop" required>
		<select name="tipo">
			<option value="">Tipo de Inmubele</option>
			<?php
				include("libs/conexion.php");
				$sel = mysql_query("SELECT * FROM tipo_inmueble");
				while($resp=mysql_fetch_object($sel))
				{
					echo'<option>'.$resp->Tipo_inm.'</option>';
				}
			?>
		</select>
		<input type="number" placeholder="Mt2" name="mt2" required>
		<input type="number" placeholder="Habitaciones" name="habitaciones" required>
		<input type="number" placeholder="Baños" name="banos" required>
		<select name="parqueadero">
			<option value="">Parqueadero</option>
			<option>SI</option>
			<option>NO</option>
		</select>
		<select name="servicio">
			<option value="">Servicio</option>
			<option>Arriendo</option>
			<option>Venta</option>
		</select>
		<input type="number" placeholder="Valor" name="valor" required>
		<select name="departamento" required>
			<option value="">Departamento</option>
			<?php
				$sel = mysql_query("SELECT * FROM departamentos");
				while($resp=mysql_fetch_object($sel))
				{
					echo'<option value="'.$resp->id.'">'.$resp->nombre.'</option>';
				}
			?>
		</select>
		<select name="ciudad" required>
			<option value="">Ciudad</option>
		</select>
		<input type="text" placeholder="Barrio" name="barrio" required>
		<p>Ubicación de Google Maps</p>
		<input type="text" placeholder="Ubicación en X" name="ux" required>
		<input type="text" placeholder="Ubicación en Y" name="uy" required>

</div>
<div id="crear2">
	<h2>Descripciones</h2>
		<textarea placeholder="Descripción 1" name="des1" required></textarea>
		<textarea placeholder="Descripción 2" name="des2" required></textarea>
		<h2>Fotografia destacada</h2>
		<div id="destacada"></div><br>
		<div class="subir"><input type="file" id="destaca"></div>
		<p>Fotografias maximo 10</p>
		<div id="existentes"></div><br>
		<div class="subir"><input type="file"> <a href="javascript:void(0)"  class="agrega">Mas</a></div>
	<input type="submit" value="Guardar">
	</form>
</div>


</section>
</body>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/script-menu.js"></script>
<script type="text/javascript" src="js/script_editinmu.js"></script>
</html>