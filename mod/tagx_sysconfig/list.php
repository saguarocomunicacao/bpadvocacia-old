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
									<? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_editar">Configurações</a></li><? } ?>
                                </ul>
                                <script>
                                  $(document).ready(function() {

                                    //* form validation
                                    forms.simple();

                                    //* switch buttons
                                    beoro_switchButtons.init();

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
                                </script>
                                <div class="tab-content">
                                    <? $row_config = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." ORDER BY data LIMIT 1")); ?>
                                    <div id="tb1_a" class="tab-pane active">
                                        <div>

                                                <div class="tabbable tabs-left tabbable-bordered">
                                                    <ul class="nav nav-tabs">
                                                        <li <? if(trim($_REQUEST['var3'])=="site"||trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_site">Site</a></li>
                                                        <li <? if(trim($_REQUEST['var3'])=="imagens") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_imagens">Imagens</a></li>
                                                        <li <? if(trim($_REQUEST['var3'])=="mensagens") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_mensagens">Mensagens</a></li>
                                                        <li <? if(trim($_REQUEST['var3'])=="seo") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_seo">SEO</a></li>
                                                        <li <? if(trim($_REQUEST['var3'])=="indexacao") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_indexacao">Indexação</a></li>
                                                        <li <? if(trim($_REQUEST['var3'])=="analytics") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_analytics">Analytics</a></li>
                                                        <li <? if(trim($_REQUEST['var3'])=="pagina-de-erro404") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_erro404">ERRO 404</a></li>
                                                        <li <? if(trim($_REQUEST['var3'])=="dominio") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_dominio">Domínios</a></li>
                                                        <li <? if(trim($_REQUEST['var3'])=="servidor") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_servidor">Servidor</a></li>
                                                    </ul>
                                                    <div class="tab-content">

                                                        <div id="tb3_site" class="tab-pane <? if(trim($_REQUEST['var3'])=="site"||trim($_REQUEST['var3'])=="") { ?>active<? } ?>" style="min-height:350px;">

                                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                <input type="hidden" name="acaoForm" value="site" />
                
                                                                <div class="formSep">
                                                                    <div style="float:left;margin-right:10px;">
                                                                        <label class="req">Nome do site</label>
                                                                        <input value="<?=$row_config['nome']?>" style="width:350px;" type="text" name="nome" id="nome" />
                                                                        <span class="help-block">Recomendamos colocar o nome completo da sua empresa</span>
                                                                    </div>
                                                                </div>
                
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

                                                        <div id="tb3_imagens" class="tab-pane <? if(trim($_REQUEST['var3'])=="imagens") { ?>active<? } ?>" style="min-height:350px;">

                                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
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
                
                                                                <div class="formSep">
                                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                                </div>
                                                            </form>

                                                        </div>

                                                        <div id="tb3_mensagens" class="tab-pane <? if(trim($_REQUEST['var3'])=="mensagens") { ?>active<? } ?>" style="min-height:350px;">

                                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                <input type="hidden" name="acaoForm" value="mensagens" />
                
                                                                <div class="formSep">
                                                                    <div style="float:left;margin-right:10px;">
                                                                        <label class="req">Encaminhar mensagens do site para o e-mail</label>
                                                                        <input value="<?=$row_config['email']?>" style="width:350px;" type="text" name="email" id="email" />
                                                                    </div>
                                                                </div>
                
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

                                                        <div id="tb3_seo" class="tab-pane <? if(trim($_REQUEST['var3'])=="seo") { ?>active<? } ?>" style="min-height:350px;">

                                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                <input type="hidden" name="acaoForm" value="seo" />
                
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

                                                        <div id="tb3_indexacao" class="tab-pane <? if(trim($_REQUEST['var3'])=="indexacao") { ?>active<? } ?>" style="min-height:350px;">

                                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
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

                                                        <div id="tb3_analytics" class="tab-pane <? if(trim($_REQUEST['var3'])=="google-analytics") { ?>active<? } ?>" style="min-height:350px;">

                                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
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

                                                        <div id="tb3_erro404" class="tab-pane <? if(trim($_REQUEST['var3'])=="pagina-de-erro404") { ?>active<? } ?>" style="min-height:350px;">

                                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
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

                                                        <div id="tb3_dominio" class="tab-pane <? if(trim($_REQUEST['var3'])=="dominio") { ?>active<? } ?>" style="min-height:350px;">
                
                                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
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
                
                                                                <div class="formSep">
                                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                                </div>
                                                            </form>

                                                        </div>

                                                        <div id="tb3_servidor" class="tab-pane  <? if(trim($_REQUEST['var3'])=="servidor") { ?>active<? } ?>" style="min-height:350px;">
                
                                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
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
</div>
