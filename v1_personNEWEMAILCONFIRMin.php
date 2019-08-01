<?php # personNEWCONFIRMin.php

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

$action_code = $_REQUEST["action_code"];
$changeperson_id = $_REQUEST["changeperson_id"];

XH3("Confirm Email Update");   
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
   Get_Data("action","open",$action_code);
   Person_Action2Globals($action_string);	
   $changeperson_email1 = $GLOBALS{'person_email1'};
   
   $changeperson_addr1 = $GLOBALS{'person_addr1'};
   $changeperson_addr2 = $GLOBALS{'person_addr2'};
   $changeperson_addr3 = $GLOBALS{'person_addr3'};   
   $changeperson_addr4 = $GLOBALS{'person_addr4'};
   $changeperson_postcode = $GLOBALS{'person_postcode'};
   $changeperson_hometel = $GLOBALS{'person_hometel'};
   $changeperson_worktel = $GLOBALS{'person_worktel'};   
   $changeperson_ = $GLOBALS{'person_mobiletel'};   
 
   Get_Data("person",$changeperson_id); 
   if (($GLOBALS{'person_email3'} != "")&&($GLOBALS{'person_email1'} == "")) { $GLOBALS{'person_email3'} = $changeperson_email1; }
   else { $GLOBALS{'person_email1'} = $changeperson_email1; }
   if ($changeperson_addr1 != "") { $GLOBALS{'person_addr1'} = $changeperson_addr1; }
   if ($changeperson_addr2 != "") { $GLOBALS{'person_addr2'} = $changeperson_addr2; }   
   if ($changeperson_addr3 != "") { $GLOBALS{'person_addr3'} = $changeperson_addr3; }
   if ($changeperson_addr4 != "") { $GLOBALS{'person_addr4'} = $changeperson_addr4; }    
   if ($changeperson_postcode != "") { $GLOBALS{'person_postcode'} = $changeperson_postcode; }
   if ($changeperson_hometel != "") { $GLOBALS{'person_hometel'} = $changeperson_hometel; }  
   if ($changeperson_worktel != "") { $GLOBALS{'person_worktel'} = $changeperson_worktel; }
   if ($changeperson_mobiletel != "") { $GLOBALS{'person_mobiletel'} = $changeperson_mobiletel; }  
   Write_Data("person",$changeperson_id);

   $emailto = Chosen_Person_Email();
   XH5('The email address for "'.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.'" has been updated and the following email created.');
   $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
   $emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname.' '. $askingperson_sname;
   $emailfooter2 = "Please do not reply to this message";
   $emailsubject = 'Your '.$GLOBALS{'domain_longname'}.' email address.';
   $mainmessage = 'Dear '.$GLOBALS{'person_fname'}."<br><br>";
   $mainmessage = $mainmessage.'This email is to confirm that your email address at '.$GLOBALS{'domain_longname'}.' has now been updated to '.$GLOBALS{'person_email1'}.'.<br><br>';
   $mainmessage = $mainmessage.'Could we please ask you to now login using this new email address and check that your people/contact details are up to date. ';  
   $mainmessage = $mainmessage."If you have forgotten your password, then follow the instructions and it will be sent back to this new email address. <br><br>";   
   $mainmessage = $mainmessage."This information will be the master for all club communications. <br><br>";   
   $emailcontent = $mainmessage."<br><br> Many Thanks. <br><br> $askingperson_fname <br>";
 
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
 
} else {
   print "<h3>You do not have authority to make this update.</h3>\n";
}
Back_Navigator();
PageFooter("Default","Final");

?>


