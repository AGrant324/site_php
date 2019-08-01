<<<<<<< HEAD
<?php # personmembershipconfirm.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader(); 
Check_Session_Validity();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
Get_Person_Authority();

$confirmperson_id = $_REQUEST['confirmperson_id'];
Get_Data("person",$confirmperson_id);
$GLOBALS{'person_paidconfirmationperiodid'} = $GLOBALS{'currperiodid'};
$GLOBALS{'person_paidconfirmationdate'} = $GLOBALS{'currentYYYY-MM-DD'};
$GLOBALS{'person_paidconfirmationemaildate'} = $GLOBALS{'currentYYYY-MM-DD'};
$GLOBALS{'person_paidconfirmationemailsent'} = "Yes"; // to be deprecated

Write_Data("person",$confirmperson_id);

XH5("The following email has been sent.");

$emailto = Chosen_Person_Email();
$emailfrom = $askingperson_email;
$emailfooter1 = $GLOBALS{'domain_longname'};
$emailfooter2 = "";
$emailsubject = 'Your '.$GLOBALS{'domain_longname'}.' membership payment.';
if (UnderAge(18,$GLOBALS{'person_dob'})) {  
	$mainmessage = 'Dear '.$GLOBALS{'person_parentfname'}.",<br><br>";
	$mainmessage = $mainmessage.'This email is to confirm we have received the membership payment for '.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.".";	
} else { 
	$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.",<br><br>";
	$mainmessage = $mainmessage.'This email is to confirm we have received your membership payment.';
}
Check_Data('persontype', $GLOBALS{'currperiodid'}, $GLOBALS{'person_type'});
if ($GLOBALS{'IOWARNING'} == "0") {
	$mainmessage = $mainmessage."<br><br>Membership Type - ".$GLOBALS{'persontype_name'}." - ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'person_paidamount'}.".";;	
}
if ($GLOBALS{'person_paidfamilygroup'} != "") {
	$mainmessage = $mainmessage."<br><br>This includes other family members - ".$GLOBALS{'person_paidfamilygroup'}.".";
}

$emailcontent = $mainmessage."<br><br>Many Thanks. <br><br>".$askingperson_fname." ".$askingperson_sname;
if ($GLOBALS{'person_fname'} == "Test") { 
	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);	
} else {
	HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);	
}	

XBR();XINBUTTONCLOSEWINDOW("Close"); PopUpFooter();

?>
=======
<?php # personmembershipconfirm.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader(); 
Check_Session_Validity();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
Get_Person_Authority();

$confirmperson_id = $_REQUEST['confirmperson_id'];
Get_Data("person",$confirmperson_id);
$GLOBALS{'person_paidconfirmationperiodid'} = $GLOBALS{'currperiodid'};
$GLOBALS{'person_paidconfirmationdate'} = $GLOBALS{'currentYYYY-MM-DD'};
$GLOBALS{'person_paidconfirmationemaildate'} = $GLOBALS{'currentYYYY-MM-DD'};
$GLOBALS{'person_paidconfirmationemailsent'} = "Yes"; // to be deprecated

Write_Data("person",$confirmperson_id);

XH5("The following email has been sent.");

$emailto = Chosen_Person_Email();
$emailfrom = $askingperson_email;
$emailfooter1 = $GLOBALS{'domain_longname'};
$emailfooter2 = "";
$emailsubject = 'Your '.$GLOBALS{'domain_longname'}.' membership payment.';
if (UnderAge(18,$GLOBALS{'person_dob'})) {  
	$mainmessage = 'Dear '.$GLOBALS{'person_parentfname'}.",<br><br>";
	$mainmessage = $mainmessage.'This email is to confirm we have received the membership payment for '.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.".";	
} else { 
	$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.",<br><br>";
	$mainmessage = $mainmessage.'This email is to confirm we have received your membership payment.';
}
Check_Data('persontype', $GLOBALS{'currperiodid'}, $GLOBALS{'person_type'});
if ($GLOBALS{'IOWARNING'} == "0") {
	$mainmessage = $mainmessage."<br><br>Membership Type - ".$GLOBALS{'persontype_name'}." - ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'person_paidamount'}.".";;	
}
if ($GLOBALS{'person_paidfamilygroup'} != "") {
	$mainmessage = $mainmessage."<br><br>This includes other family members - ".$GLOBALS{'person_paidfamilygroup'}.".";
}

$emailcontent = $mainmessage."<br><br>Many Thanks. <br><br>".$askingperson_fname." ".$askingperson_sname;
if ($GLOBALS{'person_fname'} == "Test") { 
	Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);	
} else {
	HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);	
}	

XBR();XINBUTTONCLOSEWINDOW("Close"); PopUpFooter();

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
