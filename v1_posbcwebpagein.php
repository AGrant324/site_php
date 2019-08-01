<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inbcwebpage = $_REQUEST["BCWebPage"];
$inupdatehtml = $_REQUEST["UpdateHTML"];

XH2($inbcwebpage." insert");
Get_Data('bcaccess','pos');
if ($inbcwebpage == "Homepage") {
	$localdir = $GLOBALS{'bcaccess_localstockpagesfolder'};
	$localfilename = "homepageinsert.html";
	$remotedirurl = $GLOBALS{'bcaccess_homepagefolderurl'};
	$remotefilename = "homepageinsert.html";
}
if ($inbcwebpage == "Stockpage") {
	$localdir = $GLOBALS{'bcaccess_localstockpagesfolder'};
	$localfilename = "stockpageinsert.html";
	$remotedirurl = $GLOBALS{'bcaccess_stockpagesfolderurl'};
	$remotefilename = "stockpageinsert.html";
}
$contenttype = 'text/html';
$user = $GLOBALS{'bcaccess_webdavuser'};
$password = $GLOBALS{'bcaccess_webdavpassword'};
$localfile = Open_File_Write ($localdir."/".$localfilename);
Write_File ($localfile,$inupdatehtml);
Close_File($localfile);
WebDav_Upload_File ($localdir, $localfilename, $contenttype, $remotedirurl, $remotefilename, $user, $password);

print '<table border="1">';
XTR();
XTD();
print $inupdatehtml;
X_TD();
X_TR();
X_TABLE();

Back_Navigator();
PageFooter("Default","Final");

?>


