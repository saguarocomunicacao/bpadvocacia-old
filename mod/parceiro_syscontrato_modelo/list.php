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
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?><li class="active"><a data-toggle="tab" href="#tb1_editar">Editando <?=$row['nome']?></a></li><? } ?>
                                                <li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Lista de Itens</a></li>
                                                <li><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li>
                                                <li><a data-toggle="tab" href="#tb1_info">Informações</a></li>
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
													if($('#texto_1').length) { 
														CKEDITOR.replace( 'texto_1', {
															toolbar: 'Standard'
														});
													}
													if($('#texto_2').length) { 
														CKEDITOR.replace( 'texto_2', {
															toolbar: 'Standard'
														});
													}
													if($('#texto_3').length) { 
														CKEDITOR.replace( 'texto_3', {
															toolbar: 'Standard'
														});
													}
													if($('#texto_4').length) { 
														CKEDITOR.replace( 'texto_4', {
															toolbar: 'Standard'
														});
													}
													if($('#texto_5').length) { 
														CKEDITOR.replace( 'texto_5', {
															toolbar: 'Standard'
														});
													}
													<? if(trim($_REQUEST['var3'])=="") { } else { ?>
													if($('#texto_1_editar').length) { 
														CKEDITOR.replace( 'texto_1_editar', {
															toolbar: 'Standard'
														});
													}
													if($('#texto_2_editar').length) { 
														CKEDITOR.replace( 'texto_2_editar', {
															toolbar: 'Standard'
														});
													}
													if($('#texto_3_editar').length) { 
														CKEDITOR.replace( 'texto_3_editar', {
															toolbar: 'Standard'
														});
													}
													if($('#texto_4_editar').length) { 
														CKEDITOR.replace( 'texto_4_editar', {
															toolbar: 'Standard'
														});
													}
													if($('#texto_5_editar').length) { 
														CKEDITOR.replace( 'texto_5_editar', {
															toolbar: 'Standard'
														});
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
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Título</label>
                                                                    <input value="<?=$row['nome']?>" style="width:350px;"  type="text" name="nome" id="nome" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Digite um título para o contrato</span>
                                                            </div>

                                                            <!--
                                                            <div class="formSep">
                                                                <label>Parágrafo descrito dos dados da empresa</label>
                                                                <p>
                                                                A <b>TAGX WEB STUDIO LTDA</b>, pessoa jurídica de direito privado, 
                                                                estabelecida na Rua Cônego Bernardo, 101, sala 609, Ed. Meridian Office, 
                                                                bairro Trindade, na cidade de Florianópolis, SC, inscrita no 
                                                                CNPJ sob o número 11.746.285/0001-20, doravante denominada CONTRATADA e a 
                                                                pessoa física ou jurídica descrita na <b>Folha de Descrição de Cliente (FDC)</b> 
                                                                anexa doravante denominada CLIENTE celebram o seguinte acordo de serviço:                                                                
                                                                </p>
                                                            </div>
                                                            -->

                                                            <div class="formSep">
                                                                <label>Contrato</label>
                                                                <textarea name="texto_1" id="texto_1_editar" class="span12" style="height:150px;"><?=$row['texto_1']?></textarea>
                                                            </div>
                
                                                            <!--
                                                            <div class="formSep">
                                                                <label><b>Folha de descrição do cliente (FDC)</b></label>
                                                                <p>
                                                                <br />
                                                                PESSOA FÍSICA (  )	PESSOA JURÍDICA ( X )
                                                                <br /><br />	
                                                                <b>ID:</b>	9621
                                                                <br /><br />
                                                                <b>Nome / Razão Social:</b>	Tagx Web Studio<br />
                                                                <b>Telefone 1:</b>	4830244008	<br />
                                                                <b>Telefone 2:</b>	4888266323	<br />	
                                                                <b>CPF / CNPJ:</b>	11.746.285/0001-20	<br />
                                                                <b>RG / Inscr. Est.:</b> 000000000000000000000	<br />
                                                                <b>E-mail(s):</b>	atendimento@tagx.com.br, financeiro@tagx.com.br <br />
                                                                <b>Endereço:</b>	Rua Cônego Bernardo,101. <br />
                                                                <b>Bloco / Casa:</b> Bloco Único<br />		
                                                                <b>Apto/Sala:</b>	609	<br />
                                                                <b>Complemento:</b> Ed.   Meridian Office	<br />
                                                                <b>Bairro:</b>	Trindade	<br />
                                                                <b>Cidade:</b>	Florianópolis	<br />
                                                                <b>UF:</b>	SC	<br />
                                                                <b>CEP:</b> 88000-000</b>	<br />
                                                                
                                                                </p>
                                                            </div>

                                                            <div class="formSep">
                                                                <label><b>Folha de descrição de serviço (FDS)</b></label>
                                                                <p>
                                                                <br />
                                                                <b>SERVIÇO/PRODUTO:</b>	NOME DO PRODUTO, SERVIÇO OU SOLUÇÃO<br />
                                                                <b>DATA DE CONTRATAÇÃO:</b>	<? echo date("d/m/Y"); ?>
                                                                <br /><br />
                                                                <table style="border:1px solid #000" border="0" cellpadding="0" cellpadding="0" width="100%">
                                                                	<tr style="background-color:#CCC;border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;<b>Serviço</b></td>
                                                                    	<td>&nbsp;&nbsp;<b>Descrição</b></td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Espaço em Disco</td>
                                                                    	<td>&nbsp;&nbsp;25GB</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Tráfego Mensal</td>
                                                                    	<td>&nbsp;&nbsp;Tráfego mensal de 100GB para troca de arquivos entre a homepage e os usuários</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Domínios</td>
                                                                    	<td>&nbsp;&nbsp;50 (cinquenta)</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;E-mail@dominio</td>
                                                                    	<td>&nbsp;&nbsp;Ilimitados (Ilimitados) endereços eletrônicos com espaço gerenciável</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Relatório de Acessos</td>
                                                                    	<td>&nbsp;&nbsp;Relatório on-line dos acessos dos usuários ao site</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;MYSQL</td>
                                                                    	<td>&nbsp;&nbsp;01 (um) banco de dados MySQL</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Contador de visitas</td>
                                                                    	<td>&nbsp;&nbsp;Script para contagem de visitantes</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Formmail</td>
                                                                    	<td>&nbsp;&nbsp;Script para envio de e-mail</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Diretório protegido</td>
                                                                    	<td>&nbsp;&nbsp;Proteção com senha para diretórios dentro do espaço contratado</td>
                                                                    </tr>
                                                                	<tr>
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;WAP</td>
                                                                    	<td>&nbsp;&nbsp;Suporte a WAP</td>
                                                                    </tr>
                                                                </table>
                                                                </p>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Texto 2</label>
                                                                <textarea name="texto_2" id="texto_2_editar" class="span12" style="height:150px;"><?=$row['texto_2']?></textarea>
                                                            </div>

                                                            <div class="formSep">
                                                                <label><b>Valor do Serviço</b></label>
                                                                <p>Valor mensal: R$ 99,00 (noventa e nove reais). Descontos podem ser aplicados em caso de pagamento TRIMESTRAL, SEMESTRAL ou ANUAL.</p>
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

                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
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
                                                                    <th>Título</th>
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

                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo Título" data-placeholder="Digite um Título" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
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
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Título</label>
                                                                    <input value="" class="span7" type="text" name="nome" id="nome" />
                                                                </div>
                                                                <span class="help-block" style="width:100%;float:left;">Digite um título para o contrato</span>
                                                            </div>

                                                            <!--
                                                            <div class="formSep">
                                                                <label>Parágrafo descrito dos dados da empresa</label>
                                                                <p>
                                                                A <b>TAGX WEB STUDIO LTDA</b>, pessoa jurídica de direito privado, 
                                                                estabelecida na Rua Cônego Bernardo, 101, sala 609, Ed. Meridian Office, 
                                                                bairro Trindade, na cidade de Florianópolis, SC, inscrita no 
                                                                CNPJ sob o número 11.746.285/0001-20, doravante denominada CONTRATADA e a 
                                                                pessoa física ou jurídica descrita na <b>Folha de Descrição de Cliente (FDC)</b> 
                                                                anexa doravante denominada CLIENTE celebram o seguinte acordo de serviço:                                                                
                                                                </p>
                                                            </div>
                                                            -->

                                                            <div class="formSep">
                                                                <label>Contrato</label>
                                                                <textarea name="texto_1" id="texto_1" class="span12" style="height:150px;"></textarea>
                                                            </div>

                                                            <!--
                                                            <div class="formSep">
                                                                <label><b>Folha de descrição do cliente (FDC)</b></label>
                                                                <p>
                                                                <br />
                                                                PESSOA FÍSICA (  )	PESSOA JURÍDICA ( X )
                                                                <br /><br />	
                                                                <b>ID:</b>	9621
                                                                <br /><br />
                                                                <b>Nome / Razão Social:</b>	Tagx Web Studio<br />
                                                                <b>Telefone 1:</b>	4830244008	<br />
                                                                <b>Telefone 2:</b>	4888266323	<br />	
                                                                <b>CPF / CNPJ:</b>	11.746.285/0001-20	<br />
                                                                <b>RG / Inscr. Est.:</b> 000000000000000000000	<br />
                                                                <b>E-mail(s):</b>	atendimento@tagx.com.br, financeiro@tagx.com.br <br />
                                                                <b>Endereço:</b>	Rua Cônego Bernardo,101. <br />
                                                                <b>Bloco / Casa:</b> Bloco Único<br />		
                                                                <b>Apto/Sala:</b>	609	<br />
                                                                <b>Complemento:</b> Ed.   Meridian Office	<br />
                                                                <b>Bairro:</b>	Trindade	<br />
                                                                <b>Cidade:</b>	Florianópolis	<br />
                                                                <b>UF:</b>	SC	<br />
                                                                <b>CEP:</b> 88000-000</b>	<br />
                                                                
                                                                </p>
                                                            </div>

                                                            <div class="formSep">
                                                                <label><b>Folha de descrição de serviço (FDS)</b></label>
                                                                <p>
                                                                <br />
                                                                <b>SERVIÇO/PRODUTO:</b>	NOME DO PRODUTO, SERVIÇO OU SOLUÇÃO<br />
                                                                <b>DATA DE CONTRATAÇÃO:</b>	<? echo date("d/m/Y"); ?>
                                                                <br /><br />
                                                                <table style="border:1px solid #000" border="0" cellpadding="0" cellpadding="0" width="100%">
                                                                	<tr style="background-color:#CCC;border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;<b>Serviço</b></td>
                                                                    	<td>&nbsp;&nbsp;<b>Descrição</b></td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Espaço em Disco</td>
                                                                    	<td>&nbsp;&nbsp;25GB</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Tráfego Mensal</td>
                                                                    	<td>&nbsp;&nbsp;Tráfego mensal de 100GB para troca de arquivos entre a homepage e os usuários</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Domínios</td>
                                                                    	<td>&nbsp;&nbsp;50 (cinquenta)</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;E-mail@dominio</td>
                                                                    	<td>&nbsp;&nbsp;Ilimitados (Ilimitados) endereços eletrônicos com espaço gerenciável</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Relatório de Acessos</td>
                                                                    	<td>&nbsp;&nbsp;Relatório on-line dos acessos dos usuários ao site</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;MYSQL</td>
                                                                    	<td>&nbsp;&nbsp;01 (um) banco de dados MySQL</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Contador de visitas</td>
                                                                    	<td>&nbsp;&nbsp;Script para contagem de visitantes</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Formmail</td>
                                                                    	<td>&nbsp;&nbsp;Script para envio de e-mail</td>
                                                                    </tr>
                                                                	<tr style="border-bottom:1px solid #000;">
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;Diretório protegido</td>
                                                                    	<td>&nbsp;&nbsp;Proteção com senha para diretórios dentro do espaço contratado</td>
                                                                    </tr>
                                                                	<tr>
                                                                    	<td style="border-right:1px solid #000;">&nbsp;&nbsp;WAP</td>
                                                                    	<td>&nbsp;&nbsp;Suporte a WAP</td>
                                                                    </tr>
                                                                </table>
                                                                </p>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Texto 2</label>
                                                                <textarea name="texto_2" id="texto_2" class="span12" style="height:150px;"></textarea>
                                                            </div>

                                                            <div class="formSep">
                                                                <label><b>Valor do Serviço</b></label>
                                                                <p>Valor mensal: R$ 99,00 (noventa e nove reais). Descontos podem ser aplicados em caso de pagamento TRIMESTRAL, SEMESTRAL ou ANUAL.</p>
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


                                                <div id="tb1_info" class="tab-pane">

                                                    <div class="formSep">
                                                    Consulte abaixo as expressões que podem ser usadas e substituídas no contrato por dados reais do cliente e parceiros e usuários.
                                                    <br />
                                                    Significado das expressões:
                                                    </div>

                                                    <div class="formSep" style="font-size:14px;font-weight:bold;">Dados do contrato</div>

                                                    <div class="formSep">
                                                        <button id="contrato_data_assinatura" class="btn btn-small btn-primary" data-clipboard-text="[@contrato.data_assinatura]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Contrato =  [@contrato.data_assinatura] </label>
                                                    </div>

                                                    <div class="formSep" style="font-size:14px;font-weight:bold;">Dados de cliente</div>

                                                    <div class="formSep">
                                                        <button id="cliente_nome" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.nome]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Nome completo =  [@cliente.nome] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_razao_social" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.razao_social]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Razão Social =  [@cliente.razao_social] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_nome_fantasia" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.nome_fantasia]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Nome fantasia =  [@cliente.nome_fantasia] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_responsavel" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.responsavel]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Nome responsável =  [@cliente.responsavel] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_responsavel_cargo" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.responsavel_cargo]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Cargo do responsável =  [@cliente.responsavel_cargo] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_email" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.email]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">E-mail =  [@cliente.email] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_estado_civil" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.estado_civil]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Estado civil =  [@cliente.estado_civil] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_data_nascimento" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.data_nascimento]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Data de Nascimento =  [@cliente.data_nascimento] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_profissao" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.profissao]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Profissão =  [@cliente.profissao] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_nacionalidade" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.nacionalidade]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Nacionalidade =  [@cliente.nacionalidade] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_cnpj" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.cnpj]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">CNPJ =  [@cliente.cnpj] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_ie" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.ie]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">IE =  [@cliente.ie] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_cpf" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.cpf]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">CPF =  [@cliente.cpf] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_rg" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.rg]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">RG =  [@cliente.rg] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_emissor" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.emissor]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Emissor =  [@cliente.emissor] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_pis" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.pis]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">PIS =  [@cliente.pis] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_cep" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.cep]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">CEP =  [@cliente.cep] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_rua" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.rua], n° [@cliente.numero] - [@cliente.complemento]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Endereço =  [@cliente.rua], n° [@cliente.numero] - [@cliente.complemento] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_bairro" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.bairro]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Bairro =  [@cliente.bairro] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_cidade" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.cidade]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Cidade =  [@cliente.cidade] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_estado" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.estado]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Estado =  [@cliente.estado] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="cliente_telefone" class="btn btn-small btn-primary" data-clipboard-text="[@cliente.telefone]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Telefone =  [@cliente.telefone] </label>
                                                    </div>

                                                    <div class="formSep" style="font-size:14px;font-weight:bold;">Dados do usuário</div>
                                                    
                                                    <div class="formSep">
                                                        <button id="usuario_nome" class="btn btn-small btn-primary" data-clipboard-text="[@usuario.nome]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Nome completo =  [@usuario.nome] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="usuario_email" class="btn btn-small btn-primary" data-clipboard-text="[@usuario.email]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">E-mail =  [@usuario.email] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="usuario_cep" class="btn btn-small btn-primary" data-clipboard-text="[@usuario.cep]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">CEP =  [@usuario.cep] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="usuario_rua" class="btn btn-small btn-primary" data-clipboard-text="[@usuario.rua], n° [@usuario.numero] - [@usuario.complemento]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Endereço =  [@usuario.rua], n° [@usuario.numero] - [@usuario.complemento] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="usuario_bairro" class="btn btn-small btn-primary" data-clipboard-text="[@usuario.bairro]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Bairro =  [@usuario.bairro] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="usuario_cidade" class="btn btn-small btn-primary" data-clipboard-text="[@usuario.cidade]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Cidade =  [@usuario.cidade] </label>
                                                    </div>

                                                    <div class="formSep">
                                                        <button id="usuario_estado" class="btn btn-small btn-primary" data-clipboard-text="[@usuario.estado]" style="float:left;margin-right:5px;margin-bottom:5px;margin-top:-2px;" title="Copiar esta expressão">Copiar esta expressão</button>
                                                        <label style="float:left;width:500px;">Estado =  [@usuario.estado] </label>
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

			<script type="text/javascript" src="<?=$link?>template/js/zeroclipboard/dist/ZeroClipboard.js"></script>
            <script>
				$(document).ready(function() {
					var client_nome = new ZeroClipboard(document.getElementById("cliente_nome"));
					
					client_nome.on( "ready", function( readyEvent ) {
					  client_nome.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_razao_social = new ZeroClipboard(document.getElementById("cliente_razao_social"));
					
					client_razao_social.on( "ready", function( readyEvent ) {
					  client_razao_social.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_nome_fantasia = new ZeroClipboard(document.getElementById("cliente_nome_fantasia"));
					
					client_nome_fantasia.on( "ready", function( readyEvent ) {
					  client_nome_fantasia.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_responsavel = new ZeroClipboard(document.getElementById("cliente_responsavel"));
					
					client_responsavel.on( "ready", function( readyEvent ) {
					  client_responsavel.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_responsavel_cargo = new ZeroClipboard(document.getElementById("cliente_responsavel_cargo"));
					
					client_responsavel_cargo.on( "ready", function( readyEvent ) {
					  client_responsavel_cargo.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_email = new ZeroClipboard(document.getElementById("cliente_email"));
					
					client_email.on( "ready", function( readyEvent ) {
					  client_email.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_estado_civil = new ZeroClipboard(document.getElementById("cliente_estado_civil"));
					
					client_estado_civil.on( "ready", function( readyEvent ) {
					  client_estado_civil.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_data_nascimento = new ZeroClipboard(document.getElementById("cliente_data_nascimento"));
					
					client_data_nascimento.on( "ready", function( readyEvent ) {
					  client_data_nascimento.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_profissao = new ZeroClipboard(document.getElementById("cliente_profissao"));
					
					client_profissao.on( "ready", function( readyEvent ) {
					  client_profissao.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_nacionalidade = new ZeroClipboard(document.getElementById("cliente_nacionalidade"));
					
					client_nacionalidade.on( "ready", function( readyEvent ) {
					  client_nacionalidade.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_cnpj = new ZeroClipboard(document.getElementById("cliente_cnpj"));
					
					client_cnpj.on( "ready", function( readyEvent ) {
					  client_cnpj.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_ie = new ZeroClipboard(document.getElementById("cliente_ie"));
					
					client_ie.on( "ready", function( readyEvent ) {
					  client_ie.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_cpf = new ZeroClipboard(document.getElementById("cliente_cpf"));
					
					client_cpf.on( "ready", function( readyEvent ) {
					  client_cpf.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_rg = new ZeroClipboard(document.getElementById("cliente_rg"));
					
					client_rg.on( "ready", function( readyEvent ) {
					  client_rg.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_emissor = new ZeroClipboard(document.getElementById("cliente_emissor"));
					
					client_emissor.on( "ready", function( readyEvent ) {
					  client_emissor.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_pis = new ZeroClipboard(document.getElementById("cliente_pis"));
					
					client_pis.on( "ready", function( readyEvent ) {
					  client_pis.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_rua = new ZeroClipboard(document.getElementById("cliente_rua"));
					
					client_rua.on( "ready", function( readyEvent ) {
					  client_rua.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_bairro = new ZeroClipboard(document.getElementById("cliente_bairro"));
					
					client_bairro.on( "ready", function( readyEvent ) {
					  client_bairro.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_cidade = new ZeroClipboard(document.getElementById("cliente_cidade"));
					
					client_cidade.on( "ready", function( readyEvent ) {
					  client_cidade.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_estado = new ZeroClipboard(document.getElementById("cliente_estado"));
					
					client_estado.on( "ready", function( readyEvent ) {
					  client_estado.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_cep = new ZeroClipboard(document.getElementById("cliente_cep"));
					
					client_cep.on( "ready", function( readyEvent ) {
					  client_cep.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var client_telefone = new ZeroClipboard(document.getElementById("cliente_telefone"));
					
					client_telefone.on( "ready", function( readyEvent ) {
					  client_telefone.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var contrato_data_assinatura = new ZeroClipboard(document.getElementById("contrato_data_assinatura"));
					
					contrato_data_assinatura.on( "ready", function( readyEvent ) {
					  contrato_data_assinatura.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var usuario_nome = new ZeroClipboard(document.getElementById("usuario_nome"));
					
					usuario_nome.on( "ready", function( readyEvent ) {
					  usuario_nome.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var usuario_email = new ZeroClipboard(document.getElementById("usuario_email"));
					
					usuario_email.on( "ready", function( readyEvent ) {
					  usuario_email.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var usuario_cep = new ZeroClipboard(document.getElementById("usuario_cep"));
					
					usuario_cep.on( "ready", function( readyEvent ) {
					  usuario_cep.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var usuario_rua = new ZeroClipboard(document.getElementById("usuario_rua"));
					
					usuario_rua.on( "ready", function( readyEvent ) {
					  usuario_rua.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var usuario_bairro = new ZeroClipboard(document.getElementById("usuario_bairro"));
					
					usuario_bairro.on( "ready", function( readyEvent ) {
					  usuario_bairro.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var usuario_cidade = new ZeroClipboard(document.getElementById("usuario_cidade"));
					
					usuario_cidade.on( "ready", function( readyEvent ) {
					  usuario_cidade.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});

					var usuario_estado = new ZeroClipboard(document.getElementById("usuario_estado"));
					
					usuario_estado.on( "ready", function( readyEvent ) {
					  usuario_estado.on( "aftercopy", function( event ) {
						$.sticky("Texto copiado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
					  });
					});
				});
            </script>
