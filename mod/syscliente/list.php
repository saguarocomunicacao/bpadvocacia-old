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
												<!--
												<? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_contratos">Contratos</a></li><? } ?>
												<? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_servicos">Serviços Contratados</a></li><? } ?>
                                                -->
												<? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Lista de Itens</a></li><? } ?>
                                                <? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li><? } ?><? } ?>
                                                <!--<? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_categorias">Categorias</a></li><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_status">Status</a></li><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_classificacao">Classificações</a></li><? } ?>-->
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
                                                    if($('#example').length) {
														$('#example').dataTable({
															"processing": true,
															"serverSide": true,
															"iDisplayLength": 50,
															"ajax": "<?=$link?>acoes/syscliente/tabela.php?var1=<?=$_REQUEST['var1']?>&var2=<?=$_REQUEST['var2']?>&var3=<?=$_REQUEST['var3']?>&var4=<?=$_REQUEST['var4']?>&var5=<?=$_REQUEST['var5']?>&sysusuS=<?=$sysusu['id']?>",
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
																{ "sType": "string" },
																{ "bSortable": false }
															]
														});
													}
                                                    /*
													if($('#dt_basic_syscontrato').length) {
                                                        $('#dt_basic_syscontrato').dataTable({
                                                            "sPaginationType": "bootstrap_full",
															"aoColumns": [
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
                                                    if($('#dt_basic_syscontrato_item').length) {
                                                        $('#dt_basic_syscontrato_item').dataTable({
                                                            "sPaginationType": "bootstrap_full",
															"aoColumns": [
																{ "sType": "string" },
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
													*/
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
                                                                    <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Dados principais</a></li>
                                                                    <!--<li><a data-toggle="tab" href="#tb3_b">Dados de acesso</a></li>-->
                                                                    <li><a data-toggle="tab" href="#tb3_c">Dados complementares</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_d">Contatos</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_e">Endereço</a></li>
                                                                    <!--<li><a data-toggle="tab" href="#tb3_f">Redes Sociais</a></li>-->
                                                                    <li><a data-toggle="tab" href="#tb3_i">Dados bancários</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_g">Observações</a></li>
                                                                    <li <? if(trim($_REQUEST['var5'])=="arquivos") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_h">Arquivos</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_j">Processos Vinculados</a></li>
                                                                    <!--<li><a data-toggle="tab" href="#tb3_k">Classificação</a></li>-->
                                                                </ul>
                                                                <div class="tab-content">

                                                                    <div id="tb3_j" class="tab-pane" style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <div id="lista_syscliente_adv_processo" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $idsysclienteGet = $_REQUEST['var4']; include("./acoes/adv_processo/lista_syscliente_adv_processo.php"); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">
                                                                        <!--
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
                                                                        -->
            
                                                                        <div class="formSep">
                                                                            <label class="req">Nome Completo</label>
                                                                            <input value="<?=$row['nome']?>" class="span8" type="text" name="nome" id="nome" />
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div class="span3">
                                                                                <label>Data de Cadastro</label>
                                                                                <div class="input-append date" id="data_cadastro" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_cadastro'])==""||trim($row['data_cadastro'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_cadastro'],"d/m/Y"); } ?>">
                                                                                    <input class="span8" size="16" name="data_cadastro" value="<? if(trim($row['data_cadastro'])==""||trim($row['data_cadastro'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_cadastro'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <!--
                                                                            <div class="span3">
                                                                                <label>Data de Prospecto</label>
                                                                                <div class="input-append date" id="data_prospecto" data-date-format="dd/mm/yyyy" data-date="">
                                                                                    <input class="span8" size="16" name="data_prospecto" value="<? if(trim($row['data_prospecto'])==""||trim($row['data_prospecto'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_prospecto'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="span3">
                                                                                <label>Virou cliente</label>
                                                                                <div class="input-append date" id="data_cliente" data-date-format="dd/mm/yyyy" data-date="">
                                                                                    <input class="span8" size="16" name="data_cliente" value="<? if(trim($row['data_cliente'])==""||trim($row['data_cliente'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_cliente'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            -->
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
                                                                        <div class="formSep">
                                                                            <div class="span4">
                                                                                <label>E-mail principal</label>
                                                                                <input value="<?=$row['email']?>" class="span12" type="text" name="email" id="email" />
                                                                            </div>
                                                                            <div class="span2">
                                                                                <label>Senha</label>
                                                                                <div class="input-append">
                                                                                <input value="<?=$row['senha']?>" class="span12" type="text" name="senha" id="senha" />
                                                                                <button type="button" onclick="gera_senha();" class="btn">Gerar Senha</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div id="tb3_c" class="tab-pane" style="min-height:350px;">
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
            
                                                                        <!--
                                                                        <div class="formSep">
                                                                            <label>Website</label>
                                                                            <input value="<?=$row['website']?>" class="span4" type="text" name="website" id="website" />
                                                                            <span class="help-block">http://www.dominio.com</span>
                                                                        </div>
                                                                        -->
                                                                    </div>
                                                                    
                                                                    <div id="tb3_d" class="tab-pane" style="min-height:350px;">
                                                                        <p style="float:left;width:100%;color:#368CA9;"><b>Telefones</b></p>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Principal ?</label>
                                                                                <select id="principal_item" style="width:80px;">
                                                                                    <option value="0">NÃO</option>
                                                                                    <option value="1">SIM</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome (Ex: Celular, Comercial...)</label>
                                                                                <input style="float:left;width:250px;" value="" id="nometel_item" type="text">
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Operadora</label>
                                                                                <select id="operadora_item" style="width:130px;">
                                                                                    <option value="">---</option>
                                                                                    <option value="Oi">Oi</option>
                                                                                    <option value="TIM">TIM</option>
                                                                                    <option value="Claro">Claro</option>
                                                                                    <option value="Vivo">Vivo</option>
                                                                                    <option value="Nextel">Nextel</option>
                                                                                    <option value="Outra">Outra</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Telefone (DDD + Número)</label>
                                                                                <input style="float:left;margin-right:10px;width:50px;" value="" id="ddd_item" type="text">
                                                                                <input style="float:left;width:200px;" value="" id="telefone_item" type="text">
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <button type="button" onclick="salvar_lista_telefones('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_telefones" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_telefones.php"); ?>
                                                                            </div>
                                                                        </div>

                                                                        <p style="float:left;width:100%;color:#368CA9;"><b>E-mail's</b></p>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome</label>
                                                                                <input style="float:left;width:350px;" value="" id="nomeemail_item" type="text">
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>E-mail</label>
                                                                                <input style="float:left;width:350px;" value="" id="email_item" type="text">
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <button type="button" onclick="salvar_lista_emails('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_emails" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_emails.php"); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div id="tb3_e" class="tab-pane" style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome (Ex: Comercial, Residencial...)</label>
                                                                                <input value="" style="width:250px;" type="text" id="nome_endereco" />
                                                                                <span class="help-block">Digite um nome para identificar este endereço</span>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Principal ?</label>
                                                                                <select id="principal" style="width:80px;">
                                                                                    <option value="0">NÃO</option>
                                                                                    <option value="1">SIM</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>CEP</label>
                                                                                <input value=">" style="width:90px;" type="text" id="cep" />
                                                                                <span class="help-block">99999-999</span>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;margin-top:27px;">
                                                                                <button type="button" onclick="buscaCep();" class="btn btn-small">Carregar endereço</button>
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <label>Endereço</label>
                                                                            <input value="" class="span9" type="text" id="rua" />
                                                                        </div>

                                                                        <!--
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Rua</label>
                                                                                <input value="" style="width:350px;" type="text" id="rua" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Número</label>
                                                                                <input value="" style="width:50px;" type="text" id="numero" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Complemento</label>
                                                                                <input value="" style="width:250px;" type="text" id="complemento" />
                                                                            </div>
                                                                        </div>
                                                                        -->
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Estado</label>
                                                                                <select id="estado" style="width:255px;" onchange="mostraCidades();">
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
                                                                                <select id="cidade" onchange="javascript:mostraBairros();" style="width:255px">
                                                                                    <option value="">---</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Bairro</label>
                                                                                <select id="bairro" style="width:255px;">
                                                                                    <option value="">---</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <button type="button" onclick="salvar_lista_endereco('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_endereco" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_endereco.php"); ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    
                                                                    <div id="tb3_f" class="tab-pane" style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <div class="span3">
                                                                                <label>Nome</label>
                                                                                <input value="" class="span12" type="text" id="nome_item" placeholder="Digite o nome da rede" />
                                                                            </div>
                                                                            <div class="span5" >
                                                                                <label>Link</label>
                                                                                <input value="" class="span12" type="text" id="link_item" placeholder="Digite ou cole aqui o link da rede" />
                                                                            </div>
                                                                            <div class="span2" >
                                                                                <button type="button" onclick="salvar_lista_redes('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de itens</div>
                                                                            <div id="lista_syscliente_redes" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_redes.php"); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div id="tb3_i" class="tab-pane" style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome</label>
                                                                                <input value="" style="width:250px;" type="text" id="nome_banco" />
                                                                                <span class="help-block">Digite um nome para identificar este banco</span>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Principal ?</label>
                                                                                <select id="principal_banco" style="width:80px;">
                                                                                    <option value="0">NÃO</option>
                                                                                    <option value="1">SIM</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Tipo de Conta</label>
                                                                                <select id="tipo_conta" style="width:180px;" onchange="tipo_favorecido();">
                                                                                    <option value="">---</option>
                                                                                    <option value="cc-pf">Conta Corrente - PF</option>
                                                                                    <option value="cp-pf">Conta Poupança - PF</option>
                                                                                    <option value="cc-pj">Conta Corrente - PJ</option>
                                                                                    <option value="cp-pj">Conta Poupança - PJ</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome do Favorecido</label>
                                                                                <input value="" style="width:250px;" type="text" id="favorecido" />
                                                                            </div>
                                                                            <div id="div-favorecido_cpf" style="float:left;margin-right:10px;display:none;">
                                                                                <label>CPF</label>
                                                                                <input value="" style="width:150px;" type="text" id="favorecido_cpf" />
                                                                            </div>
                                                                            <div id="div-favorecido_cnpj" style="float:left;margin-right:10px;display:none;">
                                                                                <label>CNPJ</label>
                                                                                <input value="" style="width:150px;" type="text" id="favorecido_cnpj" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Banco</label>
                                                                                <select id="idbanco" style="width:350px;">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysbanco_lista WHERE stat='1' ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Agência</label>
                                                                                <input value="" style="width:100px;" type="text" id="agencia" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Conta</label>
                                                                                <input value="" style="width:150px;" type="text" id="conta" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Operação</label>
                                                                                <input value="" style="width:80px;" type="text" id="operacao" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <button type="button" onclick="salvar_lista_banco('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_banco" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_banco.php"); ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div id="tb3_k" class="tab-pane " style="min-height:350px;">
																		<? $rSqlClassificacao = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_classificacao_set WHERE idsyscliente='".$row['id']."'")); ?>
                                                                        <script>
																		function salvar_classificacao() {

																			$.ajax({
																				url: ""+linkSite+"acoes/syscliente/salva-classificacao.php",
																				type: "GET",
																				data: "modS=<?=$mod?>&idsysclienteS=<?=$row['id']?><? $qSqlItem = mysql_query("SELECT * FROM ".$mod."_classificacao WHERE stat='1' ORDER BY ordem"); while($rSqlItem = mysql_fetch_array($qSqlItem)) { ?>&classificacao_<?=$rSqlItem['numeroUnico']?>S="+$('#classificacao_<?=$rSqlItem['numeroUnico']?>').val()+"<? } ?>",
																				//dataType: "html",
																				success: function(data){
																					$("#nota-classificacao").html(data);
																				},
																			});

																		}
                                                                        </script>
																		<?
																		$cont = 0;
																		$soma = 0;
                                                                        $qSqlItem = mysql_query("SELECT * FROM ".$mod."_classificacao WHERE stat='1' ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																			$cont++;
																			$soma = $rSqlClassificacao[''.$rSqlItem['numeroUnico'].''] + $soma;
                                                                        ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label><?=$rSqlItem['nome']?></label>
                                                                                <select id="classificacao_<?=$rSqlItem['numeroUnico']?>" style="width:50px;">
                                                                                    <option value="">---</option>
                                                                                    <? for ($i = 1; $i <= 10; $i++) { ?>
                                                                                    <option value="<?=$i?>" <? if($i==$rSqlClassificacao[''.$rSqlItem['numeroUnico'].'']) { echo "selected"; } ?>><?=$i?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <? } ?>
                                                                        <div class="formSep" id="nota-classificacao"><? echo "Classificação Geral: ".$soma / $cont."";?></div>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <button type="button" onclick="salvar_classificacao();" style="margin-top:23px;" class="btn btn-primary">Salvar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="tb3_g" class="tab-pane " style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <!--
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Status do cliente</label>
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
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Quem prospectou</label>
                                                                                <select name="idsysusu_prospecto" id="idsysusu_prospecto">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($row['idsysusu_prospecto']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            -->
                                                                        </div>
                                                                        <div class="formSep">
                                                                            <label>Observações</label>
                                                                            <textarea name="obs" id="obs_editar" class="span12" style="height:150px;"><?=$row['obs']?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div id="tb3_h" class="tab-pane <? if(trim($_REQUEST['var5'])=="arquivos") { ?>active<? } ?>" style="min-height:350px;">
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
                                                                            <? $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/".$mod."/lista_galeria.php"); ?>
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

                                                <!--
                                                <div id="tb1_contratos" class="tab-pane">
                                                    <div class="w-box w-box">
                                                        <div class="w-box-header">
                                                            <div class="pull-left">
                                                                <div class="toggle-group">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="w-box-content">
                                                            <form name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <table id="dt_basic_syscontrato" class="table table-striped table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:150px;">Data do prospecto</th>
                                                                    <th style="width:150px;">Data do aceite</th>
                                                                    <th style="width:150px;">Atendente</th>
                                                                    <th style="width:150px;">Total de produto</th>
                                                                    <th style="width:150px;">Total de desconto</th>
                                                                    <th style="width:150px;">Total de Invest.</th>
                                                                    <th style="width:150px;">Total de Mensalidade</th>
                                                                    <th style="width:170px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM syscontrato WHERE idsyscliente='".$_REQUEST['var4']."' ORDER BY data DESC");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                     $url_limpa = transformaCaractere($rSql['nome']);
                                                                ?>
                                                                <tr id="linha-<?=$rSql['id']?>">

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
																		<?
                                                                        $rSqlLink = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='syscontrato' AND stat='1' LIMIT 1"));
                                                                        $nomeLimpoLink = transformaCaractere($rSqlLink['nome']);
                                                                        $url_mod = str_replace("_","-",$rSqlLink['bd']);
                                                                        $sysmod_categoria = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlLink['idsysmod_categoria']."'"));
                                                                        $syscontrato_item = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato WHERE idsysprospecto='".$rSql['id']."'"));
                                                                        ?>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?><a href="javascript:void(0);" onclick="envia_email_syscontrato('<?=$rSql['numeroUnico']?>','<?=$rSql['id']?>','<?=$sysmod_categoria['url_amigavel']?>','<?=$nomeLimpoLink?>');" class="btn-mini ptip_se" title="Enviar e-mail"><img id="img-envia-email-<?=$rSql['id']?>" src="<?=$link?>template/img/icones_novos/16/email-send.png" /></a><? } ?>
                                                                        <? if(trim($rSql['aceito'])=="1") { ?>
                                                                            <a href="javascript:void(0);" class="btn-mini ptip_se" title="Aceite digital realizado"><img src="<?=$link?>template/img/icones_novos/16/bullet_verde.png" /></a>
                                                                        <? } else { ?>
                                                                            <a href="javascript:void(0);" class="btn-mini ptip_se" title="Aceite digital pendente"><img src="<?=$link?>template/img/icones_novos/16/bullet_vermelho.png" /></a>
                                                                        <? } ?>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a><? } ?>
                                                                        <? if(trim($sysperm['excluir_'.$mod.''])==1) { ?><a href="javascript:void(0);" onclick="remover_syscontrato('<?=$rSql['id']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a><? } ?>
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

                                                <div id="tb1_servicos" class="tab-pane">
                                                    <div class="w-box w-box">
                                                        <div class="w-box-header">
                                                            <div class="pull-left">

                                                            </div>
                                                        </div>
                                                        <div class="w-box-content">
                                                            <form name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <table id="dt_basic_syscontrato_item" class="table table-striped table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:150px;">Ref. ao contrato</th>
                                                                    <th style="width:150px;">Atendente</th>
                                                                    <th style="width:150px;">Data do prospecto</th>
                                                                    <th style="width:150px;">Data do aceite</th>
                                                                    <th style="width:150px;">Produto</th>
                                                                    <th style="width:150px;">Total de produto</th>
                                                                    <th style="width:150px;">Total de desconto</th>
                                                                    <th style="width:150px;">Total de Invest.</th>
                                                                    <th style="width:150px;">Total de Mensalidade</th>
                                                                    <th style="width:40px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
																$lista_syscontrato_numeroUnico = "";
																$qSqlCat = mysql_query("SELECT * FROM syscontrato WHERE idsyscliente='".$_REQUEST['var4']."' AND aceito='1'");
																while($rSqlCat = mysql_fetch_array($qSqlCat)) {
																	if(trim($lista_syscontrato_numeroUnico)=="") {
																		$lista_syscontrato_numeroUnico = "'".$rSqlCat['numeroUnico']."'";
																	} else {
																		$lista_syscontrato_numeroUnico = $lista_syscontrato_numeroUnico.",'".$rSqlCat['numeroUnico']."'";
																	}
																}

                                                                $qSql = mysql_query("SELECT * FROM syscontrato_item WHERE numeroUnico_pai IN (".$lista_syscontrato_numeroUnico.") ORDER BY data DESC");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                ?>
                                                                <tr id="linha-<?=$rSql['id']?>">

                                                                    <? $syscontrato = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato WHERE numeroUnico='".$rSql['numeroUnico_pai']."'")); ?>
                                                                    <td style="vertical-align:middle;">#<?=$syscontrato['numeroUnico']?></td>

                                                                    <? $sysusu = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$syscontrato['idsysusu']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$sysusu['nome']?></td>
                                                                    
                                                                    <td style="vertical-align:middle;"><? if(trim($syscontrato['data_post'])==""||trim($syscontrato['data_post'])=="0000-00-00") { } else { ajustaData($syscontrato['data_post'],"d-m-Y"); } ?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($syscontrato['data_aceito'])==""||trim($syscontrato['data_aceito'])=="0000-00-00") { } else { ajustaData($syscontrato['data_aceito'],"d-m-Y"); } ?></td>

                                                                    <? $sysproduto = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto WHERE id='".$rSql['idsysproduto']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$sysproduto['nome']?></td>

                                                                    <?
																	$valor_limpo = str_replace(".","",$rSql['valor']); 
																	for ($i = 1; $i <= 10; $i++) {
																		$valor_limpo = str_replace(".","",$valor_limpo);
																	}
																	$valor_limpo = str_replace(",",".",$valor_limpo);

																	$valor_desconto_limpo = str_replace(".","",$rSql['valor_desconto']); 
																	for ($i = 1; $i <= 10; $i++) {
																		$valor_desconto_limpo = str_replace(".","",$valor_desconto_limpo);
																	}
																	$valor_desconto_limpo = str_replace(",",".",$valor_desconto_limpo);

																	$valor_mensalidade_limpo = str_replace(".","",$rSql['valor_mensalidade']); 
																	for ($i = 1; $i <= 10; $i++) {
																		$valor_mensalidade_limpo = str_replace(".","",$valor_mensalidade_limpo);
																	}
																	$valor_mensalidade_limpo = str_replace(",",".",$valor_mensalidade_limpo);

																	$valor_subtotal_investimento = $valor_limpo - $valor_desconto_limpo;
																	?>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['valor'])=="") { } else { ?><?=number_format($valor_limpo, 2, ',','.')?><? } ?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['valor_desconto'])=="") { } else { ?><?=number_format($valor_desconto_limpo, 2, ',','.')?><? } ?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($valor_subtotal_investimento)=="") { } else { ?><?=number_format($valor_subtotal_investimento, 2, ',','.')?><? } ?></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['valor_mensalidade'])=="") { } else { ?><?=number_format($valor_mensalidade_limpo, 2, ',','.')?><? } ?></td>
                                                                    
                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">
																		<?
                                                                        $rSqlLink = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE bd='syscontrato' AND stat='1' LIMIT 1"));
                                                                        $nomeLimpoLink = transformaCaractere($rSqlLink['nome']);
                                                                        $url_mod = str_replace("_","-",$rSqlLink['bd']);
                                                                        $sysmod_categoria = mysql_fetch_array(mysql_query("SELECT * FROM sysmod_categoria WHERE id='".$rSqlLink['idsysmod_categoria']."'"));
                                                                        $syscontrato_item = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato WHERE idsysprospecto='".$rSql['id']."'"));
                                                                        ?>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?><a href="<?=$link?><?=$sysmod_categoria['url_amigavel']?>/<?=$nomeLimpoLink?>/editar/<?=$syscontrato['id']?>" class="btn-mini ptip_se" title="Visualizar contrato"><img src="<?=$link?>template/img/icones_novos/16/contrato.png" /></a><? } ?>
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
                                                -->

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

    <table id="example" cellspacing="0" width="100%" class="table table-striped table-condensed">

        <thead>
            <tr>
                <th style="width:20px;" class="table_checkbox"><input type="checkbox" name="select_msgs" class="select_msgs ptip_se" title="Selecionar todos" data-tableid="dt_basic" /></th>
                <th>Nome</th>
                <th>Telefone</th>
                <th style="width:110px;">Ações</th>
            </tr>
        </thead>
 
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
                                                                    <!--<li><a data-toggle="tab" href="#tb3_b">Dados de acesso</a></li>-->
                                                                    <li><a data-toggle="tab" href="#tb3_c">Dados complementares</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_d">Contatos</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_e">Endereço</a></li>
                                                                    <!--<li><a data-toggle="tab" href="#tb3_f">Redes Sociais</a></li>-->
                                                                    <li><a data-toggle="tab" href="#tb3_i">Dados bancários</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_g">Observações</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_h">Arquivos</a></li>
                                                                </ul>
                                                                <div class="tab-content">

                                                                    <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">
            
                                                                        <!--
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
                                                                        -->
                
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
                                                                            <!--
                                                                            <div class="span3">
                                                                                <label>Data de Prospecto</label>
                                                                                <div class="input-append date" id="data_prospecto" data-date-format="dd/mm/yyyy" data-date="">
                                                                                    <input class="span8" size="16" name="data_prospecto" value="" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="span3">
                                                                                <label>Virou cliente</label>
                                                                                <div class="input-append date" id="data_cliente" data-date-format="dd/mm/yyyy" data-date="">
                                                                                    <input class="span8" size="16" name="data_cliente" value="" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            -->
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

                                                                    <div id="tb3_b" class="tab-pane" style="min-height:350px;">

                                                                        <div class="formSep">
                                                                            <div class="span4">
                                                                                <label>E-mail principal</label>
                                                                                <input value="" class="span12" type="text" name="email" id="email" />
                                                                                <span class="help-block">Este e-mail será utilizado para o cliente acessar o painel de controle e também para toda comunicação que for feita através do sistema</span>
                                                                            </div>
                                                                            <div class="span2">
                                                                                <label>Senha</label>
                                                                                <div class="input-append">
                                                                                <input value="" class="span12" type="text" name="senha" id="senha" />
                                                                                <button type="button" onclick="gera_senha();" class="btn">Gerar Senha</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                            
                                                                    </div>

                                                                    <div id="tb3_c" class="tab-pane" style="min-height:350px;">
            
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
            
                                                                        <!--
                                                                        <div class="formSep">
                                                                            <label>Website</label>
                                                                            <input value="" class="span4" type="text" name="website" id="website" />
                                                                            <span class="help-block">http://www.dominio.com</span>
                                                                        </div>
                                                                        -->
            
                                                                    </div>

                                                                    <div id="tb3_d" class="tab-pane" style="min-height:350px;">
                                                                        <p style="float:left;width:100%;color:#368CA9;"><b>Telefones</b></p>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Principal ?</label>
                                                                                <select id="principal_item" style="width:80px;">
                                                                                    <option value="0">NÃO</option>
                                                                                    <option value="1">SIM</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome (Ex: Celular, Comercial...)</label>
                                                                                <input style="float:left;width:250px;" value="" id="nometel_item" type="text">
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Operadora</label>
                                                                                <select id="operadora_item" style="width:130px;">
                                                                                    <option value="">---</option>
                                                                                    <option value="Oi">Oi</option>
                                                                                    <option value="TIM">TIM</option>
                                                                                    <option value="Claro">Claro</option>
                                                                                    <option value="Vivo">Vivo</option>
                                                                                    <option value="Nextel">Nextel</option>
                                                                                    <option value="Outra">Outra</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Telefone (DDD + Número)</label>
                                                                                <input style="float:left;margin-right:10px;width:50px;" value="" id="ddd_item" type="text">
                                                                                <input style="float:left;width:120px;" value="" id="telefone_item" type="text">
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <button type="button" onclick="salvar_lista_telefones('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_telefones" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_telefones.php"); ?>
                                                                            </div>
                                                                        </div>

                                                                        <p style="float:left;width:100%;color:#368CA9;"><b>E-mail's</b></p>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome</label>
                                                                                <input style="float:left;width:350px;" value="" id="nomeemail_item" type="text">
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>E-mail</label>
                                                                                <input style="float:left;width:350px;" value="" id="email_item" type="text">
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <button type="button" onclick="salvar_lista_emails('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_emails" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_emails.php"); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="tb3_e" class="tab-pane" style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome (Ex: Comercial, Residencial...)</label>
                                                                                <input value="" style="width:250px;" type="text" id="nome_endereco" />
                                                                                <span class="help-block">Digite um nome para identificar este endereço</span>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Principal ?</label>
                                                                                <select id="principal" style="width:80px;">
                                                                                    <option value="0">NÃO</option>
                                                                                    <option value="1">SIM</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>CEP</label>
                                                                                <input value=">" style="width:90px;" type="text" id="cep" />
                                                                                <span class="help-block">99999-999</span>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;margin-top:27px;">
                                                                                <button type="button" onclick="buscaCep();" class="btn btn-small">Carregar endereço</button>
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <label>Endereço</label>
                                                                            <input value="" class="span9" type="text" id="rua" />
                                                                        </div>

                                                                        <!--
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Rua</label>
                                                                                <input value="" style="width:350px;" type="text" id="rua" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Número</label>
                                                                                <input value="" style="width:50px;" type="text" id="numero" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Complemento</label>
                                                                                <input value="" style="width:250px;" type="text" id="complemento" />
                                                                            </div>
                                                                        </div>
                                                                        -->

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Estado</label>
                                                                                <select id="estado" style="width:255px;" onchange="mostraCidades();">
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
                                                                                <select id="cidade" onchange="javascript:mostraBairros();" style="width:255px">
                                                                                    <option value="">---</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Bairro</label>
                                                                                <select id="bairro" style="width:255px;">
                                                                                    <option value="">---</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <button type="button" onclick="salvar_lista_endereco('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_endereco" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_endereco.php"); ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div id="tb3_f" class="tab-pane" style="min-height:350px;">

                                                                        <div class="formSep">
                                                                            <div class="span3">
                                                                                <label>Nome</label>
                                                                                <input value="" class="span12" type="text" id="nome_item" placeholder="Digite o nome da rede" />
                                                                            </div>
                                                                            <div class="span5" >
                                                                                <label>Link</label>
                                                                                <input value="" class="span12" type="text" id="link_item" placeholder="Digite ou cole aqui o link da rede" />
                                                                            </div>
                                                                            <div class="span2" >
                                                                                <button type="button" onclick="salvar_lista_redes('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de itens</div>
                                                                            <div id="lista_syscliente_redes" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_redes.php"); ?>
                                                                            </div>
                                                                        </div>
            
                                                                    </div>

                                                                    <div id="tb3_i" class="tab-pane" style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome</label>
                                                                                <input value="" style="width:250px;" type="text" id="nome_banco" />
                                                                                <span class="help-block">Digite um nome para identificar este banco</span>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Principal ?</label>
                                                                                <select id="principal_banco" style="width:80px;">
                                                                                    <option value="0">NÃO</option>
                                                                                    <option value="1">SIM</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Tipo de Conta</label>
                                                                                <select id="tipo_conta" style="width:180px;" onchange="tipo_favorecido();">
                                                                                    <option value="">---</option>
                                                                                    <option value="cc-pf">Conta Corrente - PF</option>
                                                                                    <option value="cp-pf">Conta Poupança - PF</option>
                                                                                    <option value="cc-pj">Conta Corrente - PJ</option>
                                                                                    <option value="cp-pj">Conta Poupança - PJ</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Nome do Favorecido</label>
                                                                                <input value="" style="width:250px;" type="text" id="favorecido" />
                                                                            </div>
                                                                            <div id="div-favorecido_cpf" style="float:left;margin-right:10px;display:none;">
                                                                                <label>CPF</label>
                                                                                <input value="" style="width:150px;" type="text" id="favorecido_cpf" />
                                                                            </div>
                                                                            <div id="div-favorecido_cnpj" style="float:left;margin-right:10px;display:none;">
                                                                                <label>CNPJ</label>
                                                                                <input value="" style="width:150px;" type="text" id="favorecido_cnpj" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Banco</label>
                                                                                <select id="idbanco" style="width:350px;">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysbanco_lista WHERE stat='1' ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Agência</label>
                                                                                <input value="" style="width:100px;" type="text" id="agencia" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Conta</label>
                                                                                <input value="" style="width:150px;" type="text" id="conta" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Operação</label>
                                                                                <input value="" style="width:80px;" type="text" id="operacao" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <button type="button" onclick="salvar_lista_banco('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_banco" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/syscliente/lista_".$mod."_banco.php"); ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div id="tb3_g" class="tab-pane" style="min-height:350px;">

                                                                        <div class="formSep">
                                                                            <!--
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Status do cliente</label>
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
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Classificação</label>
                                                                                <select name="id<?=$mod?>_classificacao" id="id<?=$mod?>_classificacao">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$mod."_classificacao WHERE stat='1' ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Quem prospectou</label>
                                                                                <select name="idsysusu_prospecto" id="idsysusu_prospecto">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            -->
                                                                        </div>
                                                                        <div class="formSep">
                                                                            <label>Observações</label>
                                                                            <textarea name="obs" id="obs" class="span12" style="height:150px;"></textarea>
                                                                        </div>
        
                                                                    </div>

                                                                    <div id="tb3_h" class="tab-pane" style="min-height:350px;">
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
