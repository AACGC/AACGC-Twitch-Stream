<?php
	
//-----------------------------------------------------------------------------------------------------------+
include_lan(e_PLUGIN."aacgc_twitchstream/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+
if($pref['twitch_theme'] == "1"){
$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//------------------------------------------------------
$twitchstream_title .= $pref['twitch_menutitle'];
//------------------------------------------------------

$twitchstream_text .= "".$tp->toHTML($pref['twitch_mheader'], TRUE)."";

if($pref['twitch_menuheight'] != "auto")
{$twitchstream_text .= "<div style='width:100%; height:".$pref['twitch_menuheight']."; overflow:auto'>";}

$twitchstream_text .= "
<table style='width:100%' class=''>
	<tr>
		<td style='width:100%' class='".$themea."'>".TWS_02."</td>
		<td style='width:0%' class='".$themea."'>".TWS_07."</td>
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

if(!$results){
	if($pref['twitch_showoffline'] == "1"){
$status = "".TWS_06."";
$view = "<a href='".e_PLUGIN."aacgc_twitchstream/Twitch_Stream.php?".$twitchname.".".$userid."'><img height='25px' src='".e_PLUGIN."aacgc_twitchstream/images/offline.png' border='0' alt='".$status."' /></a>";
$twitchstream_text .= "
	<tr>
		<td class='".$themeb."'><a href='".e_BASE."user.php?id.".$userid."'><b>".$username."</b></a><br/>(".$twitchname.")</td>
		<td class='".$themeb."' style='text-align:center'>".$view."<br/>".$status."</td>
	</tr>";}}
	
else

{$status = "".TWS_08."";
$view = "<a href='".e_PLUGIN."aacgc_twitchstream/Twitch_Stream.php?".$twitchname.".".$userid."'><img height='25px' src='".e_PLUGIN."aacgc_twitchstream/images/online.png' border='0' alt='".$status."' /></a>";	
$twitchstream_text .= "
	<tr>
		<td class='".$themeb."'><a href='".e_BASE."user.php?id.".$userid."'><b>".$username."</b></a><br/>(".$twitchname.")</td>
		<td class='".$themeb."' style='text-align:center'>".$view."<br/>".$status."</td>
	</tr>";}
	
curl_close($mycurl);	
}
}

$twitchstream_text .= "</table>";

if($pref['twitch_menuheight'] != "auto")
{$twitchstream_text .= "</div>";}

//------------------------------------------------------

$ns->tablerender($twitchstream_title, $twitchstream_text);

//------------------------------------------------------
?>