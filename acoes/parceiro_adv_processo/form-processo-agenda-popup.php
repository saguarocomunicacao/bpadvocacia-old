<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$tarefa = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_agenda WHERE id='".$idGet."'"));
$parceiro_adv_processo_set = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo WHERE numeroUnico='".$tarefa['numeroUnico_pai']."'"));
$criador_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$tarefa['criador']."'"));
$concluidor_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$tarefa['concluidor']."'"));
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
                                        <label><b>N° Processo</b></label>
                                        <i><?=$parceiro_adv_processo_set['cod']?></i>
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
                                        <label><b>Prazo</b></label>
                                        <i><? if(trim($tarefa['data_fim'])=="0000-00-00") { } else { ajustaData($tarefa['data_fim'],"d-m-Y"); } ?></i>
                                    </div>
                                    <div style="float:left;margin-right:10px;">
                                        <label><b>Hora</b></label>
                                        <i><?=substr($tarefa['hora_fim'],0,5)?></i>
                                    </div>
                                </div>

								<? if(trim($tarefa['imagem'])=="") {  } else { ?>
                                <div style="float:left;width:100%;">
                                    <label><b>Arquivo, Imagem ou Documento</b></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail">
                                        <a href="<?=$link?>files/parceiro_adv_processo_agenda/<?=$tarefa['numeroUnico']?>/<?=$tarefa['imagem']?>"><img style="width:50px;" id="arquivo-atual-imagem" src="<?=$link?>files/parceiro_adv_processo_agenda/<?=$tarefa['numeroUnico']?>/<?=$tarefa['imagem']?>" alt=""></a>
                                        </div>
                                    </div>
                                </div>
								<? } ?>

                                <div style="float:left;width:100%;">
                                    <label><b>Descrição</b></label>
                                    <i><?=$tarefa['descricao']?></i>
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
                                <button type="button" onclick="processo_agenda_excluir('<?=$idGet?>');" class="btn btn-danger">Excluir tarefa</button>
                                <button type="button" onclick="javascript:window.open('<?=$link?>advocacia/todos-os-processos/editar/<?=$parceiro_adv_processo_set['id']?>/tarefas/','_self','');" class="btn btn-info">Editar</button>
                                <button type="button" onclick="processo_agenda_concluir('<?=$idGet?>','1');" class="btn btn-success">Marcar como concluída</button>
                                <button type="button" onclick="processo_agenda_concluir('<?=$idGet?>','0');" class="btn btn-beoro-2">Marcar como 'Não concluída'</button>
                                <button type="button" onclick="processo_agenda_concluir('<?=$idGet?>','99');" class="btn_MH">Marcar como 'Em Análise AM'</button>
                                <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Fechar</button>
                            </div>
