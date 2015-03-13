<?php
include("conexion.php");
@$opc = $_REQUEST['opc'];

@$idprop = $_POST['id_prop'];
@$nombre = $_POST['nombre'];
@$apellido = $_POST['apellido'];
@$telefono = $_POST['telefono'];
@$movil = $_POST['movil'];
@$email = $_POST['email'];
@$direccion = $_POST['direccion'];

//SUBIR ARCHIVOS
@$upload_folder ='../images/contratos';
@$nombre_archivo = $_FILES['contrato']['name'];
@$tmp_archivo = $_FILES['contrato']['tmp_name'];
// @$tipo_archivo = $_FILES['contrato']['type'];
// @$tamano_archivo = $_FILES['contrato']['size'];
//


switch ($opc) {
	case 'crear':
		$crea = mysql_query("INSERT INTO propietario VALUES('$idprop','$nombre','$apellido','$telefono','$movil','$email','$direccion') ");
		if($crea==true)
		{
			for($i=0;$i<count($nombre_archivo);$i++)
			{
				@$archivador = $upload_folder . '/' . $nombre_archivo[$i];
				move_uploaded_file($tmp_archivo[$i], $archivador);
				$crea2 = mysql_query("INSERT INTO contratos VALUES('$idprop','$archivador') ");
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