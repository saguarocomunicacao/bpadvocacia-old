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
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_status">Status</a></li><? } ?>
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
            
												beoro_select_row.init();
										
												//* datepicker
												beoro_datepicker.init();

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
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#data_post_editar').length) {
														$('#data_post_editar').datepicker()
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
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico_editar" value="<?=$numeroUnicoGerado?>">
                                                            <input type="hidden" name="contrato" value="<?=$row['contrato']?>">
                
                                                            <div class="formSep">
                                                                <label>Status do prospecto</label>
                                                                <select name="id<?=$mod?>_status" id="id<?=$mod?>_status">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$mod."_status WHERE stat='1' ORDER BY ordem");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($row['id'.$mod.'_status']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>


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
                                                                <div class="span3">
                                                                    <label>Data de Prospecto</label>
                                                                    <div class="input-append date" id="data_post" data-date-format="dd/mm/yyyy" data-date="">
                                                                        <input class="span8" size="16" name="data_post" value="<? if(trim($row['data_post'])==""||trim($row['data_post'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_post'],"d/m/Y"); } ?>" type="text">
                                                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Quem prospectou</label>
                                                                    <select name="idsysusu" id="idsysusu_editar">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsysusu']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Como conheceu a nossa empresa ?</label>
                                                                    <select name="como_conheceu" id="como_conheceu_editar" style="width:230px;" onchange="como_conheceu_set('_editar');">
                                                                        <option value="">---</option>
                                                                        <option value="Google" <? if($row['como_conheceu']=="Google") { echo "selected"; } ?>>Google</option>
                                                                        <option value="Outros buscadores" <? if($row['como_conheceu']=="Outros Buscadores") { echo "selected"; } ?>>Outros buscadores</option>
                                                                        <option value="Revistas" <? if($row['como_conheceu']=="Revistas") { echo "selected"; } ?>>Revistas</option>
                                                                        <option value="Indicações" <? if($row['como_conheceu']=="Indicações") { echo "selected"; } ?>>Indicações</option>
                                                                        <option value="Parceiros" <? if($row['como_conheceu']=="Parceiros") { echo "selected"; } ?>>Parceiros</option>
                                                                        <option value="Mídia Online" <? if($row['como_conheceu']=="Mídia Online") { echo "selected"; } ?>>Mídia Online</option>
                                                                        <option value="Cliente" <? if($row['como_conheceu']=="Cliente") { echo "selected"; } ?>>Cliente</option>
                                                                        <option value="Eventos" <? if($row['como_conheceu']=="Eventos") { echo "selected"; } ?>>Eventos</option>
                                                                        <option value="Redes Sociais" <? if($row['como_conheceu']=="Redes Sociais") { echo "selected"; } ?>>Redes Sociais</option>
                                                                        <option value="Rádio" <? if($row['como_conheceu']=="Rádio") { echo "selected"; } ?>>Rádio</option>
                                                                        <option value="Outros" <? if($row['como_conheceu']=="Outros") { echo "selected"; } ?>>Outros</option>
                                                                    </select>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <input class="span12" style="margin-top:25px;display:<? if($row['como_conheceu']=="Outros") { echo "block"; } else { echo "none"; } ?>;" value="<?=$row['como_conheceu_outro']?>" name="como_conheceu_outro" id="como_conheceu_outro_editar" type="text">
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
                                                                <label>Observações</label>
                                                                <textarea name="obs" id="obs_editar" class="span12" style="height:150px;"><?=$row['obs']?></textarea>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo do prospecto</span>
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
                                                                    <th>Status</th>
                                                                    <th style="width:150px;">Cliente</th>
                                                                    <th style="width:150px;">Data do prospecto</th>
                                                                    <th style="width:150px;">Atendente</th>
                                                                    <th style="width:150px;">Total de produto</th>
                                                                    <th style="width:150px;">Total de desconto</th>
                                                                    <th style="width:150px;">Total de Invest.</th>
                                                                    <th style="width:150px;">Total de Mensalidade</th>
                                                                    <th style="width:230px;">Ações</th>
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

                                                                    <? $sysprospecto_status = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_status WHERE id='".$rSql['id'.$mod.'_status']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$sysprospecto_status['nome']?></td>
                                                                    <? $syscliente = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$rSql['idsyscliente']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$syscliente['nome']?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['data_post'])==""||trim($rSql['data_post'])=="0000-00-00") { } else { ajustaData($rSql['data_post'],"d-m-Y"); } ?></td>
                                                                    <? $sysusu = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['idsysusu']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$sysusu['nome']?></td>
                                                                    <?
																	$valor_total_geral =  "";
																	$valor_total_investimento_geral =  "";
																	$valor_total_desconto_geral =  "";
																	$valor_total_mensalidade_geral =  "";
																	
                                                                    $qSqlGroup = mysql_query("SELECT * FROM sysprospecto_item WHERE numeroUnico_pai='".$rSql['numeroUnico']."' GROUP BY idsysproduto_categoria");
                                                                    while($rSqlGroup = mysql_fetch_array($qSqlGroup)) {

																		$valor_mensalidade_limpo = "";
																		$valor_subtotal_investimento = "";
																		$valor_total =  "";
																		$valor_total_investimento =  "";
																		$valor_total_desconto =  "";
																		$valor_total_mensalidade =  "";

                                                                        $qSqlItem = mysql_query("SELECT * FROM sysprospecto_item WHERE numeroUnico_pai='".$rSql['numeroUnico']."' AND idsysproduto_categoria='".$rSqlGroup['idsysproduto_categoria']."' ORDER BY data DESC");
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
																			<div style="float:left;">
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?><a href="javascript:void(0);" onclick="envia_email_sysprospecto('<?=$rSql['numeroUnico']?>','<?=$rSql['id']?>');" class="btn-mini ptip_se" title="Enviar e-mail"><img id="img-envia-email-<?=$rSql['id']?>" src="<?=$link?>template/img/icones_novos/16/email-send.png" /></a><? } ?>
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
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
																			<div id="btn-gera-contrato-<?=$rSql['id']?>" style="float:left;">
																			<?
                                                                            $rSqlLink = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."' AND bd='syscontrato' AND stat='1' LIMIT 1"));
																			$nomeLimpoLink = transformaCaractere($rSqlLink['nome']);
																			$url_mod = str_replace("_","-",$rSqlLink['bd']);
																			$syscontrato_item = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato WHERE idsysprospecto='".$rSql['id']."'"));
                                                                            ?>
																			<? if(trim($rSql['contrato'])=="1") { ?>
                                                                            <button onclick="window.open('<?=$link?><?=$_REQUEST['var1']?>/<?=$nomeLimpoLink?>/editar/<?=$syscontrato_item['id']?>','_self','');" type="button" class="btn btn-mini btn-primary" style="width:110px;">visualizar contrato</button>
                                                                            <? } else { ?>
                                                                            <button onclick="gera_syscontrato('<?=$rSql['id']?>','<?=$_REQUEST['var1']?>','<?=$nomeLimpoLink?>');" type="button" class="btn btn-mini btn-success" style="width:110px;">gerar contrato</button>
                                                                            <? } ?>
                                                                            </div>
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
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                            <input type="hidden" name="contrato" value="0">

                                                            <div class="formSep">
                                                                <label>Status do prospecto</label>
                                                                <select name="id<?=$mod?>_status" id="id<?=$mod?>_status">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$mod."_status WHERE stat='1' ORDER BY ordem");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>

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
                                                                    <label>Quem prospectou</label>
                                                                    <select name="idsysusu" id="idsysusu">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Como conheceu a nossa empresa ?</label>
                                                                    <select name="como_conheceu" id="como_conheceu" style="width:230px;" onchange="como_conheceu_set('');">
                                                                        <option value="">---</option>
                                                                        <option value="Google">Google</option>
                                                                        <option value="Outros buscadores">Outros buscadores</option>
                                                                        <option value="Revistas">Revistas</option>
                                                                        <option value="Indicações">Indicações</option>
                                                                        <option value="Parceiros">Parceiros</option>
                                                                        <option value="Mídia Online">Mídia Online</option>
                                                                        <option value="Cliente">Cliente</option>
                                                                        <option value="Eventos">Eventos</option>
                                                                        <option value="Redes Sociais">Redes Sociais</option>
                                                                        <option value="Rádio">Rádio</option>
                                                                        <option value="Outros">Outros</option>
                                                                    </select>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <input class="span12" style="margin-top:25px;display:none;" value="" name="como_conheceu_outro" id="como_conheceu_outro" type="text">
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
                                                                <label>Observações</label>
                                                                <textarea name="obs" id="obs" class="span12" style="height:150px;"></textarea>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo do prospecto</span>
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

                                                <div id="tb1_status" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                
                                                            <? 
                                                            $numeroUnicoGeradoCategoria = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico_status" value="<?=$numeroUnicoGeradoCategoria?>">

                                                            <div class="formSep">
                                                                <label class="req">Ordem</label>
                                                                <select id="ordem_status" style="width:50px;">
																	<?
                                                                    $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_status"));
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
                                                                    <input value="" style="width:350px;" type="text" id="nome_status" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <button type="button" onclick="salvar_status_classificacao('<?=$mod?>','_status');" class="btn btn-primary">Adicionar</button>
                                                            </div>
                                                            <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de status</div>
                                                                <div id="lista_status_itens" style="width:100%;float:left;">
																	<? $subLocalGet = "_status"; include("./acoes/sysgeral/lista_status_classificacao.php"); ?>
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
