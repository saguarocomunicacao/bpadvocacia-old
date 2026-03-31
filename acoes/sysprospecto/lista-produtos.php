<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = "".$_GET['idS']."";
?>
<option value="">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM sysproduto WHERE lista_categoria LIKE '%|".$idGet."|%' OR idsysproduto_categoria='".$idGet."' ORDER BY ordem");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
<? } ?>
