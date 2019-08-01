<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Library_ACCREDACTIONVIEWLIST_CSSJS ();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

if((isset($_REQUEST['accredscheme_id'])&&$_REQUEST['accredscheme_id']!="")) {
    $thisaccredscheme_id = $_REQUEST['accredscheme_id'];
} else {
    $thisaccredscheme_id = "";
    $taccredscheme_ida = Get_Array('accredscheme');
    foreach ($taccredscheme_ida as $taccredscheme_id) {
        Check_Data("accredscheme",$taccredscheme_id);
            if ($GLOBALS{'accredscheme_active'} == "Yes" && $GLOBALS{'accredscheme_type'} == "Normal") {$thisaccredscheme_id = $taccredscheme_id;}
    }
}
$thisclubid = $GLOBALS{'LOGIN_org_id'};
if((isset($_REQUEST['accredaction_clubid'])&&$_REQUEST['accredaction_clubid']!="")) {
    $thisclubid = $_REQUEST['accredaction_clubid'];
}

Library_ACCREDACTIONVIEWLIST_Output ($thisaccredscheme_id,$thisclubid);

Back_Navigator();
PageFooter("Default","Final");

?>
