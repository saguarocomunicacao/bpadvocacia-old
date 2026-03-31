        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>

                            <? if($sysusu['idsysgrupousuario']=="1" || $sysusu['id']=="58" || $sysusu['id']=="271") { ?>
                            <ul id="pageNav" style="margin-top:10px;background: rgba(0,0,0,.08);">
                                <li style="padding:6px 8px;">Ao selecionar uma ação abaixo, você vai realizar a mesma para todas as intimações selecionadas ao lado!</li>
                                <li style="padding:6px 8px;">
                                	<select style="width:100%;" id="acao_setada">
                                    	<option value="">Selecionar uma ação</option>
                                        <option value="0">Ainda Pendente</option>
                                        <option value="1">Em Análise Stephany - JF</option>
                                        <option value="2">Analisada</option>
                                        <option value="3">Em Análise Stephany</option>
                                        <option value="4">Em Análise Luiz</option>
                                        <option value="5">Em análise Alexsandra</option>
                                    </select>
                                </li>
                                <li style="padding:6px 8px;">
                                    <button class="btn-mini" id="btn_realizar" style="background-color:#5BD9A4;color:#FFF;border:1px solid #5BD9A4;display:block;" onclick="javascript:realizar_operacao_gerar_intimacao();">Realizar Operação</button>
                                    <div id="preloader-categoria" style="width:100%;display:none;margin-top:5px;">
                                        <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                        <div>Realizando Operação</div>
                                    </div>
                                </li>
                            </ul>
                            <? } ?>
                            
							<? include("./acoes/sysgeral/menu-intimacao.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <script>
								$(document).ready(function() {
									
									// accordion show/hide
									beoro_accordion.init();
									
								});

								//* accordion show/hide
								beoro_accordion = {
									init: function() {
										if($('.accordion').length) {
											$('.accordion').each(function() {
												$(this).find('.accordion-group').each(function(){
													$(this).find('.accordion-toggle').prepend('<i class="icon-chevron-left"/>')
													$(this).find('.accordion-body').filter('.in').prev('.accordion-heading').find('.accordion-toggle').addClass('acc-in').children('i').toggleClass('icon-chevron-left icon-chevron-down');
													
													$(this).find('.accordion-body').on('show', function(option) {
														$(this).find('.accordion-toggle').removeClass('acc-in');
														$(option.target).prev('.accordion-heading').find('.accordion-toggle').addClass('acc-in').children('i').removeClass('icon-chevron-left').addClass('icon-chevron-down');
													});
													$(this).find('.accordion-body').on('hide', function(option) {
														$(option.target).prev('.accordion-heading').find('.accordion-toggle').removeClass('acc-in').children('i').addClass('icon-chevron-left').removeClass('icon-chevron-down');
													});
													
												});
											})
										}
									}
								};
								function selecionar_intimacao(codSend) {
									if($("#selecionado_"+codSend+"").val()=="0") {
										$("#lista_checkboxes").val("|"+codSend+"|"+$("#lista_checkboxes").val()+"");
										$("#aba_"+codSend+"").css({ "background-color": "#8bee7a"});
										$("#selecionado_"+codSend+"").val("1");
										$("#btn_0_"+codSend+"").hide();
										$("#btn_1_"+codSend+"").show();
									} else {
										var val = $("#lista_checkboxes").val();
										$("#lista_checkboxes").val(val.replace("|"+codSend+"|",""));
										$("#aba_"+codSend+"").css({ "background-color": "#f7f7f7"});
										$("#selecionado_"+codSend+"").val("0");
										$("#btn_1_"+codSend+"").hide();
										$("#btn_0_"+codSend+"").show();
									}
								}
								function realizar_operacao_gerar_intimacao() {
									if($.trim($("#acao_setada").val())=="") {
										alert("Você deve selecionar uma ação para que seja realizada a operação!");
									} else {
										if($.trim($("#lista_checkboxes").val())=="") {
											alert("Você deve selecionar pelo menos 1 intimação para que seja realizada a operação!");
										} else {
											$("#btn_realizar").hide();
											$("#preloader-categoria").fadeIn();
											$("#acao_definida").val(""+$("#acao_setada").val()+"");
											$("#lista_selecionados").val(""+$("#lista_checkboxes").val()+"");
											$("#formulario_selecionados").submit();
										}
									}
								}

								document.addEventListener("DOMContentLoaded", () => {
									$("#preloader_conteudo").fadeOut();
									$("#accordion1").fadeIn();
								});
                                </script>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <div class="tab-content">

                                            <div id="preloader_conteudo" style="width:100%;float:left;margin-top:5px;text-align:center;display:flex;justify-content:center;">
                                                <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:-2px;" />
                                                <div style="float:left;">CARREGANDO CONTEÚDO</div>
                                            </div>

                                            <div class="accordion" id="accordion1" style="display:none;">
    
                                                <input type="hidden" id="lista_checkboxes" value="" />
                                                <?
												$rDataCode = array();
												$rDataCarrinho = array();

												$data_hoje = date("Y-m-d", strtotime("-".$sysconfig['dias_de_atualizacao']." days", strtotime(date("Y-m-d")))); //Hoje - 7 dias
												$i=0;
												#echo "http://www.publicacoesonline.com.br/index_get_xml_publicacoes.php?usuario=-19770 SC&senha=BTAGX&enviadas=T&dataPublicacaoInicio=".$data_hoje."";
												#echo "<!-- http://www.publicacoesonline.com.br/index_get_xml_publicacoes.php?usuario=-19770 SC&senha=BTAGX&enviadas=T&dataPublicacaoInicio=".$data_hoje." -->";
												$xml = simplexml_load_file("http://www.publicacoesonline.com.br/index_get_xml_publicacoes.php?usuario=-19770 SC&senha=BTAGX&enviadas=T&dataPublicacaoInicio=".$data_hoje."");
												#var_dump($xml);
												foreach($xml->row as $processo) { 
													$i++;
													$nIntimacao = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM adv_intimacao WHERE cod='".$processo->codigo."'"));
													if($sysusu['id']=="1") {
														if($i<11) {
															$mostra="1";
														} else {
															$mostra="0";
														}
													} else {
														if($nIntimacao[0]==0) {
															$mostra="1";
														} else {
															$mostra="0";
														}
													}
													if($mostra=="1") {

														
														#$rDataCarrinho[] = $processo;
														
														$codigo_processo = "".$processo->codigo."";
														
														$rDataCode[] = "".$codigo_processo."";

														$rDataCarrinho["".$codigo_processo."_cod"] = "".$codigo_processo."";
														$rDataCarrinho["".$codigo_processo."_data_xml"] = "".$processo->data."";
														$rDataCarrinho["".$codigo_processo."_orgao"] = "".$processo->orgao."";
														$rDataCarrinho["".$codigo_processo."_cidade"] = "".$processo->cidade."";
														$rDataCarrinho["".$codigo_processo."_cod_processo"] = "".$processo->processo."";
														$rDataCarrinho["".$codigo_processo."_nome"] = "".$processo->nome."";
														$rDataCarrinho["".$codigo_processo."_jornal"] = "".$processo->jornal."";
														$rDataCarrinho["".$codigo_processo."_vara"] = "".$processo->vara."";
														$rDataCarrinho["".$codigo_processo."_pagina"] = "".$processo->pagina."";
														$rDataCarrinho["".$codigo_processo."_texto"] = "".$processo->texto."";
                                                ?>
                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_blank" ENCTYPE="multipart/form-data" id="formulario_<?=$processo->codigo?>">
                                                    <input type="hidden" name="modulo" value="adv_intimacao_xml" />
                                                    <input type="hidden" name="acaoForm" value="add" />
                                                    <input type="hidden" name="pendente" id="pendente_<?=$processo->codigo?>" value="" />
                                                    <input type="hidden" name="cod" id="cod_<?=$processo->codigo?>" value="<?=$processo->codigo?>" />
                                                    <input type="hidden" name="data_xml" value="<?=$processo->data?>" />
                                                    <input type="hidden" name="orgao" value="<?=$processo->orgao?>" />
                                                    <input type="hidden" name="cidade" value="<?=$processo->cidade?>" />
                                                    <input type="hidden" name="cod_processo" value="<?=$processo->processo?>" />
                                                    <input type="hidden" name="nome" value="<?=$processo->nome?>" />
                                                    <input type="hidden" name="jornal" value="<?=$processo->jornal?>" />
                                                    <input type="hidden" name="vara" value="<?=$processo->vara?>" />
                                                    <input type="hidden" name="pagina" value="<?=$processo->pagina?>" />
                                                    <textarea name="texto" style="height:150px;display:none;"><?=$processo->texto?></textarea>
                                                </form>

                                                <div class="accordion-group">
                                                    <? if($sysusu['id']=="1" || $sysusu['id']=="51" || $sysusu['id']=="58" || $sysusu['id']=="271") { ?>
                                                    <div class="accordion-heading">
                                                        <input type="hidden" id="selecionado_<?=$processo->codigo?>" value="0" />
                                                        <button id="btn_0_<?=$processo->codigo?>" class="btn btn-success btn-mini" onclick="javascript:selecionar_intimacao('<?=$processo->codigo?>');" 
                                                        	style="position: absolute;margin-top: 7px;margin-left: 7px;display:block;">Selecionar</button>

                                                        <button id="btn_1_<?=$processo->codigo?>" class="btn btn-danger btn-mini" onclick="javascript:selecionar_intimacao('<?=$processo->codigo?>');" 
                                                        	style="position: absolute;margin-top: 7px;margin-left: 7px;display:none;">Desmarcar</button>


                                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$processo->codigo?>" id="aba_<?=$processo->codigo?>" style="padding-left: 80px;">
                                                            [<?=$processo->codigo?>] <?=$processo->data?> - <?=$processo->orgao?> - <?=$processo->cidade?> - <?=$processo->processo?>
                                                        </a>
                                                    </div>
                                                    <? } else { ?>
                                                    <div class="accordion-heading">
                                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$processo->codigo?>">
                                                            [<?=$processo->codigo?>] <?=$processo->data?> - <?=$processo->orgao?> - <?=$processo->cidade?> - <?=$processo->processo?>
                                                        </a>
                                                    </div>
                                                    <? } ?> 
                                                    <div id="collapse<?=$processo->codigo?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                        <div class="span12">
                                                            <button class="btn btn-danger btn-mini" onclick="javascript:gerar_intimacao('<?=$processo->codigo?>','0');">Criar Tarefas</button>
                                                            <button class="btn btn-success btn-mini" onclick="javascript:gerar_intimacao('<?=$processo->codigo?>','2');">Analisada</button>
                                                            <button class="btn-mini" style="background-color:#ff9900;color:#FFF;border:1px solid #ff9900;" onclick="javascript:gerar_intimacao('<?=$processo->codigo?>','1');">Em Análise Eduardo</button>
                                                            <button class="btn-mini" style="background-color:#39d11f;color:#FFF;border:1px solid #39d11f;" onclick="javascript:gerar_intimacao('<?=$processo->codigo?>','3');">Em Análise Stephany</button>
                                                            <button class="btn-mini" style="background-color:#830202;color:#FFF;border:1px solid #830202;" onclick="javascript:gerar_intimacao('<?=$processo->codigo?>','4');">Em Análise Luiz</button>
                                                            <button class="btn-mini" style="background-color:#5BD9A4;color:#FFF;border:1px solid #5BD9A4;" onclick="javascript:gerar_intimacao('<?=$processo->codigo?>','5');">Em análise Alexsandra</button>
                                                        </div>
                                                        <b>NOME:</b> <?=$processo->nome?><br />
                                                        <b>JORNAL:</b> <?=$processo->jornal?><br />
                                                        <b>VARA:</b> <?=$processo->vara?><br /><br />
                                                        <b>PÁGINA:</b> <?=$processo->pagina?><br /><br />
														<?=$processo->texto?><br />
                                                        </div>
                                                    </div>
                                                </div>
                                                <? } } ?>
                                                
    
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>

								<?
								if($sysusu['idsysgrupousuario']=="1" || $sysusu['id']=="58" || $sysusu['id']=="271") {
									$campos_form = "";
									$campos_form .= "<form name=\"forms\" method=\"post\" action=\"".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/\" target=\"_self\" ENCTYPE=\"multipart/form-data\" id=\"formulario_selecionados\">";
									$campos_form .= "	<input type=\"hidden\" name=\"modulo\" value=\"adv_intimacao_xml\" />";
									$campos_form .= "	<input type=\"hidden\" name=\"acaoForm\" value=\"add_selecionados\" />";
									$campos_form .= "	<input type=\"hidden\" name=\"ids_selecionados\" id=\"lista_selecionados\" value=\"\" />";
									$campos_form .= "	<input type=\"hidden\" name=\"acao_definida\" id=\"acao_definida\" value=\"\" />";
									for ($row = 0; $row < count($rDataCode); $row++) {
										$rSqlCarrinho = $rDataCarrinho[$row];
										
										$cod = $rDataCode[$row];
	
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_cod\" value=\"".$cod."\" />";
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_cod_processo\" value=\"".$rDataCarrinho["".$cod."_cod_processo"]."\" />";
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_data_xml\" value=\"".$rDataCarrinho["".$cod."_data_xml"]."\" />";
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_orgao\" value=\"".$rDataCarrinho["".$cod."_orgao"]."\" />";
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_cidade\" value=\"".$rDataCarrinho["".$cod."_cidade"]."\" />";
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_nome\" value=\"".$rDataCarrinho["".$cod."_nome"]."\" />";
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_jornal\" value=\"".$rDataCarrinho["".$cod."_jornal"]."\" />";
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_vara\" value=\"".$rDataCarrinho["".$cod."_vara"]."\" />";
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_pagina\" value=\"".$rDataCarrinho["".$cod."_pagina"]."\" />";
										$campos_form .= "<textarea name=\"".$cod."_texto\" style=\"height:150px;display:none;\">".$rDataCarrinho["".$cod."_texto"]."</textarea>";
										$campos_form .= "<input type=\"hidden\" name=\"".$cod."_pendente\" value=\"\" />";
										
									}
									$campos_form .= "</form>";
									echo "".$campos_form."";
								}
                                ?>


                        </div>
                    </div>
                </div>
            </div>
