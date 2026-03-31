                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Número do Processo</th>
                                                                            <th>Nome da Ação</th>
                                                                            <th style="width:110px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
																		$qSqlCategoria = mysql_query("SELECT * FROM adv_processo_syscliente WHERE idsyscliente='".$idsysclienteGet."' ORDER BY data DESC");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
                                                                        <tr>
                                                                            <? $rSqlAdvProcesso = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo WHERE numeroUnico='".$rSqlCategoria['numeroUnico_pai']."'")); ?>
                                                                            <td style="vertical-align:middle;"><?=$rSqlAdvProcesso['cod']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlAdvProcesso['nome_acao']?></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <?
																				$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='adv_processo'"));
																				$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);
																				
																				$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
																				$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];
																				?>
                                                                                <a href="<?=$link?><?=$nomeLimpoUrlModCat?>/<?=$nomeLimpoUrlMod?>/editar/<?=$rSqlAdvProcesso['id']?>/" class="btn-mini ptip_se" title="Visualizar este processo [<?=$rSqlAdvProcesso['cod']?>]"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
