        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#tb1_novo">Realizar Levantamento</a></li>
                                            </ul>
											<script>
                                              $(document).ready(function() {
                                                //* form validation
                                                forms.simple();
            
                                                //* datatables
                                                beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
			
												beoro_select_row.init();
										
												//* WYSIWG Editor
												beoro_wysiwg.init();

												//* datepicker
												beoro_datepicker.init();
                                            });
            
                                            //* form validation
                                            forms = {
                                                simple: function() {
                                                    if($('#forms').length) {
                                                        $('#forms').validate({
                                                            onkeyup: false,
                                                            errorClass: 'error',
                                                            validClass: 'valid',
                                                            highlight: function(element) {
                                                                $(element).closest('div').addClass("f-error");
                                                            },
                                                            unhighlight: function(element) {
                                                                $(element).closest('div').removeClass("f-error");
                                                            },
                                                            errorPlacement: function(error, element) {
                                                                $(element).closest('div').append(error);
                                                            },
                                                            rules: {
                                                                nome: { required: true },
                                                                data_inicio: { required: true },
                                                                data_fim: { required: true },
                                                            },
                                                            invalidHandler: function(form, validator) {
                                                                // callback
                                                            }
                                                        })
                                                    }
                                                }
                                            };
                                            
											//* select all rows
											beoro_select_row = {
												init: function() {
													$('.select_msgs').click(function () {
														var tableid = $(this).data('tableid');
														$('#'+tableid).find('input[class=select_msg]').attr('checked', this.checked);
													});
												},
											};

                                            //* datatables
                                            beoro_datatables = {
                                                //* column reorder & toggle visibility
                                                basic: function() {
                                                    if($('#dt_basic').length) {
                                                        $('#dt_basic').dataTable({
                                                            "sPaginationType": "bootstrap_full",
															"aaSorting": [[ 1, "asc" ]],
															"aoColumns": [
																{ "bSortable": false },
																{ "sType": "string" },
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };


											//* WYSIWG Editor
											beoro_wysiwg = {
												init: function() {
													if($('#texto').length) { 
														CKEDITOR.replace( 'texto', {
															toolbar: 'Standard'
														});
													}
												}
											};

											//* datepicker
											beoro_datepicker = {
												init: function() {
													if($('#data_inicio').length) {
														$('#data_inicio').datepicker()
													}
													if($('#data_fim').length) {
														$('#data_fim').datepicker()
													}
												}
											};
                                            </script>
                                            <div class="tab-content">

                                                <div id="tb1_novo" class="tab-pane active">
                                                    <? if(trim($levantamento)=="1") { ?>
                                                    <div>
                                                    	<div style="float:left;width:100%;margin-bottom:10px;">
															<?
                                                            $dia = date("j");
                                                            $mes_atual = date("m");
                                                            $ano = date("Y");
                                                            
                                                            $mes[101] = "Janeiro";
                                                            $mes[102] = "Fevereiro";
                                                            $mes[103] = "Março";
                                                            $mes[104] = "Abril";
                                                            $mes[105] = "Maio";
                                                            $mes[106] = "Junho";
                                                            $mes[107] = "Julho";
                                                            $mes[108] = "Agosto";
                                                            $mes[109] = "Setembro";
                                                            $mes[110] = "Outubro";
                                                            $mes[111] = "Novembro";
                                                            $mes[112] = "Dezembro";
                                                            $messet = "1$mes_atual";
                                                                                            
                                                            if(strlen($dia)==1) {
                                                                $dia = "0".$dia."";
                                                            } else {
                                                                $dia = $dia;
                                                            }
                                                            
                                                            if(strlen($mes_atual)==1) {
                                                                $mes_num = "0".$mes_atual."";
                                                            } else {
                                                                $mes_num = $mes_atual;
                                                            }

															$d_inicio  = substr($_POST['data_inicio'],0,2);
															$m_inicio  = substr($_POST['data_inicio'],3,2);
															$a_inicio  = substr($_POST['data_inicio'],6,4);
															$data_inicio = $a_inicio."-".$m_inicio."-".$d_inicio;

															$d_fim  = substr($_POST['data_fim'],0,2);
															$m_fim  = substr($_POST['data_fim'],3,2);
															$a_fim  = substr($_POST['data_fim'],6,4);
															$data_fim = $a_fim."-".$m_fim."-".$d_fim;
                                                            ?>
                                                            <table id="tabela_levantamento" cellpadding="0" cellspacing="0" width="100%">
                                                                <tr style="line-height:30px;">
                                                                    <td colspan="7" style="text-align:center;">Florianópolis, <?= $dia ?> de <?= $mes[$messet] ?> de <?= $ano ?></td>
                                                                </tr>
                                                                <tr style="line-height:1px;">
                                                                    <td colspan="7"><img src="<?=$link?>template/img/1x1.jpg" style="width:100%;height:1px;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="7" style="text-align:left;">
                                                                        <br>
                                                                        Prezados Responsáveis:
                                                                        <br>
                                                                        Segue abaixo o levantamento das contas à pagar referente ao período <?=$_POST['data_inicio']?> a <?=$_POST['data_fim']?> a seguir descriminadas:
                                                                        <br><br>
                                                                    </td>
                                                                </tr>
                                                                <tr style="line-height:1px;">
                                                                    <td colspan="7"><img src="<?=$link?>template/img/1x1.jpg" style="width:100%;height:1px;" /></td>
                                                                </tr>
                                                                <tr style="line-height:30px;">
                                                                    <th style="text-align:left;">&nbsp;Título</th>
                                                                    <th style="width:150px;text-align:right;">Data de Vencimento&nbsp;</th>
                                                                    <th style="width:150px;text-align:right;">Data do Pagamento&nbsp;</th>
                                                                    <th style="width:150px;text-align:right;">Valor Original&nbsp;</th>
                                                                    <th style="width:150px;text-align:right;">Juros&nbsp;</th>
                                                                    <th style="width:150px;text-align:right;">Desconto&nbsp;</th>
                                                                    <th style="width:150px;text-align:right;">Valor Final&nbsp;</th>
                                                                </tr>
                                                                <tr style="line-height:1px;">
                                                                    <td colspan="7"><img src="<?=$link?>template/img/1x1.jpg" style="width:100%;height:1px;" /></td>
                                                                </tr>
																<?
                                                                $qSql = mysql_query("SELECT * FROM conta_a_pagar WHERE data_vencimento BETWEEN '".$d_inicio."' AND '".$data_fim."'");
                                                                while($rSql=mysql_fetch_array($qSql)) {
                                                                    if($cor == "#f0f0f0") {
                                                                        $cor = "#ffffff";
                                                                    } else {
                                                                        $cor = "#f0f0f0";
                                                                    }

                                                                    $valor_final = 0;

                                                                    $total_real = $rSql['valor_real'] + $total_real;
                                                                    $total_juros = $rSql['valor_juros'] + $total_juros;
                                                                    $total_desconto = $rSql['valor_desconto'] + $total_desconto;
                                                                    
                                                                    $valor_final = ($total_real + $total_juros) - $total_desconto;
                                                                ?>
                                                                <tr style="background-color:<?=$cor?>;line-height:30px;">
                                                                    <td style="vertical-align:middle;">&nbsp;<?=$rSql['nome']?></td>
                                                                    <td style="vertical-align:middle;text-align:right;"><? if(trim($rSql['data_vencimento'])==""||trim($rSql['data_vencimento'])=="0000-00-00") { } else { ajustaData($rSql['data_vencimento'],"d/m/Y"); } ?>&nbsp;</td>
                                                                    <td style="vertical-align:middle;text-align:right;"><? if(trim($rSql['data_pagamento'])==""||trim($rSql['data_pagamento'])=="0000-00-00") { } else { ajustaData($rSql['data_pagamento'],"d/m/Y"); } ?>&nbsp;</td>
                                                                    <td style="vertical-align:middle;text-align:right;"><?=$rSql['valor_real']?>&nbsp;</td>
                                                                    <td style="vertical-align:middle;text-align:right;"><?=$rSql['valor_juros']?>&nbsp;</td>
                                                                    <td style="vertical-align:middle;text-align:right;"><?=$rSql['valor_desconto']?>&nbsp;</td>
                                                                    <td style="vertical-align:middle;text-align:right;"><?=number_format($valor_final, 2, ',','.')?>&nbsp;</td>
                                                                </tr>
                                                                <? } ?>
                                                                
                                                                <? $total_final = ($total_real + $total_juros) - $total_desconto; ?>
                                                                <tr style="line-height:1px;">
                                                                    <td colspan="7"><img src="<?=$link?>template/img/1x1.jpg" style="width:100%;height:1px;" /></td>
                                                                </tr>
                                                                <tr class="last_row">
                                                                    <td colspan="5">&nbsp;</td>
                                                                    <td colspan="2" style="text-align:right;">
                                                                        <p class="sepH_a"><span class="muted sepV_b">Subtotal</span>R$ <?=number_format($total_real, 2, ',','.')?>&nbsp;</p>
                                                                        <p class="sepH_a"><span class="muted sepV_b">Juros</span>R$ <?=number_format($total_juros, 2, ',','.')?>&nbsp;</p>
                                                                        <p class="sepH_a"><span class="muted sepV_b">Descontos</span>R$ <?=number_format($total_desconto, 2, ',','.')?>&nbsp;</p>
                                                                        <p><strong><span class="sepV_b">Total</span>R$ <?=number_format($total_final, 2, ',','.')?>&nbsp;</strong></p>
                                                                    </td>
                                                                </tr>
                                                                <? if(trim($_POST['texto'])=="") { } else { ?>
                                                                <tr style="line-height:1px;">
                                                                    <td colspan="7"><img src="<?=$link?>template/img/1x1.jpg" style="width:100%;height:1px;" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="7" style="text-align:left;">
                                                                        <br>
                                                                        <b>OBSERVAÇÕES</b>
                                                                        <br>
                                                                        <?=$_POST['texto']?>
                                                                        <br><br>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                                <tr>
                                                                    <td colspan="7" style="text-align:center;">Atenciosamente, <b><?=$sysusu['nome']?></b></td>
                                                                </tr>
                                                            </table>	

                                                        </div>
                                                        <div class="formSep">
                                                            <button type="button" onclick="javascript:PrintDiv('tabela_levantamento');" class="btn btn-inverse">Imprimir</button>
                                                            <button type="button" onclick="javascript:window.open('<?=$link?><?=$_REQUEST['var2']?>/','_self','');" class="btn btn-info">Limpar</button>
                                                        </div>
                                                    </div>
                                                    <? } else { ?>
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="add" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = geraCodReturn(); 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:100%;">
                                                                    <label>Título</label>
                                                                    <input value="" class="span7"  type="text" name="nome" id="nome" />
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;width:110px;">
                                                                    <label>Data de Início</label>
                                                                    <input style="width:90px;" value="" data-date-format="dd/mm/yyyy" name="data_inicio" id="data_inicio" type="text">
                                                                </div>
                                                                <div style="float:left;margin-right:10px;width:110px">
                                                                    <label>Data de Fim</label>
                                                                    <input style="width:90px;" value="" data-date-format="dd/mm/yyyy" name="data_fim" id="data_fim" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="formSep">
                                                                <label>Observação</label>
                                                                <textarea name="texto" id="texto" class="span12" style="height:150px;"></textarea>
                                                                <span class="help-block" style="width:100%;float:left;margin-top:10px;">Escreva aqui algum texto de observação ou descrição deste item</span>
                                                            </div>

                                                            <div class="formSep">
                                                                <button type="submit" class="btn btn-success">Gerar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <? } ?>
                                                </div>

                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
