<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Twitch Stream             #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


$eplug_name = "AACGC Twitch Stream";
$eplug_version = "1.1";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "TwitchTV is the world's largest video game broadcasting and chat community dedicated to connecting people around the games they love.TwitchTV features video from the top gaming personalities, players, tournaments, leagues and commentary, in addition to the most active and interesting discussions around video games.";
$eplug_compatible = "e107 v7+";
$eplug_readme = "";
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

$eplug_folder = "aacgc_twitchstream";

$eplug_menu_name = "Twitch Steam";

$eplug_conffile = "admin_main.php";

$eplug_icon = $eplug_folder . "/images/icon_32.png";
$eplug_icon_small = $eplug_folder . "/images/icon_16.png";
$eplug_icon_large = "".e_PLUGIN."aacgc_twitchstream/images/icon_64.png";

$eplug_caption = "AACGC Twitch Stream";

$eplug_prefs = array(
"twitch_menutitle" => "Member Streams",
"twitch_pagetitle" => "Member Twitch Streams",
"twitch_theme" => "1",
"twitch_profile" => "1",
"twitch_forum" => "1",
"twitch_header" => "Enter your twitch username in your profile to show off your live feeds",
"twitch_menuheight" => "auto",
"twitch_mheader" => "Enter your twitch username in your profile to show off your live feeds",
);

$eplug_table_names = "";
$eplug_tables = "";

$eplug_link = true;
$eplug_link_name = "Member Streams";
$eplug_link_url = e_PLUGIN."aacgc_twitchstream/Twitch_Stream_List.php";

$eplug_done = "The plugin is now installed.";

$upgrade_add_prefs = array(
"twitch_menutitle" => "Member Streams",
"twitch_pagetitle" => "Member Twitch Streams",
"twitch_theme" => "1",
"twitch_profile" => "1",
"twitch_forum" => "1",
"twitch_header" => "Enter your twitch username in your profile to show off your live feeds",
"twitch_menuheight" => "auto",
"twitch_mheader" => "Enter your twitch username in your profile to show off your live feeds",
);

$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "Upgrade Complete";

?>	

