<?php
include("../../include/inc/data.php");

$idGet = $_GET['idS'];
$modGet = $_GET['modS'];
$localGet = $_GET['localS'];

$nomeGet = $_GET['nomeS'];

$tipo_de_cursoGet = $_GET['tipo_de_cursoS'];
$status_do_cursoGet = $_GET['status_do_cursoS'];
$tempo_de_formacaoGet = $_GET['tempo_de_formacaoS'];
$tempo_de_experienciaGet = $_GET['tempo_de_experienciaS'];

$nivelEscritaGet = $_GET['nivelEscritaS'];
$nivelLeituraGet = $_GET['nivelLeituraS'];
$nivelConversacaoGet = $_GET['nivelConversacaoS'];

$data = date("Y-m-d H:i:s");

$numeroUnicoGerado = $_GET['numeroUnicoS'];
$numeroUnicoGeradoNovo = geraCodReturn();

if(trim($_GET['acaoS'])=="adiciona") {

	if(trim($localGet)=="formacao") {
		$insert = mysql_query("INSERT INTO ".$modGet."_".$localGet." (numeroUnico,numeroUnico_curriculo,tipo_de_curso,nome,status_de_curso,tempo_de_formacao,tempo_de_experiencia,data,dataModificacao) 
															VALUES 
														   ('".$numeroUnicoGeradoNovo."','".$numeroUnicoGerado."','".$tipo_de_cursoGet."','".$nomeGet."','".$status_do_cursoGet."','".$tempo_de_formacaoGet."','".$tempo_de_experienciaGet."','".$data."','".$data."')");
	} else {
		$insert = mysql_query("INSERT INTO ".$modGet."_".$localGet." (numeroUnico,numeroUnico_curriculo,nome,nivel_escrita,nivel_leitura,nivel_conversacao,data,dataModificacao) 
															VALUES 
														   ('".$numeroUnicoGeradoNovo."','".$numeroUnicoGerado."','".$nomeGet."','".$nivelEscritaGet."','".$nivelLeituraGet."','".$nivelConversacaoGet."','".$data."','".$data."')");
	}

} else {
	if(trim($_GET['acaoS'])=="remove") {
		$idGet = $_GET['idS'];
		$sql = mysql_query("DELETE FROM ".$modGet."_".$localGet." WHERE id='".$idGet."'");
	} else {
		if(trim($_GET['acaoS'])=="update") {
			if(trim($localGet)=="formacao") {
				$update = mysql_query("UPDATE ".$modGet."_".$localGet." SET tipo_de_curso='".$tipo_de_cursoGet."',nome='".$nomeGet."',status_de_curso='".$status_de_cursoGet."',tempo_de_formacao='".$tempo_de_formacaoGet."',tempo_de_experiencia='".$tempo_de_experienciaGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
			} else {
				$update = mysql_query("UPDATE ".$modGet."_".$localGet." SET nome='".$nomeGet."',nivel_escrita='".$nivelEscritaGet."',nivel_leitura='".$nivelLeituraGet."',nivel_conversacao='".$nivelConversacaoGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
			}
		} else {
		}
	}
}


include("list_".$localGet.".php");
?>
