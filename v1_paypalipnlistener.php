<<<<<<< HEAD
<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

$GLOBALS{'IOERRORcode'} = "PPIPN001";
$GLOBALS{'IOERRORmessage'} = "remconnect.txt not found";
$remconnecta = Get_File_Array("../cgi-bin/remconnect.txt");
$rema = explode("|",$remconnecta[0]);
$GLOBALS{'LOGIN_service_id'} = $rema[0];
$GLOBALS{'LOGIN_domain_id'} = $rema[1]; // CHECK
$GLOBALS{'LOGIN_mode_id'} = $rema[2];

GlobalRoutine();

// STEP 1: Read POST data

// reading posted data from directly from $_POST causes serialization 
// issues with array data in POST
// reading raw POST data from input stream instead. 
$raw_post_data = file_get_contents('php://input');

Initialise_Data('paypalipn');
$GLOBALS{'paypalipn_status'} = "CHECK";
$GLOBALS{'paypalipn_rawdata'} = $raw_post_data;
Write_Data('paypalipn',$GLOBALS{'currentYYYYMMDDHHMMSS'});

$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}


// STEP 2: Post IPN data back to paypal to validate

$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);


// STEP 3: Inspect IPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0) {
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment

    // assign posted variables to local variables
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];  // domain_name|purposetype|purposeref|personid|itemparm1|itemparm2|itemparm3
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];

    // <---- HERE you can do your INSERT to the databas
  
    $GLOBALS{'paypalipn_status'} = "VERIFIED";
    $GLOBALS{'paypalipn_itemname'} = $item_name;
    $GLOBALS{'paypalipn_itemnumber'} = $item_number;
    $GLOBALS{'paypalipn_paymentstatus'} = $payment_status;
    $GLOBALS{'paypalipn_mcgross'} = $payment_amount;
    $GLOBALS{'paypalipn_mccurrency'} = $payment_currency;
    $GLOBALS{'paypalipn_txnid'} = $txn_id;
    $GLOBALS{'paypalipn_receiveremail'} = $receiver_email;
    $GLOBALS{'paypalipn_payeremail'} = $payer_email;  
    Write_Data('paypalipn',$GLOBALS{'currentYYYYMMDDHHMMSS'});

    $itembitsa = explode('|',$item_number);
    // ============ Membership Payments ======================================
    if ($itembitsa[1] == "Membership") {
    	// 0domain_id|1Membership|2purposeref|3personid|4persontype|5includedpersonidlist|6paymentgroup  
	    $paidpersonida = explode(',',$itembitsa[5]);
	    foreach ($paidpersonida as $paidpersonid) {
		    Check_Data('person',$paidpersonid); 
		    if ($GLOBALS{'IOWARNING'} == "0") {  			    
			    $GLOBALS{'person_type'} = $itembitsa[4];
			    $GLOBALS{'person_paidincrementfrequency'} = "oneoff";
			    $GLOBALS{'person_paidmethod'} = "PayPal";
			    $GLOBALS{'person_paidamount'} = $payment_amount;
			    $GLOBALS{'person_paiddetails'} = "";
			    $GLOBALS{'person_paidfamilygroup'} = $itembitsa[6];
			    $GLOBALS{'person_paiddate'} = $GLOBALS{'currentYYYY-MM-DD'};
			    $GLOBALS{'person_paidperiodid'} = $GLOBALS{'currperiodid'};
			    $GLOBALS{'person_paidemaildate'} = $GLOBALS{'currentYYYY-MM-DD'};
			    $GLOBALS{'person_paidconfirmationdate'} = $GLOBALS{'currentYYYY-MM-DD'};			    
			    $GLOBALS{'person_paidconfirmationperiodid'} = $GLOBALS{'currperiodid'};			    
			    $GLOBALS{'person_paidconfirmationemaildate'} = $GLOBALS{'currentYYYY-MM-DD'};			    
			    Write_Data('person',$paidpersonid);
		    }    
	    }

	    Check_Data("person",$itembitsa[3]);
	    if ($GLOBALS{'IOWARNING'} == "0") {
		    $emailto = Chosen_Person_Email();
		    $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		    $emailfooter1 = $GLOBALS{'domain_longname'};
		    $emailfooter2 = "Please do not reply to this message";
		    $emailsubject = 'Your '.$GLOBALS{'domain_longname'}.' membership renewal.';
		    if (UnderAge(18,$GLOBALS{'person_dob'})) {
		    	if ($GLOBALS{'person_parentfname'} == "") { $GLOBALS{'person_parentfname'} = $GLOBALS{'person_fname'}; }
		    	$mainmessage = 'Dear '.$GLOBALS{'person_parentfname'}.",<br><br>";
		    } else {
		    	$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.",<br><br>";
		    }
		    $mainmessage = $mainmessage.'This email is to confirm we have received your membership renewal and payment in our PayPal account.';
		    Check_Data('persontype', $GLOBALS{'currperiodid'}, $GLOBALS{'person_type'});
		    if ($GLOBALS{'IOWARNING'} == "0") {
		    	$mainmessage = $mainmessage."<br><br>Membership Type - ".$GLOBALS{'persontype_name'}." - ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'person_paidamount'}.".";;
		    }
		    if ($GLOBALS{'person_paidfamilygroup'} != "") {
		    	$mainmessage = $mainmessage."<br><br>This includes other family members - ".$GLOBALS{'person_paidfamilygroup'}.".";
		    }
		    $emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>";
		    HTMLEmail_Output("nomessage",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
	    }
    } 
    
    if ($itembitsa[1] == "Course") {    	
    	// 0domain_id|1Course|2course_id|3courseattendee_id|4|5|6   	
	    $incourse_id = $itembitsa[2];
		$incourseattendee_id = $itembitsa[3];
		$incourse_selectedcharge = $payment_amount;		
		Get_Data('course',$incourse_id);
		$GLOBALS{'course_attendeepaidlist'} = CommaList_Add($GLOBALS{'course_attendeepaidlist'}, $incourseattendee_id);
		// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
		UpdateCourseAttendeeStatus($incourseattendee_id,"","",$incourse_selectedcharge,"");
		Write_Data('course',$incourse_id);
		
		Get_Data('courseattendee',$incourseattendee_id);		
		Get_Data('person',$GLOBALS{'course_contact'});
		$emailto = $GLOBALS{'courseattendee_email'};
		$emailfrom = $GLOBALS{'person_email1'};
		$emailfooter1 = $GLOBALS{'domain_longname'};
		$emailfooter2 = "";
		$emailsubject = 'Your '.$GLOBALS{'course_title'}.' booking.';
		$mainmessage = 'This email is to confirm we have received the course payment for .'.$GLOBALS{'courseattendee_fname'}.' '.$GLOBALS{'courseattendee_sname'}."<br><br>";	
		$mainmessage = $mainmessage.'<b>Course</b> - '.$GLOBALS{'course_title'}."<br><br>";
		if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
			$mainmessage = $mainmessage.'<b>Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})."<br><br>";	
		} else {
			$mainmessage = $mainmessage.'<b>Dates</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'})."<br><br>";	
		}
		$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'}."<br><br>";
		$mainmessage = $mainmessage.'<b>Payment</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($payment_amount, 2, '.', '')."<br><br>";
		$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'course_venue'}."<br><br>";
		if ($paymentcomments != "") {
			$mainmessage = $mainmessage.'<b>Sessions</b> - '.$paymentcomments."<br><br>";
		}
		$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
		HTMLEmail_Output("nomessage",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);	    	
    }
    
    if ($itembitsa[1] == "Event") {
    	// 0domain_id|1Event|2event_id|3event_attendeeref|4|5|6
    	$inevent_id = $itembitsa[2];
    	$inevent_attendeeref = $itembitsa[3];
    	$inevent_attendeeref = str_replace( 'AT', '@', $inevent_attendeeref);
    	$inevent_attendeeref = str_replace( 'PIPE', '|', $inevent_attendeeref);
    	$inevent_selectedcharge = $payment_amount;
    	Get_Data('event',$inevent_id);
    	// $event_attendeeref,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
    	UpdateEventAttendeeStatus($inevent_attendeeref,"","","","",$inevent_selectedcharge,"");
    	Write_Data('event',$inevent_id);

    	if ( strlen(strstr($inevent_attendeeref,'|'))>0 ) {
    		$abits = explode('|',$inevent_attendeeref);
    		$thisfname = $abits[0];
    		$thissname = $abits[1];    		
    		$thisemail = $abits[2];    		
    	} else {
    		Get_Data('person',$inevent_attendeeref);
    		$thisfname = $GLOBALS{'person_fname'};
    		$thissname = $GLOBALS{'person_sname'};
    		$thisemail = $GLOBALS{'person_email1'};
    		if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email3'}; }
    	    if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email2'}; }   		
    	}

    	Get_Data('person',$GLOBALS{'event_contact'});    	
    	
    	$emailto = $thisemail;
    	$emailfrom = $GLOBALS{'person_email1'};
    	$emailfooter1 = $GLOBALS{'domain_longname'};
    	$emailfooter2 = "";
    	$emailsubject = 'Your '.$GLOBALS{'event_title'}.' booking.';
    	$mainmessage = 'This email is to confirm we have received the event payment for .'.$thisfname.' '.$thissname."<br><br>";
    	$mainmessage = $mainmessage.'<b>Event</b> - '.$GLOBALS{'event_title'}."<br><br>";
    	$mainmessage = $mainmessage.'<b>Dates</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'})."<br><br>";
    	$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'event_time'}."<br><br>";
    	$mainmessage = $mainmessage.'<b>Payment</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($payment_amount, 2, '.', '')."<br><br>";
    	Check_Data('venue',$GLOBALS{'event_venuecode'});
    	$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'venue_name'}."<br><br>";    	
    	if ($paymentcomments != "") {
    		$mainmessage = $mainmessage.'<b>Sessions</b> - '.$paymentcomments."<br><br>";
    	}
    	$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
    	HTMLEmail_Output("nomessage",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
    }   

    if ($itembitsa[1] == "Draw") {
    	// 0domain_id|1Draw|2draw_id|3drawtxn_id|4|5|6
    	$indraw_id = $itembitsa[2];
    	$indrawtxn_id = $itembitsa[3];
    	$indrawtxn_personid = $itembitsa[4];
    	
    	Get_Data('draw',$indraw_id);
    	Get_Data('drawtxn',$indraw_id,$indrawtxn_id);
    	$GLOBALS{'drawtxn_paymentdate'} = $GLOBALS{'currentYYYY-MM-DD'};
    	$GLOBALS{'drawtxn_paymentamount'} = $payment_amount;    	
    	Write_Data('drawtxn',$indraw_id,$indrawtxn_id);
    
    	Get_Data('person',$GLOBALS{'drawtxn_personid'});
    	$thisfname = $GLOBALS{'person_fname'};
    	$thissname = $GLOBALS{'person_sname'};
    	$thisemail = $GLOBALS{'person_email1'};
    	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email3'}; }
    	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email2'}; }	 
	    $emailto = $thisemail;
		Check_Data('person',$GLOBALS{'draw_contact'});
		$emailfrom = $GLOBALS{'person_email1'};
		$emailcc = $GLOBALS{'person_email1'}; $emailbcc = "";
		$emailfooter1 = $GLOBALS{'domain_longname'};
		$emailfooter2 = "";
		$emailsubject = 'Your '.$GLOBALS{'draw_title'}.' booking.';
		$mainmessage = 'This email is to confirm we have received your request for '.$GLOBALS{'drawtxn_quantity'}." tickets in this draw.<br><br>";
		$mainmessage = $mainmessage."Your ticket numbers are ".$GLOBALS{'drawtxn_startrange'}." to ".$GLOBALS{'drawtxn_endrange'}."<br><br>";
		$mainmessage = $mainmessage.'<b>Draw Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'draw_date'})."<br><br>";
		$mainmessage = $mainmessage.'<b>Draw Time</b> - '.$GLOBALS{'draw_time'}."<br><br>";
		$mainmessage = $mainmessage.'<b>Ticket Payment</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($payment_amount, 2, '.', '')."<br><br>";
		Check_Data('venue',$GLOBALS{'draw_venuecode'});
		$mainmessage = $mainmessage.'<b>Draw Venue</b> - '.$GLOBALS{'venue_name'}."<br><br>";
		
		$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
		HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);

    }
    
} else if (strcmp ($res, "INVALID") == 0) {
    // log for manual investigation
    
	// assign posted variables to local variables
	$item_name = $_POST['item_name'];
	$item_number = $_POST['item_number'];  // domain_name|purposetype|purposeref|personid|itemref
	$payment_status = $_POST['payment_status'];
	$payment_amount = $_POST['mc_gross'];
	$payment_currency = $_POST['mc_currency'];
	$txn_id = $_POST['txn_id'];
	$receiver_email = $_POST['receiver_email'];
	$payer_email = $_POST['payer_email'];
	
	// <---- HERE you can do your INSERT to the databas
	
	$GLOBALS{'paypalipn_status'} = "INVALID";
	$GLOBALS{'paypalipn_itemname'} = $item_name;
	$GLOBALS{'paypalipn_itemnumber'} = $item_number;
	$GLOBALS{'paypalipn_paymentstatus'} = $payment_status;
	$GLOBALS{'paypalipn_mcgross'} = $payment_amount;
	$GLOBALS{'paypalipn_mccurrency'} = $payment_currency;
	$GLOBALS{'paypalipn_txnid'} = $txn_id;
	$GLOBALS{'paypalipn_receiveremail'} = $receiver_email;
	$GLOBALS{'paypalipn_payeremail'} = $payer_email;
	Write_Data('paypalipn',$GLOBALS{'currentYYYYMMDDHHMMSS'});	
	
	
}
=======
<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

$GLOBALS{'IOERRORcode'} = "PPIPN001";
$GLOBALS{'IOERRORmessage'} = "remconnect.txt not found";
$remconnecta = Get_File_Array("../cgi-bin/remconnect.txt");
$rema = explode("|",$remconnecta[0]);
$GLOBALS{'LOGIN_service_id'} = $rema[0];
$GLOBALS{'LOGIN_domain_id'} = $rema[1]; // CHECK
$GLOBALS{'LOGIN_mode_id'} = $rema[2];

GlobalRoutine();

// STEP 1: Read POST data

// reading posted data from directly from $_POST causes serialization 
// issues with array data in POST
// reading raw POST data from input stream instead. 
$raw_post_data = file_get_contents('php://input');

Initialise_Data('paypalipn');
$GLOBALS{'paypalipn_status'} = "CHECK";
$GLOBALS{'paypalipn_rawdata'} = $raw_post_data;
Write_Data('paypalipn',$GLOBALS{'currentYYYYMMDDHHMMSS'});

$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}


// STEP 2: Post IPN data back to paypal to validate

$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);


// STEP 3: Inspect IPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0) {
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment

    // assign posted variables to local variables
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];  // domain_name|purposetype|purposeref|personid|itemparm1|itemparm2|itemparm3
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];

    // <---- HERE you can do your INSERT to the databas
  
    $GLOBALS{'paypalipn_status'} = "VERIFIED";
    $GLOBALS{'paypalipn_itemname'} = $item_name;
    $GLOBALS{'paypalipn_itemnumber'} = $item_number;
    $GLOBALS{'paypalipn_paymentstatus'} = $payment_status;
    $GLOBALS{'paypalipn_mcgross'} = $payment_amount;
    $GLOBALS{'paypalipn_mccurrency'} = $payment_currency;
    $GLOBALS{'paypalipn_txnid'} = $txn_id;
    $GLOBALS{'paypalipn_receiveremail'} = $receiver_email;
    $GLOBALS{'paypalipn_payeremail'} = $payer_email;  
    Write_Data('paypalipn',$GLOBALS{'currentYYYYMMDDHHMMSS'});

    $itembitsa = explode('|',$item_number);
    // ============ Membership Payments ======================================
    if ($itembitsa[1] == "Membership") {
    	// 0domain_id|1Membership|2purposeref|3personid|4persontype|5includedpersonidlist|6paymentgroup  
	    $paidpersonida = explode(',',$itembitsa[5]);
	    foreach ($paidpersonida as $paidpersonid) {
		    Check_Data('person',$paidpersonid); 
		    if ($GLOBALS{'IOWARNING'} == "0") {  			    
			    $GLOBALS{'person_type'} = $itembitsa[4];
			    $GLOBALS{'person_paidincrementfrequency'} = "oneoff";
			    $GLOBALS{'person_paidmethod'} = "PayPal";
			    $GLOBALS{'person_paidamount'} = $payment_amount;
			    $GLOBALS{'person_paiddetails'} = "";
			    $GLOBALS{'person_paidfamilygroup'} = $itembitsa[6];
			    $GLOBALS{'person_paiddate'} = $GLOBALS{'currentYYYY-MM-DD'};
			    $GLOBALS{'person_paidperiodid'} = $GLOBALS{'currperiodid'};
			    $GLOBALS{'person_paidemaildate'} = $GLOBALS{'currentYYYY-MM-DD'};
			    $GLOBALS{'person_paidconfirmationdate'} = $GLOBALS{'currentYYYY-MM-DD'};			    
			    $GLOBALS{'person_paidconfirmationperiodid'} = $GLOBALS{'currperiodid'};			    
			    $GLOBALS{'person_paidconfirmationemaildate'} = $GLOBALS{'currentYYYY-MM-DD'};			    
			    Write_Data('person',$paidpersonid);
		    }    
	    }

	    Check_Data("person",$itembitsa[3]);
	    if ($GLOBALS{'IOWARNING'} == "0") {
		    $emailto = Chosen_Person_Email();
		    $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		    $emailfooter1 = $GLOBALS{'domain_longname'};
		    $emailfooter2 = "Please do not reply to this message";
		    $emailsubject = 'Your '.$GLOBALS{'domain_longname'}.' membership renewal.';
		    if (UnderAge(18,$GLOBALS{'person_dob'})) {
		    	if ($GLOBALS{'person_parentfname'} == "") { $GLOBALS{'person_parentfname'} = $GLOBALS{'person_fname'}; }
		    	$mainmessage = 'Dear '.$GLOBALS{'person_parentfname'}.",<br><br>";
		    } else {
		    	$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.",<br><br>";
		    }
		    $mainmessage = $mainmessage.'This email is to confirm we have received your membership renewal and payment in our PayPal account.';
		    Check_Data('persontype', $GLOBALS{'currperiodid'}, $GLOBALS{'person_type'});
		    if ($GLOBALS{'IOWARNING'} == "0") {
		    	$mainmessage = $mainmessage."<br><br>Membership Type - ".$GLOBALS{'persontype_name'}." - ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'person_paidamount'}.".";;
		    }
		    if ($GLOBALS{'person_paidfamilygroup'} != "") {
		    	$mainmessage = $mainmessage."<br><br>This includes other family members - ".$GLOBALS{'person_paidfamilygroup'}.".";
		    }
		    $emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>";
		    HTMLEmail_Output("nomessage",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
	    }
    } 
    
    if ($itembitsa[1] == "Course") {    	
    	// 0domain_id|1Course|2course_id|3courseattendee_id|4|5|6   	
	    $incourse_id = $itembitsa[2];
		$incourseattendee_id = $itembitsa[3];
		$incourse_selectedcharge = $payment_amount;		
		Get_Data('course',$incourse_id);
		$GLOBALS{'course_attendeepaidlist'} = CommaList_Add($GLOBALS{'course_attendeepaidlist'}, $incourseattendee_id);
		// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
		UpdateCourseAttendeeStatus($incourseattendee_id,"","",$incourse_selectedcharge,"");
		Write_Data('course',$incourse_id);
		
		Get_Data('courseattendee',$incourseattendee_id);		
		Get_Data('person',$GLOBALS{'course_contact'});
		$emailto = $GLOBALS{'courseattendee_email'};
		$emailfrom = $GLOBALS{'person_email1'};
		$emailfooter1 = $GLOBALS{'domain_longname'};
		$emailfooter2 = "";
		$emailsubject = 'Your '.$GLOBALS{'course_title'}.' booking.';
		$mainmessage = 'This email is to confirm we have received the course payment for .'.$GLOBALS{'courseattendee_fname'}.' '.$GLOBALS{'courseattendee_sname'}."<br><br>";	
		$mainmessage = $mainmessage.'<b>Course</b> - '.$GLOBALS{'course_title'}."<br><br>";
		if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
			$mainmessage = $mainmessage.'<b>Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})."<br><br>";	
		} else {
			$mainmessage = $mainmessage.'<b>Dates</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'course_dateend'})."<br><br>";	
		}
		$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'}."<br><br>";
		$mainmessage = $mainmessage.'<b>Payment</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($payment_amount, 2, '.', '')."<br><br>";
		$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'course_venue'}."<br><br>";
		if ($paymentcomments != "") {
			$mainmessage = $mainmessage.'<b>Sessions</b> - '.$paymentcomments."<br><br>";
		}
		$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
		HTMLEmail_Output("nomessage",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);	    	
    }
    
    if ($itembitsa[1] == "Event") {
    	// 0domain_id|1Event|2event_id|3event_attendeeref|4|5|6
    	$inevent_id = $itembitsa[2];
    	$inevent_attendeeref = $itembitsa[3];
    	$inevent_attendeeref = str_replace( 'AT', '@', $inevent_attendeeref);
    	$inevent_attendeeref = str_replace( 'PIPE', '|', $inevent_attendeeref);
    	$inevent_selectedcharge = $payment_amount;
    	Get_Data('event',$inevent_id);
    	// $event_attendeeref,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
    	UpdateEventAttendeeStatus($inevent_attendeeref,"","","","",$inevent_selectedcharge,"");
    	Write_Data('event',$inevent_id);

    	if ( strlen(strstr($inevent_attendeeref,'|'))>0 ) {
    		$abits = explode('|',$inevent_attendeeref);
    		$thisfname = $abits[0];
    		$thissname = $abits[1];    		
    		$thisemail = $abits[2];    		
    	} else {
    		Get_Data('person',$inevent_attendeeref);
    		$thisfname = $GLOBALS{'person_fname'};
    		$thissname = $GLOBALS{'person_sname'};
    		$thisemail = $GLOBALS{'person_email1'};
    		if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email3'}; }
    	    if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email2'}; }   		
    	}

    	Get_Data('person',$GLOBALS{'event_contact'});    	
    	
    	$emailto = $thisemail;
    	$emailfrom = $GLOBALS{'person_email1'};
    	$emailfooter1 = $GLOBALS{'domain_longname'};
    	$emailfooter2 = "";
    	$emailsubject = 'Your '.$GLOBALS{'event_title'}.' booking.';
    	$mainmessage = 'This email is to confirm we have received the event payment for .'.$thisfname.' '.$thissname."<br><br>";
    	$mainmessage = $mainmessage.'<b>Event</b> - '.$GLOBALS{'event_title'}."<br><br>";
    	$mainmessage = $mainmessage.'<b>Dates</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'event_date'})."<br><br>";
    	$mainmessage = $mainmessage.'<b>Time</b> - '.$GLOBALS{'event_time'}."<br><br>";
    	$mainmessage = $mainmessage.'<b>Payment</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($payment_amount, 2, '.', '')."<br><br>";
    	Check_Data('venue',$GLOBALS{'event_venuecode'});
    	$mainmessage = $mainmessage.'<b>Venue</b> - '.$GLOBALS{'venue_name'}."<br><br>";    	
    	if ($paymentcomments != "") {
    		$mainmessage = $mainmessage.'<b>Sessions</b> - '.$paymentcomments."<br><br>";
    	}
    	$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
    	HTMLEmail_Output("nomessage",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
    }   

    if ($itembitsa[1] == "Draw") {
    	// 0domain_id|1Draw|2draw_id|3drawtxn_id|4|5|6
    	$indraw_id = $itembitsa[2];
    	$indrawtxn_id = $itembitsa[3];
    	$indrawtxn_personid = $itembitsa[4];
    	
    	Get_Data('draw',$indraw_id);
    	Get_Data('drawtxn',$indraw_id,$indrawtxn_id);
    	$GLOBALS{'drawtxn_paymentdate'} = $GLOBALS{'currentYYYY-MM-DD'};
    	$GLOBALS{'drawtxn_paymentamount'} = $payment_amount;    	
    	Write_Data('drawtxn',$indraw_id,$indrawtxn_id);
    
    	Get_Data('person',$GLOBALS{'drawtxn_personid'});
    	$thisfname = $GLOBALS{'person_fname'};
    	$thissname = $GLOBALS{'person_sname'};
    	$thisemail = $GLOBALS{'person_email1'};
    	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email3'}; }
    	if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email2'}; }	 
	    $emailto = $thisemail;
		Check_Data('person',$GLOBALS{'draw_contact'});
		$emailfrom = $GLOBALS{'person_email1'};
		$emailcc = $GLOBALS{'person_email1'}; $emailbcc = "";
		$emailfooter1 = $GLOBALS{'domain_longname'};
		$emailfooter2 = "";
		$emailsubject = 'Your '.$GLOBALS{'draw_title'}.' booking.';
		$mainmessage = 'This email is to confirm we have received your request for '.$GLOBALS{'drawtxn_quantity'}." tickets in this draw.<br><br>";
		$mainmessage = $mainmessage."Your ticket numbers are ".$GLOBALS{'drawtxn_startrange'}." to ".$GLOBALS{'drawtxn_endrange'}."<br><br>";
		$mainmessage = $mainmessage.'<b>Draw Date</b> - '.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'draw_date'})."<br><br>";
		$mainmessage = $mainmessage.'<b>Draw Time</b> - '.$GLOBALS{'draw_time'}."<br><br>";
		$mainmessage = $mainmessage.'<b>Ticket Payment</b> - '.$GLOBALS{'countrycurrencysymbol'}.number_format($payment_amount, 2, '.', '')."<br><br>";
		Check_Data('venue',$GLOBALS{'draw_venuecode'});
		$mainmessage = $mainmessage.'<b>Draw Venue</b> - '.$GLOBALS{'venue_name'}."<br><br>";
		
		$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
		HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);

    }
    
} else if (strcmp ($res, "INVALID") == 0) {
    // log for manual investigation
    
	// assign posted variables to local variables
	$item_name = $_POST['item_name'];
	$item_number = $_POST['item_number'];  // domain_name|purposetype|purposeref|personid|itemref
	$payment_status = $_POST['payment_status'];
	$payment_amount = $_POST['mc_gross'];
	$payment_currency = $_POST['mc_currency'];
	$txn_id = $_POST['txn_id'];
	$receiver_email = $_POST['receiver_email'];
	$payer_email = $_POST['payer_email'];
	
	// <---- HERE you can do your INSERT to the databas
	
	$GLOBALS{'paypalipn_status'} = "INVALID";
	$GLOBALS{'paypalipn_itemname'} = $item_name;
	$GLOBALS{'paypalipn_itemnumber'} = $item_number;
	$GLOBALS{'paypalipn_paymentstatus'} = $payment_status;
	$GLOBALS{'paypalipn_mcgross'} = $payment_amount;
	$GLOBALS{'paypalipn_mccurrency'} = $payment_currency;
	$GLOBALS{'paypalipn_txnid'} = $txn_id;
	$GLOBALS{'paypalipn_receiveremail'} = $receiver_email;
	$GLOBALS{'paypalipn_payeremail'} = $payer_email;
	Write_Data('paypalipn',$GLOBALS{'currentYYYYMMDDHHMMSS'});	
	
	
}
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>