																	<? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <?
                                                                    $nSqlItem = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."_item WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC"));
																	if(trim($nSqlItem)==0) { 
																	?>
                                                                    <div class="w-box-header w-box-blue">
                                                                        <h4>Nenhum Item Relacionado</h4>
                                                                    </div>
                                                                    <? } else { ?>
                                                                    <div class="w-box-header w-box-blue">
                                                                        <h4>Itens Relacionados</h4>
                                                                    </div>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome</th>
                                                                            <th style="width:200px;">Valor</th>
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

                                                                        $qSqlItem = mysql_query("SELECT * FROM ".$modGet."_item WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <tr>
                                                                            <? $rSqlItem = mysql_fetch_array(mysql_query("SELECT * FROM ".$rSqlItem['tipo']." WHERE id='".$rSqlItem['iditem']."'")); ?>
                                                                            <td style="vertical-align:middle;"><?=$rSqlItem['nome']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlItem['valor']?></td>
                                                                            <?
																			$valor_limpo = str_replace(".","",$rSqlItem['valor']); 
																			for ($i = 1; $i <= 10; $i++) {
																				$valor_limpo = str_replace(".","",$valor_limpo);
																			}
																			$valor_limpo = str_replace(",",".",$valor_limpo);

																			$valor_mensalidade_limpo = str_replace(".","",$rSqlItem['valor_mensalidade']); 
																			for ($i = 1; $i <= 10; $i++) {
																				$valor_mensalidade_limpo = str_replace(".","",$valor_mensalidade_limpo);
																			}
																			$valor_mensalidade_limpo = str_replace(",",".",$valor_mensalidade_limpo);

																			$valor_total =  $valor_total + $valor_limpo;
																			$valor_total_mensalidade =  $valor_total_mensalidade + $valor_mensalidade_limpo;
																			?>
                                                                            <td style="vertical-align:middle;"><?=$rSqlItem['valor_mensalidade']?></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_item_syssistemas('<?=$numeroUnicoGet?>','<?=$sufixoGet?>','<?=$rSqlItem['id']?>','<?=$modGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>

                                                                    <? if(trim($valor_total)==""&&trim($valor_total_mensalidade)=="") { } else { ?>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th style="width:200px;">Total de Invest.</th>
                                                                            <th style="width:200px;">Total de Mensalidade</th>
                                                                            <th style="width:30px;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="vertical-align:middle;"></td>
                                                                            <td style="vertical-align:middle;"><? if(trim($valor_total)==""){ } else { echo number_format($valor_total, 2, ',','.'); } ?></td>
                                                                            <td style="vertical-align:middle;"><? if(trim($valor_total_mensalidade)==""){ } else { echo number_format($valor_total_mensalidade, 2, ',','.'); } ?></td>
                                                                            <td style="vertical-align:middle;" class="nolink"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                    <? } ?>
                                                                    <? } ?>
