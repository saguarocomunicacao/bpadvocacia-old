<?
#define o encoding do cabeçalho para utf-8
@header("Content-Type: text/html; charset=utf-8");

#carrega o arquivo XML e retornando um Objeto
$xml = simplexml_load_file("http://www.publicacoesonline.com.br/index_get_xml_publicacoes.php?usuario=teste&senha=teste321&enviadas=S");
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr style="border-bottom:1px solid #000;padding-bottom:10px;padding-top:10px;background-color:#000;color:#FFF;font-weight:bold;">
        <td style="padding-left:5px;padding-right:5px;">Nome</td>
        <td style="padding-left:5px;padding-right:5px;">Código</td>
        <td style="padding-left:5px;padding-right:5px;">Processo</td>
        <td style="padding-left:5px;padding-right:5px;" nowrap="nowrap">Processo Antigo</td>
        <td style="padding-left:5px;padding-right:5px;">Data</td>
        <td style="padding-left:5px;padding-right:5px;">Jornal</td>
        <td style="padding-left:5px;padding-right:5px;">Orgão</td>
        <td style="padding-left:5px;padding-right:5px;">Cidade</td>
        <td style="padding-left:5px;padding-right:5px;">Vara</td>
        <td style="padding-left:5px;padding-right:5px;">Página</td>
        <td style="padding-left:5px;padding-right:5px;">Texto</td>
    </tr>
	<? 
	$cor = "#f0f0f0";
	foreach($xml->row as $processo) { 
		if($cor == "#f0f0f0") {
			$cor = "#ffffff";
		} else {
			$cor = "#f0f0f0";
		}
	?>
    <tr style="background-color:<?=$cor?>;padding-left:5px;">
        <td style="padding:5px;"><?=$processo->nome?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->codigo?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->processo?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->processo_antigo?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->data?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->jornal?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->orgao?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->cidade?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->vara?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->pagina?></td>
        <td style="border-left:1px solid #666;padding:5px;"><?=$processo->texto?></td>
    </tr>
    <? } ?>
</table>
