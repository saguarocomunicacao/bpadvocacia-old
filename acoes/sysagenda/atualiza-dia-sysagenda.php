<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$localGet = $_GET['localS'];
$diaGet = $_GET['diaS'];
$minutoGet = $_GET['minutoS'];
$tipoGet = $_GET['tipoS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM sysagenda WHERE id='".$idGet."'"));

$dI  = substr($item['data_inicio'],8,2);
$mI  = substr($item['data_inicio'],5,2);
$aI  = substr($item['data_inicio'],0,4);

$horI  = substr($item['hora_inicio'],0,2);
$minI  = substr($item['hora_inicio'],3,2);
$segI  = substr($item['hora_inicio'],6,4);

$dF  = substr($item['data_fim'],8,2);
$mF  = substr($item['data_fim'],5,2);
$aF  = substr($item['data_fim'],0,4);

$horF  = substr($item['hora_fim'],0,2);
$minF  = substr($item['hora_fim'],3,2);
$segF  = substr($item['hora_fim'],6,4);

if(trim($tipoGet)=="drop") {
	if($diaGet<0) {
		$dI = $dI - str_replace("-","",$diaGet);
		$dF = $dF - str_replace("-","",$diaGet);
	} else {
		$dI = $dI + $diaGet;
		$dF = $dF + $diaGet;
	}
} else {
	if($diaGet<0) {
		$dF = $dF - str_replace("-","",$diaGet);
	} else {
		$dF = $dF + $diaGet;
	}
}

if(strlen($dI)<2) {
	$dI = "0".$dI;
} else {
	$dI = $dI;
}

if(strlen($dF)<2) {
	$dF = "0".$dF;
} else {
	$dF = $dF;
}

if(trim($minutoGet)==0) {
	$arrayDataI = mktime($horI,$minI,$segI,$mI,$dI,$aI);
	$arrayDataF = mktime($horF,$minF,$segF,$mF,$dF,$aF);
} else {
	$total_segundos = str_replace("-","",$minutoGet) * 60;

	if(trim($tipoGet)=="drop") {
		if(trim($minutoGet)<0) {
			$arrayDataI = mktime($horI,$minI,$segI,$mI,$dI,$aI) - $total_segundos;
			$arrayDataF = mktime($horF,$minF,$segF,$mF,$dF,$aF) - $total_segundos;
		} else {
			$arrayDataI = mktime($horI,$minI,$segI,$mI,$dI,$aI) + $total_segundos;
			$arrayDataF = mktime($horF,$minF,$segF,$mF,$dF,$aF) + $total_segundos;
		}
	} else {
		if(trim($minutoGet)<0) {
			$arrayDataI = mktime($horI,$minI,$segI,$mI,$dI,$aI);
			$arrayDataF = mktime($horF,$minF,$segF,$mF,$dF,$aF) - $total_segundos;
		} else {
			$arrayDataI = mktime($horI,$minI,$segI,$mI,$dI,$aI);
			$arrayDataF = mktime($horF,$minF,$segF,$mF,$dF,$aF) + $total_segundos;
		}
	}
}

$data_restauradaI = date("Y-m-d H:i:s", $arrayDataI);
$data_restauradaF = date("Y-m-d H:i:s", $arrayDataF);

$dataI = substr($data_restauradaI,0,10);
$horaI = substr($data_restauradaI,11,19);

$dataF = substr($data_restauradaF,0,10);
$horaF = substr($data_restauradaF,11,19);

$update = mysql_query("UPDATE sysagenda SET data_inicio='".$dataI."',hora_inicio='".$horaI."',data_fim='".$dataF."',hora_fim='".$horaF."',dataModificacao='".$data."' WHERE id='".$idGet."'");
?>
