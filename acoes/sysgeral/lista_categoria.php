																	<? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:150px;">Ordem</th>
                                                                            <th>Nome</th>
                                                                            <th>Slug</th>
                                                                            <th style="width:70px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr id="lista_categoria_<?=$rSqlCategoria['id']?>">
																			<? monta_td_categoria("".$link."","".$modGet."","".$modGet."_categoria","0"); ?>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
