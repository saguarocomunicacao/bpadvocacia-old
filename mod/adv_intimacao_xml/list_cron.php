        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>

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
								
								function gerar_intimacao_nova(codSend,acaoSend) {
									$("#lista_checkboxes").val("|"+codSend+"|");
									$("#aba_"+codSend+"").css({ "background-color": "#8bee7a"});
									$("#selecionado_"+codSend+"").val("1");
									$("#btn_0_"+codSend+"").hide();
									$("#btn_1_"+codSend+"").show();
									$("#acao_definida").val(""+acaoSend+"");
									$("#formulario_selecionados").submit();
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
    
												<?
												$campos_form = "";
												$campos_form .= "<form name=\"forms\" method=\"post\" action=\"".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/\" target=\"_self\" ENCTYPE=\"multipart/form-data\" id=\"formulario_selecionados\">";
												$campos_form .= "	<input type=\"hidden\" name=\"modulo\" value=\"adv_intimacao_xml\" />";
												$campos_form .= "	<input type=\"hidden\" name=\"acaoForm\" value=\"add_selecionados_cron\" />";
												$campos_form .= "	<input type=\"hidden\" name=\"ids_selecionados\" id=\"lista_selecionados\" value=\"\" />";
												$campos_form .= "	<input type=\"hidden\" name=\"acao_definida\" id=\"acao_definida\" value=\"\" />";
												$campos_form .= "</form>";
												echo "".$campos_form."";
                                                ?>
                
                                                <input type="hidden" id="lista_checkboxes" value="" />
                                                <?
												$qSqlMov = mysql_query("
																		SELECT 
																			mod_adv_intimacao.id,
																			mod_adv_intimacao.numeroUnico,
																			mod_adv_intimacao.cod,
																			mod_adv_intimacao.cod_processo,
																			mod_adv_intimacao.data_xml,
																			mod_adv_intimacao.orgao,
																			mod_adv_intimacao.cidade,
																			mod_adv_intimacao.nome,
																			mod_adv_intimacao.jornal,
																			mod_adv_intimacao.vara,
																			mod_adv_intimacao.pagina,
																			mod_adv_intimacao.texto,
																			mod_adv_intimacao.pendente,
																			mod_adv_intimacao.stat,
																			mod_adv_intimacao.data,
																			mod_adv_intimacao.dataModificacao
																		FROM 
																			adv_intimacao_xml AS mod_adv_intimacao
																		WHERE 
																			mod_adv_intimacao.stat='99' 
																		ORDER BY 
																			mod_adv_intimacao.data DESC
																		");
												while($rSqlMov = mysql_fetch_array($qSqlMov)) {
													$_SESSION['intimaca_'.$rSqlMov['id'].''] = $rSqlMov;
													$i++;
                                                ?>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">
                                                        <input type="hidden" id="selecionado_<?=$rSqlMov['id']?>" value="0" />
                                                        <button id="btn_0_<?=$rSqlMov['id']?>" class="btn btn-success btn-mini" onclick="javascript:selecionar_intimacao('<?=$rSqlMov['id']?>');" 
                                                        	style="position: absolute;margin-top: 7px;margin-left: 7px;display:block;">Selecionar</button>

                                                        <button id="btn_1_<?=$rSqlMov['id']?>" class="btn btn-danger btn-mini" onclick="javascript:selecionar_intimacao('<?=$rSqlMov['id']?>');" 
                                                        	style="position: absolute;margin-top: 7px;margin-left: 7px;display:none;">Desmarcar</button>


                                                        <!--<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$rSqlMov['id']?>" id="aba_<?=$rSqlMov['id']?>" style="padding-left: 80px;">-->
                                                        <a class="accordion-toggle" id="aba_<?=$rSqlMov['id']?>" style="padding-left: 80px;">
                                                            [<?=$rSqlMov['cod']?>] <?=$rSqlMov['data_xml']?> - <?=$rSqlMov['orgao']?> - <?=$rSqlMov['cidade']?> - <?=$rSqlMov['cod_processo']?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <? } ?>
    
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>

                        </div>
                    </div>
                </div>
            </div>
