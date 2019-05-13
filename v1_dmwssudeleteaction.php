<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Dmws_DMWSSULIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$indmwssu_id = $_REQUEST['dmwssu_id'];
$inlist = $_REQUEST['List'];
$inliststatus = $_REQUEST['ListStatus'];

Check_Data('dmwssu',$indmwssu_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    Check_Data('dmwssux',$indmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "0") {
        
        $dmwsconsentwithdrawala = Get_Array('dmwsconsentwithdrawal',$indmwssu_id);
        foreach ($dmwsconsentwithdrawala as $dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid) {
            Check_Data('dmwsconsentwithdrawal',$indmwssu_id,$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
            if ($GLOBALS{'IOWARNING'} == "0") {
                Delete_Data('dmwsconsentwithdrawal',$indmwssu_id,$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
                // XPTXTCOLOR("Deleted Consent Withdrawal ".$indmwssu_id." ".$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,"green");
            }
        }
        
        $dmwsreferrerupdatea = Get_Array('dmwsreferrerupdate',$indmwssu_id);
        foreach ($dmwsreferrerupdatea as $dmwsreferrerupdate_id) {
            Check_Data('dmwsreferrerupdate',$indmwssu_id,$dmwsreferrerupdate_id);
            if ($GLOBALS{'IOWARNING'} == "0") {
                Delete_Data('dmwsreferrerupdate',$indmwssu_id,$dmwsreferrerupdate_id);
                // XPTXTCOLOR("Deleted Referrer Update ".$indmwssu_id." ".$dmwsreferrerupdate_id,"green");
            }
        }
        
        $dmwsactiona = Get_Array('dmwsaction',$indmwssu_id);
        foreach ($dmwsactiona as $dmwsaction_id) {
            Check_Data('dmwsaction',$indmwssu_id,$dmwsaction_id);
            if ($GLOBALS{'IOWARNING'} == "0") {
                Delete_Data('dmwsaction',$indmwssu_id,$dmwsaction_id);
                // XPTXTCOLOR("Deleted Action ".$indmwssu_id." ".$dmwsaction_id,"green");
            }
        }
        
        $dmwsserviceprovideda = Get_Array('dmwsserviceprovided',$indmwssu_id);
        foreach ($dmwsserviceprovideda as $dmwsserviceprovided_id) {
            Check_Data('dmwsserviceprovided',$indmwssu_id,$dmwsserviceprovided_id);
            if ($GLOBALS{'IOWARNING'} == "0") {
                Delete_Data('dmwsserviceprovided',$indmwssu_id,$dmwsserviceprovided_id);
                // XPTXTCOLOR("Deleted Action ".$indmwssu_id." ".$dmwsserviceprovided_id,"green");
            }
        }
       
        $dmwsreferrala = Get_Array('dmwsreferral',$indmwssu_id);
        foreach ($dmwsreferrala as $dmwsreferral_id) {
            Check_Data('dmwsreferral',$indmwssu_id,$dmwsreferral_id);
            if ($GLOBALS{'IOWARNING'} == "0") {
                Delete_Data('dmwsreferral',$indmwssu_id,$dmwsreferral_id);
                // XPTXTCOLOR("Deleted Action ".$indmwssu_id." ".$dmwsreferral_id,"green");              
            }
        }
        
        $dmwsprogressa = Get_Array('dmwsprogress',$indmwssu_id);
        foreach ($dmwsprogressa as $dmwsprogress_dmwsvisitid) {
            Check_Data('dmwsprogress',$indmwssu_id,$dmwsprogress_dmwsvisitid);
            if ($GLOBALS{'IOWARNING'} == "0") {
                Delete_Data('dmwsprogress',$indmwssu_id,$dmwsprogress_dmwsvisitid);
                // XPTXTCOLOR("Deleted Progress ".$indmwssu_id." ".$dmwsprogress_dmwsvisitid,"green");
            }
        }
        
        $dmwswellbeinga = Get_Array('dmwswellbeing',$indmwssu_id);
        foreach ($dmwswellbeinga as $dmwswellbeing_dmwsvisitid) {
            Check_Data('dmwswellbeing',$indmwssu_id,$dmwswellbeing_dmwsvisitid);
            if ($GLOBALS{'IOWARNING'} == "0") {
                Delete_Data('dmwswellbeing',$indmwssu_id,$dmwswellbeing_dmwsvisitid);
                // XPTXTCOLOR("Deleted Wellbeing ".$indmwssu_id." ".$dmwswellbeing_dmwsvisitid,"green");
            }
        }
        
        $dmwscomplexitya = Get_Array('dmwscomplexity',$indmwssu_id);
        foreach ($dmwscomplexitya as $dmwscomplexity_dmwsvisitid) {
            Check_Data('dmwscomplexity',$indmwssu_id,$dmwscomplexity_dmwsvisitid);
            if ($GLOBALS{'IOWARNING'} == "0") {
                Delete_Data('dmwscomplexity',$indmwssu_id,$dmwscomplexity_dmwsvisitid);
                // XPTXTCOLOR("Deleted Complexity ".$indmwssu_id." ".$dmwscomplexity_dmwsvisitid,"green");
            }
        }
        
        $dmwsvisita = Get_Array('dmwsvisit',$indmwssu_id);
        $latestvisittype = "";
        foreach ($dmwsvisita as $dmwsvisit_id) {
            Check_Data('dmwsvisit',$indmwssu_id,$dmwsvisit_id);
            if ($GLOBALS{'IOWARNING'} == "0") {
                Delete_Data('dmwsvisit',$indmwssu_id,$dmwsvisit_id);
                // XPTXTCOLOR("Deleted Visit ".$indmwssu_id." ".$dmwsvisit_id,"green");
            }          
        }

        Delete_Data("dmwssu",$indmwssu_id);
        Delete_Data("dmwssux",$indmwssu_id);
        XPTXTCOLOR("<b>Service User - ".$indmwssu_id." deleted</b>","green");
    	if ($inlist == "DMWSSULIST") {
    	    $thisliststatus = "Open";
    	    if ($inliststatus == "Closed") { $thisliststatus = "Closed"; }
    	    Dmws_DMWSSULIST_Output($thisliststatus);
    	} else { // for further expansion
 	    
    	}
    }
}

Back_Navigator();
PageFooter("Default","Final");

?>


