if ($pref['twitch_forum'] == "1"){

include_lan(e_PLUGIN."aacgc_twitchstream/languages/".e_LANGUAGE.".php");

global $post_info, $sql, $tp;

$postowner  = $post_info['user_id'];

$sql->db_Select("user_extended", "*", "user_extended_id = '".$postowner."'");
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
{$twitchstatus = "<a href='".e_PLUGIN."aacgc_twitchstream/Twitch_Stream.php?".$row['user_twitchname'].".".$postowner."'><img width='75px' src='".e_PLUGIN."aacgc_twitchstream/images/offline_large.png' /></a>";}
else
{$twitchstatus = "<a href='".e_PLUGIN."aacgc_twitchstream/Twitch_Stream.php?".$row['user_twitchname'].".".$postowner."'><img width='75px' src='".e_PLUGIN."aacgc_twitchstream/images/online_large.png' /></a>";}

return "".$twitchstatus."";}
}