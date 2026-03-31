<div id="view_thumb" style="float:left;width:100%;margin-left:-20px;">
    <input type="hidden" id="lista_fotos_remover" value="" />
    <div style="float:left;width:100%;margin-left:20px;"><div onclick="remover_foto_lista('systemplate_galeria');" class="btn"><i class="splashy-remove"></i>&nbsp;&nbsp;Remover selecionados</div></div>
    <ul style="list-style-type:none;margin-left:18px;">
        <?
        $qSql = mysql_query("SELECT * FROM systemplate_galeria WHERE numeroUnico='".$numeroUnicoGet."' ORDER BY ordem");
        while($rSql = mysql_fetch_array($qSql)) {
        ?>
        <li style="width:128px;float:left;margin-right:10px;margin-bottom:10px;padding:5px;">
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr><td align="center" valign="bottom"><img style="max-width:128px;" src="<?=$link?>files/systemplate/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem']?>" alt="" /></td></tr>
            </table>
            </div>
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;ORDEM: <?=$rSql['ordem']?></div>
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? if(strlen($rSql['nome'])>20) { echo substr($rSql['nome'],0,20)."..."; } else { echo $rSql['nome']; } ?></div>
            <div class="view_name" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;overflow:hidden;height:20px;">&nbsp;<div style="width:125px;overflow:hidden;font-size:11px;overflow:hidden;height:20px;"><?=$rSql['imagem']?></div></div>
            <div class="view_date" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? if(trim($rSql['dataModificacao'])=="0000-00-00 00:00:00") { } else { ajustaData($rSql['dataModificacao'],"d-m-Y"); } ?></div>
            <div class="view_size" style="width:128px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? tamanhoArquivo("../../files/systemplate/".$rSql['numeroUnico']."/".$rSql['imagem'].""); ?></div>
            <div style="float:left;width:128px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
                <input type="checkbox" id="check-<?=$rSql['id']?>" onclick="marca_foto_remover('<?=$rSql['id']?>')" style="margin-top:-3px;" class="select_msg" value="<?=$rSql['id']?>" />
                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysgeral/form-systemplate.php?idS=<?=$rSql['id']?>&modS=systemplate_galeria" title="Editando <?=$rSql['nome']?>"><i class="splashy-pencil"></i></a>
                <a href="javascript:void(0);" onclick="remover_foto_unico('<?=$rSql['id']?>','systemplate_galeria');" class="img_action_remove" title="Remover"><i class="splashy-remove"></i></a>
            </div>
        </li>
        <? } ?>
    </ul>
</div>
