<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
FBHeader();

$incategoryid = $_REQUEST['CategoryId'];
$insortby = $_REQUEST['SortBy'];
$insortseq = $_REQUEST['SortSeq'];
$inshow = $_REQUEST['Show'];
$inmax = $_REQUEST['Max'];

Webpage_FBSTYLE_Output();
Webpage_ARTICLELISTGENERATOR_Output($incategoryid,$insortby,$insortseq,$inshow,$inmax);

FBFooter();

