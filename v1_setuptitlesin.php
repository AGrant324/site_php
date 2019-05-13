<?php # setupuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_setuproutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$GLOBALS{'domain_shortname'} = $_REQUEST["AccountShortName"];
$GLOBALS{'domain_longname'} = $_REQUEST["AccountLongName"];
$GLOBALS{'domain_weblock'} = $GLOBALS{'LOGIN_person_id'};
Write_Data("domain");

Webpage_TEMPLATEPUBLISHALL_Output();
Webpage_WEBPAGEPUBLISHALL_Output();

$GLOBALS{'domain_weblock'} = "";
Write_Data("domain");

PageHeader("Default","Final");
Back_Navigator;
XH5("New titles successfully applied");

Setup_TITLES_Output();

Back_Navigator;
PageFooter("Default","Final");

?>