<?
#######################################################################
#				PHP Social Share Count Class
#	Script Url: http://toolspot.org/script-to-get-shared-count.php
#	Author: Sunny Verma
#	Website: http://toolspot.org
#	License: GPL 2.0, @see http://www.gnu.org/licenses/gpl-2.0.html
########################################################################
require("shareCount.php");
$obj=new shareCount("http://pizzatarifim.com");  //Use your website or URL
echo "Tweets: ".$obj->get_tweets(); //to get tweets
echo "<br>Facebook: ".$obj->get_fb(); //to get facebook total count (likes+shares+comments)
echo "<br>Linkedin: ".$obj->get_linkedin(); //to get linkedin shares
echo "<br>Google+: ".$obj->get_plusones(); //to get google plusones
echo "<br>Delicious: ".$obj->get_delicious(); //to get delicious bookmarks  count
echo "<br>StumbleUpon: ".$obj->get_stumble(); //to get Stumbleupon views
echo "<br>Pinterest: ".$obj->get_pinterest(); //to get pinterest pins
?>