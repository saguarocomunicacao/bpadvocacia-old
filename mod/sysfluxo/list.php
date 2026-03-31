        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_relatorio">Fluxo de Caixa</a></li><? } ?>
                                            </ul>
											<script>
                                              $(document).ready(function() {
												//* datepicker
												beoro_datepicker.init();
                                            });

											//* datepicker
											beoro_datepicker = {
												init: function() {
													if($('#data_start').length) {
														$('#data_start').datepicker()
													}
													if($('#data_end').length) {
														$('#data_end').datepicker()
													}
												}
											};
                                            </script>
                                            <div class="tab-content">
                                                

                                                <div id="tb1_lista" class="tab-pane active">

                                                    <?
													$mesAtual = date("m");
													$mesDias = date("m") - 1;
													$anoAtual = date("Y");
													
													$diaLimite = cal_days_in_month(CAL_GREGORIAN, $mesDias, $anoAtual);
													
													if(strlen($mesAtual)<2) {
														$mesAtual = "0".$mesAtual;
													}
													?>
                                                    <div style="float:left;width:100%;">
                                                        <div style="float:left;">
                                                            <div style="float:left;margin-right:10px;margin-top:5px;width:25px;">
                                                                <label>De</label>
                                                            </div>
                                                            <div style="float:left;margin-right:35px;width:130px;">
                                                                <div class="input-append date" id="data_start" data-date-format="dd/mm/yyyy" data-date="">
                                                                    <input style="width:115px;" name="data_start" id="iddata_start" value="01/<?=$mesAtual?>/<?=$anoAtual?>" type="text">
                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="float:left;margin-right:10px;">
                                                            <div style="float:left;margin-right:10px;margin-top:5px;width:25px;">
                                                                <label>Até</label>
                                                            </div>
                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                <div class="input-append date" id="data_end" data-date-format="dd/mm/yyyy" data-date="">
                                                                    <input style="width:115px;" name="data_end" id="iddata_end" value="<?=$diaLimite?>/<?=$mesAtual?>/<?=$anoAtual?>" type="text">
                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="float:left;margin-right:10px;width:25px;">
                                                            <button type="button" onclick="filtrar_fluxo('','');" class="btn btn-primary">Filtrar</button>
                                                        </div>
                                                    </div>

                                                    <div id="fluxo_de_caixa" style="float:left;width:100%;">

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
            <script>
			$(document).ready(function() {
				$( window ).load(function() {
					filtrar_fluxo('01/<?=$mesAtual?>/<?=$anoAtual?>','<?=$diaLimite?>/<?=$mesAtual?>/<?=$anoAtual?>');
				});
			});
            </script>
