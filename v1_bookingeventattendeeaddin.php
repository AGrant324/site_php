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
$inevent_attendeesname = $_REQUEST['SurName'];
$inevent_attendeefname = $_REQUEST['FirstName'];
$inevent_attendeeemail = $_REQUEST['Email'];

Get_Data("event",$inevent_id);

if ($GLOBALS{'event_personorteam'} == "Team") {
	$inevent_attendeeteamname = $_REQUEST['TeamName'];
	$inevent_attendeeteammembers = $_REQUEST['TeamMembers'];
} else {
	$inevent_attendeeeventplacesrequired = $_REQUEST['EventPlacesRequired'];
	$inevent_attendeeeventnamesrequired = $_REQUEST['EventNamesRequired'];
}

$originalperson_sname = $inevent_attendeesname;
$originalperson_fname = $inevent_attendeefname;
$inmatchsname = strtolower($inevent_attendeesname);
$inmatchfname = strtolower($inevent_attendeefname);
$inmatchemail = strtolower($inevent_attendeeemail);

Get_Data("event",$inevent_id);

XH1("Event Booking - ".$GLOBALS{'event_title'});
if (($inevent_attendeesname == "")||($inevent_attendeefname == "")||($inevent_attendeeemail == "")) {
	print "<P>No First Name, Surname or Email entered. Please try again.";
	Booking_EventBooking_Output($inevent_id,$inevent_attendeefname, $inevent_attendeesname,$inevent_attendeeemail);
} else {

	$strongfoundevent_attendeeref = "";
	$mediumfoundevent_attendeeref = "";
	$weakfoundevent_attendeeref = "";
	$strongfoundcount = 0;
	$mediumfoundcount = 0;
	$weakfoundcount = 0;
	$persona = Get_Array('person');
	foreach ($persona as $tperson_id) {
		Get_Data("person",$tperson_id);
		$testperson_sname = strtolower($GLOBALS{'person_sname'});
		$testperson_fname = strtolower($GLOBALS{'person_fname'});
		if ( $GLOBALS{'person_email1'} != "" ) {
			$testperson_email = strtolower($GLOBALS{'person_email1'});
		} else {
			if ( $GLOBALS{'person_email3'} != "" ) {
				$testperson_email = strtolower($GLOBALS{'person_email3'});
			}
			else { $testperson_email = strtolower($GLOBALS{'person_email2'});
			}
		}
		if (($inmatchsname == $testperson_sname)&&($inmatchfname == $testperson_fname)&&($inmatchemail == $testperson_email)) {
			$strongfoundevent_attendeeref = $tperson_id;
			$strongfoundcount++;
		}
		if ((($inmatchsname == $testperson_sname)&&($inmatchfname == $testperson_fname))||
		(($inmatchsname == $testperson_sname)&&($inmatchemail == $testperson_email))) {
			$mediumfoundevent_attendeeref = $tperson_id;
			$mediumfoundcount++;
		}
		if ($inmatchemail == $testperson_email) {
			$weakfoundevent_attendeeref = $tperson_id;
			$weakfoundcount++;
		}
	}

	$ineventattendeeperson_id = "";
	if ( $strongfoundcount > 0 ) {
		if ( $strongfoundcount == 1 ) {
			$ineventattendeeperson_id = $strongfoundevent_attendeeref;
		}
	} else {
		if ( $mediumfoundcount > 0 ) {
			if ( $mediumfoundcount == 1 ) {
				$ineventattendeeperson_id = $mediumfoundevent_attendeeref;
			}
		} else {
			if ( $weakfoundcount > 0 ) {
				if ( $weakfoundcount == 1 ) {
					$ineventattendeeperson_id = $weakfoundevent_attendeeref;
				}
			}
		}
	}
	if ( $ineventattendeeperson_id == "" ) {
		$inevent_attendeeref = $inevent_attendeefname."|".$inevent_attendeesname."|".$inevent_attendeeemail;
	}
	else { $inevent_attendeeref = $ineventattendeeperson_id;
	}

	Get_Data('event',$inevent_id);
	if ($GLOBALS{'event_personorteam'} == "Team") {
		UpdateEventAttendeeStatus($inevent_attendeeref,$inevent_attendeeteamname,$inevent_attendeeteammembers,"",$GLOBALS{'event_charge'},"","");
		
	} else {
		UpdateEventAttendeeStatus($inevent_attendeeref,$inevent_attendeeeventplacesrequired,$inevent_attendeeeventnamesrequired,"",$GLOBALS{'event_charge'}*$inevent_attendeeeventplacesrequired,"","");
		
	}
	Write_Data('event',$inevent_id);
	
	if ($GLOBALS{'event_personorteam'} == "Team") {
		$mainmessage = $mainmessage.'<b>Team Name</b> - '.$inevent_attendeeteamname."<br><br>";
		$mainmessage = $mainmessage.'<b>Team Members</b> -</br>'.$inevent_attendeeteammembers."<br><br>";
		XPTXTCOLOR('Team Name - '.$inevent_attendeeteamname." added to event","green");
	} else {
		XPTXTCOLOR($inevent_attendeefname." ".$inevent_attendeesname." added to event","green");
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
	
}

Back_Navigator();
PageFooter("Default","Final");
