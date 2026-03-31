<?php
include("../../include/inc/data.php");

$idGet = $_GET['idContaS'];
$modGet = "".$_GET['modContaS']."";
$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet." WHERE id='".$idGet."'"));

include("../../header.php");
?>
    <div class="formSep">
        <div style="float:left;margin-right:10px;padding-bottom:10px;">
            <label style="font-size:10px;">Pago</label>
            <input type="checkbox" name="pago" id="pago" <? if(trim($item['pago'])==1) { echo " checked"; } ?> class="pago {labelOn: 'SIM', labelOff: 'NÃO'}" />
        </div>
        <div style="float:left;margin-right:10px;width:150px;">
            <label>Data de pagamento</label>
            <div class="input-append date" id="data_pagamento" data-date-format="dd/mm/yyyy" data-date="<? if(trim($item['data_pagamento'])==""||trim($item['data_pagamento'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($item['data_pagamento'],"d/m/Y"); } ?>">
                <input class="span8" size="16" name="data_pagamento" value="<? if(trim($item['data_pagamento'])==""||trim($item['data_pagamento'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($item['data_pagamento'],"d/m/Y"); } ?>" type="text">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
        </div>
    </div>

    <div class="formSep">
        <button type="button" onclick="salvar_sysconta_a_pagar('<?=$_REQUEST['idContaS']?>');" class="btn btn-success">Salvar</button>
        <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Cancelar</button>
    </div>
