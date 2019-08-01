<<<<<<< HEAD
<?php # personPWFIn.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "bootstrappincodeinput";
$GLOBALS{'SITEJSOPTIONAL'} = "bootstrappincodeinput,pincodeinput";
PageHeader("Default","Final");
// This routine does not require login

$px = $_REQUEST['PX'];
$rlcx = $_REQUEST['RLCX'];

XH2("Forgotten Your Personal ID and/or Password?");

XHR();
XPTXT("Please enter the code provided in the email.");
XFORM("personPWFcodein.php","forgottenpassword");
XINMINHID();
XINHID('PX',$px);
XINHID('RLCX',$rlcx);
XBR();
print '<input type="text" name="RCD" id="pincode">';
XBR();XBR();
XINSUBMITID("submit","Continue");
X_FORM();
	  
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
$GLOBALS{'SITECSSOPTIONAL'} = "bootstrappincodeinput";
$GLOBALS{'SITEJSOPTIONAL'} = "bootstrappincodeinput,pincodeinput";
PageHeader("Default","Final");
// This routine does not require login

$px = $_REQUEST['PX'];
$rlcx = $_REQUEST['RLCX'];

XH2("Forgotten Your Personal ID and/or Password?");

XHR();
XPTXT("Please enter the code provided in the email.");
XFORM("personPWFcodein.php","forgottenpassword");
XINMINHID();
XINHID('PX',$px);
XINHID('RLCX',$rlcx);
XBR();
print '<input type="text" name="RCD" id="pincode">';
XBR();XBR();
XINSUBMITID("submit","Continue");
X_FORM();
	  
Back_Navigator();
PageFooter("Default","Final");



>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
