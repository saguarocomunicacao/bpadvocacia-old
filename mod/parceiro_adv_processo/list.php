        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>

							<? include("./acoes/parceiro_adv_processo_tipo/menu.php"); ?>

							<? #include("./acoes/parceiro_adv_processo_tipo_de_acao/menu.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <script>
                                    function exportar_excel_cliente() {
										window.open('https://www.bpadvocacia.com.br/admin/acoes/parceiro_adv_processo/exportar_excel.php?situacao='+$("#acao_exportar").val()+'&idsysusu=<?=$sysusu['id']?>&adm=<?=$sysusu['adm']?>&idsysgrupousuario=<?=$sysusu['idsysgrupousuario']?>','_blank','');
									}
                                    function exportar_excel_cliente_acao() {
										window.open('https://www.bpadvocacia.com.br/admin/acoes/parceiro_adv_processo/exportar_excel_acao.php?situacao='+$("#acao_exportar_acao").val()+'&idsysusu=<?=$sysusu['id']?>&adm=<?=$sysusu['adm']?>&idsysgrupousuario=<?=$sysusu['idsysgrupousuario']?>','_blank','');
									}
                                    </script>
                                    <div class="span12">
                                        <div class="formSep" style="margin-left:-20px;">
                                            <label>Exportar por SITUAÇÃO para Excel</label>
                                            <select id="acao_exportar" style="float:left;margin-right:10px;">
                                                <option value="">Tudo</option>
                                                <?
												$qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE stat='1' ORDER BY ordem");
												while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                ?>
                                                <option value="<?= $rSqlItem['id'] ?>"><?=corrigirAcentuacao($rSqlItem['nome'])?></option>
                                                <? } ?>
                                            </select>
                                            <button type="button" onclick="exportar_excel_cliente();" class="btn btn-success">Exportar</button>
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <div class="formSep" style="margin-left:-20px;">
                                            <label>Exportar por AÇÃO para Excel</label>
                                            <select id="acao_exportar_acao" style="float:left;margin-right:10px;">
                                                <option value="">Tudo</option>
												<?
                                                $qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo_tipo_de_acao ORDER BY nome");
                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                ?>
                                                <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idparceiro_adv_processo_tipo_de_acao']) { echo "selected"; } ?>><?=corrigirAcentuacao($rSqlItem['nome'])?></option>
                                                <? } ?>
                                            </select>
                                            <button type="button" onclick="exportar_excel_cliente_acao();" class="btn btn-success">Exportar</button>
                                        </div>
                                    </div>

                                    <? if(trim($sysusu['idsysgrupousuario'])=="1" || trim($sysusu['idsysgrupousuario'])=="3") { ?>
									<script>
                                    function mudar_acao_selecionada() {
										$("#acaoForm_lista").val("mudar_acao_para_selecionadas");
										$("#parceiro_adv_processo_tipo_selecionada").val(""+$("#situacao_selecionar").val()+"");
									}
                                    function realizar_mudanca_de_acao() {
										if($.trim($("#parceiro_adv_processo_tipo_selecionada").val())=="") {
											alert("Você precisa selecionar uma situação para realizar a mudança!");
										} else {
											$("#form_lista").submit();
										}
									}
                                    </script>
                                    <div class="span12">
                                        <div class="formSep" style="margin-left:-20px;">
                                            <label>Mudar Selecionadas para Situação</label>
                                            <select id="situacao_selecionar" onchange="mudar_acao_selecionada();" style="float:left;margin-right:10px;">
                                                <option value="">---</option>
                                                <option value="0">Sem Situação</option>
                                                <?
												$qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE stat='1' ORDER BY ordem");
												while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                ?>
                                                <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                <? } ?>
                                            </select>
                                            <button type="button" onclick="realizar_mudanca_de_acao();" class="btn btn-success">Fazer Alteração</button>
                                        </div>
                                    </div>
                                    <? } ?>

                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo"||trim($_REQUEST['var3'])=="acao") { } else { ?><? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_editar">Editando <?=$row['nome']?></a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo"||trim($_REQUEST['var3'])=="acao") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Lista de Itens</a></li><? } ?>
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo"||trim($_REQUEST['var3'])=="acao") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li><? } ?><? } ?>
                                            </ul>
											<script>
                                              $(document).ready(function() {
                                                //* form validation
                                                forms.simple();
            
                                                //* datatables 
                                                /*
												beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
												*/
            
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
                                            /*
											beoro_datatables = {
                                                basic: function() {
                                                    if($('#example').length) {

														$('#example tfoot th').each( function () {
															var title = $(this).text();
															if(title==""||title=="Ações") { } else {
																$(this).html( '<input type="text" placeholder="'+title+'" />' );
															}
														});

														var table = $('#example').dataTable({
															"processing": true,
															"serverSide": true,
															"iDisplayLength": 50,
															"ajax": "<?=$link?>acoes/parceiro_adv_processo/tabela.php?var1=<?=$_REQUEST['var1']?>&var2=<?=$_REQUEST['var2']?>&var3=<?=$_REQUEST['var3']?>&var4=<?=$_REQUEST['var4']?>&var5=<?=$_REQUEST['var5']?>&sysusuS=<?=$sysusu['id']?>",
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
																{ "bSortable": false },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "bSortable": false }
															]
														});


														table.columns().every( function () {
															var that = this;
													 
															$( 'input', this.footer() ).on( 'keyup change', function () {
																if ( that.search() !== this.value ) {
																	that
																		.search( this.value )
																		.draw();
																}
															});
														});

                                                    }
                                                }
                                            };
											*/

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

$(document).ready(function() {
	// Setup - add a text input to each footer cell
	$('#example thead th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();
		var tamanho_px = $(this).attr("tamanho");
		if(tamanho_px=="0px") { } else {
			$(this).html( '<input style="width:90% !important;" type="text" placeholder="'+title+'" />' );
		}
	} );

	// DataTable
	var table = $('#example').DataTable({
		"processing": true,
		"serverSide": true,
		"iDisplayLength": 50,
		"ajax": "<?=$link?>acoes/parceiro_adv_processo/tabela.php?var1=<?=$_REQUEST['var1']?>&var2=<?=$_REQUEST['var2']?>&var3=<?=$_REQUEST['var3']?>&var4=<?=$_REQUEST['var4']?>&var5=<?=$_REQUEST['var5']?>&sysusuS=<?=$sysusu['id']?>",
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
			{ "bSortable": false },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "bSortable": false }
		]
	});

	// Apply the search
	table.columns().eq( 0 ).each( function ( colIdx ) {
		$( 'input', table.column( colIdx ).header() ).on( 'keypress', function () {
			table
				.column( colIdx )
				.search( this.value )
				.draw();
		} );
	} );
} );

                                            </script>
                                            <div class="tab-content">
                                                
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo"||trim($_REQUEST['var3'])=="acao") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">

                                                    <div class="tabbable tabs-left tabbable-bordered">
                                                        <ul class="nav nav-tabs">
                                                            <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Dados cadastrais</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="observacoes") { ?>class="active"<? } ?>><a data-toggle="tab" href="#observacoes">Observações</a></li>
                                                            <!--
                                                            <li <? if(trim($_REQUEST['var5'])=="tarefas") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_b">Tarefas</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="tarefas-das-intimacoes") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_d">Tarefas das Intimações</a></li>
                                                            -->
                                                            <li <? if(trim($_REQUEST['var5'])=="arquivos") { ?>class="active"<? } ?>><a data-toggle="tab" href="#arquivos">Arquivos</a></li>

                                                            <li <? if(trim($_REQUEST['var5'])=="historico") { ?>class="active"<? } ?>><a data-toggle="tab" href="#historico">Histórico</a></li>

                                                        </ul>
                                                        <div class="tab-content">
                                                            <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                    <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                        
                                                                    <input type="hidden" name="idparceiro_adv_processo_tipo" id="idparceiro_adv_processo_tipo" value="<?=$row['idparceiro_adv_processo_tipo']?>">
                                                                    <input type="hidden" name="idparceiro_adv_processo_tipo_de_acao" id="idparceiro_adv_processo_tipo_de_acao" value="<?=$row['idparceiro_adv_processo_tipo_de_acao']?>">
                                                                    <input type="hidden" name="criador" id="criador" value="<?=$row['criador']?>">
        
                                                                    <? 
                                                                    $numeroUnicoGerado = $row['numeroUnico']; 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                        
        
                                                                    <div class="formSep">
                                                                        <label>ID</label>
                                                                        <input value="<?=$row['id']?>" class="span7" type="text" disabled="disabled" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Cadastrado em</label>
                                                                        <?
																		$dataVar = $row['data'];
																	
																		$dia  = substr($dataVar,8,2);
																		$mes  = substr($dataVar,5,2);
																		$ano  = substr($dataVar,0,4);
																		$hora = substr($dataVar,11,19);
																	
																		$arrayData = mktime(0,0,0,$mes,$dia,$ano);
																		$dataCorreta = date("d/m/Y", $arrayData);
																		?>
                                                                        <input value="<?=$dataCorreta." ".$hora?>" class="span7" type="text" disabled="disabled" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Última Movimentação</label>
                                                                        <?
																		$dataVar = $row['dataModificacao'];
																	
																		$dia  = substr($dataVar,8,2);
																		$mes  = substr($dataVar,5,2);
																		$ano  = substr($dataVar,0,4);
																		$hora = substr($dataVar,11,19);
																	
																		$arrayData = mktime(0,0,0,$mes,$dia,$ano);
																		$dataCorreta = date("d/m/Y", $arrayData);
																		?>
                                                                        <input value="<?=$dataCorreta." ".$hora?>" class="span7" type="text" disabled="disabled" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Situação Atual</label>

																		<? $rSqlProcessoTipoAtual = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$row['idparceiro_adv_processo_tipo']."'")); ?>
                                                                        <div style="float:left;margin-bottom:10px;">
                                                                        <? if(trim($row['idparceiro_adv_processo_tipo'])==0) { ?>
                                                                        <button type="button" class="btn-new" style="background-color:#000;border:1px solid #000;">Sem Situação</button>
                                                                        <? } else { ?>
                                                                        <button type="button" class="btn-new" style="background-color:<?=$rSqlProcessoTipoAtual['cor']?>;border:1px solid <?=$rSqlProcessoTipoAtual['cor']?>;"><?=corrigirAcentuacao($rSqlProcessoTipoAtual['nome'])?></button>
                                                                        <? } ?>
                                                                        </div>

                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label class="req">Ação</label>
                                                                            <select name="idparceiro_adv_processo_tipo_de_acao" id="idparceiro_adv_processo_tipo_de_acao">
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo_tipo_de_acao ORDER BY nome");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idparceiro_adv_processo_tipo_de_acao']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Número do Processo</label>
                                                                        <input value="<?=$row['cod']?>" class="span7" type="text" name="cod" id="cod" />
                                                                        <span class="help-block" style="width:100%;float:left;">Será preenchido após processo ajuizado</span>
                                                                    </div>

                                                                        <div class="formSep">
                                                                            <label class="req">Nome Completo</label>
                                                                            <input value="<?=strtoupper($row['nome'])?>" style="text-transform:uppercase;" class="span8" type="text" name="nome" id="nome" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>E-mail principal</label>
                                                                            <input value="<?=$row['email']?>" class="span12" type="text" name="email" id="email" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label class="req">CPF</label>
                                                                            <input class="span12 documento" value="<?=mascaraCpf($row['cpf'])?>" name="cpf" id="cpf" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>RG</label>
                                                                            <input class="span12" value="<?=$row['rg']?>" name="rg" id="rg" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Ocupação</label>
                                                                            <input class="span12" value="<?=$row['ocupacao']?>" name="ocupacao" id="ocupacao" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Nacionalidade</label>
                                                                            <input class="span12" value="<?=$row['nacionalidade']?>" name="nacionalidade" id="nacionalidade" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Estado Civil</label>
                                                                            <select name="estado_civil" id="estado_civil" class="span7">
                                                                                <option value="">---</option>
                                                                                <option value="Casado (a)" <? if($row['estado_civil']=="Casado (a)") { echo "selected"; } ?>>Casado (a)</option>
                                                                                <option value="Separado (a)" <? if($row['estado_civil']=="Separado (a)") { echo "selected"; } ?>>Separado (a)</option>
                                                                                <option value="Solteiro (a)" <? if($row['estado_civil']=="Solteiro (a)") { echo "selected"; } ?>>Solteiro (a)</option>
                                                                                <option value="Viúvo (a)" <? if($row['estado_civil']=="Viúvo (a") { echo "selected"; } ?>>Viúvo (a)</option> 
                                                                                <option value="Divorciado (a)" <? if($row['estado_civil']=="Divorciado (a)") { echo "selected"; } ?>>Divorciado (a)</option> 
                                                                                <option value="Companheiro (a)" <? if($row['estado_civil']=="Companheiro (a)") { echo "selected"; } ?>>Companheiro (a)</option> 
                                                                            </select>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Telefone</label>
                                                                            <input value="<?=$row['telefone']?>" class="span6" type="text" name="telefone" id="telefone" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>CEP</label>
                                                                            <input value="<?=$row['cep']?>" style="width:90px;" type="text" name="cep" id="cep" />
                                                                            <span class="help-block">99999-999</span>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Endereço</label>
                                                                            <input value="<?=$row['rua']?>" class="span12" type="text" name="rua" id="rua" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Número</label>
                                                                            <input value="<?=$row['numero']?>" class="span6" type="text" name="numero" id="numero" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Complemento</label>
                                                                            <input value="<?=$row['complemento']?>" class="span9" type="text" name="complemento" id="complemento" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Bairro</label>
                                                                            <input value="<?=$row['bairro']?>" class="span9" type="text" name="bairro" id="bairro" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Cidade</label>
                                                                            <input value="<?=$row['cidade']?>" class="span9" type="text" name="cidade" id="cidade" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Estado</label>
                                                                            <input value="<?=$row['estado']?>" class="span9" type="text" name="estado" id="estado" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Observação Sistema Antigo</label>
                                                                            <p><?=$row['obs']?></p>
                                                                        </div>

                                                                    <!--
                                                                    <div class="formSep">

                                                                        <h3>Processos Vinculados</h3>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Nome</label>
                                                                            <input value="" style="width:300px;" type="text" id="nome_parceiro_adv_processo_processo" placeholder="Nome para o processo vinculado"/>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Código</label>
                                                                            <input value="" style="width:300px;" type="text" id="cod_parceiro_adv_processo_processo" placeholder="Código para o processo vinculado"/>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <button type="button" onclick="javascript:salvar_lista_parceiro_adv_processo_processo();" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div id="lista_parceiro_adv_processo_processo" style="width:100%;float:left;">
                                                                            <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/parceiro_adv_processo/lista_parceiro_adv_processo_processo.php"); ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Processo criado por</label>
                                                                        <input type="hidden" name="criador" value="<?=$row['criador']?>">
                                                                        <? $rSqlCriador = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$row['criador']."'")); ?>
                                                                        <input value="<?=$rSqlCriador['nome']?>" class="span7" type="text"  disabled="disabled" />
                                                                    </div>
                                                                    -->


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
        
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Observações</label>
                                                                        <textarea name="texto" id="texto_editar" class="span12" style="height:150px;" <? if(trim($row['criador'])==$sysusu['id']||trim($sysperm['todos_'.$mod.''])==1) { } else { ?>disabled="disabled"<? } ?> ><?=$row['texto']?></textarea>
                                                                        <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo com uma visão geral da tarefa a ser executada</span>
                                                                    </div>
                                                                    -->
                        
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

                                                            <div id="observacoes" class="tab-pane <? if(trim($_REQUEST['var5'])=="observacoes") { ?>active<? } ?>" style="min-height:350px;">

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
                                                                        <!--
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
                                                                        -->

                                                                        <div style="float:left;width:100%;">
                                                                            <label class="req">Descrição</label>
                                                                            <textarea name="descricao" id="descricao_item_editar" class="span12" style="height:150px;"></textarea>
                                                                        </div>
                                                                        <div style="float:left;width:100%;margin-top:10px;">
                                                                            <? if(trim($_REQUEST['var7'])=="") { ?>
                                                                            <button type="button" onclick="salvar_parceiro_adv_processo_agenda('_editar');" style="margin-top:23px;" class="btn btn-danger">Adicionar Observação</button>
                                                                            <? } else { ?>
                                                                            <button type="button" onclick="salvar_parceiro_adv_processo_agenda('_editar');" class="btn btn-success">Salvar Alterações</button>
                                                                            <button type="button" onclick="cancela_edita_tarefa_parceiro_adv_processo('<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/<?=$_REQUEST['var3']?>/<?=$_REQUEST['var4']?>/<?=$_REQUEST['var5']?>/');" class="btn btn-warning">Cancelar</button>
                                                                            <? } ?>
                                                                        </div>

                                                                    </div>
                                                                    
                                                                    <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                        <div id="lista_parceiro_syscronograma_itens_editar" style="width:100%;float:left;">
                                                                            <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Descrição</th>
                                                                                    <th style="width:130px;">Data da criação</th>
                                                                                    <th style="width:150px;">Criador</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?
                                                                                $qSqlCategoria = mysql_query("SELECT * FROM ".$mod."_agenda WHERE numeroUnico_pai='".$numeroUnicoGerado."' ORDER BY data_fim DESC, hora_fim DESC");
                                                                                while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                                ?>
                                                                                <tr>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['descricao']?></td>
                                                                                    <? $criador_observacao = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSqlCategoria['criador']."'")); ?>
                                                                                    <td style="vertical-align:middle;"><? if(trim($rSqlCategoria['data'])=="0000-00-00") { } else { ajustaData($rSqlCategoria['data'],"d/m/Y"); } ?></td>
                                                                                    <td style="vertical-align:middle;"><?=$criador_observacao['nome']?></td>
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

                                                            <div id="historico" class="tab-pane <? if(trim($_REQUEST['var5'])=="historico") { ?>active<? } ?>" style="min-height:350px;">

																<?
																$strSQL_log = "
																SELECT 
																	mod_parceiro_adv_processo_log.idparceiro_adv_processo_tipo_de_acao,
																	mod_parceiro_adv_processo_log.idparceiro_adv_processo_tipo_de_acao_txt,
																	mod_parceiro_adv_processo_log.idparceiro_adv_processo_tipo,
																	mod_parceiro_adv_processo_log.idparceiro_adv_processo_tipo_txt,
																	
																	mod_parceiro_adv_processo_log.data,
																
																	mod_sysusu.nome AS sysusu_nome
																
																FROM 
																	parceiro_adv_processo_log AS mod_parceiro_adv_processo_log ". 
																
																"LEFT JOIN sysusu AS mod_sysusu ON (mod_parceiro_adv_processo_log.criador = mod_sysusu.id) " .
																
																"";

                                                                $qSqlLog = mysql_query("".$strSQL_log." 
																										WHERE 
																											mod_parceiro_adv_processo_log.idparceiro_adv_processo='".$row['id']."' 
																										ORDER BY 
																											mod_parceiro_adv_processo_log.data DESC");
                                                                while($rSqlLog = mysql_fetch_array($qSqlLog)) {
                                                                ?>
																<p>Usuário <b><?=$rSqlLog['sysusu_nome']?></b> setou para situação <b><?=$rSqlLog['idparceiro_adv_processo_tipo_de_acao_txt']?></b> esse cliente em <?=ajustaData($rSqlLog['data'],"d/m/Y");?></p>
                                                                <? } ?>
																<? 
																if(trim($row['criador'])=="0") {
																	$criador_nome_set = "Administrador";
																} else {
																	$criador_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$row['criador']."'")); 
																	$criador_nome_set = "".$criador_set['nome']."";
																}
																?>
                                                                <p>Usuário <b><?=$criador_nome_set?></b> cadastrou esse cliente em <?=ajustaData($row['data'],"d/m/Y");?></p>

                                                            </div>

                                                            <div id="arquivos" class="tab-pane <? if(trim($_REQUEST['var5'])=="arquivos") { ?>active<? } ?>" style="min-height:350px;">
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
                                                                <h4>Tamanho máximo permitido por arquivo: 350KB</h4>
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
                                                                 
                                                                        /*if(files[i].size>35000) {
																			alert("Não é possível fazer upload do arquivo ( "+files[i].name+" ), pois ultrapassou o limite máximo de 350KB por arquivo!");
																		} else {
																			var status = new createStatusbar(obj); //Using this we can set progress. AQUIIIIIIIIIIIIIIIII
																			status.setFileNameSize(files[i].name,files[i].size);
																			sendFileToServer(fd,status);
																		}*/

																		var status = new createStatusbar(obj); //Using this we can set progress. AQUIIIIIIIIIIIIIIIII
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
                                                        <button type="button" onclick="salvar_parceiro_adv_processo();" class="btn btn-success">Salvar</button>
                                                        <button type="button" onclick="salvar_continuar_editando_parceiro_adv_processo();" class="btn btn-primary">Salvar e continuar editando</button>

                                                    </div>

                                                    <? 
													if(trim($_REQUEST['var4'])=="") {
														$exibe_botoes = "1";
													} else {
														if(trim($_REQUEST['var3'])=="editar") {
															$idparceiro_adv_processo_tipo_form = "".$row['idparceiro_adv_processo_tipo']."";
														} else {
															$idparceiro_adv_processo_tipo_form = "".$_REQUEST['var4']."";
														}
														$rSqlTipoSet =  mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$idparceiro_adv_processo_tipo_form."'"));
														$nPermTipoSet = mysql_num_rows(mysql_query("SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND auth='1'")); 


														if(trim($sysperm['todos_parceiro_adv_processo'])==1) {
															$exibe_botoes = "1";
														} else {
															if(trim($nPermTipoSet)=="0") {
																$exibe_botoes = "0";
															} else {
																$exibe_botoes = "1";
															}
														}
													}
													if($exibe_botoes=="1") {
													?>
                                                    <div class="formSep">
                                                        <label class="req">Salvar e enviar para</label>
														<?
                                                        $qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE stat='1' ORDER BY ordem");
                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                             $nPermTipo = mysql_num_rows(mysql_query("SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
                        
                                                             if($nPermTipo==0) {
																 $auth = "0";
                                                             } else {
																 $rSqlPermTipo = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
																 $auth = "".$rSqlPermTipo['auth']."";
                                                             }
                        
                                                            if($auth=="1") {
                                                        ?>
                                                        <button type="button" onclick="salvar_parceiro_adv_processo_tipo('<?=$rSqlItem['id']?>');" class="btn-new" style="background-color:<?=$rSqlItem['cor']?>;border:1px solid <?=$rSqlItem['cor']?>;margin-bottom:5px;"><?=$rSqlItem['nome']?></button>
                                                        <? } } ?>
                                                    
                                                    </div>
                                                    <? } ?>


                                                </div>
                                                <? } ?>
                                                
                                                <div id="tb1_lista" class="tab-pane <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo"||trim($_REQUEST['var3'])=="acao") { ?>active<? } ?>">
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
                                                            <form id="form_lista" name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="parceiro_adv_processo_tipo_selecionada" id="parceiro_adv_processo_tipo_selecionada" value="0" />

                                                                <table id="example" cellspacing="0" width="100%" class="table table-striped table-condensed">
                                                            
                                                                    <thead>
                                                                        <tr>
                                                                            <th tamanho="0px" style="width:20px;" class="table_checkbox"><input type="checkbox" name="select_msgs" class="select_msgs ptip_se" title="Selecionar todos" data-tableid="dt_basic" /></th>
                                                                            <th tamanho="120px" style="width:80px;">Situação</th>
                                                                            <th tamanho="80px" style="width:80px;">ID</th>
                                                                            <th tamanho="90%">Cliente</th>
                                                                            <th tamanho="80px" style="width:80px;">CPF</th>
                                                                            <th tamanho="120px" style="width:150px;">Ação</th>
                                                                            <th tamanho="150px" style="width:150px;">Criador</th>
                                                                            <th tamanho="150px" style="width:150px;">N° do Processo</th>
                                                                            <th tamanho="0px" style="width:80px;">Ações</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tfoot>
                                                                        <tr>
                                                                            <th tamanho="0px" style="width:20px;" class="table_checkbox"></th>
                                                                            <th tamanho="80px" style="width:80px;">Situação</th>
                                                                            <th tamanho="80px" style="width:80px;">ID</th>
                                                                            <th tamanho="90%">Cliente</th>
                                                                            <th tamanho="80px" style="width:80px;">CPF</th>
                                                                            <th tamanho="150px" style="width:150px;">Ação</th>
                                                                            <th tamanho="150px" style="width:150px;">Criador</th>
                                                                            <th tamanho="150px" style="width:150px;">N° do Processo</th>
                                                                            <th tamanho="0px" style="width:80px;">Ações</th>
                                                                        </tr>
                                                                    </tfoot>
                                                             
                                                                </table>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo"||trim($_REQUEST['var3'])=="acao") { ?>
                                                <div id="tb1_novo" class="tab-pane">


                                                    <div class="tabbable tabs-left tabbable-bordered">
                                                        <ul class="nav nav-tabs">
                                                            <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Dados cadastrais</a></li>
                                                            <li><a data-toggle="tab" href="#tb3_b">Arquivos</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="add" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
        
                                                                    <input type="hidden" name="idparceiro_adv_processo_tipo" id="idparceiro_adv_processo_tipo" value="0">
        
                                                                    <? 
                                                                    $numeroUnicoGerado = geraCodReturn(); 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                                    <input type="hidden" name="criador" id="criador" value="<?=$sysusu['id']?>">
        
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Número do Processo</label>
                                                                        <input value="" class="span7" type="text" name="cod" id="cod" />
                                                                        <span class="help-block" style="width:100%;float:left;">Será preenchido após processo ajuizado</span>
                                                                    </div>
                                                                    -->
        
                                                                    <!--
                                                                    <div class="formSep">

                                                                        <h3>Processos Vinculados</h3>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Nome</label>
                                                                            <input value="" style="width:300px;" type="text" id="nome_parceiro_adv_processo_processo" placeholder="Nome para o processo vinculado"/>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Código</label>
                                                                            <input value="" style="width:300px;" type="text" id="cod_parceiro_adv_processo_processo" placeholder="Código para o processo vinculado"/>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <button type="button" onclick="javascript:salvar_lista_parceiro_adv_processo_processo();" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div id="lista_parceiro_adv_processo_processo" style="width:100%;float:left;">
                                                                            <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/parceiro_adv_processo/lista_parceiro_adv_processo_processo.php"); ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Processo criado por</label>
                                                                        <input type="hidden" name="criador" value="<?=$sysusu['id']?>">
                                                                        <input value="<?=$sysusu['nome']?>" class="span7" type="text" disabled="disabled" />
                                                                    </div>
                                                                    -->

                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label class="req">Ação</label>
                                                                            <select name="idparceiro_adv_processo_tipo_de_acao" id="idparceiro_adv_processo_tipo_de_acao">
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo_tipo_de_acao ORDER BY ordem");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                        <div class="formSep">
                                                                            <label class="req">Nome Completo</label>
                                                                            <input value="<?=strtoupper($row['nome'])?>" style="text-transform:uppercase;" class="span8" type="text" name="nome" id="nome" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>E-mail principal</label>
                                                                            <input value="<?=$row['email']?>" class="span12" type="text" name="email" id="email" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label class="req">CPF</label>
                                                                            <input class="span12 documento" value="<?=mascaraCpf($row['cpf'])?>" name="cpf" id="cpf" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>RG</label>
                                                                            <input class="span12" value="<?=$row['rg']?>" name="rg" id="rg" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Ocupação</label>
                                                                            <input class="span12" value="<?=$row['ocupacao']?>" name="ocupacao" id="ocupacao" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Nacionalidade</label>
                                                                            <input class="span12" value="<?=$row['nacionalidade']?>" name="nacionalidade" id="nacionalidade" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Estado Civil</label>
                                                                            <select name="estado_civil" id="estado_civil" class="span7">
                                                                                <option value="">---</option>
                                                                                <option value="Casado (a)" <? if($row['estado_civil']=="Casado (a)") { echo "selected"; } ?>>Casado (a)</option>
                                                                                <option value="Separado (a)" <? if($row['estado_civil']=="Separado (a)") { echo "selected"; } ?>>Separado (a)</option>
                                                                                <option value="Solteiro (a)" <? if($row['estado_civil']=="Solteiro (a)") { echo "selected"; } ?>>Solteiro (a)</option>
                                                                                <option value="Viúvo (a)" <? if($row['estado_civil']=="Viúvo (a)") { echo "selected"; } ?>>Viúvo (a)</option> 
                                                                                <option value="Divorciado (a)" <? if($row['estado_civil']=="Divorciado (a)") { echo "selected"; } ?>>Divorciado (a)</option> 
                                                                                <option value="Companheiro (a)" <? if($row['estado_civil']=="Companheiro (a)") { echo "selected"; } ?>>Companheiro (a)</option> 
                                                                            </select>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Telefone</label>
                                                                            <input value="<?=$row['telefone']?>" class="span6" type="text" name="telefone" id="telefone" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>CEP</label>
                                                                            <input value="<?=$row['cep']?>" style="width:90px;" type="text" name="cep" id="cep" />
                                                                            <span class="help-block">99999-999</span>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Endereço</label>
                                                                            <input value="<?=$row['rua']?>" class="span12" type="text" name="rua" id="rua" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Número</label>
                                                                            <input value="<?=$row['numero']?>" class="span6" type="text" name="numero" id="numero" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Complemento</label>
                                                                            <input value="<?=$row['complemento']?>" class="span9" type="text" name="complemento" id="complemento" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Bairro</label>
                                                                            <input value="<?=$row['bairro']?>" class="span9" type="text" name="bairro" id="bairro" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Cidade</label>
                                                                            <input value="<?=$row['cidade']?>" class="span9" type="text" name="cidade" id="cidade" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Estado</label>
                                                                            <input value="<?=$row['estado']?>" class="span9" type="text" name="estado" id="estado" />
                                                                        </div>

                                                                        <!--
                                                                        <div class="formSep">
                                                                            <label>Observação</label>
                                                                            <textarea name="obs" id="obs" class="span12" style="height:150px;"><?=$row['obs']?></textarea>
                                                                        </div>
                                                                        -->

                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Nome da Ação</label>
                                                                        <input value="" class="span10" type="text" name="nome_acao" id="nome_acao" />
                                                                    </div>

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
        
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Observações</label>
                                                                        <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                                        <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo com uma visão geral da tarefa a ser executada</span>
                                                                    </div>
                                                                    -->
        
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
                                                                    
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <span class="help-block" style="width:100%;float:left;margin-top:10px;">Para inserir os itens da tarefa, você deve primeiro "Salvar" a tarefa ou "Salvar e continuar editando"</span>
                                                                    </div>
                                                                    -->
        
                                                                    <div class="formSep">
                                                                        <button type="button" onclick="salvar_parceiro_adv_processo();" class="btn btn-success">Salvar</button>
                                                                        <button type="button" onclick="salvar_continuar_editando_parceiro_adv_processo();" class="btn btn-primary">Salvar e continuar editando</button>
                                                                        <button type="button" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                                    </div>
                                                                    
																	<? 
                                                                    if(trim($_REQUEST['var4'])=="") {
                                                                        $exibe_botoes = "1";
                                                                    } else {

																		$rSqlTipoSet =  mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$_REQUEST['var4']."'"));
                                                                        $nPermTipoSet = mysql_num_rows(mysql_query("SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND auth='1'")); 
																		
                                                                        if(trim($sysperm['todos_parceiro_adv_processo'])==1) {
                                                                            $exibe_botoes = "1";
                                                                        } else {
                                                                            if(trim($nPermTipoSet)=="0") {
                                                                                $exibe_botoes = "0";
                                                                            } else {
                                                                                $exibe_botoes = "1";
                                                                            }
                                                                        }
                                                                    }
                                                                    if($exibe_botoes=="1") {
                                                                    ?>
                                                                    <div class="formSep">
                                                                        <label class="req">Salvar e enviar para</label>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE stat='1' ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                             $nPermTipo = mysql_num_rows(mysql_query("SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
                                        
                                                                             if($nPermTipo==0) {
                                                                                 $auth = "0";
                                                                             } else {
                                                                                 $rSqlPermTipo = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
                                                                                 $auth = "".$rSqlPermTipo['auth']."";
                                                                             }
                                        
                                                                            if($auth=="1") {
                                                                        ?>
                                                                        <button type="button" onclick="salvar_parceiro_adv_processo_tipo('<?=$rSqlItem['id']?>');" class="btn-new" style="background-color:<?=$rSqlItem['cor']?>;border:1px solid <?=$rSqlItem['cor']?>;margin-bottom:5px;"><?=$rSqlItem['nome']?></button>
                                                                        <? } } ?>
                                                                    
                                                                    </div>
                                                                    <? } ?>

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
                                                                <h4>Tamanho máximo permitido por arquivo: 350KB</h4>
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
                                                                 
                                                                        /*if(files[i].size>35000) {
																			alert("Não é possível fazer upload do arquivo ( "+files[i].name+" ), pois ultrapassou o limite máximo de 350KB por arquivo!");
																		} else {
																			var status = new createStatusbar(obj); //Using this we can set progress. AQUIIIIIIIIIIIIIIIII
																			status.setFileNameSize(files[i].name,files[i].size);
																			sendFileToServer(fd,status);
																		}*/

																		var status = new createStatusbar(obj); //Using this we can set progress. AQUIIIIIIIIIIIIIIIII
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
