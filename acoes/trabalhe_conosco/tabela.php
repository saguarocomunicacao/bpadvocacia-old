<?php
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
	$criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$d."'"));
	return $criador_processo['nome'];
}

function data_set($d) {
	return ajustaDataReturn($d,"d/m/Y");
}

function acao_set($d,$linkSet,$sysusuSet) {

	$acao_set = "<div class='btn-group'>";
	$acao_set .= "<a href=\"javascript:void(0);\" onclick=\"baixar_curriculo('".$d."');\" class=\"btn-mini ptip_se\"><img src='".$linkSet."template/img/icones_novos/16/download.png' /></a>";
	$acao_set .= "<a href=\"".$linkSet.$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$d."/\" class=\"btn-mini ptip_se\" title=\"Editar\"><img src='".$linkSet."template/img/icones_novos/16/editar.png' /></a>";
	$acao_set .= "<a href=\"javascript:void(0);\" onclick=\"remover_item_tabela('".$d."','trabalhe_conosco','NAO','');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src='".$linkSet."template/img/icones_novos/16/remover-x.png' /></a>";
	$acao_set .= "</div>";

	return $acao_set;
}

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
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
$table = 'trabalhe_conosco';
 
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
            return "<input type='checkbox' name='msg_sel[]' class='select_msg' value='".$d."' />";
        }
    ),
    array( 'db' => 'nome',   'dt' => 1 ),
    array( 'db' => 'email',     'dt' => 2 ),
    array( 'db' => 'telefone_1',     'dt' => 3 ),
    array(
        'db'        => 'data',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            return data_set($d);
        }
    ),
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
 
echo json_encode(
	SSP::simple( $_GET, " ORDER BY data DESC ", $sql_details, $table, $primaryKey, $columns )
);

?>
