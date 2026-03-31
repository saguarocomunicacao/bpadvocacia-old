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
                                                <? if(trim($sysperm['descricao_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_config">Descrição</a></li><? } ?>
                                                <? if(trim($sysperm['seo_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_config_seo">Configurações de SEO</a></li><? } ?>
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
            
												//* switch buttons
												beoro_switchButtons.init();
			
												beoro_select_row.init();

												//* WYSIWG Editor
												beoro_wysiwg.init();
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

															"processing": true,
															"serverSide": true,
															"aaSorting": [[ 4, "desc" ]],
															"iDisplayLength": 50,
															"ajax": "<?=$link?>acoes/trabalhe_conosco/tabela.php?var1=<?=$_REQUEST['var1']?>&var2=<?=$_REQUEST['var2']?>&var3=<?=$_REQUEST['var3']?>&var4=<?=$_REQUEST['var4']?>&var5=<?=$_REQUEST['var5']?>&sysusuS=<?=$sysusu['id']?>",
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
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" }
															]

                                                        });
                                                    }
                                                }
                                            };
					
											//* switch buttons
											beoro_switchButtons = {
												init: function() {
													if($('#url_amigavel_ativa').length) { $("#url_amigavel_ativa").iButton(); }

													<? if(trim($sysusu['adm'])==1) { ?>
													if($('#seo_estrutura').length) { $("#seo_estrutura").iButton(); }
													<? } ?>
												}
											};

											//* WYSIWG Editor
											beoro_wysiwg = {
												init: function() {
													if($('#mensagem').length) { 
														CKEDITOR.replace( 'mensagem', {
															toolbar: 'Standard'
														});
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#mensagem_editar').length) { 
														CKEDITOR.replace( 'mensagem_editar', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
													if($('#texto_descricao').length) { 
														CKEDITOR.replace( 'texto_descricao', {
															toolbar: 'Standard'
														});
													}
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
                
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Nome</label>
                                                                    <input value="<?=$row['nome']?>" style="width:350px;" type="text" name="nome" id="nome" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Telefone Principal</label>
                                                                    <input value="<?=$row['telefone_1']?>" style="width:150px;" type="text" name="telefone_1" id="telefone_1" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Telefone Secundário</label>
                                                                    <input value="<?=$row['telefone_2']?>" style="width:150px;" type="text" name="telefone_2" id="telefone_2" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>E-mail</label>
                                                                    <input value="<?=$row['email']?>" style="width:350px;" type="text" name="email" id="email" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Como Achou ?</label>
                                                                    <select name="como_achou" id="como_achou">
                                                                        <option value="">---</option>
                                                                          <option value="Google" <? if($row['como_achou']=="Google") { echo "selected"; } ?>>Google</option>
                                                                          <option value="Outros buscadores" <? if($row['como_achou']=="Outros buscadores") { echo "selected"; } ?>>Outros buscadores</option>
                                                                          <option value="Revistas" <? if($row['como_achou']=="Revistas") { echo "selected"; } ?>>Revistas</option>
                                                                          <option value="Indicações" <? if($row['como_achou']=="Indicações") { echo "selected"; } ?>>Indicações</option>
                                                                          <option value="Parceiros" <? if($row['como_achou']=="Parceiros") { echo "selected"; } ?>>Parceiros</option>
                                                                          <option value="Mídia Online" <? if($row['como_achou']=="Mídia Online") { echo "selected"; } ?>>Mídia Online</option>
                                                                          <option value="Cliente" <? if($row['como_achou']=="Cliente") { echo "selected"; } ?>>Cliente</option>
                                                                          <option value="Eventos" <? if($row['como_achou']=="Eventos") { echo "selected"; } ?>>Eventos</option>
                                                                          <option value="Redes Sociais" <? if($row['como_achou']=="Redes Sociais") { echo "selected"; } ?>>Redes Sociais</option>
                                                                          <option value="Rádio" <? if($row['como_achou']=="Rádio") { echo "selected"; } ?>>Rádio</option>
                                                                          <option value="Outros" <? if($row['como_achou']=="Outros") { echo "selected"; } ?>>Outros</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Anexar Currículo</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail">
                                                                    <? if(trim($row['curriculo'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['curriculo']?>"><?=$row['curriculo']?></a>
                                                                    <? } ?>
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <? if(trim($row['curriculo'])=="") { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span class="fileupload-new">Selecionar arquivo</span>
                                                                        <span class="fileupload-exists">Alterar</span>
                                                                        <input name="curriculo" type="file">
                                                                    </span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                    <? } else { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span>Alterar</span>
                                                                        <input name="curriculo" type="file">
                                                                    </span>
                                                                    <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>_item','curriculo');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                    <? } ?>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Mensagem</label>
                                                                <textarea name="mensagem" id="mensagem_editar" class="span12" style="height:150px;"><?=$row['mensagem']?></textarea>
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
                                                                        <th>Nome</th>
                                                                        <th>E-mail</th>
                                                                        <th>Telefone</th>
                                                                        <th>Data do envio</th>
                                                                        <th style="width:90px;">Ações</th>
                                                                    </tr>
                                                                </thead>
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


                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Nome</label>
                                                                    <input value="" style="width:350px;" type="text" name="nome" id="nome" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Telefone Principal</label>
                                                                    <input value="" style="width:150px;" type="text" name="telefone_1" id="telefone_1" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Telefone Secundário</label>
                                                                    <input value="" style="width:150px;" type="text" name="telefone_2" id="telefone_2" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>E-mail</label>
                                                                    <input value="" style="width:350px;" type="text" name="email" id="email" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label class="req">Currículo</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="curriculo" type="file"></span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Como Achou ?</label>
                                                                    <select name="como_achou" id="como_achou">
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
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Mensagem</label>
                                                                <textarea name="mensagem" id="mensagem" class="span12" style="height:150px;"></textarea>
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

                                                <div id="tb1_config" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="acaoForm" value="config" />
                            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título da Página</label>
                                                                    <input value="<?=$row_config['nome']?>" style="width:350px;" type="text" name="nome" id="nome_seo" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <label>Imagem do Cabeçalho</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail">
                                                                    <? if(trim($row_config['imagem_descricao'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['imagem_descricao']?>"><img style="width:50px;" id="arquivo-atual-imagem_descricao" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['imagem_descricao']?>" alt=""></a>
                                                                    <? } ?>
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <? if(trim($row_config['imagem_descricao'])=="") { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span class="fileupload-new">Selecionar arquivo</span>
                                                                        <span class="fileupload-exists">Alterar</span>
                                                                        <input name="imagem_descricao" type="file">
                                                                    </span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                    <? } else { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span>Alterar</span>
                                                                        <input name="imagem_descricao" type="file">
                                                                    </span>
                                                                    <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>_config','imagem_descricao');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                    <? } ?>
                                                                </div>
                                                            </div>

                                                            <? if(trim($row_estrutura['titulo_texto'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                <label>Título do Texto</label>
                                                                    <input value="<?=$row_config['titulo_texto']?>" style="width:350px;" type="text" name="titulo_texto" id="titulo_texto" />
                                                                </div>
                                                            </div>
                                                            <? } ?>
            
                                                            <div class="formSep">
                                                                <label>Texto</label>
                                                                <textarea name="texto_descricao" id="texto_descricao" class="span12" style="height:150px;"><?=$row_config['texto_descricao']?></textarea>
                                                            </div>
                            
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div id="tb1_config_seo" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data">
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="acaoForm" value="config_seo" />
                
                                                            <? 
															if(trim($row_config['titulo_seo'])=="") {
																if(trim($row_config['nome'])=="") {
																	$titulo_seo = "Título"; 
																	$tamanho_titulo_seo = 55; 
																} else {
																	$titulo_seo = $row_config['nome']; 
																	$tamanho_titulo_seo = 55 - strlen($row_config['nome']); 
																}
															} else {
																$titulo_seo = $row_config['titulo_seo']; 
																$tamanho_titulo_seo = 55 - strlen($row_config['titulo_seo']); 
															}

															if(trim($row_config['texto_seo'])=="") {  
																$texto_seo = "Se você não acrescentar nenhum texto, o Meta Description não será exibido"; 
																$tamanho_texto_seo = 150; 
															} else {
																$texto_seo = $row_config['texto_seo']; 
																$tamanho_texto_seo = 150 - strlen($row_config['texto_seo']); 
															}
															?>
                                                            <div class="formSep">
                                                                <div style="float:left;width:100%;font-size:18px;color:#1e0fbe;text-decoration: none;" id="SEO_titulo_seo_google"><?=$titulo_seo?></div>
                                                                <div style="float:left;width:100%;font-size:medium;color:#006621;" id="SEO_url_amigavel_google"><?=$link_site?><?=$row_config['url_amigavel']?></div>
                                                                <div style="float:left;width:100%;font-size:small;color:#444;margin-bottom:10px;" id="SEO_texto_seo_google"><?=$texto_seo?></div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título</label>
                                                                    <input value="<?=$titulo_seo?>" style="width:550px;" onkeyup="cria_seo_titulo_e_url('SEO_titulo_seo','SEO_titulo_seo_google','SEO_url_amigavel','SEO_url_amigavel_google','<?=$titulo_seo?>','SEO_titulo_seo_contador','55');" type="text" name="titulo_seo" id="SEO_titulo_seo" />
                                                                    <div style="float:left;width:100%;">A visualização do título em mecânismos de busca é limitada à 55 caracteres, <span style="color:#090;" id="SEO_titulo_seo_contador"><?=$tamanho_titulo_seo?></span> restantes.</div>
                                                                </div>
                                                            </div>

                                                            <div class="formSep" style="width:500px;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">URL Amigável</label>
                                                                    <input value="<?=$row_config['url_amigavel']?>" onkeyup="controle_url_amigavel('SEO_url_amigavel','SEO_url_amigavel_google');"  style="width:350px;" type="text" name="url_amigavel" id="SEO_url_amigavel" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativa ?</label>
                                                                    <input type="checkbox" name="url_amigavel_ativa" id="url_amigavel_ativa" <? if(trim($row_config['url_amigavel_ativa'])==1) { echo " checked"; } ?> class="url_amigavel_ativa {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Texto (Meta-Description)</label>
                                                                <textarea name="texto_seo" id="SEO_texto_seo" onkeyup="controle_meta_description('SEO_texto_seo','SEO_texto_seo_google','SEO_texto_seo_contador','<?=$texto_seo?>','150');" class="span12" style="height:150px;"><?=$row_config['texto_seo']?></textarea>
                                                                <div style="float:left;width:100%;">O Meta-Description esta limitado à 150 caracteres, <span style="color:#090;" id="SEO_texto_seo_contador"><?=$tamanho_texto_seo?></span> restantes.</div>
                                                            </div>

                                                            <?
															if(trim($row_config['url_amigavel'])=="") {
																echo"<script>cria_seo_titulo_e_url('SEO_titulo_seo','SEO_titulo_seo_google','SEO_url_amigavel','SEO_url_amigavel_google','".$titulo_seo."','SEO_titulo_seo_contador','55');</script>";
															}
															?>
                
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

												<? if(trim($sysusu['adm'])==1) { ?>
                                                <div id="tb1_estrutura" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="acaoForm" value="estrutura" />
                
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Configurações de SEO</label>
                                                                    <input value="<?=$row_estrutura['seo_label']?>"  style="width:350px;" type="text" name="seo_label" id="seo_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="seo" id="seo_estrutura" <? if(trim($row_estrutura['seo'])==1) { echo " checked"; } ?> class="seo_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                                <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
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
