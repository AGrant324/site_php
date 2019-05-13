<?php # personPWFIn.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login

XH2("Forgotten Personal Id and/or Password");
$helplink = "Person/Person_PWF_Output/person_pwf_output.html"; Help_Link();

$inviewemail = $_REQUEST['VE'];

$inperson_fname = $_REQUEST['PersonFName'];
$showonly = "0";
$inperson_sname = $_REQUEST['PersonSName'];
if (strlen(strstr($inperson_sname,"C0nnect1ve"))>0) {
	$fbits = explode('-', $inperson_sname);
	$inperson_sname = $fbits[0];
	$showonly = "1"; 
}
$inperson_email = $_REQUEST['PersonEmail'];
$inmatchsname = strtolower($inperson_sname); $inmatchsname = str_replace(' ', '', $inmatchsname);
$inmatchfname = strtolower($inperson_fname); $inmatchfname = str_replace(' ', '', $inmatchfname);
$inmatchemail = emailtolower($inperson_email); $inmatchemail = str_replace(' ', '', $inmatchemail);
#  XH4($inmatchemail);

$exactnamefound = "0";
$foundperson_ida = Array(); 
$foundpersoncount = 0;
$verystrongmatchcount = 0;
$strongmatchcount = 0;
$poormatchcount = 0;
$persona = Get_Array('person'); 
foreach ($persona as $tperson_id) {  	
  Get_Data("person",$tperson_id);
  $matchfname = strtolower($GLOBALS{'person_fname'}); $matchfname = str_replace(' ', '', $matchfname);    
  $matchsname = strtolower($GLOBALS{'person_sname'}); $matchsname = str_replace(' ', '', $matchsname);
  $matchpfname = strtolower($GLOBALS{'person_parentfname'}); $matchpfname = str_replace(' ', '', $matchpfname);
  $matchpsname = strtolower($GLOBALS{'person_parentsname'}); $matchpsname = str_replace(' ', '', $matchpsname);
  $matchstatus = "none";
  $strongmatchparentmember = "";
  $poormatchparentmember = "";    
  if (($matchsname == $inmatchsname)&&($matchsname != "")) { $matchstatus = "poor"; } 
  if (($matchpsname == $inmatchsname)&&($matchpsname != "")) { $matchstatus = "poor"; }   
  if (($matchfname == $inmatchfname)&&($matchfname != "")&&($matchsname == $inmatchsname)&&($matchsname != "")) { $matchstatus = "verystrong"; $exactnamefound = "1"; } 
  if (($matchpfname == $inmatchfname)&&($matchpfname != "")&&($matchpsname == $inmatchsname)&&($matchpsname != "")) { $matchstatus = "strong"; $exactnamefound = "1"; }  
   
  if ($matchstatus != "none") {
	$matchemail1 = emailtolower($GLOBALS{'person_email1'});
	$matchemail2 = emailtolower($GLOBALS{'person_email2'});
	$matchemail3 = emailtolower($GLOBALS{'person_email3'});
  	if ((strlen(strstr($matchemail3,$inmatchemail))>0) && ($matchemail3 != "")) { 
  	 if ($matchstatus == "verystrong") { $verystrongmatchcount++; $verystrongperson_id = $tperson_id; $verystrongmatchparentmember = "parent"; }	
     if ($matchstatus == "strong") { $strongmatchcount++; $strongperson_id = $tperson_id; $strongmatchparentmember = "parent"; }
  	 if ($matchstatus == "poor") { $poormatchcount++; $poorperson_id = $tperson_id; $poormatchparentmember = "parent"; }    
	 array_push($foundperson_ida, " - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});		
     $foundpersoncount++;
    } else {
	    if ((strlen(strstr($matchemail1,$inmatchemail))>0) && ($matchemail1 != "")) {
	    	if ($matchstatus == "verystrong") { $verystrongmatchcount++; $verystrongperson_id = $tperson_id; $verystrongmatchparentmember = "member"; }	
	        if ($matchstatus == "strong") { $strongmatchcount++; $strongperson_id = $tperson_id; $strongmatchparentmember = "member"; }
  	 		if ($matchstatus == "poor") { $poormatchcount++; $poorperson_id = $tperson_id; $poormatchparentmember = "member"; }    
	    	array_push($foundperson_ida, " - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});		    	
	    	$foundpersoncount++;
	    } else {
		    if ((strlen(strstr($matchemail2,$inmatchemail))>0) && ($matchemail2 != "")) {
		    	if ($matchstatus == "verystrong") { $verystrongmatchcount++; $verystrongperson_id = $tperson_id; $verystrongmatchparentmember = "member"; }	
		        if ($matchstatus == "strong") { $strongmatchcount++; $strongperson_id = $tperson_id; $strongmatchparentmember = "member"; }
  	 			if ($matchstatus == "poor") { $poormatchcount++; $poorperson_id = $tperson_id; $poormatchparentmember = "member"; }     
	    		array_push($foundperson_ida, " - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});	
		    	$foundpersoncount++;
		    }
	    }
    }     
  }  
}

# foreach ($foundperson_ida as $foundperson_string) {
# 	XH5("PRE - ".$foundperson_string);
# }

if ($foundpersoncount > 0) {	
	if (($verystrongmatchcount == 1) || ($verystrongmatchcount + $strongmatchcount + $poormatchcount == 1)) {
	  if ($poormatchcount == 1) { $foundperson_id = $poorperson_id; $foundpersonparentmember = $poormatchparentmember;}  
	  if ($strongmatchcount == 1) { $foundperson_id = $strongperson_id;  $foundpersonparentmember = $strongmatchparentmember;}	
	  if ($verystrongmatchcount == 1) { $foundperson_id = $verystrongperson_id;  $foundpersonparentmember = $verystrongmatchparentmember;}		
	  Get_Data("person",$foundperson_id);
	  if ( $foundpersonparentmember == "parent" ) {
	  	$foundperson_fname = $GLOBALS{'person_parentfname'};
	  	$foundperson_sname = $GLOBALS{'person_parentsname'};
	  	$foundperson_email = $inperson_email;
	  	$foundperson_password = $GLOBALS{'person_password'};
	  	$foundperson_identity = $GLOBALS{'person_fname'}."'s";	  	
	  }	else {
	  	$foundperson_fname = $GLOBALS{'person_fname'};
	  	$foundperson_sname = $GLOBALS{'person_sname'};
	  	$foundperson_email = $inperson_email;
	  	$foundperson_password = $GLOBALS{'person_password'};
	  	$foundperson_identity = "Your";	  	
	  }
		
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
			print"<h5>An email containing your Personal Id and password has also been sent to $foundperson_email<h5>\n";		
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
			print"<h5>An email containing your Personal Id and password has been sent to $foundperson_email<h5>\n";		 
			HTMLEmail_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
		}
	  }
	} else {
		XH3("Please retry and be more specific about which person you would like the password for.");
		foreach ($foundperson_ida as $foundperson_string) {					
			XH5($foundperson_string);
		}		
	}
  
} else {
  if ($exactnamefound == "1") {
  	XH3("Password not sent - You appear to be on our records, but with a different email address.");
  	XPTXT("If you have changed your email address please request your new email to be registered for you.(see option on forgotten password screen).");  		
  } else {
  	XH3("Password not sent - The information provided does not match the club records.");  	
  	
  }	
}	

Back_Navigator();
PageFooter("Default","Final");



