<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");
?>
                                    <? $processo_set = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo WHERE id='".$_REQUEST['idProcessoS']."'")); ?>
                                    <div id="contrato-conteudo" style="display:none;">
                                    </div>
                                    
                                    <!--
                                    <div class="formSep">
                                        <label class="req">Contrato</label>
                                        <select id="parceiro_syscontrato_modelo" style="width:300px;">
                                            <option value="">---</option>
                                            <?
                                            $qSqlItem = mysql_query("SELECT * FROM parceiro_syscontrato_modelo WHERE stat='1' ORDER BY nome");
                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                            ?>
                                            <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                            <? } ?>
                                        </select>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label>Data de assinatura</label>
                                            <select id="data_assinatura_dia" style="width:60px;">
                                                <option value="">---</option>
                                                <? 
												for ($i = 1; $i <= 31; $i++) { 
												if(strlen($i)<2) { $i = "0".$i; } else { $i = $i; }
												?>
                                                <option value="<?=$i?>"><?=$i?></option>
                                                <? } ?>
                                            </select>
                                            <select id="data_assinatura_mes" style="width:110px;">
                                                <option value="">---</option>
                                                <option value="Janeiro">Janeiro</option>
                                                <option value="Fevereiro">Fevereiro</option>
                                                <option value="Março">Março</option>
                                                <option value="Abril">Abril</option>
                                                <option value="Maio">Maio</option>
                                                <option value="Junho">Junho</option>
                                                <option value="Julho">Julho</option>
                                                <option value="Agosto">Agosto</option>
                                                <option value="Setembro">Setembro</option>
                                                <option value="Outubro">Outubro</option>
                                                <option value="Novembro">Novembro</option>
                                                <option value="Dezembro">Dezembro</option>
                                            </select>
                                            <select id="data_assinatura_ano" style="width:80px;">
                                                <option value="">---</option>
                                                <? 
												$ano_ini = date("Y") - 5;
												$ano_fim = date("Y") + 5;
												for ($i = $ano_ini; $i <= $ano_fim; $i++) { 
												?>
                                                <option value="<?=$i?>"><?=$i?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="formSep">
                                        <button type="button" onclick="parceiro_adv_processo_gera_contrato('<?=$_REQUEST['idProcessoS']?>');" class="btn btn-success">Gerar Contrato</button>
                                        <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Cancelar</button>
                                    </div>
                                    -->
                                    
									<?
                                    $qSqlparceiro_syscliente = mysql_query("SELECT * FROM parceiro_adv_processo_parceiro_syscliente WHERE numeroUnico_pai='".$processo_set['numeroUnico']."' ORDER BY data DESC");
                                    while($rSqlparceiro_syscliente = mysql_fetch_array($qSqlparceiro_syscliente)) {
                                        $parceiro_syscliente_processo = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_syscliente WHERE id='".$rSqlparceiro_syscliente['idparceiro_syscliente']."'"));
                                    ?>
                                    <div class="formSep" style="width:710px;">
                                        <div style="float:left;margin-right:10px;width:710px;font-weight:bold;padding-bottom:5px;border-bottom:1px solid #CCC;margin-bottom:5px;"><?=$parceiro_syscliente_processo['nome']?></div>

                                        <div style="float:left;margin-right:10px;width:710px;padding-bottom:5px;">

                                            <div style="float:left;margin-right:10px;">
                                                <label class="req">Contrato</label>
                                                <select id="parceiro_syscontrato_modelo_<?=$parceiro_syscliente_processo['id']?>" style="width:300px;">
                                                    <option value="">---</option>
                                                    <?
                                                    $qSqlItem = mysql_query("SELECT * FROM parceiro_syscontrato_modelo WHERE stat='1' ORDER BY nome");
                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                    ?>
                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                            <div style="float:left;margin-right:10px;">
                                                <label>Data de assinatura</label>
                                                <select id="data_assinatura_dia_<?=$parceiro_syscliente_processo['id']?>" style="width:60px;">
                                                    <option value="">---</option>
                                                    <? 
                                                    for ($i = 1; $i <= 31; $i++) { 
                                                    if(strlen($i)<2) { $i = "0".$i; } else { $i = $i; }
                                                    ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                    <? } ?>
                                                </select>
                                                <select id="data_assinatura_mes_<?=$parceiro_syscliente_processo['id']?>" style="width:110px;">
                                                    <option value="">---</option>
                                                    <option value="Janeiro">Janeiro</option>
                                                    <option value="Fevereiro">Fevereiro</option>
                                                    <option value="Março">Março</option>
                                                    <option value="Abril">Abril</option>
                                                    <option value="Maio">Maio</option>
                                                    <option value="Junho">Junho</option>
                                                    <option value="Julho">Julho</option>
                                                    <option value="Agosto">Agosto</option>
                                                    <option value="Setembro">Setembro</option>
                                                    <option value="Outubro">Outubro</option>
                                                    <option value="Novembro">Novembro</option>
                                                    <option value="Dezembro">Dezembro</option>
                                                </select>
                                                <select id="data_assinatura_ano_<?=$parceiro_syscliente_processo['id']?>" style="width:80px;">
                                                    <option value="">---</option>
                                                    <? 
                                                    $ano_ini = date("Y") - 5;
                                                    $ano_fim = date("Y") + 5;
                                                    for ($i = $ano_ini; $i <= $ano_fim; $i++) { 
                                                    ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                            <div id="btn-gerador_<?=$parceiro_syscliente_processo['id']?>" style="float:left;margin-top:25px;">
                                                <button type="button" onclick="parceiro_adv_processo_gera_contrato_cliente('<?=$_REQUEST['idProcessoS']?>','<?=$parceiro_syscliente_processo['id']?>','<?=$_REQUEST['idUsuarioS']?>');" class="btn btn-success">Gerar Contrato</button>
                                            </div>
                                            <div id="preloader_<?=$parceiro_syscliente_processo['id']?>" style="float:left;display:none;margin-top:30px;margin-left:5px;">
                                                <img src="<?=$link?>template/img/preloader-2.gif" style="float:left;margin-right:5px;margin-top:5px;" />
                                                <div style="float:left;">gerando</div>
                                            </div>
    
                                        </div>
                                    </div>

                                    <? } ?>

                                    <div class="formSep">
                                        <button type="button" onclick="javascript:parent.$.fancybox.close();" class="btn btn-warning">Cancelar</button>
                                    </div>
                                    