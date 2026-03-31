<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$tarefa = mysql_fetch_array(mysql_query("SELECT * FROM sysagenda WHERE id='".$idGet."'"));
$criador_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$tarefa['criador']."'"));
$concluidor_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$tarefa['concluidor']."'"));

# Gravação do Log
$sysusuLog = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_GET['sysusuS']."'"));
if(trim($sysusuLog['id'])=="" || trim($sysusuLog['id'])=="0") {
	$sysusuLog = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_REQUEST['sysusuS']."'"));
}
$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo_agenda WHERE id='".$idGet."'"));
$logPerfil = "administrador";
$logId = $sysusuLog['id'];
$logAcao = "Visualizou";
$logLocal = "Tarefa";
$logDescricao = "".$sysusuLog['nome']." visualizou o item <b>".$tarefa['nome']."</b> de id <b title=\"adv_processo\">".$tarefa['id']."</b>";
$logData = $data;
gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

?>

        
                            <div class="formSep">

                                <? if(trim($tarefa['concluidor'])=="0" || trim($tarefa['concluidor'])=="") { } else { ?>
                                <div style="float:left;width:100%;">
                                    <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                        <label><b>Concluiu a tarefa</b></label>
                                        <i><?=$concluidor_set['nome']?></i>
                                    </div>
                                </div>
                                <? } ?>

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
                                        <a href="<?=$link?>files/sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

								<? if(trim($tarefa['arquivo_2'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Anexo 2</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo_2'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo_2'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

								<? if(trim($tarefa['arquivo_3'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Anexo 3</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo_3'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo_3'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

								<? if(trim($tarefa['arquivo_4'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Anexo 4</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo_4'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo_4'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

								<? if(trim($tarefa['arquivo_5'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Anexo 5</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/sysagenda/<?=$tarefa['numeroUnico']?>/<?=corrigirAcentuacao($tarefa['arquivo_5'])?>" target="_blank"><?=corrigirAcentuacao($tarefa['arquivo_5'])?></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

                                <div style="float:left;width:100%;">
                                    <label><b>Arquivos em anexo</b></label>
									<?
                                    $qSql = mysql_query("SELECT * FROM sysagenda_galeria WHERE numeroUnico='".$tarefa['numeroUnico']."' ORDER BY ordem");
                                    while($rSql = mysql_fetch_array($qSql)) {
                                    ?>
                                    <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/sysagenda/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>" target="_blank"><? if(strlen($rSql['nome'])>20) { echo substr($rSql['nome'],0,20)."..."; } else { echo $rSql['nome']; } ?></a> <br />
                                    <? } ?>
                                </div>

                                <div style="float:left;width:100%;">
                                    <label><b>Descrição</b></label>
                                    <i><?=$tarefa['texto']?></i>
                                </div>
                            </div>


                            <style>
                            .btn_MH {
								background-color: #179bff;
								padding: 4px 12px;
								margin-bottom: 0;
								font-size: 14px;
								line-height: 20px;
								webkit-border-radius: 4px;
								-moz-border-radius: 4px;
								border-radius: 4px;
								border: 1px solid #179bff;
								color:#FFF;
							}
                            </style>
                            <div class="formSep">
                                <button type="button" onclick="sysagenda_excluir('<?=$idGet?>','<?=$sysusuLog['id']?>');" class="btn btn-danger">Excluir</button>
                                <button type="button" onclick="javascript:window.open('<?=$link?>advocacia/agenda/editar/<?=$idGet?>/','_blank','');" class="btn btn-info">Editar</button>
                                <button type="button" onclick="sysagenda_concluir('<?=$idGet?>','1','<?=$sysusuLog['id']?>');" class="btn btn-success">Marcar como 'Concluída'</button>
                                <button type="button" onclick="sysagenda_concluir('<?=$idGet?>','0','<?=$sysusuLog['id']?>');" class="btn btn-beoro-2">Marcar como 'Não concluída'</button>
                                <button type="button" onclick="sysagenda_concluir('<?=$idGet?>','99','<?=$sysusuLog['id']?>');" class="btn_MH">Marcar como 'Em Análise AM'</button>
                                <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Fechar</button>
                            </div>
