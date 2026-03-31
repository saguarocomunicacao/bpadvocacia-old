<?php
require_once("../../include/inc/main.php");
require_once("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$anoGet = $_GET['anoS'];

?>

                                                        <div class="w-box w-box">
                                                            <div class="w-box-header">
                                                                <h4>Extrato Anual</h4>
                                                                <div class="pull-left">
                                                                </div>
                                                            </div>
                                                            <div class="w-box-content">
                                                                <table class="table table-striped table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Janeiro&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Fevereiro&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Março&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Abril&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Maio&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Junho&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Julho&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Agosto&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Setembro&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Outubro&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Novembro&nbsp;</th>
                                                                        <th style="width:8%;text-align:center;">&nbsp;Dezembro&nbsp;</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
																	<?
                                                                    $qSqlCategoria = mysql_query("SELECT * FROM sysconta_a_receber_categoria ORDER BY ordem");
                                                                    while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
																		$jan_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","01","".$anoGet."");
																		$fev_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","02","".$anoGet."");
																		$mar_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","03","".$anoGet."");
																		$abr_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","04","".$anoGet."");
																		$mai_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","05","".$anoGet."");
																		$jun_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","06","".$anoGet."");
																		$jul_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","07","".$anoGet."");
																		$ago_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","08","".$anoGet."");
																		$set_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","09","".$anoGet."");
																		$out_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","10","".$anoGet."");
																		$nov_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","11","".$anoGet."");
																		$dez_set = mes_extrato_anual("sysconta_a_receber","".$rSqlCategoria['id']."","12","".$anoGet."");

																		$jan_set_total_receber = $jan_set_total_receber + $jan_set;
																		$fev_set_total_receber = $fev_set_total_receber + $fev_set;
																		$mar_set_total_receber = $mar_set_total_receber + $mar_set;
																		$abr_set_total_receber = $abr_set_total_receber + $abr_set;
																		$mai_set_total_receber = $mai_set_total_receber + $mai_set;
																		$jun_set_total_receber = $jun_set_total_receber + $jun_set;
																		$jul_set_total_receber = $jul_set_total_receber + $jul_set;
																		$ago_set_total_receber = $ago_set_total_receber + $ago_set;
																		$set_set_total_receber = $set_set_total_receber + $set_set;
																		$out_set_total_receber = $out_set_total_receber + $out_set;
																		$nov_set_total_receber = $nov_set_total_receber + $nov_set;
																		$dez_set_total_receber = $dez_set_total_receber + $dez_set;

																		$ano_total_receber = $jan_set + $fev_set + $mar_set + $abr_set + $mai_set + $jun_set + $jul_set + $ago_set + $set_set + $out_set + $nov_set + $dez_set;
																		$ano_total_receber_final = $ano_total_receber_final + $ano_total_receber;
																	?>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;" nowrap><?=$rSqlCategoria['nome']?></td>
                                                                        <td style="text-align:center;"><?=number_format($jan_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($fev_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($mar_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($abr_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($mai_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($jun_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($jul_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($ago_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($set_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($out_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($nov_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($dez_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($ano_total_receber, 2, ',','.')?></td>
                                                                    </tr>
                                                                    <? } ?>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;background-color:#C9E8FA;" nowrap></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($jan_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($fev_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($mar_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($abr_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($mai_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($jun_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($jul_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($ago_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($set_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($out_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($nov_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($dez_set_total_receber, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#C9E8FA;font-weight:bold;"><?=number_format($ano_total_receber_final, 2, ',','.')?></td>
                                                                    </tr>
																	<?
                                                                    $qSqlCategoria = mysql_query("SELECT * FROM sysconta_a_pagar_categoria ORDER BY ordem");
                                                                    while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
																		$jan_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","01","".$anoGet."");
																		$fev_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","02","".$anoGet."");
																		$mar_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","03","".$anoGet."");
																		$abr_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","04","".$anoGet."");
																		$mai_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","05","".$anoGet."");
																		$jun_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","06","".$anoGet."");
																		$jul_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","07","".$anoGet."");
																		$ago_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","08","".$anoGet."");
																		$set_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","09","".$anoGet."");
																		$out_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","10","".$anoGet."");
																		$nov_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","11","".$anoGet."");
																		$dez_set = mes_extrato_anual("sysconta_a_pagar","".$rSqlCategoria['id']."","12","".$anoGet."");

																		$jan_set_total_pagar = $jan_set_total_pagar + $jan_set;
																		$fev_set_total_pagar = $fev_set_total_pagar + $fev_set;
																		$mar_set_total_pagar = $mar_set_total_pagar + $mar_set;
																		$abr_set_total_pagar = $abr_set_total_pagar + $abr_set;
																		$mai_set_total_pagar = $mai_set_total_pagar + $mai_set;
																		$jun_set_total_pagar = $jun_set_total_pagar + $jun_set;
																		$jul_set_total_pagar = $jul_set_total_pagar + $jul_set;
																		$ago_set_total_pagar = $ago_set_total_pagar + $ago_set;
																		$set_set_total_pagar = $set_set_total_pagar + $set_set;
																		$out_set_total_pagar = $out_set_total_pagar + $out_set;
																		$nov_set_total_pagar = $nov_set_total_pagar + $nov_set;
																		$dez_set_total_pagar = $dez_set_total_pagar + $dez_set;

																		$ano_total_pagar = $jan_set + $fev_set + $mar_set + $abr_set + $mai_set + $jun_set + $jul_set + $ago_set + $set_set + $out_set + $nov_set + $dez_set;
																		$ano_total_pagar_final = $ano_total_pagar_final + $ano_total_pagar;
																	?>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;" nowrap><?=$rSqlCategoria['nome']?></td>
                                                                        <td style="text-align:center;"><?=number_format($jan_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($fev_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($mar_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($abr_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($mai_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($jun_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($jul_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($ago_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($set_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($out_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($nov_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($dez_set, 2, ',','.')?></td>
                                                                        <td style="text-align:center;"><?=number_format($ano_total_pagar, 2, ',','.')?></td>
                                                                    </tr>
                                                                    <? } ?>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;background-color:#FEDADB;" nowrap></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($jan_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($fev_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($mar_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($abr_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($mai_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($jun_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($jul_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($ago_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($set_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($out_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($nov_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($dez_set_total_pagar, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FEDADB;font-weight:bold;"><?=number_format($ano_total_pagar_final, 2, ',','.')?></td>
                                                                    </tr>
                                                                    <?
																		$jan_set_total_final = $jan_set_total_receber - $jan_set_total_pagar;
																		$fev_set_total_final = $fev_set_total_receber - $fev_set_total_pagar;
																		$mar_set_total_final = $mar_set_total_receber - $mar_set_total_pagar;
																		$abr_set_total_final = $abr_set_total_receber - $abr_set_total_pagar;
																		$mai_set_total_final = $mai_set_total_receber - $mai_set_total_pagar;
																		$jun_set_total_final = $jun_set_total_receber - $jun_set_total_pagar;
																		$jul_set_total_final = $jul_set_total_receber - $jul_set_total_pagar;
																		$ago_set_total_final = $ago_set_total_receber - $ago_set_total_pagar;
																		$set_set_total_final = $set_set_total_receber - $set_set_total_pagar;
																		$out_set_total_final = $out_set_total_receber - $out_set_total_pagar;
																		$nov_set_total_final = $nov_set_total_receber - $nov_set_total_pagar;
																		$dez_set_total_final = $dez_set_total_receber - $dez_set_total_pagar;
																		$ano_set_total_final = $ano_total_receber_final - $ano_total_pagar_final;
																		
																		if($jan_set_total_final<0) { $jan_cor = "#F00"; } else { $jan_cor = "#060"; }
																		if($fev_set_total_final<0) { $fev_cor = "#F00"; } else { $fev_cor = "#060"; }
																		if($mar_set_total_final<0) { $mar_cor = "#F00"; } else { $mar_cor = "#060"; }
																		if($abr_set_total_final<0) { $abr_cor = "#F00"; } else { $abr_cor = "#060"; }
																		if($mai_set_total_final<0) { $mai_cor = "#F00"; } else { $mai_cor = "#060"; }
																		if($jun_set_total_final<0) { $jun_cor = "#F00"; } else { $jun_cor = "#060"; }
																		if($jul_set_total_final<0) { $jul_cor = "#F00"; } else { $jul_cor = "#060"; }
																		if($ago_set_total_final<0) { $ago_cor = "#F00"; } else { $ago_cor = "#060"; }
																		if($set_set_total_final<0) { $set_cor = "#F00"; } else { $set_cor = "#060"; }
																		if($out_set_total_final<0) { $out_cor = "#F00"; } else { $out_cor = "#060"; }
																		if($nov_set_total_final<0) { $nov_cor = "#F00"; } else { $nov_cor = "#060"; }
																		if($dez_set_total_final<0) { $dez_cor = "#F00"; } else { $dez_cor = "#060"; }
																		if($ano_set_total_final<0) { $ano_cor = "#F00"; } else { $ano_cor = "#060"; }
																	?>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;background-color:#FFFFFF;" nowrap></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$jan_cor?>;"><?=number_format($jan_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$fev_cor?>;"><?=number_format($fev_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$mar_cor?>;"><?=number_format($mar_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$abr_cor?>;"><?=number_format($abr_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$mai_cor?>;"><?=number_format($mai_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$jun_cor?>;"><?=number_format($jun_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$jul_cor?>;"><?=number_format($jul_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$ago_cor?>;"><?=number_format($ago_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$set_cor?>;"><?=number_format($set_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$out_cor?>;"><?=number_format($out_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$nov_cor?>;"><?=number_format($nov_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$dez_cor?>;"><?=number_format($dez_set_total_final, 2, ',','.')?></td>
                                                                        <td style="text-align:center;background-color:#FFFFFF;font-weight:bold;color:<?=$ano_cor?>;"><?=number_format($ano_set_total_final, 2, ',','.')?></td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
    