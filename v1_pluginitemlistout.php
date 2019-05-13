<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$incategory = $_REQUEST['Category'];
$indate = $_REQUEST['Date'];
$insortby = $_REQUEST['SortBy'];
$insortseq = $_REQUEST['SortSeq'];
$inshow = $_REQUEST['Show'];
$inmax = $_REQUEST['Max'];

Webpage_WEBSTYLE_Output();

$incategorya = explode("_",$incategory);

if ($incategorya[0] == "Event") {
    Webpage_EVENTLISTGENERATOR_Output( $incategorya[1],$indate,$insortby,$insortseq,$inshow,$inmax );
}

if ($intype == "Article") {
    Webpage_ARTICLELISTGENERATOR_Output( $incategorya[1],$indate,$insortby,$insortseq,$inshow,$inmax );
}

if ($intype == "Course") {
    Webpage_COURSELISTGENERATOR_Output( $incategorya[1],$indate,$insortby,$insortseq,$inshow,$inmax );
}

if ($intype == "Draw") {
    Webpage_DRAWLISTGENERATOR_Output( $incategorya[1],$indate,$insortby,$insortseq,$inshow,$inmax );
}
