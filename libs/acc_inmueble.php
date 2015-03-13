<?php
include("conexion.php");
@$opc = $_REQUEST['opc'];

@$codigo = $_POST['codigo'];
@$idprop = $_POST['id_prop'];
@$tipo = $_POST['tipo'];
@$mt2 = $_POST['mt2'];
@$habitaciones = $_POST['habitaciones'];
@$banos = $_POST['banos'];
@$parqueadero = $_POST['parqueadero'];
@$servicio = $_POST['servicio'];
@$valor = $_POST['valor'];
@$barrio = $_POST['barrio'];
@$ux = $_POST['ux'];
@$uy = $_POST['uy'];
@$des1 = $_POST['des1'];
@$des2 = $_POST['des2'];


//SUBIR ARCHIVOS
@$folder_destacada ='../images/destacada';
@$nombre_destacada = $_FILES['destacada']['name'];
@$tmp_destacada = $_FILES['destacada']['tmp_name'];

@$folder_galeria ='../images/galeria';
@$nombre_foto = $_FILES['foto']['name'];
@$tmp_foto = $_FILES['foto']['tmp_name'];
//

switch ($opc) {
	case 'crear':
		@$archivador = $folder_destacada . '/' .$codigo.'_'.$nombre_destacada;
		$crea = mysql_query("INSERT INTO inmuebles VALUES('$codigo','$idprop','$tipo','$mt2','$habitaciones','$banos','$parqueadero','$servicio','$valor','$barrio','$ux','$uy','$des1','$des2','$archivador') ");
		if($crea==true)
		{
			move_uploaded_file($tmp_destacada, $archivador);
			for($i=0;$i<count($nombre_foto);$i++)
			{
				@$archivador = $folder_galeria . '/' .$codigo.'_'.$nombre_foto[$i];
				move_uploaded_file($tmp_foto[$i], $archivador);
				$crea2 = mysql_query("INSERT INTO galeria VALUES('','$codigo','$archivador') ");
			}
			$respuesta['status'] = 'correcto';
		}
		else
			$respuesta['status'] = 'error';
		echo json_encode($respuesta);
	break;

	default:
		# code...
		break;
}

?>