        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
                            <ul id="pageNav">
								<? if(trim($sysperm['dados_sysusu'])==1) { ?><li class="current"><a href="<?=$link?>minha-conta/meus-dados/">Meus dados</a></li><? } ?>
                                <? if(trim($sysperm['senha_sysusu'])==1) { ?><li><a href="<?=$link?>minha-conta/alterar-senha-de-acesso/">Alterar senha de acesso</a></li><? } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#tb1_a">Editar meus dados</a></li>
                                            </ul>
											<script>
                                            $(document).ready(function() {
                                                //* form validation
                                                forms.simple();
            
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
            
                                            //* masked inputs
                                            beoro_maskedInputs = {
                                                init: function() {
                                                    $("#cep").inputmask('99999-999');
                                                }
                                            };
                                            </script>
                                            <div class="tab-content">
                                                <div id="tb1_a" class="tab-pane active">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="editar" />
                                                            <input type="hidden" name="modulo" value="sysmeucad" />
                                                            <input type="hidden" name="iditem" value="<?=$sysusu['id']?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = $row['numeroUnico']; 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Nome</label>
                                                                    <input value="<?=$row['nome']?>" style="width:350px;" type="text" name="nome" id="nome" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label>Como prefere ser chamado</label>
                                                                    <input value="<?=$row['apelido']?>" style="width:250px;" type="text" name="apelido" id="apelido" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">E-mail de acesso</label>
                                                                    <input value="<?=$row['email']?>" style="width:350px;" type="text" name="email" id="email" />
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
                                                                <button type="submit" class="btn btn-success">Salvar</button>
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
