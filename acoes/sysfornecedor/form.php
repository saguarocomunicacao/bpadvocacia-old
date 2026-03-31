<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
?>
									<? $numeroUnicoGerado = geraCodReturn(); ?>
                                    <input type="hidden" id="numeroUnico_pop_sysfornecedor" value="<?=$numeroUnicoGerado?>">

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Nome</label>
                                            <input value="" style="width:350px;" type="text" id="nome_pop_sysfornecedor" />
                                        </div>
                                    </div>

                                    <!--
                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;width:350px;">
                                            <label class="req">E-mail principal</label>
                                            <input value="" style="width:300px;" type="text" id="email_pop_sysfornecedor" />
                                            <span class="help-block">Este e-mail será utilizado para o fornecedor acessar o painel de controle e também para toda comunicação que for feita através do sistema</span>
                                        </div>
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Senha</label>
                                            <input value="" style="width:150px;" type="text" id="senha_pop_sysfornecedor" />
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;width:250px;">
                                            <label class="req">Como conheceu a nossa empresa ?</label>
                                            <select id="como_conheceu_pop_sysfornecedor" style="width:230px;" onchange="como_conheceu_set('_pop_sysfornecedor');">
                                                <option value="">---</option>
                                                <option value="Google">Google</option>
                                                <option value="Outros buscadores">Outros buscadores</option>
                                                <option value="Revistas">Revistas</option>
                                                <option value="Indicações">Indicações</option>
                                                <option value="Parceiros">Parceiros</option>
                                                <option value="Mídia Online">Mídia Online</option>
                                                <option value="Cliente">Cliente</option>
                                                <option value="Eventos">Eventos</option>
                                                <option value="Redes Sociais">Redes Sociais</option>
                                                <option value="Rádio">Rádio</option>
                                                <option value="Outros">Outros</option>
                                            </select>
                                        </div>
                                        <div style="float:left;margin-right:10px;width:150px;">
                                            <input  style="width:150px;margin-top:25px;display:none;" value="" id="como_conheceu_outro_pop_sysfornecedor" type="text">
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Operadora</label>
                                            <select id="telefone_1_operadora_pop_sysfornecedor" style="width:130px;">
                                                <option value="">---</option>
                                                <option value="Oi">Oi</option>
                                                <option value="TIM">TIM</option>
                                                <option value="Vivo">Vivo</option>
                                                <option value="Nextel">Nextel</option>
                                                <option value="Outra">Outra</option>
                                            </select>
                                        </div>
                                        <div style="float:left;margin-right:10px;">
                                            <label>Telefone</label>
                                            <input style="float:left;margin-right:10px;width:50px;" value="" id="telefone_1_ddd_pop_sysfornecedor" type="text">
                                            <input style="float:left;width:200px;" value="" id="telefone_1_pop_sysfornecedor" type="text">
                                        </div>
                                    </div>
                                    -->

                                    <div class="formSep">
                                        <button type="button" onclick="salvar_fornecedor_ajax('<?=$_REQUEST['sufixoS']?>');" class="btn btn-success">Salvar</button>
                                        <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Cancelar</button>
                                    </div>
