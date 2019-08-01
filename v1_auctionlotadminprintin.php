<<<<<<< HEAD
<?php # auctionlotadminprintin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$GLOBALS{'IOERRORcode'} = "ACP001";
$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/lotprint.rtf";
$GLOBALS{'IOERRORmessage'} = "$downloadfilename - unable to be created";
$handle = fopen($downloadfilename, "w"); 
fwrite($handle, '{\rtf1\ansi\deff0 {\fonttbl {\f0 Courier;}}'."\n"); 

$lotarray = array();
$auctionitema = Get_Array('auctionitem',"50502012");
foreach ($auctionitema as $auctionitem_id) {
 Get_Data('auctionitem',"50502012",$auctionitem_id);
 Check_Data('auctioncategory',$GLOBALS{'auctionitem_categoryid'});
 if ($GLOBALS{'IOWARNING'} == "0") {
  array_push($lotarray, $GLOBALS{'auctioncategory_seq'}."|".$GLOBALS{'auctionitem_lotnumber'}."|".$GLOBALS{'auctionitem_id'});
 } else {
  array_push($lotarray, "S99"."|".$GLOBALS{'auctionitem_lotnumber'}."|".$GLOBALS{'auctionitem_id'}); 		
 }
}
sort($lotarray);
$oldauctioncategory_seq = "000";
foreach ($lotarray as $lotarrayelement) {	
 $lbits = explode('|', $lotarrayelement);		
 Get_Data('auctionitem',"50502012",$lbits[2]);
 Check_Data('auctioncategory',$GLOBALS{'auctionitem_categoryid'});
 if ($lbits[0] != $oldauctioncategory_seq) { 
    if ($oldauctioncategory_seq != "000") { fwrite($handle, '\page'."\n"); $pagecount = 0; }
    if ($lbits[0] != "S99") { fwrite($handle, '\line\b\ulth '.$GLOBALS{'auctioncategory_name'}.' \ul0\b0\line\line'."\n");}
    else { fwrite($handle, '\line\b\ulth '."Unassigned Category".' \ul0\b0\line\line'."\n"); }
 }  
 if ($GLOBALS{'auctionitem_lotnumber'} == "") {$lotnumber = "__";} else {$lotnumber = $GLOBALS{'auctionitem_lotnumber'};}
 fwrite($handle, '\b '.$lotnumber.' -  '."\n");
 if ($GLOBALS{'auctionitem_lottitle'} != "") {$title = $GLOBALS{'auctionitem_lottitle'};} else {$title = $GLOBALS{'auctionitem_itemtitle'};} 
 if ($GLOBALS{'auctionitem_lotdescription'} != "") {$description = $GLOBALS{'auctionitem_lotdescription'};} else {$description = $GLOBALS{'auctionitem_itemdescription'};}     
 if ($GLOBALS{'auctionitem_vendordonation'} == "Yes") {$donation = "Donation";} else {$donation = "";}  
 if ($GLOBALS{'auctionitem_vendorsharepercentage'} == "50%") {$share = "50%";} else {$share = "";}
 if ($GLOBALS{'auctionitem_saletargetprice'} != 0) {$target = "T[£".$GLOBALS{'auctionitem_saletargetprice'}."]";} else {$target = "T[£".$GLOBALS{'auctionitem_vendorestimateprice'}."]";}
 if ($GLOBALS{'auctionitem_salereserveprice'} != 0) {$reserve = "R[£".$GLOBALS{'auctionitem_salereserveprice'}."]";} else {$reserve = "R[£".$GLOBALS{'auctionitem_vendorreserveprice'}."]";}
 fwrite($handle, $title.'\b0  '.$description." ".'\b - '.$GLOBALS{'auctionitem_vendorfullname'}." - ".$donation." ".$share." ".$reserve." ".$GLOBALS{'auctionitem_unsoldinstructions'}." - ".$GLOBALS{'auctionitem_id'}.'\b0'.'\line'."\n");   
 fwrite($handle, '\line'."\n");
 $oldauctioncategory_seq = $lbits[0];    
}
fwrite($handle, '}'."\n"); 
fclose($handle); 

Download_File ($downloadfilename,"delete");

?>


=======
<?php # auctionlotadminprintin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$GLOBALS{'IOERRORcode'} = "ACP001";
$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/lotprint.rtf";
$GLOBALS{'IOERRORmessage'} = "$downloadfilename - unable to be created";
$handle = fopen($downloadfilename, "w"); 
fwrite($handle, '{\rtf1\ansi\deff0 {\fonttbl {\f0 Courier;}}'."\n"); 

$lotarray = array();
$auctionitema = Get_Array('auctionitem',"50502012");
foreach ($auctionitema as $auctionitem_id) {
 Get_Data('auctionitem',"50502012",$auctionitem_id);
 Check_Data('auctioncategory',$GLOBALS{'auctionitem_categoryid'});
 if ($GLOBALS{'IOWARNING'} == "0") {
  array_push($lotarray, $GLOBALS{'auctioncategory_seq'}."|".$GLOBALS{'auctionitem_lotnumber'}."|".$GLOBALS{'auctionitem_id'});
 } else {
  array_push($lotarray, "S99"."|".$GLOBALS{'auctionitem_lotnumber'}."|".$GLOBALS{'auctionitem_id'}); 		
 }
}
sort($lotarray);
$oldauctioncategory_seq = "000";
foreach ($lotarray as $lotarrayelement) {	
 $lbits = explode('|', $lotarrayelement);		
 Get_Data('auctionitem',"50502012",$lbits[2]);
 Check_Data('auctioncategory',$GLOBALS{'auctionitem_categoryid'});
 if ($lbits[0] != $oldauctioncategory_seq) { 
    if ($oldauctioncategory_seq != "000") { fwrite($handle, '\page'."\n"); $pagecount = 0; }
    if ($lbits[0] != "S99") { fwrite($handle, '\line\b\ulth '.$GLOBALS{'auctioncategory_name'}.' \ul0\b0\line\line'."\n");}
    else { fwrite($handle, '\line\b\ulth '."Unassigned Category".' \ul0\b0\line\line'."\n"); }
 }  
 if ($GLOBALS{'auctionitem_lotnumber'} == "") {$lotnumber = "__";} else {$lotnumber = $GLOBALS{'auctionitem_lotnumber'};}
 fwrite($handle, '\b '.$lotnumber.' -  '."\n");
 if ($GLOBALS{'auctionitem_lottitle'} != "") {$title = $GLOBALS{'auctionitem_lottitle'};} else {$title = $GLOBALS{'auctionitem_itemtitle'};} 
 if ($GLOBALS{'auctionitem_lotdescription'} != "") {$description = $GLOBALS{'auctionitem_lotdescription'};} else {$description = $GLOBALS{'auctionitem_itemdescription'};}     
 if ($GLOBALS{'auctionitem_vendordonation'} == "Yes") {$donation = "Donation";} else {$donation = "";}  
 if ($GLOBALS{'auctionitem_vendorsharepercentage'} == "50%") {$share = "50%";} else {$share = "";}
 if ($GLOBALS{'auctionitem_saletargetprice'} != 0) {$target = "T[£".$GLOBALS{'auctionitem_saletargetprice'}."]";} else {$target = "T[£".$GLOBALS{'auctionitem_vendorestimateprice'}."]";}
 if ($GLOBALS{'auctionitem_salereserveprice'} != 0) {$reserve = "R[£".$GLOBALS{'auctionitem_salereserveprice'}."]";} else {$reserve = "R[£".$GLOBALS{'auctionitem_vendorreserveprice'}."]";}
 fwrite($handle, $title.'\b0  '.$description." ".'\b - '.$GLOBALS{'auctionitem_vendorfullname'}." - ".$donation." ".$share." ".$reserve." ".$GLOBALS{'auctionitem_unsoldinstructions'}." - ".$GLOBALS{'auctionitem_id'}.'\b0'.'\line'."\n");   
 fwrite($handle, '\line'."\n");
 $oldauctioncategory_seq = $lbits[0];    
}
fwrite($handle, '}'."\n"); 
fclose($handle); 

Download_File ($downloadfilename,"delete");

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
