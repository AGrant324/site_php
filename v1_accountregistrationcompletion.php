<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_siteroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$inaccount_longname = $_REQUEST['account_longname'];
$inaccount_shortname = $_REQUEST['account_shortname'];
$inpackage_id = $_REQUEST['package_id'];

Get_Data('package_'.$inpackage_id);

Check_Data('account',$inaccount_shortname);
if ($GLOBALS{'IOWARNING'} == "0") {	
 XH3("Account Already Exists");
 Account_Registration_Output();
} else {
 Initialise_Data('account');
 $GLOBALS{'account_longname'} = $_REQUEST['account_longname'];
 $GLOBALS{'account_shortname'} = $_REQUEST['account_shortname'];
 $GLOBALS{'account_contacttitle'} = $_REQUEST['account_contacttitle'];
 $GLOBALS{'account_contactfname'} = $_REQUEST['account_contactfname'];
 $GLOBALS{'account_contactinits'} = $_REQUEST['account_contactinits'];
 $GLOBALS{'account_contactsname'} = $_REQUEST['account_contactsname'];
 $GLOBALS{'account_contactrole'} = $_REQUEST['account_contactrole'];
 $GLOBALS{'account_contactaddr1'} = $_REQUEST['account_contactaddr1'];
 $GLOBALS{'account_contactaddr2'} = $_REQUEST['account_contactaddr2'];
 $GLOBALS{'account_contactaddr3'} = $_REQUEST['account_contactaddr3'];
 $GLOBALS{'account_contactaddr4'} = $_REQUEST['account_contactaddr4'];
 $GLOBALS{'account_contactpostcode'} = $_REQUEST['account_contactpostcode'];
 $GLOBALS{'account_contactmobiletel'} = $_REQUEST['account_contactmobiletel'];
 $GLOBALS{'account_contactemail'} = $_REQUEST['account_contactemail'];
 $clearpsw = createRandomPassword();
 $GLOBALS{'account_contactpassword'} = XCrypt($clearpsw,$inaccount_shortname,"encrypt");
 $GLOBALS{'account_session'} = XCrypt($GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'},$inaccount_shortname,"encrypt");  
 $GLOBALS{'account_packageid'} = $inpackage_id;
 Write_Data('account_'.$inaccount_shortname);
 
 Initialise_Data("serviceenabled"); 
 SetServiceEnabled("people",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("personexdirectory",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("personextrafields",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("personmembership",$GLOBALS{'package_servicebar'}); 
 SetServiceEnabled("personsafeguarding",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("personethnicity",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("persondisability",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("personmedical",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("jobroles",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("qualifications",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("org",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("webpages",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("mobilepages",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("advertising",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("email",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("sms",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("library",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("accreditation",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("newsletters",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("articles",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("events",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("actions",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("bookings",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("courses",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("draws",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("shop",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("sections",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("frs",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("fin",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("process",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("auction",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("pos",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("cor",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("reporting",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("dmws",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("grl",$GLOBALS{'package_servicebar'});
 SetServiceEnabled("care",$GLOBALS{'package_servicebar'});

 Write_Data('serviceenabled_'.$inaccount_shortname);
 		
 XH3("Thankyou, Your account has now been set up");
 XPTXT("Account Id - ".$inaccount_shortname);
 XPTXT("Password - $clearpsw");
 XPTXT("Please remember these in order to login to you account");  
 
 Domain_Setup_Output($inaccount_shortname);
}

Back_Navigator();
PageFooter("Default","Final");


function SetServiceEnabled($serviceref,$packagelevel) {   
    if ($GLOBALS{'service_'.$serviceref} == "" ) {
        $GLOBALS{'serviceenabled_'.$serviceref} == "";
    } else {
        if ($packagelevel >= $GLOBALS{'service_'.$serviceref} ) {
            $GLOBALS{'serviceenabled_'.$serviceref} = "Enabled";   
        } else {
            $GLOBALS{'serviceenabled_'.$serviceref} = "UpgradeReqd"; 
        }
    }
}



?>

