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
                                            <div class="tab-content">
                                                

                                                <div id="tb1_lista" class="tab-pane active">

                                                    <?
													$anoAtual = date("Y");
													?>
                                                    <div style="float:left;width:100%;">
                                                        <div style="float:left;">
                                                            <select id="ano" style="float:left;width:70px;margin-right:10px;">
                                                                <option value="">---</option>
                                                                <? $ano_ini = date("Y") - 5; $ano_fim = date("Y") + 25; ?>
                                                                <? for ($i = $ano_ini; $i <= $ano_fim; $i++) { ?>
                                                                <option value="<?=$i?>"  <? if($i==$anoAtual) { echo "selected"; } ?>><?=$i?></option>
                                                                <? } ?>
                                                            </select>
                                                        </div>

                                                        <div style="float:left;margin-right:10px;width:25px;">
                                                            <button type="button" onclick="filtrar_fluxo('','');" class="btn btn-primary">Filtrar</button>
                                                        </div>

                                                        <div id="preloader" style="float:left;margin-top:5px;margin-left:40px;">
                                                            <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                                            <div style="float:left;">carregando</div>
                                                        </div>

                                                    </div>

                                                    <div id="extrato_anual" style="float:left;width:100%;">

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
					filtrar_extrato_anual('<?=$anoAtual?>');
				});
			});
            </script>
