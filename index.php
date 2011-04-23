<?php

if(!isset($_SERVER['HTTPS']))
{
	$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location: $redirect");
	exit(0);
}

$authUser = "40e84a23337e950c86b87ecd89827be9";
$authPw = "5e0b21ac0560a070e8af9880ffdce8da";

if (md5($_SERVER['PHP_AUTH_USER']) != $authUser || md5($_SERVER['PHP_AUTH_PW']) != $authPw) {
	header('WWW-Authenticate: Basic');
	header('HTTP/1.0 401 Unauthorized');
	echo '<h1>Unauthorized</h1>';
	exit(0);
}

require_once dirname(__FILE__)."/chat/src/phpfreechat.class.php";
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
$params["time_offset"] = 3600;
$params["nickmeta_private"] = array();
$params["max_nick_len"] = 20;
$params["nickmeta"] = array('client'=>'web');

$dateFormat = "d/m/Y";
$channelsFile = dirname(__FILE__)."/chat/channels.txt";
if(date($dateFormat) != date($dateFormat, filectime($channelsFile)))
{
	$handle = fopen($channelsFile, 'w');
	fclose($handle);
}
$channels = file($channelsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
array_unshift($channels, "Lobby");
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
				background-image:url("./chat/tab.png");
				text-align:center;
				vertical-align:top;
			}
		</style>
		<title>Chatty</title>
	</head>
	<body>
		<img src="./chat/chatty.png" /></td>
		<?php $chat->printChat(); ?>
		<table id="linker" cellspacing="0" cellpadding="0 5 5 5">
			<tr>
				<td><a href="./share" target="_blank" class="link">Compartidor</a></td>
				<td><a href="./proxy" target="_blank" class="link">Proxy</a></td>
			</tr>
		</table>
	</body>
</html>
