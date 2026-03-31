<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = "".$_GET['idS']."";
$tipoGet = "".$_GET['tipoS']."";
?>
<option value="">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM ".$tipoGet." WHERE stat='1' AND id".$tipoGet."_categoria='".$idGet."' ORDER BY ordem");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
<? } ?>
