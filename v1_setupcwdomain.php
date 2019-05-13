<?php # setupsqlmaintainout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

XH2("Setup WIzard");

PHP_Link_Output("","");
PHP_Link_Output("Setup Company Financial Categories","SETDEFAULTFINCATEGORIES");
PHP_Link_Output("Setup Allocation Rules","SETUPALLOCATION");
PHP_Link_Output("Setup Bank Accounts","SETUPBANK");
PHP_Link_Output("Setup Suppliers","SETUPSUPPLIER");
PHP_Link_Output("Setup Customers","SETUPCUSTOMER");
PHP_Link_Output("Setup Jobs","SETUPJOB");
PHP_Link_Output("Setup Mileage Favourite Destinations","SETUPMILEAGEFAVOURITE");
PHP_Link_Output("Setup Home Office Parameters","SETUPHOMEOFFICE");
PHP_Link_Output("Setup Payroll Status","SETUPCWPERSON");

XTABLEINVISIBLE();
XTR();
XTDTXT("Step 1");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCOMPANY");
XLINKTXT($link,"Setup Company");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_wwwpath'}."/DomainDashboard/SETUPCOMPANY.png";
XLINKIMGFLEX ($link,$imageurl);
X_TD();XTD();
XTDTXT("rafasdfa");
X_TD();
X_TR();
XTR();
XTDTXT("Step 2");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPALLOCATION");
XLINKTXT($link,"Setup Allocation Rules");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_wwwpath'}."/DomainDashboard/SETUPALLOCATION.png";
XLINKIMGFLEX ($link,$imageurl);
X_TD();XTD();
XTDTXT("rafasdfa");
X_TD();
X_TR();
XTABLE();

Back_Navigator();
PageFooter("Default","Final");




?>