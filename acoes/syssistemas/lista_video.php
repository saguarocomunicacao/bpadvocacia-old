<div id="view_thumb" style="width:100%;margin-left:-20px;">
    <input type="hidden" id="lista_portfolios_remover" value="" />
    <div style="width:100%;margin-left:20px;"><div onclick="remover_portfolio_lista('syssistemas_video');" class="btn"><i class="splashy-remove"></i>&nbsp;&nbsp;Remover selecionados</div></div>
    <ul style="list-style-type:none;margin-left:18px;width:100%;">
        <?
        $qSql = mysql_query("SELECT * FROM syssistemas_video WHERE numeroUnico='".$numeroUnicoGet."' ORDER BY ordem");
        while($rSql = mysql_fetch_array($qSql)) {
			$link_video = get_player($rSql['link']);
        ?>
        <li style="width:225px;height:130px;float:left;margin-right:10px;margin-bottom:10px;padding:5px;">
            <div style="float:left;width:225px;height:130px;overflow:hidden;vertical-align:middle;text-align:center;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr><td align="center" valign="bottom"><iframe src="<?=$link_video?>" width="225px" height="130px" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></td></tr>
            </table>
            </div>
            <div class="view_name" style="width:225px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;ORDEM: <?=$rSql['ordem']?></div>
            <div class="view_name" style="width:225px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? if(strlen($rSql['nome'])>20) { echo substr($rSql['nome'],0,20)."..."; } else { echo $rSql['nome']; } ?></div>
            <div class="view_date" style="width:225px;background-color:#EBEBEB;overflow:hidden;font-size:11px;">&nbsp;<? if(trim($rSql['dataModificacao'])=="0000-00-00 00:00:00") { } else { ajustaData($rSql['dataModificacao'],"d-m-Y"); } ?></div>
            <div style="float:left;width:225px;height:128px;overflow:hidden;vertical-align:middle;text-align:center;">
                <input type="checkbox" id="check-<?=$rSql['id']?>" onclick="marca_portfolio_remover('<?=$rSql['id']?>')" style="margin-top:-3px;" class="select_msg" value="<?=$rSql['id']?>" />
                <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/sysgeral/form-portfolio.php?idS=<?=$rSql['id']?>&modS=syssistemas_video" title="Editando <?=$rSql['nome']?>"><i class="splashy-pencil"></i></a>
                <a href="javascript:void(0);" onclick="remover_portfolio_unico('<?=$rSql['id']?>','syssistemas_video');" class="img_action_remove" title="Remover"><i class="splashy-remove"></i></a>
            </div>
        </li>
        <? } ?>
    </ul>
</div>
