<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$var1Get = $_GET['var1S'];
$var2Get = $_GET['var2S'];

$CaracteresAceitos = 'abcdxywzABCDZYWZ0123456789';
$max = strlen($CaracteresAceitos)-1;
$cod = null;
for($i=0; $i < 30; $i++) {
	$cod .= $CaracteresAceitos{mt_rand(0, $max)};
}
$numeroUnicSyscontrato = $cod;

$sysprospecto = mysql_fetch_array(mysql_query("SELECT * FROM sysprospecto WHERE id='".$idGet."'"));
$syscliente = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$sysprospecto['idsyscliente']."'"));

$insert = mysql_query("INSERT INTO syscontrato (numeroUnico,idsysusu,idsysprospecto,idsyscliente,data_post,data,dataModificacao,stat,aceito) VALUES ('".$numeroUnicSyscontrato."','".$sysprospecto['idsysusu']."','".$idGet."','".$sysprospecto['idsyscliente']."','".$sysprospecto['data_post']."','".$data."','".$data."','1','0')");
																
$qSqlGroup = mysql_query("SELECT * FROM sysprospecto_item WHERE numeroUnico_pai='".$sysprospecto['numeroUnico']."' GROUP BY idsysproduto_categoria");
while($rSqlGroup = mysql_fetch_array($qSqlGroup)) {

	$qSqlItem = mysql_query("SELECT * FROM sysprospecto_item WHERE numeroUnico_pai='".$sysprospecto['numeroUnico']."' AND idsysproduto_categoria='".$rSqlGroup['idsysproduto_categoria']."' ORDER BY data DESC");
	while($rSqlItem = mysql_fetch_array($qSqlItem)) {

		$max2 = strlen($CaracteresAceitos)-1;
		$cod2 = null;
		for($i2=0; $i2 < 30; $i2++) {
			$cod2 .= $CaracteresAceitos{mt_rand(0, $max2)};
		}
		$numeroUnicSyscontrato_item = $cod2;
		
		$insert = mysql_query("INSERT INTO syscontrato_item (numeroUnico,
															 numeroUnico_pai,
		                                                     idsysproduto_categoria,
															 idsysproduto,
															 idsysplano,
															 periodo,
															 valor,
															 valor_mensalidade,
															 valor_desconto,
															 data) 
															 VALUES 
															 ('".$numeroUnicSyscontrato_item."',
															  '".$numeroUnicSyscontrato."',
															  '".$rSqlItem['idsysproduto_categoria']."',
															  '".$rSqlItem['idsysproduto']."',
															  '".$rSqlItem['idsysplano']."',
															  '".$rSqlItem['periodo']."',
															  '".$rSqlItem['valor']."',
															  '".$rSqlItem['valor_mensalidade']."',
															  '".$rSqlItem['valor_desconto']."',
															  '".$data."')");

	}

}

$syscontrato = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato WHERE numeroUnico='".$numeroUnicSyscontrato."'"));

$update = mysql_query("UPDATE sysprospecto SET contrato='1',dataModificacao='".$data."' WHERE id='".$idGet."'");

echo "".$var1Get."/".$var2Get."/editar/".$syscontrato['id']."/";


?>
