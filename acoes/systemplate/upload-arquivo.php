<?php
require_once("../../include/inc/sess.php");
require_once("../../include/inc/main.php");
require_once("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");


$numeroUnicoGet = $_SESSION["numeroUnico_upload_arquivo"];

$extensao = $_FILES['arquivo']['name'];
$extensao = substr($extensao, -4);
if($extensao[0] == '.'){
	$extensao = substr($extensao, -3);
}
$extensao = strtolower($extensao);

$uploaddir = "../../files/systemplate/".$numeroUnicoGet."/"; 
$file = $uploaddir . basename($_FILES['arquivo']['name']); 
 
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $file)) { } else { }

include("lista_galeria.php");
?>
