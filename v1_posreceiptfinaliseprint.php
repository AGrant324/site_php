<<<<<<< HEAD
<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inreceiptid = $_REQUEST["receipt_id"];
Pos_RECEIPTFINALISEPRINT_Output($inreceiptid);

?>


=======
<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inreceiptid = $_REQUEST["receipt_id"];
Pos_RECEIPTFINALISEPRINT_Output($inreceiptid);

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
