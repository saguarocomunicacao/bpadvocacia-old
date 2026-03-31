<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");
$numeroUnicoGet = $_GET['numeroUnicoS'];

$uploaddir = "../../files/sysmidia/".$numeroUnicoGet."/"; 
$file = $uploaddir . basename($_FILES['arquivo']['name']); 
 
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $file)) { 
  echo "success"; 
} else {
	echo "error";
}

?>
