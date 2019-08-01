<?php # siteroutines.php

function Site_ACCOUNT_Output() {
$parm0 = "Account Management|account[site=all]||account_id|account_id|30|No";
$parm1 = "";
$parm1 = $parm1."account_id|Yes|Account Name|150|Yes|Account Name|KeyText,25,50^";
$parm1 = $parm1."account_longname|Yes|Long Name|150|Yes|Long Name|InputText,40,70^";
$parm1 = $parm1."account_shortname|Yes|Short Name|150|Yes|Short Name|InputText,12,12^";
$parm1 = $parm1."account_modeid|Yes|Mode|50|Yes|Mode|InputText,1,1^";
$parm1 = $parm1."account_webaddress|No|URL|150|Yes|URL|InputText,30,70^";
$parm1 = $parm1."account_webstyle|No|Web Style|150|Yes|Web Style|InputText,20,50^";
$parm1 = $parm1."account_codeversion|No|Code Vwersion|150|Yes|Code Vwersion|InputText,5,5^";
$parm1 = $parm1."account_contacttitle|No|Title|150|Yes|Title|InputText,3,10^";
$parm1 = $parm1."account_contactfname|No|First Name|150|Yes|First Name|InputText,25,40^";
$parm1 = $parm1."account_contactinits|No|Inits|150|Yes|Inits|InputText,5,5^";
$parm1 = $parm1."account_contactsname|No|Last Name|150|Yes|Last Name|InputText,25,40^";
$parm1 = $parm1."account_contactrole|No|Role|150|Yes|Role|InputText,20,50^";
$parm1 = $parm1."account_contactaddr1|No|House & Street|150|Yes|House & Street|InputText,30,60^";
$parm1 = $parm1."account_contactaddr2|No|Town / City|150|Yes|Town / City|InputText,30,60^";
$parm1 = $parm1."account_contactaddr3|No|State / County|150|Yes|State / County|InputText,30,60^";
$parm1 = $parm1."account_contactaddr4|No|Country|150|Yes|Country|InputText,30,60^";
$parm1 = $parm1."account_contactpostcode|No|Post Code|150|Yes|Post Code|InputText,20,50^";
$parm1 = $parm1."account_contacthometel|No|Home Tel|150|Yes|Home Tel|InputText,12,12^";
$parm1 = $parm1."account_contactworktel|No|Work Tel|150|Yes|Work Tel|InputText,12,12^";
$parm1 = $parm1."account_contactmobiletel|No|Mobile Tel|150|Yes|Mobile Tel|InputText,12,12^";
$parm1 = $parm1."account_contactfaxtel|No|Fax Tel|150|Yes|Fax Tel|InputText,12,12^";
$parm1 = $parm1."account_contactemail|No|eMail|150|Yes|eMail|InputText,20,50^";
$parm1 = $parm1."account_setupprice|No|Setup Price|150|Yes|Setup Price|InputText,20,50^";
$parm1 = $parm1."account_contractstart|No|Contract Start|150|Yes|Contract Start|InputDate^";
$parm1 = $parm1."account_contractend|No|Contract End|150|Yes|Contract End|InputDate^";
$parm1 = $parm1."account_mthlyprice|No|Mthly Price|150|Yes|Mthly Price|InputText,10,20^";
$parm1 = $parm1."account_fullysetup|No|Fully Set Up|150|Yes|Fully Set Up|InputText,10,20^";
$parm1 = $parm1."account_packageid|No|Package Id|150|Yes|Package Id|InputText,10,20^";
$parm1 = $parm1."account_packageextras|No|Package Extras|150|Yes|Package Extras|InputText,10,20^";
$parm1 = $parm1."account_emailpool|No|eMail pool|150|Yes|eMail pool|InputText,10,20^";
$parm1 = $parm1."account_smspool|No|SMS pool|150|Yes|SMS pool|InputText,10,20^";
$parm1 = $parm1."generic_programbutton1|Yes|QuickStart|70|No|QuickStart|ProgramButton,siteaccountquickstartout.php,account_id,account_id,samewindow,,^";
$parm1 = $parm1."generic_programbutton2|Yes|Login|70|No|Login|ProgramButton,sitedomainloginin.php,account_id,account_id,newpopup,800,600^";
$parm1 = $parm1."generic_updatebutton|Yes|Settings|70|No|Settings|UpdateButton^";
$parm1 = $parm1."generic_programbutton3|Yes|Delete|70|No|Delete|ProgramButton,siteaccountdeleteout.php,account_id,account_id,newpopup,800,600";
GenericHandler_Output ($parm0,$parm1);
}
# account_id
function Site_Account_Delete_Output($parm0) {
XH3("Account deletion");
XFORM("siteaccountdeletein.php","accountdelete");
XINSTDHID();
XINHID("DeleteAccountId",$parm0);
XPTXT('You have asked for "'.$parm0.'" to be deleted. Please confirm.');XBR();
XINSUBMIT("Confirm deletion");
X_FORM();
}


function Account_Registration_Output () {
    XH2("Setup");
    XPTXT("Welcome to the setup facility.");
    XPTXT("This will complete the setup of your website and account.");
    if ($GLOBALS{'site_registrationmethod'} == "Key") {
        Account_RegistrationByKey1_Output();        
    } else {   
        Account_RegistrationByNoKey_Output();
    }
}

function Account_RegistrationByKey1_Output () {
    XPTXT("Please provide us with the registration key you received.");
    XFORM("accountregistrationbykey1out.php","accountsetup");
    XINSTDHID(); 
    XH3("Registration Key");
    XINTEXTAREA("account_registrationkey", "", "5", "80"  );    
    XBR();
    XINSUBMIT("Submit");
    X_FORM();
}

function Account_RegistrationByKey2_Output ($package_id) {
    XPTXT("Please provide us with some information to help set up your website and account.");
    XFORM("accountregistrationcompletion.php","accountsetup");
    XINSTDHID();
    XINHID("package_id",$package_id);
    XH3("Organisation and Website");
    XTABLE();
    XTR();XTDTXT("Full Organisation Name<br>e.g. Easthampton Football Club");XTDINTXT("account_longname","","50","80");X_TR();
    XTR();XTDTXT("Organisation Shortcode<br>e.g. EasthamptonFC");XTDINTXT("account_shortname","","25","50");X_TR();
    X_TABLE();
    
    XH3("Contact Details");
    XTABLE();
    XTR();XTDTXT("First Name");XTDINTXT("account_contactfname","","25","50");X_TR();
    XTR();XTDTXT("Surname");XTDINTXT("account_contactsname","","25","50");X_TR();
    XTR();XTDTXT("Role in Organisation");XTDINTXT("account_contactrole","","25","50");X_TR();
    XTR();XTDTXT("House and Street");XTDINTXT("account_contactaddr1","","25","50");X_TR();
    XTR();XTDTXT("Town");XTDINTXT("account_contactaddr2","","25","50");X_TR();
    XTR();XTDTXT("State/County");XTDINTXT("account_contactaddr3","","25","50");X_TR();
    XTR();XTDTXT("Country");XTDINTXT("account_contactaddr4","","25","50");X_TR();
    XTR();XTDTXT("Post Code/ZIP");XTDINTXT("account_contactpostcode","","25","50");X_TR();
    XTR();XTDTXT("Mobile Number");XTDINTXT("account_contactmobiletel","","25","50");X_TR();
    XTR();XTDTXT("Email");XTDINTXT("account_contactemail","","25","50");X_TR();
    X_TABLE();
    
    XBR();
    XINSUBMIT("Submit");
    X_FORM();
}


function Account_RegistrationByNoKey_Output () {
    XPTXT("Please provide us with some information to help set up your website and account.");
    XFORM("accountregistrationcompletion.php","accountsetup");
    XINSTDHID();    
    
    XH3("Organisation and Website");
    XTABLE();
    XTR();XTDTXT("Full Organisation Name<br>e.g. Easthampton Football Club");XTDINTXT("account_longname","","50","80");X_TR();
    XTR();XTDTXT("Organisation Shortcode<br>e.g. EasthamptonFC");XTDINTXT("account_shortname","","25","50");X_TR();
    X_TABLE();

    XH3("Contact Details");
    XTABLE();
    XTR();XTDTXT("First Name");XTDINTXT("account_contactfname","","25","50");X_TR();
    XTR();XTDTXT("Inits");XTDINTXT("account_contactinits","","25","50");X_TR();
    XTR();XTDTXT("Surname");XTDINTXT("account_contactsname","","25","50");X_TR();
    XTR();XTDTXT("Role in Organisation");XTDINTXT("account_contactrole","","25","50");X_TR();
    XTR();XTDTXT("House and Street");XTDINTXT("account_contactaddr1","","25","50");X_TR();
    XTR();XTDTXT("Town");XTDINTXT("account_contactaddr2","","25","50");X_TR();
    XTR();XTDTXT("State/County");XTDINTXT("account_contactaddr3","","25","50");X_TR();
    XTR();XTDTXT("Country");XTDINTXT("account_contactaddr4","","25","50");X_TR();
    XTR();XTDTXT("Post Code/ZIP");XTDINTXT("account_contactpostcode","","25","50");X_TR();
    XTR();XTDTXT("Mobile Number");XTDINTXT("account_contactmobiletel","","25","50");X_TR();
    XTR();XTDTXT("Email");XTDINTXT("account_contactemail","","25","50");X_TR();
    XTR();XTDTXT("&nbsp;");XTDINSUBMIT("Setup my account");X_TR();
    X_TABLE();
    
    XBR();
    XINSUBMIT("Submit");	
    X_FORM();
}


function Account_Login_Output () {
XH3("Account Login");
# # $helplink = "Setup/Setup_Login_Select_Screen_Outp/setup_login_select_screen_outp.html"; Help_Link;
XPTXT("Please login with the email address used to establish your account.");
XFORM("accountloginin.php","accountlogin");
XTABLE();
XINSTDHID();
XTR();XTDTXT("Email Address");XTDINTXT("AccountIdent","","25","50");X_TR();
XTR();XTDTXT("Password");XTDINPSW("AccountPsw","","12","8");X_TR();
XTR();XTDTXT("&nbsp;");XTDINSUBMIT("Login");X_TR();
X_TABLE();
X_FORM();
}

function Account_Login_Select_Output () {
XH3("Account Login");	
XH5("Please choose from the following options");		
	
AccountPHP_Link_Output("Setup my domain","DOMAINSETUP");   	
}

function Domain_Setup_Output ($taccount_id) {   
Get_Data('account_'.$taccount_id);
XH3("Website Setup = ".$taccount_id);
XPTXT("Now we can set up your website.");
XFORM("domainsetupin.php","domainsetup");
XTABLE();
XINSTDHID();
XINHID("account_id",$taccount_id);
XINHID("domain_longname",$GLOBALS{"account_longname"});
XINHID("domain_shortname",$GLOBALS{"account_shortname"});
XTR();XTDTXT("Website Long Name");XTDTXT($GLOBALS{"account_longname"});X_TR();
XTR();XTDTXT("Website Short Name");XTDTXT($GLOBALS{"account_shortname"});X_TR();

$themeidlist = ""; $sepid = "";
$domaina = Get_Array("domain_");
foreach ($domaina as $domainid) {
    if ( strlen(strstr($domainid,"Theme"))>0 ) {
        $themeidlist = $themeidlist.$sepid.$domainid; $sepid = ",";
    }
}
$xhash = List2Hash($themeidlist);
XTR();XTDTXT("Theme");XTDINSELECTHASH ($xhash,"domain_themeid","");X_TR();

$sportidlist = ""; $sportnamelist = "";
$sepid = ""; $sepname = "";
$sporta = Get_Array("sport_");
foreach ($sporta as $sportid) {
    Get_Data("sport_".$sportid);
    $sportidlist = $sportidlist.$sepid.$sportid; $sepid = ",";
    $sportnamelist = $sportnamelist.$sepname.$GLOBALS{"sport_name"}; $sepname = ",";
}
$xhash = Lists2Hash($sportidlist, $sportnamelist);
XTR();XTDTXT("Sport");XTDINSELECTHASH ($xhash,"domain_sportid","");X_TR();
XTR();XTDTXT("");XTDINSUBMIT("Create Website");X_TR();
X_TABLE();
X_FORM();
}


function AccountPHP_Link_Output ($parm0, $parm1) {
XTXT("&nbsp;-&nbsp;");
$link = YPGMLINK("accountloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId",$parm1);
XLINKTXT($link,$parm0);XBR();
}

function SiteMasterDataXCopy ($parm0,$parm1) {
# datatype non-overridenfieldname
XBR();XTXT("Updating reference data - ".$parm0);
$thisdomain =  $GLOBALS{'LOGIN_domain_id'};
if ($GLOBALS{$parm0."^KEYS"} == 2) {
 $GLOBALS{'LOGIN_domain_id'} = $GLOBALS{'LOGIN_service_id'};
 $sitemasterdataa = Get_Array($parm0);
 foreach ($sitemasterdataa as $sitemasterdatak) {
  $retainoldfield = "0"; $retainoldvalue = "";
  $GLOBALS{'LOGIN_domain_id'} = $thisdomain;    
  Check_Data($parm0,$sitemasterdatak);
  if (($GLOBALS{'IOWARNING'} == "0")&&($parm1 != "")) { $retainoldfield = "1"; $retainoldvalue = $GLOBALS{$parm0."_".$parm1}; } 
  $GLOBALS{'LOGIN_domain_id'} = $GLOBALS{'LOGIN_service_id'};
  Get_Data($parm0,$sitemasterdatak);
  $GLOBALS{'LOGIN_domain_id'} = $thisdomain;
  if ($retainoldfield == "1") { $GLOBALS{$parm0."_".$parm1} = $retainoldvalue; }  	
  Write_Data($parm0,$sitemasterdatak);
  # XBR();XTXT("SINGLE KEY - ".$sitemasterdatak." / ".$retainoldfield."_".$retainoldvalue);  
 }
}
if ($GLOBALS{$parm0."^KEYS"} == 3) {
 $GLOBALS{'LOGIN_domain_id'} = $GLOBALS{'LOGIN_service_id'};
 $sitemasterdataa = Get_2Key_Array($parm0);
 foreach ($sitemasterdataa as $sitemasterdatak) {	
  $kbits = explode("|",$sitemasterdatak);
  $retainoldfield = "0"; $retainoldvalue = "";
  $GLOBALS{'LOGIN_domain_id'} = $thisdomain;
  Check_Data($parm0,$kbits[0],$kbits[1]);
  if (($GLOBALS{'IOWARNING'} == "0")&&($parm1 != "")) {	$retainoldfield = "1"; $retainoldvalue = $GLOBALS{$parm0."_".$parm1}; }
  $GLOBALS{'LOGIN_domain_id'} = $GLOBALS{'LOGIN_service_id'};
  Get_Data($parm0,$kbits[0],$kbits[1]);
  $GLOBALS{'LOGIN_domain_id'} = $thisdomain;
  if ($retainoldfield == "1") {	$GLOBALS{$parm0."_".$parm1} = $retainoldvalue;	}
  Write_Data($parm0,$kbits[0],$kbits[1]);
  # XBR();XTXT("DUAL KEY - ".$kbits[0]."-".$kbits[1]." / ".$retainoldfield."_".$retainoldvalue);
 }
}
$GLOBALS{'LOGIN_domain_id'} = $thisdomain;
}

function  DeleteAccountData ($deleteaccount_id) {
    if ($GLOBALS{'LOGIN_mode_id'} == "0") { // just to be sure
        # account_id - same as domain_id
        XH2("Delete Account_Data - ".$deleteaccount_id);
        $tfields = array();
        $tablearray = array();
        $q = 'SHOW TABLES';
        $r = mysqli_query($GLOBALS{'IOSQL'},$q);
        if (mysqli_num_rows($r) > 0) {
            while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { array_push($tablearray, $row[0]); }
        }
        foreach ($tablearray as $table) {
            $colarray = array();
            $keycount = 0;
            $q = 'SHOW COLUMNS FROM '.$table;
            $r = mysqli_query($GLOBALS{'IOSQL'},$q);
            if (mysqli_num_rows($r) > 0) {
                while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                    array_push($colarray, $row[0]);
                    if ($row[3] == "PRI") { $keycount++;  }
                }
            }
            $accountrelatedtable = "0";
            foreach ($colarray as $colarrayelement) {
                if ($colarrayelement == $table."_"."domainid") { $accountrelatedtable = "1"; }
            }
            if ($accountrelatedtable == "1") {
                XPTXTCOLOR($table,"silver");
                
                if ($keycount == 1) {
                    Check_Data($table."_".$deleteaccount_id);
                    if ($GLOBALS{'IOWARNING'} == "0") {
                        Delete_Domain_Data1($table."_".$deleteaccount_id);
                    }
                }
                if ($keycount > 1) {
                    $recordarray = Get_NKey_Array($table."_".$deleteaccount_id);
                    foreach ($recordarray as $recordarrayelement) {
                        // XPTXTCOLOR($recordarrayelement." ".$keycount,"green");
                        $kbitsa = explode("|",$recordarrayelement."|");
                        if ($keycount == 2) {
                            Delete_Domain_DataN($table,$deleteaccount_id,$kbitsa[0]);                           
                        }
                        if ($keycount == 3) {
                            Delete_Domain_DataN($table,$deleteaccount_id,$kbitsa[0],$kbitsa[1]);                              
                        }
                        if ($keycount == 4) {
                            Delete_Domain_DataN($table,$deleteaccount_id,$kbitsa[0],$kbitsa[1],$kbitsa[2]);                             
                        }
                    }
                }
            }
        }
    }
    XPTXTCOLOR("account","silver");
    Check_Data("account_".$deleteaccount_id);
    if ($GLOBALS{'IOWARNING'} == "0") {
        Delete_Domain_Data1("account_".$deleteaccount_id);
    }   
    Delete_Directory_AllLevels($GLOBALS{'site_wwwpath'}."/".$deleteaccount_id,"ShowTrace");
    Delete_Directory_AllLevels($GLOBALS{'site_filepath'}."/".$deleteaccount_id,"ShowTrace");
}


# datatype keys
function Delete_Domain_Data1 () {
    // table_domain
    $parms = func_get_arg(0);
    if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}
    $kbits = explode('_', $parms[0]); 
    $rootkey = $kbits[1]; 
    $tablename = $kbits[0];
    $tstring = $GLOBALS{$tablename."^FIELDS"}; $tfields = explode('|', $tstring);
    $q = "DELETE FROM ".$tablename." WHERE ".$tfields[0]."='".$rootkey."'";
    XTXT($q);XBR();XBR();
    $GLOBALS{'IOERRORcode'} = "IO008"; $GLOBALS{'IOERRORmessage'} = "$q";
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    # $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
    if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) { } else { SilentWarningRoutine(); }
}


# datatype keys
function Delete_Domain_DataN () {
    // table,domain,key1,key2,key3
    $parms = func_get_arg(0);
    if (!is_array($parms)){$parms=array();for($i=0;$i<func_num_args();$i++){$ts=func_get_arg($i);array_push($parms,$ts);}}
    $parmsmax = sizeof($parms)-1;
    $tstring = $GLOBALS{$parms[0]."^FIELDS"}; 
    $tfields = explode('|', $tstring);
    $qk1 = "DELETE FROM ".$parms[0]." WHERE ".$tfields[0]."='".$parms[1]."'";
    $qk2 = ""; $qk3 = ""; $qk4 = "";
    if ($parmsmax > 1) {$qk2 = " AND ".$tfields[1]."='".$parms[2]."'";}
    if ($parmsmax > 2) {$qk3 = " AND ".$tfields[2]."='".$parms[3]."'";}
    if ($parmsmax > 3) {$qk4 = " AND ".$tfields[3]."='".$parms[4]."'";}
    $q = $qk1.$qk2.$qk3.$qk4;
    XTXT($q);XBR();XBR();
    $GLOBALS{'IOERRORcode'} = "IO008"; $GLOBALS{'IOERRORmessage'} = "$q";
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    # $tnum = mysqli_affected_rows($GLOBALS{'IOSQL'}); print "affected rows - $tnum<br>\n";
    if (mysqli_affected_rows($GLOBALS{'IOSQL'}) == 1) { } else { SilentWarningRoutine(); }
}

function Site_ACCOUNTQUICKSTART_CSSJS () {
    $GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,corsiteupdate,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,tinymcesliminit,tinymceslimreturnfromupload,globalroutines,ioroutines,siteaccountquickstartupdate,slimjquerymin,slimimagepopup,bootstrapdatepicker,areyousure,jqueryconfirm";
}

function Site_ACCOUNTQUICKSTART_Output ($account_id, $currenttab) {
    
    XH3($account_id." Quickstart");
    
    if ( $account_id != "" ) {
        Get_Data("account_".$account_id);
        Check_Data("quickstart",$account_id); 
        if ($GLOBALS{'IOWARNING'} == "1") {
            Initialise_Data("quickstart");
            $GLOBALS{'quickstart_accountid'} = $account_id;
            $GLOBALS{'quickstart_longname'} = $GLOBALS{'account_longname'};
            $GLOBALS{'quickstart_shortname'} = $GLOBALS{'account_shortname'};
            $GLOBALS{'quickstart_sportid'} = $GLOBALS{'account_sportid'};
            $GLOBALS{'quickstart_contactfname'} = $GLOBALS{'account_contactfname'};
            $GLOBALS{'quickstart_contactsname'} = $GLOBALS{'account_contactsname'};
            $GLOBALS{'quickstart_contactemail'} = $GLOBALS{'account_contactemail'};
            Write_Data("quickstart",$account_id);
            XPTXTCOLOR("New Quickstart Record Created for ".$account_id,"green");
        } else {
            XPTXTCOLOR("Existing Quickstart Record Found for for ".$account_id,"green");
        }
        XFORM("domainquickstartsetupin.php","domainquickstartsetupin");
        XINSTDHID();
        XINHID("account_id",$GLOBALS{'quickstart_accountid'});
        BROW();BCOLTXT("","9");
        BCOL("3");BINSUBMITIDSPECIAL ("createdomainbutton","success","I've Finished - Now Create this Website");B_COL();
        B_ROW();
        X_FORM();
        $GLOBALS{'CROPPARMS'} = Array();
        
        if ( $currenttab == "" ) { $currenttab = "CLUB"; }
        
        BTABHEADERCONTAINER();
        if ($currenttab == "CLUB") {BTABHEADERITEMACTIVE("CLUB","Club Introduction");} else {BTABHEADERITEM("CLUB","Club Introduction");}
        if ($currenttab == "SECTTEAMS") {BTABHEADERITEMACTIVE("SECTTEAMS","Sections and Teams");} else {BTABHEADERITEM("SECTTEAMS","Sections and Teams");}   
        if ($currenttab == "IMAGES") {BTABHEADERITEMACTIVE("IMAGESB","Images");} else {BTABHEADERITEM("IMAGES","Images");}
        if ($currenttab == "INTRO") {BTABHEADERITEMACTIVE("INTRO","Introductions");} else {BTABHEADERITEM("INTRO","Introductions");}
        if ($currenttab == "ORG") {BTABHEADERITEMACTIVE("ORG","Organisation");} else {BTABHEADERITEM("ORG","Organisation");}
        B_TABHEADERCONTAINER();
        
        BTABCONTENTCONTAINER();
        if ($currenttab == "CLUB") {BTABCONTENTITEMACTIVE("CLUB");} else {BTABCONTENTITEM("CLUB");}
        CLUBContentOutput();
        B_TABCONTENTITEM();	
        if ($currenttab == "SECTTEAMS") {BTABCONTENTITEMACTIVE("SECTTEAMS");} else {BTABCONTENTITEM("SECTTEAMS");}
        SECTTEAMSContentOutput();
        B_TABCONTENTITEM();	
        if ($currenttab == "IMAGES") {BTABCONTENTITEMACTIVE("IMAGES");} else {BTABCONTENTITEM("IMAGES");}
        IMAGESContentOutput();
        B_TABCONTENTITEM();	
        if ($currenttab == "INTRO") {BTABCONTENTITEMACTIVE("INTRO");} else {BTABCONTENTITEM("INTRO");}
        INTROContentOutput();
        B_TABCONTENTITEM();	
        if ($currenttab == "ORG") {BTABCONTENTITEMACTIVE("ORG");} else {BTABCONTENTITEM("ORG");}
        ORGContentOutput();
        B_TABCONTENTITEM();	
        B_TABCONTENTCONTAINER(); 
        
        
        XTXTID("TRACETEXT","");
        foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
            $cbits = explode('|',$cropelement);
            SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
        }
    } else {
        XPTXTCOLOR("Error: Null Account Id","red");
    }

}
    
function CLUBContentOutput() {
    XBR();
    XH3("Club Introduction");
    XHRCLASS('underline');
    
    XFORM("siteaccountquickstartupdatein.php","siteaccountquickstartupdate");
    XINSTDHID();
    XINHID("quickstart_accountid",$GLOBALS{'quickstart_accountid'});
    XINHID("CurrentTab","CLUB");
    XHR();
    
    XH4("Reference Details");
    BROW();
    BCOLTXT("Long Name","1");
    BCOLINTXTID('quickstart_longname','quickstart_longname',$GLOBALS{'quickstart_longname'},"3");
    BCOLTXT("Short Name","1");
    BCOLINTXTID('quickstart_shortname','quickstart_shortname',$GLOBALS{'quickstart_shortname'},"3");
    B_ROW();
    
    $themeidlist = ""; $sepid = "";
    $domaina = Get_Array("domain_");
    foreach ($domaina as $domainid) {
        if ( strlen(strstr($domainid,"Theme"))>0 ) {
            $themeidlist = $themeidlist.$sepid.$domainid; $sepid = ",";
        }
    }
    $xhash = List2Hash($themeidlist);
     
    BROW();
    BCOLTXT("Theme","1");
    // BCOLINTXTID('quickstart_themename','quickstart_themename',$GLOBALS{'quickstart_themename'},"3");
    BCOLINSELECTHASHID ($xhash,'quickstart_themename','quickstart_themename',$GLOBALS{'quickstart_themename'},"3");
    BCOLTXT("Sport","1");
    BCOLINTXTID('quickstart_sportid','quickstart_sportid',$GLOBALS{'quickstart_sportid'},"3");
    BCOLTXT("Season","1");
    BCOLINTXTID('quickstart_periodid','quickstart_periodid',$GLOBALS{'quickstart_periodid'},"3");
    B_ROW();
    XH4("League");
    BROW();
    BCOLTXT("League ID","1");
    BCOLINTXTID('quickstart_leagueid','quickstart_leagueid',$GLOBALS{'quickstart_leagueid'},"3");
    BCOLTXT("League Name","1");
    BCOLINTXTID('quickstart_leaguename','quickstart_leaguename',$GLOBALS{'quickstart_leaguename'},"3");
    BCOLTXT("League Link","1");
    BCOLINTXTID('quickstart_leaguelink','quickstart_leaguelink',$GLOBALS{'quickstart_leaguelink'},"3");
    B_ROW();
    XH4("Prime Contact");
    BROW();
    BCOLTXT("First Name","1");
    BCOLINTXTID('quickstart_contactfname','quickstart_contactfname',$GLOBALS{'quickstart_contactfname'},"3");
    BCOLTXT("Last Name","1");
    BCOLINTXTID('quickstart_contactsname','quickstart_contactsname',$GLOBALS{'quickstart_contactsname'},"3");
    BCOLTXT("Email","1");
    BCOLINTXTID('quickstart_contactemail','quickstart_contactemail',$GLOBALS{'quickstart_contactemail'},"3");
    B_ROW();
    XBR();XBR();
    XINSUBMIT ("Update Club Details.");
    X_FORM();

}

function SECTTEAMSContentOutput() {
    XBR();
    // XH3("Sections  "."quickstartsection_".$GLOBALS{'quickstart_accountid'});

    XH3("Sections");
    XHRCLASS('underline');
    $qssectiona = Get_Array("quickstartsection",$GLOBALS{'quickstart_accountid'});
    foreach ( $qssectiona as $quickstartsection_name ) {
        XPTXT($quickstartsection_name);
    }
    if (!$qssectiona) { XPTXT("No Sections defined so far"); }
    XBR();
    XFORM("siteaccountquickstartsectionupdate.php","siteaccountquickstartsectionupdate");
    XINSTDHID();
    XINHID("quickstart_accountid",$GLOBALS{'quickstart_accountid'});
    XINSUBMIT ("Update Sections.");
    X_FORM();
 
    XH3("Teams");
    XHRCLASS('underline');
    
    $qsteama = Get_Array("quickstartteam",$GLOBALS{'quickstart_accountid'});
    foreach ( $qsteama as $quickstartteam_code ) {
        Get_Data("quickstartteam",$GLOBALS{'quickstart_accountid'},$quickstartteam_code );
        XPTXT($quickstartteam_code." ".$GLOBALS{'quickstartteam_name'}." ".$GLOBALS{'quickstartteam_sectionname'});
    }
    if (!$qsteama) { XPTXT("No Teams defined so far"); }
    
    XBR();
    XFORM("siteaccountquickstartteamupdate.php","siteaccountquickstartteamupdate");
    XINSTDHID();
    XINHID("quickstart_accountid",$GLOBALS{'quickstart_accountid'});
    XINSUBMIT ("Update Teams.");
    X_FORM();

}



function IMAGESContentOutput() {
    XFORM("siteaccountquickstartupdatein.php","siteaccountquickstartupdate");
    XINSTDHID();
    XINHID("quickstart_accountid",$GLOBALS{'quickstart_accountid'});
    XINHID("CurrentTab","IMAGES");
    
    XBR();XBR();
     XHRCLASS('underline');
    XH3("Club Logo");  
    XBR();XBR();
    XINHID("quickstart_logo",$GLOBALS{'quickstart_logo'});    
    $imagefieldname = "quickstart_logo";
    $imageviewwidth = "25%";
    $imagename = $GLOBALS{'quickstart_logo'};
    $imageuploadto = "QuickstartLogo";
    $imageuploadid = $GLOBALS{'quickstart_accountid'};
    $imageuploadwidth = "400";
    $imageuploadheight = "400";
    $imageuploadfixedsize = "400x400";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    
    XBR();XBR();
    XHRCLASS('underline');    
    XH3("Carousel Image 1");
    XBR();XBR();
    XINHID("quickstart_carouselimage1",$GLOBALS{'quickstart_carouselimage1'});
    $imagefieldname = "quickstart_carouselimage1";
    $imageviewwidth = "75%";
    $imagename = $GLOBALS{'quickstart_carouselimage1'};
    $imageuploadto = "QuickstartCarouselImg";
    $imageuploadid = $GLOBALS{'quickstart_accountid'};
    $imageuploadwidth = "1800";
    $imageuploadheight = "600";
    $imageuploadfixedsize = "1800x600";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    XBR();XBR();
    XHRCLASS('underline');    
    XH3("Carousel Image 2");
    XBR();XBR();
    XINHID("quickstart_carouselimage2",$GLOBALS{'quickstart_carouselimage2'});   
    $imagefieldname = "quickstart_carouselimage2";
    $imageviewwidth = "75%";
    $imagename = $GLOBALS{'quickstart_carouselimage2'};
    $imageuploadto = "QuickstartCarouselImg";
    $imageuploadid = $GLOBALS{'quickstart_accountid'};
    $imageuploadwidth = "1800";
    $imageuploadheight = "600";
    $imageuploadfixedsize = "1800x600";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    XBR();XBR();   
    XHRCLASS('underline');   
    XH3("Carousel Image 3");
    XBR();XBR();
    XINHID("quickstart_carouselimage2",$GLOBALS{'quickstart_carouselimage2'});    
    $imagefieldname = "quickstart_carouselimage3";
    $imageviewwidth = "75%";
    $imagename = $GLOBALS{'quickstart_carouselimage3'};
    $imageuploadto = "QuickstartCarouselImg";
    $imageuploadid = $GLOBALS{'quickstart_accountid'};
    $imageuploadwidth = "1800";
    $imageuploadheight = "600";
    $imageuploadfixedsize = "1800x600";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    XBR();XBR();
    XHRCLASS('underline');    
    XH3("Banner Image");
    XBR();XBR();
    XINHID("quickstart_bannerimage1",$GLOBALS{'quickstart_bannerimage1'}); 
    $imagefieldname = "quickstart_bannerimage1";
    $imageviewwidth = "75%";
    $imagename = $GLOBALS{'quickstart_bannerimage1'};
    $imageuploadto = "QuickstartBanner";
    $imageuploadid = $GLOBALS{'quickstart_accountid'};
    $imageuploadwidth = "1800";
    $imageuploadheight = "300";
    $imageuploadfixedsize = "1800x300";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    XBR();XBR();
    XINSUBMIT ("Update Images.");
    X_FORM();

}

function INTROContentOutput() {
    XFORM("siteaccountquickstartupdatein.php","siteaccountquickstartupdate");
    XINSTDHID();
    XINHID("quickstart_accountid",$GLOBALS{'quickstart_accountid'});
    XINHID("CurrentTab","INTRO");
    XBR();
    XHRCLASS('underline');    
    XH3("Introduction");
    XBR();
    XINTEXTAREAMCE("quickstart_introductiontext",$GLOBALS{'quickstart_introductiontext'},"10","80");	    
    XBR();XBR();
    XINHID("quickstart_introductionimage",$GLOBALS{'quickstart_introductionimage'});
    
    $imagefieldname = "quickstart_introductionimage";
    $imageviewwidth = "50%";
    $imagename = $GLOBALS{'quickstart_introductionimage'};
    $imageuploadto = "QuickstartMedia";
    $imageuploadid = $GLOBALS{'quickstart_accountid'};
    $imageuploadwidth = "750";
    $imageuploadheight = "450";
    $imageuploadfixedsize = "750x450";
    $imagethumbwidth = "300";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    XBR();XBR();
    XHRCLASS('underline');    
    XH3("About Us");
    XBR();
    XINTEXTAREAMCE("quickstart_aboutustext",$GLOBALS{'quickstart_aboutustext'},"10","80");
    XBR();XBR();    
    XBR();XBR();
    XINHID("quickstart_aboutusimage",$GLOBALS{'quickstart_aboutusimage'});
    
    $imagefieldname = "quickstart_aboutusimage";
    $imageviewwidth = "50%";
    $imagename = $GLOBALS{'quickstart_aboutusimage'};
    $imageuploadto = "QuickstartMedia";
    $imageuploadid = $GLOBALS{'quickstart_accountid'};
    $imageuploadwidth = "400";
    $imageuploadheight = "400";
    $imageuploadfixedsize = "750x450";
    $imagethumbwidth = "300";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    XBR();XBR();
    XINSUBMIT ("Update Introductions.");
    X_FORM();
}

function ORGContentOutput() {
    XBR();
    XH3("Organisation");
    XHRCLASS('underline');
    
    $qsorga = Get_Array("quickstartorg",$GLOBALS{'quickstart_accountid'});
    foreach ( $qsorga as $quickstartorg_code ) {
        Get_Data("quickstartorg",$GLOBALS{'quickstart_accountid'},$quickstartorg_code );
        XPTXT($GLOBALS{'quickstartorg_sectionname'}." ".$GLOBALS{'quickstartorg_title'}." - ".$GLOBALS{'quickstartorg_fname'}." ".$GLOBALS{'quickstartorg_sname'});
    }
    if (!$qsorga) { XPTXT("No Organisational roles defined so far"); }
    
    XBR();XBR();
    XFORM("siteaccountquickstartorgupdate.php","siteaccountquickstartorgupdate");
    XINSTDHID();
    XINHID("quickstart_accountid",$GLOBALS{'quickstart_accountid'});
    XINSUBMIT ("Update Organisation.");
    X_FORM();
}


function Site_QSSECTION_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,bootstrapdatepicker,datepickerYYYYMMDD,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Site_QSSECTION_Output($accountid) {  
    $parm0 = "";
    $parm0 = $parm0.$accountid." Sections|"; # pagetitle
    $parm0 = $parm0."quickstartsection[rootkey=".$accountid."]|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."quickstartsection_name|"; # keyfieldname
    $parm0 = $parm0."quickstartsection_seq|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."quickstartsection_name|Yes|Name|90|Yes|Section Name|KeyText,12,15^";
    $parm1 = $parm1."quickstartsection_seq|Yes|Seq|40|Yes|Sequence|InputText,10,20^";
    $parm1 = $parm1."quickstartsection_leaderfname|No||30|Yes|Leader First Name|InputText,25,50^";
    $parm1 = $parm1."quickstartsection_leadersname|No||30|Yes|Leader Last Name|InputText,25,50^";
    $parm1 = $parm1."quickstartsection_leaderemail|No||30|Yes|Leader Email|InputText,25,50^";
    $parm1 = $parm1."quickstartsection_introduction|No||30|Yes|Introduction Text|InputTextArea,5,50^";
    $parm1 = $parm1."quickstartsection_photo|No|Photo|30|Yes|Introduction Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,750,450,QuickstartSection,quickstartsection_accountid^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|75|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    $parm2 = "Finish and Return|siteaccountquickstartout.php|account_id=".$accountid."+SECTTEAMS";	
    GenericHandler_Output ($parm0,$parm1,$parm2);
}

function Site_QSTEAM_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,bootstrapdatepicker,datepickerYYYYMMDD,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Site_QSTEAM_Output($accountid) {
    XBR();XPTXTCOLOR('Please note that Team Codes are 2 character Alphanumeric. eg "M2" or "CC"',"green");
    $parm0 = "";
    $parm0 = $parm0.$accountid." Teams|"; # pagetitle
    $parm0 = $parm0."quickstartteam[rootkey=".$accountid."]|"; # primetable
    $parm0 = $parm0."quickstartsection[rootkey=".$accountid."]|"; # othertables
    $parm0 = $parm0."quickstartteam_code|"; # keyfieldname
    $parm0 = $parm0."quickstartteam_seq|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."quickstartteam_code|Yes|Code|90|Yes|Team Code|KeyText,2,2^";
    $parm1 = $parm1."quickstartteam_name|Yes|Name|150|Yes|Team Name|InputText,20,50^";
    $parm1 = $parm1."quickstartteam_seq|Yes|Seq|40|Yes|Sequence|InputText,10,20^";
    $parm1 = $parm1."quickstartteam_sectionname|Yes|Section|70|Yes|Section|InputSelectFromTable,quickstartsection,quickstartsection_name,quickstartsection_name,quickstartsection_name^";
    $parm1 = $parm1."quickstartteam_managerfname|No||30|Yes|Manager First Name|InputText,25,50^";
    $parm1 = $parm1."quickstartteam_managersname|No||30|Yes|Manager Last Name|InputText,25,50^";
    $parm1 = $parm1."quickstartteam_manageremail|No||30|Yes|Manager Email|InputText,25,50^";
    $parm1 = $parm1."quickstartteam_leagueid|No||30|Yes|Leafue Id|InputText,25,50^";
    $parm1 = $parm1."quickstartteam_leaguename|No||30|Yes|Leafue Id|InputText,25,50^";
    $parm1 = $parm1."quickstartteam_leaguelink|No||30|Yes|Leafue Id|InputText,50,200^";
    $parm1 = $parm1."quickstartteam_introduction|No||30|Yes|Introduction Text|InputTextArea,5,50^";
    $parm1 = $parm1."quickstartteam_photo|No|Photo|30|Yes|Introduction Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,750,450,QuickstartTeam,quickstartteam_accountid^";  
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    $parm2 = "Finish and Return|siteaccountquickstartout.php|account_id=".$accountid."+SECTTEAMS";	
    GenericHandler_Output ($parm0,$parm1,$parm2);    
}

function Site_QSORG_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Site_QSORG_Output($accountid) {
    $parm0 = "";
    $parm0 = $parm0.$accountid." Organisation|"; # pagetitle
    $parm0 = $parm0."quickstartorg[rootkey=".$accountid."]|"; # primetable
    $parm0 = $parm0."quickstartsection[rootkey=".$accountid."]|"; # othertables
    $parm0 = $parm0."quickstartorg_code|"; # keyfieldname
    $parm0 = $parm0."quickstartorg_seq|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = $parm1."quickstartorg_code|Yes|Code|90|Yes|Role Id|KeyText,25,50^";
    $parm1 = $parm1."quickstartorg_sectionname|Yes|Section|150|Yes|Section Name|InputSelectFromTable,quickstartsection,quickstartsection_name,quickstartsection_name,quickstartsection_name^";
    $parm1 = $parm1."quickstartorg_title|Yes|Title|30|Yes|Role Title|InputText,25,50^";
    $parm1 = $parm1."quickstartorg_fname|Yes|First Name|30|Yes|First Name|InputText,25,50^";
    $parm1 = $parm1."quickstartorg_sname|Yes|Last Name|30|Yes|Last Name|InputText,25,50^";
    $parm1 = $parm1."quickstartorg_email|No||30|Yes|Email|InputText,25,50^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    $parm2 = "Finish and Return|siteaccountquickstartout.php|account_id=".$accountid."+ORG";
    GenericHandler_Output ($parm0,$parm1,$parm2);
}
