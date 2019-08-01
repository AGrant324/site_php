<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

XH2("Post POS Sales");

Get_Data('pos','pos');
Get_Data('bcaccess','pos');
$localdir = $GLOBALS{'bcaccess_localstockrecordsfolder'};
$localfilename = $GLOBALS{'pos_posfeederid'}."-Sales.csv";
$remotedirurl = $GLOBALS{'bcaccess_stockrecordsfolderurl'};
$remotefilename = $GLOBALS{'pos_posfeederid'}."-Sales.csv";
$contenttype = 'text/csv';
$user = $GLOBALS{'bcaccess_webdavuser'};
$password = $GLOBALS{'bcaccess_webdavpassword'};
$localfile = Open_File_Write ($localdir."/".$localfilename);

$highestreceiptitemid = $GLOBALS{'pos_posfeederid'}."I00000";
$receiptitema = Get_Array('receiptitem');
foreach ($receiptitema as $receiptitemid) {
	if ($receiptitemid > $highestreceiptitemid) {
		Get_Data('receiptitem',$receiptitemid);
		$skubits = explode('-',$GLOBALS{'receiptitem_sku'});
		$productid = $skubits[0];
		$csvstring = "";
		$csvstring = $csvstring.$GLOBALS{'receiptitem_domainid'}.",";		
		$csvstring = $csvstring.$GLOBALS{'receiptitem_id'}.",";
		$csvstring = $csvstring.$GLOBALS{'receiptitem_receiptid'}.",";		
		$csvstring = $csvstring.$GLOBALS{'receiptitem_date'}.",";		
		$csvstring = $csvstring.$GLOBALS{'receiptitem_sku'}.",";
		$csvstring = $csvstring.$GLOBALS{'receiptitem_vatrateid'}.",";
		$csvstring = $csvstring.$GLOBALS{'receiptitem_grossamount'}.",";		
		$csvstring = $csvstring.$GLOBALS{'receiptitem_netamount'}.",";		
		$csvstring = $csvstring.$GLOBALS{'receiptitem_vatamount'}.",";		
		$csvstring = $csvstring.$GLOBALS{'receiptitem_orderstatus'}.",";		
		$csvstring = $csvstring.$GLOBALS{'receiptitem_quantity'}.",";	
		Write_File ($localfile,$csvstring);
	}
}
Close_File($localfile);
WebDav_Upload_File ($localdir, $localfilename, $contenttype, $remotedirurl, $remotefilename, $user, $password);

Back_Navigator();
PageFooter("Default","Final");

?>


