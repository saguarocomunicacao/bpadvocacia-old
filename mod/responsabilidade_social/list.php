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
                                    <? if(trim($sysperm['descricao_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_a">Descrição</a></li><? } ?>
                                    <? if(trim($row_estrutura['seo'])==1) { ?><? if(trim($sysperm['seo_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#tb1_b"><? if(trim($row_estrutura['seo_label'])=="") { echo "Configurações de SEO"; } else { echo $row_estrutura['seo_label']; } ?></a></li><? } ?><? } ?>
                                    <? if(trim($sysusu['adm'])==1) { ?><li><a data-toggle="tab" href="#tb1_estrutura">Configurações de Estrutura do Módulo</a></li><? } ?>
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

                                    <? if(trim($row_estrutura['seo'])==1||trim($sysusu['adm'])==1) { ?>
									//* switch buttons
                                    beoro_switchButtons.init();
									<? } ?>

                                    <? if(trim($row_estrutura['chamada_descricao'])==1||trim($row_estrutura['texto_descricao'])==1) { ?>
									//* WYSIWG Editor
                                    beoro_wysiwg.init();
									<? } ?>
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
                                                "sPaginationType": "bootstrap_full"
                                            });
                                        }
                                    }
                                };

                                <? if(trim($row_estrutura['chamada_descricao'])==1||trim($row_estrutura['texto_descricao'])==1) { ?>
								//* WYSIWG Editor
                                beoro_wysiwg = {
                                    init: function() {
                                        <? if(trim($row_estrutura['chamada_descricao'])==1) { ?>
										if($('#chamada_descricao').length) { 
                                            CKEDITOR.replace( 'chamada_descricao', {
                                                toolbar: 'Standard'
                                            });
                                        }
										<? } ?>
                                        <? if(trim($row_estrutura['texto_descricao'])==1) { ?>
										if($('#texto_descricao').length) { 
                                            CKEDITOR.replace( 'texto_descricao', {
                                                toolbar: 'Standard'
                                            });
                                        }
										<? } ?>
                                    }
                                };
								<? } ?>

                                <? if(trim($row_estrutura['seo'])==1||trim($sysusu['adm'])==1) { ?>
								//* switch buttons
                                beoro_switchButtons = {
                                    init: function() {
                                        <? if(trim($row_estrutura['seo'])==1) { ?>
										if($('#url_amigavel_ativa').length) { $("#url_amigavel_ativa").iButton(); }
										<? } ?>

                                        <? if(trim($sysusu['adm'])==1) { ?>
										if($('#seo_estrutura').length) { $("#seo_estrutura").iButton(); }
										if($('#galeria_estrutura').length) { $("#galeria_estrutura").iButton(); }
										if($('#video_estrutura').length) { $("#video_estrutura").iButton(); }
                                        if($('#nome_estrutura').length) { $("#nome_estrutura").iButton(); }
                                        if($('#titulo_texto_estrutura').length) { $("#titulo_texto_estrutura").iButton(); }
                                        if($('#imagem_descricao_estrutura').length) { $("#imagem_descricao_estrutura").iButton(); }
                                        if($('#imagem_interna_estrutura').length) { $("#imagem_interna_estrutura").iButton(); }
                                        if($('#chamada_descricao_estrutura').length) { $("#chamada_descricao_estrutura").iButton(); }
                                        if($('#texto_descricao_estrutura').length) { $("#texto_descricao_estrutura").iButton(); }
										<? } ?>
                                    }
                                };
								<? } ?>
                                </script>
                                <div class="tab-content">
                                    <div id="tb1_a" class="tab-pane active">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="config" />
    
												<? 
												if(trim($row_config['numeroUnico'])=="") {
													$numeroUnicoGerado = geraCodReturn(); 
												} else {
													$numeroUnicoGerado = $row_config['numeroUnico']; 
												}
                                                $_SESSION["numeroUnico_upload_arquivo"] = $numeroUnicoGerado;
                                                ?>
                                                <input type="hidden" name="numeroUnico" id="numeroUnico_editar" value="<?=$numeroUnicoGerado?>">

                                                <? if(trim($row_estrutura['nome'])==1) { ?>
                                                <div class="formSep">
                                                    <div style="float:left;margin-right:10px;">
                                                        <label><? if(trim($row_estrutura['nome_label'])=="") { echo "Título da Página"; } else { echo $row_estrutura['nome_label']; } ?></label>
                                                        <input value="<?=$row_config['nome']?>" style="width:350px;" type="text" name="nome" id="nome" />
                                                    </div>
                                                    <? if(trim($row_estrutura['nome_info'])=="") { } else { ?><span class="help-block" style="width:100%;float:left;"><?=$row_estrutura['nome_info']?></span><? } ?>
                                                </div>
                                                <? } ?>

                                                <? if(trim($row_estrutura['imagem_descricao'])==1) { ?>
                                                <div class="formSep">
                                                    <label><? if(trim($row_estrutura['imagem_descricao_label'])=="") { echo "Imagem de Cabeçalho"; } else { echo $row_estrutura['imagem_descricao_label']; } ?></label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail">
                                                        <? if(trim($row_config['imagem_descricao'])=="") { ?>
                                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                        <? } else { ?>
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_descricao']?>"><img style="width:50px;" id="arquivo-atual-imagem_descricao" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_descricao']?>" alt=""></a>
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
                                                        <a class="img_action_zoom" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_interna']?>"><img style="width:50px;" id="arquivo-atual-imagem_interna" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_config/<?=$row_config['numeroUnico']?>/<?=$row_config['imagem_interna']?>" alt=""></a>
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
    
												<? if(trim($row_estrutura['video'])==1) { ?>
                                                <div class="formSep">
                                                    <div style="margin-right:10px;width:100%;float:left;">Galeria de vídeos</div>
                                                    <div style="margin-right:10px;width:100%;float:left;">
                                                        <div style="float:left;margin-right:10px;">
                                                            <label>Título</label>
                                                            <input value="" style="width:350px;" type="text" id="nome_video_editar" />
                                                        </div>
                                                        <div style="float:left;margin-right:10px;">
                                                            <label>Link</label>
                                                            <input value="" style="width:350px;" type="text" id="link_video_editar" />
                                                        </div>
                                                        <div style="float:left;margin-right:10px;margin-top:24px;">
                                                            <button type="button" onclick="javascript:adicionar_video('<?=$mod?>','_editar');" class="btn btn-primary">Adicionar Vídeo</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="formSep" id="galeria-video_editar" style="margin-right:10px;width:100%;margin-bottom:50px;float:left;margin-top:20px;">
                                                    <? $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/galeria_video/lista_video.php"); ?>
                                                </div>
                                                <? } ?>

                                                <? if(trim($row_estrutura['galeria'])==1) { ?>
                                                <script type="text/javascript" src="<?=$link?>template/js/upload.js"></script>
                                                <script type="text/javascript" >
                                                    $(function(){
                                                        new AjaxUpload($('#upload-arquivo'), {
                                                            action: '<?=$link?>acoes/galeria_video/drop-arquivo.php?numeroUnico_upload_arquivo=<?=$numeroUnicoGerado?>&modS=<?=$mod?>',
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
                                                    <label class="req">Arquivo</label>
                                                    <input type="button" id="upload-arquivo" value="adicionar arquivo" class="btn" />
                                                </div>
            
                                                <div id="drag-drop-div" class="formSep">
                                                    <div id="dragandrophandler" style="margin-left:0px;">Arrastar e Soltar os Arquivos Aqui</div>
                                                    <div id="status1"></div>
                                                </div>
                                                <script>
                                                function sendFileToServer(formData,status)
                                                {
                                                    var uploadURL ="<?=$link?>acoes/galeria_video/drop-arquivo.php"; //Upload URL
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
                                                        fd.append('modS','<?=$mod?>');
                                                 
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
                                                    <? $modGet = $mod; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/galeria_video/lista_galeria.php"); ?>
                                                </div>
                                                <? } ?>

                                    <div class="formSep">
                                                    <button type="submit" class="btn btn-inverse">Atualizar</button>
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? if(trim($row_estrutura['seo'])==1) { ?>
                                    <div id="tb1_b" class="tab-pane">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
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
                                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <? } ?>

                                    <? if(trim($sysusu['adm'])==1) { ?>
                                    <div id="tb1_estrutura" class="tab-pane">
                                        <div>
                                            <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                <input type="hidden" name="acaoForm" value="estrutura" />
    

                                                <div class="aba_config_adm"><a href="javascript:void(0);">Campos do Módulo</a></div>
                                                <div class="aba_config_campos" id="config_aba_campo" style="display:block;">
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
                                                        <label class="req">Campo 'Título da Página'</label>
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
