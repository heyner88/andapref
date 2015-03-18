<?php
include("conexion.php");
@$opc = $_REQUEST['opc'];
@$informacion = array();

@$codigo = $_REQUEST['codigo'];
@$idprop = $_POST['id_prop'];
@$tipo = $_POST['tipo'];
@$mt2 = $_POST['mt2'];
@$habitaciones = $_POST['habitaciones'];
@$banos = $_POST['banos'];
@$parqueadero = $_POST['parqueadero'];
@$servicio = $_POST['servicio'];
@$valor = $_POST['valor'];
@$departamento = $_REQUEST['departamento'];
@$ciudad = $_REQUEST['ciudad'];
@$barrio = $_POST['barrio'];
@$ux = $_POST['ux'];
@$uy = $_POST['uy'];
@$des1 = $_POST['des1'];
@$des2 = $_POST['des2'];

@$eliminar = $_POST['elim'];

//SUBIR ARCHIVOS
@$folder_destacada ='../images/destacada';
@$nombre_destacada = $_FILES['destacada']['name'];
@$tmp_destacada = $_FILES['destacada']['tmp_name'];

@$folder_galeria ='../images/galeria';
@$nombre_foto = $_FILES['foto']['name'];
@$tmp_foto = $_FILES['foto']['tmp_name'];
//

//Datos arriendo
@$recargo = $_POST['recargo'];
@$admintr = $_POST['admintr'];
@$id_arren = $_POST['id_arren'];
@$nombre = $_POST['nombre'];
@$apellido = $_POST['apellido'];
@$email = $_POST['email'];
@$telefono = $_POST['telefono'];
@$movil = $_POST['movil'];
@$f_inicio = $_POST['f_inicio'];
///

switch ($opc) {
	case 'crear':
		$sel = mysql_query("SELECT * FROM propietarios WHERE Id_prop='$idprop' ");
		if(mysql_num_rows($sel)!=0)
		{
			if($nombre_destacada!='')
				@$archivador = $folder_destacada . '/' .$codigo.'_'.$nombre_destacada;
			else
				$archivador = '';
			$crea = mysql_query("INSERT INTO inmuebles VALUES('$codigo','$idprop','$tipo','$mt2','$habitaciones','$banos','$parqueadero','$servicio','$valor','$departamento','$ciudad','$barrio','$ux','$uy','$des1','$des2','$archivador') ");
			if($crea==true)
			{
				if($nombre_destacada!='')
				{
					move_uploaded_file($tmp_destacada, $archivador);
				}
				for($i=0;$i<count($nombre_foto);$i++)
				{
					@$archivador = $folder_galeria . '/' .$codigo.'_'.$nombre_foto[$i];
					move_uploaded_file($tmp_foto[$i], $archivador);
					$crea2 = mysql_query("INSERT INTO galeria VALUES('','$codigo','$archivador') ");
				}
				$respuesta['status'] = 'correcto';
			}
			else
				$respuesta['status'] = 'error2';
		}
		else
			$respuesta['status'] = 'error1';
		echo json_encode($respuesta);
	break;
	case 'carga_basic':
		$sel = mysql_query("SELECT inmuebles.Val_inm,propietarios.Id_prop,propietarios.Nom_prop,propietarios.Apel_prop FROM inmuebles,propietarios
			   WHERE inmuebles.Id_prop = propietarios.Id_prop AND inmuebles.Cod_inm = '$codigo' ");
		if(mysql_num_rows($sel)!=0)
		{
			$sel2 = mysql_query("SELECT * FROM arrendatarios WHERE Cod_inm='$codigo' ");
			if(mysql_num_rows($sel2)!=0)
				$informacion[] = 'error1';
			else
			{
				$resp = mysql_fetch_object($sel);
				$informacion[]=$resp;
			}
		}
		else
			$informacion[] = 'error2';
		echo '{"Inmueble":'.json_encode($informacion).'}';
	break;
	case 'ligar':
		$crea = mysql_query("INSERT INTO arrendatarios VALUES ('$id_arren','$nombre','$apellido','$email','$telefono','$movil','$codigo','$recargo','$admintr','$f_inicio')");
		if($crea==true)
		{
			$act = mysql_query("UPDATE inmuebles SET Val_inm='$valor' WHERE Cod_inm='$codigo' ");
			$encript = crypt_blowfish_bycarluys($id_arren);
			$crusu = mysql_query("INSERT INTO usuarios VALUES('$id_arren','$encript','arrendatario') ") ;
			echo 'correcto';
		}
		else
			echo'error';
	break;
	case 'carga_editar':
		$sel = mysql_query("SELECT * FROM inmuebles WHERE Cod_inm='$codigo' ");
		if(mysql_num_rows($sel)!=0)
		{
			$resp = mysql_fetch_object($sel);
			$informacion[]=$resp;
			$sel = mysql_query("SELECT  * FROM galeria WHERE Cod_inm='$codigo' ");
			while($resp = mysql_fetch_object($sel))
			{
				$informacion[]=$resp;
			}
		}
		else
			$informacion[]='error';
		echo '{"Inmueble":'.json_encode($informacion).'}';
	break;
	case 'editar':
		$sel = mysql_query("SELECT * FROM propietarios WHERE Id_prop='$idprop' ");
		if(mysql_num_rows($sel)!=0)
		{
			$act = mysql_query("UPDATE inmuebles SET Id_prop='$idprop',Tipo_inm='$tipo',Mt2_inm='$mt2',Habit_inm='$habitaciones',Ban_inm='$banos',Parq_inm='$parqueadero',Serv_inm='$servicio',Val_inm='$valor',Dep_inm='$departamento',Ciu_inm='$ciudad',Barr_inm='$barrio',X_inm='$ux',Y_inm='$uy',Desc1_inm='$des1',Desc2_inm='$des2'
			   WHERE Cod_inm='$codigo' ");
			if($nombre_destacada!='')
			{
				$archivador = $folder_destacada . '/' .$codigo.'_'.$nombre_destacada;
				move_uploaded_file($tmp_destacada, $archivador);
				$act = mysql_query("UPDATE inmuebles SET Img_inm='$archivador'  WHERE Cod_inm='$codigo'");
			}
			for($i=0;$i<count($eliminar);$i++)
			{
				$eli = mysql_query("DELETE FROM galeria WHERE Id_img='$eliminar[$i]' ");
			}
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
	case 'ciudad':
		$sel = mysql_query("SELECT id_municipio as id, nombre_municipio as nombre FROM municipios WHERE departamentos_id='$departamento' ");
		while($resp=mysql_fetch_object($sel))
		{
			$informacion[]=$resp;
		}
		echo '{"Ciudades":'.json_encode($informacion).'}';
	break;
	case 'barrio':
		$sel = mysql_query("SELECT Barr_inm  as barrio FROM inmuebles WHERE Ciu_inm='$ciudad' GROUP BY barrio");
		while($resp=mysql_fetch_object($sel))
		{
			$informacion[]=$resp;
		}
		echo '{"Barrios":'.json_encode($informacion).'}';
	break;
	default:
		# code...
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