<?php # personPWin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_Login_Select_CSSJS();
PageHeader("Default","Final");

Check_Session_Validity();

$inoldperson_password = $_REQUEST['OldPW'];
$innewperson_password =  $_REQUEST['NewPW'];
$incheckperson_password = $_REQUEST['RepeatNewPW'];
$inperson_passwordclue = $_REQUEST['NewPWClue'];
$pswresetreason = $_REQUEST['PswResetReason'];

// print "<h2>Password Update</h2>\n";
Check_Data("person",$GLOBALS{'LOGIN_person_id'});
if ($GLOBALS{'IOWARNING'} == "0") {
  	# print XCrypt($inoldperson_password,$GLOBALS{'LOGIN_person_id'},"encrypt")." vs ".$GLOBALS{'person_password'};
	if (XCrypt($inoldperson_password,$GLOBALS{'LOGIN_person_id'},"encrypt") != $GLOBALS{'person_password'}) {
    $GLOBALS{'IOWARNING'} = "1";
    XPTXTCOLOR("ERROR - Current Password entered incorrectly","red");
  }
  $passbits = str_split($innewperson_password); 
  $passlen = sizeof($passbits);
  if ($passlen < 7) {
      $GLOBALS{'IOWARNING'} = "1";
      XPTXTCOLOR("ERROR - New password length less that 8 characters","red");
  }
  if ($innewperson_password == $inoldperson_password) {
      $GLOBALS{'IOWARNING'} = "1";
      XPTXTCOLOR("ERROR - New password cannot be the same as the old password","red");
  }
  if ($innewperson_password != $incheckperson_password) {
      $GLOBALS{'IOWARNING'} = "1";
      XPTXTCOLOR("ERROR - New password entered incorrectly","red");
  }
}
if ($GLOBALS{'IOWARNING'} == "0") {
  if ($innewperson_password != "") {
     $GLOBALS{'person_password'} = XCrypt($innewperson_password,$GLOBALS{'LOGIN_person_id'},"encrypt");
     $GLOBALS{'person_passworddate'} = $GLOBALS{'currentYYYY-MM-DD'};
     $yearon = $GLOBALS{'yyyy'} + 1;
     $GLOBALS{'person_passwordexpirydate'} = $yearon."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'};
     $GLOBALS{'person_passwordexpiryreason'} = "Expiry";
  }
  $GLOBALS{'person_passwordclue'} = "Self set";
  Write_Data("person",$GLOBALS{'LOGIN_person_id'});
  $extratext = "";
  if ($pswresetreason == "Initial Setup") {
    Get_Data("account_".$GLOBALS{'LOGIN_domain_id'});
    $GLOBALS{'account_contactpassword'} = XCrypt($innewperson_password,$GLOBALS{'LOGIN_domain_id'},"encrypt");
    $GLOBALS{'account_contactpasswordclue'} = "Self set";
    $GLOBALS{'account_contactpassworddate'} = $GLOBALS{'person_passworddate'}; 
    Write_Data("account_".$GLOBALS{'LOGIN_domain_id'});
    $extratext = "";
  }
  Back_Navigator();
  XPTXTCOLOR("Password updated successfully ".$extratext,"green");
  Get_Person_Authority();
  Person_Login_Select_Output();
  Back_Navigator();
}

PageFooter("Default","Final");
