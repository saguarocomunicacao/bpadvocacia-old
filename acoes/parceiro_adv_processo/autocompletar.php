<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");
$q=strtolower ($_GET["q"]);

$query = mysql_query("SELECT * FROM parceiro_adv_processo WHERE nome_acao LIKE '%".$q."%' GROUP BY nome_acao");// or die ("Erro". mysql_query());
while($reg=mysql_fetch_array($query)){

		echo "".$reg["nome_acao"]."|".$reg["nome_acao"]."\n";
//	}
}
?>
