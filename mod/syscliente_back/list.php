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
            
                                                //* masked inputs
                                                beoro_maskedInputs.init();
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
																{ "sType": "string" },
																{ "bSortable": false }
															],
															"aaSorting": [[ <? if(trim($sysperm['todos_'.$mod.''])==1) { ?>4<? } else { ?>3<? } ?>, "asc" ]]
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
													if($('#data_cadastro').length) {
														$('#data_cadastro').datepicker()
													}
													if($('#data_prospecto').length) {
														$('#data_prospecto').datepicker()
													}
													if($('#data_cliente').length) {
														$('#data_cliente').datepicker()
													}
												}
											};

                                            //* masked inputs
                                            beoro_maskedInputs = {
                                                init: function() {
                                                    $("#cep").inputmask('99999-999');
                                                    $("#cpf").inputmask('999.999.999-99');
                                                    $("#cnpj").inputmask('99.999.999/9999-99');
                                                    $("#favorecido_cpf").inputmask('999.999.999-99');
                                                    $("#favorecido_cnpj").inputmask('99.999.999/9999-99');
                                                    $("#data_nascimento").inputmask('99/99/9999');
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
                
                
                                                            <div class="tabbable tabs-left tabbable-bordered">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#tb3_a">Dados principais</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_c">Dados complementares</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_e">Endereço</a></li>
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
                                                                            <label class="req">Nome Completo</label>
                                                                            <input value="<?=$row['nome']?>" class="span8" type="text" name="nome" id="nome" />
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div class="span3">
                                                                                <label>Data de Cadastro</label>
                                                                                <div class="input-append date" id="data_cadastro" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_cadastro'])==""||trim($row['data_cadastro'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_cadastro'],"d/m/Y"); } ?>">
                                                                                    <input class="span8" size="16" name="data_cadastro" value="<? if(trim($row['data_cadastro'])==""||trim($row['data_cadastro'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_cadastro'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
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

                                                                    <div id="tb3_c" class="tab-pane" style="min-height:350px;">
            
                                                                        <div class="formSep">
                                                                            <label>Ação</label>
                                                                            <input class="span12" value="<?=$row['acao']?>" name="acao" id="acao" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Número da Ação</label>
                                                                            <input class="span12" value="<?=$row['acao_numero']?>" name="acao_numero" id="acao_numero" type="text">
                                                                        </div>


                                                                        <div class="formSep">
                                                                            <label>E-mail</label>
                                                                            <input class="span12" value="<?=$row['email']?>" name="email" id="email" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Telefone</label>
                                                                            <input class="span12" value="<?=$row['telefone_1']?>" name="telefone_1" id="telefone_1" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Tipo de Cliente</label>
                                                                            <select name="tipo_de_documento" id="tipo_de_documento" class="span3" onchange="tipo_de_cliente('');">
                                                                                <option value="">---</option>
                                                                                <option value="pf" <? if($row['tipo_de_documento']=="pf") { echo "selected"; } ?>>pessoa física</option>
                                                                                <option value="pj" <? if($row['tipo_de_documento']=="pj") { echo "selected"; } ?>>pessoa jurídica</option>
                                                                                <option value="estrangeiro" <? if($row['tipo_de_documento']=="estrangeiro") { echo "selected"; } ?>>estrangeiro</option>
                                                                            </select>
                                                                            <span class="help-block">Ao escolher o tipo de cliente, abaixo serão exibidos os campos referentes ao tipo de cadastro</span>
                                                                        </div>
            
                                                                        <div class="formSep" style="display:<? if($row['tipo_de_documento']=="pf") { echo "block"; } else { echo "none"; } ?>;" id="div_pf">
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span5">
                                                                                    <label>CPF</label>
                                                                                    <input class="span12" value="<?=$row['cpf']?>" name="cpf" id="cpf" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>RG</label>
                                                                                    <input class="span12" value="<?=$row['rg']?>" name="rg" id="rg" type="text">
                                                                                </div>
                                                                                <div class="span3">
                                                                                    <label>Emissor</label>
                                                                                    <input class="span12" value="<?=$row['emissor']?>" name="emissor" id="emissor" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span4">
                                                                                    <label>PIS</label>
                                                                                    <input class="span12" value="<?=$row['pis']?>" name="pis" id="pis" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Profissão</label>
                                                                                    <input class="span12" value="<?=$row['profissao']?>" name="profissao" id="profissao" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Nacionalidade</label>
                                                                                    <input class="span12" value="<?=$row['nacionalidade']?>" name="nacionalidade" id="nacionalidade" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span2">
                                                                                    <label>Data de Nascimento</label>
                                                                                    <input class="span12" value="<?=$row['data_nascimento']?>" name="data_nascimento" id="data_nascimento" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Estado Civil</label>
                                                                                    <select name="estado_civil" id="estado_civil" class="span7">
                                                                                        <option value="">---</option>
                                                                                        <option value="Casado (a)" <? if($row['estado_civil']=="Casado (a)") { echo "selected"; } ?>>Casado (a)</option>
                                                                                        <option value="Separado (a)" <? if($row['estado_civil']=="Separado (a)") { echo "selected"; } ?>>Separado (a)</option>
                                                                                        <option value="Solteiro (a)" <? if($row['estado_civil']=="Solteiro (a)") { echo "selected"; } ?>>Solteiro (a)</option>
                                                                                        <option value="Viúvo (a)" <? if($row['estado_civil']=="Viúvo (a") { echo "selected"; } ?>>Viúvo (a)</option> 
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep" style="display:<? if($row['tipo_de_documento']=="pj") { echo "block"; } else { echo "none"; } ?>;" id="div_pj">
                                                                            <div class="span4">
                                                                                <label>CNPJ</label>
                                                                                <input class="span12" value="<?=$row['cnpj']?>" name="cnpj" id="cnpj" type="text">
                                                                            </div>
                                                                            <div class="span4">
                                                                                <label>IE</label>
                                                                                <input class="span12" value="<?=$row['ie']?>" name="ie" id="ie" type="text">
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span4">
                                                                                    <label>Razão Social</label>
                                                                                    <input class="span12" value="<?=$row['razao_social']?>" name="razao_social" id="razao_social" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Nome Fantasia</label>
                                                                                    <input class="span12" value="<?=$row['nome_fantasia']?>" name="nome_fantasia" id="nome_fantasia" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span4">
                                                                                    <label>Nome do responsável</label>
                                                                                    <input class="span12" value="<?=$row['responsavel']?>" name="responsavel" id="responsavel" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Cargo</label>
                                                                                    <input class="span8" value="<?=$row['responsavel_cargo']?>" name="responsavel_cargo" id="responsavel_cargo" type="text">
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep" style="display:<? if($row['tipo_de_documento']=="estrangeiro") { echo "block"; } else { echo "none"; } ?>;" id="div_estrangeiro">
                                                                            <div class="span4">
                                                                                <label>Tipo do Documento Estrangeiro</label>
                                                                                <input class="span12" value="<?=$row['estrangeiro_nome']?>" name="entrangeiro_nome" id="entrangeiro_nome" type="text">
                                                                            </div>
                                                                            <div class="span4">
                                                                                <label>Número do Documento</label>
                                                                                <input class="span12" value="<?=$row['estrangeiro_numero']?>" name="entrangeiro_numero" id="entrangeiro_numero" type="text">
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Como conheceu a nossa empresa ?</label>
                                                                                <select name="como_conheceu" id="como_conheceu" style="width:230px;" onchange="como_conheceu_set('');">
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
                                                                                <input class="span12" style="margin-top:25px;display:<? if($row['como_conheceu']=="Outros") { echo "block"; } else { echo "none"; } ?>;" value="<?=$row['como_conheceu_outro']?>" name="como_conheceu_outro" id="como_conheceu_outro" type="text">
                                                                            </div>
                                                                        </div>
            
                                                                    </div>
                                                                    
                                                                    <div id="tb3_e" class="tab-pane" style="min-height:350px;">


                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>CEP</label>
                                                                                <input value="<?=$row['cep']?>" style="width:90px;" type="text" name="cep" id="cep_editar" />
                                                                                <span class="help-block">99999-999</span>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;margin-top:27px;">
                                                                                <button type="button" onclick="buscaCepEditar();" class="btn btn-small">Carregar endereço</button>
                                                                            </div>
                                                                            <div id="preloader_editar" style="float:left;display:none;margin-top:30px;margin-left:5px;">
                                                                                <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                                                                <div style="float:left;">carregando</div>
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <label>Endereço</label>
                                                                            <input value="<?=$row['rua']?>" class="span9" type="text" name="rua" id="rua_editar" />
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Estado</label>
                                                                                <select name="estado" id="estado_editar" style="width:255px;" onchange="mostraCidades();">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlEstado = mysql_query("SELECT * FROM cepbr_estado ORDER BY estado");
                                                                                    while($rSqlEstado = mysql_fetch_array($qSqlEstado)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlEstado['uf'] ?>" <? if($rSqlEstado['uf']==$row['estado']) { echo "selected"; $estado_set = $rSqlEstado['uf']; } ?>><?= utf8_encode($rSqlEstado['estado']) ?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Cidade</label>
                                                                                <select name="cidade" id="cidade_editar" onchange="javascript:mostraBairros();" style="width:255px">
                                                                                    <? if(trim($row['estado'])=="") { ?>
                                                                                    <option value="">---</option>
                                                                                    <? } else { ?>
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlCidade = mysql_query("SELECT * FROM cepbr_cidade WHERE id_cidade='".$row['cidade']."' ORDER BY cidade");
                                                                                    while($rSqlCidade=mysql_fetch_array($qSqlCidade)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlCidade['id_cidade']?>" <? if($rSqlCidade['id_cidade']==$row['cidade']) { echo "selected"; $cidade_set = utf8_encode($rSqlCidade['cidade']); } ?>><?=utf8_encode($rSqlCidade['cidade'])?></option>
                                                                                    <? } ?>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Bairro</label>
                                                                                <select name="bairro" id="bairro_editar" style="width:255px;">
                                                                                    <? if(trim($row['cidade'])=="") { ?>
                                                                                    <option value="">---</option>
                                                                                    <? } else { ?>
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlBairro = mysql_query("SELECT * FROM cepbr_bairro WHERE id_cidade='".$row['cidade']."' ORDER BY bairro");
                                                                                    while($rSqlBairro=mysql_fetch_array($qSqlBairro)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlBairro['id_bairro']?>" <? if($rSqlBairro['id_bairro']==$row['bairro']) { echo "selected"; $bairro_set = utf8_encode($rSqlBairro['bairro']); } ?>><?=utf8_encode($rSqlBairro['bairro'])?></option>
                                                                                    <? } ?>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    


                                                                </div>
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
                                                                    <th>Nome</th>
                                                                    <th>E-mail</th>
                                                                    <th>Telefone</th>
                                                                    <th>Ação</th>
                                                                    <th>Número da Ação</th>
                                                                    <th style="width:110px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                if(trim($sysperm['todos_'.$mod.''])==1) {
																	$qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY nome, data DESC, dataModificacao DESC");
																} else {
																	$qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." WHERE idsysusu='".$sysusu['id']."' ORDER BY nome, data DESC, dataModificacao DESC");
																}
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                     $url_limpa = transformaCaractere($rSql['nome']);
                                                                ?>
                                                                <tr id="linha-<?=$rSql['id']?>">
                                                                    <td style="vertical-align:middle;" class="nolink"><input type="checkbox" name="msg_sel[]" class="select_msg" value="<?=$rSql['id']?>" /></td>

                                                                    <? $item_categoria = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_categoria WHERE id='".$rSql['id'.$mod.'_categoria']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$item_categoria['nome']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['nome']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['email']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['telefone_1']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['acao']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['acao_numero']?></td>

                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a></div>
																		<? } ?>
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

                                                            <input type="hidden" name="idsysusu" value="<?=$sysusu['id']?>">

                                                            <div class="tabbable tabs-left tabbable-bordered">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#tb3_a">Dados principais</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_c">Dados complementares</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_d">Contatos</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_e">Endereço</a></li>
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
                                                                            <label class="req">Nome Completo</label>
                                                                            <input value="" class="span7" type="text" name="nome" id="nome" />
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <div class="span3">
                                                                                <label>Data de Cadastro</label>
                                                                                <div class="input-append date" id="data_cadastro" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                                    <input class="span8" size="16" name="data_cadastro" value="<? echo date("d/m/Y"); ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
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
            
                                                                    </div>

                                                                    <div id="tb3_c" class="tab-pane" style="min-height:350px;">
            
                                                                        <div class="formSep">
                                                                            <label>Ação</label>
                                                                            <input class="span12" value="" name="acao" id="acao" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Número da Ação</label>
                                                                            <input class="span12" value="" name="acao_numero" id="acao_numero" type="text">
                                                                        </div>


                                                                        <div class="formSep">
                                                                            <label>E-mail</label>
                                                                            <input class="span12" value="" name="email" id="email" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Telefone</label>
                                                                            <input class="span12" value="" name="telefone_1" id="telefone_1" type="text">
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label>Tipo de Cliente</label>
                                                                            <select name="tipo_de_documento" id="tipo_de_documento" class="span3" onchange="tipo_de_cliente('');">
                                                                                <option value="">---</option>
                                                                                <option value="pf">pessoa física</option>
                                                                                <option value="pj">pessoa jurídica</option>
                                                                                <option value="estrangeiro">estrangeiro</option>
                                                                            </select>
                                                                            <span class="help-block">Ao escolher o tipo de cliente, abaixo serão exibidos os campos referentes ao tipo de cadastro</span>
                                                                        </div>
            
                                                                        <div class="formSep" style="display:none;" id="div_pf">
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span5">
                                                                                    <label>CPF</label>
                                                                                    <input class="span12" value="" name="cpf" id="cpf" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>RG</label>
                                                                                    <input class="span12" value="" name="rg" id="rg" type="text">
                                                                                </div>
                                                                                <div class="span3">
                                                                                    <label>Emissor</label>
                                                                                    <input class="span12" value="" name="emissor" id="emissor" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span4">
                                                                                    <label>PIS</label>
                                                                                    <input class="span12" value="" name="pis" id="pis" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Profissão</label>
                                                                                    <input class="span12" value="" name="profissao" id="profissao" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Nacionalidade</label>
                                                                                    <input class="span12" value="" name="nacionalidade" id="nacionalidade" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span2">
                                                                                    <label>Data de Nascimento</label>
                                                                                    <input class="span12" value="" name="data_nascimento" id="data_nascimento" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Estado Civil</label>
                                                                                    <select name="estado_civil" id="estado_civil" class="span7">
                                                                                        <option value="">---</option>
                                                                                        <option value="Casado (a)">Casado (a)</option>
                                                                                        <option value="Separado (a)">Separado (a)</option>
                                                                                        <option value="Solteiro (a)">Solteiro (a)</option>
                                                                                        <option value="Viúvo (a)">Viúvo (a)</option> 
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep" style="display:none;" id="div_pj">
                                                                            <div class="span4">
                                                                                <label>CNPJ</label>
                                                                                <input class="span12" value="" name="cnpj" id="cnpj" type="text">
                                                                            </div>
                                                                            <div class="span4">
                                                                                <label>IE</label>
                                                                                <input class="span12" value="" name="ie" id="ie" type="text">
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span4">
                                                                                    <label>Razão Social</label>
                                                                                    <input class="span12" value="" name="razao_social" id="razao_social" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Nome Fantasia</label>
                                                                                    <input class="span12" value="" name="nome_fantasia" id="nome_fantasia" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div class="span4">
                                                                                    <label>Nome do responsável</label>
                                                                                    <input class="span12" value="" name="responsavel" id="responsavel" type="text">
                                                                                </div>
                                                                                <div class="span4">
                                                                                    <label>Cargo</label>
                                                                                    <input class="span8" value="" name="responsavel_cargo" id="responsavel_cargo" type="text">
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep" style="display:none;" id="div_estrangeiro">
                                                                            <div class="span4">
                                                                                <label>Tipo do Documento Estrangeiro</label>
                                                                                <input class="span12" value="" name="entrangeiro_nome" id="entrangeiro_nome" type="text">
                                                                            </div>
                                                                            <div class="span4">
                                                                                <label>Número do Documento</label>
                                                                                <input class="span12" value="" name="entrangeiro_numero" id="entrangeiro_numero" type="text">
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Como conheceu a nossa empresa ?</label>
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
            
                                                                    </div>

                                                                    <div id="tb3_e" class="tab-pane" style="min-height:350px;">

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>CEP</label>
                                                                                <input value="" style="width:90px;" type="text" name="cep" id="cep" />
                                                                                <span class="help-block">99999-999</span>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;margin-top:27px;">
                                                                                <button type="button" onclick="buscaCep();" class="btn btn-small">Carregar endereço</button>
                                                                            </div>
                                                                            <div id="preloader" style="float:left;display:none;margin-top:30px;margin-left:5px;">
                                                                                <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                                                                <div style="float:left;">carregando</div>
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <label>Endereço</label>
                                                                            <input value="" class="span9" type="text" name="rua" id="rua" />
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Estado</label>
                                                                                <select name="estado" id="estado" style="width:255px;" onchange="mostraCidades();">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlEstado = mysql_query("SELECT * FROM cepbr_estado ORDER BY estado");
                                                                                    while($rSqlEstado = mysql_fetch_array($qSqlEstado)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlEstado['uf'] ?>"><?= utf8_encode($rSqlEstado['estado']) ?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Cidade</label>
                                                                                <select name="cidade" id="cidade" onchange="javascript:mostraBairros();" style="width:255px">
                                                                                    <option value="">---</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Bairro</label>
                                                                                <select id="bairro" id="bairro" style="width:255px;">
                                                                                    <option value="">---</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>



                                                                </div>
                                                            </div>
                                                            
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Salvar</button>
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


                                                <div id="tb1_classificacao" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                
                                                            <? 
                                                            $numeroUnicoGeradoCategoria = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico_classificacao" value="<?=$numeroUnicoGeradoCategoria?>">

                                                            <div class="formSep">
                                                                <label class="req">Ordem</label>
                                                                <select id="ordem_classificacao" style="width:50px;">
																	<?
                                                                    $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_classificacao"));
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
                                                                    <input value="" style="width:350px;" type="text" id="nome_classificacao" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <button type="button" onclick="salvar_status_classificacao('<?=$mod?>','_classificacao');" class="btn btn-primary">Adicionar</button>
                                                            </div>
                                                            <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de status</div>
                                                                <div id="lista_classificacao_itens" style="width:100%;float:left;">
																	<? $subLocalGet = "_classificacao"; include("./acoes/sysgeral/lista_status_classificacao.php"); ?>
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
