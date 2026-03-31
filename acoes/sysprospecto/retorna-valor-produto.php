<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = "".$_GET['idS']."";

$rSqlItem = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto WHERE id='".$idGet."'"));

if(trim($rSqlItem['lista_sysplano'])=="") {
	if(trim($rSqlItem['promocao'])=="1") {
		echo "0|".$rSqlItem['valor_promocao']."|".$rSqlItem['valor_mensalidade']."";
	} else {
		echo "0|".$rSqlItem['valor']."|".$rSqlItem['valor_mensalidade']."";
	}
} else {
	echo "1||";
}
?>
