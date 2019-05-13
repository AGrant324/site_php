<?php # auctioniteminputin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Auction_ITEMINPUT_CSSJS ();
PageHeader("Default","Final");
Back_Navigator();

XH3("Receipt of items - Online Form");

$inprovisionalrootid = $_REQUEST['ProvisionalRootId'];
$innewrootid = $_REQUEST['NewRootId'];

$auctionitema = Get_Array('auctionitem',"50502012");
$found = "0";
$submitteditemsa = array();
$receiveditemsa = array();
foreach ($auctionitema as $auctionitem_id) {
 $changeauctionitem_id = $auctionitem_id;
 Get_Data('auctionitem',"50502012",$auctionitem_id);
 if (strlen(strstr($auctionitem_id,$inprovisionalrootid))>0) {
  $indexelement = str_replace($inprovisionalrootid, "", $auctionitem_id);
  $newauctionitem_id = $innewrootid.$indexelement;
  XBR();XTXT("$auctionitem_id updated with $newauctionitem_id");  	
  Write_Data('auctionitem',"50502012",$newauctionitem_id);     	
  Delete_Data('auctionitem',"50502012",$changeauctionitem_id);
  $found = "1";
 }
}
if ($found == "0") { 
 XH5("ERROR! - Provisional System Number not found - please try again");
 XHR();
 Auction_AUCTIONONLINERECEIPT_Output();  
}
else {
 Get_Data('person',$inprovisionalrootid);	 
 Auction_ITEMINPUT_Output ($inprovisionalrootid,"Admin");
}


Back_Navigator();
PageFooter("Default","Final");

?>


