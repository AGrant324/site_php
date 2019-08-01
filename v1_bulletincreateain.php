<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_BULLETINCREATEC_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();


$bulletinref = $_REQUEST['BulletinRef'];
$fixedbulletinboard = $_REQUEST['FixedBulletinBoard'];

if ($bulletinref == "P") {
  $webpage_name = $_REQUEST['WebpageName'];	
  Webpage_BULLETINCREATEC_Output("P",$webpage_name,"","",$fixedbulletinboard);
}
if ($bulletinref == "L") {
 $weblink = $_REQUEST['WebLink'];
 $httptext = 'http://';
 if (strpos($weblink, $httptext) !== false) {} else { $weblink = $httptext.$weblink; }
 Webpage_BULLETINCREATEC_Output("L",$weblink,"","",$fixedbulletinboard);
}
if ($bulletinref == "E") {
 $event_id = $_REQUEST['EventId'];
 Webpage_BULLETINCREATEC_Output("E",$event_id,"","",$fixedbulletinboard);
}
if ($bulletinref == "A") {
 $article_id = $_REQUEST['ArticleId'];
 Webpage_BULLETINCREATEC_Output("A",$article_id,"","",$fixedbulletinboard);
}
if ($bulletinref == "C") {
 $course_id = $_REQUEST['CourseId'];
 Webpage_BULLETINCREATEC_Output("C",$course_id,"","",$fixedbulletinboard);
}
if ($bulletinref == "R") {
 $team_code = $_REQUEST['TeamCode'];	
 Webpage_BULLETINCREATEB_Output($GLOBALS{'currentperiodid'}, $team_code, $fixedbulletinboard);
}


if ($fixedbulletinboard != "") {
 XBR(); 
 $bulletinlink = YPGMLINK("bulletinboardeditout.php").YPGMSTDPARMS.YPGMPARM("bulletinboard_name",$fixedbulletinboard);
 XLINKTXT($bulletinlink,'"Return to "'.$fixedbulletinboard.'" Bulletin Board Edit'); 
}

Back_Navigator();
PageFooter("Default","Final");




