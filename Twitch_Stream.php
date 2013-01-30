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

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}
if($pref['twitch_theme'] == "1"){
$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//-----------------------------------------------------------------------------------------------------------+
include_lan(e_PLUGIN."aacgc_twitchstream/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+

//-------------------------Title--------------------------------+
$title .= $pref['twitch_pagetitle'];
//--------------------------------------------------------------+

$sql->db_Select("user_extended", "*", "user_extended_id = '".$sub_action."'");
$row = $sql->db_Fetch();
$sql2 = new db;
$sql2->db_Select("user", "*", "user_id='".$row['user_extended_id']."'");
$row2 = $sql2->db_Fetch();

$username = $row2['user_name'];
$userid = $row['user_id'];

$mycurl = curl_init(); 
curl_setopt ($mycurl, CURLOPT_HEADER, 0); 
curl_setopt ($mycurl, CURLOPT_RETURNTRANSFER, 1);  
$url = "http://api.justin.tv/api/stream/list.json?channel=".$action;  
curl_setopt ($mycurl, CURLOPT_URL, $url); 
$response =  curl_exec($mycurl);  
$results = json_decode($response); 
foreach($results as $s)

$res_game = $s->meta_game;
$res_title = $s->title;
$res_login = $s->channel->login;
$res_timezone = $s->channel->timezone;
$res_cat = $s->channel->category_title;
$res_uptime = $s->up_time;

if(!$results)
{$status = "".TWS_06."";
$view = "<img height='25px' src='".e_PLUGIN."aacgc_twitchstream/images/offline.png' border='0' alt='".TWS_06."' /></a>";
$stream_details = "<i>".TWS_15."</i>";}
else
{$status = "".TWS_08."";
$view = "<img height='25px' src='".e_PLUGIN."aacgc_twitchstream/images/online.png' border='0' alt='".TWS_08."' /></a>";
$stream_details = "
	<b>".TWS_10.":</b> ".$res_cat."<br/>
	<b>".TWS_11.":</b> ".$res_game."<br/>
	<b>".TWS_12.":</b> ".$res_title."<br/>
	<b>".TWS_13.":</b> ".$res_timezone."<br/>
	<b>".TWS_14.":</b> ".$res_uptime."
";}

//-------------------------------------------------------------------+

$text .= "
<table style='width:100%' class=''>
	<tr>
		<td style='width:75%' class='".$themea."'>".TWS_02."</td>
		<td style='width:25%' class='".$themea."'>".TWS_03."</td>
		<td style='width:0%' class='".$themea."'>".TWS_07."</td>
		<td style='width:0%' class='".$themea."'>".TWS_04."</td>
	</tr>
	<tr>
		<td class='".$themeb."'>".$username."</td>
		<td class='".$themeb."'>".$action."</td>
		<td class='".$themeb."'>".$status."</td>
		<td class='".$themeb."'>".$view."</td>
	</tr>
	<tr>
		<td class='".$themeb."' colspan='4'><b><u>".TWS_09."</u>:</b><br/>".$stream_details."</td>
	</tr>
	<tr>
		<td style='text-align:center' class='".$themeb."' colspan='4'>
"; 

$text .= '
<object type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel='.$action.'" bgcolor="#000000">
<param name="allowFullScreen" value="true" />
<param name="allowScriptAccess" value="always" />
<param name="allowNetworking" value="all" />
<param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
<param name="flashvars" value="hostname=www.twitch.tv&channel='.$action.'&auto_play=true&start_volume=25" />
</object>
';

$text .= "</td>
	</tr>
</table>
<br/><br/>
<center><a href='".e_PLUGIN."aacgc_twitchstream/Twitch_Stream_List.php'>".TWS_05."</a></center>";

curl_close($mycurl);

//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_twitchstream/plugin.php');
$text .= "<br/><br/><br/><br/><br/><br/><br/>
<a href='http://www.aacgc.com' target='_blank'><font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</a>
powered by <a href='https://github.com/justintv/Twitch-API/wiki/API' target='_blank'>Twitch.tv</a>
</font>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text);

//----------------------------------------------------------------------------------

require_once(FOOTERF);

?>