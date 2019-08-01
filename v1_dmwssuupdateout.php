<<<<<<< HEAD
<?php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Dmws_DMWSSUUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$indmwssu_id = $_REQUEST['dmwssu_id'];
$invisittype = $_REQUEST['VisitType'];
if(isset($_REQUEST['VisitType'])) {$invisittype = $_REQUEST['VisitType'];} else {$invisittype = "First";}

/*
$value = $_POST['dmwsvisit_newvisittype'];
if ($value == "Subsequent" || $value == "Discharge"){
    $invisittype = $value;
}
else{
    $invisittype = $_REQUEST['VisitType'];
}
*/

$invisitid = $_REQUEST['VisitId'];
// if New SU  $dmwssu_id="New", $thisvisittype="First", $thisvisitid="New"
// if New Visit  $dmwssu_id="SUId", $thisvisittype="First", $thisvisitid="New"

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Dmws_DMWSSUUPDATE_Output($indmwssu_id,$invisittype,$invisitid,"SUIN");

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
Dmws_DMWSSUUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$indmwssu_id = $_REQUEST['dmwssu_id'];
$invisittype = $_REQUEST['VisitType'];
if(isset($_REQUEST['VisitType'])) {$invisittype = $_REQUEST['VisitType'];} else {$invisittype = "First";}

/*
$value = $_POST['dmwsvisit_newvisittype'];
if ($value == "Subsequent" || $value == "Discharge"){
    $invisittype = $value;
}
else{
    $invisittype = $_REQUEST['VisitType'];
}
*/

$invisitid = $_REQUEST['VisitId'];
// if New SU  $dmwssu_id="New", $thisvisittype="First", $thisvisitid="New"
// if New Visit  $dmwssu_id="SUId", $thisvisittype="First", $thisvisitid="New"

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Dmws_DMWSSUUPDATE_Output($indmwssu_id,$invisittype,$invisitid,"SUIN");

Back_Navigator();
PageFooter("Default","Final");
?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
