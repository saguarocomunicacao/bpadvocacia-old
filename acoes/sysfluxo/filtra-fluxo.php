<?php
require_once("../../include/inc/main.php");
require_once("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$dsGet = $_GET['dsS'];
$deGet = $_GET['deS'];

$diaS = substr($dsGet,0,2);
$mesS = substr($dsGet,3,2);
$anoS = substr($dsGet,6,4);
$dataS = $anoS."-".$mesS."-".$diaS;

$diaE = substr($deGet,0,2);
$mesE = substr($deGet,3,2);
$anoE = substr($deGet,6,4);
$dataE = $anoE."-".$mesE."-".$diaE;

?>

                                                        <div class="w-box w-box">
                                                            <div class="w-box-header">
                                                                <h4>Fluxo de caixa</h4>
                                                                <div class="pull-left">
                                                                </div>
                                                            </div>
                                                            <div class="w-box-content">
                                                                <table class="table table-striped table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:120px;">Emissão</th>
                                                                        <th style="width:120px;">Vencimento</th>
                                                                        <th style="width:120px;">Pago em</th>
                                                                        <th style="width:150px;">Categoria</th>
                                                                        <th>Descrição</th>
                                                                        <th style="width:250px;">Cliente/Fornecedor</th>
                                                                        <th style="width:100px;">Valor</th>
                                                                        <th style="width:100px;">Ações</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?
																	$valor_total_conta = 0;
																	$valor_total_pagar = 0;
                                                                    $qSql = mysql_query("SELECT * FROM sysfluxo_de_caixa WHERE stat='1' AND data_vencimento BETWEEN '".$dataS."' AND '".$dataE."' ORDER BY data_vencimento ASC, data_emissao DESC");
                                                                    while($rSql = mysql_fetch_array($qSql)) {
																		$conta = mysql_fetch_array(mysql_query("SELECT * FROM ".$rSql['local']." WHERE numeroUnico='".$rSql['numeroUnico_pai']."'"));
																		
																		$valor_limpo = str_replace(".","",$conta['valor']); 
																		for ($i = 1; $i <= 10; $i++) {
																			$valor_limpo = str_replace(".","",$valor_limpo);
																		}
																		$valor_limpo = str_replace(",",".",$valor_limpo);
																		
																		$valor_desconto_limpo = str_replace(".","",$conta['valor_desconto']); 
																		for ($i = 1; $i <= 10; $i++) {
																			$valor_desconto_limpo = str_replace(".","",$valor_desconto_limpo);
																		}
																		$valor_desconto_limpo = str_replace(",",".",$valor_desconto_limpo);
																		
																		$valor_taxa_limpo = str_replace(".","",$conta['valor_taxa']); 
																		for ($i = 1; $i <= 10; $i++) {
																			$valor_taxa_limpo = str_replace(".","",$valor_taxa_limpo);
																		}
																		$valor_taxa_limpo = str_replace(",",".",$valor_taxa_limpo);
																		
																		$valor_juro_limpo = str_replace(".","",$conta['valor_juro']); 
																		for ($i = 1; $i <= 10; $i++) {
																			$valor_juro_limpo = str_replace(".","",$valor_juro_limpo);
																		}
																		$valor_juro_limpo = str_replace(",",".",$valor_juro_limpo);
																		
																		$valor_total_conta = $valor_limpo - $valor_desconto_limpo + ($valor_taxa_limpo + $valor_juro_limpo);
																		
																		if(trim($rSql['local'])=="sysconta_a_pagar") {
																			$valor_total_pagar =  $valor_total_pagar + $valor_total_conta;
																			if(trim($rSql['pago'])=="1") {
																				$valor_total_pago =  $valor_total_pago + $valor_total_conta;
																				$cor_conta = "#F00";
																			} else {
																				$cor_conta = "#999";
																			}
																		} else {
																			$valor_total_receber =  $valor_total_receber + $valor_total_conta;
																			if(trim($rSql['pago'])=="1") {
																				$valor_total_recebido =  $valor_total_recebido + $valor_total_conta;
																				$cor_conta = "#093";
																			} else {
																				$cor_conta = "#999";
																			}
																		}
                                                                    ?>
                                                                    <tr id="linha-<?=$rSql['id']?>">
                                                                        <td style="vertical-align:middle;"><? if(trim($rSql['data_emissao'])=="0000-00-00") { } else { ajustaData($rSql['data_emissao'],"d-m-Y"); } ?></td>
                                                                        <td style="vertical-align:middle;"><? if(trim($rSql['data_vencimento'])=="0000-00-00") { } else { ajustaData($rSql['data_vencimento'],"d-m-Y"); } ?></td>
                                                                        <td style="vertical-align:middle;"><? if(trim($rSql['data_pagamento'])=="0000-00-00") { } else { ajustaData($rSql['data_pagamento'],"d-m-Y"); } ?></td>

                                                                        <? $categoria = mysql_fetch_array(mysql_query("SELECT * FROM ".$rSql['local']."_categoria WHERE id='".$conta['id'.$rSql['local'].'_categoria']."'")); ?>
                                                                        <td style="vertical-align:middle;"><?=$categoria['nome']?></td>
                                                                        <td style="vertical-align:middle;"><?=$conta['nome']?></td>

                                                                        <? if(trim($rSql['local'])=="sysconta_a_pagar") { ?>
																		<? $sysfornecedor_table = mysql_fetch_array(mysql_query("SELECT * FROM sysfornecedor WHERE id='".$conta['idsysfornecedor']."'")); ?>
                                                                        <td style="vertical-align:middle;"><?=$sysfornecedor_table['nome']?></td>
                                                                        <? } else { ?>
                                                                        <? $sysdestinatario = mysql_fetch_array(mysql_query("SELECT * FROM ".$conta['tipo_destinatario']." WHERE id='".$conta['id'.$rSql['tipo_destinatario'].'']."'")); ?>
                                                                        <td style="vertical-align:middle;"><?=$sysdestinatario['nome']?></td>
                                                                        <? } ?>

                                                                        <td style="vertical-align:middle;"><font style="color:<?=$cor_conta?>;"><b><? if(trim($rSql['local'])=="sysconta_a_pagar") { ?>- <? } ?><? if($valor_total_pagar=="") { } else { ?><?=number_format($valor_total_conta, 2, ',','.')?><? } ?></b></font></td>
    
                                                                        <?
																		$sysmod_fluxo = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='".$rSql['local']."'"));
																		$nomeLimpo = transformaCaractere($sysmod_fluxo['nome']);
																		$sysmod_fluxo_categoria = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$sysmod_fluxo['idsysmod_categoria']."'"));
																		?>
                                                                        <td style="vertical-align:middle;" class="nolink">
                                                                            <div class="btn-group">
    
                                                                                <div style="float:left;width:16px;margin-left:10px;">
                                                                                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/<?=$rSql['local']?>/form-boleto.php?idContaS=<?=$rSql['id']?>" title="Imprimir Boleto"><img src="<?=$link?>template/img/icones_novos/16/boleto.png" /></a>
                                                                                </div>

                                                                                <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" class="btn-mini ptip_se" title="Enviar por e-mail"><img src="<?=$link?>template/img/icones_novos/16/enviar-boleto.png" /></a></div>

                                                                                <div style="float:left;width:16px;margin-left:10px;"><a href="<?=$link?><?=$sysmod_fluxo_categoria['url_amigavel']?>/<?=$nomeLimpo?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a></div>
    
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <? } ?>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
    

                                                        <div class="w-box w-box">
                                                            <div class="w-box-content" style="border-top:1px solid #ccc;">
                                                                <table class="table table-striped table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:50%;">Descrição</th>
                                                                        <th style="width:50%;">Valor</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                	<?
																	$valor_total_periodo = $valor_total_receber - $valor_total_pagar;
																	?>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;">Total de 'Contas a Pagar'</td>
                                                                        <td style="vertical-align:middle;"><? if($valor_total_pagar=="") { } else { ?><?=number_format($valor_total_pagar, 2, ',','.')?><? } ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;">Total de 'Contas a Receber'</td>
                                                                        <td style="vertical-align:middle;"><? if($valor_total_receber=="") { } else { ?><?=number_format($valor_total_receber, 2, ',','.')?><? } ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;">Total do período</td>
                                                                        <td style="vertical-align:middle;"><? if($valor_total_periodo==""&&$valor_total_periodo!=0) { } else { ?><font style="color:<? if($valor_total_periodo<0) { ?>#F00<? } else { ?>#039<? } ?>;"><b><?=number_format($valor_total_periodo, 2, ',','.')?></b></font><? } ?></td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="w-box w-box">
                                                            <div class="w-box-content" style="border-top:1px solid #ccc;">
                                                                <table class="table table-striped table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:50%;">Descrição</th>
                                                                        <th style="width:50%;">Valor</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;">Total de 'Contas Pagas'</td>
                                                                        <td style="vertical-align:middle;"><? if($valor_total_pago=="") { } else { ?><?=number_format($valor_total_pago, 2, ',','.')?><? } ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;">Total de 'Contas Recebidas'</td>
                                                                        <td style="vertical-align:middle;"><? if($valor_total_recebido=="") { } else { ?><?=number_format($valor_total_recebido, 2, ',','.')?><? } ?></td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="w-box w-box">
                                                            <div class="w-box-content" style="border-top:1px solid #ccc;">
                                                                <table class="table table-striped table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:50%;">Descrição</th>
                                                                        <th style="width:50%;">Valor</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                	<?
																	$valor_total_balanco = $valor_total_recebido - $valor_total_pago;
																	?>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;">Balanço do período</td>
                                                                        <td style="vertical-align:middle;"><? if($valor_total_balanco==""&&$valor_total_balanco!=0) { } else { ?><font style="color:<? if($valor_total_balanco<0) { ?>#F00<? } else { ?>#039<? } ?>;"><b><?=number_format($valor_total_balanco, 2, ',','.')?></b></font><? } ?></td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
