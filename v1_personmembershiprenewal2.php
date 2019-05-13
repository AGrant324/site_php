<?php # personmembershiprenewal2.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

Get_Person_Authority();

$intype = $_REQUEST['Type'];
$infreq = $_REQUEST['Freq'];
$inpaymentmethod = $_REQUEST['PaymentMethod'];
$includedpersonidlist = $_REQUEST['IncludedPersonIdList'];
$inpaymentgroup = "";
if((isset($_REQUEST['PaymentGroup']))&&($_REQUEST['PaymentGroup']!="")) { $inpaymentgroup = $_REQUEST['PaymentGroup']; }

if(isset($_REQUEST['PaymentMethod'])) {
	$inpaymentmethod = $_REQUEST['PaymentMethod'];
	if ($inpaymentmethod == "BankTransfer") { Person_MEMBERSHIPRENEWAL2BANK_Output($intype,$infreq,$includedpersonidlist,$inpaymentgroup); }
	if ($inpaymentmethod == "PayPal") { Person_MEMBERSHIPRENEWAL2PAYPAL_Output($intype,$infreq,$includedpersonidlist,$inpaymentgroup); }
	if ($inpaymentmethod == "Cheque") { Person_MEMBERSHIPRENEWAL2CHEQUE_Output($intype,$infreq,$includedpersonidlist,$inpaymentgroup); }
} else {
	XH4("No selection made - please go back and retry");
}





Back_Navigator();
PageFooter("Default","Final");

?>
