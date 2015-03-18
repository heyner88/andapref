<?php
  include("libs/conexion.php");
  @$precio = $_GET['pr'];

  @$codigo = $_POST['codigo'];

	if(isset($codigo))
		$bus =mysql_query("SELECT COUNT(Cod_inm) FROM inmuebles where Serv_inm='Venta' and Cod_inm='$codigo' ");
	else
	  $bus =mysql_query("SELECT COUNT(Cod_inm) FROM inmuebles where Serv_inm='Venta' ");
  $row = mysql_fetch_row($bus);

  // total de resultados
  $rows = $row[0];
  // numero de resultados mostrados por pagina
  $page_rows = 8;
  // numero de la ultima pagina
  $last = ceil($rows/$page_rows);
  // hace que $last no pueda ser menos de 1
  if($last < 1){
    $last = 1;
  }
  // establece en numero de pagina
$pagenum = 1;
// obtiene la pagina de la URl si esta presente si no es igual a 1
if(isset($_GET['pn'])){
  $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
//  asegura que la pagina no sea menor de 1 or mas que la ultima pagina
if ($pagenum < 1) {
    $pagenum = 1;
} else if ($pagenum > $last) {
    $pagenum = $last;
}

$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
if(isset($precio))
{
	if($precio=='me')
		$orden = 'Val_inm ASC';
	else
		$orden = 'Val_inm DESC';
}
else
	$orden = 'Cod_inm DESC';

if(isset($codigo))
	$bus = mysql_query("SELECT * from inmuebles where Serv_inm='Venta' AND Cod_inm='$codigo' ORDER BY $orden $limit") ;
else
	$bus = mysql_query("SELECT * from inmuebles where Serv_inm='Venta' ORDER BY $orden $limit") ;
// muestra en que pagina esta y el total de paginas
$textline1 = "Historial (<b>$rows</b>)";
$textline2 = "Página <b>$pagenum</b> de <b>$last</b>";
// Establece la variable $paginationCtrls
$paginationCtrls = '';

if($last != 1){

  if ($pagenum > 1) {
        $previous = $pagenum - 1;
    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'&pr='.$precio.'">Anterior</a> &nbsp; &nbsp; ';

    for($i = $pagenum-4; $i < $pagenum; $i++){
      if($i > 0){
            $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'&pr='.$precio.'">'.$i.'</a> &nbsp; ';
     	 }
      }
    }

  $paginationCtrls .= ''.$pagenum.' &nbsp; ';

  for($i = $pagenum+1; $i <= $last; $i++){
    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'&pr='.$precio.'">'.$i.'</a> &nbsp; ';
    if($i >= $pagenum+4){
      break;
    }
  }

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'&pr='.$precio.'">Siguiente</a> ';
    }
}
$list = '';
while($row = mysql_fetch_array($bus, MYSQLI_ASSOC)){

  $list.='<div class="busqueda-inm">
		<div class="imagen-inmuble">
			<a href="javascript:void(0)" class="detalle" id="'.$row['Cod_inm'].'"><img src="'.substr($row['Img_inm'],1).'"></a>
		</div>
			<div class="descripcion-basica">
			<h3><span class="inma">Venta</span><a href="javascript:void(0)" class="detalle" id="'.$row['Cod_inm'].'">Codigo: '.$row['Cod_inm'].'</a></h3>
			<div class="carac-inmueble">
				<ul>
					<li><span class="icon-plano"></span> '.$row['Mt2_inm'].' m2</li>
					<li><span class="icon-cuarto"></span>'.$row['Habit_inm'].'</li>
					<li><span class="icon-bano"></span>'.$row['Ban_inm'].'</li>
					<li><span class="icon-parqueo"></span>'.$row['Parq_inm'].'</li>
				</ul>
			</div>
			<h4>Valor: $ '.$row['Val_inm'].'</h4>
			<hr class="divi1">
			<p>'.$row['Desc1_inm'].'</p>
			<hr class="divi1">
			<p><span class="icon-location"></span>Ubicacion: '.$row['Barr_inm'].'</p>
		</div>
	</div>';
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
<title>Inmuebles en Venta | Inmobiliaria Andapref</title>
<link rel="stylesheet" href="css/normalize.css" />
<link rel="stylesheet" href="css/stylesheet.css" />
<link rel="stylesheet" href="css/style1.css" />
<link rel="stylesheet" href="css/responsivemobilemenu.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/style-menu.css">
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
		<a href="#">Inicio</a>
	</li>
	<li>
		<a href="nuestra-empresa">Nosotros</a>

	</li>
	<li>
		<a href="#">Inmuebles</a>
		<ul>
			<li>
				<a href="inmuebles-arriendo">Arriendo</a>
			</li>
			<li>
				<a href="inmuebles-venta">Venta</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#">Servicios</a>
	</li>
	<li>
		<a href="#">Propietarios</a>
		<ul>
			<li>
				<a href="propieta" target="blank">Estados de Cuenta</a>
			</li>
			<li>
				<a href="requisistos-inmueble-arriendo">Requisitos para dejar un inmueble en Arriendo</a>
			</li>
			<li>
				<a href="requisistos-inmueble-venta">Requisitos para dejar un inmueble en Venta</a>
			</li>

		</ul>
	</li>
	<li>
		<a href="#">Arrendatarios</a>
		<ul>
			<li>
				<a href="requisistos-arrendar-inmueble">Requisitos para tomar un inmueble en Arriendo</a>
			</li>
			<li>
				<a href="arrenda" target="blank">Consulte su Factura</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="contacto">Contáctenos</a>
	</li>


</ul>
</div>
</nav>
<section class="contenido">
<div id="inm-iz">
	<div id="busquedac">
		<h2>Busqueda</h2>
		<div id="buqueda2">
		<form id="filtro1" method="post" action="inmuebles-venta">
			<input type="number" placeholder="Codigo" name="codigo" required>
			<input type="submit" value="Buscar">
		</form>
		<form id="filtro2">
			<?php
				include("libs/conexion.php");
				echo'<select required name="departamento">
						<option value="">Departamento</option>';
				$sel = mysql_query("SELECT * FROM departamentos");
				while($resp=mysql_fetch_object($sel))
				{
					echo'<option value="'.$resp->id.'">'.$resp->nombre.'</option>';
				}
				echo'</select>';
				echo'<select required name="ciudad">
						<option value="">Ciudad</option>
				</select>';
				echo'<select required name="barrio">
						<option value="">Barrio</option>
				</select>';

				echo'<select required name="tipo">
						<option value="">Tipo de Inmueble</option>';
				$sel = mysql_query("SELECT * FROM tipo_inmueble");
				while($resp=mysql_fetch_object($sel))
				{
					echo'<option>'.$resp->Tipo_inm.'</option>';
				}
				echo'</select>';

				echo'<select required name="habita">
						<option value="">Habitaciones</option>';
				$sel = mysql_query("SELECT * FROM inmuebles GROUP BY Habit_inm");
				while($resp=mysql_fetch_object($sel))
				{
					echo'<option>'.$resp->Habit_inm.'</option>';
				}
				echo'</select>';

				echo'<select required name="banos">
						<option value="">Baños</option>';
				$sel = mysql_query("SELECT * FROM inmuebles GROUP BY Ban_inm");
				while($resp=mysql_fetch_object($sel))
				{
					echo'<option>'.$resp->Ban_inm.'</option>';
				}
				echo'</select>';
			?>

			<input type="submit" value="Buscar">
		</form>
		</div>
	</div>
</div>
<div id="inm-de">
	<h2>Listado de Inmuebles</h2>
	<div id="cont-organizado">
	<?php
		echo'<a href="'.$_SERVER['PHP_SELF'].'?pr=me">Menor Precio</a>';
		echo'<a href="'.$_SERVER['PHP_SELF'].'?pr=ma">Mayor Precio</a>';
	?>
	</div>

	<?php echo $list; ?>
	<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>

</div>

</section>
<footer>
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
</footer>

</body>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
<script type="text/javascript" src="js/script-menu.js"></script>
<script type="text/javascript" src="js/script_listado.js"></script>
</html>