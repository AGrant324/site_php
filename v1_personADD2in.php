<?php # personAM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_actionroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
$window = $_REQUEST['Window'];

Person_ADD2_CSSJS();
if ($window == "Window") { PageHeader("Default","Final"); Back_Navigator(); }
if ($window == "Popup") { PopUpHeader(); }
Check_Session_Validity();
$inaddperson_id = $_REQUEST['ActionPersonId'];

XH3("Add a new person");
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
   Person_Form2Globals();
   $editerrorstring = ""; $esep = "";
   if (VSF("personmembership")) {
	   if ($GLOBALS{'person_section'} == "") { $editerrorstring = $editerrorstring.$esep."Please enter a section for this person"; $esep = "<br>";}
	   if (($GLOBALS{'person_email1'} == "")&&($GLOBALS{'person_email3'} == "")) {
	   	$editerrorstring = $editerrorstring.$esep."Please enter an email or parental email for this person"; $esep = "<br>";
	   }
   }
   if ($editerrorstring != "") {
   		XTXTCOLOR($editerrorstring,"red");
   		Person_ADD2_Output($window,$inaddperson_id,$GLOBALS{'person_fname'},$GLOBALS{'person_sname'},"errormode");
   } else {
	   $GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};
	   $randompassword = createRandomPassword();
	   $GLOBALS{'person_password'} = XCrypt($randompassword,$inaddperson_id,"encrypt");
	   $GLOBALS{'person_passwordclue'} = "Initial Password";
	   $GLOBALS{'person_passworddate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'};
	   $GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};
	   $GLOBALS{'person_locked'} = "";
	   Write_Data("person",$inaddperson_id);
	   Finalise_TempImages ($GLOBALS{'domainfilepath'}."/personphotos",$GLOBALS{'person_photo'});   
	   
	   XH5('The record for "'.$inaddperson_id.'" has been set-up and the following email created.');
	   $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
	   $emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
	   $emailfooter2 = "Please do not reply to this message";
	   $emailsubject = 'You are now registered with '.$GLOBALS{'domain_longname'};   
	   
	
	   if ($GLOBALS{'person_email3'} == "") {
	   		$emailto = $GLOBALS{'person_email1'};   	
	   		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
	   		$mainmessage = $mainmessage.'This email is to confirm that you have been registered in the contact database for '.$GLOBALS{'domain_longname'}.'. <br><br>';
	   } else {
		   	$emailto = $GLOBALS{'person_email3'};
		   	$mainmessage = 'Dear '.$GLOBALS{'person_parentfname'}.'<br><br>';
		   	$mainmessage = $mainmessage.'This email is to confirm that '.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.' has been registered in the contact database for '.$GLOBALS{'domain_longname'}.'. <br><br>';
	   }    
	   $mainmessage = $mainmessage.'Your '.$GLOBALS{'domain_longname'}.' Personal Id is "'.$inaddperson_id.'" and the password is "'.$randompassword.'" (Case Sensitive!). When you first use it you will be asked to reset this password to something more memorable. ';
	   $mainmessage = $mainmessage.'Please do not share or disclose your password to other people. <br><br>';
	   $mainmessage = $mainmessage.'To login to the website use the Login Button on the navigation menu and then follow the instructions. <br><br>';   
	   $mainmessage = $mainmessage.'Could we ask you to now login and check that your people/contact details are up to date. ';  
	   $mainmessage = $mainmessage.'This information will be the master for all club communications.<br>';
	   $emailcontent = $mainmessage.'<br><br>Many Thanks. <br><br> '.$askingperson_fname.' <br>';
	
	   HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
   }
} else {
   print XH4("You do not have authority to make this update.");
}

if ($window == "Window") { Back_Navigator(); PageFooter("Default","Final"); }
if ($window == "Popup") { XBR();XINBUTTONCLOSEWINDOW("Close"); PopUpFooter(); }

?>
