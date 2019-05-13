<?php # auctionitempaperreceiptin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Auction_ITEMINPUT_CSSJS ();
PageHeader("Default","Final");
Back_Navigator();

$infname = $_REQUEST['PersonFName'];
$insname = $_REQUEST['PersonSName'];


$inemail = $_REQUEST['Email'];
$inhomephone = $_REQUEST['HomePhone'];
$inmobilephone = $_REQUEST['MobilePhone'];
$inaddr1 = $_REQUEST['Addr1'];
$inaddr2 = $_REQUEST['Addr2'];
$inaddr3 = $_REQUEST['Addr3'];
$inaddr4 = $_REQUEST['Addr4'];
$inpostcode = $_REQUEST['PostCode'];

$persona = Get_Array('person');
$personidfound = "0";
foreach ($persona as $person_id) {
 Get_Data("person",$person_id);
 if (($GLOBALS{'person_email1'} == $inemail)&&($inemail != "")) {$personidfound = $person_id;}
 if (($GLOBALS{'person_hometel'} == $inhomephone)&&($inhomephone != "")) {$personidfound = $person_id;} 
 if (($GLOBALS{'person_mobiletel'} == $inmobilephone)&&($inmobilephone != "")) {$personidfound = $person_id;}  
}
if ($personidfound != "0") {
 Get_Data("person",$personidfound);
 $GLOBALS{'person_fname'} = $infname;
 $GLOBALS{'person_sname'} = $insname;
 $GLOBALS{'person_email1'} = $inemail;
 $GLOBALS{'person_hometel'} = $inhomephone;
 $GLOBALS{'person_mobiletel'} = $inmobilephone; 
 $GLOBALS{'person_addr1'} = $inaddr1;
 $GLOBALS{'person_addr2'} = $inaddr2;
 $GLOBALS{'person_addr3'} = $inaddr3;
 $GLOBALS{'person_addr4'} = $inaddr4;
 $GLOBALS{'person_postcode'} = $inpostcode; 
 Write_Data('person',$personidfound); 
 XPTXT("$infname $insname already exists in database as ".'"'.$personidfound.'"');
} else {
 $suffixa = array("","1","2","3","4","5","6","7","8","9");	
 $sindex = 0;
 $personcreated = "0";
 while ($personcreated == "0") {		
  $infnamex = str_replace("'","",$infname);
  $insnamex = str_replace("'","",$insname);
  $person_id = strtolower(substr($infnamex,0,1).substr($insnamex,0,3).$suffixa[$sindex]);  
  Check_Data("person",$person_id);
  if ($GLOBALS{'IOWARNING'} == "1") {
   Initialise_Data('person');
   $infnamex = str_replace("'","",$infname);
   $insnamex = str_replace("'","",$insname);
   $person_id = strtolower(substr($infnamex,0,1).substr($insnamex,0,3).$suffixa[$sindex]);
   $GLOBALS{'person_fname'} = $infname;
   $GLOBALS{'person_sname'} = $insname;
   $GLOBALS{'person_email1'} = $inemail;
   $GLOBALS{'person_hometel'} = $inhomephone;
   $GLOBALS{'person_mobiletel'} = $inmobilephone; 
   $GLOBALS{'person_addr1'} = $inaddr1;
   $GLOBALS{'person_addr2'} = $inaddr2;
   $GLOBALS{'person_addr3'} = $inaddr3;
   $GLOBALS{'person_postcode'} = $inpostcode;
   $GLOBALS{'person_password'} = XCrypt($GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'},$person_id,"encrypt");
   Write_Data('person',$person_id);
   $personcreated = "1";
   XPTXT("$infname $insname added to database as ".'"'.$person_id.'"');
  }
  $sindex++;
 } 
}

$inauctionitem_vendorconditionsaccepted = $_REQUEST['auctionitem_vendorconditionsaccepted'];
$inauctionitem_unsoldinstructions = $_REQUEST['auctionitem_unsoldinstructions'];
Get_Data('person',$person_id); 

for ($formseq=1; $formseq<=20; $formseq++) {
 if ((isset($_REQUEST['Status'.$formseq]))&&
    (($_REQUEST['auctionitem_itemdescription'.$formseq] != "")||($_REQUEST['auctionitem_itemtitle'.$formseq] != ""))) { 	
  $instatus = $_REQUEST['Status'.$formseq];
  $inauctionitem_id = $_REQUEST['auctionitem_id'.$formseq];  
  $inauctionitem_itemtitle = $_REQUEST['auctionitem_itemtitle'.$formseq];  
  $inauctionitem_itemdescription = $_REQUEST['auctionitem_itemdescription'.$formseq];
  $inauctionitem_itemquantity = $_REQUEST['auctionitem_itemquantity'.$formseq];    
  $inauctionitem_vendorreserveprice = $_REQUEST['auctionitem_vendorreserveprice'.$formseq];  
  $inauctionitem_vendorshare = $_REQUEST['auctionitem_vendorshare'.$formseq];
  if ($instatus == "New") {Initialise_Data("auctionitem");}
  else {Get_Data('auctionitem',"50502012",$inauctionitem_id);}  
  $GLOBALS{'auctionitem_vendorpersonid'} = $person_id;
  $GLOBALS{'auctionitem_vendorfullname'} = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
  $GLOBALS{'auctionitem_itemtitle'} = $inauctionitem_itemtitle;
  $GLOBALS{'auctionitem_itemdescription'} = $inauctionitem_itemdescription;
  $GLOBALS{'auctionitem_itemquantity'} = $inauctionitem_itemquantity;
#  $GLOBALS{'auctionitem_vendorphoto'} = $inauctionitem_vendorphoto;
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
Auction_ITEMINPUT_Output($person_id,"Admin"); 

Back_Navigator();
PageFooter("Default","Final");

?>


