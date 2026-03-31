<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = $_GET['numeroUnicoS'];
$idsysusuGet = $_GET['idsysusuS'];

$nSysusu = mysql_num_rows(mysql_query("SELECT * FROM sysmidiaperm WHERE idsysusu='".$idsysusuGet."' AND numeroUnico='".$numeroUnicoGet."'"));

echo $nSysusu;
?>
