<div id="view_thumb" style="float:left;width:100%;margin-left:-20px;">
    <input type="hidden" id="lista_fotos_remover" value="" />
    <div style="float:left;width:100%;margin-left:20px;">
        <div style="float:left;margin-right:10px;"><input type="checkbox" id="check-select-all" onclick="marcarTodos()" style="margin-top:-3px;" />&nbsp;&nbsp;Selecionar todos</div>
        <div style="float:left;margin-right:10px;" onclick="remover_foto_lista('syscliente_galeria');" class="btn"><i class="splashy-remove"></i>&nbsp;&nbsp;Remover selecionados</div>
        <div style="float:left;margin-right:10px;" onclick="compactar_selecionados('syscliente','<?=$numeroUnicoGet?>');" class="btn"><i class="splashy-box"></i>&nbsp;&nbsp;Baixar selecionados</div>
    </div>
    <ul id="listagem" style="list-style-type:none;margin-left:18px;">
        <?
        $qSql = mysql_query("SELECT * FROM syscliente_galeria WHERE numeroUnico='".$numeroUnicoGet."' ORDER BY ordem");
        while($rSql = mysql_fetch_array($qSql)) {
			$extensao = $rSql['imagem'];
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
            <div style="width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;margin-top:2px;">
            <img style="max-width:128px;" src="<?=$link?>files/syscliente/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>" alt="" />
            </div>
            <? } else { ?>
				<? if($extensao=="avi"||$extensao=="mov"||$extensao=="mp4"||$extensao=="mp3"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="flv") { ?>
                <img style="max-width:128px;margin-top:-3px;" src="<?=$link?>template/img/icones_novos/sysmidia/video.png" alt="" />
                <? } else { ?>
                <img style="max-width:128px;margin-top:-3px;" src="<?=$link?>template/img/icones_novos/sysmidia/<?=$extensao?>.png" alt="" />
                <? } ?>
            <? } ?>
            </td></tr>
            </table>
            </div>
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;ORDEM: <?=$rSql['ordem']?></div>
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? if(strlen($rSql['nome'])>20) { echo substr($rSql['nome'],0,20)."..."; } else { echo $rSql['nome']; } ?></div>
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;overflow:hidden;height:20px;">&nbsp;<?=$rSql['imagem']?></div>
            <div class="view_date" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? if(trim($rSql['dataModificacao'])=="0000-00-00 00:00:00") { } else { ajustaData($rSql['dataModificacao'],"d-m-Y"); } ?></div>
            <div class="view_size" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? tamanhoArquivo("../../files/syscliente/".$rSql['numeroUnico']."/".$rSql['imagem'].""); ?></div>
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
                <input type="checkbox" id="check-<?=$rSql['id']?>" onclick="marca_foto_remover('<?=$rSql['id']?>')" style="margin-top:-3px;" class="select_msg_file" value="<?=$rSql['id']?>" />
                <? if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp"||$extensao=="avi"||$extensao=="mov"||$extensao=="mp4"||$extensao=="mp3"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="flv") { ?>
                <a class="img_action_view popup_fancy" href="<?=$link?>acoes/syscliente/visualizar-arquivo.php?idS=<?=$rSql['id']?>"><i class="splashy-zoom_in"></i></a>
                <? } else { ?>
                <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/syscliente/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>"><i class="splashy-zoom_in"></i></a>
                <? } ?>
                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysgeral/form-foto.php?idS=<?=$rSql['id']?>&modS=syscliente_galeria" title="Editando <?=$rSql['nome']?>"><i class="splashy-pencil"></i></a>
                <a href="javascript:void(0);" onclick="remover_foto_unico('<?=$rSql['id']?>','syscliente_galeria');" class="img_action_remove" title="Remover"><i class="splashy-remove"></i></a>
                <a class="img_action_remove" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/syscliente/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>" title="Faça o download deste arquivo"><i class="splashy-download"></i></a>
            </div>
        </li>
        <? } ?>
    </ul>
</div>
