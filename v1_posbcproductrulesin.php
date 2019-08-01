<<<<<<< HEAD
<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$inproduct_id = $_REQUEST["product_id"];

Get_Data('bcproduct',$inproduct_id);
Check_Data('bcoptionset',$GLOBALS{'bcproduct_bcoptionsetname'});
if ($GLOBALS{'IOWARNING'} == "1") {
	Initialise_Data('bcoptionset');
}
for ($i = 1; $i <= 6; $i++) {
	if ($GLOBALS{'bcoptionset_bcoptionname'.$i} != "") {
		$inputname = str_replace(' ', '', $GLOBALS{'bcoptionset_bcoptionname'.$i});
		if( is_array($_REQUEST[$inputname])) {
			# one of checkboxes selected
			$GLOBALS{'bcproductrule_valuelist'} = Array2List($_REQUEST[$inputname]);
		} else {
			$GLOBALS{'bcproductrule_valuelist'} = "";
		}		
		Write_Data('bcproductrule',$inproduct_id,$GLOBALS{'bcoptionset_bcoptionname'.$i});
	}
}

Pos_BCPRODUCTRULES_Output($inproduct_id);

Back_Navigator();
PopUpFooter();

?>
=======
<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$inproduct_id = $_REQUEST["product_id"];

Get_Data('bcproduct',$inproduct_id);
Check_Data('bcoptionset',$GLOBALS{'bcproduct_bcoptionsetname'});
if ($GLOBALS{'IOWARNING'} == "1") {
	Initialise_Data('bcoptionset');
}
for ($i = 1; $i <= 6; $i++) {
	if ($GLOBALS{'bcoptionset_bcoptionname'.$i} != "") {
		$inputname = str_replace(' ', '', $GLOBALS{'bcoptionset_bcoptionname'.$i});
		if( is_array($_REQUEST[$inputname])) {
			# one of checkboxes selected
			$GLOBALS{'bcproductrule_valuelist'} = Array2List($_REQUEST[$inputname]);
		} else {
			$GLOBALS{'bcproductrule_valuelist'} = "";
		}		
		Write_Data('bcproductrule',$inproduct_id,$GLOBALS{'bcoptionset_bcoptionname'.$i});
	}
}

Pos_BCPRODUCTRULES_Output($inproduct_id);

Back_Navigator();
PopUpFooter();

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
