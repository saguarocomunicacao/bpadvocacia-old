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
                                                <? if(trim($sysperm['descricao_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_config">Descrição</a></li><? } ?>
                                                <? if(trim($sysperm['seo_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_config_seo">Configurações de SEO</a></li><? } ?>
                                            </ul>
											<script>
                                              $(document).ready(function() {
                                                //* form validation
                                                forms.simple();
            
												$("#valor").maskMoney({ decimal:",", thousands:".", allowZero:true});

												<? if(trim($_REQUEST['var3'])=="") { } else { ?>
												$("#valor_editar").maskMoney({ decimal:",", thousands:".", allowZero:true});
												<? } ?>

                                                //* datatables 
                                                beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
            
												beoro_select_row.init();
										
												//* WYSIWG Editor
												beoro_wysiwg.init();

												//* switch buttons
												beoro_switchButtons.init();
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
																{ "bSortable": true },
																{ "sType": "string" },
																{ "sType": "string" },
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
													if($('#texto_descricao').length) { 
														CKEDITOR.replace( 'texto_descricao', {
															toolbar: null
														});
													}
													<? if(trim($_REQUEST['var3'])=="") { ?>
													if($('#texto').length) { 
														CKEDITOR.replace( 'texto', {
															toolbar: 'Standard'
														});
													}
													<? } else { ?>
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
													if($('#hotsite').length) { $("#hotsite").iButton(); }
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
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico_editar" value="<?=$numeroUnicoGerado?>">
                
                
                                                             <div class="formSep">
                                                                <label>Ordem</label>
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
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Escolha a categoria</label>
                                                                    <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM ".$mod."_categoria ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['id'.$mod.'_categoria']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Título</label>
                                                                    <input value="<?=$row['nome']?>" style="width:350px;"  type="text" name="nome" id="nome" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Digite um título para o plano</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Mostrar no Hosite ?</label>
                                                                <input type="checkbox" name="hotsite" id="hotsite" <? if(trim($row['hotsite'])==1) { echo " checked"; } ?> class="hotsite {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Valor</label>
                                                                <input value="<?=$row['valor']?>" class="span5" type="text" name="valor" id="valor_editar" />
                                                            </div>

                                                            <div class="formSep">
                                                                <div class="span3">
                                                                    <label class="req">Nome</label>
                                                                    <input value="" class="span12" type="text" id="nome_item_editar" />
                                                                </div>
                                                                <div class="span7" >
                                                                    <label class="req">Descrição</label>
                                                                    <input value="" class="span12" type="text" id="texto_item_editar" />
                                                                </div>
                                                                <div class="span2" >
                                                                    <button type="button" onclick="salvar_item_plano('_editar','sysplano');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                </div>
                                                            </div>
                                                            
                                                            <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de itens</div>
                                                                <div id="lista_sysplano_itens_editar" style="width:100%;float:left;">
																	<? $sufixoGet = "_editar"; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/sysgeral/lista_sysplano_item.php"); ?>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Descrição</label>
                                                                <textarea name="texto" id="texto_editar" class="span12" style="height:150px;"><?=$row['texto']?></textarea>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo do plano</span>
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
                                                                    <th style="width:50px;">Ordem</th>
                                                                    <th style="width:150px;">Categoria</th>
                                                                    <th>Título</th>
                                                                    <th style="width:150px;">Valor Original</th>
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

                                                                    <td style="vertical-align:middle;"><?=$rSql['ordem']?></td>
                                                                    <? $item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_categoria WHERE id='".$rSql['id'.$mod.'_categoria']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$item['nome']?></td>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Título" data-placeholder="Digite um Título" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor']?></td>
                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">
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
                                                                <label>Ordem</label>
                                                                <select name="ordem" id="ordem" style="width:70px;">
                                                                    <?
                                                                    $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod.""));
                                                                    if($nordem==0) {
                                                                    ?>
                                                                    <option value='1'>1</option>
                                                                    <?
                                                                    } else {
                                                                    $ultimaOrdem = $nordem + 1;
                                                                    for ($b=1; $b<=$ultimaOrdem; $b++) {
                                                                    ?>
                                                                    <option value='<?=$b?>' <? if($b==$ultimaOrdem) { echo "selected"; } ?>><?=$b?></option>
                                                                    <? } } ?>
                                                                </select>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Escolha a categoria</label>
                                                                    <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM ".$mod."_categoria ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Título</label>
                                                                    <input value="" class="span7" type="text" name="nome" id="nome" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Digite um título para o plano</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Mostrar no Hosite ?</label>
                                                                <input type="checkbox" name="hotsite" id="hotsite"  class="hotsite {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Valor</label>
                                                                <input value="" class="span5" type="text" name="valor" id="valor" />
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Descrição</label>
                                                                <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:10px;">Insira aqui um texto descritivo com uma visão geral do plano</span>
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


                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
