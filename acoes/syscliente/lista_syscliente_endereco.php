                                                                    <? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome</th>
                                                                            <th>CEP</th>
                                                                            <th>Endereço</th>
                                                                            <!--
                                                                            <th>Número</th>
                                                                            <th>Complemento</th>
                                                                            -->
                                                                            <th>Bairro</th>
                                                                            <th>Cidade</th>
                                                                            <th>Estado</th>
                                                                            <th style="width:60px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $qSqlCategoria = mysql_query("SELECT * FROM ".$modGet."_endereco WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
                                                                        <tr>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['cep']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['rua']?></td>
                                                                            <!--
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['numero']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['complemento']?></td>
                                                                            -->
                                                                            <? $rSqlBairro = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_bairro WHERE id_bairro='".$rSqlCategoria['bairro']."' ORDER BY bairro")); ?>
                                                                            <td style="vertical-align:middle;"><?=utf8_encode($rSqlBairro['bairro'])?></td>
                                                                            <? $rSqlCidade = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_cidade WHERE id_cidade='".$rSqlCategoria['cidade']."' ORDER BY cidade")); ?>
                                                                            <td style="vertical-align:middle;"><?=utf8_encode($rSqlCidade['cidade'])?></td>
                                                                            <? $rSqlEstado = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_estado WHERE uf='".$rSqlCategoria['estado']."' ORDER BY estado")); ?>
                                                                            <td style="vertical-align:middle;"><?= utf8_encode($rSqlEstado['estado']) ?></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <? if(trim($rSqlCategoria['principal'])=="1") { ?>
                                                                                <a href="javascript:void(0);" class="btn-mini ptip_se" title="Endereço Principal"><img src="<?=$link?>template/img/icones_novos/16/destaque-1.png" /></a>
                                                                                <? } else { ?>
                                                                                <a href="javascript:void(0);" onClick="principal_endereco('<?=$rSqlCategoria['id']?>','<?=$modGet?>');" class="btn-mini ptip_se" title="Tornar Principal"><img src="<?=$link?>template/img/icones_novos/16/destaque-0.png" /></a>
                                                                                <? } ?>
                                                                                <a href="javascript:void(0);" onClick="remover_endereco('<?=$rSqlCategoria['id']?>','<?=$modGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
