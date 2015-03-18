<?php
include("conexion.php");
@$opc = $_REQUEST['opc'];
@$informacion = array();

@$idprop = $_REQUEST['id_prop'];
@$nombre = $_POST['nombre'];
@$apellido = $_POST['apellido'];
@$telefono = $_POST['telefono'];
@$movil = $_POST['movil'];
@$email = $_POST['email'];
@$direccion = $_POST['direccion'];

@$eliminar = $_POST['elim'];

//SUBIR ARCHIVOS
@$upload_folder ='../images/contratos';
@$nombre_archivo = $_FILES['contrato']['name'];
@$tmp_archivo = $_FILES['contrato']['tmp_name'];
// @$tipo_archivo = $_FILES['contrato']['type'];
// @$tamano_archivo = $_FILES['contrato']['size'];
//


switch ($opc) {
	case 'crear':
		$crea = mysql_query("INSERT INTO propietarios VALUES('$idprop','$nombre','$apellido','$telefono','$movil','$email','$direccion') ");
		if($crea==true)
		{
			for($i=0;$i<count($nombre_archivo);$i++)
			{
				@$archivador = $upload_folder . '/' .$idprop.'_'.$nombre_archivo[$i];
				move_uploaded_file($tmp_archivo[$i], $archivador);
				$crea2 = mysql_query("INSERT INTO contratos VALUES('','$idprop','$archivador') ");
			}

			$encript = crypt_blowfish_bycarluys($idprop);
			$crusu = mysql_query("INSERT INTO usuarios VALUES('$idprop','$encript','propietario') ") ;
			$respuesta['status'] = 'correcto';
		}
		else
			$respuesta['status'] = 'error';
		echo json_encode($respuesta);
	break;
	case 'carga_basic':
		$sel = mysql_query("SELECT * FROM propietarios WHERE Id_prop='$idprop' ");
		$resp = mysql_fetch_object($sel);
		$informacion[]=$resp;
		$sel = mysql_query("SELECT  * FROM contratos WHERE Id_prop='$idprop' ");
		while($resp = mysql_fetch_object($sel))
		{
			$informacion[]=$resp;
		}
		echo '{"Propietario":'.json_encode($informacion).'}';
	break;
	case 'editar':
		$act = mysql_query("UPDATE propietarios SET Nom_prop='$nombre',Apel_prop='$apellido',Tel_prop='$telefono',Mov_prop='$movil',Email_prop='$email',Direc_prop='$direccion'
			   WHERE Id_prop='$idprop' ");
		for($i=0;$i<count($nombre_archivo);$i++)
			{
				@$archivador = $upload_folder . '/' .$idprop.'_'.$nombre_archivo[$i];
				move_uploaded_file($tmp_archivo[$i], $archivador);
				$crea2 = mysql_query("INSERT INTO contratos VALUES('','$idprop','$archivador') ");
			}
		for($i=0;$i<count($eliminar);$i++)
		{
			$eli = mysql_query("DELETE FROM contratos WHERE Id_cont='$eliminar[$i]' ");
		}
		$respuesta['status'] = 'correcto';
		echo json_encode($respuesta);
	break;
	default:
		break;
}

function crypt_blowfish_bycarluys($password, $digito = 7) {
	$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$salt = sprintf('$2a$%02d$', $digito);
	for($i = 0; $i < 22; $i++)
	{
	 $salt .= $set_salt[mt_rand(0, 63)];
	}
	return crypt($password, $salt);
}

?>