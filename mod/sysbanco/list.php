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
                                                                banco: { required: true },
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
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };

                                            //* masked inputs
                                            beoro_maskedInputs = {
                                                init: function() {
                                                    $("#cep").inputmask('99999-999');
                                                    $("#cpf").inputmask('999.999.999-99');
                                                    $("#cnpj").inputmask('99.999.999/9999-99');
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
                                                                <label class="req">Nome</label>
                                                                <input value="<?=$row['nome']?>" class="span8" type="text" name="nome" id="nome" />
                                                            </div>

                                                            <div class="formSep">
                                                                <label class="req">Banco</label>
                                                                <select name="banco" id="banco" class="span3">
                                                                    <option value="">---</option>
                                                                    <option value="bancoob" <? if($row['banco']=="bancoob") { echo "selected"; } ?>>Bancoob</option>
                                                                    <option value="banestes" <? if($row['banco']=="banestes") { echo "selected"; } ?>>Banestes</option>
                                                                    <option value="bb" <? if($row['banco']=="bb") { echo "selected"; } ?>>Banco do Brasil</option>
                                                                    <option value="besc" <? if($row['banco']=="besc") { echo "selected"; } ?>>Besc</option>
                                                                    <option value="bradesco" <? if($row['banco']=="bradesco") { echo "selected"; } ?>>Bradesco</option>
                                                                    <option value="cef" <? if($row['banco']=="cef") { echo "selected"; } ?>>Caixa Econômica Federal</option>
                                                                    <option value="cef_sigcb" <? if($row['banco']=="cef_sigcb") { echo "selected"; } ?>>Caixa Econômica Federal - SIGCB</option>
                                                                    <option value="cef_sinco" <? if($row['banco']=="cef_sinco") { echo "selected"; } ?>>Caixa Econômica Federal - SINCO</option>
                                                                    <option value="hsbc" <? if($row['banco']=="hsbc") { echo "selected"; } ?>>HSBC</option>
                                                                    <option value="itau" <? if($row['banco']=="itau") { echo "selected"; } ?>>Itaú</option>
                                                                    <option value="nossacaixa" <? if($row['banco']=="nossacaixa") { echo "selected"; } ?>>Nossa Caixa</option>
                                                                    <option value="real" <? if($row['banco']=="real") { echo "selected"; } ?>>Banco Real</option>
                                                                    <option value="santander_banespa" <? if($row['banco']=="santander_banespa") { echo "selected"; } ?>>Santander Banespa</option>
                                                                    <option value="sicredi" <? if($row['banco']=="sicredi") { echo "selected"; } ?>>Sicredi</option>
                                                                    <option value="sofisa" <? if($row['banco']=="sofisa") { echo "selected"; } ?>>Sofisa</option>
                                                                    <option value="sudameris" <? if($row['banco']=="sudameris") { echo "selected"; } ?>>Sudameris</option>
                                                                    <option value="unibanco" <? if($row['banco']=="unibanco") { echo "selected"; } ?>>Unibanco</option>
                                                                </select>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100px;">
                                                                    <label>Agência</label>
                                                                    <input value="<?=$row['agencia']?>" class="span12" type="text" name="agencia" id="agencia" />
                                                                    <span class="help-block">Não inserir o digito</span>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                    <label>Conta</label>
                                                                    <input value="<?=$row['conta']?>" class="span12" type="text" name="conta" id="conta" />
                                                                    <span class="help-block">Não inserir o digito</span>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100px;">
                                                                    <label>Convênio</label>
                                                                    <input value="<?=$row['convenio']?>" class="span12" type="text" name="convenio" id="convenio" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                    <label>Contrato</label>
                                                                    <input value="<?=$row['contrato']?>" class="span12" type="text" name="contrato" id="contrato" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                    <label>Carteira</label>
                                                                    <input value="<?=$row['carteira']?>" class="span12" type="text" name="carteira" id="carteira" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:200px;">
                                                                    <label>Variação da Carteira</label>
                                                                    <input value="<?=$row['variacao_carteira']?>" class="span12" type="text" name="variacao_carteira" id="variacao_carteira" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:200px;">
                                                                    <label>Formatação do Convênio</label>
                                                                    <input value="<?=$row['formatacao_convenio']?>" class="span4" type="text" name="formatacao_convenio" id="formatacao_convenio" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:200px;">
                                                                    <label>Formatação Nosso Número</label>
                                                                    <input value="<?=$row['formatacao_nosso_numero']?>" class="span4" type="text" name="formatacao_nosso_numero" id="formatacao_nosso_numero" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Nome do Cedente</label>
                                                                <input value="<?=$row['cedente']?>" class="span8" type="text" name="cedente" id="cedente" />
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Tipo de Documento</label>
                                                                <select name="tipo_de_documento" id="tipo_de_documento" class="span3" onchange="tipo_de_doc('');">
                                                                    <option value="">---</option>
                                                                    <option value="pf" <? if($row['tipo_de_documento']=="pf") { echo "selected"; } ?>>pessoa física</option>
                                                                    <option value="pj" <? if($row['tipo_de_documento']=="pj") { echo "selected"; } ?>>pessoa jurídica</option>
                                                                </select>
                                                                <span class="help-block">Ao escolher o tipo de cliente, abaixo serão exibidos os campos referentes ao tipo de cadastro</span>
                                                            </div>

                                                            <div class="formSep" style="display:<? if($row['tipo_de_documento']=="pf") { echo "block"; } else { echo "none"; } ?>;" id="div_pf">
                                                                <div class="span4">
                                                                    <label>CPF</label>
                                                                    <input class="span12" value="<?=$row['cpf']?>" name="cpf" id="cpf" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="formSep" style="display:<? if($row['tipo_de_documento']=="pj") { echo "block"; } else { echo "none"; } ?>;" id="div_pj">
                                                                <div class="span4">
                                                                    <label>CNPJ</label>
                                                                    <input class="span12" value="<?=$row['cnpj']?>" name="cnpj" id="cnpj" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>CEP</label>
                                                                    <input value="<?=$row['cep']?>" style="width:90px;" type="text" name="cep" id="cep" />
                                                                    <span class="help-block">99999-999</span>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;margin-top:27px;">
                                                                    <button type="button" onclick="buscaCep();" class="btn btn-small">Carregar endereço</button>
                                                                </div>
                                                            </div>
                            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Rua</label>
                                                                    <input value="<?=$row['rua']?>" style="width:350px;" type="text" name="rua" id="rua" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Número</label>
                                                                    <input value="<?=$row['numero']?>" style="width:50px;" type="text" name="numero" id="numero" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Complemento</label>
                                                                    <input value="<?=$row['complemento']?>" style="width:250px;" type="text" name="complemento" id="complemento" />
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
                                                                        <option value="<?= $rSqlEstado['uf'] ?>" <? if($rSqlEstado['uf']==$row['estado']) { echo "selected"; } ?>><?= utf8_encode($rSqlEstado['estado']) ?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Cidade</label>
                                                                    <select name="cidade" id="cidade" onchange="javascript:mostraBairros();" style="width:255px">
                                                                        <? if(trim($row['estado'])=="") { ?>
                                                                        <option value="">---</option>
                                                                        <? } else { ?>
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlCidade = mysql_query("SELECT * FROM cepbr_cidade WHERE id_cidade='".$row['cidade']."' ORDER BY cidade");
                                                                        while($rSqlCidade=mysql_fetch_array($qSqlCidade)) {
                                                                        ?>
                                                                        <option value="<?=$rSqlCidade['id_cidade']?>" <? if($rSqlCidade['id_cidade']==$row['cidade']) { echo "selected"; } ?>><?=utf8_encode($rSqlCidade['cidade'])?></option>
                                                                        <? } ?>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Bairro</label>
                                                                    <select name="bairro" id="bairro" style="width:255px;">
                                                                        <? if(trim($row['cidade'])=="") { ?>
                                                                        <option value="">---</option>
                                                                        <? } else { ?>
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlBairro = mysql_query("SELECT * FROM cepbr_bairro WHERE id_cidade='".$row['cidade']."' ORDER BY bairro");
                                                                        while($rSqlBairro=mysql_fetch_array($qSqlBairro)) {
                                                                        ?>
                                                                        <option value="<?=$rSqlBairro['id_bairro']?>" <? if($rSqlBairro['id_bairro']==$row['bairro']) { echo "selected"; } ?>><?=utf8_encode($rSqlBairro['bairro'])?></option>
                                                                        <? } ?>
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
                                                                    <th>Banco</th>
                                                                    <th>Nome</th>
                                                                    <th>Agência</th>
                                                                    <th>Conta</th>
                                                                    <th style="width:110px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY nome");
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

                                                                    <td style="vertical-align:middle;"><img style="max-height:25px;" SRC="<?=$link?>include/lib/phpboleto/imagens/logo<?=$rSql['banco']?>.jpg"></td>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['agencia']?></td>
                                                                    <td style="vertical-align:middle;"><?=$rSql['conta']?></td>
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

    
                                                            <div class="formSep">
                                                                <label class="req">Nome</label>
                                                                <input value="" class="span8" type="text" name="nome" id="nome" />
                                                            </div>

                                                            <div class="formSep">
                                                                <label class="req">Banco</label>
                                                                <select name="banco" id="banco" class="span3">
                                                                    <option value="">---</option>
                                                                    <option value="bancoob">Bancoob</option>
                                                                    <option value="banestes">Banestes</option>
                                                                    <option value="bb">Banco do Brasil</option>
                                                                    <option value="besc">Besc</option>
                                                                    <option value="bradesco">Bradesco</option>
                                                                    <option value="cef">Caixa Econômica Federal</option>
                                                                    <option value="cef_sigcb">Caixa Econômica Federal - SIGCB</option>
                                                                    <option value="cef_sinco">Caixa Econômica Federal - SINCO</option>
                                                                    <option value="hsbc">HSBC</option>
                                                                    <option value="itau">Itaú</option>
                                                                    <option value="nossacaixa">Nossa Caixa</option>
                                                                    <option value="real">Banco Real</option>
                                                                    <option value="santander_banespa">Santander Banespa</option>
                                                                    <option value="sicredi">Sicredi</option>
                                                                    <option value="sofisa">Sofisa</option>
                                                                    <option value="sudameris">Sudameris</option>
                                                                    <option value="unibanco">Unibanco</option>
                                                                </select>
                                                            </div>


                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100px;">
                                                                    <label>Agência</label>
                                                                    <input value="" class="span12" type="text" name="agencia" id="agencia" />
                                                                    <span class="help-block">Não inserir o digito</span>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                    <label>Conta</label>
                                                                    <input value="" class="span12" type="text" name="conta" id="conta" />
                                                                    <span class="help-block">Não inserir o digito</span>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100px;">
                                                                    <label>Convênio</label>
                                                                    <input value="" class="span12" type="text" name="convenio" id="convenio" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                    <label>Contrato</label>
                                                                    <input value="" class="span12" type="text" name="contrato" id="contrato" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:150px;">
                                                                    <label>Carteira</label>
                                                                    <input value="" class="span12" type="text" name="carteira" id="carteira" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:200px;">
                                                                    <label>Variação da Carteira</label>
                                                                    <input value="" class="span12" type="text" name="variacao_carteira" id="variacao_carteira" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:200px;">
                                                                    <label>Formatação do Convênio</label>
                                                                    <input value="" class="span4" type="text" name="formatacao_convenio" id="formatacao_convenio" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:200px;">
                                                                    <label>Formatação Nosso Número</label>
                                                                    <input value="" class="span4" type="text" name="formatacao_nosso_numero" id="formatacao_nosso_numero" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Nome do Cedente</label>
                                                                <input value="" class="span8" type="text" name="cedente" id="cedente" />
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Tipo de Documento</label>
                                                                <select name="tipo_de_documento" id="tipo_de_documento" class="span3" onchange="tipo_de_doc('');">
                                                                    <option value="">---</option>
                                                                    <option value="pf">pessoa física</option>
                                                                    <option value="pj">pessoa jurídica</option>
                                                                </select>
                                                                <span class="help-block">Ao escolher o tipo de cliente, abaixo serão exibidos os campos referentes ao tipo de cadastro</span>
                                                            </div>

                                                            <div class="formSep" style="display:none;" id="div_pf">
                                                                <div class="span4">
                                                                    <label>CPF</label>
                                                                    <input class="span12" value="" name="cpf" id="cpf" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="formSep" style="display:none;" id="div_pj">
                                                                <div class="span4">
                                                                    <label>CNPJ</label>
                                                                    <input class="span12" value="" name="cnpj" id="cnpj" type="text">
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
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Rua, Avenida ou Servidão</label>
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

                                                            <div class="formSep">
                                                                <label class="req">Ativo ?</label>
                                                                <label class="radio" style="color:#C00;">
                                                                    <input type="radio" name="stat" id="stat1" value="0"  >
                                                                    não
                                                                </label>
                                                                <label class="radio" style="color:#390;">
                                                                    <input type="radio" name="stat" id="stat2" value="1" checked="checked" >
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

                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
