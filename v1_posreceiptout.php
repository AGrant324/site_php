<<<<<<< HEAD
<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inreceipt_id = $_REQUEST["receipt_id"];

Get_Data('receipt',$inreceipt_id);
Pos_RECEIPT_Output($inreceipt_id);

Back_Navigator();
PageFooter("Default","Final");

?>


=======
<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inreceipt_id = $_REQUEST["receipt_id"];

Get_Data('receipt',$inreceipt_id);
Pos_RECEIPT_Output($inreceipt_id);

Back_Navigator();
PageFooter("Default","Final");

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
