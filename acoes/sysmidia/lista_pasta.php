							<? 
							if(trim($sysusu['id'])=="") {
								$idsysusuGet = $idsysusuGet;
							} else {
								$idsysusuGet = $sysusu['id'];
							}
							?>
							<script type="text/javascript">
								$(function(){
									$("#tree").dynatree({ 
										clickFolderMode:1,
										onActivate: function(node) {
											// A DynaTreeNode object is passed to the activation handler
											// Note: we also get this event, if persistence is on, and the page is reloaded.
											$("#idpai").val(node.data.key);
											abre_pasta_ajax(node.data.key,'<?=$idsysusuGet?>');
										},
										children: [ // Pass an array of nodes.
											{title: "Raiz", isFolder: true, key:0, expand: true,
												children: [
													<? echo monta_menu("0",$$idsysusuGet); ?>
												]
											},
											/*
											{title: "Pasta 2", isFolder: true, key:2,
												children: [
													{title: "Pasta 2.1", isFolder: true, key:3,},
													{title: "Pasta 2.2", isFolder: true, key:4,}
												]
											},
											{title: "Pasta 3", isFolder: true, key:5,}
											*/
										],
										checkbox: false 
									});
								});
							</script>

                            <div id="tree">
                                <ul id="treeData" style="display: none;">
                                </ul>
                            </div>
