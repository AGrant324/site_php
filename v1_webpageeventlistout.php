<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$incategoryid = $_REQUEST['CategoryId'];
$indate = $_REQUEST['Date'];
$insortby = $_REQUEST['SortBy'];
$insortseq = $_REQUEST['SortSeq'];
$inshow = $_REQUEST['Show'];
$inmax = $_REQUEST['Max'];

Webpage_WEBSTYLE_Output();
Webpage_EVENTLISTGENERATOR_Output( $incategoryid,$indate,$insortby,$insortseq,$inshow,$inmax );

