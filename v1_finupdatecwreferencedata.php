<?php # finupdatecwreferencedata.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');
require_once('v1_siteroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


XH4("Update Reference Data");

SiteMasterDataXCopy("bankupload","");
SiteMasterDataXCopy("fincategory","useselected");
SiteMasterDataXCopy("fuelparm","");
SiteMasterDataXCopy("homeoffice","");
SiteMasterDataXCopy("mileageparm","");
# SiteMasterDataXCopy("processtemplate","");
# SiteMasterDataXCopy("tasktemplate","");
SiteMasterDataXCopy("txnfavourite","");
SiteMasterDataXCopy("txntemplate","");
SiteMasterDataXCopy("vatrate","");
SiteMasterDataXCopy("vatflatrate","");
SiteMasterDataXCopy("supplier","");
SiteMasterDataXCopy("customer","");

Fin_SetDefaultFinancialCategories ();

Back_Navigator();
PageFooter("Default","Final");

?>


