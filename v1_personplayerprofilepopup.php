<?php # personDM2in.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inperson_id = $_REQUEST['person_id'];


Check_Data("person",$inperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    XH3($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
    
    $from = $GLOBALS{'domainfilepath'}."/personphotos/".$GLOBALS{'person_photo'};
    if (($GLOBALS{'person_photo'} != "")&&(file_exists($from))) {
        $imagefilebits = explode('.', $GLOBALS{'person_photo'});
        $imagetype = $imagefilebits[1];
        $phototempname = "temp_".$GLOBALS{'currentYYYYMMDD'}.$GLOBALS{'acthh'}.$GLOBALS{'actmm'}.$GLOBALS{'actss'}.".".$imagetype;
        $to = $GLOBALS{'domainwwwpath'}."/domain_temp/".$phototempname;
        copy($from, $to);
        $photofullsitename = $GLOBALS{'domainwwwurl'}."/domain_temp/".$phototempname;
        XIMGWIDTH($photofullsitename,"100");
    } else {
        $photofullsitename = $GLOBALS{'site_asseturl'}."/NoPhoto.png";
        XIMGWIDTH($photofullsitename,"100");
    }    
    XBR();XH4("Preferred Playing Position");
    if ($GLOBALS{'person_position'} != "") { XPTXT($GLOBALS{'person_position'}); } else { XPTXT("Not Provided"); }
    XBR();XH4("Playing Experience");
    if ($GLOBALS{'person_experience'} != "") { XPTXT($GLOBALS{'person_experience'}); } else { XPTXT("Not Provided"); }
    XBR();XH4("Shirt Number");
    if ($GLOBALS{'person_shirtnumber'} != "") { XPTXT($GLOBALS{'person_shirtnumber'}); } else { XPTXT("Not Allocated"); }
    XBR();XH4("Contact Details");
    if (Person_Visibility_Test("view")) {
        $l0 = "0"; $l1 = "0"; $l2 = "0"; $l3 = "0";
        if ($GLOBALS{'person_exdirectory'} == "0") { $l0 = "1"; $l1 = "0"; $l2 = "0"; $l3 = "0"; }
        if ($GLOBALS{'person_exdirectory'} == "1") { $l0 = "0"; $l1 = "1"; $l2 = "0"; $l3 = "0"; }
        if ($GLOBALS{'person_exdirectory'} == "2") { $l0 = "0"; $l1 = "1"; $l2 = "1"; $l3 = "0"; }
        if ($GLOBALS{'person_exdirectory'} == "3") { $l0 = "0"; $l1 = "1"; $l2 = "1"; $l3 = "1"; }
        
        if (strlen(strstr($GLOBALS{'person_authority'},'RM'))>0) { $l1 = "1"; $l2 = "1"; $l3 = "0"; }
        if (strlen(strstr($GLOBALS{'person_authority'},'MM'))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }
        if (strlen(strstr($GLOBALS{'person_authority'},'DM'))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }
        
        XTABLEINVISIBLE();
        if ($l0 == "1") { XTR();XTDTXTWIDTH("Note","30%");XTDTXTWIDTH("Person details are ex-directory","70%");X_TR(); }
        if ($l1 == "1") {
            if ($GLOBALS{'person_email1'} != "") {
                XTR();XTDTXT("Email");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_email1'});X_TR(); 
            }
            if ($GLOBALS{'person_email3'} != "") {
                XTR();XTDTXT("Parental Email");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_email3'});X_TR(); 
            }
        }
        if ($l2 == "1") {
            if (($GLOBALS{'person_hometel'} != "")||($GLOBALS{'person_hometel'} != " ")) {
                XTR();XTDTXT("Home");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_hometel'});X_TR(); 
            }
            if (($GLOBALS{'person_worktel'} != "")||($GLOBALS{'person_worktel'} != " ")) {
                XTR();XTDTXT("Work");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_worktel'});X_TR(); 
            }
            if (($GLOBALS{'person_mobiletel'}||($GLOBALS{'person_mobiletel'} != "")) != " ") {
                XTR();XTDTXT("Mobile");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_mobiletel'});X_TR(); 
            }
        }
        X_TABLE();
    } else {
        print "Note:- You are not able to view information for this person.<BR>";
    }
} else {
    print"<P>Personal Id $inperson_id not found";
}

PopUpFooter();

?>
