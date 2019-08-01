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

$inreceiptid = $_REQUEST["receipt_id"];
$indeletereceiptitemid = $_REQUEST["deletereceiptitem_id"];
Delete_Data('receiptitem',$indeletereceiptitemid);
Pos_RECEIPTRECALCULATE($inreceiptid);
Pos_RECEIPT_Output($inreceiptid);

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

$inreceiptid = $_REQUEST["receipt_id"];
$indeletereceiptitemid = $_REQUEST["deletereceiptitem_id"];
Delete_Data('receiptitem',$indeletereceiptitemid);
Pos_RECEIPTRECALCULATE($inreceiptid);
Pos_RECEIPT_Output($inreceiptid);

Back_Navigator();
PageFooter("Default","Final");

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
