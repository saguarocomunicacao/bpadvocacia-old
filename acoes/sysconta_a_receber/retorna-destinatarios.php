<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";
$nSqlItem = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet.""));
if($nSqlItem==0) {
	echo "0";
} else {
?>
<option value="">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM ".$modGet." WHERE stat='1' ORDER BY nome");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
<? } } ?>
