<?
	use PHPMailer\PHPMailer\PHPMailer;
	
	$mod = "".$linguagem_set."".$_POST['modulo']."";

	if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar") {
		

		/*
		$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
		$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
		
		if(trim($_POST['mostrar_agenda'])=="") { $_POST['mostrar_agenda']=0; } else { $_POST['mostrar_agenda']=1; }
		if(trim($_POST['mostrar_dashboard'])=="") { $_POST['mostrar_dashboard']=0; } else { $_POST['mostrar_dashboard']=1; }
		*/
		
		/*
		$criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_POST['criador']."'"));
		$_POST['criador_txt'] = $criador_processo['nome'];

		$parceiro_adv_processo_tipo = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$_POST['idparceiro_adv_processo_tipo']."'"));
		$_POST['idparceiro_adv_processo_tipo_txt'] = $parceiro_adv_processo_tipo['nome'];

		$parceiro_adv_processo_tipo_de_acao = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo_de_acao WHERE id='".$_POST['idparceiro_adv_processo_tipo_de_acao']."'"));
		$_POST['idparceiro_adv_processo_tipo_de_acao_txt'] = $parceiro_adv_processo_tipo_de_acao['nome'];
		*/

		$itemN = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
		if(trim($_POST['acaoForm'])=="add-continuar"&&$itemN>0) {

			$_POST['dataModificacao'] = $data;

			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			$idEditavel = $item['id'];

			$_POST['cpf'] = preg_replace("/[^0-9]/", "",$_POST['cpf']);
			$_POST['cpf_limpo'] = preg_replace("/[^0-9]/", "",$_POST['cpf']);

			$_POST['nome_limpo'] = transformaNome($_POST['nome']);

			$criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_POST['criador']."'"));
			$_POST['criador_txt'] = $criador_processo['nome'];
			$criador = "".$criador_processo['id'].""; 
			$criador_txt = "".$criador_processo['nome'].""; 
	
			if(trim($_POST['idparceiro_adv_processo_tipo'])=="0"||trim($_POST['idparceiro_adv_processo_tipo'])=="") {
				$_POST['idparceiro_adv_processo_tipo_txt'] = "Sem Situação";
				$idparceiro_adv_processo_tipo = "0";
				$idparceiro_adv_processo_tipo_txt = "Sem Situação";
			} else {
				$parceiro_adv_processo_tipo = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$_POST['idparceiro_adv_processo_tipo']."'"));
				$_POST['idparceiro_adv_processo_tipo_txt'] = $parceiro_adv_processo_tipo['nome'];
				$idparceiro_adv_processo_tipo = "".$parceiro_adv_processo_tipo['id']."";
				$idparceiro_adv_processo_tipo_txt = "".$parceiro_adv_processo_tipo['nome']."";
			}
	
			if(trim($_POST['idparceiro_adv_processo_tipo_de_acao'])=="0"||trim($_POST['idparceiro_adv_processo_tipo_de_acao'])=="") {
				$_POST['idparceiro_adv_processo_tipo_de_acao_txt'] = "Sem ação";
				$idparceiro_adv_processo_tipo_de_acao = "0";
				$idparceiro_adv_processo_tipo_de_acao_txt = "Sem ação";
			} else {
				$parceiro_adv_processo_tipo_de_acao = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo_de_acao WHERE id='".$_POST['idparceiro_adv_processo_tipo_de_acao']."'"));
				$_POST['idparceiro_adv_processo_tipo_de_acao_txt'] = $parceiro_adv_processo_tipo_de_acao['nome'];
				$idparceiro_adv_processo_tipo_de_acao = "".$parceiro_adv_processo_tipo_de_acao['id']."";
				$idparceiro_adv_processo_tipo_de_acao_txt = "".$parceiro_adv_processo_tipo_de_acao['nome']."";
			}
	
			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Salvou e Continou Editando";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi editado o item <b>".$itemAntes['cliente_nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

			foreach ($_POST as $cmp => $value) {
				if($cmp=="criador") { } else {
					$_POST[''.$cmp.''] = str_replace("\"","&quot;",$_POST[''.$cmp.'']);
					$_POST[''.$cmp.''] = str_replace("'","&apos;",$_POST[''.$cmp.'']);
				}
			}

			update($_POST,$mod."",$idEditavel);

			$sysusu_criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$sysusu['id']."'"));
			$sysusu_criador = "".$sysusu_criador_processo['id'].""; 
			$sysusu_criador_txt = "".$sysusu_criador_processo['nome'].""; 
			$insert = mysql_query("INSERT INTO parceiro_adv_processo_log (
																	 idparceiro_adv_processo,
																	 criador,
																	 criador_txt,
																	 idparceiro_adv_processo_tipo_de_acao,
																	 idparceiro_adv_processo_tipo_de_acao_txt,
																	 idparceiro_adv_processo_tipo,
																	 idparceiro_adv_processo_tipo_txt,
																	 data
																	 ) 
																	 VALUES 
																	(
																	 '".$idEditavel."',
																	 '".$sysusu_criador."',
																	 '".$sysusu_criador_txt."',
																	 '".$idparceiro_adv_processo_tipo_de_acao."',
																	 '".$idparceiro_adv_processo_tipo_de_acao_txt."',
																	 '".$idparceiro_adv_processo_tipo."',
																	 '".$idparceiro_adv_processo_tipo_txt."',
																	 '".$data."'
																	 )");

		} else {

			$_POST['cpf'] = preg_replace("/[^0-9]/", "",$_POST['cpf']);
			$_POST['cpf_limpo'] = preg_replace("/[^0-9]/", "",$_POST['cpf']);

			$_POST['nome_limpo'] = transformaNome($_POST['nome']);

			$criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_POST['criador']."'"));
			$_POST['criador_txt'] = $criador_processo['nome'];
			$criador = "".$criador_processo['id'].""; 
			$criador_txt = "".$criador_processo['nome'].""; 
	
			if(trim($_POST['idparceiro_adv_processo_tipo'])=="0"||trim($_POST['idparceiro_adv_processo_tipo'])=="") {
				$_POST['idparceiro_adv_processo_tipo_txt'] = "Sem Situação";
				$idparceiro_adv_processo_tipo = "0";
				$idparceiro_adv_processo_tipo_txt = "Sem Situação";
			} else {
				$parceiro_adv_processo_tipo = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$_POST['idparceiro_adv_processo_tipo']."'"));
				$_POST['idparceiro_adv_processo_tipo_txt'] = $parceiro_adv_processo_tipo['nome'];
				$idparceiro_adv_processo_tipo = "".$parceiro_adv_processo_tipo['id']."";
				$idparceiro_adv_processo_tipo_txt = "".$parceiro_adv_processo_tipo['nome']."";
			}
	
			if(trim($_POST['idparceiro_adv_processo_tipo_de_acao'])=="0"||trim($_POST['idparceiro_adv_processo_tipo_de_acao'])=="") {
				$_POST['idparceiro_adv_processo_tipo_de_acao_txt'] = "Sem ação";
				$idparceiro_adv_processo_tipo_de_acao = "0";
				$idparceiro_adv_processo_tipo_de_acao_txt = "Sem ação";
			} else {
				$parceiro_adv_processo_tipo_de_acao = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo_de_acao WHERE id='".$_POST['idparceiro_adv_processo_tipo_de_acao']."'"));
				$_POST['idparceiro_adv_processo_tipo_de_acao_txt'] = $parceiro_adv_processo_tipo_de_acao['nome'];
				$idparceiro_adv_processo_tipo_de_acao = "".$parceiro_adv_processo_tipo_de_acao['id']."";
				$idparceiro_adv_processo_tipo_de_acao_txt = "".$parceiro_adv_processo_tipo_de_acao['nome']."";
			}

			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;
		
			# Gravação do Log
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Adicionar";
			$logLocal = "".$caminho1."";
			$logDescricao = "Foi adicionado o item <b>".$_POST['cliente_nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));

			foreach ($_POST as $cmp => $value) {
				if($cmp=="criador") { } else {
					$_POST[''.$cmp.''] = str_replace("\"","&quot;",$_POST[''.$cmp.'']);
					$_POST[''.$cmp.''] = str_replace("'","&apos;",$_POST[''.$cmp.'']);
				}
			}

			insert($_POST,$mod."");

			$sysusu_criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$sysusu['id']."'"));
			$sysusu_criador = "".$sysusu_criador_processo['id'].""; 
			$sysusu_criador_txt = "".$sysusu_criador_processo['nome'].""; 
			$insert = mysql_query("INSERT INTO parceiro_adv_processo_log (
																	 idparceiro_adv_processo,
																	 criador,
																	 criador_txt,
																	 idparceiro_adv_processo_tipo_de_acao,
																	 idparceiro_adv_processo_tipo_de_acao_txt,
																	 idparceiro_adv_processo_tipo,
																	 idparceiro_adv_processo_tipo_txt,
																	 data
																	 ) 
																	 VALUES 
																	(
																	 '".$item['id']."',
																	 '".$sysusu_criador."',
																	 '".$sysusu_criador_txt."',
																	 '".$idparceiro_adv_processo_tipo_de_acao."',
																	 '".$idparceiro_adv_processo_tipo_de_acao_txt."',
																	 '".$idparceiro_adv_processo_tipo."',
																	 '".$idparceiro_adv_processo_tipo_txt."',
																	 '".$data."'
																	 )");
		}

	} else {
		if(trim($_POST['acaoForm'])=="add-tarefas") {
	

			$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
	
			#upload_arquivo("parceiro_adv_processo_agenda","imagem","");
	
			# Gravação do Log
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Adicionar";
			$logLocal = "Tarefa do cliente";
			$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
			$logData = $data;
			gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
			$_POST['data'] = $data;
			$_POST['dataModificacao'] = $data;
	
			insert($_POST,"parceiro_adv_processo_agenda");
		} else {
			if(trim($_POST['acaoForm'])=="editar") {
				$_POST['dataModificacao'] = $data;
	
				$idEditavel = $_POST['iditem'];
				$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
	

				/*
				$_POST['data_criacao'] = normalTOdate($_POST['data_criacao']);
				$_POST['data_inicio'] = normalTOdate($_POST['data_inicio']);
				$_POST['data_fim'] = normalTOdate($_POST['data_fim']);
				
				if(trim($_POST['mostrar_agenda'])=="") { $_POST['mostrar_agenda']=0; } else { $_POST['mostrar_agenda']=1; }
				if(trim($_POST['mostrar_dashboard'])=="") { $_POST['mostrar_dashboard']=0; } else { $_POST['mostrar_dashboard']=1; }
				*/
	
				$_POST['cpf'] = preg_replace("/[^0-9]/", "",$_POST['cpf']);
				$_POST['cpf_limpo'] = preg_replace("/[^0-9]/", "",$_POST['cpf']);
	
				$criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_POST['criador']."'"));
				$_POST['criador_txt'] = $criador_processo['nome'];
				$criador = "".$criador_processo['id'].""; 
				$criador_txt = "".$criador_processo['nome'].""; 
		
				if(trim($_POST['idparceiro_adv_processo_tipo'])=="0"||trim($_POST['idparceiro_adv_processo_tipo'])=="") {
					$_POST['idparceiro_adv_processo_tipo_txt'] = "Sem Situação";
					$idparceiro_adv_processo_tipo = "0";
					$idparceiro_adv_processo_tipo_txt = "Sem Situação";
				} else {
					$parceiro_adv_processo_tipo = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$_POST['idparceiro_adv_processo_tipo']."'"));
					$_POST['idparceiro_adv_processo_tipo_txt'] = $parceiro_adv_processo_tipo['nome'];
					$idparceiro_adv_processo_tipo = "".$parceiro_adv_processo_tipo['id']."";
					$idparceiro_adv_processo_tipo_txt = "".$parceiro_adv_processo_tipo['nome']."";
				}
		
				if(trim($_POST['idparceiro_adv_processo_tipo_de_acao'])=="0"||trim($_POST['idparceiro_adv_processo_tipo_de_acao'])=="") {
					$_POST['idparceiro_adv_processo_tipo_de_acao_txt'] = "Sem ação";
					$idparceiro_adv_processo_tipo_de_acao = "0";
					$idparceiro_adv_processo_tipo_de_acao_txt = "Sem ação";
				} else {
					$parceiro_adv_processo_tipo_de_acao = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo_de_acao WHERE id='".$_POST['idparceiro_adv_processo_tipo_de_acao']."'"));
					$_POST['idparceiro_adv_processo_tipo_de_acao_txt'] = $parceiro_adv_processo_tipo_de_acao['nome'];
					$idparceiro_adv_processo_tipo_de_acao = "".$parceiro_adv_processo_tipo_de_acao['id']."";
					$idparceiro_adv_processo_tipo_de_acao_txt = "".$parceiro_adv_processo_tipo_de_acao['nome']."";
				}
		

				/*echo"<script>alert('[".$_POST['idparceiro_adv_processo_tipo']."]')</script>";
				echo"<script>alert('[".$_POST['idparceiro_adv_processo_tipo_txt']."]')</script>";*/
		
				# Gravação do Log
				$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
				$logPerfil = "administrador";
				$logId = $sysusu['id'];
				$logAcao = "Editou";
				$logLocal = "".$caminho1."";
				$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
				$logData = $data;
				gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
				foreach ($_POST as $cmp => $value) {
					if($cmp=="criador") { } else {
						$_POST[''.$cmp.''] = str_replace("\"","&quot;",$_POST[''.$cmp.'']);
						$_POST[''.$cmp.''] = str_replace("'","&apos;",$_POST[''.$cmp.'']);
					}
				}

				$dataVar = $item['dataModificacao'];
			
				$dia  = substr($dataVar,8,2);
				$mes  = substr($dataVar,5,2);
				$ano  = substr($dataVar,0,4);
				$hora = substr($dataVar,11,19);
			
				$arrayData = mktime(0,0,0,$mes,$dia,$ano);
				$dataCorreta = date("d/m/Y", $arrayData);

				$observasoesSet  = "";
				$observasoesSet .= "<table>";
				$observasoesSet .= "<thead>";
				$observasoesSet .= "	<tr>";
				$observasoesSet .= "		<th>Descrição</th>";
				$observasoesSet .= "		<th style=\"width:130px;\">Data da criação</th>";
				$observasoesSet .= "		<th style=\"width:150px;\">Criador</th>";
				$observasoesSet .= "	</tr>";
				$observasoesSet .= "</thead>";
				$observasoesSet .= "<tbody>";
				$qSqlCategoria = mysql_query("SELECT * FROM ".$mod."_agenda WHERE numeroUnico_pai='".$numeroUnicoGerado."' ORDER BY data_fim DESC, hora_fim DESC");
				while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
					$criador_observacao = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSqlCategoria['criador']."'"));
					if(trim($rSqlCategoria['data'])=="0000-00-00") { $dataSet = ""; } else { $dataSet = ajustaData($rSqlCategoria['data'],"d/m/Y"); }
					$observasoesSet .= "	<tr>";
					$observasoesSet .= "		<td style=\"vertical-align:middle;\">".$rSqlCategoria['descricao']."</td>";
					$observasoesSet .= "		<td style=\"vertical-align:middle;\">".$dataSet."</td>";
					$observasoesSet .= "		<td style=\"vertical-align:middle;\">".$criador_observacao['nome']."</td>";
					$observasoesSet .= "	</tr>";
				}
				$observasoesSet .= "</tbody>";
				$observasoesSet .= "</table>";

				$numeroUnicoGet = $item['numeroUnico'];
				$idGet = $idEditavel;
				$descricaoGet  = "";
				$descricaoGet .= "Última Movimentação: ".$dataCorreta." ".$hora." <br>";
				#$descricaoGet .= "Número do Processo: ".$item['cod']." <br>";
				$descricaoGet .= "Número do Processo: ".$item['id']." <br>";
				$descricaoGet .= "CPF: ".$item['cpf']." <br>";
				$descricaoGet .= "Nome: ".$item['nome']." <br>";
				#$descricaoGet .= "Situação: ".$idparceiro_adv_processo_tipo_txt." <br>";
				$descricaoGet .= "Ação: ".$idparceiro_adv_processo_tipo_de_acao_txt." <br>";
				$descricaoGet .= "Observações <br>";
				$descricaoGet .= "".$observasoesSet."";
				
				#$AssuntoSet = "PROCESSO ID: ".$idGet."";
				#$AssuntoSet = "".$idGet." ".$item['nome']." ".$item['cpf']." ".$idparceiro_adv_processo_tipo_de_acao_txt." ".$idparceiro_adv_processo_tipo_txt."";
				$AssuntoSet = "".$idGet." ".$item['nome']." ".$item['cpf']." ".$idparceiro_adv_processo_tipo_de_acao_txt."";
				
				update($_POST,$mod."",$idEditavel);

				if(trim($_POST['idparceiro_adv_processo_tipo'])=="31") {
					//Import the PHPMailer class into the global namespace
					require("".$_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
					
					//Create a new PHPMailer instance
					$mail = new PHPMailer;
					// Set PHPMailer to use the sendmail transport
					$mail->isSendmail();
					
					//Set who the message is to be sent from
					$mail->setFrom('server@bpadvocacia.com.br', 'BP Advocacia');
					//Set an alternative reply-to address
					$mail->addReplyTo('server@bpadvocacia.com.br', 'BP Advocacia');
					//Set who the message is to be sent to
					$mail->addAddress('riw4f44nb5+8f6qa+dyt44@in.meistertask.com', 'MH Cálculos');     // Add a recipient
					#$mail->addAddress('teste@mhcalculos.com.br', 'MH Teste');     // Add a recipient
					#$mail->addAddress('alexsander.lauffer@gmail.com', 'TAGX');     // Add a recipient
					#$mail->addAddress('atendimento@tagx.com.br', 'TAGX');     // Add a recipient
					#$mail->addAddress('eduardo@tagx.com.br', 'Eduardo');     // Add a recipient

					//Set the CharSet
					$mail->CharSet = 'utf-8';

					//Set the subject line
					$mail->Subject = ''.$AssuntoSet.'';
					$mail->Body    = ''.$descricaoGet.'';
					
					//Read an HTML message body from an external file, convert referenced images to embedded,
					//convert HTML into a basic plain-text alternative body
					#$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
					//Replace the plain text body with one created manually
					
					#$mail->AltBody = 'This is a plain-text message body';
					//Attach an image file
					
					$qSqlFile = mysql_query("SELECT * FROM parceiro_adv_processo_galeria WHERE numeroUnico='".$numeroUnicoGet."' ORDER BY ordem");
					while($rSqlFile = mysql_fetch_array($qSqlFile)) {
						$mail->addAttachment(''.$_SERVER['DOCUMENT_ROOT'].'/admin/files/parceiro_adv_processo/'.$rSqlFile['numeroUnico'].'/'.$rSqlFile['imagem'].'');         // Add attachments
					}
					//send the message, check for errors
					if (!$mail->send()) {
						echo "Mailer Error: " . $mail->ErrorInfo;
					} else {
						echo "Message sent!";
					}
				}

				$sysusu_criador_processo = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$sysusu['id']."'"));
				$sysusu_criador = "".$sysusu_criador_processo['id'].""; 
				$sysusu_criador_txt = "".$sysusu_criador_processo['nome'].""; 
				$insert = mysql_query("INSERT INTO parceiro_adv_processo_log (
																		 idparceiro_adv_processo,
																		 criador,
																		 criador_txt,
																		 idparceiro_adv_processo_tipo_de_acao,
																		 idparceiro_adv_processo_tipo_de_acao_txt,
																		 idparceiro_adv_processo_tipo,
																		 idparceiro_adv_processo_tipo_txt,
																		 data
																		 ) 
																		 VALUES 
																		(
																		 '".$idEditavel."',
																		 '".$sysusu_criador."',
																		 '".$sysusu_criador_txt."',
																		 '".$idparceiro_adv_processo_tipo_de_acao."',
																		 '".$idparceiro_adv_processo_tipo_de_acao_txt."',
																		 '".$idparceiro_adv_processo_tipo."',
																		 '".$idparceiro_adv_processo_tipo_txt."',
																		 '".$data."'
																		 )");
	
			} else {
				if(trim($_POST['acaoForm'])=="excluir") {
					foreach ($_POST['msg_sel'] as $idcheck) {

						# Gravação do Log
						$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idcheck."'"));
						$logPerfil = "administrador";
						$logId = $sysusu['id'];
						$logAcao = "Excluiu";
						$logLocal = "".$caminho1."";
						$logDescricao = "Foi excluído o item <b>".$itemAntes['nome']."</b>";
						$logData = $data;
						gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

						#$sql = mysql_query("DELETE FROM ".$mod." WHERE id='".$idcheck."'");
					}
				} else {
					if(trim($_POST['acaoForm'])=="mudar_acao_para_selecionadas") {
						foreach ($_POST['msg_sel'] as $idcheck) {

							if(trim($_POST['parceiro_adv_processo_tipo_selecionada'])=="0") {
								$_POST['idparceiro_adv_processo_tipo_txt'] = "Sem Situação";
								$_POST['idparceiro_adv_processo_tipo'] = "0";
							} else {
								$parceiro_adv_processo_tipo = mysql_fetch_array(mysql_query("SELECT * FROM parceiro_adv_processo_tipo WHERE id='".$_POST['parceiro_adv_processo_tipo_selecionada']."'"));
								$_POST['idparceiro_adv_processo_tipo_txt'] = $parceiro_adv_processo_tipo['nome'];
								$_POST['idparceiro_adv_processo_tipo'] = $parceiro_adv_processo_tipo['id'];
							}

							$update = mysql_query("UPDATE parceiro_adv_processo SET 
							idparceiro_adv_processo_tipo_txt='".$_POST['idparceiro_adv_processo_tipo_txt']."',
							idparceiro_adv_processo_tipo='".$_POST['idparceiro_adv_processo_tipo']."' WHERE id='".$idcheck."'");
	
						}
					} else {
						if(trim($_POST['acaoForm'])=="publicar") {
							foreach ($_POST['msg_sel'] as $idcheck) {
								$sql = mysql_query("UPDATE ".$mod." SET stat='1' WHERE id='".$idcheck."'");
							}
						} else {
							if(trim($_POST['acaoForm'])=="despublicar") {
								foreach ($_POST['msg_sel'] as $idcheck) {
									$sql = mysql_query("UPDATE ".$mod." SET stat='0' WHERE id='".$idcheck."'");
								}
							} else {
							}
						}
					}
				}
			}
		}
	}

	if(trim($_POST['acaoForm'])=="add-tarefas") {
		$itemPai = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico_pai']."'"));
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$itemPai['id']."/observacoes/','_self','')</script>";
	} else {
		if(trim($_POST['acaoForm'])=="add-continuar") {
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$item['id']."/','_self','')</script>";
		} else {
			echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
		}
	}

?>