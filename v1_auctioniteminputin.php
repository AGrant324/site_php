<<<<<<< HEAD
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

$inadmin_vendor = $_REQUEST['AdminVendor'];
$inauctionitem_vendorpersonid = $_REQUEST['auctionitem_vendorpersonid'];
$inauctionitem_vendorconditionsaccepted = $_REQUEST['auctionitem_vendorconditionsaccepted'];
$inauctionitem_unsoldinstructions = $_REQUEST['auctionitem_unsoldinstructions'];
Get_Data('person',$inauctionitem_vendorpersonid); 

for ($formseq=1; $formseq<=20; $formseq++) {
 if ((isset($_REQUEST['Status'.$formseq]))&&
    (($_REQUEST['auctionitem_itemdescription'.$formseq] != "")||($_REQUEST['auctionitem_itemtitle'.$formseq] != ""))) {
  $instatus = $_REQUEST['Status'.$formseq];
  $inauctionitem_id = $_REQUEST['auctionitem_id'.$formseq];  
  $inauctionitem_itemtitle = $_REQUEST['auctionitem_itemtitle'.$formseq];  
  $inauctionitem_itemdescription = $_REQUEST['auctionitem_itemdescription'.$formseq];
  $inauctionitem_itemquantity = $_REQUEST['auctionitem_itemquantity'.$formseq];
  $inauctionitem_vendorphoto = $_REQUEST['auctionitem_vendorphoto'.$formseq."_input"];
  $inimagefilepath = $_REQUEST['auctionitem_vendorphoto'.$formseq."_imagefilepath"];
  $inimagefilepath = expandSymbolicPath($inimagefilepath);          
  $inauctionitem_vendorreserveprice = $_REQUEST['auctionitem_vendorreserveprice'.$formseq];  
  $inauctionitem_vendorshare = $_REQUEST['auctionitem_vendorshare'.$formseq];
  
  if ($instatus == "New") {Initialise_Data("auctionitem");}
  else {Get_Data('auctionitem',"50502012",$inauctionitem_id);}
  
  $GLOBALS{'auctionitem_vendorpersonid'} = $inauctionitem_vendorpersonid;
  $GLOBALS{'auctionitem_vendorfullname'} = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
  $GLOBALS{'auctionitem_itemtitle'} = $inauctionitem_itemtitle;
  $GLOBALS{'auctionitem_itemdescription'} = $inauctionitem_itemdescription;
  $GLOBALS{'auctionitem_itemquantity'} = $inauctionitem_itemquantity; 
  $GLOBALS{'auctionitem_vendorphoto'} = FinaliseImageInput($inimagefilepath,$GLOBALS{'auctionitem_vendorphoto'},$inauctionitem_vendorphoto);  
  $GLOBALS{'auctionitem_vendorreserveprice'} = $inauctionitem_vendorreserveprice;
  if ($inauctionitem_vendorshare == "Donation") {
  	$GLOBALS{'auctionitem_vendorsharepercentage'} = "";
    $GLOBALS{'auctionitem_vendordonation'} = "Yes";  
  } else {
  	$GLOBALS{'auctionitem_vendorsharepercentage'} = "50%";
    $GLOBALS{'auctionitem_vendordonation'} = "";    	
  }
  $GLOBALS{'auctionitem_vendorconditionsaccepted'} = $inauctionitem_vendorconditionsaccepted;
  $GLOBALS{'auctionitem_unsoldinstructions'} = $inauctionitem_unsoldinstructions;   
  Write_Data('auctionitem',"50502012",$inauctionitem_id); 	
 }		
}
Auction_ITEMINPUT_Output($inauctionitem_vendorpersonid,$inadmin_vendor); 

if ($inadmin_vendor == "Admin") { Back_Navigator(); }
if ($inadmin_vendor == "Vendor") { AuctionVendor_Navigator(); }
PageFooter("Default","Final");

?>


=======
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

$inadmin_vendor = $_REQUEST['AdminVendor'];
$inauctionitem_vendorpersonid = $_REQUEST['auctionitem_vendorpersonid'];
$inauctionitem_vendorconditionsaccepted = $_REQUEST['auctionitem_vendorconditionsaccepted'];
$inauctionitem_unsoldinstructions = $_REQUEST['auctionitem_unsoldinstructions'];
Get_Data('person',$inauctionitem_vendorpersonid); 

for ($formseq=1; $formseq<=20; $formseq++) {
 if ((isset($_REQUEST['Status'.$formseq]))&&
    (($_REQUEST['auctionitem_itemdescription'.$formseq] != "")||($_REQUEST['auctionitem_itemtitle'.$formseq] != ""))) {
  $instatus = $_REQUEST['Status'.$formseq];
  $inauctionitem_id = $_REQUEST['auctionitem_id'.$formseq];  
  $inauctionitem_itemtitle = $_REQUEST['auctionitem_itemtitle'.$formseq];  
  $inauctionitem_itemdescription = $_REQUEST['auctionitem_itemdescription'.$formseq];
  $inauctionitem_itemquantity = $_REQUEST['auctionitem_itemquantity'.$formseq];
  $inauctionitem_vendorphoto = $_REQUEST['auctionitem_vendorphoto'.$formseq."_input"];
  $inimagefilepath = $_REQUEST['auctionitem_vendorphoto'.$formseq."_imagefilepath"];
  $inimagefilepath = expandSymbolicPath($inimagefilepath);          
  $inauctionitem_vendorreserveprice = $_REQUEST['auctionitem_vendorreserveprice'.$formseq];  
  $inauctionitem_vendorshare = $_REQUEST['auctionitem_vendorshare'.$formseq];
  
  if ($instatus == "New") {Initialise_Data("auctionitem");}
  else {Get_Data('auctionitem',"50502012",$inauctionitem_id);}
  
  $GLOBALS{'auctionitem_vendorpersonid'} = $inauctionitem_vendorpersonid;
  $GLOBALS{'auctionitem_vendorfullname'} = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
  $GLOBALS{'auctionitem_itemtitle'} = $inauctionitem_itemtitle;
  $GLOBALS{'auctionitem_itemdescription'} = $inauctionitem_itemdescription;
  $GLOBALS{'auctionitem_itemquantity'} = $inauctionitem_itemquantity; 
  $GLOBALS{'auctionitem_vendorphoto'} = FinaliseImageInput($inimagefilepath,$GLOBALS{'auctionitem_vendorphoto'},$inauctionitem_vendorphoto);  
  $GLOBALS{'auctionitem_vendorreserveprice'} = $inauctionitem_vendorreserveprice;
  if ($inauctionitem_vendorshare == "Donation") {
  	$GLOBALS{'auctionitem_vendorsharepercentage'} = "";
    $GLOBALS{'auctionitem_vendordonation'} = "Yes";  
  } else {
  	$GLOBALS{'auctionitem_vendorsharepercentage'} = "50%";
    $GLOBALS{'auctionitem_vendordonation'} = "";    	
  }
  $GLOBALS{'auctionitem_vendorconditionsaccepted'} = $inauctionitem_vendorconditionsaccepted;
  $GLOBALS{'auctionitem_unsoldinstructions'} = $inauctionitem_unsoldinstructions;   
  Write_Data('auctionitem',"50502012",$inauctionitem_id); 	
 }		
}
Auction_ITEMINPUT_Output($inauctionitem_vendorpersonid,$inadmin_vendor); 

if ($inadmin_vendor == "Admin") { Back_Navigator(); }
if ($inadmin_vendor == "Vendor") { AuctionVendor_Navigator(); }
PageFooter("Default","Final");

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
