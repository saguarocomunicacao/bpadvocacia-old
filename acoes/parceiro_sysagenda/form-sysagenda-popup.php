<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$sysusuLog    = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_GET['sysusuS']."'"));

$tarefa = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_sysagenda WHERE id='".$idGet."'"));
$criador_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$tarefa['criador']."'"));
?>

        
                            <div class="formSep">

                                <div style="float:left;width:100%;">
                                    <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                        <label><b>Criada por</b></label>
                                        <i><?=$criador_set['nome']?></i>
                                    </div>
                                </div>

                                <div style="float:left;width:100%;">
                                    <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                        <label><b>Título</b></label>
                                        <i><?=$tarefa['nome']?></i>
                                    </div>
                                </div>

                                <div style="float:left;width:100%;">
                                    <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                        <label><b>Responsáveis</b></label>
										<?
                                        $listaCategoria = $tarefa['lista_admin'];
                                        $listaCategoria = str_replace("||","','",$listaCategoria);
                                        $listaCategoria = str_replace("|","'",$listaCategoria);
                                        if(trim($listaCategoria)=="") { } else {
                                            $printCategoria = "";
                                            $qSqlCat = mysql_query("SELECT * FROM sysusu WHERE id IN(".$listaCategoria.") ORDER BY nome");
                                            while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                if(trim($printCategoria)=="") {
                                                    $printCategoria = "- ".$rSqlCat['nome']."";
                                                } else {
                                                    $printCategoria = $printCategoria."<br>- ".$rSqlCat['nome'];
                                                }
                                            }
                                            echo "<i>".$printCategoria."</i>";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div style="float:left;width:100%;">
                                    <div style="float:left;margin-right:10px;">
                                        <label><b>Começa em</b></label>
                                        <i><? if(trim($tarefa['data_inicio'])=="0000-00-00") { } else { ajustaData($tarefa['data_inicio'],"d-m-Y"); } ?> <?=substr($tarefa['hora_inicio'],0,5)?></i>
                                    </div>
                                </div>

                                <div style="float:left;width:100%;">
                                    <div style="float:left;margin-right:10px;">
                                        <label><b>Termina em</b></label>
                                        <i><? if(trim($tarefa['data_fim'])=="0000-00-00") { } else { ajustaData($tarefa['data_fim'],"d-m-Y"); } ?> <?=substr($tarefa['hora_fim'],0,5)?></i>
                                    </div>
                                </div>

								<? if(trim($tarefa['arquivo'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Anexo 1</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/parceiro_sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

								<? if(trim($tarefa['arquivo_2'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Anexo 2</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/parceiro_sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo_2'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo_2'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

								<? if(trim($tarefa['arquivo_3'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Anexo 3</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/parceiro_sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo_3'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo_3'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

								<? if(trim($tarefa['arquivo_4'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Anexo 4</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/parceiro_sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo_4'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo_4'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

								<? if(trim($tarefa['arquivo_5'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Anexo 5</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/parceiro_sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo_5'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo_5'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

                                <div style="float:left;width:100%;">
                                    <label><b>Descrição</b></label>
                                    <i><?=$tarefa['texto']?></i>
                                </div>
                            </div>


                            <div class="formSep">
                                <button type="button" onclick="parceiro_sysagenda_excluir('<?=$idGet?>');" class="btn btn-danger">Excluir</button>
                                <button type="button" onclick="javascript:window.open('<?=$link?>advocacia/compromissos/editar/<?=$idGet?>/','_self','');" class="btn btn-info">Editar</button>
                                <button type="button" onclick="parceiro_sysagenda_concluir('<?=$idGet?>','1');" class="btn btn-success">Marcar como 'Concluída'</button>
                                <button type="button" onclick="parceiro_sysagenda_concluir('<?=$idGet?>','0');" class="btn btn-beoro-2">Marcar como 'Não concluída'</button>
                                <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Fechar</button>
                            </div>
