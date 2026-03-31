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
$sysusuGet = $_REQUEST['sysusuS'];


function criador_set($d) {
	$criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$d."'"));
	return $criador_processo['nome'];
}

function acao_set($d,$linkSet,$sysusuSet) {

	$sysperm_acao = mysql_fetch_array(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$sysusuGet."'"));
	
	$cliente = mysql_fetch_array(mysql_query("SELECT * FROM cliente WHERE id='".$d."'"));

	$acao_set = "<div class='btn-group'>";
	
	if(trim($sysperm_acao['editar_cliente'])==1||trim($sysperm_acao['todos_cliente'])==1) {
		$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='".$linkSet."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$d."/' class='btn-mini ptip_se' title='Editar'><img src='".$linkSet."template/img/icones_novos/16/editar.png' /></a></div>";
	}
	
	if(trim($cliente['criador'])==$sysusuSet||trim($sysperm_acao['todos_cliente'])==1) { 
	
		if(trim($sysperm_acao['excluir_cliente'])==1||trim($sysperm_acao['todos_cliente'])==1) { 
			$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=remover_item_tabela('".$d."','cliente','NAO','') class='btn-mini ptip_se' title='Remover'><img src='".$linkSet."template/img/icones_novos/16/remover-x.png' /></a></div>";
		} 
		
		if(trim($cliente['stat'])=="1") { 
			if(trim($sysperm_acao['despublicar_cliente'])==1||trim($sysperm_acao['todos_cliente'])==1) { 
				$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=muda_stat('cliente','".$d."','0') class='btn-mini ptip_se' title='Despublicar'><img src='".$linkSet."template/img/icones_novos/16/stat-1.png' /></a></div>";
			} else { 
				$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=alert('Você não tem permissão para esta ação !') class='btn-mini ptip_se' title='Despublicar'><img src='".$linkSet."template/img/icones_novos/16/stat-1.png' /></a></div>";
			} 
		} else { 
			if(trim($sysperm_acao['publicar_cliente'])==1||trim($sysperm_acao['todos_cliente'])==1) { 
				$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=muda_stat('cliente','".$d."','1') class='btn-mini ptip_se' title='Publicar'><img src='".$linkSet."template/img/icones_novos/16/stat-0.png' /></a></div>";
			} else { 
				$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=alert('Você não tem permissão para esta ação !') class='btn-mini ptip_se' title='Publicar'><img src='".$linkSet."template/img/icones_novos/16/stat-0.png' /></a></div>";
			} 
		} 
	
	} 
	$acao_set .= "</div>";

	return $acao_set;
}

function situacao_set($d) {

	$rSqlProcessoTipo = mysql_fetch_array(mysql_query("SELECT * FROM cliente_tipo WHERE id='".$d."'"));

	$situacao_div  = "<div style='float:left;'>";
	if(trim($d)==0) {
	
	$situacao_div .= "<div style='background-color:#000;border:1px solid #000;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>Sem Situação</div>";
	
	} else {
		
	$situacao_div .= "<div style='background-color:".$rSqlProcessoTipo['cor'].";border:1px solid ".$rSqlProcessoTipo['cor'].";width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>".$rSqlProcessoTipo['nome']."</div>";
	
	}
    
	$situacao_div .= "</div>";

	return $situacao_div;
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
$table = 'cliente';
 
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
    array(
        'db'        => 'criador',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
            return criador_set($d);
        }
    ),
    array( 'db' => 'nome',   'dt' => 3 ),
    array( 'db' => 'telefone',     'dt' => 4 ),
    array(
        'db'        => 'id',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return acao_set($d,"http://www.bpadvocacia.com.br/admin/",$sysusuGet);
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
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

?>
