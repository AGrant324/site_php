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

$indraw_id = $_REQUEST['draw_id'];
$indrawtxn_personsname = $_REQUEST['SurName'];
$indrawtxn_personfname = $_REQUEST['FirstName'];
$indrawtxn_personemail = $_REQUEST['Email'];

Get_Data("draw",$indraw_id);

$indrawtxn_ticketquantity = $_REQUEST['DrawTicketQuantity'];

$originalperson_sname = $indrawtxn_personsname;
$originalperson_fname = $indrawtxn_personfname;
$inmatchsname = strtolower($indrawtxn_personsname);
$inmatchfname = strtolower($indrawtxn_personfname);
$inmatchemail = strtolower($indrawtxn_personemail);

Get_Data("draw",$indraw_id);

XH1("Raffle Ticket Booking - ".$GLOBALS{'draw_title'});
if (($indrawtxn_personsname == "")||($indrawtxn_personfname == "")||($indrawtxn_personemail == "")) {
	print "<P>No First Name, Surname or Email entered. Please try again.";
	Booking_DrawBooking_Output($indraw_id,$indrawtxn_personfname, $indrawtxn_personsname,$indrawtxn_personemail);
} else {

	$strongfounddraw_personref = "";
	$mediumfounddraw_personref = "";	
	$weakfounddraw_personref = "";	
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
			$strongfounddraw_personref = $tperson_id;
			$strongfoundcount++;
		}
		if ((($inmatchsname == $testperson_sname)&&($inmatchfname == $testperson_fname))||
            (($inmatchsname == $testperson_sname)&&($inmatchemail == $testperson_email))) {
			$mediumfounddraw_personref = $tperson_id;
			$mediumfoundcount++;
		}
		if ($inmatchemail == $testperson_email) {
			$weakfounddraw_personref = $tperson_id;
			$weakfoundcount++;
		}
	}	
	
	$indrawtxnperson_id = "";
	if ( $strongfoundcount > 0 ) { 
		if ( $strongfoundcount == 1 ) { $indrawtxnperson_id = $strongfounddraw_personref; }
	} else {
		if ( $mediumfoundcount > 0 ) {
			if ( $mediumfoundcount == 1 ) { $indrawtxnperson_id = $mediumfounddraw_personref; }
		} else {
			if ( $weakfoundcount > 0 ) {
				if ( $weakfoundcount == 1 ) { $indrawtxnperson_id = $weakfounddraw_personref; }
			}
		}
	}
	if ( $indrawtxnperson_id == "" ) { 
		XH5("Sorry: We cannot identify you as a club member");
	} else {

		
	$indrawtxn_personid = $indrawtxnperson_id;
	
 
	XH3("Booking Details");	
	
	XPTXT("Booked by: ".$indrawtxn_personfname." ".$indrawtxn_personsname);
	if ( $indrawtxnperson_id != "") {
		XPTXT("Personal Id: ".$indrawtxnperson_id);
	}
		XPTXT("Email: ".$indrawtxn_personemail);
		XPTXT("Raffle Tickets Required: ".$indrawtxn_ticketquantity);
		if ($GLOBALS{'draw_discountpercent'} != "") {
			$numrequired = (int)$indrawtxn_ticketquantity;
			$discountpercentstring = $GLOBALS{'draw_discountpercent'};
			$discountpercentstring = str_replace('%', "", $discountpercentstring);
			$discountpercentnum = ((float)$discountpercentstring)/100;
			if ($numrequired >= $GLOBALS{'draw_discountthreshold'} ) {
				$draw_discountedcharge = $GLOBALS{'draw_charge'}*(1-$discountpercentnum);
				$drawtxn_totalcharge = $GLOBALS{'draw_charge'}*$indrawtxn_ticketquantity*(1-$discountpercentnum);				
				XPTXT("Discounted Charge per Ticket: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($draw_discountedcharge, 2, '.', ''));
				XPTXT("Total Charge: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($drawtxn_totalcharge, 2, '.', ''));
			} else {
				$drawtxn_totalcharge = $GLOBALS{'draw_charge'}*$indrawtxn_ticketquantity;
				XPTXT("Charge per ticket: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'draw_charge'}, 2, '.', ''));				
				XPTXT("Total Charge: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($drawtxn_totalcharge, 2, '.', ''));				
			}
		} else {
			$drawtxn_totalcharge = $GLOBALS{'draw_charge'}*$indrawtxn_ticketquantity;
			XPTXT("Charge per ticket: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'draw_charge'}, 2, '.', ''));
			XPTXT("Total Charge: - ".$GLOBALS{'countrycurrencysymbol'}.number_format($drawtxn_totalcharge, 2, '.', ''));
		}
	
		XH3("Thank you  - Now proceed to payment");
		XFORM("bookingdrawin2.php","drawin3");
		XINSTDHID();
		XINHID("draw_id",$indraw_id);
		XINHID("drawtxn_personid",$indrawtxn_personid);
		
		
		
		XINHID("drawtxn_totalcharge",$drawtxn_totalcharge);
		XINHID("drawtxn_ticketquantity",$indrawtxn_ticketquantity);		
		XH5("Payment Method");
		$paymentoptionsa = explode(',',$GLOBALS{'draw_paymentoptionslist'});
		foreach ($paymentoptionsa as $paymentoption) {
			if ($paymentoption == "Card") {
				$selected = "checked";
			} else { $selected = "";
			}
			XINRADIO('drawtxn_paymentmethod', $paymentoption, $selected, $paymentoption);XBR();
		}
		XBR();
		XINSUBMIT("Continue");
		XBR();
		X_FORM();

	}	

}

Back_Navigator();
PageFooter("Default","Final");
