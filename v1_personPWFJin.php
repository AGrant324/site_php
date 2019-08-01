<<<<<<< HEAD
<?php # personPWFIn.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login

XH3("Forgotten Personal Id and/or Password");
$helplink = "Person/Person_PWF_Output/person_pwf_output.html"; Help_Link();

$inviewemail = $_REQUEST['VE'];

$showonly = "0";
$inperson_fname = $_REQUEST['PersonFName'];
if (strlen(strstr($inperson_fname,"C0nnect1ve"))>0) {
	$fbits = explode('-', $inperson_fname);
	$inperson_fname = $fbits[0];
	$showonly = "1"; 
}
$inperson_sname = $_REQUEST['PersonSName'];
$inperson_email3 = $_REQUEST['PersonEmail3'];
$inperson_dob = $_REQUEST["PersonDOB_YYYYpart"]."-".$_REQUEST["PersonDOB_MMpart"]."-".$_REQUEST["PersonDOB_DDpart"];
$inmatchsname = strtolower($inperson_sname); $inmatchsname = str_replace(' ', '', $inmatchsname);
$inmatchfname = strtolower($inperson_fname); $inmatchfname = str_replace(' ', '', $inmatchfname);
$inmatchemail3 = emailtolower($inperson_email3); $inmatchemail3 = str_replace(' ', '', $inmatchemail3);
// XH4($inmatchfname." ".$inmatchsname." ".$inperson_dob." ".$inperson_email3);
$foundperson_id = "";
$foundperson_ida = Array(); 
$foundpersoncount = 0;
$persona = Get_Array('person'); 
foreach ($persona as $tperson_id) {  	
  Get_Data("person",$tperson_id);
  $matchfname = strtolower($GLOBALS{'person_fname'}); $matchfname = str_replace(' ', '', $matchfname);    
  $matchsname = strtolower($GLOBALS{'person_sname'}); $matchsname = str_replace(' ', '', $matchsname);
  if ( ($matchsname == $inmatchsname)&&($matchsname != "") ) {
  		// XH4($inmatchemail3." ".$GLOBALS{'person_email3'}." ".$inperson_dob." ".$GLOBALS{'person_dob'});
		if (($inmatchemail3 == $GLOBALS{'person_email3'})&($inperson_dob == $GLOBALS{'person_dob'})) {
			$foundperson_id = $tperson_id;
			$foundperson_fname = $GLOBALS{'person_parentfname'};
			$foundperson_sname = $GLOBALS{'person_parentsname'};
			$foundperson_email = $GLOBALS{'person_email3'};
			$foundperson_password = $GLOBALS{'person_password'};
			$foundperson_identity = $GLOBALS{'person_fname'}."'s";
			$foundpersoncount++;
		}
  }   
}

if ($foundpersoncount > 0) {

  $foundperson_passwordclear = XCrypt($foundperson_password,$foundperson_id,"decrypt");
  $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
  $emailfooter1 = "Automated message from ".$GLOBALS{'domain_longname'};
  $emailfooter2 = "Please do not reply to this message";
  $emailto = $foundperson_email;
  $emailcc = "";  
  $emailbcc = "";  
  $emailsubject = "Request for Personal Id and Password";
  $emailcontent = 'Dear '.$foundperson_fname.',<br><br>'.$foundperson_identity.' Personal Id is "'.$foundperson_id.'" and the Password is "'.$foundperson_passwordclear.'".'."<br><br>\n";
  $emailcontent = $emailcontent."Please do not disclose your password to other people.<br>";  
  if ($GLOBALS{'domain_showforgottenpasswordemail'} == "ON") {
  	$showforgottenpasswordemailkey = $_REQUEST['showforgottenpasswordemailkey'];  	
	if ($showforgottenpasswordemailkey == $GLOBALS{'domain_showforgottenpasswordemailkey'}) {  	
		print"<h5>An email containing your access details has also been sent to $foundperson_email<h5>\n";		
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	} else {
		print "<BR><BR>Incorrect Special Password\n";	
	}	
  } else {
	if ($foundperson_fname == "Test") { $showonly == "1"; }
	if ( $showonly == "1" )	{ 
		print"<h5>Simulation _ Following email has not been sent to $foundperson_email<h5>\n";		
		Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
	} else {
		$display = "nodisplay";
		$inviewemailencrypted = XCrypt($inviewemail,"specialencryption","encrypt");
		if ($inviewemailencrypted == $GLOBALS{'specialkey'}) { $display = "display"; }
		print"<h5>An email containing your access details has been sent to $foundperson_email<h5>\n";		 
		HTMLEmail_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
	}
  }
  
} else {
  print "<BR><BR>Password not sent - The information provided does not match the club records - Please contact your administrator\n";	
}	

Back_Navigator();
PageFooter("Default","Final");

=======
<?php # personPWFIn.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login

XH3("Forgotten Personal Id and/or Password");
$helplink = "Person/Person_PWF_Output/person_pwf_output.html"; Help_Link();

$inviewemail = $_REQUEST['VE'];

$showonly = "0";
$inperson_fname = $_REQUEST['PersonFName'];
if (strlen(strstr($inperson_fname,"C0nnect1ve"))>0) {
	$fbits = explode('-', $inperson_fname);
	$inperson_fname = $fbits[0];
	$showonly = "1"; 
}
$inperson_sname = $_REQUEST['PersonSName'];
$inperson_email3 = $_REQUEST['PersonEmail3'];
$inperson_dob = $_REQUEST["PersonDOB_YYYYpart"]."-".$_REQUEST["PersonDOB_MMpart"]."-".$_REQUEST["PersonDOB_DDpart"];
$inmatchsname = strtolower($inperson_sname); $inmatchsname = str_replace(' ', '', $inmatchsname);
$inmatchfname = strtolower($inperson_fname); $inmatchfname = str_replace(' ', '', $inmatchfname);
$inmatchemail3 = emailtolower($inperson_email3); $inmatchemail3 = str_replace(' ', '', $inmatchemail3);
// XH4($inmatchfname." ".$inmatchsname." ".$inperson_dob." ".$inperson_email3);
$foundperson_id = "";
$foundperson_ida = Array(); 
$foundpersoncount = 0;
$persona = Get_Array('person'); 
foreach ($persona as $tperson_id) {  	
  Get_Data("person",$tperson_id);
  $matchfname = strtolower($GLOBALS{'person_fname'}); $matchfname = str_replace(' ', '', $matchfname);    
  $matchsname = strtolower($GLOBALS{'person_sname'}); $matchsname = str_replace(' ', '', $matchsname);
  if ( ($matchsname == $inmatchsname)&&($matchsname != "") ) {
  		// XH4($inmatchemail3." ".$GLOBALS{'person_email3'}." ".$inperson_dob." ".$GLOBALS{'person_dob'});
		if (($inmatchemail3 == $GLOBALS{'person_email3'})&($inperson_dob == $GLOBALS{'person_dob'})) {
			$foundperson_id = $tperson_id;
			$foundperson_fname = $GLOBALS{'person_parentfname'};
			$foundperson_sname = $GLOBALS{'person_parentsname'};
			$foundperson_email = $GLOBALS{'person_email3'};
			$foundperson_password = $GLOBALS{'person_password'};
			$foundperson_identity = $GLOBALS{'person_fname'}."'s";
			$foundpersoncount++;
		}
  }   
}

if ($foundpersoncount > 0) {

  $foundperson_passwordclear = XCrypt($foundperson_password,$foundperson_id,"decrypt");
  $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
  $emailfooter1 = "Automated message from ".$GLOBALS{'domain_longname'};
  $emailfooter2 = "Please do not reply to this message";
  $emailto = $foundperson_email;
  $emailcc = "";  
  $emailbcc = "";  
  $emailsubject = "Request for Personal Id and Password";
  $emailcontent = 'Dear '.$foundperson_fname.',<br><br>'.$foundperson_identity.' Personal Id is "'.$foundperson_id.'" and the Password is "'.$foundperson_passwordclear.'".'."<br><br>\n";
  $emailcontent = $emailcontent."Please do not disclose your password to other people.<br>";  
  if ($GLOBALS{'domain_showforgottenpasswordemail'} == "ON") {
  	$showforgottenpasswordemailkey = $_REQUEST['showforgottenpasswordemailkey'];  	
	if ($showforgottenpasswordemailkey == $GLOBALS{'domain_showforgottenpasswordemailkey'}) {  	
		print"<h5>An email containing your access details has also been sent to $foundperson_email<h5>\n";		
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	} else {
		print "<BR><BR>Incorrect Special Password\n";	
	}	
  } else {
	if ($foundperson_fname == "Test") { $showonly == "1"; }
	if ( $showonly == "1" )	{ 
		print"<h5>Simulation _ Following email has not been sent to $foundperson_email<h5>\n";		
		Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
	} else {
		$display = "nodisplay";
		$inviewemailencrypted = XCrypt($inviewemail,"specialencryption","encrypt");
		if ($inviewemailencrypted == $GLOBALS{'specialkey'}) { $display = "display"; }
		print"<h5>An email containing your access details has been sent to $foundperson_email<h5>\n";		 
		HTMLEmail_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
	}
  }
  
} else {
  print "<BR><BR>Password not sent - The information provided does not match the club records - Please contact your administrator\n";	
}	

Back_Navigator();
PageFooter("Default","Final");

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
