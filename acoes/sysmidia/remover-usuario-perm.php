<?
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = $_GET['numeroUnicoS'];
$idGet = $_GET['idS'];

$sql = mysql_query("DELETE FROM sysmidiaperm WHERE id='".$idGet."'");

include("lista_usuarios.php");
?>
