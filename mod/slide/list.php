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
												<? if(trim($sysusu['adm'])==1) { ?><li><a data-toggle="tab" href="#tb1_estrutura">Configurações de Estrutura do Módulo</a></li><? } ?>
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
												}
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
																<? if(trim($row_estrutura['ordem'])==1) { ?>{ "bSortable": true },<? } ?>
																<? if(trim($row_estrutura['imagem'])==1) { ?>{ "bSortable": false },<? } ?>
																{ "sType": "string" },
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
													if($('#chamada').length) { 
														CKEDITOR.replace( 'chamada', {
															toolbar: 'Standard'
														});
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#texto_editar').length) { 
														CKEDITOR.replace( 'texto_editar', {
															toolbar: 'Standard'
														});
													}
													if($('#chamada_editar').length) { 
														CKEDITOR.replace( 'chamada_editar', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
												}
											};

											//* switch buttons
											beoro_switchButtons = {
												init: function() {
													if($('#url_amigavel_ativa').length) { $("#url_amigavel_ativa").iButton(); }

													<? if(trim($sysusu['adm'])==1) { ?>
													if($('#seo_estrutura').length) { $("#seo_estrutura").iButton(); }
													if($('#seo_item_estrutura').length) { $("#seo_item_estrutura").iButton(); }
													if($('#ordem_estrutura').length) { $("#ordem_estrutura").iButton(); }
													if($('#transicao_estrutura').length) { $("#transicao_estrutura").iButton(); }
													if($('#nome_estrutura').length) { $("#nome_estrutura").iButton(); }
													if($('#target_estrutura').length) { $("#target_estrutura").iButton(); }
													if($('#link_estrutura').length) { $("#link_estrutura").iButton(); }
													if($('#imagem_estrutura').length) { $("#imagem_estrutura").iButton(); }
													if($('#chamada_estrutura').length) { $("#chamada_estrutura").iButton(); }
													if($('#texto_estrutura').length) { $("#texto_estrutura").iButton(); }

													if($('#nome_seo_estrutura').length) { $("#nome_seo_estrutura").iButton(); }
													if($('#titulo_texto_estrutura').length) { $("#titulo_texto_estrutura").iButton(); }
													if($('#imagem_descricao_estrutura').length) { $("#imagem_descricao_estrutura").iButton(); }
													if($('#imagem_interna_estrutura').length) { $("#imagem_interna_estrutura").iButton(); }
													if($('#chamada_descricao_estrutura').length) { $("#chamada_descricao_estrutura").iButton(); }
													if($('#texto_descricao_estrutura').length) { $("#texto_descricao_estrutura").iButton(); }
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
                
                                                             <? if(trim($row_estrutura['ordem'])==1) { ?>
                                                             <div class="formSep">
                                                                <label><? if(trim($row_estrutura['ordem_label'])=="") { echo "Ordem"; } else { echo $row_estrutura['ordem_label']; } ?></label>
                                                                <select name="ordem" id="ordem" style="width:70px;">
                                                                    <?
                                                                    $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod.""));
                                                                    if($nordem==0) {
                                                                    ?>
                                                                    <option value='1'>1</option>
                                                                    <?
                                                                    } else {
                                                                    $ultimaOrdem = $nordem;
                                                                    for ($b=1; $b<=$ultimaOrdem; $b++) {
                                                                    ?>
                                                                    <option value='<?=$b?>' <? if($b==$row['ordem']) { echo "selected"; } ?>><?=$b?></option>
                                                                    <? } } ?>
                                                                </select>
                                                                <? if(trim($row_estrutura['ordem_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['ordem_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
                
                                                             <? if(trim($row_estrutura['transicao'])==1) { ?>
                                                             <div class="formSep">
                                                                <label><? if(trim($row_estrutura['transicao_label'])=="") { echo "Transição"; } else { echo $row_estrutura['transicao_label']; } ?></label>
                                                                <select name="transicao" id="transicao">
                                                                    <option value="">---</option>
                                                                    <option value='fade' <? if($row['transicao']=="fade") { echo "selected"; } ?>>Esmaecimento</option>
                                                                    <option value='papercut' <? if($row['transicao']=="papercut") { echo "selected"; } ?>>Recorte de Papel</option>
                                                                    <option value='slidedown' <? if($row['transicao']=="slidedown") { echo "selected"; } ?>>Slide de cima para baixo</option>
                                                                    <option value='slidehorizontal' <? if($row['transicao']=="slidehorizontal") { echo "selected"; } ?>>Slide horizontal</option>
                                                                    <option value='flyin' <? if($row['transicao']=="flyin") { echo "selected"; } ?>>Slide Recortado</option>
                                                                </select>
                                                                <? if(trim($row_estrutura['transicao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['transicao_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>

                                                            <? if(trim($row_estrutura['nome'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label><? if(trim($row_estrutura['nome_label'])=="") { echo "Título"; } else { echo $row_estrutura['nome_label']; } ?></label>
                                                                    <input value="<?=$row['nome']?>" style="width:350px;" <? if(trim($row_estrutura['seo_item'])==1) { ?>onkeyup="cria_titulo_e_url('nome','titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','<?=$row['nome']?>','titulo_seo_contador','55');"<? } ?> type="text" name="nome" id="nome" />
                                                                </div>
                                                                <? if(trim($row_estrutura['nome_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['nome_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>

                                                            <? if(trim($row_estrutura['imagem'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['imagem_label'])=="") { echo "Imagem"; } else { echo $row_estrutura['imagem_label']; } ?></label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail">
                                                                    <? if(trim($row['imagem'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['imagem']?>"><img style="width:50px;" id="arquivo-atual-imagem" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['imagem']?>" alt=""></a>
                                                                    <? } ?>
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <? if(trim($row['imagem'])=="") { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span class="fileupload-new">Selecionar arquivo</span>
                                                                        <span class="fileupload-exists">Alterar</span>
                                                                        <input name="imagem" type="file">
                                                                    </span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                    <? } else { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span>Alterar</span>
                                                                        <input name="imagem" type="file">
                                                                    </span>
                                                                    <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                    <? } ?>
                                                                </div>
                                                                <? if(trim($row_estrutura['imagem_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['imagem_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
                
                                                            <? if(trim($row_estrutura['target'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label><? if(trim($row_estrutura['target_label'])=="") { echo "Abrir Onde ?"; } else { echo $row_estrutura['target_label']; } ?></label>
                                                                    <select name="target" id="target" style="width:150px;">
                                                                        <option value='' <? if($row['target']=="") { echo "selected"; } ?>>Não abrir</option>
                                                                        <option value='texto' <? if($row['target']=="texto") { echo "selected"; } ?>>Abrir texto inserido</option>
                                                                        <option value='_parent' <? if($row['target']=="_parent") { echo "selected"; } ?>>Mesma janela</option>
                                                                        <option value='_blank' <? if($row['target']=="_blank") { echo "selected"; } ?>>Nova janela</option>
                                                                    </select>
                                                                </div>
                                                                <? if(trim($row_estrutura['target_info'])=="") { } else { ?><div style="float:left;margin-left:-65px;margin-top:-2px;"><img src="<?=$link?>template/img/ico-info.png" class="ptip_s" title="<?=$row_estrutura['target_info']?>"></div><? } ?>
                                                            </div>
                                                            <? } ?>

                                                            <? if(trim($row_estrutura['link'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label><? if(trim($row_estrutura['link_label'])=="") { echo "Link"; } else { echo $row_estrutura['link_label']; } ?></label>
                                                                    <input value="<?=$row['link']?>" style="width:350px;" type="text" name="link" id="link" />
                                                                </div>
                                                                <? if(trim($row_estrutura['link_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['link_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>

                                                            <? if(trim($row_estrutura['chamada'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['chamada_label'])=="") { echo "Chamada"; } else { echo $row_estrutura['chamada_label']; } ?></label>
                                                                <textarea name="chamada" id="chamada_editar" class="span12" style="height:150px;"><?=$row['chamada']?></textarea>
                                                                <? if(trim($row_estrutura['chamada_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['chamada_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
                
                                                            <? if(trim($row_estrutura['texto'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['texto_label'])=="") { echo "Texto"; } else { echo $row_estrutura['texto_label']; } ?></label>
                                                                <textarea name="texto" id="texto_editar" class="span12" style="height:150px;"><?=$row['texto']?></textarea>
                                                                <? if(trim($row_estrutura['texto_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['texto_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
                
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
                                                            
                                                            <? if(trim($row_estrutura['seo_item'])==1) { ?>
                                                            <p class="heading_a"><a href="javascript:void(0);" onclick="verMais('config_seo_<?=$row['id']?>');" style="text-decoration:underline;"><? if(trim($row_estrutura['seo_item_label'])=="") { echo "Editar configurações SEO"; } else { echo $row_estrutura['seo_item_label']; } ?></a></p>

                                                            <? 
															if(trim($row['titulo_seo'])=="") {
																if(trim($row['nome'])=="") {
																	$titulo = "Título"; 
																	$tamanho_titulo = 55; 
																} else {
																	$titulo = $row['nome']; 
																	$tamanho_titulo = 55 - strlen($row['nome']); 
																}
															} else {
																$titulo = $row['titulo_seo']; 
																$tamanho_titulo = 55 - strlen($row['titulo_seo']); 
															}

															if(trim($row['texto_seo'])=="") {  
																$texto = "Se você não acrescentar nenhum texto, o Meta Description não será exibido"; 
																$tamanho_texto = 150; 
															} else {
																$texto = $row['texto_seo']; 
																$tamanho_texto = 150 - strlen($row['texto_seo']); 
															}
															?>
                                                            <div style="display:none;" id="config_seo_<?=$row['id']?>">
                                                            <div class="formSep">
                                                                <div style="float:left;width:100%;font-size:18px;color:#1e0fbe;text-decoration: none;" id="titulo_seo_google"><?=$titulo?></div>
                                                                <div style="float:left;width:100%;font-size:medium;color:#006621;" id="url_amigavel_google"><?=$link_site?><?=$row['url_amigavel']?></div>
                                                                <div style="float:left;width:100%;font-size:small;color:#444;margin-bottom:10px;" id="texto_seo_google"><?=$texto?></div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título</label>
                                                                    <input value="<?=$titulo?>" style="width:550px;" onkeyup="cria_seo_titulo_e_url('titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','Título','titulo_seo_contador','55');" type="text" name="titulo_seo" id="titulo_seo" />
                                                                    <div style="float:left;width:100%;">A visualização do título em mecânismos de busca é limitada à 55 caracteres, <span style="color:#090;" id="titulo_seo_contador"><?=$tamanho_titulo?></span> restantes.</div>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">URL Amigável</label>
                                                                    <input value="<?=$row['url_amigavel']?>" style="width:550px;" type="text" onkeyup="controle_url_amigavel('url_amigavel','url_amigavel_google');" name="url_amigavel" id="url_amigavel" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label>Texto (Meta-Description)</label>
                                                                <textarea name="texto_seo" id="texto_seo" onkeyup="controle_meta_description('texto_seo','texto_seo_google','texto_seo_contador','<?=$texto?>','150');" class="span12" style="height:150px;"><?=$texto?></textarea>
                                                                <div style="float:left;width:100%;">O Meta-Description esta limitado à 150 caracteres, <span style="color:#090;" id="texto_seo_contador"><?=$tamanho_texto?></span> restantes.</div>
                                                            </div>
                                                            </div>
                                                            <? } ?>

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
                                                                    <? if(trim($row_estrutura['ordem'])==1) { ?>
                                                                    <th style="width:50px;">Ordem</th>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['imagem'])==1) { ?>
                                                                    <th style="width:50px;">Imagem</th>
                                                                    <? } ?>
                                                                    <th><? if(trim($row_estrutura['nome_label'])=="") { echo "Título"; } else { echo $row_estrutura['nome_label']; } ?></th>
                                                                    <th style="width:110px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY ordem");
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
                                                                    <? if(trim($row_estrutura['ordem'])==1) { ?>
                                                                    <td style="vertical-align:middle;"><?=$rSql['ordem']?></td>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['imagem'])==1) { ?>
                                                                    <td style="width:60px">
																		<? if(trim($rSql['imagem'])=="") { ?>
                                                                        <a href="javascript:void(0);" title="<?=$rSql['nome']?>" class="thumbnail"><img alt="" src="<?=$link?>template/img/dummy_50x50.gif" style="height:50px;width:50px"></a>
                                                                        <? } else { ?>
                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>" alt="<?=$rSql['nome']?>"/></a>
                                                                        <? } ?>
                                                                    </td> 
                                                                    <? } ?>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo <? if(trim($row_estrutura['nome_label'])=="") { echo "Título"; } else { echo $row_estrutura['nome_label']; } ?>" data-placeholder="Digite um <? if(trim($row_estrutura['nome_label'])=="") { echo "Título"; } else { echo $row_estrutura['nome_label']; } ?>" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a><? } ?>
                                                                        <? if(trim($sysperm['excluir_'.$mod.''])==1) { ?><a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$mod?>','SIM','<?=$rSql['ordem']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a><? } ?>
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
                                                    <div >
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                             <? if(trim($row_estrutura['ordem'])==1) { ?>
                                                             <div class="formSep">
                                                                <label><? if(trim($row_estrutura['ordem_label'])=="") { echo "Ordem"; } else { echo $row_estrutura['ordem_label']; } ?></label>
                                                                <select name="ordem" id="ordem" style="width:70px;">
                                                                    <?
                                                                    $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod.""));
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
                                                                <? if(trim($row_estrutura['ordem_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['ordem_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
                
                                                             <? if(trim($row_estrutura['transicao'])==1) { ?>
                                                             <div class="formSep">
                                                                <label><? if(trim($row_estrutura['transicao_label'])=="") { echo "Transição"; } else { echo $row_estrutura['transicao_label']; } ?></label>
                                                                <select name="transicao" id="transicao">
                                                                    <option value="">---</option>
                                                                    <option value='fade'>Esmaecimento</option>
                                                                    <option value='papercut'>Recorte de Papel</option>
                                                                    <option value='slidedown'>Slide de cima para baixo</option>
                                                                    <option value='slidehorizontal'>Slide horizontal</option>
                                                                    <option value='flyin'>Slide Recortado</option>
                                                                </select>
                                                                <? if(trim($row_estrutura['transicao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['transicao_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>

                                                            <? if(trim($row_estrutura['nome'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label><? if(trim($row_estrutura['nome_label'])=="") { echo "Título"; } else { echo $row_estrutura['nome_label']; } ?></label>
                                                                    <input value="" class="span7" <? if(trim($row_estrutura['seo_item'])==1) { ?>onkeyup="cria_titulo_e_url('nome','titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','Título','titulo_seo_contador','55');"<? } ?> type="text" name="nome" id="nome" />
                                                                </div>
                                                                <? if(trim($row_estrutura['nome_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['nome_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
                
                                                            <? if(trim($row_estrutura['imagem'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['imagem_label'])=="") { echo "Imagem"; } else { echo $row_estrutura['imagem_label']; } ?></label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="imagem" type="file"></span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                </div>
                                                                <? if(trim($row_estrutura['imagem_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['imagem_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>

                                                            <? if(trim($row_estrutura['target'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label><? if(trim($row_estrutura['target_label'])=="") { echo "Abrir Onde ?"; } else { echo $row_estrutura['target_label']; } ?></label>
                                                                    <select name="target" id="target" style="width:150px;">
                                                                        <option value=''>Não abrir</option>
                                                                        <option value='texto'>Abrir texto inserido</option>
                                                                        <option value='_parent'>Mesma janela</option>
                                                                        <option value='_blank'>Nova janela</option>
                                                                    </select>
                                                                </div>
                                                                <? if(trim($row_estrutura['target_info'])=="") { } else { ?><div style="float:left;margin-left:-65px;margin-top:-2px;"><img src="<?=$link?>template/img/ico-info.png" class="ptip_s" title="<?=$row_estrutura['target_info']?>"></div><? } ?>
                                                            </div>
                                                            <? } ?>
                
                                                            <? if(trim($row_estrutura['link'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label><? if(trim($row_estrutura['link_label'])=="") { echo "Link"; } else { echo $row_estrutura['link_label']; } ?></label>
                                                                    <input value="" style="width:350px;" type="text" name="link" id="link" />
                                                                </div>
                                                                <? if(trim($row_estrutura['link_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['link_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
                
                                                            <? if(trim($row_estrutura['chamada'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['chamada_label'])=="") { echo "Chamada"; } else { echo $row_estrutura['chamada_label']; } ?></label>
                                                                <textarea name="chamada" id="chamada" class="span12" style="height:150px;"></textarea>
                                                                <? if(trim($row_estrutura['chamada_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['chamada_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>

                                                            <? if(trim($row_estrutura['texto'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['texto_label'])=="") { echo "Texto"; } else { echo $row_estrutura['texto_label']; } ?></label>
                                                                <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                                <? if(trim($row_estrutura['texto_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['texto_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>

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
                                                            
                                                            <? if(trim($row_estrutura['seo_item'])==1) { ?>
                                                            <p class="heading_a"><a href="javascript:void(0);" onclick="verMais('config_seo');" style="text-decoration:underline;"><? if(trim($row_estrutura['seo_item_label'])=="") { echo "Editar configurações SEO"; } else { echo $row_estrutura['seo_item_label']; } ?></a></p>

                                                            <div style="display:none;" id="config_seo">
                                                            <div class="formSep">
                                                                <div style="float:left;width:100%;font-size:18px;color:#1e0fbe;text-decoration: none;" id="titulo_seo_google">Título</div>
                                                                <div style="float:left;width:100%;font-size:medium;color:#006621;" id="url_amigavel_google"><?=$link_site?></div>
                                                                <div style="float:left;width:100%;font-size:small;color:#444;margin-bottom:10px;" id="texto_seo_google">Se você não acrescentar nenhum texto, o Meta Description não será exibido</div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título</label>
                                                                    <input value="" style="width:550px;" onkeyup="cria_seo_titulo_e_url('titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','Título','titulo_seo_contador','55');" type="text" name="titulo_seo" id="titulo_seo" />
                                                                    <div style="float:left;width:100%;">A visualização do título em mecânismos de busca é limitada à 55 caracteres, <span style="color:#090;" id="titulo_seo_contador">55</span> restantes.</div>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">URL Amigável</label>
                                                                    <input value="" style="width:550px;" type="text" onkeyup="controle_url_amigavel('url_amigavel','url_amigavel_google');" name="url_amigavel" id="url_amigavel" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label>Texto (Meta-Description)</label>
                                                                <textarea name="texto_seo" id="texto_seo" onkeyup="controle_meta_description('texto_seo','texto_seo_google','texto_seo_contador','Se você não acrescentar nenhum texto, o Meta Description não será exibido','150');" class="span12" style="height:150px;"><?=$row['texto_seo']?></textarea>
                                                                <div style="float:left;width:100%;">O Meta-Description esta limitado à 150 caracteres, <span style="color:#090;" id="texto_seo_contador">150</span> restantes.</div>
                                                            </div>
                                                            </div>
                                                            <? } ?>

                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Salvar</button>
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
                
            

                                                            <div class="aba_config_adm"><a href="javascript:void(0);">Campos do Módulo</a></div>
                                                            <div class="aba_config_campos" id="config_aba_campo" style="display:block;">
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Configurações de SEO do Item</label>
                                                                    <input value="<?=$row_estrutura['seo_item_label']?>"  style="width:350px;" type="text" name="seo_item_label" id="seo_item_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="seo_item" id="seo_item_estrutura" <? if(trim($row_estrutura['seo_item'])==1) { echo " checked"; } ?> class="seo_item_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Ordem'</label>
                                                                    <input value="<?=$row_estrutura['ordem_label']?>"  style="width:350px;" type="text" name="ordem_label" id="ordem_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="ordem" id="ordem_estrutura" <? if(trim($row_estrutura['ordem'])==1) { echo " checked"; } ?> class="ordem_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['ordem_info']?>"  style="width:395px;" type="text" name="ordem_info" id="ordem_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Transição'</label>
                                                                    <input value="<?=$row_estrutura['transicao_label']?>"  style="width:350px;" type="text" name="transicao_label" id="transicao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="transicao" id="transicao_estrutura" <? if(trim($row_estrutura['transicao'])==1) { echo " checked"; } ?> class="transicao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['transicao_info']?>"  style="width:395px;" type="text" name="transicao_info" id="transicao_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Título'</label>
                                                                    <input value="<?=$row_estrutura['nome_label']?>"  style="width:350px;" type="text" name="nome_label" id="nome_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="nome" id="nome_estrutura" <? if(trim($row_estrutura['nome'])==1) { echo " checked"; } ?> class="nome_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['nome_info']?>"  style="width:395px;" type="text" name="nome_info" id="nome_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Link'</label>
                                                                    <input value="<?=$row_estrutura['link_label']?>"  style="width:350px;" type="text" name="link_label" id="link_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="link" id="link_estrutura" <? if(trim($row_estrutura['link'])==1) { echo " checked"; } ?> class="link_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['link_info']?>"  style="width:395px;" type="text" name="link_info" id="link_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Target'</label>
                                                                    <input value="<?=$row_estrutura['target_label']?>"  style="width:350px;" type="text" name="target_label" id="target_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="target" id="target_estrutura" <? if(trim($row_estrutura['target'])==1) { echo " checked"; } ?> class="target_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['target_info']?>"  style="width:395px;" type="text" name="target_info" id="target_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Imagem'</label>
                                                                    <input value="<?=$row_estrutura['imagem_label']?>"  style="width:350px;" type="text" name="imagem_label" id="imagem_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="imagem" id="imagem_estrutura" <? if(trim($row_estrutura['imagem'])==1) { echo " checked"; } ?> class="imagem_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['imagem_info']?>"  style="width:395px;" type="text" name="imagem_info" id="imagem_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Chamada'</label>
                                                                    <input value="<?=$row_estrutura['chamada_label']?>"  style="width:350px;" type="text" name="chamada_label" id="chamada_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="chamada" id="chamada_estrutura" <? if(trim($row_estrutura['chamada'])==1) { echo " checked"; } ?> class="chamada_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['chamada_info']?>"  style="width:395px;" type="text" name="chamada_info" id="chamada_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Texto'</label>
                                                                    <input value="<?=$row_estrutura['texto_label']?>"  style="width:350px;" type="text" name="texto_label" id="texto_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="texto" id="texto_estrutura" <? if(trim($row_estrutura['texto'])==1) { echo " checked"; } ?> class="texto_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['texto_info']?>"  style="width:395px;" type="text" name="texto_info" id="texto_info" />
                                                                </div>
                                                            </div>
                                                            </div>
            
                                                            <div class="aba_config_adm"><a href="javascript:void(0);" onclick="verMais('config_aba_outros');">Outras Configurações</a></div>
                                                            <div class="aba_config_campos" id="config_aba_outros">
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo de ordenação 1</label>
                                                                    <select name="campo_ordem_1" id="campo_ordem_1">
                                                                        <option value="">---</option>
                                                                        <option value='nome' <? if($row_estrutura['campo_ordem_1']=="nome") { echo "selected"; } ?>><? if(trim($row_estrutura['nome_label'])=="") { echo "Nome"; } else { echo $row_estrutura['nome_label']; } ?></option>
                                                                        <option value='ordem' <? if($row_estrutura['campo_ordem_1']=="ordem") { echo "selected"; } ?>><? if(trim($row_estrutura['ordem_label'])=="") { echo "Ordem"; } else { echo $row_estrutura['ordem_label']; } ?></option>
                                                                    </select>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label class="req">Tipo de ordenação 1</label>
                                                                    <select name="campo_ordem_tipo_1" id="campo_ordem_tipo_1" style="width:320px;">
                                                                        <option value="">---</option>
                                                                        <option value='ASC' <? if($row_estrutura['campo_ordem_tipo_1']=="ASC") { echo "selected"; } ?>>ASCENDENTE - do MENOR para o MAIOR</option>
                                                                        <option value='DESC' <? if($row_estrutura['campo_ordem_tipo_1']=="DESC") { echo "selected"; } ?>>DECRESCENTE - do MAIOR para o MENOR</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo de ordenação 2</label>
                                                                    <select name="campo_ordem_2" id="campo_ordem_2">
                                                                        <option value="">---</option>
                                                                        <option value='nome' <? if($row_estrutura['campo_ordem_2']=="nome") { echo "selected"; } ?>><? if(trim($row_estrutura['nome_label'])=="") { echo "Nome"; } else { echo $row_estrutura['nome_label']; } ?></option>
                                                                        <option value='ordem' <? if($row_estrutura['campo_ordem_2']=="ordem") { echo "selected"; } ?>><? if(trim($row_estrutura['ordem_label'])=="") { echo "Ordem"; } else { echo $row_estrutura['ordem_label']; } ?></option>
                                                                    </select>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label class="req">Tipo de ordenação 2</label>
                                                                    <select name="campo_ordem_tipo_2" id="campo_ordem_tipo_2" style="width:320px;">
                                                                        <option value="">---</option>
                                                                        <option value='ASC' <? if($row_estrutura['campo_ordem_tipo_2']=="ASC") { echo "selected"; } ?>>ASCENDENTE - do MENOR para o MAIOR</option>
                                                                        <option value='DESC' <? if($row_estrutura['campo_ordem_tipo_2']=="DESC") { echo "selected"; } ?>>DECRESCENTE - do MAIOR para o MENOR</option>
                                                                    </select>
                                                                </div>
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
