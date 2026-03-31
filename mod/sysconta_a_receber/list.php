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
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?>
												<? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_editar">Editando <?=$row['nome']?></a></li><? } ?>
												<? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Lista de Itens</a></li><? } ?>
                                                <? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_categorias">Categorias</a></li><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_tipo_pagamento">Tipos de Pagamento</a></li><? } ?>
                                            </ul>
											<script>
                                              $(document).ready(function() {
                                                //* form validation
                                                forms.simple();

												$("#valor").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_desconto").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_juro").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_taxa").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_pago").maskMoney({ decimal:",", thousands:".", allowZero:true});

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
            
                                                //* masked inputs
                                                beoro_maskedInputs.init();

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
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };
			
											//* switch buttons
											beoro_switchButtons = {
												init: function() {
													if($('#mostrar_agenda').length) { $("#mostrar_agenda").iButton(); }
													if($('#mostrar_dashboard').length) { $("#mostrar_dashboard").iButton(); }
													if($('#pago').length) {
														$("#pago").iButton({
															width:50,
															change: function ($input){
																if( $("#pago").is(':checked') ){
																	$("#valor_desconto").prop( "disabled", false );
																	$("#valor_taxa").prop( "disabled", false );
																	$("#valor_juro").prop( "disabled", false );
																	atualiza_sysconta_a_pagar_valor_pago();
																} else {
																	$("#valor_desconto").prop( "disabled", true );
																	$("#valor_taxa").prop( "disabled", true );
																	$("#valor_juro").prop( "disabled", true );
																	atualiza_sysconta_a_pagar_valor_pago();
																}
															}
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
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
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
													if($('#data_referencia').length) {
														$('#data_referencia').datepicker()
													}
													if($('#data_emissao').length) {
														$('#data_emissao').datepicker()
													}
													if($('#data_vencimento').length) {
														$('#data_vencimento').datepicker()
													}
													if($('#data_pagamento').length) {
														$('#data_pagamento').datepicker()
													}
												}
											};

                                            //* masked inputs
                                            beoro_maskedInputs = {
                                                init: function() {
                                                    $("#cep").inputmask('99999-999');
                                                    $("#cpf").inputmask('999.999.999-99');
                                                    $("#cnpj").inputmask('99.999.999/9999-99');
                                                }
                                            };

											//* enchanced select box
											beoro_enchancedSelect = {
												init: function() {
													if($('#idsyscliente').length) {
														$("#idsyscliente").select2({
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
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="iditem" id="iditem_set" value="<?=$_REQUEST['var4']?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = $row['numeroUnico']; 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                
                
                                                            <div class="tabbable tabs-left tabbable-bordered">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#tb3_a">Dados da conta</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_b">Arquivos</a></li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div id="tb3_a" class="tab-pane active" style="min-height:350px;">
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Escolha a categoria</label>
                                                                                <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$mod."_categoria WHERE stat='1' ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['id'.$mod.'_categoria']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                        
                                                                        <div class="formSep">
                                                                            <label class="req">Descrição da conta</label>
                                                                            <input value="<?=$row['nome']?>" class="span8" type="text" name="nome" id="nome" />
                                                                        </div>
                        
                                                                        <!--
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Tipo de Perfil</label>
                                                                                <select name="tipo_destinatario" id="tipo_destinatario" onchange="sysconta_a_receber_tipo_destinatario();">
                                                                                    <option value="">---</option>
                                                                                    <option value="syscliente" <? if($row['tipo_destinatario']=="syscliente") { echo "selected"; } ?>>Cliente</option>
                                                                                    <option value="sysfornecedor" <? if($row['tipo_destinatario']=="sysfornecedor") { echo "selected"; } ?>>Fornecedor</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-left:5px;margin-top:29px;margin-right:5px;">
                                                                                <img id="img-iddestinatario" src="<?=$link?>template/img/any.png" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label id="label-perfil">&nbsp;</label>
                                                                                <select name="idsyscliente" id="idsyscliente" <? if($row['tipo_destinatario']=="syscliente") { } else { ?> style="display:none;"<? } ?>>
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM syscliente WHERE stat='1' ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsyscliente']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <select name="idsysfornecedor" id="idsysfornecedor" <? if($row['tipo_destinatario']=="sysfornecedor") {  } else { ?> style="display:none;"<? } ?>>
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysfornecedor WHERE stat='1' ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsysfornecedor']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div id="div-add-syscliente" style="float:left;margin-top:30px;<? if($row['tipo_destinatario']=="syscliente") { ?>display:none;<? } ?>">
                                                                            <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/syscliente/form.php?sufixoS=" title="Adicionar um cliente"><p style="color:#368CA9;"><b>+ Adicionar um cliente</b></p></a>
                                                                            </div>
                                                                            <div id="div-add-sysfornecedor" style="float:left;margin-top:30px;<? if($row['tipo_destinatario']=="sysfornecedor") { ?>display:none;<? } ?>">
                                                                            <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysfornecedor/form.php?sufixoS=" title="Adicionar um fornecedor"><p style="color:#368CA9;"><b>+ Adicionar um fornecedor</b></p></a>
                                                                            </div>
                                                                        </div>
                                                                        -->

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:300px;">
                                                                                <label id="label-perfil">Cliente</label>
                                                                                <select name="idsyscliente" id="idsyscliente" class="span12">
                                                                                    <option value=""></option>
                                                                                    <?
                                                                                    $qSqlCat = mysql_query("SELECT * FROM syscliente_categoria WHERE stat='1' ORDER BY nome");
                                                                                    while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                                    ?>
                                                                                    <optgroup label="<?= $rSqlCat['nome'] ?>">
                                                                                        <?
                                                                                        $qSqlItem = mysql_query("SELECT * FROM syscliente WHERE stat='1' AND idsyscliente_categoria='".$rSqlCat['id']."' ORDER BY nome");
                                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                        ?>
                                                                                        <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsyscliente']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                        <? } ?>
                                                                                    </optgroup>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div id="div-add-syscliente" style="float:left;margin-top:30px;display:block;">
                                                                            <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/syscliente/form.php?sufixoS=" title="Adicionar um cliente"><p style="color:#368CA9;"><b>+ Adicionar um cliente</b></p></a>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <label>Tipo de Pagamento</label>
                                                                            <select name="id<?=$mod?>_tipo_pagamento" id="id<?=$mod?>_tipo_pagamento">
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM ".$mod."_tipo_pagamento WHERE stat='1' ORDER BY ordem");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>" <? if($row['id'.$mod.'_tipo_pagamento']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Referência</label>
                                                                                <select name="mes_referencia" style="float:left;width:70px;margin-right:5px;">
                                                                                    <option value="">---</option>
                                                                                    <? for ($i = 1; $i <= 12; $i++) { ?>
                                                                                    <option value="<?=$i?>"  <? if($i==$row['mes_referencia']) { echo "selected"; } ?>><?=$i?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <select name="ano_referencia" style="float:left;width:70px;">
                                                                                    <option value="">---</option>
                                                                                    <? $ano_ini = date("Y") - 5; $ano_fim = date("Y") + 25; ?>
																					<? for ($i = $ano_ini; $i <= $ano_fim; $i++) { ?>
                                                                                    <option value="<?=$i?>"  <? if($i==$row['ano_referencia']) { echo "selected"; } ?>><?=$i?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Periodicidade</label>
                                                                                <select name="periodicidade" class="span12">
                                                                                    <option value="">---</option>
                                                                                    <? for ($i = 1; $i <= 24; $i++) { ?>
                                                                                    <option value="<?=$i?>"  <? if($i==$row['periodicidade']) { echo "selected"; } ?>><?=$i?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Data de emissão</label>
                                                                                <div class="input-append date" id="data_emissao" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_emissao'])==""||trim($row['data_emissao'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_emissao'],"d/m/Y"); } ?>">
                                                                                    <input class="span8" size="16" name="data_emissao" value="<? if(trim($row['data_emissao'])==""||trim($row['data_emissao'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_emissao'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Data de vencimento</label>
                                                                                <div class="input-append date" id="data_vencimento" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_vencimento'])==""||trim($row['data_vencimento'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_vencimento'],"d/m/Y"); } ?>">
                                                                                    <input class="span8" size="16" name="data_vencimento" value="<? if(trim($row['data_vencimento'])==""||trim($row['data_vencimento'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_vencimento'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Valor</label>
                                                                                <div class="input-prepend">
                                                                                <span class="add-on">R$</span> <input value="<?=$row['valor']?>" class="span9" type="text" name="valor" id="valor" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;width:100%;">
                                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                    <label style="font-size:10px;">Pago</label>
                                                                                    <input type="checkbox" name="pago" id="pago" <? if(trim($row['pago'])==1) { echo " checked"; } ?> class="pago {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                                    <label>Data de pagamento</label>
                                                                                    <div class="input-append date" id="data_pagamento" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_pagamento'])==""||trim($row['data_pagamento'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_pagamento'],"d/m/Y"); } ?>">
                                                                                        <input class="span8" size="16" name="data_pagamento" value="<? if(trim($row['data_pagamento'])==""||trim($row['data_pagamento'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_pagamento'],"d/m/Y"); } ?>" type="text">
                                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                                    <label>Desconto</label>
                                                                                    <div class="input-prepend">
                                                                                    <span class="add-on">R$</span> <input value="<?=$row['valor_desconto']?>" class="span9" type="text"  <? if(trim($row['pago'])==1) { } else { ?>disabled="disabled"<? } ?> name="valor_desconto" id="valor_desconto" onkeyup="atualiza_sysconta_a_pagar_valor_pago();" />
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                                    <label>Taxas</label>
                                                                                    <div class="input-prepend">
                                                                                    <span class="add-on">R$</span> <input value="<?=$row['valor_taxa']?>" class="span9" type="text"  <? if(trim($row['pago'])==1) { } else { ?>disabled="disabled"<? } ?> name="valor_taxa" id="valor_taxa" onkeyup="atualiza_sysconta_a_pagar_valor_pago();" />
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                                    <label>Juros</label>
                                                                                    <div class="input-prepend">
                                                                                    <span class="add-on">R$</span> <input value="<?=$row['valor_juro']?>" class="span9" type="text"  <? if(trim($row['pago'])==1) { } else { ?>disabled="disabled"<? } ?> name="valor_juro" id="valor_juro" onkeyup="atualiza_sysconta_a_pagar_valor_pago();" />
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;margin-right:5px;width:150px;">
                                                                                    <label>Valor Pago</label>
                                                                                    <div class="input-prepend">
                                                                                    <span class="add-on">R$</span> <input value="<?=$row['valor_pago']?>" class="span9" type="text"  <? if(trim($row['pago'])==1) { } else { ?>disabled="disabled"<? } ?> name="valor_pago" id="valor_pago" onfocus="atualiza_sysconta_a_pagar_valor_pago();" />
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;margin-left:-8px;margin-top:29px;">
                                                                                    <img id="img-valor-pago" src="<?=$link?>template/img/any.png" />
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <? 
                                                                        if(trim($row['obs'])=="") {  
                                                                            $texto = ""; 
                                                                            $tamanho_texto = 150; 
                                                                        } else {
                                                                            $texto = $row['obs']; 
                                                                            $tamanho_texto = 150 - strlen($row['obs']); 
                                                                        }
                                                                        ?>
                                                                        <div class="formSep">
                                                                            <label>Observações</label>
                                                                            <textarea name="obs" id="obs_editar" onkeyup="controle_meta_description('obs_editar','texto_seo_google','obs_editar_contador','<?=$texto?>','150');" class="span12" style="height:150px;"><?=$texto?></textarea>
                                                                            <div style="float:left;width:100%;">O campo esta limitado à 150 caracteres, <span style="color:#090;" id="obs_editar_contador"><?=$tamanho_texto?></span> restantes.</div>
                                                                        </div>
                            
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
                                                                                <input type="radio" name="stat" id="stat1" value="0" <? if($row['stat']==0) { echo "checked"; } ?> >
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="stat" id="stat2" value="1" <? if($row['stat']==1) { echo "checked"; } ?> >
                                                                                sim
                                                                            </label>
                                                                        </div>	
                                                                    </div>

                                                                    <div id="tb3_b" class="tab-pane" style="min-height:350px;">
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

                                                            <div class="formSep">
                                                                <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                                <button type="button" onclick="clonar_item();" class="btn btn-beoro-6">Clonar este produto</button>
                                                                <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                                <? } ?>
                                                            </div>
                                                        </form>
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
                                                            <form name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <table id="dt_basic" class="table table-striped table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:20px;" class="table_checkbox"><input type="checkbox" name="select_msgs" class="select_msgs ptip_se" title="Selecionar todos" data-tableid="dt_basic" /></th>
                                                                    <th style="width:150px;">Categoria</th>
                                                                    <th>Nome</th>
                                                                    <th>Cliente</th>
                                                                    <th style="width:110px;">Valor Original</th>
                                                                    <th style="width:110px;">Desconto</th>
                                                                    <th style="width:110px;">Taxa</th>
                                                                    <th style="width:110px;">Juros</th>
                                                                    <th style="width:110px;">Valor Pago</th>
                                                                    <th style="width:160px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY data DESC, dataModificacao DESC");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                     $url_limpa = transformaCaractere($rSql['nome']);
                                                                ?>
                                                                <script>
																$(function(){
																	 
																	$('#nome-<?=$rSql['id']?>').editable({
																		validate: function(value) {
																		   if($.trim(value) == '') { 
																		    return 'Este campo é obrigatório';
																		   } else {
																			   salva_campo_tabela('nome','<?=$rSql['id']?>','<?=$mod?>',value);
																		   }
																		}
																	});
																	
																});
                                                                </script>
																
                                                                <tr id="linha-<?=$rSql['id']?>">
                                                                    <td style="vertical-align:middle;" class="nolink"><input type="checkbox" name="msg_sel[]" class="select_msg" value="<?=$rSql['id']?>" /></td>

                                                                    <? $item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_categoria WHERE id='".$rSql['id'.$mod.'_categoria']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$item['nome']?></td>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <? $destinatario = mysql_fetch_array(mysql_query("SELECT * FROM ".$rSql['tipo_destinatario']." WHERE id='".$rSql['id'.$rSql['tipo_destinatario'].'']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$destinatario['nome']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor_desconto']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor_taxa']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor_juro']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor_pago']?></td>
                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;">
                                                                            <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysconta_a_receber/form-boleto.php?idContaS=<?=$rSql['id']?>" title="Imprimir Boleto"><img src="<?=$link?>template/img/icones_novos/16/boleto.png" /></a>
                                                                            </div>
																		<? } ?>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" class="btn-mini ptip_se" title="Enviar por e-mail"><img src="<?=$link?>template/img/icones_novos/16/enviar-boleto.png" /></a></div>
																		<? } ?>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div id="pago-<?=$rSql['id']?>-1" style="float:left;width:16px;margin-left:10px;display:<? if(trim($rSql['pago'])=="1") { ?>block<? } else { ?>none<? } ?>;"><a href="javascript:void(0);" onclick="pago_caixa('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Extornar"><img src="<?=$link?>template/img/icones_novos/16/bullet_verde.png" /></a></div>
                                                                            <div id="pago-<?=$rSql['id']?>-0" style="float:left;width:16px;margin-left:10px;display:<? if(trim($rSql['pago'])=="0") { ?>block<? } else { ?>none<? } ?>;"><a href="javascript:void(0);" onclick="pago_caixa('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn-mini ptip_se" title="Pagar"><img src="<?=$link?>template/img/icones_novos/16/bullet_vermelho.png" /></a></div>
																		<? } ?>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a></div>
																		<? } ?>
                                                                        <? if(trim($sysperm['excluir_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="remover_item_caixa('<?=$rSql['id']?>','<?=$mod?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a></div>
																		<? } ?>
                                                                        <? if(trim($rSql['stat'])=="1") { ?>
																			<? if(trim($sysperm['despublicar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="muda_stat_caixa('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a></div>
                                                                            <? } else { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a></div>
                                                                            <? } ?>
                                                                        <? } else { ?>
																			<? if(trim($sysperm['publicar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="muda_stat_caixa('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a></div>
                                                                            <? } else { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a></div>
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
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" id="idacaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                            <div class="tabbable tabs-left tabbable-bordered">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#tb3_a">Dados da conta</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_b">Arquivos</a></li>
                                                                </ul>
                                                                <div class="tab-content">

                                                                    <div id="tb3_a" class="tab-pane active" style="min-height:350px;">
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Escolha a categoria</label>
                                                                                <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$mod."_categoria WHERE stat='1' ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                        
                                                                        <div class="formSep">
                                                                            <label class="req">Descrição da conta</label>
                                                                            <input value="" class="span8" type="text" name="nome" id="nome" />
                                                                        </div>
                        
                                                                        <!--
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Tipo de Perfil</label>
                                                                                <select name="tipo_destinatario" id="tipo_destinatario" onchange="sysconta_a_receber_tipo_destinatario();">
                                                                                    <option value="">---</option>
                                                                                    <option value="syscliente">Cliente</option>
                                                                                    <option value="sysfornecedor">Fornecedor</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-left:5px;margin-top:29px;margin-right:5px;">
                                                                                <img id="img-iddestinatario" src="<?=$link?>template/img/any.png" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label id="label-perfil">&nbsp;</label>
                                                                                <select name="idsyscliente" id="idsyscliente" style="display:none;">
                                                                                    <option value="">---</option>
                                                                                </select>
                                                                                <select name="idsysfornecedor" id="idsysfornecedor" style="display:none;">
                                                                                    <option value="">---</option>
                                                                                </select>
                                                                            </div>
                                                                            <div id="div-add-syscliente" style="float:left;margin-top:30px;display:none;">
                                                                            <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/syscliente/form.php?sufixoS=" title="Adicionar um cliente"><p style="color:#368CA9;"><b>+ Adicionar um cliente</b></p></a>
                                                                            </div>
                                                                            <div id="div-add-sysfornecedor" style="float:left;margin-top:30px;display:none;">
                                                                            <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysfornecedor/form.php?sufixoS=" title="Adicionar um fornecedor"><p style="color:#368CA9;"><b>+ Adicionar um fornecedor</b></p></a>
                                                                            </div>
                                                                        </div>
                                                                        -->
                        
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:300px;">
                                                                                <label id="label-perfil">Cliente</label>
                                                                                <select name="idsyscliente" id="idsyscliente" class="span12">
                                                                                    <option value=""></option>
                                                                                    <?
                                                                                    $qSqlCat = mysql_query("SELECT * FROM syscliente_categoria WHERE stat='1' ORDER BY nome");
                                                                                    while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                                    ?>
                                                                                    <optgroup label="<?= $rSqlCat['nome'] ?>">
                                                                                        <?
                                                                                        $qSqlItem = mysql_query("SELECT * FROM syscliente WHERE stat='1' AND idsyscliente_categoria='".$rSqlCat['id']."' ORDER BY nome");
                                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                        ?>
                                                                                        <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                        <? } ?>
                                                                                    </optgroup>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div id="div-add-syscliente" style="float:left;margin-top:30px;display:block;">
                                                                            <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/syscliente/form.php?sufixoS=" title="Adicionar um cliente"><p style="color:#368CA9;"><b>+ Adicionar um cliente</b></p></a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Tipo de Pagamento</label>
                                                                            <select name="id<?=$mod?>_tipo_pagamento" id="id<?=$mod?>_tipo_pagamento">
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM ".$mod."_tipo_pagamento WHERE stat='1' ORDER BY ordem");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Referência</label>
                                                                                <select name="mes_referencia" style="float:left;width:70px;margin-right:5px;">
                                                                                    <option value="">---</option>
                                                                                    <? for ($i = 1; $i <= 12; $i++) { ?>
                                                                                    <option value="<?=$i?>"><?=$i?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <select name="ano_referencia" style="float:left;width:70px;">
                                                                                    <option value="">---</option>
                                                                                    <? $ano_ini = date("Y") - 5; $ano_fim = date("Y") + 25; ?>
																					<? for ($i = $ano_ini; $i <= $ano_fim; $i++) { ?>
                                                                                    <option value="<?=$i?>"><?=$i?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Periodicidade</label>
                                                                                <select name="periodicidade" class="span12">
                                                                                    <option value="">---</option>
                                                                                    <? for ($i = 1; $i <= 24; $i++) { ?>
                                                                                    <option value="<?=$i?>"><?=$i?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Data de emissão</label>
                                                                                <div class="input-append date" id="data_emissao" data-date-format="dd/mm/yyyy" data-date="">
                                                                                    <input class="span8" size="16" name="data_emissao" value="" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Data de vencimento</label>
                                                                                <div class="input-append date" id="data_vencimento" data-date-format="dd/mm/yyyy" data-date="">
                                                                                    <input class="span8" size="16" name="data_vencimento" value="" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:150px;">
                                                                                <label>Valor</label>
                                                                                <div class="input-prepend">
                                                                                <span class="add-on">R$</span> <input value="" class="span9" type="text" name="valor" id="valor" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;width:100%;">
                                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                    <label style="font-size:10px;">Pago</label>
                                                                                    <input type="checkbox" name="pago" id="pago" class="pago {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                                    <label>Data de pagamento</label>
                                                                                    <div class="input-append date" id="data_pagamento" data-date-format="dd/mm/yyyy" data-date="">
                                                                                        <input class="span8" size="16" name="data_pagamento" value="" type="text">
                                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                                    <label>Desconto</label>
                                                                                    <div class="input-prepend">
                                                                                    <span class="add-on">R$</span> <input value="" class="span9" type="text" id="valor_desconto" name="valor_desconto" disabled="disabled" onkeyup="atualiza_sysconta_a_pagar_valor_pago();" />
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                                    <label>Taxas</label>
                                                                                    <div class="input-prepend">
                                                                                    <span class="add-on">R$</span> <input value="" class="span9" type="text" id="valor_taxa" name="valor_taxa" disabled="disabled" onkeyup="atualiza_sysconta_a_pagar_valor_pago();" />
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                                    <label>Juros</label>
                                                                                    <div class="input-prepend">
                                                                                    <span class="add-on">R$</span> <input value="" class="span9" type="text" id="valor_juro" name="valor_juro" disabled="disabled" onkeyup="atualiza_sysconta_a_pagar_valor_pago();" />
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                                    <label>Valor Pago</label>
                                                                                    <div class="input-prepend">
                                                                                    <span class="add-on">R$</span> <input value="" class="span9" type="text" name="valor_pago" id="valor_pago" disabled="disabled" onfocus="atualiza_sysconta_a_pagar_valor_pago();" />
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;margin-left:-8px;margin-top:29px;">
                                                                                    <img id="img-valor-pago" src="<?=$link?>template/img/any.png" />
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Observações</label>
                                                                            <textarea name="obs" id="obs" onkeyup="controle_meta_description('obs','texto_seo_google','obs_contador','','150');" class="span12" style="height:150px;"></textarea>
                                                                            <div style="float:left;width:100%;">O campo esta limitado à 150 caracteres, <span style="color:#090;" id="obs_contador"><?=$tamanho_texto?></span> restantes.</div>
                                                                        </div>
                        
                                                                        <div class="formSep">
                                                                            <label>Mostrar na Agenda ?</label>
                                                                            <input type="checkbox" name="mostrar_agenda" id="mostrar_agenda" checked="checked" class="mostrar_agenda {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <label>Mostrar no Dashboard ?</label>
                                                                            <input type="checkbox" name="mostrar_dashboard" id="mostrar_dashboard" checked="checked" class="mostrar_dashboard {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label class="req">Ativo ?</label>
                                                                            <label class="radio" style="color:#C00;">
                                                                                <input type="radio" name="stat" id="stat1" value="0">
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="stat" id="stat2" value="1" checked="checked" >
                                                                                sim
                                                                            </label>
                                                                        </div>	
        
                                                                    </div>

                                                                    <div id="tb3_b" class="tab-pane" style="min-height:350px;">
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
                                                            
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <? } ?>

                                                <div id="tb1_categorias" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>_categoria" />
                
                                                            <? 
                                                            $numeroUnicoGeradoCategoria = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico_categoria" value="<?=$numeroUnicoGeradoCategoria?>">

                                                            <div class="formSep">
                                                                <label class="req">Ordem</label>
                                                                <select id="ordem_categoria" style="width:50px;">
																	<?
                                                                    $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_categoria"));
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
                                                                    <input value="" style="width:350px;" type="text" id="nome_categoria" onkeyup="controle_url_amigavel_apenas('nome_categoria','slug');" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Slug</label>
                                                                    <input value="" style="width:550px;" type="text" onkeyup="controle_url_amigavel_apenas('slug','slug');" id="slug" />
                                                                    <span class="help-block">O "slug" é uma versão amigável da URL. Normalmente, é todo em minúsculas e contém apenas letras, números e hífens.</span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="formSep">
                                                                <button type="button" onclick="salvar_categoria('<?=$mod?>','_categoria');" class="btn btn-primary">Adicionar</button>
                                                            </div>
                                                            <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de categorias</div>
                                                                <div id="lista_categoria_itens" style="width:100%;float:left;">
																	<? $subLocalGet = "_categoria"; include("./acoes/sysgeral/lista_categoria.php"); ?>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div id="tb1_tipo_pagamento" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                
                                                            <? 
                                                            $numeroUnicoGeradoCategoria = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico_tipo_pagamento" value="<?=$numeroUnicoGeradoCategoria?>">

                                                            <div class="formSep">
                                                                <label class="req">Ordem</label>
                                                                <select id="ordem_tipo_pagamento" style="width:50px;">
																	<?
                                                                    $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_tipo_pagamento"));
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
                                                                    <input value="" style="width:350px;" type="text" id="nome_tipo_pagamento" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <button type="button" onclick="salvar_sysconta_a_pagar_tipo_pagamento('<?=$mod?>','_tipo_pagamento');" class="btn btn-primary">Adicionar</button>
                                                            </div>
                                                            <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de status</div>
                                                                <div id="lista_tipo_pagamento_itens" style="width:100%;float:left;">
																	<? $subLocalGet = "_tipo_pagamento"; include("./acoes/sysconta_a_pagar/lista_sysconta_a_pagar_tipo_pagamento.php"); ?>
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
