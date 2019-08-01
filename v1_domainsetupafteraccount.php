<<<<<<< HEAD
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_siteroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$inaccount_id = $_REQUEST['account_id'];
$inaccount_session = $_REQUEST['account_session'];

Get_Data('account_'.$inaccount_id);
if ($inaccount_session = $GLOBALS{'account_session'}) {
 Domain_Setup1_Output(); 
} else {
XH3("Invalid Account Session");
	
}
Back_Navigator();
PageFooter("Default","Final");

?>

=======
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_siteroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$inaccount_id = $_REQUEST['account_id'];
$inaccount_session = $_REQUEST['account_session'];

Get_Data('account_'.$inaccount_id);
if ($inaccount_session = $GLOBALS{'account_session'}) {
 Domain_Setup1_Output(); 
} else {
XH3("Invalid Account Session");
	
}
Back_Navigator();
PageFooter("Default","Final");

?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
