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
	return corrigirAcentuacao($criador_processo['nome']);
}
function local_set($d) {
	$nomeSet = strtoupper($d);
	#return $nomeSet;
	return mb_strtoupper($nomeSet);
	#return corrigirAcentuacao($nomeSet);
}
function detalhe_set($d) {
	$nomeSet = strtoupper($d);
	$nomeSet = corrigirAcentuacao($nomeSet);
	$nomeSet = mb_strtoupper($nomeSet);
	return $nomeSet;
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
$table = 'syslog';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array(
        'db'        => 'idsysusu',
        'dt'        => 0,
        'formatter' => function( $d, $row ) {
            return criador_set($d);
        }
    ),
    array( 'db' => 'acao',   'dt' => 1 ),
	array(
        'db'        => 'local',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
            return local_set($d);
        }
    ),
	array(
        'db'        => 'detalhe',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
            return detalhe_set($d);
        }
    ),
    array(
        'db'        => 'data',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            return data_setagem($d);
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
 
if(trim($_REQUEST['var3'])=="") {
	#$_REQUEST['var3'] = "".$_REQUEST['sysusuS']."";
	$_REQUEST['var3'] = "";
} else {
	$_REQUEST['var3'] = "".$_REQUEST['var3']."";
}

$retorno = SSP::simple_criador( $sysusuS_set, $_GET, "ORDER BY id DESC", $sql_details, $table, $primaryKey, $columns, "idsysusu", $_REQUEST['var3'] );

#var_dump($retorno);
#echo json_encode($retorno);

foreach ($retorno['data'] as $item) {
	
	#$item[2] = preg_replace("/[^a-zA-ZÀ-ú ]+/", "", $item[2]);
	#$item[3] = preg_replace("/[^a-zA-Z ]+/", "", $item[3]);

	$newArray[] = [
        $item[0],
        $item[1],
        $item[2],
		$item[3],
        $item[4]
    ];

}

$novoRetorno = [];
$novoRetorno['data'] = $newArray;

#var_dump($novoRetorno);
echo json_encode($novoRetorno);

?>
