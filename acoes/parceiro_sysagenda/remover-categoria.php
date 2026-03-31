<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$criadorGet = $_GET['criadorS'];
$idGet = $_GET['idS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_sysagenda_categoria WHERE id='".$idGet."'"));

$qall = mysql_query("SELECT * FROM parceiro_sysagenda_categoria WHERE criador='".$criadorGet."' ORDER BY ordem");
while($rall = mysql_fetch_array($qall)) {
	if( $rall['ordem'] > $item['ordem']) {
		$ordem = $rall['ordem'] - 1;
		$update = mysql_query("UPDATE parceiro_sysagenda_categoria SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$sql = mysql_query("DELETE FROM parceiro_sysagenda_categoria WHERE id='".$idGet."'");

include("lista_categoria.php");
?>
