 <?php # personloginout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "bootstrappincodeinput";
$GLOBALS{'SITEJSOPTIONAL'} = "bootstrappincodeinput,pincodeinput";

$thistemplate = "Default";
Check_Data("template","Final","Login");
if ( $GLOBALS{'IOWARNING'} == "0" ) { $thistemplate = "Login"; }

PageHeader($thistemplate,"Final");
// This routine does not require login

$px = $_REQUEST['PX'];
$rlcx = $_REQUEST['RLCX'];
$rcd = $_REQUEST['RCD'];

$personid = XCrypt($px,"C0nnect1ve","decrypt");
$rlcd = XCrypt($rlcx,$personid,"decrypt");

Check_Data('person',$personid);
// XPTXT($px."-".$rlcx."-".$rcx);
// XPTXT($personid."-".$rlcd."-".$rcd);
// XPTXT($GLOBALS{'person_passwordresetlinkcode'}."-".$GLOBALS{'person_passwordresetlinktimestamp'}."-".$GLOBALS{'person_passwordresetcode'});
if (($rlcd == $GLOBALS{'person_passwordresetlinkcode'})&&($rcd == $GLOBALS{'person_passwordresetcode'})) {    
    XH2("Forgotten Password");
    XPTXT("Your access details are shown below.");
    XPTXT("Please do not disclose these details to anyone.");
    XHR();
    XPTXT("Person Id - ".$personid);
    $outstring = XCrypt($GLOBALS{'person_password'},$personid,"decrypt");
    XPTXT("Password - ".$outstring);
} else {    
   XPTXT("Invalid code."); 
}

Back_Navigator();
PageFooter($thistemplate,"Final");



?>