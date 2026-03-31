<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

if(trim($_REQUEST['idS'])=="") {
	$numeroUnicoGerado = geraCodReturn(); 
} else {
	$rSql = mysql_fetch_array(mysql_query("SELECT * FROM sysmidia WHERE id='".$_REQUEST['idS']."'"));
	$numeroUnicoGerado = $rSql['numeroUnico'];
}
?>
                                <div style="width:100%;">
                                    <input type="hidden" id="numeroUnico_pasta" value="<?=$numeroUnicoGerado?>">

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Nome da Pasta</label>
                                            <input value="<?=$rSql['nome']?>" style="width:350px;" type="text" id="nome_pasta" />
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;"><a href="javascript:void(0);" onclick="mostra_esconde('campo_usuario')">+ Adicionar usuário</a></div>
                                        <div id="campo_usuario" style="display:none;width:100%;float:left;">
                                            <div style="float:left;margin-right:10px;width:100%;">
                                                <div style="float:left;margin-right:10px;">
                                                    <label class="req">Usuário</label>
                                                    <select id="idsysusu">
                                                        <option value="">---</option>
                                                        <?
                                                        $qSqlItem = mysql_query("SELECT * FROM sysusu ORDER BY nome");
                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                        ?>
                                                        <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                        <? } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div style="float:left;margin-right:10px;width:100%;">
                                                <div style="float:left;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">Permissões da pasta</div>
                                                <div style="float:left;margin-right:10px;border:1px solid #CCC;padding:2px 2px;">
                                                    <label class="req" style="font-size:11px;">Visualizar</label>
                                                    <input value="0" type="hidden" id="visualizar_pasta_real" />
                                                    <label class="radio" style="color:#C00;">
                                                        <input type="radio" name="visualizar" id="visualizar_pasta_0" onclick="set_perm('visualizar_pasta','0');" checked="checked" value="0" >
                                                        não
                                                    </label>
                                                    <label class="radio" style="color:#390;">
                                                        <input type="radio" name="visualizar" id="visualizar_pasta_1" onclick="set_perm('visualizar_pasta','1');" value="1" >
                                                        sim
                                                    </label>
                                                </div>
                                                <div style="float:left;margin-right:10px;border:1px solid #CCC;padding:2px 2px;">
                                                    <label class="req" style="font-size:11px;">Criar Nova</label>
                                                    <input value="0" type="hidden" id="criar_pasta_real" />
                                                    <label class="radio" style="color:#C00;">
                                                        <input type="radio" name="criar" id="criar_pasta_0" onclick="set_perm('criar_pasta','0');" checked="checked" value="0" >
                                                        não
                                                    </label>
                                                    <label class="radio" style="color:#390;">
                                                        <input type="radio" name="criar" id="criar_pasta_1" onclick="set_perm('criar_pasta','1');" value="1" >
                                                        sim
                                                    </label>
                                                </div>
                                                <div style="float:left;margin-right:10px;border:1px solid #CCC;padding:2px 2px;">
                                                    <label class="req" style="font-size:11px;">Renomear</label>
                                                    <input value="0" type="hidden" id="renomear_pasta_real" />
                                                    <label class="radio" style="color:#C00;">
                                                        <input type="radio" name="renomear" id="renomear_pasta_0" onclick="set_perm('renomear_pasta','0');" checked="checked" value="0" >
                                                        não
                                                    </label>
                                                    <label class="radio" style="color:#390;">
                                                        <input type="radio" name="renomear" id="renomear_pasta_1" onclick="set_perm('renomear_pasta','1');" value="1" >
                                                        sim
                                                    </label>
                                                </div>
                                                <div style="float:left;margin-right:10px;border:1px solid #CCC;padding:2px 2px;">
                                                    <label class="req" style="font-size:11px;">Excluir</label>
                                                    <input value="0" type="hidden" id="excluir_pasta_real" />
                                                    <label class="radio" style="color:#C00;">
                                                        <input type="radio" name="excluir" id="excluir_pasta_0" onclick="set_perm('excluir_pasta','0');" checked="checked" value="0" >
                                                        não
                                                    </label>
                                                    <label class="radio" style="color:#390;">
                                                        <input type="radio" name="excluir" id="excluir_pasta_1" onclick="set_perm('excluir_pasta','1');" value="1" >
                                                        sim
                                                    </label>
                                                </div>
                                            </div>
                                            <div style="float:left;margin-right:10px;width:100%;">
                                                <div style="float:left;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;margin-top:10px;">Permissões de arquivos da pasta</div>
                                                <div style="float:left;margin-right:10px;border:1px solid #CCC;padding:2px 2px;">
                                                    <label class="req" style="font-size:11px;">Upload</label>
                                                    <input value="0" type="hidden" id="upload_arquivo_real" />
                                                    <label class="radio" style="color:#C00;">
                                                        <input type="radio" name="upload_arquivo" id="upload_arquivo_0" onclick="set_perm('upload_arquivo','0');" checked="checked" value="0" >
                                                        não
                                                    </label>
                                                    <label class="radio" style="color:#390;">
                                                        <input type="radio" name="upload_arquivo" id="upload_arquivo_1" onclick="set_perm('upload_arquivo','1');" value="1" >
                                                        sim
                                                    </label>
                                                </div>
                                                <div style="float:left;margin-right:10px;border:1px solid #CCC;padding:2px 2px;">
                                                    <label class="req" style="font-size:11px;">Excluir</label>
                                                    <input value="0" type="hidden" id="excluir_arquivo_real" />
                                                    <label class="radio" style="color:#C00;">
                                                        <input type="radio" name="excluir_arquivo" id="excluir_arquivo_0" onclick="set_perm('excluir_arquivo','0');" checked="checked" value="0" >
                                                        não
                                                    </label>
                                                    <label class="radio" style="color:#390;">
                                                        <input type="radio" name="excluir_arquivo" id="excluir_arquivo_1" onclick="set_perm('excluir_arquivo','1');" value="1" >
                                                        sim
                                                    </label>
                                                </div>
                                                <div style="float:left;margin-right:10px;border:1px solid #CCC;padding:2px 2px;">
                                                    <label class="req" style="font-size:11px;">Renomear</label>
                                                    <input value="0" type="hidden" id="renomear_arquivo_real" />
                                                    <label class="radio" style="color:#C00;">
                                                        <input type="radio" name="renomear_arquivo" id="renomear_arquivo_0" onclick="set_perm('renomear_arquivo','0');" checked="checked" value="0" >
                                                        não
                                                    </label>
                                                    <label class="radio" style="color:#390;">
                                                        <input type="radio" name="renomear_arquivo" id="renomear_arquivo_1" onclick="set_perm('renomear_arquivo','1');" value="1" >
                                                        sim
                                                    </label>
                                                </div>
                                                <div style="float:left;margin-right:10px;border:1px solid #CCC;padding:2px 2px;">
                                                    <label class="req" style="font-size:11px;">Download</label>
                                                    <input value="0" type="hidden" id="baixar_arquivo_real" />
                                                    <label class="radio" style="color:#C00;">
                                                        <input type="radio" name="baixar_arquivo" id="baixar_arquivo_0" onclick="set_perm('baixar_arquivo','0');" checked="checked" value="0" >
                                                        não
                                                    </label>
                                                    <label class="radio" style="color:#390;">
                                                        <input type="radio" name="baixar_arquivo" id="baixar_arquivo_1" onclick="set_perm('baixar_arquivo','1');" value="1" >
                                                        sim
                                                    </label>
                                                </div>
                                            </div>
                                            <div style="float:left;margin-right:10px;width:100%;margin-bottom:10px;border-top:1px dashed #CCCCCC;margin-top:10px;padding-top:10px;">
                                                <button type="button" onclick="salvar_usuario_pasta_perm();" class="btn btn-primary">Adicionar</button>
                                            </div>
                                        </div>
                                        <div id="lista_usuarios" style="width:100%;float:left;margin-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                            <? $numeroUnicoGet = $numeroUnicoGerado; include("./lista_usuarios.php"); ?>
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <? if(trim($_REQUEST['idS'])=="") { ?>
                                        <button type="button" onclick="cria_pasta_ajax('<?=$_REQUEST['idsysusuS']?>');" class="btn btn-success">Criar Pasta</button>
                                        <? } else { ?>
                                        <button type="button" onclick="edita_pasta_ajax('<?=$_REQUEST['idS']?>','<?=$_REQUEST['idsysusuS']?>');" class="btn btn-success">Editar Pasta</button>
                                        <? } ?>
                                        <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Cancelar</button>
                                    </div>

                                </div>
