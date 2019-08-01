<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$categorya = Array(); # ARRAY DATA categoryname

array_push($categorya,"Express Delivery/Ladies Ballroom");
array_push($categorya,"Express Delivery/Ladies Latin");
array_push($categorya,"Express Delivery/Mens Ballroom");
array_push($categorya,"Express Delivery/Mens Latin");
array_push($categorya,"Express Delivery/Girls");
array_push($categorya,"Express Delivery/Boys");

XH2("Big Commerce Exporter - Step 3 of 3");

Get_Data('bcaccess','pos');
foreach ($categorya as $categoryelement) {	
 $categoryelementbits = explode('/',$categoryelement);
 # "Express Delivery/Ladies Latin" "Express Delivery/Boys"
 if (strlen(strstr($categoryelement,$GLOBALS{'bcaccess_productparsestring'})) >0) {	 
  $expresspagename = $categoryelement;
  $expresspagename = str_replace('/', '-', $expresspagename);
  $expresspagename = str_replace(' ', '_', $expresspagename);  
  #==== upload stock lists to big commerce ====================
  $localdir = $GLOBALS{'bcaccess_localstockpagesfolder'}; 
  $localfilename = $expresspagename.".html";
  $contenttype = "text/html";  
  $remotedirurl = $GLOBALS{'bcaccess_stockpagesfolderurl'};
  $remotefilename = $expresspagename.".html";
  $user = $GLOBALS{'bcaccess_webdavuser'};
  $password = $GLOBALS{'bcaccess_webdavpassword'};
  WebDav_Upload_File ($localdir, $localfilename, $contenttype, $remotedirurl, $remotefilename, $user, $password);
  // XPTXT($remotefilename);
 }
}

#==== upload product file to big commerce ====================
$productfilename = "products-".$GLOBALS{'yyyy'}."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'}."-upload.csv";
$localdir = $GLOBALS{'bcaccess_localproductimportfolder'};
$localfilename = $productfilename;
$contenttype = "text/csv";
$remotedirurl = $GLOBALS{'bcaccess_productimportfolderurl'};
$remotefilename = $productfilename;
$user = $GLOBALS{'bcaccess_webdavuser'};
$password = $GLOBALS{'bcaccess_webdavpassword'};
WebDav_Upload_File ($localdir, $localfilename, $contenttype, $remotedirurl, $remotefilename, $user, $password);
// XPTXT($remotefilename);

if ($GLOBALS{'IOWARNING'}  == "0") {
	XH5("PROCESS COMPLETED SUCCESSFULLY");
} else {
	XH5("THERE WAS A PROBLEM UPLOADING THE PRODUCT FILE");
}

Back_Navigator();
PageFooter("Default","Final");


?>
