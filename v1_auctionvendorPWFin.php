<<<<<<< HEAD
<?php # auctionvendorPWFin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

XH3("Forgotten Password");
# $helplink = "Person/Person_PWF_Output/person_pwf_output.html"; &Help_Link;

$inemail = $_REQUEST['PersonEmail'];

$persona = Get_Array('person');
$personidfound = "0";
foreach ($persona as $person_id) {
 Get_Data("person",$person_id);
 if (($GLOBALS{'person_email1'} == $inemail)&&($inemail != "")) {$personidfound = $person_id;}
}

if ($personidfound != "0") {
 Get_Data("person",$personidfound);
 $foundperson_passwordclear = XCrypt($GLOBALS{'person_password'},$personidfound,"decrypt");
 XH5("An email containing your password has been sent to ".$GLOBALS{'person_email1'});
 $Q = '"';
 $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
 $emailto = $GLOBALS{'person_email1'};
 $emailcc = "";
 $emailbcc = "";  
 $emailsubject = "Request for Personal Id and Password";
 $emailcontent = "Dear ".$GLOBALS{'person_fname'}.", Your Password is $Q$foundperson_passwordclear$Q.\n"; 
 $emailfooter1 = "Automated message from ".$GLOBALS{'domain_longname'};
 $emailfooter2 = "Please do not reply to this message"; 
 HTMLEmail_Output("",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
} else {
 print "<BR><BR>Password not sent - The email address is not recognised\n";
 Auction_VENDORPWF_Output();		
}

Back_Navigator();
PageFooter("Default","Final");

?>


	



=======
<?php # auctionvendorPWFin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

XH3("Forgotten Password");
# $helplink = "Person/Person_PWF_Output/person_pwf_output.html"; &Help_Link;

$inemail = $_REQUEST['PersonEmail'];

$persona = Get_Array('person');
$personidfound = "0";
foreach ($persona as $person_id) {
 Get_Data("person",$person_id);
 if (($GLOBALS{'person_email1'} == $inemail)&&($inemail != "")) {$personidfound = $person_id;}
}

if ($personidfound != "0") {
 Get_Data("person",$personidfound);
 $foundperson_passwordclear = XCrypt($GLOBALS{'person_password'},$personidfound,"decrypt");
 XH5("An email containing your password has been sent to ".$GLOBALS{'person_email1'});
 $Q = '"';
 $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
 $emailto = $GLOBALS{'person_email1'};
 $emailcc = "";
 $emailbcc = "";  
 $emailsubject = "Request for Personal Id and Password";
 $emailcontent = "Dear ".$GLOBALS{'person_fname'}.", Your Password is $Q$foundperson_passwordclear$Q.\n"; 
 $emailfooter1 = "Automated message from ".$GLOBALS{'domain_longname'};
 $emailfooter2 = "Please do not reply to this message"; 
 HTMLEmail_Output("",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
} else {
 print "<BR><BR>Password not sent - The email address is not recognised\n";
 Auction_VENDORPWF_Output();		
}

Back_Navigator();
PageFooter("Default","Final");

?>


	



>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
