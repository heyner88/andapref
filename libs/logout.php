<?php
session_start();

$tipo = $_SESSION['tipousu'];

unset($_SESSION['usulog']);
unset($_SESSION['tipousu']);
session_destroy();
if($tipo=='admin')
{
	header('Location: ../admin' );
}
if($tipo=='propietario' || $tipo=='arrendatario')
{
	header('Location: ../index' );
}

?>