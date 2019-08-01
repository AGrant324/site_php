<<<<<<< HEAD
<?php # persongroupregisterout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
Get_Person_Authority();

$inperson_id = $_REQUEST['RegisternPersonId'];




Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();

XH3("Search Results");
Check_Data("person",$inperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    XH5($GLOBALS{'person_title'}." ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_midinits'}." ".$GLOBALS{'person_sname'}." ....... PersonId = ".$inperson_id);
    if (Person_Visibility_Test("view")) {
        $l0 = "0"; $l1 = "0"; $l2 = "0"; $l3 = "0";
        if ($GLOBALS{'person_exdirectory'} == "0") { $l0 = "1"; $l1 = "0"; $l2 = "0"; $l3 = "0"; }
        if ($GLOBALS{'person_exdirectory'} == "1") { $l0 = "0"; $l1 = "1"; $l2 = "0"; $l3 = "0"; }
        if ($GLOBALS{'person_exdirectory'} == "2") { $l0 = "0"; $l1 = "1"; $l2 = "1"; $l3 = "0"; }
        if ($GLOBALS{'person_exdirectory'} == "3") { $l0 = "0"; $l1 = "1"; $l2 = "1"; $l3 = "1"; }
        
        if (strlen(strstr($GLOBALS{'person_authority'},'RM'))>0) { $l1 = "1"; $l2 = "1"; $l3 = "0"; }
        if (strlen(strstr($GLOBALS{'person_authority'},'MM'))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }
        if (strlen(strstr($GLOBALS{'person_authority'},'DM'))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }
        
        XTABLE();
        if ($l0 == "1") { XTR();XTDTXTWIDTH("Note","30%");XTDTXTWIDTH("Person details are ex-directory","70%");X_TR(); }
        if ($l1 == "1") {
            $from = $GLOBALS{'domainfilepath'}."/personphotos/".$GLOBALS{'person_photo'};
            if (($GLOBALS{'person_photo'} != "")&&(file_exists($from))) {
                $imagefilebits = explode('.', $GLOBALS{'person_photo'});
                $imagetype = $imagefilebits[1];
                $phototempname = "temp_".$GLOBALS{'currentYYYYMMDD'}.$GLOBALS{'acthh'}.$GLOBALS{'actmm'}.$GLOBALS{'actss'}.".".$imagetype;
                $to = $GLOBALS{'domainwwwpath'}."/domain_temp/".$phototempname;
                copy($from, $to);
                $photofullsitename = $GLOBALS{'domainwwwurl'}."/domain_temp/".$phototempname;
                XTR();XTDTXT("Photo");XTD();XIMGWIDTH($photofullsitename,"100");X_TD();X_TR();
            } else {
                $photofullsitename = $GLOBALS{'site_asseturl'}."/NoPhoto.png";
                XTR();XTDTXT("Photo");XTD();XIMGWIDTH($photofullsitename,"100");X_TD();X_TR();
            }
            if ($GLOBALS{'person_email1'} != "") {XTR();XTDTXT("Email");XTDTXT($GLOBALS{'person_email1'});X_TR(); }
            if ($GLOBALS{'person_email2'} != "") {XTR();XTDTXT("Secondary Email");XTDTXT($GLOBALS{'person_email2'});X_TR(); }
            if ($GLOBALS{'person_email3'} != "") {XTR();XTDTXT("Parental Email");XTDTXT($GLOBALS{'person_email3'});X_TR(); }
            if ($GLOBALS{'person_twitterusername'} != "") {XTR();XTDTXT("Twitter");XTDTXT($GLOBALS{'person_twitterusername'});X_TR(); }
        }
        if ($l2 == "1") {
            if ($GLOBALS{'person_hometel'} != "") {XTR();XTDTXT("Home Telephone");XTDTXT($GLOBALS{'person_hometel'});X_TR(); }
            if ($GLOBALS{'person_worktel'} != "") {XTR();XTDTXT("Work Telephone");XTDTXT($GLOBALS{'person_worktel'});X_TR(); }
            if ($GLOBALS{'person_mobiletel'} != "") {XTR();XTDTXT("Mobile Telephone");XTDTXT($GLOBALS{'person_mobiletel'});X_TR(); }
            if ($GLOBALS{'person_faxtel'} != "") {XTR();XTDTXT("Fax");XTDTXT($GLOBALS{'person_faxtel'});X_TR(); }
        }
        if ($l3 == "1") {
            if ($GLOBALS{'person_addr1'}.$GLOBALS{'person_addr2'}.$GLOBALS{'person_addr3'}.$GLOBALS{'person_addr4'}.$GLOBALS{'person_postcode'} != "") {
                XTR();XTDTXT("Address");
                XTDTXT($GLOBALS{'person_addr1'}.'<br>'.$GLOBALS{'person_addr2'}.'<br>'.$GLOBALS{'person_addr3'}
                .'<br>'.$GLOBALS{'person_addr4'}.'<br>'.$GLOBALS{'person_postcode'});
                X_TR();
            }
        }
        X_TABLE();
    } else {
        print "Note:- You are not able to view information for this person.<BR>";
    }
} else {
    print"<P>Personal Id $inperson_id not found";
}






XBR();XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();
=======
<?php # persongroupregisterout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
Get_Person_Authority();

$inperson_id = $_REQUEST['RegisternPersonId'];




Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();

XH3("Search Results");
Check_Data("person",$inperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    XH5($GLOBALS{'person_title'}." ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_midinits'}." ".$GLOBALS{'person_sname'}." ....... PersonId = ".$inperson_id);
    if (Person_Visibility_Test("view")) {
        $l0 = "0"; $l1 = "0"; $l2 = "0"; $l3 = "0";
        if ($GLOBALS{'person_exdirectory'} == "0") { $l0 = "1"; $l1 = "0"; $l2 = "0"; $l3 = "0"; }
        if ($GLOBALS{'person_exdirectory'} == "1") { $l0 = "0"; $l1 = "1"; $l2 = "0"; $l3 = "0"; }
        if ($GLOBALS{'person_exdirectory'} == "2") { $l0 = "0"; $l1 = "1"; $l2 = "1"; $l3 = "0"; }
        if ($GLOBALS{'person_exdirectory'} == "3") { $l0 = "0"; $l1 = "1"; $l2 = "1"; $l3 = "1"; }
        
        if (strlen(strstr($GLOBALS{'person_authority'},'RM'))>0) { $l1 = "1"; $l2 = "1"; $l3 = "0"; }
        if (strlen(strstr($GLOBALS{'person_authority'},'MM'))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }
        if (strlen(strstr($GLOBALS{'person_authority'},'DM'))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }
        
        XTABLE();
        if ($l0 == "1") { XTR();XTDTXTWIDTH("Note","30%");XTDTXTWIDTH("Person details are ex-directory","70%");X_TR(); }
        if ($l1 == "1") {
            $from = $GLOBALS{'domainfilepath'}."/personphotos/".$GLOBALS{'person_photo'};
            if (($GLOBALS{'person_photo'} != "")&&(file_exists($from))) {
                $imagefilebits = explode('.', $GLOBALS{'person_photo'});
                $imagetype = $imagefilebits[1];
                $phototempname = "temp_".$GLOBALS{'currentYYYYMMDD'}.$GLOBALS{'acthh'}.$GLOBALS{'actmm'}.$GLOBALS{'actss'}.".".$imagetype;
                $to = $GLOBALS{'domainwwwpath'}."/domain_temp/".$phototempname;
                copy($from, $to);
                $photofullsitename = $GLOBALS{'domainwwwurl'}."/domain_temp/".$phototempname;
                XTR();XTDTXT("Photo");XTD();XIMGWIDTH($photofullsitename,"100");X_TD();X_TR();
            } else {
                $photofullsitename = $GLOBALS{'site_asseturl'}."/NoPhoto.png";
                XTR();XTDTXT("Photo");XTD();XIMGWIDTH($photofullsitename,"100");X_TD();X_TR();
            }
            if ($GLOBALS{'person_email1'} != "") {XTR();XTDTXT("Email");XTDTXT($GLOBALS{'person_email1'});X_TR(); }
            if ($GLOBALS{'person_email2'} != "") {XTR();XTDTXT("Secondary Email");XTDTXT($GLOBALS{'person_email2'});X_TR(); }
            if ($GLOBALS{'person_email3'} != "") {XTR();XTDTXT("Parental Email");XTDTXT($GLOBALS{'person_email3'});X_TR(); }
            if ($GLOBALS{'person_twitterusername'} != "") {XTR();XTDTXT("Twitter");XTDTXT($GLOBALS{'person_twitterusername'});X_TR(); }
        }
        if ($l2 == "1") {
            if ($GLOBALS{'person_hometel'} != "") {XTR();XTDTXT("Home Telephone");XTDTXT($GLOBALS{'person_hometel'});X_TR(); }
            if ($GLOBALS{'person_worktel'} != "") {XTR();XTDTXT("Work Telephone");XTDTXT($GLOBALS{'person_worktel'});X_TR(); }
            if ($GLOBALS{'person_mobiletel'} != "") {XTR();XTDTXT("Mobile Telephone");XTDTXT($GLOBALS{'person_mobiletel'});X_TR(); }
            if ($GLOBALS{'person_faxtel'} != "") {XTR();XTDTXT("Fax");XTDTXT($GLOBALS{'person_faxtel'});X_TR(); }
        }
        if ($l3 == "1") {
            if ($GLOBALS{'person_addr1'}.$GLOBALS{'person_addr2'}.$GLOBALS{'person_addr3'}.$GLOBALS{'person_addr4'}.$GLOBALS{'person_postcode'} != "") {
                XTR();XTDTXT("Address");
                XTDTXT($GLOBALS{'person_addr1'}.'<br>'.$GLOBALS{'person_addr2'}.'<br>'.$GLOBALS{'person_addr3'}
                .'<br>'.$GLOBALS{'person_addr4'}.'<br>'.$GLOBALS{'person_postcode'});
                X_TR();
            }
        }
        X_TABLE();
    } else {
        print "Note:- You are not able to view information for this person.<BR>";
    }
} else {
    print"<P>Personal Id $inperson_id not found";
}






XBR();XINBUTTONCLOSEWINDOW("Cancel");
PopUpFooter();
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
