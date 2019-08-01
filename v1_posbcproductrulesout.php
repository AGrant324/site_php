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


$inproduct_id = $_REQUEST["bcproduct_bcproductid"];

Get_Data("bcproduct",$inproduct_id);
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


$inproduct_id = $_REQUEST["bcproduct_bcproductid"];

Get_Data("bcproduct",$inproduct_id);
Pos_BCPRODUCTRULES_Output($inproduct_id);

Back_Navigator();
PopUpFooter();

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
