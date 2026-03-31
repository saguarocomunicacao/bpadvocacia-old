<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$tipoGet = "".$_GET['tipoS']."";
?>
<option value="">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM ".$tipoGet."_categoria WHERE stat='1' ORDER BY ordem");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
<? } ?>
