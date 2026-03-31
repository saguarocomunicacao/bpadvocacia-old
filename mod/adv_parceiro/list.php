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
                                            });
            
                                            //* form validation
                                            forms = {
                                                simple: function() {
                                                    if($('#formulario').length) {
                                                        $('#formulario').validate({
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
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };
                                            </script>
                                            <div class="tab-content">
                                                
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">

                                                    <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                        <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                        <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
            
                                                        <?
                                                        $qSqlTipo = mysql_query("SELECT * FROM adv_processo_tipo WHERE stat='1' ORDER BY ordem");
                                                        while($rSqlTipo = mysql_fetch_array($qSqlTipo)) {
                                                        ?>
                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                <label><div style="background-color:<?=$rSqlTipo['cor']?>;width:20px;float:left;height:20px;margin-right:5px;"></div> <b><?=$rSqlTipo['nome']?></b></label>
                                                            </div>
                                                            <? 
															$nTipoAuth = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND auth='1'"));
															if($nTipoAuth==0) {
																$nTipoAuth = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND auth='0'"));
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
															$nTipoVer = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND ver='1'"));
															if($nTipoVer==0) {
																$nTipoVer = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND ver='0'"));
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
															$nTipoEditar = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND editar='1'"));
															if($nTipoEditar==0) {
																$nTipoEditar = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND editar='0'"));
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
															$nTipoExcluir = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND excluir='1'"));
															if($nTipoExcluir==0) {
																$nTipoExcluir = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND excluir='0'"));
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
															$nTipoDespublicar = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND despublicar='1'"));
															if($nTipoDespublicar==0) {
																$nTipoDespublicar = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND despublicar='0'"));
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
															$nTipoPublicar = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND publicar='1'"));
															if($nTipoPublicar==0) {
																$nTipoPublicar = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var4']."' AND idadv_processo_tipo='".$rSqlTipo['id']."' AND publicar='0'"));
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
                                                            <button type="button" onclick="salvar_formulario();" class="btn btn-success">Salvar</button>
                                                            <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                            <? } ?>
                                                        </div>
    
                                                    </form>

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
                                                                    <th>Parceiro</th>
                                                                    <th style="width:60px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
																$qSql = mysql_query("SELECT * FROM ".$linguagem_set."sysusu ORDER BY nome");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                ?>
                                                                <tr>
                                                                    <td style="vertical-align:middle;" class="nolink"><input type="checkbox" name="msg_sel[]" class="select_msg" value="<?=$rSql['id']?>" /></td>

                                                                    <td style="vertical-align:middle;"><?=corrigirAcentuacao($rSql['nome'])?></td>

                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">

                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;"><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a></div>
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

                                                    <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" value="add" />
                                                        <input type="hidden" name="modulo" value="sysusu" />
            
                                                        <? 
                                                        $numeroUnicoGerado = geraCodReturn(); 
                                                        ?>
                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
            
                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;">
                                                                <label class="req">Escolha o Grupo de Usuário</label>
                                                                <select name="idsysgrupousuario" id="idsysgrupousuario">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM sysgrupousuario ORDER BY nome");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;">
                                                                <label class="req">Escolha a categoria</label>
                                                                <select name="idsysusu_categoria" id="idsysusu_categoria">
                                                                    <option value="">---</option>
                                                                    <?
                                                                    $qSqlItem = mysql_query("SELECT * FROM sysusu_categoria ORDER BY ordem");
                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                    ?>
                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;">
                                                                <label class="req">Nome</label>
                                                                <input value="" style="width:350px;" type="text" name="nome" id="nome" />
                                                            </div>
                                                            <div style="float:left;margin-right:10px;">
                                                                <label class="req">Como prefere ser chamado</label>
                                                                <input value="" style="width:250px;" type="text" name="apelido" id="apelido" />
                                                            </div>
                                                        </div>
            
                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;">
                                                                <label class="req">E-mail de acesso</label>
                                                                <input value="" style="width:350px;" type="text" name="email" id="email" />
                                                            </div>
                                                            <div style="float:left;margin-right:10px;">
                                                                <label class="req">Senha</label>
                                                                <input value="" style="width:250px;" type="text" name="senha" id="senha" />
                                                            </div>
                                                        </div>
            
                                                        <div class="formSep">
                                                            <label>Imagem de Perfil</label>
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="imagem" type="file"></span>
                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                            </div>
                                                        </div>
            
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
                                                            <div style="float:left;margin-right:10px;">
                                                                <label>Rua</label>
                                                                <input value="" style="width:350px;" type="text" name="rua" id="rua" />

                                                            </div>
                                                            <div style="float:left;margin-right:10px;">
                                                                <label>Número</label>
                                                                <input value="" style="width:50px;" type="text" name="numero" id="numero" />
                                                            </div>
                                                            <div style="float:left;margin-right:10px;">
                                                                <label>Complemento</label>
                                                                <input value="" style="width:250px;" type="text" name="complemento" id="complemento" />
                                                            </div>
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
                                                <? } ?>


                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
