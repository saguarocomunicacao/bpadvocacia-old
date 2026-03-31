<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

//apaga_files("","../../files/sysmidia_zip/");

$idsysusuGet = $_GET['idsysusuS'];

$idpaiGet = $_GET['idpaiS'];

if(trim($_GET['orderS'])=="") {
	$orderGet = "ORDER BY nome";
} else {
	$orderGet = "ORDER BY ".$_GET['orderS']."";
}

if(trim($_GET['orderDirecaoS'])=="") {
	$orderDirecaoGet = " ASC";
} else {
	$orderDirecaoGet = " ".$_GET['orderDirecaoS']."";
}

if(trim($_GET['showNameS'])=="") {
	$showNameGet = "none";
} else {
	$showNameGet = "block";
}

if(trim($_GET['showDateS'])=="") {
	$showDateGet = "none";
} else {
	$showDateGet = "block";
}

if(trim($_GET['showSizeS'])=="") {
	$showSizeGet = "none";
} else {
	$showSizeGet = "block";
}

if(trim($_GET['viewS'])=="thumb"||trim($_GET['viewS'])=="") {
	$thumbGet = "block";
	$listaGet = "none";
} else {
	$thumbGet = "none";
	$listaGet = "block";
}

?>
<script>
  $(document).ready(function() {
	$("a.popup_fancy").fancybox({
		width               : 800,
		height              : 600,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade'
	});
});
</script>
<div id="dragandrophandler">Arrastar e Soltar os Arquivos Aqui</div>
<div id="status1"></div>

<div id="view_lista" style="margin-left:10px;display:<?=$listaGet?>;">
    <table class="table table-striped table-condensed">
    <thead>
        <tr>
            <th style="width:16px;"></th>
            <th>Nome</th>
            <th style="width:130px;">Data</th>
            <th style="width:80px;">Tamanho</th>
            <th style="width:100px;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?
        $qSql = mysql_query("SELECT * FROM sysmidia WHERE tipo='folder' AND idpai='".$idpaiGet."' ".$orderGet."".$orderDirecaoGet."");
        while($rSql = mysql_fetch_array($qSql)) {

        ?>
        <tr>
            <td><img style="max-width:16px;margin-top:-3px;" src="<?=$link?>template/img/icones_novos/sysmidia/folder.png" alt="" /></td>
            <td><? if(strlen($rSql['nome'])>20) { echo substr($rSql['nome'],0,20)."..."; } else { echo $rSql['nome']; } ?></td>
            <td><? if(trim($rSql['dataModificacao'])=="0000-00-00 00:00:00") { } else { ajustaData($rSql['dataModificacao'],"d-m-Y"); } ?></td>
            <td></td>
            <td>
                <input type="checkbox" name="pasta_sel[]" style="margin-top:-3px;" class="select_msg" value="<?=$rSql['id']?>" />
                <a href="javascript:void(0)" onClick="abre_pasta_ajax('<?=$rSql['id']?>');"><i class="splashy-add_small"></i></a>
                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysmidia/form-pasta.php?idS=<?=$rSql['id']?>&idsysusuS=<?=$idsysusuGet?>" title="Editar"><i class="splashy-pencil"></i></a>
                <a class="img_action_remove" onclick="remover_pasta('<?=$rSql['id']?>');" href="javascript:void(0)" title="Remover"><i class="splashy-remove"></i></a>
            </td>
        </tr>
        <? } ?>
        <?
        $qSql = mysql_query("SELECT * FROM sysmidia WHERE tipo='file' AND idpai='".$idpaiGet."' ".$orderGet."".$orderDirecaoGet."");
        while($rSql = mysql_fetch_array($qSql)) {


			$extensao = $rSql['arquivo'];
			$extensao = substr($extensao, -4);
			if($extensao[0] == '.'){
				$extensao = substr($extensao, -3);
			}
			$extensao = strtolower($extensao);
        ?>
        <tr>
            <td>
			<? if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp") { ?>
            <div style="width:16px;height:16px;overflow:hidden;vertical-align:middle;text-align:center;margin-top:2px;">
            <img style="max-width:16px;" src="<?=$link?>files/sysmidia/<?=$rSql['numeroUnico']?>/<?=$rSql['arquivo']?>" alt="" />
            </div>
            <? } else { ?>
				<? if($extensao=="avi"||$extensao=="mov"||$extensao=="mp4"||$extensao=="mp3"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="flv") { ?>
                <img style="max-width:16px;margin-top:-3px;" src="<?=$link?>template/img/icones_novos/sysmidia/video.png" alt="" />
                <? } else { ?>
                <img style="max-width:16px;margin-top:-3px;" src="<?=$link?>template/img/icones_novos/sysmidia/<?=$extensao?>.png" alt="" />
                <? } ?>
            <? } ?>
            </td>
            <td><?=$rSql['nome']?></td>
            <td><? if(trim($rSql['dataModificacao'])=="0000-00-00 00:00:00") { } else { ajustaData($rSql['dataModificacao'],"d-m-Y"); } ?></td>
            <td><? tamanhoArquivo("../../files/sysmidia/".$rSql['numeroUnico']."/".$rSql['arquivo'].""); ?></td>
            <td>
                <input type="checkbox" name="pasta_sel[]" style="margin-top:-3px;" class="select_msg" value="<?=$rSql['id']?>" />
                <? if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp"||$extensao=="avi"||$extensao=="mov"||$extensao=="mp4"||$extensao=="mp3"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="flv") { ?>
                <a class="img_action_view popup_fancy" href="<?=$link?>acoes/sysmidia/visualizar-arquivo.php?idS=<?=$rSql['id']?>"><i class="splashy-zoom_in"></i></a>
                <? } else { ?>
                <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/sysmidia/<?=$rSql['numeroUnico']?>/<?=$rSql['nome']?>"><i class="splashy-zoom_in"></i></a>
                <? } ?>
                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysmidia/form-arquivo.php?idS=<?=$rSql['id']?>&idsysusuS=<?=$idsysusuGet?>" title="Editar"><i class="splashy-pencil"></i></a>
                <a class="img_action_remove" href="javascript:void(0)" onclick="remover_arquivo('<?=$rSql['id']?>');" title="Remover"><i class="splashy-remove"></i></a>
                <a class="img_action_remove" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/sysmidia/<?=$rSql['numeroUnico']?>/<?=$rSql['nome']?>" title="Faça o download deste arquivo"><i class="splashy-download"></i></a>
            </td>
        </tr>
        <? } ?>
    </tbody>
    </table>
</div>

<div id="view_thumb" style="float:left;width:100%;margin-left:-20px;display:<?=$thumbGet?>;">

    <ul style="list-style-type:none;">
        <?
        $qSql = mysql_query("SELECT * FROM sysmidia WHERE tipo='folder' AND idpai='".$idpaiGet."' ".$orderGet."".$orderDirecaoGet."");
        while($rSql = mysql_fetch_array($qSql)) {

        ?>
        <li style="width:128px;float:left;margin-right:10px;margin-bottom:10px;padding:5px;">
            <div style="float:left;width:100%;">
                <img style="max-width:128px;" src="<?=$link?>template/img/icones_novos/sysmidia/folder.png" alt="" />
                <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;display:<?=$showNameGet?>;">&nbsp;<? if(strlen($rSql['nome'])>20) { echo substr($rSql['nome'],0,20)."..."; } else { echo $rSql['nome']; } ?></div>
                <div class="view_date" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;display:<?=$showDateGet?>;">&nbsp;<? if(trim($rSql['dataModificacao'])=="0000-00-00 00:00:00") { } else { ajustaData($rSql['dataModificacao'],"d-m-Y"); } ?></div>
                <div class="view_size" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;display:<?=$showSizeGet?>;">&nbsp;</div>
            </div>
            <div style="float:left;width:121px;border:1px solid #EBEBEB;padding-top:5px;padding-bottom:5px;padding-left:5px;height:20px;">
                <input type="checkbox" name="pasta_sel[]" style="margin-top:-3px;" class="select_msg" value="<?=$rSql['id']?>" />
                <a href="javascript:void(0)" onClick="abre_pasta_ajax('<?=$rSql['id']?>');"><i class="splashy-add_small"></i></a>
				<a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysmidia/form-pasta.php?idS=<?=$rSql['id']?>&idsysusuS=<?=$idsysusuGet?>" title="Editar"><i class="splashy-pencil"></i></a>
                <a class="img_action_remove" onclick="remover_pasta('<?=$rSql['id']?>');" href="javascript:void(0)" title="Remover"><i class="splashy-remove"></i></a>
            </div>
        </li>
        <? } ?>
        <?
        $mostra = 0;
		$qSql = mysql_query("SELECT * FROM sysmidia WHERE tipo='file' AND idpai='".$idpaiGet."' ".$orderGet."".$orderDirecaoGet."");
        while($rSql = mysql_fetch_array($qSql)) {


			$extensao = $rSql['arquivo'];
			$extensao = substr($extensao, -4);
			if($extensao[0] == '.'){
				$extensao = substr($extensao, -3);
			}
			$extensao = strtolower($extensao);
        ?>
        <li style="width:128px;float:left;margin-right:10px;margin-bottom:10px;padding:5px;">
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr><td align="center" valign="bottom">
            <? if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp") { ?>
            <img style="max-width:128px;" src="<?=$link?>files/sysmidia/<?=$rSql['numeroUnico']?>/<?=$rSql['arquivo']?>" alt="" />
            <? } else { ?>
				<? if($extensao=="avi"||$extensao=="mov"||$extensao=="mp4"||$extensao=="mp3"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="flv") { ?>
                <img style="max-width:128px;" src="<?=$link?>template/img/icones_novos/sysmidia/video.png" alt="" />
                <? } else { ?>
                <img style="max-width:128px;" src="<?=$link?>template/img/icones_novos/sysmidia/<?=$extensao?>.png" alt="" />
                <? } ?>
            <? } ?>
            </td></tr>
            </table>
            </div>
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;display:<?=$showNameGet?>;">&nbsp;<? if(strlen($rSql['nome'])>20) { echo substr($rSql['nome'],0,20)."..."; } else { echo $rSql['nome']; } ?></div>
            <div class="view_date" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;display:<?=$showDateGet?>;">&nbsp;<? if(trim($rSql['dataModificacao'])=="0000-00-00 00:00:00") { } else { ajustaData($rSql['dataModificacao'],"d-m-Y"); } ?></div>
            <div class="view_size" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;display:<?=$showSizeGet?>;">&nbsp;<? tamanhoArquivo("../../files/sysmidia/".$rSql['numeroUnico']."/".$rSql['arquivo'].""); ?></div>
            <div style="float:left;width:121px;border:1px solid #EBEBEB;padding-top:5px;padding-bottom:5px;padding-left:5px;height:20px;">
                <input type="checkbox" name="pasta_sel[]" style="margin-top:-3px;" class="select_msg" value="<?=$rSql['id']?>" />
                <? if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp"||$extensao=="avi"||$extensao=="mov"||$extensao=="mp4"||$extensao=="mp3"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="flv") { ?>
                <a class="img_action_view popup_fancy" href="<?=$link?>acoes/sysmidia/visualizar-arquivo.php?idS=<?=$rSql['id']?>"><i class="splashy-zoom_in"></i></a>
                <? } else { ?>
                <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/sysmidia/<?=$rSql['numeroUnico']?>/<?=$rSql['nome']?>"><i class="splashy-zoom_in"></i></a>
                <? } ?>
                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysmidia/form-arquivo.php?idS=<?=$rSql['id']?>&idsysusuS=<?=$idsysusuGet?>" title="Editar"><i class="splashy-pencil"></i></a>
                <a class="img_action_remove" href="javascript:void(0)" onclick="remover_arquivo('<?=$rSql['id']?>');" title="Remover"><i class="splashy-remove"></i></a>
                <a class="img_action_remove" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/sysmidia/<?=$rSql['numeroUnico']?>/<?=$rSql['nome']?>" title="Faça o download deste arquivo"><i class="splashy-download"></i></a>
            </div>
        </li>
        <? } ?>
    </ul>
</div>
<script>
function sendFileToServer(formData,status)
{
    var uploadURL ="<?=$link?>acoes/sysmidia/drop-arquivo.php?idsysusuS=<?=$idsysusuGet?>"; //Upload URL
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
 
            abre_pasta_ajax("<?=$idpaiGet?>","<?=$idsysusuGet?>");
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
		fd.append('idpai','<?=$idpaiGet?>');
		fd.append('idsysusuS','<?=$idsysusuGet?>');
 
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
