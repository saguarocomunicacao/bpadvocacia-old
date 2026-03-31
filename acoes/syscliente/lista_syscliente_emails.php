                                                                    <? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:50%;">Nome</th>
                                                                            <th style="width:50%;">E-mail</th>
                                                                            <th style="width:30px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $qSqlCategoria = mysql_query("SELECT * FROM ".$modGet."_emails WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
                                                                        <tr id="lista_categoria_<?=$rSqlItem['id']?>">
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['email']?></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_emails('<?=$rSqlCategoria['id']?>','<?=$modGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
