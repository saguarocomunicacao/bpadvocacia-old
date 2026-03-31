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
                                    <? if(trim($sysperm['descricao_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_a">Descrição</a></li><? } ?>
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
                                
                                //* datatables
                                beoro_datatables = {
                                    //* column reorder & toggle visibility
                                    basic: function() {
                                        if($('#dt_basic').length) {
                                            $('#dt_basic').dataTable({
                                                "sPaginationType": "bootstrap_full"
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
                                                toolbar: 'Standard'
                                            });
                                        }
                                        if($('#chamada_descricao').length) { 
                                            CKEDITOR.replace( 'chamada_descricao', {
                                                toolbar: 'Standard'
                                            });
                                        }
                                        if($('#texto_descricao').length) { 
                                            CKEDITOR.replace( 'texto_descricao', {
                                                toolbar: 'Standard'
                                            });
                                        }
                                    }
                                };

                                //* switch buttons
                                beoro_switchButtons = {
                                    init: function() {
                                        if($('#destaque').length) { $("#destaque").iButton(); }
                                        if($('#url_amigavel_ativa').length) { $("#url_amigavel_ativa").iButton(); }
                                    }
                                };
                                </script>
                                <div class="tab-content">
                                    <div id="tb1_a" class="tab-pane active">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="config" />
    
												<? 
												if(trim($row_config['numeroUnico'])=="") {
													$numeroUnicoGerado = geraCodReturn(); 
												} else {
													$numeroUnicoGerado = $row_config['numeroUnico']; 
												}
                                                ?>
                                                <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Título do Box 1</label>
                                                        <input value="<?=$row_config['titulo_box_1']?>" style="width:350px;" type="text" name="titulo_box_1" id="titulo_box_1" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Tipo do Box 1</label>
                                                        <select name="tipo_box_1" id="tipo_box_1" onchange="seleciona_tipo_rodape('box_1')" style="width:350px;">
                                                            <option value=''>---</option>
                                                            <option value='contato' <? if($row_config['tipo_box_1']=="contato") { echo "selected"; } ?>>apenas informações de contato</option>
                                                            <option value='redes' <? if($row_config['tipo_box_1']=="redes") { echo "selected"; } ?>>apenas lista de redes sociais</option>
                                                            <option value='contato-redes' <? if($row_config['tipo_box_1']=="contato-redes") { echo "selected"; } ?>>informações de contato e lista de redes sociais</option>
                                                            <option value='texto' <? if($row_config['tipo_box_1']=="texto") { echo "selected"; } ?>>apenas texto</option>
                                                            <option value='imagem' <? if($row_config['tipo_box_1']=="imagem") { echo "selected"; } ?>>apenas imagem</option>
                                                            <option value='link' <? if($row_config['tipo_box_1']=="link") { echo "selected"; } ?>>apenas link</option>
                                                            <option value='texto-imagem' <? if($row_config['tipo_box_1']=="texto-imagem") { echo "selected"; } ?>>texto e imagem</option>
                                                            <option value='texto-link' <? if($row_config['tipo_box_1']=="texto-link") { echo "selected"; } ?>>texto e link</option>
                                                            <option value='texto-imagem-link' <? if($row_config['tipo_box_1']=="texto-imagem-link") { echo "selected"; } ?>>texto,imagem e link</option>
                                                            <option value='imagem-link' <? if($row_config['tipo_box_1']=="imagem-link") { echo "selected"; } ?>>imagem e link</option>
                                                            <option value='modulo' <? if($row_config['tipo_box_1']=="modulo") { echo "selected"; } ?>>módulo do sistema</option>
                                                            <option value='rede_social' <? if($row_config['tipo_box_1']=="rede_social") { echo "selected"; } ?>>rede social</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep" id="texto_box_1_div" style="display:<? if($row_config['tipo_box_1']=="texto-imagem"||$row_config['tipo_box_1']=="texto-imagem-link"||$row_config['tipo_box_1']=="texto-link"||$row_config['tipo_box_1']=="texto") { echo "block"; } else { echo "none"; } ?>;">
                                                    <label>Texto do Box 1</label>
                                                    <textarea name="texto_box_1" id="texto_box_1" class="span12" style="height:150px;"><?=$row_config['texto_box_1']?></textarea>
                                                    <span class="help-block" style="width:100%;float:left;margin-top:10px;"></span>
                                                </div>

                                                <div class="formSep" id="imagem_box_1_div" style="display:<? if($row_config['tipo_box_1']=="texto-imagem"||$row_config['tipo_box_1']=="texto-imagem-link"||$row_config['tipo_box_1']=="imagem-link"||$row_config['tipo_box_1']=="imagem") { echo "block"; } else { echo "none"; } ?>;">
                                                    <label>Imagem Box 1</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail">
                                                        <? if(trim($row_config['imagem_box_1'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_box_1']?>"><img style="width:50px;" id="arquivo-atual-imagem" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_box_1']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['imagem_box_1'])=="") { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span class="fileupload-new">Selecionar arquivo</span>
                                                            <span class="fileupload-exists">Alterar</span>
                                                            <input name="imagem_box_1" type="file">
                                                        </span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                        <? } else { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span>Alterar</span>
                                                            <input name="imagem_box_1" type="file">
                                                        </span>
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>_config','imagem_box_1');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">Aqui devem ser passadas as informações de padrão de largura e altura da imagem</span>
                                                </div>

                                                <div class="formSep" id="link_box_1_div" style="display:<? if($row_config['tipo_box_1']=="texto-link"||$row_config['tipo_box_1']=="texto-imagem-link"||$row_config['tipo_box_1']=="imagem-link"||$row_config['tipo_box_1']=="link") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Link do Box 1</label>
                                                        <input value="<?=$row_config['link_box_1']?>" style="width:350px;" type="text" name="link_box_1" id="link_box_1" />
                                                    </div>
                                                </div>

                                                <div class="formSep" id="modulo_box_1_div" style="display:<? if($row_config['tipo_box_1']=="modulo") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Módulo do Box 1</label>
                                                        <select name="modulo_box_1" id="modulo_box_1" style="width:130px;">
                                                            <option value=''>---</option>

															<?
                                                            $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE rodape='1' AND idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."' ORDER BY ordem");
                                                            while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                            ?>
                                                            <option value='<?=$rSqlMod['bd']?>' <? if($row_config['modulo_box_1']==$rSqlMod['bd']) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                            <? } ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep" id="rede_social_box_1_div" style="display:<? if($row_config['tipo_box_1']=="rede_social") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Rede Social Box 1</label>
                                                        <select name="rede_social_box_1_tipo" id="rede_social_box_1_tipo" style="width:130px;">
                                                            <option value=''>---</option>
                                                            <option value='facebook' <? if($row_config['rede_social_box_1_tipo']=="facebook") { echo "selected"; } ?>>facebook</option>
                                                            <option value='twitter' <? if($row_config['rede_social_box_1_tipo']=="twitter") { echo "selected"; } ?>>twitter</option>
                                                            <option value='instagram' <? if($row_config['rede_social_box_1_tipo']=="instagram") { echo "selected"; } ?>>instagram</option>
                                                            <option value='pinterest' <? if($row_config['rede_social_box_1_tipo']=="pinterest") { echo "selected"; } ?>>pinterest</option>
                                                            <option value='tumblr' <? if($row_config['rede_social_box_1_tipo']=="tumblr") { echo "selected"; } ?>>tumblr</option>
                                                            <option value='flickr' <? if($row_config['rede_social_box_1_tipo']=="flickr") { echo "selected"; } ?>>flickr</option>
                                                        </select>
                                                    </div>
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Link Rede Social Box 1</label>
                                                        <input value="<?=$row_config['rede_social_box_1']?>" style="width:350px;" type="text" name="rede_social_box_1" id="rede_social_box_1" />
                                                    </div>
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">ID da API Rede Social Box 1</label>
                                                        <input value="<?=$row_config['rede_social_box_1_id']?>" style="width:350px;" type="text" name="rede_social_box_1_id" id="rede_social_box_1_id" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Título do Box 2</label>
                                                        <input value="<?=$row_config['titulo_box_2']?>" style="width:350px;" type="text" name="titulo_box_2" id="titulo_box_2" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Tipo do Box 2</label>
                                                        <select name="tipo_box_2" id="tipo_box_2" onchange="seleciona_tipo_rodape('box_2')" style="width:350px;">
                                                            <option value=''>---</option>
                                                            <option value='contato' <? if($row_config['tipo_box_2']=="contato") { echo "selected"; } ?>>apenas informações de contato</option>
                                                            <option value='redes' <? if($row_config['tipo_box_2']=="redes") { echo "selected"; } ?>>apenas lista de redes sociais</option>
                                                            <option value='contato-redes' <? if($row_config['tipo_box_2']=="contato-redes") { echo "selected"; } ?>>informações de contato e lista de redes sociais</option>
                                                            <option value='texto' <? if($row_config['tipo_box_2']=="texto") { echo "selected"; } ?>>apenas texto</option>
                                                            <option value='imagem' <? if($row_config['tipo_box_2']=="imagem") { echo "selected"; } ?>>apenas imagem</option>
                                                            <option value='link' <? if($row_config['tipo_box_2']=="link") { echo "selected"; } ?>>apenas link</option>
                                                            <option value='texto-imagem' <? if($row_config['tipo_box_2']=="texto-imagem") { echo "selected"; } ?>>texto e imagem</option>
                                                            <option value='texto-link' <? if($row_config['tipo_box_2']=="texto-link") { echo "selected"; } ?>>texto e link</option>
                                                            <option value='texto-imagem-link' <? if($row_config['tipo_box_2']=="texto-imagem-link") { echo "selected"; } ?>>texto,imagem e link</option>
                                                            <option value='imagem-link' <? if($row_config['tipo_box_2']=="imagem-link") { echo "selected"; } ?>>imagem e link</option>
                                                            <option value='modulo' <? if($row_config['tipo_box_2']=="modulo") { echo "selected"; } ?>>módulo do sistema</option>
                                                            <option value='rede_social' <? if($row_config['tipo_box_2']=="rede_social") { echo "selected"; } ?>>rede social</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep" id="texto_box_2_div" style="display:<? if($row_config['tipo_box_2']=="texto-imagem"||$row_config['tipo_box_2']=="texto-imagem-link"||$row_config['tipo_box_2']=="texto-link"||$row_config['tipo_box_2']=="texto") { echo "block"; } else { echo "none"; } ?>;">
                                                    <label>Texto do Box 2</label>
                                                    <textarea name="texto_box_2" id="texto_box_2" class="span12" style="height:150px;"><?=$row_config['texto_box_2']?></textarea>
                                                    <span class="help-block" style="width:100%;float:left;margin-top:10px;"></span>
                                                </div>

                                                <div class="formSep" id="imagem_box_2_div" style="display:<? if($row_config['tipo_box_2']=="texto-imagem"||$row_config['tipo_box_2']=="texto-imagem-link"||$row_config['tipo_box_2']=="imagem-link"||$row_config['tipo_box_2']=="imagem") { echo "block"; } else { echo "none"; } ?>;">
                                                    <label>Imagem Box 2</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail">
                                                        <? if(trim($row_config['imagem_box_2'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_box_2']?>"><img style="width:50px;" id="arquivo-atual-imagem" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_box_2']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['imagem_box_2'])=="") { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span class="fileupload-new">Selecionar arquivo</span>
                                                            <span class="fileupload-exists">Alterar</span>
                                                            <input name="imagem_box_2" type="file">
                                                        </span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                        <? } else { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span>Alterar</span>
                                                            <input name="imagem_box_2" type="file">
                                                        </span>
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>_config','imagem_box_2');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">Aqui devem ser passadas as informações de padrão de largura e altura da imagem</span>
                                                </div>

                                                <div class="formSep" id="link_box_2_div" style="display:<? if($row_config['tipo_box_2']=="texto-link"||$row_config['tipo_box_2']=="texto-imagem-link"||$row_config['tipo_box_2']=="imagem-link"||$row_config['tipo_box_2']=="link") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Link do Box 2</label>
                                                        <input value="<?=$row_config['link_box_2']?>" style="width:350px;" type="text" name="link_box_2" id="link_box_2" />
                                                    </div>
                                                </div>

                                                <div class="formSep" id="modulo_box_2_div" style="display:<? if($row_config['tipo_box_2']=="modulo") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Módulo do Box 2</label>
                                                        <select name="modulo_box_2" id="modulo_box_2" style="width:130px;">
                                                            <option value=''>---</option>

															<?
                                                            $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE rodape='1' AND idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."' ORDER BY ordem");
                                                            while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                            ?>
                                                            <option value='<?=$rSqlMod['bd']?>' <? if($row_config['modulo_box_2']==$rSqlMod['bd']) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                            <? } ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep" id="rede_social_box_2_div" style="display:<? if($row_config['tipo_box_2']=="rede_social") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Rede Social Box 2</label>
                                                        <select name="rede_social_box_2_tipo" id="rede_social_box_2_tipo" style="width:130px;">
                                                            <option value=''>---</option>
                                                            <option value='facebook' <? if($row_config['rede_social_box_2_tipo']=="facebook") { echo "selected"; } ?>>facebook</option>
                                                            <option value='twitter' <? if($row_config['rede_social_box_2_tipo']=="twitter") { echo "selected"; } ?>>twitter</option>
                                                            <option value='instagram' <? if($row_config['rede_social_box_2_tipo']=="instagram") { echo "selected"; } ?>>instagram</option>
                                                            <option value='pinterest' <? if($row_config['rede_social_box_2_tipo']=="pinterest") { echo "selected"; } ?>>pinterest</option>
                                                            <option value='tumblr' <? if($row_config['rede_social_box_2_tipo']=="tumblr") { echo "selected"; } ?>>tumblr</option>
                                                            <option value='flickr' <? if($row_config['rede_social_box_2_tipo']=="flickr") { echo "selected"; } ?>>flickr</option>
                                                        </select>
                                                    </div>
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Link Rede Social Box 2</label>
                                                        <input value="<?=$row_config['rede_social_box_2']?>" style="width:350px;" type="text" name="rede_social_box_2" id="rede_social_box_2" />
                                                    </div>
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">ID da API Rede Social Box 2</label>
                                                        <input value="<?=$row_config['rede_social_box_2_id']?>" style="width:350px;" type="text" name="rede_social_box_2_id" id="rede_social_box_2_id" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Título do Box 3</label>
                                                        <input value="<?=$row_config['titulo_box_3']?>" style="width:350px;" type="text" name="titulo_box_3" id="titulo_box_3" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Tipo do Box 3</label>
                                                        <select name="tipo_box_3" id="tipo_box_3" onchange="seleciona_tipo_rodape('box_3')" style="width:350px;">
                                                            <option value=''>---</option>
                                                            <option value='contato' <? if($row_config['tipo_box_3']=="contato") { echo "selected"; } ?>>apenas informações de contato</option>
                                                            <option value='redes' <? if($row_config['tipo_box_3']=="redes") { echo "selected"; } ?>>apenas lista de redes sociais</option>
                                                            <option value='contato-redes' <? if($row_config['tipo_box_3']=="contato-redes") { echo "selected"; } ?>>informações de contato e lista de redes sociais</option>
                                                            <option value='texto' <? if($row_config['tipo_box_3']=="texto") { echo "selected"; } ?>>apenas texto</option>
                                                            <option value='imagem' <? if($row_config['tipo_box_3']=="imagem") { echo "selected"; } ?>>apenas imagem</option>
                                                            <option value='link' <? if($row_config['tipo_box_3']=="link") { echo "selected"; } ?>>apenas link</option>
                                                            <option value='texto-imagem' <? if($row_config['tipo_box_3']=="texto-imagem") { echo "selected"; } ?>>texto e imagem</option>
                                                            <option value='texto-link' <? if($row_config['tipo_box_3']=="texto-link") { echo "selected"; } ?>>texto e link</option>
                                                            <option value='texto-imagem-link' <? if($row_config['tipo_box_3']=="texto-imagem-link") { echo "selected"; } ?>>texto,imagem e link</option>
                                                            <option value='imagem-link' <? if($row_config['tipo_box_3']=="imagem-link") { echo "selected"; } ?>>imagem e link</option>
                                                            <option value='modulo' <? if($row_config['tipo_box_3']=="modulo") { echo "selected"; } ?>>módulo do sistema</option>
                                                            <option value='rede_social' <? if($row_config['tipo_box_3']=="rede_social") { echo "selected"; } ?>>rede social</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep" id="texto_box_3_div" style="display:<? if($row_config['tipo_box_3']=="texto-imagem"||$row_config['tipo_box_3']=="texto-imagem-link"||$row_config['tipo_box_3']=="texto-link"||$row_config['tipo_box_3']=="texto") { echo "block"; } else { echo "none"; } ?>;">
                                                    <label>Texto do Box 3</label>
                                                    <textarea name="texto_box_3" id="texto_box_3" class="span12" style="height:150px;"><?=$row_config['texto_box_3']?></textarea>
                                                    <span class="help-block" style="width:100%;float:left;margin-top:10px;"></span>
                                                </div>

                                                <div class="formSep" id="imagem_box_3_div" style="display:<? if($row_config['tipo_box_3']=="texto-imagem"||$row_config['tipo_box_3']=="texto-imagem-link"||$row_config['tipo_box_3']=="imagem-link"||$row_config['tipo_box_3']=="imagem") { echo "block"; } else { echo "none"; } ?>;">
                                                    <label>Imagem Box 3</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail">
                                                        <? if(trim($row_config['imagem_box_3'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_box_3']?>"><img style="width:50px;" id="arquivo-atual-imagem" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_box_3']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['imagem_box_3'])=="") { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span class="fileupload-new">Selecionar arquivo</span>
                                                            <span class="fileupload-exists">Alterar</span>
                                                            <input name="imagem_box_3" type="file">
                                                        </span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                        <? } else { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span>Alterar</span>
                                                            <input name="imagem_box_3" type="file">
                                                        </span>
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>_config','imagem_box_3');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">Aqui devem ser passadas as informações de padrão de largura e altura da imagem</span>
                                                </div>

                                                <div class="formSep" id="link_box_3_div" style="display:<? if($row_config['tipo_box_3']=="texto-link"||$row_config['tipo_box_3']=="texto-imagem-link"||$row_config['tipo_box_3']=="imagem-link"||$row_config['tipo_box_3']=="link") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Link do Box 3</label>
                                                        <input value="<?=$row_config['link_box_3']?>" style="width:350px;" type="text" name="link_box_3" id="link_box_3" />
                                                    </div>
                                                </div>

                                                <div class="formSep" id="modulo_box_3_div" style="display:<? if($row_config['tipo_box_3']=="modulo") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Módulo do Box 3</label>
                                                        <select name="modulo_box_3" id="modulo_box_3" style="width:130px;">
                                                            <option value=''>---</option>

															<?
                                                            $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE rodape='1' AND idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."' ORDER BY ordem");
                                                            while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                            ?>
                                                            <option value='<?=$rSqlMod['bd']?>' <? if($row_config['modulo_box_3']==$rSqlMod['bd']) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                            <? } ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep" id="rede_social_box_3_div" style="display:<? if($row_config['tipo_box_3']=="rede_social") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Rede Social Box 3</label>
                                                        <select name="rede_social_box_3_tipo" id="rede_social_box_3_tipo" style="width:130px;">
                                                            <option value=''>---</option>
                                                            <option value='facebook' <? if($row_config['rede_social_box_3_tipo']=="facebook") { echo "selected"; } ?>>facebook</option>
                                                            <option value='twitter' <? if($row_config['rede_social_box_3_tipo']=="twitter") { echo "selected"; } ?>>twitter</option>
                                                            <option value='instagram' <? if($row_config['rede_social_box_3_tipo']=="instagram") { echo "selected"; } ?>>instagram</option>
                                                            <option value='pinterest' <? if($row_config['rede_social_box_3_tipo']=="pinterest") { echo "selected"; } ?>>pinterest</option>
                                                            <option value='tumblr' <? if($row_config['rede_social_box_3_tipo']=="tumblr") { echo "selected"; } ?>>tumblr</option>
                                                            <option value='flickr' <? if($row_config['rede_social_box_3_tipo']=="flickr") { echo "selected"; } ?>>flickr</option>
                                                        </select>
                                                    </div>
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Link Rede Social Box 3</label>
                                                        <input value="<?=$row_config['rede_social_box_3']?>" style="width:350px;" type="text" name="rede_social_box_3" id="rede_social_box_3" />
                                                    </div>
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">ID da API Rede Social Box 3</label>
                                                        <input value="<?=$row_config['rede_social_box_3_id']?>" style="width:350px;" type="text" name="rede_social_box_3_id" id="rede_social_box_3_id" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Título do Box 4</label>
                                                        <input value="<?=$row_config['titulo_box_4']?>" style="width:350px;" type="text" name="titulo_box_4" id="titulo_box_4" />
                                                    </div>
                                                </div>

                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Tipo do Box 4</label>
                                                        <select name="tipo_box_4" id="tipo_box_4" onchange="seleciona_tipo_rodape('box_4')" style="width:350px;">
                                                            <option value=''>---</option>
                                                            <option value='contato' <? if($row_config['tipo_box_4']=="contato") { echo "selected"; } ?>>apenas informações de contato</option>
                                                            <option value='redes' <? if($row_config['tipo_box_4']=="redes") { echo "selected"; } ?>>apenas lista de redes sociais</option>
                                                            <option value='contato-redes' <? if($row_config['tipo_box_4']=="contato-redes") { echo "selected"; } ?>>informações de contato e lista de redes sociais</option>
                                                            <option value='texto' <? if($row_config['tipo_box_4']=="texto") { echo "selected"; } ?>>apenas texto</option>
                                                            <option value='imagem' <? if($row_config['tipo_box_4']=="imagem") { echo "selected"; } ?>>apenas imagem</option>
                                                            <option value='link' <? if($row_config['tipo_box_4']=="link") { echo "selected"; } ?>>apenas link</option>
                                                            <option value='texto-imagem' <? if($row_config['tipo_box_4']=="texto-imagem") { echo "selected"; } ?>>texto e imagem</option>
                                                            <option value='texto-link' <? if($row_config['tipo_box_4']=="texto-link") { echo "selected"; } ?>>texto e link</option>
                                                            <option value='texto-imagem-link' <? if($row_config['tipo_box_4']=="texto-imagem-link") { echo "selected"; } ?>>texto,imagem e link</option>
                                                            <option value='imagem-link' <? if($row_config['tipo_box_4']=="imagem-link") { echo "selected"; } ?>>imagem e link</option>
                                                            <option value='modulo' <? if($row_config['tipo_box_4']=="modulo") { echo "selected"; } ?>>módulo do sistema</option>
                                                            <option value='rede_social' <? if($row_config['tipo_box_4']=="rede_social") { echo "selected"; } ?>>rede social</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep" id="texto_box_4_div" style="display:<? if($row_config['tipo_box_4']=="texto-imagem"||$row_config['tipo_box_4']=="texto-imagem-link"||$row_config['tipo_box_4']=="texto-link"||$row_config['tipo_box_4']=="texto") { echo "block"; } else { echo "none"; } ?>;">
                                                    <label>Texto do Box 4</label>
                                                    <textarea name="texto_box_4" id="texto_box_4" class="span12" style="height:150px;"><?=$row_config['texto_box_4']?></textarea>
                                                    <span class="help-block" style="width:100%;float:left;margin-top:10px;"></span>
                                                </div>

                                                <div class="formSep" id="imagem_box_4_div" style="display:<? if($row_config['tipo_box_4']=="texto-imagem"||$row_config['tipo_box_4']=="texto-imagem-link"||$row_config['tipo_box_4']=="imagem-link"||$row_config['tipo_box_4']=="imagem") { echo "block"; } else { echo "none"; } ?>;">
                                                    <label>Imagem Box 4</label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail">
                                                        <? if(trim($row_config['imagem_box_4'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_box_4']?>"><img style="width:50px;" id="arquivo-atual-imagem" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_box_4']?>" alt=""></a>
                                                        <? } ?>
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                        <? if(trim($row_config['imagem_box_4'])=="") { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span class="fileupload-new">Selecionar arquivo</span>
                                                            <span class="fileupload-exists">Alterar</span>
                                                            <input name="imagem_box_4" type="file">
                                                        </span>
                                                        <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                        <? } else { ?>
                                                        <span class="btn btn-small btn-file">
                                                            <span>Alterar</span>
                                                            <input name="imagem_box_4" type="file">
                                                        </span>
                                                        <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>_config','imagem_box_4');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                        <? } ?>
                                                    </div>
                                                    <span class="help-block" style="width:100%;float:left;">Aqui devem ser passadas as informações de padrão de largura e altura da imagem</span>
                                                </div>

                                                <div class="formSep" id="link_box_4_div" style="display:<? if($row_config['tipo_box_4']=="texto-link"||$row_config['tipo_box_4']=="texto-imagem-link"||$row_config['tipo_box_4']=="imagem-link"||$row_config['tipo_box_4']=="link") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label>Link do Box 4</label>
                                                        <input value="<?=$row_config['link_box_4']?>" style="width:350px;" type="text" name="link_box_4" id="link_box_4" />
                                                    </div>
                                                </div>

                                                <div class="formSep" id="modulo_box_4_div" style="display:<? if($row_config['tipo_box_4']=="modulo") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Módulo do Box 4</label>
                                                        <select name="modulo_box_4" id="modulo_box_4" style="width:130px;">
                                                            <option value=''>---</option>

															<?
                                                            $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE rodape='1' AND idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."' ORDER BY ordem");
                                                            while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                            ?>
                                                            <option value='<?=$rSqlMod['bd']?>' <? if($row_config['modulo_box_4']==$rSqlMod['bd']) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                            <? } ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="formSep" id="rede_social_box_4_div" style="display:<? if($row_config['tipo_box_4']=="rede_social") { echo "block"; } else { echo "none"; } ?>;">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Rede Social Box 4</label>
                                                        <select name="rede_social_box_4_tipo" id="rede_social_box_4_tipo" style="width:130px;">
                                                            <option value=''>---</option>
                                                            <option value='facebook' <? if($row_config['rede_social_box_4_tipo']=="facebook") { echo "selected"; } ?>>facebook</option>
                                                            <option value='twitter' <? if($row_config['rede_social_box_4_tipo']=="twitter") { echo "selected"; } ?>>twitter</option>
                                                            <option value='instagram' <? if($row_config['rede_social_box_4_tipo']=="instagram") { echo "selected"; } ?>>instagram</option>
                                                            <option value='pinterest' <? if($row_config['rede_social_box_4_tipo']=="pinterest") { echo "selected"; } ?>>pinterest</option>
                                                            <option value='tumblr' <? if($row_config['rede_social_box_4_tipo']=="tumblr") { echo "selected"; } ?>>tumblr</option>
                                                            <option value='flickr' <? if($row_config['rede_social_box_4_tipo']=="flickr") { echo "selected"; } ?>>flickr</option>
                                                        </select>
                                                    </div>
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">Link Rede Social Box 4</label>
                                                        <input value="<?=$row_config['rede_social_box_4']?>" style="width:350px;" type="text" name="rede_social_box_4" id="rede_social_box_4" />
                                                    </div>
                                                    <div style="float:left;margin-right:10px;">
                                                        <label class="req">ID da API Rede Social Box 4</label>
                                                        <input value="<?=$row_config['rede_social_box_4_id']?>" style="width:350px;" type="text" name="rede_social_box_4_id" id="rede_social_box_4_id" />
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
