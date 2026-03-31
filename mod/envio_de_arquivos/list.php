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
                                            });
            
                                            //* form validation
                                            forms = {
                                                simple: function() {
                                                    if($('#formulario').length) {
                                                        $('#formulario').validate({
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
															"aoColumns": [
																{ "bSortable": false },
																{ "sType": "string" },
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };
                                            </script>
                                            <div class="tab-content">
                                                
                                                <div id="tb1_novo" class="tab-pane active">

                                                    <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" value="add" />
                                                        <input type="hidden" name="modulo" value="envio_de_arquivos" />
            
                                                        <? 
                                                        $numeroUnicoGerado = geraCodReturn(); 
                                                        ?>
                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
            
                                                        <input type="hidden" name="stat" value="1" />
            

														<script type="text/javascript" src="<?=$link?>template/js/upload.js"></script>
                                                        <script type="text/javascript" >
                                                            $(function(){
                                                                new AjaxUpload($('#upload-arquivo'), {
                                                                    action: '<?=$link?>acoes/envio_de_arquivos/drop-arquivo.php?numeroUnico_upload_arquivo=<?=$numeroUnicoGerado?>',
                                                                    name: 'file',
                                                                    onSubmit: function(file, ext){
                                                                    },
                                                                    onComplete: function(file, response){
                                                                        window.open('<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/','_self','');
                                                                        $("#upload-arquivo").fadeOut();
                                                                        $("#upload-aviso").fadeOut();
                                                                        $("#preloader-categoria").show();
                                                                    }
                                                                });
                                                                
                                                            });
                                                        </script>
                                                        <div class="formSep">
                                                            <label>Arquivo Compactado</label>
                                                            <div id="preloader-categoria" style="width:100%;float:left;display:none;margin-top:5px;">
                                                                <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                                                <div style="float:left;">enviando arquivo... realizando processo!</div>
                                                            </div>
                                                            <input type="button" id="upload-arquivo" value="adicionar arquivo" class="btn" />
                                                            <span id="upload-aviso" style="width:100%;float:left;padding:10px;border:1px solid #FC3;background-color:#FFC;color:#000;
                                                            font-size:24px;font-weight:bold;margin-top:10px;">Selecione um arquivo e aguarde a página ser recarregada ao fim do processo</span>
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
