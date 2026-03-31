<div id="view_thumb" style="float:left;width:100%;margin-left:-20px;">
    <input type="hidden" id="lista_fotos_remover_2017_clienteArquivo" value="" />
    <input type="hidden" id="lista_fotos_remover_parceiro_adv_processo_galeria" value="" />
    <input type="hidden" id="lista_fotos_remover_envio_de_arquivos_lista" value="" />
    <div style="float:left;width:100%;margin-left:20px;">
        <div style="float:left;margin-right:10px;"><input type="checkbox" id="check-select-all" onclick="marcarTodos_parceiro_adv_processo()" style="margin-top:-3px;" />&nbsp;&nbsp;Selecionar todos</div>
        <div style="float:left;margin-right:10px;" onclick="remover_foto_lista_parceiro_adv_processo();" class="btn"><i class="splashy-remove"></i>&nbsp;&nbsp;Remover selecionados</div>
        <div style="float:left;margin-right:10px;" onclick="compactar_selecionados_duplo_NOVO('2017_clienteArquivo','parceiro_adv_processo_galeria','envio_de_arquivos_lista','<?=$numeroUnicoGet?>');" class="btn"><i class="splashy-box"></i>&nbsp;&nbsp;Baixar selecionados</div>
    </div>
    <ul id="listagem" style="list-style-type:none;margin-left:18px;">
        <?
        $qSql = mysql_query("SELECT * FROM 2017_clienteArquivo WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
        while($rSql = mysql_fetch_array($qSql)) {
			$extensao = $rSql['arquivo'];
			$extensao = substr($extensao, -4);
			if($extensao[0] == '.'){
				$extensao = substr($extensao, -3);
			}
			$extensao = strtolower($extensao);
        ?>
        <li title="2017_clienteArquivo" style="width:128px;float:left;margin-right:10px;margin-bottom:10px;padding:5px;">
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr><td align="center" valign="bottom">
			<? if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp") { ?>
            <div style="width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;margin-top:2px;">
            <img style="max-width:128px;" src="http://www.bpadvocacia.com.br/infiniti/files/clienteArquivo/<?=$numeroUnicoGet?>/<?=$rSql['arquivo']?>" alt="" />
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
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? if(strlen($rSql['nome'])>20) { echo substr($rSql['nome'],0,20)."..."; } else { echo $rSql['nome']; } ?></div>
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;overflow:hidden;height:20px;">&nbsp;<?=$rSql['arquivo']?></div>
            <div class="view_size" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? tamanhoArquivo("../../../../infiniti/files/clienteArquivo/".$numeroUnicoGet."/".$rSql['arquivo'].""); ?></div>
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
                <input type="checkbox" id="check-<?=$rSql['id']?>" onclick="marca_multi_foto_remover('<?=$rSql['id']?>')" style="margin-top:-3px;" class="select_msg_file" value="<?=$rSql['id']?>" bd_foto="2017_clienteArquivo" />
                <? if($extensao=="pdf"||$extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp"||$extensao=="avi"||$extensao=="mov"||$extensao=="mp4"||$extensao=="mp3"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="flv") { ?>
                <? $bancoFile = ""; ?>
                <a href="http://www.bpadvocacia.com.br/infiniti/files/clienteArquivo/<?=$numeroUnicoGet?>/<?=$rSql['arquivo']?>" target="_blank"><i class="splashy-zoom_in"></i></a>
                <? } else { ?>
                <? } ?>
                <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../../infiniti/files/clienteArquivo/<?=$numeroUnicoGet?>/<?=$rSql['arquivo']?>"><i class="splashy-download"></i></a>
                <a href="javascript:void(0);" onclick="remover_foto_unico('<?=$rSql['id']?>','2017_clienteArquivo');" class="img_action_remove" title="Remover"><i class="splashy-remove"></i></a>
            </div>
        </li>
        <? } ?>
        <?
        $qSql = mysql_query("SELECT * FROM parceiro_adv_processo_galeria WHERE numeroUnico='".$numeroUnicoGet."' ORDER BY ordem");
        while($rSql = mysql_fetch_array($qSql)) {
			$extensao = $rSql['imagem'];
			$extensao = substr($extensao, -4);
			if($extensao[0] == '.'){
				$extensao = substr($extensao, -3);
			}
			$extensao = strtolower($extensao);
        ?>
        <li title="parceiro_adv_processo_galeria" style="width:128px;float:left;margin-right:10px;margin-bottom:10px;padding:5px;">
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr><td align="center" valign="bottom">
			<? if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp") { ?>
            <div style="width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;margin-top:2px;">
            <img style="max-width:128px;" src="<?=$link?>files/parceiro_adv_processo/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>" alt="" />
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
            <div class="view_size" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? tamanhoArquivo("../../files/parceiro_adv_processo/".$rSql['numeroUnico']."/".$rSql['imagem'].""); ?></div>
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
                <input type="checkbox" id="check-<?=$rSql['id']?>" onclick="marca_multi_foto_remover('<?=$rSql['id']?>')" style="margin-top:-3px;" class="select_msg_file" value="<?=$rSql['id']?>" bd_foto="parceiro_adv_processo_galeria" />
                <? if($extensao=="pdf"||$extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp"||$extensao=="avi"||$extensao=="mov"||$extensao=="mp4"||$extensao=="mp3"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="flv") { ?>
                <!--<a class="img_action_view popup_fancy" href="<?=$link?>acoes/parceiro_adv_processo/visualizar-arquivo.php?idS=<?=$rSql['id']?>"><i class="splashy-zoom_in"></i></a>-->
                <a href="<?=$link?>files/parceiro_adv_processo/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>" target="_blank"><i class="splashy-zoom_in"></i></a>
                <? } else { ?>
                <? } ?>
                <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/parceiro_adv_processo/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>"><i class="splashy-download"></i></a>
                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysgeral/form-foto.php?idS=<?=$rSql['id']?>&modS=parceiro_adv_processo_galeria" title="Editando <?=$rSql['nome']?>"><i class="splashy-pencil"></i></a>
                <a href="javascript:void(0);" onclick="remover_foto_unico('<?=$rSql['id']?>','parceiro_adv_processo_galeria');" class="img_action_remove" title="Remover"><i class="splashy-remove"></i></a>
            </div>
        </li>
        <? } ?>

        <?
        $qSql = mysql_query("SELECT * FROM envio_de_arquivos_lista WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY data DESC");
        while($rSql = mysql_fetch_array($qSql)) {
			$extensao = $rSql['arquivo'];
			$extensao = substr($extensao, -4);
			if($extensao[0] == '.'){
				$extensao = substr($extensao, -3);
			}
			$extensao = strtolower($extensao);
        ?>
        <li title="envio_de_arquivos_lista" style="width:128px;float:left;margin-right:10px;margin-bottom:10px;padding:5px;">
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr><td align="center" valign="bottom">
			<? if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp") { ?>
            <div style="width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;margin-top:2px;">
            <img style="max-width:128px;" src="<?=$link?>files/envio_de_arquivos_lista/<?=$rSql['numeroUnico_pasta']?>/<?=$rSql['arquivo']?>" alt="" />
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
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;overflow:hidden;height:20px;">&nbsp;<?=$rSql['arquivo']?></div>
            <div class="view_date" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? if(trim($rSql['dataModificacao'])=="0000-00-00 00:00:00") { } else { ajustaData($rSql['dataModificacao'],"d-m-Y"); } ?></div>
            <div class="view_size" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? tamanhoArquivo("../../files/envio_de_arquivos_lista/".$rSql['numeroUnico_pasta']."/".$rSql['arquivo'].""); ?></div>
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
                <input type="checkbox" id="check-<?=$rSql['id']?>" onclick="marca_multi_foto_remover('<?=$rSql['id']?>')" style="margin-top:-3px;" class="select_msg_file" value="<?=$rSql['id']?>" bd_foto="envio_de_arquivos_lista" />
                <? if($extensao=="pdf"||$extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp"||$extensao=="avi"||$extensao=="mov"||$extensao=="mp4"||$extensao=="mp3"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="flv") { ?>
                <!--<a class="img_action_view popup_fancy" href="<?=$link?>acoes/envio_de_arquivos_lista/visualizar-arquivo.php?idS=<?=$rSql['id']?>"><i class="splashy-zoom_in"></i></a>-->
                <a href="<?=$link?>files/envio_de_arquivos_lista/<?=$rSql['numeroUnico_pasta']?>/<?=$rSql['arquivo']?>" target="_blank"><i class="splashy-zoom_in"></i></a>
                <? } else { ?>
                <? } ?>
                <a href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/envio_de_arquivos_lista/<?=$rSql['numeroUnico_pasta']?>/<?=$rSql['arquivo']?>"><i class="splashy-download"></i></a>
                <a href="javascript:void(0);" onclick="remover_foto_unico('<?=$rSql['id']?>','envio_de_arquivos_lista');" class="img_action_remove" title="Remover"><i class="splashy-remove"></i></a>
            </div>
        </li>
        <? } ?>
    </ul>
</div>
