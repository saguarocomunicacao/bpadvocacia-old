<div style="float:left;width:100%;">
    <div style="float:left;">
        <label class="req">Tipo de Item</label>
        <select id="tipoItem" style="width:160px;">
            <option value="">---</option>
            <option value="grupo">grupo de itens / separador</option>
            <option value="item">item</option>
        </select>
    </div>
    <div style="float:left;margin-left:10px;">
        <label class="req">Ordem do Item</label>
        <select id="ordemItem" style="width:110px;">
            <option value="">---</option>
            <?
            $nordem = mysql_num_rows(mysql_query("SELECT * FROM sysmodcampoitem WHERE numeroUnico='".$numeroUnicoGerado."'"));
            $nordem = $nordem+1;
            for ($b=1; $b<=$nordem; $b++) {
            ?>
            <option value='<?=$b?>'><?=$b?></option>
            <? } ?>
        </select>
    </div>
    <div style="float:left;margin-left:10px;">
        <label class="req">Nome do Item</label>
        <input value="" style="width:200px;" type="text" id="nomeItem" />
    </div>
    <div style="float:left;margin-left:10px;margin-top:27px;">
        <button type="button" onclick="salvarCampoItem();" class="btn btn-success btn-small">Adicionar</button>
    </div>
</div>
<div style="float:left;width:100%;margin-top:10px;margin-bottom:20px;">
    <div class="w-box w-box-blue">
        <div class="w-box-header">Lista de Itens do Campo</div>
        <div class="w-box-content">
            <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th style="width:170px;">Tipo</th>
                    <th style="width:120px;">Ordem</th>
                    <th>Nome</th>
                    <th style="width:50px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?
                $qSql = mysql_query("SELECT * FROM sysmodcampoitem WHERE numeroUnico='".$numeroUnicoGerado."' ORDER BY ordem");
                while($rSql = mysql_fetch_array($qSql)) {
                ?>
                <tr id="linha-<?=$rSql['id']?>">
                    <td>
                    <select id="idtipoItem-<?=$rSql['id']?>" style="width:160px;display:none;margin-top:9px;">
                        <option value="grupo" <? if($rSql['tipo']=="grupo") { echo" selected"; } ?>>grupo de itens / separador</option>
                        <option value="item" <? if($rSql['tipo']=="item") { echo" selected"; } ?>>item</option>
                    </select>
					<div id="tipoItem-<?=$rSql['id']?>" style="width:100%;display:block;margin-top:9px;"><? if($rSql['tipo']=="grupo") { echo "Grupo de Itens / Separador"; } else { echo "Item"; } ?></div>
                    </td>
                    <td>
                    <select id="idordemItem-<?=$rSql['id']?>" style="width:110px;display:none;margin-top:9px;">
                        <?
                        $nordem = mysql_num_rows(mysql_query("SELECT * FROM sysmodcampoitem WHERE numeroUnico='".$numeroUnicoGerado."'"));
                        for ($b=1; $b<=$nordem; $b++) {
                        ?>
                        <option value='<?=$b?>' <? if($rSql['ordem']==$b) { echo" selected"; } ?>><?=$b?></option>
                        <? } ?>
                    </select>
					<div id="ordemItem-<?=$rSql['id']?>" style="width:100%;display:block;margin-top:9px;"><?=$rSql['ordem']?>
                    </td>
                    <td>
					<input value="<?=$rSql['nome']?>" style="width:90%;display:none;margin-top:9px;" type="text" id="idnomeItem-<?=$rSql['id']?>" />
                    <div id="nomeItem-<?=$rSql['id']?>" style="width:100%;display:block;margin-top:9px;"><? if($rSql['tipo']=="grupo") { echo "<b>".$rSql['nome']."</b>"; } else { echo "<i>".$rSql['nome']."</i>"; } ?>
                    </td>
                    <td class="nolink">
                        <button type="button" id="idsalvarItem-<?=$rSql['id']?>" style="display:none;margin-bottom:3px;margin-top:4px;" onclick="updateCampoItem('<?=$numeroUnicoGerado?>','<?=$rSql['id']?>')" class="btn btn-info btn-mini">Salvar</button>
                        <button type="button" id="editarItem-<?=$rSql['id']?>" style="display:block;margin-bottom:3px;margin-top:4px;" onclick="editaCampoItem('<?=$rSql['id']?>')" class="btn btn-warning btn-mini">Editar</button>
                        <? if($rSql['stat']=="0") { ?>
                        <a href="javascript:void(0);" onclick="statusCampoItem('<?=$numeroUnicoGerado?>','<?=$rSql['id']?>','1');" class="splashy-gem_remove"><i class="splashy-gem_remove"></i></a>
                        <? } else { ?>
                        <a href="javascript:void(0);" onclick="statusCampoItem('<?=$numeroUnicoGerado?>','<?=$rSql['id']?>','0');" class="splashy-okay"><i class="splashy-okay"></i></a>
                        <? } ?>
                        <a href="javascript:void(0);" onclick="removeCampoItem('<?=$numeroUnicoGerado?>','<?=$rSql['id']?>');" class="splashy-remove"><i class="splashy-remove"></i></a>
                    </td>
                </tr>
                <? } ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
