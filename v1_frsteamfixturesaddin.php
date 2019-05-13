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
XH5($inseason." ".$inteam_code);

for ( $formseq=1; $formseq<21; $formseq++) {
	if ($_REQUEST['frs_oppo'.$formseq] != "") {
		// XH5($_REQUEST['frs_oppo'.$formseq]);
		$infrs_id = $_REQUEST['frs_id'.$formseq];
		$infrs_dateYYYY = $_REQUEST['frs_date'.$formseq.'_YYYYpart'];
		$infrs_dateMM = $_REQUEST['frs_date'.$formseq.'_MMpart'];
		$infrs_dateDD = $_REQUEST['frs_date'.$formseq.'_DDpart'];
		$infrs_date = $infrs_dateYYYY."-".$infrs_dateMM."-".$infrs_dateDD;				
		$infrs_seq = $_REQUEST['frs_seq'.$formseq];
		$infrs_oppo = $_REQUEST['frs_oppo'.$formseq];
		$infrs_ha = $_REQUEST['frs_ha'.$formseq];
		$infrs_lcf = $_REQUEST['frs_lcf'.$formseq];		
		$infrs_venue = $_REQUEST['frs_venue'.$formseq];
		$infrs_awayvenue = $_REQUEST['frs_awayvenue'.$formseq];		
		$infrs_time = StandardTime($_REQUEST['frs_time'.$formseq]);
		$infrs_timeend = StandardTime($_REQUEST['frs_timeend'.$formseq]);		
		$infrs_info = $_REQUEST['frs_info'.$formseq];
		
		if ($inseason == "") { $inseason = $GLOBALS{'currperiodid'}; }
		if ($infrs_seq == "") { $infrs_seq = "1"; }
		
		$GLOBALS{'frs_date'} = $infrs_date;
		$GLOBALS{'frs_seq'} = $infrs_seq;
		$GLOBALS{'frs_oppo'} = $infrs_oppo;
		$GLOBALS{'frs_ha'} = $infrs_ha;
		$GLOBALS{'frs_lcf'} = $infrs_lcf;
		$GLOBALS{'frs_venue'} = $infrs_venue;
		$GLOBALS{'frs_awayvenue'} = $infrs_awayvenue;		
		$GLOBALS{'frs_time'} = $infrs_time;
		$GLOBALS{'frs_timeend'} = $infrs_timeend;		
		$GLOBALS{'frs_info'} = $infrs_info;
		
		$infrs_id = $inteam_code.substr($infrs_dateYYYY,2,2).$infrs_dateMM.$infrs_dateDD.$infrs_seq;
		
		Write_Data('frs',$inseason,$inteam_code,$infrs_id);
		XPTXT('Fixture - "'.$infrs_id.'" updated');
	}
}

Frs_TEAMFIXTURESUPDATE_Output($inseason, $inteam_code);

Back_Navigator();
PageFooter("Default","Final");
