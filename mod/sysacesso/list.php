        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
                        	<? include("./acoes/sysgeral/menu-sistema.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li class="active"><a data-toggle="tab" href="#tb1_a">Lista de Itens</a></li><? } ?>
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
                                                                email: { required: true },
                                                                senha: { required: true },
                                                                stat: { required: true },
                                                            },
                                                            invalidHandler: function(form, validator) {
                                                                // callback
                                                            }
                                                        })
                                                    }
                                                }
                                            };
                                            
                                            
                                            //* datatables
                                            beoro_datatables = {
                                                //* column reorder & toggle visibility
                                                basic: function() {
                                                    if($('#dt_basic').length) {
                                                        $('#dt_basic').dataTable({
                                                            "sPaginationType": "bootstrap_full",
															"aoColumns": [
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
															]
                                                        });
                                                    }
                                                }
                                            };
                                            </script>
                                            <div class="tab-content">
                                                <div id="tb1_a" class="tab-pane active">
                                                    <div class="w-box w-box">
                                                        <div class="w-box-header">
                                                        </div>
                                                        <div class="w-box-content">
                                                            <table id="dt_basic" class="table table-striped table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th>::Nome do Usuário</th>
                                                                    <th>E-mail do Usuário</th>
                                                                    <th style="width:130px;">Data do Acesso</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
																<?
                                                                if(trim($_REQUEST['var3'])=="")    {
                                                                    $qSql = mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$sysusu['id']."'");
                                                                } else {
                                                                    $qSql = mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$_REQUEST['var3']."'");
                                                                }
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                ?>
                                                                <tr>
                                                                    <? $rSqlSysusu = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['idsysusu']."'")); ?>
                                                                    <td><?=$rSqlSysusu['nome']?></td>
                                                                    <td><?=$rSqlSysusu['email']?></td>
                                                                    <td><? ajustaData($rSql['data'],"d/m/Y"); ?></td>
                                                                </tr>
                                                                <? } ?>
                                                            </tbody>
                                                            </table>
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

