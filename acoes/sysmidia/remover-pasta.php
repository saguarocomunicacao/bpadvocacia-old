<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idpaiGet = $_GET['idpaiS'];

$qSqlFile = mysql_query("SELECT * FROM sysmidia WHERE idpai='".$idpaiGet."' AND tipo='file'");
while($rSqlFile = mysql_fetch_array($qSqlFile)) {
	remove_arquivo("../../","sysmidia",$rSqlFile['id'],"arquivo",""); 
}

remove_pasta_arvore("../../","sysmidia",$idpaiGet,"");

$sql = mysql_query("DELETE FROM sysmidia WHERE id='".$idpaiGet."'");

include("lista_pasta.php");
?>
