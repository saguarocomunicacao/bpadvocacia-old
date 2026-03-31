<?php
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$sessaoGet = $_GET['sessaoS'];
$ipGet = $_GET['ipS'];

$nitem = mysql_num_rows(mysql_query("SELECT * FROM sysusu_logado WHERE idsysusu='".$idGet."' ORDER BY data LIMIT 1"));
if($nitem==0) {
	$insert = mysql_query("INSERT INTO sysusu_logado (idsysusu,ip,sessao,data) 
													  VALUES 
													 ('".$idGet."','".$ipGet."','".$sessaoGet."','".$data."')");
} else {
	$update = mysql_query("UPDATE sysusu_logado SET data='".$data."' WHERE idsysusu='".$idGet."'");
}

echo $data;
?>