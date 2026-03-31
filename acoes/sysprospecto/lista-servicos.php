																	<? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
																	<?
                                                                    $qSqlGroup = mysql_query("SELECT * FROM ".$modGet."_item WHERE numeroUnico_pai='".$numeroUnicoGet."' GROUP BY idsysproduto_categoria");
                                                                    while($rSqlGroup = mysql_fetch_array($qSqlGroup)) {
                                                                    ?>
                                                                    <? $rSqlProdutoCategoria = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto_categoria WHERE id='".$rSqlGroup['idsysproduto_categoria']."'")); ?>
                                                                    <div class="w-box-header w-box-blue">
                                                                        <h4><?=$rSqlProdutoCategoria['nome']?></h4>
                                                                    </div>

                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome</th>
                                                                            <th style="width:200px;">Valor do produto</th>
                                                                            <th style="width:200px;">Desconto</th>
                                                                            <th style="width:200px;">Total de Invest.</th>
                                                                            <th style="width:200px;">Mensalidade</th>
                                                                            <th style="width:30px;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
																		$valor_mensalidade_limpo = "";
																		$valor_subtotal_investimento = "";
																		$valor_total =  "";
																		$valor_total_investimento =  "";
																		$valor_total_desconto =  "";
																		$valor_total_mensalidade =  "";

                                                                        $qSqlItem = mysql_query("SELECT * FROM ".$modGet."_item WHERE numeroUnico_pai='".$numeroUnicoGet."' AND idsysproduto_categoria='".$rSqlGroup['idsysproduto_categoria']."' ORDER BY data DESC");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <tr>
                                                                            <? $rSqlProduto = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto WHERE id='".$rSqlItem['idsysproduto']."'")); ?>
                                                                            <td style="vertical-align:middle;"><?=$rSqlProduto['nome']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlItem['valor']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlItem['valor_desconto']?></td>
                                                                            <?
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
																			?>
                                                                            <td style="vertical-align:middle;"><?=number_format($valor_subtotal_investimento, 2, ',','.')?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlItem['valor_mensalidade']?></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_item_sysprospecto('<?=$numeroUnicoGet?>','<?=$sufixoGet?>','<?=$rSqlItem['id']?>','<?=$modGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    <!--
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th style="width:200px;">Subtotal de produto</th>
                                                                            <th style="width:200px;">Subtotal de Desconto</th>
                                                                            <th style="width:200px;">Subtotal de Invest.</th>
                                                                            <th style="width:200px;">Subtotal de Mensalidade</th>
                                                                            <th style="width:30px;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="vertical-align:middle;"></td>
                                                                            <td style="vertical-align:middle;"><?=number_format($valor_total, 2, ',','.')?></td>
                                                                            <td style="vertical-align:middle;"><?=number_format($valor_total_desconto, 2, ',','.')?></td>
                                                                            <td style="vertical-align:middle;"><?=number_format($valor_total_investimento, 2, ',','.')?></td>
                                                                            <td style="vertical-align:middle;"><?=number_format($valor_total_mensalidade, 2, ',','.')?></td>
                                                                            <td style="vertical-align:middle;" class="nolink"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                    -->
                                                                    </table>
																	<?
																	$valor_total_geral =  $valor_total_geral + $valor_total;
																	$valor_total_investimento_geral =  $valor_total_investimento_geral + $valor_total_investimento;
																	$valor_total_desconto_geral =  $valor_total_desconto_geral + $valor_total_desconto;
																	$valor_total_mensalidade_geral =  $valor_total_mensalidade_geral + $valor_total_mensalidade;
																	?>
                                                                    <? } ?>

                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th style="width:200px;">Total de produto</th>
                                                                            <th style="width:200px;">Total de Desconto</th>
                                                                            <th style="width:200px;">Total de Invest.</th>
                                                                            <th style="width:200px;">Total de Mensalidade</th>
                                                                            <th style="width:30px;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="vertical-align:middle;"></td>
                                                                            <td style="vertical-align:middle;"><?=number_format($valor_total_geral, 2, ',','.')?></td>
                                                                            <td style="vertical-align:middle;"><?=number_format($valor_total_desconto_geral, 2, ',','.')?></td>
                                                                            <td style="vertical-align:middle;"><?=number_format($valor_total_investimento_geral, 2, ',','.')?></td>
                                                                            <td style="vertical-align:middle;"><?=number_format($valor_total_mensalidade_geral, 2, ',','.')?></td>
                                                                            <td style="vertical-align:middle;" class="nolink"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
