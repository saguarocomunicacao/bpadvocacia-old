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
			
												//* colorpicker
												beoro_colorpicker.init();
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
                                                                coluna: { required: true },
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
																{ "bSortable": true },
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

											//* colorpicker
											beoro_colorpicker = {
												init: function() {
													if($('#background_cor').length) {
														$('#background_cor').colorpicker({
															format: 'hex'
														})
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#background_cor_editar').length) {
														$('#background_cor_editar').colorpicker({
															format: 'hex'
														})
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
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Tipo de background</label>
                                                                    <select name="background_tipo" id="background_tipo" onchange="seleciona_layout_background();">
                                                                        <option value="">---</option>
                                                                        <option value="cor" <? if($row['background_tipo']=="cor") { echo "selected"; } ?>>cor</option>
                                                                        <option value="imagem" <? if($row['background_tipo']=="imagem") { echo "selected"; } ?>>imagem</option>
                                                                    </select>
                                                                </div>
                                                            </div>
            
                                                            <div id="background_div_cor" class="formSep" style="display: <? if(trim($row['background_tipo'])==""||trim($row['background_tipo'])=="imagem") { echo "none"; } else { echo "block"; } ?>;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Cor do background</label>
                                                                    <input value="<?=$row['background_cor']?>" style="width:70px;" type="text" name="background_cor" id="background_cor_editar" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</span>
                                                            </div>
            
                                                            <div id="background_div_img" class="formSep" style="display: <? if(trim($row['background_tipo'])==""||trim($row['background_tipo'])=="cor") { echo "none"; } else { echo "block"; } ?>;">
                                                                <label>Imagem do background</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                                    <? if(trim($row['background_imagem'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <a class="img_action_zoom" href="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['background_imagem']?>"><img id="arquivo-atual-logotipo" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['background_imagem']?>" alt=""></a>
                                                                    <? } ?>
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <? if(trim($row['background_imagem'])=="") { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span class="fileupload-new">Selecionar arquivo</span>
                                                                        <span class="fileupload-exists">Alterar</span>
                                                                        <input name="background_imagem" type="file">
                                                                    </span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                    <? } else { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span>Alterar</span>
                                                                        <input name="background_imagem" type="file">
                                                                    </span>
                                                                    <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','background_imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                    <? } ?>
                                                                    <span class="help-block">Aparecerá em todas as páginas do site e na tela de login do administrativo</span>
                                                                </div>
                                                            </div>
            
                                                            <div id="background_div_img_tipo" class="formSep" style="display: <? if(trim($row['background_tipo'])==""||trim($row['background_tipo'])=="cor") { echo "none"; } else { echo "block"; } ?>;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Tipo de aplicação da imagem</label>
                                                                    <select name="background_imagem_tipo" id="background_imagem_tipo">
                                                                        <option value="">---</option>
                                                                        <option value="no-repeat" <? if($row['background_imagem_tipo']=="no-repeat") { echo "selected"; } ?>>não repetir</option>
                                                                        <option value="repeat" <? if($row['background_imagem_tipo']=="repeat") { echo "selected"; } ?>>repetir</option>
                                                                        <option value="repeat-x" <? if($row['background_imagem_tipo']=="repeat-x") { echo "selected"; } ?>>repetir apenas na horizontal</option>
                                                                        <option value="repeat-y" <? if($row['background_imagem_tipo']=="repeat-y") { echo "selected"; } ?>>repetir apenas na vertical</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label class="req">Quantidade de colunas</label>
                                                                <select name="coluna" id="coluna" onchange="javascript:qtd_colunas();" style="width:60px;">
                                                                    <option value=''>---</option>
                                                                    <option value='1' <? if($row['coluna']=="1") { echo "selected"; } ?>>01</option>
                                                                    <option value='2' <? if($row['coluna']=="2") { echo "selected"; } ?>>02</option>
                                                                </select>
                                                            </div>
                
                                                            <div id="coluna_1" class="formSep" style="display:block;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título da Coluna 1</label>
                                                                    <input value="<?=$row['modulo_1_titulo']?>" style="width:350px;" type="text" name="modulo_1_titulo" id="modulo_1_titulo" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Módulo da Coluna 1</label>
                                                                    <select name="modulo_1" id="modulo_1">
                                                                        <option value=''>---</option>
                                                                        <?
                                                                        $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE pagina_inicial='1' AND stat='1' AND idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."'");
                                                                        while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                            $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                                        ?>
                                                                        <option value='<?=$rSqlMod['bd']?>' <? if($row['modulo_1']==$rSqlMod['bd']) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="coluna_2" class="formSep" style="display:<? if($row['coluna']=="1") { echo "none"; } else { echo "block"; } ?>;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título da Coluna 2</label>
                                                                    <input value="<?=$row['modulo_2_titulo']?>" style="width:350px;" type="text" name="modulo_2_titulo" id="modulo_2_titulo" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Módulo da Coluna 2</label>
                                                                    <select name="modulo_2" id="modulo_2">
                                                                        <option value=''>---</option>
                                                                        <?
                                                                        $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE pagina_inicial='1' AND stat='1' AND idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."'");
                                                                        while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                            $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                                        ?>
                                                                        <option value='<?=$rSqlMod['bd']?>' <? if($row['modulo_2']==$rSqlMod['bd']) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
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
                                                                    <th>Título Coluna 1</th>
                                                                    <th>Módulo Coluna 1</th>
                                                                    <th>Título Coluna 2</th>
                                                                    <th>Módulo Coluna 2</th>
                                                                    <th style="width:90px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY ordem");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                ?>
                                                                <script>
																$(function(){
																	 
																	$('#modulo_1_titulo-<?=$rSql['id']?>').editable({
																		validate: function(value) {
																		   if($.trim(value) == '') { 
																		    return 'Este campo é obrigatório';
																		   } else {
																			   salva_campo_tabela('modulo_1_titulo','<?=$rSql['id']?>','<?=$mod?>',value);
																		   }
																		}
																	});
																	
																});
                                                                </script>
                                                                <? if(trim($rSql['coluna'])=="1") { } else { ?>
																<script>
																$(function(){
																	 
																	$('#modulo_2_titulo-<?=$rSql['id']?>').editable({
																		validate: function(value) {
																		   if($.trim(value) == '') { 
																		    return 'Este campo é obrigatório';
																		   } else {
																			   salva_campo_tabela('modulo_2_titulo','<?=$rSql['id']?>','<?=$mod?>',value);
																		   }
																		}
																	});
																	
																});
                                                                </script>
                                                                <? } ?>
																<? 
                                                                if(trim($rSql['coluna'])=="1") {
                                                                    $coluna_1 = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."sysmod WHERE bd='".$rSql['modulo_1']."'"));
																	$txt_coluna_1_titulo = "".$rSql['modulo_1_titulo'].""; 
																	$txt_coluna_1 = "".$coluna_1['nome'].""; 
																	$txt_coluna_2_titulo = "---"; 
																	$txt_coluna_2 = "---"; 
                                                                } else {
                                                                    $coluna_1 = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."sysmod WHERE bd='".$rSql['modulo_1']."'")); 
                                                                    $coluna_2 = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."sysmod WHERE bd='".$rSql['modulo_2']."'")); 
																	$txt_coluna_1_titulo = "".$rSql['modulo_1_titulo'].""; 
																	$txt_coluna_1 = "".$coluna_1['nome'].""; 
																	$txt_coluna_2_titulo = "".$rSql['modulo_2_titulo'].""; 
																	$txt_coluna_2 = "".$coluna_2['nome'].""; 
                                                                }
                                                                ?>
                                                                <tr id="linha-<?=$rSql['id']?>">
                                                                    <td style="vertical-align:middle;" class="nolink"><input type="checkbox" name="msg_sel[]" class="select_msg" value="<?=$rSql['id']?>" /></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['ordem']?></td>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Título" data-placeholder="Digite um título" data-placement="right" data-pk="1" data-type="text" id="modulo_1_titulo-<?=$rSql['id']?>" href="#"><?=$txt_coluna_1_titulo?></a></td>
                                                                    <td style="vertical-align:middle;"><?=$txt_coluna_1?></td>
                                                                    <? if(trim($rSql['coluna'])=="1") { ?>
                                                                    <td style="vertical-align:middle;"><?=$txt_coluna_2_titulo?></td>
                                                                    <? } else { ?>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Título" data-placeholder="Digite um título" data-placement="right" data-pk="1" data-type="text" id="modulo_2_titulo-<?=$rSql['id']?>" href="#"><?=$txt_coluna_2_titulo?></a></td>
                                                                    <? } ?>
                                                                    <td style="vertical-align:middle;"><?=$txt_coluna_2?></td>
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
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Tipo de background</label>
                                                                    <select name="background_tipo" id="background_tipo" onchange="seleciona_layout_background();">
                                                                        <option value="">---</option>
                                                                        <option value="cor" <? if($row['background_tipo']=="cor") { echo "selected"; } ?>>cor</option>
                                                                        <option value="imagem" <? if($row['background_tipo']=="imagem") { echo "selected"; } ?>>imagem</option>
                                                                    </select>
                                                                </div>
                                                            </div>
            
                                                            <div id="background_div_cor" class="formSep" style="display: <? if(trim($row['background_tipo'])==""||trim($row['background_tipo'])=="imagem") { echo "none"; } else { echo "block"; } ?>;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Cor do background</label>
                                                                    <input value="<?=$row['background_cor']?>" style="width:70px;" type="text" name="background_cor" id="background_cor" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</span>
                                                            </div>
            
                                                            <div id="background_div_img" class="formSep" style="display: <? if(trim($row['background_tipo'])==""||trim($row['background_tipo'])=="cor") { echo "none"; } else { echo "block"; } ?>;">
                                                                <label>Imagem do background</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                                    <? if(trim($row['background_imagem'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <a class="img_action_zoom" href="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['background_imagem']?>"><img id="arquivo-atual-logotipo" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['background_imagem']?>" alt=""></a>
                                                                    <? } ?>
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <? if(trim($row['background_imagem'])=="") { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span class="fileupload-new">Selecionar arquivo</span>
                                                                        <span class="fileupload-exists">Alterar</span>
                                                                        <input name="background_imagem" type="file">
                                                                    </span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                    <? } else { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span>Alterar</span>
                                                                        <input name="background_imagem" type="file">
                                                                    </span>
                                                                    <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','background_imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                    <? } ?>
                                                                    <span class="help-block">Aparecerá em todas as páginas do site e na tela de login do administrativo</span>
                                                                </div>
                                                            </div>
            
                                                            <div id="background_div_img_tipo" class="formSep" style="display: <? if(trim($row['background_tipo'])==""||trim($row['background_tipo'])=="cor") { echo "none"; } else { echo "block"; } ?>;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Tipo de aplicação da imagem</label>
                                                                    <select name="background_imagem_tipo" id="background_imagem_tipo">
                                                                        <option value="">---</option>
                                                                        <option value="no-repeat" <? if($row['background_imagem_tipo']=="no-repeat") { echo "selected"; } ?>>não repetir</option>
                                                                        <option value="repeat" <? if($row['background_imagem_tipo']=="repeat") { echo "selected"; } ?>>repetir</option>
                                                                        <option value="repeat-x" <? if($row['background_imagem_tipo']=="repeat-x") { echo "selected"; } ?>>repetir apenas na horizontal</option>
                                                                        <option value="repeat-y" <? if($row['background_imagem_tipo']=="repeat-y") { echo "selected"; } ?>>repetir apenas na vertical</option>
                                                                    </select>
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <label class="req">Quantidade de colunas</label>
                                                                <select name="coluna" id="coluna" onchange="javascript:qtd_colunas();" style="width:60px;">
                                                                    <option value=''>---</option>
                                                                    <option value='1'>01</option>
                                                                    <option value='2'>02</option>
                                                                </select>
                                                            </div>

                                                            <div id="coluna_1" class="formSep" style="display:none;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título da Coluna 1</label>
                                                                    <input value="" style="width:350px;" type="text" name="modulo_1_titulo" id="modulo_1_titulo" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Módulo da Coluna 1</label>
                                                                    <select name="modulo_1" id="modulo_1">
                                                                        <option value=''>---</option>
                                                                        <?
                                                                        $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE pagina_inicial='1' AND stat='1' AND idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."'");
                                                                        while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                            $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                                        ?>
                                                                        <option value='<?=$rSqlMod['bd']?>'><?=$rSqlMod['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="coluna_2" class="formSep" style="display:none;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título da Coluna 2</label>
                                                                    <input value="" style="width:350px;" type="text" name="modulo_2_titulo" id="modulo_2_titulo" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Módulo da Coluna 2</label>
                                                                    <select name="modulo_2" id="modulo_2">
                                                                        <option value=''>---</option>
                                                                        <?
                                                                        $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE pagina_inicial='1' AND stat='1' AND idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."'");
                                                                        while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                            $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                                        ?>
                                                                        <option value='<?=$rSqlMod['bd']?>'><?=$rSqlMod['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
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
                                                            
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Salvar</button>
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
