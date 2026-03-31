        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>

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
                                </script>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <div class="tab-content">

                                            <div class="accordion" id="accordion1">
    
                                                <?
												$qSqlMov = mysql_query("
																		SELECT 
																			mod_adv_intimacao_xml.codigo,
																			mod_adv_intimacao_xml.processo,
																			mod_adv_intimacao_xml.data_xml,
																			mod_adv_intimacao_xml.orgao,
																			mod_adv_intimacao_xml.cidade,
																			mod_adv_intimacao_xml.nome,
																			mod_adv_intimacao_xml.jornal,
																			mod_adv_intimacao_xml.vara,
																			mod_adv_intimacao_xml.pagina,
																			mod_adv_intimacao_xml.texto
																			 
																		FROM 
																			adv_intimacao_xml AS mod_adv_intimacao_xml
																		WHERE 
																			mod_adv_intimacao_xml.stat='1' 
																		ORDER BY 
																			mod_adv_intimacao_xml.data DESC
																		");
												while($rSqlMov = mysql_fetch_array($qSqlMov)) {
												$i++;
													$nIntimacao = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM adv_intimacao WHERE cod='".$rSqlMov['codigo']."'"));
													if($nIntimacao[0]==0) {
                                                ?>
                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_blank" ENCTYPE="multipart/form-data" id="formulario_<?=$rSqlMov['codigo']?>">
                                                    <input type="hidden" name="modulo" value="adv_intimacao_xml" />
                                                    <input type="hidden" name="acaoForm" value="add" />
                                                    <input type="hidden" name="iditem" value="<?=$rSqlMov['id']?>"/>
                                                    <input type="hidden" name="pendente" id="pendente_<?=$rSqlMov['codigo']?>" value="" />
                                                    <input type="hidden" name="cod" id="cod_<?=$rSqlMov['codigo']?>" value="<?=$rSqlMov['codigo']?>" />
                                                    <input type="hidden" name="data_xml" value="<?=$rSqlMov['data_xml']?>" />
                                                    <input type="hidden" name="orgao" value="<?=$rSqlMov['orgao']?>" />
                                                    <input type="hidden" name="cidade" value="<?=$rSqlMov['cidade']?>" />
                                                    <input type="hidden" name="cod_processo" value="<?=$rSqlMov['processo']?>" />
                                                    <input type="hidden" name="nome" value="<?=$rSqlMov['nome']?>" />
                                                    <input type="hidden" name="jornal" value="<?=$rSqlMov['jornal']?>" />
                                                    <input type="hidden" name="vara" value="<?=$rSqlMov['vara']?>" />
                                                    <input type="hidden" name="pagina" value="<?=$rSqlMov['pagina']?>" />
                                                    <textarea name="texto" style="height:150px;display:none;"><?=$rSqlMov['texto']?></textarea>
                                                </form>

                                                <div class="accordion-group">
                                                    <div class="accordion-heading">
                                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$rSqlMov['codigo']?>">
                                                            [<?=$rSqlMov['codigo']?>] <?=$rSqlMov['data_xml']?> - <?=$rSqlMov['orgao']?> - <?=$rSqlMov['cidade']?> - <?=$rSqlMov['processo']?>
                                                        </a>
                                                    </div>
                                                    <div id="collapse<?=$rSqlMov['codigo']?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                        <div class="span12">
                                                            <button class="btn btn-danger btn-mini" onclick="javascript:gerar_intimacao('<?=$rSqlMov['codigo']?>','0');">Criar Tarefas</button>
                                                            <button class="btn btn-success btn-mini" onclick="javascript:gerar_intimacao('<?=$rSqlMov['codigo']?>','2');">Analisada</button>
                                                            <button class="btn-mini" style="background-color:#ff9900;color:#FFF;border:1px solid #ff9900;" onclick="javascript:gerar_intimacao('<?=$rSqlMov['codigo']?>','1');">Em Análise Eduardo</button>
                                                            <button class="btn-mini" style="background-color:#39d11f;color:#FFF;border:1px solid #39d11f;" onclick="javascript:gerar_intimacao('<?=$rSqlMov['codigo']?>','3');">Em Análise Stephany</button>
                                                            <button class="btn-mini" style="background-color:#830202;color:#FFF;border:1px solid #830202;" onclick="javascript:gerar_intimacao('<?=$rSqlMov['codigo']?>','4');">Em Análise Luiz</button>
                                                            <button class="btn-mini" style="background-color:#5BD9A4;color:#FFF;border:1px solid #5BD9A4;" onclick="javascript:gerar_intimacao('<?=$rSqlMov['codigo']?>','5');">Em análise Alexsandra</button>
                                                        </div>
                                                        <b>NOME:</b> <?=$rSqlMov['nome']?><br />
                                                        <b>JORNAL:</b> <?=$rSqlMov['jornal']?><br />
                                                        <b>VARA:</b> <?=$rSqlMov['vara']?><br /><br />
                                                        <b>PÁGINA:</b> <?=$rSqlMov['pagina']?><br /><br />
														<?=$rSqlMov['texto']?><br />
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


                        </div>
                    </div>
                </div>
            </div>
