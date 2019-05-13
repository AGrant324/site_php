<?php # personloginin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
// This routine does not require login
Back_Navigator();
$sendtorole = $_REQUEST['SendToRole'];
$sendtoid = $_REQUEST['SendToId'];
$subject =  $_REQUEST['Subject'];
$sendmessage = $_REQUEST['SendMessage'];
$fromname = $_REQUEST['FromName'];
$fromemail = $_REQUEST['FromEmail'];
// print "$sendtorole - $sendtoid - $subject - $sendmessage - $fromname - $fromemail\n";
$sendmessage = Replace_CR( $sendmessage, "" );
Check_Data("person",$sendtoid);
if ($GLOBALS{'IOWARNING'} == "1") {
 print "<BR>Sorry - $sendtorole not found";
} else {
 $emailto = Chosen_Person_Email(); if ($fromemail != "") {		
	 if ($emailto != "") {
	  $emailcc = "";  
	  $emailbcc = "";  
	  $emailsubject = $subject;
	  $emailcontent = $sendmessage;
	  $emailfrom = $fromemail;
	  $emailfooter1 = $fromname." - ".$fromemail;
	  $emailfooter2 = 'This email was created from "'.$GLOBALS{'domainwwwurl'}.'" and addressed to "'.$sendtorole.'"';
	  HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	  print "<P><P>Thankyou - your email message has been sent to ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." - ".$sendtorole;
	 } else {
	  print "<BR>Sorry - no email address found for $sendtorole";
	 } } else { 	print "<BR>Please enter a valid email address for us to reply to."; }
}
Back_Navigator();
PageFooter("Default","Final");



function MailErrorMessage () {
   print "<P>The mail server has a problem\n";
   exit;
}

?>
