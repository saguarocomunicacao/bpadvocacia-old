        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
                        	<? include("./acoes/sysgeral/menu-sistema.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?><? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_a">Editando <?=$row['nome']?></a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_b">Lista de Itens</a></li><? } ?>
                                                <? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_c">Adicionar Novo</a></li><? } ?><? } ?>
                                                <li><a data-toggle="tab" href="#tb1_d">Categorias</a></li>
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
            
                                                //* masked inputs
                                                beoro_maskedInputs.init();

			
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
                                                                apelido: { required: true },
                                                                email: { required: true },
                                                                senha: { required: true },
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
															"aoColumns": [
																{ "bSortable": false },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "date-eu" },
																{ "bSortable": false }
															],
															"aaSorting": [[ 4, "asc" ]],
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
															}
                                                        });
                                                    }
                                                }
                                            };
            
                                            //* masked inputs
                                            beoro_maskedInputs = {
                                                init: function() {
                                                    $("#cep").inputmask('99999-999');
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
                                            </script>
                                            <div class="tab-content">

                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?>
                                                <div id="tb1_a" class="tab-pane active">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="editar" />
                                                            <input type="hidden" name="modulo" value="sysusu" />
                                                            <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = $row['numeroUnico']; 
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
                                                                        <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsysgrupousuario']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
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
                                                                        $qSqlItem = mysql_query("SELECT * FROM ".$mod."_categoria ORDER BY ordem");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsysusu_categoria']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <?
															$sysperm_this_user = mysql_fetch_array(mysql_query("SELECT * FROM syspermadmin WHERE idsysusu='".$row['id']."'"));
															$qSqlMod = mysql_query("SELECT * FROM sysmod ORDER BY ordem");
															while($rSqlMod = mysql_fetch_array($qSqlMod)) {
																if(trim($sysperm_this_user['visualizar_'.$rSqlMod['bd'].''])==1) {
																	if(trim($lista_ids_mod)=="") {
																		$lista_ids_mod = "'".$rSqlMod['id']."'";
																	} else {
																		$lista_ids_mod = $lista_ids_mod.",'".$rSqlMod['id']."'";
																	}
																}
															}
															?>
                                                            <? if(trim($lista_ids_mod)=="") { } else { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Quando entrar no administrativo, que página deve abrir ?</label>
                                                                    <select name="modulo_abertura" id="modulo_abertura" style="width:255px;">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE id IN (".$lista_ids_mod.") ORDER BY ordem");
                                                                        while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                            $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                                        ?>
                                                                        <option value="<?=$url_mod?>" <? if($row['modulo_abertura']==$url_mod) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                    <span class="help-block">Altere sempre que desejar</span>
                                                                </div>
                                                            </div>
                                                            <? } ?>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Nome</label>
                                                                    <input value="<?=$row['nome']?>" style="width:350px;" type="text" name="nome" id="nome_editar" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Como prefere ser chamado</label>
                                                                    <input value="<?=$row['apelido']?>" style="width:250px;" type="text" name="apelido" id="apelido_editar" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">E-mail de acesso</label>
                                                                    <input value="<?=$row['email']?>" style="width:350px;" type="text" name="email" id="email" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Senha</label>
                                                                    <input value="<? $senhaSet = Seguranca::decriptar($row['senha'],Seguranca::chave("infiniti")); echo $senhaSet;?>" style="width:250px;" type="text" name="senha" id="senha" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Cor</label>
                                                                    <input value="<?=$row['cor']?>" style="width:70px;" type="text" name="cor" id="cor" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label>Imagem de Perfil</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                                    <? if(trim($row['imagem'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <img id="arquivo-atual-imagem" src="<?=$link?>files/sysusu/<?=$row['numeroUnico']?>/<?=$row['imagem']?>" alt="">
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
                
                                                            <!--
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
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Rua</label>
                                                                    <input value="<?=$row['rua']?>" style="width:350px;" type="text" name="rua" id="rua_editar" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Número</label>
                                                                    <input value="<?=$row['numero']?>" style="width:50px;" type="text" name="numero" id="numero_editar" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Complemento</label>
                                                                    <input value="<?=$row['complemento']?>" style="width:250px;" type="text" name="complemento" id="complemento" />
                                                                </div>
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
                                                            -->
                                                            
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
                                                            
                                                            <div id="printtxt"></div>
                                                            
                                                            <div class="formSep">
                                                                <? if(trim($sysperm['editar_sysusu'])==1) { ?>
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                <? } ?>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <? } ?>

                                                <div id="tb1_b" class="tab-pane <? if(trim($_REQUEST['var3'])=="") { ?>active<? } ?>">
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
                                                                    <!--<th style="width:120px;">Categoria</th>-->
                                                                    <th style="width:120px;">Grupo de Usuário</th>
                                                                    <th>Nome</th>
                                                                    <th>Como prefere ser chamado</th>
                                                                    <th style="width:120px;">Data de criação</th>
                                                                    <th style="width:180px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$mod." ORDER BY data DESC, nome, dataModificacao DESC");
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

																	$('#apelido-<?=$rSql['id']?>').editable({
																		validate: function(value) {
																		   if($.trim(value) == '') { 
																		    return 'Este campo é obrigatório';
																		   } else {
																			   salva_campo_tabela('apelido','<?=$rSql['id']?>','<?=$mod?>',value);
																		   }
																		}
																	});
																	
																});
                                                                </script>
                                                                <tr id="linha-<?=$rSql['id']?>">
                                                                    <td style="vertical-align:middle;" class="nolink"><input type="checkbox" name="msg_sel[]" class="select_msg" value="<?=$rSql['id']?>" /></td>
                                                                    <? $item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_categoria WHERE id='".$rSql['idsysusu_categoria']."'")); ?>
                                                                    <!--<td style="vertical-align:middle;"><?=$item['nome']?></td>-->
                                                                    <? $item_sysgrupousuario = mysql_fetch_array(mysql_query("SELECT * FROM sysgrupousuario WHERE id='".$rSql['idsysgrupousuario']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$item_sysgrupousuario['nome']?></td>
                                                                    <td><div style="width:20px;height:20px;background-color:<?=$rSql['cor']?>;margin-right:5px;float:left;"></div><a data-original-title="Editar campo Nome" data-placeholder="Digite um nome" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <td><a data-original-title="Editar campo Como prefere ser chamado" data-placeholder="Digite um apelido" data-placement="right" data-pk="1" data-type="text" id="apelido-<?=$rSql['id']?>" href="#"><?=$rSql['apelido']?></a></td>
                                                                    <td style="vertical-align:middle;"><? if(trim($rSql['data'])=="0000-00-00") { } else { ajustaData($rSql['data'],"d/m/Y"); } ?></td>
                                                                    <td class="nolink">
                                                                        <div class="btn-group">
                                                                        <? if(trim($sysperm['admin_sysacesso'])==1) { ?><a href="<?=$link?><?=$_REQUEST['var1']?>/historico-de-acessos/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Histórico de Acessos"><i class="icsw16-address-book"></i></a><? } ?>
                                                                        <? if(trim($sysperm['admin_syslog'])==1) { ?><a href="<?=$link?><?=$_REQUEST['var1']?>/historico-de-operacoes/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Histórico de Operações"><i class="icsw16-graph"></i></a><? } ?>
                                                                        <? if(trim($sysperm['visualizar_syspermadmin'])==1||trim($sysperm['editar_syspermadmin'])==1) { ?><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/permissoes/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Permissões"><i class="icsw16-locked-2"></i></a><? } ?>
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a><? } ?>
                                                                        <? if(trim($sysperm['excluir_'.$mod.''])==1) { ?><a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$mod?>','NAO','<?=$rSql['ordem']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a><? } ?>
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

                                                <? if(trim($_REQUEST['var3'])=="") { ?>
                                                <div id="tb1_c" class="tab-pane">
                                                    <div>
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
                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$mod."_categoria ORDER BY ordem");
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
                                                            <div style="float:left;margin-right:10px;">
                                                                <label>Cor</label>
                                                                <input value="<?=$row['cor']?>" style="width:70px;" type="text" name="cor" id="cor" />
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
            
                                                        <!--
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
                                                                <select name="bairro" id="bairro" style="width:255px;">
                                                                    <option value="">---</option>
                                                                </select>
                                                            </div>
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
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                <? } ?>
                                                
                                                <div id="tb1_d" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
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
                                                                    $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$mod."_categoria"));
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
                                                                <button type="button" onclick="salvar_categoria_sysusu('<?=$mod?>','_categoria');" class="btn btn-primary">Adicionar</button>
                                                            </div>
                                                            <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de categorias</div>
                                                                <div id="lista_categoria_itens" style="width:100%;float:left;">
																	<? $subLocalGet = "_categoria"; include("./acoes/sysusu/lista_categoria.php"); ?>
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
