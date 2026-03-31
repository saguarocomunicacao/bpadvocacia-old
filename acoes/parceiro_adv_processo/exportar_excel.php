<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */
/** Error reporting */
#error_reporting(E_ALL);
#ini_set('display_errors', TRUE);
#ini_set('display_startup_errors', TRUE);
#date_default_timezone_set('Europe/London');
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
/** Include PHPExcel */

include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
#include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

define("MYSQL_HOST","localhost");
define("MYSQL_USER","bpadv_bpadv");
define("MYSQL_PASS","santo7931");
define("MYSQL_BANK","bpadv_2017b");

# Função responsável por conexão de Banco de Dados
if(!function_exists('conexao')) {
	function conexao() {
		$dbcon = mysqli_connect("localhost","bpadv_bpadv","santo7931") // host, usuário bd, senha bd
		or die("Não foi possível conectar ao servidor msql: ".mysqli_error()); // erro retornado no caso de erro de conexão

		mysqli_select_db($dbcon, "bpadv_2017b" ) // banco de dados
		or 
		die('Error: ' . mysqli_error($dbcon));

		mysqli_query($dbcon, "SET NAMES 'utf8'");
		mysqli_query($dbcon, 'SET character_set_connection=utf8');
		mysqli_query($dbcon, 'SET character_set_client=utf8');
		mysqli_query($dbcon, 'SET character_set_results=utf8');
		
	}
}

conexao();

include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/mysqli.php");

$arr = array();
$cmp = array();
$tam = array();

$arr[]["label"] = "Situação";
$cmp[]["campo"] = "situacao";
$tam[]["tamanho"] = "25";

$arr[]["label"] = "Nº do Processo";
$cmp[]["campo"] = "cod";
$tam[]["tamanho"] = "25";

$arr[]["label"] = "Nome do Parceiro";
$cmp[]["campo"] = "nome_parceiro";
$tam[]["tamanho"] = "25";

$arr[]["label"] = "Nome da Ação";
$cmp[]["campo"] = "nome_acao";
$tam[]["tamanho"] = "25";

$arr[]["label"] = "Nome Completo";
$cmp[]["campo"] = "nome";
$tam[]["tamanho"] = "35";

$arr[]["label"] = "CPF";
$cmp[]["campo"] = "cpf";
$tam[]["tamanho"] = "20";

$arr[]["label"] = "RG";
$cmp[]["campo"] = "rg";
$tam[]["tamanho"] = "10";

$arr[]["label"] = "Ocupação";
$cmp[]["campo"] = "ocupacao";
$tam[]["tamanho"] = "20";

$arr[]["label"] = "Nacionalidade";
$cmp[]["campo"] = "nacionalidade";
$tam[]["tamanho"] = "20";

$arr[]["label"] = "Estado Civil";
$cmp[]["campo"] = "estado_civil";
$tam[]["tamanho"] = "10";

$arr[]["label"] = "Telefone";
$cmp[]["campo"] = "telefone";
$tam[]["tamanho"] = "20";

$arr[]["label"] = "CEP";
$cmp[]["campo"] = "cep";
$tam[]["tamanho"] = "10";

$arr[]["label"] = "Endereço";
$cmp[]["campo"] = "rua";
$tam[]["tamanho"] = "20";

$arr[]["label"] = "Número";
$cmp[]["campo"] = "numero";
$tam[]["tamanho"] = "10";

$arr[]["label"] = "Complemento";
$cmp[]["campo"] = "complemento";
$tam[]["tamanho"] = "20";

$arr[]["label"] = "Bairro";
$cmp[]["campo"] = "bairro";
$tam[]["tamanho"] = "20";

$arr[]["label"] = "Cidade";
$cmp[]["campo"] = "cidade";
$tam[]["tamanho"] = "20";

$arr[]["label"] = "Estado";
$cmp[]["campo"] = "estado";
$tam[]["tamanho"] = "20";


include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpexcel/Classes/PHPExcel.php");

//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("TAGX")
							 ->setLastModifiedBy("TAGX")
							 ->setTitle("Relatório Completo");
// Add some data

$count = count($arr);
for ($i = 0; $i < $count; $i++) {
	if($i==0) { $cel = "A"; }
	if($i==1) { $cel = "B"; }
	if($i==2) { $cel = "C"; }
	if($i==3) { $cel = "D"; }
	if($i==4) { $cel = "E"; }
	if($i==5) { $cel = "F"; }
	if($i==6) { $cel = "G"; }
	if($i==7) { $cel = "H"; }
	if($i==8) { $cel = "I"; }
	if($i==9) { $cel = "J"; }
	if($i==10) { $cel = "K"; }
	if($i==11) { $cel = "L"; }
	if($i==12) { $cel = "M"; }
	if($i==13) { $cel = "N"; }
	if($i==14) { $cel = "O"; }
	if($i==15) { $cel = "P"; }
	if($i==16) { $cel = "Q"; }
	if($i==17) { $cel = "R"; }
	if($i==18) { $cel = "S"; }
	
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue("".$cel."1", "".$arr[$i]["label"]."");

}

$count = count($tam);
for ($i = 0; $i < $count; $i++) {
	if($i==0) { $cel = "A"; }
	if($i==1) { $cel = "B"; }
	if($i==2) { $cel = "C"; }
	if($i==3) { $cel = "D"; }
	if($i==4) { $cel = "E"; }
	if($i==5) { $cel = "F"; }
	if($i==6) { $cel = "G"; }
	if($i==7) { $cel = "H"; }
	if($i==8) { $cel = "I"; }
	if($i==9) { $cel = "J"; }
	if($i==10) { $cel = "K"; }
	if($i==11) { $cel = "L"; }
	if($i==12) { $cel = "M"; }
	if($i==13) { $cel = "N"; }
	if($i==14) { $cel = "O"; }
	if($i==15) { $cel = "P"; }
	if($i==16) { $cel = "Q"; }
	if($i==17) { $cel = "R"; }
	if($i==18) { $cel = "S"; }
	
	$tamanho_set = $tam[$i]["tamanho"];
	
	$objPHPExcel->getActiveSheet()->getColumnDimension("".$cel."")->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getStyle("".$cel."1")->getFont()->setBold(true);
	#$objPHPExcel->getActiveSheet()->getColumnDimension("".$cel."")->setWidth($tamanho_set);

}


if(trim($_REQUEST['situacao'])=="") {
	$filtroSituacao = "";
} else {
	$filtroSituacao = " AND mod_parceiro_adv_processo.idparceiro_adv_processo_tipo='".$_REQUEST['situacao']."' ";
}

if(trim($_REQUEST['adm'])=="1" || trim($_REQUEST['idsysgrupousuario'])=="1") {
	$filtroExcel = "";
} else {
	$filtroExcel = " AND mod_parceiro_adv_processo.criador='".$_REQUEST['idsysusu']."' ";
}

$qSql = mysql_query("
						SELECT 
							mod_parceiro_adv_processo.cod,
							mod_parceiro_adv_processo.nome,
							mod_parceiro_adv_processo.cpf,
							mod_parceiro_adv_processo.rg,
							mod_parceiro_adv_processo.ocupacao,
							mod_parceiro_adv_processo.nacionalidade,
							mod_parceiro_adv_processo.estado_civil,
							mod_parceiro_adv_processo.telefone,
							mod_parceiro_adv_processo.cep,
							mod_parceiro_adv_processo.rua,
							mod_parceiro_adv_processo.numero,
							mod_parceiro_adv_processo.complemento,
							mod_parceiro_adv_processo.bairro,
							mod_parceiro_adv_processo.cidade,
							mod_parceiro_adv_processo.estado,

							mod_sysusu.nome AS nome_parceiro , 

							mod_parceiro_adv_processo.idparceiro_adv_processo_tipo_txt AS nome_acao , 

							mod_parceiro_adv_processo_tipo.nome AS situacao 
						FROM 
							parceiro_adv_processo AS mod_parceiro_adv_processo
						LEFT JOIN
							parceiro_adv_processo_tipo AS mod_parceiro_adv_processo_tipo ON (mod_parceiro_adv_processo_tipo.id = mod_parceiro_adv_processo.idparceiro_adv_processo_tipo)
						LEFT JOIN
							sysusu AS mod_sysusu ON (mod_sysusu.id = mod_parceiro_adv_processo.idsysusu)
						WHERE 
							mod_parceiro_adv_processo.data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59'
							".$filtroSituacao."
							".$filtroExcel."
						ORDER BY 
							mod_parceiro_adv_processo.data DESC
						");
while($rSql = mysql_fetch_array($qSql)) {
	$cont_linha++;

	$count = count($cmp);
	for ($i = 0; $i < $count; $i++) {
		if($i==0) { $cel = "A"; }
		if($i==1) { $cel = "B"; }
		if($i==2) { $cel = "C"; }
		if($i==3) { $cel = "D"; }
		if($i==4) { $cel = "E"; }
		if($i==5) { $cel = "F"; }
		if($i==6) { $cel = "G"; }
		if($i==7) { $cel = "H"; }
		if($i==8) { $cel = "I"; }
		if($i==9) { $cel = "J"; }
		if($i==10) { $cel = "K"; }
		if($i==11) { $cel = "L"; }
		if($i==12) { $cel = "M"; }
		if($i==13) { $cel = "N"; }
		if($i==14) { $cel = "O"; }
		if($i==15) { $cel = "P"; }
		if($i==16) { $cel = "Q"; }
		if($i==17) { $cel = "R"; }
		if($i==18) { $cel = "S"; }

		if (trim($cmp[$i]["campo"])=="data" || trim($cmp[$i]["campo"])=="data_liquidacao" ) { 
			$valor_print = ajustaDataReturn($rSql[''.$cmp[$i]["campo"].''],"d/m/Y");
		} elseif ( trim($cmp[$i]["campo"])=="nome" ) { 
			if(trim($rSql[''.$cmp[$i]["campo"].''])=="") {
				$valor_print = "Usuário não cadastrado";
			} else {
				$valor_print = "".$rSql[''.$cmp[$i]["campo"].'']."";
			}
		} elseif ( trim($cmp[$i]["campo"])=="cod" ) { 
			$valor_print = "".$rSql['cod']."";
		} elseif ( trim($cmp[$i]["campo"])=="nome_acao" ) { 
			$valor_print = "".$rSql['nome_acao']."";
		} elseif ( trim($cmp[$i]["campo"])=="cpf" ) { 
			$valor_print = "".$rSql['cpf']."";
		} else {
			$valor_print = $rSql[''.$cmp[$i]["campo"].''];
		}

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue("".$cel."".$cont_linha."", "".$valor_print."");

		if ( trim($cmp[$i]["campo"])=="cpf" ) {
		} else {
			$objPHPExcel->getActiveSheet()->getStyle("".$cel."".$cont_linha."")->getNumberFormat()->setFormatCode('_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)');
		}

	}

}

/*
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Hello');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'World');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Hello 2');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Hello 3');

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Miscellaneous glyphs');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', 'Miscellaneous glyphs');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', 'Miscellaneous glyphs');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', 'Miscellaneous glyphs');
*/

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="000_relatorio.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;