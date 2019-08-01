<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$bank_id = $_REQUEST["BankId"];
Get_Data("bank",$bank_id);
$GLOBALS{'bank_name'} = $_REQUEST["BankName"];
$GLOBALS{'bank_type'} = $_REQUEST["BankType"];
$GLOBALS{'bank_sort'} = $_REQUEST["BankSort"];
$GLOBALS{'bank_account'} = $_REQUEST["BankAccount"];
$GLOBALS{'bank_bankuploadid'} = $_REQUEST["BankBankuploadid"];
Write_Data("bank",$bank_id);

Fin_SETUPBANK_Output();
Back_Navigator();
PageFooter("Default","Final");

?>


