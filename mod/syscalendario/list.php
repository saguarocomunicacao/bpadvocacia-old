        <?
		if($sysusu['id']=="1" || $sysusu['id']=="10") {
			$navegacao = "admin";
		} else {
			$navegacao = "admin";
		}
		?>
        
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
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="categorias") { } else { ?><? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li id="aba_editar" class="active"><a data-toggle="tab" href="#tb1_editar">Editando <?=$row['nome']?></a></li><? } ?><? } ?>
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="categorias") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li id="aba_lista" <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Compromissos</a></li><? } ?><? } ?>
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="categorias") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li id="aba_novo"><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li><? } ?><? } ?>
                                                <li>
                                                    <div id="preloader-categoria" style="width:100%;float:left;display:none;margin-top:5px;">
                                                        <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                                        <div style="float:left;">atualizando</div>
                                                    </div>
                                                </li>
                                                <!--
												<? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="categorias") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_categorias">Categorias</a></li><? } ?>
                                                -->
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
            
												//* switch buttons
												beoro_switchButtons.init();

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
																left: '',
																center: 'title',
																right: ''
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
															editable: true,
															/*defaultView: 'agendaWeek',*/
															firstDay: 1, // 0 - Sunday, 1 - Monday
															selectable: true,
															selectHelper: true,
															select: function(start, end) {
																$("#tb1_lista").removeClass( "active" );
																$("#aba_lista").removeClass( "active" );
																$("#aba_novo").addClass( "active" );
																$("#tb1_novo").addClass( "active" );
																
																var tamanho_data = start.toLocaleString().length;
																if(tamanho_data<19) {
																	var data_set = "0"+start.toLocaleString()+"";
																} else {
																	var data_set = ""+start.toLocaleString()+"";
																}
																var sodata = data_set.substr(0, 10);
																
																$("#data_inicio").attr( "data-date", ""+sodata+"" );
																$("#data_fim").attr( "data-date", ""+sodata+"" );
																
																$("#data_inicio_cmp").attr( "value", ""+sodata+"" );
																$("#data_fim_cmp").attr( "value", ""+sodata+"" );

															},
															eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
																atualiza_dia_sysagenda(event.id,event.description,dayDelta,minuteDelta,'drop')
															},
															eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
																atualiza_dia_sysagenda(event.id,event.description,dayDelta,minuteDelta,'resize')
															}
														});
													}
												}
											};

											//* switch buttons
											beoro_switchButtons = {
												init: function() {
													if($('#mostrar_agenda').length) { $("#mostrar_agenda").iButton(); }
													if($('#mostrar_dashboard').length) { $("#mostrar_dashboard").iButton(); }
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
											.myClassSysagenda_concluida {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/stat-1.png");
											   background-repeat: no-repeat;
											   background-position: 2px 50%;
											}	
											.myClassSysagenda .fc-event-title {
												font-weight:bold;
											   text-decoration:underline;
											}
											.myClassSysagenda_concluida .fc-event-title {
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
											.myClassAdv_intimacao_agenda {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/adv_processo_agenda.jpg");
											   background-repeat: no-repeat;
											   background-position: 2px 50%;
											}	
											.myClassAdv_processo_agenda_concluida {
											   padding-left: 20px;
											   background-image: url("<?=$link?>template/img/icones_novos/16/stat-1.png");
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
                                                
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="categorias") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">

                                                    <div class="tabbable tabs-left tabbable-bordered">
                                                        <ul class="nav nav-tabs">
                                                            <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Dados cadastrais</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="arquivos") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_c">Arquivos</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                    <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                        
                                                                    <? 
                                                                    $numeroUnicoGerado_editar = $row['numeroUnico']; 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" id="numeroUnico_editar" value="<?=$numeroUnicoGerado_editar?>">
                        
        
                                                                    <? if(trim($row['criador'])==$sysusu['id']) { ?>
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Escolha a categoria</label>
                                                                            <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM sysagenda_categoria WHERE stat='1' ORDER BY ordem");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['id'.$mod.'_categoria']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    -->
                                                                    <? } ?>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Título</label>
                                                                            <input value="<?=$row['nome']?>" style="width:350px;"  type="text" name="nome" id="nome"  />
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Digite um título para o compromisso</span>
                                                                    </div>
                    
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Começa em</label>
                                                                            <div class="input-append date" id="data_inicio" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_inicio'])==""||trim($row['data_inicio'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_inicio'],"d/m/Y"); } ?>">
                                                                                <input class="span8" size="16" name="data_inicio" value="<? if(trim($row['data_inicio'])==""||trim($row['data_inicio'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_inicio'],"d/m/Y"); } ?>" type="text" >
                                                                                <input name="data_criacao" value="<? if(trim($row['data_inicio'])==""||trim($row['data_inicio'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_inicio'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" />
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="<? if(trim($row['hora_inicio'])=="") { } else { echo $row['hora_inicio']; } ?>" class="input-small" name="hora_inicio" id="hora_inicio" >
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o compromisso deverá ser iniciado</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Termina em</label>
                                                                            <div class="input-append date" id="data_fim" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>">
                                                                                <input class="span8" size="16" name="data_fim" value="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>" type="text" >
                                                                                <? if(trim($row['criador'])==$sysusu['id']) { } else { ?><input name="data_fim" value="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" /><? } ?>
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="<? if(trim($row['hora_fim'])=="") { } else { echo $row['hora_fim']; } ?>" class="input-small" name="hora_fim" id="hora_fim" >
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o compromisso deverá ser concluído</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                            <label>Responsáveis</label>
                                                                            <select id="lista_admin_itens" multiple="multiple" >
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu WHERE stat='1' AND idsysusu_categoria='7' ORDER BY nome");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?=$rSqlItem['id']?>" <? if(strrpos($row['lista_admin'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                            <input value="<?=$row['lista_admin']?>" style="width:350px;" type="hidden" name="lista_admin" id="lista_admin"  />
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Selecione os administradores deste item do cronograma</span>
                                                                    </div>
        
        
                                                                    <? if(trim($row['arquivo'])=="") {  } else { ?>
                                                                    <div class="formSep">
                                                                        <label>Anexar</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail">
                                                                            <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['arquivo']?>"><?=$row['arquivo']?></a>
                                                                            </div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>_item','arquivo');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
                                                                    <? } ?>
        
																	<? if(trim($row['arquivo_2'])=="") {  } else { ?>
                                                                    <div class="formSep">
                                                                        <label>Anexar 2</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail">
                                                                            <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['arquivo_2']?>"><?=$row['arquivo_2']?></a>
                                                                            </div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>_item','arquivo_2');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
                                                                    <? } ?>
        
																	<? if(trim($row['arquivo_3'])=="") {  } else { ?>
                                                                    <div class="formSep">
                                                                        <label>Anexar 2</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail">
                                                                            <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['arquivo_3']?>"><?=$row['arquivo_3']?></a>
                                                                            </div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>_item','arquivo_3');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
                                                                    <? } ?>
        
																	<? if(trim($row['arquivo_4'])=="") {  } else { ?>
                                                                    <div class="formSep">
                                                                        <label>Anexar 2</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail">
                                                                            <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['arquivo_4']?>"><?=$row['arquivo_4']?></a>
                                                                            </div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>_item','arquivo_4');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
                                                                    <? } ?>
        
																	<? if(trim($row['arquivo_5'])=="") {  } else { ?>
                                                                    <div class="formSep">
                                                                        <label>Anexar 2</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail">
                                                                            <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['arquivo_5']?>"><?=$row['arquivo_5']?></a>
                                                                            </div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>_item','arquivo_5');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
                                                                    <? } ?>
        
        
                                                                    <div class="formSep">
                                                                        <label>Detalhes</label>
                                                                        <textarea name="texto" id="texto_editar" class="span12" style="height:150px;" ><?=$row['texto']?></textarea>
                                                                        <? if(trim($row['criador'])==$sysusu['id']) { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo com uma visão geral do compromisso</span><? } ?>
                                                                    </div>
                                
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Mostrar na Agenda ?</label>
                                                                        <input type="checkbox" name="mostrar_agenda" id="mostrar_agenda" <? if(trim($row['mostrar_agenda'])==1) { echo " checked"; } ?> class="mostrar_agenda {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <label>Mostrar no Dashboard ?</label>
                                                                        <input type="checkbox" name="mostrar_dashboard" id="mostrar_dashboard" <? if(trim($row['mostrar_dashboard'])==1) { echo " checked"; } ?> class="mostrar_dashboard {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                    </div>
                        
                                                                    <div class="formSep">
                                                                        <label class="req">Ativo ?</label>
                                                                        <label class="radio" style="color:#C00;">
                                                                            <input type="radio" name="stat" id="stat1" disabled="disabled" value="0" <? if($row['stat']==0) { echo "checked"; } ?> >
                                                                            não
                                                                        </label>
                                                                        <label class="radio" style="color:#390;">
                                                                            <input type="radio" name="stat" id="stat2" value="1" <? if($row['stat']==1) { echo "checked"; } ?> >
                                                                            sim
                                                                        </label>
                                                                    </div>	
                                                                    -->
                                                                    
                                                                </form>

                                                            </div>

                                                            <div id="tb3_c" class="tab-pane <? if(trim($_REQUEST['var5'])=="arquivos") { ?>active<? } ?>" style="min-height:350px;">
																<script type="text/javascript" src="<?=$link?>template/js/upload.js"></script>
                                                                <script type="text/javascript" >
                                                                    $(function(){
                                                                        new AjaxUpload($('#upload-arquivo'), {
                                                                            action: '<?=$link?>acoes/sysagenda/drop-arquivo.php?numeroUnico_upload_arquivo=<?=$numeroUnicoGerado_editar?>',
                                                                            name: 'file',
                                                                            onSubmit: function(file, ext){
                                                                            },
                                                                            onComplete: function(file, response){
																				window.open('<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/<?=$_REQUEST['var3']?>/<?=$_REQUEST['var4']?>/arquivos/','_self','');
                                                                                parent.$("#galeria-fotos").html(response);
                                                                            }
                                                                        });
                                                                        
                                                                    });
                                                                </script>
                                                                <div class="formSep">
                                                                    <label>Arquivo</label>
                                                                    <input type="button" id="upload-arquivo" value="adicionar arquivo" class="btn" />
                                                                </div>
                            
                                                                <div id="drag-drop-div" class="formSep">
                                                                    <div id="dragandrophandler" style="margin-left:0px;">Arrastar e Soltar os Arquivos Aqui</div>
                                                                    <div id="status1"></div>
                                                                </div>
                                                                <script>
                                                                function sendFileToServer(formData,status)
                                                                {
                                                                    var uploadURL ="<?=$link?>acoes/sysagenda/drop-arquivo.php"; //Upload URL
                                                                    var extraData = { }; //Extra Data.
                                                                    var jqXHR=$.ajax({
                                                                            xhr: function() {
                                                                            var xhrobj = $.ajaxSettings.xhr();
                                                                            if (xhrobj.upload) {
                                                                                    xhrobj.upload.addEventListener('progress', function(event) {
                                                                                        var percent = 0;
                                                                                        var position = event.loaded || event.position;
                                                                                        var total = event.total;
                                                                                        if (event.lengthComputable) {
                                                                                            percent = Math.ceil(position / total * 100);
                                                                                        }
                                                                                        //Set progress
                                                                                        status.setProgress(percent);
                                                                                    }, false);
                                                                                }
                                                                            return xhrobj;
                                                                        },
                                                                    url: uploadURL,
                                                                    type: "POST",
                                                                    contentType:false,
                                                                    processData: false,
                                                                        cache: false,
                                                                        data: formData,
                                                                        success: function(data){
                                                                            status.setProgress(100);

																			window.open('<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/<?=$_REQUEST['var3']?>/<?=$_REQUEST['var4']?>/arquivos/','_self','');

                                                                            parent.$(".statusbar").fadeOut();
                                                                
                                                                            parent.$("#galeria-fotos").html(data);
                                                                        }
                                                                    }); 
                                                                 
                                                                    status.setAbort(jqXHR);
                                                                }
                                                                 
                                                                var rowCount=0;
                                                                function createStatusbar(obj)
                                                                {
                                                                     rowCount++;
                                                                     var row="odd";
                                                                     if(rowCount %2 ==0) row ="even";
                                                                     this.statusbar = $("<div class='statusbar "+row+"'></div>");
                                                                     this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
                                                                     this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
                                                                     this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
                                                                     this.abort = $("<div class='abort'>Cancelar</div>").appendTo(this.statusbar);
                                                                     obj.after(this.statusbar);
                                                                 
                                                                    this.setFileNameSize = function(name,size)
                                                                    {
                                                                        var sizeStr="";
                                                                        var sizeKB = size/1024;
                                                                        if(parseInt(sizeKB) > 1024)
                                                                        {
                                                                            var sizeMB = sizeKB/1024;
                                                                            sizeStr = sizeMB.toFixed(2)+" MB";
                                                                        }

                                                                        else
                                                                        {
                                                                            sizeStr = sizeKB.toFixed(2)+" KB";
                                                                        }
                                                                 
                                                                        this.filename.html(name);
                                                                        this.size.html(sizeStr);
                                                                    }
                                                                    this.setProgress = function(progress)
                                                                    {       
                                                                        var progressBarWidth =progress*this.progressBar.width()/ 100;  
                                                                        this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% &nbsp;");
                                                                        if(parseInt(progress) >= 100)
                                                                        {
                                                                            this.abort.hide();
                                                                        }
                                                                    }
                                                                    this.setAbort = function(jqxhr)
                                                                    {
                                                                        var sb = this.statusbar;
                                                                        this.abort.click(function()
                                                                        {
                                                                            jqxhr.abort();
                                                                            sb.hide();
                                                                        });
                                                                    }
                                                                }
                                                                function handleFileUpload(files,obj)
                                                                {
                                                                   for (var i = 0; i < files.length; i++) 
                                                                   {
                                                                        var fd = new FormData();
                                                                        fd.append('file', files[i]);
                                                                        fd.append('numeroUnicoS','<?=$numeroUnicoGerado_editar?>');
                                                                 
                                                                        var status = new createStatusbar(obj); //Using this we can set progress.
                                                                        status.setFileNameSize(files[i].name,files[i].size);
                                                                        sendFileToServer(fd,status);
                                                                 
                                                                   }
                                                                }
                                                                $(document).ready(function()
                                                                {
                                                                var obj = $("#dragandrophandler");
                                                                obj.on('dragenter', function (e) 
                                                                {
                                                                    e.stopPropagation();
                                                                    e.preventDefault();
                                                                    $(this).css('border', '2px dotted #626262');
                                                                });
                                                                obj.on('dragover', function (e) 
                                                                {
                                                                     e.stopPropagation();
                                                                     e.preventDefault();
                                                                });
                                                                obj.on('drop', function (e) 
                                                                {
                                                                 
                                                                     $(this).css('border', '2px dotted #626262');
                                                                     e.preventDefault();
                                                                     var files = e.originalEvent.dataTransfer.files;
                                                                 
                                                                     //We need to send dropped files to Server
                                                                     handleFileUpload(files,obj);
                                                                });
                                                                $(document).on('dragenter', function (e) 
                                                                {
                                                                    e.stopPropagation();
                                                                    e.preventDefault();
                                                                });
                                                                $(document).on('dragover', function (e) 
                                                                {
                                                                  e.stopPropagation();
                                                                  e.preventDefault();
                                                                  obj.css('border', '2px dotted #626262');
                                                                });
                                                                $(document).on('drop', function (e) 
                                                                {
                                                                    e.stopPropagation();
                                                                    e.preventDefault();
                                                                });
                                                                 
                                                                });
                                                                </script>
                                                            
                                                                <div id="galeria-fotos" class="formSep">
                                                                	<iframe name="lista_galeria_iframe" style="width:0px;height:0px;" width="0px" height="0px" frameborder="0"></iframe>
                                                                    <? $numeroUnicoGet = $numeroUnicoGerado_editar; include("./acoes/sysagenda/lista_galeria.php"); ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="formSep">
                                                        <button type="button" onclick="salvar_formulario();" class="btn btn-success">Salvar</button>
                                                        <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                    </div>

                                                </div>
                                                <? } ?>
                                                
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="categorias") { ?>
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
                                                    <div class="span12">

                                                                <script>
																function filtra_syscalendario_novo(criadorSend) {
																
																	$("#preloader-categoria").fadeIn();
																
																	if($.trim($("#busca_palavra_chave").val())=="") {
																		filtra_palavra_chave_url = "";
																	} else {
																		filtra_palavra_chave_url = "&palavra_chaveS="+$("#busca_palavra_chave").val()+"";
																	}
																
																	filtra_sysusu_url = "&listaIdSFiltra_sysusuS="+$("#filtra_sysusu").val()+"";
																
																	link_set = "lista_eventos_SYS_ARQUIVO_NOVO.php"; 
																	
																	$("#preloader-categoria").fadeIn();
																	$.ajax({
																		url: ""+linkSite+"acoes/sysdashboard/"+link_set+"",
																		type: "GET",
																		cache: false,
																		data: "criadorS="+criadorSend+""+filtra_sysusu_url+""+filtra_palavra_chave_url+"",
																		//dataType: "html",
																		success: function(data){
																			//$("#print-tela").html("---criadorS="+criadorSend+""+filtra_sysusu_url+""+filtra_palavra_chave_url+"");
																			//$("#print-tela").html(data);
																			$('#calendar_json').fullCalendar('removeEvents');
																
																			var myevents = JSON.parse(data);
																
																			$('#calendar_json').fullCalendar('addEventSource', myevents);
																
																			$("#preloader-categoria").hide();
																		},
																	});
																}

																function filtra_syscalendario_submit() {
																	$("#formulario_filtro").submit();
																}
																<? if(trim($_SESSION['_palavra_chaveS'])=="" && trim($_SESSION['_listaIdSFiltra_sysusuS'])=="" ) { } else { ?>
																window.setTimeout(function() {
																	filtra_syscalendario_novo('<?=$sysusu['id']?>');
																}, 500);		
																<? } ?>
                                                                </script>
                                                                <form name="forms_filtro" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario_filtro">
                                                                    <input type="hidden" name="acaoForm" value="filtrar_agenda" />
                                                                    <input type="hidden" name="linkForm" value="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" />
                                                                    <div style="width:40%;float:left;">
                                                                        <div style="float:left;width:100%;margin-bottom:10px;">
                                                                            <label>Responsável</label>
                                                                            <select style="width:100%;" name="filtra_sysusu" id="filtra_sysusu">
                                                                                <option value="">TODOS</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu WHERE stat='1' AND (idsysgrupousuario='1' OR idsysgrupousuario='6') ORDER BY nome");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="|<?=$rSqlItem['id']?>|" <? if(trim("|".$rSqlItem['id']."|")==trim($_SESSION['_listaIdSFiltra_sysusuS'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Selecione o usuário que deseja filtrar as respectivas tarefas</span>
                                                                    </div>
    
                                                                    <div style="width:30%;float:left;margin-left:10px;">
                                                                        <div style="float:left;width:100%;">
                                                                            <label>Palavra-chave</label>
                                                                            <input value="<?=$_SESSION['_palavra_chaveS']?>" style="width:100%;"  type="text" name="busca_palavra_chave" id="busca_palavra_chave"  />
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Digite uma palavra-chave para realizar uma pesquisa</span>
                                                                    </div>
    
                                                                    <div style="width:10%;float:left;">
                                                                        <button type="button" style="margin-left:20px;margin-top:25px;" onclick="javascript:filtra_syscalendario_submit();" class="btn btn-success">Realizar Filtro</button>
                                                                    </div>
                                                                </form>
            
                                                                <div id="preloader-categoria" style="width:100%;float:left;display:none;margin-top:5px;">
                                                                    <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                                                    <div style="float:left;">atualizando</div>
                                                                </div>
																
                                                                <div id="print-tela" style="width:100%;float:left;"></div>
        
                                                    </div>
                                                    

                                                    <div class="span12" style="margin-left:0px;">

														<? if($navegacao=="admin") { ?>
                                                        <div class="span12">
                                                            <div class="span3"><a id="btn_prev" style="cursor:pointer;color:#7e7e7e;font-weight:bold;">&nbsp;&nbsp;ANTERIOR</a></div>
                                                            <div class="span6"></div>
                                                            <div class="span3"><a id="btn_next" style="float:right;cursor:pointer;color:#7e7e7e;font-weight:bold;">PRÓXIMO&nbsp;&nbsp;</a></div>
                                                        </div>
                                                        <? } ?>
    
                                                        <div class="w-box w-box" style="margin-top:20px;">
                                                            <div class="w-box-header"></div>
                                                            <div class="w-box-content">
                                                                <div id='calendar_json'></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <? } ?>
                                                
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="categorias") { ?>

                                                <div id="tb1_novo" class="tab-pane">

                                                    <div class="tabbable tabs-left tabbable-bordered">
                                                        <ul class="nav nav-tabs">
                                                            <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Dados cadastrais</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="arquivos") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_c">Arquivos</a></li>
                                                        </ul>
                                                        <div class="tab-content">

                                                            <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">
                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="add" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
            
                                                                    <input type="hidden" name="criador" value="<?=$sysusu['id']?>" />
                        
                                                                    <? 
                                                                    $numeroUnicoGerado = geraCodReturn(); 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
            
                                                                    <input type="hidden" name="stat" value="1">
            
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Escolha a categoria</label>
                                                                            <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM sysagenda_categoria WHERE stat='1' ORDER BY ordem");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    -->
            
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label>Título</label>
                                                                            <input value="" class="span7" type="text" name="nome" id="nome" />
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Digite um título para o compromisso</span>
                                                                    </div>
            
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Começa em</label>
                                                                            <div class="input-append date" id="data_inicio" data-date-format="dd/mm/yyyy" data-date="">
                                                                                <input class="span8" size="16" id="data_inicio_cmp" name="data_inicio" value="" type="text">
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="<? echo date("H:i:s"); ?>" class="input-small" name="hora_inicio" id="hora_inicio">
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o compromisso deverá ser iniciado</span>
                                                                    </div>
            
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Termina em</label>
                                                                            <div class="input-append date" id="data_fim" data-date-format="dd/mm/yyyy" data-date="">
                                                                                <input class="span8" size="16" id="data_fim_cmp" name="data_fim" value="" type="text">
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="<? echo date("H:i:s"); ?>" class="input-small" name="hora_fim" id="hora_fim">
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o compromisso deverá ser concluído</span>
                                                                    </div>
            
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                            <label>Responsáveis</label>
                                                                            <select id="lista_admin_itens" multiple="multiple">
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu WHERE stat='1' AND idsysusu_categoria='7' ORDER BY nome");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?=$rSqlItem['id']?>"><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                            <input value="" style="width:350px;" type="hidden" name="lista_admin" id="lista_admin" />
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Selecione os administradores deste item do cronograma</span>
                                                                    </div>
            
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Anexar</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="arquivo" type="file"></span>
                                                                            <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="formSep">
                                                                        <label>Anexar 2</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="arquivo_2" type="file"></span>
                                                                            <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="formSep">
                                                                        <label>Anexar 3</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="arquivo_3" type="file"></span>
                                                                            <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="formSep">
                                                                        <label>Anexar 4</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="arquivo_4" type="file"></span>
                                                                            <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="formSep">
                                                                        <label>Anexar 5</label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                            <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="arquivo_5" type="file"></span>
                                                                            <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                        </div>
                                                                    </div>
                                                                    -->
            
                                                                    <div class="formSep">
                                                                        <label>Detalhes</label>
                                                                        <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                                        <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo com uma visão geral do compromisso</span>
                                                                    </div>
                                
            
                                                                </form>
                                                            </div>

                                                            <div id="tb3_c" class="tab-pane <? if(trim($_REQUEST['var5'])=="arquivos") { ?>active<? } ?>" style="min-height:350px;">
																<script type="text/javascript" src="<?=$link?>template/js/upload.js"></script>
                                                                <script type="text/javascript" >
                                                                    $(function(){
                                                                        new AjaxUpload($('#upload-arquivo'), {
                                                                            action: '<?=$link?>acoes/sysagenda/drop-arquivo.php?numeroUnico_upload_arquivo=<?=$numeroUnicoGerado?>',
                                                                            name: 'file',
                                                                            onSubmit: function(file, ext){
                                                                            },
                                                                            onComplete: function(file, response){
                                                                                parent.$("#galeria-fotos").html(response);
                                                                            }
                                                                        });
                                                                        
                                                                    });
                                                                </script>
                                                                <div class="formSep">
                                                                    <label>Arquivo</label>
                                                                    <input type="button" id="upload-arquivo" value="adicionar arquivo" class="btn" />
                                                                </div>
                            
                                                                <div id="drag-drop-div" class="formSep">
                                                                    <div id="dragandrophandler" style="margin-left:0px;">Arrastar e Soltar os Arquivos Aqui</div>
                                                                    <div id="status1"></div>
                                                                </div>
                                                                <script>
                                                                function sendFileToServer(formData,status)
                                                                {
                                                                    var uploadURL ="<?=$link?>acoes/sysagenda/drop-arquivo.php"; //Upload URL
                                                                    var extraData = { }; //Extra Data.
                                                                    var jqXHR=$.ajax({
                                                                            xhr: function() {
                                                                            var xhrobj = $.ajaxSettings.xhr();
                                                                            if (xhrobj.upload) {
                                                                                    xhrobj.upload.addEventListener('progress', function(event) {
                                                                                        var percent = 0;
                                                                                        var position = event.loaded || event.position;
                                                                                        var total = event.total;
                                                                                        if (event.lengthComputable) {
                                                                                            percent = Math.ceil(position / total * 100);
                                                                                        }
                                                                                        //Set progress
                                                                                        status.setProgress(percent);
                                                                                    }, false);
                                                                                }
                                                                            return xhrobj;
                                                                        },
                                                                    url: uploadURL,
                                                                    type: "POST",
                                                                    contentType:false,
                                                                    processData: false,
                                                                        cache: false,
                                                                        data: formData,
                                                                        success: function(data){
                                                                            status.setProgress(100);

                                                                            parent.$(".statusbar").fadeOut();
                                                                
                                                                            parent.$("#galeria-fotos").html(data);
                                                                        }
                                                                    }); 
                                                                 
                                                                    status.setAbort(jqXHR);
                                                                }
                                                                 
                                                                var rowCount=0;
                                                                function createStatusbar(obj)
                                                                {
                                                                     rowCount++;
                                                                     var row="odd";
                                                                     if(rowCount %2 ==0) row ="even";
                                                                     this.statusbar = $("<div class='statusbar "+row+"'></div>");
                                                                     this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
                                                                     this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
                                                                     this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
                                                                     this.abort = $("<div class='abort'>Cancelar</div>").appendTo(this.statusbar);
                                                                     obj.after(this.statusbar);
                                                                 
                                                                    this.setFileNameSize = function(name,size)
                                                                    {
                                                                        var sizeStr="";
                                                                        var sizeKB = size/1024;
                                                                        if(parseInt(sizeKB) > 1024)
                                                                        {
                                                                            var sizeMB = sizeKB/1024;
                                                                            sizeStr = sizeMB.toFixed(2)+" MB";
                                                                        }
                                                                        else
                                                                        {
                                                                            sizeStr = sizeKB.toFixed(2)+" KB";
                                                                        }
                                                                 
                                                                        this.filename.html(name);
                                                                        this.size.html(sizeStr);
                                                                    }
                                                                    this.setProgress = function(progress)
                                                                    {       
                                                                        var progressBarWidth =progress*this.progressBar.width()/ 100;  
                                                                        this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% &nbsp;");
                                                                        if(parseInt(progress) >= 100)
                                                                        {
                                                                            this.abort.hide();
                                                                        }
                                                                    }
                                                                    this.setAbort = function(jqxhr)
                                                                    {
                                                                        var sb = this.statusbar;
                                                                        this.abort.click(function()
                                                                        {
                                                                            jqxhr.abort();
                                                                            sb.hide();
                                                                        });
                                                                    }
                                                                }
                                                                function handleFileUpload(files,obj)
                                                                {
                                                                   for (var i = 0; i < files.length; i++) 
                                                                   {
                                                                        var fd = new FormData();
                                                                        fd.append('file', files[i]);
                                                                        fd.append('numeroUnicoS','<?=$numeroUnicoGerado?>');
                                                                 
                                                                        var status = new createStatusbar(obj); //Using this we can set progress.
                                                                        status.setFileNameSize(files[i].name,files[i].size);
                                                                        sendFileToServer(fd,status);
                                                                 
                                                                   }
                                                                }
                                                                $(document).ready(function()
                                                                {
                                                                var obj = $("#dragandrophandler");
                                                                obj.on('dragenter', function (e) 
                                                                {
                                                                    e.stopPropagation();
                                                                    e.preventDefault();
                                                                    $(this).css('border', '2px dotted #626262');
                                                                });
                                                                obj.on('dragover', function (e) 
                                                                {
                                                                     e.stopPropagation();
                                                                     e.preventDefault();
                                                                });
                                                                obj.on('drop', function (e) 
                                                                {
                                                                 
                                                                     $(this).css('border', '2px dotted #626262');
                                                                     e.preventDefault();
                                                                     var files = e.originalEvent.dataTransfer.files;
                                                                 
                                                                     //We need to send dropped files to Server
                                                                     handleFileUpload(files,obj);
                                                                });
                                                                $(document).on('dragenter', function (e) 
                                                                {
                                                                    e.stopPropagation();
                                                                    e.preventDefault();
                                                                });
                                                                $(document).on('dragover', function (e) 
                                                                {
                                                                  e.stopPropagation();
                                                                  e.preventDefault();
                                                                  obj.css('border', '2px dotted #626262');
                                                                });
                                                                $(document).on('drop', function (e) 
                                                                {
                                                                    e.stopPropagation();
                                                                    e.preventDefault();
                                                                });
                                                                 
                                                                });
                                                                </script>
                                                            
                                                                <div id="galeria-fotos" class="formSep">
                                                                	<iframe name="lista_galeria_iframe" style="width:0px;height:0px;" width="0px" height="0px" frameborder="0"></iframe>
                                                                    <? $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/sysagenda/lista_galeria.php"); ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="formSep">
                                                        <button type="button" onclick="salvar_formulario();" class="btn btn-success">Salvar</button>
                                                        <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                        <button type="button" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                    </div>

                                                </div>

                                                <? } ?>

                                                <div id="tb1_categorias" class="tab-pane <? if(trim($_REQUEST['var3'])=="categorias") { ?>active<? } ?>">
                                                    <div>
                                                        <form name="form_categoria" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" id="acaoForm_categoria" value="add-categoria" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="iditem" id="iditem_categoria" value="" disabled="disabled" />
                
                                                            <? $numeroUnicoGeradoCategoria = geraCodReturn(); ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico_categoria" value="<?=$numeroUnicoGeradoCategoria?>">
                                                            
                                                            <input type="hidden" name="criador" id="criador_categoria" value="<?=$sysusu['id']?>" />

                                                            <input type="hidden" name="stat" value="1" />
                                                            
                                                            <div class="formSep">
                                                                <div style="float:left;width:100%;" id="form_categoria">

                                                                    <div class="formSep">
                                                                        <label class="req">Ordem</label>
                                                                        <select name="ordem" name="ordem_categoria" style="width:50px;">
                                                                            <?
                                                                            $nordem = mysql_num_rows(mysql_query("SELECT * FROM sysagenda_categoria WHERE stat='1' ORDER BY ordem"));
                                                                            if($nordem==0) {
                                                                            ?>
                                                                            <option value='1'>1</option>
                                                                            <?
                                                                            } else {
                                                                            $ultimaOrdem = $nordem+1;
                                                                            for ($b=1; $b<=$ultimaOrdem; $b++) {
                                                                            ?>
                                                                            <option value='<?=$b?>' <? if($b==$ultimaOrdem) { echo "selected"; } ?>><?=$b?></option>
                                                                            <? } } ?>
                                                                        </select>
                                                                    </div>
                        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label class="req">Nome</label>
                                                                            <input value="" style="width:350px;" type="text" name="nome" id="nome_categoria" />
                                                                        </div>
                                                                    </div>
        
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Cor da categoria</label>
                                                                            <input value="" style="width:70px;" type="text" name="cor" id="cor_categoria" />
                                                                        </div>
                                                                    </div>
                                                                    -->

                                                                </div>
                                                            </div>
                                                            
                                                            <div class="formSep" style="display:block;" id="btns-add">
                                                                <button type="button" onclick="salvar_categoria_sysagenda();" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                            </div>
                                                            
                                                            <div class="formSep" style="display:none;" id="btns-editar">
                                                                <button type="button" onclick="salvar_categoria_sysagenda();" style="margin-top:23px;" class="btn btn-success">Salvar</button>
                                                                <button type="button" onclick="cancela_edita_categoria_sysagenda('<?=$sysusu['id']?>');" style="margin-top:23px;" class="btn btn-warning">Cancelar</button>
                                                            </div>

                                                            <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de categorias</div>
                                                                <div id="lista_categoria_itens" style="width:100%;float:left;">
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:150px;">Ordem</th>
                                                                            <th>Nome</th>
                                                                            <!--<th>Cor</th>-->
                                                                            <th style="width:110px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $qSqlCategoria = mysql_query("SELECT * FROM sysagenda_categoria ORDER BY ordem");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
                                                                        <tr id="lista_categoria_<?=$rSqlCategoria['id']?>">
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['ordem']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                            <!--<td style="vertical-align:middle;"><div style="width:20px;height:20px;background-color:#<? echo str_replace("#","",$rSqlCategoria['cor']); ?>;float:left;margin-right:10px;"></div> #<? echo str_replace("#","",$rSqlCategoria['cor']); ?></td>-->
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onclick="edita_sysagenda_categoria('<?=$rSqlCategoria['id']?>','');" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a>
                                                                                <a href="javascript:void(0);" onClick="remover_sysagenda_categoria('<?=$rSqlCategoria['id']?>','<?=$sysusu['id']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
																				<? if(trim($rSqlCategoria['stat'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_sysagenda_categoria('<?=$rSqlCategoria['id']?>','<?=$sysusu['id']?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_sysagenda_categoria('<?=$rSqlCategoria['id']?>','<?=$sysusu['id']?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                                <? } ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </form>
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
			<? if($navegacao=="admin") { ?>
			$('#btn_prev').click(function(){
				var date1 = $('#calendar_json').fullCalendar('prev').fullCalendar( 'getDate' );

				var mes_set = parseInt(date1.getMonth())+1;
				if(parseInt(mes_set)<10) {
					mes_set = "0"+mes_set+"";
				}
				//alert("["+mes_set+"]");
				//alert("["+date1.getFullYear()+"]");

				var dataSend = '' + date1.getFullYear() + '-' + mes_set + '';
				//alert("["+dataSend+"]");
				<? if(trim($_SESSION['_palavra_chaveS'])=="" && trim($_SESSION['_listaIdSFiltra_sysusuS'])=="" ) { ?>
				filtra_syscalendario('','<?=$sysusu['id']?>','<?=$_REQUEST['var1']?>','<?=$_REQUEST['var2']?>','','0',''+dataSend+'');
				<? } else { ?>
				filtra_syscalendario_novo('<?=$sysusu['id']?>');
				<? } ?>
				//alert('' + date1.getFullYear() + '-' + mes_set + '');
				return false;
			});
			$('#btn_next').click(function(){
				var date1 = $('#calendar_json').fullCalendar('next').fullCalendar( 'getDate' );

				var mes_set = parseInt(date1.getMonth())+1;
				if(parseInt(mes_set)<10) {
					mes_set = "0"+mes_set+"";
				}
				//alert("["+mes_set+"]");
				//alert("["+date1.getFullYear()+"]");

				var dataSend = '' + date1.getFullYear() + '-' + mes_set + '';
				//alert("["+dataSend+"]");
				<? if(trim($_SESSION['_palavra_chaveS'])=="" && trim($_SESSION['_listaIdSFiltra_sysusuS'])=="" ) { ?>
				filtra_syscalendario('','<?=$sysusu['id']?>','<?=$_REQUEST['var1']?>','<?=$_REQUEST['var2']?>','','0',''+dataSend+'');
				<? } else { ?>
				filtra_syscalendario_novo('<?=$sysusu['id']?>');
				<? } ?>
				//alert('' + date1.getFullYear() + '-' + mes_set + '-01');
				return false;
			});
			
			var dataSend = "<?=date("Y")?>-<?=date("m")?>";
			
				<? if(trim($_SESSION['_palavra_chaveS'])=="" && trim($_SESSION['_listaIdSFiltra_sysusuS'])=="" ) { ?>
				filtra_syscalendario('','<?=$sysusu['id']?>','<?=$_REQUEST['var1']?>','<?=$_REQUEST['var2']?>','','0',''+dataSend+'');
				<? } else { ?>
				filtra_syscalendario_novo('<?=$sysusu['id']?>');
				<? } ?>

			<? } else { ?>
				<? if(trim($_SESSION['_palavra_chaveS'])=="" && trim($_SESSION['_listaIdSFiltra_sysusuS'])=="" ) { ?>
				filtra_syscalendario('','<?=$sysusu['id']?>','<?=$_REQUEST['var1']?>','<?=$_REQUEST['var2']?>','','0','');
				<? } else { ?>
				filtra_syscalendario_novo('<?=$sysusu['id']?>');
				<? } ?>
			<? } ?>


            </script>

