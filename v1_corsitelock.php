<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$incorsite_id = $_REQUEST['corsite_id'];
$incorsite_version = $_REQUEST['corsite_version'];
$incorsite_lastupdatetimestamp = $_REQUEST['corsite_lastupdatetimestamp'];
$incorsite_lastupdatepersonid = $_REQUEST['corsite_lastupdatepersonid'];
$incorlockrequest = $_REQUEST["CorLockRequest"];

$lockrequestresult = "";

Get_Data('corsite',$incorsite_id,$incorsite_version);

$compstring = "";
if ($incorlockrequest == "LockRequest") {
    if (($GLOBALS{'corsite_lockedpersonid'} == "")||($GLOBALS{'corsite_lockedpersonid'} == $GLOBALS{'LOGIN_person_id'})) {
        $compstring = $incorsite_lastupdatetimestamp." vs ".$GLOBALS{'corsite_lastupdatetimestamp'};
        if ($incorsite_lastupdatetimestamp == $GLOBALS{'corsite_lastupdatetimestamp'}) {
            $lockrequestresult = "Accepted";
            $lockrequestresultreason = "";
            $lockstatus = "LockedByMe";            
            $GLOBALS{'corsite_lockedtimestamp'} = $GLOBALS{'currenttimestamp'};
            $GLOBALS{'corsite_lockedpersonid'} = $GLOBALS{'LOGIN_person_id'};
            Write_Data('corsite',$incorsite_id,$incorsite_version);        
        } else {           
            $lockrequestresult = "Rejected";
            $lockrequestresultreason = "TimestampError";            
            if ( $GLOBALS{'corsite_lockedpersonid'} == "" ) { $lockstatus = "UnLocked"; }               
            if ( $GLOBALS{'corsite_lockedpersonid'} == $GLOBALS{'LOGIN_person_id'} ) { $lockstatus = "LockedByMe"; }           
        }
    } else {
        $lockrequestresult = "Rejected";
        $lockrequestresultreason = "AlreadyLocked";
        $lockstatus = "LockedByOther";
    }
}
if ($incorlockrequest == "UnLockRequest") {
    $lockrequestresult = "Accepted";
    $lockrequestresultreason = "";
    $lockstatus = "UnLocked";
	$GLOBALS{'corsite_lockedtimestamp'} = "";
	$GLOBALS{'corsite_lockedpersonid'} = "";
	Write_Data('corsite',$incorsite_id,$incorsite_version);
}
if ($incorlockrequest == "QueryLockStatus") {
    $lockrequestresult = "Accepted";
    $lockrequestresultreason = "";
    if ( $GLOBALS{'corsite_lockedpersonid'} == "" ) { 
        $lockstatus = "UnLocked"; 
    } else {
        if ( $GLOBALS{'corsite_lockedpersonid'} == $GLOBALS{'LOGIN_person_id'} ) { $lockstatus = "LockedByMe"; }  
        else { $lockstatus = "LockedByOther"; }
    }   
}

$outstring = $incorsite_id."|".$incorsite_version."|".$incorlockrequest."|".$lockrequestresult."|".$lockrequestresultreason."|";
$outstring = $outstring.$GLOBALS{'corsite_lockedtimestamp'}."|".$GLOBALS{'corsite_lockedpersonid'}."|".$lockstatus."|";
$outstring = $outstring.$GLOBALS{'corsite_lastupdatetimestamp'}."|".$GLOBALS{'corsite_lastupdatepersonid'}."|".$GLOBALS{'corsite_lastupdatetype'}."|";;
$outstring = $outstring.$compstring;
print $outstring;

?>