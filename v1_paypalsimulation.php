<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$business = $_REQUEST['business'];
$cmd = $_REQUEST['cmd'];
$item_name = $_REQUEST['item_name'];
$item_number = $_REQUEST['item_number'];
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$address1 = $_REQUEST['address1'];
$address2 = $_REQUEST['address2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$zip = $_REQUEST['zip'];
$night_phone_a = $_REQUEST['night_phone_a'];
$night_phone_b = $_REQUEST['night_phone_b'];
$amount = $_REQUEST['amount'];
$currency_code = $_REQUEST['currency_code'];
$return = $_REQUEST['return'];
$cancel_return = $_REQUEST['cancel_return'];

XH1("Paypal Simulator");

XTABLE();
XTR();XTDTXT("business");XTDTXT($business);X_TR();
XTR();XTDTXT("cmd");XTDTXT($cmd);X_TR();
XTR();XTDTXT("item_name");XTDTXT($item_name);X_TR();
XTR();XTDTXT("item_number");XTDTXT($item_number);X_TR();
XTR();XTDTXT("first_name");XTDTXT($first_name);X_TR();
XTR();XTDTXT("last_name");XTDTXT($last_name);X_TR();
XTR();XTDTXT("address1");XTDTXT($address1);X_TR();
XTR();XTDTXT("address2");XTDTXT($address2);X_TR();
XTR();XTDTXT("city");XTDTXT($city);X_TR();
XTR();XTDTXT("state");XTDTXT($state);X_TR();
XTR();XTDTXT("zip");XTDTXT($zip);X_TR();
XTR();XTDTXT("night_phone_a");XTDTXT($night_phone_a);X_TR();
XTR();XTDTXT("night_phone_b");XTDTXT($night_phone_b);X_TR();
XTR();XTDTXT("amount");XTDTXT($amount);X_TR();
XTR();XTDTXT("currency_code");XTDTXT($currency_code);X_TR();
XTR();XTDTXT("return");XTDTXT($return);X_TR();
XTR();XTDTXT("cancel_return");XTDTXT($cancel_return);X_TR();
X_TABLE();

XH4("Choose Action");
XBR();XLINKBUTTON ($return,"Accept");
XBR();XBR();XLINKBUTTON ($cancel_return,"Cancel");

Back_Navigator();
PageFooter("Default","Final");
