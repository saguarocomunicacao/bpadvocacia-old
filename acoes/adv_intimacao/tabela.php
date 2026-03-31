<?php
include("../../include/inc/sess.php");
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$_REQUEST['var1'] = $_REQUEST['var1'];
$_REQUEST['var2'] = $_REQUEST['var2'];
$_REQUEST['var3'] = $_REQUEST['var3'];
$_REQUEST['var4'] = $_REQUEST['var4'];
$_REQUEST['var5'] = $_REQUEST['var5'];
$_REQUEST['sysusuS'] = $_REQUEST['sysusuS'];



function criador_set($d) {
	$criador_processo = mysql_fetch_array(mysql_query("SELECT nome FROM sysusu WHERE id='".$d."'"));
	return $criador_processo['nome'];
}
function cidade_set($d) {
	return corrigirAcentuacao($d);
}

function acao_set($d,$linkSet,$sysusuSet) {

	$acao_set = "<div class='btn-group'>";
	$acao_set .= "<a href=\"".$linkSet.$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$d."/\" class=\"btn-mini ptip_se\" title=\"Editar\"><img src='".$linkSet."template/img/icones_novos/16/editar.png' /></a>";
	$acao_set .= "</div>";

	return $acao_set;
}

function situacao_set($d) {

	if(trim($d)==0) {
		$situacao_set = "<div style=\"background-color:#C00;border:1px solid #C00;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">AINDA PENDENTE</div>";
	} elseif(trim($d)==1) {
		$situacao_set = "<div style=\"background-color:#F90;border:1px solid #F90;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">EM ANALISE STEPHANY - JF</div>";
	} elseif(trim($d)==2) {
		$situacao_set = "<div style=\"background-color:#063;border:1px solid #063;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">ANALISADA</div>";
	} elseif(trim($d)==3) {
		$situacao_set = "<div style=\"background-color:#39d11f;border:1px solid #39d11f;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">EM ANALISE STEPHANY</div>";
	} elseif(trim($d)==4) {
		$situacao_set = "<div style=\"background-color:#830202;border:1px solid #830202;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">EM ANALISE LUIZ</div>";
	} elseif(trim($d)==5) {
		$situacao_set = "<div style=\"background-color:#5BD9A4;border:1px solid #5BD9A4;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">EM ANALISE ALEXSANDRA</div>";
	}

	return $situacao_set;
}

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side pr
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'adv_intimacao';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array(
        'db'        => 'id',
        'dt'        => 0,
        'formatter' => function( $d, $row ) {
            return "<input type=\"checkbox\" id=\"check-".$d."\" name=\"msg_sel[]\" class=\"select_msg check_box_linha\" onclick=\"seleciona_linha_intimacao('".$d."');\" value=\"".$d."\" />";
        }
    ),
    array(
        'db'        => 'pendente',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
            return situacao_set($d);
        }
    ),
    array( 'db' => 'cod',   'dt' => 2 ),
    array( 'db' => 'cod_processo',     'dt' => 3 ),
    array( 'db' => 'data_xml',   'dt' => 4 ),
    array(
        'db'        => 'id',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return acao_set($d,"http://www.bpadvocacia.com.br/admin/",$_REQUEST['sysusuS']);
        }
    )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'bpadv_bpadv',
    'pass' => 'santo7931',
    'db'   => 'bpadv_2017b',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../../include/lib/ssp.class.php' );
 
$sysperm_adv_intimacao = mysql_fetch_array(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$_REQUEST['sysusuS']."'"));
if(trim($_REQUEST['var4'])=="")    {
	echo json_encode(
		SSP::simple( $_GET, "ORDER BY data_xml_date DESC", $sql_details, $table, $primaryKey, $columns )
	);
} else {
	echo json_encode(
		SSP::simple_criador ( "", $_GET, "ORDER BY dataModificacao DESC", $sql_details, $table, $primaryKey, $columns, "pendente", $_REQUEST['var4'] )
	);
}

?>
