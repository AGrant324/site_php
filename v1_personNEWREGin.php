<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login

Initialise_Data("action");
$GLOBALS{'action_status'} = "open";
$GLOBALS{'action_code'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.$GLOBALS{'action_type'};
$GLOBALS{'action_type'} = "NEWREG";

$existingfound = "0";

# extra logic goes in here

if ($existingfound == "0") {

	$gbits = explode(',', $GLOBALS{'domain_personmasters'});
	$GLOBALS{'action_addressee'} = $gbits[0];
	$inperson_sections = $_REQUEST['person_section'];
	$inperson_section = $inperson_sections[0]; # CHECK Multiple sections
	foreach (Get_Array_Hash("section",$GLOBALS{'currperiodid'}) as $section_name) {
		if ($section_name == $inperson_section ) {  
			Get_Data("section",$GLOBALS{'currperiodid'}, $section_name);
			$gbits = explode(',', $GLOBALS{'section_personmgrs'});
			$GLOBALS{'action_addressee'} = $gbits[0];
		}
	}
	
	$inperson_fname = $_REQUEST['person_fname'];
	$inperson_sname = $_REQUEST['person_sname'];
	$inperson_email1 = $_REQUEST['person_email1'];
	$inperson_email3 = $_REQUEST['person_email3'];
	$GLOBALS{'action_submitter'} = $inperson_fname." ".$inperson_sname;
	$GLOBALS{'action_description'} = "New Membership Registration";
	$GLOBALS{'action_dateraised'} = $GLOBALS{'currentYYYY-MM-DD'};
	$GLOBALS{'action_duedate'} = "";
	$GLOBALS{'action_string'} = Person_Form2Action();
	
	if ($inperson_fname == "Test") { $GLOBALS{'action_addressee'} = "bbra"; }
	Write_Data("action","open",$action_code);
	XH5("Thank you. Your request has been successfully received and an acknowledgement email generated.");
	
	Get_Data("person",$GLOBALS{'action_addressee'});
	
	if (($inperson_email3 != "")&&($inperson_email1 == "")) { $emailto = $inperson_email3; }
	else { $emailto = $inperson_email1; }
	$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
	$emailfooter1 = "Automated message from ".$GLOBALS{'domain_longname'}.".";
	$emailfooter2 = "Please do not reply to this message";
	$emailsubject = $GLOBALS{'action_description'}." - ".$GLOBALS{'action_submitter'} ;
	$emailcontent = "Thank you - Your application to become a member of ".$GLOBALS{'domain_longname'}." has been received.<br><br>\n";
	$emailcontent = $emailcontent."You will receive further confirmation from the membership secretary shortly.<br><br>\n";
	$emailcontent = $emailcontent."Reference - ".$action_code."\n";
	$display = "nodisplay";
	if ($inperson_fname == "Test") { $display = "display"; }    
	HTMLEmail_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	
	$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
	$emailfooter1 = "Automated message from ".$GLOBALS{'domain_longname'}.".";
	$emailfooter2 = "Please do not reply to this message";
	$emailto = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." <".$GLOBALS{'person_email1'}.">";
	$emailsubject = $GLOBALS{'action_description'}." - ".$GLOBALS{'action_submitter'} ;
	$emailcontent = "A membership request has been submitted by ".$GLOBALS{'action_submitter'}."<br><br>\n";
	$emailcontent = $emailcontent."Reference - ".$action_code."\n";
	$display = "nodisplay";
	if ($inperson_fname == "Test") { $display = "display"; }    
	HTMLEmail_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	
} else {
	
	XPTXT('It seems that we already have an entry for you in our club records.');

}	
	
	
	
Back_Navigator();
PageFooter("Default","Final");


?>