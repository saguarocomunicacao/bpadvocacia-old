<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$sufixoGet = $_GET['sufixoS'];
$idGet = $_GET['idS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_syscronograma_item WHERE id='".$idGet."'"));
$nordem = mysql_num_rows(mysql_query("SELECT * FROM parceiro_syscronograma_item WHERE numeroUnico_pai='".$numeroUnicoGet."'"));
?>

    <input type="hidden" name="numeroUnico" value="<?=$item['numeroUnico']?>">

    <div class="alert" id="alert-editar_editar"><strong>Você esta editando o item:</strong> <?=$item['nome']?></div>

    <div style="float:left;width:100%;">
        <div style="float:left;margin-right:10px;padding-bottom:10px;">
            <label class="req">Prioridade</label>
            <select name="ordem" id="ordem_item_editar" style="width:50px;">
                <?
                $ultimaOrdem = $nordem;
                for ($b=1; $b<=$ultimaOrdem; $b++) {
                ?>
                <option value='<?=$b?>' <? if($b==$item['ordem']) { echo "selected"; } ?>><?=$b?></option>
                <? } ?>
            </select>
        </div>
        <div style="float:left;margin-right:10px;padding-bottom:10px;">
            <label class="req">Título</label>
            <input value="<?=$item['nome']?>" style="width:400px;" type="text" name="nome" id="nome_item_editar" placeholder="Digite um título para a tarefa" />
        </div>
    </div>
    <div style="float:left;width:100%;">
        <label>Arquivo, Imagem ou Documento</label>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
            <? if(trim($item['imagem'])=="") { ?>
            <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
            <? } else { ?>
            <img id="arquivo-atual-imagem" src="<?=$link?>files/parceiro_syscronograma_item/<?=$item['numeroUnico']?>/<?=$item['imagem']?>" alt="">
            <? } ?>
            </div>
            <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
            <? if(trim($item['imagem'])=="") { ?>
            <span class="btn btn-small btn-file">
                <span class="fileupload-new">Selecionar arquivo</span>
                <span class="fileupload-exists">Alterar</span>
                <input name="imagem" id="imagem_item_editar" type="file">
            </span>
            <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
            <? } else { ?>
            <span class="btn btn-small btn-file">
                <span>Alterar</span>
                <input name="imagem" id="imagem_item_editar" type="file">
            </span>
            <a href="javascript:void(0);" onclick="remover_imagem('<?=$item['id']?>','parceiro_syscronograma_item','imagem');" class="btn btn-small" data-dismiss="fileupload">Remover</a>
            <? } ?>
        </div>
        <span class="help-block" style="width:100%;float:left;">Insira aqui um arquivo, imagem, documento referente à este item de tarefa</span>
    </div>
    <div style="float:left;width:100%;">
        <label class="req">Descrição</label>
        <textarea name="descricao" id="descricao_item_editar" class="span12" style="height:150px;"><?=$item['descricao']?></textarea>
    </div>
    <div style="float:left;width:100%;margin-top:10px;">
        <label class="req">Ativo ?</label>
        <label class="radio" style="color:#C00;">
            <input type="radio" name="stat" id="stat1_item_editar" value="0" <? if($row['stat']==0||trim($row['stat'])==0) { echo "checked"; } ?> >
            não
        </label>
        <label class="radio" style="color:#390;">
            <input type="radio" name="stat" id="stat2_item_editar" value="1" <? if($row['stat']==1) { echo "checked"; } ?> >
            sim
        </label>
    </div>	
