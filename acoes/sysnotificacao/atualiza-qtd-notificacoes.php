<?
include("../../include/inc/data.php");

if(trim($_SESSION["perfil"])=="administrador") { 
	$campoFiltro = "idadministrador";
} else {
	$campoFiltro = "idcliente";
}

$msgN = mysql_num_rows(mysql_query("SELECT * FROM sysnotificacao WHERE lida='0' AND ".$campoFiltro."='".$sysusu['id']."'"));
if($msgN==0) { } else { echo $msgN; }
?>
