<?php # personloginin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_siteroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();
$inaccountident = $_REQUEST['AccountIdent'];
$inaccountpsw = $_REQUEST['AccountPsw'];
$validaccount_id = "";
if (strlen(strstr($inaccountident, "@"))>0) {
 $accounta = Get_Array('account');
 foreach (accounta as $account_id) {  
  Get_Data("account",$account_id);
  if ($inaccountident == $GLOBALS{'account_contactemail'}) {
   $clearpsw = $inaccountpsw;
   $encmembpsw = XCrypt($inaccountpsw,$account_id,"encrypt");
   if ($encmembpsw == $GLOBALS{'$account_contactpassword'}) {
    $validaccount_id = $account_id;    
    $GLOBALS{'LOGIN_account_id'} = $account_id;
   }
  }
 }
 if ($validaccount_id == "") {
   XH5("Login failed - Please check email and password");
 } else {
   Get_Data("account",$validaccount_id);	
 } 	
} else {
  XH5("Invalid email address");
  Domain_Setup_Login_Output();  
}  
if ($validaccount_id != "") {
  Domain_Setup1_Output(); 
}
Back_Navigator();
PageFooter("Default","Final");

?>

