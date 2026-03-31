        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?><? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_editar">Editando <?=$row['nome']?></a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Lista de Itens</a></li><? } ?>
                                                <? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_novo">Adicionar Novo</a></li><? } ?><? } ?>
                                                <? if(trim($row_estrutura['categoria'])==1) { ?><? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_categorias">Categorias</a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['descricao_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_config">Descrição</a></li><? } ?>
                                                <? if(trim($row_estrutura['seo'])==1) { ?><? if(trim($sysperm['seo_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_config_seo"><? if(trim($row_estrutura['seo_label'])=="") { echo "Configurações de SEO"; } else { echo $row_estrutura['seo_label']; } ?></a></li><? } ?><? } ?>
												<? if(trim($sysusu['adm'])==1) { ?><li><a data-toggle="tab" href="#tb1_estrutura">Configurações de Estrutura do Módulo</a></li><? } ?>
                                            </ul>
											<script>
                                              $(document).ready(function() {
                                                //* form validation
                                                forms.simple();
            
												<? if(trim($row_estrutura['valor'])==1) { ?>$("#valor").maskMoney({ decimal:",", thousands:".", allowZero:true});<? } ?>
												<? if(trim($row_estrutura['valor_promocao'])==1) { ?>$("#valor_promocao").maskMoney({ decimal:",", thousands:".", allowZero:true});<? } ?>
												<? if(trim($row_estrutura['valor_mensalidade'])==1) { ?>$("#valor_mensalidade").maskMoney({ decimal:",", thousands:".", allowZero:true});<? } ?>

												beoro_select_row.init();

                                                //* datatables
                                                beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
            
												//* WYSIWG Editor
												beoro_wysiwg.init();

												<? if(trim($row_estrutura['data_post'])==1||trim($row_estrutura['data_publicacao'])==1||trim($row_estrutura['data_despublicacao'])==1) { ?>
												//* datepicker
												beoro_datepicker.init();
												<? } ?> 

												<? if(trim($row_estrutura['hora_post'])==1) { ?>
												//* timepicker
												beoro_timepicker.init();
												<? } ?>

												<? if(trim($row_estrutura['tags'])==1) { ?>
												//* enchanced select box
												beoro_enchancedSelect.init();
												<? } ?>
										
												<? if(trim($row_estrutura['lista_relacionado'])==1||trim($row_estrutura['lista_categoria'])==1||trim($row_estrutura['lista_sysplano'])==1||trim($row_estrutura['lista_sysservico'])==1) { ?>
												//* 2col multiselect
												beoro_multiselect.init();
												<? } ?>

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
																<? if(trim($row_estrutura['ordem'])==1) { ?>ordem: { required: true },<? } ?>
																<? if(trim($row_estrutura['categoria'])==1) { ?><? if(trim($row_estrutura['id'.$mod.'_categoria'])==1) { ?>id<?=$mod?>_categoria: { required: true },<? } ?><? } ?>
																<? if(trim($row_estrutura['categoria'])==1) { ?><? if(trim($row_estrutura['lista_categoria'])==1) { ?>lista_categoria: { required: true },<? } ?><? } ?>
																<? if(trim($row_estrutura['cod'])==1) { ?>cod: { required: true },<? } ?>
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
												},
											};

                                            //* datatables
                                            beoro_datatables = {
                                                //* column reorder & toggle visibility
                                                basic: function() {
                                                    if($('#dt_basic').length) {
                                                        $('#dt_basic').dataTable({
                                                            "sPaginationType": "bootstrap_full",
															"aaSorting": [[ 1, "asc" ]],
															"iDisplayLength": 100,
															"oLanguage": {
																"sLengthMenu": '<select style="height:23px;">'+
																'<option value="100">100</option>'+
																'<option value="200">200</option>'+
																'<option value="300">300</option>'+
																'<option value="400">400</option>'+
																'<option value="500">500</option>'+
																'<option value="-1">Todos</option>'+
																'</select>'
															},
															"aoColumns": [
																{ "bSortable": false },
																<? if(trim($row_estrutura['galeria'])==1) { ?>{ "bSortable": true },<? } ?>
																<? if(trim($row_estrutura['video'])==1) { ?>{ "bSortable": true },<? } ?>
																<? if(trim($row_estrutura['ordem'])==1) { ?>{ "bSortable": true },<? } ?>
																<? if(trim($row_estrutura['categoria'])==1) { ?><? if(trim($row_estrutura['id'.$mod.'_categoria'])==1) { ?>{ "bSortable": false },<? } ?><? } ?>
																<? if(trim($row_estrutura['categoria'])==1) { ?><? if(trim($row_estrutura['lista_categoria'])==1) { ?>{ "bSortable": false },<? } ?><? } ?>
																<? if(trim($row_estrutura['cod'])==1) { ?>{ "sType": "string" },<? } ?>
																{ "sType": "string" },
																<? if(trim($row_estrutura['valor'])==1) { ?>{ "bSortable": true },<? } ?>
																<? if(trim($row_estrutura['valor_promocao'])==1) { ?>{ "bSortable": true },<? } ?>
																<? if(trim($row_estrutura['valor_mensalidade'])==1) { ?>{ "bSortable": true },<? } ?>
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };

											//* WYSIWG Editor
											beoro_wysiwg = {
												init: function() {
													if($('#texto_descricao').length) { 
														CKEDITOR.replace( 'texto_descricao', {
															toolbar: null
														});
													}
													if($('#texto_promocao').length) { 
														CKEDITOR.replace( 'texto_promocao', {
															toolbar: null
														});
													}

													<? if(trim($row_estrutura['texto'])==1) { ?>
													if($('#texto').length) { 
														CKEDITOR.replace( 'texto', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
													<? if(trim($row_estrutura['info_produto'])==1) { ?>
													if($('#info_produto').length) { 
														CKEDITOR.replace( 'info_produto', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
													<? if(trim($row_estrutura['info_tecnica'])==1) { ?>
													if($('#info_tecnica').length) { 
														CKEDITOR.replace( 'info_tecnica', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
													<? if(trim($row_estrutura['garantia'])==1) { ?>
													if($('#garantia').length) { 
														CKEDITOR.replace( 'garantia', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
													<? if(trim($row_estrutura['manual'])==1) { ?>
													if($('#manual').length) { 
														CKEDITOR.replace( 'manual', {
															toolbar: 'Standard'
														});
													}
													<? } ?>
													<? if(trim($row_estrutura['chamada'])==1) { ?>
													if($('#chamada').length) { 
														CKEDITOR.replace( 'chamada', {
															toolbar: null
														});
													}
													<? } ?>

												}
											};

											<? if(trim($row_estrutura['data_post'])==1||trim($row_estrutura['data_publicacao'])==1||trim($row_estrutura['data_despublicacao'])==1) { ?>
											//* datepicker
											beoro_datepicker = {
												init: function() {
													<? if(trim($row_estrutura['data_post'])==1) { ?>
													if($('#data_post').length) {
														$('#data_post').datepicker()
													}
													<? } ?>
													<? if(trim($row_estrutura['data_publicacao'])==1) { ?>
													if($('#data_publicacao').length) {
														$('#data_publicacao').datepicker()
													}
													<? } ?>
													<? if(trim($row_estrutura['data_despublicacao'])==1) { ?>
													if($('#data_despublicacao').length) {
														$('#data_despublicacao').datepicker()
													}
													<? } ?>
												}
											};
											<? } ?>

											<? if(trim($row_estrutura['hora_post'])==1) { ?>
											//* timepicker
											beoro_timepicker = {
												init: function() {
													if($('#hora_post').length) {
														$('#hora_post').timepicker({
															minuteStep: 1,
															showSeconds: true,
															showInputs: false,
															showMeridian: false
														})
													}
												}
											};
											<? } ?>


											<? if(trim($row_estrutura['lista_relacionado'])==1||trim($row_estrutura['lista_categoria'])==1||trim($row_estrutura['lista_sysplano'])==1||trim($row_estrutura['lista_sysservico'])==1) { ?>
											//* multiselect
											beoro_multiselect = {
												init: function(){
													<? if(trim($row_estrutura['lista_relacionado'])==1) { ?>
													if($('#lista_relacionado_itens').length) {
														//* searchable
														$('#lista_relacionado_itens').multiSelect({
															selectableHeader: '<div class="search-header"><input type="text" class="span12" id="ms-search" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
															selectionHeader: "<div class='search-selected'></div>",
															afterSelect: function(values){
																$('#lista_relacionado').val(""+$('#lista_relacionado').val()+'|'+values+'|');
															},
															afterDeselect: function(values){
																$('#lista_relacionado').val($('#lista_relacionado').val().replace('|'+values+'|',''));
															}
  														});
													}
													<? } ?>
													<? if(trim($row_estrutura['lista_categoria'])==1) { ?>
													if($('#lista_categoria_itens').length) {
														//* searchable
														$('#lista_categoria_itens').multiSelect({
															selectableHeader: '<div class="search-header"><input type="text" class="span12" id="ms-search" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
															selectionHeader: "<div class='search-selected'></div>",
															afterSelect: function(values){
																$('#lista_categoria').val(""+$('#lista_categoria').val()+'|'+values+'|');
															},
															afterDeselect: function(values){
																$('#lista_categoria').val($('#lista_categoria').val().replace('|'+values+'|',''));
															}
  														});
													}
													<? } ?>
													<? if(trim($row_estrutura['lista_sysplano'])==1) { ?>
													if($('#lista_sysplano_itens').length) {
														//* searchable
														$('#lista_sysplano_itens').multiSelect({
															selectableHeader: '<div class="search-header"><input type="text" class="span12" id="ms-search" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
															selectionHeader: "<div class='search-selected'></div>",
															afterSelect: function(values){
																$('#lista_sysplano').val(""+$('#lista_sysplano').val()+'|'+values+'|');
															},
															afterDeselect: function(values){
																$('#lista_sysplano').val($('#lista_sysplano').val().replace('|'+values+'|',''));
															}
  														});
													}
													<? } ?>
													<? if(trim($row_estrutura['lista_sysservico'])==1) { ?>
													if($('#lista_sysservico_itens').length) {
														//* searchable
														$('#lista_sysservico_itens').multiSelect({
															selectableHeader: '<div class="search-header"><input type="text" class="span12" id="ms-search" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
															selectionHeader: "<div class='search-selected'></div>",
															afterSelect: function(values){
																$('#lista_sysservico').val(""+$('#lista_sysservico').val()+'|'+values+'|');
															},
															afterDeselect: function(values){
																$('#lista_sysservico').val($('#lista_sysservico').val().replace('|'+values+'|',''));
															}
  														});
													}
													<? } ?>
												}
											}; 
											<? } ?>

											<? if(trim($row_estrutura['tags'])==1) { ?>
											//* enchanced select box
											beoro_enchancedSelect = {
												init: function() {
													if($('#tags').length) {
														$('#tags').select2({
															tags:[""],
															tokenSeparators: [",", " "]
														});
													}
												}
											};
											<? } ?>
										
											//* switch buttons
											beoro_switchButtons = {
												init: function() {
													<? if(trim($row_estrutura['destaque'])==1) { ?>if($('#destaque').length) { $("#destaque").iButton(); }<? } ?>
													<? if(trim($row_estrutura['lancamento'])==1) { ?>if($('#lancamento').length) { $("#lancamento").iButton(); }<? } ?>
													<? if(trim($row_estrutura['promocao'])==1) { ?>if($('#promocao').length) { $("#promocao").iButton(); }<? } ?>
													<? if(trim($row_estrutura['frete'])==1) { ?>if($('#frete').length) { $("#frete").iButton(); }<? } ?>

													if($('#url_amigavel_ativa').length) { $("#url_amigavel_ativa").iButton(); }

													<? if(trim($sysusu['adm'])==1) { ?>
													if($('#categoria_estrutura').length) { $("#categoria_estrutura").iButton(); }
													if($('#galeria_estrutura').length) { $("#galeria_estrutura").iButton(); }
													if($('#video_estrutura').length) { $("#video_estrutura").iButton(); }
													if($('#seo_estrutura').length) { $("#seo_estrutura").iButton(); }
													if($('#seo_item_estrutura').length) { $("#seo_item_estrutura").iButton(); }
													if($('#id<?=$mod?>_categoria_estrutura').length) { $("#id<?=$mod?>_categoria_estrutura").iButton(); }
													if($('#lista_relacionado_estrutura').length) { $("#lista_relacionado_estrutura").iButton(); }
													if($('#lista_categoria_estrutura').length) { $("#lista_categoria_estrutura").iButton(); }
													if($('#lista_sysplano_estrutura').length) { $("#lista_sysplano_estrutura").iButton(); }
													if($('#lista_sysservico_estrutura').length) { $("#lista_sysservico_estrutura").iButton(); }
													if($('#destaque_estrutura').length) { $("#destaque_estrutura").iButton(); }
													if($('#lancamento_estrutura').length) { $("#lancamento_estrutura").iButton(); }
													if($('#ordem_estrutura').length) { $("#ordem_estrutura").iButton(); }
													if($('#nome_estrutura').length) { $("#nome_estrutura").iButton(); }
													if($('#cod_estrutura').length) { $("#cod_estrutura").iButton(); }
													if($('#tags_estrutura').length) { $("#tags_estrutura").iButton(); }
													if($('#valor_estrutura').length) { $("#valor_estrutura").iButton(); }
													if($('#promocao_estrutura').length) { $("#promocao_estrutura").iButton(); }
													if($('#valor_promocao_estrutura').length) { $("#valor_promocao_estrutura").iButton(); }
													if($('#valor_mensalidade_estrutura').length) { $("#valor_mensalidade_estrutura").iButton(); }
													if($('#qtd_estoque_estrutura').length) { $("#qtd_estoque_estrutura").iButton(); }
													if($('#frete_estrutura').length) { $("#frete_estrutura").iButton(); }
													if($('#imagem_estrutura').length) { $("#imagem_estrutura").iButton(); }
													if($('#data_publicacao_estrutura').length) { $("#data_publicacao_estrutura").iButton(); }
													if($('#data_despublicacao_estrutura').length) { $("#data_despublicacao_estrutura").iButton(); }
													if($('#data_post_estrutura').length) { $("#data_post_estrutura").iButton(); }
													if($('#hora_post_estrutura').length) { $("#hora_post_estrutura").iButton(); }
													if($('#chamada_estrutura').length) { $("#chamada_estrutura").iButton(); }
													if($('#texto_estrutura').length) { $("#texto_estrutura").iButton(); }
													if($('#info_produto_estrutura').length) { $("#info_produto_estrutura").iButton(); }
													if($('#info_tecnica_estrutura').length) { $("#info_tecnica_estrutura").iButton(); }
													if($('#garantia_estrutura').length) { $("#garantia_estrutura").iButton(); }
													if($('#manual_estrutura').length) { $("#manual_estrutura").iButton(); }
													if($('#texto_promocao_estrutura').length) { $("#texto_promocao_estrutura").iButton(); }

													if($('#nome_seo_estrutura').length) { $("#nome_seo_estrutura").iButton(); }
													if($('#titulo_texto_estrutura').length) { $("#titulo_texto_estrutura").iButton(); }
													if($('#imagem_descricao_estrutura').length) { $("#imagem_descricao_estrutura").iButton(); }
													if($('#imagem_interna_estrutura').length) { $("#imagem_interna_estrutura").iButton(); }
													if($('#chamada_descricao_estrutura').length) { $("#chamada_descricao_estrutura").iButton(); }
													if($('#texto_descricao_estrutura').length) { $("#texto_descricao_estrutura").iButton(); }

													if($('#produtos_set').length) { $("#produtos_set").iButton(); }
													if($('#texto_promocao_set').length) { $("#texto_promocao_set").iButton(); }
													
													
													<? } ?>
												}
											};
                                            </script>
                                            <div class="tab-content">

                                                <? if(trim($_REQUEST['var3'])=="") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="iditem" id="iditem_set" value="<?=$_REQUEST['var4']?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = $row['numeroUnico']; 
															$_SESSION["numeroUnico_upload_arquivo"] = $numeroUnicoGerado;
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                            <div class="tabbable tabs-left tabbable-bordered">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#tb3_a">Dados principais</a></li>
                                                                    <? if(trim($row_estrutura['chamada'])==1||trim($row_estrutura['texto'])==1||trim($row_estrutura['info_produto'])==1||trim($row_estrutura['info_tecnica'])==1||trim($row_estrutura['garantia'])==1||trim($row_estrutura['manual'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_b">Informações</a></li>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['lista_relacionado'])==1||trim($row_estrutura['lista_categoria'])==1||trim($row_estrutura['lista_sysplano'])==1||trim($row_estrutura['lista_sysservico'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_c">Relacionar itens</a></li>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['video'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_d">Vídeos</a></li>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['galeria'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_e">Arquivos</a></li>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['seo_item'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_f">Editar configurações SEO</a></li>
                                                                    <? } ?>
                                                                </ul>
                                                                <div class="tab-content">

                                                                    <div id="tb3_a" class="tab-pane active" style="min-height:350px;">

																		 <? if(trim($row_estrutura['ordem'])==1) { ?>
                                                                         <div class="formSep">
                                                                            <label class="req"><? if(trim($row_estrutura['ordem_label'])=="") { echo "Ordem"; } else { echo $row_estrutura['ordem_label']; } ?></label>
                                                                            <select name="ordem" id="ordem" style="width:70px;">
                                                                                <?
                                                                                $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod.""));
                                                                                if($nordem==0) {
                                                                                ?>
                                                                                <option value='1'>1</option>
                                                                                <?
                                                                                } else {
                                                                                $ultimaOrdem = $nordem;
                                                                                for ($b=1; $b<=$ultimaOrdem; $b++) {
                                                                                ?>
                                                                                <option value='<?=$b?>' <? if($b==$row['ordem']) { echo "selected"; } ?>><?=$b?></option>
                                                                                <? } } ?>
                                                                            </select>
                                                                            <? if(trim($row_estrutura['ordem_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['ordem_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                         <? if(trim($row_estrutura['id'.$mod.'_categoria'])==1) { ?>
                                                                         <div class="formSep">
                                                                            <label class="req"><? if(trim($row_estrutura['id'.$mod.'_categoria_label'])=="") { echo "Categoria"; } else { echo $row_estrutura['id'.$mod.'_categoria_label']; } ?></label>
                                                                            <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                            <? echo monta_select_categoria("".$row['id'.$mod.'_categoria']."","","".$linguagem_set."".$mod."_categoria"); ?>
                                                                            </select>
                                                                            <? if(trim($row_estrutura['id'.$mod.'_categoria_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['id'.$mod.'_categoria_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['nome'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label class="req"><? if(trim($row_estrutura['nome_label'])=="") { echo "Título"; } else { echo $row_estrutura['nome_label']; } ?></label>
                                                                                <input value="<?=$row['nome']?>" style="width:350px;" <? if(trim($row_estrutura['seo_item'])==1) { ?>onkeyup="cria_titulo_e_url('nome','titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','<?=$row['nome']?>','titulo_seo_contador','55');"<? } ?> type="text" name="nome" id="nome" />
            
                                                                            </div>
                                                                            <? if(trim($row_estrutura['nome_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['nome_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['cod'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label class="req"><? if(trim($row_estrutura['cod_label'])=="") { echo "Código do produto"; } else { echo $row_estrutura['cod_label']; } ?></label>
                                                                            <div class="input-append">
                                                                                <input value="<?=$row['cod']?>" class="span3" type="text" name="cod" id="cod" />
                                                                                <button type="button" onclick="gera_codigo_produto();" class="btn">Gerar <? if(trim($row_estrutura['cod_label'])=="") { echo "Código do produto"; } else { echo $row_estrutura['cod_label']; } ?></button>
                                                                            </div>
                                                                            <? if(trim($row_estrutura['cod_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['cod_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['imagem'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['imagem_label'])=="") { echo "Imagem"; } else { echo $row_estrutura['imagem_label']; } ?></label>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <div class="fileupload-new thumbnail">
                                                                                <? if(trim($row['imagem'])=="") { ?>
                                                                                <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                                <? } else { ?>
                                                                                <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['imagem']?>"><img style="width:50px;" id="arquivo-atual-imagem" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['imagem']?>" alt=""></a>
                                                                                <? } ?>
                                                                                </div>
                                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                                <? if(trim($row['imagem'])=="") { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span class="fileupload-new">Selecionar arquivo</span>
                                                                                    <span class="fileupload-exists">Alterar</span>
                                                                                    <input name="imagem" type="file">
                                                                                </span>
                                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                                <? } else { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span>Alterar</span>
                                                                                    <input name="imagem" type="file">
                                                                                </span>
                                                                                <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                                <? } ?>
                                                                            </div>
                                                                            <? if(trim($row_estrutura['imagem_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['imagem_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['valor'])==1||trim($row_estrutura['valor_mensalidade'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <? if(trim($row_estrutura['valor'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;"  class="span2">
                                                                                <label><? if(trim($row_estrutura['valor_label'])=="") { echo "Valor"; } else { echo $row_estrutura['valor_label']; } ?></label>
                                                                                <div class="input-prepend">
                                                                                <span class="add-on">R$</span> <input value="<?=$row['valor']?>" class="span12" type="text" name="valor" id="valor" />
                                                                                </div>
                                                                                <? if(trim($row_estrutura['valor_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['valor_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                            <? if(trim($row_estrutura['valor_mensalidade'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;"  class="span2">
                                                                                <label><? if(trim($row_estrutura['valor_mensalidade_label'])=="") { echo "Valor"; } else { echo $row_estrutura['valor_mensalidade_label']; } ?></label>
                                                                                <div class="input-prepend">
                                                                                <span class="add-on">R$</span> <input value="<?=$row['valor_mensalidade']?>" class="span12" type="text" name="valor_mensalidade" id="valor_mensalidade" />
                                                                                </div>
                                                                                <? if(trim($row_estrutura['valor_mensalidade_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['valor_mensalidade_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['valor_promocao'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <? if(trim($row_estrutura['valor_promocao'])==1) { ?>
                                                                            <div style="float:left;margin-right:35px;padding-bottom:10px;">
                                                                                <label><? if(trim($row_estrutura['valor_promocao_label'])=="") { echo "Valor de Promoção"; } else { echo $row_estrutura['valor_promocao_label']; } ?></label>
                                                                                <div class="input-prepend">
                                                                                <span class="add-on">R$</span> <input value="<?=$row['valor_promocao']?>" class="span12" type="text" name="valor_promocao" id="valor_promocao" />
                                                                                </div>
                                                                                <? if(trim($row_estrutura['valor_promocao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['valor_promocao_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                            <? if(trim($row_estrutura['promocao'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label><? if(trim($row_estrutura['promocao_label'])=="") { echo "Promoção ?"; } else { echo $row_estrutura['promocao_label']; } ?></label>
                                                                                <input type="checkbox" name="promocao" id="promocao" <? if(trim($row['promocao'])==1) { echo " checked"; } ?> class="promocao {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['promocao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['promocao_info']?></span><? } ?>
                                                                            <? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['destaque'])==1||trim($row_estrutura['lancamento'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <? if(trim($row_estrutura['destaque'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label><? if(trim($row_estrutura['destaque_label'])=="") { echo "Destaque ?"; } else { echo $row_estrutura['destaque_label']; } ?></label>
                                                                                <input type="checkbox" name="destaque" id="destaque" <? if(trim($row['destaque'])==1) { echo " checked"; } ?> class="destaque {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['destaque_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['destaque_info']?></span><? } ?>
                                                                            <? } ?>
                                                                            <? if(trim($row_estrutura['lancamento'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label><? if(trim($row_estrutura['lancamento_label'])=="") { echo "Lançamento ?"; } else { echo $row_estrutura['lancamento_label']; } ?></label>
                                                                                <input type="checkbox" name="lancamento" id="lancamento" <? if(trim($row['lancamento'])==1) { echo " checked"; } ?> class="lancamento {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['lancamento_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['lancamento_info']?></span><? } ?>
                                                                            <? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['tags'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['tags_label'])=="") { echo "Tags relacionadas"; } else { echo $row_estrutura['tags_label']; } ?></label>
                                                                            <input type="text" name="tags" id="tags" class="span7" value="<?=$row['tags']?>">
                                                                            <? if(trim($row_estrutura['tags_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['tags_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['frete'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label><? if(trim($row_estrutura['frete_label'])=="") { echo "Cobrar Frete ?"; } else { echo $row_estrutura['frete_label']; } ?></label>
                                                                                <input type="checkbox" name="frete" id="frete" <? if(trim($row['frete'])==1) { echo " checked"; } ?> class="frete {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['frete_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['frete_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['data_post'])==1||trim($row_estrutura['hora_post'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <? if(trim($row_estrutura['data_post'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label><? if(trim($row_estrutura['data_post_label'])=="") { echo "Data Original"; } else { echo $row_estrutura['data_post_label']; } ?></label>
                                                                                <div class="input-append date" id="data_post" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                                    <input class="span8" size="16" name="data_post" value="<? if(trim($row['data_post'])==""||trim($row['data_post'])=="0000-00-00"||trim($row['data_post'])=="1999-11-30") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_post'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                                <? if(trim($row_estrutura['data_post_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['data_post_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                            <? if(trim($row_estrutura['hora_post'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label><? if(trim($row_estrutura['hora_post_label'])=="") { echo "Hora Original"; } else { echo $row_estrutura['hora_post_label']; } ?></label>
                                                                                <div class="input-append bootstrap-timepicker">
                                                                                    <input type="text" value="<? if(trim($row['hora_post'])=="") { echo date("H:i:s"); } else { echo $row['hora_post']; } ?>" class="input-small" name="hora_post" id="hora_post">
                                                                                    <span class="add-on">
                                                                                        <i class="icon-time"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <? if(trim($row_estrutura['hora_post_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:-1px;"><?=$row_estrutura['hora_post_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['data_publicacao'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label><? if(trim($row_estrutura['data_publicacao_label'])=="") { echo "Data de Publicação"; } else { echo $row_estrutura['data_publicacao_label']; } ?></label>
                                                                                <div class="input-append date" id="data_publicacao" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                                    <input class="span8" size="16" name="data_publicacao" value="<? if(trim($row['data_publicacao'])==""||trim($row['data_publicacao'])=="0000-00-00"||trim($row['data_publicacao'])=="1999-11-30") { } else { ajustaDataSemHora($row['data_publicacao'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                                <? if(trim($row_estrutura['data_publicacao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['data_publicacao_info']?></span><? } ?>
                                                                            </div>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['data_despublicacao'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label><? if(trim($row_estrutura['data_despublicacao_label'])=="") { echo "Data de Despublicação"; } else { echo $row_estrutura['data_despublicacao_label']; } ?></label>
                                                                                <div class="input-append date" id="data_despublicacao" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                                    <input class="span8" size="16" name="data_despublicacao" value="<? if(trim($row['data_despublicacao'])==""||trim($row['data_despublicacao'])=="0000-00-00"||trim($row['data_despublicacao'])=="1999-11-30") { } else { ajustaDataSemHora($row['data_despublicacao'],"d/m/Y"); } ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                                <? if(trim($row_estrutura['data_despublicacao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['data_despublicacao_info']?></span><? } ?>
                                                                            </div>
                                                                        </div>
                                                                        <? } ?>
            
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


                                                                    <? if(trim($row_estrutura['chamada'])==1||trim($row_estrutura['texto'])==1||trim($row_estrutura['info_produto'])==1||trim($row_estrutura['info_tecnica'])==1||trim($row_estrutura['garantia'])==1||trim($row_estrutura['manual'])==1) { ?>
                                                                    <div id="tb3_b" class="tab-pane" style="min-height:350px;">

																		<? if(trim($row_estrutura['chamada'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['chamada_label'])=="") { echo "Chamada"; } else { echo $row_estrutura['chamada_label']; } ?></label>
                                                                            <textarea name="chamada" id="chamada" class="span12" style="height:150px;"><?=$row['chamada']?></textarea>
                                                                            <? if(trim($row_estrutura['chamada_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['chamada_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
                            
                                                                        <? if(trim($row_estrutura['texto'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['texto_label'])=="") { echo "Texto"; } else { echo $row_estrutura['texto_label']; } ?></label>
                                                                            <textarea name="texto" id="texto" class="span12" style="height:150px;"><?=$row['texto']?></textarea>
                                                                            <? if(trim($row_estrutura['texto_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['texto_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['info_produto'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['info_produto_label'])=="") { echo "Informações do Produto"; } else { echo $row_estrutura['info_produto_label']; } ?></label>
                                                                            <textarea name="info_produto" id="info_produto" class="span12" style="height:150px;"><?=$row['info_produto']?></textarea>
                                                                            <? if(trim($row_estrutura['info_produto_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['info_produto_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['info_tecnica'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['info_tecnica_label'])=="") { echo "Informações Técnicas"; } else { echo $row_estrutura['info_tecnica_label']; } ?></label>
                                                                            <textarea name="info_tecnica" id="info_tecnica" class="span12" style="height:150px;"><?=$row['info_tecnica']?></textarea>
                                                                            <? if(trim($row_estrutura['info_tecnica_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['info_tecnica_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['garantia'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['garantia_label'])=="") { echo "Texto de Garantia"; } else { echo $row_estrutura['garantia_label']; } ?></label>
                                                                            <textarea name="garantia" id="garantia" class="span12" style="height:150px;"><?=$row['garantia']?></textarea>
                                                                            <? if(trim($row_estrutura['garantia_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['garantia_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['manual'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['manual_label'])=="") { echo "Manual"; } else { echo $row_estrutura['manual_label']; } ?></label>
                                                                            <textarea name="manual" id="manual" class="span12" style="height:150px;"><?=$row['manual']?></textarea>
                                                                            <? if(trim($row_estrutura['manual_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['manual_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>

                                                                    </div>
                                                                    <? } ?>

                                                                    <? if(trim($row_estrutura['lista_relacionado'])==1||trim($row_estrutura['lista_categoria'])==1||trim($row_estrutura['lista_sysplano'])==1||trim($row_estrutura['lista_sysservico'])==1) { ?>
                                                                    <div id="tb3_c" class="tab-pane" style="min-height:350px;">

																		<? if(trim($row_estrutura['lista_relacionado'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                                <label><? if(trim($row_estrutura['lista_relacionado_label'])=="") { echo "Itens Relacionados"; } else { echo $row_estrutura['lista_relacionado_label']; } ?></label>
                                                                                <select id="lista_relacionado_itens" multiple="multiple">
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlItem['id']?>" <? if(strrpos($row['lista_relacionado'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <input value="<?=$row['lista_relacionado']?>" style="width:350px;" type="hidden" name="lista_relacionado" id="lista_relacionado" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['lista_relacionado_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['lista_relacionado_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['lista_categoria'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                                <label class="req"><? if(trim($row_estrutura['lista_categoria_label'])=="") { echo "Categorias Relacionados"; } else { echo $row_estrutura['lista_categoria_label']; } ?></label>
                                                                                <select id="lista_categoria_itens" multiple="multiple">
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_categoria ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlItem['id']?>" <? if(strrpos($row['lista_categoria'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <input value="<?=$row['lista_categoria']?>" style="width:350px;" type="hidden" name="lista_categoria" id="lista_categoria" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['lista_categoria_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['lista_categoria_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['lista_sysplano'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                                <label><? if(trim($row_estrutura['lista_sysplano_label'])=="") { echo "Planos Relacionados"; } else { echo $row_estrutura['lista_sysplano_label']; } ?></label>
                                                                                <select id="lista_sysplano_itens" multiple="multiple">
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysplano ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlItem['id']?>" <? if(strrpos($row['lista_sysplano'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <input value="<?=$row['lista_sysplano']?>" style="width:350px;" type="hidden" name="lista_sysplano" id="lista_sysplano" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['lista_sysplano_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['lista_sysplano_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>

                                                                    </div>
                                                                    <? } ?>

                                                                    <? if(trim($row_estrutura['video'])==1) { ?>
                                                                    <div id="tb3_d" class="tab-pane" style="min-height:350px;">

                                                                        <div class="formSep">
                                                                            <div style="margin-right:10px;width:100%;float:left;">Galeria de vídeos</div>
                                                                            <div style="margin-right:10px;width:100%;float:left;">
                                                                                <div style="float:left;margin-right:10px;">
                                                                                    <label>Título</label>
                                                                                    <input value="" style="width:350px;" type="text" id="nome_video" />
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;">
                                                                                    <label>Link</label>
                                                                                    <input value="" style="width:350px;" type="text" id="link_video" />
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;margin-top:24px;">
                                                                                    <button type="button" onclick="javascript:adicionar_video_produto('<?=$mod?>','');" class="btn btn-primary">Adicionar Vídeo</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="formSep" id="galeria-video" style="margin-right:10px;width:100%;margin-bottom:50px;float:left;margin-top:20px;">
                                                                            <? $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/produto/lista_video.php"); ?>
                                                                        </div>
        
                                                                    </div>
                                                                    <? } ?>

                                                                    <? if(trim($row_estrutura['galeria'])==1) { ?>
                                                                    <div id="tb3_e" class="tab-pane" style="min-height:350px;">

																		<script type="text/javascript" src="<?=$link?>template/js/upload.js"></script>
                                                                        <script type="text/javascript" >
                                                                            $(function(){
                                                                                new AjaxUpload($('#upload-arquivo'), {
                                                                                    action: '<?=$link?>acoes/produto/drop-arquivo.php?numeroUnico_upload_arquivo=<?=$numeroUnicoGerado?>',
                                                                                    name: 'file',
                                                                                    onSubmit: function(file, ext){
                                                                                    },
                                                                                    onComplete: function(file, response){
                                                                                        parent.$("#galeria-fotos").html(response);
                                                                                    }
                                                                                });
                                                                                
                                                                            });
                                                                        </script>
                                                                        <div class="formSep">
                                                                            <label>Arquivo</label>
                                                                            <input type="button" id="upload-arquivo" value="adicionar arquivo" class="btn" />
                                                                        </div>
                                    
                                                                        <div id="drag-drop-div" class="formSep">
                                                                            <div id="dragandrophandler" style="margin-left:0px;">Arrastar e Soltar os Arquivos Aqui</div>
                                                                            <div id="status1"></div>
                                                                        </div>
                                                                        <script>
                                                                        function sendFileToServer(formData,status)
                                                                        {
                                                                            var uploadURL ="<?=$link?>acoes/produto/drop-arquivo.php"; //Upload URL
                                                                            var extraData = { }; //Extra Data.
                                                                            var jqXHR=$.ajax({
                                                                                    xhr: function() {
                                                                                    var xhrobj = $.ajaxSettings.xhr();
                                                                                    if (xhrobj.upload) {
                                                                                            xhrobj.upload.addEventListener('progress', function(event) {
                                                                                                var percent = 0;
                                                                                                var position = event.loaded || event.position;
                                                                                                var total = event.total;
                                                                                                if (event.lengthComputable) {
                                                                                                    percent = Math.ceil(position / total * 100);
                                                                                                }
                                                                                                //Set progress
                                                                                                status.setProgress(percent);
                                                                                            }, false);
                                                                                        }
                                                                                    return xhrobj;
                                                                                },
                                                                            url: uploadURL,
                                                                            type: "POST",
                                                                            contentType:false,
                                                                            processData: false,
                                                                                cache: false,
                                                                                data: formData,
                                                                                success: function(data){
                                                                                    status.setProgress(100);
                                                                                    parent.$(".statusbar").fadeOut();
                                                                        
                                                                                    parent.$("#galeria-fotos").html(data);
                                                                                }
                                                                            }); 
                                                                         
                                                                            status.setAbort(jqXHR);
                                                                        }
                                                                         
                                                                        var rowCount=0;
                                                                        function createStatusbar(obj)
                                                                        {
                                                                             rowCount++;
                                                                             var row="odd";
                                                                             if(rowCount %2 ==0) row ="even";
                                                                             this.statusbar = $("<div class='statusbar "+row+"'></div>");
                                                                             this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
                                                                             this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
                                                                             this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
                                                                             this.abort = $("<div class='abort'>Cancelar</div>").appendTo(this.statusbar);
                                                                             obj.after(this.statusbar);
                                                                         
                                                                            this.setFileNameSize = function(name,size)
                                                                            {
                                                                                var sizeStr="";
                                                                                var sizeKB = size/1024;
                                                                                if(parseInt(sizeKB) > 1024)
                                                                                {
                                                                                    var sizeMB = sizeKB/1024;
                                                                                    sizeStr = sizeMB.toFixed(2)+" MB";
                                                                                }
                                                                                else
                                                                                {
                                                                                    sizeStr = sizeKB.toFixed(2)+" KB";
                                                                                }
                                                                         
                                                                                this.filename.html(name);
                                                                                this.size.html(sizeStr);
                                                                            }
                                                                            this.setProgress = function(progress)
                                                                            {       
                                                                                var progressBarWidth =progress*this.progressBar.width()/ 100;  
                                                                                this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% &nbsp;");
                                                                                if(parseInt(progress) >= 100)
                                                                                {
                                                                                    this.abort.hide();
                                                                                }
                                                                            }
                                                                            this.setAbort = function(jqxhr)
                                                                            {
                                                                                var sb = this.statusbar;
                                                                                this.abort.click(function()
                                                                                {
                                                                                    jqxhr.abort();
                                                                                    sb.hide();
                                                                                });
                                                                            }
                                                                        }
                                                                        function handleFileUpload(files,obj)
                                                                        {
                                                                           for (var i = 0; i < files.length; i++) 
                                                                           {
                                                                                var fd = new FormData();
                                                                                fd.append('file', files[i]);
                                                                                fd.append('numeroUnicoS','<?=$numeroUnicoGerado?>');
                                                                         
                                                                                var status = new createStatusbar(obj); //Using this we can set progress.
                                                                                status.setFileNameSize(files[i].name,files[i].size);
                                                                                sendFileToServer(fd,status);
                                                                         
                                                                           }
                                                                        }
                                                                        $(document).ready(function()
                                                                        {
                                                                        var obj = $("#dragandrophandler");
                                                                        obj.on('dragenter', function (e) 
                                                                        {
                                                                            e.stopPropagation();
                                                                            e.preventDefault();
                                                                            $(this).css('border', '2px dotted #626262');
                                                                        });
                                                                        obj.on('dragover', function (e) 
                                                                        {
                                                                             e.stopPropagation();
                                                                             e.preventDefault();
                                                                        });
                                                                        obj.on('drop', function (e) 
                                                                        {
                                                                         
                                                                             $(this).css('border', '2px dotted #626262');
                                                                             e.preventDefault();
                                                                             var files = e.originalEvent.dataTransfer.files;
                                                                         
                                                                             //We need to send dropped files to Server
                                                                             handleFileUpload(files,obj);
                                                                        });
                                                                        $(document).on('dragenter', function (e) 
                                                                        {
                                                                            e.stopPropagation();
                                                                            e.preventDefault();
                                                                        });
                                                                        $(document).on('dragover', function (e) 
                                                                        {
                                                                          e.stopPropagation();
                                                                          e.preventDefault();
                                                                          obj.css('border', '2px dotted #626262');
                                                                        });
                                                                        $(document).on('drop', function (e) 
                                                                        {
                                                                            e.stopPropagation();
                                                                            e.preventDefault();
                                                                        });
                                                                         
                                                                        });
                                                                        </script>
                                                                    
                                                                        <div id="galeria-fotos" class="formSep">
                                                                            <? $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/produto/lista_galeria.php"); ?>
                                                                        </div>
        
                                                                    </div>
                                                                    <? } ?>

                                                                    <? if(trim($row_estrutura['seo_item'])==1) { ?>
                                                                    <div id="tb3_f" class="tab-pane" style="min-height:350px;">
																		<? 
                                                                        if(trim($row['titulo_seo'])=="") {
                                                                            if(trim($row['nome'])=="") {
                                                                                $titulo = "Título"; 
                                                                                $tamanho_titulo = 55; 
                                                                            } else {
                                                                                $titulo = $row['nome']; 
                                                                                $tamanho_titulo = 55 - strlen($row['nome']); 
                                                                            }
                                                                        } else {
                                                                            $titulo = $row['titulo_seo']; 
                                                                            $tamanho_titulo = 55 - strlen($row['titulo_seo']); 
                                                                        }
            
                                                                        if(trim($row['texto_seo'])=="") {  
                                                                            $texto = "Se você não acrescentar nenhum texto, o Meta Description não será exibido"; 
                                                                            $tamanho_texto = 150; 
                                                                        } else {
                                                                            $texto = $row['texto_seo']; 
                                                                            $tamanho_texto = 150 - strlen($row['texto_seo']); 
                                                                        }
                                                                        ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;width:100%;font-size:18px;color:#1e0fbe;text-decoration: none;" id="titulo_seo_google"><?=$titulo?></div>
                                                                            <div style="float:left;width:100%;font-size:medium;color:#006621;" id="url_amigavel_google"><?=$link_site?><?=$row['url_amigavel']?></div>
                                                                            <div style="float:left;width:100%;font-size:small;color:#444;margin-bottom:10px;" id="texto_seo_google"><?=$texto?></div>
                                                                        </div>
                
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label class="req">Título</label>
                                                                                <input value="<?=$titulo?>" style="width:550px;" onkeyup="cria_seo_titulo_e_url('titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','Título','titulo_seo_contador','55');" type="text" name="titulo_seo" id="titulo_seo" />
                                                                                <div style="float:left;width:100%;">A visualização do título em mecânismos de busca é limitada à 55 caracteres, <span style="color:#090;" id="titulo_seo_contador"><?=$tamanho_titulo?></span> restantes.</div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label class="req">URL Amigável</label>
                                                                                <input value="<?=$row['url_amigavel']?>" style="width:550px;" type="text" onkeyup="controle_url_amigavel('url_amigavel','url_amigavel_google');" name="url_amigavel" id="url_amigavel" />
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <label>Texto (Meta-Description)</label>
                                                                            <textarea name="texto_seo" id="texto_seo" onkeyup="controle_meta_description('texto_seo','texto_seo_google','texto_seo_contador','<?=$texto?>','150');" class="span12" style="height:150px;"><?=$texto?></textarea>
                                                                            <div style="float:left;width:100%;">O Meta-Description esta limitado à 150 caracteres, <span style="color:#090;" id="texto_seo_contador"><?=$tamanho_texto?></span> restantes.</div>
                                                                        </div>

                                                                    </div>
                                                                    <? } ?>

                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                                <button type="button" onclick="clonar_item();" class="btn btn-beoro-6">Clonar este produto</button>
                                                                <button type="button" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                                <? } ?>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <? } ?>
                                                
                                                <div id="tb1_lista" class="tab-pane <? if(trim($_REQUEST['var3'])=="") { ?>active<? } ?>">
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
                                                            <form name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" method="post" target="_self">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <table id="dt_basic" class="table table-striped table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:20px;" class="table_checkbox"><input type="checkbox" name="select_msgs" class="select_msgs ptip_se" title="Selecionar todos" data-tableid="dt_basic" /></th>
                                                                    <? if(trim($row_estrutura['ordem'])==1) { ?>
                                                                    <th style="width:50px;">Ordem</th>
                                                                    <? } ?>
                                                                    <th><? if(trim($row_estrutura['nome_label'])=="") { echo "Nome"; } else { echo $row_estrutura['nome_label']; } ?></th>
                                                                    <? if(trim($row_estrutura['galeria'])==1) { ?>
                                                                    <th style="width:50px;">Fotos</th>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['video'])==1) { ?>
                                                                    <th style="width:50px;">Vídeos</th>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['categoria'])==1) { ?>
																	<? if(trim($row_estrutura['id'.$mod.'_categoria'])==1) { ?>
                                                                    <th style="width:150px;">Categorias</th>
                                                                    <? } ?>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['categoria'])==1) { ?>
																	<? if(trim($row_estrutura['lista_categoria'])==1) { ?>
                                                                    <th style="width:150px;">Categorias</th>
                                                                    <? } ?>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['cod'])==1) { ?>
                                                                    <th style="width:80px;"><? if(trim($row_estrutura['cod_label'])=="") { echo "Código"; } else { echo $row_estrutura['cod_label']; } ?></th>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['valor'])==1) { ?>
                                                                    <th style="width:100px;"><? if(trim($row_estrutura['valor_label'])=="") { echo "Valor"; } else { echo $row_estrutura['valor_label']; } ?></th>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['valor_promocao'])==1) { ?>
                                                                    <th style="width:100px;"><? if(trim($row_estrutura['valor_promocao_label'])=="") { echo "Valor de promoção"; } else { echo $row_estrutura['valor_promocao_label']; } ?></th>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['valor_mensalidade'])==1) { ?>
                                                                    <th style="width:100px;"><? if(trim($row_estrutura['valor_mensalidade_label'])=="") { echo "Valor de mensalidade"; } else { echo $row_estrutura['valor_mensalidade_label']; } ?></th>
                                                                    <? } ?>
                                                                    <th style="width:130px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY ordem");
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
                                                                    <? if(trim($row_estrutura['ordem'])==1) { ?>
                                                                    <td style="vertical-align:middle;"><?=$rSql['ordem']?></td>
                                                                    <? } ?>
                                                                    <td style="vertical-align:middle;"><a data-original-title="Editar campo <? if(trim($row_estrutura['nome_label'])=="") { echo "Nome"; } else { echo $row_estrutura['nome_label']; } ?>" data-placeholder="Digite um <? if(trim($row_estrutura['nome_label'])=="") { echo "Nome"; } else { echo $row_estrutura['nome_label']; } ?>" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <? if(trim($row_estrutura['galeria'])==1) { ?>
                                                                    <? $n = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_galeria WHERE numeroUnico='".$rSql['numeroUnico']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$n?></td>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['video'])==1) { ?>
                                                                    <? $n = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_video WHERE numeroUnico='".$rSql['numeroUnico']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$n?></td>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['categoria'])==1) { ?>
																	<? if(trim($row_estrutura['id'.$mod.'_categoria'])==1) { ?>
                                                                    <? $item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_categoria WHERE id='".$rSql['id'.$mod.'_categoria']."'")); ?>
                                                                    <td style="vertical-align:middle;"><?=$item['nome']?></td>
                                                                    <? } ?>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['categoria'])==1) { ?>
																	<? if(trim($row_estrutura['lista_categoria'])==1) { ?>
                                                                    <td style="vertical-align:middle;">
																	<?
																	$listaCategoria = $rSql['lista_categoria'];
																	$listaCategoria = str_replace("||","','",$listaCategoria);
																	$listaCategoria = str_replace("|","'",$listaCategoria);
																	if(trim($listaCategoria)=="") { } else {
																		$printCategoria = "";
																		$qSqlCat = mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_categoria WHERE id IN(".$listaCategoria.") ORDER BY ordem");
																		while($rSqlCat = mysql_fetch_array($qSqlCat)) {
																			if(trim($printCategoria)=="") {
																				$printCategoria = $rSqlCat['nome'];
																			} else {
																				$printCategoria = $printCategoria.", ".$rSqlCat['nome'];
																			}
																		}
																		echo $printCategoria;
																	}
                                                                    ?>
                                                                    </td>
                                                                    <? } ?>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['cod'])==1) { ?>
                                                                    <td style="vertical-align:middle;"><?=$rSql['cod']?></td>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['valor'])==1) { ?>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor']?></td>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['valor'])==1) { ?>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor_promocao']?></td>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['valor_mensalidade'])==1) { ?>
                                                                    <td style="vertical-align:middle;"><?=$rSql['valor_mensalidade']?></td>
                                                                    <? } ?>
                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                        <div class="btn-group">
                                                                        <? if(trim($row_estrutura['destaque'])==1) { ?>
																		<? if(trim($rSql['destaque'])=="1") { ?>
																			<? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="muda_destaque('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Retirar de destaque"><img src="<?=$link?>template/img/icones_novos/16/destaque-1.png" /></a></div>
                                                                            <? } else { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Retirar de destaque"><img src="<?=$link?>template/img/icones_novos/16/destaque-1.png" /></a></div>
                                                                            <? } ?>
                                                                        <? } else { ?>
																			<? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="muda_destaque('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn-mini ptip_se" title="Colocar como destaque"><img src="<?=$link?>template/img/icones_novos/16/destaque-0.png" /></a></div>
                                                                            <? } else { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Colocar como destaque"><img src="<?=$link?>template/img/icones_novos/16/destaque-0.png" /></a></div>
                                                                            <? } ?>
                                                                        <? } ?>
                                                                        <? } ?>

                                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a></div>
																		<? } ?>
                                                                        <? if(trim($sysperm['excluir_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$mod?>','NAO','');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a></div>
																		<? } ?>
                                                                        <? if(trim($rSql['stat'])=="1") { ?>
																			<? if(trim($sysperm['despublicar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a></div>
                                                                            <? } else { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a></div>
                                                                            <? } ?>
                                                                        <? } else { ?>
																			<? if(trim($sysperm['publicar_'.$mod.''])==1) { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a></div>
                                                                            <? } else { ?>
                                                                            <div style="float:left;width:16px;margin-left:10px;"><a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a></div>
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
                                                <div id="tb1_novo" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" id="idacaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = geraCodReturn(); 
															$_SESSION["numeroUnico_upload_arquivo"] = $numeroUnicoGerado;
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                            <div class="tabbable tabs-left tabbable-bordered">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a data-toggle="tab" href="#tb3_a">Dados principais</a></li>
                                                                    <? if(trim($row_estrutura['chamada'])==1||trim($row_estrutura['texto'])==1||trim($row_estrutura['info_produto'])==1||trim($row_estrutura['info_tecnica'])==1||trim($row_estrutura['garantia'])==1||trim($row_estrutura['manual'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_b">Informações</a></li>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['lista_relacionado'])==1||trim($row_estrutura['lista_categoria'])==1||trim($row_estrutura['lista_sysplano'])==1||trim($row_estrutura['lista_sysservico'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_c">Relacionar itens</a></li>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['video'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_d">Vídeos</a></li>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['galeria'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_e">Arquivos</a></li>
                                                                    <? } ?>
                                                                    <? if(trim($row_estrutura['seo_item'])==1) { ?>
                                                                    <li><a data-toggle="tab" href="#tb3_f">Editar configurações SEO</a></li>
                                                                    <? } ?>
                                                                </ul>
                                                                <div class="tab-content">

                                                                    <div id="tb3_a" class="tab-pane active" style="min-height:350px;">

																		 <? if(trim($row_estrutura['ordem'])==1) { ?>
                                                                         <div class="formSep">
                                                                            <label class="req"><? if(trim($row_estrutura['ordem_label'])=="") { echo "Ordem"; } else { echo $row_estrutura['ordem_label']; } ?></label>
                                                                            <select name="ordem" id="ordem" style="width:70px;">
                                                                                <?
                                                                                $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod.""));
                                                                                if($nordem==0) {
                                                                                ?>
                                                                                <option value='1'>1</option>
                                                                                <?
                                                                                } else {
                                                                                $ultimaOrdem = $nordem+1;
                                                                                for ($b=1; $b<=$ultimaOrdem; $b++) {
                                                                                ?>
                                                                                <option value='<?=$b?>' <? if($b==$ultimaOrdem) { echo "selected"; } ?>><?=$b?></option>
                                                                                <? } } ?>
                                                                            </select>
                                                                            <? if(trim($row_estrutura['ordem_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['ordem_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                         <? if(trim($row_estrutura['id'.$mod.'_categoria'])==1) { ?>
                                                                         <div class="formSep">
                                                                            <label class="req"><? if(trim($row_estrutura['id'.$mod.'_categoria_label'])=="") { echo "Categoria"; } else { echo $row_estrutura['id'.$mod.'_categoria_label']; } ?></label>
                                                                            <select name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria">
                                                                            <? echo monta_select_categoria("","","".$linguagem_set."".$mod."_categoria"); ?>
                                                                            </select>
                                                                            <? if(trim($row_estrutura['id'.$mod.'_categoria_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['id'.$mod.'_categoria_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['nome'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;width:100%;">
                                                                                <label class="req"><? if(trim($row_estrutura['nome_label'])=="") { echo "Título"; } else { echo $row_estrutura['nome_label']; } ?></label>
                                                                                <input value="" class="span7" <? if(trim($row_estrutura['seo_item'])==1) { ?>onkeyup="cria_titulo_e_url('nome','titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','Título','titulo_seo_contador','55');"<? } ?> type="text" name="nome" id="nome" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['nome_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['nome_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
                            
                                                                        <? if(trim($row_estrutura['cod'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label class="req"><? if(trim($row_estrutura['cod_label'])=="") { echo "Código do produto"; } else { echo $row_estrutura['cod_label']; } ?></label>
                                                                            <div class="input-append">
                                                                                <input value="" class="span3" type="text" name="cod" id="cod" />
                                                                                <button type="button" onclick="gera_codigo_produto();" class="btn">Gerar <? if(trim($row_estrutura['cod_label'])=="") { echo "Código do produto"; } else { echo $row_estrutura['cod_label']; } ?></button>
                                                                            </div>
                                                                            <? if(trim($row_estrutura['cod_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['cod_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
                            
                                                                        <? if(trim($row_estrutura['imagem'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['imagem_label'])=="") { echo "Imagem"; } else { echo $row_estrutura['imagem_label']; } ?></label>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="<?=$link?>template/img/dummy_50x50.gif" alt="" ></div>
                                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                                <span class="btn btn-small btn-file"><span class="fileupload-new">Selecionar arquivo</span><span class="fileupload-exists">Alterar</span><input name="imagem" type="file"></span>
                                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                            </div>
                                                                            <? if(trim($row_estrutura['imagem_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['imagem_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['valor'])==1||trim($row_estrutura['valor_mensalidade'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <? if(trim($row_estrutura['valor'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;"  class="span2">
                                                                                <label><? if(trim($row_estrutura['valor_label'])=="") { echo "Valor"; } else { echo $row_estrutura['valor_label']; } ?></label>
                                                                                <div class="input-prepend">
                                                                                <span class="add-on">R$</span> <input value="" class="span12" type="text" name="valor" id="valor" />
                                                                                </div>
                                                                                <? if(trim($row_estrutura['valor_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['valor_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                            <? if(trim($row_estrutura['valor_mensalidade'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;"  class="span2">
                                                                                <label><? if(trim($row_estrutura['valor_mensalidade_label'])=="") { echo "Valor"; } else { echo $row_estrutura['valor_mensalidade_label']; } ?></label>
                                                                                <div class="input-prepend">
                                                                                <span class="add-on">R$</span> <input value="" class="span12" type="text" name="valor_mensalidade" id="valor_mensalidade" />
                                                                                </div>
                                                                                <? if(trim($row_estrutura['valor_mensalidade_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['valor_mensalidade_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['valor_promocao'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <? if(trim($row_estrutura['valor_promocao'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;"  class="span2">
                                                                                <label><? if(trim($row_estrutura['valor_promocao_label'])=="") { echo "Valor de Promoção"; } else { echo $row_estrutura['valor_promocao_label']; } ?></label>
                                                                                <div class="input-prepend">
                                                                                <span class="add-on">R$</span> <input value="" class="span12" type="text" name="valor_promocao" id="valor_promocao" />
                                                                                </div>
                                                                                <? if(trim($row_estrutura['valor_promocao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['valor_promocao_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                            <? if(trim($row_estrutura['promocao'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;" class="span2">
                                                                                <label><? if(trim($row_estrutura['promocao_label'])=="") { echo "Promoção ?"; } else { echo $row_estrutura['promocao_label']; } ?></label>
                                                                                <input type="checkbox" name="promocao" id="promocao" class="promocao {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['promocao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['promocao_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['destaque'])==1||trim($row_estrutura['lancamento'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <? if(trim($row_estrutura['destaque'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label><? if(trim($row_estrutura['destaque_label'])=="") { echo "Destaque ?"; } else { echo $row_estrutura['destaque_label']; } ?></label>
                                                                                <input type="checkbox" name="destaque" id="destaque" class="destaque {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['destaque_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['destaque_info']?></span><? } ?>
                                                                            <? } ?>
                                                                            <? if(trim($row_estrutura['lancamento'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label><? if(trim($row_estrutura['lancamento_label'])=="") { echo "Lançamento ?"; } else { echo $row_estrutura['lancamento_label']; } ?></label>
                                                                                <input type="checkbox" name="lancamento" id="lancamento" class="lancamento {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['lancamento_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['lancamento_info']?></span><? } ?>
                                                                            <? } ?>
                                                                            <? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['tags'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['tags_label'])=="") { echo "Tags relacionadas"; } else { echo $row_estrutura['tags_label']; } ?></label>
                                                                            <input type="text" name="tags" id="tags" class="span7" value="">
                                                                            <? if(trim($row_estrutura['tags_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['tags_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['frete'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label><? if(trim($row_estrutura['frete_label'])=="") { echo "Cobrar Frete ?"; } else { echo $row_estrutura['frete_label']; } ?></label>
                                                                                <input type="checkbox" name="frete" id="frete" class="frete {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['frete_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['frete_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['data_post'])==1||trim($row_estrutura['hora_post'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <? if(trim($row_estrutura['data_post'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label><? if(trim($row_estrutura['data_post_label'])=="") { echo "Data Original"; } else { echo $row_estrutura['data_post_label']; } ?></label>
                                                                                <div class="input-append date" id="data_post" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                                    <input class="span8" size="16" name="data_post" value="<? echo date("d/m/Y"); ?>" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                                <? if(trim($row_estrutura['data_post_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['data_post_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                            <? if(trim($row_estrutura['hora_post'])==1) { ?>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label><? if(trim($row_estrutura['hora_post_label'])=="") { echo "Hora Original"; } else { echo $row_estrutura['hora_post_label']; } ?></label>
                                                                                <div class="input-append bootstrap-timepicker">
                                                                                    <input type="text" value="<? echo date("H:i:s"); ?>" class="input-small" name="hora_post" id="hora_post">
                                                                                    <span class="add-on">
                                                                                        <i class="icon-time"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <? if(trim($row_estrutura['hora_post_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:-1px;"><?=$row_estrutura['hora_post_info']?></span><? } ?>
                                                                            </div>
                                                                            <? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['data_publicacao'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label><? if(trim($row_estrutura['data_publicacao_label'])=="") { echo "Data de Publicação"; } else { echo $row_estrutura['data_publicacao_label']; } ?></label>
                                                                                <div class="input-append date" id="data_publicacao" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                                    <input class="span8" size="16" name="data_publicacao" value="" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                                <? if(trim($row_estrutura['data_publicacao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['data_publicacao_info']?></span><? } ?>
                                                                            </div>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['data_despublicacao'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label><? if(trim($row_estrutura['data_despublicacao_label'])=="") { echo "Data de Despublicação"; } else { echo $row_estrutura['data_despublicacao_label']; } ?></label>
                                                                                <div class="input-append date" id="data_despublicacao" data-date-format="dd/mm/yyyy" data-date="<? echo date("d/m/Y"); ?>">
                                                                                    <input class="span8" size="16" name="data_despublicacao" value="" type="text">
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                                <? if(trim($row_estrutura['data_despublicacao_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['data_despublicacao_info']?></span><? } ?>
                                                                            </div>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <div class="formSep">
                                                                            <label class="req">Ativo ?</label>
                                                                            <label class="radio" style="color:#C00;">
                                                                                <input type="radio" name="stat" id="ativo1" value="0" >
                                                                                não
                                                                            </label>
                                                                            <label class="radio" style="color:#390;">
                                                                                <input type="radio" name="stat" id="ativo2" checked="checked" value="1" >
                                                                                sim
                                                                            </label>
                                                                        </div>	
                                                                        
                                                                    </div>

                                                                    <? if(trim($row_estrutura['chamada'])==1||trim($row_estrutura['texto'])==1||trim($row_estrutura['info_produto'])==1||trim($row_estrutura['info_tecnica'])==1||trim($row_estrutura['garantia'])==1||trim($row_estrutura['manual'])==1) { ?>
                                                                    <div id="tb3_b" class="tab-pane" style="min-height:350px;">
																		<? if(trim($row_estrutura['chamada'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['chamada_label'])=="") { echo "Chamada"; } else { echo $row_estrutura['chamada_label']; } ?></label>
                                                                            <textarea name="chamada" id="chamada" class="span12" style="height:150px;"></textarea>
                                                                            <? if(trim($row_estrutura['chamada_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['chamada_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['texto'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['texto_label'])=="") { echo "Texto"; } else { echo $row_estrutura['texto_label']; } ?></label>
                                                                            <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                                            <? if(trim($row_estrutura['texto_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['texto_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['info_produto'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['info_produto_label'])=="") { echo "Informações do Produto"; } else { echo $row_estrutura['info_produto_label']; } ?></label>
                                                                            <textarea name="info_produto" id="info_produto" class="span12" style="height:150px;"></textarea>
                                                                            <? if(trim($row_estrutura['info_produto_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['info_produto_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['info_tecnica'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['info_tecnica_label'])=="") { echo "Informações Técnicas"; } else { echo $row_estrutura['info_tecnica_label']; } ?></label>
                                                                            <textarea name="info_tecnica" id="info_tecnica" class="span12" style="height:150px;"></textarea>
                                                                            <? if(trim($row_estrutura['info_tecnica_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['info_tecnica_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['garantia'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['garantia_label'])=="") { echo "Texto de Garantia"; } else { echo $row_estrutura['garantia_label']; } ?></label>
                                                                            <textarea name="garantia" id="garantia" class="span12" style="height:150px;"></textarea>
                                                                            <? if(trim($row_estrutura['garantia_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['garantia_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['manual'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <label><? if(trim($row_estrutura['manual_label'])=="") { echo "Manual"; } else { echo $row_estrutura['manual_label']; } ?></label>
                                                                            <textarea name="manual" id="manual" class="span12" style="height:150px;"></textarea>
                                                                            <? if(trim($row_estrutura['manual_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;margin-top:10px;"><?=$row_estrutura['manual_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
                                                                    </div>
                                                                    <? } ?>

                                                                    <? if(trim($row_estrutura['lista_relacionado'])==1||trim($row_estrutura['lista_categoria'])==1||trim($row_estrutura['lista_sysplano'])==1||trim($row_estrutura['lista_sysservico'])==1) { ?>
                                                                    <div id="tb3_c" class="tab-pane" style="min-height:350px;">
																		<? if(trim($row_estrutura['lista_relacionado'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                                <label><? if(trim($row_estrutura['lista_relacionado_label'])=="") { echo "Itens Relacionados"; } else { echo $row_estrutura['lista_relacionado_label']; } ?></label>
                                                                                <select id="lista_relacionado_itens" multiple="multiple">
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlItem['id']?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <input value="" style="width:350px;" type="hidden" name="lista_relacionado" id="lista_relacionado" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['lista_relacionado_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['lista_relacionado_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['lista_categoria'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                                <label class="req"><? if(trim($row_estrutura['lista_categoria_label'])=="") { echo "Categorias Relacionados"; } else { echo $row_estrutura['lista_categoria_label']; } ?></label>
                                                                                <select id="lista_categoria_itens" multiple="multiple">
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_categoria ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlItem['id']?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <input value="" style="width:350px;" type="hidden" name="lista_categoria" id="lista_categoria" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['lista_categoria_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['lista_categoria_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
            
                                                                        <? if(trim($row_estrutura['lista_sysplano'])==1) { ?>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
                                                                                <label><? if(trim($row_estrutura['lista_sysplano_label'])=="") { echo "Planos Relacionados"; } else { echo $row_estrutura['lista_sysplano_label']; } ?></label>
                                                                                <select id="lista_sysplano_itens" multiple="multiple">
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysplano ORDER BY ordem");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?=$rSqlItem['id']?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                                <input value="" style="width:350px;" type="hidden" name="lista_sysplano" id="lista_sysplano" />
                                                                            </div>
                                                                            <? if(trim($row_estrutura['lista_sysplano_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['lista_sysplano_info']?></span><? } ?>
                                                                        </div>
                                                                        <? } ?>
                                                                    </div>
                                                                    <? } ?>

                                                                    <? if(trim($row_estrutura['video'])==1) { ?>
                                                                    <div id="tb3_d" class="tab-pane" style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <div style="margin-right:10px;width:100%;float:left;">
                                                                                <div style="float:left;margin-right:10px;">
                                                                                    <label>Título</label>
                                                                                    <input value="" style="width:350px;" type="text" id="nome_video" />
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;">
                                                                                    <label>Link</label>
                                                                                    <input value="" style="width:350px;" type="text" id="link_video" />
                                                                                </div>
                                                                                <div style="float:left;margin-right:10px;margin-top:24px;">
                                                                                    <button type="button" onclick="javascript:adicionar_video_produto('<?=$mod?>','');" class="btn btn-primary">Adicionar Vídeo</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="formSep" id="galeria-video" style="margin-right:10px;width:100%;margin-bottom:50px;float:left;margin-top:20px;">
                                                                        </div>
                                                                    </div>
                                                                    <? } ?>

                                                                    <? if(trim($row_estrutura['galeria'])==1) { ?>
                                                                    <div id="tb3_e" class="tab-pane" style="min-height:350px;">
																		<script type="text/javascript" src="<?=$link?>template/js/upload.js"></script>
                                                                        <script type="text/javascript" >
                                                                            $(function(){
                                                                                new AjaxUpload($('#upload-arquivo'), {
                                                                                    action: '<?=$link?>acoes/<?=$mod?>/drop-arquivo.php?numeroUnicoS=<?=$numeroUnicoGerado?>',
                                                                                    name: 'file',
                                                                                    onSubmit: function(file, ext){
                                                                                    },
                                                                                    onComplete: function(file, response){
                                                                                        parent.$("#galeria-fotos").html(response);
                                                                                    }
                                                                                });
                                                                                
                                                                            });
                                                                        </script>
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;margin-bottom:10px;">
                                                                                <label>Arquivo</label>
                                                                                <input type="button" id="upload-arquivo" value="adicionar arquivo" class="btn" />
                                                                            </div>
                                                                        </div>
                                    
                                                                        <div id="drag-drop-div" class="formSep">
                                                                            <div id="dragandrophandler" style="margin-left:0px;">Arrastar e Soltar os Arquivos Aqui</div>
                                                                            <div id="status1"></div>
                                                                        </div>
                                                                        <script>
                                                                        function sendFileToServer(formData,status)
                                                                        {
                                                                            var uploadURL ="<?=$link?>acoes/<?=$mod?>/drop-arquivo.php"; //Upload URL
                                                                            var extraData = { }; //Extra Data.
                                                                            var jqXHR=$.ajax({
                                                                                    xhr: function() {
                                                                                    var xhrobj = $.ajaxSettings.xhr();
                                                                                    if (xhrobj.upload) {
                                                                                            xhrobj.upload.addEventListener('progress', function(event) {
                                                                                                var percent = 0;
                                                                                                var position = event.loaded || event.position;
                                                                                                var total = event.total;
                                                                                                if (event.lengthComputable) {
                                                                                                    percent = Math.ceil(position / total * 100);
                                                                                                }
                                                                                                //Set progress
                                                                                                status.setProgress(percent);
                                                                                            }, false);
                                                                                        }
                                                                                    return xhrobj;
                                                                                },
                                                                            url: uploadURL,
                                                                            type: "POST",
                                                                            contentType:false,
                                                                            processData: false,
                                                                                cache: false,
                                                                                data: formData,
                                                                                success: function(data){
                                                                                    status.setProgress(100);
                                                                                    parent.$(".statusbar").fadeOut();
                                                                        
                                                                                    parent.$("#galeria-fotos").html(data);
                                                                                }
                                                                            }); 
                                                                         
                                                                            status.setAbort(jqXHR);
                                                                        }
                                                                         
                                                                        var rowCount=0;
                                                                        function createStatusbar(obj)
                                                                        {
                                                                             rowCount++;
                                                                             var row="odd";
                                                                             if(rowCount %2 ==0) row ="even";
                                                                             this.statusbar = $("<div class='statusbar "+row+"'></div>");
                                                                             this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
                                                                             this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
                                                                             this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
                                                                             this.abort = $("<div class='abort'>Cancelar</div>").appendTo(this.statusbar);
                                                                             obj.after(this.statusbar);
                                                                         
                                                                            this.setFileNameSize = function(name,size)
                                                                            {
                                                                                var sizeStr="";
                                                                                var sizeKB = size/1024;
                                                                                if(parseInt(sizeKB) > 1024)
                                                                                {
                                                                                    var sizeMB = sizeKB/1024;
                                                                                    sizeStr = sizeMB.toFixed(2)+" MB";
                                                                                }
                                                                                else
                                                                                {
                                                                                    sizeStr = sizeKB.toFixed(2)+" KB";
                                                                                }
                                                                         
                                                                                this.filename.html(name);
                                                                                this.size.html(sizeStr);
                                                                            }
                                                                            this.setProgress = function(progress)
                                                                            {       
                                                                                var progressBarWidth =progress*this.progressBar.width()/ 100;  
                                                                                this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% &nbsp;");
                                                                                if(parseInt(progress) >= 100)
                                                                                {
                                                                                    this.abort.hide();
                                                                                }
                                                                            }
                                                                            this.setAbort = function(jqxhr)
                                                                            {
                                                                                var sb = this.statusbar;
                                                                                this.abort.click(function()
                                                                                {
                                                                                    jqxhr.abort();
                                                                                    sb.hide();
                                                                                });
                                                                            }
                                                                        }
                                                                        function handleFileUpload(files,obj)
                                                                        {
                                                                           for (var i = 0; i < files.length; i++) 
                                                                           {
                                                                                var fd = new FormData();
                                                                                fd.append('file', files[i]);
                                                                                fd.append('numeroUnicoS','<?=$numeroUnicoGerado?>');
                                                                         
                                                                                var status = new createStatusbar(obj); //Using this we can set progress.
                                                                                status.setFileNameSize(files[i].name,files[i].size);
                                                                                sendFileToServer(fd,status);
                                                                         
                                                                           }
                                                                        }
                                                                        $(document).ready(function()
                                                                        {
                                                                        var obj = $("#dragandrophandler");
                                                                        obj.on('dragenter', function (e) 
                                                                        {
                                                                            e.stopPropagation();
                                                                            e.preventDefault();
                                                                            $(this).css('border', '2px dotted #626262');
                                                                        });
                                                                        obj.on('dragover', function (e) 
                                                                        {
                                                                             e.stopPropagation();
                                                                             e.preventDefault();
                                                                        });
                                                                        obj.on('drop', function (e) 
                                                                        {
                                                                         
                                                                             $(this).css('border', '2px dotted #626262');
                                                                             e.preventDefault();
                                                                             var files = e.originalEvent.dataTransfer.files;
                                                                         
                                                                             //We need to send dropped files to Server
                                                                             handleFileUpload(files,obj);
                                                                        });
                                                                        $(document).on('dragenter', function (e) 
                                                                        {
                                                                            e.stopPropagation();
                                                                            e.preventDefault();
                                                                        });
                                                                        $(document).on('dragover', function (e) 
                                                                        {
                                                                          e.stopPropagation();
                                                                          e.preventDefault();
                                                                          obj.css('border', '2px dotted #626262');
                                                                        });
                                                                        $(document).on('drop', function (e) 
                                                                        {
                                                                            e.stopPropagation();
                                                                            e.preventDefault();
                                                                        });
                                                                         
                                                                        });
                                                                        </script>
                                                                    
                                                                        <div id="galeria-fotos" class="formSep">
                                                                        </div>
            
                                                                    </div>
                                                                    <? } ?>

                                                                    <? if(trim($row_estrutura['seo_item'])==1) { ?>
                                                                    <div id="tb3_f" class="tab-pane" style="min-height:350px;">
                                                                        <div class="formSep">
                                                                            <div style="float:left;width:100%;font-size:18px;color:#1e0fbe;text-decoration: none;" id="titulo_seo_google">Título</div>
                                                                            <div style="float:left;width:100%;font-size:medium;color:#006621;" id="url_amigavel_google"><?=$link_site?></div>
                                                                            <div style="float:left;width:100%;font-size:small;color:#444;margin-bottom:10px;" id="texto_seo_google">Se você não acrescentar nenhum texto, o Meta Description não será exibido</div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label class="req">Título</label>
                                                                                <input value="" style="width:550px;" onkeyup="cria_seo_titulo_e_url('titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','Título','titulo_seo_contador','55');" type="text" name="titulo_seo" id="titulo_seo" />
                                                                                <div style="float:left;width:100%;">A visualização do título em mecânismos de busca é limitada à 55 caracteres, <span style="color:#090;" id="titulo_seo_contador">55</span> restantes.</div>
                                                                            </div>
                                                                        </div>
            
                                                                        <div class="formSep">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label class="req">URL Amigável</label>
                                                                                <input value="" style="width:550px;" type="text" onkeyup="controle_url_amigavel('url_amigavel','url_amigavel_google');" name="url_amigavel" id="url_amigavel" />
                                                                            </div>
                                                                        </div>
                            
                                                                        <div class="formSep">
                                                                            <label>Texto (Meta-Description)</label>
                                                                            <textarea name="texto_seo" id="texto_seo" onkeyup="controle_meta_description('texto_seo','texto_seo_google','texto_seo_contador','Se você não acrescentar nenhum texto, o Meta Description não será exibido','150');" class="span12" style="height:150px;"><?=$row['texto_seo']?></textarea>
                                                                            <div style="float:left;width:100%;">O Meta-Description esta limitado à 150 caracteres, <span style="color:#090;" id="texto_seo_contador">150</span> restantes.</div>
                                                                        </div>
                                                                    </div>
                                                                    <? } ?>

                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                <button type="button" onclick="salvar_continuar_editando();" class="btn btn-primary">Salvar e continuar editando</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <? } ?>
                                                
                                                <? if(trim($row_estrutura['categoria'])==1) { ?>
                                                <div id="tb1_categorias" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>_categoria" />
                
                                                            <? 
                                                            $numeroUnicoGeradoCategoria = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico_categoria" value="<?=$numeroUnicoGeradoCategoria?>">

                                                            <div class="formSep">
                                                                <label class="req">Ordem</label>
                                                                <select id="ordem_categoria" style="width:100px;">
																	<?
                                                                    $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."_categoria"));
                                                                    if($nordem==0) {
                                                                    ?>
                                                                    <option value='1'>1</option>
                                                                    <?
                                                                    } else {
                                                                    $ultimaOrdem = $nordem+1;
                                                                    for ($b=1; $b<=$ultimaOrdem; $b++) {
                                                                    ?>
                                                                    <option value='<?=$b?>' <? if($b==$ultimaOrdem) { echo "selected"; } ?>><?=$b?></option>
                                                                    <? } } ?>
                                                                </select>
                                                            </div>

                                                            <div class="formSep">
                                                                <label class="req">Categoria Pai</label>

																<select id="idpai" >
                                                                    <option value='0'>---</option>
																<? echo monta_select_categoria("","","".$linguagem_set."".$mod."_categoria"); ?>
                                                                </select>

                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Nome</label>
                                                                    <input value="" style="width:350px;" type="text" id="nome_categoria" onkeyup="controle_url_amigavel_apenas('nome_categoria','slug');" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Slug</label>
                                                                    <input value="" style="width:550px;" type="text" onkeyup="controle_url_amigavel_apenas('slug','slug');" id="slug" />
                                                                    <span class="help-block">O "slug" é uma versão amigável da URL. Normalmente, é todo em minúsculas e contém apenas letras, números e hífens.</span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="formSep">
                                                                <button type="button" onclick="salvar_categoria_com_pai('<?=$mod?>','_categoria');" class="btn btn-primary">Adicionar</button>
                                                            </div>
                                                            <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                <div style="float:left;margin-right:10px;width:100%;padding-bottom:10px;padding-top:10px;">Lista de categorias</div>
                                                                <div id="lista_categoria_itens" style="width:100%;float:left;">
																	<? $subLocalGet = "_categoria"; include("./acoes/sysgeral/lista_categoria_old.php"); ?>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <? } ?>

                                                <div id="tb1_config" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data">
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="acaoForm" value="config" />
                            
                                                            <? if(trim($row_estrutura['nome_seo'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req"><? if(trim($row_estrutura['nome_seo_label'])=="") { echo "Título da Página"; } else { echo $row_estrutura['nome_seo_label']; } ?></label>
                                                                    <input value="<?=$row_config['nome']?>" style="width:350px;" type="text" name="nome" id="nome_seo" />
                                                                </div>
                                                                <? if(trim($row_estrutura['nome_seo_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['nome_seo_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
            
                                                            <? if(trim($row_estrutura['imagem_descricao'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['imagem_decricao_label'])=="") { echo "Imagem do Cabeçalho"; } else { echo $row_estrutura['imagem_decricao_label']; } ?></label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail">
                                                                    <? if(trim($row_config['imagem_descricao'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['imagem_descricao']?>"><img style="width:50px;" id="arquivo-atual-imagem_descricao" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['imagem_descricao']?>" alt=""></a>
                                                                    <? } ?>
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <? if(trim($row_config['imagem_descricao'])=="") { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span class="fileupload-new">Selecionar arquivo</span>
                                                                        <span class="fileupload-exists">Alterar</span>
                                                                        <input name="imagem_descricao" type="file">
                                                                    </span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                    <? } else { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span>Alterar</span>
                                                                        <input name="imagem_descricao" type="file">
                                                                    </span>
                                                                    <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>_config','imagem_descricao');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                    <? } ?>
                                                                </div>
                                                                <? if(trim($row_estrutura['imagem_descricao_info'])=="") { } else { ?><span class="help-block"><?=$row_estrutura['imagem_descricao_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
            
                                                            <? if(trim($row_estrutura['imagem_interna'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['imagem_interna_label'])=="") { echo "Imagem Interna"; } else { echo $row_estrutura['imagem_interna_label']; } ?></label>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail">
                                                                    <? if(trim($row_config['imagem_interna'])=="") { ?>
                                                                    <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                    <? } else { ?>
                                                                    <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['imagem_interna']?>"><img style="width:50px;" id="arquivo-atual-imagem_interna" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['imagem_interna']?>" alt=""></a>
                                                                    <? } ?>
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                    <? if(trim($row_config['imagem_interna'])=="") { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span class="fileupload-new">Selecionar arquivo</span>
                                                                        <span class="fileupload-exists">Alterar</span>
                                                                        <input name="imagem_interna" type="file">
                                                                    </span>
                                                                    <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                    <? } else { ?>
                                                                    <span class="btn btn-small btn-file">
                                                                        <span>Alterar</span>
                                                                        <input name="imagem_interna" type="file">
                                                                    </span>
                                                                    <a href="javascript:void(0);" onclick="remover_imagem('<?=$row_config['id']?>','<?=$mod?>_config','imagem_interna');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                                                    <? } ?>
                                                                </div>
                                                                <? if(trim($row_estrutura['imagem_interna_info'])=="") { } else { ?><span class="help-block"><?=$row_estrutura['imagem_interna_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
            
                                                            <? if(trim($row_estrutura['titulo_texto'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                <label><? if(trim($row_estrutura['titulo_texto_label'])=="") { echo "Título do Texto"; } else { echo $row_estrutura['titulo_texto_label']; } ?></label>
                                                                    <input value="<?=$row_config['titulo_texto']?>" style="width:350px;" type="text" name="titulo_texto" id="titulo_texto" />
                                                                </div>
                                                                <? if(trim($row_estrutura['titulo_texto_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['titulo_texto_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
            
                                                            <? if(trim($row_estrutura['chamada_descricao'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['chamada_descricao_label'])=="") { echo "Chamada"; } else { echo $row_estrutura['chamada_descricao_label']; } ?></label>
                                                                <textarea name="chamada_descricao" id="chamada_descricao" class="span12" style="height:150px;"><?=$row_config['chamada_descricao']?></textarea>
                                                                <? if(trim($row_estrutura['chamada_descricao_info'])=="") { } else { ?><span class="help-block" style="width:100%;margin-top:10px;"><?=$row_estrutura['chamada_descricao_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
            
                                                            <? if(trim($row_estrutura['texto_descricao'])==1) { ?>
                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['texto_descricao_label'])=="") { echo "Texto"; } else { echo $row_estrutura['texto_descricao_label']; } ?></label>
                                                                <textarea name="texto_descricao" id="texto_descricao" class="span12" style="height:150px;"><?=$row_config['texto_descricao']?></textarea>
                                                                <? if(trim($row_estrutura['texto_descricao_info'])=="") { } else { ?><span class="help-block" style="width:100%;margin-top:10px;"><?=$row_estrutura['texto_descricao_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>

                                                            <? if(trim($row_estrutura['texto_promocao'])==1) { ?>
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Texto da Página de Promoção</label>
                                                                    <input type="checkbox" name="texto_promocao_set" id="texto_promocao_set" <? if(trim($row_config['texto_promocao_set'])==1) { echo " checked"; } ?> class="texto_promocao_set {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label><? if(trim($row_estrutura['texto_promocao_label'])=="") { echo "Texto da Página de Promoção"; } else { echo $row_estrutura['texto_promocao_label']; } ?></label>
                                                                <textarea name="texto_promocao" id="texto_promocao" class="span12" style="height:150px;"><?=$row_config['texto_promocao']?></textarea>
                                                                <? if(trim($row_estrutura['texto_promocao_info'])=="") { } else { ?><span class="help-block" style="width:100%;margin-top:10px;"><?=$row_estrutura['texto_promocao_info']?></span><? } ?>
                                                            </div>
                                                            <? } ?>
                            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Produtos da Página de Promoção</label>
                                                                    <input type="checkbox" name="produtos_set" id="produtos_set" <? if(trim($row_config['produtos_set'])==1) { echo " checked"; } ?> class="produtos_set {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <? if(trim($row_estrutura['seo'])==1) { ?>
                                                <div id="tb1_config_seo" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data">
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="acaoForm" value="config_seo" />
                
                                                            <? 
															if(trim($row_config['titulo_seo'])=="") {
																if(trim($row_config['nome'])=="") {
																	$titulo_seo = "Título"; 
																	$tamanho_titulo_seo = 55; 
																} else {
																	$titulo_seo = $row_config['nome']; 
																	$tamanho_titulo_seo = 55 - strlen($row_config['nome']); 
																}
															} else {
																$titulo_seo = $row_config['titulo_seo']; 
																$tamanho_titulo_seo = 55 - strlen($row_config['titulo_seo']); 
															}

															if(trim($row_config['texto_seo'])=="") {  
																$texto_seo = "Se você não acrescentar nenhum texto, o Meta Description não será exibido"; 
																$tamanho_texto_seo = 150; 
															} else {
																$texto_seo = $row_config['texto_seo']; 
																$tamanho_texto_seo = 150 - strlen($row_config['texto_seo']); 
															}
															?>
                                                            <div class="formSep">
                                                                <div style="float:left;width:100%;font-size:18px;color:#1e0fbe;text-decoration: none;" id="SEO_titulo_seo_google"><?=$titulo_seo?></div>
                                                                <div style="float:left;width:100%;font-size:medium;color:#006621;" id="SEO_url_amigavel_google"><?=$link_site?><?=$row_config['url_amigavel']?></div>
                                                                <div style="float:left;width:100%;font-size:small;color:#444;margin-bottom:10px;" id="SEO_texto_seo_google"><?=$texto_seo?></div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Título</label>
                                                                    <input value="<?=$titulo_seo?>" style="width:550px;" onkeyup="cria_seo_titulo_e_url('SEO_titulo_seo','SEO_titulo_seo_google','SEO_url_amigavel','SEO_url_amigavel_google','<?=$titulo_seo?>','SEO_titulo_seo_contador','55');" type="text" name="titulo_seo" id="SEO_titulo_seo" />
                                                                    <div style="float:left;width:100%;">A visualização do título em mecânismos de busca é limitada à 55 caracteres, <span style="color:#090;" id="SEO_titulo_seo_contador"><?=$tamanho_titulo_seo?></span> restantes.</div>
                                                                </div>
                                                            </div>

                                                            <div class="formSep" style="width:500px;">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">URL Amigável</label>
                                                                    <input value="<?=$row_config['url_amigavel']?>" onkeyup="controle_url_amigavel('SEO_url_amigavel','SEO_url_amigavel_google');"  style="width:350px;" type="text" name="url_amigavel" id="SEO_url_amigavel" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativa ?</label>
                                                                    <input type="checkbox" name="url_amigavel_ativa" id="url_amigavel_ativa" <? if(trim($row_config['url_amigavel_ativa'])==1) { echo " checked"; } ?> class="url_amigavel_ativa {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Texto (Meta-Description)</label>
                                                                <textarea name="texto_seo" id="SEO_texto_seo" onkeyup="controle_meta_description('SEO_texto_seo','SEO_texto_seo_google','SEO_texto_seo_contador','<?=$texto_seo?>','150');" class="span12" style="height:150px;"><?=$row_config['texto_seo']?></textarea>
                                                                <div style="float:left;width:100%;">O Meta-Description esta limitado à 150 caracteres, <span style="color:#090;" id="SEO_texto_seo_contador"><?=$tamanho_texto_seo?></span> restantes.</div>
                                                            </div>

                                                            <?
															if(trim($row_config['url_amigavel'])=="") {
																echo"<script>cria_seo_titulo_e_url('SEO_titulo_seo','SEO_titulo_seo_google','SEO_url_amigavel','SEO_url_amigavel_google','".$titulo_seo."','SEO_titulo_seo_contador','55');</script>";
															}
															?>
                
                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <? } ?>

												<? if(trim($sysusu['adm'])==1) { ?>
                                                <div id="tb1_estrutura" class="tab-pane">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" name="acaoForm" value="estrutura" />
                
            
                                                            <div class="aba_config_adm"><a href="javascript:void(0);" onclick="verMais('config_aba_seo_e_cat');">SEO e Categoria do Módulo</a></div>
                                                            <div class="aba_config_campos" id="config_aba_seo_e_cat">
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Configurações de SEO</label>
                                                                    <input value="<?=$row_estrutura['seo_label']?>"  style="width:350px;" type="text" name="seo_label" id="seo_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="seo" id="seo_estrutura" <? if(trim($row_estrutura['seo'])==1) { echo " checked"; } ?> class="seo_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>
 
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Galeria de Foto ?</label>
                                                                    <input type="checkbox" name="galeria" id="galeria_estrutura" <? if(trim($row_estrutura['galeria'])==1) { echo " checked"; } ?> class="galeria_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Galeria de Vídeo ?</label>
                                                                    <input type="checkbox" name="video" id="video_estrutura" <? if(trim($row_estrutura['video'])==1) { echo " checked"; } ?> class="video_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Lista de Categorias ?</label>
                                                                    <input type="checkbox" name="categoria" id="categoria_estrutura" <? if(trim($row_estrutura['categoria'])==1) { echo " checked"; } ?> class="categoria_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>
                                                            </div>

                                                            <div class="aba_config_adm"><a href="javascript:void(0);" onclick="verMais('config_aba_descricao');">Aba Descrição</a></div>
                                                            <div class="aba_config_campos" id="config_aba_descricao">
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Título da Página'</label>
                                                                    <input value="<?=$row_estrutura['nome_seo_label']?>"  style="width:350px;" type="text" name="nome_seo_label" id="nome_seo_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="nome_seo" id="nome_seo_estrutura" <? if(trim($row_estrutura['nome_seo'])==1) { echo " checked"; } ?> class="nome_seo_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['nome_seo_info']?>"class="span7" type="text" name="nome_seo_info" id="nome_seo_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Título do Texto'</label>
                                                                    <input value="<?=$row_estrutura['titulo_texto_label']?>"  style="width:350px;" type="text" name="titulo_texto_label" id="titulo_texto_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="titulo_texto" id="titulo_texto_estrutura" <? if(trim($row_estrutura['titulo_texto'])==1) { echo " checked"; } ?> class="titulo_texto_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['titulo_texto_info']?>"class="span7" type="text" name="titulo_texto_info" id="titulo_texto_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Imagem de Cabeçalho'</label>
                                                                    <input value="<?=$row_estrutura['imagem_descricao_label']?>"  style="width:350px;" type="text" name="imagem_descricao_label" id="imagem_descricao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="imagem_descricao" id="imagem_descricao_estrutura" <? if(trim($row_estrutura['imagem_descricao'])==1) { echo " checked"; } ?> class="imagem_descricao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['imagem_descricao_info']?>"class="span7" type="text" name="imagem_descricao_info" id="imagem_descricao_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Imagem Interna'</label>
                                                                    <input value="<?=$row_estrutura['imagem_interna_label']?>"  style="width:350px;" type="text" name="imagem_interna_label" id="imagem_interna_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="imagem_interna" id="imagem_interna_estrutura" <? if(trim($row_estrutura['imagem_interna'])==1) { echo " checked"; } ?> class="imagem_interna_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['imagem_interna_info']?>"class="span7" type="text" name="imagem_interna_info" id="imagem_interna_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Chamada'</label>
                                                                    <input value="<?=$row_estrutura['chamada_descricao_label']?>"  style="width:350px;" type="text" name="chamada_descricao_label" id="chamada_descricao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="chamada_descricao" id="chamada_descricao_estrutura" <? if(trim($row_estrutura['chamada_descricao'])==1) { echo " checked"; } ?> class="chamada_descricao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['chamada_descricao_info']?>"class="span7" type="text" name="chamada_descricao_info" id="chamada_descricao_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Texto'</label>
                                                                    <input value="<?=$row_estrutura['texto_descricao_label']?>"  style="width:350px;" type="text" name="texto_descricao_label" id="texto_descricao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="texto_descricao" id="texto_descricao_estrutura" <? if(trim($row_estrutura['texto_descricao'])==1) { echo " checked"; } ?> class="texto_descricao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['texto_descricao_info']?>"class="span7" type="text" name="texto_descricao_info" id="texto_descricao_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Texto Página de Promoção'</label>
                                                                    <input value="<?=$row_estrutura['texto_promocao_label']?>"  style="width:350px;" type="text" name="texto_promocao_label" id="texto_promocao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="texto_promocao" id="texto_promocao_estrutura" <? if(trim($row_estrutura['texto_promocao'])==1) { echo " checked"; } ?> class="texto_promocao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['texto_promocao_info']?>"class="span7" type="text" name="texto_promocao_info" id="texto_promocao_info" />
                                                                </div>
                                                            </div>
                                                            </div>

                                                            <div class="aba_config_adm"><a href="javascript:void(0);" onclick="verMais('config_aba_campo');">Campos do Módulo</a></div>
                                                            <div class="aba_config_campos" id="config_aba_campo">
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Configurações de SEO do Item</label>
                                                                    <input value="<?=$row_estrutura['seo_item_label']?>"  style="width:350px;" type="text" name="seo_item_label" id="seo_item_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="seo_item" id="seo_item_estrutura" <? if(trim($row_estrutura['seo_item'])==1) { echo " checked"; } ?> class="seo_item_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Categoria'</label>
                                                                    <input value="<?=$row_estrutura['id'.$mod.'_categoria_label']?>"  style="width:350px;" type="text" name="id<?=$mod?>_categoria_label" id="id<?=$mod?>_categoria_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="id<?=$mod?>_categoria" id="id<?=$mod?>_categoria_estrutura" <? if(trim($row_estrutura['id'.$mod.'_categoria'])==1) { echo " checked"; } ?> class="id<?=$mod?>_categoria_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['id'.$mod.'_categoria_info']?>"class="span7" type="text" name="id<?=$mod?>_categoria_info" id="id<?=$mod?>_categoria_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Ordem'</label>
                                                                    <input value="<?=$row_estrutura['ordem_label']?>"  style="width:350px;" type="text" name="ordem_label" id="ordem_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="ordem" id="ordem_estrutura" <? if(trim($row_estrutura['ordem'])==1) { echo " checked"; } ?> class="ordem_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['ordem_info']?>"class="span7" type="text" name="ordem_info" id="ordem_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Lista de Itens Relacionados'</label>
                                                                    <input value="<?=$row_estrutura['lista_relacionado_label']?>"  style="width:350px;" type="text" name="lista_relacionado_label" id="lista_relacionado_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="lista_relacionado" id="lista_relacionado_estrutura" <? if(trim($row_estrutura['lista_relacionado'])==1) { echo " checked"; } ?> class="lista_relacionado_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['lista_relacionado_info']?>"class="span7" type="text" name="lista_relacionado_info" id="lista_relacionado_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Lista de Categorias Relacionados'</label>
                                                                    <input value="<?=$row_estrutura['lista_categoria_label']?>"  style="width:350px;" type="text" name="lista_categoria_label" id="lista_categoria_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="lista_categoria" id="lista_categoria_estrutura" <? if(trim($row_estrutura['lista_categoria'])==1) { echo " checked"; } ?> class="lista_categoria_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['lista_categoria_info']?>"class="span7" type="text" name="lista_categoria_info" id="lista_categoria_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Lista de Planos Relacionados'</label>
                                                                    <input value="<?=$row_estrutura['lista_sysplano_label']?>"  style="width:350px;" type="text" name="lista_sysplano_label" id="lista_sysplano_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="lista_sysplano" id="lista_sysplano_estrutura" <? if(trim($row_estrutura['lista_sysplano'])==1) { echo " checked"; } ?> class="lista_sysplano_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['lista_sysplano_info']?>"class="span7" type="text" name="lista_sysplano_info" id="lista_sysplano_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Destaque'</label>
                                                                    <input value="<?=$row_estrutura['destaque_label']?>"  style="width:350px;" type="text" name="destaque_label" id="destaque_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="destaque" id="destaque_estrutura" <? if(trim($row_estrutura['destaque'])==1) { echo " checked"; } ?> class="destaque_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['destaque_info']?>"class="span7" type="text" name="destaque_info" id="destaque_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Lançamento'</label>
                                                                    <input value="<?=$row_estrutura['lancamento_label']?>"  style="width:350px;" type="text" name="lancamento_label" id="lancamento_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="lancamento" id="lancamento_estrutura" <? if(trim($row_estrutura['lancamento'])==1) { echo " checked"; } ?> class="lancamento_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['lancamento_info']?>"class="span7" type="text" name="lancamento_info" id="lancamento_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Título'</label>
                                                                    <input value="<?=$row_estrutura['nome_label']?>"  style="width:350px;" type="text" name="nome_label" id="nome_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="nome" id="nome_estrutura" <? if(trim($row_estrutura['nome'])==1) { echo " checked"; } ?> class="nome_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['nome_info']?>"class="span7" type="text" name="nome_info" id="nome_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Código do produto'</label>
                                                                    <input value="<?=$row_estrutura['cod_label']?>"  style="width:350px;" type="text" name="cod_label" id="cod_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="cod" id="cod_estrutura" <? if(trim($row_estrutura['cod'])==1) { echo " checked"; } ?> class="cod_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['cod_info']?>"class="span7" type="text" name="cod_info" id="cod_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Tags relacionadas'</label>
                                                                    <input value="<?=$row_estrutura['tags_label']?>"  style="width:350px;" type="text" name="tags_label" id="tags_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="tags" id="tags_estrutura" <? if(trim($row_estrutura['tags'])==1) { echo " checked"; } ?> class="tags_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['tags_info']?>"class="span7" type="text" name="tags_info" id="tags_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Valor'</label>
                                                                    <input value="<?=$row_estrutura['valor_label']?>"  style="width:350px;" type="text" name="valor_label" id="valor_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="valor" id="valor_estrutura" <? if(trim($row_estrutura['valor'])==1) { echo " checked"; } ?> class="valor_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['valor_info']?>"class="span7" type="text" name="valor_info" id="valor_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Promoção'</label>
                                                                    <input value="<?=$row_estrutura['promocao_label']?>"  style="width:350px;" type="text" name="promocao_label" id="promocao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="promocao" id="promocao_estrutura" <? if(trim($row_estrutura['promocao'])==1) { echo " checked"; } ?> class="promocao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['promocao_info']?>"class="span7" type="text" name="promocao_info" id="promocao_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Valor de Promoção'</label>
                                                                    <input value="<?=$row_estrutura['valor_promocao_label']?>"  style="width:350px;" type="text" name="valor_promocao_label" id="valor_promocao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="valor_promocao" id="valor_promocao_estrutura" <? if(trim($row_estrutura['valor_promocao'])==1) { echo " checked"; } ?> class="valor_promocao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['valor_promocao_info']?>"class="span7" type="text" name="valor_promocao_info" id="valor_promocao_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Valor de Mensalidade'</label>
                                                                    <input value="<?=$row_estrutura['valor_mensalidade_label']?>"  style="width:350px;" type="text" name="valor_mensalidade_label" id="valor_mensalidade_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="valor_mensalidade" id="valor_mensalidade_estrutura" <? if(trim($row_estrutura['valor_mensalidade'])==1) { echo " checked"; } ?> class="valor_mensalidade_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['valor_mensalidade_info']?>"class="span7" type="text" name="valor_mensalidade_info" id="valor_mensalidade_info" />
                                                                </div>
                                                            </div>


                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Qtd. em Estoque'</label>
                                                                    <input value="<?=$row_estrutura['qtd_estoque_label']?>"  style="width:350px;" type="text" name="qtd_estoque_label" id="qtd_estoque_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="qtd_estoque" id="qtd_estoque_estrutura" <? if(trim($row_estrutura['qtd_estoque'])==1) { echo " checked"; } ?> class="qtd_estoque_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['qtd_estoque_info']?>"class="span7" type="text" name="qtd_estoque_info" id="qtd_estoque_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Frete'</label>
                                                                    <input value="<?=$row_estrutura['frete_label']?>"  style="width:350px;" type="text" name="frete_label" id="frete_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="frete" id="frete_estrutura" <? if(trim($row_estrutura['frete'])==1) { echo " checked"; } ?> class="frete_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['frete_info']?>"class="span7" type="text" name="frete_info" id="frete_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Imagem'</label>
                                                                    <input value="<?=$row_estrutura['imagem_label']?>"  style="width:350px;" type="text" name="imagem_label" id="imagem_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="imagem" id="imagem_estrutura" <? if(trim($row_estrutura['imagem'])==1) { echo " checked"; } ?> class="imagem_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['imagem_info']?>"class="span7" type="text" name="imagem_info" id="imagem_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Data de Publicação'</label>
                                                                    <input value="<?=$row_estrutura['data_publicacao_label']?>"  style="width:350px;" type="text" name="data_publicacao_label" id="data_publicacao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="data_publicacao" id="data_publicacao_estrutura" <? if(trim($row_estrutura['data_publicacao'])==1) { echo " checked"; } ?> class="data_publicacao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['data_publicacao_info']?>"class="span7" type="text" name="data_publicacao_info" id="data_publicacao_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Data de Despublicação'</label>
                                                                    <input value="<?=$row_estrutura['data_despublicacao_label']?>"  style="width:350px;" type="text" name="data_despublicacao_label" id="data_despublicacao_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="data_despublicacao" id="data_despublicacao_estrutura" <? if(trim($row_estrutura['data_despublicacao'])==1) { echo " checked"; } ?> class="data_despublicacao_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['data_despublicacao_info']?>"class="span7" type="text" name="data_despublicacao_info" id="data_despublicacao_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Data Original'</label>
                                                                    <input value="<?=$row_estrutura['data_post_label']?>"  style="width:350px;" type="text" name="data_post_label" id="data_post_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="data_post" id="data_post_estrutura" <? if(trim($row_estrutura['data_post'])==1) { echo " checked"; } ?> class="data_post_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['data_post_info']?>"class="span7" type="text" name="data_post_info" id="data_post_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Hora Original'</label>
                                                                    <input value="<?=$row_estrutura['hora_post_label']?>"  style="width:350px;" type="text" name="hora_post_label" id="hora_post_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="hora_post" id="hora_post_estrutura" <? if(trim($row_estrutura['hora_post'])==1) { echo " checked"; } ?> class="hora_post_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['hora_post_info']?>"class="span7" type="text" name="hora_post_info" id="hora_post_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Chamada'</label>
                                                                    <input value="<?=$row_estrutura['chamada_label']?>"  style="width:350px;" type="text" name="chamada_label" id="chamada_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="chamada" id="chamada_estrutura" <? if(trim($row_estrutura['chamada'])==1) { echo " checked"; } ?> class="chamada_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['chamada_info']?>"class="span7" type="text" name="chamada_info" id="chamada_info" />
                                                                </div>
                                                            </div>
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Texto'</label>
                                                                    <input value="<?=$row_estrutura['texto_label']?>"  style="width:350px;" type="text" name="texto_label" id="texto_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="texto" id="texto_estrutura" <? if(trim($row_estrutura['texto'])==1) { echo " checked"; } ?> class="texto_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['texto_info']?>"class="span7" type="text" name="texto_info" id="texto_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Informações do Produto'</label>
                                                                    <input value="<?=$row_estrutura['info_produto_label']?>"  style="width:350px;" type="text" name="info_produto_label" id="info_produto_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="info_produto" id="info_produto_estrutura" <? if(trim($row_estrutura['info_produto'])==1) { echo " checked"; } ?> class="info_produto_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['info_produto_info']?>"class="span7" type="text" name="info_produto_info" id="info_produto_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Informações Técnicas'</label>
                                                                    <input value="<?=$row_estrutura['info_tecnica_label']?>"  style="width:350px;" type="text" name="info_tecnica_label" id="info_tecnica_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="info_tecnica" id="info_tecnica_estrutura" <? if(trim($row_estrutura['info_tecnica'])==1) { echo " checked"; } ?> class="info_tecnica_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['info_tecnica_info']?>"class="span7" type="text" name="info_tecnica_info" id="info_tecnica_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Texto de Garantia'</label>
                                                                    <input value="<?=$row_estrutura['garantia_label']?>"  style="width:350px;" type="text" name="garantia_label" id="garantia_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="garantia" id="garantia_estrutura" <? if(trim($row_estrutura['garantia'])==1) { echo " checked"; } ?> class="garantia_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['garantia_info']?>"class="span7" type="text" name="garantia_info" id="garantia_info" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo 'Manual'</label>
                                                                    <input value="<?=$row_estrutura['manual_label']?>"  style="width:350px;" type="text" name="manual_label" id="manual_label" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label>Ativo ?</label>
                                                                    <input type="checkbox" name="manual" id="manual_estrutura" <? if(trim($row_estrutura['manual'])==1) { echo " checked"; } ?> class="manual_estrutura {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Informações Extras</label>
                                                                    <input value="<?=$row_estrutura['manual_info']?>"class="span7" type="text" name="manual_info" id="manual_info" />
                                                                </div>
                                                            </div>
                                                            </div>
            
                                                            <div class="aba_config_adm"><a href="javascript:void(0);" onclick="verMais('config_aba_outros');">Outras Configurações</a></div>
                                                            <div class="aba_config_campos" id="config_aba_outros">
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo de ordenação 1</label>
                                                                    <select name="campo_ordem_1" id="campo_ordem_1">
                                                                        <option value="">---</option>
                                                                        <option value='nome' <? if($row_estrutura['campo_ordem_1']=="nome") { echo "selected"; } ?>><? if(trim($row_estrutura['nome_label'])=="") { echo "Nome"; } else { echo $row_estrutura['nome_label']; } ?></option>
                                                                        <option value='valor' <? if($row_estrutura['campo_ordem_1']=="valor") { echo "selected"; } ?>><? if(trim($row_estrutura['valor_label'])=="") { echo "Valor"; } else { echo $row_estrutura['valor_label']; } ?></option>
                                                                        <option value='ordem' <? if($row_estrutura['campo_ordem_1']=="ordem") { echo "selected"; } ?>><? if(trim($row_estrutura['ordem_label'])=="") { echo "Ordem"; } else { echo $row_estrutura['ordem_label']; } ?></option>
                                                                        <option value='data_post' <? if($row_estrutura['campo_ordem_1']=="data_post") { echo "selected"; } ?>><? if(trim($row_estrutura['data_post_label'])=="") { echo "Data Original"; } else { echo $row_estrutura['data_post_label']; } ?></option>
                                                                        <option value='hora_post' <? if($row_estrutura['campo_ordem_1']=="hora_post") { echo "selected"; } ?>><? if(trim($row_estrutura['hora_post_label'])=="") { echo "Hora Original"; } else { echo $row_estrutura['hora_post_label']; } ?></option>
                                                                        <option value='data_publicacao' <? if($row_estrutura['campo_ordem_1']=="data_publicacao") { echo "selected"; } ?>><? if(trim($row_estrutura['data_publicacao_label'])=="") { echo "Data de Publicação"; } else { echo $row_estrutura['data_publicacao_label']; } ?></option>
                                                                        <option value='destaque' <? if($row_estrutura['campo_ordem_1']=="destaque") { echo "selected"; } ?>><? if(trim($row_estrutura['destaque_label'])=="") { echo "Em Destaque"; } else { echo $row_estrutura['destaque_label']; } ?></option>
                                                                    </select>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label class="req">Tipo de ordenação 1</label>
                                                                    <select name="campo_ordem_tipo_1" id="campo_ordem_tipo_1" style="width:320px;">
                                                                        <option value="">---</option>
                                                                        <option value='ASC' <? if($row_estrutura['campo_ordem_tipo_1']=="ASC") { echo "selected"; } ?>>ASCENDENTE - do MENOR para o MAIOR</option>
                                                                        <option value='DESC' <? if($row_estrutura['campo_ordem_tipo_1']=="DESC") { echo "selected"; } ?>>DECRESCENTE - do MAIOR para o MENOR</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Campo de ordenação 2</label>
                                                                    <select name="campo_ordem_2" id="campo_ordem_2">
                                                                        <option value="">---</option>
                                                                        <option value='nome' <? if($row_estrutura['campo_ordem_2']=="nome") { echo "selected"; } ?>><? if(trim($row_estrutura['nome_label'])=="") { echo "Nome"; } else { echo $row_estrutura['nome_label']; } ?></option>
                                                                        <option value='valor' <? if($row_estrutura['campo_ordem_2']=="valor") { echo "selected"; } ?>><? if(trim($row_estrutura['valor_label'])=="") { echo "Valor"; } else { echo $row_estrutura['valor_label']; } ?></option>
                                                                        <option value='ordem' <? if($row_estrutura['campo_ordem_2']=="ordem") { echo "selected"; } ?>><? if(trim($row_estrutura['ordem_label'])=="") { echo "Ordem"; } else { echo $row_estrutura['ordem_label']; } ?></option>
                                                                        <option value='data_post' <? if($row_estrutura['campo_ordem_2']=="data_post") { echo "selected"; } ?>><? if(trim($row_estrutura['data_post_label'])=="") { echo "Data Original"; } else { echo $row_estrutura['data_post_label']; } ?></option>
                                                                        <option value='hora_post' <? if($row_estrutura['campo_ordem_2']=="hora_post") { echo "selected"; } ?>><? if(trim($row_estrutura['hora_post_label'])=="") { echo "Hora Original"; } else { echo $row_estrutura['hora_post_label']; } ?></option>
                                                                        <option value='data_publicacao' <? if($row_estrutura['campo_ordem_2']=="data_publicacao") { echo "selected"; } ?>><? if(trim($row_estrutura['data_publicacao_label'])=="") { echo "Data de Publicação"; } else { echo $row_estrutura['data_publicacao_label']; } ?></option>
                                                                        <option value='destaque' <? if($row_estrutura['campo_ordem_2']=="destaque") { echo "selected"; } ?>><? if(trim($row_estrutura['destaque_label'])=="") { echo "Em Destaque"; } else { echo $row_estrutura['destaque_label']; } ?></option>
                                                                    </select>
                                                                </div>
                                                                <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                    <label class="req">Tipo de ordenação 2</label>
                                                                    <select name="campo_ordem_tipo_2" id="campo_ordem_tipo_2" style="width:320px;">
                                                                        <option value="">---</option>
                                                                        <option value='ASC' <? if($row_estrutura['campo_ordem_tipo_2']=="ASC") { echo "selected"; } ?>>ASCENDENTE - do MENOR para o MAIOR</option>
                                                                        <option value='DESC' <? if($row_estrutura['campo_ordem_tipo_2']=="DESC") { echo "selected"; } ?>>DECRESCENTE - do MAIOR para o MENOR</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                                <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
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
