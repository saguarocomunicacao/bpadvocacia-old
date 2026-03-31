<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";
$idsysclienteGet = "".$_GET['idsysclienteS']."";

$nSqlItem = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."_classificacao_set WHERE idsyscliente='".$idsysclienteGet."'"));

$qSqlItem = mysql_query("SELECT * FROM ".$modGet."_classificacao WHERE stat='1' ORDER BY ordem");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {

	if(trim($camposSet)=="") {
		$camposSet = "".$rSqlItem['numeroUnico']."";
	} else {
		$camposSet = "".$camposSet.",".$rSqlItem['numeroUnico']."";
	}

	if(trim($valoresSet)=="") {
		$valoresSet = "'".$_GET['classificacao_'.$rSqlItem['numeroUnico'].'S']."'";
	} else {
		$valoresSet = "".$valoresSet.",'".$_GET['classificacao_'.$rSqlItem['numeroUnico'].'S']."'";
	}

	if(trim($updateSet)=="") {
		$updateSet = "".$rSqlItem['numeroUnico']."='".$_GET['classificacao_'.$rSqlItem['numeroUnico'].'S']."'";
	} else {
		$updateSet = "".$updateSet.",".$rSqlItem['numeroUnico']."='".$_GET['classificacao_'.$rSqlItem['numeroUnico'].'S']."'";
	}

}

if($nSqlItem==0) {
	$insert = mysql_query("INSERT INTO ".$modGet."_classificacao_set (".$camposSet.",idsyscliente,data) VALUES (".$valoresSet.",'".$idsysclienteGet."','".$data."')");
} else {
	$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet."_classificacao_set WHERE idsyscliente='".$idsysclienteGet."'"));
	$update = mysql_query("UPDATE ".$modGet."_classificacao_set SET ".$updateSet.",dataModificacao='".$data."' WHERE id='".$item['id']."'");
}


$cont = 0;
$soma = 0;
$qSqlItem = mysql_query("SELECT * FROM ".$modGet."_classificacao WHERE stat='1'");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
	$cont++;
	$rSqlClassificacao = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet."_classificacao_set WHERE idsyscliente='".$idsysclienteGet."'"));
	$soma = $rSqlClassificacao[''.$rSqlItem['numeroUnico'].''] + $soma;
}

echo "Classificação Geral: ".$soma / $cont."";
?>
