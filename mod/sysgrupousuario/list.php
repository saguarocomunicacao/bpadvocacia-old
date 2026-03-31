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
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?><? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_a">Editando <?=$row['nome']?></a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_b">Lista de Itens</a></li><? } ?>
                                                <? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_c">Adicionar Novo</a></li><? } ?><? } ?>
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
			
												beoro_select_row.init();
            
												//* switch buttons
												beoro_switchButtons.init();
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
                                            
											//* select all rows
											beoro_select_row = {
												init: function() {
													$('.select_msgs').click(function () {
														var tableid = $(this).data('tableid');
														$('#'+tableid).find('input[class=select_msg]').attr('checked', this.checked);
													});
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
																{ "bSortable": false },
																{ "sType": "string" },
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };

											//* switch buttons
											beoro_switchButtons = {
												init: function() {
													if($('#sell_sysusu').length) {
														$("#sell_sysusu").iButton({
															width:50,
															change: function ($input){
																if( $("#sell_sysusu").is(':checked') ){
																	$(".item_sysusu").prop("checked", true).change();
																} else {
																	$(".item_sysusu").prop("checked", false).change();
																}
															}
														});
													}
													if($('#visualizar_sysusu').length) { $("#visualizar_sysusu").iButton(); }
													if($('#inserir_sysusu').length) { $("#inserir_sysusu").iButton(); }
													if($('#editar_sysusu').length) { $("#editar_sysusu").iButton(); }
													if($('#excluir_sysusu').length) { $("#excluir_sysusu").iButton(); }
													if($('#publicar_sysusu').length) { $("#publicar_sysusu").iButton(); }
													if($('#despublicar_sysusu').length) { $("#despublicar_sysusu").iButton(); }
													if($('#lixeira_sysusu').length) { $("#lixeira_sysusu").iButton(); }
													if($('#restaurar_sysusu').length) { $("#restaurar_sysusu").iButton(); }
													if($('#senha_sysusu').length) { $("#senha_sysusu").iButton(); }
													if($('#dados_sysusu').length) { $("#dados_sysusu").iButton(); }
													if($('#configuracao_sysusu').length) { $("#configuracao_sysusu").iButton(); }
													if($('#chat_sysusu').length) { $("#chat_sysusu").iButton(); }
			
													if($('#sell_sysgrupousuario').length) {
														$("#sell_sysgrupousuario").iButton({
															width:50,
															change: function ($input){
																if( $("#sell_sysgrupousuario").is(':checked') ){
																	$(".item_sysgrupousuario").prop("checked", true).change();
																} else {
																	$(".item_sysgrupousuario").prop("checked", false).change();
																}
															}
														});
													}
													if($('#visualizar_sysgrupousuario').length) { $("#visualizar_sysgrupousuario").iButton(); }
													if($('#inserir_sysgrupousuario').length) { $("#inserir_sysgrupousuario").iButton(); }
													if($('#editar_sysgrupousuario').length) { $("#editar_sysgrupousuario").iButton(); }
													if($('#excluir_sysgrupousuario').length) { $("#excluir_sysgrupousuario").iButton(); }
													if($('#publicar_sysgrupousuario').length) { $("#publicar_sysgrupousuario").iButton(); }
													if($('#despublicar_sysgrupousuario').length) { $("#despublicar_sysgrupousuario").iButton(); }
													if($('#lixeira_sysgrupousuario').length) { $("#lixeira_sysgrupousuario").iButton(); }
													if($('#restaurar_sysgrupousuario').length) { $("#restaurar_sysgrupousuario").iButton(); }
			
													if($('#visualizar_sysmidia').length) { $("#visualizar_sysmidia").iButton(); }
			
													if($('#sell_syspermadmin').length) {
														$("#sell_syspermadmin").iButton({
															width:50,
															change: function ($input){
																if( $("#sell_syspermadmin").is(':checked') ){
																	$(".item_syspermadmin").prop("checked", true).change();
																} else {
																	$(".item_syspermadmin").prop("checked", false).change();
																}
															}
														});
													}
													if($('#visualizar_syspermadmin').length) { $("#visualizar_syspermadmin").iButton(); }
													if($('#editar_syspermadmin').length) { $("#editar_syspermadmin").iButton(); }
			
													if($('#visualizar_syssuporte').length) { $("#visualizar_syssuporte").iButton(); }
													if($('#inserir_syssuporte').length) { $("#inserir_syssuporte").iButton(); }
			
													if($('#visualizar_sysacesso').length) { $("#visualizar_sysacesso").iButton(); }
													if($('#admin_sysacesso').length) { $("#admin_sysacesso").iButton(); }
			
													if($('#visualizar_syslog').length) { $("#visualizar_syslog").iButton(); }
													if($('#admin_syslog').length) { $("#admin_syslog").iButton(); }
			
													if($('#visualizar_sysfonte').length) { $("#visualizar_sysfonte").iButton(); }
			
													if($('#sell_sysconfig').length) {
														$("#sell_sysconfig").iButton({
															width:50,
															change: function ($input){
																if( $("#sell_sysconfig").is(':checked') ){
																	$(".item_sysconfig").prop("checked", true).change();
																} else {
																	$(".item_sysconfig").prop("checked", false).change();
																}
															}
														});
													}
													if($('#admin_sysconfig').length) { $("#admin_sysconfig").iButton(); }
													if($('#site_sysconfig').length) { $("#site_sysconfig").iButton(); }
													if($('#layout_sysconfig').length) { $("#layout_sysconfig").iButton(); }
													if($('#imagens_sysconfig').length) { $("#imagens_sysconfig").iButton(); }
													if($('#mensagens_sysconfig').length) { $("#mensagens_sysconfig").iButton(); }
													if($('#seo_sysconfig').length) { $("#seo_sysconfig").iButton(); }
													if($('#indexacao_sysconfig').length) { $("#indexacao_sysconfig").iButton(); }
													if($('#analytics_sysconfig').length) { $("#analytics_sysconfig").iButton(); }
													if($('#erro404_sysconfig').length) { $("#erro404_sysconfig").iButton(); }
													if($('#instalacao_sysconfig').length) { $("#instalacao_sysconfig").iButton(); }
													if($('#dominios_sysconfig').length) { $("#dominios_sysconfig").iButton(); }
													if($('#visualizar_sysconfig').length) { $("#servidor_sysconfig").iButton(); }
													if($('#visualizar_sysconfig').length) { $("#visualizar_sysconfig").iButton(); }
			
													<?
													$qSql = mysql_query("SELECT * FROM sysmod WHERE stat='1' ORDER BY ordem");
													while($rSql = mysql_fetch_array($qSql)) {
													?>
													if($('#sell_<?=$rSql['bd']?>').length) {
														$("#sell_<?=$rSql['bd']?>").iButton({
															width:50,
															change: function ($input){
																if( $("#sell_<?=$rSql['bd']?>").is(':checked') ){
																	$(".item_<?=$rSql['bd']?>").prop("checked", true).change();
																} else {
																	$(".item_<?=$rSql['bd']?>").prop("checked", false).change();
																}
															}
														});
													}
													if($('#visualizar_<?=$rSql['bd']?>').length) { $("#visualizar_<?=$rSql['bd']?>").iButton(); }
													if($('#todos_<?=$rSql['bd']?>').length) { $("#todos_<?=$rSql['bd']?>").iButton(); }
													if($('#inserir_<?=$rSql['bd']?>').length) { $("#inserir_<?=$rSql['bd']?>").iButton(); }
													if($('#editar_<?=$rSql['bd']?>').length) { $("#editar_<?=$rSql['bd']?>").iButton(); }
													if($('#excluir_<?=$rSql['bd']?>').length) { $("#excluir_<?=$rSql['bd']?>").iButton(); }
													if($('#publicar_<?=$rSql['bd']?>').length) { $("#publicar_<?=$rSql['bd']?>").iButton(); }
													if($('#despublicar_<?=$rSql['bd']?>').length) { $("#despublicar_<?=$rSql['bd']?>").iButton(); }
													if($('#lixeira_<?=$rSql['bd']?>').length) { $("#lixeira_<?=$rSql['bd']?>").iButton(); }
													if($('#restaurar_<?=$rSql['bd']?>').length) { $("#restaurar_<?=$rSql['bd']?>").iButton(); }
													if($('#descricao_<?=$rSql['bd']?>').length) { $("#descricao_<?=$rSql['bd']?>").iButton(); }
													if($('#seo_<?=$rSql['bd']?>').length) { $("#seo_<?=$rSql['bd']?>").iButton(); }
													<? } ?>
												}
											};
                                            </script>
                                            <div class="tab-content">

                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?>
                                                <div id="tb1_a" class="tab-pane active">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="editar" />
                                                            <input type="hidden" name="modulo" value="sysgrupousuario" />
                                                            <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = $row['numeroUnico']; 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                
                                                            <div class="tabbable tabs-left tabbable-bordered">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#tb3_a">Dados Principais</a></li>
                                                                    <li><a data-toggle="tab" href="#tb3_b">Módulos de Sistema</a></li>
                                                                    <?
                                                                    $qSqlCat = mysql_query("SELECT * FROM sysmod_categoria WHERE stat='1' ORDER BY ordem");
                                                                    while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                    ?>
                                                                    <li><a data-toggle="tab" href="#tb3_<?=$rSqlCat['id']?>"><?=$rSqlCat['nome']?></a></li>
                                                                    <? } ?>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div id="tb3_a" class="tab-pane active" style="min-height:350px;">
    
                                                                        <div class="formSep">
                                                                            <label class="req">Nome</label>
                                                                            <input value="<?=$row['nome']?>" style="width:350px;" type="text" name="nome" id="nome" />
                                                                        </div>
    
                                                                        <div class="formSep">
                                                                            <label>Quando entrar no administrativo, que página deve abrir ?</label>
                                                                            <select name="modulo_abertura" id="modulo_abertura" style="width:255px;">
                                                                                <option value="">---</option>
                                                                                <?
                                                                                $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE stat='1' ORDER BY ordem");
                                                                                while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                                    $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                                                ?>
                                                                                <option value="<?=$url_mod?>" <? if($row['modulo_abertura']==$url_mod) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                                                <? } ?>
                                                                            </select>
                                                                            <span class="help-block">Altere sempre que desejar</span>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <label class="req">Ativo ?</label>
                                                                            <label class="radio" style="color:#C00;">
                                                                                <input type="radio" name="stat" id="stat1" value="0" <? if($row['stat']==0) { echo "checked"; } ?> >
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="stat" id="stat2" value="1" <? if($row['stat']==1) { echo "checked"; } ?> >
                                                                                sim
                                                                            </label>
                                                                        </div>	
    
                                                                    </div>
    
                                                                    <div id="tb3_b" class="tab-pane" style="min-height:350px;">
            
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b>Módulo de Usuários</b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                                <input type="checkbox" id="sell_sysusu" 
                                                                                <? 
                                                                                if(
                                                                                  trim($row['visualizar_sysusu'])==1
                                                                                &&trim($row['inserir_sysusu'])==1
                                                                                &&trim($row['editar_sysusu'])==1
                                                                                &&trim($row['excluir_sysusu'])==1
                                                                                &&trim($row['publicar_sysusu'])==1
                                                                                &&trim($row['despublicar_sysusu'])==1
                                                                                &&trim($row['lixeira_sysusu'])==1
                                                                                &&trim($row['restaurar_sysusu'])==1
                                                                                &&trim($row['senha_sysusu'])==1
                                                                                &&trim($row['dados_sysusu'])==1
                                                                                &&trim($row['configuracao_sysusu'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                class="sell_sysusu {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_sysusu" id="visualizar_sysusu" <? if(trim($row['visualizar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu visualizar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Inserir</label>
                                                                                <input type="checkbox" name="inserir_sysusu" id="inserir_sysusu" <? if(trim($row['inserir_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu inserir_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Editar</label>
                                                                                <input type="checkbox" name="editar_sysusu" id="editar_sysusu" <? if(trim($row['editar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu editar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Excluir</label>
                                                                                <input type="checkbox" name="excluir_sysusu" id="excluir_sysusu" <? if(trim($row['excluir_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu excluir_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Publicar</label>
                                                                                <input type="checkbox" name="publicar_sysusu" id="publicar_sysusu" <? if(trim($row['publicar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu publicar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Despublicar</label>
                                                                                <input type="checkbox" name="despublicar_sysusu" id="despublicar_sysusu" <? if(trim($row['despublicar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu despublicar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Enviar para Lixeira</label>
                                                                                <input type="checkbox" name="lixeira_sysusu" id="lixeira_sysusu" <? if(trim($row['lixeira_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu lixeira_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Restaurar da Lixeira</label>
                                                                                <input type="checkbox" name="restaurar_sysusu" id="restaurar_sysusu" <? if(trim($row['restaurar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu restaurar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Alterar Senha</label>
                                                                                <input type="checkbox" name="senha_sysusu" id="senha_sysusu" <? if(trim($row['senha_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu senha_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Alterar Dados</label>
                                                                                <input type="checkbox" name="dados_sysusu" id="dados_sysusu" <? if(trim($row['dados_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu dados_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Alterar Configurações</label>
                                                                                <input type="checkbox" name="configuracao_sysusu" id="configuracao_sysusu" <? if(trim($row['configuracao_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu configuracao_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Chat</label>
                                                                                <input type="checkbox" name="chat_sysusu" id="chat_sysusu" <? if(trim($row['chat_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu chat_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b>Módulo de Grupo de Usuários</b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                                <input type="checkbox" id="sell_sysgrupousuario" 
                                                                                <? 
                                                                                if(
                                                                                  trim($row['visualizar_sysgrupousuario'])==1
                                                                                &&trim($row['inserir_sysgrupousuario'])==1
                                                                                &&trim($row['editar_sysgrupousuario'])==1
                                                                                &&trim($row['excluir_sysgrupousuario'])==1
                                                                                &&trim($row['publicar_sysgrupousuario'])==1
                                                                                &&trim($row['despublicar_sysgrupousuario'])==1
                                                                                &&trim($row['lixeira_sysgrupousuario'])==1
                                                                                &&trim($row['restaurar_sysgrupousuario'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                class="sell_sysgrupousuario {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_sysgrupousuario" id="visualizar_sysgrupousuario" <? if(trim($row['visualizar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario visualizar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Inserir</label>
                                                                                <input type="checkbox" name="inserir_sysgrupousuario" id="inserir_sysgrupousuario" <? if(trim($row['inserir_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario inserir_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Editar</label>
                                                                                <input type="checkbox" name="editar_sysgrupousuario" id="editar_sysgrupousuario" <? if(trim($row['editar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario editar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Excluir</label>
                                                                                <input type="checkbox" name="excluir_sysgrupousuario" id="excluir_sysgrupousuario" <? if(trim($row['excluir_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario excluir_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Publicar</label>
                                                                                <input type="checkbox" name="publicar_sysgrupousuario" id="publicar_sysgrupousuario" <? if(trim($row['publicar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario publicar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Despublicar</label>
                                                                                <input type="checkbox" name="despublicar_sysgrupousuario" id="despublicar_sysgrupousuario" <? if(trim($row['despublicar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario despublicar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Enviar para Lixeira</label>
                                                                                <input type="checkbox" name="lixeira_sysgrupousuario" id="lixeira_sysgrupousuario" <? if(trim($row['lixeira_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario lixeira_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Restaurar da Lixeira</label>
                                                                                <input type="checkbox" name="restaurar_sysgrupousuario" id="restaurar_sysgrupousuario" <? if(trim($row['restaurar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario restaurar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b>Módulo de Permissões</b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                                <input type="checkbox" id="sell_syspermadmin" 
                                                                                <? 
                                                                                if(
                                                                                  trim($row['visualizar_syspermadmin'])==1
                                                                                &&trim($row['editar_syspermadmin'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                class="sell_sysusu {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_syspermadmin" id="visualizar_syspermadmin" <? if(trim($row['visualizar_syspermadmin'])==1) { echo " checked"; } ?> class="item_syspermadmin visualizar_syspermadmin {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Editar</label>
                                                                                <input type="checkbox" name="editar_syspermadmin" id="editar_syspermadmin" <? if(trim($row['editar_syspermadmin'])==1) { echo " checked"; } ?> class="item_syspermadmin editar_syspermadmin {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b>Módulo de Suporte</b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_syssuporte" id="visualizar_syssuporte" <? if(trim($row['visualizar_syssuporte'])==1) { echo " checked"; } ?> class="visualizar_syssuporte {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Inserir</label>
                                                                                <input type="checkbox" name="inserir_syssuporte" id="inserir_syssuporte" <? if(trim($row['inserir_syssuporte'])==1) { echo " checked"; } ?> class="inserir_syssuporte {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b>Módulo de Histórico de Acessos</b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_sysacesso" id="visualizar_sysacesso" <? if(trim($row['visualizar_sysacesso'])==1) { echo " checked"; } ?> class="visualizar_sysacesso {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar como Admin (Exibe informações de todos os usuários)</label>
                                                                                <input type="checkbox" name="admin_sysacesso" id="admin_sysacesso" <? if(trim($row['admin_sysacesso'])==1) { echo " checked"; } ?> class="admin_sysacesso {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b>Módulo de Histórico de Operações</b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_syslog" id="visualizar_syslog" <? if(trim($row['visualizar_syslog'])==1) { echo " checked"; } ?> class="visualizar_syslog {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar como Admin (Exibe informações de todos os usuários)</label>
                                                                                <input type="checkbox" name="admin_syslog" id="admin_syslog" <? if(trim($row['admin_syslog'])==1) { echo " checked"; } ?> class="admin_syslog {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b>Módulo de Banco de Mídia</b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_sysmidia" id="visualizar_sysmidia" <? if(trim($row['visualizar_sysmidia'])==1) { echo " checked"; } ?> class="visualizar_sysmidia {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b>Módulo de Fontes</b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_sysfonte" id="visualizar_sysfonte" <? if(trim($row['visualizar_sysfonte'])==1) { echo " checked"; } ?> class="visualizar_sysfonte {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b>Módulo de Configurações</b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                                <input type="checkbox" id="sell_sysconfig" 
                                                                                <? 
                                                                                if(
                                                                                  trim($row['visualizar_sysconfig'])==1
                                                                                &&trim($row['admin_sysconfig'])==1
                                                                                &&trim($row['site_sysconfig'])==1
                                                                                &&trim($row['layout_sysconfig'])==1
                                                                                &&trim($row['imagens_sysconfig'])==1
                                                                                &&trim($row['mensagens_sysconfig'])==1
                                                                                &&trim($row['seo_sysconfig'])==1
                                                                                &&trim($row['indexacao_sysconfig'])==1
                                                                                &&trim($row['analytics_sysconfig'])==1
                                                                                &&trim($row['erro404_sysconfig'])==1
                                                                                &&trim($row['instalacao_sysconfig'])==1
                                                                                &&trim($row['dominios_sysconfig'])==1
                                                                                &&trim($row['servidor_sysconfig'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                class="sell_sysconfig {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_sysconfig" id="visualizar_sysconfig" <? if(trim($row['visualizar_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig visualizar_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Admin</label>
                                                                                <input type="checkbox" name="admin_sysconfig" id="admin_sysconfig" <? if(trim($row['admin_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig admin_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Site</label>
                                                                                <input type="checkbox" name="site_sysconfig" id="site_sysconfig" <? if(trim($row['site_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig site_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Layout</label>
                                                                                <input type="checkbox" name="layout_sysconfig" id="layout_sysconfig" <? if(trim($row['layout_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig layout_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Imagens</label>
                                                                                <input type="checkbox" name="imagens_sysconfig" id="imagens_sysconfig" <? if(trim($row['imagens_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig imagens_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Mensagens</label>
                                                                                <input type="checkbox" name="mensagens_sysconfig" id="mensagens_sysconfig" <? if(trim($row['mensagens_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig mensagens_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba SEO</label>
                                                                                <input type="checkbox" name="seo_sysconfig" id="seo_sysconfig" <? if(trim($row['seo_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig seo_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Indexação</label>
                                                                                <input type="checkbox" name="indexacao_sysconfig" id="indexacao_sysconfig" <? if(trim($row['indexacao_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig indexacao_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Analytics</label>
                                                                                <input type="checkbox" name="analytics_sysconfig" id="analytics_sysconfig" <? if(trim($row['analytics_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig analytics_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba ERRO 404</label>
                                                                                <input type="checkbox" name="erro404_sysconfig" id="erro404_sysconfig" <? if(trim($row['erro404_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig erro404_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Instalação</label>
                                                                                <input type="checkbox" name="instalacao_sysconfig" id="instalacao_sysconfig" <? if(trim($row['instalacao_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig instalacao_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Domínios</label>
                                                                                <input type="checkbox" name="dominios_sysconfig" id="dominios_sysconfig" <? if(trim($row['dominios_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig dominios_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Aba Servidor</label>
                                                                                <input type="checkbox" name="servidor_sysconfig" id="servidor_sysconfig" <? if(trim($row['servidor_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig servidor_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
            
                                                                    </div>
            
                                                                    <?
                                                                    $qSqlCat = mysql_query("SELECT * FROM sysmod_categoria WHERE stat='1' ORDER BY ordem");
                                                                    while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                    ?>
                                                                    <div id="tb3_<?=$rSqlCat['id']?>" class="tab-pane" style="min-height:350px;">
            
                                                                        <?
                                                                        $qSql = mysql_query("SELECT * FROM sysmod WHERE stat='1' AND idsysmod_categoria='".$rSqlCat['id']."' ORDER BY ordem");
                                                                        while($rSql = mysql_fetch_array($qSql)) {
                                                                        ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label><b><?=$rSql['nome']?></b></label>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:200px;">
                                                                                <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                                <input type="checkbox" id="sell_<?=$rSql['bd']?>" 
                                                                                <? 
                                                                                if(
                                                                                  trim($row['visualizar_'.$rSql['bd'].''])==1
                                                                                &&trim($row['todos_'.$rSql['bd'].''])==1
                                                                                &&trim($row['inserir_'.$rSql['bd'].''])==1
                                                                                &&trim($row['editar_'.$rSql['bd'].''])==1
                                                                                &&trim($row['excluir_'.$rSql['bd'].''])==1
                                                                                &&trim($row['publicar_'.$rSql['bd'].''])==1
                                                                                &&trim($row['despublicar_'.$rSql['bd'].''])==1
                                                                                &&trim($row['lixeira_'.$rSql['bd'].''])==1
                                                                                &&trim($row['restaurar_'.$rSql['bd'].''])==1
                                                                                &&trim($row['descricao_'.$rSql['bd'].''])==1
                                                                                &&trim($row['seo_'.$rSql['bd'].''])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                class="sell_<?=$rSql['bd']?> {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar</label>
                                                                                <input type="checkbox" name="visualizar_<?=$rSql['bd']?>" id="visualizar_<?=$rSql['bd']?>" <? if(trim($row['visualizar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> visualizar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Visualizar Todos ?</label>
                                                                                <input type="checkbox" name="todos_<?=$rSql['bd']?>" id="todos_<?=$rSql['bd']?>" <? if(trim($row['todos_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> todos_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Inserir</label>
                                                                                <input type="checkbox" name="inserir_<?=$rSql['bd']?>" id="inserir_<?=$rSql['bd']?>" <? if(trim($row['inserir_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> inserir_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Editar</label>
                                                                                <input type="checkbox" name="editar_<?=$rSql['bd']?>" id="editar_<?=$rSql['bd']?>" <? if(trim($row['editar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> editar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Excluir</label>
                                                                                <input type="checkbox" name="excluir_<?=$rSql['bd']?>" id="excluir_<?=$rSql['bd']?>" <? if(trim($row['excluir_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> excluir_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Publicar</label>
                                                                                <input type="checkbox" name="publicar_<?=$rSql['bd']?>" id="publicar_<?=$rSql['bd']?>" <? if(trim($row['publicar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> publicar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Despublicar</label>
                                                                                <input type="checkbox" name="despublicar_<?=$rSql['bd']?>" id="despublicar_<?=$rSql['bd']?>" <? if(trim($row['despublicar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> despublicar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Enviar para Lixeira</label>
                                                                                <input type="checkbox" name="lixeira_<?=$rSql['bd']?>" id="lixeira_<?=$rSql['bd']?>" <? if(trim($row['lixeira_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> lixeira_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Restaurar da Lixeira</label>
                                                                                <input type="checkbox" name="restaurar_<?=$rSql['bd']?>" id="restaurar_<?=$rSql['bd']?>" <? if(trim($row['restaurar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> restaurar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">Descrição</label>
                                                                                <input type="checkbox" name="descricao_<?=$rSql['bd']?>" id="descricao_<?=$rSql['bd']?>" <? if(trim($row['descricao_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> descricao_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label style="font-size:10px;">SEO</label>
                                                                                <input type="checkbox" name="seo_<?=$rSql['bd']?>" id="seo_<?=$rSql['bd']?>" <? if(trim($row['seo_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> seo_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                        </div>
                                                                        <? } ?>
            
                                                                    </div>
                                                                    <? } ?>
            
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                <? } ?>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <? } ?>
                                                
                                                <div id="tb1_b" class="tab-pane <? if(trim($_REQUEST['var3'])=="") { ?>active<? } ?>">
                                                    <div class="w-box w-box">
                                                        <div class="w-box-header">
                                                            <div class="pull-left">
                                                                <div class="toggle-group">
                                                                    <span data-toggle="dropdown" class="dropdown-toggle">Ações <span class="caret"></span></span>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('excluir');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>template/img/icones_novos/16/remover-x.png" />&nbsp;Remover</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('publicar');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>template/img/icones_novos/16/stat-1.png" />&nbsp;Publicar</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('despublicar');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>template/img/icones_novos/16/stat-0.png" />&nbsp;Despublicar</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="w-box-content">
                                                            <form name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <table id="dt_basic" class="table table-striped table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:20px;" class="table_checkbox"><input type="checkbox" name="select_msgs" class="select_msgs ptip_se" title="Selecionar todos" data-tableid="dt_basic" /></th>
                                                                    <th>Nome</th>
                                                                    <th style="width:110px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$mod." ORDER BY nome");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                     $url_limpa = transformaCaractere($rSql['nome']);
                                                                ?>
                                                                <script>
																$(function(){
																	 
																	$('#nome-<?=$rSql['id']?>').editable({
																		validate: function(value) {
																		   if($.trim(value) == '') { 
																		    return 'Este campo é obrigatório';
																		   } else {
																			   salva_campo_tabela('nome','<?=$rSql['id']?>','<?=$mod?>',value);
																		   }
																		}
																	});
																	
																});
                                                                </script>
                                                                <tr id="linha-<?=$rSql['id']?>">
                                                                    <td style="vertical-align:middle;" class="nolink"><input type="checkbox" name="msg_sel[]" class="select_msg" value="<?=$rSql['id']?>" /></td>
                                                                    <td><a data-original-title="Editar campo Nome" data-placeholder="Digite um nome" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <td class="nolink">
                                                                        <div class="btn-group">
                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a><? } ?>
                                                                        <? if(trim($sysperm['excluir_'.$mod.''])==1) { ?><a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$mod?>','NAO','<?=$rSql['ordem']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a><? } ?>
                                                                        <? if(trim($rSql['stat'])=="1") { ?>
																			<? if(trim($sysperm['despublicar_'.$mod.''])==1) { ?>
                                                                            <a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                            <? } else { ?>
                                                                            <a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                            <? } ?>
                                                                        <? } else { ?>
																			<? if(trim($sysperm['publicar_'.$mod.''])==1) { ?>
                                                                            <a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                            <? } else { ?>
                                                                            <a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                            <? } ?>
                                                                        <? } ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                            </tbody>
                                                            </table>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <? if(trim($_REQUEST['var3'])=="") { ?>
                                                <div id="tb1_c" class="tab-pane">
                                                    <div>
                                                    <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" value="add" />
                                                        <input type="hidden" name="modulo" value="sysgrupousuario" />
            
                                                        <? 
                                                        $numeroUnicoGerado = geraCodReturn(); 
                                                        ?>
                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
            
                                                        <div class="tabbable tabs-left tabbable-bordered">
                                                            <ul class="nav nav-tabs">
                                                                <li class="active"><a data-toggle="tab" href="#tb3_a">Dados Principais</a></li>
                                                                <li><a data-toggle="tab" href="#tb3_b">Módulos de Sistema</a></li>
                                                                <?
                                                                $qSqlCat = mysql_query("SELECT * FROM sysmod_categoria WHERE stat='1' ORDER BY ordem");
                                                                while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                ?>
                                                                <li><a data-toggle="tab" href="#tb3_<?=$rSqlCat['id']?>"><?=$rSqlCat['nome']?></a></li>
                                                                <? } ?>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div id="tb3_a" class="tab-pane active" style="min-height:350px;">

                                                                    <div class="formSep">
                                                                        <label class="req">Nome</label>
                                                                        <input value="" style="width:350px;" type="text" name="nome" id="nome" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Quando entrar no administrativo, que página deve abrir ?</label>
                                                                        <select name="modulo_abertura" id="modulo_abertura" style="width:255px;">
                                                                            <option value="">---</option>
                                                                            <?
                                                                            $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE stat='1' ORDER BY ordem");
                                                                            while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                                $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                                            ?>
                                                                            <option value="<?=$url_mod?>"><?=$rSqlMod['nome']?></option>
                                                                            <? } ?>
                                                                        </select>
                                                                        <span class="help-block">Altere sempre que desejar</span>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label class="req">Ativo ?</label>
                                                                        <label class="radio" style="color:#C00;">
                                                                            <input type="radio" name="stat" id="stat1" value="0" >
                                                                            não
                                                                        </label>
                                                                        <label class="radio" style="color:#390;">
                                                                            <input type="radio" name="stat" id="stat2" checked="checked" value="1" >
                                                                            sim
                                                                        </label>
                                                                    </div>	

                                                                </div>

                                                                <div id="tb3_b" class="tab-pane" style="min-height:350px;">
        
                        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b>Módulo de Usuários</b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                            <input type="checkbox" id="sell_sysusu" 
                                                                            <? 
                                                                            if(
                                                                              trim($rSyspermadmin['visualizar_sysusu'])==1
                                                                            &&trim($rSyspermadmin['inserir_sysusu'])==1
                                                                            &&trim($rSyspermadmin['editar_sysusu'])==1
                                                                            &&trim($rSyspermadmin['excluir_sysusu'])==1
                                                                            &&trim($rSyspermadmin['publicar_sysusu'])==1
                                                                            &&trim($rSyspermadmin['despublicar_sysusu'])==1
                                                                            &&trim($rSyspermadmin['lixeira_sysusu'])==1
                                                                            &&trim($rSyspermadmin['restaurar_sysusu'])==1
                                                                            &&trim($rSyspermadmin['senha_sysusu'])==1
                                                                            &&trim($rSyspermadmin['dados_sysusu'])==1
                                                                            &&trim($rSyspermadmin['configuracao_sysusu'])==1
                                                                            ) { echo " checked"; } ?> 
                                                                            class="sell_sysusu {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_sysusu" id="visualizar_sysusu" <? if(trim($rSyspermadmin['visualizar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu visualizar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Inserir</label>
                                                                            <input type="checkbox" name="inserir_sysusu" id="inserir_sysusu" <? if(trim($rSyspermadmin['inserir_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu inserir_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Editar</label>
                                                                            <input type="checkbox" name="editar_sysusu" id="editar_sysusu" <? if(trim($rSyspermadmin['editar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu editar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Excluir</label>
                                                                            <input type="checkbox" name="excluir_sysusu" id="excluir_sysusu" <? if(trim($rSyspermadmin['excluir_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu excluir_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Publicar</label>
                                                                            <input type="checkbox" name="publicar_sysusu" id="publicar_sysusu" <? if(trim($rSyspermadmin['publicar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu publicar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Despublicar</label>
                                                                            <input type="checkbox" name="despublicar_sysusu" id="despublicar_sysusu" <? if(trim($rSyspermadmin['despublicar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu despublicar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Enviar para Lixeira</label>
                                                                            <input type="checkbox" name="lixeira_sysusu" id="lixeira_sysusu" <? if(trim($rSyspermadmin['lixeira_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu lixeira_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Restaurar da Lixeira</label>
                                                                            <input type="checkbox" name="restaurar_sysusu" id="restaurar_sysusu" <? if(trim($rSyspermadmin['restaurar_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu restaurar_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Alterar Senha</label>
                                                                            <input type="checkbox" name="senha_sysusu" id="senha_sysusu" <? if(trim($rSyspermadmin['senha_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu senha_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Alterar Dados</label>
                                                                            <input type="checkbox" name="dados_sysusu" id="dados_sysusu" <? if(trim($rSyspermadmin['dados_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu dados_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Alterar Configurações</label>
                                                                            <input type="checkbox" name="configuracao_sysusu" id="configuracao_sysusu" <? if(trim($rSyspermadmin['configuracao_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu configuracao_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Chat</label>
                                                                            <input type="checkbox" name="chat_sysusu" id="chat_sysusu" <? if(trim($rSyspermadmin['chat_sysusu'])==1) { echo " checked"; } ?> class="item_sysusu chat_sysusu {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
                        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b>Módulo de Grupo de Usuários</b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                            <input type="checkbox" id="sell_sysgrupousuario" 
                                                                            <? 
                                                                            if(
                                                                              trim($rSyspermadmin['visualizar_sysgrupousuario'])==1
                                                                            &&trim($rSyspermadmin['inserir_sysgrupousuario'])==1
                                                                            &&trim($rSyspermadmin['editar_sysgrupousuario'])==1
                                                                            &&trim($rSyspermadmin['excluir_sysgrupousuario'])==1
                                                                            &&trim($rSyspermadmin['publicar_sysgrupousuario'])==1
                                                                            &&trim($rSyspermadmin['despublicar_sysgrupousuario'])==1
                                                                            &&trim($rSyspermadmin['lixeira_sysgrupousuario'])==1
                                                                            &&trim($rSyspermadmin['restaurar_sysgrupousuario'])==1
                                                                            ) { echo " checked"; } ?> 
                                                                            class="sell_sysgrupousuario {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_sysgrupousuario" id="visualizar_sysgrupousuario" <? if(trim($rSyspermadmin['visualizar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario visualizar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Inserir</label>
                                                                            <input type="checkbox" name="inserir_sysgrupousuario" id="inserir_sysgrupousuario" <? if(trim($rSyspermadmin['inserir_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario inserir_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Editar</label>
                                                                            <input type="checkbox" name="editar_sysgrupousuario" id="editar_sysgrupousuario" <? if(trim($rSyspermadmin['editar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario editar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Excluir</label>
                                                                            <input type="checkbox" name="excluir_sysgrupousuario" id="excluir_sysgrupousuario" <? if(trim($rSyspermadmin['excluir_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario excluir_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Publicar</label>
                                                                            <input type="checkbox" name="publicar_sysgrupousuario" id="publicar_sysgrupousuario" <? if(trim($rSyspermadmin['publicar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario publicar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Despublicar</label>
                                                                            <input type="checkbox" name="despublicar_sysgrupousuario" id="despublicar_sysgrupousuario" <? if(trim($rSyspermadmin['despublicar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario despublicar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Enviar para Lixeira</label>
                                                                            <input type="checkbox" name="lixeira_sysgrupousuario" id="lixeira_sysgrupousuario" <? if(trim($rSyspermadmin['lixeira_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario lixeira_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Restaurar da Lixeira</label>
                                                                            <input type="checkbox" name="restaurar_sysgrupousuario" id="restaurar_sysgrupousuario" <? if(trim($rSyspermadmin['restaurar_sysgrupousuario'])==1) { echo " checked"; } ?> class="item_sysgrupousuario restaurar_sysgrupousuario {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b>Módulo de Permissões</b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                            <input type="checkbox" id="sell_syspermadmin" 
                                                                            <? 
                                                                            if(
                                                                              trim($rSyspermadmin['visualizar_syspermadmin'])==1
                                                                            &&trim($rSyspermadmin['editar_syspermadmin'])==1
                                                                            ) { echo " checked"; } ?> 
                                                                            class="sell_sysusu {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_syspermadmin" id="visualizar_syspermadmin" <? if(trim($rSyspermadmin['visualizar_syspermadmin'])==1) { echo " checked"; } ?> class="item_syspermadmin visualizar_syspermadmin {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Editar</label>
                                                                            <input type="checkbox" name="editar_syspermadmin" id="editar_syspermadmin" <? if(trim($rSyspermadmin['editar_syspermadmin'])==1) { echo " checked"; } ?> class="item_syspermadmin editar_syspermadmin {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b>Módulo de Suporte</b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_syssuporte" id="visualizar_syssuporte" <? if(trim($rSyspermadmin['visualizar_syssuporte'])==1) { echo " checked"; } ?> class="visualizar_syssuporte {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Inserir</label>
                                                                            <input type="checkbox" name="inserir_syssuporte" id="inserir_syssuporte" <? if(trim($rSyspermadmin['inserir_syssuporte'])==1) { echo " checked"; } ?> class="inserir_syssuporte {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b>Módulo de Histórico de Acessos</b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_sysacesso" id="visualizar_sysacesso" <? if(trim($rSyspermadmin['visualizar_sysacesso'])==1) { echo " checked"; } ?> class="visualizar_sysacesso {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar como Admin (Exibe informações de todos os usuários)</label>
                                                                            <input type="checkbox" name="admin_sysacesso" id="admin_sysacesso" <? if(trim($rSyspermadmin['admin_sysacesso'])==1) { echo " checked"; } ?> class="admin_sysacesso {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
                        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b>Módulo de Histórico de Operações</b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_syslog" id="visualizar_syslog" <? if(trim($rSyspermadmin['visualizar_syslog'])==1) { echo " checked"; } ?> class="visualizar_syslog {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar como Admin (Exibe informações de todos os usuários)</label>
                                                                            <input type="checkbox" name="admin_syslog" id="admin_syslog" <? if(trim($rSyspermadmin['admin_syslog'])==1) { echo " checked"; } ?> class="admin_syslog {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
                        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b>Módulo de Banco de Mídia</b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_sysmidia" id="visualizar_sysmidia" <? if(trim($rSyspermadmin['visualizar_sysmidia'])==1) { echo " checked"; } ?> class="visualizar_sysmidia {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
                        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b>Módulo de Fontes</b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_sysfonte" id="visualizar_sysfonte" <? if(trim($rSyspermadmin['visualizar_sysfonte'])==1) { echo " checked"; } ?> class="visualizar_sysfonte {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
                        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b>Módulo de Configurações</b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                            <input type="checkbox" id="sell_sysconfig" 
                                                                            <? 
                                                                            if(
                                                                              trim($rSyspermadmin['visualizar_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['admin_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['site_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['layout_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['imagens_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['mensagens_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['seo_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['indexacao_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['analytics_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['erro404_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['instalacao_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['dominios_sysconfig'])==1
                                                                            &&trim($rSyspermadmin['servidor_sysconfig'])==1
                                                                            ) { echo " checked"; } ?> 
                                                                            class="sell_sysconfig {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_sysconfig" id="visualizar_sysconfig" <? if(trim($rSyspermadmin['visualizar_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig visualizar_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Admin</label>
                                                                            <input type="checkbox" name="admin_sysconfig" id="admin_sysconfig" <? if(trim($rSyspermadmin['admin_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig admin_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Site</label>
                                                                            <input type="checkbox" name="site_sysconfig" id="site_sysconfig" <? if(trim($rSyspermadmin['site_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig site_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Layout</label>
                                                                            <input type="checkbox" name="layout_sysconfig" id="layout_sysconfig" <? if(trim($rSyspermadmin['layout_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig layout_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Imagens</label>
                                                                            <input type="checkbox" name="imagens_sysconfig" id="imagens_sysconfig" <? if(trim($rSyspermadmin['imagens_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig imagens_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Mensagens</label>
                                                                            <input type="checkbox" name="mensagens_sysconfig" id="mensagens_sysconfig" <? if(trim($rSyspermadmin['mensagens_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig mensagens_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba SEO</label>
                                                                            <input type="checkbox" name="seo_sysconfig" id="seo_sysconfig" <? if(trim($rSyspermadmin['seo_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig seo_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Indexação</label>
                                                                            <input type="checkbox" name="indexacao_sysconfig" id="indexacao_sysconfig" <? if(trim($rSyspermadmin['indexacao_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig indexacao_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Analytics</label>
                                                                            <input type="checkbox" name="analytics_sysconfig" id="analytics_sysconfig" <? if(trim($rSyspermadmin['analytics_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig analytics_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba ERRO 404</label>
                                                                            <input type="checkbox" name="erro404_sysconfig" id="erro404_sysconfig" <? if(trim($rSyspermadmin['erro404_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig erro404_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Instalação</label>
                                                                            <input type="checkbox" name="instalacao_sysconfig" id="instalacao_sysconfig" <? if(trim($rSyspermadmin['instalacao_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig instalacao_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Domínios</label>
                                                                            <input type="checkbox" name="dominios_sysconfig" id="dominios_sysconfig" <? if(trim($rSyspermadmin['dominios_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig dominios_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Aba Servidor</label>
                                                                            <input type="checkbox" name="servidor_sysconfig" id="servidor_sysconfig" <? if(trim($rSyspermadmin['servidor_sysconfig'])==1) { echo " checked"; } ?> class="item_sysconfig servidor_sysconfig {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
        
                                                                </div>
        
                                                                <?
                                                                $qSqlCat = mysql_query("SELECT * FROM sysmod_categoria WHERE stat='1' ORDER BY ordem");
                                                                while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                ?>
                                                                <div id="tb3_<?=$rSqlCat['id']?>" class="tab-pane" style="min-height:350px;">
        
                                                                    <?
                                                                    $qSql = mysql_query("SELECT * FROM sysmod WHERE stat='1' AND idsysmod_categoria='".$rSqlCat['id']."' ORDER BY ordem");
                                                                    while($rSql = mysql_fetch_array($qSql)) {
                                                                    ?>
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;width:100%;">
                                                                            <label><b><?=$rSql['nome']?></b></label>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;width:200px;">
                                                                            <label style="font-size:10px;">Marcar/Desmarcar Todos</label>
                                                                            <input type="checkbox" id="sell_<?=$rSql['bd']?>" 
                                                                            <? 
                                                                            if(
                                                                              trim($rSyspermadmin['visualizar_'.$rSql['bd'].''])==1
                                                                            &&trim($rSyspermadmin['inserir_'.$rSql['bd'].''])==1
                                                                            &&trim($rSyspermadmin['editar_'.$rSql['bd'].''])==1
                                                                            &&trim($rSyspermadmin['excluir_'.$rSql['bd'].''])==1
                                                                            &&trim($rSyspermadmin['publicar_'.$rSql['bd'].''])==1
                                                                            &&trim($rSyspermadmin['despublicar_'.$rSql['bd'].''])==1
                                                                            &&trim($rSyspermadmin['lixeira_'.$rSql['bd'].''])==1
                                                                            &&trim($rSyspermadmin['restaurar_'.$rSql['bd'].''])==1
                                                                            &&trim($rSyspermadmin['descricao_'.$rSql['bd'].''])==1
                                                                            &&trim($rSyspermadmin['seo_'.$rSql['bd'].''])==1
                                                                            ) { echo " checked"; } ?> 
                                                                            class="sell_<?=$rSql['bd']?> {labelOn: 'TODOS', labelOff: 'NENHUM'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Visualizar</label>
                                                                            <input type="checkbox" name="visualizar_<?=$rSql['bd']?>" id="visualizar_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['visualizar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> visualizar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Inserir</label>
                                                                            <input type="checkbox" name="inserir_<?=$rSql['bd']?>" id="inserir_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['inserir_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> inserir_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Editar</label>
                                                                            <input type="checkbox" name="editar_<?=$rSql['bd']?>" id="editar_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['editar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> editar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Excluir</label>
                                                                            <input type="checkbox" name="excluir_<?=$rSql['bd']?>" id="excluir_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['excluir_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> excluir_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Publicar</label>
                                                                            <input type="checkbox" name="publicar_<?=$rSql['bd']?>" id="publicar_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['publicar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> publicar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Despublicar</label>
                                                                            <input type="checkbox" name="despublicar_<?=$rSql['bd']?>" id="despublicar_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['despublicar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> despublicar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Enviar para Lixeira</label>
                                                                            <input type="checkbox" name="lixeira_<?=$rSql['bd']?>" id="lixeira_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['lixeira_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> lixeira_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Restaurar da Lixeira</label>
                                                                            <input type="checkbox" name="restaurar_<?=$rSql['bd']?>" id="restaurar_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['restaurar_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> restaurar_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">Descrição</label>
                                                                            <input type="checkbox" name="descricao_<?=$rSql['bd']?>" id="descricao_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['descricao_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> descricao_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                            <label style="font-size:10px;">SEO</label>
                                                                            <input type="checkbox" name="seo_<?=$rSql['bd']?>" id="seo_<?=$rSql['bd']?>" <? if(trim($rSyspermadmin['seo_'.$rSql['bd'].''])==1) { echo " checked"; } ?> class="item_<?=$rSql['bd']?> seo_<?=$rSql['bd']?> {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                        </div>
                                                                    </div>
                                                                    <? } ?>
        
                                                                </div>
                                                                <? } ?>
        
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="formSep">
                                                            <button type="submit" class="btn btn-success">Salvar</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                <? } ?>


                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
