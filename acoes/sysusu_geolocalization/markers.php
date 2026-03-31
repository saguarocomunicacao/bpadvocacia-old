<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idsysusuGet = $_GET['idsysusuS'];


$i=0;
$nSqlMap = mysql_num_rows(mysql_query("SELECT * FROM sysusu_geolocalization WHERE idsysusu='".$idsysusuGet."' ORDER BY idsysusu"));
$qSqlMap = mysql_query("SELECT * FROM sysusu_geolocalization WHERE idsysusu='".$idsysusuGet."' ORDER BY idsysusu");
while($rSqlMap = mysql_fetch_array($qSqlMap)) {
	$sysusu_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSqlMap['idsysusu']."'"));
	$tempo = tempoOff($rSqlMap['idsysusu']);
	
	if($tempo>1800) { } else {

		$busca[$i]['id'] = "".$i."";
		$busca[$i]['lat'] = "".$rSqlMap['lat']."";
		$busca[$i]['lng'] = "".$rSqlMap['lng']."";
		$busca[$i]['title'] = "".$sysusu_set['nome']."";
		if($rSqlMap['idsysusu']==$idsysusuGet) {
		$busca[$i]['cor'] = "2a8d03";
		} else {
		$busca[$i]['cor'] = "044b7c";
		}
		$i++;

	}
}
echo json_encode($busca);
?>
