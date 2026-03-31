                                                                    <? if(trim($numeroUnicoGet)=="") { } else { ?>
                                                                    <table class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome</th>
                                                                            <th>Upload de Arquivo</th>
                                                                            <th>Excluir Arquivo</th>
                                                                            <th>Renomear Arquivo</th>
                                                                            <th>Download de Arquivo</th>
                                                                            <th style="width:70px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $qSqlPerm = mysql_query("SELECT * FROM sysmidiaperm WHERE numeroUnico='".$numeroUnicoGet."' ORDER BY idsysusu");
                                                                        while($rSqlPerm = mysql_fetch_array($qSqlPerm)) {
																			$rSqlSysusu = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSqlPerm['idsysusu']."' "));
                                                                        ?>
                                                                        <tr>
                                                                            <td style="vertical-align:middle;"><?=$rSqlSysusu['nome']?></td>
                                                                            <td style="vertical-align:middle;"><? if(trim($rSqlPerm['upload_arquivo'])==0) { echo "não"; } else { echo "sim"; } ?></td>
                                                                            <td style="vertical-align:middle;"><? if(trim($rSqlPerm['excluir_arquivo'])==0) { echo "não"; } else { echo "sim"; } ?></td>
                                                                            <td style="vertical-align:middle;"><? if(trim($rSqlPerm['renomear_arquivo'])==0) { echo "não"; } else { echo "sim"; } ?></td>
                                                                            <td style="vertical-align:middle;"><? if(trim($rSqlPerm['baixar_arquivo'])==0) { echo "não"; } else { echo "sim"; } ?></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_usuario_perm_arquivo('<?=$rSqlPerm['id']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
                                                                    <? } ?>
