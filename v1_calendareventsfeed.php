<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$eventstring = "";

/*
0 eventtype
---- direct mapping to fullcalendar event elements *
1 color
2 id
3 title
4 allDay
5 start
6 end
7 url
---- indirect mapping to fullcalendar event elements
8 personid
9 description
10 raisedbyorgtype
11 raisedbyorgid
12 raisedbypersonid
*/

if ( $GLOBALS{'LOGIN_orgtype_id'} == "Club" ) {
    Check_Data('sfmclub',$GLOBALS{'LOGIN_org_id'});
    if ($GLOBALS{'IOWARNING'} == "0") {

        $todo_ida = Get_Array('todo',$GLOBALS{'LOGIN_org_id'});
        foreach ($todo_ida as $todo_id) {
            Get_Data('todo',$GLOBALS{'LOGIN_org_id'},$todo_id);
            $eventstring = $eventstring."todo"."|";
            $eventstring = $eventstring."green"."|";
            $eventstring = $eventstring.$GLOBALS{'todo_id'}."|";
            $eventstring = $eventstring.$GLOBALS{'todo_title'}."|";
            $eventstring = $eventstring."allDay"."|";
            $eventstring = $eventstring.$GLOBALS{'todo_enddate'}."|";
            $eventstring = $eventstring.$GLOBALS{'todo_enddate'}."|";
            $eventstring = $eventstring.""."|";
            $eventstring = $eventstring.$GLOBALS{'todo_personid'}."|";
            $eventstring = $eventstring.$GLOBALS{'todo_actionrequired'}."|";
            $eventstring = $eventstring.$GLOBALS{'todo_raisedbyorgtype'}."|";
            $eventstring = $eventstring.$GLOBALS{'todo_raisedbyorgid'}."|";
            $eventstring = $eventstring.$GLOBALS{'todo_raisedbypersonid'}."^";
        }

        $activeaccredscheme_id = "";
        $taccredscheme_ida = Get_Array('accredscheme');
        foreach ($taccredscheme_ida as $taccredscheme_id) {
            Check_Data("accredscheme",$taccredscheme_id);
            if ( $GLOBALS{'accredscheme_type'} == "Normal") {
                if ($GLOBALS{'accredscheme_active'} == "Yes") {$activeaccredscheme_id = $taccredscheme_id;}
            }
        }
        // $accredactiona = Get_Array("accredaction",$activeaccredscheme_id,$taccredcriteria_clubid);
        $accredactiona = Get_Array("accredaction",$activeaccredscheme_id,$GLOBALS{'LOGIN_org_id'});
        foreach ($accredactiona as $accredaction_id) {
            Get_Data("accredaction",$activeaccredscheme_id,$GLOBALS{'LOGIN_org_id'},$accredaction_id);
            $eventstring = $eventstring."devplan"."|";
            $eventstring = $eventstring."blue"."|";
            $eventstring = $eventstring.$GLOBALS{'accredaction_id'}."|";
            $eventstring = $eventstring.$GLOBALS{'accredaction_sectiontopic'}."|";
            $eventstring = $eventstring."allDay"."|";
            $eventstring = $eventstring.$GLOBALS{'accredaction_duedate'}."|";
            $eventstring = $eventstring.$GLOBALS{'accredaction_duedate'}."|";
            $eventstring = $eventstring.""."|";
            $personidtext = "";
            if ($GLOBALS{'accredaction_personid'} != "") {
                $personida = List2Array($GLOBALS{'accredaction_personid'});
                $personidtext = $personida[0];
            }
            $eventstring = $eventstring.$personidtext."|";
            $eventstring = $eventstring.$GLOBALS{'accredaction_objective'}."|";
            $eventstring = $eventstring.""."|";
            $eventstring = $eventstring.""."|";
            $eventstring = $eventstring.""."^";
        }
        
        $sfmfacilityida = List2Array($GLOBALS{'sfmclub_sfmfacilityidlist'});
        foreach ($sfmrectification_ida as $sfmfacility_id) {
            $sfmrectification_ida = Get_Array("sfmrectification",$sfmfacility_id);
            foreach ($sfmrectification_ida as $sfmrectification_id) {
                Get_Data("sfmrectification",$sfmfacility_id,$sfmrectification_id);
                $eventstring = $eventstring."rect"."|";
                $eventstring = $eventstring."red"."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_id'}."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_evidencerequirement'}."|";
                $eventstring = $eventstring."allDay"."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_duedate'}."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_duedate'}."|";
                $eventstring = $eventstring.""."|";
                $eventstring = $eventstring.$GLOBALS{'LOGIN_person_id'}."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_fixdescription'}."|";
                $eventstring = $eventstring.""."|";
                $eventstring = $eventstring.""."|";
                $eventstring = $eventstring.""."^";
            }
        }
    }
}

if ($eventstring != "") {
    $eventstring = rtrim($eventstring, "^"); // last "^"
}

// Output eventstring for our calendar
echo $eventstring;


?>
