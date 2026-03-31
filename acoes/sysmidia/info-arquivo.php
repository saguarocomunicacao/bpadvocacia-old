<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$idGet = $_REQUEST['idS'];

$itemSql = mysql_fetch_array(mysql_query("SELECT * FROM sysmidia WHERE id='".$idGet."'"));

$extensao = $itemSql['nome'];
$extensao = substr($extensao, -4);
if($extensao[0] == '.'){
	$extensao = substr($extensao, -3);
}
$extensao = strtolower($extensao);

?>

<div style="width:500px;">
	<div style="float:left;width:480px;margin-left:10px;margin-bottom:10px;margin-top:10px;">
        <div style="float:left;width:70px;font-weight:bold;margin-right:5px;text-align:right;margin-top:3px;">NOME</div>
        <div style="float:left;width:5px;font-weight:bold;margin-right:5px;text-align:right;margin-top:1px;">:</div>
        <div style="float:left;width:370px;"><?=$itemSql['nome']?></div>
    </div>
	<div style="float:left;width:480px;margin-left:10px;margin-bottom:10px;">
        <div style="float:left;width:70px;font-weight:bold;margin-right:5px;text-align:right;margin-top:3px;">TAMANHO</div>
        <div style="float:left;width:5px;font-weight:bold;margin-right:5px;text-align:right;margin-top:1px;">:</div>
        <div style="float:left;width:370px;"><? tamanhoArquivo("../../files/sysmidia/".$itemSql['numeroUnico']."/".$itemSql['arquivo'].""); ?></div>
    </div>

</div>
