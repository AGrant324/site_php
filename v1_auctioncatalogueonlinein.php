<?php # auctioniteminputin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');
Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'YUICSSOPTIONAL'} = "fonts,button,container,tabview";
$GLOBALS{'YUIJSOPTIONAL'} = "yahoo-dom-event,logger,animation,element,dragdrop,button,container,cookie,tabview";
$GLOBALS{'SITEJSOPTIONAL'} = "tabmenu";	
PageHeader("Default","Final");
XH2("Online Catalogue");
XTXT("Items shown in this online catalogue represent a provisional list as of the time of publication. ");
XTXT("The final set will be published in the catalogue available upon entry to the viewing days or on the day of the auction itself.");
XTXT("Items may be added or withdrawn before the date of the auction.");
XBR();XBR();
$lotarray = array();
$auctionitema = Get_Array('auctionitem',"50502012");
foreach ($auctionitema as $auctionitem_id) {
 Get_Data('auctionitem',"50502012",$auctionitem_id);
 Check_Data('auctioncategory',$GLOBALS{'auctionitem_categoryid'});
 if ($GLOBALS{'IOWARNING'} == "0") {
  array_push($lotarray, $GLOBALS{'auctioncategory_seq'}."|".$GLOBALS{'auctionitem_lotnumber'}."|".$GLOBALS{'auctionitem_id'});
 }
}
sort($lotarray);

XTABDIV('maintabmenu');
XTABHEADERCONTAINER();
$categorya = Get_Array_Hash_SortSelect('auctioncategory','auctioncategory_seq',"","");
foreach ($categorya as $auctioncategory_id) {
 Get_Data('auctioncategory',$auctioncategory_id);
 XTABHEADERITEM($GLOBALS{'auctioncategory_id'},$GLOBALS{'auctioncategory_name'},"");
}
X_TABHEADERCONTAINER();

XTABCONTENTCONTAINER();

$firstcategory = "1";
$oldauctioncategory_seq = "000";
foreach ($lotarray as $lotarrayelement) {	
 $lbits = explode('|', $lotarrayelement);		
 Get_Data('auctionitem',"50502012",$lbits[2]);
 Check_Data('auctioncategory',$GLOBALS{'auctionitem_categoryid'});
 if ($lbits[0] != $oldauctioncategory_seq) {
  if ($firstcategory == "1") { $firstcategory = "0"; } else { X_TABLE(); X_TABCONTENTITEM(); }
  XTABCONTENTITEM($GLOBALS{'auctioncategory_id'} ); 
  XH2($GLOBALS{'auctioncategory_name'}); 
  XTABLE();
  XTR();
  XTDHTXTFIXED("Lot #","40");
  XTDHTXTFIXED("Description","300");
  XTDHTXTFIXED("Photo","150");    
  X_TR();  
 }   
 if ($GLOBALS{'auctionitem_lotnumber'} == "") {$lotnumber = "__";} else {$lotnumber = $GLOBALS{'auctionitem_lotnumber'};}
 
 XTR();
 XTDTXT("<B>".$lotnumber."</B>");
 if ($GLOBALS{'auctionitem_lottitle'} != "") {$title = $GLOBALS{'auctionitem_lottitle'};} else {$title = $GLOBALS{'auctionitem_itemtitle'};} 
 if ($GLOBALS{'auctionitem_lotdescription'} != "") {$description = $GLOBALS{'auctionitem_lotdescription'};} else {$description = $GLOBALS{'auctionitem_itemdescription'};}     
 XTDTXT("<B>".$title."</B>"." ".$description);
 if ($GLOBALS{'auctionitem_vendorphoto'} != "") { XTD(); XIMGFLEX ($GLOBALS{'domainwwwurl'}."/domain_advertisers/".$GLOBALS{'auctionitem_vendorphoto'}); X_TD();}
 else { XTDTXT(""); } 
 X_TR();
 $oldauctioncategory_seq = $lbits[0];    
}
X_TABLE();
X_TABCONTENTITEM();
X_TABCONTENTCONTAINER ();
X_TABDIV ();
PageFooter("Default","Final");
?>


