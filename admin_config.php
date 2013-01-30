<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Twitch Stream              #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
} 
require_once(e_ADMIN . "auth.php");
require_once(e_HANDLER . "userclass_class.php");
include_lan(e_PLUGIN."aacgc_twitchstream/languages/".e_LANGUAGE.".php");

if (isset($_POST['update']))
{ 
    $pref['twitch_pagetitle'] = $tp->toDB($_POST['twitch_pagetitle']);
    $pref['twitch_menutitle'] = $tp->toDB($_POST['twitch_menutitle']);
    $pref['twitch_header'] = $tp->toDB($_POST['twitch_header']);
    $pref['twitch_menuheight'] = $tp->toDB($_POST['twitch_menuheight']);
    $pref['twitch_mheader'] = $tp->toDB($_POST['twitch_mheader']);

if (isset($_POST['twitch_theme'])) 
{$pref['twitch_theme'] = 1;}
else
{$pref['twitch_theme'] = 0;}

if (isset($_POST['twitch_forum'])) 
{$pref['twitch_forum'] = 1;}
else
{$pref['twitch_forum'] = 0;}

if (isset($_POST['twitch_profile'])) 
{$pref['twitch_profile'] = 1;}
else
{$pref['twitch_profile'] = 0;}

    save_prefs();

$text .= "".ATWS_04."";

}
//-------------------------# BB Code Support #----------------------------------------------
include(e_HANDLER."ren_help.php");
//------------------------------------------------------------------------------------------

$text .= "<form method='post' action='".e_SELF."' id='conslform'>
<table class='fborder' width='100%'>
<tr>
<td style='width:30%' class='forumheader3' colspan=2><b>".ATWS_05."</b></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ATWS_06.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='50' name='twitch_pagetitle' value='" . $pref['twitch_pagetitle'] . "' /></td>
</tr>
<tr>
        <td style='width:' class='forumheader3'>".ATWS_10.":</td>
        <td style='width:' class='forumheader3'>
	    <textarea class='tbox' rows='5' cols='100' name='twitch_header' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['twitch_header']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "
		</td> 
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ATWS_07.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='50' name='twitch_menutitle' value='" . $pref['twitch_menutitle'] . "' /></td>
</tr>
<tr>
        <td style='width:' class='forumheader3'>".ATWS_15.":</td>
        <td style='width:' class='forumheader3'>
	    <textarea class='tbox' rows='5' cols='100' name='twitch_mheader' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['twitch_mheader']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "
		</td> 
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ATWS_08.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['twitch_theme'] == 1 ? "<input type='checkbox' name='twitch_theme' value='1' checked='checked' />" : "<input type='checkbox' name='twitch_theme' value='0' />")."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ATWS_11.":</b><br/>".ATWS_12."</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='50' name='twitch_menuheight' value='" . $pref['twitch_menuheight'] . "' /></td>
</tr>

<tr>
<td style='width:30%' class='forumheader3'><b>".ATWS_13.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['twitch_profile'] == 1 ? "<input type='checkbox' name='twitch_profile' value='1' checked='checked' />" : "<input type='checkbox' name='twitch_profile' value='0' />")."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ATWS_14.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['twitch_forum'] == 1 ? "<input type='checkbox' name='twitch_forum' value='1' checked='checked' />" : "<input type='checkbox' name='twitch_forum' value='0' />")."</td>
</tr>

</table><br/><br/>";

//------------------------------------------------------------------------------------
$text .= "
<table class='fborder' width='100%'><tr>
<td colspan='2' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='".ATWS_09."' class='button' />\n
</td>
</tr></table></form>";


$ns->tablerender("AACGC Twitch Stream(".ATWS_02.")", $text);
require_once(e_ADMIN . "footer.php");

?>