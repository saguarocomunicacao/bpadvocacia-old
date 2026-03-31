        <!-- main content -->
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span2">
                        <div class="sidebar">
                        	<? include("./acoes/sysgeral/menu-sistema.php"); ?>
                        </div>
        </div>
        <div class="span10">
            <div class="row-fluid" style="margin-bottom:10px;">
                <div class="toolbar-icons clearfix">
                    <a style="width:16px;" href="javascript:history.back(-1);" class="ptip_ne" title="Voltar"><i class="icsw16-bended-arrow-left icsw16-white"></i></a>
                </div>
            </div>
            <div class="tabbable tabs-top">
                <div class="tab-content">
                    <script>
                    $(document).ready(function() {
                        //* form validation
                        forms.simple();

                        //* switch buttons
                        beoro_switchButtons.init();

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


                    //* WYSIWG Editor
                    beoro_wysiwg = {
                        init: function() {
                            if($('#texto').length) { 
                                CKEDITOR.replace( 'texto', {
                                    toolbar: 'Standard'
                                });
                            }
                            if($('#chamada').length) { 
                                CKEDITOR.replace( 'chamada', {
                                    toolbar: 'Standard'
                                });
                            }
                        }
                    };

                    //* switch buttons
                    beoro_switchButtons = {
                        init: function() {
                            if($('#destaque').length) { $("#destaque").iButton(); }
                        }
                    };
                    </script>

                    <div id="tb3_b" class="tab-pane active" style="background-color:#FFF;">
                        <div>
                            <form name="forms" method="post" action="<?=$link?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                <input type="hidden" name="acaoLocal" value="interno" />
                                <input type="hidden" name="acaoForm" value="editar" />
                                <input type="hidden" name="modulo" value="<?=$mod?>" />
                                <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />

                                <? 
                                $numeroUnicoGerado = $row['numeroUnico']; 
                                ?>
                                <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                <div class="formSep">
                                    <div style="float:left;margin-right:10px;">
                                        <label class="req">URL Amigável</label>
                                        <input value="<?=$row['url_amigavel']?>" style="width:350px;" type="text" name="url_amigavel" id="url_amigavel" />
                                    </div>
                                </div>

                                <div class="formSep">
                                    <label class="req">Ordem</label>
                                    <select name="ordem" id="ordem">
                                        <?
                                        $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$mod.""));
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
                                </div>

                                <div class="formSep">
                                    <div style="float:left;margin-right:10px;">
                                        <label class="req">Título</label>
                                        <input value="<?=$row['nome']?>" style="width:350px;" onkeyup="cria_url_amigavel('nome','url_amigavel');" type="text" name="nome" id="nome" />
                                    </div>
                                </div>

                                <div class="formSep">
                                    <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                        <label>Destaque ?</label>
                                        <input type="checkbox" name="destaque" id="destaque" <? if(trim($row['destaque'])==1) { echo " checked"; } ?> class="destaque {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                    </div>
                                </div>

                                <div class="formSep">
                                    <label>Imagem/Logotipo</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                        <? if(trim($row['imagem'])=="") { ?>
                                        <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                        <? } else { ?>
                                        <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['imagem']?>" alt="">
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
                                        <a href="javascript:void(0);" onclick="removeImagemFormulario('<?=$row['numeroUnico']?>','<?=$mod?>','imagem','<?=$row['imagem']?>','<?=$_REQUEST['var4']?>')" class="btn btn-small" data-dismiss="fileupload">Remover</a>
                                        <? } ?>
                                    </div>
                                </div>

                                <div class="formSep">
                                    <label class="req">Chamada</label>
                                    <textarea name="chamada" id="chamada" class="span12" style="height:150px;"><?=$row['chamada']?></textarea>
                                </div>

                                <div class="formSep">
                                    <label class="req">Texto</label>
                                    <textarea name="texto" id="texto" class="span12" style="height:150px;"><?=$row['texto']?></textarea>
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
                                
                                <div class="formSep">
                                    <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                    <button type="submit" onclick="javascript:history.back(-1);" class="btn btn-warning">Cancelar</button>
                                    <? } ?>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
