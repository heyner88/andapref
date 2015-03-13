<?php
$conexion=mysql_connect("127.0.0.1","root","")or die ("No hay Conexion");
$conectDB=mysql_select_db("andapref",$conexion) or die ("no existe BD");
mysql_query ("SET NAMES 'utf8'");
?>
