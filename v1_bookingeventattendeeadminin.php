<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$inevent_id = $_REQUEST['event_id'];
Get_Data('event',$inevent_id);

$formseqmax = $_REQUEST["formseqmax"];
for ($formseq = 1; $formseq < $formseqmax; $formseq++) {
	$event_attendeeref = $_REQUEST[$formseq."_AttendeeRef"];
	$attendeestatuslistelement = GetEventAttendeeStatus($event_attendeeref);
	// XPTXT($attendeestatuslistelement." || ".$event_attendeeref."_paymentdue"." || ".$_REQUEST[$formseq."_paymentdue"]);
	if ($attendeestatuslistelement != "") { // record exists for this person
		if ($GLOBALS{'event_personorteam'} == "Team") {
			$parm1 = $_REQUEST[$formseq."_TeamName"];
			$parm2 = $_REQUEST[$formseq."_TeamMembers"];
		} else {
			$parm1 = $_REQUEST[$formseq."_EventPlacesRequired"];
			$parm2 = $_REQUEST[$formseq."_EventNamesRequired"];
		}
		$paymenttype = $_REQUEST[$formseq."_paymenttype"];
		$paymentdue = $_REQUEST[$formseq."_paymentdue"];	
		$paymentreceived = $_REQUEST[$formseq."_paymentreceived"];
		$paymentcomments = $_REQUEST[$formseq."_paymentcomments"];
		UpdateEventAttendeeStatus($event_attendeeref,$parm1,$parm2,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments);
		// XPTXT($inevent_attendeeref." updated");
	}	
}
Write_Data('event',$inevent_id);			
Booking_EVENTATTENDEEADMIN_Output ($inevent_id);

XBR();XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","EVENTADMINLIST");
XLINKTXT($link,"show my event list");


Back_Navigator();
PageFooter("Default","Final");
