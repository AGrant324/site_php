<?php # finsetupuploadbankin.php

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


$bankupload_id = $_REQUEST["BankuploadId"];
Get_Data("bankupload",$bankupload_id);
$GLOBALS{'bankupload_name'} = $_REQUEST["BankuploadName"];
$GLOBALS{'bankupload_sortoffset'} = $_REQUEST["BankuploadSortOffset"];
$GLOBALS{'bankupload_sortfilter'} = $_REQUEST["BankuploadSortFilter"];
$GLOBALS{'bankupload_accountoffset'} = $_REQUEST["BankuploadAccountOffset"];
$GLOBALS{'bankupload_accountfilter'} = $_REQUEST["BankuploadAccountFilter"];
$GLOBALS{'bankupload_dateoffset'} = $_REQUEST["BankuploadDateOffset"];
$GLOBALS{'bankupload_dateformat'} = $_REQUEST["BankuploadDateFormat"];
$GLOBALS{'bankupload_txntypeoffset'} = $_REQUEST["BankuploadTxntypeOffset"];
$GLOBALS{'bankupload_descriptionoffset'} = $_REQUEST["BankuploadDescriptionOffset"];
$GLOBALS{'bankupload_debitoffset'} = $_REQUEST["BankuploadDebitOffset"];
$GLOBALS{'bankupload_debitfilter'} = $_REQUEST["BankuploadDebitFilter"];
$GLOBALS{'bankupload_creditoffset'} = $_REQUEST["BankuploadCreditOffset"];
$GLOBALS{'bankupload_creditfilter'} = $_REQUEST["BankuploadCreditFilter"];
$GLOBALS{'bankupload_balanceoffset'} = $_REQUEST["BankuploadBalanceOffset"];
$GLOBALS{'bankupload_header'} = $_REQUEST["BankuploadHeader"];
Write_Data("bankupload",$bankupload_id);

Fin_SETUPBANKUPLOADFORMATOLD_Output();
Back_Navigator();
PageFooter("Default","Final");

?>


