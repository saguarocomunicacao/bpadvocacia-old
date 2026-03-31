<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$sufixoGet = $_GET['sufixoS'];
$numeroUnicoGet = $_GET['numeroUnicoS'];
$idsysproduto_categoriaGet = $_GET['idsysproduto_categoriaS'];
$idsysprodutoGet = $_GET['idsysprodutoS'];
$idsysplanoGet = $_GET['idsysplanoS'];
$periodoGet = $_GET['periodoS'];
$valorGet = $_GET['valorS'];
$valor_mensalidadeGet = $_GET['valor_mensalidadeS'];
$valor_descontoGet = $_GET['valor_descontoS'];

$insert = mysql_query("INSERT INTO ".$modGet."_item (numeroUnico_pai,idsysproduto_categoria,idsysproduto,idsysplano,periodo,valor,valor_mensalidade,valor_desconto,data) 
													VALUES 
												     ('".$numeroUnicoGet."','".$idsysproduto_categoriaGet."','".$idsysprodutoGet."','".$idsysplanoGet."','".$periodoGet."','".$valorGet."','".$valor_mensalidadeGet."','".$valor_descontoGet."','".$data."')");

include("lista-servicos.php");
?>
