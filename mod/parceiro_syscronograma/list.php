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
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?><? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_editar">Editando <?=$row['nome']?></a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Lista de Itens</a></li><? } ?>
                                                <? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_relatorio">Relatório</a></li><? } ?>
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
            
												//* switch buttons
												beoro_switchButtons.init();
										
												//* enchanced select box
												beoro_enchancedSelect.init();
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
                                                                criador: { required: true },
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
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#lista_admin_itens_editar').length) {
														//* searchable
														$('#lista_admin_itens_editar').multiSelect({
															selectableHeader: '<div class="search-header"><input type="text" class="span12" id="ms-search" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
															selectionHeader: "<div class='search-selected'></div>",
															afterSelect: function(values){
																$('#lista_admin_editar').val(""+$('#lista_admin_editar').val()+'|'+values+'|');
															},
															afterDeselect: function(values){
																$('#lista_admin_editar').val($('#lista_admin_editar').val().replace('|'+values+'|',''));
															}
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

											//* switch buttons
											beoro_switchButtons = {
												init: function() {
													if($('#mostrar_agenda').length) { $("#mostrar_agenda").iButton(); }
													if($('#mostrar_dashboard').length) { $("#mostrar_dashboard").iButton(); }
												}
											};

											//* enchanced select box
											beoro_enchancedSelect = {
												init: function() {
													if($('#idparceiro_syscliente').length) {
														$("#idparceiro_syscliente").select2({
															placeholder: "Selecione um cliente",
															allowClear: true
														});
													}
													if($('#idparceiro_syscliente_rela').length) {
														$("#idparceiro_syscliente_rela").select2({
															placeholder: "Selecione um cliente",
															allowClear: true
														});
													}
												}
											};
                                            </script>
                                            <div class="tab-content">
                                                
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">

                                                    <?
													if(trim($row['criador'])==$sysusu['id']) {
														$mostra_tarefa = "1";
													} else {
														if(trim($row['situacao'])=="desenvolvimento") {
															$mostra_tarefa = "1";
														} else {
															$mostra_tarefa = "0";
														}
													}
													?>
                                                    <div class="tabbable tabs-left tabbable-bordered">
                                                        <ul class="nav nav-tabs">
                                                            <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Projeto</a></li>
                                                            <? if(trim($mostra_tarefa)=="1") { ?><li <? if(trim($_REQUEST['var5'])=="tarefas") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_b">Tarefas</a></li><? } ?>
                                                        </ul>
                                                        <div class="tab-content">

                                                            <div id="tb3_a" class="tab-pane  <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                    <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                        
                                                                    <input type="hidden" name="situacao" id="idsituacao" value="<?=$row['situacao']?>" />
        
                                                                    <? 
                                                                    $numeroUnicoGerado_editar = $row['numeroUnico']; 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" id="numeroUnico_editar" value="<?=$numeroUnicoGerado_editar?>">
                        
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label class="req">Título da tarefa</label>
                                                                            <input value="<?=$row['nome']?>" style="width:350px;"  type="text" name="nome" id="nome" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?>  />
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Digite um título para a tarefa</span>
                                                                    </div>
                        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                            <label>Lista de Administradores</label>
                                                                            <select id="lista_admin_itens_editar" multiple="multiple" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu WHERE id NOT IN ('".$sysusu['id']."') ORDER BY nome");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?=$rSqlItem['id']?>" <? if(strrpos($row['lista_admin'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                            <input value="<?=$row['lista_admin']?>" style="width:350px;" type="hidden" name="lista_admin" id="lista_admin_editar" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?>  />
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Selecione os administradores deste item do cronograma</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label class="req">Criada por</label>
                                                                            <select id="criador" name="criador" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?=$rSqlItem['id']?>" <? if($rSqlItem['id']==$row['criador']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Data de criação</label>
                                                                            <div class="input-append date" id="data_criacao" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_criacao'])==""||trim($row['data_criacao'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_criacao'],"d/m/Y"); } ?>">
                                                                                <input class="span8" size="16" name="data_criacao" value="<? if(trim($row['data_criacao'])==""||trim($row['data_criacao'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_criacao'],"d/m/Y"); } ?>" type="text" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <? if(trim($row['criador'])==$sysusu['id']) { } else { ?><input name="data_criacao" value="<? if(trim($row['data_criacao'])==""||trim($row['data_criacao'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_criacao'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" /><? } ?>
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="<? if(trim($row['hora_criacao'])=="") { echo date("H:i:s"); } else { echo $row['hora_criacao']; } ?>" class="input-small" name="hora_criacao" id="hora_criacao" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que a tarefa foi criada</span>
                                                                    </div>
        
                        
                                                                    <div class="formSep">
                                                                        <div class="span2">
                                                                            <label>Responsável</label>
                                                                            <select name="responsavel" id="responsavel" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['responsavel']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Data desejada</label>
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
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que a tarefa deverá ser iniciada</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Data real de término</label>
                                                                            <div class="input-append date" id="data_fim" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>">
                                                                                <input class="span8" size="16" name="data_fim" value="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>" type="text" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <? if(trim($row['criador'])==$sysusu['id']) { } else { ?><input name="data_fim" value="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" /><? } ?>
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
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que a tarefa deverá ser concluída</span>
                                                                    </div>
        
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;width:300px;">
                                                                            <label id="label-perfil">Cliente</label>
                                                                            <select name="idparceiro_syscliente" id="idparceiro_syscliente" onchange="busca_syscontrato_cliente('');" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> class="span12">
                                                                                <option value=""></option>
                                                                                <?
                                                                                $qSqlCat = mysql_query("SELECT * FROM parceiro_syscliente_categoria WHERE stat='1' ORDER BY nome");
                                                                                while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                                ?>
                                                                                <optgroup label="<?= $rSqlCat['nome'] ?>">
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM parceiro_syscliente WHERE stat='1' AND idparceiro_syscliente_categoria='".$rSqlCat['id']."' ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idparceiro_syscliente']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </optgroup>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label>Contratos</label>
                                                                            <?
                                                                            $itemN = mysql_num_rows(mysql_query("SELECT * FROM syscontrato WHERE idparceiro_syscliente='".$row['idparceiro_syscliente']."'"));
                                                                            if(trim($itemN)==0) { 
                                                                            ?>
                                                                            <select id="idsyscontrato" name="idsyscontrato" disabled="disabled" onchange="busca_syscontrato_item_cliente('');"></select>
                                                                            <? } else { ?>
                                                                            <select id="idsyscontrato" name="idsyscontrato" onchange="busca_syscontrato_item_cliente('');" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM syscontrato WHERE idparceiro_syscliente='".$row['idparceiro_syscliente']."' AND aceito='1' AND stat='1' ORDER BY data_aceito");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsyscontrato']) { echo "selected"; } ?>><?=$rSqlItem['numeroUnico']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                            <? } ?>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label>Serviços</label>
                                                                            <?
                                                                            $syscontrato = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato WHERE id='".$row['idsyscontrato']."'"));
                                                                            $itemN = mysql_num_rows(mysql_query("SELECT * FROM syscontrato_item WHERE numeroUnico_pai='".$syscontrato['numeroUnico']."'"));
                                                                            if(trim($itemN)==0) { 
                                                                            ?>
                                                                            <select id="idsyscontrato_item" name="idsyscontrato_item" disabled="disabled"></select>
                                                                            <? } else { ?>
                                                                            <select id="idsyscontrato_item" name="idsyscontrato_item" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM syscontrato_item WHERE numeroUnico_pai='".$syscontrato['numeroUnico']."' ORDER BY data");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    $sysproduto = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto WHERE id='".$rSqlItem['idsysproduto']."'"));
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsyscontrato_item']) { echo "selected"; } ?>><?=$sysproduto['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                            <? } ?>
                                                                        </div>
                                                                    </div>
                                                                    -->
        
                                                                    <div class="formSep">
                                                                        <label>Observações</label>
                                                                        <textarea name="texto" id="texto_editar" class="span12" style="height:150px;" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> ><?=$row['texto']?></textarea>
                                                                        <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo com uma visão geral da tarefa a ser executada</span>
                                                                    </div>
                                
                                                                    <div class="formSep">
                                                                        <label>Mostrar na Agenda ?</label>
                                                                        <input type="checkbox" name="mostrar_agenda" id="mostrar_agenda" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> <? if(trim($row['mostrar_agenda'])==1) { echo " checked"; } ?> class="mostrar_agenda {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                    </div>
        
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Mostrar no Dashboard ?</label>
                                                                        <input type="checkbox" name="mostrar_dashboard" id="mostrar_dashboard" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> <? if(trim($row['mostrar_dashboard'])==1) { echo " checked"; } ?> class="mostrar_dashboard {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                    </div>
                                                                    -->
                        
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
                                                                    
                                                                </form>

                                                            </div>

															<? if(trim($mostra_tarefa)=="1") { ?>
                                                            <div id="tb3_b" class="tab-pane <? if(trim($_REQUEST['var5'])=="tarefas") { ?>active<? } ?>" style="min-height:350px;">
        
                                                                <form name="forms_tarefas" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms_tarefas">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="acaoForm_item" value="add-tarefas" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                    <input type="hidden" name="iditem" id="iditem_item" value="" disabled="disabled" />
        
                                                                    <input type="hidden" name="numeroUnico_pai" value="<?=$numeroUnicoGerado_editar?>">
        
                                                                    <? if(trim($row['criador'])==$sysusu['id']) { ?>


                                                                    <div class="formSep">
                                                                    	<div style="float:left;width:100%;" id="form_item_editar">

																			<? 
                                                                            $numeroUnicoGerado = geraCodReturn(); 
                                                                            ?>
                                                                            <input type="hidden" name="numeroUnico" value="<?=$numeroUnicoGerado?>">
        
                                                                            <div style="float:left;width:100%;">
                                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                    <label class="req">Prioridade</label>
                                                                                    <select name="ordem" id="ordem_item_editar" style="width:50px;">
                                                                                        <?
                                                                                        $nordem = mysql_num_rows(mysql_query("SELECT * FROM parceiro_syscronograma_item WHERE numeroUnico_pai='".$numeroUnicoGerado_editar."'"));
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
                                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                    <label class="req">Título</label>
                                                                                    <input value="" style="width:400px;" type="text" name="nome" id="nome_item_editar" placeholder="Digite um título para a tarefa" />
                                                                                </div>
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
                                                                            <div style="float:left;width:100%;margin-top:10px;">
                                                                                <label class="req">Ativo ?</label>
                                                                                <label class="radio" style="color:#C00;">
                                                                                    <input type="radio" name="stat" id="stat1_item_editar" value="0" >
                                                                                    não
                                                                                </label>
                                                                                <label class="radio" style="color:#390;">
                                                                                    <input type="radio" name="stat" id="stat2_item_editar" checked="checked" value="1" >
                                                                                    sim
                                                                                </label>
                                                                            </div>	
    
                                                                        </div>
                                                                        
                                                                        <div style="float:left;width:100%;display:block;" id="btns-add_editar">
                                                                            <button type="button" onclick="salvar_lista_item_cronograma('_editar');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;width:100%;display:none;" id="btns-editar_editar">
                                                                            <button type="button" onclick="salvar_lista_item_cronograma('_editar');" style="margin-top:23px;" class="btn btn-success">Salvar</button>
                                                                            <button type="button" onclick="cancela_edita_parceiro_syscronograma_item('_editar','<?=$numeroUnicoGerado_editar?>');" style="margin-top:23px;" class="btn btn-warning">Cancelar</button>
                                                                        </div>
                                                                    </div>
                                                                    <? } ?>
                                                                    
                                                                    <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                        <div id="lista_parceiro_syscronograma_itens_editar" style="width:100%;float:left;">
                                                                            <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width:50px;">Prioridade</th>
                                                                                    <th style="width:60px">Arquivo</th>
                                                                                    <th>Título</th>
                                                                                    <th>Descrição</th>
                                                                                    <th style="width:130px;">Concluído em</th>
                                                                                    <th style="width:130px;">Aprovado em</th>
                                                                                    <th style="width:<? if(trim($row['criador'])==$sysusu['id']) { ?>180px;<? } else { ?>90px;<? } ?>">Ações</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?
                                                                                if(trim($row['criador'])==$sysusu['id']) {
																					$qSqlCategoria = mysql_query("SELECT * FROM ".$mod."_item WHERE numeroUnico_pai='".$numeroUnicoGerado_editar."' ORDER BY ordem");
																				} else {
																					$qSqlCategoria = mysql_query("SELECT * FROM ".$mod."_item WHERE numeroUnico_pai='".$numeroUnicoGerado_editar."' AND stat='1' ORDER BY ordem");
																				}
                                                                                while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                                ?>
                                                                                <tr>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['ordem']?></td>
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
                                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>" alt="<?=$rSqlCategoria['nome']?>"/></a>
                                                                                        <? } else { ?>
                                                                                        <a class="btn-mini ptip_se" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>"><img src="<?=$link?>template/img/icones_novos/16/download.png" /></a>
                                                                                        <? } ?>
                                                                                        <? } ?>
                                                                                    </td> 
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['descricao']?></td>
                                                                                    <td style="vertical-align:middle;">
                                                                                    <? if(trim($rSqlCategoria['dataConclusao'])=="0000-00-00 00:00:00") { } else { 
                                                                                        $d  = substr($rSqlCategoria['dataConclusao'],8,2);
                                                                                        $m  = substr($rSqlCategoria['dataConclusao'],5,2);
                                                                                        $a  = substr($rSqlCategoria['dataConclusao'],0,4);
                                                                                        $h = substr($rSqlCategoria['dataConclusao'],11,19);
                                                                                    
                                                                                        $arrayData = mktime(0,0,0,$m,$d,$a);
                                                                                        $dataCorreta = date("d-m-Y", $arrayData);
                                                                                    
                                                                                        echo "".$dataCorreta." ".$h."";
                                                                                    } 
                                                                                    ?>
                                                                                    </td>
                                                                                    <td style="vertical-align:middle;">
                                                                                    <? if(trim($rSqlCategoria['dataAprovacao'])=="0000-00-00 00:00:00") { } else { 
                                                                                        $d  = substr($rSqlCategoria['dataAprovacao'],8,2);
                                                                                        $m  = substr($rSqlCategoria['dataAprovacao'],5,2);
                                                                                        $a  = substr($rSqlCategoria['dataAprovacao'],0,4);
                                                                                        $h = substr($rSqlCategoria['dataAprovacao'],11,19);
                                                                                    
                                                                                        $arrayData = mktime(0,0,0,$m,$d,$a);
                                                                                        $dataCorreta = date("d-m-Y", $arrayData);
                                                                                    
                                                                                        echo "".$dataCorreta." ".$h."";
                                                                                    } 
                                                                                    ?>
                                                                                    </td>
                                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                                        <div class="btn-group">
                                                                                        
                                                                                        <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['imagem']?>" class="btn-mini ptip_se" title="Faça o download deste arquivo"><i class="splashy-download"></i></a>
																						
																						<? if(trim($row['criador'])==$sysusu['id']) { ?>
                                                                                        <a href="javascript:void(0);" onclick="edita_parceiro_syscronograma_item('<?=$rSqlCategoria['id']?>','_editar','<?=$numeroUnicoGerado_editar?>');" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a>

																						<? if(trim($rSqlCategoria['stat'])=="1") { ?>
                                                                                            <a href="javascript:void(0);" onclick="muda_stat_parceiro_syscronograma_item('stat','dataModificacao','<?=$rSqlCategoria['id']?>','0');" class="btn-mini ptip_se" title="Desabilitar para 'Em Desenvolvimento'"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                                        <? } else { ?>
                                                                                            <a href="javascript:void(0);" onclick="muda_stat_parceiro_syscronograma_item('stat','dataModificacao','<?=$rSqlCategoria['id']?>','1');" class="btn-mini ptip_se" title="Habilitar para 'Em Desenvolvimento'"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                                        <? } ?>
                                                                                        <? } ?>

                                                                                        <? if(trim($rSqlCategoria['concluido'])=="1") { ?>
                                                                                            <a href="javascript:void(0);" onclick="muda_stat_parceiro_syscronograma_item('concluido','dataConclusao','<?=$rSqlCategoria['id']?>','0');" class="btn-mini ptip_se" title="Concluído"><img src="<?=$link?>template/img/icones_novos/16/lupa-1.png" /></a>
                                                                                        <? } else { ?>
                                                                                            <a href="javascript:void(0);" onclick="muda_stat_parceiro_syscronograma_item('concluido','dataConclusao','<?=$rSqlCategoria['id']?>','1');" class="btn-mini ptip_se" title="Concluir"><img src="<?=$link?>template/img/icones_novos/16/lupa-0.png" /></a>
                                                                                        <? } ?>

                                                                                        <? if(trim($rSqlCategoria['aprovado'])=="1") { ?>
                                                                                            <a href="javascript:void(0);" <? if(trim($row['criador'])==$sysusu['id']) { ?>onclick="muda_stat_parceiro_syscronograma_item('aprovado','dataAprovacao','<?=$rSqlCategoria['id']?>','0');"<? } else { ?>onclick="alert('Você não tem permissão para esta ação !');"<? } ?> class="btn-mini ptip_se" title="Aprovado"><img src="<?=$link?>template/img/like-1.png" /></a>
                                                                                        <? } else { ?>
                                                                                            <a href="javascript:void(0);" <? if(trim($row['criador'])==$sysusu['id']) { ?>onclick="muda_stat_parceiro_syscronograma_item('aprovado','dataAprovacao','<?=$rSqlCategoria['id']?>','1');"<? } else { ?>onclick="alert('Você não tem permissão para esta ação !');"<? } ?> class="btn-mini ptip_se" title="Aprovar"><img src="<?=$link?>template/img/like-0.png" /></a>
                                                                                        <? } ?>

                                                                                        <? if(trim($row['criador'])==$sysusu['id']) { ?><a href="javascript:void(0);" onClick="remover_parceiro_syscronograma_item('<?=$rSqlCategoria['id']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a><? } ?>
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
															<? } ?>

                                                        </div>
                                                    </div>

                                                    <?
                                                    $concluido = 0;
                                                    $aprovado = 0;
                                                    $nSqlTarefa = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_item WHERE numeroUnico_pai='".$numeroUnicoGerado_editar."' AND stat='1'"));
                                                    if($nSqlTarefa==0) { } else {
                                                    $qSqlTarefa = mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_item WHERE numeroUnico_pai='".$numeroUnicoGerado_editar."' AND stat='1'");
                                                        while($rSqlTarefa = mysql_fetch_array($qSqlTarefa)) {
                                                            
                                                            if(trim($rSqlTarefa['concluido'])=="1") {
                                                                $concluido++;
                                                            }

                                                            if(trim($rSqlTarefa['aprovado'])=="1") {
                                                                $aprovado++;
                                                            }
                                                        }
                                                    
                                                    }
                                                    ?>

                                                    <div class="formSep">
														<? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                        <? if(trim($row['criador'])==$sysusu['id']) { ?>
                                                        <button type="button" onclick="salvar_parceiro_syscronograma();" class="btn btn-success">Salvar</button>
                                                        <button type="button" onclick="salvar_continuar_editando_parceiro_syscronograma();" class="btn btn-primary">Salvar e continuar editando</button>
                                                        <? } ?>
                                                        <? if(trim($row['situacao'])=="analise"&&$concluido==$nSqlTarefa&&$aprovado==$nSqlTarefa&&$nSqlTarefa>0) { ?>
                                                        <button type="button" onclick="salvar_muda_situacao_parceiro_syscronograma('aprovado');" class="btn btn-beoro-2">Aprovar e Concluir</button>
                                                        <? } ?>
                                                        <? if(trim($row['criador'])==$sysusu['id']) { ?>
														<? if(trim($row['situacao'])=="analise") { ?>
                                                        <button type="button" onclick="salvar_muda_situacao_parceiro_syscronograma('desenvolvimento');" class="btn btn-info">Enviar para Desenvolvimento</button>
                                                        <? } ?>
                                                        <? } ?>
                                                        <? if(trim($row['situacao'])=="desenvolvimento"&&$concluido==$nSqlTarefa&&$aprovado<$nSqlTarefa) { ?>
                                                        <button type="button" onclick="salvar_muda_situacao_parceiro_syscronograma('analise');" class="btn btn-warning">Enviar para Análise</button>
                                                        <? } ?>
                                                        <? } ?>
                                                    </div>

                                                </div>
                                                <? } ?>
                                                
                                                <div id="tb1_lista" class="tab-pane <? if(trim($_REQUEST['var3'])=="") { ?>active<? } ?>">
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
                                                            <form name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self" id="list">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <table id="dt_basic" class="table table-striped table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:20px;" class="table_checkbox"><input type="checkbox" name="select_msgs" class="select_msgs ptip_se" title="Selecionar todos" data-tableid="dt_basic" /></th>
                                                                    <th style="width:120px;">Situação</th>
                                                                    <th style="width:150px;">Criador</th>
                                                                    <th style="width:150px;">Responsável</th>
                                                                    <th>Título</th>
                                                                    <th style="width:150px;">Criada em</th>
                                                                    <th style="width:150px;">Início</th>
                                                                    <th style="width:150px;">Fim</th>
                                                                    <th style="width:200px;"></th>
                                                                    <th style="width:90px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." WHERE criador='".$sysusu['id']."' OR responsavel='".$sysusu['id']."' ORDER BY data_inicio DESC, hora_inicio DESC");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                     $url_limpa = transformaCaractere($rSql['nome']);
                                                                ?>
                                                                <script>
																$(function(){
																	 
																	<? if(trim($rSql['criador'])==$sysusu['id']) { ?>
																	$('#nome-<?=$rSql['id']?>').editable({
																		validate: function(value) {
																		   if($.trim(value) == '') { 
																		    return 'Este campo é obrigatório';
																		   } else {
																			   salva_campo_tabela('nome','<?=$rSql['id']?>','<?=$mod?>',value);
																		   }
																		}
																	});
																	<? } ?>
																	
																	$("#bar<?=$rSql['id']?> > span").each(function() {
																		$(this)
																			.data("origWidth", $(this).width())
																			.width(0)
																			.animate({
																				width: $(this).data("origWidth")
																			}, 1200);
																	});
																});
                                                                </script>
																<?
																$listaResponsaveis = "";
                                                                $porcentagem = 0;
                                                                $concluido = 0;
                                                                $aberto = 0;
                                                                $nSqlTarefa = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_item WHERE numeroUnico_pai='".$rSql['numeroUnico']."'"));
                                                                $qSqlTarefa = mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_item WHERE numeroUnico_pai='".$rSql['numeroUnico']."' ORDER BY data");
                                                                while($rSqlTarefa = mysql_fetch_array($qSqlTarefa)) {
																	
                                                                    if(trim($rSqlTarefa['concluido'])=="1"&&trim($rSqlTarefa['aprovado'])=="1") {
                                                                        $concluido++;
                                                                    } else {
                                                                        $aberto++;
                                                                    }
                                                                }
                                                                
																if($nSqlTarefa==0) {
																	$porcentagem = 0;
																} else {
																	$porcentagem = substr((($concluido / $nSqlTarefa) * 100),0,3);
																	$porcentagem = str_replace(".","",$porcentagem);
																}
                                                                
                                                                if($aberto>0) {
                                                                    if(date("Y-m-d")>$rSql['data_fim']) {
                                                                        $classe_barra = "red";
                                                                    } else {
                                                                        if(date("Y-m-d")==$rSql['data_fim']) {
                                                                            $classe_barra = "orange";
                                                                        } else {
                                                                            $classe_barra = "";
                                                                        }
                                                                    }
                                                                } else {
                                                                    $classe_barra = "";
                                                                }
                                                                ?>
                                                                <tr id="linha-<?=$rSql['id']?>">
                                                                    <td style="vertical-align:middle;" class="nolink"><input type="checkbox" name="msg_sel[]" class="select_msg" value="<?=$rSql['id']?>" /></td>
                                                                    <td>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
																			<div style="float:left;">
																			<? if(trim($rSql['situacao'])=="analise") { ?>
                                                                            <button type="button" class="btn btn-mini btn-warning" style="width:120px;">em análise</button>
                                                                            <? } else { ?>
																			<? if(trim($rSql['situacao'])=="desenvolvimento") { ?>
                                                                            <button type="button" class="btn btn-mini btn-info" style="width:120px;">em desenvolvimento</button>
                                                                            <? } else { ?>
                                                                            <button type="button" class="btn btn-mini btn-beoro-2" style="width:120px;">aprovado e concluído</button>
                                                                            <? } ?>
                                                                            <? } ?>
                                                                            </div>
																		<? } ?>
                                                                    </td>

                                                                    <? $sysusu_criador = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['criador']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$sysusu_criador['nome']?></td>
                                                                    <? $sysusu_resp = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['responsavel']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$sysusu_resp['nome']?></td>

                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Título" data-placeholder="Digite um Título" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="javascript:void(0);"><?=$rSql['nome']?></a></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['data_criacao'])=="0000-00-00") { } else { ajustaData($rSql['data_criacao'],"d-m-Y"); } ?><?=substr($rSql['hora_criacao'],0,5)?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['data_inicio'])=="0000-00-00") { } else { ajustaData($rSql['data_inicio'],"d-m-Y"); } ?><?=substr($rSql['hora_inicio'],0,5)?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['data_fim'])=="0000-00-00") { } else { ajustaData($rSql['data_fim'],"d-m-Y"); } ?><?=substr($rSql['hora_fim'],0,5)?></td>
                                                                    <td style="vertical-align:middle;">
                                                                        <div id="bar<?=$rSql['id']?>" class="meter <?=$classe_barra?>">
                                                                            <span style="width: <?=$porcentagem?>%" class="ptip_se" title="
																			<?=$porcentagem?> % concluído 
                                                                            <br> Tarefas: <?=$nSqlTarefa ?>
                                                                            <br> Concluídas: <?=$concluido ?>
                                                                            <br> Abertas: <?=$aberto ?>
                                                                            "><?=$porcentagem?> %</span>
                                                                        </div>
                                                                    </td>
                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">

                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a></div>
																		<? } ?>

                                                                        <? if(trim($rSql['criador'])==$sysusu['id']) { ?>

                                                                        <? if(trim($sysperm['excluir_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$mod?>','NAO','');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a></div>
																		<? } ?>
                                                                        <? if(trim($rSql['stat'])=="1") { ?>
																			<? if(trim($sysperm['despublicar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a></div>
                                                                            <? } else { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a></div>
                                                                            <? } ?>
                                                                        <? } else { ?>
																			<? if(trim($sysperm['publicar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a></div>
                                                                            <? } else { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a></div>
                                                                            <? } ?>
                                                                        <? } ?>

                                                                        <? } ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                            </tbody>
                                                            </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <? if(trim($_REQUEST['var3'])=="") { ?>
                                                <div id="tb1_novo" class="tab-pane">

                                                    <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" id="idacaoForm" value="add" />
                                                        <input type="hidden" name="modulo" value="<?=$mod?>" />

                                                        <input type="hidden" name="situacao" value="analise" />
            
                                                        <? 
                                                        $numeroUnicoGerado = geraCodReturn(); 
                                                        ?>
                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                        <input type="hidden" name="mostrar_dashboard" value="1">

                                                        <div class="formSep">
                                                            <label class="req">Título da tarefa</label>
                                                            <input value="" class="span7" type="text" name="nome" id="nome" />
                                                        </div>

                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                <label>Lista de Administradores</label>
                                                                <select id="lista_admin_itens" multiple="multiple">
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM sysusu WHERE id NOT IN ('".$sysusu['id']."') ORDER BY nome");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?=$rSqlItem['id']?>"><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <input value="" style="width:350px;" type="hidden" name="lista_admin" id="lista_admin" />
                                                            </div>
                                                            <span class="help-block" style="width:100%;float:left;">Selecione os administradores deste item do cronograma</span>
                                                        </div>

                                                        <div class="formSep">
                                                            <label class="req">Criada por</label>
                                                            <select id="criador" name="criador">
                                                                <option value="">---</option>
                                                                <?
                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                ?>
                                                                <option value="<?=$rSqlItem['id']?>" <? if($rSqlItem['id']==$sysusu['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                <? } ?>
                                                            </select>
                                                        </div>

                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;">
                                                                <label>Data de criação</label>
                                                                <div class="input-append date" id="data_criacao" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                    <input class="span8" size="16" name="data_criacao" value="<? echo date("d/m/Y"); ?>" type="text">
                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                            <div style="float:left;margin-right:10px;">
                                                                <label>Hora</label>
                                                                <div class="input-append bootstrap-timepicker">
                                                                    <input type="text" value="<? echo date("H:i:s"); ?>" class="input-small" name="hora_criacao" id="hora_criacao">
                                                                    <span class="add-on">
                                                                        <i class="icon-time"></i>
                                                                    </span>
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                            </div>
                                                            <span class="help-block" style="width:100%;float:left;">Data e Hora que a tarefa foi criada</span>
                                                        </div>
            
                                                        <div class="formSep">
                                                            <label>Responsável</label>
                                                            <select name="responsavel" id="responsavel">
                                                                <option value="">---</option>
                                                                <?
                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                ?>
                                                                <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                <? } ?>
                                                            </select>
                                                        </div>

                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;">
                                                                <label>Data desejada</label>
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
                                                            <span class="help-block" style="width:100%;float:left;">Data e Hora que a tarefa deverá ser iniciada</span>
                                                        </div>

                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;">
                                                                <label>Data real de término</label>
                                                                <div class="input-append date" id="data_fim" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                    <input class="span8" size="16" name="data_fim" value="<? echo date("d/m/Y"); ?>" type="text">
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
                                                            <span class="help-block" style="width:100%;float:left;">Data e Hora que a tarefa deverá ser concluída</span>
                                                        </div>

                                                        <!--
                                                        <div class="formSep">
                                                            <div class="span4">
                                                                <label id="label-perfil">Cliente</label>
                                                                <select name="idparceiro_syscliente" id="idparceiro_syscliente" onchange="busca_syscontrato_cliente('');" class="span12">
                                                                    <option value=""></option>
                                                                    <?
                                                                    $qSqlCat = mysql_query("SELECT * FROM parceiro_syscliente_categoria WHERE stat='1' ORDER BY nome");
                                                                    while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                    ?>
                                                                    <optgroup label="<?= $rSqlCat['nome'] ?>">
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM parceiro_syscliente WHERE stat='1' AND idparceiro_syscliente_categoria='".$rSqlCat['id']."' ORDER BY nome");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idparceiro_syscliente']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </optgroup>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                            <div class="span4">
                                                                <label>Contratos</label>
                                                                <select id="idsyscontrato" name="idsyscontrato" disabled="disabled" onchange="busca_syscontrato_item_cliente('');" class="span12">
                                                                </select>
                                                            </div>
                                                            <div class="span4">
                                                                <label>Serviços</label>
                                                                <select id="idsyscontrato_item" name="idsyscontrato_item" disabled="disabled" class="span12">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        -->

                                                        <div class="formSep">
                                                            <label>Observações</label>
                                                            <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                            <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo com uma visão geral da tarefa a ser executada</span>
                                                        </div>
                    
                                                        <div class="formSep">
                                                            <label>Mostrar na Agenda ?</label>
                                                            <input type="checkbox" name="mostrar_agenda" id="mostrar_agenda" checked="checked" class="mostrar_agenda {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                        </div>

                                                        <!--
                                                        <div class="formSep">
                                                            <label>Mostrar no Dashboard ?</label>
                                                            <input type="checkbox" name="mostrar_dashboard" id="mostrar_dashboard" checked="checked" class="mostrar_dashboard {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                        </div>
                                                        -->

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
                                                        
                                                        <div class="formSep">
                                                            <span class="help-block" class="span12" style="margin-top:10px;">Para inserir os itens da tarefa, você deve primeiro "Salvar" a tarefa ou "Salvar e continuar editando"</span>
                                                        </div>

                                                        <div class="formSep">
                                                            <button type="button" onclick="salvar_parceiro_syscronograma();" class="btn btn-success">Salvar</button>
                                                            <button type="button" onclick="salvar_continuar_editando_parceiro_syscronograma();" class="btn btn-primary">Salvar e continuar editando</button>
                                                            <button type="button" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                        </div>
                                                    </form>

                                                </div>
                                                <? } ?>

                                                <div id="tb1_relatorio" class="tab-pane">

                                                    <form name="forms_relatorio" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms_relatorio">
                                                        <div class="formSep">
                                                            <label id="label-perfil">Cliente</label>
                                                            <select id="idparceiro_syscliente_rela" class="span7">
                                                                <option value=""></option>
                                                                <?
                                                                $qSqlCat = mysql_query("SELECT * FROM parceiro_syscliente_categoria WHERE stat='1' ORDER BY nome");
                                                                while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                ?>
                                                                <optgroup label="<?= $rSqlCat['nome'] ?>">
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM parceiro_syscliente WHERE stat='1' AND idparceiro_syscliente_categoria='".$rSqlCat['id']."' ORDER BY nome");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </optgroup>
                                                                <? } ?>
                                                            </select>
                                                        </div>

                                                        <div class="formSep">
                                                            <label>Responsável</label>
                                                            <select id="responsavel_rela" class="span3">
                                                                <option value="">---</option>
                                                                <?
                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                ?>
                                                                <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                <? } ?>
                                                            </select>
                                                            <span class="help-block" style="width:100%;float:left;">Selecione o usuário que deseja criar o relatório</span>
                                                        </div>

                                                        <div class="formSep">
                                                            <label>Situação</label>
                                                            <select id="situacao_rela" class="span3">
                                                                <option value="">---</option>
                                                                <option value="0">todas</option>
                                                                <option value="1">concluídas e aprovadas</option>
                                                                <option value="2">concluídas e ainda não aprovadas</option>
                                                            </select>
                                                        </div>

                                                        <div class="formSep">
                                                            <div class="span1">
                                                                <label>De</label>
                                                                <input class="span12" value="" data-date-format="dd/mm/yyyy" id="data_inicio_rela" type="text">
                                                            </div>
                                                            <div class="span1">
                                                                <label>Até</label>
                                                                <input class="span12" value="" data-date-format="dd/mm/yyyy" id="data_fim_rela" type="text">
                                                            </div>
                                                        </div>

                                                        <div id="preloader" class="formSep" style="display:none;">
                                                            <div style="width:100%;float:left;margin-top:5px;">
                                                                <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                                                <div style="float:left;">carregando</div>
                                                            </div>
                                                        </div>

                                                        <div id="lista_relatorio" style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                        </div>

                                                        <div class="formSep">
                                                            <button type="button" onclick="gerar_relatorio_parceiro_syscronograma('<?=$mod?>','<?=$sysusu['id']?>');" class="btn btn-success">Gerar Relatório</button>
                                                            <button type="button" id="botao-imprimir-relatorio" style="display:none;" onclick="PrintDiv('relatorio_print');" class="btn btn-primary">Imprimir</button>
                                                            <button type="button" id="botao-limpar-relatorio" onclick="gerar_relatorio('');" style="display:none;" class="btn btn-warning">Limpar</button>
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
