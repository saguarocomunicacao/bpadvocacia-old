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
                                                <? if(trim($row_estrutura['seo'])==1) { ?><? if(trim($sysperm['seo_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_d"><? if(trim($row_estrutura['seo_label'])=="") { echo "Configurações de SEO"; } else { echo $row_estrutura['seo_label']; } ?></a></li><? } ?><? } ?>
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
                                            beoro_datatables = {
                                                //* column reorder & toggle visibility
                                                basic: function() {
                                                    if($('#dt_basic').length) {
                                                        $('#dt_basic').dataTable({
                                                            "sPaginationType": "bootstrap_full",
															"aaSorting": [[ 1, "asc" ]],
															"aoColumns": [
																{ "bSortable": false },
																{ "bSortable": true },
																{ "bSortable": false },
																{ "bSortable": false },
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
															toolbar: null
														});
													}
													if($('#texto_descricao').length) { 
														CKEDITOR.replace( 'texto_descricao', {
															toolbar: null
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

											//* multiselect
											beoro_multiselect = {
												init: function(){
													if($('#lista_categorias_itens').length) {
														//* searchable
														$('#lista_categorias_itens').multiSelect({
															selectableHeader: '<div class="search-header"><input type="text" class="span12" id="ms-search" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
															selectionHeader: "<div class='search-selected'></div>",
															afterSelect: function(values){
																$('#lista_categorias').val(""+$('#lista_categorias').val()+'|'+values+'|');
															},
															afterDeselect: function(values){
																$('#lista_categorias').val($('#lista_categorias').val().replace('|'+values+'|',''));
															}
  														});
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#lista_categorias_itens_editar').length) {
														//* searchable
														$('#lista_categorias_itens_editar').multiSelect({
															selectableHeader: '<div class="search-header"><input type="text" class="span12" id="ms-search" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
															selectionHeader: "<div class='search-selected'></div>",
															afterSelect: function(values){
																$('#lista_categorias_editar').val(""+$('#lista_categorias_editar').val()+'|'+values+'|');
															},
															afterDeselect: function(values){
																$('#lista_categorias_editar').val($('#lista_categorias_editar').val().replace('|'+values+'|',''));
															}
  														});
													}
													<? } ?>
												}
											}; 

											//* switch buttons
											beoro_switchButtons = {
												init: function() {
													if($('#destaque').length) { $("#destaque").iButton(); }
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#destaque_editar').length) { $("#destaque_editar").iButton(); }
													<? } ?>
													if($('#url_amigavel_ativa').length) { $("#url_amigavel_ativa").iButton(); }
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
                                                                <label class="req">Ordem</label>
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
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                    <label>Escolha a categoria</label>
                                                                    <select id="lista_categorias_itens_editar" multiple="multiple">
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."areas_de_atuacao ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?=$rSqlItem['id']?>" <? if(strrpos($row['lista_categorias'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                    <input value="<?=$row['lista_categorias']?>" style="width:350px;" type="hidden" name="lista_categorias" id="lista_categorias_editar" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Destaque ?</label>
                                                                    <input type="checkbox" name="destaque" id="destaque_editar" <? if(trim($row['destaque'])==1) { echo " checked"; } ?> class="destaque {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título</label>
                                                                    <input value="<?=$row['nome']?>" style="width:350px;" onkeyup="cria_titulo_e_url('nome','titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','<?=$row['nome']?>','titulo_seo_contador','55');" type="text" name="nome" id="nome" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Imagem</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail">
                                                                    <? if(trim($row['imagem'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['imagem']?>"><img style="width:50px" id="arquivo-atual-imagem" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['imagem']?>" alt=""></a>
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
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label>Chamada</label>
                                                                <textarea name="chamada" id="chamada_editar" class="span12" style="height:150px;"><?=$row['chamada']?></textarea>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label>Texto</label>
                                                                <textarea name="texto" id="texto_editar" class="span12" style="height:150px;"><?=$row['texto']?></textarea>
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
                                                            
                                                            <p class="heading_a"><a href="javascript:void(0);" onclick="verMais('config_seo_<?=$row['id']?>');" style="text-decoration:underline;">Editar configurações SEO</a></p>

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
                                                                    <th style="width:50px;">Ordem</th>
                                                                    <th style="width:50px;">Imagem</th>
                                                                    <th style="width:150px;">Áreas de Atuação</th>
                                                                    <th>Título</th>
                                                                    <th style="width:110px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY ordem ");
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
                                                                    <td style="vertical-align:middle;"><?=$rSql['ordem']?></td>
                                                                    <td style="width:60px">
																		<? if(trim($rSql['imagem'])=="") { ?>
                                                                        <a href="javascript:void(0);" title="<?=$rSql['nome']?>" class="thumbnail"><img alt="" src="<?=$link?>template/img/dummy_50x50.gif" style="height:50px;width:50px"></a>
                                                                        <? } else { ?>
                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>" alt="<?=$rSql['nome']?>"/></a>
                                                                        <? } ?>
                                                                    </td> 
                                                                    <td style="vertical-align:middle;">
																	<?
																	$listaCategoria = $rSql['lista_categorias'];
																	$listaCategoria = str_replace("||","','",$listaCategoria);
																	$listaCategoria = str_replace("|","'",$listaCategoria);
																	if(trim($listaCategoria)=="") { } else {
																		$printCategoria = "";
																		$qSqlCat = mysql_query("SELECT * FROM ".$linguagem_set."areas_de_atuacao WHERE id IN(".$listaCategoria.") ORDER BY ordem");
																		while($rSqlCat = mysql_fetch_array($qSqlCat)) {
																			if(trim($printCategoria)=="") {
																				$printCategoria = $rSqlCat['nome'];
																			} else {
																				$printCategoria = $printCategoria.", ".$rSqlCat['nome'];
																			}
																		}
																		echo $printCategoria;
																	}
                                                                    ?>
                                                                    </td>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Título" data-placeholder="Digite um título" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">
                                                                        <? if(trim($rSql['destaque'])=="1") { ?>
																			<? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <a href="javascript:void(0);" onclick="muda_destaque('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Retirar de destaque"><img src="<?=$link?>template/img/icones_novos/16/destaque-1.png" /></a>
                                                                            <? } else { ?>
                                                                            <a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Retirar de destaque"><img src="<?=$link?>template/img/icones_novos/16/destaque-1.png" /></a>
                                                                            <? } ?>
                                                                        <? } else { ?>
																			<? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <a href="javascript:void(0);" onclick="muda_destaque('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn-mini ptip_se" title="Colocar como destaque"><img src="<?=$link?>template/img/icones_novos/16/destaque-0.png" /></a>
                                                                            <? } else { ?>
                                                                            <a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Colocar como destaque"><img src="<?=$link?>template/img/icones_novos/16/destaque-0.png" /></a>
                                                                            <? } ?>
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
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                            <div class="formSep">
                                                                <label class="req">Ordem</label>
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
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                    <label>Escolha a categoria</label>
                                                                    <select id="lista_categorias_itens" multiple="multiple">
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."areas_de_atuacao ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?=$rSqlItem['id']?>"><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                    <input value="" style="width:350px;" type="hidden" name="lista_categorias" id="lista_categorias" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Destaque ?</label>
                                                                    <input type="checkbox" name="destaque" id="destaque" class="destaque {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título</label>
                                                                    <input value="" style="width:350px;" onkeyup="cria_titulo_e_url('nome','titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','Título','titulo_seo_contador','55');" type="text" name="nome" id="nome" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label>Imagem</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="imagem" type="file"></span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label>Chamada</label>
                                                                <textarea name="chamada" id="chamada" class="span12" style="height:150px;"></textarea>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Texto</label>
                                                                <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
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
                                                            
                                                            <p class="heading_a"><a href="javascript:void(0);" onclick="verMais('config_seo');" style="text-decoration:underline;">Editar configurações SEO</a></p>

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
                
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <? $row_config = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_config ORDER BY data LIMIT 1")); ?>
                                                <div id="tb1_config" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="acaoForm" value="config" />
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título</label>
                                                                    <input value="<?=$row_config['nome']?>" style="width:350px;" type="text" name="nome" id="nome" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Imagem</label>
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
                                                                <!--<span class="help-block">Esta imagem deve possuir as seguintes medidas mínimas (1920 pixels de largura X 500 pixels de altura)</span>-->
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label class="req">Texto</label>
                                                                <textarea name="texto_descricao" id="texto_descricao" class="span12" style="height:150px;"><?=$row_config['texto_descricao']?></textarea>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div id="tb1_d" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
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
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Título da Página'</label>
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
                                                                    <label class="req">Campo 'Título do Texto'</label>
                                                                    <input value="<?=$row_estrutura['titulo_texto_label']?>"  style="width:350px;" type="text" name="titulo_texto_label" id="titulo_texto_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="titulo_texto" id="titulo_texto_estrutura" <? if(trim($row_estrutura['titulo_texto'])==1) { echo " checked"; } ?> class="titulo_texto_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['titulo_texto_info']?>"  style="width:395px;" type="text" name="titulo_texto_info" id="titulo_texto_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Imagem de Cabeçalho'</label>
                                                                    <input value="<?=$row_estrutura['imagem_descricao_label']?>"  style="width:350px;" type="text" name="imagem_descricao_label" id="imagem_descricao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="imagem_descricao" id="imagem_descricao_estrutura" <? if(trim($row_estrutura['imagem_descricao'])==1) { echo " checked"; } ?> class="imagem_descricao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['imagem_descricao_info']?>"  style="width:395px;" type="text" name="imagem_descricao_info" id="imagem_descricao_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Imagem Interna'</label>
                                                                    <input value="<?=$row_estrutura['imagem_interna_label']?>"  style="width:350px;" type="text" name="imagem_interna_label" id="imagem_interna_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="imagem_interna" id="imagem_interna_estrutura" <? if(trim($row_estrutura['imagem_interna'])==1) { echo " checked"; } ?> class="imagem_interna_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['imagem_interna_info']?>"  style="width:395px;" type="text" name="imagem_interna_info" id="imagem_interna_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Chamada'</label>
                                                                    <input value="<?=$row_estrutura['chamada_descricao_label']?>"  style="width:350px;" type="text" name="chamada_descricao_label" id="chamada_descricao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="chamada_descricao" id="chamada_descricao_estrutura" <? if(trim($row_estrutura['chamada_descricao'])==1) { echo " checked"; } ?> class="chamada_descricao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['chamada_descricao_info']?>"  style="width:395px;" type="text" name="chamada_descricao_info" id="chamada_descricao_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Texto'</label>
                                                                    <input value="<?=$row_estrutura['texto_descricao_label']?>"  style="width:350px;" type="text" name="texto_descricao_label" id="texto_descricao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="texto_descricao" id="texto_descricao_estrutura" <? if(trim($row_estrutura['texto_descricao'])==1) { echo " checked"; } ?> class="texto_descricao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['texto_descricao_info']?>"  style="width:395px;" type="text" name="texto_descricao_info" id="texto_descricao_info" />
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
