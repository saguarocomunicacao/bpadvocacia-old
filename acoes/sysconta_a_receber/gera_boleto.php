<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idContaGet = $_GET['idContaS'];
$idBancoGet = $_GET['idBancoS'];
$prazo_boletoGet = $_GET['prazo_boletoS'];
$infoGet = $_GET['infoS'];

$rSqlConta = mysql_fetch_array(mysql_query("SELECT * FROM sysconta_a_receber WHERE id='".$idContaGet."'"));

$rSqlDestinatario = mysql_fetch_array(mysql_query("SELECT * FROM ".$rSqlConta['tipo_destinatario']." WHERE id='".$rSqlConta['id'.$rSqlConta['tipo_destinatario'].'']."'"));

$rSqlBanco = mysql_fetch_array(mysql_query("SELECT * FROM sysbanco WHERE id='".$idBancoGet."'"));

$data_vencimento_ano = substr($rSqlConta['data_vencimento'],0,4);
$data_vencimento_mes = substr($rSqlConta['data_vencimento'],5,2);
$data_vencimento_dia = substr($rSqlConta['data_vencimento'],8,2);
$data_vencimento = "".$data_vencimento_dia."/".$data_vencimento_mes."/".$data_vencimento_ano."";

$data_emissao_ano = substr($rSqlConta['data_emissao'],0,4);
$data_emissao_mes = substr($rSqlConta['data_emissao'],5,2);
$data_emissao_dia = substr($rSqlConta['data_emissao'],8,2);
$data_emissao = "".$data_emissao_dia."/".$data_emissao_mes."/".$data_emissao_ano."";

include("../../include/lib/phpboleto/boleto_".$rSqlBanco['banco'].".php");
?>
