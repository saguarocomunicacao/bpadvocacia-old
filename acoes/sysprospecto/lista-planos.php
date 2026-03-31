<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = "".$_GET['idS']."";
$rSqlItem = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto WHERE id='".$idGet."'"));

$lista_sysplano = $rSqlItem['lista_sysplano'];
$lista_sysplano = str_replace("||","','",$lista_sysplano);
$lista_sysplano = str_replace("|","'",$lista_sysplano);
?>
<option value="">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM sysplano WHERE id IN(".$lista_sysplano.") ORDER BY ordem");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
<? } ?>
