<?
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$numeroUnicoGet = $_GET['numeroUnicoS'];

$sysprospecto = mysql_fetch_array(mysql_query("SELECT * FROM sysprospecto WHERE id='".$idGet."'"));
$syscliente = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$sysprospecto['idsyscliente']."'"));

$msg  = "<html>";
$msg .= "<head>";
$msg .= "<meta http-equiv=Content-Type content=text/html; charset=utf-8 />";
$msg .= "<title>".$sysconfig['nome']."</title>";

$msg .= "<style>";
$msg .= ".CinzaM {";
$msg .= "	color:#717171;";
$msg .= "	font-family:Arial, Helvetica, sans-serif;";
$msg .= "	font-size:12px;";
$msg .= "	font-style:normal;";
$msg .= "	font-weight:normal;";
$msg .= "	text-decoration:none;";
$msg .= "}";
$msg .= ".CinzaG {";
$msg .= "	color:#717171;";
$msg .= "	font-family:Arial, Helvetica, sans-serif;";
$msg .= "	font-size:24px;";
$msg .= "	font-style:normal;";
$msg .= "	font-weight:normal;";
$msg .= "	text-decoration:none;";
$msg .= "}";
$msg .= "</style>";

$msg .= "</head>";

$msg .= "<body>";
$msg .= "<table width=\"100%\">";
	$qSqlGroup = mysql_query("SELECT * FROM sysprospecto_item WHERE numeroUnico_pai='".$numeroUnicoGet."' GROUP BY idsysproduto_categoria");
	while($rSqlGroup = mysql_fetch_array($qSqlGroup)) {

		$rSqlProdutoCategoria = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto_categoria WHERE id='".$rSqlGroup['idsysproduto_categoria']."'"));
																	
$msg .= "
		<tr style=\"background-color:#333;\">
			<td style=\"color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\" colspan=\"5\"><strong>".$rSqlProdutoCategoria['nome']."</strong></td>
		</tr>
		<tr style=\"background-color:#999;\">
			<td style=\"color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\"><strong>Nome</strong></td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\"><strong>Valor do produto</strong></td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\"><strong>Desconto</strong></td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\"><strong>Total de Invest.</strong></td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\"><strong>Mensalidade</strong></td>
		</tr>";

		$valor_mensalidade_limpo = "";
		$valor_subtotal_investimento = "";
		$valor_total =  "";
		$valor_total_investimento =  "";
		$valor_total_desconto =  "";
		$valor_total_mensalidade =  "";

		$cor = "#f0f0f0";
		$qSqlItem = mysql_query("SELECT * FROM sysprospecto_item WHERE numeroUnico_pai='".$numeroUnicoGet."' AND idsysproduto_categoria='".$rSqlGroup['idsysproduto_categoria']."' ORDER BY data DESC");
		while($rSqlItem = mysql_fetch_array($qSqlItem)) {
			$rSqlProduto = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto WHERE id='".$rSqlItem['idsysproduto']."'"));
			if($cor == "#f0f0f0") {
				$cor = "#ffffff";
			} else {
				$cor = "#f0f0f0";
			}

$msg .= "
		 <tr style=\"background-color:".$cor.";\">
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".$rSqlProduto['nome']."</td>
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".$rSqlItem['valor']."</td>
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".$rSqlItem['valor_desconto']."</td>";

			$valor_limpo = str_replace(".","",$rSqlItem['valor']); 
			for ($i = 1; $i <= 10; $i++) {
				$valor_limpo = str_replace(".","",$valor_limpo);
			}
			$valor_limpo = str_replace(",",".",$valor_limpo);

			$valor_desconto_limpo = str_replace(".","",$rSqlItem['valor_desconto']); 
			for ($i = 1; $i <= 10; $i++) {
				$valor_desconto_limpo = str_replace(".","",$valor_desconto_limpo);
			}
			$valor_desconto_limpo = str_replace(",",".",$valor_desconto_limpo);

			$valor_mensalidade_limpo = str_replace(".","",$rSqlItem['valor_mensalidade']); 
			for ($i = 1; $i <= 10; $i++) {
				$valor_mensalidade_limpo = str_replace(".","",$valor_mensalidade_limpo);
			}
			$valor_mensalidade_limpo = str_replace(",",".",$valor_mensalidade_limpo);

			$valor_subtotal_investimento = $valor_limpo - $valor_desconto_limpo;
			
			$valor_total =  $valor_total + $valor_limpo;
			$valor_total_investimento =  $valor_total_investimento + $valor_subtotal_investimento;
			$valor_total_desconto =  $valor_total_desconto + $valor_desconto_limpo;
			$valor_total_mensalidade =  $valor_total_mensalidade + $valor_mensalidade_limpo;

$msg .= "
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".number_format($valor_subtotal_investimento, 2, ',','.')."</td>
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".$rSqlItem['valor_mensalidade']."</td>
		</tr>";
		}
/*
$msg .= "
		<tr style=\"background-color:#999;\">
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">&nbsp;</td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\">Subtotal de produto</td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\">Subtotal de Desconto</td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\">Subtotal de Invest.</td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\">Subtotal de Mensalidade</td>
		</tr>
		<tr style=\"background-color:#a2cced;\">
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">&nbsp;</td>
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".number_format($valor_total, 2, ',','.')."</td>
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".number_format($valor_total_desconto, 2, ',','.')."</td>
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".number_format($valor_total_investimento, 2, ',','.')."</td>
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".number_format($valor_total_mensalidade, 2, ',','.')."</td>
		</tr>
		<tr style=\"height:10px;\">
			<td colspan=\"5\">&nbsp;</td>
		</tr>";
*/

		$valor_total_geral =  $valor_total_geral + $valor_total;
		$valor_total_investimento_geral =  $valor_total_investimento_geral + $valor_total_investimento;
		$valor_total_desconto_geral =  $valor_total_desconto_geral + $valor_total_desconto;
		$valor_total_mensalidade_geral =  $valor_total_mensalidade_geral + $valor_total_mensalidade;

		}

$msg .= "
		<tr style=\"height:10px;\">
			<td colspan=\"5\">&nbsp;</td>
		</tr>
		<tr style=\"background-color:#1768a6;\">
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">&nbsp;</td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\">Total de produto</td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\">Total de Desconto</td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\">Total de Invest.</td>
			<td style=\"width:150px;color:#FFF;padding-left:5px;padding-top:10px;padding-bottom:10px;\">Total de Mensalidade</td>
		</tr>
		<tr>
			<td style=\"vertical-align:middle;padding-left:5px;padding-top:10px;padding-bottom:10px;\">&nbsp;</td>
			<td style=\"vertical-align:middle;width:150px;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".number_format($valor_total_geral, 2, ',','.')."</td>
			<td style=\"vertical-align:middle;width:150px;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".number_format($valor_total_desconto_geral, 2, ',','.')."</td>
			<td style=\"vertical-align:middle;width:150px;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".number_format($valor_total_investimento_geral, 2, ',','.')."</td>
			<td style=\"vertical-align:middle;width:150px;padding-left:5px;padding-top:10px;padding-bottom:10px;\">".number_format($valor_total_mensalidade_geral, 2, ',','.')."</td>
		</tr>
	</table>";
$msg .= "
</body>
</html>";

$html = $msg;


if (PATH_SEPARATOR ==":") {
	$quebra = "\r\n";
} else {
	$quebra = "\n";
}

$nomeCliente = "".$syscliente['nome']."";
$emailCliente = "".$syscliente['email']."";

$nomeAdmin = "".$sysconfig['nome']."";
$emailAdmin = "".$sysconfig['email']."";

$assunto  = "Orçamento ".$sysconfig['nome']."";

$headersCliente  = "MIME-Version: 1.1".$quebra;
$headersCliente .= "Content-type: text/html; charset=utf-8".$quebra;
$headersCliente .= "From: " .$nomeAdmin. " <" .$emailAdmin. ">".$quebra;
$headersCliente .= "Return-Path: ".$emailAdmin."".$quebra; // return-path
$envioCliente = mail($emailCliente, utf8_decode($assunto), $html, $headersCliente);
 
#if($envioCliente) { echo "Mensagem enviada com sucesso"; } else { echo "A mensagem não pode ser enviada"; }

$headersAdmin  = "MIME-Version: 1.1".$quebra;
$headersAdmin .= "Content-type: text/html; charset=utf-8".$quebra;
$headersAdmin .= "From: " .$nomeCliente. " <" .$emailCliente. ">".$quebra;
$headersAdmin .= "Return-Path: ".$emailAdmin."".$quebra; // return-path
$envioAdmin = mail($emailAdmin, utf8_decode($assunto), $html, $headersAdmin);
 
#if($envioAdmin) { echo "Mensagem enviada com sucesso"; } else { echo "A mensagem não pode ser enviada"; }
?>
