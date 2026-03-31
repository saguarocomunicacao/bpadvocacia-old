<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$nomeGet = $_GET['nomeS'];
$emailGet = $_GET['emailS'];

$insert = mysql_query("INSERT INTO ".$modGet."_emails (numeroUnico_pai,nome,email,data) 
													VALUES 
												   ('".$numeroUnicoGet."','".$nomeGet."','".$emailGet."','".$data."')");

include("lista_".$modGet."_emails.php");
?>
