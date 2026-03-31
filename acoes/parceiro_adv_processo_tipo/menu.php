							<?
                            $rSqlTipos = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."' AND bd='parceiro_adv_processo' AND stat='1' LIMIT 1"));
                            $nomeLimpoTipos = transformaCaractere($rSqlTipos['nome']);
                            ?>

                            <ul id="pageNav" style="margin-top:20px;">
                                <?
								if(trim($sysperm['todos_parceiro_adv_processo'])==1) {
									$nProcesso = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM parceiro_adv_processo WHERE idparceiro_adv_processo_tipo='0'"));
								} else {
									$nProcesso = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM parceiro_adv_processo WHERE criador='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='0'"));
								}
								if(trim($nProcesso[0])=="" || trim($nProcesso[0])=="0") {
									$nProcesso_set = "0";
								} else {
									$nProcesso_set = "".$nProcesso[0]."";
								}
								$bullet_set = "<span class=\"badge badge-important\" style=\"float: right;z-index: 100;margin-right: -10px;margin-top: -25px;\" >".$nProcesso_set."</span>";
								?>
                                <li <? if($_REQUEST['var4']==0&&$_REQUEST['var3']=="tipo") { ?> class="current"<? } ?>><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$nomeLimpoTipos?>/tipo/0/"><div style="background-color:#000;width:20px;float:left;height:20px;"></div> &nbsp;Sem Situação</a><?=$bullet_set?></li>
								<?
                                $qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE stat='1' ORDER BY ordem");
                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
									if(trim($sysperm['todos_parceiro_adv_processo'])==1) {
										$nProcesso = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM parceiro_adv_processo WHERE idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
									} else {

										$nPermTipoVer = mysql_num_rows(mysql_query("SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
										
										#echo "SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='".$rSqlItem['id']."'";
								
										if($nPermTipoVer==0) {
											$nProcesso = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM parceiro_adv_processo WHERE criador='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
										} else {
											$rSqlPermTipoVer = mysql_fetch_array(mysql_query("SELECT ver FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
											if(trim($rSqlPermTipoVer['ver'])=="0") {
												$nProcesso = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM parceiro_adv_processo WHERE idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
											} else {
												$nProcesso = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM parceiro_adv_processo WHERE criador='".$sysusu['id']."' AND idparceiro_adv_processo_tipo='".$rSqlItem['id']."'"));
											}
										}

									}
									if(trim($nProcesso[0])=="" || trim($nProcesso[0])=="0") {
										$nProcesso_set = "0";
									} else {
										$nProcesso_set = "".$nProcesso[0]."";
									}
									
									$bullet_set = "<span class=\"badge badge-important\" style=\"float: right;z-index: 100;margin-right: -10px;margin-top: -25px;\" >".$nProcesso_set."</span>";
                                ?>
                                <li style="font-size:10px;" <? if($rSqlItem['id']==$_REQUEST['var4']&&$_REQUEST['var3']=="tipo") { ?> class="current"<? } ?>>
                                <a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$nomeLimpoTipos?>/tipo/<?=$rSqlItem['id']?>/">
                                <div style="background-color:<?=$rSqlItem['cor']?>;width:20px;float:left;height:20px;"></div>  &nbsp;<?=corrigirAcentuacao($rSqlItem['nome'])?></a><?=$bullet_set?></li>
                                <? } ?>
                            
                            </ul>

