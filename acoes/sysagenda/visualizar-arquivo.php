<?php
include("../../include/inc/main.php");
include("../../include/inc/data.php");

$idGet = $_REQUEST['idS'];

$itemSql = mysql_fetch_array(mysql_query("SELECT * FROM sysagenda_galeria WHERE id='".$idGet."'"));

$extensao = $itemSql['imagem'];
$extensao = substr($extensao, -4);
if($extensao[0] == '.'){
	$extensao = substr($extensao, -3);
}
$extensao = strtolower($extensao);

?>

<div style="width:600px;">
<? if($extensao=="png"||$extensao=="jpg"||$extensao=="jpeg"||$extensao=="gif"||$extensao=="bmp") { ?>
<img style="max-width:600px;" src="<?=$link?>files/sysagenda/<?=$itemSql['numeroUnico']?>/<?=$itemSql['imagem']?>" alt="" />
<? } else { ?>
	<? if($extensao=="flv"||$extensao=="mp4"||$extensao=="mp3") { ?>
    <script type="text/javascript" src="<?=$link?>include/lib/jwplayer/jwplayer.js"></script>
    <script type="text/javascript">jwplayer.key="xxBb3SMIbCAq6uovMXUnXE0R04qyM2u8pmYYDQ==";</script>
    <div id="myElement">Carregando...</div>
    
    <script type="text/javascript">
        jwplayer("myElement").setup({
            file: "<?=$link?>files/sysagenda/<?=$itemSql['numeroUnico']?>/<?=$itemSql['imagem']?>",
			width:450,
			heigth:350
        });
    </script>
    <? } else { ?>
		<? if($extensao=="avi"||$extensao=="mpg"||$extensao=="mpeg"||$extensao=="mov") { ?>
        <object id="MediaPlayer1" CLASSID="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701"
        standby="Loading Microsoft Windows® Media Player components..." type="application/x-oleobject" width="450" height="350">
        <param name="fileName" value="<?=$link?>files/sysagenda/<?=$itemSql['numeroUnico']?>/<?=$itemSql['imagem']?>">
        <param name="animationatStart" value="true">
        <param name="transparentatStart" value="true">
        <param name="autoStart" value="true">
        <param name="showControls" value="true">
        <param name="Volume" value="-450">
        <embed type="application/x-mplayer2" pluginspage="http://www.microsoft.com/Windows/MediaPlayer/" src="<?=$link?>files/sysagenda/<?=$itemSql['numeroUnico']?>/<?=$itemSql['imagem']?>" name="MediaPlayer1" width="450" height="350" autostart="0" showcontrols="1" volume="-450">
        </object>
		<? } else { ?>
			<? if($extensao=="doc"||$extensao=="docx") { ?>
                <?
					header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header("Content-type: application/msword");
					header("Content-Disposition: attachment; filename=".$link."files/sysagenda/".$itemSql['numeroUnico']."/".$itemSql['imagem'].";");
				?>
			<? } else { ?>
            <? } ?>
        <? } ?>
    <? } ?>
<? } ?>

</div>
