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
                                            </ul>
											<script>
                                              $(document).ready(function() {
                                                //* form validation
                                                forms.simple();
            
												$("#valor").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_desconto").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_mensalidade").maskMoney({ decimal:",", thousands:".", allowZero:true});

												<? if(trim($_REQUEST['var3'])=="") { } else { ?>
												$("#valor_editar").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_desconto_editar").maskMoney({ decimal:",", thousands:".", allowZero:true});
												$("#valor_mensalidade_editar").maskMoney({ decimal:",", thousands:".", allowZero:true});
												<? } ?>

                                                //* datatables 
                                                beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
										
												//* datepicker
												beoro_datepicker.init();
            
												beoro_select_row.init();
										
												//* WYSIWG Editor
												beoro_wysiwg.init();
										
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


											//* datepicker
											beoro_datepicker = {
												init: function() {
													if($('#data_post').length) {
														$('#data_post').datepicker()
													}
													if($('#data_aceito').length) {
														$('#data_aceito').datepicker()
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#data_post_editar').length) {
														$('#data_post_editar').datepicker()
													}
													if($('#data_aceito_editar').length) {
														$('#data_aceito_editar').datepicker()
													}
													<? } ?>
												}
											};

											//* WYSIWG Editor
											beoro_wysiwg = {
												init: function() {
													if($('#obs').length) { 
														CKEDITOR.replace( 'obs', {
															toolbar: 'Standard'
														});
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#obs_editar').length) { 
														CKEDITOR.replace( 'obs_editar', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
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
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#idsyscliente_editar').length) {
														$("#idsyscliente_editar").select2({
															placeholder: "Selecione um cliente",
															allowClear: true
														});
													}
													<? } ?>
												}
											};
                                            </script>
                                            <div class="tab-content">
                                                
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="editar" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = $row['numeroUnico']; 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:300px;">
                                                                    <label id="label-perfil">Cliente</label>
                                                                    <select name="idsyscliente" id="idsyscliente_editar" class="span12">
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
                                                                <div id="div-add-syscliente_editar" style="float:left;margin-top:30px;display:block;">
                                                                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/syscliente/form.php?sufixoS=_editar" title="Adicionar um cliente"><p style="color:#368CA9;"><b>+ Adicionar um cliente</b></p></a>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data de Prospecto</label>
                                                                    <div class="input-append date" id="data_post" data-date-format="dd/mm/yyyy" data-date="">
                                                                        <input class="span8" size="16" name="data_post" value="<? if(trim($row['data_post'])==""||trim($row['data_post'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_post'],"d/m/Y"); } ?>" type="text">
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data em que foi aceito</label>
                                                                    <div class="input-append date" id="data_aceito" data-date-format="dd/mm/yyyy" data-date="">
                                                                        <input class="span8" size="16" name="data_aceito" value="<? if(trim($row['data_aceito'])==""||trim($row['data_aceito'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_aceito'],"d/m/Y"); } ?>" type="text">
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div style="float:left;width:100%;"><p style="float:left;width:100%;color:#368CA9;"><b>Adicione itens ao orçamento</b></p></div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Tipo de projeto/JOB/Categoria</label>
                                                                    <select id="idsysproduto_categoria_editar" onchange="mostra_servicos_sysprospecto('_editar');">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM sysproduto_categoria ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep" id="campos_servicos_editar" style="display:none;">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <div style="float:left;margin-right:10px;width:200px;">
                                                                        <label>Produto, serviço ou solução</label>
                                                                        <select id="idsysproduto_editar" class="span12" onchange="preenche_valor_sysproduto_sysprospecto('_editar');">
                                                                            <option value="">---</option>
                                                                        </select>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:220px;">
                                                                        <label>Plano do produto</label>
                                                                        <select id="idsysplano_editar" class="span12" disabled="disabled" onchange="preenche_valor_sysplano_sysprospecto('_editar');">
                                                                            <option value="">---</option>
                                                                        </select>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:150px;">
                                                                        <label>Periodicidade</label>
                                                                        <select id="periodo_editar" class="span12" disabled="disabled">
                                                                            <option value="">---</option>
                                                                        	<? for ($i = 1; $i <= 24; $i++) { ?>
                                                                            <option value="<?=$i?>"><?=$i?></option>
                                                                            <? } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <div style="float:left;margin-right:10px;width:150px;">
                                                                        <label>Valor do produto</label>
                                                                        <div class="input-prepend">
                                                                        <span class="add-on">R$</span> <input value="" class="span9" type="text" id="valor_editar" />
                                                                        </div>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:150px;">
                                                                        <label>Mensalidade</label>
                                                                        <div class="input-prepend">
                                                                        <span class="add-on">R$</span> <input value="" class="span9" type="text" id="valor_mensalidade_editar" />
                                                                        </div>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:150px;">
                                                                        <label>Desconto</label>
                                                                        <div class="input-prepend">
                                                                        <span class="add-on">R$</span> <input value="" class="span9" type="text" id="valor_desconto_editar" />
                                                                        </div>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:50px;">
                                                                        <button type="button" onclick="salvar_servico_sysprospecto('_editar','<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div id="lista-servicos_editar" style="width:100%;float:left;">
                                                                    <? $sufixoGet = "_editar"; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/sysprospecto/lista-servicos.php"); ?>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Escolha o contrato que será utilizado</label>
                                                                    <select name="idsyscontrato_modelo" id="idsyscontrato_modelo_editar" onchange="monta_contrato_cliente('_editar');">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM syscontrato_modelo ORDER BY nome");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsyscontrato_modelo']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="formSep" style="display:<? if(trim($row['idsyscontrato_modelo'])=="") { echo "none";  } else { echo "block"; } ?>;" id="montagem_contrato">
                                                                <div style="width:100%;text-align:center;text-transform:uppercase;" id="titulo_contrato"></div>
                                                                <div style="width:100%;margin-top:20px;">
                                                                    <p>
                                                                    A <b>TAGX WEB STUDIO LTDA</b>, pessoa jurídica de direito privado, 
                                                                    estabelecida na Rua Cônego Bernardo, 101, sala 609, Ed. Meridian Office, 
                                                                    bairro Trindade, na cidade de Florianópolis, SC, inscrita no 
                                                                    CNPJ sob o número 11.746.285/0001-20, doravante denominada CONTRATADA e a 
                                                                    pessoa física ou jurídica descrita na <b>Folha de Descrição de Cliente (FDC)</b> 
                                                                    anexa doravante denominada CLIENTE celebram o seguinte acordo de serviço:                                                                
                                                                    </p>
                                                                </div>
                                                            
                                                                <div style="width:100%;">
                                                                    <textarea name="contrato1" id="contrato1_content_editar" class="span12" style="height:150px;"></textarea>
                                                                </div>

                                                                <div style="margin-top:10px;border:1px solid #666;background-color:#F0F0F0;padding:10px;margin-bottom:10px;">
                                                                    <div style="width:100%;text-transform:uppercase;font-size:20px;"><b>Folha de descrição do cliente (FDC)</b></div>
                                                                    <div style="margin-top:20px;" id="dados_cliente_editar">
                                                                    </div>
                                                                </div>

                                                                <div style="width:100%;">
                                                                    <textarea name="contrato2" id="contrato2_content_editar" class="span12" style="height:150px;"></textarea>
                                                                </div>

                                                            </div>
                                                            <script>monta_contrato_cliente('_editar');</script>

                                                            <div class="formSep">
                                                                <label>Descrição</label>
                                                                <textarea name="obs" id="obs_editar" class="span12" style="height:150px;"><?=$row['obs']?></textarea>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo do contrato</span>
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
                                                                    <th style="width:150px;">Cliente</th>
                                                                    <th style="width:135px;">Prospectado em</th>
                                                                    <th style="width:150px;">Data de aceite</th>
                                                                    <th style="width:150px;">Atendente</th>
                                                                    <th style="width:135px;">Total de produto</th>
                                                                    <th style="width:135px;">Total de desconto</th>
                                                                    <th style="width:135px;">Total de Invest.</th>
                                                                    <th style="width:135px;">Total de Mensalidade</th>
                                                                    <th style="width:170px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY data DESC");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                     $url_limpa = transformaCaractere($rSql['nome']);
                                                                ?>
                                                                <tr id="linha-<?=$rSql['id']?>">
                                                                    <td style="vertical-align:middle;" class="nolink"><input type="checkbox" name="msg_sel[]" class="select_msg" value="<?=$rSql['id']?>" /></td>

                                                                    <? $syscliente = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$rSql['idsyscliente']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$syscliente['nome']?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['data_post'])==""||trim($rSql['data_post'])=="0000-00-00") { } else { ajustaData($rSql['data_post'],"d-m-Y"); } ?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['data_aceito'])==""||trim($rSql['data_aceito'])=="0000-00-00") { } else { ajustaData($rSql['data_aceito'],"d-m-Y"); } ?></td>
                                                                    <? $sysusu = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['idsysusu']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$sysusu['nome']?></td>
                                                                    <?
																	$valor_total_geral =  "";
																	$valor_total_investimento_geral =  "";
																	$valor_total_desconto_geral =  "";
																	$valor_total_mensalidade_geral =  "";

                                                                    $qSqlGroup = mysql_query("SELECT * FROM syscontrato_item WHERE numeroUnico_pai='".$rSql['numeroUnico']."' GROUP BY idsysproduto_categoria");
                                                                    while($rSqlGroup = mysql_fetch_array($qSqlGroup)) {

																		$valor_mensalidade_limpo = "";
																		$valor_subtotal_investimento = "";
																		$valor_total =  "";
																		$valor_total_investimento =  "";
																		$valor_total_desconto =  "";
																		$valor_total_mensalidade =  "";

                                                                        $qSqlItem = mysql_query("SELECT * FROM syscontrato_item WHERE numeroUnico_pai='".$rSql['numeroUnico']."' AND idsysproduto_categoria='".$rSqlGroup['idsysproduto_categoria']."' ORDER BY data DESC");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																			$valor_limpo = str_replace(".","",$rSqlItem['valor']); 
																			for ($i = 1; $i <= 10; $i++) {
																				$valor_limpo = str_replace(".","",$valor_limpo);
																			}
																			$valor_limpo = str_replace(",",".",$valor_limpo);

																			$valor_desconto_limpo = str_replace(".","",$rSqlItem['valor_desconto']); 
																			for ($i = 1; $i <= 10; $i++) {
																				$valor_desconto_limpo = str_replace(".","",$valor_desconto_limpo);
																			}
																			$valor_desconto_limpo = str_replace(",",".",$valor_desconto_limpo);

																			$valor_mensalidade_limpo = str_replace(".","",$rSqlItem['valor_mensalidade']); 
																			for ($i = 1; $i <= 10; $i++) {
																				$valor_mensalidade_limpo = str_replace(".","",$valor_mensalidade_limpo);
																			}
																			$valor_mensalidade_limpo = str_replace(",",".",$valor_mensalidade_limpo);

																			$valor_subtotal_investimento = $valor_limpo - $valor_desconto_limpo;
																			
																			$valor_total =  $valor_total + $valor_limpo;
																			$valor_total_investimento =  $valor_total_investimento + $valor_subtotal_investimento;
																			$valor_total_desconto =  $valor_total_desconto + $valor_desconto_limpo;
																			$valor_total_mensalidade =  $valor_total_mensalidade + $valor_mensalidade_limpo;
																		}

																		$valor_total_geral =  $valor_total_geral + $valor_total;
																		$valor_total_investimento_geral =  $valor_total_investimento_geral + $valor_total_investimento;
																		$valor_total_desconto_geral =  $valor_total_desconto_geral + $valor_total_desconto;
																		$valor_total_mensalidade_geral =  $valor_total_mensalidade_geral + $valor_total_mensalidade;
																	}
																	?>
                                                                    <td style="vertical-align:middle;"><? if($valor_total_geral=="") { } else { ?><?=number_format($valor_total_geral, 2, ',','.')?><? } ?></td>
                                                                    <td style="vertical-align:middle;"><? if($valor_total_desconto_geral=="") { } else { ?><?=number_format($valor_total_desconto_geral, 2, ',','.')?><? } ?></td>
                                                                    <td style="vertical-align:middle;"><? if($valor_total_investimento_geral=="") { } else { ?><?=number_format($valor_total_investimento_geral, 2, ',','.')?><? } ?></td>
                                                                    <td style="vertical-align:middle;"><? if($valor_total_mensalidade_geral=="") { } else { ?><?=number_format($valor_total_mensalidade_geral, 2, ',','.')?><? } ?></td>

                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="envia_email_syscontrato('<?=$rSql['numeroUnico']?>','<?=$rSql['id']?>','<?=$_REQUEST['var1']?>','<?=$_REQUEST['var2']?>');" class="btn-mini ptip_se" title="Enviar e-mail"><img id="img-envia-email-<?=$rSql['id']?>" src="<?=$link?>template/img/icones_novos/16/email-send.png" /></a></div>
																		<? } ?>
                                                                        <? if(trim($rSql['aceito'])=="1") { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" class="btn-mini ptip_se" title="Aceite digital realizado"><img src="<?=$link?>template/img/icones_novos/16/bullet_verde.png" /></a></div>
                                                                        <? } else { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" class="btn-mini ptip_se" title="Aceite digital pendente"><img src="<?=$link?>template/img/icones_novos/16/bullet_vermelho.png" /></a></div>
                                                                        <? } ?>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a></div>
																		<? } ?>
                                                                        <? if(trim($sysperm['excluir_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="remover_syscontrato('<?=$rSql['id']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a></div>
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
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

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
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data do prospecto</label>
                                                                    <div class="input-append date" id="data_post" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                        <input class="span8" size="16" name="data_post" value="<? echo date("d/m/Y"); ?>" type="text">
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Data em que foi aceito</label>
                                                                    <div class="input-append date" id="data_aceito" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                        <input class="span8" size="16" name="data_aceito" value="<? echo date("d/m/Y"); ?>" type="text">
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div style="float:left;width:100%;"><p style="float:left;width:100%;color:#368CA9;"><b>Adicione itens ao orçamento</b></p></div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Tipo de projeto/JOB/Categoria</label>
                                                                    <select id="idsysproduto_categoria" onchange="mostra_servicos_sysprospecto('','<?=$mod?>');">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM sysproduto_categoria ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep" id="campos_servicos" style="display:none;">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <div style="float:left;margin-right:10px;width:200px;">
                                                                        <label>Produto, serviço ou solução</label>
                                                                        <select id="idsysproduto" class="span12" onchange="preenche_valor_sysproduto_sysprospecto('','<?=$mod?>');">
                                                                            <option value="">---</option>
                                                                        </select>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:220px;">
                                                                        <label>Plano do produto</label>
                                                                        <select id="idsysplano" class="span12" disabled="disabled" onchange="preenche_valor_sysplano_sysprospecto('','<?=$mod?>');">
                                                                            <option value="">---</option>
                                                                        </select>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:150px;">
                                                                        <label>Periodicidade</label>
                                                                        <select id="periodo" class="span12" disabled="disabled">
                                                                            <option value="">---</option>
                                                                        	<? for ($i = 1; $i <= 24; $i++) { ?>
                                                                            <option value="<?=$i?>"><?=$i?></option>
                                                                            <? } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <div style="float:left;margin-right:10px;width:150px;">
                                                                        <label>Valor do produto</label>
                                                                        <div class="input-prepend">
                                                                        <span class="add-on">R$</span> <input value="" class="span9" type="text" id="valor" />
                                                                        </div>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:150px;">
                                                                        <label>Mensalidade</label>
                                                                        <div class="input-prepend">
                                                                        <span class="add-on">R$</span> <input value="" class="span9" type="text" id="valor_mensalidade" />
                                                                        </div>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:150px;">
                                                                        <label>Desconto</label>
                                                                        <div class="input-prepend">
                                                                        <span class="add-on">R$</span> <input value="" class="span9" type="text" id="valor_desconto" />
                                                                        </div>
                                                                    </div>
                                                                    <div style="float:left;margin-right:10px;width:50px;">
                                                                        <button type="button" onclick="salvar_servico_sysprospecto('','<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div id="lista-servicos" style="width:100%;float:left;">
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Escolha o contrato que será utilizado</label>
                                                                    <select name="idsyscontrato_modelo" id="idsyscontrato_modelo" onchange="monta_contrato_cliente('');">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM syscontrato_modelo ORDER BY nome");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep" style="display:none;" id="montagem_contrato">
                                                                <div style="width:100%;text-align:center;text-transform:uppercase;" id="titulo_contrato"></div>
                                                                <div style="width:100%;margin-top:20px;">
                                                                    <p>
                                                                    A <b>TAGX WEB STUDIO LTDA</b>, pessoa jurídica de direito privado, 
                                                                    estabelecida na Rua Cônego Bernardo, 101, sala 609, Ed. Meridian Office, 
                                                                    bairro Trindade, na cidade de Florianópolis, SC, inscrita no 
                                                                    CNPJ sob o número 11.746.285/0001-20, doravante denominada CONTRATADA e a 
                                                                    pessoa física ou jurídica descrita na <b>Folha de Descrição de Cliente (FDC)</b> 
                                                                    anexa doravante denominada CLIENTE celebram o seguinte acordo de serviço:                                                                
                                                                    </p>
                                                                </div>
                                                            
                                                                <div style="width:100%;">
                                                                    <textarea name="contrato1" id="contrato1_content" class="span12" style="height:150px;"></textarea>
                                                                </div>

                                                                <div style="margin-top:10px;border:1px solid #666;background-color:#F0F0F0;padding:10px;margin-bottom:10px;">
                                                                    <div style="width:100%;text-transform:uppercase;font-size:20px;"><b>Folha de descrição do cliente (FDC)</b></div>
                                                                    <div style="margin-top:20px;" id="dados_cliente">
                                                                    </div>
                                                                </div>

                                                                <div style="width:100%;">
                                                                    <textarea name="contrato2" id="contrato2_content" class="span12" style="height:150px;"></textarea>
                                                                </div>

                                                            </div>

                                                            <div class="formSep">
                                                                <label>Observações</label>
                                                                <textarea name="obs" id="obs" class="span12" style="height:150px;"></textarea>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo do contrato</span>
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
                                                <? } ?>


                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
