<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inevent_id = $_REQUEST['event_id'];
$inevent_attendeeref = $_REQUEST['event_attendeeref'];

Check_Data('event',$inevent_id);

DeleteEventAttendeeStatus ($inevent_attendeeref);
Write_Data('event',$inevent_id);

$attendeestatuslistelement = GetEventAttendeeStatus($inevent_attendeeref);
$xbits = explode('~',$attendeestatuslistelement);
if ( strlen(strstr($inevent_attendeeref,'|'))>0 ) {
	$abits = explode('|',$inevent_attendeeref);
	$thisfname = $abits[0];
	$thissname = $abits[1];
} else {
	Get_Data('person',$inevent_attendeeref);
	$thisfname = $GLOBALS{'person_fname'};
	$thissname = $GLOBALS{'person_sname'};
}
if ($GLOBALS{'event_personorteam'} == "Team") {
	XPTXTCOLOR('Team  "'.$xbits[1].'" entered  by '.$thisfname.' '.$thissname." removed from event","green");
} else {
	XPTXTCOLOR($thisfname.' '.$thissname." removed from event","green");
}

Booking_EVENTATTENDEEADMIN_Output($inevent_id);

XBR();XBR();
$link = YPGMLINK("bookingeventattendeeadminout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$inevent_id);
XLINKTXT($link,"administration for this event");
XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","EVENTADMINLIST");
XLINKTXT($link,"show my event list");

Back_Navigator();
PageFooter("Default","Final");


