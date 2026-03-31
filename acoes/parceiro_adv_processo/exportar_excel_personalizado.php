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

if(!function_exists('conexao')) {
function conexao() {

	$dbcon = mysql_connect("localhost","bpadv_bpadv","santo7931") // host, usuário bd, senha bd
	or die("Não foi possível conectar ao servidor msql: ".mysql_error()); // erro retornado no caso de erro de conexão
	
	mysql_select_db("bpadv_2017b", $dbcon) // banco de dados
	or die("Não foi possível selecionar o banco de dados desejado: ".mysql_error());  // erro retornado no caso de erro de conexão

	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');

}
}

conexao();

$arr = array();
$cmp = array();
$tam = array();

$arr[]["label"] = "Nome Completo";
$cmp[]["campo"] = "nome";
$tam[]["tamanho"] = "35";

$arr[]["label"] = "CPF";
$cmp[]["campo"] = "cpf";
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
	$filtroSituacao = " AND mod_parceiro_adv_processo.idparceiro_adv_processo_tipo='".$_REQUEST['idsysusu']."' ";
}

if(trim($_REQUEST['adm'])=="1") {
	$filtroExcel = "";
} else {
	$filtroExcel = " AND mod_parceiro_adv_processo.criador='".$_REQUEST['idsysusu']."' ";
}

$qSql = mysql_query("
						SELECT 
							mod_parceiro_adv_processo.nome,
							mod_parceiro_adv_processo.cpf
						FROM 
							parceiro_adv_processo AS mod_parceiro_adv_processo
						WHERE 
							mod_parceiro_adv_processo.idparceiro_adv_processo_tipo_de_acao='3'
						ORDER BY 
							mod_parceiro_adv_processo.nome ASC
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