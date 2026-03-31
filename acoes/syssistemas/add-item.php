<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "syssistemas";
$numeroUnicoSet = geraCodReturn();
$sufixoGet = $_GET['sufixoS'];
$numeroUnicoGet = $_GET['numeroUnicoS'];
$tipoGet = $_GET['tipoS'];
$iditem_categoriaGet = $_GET['iditem_categoriaS'];
$iditemGet = $_GET['iditemS'];

$insert = mysql_query("INSERT INTO ".$modGet."_item (
													 numeroUnico,
            									     numeroUnico_pai,
													 tipo,
													 iditem_categoria,
													 iditem,
													 stat,
													 data,
													 dataModificacao
													 ) 
													VALUES 
												     (
													 '".$numeroUnicoSet."',
													 '".$numeroUnicoGet."',
													 '".$tipoGet."',
													 '".$iditem_categoriaGet."',
													 '".$iditemGet."',
													 '1',
													 '".$data."',
													 '".$data."'
													 )");

include("lista-itens.php");
?>
