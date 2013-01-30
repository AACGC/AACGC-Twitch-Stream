if ($pref['twitch_profile'] == "1"){

include_lan(e_PLUGIN."aacgc_twitchstream/languages/".e_LANGUAGE.".php");

global $sql,$sql2,$user, $tp; 

$suser = "";
$USER_ID = "";

$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
if ($suser[1] == 'php?id')
{$suser = $suser[2];}

$SUSER_ID = $suser;

$sql->db_Select("user_extended", "*", "user_extended_id = '".$SUSER_ID."'");
$row = $sql->db_Fetch();
if($row['user_twitchname'] != ""){
$mycurl = curl_init(); 
curl_setopt ($mycurl, CURLOPT_HEADER, 0); 
curl_setopt ($mycurl, CURLOPT_RETURNTRANSFER, 1);  
$url = "http://api.justin.tv/api/stream/list.json?channel=".$row['user_twitchname'];  
curl_setopt ($mycurl, CURLOPT_URL, $url); 
$response =  curl_exec($mycurl);  
$results = json_decode($response); 

if(!$results)
{$twitchstatus = "<a href='".e_PLUGIN."aacgc_twitchstream/Twitch_Stream.php?".$row['user_twitchname'].".".$SUSER_ID."'><img src='".e_PLUGIN."aacgc_twitchstream/images/offline_large.png' /></a>";}
else
{$twitchstatus = "<a href='".e_PLUGIN."aacgc_twitchstream/Twitch_Stream.php?".$row['user_twitchname'].".".$SUSER_ID."'><img src='".e_PLUGIN."aacgc_twitchstream/images/online_large.png' /></a>";
foreach($results as $s)
$res_game = $s->meta_game;
$res_title = $s->title;
$res_login = $s->channel->login;
$res_timezone = $s->channel->timezone;
$res_cat = $s->channel->category_title;
$res_uptime = $s->up_time;
$res_video = '
<object type="application/x-shockwave-flash" height="150" width="300" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel='.$action.'" bgcolor="#000000">
<param name="allowFullScreen" value="true" />
<param name="allowScriptAccess" value="always" />
<param name="allowNetworking" value="all" />
<param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
<param name="flashvars" value="hostname=www.twitch.tv&channel='.$row['user_twitchname'].'&auto_play=false&start_volume=25" />
</object>
';
$stream_details = "
	<b>".TWS_10.":</b> ".$res_cat."<br/>
	<b>".TWS_11.":</b> ".$res_game."<br/>
	<b>".TWS_12.":</b> ".$res_title."<br/>
	<b>".TWS_13.":</b> ".$res_timezone."<br/>
	<b>".TWS_14.":</b> ".$res_uptime."
";}

$twitchuser = "<tr><td class='forumheader3' style='text-align:left' colspan='2'>
<table style='width:100%' class=''>
	<tr>
		<td style='width:0%; text-align:center' class='".$themeb."'>".$twitchstatus."</td>
		<td style='width:0%' class='".$themeb."'>".$res_video."</td>
		<td style='width:100%' class='".$themeb."'>".$stream_details."</td>
	</tr>
</table>
</td></tr>";

return $twitchuser;}

}