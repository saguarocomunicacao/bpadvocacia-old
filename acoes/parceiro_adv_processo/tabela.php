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

function acao_set($d,$linkSet,$sysusuSet) {
	
	$sysperm_acao = mysql_fetch_array(mysql_query("SELECT editar_parceiro_adv_processo,excluir_parceiro_adv_processo,todos_parceiro_adv_processo FROM syspermadmin WHERE idsysusu='".$_REQUEST['sysusuS']."'"));
	
	$parceiro_adv_processo = mysql_fetch_array(mysql_query("SELECT criador,idparceiro_adv_processo_tipo FROM parceiro_adv_processo WHERE id='".$d."'"));

	$nPermTipo = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM parceiro_adv_parceiro WHERE idsysusu='".$_REQUEST['sysusuS']."' AND idparceiro_adv_processo_tipo='".$parceiro_adv_processo['idparceiro_adv_processo_tipo']."'"));

	 if(trim($parceiro_adv_processo['idparceiro_adv_processo_tipo'])=="" || trim($parceiro_adv_processo['idparceiro_adv_processo_tipo'])=="0") {
		 $auth = "1";
	 } else {
		 if($nPermTipo[0]==0) {
			 if(trim($sysperm_acao['editar_parceiro_adv_processo'])==1||trim($sysperm_acao['todos_parceiro_adv_processo'])==1) {
				 $auth = "1";
			 } else {
				 $auth = "0";
			 }
		 } else {
			 if(trim($sysperm_acao['editar_parceiro_adv_processo'])==1||trim($sysperm_acao['todos_parceiro_adv_processo'])==1) {
				 $auth = "1";
			 } else {
				 $rSqlPermTipo = mysql_fetch_array(mysql_query("SELECT editar FROM parceiro_adv_parceiro WHERE idsysusu='".$_REQUEST['sysusuS']."' AND idparceiro_adv_processo_tipo='".$parceiro_adv_processo['idparceiro_adv_processo_tipo']."'"));
				 $auth = "".$rSqlPermTipo['editar']."";
			 }
		 }
	 }

	$acao_set = "<div class='btn-group'>";

	if($auth=="1") {
		$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='http://".$_SERVER["SERVER_NAME"]."/admin/".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$d."/' class='btn-mini ptip_se' title='Editar'><img src='".$linkSet."template/img/icones_novos/16/editar.png' /></a></div>";
	}
	
	if(trim($parceiro_adv_processo['criador'])==$sysusuSet||trim($sysperm_acao['todos_parceiro_adv_processo'])==1) { 
	
		if(trim($sysperm_acao['excluir_parceiro_adv_processo'])==1||trim($sysperm_acao['todos_parceiro_adv_processo'])==1) { 
			#$acao_set .= "<div style='float:left;width:16px;margin-left:10px;'><a href='javascript:void(0);' onclick=remover_item_tabela('".$d."','parceiro_adv_processo','NAO','') class='btn-mini ptip_se' title='Remover'><img src='".$linkSet."template/img/icones_novos/16/remover-x.png' /></a></div>";
		} 
	} 
	$acao_set .= "</div>";

	return $acao_set;
}

function situacao_set($d) {

	$rSqlProcessoTipo = mysql_fetch_array(mysql_query("SELECT cor,nome FROM parceiro_adv_processo_tipo WHERE id='".$d."'"));

	$situacao_div  = "<div style='float:left;'>";
	if(trim($d)==0) {
		$situacao_div .= "<div style='background-color:#000;border:1px solid #000;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>Sem Situação</div>";
	} else {
		$situacao_div .= "<div style='background-color:".$rSqlProcessoTipo['cor'].";border:1px solid ".$rSqlProcessoTipo['cor'].";width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>".$rSqlProcessoTipo['nome']."</div>";
	}
    
	$situacao_div .= "</div>";

	return $situacao_div;
}

function situacao_set_txt($d) {

	//$d = corrigirAcentuacao($d);
	
	$rSqlProcessoTipo = mysql_fetch_array(mysql_query("SELECT cor,nome FROM parceiro_adv_processo_tipo WHERE id='".$d."'"));

	$situacao_div  = "<div style='float:left;'>";
	if(trim($d)=="") {
		$situacao_div .= "<div style='background-color:#000;border:1px solid #000;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>".$d."</div>";
	} else {
		if(trim($d)=="Sem Situação") { 
			$situacao_div .= "<div style='background-color:#000;border:1px solid #000;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>".$d."</div>";
		} else { 
			$situacao_div .= "<div style='background-color:".$rSqlProcessoTipo['cor'].";border:1px solid ".$rSqlProcessoTipo['cor'].";width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>".corrigirAcentuacao($rSqlProcessoTipo['nome'])."</div>";
		}
	}
    
	$situacao_div .= "</div>";

	return $situacao_div;
}

function tipo_acao_set($d) {

	$rSqlProcessoTipo = mysql_fetch_array(mysql_query("SELECT cor,nome FROM parceiro_adv_processo_tipo_de_acao WHERE id='".$d."'"));

	$situacao_div  = "<div style='float:left;'>";
	if(trim($d)==0) {
		$situacao_div .= "<div style='background-color:#000;border:1px solid #000;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>Sem ação</div>";
	} else {
		if(trim($rSqlProcessoTipo['cor'])=="") { $cor_set = "#000"; } else { $cor_set = "".$rSqlProcessoTipo['cor'].""; }
		$situacao_div .= "<div style='background-color:".$cor_set.";border:1px solid ".$cor_set.";width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>".$rSqlProcessoTipo['nome']."</div>";
	}
    
	$situacao_div .= "</div>";

	return $situacao_div;
}

function tipo_acao_set_txt($d) {

	#$rSqlProcessoTipo = mysql_fetch_array(mysql_query("SELECT cor,nome FROM parceiro_adv_processo_tipo_de_acao WHERE id='".$d."'"));
	$rSqlProcessoTipo = mysql_fetch_array(mysql_query("SELECT cor FROM parceiro_adv_processo_tipo_de_acao WHERE nome='".$d."'"));

	$situacao_div  = "<div style='float:left;'>";
	if(trim($d)=="") {
		$situacao_div .= "<div style='background-color:#000;border:1px solid #000;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>Sem ação</div>";
	} else {
		if(trim($rSqlProcessoTipo['cor'])=="") { $cor_set = "#000"; } else { $cor_set = "".$rSqlProcessoTipo['cor'].""; }
		$situacao_div .= "<div style='background-color:".$cor_set.";border:1px solid ".$cor_set.";width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;'>".corrigirAcentuacao($d)."</div>";
	}
    
	$situacao_div .= "</div>";

	return $situacao_div;
}

function data_setagem($d) {
	
	$dataVar = $d;

	$dia  = substr($dataVar,8,2);
	$mes  = substr($dataVar,5,2);
	$ano  = substr($dataVar,0,4);
	$hora = substr($dataVar,11,19);

	$arrayData = mktime(0,0,0,$mes,$dia,$ano);
	$dataCorreta = date("d/m/Y", $arrayData);

	return $dataCorreta." ".$hora;
}

function clientes_set($d) {

	$rSqlProcesso = mysql_fetch_array(mysql_query("SELECT numeroUnico FROM parceiro_adv_processo WHERE id='".$d."'"));

	$qSqlCategoria = mysql_query("SELECT idparceiro_syscliente FROM parceiro_adv_processo_parceiro_syscliente WHERE numeroUnico_pai='".$rSqlProcesso['numeroUnico']."' ORDER BY data DESC");
	while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {

		$parceiro_syscliente_set = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_syscliente WHERE id='".$rSqlCategoria['idparceiro_syscliente']."'"));

		if(trim($lista_de_clientes)=="") {
			$lista_de_clientes = "".$parceiro_syscliente_set['nome']."";
		} else {
			$lista_de_clientes = $lista_de_clientes.", ".$parceiro_syscliente_set['nome']."";
		}
	}


	return $lista_de_clientes;
}
 
function tipo_id_ano_set($d) {
	$rSqlProcesso = mysql_fetch_array(mysql_query("SELECT id,data FROM parceiro_adv_processo WHERE id='".$d."'"));
	
	$ano = substr($rSqlProcesso['data'],0,4);

	return "".$d." - ".$ano."";
}
 
function nome_set($d) {
	$nomeSet = strtoupper($d);
	return corrigirAcentuacao($nomeSet);
}
 
function cpf_set($d) {
	$documentoSend = preg_replace("/[^0-9]/", "",$d);
	if(trim($documentoSend)=="") { } else {
		$valor_print = str_replace(" ","",$documentoSend);
		$parte1 = substr($valor_print,0,3);
		$parte2 = substr($valor_print,3,3);
		$parte3 = substr($valor_print,6,3);
		$parte4 = substr($valor_print,9,2);
		$valor_print = "".$parte1.".".$parte2.".".$parte3."-".$parte4."";
		return $valor_print;
	}
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
$table = 'parceiro_adv_processo';
 
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

    /*array(
        'db'        => 'idparceiro_adv_processo_tipo',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
            return situacao_set($d);
        }
    ),*/
    array(
        'db'        => 'idparceiro_adv_processo_tipo',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
            return situacao_set_txt($d);
        }
    ),
    array(
        'db'        => 'id',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
            return tipo_id_ano_set($d);
        }
    ),

    array( 'db' => 'nome_limpo',   'dt' => 3 ),
    
	/*array(
        'db'        => 'nome_limpo',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
            return nome_set($d);
        }
    ),*/

	array(
        'db'        => 'cpf_limpo',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            return cpf_set($d);
        }
    ),
	
	/*
    array( 'db' => 'cpf',   'dt' => 4 ),
	*/
    
	/*
	array(
        'db'        => 'idparceiro_adv_processo_tipo_de_acao',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            return tipo_acao_set($d);
        }
    ),*/
    
	array(
        'db'        => 'idparceiro_adv_processo_tipo_de_acao_txt',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return tipo_acao_set_txt($d);
        }
    ),
    array( 'db' => 'criador_txt',   'dt' => 6 ),
    /*array(
        'db'        => 'criador',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return criador_set($d);
        }
    ),*/
    array( 'db' => 'cod',   'dt' => 7 ),
    /*
	array( 'db' => 'id',   'dt' => 6 ),
    array(
        'db'        => 'dataModificacao',
        'dt'        => 7,
        'formatter' => function( $d, $row ) {
            return data_setagem($d);
        }
    ),
	*/
    array(
        'db'        => 'id',
        'dt'        => 8,
        'formatter' => function( $d, $row ) {
            return acao_set($d,"http://".$_SERVER["SERVER_NAME"]."/admin/",$_REQUEST['sysusuS']);
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
 
$sysperm_parceiro_adv_processo = mysql_fetch_array(mysql_query("SELECT todos_parceiro_adv_processo FROM syspermadmin WHERE idsysusu='".$_REQUEST['sysusuS']."'"));

if(trim($sysperm_parceiro_adv_processo['todos_parceiro_adv_processo'])==1) { 
	$sysusuS_set = "";
} else {
	if(trim($_REQUEST['var4'])=="") {
		#echo "1";
		$sysusuS_set = "".$_REQUEST['sysusuS']."";
	} else {
		$nPermTipo = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM parceiro_adv_parceiro WHERE idsysusu='".$_REQUEST['sysusuS']."' AND idparceiro_adv_processo_tipo='".$_REQUEST['var4']."'"));

		if($nPermTipo[0]==0) {
			#echo "2";
			$sysusuS_set = "".$_REQUEST['sysusuS']."";
		} else {
			$rSqlPermTipo = mysql_fetch_array(mysql_query("SELECT ver FROM parceiro_adv_parceiro WHERE idsysusu='".$_REQUEST['sysusuS']."' AND idparceiro_adv_processo_tipo='".$_REQUEST['var4']."'"));
			if(trim($rSqlPermTipo['ver'])=="0") {
				#echo "3";
				$sysusuS_set = "";
			} else {
				#echo "4";
				$sysusuS_set = "".$_REQUEST['sysusuS']."";
			}
			#echo "[".$sysusuS_set."] [".$_REQUEST['var4']."]";
		}
	}
	#$sysusuS_set = "".$_REQUEST['sysusuS']."";
}

if(trim($_REQUEST['var3'])=="") {
	$retorno = SSP::simple_criador( $sysusuS_set, $_GET, "ORDER BY id DESC", $sql_details, $table, $primaryKey, $columns, "idparceiro_adv_processo_tipo", $_REQUEST['var4'] );
} else if(trim($_REQUEST['var3'])=="acao") {
	$retorno = SSP::simple_criador( $sysusuS_set, $_GET, "ORDER BY id DESC", $sql_details, $table, $primaryKey, $columns, "idparceiro_adv_processo_tipo_de_acao", $_REQUEST['var4'] );
} else if(trim($_REQUEST['var3'])=="tipo") {
	$retorno = SSP::simple_criador( $sysusuS_set, $_GET, "ORDER BY id DESC", $sql_details, $table, $primaryKey, $columns, "idparceiro_adv_processo_tipo", $_REQUEST['var4'] );
}
#var_dump($retorno);
echo json_encode($retorno);

/*
foreach ($retorno['data'] as $item) {
	
	$item[3] = preg_replace("/[^a-zA-Z ]+/", "", $item[3]);
	$item[6] = preg_replace("/[^a-zA-Z ]+/", "", $item[6]);
	#$item[7] = preg_replace("/[^a-zA-Z ]+/", "", $item[7]);

	$newArray[] = [
        $item[0],
        $item[1],
        $item[2],
		$item[3],
        $item[4],
        $item[5],
        $item[6],
        $item[7],
        $item[8]
    ];
}

$novoRetorno = [];
$novoRetorno['data'] = $newArray;

#var_dump($novoRetorno);
echo json_encode($novoRetorno);
*/

?>
