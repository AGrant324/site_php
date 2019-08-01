<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$testorreal = $_REQUEST["TestorReal"];
if ($testorreal == "R") {$modetext = "Real Mode";} else {$modetext = "Test Mode";}

XH2("Data  Cleanup - ".$modetext);

$validsuvisita = array();

$dmwssua = Get_Array('dmwssu');
foreach ($dmwssua as $dmwssu_id) {
    Get_Data('dmwssu',$dmwssu_id);
    Check_Data('dmwssux',$dmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "1") {		   
        if ( $testorreal == "R" ) {
            Delete_Data('dmwssu',$dmwssu_id);
            XPTXTCOLOR($dmwssu_id." NO MATCHING DMWSSUX RECORD all service user records have been deleted","red");
        } else {
            XPTXTCOLOR($dmwssu_id." NO MATCHING DMWSSUX RECORD all service user records would be deleted","orange");
        }
    } else {
        $dmwsvisita = Get_Array('dmwsvisit',$dmwssu_id);
        foreach ($dmwsvisita as $dmwsvisit_id) {
            Get_Data('dmwsvisit',$dmwssu_id,$dmwsvisit_id);
            if ( FoundInCommaList($GLOBALS{'dmwsvisit_type'},"First,Subsequent,Discharge,FollowUp,undefined") ) {
                array_push($validsuvisita,$dmwssu_id."|".$dmwsvisit_id);
            }
        }
        
    }    
} 
    
$dmwsvisit2ka = Get_2Key_Array('dmwsvisit');
foreach ($dmwsvisit2ka as $dmwsvisit2k) {
    $kbits = explode("|",$dmwsvisit2k);
    Check_Data('dmwsvisit',$kbits[0],$kbits[1]);
    if ($GLOBALS{'IOWARNING'} == "0") {	
        if (in_array($dmwsvisit2k, $validsuvisita)) {           
            if ( $GLOBALS{'dmwsvisit_type'} == "undefined") {
                $GLOBALS{'dmwsvisit_type'} = "Subsequent";
                if ( $testorreal == "R" ) {
                    Write_Data('dmwsvisit',$kbits[0],$kbits[1]);
                    XPTXTCOLOR($dmwsvisit2k." visit type changed from undefined to ".$GLOBALS{'dmwsvisit_type'},"red");
                } else {
                    XPTXTCOLOR($dmwsvisit2k." visit type would be changed from undefined to ".$GLOBALS{'dmwsvisit_type'},"orange");;
                }
            } else {               
                XPTXTCOLOR($dmwsvisit2k." visit kept","green");                
            }
        } else {       
            if ( $testorreal == "R" ) {           
                Delete_Data('dmwsvisit',$kbits[0],$kbits[1]); 
                XPTXTCOLOR($dmwsvisit2k." (".$GLOBALS{'dmwsvisit_type'}.") visit deleted","red");
            } else {
                XPTXTCOLOR($dmwsvisit2k." (".$GLOBALS{'dmwsvisit_type'}.") visit would be deleted","orange");
            }
        }
    } else {       
        XPTXTCOLOR("VISIT KEY ERROR ".$kbits[0]." ".$kbits[1],"red");
    }
}   
   
$dmwsprogress2ka = Get_2Key_Array('dmwsprogress');
foreach ($dmwsprogress2ka as $dmwsprogress2k) {
    if (in_array($dmwsprogress2k, $validsuvisita)) {
        XPTXTCOLOR($dmwsprogress2k." progress kept","green");
    } else {
        
        if ( $testorreal == "R" ) {
            $kbits = explode("|",$dmwsprogress2k);
            Delete_Data('dmwsprogress',$kbits[0],$kbits[1]);
            XPTXTCOLOR($dmwsprogress2k." progress deleted","red");
        } else {
            XPTXTCOLOR($dmwsprogress2k." progress would be deleted","orange");
        }
    }
}   

$dmwswellbeing2ka = Get_2Key_Array('dmwswellbeing');
foreach ($dmwswellbeing2ka as $dmwswellbeing2k) {
    if (in_array($dmwswellbeing2k, $validsuvisita)) {
        XPTXTCOLOR($dmwswellbeing2k." wellbeing kept","green");
    } else {
        if ( $testorreal == "R" ) {
            $kbits = explode("|",$dmwswellbeing2k);
            Delete_Data('dmwswellbeing',$kbits[0],$kbits[1]);
            XPTXTCOLOR($dmwswellbeing2k." wellbeing deleted","red");
        } else {
            XPTXTCOLOR($dmwswellbeing2k." wellbeing would be deleted","orange");
        }
    }
} 

$dmwscomplexity2ka = Get_2Key_Array('dmwscomplexity');
foreach ($dmwscomplexity2ka as $dmwscomplexity2k) {
    $kbits = explode("|",$dmwscomplexity2k);
    if ((in_array($dmwscomplexity2k, $validsuvisita))||($kbits[1] == "Latest")) {
        XPTXTCOLOR($dmwscomplexity2k." complexity kept","green");
    } else {
        if ( $testorreal == "R" ) {           
            Delete_Data('dmwscomplexity',$kbits[0],$kbits[1]);
            XPTXTCOLOR($dmwscomplexity2k." complexity deleted","red");
        } else {
            XPTXTCOLOR($dmwscomplexity2k." complexity would be deleted","orange");
        }
    }
} 

/*

$dmwsaction2ka = Get_2Key_Array('dmwsaction');
foreach ($dmwsaction2ka as $dmwsaction2k) {
    $kbits = explode("|",$dmwsaction2k);
    Get_Data('dmwsaction',$kbits[0],$kbits[1]);  
    if (in_array($GLOBALS{'dmwsaction_dmwsvisitid'}, $validsuvisita)) {
        XPTXTCOLOR($dmwsaction2k." action kept","green");
    } else {
        XPTXTCOLOR($dmwsaction2k." action deleted","red");
    }
} 

$dmwsreferral2ka = Get_2Key_Array('dmwsreferral');
foreach ($dmwsreferral2ka as $dmwsreferral2k) {
    $kbits = explode("|",$dmwsreferral2k);
    Get_Data('dmwsreferral',$kbits[0],$kbits[1]);
    if (in_array($GLOBALS{'dmwsreferral_dmwsvisitid'}, $validsuvisita)) {
        XPTXTCOLOR($dmwsreferral2k." referral kept","green");
    } else {
        XPTXTCOLOR($dmwsreferral2k." referral deleted","red");
    }
} 

$dmwsserviceprovided2ka = Get_2Key_Array('dmwsserviceprovided');
foreach ($dmwsserviceprovided2ka as $dmwsserviceprovided2k) {
    $kbits = explode("|",$dmwsserviceprovided2k);
    Get_Data('dmwsserviceprovided',$kbits[0],$kbits[1]);
    if (in_array($GLOBALS{'dmwsserviceprovided_dmwsvisitid'}, $validsuvisita)) {
        XPTXTCOLOR($dmwsserviceprovided2k." serviceprovided kept","green");
    } else {
        XPTXTCOLOR($dmwsserviceprovided2k." serviceprovided deleted","red");
    }
} 

$dmwsreferrerupdate2ka = Get_2Key_Array('dmwsreferrerupdate');
foreach ($dmwsreferrerupdate2ka as $dmwsreferrerupdate2k) {
    $kbits = explode("|",$dmwsreferrerupdate2k);
    Get_Data('dmwsreferrerupdate',$kbits[0],$kbits[1]);
    if (in_array($GLOBALS{'dmwsreferrerupdate_dmwsvisitid'}, $validsuvisita)) {
        XPTXTCOLOR($dmwsreferrerupdate2k." referrerupdate kept","green");
    } else {
        XPTXTCOLOR($dmwsreferrerupdate2k." referrerupdate deleted","red");
    }
} 

*/

Back_Navigator();
PageFooter("Default","Final");

?>


=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$testorreal = $_REQUEST["TestorReal"];
if ($testorreal == "R") {$modetext = "Real Mode";} else {$modetext = "Test Mode";}

XH2("Data  Cleanup - ".$modetext);

$validsuvisita = array();

$dmwssua = Get_Array('dmwssu');
foreach ($dmwssua as $dmwssu_id) {
    Get_Data('dmwssu',$dmwssu_id);
    Check_Data('dmwssux',$dmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "1") {		   
        if ( $testorreal == "R" ) {
            Delete_Data('dmwssu',$dmwssu_id);
            XPTXTCOLOR($dmwssu_id." NO MATCHING DMWSSUX RECORD all service user records have been deleted","red");
        } else {
            XPTXTCOLOR($dmwssu_id." NO MATCHING DMWSSUX RECORD all service user records would be deleted","orange");
        }
    } else {
        $dmwsvisita = Get_Array('dmwsvisit',$dmwssu_id);
        foreach ($dmwsvisita as $dmwsvisit_id) {
            Get_Data('dmwsvisit',$dmwssu_id,$dmwsvisit_id);
            if ( FoundInCommaList($GLOBALS{'dmwsvisit_type'},"First,Subsequent,Discharge,FollowUp,undefined") ) {
                array_push($validsuvisita,$dmwssu_id."|".$dmwsvisit_id);
            }
        }
        
    }    
} 
    
$dmwsvisit2ka = Get_2Key_Array('dmwsvisit');
foreach ($dmwsvisit2ka as $dmwsvisit2k) {
    $kbits = explode("|",$dmwsvisit2k);
    Check_Data('dmwsvisit',$kbits[0],$kbits[1]);
    if ($GLOBALS{'IOWARNING'} == "0") {	
        if (in_array($dmwsvisit2k, $validsuvisita)) {           
            if ( $GLOBALS{'dmwsvisit_type'} == "undefined") {
                $GLOBALS{'dmwsvisit_type'} = "Subsequent";
                if ( $testorreal == "R" ) {
                    Write_Data('dmwsvisit',$kbits[0],$kbits[1]);
                    XPTXTCOLOR($dmwsvisit2k." visit type changed from undefined to ".$GLOBALS{'dmwsvisit_type'},"red");
                } else {
                    XPTXTCOLOR($dmwsvisit2k." visit type would be changed from undefined to ".$GLOBALS{'dmwsvisit_type'},"orange");;
                }
            } else {               
                XPTXTCOLOR($dmwsvisit2k." visit kept","green");                
            }
        } else {       
            if ( $testorreal == "R" ) {           
                Delete_Data('dmwsvisit',$kbits[0],$kbits[1]); 
                XPTXTCOLOR($dmwsvisit2k." (".$GLOBALS{'dmwsvisit_type'}.") visit deleted","red");
            } else {
                XPTXTCOLOR($dmwsvisit2k." (".$GLOBALS{'dmwsvisit_type'}.") visit would be deleted","orange");
            }
        }
    } else {       
        XPTXTCOLOR("VISIT KEY ERROR ".$kbits[0]." ".$kbits[1],"red");
    }
}   
   
$dmwsprogress2ka = Get_2Key_Array('dmwsprogress');
foreach ($dmwsprogress2ka as $dmwsprogress2k) {
    if (in_array($dmwsprogress2k, $validsuvisita)) {
        XPTXTCOLOR($dmwsprogress2k." progress kept","green");
    } else {
        
        if ( $testorreal == "R" ) {
            $kbits = explode("|",$dmwsprogress2k);
            Delete_Data('dmwsprogress',$kbits[0],$kbits[1]);
            XPTXTCOLOR($dmwsprogress2k." progress deleted","red");
        } else {
            XPTXTCOLOR($dmwsprogress2k." progress would be deleted","orange");
        }
    }
}   

$dmwswellbeing2ka = Get_2Key_Array('dmwswellbeing');
foreach ($dmwswellbeing2ka as $dmwswellbeing2k) {
    if (in_array($dmwswellbeing2k, $validsuvisita)) {
        XPTXTCOLOR($dmwswellbeing2k." wellbeing kept","green");
    } else {
        if ( $testorreal == "R" ) {
            $kbits = explode("|",$dmwswellbeing2k);
            Delete_Data('dmwswellbeing',$kbits[0],$kbits[1]);
            XPTXTCOLOR($dmwswellbeing2k." wellbeing deleted","red");
        } else {
            XPTXTCOLOR($dmwswellbeing2k." wellbeing would be deleted","orange");
        }
    }
} 

$dmwscomplexity2ka = Get_2Key_Array('dmwscomplexity');
foreach ($dmwscomplexity2ka as $dmwscomplexity2k) {
    $kbits = explode("|",$dmwscomplexity2k);
    if ((in_array($dmwscomplexity2k, $validsuvisita))||($kbits[1] == "Latest")) {
        XPTXTCOLOR($dmwscomplexity2k." complexity kept","green");
    } else {
        if ( $testorreal == "R" ) {           
            Delete_Data('dmwscomplexity',$kbits[0],$kbits[1]);
            XPTXTCOLOR($dmwscomplexity2k." complexity deleted","red");
        } else {
            XPTXTCOLOR($dmwscomplexity2k." complexity would be deleted","orange");
        }
    }
} 

/*

$dmwsaction2ka = Get_2Key_Array('dmwsaction');
foreach ($dmwsaction2ka as $dmwsaction2k) {
    $kbits = explode("|",$dmwsaction2k);
    Get_Data('dmwsaction',$kbits[0],$kbits[1]);  
    if (in_array($GLOBALS{'dmwsaction_dmwsvisitid'}, $validsuvisita)) {
        XPTXTCOLOR($dmwsaction2k." action kept","green");
    } else {
        XPTXTCOLOR($dmwsaction2k." action deleted","red");
    }
} 

$dmwsreferral2ka = Get_2Key_Array('dmwsreferral');
foreach ($dmwsreferral2ka as $dmwsreferral2k) {
    $kbits = explode("|",$dmwsreferral2k);
    Get_Data('dmwsreferral',$kbits[0],$kbits[1]);
    if (in_array($GLOBALS{'dmwsreferral_dmwsvisitid'}, $validsuvisita)) {
        XPTXTCOLOR($dmwsreferral2k." referral kept","green");
    } else {
        XPTXTCOLOR($dmwsreferral2k." referral deleted","red");
    }
} 

$dmwsserviceprovided2ka = Get_2Key_Array('dmwsserviceprovided');
foreach ($dmwsserviceprovided2ka as $dmwsserviceprovided2k) {
    $kbits = explode("|",$dmwsserviceprovided2k);
    Get_Data('dmwsserviceprovided',$kbits[0],$kbits[1]);
    if (in_array($GLOBALS{'dmwsserviceprovided_dmwsvisitid'}, $validsuvisita)) {
        XPTXTCOLOR($dmwsserviceprovided2k." serviceprovided kept","green");
    } else {
        XPTXTCOLOR($dmwsserviceprovided2k." serviceprovided deleted","red");
    }
} 

$dmwsreferrerupdate2ka = Get_2Key_Array('dmwsreferrerupdate');
foreach ($dmwsreferrerupdate2ka as $dmwsreferrerupdate2k) {
    $kbits = explode("|",$dmwsreferrerupdate2k);
    Get_Data('dmwsreferrerupdate',$kbits[0],$kbits[1]);
    if (in_array($GLOBALS{'dmwsreferrerupdate_dmwsvisitid'}, $validsuvisita)) {
        XPTXTCOLOR($dmwsreferrerupdate2k." referrerupdate kept","green");
    } else {
        XPTXTCOLOR($dmwsreferrerupdate2k." referrerupdate deleted","red");
    }
} 

*/

Back_Navigator();
PageFooter("Default","Final");

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
