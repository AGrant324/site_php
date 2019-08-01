<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_FRSTEAMRESULTS_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$insectionname = $_REQUEST['section_name'];
$inteamcode = $_REQUEST['team_code'];
$infrsid = $_REQUEST['FrsId'];
$infrsresult = $_REQUEST['frs_result'];
$infrsgf = $_REQUEST['frs_gf'];
$infrsga = $_REQUEST['frs_ga'];

$frsreportheadline = $_REQUEST['frs_reportheadline'];
$infrsreport = $_REQUEST['frs_report'];
$infrsvideostream = $_REQUEST['frs_videostream'];
$infrsvideostreamcommentary = $_REQUEST['frs_videostreamcommentary'];
$infrsreportvalidation = $_REQUEST['frs_reportvalidation'];
$infrsstatslist = $_REQUEST['frs_statslist'];

// XH2($infrsreportvalidation);

Get_Data('section', $GLOBALS{'currperiodid'}, $insectionname);
if ($GLOBALS{'section_sportid'} == "") {	Get_Data("sport_".$GLOBALS{'domain_sportid'});} 
else { Get_Data("sport_".$GLOBALS{'section_sportid'});}

Get_Data("frs",$GLOBALS{'currperiodid'},$inteamcode, $infrsid);

$GLOBALS{'frs_result'} = $infrsresult;
$GLOBALS{'frs_gf'} = $infrsgf;
$GLOBALS{'frs_ga'} = $infrsga;
$GLOBALS{'frs_statslist'} = $infrsstatslist;
$GLOBALS{'frs_reportheadline'} = $frsreportheadline;
$GLOBALS{'frs_report'} = $infrsreport;
$GLOBALS{'frs_videostream'} = $infrsvideostream;
$GLOBALS{'frs_videostreamcommentary'} = $infrsvideostreamcommentary;
$GLOBALS{'frs_reportvalidation'} = $infrsreportvalidation;
if ($GLOBALS{'frs_reportvalidation'} != "Yes") {
	XBR();XTXTCOLOR("<b>Updated Match Report not published - Match Report has not been validated.</b>","red");XBR();
}

Write_Data("frs",$GLOBALS{'currperiodid'},$inteamcode,$infrsid);

Frs_FRSTEAMRESULTS_Output($GLOBALS{'currperiodid'},$insectionname,$inteamcode,$infrsid);

Frs_FRSRECALCULATESTATS_Output ($GLOBALS{'currperiodid'});

Back_Navigator();
PageFooter("Default","Final");
