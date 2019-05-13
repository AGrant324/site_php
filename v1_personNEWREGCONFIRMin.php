<?php # personNEWREGCONFIRMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_actionroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

XH3("Confirm Registration for New Member");
$editerror = "0";
$editmessage = "";
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
Get_Person_Authority();
if ((strlen(strstr($GLOBALS{'person_authority'},'DM'))>0)
	||(strlen(strstr($GLOBALS{'person_authority'},'MM'))>0)
	||(strlen(strstr($GLOBALS{'person_authority'},'SM'))>0)
	||(strlen(strstr($GLOBALS{'person_authority'},'AM'))>0)) {
   Initialise_Data('person');
   $action_code = $_REQUEST['action_code'];
   Check_Data('action',"open",$action_code);
   if ($GLOBALS{'IOWARNING'} != "0") {  
	   	Check_Data('action',"closed",$action_code);
	   	if ($GLOBALS{'IOWARNING'} == "0") { 
	   		XH3("Warning: This action has already been processed");
	   		Actions_VIEWLIST_Output();
	   	} else {
	   		XH3("Error: For some reason this action code does not exist");
	   		Actions_VIEWLIST_Output();
	   	}  	
   } else {
	   Person_Form2Globals();
	   $randompassword = createRandomPassword();
	   $GLOBALS{'person_password'} = XCrypt($randompassword,$GLOBALS{'person_id'},"encrypt");
	   $GLOBALS{'person_passwordclue'} = "Initial Password";
	   $GLOBALS{'person_passworddate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'};
	   $GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};
	   $GLOBALS{'person_locked'} = "";
	   if ( UnderAge("18",$GLOBALS{'person_dob'}) ) {$GLOBALS{'person_exdirectory'} = "0";}
	   else {$GLOBALS{'person_exdirectory'} = "3";}
	   $GLOBALS{'person_publicdirectory'} = "2";
	   $GLOBALS{'person_locked'} = "";
	   Write_Data("person",$GLOBALS{'person_id'});
	   # Edit_Person_Data();
	   # if ($editerror == "1") {
	   #  XH5("Errors still exist in this person record.");
	   #  XTXT($editmessage);
	   #  $changeperson_id = $innewperson_id;
	   # }
	   if ($GLOBALS{'action_type'} == "NEWREG") {
		   XH5('The record for "'.$GLOBALS{'person_id'}.'" has been set-up and the following email created.');
		   $emailto = Chosen_Person_Email();
		   $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		   $emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname.' '. $askingperson_sname;
		   $emailfooter2 = "Please do not reply to this message";
		   $emailsubject = 'You are now registered with '.$GLOBALS{'domain_longname'};
		   if (UnderAge(18,$GLOBALS{'person_dob'})) {
		   	$mainmessage = 'Dear '.$GLOBALS{'person_parentfname'}.",<br><br>";
		   	$mainmessage = $mainmessage.'This email is to confirm that '.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.' has been registered in the contact database for '.$GLOBALS{'domain_longname'}."<br><br>";		   
		   } else {
		   	$mainmessage = 'Dear '.$GLOBALS{'person_fname'}."<br><br>";
		   	$mainmessage = $mainmessage.'This email is to confirm that you have been registered in the contact database for '.$GLOBALS{'domain_longname'}."<br><br>";		   			   	
		   }		   
		   $mainmessage = $mainmessage.'Your '.$GLOBALS{'domain_longname'}.' Personal Id is "'.$GLOBALS{'person_id'}.'" and the password is "'.$randompassword.'" (Case Sensitive!). When you first use it you will be asked to reset this password to something more memorable. ';
		   $mainmessage = $mainmessage."Please do not disclose your password to other people. <br><br>";
		   $mainmessage = $mainmessage.'To login to the website on '.$GLOBALS{'domain_wwwurl'}.' use the Login Button on the navigation menu.'."<br><br>";   
		   $mainmessage = $mainmessage.'Could we please ask you to now login and perform the following actions.<br>';
		   $mainmessage = $mainmessage.' 1 Check that your people/contact details are up to date.<br>';
		   $mainmessage = $mainmessage.' 2 Pay your Membership Fees.<br><br>'; 
		   $mainmessage = $mainmessage."This information will be the master for all club communications. <br><br>";   
		   $emailcontent = $mainmessage."<br><br> Many Thanks. <br><br> $askingperson_fname <br>";
	   }
	   if ($GLOBALS{'action_type'} == "NEWEMAIL") {   	
	   	XH5('NewEmail Request - A new record for "'.$GLOBALS{'person_id'}.'" has been set-up and the following email created.');
		$emailto = Chosen_Person_Email();
	   	$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
	   	$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname.' '. $askingperson_sname;
	   	$emailfooter2 = "Please do not reply to this message";
	   	$emailsubject = 'Your request to change your email address';
	   	$mainmessage = 'Dear '.$GLOBALS{'person_fname'}."<br><br>";
	   	$mainmessage = $mainmessage.'It appears that you were not previously registered on the '.$GLOBALS{'domain_longname'}." database.<br><br>";   	
	   	$mainmessage = $mainmessage.'A record for you has now been set up'."<br><br>";
	   	$mainmessage = $mainmessage.'Your '.$GLOBALS{'domain_longname'}.' Personal Id is "'.$GLOBALS{'person_id'}.'" and the password is "'.$randompassword.'" (Case Sensitive!). When you first use it you will be asked to reset this password to something more memorable. ';
	   	$mainmessage = $mainmessage."Please do not disclose your password to other people. <br><br>";
	   	$mainmessage = $mainmessage.'To login to the website on '.$GLOBALS{'domain_wwwurl'}.' use the Login Button on the navigation menu.'."<br><br>";
	   	$mainmessage = $mainmessage.'Could we please ask you to now login and perform the following actions.<br>';
	   	$mainmessage = $mainmessage.' 1 Check that your people/contact details are up to date.<br>';
	   	$mainmessage = $mainmessage.' 2 Pay your Membership Fees.<br><br>';
	   	$mainmessage = $mainmessage."This information will be the master for all club communications. <br><br>";
	   	$emailcontent = $mainmessage."<br><br> Many Thanks. <br><br> $askingperson_fname <br>";
	   }
	   
	   HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	   # if ($editerror == "1") { Person_CM2_Output(); }
	
	   XH5("Action item $action_code closed - remaining actions shown below.");
	   Check_Data('action',"open",$action_code);
	   if ($GLOBALS{'IOWARNING'} == "0") {
	    Get_Data("action","open",$action_code);
	    Delete_Data("action","open",$action_code);
	    Write_Data("action","closed",$action_code);    
	   }
	   Actions_VIEWLIST_Output();
   
   }
 
} else {
   print "<h3>You do not have authority to make this update.</h3>\n";
}
Back_Navigator();
PageFooter("Default","Final");

?>


