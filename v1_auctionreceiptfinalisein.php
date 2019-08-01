<?php # auctioniteminputin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$inadmin_vendor = $_REQUEST['AdminVendor'];
$inauctionitem_vendorpersonid = $_REQUEST['auctionitem_vendorpersonid'];

$inauctionitem_datereceived = $_REQUEST["auctionitem_datereceived_YYYYpart"]."-".$_REQUEST["auctionitem_datereceived_MMpart"]."-".$_REQUEST["auctionitem_datereceived_DDpart"];  
$inauctionitem_receivedbypersonname = $_REQUEST['auctionitem_receivedbypersonname'];
$inauctionitem_datereceiptissued = $_REQUEST["auctionitem_datereceiptissued_YYYYpart"]."-".$_REQUEST["auctionitem_datereceiptissued_MMpart"]."-".$_REQUEST["auctionitem_datereceiptissued_DDpart"];  

$auctionitema = Get_Array('auctionitem',"50502012");
$submitteditemsa = array();
foreach ($auctionitema as $auctionitem_id) {
 Get_Data('auctionitem',"50502012",$auctionitem_id);
 if (($inauctionitem_vendorpersonid == $GLOBALS{'auctionitem_vendorpersonid'})&&($GLOBALS{'auctionitem_receivedbypersonname'} == "")) { 
  $GLOBALS{'auctionitem_datereceived'} = $inauctionitem_datereceived;
  if ($inauctionitem_receivedbypersonname == "") { $GLOBALS{'auctionitem_receivedbypersonname'} = $GLOBALS{'LOGIN_person_id'}; }  
  else { $GLOBALS{'auctionitem_receivedbypersonname'} = $inauctionitem_receivedbypersonname; }
  $GLOBALS{'auctionitem_datereceiptissued'} = $inauctionitem_datereceiptissued; 	
  Write_Data('auctionitem',"50502012",$auctionitem_id);
 }	
}

Auction_RECEIPTFINALISATION_Output ($inauctionitem_vendorpersonid,"Admin");

Back_Navigator();
PageFooter("Default","Final");

?>


