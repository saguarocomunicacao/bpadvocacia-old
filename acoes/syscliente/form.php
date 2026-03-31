<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
?>
									<? $numeroUnicoGerado = geraCodReturn(); ?>
                                    <input type="hidden" id="numeroUnico_pop_syscliente" value="<?=$numeroUnicoGerado?>">

                                    <!--
                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label>Escolha a categoria</label>
                                            <select id="idsyscliente_categoria_pop_syscliente">
                                                <option value="">---</option>
                                                <?
                                                $qSqlItem = mysql_query("SELECT * FROM syscliente_categoria WHERE stat='1' ORDER BY ordem");
                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                ?>
                                                <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>
                                    -->
    
                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Nome</label>
                                            <input value="" style="width:350px;" type="text" id="nome_pop_syscliente" />
                                        </div>
                                    </div>

                                    <!--
                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;width:350px;">
                                            <label class="req">E-mail principal</label>
                                            <input value="" style="width:300px;" type="text" id="email_pop_syscliente" />
                                            <span class="help-block">Este e-mail será utilizado para o cliente acessar o painel de controle e também para toda comunicação que for feita através do sistema</span>
                                        </div>
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Senha</label>
                                            <input value="" style="width:150px;" type="text" id="senha_pop_syscliente" />
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;width:250px;">
                                            <label class="req">Como conheceu a nossa empresa ?</label>
                                            <select id="como_conheceu_pop_syscliente" style="width:230px;" onchange="como_conheceu_set('_pop_syscliente');">
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
                                            <input  style="width:150px;margin-top:25px;display:none;" value="" id="como_conheceu_outro_pop_syscliente" type="text">
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Operadora</label>
                                            <select id="telefone_1_operadora_pop_syscliente" style="width:130px;">
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
                                            <input style="float:left;margin-right:10px;width:50px;" value="" id="telefone_1_ddd_pop_syscliente" type="text">
                                            <input style="float:left;width:200px;" value="" id="telefone_1_pop_syscliente" type="text">
                                        </div>
                                    </div>
                                    -->

                                    <div class="formSep">
                                        <button type="button" onclick="salvar_cliente_ajax('<?=$_REQUEST['sufixoS']?>','<?=$_REQUEST['idsysusuS']?>');" class="btn btn-success">Salvar</button>
                                        <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Cancelar</button>
                                    </div>
