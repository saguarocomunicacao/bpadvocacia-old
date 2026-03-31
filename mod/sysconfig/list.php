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
                                    <? if(trim($sysperm['admin_'.$mod.''])==1) { $aba1 = 1; ?><li <? if(trim($_REQUEST['var3'])=="administrativo"||(trim($_REQUEST['var3'])==""&&$aba1==1)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_a">Admin</a></li><? } else { $aba1 = 0; }?>
                                    <? if(trim($sysperm['site_'.$mod.''])==1) { $aba2 = 1; ?><li <? if(trim($_REQUEST['var3'])=="site"||(trim($_REQUEST['var3'])==""&&$aba1==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_b">Site</a></li><? } else { $aba2 = 0; } ?>
                                    <? if(trim($sysperm['layout_'.$mod.''])==1) { $aba3 = 1; ?><li <? if(trim($_REQUEST['var3'])=="layout"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_layout">Layout</a></li><? } else { $aba3 = 0; } ?>
                                    <? if(trim($sysperm['imagens_'.$mod.''])==1) { $aba4 = 1; ?><li <? if(trim($_REQUEST['var3'])=="imagens"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_c">Imagens</a></li><? } else { $aba4 = 0; } ?>
                                    <? if(trim($sysperm['mensagens_'.$mod.''])==1) { $aba5 = 1; ?><li <? if(trim($_REQUEST['var3'])=="mensagens"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_d">Mensagens</a></li><? } else { $aba5 = 0; } ?>
                                    <? if(trim($sysperm['seo_'.$mod.''])==1) { $aba6 = 1; ?><li <? if(trim($_REQUEST['var3'])=="seo"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_e">SEO</a></li><? } else { $aba6 = 0; } ?>
                                    <? if(trim($sysperm['indexacao_'.$mod.''])==1) { $aba7 = 1; ?><li <? if(trim($_REQUEST['var3'])=="indexacao"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_f">Indexação</a></li><? } else { $aba7 = 0; } ?>
                                    <? if(trim($sysperm['analytics_'.$mod.''])==1) { $aba8 = 1; ?><li <? if(trim($_REQUEST['var3'])=="google-analytics"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_g">Analytics</a></li><? } else { $aba8 = 0; } ?>
                                    <? if(trim($sysperm['erro404_'.$mod.''])==1) { $aba9 = 1; ?><li <? if(trim($_REQUEST['var3'])=="pagina-de-erro404"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0&&$aba8==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_h">ERRO 404</a></li><? } else { $aba9 = 0; } ?>
                                    <? if(trim($sysperm['instalacao_'.$mod.''])==1) { $aba10 = 1; ?><li <? if(trim($_REQUEST['var3'])=="servidor"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0&&$aba8==0&&$aba9==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_instalacao">Instalação</a></li><? } else { $aba10 = 0; } ?>
                                    <? if(trim($sysperm['dominios_'.$mod.''])==1) { $aba11 = 1; ?><li <? if(trim($_REQUEST['var3'])=="dominio"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0&&$aba8==0&&$aba9==0&&$aba10==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_i">Domínios</a></li><? } else { $aba11 = 0; } ?>
                                    <? if(trim($sysperm['servidor_'.$mod.''])==1) { $aba12 = 1; ?><li <? if(trim($_REQUEST['var3'])=="servidor"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0&&$aba8==0&&$aba9==0&&$aba10==0&&$aba11==0)) { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_j">Servidor</a></li><? } else { $aba12 = 0; } ?>
                                </ul>
                                <script>
                                  $(document).ready(function() {
                                    //* form validation
                                    forms.simple();

                                    //* switch buttons
                                    beoro_switchButtons.init();

                                    //* WYSIWG Editor
                                    beoro_wysiwg.init();

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
                                        if($('#forms_instalacao').length) {
                                            $('#forms_instalacao').validate({
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
                                                    idsysmod_categoria: { required: true },
                                                    idordem: { required: true },
                                                    nome: { required: true },
                                                    modulo_install: { required: true },
                                                },
                                                invalidHandler: function(form, validator) {
                                                    // callback
                                                }
                                            })
                                        }
                                    }
                                };

								//* WYSIWG Editor
                                beoro_wysiwg = {
                                    init: function() {
                                        if($('#manutencao_msg').length) { 
                                            CKEDITOR.replace( 'manutencao_msg', {
                                                toolbar: 'Standard'
                                            });
                                        }
                                        if($('#erro404_msg').length) { 
                                            CKEDITOR.replace( 'erro404_msg', {
                                                toolbar: 'Standard'
                                            });
                                        }
                                    }
                                };


                                //* switch buttons
                                beoro_switchButtons = {
                                    init: function() {
                                        if($('#manutencao').length) { $("#manutencao").iButton(); }
                                        if($('#banner').length) { $("#banner").iButton(); }
                                        if($('#busca').length) { $("#busca").iButton(); }
                                        if($('#url_amigavel_ativa').length) { $("#url_amigavel_ativa").iButton(); }
                                    }
                                };
	
								
								//* colorpicker
								beoro_colorpicker = {
									init: function() {
										if($('#cor1').length) {
											$('#cor1').colorpicker({
												format: 'hex'
											})
										}
										if($('#background_cor').length) {
											$('#background_cor').colorpicker({
												format: 'hex'
											})
										}
										if($('#cabecalho_cor_fonte').length) {
											$('#cabecalho_cor_fonte').colorpicker({
												format: 'hex'
											})
										}
										if($('#cabecalho_cor_fundo').length) {
											$('#cabecalho_cor_fundo').colorpicker({
												format: 'hex'
											})
										}
										if($('#menu_fundo_cor').length) {
											$('#menu_fundo_cor').colorpicker({
												format: 'hex'
											})
										}
										if($('#menu_fonte_cor').length) {
											$('#menu_fonte_cor').colorpicker({
												format: 'hex'
											})
										}
										if($('#menu_fonte_cor_over').length) {
											$('#menu_fonte_cor_over').colorpicker({
												format: 'hex'
											})
										}
										if($('#titulo_cor').length) {
											$('#titulo_cor').colorpicker({
												format: 'hex'
											})
										}
										if($('#rodape_cor_fonte').length) {
											$('#rodape_cor_fonte').colorpicker({
												format: 'hex'
											})
										}
										if($('#rodape_cor_fundo').length) {
											$('#rodape_cor_fundo').colorpicker({
												format: 'hex'
											})
										}
										if($('#copy_cor_fonte').length) {
											$('#copy_cor_fonte').colorpicker({
												format: 'hex'
											})
										}
										if($('#copy_cor_fundo').length) {
											$('#copy_cor_fundo').colorpicker({
												format: 'hex'
											})
										}
										if($('#subtitulo_cor').length) {
											$('#subtitulo_cor').colorpicker({
												format: 'hex'
											})
										}
										if($('#texto_cor').length) {
											$('#texto_cor').colorpicker({
												format: 'hex'
											})
										}
									}
								};
                                </script>
                                <div class="tab-content">
                                    <? $row_config = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." ORDER BY data LIMIT 1")); ?>
                                    
                                    <? if(trim($sysperm['admin_'.$mod.''])==1) { $aba1 = 1; ?>
                                    <div id="tb1_a" class="tab-pane  <? if(trim($_REQUEST['var3'])=="administrativo"||(trim($_REQUEST['var3'])==""&&$aba1==1)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="administrativo" />

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Quando você entrar no administrativo, que página deve abrir ?</label>
                                                        <select name="modulo_abertura" id="modulo_abertura" style="width:255px;">
                                                            <option value="">---</option>
															<?
                                                            $qSqlMod = mysql_query("SELECT * FROM sysmod ORDER BY ordem");
                                                            while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                            ?>
                                                            <option value="<?=$url_mod?>" <? if($row_config['modulo_abertura']==$url_mod) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                            <? } ?>
                                                        </select>
                                                        <span class="help-block">Altere sempre que desejar</span>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Período de Atualização do XML</label>
                                                        <input value="<?=$row_config['dias_de_atualizacao']?>" style="width:350px;" type="text" name="dias_de_atualizacao" id="dias_de_atualizacao" />
                                                        <span class="help-block">Preencher somente com números</span>
                                                    </div>
                                                </div>

                                                <!--
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Quando você entrar no administrativo, qual a linguagem padrão que deve ser utilizada ?</label>
                                                        <select name="linguagem_padrao" id="linguagem_padrao" style="width:255px;">
                                                            <option value="">---</option>
                                                            <option value="pt_" <? if($row_config['linguagem_padrao']=="pt_") { echo "selected"; } ?>>Português</option>
                                                            <option value="en_" <? if($row_config['linguagem_padrao']=="en_") { echo "selected"; } ?>>Inglês</option>
                                                        </select>
                                                        <span class="help-block">Altere sempre que desejar, caso você não selecione nenhuma linguagem, a padrão utilizada será português brasileiro.</span>
                                                    </div>
                                                </div>
                                                -->
                                                    
                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba1 = 0; } ?>

                                    <? if(trim($sysperm['site_'.$mod.''])==1) { $aba2 = 1; ?>
                                    <div id="tb1_b" class="tab-pane  <? if(trim($_REQUEST['var3'])=="site"||(trim($_REQUEST['var3'])==""&&$aba1==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="site" />

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Nome do site</label>
                                                        <input value="<?=$row_config['nome']?>" style="width:350px;" type="text" name="nome" id="nome" />
                                                        <span class="help-block">Recomendamos colocar o nome completo da sua empresa</span>
                                                    </div>
                                                </div>

                                                <!--
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Quando um visitante entrar no site, qual a linguagem padrão que deve ser utilizada ?</label>
                                                        <select name="linguagem_padrao_site" id="linguagem_padrao_site" style="width:255px;">
                                                            <option value="">---</option>
                                                            <option value="pt_" <? if($row_config['linguagem_padrao_site']=="pt_") { echo "selected"; } ?>>Português</option>
                                                            <option value="en_" <? if($row_config['linguagem_padrao_site']=="en_") { echo "selected"; } ?>>Inglês</option>
                                                        </select>
                                                        <span class="help-block">Altere sempre que desejar, caso você não selecione nenhuma linguagem, a padrão utilizada será português brasileiro.</span>
                                                    </div>
                                                </div>
                                                -->

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                        <label>Site em manutenção ?</label>
                                                        <input type="checkbox" name="manutencao" id="manutencao" <? if(trim($row_config['manutencao'])==1) { echo " checked"; } ?> class="manutencao {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                        <span class="help-block">Substitui seu site por uma página indicando que ele está em manutenção</span>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <label class="req">Mensagem quando o site estiver em manutenção</label>
                                                    <textarea name="manutencao_msg" id="manutencao_msg" class="span12" style="height:150px;"><?=$row_config['manutencao_msg']?></textarea>
                                                </div>

                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba2 = 0; } ?>


                                    <? if(trim($sysperm['layout_'.$mod.''])==1) { $aba3 = 1; ?>
                                    <div id="tb1_layout" class="tab-pane  <? if(trim($_REQUEST['var3'])=="layout"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0)) { ?>active<? } ?>">
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="layout" />

												<?
                                                $qSqlItem = mysql_query("SELECT * FROM sysfonte ORDER BY nome");
                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
													$novo_link = str_replace("@aspa_simples@","'",$rSqlItem['link']); 
													$novo_link = str_replace("@aspa_dupla@","\"",$novo_link); 
													$novo_link = str_replace("@html_link@","<",$novo_link); 
													echo $novo_link;
												}
												?>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do site</label>
                                                        <input value="<?=$row_config['cor1']?>" style="width:70px;" type="text" name="cor1" id="cor1" />
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</span>
                                                </div>

                                                <div style="float:left;width:90%;margin-left:20px;"><h4>Ícones de Redes Sociais</h4></div>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do ícone</label>
                                                        <select name="cor_icone" id="cor_icone">
                                                            <option value="">---</option>
                                                            <option value="white" <? if($row_config['cor_icone']=="white") { echo "selected"; } ?>>Branco</option>
                                                            <option value="preto" <? if($row_config['cor_icone']=="preto") { echo "selected"; } ?>>Preto</option>
                                                            <option value="cinza_escuro" <? if($row_config['cor_icone']=="cinza_escuro") { echo "selected"; } ?>>Cinza Escuro</option>
                                                            <option value="cinza_claro" <? if($row_config['cor_icone']=="cinza_claro") { echo "selected"; } ?>>Cinza Claro</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor de fundo</label>
                                                        <select name="cor_de_fundo" id="cor_de_fundo">
                                                            <option value="">---</option>
                                                            <option value="transparente" <? if($row_config['cor_de_fundo']=="transparente") { echo "selected"; } ?>>Transparente</option>
                                                            <option value="padrao" <? if($row_config['cor_de_fundo']=="padrao") { echo "selected"; } ?>>Padrão do Site</option>
                                                            <option value="branco" <? if($row_config['cor_de_fundo']=="branco") { echo "selected"; } ?>>Branco</option>
                                                            <option value="preto" <? if($row_config['cor_de_fundo']=="preto") { echo "selected"; } ?>>Preto</option>
                                                            <option value="cinza_escuro" <? if($row_config['cor_de_fundo']=="cinza_escuro") { echo "selected"; } ?>>Cinza Escuro</option>
                                                            <option value="cinza_claro" <? if($row_config['cor_de_fundo']=="cinza_claro") { echo "selected"; } ?>>Cinza Claro</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tipo de moldura</label>
                                                        <select name="tipo_moldura" id="tipo_moldura">
                                                            <option value="">---</option>
                                                            <option value="circular" <? if($row_config['tipo_moldura']=="circular") { echo "selected"; } ?>>Circular</option>
                                                            <option value="quadrada" <? if($row_config['tipo_moldura']=="quadrada") { echo "selected"; } ?>>Quadrada</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor da moldura</label>
                                                        <select name="cor_moldura" id="cor_moldura">
                                                            <option value="">---</option>
                                                            <option value="transparente" <? if($row_config['cor_moldura']=="transparente") { echo "selected"; } ?>>Transparente</option>
                                                            <option value="padrao" <? if($row_config['cor_moldura']=="padrao") { echo "selected"; } ?>>Padrão do Site</option>
                                                            <option value="branco" <? if($row_config['cor_moldura']=="branco") { echo "selected"; } ?>>Branco</option>
                                                            <option value="preto" <? if($row_config['cor_moldura']=="preto") { echo "selected"; } ?>>Preto</option>
                                                            <option value="cinza_escuro" <? if($row_config['cor_moldura']=="cinza_escuro") { echo "selected"; } ?>>Cinza Escuro</option>
                                                            <option value="cinza_claro" <? if($row_config['cor_moldura']=="cinza_claro") { echo "selected"; } ?>>Cinza Claro</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do mouse over</label>
                                                        <select name="cor_over" id="cor_over">
                                                            <option value="">---</option>
                                                            <option value="sem-efeito" <? if($row_config['cor_over']=="sem-efeito") { echo "selected"; } ?>>Sem Efeito</option>
                                                            <option value="transparente" <? if($row_config['cor_over']=="transparente") { echo "selected"; } ?>>Transparencia</option>
                                                            <option value="padrao" <? if($row_config['cor_over']=="padrao") { echo "selected"; } ?>>Padrão do Site</option>
                                                            <option value="branco" <? if($row_config['cor_over']=="branco") { echo "selected"; } ?>>Branco</option>
                                                            <option value="preto" <? if($row_config['cor_over']=="preto") { echo "selected"; } ?>>Preto</option>
                                                            <option value="cinza_escuro" <? if($row_config['cor_over']=="cinza_escuro") { echo "selected"; } ?>>Cinza Escuro</option>
                                                            <option value="cinza_claro" <? if($row_config['cor_over']=="cinza_claro") { echo "selected"; } ?>>Cinza Claro</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--
                                                <div style="float:left;width:90%;margin-left:20px;"><h4>Cabeçalho</h4></div>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor da fonte do cabeçalho</label>
                                                        <input value="<?=$row_config['cabecalho_cor_fonte']?>" style="width:70px;" type="text" name="cabecalho_cor_fonte" id="cabecalho_cor_fonte" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do fundo do cabeçalho</label>
                                                        <input value="<?=$row_config['cabecalho_cor_fundo']?>" style="width:70px;" type="text" name="cabecalho_cor_fundo" id="cabecalho_cor_fundo" />
                                                    </div>
                                                </div>
                                                -->

                                                <div style="float:left;width:90%;margin-left:20px;"><h4>Menu</h4></div>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tipo do menu</label>
                                                        <select name="menu_tipo" id="menu_tipo">
                                                            <option value="">---</option>
                                                            <option value="none" <? if($row_config['menu_tipo']=="none") { echo "selected"; } ?>>normal</option>
                                                            <option value="uppercase" <? if($row_config['menu_tipo']=="uppercase") { echo "selected"; } ?>>todas maiúsculas</option>
                                                            <option value="lowercase" <? if($row_config['menu_tipo']=="lowercase") { echo "selected"; } ?>>todas minúsculas</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Fonte do menu</label>
                                                        <select name="menu_fonte" id="menu_fonte">
                                                            <option value="">---</option>
                                                            <?
                                                            $qSqlItem = mysql_query("SELECT * FROM sysfonte ORDER BY nome");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																$novo_family = str_replace("@aspa_simples@","'",$rSqlItem['family']); 
																$novo_family = str_replace("@aspa_dupla@","\"",$novo_family);
                                                            ?>
                                                            <option value="<?= $rSqlItem['id'] ?>" style="<?=$novo_family?>" <? if($row_config['menu_fonte']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tamanho da fonte</label>
                                                        <select name="menu_px" id="menu_px" style="width:80px;">
                                                            <option value="">---</option>
                                                            <? for ($i = 10; $i <= 40; $i++) { ?>
                                                            <option value="<?=$i?>px" <? if($row_config['menu_px']=="".$i."px") { echo "selected"; } ?>><?=$i?>px</option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do fundo do menu</label>
                                                        <input value="<?=$row_config['menu_fundo_cor']?>" style="width:70px;" type="text" name="menu_fundo_cor" id="menu_fundo_cor" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor da fonte do menu</label>
                                                        <input value="<?=$row_config['menu_fonte_cor']?>" style="width:70px;" type="text" name="menu_fonte_cor" id="menu_fonte_cor" />
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</span>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor da fonte do menu ao passar o mouse sobre e quando selecionado</label>
                                                        <input value="<?=$row_config['menu_fonte_cor_over']?>" style="width:70px;" type="text" name="menu_fonte_cor_over" id="menu_fonte_cor_over" />
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</span>
                                                </div>

                                                <div style="float:left;width:90%;margin-left:20px;"><h4>Background</h4></div>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tipo de background</label>
                                                        <select name="background_tipo" id="background_tipo" onchange="seleciona_layout_background();">
                                                            <option value="">---</option>
                                                            <option value="cor" <? if($row_config['background_tipo']=="cor") { echo "selected"; } ?>>cor</option>
                                                            <option value="imagem" <? if($row_config['background_tipo']=="imagem") { echo "selected"; } ?>>imagem</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="background_div_cor" class="formSep" style="display: <? if(trim($row_config['background_tipo'])==""||trim($row_config['background_tipo'])=="imagem") { echo "none"; } else { echo "block"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do background</label>
                                                        <input value="<?=$row_config['background_cor']?>" style="width:70px;" type="text" name="background_cor" id="background_cor" />
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</span>
                                                </div>

                                                <div id="background_div_img" class="formSep" style="display: <? if(trim($row_config['background_tipo'])==""||trim($row_config['background_tipo'])=="cor") { echo "none"; } else { echo "block"; } ?>;">
                                                    <label>Imagem do background</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                        <? if(trim($row_config['background_imagem'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$mod?>/<?=$row_config['background_imagem']?>"><img id="arquivo-atual-logotipo" src="<?=$link?>files/<?=$mod?>/<?=$row_config['background_imagem']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['background_imagem'])=="") { ?>
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
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>','background_imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                        <span class="help-block">Aparecerá em todas as páginas do site e na tela de login do administrativo</span>
                                                    </div>
                                                </div>

                                                <div id="background_div_img_tipo" class="formSep" style="display: <? if(trim($row_config['background_tipo'])==""||trim($row_config['background_tipo'])=="cor") { echo "none"; } else { echo "block"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tipo de aplicação da imagem</label>
                                                        <select name="background_imagem_tipo" id="background_imagem_tipo">
                                                            <option value="">---</option>
                                                            <option value="no-repeat" <? if($row_config['background_imagem_tipo']=="no-repeat") { echo "selected"; } ?>>não repetir</option>
                                                            <option value="repeat" <? if($row_config['background_imagem_tipo']=="repeat") { echo "selected"; } ?>>repetir</option>
                                                            <option value="repeat-x" <? if($row_config['background_imagem_tipo']=="repeat-x") { echo "selected"; } ?>>repetir apenas na horizontal</option>
                                                            <option value="repeat-y" <? if($row_config['background_imagem_tipo']=="repeat-y") { echo "selected"; } ?>>repetir apenas na vertical</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div style="float:left;width:90%;margin-left:20px;"><h4>Títulos do site</h4></div>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tipo do título</label>
                                                        <select name="titulo_tipo" id="titulo_tipo">
                                                            <option value="">---</option>
                                                            <option value="none" <? if($row_config['titulo_tipo']=="none") { echo "selected"; } ?>>normal</option>
                                                            <option value="uppercase" <? if($row_config['titulo_tipo']=="uppercase") { echo "selected"; } ?>>todas maiúsculas</option>
                                                            <option value="lowercase" <? if($row_config['titulo_tipo']=="lowercase") { echo "selected"; } ?>>todas minúsculas</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Fonte do título</label>
                                                        <select name="titulo_fonte" id="titulo_fonte">
                                                            <option value="">---</option>
                                                            <?
                                                            $qSqlItem = mysql_query("SELECT * FROM sysfonte ORDER BY nome");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                            ?>
                                                            <option value="<?= $rSqlItem['id'] ?>" <? if($row_config['titulo_fonte']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tamanho da título</label>
                                                        <select name="titulo_px" id="titulo_px" style="width:80px;">
                                                            <option value="">---</option>
                                                            <? for ($i = 10; $i <= 40; $i++) { ?>
                                                            <option value="<?=$i?>px" <? if($row_config['titulo_px']=="".$i."px") { echo "selected"; } ?>><?=$i?>px</option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">

                                                        <label>Cor do título</label>
                                                        <input value="<?=$row_config['titulo_cor']?>" style="width:70px;" type="text" name="titulo_cor" id="titulo_cor" />
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</span>
                                                </div>

                                                <div style="float:left;width:90%;margin-left:20px;"><h4>Subtítulos do site</h4></div>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tipo do subtítulo</label>
                                                        <select name="subtitulo_tipo" id="subtitulo_tipo">
                                                            <option value="">---</option>
                                                            <option value="none" <? if($row_config['subtitulo_tipo']=="none") { echo "selected"; } ?>>normal</option>
                                                            <option value="uppercase" <? if($row_config['subtitulo_tipo']=="uppercase") { echo "selected"; } ?>>todas maiúsculas</option>
                                                            <option value="lowercase" <? if($row_config['subtitulo_tipo']=="lowercase") { echo "selected"; } ?>>todas minúsculas</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Fonte do subtítulo</label>
                                                        <select name="subtitulo_fonte" id="subtitulo_fonte">
                                                            <option value="">---</option>
                                                            <?
                                                            $qSqlItem = mysql_query("SELECT * FROM sysfonte ORDER BY nome");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                            ?>
                                                            <option value="<?= $rSqlItem['id'] ?>" <? if($row_config['subtitulo_fonte']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tamanho da subtítulo</label>
                                                        <select name="subtitulo_px" id="subtitulo_px" style="width:80px;">
                                                            <option value="">---</option>
                                                            <? for ($i = 10; $i <= 40; $i++) { ?>
                                                            <option value="<?=$i?>px" <? if($row_config['subtitulo_px']=="".$i."px") { echo "selected"; } ?>><?=$i?>px</option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do subtítulo</label>
                                                        <input value="<?=$row_config['subtitulo_cor']?>" style="width:70px;" type="text" name="subtitulo_cor" id="subtitulo_cor" />
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</span>
                                                </div>

                                                <div style="float:left;width:90%;margin-left:20px;"><h4>Textos do site</h4></div>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tipo do texto</label>
                                                        <select name="texto_tipo" id="texto_tipo">
                                                            <option value="">---</option>
                                                            <option value="none" <? if($row_config['texto_tipo']=="none") { echo "selected"; } ?>>normal</option>
                                                            <option value="uppercase" <? if($row_config['texto_tipo']=="uppercase") { echo "selected"; } ?>>todas maiúsculas</option>
                                                            <option value="lowercase" <? if($row_config['texto_tipo']=="lowercase") { echo "selected"; } ?>>todas minúsculas</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Fonte do texto</label>
                                                        <select name="texto_fonte" id="texto_fonte">
                                                            <option value="">---</option>
                                                            <?
                                                            $qSqlItem = mysql_query("SELECT * FROM sysfonte ORDER BY nome");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                            ?>
                                                            <option value="<?= $rSqlItem['id'] ?>" <? if($row_config['texto_fonte']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Tamanho do texto</label>
                                                        <select name="texto_px" id="texto_px" style="width:80px;">
                                                            <option value="">---</option>
                                                            <? for ($i = 10; $i <= 40; $i++) { ?>
                                                            <option value="<?=$i?>px" <? if($row_config['texto_px']=="".$i."px") { echo "selected"; } ?>><?=$i?>px</option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do texto</label>
                                                        <input value="<?=$row_config['texto_cor']?>" style="width:70px;" type="text" name="texto_cor" id="texto_cor" />
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</span>
                                                </div>

                                                <div style="float:left;width:90%;margin-left:20px;"><h4>Rodapé</h4></div>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor da fonte do rodapé</label>
                                                        <input value="<?=$row_config['rodape_cor_fonte']?>" style="width:70px;" type="text" name="rodape_cor_fonte" id="rodape_cor_fonte" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do fundo do rodapé</label>
                                                        <input value="<?=$row_config['rodape_cor_fundo']?>" style="width:70px;" type="text" name="rodape_cor_fundo" id="rodape_cor_fundo" />
                                                    </div>
                                                </div>

                                                <div style="float:left;width:90%;margin-left:20px;"><h4>Copyright</h4></div>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor da fonte do copyright</label>
                                                        <input value="<?=$row_config['copy_cor_fonte']?>" style="width:70px;" type="text" name="copy_cor_fonte" id="copy_cor_fonte" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Cor do fundo do copyright</label>
                                                        <input value="<?=$row_config['copy_cor_fundo']?>" style="width:70px;" type="text" name="copy_cor_fundo" id="copy_cor_fundo" />
                                                    </div>
                                                </div>


                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                    </div>
                                    <? } else { $aba3 = 0; } ?>

                                    <? if(trim($sysperm['imagens_'.$mod.''])==1) { $aba4 = 1; ?>
                                    <div id="tb1_c" class="tab-pane  <? if(trim($_REQUEST['var3'])=="imagens"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="imagens" />

                                                <div class="formSep">
                                                    <label>Logo do Site</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                        <? if(trim($row_config['logotipo'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$mod?>/<?=$row_config['logotipo']?>"><img id="arquivo-atual-logotipo" src="<?=$link?>files/<?=$mod?>/<?=$row_config['logotipo']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['logotipo'])=="") { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span class="fileupload-new">Selecionar arquivo</span>
                                                            <span class="fileupload-exists">Alterar</span>
                                                            <input name="logotipo" type="file">
                                                        </span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                        <? } else { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span>Alterar</span>
                                                            <input name="logotipo" type="file">
                                                        </span>
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>','logotipo');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                        <span class="help-block">Aparecerá em todas as páginas do site e na tela de login do administrativo</span>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <label>Ícone da Página (favicon)</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                        <? if(trim($row_config['favicon'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$mod?>/<?=$row_config['favicon']?>"><img id="arquivo-atual-favicon" src="<?=$link?>files/<?=$mod?>/<?=$row_config['favicon']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['favicon'])=="") { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span class="fileupload-new">Selecionar arquivo</span>
                                                            <span class="fileupload-exists">Alterar</span>
                                                            <input name="favicon" type="file">
                                                        </span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                        <? } else { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span>Alterar</span>
                                                            <input name="favicon" type="file">
                                                        </span>
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>','favicon');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                        <span class="help-block">Aparecerá na aba do navegador quando o site for acessado</span>
                                                    </div>
                                                </div>

                                                <!--
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                        <label>Habilitar banner flutuante ?</label>
                                                        <input type="checkbox" name="banner" id="banner" <? if(trim($row_config['banner'])==1) { echo " checked"; } ?> class="banner {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                        <span class="help-block">A imagem adicionada abaixo, aparecerá na página inicial do site</span>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <label>Ímagem banner flutuante</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                        <? if(trim($row_config['banner_imagem'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$mod?>/<?=$row_config['banner_imagem']?>"><img id="arquivo-atual-banner_imagem" src="<?=$link?>files/<?=$mod?>/<?=$row_config['banner_imagem']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['banner_imagem'])=="") { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span class="fileupload-new">Selecionar arquivo</span>
                                                            <span class="fileupload-exists">Alterar</span>
                                                            <input name="banner_imagem" type="file">
                                                        </span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                        <? } else { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span>Alterar</span>
                                                            <input name="banner_imagem" type="file">
                                                        </span>
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>','banner_imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                        <span class="help-block">A imagem não deve exceder 500px de altura e 800px de largura</span>
                                                    </div>
                                                </div>
                                                -->

                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba4 = 0; } ?>

                                    <? if(trim($sysperm['mensagens_'.$mod.''])==1) { $aba5 = 1; ?>
                                    <div id="tb1_d" class="tab-pane  <? if(trim($_REQUEST['var3'])=="mensagens"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="mensagens" />

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Encaminhar mensagens do site para o e-mail</label>
                                                        <input value="<?=$row_config['email']?>" style="width:350px;" type="text" name="email" id="email" />
                                                    </div>
                                                </div>

                                                <!--
                                                <div class="formSep">
                                                    <label class="req">Texto a ser inserido no e-mail a ser encaminhado</label>
                                                    <textarea name="email_texto" id="email_texto" class="span12" style="height:150px;"><?=$row_config['email_texto']?></textarea>
                                                </div>
                                                -->

                                                <div class="formSep">
                                                    <label>Ímagem do topo</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                        <? if(trim($row_config['email_imagem'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$mod?>/<?=$row_config['email_imagem']?>"><img id="arquivo-atual-email_imagem" src="<?=$link?>files/<?=$mod?>/<?=$row_config['email_imagem']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['email_imagem'])=="") { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span class="fileupload-new">Selecionar arquivo</span>
                                                            <span class="fileupload-exists">Alterar</span>
                                                            <input name="email_imagem" type="file">
                                                        </span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                        <? } else { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span>Alterar</span>
                                                            <input name="email_imagem" type="file">
                                                        </span>
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>','email_imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                        <span class="help-block">Aparecerá no topo dos e-mails que você receberá</span>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba5 = 0; } ?>

                                    <? if(trim($sysperm['seo_'.$mod.''])==1) { $aba6 = 1; ?>
                                    <div id="tb1_e" class="tab-pane  <? if(trim($_REQUEST['var3'])=="seo"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="seo" />

                                                <div class="formSep">
                                                    <label class="req">Título que aparece no Google</label>
                                                    <input value="<?=$row_config['nome_seo']?>" class="span12" type="text" name="nome_seo" id="nome_seo" />
                                                </div>

                                                <?
												if(trim($row_config['texto_seo'])=="") {  
													$tamanho_texto_seo = 150; 
												} else {
													$tamanho_texto_seo = 150 - strlen($row_config['texto_seo']); 
												}
												?>
                                                <div class="formSep">
                                                    <label>Texto (Meta-Description)</label>
                                                    <textarea name="texto_seo" id="texto_seo" onkeyup="contador_de_caractere('texto_seo','texto_seo_contador','150');" class="span12" style="height:150px;"><?=$row_config['texto_seo']?></textarea>
                                                    <div style="float:left;width:100%;">O Meta-Description esta limitado à 150 caracteres, <span style="color:#090;" id="texto_seo_contador"><?=$tamanho_texto_seo?></span> restantes.</div>
                                                </div>
    
                                                <?
												if(trim($row_config['texto_seo'])=="") {  
													$tamanho_texto_seo = 150; 
												} else {
													$tamanho_texto_seo = 150 - strlen($row_config['palavras_chave']); 
												}
												?>
                                                <div class="formSep">
                                                    <label>Palavras Chave</label>
                                                    <textarea name="palavras_chave" id="palavras_chave" onkeyup="contador_de_caractere('palavras_chave','palavras_chave_contador','150');" class="span12" style="height:150px;"><?=$row_config['palavras_chave']?></textarea>
                                                    <div style="float:left;width:100%;">As Palavras Chave estão limitadas à 150 caracteres, <span style="color:#090;" id="palavras_chave_contador"><?=$tamanho_texto_seo?></span> restantes.</div>
                                                </div>
    
                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba6 = 0; } ?>

                                    <? if(trim($sysperm['indexacao_'.$mod.''])==1) { $aba7 = 1; ?>
                                    <div id="tb1_f" class="tab-pane  <? if(trim($_REQUEST['var3'])=="indexacao"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="indexacao" />

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                        <label>Este site deve ser indexado pelos mecanismos de busca ?</label>
                                                        <input type="checkbox" name="busca" id="busca" <? if(trim($row_config['busca'])==1) { echo " checked"; } ?> class="busca {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                        <span class="help-block">Cabe aos mecanismos de busca atender seu pedido</span>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba7 = 0; } ?>

                                    <? if(trim($sysperm['analytics_'.$mod.''])==1) { $aba8 = 1; ?>
                                    <div id="tb1_g" class="tab-pane  <? if(trim($_REQUEST['var3'])=="google-analytics"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="google-analytics" />

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Google Analytics ID (Tracking ID)</label>
                                                        <input value="<?=$row_config['id_google']?>" style="width:350px;" type="text" name="id_google" id="id_google" />
                                                        <span class="help-block">O ID será algo como segue o exemplo: UA-58204629-1</span>
                                                    </div>
                                                </div>


                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba8 = 0; } ?>

                                    <? if(trim($sysperm['erro404_'.$mod.''])==1) { $aba9 = 1; ?>
                                    <div id="tb1_h" class="tab-pane  <? if(trim($_REQUEST['var3'])=="pagina-de-erro404"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0&&$aba8==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="pagina-de-erro404" />

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Título da página</label>
                                                        <input value="<?=$row_config['erro404_titulo']?>" style="width:350px;" type="text" name="erro404_titulo" id="erro404_titulo" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <label class="req">Texto</label>
                                                    <textarea name="erro404_msg" id="erro404_msg" class="span12" style="height:150px;"><?=$row_config['erro404_msg']?></textarea>
                                                </div>

                                                <div class="formSep">
                                                    <label>Ímagem do Cabeçalho</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                        <? if(trim($row_config['erro404_imagem'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$mod?>/<?=$row_config['erro404_imagem']?>"><img id="arquivo-atual-erro404_imagem" src="<?=$link?>files/<?=$mod?>/<?=$row_config['erro404_imagem']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['erro404_imagem'])=="") { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span class="fileupload-new">Selecionar arquivo</span>
                                                            <span class="fileupload-exists">Alterar</span>
                                                            <input name="erro404_imagem" type="file">
                                                        </span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                        <? } else { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span>Alterar</span>
                                                            <input name="erro404_imagem" type="file">
                                                        </span>
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>','erro404_imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba9 = 0; } ?>

                                    <? if(trim($sysperm['instalacao_'.$mod.''])==1) { $aba10 = 1; ?>
                                    <div id="tb1_instalacao" class="tab-pane  <? if(trim($_REQUEST['var3'])=="instalacao"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0&&$aba8==0&&$aba9==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms_instalacao">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="instalacao" />

												<? 
                                                $numeroUnicoGerado = geraCodContReturn(10); 
                                                ?>
                                                <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=strtoupper($numeroUnicoGerado)?>">

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Escolha a categoria onde deve ser instalado</label>
                                                        <select name="idsysmod_categoria" id="idsysmod_categoria">
                                                            <option value="">---</option>
                                                            <?
                                                            $qSqlItem = mysql_query("SELECT * FROM sysmod_categoria ORDER BY ordem");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                            ?>
                                                            <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                            <? } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <label class="req">Ordem</label>
                                                    <select name="ordem" id="idordem" style="width:70px;">
                                                        <?
                                                        $nordem = mysql_num_rows(mysql_query("SELECT * FROM sysmod"));
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
                                                        <input value="" style="width:350px;" type="text" name="nome" id="nome" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <label>Ícone</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="imagem" type="file"></span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Selecione o módulo que deseja instalar</label>
                                                        <select name="modulo_install" id="modulo_install" style="width:255px;">
                                                            <option value="">---</option>
                                                            <option value="agenda">Agenda</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba10 = 0; } ?>

                                    <? if(trim($sysperm['dominios_'.$mod.''])==1) { $aba11 = 1; ?>
                                    <div id="tb1_i" class="tab-pane  <? if(trim($_REQUEST['var3'])=="dominio"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0&&$aba8==0&&$aba9==0&&$aba10==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="dominio" />

                                                <div class="formSep">
                                                    <label class="req">Domínio do site</label>
                                                    <input value="<?=$row_config['url_site']?>" class="span7" type="text" name="url_site" id="url_site" />
                                                    <span class="help-block">http://www.dominio.com.br/</span>
                                                </div>

                                                <div class="formSep">
                                                    <label class="req">Domínio do administrativo</label>
                                                    <input value="<?=$row_config['url_admin']?>" class="span7" type="text" name="url_admin" id="url_admin" />
                                                    <span class="help-block">http://www.dominio.com.br/admin/</span>
                                                </div>

                                                <div style="float:left;width:100%;" id="redes_cliente_editar">

                                                <div class="formSep">
                                                    <div class="span3">
                                                        <label class="req">Nome</label>
                                                        <input value="" class="span12" type="text" id="nome_item" placeholder="Digite o nome da rede" />
                                                    </div>
                                                    <div class="span3" >
                                                        <label class="req">Link do Site</label>
                                                        <input value="" class="span12" type="text" id="link_site_item" placeholder="Digite ou cole aqui o link da rede" />
                                                    </div>
                                                    <div class="span3" >
                                                        <label class="req">Link do Admin</label>
                                                        <input value="" class="span12" type="text" id="link_admin_item" placeholder="Digite ou cole aqui o link da rede" />
                                                    </div>
                                                    <div class="span2" >
                                                        <button type="button" onclick="salvar_lista_links();" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                    </div>
                                                </div>
                                                
                                                <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                    <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de links</div>
                                                    <div id="lista_sysconfig_links_itens" style="width:100%;float:left;">
                                                        <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/sysconfig/lista_links.php"); ?>
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
                                    <? } else { $aba11 = 0; } ?>

                                    <? if(trim($sysperm['servidor_'.$mod.''])==1) { $aba12 = 1; ?>
                                    <div id="tb1_j" class="tab-pane  <? if(trim($_REQUEST['var3'])=="servidor"||(trim($_REQUEST['var3'])==""&&$aba1==0&&$aba2==0&&$aba3==0&&$aba4==0&&$aba5==0&&$aba6==0&&$aba7==0&&$aba8==0&&$aba9==0&&$aba10==0&&$aba11==0)) { ?>active<? } ?>">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="servidor" />

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Host FTP</label>
                                                        <input value="<?=$row_config['ftp_host']?>" style="width:350px;" type="text" name="ftp_host" id="ftp_host" />
                                                        <span class="help-block">ftp.dominio.com.br</span>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Usuário FTP</label>
                                                        <input value="<?=$row_config['ftp_user']?>" style="width:350px;" type="text" name="ftp_user" id="ftp_user" />
                                                        <span class="help-block">nome_do_usuario</span>
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Senha FTP</label>
                                                        <input value="<?=$row_config['ftp_pass']?>" style="width:350px;" type="text" name="ftp_pass" id="ftp_pass" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Raiz do FTP</label>
                                                        <input value="<?=$row_config['ftp_root']?>" style="width:350px;" type="text" name="ftp_root" id="ftp_root" />
                                                        <span class="help-block">ftp.dominio.com.br</span>
                                                    </div>
                                                </div>


                                                <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } else { $aba12 = 0; } ?>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>
