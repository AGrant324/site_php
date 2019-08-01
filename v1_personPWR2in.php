<?php # personPWR2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$changeperson_id = $_REQUEST['ActionPersonId'];
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$askingperson_id = $GLOBALS{'LOGIN_person_id'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};

$innewperson_password =  $_REQUEST['NewPW'];
$incheckperson_password = $_REQUEST['RepeatNewPW'];

Check_Data("person",$changeperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
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
      $GLOBALS{'person_password'} = XCrypt($innewperson_password,$changeperson_id,"encrypt");
      $GLOBALS{'person_passworddate'} = $GLOBALS{'currentYYYY-MM-DD'};
      $yearon = $GLOBALS{'yyyy'} + 1;
      $GLOBALS{'person_passwordexpirydate'} = $yearon."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'};
      $GLOBALS{'person_passwordexpiryreason'} = "Reset";
  }
  Write_Data("person",$changeperson_id);
  XPTXTCOLOR("Password reset successfully ","green");
  
  
  // if ( $GLOBALS{'site_mailsendmethod'} != "" ) {  
      if ($GLOBALS{'person_email1'} != "") {
          $codea = PWFLinkCodeGenerate($changeperson_id);
          $resetlinkcode = $codea[0];
          $resetcode = $codea[1];
          $resetlinkcodex = $codea[2];
          $resetcodex = $codea[3];
          $personidx = XCrypt($changeperson_id,"C0nnect1ve","encrypt");
          $link = YPGMLINK("personPWFcodeout.php");
          $link = $link.YPGMMINPARMS().YPGMPARM("PX",$personidx).YPGMPARM("RCX",$resetcodex).YPGMPARM("RLCX",$resetlinkcodex);
          
          $GLOBALS{'person_passwordresetlinkcode'} = $resetlinkcode;
          $GLOBALS{'person_passwordresetlinktimestamp'} = $GLOBALS{'currenttimestamp'};
          $GLOBALS{'person_passwordresetcode'} = $resetcode;
          Write_Data("person",$changeperson_id);
          
          $changeperson_fname = $GLOBALS{'person_fname'};
          $changeperson_sname = $GLOBALS{'person_sname'};
          $changeperson_email = $GLOBALS{'person_email1'};
          
          $emailfrom = $GLOBALS{'domain_defaultemailaddress'};
          $emailfooter1 = "Automated message from ".$GLOBALS{'domain_longname'};
          $emailfooter2 = "Please do not reply to this message";
          $emailto = $changeperson_email;
          $emailcc = "";
          $emailbcc = "";
          $emailsubject = "Password Reset";
          $emailcontent = 'Dear '.$changeperson_fname.',<br><br>Your password has been reset. Please follow the following link to see your password.<br>'."\n";
          $emailcontent = $emailcontent.YLINKTXT($link,"Link").'<br>'."\n";
          $emailcontent = $emailcontent.'And then enter the following code - '.$resetcode.'<br><br>'."\n";
          $emailcontent = $emailcontent."Please do not disclose your password to other people.<br>";

          $display = "display";
          $inviewemailencrypted = XCrypt($inviewemail,"specialencryption","encrypt");
          if ($inviewemailencrypted == $GLOBALS{'specialkey'}) { $display = "display"; }
          XBR();
          XPTXT("The following email has been sent to ".$changeperson_email);
          HTMLEmail_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
      }   
          
  // }

  
}

Back_Navigator();
PageFooter("Default","Final");




?>
