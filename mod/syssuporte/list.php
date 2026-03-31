        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
                        	<? include("./acoes/sysgeral/menu-sistema.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <!--<? if(trim($sysperm['visualizar_'.$mod.''])==1||trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_a">Lista de Chamados</a></li><? } ?>-->
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_b">Adicionar Novo</a></li><? } ?>
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
													if($('#texto').length) { 
														CKEDITOR.replace( 'texto', {
															toolbar: 'Standard'
														});
													}
												}
											};

                                            </script>
                                            <div class="tab-content">
                                                <div id="tb1_a" class="tab-pane">
                                                    <div class="w-box w-box">
                                                        <div class="w-box-header">
                                                        </div>
                                                        <div class="w-box-content">
                                                            <form name="formsList" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data">
                                                            <input type="hidden" name="acaoForm" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <table id="dt_basic" class="table table-striped table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:50px;">ID</th>
                                                                    <th>Assunto</th>
                                                                    <th style="width:130px;">Data de Abertura</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$mod." WHERE idpai='0' ORDER BY data DESC");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                ?>
                                                                <tr id="linha-<?=$rSql['id']?>">
                                                                    <td style="vertical-align:middle;"><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/detalhes/<?=$rSql['idchamado']?>/" class="btn-mini ptip_se" title="Visualizar"><? echo "#".strtoupper($rSql['idchamado']);?></a></td>
                                                                    <td style="vertical-align:middle;"><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/detalhes/<?=$rSql['idchamado']?>/" class="btn-mini ptip_se" title="Visualizar"><?=$rSql['nome']?></a></td>
                                                                    <td style="vertical-align:middle;"><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/detalhes/<?=$rSql['idchamado']?>/" class="btn-mini ptip_se" title="Visualizar"><? ajustaData($rSql['data'],"d/m/Y"); ?></a></td>
                                                                </tr>
                                                                <? } ?>
                                                            </tbody>
                                                            </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tb1_b" class="tab-pane active">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="idpai" value="0" />
                                                            <input type="hidden" name="idsysusu" value="<?=$sysusu['id']?>" />
                
                                                            <? $numeroUnicoGerado = geraCodReturn(); ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                            <? $senha_respostaGerado = geraCodReturn(); ?>
                                                            <input type="hidden" name="senha_resposta" id="senha_resposta" value="<?=$senha_respostaGerado?>">

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
                                                                <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                            </div>

                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Enviar</button>
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
