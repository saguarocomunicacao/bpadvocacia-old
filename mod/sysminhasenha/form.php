        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
                            <ul id="pageNav">
								<? if(trim($sysperm['dados_sysusu'])==1) { ?><li><a href="<?=$link?>minha-conta/meus-dados/">Meus dados</a></li><? } ?>
                                <? if(trim($sysperm['senha_sysusu'])==1) { ?><li class="current"><a href="<?=$link?>minha-conta/alterar-senha-de-acesso/">Alterar senha de acesso</a></li><? } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#tb1_a">Editar minha senha</a></li>
                                            </ul>
								<script>
                                $(document).ready(function() {
                                    //* form validation
                                    forms.simple();
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
                                                    senha: { required: true },
                                                    senhanova: { required: true },
                                                    senhaconf: {  equalTo: "#senhanova" },
                                                },
                                                invalidHandler: function(form, validator) {
                                                    // callback
                                                }
                                            })
                                        }
                                    }
                                };

                                </script>
                                            <div class="tab-content">
                                                <div id="tb1_a" class="tab-pane active">
                                                    <div>
                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                            <input type="hidden" name="acaoLocal" value="interno" />
                                            <input type="hidden" name="acaoForm" value="editar" />
                                            <input type="hidden" name="modulo" value="sysminhasenha" />
                                            <input type="hidden" name="iditem" value="<?=$sysusu['id']?>" />

											<? 
											$numeroUnicoGerado = $row['numeroUnico']; 
                                            ?>
                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                                            <div class="formSep">

												<? if($_REQUEST['var2']=="sucesso") { ?>
                                                <div class="alert alert-success" style="margin-bottom:10px;">
                                                    <a data-dismiss="alert" class="close">×</a>
                                                    <strong>Sucesso!</strong> Sua senha foi alterada com êxito.
                                                </div>
                                                <? } else { ?>
                                                <? if($_REQUEST['var2']=="erro") { ?>
                                                <div class="alert alert-error" style="margin-bottom:10px;">
                                                    <a data-dismiss="alert" class="close">×</a>
                                                    <strong>Erro !</strong> A senha informada no campo "Senha atual" não foi informada corretamente, tente novamente.
                                                </div>
                                                <? } ?>
                                                <? } ?>

                                                <div style="float:left;margin-right:10px;">
                                                    <div style="float:left;width:100%;">
                                                        <label class="req">Senha atual</label>
                                                        <input value="" style="width:150px;" type="password" name="senha" id="senha" />
                                                    </div>
                                                    <div style="float:left;width:100%;">
                                                        <label class="req">Nova senha</label>
                                                        <input value="" style="width:150px;" type="password" name="senhanova" id="senhanova" />
                                                    </div>
                                                    <div style="float:left;width:100%;">
                                                        <label class="req">Confirme a nova senha</label>
                                                        <input value="" style="width:150px;" type="password" name="senhaconf" id="senhaconf" />
                                                    </div>
                                                </div>
                                                <div style="float:left;margin-right:10px;">
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
