<<<<<<< HEAD
<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Booking_MASTERSCHEDULERDISPLAY_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inseason = $_REQUEST['season'];
$inrequesteddate = $_REQUEST['requesteddate'];
$inmaxformseq = $_REQUEST['maxformseq'];
if ($inseason == "") { $inseason = $GLOBALS{'currperiodid'}; }
		
for ( $formseq=1; $formseq<=$inmaxformseq; $formseq++) {
	if ($_REQUEST['frs_oppo'.$formseq] != "") {
		$infrs_id = $_REQUEST['frs_id'.$formseq];
		$inteam_code = substr($infrs_id,0,2);
		Check_Data('team',$inseason,$inteam_code);
		/*
		$infrs_dateYYYY = $_REQUEST['frs_date'.$formseq.'_YYYYpart'];
		$infrs_dateMM = $_REQUEST['frs_date'.$formseq.'_MMpart'];
		$infrs_dateDD = $_REQUEST['frs_date'.$formseq.'_DDpart'];
		$infrs_date = $infrs_dateYYYY."-".$infrs_dateMM."-".$infrs_dateDD;
		*/				
		$infrs_oppo = $_REQUEST['frs_oppo'.$formseq];
		$infrs_ha = $_REQUEST['frs_ha'.$formseq];
		$infrs_lcf = $_REQUEST['frs_lcf'.$formseq];		
		$infrs_venue = $_REQUEST['frs_venue'.$formseq];
		$infrs_awayvenue = $_REQUEST['frs_awayvenue'.$formseq];		
		$infrs_time = StandardTime($_REQUEST['frs_time'.$formseq]);
		$infrs_timeend = StandardTime($_REQUEST['frs_timeend'.$formseq]);		
		$infrs_info = $_REQUEST['frs_info'.$formseq];

		if ($infrs_seq == "") { $infrs_seq = "1"; }
		
		Get_Data('frs',$inseason,$inteam_code,$infrs_id);
		$GLOBALS{'frs_oppo'} = $infrs_oppo;
		$GLOBALS{'frs_ha'} = $infrs_ha;
		$GLOBALS{'frs_lcf'} = $infrs_lcf;
		$GLOBALS{'frs_venue'} = $infrs_venue;
		$GLOBALS{'frs_awayvenue'} = $infrs_awayvenue;		
		$GLOBALS{'frs_time'} = $infrs_time;
		$GLOBALS{'frs_timeend'} = $infrs_timeend;		
		$GLOBALS{'frs_info'} = $infrs_info;
		
		Write_Data('frs',$inseason,$inteam_code,$infrs_id);
		XPTXT('Fixture - "'.$infrs_id.'" '.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' updated');
	}
}

Booking_MASTERSCHEDULERDISPLAY_Output($inseason, $inrequesteddate);

Back_Navigator();
PageFooter("Default","Final");
=======
<?php # frsteamselectionin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Booking_MASTERSCHEDULERDISPLAY_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inseason = $_REQUEST['season'];
$inrequesteddate = $_REQUEST['requesteddate'];
$inmaxformseq = $_REQUEST['maxformseq'];
if ($inseason == "") { $inseason = $GLOBALS{'currperiodid'}; }
		
for ( $formseq=1; $formseq<=$inmaxformseq; $formseq++) {
	if ($_REQUEST['frs_oppo'.$formseq] != "") {
		$infrs_id = $_REQUEST['frs_id'.$formseq];
		$inteam_code = substr($infrs_id,0,2);
		Check_Data('team',$inseason,$inteam_code);
		/*
		$infrs_dateYYYY = $_REQUEST['frs_date'.$formseq.'_YYYYpart'];
		$infrs_dateMM = $_REQUEST['frs_date'.$formseq.'_MMpart'];
		$infrs_dateDD = $_REQUEST['frs_date'.$formseq.'_DDpart'];
		$infrs_date = $infrs_dateYYYY."-".$infrs_dateMM."-".$infrs_dateDD;
		*/				
		$infrs_oppo = $_REQUEST['frs_oppo'.$formseq];
		$infrs_ha = $_REQUEST['frs_ha'.$formseq];
		$infrs_lcf = $_REQUEST['frs_lcf'.$formseq];		
		$infrs_venue = $_REQUEST['frs_venue'.$formseq];
		$infrs_awayvenue = $_REQUEST['frs_awayvenue'.$formseq];		
		$infrs_time = StandardTime($_REQUEST['frs_time'.$formseq]);
		$infrs_timeend = StandardTime($_REQUEST['frs_timeend'.$formseq]);		
		$infrs_info = $_REQUEST['frs_info'.$formseq];

		if ($infrs_seq == "") { $infrs_seq = "1"; }
		
		Get_Data('frs',$inseason,$inteam_code,$infrs_id);
		$GLOBALS{'frs_oppo'} = $infrs_oppo;
		$GLOBALS{'frs_ha'} = $infrs_ha;
		$GLOBALS{'frs_lcf'} = $infrs_lcf;
		$GLOBALS{'frs_venue'} = $infrs_venue;
		$GLOBALS{'frs_awayvenue'} = $infrs_awayvenue;		
		$GLOBALS{'frs_time'} = $infrs_time;
		$GLOBALS{'frs_timeend'} = $infrs_timeend;		
		$GLOBALS{'frs_info'} = $infrs_info;
		
		Write_Data('frs',$inseason,$inteam_code,$infrs_id);
		XPTXT('Fixture - "'.$infrs_id.'" '.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'}.' updated');
	}
}

Booking_MASTERSCHEDULERDISPLAY_Output($inseason, $inrequesteddate);

Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
