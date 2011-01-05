<?php

require_once dirname(__FILE__)."/src/phpfreechat.class.php";
$params = array();
$params["title"] = "Kintana Dashboard";
//$params["nick"] = "guy".rand(1,1000);  // setup the intitial nickname
$params['firstisadmin'] = true;
//$params["isadmin"] = true; // makes everybody admin: do not use it on production servers ;)
$params["serverid"] = md5(__FILE__); // calculate a unique id for this chat
$params["debug"] = false;
$params["theme"] = "full";
$params["nickname_colorlist"] = array("#CC0000","#00CC00","#0000CC","#FFCC00",
	"#339999","#660099","#999999","#333333","#FF9900","#3399FF","#663300","#cc0066");
$params["showsmileys"] = false;
$params["timeout"] = 120000;
$params["skip_proxies"] = array("censor");

$dateFormat = "d/m/Y";
$channelsFile = "channels.txt";
if(date($dateFormat) != date($dateFormat, filectime($channelsFile)))
{
	$handle = fopen($channelsFile, 'w');
	fclose($handle);
}
$channels = file($channelsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
array_unshift($channels, "Backup");
$params["channels"] = $channels;

$chat = new phpFreeChat( $params );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<style>
			a.link {
				color:#FFFFFF;
				font-weight:bolder;
				text-shadow: 0.01em 0.01em 0.2em #333;
			}
			#linker td {
				width:136px;
				height:28px;
				background-image:url("tab.png");
				text-align:center;
				vertical-align:top;
			}
		</style>
		<title>Chatty</title>
	</head>
	<body>
		<img src="chatty.png" />
		<?php $chat->printChat(); ?>
		<table id="linker" cellspacing="0" cellpadding="0 5 5 5">
			<tr>
				<td><a href="../share" target="_blank" class="link">Compartidor</a></td>
				<td><a href="../proxy" target="_blank" class="link">Proxy</a></td>
			</tr>
		</table>
	</body>
</html>
