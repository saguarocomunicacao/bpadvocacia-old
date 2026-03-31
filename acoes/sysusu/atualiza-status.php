<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");
 
$idGet = $_GET['idS'];
$sessaoGet = $_GET['sessaoS'];
$ipGet = $_GET['ipS'];

$usuario_atual = mysql_fetch_array(mysql_query("SELECT * FROM sysusu_logado WHERE idsysusu='".$idGet."'"));
 
$dia_inicio = substr($usuario_atual['data'],8,2);
$mes_inicio = substr($usuario_atual['data'],5,2);
$ano_inicio = substr($usuario_atual['data'],0,4);
$hor_inicio = substr($usuario_atual['data'],11,2);
$min_inicio = substr($usuario_atual['data'],14,2);
$seg_inicio = substr($usuario_atual['data'],17,2);
$inicio = mktime($hor_inicio,$min_inicio,$seg_inicio,$mes_inicio,$dia_inicio,$ano_inicio);

$dia_fim = date("d");
$mes_fim = date("m");
$ano_fim = date("Y");
$hor_fim = date("H");
$min_fim = date("i");
$seg_fim = date("s");
$fim = mktime($hor_fim,$min_fim,$seg_fim,$mes_fim,$dia_fim,$ano_fim);

$diferenca = $fim - $inicio;

/* 30 minutos é 1800 */
?>