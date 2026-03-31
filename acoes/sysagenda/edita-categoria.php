<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM sysagenda_categoria WHERE id='".$idGet."'"));
$nordem = mysql_num_rows(mysql_query("SELECT * FROM sysagenda_categoria WHERE criador='".$item['criador']."'"));
?>


    <div class="alert" id="alert-editar_editar"><strong>Você esta editando o item:</strong> <?=$item['nome']?></div>

    <div class="formSep">
        <label class="req">Ordem</label>
        <select name="ordem" name="ordem_categoria" style="width:50px;">
			<?
            $ultimaOrdem = $nordem;
            for ($b=1; $b<=$ultimaOrdem; $b++) {
            ?>
            <option value='<?=$b?>' <? if($b==$item['ordem']) { echo "selected"; } ?>><?=$b?></option>
            <? } ?>
        </select>
    </div>

    <div class="formSep">
        <div style="float:left;margin-right:10px;">
            <label class="req">Nome</label>
            <input value="<?=$item['nome']?>" style="width:350px;" type="text" name="nome" id="nome_categoria" />
        </div>
    </div>

    <!--
    <div class="formSep">
        <div style="float:left;margin-right:10px;">
            <label>Cor da categoria</label>
            <input value="<?=$item['cor']?>" style="width:70px;" type="text" name="cor" id="cor_categoria" />
        </div>
    </div>
    -->
