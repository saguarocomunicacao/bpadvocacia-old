<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$latGet = $_GET['latS'];
$lngGet = $_GET['lngS'];
$idsysusuGet = $_GET['idsysusuS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM sysusu_geolocalization WHERE idsysusu='".$idsysusuGet."'"));
$sysusu_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$idsysusuGet."'"));

$i=0;

if(trim($latGet)==$item['lat']&&trim($lngGet)==$item['lng']) { 
 $igual = "1";
} else {
 $igual = "0";
}
echo "".$item['lat']."|".$item['lng']."|".$sysusu_set['nome']."|".$igual."";
?>
