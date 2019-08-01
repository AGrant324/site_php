<?php # finallocatein.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();


 $tbanktxn_id = $_REQUEST["idinput"];
 Get_Data("banktxn",$tbanktxn_id);
 $GLOBALS{'banktxn_processstatus'} = "allocated"; 
 $GLOBALS{'banktxn_purpose'} = $_REQUEST["purposeinput"];
 $GLOBALS{'banktxn_txnfavouriteid'} = $GLOBALS{'banktxn_purpose'}.$_REQUEST["secondkeyinput"]; 
 $GLOBALS{'banktxn_comment'} = $_REQUEST["commentinput"];
 $GLOBALS{'banktxn_supplierid'} = $_REQUEST["supplieridinput"];
 $GLOBALS{'banktxn_paymenttype'} = $_REQUEST["paymenttypeinput"];
 $GLOBALS{'banktxn_vatrateid'} = $_REQUEST["vatrateidinput"];
 $GLOBALS{'banktxn_vat'} = $_REQUEST["vatinput"]; 	
 $GLOBALS{'banktxn_fincategoryid'} = $_REQUEST["fincategoryidinput"];
 $GLOBALS{'banktxn_customerid'} = $_REQUEST["customeridinput"];
 $GLOBALS{'banktxn_jobid'} = $_REQUEST["jobidinput"]; 	
 Write_Data("banktxn",$tbanktxn_id);

print "<br>finallocatein Update to $tbanktxn_id performed\n";

?>


