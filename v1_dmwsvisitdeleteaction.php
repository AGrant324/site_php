<<<<<<< HEAD
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
$indmwsvisit_id = $_REQUEST['dmwsvisit_id'];

Check_Data('dmwssu',$indmwssu_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    Check_Data('dmwssux',$indmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "0") {
        
        Check_Data('dmwsprogress',$indmwssu_id,$indmwsvisit_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            Delete_Data('dmwsprogress',$indmwssu_id,$indmwsvisit_id);
            XPTXTCOLOR("Deleted Progress ".$indmwssu_id." ".$indmwsvisit_id,"green");
        }
    
        Check_Data('dmwswellbeing',$indmwssu_id,$indmwsvisit_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            Delete_Data('dmwswellbeing',$indmwssu_id,$indmwsvisit_id);
            XPTXTCOLOR("Deleted Wellbeing ".$indmwssu_id." ".$indmwsvisit_id,"green");
        }
        
        Check_Data('dmwscomplexity',$indmwssu_id,$indmwsvisit_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            Delete_Data('dmwscomplexity',$indmwssu_id,$indmwsvisit_id);
            XPTXTCOLOR("Deleted Complexity ".$indmwssu_id." ".$indmwsvisit_id,"green");
        }
        
        Check_Data('dmwsvisit',$indmwssu_id,$indmwsvisit_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            Delete_Data('dmwsvisit',$indmwssu_id,$indmwsvisit_id);
            XPTXTCOLOR("Deleted Visit ".$indmwssu_id."/".$indmwsvisit_id,"green");
        } 
        
        $timestamp = "T".$GLOBALS{'currentYYYYMMDDHHMMSS'};
        $GLOBALS{'dmwssu_clientupdatetimestamp'} = $timestamp;
        Write_Data('dmwssu',$indmwssu_id);
        
    }
}

Dmws_DMWSSULIST_Output("Open");

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
Dmws_DMWSSULIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$indmwssu_id = $_REQUEST['dmwssu_id'];
$indmwsvisit_id = $_REQUEST['dmwsvisit_id'];

Check_Data('dmwssu',$indmwssu_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    Check_Data('dmwssux',$indmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "0") {
        
        Check_Data('dmwsprogress',$indmwssu_id,$indmwsvisit_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            Delete_Data('dmwsprogress',$indmwssu_id,$indmwsvisit_id);
            XPTXTCOLOR("Deleted Progress ".$indmwssu_id." ".$indmwsvisit_id,"green");
        }
    
        Check_Data('dmwswellbeing',$indmwssu_id,$indmwsvisit_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            Delete_Data('dmwswellbeing',$indmwssu_id,$indmwsvisit_id);
            XPTXTCOLOR("Deleted Wellbeing ".$indmwssu_id." ".$indmwsvisit_id,"green");
        }
        
        Check_Data('dmwscomplexity',$indmwssu_id,$indmwsvisit_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            Delete_Data('dmwscomplexity',$indmwssu_id,$indmwsvisit_id);
            XPTXTCOLOR("Deleted Complexity ".$indmwssu_id." ".$indmwsvisit_id,"green");
        }
        
        Check_Data('dmwsvisit',$indmwssu_id,$indmwsvisit_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            Delete_Data('dmwsvisit',$indmwssu_id,$indmwsvisit_id);
            XPTXTCOLOR("Deleted Visit ".$indmwssu_id."/".$indmwsvisit_id,"green");
        } 
        
        $timestamp = "T".$GLOBALS{'currentYYYYMMDDHHMMSS'};
        $GLOBALS{'dmwssu_clientupdatetimestamp'} = $timestamp;
        Write_Data('dmwssu',$indmwssu_id);
        
    }
}

Dmws_DMWSSULIST_Output("Open");

Back_Navigator();
PageFooter("Default","Final");

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
