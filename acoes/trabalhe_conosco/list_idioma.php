                                                                    <table id="dt_basic_idioma" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Idioma</th>
                                                                            <th style="width:200px;">Escrita</th>
                                                                            <th style="width:200px;">Leitura</th>
                                                                            <th style="width:200px;">Conversação</th>
                                                                            <th style="width:70px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
																		if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; }
                                                                        $qSqlFormacao = mysql_query("SELECT * FROM ".$modGet."_idioma WHERE numeroUnico_curriculo='".$numeroUnicoGerado."' ORDER BY dataModificacao DESC");
                                                                        while($rSqlFormacao = mysql_fetch_array($qSqlFormacao)) {
                                                                        ?>
                                                                        
																		<script>
                                                                        $(function(){
                                                                             

                                                                            $('#nome-<?=$rSqlFormacao['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax('lista_idioma','_idioma','nome','<?=$rSqlFormacao['id']?>','<?=$modGet?>_idioma',value);
                                                                                   }
                                                                                }
                                                                            });
                                                                            
                                                                            $('#nivel_escrita-<?=$rSqlFormacao['id']?>').editable({
																				prepend: "<?=$rSqlFormacao['nivel']?>",
																				source: [
																					{value: 'Básico', text: 'Básico'},
																					{value: 'Intermediário', text: 'Intermediário'},
																					{value: 'Avançado', text: 'Avançado'},
																					{value: 'Fluente', text: 'Fluente'},
																				],
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax('lista_idioma','_idioma','nivel_escrita','<?=$rSqlFormacao['id']?>','<?=$modGet?>_idioma',value);
                                                                                   }
                                                                                }
                                                                            });

                                                                            $('#nivel_leitura-<?=$rSqlFormacao['id']?>').editable({
																				prepend: "<?=$rSqlFormacao['nivel']?>",
																				source: [
																					{value: 'Básico', text: 'Básico'},
																					{value: 'Intermediário', text: 'Intermediário'},
																					{value: 'Avançado', text: 'Avançado'},
																					{value: 'Fluente', text: 'Fluente'},
																				],
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax('lista_idioma','_idioma','nivel_leitura','<?=$rSqlFormacao['id']?>','<?=$modGet?>_idioma',value);
                                                                                   }
                                                                                }
                                                                            });

                                                                            $('#nivel_conversacao-<?=$rSqlFormacao['id']?>').editable({
																				prepend: "<?=$rSqlFormacao['nivel']?>",
																				source: [
																					{value: 'Básico', text: 'Básico'},
																					{value: 'Intermediário', text: 'Intermediário'},
																					{value: 'Avançado', text: 'Avançado'},
																					{value: 'Fluente', text: 'Fluente'},
																				],
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax('lista_idioma','_idioma','nivel_conversacao','<?=$rSqlFormacao['id']?>','<?=$modGet?>_idioma',value);
                                                                                   }
                                                                                }
                                                                            });
                                                                        });
                                                                        </script>

                                                                        <tr>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSqlFormacao['id']?>" href="#"><?=$rSqlFormacao['nome']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nível" data-placeholder="Escolha um Nível" data-placement="right" data-pk="1" data-type="select" id="nivel_escrita-<?=$rSqlFormacao['id']?>" href="#"><?=$rSqlFormacao['nivel_escrita']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nível" data-placeholder="Escolha um Nível" data-placement="right" data-pk="1" data-type="select" id="nivel_leitura-<?=$rSqlFormacao['id']?>" href="#"><?=$rSqlFormacao['nivel_leitura']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nível" data-placeholder="Escolha um Nível" data-placement="right" data-pk="1" data-type="select" id="nivel_conversacao-<?=$rSqlFormacao['id']?>" href="#"><?=$rSqlFormacao['nivel_conversacao']?></a></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_trabalhe_conosco('<?=$numeroUnicoGerado?>','<?=$rSqlFormacao['id']?>','<?=$modGet?>','idioma');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
