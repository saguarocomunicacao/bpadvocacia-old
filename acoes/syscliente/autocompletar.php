<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");
$q=strtolower ($_GET["q"]);

$query = mysql_query("SELECT * FROM syscliente WHERE nome LIKE '%".$q."%' ORDER BY nome");// or die ("Erro". mysql_query());
while($reg=mysql_fetch_array($query)){

		echo "".$reg["id"]."|".$reg["nome"]."\n";
//	}
}
?>
