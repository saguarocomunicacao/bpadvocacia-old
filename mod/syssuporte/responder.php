        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
                            <ul id="pageNav">
								<li class="current"><a href="javascript:void(0);">Responder Chamado</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#tb1_a">Visualizando Chamado #<?=$row['idchamado']?></a></li>
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
                                                            "sPaginationType": "bootstrap_full",
															"aoColumns": [
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
															]
                                                        });
                                                    }
                                                }
                                            };

											//* WYSIWG Editor
											beoro_wysiwg = {
												init: function() {
													if($('#texto_resposta').length) { 
														CKEDITOR.replace( 'texto_resposta', {
															toolbar: 'Standard'
														});
													}
													if($('#texto').length) { 
														CKEDITOR.replace( 'texto', {
															toolbar: 'Standard'
														});
													}
												}
											};

                                            </script>
                                            <div class="tab-content">
                                                <div id="tb1_a" class="tab-pane active">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="editar" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="idpai" value="<?=$row['id']?>" />
                                                            <input type="hidden" name="idsysusu" value="<?=$sysusu['id']?>" />
                
                                                            <? $numeroUnicoGerado = geraCodReturn(); ?>
                                                            <input type="hidden" name="senha_resposta" id="senha_resposta" value="<?=$numeroUnicoGerado?>">

                                                            <? $idchamadoGerado = geraIdChamado(); ?>
                                                            <input type="hidden" name="idchamado" id="idchamado" value="ST<?=$idchamadoGerado?>">

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Assunto</label>
                                                                    <input value="" style="width:350px;" type="text" name="nome" id="nome" />
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label>Anexo</label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="imagem" type="file"></span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label class="req">Detalhes do chamado</label>
                                                                <textarea name="texto" id="texto_resposta" class="span12" style="height:150px;"></textarea>
                                                            </div>

                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Responder</button>
                                                            </div>

                                                            <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de chamados</div>
                                                                <div id="lista_categoria_itens" style="width:100%;float:left;">
                                                                    <table class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:150px;">Usuário</th>
                                                                            <th>Assunto</th>
                                                                            <th style="width:200px;">Anexo</th>
                                                                            <th style="width:130px;">Data de Resposta</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $qSql = mysql_query("SELECT * FROM ".$mod." WHERE idpai='".$row['id']."' ORDER BY data DESC");
                                                                        while($rSql = mysql_fetch_array($qSql)) {
                                                                        ?>
                                                                        <tr id="linha-<?=$rSql['id']?>">
                                                                            <?
																			if(trim($rSql['idsysusu'])==""||trim($rSql['idsysusu'])==0) {
																				$nome_usuario = "Administrador";
																			} else {
																				$usuario = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['idsysusu']."'"));
																				$nome_usuario = $usuario['nome'];
																			}
																			?>
                                                                            <td style="vertical-align:middle;"><?=$nome_usuario?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSql['nome']?></td>
                                                                            <td style="vertical-align:middle;"><? if(trim($rSql['imagem'])=="") { echo "---"; } else { ?><a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$mod?>/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>"><?=$rSql['imagem']?></a><? } ?></td>
                                                                            <td style="vertical-align:middle;"><? ajustaData($rSql['data'],"d/m/Y"); ?></td>
                                                                        </tr>
                                                                        <? } ?>
                                                                        <? $rSql = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$row['id']."'"));?>
                                                                        <tr id="linha-<?=$rSql['id']?>">
                                                                            <?
																			if(trim($rSql['idsysusu'])==""||trim($rSql['idsysusu'])==0) {
																				$nome_usuario = "Administrador";
																			} else {
																				$usuario = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['idsysusu']."'"));
																				$nome_usuario = $usuario['nome'];
																			}
																			?>
                                                                            <td style="vertical-align:middle;"><?=$nome_usuario?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSql['nome']?></td>
                                                                            <td style="vertical-align:middle;"><? if(trim($rSql['imagem'])=="") { echo "---"; } else { ?><a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$mod?>/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>"><?=$rSql['imagem']?></a><? } ?></td>
                                                                            <td style="vertical-align:middle;"><? ajustaData($rSql['data'],"d/m/Y"); ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                </div>
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
