			<script>
			$(document).keydown(function(e){
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code===116){
					e.preventDefault();
					abre_pasta_ajax('','<?=$sysusu['id']?>');
				}
            });
            </script>
        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12 ">

                        <div id="arvore_pasta" class="w-box-content cnt_a span2" style="height:100%;">
                        	<? include("./acoes/sysmidia/lista_pasta.php"); ?>
                        </div>
                        <div class="w-box-content cnt_a span10" style="margin-left:5px;">
                        	<input type="hidden" value="0" id="idpai" />

                            <ul class="sysmidia-comandos">
                                <li><a href="<?=$link?>acoes/sysmidia/form-arquivo.php?idsysusuS=<?=$sysusu['id']?>" class="popup_fancy"><i class="splashy-upload"></i>Upload</a></li>
                                <li onclick="zipar_selecionados();"><i class="splashy-download"></i>Download</li>
                                <li><a href="<?=$link?>acoes/sysmidia/form-pasta.php?idsysusuS=<?=$sysusu['id']?>" class="popup_fancy"><i class="splashy-folder_modernist_add_simple"></i>Nova pasta</a></li>
                                <li onclick="excluir_selecionados();"><i class="splashy-folder_modernist_remove"></i>Excluir</li>
                                <li onclick="refresh_pasta_ajax();"><i class="splashy-refresh"></i>Atualizar</li>
                                <li onclick="mostra_esconde('filtros');"><i class="splashy-sprocket_dark"></i>Filtros</li>
                                <li style="display:none;" id="preloader-carregando"><img style="margin-top:-2px;" src="<?=$link?>template/img/preloader-2.gif" alt="" > Carregando</li>
                                <li style="display:none;" id="preloader-atualizando"><img style="margin-top:-2px;" src="<?=$link?>template/img/preloader-2.gif" alt="" > Atualizando</li>
                                <li style="display:none;" id="preloader-baixando"><img style="margin-top:-2px;" src="<?=$link?>template/img/preloader-2.gif" alt="" > Baixando</li>
                            </ul>
                            <ul id="filtros">
                            	<li style="border-right:1px dashed #CCC;">
                                	<div style="float:left;font-weight:bold;padding-left:10px;margin-top:5px;width:100%;">Visualização</div>
                                    <input type="hidden" id="filtro_view_set" value="lista" />
                                    <ul class="filtros-lista">
                                    	<li><input type="radio" name="filtro_view" onclick="filtro_view('thumb','<?=$sysusu['id']?>');" /> Miniaturas</li>
                                    	<li><input type="radio" checked="checked" name="filtro_view" onclick="filtro_view('lista','<?=$sysusu['id']?>');" /> Lista</li>
                                    </ul>
                                </li>
                            	<li style="border-right:1px dashed #CCC;">
                                	<div style="float:left;font-weight:bold;padding-left:10px;margin-top:5px;width:100%;">Exibir</div>
                                    <input type="hidden" id="filtro_show_name_set" value="nome" />
                                    <input type="hidden" id="filtro_show_date_set" value="" />
                                    <input type="hidden" id="filtro_show_size_set" value="" />
                                    <ul class="filtros-lista">
                                    	<li onclick="filtro_show('name');"><input type="checkbox" checked="checked" id="filtro_show_name" onclick="filtro_show('name','<?=$sysusu['id']?>');" /> Nome</li>
                                    	<li onclick="filtro_show('date');"><input type="checkbox" id="filtro_show_date" onclick="filtro_show('date','<?=$sysusu['id']?>');" /> Data</li>
                                    	<li onclick="filtro_show('size');"><input type="checkbox" id="filtro_show_size" onclick="filtro_show('size','<?=$sysusu['id']?>');" /> Tamanho</li>
                                    </ul>
                                </li>
                            	<li style="border-right:1px dashed #CCC;">
                                	<div style="float:left;font-weight:bold;padding-left:10px;margin-top:5px;width:100%;">Ordenar por</div>
                                    <input type="hidden" id="filtro_order_set" value="" />
                                    <input type="hidden" id="filtro_order_desc_set" value="" />
                                    <ul class="filtros-lista">
                                    	<li><input type="radio" name="filtro_order" onclick="filtro_order('nome','<?=$sysusu['id']?>');"/> Nome</li>
                                    	<li><input type="radio" name="filtro_order" onclick="filtro_order('extensao','<?=$sysusu['id']?>');" /> Tipo</li>
                                    	<li><input type="radio" name="filtro_order" onclick="filtro_order('tamanho','<?=$sysusu['id']?>');" /> Tamanho</li>
                                    	<li><input type="radio" name="filtro_order" onclick="filtro_order('dataModificacao','<?=$sysusu['id']?>');" /> Data</li>
                                    	<li><input type="checkbox" id="filtro_order_desc" onclick="filtro_order_desc('<?=$sysusu['id']?>');" /> Decrescente</li>
                                    </ul>
                                </li>
                            </ul>
                            <script>abre_pasta_ajax("0","<?=$sysusu['id']?>");</script>

                            <iframe src="" name="sysmidia_post" style="width:0px;height:0px;" frameborder="0"></iframe>
                            
                            <form name="list" action="<?=$link?>acoes/sysmidia/post-lista.php" method="post" target="sysmidia_post">
                                <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                            <div id="conteudo_pasta" style="float:left;width:100%;display:block;"></div>
                            </form>

                        </div>

                    </div>

                </div>
            </div>
