        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>

							<? include("./acoes/adv_processo_tipo/menu.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo") { } else { ?><? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_editar">Editando <?=$row['nome']?></a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Lista de Itens</a></li><? } ?>
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li><? } ?><? } ?>
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
            
												/*
												//* switch buttons
												beoro_switchButtons.init();
										
												//* enchanced select box
												beoro_enchancedSelect.init();
												*/

												//* 2col multiselect
												beoro_multiselect.init();

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
                                                    if($('#example').length) {
														$('#example').dataTable({
															"processing": true,
															"serverSide": true,
															"iDisplayLength": 50,
															"ajax": "<?=$link?>acoes/adv_processo/tabela.php?var1=<?=$_REQUEST['var1']?>&var2=<?=$_REQUEST['var2']?>&var3=<?=$_REQUEST['var3']?>&var4=<?=$_REQUEST['var4']?>&var5=<?=$_REQUEST['var5']?>&sysusuS=<?=$sysusu['id']?>",
                                                            "sPaginationType": "bootstrap_full",
															"oLanguage": {
																"sLengthMenu": '<select style="height:23px;">'+
																'<option value="100">50</option>'+
																'<option value="100">100</option>'+
																'<option value="150">150</option>'+
																'<option value="200">200</option>'+
																'<option value="250">250</option>'+
																'<option value="300">300</option>'+
																'<option value="350">350</option>'+
																'<option value="400">400</option>'+
																'<option value="450">450</option>'+
																'<option value="500">500</option>'+
																'<option value="-1">Todos</option>'+
																'</select>'
															},
															"aoColumns": [
																{ "bSortable": false },
																{ "sType": "string" },
																//{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																//{ "sType": "de_datetime", targets: 0 },
																{ "sType": "string" },
																{ "bSortable": false }
															]
														});

														/*
                                                        $('#dt_basic').dataTable({
															"bProcessing": true,
															"bServerSide": true,
															"sAjaxSource": "<?=$link?>acoes/adv_processo/tabela.php?mod=<?=$mod?>&tipoS=<?=$_REQUEST['var3']?>&idtipoS=<?=$_REQUEST['var4']?>&sysusuS=<?=$sysusu['id']?>",
															"oLanguage": {
																"sLengthMenu": '<select style="height:23px;">'+
																'<option value="100">50</option>'+
																'<option value="100">100</option>'+
																'<option value="150">150</option>'+
																'<option value="200">200</option>'+
																'<option value="250">250</option>'+
																'<option value="300">300</option>'+
																'<option value="350">350</option>'+
																'<option value="400">400</option>'+
																'<option value="450">450</option>'+
																'<option value="500">500</option>'+
																'<option value="-1">Todos</option>'+
																'</select>'
															},
															"aoColumns": [
																{ "bSortable": false },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "de_datetime", targets: 0 },
																{ "sType": "string" },
																{ "bSortable": false }
															]
															"sPaginationType": "bootstrap_full",
															"aaSorting": [[ 6, "desc" ]],
															"iDisplayLength": 50,
															"oLanguage": {
																"sLengthMenu": '<select style="height:23px;">'+
																'<option value="100">50</option>'+
																'<option value="100">100</option>'+
																'<option value="150">150</option>'+
																'<option value="200">200</option>'+
																'<option value="250">250</option>'+
																'<option value="300">300</option>'+
																'<option value="350">350</option>'+
																'<option value="400">400</option>'+
																'<option value="450">450</option>'+
																'<option value="500">500</option>'+
																'<option value="-1">Todos</option>'+
																'</select>'
															},
															"aoColumns": [
																{ "bSortable": false },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "de_datetime", targets: 0 },
																{ "sType": "string" },
																{ "bSortable": false }
															]
                                                        });
														*/
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
													if($('#data_fim_tarefa').length) {
														$('#data_fim_tarefa').datepicker()
													}
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
													if($('#hora_fim_tarefa').length) {
														$('#hora_fim_tarefa').timepicker({
															minuteStep: 1,
															showSeconds: true,
															showInputs: false,
															showMeridian: false
														})
													}
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

											//* switch buttons
											/*
											beoro_switchButtons = {
												init: function() {
													if($('#mostrar_agenda').length) { $("#mostrar_agenda").iButton(); }
													if($('#mostrar_dashboard').length) { $("#mostrar_dashboard").iButton(); }
												}
											};


											beoro_enchancedSelect = {
												init: function() {
													if($('#idsyscliente').length) {
										
														$("#idsyscliente").select2({
															placeholder: "Selecione um cliente",
														  ajax: {
															url: "<?=$link?>acoes/syscliente/autocompletar.php",
															dataType: 'json',
															delay: 250,
															data: function (params) {
															  return {
																q: params.term, // search term
																page: params.page
															  };
															},
															processResults: function (data, page) {
															  // parse the results into the format expected by Select2.
															  // since we are using custom formatting functions we do not need to
															  // alter the remote JSON data
															  return {
																results: data.items
															  };
															},
															cache: true
														  },
														  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
														  minimumInputLength: 1,
														  templateResult: formatRepo, // omitted for brevity, see the source of this page
														  templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
														});
										
													}
										
												}
											};
											*/

                                            </script>
                                            <div class="tab-content">
                                                
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">

                                                    <div class="tabbable tabs-left tabbable-bordered">
                                                        <ul class="nav nav-tabs">
                                                            <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Dados do processo</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="tarefas") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_b">Tarefas</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="tarefas-das-intimacoes") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_d">Tarefas das Intimações</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="arquivos") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_c">Arquivos</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                    <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                        
                                                                    <input type="hidden" name="idadv_processo_tipo" id="idadv_processo_tipo" value="<?=$row['idadv_processo_tipo']?>">
        
                                                                    <? 
                                                                    $numeroUnicoGerado = $row['numeroUnico']; 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                        
        
                                                                    <div class="formSep">
                                                                        <label>Situação Atual</label>

																		<? $rSqlProcessoTipoAtual = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo_tipo WHERE id='".$row['idadv_processo_tipo']."'")); ?>
                                                                        <div style="float:left;margin-bottom:10px;">
                                                                        <? if(trim($row['idadv_processo_tipo'])==0) { ?>
                                                                        <button type="button" class="btn-new" style="background-color:#000;border:1px solid #000;">Sem Situação</button>
                                                                        <? } else { ?>
                                                                        <button type="button" class="btn-new" style="background-color:<?=$rSqlProcessoTipoAtual['cor']?>;border:1px solid <?=$rSqlProcessoTipoAtual['cor']?>;"><?=$rSqlProcessoTipoAtual['nome']?></button>
                                                                        <? } ?>
                                                                        </div>

                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Número do Processo</label>
                                                                        <input value="<?=$row['cod']?>" class="span7" type="text" name="cod" id="cod" />
                                                                        <span class="help-block" style="width:100%;float:left;">Será preenchido após processo ajuizado</span>
                                                                    </div>
                        
                                                                    <!--
                                                                    <div class="formSep">

                                                                        <h3>Processos Vinculados</h3>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Nome</label>
                                                                            <input value="" style="width:300px;" type="text" id="nome_adv_processo_processo" placeholder="Nome para o processo vinculado"/>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Código</label>
                                                                            <input value="" style="width:300px;" type="text" id="cod_adv_processo_processo" placeholder="Código para o processo vinculado"/>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <button type="button" onclick="javascript:salvar_lista_adv_processo_processo();" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div id="lista_adv_processo_processo" style="width:100%;float:left;">
                                                                            <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/adv_processo/lista_adv_processo_processo.php"); ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Processo criado por</label>
                                                                        <input type="hidden" name="criador" value="<?=$row['criador']?>">
                                                                        <? $rSqlCriador = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$row['criador']."'")); ?>
                                                                        <input value="<?=$rSqlCriador['nome']?>" class="span7" type="text"  disabled="disabled" />
                                                                    </div>
                                                                    -->

                                                                    <div class="formSep">
																		<? $numeroUnicoGerado_syscliente = geraCodReturn(); ?>
                                                                        <input type="hidden" id="numeroUnico_pop_syscliente" value="<?=$numeroUnicoGerado_syscliente?>">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Cliente</label>
                                                                            <input value="" style="width:300px;" type="text" id="nome_pop_syscliente" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <button type="button" onclick="salvar_cliente_ajax('<?=$sysusu['id']?>','<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar Cliente</button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div id="lista_<?=$mod?>_syscliente" style="width:100%;float:left;">
                                                                            <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/adv_processo/lista_".$mod."_syscliente.php"); ?>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <label>Nome da Ação</label>
                                                                        <input value="<?=$row['nome_acao']?>" class="span10" type="text" name="nome_acao" id="nome_acao" />
                                                                    </div>

                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>NB</label>
                                                                        <input value="<?=$row['nb']?>" class="span3" type="text" name="nb" id="nb" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>NBA</label>
                                                                        <input value="<?=$row['nba']?>" class="span3" type="text" name="nba" id="nba" />
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Data de entrada</label>
                                                                            <div class="input-append date" id="data_inicio" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_inicio'])==""||trim($row['data_inicio'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_inicio'],"d/m/Y"); } ?>">
                                                                                <input class="span8" size="16" name="data_inicio" value="<? if(trim($row['data_inicio'])==""||trim($row['data_inicio'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_inicio'],"d/m/Y"); } ?>" type="text" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <? if(trim($row['criador'])==$sysusu['id']) { } else { ?><input name="data_criacao" value="<? if(trim($row['data_inicio'])==""||trim($row['data_inicio'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_inicio'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" /><? } ?>
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="<? if(trim($row['hora_inicio'])=="") { } else { echo $row['hora_inicio']; } ?>" class="input-small" name="hora_inicio" id="hora_inicio" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o processo deverá ser iniciado</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Data de término</label>
                                                                            <div class="input-append date" id="data_fim" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>">
                                                                                <input class="span8" size="16" name="data_fim" value="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>" type="text" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <? if(trim($row['criador'])==$sysusu['id']) { } else { ?><input name="data_fim" value="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" /><? } ?>
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="<? if(trim($row['hora_fim'])=="") { } else { echo $row['hora_fim']; } ?>" class="input-small" name="hora_fim" id="hora_fim" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o processo foi concluído</span>
                                                                    </div>
                                                                    -->
        
                                                                    <div class="formSep">
                                                                        <label>Observações</label>
                                                                        <textarea name="texto" id="texto_editar" class="span12" style="height:150px;" <? if(trim($row['criador'])==$sysusu['id']||trim($sysperm['todos_'.$mod.''])==1) { } else { ?>disabled="disabled"<? } ?> ><?=$row['texto']?></textarea>
                                                                        <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo com uma visão geral da tarefa a ser executada</span>
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
        
                                                                    <? if(trim($row['criador'])==$sysusu['id']) { ?>
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
                                                                    <? } ?>
                                                                    -->
                                                                    
                                                                </form>
        
                                                            </div>

                                                            <div id="tb3_b" class="tab-pane <? if(trim($_REQUEST['var5'])=="tarefas") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms_agenda" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" value="add-tarefas" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
        
                                                                    <input type="hidden" name="numeroUnico_pai" value="<?=$numeroUnicoGerado?>">
                                                                    <? 
                                                                    $numeroUnicoGerado_tarefa = geraCodReturn(); 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" value="<?=$numeroUnicoGerado_tarefa?>">
                                                                    <input type="hidden" name="criador" value="<?=$sysusu['id']?>">
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label class="req">Título</label>
                                                                                <input value="" style="width:400px;" type="text" name="nome" id="nome_item_editar" placeholder="Digite um título para a tarefa" />
                                                                            </div>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                                <label>Responsáveis</label>
                                                                                <select id="lista_admin_itens" multiple="multiple">
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlItem['id']?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <input value="<?=$row['lista_admin']?>" style="width:350px;" type="hidden" name="lista_admin" id="lista_admin" />
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Selecione os responsáveis por esta tarefa</span>
                                                                        </div>
            
                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Prazo</label>
                                                                                <div class="input-append date" id="data_fim_tarefa" data-date-format="dd/mm/yyyy" data-date="">
                                                                                    <input class="span8" size="16" name="data_fim" value="" type="text" >
                                                                                    <input name="data_fim" value="" type="hidden" disabled="disabled" />
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Hora</label>
                                                                                <div class="input-append bootstrap-timepicker">
                                                                                    <input type="text" value="" class="input-small" name="hora_fim" id="hora_fim_tarefa" >
                                                                                    <span class="add-on">
                                                                                        <i class="icon-time"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Data e Hora que a tarefa deverá ser concluída</span>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <label>Arquivo, Imagem ou Documento</label>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                                <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="imagem" id="imagem_item_editar" type="file"></span>
                                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Insira aqui um arquivo, imagem, documento referente à este item de tarefa</span>
                                                                        </div>
                                                                        <div style="float:left;width:100%;">
                                                                            <label class="req">Descrição</label>
                                                                            <textarea name="descricao" id="descricao_item_editar" class="span12" style="height:150px;"></textarea>
                                                                        </div>
                                                                        <div style="float:left;width:100%;">
                                                                            <button type="button" onclick="salvar_adv_processo_agenda('_editar');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                        <div id="lista_syscronograma_itens_editar" style="width:100%;float:left;">
                                                                            <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width:60px">Arquivo</th>
                                                                                    <th>Responsáveis</th>
                                                                                    <th>Título</th>
                                                                                    <th>Descrição</th>
                                                                                    <th style="width:130px;">Prazo</th>
                                                                                    <th style="width:50px;">Ações</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?
                                                                                $qSqlCategoria = mysql_query("SELECT * FROM ".$mod."_agenda WHERE numeroUnico_pai='".$numeroUnicoGerado."' ORDER BY data_fim DESC, hora_fim DESC");
                                                                                while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                                ?>
                                                                                <tr>
                                                                                    <td style="width:60px">
                                                                                        <? if(trim($rSqlCategoria['imagem'])=="") {  } else { ?>
                                                                                        <?
                                                                                        $extensao = $rSqlCategoria['imagem'];
                                                                                        $extensao = substr($extensao, -4);
                                                                                        if($extensao[0] == '.'){
                                                                                            $extensao = substr($extensao, -3);
                                                                                        }
                                                                                        $extensao = strtolower($extensao);
                                                                                        ?>
                                                                                        <? if(trim($extensao)=="jpg"||trim($extensao)=="jpeg"||trim($extensao)=="gif"||trim($extensao)=="bmp"||trim($extensao)=="png") { ?>
                                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>" alt="<?=$rSqlCategoria['nome']?>"/></a>
                                                                                        <? } else { ?>
                                                                                        <a class="btn-mini ptip_se" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>"><img src="<?=$link?>template/img/icones_novos/16/download.png" /></a>
                                                                                        <? } ?>
                                                                                        <? } ?>
                                                                                    </td> 
                                                                                    <td style="vertical-align:middle;">
                                                                                    <?
                                                                                    $listaCategoria = $rSqlCategoria['lista_admin'];
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
                                                                                        echo $printCategoria;
                                                                                    }
                                                                                    ?>
                                                                                    </td>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['descricao']?></td>
                                                                                    <td style="vertical-align:middle;"><? if(trim($rSqlCategoria['data_fim'])=="0000-00-00") { } else { ajustaData($rSqlCategoria['data_fim'],"d-m-Y"); } ?><?=substr($rSqlCategoria['hora_fim'],0,5)?></td>
                                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                                        <div class="btn-group">
                                                                                        <? if(trim($row['criador'])==$sysusu['id']) { ?><a href="javascript:void(0);" onClick="remover_syscronograma_item('<?=$rSqlCategoria['id']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a><? } ?>
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


                                                            <div id="tb3_d" class="tab-pane <? if(trim($_REQUEST['var5'])=="tarefas-das-intimacoes") { ?>active<? } ?>" style="min-height:350px;">

																	<?
																	$qSqlIntimacao = mysql_query("SELECT * FROM adv_intimacao_agenda WHERE cod_processo='".$row['cod']."'");
																	while($rSqlIntimacao = mysql_fetch_array($qSqlIntimacao)) {
																		if(trim($lista_intimacoes)=="") {
																			$lista_intimacoes = "'".$rSqlIntimacao['numeroUnico']."'";
																		} else {
																			$lista_intimacoes = "".$lista_intimacoes.",'".$rSqlIntimacao['numeroUnico']."'";
																		}
																	}
                                                                    ?>
                                                                    
                                                                    <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                        <div id="lista_adv_intimacao_itens_editar" style="width:100%;float:left;">
                                                                            <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width:60px">Arquivo</th>
                                                                                    <th>Responsáveis</th>
                                                                                    <th>Título</th>
                                                                                    <th>Descrição</th>
                                                                                    <th style="width:130px;">Prazo</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?
                                                                                $qSqlCategoria = mysql_query("SELECT * FROM adv_intimacao_agenda WHERE numeroUnico_pai IN (".$lista_intimacoes.") ORDER BY data_fim DESC, hora_fim DESC");
                                                                                while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
																					if(trim($rSqlCategoria['criador'])==$sysusu['id']) {
																						$mostra_intimacao_agenda = "1";
																					} else {
																						if(strrpos($rSqlCategoria['lista_admin'],"|".$sysusu['id']."|") === false) {
																							$mostra_intimacao_agenda = "0";
																						} else {
																							$mostra_intimacao_agenda = "1";
																						}
																					}
																					
																					if(trim($mostra_intimacao_agenda)=="1") {
                                                                                ?>
                                                                                <tr>
                                                                                    <td style="width:60px">
                                                                                        <? if(trim($rSqlCategoria['imagem'])=="") {  } else { ?>
                                                                                        <?
                                                                                        $extensao = $rSqlCategoria['imagem'];
                                                                                        $extensao = substr($extensao, -4);
                                                                                        if($extensao[0] == '.'){
                                                                                            $extensao = substr($extensao, -3);
                                                                                        }
                                                                                        $extensao = strtolower($extensao);
                                                                                        ?>
                                                                                        <? if(trim($extensao)=="jpg"||trim($extensao)=="jpeg"||trim($extensao)=="gif"||trim($extensao)=="bmp"||trim($extensao)=="png") { ?>
                                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?>adv_intimacao_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?>adv_intimacao_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>" alt="<?=$rSqlCategoria['nome']?>"/></a>
                                                                                        <? } else { ?>
                                                                                        <a class="btn-mini ptip_se" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?>adv_intimacao_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>"><img src="<?=$link?>template/img/icones_novos/16/download.png" /></a>
                                                                                        <? } ?>
                                                                                        <? } ?>
                                                                                    </td> 
                                                                                    <td style="vertical-align:middle;">
                                                                                    <?
                                                                                    $listaCategoria = $rSqlCategoria['lista_admin'];
                                                                                    $listaCategoria = str_replace("||","','",$listaCategoria);
                                                                                    $listaCategoria = str_replace("|","'",$listaCategoria);
                                                                                    if(trim($listaCategoria)=="") { } else {
                                                                                        $printCategoria = "";
                                                                                        $qSqlCat = mysql_query("SELECT * FROM sysusu WHERE id IN(".$listaCategoria.") ORDER BY nome");
                                                                                        while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                                            if(trim($printCategoria)=="") {
                                                                                                if(trim($rSqlCategoria['edicao_aberta'])=="0"||trim($rSqlCategoria['edicao_aberta'])=="") {
																									if(trim($rSqlCategoria['criador'])==$sysusu['id']) {
																										$printCategoria = "<a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome']."";
																									} else {
																										$printCategoria = "- ".$rSqlCat['nome']."";
																									}
																								} else {
																									$printCategoria = "<a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome']."";
																								}
                                                                                            } else {
                                                                                                if(trim($rSqlCategoria['edicao_aberta'])=="0"||trim($rSqlCategoria['edicao_aberta'])=="") {
																									if(trim($rSqlCategoria['criador'])==$sysusu['id']) {
																										$printCategoria = $printCategoria."<br><a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome'];
																									} else {
																										$printCategoria = $printCategoria."<br>- ".$rSqlCat['nome'];
																									}
																								} else {
																									$printCategoria = $printCategoria."<br><a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome'];
																								}
                                                                                            }
                                                                                        }
                                                                                        echo $printCategoria;
                                                                                    }
                                                                                    ?>
                                                                                    </td>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['descricao']?></td>
                                                                                    <td style="vertical-align:middle;"><? if(trim($rSqlCategoria['data_fim'])=="0000-00-00") { } else { ajustaData($rSqlCategoria['data_fim'],"d-m-Y"); } ?><?=substr($rSqlCategoria['hora_fim'],0,5)?></td>
                                                                                </tr>
                                                                                <? } } ?>
                                                                            </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
        
                                                            </div>

                                                            <div id="tb3_c" class="tab-pane <? if(trim($_REQUEST['var5'])=="arquivos") { ?>active<? } ?>" style="min-height:350px;">
																<script type="text/javascript" src="<?=$link?>template/js/upload.js"></script>
                                                                <script type="text/javascript" >
                                                                    $(function(){
                                                                        new AjaxUpload($('#upload-arquivo'), {
                                                                            action: '<?=$link?>acoes/<?=$mod?>/drop-arquivo.php?numeroUnico_upload_arquivo=<?=$numeroUnicoGerado?>',
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
                                                                    var uploadURL ="<?=$link?>acoes/<?=$mod?>/drop-arquivo.php"; //Upload URL
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
                                                                    <? $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/".$mod."/lista_galeria.php"); ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="formSep">
                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                        <button type="button" onclick="salvar_formulario();" class="btn btn-success">Salvar</button>
                                                        <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                        <a class="popup_fancy btn btn-inverse" href="<?=$link?>acoes/syscontrato_modelo/form-gerador.php?idProcessoS=<?=$row['id']?>" title="Gerar Contrato" style="color:#FFF;">Gerar Contrato</a>
                                                        <? } ?>
                                                    </div>

                                                    <div class="formSep">
                                                        <label class="req">Salvar e enviar para</label>
														<?
                                                        $qSqlItem = mysql_query("SELECT * FROM adv_processo_tipo WHERE stat='1' ORDER BY ordem");
                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                             $nPermTipo = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idadv_processo_tipo='".$rSqlItem['id']."'"));
                        
                                                             if($nPermTipo==0) {
                                                                 $auth = "1";
                                                             } else {
                                                                 $rSqlPermTipo = mysql_fetch_array(mysql_query("SELECT * FROM adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idadv_processo_tipo='".$rSqlItem['id']."'"));
                                                                 $auth = "".$rSqlPermTipo['auth']."";
                                                             }
                        
                                                            if($auth=="1") {
                                                        ?>
                                                        <button type="button" onclick="salva_processo('<?=$rSqlItem['id']?>');" class="btn-new" style="background-color:<?=$rSqlItem['cor']?>;border:1px solid <?=$rSqlItem['cor']?>;margin-bottom:5px;"><?=$rSqlItem['nome']?></button>
                                                        <? } } ?>
                                                    
                                                    </div>


                                                </div>
                                                <? } ?>
                                                
                                                <div id="tb1_lista" class="tab-pane <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo") { ?>active<? } ?>">
                                                    <div class="w-box w-box">
                                                        <div class="w-box-header">
                                                            <div class="pull-left">
                                                                <div class="toggle-group">
                                                                    <span data-toggle="dropdown" class="dropdown-toggle">Ações <span class="caret"></span></span>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('excluir');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>template/img/icones_novos/16/remover-x.png" />&nbsp;Remover</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('publicar');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>template/img/icones_novos/16/stat-1.png" />&nbsp;Publicar</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('despublicar');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>template/img/icones_novos/16/stat-0.png" />&nbsp;Despublicar</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="w-box-content">
                                                            <form name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />

                                                                <table id="example" cellspacing="0" width="100%" class="table table-striped table-condensed">
                                                            
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:20px;" class="table_checkbox"><input type="checkbox" name="select_msgs" class="select_msgs ptip_se" title="Selecionar todos" data-tableid="dt_basic" /></th>
                                                                            <th style="width:120px;">Responsável</th>
                                                                            <!--<th>Criador</th>-->
                                                                            <th>Clientes</th>
                                                                            <th style="width:150px;">N° do Processo</th>
                                                                            <th style="width:150px;">Nome da Ação</th>
                                                                            <!--<th style="width:150px;">Última Movimentação</th>-->
                                                                            <th style="width:60px;">ID</th>
                                                                            <th style="width:120px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                             
                                                                </table>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo") { ?>
                                                <div id="tb1_novo" class="tab-pane">


                                                    <div class="tabbable tabs-left tabbable-bordered">
                                                        <ul class="nav nav-tabs">
                                                            <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Dados do processo</a></li>
                                                            <li><a data-toggle="tab" href="#tb3_b">Arquivos</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="add" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
        
                                                                    <input type="hidden" name="idadv_processo_tipo" id="idadv_processo_tipo" value="0">
        
                                                                    <? 
                                                                    $numeroUnicoGerado = geraCodReturn(); 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
        
                                                                    <div class="formSep">
                                                                        <label>Número do Processo</label>
                                                                        <input value="" class="span7" type="text" name="cod" id="cod" />
                                                                        <span class="help-block" style="width:100%;float:left;">Será preenchido após processo ajuizado</span>
                                                                    </div>
        
                                                                    <!--
                                                                    <div class="formSep">

                                                                        <h3>Processos Vinculados</h3>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Nome</label>
                                                                            <input value="" style="width:300px;" type="text" id="nome_adv_processo_processo" placeholder="Nome para o processo vinculado"/>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Código</label>
                                                                            <input value="" style="width:300px;" type="text" id="cod_adv_processo_processo" placeholder="Código para o processo vinculado"/>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <button type="button" onclick="javascript:salvar_lista_adv_processo_processo();" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div id="lista_adv_processo_processo" style="width:100%;float:left;">
                                                                            <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/adv_processo/lista_adv_processo_processo.php"); ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Processo criado por</label>
                                                                        <input type="hidden" name="criador" value="<?=$sysusu['id']?>">
                                                                        <input value="<?=$sysusu['nome']?>" class="span7" type="text" disabled="disabled" />
                                                                    </div>
                                                                    -->

                                                                    <div class="formSep">

                                                                        <!--
                                                                        <div style="float:left;margin-right:10px;">
                                                                        <label id="label-perfil">Cliente</label>
                                                                        <select style="width:300px;" id="idsyscliente">
                                                                            <option value=""></option>
                                                                            <?
                                                                            $qSqlCat = mysql_query("SELECT * FROM syscliente_categoria WHERE stat='1' ORDER BY nome");
                                                                            while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                            ?>
                                                                            <optgroup label="<?= $rSqlCat['nome'] ?>">
                                                                                <?
                                                                                if(trim($sysperm['todos_syscliente'])==1) {
																					$qSqlItem = mysql_query("SELECT * FROM syscliente WHERE stat='1' AND idsyscliente_categoria='".$rSqlCat['id']."' ORDER BY nome");
																				} else {
																					$qSqlItem = mysql_query("SELECT * FROM syscliente WHERE idsysusu='".$sysusu['id']."' AND stat='1' AND idsyscliente_categoria='".$rSqlCat['id']."' ORDER BY nome");
																				}
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </optgroup>
                                                                            <? } ?>
                                                                        </select>
                                                                        </div>
                                                                        -->
																		<? $numeroUnicoGerado_syscliente = geraCodReturn(); ?>
                                                                        <input type="hidden" id="numeroUnico_pop_syscliente" value="<?=$numeroUnicoGerado_syscliente?>">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Cliente</label>
                                                                            <input value="" style="width:300px;" type="text" id="nome_pop_syscliente" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <button type="button" onclick="salvar_cliente_ajax('<?=$sysusu['id']?>','<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar Cliente</button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div id="lista_<?=$mod?>_syscliente" style="width:100%;float:left;">
                                                                            <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/adv_processo/lista_".$mod."_syscliente.php"); ?>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <label>Nome da Ação</label>
                                                                        <input value="" class="span10" type="text" name="nome_acao" id="nome_acao" />
                                                                    </div>

                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>NB</label>
                                                                        <input value="" class="span3" type="text" name="nb" id="nb" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>NBA</label>
                                                                        <input value="" class="span3" type="text" name="nba" id="nba" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Data de entrada</label>
                                                                            <div class="input-append date" id="data_inicio" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                                <input class="span8" size="16" name="data_inicio" value="<? echo date("d/m/Y"); ?>" type="text">
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
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o processo deverá ser iniciado</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Data de término</label>
                                                                            <div class="input-append date" id="data_fim" data-date-format="dd/mm/yyyy" data-date="">
                                                                                <input class="span8" size="16" name="data_fim" value="" type="text">
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="" class="input-small" name="hora_fim" id="hora_fim">
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o processo foi concluído</span>
                                                                    </div>
                                                                    -->
        
                                                                    <div class="formSep">
                                                                        <label>Observações</label>
                                                                        <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                                        <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo com uma visão geral da tarefa a ser executada</span>
                                                                    </div>
        
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Mostrar na Agenda ?</label>
                                                                        <input type="checkbox" name="mostrar_agenda" id="mostrar_agenda" checked="checked" class="mostrar_agenda {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <label>Mostrar na Dashboard ?</label>
                                                                        <input type="checkbox" name="mostrar_dashboard" id="mostrar_dashboard" checked="checked" class="mostrar_dashboard {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <label class="req">Ativo ?</label>
                                                                        <label class="radio" style="color:#C00;">
                                                                            <input type="radio" name="stat" id="ativo1" value="0" >
                                                                            não
                                                                        </label>
                                                                        <label class="radio" style="color:#390;">
                                                                            <input type="radio" name="stat" id="ativo2" checked="checked" value="1" >
                                                                            sim
                                                                        </label>
                                                                    </div>	
                                                                    -->
                                                                    
                                                                    <div class="formSep">
                                                                        <span class="help-block" style="width:100%;float:left;margin-top:10px;">Para inserir os itens da tarefa, você deve primeiro "Salvar" a tarefa ou "Salvar e continuar editando"</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <button type="submit" class="btn btn-success">Salvar</button>
                                                                        <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                                        <button type="button" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                                    </div>
                                                                    
                                                                    <div class="formSep">
                                                                        <label class="req">Salvar e enviar para</label>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM adv_processo_tipo WHERE stat='1' ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																			 $nPermTipo = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idadv_processo_tipo='".$rSqlItem['id']."'"));
										
																			 if($nPermTipo==0) {
																				 $auth = "0";
																			 } else {
																				 $rSqlPermTipo = mysql_fetch_array(mysql_query("SELECT * FROM adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idadv_processo_tipo='".$rSqlItem['id']."'"));
																				 $auth = "".$rSqlPermTipo['auth']."";
																			 }
										
																			if($auth=="1") {
                                                                        ?>
                                                                        <button type="button" onclick="salva_processo('<?=$rSqlItem['id']?>');" class="btn-new" style="background-color:<?=$rSqlItem['cor']?>;border:1px solid <?=$rSqlItem['cor']?>;margin-bottom:5px;"><?=$rSqlItem['nome']?></button>
                                                                        <? } } ?>
                                                                    
                                                                    </div>
                                                                </form>

                                                            </div>

                                                            <div id="tb3_b" class="tab-pane " style="min-height:350px;">

                                                                <script type="text/javascript" src="<?=$link?>template/js/upload.js"></script>
                                                                <script type="text/javascript" >
                                                                    $(function(){
                                                                        new AjaxUpload($('#upload-arquivo'), {
                                                                            action: '<?=$link?>acoes/<?=$mod?>/drop-arquivo.php?numeroUnico_upload_arquivo=<?=$numeroUnicoGerado?>',
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
                                                                    var uploadURL ="<?=$link?>acoes/<?=$mod?>/drop-arquivo.php"; //Upload URL
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
                                                                    <? $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/".$mod."/lista_galeria.php"); ?>
                                                                </div>

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
