<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$latGet = $_GET['latS'];
$lonGet = $_GET['lonS'];
$idsysusuGet = $_GET['idsysusuS'];

$sessaoGet = $_GET['sessaoS'];
$ipGet = $_GET['ipS'];

$nitem = mysql_num_rows(mysql_query("SELECT * FROM sysusu_geolocalization WHERE idsysusu='".$idsysusuGet."' ORDER BY data LIMIT 1"));
if($nitem==0) {
	$insert = mysql_query("INSERT INTO sysusu_geolocalization (idsysusu,ip,sessao,lat,lon,data) 
													  VALUES 
													 ('".$idsysusuGet."','".$ipGet."','".$sessaoGet."','".$latGet."','".$lonGet."','".$data."')");
} else {
	$update = mysql_query("UPDATE sysusu_geolocalization SET lat='".$latGet."',lon='".$lonGet."',data='".$data."' WHERE idsysusu='".$idsysusuGet."'");
}
?>
