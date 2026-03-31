<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
?>
                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Banco</label>
                                            <select id="banco_boleto" style="width:300px;">
                                                <option value="">---</option>
                                                <?
                                                $qSqlItem = mysql_query("SELECT * FROM sysbanco WHERE stat='1' ORDER BY nome");
                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                ?>
                                                <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;width:150px;">
                                            <label>Prazo para pagamento</label>
                                            <select id="prazo_boleto" style="width:300px;">
                                                <option value="0">Não receber após data de vencimento</option>
                                                <? for ($i = 1; $i <= 10; $i++) { ?>
                                                <option value="<?=$i?>"><?=$i?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;width:350px;">
                                            <label>Linha para informações</label>
                                            <textarea id="info_boleto" style="height:150px;width:350px;"></textarea>
                                            <span class="help-block" style="width:350px;float:left;margin-top:10px;">Insira aqui um texto descritivo que irá aparecer no boleto</span>
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <button type="button" onclick="sysconta_a_receber_gera_boleto('<?=$_REQUEST['idContaS']?>');" class="btn btn-success">Gerar Boleto</button>
                                        <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Cancelar</button>
                                    </div>
