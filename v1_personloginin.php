<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Set_Menu();
Person_Login_Select_CSSJS();
// This routine does not require login
$inmembpsw = $_REQUEST['PersonPsw'];

$errortemplate = "Default";
Check_Data("template","Final","Login");
if ( $GLOBALS{'IOWARNING'} == "0" ) { $errortemplate = "Login"; }

$validpersoncount = 0;
$loginerrormessage = "";
$validperson_ida = Array();

$GLOBALS{'LOGIN_person_id'} = emailtolower($GLOBALS{'LOGIN_person_id'});
# ==================== sign in with email address ==============================

if (strlen(strstr($GLOBALS{'LOGIN_person_id'}, '@'))>0) {
    $emaillogin = $GLOBALS{'LOGIN_person_id'};
    $persona = Get_Array('person');
    foreach ($persona as $tperson_id) { 
        Get_Data("person",$tperson_id);
        if (($emaillogin == emailtolower($GLOBALS{'person_email1'}))||
            ($emaillogin == emailtolower($GLOBALS{'person_email2'}))||
            ($emaillogin == emailtolower($GLOBALS{'person_email3'}))) {
            $clearpsw = $inmembpsw;
            $encmembpsw = XCrypt($inmembpsw,$tperson_id,"encrypt");
            if ($encmembpsw == $GLOBALS{'person_password'}) {
                $validpersoncount++;
                array_push($validperson_ida, $tperson_id);
                $GLOBALS{'LOGIN_person_id'} = $tperson_id;
            } 
        } 
    }
    if ($validpersoncount == 0) {
        $loginerrormessage = "Login failed - Please check email and password";
    } 
    if ($validpersoncount == 1) {
        Get_Data("person",$GLOBALS{'LOGIN_person_id'});	
    }
    if ($validpersoncount > 1) {
       // ==== cannot determine unique personid eg parent of multiple juniors ==============
       PageHeader($errortemplate,"Final");
       Person_LoginMultiple_Output($validperson_ida);
       PageFooter($errortemplate,"Final");
       exit();
    }
}
# ==================== sign in with Personal Id ==============================
else {
    Check_Data("person",$GLOBALS{'LOGIN_person_id'});
    if ($GLOBALS{'IOWARNING'} == "0") {
        $validpersoncount = 1; 	
        $clearpsw = $inmembpsw;
        $revpsw = strrev($inmembpsw);
        $encmembpsw = XCrypt($inmembpsw,$GLOBALS{'LOGIN_person_id'},"encrypt");
        if (($encmembpsw == $GLOBALS{'person_password'})||($revpsw == $GLOBALS{'person_password'})) {   
        } else {
            $validpersoncount = 0;  	
            $loginerrormessage = "Incorrect password - Please try again";
        }
    } else {
        $validpersoncount = 0; 	
        $loginerrormessage = "Incorrect Personal Id - Please try again"; 	
    }
}  

if ($validpersoncount == 1) {
    $pswresetreason = "";
    if ( $GLOBALS{'person_passwordclue'} == "Initial Setup" ) {        
        $pswresetreason = "Initial Setup";        
    } 
    /*
    if ( $GLOBALS{'person_passwordclue'} == "Initial Password" ) {
        print "<P>Initial Login - Please choose a new password\n";
        $pswresetreason = "Initial Login";
    }
    */
    if (( $GLOBALS{'person_passwordexpirydate'} != "" )&&( $GLOBALS{'person_passwordexpirydate'} != "0000-00-00" )) {
        if ( $GLOBALS{'currentYYYY-MM-DD'} > $GLOBALS{'person_passwordexpirydate'} ) {
            XBR();
            $pswresetreason = "Old password expired";
        }
    }
    if ($pswresetreason != "") {
        // ==== password reset required ==============
        PageHeader($errortemplate,"Final");
        XBR(); XPTXTCOLOR($pswresetreason.' - Please choose a new password',"orange");       
        Set_Person_Session();
        Person_PW_Output();
        PageFooter($errortemplate,"Final");
    } else {
        // ==== valid login - proceed to menu ==============
        setcookie("MemberLevel0", $GLOBALS{'LOGIN_person_id'}, time()+31556926 ,'/');  // 1 Yr cookie for low level member only output on public pages 
        Person_Login_Select_CSSJS();
        $GLOBALS{'dashboardsectionsprovided'} = "1";
        Get_Person_Authority();
        Set_Person_Session();
        PageHeader("Default","Final");
        Back_Navigator();
        Set_Menu();
        Person_Login_Select_Output();
        Back_Navigator();
        PageFooter("Default","Final");
    }
} else {
    // ==== show error message and retry ==============
    PageHeader($errortemplate,"Final");
    XBR();
    XPTXTCOLOR($loginerrormessage,"red");
    XHR();
    Person_Login_Output();
    PageFooter($errortemplate,"Final");
}



?>

