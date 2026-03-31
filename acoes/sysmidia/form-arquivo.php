<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
?>
								<script type="text/javascript" src="<?=$link?>template/js/upload.js"></script>
								<script type="text/javascript" >
                                    <?
									if(trim($_REQUEST['idS'])=="") {
                                        $numeroUnicoGerado = geraCodReturn(); 
										#$_SESSION["numeroUnico_upload_arquivo"] = $numeroUnicoGerado;
                                        criaPastaComCaminho("files/sysmidia","".$numeroUnicoGerado."");
                                    } else {
										$rSql = mysql_fetch_array(mysql_query("SELECT * FROM sysmidia WHERE id='".$_REQUEST['idS']."'"));
                                        $numeroUnicoGerado = $rSql["numeroUnico"]; 
										#$_SESSION["numeroUnico_upload_arquivo"] = $numeroUnicoGerado;
                                     }
                                    ?>
                                    $(function(){
                                        var btnUpload=$('#upload-arquivo');
                                        new AjaxUpload(btnUpload, {
                                            action: '<?=$link?>acoes/sysmidia/upload-arquivo.php?numeroUnicoS=<?=$numeroUnicoGerado?>',
                                            name: 'arquivo',
                                            onSubmit: function(file, ext){
                                            },
                                            onComplete: function(file, response){
												$("#arquivo_upload_arquivo").val(""+file+"");

												extensao = file;
												tam_extensao = extensao.length;
												ponto_extensao = tam_extensao - 4;
												extensao = extensao.substr(ponto_extensao, tam_extensao);
												
												if(extensao[0] == '.'){
													extensao = file;
													tam_extensao = extensao.length;
													ponto_extensao = tam_extensao - 3;
													extensao = extensao.substr(ponto_extensao, tam_extensao);
												}
												extensao = extensao.toLowerCase();
												
                                                if(extensao=="png"||extensao=="jpg"||extensao=="jpeg"||extensao=="gif"||extensao=="bmp") {
													$("#imagem-upload-arquivo").html('<div style="float:left;margin-bottom:10px;"><img style="max-width:100px;max-height:100px;" src="<?=$link?>files/sysmidia/<?=$numeroUnicoGerado?>/'+file+'" alt="" /></div><div style="float:left;margin-left:5px;">'+file+'</div>');
												} else {
													$("#imagem-upload-arquivo").html('<div style="float:left;margin-left:5px;margin-bottom:10px;">'+file+'</div>');
												}
                                            }
                                        });
                                        
                                    });
                                </script>
                                <div style="width:100%;">
                                    <input type="hidden" id="numeroUnico_upload_arquivo" value="<?=$numeroUnicoGerado?>">

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Título do Arquivo</label>
                                            <input value="<?=$rSql['nome']?>" style="width:350px;" type="text" id="nome_upload_arquivo" />
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;margin-bottom:10px;">
                                            <label class="req">Arquivo</label>
											<? if(trim($_REQUEST['idS'])=="") { ?>
                                            <input type="button" id="upload-arquivo" value="adicionar arquivo" class="btn" />
                                            <? } else { ?>
                                            <input type="button" id="upload-arquivo" value="editar arquivo" class="btn" />
                                            <? } ?>
                                            <input value="<?=$rSql['arquivo']?>" style="width:350px;" type="hidden" id="arquivo_upload_arquivo" />
                                        </div>
                                    </div>
                                    <div class="formSep" id="imagem-upload-arquivo">
										<? if(trim($rSql['arquivo'])=="") { } else { ?>
                                        <?
										$extensao = $rSql['arquivo'];
										$extensao = substr($extensao, -4);
										if($extensao[0] == '.'){
											$extensao = substr($extensao, -3);
										}
										$extensao = strtolower($extensao);
										if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp") {
										?>
                                        <div style="float:left;margin-bottom:10px;"><img style="max-width:100px;max-height:100px;" src="<?=$link?>files/sysmidia/<?=$numeroUnicoGerado?>/<?=$rSql['arquivo']?>" alt="" /></div>
                                        <? } ?>
                                        <div style="float:left;margin-left:5px;margin-bottom:10px;"><?=$rSql['arquivo']?></div>
                                        <? } ?>
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
                                                <button type="button" onclick="salvar_usuario_arquivo_perm();" class="btn btn-primary">Adicionar</button>
                                            </div>
                                        </div>
                                        <div id="lista_usuarios" style="width:100%;float:left;margin-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                            <? $numeroUnicoGet = $numeroUnicoGerado; include("./lista_usuarios_arquivo.php"); ?>
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <? if(trim($_REQUEST['idS'])=="") { ?>
                                        <button type="button" onclick="cria_arquivo_ajax('<?=$_REQUEST['idsysusuS']?>');" class="btn btn-success">Criar Arquivo</button>
                                        <? } else { ?>
                                        <button type="button" onclick="edita_arquivo_ajax('<?=$rSql['id']?>','<?=$_REQUEST['idsysusuS']?>');" class="btn btn-success">Editar Arquivo</button>
                                        <? } ?>
                                        <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Cancelar</button>
                                    </div>

                                </div>
