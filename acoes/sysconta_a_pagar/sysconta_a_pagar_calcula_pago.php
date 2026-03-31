<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$valorGet = $_GET['valorS'];
$valorGet = str_replace(".","",$valorGet); 
for ($i = 1; $i <= 10; $i++) {
	$valorGet = str_replace(".","",$valorGet);
}
$valorGet = str_replace(",",".",$valorGet);

$valor_descontoGet = $_GET['valor_descontoS'];
$valor_descontoGet = str_replace(".","",$valor_descontoGet); 
for ($i = 1; $i <= 10; $i++) {
	$valor_descontoGet = str_replace(".","",$valor_descontoGet);
}
$valor_descontoGet = str_replace(",",".",$valor_descontoGet);

$valor_taxaGet = $_GET['valor_taxaS'];
$valor_taxaGet = str_replace(".","",$valor_taxaGet); 
for ($i = 1; $i <= 10; $i++) {
	$valor_taxaGet = str_replace(".","",$valor_taxaGet);
}
$valor_taxaGet = str_replace(",",".",$valor_taxaGet);

$valor_juroGet = $_GET['valor_juroS'];
$valor_juroGet = str_replace(".","",$valor_juroGet); 
for ($i = 1; $i <= 10; $i++) {
	$valor_juroGet = str_replace(".","",$valor_juroGet);
}
$valor_juroGet = str_replace(",",".",$valor_juroGet);

$valor_total = $valorGet - $valor_descontoGet + ($valor_taxaGet + $valor_juroGet);

echo number_format($valor_total, 2, ',','.');
?>
