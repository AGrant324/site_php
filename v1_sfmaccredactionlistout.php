<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Library_ACCREDACTIONVIEWLIST_CSSJS ();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inaccredaction_schemeid = $_REQUEST['accredaction_schemeid'];
$inaccredaction_clubid = $_REQUEST['accredaction_clubid'];

Library_ACCREDACTIONVIEWLIST_Output ($inaccredaction_schemeid,$inaccredaction_clubid);

Back_Navigator();
PageFooter("Default","Final");

?>


	



