<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";    
require_once "v1_personroutines.php";

Get_Common_Parameters();
GlobalRoutine();

PopUpHeader();
Check_Session_Validity();

$accredcriteria_schemeid = $_REQUEST['accredcriteria_schemeid'];
$accredcriteria_clubid = $_REQUEST['accredcriteria_clubid'];
$accredcriteria_id = $_REQUEST['accredcriteria_id'];
$maintainorview = $_REQUEST['MaintainOrView'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Data("accredcriteria",$accredcriteria_schemeid,$accredcriteria_clubid,$accredcriteria_id);

XTABLEID("controlpopupsize");
XTR();
XTDHTXTFIXED("More Information","400");
X_TR(); 
XTR();
XTDTXTWIDTH($GLOBALS{'accredcriteria_help'},"400");
X_TR();
if ($maintainorview == "Maintain") {   
 XTR();
 XTDHTXTFIXED("Templates","400");
 X_TR(); 
 XTR();
 XTDTXTWIDTH($GLOBALS{'accredcriteria_templates'},"400");
 X_TR(); 
}
X_TABLE();	
PopUpFooter();
