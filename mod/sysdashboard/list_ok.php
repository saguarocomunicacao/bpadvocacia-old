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
                                                <? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li id="aba_lista" <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Compromissos</a></li><? } ?><? } ?>
                                                <!--<? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li id="aba_novo"><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li><? } ?><? } ?>-->
                                            </ul>
											<script>
                                              $(document).ready(function() {
                                                //* form validation
                                                forms.simple();
            
                                                //* datatables 
                                                beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
            
												beoro_select_row.init();
										
												//* WYSIWG Editor
												beoro_wysiwg.init();

												//* datepicker
												beoro_datepicker.init();

												//* timepicker
												beoro_timepicker.init();

												//* 2col multiselect
												beoro_multiselect.init();

												//* json data source
												beoro_calendar.jsonEvents();
			
												//* colorpicker
												beoro_colorpicker.init();

                                            });
            
                                            //* form validation
                                            forms = {
                                                simple: function() {
                                                    if($('#forms').length) {
                                                        $('#forms').validate({
                                                            onkeyup: false,
                                                            errorClass: 'error',
                                                            validClass: 'valid',
                                                            highlight: function(element) {
                                                                $(element).closest('div').addClass("f-error");
                                                            },
                                                            unhighlight: function(element) {
                                                                $(element).closest('div').removeClass("f-error");
                                                            },
                                                            errorPlacement: function(error, element) {
                                                                $(element).closest('div').append(error);
                                                            },
                                                            rules: {
                                                                nome: { required: true },
                                                                stat: { required: true },
                                                            },
                                                            invalidHandler: function(form, validator) {
                                                                // callback
                                                            }
                                                        })
                                                    }
                                                }
                                            };
                                            
											//* select all rows
											beoro_select_row = {
												init: function() {
													$('.select_msgs').click(function () {
														var tableid = $(this).data('tableid');
														$('#'+tableid).find('input[class=select_msg]').attr('checked', this.checked);
													});
												},
											};

                                            //* datatables
                                            beoro_datatables = {
                                                //* column reorder & toggle visibility
                                                basic: function() {
                                                    if($('#dt_basic').length) {
                                                        $('#dt_basic').dataTable({
                                                            "sPaginationType": "bootstrap_full",
															"aoColumns": [
																{ "bSortable": false },
																{ "bSortable": false },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "bSortable": false },
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };


				
											
											//* colorpicker
											beoro_colorpicker = {
												init: function() {
													if($('#cor_categoria').length) {
														$('#cor_categoria').colorpicker({
															format: 'hex'
														})
													}
												}
											};

											//* WYSIWG Editor
											beoro_wysiwg = {
												init: function() {
													if($('#texto').length) { 
														CKEDITOR.replace( 'texto', {
															toolbar: 'Standard'
														});
													}
													if($('#descricao_item').length) { 
														CKEDITOR.replace( 'descricao_item', {
															toolbar: 'Standard'
														});
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#descricao_item_editar').length) { 
														CKEDITOR.replace( 'descricao_item_editar', {
															toolbar: 'Standard'
														});
													}
													if($('#texto_editar').length) { 
														CKEDITOR.replace( 'texto_editar', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
												}
											};

											//* multiselect
											beoro_multiselect = {
												init: function(){
													if($('#lista_admin_itens').length) {
														//* searchable
														$('#lista_admin_itens').multiSelect({
															selectableHeader: '<div class="search-header"><input type="text" class="span12" id="ms-search" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
															selectionHeader: "<div class='search-selected'></div>",
															afterSelect: function(values){
																$('#lista_admin').val(""+$('#lista_admin').val()+'|'+values+'|');
															},
															afterDeselect: function(values){
																$('#lista_admin').val($('#lista_admin').val().replace('|'+values+'|',''));
															}
  														});
													}
												}
											}; 

											//* datepicker
											beoro_datepicker = {
												init: function() {
													if($('#data_criacao').length) {
														$('#data_criacao').datepicker()
													}
													if($('#data_inicio').length) {
														$('#data_inicio').datepicker()
													}
													if($('#data_fim').length) {
														$('#data_fim').datepicker()
													}
													if($('#data_inicio_rela').length) {
														$('#data_inicio_rela').datepicker()
													}
													if($('#data_fim_rela').length) {
														$('#data_fim_rela').datepicker()
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#data_criacao_editar').length) {
														$('#data_criacao_editar').datepicker()
													}
													if($('#data_inicio_editar').length) {
														$('#data_inicio_editar').datepicker()
													}
													if($('#data_fim_editar').length) {
														$('#data_fim_editar').datepicker()
													}
													<? } ?>
												}
											};

											//* timepicker
											beoro_timepicker = {
												init: function() {
													if($('#hora_inicio').length) {
														$('#hora_inicio').timepicker({
															minuteStep: 1,
															showSeconds: true,
															showInputs: false,
															showMeridian: false
														})
													}
													if($('#hora_fim').length) {
														$('#hora_fim').timepicker({
															minuteStep: 1,
															showSeconds: true,
															showInputs: false,
															showMeridian: false
														})
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#hora_inicio_editar').length) {
														$('#hora_inicio_editar').timepicker({
															minuteStep: 1,
															showSeconds: true,
															showInputs: false,
															showMeridian: false
														})
													}
													if($('#hora_fim_editar').length) {
														$('#hora_fim_editar').timepicker({
															minuteStep: 1,
															showSeconds: true,
															showInputs: false,
															showMeridian: false
														})
													}
													<? } ?>
												}
											};

										
											//* fullcalendar
											beoro_calendar = {
												/*
												google: function() {
													if($('#calendar_google').length) {
														$('#calendar_google').fullCalendar({
															header: {
																left: 'month,agendaWeek,agendaDay',
																center: 'title',
																right: 'prev,next'
															},
															buttonText: {
																prev: '<i class="icon-chevron-left icon-white cal_prev" />',
																next: '<i class="icon-chevron-right icon-white cal_next" />'
															},
															aspectRatio: 1.8,
															firstDay: 1, // 0 - Sunday, 1 - Monday
															events: {
																url:'http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic',
																title: 'US Holidays'
															},
															eventClick: function(event) {
																// opens events in a popup window
																window.open(event.url, 'gcalevent', 'width=400,height=200');
																return false;
															}
															
														})
													}
												},
												*/
												jsonEvents: function() {
													if($('#calendar_json').length) {
														$('#calendar_json').fullCalendar({
															header: {
																left: 'month,agendaWeek,agendaDay',
																center: 'title',
																right: 'prev,next'
															},
															monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
															monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
															dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
															dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
															buttonText: {
																prev: '<i class="icon-chevron-left icon-white cal_prev" />',
																next: '<i class="icon-chevron-right icon-white cal_next" />',
																today: 'hoje',
																month: 'mês',
																week: 'semana',
																day: 'dia'
															},
															titleFormat: {
																month: 'MMMM yyyy',
																week: " d MMM [ yyyy]{ '&#8212;'d [ MMM] yyyy}",
																day: 'dddd, d MMM, yyyy'
															},
															columnFormat: {
																month: 'ddd',
																week: 'ddd d/M',
																day: 'dddd d/M'
															},
															editable: false,
															/*defaultView: 'agendaWeek',*/
															firstDay: 1, // 0 - Sunday, 1 - Monday
															selectable: false,
															selectHelper: false
														});
													}
												}
											};
                                            </script>
                                            <style>
											.myClassSyscronograma {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/syscronograma.jpg");
											   background-repeat: no-repeat;
											   background-position: 2px 50%;
											}	
											.myClassSysagenda {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/sysagenda.jpg");
											   background-repeat: no-repeat;
											   background-position: 2px 50%;
											}
											.myClassSysagenda .fc-event-title {
												font-weight:bold;
											   text-decoration:underline;
											}

											.myClassSysconta_a_receber {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/sysconta_a_receber.jpg");
											   background-repeat: no-repeat;
											   background-position: 2px 50%;
											}	
											.myClassSysconta_a_pagar {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/sysconta_a_pagar.jpg");
											   background-repeat: no-repeat;
											   background-position: 2px 50%;
											}	
											.myClassAdv_processo {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/adv_processo.jpg");
											   background-repeat: no-repeat;
											   background-position: 2px 50%;
											}	
											.myClassAdv_processo_agenda {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/adv_processo_agenda.jpg");
											   background-repeat: no-repeat;
											   background-position: 2px 50%;
											}	
											.myClassAdv_intimacao_agenda_concluida {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/stat-1.png");
											   background-repeat: no-repeat;
											   background-position: 2px 50%;
											}	
                                            </style>
                                            <div class="tab-content">
                                                
                                                
                                                <? if(trim($_REQUEST['var3'])=="") { ?>
                                                <div id="tb1_lista" class="tab-pane <? if(trim($_REQUEST['var3'])=="") { ?>active<? } ?>">
                                                    <?
													$mesAtual = date("m");
													$mesDias = date("m") - 1;
													$anoAtual = date("Y");
													
													$diaLimite = cal_days_in_month(CAL_GREGORIAN, $mesDias, $anoAtual);
													
													if(strlen($mesAtual)<2) {
														$mesAtual = "0".$mesAtual;
													}
													?>

                                                    <div class="span2">

                                                        <div style="width:100%;float:left;border-bottom:1px solid #CCC;padding-bottom:5px;">
                                                            <div style="width:100%;float:left;border-bottom:1px solid #CCC;padding-bottom:5px;">Tarefas</div>

                                                            <div style="width:100%;float:left;margin-top:5px;cursor:pointer;" onclick="filtra_sysdashboard('<?=$sysusu['id']?>','analise','1','syscronograma','faa732');">
                                                                <input id="check-analise-syscronograma" type="checkbox" checked="checked" value="1" style="display:none;" />
                                                                <div id="div-cor-analise-syscronograma" style="float:left;width:10px;height:10px;background-color:#faa732;border:1px solid #faa732;margin-top:4px;"></div>
                                                                <div style="float:left;margin-left:5px;font-size:11px;">Em Análise</div>
                                                            </div>

                                                            <div style="width:100%;float:left;margin-top:5px;cursor:pointer;" onclick="filtra_sysdashboard('<?=$sysusu['id']?>','desenvolvimento','1','syscronograma','49afcd');">
                                                                <input id="check-desenvolvimento-syscronograma" type="checkbox" checked="checked" value="1" style="display:none;" />
                                                                <div id="div-cor-desenvolvimento-syscronograma" style="float:left;width:10px;height:10px;background-color:#49afcd;border:1px solid #49afcd;margin-top:4px;"></div>
                                                                <div style="float:left;margin-left:5px;font-size:11px;">Em Desenvolvimento</div>
                                                            </div>

                                                            <div style="width:100%;float:left;margin-top:5px;cursor:pointer;" onclick="filtra_sysdashboard('<?=$sysusu['id']?>','aprovado','1','syscronograma','4e7562');">
                                                                <input id="check-aprovado-syscronograma" type="checkbox" checked="checked" value="1" style="display:none;" />
                                                                <div id="div-cor-aprovado-syscronograma" style="float:left;width:10px;height:10px;background-color:#4e7562;border:1px solid #4e7562;margin-top:4px;"></div>
                                                                <div style="float:left;margin-left:5px;font-size:11px;">Aprovadas e Concluídas</div>
                                                            </div>
                                                            
                                                            <input type="hidden" id="lista-categorias-syscronograma" value="|aprovado||desenvolvimento||analise|" />

                                                            <div style="width:100%;float:left;border-top:1px solid #CCC;border-bottom:1px solid #CCC;padding:5px 0px;margin-top:5px;">Compromissos</div>

                                                            <?
                                                            $qSqlItem = mysql_query("SELECT * FROM sysagenda_categoria WHERE stat='1' ORDER BY ordem");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                if(trim($lista_categorias_sysagenda)=="") {
                                                                    $lista_categorias_sysagenda = "|".$rSqlItem['id']."|";
                                                                } else {
                                                                    $lista_categorias_sysagenda = $lista_categorias_sysagenda."|".$rSqlItem['id']."|";
                                                                }
                                                            ?>
                                                            <div style="width:100%;float:left;margin-top:5px;cursor:pointer;" onclick="filtra_sysdashboard('<?=$sysusu['id']?>','<?= $rSqlItem['id'] ?>','1','sysagenda','<?= $rSqlItem['cor'] ?>');">
                                                                <input id="check-<?= $rSqlItem['id'] ?>-sysagenda" type="checkbox" checked="checked" value="1" style="display:none;" />
                                                                <div id="div-cor-<?= $rSqlItem['id'] ?>-sysagenda" style="float:left;width:10px;height:10px;background-color:<?= $rSqlItem['cor'] ?>;border:1px solid <?= $rSqlItem['cor'] ?>;margin-top:4px;"></div>
                                                                <div style="float:left;margin-left:5px;font-size:11px;"><?=$rSqlItem['nome']?></div>
                                                            </div>
                                                            <? } ?>
                                                            
                                                            <input type="hidden" id="lista-categorias-sysagenda" value="<?=$lista_categorias_sysagenda?>" />

                                                            <!--
                                                            <div style="width:100%;float:left;border-top:1px solid #CCC;border-bottom:1px solid #CCC;padding:5px 0px;margin-top:5px;">Contas a Pagar</div>

                                                            <?
                                                            $qSqlItem = mysql_query("SELECT * FROM sysconta_a_pagar_categoria WHERE stat='1' ORDER BY ordem");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                if(trim($lista_categorias_sysconta_a_pagar)=="") {
                                                                    $lista_categorias_sysconta_a_pagar = "|".$rSqlItem['id']."|";
                                                                } else {
                                                                    $lista_categorias_sysconta_a_pagar = $lista_categorias_sysconta_a_pagar."|".$rSqlItem['id']."|";
                                                                }
                                                            ?>
                                                            <div style="width:100%;float:left;margin-top:5px;cursor:pointer;" onclick="filtra_sysdashboard('<?=$sysusu['id']?>','<?= $rSqlItem['id'] ?>','1','sysconta_a_pagar','999');">
                                                                <input id="check-<?= $rSqlItem['id'] ?>-sysconta_a_pagar" type="checkbox" checked="checked" value="1" style="display:none;" />
                                                                <div id="div-cor-<?= $rSqlItem['id'] ?>-sysconta_a_pagar" style="float:left;width:10px;height:10px;background-color:#999;border:1px solid #999;margin-top:4px;"></div>
                                                                <div style="float:left;margin-left:5px;font-size:11px;"><?=$rSqlItem['nome']?></div>
                                                            </div>
                                                            <? } ?>
                                                            
                                                            <input type="hidden" id="lista-categorias-sysconta_a_pagar" value="<?=$lista_categorias_sysconta_a_pagar?>" />

                                                            <div style="width:100%;float:left;border-top:1px solid #CCC;border-bottom:1px solid #CCC;padding:5px 0px;margin-top:5px;">Contas a Receber</div>

                                                            <?
                                                            $qSqlItem = mysql_query("SELECT * FROM sysconta_a_receber_categoria WHERE stat='1' ORDER BY ordem");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                if(trim($lista_categorias_sysconta_a_receber)=="") {
                                                                    $lista_categorias_sysconta_a_receber = "|".$rSqlItem['id']."|";
                                                                } else {
                                                                    $lista_categorias_sysconta_a_receber = $lista_categorias_sysconta_a_receber."|".$rSqlItem['id']."|";
                                                                }
                                                            ?>
                                                            <div style="width:100%;float:left;margin-top:5px;cursor:pointer;" onclick="filtra_sysdashboard('<?=$sysusu['id']?>','<?= $rSqlItem['id'] ?>','1','sysconta_a_receber','999');">
                                                                <input id="check-<?= $rSqlItem['id'] ?>-sysconta_a_receber" type="checkbox" checked="checked" value="1" style="display:none;" />
                                                                <div id="div-cor-<?= $rSqlItem['id'] ?>-sysconta_a_receber" style="float:left;width:10px;height:10px;background-color:#999;border:1px solid #999;margin-top:4px;"></div>
                                                                <div style="float:left;margin-left:5px;font-size:11px;"><?=$rSqlItem['nome']?></div>
                                                            </div>
                                                            <? } ?>
                                                            
                                                            <input type="hidden" id="lista-categorias-sysconta_a_receber" value="<?=$lista_categorias_sysconta_a_receber?>" />
                                                            -->

                                                            <div style="width:100%;float:left;border-top:1px solid #CCC;border-bottom:1px solid #CCC;padding:5px 0px;margin-top:5px;">Processos</div>

                                                            <div style="width:100%;float:left;margin-top:5px;cursor:pointer;" onclick="filtra_sysdashboard('<?=$sysusu['id']?>','0','1','adv_processo','000');">
                                                                <input id="check-0-adv_processo" type="checkbox" checked="checked" value="1" style="display:none;" />
                                                                <div id="div-cor-0-adv_processo" style="float:left;width:10px;height:10px;background-color:#000;border:1px solid #000;margin-top:4px;"></div>
                                                                <div style="float:left;margin-left:5px;font-size:11px;">Sem Situação</div>
                                                            </div>
                                                            <?
															$lista_categorias_adv_processo = "|0|";
															$qSqlItem = mysql_query("SELECT * FROM adv_processo_tipo WHERE stat='1' ORDER BY ordem");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                if(trim($lista_categorias_adv_processo)=="") {
                                                                    $lista_categorias_adv_processo = "|".$rSqlItem['id']."|";
                                                                } else {
                                                                    $lista_categorias_adv_processo = $lista_categorias_adv_processo."|".$rSqlItem['id']."|";
                                                                }
                                                            ?>
                                                            <div style="width:100%;float:left;margin-top:5px;cursor:pointer;" onclick="filtra_sysdashboard('<?=$sysusu['id']?>','<?= $rSqlItem['id'] ?>','1','adv_processo','<?= $rSqlItem['cor'] ?>');">
                                                                <input id="check-<?= $rSqlItem['id'] ?>-adv_processo" type="checkbox" checked="checked" value="1" style="display:none;" />
                                                                <div id="div-cor-<?= $rSqlItem['id'] ?>-adv_processo" style="float:left;width:10px;height:10px;background-color:<?= $rSqlItem['cor'] ?>;border:1px solid <?= $rSqlItem['cor'] ?>;margin-top:4px;"></div>
                                                                <div style="float:left;margin-left:5px;font-size:11px;"><?=$rSqlItem['nome']?></div>
                                                            </div>
                                                            <? } ?>
                                                            
                                                            <input type="hidden" id="lista-categorias-adv_processo" value="<?=$lista_categorias_adv_processo?>" />
                                                        </div>

                                                        <div id="preloader-categoria" style="width:100%;float:left;display:none;margin-top:5px;">
                                                            <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                                            <div style="float:left;">atualizando</div>
                                                        </div>

                                                    </div>

                                                    <div class="span10">
                                                        <div class="w-box w-box">
                                                            <div class="w-box-header"></div>
                                                            <div class="w-box-content">
                                                                <div id='calendar_json'></div>
                                                            </div>
                                                        </div>
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
            <script>filtra_sysdashboard('<?=$sysusu['id']?>','','0','');</script>

