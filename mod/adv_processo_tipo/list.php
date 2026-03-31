        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>

							<? include("./acoes/adv_processo_tipo/menu.php"); ?>
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
            
                                                //* datatables 
                                                beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
            
												beoro_select_row.init();

												//* 2col multiselect
												beoro_multiselect.init();
			
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
																{ "sType": "numeric" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };

											//* colorpicker
											beoro_colorpicker = {
												init: function() {
													if($('#cor').length) {
														$('#cor').colorpicker({
															format: 'hex'
														})
													}
												}
											};

											//* multiselect
											beoro_multiselect = {
												init: function(){
													if($('#lista_admin_itens').length) {
														//* searchable
														$('#lista_admin_itens').multiSelect({
															selectableHeader: '<div class="search-header"><input type="text" class="span12" id="ms-search" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
															selectionHeader: "<div class='search-selected'></div>",
															afterSelect: function(values){
																$('#lista_admin').val(""+$('#lista_admin').val()+'|'+values+'|');
															},
															afterDeselect: function(values){
																$('#lista_admin').val($('#lista_admin').val().replace('|'+values+'|',''));
															}
  														});
													}
												}
											}; 

                                            </script>
                                            <div class="tab-content">
                                                
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">

                                                    <div class="tabbable tabs-left tabbable-bordered">
                                                        <ul class="nav nav-tabs">
                                                            <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Dados da situação</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="permissoes") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_b">Permissões</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">
                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                    <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                        
                                                                    <? 
                                                                    $numeroUnicoGerado_editar = $row['numeroUnico']; 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado_editar?>">
                        
        
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
                                                                            <label>Nome</label>
                                                                            <input value="<?=$row['nome']?>" style="width:350px;"  type="text" name="nome" id="nome" />
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Digite um um nome para a situação</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Cor</label>
                                                                            <input value="<?=$row['cor']?>" style="width:70px;" type="text" name="cor" id="cor" />
                                                                        </div>
                                                                    </div>
                        
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                            <label>Lista de Administradores</label>
                                                                            <select id="lista_admin_itens" multiple="multiple">
                                                                                <?
                                                                                $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                ?>
                                                                                <option value="<?=$rSqlItem['id']?>" <? if(strrpos($row['lista_admin'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                            <input value="<?=$row['lista_admin']?>" style="width:350px;" type="hidden" name="lista_admin" id="lista_admin" />
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Selecione os administradores desta situação</span>
                                                                    </div>
                                                                    -->
        
                                                                    <div class="formSep">
                                                                        <label class="req">Ativo ?</label>
                                                                        <label class="radio" style="color:#C00;">
                                                                            <input type="radio" name="stat" id="stat1" disabled="disabled" value="0" <? if($row['stat']==0) { echo "checked"; } ?> >
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
                                                                        <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                                        <? } ?>
                                                                        <button type="button" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                                    </div>
                                                                    
                                                                </form>
                                                            </div>

                                                            <div id="tb3_b" class="tab-pane <? if(trim($_REQUEST['var5'])=="permissoes") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario_permissoes">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm_formulario_permissoes" value="editar-permissoes" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                    <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                        
                                                                    <?
                                                                    $qSqlTipo = mysql_query("SELECT * FROM sysusu WHERE stat='1' ORDER BY nome");
                                                                    while($rSqlTipo = mysql_fetch_array($qSqlTipo)) {
                                                                    ?>
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b><?=$rSqlTipo['nome']?></b></label>
                                                                        </div>
                                                                        <? 
                                                                        $nTipoAuth = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND auth='1'"));
                                                                        if($nTipoAuth==0) {
                                                                            $nTipoAuth = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND auth='0'"));
                                                                            if($nTipoAuth==0) {
                                                                                $auth_0 = "";
                                                                                $auth_1 = "checked";
                                                                            } else {
                                                                                $auth_0 = "checked";
                                                                                $auth_1 = "";
                                                                            }
                                                                        } else {
                                                                            $auth_0 = "";
                                                                            $auth_1 = "checked";
                                                                        }
                                                                        ?>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;border:1px solid #CCC;padding:3px 5px;margin-bottom:10px;">
                                                                            <label style="font-size:10px;">Autorizado</label>
                                                                            <label class="radio" style="color:#C00;">
                                                                                <input type="radio" name="auth_<?=$rSqlTipo['id']?>" <?=$auth_0?> value="0" >
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="auth_<?=$rSqlTipo['id']?>" <?=$auth_1?> value="1" >
                                                                                sim
                                                                            </label>
                                                                        </div>
            
                                                                        <? 
                                                                        $nTipoVer = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND ver='1'"));
                                                                        if($nTipoVer==0) {
                                                                            $nTipoVer = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND ver='0'"));
                                                                            if($nTipoVer==0) {
                                                                                $ver_0 = "";
                                                                                $ver_1 = "checked";
                                                                            } else {
                                                                                $ver_0 = "checked";
                                                                                $ver_1 = "";
                                                                            }
                                                                        } else {
                                                                            $ver_0 = "";
                                                                            $ver_1 = "checked";
                                                                        }
                                                                        ?>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;border:1px solid #CCC;padding:3px 5px;margin-bottom:10px;">
                                                                            <label style="font-size:10px;">Tipo de visualização</label>
                                                                            <label class="radio">
                                                                                <input type="radio" name="ver_<?=$rSqlTipo['id']?>" <?=$ver_0?> value="0" >
                                                                                todos os processos
                                                                            </label>
                                                                            <label class="radio">
                                                                                <input type="radio" name="ver_<?=$rSqlTipo['id']?>" <?=$ver_1?> value="1" >
                                                                                apenas processos que este usuário inserir
                                                                            </label>
                                                                        </div>
            
                                                                        <? 
                                                                        $nTipoEditar = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND editar='1'"));
                                                                        if($nTipoEditar==0) {
                                                                            $nTipoEditar = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND editar='0'"));
                                                                            if($nTipoEditar==0) {
                                                                                $editar_0 = "";
                                                                                $editar_1 = "checked";
                                                                            } else {
                                                                                $editar_0 = "checked";
                                                                                $editar_1 = "";
                                                                            }
                                                                        } else {
                                                                            $editar_0 = "";
                                                                            $editar_1 = "checked";
                                                                        }
                                                                        ?>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;border:1px solid #CCC;padding:3px 5px;margin-bottom:10px;width:55px;">
                                                                            <label style="font-size:10px;">Editar</label>
                                                                            <label class="radio" style="color:#C00;">
                                                                                <input type="radio" name="editar_<?=$rSqlTipo['id']?>" <?=$editar_0?> value="0" >
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="editar_<?=$rSqlTipo['id']?>" <?=$editar_1?> value="1" >
                                                                                sim
                                                                            </label>
                                                                        </div>
            
                                                                        <? 
                                                                        $nTipoExcluir = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND excluir='1'"));
                                                                        if($nTipoExcluir==0) {
                                                                            $nTipoExcluir = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND excluir='0'"));
                                                                            if($nTipoExcluir==0) {
                                                                                $excluir_0 = "";
                                                                                $excluir_1 = "checked";
                                                                            } else {
                                                                                $excluir_0 = "checked";
                                                                                $excluir_1 = "";
                                                                            }
                                                                        } else {
                                                                            $excluir_0 = "";
                                                                            $excluir_1 = "checked";
                                                                        }
                                                                        ?>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;border:1px solid #CCC;padding:3px 5px;margin-bottom:10px;width:55px;">
                                                                            <label style="font-size:10px;">Excluir</label>
                                                                            <label class="radio" style="color:#C00;">
                                                                                <input type="radio" name="excluir_<?=$rSqlTipo['id']?>" <?=$excluir_0?> value="0" >
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="excluir_<?=$rSqlTipo['id']?>" <?=$excluir_1?> value="1" >
                                                                                sim
                                                                            </label>
                                                                        </div>
            
                                                                        <? 
                                                                        $nTipoDespublicar = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND despublicar='1'"));
                                                                        if($nTipoDespublicar==0) {
                                                                            $nTipoDespublicar = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND despublicar='0'"));
                                                                            if($nTipoDespublicar==0) {
                                                                                $despublicar_0 = "";
                                                                                $despublicar_1 = "checked";
                                                                            } else {
                                                                                $despublicar_0 = "checked";
                                                                                $despublicar_1 = "";
                                                                            }
                                                                        } else {
                                                                            $despublicar_0 = "";
                                                                            $despublicar_1 = "checked";
                                                                        }
                                                                        ?>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;border:1px solid #CCC;padding:3px 5px;margin-bottom:10px;width:55px;">
                                                                            <label style="font-size:10px;">Despublicar</label>
                                                                            <label class="radio" style="color:#C00;">
                                                                                <input type="radio" name="despublicar_<?=$rSqlTipo['id']?>" <?=$despublicar_0?> value="0" >
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="despublicar_<?=$rSqlTipo['id']?>" <?=$despublicar_1?> value="1" >
                                                                                sim
                                                                            </label>
                                                                        </div>
            
                                                                        <? 
                                                                        $nTipoPublicar = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND publicar='1'"));
                                                                        if($nTipoPublicar==0) {
                                                                            $nTipoPublicar = mysql_num_rows(mysql_query("SELECT * FROM adv_parceiro WHERE idadv_processo_tipo='".$_REQUEST['var4']."' AND idsysusu='".$rSqlTipo['id']."' AND publicar='0'"));
                                                                            if($nTipoPublicar==0) {
                                                                                $publicar_0 = "";
                                                                                $publicar_1 = "checked";
                                                                            } else {
                                                                                $publicar_0 = "checked";
                                                                                $publicar_1 = "";
                                                                            }
                                                                        } else {
                                                                            $publicar_0 = "";
                                                                            $publicar_1 = "checked";
                                                                        }
                                                                        ?>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;border:1px solid #CCC;padding:3px 5px;margin-bottom:10px;width:55px;">
                                                                            <label style="font-size:10px;">Publicar</label>
                                                                            <label class="radio" style="color:#C00;">
                                                                                <input type="radio" name="publicar_<?=$rSqlTipo['id']?>" <?=$publicar_0?> value="0" >
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="publicar_<?=$rSqlTipo['id']?>" <?=$publicar_1?> value="1" >
                                                                                sim
                                                                            </label>
                                                                        </div>
            
                                                                    </div>
                                                                    <? } ?>
            
                                                                    <div class="formSep">
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                        <button type="button" onclick="salvar_formulario_send('formulario_permissoes');" class="btn btn-success">Salvar</button>
                                                                        <button type="button" onclick="salvar_continuar_editando_send('formulario_permissoes');" class="btn btn-primary">Salvar e continuar editando</button>
                                                                        <? } ?>
                                                                    </div>
                
                                                                </form>

                                                            </div>

                                                        </div>
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
                                                                    <th style="width:120px;">Ordem</th>
                                                                    <th style="width:150px;">Cor</th>
                                                                    <th>Nome</th>
                                                                    <th style="width:90px;">Ações</th>
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
                                                                    <td style="vertical-align:middle;"><div style="width:20px;height:20px;background-color:<?=$rSql['cor']?>;float:left;margin-right:10px;"></div> <?=$rSql['cor']?></td>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="javascript:void(0);"><?=$rSql['nome']?></a></td>
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
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" id="idacaoForm" value="add" />
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
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Nome</label>
                                                                    <input value="" class="span7" type="text" name="nome" id="nome" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Digite um nome para a situação</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Cor</label>
                                                                    <input value="" style="width:70px;" type="text" name="cor" id="cor" />
                                                                </div>
                                                            </div>

                                                            <!--
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                    <label>Lista de Administradores</label>
                                                                    <select id="lista_admin_itens" multiple="multiple">
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?=$rSqlItem['id']?>"><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                    <input value="" style="width:350px;" type="hidden" name="lista_admin" id="lista_admin" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Selecione os administradores desta situação</span>
                                                            </div>
                                                            -->

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
                                                                <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                                <button type="button" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
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
