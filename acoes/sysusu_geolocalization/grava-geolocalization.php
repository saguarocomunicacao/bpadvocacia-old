<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$latGet = $_GET['latS'];
$lngGet = $_GET['lngS'];
$idsysusuGet = $_GET['idsysusuS'];

$sessaoGet = $_GET['sessaoS'];
$ipGet = $_GET['ipS'];

$nitem = mysql_num_rows(mysql_query("SELECT * FROM sysusu_geolocalization WHERE idsysusu='".$idsysusuGet."'"));
if($nitem==0) {
	$insert = mysql_query("INSERT INTO sysusu_geolocalization (
															   idsysusu,
															   ip,
															   sessao,
															   lat,
															   lng,
															   lat_ant,
															   lng_ant,
															   data
															   ) 
													           VALUES 
													          (
															   '".$idsysusuGet."',
															   '".$ipGet."',
															   '".$sessaoGet."',
															   '".$latGet."',
															   '".$lngGet."',
															   '".$latGet."',
															   '".$lngGet."',
															   '".$data."'
															   )");
} else {
	$item = mysql_fetch_array(mysql_query("SELECT * FROM sysusu_geolocalization WHERE idsysusu='".$idsysusuGet."'"));
	if(trim($latGet)==$item['lat']&&trim($lngGet)==$item['lng']) { } else {
		$update = mysql_query("UPDATE sysusu_geolocalization SET lat='".$latGet."',lng='".$lngGet."',lat_ant='".$item['lat']."',lng_ant='".$item['lng']."',data='".$data."' WHERE idsysusu='".$idsysusuGet."'");
	}
}

echo " - ".$idsysusuGet." - ".$nitem;
?>
