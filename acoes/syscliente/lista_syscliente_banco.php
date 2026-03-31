                                                                    <? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome</th>
                                                                            <th>Tipo de Conta</th>
                                                                            <th>Banco</th>
                                                                            <th>Agência</th>
                                                                            <th>Conta</th>
                                                                            <th>Operação</th>
                                                                            <th>Favorecido</th>
                                                                            <th>Documento</th>
                                                                            <th style="width:60px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $qSqlCategoria = mysql_query("SELECT * FROM ".$modGet."_banco WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
                                                                        <tr>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                            <? 
																			if(trim($rSqlCategoria['tipo_conta'])=="cc-pf") {
																				$tipo_conta_set = "Conta-corrente PF";
																				$tipo_favorecido = $rSqlCategoria['favorecido_cpf'];
																			} else {
																				if(trim($rSqlCategoria['tipo_conta'])=="cp-pf") {
																					$tipo_conta_set = "Conta-poupança PF";
																					$tipo_favorecido = $rSqlCategoria['favorecido_cpf'];
																				} else {
																					if(trim($rSqlCategoria['tipo_conta'])=="cc-pj") {
																						$tipo_conta_set = "Conta-corrente PJ";
																						$tipo_favorecido = $rSqlCategoria['favorecido_cnpj'];
																					} else {
																						if(trim($rSqlCategoria['tipo_conta'])=="cp-pj") {
																							$tipo_conta_set = "Conta-poupança PJ";
																							$tipo_favorecido = $rSqlCategoria['favorecido_cnpj'];
																						} else {
																							$tipo_conta_set = "";
																							$tipo_favorecido = "";
																						}
																					}
																				}
																			}
																			?>
                                                                            
                                                                            <td style="vertical-align:middle;"><?=$tipo_conta_set?></td>
                                                                            <? $rSqlBanco = mysql_fetch_array(mysql_query("SELECT * FROM sysbanco_lista WHERE id='".$rSqlCategoria['idbanco']."'")); ?>
                                                                            <td style="vertical-align:middle;"><?=$rSqlBanco['nome']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['agencia']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['conta']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['operacao']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['favorecido']?></td>
                                                                            <td style="vertical-align:middle;"><?=$tipo_favorecido?></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <? if(trim($rSqlCategoria['principal'])=="1") { ?>
                                                                                <a href="javascript:void(0);" class="btn-mini ptip_se" title="Endereço Principal"><img src="<?=$link?>template/img/icones_novos/16/destaque-1.png" /></a>
                                                                                <? } else { ?>
                                                                                <a href="javascript:void(0);" onClick="principal_banco('<?=$rSqlCategoria['id']?>','<?=$modGet?>');" class="btn-mini ptip_se" title="Tornar Principal"><img src="<?=$link?>template/img/icones_novos/16/destaque-0.png" /></a>
                                                                                <? } ?>
                                                                                <a href="javascript:void(0);" onClick="remover_banco('<?=$rSqlCategoria['id']?>','<?=$modGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
