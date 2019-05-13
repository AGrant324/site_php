<?php # personmembershiprenewal3.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$includedpersonidlist = $_REQUEST['IncludedPersonIdList'];
$paidpersonida = explode(',',$includedpersonidlist);
$inpaymentgroup = "";
if((isset($_REQUEST['PaymentGroup']))&&($_REQUEST['PaymentGroup']!="")) { $inpaymentgroup = $_REQUEST['PaymentGroup']; }

foreach ($paidpersonida as $paidpersonid) {	
	Get_Data("person",$paidpersonid);
	
	$GLOBALS{'person_paidperiodid'} = $GLOBALS{'currperiodid'};
	$GLOBALS{'person_paidemaildate'} = $GLOBALS{'currentYYYY-MM-DD'};
	$GLOBALS{'person_type'} = $_REQUEST['Type'];
	$GLOBALS{'person_paidincrementfrequency'} = $_REQUEST['Freq'];
	$GLOBALS{'person_paidmethod'} = $_REQUEST['Method'];
	$GLOBALS{'person_paidamount'} = $_REQUEST['Amount'];
	$GLOBALS{'person_paiddetails'} = $_REQUEST['PaymentDetails'];
	$GLOBALS{'person_paidfamilygroup'} = $inpaymentgroup;
	Get_Data('persontype',$GLOBALS{'currperiodid'},$GLOBALS{'person_type'});
	
	if ($GLOBALS{'person_paidincrementfrequency'} == "oneoff") {
		$GLOBALS{'person_paiddate'} = $_REQUEST["PaymentDate_YYYYpart"]."-".$_REQUEST["PaymentDate_MMpart"]."-".$_REQUEST["PaymentDate_DDpart"];
	}
	if ($GLOBALS{'person_paidincrementfrequency'} == "staged") {
		$GLOBALS{'person_paiddate'} = $_REQUEST["PaymentDate1_YYYYpart"]."-".$_REQUEST["PaymentDate1_MMpart"]."-".$_REQUEST["PaymentDate1_DDpart"];
	}
	Write_Data("person",$paidpersonid);
}


XH2("Membership Renewal");
$multimemberstext = "";
if ($inpaymentgroup != "") {
	XH5("Members included in this renewal");
	$vpaymentgroup = str_replace(',','<br>', $inpaymentgroup);
	XPTXT($vpaymentgroup);XBR();
	$multimemberstext = "<br><br>Members included in this renewal:<br>".$vpaymentgroup;
}
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

if ($_REQUEST['Method'] == "PayPal" ) {
	XH5("Thank you - your membership renewal has been successfully processed and payment received in our PayPal account.");
	// email already sent by paypal
	/*
	$emailto = Chosen_Person_Email();
	$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
	$emailfooter1 = $GLOBALS{'domain_longname'};
	$emailfooter2 = "Please do not reply to this message";
	$emailsubject = 'Your '.$GLOBALS{'domain_longname'}.' membership renewal.';
	$mainmessage = 'Dear '.$GLOBALS{'person_fname'}."<br><br>";
	$mainmessage = $mainmessage.'This email is to confirm we have received your membership renewal confirmation and are checking safe receipt of the payment.';
	$mainmessage = $mainmessage.$multimemberstext;
	$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>";
	if ($GLOBALS{'person_fname'} == "Test") {
		Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	} else {
		HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
	*/
} else {
	XH5("Thank You for renewing your membership for this season.");
	$emailto = Chosen_Person_Email();
	$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
	$emailfooter1 = $GLOBALS{'domain_longname'};
	$emailfooter2 = "Please do not reply to this message";
	$emailsubject = 'Your '.$GLOBALS{'domain_longname'}.' membership renewal.';
	if (UnderAge(18,$GLOBALS{'person_dob'})) {
		$mainmessage = 'Dear '.$GLOBALS{'person_parentfname'}.",<br><br>";
	} else {
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.",<br><br>";
	}	
	$mainmessage = $mainmessage.'This email is to confirm we have received your membership renewal confirmation and are checking safe receipt of the payment.';
	$mainmessage = $mainmessage.$multimemberstext;
	$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br>";
	if ($GLOBALS{'person_fname'} == "Test") { 
		Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);	
	} else {
		HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}	
}

Back_Navigator();
PageFooter("Default","Final");

?>
