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
												$data_hoje = date("Y-m-d", strtotime("-7 days", strtotime(date("Y-m-d")))); //Hoje - 7 dias
												$i=0;
												#echo "http://www.publicacoesonline.com.br/index_get_xml_publicacoes.php?usuario=-19770 SC&senha=BTAGX&enviadas=T&dataPublicacaoInicio=".$data_hoje."";
												#echo "<!-- http://www.publicacoesonline.com.br/index_get_xml_publicacoes.php?usuario=-19770 SC&senha=BTAGX&enviadas=T&dataPublicacaoInicio=".$data_hoje." -->";
												$xml = simplexml_load_file("http://www.publicacoesonline.com.br/index_get_xml_publicacoes.php?usuario=-19770 SC&senha=BTAGX&enviadas=T&dataPublicacaoInicio=".$data_hoje."");
												#var_dump($xml);
												foreach($xml->row as $processo) { 
												$i++;
													$nIntimacao = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM adv_intimacao WHERE cod='".$processo->codigo."'"));
													if($nIntimacao[0]==0) {
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
                                                    <div class="accordion-heading">
                                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$processo->codigo?>">
                                                            [<?=$processo->codigo?>] <?=$processo->data?> - <?=$processo->orgao?> - <?=$processo->cidade?> - <?=$processo->processo?>
                                                        </a>
                                                    </div>
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


                        </div>
                    </div>
                </div>
            </div>
