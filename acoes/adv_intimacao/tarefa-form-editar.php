<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = $_GET['modS'];
$numeroUnicoGet = $_GET['numeroUnicoS'];

$tarefa = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao_agenda WHERE id='".$idGet."'"));
?>
                                                                <form name="forms_agenda" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" value="editar-tarefas" />
                                                                    <input type="hidden" name="modulo" value="<?=$modGet?>" />
        
                                                                    <? 
                                                                    $numeroUnicoGerado_tarefa = $tarefa['numeroUnico']; 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" value="<?=$numeroUnicoGerado_tarefa?>">
                                                                    
                                                                    <div class="formSep">
                                                                        <!--
                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label>Somente para o criador?</label>
                                                                                <input type="checkbox" name="somente_criador" <? if(trim($tarefa['somente_criador'])==1) { echo " checked"; } ?> id="somente_criador" class="somente_criador {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Se esta opção estiver setada, somente o criador da tarefa vai conseguir visualizá-la</span>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label>Edição aberta para todos?</label>
                                                                                <input type="checkbox" name="edicao_aberta" <? if(trim($tarefa['edicao_aberta'])==1) { echo " checked"; } ?> id="edicao_aberta" class="edicao_aberta {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Se esta opção estiver setada, todos poderão editar os itens da tarefa</span>
                                                                        </div>
                                                                        -->
            
                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label class="req">Título</label>
                                                                                <input value="<?=$tarefa['nome']?>" style="width:400px;" type="text" name="nome" id="nome_item_editar" placeholder="Digite um título para a tarefa" />
                                                                            </div>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                                <label>Responsável</label>
                                                                                <select id="lista_admin_itens" multiple="multiple">
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlItem['id']?>" <? if(strrpos($tarefa['lista_admin'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <input value="<?=$tarefa['lista_admin']?>" style="width:350px;" type="hidden" name="lista_admin" id="lista_admin" />
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Selecione os responsáveis por esta tarefa</span>
                                                                        </div>
            

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Prazo</label>
                                                                                <div class="input-append date" id="data_fim" data-date-format="dd/mm/yyyy" data-date="<? if(trim($tarefa['data_fim'])==""||trim($tarefa['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($tarefa['data_fim'],"d/m/Y"); } ?>">
                                                                                    <input class="span8" size="16" name="data_fim" value="<? if(trim($tarefa['data_fim'])==""||trim($tarefa['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($tarefa['data_fim'],"d/m/Y"); } ?>" type="text" >
                                                                                    <input name="data_criacao" value="<? if(trim($tarefa['data_fim'])==""||trim($tarefa['data_fim'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($tarefa['data_fim'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" />
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Hora</label>
                                                                                <div class="input-append bootstrap-timepicker">
                                                                                    <input type="text" value="<? if(trim($tarefa['hora_fim'])=="") { } else { echo $tarefa['hora_fim']; } ?>" class="input-small" name="hora_fim" id="hora_fim" >
                                                                                    <span class="add-on">
                                                                                        <i class="icon-time"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Data e Hora que o processo deverá ser iniciado</span>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <label>Imagem</label>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <div class="fileupload-new thumbnail">
                                                                                <? if(trim($tarefa['imagem'])=="") { ?>
                                                                                <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                                <? } else { ?>
                                                                                <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$modGet?>/<?=$tarefa['numeroUnico']?>/<?=$tarefa['imagem']?>"><img style="width:50px;" id="arquivo-atual-imagem" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$tarefa['numeroUnico']?>/<?=$tarefa['imagem']?>" alt=""></a>
                                                                                <? } ?>
                                                                                </div>
                                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                                <? if(trim($tarefa['imagem'])=="") { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span class="fileupload-new">Selecionar arquivo</span>
                                                                                    <span class="fileupload-exists">Alterar</span>
                                                                                    <input name="imagem" type="file">
                                                                                </span>
                                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                                <? } else { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span>Alterar</span>
                                                                                    <input name="imagem" type="file">
                                                                                </span>
                                                                                <a href="javascript:void(0);" onclick="remover_imagem('<?=$tarefa['id']?>','<?=$modGet?>','imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                                <? } ?>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;width:100%;">
                                                                            <label class="req">Descrição</label>
                                                                            <textarea name="descricao" id="descricao_item_editar" class="span12" style="height:150px;"><?=$tarefa['descricao']?></textarea>
                                                                        </div>
                                                                        <div style="float:left;width:100%;">
                                                                            <button type="button" onclick="salvar_edita_tarefa_intimacao('<?=$mod?>','<?=$numeroUnicoGet?>');" class="btn btn-success">Salvar Alterações</button>
                                                                            <button type="button" onclick="cancela_edita_tarefa_intimacao();" class="btn btn-warning">Cancelar</button>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                        <div id="lista_syscronograma_itens_editar" style="width:100%;float:left;">
                                                                            <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width:60px">Arquivo</th>
                                                                                    <th>Responsáveis</th>
                                                                                    <th>Título</th>
                                                                                    <th>Descrição</th>
                                                                                    <th style="width:130px;">Prazo</th>
                                                                                    <th style="width:90px;">Ações</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?
                                                                                $qSqlCategoria = mysql_query("SELECT * FROM ".$mod."_agenda WHERE numeroUnico_pai='".$numeroUnicoGerado."' ORDER BY data_fim DESC, hora_fim DESC");
                                                                                while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
																					if(trim($rSqlCategoria['criador'])==$sysusu['id']) {
																						$mostra_intimacao_agenda = "1";
																					} else {
																						if(strrpos($rSqlCategoria['lista_admin'],"|".$sysusu['id']."|") === false) {
																							$mostra_intimacao_agenda = "0";
																						} else {
																							$mostra_intimacao_agenda = "1";
																						}
																					}
																					
																					if(trim($mostra_intimacao_agenda)=="1") {
                                                                                ?>
                                                                                <tr>
                                                                                    <td style="width:60px">
                                                                                        <? if(trim($rSqlCategoria['imagem'])=="") {  } else { ?>
                                                                                        <?
                                                                                        $extensao = $rSqlCategoria['imagem'];
                                                                                        $extensao = substr($extensao, -4);
                                                                                        if($extensao[0] == '.'){
                                                                                            $extensao = substr($extensao, -3);
                                                                                        }
                                                                                        $extensao = strtolower($extensao);
                                                                                        ?>
                                                                                        <? if(trim($extensao)=="jpg"||trim($extensao)=="jpeg"||trim($extensao)=="gif"||trim($extensao)=="bmp"||trim($extensao)=="png") { ?>
                                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>" alt="<?=$rSqlCategoria['nome']?>"/></a>
                                                                                        <? } else { ?>
                                                                                        <a class="btn-mini ptip_se" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>"><img src="<?=$link?>template/img/icones_novos/16/download.png" /></a>
                                                                                        <? } ?>
                                                                                        <? } ?>
                                                                                    </td> 
                                                                                    <td style="vertical-align:middle;">
                                                                                    <?
                                                                                    $listaCategoria = $rSqlCategoria['lista_admin'];
                                                                                    $listaCategoria = str_replace("||","','",$listaCategoria);
                                                                                    $listaCategoria = str_replace("|","'",$listaCategoria);
                                                                                    if(trim($listaCategoria)=="") { } else {
                                                                                        $printCategoria = "";
                                                                                        $qSqlCat = mysql_query("SELECT * FROM sysusu WHERE id IN(".$listaCategoria.") ORDER BY nome");
                                                                                        while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                                            if(trim($printCategoria)=="") {
                                                                                                if(trim($rSqlCategoria['edicao_aberta'])=="0"||trim($rSqlCategoria['edicao_aberta'])=="") {
																									if(trim($rSqlCategoria['criador'])==$sysusu['id']) {
																										$printCategoria = "<a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome']."";
																									} else {
																										$printCategoria = "- ".$rSqlCat['nome']."";
																									}
																								} else {
																									$printCategoria = "<a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome']."";
																								}
                                                                                            } else {
                                                                                                if(trim($rSqlCategoria['edicao_aberta'])=="0"||trim($rSqlCategoria['edicao_aberta'])=="") {
																									if(trim($rSqlCategoria['criador'])==$sysusu['id']) {
																										$printCategoria = $printCategoria."<br><a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome'];
																									} else {
																										$printCategoria = $printCategoria."<br>- ".$rSqlCat['nome'];
																									}
																								} else {
																									$printCategoria = $printCategoria."<br><a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome'];
																								}
                                                                                            }
                                                                                        }
                                                                                        echo $printCategoria;
                                                                                    }
                                                                                    ?>
                                                                                    </td>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['descricao']?></td>
                                                                                    <td style="vertical-align:middle;"><? if(trim($rSqlCategoria['data_fim'])=="0000-00-00") { } else { ajustaData($rSqlCategoria['data_fim'],"d-m-Y"); } ?><?=substr($rSqlCategoria['hora_fim'],0,5)?></td>
                                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                                        <div class="btn-group">
																							<a href="javascript:void(0);" <? if(trim($rSqlCategoria['edicao_aberta'])=="1"||trim($rSqlCategoria['criador'])==$sysusu['id']) { ?>onclick="edita_tarefa_intimacao('<?=$rSqlCategoria['id']?>','<?=$mod?>','<?=$numeroUnicoGerado?>');"<? } else { ?> onclick="javascript:alert('Você não tem permissão para editar esta tarefa');"<? } ?> class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a>
																							
																						<? if(trim($rSqlCategoria['somente_criador'])=="1") { ?>
                                                                                            <a href="javascript:void(0);" <? if(trim($rSqlCategoria['criador'])==$sysusu['id']) { ?>onclick="muda_somente_criador('<?=$rSqlCategoria['id']?>','0');"<? } ?> class="btn-mini ptip_se" title="Visível somente para o criador"><img src="<?=$link?>template/img/icones_novos/16/eye-0.png" /></a>
                                                                                        <? } else { ?>
                                                                                            <a href="javascript:void(0);" <? if(trim($rSqlCategoria['criador'])==$sysusu['id']) { ?>onclick="muda_somente_criador('<?=$rSqlCategoria['id']?>','1');"<? } ?> class="btn-mini ptip_se" title="Visível para todos os responsáveis"><img src="<?=$link?>template/img/icones_novos/16/eye-1.png" /></a>
                                                                                        <? } ?>

                                                                                        <a href="javascript:void(0);" <? if(trim($rSqlCategoria['criador'])==$sysusu['id']) { ?>onClick="remover_tarefa_intimacao('<?=$rSqlCategoria['id']?>');"<? } ?> class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <? } } ?>
                                                                            </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
        
                                                                </form>


