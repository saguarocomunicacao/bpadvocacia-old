<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$sessaoGet = $_GET['sessaoS'];
$ipGet = $_GET['ipS'];

$sysusu_logado = mysql_fetch_array(mysql_query("SELECT * FROM sysusu_logado WHERE idsysusu='".$idGet."'"));

$update = mysql_query("UPDATE sysusu_logado SET data='".$data."',sessao='".$sessaoGet."',ip='".$ipGet."' WHERE id='".$sysusu_logado['id']."'");
?>
