                                                                    <? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome</th>
                                                                            <th style="width:110px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
																		$qSqlCategoria = mysql_query("SELECT * FROM ".$modGet."_syscliente WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
                                                                        <tr>
                                                                            <? $rSqlSyscliente = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$rSqlCategoria['idsyscliente']."'")); ?>
                                                                            <td style="vertical-align:middle;"><?=$rSqlSyscliente['nome']?></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_syscliente_adv_processo('<?=$rSqlCategoria['id']?>','<?=$modGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                                <div class="btn-group">
                                                                                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/syscliente/view.php?idS=<?=$rSqlCategoria['idsyscliente']?>" title="Visualizar dados cliente [<?=$rSqlSyscliente['nome']?>]"><img src="<?=$link?>template/img/icones_novos/16/lupa-0.png" /></a>
                                                                                </div>
                                                                                <div class="btn-group">
                                                                                <?
																				$rSqlUrlMod = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='syscliente'"));
																				$nomeLimpoUrlMod = transformaCaractere($rSqlUrlMod['nome']);
																				
																				$rSqlUrlModCat = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlUrlMod['idsysmod_categoria']."'"));
																				$nomeLimpoUrlModCat = $rSqlUrlModCat['url_amigavel'];
																				?>
                                                                                <a href="<?=$link?><?=$nomeLimpoUrlModCat?>/<?=$nomeLimpoUrlMod?>/editar/<?=$rSqlSyscliente['id']?>/" class="btn-mini ptip_se" title="Editar este cliente [<?=$rSqlSyscliente['nome']?>]"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
