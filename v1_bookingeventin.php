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

// Get_Data("event",$inevent_id);

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
			if ( $GLOBALS{'person_email3'} != "" ) { $testperson_email = strtolower($GLOBALS{'person_email3'}); }
			else { $testperson_email = strtolower($GLOBALS{'person_email2'}); }			
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
		if ( $strongfoundcount == 1 ) { $ineventattendeeperson_id = $strongfoundevent_attendeeref; }
	} else {
		if ( $mediumfoundcount > 0 ) {
			if ( $mediumfoundcount == 1 ) { $ineventattendeeperson_id = $mediumfoundevent_attendeeref; }
		} else {
			if ( $weakfoundcount > 0 ) {
				if ( $weakfoundcount == 1 ) { $ineventattendeeperson_id = $weakfoundevent_attendeeref; }
			}
		}
	}
	if ( $ineventattendeeperson_id == "" ) { $inevent_attendeeref = $inevent_attendeefname."|".$inevent_attendeesname."|".$inevent_attendeeemail;	} 
	else { $inevent_attendeeref = $ineventattendeeperson_id; }
	
 
	XH3("Booking Details");	
	
	XPTXT("Booked by: ".$inevent_attendeefname." ".$inevent_attendeesname);
	if ( $ineventattendeeperson_id != "") {
		XPTXT("Personal Id: ".$ineventattendeeperson_id);
	}
	XPTXT("Email: ".$inevent_attendeeemail);
	if ($GLOBALS{'event_personorteam'} == "Team") {
		XPTXT("Team Name: ".$inevent_attendeeteamname);
		XPTXT("Team Members: ".$inevent_attendeeteammembers);
		if ($GLOBALS{'event_charge'} != 0) {
			XPTXT("Charge per team: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
			$event_totalcharge = $GLOBALS{'event_charge'};		
		}
		UpdateEventAttendeeStatus($inevent_attendeeref,$inevent_attendeeteamname,$inevent_attendeeteammembers,"",$event_totalcharge,"","");
	} else {
		XPTXT("Event Places Required: ".$inevent_attendeeeventplacesrequired);
		XPTXT("Names (optional): ".$inevent_attendeeeventnamesrequired);
		if ($GLOBALS{'event_discountpercent'} != "") {
			$numrequired = (int)$inevent_attendeeeventplacesrequired;
			$discountpercentstring = $GLOBALS{'event_discountpercent'};
			$discountpercentstring = str_replace('%', "", $discountpercentstring);
			$discountpercentnum = ((float)$discountpercentstring)/100;
			if ($numrequired >= $GLOBALS{'event_discountthreshold'} ) {
				$event_discountedcharge = $GLOBALS{'event_charge'}*(1-$discountpercentnum);
				$event_totalcharge = $GLOBALS{'event_charge'}*(int)$inevent_attendeeeventplacesrequired*(1-$discountpercentnum);
				XPTXT("Discounted Charge per Ticket: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($event_discountedcharge, 2, '.', ''));
				XPTXT("Total Charge: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($event_totalcharge, 2, '.', ''));
			} else {
				$event_totalcharge = $GLOBALS{'event_charge'}*(int)$inevent_attendeeeventplacesrequired;
				XPTXT("Charge per ticket: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
				XPTXT("Total Charge: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($event_totalcharge, 2, '.', ''));
			}
		} else {
			$event_totalcharge = $GLOBALS{'event_charge'}*(int)$inevent_attendeeeventplacesrequired;
			XPTXT("Charge per ticket: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
			XPTXT("Total Charge: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($event_totalcharge, 2, '.', ''));
		}
		UpdateEventAttendeeStatus($inevent_attendeeref,$inevent_attendeeeventplacesrequired,$inevent_attendeeeventnamesrequired,"",$event_totalcharge,"","");		
	}

	Write_Data('event',$inevent_id);		

	if ($GLOBALS{'event_charge'} == 0) {
		XH3("Thank You - We have reserved a place for you on the event - There is no charge for this event");
		$emailto = $inevent_attendeeemail;
		XH5("A confirmatory email has been sent to ".$emailto);
		Get_Data('person',$GLOBALS{'event_contact'});	
		$emailfrom = $GLOBALS{'person_email1'};
		$emailcc = ""; $emailbcc = "";
		$emailfooter1 = $GLOBALS{'domain_longname'};
		$emailfooter2 = "";
		$emailsubject = 'Your '.$GLOBALS{'event_title'}.' booking.';
		$mainmessage = 'This email is to confirm we have reserved a place for '.$GLOBALS{'event_attendeefname'}.' '.$GLOBALS{'event_attendeesname'}." on this event.<br><br>";
	
		$mainmessage = $mainmessage.'<b>Event</b> - '.$GLOBALS{'event_title'}."<br><br>";
		$mainmessage = $mainmessage.'<b>Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'})."<br><br>";
		$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'event_time'}."<br><br>";
		$mainmessage = $mainmessage.'<b>Cost</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($inevent_selectedcharge, 2, '.', '')."<br><br>";
		Check_Data('venue',$GLOBALS{'event_venuecode'});
		$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'venue_name'}."<br><br>";
		if ($GLOBALS{'event_personorteam'} == "Team") {
			$mainmessage = $mainmessage.'<b>Team Name</b> - '.$inevent_attendeeteamname."<br><br>";			
			$mainmessage = $mainmessage.'<b>Team Members</b> -</br>'.$inevent_attendeeteammembers."<br><br>";			
		} else {
			$mainmessage = $mainmessage.'<b>Event Places Required</b> - '.$inevent_attendeeteamname."<br><br>";
			$mainmessage = $mainmessage.'<b>Names (optional)</b> - '.$inevent_attendeeeventnamesrequired."<br><br>";
		}		
		$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
		if ($inevent_attendeefname == "Test") {
			Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		} else {
			HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		}
	
	} else {
		XH3("Thank you for providing us with participant details - Now proceed to payment");
		XFORM("bookingeventin2.php","eventin3");
		XINSTDHID();
		XINHID("event_id",$inevent_id);
		XINHID("event_attendeeref",$inevent_attendeeref);	
		XINHID("event_totalcharge",$event_totalcharge);
		XH5("Payment Method");
		$paymentoptionsa = explode(',',$GLOBALS{'event_paymentoptionslist'});
		foreach ($paymentoptionsa as $paymentoption) {
			if ($paymentoption == "Card") {
				$selected = "checked";
			} else { $selected = "";
			}
			XINRADIO('this_paymentoption', $paymentoption, $selected, $paymentoption);XBR();
		}
		XBR();
		XINSUBMIT("Continue");
		XBR();
		X_FORM();
	}
	
	$personid = $GLOBALS{'event_contact'};
	Check_Data('person', $personid);
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = ""; $emailbcc = "";
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'};
		$emailfooter2 = "";
		$emailsubject = 'New booking for '.$GLOBALS{'event_title'};
		$mainmessage = $inevent_attendeefname.' '.$inevent_attendeesname." has booked a place on this event.<br><br>";
		if ($GLOBALS{'event_personorteam'} == "Team") {
			$mainmessage = $mainmessage.'<b>Team Name</b> - '.$inevent_attendeeteamname."<br><br>";
			$mainmessage = $mainmessage.'<b>Team Members</b> -<br>'.$inevent_attendeeteammembers."<br><br>";
		} else {
			$mainmessage = $mainmessage.'<b>Event Places Required</b> - '.$inevent_attendeeteamname."<br><br>";
			$mainmessage = $mainmessage.'<b>Names (optional)</b> - '.$inevent_attendeeeventnamesrequired."<br><br>";
		}
		$emailcontent = $mainmessage."<br><br>Do not reply to this message.<br><br>";
		if ($inevent_attendeefname == "Test") {
			Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		} else {
			HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		}
	
	}	

}

Back_Navigator();
PageFooter("Default","Final");
