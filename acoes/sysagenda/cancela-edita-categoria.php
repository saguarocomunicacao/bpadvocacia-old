<?php
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$criadorGet = $_GET['criadorS'];

?>

    <div class="formSep">
        <label class="req">Ordem</label>
        <select name="ordem" name="ordem_categoria" style="width:50px;">
			<?
            $nordem = mysql_num_rows(mysql_query("SELECT * FROM sysagenda_categoria WHERE criador='".$criadorGet."'"));
            if($nordem==0) {
            ?>
            <option value='1'>1</option>
            <?
            } else {
            $ultimaOrdem = $nordem+1;
            for ($b=1; $b<=$ultimaOrdem; $b++) {
            ?>
            <option value='<?=$b?>' <? if($b==$ultimaOrdem) { echo "selected"; } ?>><?=$b?></option>
            <? } } ?>
        </select>
    </div>

    <div class="formSep">
        <div style="float:left;margin-right:10px;">
            <label class="req">Nome</label>
            <input value="" style="width:350px;" type="text" name="nome" id="nome_categoria" />
        </div>
    </div>

    <!--
    <div class="formSep">
        <div style="float:left;margin-right:10px;">
            <label>Cor da categoria</label>
            <input value="" style="width:70px;" type="text" name="cor" id="cor_categoria" />
        </div>
    </div>
    -->
