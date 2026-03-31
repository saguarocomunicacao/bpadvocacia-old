							<?
                            $rSqlTipos = mysql_fetch_array(mysql_query("SELECT * FROM sysmod WHERE idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."' AND bd='parceiro_adv_processo' AND stat='1' LIMIT 1"));
                            $nomeLimpoTipos = transformaCaractere($rSqlTipos['nome']);
                            ?>

                            <ul id="pageNav" style="margin-top:20px;">
                                <li <? if($_REQUEST['var4']==0&&$_REQUEST['var3']=="tipo") { ?> class="current"<? } ?>><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$nomeLimpoTipos?>/acao/0/"><div style="background-color:#000;width:20px;float:left;height:20px;"></div> &nbsp;Sem Ação</a></li>
								<?
                                $qSqlItem = mysql_query("SELECT * FROM parceiro_adv_processo_tipo_de_acao WHERE stat='1' ORDER BY ordem");
                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
									 $nPermTipo = mysql_num_rows(mysql_query("SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idparceiro_adv_processo_tipo_de_acao='".$rSqlItem['id']."'"));

									 if($nPermTipo==0) {
										 $auth = "1";
									 } else {
										 $rSqlPermTipo = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_parceiro WHERE idsysusu='".$sysusu['id']."' AND idparceiro_adv_processo_tipo_de_acao='".$rSqlItem['id']."'"));
										 $auth = "".$rSqlPermTipo['auth']."";
									 }
									 
									 if(trim($rSqlItem['cor'])=="") { $cor_set = "#000"; } else { $cor_set = "".$rSqlItem['cor'].""; }

									if($auth=="1") {
                                ?>
                                <li <? if($rSqlItem['id']==$_REQUEST['var4']&&$_REQUEST['var3']=="acao") { ?> class="current"<? } ?>><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$nomeLimpoTipos?>/acao/<?=$rSqlItem['id']?>/"><div style="background-color:<?=$cor_set?>;width:20px;float:left;height:20px;"></div>  &nbsp;<?=corrigirAcentuacao($rSqlItem['nome'])?></a></li>
                                <? } } ?>
                            
                            </ul>
