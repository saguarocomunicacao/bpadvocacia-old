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
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_categorias">Categorias</a></li><? } ?>
                                            </ul>
											<script>
                                              $(document).ready(function() {
                                                //* form validation
                                                forms.simple();
            
												$("#valor_real").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_juros").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_desconto").maskMoney({ decimal:",", thousands:".", allowZero:true});

												<? if(trim($_REQUEST['var3'])=="") { } else { ?>
												$("#valor_real_editar").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_juros_editar").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_desconto_editar").maskMoney({ decimal:",", thousands:".", allowZero:true});
												<? } ?>

                                                //* datatables
                                                beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
            
												//* switch buttons
												beoro_switchButtons.init();
			
												beoro_select_row.init();
										
												//* WYSIWG Editor
												beoro_wysiwg.init();

												//* datepicker
												beoro_datepicker.init();
                                            });
            
                                            //* form validation
                                            forms = {
                                                simple: function() {
                                                    if($('#form_<?=$mod?>').length) {
                                                        $('#form_<?=$mod?>').validate({
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
                                                                nome: { required: true }
                                                            },
                                                            invalidHandler: function(form, validator) {
                                                                // callback
                                                            }
                                                        })
                                                    }
                                                    <? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#form_<?=$mod?>_editar').length) {
                                                        $('#form_<?=$mod?>_editar').validate({
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
                                                                nome_editar: { required: true }
                                                            },
                                                            invalidHandler: function(form, validator) {
                                                                // callback
                                                            }
                                                        })
                                                    }
													<? } ?>
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
															"aaSorting": [[ 1, "asc" ]],
															"aoColumns": [
																{ "bSortable": false },
																{ "bSortable": false },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "bSortable": false },
																{ "bSortable": false },
																{ "bSortable": false },
																{ "bSortable": false },
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
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#texto_editar').length) { 
														CKEDITOR.replace( 'texto_editar', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
												}
											};

											//* switch buttons
											beoro_switchButtons = {
												init: function() {
													if($('#importante').length) { $("#importante").iButton(); }
													if($('#enviar_email').length) { $("#enviar_email").iButton(); }
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#importante_editar').length) { $("#importante_editar").iButton(); }
													if($('#enviar_email_editar').length) { $("#enviar_email_editar").iButton(); }
													<? } ?>
												}
											};

											//* datepicker
											beoro_datepicker = {
												init: function() {
													if($('#data_emissao').length) {
														$('#data_emissao').datepicker()
													}
													if($('#data_vencimento').length) {
														$('#data_vencimento').datepicker()
													}
													if($('#data_pagamento').length) {
														$('#data_pagamento').datepicker()
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#data_emissao_editar').length) {
														$('#data_emissao_editar').datepicker()
													}
													if($('#data_vencimento_editar').length) {
														$('#data_vencimento_editar').datepicker()
													}
													if($('#data_pagamento_editar').length) {
														$('#data_pagamento_editar').datepicker()
													}
													<? } ?>
												}
											};
                                            </script>
                                            <div class="tab-content">

                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="form_<?=$mod?>_editar">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="editar" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = $row['numeroUnico']; 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                            <? 
                                                            $CodFatura = $row['cod']; 
                                                            ?>
                                                            <input type="hidden" name="cod" id="cod" value="<?=strtoupper($CodFatura)?>">
                                                            
                                                            <div class="formSep" style="font-size:25px;">Código <b>#<?=strtoupper($CodFatura)?></b></div>

                                                            <div class="formSep">
                                                                <label>Categoria</label>
                                                                <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_categoria ORDER BY ordem");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['id'.$mod.'_categoria']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <span class="help-block" style="width:100%;float:left;">Selecione a categoria à qual pertence este item</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Forma de Pagamento</label>
                                                                <select name="idforma_pagamento" id="idforma_pagamento">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."forma_pagamento ORDER BY nome");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idforma_pagamento']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <span class="help-block" style="width:100%;float:left;">Selecione a forma de pagamento que será utilizada</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Banco</label>
                                                                <select name="idbanco" id="idbanco">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."banco ORDER BY nome");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idbanco']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <span class="help-block" style="width:100%;float:left;">Caso este valor influencie na movimentação de algum banco cadastrado, selecione o mesmo</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Marcar como importante ?</label>
                                                                    <input type="checkbox" name="importante" id="importante_editar" <? if(trim($row['importante'])==1) { echo " checked"; } ?> class="importante {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Marque como importante para este item aparecer como importante na sua listagem</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Deseja receber notificação por e-mail ?</label>
                                                                    <input type="checkbox" name="enviar_email" id="enviar_email_editar" <? if(trim($row['enviar_email'])==1) { echo " checked"; } ?> class="enviar_email {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Marque caso você queria que seja enviado uma notificação sobre este item para o email do criador do mesmo</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Quantos dias de antecedência do vencimento</label>
                                                                <select name="enviar_email_dias" id="enviar_email_dias" style="width:70px;">
                                                                    <option value="">---</option>
                                                                    <? 
																	for ($i = 1; $i <= 5; $i++) { 
																	?>
                                                                    <option value="<?= $i ?>" <? if($i==$row['enviar_email_dias']) { echo "selected"; } ?>><?=$i?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <span class="help-block" style="width:100%;float:left;">Selecione com qual antecedência você deseja receber a notificação por e-mail sobre este item</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Título</label>
                                                                    <input value="<?=$row['nome']?>" class="span7" type="text" name="nome" id="nome_editar" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Código de Barra</label>
                                                                    <input value="<?=$row['codigo_barra']?>" class="span7" type="text" name="codigo_barra" id="codigo_barra_editar" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Se você possui leitor de código de barras, posicione o cursor sobre o campo e utilize seu leitor</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Nota Fiscal</label>
                                                                    <input value="<?=$row['nf']?>" class="span7" type="text" name="nf" id="nf" />
                                                                </div>
                                                            </div>
                                                            

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Valor Original</label>
                                                                    <input value="<?=$row['valor_real']?>" style="width:150px;" type="text" name="valor_real" id="valor_real_editar" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Valor dos Juros</label>
                                                                    <input value="<?=$row['valor_juros']?>" style="width:150px;" type="text" name="valor_juros" id="valor_juros_editar" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Valor do Desconto</label>
                                                                    <input value="<?=$row['valor_desconto']?>" style="width:150px;" type="text" name="valor_desconto" id="valor_desconto_editar" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data de Emissão</label>
                                                                    <input class="span8" value="<? if(trim($row['data_emissao'])=="") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_emissao'],"d/m/Y"); } ?>" data-date-format="dd/mm/yyyy" name="data_emissao" id="data_emissao_editar" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data de Vencimento</label>
                                                                    <input class="span8" value="<? if(trim($row['data_vencimento'])=="") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_vencimento'],"d/m/Y"); } ?>" data-date-format="dd/mm/yyyy" name="data_vencimento" id="data_vencimento_editar" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data de Pagamento</label>
                                                                    <input class="span8" value="<? if(trim($row['data_pagamento'])==""||trim($row['data_pagamento'])=="0000-00-00") { echo ""; } else { ajustaDataSemHora($row['data_pagamento'],"d/m/Y"); } ?>" data-date-format="dd/mm/yyyy" name="data_pagamento" id="data_pagamento_editar" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Anexo</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail">
                                                                    <? if(trim($row['anexo'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['anexo']?>"><?=$row['anexo']?></a>
                                                                    <? } ?>
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <? if(trim($row['anexo'])=="") { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span class="fileupload-new">Selecionar arquivo</span>
                                                                        <span class="fileupload-exists">Alterar</span>
                                                                        <input name="anexo" type="file">
                                                                    </span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                    <? } else { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span>Alterar</span>
                                                                        <input name="anexo" type="file">
                                                                    </span>
                                                                    <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>_item','anexo');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                    <? } ?>
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Anexe um arquivos como imagens, pdf ou outros à este item, deixando disponível para download futuro</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Observação</label>
                                                                <textarea name="texto" id="texto_editar" class="span12" style="height:150px;"><?=$row['texto']?></textarea>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:10px;">Escreva aqui algum texto de observação ou descrição deste item</span>
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
                                                            
                                                            <div class="formSep">
                                                                <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                <button type="submit" class="btn btn-success">Salvar</button>
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
                                                                    <th style="width:150px;">Código</th>
                                                                    <th>Título</th>
                                                                    <th style="width:150px;">Valor Original</th>
                                                                    <th style="width:150px;">Juros</th>
                                                                    <th style="width:150px;">Desconto</th>
                                                                    <th style="width:150px;">Data de Vencimento</th>
                                                                    <th style="width:150px;">Data do Pagamento</th>
                                                                    <th style="width:110px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY data_emissao");
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
                                                                    <? $item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_categoria WHERE id='".$rSql['id'.$mod.'_categoria']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$item['nome']?></td>
                                                                    <td style="vertical-align:middle;">#<?=$rSql['cod']?></td>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Título" data-placeholder="Digite um Título" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor_real']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor_juros']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor_desconto']?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['data_vencimento'])==""||trim($rSql['data_vencimento'])=="0000-00-00") { } else { ajustaData($rSql['data_vencimento'],"d/m/Y"); } ?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['data_pagamento'])==""||trim($rSql['data_pagamento'])=="0000-00-00") { } else { ajustaData($rSql['data_pagamento'],"d/m/Y"); } ?></td>
                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">
																		<? if(trim($rSql['importante'])=="1") { ?>
																			<? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <a href="javascript:void(0);" onclick="muda_importancia('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Retirar de importante"><img src="<?=$link?>template/img/icones_novos/16/destaque-1.png" /></a>
                                                                            <? } else { ?>
                                                                            <a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Retirar de importante"><img src="<?=$link?>template/img/icones_novos/16/destaque-1.png" /></a>
                                                                            <? } ?>
                                                                        <? } else { ?>
                                                                            <a href="javascript:void(0);" class="btn-mini ptip_se"><img src="<?=$link?>template/img/any.png" style="width:16px;height:16px;" /></a>
                                                                        <? } ?>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a><? } ?>
                                                                        <? if(trim($sysperm['excluir_'.$mod.''])==1) { ?><a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$mod?>','NAO','');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a><? } ?>
                                                                        <? if(trim($rSql['stat'])=="1") { ?>
																			<? if(trim($sysperm['despublicar_'.$mod.''])==1) { ?>
                                                                            <a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                            <? } else { ?>
                                                                            <a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                            <? } ?>
                                                                        <? } else { ?>
																			<? if(trim($sysperm['publicar_'.$mod.''])==1) { ?>
                                                                            <a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                            <? } else { ?>
                                                                            <a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
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
                                                <div id="tb1_novo" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="form_<?=$mod?>">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="autor" value="<?=$sysusu['id']?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                            <? 
                                                            $CodFatura = geraCodContReturn(10); 
                                                            ?>
                                                            <input type="hidden" name="cod" id="cod" value="<?=strtoupper($CodFatura)?>">
                                                            
                                                            <div class="formSep" style="font-size:25px;">Código <b>#<?=strtoupper($CodFatura)?></b></div>

                                                            <div class="formSep">
                                                                <label>Categoria</label>
                                                                <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_categoria ORDER BY ordem");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <span class="help-block" style="width:100%;float:left;">Selecione a categoria à qual pertence este item</span>
                                                            </div>

                                                             <div class="formSep">
                                                                <label>Forma de Pagamento</label>
                                                                <select name="idforma_pagamento" id="idforma_pagamento">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."forma_pagamento ORDER BY nome");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <span class="help-block" style="width:100%;float:left;">Selecione a forma de pagamento que será utilizada</span>
                                                            </div>

                                                             <div class="formSep">
                                                                <label>Banco</label>
                                                                <select name="idbanco" id="idbanco">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."banco ORDER BY nome");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <span class="help-block" style="width:100%;float:left;">Caso este valor influencie na movimentação de algum banco cadastrado, selecione o mesmo</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Marcar como importante ?</label>
                                                                    <input type="checkbox" name="importante" id="importante" class="importante {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Marque como importante para este item aparecer como importante na sua listagem</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Deseja receber notificação por e-mail ?</label>
                                                                    <input type="checkbox" name="enviar_email" id="enviar_email" class="enviar_email {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Marque caso você queria que seja enviado uma notificação sobre este item para o email do criador do mesmo</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Quantos dias de antecedência do vencimento</label>
                                                                <select name="enviar_email_dias" id="enviar_email_dias" style="width:70px;">
                                                                    <option value="">---</option>
                                                                    <? 
																	for ($i = 1; $i <= 5; $i++) { 
																	?>
                                                                    <option value="<?= $i ?>"><?=$i?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <span class="help-block" style="width:100%;float:left;">Selecione com qual antecedência você deseja receber a notificação por e-mail sobre este item</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Título</label>
                                                                    <input value="" class="span7"  type="text" name="nome" id="nome" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Código de Barra</label>
                                                                    <input value="" class="span7"  type="text" name="codigo_barra" id="codigo_barra" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Se você possui leitor de código de barras, posicione o cursor sobre o campo e utilize seu leitor</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Nota Fiscal</label>
                                                                    <input value="" class="span7"  type="text" name="nf" id="nf" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Valor Original</label>
                                                                    <input value=""  style="width:150px;"type="text" name="valor_real" id="valor_real" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Valor dos Juros</label>
                                                                    <input value=""  style="width:150px;"type="text" name="valor_juros" id="valor_juros" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Valor do Desconto</label>
                                                                    <input value=""  style="width:150px;"type="text" name="valor_desconto" id="valor_desconto" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data de Emissão</label>
                                                                    <input class="span8" value="<? echo date("d/m/Y"); ?>" data-date-format="dd/mm/yyyy" name="data_emissao" id="data_emissao" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data de Vencimento</label>
                                                                    <input class="span8" value="<? echo date("d/m/Y"); ?>" data-date-format="dd/mm/yyyy" name="data_vencimento" id="data_vencimento" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data de Pagamento</label>
                                                                    <input class="span8" value="" data-date-format="dd/mm/yyyy" name="data_pagamento" id="data_pagamento" type="text">
                                                                </div>
                                                            </div>


                                                            <div class="formSep">
                                                                <label class="req">Anexo</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="anexo" type="file"></span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Quantidade de Parcelas</label>
                                                                <select name="parcelas" id="parcelas" style="width:70px;">
                                                                    <? 
																	$mes_n = date("m");
																	$qtd_meses = 12 - $mes_n;
																	for ($i = 1; $i <= $qtd_meses; $i++) { 
																	?>
                                                                    <option value="<?= $i ?>"><?=$i?></option>
                                                                    <? } ?>
                                                                </select>
                                                                <span class="help-block" style="width:100%;float:left;">Caso este valor influencie na movimentação de algum banco cadastrado, selecione o mesmo</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Observação</label>
                                                                <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:10px;">Escreva aqui algum texto de observação ou descrição deste item</span>
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

                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

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

                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
