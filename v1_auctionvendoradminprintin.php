<?php # auctionlotadminprintin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$GLOBALS{'IOERRORcode'} = "ACP001";
$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/vendorprint.rtf";
$GLOBALS{'IOERRORmessage'} = "$downloadfilename - unable to be created";
$handle = fopen($downloadfilename, "w"); 
fwrite($handle, '{\rtf1\ansi\deff0 {\fonttbl {\f0 Courier;}}'."\n"); 

$lotarray = array();
$auctionitema = Get_Array('auctionitem',"50502012");
foreach ($auctionitema as $auctionitem_id) {
 Get_Data('auctionitem',"50502012",$auctionitem_id);
 Check_Data('auctioncategory',$GLOBALS{'auctionitem_categoryid'});
 $lbits = explode(' ', $GLOBALS{'auctionitem_vendorfullname'}); 
 $namesort = end($lbits).$lbits[0]; 
 array_push($lotarray, $namesort."|".$GLOBALS{'auctionitem_id'});
}
sort($lotarray);
$oldauctioncategory_seq = "000";
foreach ($lotarray as $lotarrayelement) {	
 $lbits = explode('|', $lotarrayelement);		
 Get_Data('auctionitem',"50502012",$lbits[1]);
 if ($GLOBALS{'auctionitem_lotnumber'} == "") {$lotnumber = "__";} else {$lotnumber = $GLOBALS{'auctionitem_lotnumber'};}
 if ($GLOBALS{'auctionitem_lottitle'} != "") {$title = $GLOBALS{'auctionitem_lottitle'};} else {$title = $GLOBALS{'auctionitem_itemtitle'};} 
 if ($GLOBALS{'auctionitem_lotdescription'} != "") {$description = $GLOBALS{'auctionitem_lotdescription'};} else {$description = $GLOBALS{'auctionitem_itemdescription'};}     
 if ($GLOBALS{'auctionitem_vendordonation'} == "Yes") {$donation = "Donation";} else {$donation = "";}  
 if ($GLOBALS{'auctionitem_vendorsharepercentage'} == "50%") {$share = "50%";} else {$share = "";}
 if ($GLOBALS{'auctionitem_saletargetprice'} != 0) {$target = "T[£".$GLOBALS{'auctionitem_saletargetprice'}."]";} else {$target = "T[£".$GLOBALS{'auctionitem_vendorestimateprice'}."]";}
 if ($GLOBALS{'auctionitem_salereserveprice'} != 0) {$reserve = "R[£".$GLOBALS{'auctionitem_salereserveprice'}."]";} else {$reserve = "R[£".$GLOBALS{'auctionitem_vendorreserveprice'}."]";}
 fwrite($handle, '\b '.$GLOBALS{'auctionitem_vendorfullname'}." - ".$GLOBALS{'auctionitem_id'}."\b0 - ".$lotnumber." ".$GLOBALS{'auctionitem_categoryid'}." - ".$title.'  '.$description." ".'\b - '.$donation." ".$share." ".$reserve." ".$GLOBALS{'auctionitem_unsoldinstructions'}.'\b0'.'\line'."\n");   
 fwrite($handle, '\line'."\n");  
}
fwrite($handle, '}'."\n"); 
fclose($handle); 

Download_File ($downloadfilename,"delete");

?>


