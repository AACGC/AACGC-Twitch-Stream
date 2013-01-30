<?php

/*
#######################################
#     AACGC Twitch Streamer           #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);

//-----------------------------------------------------------------------------------------------------------+
include_lan(e_PLUGIN."aacgc_twitchstream/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+
if($pref['twitch_theme'] == "1"){
$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//-------------------------Title--------------------------------+
$title .= $pref['twitch_pagetitle'];
//-------------------------------------------------------------------+

$text .= "
<table style='width:100%' class=''>
	<tr>
		<td style='width:100%' class='".$themea."' colspan='4'>".$tp->toHTML($pref['twitch_header'], TRUE)."</td>
	</tr>
	<tr>
		<td style='width:50%' class='".$themea."'>".TWS_02." (".TWS_03.")</td>
		<td style='width:0%' class='".$themea."'>".TWS_07."</td>
		<td style='width:50%' class='".$themea."'>".TWS_09."</td>
	</tr>";

$sql->mySQLresult = @mysql_query("select * from ".MPREFIX."user_extended x, ".MPREFIX."user u where u.user_id=x.user_extended_id order by u.user_name ASC;");
while($row = $sql ->db_Fetch()){
	
$twitchname = $row['user_twitchname'];
if($twitchname != ""){
$username = $row['user_name'];
$userid = $row['user_id'];

$mycurl = curl_init(); 
curl_setopt ($mycurl, CURLOPT_HEADER, 0); 
curl_setopt ($mycurl, CURLOPT_RETURNTRANSFER, 1);  
$url = "http://api.justin.tv/api/stream/list.json?channel=".$twitchname;  
curl_setopt ($mycurl, CURLOPT_URL, $url); 
$response =  curl_exec($mycurl);  
$results = json_decode($response); 
if(!$results)
{$status = "".TWS_06."";
$view = "<a href='".e_PLUGIN."aacgc_twitchstream/Twitch_Stream.php?".$twitchname.".".$userid."'><img height='25px' src='".e_PLUGIN."aacgc_twitchstream/images/offline.png' border='0' alt='".$status."' /></a>";
$stream_details = "";}
else
{
foreach($results as $s)
$res_game = $s->meta_game;
$res_title = $s->title;
$res_login = $s->channel->login;
$res_timezone = $s->channel->timezone;
$res_cat = $s->channel->category_title;
$res_uptime = $s->up_time;	
$status = "".TWS_08."";
$view = "<a href='".e_PLUGIN."aacgc_twitchstream/Twitch_Stream.php?".$twitchname.".".$userid."'><img height='25px' src='".e_PLUGIN."aacgc_twitchstream/images/online.png' border='0' alt='".$status."' /></a>";
$stream_details = "<small>
	<b>".TWS_10.":</b> ".$res_cat."<br/>
	<b>".TWS_11.":</b> ".$res_game."<br/>
	<b>".TWS_12.":</b> ".$res_title."<br/>
	<b>".TWS_13.":</b> ".$res_timezone."<br/>
	<b>".TWS_14.":</b> ".$res_uptime."
</small>";}

$text .= "
	<tr>
		<td class='".$themeb."'><a href='".e_BASE."user.php?id.".$userid."'><b>".$username."</b></a><br/>(".$twitchname.")</td>
		<td class='".$themeb."' style='text-align:center'>".$view."<br/>".$status."</td>
		<td class='".$themeb."'>".$stream_details."</td>
	</tr>";
curl_close($mycurl);	
	}
}

$text .= "</table>";

//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_twitchstream/plugin.php');
$text .= "<br/><br/><br/><br/><br/><br/><br/>
<a href='http://www.aacgc.com' target='_blank'><font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</a>
powered by <a href='https://github.com/justintv/Twitch-API/wiki/API' target='_blank'>Twitch.tv</a></font>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text);

//----------------------------------------------------------------------------------

require_once(FOOTERF);

?>