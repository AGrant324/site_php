<<<<<<< HEAD
<?php # bookingroutines.inc

function Booking_EventBooking_CSSJS () {
	// WHY
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_EventBooking_Output ($event_id,$fname,$sname,$email){
	XH1("Event Booking");
	Get_Data("event",$event_id);
	Webpage_WEBSTYLE_Output();
	XDIV($event_id,"eaclass" );
	XH2($GLOBALS{'event_title'});
	XTXT($GLOBALS{'event_excerpt'});
	if ($GLOBALS{'event_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT($GLOBALS{'event_description'});
	XBR();
	Check_Data("person",$GLOBALS{'event_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$showmobiletel = ""; $showemail = "";
		if ($GLOBALS{'person_mobiletel'} != "" ) {
			$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
		}
		if ($GLOBALS{'person_email1'} != "" ) {
			$showemail = "Email: ".$GLOBALS{'person_email1'};
		}
		XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
	} else {
		XTXT("Contact - ".$GLOBALS{'event_contact'});
	}
	XBR();
	XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
	XBR();
	XTXT("Time - ".$GLOBALS{'event_time'});
	XBR();
	Check_Data('venue',$GLOBALS{'event_venuecode'});
	XTXT("Venue - ".$GLOBALS{'venue_name'});		
	XBR();XBR();
	
	
	if ($GLOBALS{'event_full'} == "Yes") { XH4("Sorry this event is now fully booked."); }
	if ($GLOBALS{'event_personorteam'} == "Team") { XTXT("This is a team event").XBR(); }	
	
	if ($GLOBALS{'event_bookable'} == "Yes") {
		if ($GLOBALS{'event_charge'} != 0) {
			if ($GLOBALS{'event_personorteam'} == "Team") { 
				XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
			} else { 
				XTXT($chargetext.$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
				if ($GLOBALS{'event_discountpercent'} != "") {
					XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
				}				
			}
		}
	} else {
		if ($GLOBALS{'event_charge'} != 0) {
			if ($GLOBALS{'event_personorteam'} == "Team") { 
				XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
			} else { 
				XTXT($chargetext.$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
				if ($GLOBALS{'event_discountpercent'} != "") {
					XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
				}				
			}
		}
	}	
	
	XBR();XBR();

	
	X_DIV($event_id);
	XHR();
	XH1("Booking Details");
	XFORM("bookingeventin.php","eventin");
	XINMINHID();
	XINHID("event_id",$event_id);
	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Email');
	XINTXT("Email",$email,"50","100");
	XBR();XBR();	
	if ($GLOBALS{'event_personorteam'} == "Team") {			
		XH4('Team Name');
		XINTXT("TeamName","","50","100");
		XH4('Team Members (optional)');
		XINTEXTAREA("TeamMembers","","5","40");		
	} else {
		XH4('Event Places Required');
		XINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),"EventPlacesRequired",""); 
		XH4('Names (if more than one place required)');
		XINTEXTAREA("EventNamesRequired","","5","40");		
	}
	XBR();XBR();
	XINSUBMIT("Continue to Book Event");
	X_FORM();

}

function Booking_EventPayPalPayment_Output ($event_id, $event_attendeeref, $event_charge) {
	// XH4("$event_charge ".$event_charge);
	// if ($event_attendeeref == "bbra") { $event_charge = 1; }
	$eventcharge = floatval($event_charge);
	Get_Data("event",$event_id);
	Get_Data("eventcategory",$GLOBALS{'event_categoryid'});
	XH2("Debit/Credit Card Payment via PayPal") ;
	XBR();
	XTABLE();
	XTR();XTDTXT("Event");XTDTXT($GLOBALS{'event_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($eventcharge, 2, '.', ''));X_TR();
	X_TABLE();

	if ( strlen(strstr($event_attendeeref,'|'))>0 ) {
		$abits = explode('|',$event_attendeeref);
		$thisfname = $abits[0];
		$thissname = $abits[1];
		$thisaddr1 = "";
		$thisaddr2 = "";
		$thisaddr3 = "";
		$thisaddr4 = "";
		$thispostcode = "";
		$thisemail = $abits[2];
		$thistel = "";
	} else {
		Get_Data('person',$event_attendeeref);
		$thisfname = $GLOBALS{'person_fname'};
		$thissname = $GLOBALS{'person_sname'};
		$thisaddr1 = $GLOBALS{'person_addr1'};
		$thisaddr2 = $GLOBALS{'person_addr2'};
		$thisaddr3 = $GLOBALS{'person_addr3'};
		$thisaddr4 = $GLOBALS{'person_addr4'};
		$thispostcode = $GLOBALS{'person_postcode'};
		$thisemail = $GLOBALS{'person_email1'};
		if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email3'};}
		if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email2'};}
		$thistel = $GLOBALS{'person_mobiletel'};
		if ( $thistel == "" ) {
			$thistel = $GLOBALS{'person_emergencytel'};
		}
	}

	XH3("Proceed to make payment");
	XUL("","");
	XLI("","");XTXT('Please note that you dont have to have a paypal account... just use the option to pay with debit or credit card.');X_LI();
	XLI("","");XTXT("Check that the Card you are using matches the pre-populated address - or change the address to match the Card.");X_LI();
	XLI("","");XTXT('After payment select the "Return to Club" link on the final paypal screen to finalise your booking.');X_LI();
	X_UL();
	$paypalamount = number_format(($eventcharge*1.00), 2, '.', '');
	// if ($GLOBALS{'event_attendeeref'} == "abow") { $paypalamount = "1.00"; }
	if ($GLOBALS{'site_server'} != "W") {
		print'<form action="https://www.paypal.com/cgi-bin/webscr" method="post">'."\n"; // real
	} else {
		XFORM("paypalsimulation.php","paypalsimulation"); // simulation
		XINSTDHID();
	}
	XINHID('business',$GLOBALS{'eventcategory_paypalemail'});
	XINHID('cmd',"_xclick");
	XINHID('item_name',$GLOBALS{'event_title'}." - ".$thisfname." ".$thissname);
	// domain_id|purposetype|purposeref|personid|itemparm1|itemparm2|itemparm3
	$escaped_event_attendeeref = $event_attendeeref;
	$escaped_event_attendeeref = str_replace('@', 'AT', $escaped_event_attendeeref);
	$escaped_event_attendeeref = str_replace('|', 'PIPE', $escaped_event_attendeeref);		
	XINHID('item_number',$GLOBALS{'LOGIN_domain_id'}."|Event|".$event_id."|".$escaped_event_attendeeref."|".""."|".""."|"."");
	XINHID('first_name',$thisfname);
	XINHID('last_name',$thissname);
	XINHID('address1',$thisaddr1);
	XINHID('address2',$thisaddr2);
	XINHID('city',$thisaddr3);
	XINHID('state',$thisaddr4);
	XINHID('zip',$thispostcode);
	XINHID('email',$thisemail);
	$tbits = explode(" ",$thistel);
	XINHID('night_phone_a',"44");
	XINHID('night_phone_b',$tbits[0].$tbits[1]);
	XINHID('amount',$paypalamount);
	XINHID('currency_code',"GBP");
	$paypalsuccesslink = YPGMLINK("bookingeventpaypalsuccess.php");
	$paypalsuccesslink = $paypalsuccesslink.YPGMSTDPARMS();
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('event_id',$event_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('event_attendeeref',$escaped_event_attendeeref);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('event_selectedcharge',$eventcharge);
	$paypalcancellink = YPGMLINK("bookingeventpaypalcancel.php");
	$paypalcancellink = $paypalcancellink.YPGMSTDPARMS();
	$paypalcancellink = $paypalcancellink.YPGMPARM('event_id',$event_id);
	$paypalcancellink = $paypalcancellink.YPGMPARM('event_attendeeref',$escaped_event_attendeeref);
	$paypalcancellink = $paypalcancellink.YPGMPARM('event_selectedcharge',$eventcharge);
	XINHID('return',$paypalsuccesslink);
	XINHID('cancel_return',$paypalcancellink);
	// XINHID('cancel_return',$paypalsuccesslink); // testing
	
	print'<input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" alt="PayPal - The safer, easier way to pay online"> 	<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >';
	X_FORM();

}

function Booking_EventChequePayment_Output ($event_id, $event_attendeeref, $event_charge) {
	// XH4("$event_charge ".$event_charge);
	$eventcharge = floatval($event_charge);
	Get_Data("event",$event_id);
	Get_Data("eventcategory",$GLOBALS{'event_categoryid'});
	XH2("Payment by Cheque") ;
	XBR();XBR();
	XTABLE();
	XTR();XTDTXT("Event");XTDTXT($GLOBALS{'event_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($eventcharge, 2, '.', ''));X_TR();
	X_TABLE();

	$chequeamount = number_format(($eventcharge*1.00), 2, '.', '');
	XBR();XBR();
	XPTXT('Please make out a cheque for '.$GLOBALS{'countrycurrencysymbol'}.$chequeamount.' payable to "'.$GLOBALS{'eventcategory_bankaccountname'}.'" and mail it to the following address in order to confirm your place on the event');
	Get_Data('person',$GLOBALS{'eventcategory_treasurer'});
	XBR();XTXT($GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'});
	XBR();XTXT($GLOBALS{'person_addr1'});
	XBR();XTXT($GLOBALS{'person_addr2'});
	XBR();XTXT($GLOBALS{'person_addr3'});
	XBR();XTXT($GLOBALS{'person_addr4'});
	XBR();XTXT($GLOBALS{'person_postcode'});
	XBR();
	XPTXT("Thank you");
}

function Booking_EventCashPayment_Output ($event_id, $event_attendeeref, $event_charge) {
	// XH4("$event_charge ".$event_charge);
	$eventcharge = floatval($event_charge);
	Get_Data("event",$event_id);
	Get_Data("eventcategory",$GLOBALS{'event_categoryid'});
	XH2("Payment by Cash") ;
	XBR();
	XTABLE();
	XTR();XTDTXT("Event");XTDTXT($GLOBALS{'event_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($eventcharge, 2, '.', ''));X_TR();
	X_TABLE();
	XBR();
	$cashamount = number_format(($eventcharge*1.00), 2, '.', '');
	XPTXT('Please bring '.$GLOBALS{'countrycurrencysymbol'}.$cashamount.' and pay at the event');
	XBR();
	XPTXT("Thank you");
}


function Booking_EventBankTransferPayment_Output ($event_id, $event_attendeeref, $event_charge) {
	// XH4("eventchargein ".$eventchargein);
	$eventcharge = floatval($event_charge);
	Get_Data("event",$event_id);
	Get_Data("eventcategory",$GLOBALS{'event_categoryid'});
	XH2("Payment by Bank Transfer") ;
	XBR();XBR();
	XTABLE();
	XTR();XTDTXT("Event");XTDTXT($GLOBALS{'event_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($eventcharge, 2, '.', ''));X_TR();
	X_TABLE();

	$banktransferamount = number_format(($eventcharge*1.00), 2, '.', '');
	XBR();XBR();
	XPTXT('Please process a bank transfer for '.$GLOBALS{'countrycurrencysymbol'}.$banktransferamount.' to the following account in order to confirm your place on the event');
	XTABLE();
	XTR();XTDTXT("Account Name");XTDTXT($GLOBALS{'eventcategory_bankaccountname'});X_TR();
	XTR();XTDTXT("Sort Code");XTDTXT($GLOBALS{'eventcategory_banksort'});X_TR();
	XTR();XTDTXT("Account");XTDTXT($GLOBALS{'eventcategory_bankaccount'});X_TR();
	X_TABLE();
	XBR();
	XPTXT('Please also include your name in the payment reference so that we can identify it.');
	XBR();
	XPTXT("Thank you");
}




function Booking_EVENTADMINLIST_Output () {
	XH1("Bookable Events");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date");
	XTDHTXT("Admin");
	XTDHTXT("Report");
	X_TR();
	$event_ida = Get_Array('event');
	foreach ($event_ida as $event_id) {
		Get_Data("event",$event_id);
		if ($GLOBALS{'event_bookable'} == "Yes") {
			XTR();
			XTDTXT($event_id);
			XTDTXT($GLOBALS{'event_title'});
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
			$link = YPGMLINK("bookingeventattendeeadminout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id);
			XTDLINKTXT($link,"attendee administration");
			$link = YPGMLINK("bookingeventreport.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id);
			XTDLINKTXTNEWWINDOW($link,"printable report","report");
			X_TR();
		}
	}
	X_TABLE();
}

function Booking_EVENTATTENDEEADMIN_Output ($eventid) {
	Get_Data('event', $eventid);
	XH2('Event Attendees Administration - '.$GLOBALS{'event_title'});
	XBR();
	XFORM("bookingeventattendeeaddout.php","eventattendeeadd");
	XINSTDHID();
	XINHID("event_id",$eventid);
	XINSUBMIT("Add a New Event Attendee");
	X_FORM();
	XBR();
	XHR();	
	XFORM("bookingeventattendeeadminin.php","eventupdatein");
	XINSTDHID();
	XINHID("event_id",$eventid);
	XTABLE();
	XTR();
	XTDHTXT("Name");
	XTDHTXT("Email");
	if ($GLOBALS{'event_personorteam'} == "Team") {
		XTDHTXT("Team Name");
		XTDHTXT("Team Members");
	} else {
		XTDHTXT("Places<br>Requested");
		XTDHTXT("Names");
	}
	XTDHTXT("Payment<br>Due");
	XTDHTXT("Payment<br>Comments");
	XTDHTXT("Payment<br>Method");
	XTDHTXT("Payment<br>Received");
	XTDHTXT("Remove<br>from Event");	
	X_TR();

	$eventattendeestatusa = AttendeeStatus2Array($GLOBALS{'event_attendeestatuslist'});
	// $event_attendeeref,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	$formseq = 1;
	foreach ($eventattendeestatusa as $eventattendeestatuselement) {
		$attbits = explode('~',$eventattendeestatuselement);
		$event_attendeeref = $attbits[0];
		$parm1 = $attbits[1];
		$parm2 = $attbits[2];				
		$paymenttype = $attbits[3];
		$paymentdue = $attbits[4];
		$paymentreceived = $attbits[5];
		$paymentcomments = $attbits[6];
		XINHID($formseq."_AttendeeRef",$event_attendeeref);
		XTR();
		if ( strlen(strstr($event_attendeeref,'|'))>0 ) {
			$abits = explode('|',$event_attendeeref);
			$thisfname = $abits[0];
			$thissname = $abits[1];
			$thisemail = $abits[2];
		} else {
			Get_Data('person',$event_attendeeref);
			$thisfname = $GLOBALS{'person_fname'};
			$thissname = $GLOBALS{'person_sname'};
			$thisemail = $GLOBALS{'person_email1'};
			if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email3'};}
			if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email2'};}		
		}		
		XTDTXT($thisfname." ".$thissname);
		XTDTXT($thisemail);
		if ($GLOBALS{'event_personorteam'} == "Team") {
			XTDINTXT($formseq."_TeamName",$parm1,"20","80");			
			XTDINTEXTAREA($formseq."_TeamMembers",$parm2,"5","25");
		} else {
			XTDINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),$formseq."_EventPlacesRequired",$parm1);
			XTDINTEXTAREA($formseq."_EventNamesRequired",$parm2,"5","25");
		}
		XTDINTXT($formseq."_paymentdue",$paymentdue,"7","7");
		XTDINTXT($formseq."_paymentcomments",$paymentcomments,"20","80");
		XTDINSELECTHASH(List2Hash("Card,Cash,Cheque,BankTransfer"),$formseq."_paymenttype",$paymenttype);
		XTDINTXT($formseq."_paymentreceived",$paymentreceived,"7","7");
		$link = YPGMLINK("bookingeventattendeedeleteconfirm.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$eventid).YPGMPARM("event_attendeeref",$event_attendeeref);
		XTDLINKTXT($link,"remove");
		X_TR();
		$formseq++;
	}
	X_TABLE();
	XBR();XBR();
	XINHID("formseqmax",$formseq);
	XINSUBMIT("Update Event");
	X_FORM();
}

function Booking_EVENTATTENDEEDELETECONFIRM_Output ($event_id, $event_attendeeref) {
	Get_Data("event",$event_id);
	XH3("Remove Event Attendee - ".$GLOBALS{'event_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	
	$attendeestatuslistelement = GetEventAttendeeStatus($event_attendeeref);
	if ($attendeestatuslistelement != "") {
		$xbits = explode('~',$attendeestatuslistelement);
		if ( strlen(strstr($event_attendeeref,'|'))>0 ) {
			$abits = explode('|',$event_attendeeref);
			$thisfname = $abits[0];
			$thissname = $abits[1];
		} else {
			Get_Data('person',$event_attendeeref);
			$thisfname = $GLOBALS{'person_fname'};
			$thissname = $GLOBALS{'person_sname'};
		}
		if ($GLOBALS{'event_personorteam'} == "Team") {
			XPTXT('Are you sure you want to remove Team  "'.$xbits[1].'" entered  by '.$thisfname.' '.$thissname.' from this event?');
		} else {
			XPTXT('Are you sure you want to remove '.$thisfname.' '.$thissname.' from this event?');
		}
	}
	XBR();
	XFORM("bookingeventattendeedeleteaction.php","deleteattendee");
	XINSTDHID();
	XINHID("event_id",$event_id);
	XINHID("event_attendeeref",$event_attendeeref);
	XINSUBMIT("Confirm Remove");
	X_FORM();
	XBR();XBR();
	XINBUTTONBACK("Cancel");
}

function Booking_EVENTATTENDEEADD1_CSSJS () {
	// WHY	
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
	$GLOBALS{'SITEPOPUPHTML'} = "Calendar_Popup";	
}

function Booking_EVENTATTENDEEADD_Output ($event_id) {
	Get_Data('event',$event_id);
	XH3("Add New Event Attendee - ".$GLOBALS{'event_title'});
	XFORM("bookingeventattendeeaddin.php","eventattendeeaddin");
	XINSTDHID();
	XINHID("event_id",$event_id);

	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Email');
	XINTXT("Email",$email,"50","100");
	XBR();XBR();	
	if ($GLOBALS{'event_personorteam'} == "Team") {			
		XH4('Team Name');
		XINTXT("TeamName","","50","100");
		XH4('Team Members (optional)');
		XINTEXTAREA("TeamMembers","","5","40");		
	} else {
		XH4('Event Places Required');
		XINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),"EventPlacesRequired",""); 
		XH4('Names (if more than one place required)');
		XINTEXTAREA("EventNamesRequired","","5","40");		
	}
	XBR();XBR();
	XINSUBMIT("Add Attendee");
	X_FORM();
}

// ======================================================


/*
 XDIV("simpletablediv_SideBars","container");
 XTABLEJQDTID("simpletabletable_SideBars");
 XTHEAD();
 XTRJQDT();
 
 X_TR();
 X_THEAD();
 XTBODY();
 
 X_TBODY();
 X_TABLE();
 X_DIV("simpletablediv_SideBars");
 XCLEARFLOAT();
 */


function Booking_DRAWUPDATELIST_Output () {
	Get_Data("commsmasters");
	XH2("Raffle Composer");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XH4("How to create Raffles");
	XPTXT("You can create a new raffle or update one of your existing raffles.");
	XPTXT("Once you have created an raffle it will be submitted to the co-ordinator who will post it on the website, include it in a newsletter, or post it on facebook and twitter as requested.");
	XPTXT("Raffles can be composed in a draft status initially and then published.");
	XBR();
	XFORMUPLOAD("bookingdrawupdateout.php","newdraw");
	XINSTDHID();
	XINHID("draw_id","new");
	XINHID("menulist","drawupdatelist");
	XINSUBMIT("Create New Raffle");
	X_FORM();
	XBR();
	XBR();XBR();
	XDIV("simpletablediv_Raffles","container");
	XTABLEJQDTID("simpletabletable_Raffles");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date");
	XTDHTXT("Status");
	XTDHTXT("Contact");
	XTDHTXT("Featured<br>Image");
	XTDHTXT("Edit");
	XTDHTXT("Delete");
	XTDHTXT("WebView");
	XTDHTXT("FacebookView");
	X_TR();
	X_THEAD();
	XTBODY();

	$itemfound = "0";
	$draw_ida = Get_Array('draw');
	$draw_ida = array_reverse($draw_ida);
	foreach ($draw_ida as $draw_id) {
		Get_Data("draw",$draw_id);
		$canupdate = "0";
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'draw_createdbypersonid'}) {
			$canupdate = "1";
		}
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'draw_contact'}) {
			$canupdate = "1";
		}
		if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) {
			$canupdate = "1";
		}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_draweditorlist'})) {
			$canupdate = "1";
		}
		if ( $canupdate == "1") {
			$itemfound = "1";
			XTR();
			XTDTXT($draw_id);
			XTDTXT($GLOBALS{'draw_title'});
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
			if ($GLOBALS{'draw_publicationstatus'} == "") {
				XTDTXT($GLOBALS{'draw_publicationstatus'});
			}
			if ($GLOBALS{'draw_publicationstatus'} == "Draft") {
				XTD();XTXTCOLOR($GLOBALS{'draw_publicationstatus'},"red");X_TD();
			}
			if ($GLOBALS{'draw_publicationstatus'} == "Ready") {
				XTD();XTXTCOLOR($GLOBALS{'draw_publicationstatus'},"orange");X_TD();
			}
			if ($GLOBALS{'draw_publicationstatus'} == "Published") {
				XTD();XTXTCOLOR($GLOBALS{'draw_publicationstatus'},"green");X_TD();
			}
			XTDTXT($GLOBALS{'draw_contact'});
			if ($GLOBALS{'draw_featuredimage'} == "") {
				XTDTXT("");
			}
			else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'},"100");
			}
			$link = YPGMLINK("bookingdrawupdateout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id).YPGMPARM("menulist","drawupdatelist");
			XTDLINKTXT($link,"update");
			$link = YPGMLINK("bookingdrawdeleteconfirm.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id);
			XTDLINKTXT($link,"delete");
			$link = YPGMLINK("webpagedrawwebview.php");
			$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
			XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
			$link = YPGMLINK("webpagedrawfbview.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id);
			XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
			X_TR();
		}
	}
	X_TBODY();
	X_TABLE();
	X_DIV("simpletablediv_Raffles");
	XCLEARFLOAT();
	if ($itemfound == "0") {
		XH5("No raffles created by me so far");
	}
}

function Booking_DRAWDELETECONFIRM_Output ($draw_id) {
	Get_Data("draw",$draw_id);
	XH3("Delete Raffle - ".$draw_id." - ".$GLOBALS{'draw_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this raffle");
	XBR();
	XFORM("webpagedrawdeleteaction.php","deletedraw");
	XINSTDHID();
	XINHID("draw_id",$draw_id);
	XINSUBMIT("Confirm Raffle Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Booking_DRAWUPDATE_CSSJS () {
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,tinymcesliminit,tinymceslimreturnfromupload,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,tinyslimimagepopup,tinyformattedsectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,FormattedSection_Popups";	
}

function Booking_DRAWUPDATE_Output ($drawid, $menulist) {
	if ($drawid == "new") {
		Initialise_Data('draw');
		$GLOBALS{'draw_publicationstatus'} = "Draft";
		$draw_ida = Get_Array('draw');
		$highestdraw_id = "E00000";
		foreach ($draw_ida as $draw_id) {
			$highestdraw_id = $draw_id;
		}
		$highestdraw_seq = str_replace("E", "", $highestdraw_id);
		$highestdraw_seq++;
		$drawid = "E".substr(("00000".$highestdraw_seq), -5);
		XH2("Raffle Composer - New Raffle - ".$drawid);
	} else {
		Get_Data('draw', $drawid);
		XH2("Raffle Composer - ".$drawid." - ".$GLOBALS{'draw_title'});
	}
	// $helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;
	XFORMUPLOAD("bookingdrawupdatein.php","drawin");
	XINSTDHID();
	XINHID("draw_id",$drawid);
	XINHID("menulist",$menulist);
	XINHID("TinyMCEUploadTo","Draw");
	XINHID("TinyMCEUploadId",$drawid);
	XHR();
	XH2('Title');
	XINTXT("draw_title",$GLOBALS{'draw_title'},"50","100");
	XH2('Short excerpt.');
	XINTEXTAREA("draw_excerpt",$GLOBALS{'draw_excerpt'},"3","100");
	XH2('Full description of draw.');
	XINTEXTAREAMCE("draw_description",$GLOBALS{'draw_description'},"20","100");
	XH2('Featured Image.');
	XINHID("draw_featuredimage",$GLOBALS{'draw_featuredimage'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "draw_featuredimage";
	$imageviewwidth = "300";
	$imagename = $GLOBALS{'draw_featuredimage'};
	$imageuploadto = "Draw";
	$imageuploadid = $drawid;
	$imageuploadwidth = "800";
	$imageuploadheight = "flex";
	$imageuploadfixedsize = "";
	$imagethumbwidth = "200";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	XHR();
	XH2("Raffle Category");
	$xhash = Get_SelectArrays_Hash ("drawcategory","drawcategory_id","drawcategory_name","drawcategory_name","","" );
	XINSELECTHASH($xhash,"draw_drawcategoryid",$GLOBALS{'draw_drawcategoryid'});
	XH2("Raffle Schedule");
	XH4('Venue');
	$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
	XINSELECTHASH($xhash,"draw_venuecode",$GLOBALS{'draw_venuecode'});
	XH4('Date');
	XINDATEYYYY_MM_DD("draw_date",$GLOBALS{'draw_date'});
	XH4('Time');
	XINTXT("draw_time",$GLOBALS{'draw_time'},"10","50");
	XH4('Contact');
	XINTXTID("draw_contact","draw_contact",$GLOBALS{'draw_contact'},"50","100");
	XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
	XTXTID("draw_contactname",View_Person_List($GLOBALS{'draw_contact'}));
	XHR();
	XH2('Charges');
	XINTXT("draw_charge",$GLOBALS{'draw_charge'},"7","7");XTXT("Base charge per ticket.");XBR();
	XINTXT("draw_discountpercent",$GLOBALS{'draw_discountpercent'},"7","7");XTXT("Discount % (If offered)");XBR();	
	XINTXT("draw_discountthreshold",$GLOBALS{'draw_discountthreshold'},"7","7");XTXT("Discount Threshold (If offered)");XBR();
	XH4('Payment Method Options');
	$xhash = List2Hash("Card,Cheque,Cash,BankTransfer");
	XINCHECKBOXHASH ($xhash,"draw_paymentoptionslist",$GLOBALS{'draw_paymentoptionslist'});	
	XH2('Ticket Range');	
	XINTXT("draw_startrange",$GLOBALS{'draw_startrange'},"7","7");XTXT("Start of Range");XBR();	
	XINTXT("draw_endrange",$GLOBALS{'draw_endrange'},"7","7");XTXT("End of Range");XBR();
	XINCHECKBOXYESNO("course_full",$GLOBALS{'course_full'},"Raffle Closed");XBR();	
	XINTXT("draw_selectedrangelist",$GLOBALS{'draw_selectedrangelist'},"40","80");XTXT("Winning Ticket Numbers");XBR();		
	XH2('Terms and Conditions.');
	XINTEXTAREAMCE("draw_tsandcs",$GLOBALS{'draw_tsandcs'},"20","100");
	XHR();
	XH2('Publication Status');
	$canpublish = "0";
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'draw_createdbypersonid'}) {
		$canpublish = "1";
	}
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'draw_contact'}) {
		$canpublish = "1";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) {
		$canpublish = "1";
	}
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_draweditorlist'})) {
		$canpublish = "1";
	}
	if ( $GLOBALS{'draw_publicationstatus'} == "Published" ) {
		$canpublish = "1";
	}
	if ( $canpublish == "1" ) {
		$xhash = Lists2Hash("Draft,Ready,Published","Draft,Ready to Publish,Published");
	}
	else { $xhash = Lists2Hash("Draft,Ready","Draft,Ready to Publish");
	}
	XINRADIOHASH ($xhash,"draw_publicationstatus",$GLOBALS{'draw_publicationstatus'});XBR();
	XHR();
	XH2('Publication Channels Requested');
	XINCHECKBOXYESNO("draw_websiterequested",$GLOBALS{'draw_websiterequested'},"Website");
	XINCHECKBOXYESNO("draw_bulletinrequested",$GLOBALS{'draw_bulletinrequested'},"Bulletin Board");
	XINCHECKBOXYESNO("draw_newsletterrequested",$GLOBALS{'draw_newsletterrequested'},"Newsletter");
	XINCHECKBOXYESNO("draw_facebookrequested",$GLOBALS{'draw_facebookrequested'},"Facebook");
	XINCHECKBOXYESNO("draw_twitterrequested",$GLOBALS{'draw_twitterrequested'},"Twitter");
	XBR();
	XHR();
	XBR();
	XINSUBMIT("Update Raffle");
	X_FORM();

	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
	// Go_Back_To_RaffleArticleList;XBR();

	$GLOBALS{'PersonSelectPopupParameters'} = array(
		"this,person_id|person_sname|person_fname|person_section",
		"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
		"field,Lookup,Select,draw_contact,draw_contactname,100",
		"person_id",
		"all",
		"search,center,center,800,600",
	  	"view",
		"buildfulllist"
	);
}

function Booking_DrawBooking_CSSJS () {
	// WHY
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_DrawBooking_Output ($draw_id,$fname,$sname,$email){
	XH1("Raffle Booking");
	Get_Data("draw",$draw_id);
	Webpage_WEBSTYLE_Output();
	XDIV($draw_id,"eaclass" );
	XH2($GLOBALS{'draw_title'});
	XTXT($GLOBALS{'draw_excerpt'});
	if ($GLOBALS{'draw_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT($GLOBALS{'draw_description'});
	XBR();XBR();
	Check_Data("person",$GLOBALS{'draw_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) { 
		$showmobiletel = ""; $showemail = "";
		if ($GLOBALS{'person_mobiletel'} != "" ) { $showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'}; }
		if ($GLOBALS{'person_email1'} != "" ) { $showemail = "Email: ".$GLOBALS{'person_email1'}; }				
		XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
	} else {
		XTXT("Contact - ".$GLOBALS{'draw_contact'});	
	}
	XBR();
	XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
	XBR();
	XTXT("Time - ".$GLOBALS{'draw_time'});
	XBR();
	Check_Data('venue',$GLOBALS{'draw_venuecode'});
	XTXT("Venue - ".$GLOBALS{'venue_name'});
	XBR();XBR();
	if ($GLOBALS{'draw_full'} == "Yes") {
		XH5("Sorry this draw is now fully booked.");
	}
	XTXT("Charge per ticket - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'draw_charge'}, 2, '.', ''));
	if ($GLOBALS{'draw_discountpercent'} != "") {
		XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'draw_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'draw_discountpercent'}."%");
	}
	XBR();XBR();

	X_DIV($draw_id);
	XHR();
	XH1("Booking Details");
	XFORM("bookingdrawin.php","drawin");
	XINMINHID();
	XINHID("draw_id",$draw_id);
	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Email');
	XINTXT("Email",$email,"50","100");
	XBR();XBR();
	XH4('Tickets Required');
	XINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12,12,14,15,16,17,18,19,20,21,22,23,24"),"DrawTicketQuantity","");
	XBR();XBR();
	XINSUBMIT("Continue to Book Tickets");
	X_FORM();

}

function Booking_DrawPayPalPayment_Output ($draw_id, $drawtxn_id, $drawtxn_personid, $drawtxn_paymentdueamount) {
	// XH4("$draw_charge ".$draw_charge);
	$drawtxnpaymentdueamount = floatval($drawtxn_paymentdueamount);
	Get_Data("draw",$draw_id);
	Get_Data("drawcategory",$GLOBALS{'draw_drawcategoryid'});
	XH2("Debit/Credit Card Payment via PayPal") ;
	XBR();
	XTABLE();
	XTR();XTDTXT("Raffle");XTDTXT($GLOBALS{'draw_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'draw_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($drawtxnpaymentdueamount, 2, '.', ''));X_TR();
	X_TABLE();

	Get_Data('person',$drawtxn_personid);
	$thisfname = $GLOBALS{'person_fname'};
	$thissname = $GLOBALS{'person_sname'};
	$thisaddr1 = $GLOBALS{'person_addr1'};
	$thisaddr2 = $GLOBALS{'person_addr2'};
	$thisaddr3 = $GLOBALS{'person_addr3'};
	$thisaddr4 = $GLOBALS{'person_addr4'};
	$thispostcode = $GLOBALS{'person_postcode'};
	$thisemail = $GLOBALS{'person_email1'};
	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email3'}; }
	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email2'}; }
	$thistel = $GLOBALS{'person_mobiletel'};
	if ( $thistel == "" ) { $thistel = $GLOBALS{'person_emergencytel'}; }


	XH3("Proceed to make payment");
	XUL("","");
	XLI("","");XTXT('Please note that you dont have to have a paypal account... just use the option to pay with debit or credit card.');X_LI();
	XLI("","");XTXT("Check that the Card you are using matches the pre-populated address - or change the address to match the Card.");X_LI();
	XLI("","");XTXT('After payment select the "Return to Club" link on the final paypal screen to finalise your booking.');X_LI();
	X_UL();
	$paypalamount = number_format(($drawtxnpaymentdueamount*1.00), 2, '.', '');
	// if ($GLOBALS{'draw_attendeeref'} == "abow") { $paypalamount = "1.00"; }
	if ($GLOBALS{'site_server'} != "W") {
		print'<form action="https://www.paypal.com/cgi-bin/webscr" method="post">'."\n"; // real
	} else {
		XFORM("paypalsimulation.php","paypalsimulation"); // simulation
		XINSTDHID();
	}
	XINHID('business',$GLOBALS{'drawcategory_paypalemail'});
	XINHID('cmd',"_xclick");
	XINHID('item_name',$GLOBALS{'draw_title'}." - ".$thisfname." ".$thissname);
	// domain_id|purposetype|purposeref|personid|itemparm1|itemparm2|itemparm3
	XINHID('item_number',$GLOBALS{'LOGIN_domain_id'}."|Draw|".$draw_id."|".$drawtxn_id."|".""."|".""."|"."");
	XINHID('first_name',$thisfname);
	XINHID('last_name',$thissname);
	XINHID('address1',$thisaddr1);
	XINHID('address2',$thisaddr2);
	XINHID('city',$thisaddr3);
	XINHID('state',$thisaddr4);
	XINHID('zip',$thispostcode);
	XINHID('email',$thisemail);
	$tbits = explode(" ",$thistel);
	XINHID('night_phone_a',"44");
	XINHID('night_phone_b',$tbits[0].$tbits[1]);
	XINHID('amount',$paypalamount);
	XINHID('currency_code',"GBP");
	$paypalsuccesslink = YPGMLINK("bookingdrawpaypalsuccess.php");
	$paypalsuccesslink = $paypalsuccesslink.YPGMSTDPARMS();
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('draw_id',$draw_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('drawtxn_id',$drawtxn_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('drawtxn_paymentdueamount',$paypalamount);		
	$paypalcancellink = YPGMLINK("bookingdrawpaypalcancel.php");
	$paypalcancellink = $paypalcancellink.YPGMSTDPARMS();
	$paypalcancellink = $paypalcancellink.YPGMPARM('draw_id',$draw_id);
	$paypalcancellink = $paypalcancellink.YPGMPARM('drawtxn_id',$drawtxn_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('drawtxn_paymentdueamount',$paypalamount);	
	
	XINHID('return',$paypalsuccesslink);
	XINHID('cancel_return',$paypalcancellink);
	// XINHID('cancel_return',$paypalsuccesslink); // testing

	print'<input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" alt="PayPal - The safer, easier way to pay online"> 	<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >';
	X_FORM();

}

function Booking_DRAWADMINLIST_Output () {
	XH1("Raffle");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date");
	// XTDHTXT("Admin");
	XTDHTXT("Report");
	XTDHTXT("Web View");
	XTDHTXT("Facebook View");		
	X_TR();
	$draw_ida = Get_Array('draw');
	foreach ($draw_ida as $draw_id) {
		Get_Data("draw",$draw_id);
		XTR();
		XTDTXT($draw_id);
		XTDTXT($GLOBALS{'draw_title'});
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
		// $link = YPGMLINK("bookingdrawticketadminout.php");
		// $link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id);
		// XTDLINKTXT($link,"ticket administration");
		$link = YPGMLINK("bookingdrawreport.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id);
		XTDLINKTXTNEWWINDOW($link,"printable report","report");
		$link = YPGMLINK("webpagedrawwebview.php");		
		$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
		XTDLINKTXTNEWWINDOW($link,"Web View","report");		
		$link = YPGMLINK("webpagedrawfbview.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
		XTDLINKTXTNEWWINDOW($link,"Web View","report");		
		X_TR();
	}
	X_TABLE();
}

function Booking_SETUPDRAWCATEGORY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Booking_SETUPDRAWCATEGORY_Output() {
	$parm0 = "Draw Category|drawcategory|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|drawcategory_id|drawcategory_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."drawcategory_id|Yes|Category|120|Yes|Draw Category|KeyText,12,12^";
	$parm1 = $parm1."drawcategory_name|Yes|Title|150|Yes|Title|InputText,50,90^";
	$parm1 = $parm1."drawcategory_treasurer|No|||Yes|Treasurer|InputPerson,10,20,Treasurer,Lookup^";
	$parm1 = $parm1."drawcategory_banksort|No||30|Yes|Bank Sort Code|InputText,8,8^";
	$parm1 = $parm1."drawcategory_bankaccount|No||30|Yes|Bank Account Code|InputText,8,8^";
	$parm1 = $parm1."drawcategory_bankaccountname|No||30|Yes|Bank Account Name|InputText,25,50^";
	$parm1 = $parm1."drawcategory_paypalemail|No||30|Yes|Pay Pal Email|InputText,25,50^";
	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Treasurer,Treasurer..,drawcategory_treasurer_input,drawcategory_treasurer_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "drawcategory,center,center,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Booking_DRAWUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,slimjquerymin,slimimagepopup,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
		
}

function Booking_DRAWUTILITY_Output() {
	$parm0 = "Raffles|draw|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section],drawcategory,venue|draw_id|draw_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."draw_id|Yes|Draw Id|70|Yes|Draw Id|KeyGenerated,D[00000]^";
	$parm1 = $parm1."draw_drawcategoryid|Yes|Category|80|Yes|Category|InputSelectFromTable,drawcategory,drawcategory_id,drawcategory_name,drawcategory_id^";
	$parm1 = $parm1."draw_priority|Yes|Seq|100|Yes|Seq|InputText,5,10^";	
	$parm1 = $parm1."draw_title|Yes|Title|100|Yes|Draw Title|InputText,25,50^";
	$parm1 = $parm1."draw_excerpt|No||40|Yes|Draw Excerpt|InputTextArea,3,50^";	
	$parm1 = $parm1."draw_description|No||40|Yes|Draw Description|InputTextArea,10,50^";
	$parm1 = $parm1."draw_date|Yes|Date|80|Yes|Draw Date|InputDate^";
	$parm1 = $parm1."draw_time|Yes|Time|80|Yes|Draw Time|InputText,5,10^";	
	$parm1 = $parm1."draw_contact|Yes|Contact|60|Yes|Event Contact|InputPerson,10,20,Contact,Lookup^";
	$parm1 = $parm1."draw_featuredimage|Yes|Photo|60|Yes|Featured Image|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,600,flex,Event,draw_id^";
	// $parm1 = $parm1."draw_featuredimagecaption|No||40|Yes|Featured Image Caption|InputText,25,50^";
	$parm1 = $parm1."draw_full||||Yes|Draw Full|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."draw_tsandcs|No||40|Yes|Terms and Conditions|InputTextArea,10,50^";
	$parm1 = $parm1."draw_charge||||Yes|Charge|InputText,7,7^";
	$parm1 = $parm1."draw_discountpercent||||Yes|Discount %|InputText,7,7^";
	$parm1 = $parm1."draw_discountthreshold||||Yes|Discount Threshold Quantity|InputText,7,7^";		
	$parm1 = $parm1."draw_paymentoptionslist||||Yes|Payment Options|InputSelectFromList,Card+Cash+Cheque+BankTransfer+None^";
	$parm1 = $parm1."draw_venuecode||||Yes|Booking Venue|InputSelectFromTable,venue,venue_code,venue_name,venue_code^";
	$parm1 = $parm1."draw_createdbypersonid|No||40|Yes|Event Created By|InputPerson,10,20,CreatedBy,Lookup^";
	$parm1 = $parm1."draw_startrange|Yes|Start|60|Yes|Start Range|InputText,7,7^";	
	$parm1 = $parm1."draw_endrange|Yes|End|60|Yes|End Range|InputText,7,7^";	
	$parm1 = $parm1."draw_selectedrangelist||||Yes|Selected|InputText,7,7^";	
	$parm1 = $parm1."draw_publicationstatus|Yes|Status|60|Yes|Publication Status|InputSelectFromList,Draft+Ready+Published^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);

	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Contact,Contact..,draw_contact_input,draw_contact_personlist,50|field,CreatedBy,CreatedBy..,draw_updatepersonidlist_input,draw_updatepersonidlist_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "draw_utility,50,50,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);

}

function Booking_DRAWTXNUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_DRAWTXNUTILITY_Output($drawid) {
	$parm0 = "Draw Transactions|drawtxn[rootkey=".$drawid."]|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|drawtxn_id|drawtxn_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."drawtxn_id|Yes|Transaction Number|70|Yes|Transaction Number|KeyGenerated,DT[00000]^";
	$parm1 = $parm1."drawtxn_personid|Yes|Person|60|Yes|Person|InputPerson,10,20,Person,Lookup^";	
	$parm1 = $parm1."drawtxn_paymentduedate|Yes|Due Date|80|Yes|Due Date|InputDate^";	
	$parm1 = $parm1."drawtxn_paymentdueamount|Yes|Due Amount|70|Yes|Due Amount|InputText,7,7^";	
	$parm1 = $parm1."drawtxn_paymentdate|Yes|Paid Date|80|Yes|Paid Date|InputDate^";
	$parm1 = $parm1."drawtxn_paymentamount|Yes|Amount|70|Yes|Amount|InputText,7,7^";
	$parm1 = $parm1."drawtxn_paymentmethod||||Yes|Payment Options|InputSelectFromList,Card+Cash+Cheque+BankTransfer+None^";
	$parm1 = $parm1."drawtxn_quantity|Yes|Quantity|70|Yes|Quantity|InputText,7,7^";	
	$parm1 = $parm1."drawtxn_startrange|Yes|Start|70|Yes|Start Range|InputText,7,7^";	
	$parm1 = $parm1."drawtxn_endrange|Yes|End|70|Yes|End Range|InputText,7,7^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);

	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Person,Person..,drawtxn_personid_input,drawtxn_personid_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "drawtxn_utility,50,50,900,900";
	$p6 =  "view";
	$p7 =  "singlereplacelist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);

}

// =======================================================

function Booking_CourseBooking_CSSJS () {
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_CourseBooking_Output ($course_id,$fname,$sname,$dob){
	XH1("Course Booking");
	Get_Data("course",$course_id);
	Webpage_WEBSTYLE_Output();
	XDIV($course_id,"eaclass" );
	XH2($GLOBALS{'course_title'});
	XTXT($GLOBALS{'course_excerpt'});
	if ($GLOBALS{'course_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT($GLOBALS{'course_description'});
	XBR();
	Check_Data("person",$GLOBALS{'course_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$showmobiletel = ""; $showemail = "";
		if ($GLOBALS{'person_mobiletel'} != "" ) {
			$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
		}
		if ($GLOBALS{'person_email1'} != "" ) {
			$showemail = "Email: ".$GLOBALS{'person_email1'};
		}
		XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
	} else {
		XTXT("Contact - ".$GLOBALS{'course_contact'});
	}
	XBR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
	} else {
		XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));
	}
	XBR();
	XTXT("Time - ".$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'});
	XBR();
	XTXT("Venue - ".$GLOBALS{'course_venue'});	
	XBR();XBR();
	if ($GLOBALS{'course_charge'} == 0) {
		XTXT("Free of Charge");
	} else {
		XTXT("Charge - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_charge'}, 2, '.', ''));
		if ( $GLOBALS{'course_prepaidcharge'} != 0 ) { XTXT(" : If pre-paid online - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_prepaidcharge'}, 2, '.', '')); }
		if ( $GLOBALS{'course_earlycharge'} != 0 ) { XTXT(" : If pre-paid online before - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_earlychargedate'})." - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_earlycharge'}, 2, '.', '')); }
	}
	if ($GLOBALS{'course_partchargepermitted'} == "Yes") {
		XPTXT($GLOBALS{'course_partchargeinstructions'});		
	}

	XBR();XBR();
	
	XH4("Course Requirements");
	XPTXT($GLOBALS{'course_requirements'});
	// XH4("Course Ternms and Conditions");
	// XPTXT($GLOBALS{'course_tsandcs'});	
	
	X_DIV($course_id);
	XHR();
	XH1("Booking Details");
	XFORM("bookingcoursein.php","coursein");
	XINMINHID();
	XINHID("course_id",$course_id);
	
	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Date of Birth (dd/mm/yyyy)');
	XINDATEYYYY_MM_DD_AGE("DOB",$dob);
	XBR();XBR();
	XINSUBMIT("Continue to Book Course");
	X_FORM();

}

function Booking_CoursePayPalPayment_Output ($course_id, $courseattendee_id, $this_fullcourseselected, $this_partchargecomments, $coursechargein) {
	// XH4("coursechargein ".$coursechargein);
	$coursecharge = floatval($coursechargein);
	Get_Data("course",$course_id);	
	Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
	Get_Data("courseattendee",$courseattendee_id);
	XH2("Debit/Credit Card Payment via PayPal") ;	
	XBR();
	XTABLE();
	XTR();XTDTXT("Course");XTDTXT($GLOBALS{'course_title'});X_TR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'}));X_TR();
	} else {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'}));X_TR();
	}
	XTR();XTDTXT("Booking");
	if ($this_fullcourseselected == "Yes") { XTDTXT("Full Payment"); }
	if ($this_fullcourseselected == "No") { XTDTXT("Reduced Payment"); }
	X_TR();
	
	if ($this_fullcourseselected == "No") {
		XTR();XTDTXT("Comments");XTDTXT($this_partchargecomments);X_TR();			
	}
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));X_TR();
	X_TABLE();
	
	XH3("Proceed to make payment");
	XUL("","");
	XLI("","");XTXT('Please note that you dont have to have a paypal account... just use the option to pay with debit or credit card.');X_LI();
	XLI("","");XTXT("Check that the Card you are using matches the pre-populated address - or change the address to match the Card.");X_LI();
	XLI("","");XTXT('After payment select the "Return to Club" link on the final paypal screen to finalise your booking.');X_LI();
	X_UL();
	$paypalamount = number_format(($coursecharge*1.00), 2, '.', '');
	// if ($GLOBALS{'courseattendee_id'} == "abow") { $paypalamount = "1.00"; }
	if ($GLOBALS{'site_server'} != "W") {
		print'<form action="https://www.paypal.com/cgi-bin/webscr" method="post">'."\n"; // real
	} else {
		XFORM("paypalsimulation.php","paypalsimulation"); // simulation
		XINSTDHID();
	}
	XINHID('business',$GLOBALS{'coursecategory_paypalemail'});
	XINHID('cmd',"_xclick");
	XINHID('item_name',$GLOBALS{'course_title'}." - ".$GLOBALS{'courseattendee_fname'}." ".$GLOBALS{'courseattendee_sname'});
	// domain_id|purposetype|purposeref|personid|itemparm1|itemparm2|itemparm3
	XINHID('item_number',$GLOBALS{'LOGIN_domain_id'}."|Course|".$course_id."|".$courseattendee_id."|".""."|".""."|"."");
	if ($GLOBALS{'courseattendee_parentfname'} != "") {	XINHID('first_name',$GLOBALS{'courseattendee_parentfname'}); }
	else {XINHID('first_name',$GLOBALS{'courseattendee_fname'}); }
	if ($GLOBALS{'courseattendee_parentsname'} != "") {	XINHID('last_name',$GLOBALS{'courseattendee_parentsname'}); }
	else {XINHID('last_name',$GLOBALS{'courseattendee_sname'}); }
	XINHID('address1',$GLOBALS{'courseattendee_addr1'});
	XINHID('address2',$GLOBALS{'courseattendee_addr2'});
	XINHID('city',$GLOBALS{'courseattendee_addr3'});
	XINHID('state',$GLOBALS{'courseattendee_addr4'});
	XINHID('zip',$GLOBALS{'courseattendee_postcode'});
	XINHID('email',$GLOBALS{'courseattendee_email'});
	if ($GLOBALS{'courseattendee_emergencytel'} != "") {
		if ($GLOBALS{'courseattendee_emergencytel'} == "0") {
			// well formed phone number
			$tbits = explode(" ",$GLOBALS{'courseattendee_emergencytel'});
			XINHID('night_phone_a',"44");
			XINHID('night_phone_b',$tbits[0].$tbits[1]);
		}
	}
	XINHID('amount',$paypalamount);
	XINHID('currency_code',"GBP");
	$paypalsuccesslink = YPGMLINK("bookingcoursepaypalsuccess.php");
	$paypalsuccesslink = $paypalsuccesslink.YPGMSTDPARMS();
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('course_id',$course_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('courseattendee_id',$courseattendee_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('course_selectedcharge',$coursecharge);	
	$paypalcancellink = YPGMLINK("bookingcoursepaypalcancel.php");
	$paypalcancellink = $paypalcancellink.YPGMSTDPARMS();	
	$paypalcancellink = $paypalcancellink.YPGMPARM('course_id',$course_id);
	$paypalcancellink = $paypalcancellink.YPGMPARM('courseattendee_id',$courseattendee_id);
	$paypalcancellink = $paypalcancellink.YPGMPARM('course_selectedcharge',$coursecharge);	
	XINHID('return',$paypalsuccesslink);
	XINHID('cancel_return',$paypalcancellink);
	// XINHID('cancel_return',$paypalsuccesslink); // testing
			
	print'<input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" alt="PayPal - The safer, easier way to pay online"> 	<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >';
	X_FORM();

}

function Booking_CourseChequePayment_Output ($course_id, $courseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thiscoursecharge) {
	// XH4("coursechargein ".$coursechargein);
	$coursecharge = floatval($thiscoursecharge);
	Get_Data("course",$course_id);	
	Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
	Get_Data("courseattendee",$courseattendee_id);
	XH2("Payment by Cheque") ;	
	XBR();XBR();
	XTABLE();
	XTR();XTDTXT("Course");XTDTXT($GLOBALS{'course_title'});X_TR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'}));X_TR();
	} else {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'}));X_TR();
	}
	XTR();XTDTXT("Booking");
	if ($this_fullcourseselected == "Yes") { XTDTXT("Full Payment"); }
	if ($this_fullcourseselected == "No") { XTDTXT("Reduced Payment"); }
	X_TR();
	
	if ($this_fullcourseselected == "No") {
		XTR();XTDTXT("Comments");XTDTXT($this_partchargecomments);X_TR();			
	}
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));X_TR();
	X_TABLE();
	
	$chequeamount = number_format(($coursecharge*1.00), 2, '.', '');
	XBR();XBR();
	XPTXT('Please make out a cheque for '.$GLOBALS{'countrycurrencysymbol'}.$chequeamount.' payable to "'.$GLOBALS{'coursecategory_bankaccountname'}.'" and mail it to the following address in order to confirm your place on the course'); 
	Get_Data('person',$GLOBALS{'coursecategory_treasurer'});
	XBR();XTXT($GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'});	
	XBR();XTXT($GLOBALS{'person_addr1'});	
	XBR();XTXT($GLOBALS{'person_addr2'});	
	XBR();XTXT($GLOBALS{'person_addr3'});	
	XBR();XTXT($GLOBALS{'person_addr4'});	
	XBR();XTXT($GLOBALS{'person_postcode'});
	XBR();
	XPTXT("Thank you");
}

function Booking_CourseCashPayment_Output ($course_id, $courseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thiscoursecharge) {
	// XH4("coursechargein ".$coursechargein);
	$coursecharge = floatval($thiscoursecharge);
	Get_Data("course",$course_id);	
	Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
	Get_Data("courseattendee",$courseattendee_id);
	XH2("Payment by Cash") ;	
	XBR();
	XTABLE();
	XTR();XTDTXT("Course");XTDTXT($GLOBALS{'course_title'});X_TR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'}));X_TR();
	} else {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'}));X_TR();
	}
	XTR();XTDTXT("Booking");
	if ($this_fullcourseselected == "Yes") { XTDTXT("Full Payment"); }
	if ($this_fullcourseselected == "No") { XTDTXT("Reduced Payment"); }
	X_TR();
	
	if ($this_fullcourseselected == "No") {
	    XTR();XTDTXT("Comments");XTDTXT($this_partchargecomments);X_TR();
	}
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));X_TR();
	X_TABLE();
	XBR();
	$cashamount = number_format(($coursecharge*1.00), 2, '.', '');
	XPTXT('Please bring '.$GLOBALS{'countrycurrencysymbol'}.$cashamount.' to the first day of the course');
	XBR();
	XPTXT("Thank you");
}

function Booking_CourseBankTransferPayment_Output ($course_id, $courseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thiscoursecharge) {
	// XH4("coursechargein ".$coursechargein);
	$coursecharge = floatval($thiscoursecharge);
	Get_Data("course",$course_id);
	Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
	Get_Data("courseattendee",$courseattendee_id);
	XH2("Payment by Bank Transfer") ;
	XBR();XBR();
	XTABLE();
	XTR();XTDTXT("Course");XTDTXT($GLOBALS{'course_title'});X_TR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'}));X_TR();
	} else {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'}));X_TR();
	}
	XTR();XTDTXT("Booking");
	if ($this_fullcourseselected == "Yes") { XTDTXT("Full Payment"); }
	if ($this_fullcourseselected == "No") { XTDTXT("Reduced Payment"); }
	X_TR();
	
	if ($this_fullcourseselected == "No") {
	    XTR();XTDTXT("Comments");XTDTXT($this_partchargecomments);X_TR();
	}
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));X_TR();
	X_TABLE();

	$banktransferamount = number_format(($coursecharge*1.00), 2, '.', '');
	XBR();XBR();
	XPTXT('Please process a bank transfer for '.$GLOBALS{'countrycurrencysymbol'}.$banktransferamount.' to the following account in order to confirm your place on the course');
	XTABLE();
	XTR();XTDTXT("Account Name");XTDTXT($GLOBALS{'coursecategory_bankaccountname'});X_TR();
	XTR();XTDTXT("Sort Code");XTDTXT($GLOBALS{'coursecategory_banksort'});X_TR();	
	XTR();XTDTXT("Account");XTDTXT($GLOBALS{'coursecategory_bankaccount'});X_TR();	
	X_TABLE();	
	XBR();	
	XPTXT('Please also include your name in the payment reference so that we can identify it.');		
	XBR();
	XPTXT("Thank you");
}

function Booking_COURSEADMINLIST_Output () {
	XH1("Courses");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date Start");
	XTDHTXT("Date End");	
	XTDHTXT("Manage Payments");
	XTDHTXT("View/Add/Remove Attendees");	
	XTDHTXT("Report");	
	X_TR();
	$course_ida = Get_Array('course');
	foreach ($course_ida as $course_id) {
		Get_Data("course",$course_id);
		XTR();
		XTDTXT($course_id);
		XTDTXT($GLOBALS{'course_title'});
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));		
		$link = YPGMLINK("bookingcoursepaymentadminout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXT($link,"manage payments");
		$link = YPGMLINK("bookingcourseattendeeadminout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXT($link,"view/add/remove attendees");		
		$link = YPGMLINK("bookingcoursereport.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXTNEWWINDOW($link,"printable report","report");
		X_TR();
	}
	X_TABLE();
}

function Booking_COURSEPAYMENTADMIN_Output ($courseid) {
	Get_Data('course', $courseid);
	XH3('Manage Attendee Payments - '.$GLOBALS{'course_title'});
	
	XFORM("bookingcoursepaymentadminin.php","courseupdatein");
	XINSTDHID();
	XINHID("course_id",$courseid);
	XTABLE();
	XTR();
	XTDHTXT("First Name");
	XTDHTXT("Last Name");
	XTDHTXT("Age");
	XTDHTXT("Emergency Tel");
	XTDHTXT("Email");
	XTDHTXT("Payment<br>Due");
	XTDHTXT("Payment<br>Comments");
	XTDHTXT("Payment<br>Method");
	XTDHTXT("Payment<br>Received");		
	X_TR();
	
	$courseattendeestatusa = AttendeeStatus2Array($GLOBALS{'course_attendeestatuslist'});
	// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	foreach ($courseattendeestatusa as $courseattendeestatuselement) {
		$attbits = explode('~',$courseattendeestatuselement);
		$courseattendeeid = $attbits[0];
		$paymenttype = $attbits[1];
		$paymentdue = $attbits[2];
		$paymentreceived = $attbits[3];
		$paymentcomments = $attbits[4];
		Check_Data("courseattendee",$courseattendeeid);	
		XTR();
		if ($GLOBALS{'IOWARNING'} == "0") {
			XTDTXT($GLOBALS{'courseattendee_fname'});
			XTDTXT($GLOBALS{'courseattendee_sname'});
			$underage = UnderAge(18,$GLOBALS{'courseattendee_dob'});
			if ($underage) { XTDTXT(Age($GLOBALS{'courseattendee_dob'},19)); }
			else { XTDTXT(""); }
			XTDTXT($GLOBALS{'courseattendee_emergencytel'});
			XTDTXT($GLOBALS{'courseattendee_email'});
			XTDINTXT($courseattendeeid."_paymentdue",$paymentdue,"7","7");
			XTDINTXT($courseattendeeid."_paymentcomments",$paymentcomments,"20","80");		
			XTDINSELECTHASH(List2Hash("Card,Cash,Cheque,BankTransfer"),$courseattendeeid."_paymenttype",$paymenttype); 
			XTDINTXT($courseattendeeid."_paymentreceived",$paymentreceived,"7","7");
		} else {
			XTDTXT($courseattendeeid);
			XTDTXT("Not Found");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");	
			XTDTXT("");
		}
		X_TR();
	}
	X_TABLE();
	XBR();XBR();
	XINSUBMIT("Update Payments");
	X_FORM();
}

function Booking_COURSEATTENDEEADMIN_Output ($courseid) {
	Get_Data('course', $courseid);
	XH2('View/Add/Remove Attendees - '.$GLOBALS{'course_title'});
	XBR();
	XFORM("bookingcourseattendeeaddout.php","courseattendeeadd");
	XINSTDHID();
	XINHID("course_id",$courseid);
	XINSUBMIT("Add a New Course Attendee");
	X_FORM();
	XBR();
	XHR();	
	XTABLE();
	XTR();
	XTDHTXT("First Name");
	XTDHTXT("Last Name");
	XTDHTXT("Age");
	XTDHTXT("Emergency Tel");
	XTDHTXT("Email");
	XTDHTXT("Remove from course");
	X_TR();

	$courseattendeestatusa = AttendeeStatus2Array($GLOBALS{'course_attendeestatuslist'});
	// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	foreach ($courseattendeestatusa as $courseattendeestatuselement) {
		$attbits = explode('~',$courseattendeestatuselement);
		$courseattendeeid = $attbits[0];
		$paymenttype = $attbits[1];
		$paymentdue = $attbits[2];
		$paymentreceived = $attbits[3];
		$paymentcomments = $attbits[4];
		Check_Data("courseattendee",$courseattendeeid);
		XTR();
		if ($GLOBALS{'IOWARNING'} == "0") {
			XTDTXT($GLOBALS{'courseattendee_fname'});
			XTDTXT($GLOBALS{'courseattendee_sname'});
			$underage = UnderAge(18,$GLOBALS{'courseattendee_dob'});
			if ($underage) {
				XTDTXT(Age($GLOBALS{'courseattendee_dob'},19));
			}
			else { XTDTXT("");
			}
			XTDTXT($GLOBALS{'courseattendee_emergencytel'});
			XTDTXT($GLOBALS{'courseattendee_email'});
			$link = YPGMLINK("bookingcourseattendeedeleteconfirm.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$courseid).YPGMPARM("courseattendee_id",$courseattendeeid);
			XTDLINKTXT($link,"remove from course");			
		} else {
			XTDTXT($courseattendeeid);
			XTDTXT("Not Found");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
			$link = YPGMLINK("bookingcourseattendeedeleteconfirm.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$courseid).YPGMPARM("courseattendee_id",$courseattendeeid);
			XTDLINKTXT($link,"remove from course");	
		}
		X_TR();
	}
	X_TABLE();
}

function Booking_COURSEATTENDEEDELETECONFIRM_Output ($course_id, $courseattendee_id) {
	Get_Data("course",$course_id);
	XH3("Remove Course Attendee - ".$GLOBALS{'course_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	Check_Data('courseattendee',$courseattendee_id);
	if ($GLOBALS{'IOWARNING'} == "0") {
		XPTXT("Are you sure you want to remove ".$GLOBALS{'courseattendee_fname'}." ".$GLOBALS{'courseattendee_sname'}." from this course?");
	} else {
		XPTXT("This person no longer exists on the attendee database. Please remove from course list.");
	}
	XBR();
	XFORM("bookingcourseattendeedeleteaction.php","deleteattendee");
	XINSTDHID();
	XINHID("course_id",$course_id);
	XINHID("courseattendee_id",$courseattendee_id);	
	XINSUBMIT("Confirm Remove");
	X_FORM();
	XBR();XBR();
	XINBUTTONBACK("Cancel");
}


function Booking_COURSEATTENDEEUTILITY_Output() {
	$parm0 = "Course Attendees|courseattendee||courseattendee_id|courseattendee_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."courseattendee_id|Yes|Id|60|Yes|Course Attendee Id|KeyText,6,6^";
	$parm1 = $parm1."courseattendee_fname|Yes|First Name|100|Yes|First name|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_sname|Yes|Surname|100|Yes|Surname|InputText,25,50^";
	$parm1 = $parm1."courseattendee_email|Yes|Email|180|Yes|Email|InputText,25,50^";
	$parm1 = $parm1."courseattendee_emergencytel||||Yes|Emergency Tel|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_dob|Yes|DOB|80|Yes|Date of Birth|InputDate^";	
	// $parm1 = $parm1."courseattendee_personid|Yes|PersonId|60|Yes|Personal Id|InputText,25,50^";
	$parm1 = $parm1."courseattendee_addr1||||Yes|Addr 1|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_addr2||||Yes|Addr 2|InputText,25,50^";
	$parm1 = $parm1."courseattendee_addr3||||Yes|Addr 3|InputText,25,50^";
	$parm1 = $parm1."courseattendee_addr4||||Yes|Addr 4|InputText,25,50^";
	$parm1 = $parm1."courseattendee_postcode||||Yes|Post Code|InputText,25,50^";
	$parm1 = $parm1."courseattendee_school||||Yes|School/College|InputText,25,50^";
	$parm1 = $parm1."courseattendee_parentfname||||Yes|Parent First Name|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_parentsname||||Yes|Parent Surname|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_alttel||||Yes|Alternative Telephone Contact|InputText,12,50^";
	$parm1 = $parm1."courseattendee_medicaldetails||||Yes|Medical Details|InputTextArea,3,50^";	
	$parm1 = $parm1."courseattendee_photographyconsent||||Yes|Photography|InputSelectFromList,Yes+No^";	
	$parm1 = $parm1."courseattendee_experience||||Yes|Any Previous Experience|InputTextArea,3,50^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Booking_SETUPCOURSECATEGORY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_SETUPCOURSECATEGORY_Output() {
	$parm0 = "Course Category|coursecategory|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|coursecategory_id|coursecategory_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."coursecategory_id|Yes|Category|120|Yes|Course Category|KeyText,12,12^";
	$parm1 = $parm1."coursecategory_name|Yes|Title|150|Yes|Title|InputText,50,90^";
	$parm1 = $parm1."coursecategory_treasurer|No|||Yes|Treasurer|InputPerson,10,20,Treasurer,Lookup^";
	$parm1 = $parm1."coursecategory_banksort|No||30|Yes|Bank Sort Code|InputText,8,8^";
	$parm1 = $parm1."coursecategory_bankaccount|No||30|Yes|Bank Account Code|InputText,8,8^";
	$parm1 = $parm1."coursecategory_bankaccountname|No||30|Yes|Bank Account Name|InputText,25,50^";
	$parm1 = $parm1."coursecategory_paypalemail|No||30|Yes|Pay Pal Email|InputText,25,50^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Treasurer,Treasurer..,coursecategory_treasurer_input,coursecategory_treasurer_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "coursecategory,center,center,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);	
}

function Booking_COURSEUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,slimjquerymin,slimimagepopup,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_COURSEUTILITY_Output() {
	$parm0 = "Courses|course|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section],coursecategory,venue|course_id|course_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."course_id|Yes|Course Id|70|Yes|Course Id|KeyGenerated,C[00000]^";
	$parm1 = $parm1."course_coursecategoryid|Yes|Category|80|Yes|Category|InputSelectFromTable,coursecategory,coursecategory_id,coursecategory_name,coursecategory_id^";
	$parm1 = $parm1."course_title|Yes|Title|100|Yes|Course Title|InputText,25,50^";
	$parm1 = $parm1."course_excerpt|No||40|Yes|Course Excerpt|InputTextArea,3,50^";
	$parm1 = $parm1."course_description|No||40|Yes|Course Description|InputTextArea,10,50^";
	$parm1 = $parm1."course_datestart|Yes|Date Start|80|Yes|Course Date Start|InputDate^";
	$parm1 = $parm1."course_dateend|Yes|Date End|80|Yes|Course Date End|InputDate^";
	$parm1 = $parm1."course_weeklyrepeating|Yes|Repeating|100|Yes|Weekly Repeating|InputCheckboxFromList,Yes+No^";	
	$parm1 = $parm1."course_contact|Yes|Contact|60|Yes|Event Contact|InputPerson,10,20,Contact,Lookup^";
	$parm1 = $parm1."course_venue|No||40|Yes|Event Venue|InputText,25,50^";
	$parm1 = $parm1."course_venuecode||||Yes|Booking Venue|InputSelectFromTable,venue,venue_code,venue_name,venue_code^";	
	$parm1 = $parm1."course_googlemapsembed||||Yes|Google Maps Embed|InputTextArea,10,50^";
	$parm1 = $parm1."course_featuredimage|Yes|Photo|60|Yes|Featured Image|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,600,flex,Event,course_id^";
	// $parm1 = $parm1."course_featuredimagecaption|No||40|Yes|Featured Image Caption|InputText,25,50^";
	$parm1 = $parm1."course_charge||||Yes|Charge if not PrePaid|InputText,7,7^";
	$parm1 = $parm1."course_prepaidcharge||||Yes|PrePaid Charge|InputText,7,7^";		
	$parm1 = $parm1."course_earlycharge||||Yes|Early PrePaid Charge|InputText,7,7^";
	// $parm1 = $parm1."course_earlychargedate|Yes|EDATE|60|Yes|Early PrePaid Charge Date|InputDate^";
	$parm1 = $parm1."course_paymentoptionslist||||Yes|Payment Options|InputSelectFromList,Card+Cash+Cheque+BankTransfer+None^";
	$parm1 = $parm1."course_requirements||||Yes|Course Requirements|InputTextArea,5,50^";
	// $parm1 = $parm1."course_tsandcs||||Yes|Terms and Conditions|InputTextArea,5,50^";
	$parm1 = $parm1."course_attendeelist||||Yes|Attendee List|InputTextArea,5,50^";
	$parm1 = $parm1."course_attendeepaidlist||||Yes|Attendee Paid List|InputTextArea,5,50^";
	$parm1 = $parm1."course_attendeestatuslist||||Yes|Attendee Status List|InputTextArea,5,50^";	
	$parm1 = $parm1."course_full||||Yes|Course Full|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."course_createdbypersonid|No||40|Yes|Event Created By|InputPerson,10,20,CreatedBy,Lookup^";
	$parm1 = $parm1."course_publicationstatus|Yes|Status|60|Yes|Publication Status|InputSelectFromList,Draft+Ready+Published^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Contact,Contact..,course_contact_input,course_contact_personlist,50|field,CreatedBy,CreatedBy..,course_createdbypersonid_input,course_createdbypersonid_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "course_utility,50,50,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
	
}

function Booking_SETUPCOURSESCHOOL_Output() {
	$parm0 = "Course School/College|courseschool||courseschool_id|courseschool_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."courseschool_id|Yes|School/College|100|Yes|School/College|KeyText,12,12^";
	$parm1 = $parm1."courseschool_name|Yes|Title|150|Yes|Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_addr1|||150|Yes|Addr1|InputText,50,90^";
	$parm1 = $parm1."courseschool_addr2|||150|Yes|Addr2|InputText,50,90^";
	$parm1 = $parm1."courseschool_addr3|||150|Yes|Addr3|InputText,50,90^";
	$parm1 = $parm1."courseschool_addr4|||150|Yes|Addr4|InputText,50,90^";
	$parm1 = $parm1."courseschool_postcode|||150|Yes|Post Code|InputText,50,90^";	
	$parm1 = $parm1."||||Yes||Divider^";	
	$parm1 = $parm1."courseschool_contact1fname||||Yes|Contact1 First Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact1sname||||Yes|Contact1 Surname|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact1role||||Yes|Contact1 Role|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact1worktel|||150|Yes|Contact1 Telephone|InputText,50,90^";			
	$parm1 = $parm1."courseschool_contact1email||||Yes|Contact1 Email|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact1broadcast|||150|Yes|Contact1 Newsletter etc|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."||||Yes||Divider^";
	$parm1 = $parm1."courseschool_contact2fname||||Yes|Contact2 First Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2sname||||Yes|Contact2 Surname|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2role||||Yes|Contact2 Role|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2worktel|||150|Yes|Contact2 Telephone|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2email||||Yes|Contact2 Email|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2broadcast|||150|Yes|Contact2 Newsletter etc|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."||||Yes||Divider^";	
	$parm1 = $parm1."courseschool_contact3fname||||Yes|Contact3 First Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3sname||||Yes|Contact3 Surname|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3role||||Yes|Contact3 Role|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3worktel|||150|Yes|Contact3 Telephone|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3email||||Yes|Contact3 Email|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3broadcast|||150|Yes|Contact3 Newsletter etc|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."||||Yes||Divider^";	
	$parm1 = $parm1."courseschool_contact4fname||||Yes|Contact4 First Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4sname||||Yes|Contact4 Surname|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4role||||Yes|Contact4 Role|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4worktel|||150|Yes|Contact4 Telephone|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4email||||Yes|Contact4 Email|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4broadcast|||150|Yes|Contact4 Newsletter etc|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."||||Yes||Divider^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Booking_COURSEUPDATELIST_Output () {
	Get_Data("commsmasters");
	XH3("Courses");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;

	XFORM("bookingcourseupdateout.php","newcourse");
	XINSTDHID();
	XINHID("course_id","new");
	XINHID("action","new");	
	XINHID("menulist","courseupdatelist");
	XINSUBMIT("Create New Course");
	X_FORM();

	XBR();XBR();XBR();
	XDIV("simpletablediv_Courses","container");
	XTABLEJQDTID("simpletabletable_Courses");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Category");
	XTDHTXT("Date");
	XTDHTXT("Contact");
	XTDHTXT("Venue");
	XTDHTXT("Part<br>Charge");	
	XTDHTXT("Featured<br>Image");
	XTDHTXT("Edit");
	XTDHTXT("Replicate");	
	XTDHTXT("Delete");
	XTDHTXT("WebView");
	XTDHTXT("Facebook");
	X_TR();
	X_THEAD();
	XTBODY();

	$course_ida = Get_Array('course');
	$course_ida = array_reverse($course_ida);
	foreach ($course_ida as $course_id) {
		Get_Data("course",$course_id);
		XTR();
		XTDTXT($course_id);
		XTDTXT($GLOBALS{'course_title'});
		XTDTXT($GLOBALS{'course_coursecategoryid'});
		if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
		} else {
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));
		}
		XTDTXT($GLOBALS{'course_contact'});
		XTDTXT($GLOBALS{'course_venue'});
		XTDTXT($GLOBALS{'course_partchargepermitted'});
		if ($GLOBALS{'course_featuredimage'} == "") {
			XTDTXT("");
		}
		else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"100");
		}
		$canupdate = "0";
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'course_createdbypersonid'}) { $canupdate = "1"; }
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'course_contact'}) { $canupdate = "1"; }
		if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) { $canupdate = "1"; }
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_courseeditorlist'})) { $canupdate = "1"; }	
		if ( $canupdate == "1") {
			$link = YPGMLINK("bookingcourseupdateout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id).YPGMPARM("menulist","courseupdatelist").YPGMPARM("action","update");
			XTDLINKTXT($link,"update");
			$link = YPGMLINK("bookingcourseupdateout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id).YPGMPARM("menulist","courseupdatelist").YPGMPARM("action","replicate");
			XTDLINKTXT($link,"replicate");
			$link = YPGMLINK("bookingcoursedeleteconfirm.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
			XTDLINKTXT($link,"delete");
		} else {
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
		}
		$link = YPGMLINK("webpagecoursewebview.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
		$link = YPGMLINK("webpagecoursefbview.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
		X_TR();
	}
	X_TBODY();
	X_TABLE();
	X_DIV("simpletablediv_Courses");
	XCLEARFLOAT();
}

function Booking_COURSEATTENDEEADD1_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_COURSEATTENDEEADD1_Output ($course_id) {
	Get_Data('course',$course_id);
	XH3("Add New Course Attendee - ".$GLOBALS{'course_title'});
	XFORM("bookingcourseattendeeaddin1.php","courseattendeeaddin");
	XINSTDHID();
	XINHID("course_id",$course_id);
	
	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Date of Birth');
	XINDATEYYYY_MM_DD_AGE("DOB",$dob);
	XBR();XBR();
	XINSUBMIT("Add Attendee");
	X_FORM();
}


function Booking_COURSEDELETECONFIRM_Output ($course_id) {
	Get_Data('course',$course_id);
	XH3("Delete Course - ".$GLOBALS{'course_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this course");
	XBR();
	XFORM("bookingcoursedeleteaction.php","deletecourse");
	XINSTDHID();
	XINHID("course_id",$course_id);
	XINSUBMIT("Confirm Course Deletion");
	X_FORM();
	XBR();XBR();
	XINBUTTONBACK("Cancel");
}

function Booking_COURSEUPDATE_CSSJS () {
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";	
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,tinymcesliminit,tinymceslimreturnfromupload,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,tinyslimimagepopup,tinyformattedsectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,FormattedSection_Popups";
}

function Booking_COURSEUPDATE_Output ($course_id,$action,$menulist) {	
	if (($action == "new")||($action == "replicate")) {
		$course_ida = Get_Array('course');
		$highestcourse_id = "C00000";
		foreach ($course_ida as $tcourse_id) {
			$highestcourse_id = $tcourse_id;
		}
		$highestcourse_seq = str_replace("C", "", $highestcourse_id);
		$highestcourse_seq++;
		$newcourse_id = "C".substr(("00000".$highestcourse_seq), -5);
		if ($action == "new") {
			Initialise_Data('course');
			$GLOBALS{'course_publicationstatus'} = "Draft";
			XH2("Course Setup - New Course - ".$newcourse_id);
		}
		if ($action == "replicate") {
			Get_Data('course', $course_id);
			$GLOBALS{'course_publicationstatus'} = "Draft";
			$GLOBALS{'course_attendeelist'} = "";
			$GLOBALS{'course_attendeepaidlist'} = "";
			$GLOBALS{'course_attendeestatuslist'} = "";
			Write_Data('course', $newcourse_id);
			XH2("Course Setup - Replicated Course - ".$newcourse_id);
		}
		$course_id = $newcourse_id;
	}
	if ($action == "update") {
		Get_Data('course', $course_id);
		XH2("Course Setup - ".$course_id." - ".$GLOBALS{'course_title'});
	}	
	// $helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;
	XFORMUPLOAD("bookingcourseupdatein.php","courseupdatein");
	XINSTDHID();
	XINHID("course_id",$course_id);
	XINHID("menulist",$menulist);
	XINHID("TinyMCEUploadTo","Course");
	XINHID("TinyMCEUploadId",$course_id);
	XHR();
	XH4('Title.');
	XINTXT("course_title",$GLOBALS{'course_title'},"50","100");
	XH4('Short excerpt.');
	XINTEXTAREA("course_excerpt",$GLOBALS{'course_excerpt'},"3","100");
	XH4('Full description of course.');
	XINTEXTAREAMCE("course_description",$GLOBALS{'course_description'},"20","100");
	XHR();
	XH4('Featured Image.');
	XINHID("course_featuredimage",$GLOBALS{'course_featuredimage'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "course_featuredimage";
	$imageviewwidth = "300";
	$imagename = $GLOBALS{'course_featuredimage'};
	$imageuploadto = "Course";
	$imageuploadid = $course_id;
	$imageuploadwidth = "800";
	$imageuploadheight = "flex";
	$imageuploadfixedsize = "";
	$imagethumbwidth = "200";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);	
	XH2('Featured Image.');
	XINHID("event_featuredimage",$GLOBALS{'event_featuredimage'});
	XHR();
	XH4('Course Venue and Schedule.');
	XTABLE();
	$xhash = Get_SelectArrays_Hash ("coursecategory","coursecategory_id","coursecategory_name","coursecategory_name","","" );
	XTR();XTDTXT('Course Category');XTD();XINSELECTHASH($xhash,"course_coursecategoryid",$GLOBALS{'course_coursecategoryid'});X_TD();X_TR();
	XTR();XTDTXT('Date of Course Start');XTD();XINDATEYYYY_MM_DD("course_datestart",$GLOBALS{'course_datestart'});X_TD();X_TR();
	XTR();XTDTXT('Date of Course End');XTD();XINDATEYYYY_MM_DD("course_dateend",$GLOBALS{'course_dateend'});X_TD();X_TR();
	XTR();XTDTXT('Weekly Repeating');XTD();XINCHECKBOXYESNO ("course_weeklyrepeating",$GLOBALS{'course_weeklyrepeating'},"");X_TD();X_TR();	
	XTR();XTDTXT('Start Time of Course');XTD();XINTXT("course_timestart",$GLOBALS{'course_timestart'},"10","50");X_TD();X_TR();
	XTR();XTDTXT('End Time of Course');XTD();XINTXT("course_timeend",$GLOBALS{'course_timeend'},"10","50");X_TD();X_TR();
	XTR();XTDTXT('Venue');XTD();XINTXTID("course_venue","course_venue",$GLOBALS{'course_venue'},"50","100");X_TD();X_TR();
	$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
	XTR();XTDTXT('Booking Venue');XTD();XINSELECTHASH($xhash,"course_venuecode",$GLOBALS{'course_venuecode'});X_TD();X_TR();
	XTR();XTDTXT('Contact for Course');
	XTD();XINTXTID("course_contact","course_contact",$GLOBALS{'course_contact'},"50","100");
	XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
	XTXTID("course_contactname",View_Person_List($GLOBALS{'course_contact'}));
	XBR();X_TD();X_TR();	
	X_TABLE();
	XHR();
	XH4('Course Capacity and Booking Status.');
	XTABLE();	
	XTR();XTDTXT('Maximum Attendees');XTD();XINTXT("course_maximumattendees",$GLOBALS{'course_maximumattendees'},"7","7");X_TD();X_TR();
	XTR();XTDTXT('Course Full');XTDINCHECKBOXYESNO("course_full",$GLOBALS{'course_full'},"");X_TR();
	X_TABLE();
	XHR();	
	XH4('Course Payments');
	XH5('Full Course Charges');	
	XTABLE();
	XTR();XTDTXT('Charge');XTD();XINTXTID("course_charge","course_charge",$GLOBALS{'course_charge'},"7","7");X_TD();X_TR();	
	XTR();XTDHTXT('');XTDHTXT('');X_TR();	
	XTR();XTDTXT('PrePaid Discounted Charge');XTD();XINTXTID("course_prepaidcharge","course_prepaidcharge",$GLOBALS{'course_prepaidcharge'},"7","7");X_TD();X_TR();	
	XTR();XTDHTXT('');XTDHTXT('');X_TR();
	XTR();XTDTXT('Early PrePaid Discounted Charge');XTD();XINTXTID("course_earlycharge","course_earlycharge",$GLOBALS{'course_earlycharge'},"7","7");X_TD();X_TR();
	XTR();XTDTXT('Early PrePaid Discounted Charge Date');XTD();XINDATEYYYY_MM_DD("course_earlychargedate",$GLOBALS{'course_earlychargedate'});X_TD();X_TR();
	X_TABLE();
	XH5('Reduced Payment Instructions');
	XTABLE();
	XTR();XTDTXT('Reduced Payment Enabled');XTDINCHECKBOXYESNO("course_partchargepermitted",$GLOBALS{'course_partchargepermitted'},"");X_TR();
	XTR();XTDTXT('Reduced Payment Instructions');XTDINTEXTAREA("course_partchargeinstructions",$GLOBALS{'course_partchargeinstructions'},"3","100");X_TR();
	X_TABLE();
	XH5('Payment Method Options');
	$xhash = List2Hash("Card,Cheque,Cash,BankTransfer");
	XINCHECKBOXHASH ($xhash,"course_paymentoptionslist",$GLOBALS{'course_paymentoptionslist'});
	XHR();	
	XH4('Course Requirements');
	XINTEXTAREA("course_requirements",$GLOBALS{'course_requirements'},"5","100"); // CHECK Multiple TinyMCE textareas not allowed
	XH4('Terms and Conditions.');
	XINTEXTAREA("course_tsandcs",$GLOBALS{'course_tsandcs'},"5","100"); // CHECK Multiple TinyMCE textareas not allowed
	XHR();	
	XH4('Publication Status');
	Get_Data("commsmasters");
	$canpublish = "0";
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'course_createdbypersonid'}) { $canpublish = "1"; }
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'course_contact'}) { $canpublish = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) { $canpublish = "1"; }
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_courseeditorlist'})) { $canpublish = "1"; }	
	if ( $GLOBALS{'course_publicationstatus'} == "Published" ) { $canpublish = "1"; }
	if ( $canpublish == "1" ) { $xhash = Lists2Hash("Draft,Ready,Published","Draft,Ready to Publish,Published"); }
	else { $xhash = Lists2Hash("Draft,Ready","Draft,Ready to Publish"); }
	XINRADIOHASH ($xhash,"course_publicationstatus",$GLOBALS{'course_publicationstatus'});XBR();
	XH4('Publication Channels Requested');
	XINCHECKBOXYESNO("course_websiterequested",$GLOBALS{'course_websiterequested'},"Website");	
	XINCHECKBOXYESNO("course_bulletinrequested",$GLOBALS{'course_bulletinrequested'},"Bulletin Board");
	XINCHECKBOXYESNO("course_newsletterrequested",$GLOBALS{'course_newsletterrequested'},"Newsletter");	
	XINCHECKBOXYESNO("course_facebookrequested",$GLOBALS{'course_facebookrequested'},"Facebook");	
	XINCHECKBOXYESNO("course_twitterrequested",$GLOBALS{'course_twitterrequested'},"Twitter");	
	XBR();XBR();
	XINSUBMIT("Update Course");
	X_FORM();
	
	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
	// Go_Back_To_CourseList;XBR();

	$GLOBALS{'PersonSelectPopupParameters'} = array(
		"this,person_id|person_sname|person_fname|person_section",
		"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
		"field,Lookup,Select,course_contact,course_contactname,100",
		"person_id",
		"all",
		"Stats Select,center,center,800,600",
	  	"view",
		"buildfulllist"
	);
	// $parm2 = Buttons Id – field,To,To..,ToPersonIdList,ToPersonNameList,70|field,Cc,CC..,CcDistList,CcPersonList,70
}

function UpdateCourseAttendeeStatus ($courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments) {
	// XPTXT('UpdateCourseAttendeeStatus "'.$courseattendeeid.'"');
	$attendeestatuslist = $GLOBALS{'course_attendeestatuslist'};
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	// XPTXT('BEFOREADD "'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$updatedattendeestatuslist = "";
	$found = "0";
	$sep = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			$attbits = explode('~',$attendeestatuslistelement);
			if ($courseattendeeid == $attbits[0]) { 
				if ($paymenttype != "") {$attbits[1] = $paymenttype;}
				if ($paymenttype == "null") {$attbits[1] = "";}					
				if ($paymentdue != "") {$attbits[2] = $paymentdue;}
				if ($paymentdue == "null") {$attbits[2] = "";}				
				if ($paymentreceived != "") {$attbits[3] = $paymentreceived;}
				if ($paymentreceived == "null") {$attbits[3] = "";}	
				if ($paymentcomments != "") {$attbits[4] = $paymentcomments;}
				if ($paymentcomments == "null") {$attbits[4] = "";}	
				$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $attbits[0] .'~'. $attbits[1] .'~'. $attbits[2] .'~'. $attbits[3] .'~'. $attbits[4]; 
				$sep = "*";
				$found = "1";
			}
			else {
				$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $attbits[0] .'~'. $attbits[1] .'~'. $attbits[2] .'~'. $attbits[3] .'~'. $attbits[4];
				$sep = "*";
			}
		}
	}
	if ($found == "0") {
		$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $courseattendeeid .'~'. $paymenttype .'~'. $paymentdue .'~'. $paymentreceived .'~'. $paymentcomments;
	}	
	// XPTXT('MIDDLE "'.$updatedattendeestatuslist.'"');

	if ($updatedattendeestatuslist == "*") { $updatedattendeestatuslist = ""; } // just to be sure
	// XPTXT('AFTERADD "'.$updatedattendeestatuslist . '"');
	$GLOBALS{'course_attendeestatuslist'} = $updatedattendeestatuslist;
}


function DeleteCourseAttendeeStatus ($courseattendeeid) {
	$attendeestatuslist = $GLOBALS{'course_attendeestatuslist'};
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	// XPTXT('BEFOREDELETE <br>"'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$updatedattendeestatuslist = "";
	$sep = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			// XPTXT('"'.$attendeestatuslistelement.'"');
			$attbits = explode('~',$attendeestatuslistelement);
			if ($courseattendeeid == $attbits[0]) { } // drop this person
			else {
				$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $attbits[0] .'~'. $attbits[1] .'~'. $attbits[2] .'~'. $attbits[3] .'~'. $attbits[4]; 
				$sep = "*";
			}			
		}
		
	}

	if ($updatedattendeestatuslist == "*") { $updatedattendeestatuslist = ""; } // just to be sure
	// XPTXT('AFTERDELETE <br>"'.$updatedattendeestatuslist . '"');
	$GLOBALS{'course_attendeestatuslist'} = $updatedattendeestatuslist;
}

function GetCourseAttendeeStatus ($courseattendeeid) {
	$attendeestatuslist = $GLOBALS{'course_attendeestatuslist'};
	if ($attendeestatuslist == "*") {
		$attendeestatuslist = "";
	} // just to be sure
	// XPTXT('BEFOREDELETE "'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$foundstring = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			// XPTXT('"'+$attendeestatuslistelement+'"');
			$attbits = explode('~',$attendeestatuslistelement);
			if ($courseattendeeid == $attbits[0]) {
				$foundstring = $attendeestatuslistelement;
			}
		}
	}
	return $foundstring;
}


function AttendeeStatus2Array ($attendeestatuslist) {
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	$attendeestatuslista = Array();
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
	}
	return $attendeestatuslista;
}

function Booking_COURSEDOWNLOADLIST_Output () {
	XH3("Download List of Attendees");
	XFORM("bookingcoursedownloadlistin.php","coursedownload");
	XINSTDHID();	
	XH3("Step 1: Select List Type");
	$xhash = Lists2Hash("MailChimp,EmailList","MailChimp List (generates csv file to upload to Mailchimp),Email List (generates list to copy/paste in email)");
	XINRADIOHASH ($xhash,"ListType","");XBR();
	XH3("Step 1: Build List");	
	# datatype/rootkey sortfieldname selectfieldname selectfieldvalue
	$coursecategorya = Get_Array('coursecategory');
	$keyarray = Array(); $valuearray = Array();
	foreach( $coursecategorya as $coursecategory_id ) {
		Get_Data('coursecategory',$coursecategory_id);
		array_push($keyarray,$coursecategory_id);
		array_push($valuearray,'All previous attendees of "'.$GLOBALS{'coursecategory_name'}.'" courses');
	}
	$xhash = Arrays2Hash ($keyarray, $valuearray);
	XINCHECKBOXHASH($xhash,"CourseCategoryList","");
	XBR();
	XINCHECKBOXYESNO("Schools","","Include contacts for Schools/Colleges");	
	XBR();XBR();
	XINSUBMIT("Download List");
	X_FORM();

}

function Booking_BOOKINGVENUE_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";		
}

function Booking_BOOKINGVENUE_Output() {
	$parm0 = "Booking Venues|bookingvenue|venue,person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|bookingvenue_id|bookingvenue_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."bookingvenue_id|Yes|Booking Venue Id|90|Yes|Booking Venue Id|KeyText,12,12^";
	$parm1 = $parm1."bookingvenue_name|Yes|Venue Name|120|Yes|Venue Name|InputText,25,50^";	
	$parm1 = $parm1."bookingvenue_facility|Yes|Facility|120|Yes|Facility|InputText,25,50^";	
	$parm1 = $parm1."bookingvenue_venuecode|Yes|Venue|100|Yes|Venue Code|InputSelectFromTable,venue,venue_code,venue_name,venue_code^";		
	$parm1 = $parm1."bookingvenue_owner|Yes|Contact|80|Yes|Contact|InputPerson,10,20,Contact,Lookup^";
	$parm1 = $parm1."bookingvenue_daytimestart|No||40|Yes|Time Start|InputText,5,5^";	
	$parm1 = $parm1."bookingvenue_daytimeend|No||40|Yes|Time End|InputText,5,5^";	
	$parm1 = $parm1."bookingvenue_timeslice|No||40|Yes|Time Slice|InputText,5,5^";	
	$parm1 = $parm1."bookingvenue_leadtimedays|No||40|Yes|Leadtime Days|InputText,2,2^";	
	$parm1 = $parm1."bookingvenue_authorisation|No||40|Yes|Authorised Administrators|InputPerson,10,20,Administrator,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Contact,Contact..,bookingvenue_owner_input,bookingvenue_owner_personlist,50|field,Administrator,Administrator..,bookingvenue_authorisation_input,bookingvenue_authorisation_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "bookingvenue,50,50,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Booking_BOOKINGADMINLIST_Output () {
	XH1("Booking Administration");
	XPTXT("Please select the venue at which you would like to make the booking.");
	XHR();
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Venue");
	XTDHTXT("Manage Bookings at this Venue");
	X_TR();
	$venue_ida = Get_Array('venue');
	foreach ($venue_ida as $venue_code) {
		Get_Data("venue",$venue_code);
		if ($GLOBALS{'venue_bookable'} == "Yes") {
			XTR();
			XTDTXT($venue_code);
			XTDTXT($GLOBALS{'venue_name'});
			$link = YPGMLINK("bookingupdatelistout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("venue_code",$venue_code);
			XTDLINKTXT($link,"manage bookings");
			X_TR();
		}
	}
	X_TABLE();
}



function Booking_BOOKINGUTILITYLIST_Output () {
	XH1("Bookings Utility");
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Venue");
	XTDHTXT("Booking Utility");
	X_TR();
	$venue_ida = Get_Array('venue');
	foreach ($venue_ida as $venue_code) {
		Get_Data("venue",$venue_code);
		if ($GLOBALS{'venue_bookable'} == "Yes") {
			XTR();
			XTDTXT($venue_code);
			XTDTXT($GLOBALS{'venue_name'});
			$link = YPGMLINK("bookingutilityout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("venue_code",$venue_code);
			XTDLINKTXT($link,"booking utility");
			X_TR();
		}
	}
	X_TABLE();
}

function Booking_BOOKINGUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_BOOKINGUTILITY_Output($venue_code) {
	Get_Data("venue",$venue_code);
	$parm0 = "Booking Utility - ".$GLOBALS{'venue_name'}."|booking[rootkey=".$venue_code."]|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|booking_id|booking_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."booking_id|Yes|Booking Id|90|Yes|Booking Id|KeyGenerated,BK[00000]^";
	$parm1 = $parm1."booking_title|Yes|Title|100|Yes|Title|InputText,25,50^";	
	$parm1 = $parm1."booking_description||||Yes|Description|InputTextArea,3,50^";	
	$parm1 = $parm1."booking_contact|Yes|Booker|60|Yes|Booker|InputPerson,10,20,Booker,Lookup^";	
	$parm1 = $parm1."booking_timestamp||||Yes|Timestamp|InputText,25,50^";	
	$parm1 = $parm1."booking_timestart|Yes|Time Start|100|Yes|Time Start|InputText,5,5^";	
	$parm1 = $parm1."booking_timeend|Yes|Time End|100|Yes|Time End|InputText,5,5^";		
	$parm1 = $parm1."booking_status||||Yes|Status|InputText,25,50^";
	$parm1 = $parm1."booking_datestart|Yes|Date Start|80|Yes|Date Start|InputDate^";
	$parm1 = $parm1."booking_dateend|Yes|Date End|80|Yes|Date End|InputDate^";	
	$parm1 = $parm1."booking_weeklyrepeating|Yes|Repeating|100|Yes|Weekly Repeating|InputCheckboxFromList,Yes+No^";	
	// $parm1 = $parm1."booking_dayofweek|Yes|Day|80|Yes|Day of Week|InputSelectFromList,Mon+Tue+Wed+Thu+Fri+Sat+Sun^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 = "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 = "field,Booker,Booker..,booking_contact_input,booking_contact_personlist,50";
	$p3 = "person_id";
	$p4 = "all";
	$p5 = "booking_utility,50,50,900,900";
	$p6 = "view";
	$p7 = "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Booking_VENUESCHEDULELIST_Output () {
	XH1("Venue Schedules");
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Venue");
	XTDHTXT("Venue Schedules");
	X_TR();
	$venue_ida = Get_Array('venue');
	foreach ($venue_ida as $venue_code) {
		Get_Data("venue",$venue_code);
		if ($GLOBALS{'venue_bookable'} == "Yes") {
			XTR();
			XTDTXT($venue_code);
			XTDTXT($GLOBALS{'venue_name'});
			$link = YPGMLINK("bookingvenuescheduleout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("venue_code",$venue_code);
			XTDLINKTXT($link,"venue schedule");
			X_TR();
		}
	}
	X_TABLE();
}

function Booking_VENUESCHEDULE_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
}

function Booking_VENUESCHEDULE_Output($venue_code, $season) {

	Get_Data('venue',$venue_code);
	XH2("Venue Schedule for ".$GLOBALS{'venue_name'});	
	
	XFORM("bookingvenueschedulein.php","venueschedule");
	XINSTDHID();
	XINHID("venue_code",$venue_code);
	XINHID("season",$season);	
	XTABLE();
	XTR();XTDHTXT("Venue Schedule for a specific date");XTDHTXT("");X_TR();
	XTR();XTDTXT("date - dd/mm/yyyy");XTDINDATEYYYY_MM_DD("requesteddate","");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("View");X_TR();
	X_TABLE();
	X_FORM();

}

function Booking_VENUEWEEKSCHEDULEDISPLAY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_VENUEWEEKSCHEDULEDISPLAY_Output($venue_code, $season, $date) {
	XHR();
	$dayofweek = date("w", strtotime($date));
	if ($dayofweek == 0) { // sunday
		$weekdatestart = OffsetDays ($date,-6);
		$weekdateend = $date;
	} else { // otherdays
		// XPTXT("weekdatestart");
		$weekdatestart = OffsetDays ($date,(1-$dayofweek));
		// XPTXT("weekdateend");
		$weekdateend = OffsetDays ($date,(7-$dayofweek));
	}
	Get_Data('venue',$venue_code);
	XH2($GLOBALS{'venue_name'});
	XH3("Venue Weekly Schedule for ".YYYY_MM_DDtoDDsMMsYY($weekdatestart)." to ".YYYY_MM_DDtoDDsMMsYY($weekdateend));
	XFORM("bookingvenueschedulein.php","venueschedule");
	XINSTDHID();
	XINHID("venue_code",$venue_code);
	XINHID("season",$season);
	XTABLE();
	XTR();XTDINDATEYYYY_MM_DD("requesteddate",$date);X_TR();
	XTR();XTDINSUBMIT("Change Date");X_TR();
	X_TABLE();
	X_FORM();
	
	$hfa = Array();
	$uhfa = Array();	
	$earliesthomeslot = $GLOBALS{'venue_daytimestart'}; $latesthomeslot = $GLOBALS{'venue_daytimeend'};
	
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {
		Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
		$teamsarray = explode(',',$GLOBALS{'section_teams'});
		foreach ($teamsarray as $team_code)  {
			$frsa = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
			foreach ($frsa as $frs_id)  {
				Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
				$fixturesfound = "1";
				$bits = str_split($frs_id);
				$frsYYYYhMMhDD = "20".$bits[2].$bits[3].'-'.$bits[4].$bits[5].'-'.$bits[6].$bits[7];
				if (($frsYYYYhMMhDD >= $weekdatestart)&&($frsYYYYhMMhDD <= $weekdateend)) {
					$ttime1 = $GLOBALS{'frs_time'};
					if ($ttime1 == "") { $ttime1 = "?";	}
					$ttime2 = $GLOBALS{'frs_timeend'};
					if ($ttime2 == "") {
						if ($ttime1 == "?") { $ttime2 = "?"; } 
						else { $ttime2 = OffsetMinutes ($ttime1,75); }	
					}
					if ($GLOBALS{'frs_ha'} == "H") {
						if (($ttime1 != "?")&&($GLOBALS{'frs_venue'} == $venue_code)) {
							array_push($hfa, $ttime1."#".$frsYYYYhMMhDD."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
						} else {
							array_push($uhfa, $ttime1."#".$frsYYYYhMMhDD."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
						}
					}
				}
			}
		}
	}

	$bookinga = Get_Array("booking", $venue_code);
	foreach ($bookinga as $booking_id)  {
		Get_Data("booking", $venue_code, $booking_id);			
		$booking_datestart = $GLOBALS{'booking_datestart'};
		$booking_dateend = $GLOBALS{'booking_dateend'};
		if (($booking_dateend == "")||($booking_dateend == "0000-00-00")) {
			$booking_dateend = $booking_datestart;
		}
		// --- Cycle through the week ----------------
		for ($offset = 0; $offset <= 6; $offset++) {
			$date = OffsetDays ($weekdatestart,$offset);
			$bookingthisday = "0";
			// XPTXT("DDD  ".$date."|".$booking_datestart."|".$booking_dateend);
			if (($booking_datestart == $booking_dateend)&&($date == $booking_datestart)) {
				// single booking
				$bookingthisday = "1";
			} else {
				if (($date >= $booking_datestart)&&($date <= $booking_dateend)) {
					if ($GLOBALS{'booking_weeklyrepeating'} == "Yes") {
						$bookingday = date("l", strtotime($booking_datestart));
						$thisday = date("l", strtotime($date));;
						if ($thisday == $bookingday) {
							$bookingthisday = "1";
						} // valid day match within period
					} else {
						$bookingthisday = "1"; // valid day in contiguous period
					}
				}
			}
			if ( $bookingthisday == "1" ) {
				array_push($hfa, $GLOBALS{'booking_timestart'}."#".$date."#B#".$venue_code."|".$booking_id."#".$GLOBALS{'booking_venuecode'}."#".$GLOBALS{'booking_timeend'});
			}
		}				
	}

	$coursea = Get_Array("course");
	foreach ($coursea as $course_id)  {
		Get_Data("course", $course_id);
		$course_datestart = $GLOBALS{'course_datestart'};
		$course_dateend = $GLOBALS{'course_dateend'};
		if (($course_dateend == "")||($course_dateend == "0000-00-00")) {
			$course_dateend = $course_datestart;
		}
		// --- Cycle through the week ----------------
		for ($offset = 0; $offset <= 6; $offset++) {
			$date = OffsetDays ($weekdatestart,$offset);
			$bookingthisday = "0";
			// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend);
			if (($course_datestart == $course_dateend)&&($date == $course_datestart)) {
				// single booking
				$bookingthisday = "1";
			} else {
				if (($date >= $course_datestart)&&($date <= $course_dateend)) {
					// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend."|".$GLOBALS{'course_weeklyrepeating'});
					if ($GLOBALS{'course_weeklyrepeating'} == "Yes") {
						$bookingday = date("l", strtotime($course_datestart));
						$thisday = date("l", strtotime($date));;
						if ($thisday == $bookingday) {
							$bookingthisday = "1";
						} // valid day match within period
					} else {
						$bookingthisday = "1"; // valid day in contiguous period
					}
				}
			}
			if ( $bookingthisday == "1" ) {
				array_push($hfa, $GLOBALS{'course_timestart'}."#".$date."#C#".$course_id."#".$GLOBALS{'course_venuecode'}."#".$GLOBALS{'course_timeend'});
			}
		}
	}

	if(empty($uhfa)){
	} else {
		XHR();
		XH3("Home fixtures not yet scheduled");
		XTABLE();
		XTR();XTDHTXT("Date");XTDHTXT("H/A");XTDHTXT("Time");XTDHTXT("Team");XTDHTXT("Opposition");XTDHTXT("Venue");XTDHTXT("Schedule this event");X_TR();
		sort($uhfa);
		foreach ($uhfa as $uhf)  {
			$bits = explode('#',$uhf);
			$ttime = $bits[0];
			$tdate = $bits[1];
			$type = $bits[2];
			$frs_id = $bits[3];
			$tvenue = $bits[4];
			$ttimeend = $bits[5];
			if ($type == "F") {
				$bits = str_split($frs_id);
				$tteam_code = $bits[0].$bits[1];
				Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
				Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
				$tteam_name = $GLOBALS{'team_name'};
				$section = GetSectionFromTeamCode ($tteam_code);
				XTR();
				XTDTXT(YYYY_MM_DDtoDDsMMsYY($tdate));XTDTXT($GLOBALS{'ha'});
				XTDTXT($ttime);XTDTXT($GLOBALS{'team_name'});XTDTXT($GLOBALS{'frs_oppo'});XTDTXT($GLOBALS{'frs_venue'});
				$link = YPGMLINK("frsteamselectionout.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("section_name",$section).YPGMPARM("team_code",$tteam_code).YPGMPARM("frs_id",$frs_id);
				# url,text,wintitle,top,left,height,width
				XTDLINKTXTNEWPOPUP($link,"schedule fixture","Schedule Fixture","100","100","800","800");
				X_TR();
			}
		}
		X_TABLE();
		XHR();
	}
	
	

	sort($hfa);
	XHR();	
	/*
	XPTXT($earliesthomeslot." - ".$latesthomeslot);
	foreach ($hfa as $hf)  { XPTXT($hf); }
	*/
	
	$schedule = Array();
	$highlightuptoa = Array();
	for ($offset = 0; $offset <= 6; $offset++) { $highlightuptoa[$offset] = ""; }
	
	for ($hh = 0; $hh < 24; $hh++) {
		for ($mm = 0; $mm < 4; $mm++) {
			$stime = substr("0".$hh,-2).":".substr("0".($mm*15),-2);
			array_push($schedule, $stime);
		}
	}

	$slotindex = 0;
	foreach ($schedule as $slot)  {
		if ($slot == $latesthomeslot) {
			$latestslotindex = $slotindex + 5;
		}
		$slotindex++;
	}
	if ($latestslotindex > count($schedule)-1) {
		$latestslotindex = $schedule[end($schedule)];
	}
	$latesthomeslot = $schedule[$latestslotindex];

	XTABLE(); 
	XTR();XTDHTXT("Time");
	for ($offset = 0; $offset <= 6; $offset++) {
		$date = OffsetDays ($weekdatestart,$offset);	
		XTDHTXT(date("D", strtotime($date))." ".YYYY_MM_DDtoDDsMMsYY($date));
	}
	X_TR();
	XTR();XTDTXT("");
	for ($offset = 0; $offset <= 6; $offset++) {
		$date = OffsetDays ($weekdatestart,$offset);
		$link = YPGMLINK("frsdatescheduleout.php");
		$yyyypart = substr($date,0,4);
		$mmpart = substr($date,5,2);
		$ddpart = substr($date,8,2);
		$link = $link.YPGMSTDPARMS().YPGMPARM("Season",$season).YPGMPARM("FixResSelDate_YYYYpart",$yyyypart).YPGMPARM("FixResSelDate_MMpart",$mmpart).YPGMPARM("FixResSelDate_DDpart",$ddpart);
		XTDLINKTXT($link, "All Venues");
	}
	X_TR();
	$slotindex = 0;
	foreach ($schedule as $slot)  {
		if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
			if (substr($slot,3,2) == "00") {
				XTR(); XTDHTXT("");
				for ($offset = 0; $offset <= 6; $offset++) {
					XTDHTXT("");
				}
				X_TR();
			}
		}
		if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
			XTR();
			for ($offset = 0; $offset <= 6; $offset++) {
				$date = OffsetDays ($weekdatestart,$offset);		
				
				$ftext = ""; $sep = "";
				foreach ($hfa as $hf)  {
					$bits = explode('#',$hf);
					$ttime = $bits[0];
					$tdate = $bits[1];				
					$type = $bits[2];
					$id = $bits[3];
					$tvenue = $bits[4];
					$ttimeend = $bits[5];
					if ($slotindex == count($schedule)-1) {
						$nextslot = "99.99";
					}  else {$nextslot = $schedule[$slotindex+1];
					}
					if (($ttime >= $slot)&&($ttime < $nextslot)&&($date == $tdate)) {
						if ($type == "F") {
							$bits = str_split($id);
							$tteam_code = $bits[0].$bits[1];
							Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$id);
							Check_Data("team",$GLOBALS{'currperiodid'}, $tteam_code);
							if ($GLOBALS{'IOWARNING'} == "0") {
								$tteam_name = $GLOBALS{'team_name'};
								if ($ttimeend == "?") {	$ttimeendtxt = ""; }
								else { $ttimeendtxt = " (until ".$ttimeend.")"; }
								$ttimeendtxt = "";
								$ftext = $ftext.$sep.$tteam_name." v ".$GLOBALS{'frs_oppo'}.$ttimeendtxt;
								if ($ttimeend > $highlightuptoa[$offset]) { $highlightuptoa[$offset] = $ttimeend; }
								$sep = "<br>";
							}	
						}
						if ($type == "B") {
							$bits = explode('|',$id);
							Get_Data("booking",$bits[0],$bits[1]);
							if ($ttimeend == "?") {	$ttimeendtxt = ""; }
							else { $ttimeendtxt = " (until ".$ttimeend.")"; }
							$ftext = $ftext.$sep.$GLOBALS{'booking_title'}.$ttimeendtxt;
							if ($ttimeend > $highlightuptoa[$offset]) { $highlightuptoa[$offset] = $ttimeend; }
							$sep = "<br>";
						}
						if ($type == "C") {
							Get_Data("course",$id);
							Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
							if ($ttimeend == "?") {	$ttimeendtxt = ""; }
							else { $ttimeendtxt = " (until ".$ttimeend.")"; }
							$ftext = $ftext.$sep.$GLOBALS{'coursecategory_name'}." - ".$GLOBALS{'course_title'}.$ttimeendtxt;
							if ($ttimeend > $highlightuptoa[$offset]) { $highlightuptoa[$offset] = $ttimeend; }
							$sep = "<br>";
						}
					}
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					if ($offset == 0) {
						XTDTXT($slot);
					}
					if ($ftext != "") {
						XTDTXTHIGHLIGHT($ftext);
					} else {
						if ($slot > $highlightuptoa[$offset] ) { $highlightuptoa[$offset] = ""; }
						if (($highlightuptoa[$offset] != "")&&($slot < $highlightuptoa[$offset])) { XTDTXTHIGHLIGHT($ftext);  }
						else { XTDTXT($ftext); }
					}
				}
			}
		
			X_TR();
		}
		$slotindex++;
	}
	X_TABLE();

}

function Booking_MASTERSCHEDULER_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_MASTERSCHEDULER_Output() {
	XH2("Master Scheduler");
	XFORM("bookingmasterschedulerin.php","masterschedule");
	XINSTDHID();
	XTABLE();
	XTR();XTDHTXT("Schedule all items for a specific date");XTDHTXT("");X_TR();
	XTR();XTDTXT("date - dd/mm/yyyy");XTDINDATEYYYY_MM_DD("requesteddate","");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Schedule");X_TR();
	X_TABLE();
	X_FORM();

}

function Booking_MASTERSCHEDULERDISPLAY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_MASTERSCHEDULERDISPLAY_Output($season, $date) {
	$dayofweek = date("l", strtotime($date));
	XH2("Master Scheduler - ".$dayofweek." ".YYYY_MM_DDtoDDsMMsYY($date));
	XFORM("bookingmasterschedulerin.php","masterschedule");
	XINSTDHID();
	XTABLE();
	XTR();XTDINDATEYYYY_MM_DD("requesteddate",$date);X_TR();
	XTR();XTDINSUBMIT("Change Date");X_TR();
	X_TABLE();
	X_FORM();
	XHR();
	$hfa = Array();
	$uhfa = Array();
	$hva = Array();
	$fixturesfound = "0";
	$earliesthomeslot = "99:99"; $latesthomeslot = "00:00";
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {
		Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
		$teamsarray = explode(',',$GLOBALS{'section_teams'});
		foreach ($teamsarray as $team_code)  {
			$frsa = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
			foreach ($frsa as $frs_id)  {
				$fixturesfound = "1";
				$bits = str_split($frs_id);
				$fileyymmdd = $bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
				$bits = str_split($date);
				$checkyymmdd = $bits[2].$bits[3].$bits[5].$bits[6].$bits[8].$bits[9];
				if ($fileyymmdd == $checkyymmdd) {
					Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
					$ttime1 = $GLOBALS{'frs_time'};
					if ($ttime1 == "") { $ttime1 = "?";	}
					$ttime2 = $GLOBALS{'frs_timeend'};
					if ($ttime2 == "") {
						if ($ttime1 == "?") { $ttime2 = "?"; } 
						else { $ttime2 = OffsetMinutes ($ttime1,75); }	
					}
					if ($GLOBALS{'frs_ha'} == "H") {
						if (!in_array($GLOBALS{'frs_venue'}, $hva)) {
							array_push($hva, $GLOBALS{'frs_venue'});
						}
						if ($ttime1 != "?") {
							array_push($hfa, $ttime1."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
							if ($ttime1 < $earliesthomeslot) {
								$earliesthomeslot = $ttime1;
							}
							if ($ttime1 > $latesthomeslot) {
								$latesthomeslot = $ttime1;
							}
							if ($ttime2 != "?") {
								if ($ttime2 > $latesthomeslot) {
									$latesthomeslot = $ttime2;
								}
							}
						} else {
							array_push($uhfa, $ttime1."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
						}
					}
				}
			}
		}
	}

	$venuea = Get_Array("venue");
	foreach ($venuea as $venue_code)  {
		Get_Data("venue", $venue_code);
		if ($GLOBALS{'venue_bookable'} == "Yes") {
			$bookinga = Get_Array("booking", $venue_code);
			foreach ($bookinga as $booking_id)  {
				Get_Data("booking", $venue_code, $booking_id);
				$booking_datestart = $GLOBALS{'booking_datestart'};
				$booking_dateend = $GLOBALS{'booking_dateend'};
				if (($booking_dateend == "")||($booking_dateend == "0000-00-00")) {
					$booking_dateend = $booking_datestart;
				}
				$bookingthisday = "0";
				// XPTXT("DDD  ".$date."|".$booking_datestart."|".$booking_dateend);
				if (($booking_datestart == $booking_dateend)&&($date == $booking_datestart)) {
					// single booking
					$bookingthisday = "1";
				} else {
					if (($date >= $booking_datestart)&&($date <= $booking_dateend)) {
						if ($GLOBALS{'booking_weeklyrepeating'} == "Yes") {
							$bookingday = date("l", strtotime($booking_datestart));
							$thisday = date("l", strtotime($date));;
							if ($thisday == $bookingday) {
								$bookingthisday = "1";
							} // valid day match within period
						} else {
							$bookingthisday = "1"; // valid day in contiguous period
						}
					}
				}
				if ( $bookingthisday == "1" ) {
					Get_Data("venue", $GLOBALS{'booking_venuecode'});
					if ($GLOBALS{'venue_bookable'} == "Yes") {
						array_push($hfa, $GLOBALS{'booking_timestart'}."#B#".$venue_code."|".$booking_id."#".$GLOBALS{'booking_venuecode'}."#".$GLOBALS{'booking_timeend'});
						if (!in_array($GLOBALS{'booking_venuecode'}, $hva)) {
							array_push($hva, $GLOBALS{'booking_venuecode'});
						}
						if ($GLOBALS{'booking_timestart'} < $earliesthomeslot) {
							$earliesthomeslot = $GLOBALS{'booking_timestart'};
						}
						if ($GLOBALS{'booking_timestart'} > $latesthomeslot) {
							$latesthomeslot = $GLOBALS{'booking_timestart'};
						}
						if ($GLOBALS{'booking_timeend'} != "") {
							if ($GLOBALS{'booking_timeend'} > $latesthomeslot) {
								$latesthomeslot = $GLOBALS{'booking_timeend'};
							}
						}
					}
				}
			}
		}
	}
	
	$coursea = Get_Array("course");
	foreach ($coursea as $course_id)  {
		Get_Data("course", $course_id);
		$course_datestart = $GLOBALS{'course_datestart'};
		$course_dateend = $GLOBALS{'course_dateend'};
		if (($course_dateend == "")||($course_dateend == "0000-00-00")) {
			$course_dateend = $course_datestart;
		}
		$bookingthisday = "0";
		// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend);
		if (($course_datestart == $course_dateend)&&($date == $course_datestart)) {
			// single booking
			$bookingthisday = "1";
		} else {
			if (($date >= $course_datestart)&&($date <= $course_dateend)) {
				// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend."|".$GLOBALS{'course_weeklyrepeating'});
				if ($GLOBALS{'course_weeklyrepeating'} == "Yes") {
					$bookingday = date("l", strtotime($course_datestart));
					$thisday = date("l", strtotime($date));;
					if ($thisday == $bookingday) {
						$bookingthisday = "1";
					} // valid day match within period
				} else {
					$bookingthisday = "1"; // valid day in contiguous period
				}
			}
		}
		if ( $bookingthisday == "1" ) {
			Get_Data("venue", $GLOBALS{'course_venuecode'});
			if ($GLOBALS{'venue_bookable'} == "Yes") {
				array_push($hfa, $GLOBALS{'course_timestart'}."#C#".$course_id."#".$GLOBALS{'course_venuecode'}."#".$GLOBALS{'course_timeend'});
				if (!in_array($GLOBALS{'course_venuecode'}, $hva)) {
					array_push($hva, $GLOBALS{'course_venuecode'});
				}
				if ($GLOBALS{'course_timestart'} < $earliesthomeslot) {
					$earliesthomeslot = $GLOBALS{'course_timestart'};
				}
				if ($GLOBALS{'course_timestart'} > $latesthomeslot) {
					$latesthomeslot = $GLOBALS{'course_timestart'};
				}
				if ($GLOBALS{'course_timeend'} != "") {
					if ($GLOBALS{'course_timeend'} > $latesthomeslot) {
						$latesthomeslot = $GLOBALS{'course_timeend'};
					}
				}
			}
		}
	}

	if(empty($uhfa)){
	} else {
		XHR();
		XH3("Home fixtures not yet scheduled");
		XFORM("bookingmasterschedulerupdatein.php","masterschedulerupdate");
		XINSTDHID();
		XINHID('season',$season);
		XINHID('requesteddate',$date);
		XTABLE();
		XTR();
		XTDHTXT("Team");XTDHTXT("Date");XTDHTXT("Seq");XTDHTXT("Opposition");XTDHTXT("H/A");XTDHTXT("Lg/<br>Cup/<br>Fr");XTDHTXT("Venue");
		XTDHTXT("Time<br> eg 14:30");XTDHTXT("Time End<br>(optional)");XTDHTXT("Info");
		X_TR();
		sort($uhfa);
		$formseq = 1;
		foreach ($uhfa as $uhf)  {
			$bits = explode('#',$uhf);
			$ttime = $bits[0];
			$type = $bits[1];
			$frs_id = $bits[2];
			$tvenue = $bits[3];
			$ttimeend = $bits[4];
			if ($type == "F") {
				$bits = str_split($frs_id);
				$tteam_code = $bits[0].$bits[1];
				Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
				Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
				$tteam_name = $GLOBALS{'team_name'};
				$section = GetSectionFromTeamCode ($tteam_code);
				XTR();
				XINHID('frs_id'.$formseq,$frs_id);
				XTDTXT($GLOBALS{'team_name'});
				XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
				XTDTXT($GLOBALS{'frs_seq'});
				XTDINTXT('frs_oppo'.$formseq,$GLOBALS{'frs_oppo'},"20","30");
				XTDINSELECTHASH(List2Hash("H,A"),'frs_ha'.$formseq,$GLOBALS{'frs_ha'});
				XTDINSELECTHASH(List2Hash("L,C,F"),'frs_lcf'.$formseq,$GLOBALS{'frs_lcf'});
				XTD();
				$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
				XTXT("Home:");XINSELECTHASH($xhash,'frs_venue'.$formseq,$GLOBALS{'frs_venue'});XBR();
				XTXT("Away:");XINTXT('frs_awayvenue'.$formseq,"","30","60");
				X_TD();
				XTDINTXT('frs_time'.$formseq,$GLOBALS{'frs_time'},"5","8");
				XTDINTXT('frs_timeend'.$formseq,$GLOBALS{'frs_end'},"5","8");
				XTDINTXT('frs_info'.$formseq,$GLOBALS{'frs_end'},"5","8");
				X_TR();
				$formseq++;
			}
		}
		X_TABLE();
		XBR();
		XINHID('maxformseq',$formseq);
		XINSUBMIT("Update");
		X_FORM();
		XHR();
	}

	$highlightuptoa = Array();
	foreach ($hva as $hv) {
		$highlightuptoa[$hv] = "";
	}
	
	XH2("Home Fixtures");
	if(empty($hfa)){
		print "<P>No home fixtures have been found for this date\n";
	} else {
		if ( $GLOBALS{'LOGIN_frame_id'} != "F" ) {
			// Full Format
			sort($hfa);
			/*
			 XHR();
			XPTXT($earliesthomeslot." - ".$latesthomeslot);
			foreach ($hfa as $hf)  { XPTXT($hf); }
			*/
			$schedule = Array();
			for ($hh = 0; $hh < 24; $hh++) {
				for ($mm = 0; $mm < 4; $mm++) {
					$stime = substr("0".$hh,-2).":".substr("0".($mm*15),-2);
					array_push($schedule, $stime);
				}
			}
			$slotindex = 0;
			foreach ($schedule as $slot)  {
				if ($slot == $latesthomeslot) {
					$latestslotindex = $slotindex + 5;
				}
				$slotindex++;
			}
			if ($latestslotindex > count($schedule)-1) {
				$latestslotindex = $schedule[end($schedule)];
			}
			$latesthomeslot = $schedule[$latestslotindex];

			XTABLE(); XTR();XTDHTXT("Time");
			$hvindex = 0; $thishvindex = 0;
			foreach ($hva as $hv)  {
				Check_Data('venue',$hv);
				if ( $GLOBALS{'IOWARNING'} == "0") {
					XTDHTXT($GLOBALS{'venue_name'});
				} else {XTDHTXT($hv);
				}
			}
			X_TR();
			$slotindex = 0;
			foreach ($schedule as $slot)  {
				if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
					XPTXT($earliesthomeslot."|".$latesthomeslot."|");
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					if (substr($slot,3,2) == "00") {
						XTR(); XTDHTXT("");
						foreach ($hva as $hv )  {
							XTDHTXT("");
						}
						X_TR();
					}
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					XTR();
				}
				$hvindex = 0;
				foreach ($hva as $hv)  {
					$ftext = ""; $sep = "";
					foreach ($hfa as $hf)  {
						$bits = explode('#',$hf);
						$ttime = $bits[0];
						$type = $bits[1];
						$id = $bits[2];
						$tvenue = $bits[3];
						$ttimeend = $bits[4];
						if ($slotindex == count($schedule)-1) {
							$nextslot = "99.99";
						}  else {$nextslot = $schedule[$slotindex+1];
						}
						if (($ttime >= $slot)&&($ttime < $nextslot)&&($tvenue == $hv)) {
							if ($type == "F") {
								$bits = str_split($id);
								$tteam_code = $bits[0].$bits[1];
								Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$id);
								Check_Data("team",$GLOBALS{'currperiodid'}, $tteam_code);
								if ($GLOBALS{'IOWARNING'} == "0") {
									$tteam_name = $GLOBALS{'team_name'};
									if ($ttimeend == "?") {	$ttimeendtxt = ""; }
									else { $ttimeendtxt = " (until ".$ttimeend.")"; }
									$ttimeendtxt = "";
									$ftext = $ftext.$sep.$tteam_name." v ".$GLOBALS{'frs_oppo'}.$ttimeendtxt;
									if ($ttimeend > $highlightuptoa[$hv]) { $highlightuptoa[$hv] = $ttimeend; }
									$sep = "<br>";
								}
							}
							if ($type == "B") {
								$bits = explode('|',$id);
								Get_Data("booking",$bits[0],$bits[1]);
								if ($ttimeend == "?") {	$ttimeendtxt = ""; }
								else { $ttimeendtxt = " (until ".$ttimeend.")"; }
								$ftext = $ftext.$sep.$GLOBALS{'booking_title'}.$ttimeendtxt;
								if ($ttimeend > $highlightuptoa[$hv]) { $highlightuptoa[$hv] = $ttimeend; }							
								$sep = "<br>";
							}
							if ($type == "C") {
								Get_Data("course",$id);
								Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
								if ($ttimeend == "?") {	$ttimeendtxt = ""; }
								else { $ttimeendtxt = " (until ".$ttimeend.")"; }
								$ftext = $ftext.$sep.$GLOBALS{'coursecategory_name'}." - ".$GLOBALS{'course_title'}.$ttimeendtxt;
								if ($ttimeend > $highlightuptoa[$hv]) { $highlightuptoa[$hv] = $ttimeend; }
								$sep = "<br>";
							}
						}
					}
					if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
						if ($hvindex == 0) {
							XTDTXT($slot);
						}
						if ($ftext != "") {
							XTDTXTHIGHLIGHT($ftext);
						} else {
							if ($slot > $highlightuptoa[$hv] ) { $highlightuptoa[$hv] = ""; }
							if (($highlightuptoa[$hv] != "")&&($slot < $highlightuptoa[$hv])) { XTDTXTHIGHLIGHT($ftext);  }
							else { XTDTXT($ftext); }
						}
					}
					$hvindex++;
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					X_TR();
				}
				$slotindex++;
			}
			X_TABLE();
		} else {	// Facebook condensed format
			XTABLE();
			XTR();XTDHTXT("Time");XTDHTXT("Team");XTDHTXT("Opposition");XTDHTXT("Venue");X_TR();
			sort($hfa);
			foreach ($hfa as $hf)  {
				$bits = explode('#',$hf);
				$ttime = $bits[0];
				$type = $bits[1];
				$frs_id = $bits[2];
				$bits = str_split($frs_id);
				$tteam_code = $bits[0].$bits[1];
				Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
				Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
				$tteam_name = $GLOBALS{'team_name'};
				XTR();XTDTXT($ttime);XTDTXT($GLOBALS{'team_name'});XTDTXT($GLOBALS{'frs_oppo'});XTDTXT($GLOBALS{'frs_venue'});X_TR();
			}
			X_TABLE();
		}
	}
}

function Booking_BOOKINGUPDATELIST_Output ($venue_code) {
	Get_Data('venue',$venue_code);
	XH2("Bookings Administration - ".$GLOBALS{'venue_name'});
	XFORM("bookingupdateout.php","newcourse");
	XINSTDHID();
	XINHID("venue_code",$venue_code);		
	XINHID("booking_id","new");
	XINSUBMIT("Create New Booking");
	X_FORM();
	XBR();XBR();
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date Start");
	XTDHTXT("Date End");
	XTDHTXT("Time Start");
	XTDHTXT("Time End");	
	XTDHTXT("Weekly");
	XTDHTXT("Day");	
	XTDHTXT("Contact");		
	XTDHTXT("Status");
	XTDHTXT("Update");
	X_TR();
	$booking_ida = Get_Array('booking',$venue_code);
	foreach ($booking_ida as $booking_id) {
		Get_Data('booking',$venue_code,$booking_id);
		XTR();
		XTDTXT($booking_id);
		XTDTXT($GLOBALS{'booking_title'});
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'booking_datestart'}));
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'booking_dateend'}));
		XTDTXT($GLOBALS{'booking_timestart'});
		XTDTXT($GLOBALS{'booking_timeend'});
		XTDTXT($GLOBALS{'booking_weeklyrepeating'});
		XTDTXT($GLOBALS{'booking_dayofweek'});
		XTDTXT($GLOBALS{'booking_contact'});
		XTDTXT($GLOBALS{'booking_status'});		
		$link = YPGMLINK("bookingupdateout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("venue_code",$venue_code).YPGMPARM("booking_id",$booking_id).YPGMPARM("menulist",$bookingupdate);
		XTDLINKTXT($link,"update");
		X_TR();
	}
	X_TABLE();
}


function Booking_BOOKINGUPDATE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_BOOKINGUPDATE_Output ($venue_code, $booking_id) {
	if ($booking_id == "new") {
		Initialise_Data('booking');
		$GLOBALS{'booking_status'} = "Draft";
		$booking_ida = Get_Array('booking', $venue_code);
		$highestbooking_id = "BK00000";
		foreach ($booking_ida as $booking_id) {
			$highestbooking_id = $booking_id;
		}
		$highestbooking_seq = str_replace("BK", "", $highestbooking_id);
		$highestbooking_seq++;
		$booking_id = "BK".substr(("00000".$highestbooking_seq), -5);
		XH1("New Booking - ".$booking_id);

	} else {
		Get_Data('booking', $venue_code, $booking_id);
		XH1("Course - ".$booking_id." - ".$GLOBALS{'booking_title'});
	}
	// $helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;
	XFORMUPLOAD("bookingupdatein.php","bookingupdatein");
	XINSTDHID();
	XINHID("venue_code",$venue_code);	
	XINHID("booking_id",$booking_id);
	XHR();
	XH4('Title.');
	XINTXT("booking_title",$GLOBALS{'booking_title'},"50","100");
	XH4('Full description of booking.');
	XINTEXTAREA("booking_description",$GLOBALS{'booking_description'},"5","100");
	XHR();
	XH4('Booking Venue and Schedule.');
	XTABLE();
	$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
	XTR();XTDTXT('Start Date');XTD();XINDATEYYYY_MM_DD("booking_datestart",$GLOBALS{'booking_datestart'});X_TD();X_TR();
	XTR();XTDTXT('End Date (optional)');XTD();XINDATEYYYY_MM_DD("booking_dateend",$GLOBALS{'booking_dateend'});X_TD();X_TR();	
	XTR();XTDTXT('Start Time');XTD();XINTXT("booking_timestart",$GLOBALS{'booking_timestart'},"10","50");X_TD();X_TR();
	XTR();XTDTXT('End Time');XTD();XINTXT("booking_timeend",$GLOBALS{'booking_timeend'},"10","50");X_TD();X_TR();	
	XTR();XTDTXT('Weekly Repeating');XTD();XINCHECKBOXYESNO ("booking_weeklyrepeating",$GLOBALS{'booking_weeklyrepeating'},"");X_TD();X_TR();	
	XTR();XTDTXT('Contact for Booking');
	XTD();XINTXTID("booking_contact","booking_contact",$GLOBALS{'booking_contact'},"50","100");
	XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
	XTXTID("booking_contactname",View_Person_List($GLOBALS{'booking_contact'}));
	XBR();X_TD();X_TR();
	X_TABLE();
	XHR();
	XH4('Booking Status');
	$xhash = List2Hash("Requested,Confirmed");
	XINRADIOHASH ($xhash,"booking_status",$GLOBALS{'booking_status'});XBR();
	XINSUBMIT("Update Booking");
	X_FORM();

	// Go_Back_To_CourseList;XBR();

	$GLOBALS{'PersonSelectPopupParameters'} = array(
		"this,person_id|person_sname|person_fname|person_section",
		"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
		"field,Lookup,Select,booking_contact,booking_contactname,100",
		"person_id",
		"all",
		"Stats Select,center,center,800,600",
	  	"view",
		"buildfulllist"
	);
	// $parm2 = Buttons Id – field,To,To..,ToPersonIdList,ToPersonNameList,70|field,Cc,CC..,CcDistList,CcPersonList,70
}

function UpdateEventAttendeeStatus ($event_attendeeref,$parm1,$parm2,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments) {
	// XPTXT('UpdateCourseAttendeeStatus "'.$event_attendeeref.'"');
	$attendeestatuslist = $GLOBALS{'event_attendeestatuslist'};
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	// XPTXT('BEFOREADD "'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$updatedattendeestatuslist = "";
	$found = "0";
	$sep = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			$attbits = explode('~',$attendeestatuslistelement);
			if ($event_attendeeref == $attbits[0]) {
				if ($parm1 != "") {$attbits[1] = $parm1;}
				if ($parm1 == "null") {$attbits[1] = "";}					
				if ($parm2 != "") {$attbits[2] = $parm2;}
				if ($parm2 == "null") {$attbits[2] = "";}				
				if ($paymenttype != "") {$attbits[3] = $paymenttype;}
				if ($paymenttype == "null") {$attbits[3] = "";}					
				if ($paymentdue != "") {$attbits[4] = $paymentdue;}
				if ($paymentdue == "null") {$attbits[4] = "";}				
				if ($paymentreceived != "") {$attbits[5] = $paymentreceived;}
				if ($paymentreceived == "null") {$attbits[5] = "";}	
				if ($paymentcomments != "") {$attbits[6] = $paymentcomments;}
				if ($paymentcomments == "null") {$attbits[6] = "";}	
				$updatedattendeestatuslist = $updatedattendeestatuslist.$sep.$attbits[0].'~'.$attbits[1].'~'.$attbits[2].'~'.$attbits[3].'~'.$attbits[4].'~'.$attbits[5].'~'.$attbits[6];
				$sep = "*";
				$found = "1";
			} else {
				$updatedattendeestatuslist = $updatedattendeestatuslist.$sep.$attbits[0].'~'.$attbits[1].'~'.$attbits[2].'~'.$attbits[3].'~'.$attbits[4].'~'.$attbits[5].'~'.$attbits[6];
				$sep= "*";
			}
		}
	}
	if ($found == "0") {
		$updatedattendeestatuslist = $updatedattendeestatuslist.$sep.$event_attendeeref.'~'.$parm1.'~'.$parm2.'~'.$paymenttype.'~'.$paymentdue.'~'.$paymentreceived.'~'.$paymentcomments;
	}	
	// XPTXT('MIDDLE "'.$updatedattendeestatuslist.'"');

	if ($updatedattendeestatuslist == "*") { $updatedattendeestatuslist = ""; } // just to be sure
	// XPTXT('AFTERADD "'.$updatedattendeestatuslist . '"');
	$GLOBALS{'event_attendeestatuslist'} = $updatedattendeestatuslist;
}


function DeleteEventAttendeeStatus ($event_attendeeref) {
	$attendeestatuslist = $GLOBALS{'event_attendeestatuslist'};
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	// XPTXT('BEFOREDELETE <br>"'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$updatedattendeestatuslist = "";
	$sep = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			// XPTXT('"'.$attendeestatuslistelement.'"');
			$attbits = explode('~',$attendeestatuslistelement);
			if ($event_attendeeref == $attbits[0]) { } // drop this person
			else {
				$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $attbits[0] .'~'. $attbits[1] .'~'. $attbits[2] .'~'. $attbits[3] .'~'. $attbits[4] .'~'. $attbits[5] .'~'. $attbits[6];; 
				$sep = "*";
			}			
		}
		
	}

	if ($updatedattendeestatuslist == "*") { $updatedattendeestatuslist = ""; } // just to be sure
	// XPTXT('AFTERDELETE <br>"'.$updatedattendeestatuslist . '"');
	$GLOBALS{'event_attendeestatuslist'} = $updatedattendeestatuslist;
}

function GetEventAttendeeStatus ($event_attendeeref) {
	$attendeestatuslist = $GLOBALS{'event_attendeestatuslist'};
	if ($attendeestatuslist == "*") {
		$attendeestatuslist = "";
	} // just to be sure
	// XPTXT('BEFOREDELETE "'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$foundstring = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			// XPTXT('"'+$attendeestatuslistelement+'"');
			$attbits = explode('~',$attendeestatuslistelement);
			if ($event_attendeeref == $attbits[0]) {
				$foundstring = $attendeestatuslistelement;
			}
		}
	}
	return $foundstring;
}


function GetNextTicketRange($draw_id,$drawtxn_ticketquantity) {
	// returns allocated : drawtxn, startticketrange, endticketrange
	// This copes with Ticket Number of format Ann, AAnnnn etc  where A= Alphabetic and n=numeric
	$newticketrangea = Array();
	// ====== Establish ticketrange structure ======================
	$prefix = "";
	$numberstring = "";
	$draw_startrange = $GLOBALS{'draw_startrange'};
	if ( $draw_startrange == "" ) { $draw_startrange = "TKT000"; }
	for( $i = 0; $i<strlen($draw_startrange); $i++ ) {
		if ( (substr($draw_startrange, $i, 1) >= "0")&&(substr($draw_startrange, $i, 1) <= "9")  )	{
			$numberstring = $numberstring . substr($draw_startrange, $i, 1);
		} else {
			$prefix = $prefix . substr($draw_startrange, $i, 1);
		}	
	}	
	// ====== FIrstly find the next available database keys ======================
	$highestdrawtxnid = "DT00000";
	$highestdrawtxnrange = $GLOBALS{'draw_startrange'};		
	$drawtxna = Get_Array('drawtxn',$draw_id);	
	foreach ($drawtxna as $drawtxn_id) {
		Get_Data('drawtxn',$draw_id,$drawtxn_id);
		if ($drawtxn_id > $highestdrawtxnid ) { $highestdrawtxnid = $drawtxn_id; }
		if ($GLOBALS{'drawtxn_endrange'} > $highestdrawtxnrange ) { $highestdrawtxnrange = $GLOBALS{'drawtxn_endrange'}; } 
	}
	$highestdrawtxnseq = str_replace("DT", "", $highestdrawtxnid);
	$highestdrawtxnseq++;
	$nextdrawtxnid = "DT".substr(("00000".$highestdrawtxnseq), -5);	
	array_push($newticketrangea, $nextdrawtxnid);	
	if (!empty($drawtxna)) {
		$highestdrawtxnrangeseq = str_replace($prefix, "", $highestdrawtxnrange);
	}else{
		$highestdrawtxnrangeseq = str_replace($prefix, "", $highestdrawtxnrange);
		$highestdrawtxnrangeseq = $highestdrawtxnrangeseq - 1; // Just to make first ever ticket correct
	}
	// ====== Now find the next ticket range ======================
	
	$startdrawtxnrangeseq = $highestdrawtxnrangeseq + 1 ;
	$startdrawtxnrange = $prefix.substr(("00000".$startdrawtxnrangeseq), -1*strlen($numberstring));
	array_push($newticketrangea, $startdrawtxnrange);
	$enddrawtxnrangeseq = $highestdrawtxnrangeseq + $drawtxn_ticketquantity ;	
	$endrawtxnrange = $prefix.substr(("00000".$enddrawtxnrangeseq), -1*strlen($numberstring));
	array_push($newticketrangea, $endrawtxnrange);	

	// XPTXT($newticketrangea[0]." ".$newticketrangea[1]." ".$newticketrangea[2]);
	return $newticketrangea;
}

=======
<?php # bookingroutines.inc

function Booking_EventBooking_CSSJS () {
	// WHY
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_EventBooking_Output ($event_id,$fname,$sname,$email){
	XH1("Event Booking");
	Get_Data("event",$event_id);
	Webpage_WEBSTYLE_Output();
	XDIV($event_id,"eaclass" );
	XH2($GLOBALS{'event_title'});
	XTXT($GLOBALS{'event_excerpt'});
	if ($GLOBALS{'event_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT($GLOBALS{'event_description'});
	XBR();
	Check_Data("person",$GLOBALS{'event_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$showmobiletel = ""; $showemail = "";
		if ($GLOBALS{'person_mobiletel'} != "" ) {
			$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
		}
		if ($GLOBALS{'person_email1'} != "" ) {
			$showemail = "Email: ".$GLOBALS{'person_email1'};
		}
		XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
	} else {
		XTXT("Contact - ".$GLOBALS{'event_contact'});
	}
	XBR();
	XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
	XBR();
	XTXT("Time - ".$GLOBALS{'event_time'});
	XBR();
	Check_Data('venue',$GLOBALS{'event_venuecode'});
	XTXT("Venue - ".$GLOBALS{'venue_name'});		
	XBR();XBR();
	
	
	if ($GLOBALS{'event_full'} == "Yes") { XH4("Sorry this event is now fully booked."); }
	if ($GLOBALS{'event_personorteam'} == "Team") { XTXT("This is a team event").XBR(); }	
	
	if ($GLOBALS{'event_bookable'} == "Yes") {
		if ($GLOBALS{'event_charge'} != 0) {
			if ($GLOBALS{'event_personorteam'} == "Team") { 
				XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
			} else { 
				XTXT($chargetext.$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
				if ($GLOBALS{'event_discountpercent'} != "") {
					XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
				}				
			}
		}
	} else {
		if ($GLOBALS{'event_charge'} != 0) {
			if ($GLOBALS{'event_personorteam'} == "Team") { 
				XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
			} else { 
				XTXT($chargetext.$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
				if ($GLOBALS{'event_discountpercent'} != "") {
					XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
				}				
			}
		}
	}	
	
	XBR();XBR();

	
	X_DIV($event_id);
	XHR();
	XH1("Booking Details");
	XFORM("bookingeventin.php","eventin");
	XINMINHID();
	XINHID("event_id",$event_id);
	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Email');
	XINTXT("Email",$email,"50","100");
	XBR();XBR();	
	if ($GLOBALS{'event_personorteam'} == "Team") {			
		XH4('Team Name');
		XINTXT("TeamName","","50","100");
		XH4('Team Members (optional)');
		XINTEXTAREA("TeamMembers","","5","40");		
	} else {
		XH4('Event Places Required');
		XINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),"EventPlacesRequired",""); 
		XH4('Names (if more than one place required)');
		XINTEXTAREA("EventNamesRequired","","5","40");		
	}
	XBR();XBR();
	XINSUBMIT("Continue to Book Event");
	X_FORM();

}

function Booking_EventPayPalPayment_Output ($event_id, $event_attendeeref, $event_charge) {
	// XH4("$event_charge ".$event_charge);
	// if ($event_attendeeref == "bbra") { $event_charge = 1; }
	$eventcharge = floatval($event_charge);
	Get_Data("event",$event_id);
	Get_Data("eventcategory",$GLOBALS{'event_categoryid'});
	XH2("Debit/Credit Card Payment via PayPal") ;
	XBR();
	XTABLE();
	XTR();XTDTXT("Event");XTDTXT($GLOBALS{'event_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($eventcharge, 2, '.', ''));X_TR();
	X_TABLE();

	if ( strlen(strstr($event_attendeeref,'|'))>0 ) {
		$abits = explode('|',$event_attendeeref);
		$thisfname = $abits[0];
		$thissname = $abits[1];
		$thisaddr1 = "";
		$thisaddr2 = "";
		$thisaddr3 = "";
		$thisaddr4 = "";
		$thispostcode = "";
		$thisemail = $abits[2];
		$thistel = "";
	} else {
		Get_Data('person',$event_attendeeref);
		$thisfname = $GLOBALS{'person_fname'};
		$thissname = $GLOBALS{'person_sname'};
		$thisaddr1 = $GLOBALS{'person_addr1'};
		$thisaddr2 = $GLOBALS{'person_addr2'};
		$thisaddr3 = $GLOBALS{'person_addr3'};
		$thisaddr4 = $GLOBALS{'person_addr4'};
		$thispostcode = $GLOBALS{'person_postcode'};
		$thisemail = $GLOBALS{'person_email1'};
		if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email3'};}
		if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email2'};}
		$thistel = $GLOBALS{'person_mobiletel'};
		if ( $thistel == "" ) {
			$thistel = $GLOBALS{'person_emergencytel'};
		}
	}

	XH3("Proceed to make payment");
	XUL("","");
	XLI("","");XTXT('Please note that you dont have to have a paypal account... just use the option to pay with debit or credit card.');X_LI();
	XLI("","");XTXT("Check that the Card you are using matches the pre-populated address - or change the address to match the Card.");X_LI();
	XLI("","");XTXT('After payment select the "Return to Club" link on the final paypal screen to finalise your booking.');X_LI();
	X_UL();
	$paypalamount = number_format(($eventcharge*1.00), 2, '.', '');
	// if ($GLOBALS{'event_attendeeref'} == "abow") { $paypalamount = "1.00"; }
	if ($GLOBALS{'site_server'} != "W") {
		print'<form action="https://www.paypal.com/cgi-bin/webscr" method="post">'."\n"; // real
	} else {
		XFORM("paypalsimulation.php","paypalsimulation"); // simulation
		XINSTDHID();
	}
	XINHID('business',$GLOBALS{'eventcategory_paypalemail'});
	XINHID('cmd',"_xclick");
	XINHID('item_name',$GLOBALS{'event_title'}." - ".$thisfname." ".$thissname);
	// domain_id|purposetype|purposeref|personid|itemparm1|itemparm2|itemparm3
	$escaped_event_attendeeref = $event_attendeeref;
	$escaped_event_attendeeref = str_replace('@', 'AT', $escaped_event_attendeeref);
	$escaped_event_attendeeref = str_replace('|', 'PIPE', $escaped_event_attendeeref);		
	XINHID('item_number',$GLOBALS{'LOGIN_domain_id'}."|Event|".$event_id."|".$escaped_event_attendeeref."|".""."|".""."|"."");
	XINHID('first_name',$thisfname);
	XINHID('last_name',$thissname);
	XINHID('address1',$thisaddr1);
	XINHID('address2',$thisaddr2);
	XINHID('city',$thisaddr3);
	XINHID('state',$thisaddr4);
	XINHID('zip',$thispostcode);
	XINHID('email',$thisemail);
	$tbits = explode(" ",$thistel);
	XINHID('night_phone_a',"44");
	XINHID('night_phone_b',$tbits[0].$tbits[1]);
	XINHID('amount',$paypalamount);
	XINHID('currency_code',"GBP");
	$paypalsuccesslink = YPGMLINK("bookingeventpaypalsuccess.php");
	$paypalsuccesslink = $paypalsuccesslink.YPGMSTDPARMS();
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('event_id',$event_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('event_attendeeref',$escaped_event_attendeeref);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('event_selectedcharge',$eventcharge);
	$paypalcancellink = YPGMLINK("bookingeventpaypalcancel.php");
	$paypalcancellink = $paypalcancellink.YPGMSTDPARMS();
	$paypalcancellink = $paypalcancellink.YPGMPARM('event_id',$event_id);
	$paypalcancellink = $paypalcancellink.YPGMPARM('event_attendeeref',$escaped_event_attendeeref);
	$paypalcancellink = $paypalcancellink.YPGMPARM('event_selectedcharge',$eventcharge);
	XINHID('return',$paypalsuccesslink);
	XINHID('cancel_return',$paypalcancellink);
	// XINHID('cancel_return',$paypalsuccesslink); // testing
	
	print'<input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" alt="PayPal - The safer, easier way to pay online"> 	<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >';
	X_FORM();

}

function Booking_EventChequePayment_Output ($event_id, $event_attendeeref, $event_charge) {
	// XH4("$event_charge ".$event_charge);
	$eventcharge = floatval($event_charge);
	Get_Data("event",$event_id);
	Get_Data("eventcategory",$GLOBALS{'event_categoryid'});
	XH2("Payment by Cheque") ;
	XBR();XBR();
	XTABLE();
	XTR();XTDTXT("Event");XTDTXT($GLOBALS{'event_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($eventcharge, 2, '.', ''));X_TR();
	X_TABLE();

	$chequeamount = number_format(($eventcharge*1.00), 2, '.', '');
	XBR();XBR();
	XPTXT('Please make out a cheque for '.$GLOBALS{'countrycurrencysymbol'}.$chequeamount.' payable to "'.$GLOBALS{'eventcategory_bankaccountname'}.'" and mail it to the following address in order to confirm your place on the event');
	Get_Data('person',$GLOBALS{'eventcategory_treasurer'});
	XBR();XTXT($GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'});
	XBR();XTXT($GLOBALS{'person_addr1'});
	XBR();XTXT($GLOBALS{'person_addr2'});
	XBR();XTXT($GLOBALS{'person_addr3'});
	XBR();XTXT($GLOBALS{'person_addr4'});
	XBR();XTXT($GLOBALS{'person_postcode'});
	XBR();
	XPTXT("Thank you");
}

function Booking_EventCashPayment_Output ($event_id, $event_attendeeref, $event_charge) {
	// XH4("$event_charge ".$event_charge);
	$eventcharge = floatval($event_charge);
	Get_Data("event",$event_id);
	Get_Data("eventcategory",$GLOBALS{'event_categoryid'});
	XH2("Payment by Cash") ;
	XBR();
	XTABLE();
	XTR();XTDTXT("Event");XTDTXT($GLOBALS{'event_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($eventcharge, 2, '.', ''));X_TR();
	X_TABLE();
	XBR();
	$cashamount = number_format(($eventcharge*1.00), 2, '.', '');
	XPTXT('Please bring '.$GLOBALS{'countrycurrencysymbol'}.$cashamount.' and pay at the event');
	XBR();
	XPTXT("Thank you");
}


function Booking_EventBankTransferPayment_Output ($event_id, $event_attendeeref, $event_charge) {
	// XH4("eventchargein ".$eventchargein);
	$eventcharge = floatval($event_charge);
	Get_Data("event",$event_id);
	Get_Data("eventcategory",$GLOBALS{'event_categoryid'});
	XH2("Payment by Bank Transfer") ;
	XBR();XBR();
	XTABLE();
	XTR();XTDTXT("Event");XTDTXT($GLOBALS{'event_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($eventcharge, 2, '.', ''));X_TR();
	X_TABLE();

	$banktransferamount = number_format(($eventcharge*1.00), 2, '.', '');
	XBR();XBR();
	XPTXT('Please process a bank transfer for '.$GLOBALS{'countrycurrencysymbol'}.$banktransferamount.' to the following account in order to confirm your place on the event');
	XTABLE();
	XTR();XTDTXT("Account Name");XTDTXT($GLOBALS{'eventcategory_bankaccountname'});X_TR();
	XTR();XTDTXT("Sort Code");XTDTXT($GLOBALS{'eventcategory_banksort'});X_TR();
	XTR();XTDTXT("Account");XTDTXT($GLOBALS{'eventcategory_bankaccount'});X_TR();
	X_TABLE();
	XBR();
	XPTXT('Please also include your name in the payment reference so that we can identify it.');
	XBR();
	XPTXT("Thank you");
}




function Booking_EVENTADMINLIST_Output () {
	XH1("Bookable Events");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date");
	XTDHTXT("Admin");
	XTDHTXT("Report");
	X_TR();
	$event_ida = Get_Array('event');
	foreach ($event_ida as $event_id) {
		Get_Data("event",$event_id);
		if ($GLOBALS{'event_bookable'} == "Yes") {
			XTR();
			XTDTXT($event_id);
			XTDTXT($GLOBALS{'event_title'});
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
			$link = YPGMLINK("bookingeventattendeeadminout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id);
			XTDLINKTXT($link,"attendee administration");
			$link = YPGMLINK("bookingeventreport.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id);
			XTDLINKTXTNEWWINDOW($link,"printable report","report");
			X_TR();
		}
	}
	X_TABLE();
}

function Booking_EVENTATTENDEEADMIN_Output ($eventid) {
	Get_Data('event', $eventid);
	XH2('Event Attendees Administration - '.$GLOBALS{'event_title'});
	XBR();
	XFORM("bookingeventattendeeaddout.php","eventattendeeadd");
	XINSTDHID();
	XINHID("event_id",$eventid);
	XINSUBMIT("Add a New Event Attendee");
	X_FORM();
	XBR();
	XHR();	
	XFORM("bookingeventattendeeadminin.php","eventupdatein");
	XINSTDHID();
	XINHID("event_id",$eventid);
	XTABLE();
	XTR();
	XTDHTXT("Name");
	XTDHTXT("Email");
	if ($GLOBALS{'event_personorteam'} == "Team") {
		XTDHTXT("Team Name");
		XTDHTXT("Team Members");
	} else {
		XTDHTXT("Places<br>Requested");
		XTDHTXT("Names");
	}
	XTDHTXT("Payment<br>Due");
	XTDHTXT("Payment<br>Comments");
	XTDHTXT("Payment<br>Method");
	XTDHTXT("Payment<br>Received");
	XTDHTXT("Remove<br>from Event");	
	X_TR();

	$eventattendeestatusa = AttendeeStatus2Array($GLOBALS{'event_attendeestatuslist'});
	// $event_attendeeref,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	$formseq = 1;
	foreach ($eventattendeestatusa as $eventattendeestatuselement) {
		$attbits = explode('~',$eventattendeestatuselement);
		$event_attendeeref = $attbits[0];
		$parm1 = $attbits[1];
		$parm2 = $attbits[2];				
		$paymenttype = $attbits[3];
		$paymentdue = $attbits[4];
		$paymentreceived = $attbits[5];
		$paymentcomments = $attbits[6];
		XINHID($formseq."_AttendeeRef",$event_attendeeref);
		XTR();
		if ( strlen(strstr($event_attendeeref,'|'))>0 ) {
			$abits = explode('|',$event_attendeeref);
			$thisfname = $abits[0];
			$thissname = $abits[1];
			$thisemail = $abits[2];
		} else {
			Get_Data('person',$event_attendeeref);
			$thisfname = $GLOBALS{'person_fname'};
			$thissname = $GLOBALS{'person_sname'};
			$thisemail = $GLOBALS{'person_email1'};
			if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email3'};}
			if ( $thisemail == "" ) {$thisemail = $GLOBALS{'person_email2'};}		
		}		
		XTDTXT($thisfname." ".$thissname);
		XTDTXT($thisemail);
		if ($GLOBALS{'event_personorteam'} == "Team") {
			XTDINTXT($formseq."_TeamName",$parm1,"20","80");			
			XTDINTEXTAREA($formseq."_TeamMembers",$parm2,"5","25");
		} else {
			XTDINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),$formseq."_EventPlacesRequired",$parm1);
			XTDINTEXTAREA($formseq."_EventNamesRequired",$parm2,"5","25");
		}
		XTDINTXT($formseq."_paymentdue",$paymentdue,"7","7");
		XTDINTXT($formseq."_paymentcomments",$paymentcomments,"20","80");
		XTDINSELECTHASH(List2Hash("Card,Cash,Cheque,BankTransfer"),$formseq."_paymenttype",$paymenttype);
		XTDINTXT($formseq."_paymentreceived",$paymentreceived,"7","7");
		$link = YPGMLINK("bookingeventattendeedeleteconfirm.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$eventid).YPGMPARM("event_attendeeref",$event_attendeeref);
		XTDLINKTXT($link,"remove");
		X_TR();
		$formseq++;
	}
	X_TABLE();
	XBR();XBR();
	XINHID("formseqmax",$formseq);
	XINSUBMIT("Update Event");
	X_FORM();
}

function Booking_EVENTATTENDEEDELETECONFIRM_Output ($event_id, $event_attendeeref) {
	Get_Data("event",$event_id);
	XH3("Remove Event Attendee - ".$GLOBALS{'event_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	
	$attendeestatuslistelement = GetEventAttendeeStatus($event_attendeeref);
	if ($attendeestatuslistelement != "") {
		$xbits = explode('~',$attendeestatuslistelement);
		if ( strlen(strstr($event_attendeeref,'|'))>0 ) {
			$abits = explode('|',$event_attendeeref);
			$thisfname = $abits[0];
			$thissname = $abits[1];
		} else {
			Get_Data('person',$event_attendeeref);
			$thisfname = $GLOBALS{'person_fname'};
			$thissname = $GLOBALS{'person_sname'};
		}
		if ($GLOBALS{'event_personorteam'} == "Team") {
			XPTXT('Are you sure you want to remove Team  "'.$xbits[1].'" entered  by '.$thisfname.' '.$thissname.' from this event?');
		} else {
			XPTXT('Are you sure you want to remove '.$thisfname.' '.$thissname.' from this event?');
		}
	}
	XBR();
	XFORM("bookingeventattendeedeleteaction.php","deleteattendee");
	XINSTDHID();
	XINHID("event_id",$event_id);
	XINHID("event_attendeeref",$event_attendeeref);
	XINSUBMIT("Confirm Remove");
	X_FORM();
	XBR();XBR();
	XINBUTTONBACK("Cancel");
}

function Booking_EVENTATTENDEEADD1_CSSJS () {
	// WHY	
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
	$GLOBALS{'SITEPOPUPHTML'} = "Calendar_Popup";	
}

function Booking_EVENTATTENDEEADD_Output ($event_id) {
	Get_Data('event',$event_id);
	XH3("Add New Event Attendee - ".$GLOBALS{'event_title'});
	XFORM("bookingeventattendeeaddin.php","eventattendeeaddin");
	XINSTDHID();
	XINHID("event_id",$event_id);

	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Email');
	XINTXT("Email",$email,"50","100");
	XBR();XBR();	
	if ($GLOBALS{'event_personorteam'} == "Team") {			
		XH4('Team Name');
		XINTXT("TeamName","","50","100");
		XH4('Team Members (optional)');
		XINTEXTAREA("TeamMembers","","5","40");		
	} else {
		XH4('Event Places Required');
		XINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),"EventPlacesRequired",""); 
		XH4('Names (if more than one place required)');
		XINTEXTAREA("EventNamesRequired","","5","40");		
	}
	XBR();XBR();
	XINSUBMIT("Add Attendee");
	X_FORM();
}

// ======================================================


/*
 XDIV("simpletablediv_SideBars","container");
 XTABLEJQDTID("simpletabletable_SideBars");
 XTHEAD();
 XTRJQDT();
 
 X_TR();
 X_THEAD();
 XTBODY();
 
 X_TBODY();
 X_TABLE();
 X_DIV("simpletablediv_SideBars");
 XCLEARFLOAT();
 */


function Booking_DRAWUPDATELIST_Output () {
	Get_Data("commsmasters");
	XH2("Raffle Composer");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XH4("How to create Raffles");
	XPTXT("You can create a new raffle or update one of your existing raffles.");
	XPTXT("Once you have created an raffle it will be submitted to the co-ordinator who will post it on the website, include it in a newsletter, or post it on facebook and twitter as requested.");
	XPTXT("Raffles can be composed in a draft status initially and then published.");
	XBR();
	XFORMUPLOAD("bookingdrawupdateout.php","newdraw");
	XINSTDHID();
	XINHID("draw_id","new");
	XINHID("menulist","drawupdatelist");
	XINSUBMIT("Create New Raffle");
	X_FORM();
	XBR();
	XBR();XBR();
	XDIV("simpletablediv_Raffles","container");
	XTABLEJQDTID("simpletabletable_Raffles");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date");
	XTDHTXT("Status");
	XTDHTXT("Contact");
	XTDHTXT("Featured<br>Image");
	XTDHTXT("Edit");
	XTDHTXT("Delete");
	XTDHTXT("WebView");
	XTDHTXT("FacebookView");
	X_TR();
	X_THEAD();
	XTBODY();

	$itemfound = "0";
	$draw_ida = Get_Array('draw');
	$draw_ida = array_reverse($draw_ida);
	foreach ($draw_ida as $draw_id) {
		Get_Data("draw",$draw_id);
		$canupdate = "0";
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'draw_createdbypersonid'}) {
			$canupdate = "1";
		}
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'draw_contact'}) {
			$canupdate = "1";
		}
		if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) {
			$canupdate = "1";
		}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_draweditorlist'})) {
			$canupdate = "1";
		}
		if ( $canupdate == "1") {
			$itemfound = "1";
			XTR();
			XTDTXT($draw_id);
			XTDTXT($GLOBALS{'draw_title'});
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
			if ($GLOBALS{'draw_publicationstatus'} == "") {
				XTDTXT($GLOBALS{'draw_publicationstatus'});
			}
			if ($GLOBALS{'draw_publicationstatus'} == "Draft") {
				XTD();XTXTCOLOR($GLOBALS{'draw_publicationstatus'},"red");X_TD();
			}
			if ($GLOBALS{'draw_publicationstatus'} == "Ready") {
				XTD();XTXTCOLOR($GLOBALS{'draw_publicationstatus'},"orange");X_TD();
			}
			if ($GLOBALS{'draw_publicationstatus'} == "Published") {
				XTD();XTXTCOLOR($GLOBALS{'draw_publicationstatus'},"green");X_TD();
			}
			XTDTXT($GLOBALS{'draw_contact'});
			if ($GLOBALS{'draw_featuredimage'} == "") {
				XTDTXT("");
			}
			else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'},"100");
			}
			$link = YPGMLINK("bookingdrawupdateout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id).YPGMPARM("menulist","drawupdatelist");
			XTDLINKTXT($link,"update");
			$link = YPGMLINK("bookingdrawdeleteconfirm.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id);
			XTDLINKTXT($link,"delete");
			$link = YPGMLINK("webpagedrawwebview.php");
			$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
			XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
			$link = YPGMLINK("webpagedrawfbview.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id);
			XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
			X_TR();
		}
	}
	X_TBODY();
	X_TABLE();
	X_DIV("simpletablediv_Raffles");
	XCLEARFLOAT();
	if ($itemfound == "0") {
		XH5("No raffles created by me so far");
	}
}

function Booking_DRAWDELETECONFIRM_Output ($draw_id) {
	Get_Data("draw",$draw_id);
	XH3("Delete Raffle - ".$draw_id." - ".$GLOBALS{'draw_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this raffle");
	XBR();
	XFORM("webpagedrawdeleteaction.php","deletedraw");
	XINSTDHID();
	XINHID("draw_id",$draw_id);
	XINSUBMIT("Confirm Raffle Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Booking_DRAWUPDATE_CSSJS () {
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,tinymcesliminit,tinymceslimreturnfromupload,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,tinyslimimagepopup,tinyformattedsectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,FormattedSection_Popups";	
}

function Booking_DRAWUPDATE_Output ($drawid, $menulist) {
	if ($drawid == "new") {
		Initialise_Data('draw');
		$GLOBALS{'draw_publicationstatus'} = "Draft";
		$draw_ida = Get_Array('draw');
		$highestdraw_id = "E00000";
		foreach ($draw_ida as $draw_id) {
			$highestdraw_id = $draw_id;
		}
		$highestdraw_seq = str_replace("E", "", $highestdraw_id);
		$highestdraw_seq++;
		$drawid = "E".substr(("00000".$highestdraw_seq), -5);
		XH2("Raffle Composer - New Raffle - ".$drawid);
	} else {
		Get_Data('draw', $drawid);
		XH2("Raffle Composer - ".$drawid." - ".$GLOBALS{'draw_title'});
	}
	// $helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;
	XFORMUPLOAD("bookingdrawupdatein.php","drawin");
	XINSTDHID();
	XINHID("draw_id",$drawid);
	XINHID("menulist",$menulist);
	XINHID("TinyMCEUploadTo","Draw");
	XINHID("TinyMCEUploadId",$drawid);
	XHR();
	XH2('Title');
	XINTXT("draw_title",$GLOBALS{'draw_title'},"50","100");
	XH2('Short excerpt.');
	XINTEXTAREA("draw_excerpt",$GLOBALS{'draw_excerpt'},"3","100");
	XH2('Full description of draw.');
	XINTEXTAREAMCE("draw_description",$GLOBALS{'draw_description'},"20","100");
	XH2('Featured Image.');
	XINHID("draw_featuredimage",$GLOBALS{'draw_featuredimage'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "draw_featuredimage";
	$imageviewwidth = "300";
	$imagename = $GLOBALS{'draw_featuredimage'};
	$imageuploadto = "Draw";
	$imageuploadid = $drawid;
	$imageuploadwidth = "800";
	$imageuploadheight = "flex";
	$imageuploadfixedsize = "";
	$imagethumbwidth = "200";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	XHR();
	XH2("Raffle Category");
	$xhash = Get_SelectArrays_Hash ("drawcategory","drawcategory_id","drawcategory_name","drawcategory_name","","" );
	XINSELECTHASH($xhash,"draw_drawcategoryid",$GLOBALS{'draw_drawcategoryid'});
	XH2("Raffle Schedule");
	XH4('Venue');
	$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
	XINSELECTHASH($xhash,"draw_venuecode",$GLOBALS{'draw_venuecode'});
	XH4('Date');
	XINDATEYYYY_MM_DD("draw_date",$GLOBALS{'draw_date'});
	XH4('Time');
	XINTXT("draw_time",$GLOBALS{'draw_time'},"10","50");
	XH4('Contact');
	XINTXTID("draw_contact","draw_contact",$GLOBALS{'draw_contact'},"50","100");
	XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
	XTXTID("draw_contactname",View_Person_List($GLOBALS{'draw_contact'}));
	XHR();
	XH2('Charges');
	XINTXT("draw_charge",$GLOBALS{'draw_charge'},"7","7");XTXT("Base charge per ticket.");XBR();
	XINTXT("draw_discountpercent",$GLOBALS{'draw_discountpercent'},"7","7");XTXT("Discount % (If offered)");XBR();	
	XINTXT("draw_discountthreshold",$GLOBALS{'draw_discountthreshold'},"7","7");XTXT("Discount Threshold (If offered)");XBR();
	XH4('Payment Method Options');
	$xhash = List2Hash("Card,Cheque,Cash,BankTransfer");
	XINCHECKBOXHASH ($xhash,"draw_paymentoptionslist",$GLOBALS{'draw_paymentoptionslist'});	
	XH2('Ticket Range');	
	XINTXT("draw_startrange",$GLOBALS{'draw_startrange'},"7","7");XTXT("Start of Range");XBR();	
	XINTXT("draw_endrange",$GLOBALS{'draw_endrange'},"7","7");XTXT("End of Range");XBR();
	XINCHECKBOXYESNO("course_full",$GLOBALS{'course_full'},"Raffle Closed");XBR();	
	XINTXT("draw_selectedrangelist",$GLOBALS{'draw_selectedrangelist'},"40","80");XTXT("Winning Ticket Numbers");XBR();		
	XH2('Terms and Conditions.');
	XINTEXTAREAMCE("draw_tsandcs",$GLOBALS{'draw_tsandcs'},"20","100");
	XHR();
	XH2('Publication Status');
	$canpublish = "0";
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'draw_createdbypersonid'}) {
		$canpublish = "1";
	}
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'draw_contact'}) {
		$canpublish = "1";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) {
		$canpublish = "1";
	}
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_draweditorlist'})) {
		$canpublish = "1";
	}
	if ( $GLOBALS{'draw_publicationstatus'} == "Published" ) {
		$canpublish = "1";
	}
	if ( $canpublish == "1" ) {
		$xhash = Lists2Hash("Draft,Ready,Published","Draft,Ready to Publish,Published");
	}
	else { $xhash = Lists2Hash("Draft,Ready","Draft,Ready to Publish");
	}
	XINRADIOHASH ($xhash,"draw_publicationstatus",$GLOBALS{'draw_publicationstatus'});XBR();
	XHR();
	XH2('Publication Channels Requested');
	XINCHECKBOXYESNO("draw_websiterequested",$GLOBALS{'draw_websiterequested'},"Website");
	XINCHECKBOXYESNO("draw_bulletinrequested",$GLOBALS{'draw_bulletinrequested'},"Bulletin Board");
	XINCHECKBOXYESNO("draw_newsletterrequested",$GLOBALS{'draw_newsletterrequested'},"Newsletter");
	XINCHECKBOXYESNO("draw_facebookrequested",$GLOBALS{'draw_facebookrequested'},"Facebook");
	XINCHECKBOXYESNO("draw_twitterrequested",$GLOBALS{'draw_twitterrequested'},"Twitter");
	XBR();
	XHR();
	XBR();
	XINSUBMIT("Update Raffle");
	X_FORM();

	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
	// Go_Back_To_RaffleArticleList;XBR();

	$GLOBALS{'PersonSelectPopupParameters'} = array(
		"this,person_id|person_sname|person_fname|person_section",
		"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
		"field,Lookup,Select,draw_contact,draw_contactname,100",
		"person_id",
		"all",
		"search,center,center,800,600",
	  	"view",
		"buildfulllist"
	);
}

function Booking_DrawBooking_CSSJS () {
	// WHY
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_DrawBooking_Output ($draw_id,$fname,$sname,$email){
	XH1("Raffle Booking");
	Get_Data("draw",$draw_id);
	Webpage_WEBSTYLE_Output();
	XDIV($draw_id,"eaclass" );
	XH2($GLOBALS{'draw_title'});
	XTXT($GLOBALS{'draw_excerpt'});
	if ($GLOBALS{'draw_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT($GLOBALS{'draw_description'});
	XBR();XBR();
	Check_Data("person",$GLOBALS{'draw_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) { 
		$showmobiletel = ""; $showemail = "";
		if ($GLOBALS{'person_mobiletel'} != "" ) { $showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'}; }
		if ($GLOBALS{'person_email1'} != "" ) { $showemail = "Email: ".$GLOBALS{'person_email1'}; }				
		XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
	} else {
		XTXT("Contact - ".$GLOBALS{'draw_contact'});	
	}
	XBR();
	XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
	XBR();
	XTXT("Time - ".$GLOBALS{'draw_time'});
	XBR();
	Check_Data('venue',$GLOBALS{'draw_venuecode'});
	XTXT("Venue - ".$GLOBALS{'venue_name'});
	XBR();XBR();
	if ($GLOBALS{'draw_full'} == "Yes") {
		XH5("Sorry this draw is now fully booked.");
	}
	XTXT("Charge per ticket - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'draw_charge'}, 2, '.', ''));
	if ($GLOBALS{'draw_discountpercent'} != "") {
		XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'draw_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'draw_discountpercent'}."%");
	}
	XBR();XBR();

	X_DIV($draw_id);
	XHR();
	XH1("Booking Details");
	XFORM("bookingdrawin.php","drawin");
	XINMINHID();
	XINHID("draw_id",$draw_id);
	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Email');
	XINTXT("Email",$email,"50","100");
	XBR();XBR();
	XH4('Tickets Required');
	XINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12,12,14,15,16,17,18,19,20,21,22,23,24"),"DrawTicketQuantity","");
	XBR();XBR();
	XINSUBMIT("Continue to Book Tickets");
	X_FORM();

}

function Booking_DrawPayPalPayment_Output ($draw_id, $drawtxn_id, $drawtxn_personid, $drawtxn_paymentdueamount) {
	// XH4("$draw_charge ".$draw_charge);
	$drawtxnpaymentdueamount = floatval($drawtxn_paymentdueamount);
	Get_Data("draw",$draw_id);
	Get_Data("drawcategory",$GLOBALS{'draw_drawcategoryid'});
	XH2("Debit/Credit Card Payment via PayPal") ;
	XBR();
	XTABLE();
	XTR();XTDTXT("Raffle");XTDTXT($GLOBALS{'draw_title'});X_TR();
	XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'draw_date'}));X_TR();
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($drawtxnpaymentdueamount, 2, '.', ''));X_TR();
	X_TABLE();

	Get_Data('person',$drawtxn_personid);
	$thisfname = $GLOBALS{'person_fname'};
	$thissname = $GLOBALS{'person_sname'};
	$thisaddr1 = $GLOBALS{'person_addr1'};
	$thisaddr2 = $GLOBALS{'person_addr2'};
	$thisaddr3 = $GLOBALS{'person_addr3'};
	$thisaddr4 = $GLOBALS{'person_addr4'};
	$thispostcode = $GLOBALS{'person_postcode'};
	$thisemail = $GLOBALS{'person_email1'};
	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email3'}; }
	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email2'}; }
	$thistel = $GLOBALS{'person_mobiletel'};
	if ( $thistel == "" ) { $thistel = $GLOBALS{'person_emergencytel'}; }


	XH3("Proceed to make payment");
	XUL("","");
	XLI("","");XTXT('Please note that you dont have to have a paypal account... just use the option to pay with debit or credit card.');X_LI();
	XLI("","");XTXT("Check that the Card you are using matches the pre-populated address - or change the address to match the Card.");X_LI();
	XLI("","");XTXT('After payment select the "Return to Club" link on the final paypal screen to finalise your booking.');X_LI();
	X_UL();
	$paypalamount = number_format(($drawtxnpaymentdueamount*1.00), 2, '.', '');
	// if ($GLOBALS{'draw_attendeeref'} == "abow") { $paypalamount = "1.00"; }
	if ($GLOBALS{'site_server'} != "W") {
		print'<form action="https://www.paypal.com/cgi-bin/webscr" method="post">'."\n"; // real
	} else {
		XFORM("paypalsimulation.php","paypalsimulation"); // simulation
		XINSTDHID();
	}
	XINHID('business',$GLOBALS{'drawcategory_paypalemail'});
	XINHID('cmd',"_xclick");
	XINHID('item_name',$GLOBALS{'draw_title'}." - ".$thisfname." ".$thissname);
	// domain_id|purposetype|purposeref|personid|itemparm1|itemparm2|itemparm3
	XINHID('item_number',$GLOBALS{'LOGIN_domain_id'}."|Draw|".$draw_id."|".$drawtxn_id."|".""."|".""."|"."");
	XINHID('first_name',$thisfname);
	XINHID('last_name',$thissname);
	XINHID('address1',$thisaddr1);
	XINHID('address2',$thisaddr2);
	XINHID('city',$thisaddr3);
	XINHID('state',$thisaddr4);
	XINHID('zip',$thispostcode);
	XINHID('email',$thisemail);
	$tbits = explode(" ",$thistel);
	XINHID('night_phone_a',"44");
	XINHID('night_phone_b',$tbits[0].$tbits[1]);
	XINHID('amount',$paypalamount);
	XINHID('currency_code',"GBP");
	$paypalsuccesslink = YPGMLINK("bookingdrawpaypalsuccess.php");
	$paypalsuccesslink = $paypalsuccesslink.YPGMSTDPARMS();
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('draw_id',$draw_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('drawtxn_id',$drawtxn_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('drawtxn_paymentdueamount',$paypalamount);		
	$paypalcancellink = YPGMLINK("bookingdrawpaypalcancel.php");
	$paypalcancellink = $paypalcancellink.YPGMSTDPARMS();
	$paypalcancellink = $paypalcancellink.YPGMPARM('draw_id',$draw_id);
	$paypalcancellink = $paypalcancellink.YPGMPARM('drawtxn_id',$drawtxn_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('drawtxn_paymentdueamount',$paypalamount);	
	
	XINHID('return',$paypalsuccesslink);
	XINHID('cancel_return',$paypalcancellink);
	// XINHID('cancel_return',$paypalsuccesslink); // testing

	print'<input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" alt="PayPal - The safer, easier way to pay online"> 	<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >';
	X_FORM();

}

function Booking_DRAWADMINLIST_Output () {
	XH1("Raffle");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date");
	// XTDHTXT("Admin");
	XTDHTXT("Report");
	XTDHTXT("Web View");
	XTDHTXT("Facebook View");		
	X_TR();
	$draw_ida = Get_Array('draw');
	foreach ($draw_ida as $draw_id) {
		Get_Data("draw",$draw_id);
		XTR();
		XTDTXT($draw_id);
		XTDTXT($GLOBALS{'draw_title'});
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
		// $link = YPGMLINK("bookingdrawticketadminout.php");
		// $link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id);
		// XTDLINKTXT($link,"ticket administration");
		$link = YPGMLINK("bookingdrawreport.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$draw_id);
		XTDLINKTXTNEWWINDOW($link,"printable report","report");
		$link = YPGMLINK("webpagedrawwebview.php");		
		$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
		XTDLINKTXTNEWWINDOW($link,"Web View","report");		
		$link = YPGMLINK("webpagedrawfbview.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
		XTDLINKTXTNEWWINDOW($link,"Web View","report");		
		X_TR();
	}
	X_TABLE();
}

function Booking_SETUPDRAWCATEGORY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Booking_SETUPDRAWCATEGORY_Output() {
	$parm0 = "Draw Category|drawcategory|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|drawcategory_id|drawcategory_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."drawcategory_id|Yes|Category|120|Yes|Draw Category|KeyText,12,12^";
	$parm1 = $parm1."drawcategory_name|Yes|Title|150|Yes|Title|InputText,50,90^";
	$parm1 = $parm1."drawcategory_treasurer|No|||Yes|Treasurer|InputPerson,10,20,Treasurer,Lookup^";
	$parm1 = $parm1."drawcategory_banksort|No||30|Yes|Bank Sort Code|InputText,8,8^";
	$parm1 = $parm1."drawcategory_bankaccount|No||30|Yes|Bank Account Code|InputText,8,8^";
	$parm1 = $parm1."drawcategory_bankaccountname|No||30|Yes|Bank Account Name|InputText,25,50^";
	$parm1 = $parm1."drawcategory_paypalemail|No||30|Yes|Pay Pal Email|InputText,25,50^";
	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Treasurer,Treasurer..,drawcategory_treasurer_input,drawcategory_treasurer_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "drawcategory,center,center,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Booking_DRAWUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,slimjquerymin,slimimagepopup,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
		
}

function Booking_DRAWUTILITY_Output() {
	$parm0 = "Raffles|draw|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section],drawcategory,venue|draw_id|draw_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."draw_id|Yes|Draw Id|70|Yes|Draw Id|KeyGenerated,D[00000]^";
	$parm1 = $parm1."draw_drawcategoryid|Yes|Category|80|Yes|Category|InputSelectFromTable,drawcategory,drawcategory_id,drawcategory_name,drawcategory_id^";
	$parm1 = $parm1."draw_priority|Yes|Seq|100|Yes|Seq|InputText,5,10^";	
	$parm1 = $parm1."draw_title|Yes|Title|100|Yes|Draw Title|InputText,25,50^";
	$parm1 = $parm1."draw_excerpt|No||40|Yes|Draw Excerpt|InputTextArea,3,50^";	
	$parm1 = $parm1."draw_description|No||40|Yes|Draw Description|InputTextArea,10,50^";
	$parm1 = $parm1."draw_date|Yes|Date|80|Yes|Draw Date|InputDate^";
	$parm1 = $parm1."draw_time|Yes|Time|80|Yes|Draw Time|InputText,5,10^";	
	$parm1 = $parm1."draw_contact|Yes|Contact|60|Yes|Event Contact|InputPerson,10,20,Contact,Lookup^";
	$parm1 = $parm1."draw_featuredimage|Yes|Photo|60|Yes|Featured Image|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,600,flex,Event,draw_id^";
	// $parm1 = $parm1."draw_featuredimagecaption|No||40|Yes|Featured Image Caption|InputText,25,50^";
	$parm1 = $parm1."draw_full||||Yes|Draw Full|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."draw_tsandcs|No||40|Yes|Terms and Conditions|InputTextArea,10,50^";
	$parm1 = $parm1."draw_charge||||Yes|Charge|InputText,7,7^";
	$parm1 = $parm1."draw_discountpercent||||Yes|Discount %|InputText,7,7^";
	$parm1 = $parm1."draw_discountthreshold||||Yes|Discount Threshold Quantity|InputText,7,7^";		
	$parm1 = $parm1."draw_paymentoptionslist||||Yes|Payment Options|InputSelectFromList,Card+Cash+Cheque+BankTransfer+None^";
	$parm1 = $parm1."draw_venuecode||||Yes|Booking Venue|InputSelectFromTable,venue,venue_code,venue_name,venue_code^";
	$parm1 = $parm1."draw_createdbypersonid|No||40|Yes|Event Created By|InputPerson,10,20,CreatedBy,Lookup^";
	$parm1 = $parm1."draw_startrange|Yes|Start|60|Yes|Start Range|InputText,7,7^";	
	$parm1 = $parm1."draw_endrange|Yes|End|60|Yes|End Range|InputText,7,7^";	
	$parm1 = $parm1."draw_selectedrangelist||||Yes|Selected|InputText,7,7^";	
	$parm1 = $parm1."draw_publicationstatus|Yes|Status|60|Yes|Publication Status|InputSelectFromList,Draft+Ready+Published^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);

	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Contact,Contact..,draw_contact_input,draw_contact_personlist,50|field,CreatedBy,CreatedBy..,draw_updatepersonidlist_input,draw_updatepersonidlist_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "draw_utility,50,50,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);

}

function Booking_DRAWTXNUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_DRAWTXNUTILITY_Output($drawid) {
	$parm0 = "Draw Transactions|drawtxn[rootkey=".$drawid."]|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|drawtxn_id|drawtxn_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."drawtxn_id|Yes|Transaction Number|70|Yes|Transaction Number|KeyGenerated,DT[00000]^";
	$parm1 = $parm1."drawtxn_personid|Yes|Person|60|Yes|Person|InputPerson,10,20,Person,Lookup^";	
	$parm1 = $parm1."drawtxn_paymentduedate|Yes|Due Date|80|Yes|Due Date|InputDate^";	
	$parm1 = $parm1."drawtxn_paymentdueamount|Yes|Due Amount|70|Yes|Due Amount|InputText,7,7^";	
	$parm1 = $parm1."drawtxn_paymentdate|Yes|Paid Date|80|Yes|Paid Date|InputDate^";
	$parm1 = $parm1."drawtxn_paymentamount|Yes|Amount|70|Yes|Amount|InputText,7,7^";
	$parm1 = $parm1."drawtxn_paymentmethod||||Yes|Payment Options|InputSelectFromList,Card+Cash+Cheque+BankTransfer+None^";
	$parm1 = $parm1."drawtxn_quantity|Yes|Quantity|70|Yes|Quantity|InputText,7,7^";	
	$parm1 = $parm1."drawtxn_startrange|Yes|Start|70|Yes|Start Range|InputText,7,7^";	
	$parm1 = $parm1."drawtxn_endrange|Yes|End|70|Yes|End Range|InputText,7,7^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);

	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Person,Person..,drawtxn_personid_input,drawtxn_personid_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "drawtxn_utility,50,50,900,900";
	$p6 =  "view";
	$p7 =  "singlereplacelist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);

}

// =======================================================

function Booking_CourseBooking_CSSJS () {
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_CourseBooking_Output ($course_id,$fname,$sname,$dob){
	XH1("Course Booking");
	Get_Data("course",$course_id);
	Webpage_WEBSTYLE_Output();
	XDIV($course_id,"eaclass" );
	XH2($GLOBALS{'course_title'});
	XTXT($GLOBALS{'course_excerpt'});
	if ($GLOBALS{'course_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT($GLOBALS{'course_description'});
	XBR();
	Check_Data("person",$GLOBALS{'course_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$showmobiletel = ""; $showemail = "";
		if ($GLOBALS{'person_mobiletel'} != "" ) {
			$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
		}
		if ($GLOBALS{'person_email1'} != "" ) {
			$showemail = "Email: ".$GLOBALS{'person_email1'};
		}
		XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
	} else {
		XTXT("Contact - ".$GLOBALS{'course_contact'});
	}
	XBR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
	} else {
		XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));
	}
	XBR();
	XTXT("Time - ".$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'});
	XBR();
	XTXT("Venue - ".$GLOBALS{'course_venue'});	
	XBR();XBR();
	if ($GLOBALS{'course_charge'} == 0) {
		XTXT("Free of Charge");
	} else {
		XTXT("Charge - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_charge'}, 2, '.', ''));
		if ( $GLOBALS{'course_prepaidcharge'} != 0 ) { XTXT(" : If pre-paid online - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_prepaidcharge'}, 2, '.', '')); }
		if ( $GLOBALS{'course_earlycharge'} != 0 ) { XTXT(" : If pre-paid online before - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_earlychargedate'})." - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_earlycharge'}, 2, '.', '')); }
	}
	if ($GLOBALS{'course_partchargepermitted'} == "Yes") {
		XPTXT($GLOBALS{'course_partchargeinstructions'});		
	}

	XBR();XBR();
	
	XH4("Course Requirements");
	XPTXT($GLOBALS{'course_requirements'});
	// XH4("Course Ternms and Conditions");
	// XPTXT($GLOBALS{'course_tsandcs'});	
	
	X_DIV($course_id);
	XHR();
	XH1("Booking Details");
	XFORM("bookingcoursein.php","coursein");
	XINMINHID();
	XINHID("course_id",$course_id);
	
	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Date of Birth (dd/mm/yyyy)');
	XINDATEYYYY_MM_DD_AGE("DOB",$dob);
	XBR();XBR();
	XINSUBMIT("Continue to Book Course");
	X_FORM();

}

function Booking_CoursePayPalPayment_Output ($course_id, $courseattendee_id, $this_fullcourseselected, $this_partchargecomments, $coursechargein) {
	// XH4("coursechargein ".$coursechargein);
	$coursecharge = floatval($coursechargein);
	Get_Data("course",$course_id);	
	Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
	Get_Data("courseattendee",$courseattendee_id);
	XH2("Debit/Credit Card Payment via PayPal") ;	
	XBR();
	XTABLE();
	XTR();XTDTXT("Course");XTDTXT($GLOBALS{'course_title'});X_TR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'}));X_TR();
	} else {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'}));X_TR();
	}
	XTR();XTDTXT("Booking");
	if ($this_fullcourseselected == "Yes") { XTDTXT("Full Payment"); }
	if ($this_fullcourseselected == "No") { XTDTXT("Reduced Payment"); }
	X_TR();
	
	if ($this_fullcourseselected == "No") {
		XTR();XTDTXT("Comments");XTDTXT($this_partchargecomments);X_TR();			
	}
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));X_TR();
	X_TABLE();
	
	XH3("Proceed to make payment");
	XUL("","");
	XLI("","");XTXT('Please note that you dont have to have a paypal account... just use the option to pay with debit or credit card.');X_LI();
	XLI("","");XTXT("Check that the Card you are using matches the pre-populated address - or change the address to match the Card.");X_LI();
	XLI("","");XTXT('After payment select the "Return to Club" link on the final paypal screen to finalise your booking.');X_LI();
	X_UL();
	$paypalamount = number_format(($coursecharge*1.00), 2, '.', '');
	// if ($GLOBALS{'courseattendee_id'} == "abow") { $paypalamount = "1.00"; }
	if ($GLOBALS{'site_server'} != "W") {
		print'<form action="https://www.paypal.com/cgi-bin/webscr" method="post">'."\n"; // real
	} else {
		XFORM("paypalsimulation.php","paypalsimulation"); // simulation
		XINSTDHID();
	}
	XINHID('business',$GLOBALS{'coursecategory_paypalemail'});
	XINHID('cmd',"_xclick");
	XINHID('item_name',$GLOBALS{'course_title'}." - ".$GLOBALS{'courseattendee_fname'}." ".$GLOBALS{'courseattendee_sname'});
	// domain_id|purposetype|purposeref|personid|itemparm1|itemparm2|itemparm3
	XINHID('item_number',$GLOBALS{'LOGIN_domain_id'}."|Course|".$course_id."|".$courseattendee_id."|".""."|".""."|"."");
	if ($GLOBALS{'courseattendee_parentfname'} != "") {	XINHID('first_name',$GLOBALS{'courseattendee_parentfname'}); }
	else {XINHID('first_name',$GLOBALS{'courseattendee_fname'}); }
	if ($GLOBALS{'courseattendee_parentsname'} != "") {	XINHID('last_name',$GLOBALS{'courseattendee_parentsname'}); }
	else {XINHID('last_name',$GLOBALS{'courseattendee_sname'}); }
	XINHID('address1',$GLOBALS{'courseattendee_addr1'});
	XINHID('address2',$GLOBALS{'courseattendee_addr2'});
	XINHID('city',$GLOBALS{'courseattendee_addr3'});
	XINHID('state',$GLOBALS{'courseattendee_addr4'});
	XINHID('zip',$GLOBALS{'courseattendee_postcode'});
	XINHID('email',$GLOBALS{'courseattendee_email'});
	if ($GLOBALS{'courseattendee_emergencytel'} != "") {
		if ($GLOBALS{'courseattendee_emergencytel'} == "0") {
			// well formed phone number
			$tbits = explode(" ",$GLOBALS{'courseattendee_emergencytel'});
			XINHID('night_phone_a',"44");
			XINHID('night_phone_b',$tbits[0].$tbits[1]);
		}
	}
	XINHID('amount',$paypalamount);
	XINHID('currency_code',"GBP");
	$paypalsuccesslink = YPGMLINK("bookingcoursepaypalsuccess.php");
	$paypalsuccesslink = $paypalsuccesslink.YPGMSTDPARMS();
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('course_id',$course_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('courseattendee_id',$courseattendee_id);
	$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('course_selectedcharge',$coursecharge);	
	$paypalcancellink = YPGMLINK("bookingcoursepaypalcancel.php");
	$paypalcancellink = $paypalcancellink.YPGMSTDPARMS();	
	$paypalcancellink = $paypalcancellink.YPGMPARM('course_id',$course_id);
	$paypalcancellink = $paypalcancellink.YPGMPARM('courseattendee_id',$courseattendee_id);
	$paypalcancellink = $paypalcancellink.YPGMPARM('course_selectedcharge',$coursecharge);	
	XINHID('return',$paypalsuccesslink);
	XINHID('cancel_return',$paypalcancellink);
	// XINHID('cancel_return',$paypalsuccesslink); // testing
			
	print'<input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" alt="PayPal - The safer, easier way to pay online"> 	<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >';
	X_FORM();

}

function Booking_CourseChequePayment_Output ($course_id, $courseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thiscoursecharge) {
	// XH4("coursechargein ".$coursechargein);
	$coursecharge = floatval($thiscoursecharge);
	Get_Data("course",$course_id);	
	Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
	Get_Data("courseattendee",$courseattendee_id);
	XH2("Payment by Cheque") ;	
	XBR();XBR();
	XTABLE();
	XTR();XTDTXT("Course");XTDTXT($GLOBALS{'course_title'});X_TR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'}));X_TR();
	} else {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'}));X_TR();
	}
	XTR();XTDTXT("Booking");
	if ($this_fullcourseselected == "Yes") { XTDTXT("Full Payment"); }
	if ($this_fullcourseselected == "No") { XTDTXT("Reduced Payment"); }
	X_TR();
	
	if ($this_fullcourseselected == "No") {
		XTR();XTDTXT("Comments");XTDTXT($this_partchargecomments);X_TR();			
	}
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));X_TR();
	X_TABLE();
	
	$chequeamount = number_format(($coursecharge*1.00), 2, '.', '');
	XBR();XBR();
	XPTXT('Please make out a cheque for '.$GLOBALS{'countrycurrencysymbol'}.$chequeamount.' payable to "'.$GLOBALS{'coursecategory_bankaccountname'}.'" and mail it to the following address in order to confirm your place on the course'); 
	Get_Data('person',$GLOBALS{'coursecategory_treasurer'});
	XBR();XTXT($GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'});	
	XBR();XTXT($GLOBALS{'person_addr1'});	
	XBR();XTXT($GLOBALS{'person_addr2'});	
	XBR();XTXT($GLOBALS{'person_addr3'});	
	XBR();XTXT($GLOBALS{'person_addr4'});	
	XBR();XTXT($GLOBALS{'person_postcode'});
	XBR();
	XPTXT("Thank you");
}

function Booking_CourseCashPayment_Output ($course_id, $courseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thiscoursecharge) {
	// XH4("coursechargein ".$coursechargein);
	$coursecharge = floatval($thiscoursecharge);
	Get_Data("course",$course_id);	
	Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
	Get_Data("courseattendee",$courseattendee_id);
	XH2("Payment by Cash") ;	
	XBR();
	XTABLE();
	XTR();XTDTXT("Course");XTDTXT($GLOBALS{'course_title'});X_TR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'}));X_TR();
	} else {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'}));X_TR();
	}
	XTR();XTDTXT("Booking");
	if ($this_fullcourseselected == "Yes") { XTDTXT("Full Payment"); }
	if ($this_fullcourseselected == "No") { XTDTXT("Reduced Payment"); }
	X_TR();
	
	if ($this_fullcourseselected == "No") {
	    XTR();XTDTXT("Comments");XTDTXT($this_partchargecomments);X_TR();
	}
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));X_TR();
	X_TABLE();
	XBR();
	$cashamount = number_format(($coursecharge*1.00), 2, '.', '');
	XPTXT('Please bring '.$GLOBALS{'countrycurrencysymbol'}.$cashamount.' to the first day of the course');
	XBR();
	XPTXT("Thank you");
}

function Booking_CourseBankTransferPayment_Output ($course_id, $courseattendee_id, $this_fullcourseselected, $this_partchargecomments, $thiscoursecharge) {
	// XH4("coursechargein ".$coursechargein);
	$coursecharge = floatval($thiscoursecharge);
	Get_Data("course",$course_id);
	Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
	Get_Data("courseattendee",$courseattendee_id);
	XH2("Payment by Bank Transfer") ;
	XBR();XBR();
	XTABLE();
	XTR();XTDTXT("Course");XTDTXT($GLOBALS{'course_title'});X_TR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'}));X_TR();
	} else {
		XTR();XTDTXT("Date");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'}));X_TR();
	}
	XTR();XTDTXT("Booking");
	if ($this_fullcourseselected == "Yes") { XTDTXT("Full Payment"); }
	if ($this_fullcourseselected == "No") { XTDTXT("Reduced Payment"); }
	X_TR();
	
	if ($this_fullcourseselected == "No") {
	    XTR();XTDTXT("Comments");XTDTXT($this_partchargecomments);X_TR();
	}
	XTR();XTDTXT("Cost");XTDTXT($GLOBALS{'countrycurrencysymbol'}.number_format($coursecharge, 2, '.', ''));X_TR();
	X_TABLE();

	$banktransferamount = number_format(($coursecharge*1.00), 2, '.', '');
	XBR();XBR();
	XPTXT('Please process a bank transfer for '.$GLOBALS{'countrycurrencysymbol'}.$banktransferamount.' to the following account in order to confirm your place on the course');
	XTABLE();
	XTR();XTDTXT("Account Name");XTDTXT($GLOBALS{'coursecategory_bankaccountname'});X_TR();
	XTR();XTDTXT("Sort Code");XTDTXT($GLOBALS{'coursecategory_banksort'});X_TR();	
	XTR();XTDTXT("Account");XTDTXT($GLOBALS{'coursecategory_bankaccount'});X_TR();	
	X_TABLE();	
	XBR();	
	XPTXT('Please also include your name in the payment reference so that we can identify it.');		
	XBR();
	XPTXT("Thank you");
}

function Booking_COURSEADMINLIST_Output () {
	XH1("Courses");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date Start");
	XTDHTXT("Date End");	
	XTDHTXT("Manage Payments");
	XTDHTXT("View/Add/Remove Attendees");	
	XTDHTXT("Report");	
	X_TR();
	$course_ida = Get_Array('course');
	foreach ($course_ida as $course_id) {
		Get_Data("course",$course_id);
		XTR();
		XTDTXT($course_id);
		XTDTXT($GLOBALS{'course_title'});
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));		
		$link = YPGMLINK("bookingcoursepaymentadminout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXT($link,"manage payments");
		$link = YPGMLINK("bookingcourseattendeeadminout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXT($link,"view/add/remove attendees");		
		$link = YPGMLINK("bookingcoursereport.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXTNEWWINDOW($link,"printable report","report");
		X_TR();
	}
	X_TABLE();
}

function Booking_COURSEPAYMENTADMIN_Output ($courseid) {
	Get_Data('course', $courseid);
	XH3('Manage Attendee Payments - '.$GLOBALS{'course_title'});
	
	XFORM("bookingcoursepaymentadminin.php","courseupdatein");
	XINSTDHID();
	XINHID("course_id",$courseid);
	XTABLE();
	XTR();
	XTDHTXT("First Name");
	XTDHTXT("Last Name");
	XTDHTXT("Age");
	XTDHTXT("Emergency Tel");
	XTDHTXT("Email");
	XTDHTXT("Payment<br>Due");
	XTDHTXT("Payment<br>Comments");
	XTDHTXT("Payment<br>Method");
	XTDHTXT("Payment<br>Received");		
	X_TR();
	
	$courseattendeestatusa = AttendeeStatus2Array($GLOBALS{'course_attendeestatuslist'});
	// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	foreach ($courseattendeestatusa as $courseattendeestatuselement) {
		$attbits = explode('~',$courseattendeestatuselement);
		$courseattendeeid = $attbits[0];
		$paymenttype = $attbits[1];
		$paymentdue = $attbits[2];
		$paymentreceived = $attbits[3];
		$paymentcomments = $attbits[4];
		Check_Data("courseattendee",$courseattendeeid);	
		XTR();
		if ($GLOBALS{'IOWARNING'} == "0") {
			XTDTXT($GLOBALS{'courseattendee_fname'});
			XTDTXT($GLOBALS{'courseattendee_sname'});
			$underage = UnderAge(18,$GLOBALS{'courseattendee_dob'});
			if ($underage) { XTDTXT(Age($GLOBALS{'courseattendee_dob'},19)); }
			else { XTDTXT(""); }
			XTDTXT($GLOBALS{'courseattendee_emergencytel'});
			XTDTXT($GLOBALS{'courseattendee_email'});
			XTDINTXT($courseattendeeid."_paymentdue",$paymentdue,"7","7");
			XTDINTXT($courseattendeeid."_paymentcomments",$paymentcomments,"20","80");		
			XTDINSELECTHASH(List2Hash("Card,Cash,Cheque,BankTransfer"),$courseattendeeid."_paymenttype",$paymenttype); 
			XTDINTXT($courseattendeeid."_paymentreceived",$paymentreceived,"7","7");
		} else {
			XTDTXT($courseattendeeid);
			XTDTXT("Not Found");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");	
			XTDTXT("");
		}
		X_TR();
	}
	X_TABLE();
	XBR();XBR();
	XINSUBMIT("Update Payments");
	X_FORM();
}

function Booking_COURSEATTENDEEADMIN_Output ($courseid) {
	Get_Data('course', $courseid);
	XH2('View/Add/Remove Attendees - '.$GLOBALS{'course_title'});
	XBR();
	XFORM("bookingcourseattendeeaddout.php","courseattendeeadd");
	XINSTDHID();
	XINHID("course_id",$courseid);
	XINSUBMIT("Add a New Course Attendee");
	X_FORM();
	XBR();
	XHR();	
	XTABLE();
	XTR();
	XTDHTXT("First Name");
	XTDHTXT("Last Name");
	XTDHTXT("Age");
	XTDHTXT("Emergency Tel");
	XTDHTXT("Email");
	XTDHTXT("Remove from course");
	X_TR();

	$courseattendeestatusa = AttendeeStatus2Array($GLOBALS{'course_attendeestatuslist'});
	// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
	foreach ($courseattendeestatusa as $courseattendeestatuselement) {
		$attbits = explode('~',$courseattendeestatuselement);
		$courseattendeeid = $attbits[0];
		$paymenttype = $attbits[1];
		$paymentdue = $attbits[2];
		$paymentreceived = $attbits[3];
		$paymentcomments = $attbits[4];
		Check_Data("courseattendee",$courseattendeeid);
		XTR();
		if ($GLOBALS{'IOWARNING'} == "0") {
			XTDTXT($GLOBALS{'courseattendee_fname'});
			XTDTXT($GLOBALS{'courseattendee_sname'});
			$underage = UnderAge(18,$GLOBALS{'courseattendee_dob'});
			if ($underage) {
				XTDTXT(Age($GLOBALS{'courseattendee_dob'},19));
			}
			else { XTDTXT("");
			}
			XTDTXT($GLOBALS{'courseattendee_emergencytel'});
			XTDTXT($GLOBALS{'courseattendee_email'});
			$link = YPGMLINK("bookingcourseattendeedeleteconfirm.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$courseid).YPGMPARM("courseattendee_id",$courseattendeeid);
			XTDLINKTXT($link,"remove from course");			
		} else {
			XTDTXT($courseattendeeid);
			XTDTXT("Not Found");
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
			$link = YPGMLINK("bookingcourseattendeedeleteconfirm.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$courseid).YPGMPARM("courseattendee_id",$courseattendeeid);
			XTDLINKTXT($link,"remove from course");	
		}
		X_TR();
	}
	X_TABLE();
}

function Booking_COURSEATTENDEEDELETECONFIRM_Output ($course_id, $courseattendee_id) {
	Get_Data("course",$course_id);
	XH3("Remove Course Attendee - ".$GLOBALS{'course_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	Check_Data('courseattendee',$courseattendee_id);
	if ($GLOBALS{'IOWARNING'} == "0") {
		XPTXT("Are you sure you want to remove ".$GLOBALS{'courseattendee_fname'}." ".$GLOBALS{'courseattendee_sname'}." from this course?");
	} else {
		XPTXT("This person no longer exists on the attendee database. Please remove from course list.");
	}
	XBR();
	XFORM("bookingcourseattendeedeleteaction.php","deleteattendee");
	XINSTDHID();
	XINHID("course_id",$course_id);
	XINHID("courseattendee_id",$courseattendee_id);	
	XINSUBMIT("Confirm Remove");
	X_FORM();
	XBR();XBR();
	XINBUTTONBACK("Cancel");
}


function Booking_COURSEATTENDEEUTILITY_Output() {
	$parm0 = "Course Attendees|courseattendee||courseattendee_id|courseattendee_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."courseattendee_id|Yes|Id|60|Yes|Course Attendee Id|KeyText,6,6^";
	$parm1 = $parm1."courseattendee_fname|Yes|First Name|100|Yes|First name|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_sname|Yes|Surname|100|Yes|Surname|InputText,25,50^";
	$parm1 = $parm1."courseattendee_email|Yes|Email|180|Yes|Email|InputText,25,50^";
	$parm1 = $parm1."courseattendee_emergencytel||||Yes|Emergency Tel|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_dob|Yes|DOB|80|Yes|Date of Birth|InputDate^";	
	// $parm1 = $parm1."courseattendee_personid|Yes|PersonId|60|Yes|Personal Id|InputText,25,50^";
	$parm1 = $parm1."courseattendee_addr1||||Yes|Addr 1|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_addr2||||Yes|Addr 2|InputText,25,50^";
	$parm1 = $parm1."courseattendee_addr3||||Yes|Addr 3|InputText,25,50^";
	$parm1 = $parm1."courseattendee_addr4||||Yes|Addr 4|InputText,25,50^";
	$parm1 = $parm1."courseattendee_postcode||||Yes|Post Code|InputText,25,50^";
	$parm1 = $parm1."courseattendee_school||||Yes|School/College|InputText,25,50^";
	$parm1 = $parm1."courseattendee_parentfname||||Yes|Parent First Name|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_parentsname||||Yes|Parent Surname|InputText,25,50^";	
	$parm1 = $parm1."courseattendee_alttel||||Yes|Alternative Telephone Contact|InputText,12,50^";
	$parm1 = $parm1."courseattendee_medicaldetails||||Yes|Medical Details|InputTextArea,3,50^";	
	$parm1 = $parm1."courseattendee_photographyconsent||||Yes|Photography|InputSelectFromList,Yes+No^";	
	$parm1 = $parm1."courseattendee_experience||||Yes|Any Previous Experience|InputTextArea,3,50^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Booking_SETUPCOURSECATEGORY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_SETUPCOURSECATEGORY_Output() {
	$parm0 = "Course Category|coursecategory|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|coursecategory_id|coursecategory_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."coursecategory_id|Yes|Category|120|Yes|Course Category|KeyText,12,12^";
	$parm1 = $parm1."coursecategory_name|Yes|Title|150|Yes|Title|InputText,50,90^";
	$parm1 = $parm1."coursecategory_treasurer|No|||Yes|Treasurer|InputPerson,10,20,Treasurer,Lookup^";
	$parm1 = $parm1."coursecategory_banksort|No||30|Yes|Bank Sort Code|InputText,8,8^";
	$parm1 = $parm1."coursecategory_bankaccount|No||30|Yes|Bank Account Code|InputText,8,8^";
	$parm1 = $parm1."coursecategory_bankaccountname|No||30|Yes|Bank Account Name|InputText,25,50^";
	$parm1 = $parm1."coursecategory_paypalemail|No||30|Yes|Pay Pal Email|InputText,25,50^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Treasurer,Treasurer..,coursecategory_treasurer_input,coursecategory_treasurer_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "coursecategory,center,center,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);	
}

function Booking_COURSEUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,slimjquerymin,slimimagepopup,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_COURSEUTILITY_Output() {
	$parm0 = "Courses|course|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section],coursecategory,venue|course_id|course_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."course_id|Yes|Course Id|70|Yes|Course Id|KeyGenerated,C[00000]^";
	$parm1 = $parm1."course_coursecategoryid|Yes|Category|80|Yes|Category|InputSelectFromTable,coursecategory,coursecategory_id,coursecategory_name,coursecategory_id^";
	$parm1 = $parm1."course_title|Yes|Title|100|Yes|Course Title|InputText,25,50^";
	$parm1 = $parm1."course_excerpt|No||40|Yes|Course Excerpt|InputTextArea,3,50^";
	$parm1 = $parm1."course_description|No||40|Yes|Course Description|InputTextArea,10,50^";
	$parm1 = $parm1."course_datestart|Yes|Date Start|80|Yes|Course Date Start|InputDate^";
	$parm1 = $parm1."course_dateend|Yes|Date End|80|Yes|Course Date End|InputDate^";
	$parm1 = $parm1."course_weeklyrepeating|Yes|Repeating|100|Yes|Weekly Repeating|InputCheckboxFromList,Yes+No^";	
	$parm1 = $parm1."course_contact|Yes|Contact|60|Yes|Event Contact|InputPerson,10,20,Contact,Lookup^";
	$parm1 = $parm1."course_venue|No||40|Yes|Event Venue|InputText,25,50^";
	$parm1 = $parm1."course_venuecode||||Yes|Booking Venue|InputSelectFromTable,venue,venue_code,venue_name,venue_code^";	
	$parm1 = $parm1."course_googlemapsembed||||Yes|Google Maps Embed|InputTextArea,10,50^";
	$parm1 = $parm1."course_featuredimage|Yes|Photo|60|Yes|Featured Image|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,600,flex,Event,course_id^";
	// $parm1 = $parm1."course_featuredimagecaption|No||40|Yes|Featured Image Caption|InputText,25,50^";
	$parm1 = $parm1."course_charge||||Yes|Charge if not PrePaid|InputText,7,7^";
	$parm1 = $parm1."course_prepaidcharge||||Yes|PrePaid Charge|InputText,7,7^";		
	$parm1 = $parm1."course_earlycharge||||Yes|Early PrePaid Charge|InputText,7,7^";
	// $parm1 = $parm1."course_earlychargedate|Yes|EDATE|60|Yes|Early PrePaid Charge Date|InputDate^";
	$parm1 = $parm1."course_paymentoptionslist||||Yes|Payment Options|InputSelectFromList,Card+Cash+Cheque+BankTransfer+None^";
	$parm1 = $parm1."course_requirements||||Yes|Course Requirements|InputTextArea,5,50^";
	// $parm1 = $parm1."course_tsandcs||||Yes|Terms and Conditions|InputTextArea,5,50^";
	$parm1 = $parm1."course_attendeelist||||Yes|Attendee List|InputTextArea,5,50^";
	$parm1 = $parm1."course_attendeepaidlist||||Yes|Attendee Paid List|InputTextArea,5,50^";
	$parm1 = $parm1."course_attendeestatuslist||||Yes|Attendee Status List|InputTextArea,5,50^";	
	$parm1 = $parm1."course_full||||Yes|Course Full|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."course_createdbypersonid|No||40|Yes|Event Created By|InputPerson,10,20,CreatedBy,Lookup^";
	$parm1 = $parm1."course_publicationstatus|Yes|Status|60|Yes|Publication Status|InputSelectFromList,Draft+Ready+Published^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Contact,Contact..,course_contact_input,course_contact_personlist,50|field,CreatedBy,CreatedBy..,course_createdbypersonid_input,course_createdbypersonid_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "course_utility,50,50,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
	
}

function Booking_SETUPCOURSESCHOOL_Output() {
	$parm0 = "Course School/College|courseschool||courseschool_id|courseschool_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."courseschool_id|Yes|School/College|100|Yes|School/College|KeyText,12,12^";
	$parm1 = $parm1."courseschool_name|Yes|Title|150|Yes|Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_addr1|||150|Yes|Addr1|InputText,50,90^";
	$parm1 = $parm1."courseschool_addr2|||150|Yes|Addr2|InputText,50,90^";
	$parm1 = $parm1."courseschool_addr3|||150|Yes|Addr3|InputText,50,90^";
	$parm1 = $parm1."courseschool_addr4|||150|Yes|Addr4|InputText,50,90^";
	$parm1 = $parm1."courseschool_postcode|||150|Yes|Post Code|InputText,50,90^";	
	$parm1 = $parm1."||||Yes||Divider^";	
	$parm1 = $parm1."courseschool_contact1fname||||Yes|Contact1 First Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact1sname||||Yes|Contact1 Surname|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact1role||||Yes|Contact1 Role|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact1worktel|||150|Yes|Contact1 Telephone|InputText,50,90^";			
	$parm1 = $parm1."courseschool_contact1email||||Yes|Contact1 Email|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact1broadcast|||150|Yes|Contact1 Newsletter etc|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."||||Yes||Divider^";
	$parm1 = $parm1."courseschool_contact2fname||||Yes|Contact2 First Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2sname||||Yes|Contact2 Surname|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2role||||Yes|Contact2 Role|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2worktel|||150|Yes|Contact2 Telephone|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2email||||Yes|Contact2 Email|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact2broadcast|||150|Yes|Contact2 Newsletter etc|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."||||Yes||Divider^";	
	$parm1 = $parm1."courseschool_contact3fname||||Yes|Contact3 First Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3sname||||Yes|Contact3 Surname|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3role||||Yes|Contact3 Role|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3worktel|||150|Yes|Contact3 Telephone|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3email||||Yes|Contact3 Email|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact3broadcast|||150|Yes|Contact3 Newsletter etc|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."||||Yes||Divider^";	
	$parm1 = $parm1."courseschool_contact4fname||||Yes|Contact4 First Name|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4sname||||Yes|Contact4 Surname|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4role||||Yes|Contact4 Role|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4worktel|||150|Yes|Contact4 Telephone|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4email||||Yes|Contact4 Email|InputText,50,90^";
	$parm1 = $parm1."courseschool_contact4broadcast|||150|Yes|Contact4 Newsletter etc|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."||||Yes||Divider^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Booking_COURSEUPDATELIST_Output () {
	Get_Data("commsmasters");
	XH3("Courses");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;

	XFORM("bookingcourseupdateout.php","newcourse");
	XINSTDHID();
	XINHID("course_id","new");
	XINHID("action","new");	
	XINHID("menulist","courseupdatelist");
	XINSUBMIT("Create New Course");
	X_FORM();

	XBR();XBR();XBR();
	XDIV("simpletablediv_Courses","container");
	XTABLEJQDTID("simpletabletable_Courses");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Category");
	XTDHTXT("Date");
	XTDHTXT("Contact");
	XTDHTXT("Venue");
	XTDHTXT("Part<br>Charge");	
	XTDHTXT("Featured<br>Image");
	XTDHTXT("Edit");
	XTDHTXT("Replicate");	
	XTDHTXT("Delete");
	XTDHTXT("WebView");
	XTDHTXT("Facebook");
	X_TR();
	X_THEAD();
	XTBODY();

	$course_ida = Get_Array('course');
	$course_ida = array_reverse($course_ida);
	foreach ($course_ida as $course_id) {
		Get_Data("course",$course_id);
		XTR();
		XTDTXT($course_id);
		XTDTXT($GLOBALS{'course_title'});
		XTDTXT($GLOBALS{'course_coursecategoryid'});
		if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
		} else {
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));
		}
		XTDTXT($GLOBALS{'course_contact'});
		XTDTXT($GLOBALS{'course_venue'});
		XTDTXT($GLOBALS{'course_partchargepermitted'});
		if ($GLOBALS{'course_featuredimage'} == "") {
			XTDTXT("");
		}
		else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"100");
		}
		$canupdate = "0";
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'course_createdbypersonid'}) { $canupdate = "1"; }
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'course_contact'}) { $canupdate = "1"; }
		if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) { $canupdate = "1"; }
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_courseeditorlist'})) { $canupdate = "1"; }	
		if ( $canupdate == "1") {
			$link = YPGMLINK("bookingcourseupdateout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id).YPGMPARM("menulist","courseupdatelist").YPGMPARM("action","update");
			XTDLINKTXT($link,"update");
			$link = YPGMLINK("bookingcourseupdateout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id).YPGMPARM("menulist","courseupdatelist").YPGMPARM("action","replicate");
			XTDLINKTXT($link,"replicate");
			$link = YPGMLINK("bookingcoursedeleteconfirm.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
			XTDLINKTXT($link,"delete");
		} else {
			XTDTXT("");
			XTDTXT("");
			XTDTXT("");
		}
		$link = YPGMLINK("webpagecoursewebview.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
		$link = YPGMLINK("webpagecoursefbview.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
		XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
		X_TR();
	}
	X_TBODY();
	X_TABLE();
	X_DIV("simpletablediv_Courses");
	XCLEARFLOAT();
}

function Booking_COURSEATTENDEEADD1_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_COURSEATTENDEEADD1_Output ($course_id) {
	Get_Data('course',$course_id);
	XH3("Add New Course Attendee - ".$GLOBALS{'course_title'});
	XFORM("bookingcourseattendeeaddin1.php","courseattendeeaddin");
	XINSTDHID();
	XINHID("course_id",$course_id);
	
	XH4('First Name.');
	XINTXT("FirstName",$fname,"50","100");
	XH4('SurName.');
	XINTXT("SurName",$sname,"50","100");
	XH4('Date of Birth');
	XINDATEYYYY_MM_DD_AGE("DOB",$dob);
	XBR();XBR();
	XINSUBMIT("Add Attendee");
	X_FORM();
}


function Booking_COURSEDELETECONFIRM_Output ($course_id) {
	Get_Data('course',$course_id);
	XH3("Delete Course - ".$GLOBALS{'course_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this course");
	XBR();
	XFORM("bookingcoursedeleteaction.php","deletecourse");
	XINSTDHID();
	XINHID("course_id",$course_id);
	XINSUBMIT("Confirm Course Deletion");
	X_FORM();
	XBR();XBR();
	XINBUTTONBACK("Cancel");
}

function Booking_COURSEUPDATE_CSSJS () {
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";	
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,tinymcesliminit,tinymceslimreturnfromupload,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,tinyslimimagepopup,tinyformattedsectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,FormattedSection_Popups";
}

function Booking_COURSEUPDATE_Output ($course_id,$action,$menulist) {	
	if (($action == "new")||($action == "replicate")) {
		$course_ida = Get_Array('course');
		$highestcourse_id = "C00000";
		foreach ($course_ida as $tcourse_id) {
			$highestcourse_id = $tcourse_id;
		}
		$highestcourse_seq = str_replace("C", "", $highestcourse_id);
		$highestcourse_seq++;
		$newcourse_id = "C".substr(("00000".$highestcourse_seq), -5);
		if ($action == "new") {
			Initialise_Data('course');
			$GLOBALS{'course_publicationstatus'} = "Draft";
			XH2("Course Setup - New Course - ".$newcourse_id);
		}
		if ($action == "replicate") {
			Get_Data('course', $course_id);
			$GLOBALS{'course_publicationstatus'} = "Draft";
			$GLOBALS{'course_attendeelist'} = "";
			$GLOBALS{'course_attendeepaidlist'} = "";
			$GLOBALS{'course_attendeestatuslist'} = "";
			Write_Data('course', $newcourse_id);
			XH2("Course Setup - Replicated Course - ".$newcourse_id);
		}
		$course_id = $newcourse_id;
	}
	if ($action == "update") {
		Get_Data('course', $course_id);
		XH2("Course Setup - ".$course_id." - ".$GLOBALS{'course_title'});
	}	
	// $helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;
	XFORMUPLOAD("bookingcourseupdatein.php","courseupdatein");
	XINSTDHID();
	XINHID("course_id",$course_id);
	XINHID("menulist",$menulist);
	XINHID("TinyMCEUploadTo","Course");
	XINHID("TinyMCEUploadId",$course_id);
	XHR();
	XH4('Title.');
	XINTXT("course_title",$GLOBALS{'course_title'},"50","100");
	XH4('Short excerpt.');
	XINTEXTAREA("course_excerpt",$GLOBALS{'course_excerpt'},"3","100");
	XH4('Full description of course.');
	XINTEXTAREAMCE("course_description",$GLOBALS{'course_description'},"20","100");
	XHR();
	XH4('Featured Image.');
	XINHID("course_featuredimage",$GLOBALS{'course_featuredimage'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "course_featuredimage";
	$imageviewwidth = "300";
	$imagename = $GLOBALS{'course_featuredimage'};
	$imageuploadto = "Course";
	$imageuploadid = $course_id;
	$imageuploadwidth = "800";
	$imageuploadheight = "flex";
	$imageuploadfixedsize = "";
	$imagethumbwidth = "200";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);	
	XH2('Featured Image.');
	XINHID("event_featuredimage",$GLOBALS{'event_featuredimage'});
	XHR();
	XH4('Course Venue and Schedule.');
	XTABLE();
	$xhash = Get_SelectArrays_Hash ("coursecategory","coursecategory_id","coursecategory_name","coursecategory_name","","" );
	XTR();XTDTXT('Course Category');XTD();XINSELECTHASH($xhash,"course_coursecategoryid",$GLOBALS{'course_coursecategoryid'});X_TD();X_TR();
	XTR();XTDTXT('Date of Course Start');XTD();XINDATEYYYY_MM_DD("course_datestart",$GLOBALS{'course_datestart'});X_TD();X_TR();
	XTR();XTDTXT('Date of Course End');XTD();XINDATEYYYY_MM_DD("course_dateend",$GLOBALS{'course_dateend'});X_TD();X_TR();
	XTR();XTDTXT('Weekly Repeating');XTD();XINCHECKBOXYESNO ("course_weeklyrepeating",$GLOBALS{'course_weeklyrepeating'},"");X_TD();X_TR();	
	XTR();XTDTXT('Start Time of Course');XTD();XINTXT("course_timestart",$GLOBALS{'course_timestart'},"10","50");X_TD();X_TR();
	XTR();XTDTXT('End Time of Course');XTD();XINTXT("course_timeend",$GLOBALS{'course_timeend'},"10","50");X_TD();X_TR();
	XTR();XTDTXT('Venue');XTD();XINTXTID("course_venue","course_venue",$GLOBALS{'course_venue'},"50","100");X_TD();X_TR();
	$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
	XTR();XTDTXT('Booking Venue');XTD();XINSELECTHASH($xhash,"course_venuecode",$GLOBALS{'course_venuecode'});X_TD();X_TR();
	XTR();XTDTXT('Contact for Course');
	XTD();XINTXTID("course_contact","course_contact",$GLOBALS{'course_contact'},"50","100");
	XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
	XTXTID("course_contactname",View_Person_List($GLOBALS{'course_contact'}));
	XBR();X_TD();X_TR();	
	X_TABLE();
	XHR();
	XH4('Course Capacity and Booking Status.');
	XTABLE();	
	XTR();XTDTXT('Maximum Attendees');XTD();XINTXT("course_maximumattendees",$GLOBALS{'course_maximumattendees'},"7","7");X_TD();X_TR();
	XTR();XTDTXT('Course Full');XTDINCHECKBOXYESNO("course_full",$GLOBALS{'course_full'},"");X_TR();
	X_TABLE();
	XHR();	
	XH4('Course Payments');
	XH5('Full Course Charges');	
	XTABLE();
	XTR();XTDTXT('Charge');XTD();XINTXTID("course_charge","course_charge",$GLOBALS{'course_charge'},"7","7");X_TD();X_TR();	
	XTR();XTDHTXT('');XTDHTXT('');X_TR();	
	XTR();XTDTXT('PrePaid Discounted Charge');XTD();XINTXTID("course_prepaidcharge","course_prepaidcharge",$GLOBALS{'course_prepaidcharge'},"7","7");X_TD();X_TR();	
	XTR();XTDHTXT('');XTDHTXT('');X_TR();
	XTR();XTDTXT('Early PrePaid Discounted Charge');XTD();XINTXTID("course_earlycharge","course_earlycharge",$GLOBALS{'course_earlycharge'},"7","7");X_TD();X_TR();
	XTR();XTDTXT('Early PrePaid Discounted Charge Date');XTD();XINDATEYYYY_MM_DD("course_earlychargedate",$GLOBALS{'course_earlychargedate'});X_TD();X_TR();
	X_TABLE();
	XH5('Reduced Payment Instructions');
	XTABLE();
	XTR();XTDTXT('Reduced Payment Enabled');XTDINCHECKBOXYESNO("course_partchargepermitted",$GLOBALS{'course_partchargepermitted'},"");X_TR();
	XTR();XTDTXT('Reduced Payment Instructions');XTDINTEXTAREA("course_partchargeinstructions",$GLOBALS{'course_partchargeinstructions'},"3","100");X_TR();
	X_TABLE();
	XH5('Payment Method Options');
	$xhash = List2Hash("Card,Cheque,Cash,BankTransfer");
	XINCHECKBOXHASH ($xhash,"course_paymentoptionslist",$GLOBALS{'course_paymentoptionslist'});
	XHR();	
	XH4('Course Requirements');
	XINTEXTAREA("course_requirements",$GLOBALS{'course_requirements'},"5","100"); // CHECK Multiple TinyMCE textareas not allowed
	XH4('Terms and Conditions.');
	XINTEXTAREA("course_tsandcs",$GLOBALS{'course_tsandcs'},"5","100"); // CHECK Multiple TinyMCE textareas not allowed
	XHR();	
	XH4('Publication Status');
	Get_Data("commsmasters");
	$canpublish = "0";
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'course_createdbypersonid'}) { $canpublish = "1"; }
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'course_contact'}) { $canpublish = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) { $canpublish = "1"; }
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_courseeditorlist'})) { $canpublish = "1"; }	
	if ( $GLOBALS{'course_publicationstatus'} == "Published" ) { $canpublish = "1"; }
	if ( $canpublish == "1" ) { $xhash = Lists2Hash("Draft,Ready,Published","Draft,Ready to Publish,Published"); }
	else { $xhash = Lists2Hash("Draft,Ready","Draft,Ready to Publish"); }
	XINRADIOHASH ($xhash,"course_publicationstatus",$GLOBALS{'course_publicationstatus'});XBR();
	XH4('Publication Channels Requested');
	XINCHECKBOXYESNO("course_websiterequested",$GLOBALS{'course_websiterequested'},"Website");	
	XINCHECKBOXYESNO("course_bulletinrequested",$GLOBALS{'course_bulletinrequested'},"Bulletin Board");
	XINCHECKBOXYESNO("course_newsletterrequested",$GLOBALS{'course_newsletterrequested'},"Newsletter");	
	XINCHECKBOXYESNO("course_facebookrequested",$GLOBALS{'course_facebookrequested'},"Facebook");	
	XINCHECKBOXYESNO("course_twitterrequested",$GLOBALS{'course_twitterrequested'},"Twitter");	
	XBR();XBR();
	XINSUBMIT("Update Course");
	X_FORM();
	
	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
	// Go_Back_To_CourseList;XBR();

	$GLOBALS{'PersonSelectPopupParameters'} = array(
		"this,person_id|person_sname|person_fname|person_section",
		"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
		"field,Lookup,Select,course_contact,course_contactname,100",
		"person_id",
		"all",
		"Stats Select,center,center,800,600",
	  	"view",
		"buildfulllist"
	);
	// $parm2 = Buttons Id – field,To,To..,ToPersonIdList,ToPersonNameList,70|field,Cc,CC..,CcDistList,CcPersonList,70
}

function UpdateCourseAttendeeStatus ($courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments) {
	// XPTXT('UpdateCourseAttendeeStatus "'.$courseattendeeid.'"');
	$attendeestatuslist = $GLOBALS{'course_attendeestatuslist'};
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	// XPTXT('BEFOREADD "'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$updatedattendeestatuslist = "";
	$found = "0";
	$sep = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			$attbits = explode('~',$attendeestatuslistelement);
			if ($courseattendeeid == $attbits[0]) { 
				if ($paymenttype != "") {$attbits[1] = $paymenttype;}
				if ($paymenttype == "null") {$attbits[1] = "";}					
				if ($paymentdue != "") {$attbits[2] = $paymentdue;}
				if ($paymentdue == "null") {$attbits[2] = "";}				
				if ($paymentreceived != "") {$attbits[3] = $paymentreceived;}
				if ($paymentreceived == "null") {$attbits[3] = "";}	
				if ($paymentcomments != "") {$attbits[4] = $paymentcomments;}
				if ($paymentcomments == "null") {$attbits[4] = "";}	
				$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $attbits[0] .'~'. $attbits[1] .'~'. $attbits[2] .'~'. $attbits[3] .'~'. $attbits[4]; 
				$sep = "*";
				$found = "1";
			}
			else {
				$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $attbits[0] .'~'. $attbits[1] .'~'. $attbits[2] .'~'. $attbits[3] .'~'. $attbits[4];
				$sep = "*";
			}
		}
	}
	if ($found == "0") {
		$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $courseattendeeid .'~'. $paymenttype .'~'. $paymentdue .'~'. $paymentreceived .'~'. $paymentcomments;
	}	
	// XPTXT('MIDDLE "'.$updatedattendeestatuslist.'"');

	if ($updatedattendeestatuslist == "*") { $updatedattendeestatuslist = ""; } // just to be sure
	// XPTXT('AFTERADD "'.$updatedattendeestatuslist . '"');
	$GLOBALS{'course_attendeestatuslist'} = $updatedattendeestatuslist;
}


function DeleteCourseAttendeeStatus ($courseattendeeid) {
	$attendeestatuslist = $GLOBALS{'course_attendeestatuslist'};
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	// XPTXT('BEFOREDELETE <br>"'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$updatedattendeestatuslist = "";
	$sep = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			// XPTXT('"'.$attendeestatuslistelement.'"');
			$attbits = explode('~',$attendeestatuslistelement);
			if ($courseattendeeid == $attbits[0]) { } // drop this person
			else {
				$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $attbits[0] .'~'. $attbits[1] .'~'. $attbits[2] .'~'. $attbits[3] .'~'. $attbits[4]; 
				$sep = "*";
			}			
		}
		
	}

	if ($updatedattendeestatuslist == "*") { $updatedattendeestatuslist = ""; } // just to be sure
	// XPTXT('AFTERDELETE <br>"'.$updatedattendeestatuslist . '"');
	$GLOBALS{'course_attendeestatuslist'} = $updatedattendeestatuslist;
}

function GetCourseAttendeeStatus ($courseattendeeid) {
	$attendeestatuslist = $GLOBALS{'course_attendeestatuslist'};
	if ($attendeestatuslist == "*") {
		$attendeestatuslist = "";
	} // just to be sure
	// XPTXT('BEFOREDELETE "'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$foundstring = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			// XPTXT('"'+$attendeestatuslistelement+'"');
			$attbits = explode('~',$attendeestatuslistelement);
			if ($courseattendeeid == $attbits[0]) {
				$foundstring = $attendeestatuslistelement;
			}
		}
	}
	return $foundstring;
}


function AttendeeStatus2Array ($attendeestatuslist) {
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	$attendeestatuslista = Array();
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
	}
	return $attendeestatuslista;
}

function Booking_COURSEDOWNLOADLIST_Output () {
	XH3("Download List of Attendees");
	XFORM("bookingcoursedownloadlistin.php","coursedownload");
	XINSTDHID();	
	XH3("Step 1: Select List Type");
	$xhash = Lists2Hash("MailChimp,EmailList","MailChimp List (generates csv file to upload to Mailchimp),Email List (generates list to copy/paste in email)");
	XINRADIOHASH ($xhash,"ListType","");XBR();
	XH3("Step 1: Build List");	
	# datatype/rootkey sortfieldname selectfieldname selectfieldvalue
	$coursecategorya = Get_Array('coursecategory');
	$keyarray = Array(); $valuearray = Array();
	foreach( $coursecategorya as $coursecategory_id ) {
		Get_Data('coursecategory',$coursecategory_id);
		array_push($keyarray,$coursecategory_id);
		array_push($valuearray,'All previous attendees of "'.$GLOBALS{'coursecategory_name'}.'" courses');
	}
	$xhash = Arrays2Hash ($keyarray, $valuearray);
	XINCHECKBOXHASH($xhash,"CourseCategoryList","");
	XBR();
	XINCHECKBOXYESNO("Schools","","Include contacts for Schools/Colleges");	
	XBR();XBR();
	XINSUBMIT("Download List");
	X_FORM();

}

function Booking_BOOKINGVENUE_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";		
}

function Booking_BOOKINGVENUE_Output() {
	$parm0 = "Booking Venues|bookingvenue|venue,person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|bookingvenue_id|bookingvenue_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."bookingvenue_id|Yes|Booking Venue Id|90|Yes|Booking Venue Id|KeyText,12,12^";
	$parm1 = $parm1."bookingvenue_name|Yes|Venue Name|120|Yes|Venue Name|InputText,25,50^";	
	$parm1 = $parm1."bookingvenue_facility|Yes|Facility|120|Yes|Facility|InputText,25,50^";	
	$parm1 = $parm1."bookingvenue_venuecode|Yes|Venue|100|Yes|Venue Code|InputSelectFromTable,venue,venue_code,venue_name,venue_code^";		
	$parm1 = $parm1."bookingvenue_owner|Yes|Contact|80|Yes|Contact|InputPerson,10,20,Contact,Lookup^";
	$parm1 = $parm1."bookingvenue_daytimestart|No||40|Yes|Time Start|InputText,5,5^";	
	$parm1 = $parm1."bookingvenue_daytimeend|No||40|Yes|Time End|InputText,5,5^";	
	$parm1 = $parm1."bookingvenue_timeslice|No||40|Yes|Time Slice|InputText,5,5^";	
	$parm1 = $parm1."bookingvenue_leadtimedays|No||40|Yes|Leadtime Days|InputText,2,2^";	
	$parm1 = $parm1."bookingvenue_authorisation|No||40|Yes|Authorised Administrators|InputPerson,10,20,Administrator,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Contact,Contact..,bookingvenue_owner_input,bookingvenue_owner_personlist,50|field,Administrator,Administrator..,bookingvenue_authorisation_input,bookingvenue_authorisation_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "bookingvenue,50,50,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Booking_BOOKINGADMINLIST_Output () {
	XH1("Booking Administration");
	XPTXT("Please select the venue at which you would like to make the booking.");
	XHR();
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Venue");
	XTDHTXT("Manage Bookings at this Venue");
	X_TR();
	$venue_ida = Get_Array('venue');
	foreach ($venue_ida as $venue_code) {
		Get_Data("venue",$venue_code);
		if ($GLOBALS{'venue_bookable'} == "Yes") {
			XTR();
			XTDTXT($venue_code);
			XTDTXT($GLOBALS{'venue_name'});
			$link = YPGMLINK("bookingupdatelistout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("venue_code",$venue_code);
			XTDLINKTXT($link,"manage bookings");
			X_TR();
		}
	}
	X_TABLE();
}



function Booking_BOOKINGUTILITYLIST_Output () {
	XH1("Bookings Utility");
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Venue");
	XTDHTXT("Booking Utility");
	X_TR();
	$venue_ida = Get_Array('venue');
	foreach ($venue_ida as $venue_code) {
		Get_Data("venue",$venue_code);
		if ($GLOBALS{'venue_bookable'} == "Yes") {
			XTR();
			XTDTXT($venue_code);
			XTDTXT($GLOBALS{'venue_name'});
			$link = YPGMLINK("bookingutilityout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("venue_code",$venue_code);
			XTDLINKTXT($link,"booking utility");
			X_TR();
		}
	}
	X_TABLE();
}

function Booking_BOOKINGUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_BOOKINGUTILITY_Output($venue_code) {
	Get_Data("venue",$venue_code);
	$parm0 = "Booking Utility - ".$GLOBALS{'venue_name'}."|booking[rootkey=".$venue_code."]|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|booking_id|booking_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."booking_id|Yes|Booking Id|90|Yes|Booking Id|KeyGenerated,BK[00000]^";
	$parm1 = $parm1."booking_title|Yes|Title|100|Yes|Title|InputText,25,50^";	
	$parm1 = $parm1."booking_description||||Yes|Description|InputTextArea,3,50^";	
	$parm1 = $parm1."booking_contact|Yes|Booker|60|Yes|Booker|InputPerson,10,20,Booker,Lookup^";	
	$parm1 = $parm1."booking_timestamp||||Yes|Timestamp|InputText,25,50^";	
	$parm1 = $parm1."booking_timestart|Yes|Time Start|100|Yes|Time Start|InputText,5,5^";	
	$parm1 = $parm1."booking_timeend|Yes|Time End|100|Yes|Time End|InputText,5,5^";		
	$parm1 = $parm1."booking_status||||Yes|Status|InputText,25,50^";
	$parm1 = $parm1."booking_datestart|Yes|Date Start|80|Yes|Date Start|InputDate^";
	$parm1 = $parm1."booking_dateend|Yes|Date End|80|Yes|Date End|InputDate^";	
	$parm1 = $parm1."booking_weeklyrepeating|Yes|Repeating|100|Yes|Weekly Repeating|InputCheckboxFromList,Yes+No^";	
	// $parm1 = $parm1."booking_dayofweek|Yes|Day|80|Yes|Day of Week|InputSelectFromList,Mon+Tue+Wed+Thu+Fri+Sat+Sun^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 = "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 = "field,Booker,Booker..,booking_contact_input,booking_contact_personlist,50";
	$p3 = "person_id";
	$p4 = "all";
	$p5 = "booking_utility,50,50,900,900";
	$p6 = "view";
	$p7 = "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Booking_VENUESCHEDULELIST_Output () {
	XH1("Venue Schedules");
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Venue");
	XTDHTXT("Venue Schedules");
	X_TR();
	$venue_ida = Get_Array('venue');
	foreach ($venue_ida as $venue_code) {
		Get_Data("venue",$venue_code);
		if ($GLOBALS{'venue_bookable'} == "Yes") {
			XTR();
			XTDTXT($venue_code);
			XTDTXT($GLOBALS{'venue_name'});
			$link = YPGMLINK("bookingvenuescheduleout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("venue_code",$venue_code);
			XTDLINKTXT($link,"venue schedule");
			X_TR();
		}
	}
	X_TABLE();
}

function Booking_VENUESCHEDULE_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
}

function Booking_VENUESCHEDULE_Output($venue_code, $season) {

	Get_Data('venue',$venue_code);
	XH2("Venue Schedule for ".$GLOBALS{'venue_name'});	
	
	XFORM("bookingvenueschedulein.php","venueschedule");
	XINSTDHID();
	XINHID("venue_code",$venue_code);
	XINHID("season",$season);	
	XTABLE();
	XTR();XTDHTXT("Venue Schedule for a specific date");XTDHTXT("");X_TR();
	XTR();XTDTXT("date - dd/mm/yyyy");XTDINDATEYYYY_MM_DD("requesteddate","");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("View");X_TR();
	X_TABLE();
	X_FORM();

}

function Booking_VENUEWEEKSCHEDULEDISPLAY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_VENUEWEEKSCHEDULEDISPLAY_Output($venue_code, $season, $date) {
	XHR();
	$dayofweek = date("w", strtotime($date));
	if ($dayofweek == 0) { // sunday
		$weekdatestart = OffsetDays ($date,-6);
		$weekdateend = $date;
	} else { // otherdays
		// XPTXT("weekdatestart");
		$weekdatestart = OffsetDays ($date,(1-$dayofweek));
		// XPTXT("weekdateend");
		$weekdateend = OffsetDays ($date,(7-$dayofweek));
	}
	Get_Data('venue',$venue_code);
	XH2($GLOBALS{'venue_name'});
	XH3("Venue Weekly Schedule for ".YYYY_MM_DDtoDDsMMsYY($weekdatestart)." to ".YYYY_MM_DDtoDDsMMsYY($weekdateend));
	XFORM("bookingvenueschedulein.php","venueschedule");
	XINSTDHID();
	XINHID("venue_code",$venue_code);
	XINHID("season",$season);
	XTABLE();
	XTR();XTDINDATEYYYY_MM_DD("requesteddate",$date);X_TR();
	XTR();XTDINSUBMIT("Change Date");X_TR();
	X_TABLE();
	X_FORM();
	
	$hfa = Array();
	$uhfa = Array();	
	$earliesthomeslot = $GLOBALS{'venue_daytimestart'}; $latesthomeslot = $GLOBALS{'venue_daytimeend'};
	
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {
		Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
		$teamsarray = explode(',',$GLOBALS{'section_teams'});
		foreach ($teamsarray as $team_code)  {
			$frsa = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
			foreach ($frsa as $frs_id)  {
				Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
				$fixturesfound = "1";
				$bits = str_split($frs_id);
				$frsYYYYhMMhDD = "20".$bits[2].$bits[3].'-'.$bits[4].$bits[5].'-'.$bits[6].$bits[7];
				if (($frsYYYYhMMhDD >= $weekdatestart)&&($frsYYYYhMMhDD <= $weekdateend)) {
					$ttime1 = $GLOBALS{'frs_time'};
					if ($ttime1 == "") { $ttime1 = "?";	}
					$ttime2 = $GLOBALS{'frs_timeend'};
					if ($ttime2 == "") {
						if ($ttime1 == "?") { $ttime2 = "?"; } 
						else { $ttime2 = OffsetMinutes ($ttime1,75); }	
					}
					if ($GLOBALS{'frs_ha'} == "H") {
						if (($ttime1 != "?")&&($GLOBALS{'frs_venue'} == $venue_code)) {
							array_push($hfa, $ttime1."#".$frsYYYYhMMhDD."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
						} else {
							array_push($uhfa, $ttime1."#".$frsYYYYhMMhDD."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
						}
					}
				}
			}
		}
	}

	$bookinga = Get_Array("booking", $venue_code);
	foreach ($bookinga as $booking_id)  {
		Get_Data("booking", $venue_code, $booking_id);			
		$booking_datestart = $GLOBALS{'booking_datestart'};
		$booking_dateend = $GLOBALS{'booking_dateend'};
		if (($booking_dateend == "")||($booking_dateend == "0000-00-00")) {
			$booking_dateend = $booking_datestart;
		}
		// --- Cycle through the week ----------------
		for ($offset = 0; $offset <= 6; $offset++) {
			$date = OffsetDays ($weekdatestart,$offset);
			$bookingthisday = "0";
			// XPTXT("DDD  ".$date."|".$booking_datestart."|".$booking_dateend);
			if (($booking_datestart == $booking_dateend)&&($date == $booking_datestart)) {
				// single booking
				$bookingthisday = "1";
			} else {
				if (($date >= $booking_datestart)&&($date <= $booking_dateend)) {
					if ($GLOBALS{'booking_weeklyrepeating'} == "Yes") {
						$bookingday = date("l", strtotime($booking_datestart));
						$thisday = date("l", strtotime($date));;
						if ($thisday == $bookingday) {
							$bookingthisday = "1";
						} // valid day match within period
					} else {
						$bookingthisday = "1"; // valid day in contiguous period
					}
				}
			}
			if ( $bookingthisday == "1" ) {
				array_push($hfa, $GLOBALS{'booking_timestart'}."#".$date."#B#".$venue_code."|".$booking_id."#".$GLOBALS{'booking_venuecode'}."#".$GLOBALS{'booking_timeend'});
			}
		}				
	}

	$coursea = Get_Array("course");
	foreach ($coursea as $course_id)  {
		Get_Data("course", $course_id);
		$course_datestart = $GLOBALS{'course_datestart'};
		$course_dateend = $GLOBALS{'course_dateend'};
		if (($course_dateend == "")||($course_dateend == "0000-00-00")) {
			$course_dateend = $course_datestart;
		}
		// --- Cycle through the week ----------------
		for ($offset = 0; $offset <= 6; $offset++) {
			$date = OffsetDays ($weekdatestart,$offset);
			$bookingthisday = "0";
			// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend);
			if (($course_datestart == $course_dateend)&&($date == $course_datestart)) {
				// single booking
				$bookingthisday = "1";
			} else {
				if (($date >= $course_datestart)&&($date <= $course_dateend)) {
					// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend."|".$GLOBALS{'course_weeklyrepeating'});
					if ($GLOBALS{'course_weeklyrepeating'} == "Yes") {
						$bookingday = date("l", strtotime($course_datestart));
						$thisday = date("l", strtotime($date));;
						if ($thisday == $bookingday) {
							$bookingthisday = "1";
						} // valid day match within period
					} else {
						$bookingthisday = "1"; // valid day in contiguous period
					}
				}
			}
			if ( $bookingthisday == "1" ) {
				array_push($hfa, $GLOBALS{'course_timestart'}."#".$date."#C#".$course_id."#".$GLOBALS{'course_venuecode'}."#".$GLOBALS{'course_timeend'});
			}
		}
	}

	if(empty($uhfa)){
	} else {
		XHR();
		XH3("Home fixtures not yet scheduled");
		XTABLE();
		XTR();XTDHTXT("Date");XTDHTXT("H/A");XTDHTXT("Time");XTDHTXT("Team");XTDHTXT("Opposition");XTDHTXT("Venue");XTDHTXT("Schedule this event");X_TR();
		sort($uhfa);
		foreach ($uhfa as $uhf)  {
			$bits = explode('#',$uhf);
			$ttime = $bits[0];
			$tdate = $bits[1];
			$type = $bits[2];
			$frs_id = $bits[3];
			$tvenue = $bits[4];
			$ttimeend = $bits[5];
			if ($type == "F") {
				$bits = str_split($frs_id);
				$tteam_code = $bits[0].$bits[1];
				Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
				Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
				$tteam_name = $GLOBALS{'team_name'};
				$section = GetSectionFromTeamCode ($tteam_code);
				XTR();
				XTDTXT(YYYY_MM_DDtoDDsMMsYY($tdate));XTDTXT($GLOBALS{'ha'});
				XTDTXT($ttime);XTDTXT($GLOBALS{'team_name'});XTDTXT($GLOBALS{'frs_oppo'});XTDTXT($GLOBALS{'frs_venue'});
				$link = YPGMLINK("frsteamselectionout.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("section_name",$section).YPGMPARM("team_code",$tteam_code).YPGMPARM("frs_id",$frs_id);
				# url,text,wintitle,top,left,height,width
				XTDLINKTXTNEWPOPUP($link,"schedule fixture","Schedule Fixture","100","100","800","800");
				X_TR();
			}
		}
		X_TABLE();
		XHR();
	}
	
	

	sort($hfa);
	XHR();	
	/*
	XPTXT($earliesthomeslot." - ".$latesthomeslot);
	foreach ($hfa as $hf)  { XPTXT($hf); }
	*/
	
	$schedule = Array();
	$highlightuptoa = Array();
	for ($offset = 0; $offset <= 6; $offset++) { $highlightuptoa[$offset] = ""; }
	
	for ($hh = 0; $hh < 24; $hh++) {
		for ($mm = 0; $mm < 4; $mm++) {
			$stime = substr("0".$hh,-2).":".substr("0".($mm*15),-2);
			array_push($schedule, $stime);
		}
	}

	$slotindex = 0;
	foreach ($schedule as $slot)  {
		if ($slot == $latesthomeslot) {
			$latestslotindex = $slotindex + 5;
		}
		$slotindex++;
	}
	if ($latestslotindex > count($schedule)-1) {
		$latestslotindex = $schedule[end($schedule)];
	}
	$latesthomeslot = $schedule[$latestslotindex];

	XTABLE(); 
	XTR();XTDHTXT("Time");
	for ($offset = 0; $offset <= 6; $offset++) {
		$date = OffsetDays ($weekdatestart,$offset);	
		XTDHTXT(date("D", strtotime($date))." ".YYYY_MM_DDtoDDsMMsYY($date));
	}
	X_TR();
	XTR();XTDTXT("");
	for ($offset = 0; $offset <= 6; $offset++) {
		$date = OffsetDays ($weekdatestart,$offset);
		$link = YPGMLINK("frsdatescheduleout.php");
		$yyyypart = substr($date,0,4);
		$mmpart = substr($date,5,2);
		$ddpart = substr($date,8,2);
		$link = $link.YPGMSTDPARMS().YPGMPARM("Season",$season).YPGMPARM("FixResSelDate_YYYYpart",$yyyypart).YPGMPARM("FixResSelDate_MMpart",$mmpart).YPGMPARM("FixResSelDate_DDpart",$ddpart);
		XTDLINKTXT($link, "All Venues");
	}
	X_TR();
	$slotindex = 0;
	foreach ($schedule as $slot)  {
		if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
			if (substr($slot,3,2) == "00") {
				XTR(); XTDHTXT("");
				for ($offset = 0; $offset <= 6; $offset++) {
					XTDHTXT("");
				}
				X_TR();
			}
		}
		if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
			XTR();
			for ($offset = 0; $offset <= 6; $offset++) {
				$date = OffsetDays ($weekdatestart,$offset);		
				
				$ftext = ""; $sep = "";
				foreach ($hfa as $hf)  {
					$bits = explode('#',$hf);
					$ttime = $bits[0];
					$tdate = $bits[1];				
					$type = $bits[2];
					$id = $bits[3];
					$tvenue = $bits[4];
					$ttimeend = $bits[5];
					if ($slotindex == count($schedule)-1) {
						$nextslot = "99.99";
					}  else {$nextslot = $schedule[$slotindex+1];
					}
					if (($ttime >= $slot)&&($ttime < $nextslot)&&($date == $tdate)) {
						if ($type == "F") {
							$bits = str_split($id);
							$tteam_code = $bits[0].$bits[1];
							Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$id);
							Check_Data("team",$GLOBALS{'currperiodid'}, $tteam_code);
							if ($GLOBALS{'IOWARNING'} == "0") {
								$tteam_name = $GLOBALS{'team_name'};
								if ($ttimeend == "?") {	$ttimeendtxt = ""; }
								else { $ttimeendtxt = " (until ".$ttimeend.")"; }
								$ttimeendtxt = "";
								$ftext = $ftext.$sep.$tteam_name." v ".$GLOBALS{'frs_oppo'}.$ttimeendtxt;
								if ($ttimeend > $highlightuptoa[$offset]) { $highlightuptoa[$offset] = $ttimeend; }
								$sep = "<br>";
							}	
						}
						if ($type == "B") {
							$bits = explode('|',$id);
							Get_Data("booking",$bits[0],$bits[1]);
							if ($ttimeend == "?") {	$ttimeendtxt = ""; }
							else { $ttimeendtxt = " (until ".$ttimeend.")"; }
							$ftext = $ftext.$sep.$GLOBALS{'booking_title'}.$ttimeendtxt;
							if ($ttimeend > $highlightuptoa[$offset]) { $highlightuptoa[$offset] = $ttimeend; }
							$sep = "<br>";
						}
						if ($type == "C") {
							Get_Data("course",$id);
							Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
							if ($ttimeend == "?") {	$ttimeendtxt = ""; }
							else { $ttimeendtxt = " (until ".$ttimeend.")"; }
							$ftext = $ftext.$sep.$GLOBALS{'coursecategory_name'}." - ".$GLOBALS{'course_title'}.$ttimeendtxt;
							if ($ttimeend > $highlightuptoa[$offset]) { $highlightuptoa[$offset] = $ttimeend; }
							$sep = "<br>";
						}
					}
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					if ($offset == 0) {
						XTDTXT($slot);
					}
					if ($ftext != "") {
						XTDTXTHIGHLIGHT($ftext);
					} else {
						if ($slot > $highlightuptoa[$offset] ) { $highlightuptoa[$offset] = ""; }
						if (($highlightuptoa[$offset] != "")&&($slot < $highlightuptoa[$offset])) { XTDTXTHIGHLIGHT($ftext);  }
						else { XTDTXT($ftext); }
					}
				}
			}
		
			X_TR();
		}
		$slotindex++;
	}
	X_TABLE();

}

function Booking_MASTERSCHEDULER_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_MASTERSCHEDULER_Output() {
	XH2("Master Scheduler");
	XFORM("bookingmasterschedulerin.php","masterschedule");
	XINSTDHID();
	XTABLE();
	XTR();XTDHTXT("Schedule all items for a specific date");XTDHTXT("");X_TR();
	XTR();XTDTXT("date - dd/mm/yyyy");XTDINDATEYYYY_MM_DD("requesteddate","");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Schedule");X_TR();
	X_TABLE();
	X_FORM();

}

function Booking_MASTERSCHEDULERDISPLAY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Booking_MASTERSCHEDULERDISPLAY_Output($season, $date) {
	$dayofweek = date("l", strtotime($date));
	XH2("Master Scheduler - ".$dayofweek." ".YYYY_MM_DDtoDDsMMsYY($date));
	XFORM("bookingmasterschedulerin.php","masterschedule");
	XINSTDHID();
	XTABLE();
	XTR();XTDINDATEYYYY_MM_DD("requesteddate",$date);X_TR();
	XTR();XTDINSUBMIT("Change Date");X_TR();
	X_TABLE();
	X_FORM();
	XHR();
	$hfa = Array();
	$uhfa = Array();
	$hva = Array();
	$fixturesfound = "0";
	$earliesthomeslot = "99:99"; $latesthomeslot = "00:00";
	foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","section_frs","Yes") as $section_name)  {
		Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
		$teamsarray = explode(',',$GLOBALS{'section_teams'});
		foreach ($teamsarray as $team_code)  {
			$frsa = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
			foreach ($frsa as $frs_id)  {
				$fixturesfound = "1";
				$bits = str_split($frs_id);
				$fileyymmdd = $bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
				$bits = str_split($date);
				$checkyymmdd = $bits[2].$bits[3].$bits[5].$bits[6].$bits[8].$bits[9];
				if ($fileyymmdd == $checkyymmdd) {
					Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
					$ttime1 = $GLOBALS{'frs_time'};
					if ($ttime1 == "") { $ttime1 = "?";	}
					$ttime2 = $GLOBALS{'frs_timeend'};
					if ($ttime2 == "") {
						if ($ttime1 == "?") { $ttime2 = "?"; } 
						else { $ttime2 = OffsetMinutes ($ttime1,75); }	
					}
					if ($GLOBALS{'frs_ha'} == "H") {
						if (!in_array($GLOBALS{'frs_venue'}, $hva)) {
							array_push($hva, $GLOBALS{'frs_venue'});
						}
						if ($ttime1 != "?") {
							array_push($hfa, $ttime1."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
							if ($ttime1 < $earliesthomeslot) {
								$earliesthomeslot = $ttime1;
							}
							if ($ttime1 > $latesthomeslot) {
								$latesthomeslot = $ttime1;
							}
							if ($ttime2 != "?") {
								if ($ttime2 > $latesthomeslot) {
									$latesthomeslot = $ttime2;
								}
							}
						} else {
							array_push($uhfa, $ttime1."#F#".$frs_id."#".$GLOBALS{'frs_venue'}."#".$ttime2);
						}
					}
				}
			}
		}
	}

	$venuea = Get_Array("venue");
	foreach ($venuea as $venue_code)  {
		Get_Data("venue", $venue_code);
		if ($GLOBALS{'venue_bookable'} == "Yes") {
			$bookinga = Get_Array("booking", $venue_code);
			foreach ($bookinga as $booking_id)  {
				Get_Data("booking", $venue_code, $booking_id);
				$booking_datestart = $GLOBALS{'booking_datestart'};
				$booking_dateend = $GLOBALS{'booking_dateend'};
				if (($booking_dateend == "")||($booking_dateend == "0000-00-00")) {
					$booking_dateend = $booking_datestart;
				}
				$bookingthisday = "0";
				// XPTXT("DDD  ".$date."|".$booking_datestart."|".$booking_dateend);
				if (($booking_datestart == $booking_dateend)&&($date == $booking_datestart)) {
					// single booking
					$bookingthisday = "1";
				} else {
					if (($date >= $booking_datestart)&&($date <= $booking_dateend)) {
						if ($GLOBALS{'booking_weeklyrepeating'} == "Yes") {
							$bookingday = date("l", strtotime($booking_datestart));
							$thisday = date("l", strtotime($date));;
							if ($thisday == $bookingday) {
								$bookingthisday = "1";
							} // valid day match within period
						} else {
							$bookingthisday = "1"; // valid day in contiguous period
						}
					}
				}
				if ( $bookingthisday == "1" ) {
					Get_Data("venue", $GLOBALS{'booking_venuecode'});
					if ($GLOBALS{'venue_bookable'} == "Yes") {
						array_push($hfa, $GLOBALS{'booking_timestart'}."#B#".$venue_code."|".$booking_id."#".$GLOBALS{'booking_venuecode'}."#".$GLOBALS{'booking_timeend'});
						if (!in_array($GLOBALS{'booking_venuecode'}, $hva)) {
							array_push($hva, $GLOBALS{'booking_venuecode'});
						}
						if ($GLOBALS{'booking_timestart'} < $earliesthomeslot) {
							$earliesthomeslot = $GLOBALS{'booking_timestart'};
						}
						if ($GLOBALS{'booking_timestart'} > $latesthomeslot) {
							$latesthomeslot = $GLOBALS{'booking_timestart'};
						}
						if ($GLOBALS{'booking_timeend'} != "") {
							if ($GLOBALS{'booking_timeend'} > $latesthomeslot) {
								$latesthomeslot = $GLOBALS{'booking_timeend'};
							}
						}
					}
				}
			}
		}
	}
	
	$coursea = Get_Array("course");
	foreach ($coursea as $course_id)  {
		Get_Data("course", $course_id);
		$course_datestart = $GLOBALS{'course_datestart'};
		$course_dateend = $GLOBALS{'course_dateend'};
		if (($course_dateend == "")||($course_dateend == "0000-00-00")) {
			$course_dateend = $course_datestart;
		}
		$bookingthisday = "0";
		// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend);
		if (($course_datestart == $course_dateend)&&($date == $course_datestart)) {
			// single booking
			$bookingthisday = "1";
		} else {
			if (($date >= $course_datestart)&&($date <= $course_dateend)) {
				// XPTXT("DDD  ".$date."|".$course_datestart."|".$course_dateend."|".$GLOBALS{'course_weeklyrepeating'});
				if ($GLOBALS{'course_weeklyrepeating'} == "Yes") {
					$bookingday = date("l", strtotime($course_datestart));
					$thisday = date("l", strtotime($date));;
					if ($thisday == $bookingday) {
						$bookingthisday = "1";
					} // valid day match within period
				} else {
					$bookingthisday = "1"; // valid day in contiguous period
				}
			}
		}
		if ( $bookingthisday == "1" ) {
			Get_Data("venue", $GLOBALS{'course_venuecode'});
			if ($GLOBALS{'venue_bookable'} == "Yes") {
				array_push($hfa, $GLOBALS{'course_timestart'}."#C#".$course_id."#".$GLOBALS{'course_venuecode'}."#".$GLOBALS{'course_timeend'});
				if (!in_array($GLOBALS{'course_venuecode'}, $hva)) {
					array_push($hva, $GLOBALS{'course_venuecode'});
				}
				if ($GLOBALS{'course_timestart'} < $earliesthomeslot) {
					$earliesthomeslot = $GLOBALS{'course_timestart'};
				}
				if ($GLOBALS{'course_timestart'} > $latesthomeslot) {
					$latesthomeslot = $GLOBALS{'course_timestart'};
				}
				if ($GLOBALS{'course_timeend'} != "") {
					if ($GLOBALS{'course_timeend'} > $latesthomeslot) {
						$latesthomeslot = $GLOBALS{'course_timeend'};
					}
				}
			}
		}
	}

	if(empty($uhfa)){
	} else {
		XHR();
		XH3("Home fixtures not yet scheduled");
		XFORM("bookingmasterschedulerupdatein.php","masterschedulerupdate");
		XINSTDHID();
		XINHID('season',$season);
		XINHID('requesteddate',$date);
		XTABLE();
		XTR();
		XTDHTXT("Team");XTDHTXT("Date");XTDHTXT("Seq");XTDHTXT("Opposition");XTDHTXT("H/A");XTDHTXT("Lg/<br>Cup/<br>Fr");XTDHTXT("Venue");
		XTDHTXT("Time<br> eg 14:30");XTDHTXT("Time End<br>(optional)");XTDHTXT("Info");
		X_TR();
		sort($uhfa);
		$formseq = 1;
		foreach ($uhfa as $uhf)  {
			$bits = explode('#',$uhf);
			$ttime = $bits[0];
			$type = $bits[1];
			$frs_id = $bits[2];
			$tvenue = $bits[3];
			$ttimeend = $bits[4];
			if ($type == "F") {
				$bits = str_split($frs_id);
				$tteam_code = $bits[0].$bits[1];
				Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
				Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
				$tteam_name = $GLOBALS{'team_name'};
				$section = GetSectionFromTeamCode ($tteam_code);
				XTR();
				XINHID('frs_id'.$formseq,$frs_id);
				XTDTXT($GLOBALS{'team_name'});
				XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
				XTDTXT($GLOBALS{'frs_seq'});
				XTDINTXT('frs_oppo'.$formseq,$GLOBALS{'frs_oppo'},"20","30");
				XTDINSELECTHASH(List2Hash("H,A"),'frs_ha'.$formseq,$GLOBALS{'frs_ha'});
				XTDINSELECTHASH(List2Hash("L,C,F"),'frs_lcf'.$formseq,$GLOBALS{'frs_lcf'});
				XTD();
				$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
				XTXT("Home:");XINSELECTHASH($xhash,'frs_venue'.$formseq,$GLOBALS{'frs_venue'});XBR();
				XTXT("Away:");XINTXT('frs_awayvenue'.$formseq,"","30","60");
				X_TD();
				XTDINTXT('frs_time'.$formseq,$GLOBALS{'frs_time'},"5","8");
				XTDINTXT('frs_timeend'.$formseq,$GLOBALS{'frs_end'},"5","8");
				XTDINTXT('frs_info'.$formseq,$GLOBALS{'frs_end'},"5","8");
				X_TR();
				$formseq++;
			}
		}
		X_TABLE();
		XBR();
		XINHID('maxformseq',$formseq);
		XINSUBMIT("Update");
		X_FORM();
		XHR();
	}

	$highlightuptoa = Array();
	foreach ($hva as $hv) {
		$highlightuptoa[$hv] = "";
	}
	
	XH2("Home Fixtures");
	if(empty($hfa)){
		print "<P>No home fixtures have been found for this date\n";
	} else {
		if ( $GLOBALS{'LOGIN_frame_id'} != "F" ) {
			// Full Format
			sort($hfa);
			/*
			 XHR();
			XPTXT($earliesthomeslot." - ".$latesthomeslot);
			foreach ($hfa as $hf)  { XPTXT($hf); }
			*/
			$schedule = Array();
			for ($hh = 0; $hh < 24; $hh++) {
				for ($mm = 0; $mm < 4; $mm++) {
					$stime = substr("0".$hh,-2).":".substr("0".($mm*15),-2);
					array_push($schedule, $stime);
				}
			}
			$slotindex = 0;
			foreach ($schedule as $slot)  {
				if ($slot == $latesthomeslot) {
					$latestslotindex = $slotindex + 5;
				}
				$slotindex++;
			}
			if ($latestslotindex > count($schedule)-1) {
				$latestslotindex = $schedule[end($schedule)];
			}
			$latesthomeslot = $schedule[$latestslotindex];

			XTABLE(); XTR();XTDHTXT("Time");
			$hvindex = 0; $thishvindex = 0;
			foreach ($hva as $hv)  {
				Check_Data('venue',$hv);
				if ( $GLOBALS{'IOWARNING'} == "0") {
					XTDHTXT($GLOBALS{'venue_name'});
				} else {XTDHTXT($hv);
				}
			}
			X_TR();
			$slotindex = 0;
			foreach ($schedule as $slot)  {
				if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
					XPTXT($earliesthomeslot."|".$latesthomeslot."|");
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					if (substr($slot,3,2) == "00") {
						XTR(); XTDHTXT("");
						foreach ($hva as $hv )  {
							XTDHTXT("");
						}
						X_TR();
					}
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					XTR();
				}
				$hvindex = 0;
				foreach ($hva as $hv)  {
					$ftext = ""; $sep = "";
					foreach ($hfa as $hf)  {
						$bits = explode('#',$hf);
						$ttime = $bits[0];
						$type = $bits[1];
						$id = $bits[2];
						$tvenue = $bits[3];
						$ttimeend = $bits[4];
						if ($slotindex == count($schedule)-1) {
							$nextslot = "99.99";
						}  else {$nextslot = $schedule[$slotindex+1];
						}
						if (($ttime >= $slot)&&($ttime < $nextslot)&&($tvenue == $hv)) {
							if ($type == "F") {
								$bits = str_split($id);
								$tteam_code = $bits[0].$bits[1];
								Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$id);
								Check_Data("team",$GLOBALS{'currperiodid'}, $tteam_code);
								if ($GLOBALS{'IOWARNING'} == "0") {
									$tteam_name = $GLOBALS{'team_name'};
									if ($ttimeend == "?") {	$ttimeendtxt = ""; }
									else { $ttimeendtxt = " (until ".$ttimeend.")"; }
									$ttimeendtxt = "";
									$ftext = $ftext.$sep.$tteam_name." v ".$GLOBALS{'frs_oppo'}.$ttimeendtxt;
									if ($ttimeend > $highlightuptoa[$hv]) { $highlightuptoa[$hv] = $ttimeend; }
									$sep = "<br>";
								}
							}
							if ($type == "B") {
								$bits = explode('|',$id);
								Get_Data("booking",$bits[0],$bits[1]);
								if ($ttimeend == "?") {	$ttimeendtxt = ""; }
								else { $ttimeendtxt = " (until ".$ttimeend.")"; }
								$ftext = $ftext.$sep.$GLOBALS{'booking_title'}.$ttimeendtxt;
								if ($ttimeend > $highlightuptoa[$hv]) { $highlightuptoa[$hv] = $ttimeend; }							
								$sep = "<br>";
							}
							if ($type == "C") {
								Get_Data("course",$id);
								Get_Data("coursecategory",$GLOBALS{'course_coursecategoryid'});
								if ($ttimeend == "?") {	$ttimeendtxt = ""; }
								else { $ttimeendtxt = " (until ".$ttimeend.")"; }
								$ftext = $ftext.$sep.$GLOBALS{'coursecategory_name'}." - ".$GLOBALS{'course_title'}.$ttimeendtxt;
								if ($ttimeend > $highlightuptoa[$hv]) { $highlightuptoa[$hv] = $ttimeend; }
								$sep = "<br>";
							}
						}
					}
					if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
						if ($hvindex == 0) {
							XTDTXT($slot);
						}
						if ($ftext != "") {
							XTDTXTHIGHLIGHT($ftext);
						} else {
							if ($slot > $highlightuptoa[$hv] ) { $highlightuptoa[$hv] = ""; }
							if (($highlightuptoa[$hv] != "")&&($slot < $highlightuptoa[$hv])) { XTDTXTHIGHLIGHT($ftext);  }
							else { XTDTXT($ftext); }
						}
					}
					$hvindex++;
				}
				if (($slot >= $earliesthomeslot)&&($slot <= $latesthomeslot)) {
					X_TR();
				}
				$slotindex++;
			}
			X_TABLE();
		} else {	// Facebook condensed format
			XTABLE();
			XTR();XTDHTXT("Time");XTDHTXT("Team");XTDHTXT("Opposition");XTDHTXT("Venue");X_TR();
			sort($hfa);
			foreach ($hfa as $hf)  {
				$bits = explode('#',$hf);
				$ttime = $bits[0];
				$type = $bits[1];
				$frs_id = $bits[2];
				$bits = str_split($frs_id);
				$tteam_code = $bits[0].$bits[1];
				Get_Data("frs",$GLOBALS{'currperiodid'},$tteam_code,$frs_id);
				Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
				$tteam_name = $GLOBALS{'team_name'};
				XTR();XTDTXT($ttime);XTDTXT($GLOBALS{'team_name'});XTDTXT($GLOBALS{'frs_oppo'});XTDTXT($GLOBALS{'frs_venue'});X_TR();
			}
			X_TABLE();
		}
	}
}

function Booking_BOOKINGUPDATELIST_Output ($venue_code) {
	Get_Data('venue',$venue_code);
	XH2("Bookings Administration - ".$GLOBALS{'venue_name'});
	XFORM("bookingupdateout.php","newcourse");
	XINSTDHID();
	XINHID("venue_code",$venue_code);		
	XINHID("booking_id","new");
	XINSUBMIT("Create New Booking");
	X_FORM();
	XBR();XBR();
	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date Start");
	XTDHTXT("Date End");
	XTDHTXT("Time Start");
	XTDHTXT("Time End");	
	XTDHTXT("Weekly");
	XTDHTXT("Day");	
	XTDHTXT("Contact");		
	XTDHTXT("Status");
	XTDHTXT("Update");
	X_TR();
	$booking_ida = Get_Array('booking',$venue_code);
	foreach ($booking_ida as $booking_id) {
		Get_Data('booking',$venue_code,$booking_id);
		XTR();
		XTDTXT($booking_id);
		XTDTXT($GLOBALS{'booking_title'});
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'booking_datestart'}));
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'booking_dateend'}));
		XTDTXT($GLOBALS{'booking_timestart'});
		XTDTXT($GLOBALS{'booking_timeend'});
		XTDTXT($GLOBALS{'booking_weeklyrepeating'});
		XTDTXT($GLOBALS{'booking_dayofweek'});
		XTDTXT($GLOBALS{'booking_contact'});
		XTDTXT($GLOBALS{'booking_status'});		
		$link = YPGMLINK("bookingupdateout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("venue_code",$venue_code).YPGMPARM("booking_id",$booking_id).YPGMPARM("menulist",$bookingupdate);
		XTDLINKTXT($link,"update");
		X_TR();
	}
	X_TABLE();
}


function Booking_BOOKINGUPDATE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Booking_BOOKINGUPDATE_Output ($venue_code, $booking_id) {
	if ($booking_id == "new") {
		Initialise_Data('booking');
		$GLOBALS{'booking_status'} = "Draft";
		$booking_ida = Get_Array('booking', $venue_code);
		$highestbooking_id = "BK00000";
		foreach ($booking_ida as $booking_id) {
			$highestbooking_id = $booking_id;
		}
		$highestbooking_seq = str_replace("BK", "", $highestbooking_id);
		$highestbooking_seq++;
		$booking_id = "BK".substr(("00000".$highestbooking_seq), -5);
		XH1("New Booking - ".$booking_id);

	} else {
		Get_Data('booking', $venue_code, $booking_id);
		XH1("Course - ".$booking_id." - ".$GLOBALS{'booking_title'});
	}
	// $helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;
	XFORMUPLOAD("bookingupdatein.php","bookingupdatein");
	XINSTDHID();
	XINHID("venue_code",$venue_code);	
	XINHID("booking_id",$booking_id);
	XHR();
	XH4('Title.');
	XINTXT("booking_title",$GLOBALS{'booking_title'},"50","100");
	XH4('Full description of booking.');
	XINTEXTAREA("booking_description",$GLOBALS{'booking_description'},"5","100");
	XHR();
	XH4('Booking Venue and Schedule.');
	XTABLE();
	$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
	XTR();XTDTXT('Start Date');XTD();XINDATEYYYY_MM_DD("booking_datestart",$GLOBALS{'booking_datestart'});X_TD();X_TR();
	XTR();XTDTXT('End Date (optional)');XTD();XINDATEYYYY_MM_DD("booking_dateend",$GLOBALS{'booking_dateend'});X_TD();X_TR();	
	XTR();XTDTXT('Start Time');XTD();XINTXT("booking_timestart",$GLOBALS{'booking_timestart'},"10","50");X_TD();X_TR();
	XTR();XTDTXT('End Time');XTD();XINTXT("booking_timeend",$GLOBALS{'booking_timeend'},"10","50");X_TD();X_TR();	
	XTR();XTDTXT('Weekly Repeating');XTD();XINCHECKBOXYESNO ("booking_weeklyrepeating",$GLOBALS{'booking_weeklyrepeating'},"");X_TD();X_TR();	
	XTR();XTDTXT('Contact for Booking');
	XTD();XINTXTID("booking_contact","booking_contact",$GLOBALS{'booking_contact'},"50","100");
	XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
	XTXTID("booking_contactname",View_Person_List($GLOBALS{'booking_contact'}));
	XBR();X_TD();X_TR();
	X_TABLE();
	XHR();
	XH4('Booking Status');
	$xhash = List2Hash("Requested,Confirmed");
	XINRADIOHASH ($xhash,"booking_status",$GLOBALS{'booking_status'});XBR();
	XINSUBMIT("Update Booking");
	X_FORM();

	// Go_Back_To_CourseList;XBR();

	$GLOBALS{'PersonSelectPopupParameters'} = array(
		"this,person_id|person_sname|person_fname|person_section",
		"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
		"field,Lookup,Select,booking_contact,booking_contactname,100",
		"person_id",
		"all",
		"Stats Select,center,center,800,600",
	  	"view",
		"buildfulllist"
	);
	// $parm2 = Buttons Id – field,To,To..,ToPersonIdList,ToPersonNameList,70|field,Cc,CC..,CcDistList,CcPersonList,70
}

function UpdateEventAttendeeStatus ($event_attendeeref,$parm1,$parm2,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments) {
	// XPTXT('UpdateCourseAttendeeStatus "'.$event_attendeeref.'"');
	$attendeestatuslist = $GLOBALS{'event_attendeestatuslist'};
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	// XPTXT('BEFOREADD "'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$updatedattendeestatuslist = "";
	$found = "0";
	$sep = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			$attbits = explode('~',$attendeestatuslistelement);
			if ($event_attendeeref == $attbits[0]) {
				if ($parm1 != "") {$attbits[1] = $parm1;}
				if ($parm1 == "null") {$attbits[1] = "";}					
				if ($parm2 != "") {$attbits[2] = $parm2;}
				if ($parm2 == "null") {$attbits[2] = "";}				
				if ($paymenttype != "") {$attbits[3] = $paymenttype;}
				if ($paymenttype == "null") {$attbits[3] = "";}					
				if ($paymentdue != "") {$attbits[4] = $paymentdue;}
				if ($paymentdue == "null") {$attbits[4] = "";}				
				if ($paymentreceived != "") {$attbits[5] = $paymentreceived;}
				if ($paymentreceived == "null") {$attbits[5] = "";}	
				if ($paymentcomments != "") {$attbits[6] = $paymentcomments;}
				if ($paymentcomments == "null") {$attbits[6] = "";}	
				$updatedattendeestatuslist = $updatedattendeestatuslist.$sep.$attbits[0].'~'.$attbits[1].'~'.$attbits[2].'~'.$attbits[3].'~'.$attbits[4].'~'.$attbits[5].'~'.$attbits[6];
				$sep = "*";
				$found = "1";
			} else {
				$updatedattendeestatuslist = $updatedattendeestatuslist.$sep.$attbits[0].'~'.$attbits[1].'~'.$attbits[2].'~'.$attbits[3].'~'.$attbits[4].'~'.$attbits[5].'~'.$attbits[6];
				$sep= "*";
			}
		}
	}
	if ($found == "0") {
		$updatedattendeestatuslist = $updatedattendeestatuslist.$sep.$event_attendeeref.'~'.$parm1.'~'.$parm2.'~'.$paymenttype.'~'.$paymentdue.'~'.$paymentreceived.'~'.$paymentcomments;
	}	
	// XPTXT('MIDDLE "'.$updatedattendeestatuslist.'"');

	if ($updatedattendeestatuslist == "*") { $updatedattendeestatuslist = ""; } // just to be sure
	// XPTXT('AFTERADD "'.$updatedattendeestatuslist . '"');
	$GLOBALS{'event_attendeestatuslist'} = $updatedattendeestatuslist;
}


function DeleteEventAttendeeStatus ($event_attendeeref) {
	$attendeestatuslist = $GLOBALS{'event_attendeestatuslist'};
	if ($attendeestatuslist == "*") { $attendeestatuslist = ""; } // just to be sure
	// XPTXT('BEFOREDELETE <br>"'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$updatedattendeestatuslist = "";
	$sep = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			// XPTXT('"'.$attendeestatuslistelement.'"');
			$attbits = explode('~',$attendeestatuslistelement);
			if ($event_attendeeref == $attbits[0]) { } // drop this person
			else {
				$updatedattendeestatuslist = $updatedattendeestatuslist . $sep . $attbits[0] .'~'. $attbits[1] .'~'. $attbits[2] .'~'. $attbits[3] .'~'. $attbits[4] .'~'. $attbits[5] .'~'. $attbits[6];; 
				$sep = "*";
			}			
		}
		
	}

	if ($updatedattendeestatuslist == "*") { $updatedattendeestatuslist = ""; } // just to be sure
	// XPTXT('AFTERDELETE <br>"'.$updatedattendeestatuslist . '"');
	$GLOBALS{'event_attendeestatuslist'} = $updatedattendeestatuslist;
}

function GetEventAttendeeStatus ($event_attendeeref) {
	$attendeestatuslist = $GLOBALS{'event_attendeestatuslist'};
	if ($attendeestatuslist == "*") {
		$attendeestatuslist = "";
	} // just to be sure
	// XPTXT('BEFOREDELETE "'.$attendeestatuslist.'"');
	$attendeestatuslista = Array();
	$foundstring = "";
	if ($attendeestatuslist != "") {
		$attendeestatuslista = explode('*',$attendeestatuslist);
		foreach ($attendeestatuslista as $attendeestatuslistelement) {
			// XPTXT('"'+$attendeestatuslistelement+'"');
			$attbits = explode('~',$attendeestatuslistelement);
			if ($event_attendeeref == $attbits[0]) {
				$foundstring = $attendeestatuslistelement;
			}
		}
	}
	return $foundstring;
}


function GetNextTicketRange($draw_id,$drawtxn_ticketquantity) {
	// returns allocated : drawtxn, startticketrange, endticketrange
	// This copes with Ticket Number of format Ann, AAnnnn etc  where A= Alphabetic and n=numeric
	$newticketrangea = Array();
	// ====== Establish ticketrange structure ======================
	$prefix = "";
	$numberstring = "";
	$draw_startrange = $GLOBALS{'draw_startrange'};
	if ( $draw_startrange == "" ) { $draw_startrange = "TKT000"; }
	for( $i = 0; $i<strlen($draw_startrange); $i++ ) {
		if ( (substr($draw_startrange, $i, 1) >= "0")&&(substr($draw_startrange, $i, 1) <= "9")  )	{
			$numberstring = $numberstring . substr($draw_startrange, $i, 1);
		} else {
			$prefix = $prefix . substr($draw_startrange, $i, 1);
		}	
	}	
	// ====== FIrstly find the next available database keys ======================
	$highestdrawtxnid = "DT00000";
	$highestdrawtxnrange = $GLOBALS{'draw_startrange'};		
	$drawtxna = Get_Array('drawtxn',$draw_id);	
	foreach ($drawtxna as $drawtxn_id) {
		Get_Data('drawtxn',$draw_id,$drawtxn_id);
		if ($drawtxn_id > $highestdrawtxnid ) { $highestdrawtxnid = $drawtxn_id; }
		if ($GLOBALS{'drawtxn_endrange'} > $highestdrawtxnrange ) { $highestdrawtxnrange = $GLOBALS{'drawtxn_endrange'}; } 
	}
	$highestdrawtxnseq = str_replace("DT", "", $highestdrawtxnid);
	$highestdrawtxnseq++;
	$nextdrawtxnid = "DT".substr(("00000".$highestdrawtxnseq), -5);	
	array_push($newticketrangea, $nextdrawtxnid);	
	if (!empty($drawtxna)) {
		$highestdrawtxnrangeseq = str_replace($prefix, "", $highestdrawtxnrange);
	}else{
		$highestdrawtxnrangeseq = str_replace($prefix, "", $highestdrawtxnrange);
		$highestdrawtxnrangeseq = $highestdrawtxnrangeseq - 1; // Just to make first ever ticket correct
	}
	// ====== Now find the next ticket range ======================
	
	$startdrawtxnrangeseq = $highestdrawtxnrangeseq + 1 ;
	$startdrawtxnrange = $prefix.substr(("00000".$startdrawtxnrangeseq), -1*strlen($numberstring));
	array_push($newticketrangea, $startdrawtxnrange);
	$enddrawtxnrangeseq = $highestdrawtxnrangeseq + $drawtxn_ticketquantity ;	
	$endrawtxnrange = $prefix.substr(("00000".$enddrawtxnrangeseq), -1*strlen($numberstring));
	array_push($newticketrangea, $endrawtxnrange);	

	// XPTXT($newticketrangea[0]." ".$newticketrangea[1]." ".$newticketrangea[2]);
	return $newticketrangea;
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
