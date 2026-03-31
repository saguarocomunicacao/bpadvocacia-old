<?
#MENSAGEM PARA O USUÁRIO
$msg  = "<html>";
$msg .= "<head>";
$msg .= "<meta http-equiv=Content-Type content=text/html; charset=utf-8 />";
$msg .= "<title>".$sysconfig['nome']."</title>";

$msg .= "<style>";
$msg .= ".CinzaM {";
$msg .= "	color:#717171;";
$msg .= "	font-family:Arial, Helvetica, sans-serif;";
$msg .= "	font-size:12px;";
$msg .= "	font-style:normal;";
$msg .= "	font-weight:normal;";
$msg .= "	text-decoration:none;";
$msg .= "}";
$msg .= ".CinzaG {";
$msg .= "	color:#717171;";
$msg .= "	font-family:Arial, Helvetica, sans-serif;";
$msg .= "	font-size:24px;";
$msg .= "	font-style:normal;";
$msg .= "	font-weight:normal;";
$msg .= "	text-decoration:none;";
$msg .= "}";
$msg .= "</style>";

$msg .= "</head>";

$msg .= "<body>";
$msg .= "<table width='570'>";
$msg .= "    <tr>";
$msg .= "    	<td>";
$msg .= "        	<table width='100%' height='50px'>";
$msg .= "                <tr>";
$msg .= "                	<td><img src='http://www.tagx.com.br/img/topo_email.jpg' border='0'></td>";
$msg .= "                </tr>";
$msg .= "            </table>";
$msg .= "    	</td>";
$msg .= "    </tr>";
$msg .= "    <tr>";
$msg .= "    	<td>";
$msg .= "        	<table width='100%'>";
$msg .= "                <tr>";
$msg .= "                	<td class='CinzaM'><b>Suporte</b></td>";
$msg .= "                </tr>";
$msg .= "            </table>";
$msg .= "    	</td>";
$msg .= "    </tr>";
$msg .= "    <tr>";
$msg .= "    	<td>";
$msg .= "        	<table width='100%'>";
$msg .= "                <tr>";
$msg .= "                	<td class='CinzaM'><b>".$sysusu['nome'].",</b></td>";
$msg .= "                </tr>";
$msg .= "            </table>";
$msg .= "    	</td>";
$msg .= "    </tr>";
$msg .= "    <tr>";
$msg .= "    	<td>";
$msg .= "        	<table width='100%'>";
$msg .= "                <tr>";
$msg .= "                	<td class='CinzaM'>
							sua mensagem foi recebida pela equipe da TAGX!
							Agradecemos seu contato e lhe informamos que em breve retornaremos.
							</td>";
$msg .= "                </tr>";
$msg .= "            </table>";
$msg .= "    	</td>";
$msg .= "    </tr>";
$msg .= "    <tr>";
$msg .= "    	<td>";
$msg .= "        	<table width='100%'>";
$msg .= "                <tr>";
$msg .= "                	<td class='CinzaM'>
							Atenciosamente,<br>
							<b>
							Equipe TAGX Web Studio<br>
							atendimento@tagx.com.br<br>
							</b>
							<br><br>
							Email de disparo automático,<br>
							<b>favor não responder.</b>
							</td>";
$msg .= "                </tr>";
$msg .= "            </table>";
$msg .= "    	</td>";
$msg .= "    </tr>";
$msg .= "    <tr>";
$msg .= "    	<td><br></td>";
$msg .= "    </tr>";
$msg .= "</table>";
$msg .= "</body>";
$msg .= "</html>";

#MENSAGEM PARA O COMERCIAL
$msg2  = "<html>";
$msg2 .= "<head>";
$msg2 .= "<meta http-equiv=Content-Type content=text/html; charset=utf-8 />";
$msg2 .= "<title>".$sysconfig['nome']."</title>";

$msg2 .= "<style>";
$msg2 .= ".CinzaM {";
$msg2 .= "	color:#717171;";
$msg2 .= "	font-family:Arial, Helvetica, sans-serif;";
$msg2 .= "	font-size:12px;";
$msg2 .= "	font-style:normal;";
$msg2 .= "	font-weight:normal;";
$msg2 .= "	text-decoration:none;";
$msg2 .= "}";
$msg2 .= ".CinzaG {";
$msg2 .= "	color:#717171;";
$msg2 .= "	font-family:Arial, Helvetica, sans-serif;";
$msg2 .= "	font-size:24px;";
$msg2 .= "	font-style:normal;";
$msg2 .= "	font-weight:normal;";
$msg2 .= "	text-decoration:none;";
$msg2 .= "}";
$msg2 .= "</style>";

$msg2 .= "</head>";

$msg2 .= "<body>";
$msg2 .= "<table width='570'>";
$msg2 .= "    <tr>";
$msg2 .= "    	<td>";
$msg2 .= "        	<table width='100%' height='50px'>";
$msg2 .= "                <tr>";
$msg2 .= "                	<td><img src='http://www.tagx.com.br/img/topo_email.jpg' border='0'></td>";
$msg2 .= "                </tr>";
$msg2 .= "            </table>";
$msg2 .= "    	</td>";
$msg2 .= "    </tr>";
$msg2 .= "    <tr>";
$msg2 .= "    	<td>";
$msg2 .= "        	<table width='100%'>";
$msg2 .= "                <tr>";
$msg2 .= "                	<td class='CinzaM'><b>Suporte</b></td>";
$msg2 .= "                </tr>";
$msg2 .= "            </table>";
$msg2 .= "    	</td>";
$msg2 .= "    </tr>";
$msg2 .= "    <tr>";
$msg2 .= "    	<td>";
$msg2 .= "        	<table width='100%'>";
$msg2 .= "                <tr>";
$msg2 .= "                	<td class='CinzaM'><b>Atendimento,</b></td>";
$msg2 .= "                </tr>";
$msg2 .= "            </table>";
$msg2 .= "    	</td>";
$msg2 .= "    </tr>";
$msg2 .= "    <tr>";
$msg2 .= "    	<td>";
$msg2 .= "        	<table width='100%'>";
$msg2 .= "                <tr>";
$msg2 .= "                	<td class='CinzaM'>
							um cliente abriu um chamado, o sistema enviou um email para ele informando 
							que um de nossos atendentes entraria em contato e prosseguiria com o atendimento.<br>
							<br><br>
							Veja abaixo os detalhes do chamado.
							<br><br>
							<b>Data da solicitação:</b> ".ajustaData($_POST['data'],"d/m/Y")."<br>
							<b>Nome:</b> ".$sysusu['nome']."<br>
							<b>Assunto:</b> ".$_POST['nome']."<br>
							<b>Detalhes do chamado:</b> ".$_POST['texto']."<br>
							</td>";
$msg2 .= "                </tr>";
$msg2 .= "            </table>";
$msg2 .= "    	</td>";
$msg2 .= "    </tr>";
$msg2 .= "    <tr>";
$msg2 .= "    	<td>";
$msg2 .= "        	<table width='100%'>";
$msg2 .= "                <tr>";
$msg2 .= "                	<td class='CinzaM'>
							<br>
							Email de disparo automático,<br>
							<b>favor não responder.</b>
							</td>";
$msg2 .= "                </tr>";
$msg2 .= "            </table>";
$msg2 .= "    	</td>";
$msg2 .= "    </tr>";
$msg2 .= "    <tr>";
$msg2 .= "    	<td><br></td>";
$msg2 .= "    </tr>";
$msg2 .= "</table>";
$msg2 .= "</body>";
$msg2 .= "</html>";

$html = $msg;

$html2 = $msg2;


$nomeCliente = "".$sysusu['nome']."";
$emailCliente = "".$sysusu['email']."";

$nomeAdmin = "TAGX";
$emailAdmin = "alexsander.lauffer@gmail.com";

$assunto  = "Suporte TAGX";

$headersCliente  = "MIME-Version: 1.1\n";
$headersCliente .= "Content-type: text/html; charset=utf-8\n";
$headersCliente .= "From: " .$nomeAdmin. " <" .$emailAdmin. ">\n";
$headersCliente .= "Return-Path: ".$emailAdmin."\n"; // return-path
$envioCliente = mail($emailCliente, utf8_decode($assunto), $html, $headersCliente);
 
#if($envioCliente) { echo "Mensagem enviada com sucesso"; } else { echo "A mensagem não pode ser enviada"; }

$headersAdmin  = "MIME-Version: 1.1\n";
$headersAdmin .= "Content-type: text/html; charset=utf-8\n";
$headersAdmin .= "From: " .$nomeCliente. " <" .$emailCliente. ">\n";
$headersAdmin .= "Return-Path: ".$emailAdmin."\n"; // return-path
$envioAdmin = mail($emailAdmin, utf8_decode($assunto), $html2, $headersAdmin);
 
#if($envioAdmin) { echo "Mensagem enviada com sucesso"; } else { echo "A mensagem não pode ser enviada"; }
?>
