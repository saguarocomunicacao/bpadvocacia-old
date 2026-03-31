                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:150px;">Ordem</th>
                                                                            <th>Nome</th>
                                                                            <th>Cor</th>
                                                                            <th style="width:70px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
																		if(trim($criadorGet)=="") { $criadorGet = $criadorSet; } else { $criadorGet = $criadorGet; }
																		
                                                                        $qSqlCategoria = mysql_query("SELECT * FROM sysagenda_categoria WHERE criador='".$criadorGet."' ORDER BY ordem");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
                                                                        <tr id="lista_categoria_<?=$rSqlCategoria['id']?>">
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['ordem']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                            <td style="vertical-align:middle;"><div style="width:20px;height:20px;background-color:#<?=$rSqlCategoria['cor']?>;float:left;margin-right:10px;"></div> #<?=$rSqlCategoria['cor']?></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_sysagenda_categoria('<?=$rSqlCategoria['id']?>','<?=$criadorGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
																				<? if(trim($rSqlCategoria['stat'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_sysagenda_categoria('<?=$rSqlCategoria['id']?>','<?=$criadorGet?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_sysagenda_categoria('<?=$rSqlCategoria['id']?>','<?=$criadorGet?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                                <? } ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
