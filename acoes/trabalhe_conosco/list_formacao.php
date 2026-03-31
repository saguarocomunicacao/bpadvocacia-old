                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:150px;">Tipo de Curso</th>
                                                                            <th>Nome do Curso</th>
                                                                            <th style="width:120px;">Status do Curso</th>
                                                                            <th>Tempo de Formação</th>
                                                                            <th>Tempo de Experiência</th>
                                                                            <th style="width:70px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
																		if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; }
                                                                        $qSqlFormacao = mysql_query("SELECT * FROM ".$modGet."_formacao WHERE numeroUnico_curriculo='".$numeroUnicoGerado."' ORDER BY dataModificacao DESC");
                                                                        while($rSqlFormacao = mysql_fetch_array($qSqlFormacao)) {
                                                                        ?>
                                                                        
																		<script>
                                                                        $(function(){
                                                                             
                                                                            $('#tipo_de_curso-<?=$rSqlFormacao['id']?>').editable({
																				prepend: "<?=$rSqlFormacao['tipo_de_curso']?>",
																				source: [
																					{value: 'Técnico', text: 'Técnico'},
																					{value: 'Graduação', text: 'Graduação'},
																					{value: 'Pós Graduação', text: 'Pós Graduação'},
																					{value: 'Extra-curricular', text: 'Extra-curricular'},
																					{value: 'Outro', text: 'Outro'}
																				],
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela('tipo_de_curso','<?=$rSqlFormacao['id']?>','<?=$modGet?>_formacao',value);
                                                                                   }
                                                                                }
                                                                            });

                                                                            $('#nome-<?=$rSqlFormacao['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela('nome','<?=$rSqlFormacao['id']?>','<?=$modGet?>_formacao',value);
                                                                                   }
                                                                                }
                                                                            });
                                                                            
                                                                            $('#status_de_curso-<?=$rSqlFormacao['id']?>').editable({
																				prepend: "<?=$rSqlFormacao['status_do_curso']?>",
																				source: [
																					{value: 'Completo', text: 'Completo'},
																					{value: 'Em andamento', text: 'Em andamento'},
																					{value: 'Interrompido', text: 'Interrompido'},
																				],
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela('status_de_curso','<?=$rSqlFormacao['id']?>','<?=$modGet?>_formacao',value);
                                                                                   }
                                                                                }
                                                                            });

                                                                            $('#tempo_de_formacao-<?=$rSqlFormacao['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela('tempo_de_formacao','<?=$rSqlFormacao['id']?>','<?=$modGet?>_formacao',value);
                                                                                   }
                                                                                }
                                                                            });

                                                                            $('#tempo_de_experiencia-<?=$rSqlFormacao['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela('tempo_de_experiencia','<?=$rSqlFormacao['id']?>','<?=$modGet?>_formacao',value);
                                                                                   }
                                                                                }
                                                                            });
                                                                        });
                                                                        </script>
                                                                        <tr>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Tipo de Curso" data-placeholder="Escolha um Tipo de Curso" data-placement="right" data-pk="1" data-type="select" id="tipo_de_curso-<?=$rSqlFormacao['id']?>" href="#"><?=$rSqlFormacao['tipo_de_curso']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSqlFormacao['id']?>" href="#"><?=$rSqlFormacao['nome']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Status" data-placeholder="Escolha um Status" data-placement="right" data-pk="1" data-type="select" id="status_de_curso-<?=$rSqlFormacao['id']?>" href="#"><?=$rSqlFormacao['status_de_curso']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Tempo de Formação" data-placeholder="Digite um Tempo de Formação" data-placement="right" data-pk="1" data-type="text" id="tempo_de_formacao-<?=$rSqlFormacao['id']?>" href="#"><?=$rSqlFormacao['tempo_de_formacao']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Tempo de Experiência" data-placeholder="Digite um Tempo de Experiência" data-placement="right" data-pk="1" data-type="text" id="tempo_de_experiencia-<?=$rSqlFormacao['id']?>" href="#"><?=$rSqlFormacao['tempo_de_experiencia']?></a></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_trabalhe_conosco('<?=$numeroUnicoGerado?>','<?=$rSqlFormacao['id']?>','<?=$modGet?>','formacao');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
