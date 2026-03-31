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
	$criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$d."'"));
	return $criador_processo['nome'];
}

function acao_set($d,$linkSet,$sysusuSet) {
	$sysperm_adv_processo = mysql_fetch_array(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$_REQUEST['sysusuS']."'"));

	$sysperm_acao = mysql_fetch_array(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$_REQUEST['sysusuS']."'"));
	
	$adv_processo = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo WHERE id='".$d."'"));

	$acao_set = "<div class='btn-group'>";
	if(trim($sysperm_acao['editar_adv_processo'])==1||trim($sysperm_acao['todos_adv_processo'])==1) { 
	
		$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'>";
		$acao_set .= "	<a class=\"img_action_edit popup_fancy ptip_se\" onclick=\"gera_documento_processo('".$d."','".$sysusuSet."');\" href=\"javascript:void(0);\" title=\"Gerar Documento\"><img src=\"".$linkSet."template/img/icones_novos/16/contrato_grey.png\" /></a>";
		$acao_set .= "</div>";
	} 
	
	if(trim($sysperm_acao['editar_adv_processo'])==1||trim($sysperm_acao['todos_adv_processo'])==1) {
		$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='".$linkSet."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$d."/' class='btn-mini ptip_se' title='Editar'><img src='".$linkSet."template/img/icones_novos/16/editar.png' /></a></div>";
	}
	
	if(trim($adv_processo['criador'])==$sysusuSet||trim($sysperm_acao['todos_adv_processo'])==1) { 
	
		if(trim($sysperm_acao['excluir_adv_processo'])==1||trim($sysperm_acao['todos_adv_processo'])==1) { 
			$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=remover_item_tabela('".$d."','adv_processo','NAO','') class='btn-mini ptip_se' title='Remover'><img src='".$linkSet."template/img/icones_novos/16/remover-x.png' /></a></div>";
		} 
		
		if(trim($adv_processo['stat'])=="1") { 
			if(trim($sysperm_acao['despublicar_adv_processo'])==1||trim($sysperm_acao['todos_adv_processo'])==1) { 
				$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=muda_stat('adv_processo','".$d."','0') class='btn-mini ptip_se' title='Despublicar'><img src='".$linkSet."template/img/icones_novos/16/stat-1.png' /></a></div>";
			} else { 
				$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=alert('Você não tem permissão para esta ação !') class='btn-mini ptip_se' title='Despublicar'><img src='".$linkSet."template/img/icones_novos/16/stat-1.png' /></a></div>";
			} 
		} else { 
			if(trim($sysperm_acao['publicar_adv_processo'])==1||trim($sysperm_acao['todos_adv_processo'])==1) { 
				$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=muda_stat('adv_processo','".$d."','1') class='btn-mini ptip_se' title='Publicar'><img src='".$linkSet."template/img/icones_novos/16/stat-0.png' /></a></div>";
			} else { 
				$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=alert('Você não tem permissão para esta ação !') class='btn-mini ptip_se' title='Publicar'><img src='".$linkSet."template/img/icones_novos/16/stat-0.png' /></a></div>";
			} 
		} 
	
	} 
	$acao_set .= "</div>";

	return $acao_set;
}

function situacao_set($d) {

	$sysperm_adv_processo = mysql_fetch_array(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$_REQUEST['sysusuS']."'"));

	$rSqlProcessoTipo = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo_tipo WHERE id='".$d."'"));

	$situacao_div  = "<div style='float:left;'>";
	if(trim($d)==0) {
	
	$situacao_div .= "<div style='background-color:#000;border:1px solid #000;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>Sem Situação</div>";
	
	} else {
		
	$situacao_div .= "<div style='background-color:".$rSqlProcessoTipo['cor'].";border:1px solid ".$rSqlProcessoTipo['cor'].";width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>".$rSqlProcessoTipo['nome']."</div>";
	
	}
    
	$situacao_div .= "</div>";

	return $situacao_div;
}

function clientes_set($d) {

	$sysperm_adv_processo = mysql_fetch_array(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$_REQUEST['sysusuS']."'"));
	
	$rSqlProcesso = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo WHERE id='".$d."'"));

	$qSqlCategoria = mysql_query("SELECT * FROM adv_processo_syscliente WHERE numeroUnico_pai='".$rSqlProcesso['numeroUnico']."' ORDER BY data DESC");
	while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {

		$syscliente_set = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$rSqlCategoria['idsyscliente']."'"));

		if(trim($lista_de_clientes)=="") {
			$lista_de_clientes = "".$syscliente_set['nome']."";
		} else {
			$lista_de_clientes = $lista_de_clientes.", ".$syscliente_set['nome']."";
		}
	}


	return $lista_de_clientes;
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
$table = 'adv_processo';
 
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
        'db'        => 'idadv_processo_tipo',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
            return situacao_set($d);
        }
    ),
    #array( 'db' => 'criador_nome',   'dt' => 2 ),
    array( 'db' => 'lista_syscliente_nome',   'dt' => 2 ),
    array( 'db' => 'cod',   'dt' => 3 ),
    array( 'db' => 'nome_acao',     'dt' => 4 ),
    #array( 'db' => 'dataModificacao_txt',   'dt' => 6 ),
    array( 'db' => 'id',   'dt' => 5 ),
    array(
        'db'        => 'id',
        'dt'        => 6,
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
 
$sysperm_adv_processo = mysql_fetch_array(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$_REQUEST['sysusuS']."'"));

$sysperm_adv_parceiro = mysql_fetch_array(mysql_query("SELECT * FROM adv_parceiro WHERE idsysusu='".$_REQUEST['sysusuS']."'"));

if(trim($_REQUEST['var4'])=="")    {
	if(trim($sysperm_adv_processo['todos_adv_processo'])==1) { 
		echo json_encode(
			SSP::simple( $_GET, "ORDER BY dataModificacao DESC", $sql_details, $table, $primaryKey, $columns )
		);
	} else {
		if(trim($sysperm_adv_parceiro['ver'])==1) { 
			echo json_encode(
				SSP::simple_criador( $_REQUEST['sysusuS'], $_GET, "ORDER BY dataModificacao DESC", $sql_details, $table, $primaryKey, $columns )
			);
		} else {
			echo json_encode(
				SSP::simple( $_GET, "ORDER BY dataModificacao DESC", $sql_details, $table, $primaryKey, $columns )
			);
		}
	}
} else {
	if(trim($sysperm_adv_processo['todos_adv_processo'])==1) { 
		echo json_encode(
			SSP::complex( $_GET, "ORDER BY dataModificacao DESC", $sql_details, $table, $primaryKey, $columns, "idadv_processo_tipo", $_REQUEST['var4'] )
		);
	} else {
		if(trim($sysperm_adv_parceiro['ver'])==1) { 
			echo json_encode(
				SSP::complex_criador( $_REQUEST['sysusuS'], $_GET, "ORDER BY dataModificacao DESC", $sql_details, $table, $primaryKey, $columns, "idadv_processo_tipo", $_REQUEST['var4'] )
			);
		} else {
			echo json_encode(
				SSP::complex( $_GET, "ORDER BY dataModificacao DESC", $sql_details, $table, $primaryKey, $columns, "idadv_processo_tipo", $_REQUEST['var4'] )
			);
		}
	}
}

?>
