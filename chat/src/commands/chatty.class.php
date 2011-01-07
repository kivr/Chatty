<?php

require_once(dirname(__FILE__)."/../pfccommand.class.php");
require_once(dirname(__FILE__)."/../commands/join.class.php");

/**
 * /chatty command
 *
 * Invites all users into a channel
 *
 */
class pfcCommand_chatty extends pfcCommand
{
  var $usage = "/chatty {name of the chatty}";
	
  function run(&$xml_reponse, $p)
  {
    $params      = $p["params"];
    
    $ct =& pfcContainer::Instance(); // Connection to the chatbackend

    $channeltarget = isset($params[0]) ? $params[0] : '';

    if ($channeltarget == '')
    {
      // Parameters are not ok
      $cmdp = $p;
      $cmdp["params"] = array();
      $cmdp["param"] = _pfc("Missing parameter");
      $cmdp["param"] .= " (".$this->usage.")";
      $cmd =& pfcCommand::Factory("error");
      $cmd->run($xml_reponse, $cmdp);
      return;
    }

    $cmdstr = 'join';
    $cmdp = array();
    $cmdp['param'] = $channeltarget; // channel target name
    $cmdp['params'][] = $channeltarget; // channel target name

    $onlineNick = $ct->getOnlineNick();
    foreach($onlineNick['nickid'] as $nickId)
    {
        pfcCommand::AppendCmdToPlay($nickId, $cmdstr, $cmdp);
    }

    $channelFile = fopen(dirname(__FILE__)."/../../channels.txt", "a");
    fwrite($channelFile, $channeltarget."\n");
    fclose($channelFile);
  }
}
?>
