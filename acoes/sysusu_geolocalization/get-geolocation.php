<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$nomeGet = $_GET['nomeS'];

$ruaGet = $_GET['ruaS'];
$numeroGet = $_GET['numeroS'];
$estadoGet = $_GET['estadoS'];
$cidadeGet = $_GET['cidadeS'];
$bairroGet = $_GET['bairroS'];

$qSqlEstado = mysql_query("SELECT * FROM cepbr_estado ORDER BY estado");
while($rSqlEstado = mysql_fetch_array($qSqlEstado)) {
	if($rSqlEstado['uf']==$estadoGet) { $estado_set = $rSqlEstado['uf']; }
}

$qSqlCidade = mysql_query("SELECT * FROM cepbr_cidade WHERE id_cidade='".$cidadeGet."' ORDER BY cidade");
while($rSqlCidade=mysql_fetch_array($qSqlCidade)) {
	if($rSqlCidade['id_cidade']==$cidadeGet) { $cidade_set = utf8_encode($rSqlCidade['cidade']); }
}

$qSqlBairro = mysql_query("SELECT * FROM cepbr_bairro WHERE id_cidade='".$bairroGet."' ORDER BY bairro");
while($rSqlBairro=mysql_fetch_array($qSqlBairro)) {
	if($rSqlBairro['id_bairro']==$bairroGet) { $bairro_set = utf8_encode($rSqlBairro['bairro']); }
}

$endereco = "".$numeroGet.",".$ruaGet.",".$bairro_set.",".$cidade_set.",".$estado_set."";

$cityclean = str_replace (" ", "+", $endereco);
$details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $cityclean . "&sensor=true";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $details_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$geoloc = json_decode(curl_exec($ch), true);

echo "".$nomeGet."|".$geoloc['results'][0]['geometry']['location']['lat']."|".$geoloc['results'][0]['geometry']['location']['lng']."";
?>
