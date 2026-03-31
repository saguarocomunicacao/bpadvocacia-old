<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
?>
                                                            <?
															$mod = "syscliente";
															$row = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$_REQUEST['idS']."'"));
															$numeroUnicoGerado = $row['numeroUnico'];
															?>
                                                            <div class="tab-content">
                                                            <div class="tabbable tabs-left tabbable-bordered">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#tbview_a">Dados principais</a></li>
                                                                    <!--<li><a data-toggle="tab" href="#tbview_b">Dados de acesso</a></li>-->
                                                                    <li><a data-toggle="tab" href="#tbview_c">Dados complementares</a></li>
                                                                    <li><a data-toggle="tab" href="#tbview_d">Contatos</a></li>
                                                                    <li><a data-toggle="tab" href="#tbview_e">Endereço</a></li>
                                                                    <!--<li><a data-toggle="tab" href="#tbview_f">Redes Sociais</a></li>-->
                                                                    <li><a data-toggle="tab" href="#tbview_i">Dados bancários</a></li>
                                                                    <li><a data-toggle="tab" href="#tbview_g">Observações</a></li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div id="tbview_a" class="tab-pane active" style="min-height:350px;width:650px;">
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Categoria</label>
                                                                                <? $rSqlItem = mysql_fetch_array(mysql_query("SELECT * FROM syscliente_categoria WHERE id='".$row['id'.$mod.'_categoria']."'")); ?>
                                                                                <input value="<?=$rSqlItem['nome']?>" style="width:350px;" type="text" disabled="disabled"/>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <label class="req">Nome Completo</label>
                                                                            <input value="<?=$row['nome']?>" style="width:350px;" type="text" disabled="disabled" />
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;width:100%;">
                                                                                <label>Data de Cadastro</label>
                                                                                <input style="width:100px;" disabled="disabled" value="<? if(trim($row['data_cadastro'])==""||trim($row['data_cadastro'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_cadastro'],"d/m/Y"); } ?>" type="text">
                                                                            </div>
                                                                            <!--
                                                                            <div class="span3">
                                                                                <label>Data de Prospecto</label>
                                                                                <div class="input-append date" id="data_prospecto" data-date-format="dd/mm/yyyy" data-date="">
                                                                                    <input class="span8" size="16" name="data_prospecto" value="<? if(trim($row['data_prospecto'])==""||trim($row['data_prospecto'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_prospecto'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="span3">
                                                                                <label>Virou cliente</label>
                                                                                <div class="input-append date" id="data_cliente" data-date-format="dd/mm/yyyy" data-date="">
                                                                                    <input class="span8" size="16" name="data_cliente" value="<? if(trim($row['data_cliente'])==""||trim($row['data_cliente'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_cliente'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            -->
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <label class="req">Ativo ?</label>
                                                                            <label class="radio" style="color:#C00;">
                                                                                <input type="radio" name="stat" id="stat1" disabled="disabled" value="0" <? if($row['stat']==0) { echo "checked"; } ?> >
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="stat" id="stat2" disabled="disabled" value="1" <? if($row['stat']==1) { echo "checked"; } ?> >
                                                                                sim
                                                                            </label>
                                                                        </div>	
                                                                    </div>

                                                                    <div id="tbview_b" class="tab-pane" style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <div class="span4">
                                                                                <label>E-mail principal</label>
                                                                                <input value="<?=$row['email']?>" style="width:350px;" type="text" disabled="disabled" />
                                                                            </div>
                                                                            <div class="span2">
                                                                                <label>Senha</label>
                                                                                <div class="input-append">
                                                                                <input value="<?=$row['senha']?>" style="width:350px;" type="text" disabled="disabled" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div id="tbview_c" class="tab-pane" style="min-height:350px;">
                                                                        <div style="width:100%;float:left;">
                                                                            <label>Tipo de Cliente</label>
                                                                            <select disabled="disabled" style="width:350px;" onchange="tipo_de_cliente('');">
                                                                                <option value="">---</option>
                                                                                <option value="pf" <? if($row['tipo_de_documento']=="pf") { echo "selected"; } ?>>pessoa física</option>
                                                                                <option value="pj" <? if($row['tipo_de_documento']=="pj") { echo "selected"; } ?>>pessoa jurídica</option>
                                                                                <option value="estrangeiro" <? if($row['tipo_de_documento']=="estrangeiro") { echo "selected"; } ?>>estrangeiro</option>
                                                                            </select>
                                                                            <span class="help-block">Ao escolher o tipo de cliente, abaixo serão exibidos os campos referentes ao tipo de cadastro</span>
                                                                        </div>
            
                                                                        <div style="width:100%;display:<? if($row['tipo_de_documento']=="pf") { echo "block"; } else { echo "none"; } ?>;" id="div_pf">
                                                                            <div style="width:100%;float:left;">
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>CPF</label>
                                                                                    <input style="width:150px;" value="<?=$row['cpf']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>RG</label>
                                                                                    <input style="width:100px;" value="<?=$row['rg']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>Emissor</label>
                                                                                    <input style="width:80px;" value="<?=$row['emissor']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="width:100%;float:left;">
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>PIS</label>
                                                                                    <input style="width:100px;" value="<?=$row['pis']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>Profissão</label>
                                                                                    <input style="width:200px;" value="<?=$row['profissao']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>Nacionalidade</label>
                                                                                    <input style="width:200px;" value="<?=$row['nacionalidade']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="width:100%;float:left;">
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>Data de Nascimento</label>
                                                                                    <input style="width:100px;" value="<?=$row['data_nascimento']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>Estado Civil</label>
                                                                                    <select disabled="disabled" style="width:150px;">
                                                                                        <option value="">---</option>
                                                                                        <option value="Casado (a)" <? if($row['estado_civil']=="Casado (a)") { echo "selected"; } ?>>Casado (a)</option>
                                                                                        <option value="Separado (a)" <? if($row['estado_civil']=="Separado (a)") { echo "selected"; } ?>>Separado (a)</option>
                                                                                        <option value="Solteiro (a)" <? if($row['estado_civil']=="Solteiro (a)") { echo "selected"; } ?>>Solteiro (a)</option>
                                                                                        <option value="Viúvo (a)" <? if($row['estado_civil']=="Viúvo (a") { echo "selected"; } ?>>Viúvo (a)</option> 
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div style="width:100%;display:<? if($row['tipo_de_documento']=="pj") { echo "block"; } else { echo "none"; } ?>;" id="div_pj">
                                                                            <div style="float:left;width:100%;">
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>CNPJ</label>
                                                                                    <input style="width:350px;" value="<?=$row['cnpj']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>IE</label>
                                                                                    <input style="width:350px;" value="<?=$row['ie']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>Razão Social</label>
                                                                                    <input style="width:350px;" value="<?=$row['razao_social']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>Nome Fantasia</label>
                                                                                    <input style="width:350px;"" value="<?=$row['nome_fantasia']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>Nome do responsável</label>
                                                                                    <input style="width:350px;" value="<?=$row['responsavel']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                                <div style="float:left;margin-right:5px;">
                                                                                    <label>Cargo</label>
                                                                                    <input style="width:150px;" value="<?=$row['responsavel_cargo']?>" disabled="disabled" type="text">
                                                                                </div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div style="width:100%;display:<? if($row['tipo_de_documento']=="estrangeiro") { echo "block"; } else { echo "none"; } ?>;" id="div_estrangeiro">
                                                                            <div style="float:left;width:100%;">
                                                                                <label>Tipo do Documento Estrangeiro</label>
                                                                                <input style="width:350px;" value="<?=$row['estrangeiro_nome']?>" disabled="disabled" type="text">
                                                                            </div>
                                                                            <div style="float:left;width:100%;">
                                                                                <label>Número do Documento</label>
                                                                                <input style="width:350px;" value="<?=$row['estrangeiro_numero']?>" disabled="disabled" type="text">
                                                                            </div>
                                                                        </div>
            
                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Como conheceu a nossa empresa ?</label>
                                                                                <select disabled="disabled" style="width:230px;" onchange="como_conheceu_set('');">
                                                                                    <option value="">---</option>
                                                                                    <option value="Google" <? if($row['como_conheceu']=="Google") { echo "selected"; } ?>>Google</option>
                                                                                    <option value="Outros buscadores" <? if($row['como_conheceu']=="Outros Buscadores") { echo "selected"; } ?>>Outros buscadores</option>
                                                                                    <option value="Revistas" <? if($row['como_conheceu']=="Revistas") { echo "selected"; } ?>>Revistas</option>
                                                                                    <option value="Indicações" <? if($row['como_conheceu']=="Indicações") { echo "selected"; } ?>>Indicações</option>
                                                                                    <option value="Parceiros" <? if($row['como_conheceu']=="Parceiros") { echo "selected"; } ?>>Parceiros</option>
                                                                                    <option value="Mídia Online" <? if($row['como_conheceu']=="Mídia Online") { echo "selected"; } ?>>Mídia Online</option>
                                                                                    <option value="Cliente" <? if($row['como_conheceu']=="Cliente") { echo "selected"; } ?>>Cliente</option>
                                                                                    <option value="Eventos" <? if($row['como_conheceu']=="Eventos") { echo "selected"; } ?>>Eventos</option>
                                                                                    <option value="Redes Sociais" <? if($row['como_conheceu']=="Redes Sociais") { echo "selected"; } ?>>Redes Sociais</option>
                                                                                    <option value="Rádio" <? if($row['como_conheceu']=="Rádio") { echo "selected"; } ?>>Rádio</option>
                                                                                    <option value="Outros" <? if($row['como_conheceu']=="Outros") { echo "selected"; } ?>>Outros</option>
                                                                                </select>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <input style="width:150px;margin-top:25px;display:<? if($row['como_conheceu']=="Outros") { echo "block"; } else { echo "none"; } ?>;" value="<?=$row['como_conheceu_outro']?>" name="como_conheceu_outro" id="como_conheceu_outro" type="text">
                                                                            </div>
                                                                        </div>
            
                                                                        <!--
                                                                        <div class="formSep">
                                                                            <label>Website</label>
                                                                            <input value="<?=$row['website']?>" class="span4" type="text" name="website" id="website" />
                                                                            <span class="help-block">http://www.dominio.com</span>
                                                                        </div>
                                                                        -->
                                                                    </div>
                                                                    
                                                                    <div id="tbview_d" class="tab-pane" style="min-height:350px;">
                                                                        <p style="float:left;width:100%;color:#368CA9;"><b>Telefones</b></p>

                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_telefones" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./lista_syscliente_telefones.php"); ?>
                                                                            </div>
                                                                        </div>

                                                                        <p style="float:left;width:100%;color:#368CA9;"><b>E-mail's</b></p>

                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_emails" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./lista_syscliente_emails.php"); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div id="tbview_e" class="tab-pane" style="min-height:350px;">

                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_endereco" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./lista_syscliente_endereco.php"); ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    
                                                                    <div id="tbview_f" class="tab-pane" style="min-height:350px;">
                                                                        
                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de itens</div>
                                                                            <div id="lista_syscliente_redes" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./lista_syscliente_redes.php"); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div id="tbview_i" class="tab-pane" style="min-height:350px;">

                                                                        <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                            <div id="lista_syscliente_banco" style="width:100%;float:left;">
                                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./lista_syscliente_banco.php"); ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div id="tbview_g" class="tab-pane" style="min-height:350px;">
                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Status do cliente</label>
                                                                                <select disabled="disabled">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$mod."_status WHERE stat='1' ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($row['id'.$mod.'_status']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            <!--
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Quem prospectou</label>
                                                                                <select name="idsysusu_prospecto" id="idsysusu_prospecto">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>" <? if($row['idsysusu_prospecto']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                            -->
                                                                        </div>
                                                                        <div style="float:left;width:100%;">
                                                                            <label>Observações</label>
                                                                            <textarea disabled="disabled"  style="width:500px;height:150px;"><?=$row['obs']?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    

                                                                </div>
                                                            </div>
                                                            </div>

