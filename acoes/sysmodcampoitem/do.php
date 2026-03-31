<?php
include("../../include/inc/data.php");

$mod = "sysmodcampoitem";
$data = date("Y-m-d H:i:s");
$numeroUnicoGerado = $_GET['numeroUnicoS'];

if(trim($_GET['acaoS'])=="adiciona") {
	$tipoGet = $_GET['tipoS'];
	$ordemGet = $_GET['ordemS'];
	$nomeGet = $_GET['nomeS'];

	$qall = mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$numeroUnicoGerado."'");
	while($rall = mysql_fetch_array($qall)) {
		if($rall['ordem'] >= $ordemGet) {
			$ordem = $rall['ordem'] + 1;
			$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}

	$insert = mysql_query("INSERT INTO ".$mod." (numeroUnico,tipo,ordem,nome,data,dataModificacao,stat) 
														VALUES 
													   ('$numeroUnicoGerado','$tipoGet','$ordemGet','$nomeGet','$data','$data','1')");
} else {
	if(trim($_GET['acaoS'])=="remove") {
		$idGet = $_GET['idS'];
		$sql = mysql_query("DELETE FROM ".$mod." WHERE id='$idGet'");
	} else {
		if(trim($_GET['acaoS'])=="status") {
			$idGet = $_GET['idS'];
			$statusGet = $_GET['statusS'];
			$update = mysql_query("UPDATE ".$mod." SET stat='$statusGet',dataModificacao='$data' WHERE id='".$idGet."'");
		} else {
			if(trim($_GET['acaoS'])=="update") {
				$idGet = $_GET['idS'];
				$tipoGet = $_GET['tipoS'];
				$ordemGet = $_GET['ordemS'];
				$nomeGet = $_GET['nomeS'];

				$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idGet."'"));
				$qall = mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$numeroUnicoGerado."'");
				while($rall = mysql_fetch_array($qall)) {
					if($rall['ordem'] > $itemAtual['ordem']) {
						$ordem = $rall['ordem'] - 1;
						$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
					}
				}

				$qall = mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$numeroUnicoGerado."'");
				while($rall = mysql_fetch_array($qall)) {
					if($rall['ordem'] >= $ordemGet) {
						$ordem = $rall['ordem'] + 1;
						$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
					}
				}

				$update = mysql_query("UPDATE ".$mod." SET tipo='$tipoGet',ordem='$ordemGet',nome='$nomeGet',dataModificacao='$data' WHERE id='".$idGet."'");
			} else {
			}
		}
	}
}


include("list.php");
?>
