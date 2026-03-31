        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>

							<? include("./acoes/sysgeral/menu-intimacao.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo") { } else { ?><? if(trim($sysperm['editar_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_editar">Editando <?=$row['nome']?></a></li><? } ?><? } ?>
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Lista de Itens</a></li><? } ?>
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
            
												//* switch buttons
												/*
												beoro_switchButtons.init();
												*/
										
												//* WYSIWG Editor
												beoro_wysiwg.init();

												//* datepicker
												beoro_datepicker.init();

												//* timepicker
												beoro_timepicker.init();

												//* 2col multiselect
												beoro_multiselect.init();

												//* enchanced select box
												/*
												beoro_enchancedSelect.init();
												*/

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
                                                                stat: { required: true },
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
                                                    if($('#example').length) {
														$('#example').dataTable({
															"processing": true,
															"serverSide": true,
															"iDisplayLength": 50,
															"ajax": "<?=$link?>acoes/adv_intimacao/tabela.php?var1=<?=$_REQUEST['var1']?>&var2=<?=$_REQUEST['var2']?>&var3=<?=$_REQUEST['var3']?>&var4=<?=$_REQUEST['var4']?>&var5=<?=$_REQUEST['var5']?>&sysusuS=<?=$sysusu['id']?>",
                                                            "sPaginationType": "bootstrap_full",
															"oLanguage": {
																"sLengthMenu": '<select style="height:23px;">'+
																'<option value="100">50</option>'+
																'<option value="100">100</option>'+
																'<option value="150">150</option>'+
																'<option value="200">200</option>'+
																'<option value="250">250</option>'+
																'<option value="300">300</option>'+
																'<option value="350">350</option>'+
																'<option value="400">400</option>'+
																'<option value="450">450</option>'+
																'<option value="500">500</option>'+
																'<option value="-1">Todos</option>'+
																'</select>'
															},
															"aoColumns": [
																{ "bSortable": false },
																{ "bSortable": false },
																{ "sType": "string" },
																{ "bSortable": false },
																{ "bSortable": false },
																{ "bSortable": false }
															],
															"aaSorting": [[ 5, "desc" ]]
														});

                                                    }
                                                }
                                            };

											//* WYSIWG Editor
											beoro_wysiwg = {
												init: function() {
													if($('#descricao_item_editar').length) { 
														CKEDITOR.replace( 'descricao_item_editar', {
															toolbar: 'Standard'
														});
													}
												}
											};

											//* datepicker
											beoro_datepicker = {
												init: function() {
													if($('#data_fim').length) {
														$('#data_fim').datepicker()
													}
												}
											};

											//* multiselect
//* multiselect
beoro_multiselect = {
  init: function(){
    if($('#lista_admin_itens').length) {

      $('#lista_admin_itens').multiSelect({
        selectableHeader: '<div class="search-header"><input type="text" class="span12" autocomplete="off" placeholder="Digite aqui sua busca"></div>',
        selectionHeader: "<div class='search-selected'></div>",

        afterInit: function(ms){
          var that = this;

          // Busca no lado esquerdo
          var $selectableSearch = that.$selectableUl.prev().find('input');

          // Esconder lado direito quando não tem selecionado
          var $container  = that.$container;                 // .ms-container
          var $selection  = $container.find('.ms-selection'); // coluna da direita

          // Se não tem nenhum selecionado, esconde a coluna da direita
          if($(that.$element).find('option:selected').length === 0) {
            $selection.show();
          } else {
            $selection.show();
          }

          that.qs1 = $selectableSearch.quicksearch(
            that.$selectableUl.find('li.ms-elem-selectable'),
            { 'show': function(){ $(this).show(); }, 'hide': function(){ $(this).hide(); } }
          );

          $selectableSearch.on('keydown', function(e){
            if(e.which === 40){ that.$selectableUl.focus(); return false; }
          });
        },

        afterSelect: function(values){
          // Atualiza hidden
          $('#lista_admin').val(""+$('#lista_admin').val()+'|'+values+'|');

          // Mostra o lado direito quando tiver pelo menos 1 selecionado
          var $container = this.$container;
          $container.find('.ms-selection').show();

          if(this.qs1) this.qs1.cache();
        },

        afterDeselect: function(values){
          // Atualiza hidden
          $('#lista_admin').val($('#lista_admin').val().replace('|'+values+'|',''));

          // Se não sobrou nenhum selecionado, esconde o lado direito
          var $container = this.$container;
          if($(this.$element).find('option:selected').length === 0) {
            $container.find('.ms-selection').hide();
          }

          if(this.qs1) this.qs1.cache();
        }
      });

    }
  }
};
											//* switch buttons
											/*
											beoro_switchButtons = {
												init: function() {
													if($('#somente_criador').length) { $("#somente_criador").iButton(); }
													if($('#edicao_aberta').length) { $("#edicao_aberta").iButton(); }
												}
											};
											*/

											//* timepicker
											beoro_timepicker = {
												init: function() {
													if($('#hora_fim').length) {
														$('#hora_fim').timepicker({
															minuteStep: 1,
															showSeconds: true,
															showInputs: false,
															showMeridian: false
														})
													}
												}
											};

                                            </script>
                                            <div class="tab-content">
                                                
                                                <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo") { } else { ?>
                                                <div id="tb1_editar" class="tab-pane active">

                                                    <div class="tabbable tabs-left tabbable-bordered">
                                                        <ul class="nav nav-tabs">
                                                            <li <? if(trim($_REQUEST['var5'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_a">Dados da intimação</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="tarefas") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_b">Tarefas</a></li>
                                                            <li <? if(trim($_REQUEST['var5'])=="movimentacoes") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb3_movimentacoes">Movimentações</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div id="tb3_a" class="tab-pane <? if(trim($_REQUEST['var5'])=="") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" target="_self" ENCTYPE="multipart/form-data" id="formulario">
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                    <input type="hidden" name="iditem" value="<?=$row['id']?>" />
                        
                                                                    <? 
                                                                    $numeroUnicoGerado = $row['numeroUnico']; 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                        
        
                                                                    <input type="hidden" name="pendente" id="pendente" value="<?=$row['pendente']?>" />
                                                                    <input type="hidden" name="situacao" id="situacao" value="<?=$row['situacao']?>" />

                                                                    <div class="formSep">
                                                                        <label>Data</label>
                                                                        <input value="<?=$row['data_xml']?>" class="span5" type="text" name="data_xml" id="data_xml" />
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <label>Número do Processo</label>
                                                                        <input value="<?=$row['cod']?>" class="span7" type="text" name="cod" id="cod" />
                                                                    </div>
                        
                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Processo criado por</label>
                                                                        <input type="hidden" name="criador" value="<?=$row['criador']?>">
                                                                        <? $rSqlCriador = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$row['criador']."'")); ?>
                                                                        <input value="<?=$rSqlCriador['nome']?>" class="span7" type="text" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Filtro</label>
                                                                            <input value="" style="width:300px;" type="text" id="filtro_cliente" placeholder="Digite sua busca para achar um cliente" onkeyup="busca_cliente();" />
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                        <label id="label-perfil">Cliente</label>
                                                                        <select style="width:300px;" id="idsyscliente">
                                                                            <option value="">---</option>
                                                                        </select>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <button type="button" onclick="salvar_lista_syscliente_adv_processo('<?=$mod?>');" style="margin-top:23px;" class="btn btn-primary">Adicionar</button>
                                                                        </div>
                                                                        <div id="div-add-syscliente" style="margin-top:30px;display:block;">
                                                                        <a class="img_action_edit popup_fancy" href="<?=$link?>acoes/syscliente/form.php?idsysusuS=<?=$sysusu['id']?>&sufixoS=" title="Adicionar um cliente"><p style="color:#368CA9;"><b>+ Novo cliente</b></p></a>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Selecione um cliente e clique em Adicionar</span>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <div id="lista_<?=$mod?>_syscliente" style="width:100%;float:left;">
                                                                            <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./acoes/adv_processo/lista_".$mod."_syscliente.php"); ?>
                                                                        </div>
                                                                    </div>
                                                                    -->

                                                                    <div class="formSep">
                                                                        <label>Jornal</label>
                                                                        <input value="<?=$row['jornal']?>" class="span10" type="text" name="jornal" id="jornal" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Orgão</label>
                                                                        <input value="<?=$row['orgao']?>" class="span10" type="text" name="orgao" id="orgao" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Cidade</label>
                                                                        <input value="<?=$row['cidade']?>" class="span10" type="text" name="cidade" id="cidade" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Vara</label>
                                                                        <input value="<?=$row['vara']?>" class="span10" type="text" name="vara" id="vara" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Página</label>
                                                                        <input value="<?=$row['pagina']?>" class="span10" type="text" name="pagina" id="pagina" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Texto</label>
                                                                        <p><?=$row['texto']?></p>
                                                                        <!--<textarea name="texto" id="texto" class="span12" style="height:150px;"><?=$row['texto']?></textarea>-->
                                                                    </div>

                                                                    <!--
                                                                    <div class="formSep">
                                                                        <label>Nome da Ação</label>
                                                                        <input value="<?=$row['nome_acao']?>" class="span10" type="text" name="nome_acao" id="nome_acao" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>NB</label>
                                                                        <input value="<?=$row['nb']?>" class="span3" type="text" name="nb" id="nb" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>NBA</label>
                                                                        <input value="<?=$row['nba']?>" class="span3" type="text" name="nba" id="nba" />
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Data de entrada</label>
                                                                            <div class="input-append date" id="data_inicio" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_inicio'])==""||trim($row['data_inicio'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_inicio'],"d/m/Y"); } ?>">
                                                                                <input class="span8" size="16" name="data_inicio" value="<? if(trim($row['data_inicio'])==""||trim($row['data_inicio'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_inicio'],"d/m/Y"); } ?>" type="text" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <? if(trim($row['criador'])==$sysusu['id']) { } else { ?><input name="data_criacao" value="<? if(trim($row['data_inicio'])==""||trim($row['data_inicio'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($row['data_inicio'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" /><? } ?>
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="<? if(trim($row['hora_inicio'])=="") { } else { echo $row['hora_inicio']; } ?>" class="input-small" name="hora_inicio" id="hora_inicio" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o processo deverá ser iniciado</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Data de término</label>
                                                                            <div class="input-append date" id="data_fim" data-date-format="dd/mm/yyyy" data-date="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>">
                                                                                <input class="span8" size="16" name="data_fim" value="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>" type="text" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <? if(trim($row['criador'])==$sysusu['id']) { } else { ?><input name="data_fim" value="<? if(trim($row['data_fim'])==""||trim($row['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($row['data_fim'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" /><? } ?>
                                                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div style="float:left;margin-right:10px;">
                                                                            <label>Hora</label>
                                                                            <div class="input-append bootstrap-timepicker">
                                                                                <input type="text" value="<? if(trim($row['hora_fim'])=="") { } else { echo $row['hora_fim']; } ?>" class="input-small" name="hora_fim" id="hora_fim" <? if(trim($row['criador'])==$sysusu['id']) { } else { ?>disabled="disabled"<? } ?> >
                                                                                <span class="add-on">
                                                                                    <i class="icon-time"></i>
                                                                                </span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                        </div>
                                                                        <span class="help-block" style="width:100%;float:left;">Data e Hora que o processo foi concluído</span>
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <label>Descritivo</label>
                                                                        <textarea name="texto" id="texto" class="span12" style="height:150px;"><?=$row['texto']?></textarea>
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label>Mostrar na Agenda ?</label>
                                                                        <input type="checkbox" name="mostrar_agenda" id="mostrar_agenda" <? if(trim($row['mostrar_agenda'])==1) { echo " checked"; } ?> class="mostrar_agenda {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                    </div>
        
                                                                    <div class="formSep">
                                                                        <label>Mostrar no Dashboard ?</label>
                                                                        <input type="checkbox" name="mostrar_dashboard" id="mostrar_dashboard" <? if(trim($row['mostrar_dashboard'])==1) { echo " checked"; } ?> class="mostrar_dashboard {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                    </div>

                                                                    <div class="formSep">
                                                                        <label class="req">Ativo ?</label>
                                                                        <label class="radio" style="color:#C00;">
                                                                            <input type="radio" name="stat" id="stat1" value="0" <? if($row['stat']==0) { echo "checked"; } ?> >
                                                                            não
                                                                        </label>
                                                                        <label class="radio" style="color:#390;">
                                                                            <input type="radio" name="stat" id="stat2" value="1" <? if($row['stat']==1) { echo "checked"; } ?> >
                                                                            sim
                                                                        </label>
                                                                    </div>	
                                                                    -->
                                                                    
                                                                </form>
        
                                                            </div>

                                                            
                                                            <div id="tb3_movimentacoes" class="tab-pane <? if(trim($_REQUEST['var5'])=="movimentacoes") { ?>active<? } ?>" style="min-height:350px;">
                                                                <table id="dt_basic_movimentacoes" class="table table-striped table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Situação</th>
                                                                        <th style="width:150px;">Responsável</th>
                                                                        <th style="width:130px;">Data da criação</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?
                                                                    $qSqlMov = mysql_query("
																							SELECT 
																								mod_adv_intimacao_caminho_acoes.pendente,
																								mod_adv_intimacao_caminho_acoes.data,
																								mod_adv_intimacao_caminho_acoes.tipo,
																								mod_adv_intimacao_caminho_acoes.acao,

																								mod_adv_intimacao_agenda.nome AS agenda_nome,
																								
																								mod_sysusu.nome
																								 
																							FROM 
																								adv_intimacao_caminho_acoes AS mod_adv_intimacao_caminho_acoes
																							LEFT JOIN
																								sysusu AS mod_sysusu ON (mod_sysusu.id=mod_adv_intimacao_caminho_acoes.idsysusu)
																							LEFT JOIN
																								adv_intimacao_agenda AS mod_adv_intimacao_agenda ON (mod_adv_intimacao_agenda.numeroUnico=mod_adv_intimacao_caminho_acoes.numeroUnico_agenda)
																							WHERE 
																								mod_adv_intimacao_caminho_acoes.numeroUnico_intimacao='".$row['numeroUnico']."' 
																							ORDER BY 
																								mod_adv_intimacao_caminho_acoes.data DESC
																							");
                                                                    while($rSqlMov = mysql_fetch_array($qSqlMov)) {
																		if(trim($rSqlMov['tipo'])=="tarefa") {
																			if(trim($rSqlMov['acao'])=="add") {
																				$situacao_set = "Adicionou tarefa <b>".$rSqlMov['agenda_nome']."</b>";
																			} else if(trim($rSqlMov['acao'])=="editar") {
																				$situacao_set = "Editou tarefa <b>".$rSqlMov['agenda_nome']."</b>";
																			} else if(trim($rSqlMov['acao'])=="concluiu") {
																				$situacao_set = "Marcou como 'Concluída' a tarefa <b>".$rSqlMov['agenda_nome']."</b>";
																			} else if(trim($rSqlMov['acao'])=="nao_concluiu") {
																				$situacao_set = "Marcou como 'Não concluída' a tarefa <b>".$rSqlMov['agenda_nome']."</b>";
																			} else if(trim($rSqlMov['acao'])=="analise_mh") {
																				$situacao_set = "Marcou como 'Em Análise MH' a tarefa <b>".$rSqlMov['agenda_nome']."</b>";
																			}
																		} else {
																			if(trim($rSqlMov['pendente'])==0) {
																				$situacao_set = "<div style=\"background-color:#C00;border:1px solid #C00;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">AINDA PENDENTE</div>";
																			} elseif(trim($rSqlMov['pendente'])==1) {
																				$situacao_set = "<div style=\"background-color:#F90;border:1px solid #F90;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">EM ANÁLISE STEPHANY - JF</div>";
																			} elseif(trim($rSqlMov['pendente'])==2) {
																				$situacao_set = "<div style=\"background-color:#063;border:1px solid #063;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">ANALISADA</div>";
																			} elseif(trim($rSqlMov['pendente'])==3) {
																				$situacao_set = "<div style=\"background-color:#39d11f;border:1px solid #39d11f;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">EM ANÁLISE STEPHANY</div>";
																			} elseif(trim($rSqlMov['pendente'])==4) {
																				$situacao_set = "<div style=\"background-color:#830202;border:1px solid #830202;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">EM ANÁLISE LUIZ</div>";
																			} elseif(trim($rSqlMov['pendente'])==5) {
																				$situacao_set = "<div style=\"background-color:#5BD9A4;border:1px solid #5BD9A4;width:120px;cursor:default;color:#FFF;padding:0px 10px;font-size:11px;text-align:center;\">EM ANÁLISE ALEXSANDRA</div>";
																			}
																		}
                                                                    ?>
                                                                    <tr>
                                                                        <td style="vertical-align:middle;"><?=$situacao_set?></td>
                                                                        <td style="vertical-align:middle;"><?=$rSqlMov['nome']?></td>
                                                                        <td style="vertical-align:middle;"><? if(trim($rSqlMov['data'])=="0000-00-00") { } else { ajustaData($rSqlMov['data'],"d/m/Y"); } ?></td>
                                                                    </tr>
                                                                    <? } ?>
                                                                </tbody>
                                                                </table>
                                                            </div>

                                                            <div id="tb3_b" class="tab-pane <? if(trim($_REQUEST['var5'])=="tarefas") { ?>active<? } ?>" style="min-height:350px;">

                                                                <form name="forms_agenda" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/<?=$_REQUEST['var3']?>/<?=$_REQUEST['var4']?>/<?=$_REQUEST['var5']?>/" target="_self" ENCTYPE="multipart/form-data">

                                                                    <? if(trim($_REQUEST['var7'])=="") { ?>
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" value="add-tarefas" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
        
                                                                    <input type="hidden" name="numeroUnico_pai" value="<?=$numeroUnicoGerado?>">
                                                                    <? 
                                                                    $numeroUnicoGerado_tarefa = geraCodReturn(); 
                                                                    ?>
                                                                    <input type="hidden" name="numeroUnico" value="<?=$numeroUnicoGerado_tarefa?>">
                                                                    
                                                                    <input type="hidden" name="criador" value="<?=$sysusu['id']?>">
                                                                    <input type="hidden" name="concluido" value="0">
                                                                    <? } else { ?>
                                                                    <? $tarefa = mysql_fetch_array(mysql_query("SELECT * FROM adv_intimacao_agenda WHERE id='".$_REQUEST['var7']."'")); ?>
                                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                                    <input type="hidden" name="acaoForm" value="editar-tarefas" />
                                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                                    <input type="hidden" name="iditem" value="<?=$_REQUEST['var7']?>" />
        
                                                                    <input type="hidden" name="numeroUnico_pai" value="<?=$numeroUnicoGerado?>">
                                                                    <? $numeroUnicoGerado_tarefa = $tarefa['numeroUnico']; ?>
                                                                    <input type="hidden" name="numeroUnico" value="<?=$numeroUnicoGerado_tarefa?>">
                                                                    <? } ?>
                                                                    
                                                                    <div class="formSep">
                                                                        <!--
                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label>Somente para o criador?</label>
                                                                                <input type="checkbox" name="somente_criador" <? if(trim($tarefa['somente_criador'])==1) { echo " checked"; } ?> id="somente_criador" class="somente_criador {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Se esta opção estiver setada, somente o criador da tarefa vai conseguir visualizá-la</span>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label>Edição aberta para todos?</label>
                                                                                <input type="checkbox" name="edicao_aberta" <? if(trim($tarefa['edicao_aberta'])==1) { echo " checked"; } ?> id="edicao_aberta" class="edicao_aberta {labelOn: 'SIM', labelOff: 'NÃO'}" />
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Se esta opção estiver setada, todos poderão editar os itens da tarefa</span>
                                                                        </div>
                                                                        -->
            
                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;padding-bottom:10px;">
                                                                                <label class="req">Título</label>
                                                                                <input value="<?=$tarefa['nome']?>" style="width:400px;" type="text" name="nome" id="nome_item_editar" placeholder="Digite um título para a tarefa" />
                                                                            </div>
                                                                        </div>

<div style="float:left;width:100%;">
    <div style="float:left;margin-right:10px;padding-bottom:10px;width:550px;">
        <label>Responsável</label>

        <?php
        // Normaliza e valida a lista salva (formato esperado: |1|2|3|)
        $lista_admin_raw = (string)$tarefa['lista_admin'];
        $lista_admin_raw = str_replace("||", "|", $lista_admin_raw);
        $lista_admin_raw = trim($lista_admin_raw);

        $lista_admin_ok = array();
        if($lista_admin_raw != "") {
            $tmp = explode("|", $lista_admin_raw);
            foreach($tmp as $v) {
                $v = trim($v);
                if($v !== "" && ctype_digit($v)) {
                    $lista_admin_ok[$v] = true;
                }
            }
        }
        ?>

        <select id="lista_admin_itens" multiple="multiple">
            <?php
            $qSqlItem = mysql_query("SELECT * FROM sysusu WHERE stat='1' AND idsysusu_categoria='7' ORDER BY nome");
            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                $id_user = (string)$rSqlItem['id'];
            ?>
                <option value="<?=$rSqlItem['id']?>" <?php if(isset($lista_admin_ok[$id_user])) { echo "selected"; } ?>>
                    <?=$rSqlItem['nome']?>
                </option>
            <?php } ?>
        </select>

        <input value="<?=$tarefa['lista_admin']?>" style="width:350px;" type="hidden" name="lista_admin" id="lista_admin" />
    </div>
    <span class="help-block" style="width:100%;float:left;">Selecione os responsáveis por esta tarefa</span>
</div>            

                                                                        <div style="float:left;width:100%;">
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Prazo</label>
                                                                                <div class="input-append date" id="data_fim" data-date-format="dd/mm/yyyy" data-date="<? if(trim($tarefa['data_fim'])==""||trim($tarefa['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($tarefa['data_fim'],"d/m/Y"); } ?>">
                                                                                    <input class="span8" size="16" name="data_fim" value="<? if(trim($tarefa['data_fim'])==""||trim($tarefa['data_fim'])=="0000-00-00") { } else { ajustaDataSemHora($tarefa['data_fim'],"d/m/Y"); } ?>" type="text" >
                                                                                    <input name="data_criacao" value="<? if(trim($tarefa['data_fim'])==""||trim($tarefa['data_fim'])=="0000-00-00") { echo date("d/m/Y"); } else { ajustaDataSemHora($tarefa['data_fim'],"d/m/Y"); } ?>" type="hidden" disabled="disabled" />
                                                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                                                </div>
                                                                            </div>
                                                                            <div style="float:left;margin-right:10px;">
                                                                                <label>Hora</label>
                                                                                <div class="input-append bootstrap-timepicker">
                                                                                    <input type="text" value="<? if(trim($tarefa['hora_fim'])=="") { } else { echo $tarefa['hora_fim']; } ?>" class="input-small" name="hora_fim" id="hora_fim" >
                                                                                    <span class="add-on">
                                                                                        <i class="icon-time"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <span class="help-block" style="width:100%;float:left;margin-top:-1px;"></span>
                                                                            </div>
                                                                            <span class="help-block" style="width:100%;float:left;">Data e Hora que o processo deverá ser iniciado</span>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <label>Anexar 1</label>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <div class="fileupload-new thumbnail">
                                                                                <? if(trim($tarefa['arquivo_1'])=="") { ?>
                                                                                <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                                <? } else { ?>
                                                                                <a href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$tarefa['numeroUnico']?>/<?=$tarefa['arquivo_1']?>" target="_blank"><?=$tarefa['arquivo_1']?></a>
                                                                                <? } ?>
                                                                                </div>
                                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                                <? if(trim($tarefa['arquivo_1'])=="") { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span class="fileupload-new">Selecionar arquivo</span>
                                                                                    <span class="fileupload-exists">Alterar</span>
                                                                                    <input name="arquivo_1" type="file">
                                                                                </span>
                                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                                <? } else { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span>Alterar</span>
                                                                                    <input name="arquivo_1" type="file">
                                                                                </span>
                                                                                <a href="javascript:void(0);" onclick="remover_imagem('<?=$tarefa['id']?>','<?=$mod?>_agenda','arquivo_1');" class="btn btn-small" data-dismiss="fileupload">Remover</a>

                                                                                <? } ?>
                                                                            </div>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <label>Anexar 2</label>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <div class="fileupload-new thumbnail">
                                                                                <? if(trim($tarefa['arquivo_2'])=="") { ?>
                                                                                <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                                <? } else { ?>
                                                                                <a href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$tarefa['numeroUnico']?>/<?=$tarefa['arquivo_2']?>" target="_blank"><?=$tarefa['arquivo_2']?></a>
                                                                                <? } ?>
                                                                                </div>
                                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                                <? if(trim($tarefa['arquivo_2'])=="") { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span class="fileupload-new">Selecionar arquivo</span>
                                                                                    <span class="fileupload-exists">Alterar</span>
                                                                                    <input name="arquivo_2" type="file">
                                                                                </span>
                                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                                <? } else { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span>Alterar</span>
                                                                                    <input name="arquivo_2" type="file">
                                                                                </span>
                                                                                <a href="javascript:void(0);" onclick="remover_imagem('<?=$tarefa['id']?>','<?=$mod?>_agenda','arquivo_2');" class="btn btn-small" data-dismiss="fileupload">Remover</a>

                                                                                <? } ?>
                                                                            </div>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <label>Anexar 3</label>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <div class="fileupload-new thumbnail">
                                                                                <? if(trim($tarefa['arquivo_3'])=="") { ?>
                                                                                <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                                <? } else { ?>
                                                                                <a href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$tarefa['numeroUnico']?>/<?=$tarefa['arquivo_3']?>" target="_blank"><?=$tarefa['arquivo_3']?></a>
                                                                                <? } ?>
                                                                                </div>
                                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                                <? if(trim($tarefa['arquivo_3'])=="") { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span class="fileupload-new">Selecionar arquivo</span>
                                                                                    <span class="fileupload-exists">Alterar</span>
                                                                                    <input name="arquivo_3" type="file">
                                                                                </span>
                                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                                <? } else { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span>Alterar</span>
                                                                                    <input name="arquivo_3" type="file">
                                                                                </span>
                                                                                <a href="javascript:void(0);" onclick="remover_imagem('<?=$tarefa['id']?>','<?=$mod?>_agenda','arquivo_3');" class="btn btn-small" data-dismiss="fileupload">Remover</a>

                                                                                <? } ?>
                                                                            </div>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <label>Anexar 4</label>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <div class="fileupload-new thumbnail">
                                                                                <? if(trim($tarefa['arquivo_4'])=="") { ?>
                                                                                <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                                <? } else { ?>
                                                                                <a href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$tarefa['numeroUnico']?>/<?=$tarefa['arquivo_4']?>" target="_blank"><?=$tarefa['arquivo_4']?></a>
                                                                                <? } ?>
                                                                                </div>
                                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                                <? if(trim($tarefa['arquivo_4'])=="") { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span class="fileupload-new">Selecionar arquivo</span>
                                                                                    <span class="fileupload-exists">Alterar</span>
                                                                                    <input name="arquivo_4" type="file">
                                                                                </span>
                                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                                <? } else { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span>Alterar</span>
                                                                                    <input name="arquivo_4" type="file">
                                                                                </span>
                                                                                <a href="javascript:void(0);" onclick="remover_imagem('<?=$tarefa['id']?>','<?=$mod?>_agenda','arquivo_4');" class="btn btn-small" data-dismiss="fileupload">Remover</a>

                                                                                <? } ?>
                                                                            </div>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <label>Anexar 5</label>
                                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                <div class="fileupload-new thumbnail">
                                                                                <? if(trim($tarefa['arquivo_5'])=="") { ?>
                                                                                <img src="<?=$link?>template/img/dummy_50x50.gif" alt="" >
                                                                                <? } else { ?>
                                                                                <a href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$tarefa['numeroUnico']?>/<?=$tarefa['arquivo_5']?>" target="_blank"><?=$tarefa['arquivo_5']?></a>
                                                                                <? } ?>
                                                                                </div>
                                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                                                <? if(trim($tarefa['arquivo_5'])=="") { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span class="fileupload-new">Selecionar arquivo</span>
                                                                                    <span class="fileupload-exists">Alterar</span>
                                                                                    <input name="arquivo_5" type="file">
                                                                                </span>
                                                                                <a href="#" class="btn btn-small fileupload-exists" data-dismiss="fileupload">Remover</a>
                                                                                <? } else { ?>
                                                                                <span class="btn btn-small btn-file">
                                                                                    <span>Alterar</span>
                                                                                    <input name="arquivo_5" type="file">
                                                                                </span>
                                                                                <a href="javascript:void(0);" onclick="remover_imagem('<?=$tarefa['id']?>','<?=$mod?>_agenda','arquivo_5');" class="btn btn-small" data-dismiss="fileupload">Remover</a>

                                                                                <? } ?>
                                                                            </div>
                                                                        </div>

                                                                        <div style="float:left;width:100%;">
                                                                            <label class="req">Descrição</label>
                                                                            <textarea name="descricao" id="descricao_item_editar" class="span12" style="height:150px;"><?=$tarefa['descricao']?></textarea>
                                                                        </div>
                                                                        <div style="float:left;width:100%;margin-top:10px;">
                                                                            <? if(trim($_REQUEST['var7'])=="") { ?>
                                                                            <button type="button" onclick="salvar_adv_intimacao_agenda('_editar');" style="margin-top:23px;" class="btn btn-danger">Adicionar Tarefa</button>
                                                                            <? } else { ?>
                                                                            <button type="button" onclick="salvar_adv_intimacao_agenda('_editar');" class="btn btn-success">Salvar Alterações</button>
                                                                            <button type="button" onclick="cancela_edita_tarefa_intimacao('<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/<?=$_REQUEST['var3']?>/<?=$_REQUEST['var4']?>/<?=$_REQUEST['var5']?>/');" class="btn btn-warning">Cancelar</button>
                                                                            <? } ?>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div style="float:left;margin-top:10px;width:100%;padding-bottom:10px;border-top:1px dashed #CCCCCC;padding-top:10px;">
                                                                        <div id="lista_syscronograma_itens_editar" style="width:100%;float:left;">
                                                                            <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width:100px">Arquivo</th>
                                                                                    <th>Responsáveis</th>
                                                                                    <th>Título</th>
                                                                                    <th>Descrição</th>
                                                                                    <th style="width:130px;">Prazo</th>
                                                                                    <th style="width:90px;">Ações</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?
                                                                                $qSqlCategoria = mysql_query("SELECT * FROM ".$mod."_agenda WHERE numeroUnico_pai='".$numeroUnicoGerado."' ORDER BY data_fim DESC, hora_fim DESC");
                                                                                while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                                ?>
                                                                                <tr>
                                                                                    <td style="width:60px">
                                                                                        <? if(trim($rSqlCategoria['arquivo_1'])=="") {  } else { ?>
                                                                                        <?
                                                                                        $extensao = $rSqlCategoria['arquivo_1'];
                                                                                        $extensao = substr($extensao, -4);
                                                                                        if($extensao[0] == '.'){
                                                                                            $extensao = substr($extensao, -3);
                                                                                        }
                                                                                        $extensao = strtolower($extensao);
                                                                                        ?>
                                                                                        <? if(trim($extensao)=="jpg"||trim($extensao)=="jpeg"||trim($extensao)=="gif"||trim($extensao)=="bmp"||trim($extensao)=="png") { ?>
                                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_1']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_1']?>" alt="<?=$rSqlCategoria['nome']?>"/></a>
                                                                                        <? } else { ?>
                                                                                        <a class="btn-mini ptip_se" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_1']?>"><img src="<?=$link?>template/img/icones_novos/16/download.png" /> Anexo 1</a>
                                                                                        <? } ?>
                                                                                        <? } ?>
                                                                                        <br />

                                                                                        <? if(trim($rSqlCategoria['arquivo_2'])=="") {  } else { ?>
                                                                                        <?
                                                                                        $extensao = $rSqlCategoria['arquivo_2'];
                                                                                        $extensao = substr($extensao, -4);
                                                                                        if($extensao[0] == '.'){
                                                                                            $extensao = substr($extensao, -3);
                                                                                        }
                                                                                        $extensao = strtolower($extensao);
                                                                                        ?>
                                                                                        <? if(trim($extensao)=="jpg"||trim($extensao)=="jpeg"||trim($extensao)=="gif"||trim($extensao)=="bmp"||trim($extensao)=="png") { ?>
                                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_2']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_2']?>" alt="<?=$rSqlCategoria['nome']?>"/></a>
                                                                                        <? } else { ?>
                                                                                        <a class="btn-mini ptip_se" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_2']?>"><img src="<?=$link?>template/img/icones_novos/16/download.png" /> Anexo 2</a>
                                                                                        <? } ?>
                                                                                        <? } ?>
                                                                                        <br />

                                                                                        <? if(trim($rSqlCategoria['arquivo_3'])=="") {  } else { ?>
                                                                                        <?
                                                                                        $extensao = $rSqlCategoria['arquivo_3'];
                                                                                        $extensao = substr($extensao, -4);
                                                                                        if($extensao[0] == '.'){
                                                                                            $extensao = substr($extensao, -3);
                                                                                        }
                                                                                        $extensao = strtolower($extensao);
                                                                                        ?>
                                                                                        <? if(trim($extensao)=="jpg"||trim($extensao)=="jpeg"||trim($extensao)=="gif"||trim($extensao)=="bmp"||trim($extensao)=="png") { ?>
                                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_3']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_3']?>" alt="<?=$rSqlCategoria['nome']?>"/></a>
                                                                                        <? } else { ?>
                                                                                        <a class="btn-mini ptip_se" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_3']?>"><img src="<?=$link?>template/img/icones_novos/16/download.png" /> Anexo 3</a>
                                                                                        <? } ?>
                                                                                        <? } ?>
                                                                                        <br />

                                                                                        <? if(trim($rSqlCategoria['arquivo_4'])=="") {  } else { ?>
                                                                                        <?
                                                                                        $extensao = $rSqlCategoria['arquivo_4'];
                                                                                        $extensao = substr($extensao, -4);
                                                                                        if($extensao[0] == '.'){
                                                                                            $extensao = substr($extensao, -3);
                                                                                        }
                                                                                        $extensao = strtolower($extensao);
                                                                                        ?>
                                                                                        <? if(trim($extensao)=="jpg"||trim($extensao)=="jpeg"||trim($extensao)=="gif"||trim($extensao)=="bmp"||trim($extensao)=="png") { ?>
                                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_4']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_4']?>" alt="<?=$rSqlCategoria['nome']?>"/></a>
                                                                                        <? } else { ?>
                                                                                        <a class="btn-mini ptip_se" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_4']?>"><img src="<?=$link?>template/img/icones_novos/16/download.png" /> Anexo 4</a>
                                                                                        <? } ?>
                                                                                        <? } ?>
                                                                                        <br />

                                                                                        <? if(trim($rSqlCategoria['arquivo_5'])=="") {  } else { ?>
                                                                                        <?
                                                                                        $extensao = $rSqlCategoria['arquivo_5'];
                                                                                        $extensao = substr($extensao, -4);
                                                                                        if($extensao[0] == '.'){
                                                                                            $extensao = substr($extensao, -3);
                                                                                        }
                                                                                        $extensao = strtolower($extensao);
                                                                                        ?>
                                                                                        <? if(trim($extensao)=="jpg"||trim($extensao)=="jpeg"||trim($extensao)=="gif"||trim($extensao)=="bmp"||trim($extensao)=="png") { ?>
                                                                                        <a class="img_action_zoom thumbnail" href="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_item/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_5']?>"><img style="width:50px" src="<?=$link?>files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_5']?>" alt="<?=$rSqlCategoria['nome']?>"/></a>
                                                                                        <? } else { ?>
                                                                                        <a class="btn-mini ptip_se" href="<?=$link?>include/lib/forca-download.php?arquivo=../../files/<?=$linguagem_set?><?=$mod?>_agenda/<?=$rSqlCategoria['numeroUnico']?>/<?=$rSqlCategoria['arquivo_5']?>"><img src="<?=$link?>template/img/icones_novos/16/download.png" /> Anexo 5</a>
                                                                                        <? } ?>
                                                                                        <? } ?>
                                                                                    </td> 
                                                                                    <td style="vertical-align:middle;">
                                                                                    <?
                                                                                    $listaCategoria = $rSqlCategoria['lista_admin'];
                                                                                    $listaCategoria = str_replace("||","','",$listaCategoria);
                                                                                    $listaCategoria = str_replace("|","'",$listaCategoria);
                                                                                    if(trim($listaCategoria)=="") { } else {
                                                                                        $printCategoria = "";
                                                                                        $qSqlCat = mysql_query("SELECT * FROM sysusu WHERE id IN(".$listaCategoria.") ORDER BY nome");
                                                                                        while($rSqlCat = mysql_fetch_array($qSqlCat)) {
                                                                                            if(trim($printCategoria)=="") {
                                                                                                if(trim($rSqlCategoria['edicao_aberta'])=="0"||trim($rSqlCategoria['edicao_aberta'])=="") {
																									if(trim($rSqlCategoria['criador'])==$sysusu['id']) {
																										$printCategoria = "<a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome']."";
																									} else {
																										$printCategoria = "- ".$rSqlCat['nome']."";
																									}
																								} else {
																									$printCategoria = "<a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome']."";
																								}
                                                                                            } else {
                                                                                                if(trim($rSqlCategoria['edicao_aberta'])=="0"||trim($rSqlCategoria['edicao_aberta'])=="") {
																									if(trim($rSqlCategoria['criador'])==$sysusu['id']) {
																										$printCategoria = $printCategoria."<br><a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome'];
																									} else {
																										$printCategoria = $printCategoria."<br>- ".$rSqlCat['nome'];
																									}
																								} else {
																									$printCategoria = $printCategoria."<br><a href=\"javascript:void(0);\" onclick=\"remover_admin_intimacao('".$rSqlCat['id']."','".$rSqlCategoria['id']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>- ".$rSqlCat['nome'];
																								}
                                                                                            }
                                                                                        }
                                                                                        echo $printCategoria;
                                                                                    }
                                                                                    ?>
                                                                                    </td>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                                    <td style="vertical-align:middle;"><?=$rSqlCategoria['descricao']?></td>
                                                                                    <td style="vertical-align:middle;"><? if(trim($rSqlCategoria['data_fim'])=="0000-00-00") { } else { ajustaData($rSqlCategoria['data_fim'],"d-m-Y"); } ?><?=substr($rSqlCategoria['hora_fim'],0,5)?></td>
                                                                                    <td style="vertical-align:middle;" class="nolink">
                                                                                        <div class="btn-group">
																							<a href="javascript:void(0);" onclick="window.open('<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/<?=$_REQUEST['var3']?>/<?=$_REQUEST['var4']?>/tarefas/<?=$rSqlCategoria['id']?>/','_self','');" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>template/img/icones_novos/16/editar.png" /></a>
																							
                                                                                        	<a href="javascript:void(0);" onClick="remover_tarefa_intimacao('<?=$rSqlCategoria['id']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <? } ?>
                                                                            </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
        
                                                                </form>
        
                                                            </div>


                                                        </div>
                                                    </div>

                                                    <div class="formSep">
                                                        <? if(trim($sysperm['editar_'.$mod.''])==1) { ?>
                                                        <button type="button" onclick="salvar_adv_intimacao('2');" class="btn btn-success">Salvar Como Analisada</button>
                                                        <button type="button" onclick="salvar_adv_intimacao('4');" class="btn_clean" style="background-color:#C40404;">Em Análise Luiz</button>
                                                        <button type="button" onclick="salvar_adv_intimacao('1');" class="btn btn-warning">Em Análise Stephany</button>
                                                        <!--
                                                        <button type="button" onclick="salvar_adv_intimacao('3');" class="btn_clean" style="background-color:#39D11F;">Em análise Stephany</button>
                                                        <button type="button" onclick="salvar_adv_intimacao('5');" class="btn_clean" style="background-color:#5BD9A4;">Em análise Alexsandra</button>
                                                        -->
                                                        <? } ?>
                                                    </div>

                                                </div>
                                                <? } ?>
                                                
                                                <div id="tb1_lista" class="tab-pane <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="tipo") { ?>active<? } ?>">
                                                    <div class="w-box w-box">
                                                        <div class="w-box-header">
                                                            <div class="pull-left">
                                                                <div class="toggle-group">
                                                                    <span data-toggle="dropdown" class="dropdown-toggle">Ações <span class="caret"></span></span>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('excluir');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>template/img/icones_novos/16/remover-x.png" />&nbsp;Remover</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('publicar');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>template/img/icones_novos/16/stat-1.png" />&nbsp;Publicar</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('despublicar');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>template/img/icones_novos/16/stat-0.png" />&nbsp;Despublicar</a></li>
                                                                        <li>-------------------------</li>
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('abrir');">Abrir Selecionados em Cascata</a></li>
                                                                        <li>-------------------------</li>
                                                                        <li><a href="javascript:void(0);" onclick="salvar_adv_intimacao_lista('0');"><div style="background-color:#C00;width:20px;float:left;height:20px;margin-left:-12px;"></div> &nbsp;AINDA PENDENTE</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="salvar_adv_intimacao_lista('1');"><div style="background-color:#F90;width:20px;float:left;height:20px;margin-left:-12px;"></div> &nbsp;EM ANÁLISE STEPHANY - JF</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="salvar_adv_intimacao_lista('2');"><div style="background-color:#063;width:20px;float:left;height:20px;margin-left:-12px;"></div> &nbsp;ANALISADA</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="salvar_adv_intimacao_lista('3');"><div style="background-color:#39d11f;width:20px;float:left;height:20px;margin-left:-12px;"></div> &nbsp;EM ANÁLISE STEPHANY</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="salvar_adv_intimacao_lista('4');"><div style="background-color:#830202;width:20px;float:left;height:20px;margin-left:-12px;"></div> &nbsp;EM ANÁLISE LUIZ</a></li>
                                                                        <!--<li><a href="javascript:void(0);" onclick="salvar_adv_intimacao_lista('5');"><div style="background-color:#5BD9A4;width:20px;float:left;height:20px;margin-left:-12px;"></div> &nbsp;EM ANÁLISE ALEXSANDRA</a></li>-->
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="w-box-content">
                                                            <form name="list" id="lista_form" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <input type="hidden" id="pendente_novo" name="pendente_novo" value="<?=$mod?>" />
                                                            <input type="hidden" id="lista_checkboxes" value="" />

                                                            <table id="example" cellspacing="0" width="100%" class="table table-striped table-condensed">
                                                        
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:20px;" class="table_checkbox"><input type="checkbox" name="select_msgs" class="select_msgs ptip_se" title="Selecionar todos" data-tableid="dt_basic" /></th>
                                                                        <th style="width:130px;"></th>
                                                                        <th>Código</th>
                                                                        <th>Número</th>
                                                                        <th>Data</th>
                                                                        <th style="width:120px;">Ações</th>
                                                                    </tr>
                                                                </thead>
                                                         
                                                            </table>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
			function salvar_adv_intimacao_lista(pendenteSend) {
				$("#pendente_novo").val(""+pendenteSend+"");
				$("#acaoForm_lista").val("muda_status_intimacao");
				$("#lista_form").submit();
			}
			function seleciona_linha_intimacao(idSend) {
				var checked = $("#check-"+idSend+"").is(":checked");

				if(checked===true) {
					$("#lista_checkboxes").val("|"+$("#check-"+idSend+"").val()+"|"+$("#lista_checkboxes").val()+"");
				} else {
					var val = $("#lista_checkboxes").val();
					$("#lista_checkboxes").val(val.replace("|"+$("#check-"+idSend+"").val()+"|",""));
				}
			}
            </script>
