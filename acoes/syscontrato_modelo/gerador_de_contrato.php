<?
include("../../include/inc/data.php");

$idContratoGet = $_GET['idContratoS'];
$idProcessoGet = $_GET['idProcessoS'];
$idUsuarioGet = $_GET['idUsuarioS'];
$idClienteGet = $_GET['idClienteS'];

$data_assinatura_diaGet = $_GET['data_assinatura_diaS'];
$data_assinatura_mesGet = $_GET['data_assinatura_mesS'];
$data_assinatura_anoGet = $_GET['data_assinatura_anoS'];
$data_assinaturaGet = "".$data_assinatura_diaGet." de ".$data_assinatura_mesGet." de ".$data_assinatura_anoGet."";

$rSqlProcesso = mysql_fetch_array(mysql_query("SELECT * FROM adv_processo WHERE id='".$idProcessoGet."'"));

$rSqlContrato = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato_modelo WHERE id='".$idContratoGet."'"));

$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$idUsuarioGet."'"));

$rSqlCliente = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$idClienteGet."'"));

$rSqlClienteEndereco = mysql_fetch_array(mysql_query("SELECT * FROM syscliente_endereco WHERE numeroUnico_pai='".$rSqlCliente['numeroUnico']."' AND principal='1'"));

$rSqlClienteTelefone = mysql_fetch_array(mysql_query("SELECT * FROM syscliente_telefones WHERE numeroUnico_pai='".$rSqlCliente['numeroUnico']."' AND principal='1'"));

$output = $rSqlContrato['texto_1'];

/* DADOS DE USUÁRIO */
$nomeUsuarioUTF = utf8_decode($rSqlUsuario['nome']);
$nomeUsuario = "".$nomeUsuarioUTF."";

$cepUsuario = "".$rSqlUsuario['cep']."";

$ruaUsuarioUTF = utf8_decode($rSqlUsuario['rua']);
$ruaUsuario = "".$ruaUsuarioUTF."";

$numeroUsuario = "".$rSqlUsuario['numero']."";

$complementoUsuarioUTF = utf8_decode($rSqlUsuario['complemento']);
$complementoUsuario = "".$complementoUsuarioUTF."";

$rSqlBairroUsuario = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_bairro WHERE id_bairro='".$rSqlUsuario['bairro']."'"));
$bairroUsuarioUTF = utf8_decode($rSqlBairroUsuario['bairro']);
$bairroUsuario = "".$bairroUsuarioUTF."";

$rSqlCidadeUsuario = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_cidade WHERE id_cidade='".$rSqlUsuario['cidade']."'"));
$cidadeUsuarioUTF = utf8_encode($rSqlCidadeUsuario['cidade']);
$cidadeUsuario = "".$cidadeUsuarioUTF."";

$estadoUsuarioUTF = utf8_decode($rSqlUsuario['estado']);
$estadoUsuario = "".$estadoUsuarioUTF."";

$emailUsuario = "".$rSqlUsuario['email']."";

/* DADOS DE CLIENTE */
$nomeUTF = utf8_decode($rSqlCliente['nome']);
$nome = "".$nomeUTF."";

$cpf = "".$rSqlCliente['cpf']."";

$rg = "".$rSqlCliente['rg']."";

$emissor = "".$rSqlCliente['emissor']."";

$data_nascimento = "".$rSqlCliente['data_nascimento']."";

$profissaoUTF = utf8_decode($rSqlCliente['profissao']);
$profissao = "".$profissaoUTF."";

$nacionalidadeUTF = utf8_decode($rSqlCliente['nacionalidade']);
$nacionalidade = "".$nacionalidadeUTF."";

$estado_civilUTF = utf8_decode($rSqlCliente['estado_civil']);
$estado_civil = "".$estado_civilUTF."";

$cep = "".$rSqlClienteEndereco['cep']."";

$ruaUTF = $rSqlClienteEndereco['rua'];
$rua = "".$ruaUTF."";

$numero = "".$rSqlClienteEndereco['numero']."";

$complementoUTF = utf8_decode($rSqlClienteEndereco['complemento']);
$complemento = "".$complementoUTF."";

$rSqlBairro = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_bairro WHERE id_bairro='".$rSqlClienteEndereco['bairro']."'"));
$bairroUTF = utf8_decode($rSqlBairro['bairro']);
$bairro = "".$bairroUTF."";

$rSqlCidade = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_cidade WHERE id_cidade='".$rSqlClienteEndereco['cidade']."'"));
$cidadeUTF = utf8_encode($rSqlCidade['cidade']);
$cidade = "".$cidadeUTF."";

$estadoUTF = utf8_decode($rSqlClienteEndereco['estado']);
$estado = "".$estadoUTF."";

$telefone = "".$rSqlClienteTelefone['operadora']." (".$rSqlClienteTelefone['ddd'].") ".$rSqlClienteTelefone['telefone']."";

$email = "".$rSqlCliente['email']."";

$proprietario = "";
$pis = "".$rSqlCliente['pis']."";

$dataAtual = date("Y-m-d H:i:s");
$d  = substr($dataAtual,8,2);
$m  = substr($dataAtual,5,2);
$a  = substr($dataAtual,0,4);

if($m=="01") { $mesEscrito = "Janeiro"; }
if($m=="02") { $mesEscrito = "Fevereiro"; }
if($m=="03") { $mesEscrito = "Março"; }
if($m=="04") { $mesEscrito = "Abril"; }
if($m=="05") { $mesEscrito = "Maio"; }
if($m=="06") { $mesEscrito = "Junho"; }
if($m=="07") { $mesEscrito = "Julho"; }
if($m=="08") { $mesEscrito = "Agosto"; }
if($m=="09") { $mesEscrito = "Setembro"; }
if($m=="10") { $mesEscrito = "Outubro"; }
if($m=="11") { $mesEscrito = "Novembro"; }
if($m=="12") { $mesEscrito = "Dezembro"; }

$dia = "".$d."";
$mes = "".$mesEscrito."";
$ano = "".$a."";

$output = str_replace( "[@cliente.nome]", $nome, $output );
$output = str_replace( "[@cliente.cpf]", $cpf, $output );
$output = str_replace( "[@cliente.rg]", $rg, $output );
$output = str_replace( "[@cliente.emissor]", $emissor, $output );
$output = str_replace( "[@cliente.data_nascimento]", $data_nascimento, $output );
$output = str_replace( "[@cliente.profissao]", $profissao, $output );
$output = str_replace( "[@cliente.nacionalidade]", $nacionalidade, $output );
$output = str_replace( "[@cliente.estado_civil]", $estado_civil, $output );
$output = str_replace( "[@cliente.cep]", $cep, $output );
$output = str_replace( "[@cliente.rua]", $rua, $output );
$output = str_replace( "[@cliente.numero]", $numero, $output );
$output = str_replace( "[@cliente.complemento]", $complemento, $output );
$output = str_replace( "[@cliente.bairro]", $bairro, $output );
$output = str_replace( "[@cliente.cidade]", $cidade, $output );
$output = str_replace( "[@cliente.estado]", $estado, $output );
$output = str_replace( "[@cliente.telefone]", $telefone, $output );
$output = str_replace( "[@cliente.email]", $email, $output );
$output = str_replace( "[@cliente.nome]", $proprietario, $output );
$output = str_replace( "[@cliente.pis]", $pis, $output );

$output = str_replace( "[@usuario.nome]", $nomeUsuario, $output );
$output = str_replace( "[@usuario.cep]", $cepUsuario, $output );
$output = str_replace( "[@usuario.rua]", $ruaUsuario, $output );
$output = str_replace( "[@usuario.numero]", $numeroUsuario, $output );
$output = str_replace( "[@usuario.complemento]", $complementoUsuario, $output );
$output = str_replace( "[@usuario.bairro]", $bairroUsuario, $output );
$output = str_replace( "[@usuario.cidade]", $cidadeUsuario, $output );
$output = str_replace( "[@usuario.estado]", $estadoUsuario, $output );
$output = str_replace( "[@usuario.email]", $emailUsuario, $output );

$output = str_replace( "[@data.dia]", $dia, $output );
$output = str_replace( "[@data.mes]", $mes, $output );
$output = str_replace( "[@data.ano]", $ano, $output );

$output = str_replace( "[@contrato.data_assinatura]", $data_assinaturaGet, $output );

echo $output;
?> 