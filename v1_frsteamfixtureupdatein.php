<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_FRSUPDATEMENU_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inseason = $_REQUEST['season'];
$inteam_code = $_REQUEST['team_code'];
$infrs_id = $_REQUEST['frs_id'];
$infrs_seq = $_REQUEST['frs_seq'];
$infrs_oppo = $_REQUEST['frs_oppo'];
$infrs_ha = $_REQUEST['frs_ha'];
$infrs_lcf = $_REQUEST['frs_lcf'];
$infrs_venue = ""; if (isset($_REQUEST['frs_venue'])) { $infrs_venue = $_REQUEST['frs_venue']; }
$infrs_awayvenue = ""; if (isset($_REQUEST['frs_awayvenue'])) { $infrs_awayvenue = $_REQUEST['frs_awayvenue']; }
$infrs_time = StandardTime($_REQUEST['frs_time']);
$infrs_timeend = StandardTime($_REQUEST['frs_timeend']);
$infrs_info = $_REQUEST['frs_info'];


Get_Data('frs',$inseason,$inteam_code,$infrs_id);
$GLOBALS{'frs_seq'} = $infrs_seq;
$GLOBALS{'frs_oppo'} = $infrs_oppo;
$GLOBALS{'frs_ha'} = $infrs_ha;
$GLOBALS{'frs_lcf'} = $infrs_lcf;
$GLOBALS{'frs_venue'} = $infrs_venue;
$GLOBALS{'frs_awayvenue'} = $infrs_awayvenue;
$GLOBALS{'frs_time'} = $infrs_time;
$GLOBALS{'frs_timeend'} = $infrs_timeend;
$GLOBALS{'frs_info'} = $infrs_info;

Write_Data('frs',$inseason,$inteam_code,$infrs_id);
XPTXT('Fixture - "'.$infrs_id.'" updated');

Frs_TEAMFIXTURESUPDATE_Output($inseason, $inteam_code);

Back_Navigator();
PageFooter("Default","Final");
