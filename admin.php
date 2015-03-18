<?php
session_start();
if (isset($_SESSION['tipousu']) && $_SESSION['tipousu']=='admin') {
  header('Location: adminpref');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width , initial-scale=1 ,maximum-scale=1 user-scalable=no" />
<meta name="keywords" lang="es" content="">
<meta name="robots" content="All">
<meta name="description" lang="es" content="">
<title>Inmobiliaria Andapref</title>
<link rel="stylesheet" href="css/normalize.css" />
<link rel="stylesheet" href="css/stylesheet.css" />
<link rel="stylesheet" href="css/style1.css" />
<link rel="stylesheet" href="css/responsivemobilemenu.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/style-menu.css">
<link rel="stylesheet" href="css/msj.css" />
</head>
<body>
<header>
	<div id="top-lado1"><a href="#"><img src="images/logo.png"></a></div>
	<div id="top-lado2"><a href="#">correo@inmobiliariaandapref.com</a></div>
</header>
<nav>

</nav>
<section>
<div id="sesionp">
<div id="sesionini">
<form id="logueo">
	<h2>Inicio de Sesión</h2>
	<h3>Administrador</h3>
	<img src="images/logo.png">
	<input type="text" placeholder="Usuario" name="usuario" required>
	<input type="password" placeholder="Contraseña" name="password" required>
	<input type="submit" value="Iniciar">
</form>
</div>
</div>
</section>
<footer>
</footer>
</body>
<script src ='js/jquery-1.7.2.min.js'></script>
<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
<script type="text/javascript" src="js/script-menu.js"></script>
<script src="js/script_login.js"></script>
</html>