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
                                                /*
												beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
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
                                            /*
											beoro_datatables = {
                                                //* column reorder & toggle visibility
                                                basic: function() {
                                                    if($('#dt_basic').length) {
														$('#dt_basic').dataTable({
															"iDisplayLength": 50,
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
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
															]
														});

                                                    }

                                                }
                                            };*/

$(document).ready(function() {
	// Setup - add a text input to each footer cell
	$('#example thead th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();
		var tamanho_px = $(this).attr("tamanho");
		if(tamanho_px=="0px") { } else {
			$(this).html( '<input style="width:90% !important;" type="text" placeholder="'+title+'" />' );
		}
	} );

	// DataTable
	var table = $('#example').DataTable({
		"processing": true,
		"serverSide": true,
		"iDisplayLength": 50,
		"ajax": "<?=$link?>acoes/sysgeral/tabela-syslog.php?var1=<?=$_REQUEST['var1']?>&var2=<?=$_REQUEST['var2']?>&var3=<?=$_REQUEST['var3']?>&var4=<?=$_REQUEST['var4']?>&var5=<?=$_REQUEST['var5']?>&sysusuS=<?=$sysusu['id']?>",
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
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "string" },
		]
	});

	// Apply the search
	table.columns().eq( 0 ).each( function ( colIdx ) {
		$( 'input', table.column( colIdx ).header() ).on( 'keypress', function () {
			table
				.column( colIdx )
				.search( this.value )
				.draw();
		} );
	} );
} );
                                            </script>
                                            <div class="tab-content">
                                                <div id="tb1_a" class="tab-pane active">
                                                    <div class="w-box w-box">
                                                        <div class="w-box-header">
                                                        </div>
                                                        <div class="w-box-content">

                                                                <table id="example" cellspacing="0" width="100%" class="table table-striped table-condensed">
                                                            
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Usuário</th>
                                                                            <th>Ação</th>
                                                                            <th>Local</th>
                                                                            <th>Descrição</th>
                                                                            <th style="width:130px;">Data</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>Usuário</th>
                                                                            <th>Ação</th>
                                                                            <th>Local</th>
                                                                            <th>Descrição</th>
                                                                            <th style="width:130px;">Data</th>
                                                                        </tr>
                                                                    </tfoot>
                                                             
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
