<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Pos_BCOPTIONVALUES_CSSJS();
PopUpHeader();
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$inbcoptionset_name = $_REQUEST["bcoptionset_name"];

Get_Data('bcoptionset',$inbcoptionset_name);
for ($i = 1; $i <= 6; $i++) {
	if ($GLOBALS{'bcoptionset_bcoptionname'.$i} != "") {
		$inputname = str_replace(' ', '', $GLOBALS{'bcoptionset_bcoptionname'.$i});
		if( is_array($_REQUEST[$inputname])) {
			# one of checkboxes selected
			$GLOBALS{'bcoptionsetrule_valuelist'} = Array2List($_REQUEST[$inputname]);
		} else {
			$GLOBALS{'bcoptionsetrule_valuelist'} = "";
		}		
		Write_Data('bcoptionsetrule',$inbcoptionset_name,$GLOBALS{'bcoptionset_bcoptionname'.$i});
	}
}

Pos_BCOPTIONSETRULES_Output($inbcoptionset_name);

Back_Navigator();
PopUpFooter();

?>


