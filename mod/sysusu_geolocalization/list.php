        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
							<? include("./acoes/sysgeral/menu.php"); ?>
                            <div id="info_mapa"></div>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($sysperm['inserir_'.$mod.''])==1||trim($sysperm['editar_'.$mod.''])==1||trim($sysperm['excluir_'.$mod.''])==1) { ?><li id="aba_lista" <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tb1_lista">Compromissos</a></li><? } ?><? } ?>
                                            </ul>
											<script>
											<? $sysusu_set_mapa = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$sysusu['id']."'")); ?>
											var eu = new google.maps.LatLng(<?= $sysusu_set_mapa['lat'] ?>, <?= $sysusu_set_mapa['lng'] ?>);
											
											var markers = [];
											var iterator = 0;
											
											var map;
											
											function initialize() {
											  var mapOptions = {
												zoom: 12,
												center: eu
											  };
											
											  map = new google.maps.Map(document.getElementById('gmap_markers'),
													  mapOptions);
											}

											var goldStar = {
											  path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
											  fillColor: "yellow",
											  fillOpacity: 0.8,
											  scale: 0,
											  strokeColor: "gold",
											  strokeWeight: 14
											};
											var symbolOne = {
											  path: 'M -2,0 0,-2 2,0 0,2 z',
											  strokeColor: '#F00',
											  fillColor: '#F00',
											  fillOpacity: 1
											};
											
											var symbolTwo = {
											  path: 'M -2,-2 2,2 M 2,-2 -2,2',
											  strokeColor: '#292',
											  strokeWeight: 4
											};
											
											var symbolThree = {
											  path: 'M -1,0 A 1,1 0 0 0 -3,0 1,1 0 0 0 -1,0M 1,0 A 1,1 0 0 0 3,0 1,1 0 0 0 1,0M -3,3 Q 0,5 3,3',
											  strokeColor: '#00F',
											  rotation: 0
											};
											var circleSymbol = {
												path: google.maps.SymbolPath.CIRCLE,
												scale: 8,
												strokeColor: '#393'
											};
											var arrowSymbol = {
												path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
												scale: 8,
												strokeColor: '#393'
											};

											function startMarker() {
												markers.push(new google.maps.Marker({
													position: new google.maps.LatLng(<?= $sysusu_set_mapa['lat'] ?>, <?= $sysusu_set_mapa['lng'] ?>),
													title: "<?= $sysusu['nome'] ?>",
													icon: new google.maps.MarkerImage(
														"http://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=bb|<?= $sysusu['nome'] ?>|2a8d03|FFFFFF",
														null, 
														null, 
														new google.maps.Point(0, 42)),
													map: map,
													draggable: false
												}));
											
												<?
												$qSqlMap = mysql_query("SELECT * FROM ".$mod." WHERE idsysusu NOT IN ('".$sysusu['id']."') ORDER BY idsysusu");
												while($rSqlMap = mysql_fetch_array($qSqlMap)) {
													$sysusu_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSqlMap['idsysusu']."'"));
													$tempo = tempoOff($rSqlMap['idsysusu']);
												?>
												markers.push(new google.maps.Marker({
													position: new google.maps.LatLng(<?= $rSqlMap['lat'] ?>, <?= $rSqlMap['lng'] ?>),
													title: "<?= $sysusu_set['nome'] ?>",
													icon: new google.maps.MarkerImage(
														"http://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=bb|<?= $sysusu_set['nome'] ?>|044b7c|FFFFFF",
														null, 
														null, 
														new google.maps.Point(0, 42)),
													map: map,
													infoWindow: {
														content: '<div class="infoWindow_content"><p><?= $sysusu_set['nome'] ?></p>E-mail: <?= $sysusu_set['email'] ?></div>'
													},
													click: function(e){
														if(console.log) console.log(e);
														//alert('Você clicou no item');
													},
													mouseover: function(e){
														if(console.log) console.log(e);
													},
													draggable: false
												}));
												<? } ?>
											}


											google.maps.event.addDomListener(window, 'load', initialize);
											
											//startMarker();
										
											
											//* gmaps
											/*
											beoro_gmaps = {
												m_markers: function() {
													if($('#gmap_markers').length) {
														<? $sysusu_set_mapa = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE idsysusu='".$sysusu['id']."'")); ?>
														map_markers = new GMaps({
															el: '#gmap_markers',
															scrollwheel: true,
															maptype: 'TERRAIN',
															zoom : 12,
															center: new google.maps.LatLng(<?= $sysusu_set_mapa['lat'] ?>, <?= $sysusu_set_mapa['lng'] ?>),
															lat: <?= $sysusu_set_mapa['lat'] ?>,
															lng: <?= $sysusu_set_mapa['lng'] ?>
														});
														map_markers.addMarker({
															lat: <?= $sysusu_set_mapa['lat'] ?>,
															lng: <?= $sysusu_set_mapa['lng'] ?>,
															title: '<?= $sysusu['nome'] ?>',
															icon: new google.maps.MarkerImage(
																"http://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=bb|<?= $sysusu['apelido'] ?>|2a8d03|FFFFFF",
																null, 
																null, 
																new google.maps.Point(0, 42)),
															//icon: circleSymbol,
															<? if(trim($sysusu['imagem'])=="") { } else { ?>
															//icon: '<?=$link?>files/sysusu/<?=$sysusu['numeroUnico']?>/<?=$sysusu['imagem']?>',
															<? } ?>
															details: {
																// You can attach additional information, which will be passed to Event object (e) in the events previously defined.
															},
															infoWindow: {
																content: '<div class="infoWindow_content"><p><?= $sysusu['nome'] ?></p>E-mail: <?= $sysusu['email'] ?></div>'
															},
															click: function(e){
																if(console.log) console.log(e);
																//alert('Você clicou no item');
															},
															mouseover: function(e){
																if(console.log) console.log(e);
															}
														});
														<?
														$qSqlMap = mysql_query("SELECT * FROM ".$mod." WHERE idsysusu NOT IN ('".$sysusu['id']."') ORDER BY idsysusu");
														while($rSqlMap = mysql_fetch_array($qSqlMap)) {
															$sysusu_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSqlMap['idsysusu']."'"));
															$tempo = tempoOff($rSqlMap['idsysusu']);
															if($tempo>1800) { } else {
														?>
														map_markers.addMarker({
															lat: <?= $rSqlMap['lat'] ?>,
															lng: <?= $rSqlMap['lng'] ?>,
															title: '<?= $sysusu_set['nome'] ?>',
															icon: new google.maps.MarkerImage(
																"http://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=bb|<?= $sysusu_set['apelido'] ?>|044b7c|FFFFFF",
																null, 
																null, 
																new google.maps.Point(0, 42)),
															details: {
																// You can attach additional information, which will be passed to Event object (e) in the events previously defined.
															},
															infoWindow: {
																content: '<div class="infoWindow_content"><p><?= $sysusu_set['nome'] ?></p>E-mail: <?= $sysusu_set['email'] ?></div>'
															},
															click: function(e){
																if(console.log) console.log(e);
																//alert('Você clicou no item');
															},
															mouseover: function(e){
																if(console.log) console.log(e);
															}
														});
														<? } } ?>
													}
												},
											};
											*/
                                            </script>

                                            <div class="tab-content">
                                                
                                                
                                                <? if(trim($_REQUEST['var3'])=="") { ?>
                                                <div id="tb1_lista" class="tab-pane <? if(trim($_REQUEST['var3'])=="") { ?>active<? } ?>">

                                                    <div class="span12">
                                                        <div class="w-box w-box">
                                                            <div class="w-box-header"></div>
                                                            <div class="w-box-content">

                                                                <div id="gmap_markers" class="gmap" style="height:600px;"></div>

                                                            </div>
                                                        </div>
                                                    </div>

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

