<?php
include("conexion.php");
    $usuario = mysql_real_escape_string($_POST['usuario']);
    $pswd = mysql_real_escape_string($_POST['password']);
    $answer = array();
    $sel = mysql_query("SELECT  * FROM usuarios WHERE Usuario_usu='$usuario' ");
    if ($resp = mysql_num_rows($sel)!=0)
    {
        $resp = mysql_fetch_array($sel);
        $pass = $resp['Pass_usu'];
        if( crypt($pswd, $pass) == $pass)
        {
            session_start();
            $_SESSION['usulog'] = $resp['Usuario_usu'];
            $bus = mysql_query("SELECT Tipo_usu from usuarios where Usuario_usu='$usuario'");
            $resp2=mysql_fetch_array($bus);
            $_SESSION['tipousu'] = $resp2['Tipo_usu'];
            if($resp2['Tipo_usu']=='admin')
                $answer['redirec'] = 'adminpref';
            if($resp2['Tipo_usu']=='propietario')
                $answer['redirec'] = 'estados';
            if($resp2['Tipo_usu']=='arrendatario')
                $answer['redirec'] = 'arrendatario';
        }
        else
            $answer = 'error';
    }
    else
    {
    	 $answer = 'error';
    }
    echo json_encode($answer);
?>