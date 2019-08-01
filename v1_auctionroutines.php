<?php # finroutines.php

function Auction_VENDORLOGIN_Output () {
XH3("Vendor Login (If you have already registered)");
XTABLE();
XFORM("auctionvendorloginin.php","login");
XINSTDHID();
XTR();XTDTXT("Enter email address, mobile or telephone number");XTDINTXT("PersonIdent","","40","50");X_TR();
XTR();XTDTXT("Password");XTDINPSW("PersonPsw","","12","20");X_TR();
XTR();XTDTXT("&nbsp;");XTDINSUBMIT("Login");X_TR();
X_TABLE();
X_FORM();
$outtext = "I have forgotten my password";
$link = YPGMLINK("auctionvendorPWFout.php").YPGMSTDPARMS();
XLINKTXT($link,"$outtext");
}

function Auction_VENDORPWF_Output () {
XH3("Forgotten Password");
# # $helplink = "Person/Person_PWE_Output/person_pwe_output.html"; Help_Link;
XFORM("auctionvendorPWFin.php","forgotten");
XINSTDHID();
XTABLE();
XTR();XTDTXT("eMail");XTDINTXT("PersonEmail","","40","50");X_TR();
XTR();XTDTXT("&nbsp;");XTDINSUBMIT("Please email me my Personal Id and password");X_TR();
X_TABLE();
X_FORM();
}

function Auction_VENDORLOGINSELECT_Output ($parm0,$parm1) {
# $personidfound "Vendor"	
XH3("Please Select from the following options");
Auction_VendorLink_Output("Update my contact details","CONTACTDETAILSUPDATE",$parm0);
Auction_VendorLink_Output("Review/Update my auction items","ITEMINPUT",$parm0);   
}

function Auction_VendorLink_Output ($parm0, $parm1, $parm2) {
XTXT("&nbsp;-&nbsp;");
$link = YPGMLINK("auctionvendorloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId",$parm1).YPGMPARM("AdminVendor","Vendor").YPGMPARM("auctionitem_vendorpersonid",$parm2);
XLINKTXT($link,$parm0);XBR();
}

function AuctionVendor_Navigator () {
print '<P><A onClick="history.go(-1)"><u>&lt;Back</u></A>'; print "&nbsp;&nbsp;\n";
if ($GLOBALS{'LOGIN_session_id'} != "") {Go_Back_To_AuctionMenu("&lt;&lt;Options Menu","auctionvendorreloginin.php");} # CHECK
}

function Go_Back_To_AuctionMenu ($parm0,$parm1) { # text pgm menu
$link = YPGMLINK($parm1).YPGMSTDPARMS();
XLINKTXT($link,$parm0);	
}


function Auction_VENDORREGISTRATION_Output () {		
XH3("Vendor Registration (If this is your first time)");
XPTXT("Thankyou for helping the auction. The first step is to capture a few contact details.");
XPTXT("The second step then invites uou to submit the items for the auction");
XTXT("PS: If you have already registered, and simply wish to review or change any information please use the login screen at the bottom of the page.");
XBR();XBR();
XTABLE();
XFORM("auctionvendorregistrationin.php","login");
XINSTDHID();
XTR();XTDTXT("First Name");XTDINTXT("PersonFName","","18","30");X_TR();
XTR();XTDTXT("Surname");XTDINTXT("PersonSName","","18","30");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("Email");XTDINTXT("Email","","25","50");X_TR();
XTR();XTDTXT("Home Tel.");XTDINTXT("HomePhone","","12","30");X_TR();
XTR();XTDTXT("Mobile");XTDINTXT("MobilePhone","","12","30");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("House and Street");XTDINTXT("Addr1","","25","50");X_TR();
XTR();XTDTXT("Town");XTDINTXT("Addr2","","25","50");X_TR();
XTR();XTDTXT("County");XTDINTXT("Addr3","","25","50");X_TR();
XTR();XTDTXT("Country");XTDINTXT("Addr4","","25","50");X_TR();
XTR();XTDTXT("Post Code");XTDINTXT("PostCode","","8","8");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("Password");XTDINPSW("PersonPsw1","","12","20");X_TR();
XTR();XTDTXT("Repeat Password");XTDINPSW("PersonPsw2","","12","20");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("");XTDINSUBMIT("Proceed to submit items for the auction");X_TR();
X_TABLE();
X_FORM();
XBR();XBR();
Auction_VENDORLOGIN_Output ();
}

function Auction_CONTACTDETAILSUPDATE_Output () {		
XH3("Vendor contact details update");
XBR();XBR();
XTABLE();
XFORM("auctionvendorcontactdetailsin.php","login");
XINSTDHID();
XTR();XTDTXT("First Name");XTDINTXT("PersonFName",$GLOBALS{'person_fname'},"18","30");X_TR();
XTR();XTDTXT("Surname");XTDINTXT("PersonSName",$GLOBALS{'person_sname'},"18","30");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("Email");XTDINTXT("Email",$GLOBALS{'person_email1'},"25","50");X_TR();
XTR();XTDTXT("Home Tel.");XTDINTXT("HomePhone",$GLOBALS{'person_hometel'},"12","30");X_TR();
XTR();XTDTXT("Mobile");XTDINTXT("MobilePhone",$GLOBALS{'person_mobiletel'},"12","30");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("House and Street");XTDINTXT("Addr1",$GLOBALS{'person_addr1'},"25","50");X_TR();
XTR();XTDTXT("Town");XTDINTXT("Addr2",$GLOBALS{'person_addr2'},"25","50");X_TR();
XTR();XTDTXT("County");XTDINTXT("Addr3",$GLOBALS{'person_addr3'},"25","50");X_TR();
XTR();XTDTXT("Country");XTDINTXT("Addr4",$GLOBALS{'person_addr4'},"25","50");X_TR();
XTR();XTDTXT("Post Code");XTDINTXT("PostCode",$GLOBALS{'person_postcode'},"8","8");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("Password (if change required)");XTDINPSW("PersonPsw1","","12","20");X_TR();
XTR();XTDTXT("Repeat Password (if change required)");XTDINPSW("PersonPsw2","","12","20");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("");XTDINSUBMIT("Update Contact details");X_TR();
X_TABLE();
X_FORM();
}

function Auction_ITEMINPUT_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,calendarpopup,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
$GLOBALS{'SITEPOPUPHTML'} = "Calendar_Popup";
}

function Auction_ITEMINPUT_Output ($tpersonid,$admin_vendor) {	
if ($admin_vendor == "Vendor") {
 XH3("Step 1: Submit items for sale at the auction - $tpersonid");
 XPTXT("Thankyou for helping the auction. The following online form enables you to describe the items you have for sale.");
 XPTXT("Please print the form when you have finished and bring it along to the collection point together with the items for sale.");
}
if ($admin_vendor == "Admin") {
 XH3("Step 1: Please check Information entered");
}
XH5("Contact Information:");
XTABLE();
XTR();XTDFIXED("80");XTXT("Name");X_TD();XTDTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TR();
XTR();XTDTXT("House/Street");XTDTXT($GLOBALS{'person_addr1'});X_TR();
XTR();XTDTXT("Town/City");XTDTXT($GLOBALS{'person_addr2'});X_TR();
XTR();XTDTXT("County");XTDTXT($GLOBALS{'person_addr3'});X_TR();
XTR();XTDTXT("Country");XTDTXT($GLOBALS{'person_addr4'});X_TR();
XTR();XTDTXT("Postcode");XTDTXT($GLOBALS{'person_postcode'});X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("Home Tel");XTDTXT($GLOBALS{'person_hometel'});X_TR();
XTR();XTDTXT("Mobile");XTDTXT($GLOBALS{'person_mobiletel'});X_TR();
XTR();XTDTXT("EMail");XTDTXT($GLOBALS{'person_email1'});X_TR();
X_TABLE();
XBR();
$auctionitema = Get_Array('auctionitem',"50502012");
$formseq = 0;
$submitteditemsa = array();
$receiveditemsa = array();
foreach ($auctionitema as $auctionitem_id) {
 Get_Data('auctionitem',"50502012",$auctionitem_id);
 if (($tpersonid == $GLOBALS{'auctionitem_vendorpersonid'})&&($GLOBALS{'auctionitem_receivedbypersonname'} == "")) { array_push($submitteditemsa, $auctionitem_id);}  	
 if (($tpersonid == $GLOBALS{'auctionitem_vendorpersonid'})&&($GLOBALS{'auctionitem_receivedbypersonname'} != "")) { array_push($receiveditemsa, $auctionitem_id);}
}
XH3("New items for the auction");
XFORMUPLOAD("auctioniteminputin.php","ItemSubmission");
XINSTDHID();
XINHID("auctionitem_vendorpersonid",$tpersonid);
XINHID("AdminVendor",$admin_vendor); 
XTABLE();
XTR();
XTDHTXT("Item");	
XTDHTXT("Title<br>Description");	
XTDHTXT("Qty");
XTDHTXT("Vendor Reserve");	
XTDHTXT("50% Share/Donation");
XTDHTXT("Photograph<br>(Optional)");
X_TR();
$formseq = 1; $previtems = "0";
foreach ($submitteditemsa as $submitteditem) {
 Get_Data('auctionitem',"50502012",$submitteditem);	
 XTR();
 $prevseq = str_replace($tpersonid, "", $GLOBALS{'auctionitem_id'});
 XINHID("Status".$formseq,"Submitted");
 XINHID("auctionitem_id".$formseq,$submitteditem); 
 XTDTXT($prevseq);
 XTD();XINTXT("auctionitem_itemtitle".$formseq,$GLOBALS{'auctionitem_itemtitle'},"50","100");
 XBR();XINTEXTAREA("auctionitem_itemdescription".$formseq,$GLOBALS{'auctionitem_itemdescription'},"4","50");X_TD();
 XTDINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),"auctionitem_itemquantity".$formseq,$GLOBALS{'auctionitem_itemquantity'}); 
 XTDINTXT("auctionitem_vendorreserveprice".$formseq,$GLOBALS{'auctionitem_vendorreserveprice'},"8","8");
 $auctionitem_vendorshare = "50%";
 if ($GLOBALS{'auctionitem_vendordonation'} == "Yes") {$auctionitem_vendorshare = "Donation";} 
 XTDINSELECTHASH(List2Hash("50%,Donation"),"auctionitem_vendorshare".$formseq,$auctionitem_vendorshare);
 // XTDINIMAGECROP("auctionitem_vendorphoto".$formseq,$GLOBALS{'auctionitem_vendorphoto'},"GLOBALDOMAINWWWURL/domain_advertisers","GLOBALDOMAINWWWPATH/domain_advertisers","150","flex","Auction",$GLOBALS{'auctionitem_id'},"No","50"); 	
 // CHECK
 // =================== Slim Image Cropper Output =======================
 $imagefieldname = "auctionitem_vendorphoto".$formseq;
 $imageviewwidth = "300";
 $imagename = $GLOBALS{'auctionitem_vendorphoto'};
 $imageuploadto = "Auction";
 $imageuploadid = $GLOBALS{'auctionitem_id'};
 $imageuploadwidth = "150";
 $imageuploadheight = "flex";
 $imageuploadfixedsize = "";
 $imagethumbwidth = "100";
 XTD();XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);X_TD();
 X_TR();
 $formseq++;
}
if ($formseq > 1) {$previtems = "1"; $prevhighseq = str_replace($tpersonid, "", $submitteditem);}
else {$prevhighseq = 0;}
for ($i=1; $i<=6; $i++) {
 XTR();
 XINHID("Status".$formseq,"New");
 if ($admin_vendor == "Vendor") {
  XINHID("auctionitem_id".$formseq,$tpersonid.($prevhighseq+$i));  
  XTDTXT(($prevhighseq+$i)); 	
 } else {
  XTDINTXT("auctionitem_id".$formseq,"","8","8");		
 } 
 XTD();XINTXT("auctionitem_itemtitle".$formseq,"","50","100");XBR();XINTEXTAREA("auctionitem_itemdescription".$formseq,"","4","50");X_TD();
 XTDINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),"auctionitem_itemquantity".$formseq,"");   	 	
 XTDINTXT("auctionitem_vendorreserveprice".$formseq,"","8","8");	
 XTDINSELECTHASH(List2Hash("50%,Donation"),"auctionitem_vendorshare".$formseq,"");
 // XTDINIMAGECROP("auctionitem_vendorphoto".$formseq,"","GLOBALDOMAINWWWURL/domain_advertisers","GLOBALDOMAINWWWPATH/domain_advertisers","150","flex","Auction",$GLOBALS{'auctionitem_id'}.$formseq,"No","50");
 // CHECK
 // =================== Slim Image Cropper Output =======================
 $imagefieldname = "auctionitem_vendorphoto".$formseq;
 $imageviewwidth = "300";
 $imagename = $GLOBALS{'auctionitem_vendorphoto'};
 $imageuploadto = "Auction";
 $imageuploadid = $GLOBALS{'auctionitem_id'};
 $imageuploadwidth = "150";
 $imageuploadheight = "flex";
 $imageuploadfixedsize = "";
 $imagethumbwidth = "100";
 XTD();XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);X_TD();
 X_TR();
 $formseq++;
}
X_TABLE();
XBR();

XH5("Disposal of Goods:");
XTXT("If any of your goods remain UNSOLD on the 50/50 basis, please indicate your preference on their disposal. Any donated goods which remain unsold will be disposed of as per (b) below.");XBR();
$xhash = Lists2Hash("Retain,Dispose","a) I require the goods to be retained for collection as per the Guidance Notes.<br>,b) Goods may be disposed of at the Auctioneers discretion.");

if ($previtems == "1") {$auctionitem_unsoldinstructions = $GLOBALS{'auctionitem_unsoldinstructions'};} else {$auctionitem_unsoldinstructions = "";};
if ($auctionitem_unsoldinstructions == "") {$auctionitem_unsoldinstructions = "Retain";}
XINRADIOHASH($xhash,"auctionitem_unsoldinstructions",$auctionitem_unsoldinstructions);
XH5("Conditions of Sale:");
if ($previtems == "1") {$checked = "checked";} else {$checked = "";}
XINCHECKBOX("auctionitem_vendorconditionsaccepted","Yes",$checked,"I agree to the conditions of Sale");
XBR();XBR();
XINSUBMIT("Make any updates and review the results");
X_FORM();
XBR();XHR();XBR();

if ($admin_vendor == "Admin") { # Admin Receipt Finalisation
 XH3("Step 2: Finalise");		
 XFORM("auctionreceiptfinalisein.php","Finalisation");
 XINSTDHID();
 XINHID("AdminVendor",$admin_vendor);  
 XINHID("auctionitem_vendorpersonid",$tpersonid);
 XTABLE();
 XTR();XTDTXT("Date Received");XTDINDATEYYYY_MM_DD("auctionitem_datereceived",$GLOBALS{'currentYYYY-MM-DD'});X_TR();
 XTR();XTDTXT("Received by");XTDINTXT("auctionitem_receivedbypersonname","","18","30");X_TR(); 
 XTR();XTDTXT("Date Receipt Issued");XTDINDATEYYYY_MM_DD("auctionitem_datereceiptissued",$GLOBALS{'currentYYYY-MM-DD'});X_TR();
 XTR();XTDTXT("");XTDINSUBMIT("Finalise Receipt Process");X_TR();  
 X_TABLE();
 X_FORM();  
}

if ($admin_vendor == "Vendor") { # Vendor Print Finalisation
 XH3("Step 2: Print Form");	
 XFORM("auctionvendorfinalisein.php","Finalisation");
 XINSTDHID();
 XINHID("AdminVendor",$admin_vendor);  
 XINHID("auctionitem_vendorpersonid",$tpersonid);
 XINSUBMIT("Finish and Print");  
 X_TABLE();
 X_FORM();  
}

if (empty($receiveditemsa)) {} else {
 XH3("Items already received");
 XTABLE();
 XTR();
 XTDHTXT("Item");	
 XTDHTXT("Title<br>Description");
 XTDHTXT("Qty"); 	
 XTDHTXT("Vendor Reserve");	
 XTDHTXT("Share Sale"); 	
 XTDHTXT("Donation");
 # XTDHTXT("Photograph<br>(Optional)");
 X_TR();		
 foreach ($receiveditemsa as $receiveditem) {
  Get_Data('auctionitem',"50502012",$receiveditem);	 	
  XTR();
  XTDTXT($receiveditem);
  XTDFIXED("400");XTXT($GLOBALS{'auctionitem_itemtitle'});
  XBR();XTABLE();XTR();XTDFIXED("400");XTXT($GLOBALS{'auctionitem_itemdescription'});X_TD();X_TR();X_TABLE();X_TD();
  XTDTXT($GLOBALS{'auctionitem_itemquantity'}); 
  XTDTXT($GLOBALS{'auctionitem_vendorreserveprice'});	
  XTDTXT($GLOBALS{'auctionitem_vendorsharepercentage'});
  XTDTXT($GLOBALS{'auctionitem_vendordonation'});
  # XTDLINKTXT("","Upload Photo"); 	 	
  X_TR();
 }
 X_TABLE();	
}
// Image_Popup();  CHECK
// Calendar_Popup();
}

function Auction_ITEMINPUTFINALISATION_CSSJS () {
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,calendarpopup";
$GLOBALS{'SITEPOPUPHTML'} = "Calendar_Popup";
}

function Auction_ITEMINPUTFINALISATION_Output ($tpersonid,$admin_vendor) {
XH3("Thank You -  Please print this page and bring it with you");

Get_Data('person',$tpersonid); 
XBR();
XTXT("Provisional System Number = ".$tpersonid);
XBR();XBR();

XTABLE();
XTR();XTDFIXED("80");XTXT("Name");X_TD();XTDTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TR();
XTR();XTDTXT("House/Street");XTDTXT($GLOBALS{'person_addr1'});X_TR();
XTR();XTDTXT("Town/City");XTDTXT($GLOBALS{'person_addr2'});X_TR();
XTR();XTDTXT("County");XTDTXT($GLOBALS{'person_addr3'});X_TR();
XTR();XTDTXT("Country");XTDTXT($GLOBALS{'person_addr4'});X_TR();
XTR();XTDTXT("Postcode");XTDTXT($GLOBALS{'person_postcode'});X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("Home Tel");XTDTXT($GLOBALS{'person_hometel'});X_TR();
XTR();XTDTXT("Mobile");XTDTXT($GLOBALS{'person_mobiletel'});X_TR();
XTR();XTDTXT("EMail");XTDTXT($GLOBALS{'person_email1'});X_TR();
X_TABLE();
XBR();

XTABLE();
XTR();
XTDHTXT("Item");	
XTDHTXT("Title<br>Description");	
XTDHTXT("Qty");
XTDHTXT("Vendor Reserve");	
XTDHTXT("Share Sale"); 	
XTDHTXT("Donation");
# XTDHTXT("Photograph<br>(Optional)");
XTDHTXT("Unique Ref Number<br>(Office Use Only)");
XTDHTXT("Lot Number<br>(Office Use Only)");
X_TR();

$auctionitema = Get_Array('auctionitem',"50502012");
$submitteditemsa = array();
$receiveditemsa = array();
foreach ($auctionitema as $auctionitem_id) {
 Get_Data('auctionitem',"50502012",$auctionitem_id);
 if (($tpersonid == $GLOBALS{'auctionitem_vendorpersonid'})&&($GLOBALS{'auctionitem_receivedbypersonname'} == "")) { array_push($submitteditemsa, $auctionitem_id);}  	
 if (($tpersonid == $GLOBALS{'auctionitem_vendorpersonid'})&&($GLOBALS{'auctionitem_receivedbypersonname'} != "")) { array_push($receiveditemsa, $auctionitem_id);}
}

foreach ($submitteditemsa as $submitteditem) {
 Get_Data('auctionitem',"50502012",$submitteditem);	
 XTR();
 $prevseq = str_replace($tpersonid, "", $GLOBALS{'auctionitem_id'});
 XTDTXT($prevseq);
 XTDFIXED("400");XTXT($GLOBALS{'auctionitem_itemtitle'});
 XBR();XTABLE();XTR();XTDFIXED("400");XTXT($GLOBALS{'auctionitem_itemdescription'});X_TD();X_TR();X_TABLE();X_TD();
 XTDTXT($GLOBALS{'auctionitem_itemquantity'}); 
 XTDTXT($GLOBALS{'auctionitem_vendorreserveprice'});	
 XTDTXT($GLOBALS{'auctionitem_vendorsharepercentage'});
 XTDTXT($GLOBALS{'auctionitem_vendordonation'});
 # XTDLINKTXT("","Upload Photo");
 XTDTXT("");
 XTDTXT("");   	 	
 X_TR();
}
X_TABLE();
XBR();
XTABLE();
XTR();XTDTXT("Conditions of Sale accepted");XTDTXT($GLOBALS{'auctionitem_vendorconditionsaccepted'});X_TR();
XTR();XTDTXT("Instructions for unsold items");XTDTXT($GLOBALS{'auctionitem_unsoldinstructions'});X_TR();
X_TABLE();
XBR();XBR();
XHR();XBR();
XTXT("Office Use Only");
XTABLE();
XTR();XTDTXTWIDTH("Date form received:","350");XTDTXTWIDTH("Received by:","350");X_TR();
XTR();XTDTXTWIDTH("Copy form given to vendor:","350");XTDTXTWIDTH("Form Reference Number Allocated:","350");X_TR();
X_TABLE();


XBR();
if (empty($receiveditemsa)) {} else {
 XH3("Items already received");
 XTABLE();
 XTR();
 XTDHTXT("Item");	
 XTDHTXT("Title<br>Description");
 XTDHTXT("Qty"); 	
 XTDHTXT("Vendor Reserve");	
 XTDHTXT("Share Sale"); 	
 XTDHTXT("Donation");
 # XTDHTXT("Photograph<br>(Optional)");
 X_TR();		
 foreach ($receiveditemsa as $receiveditem) {
  Get_Data('auctionitem',"50502012",$receiveditem);	 	
  XTR();
  XTDTXT($receiveditem);
  XTDFIXED("400");XTXT($GLOBALS{'auctionitem_itemtitle'});
  XBR();XTABLE();XTR();XTDFIXED("400");XTXT($GLOBALS{'auctionitem_itemdescription'});X_TD();X_TR();X_TABLE();X_TD();
  XTDTXT($GLOBALS{'auctionitem_itemquantity'}); 
  XTDTXT($GLOBALS{'auctionitem_vendorreserveprice'});	
  XTDTXT($GLOBALS{'auctionitem_vendorsharepercentage'});
  XTDTXT($GLOBALS{'auctionitem_vendordonation'});
  X_TR();
 }
 X_TABLE();	
}
// Calendar_Popup();
}

function Auction_AUCTIONPAPERRECEIPT_Output() {
XH3("Receive items for auction - from paper form");
XPTXT("Please enter information from the form so that it can be recorded in the database.");
XBR();XBR();
XTABLE();
XFORM("auctionitempaperreceiptin.php","itemsubmission");
XINSTDHID();
XTR();XTDTXT("First Name");XTDINTXT("PersonFName","","18","30");X_TR();
XTR();XTDTXT("Surname");XTDINTXT("PersonSName","","18","30");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("Email");XTDINTXT("Email","","25","50");X_TR();
XTR();XTDTXT("Home Tel.");XTDINTXT("HomePhone","","12","30");X_TR();
XTR();XTDTXT("Mobile");XTDINTXT("MobilePhone","","12","30");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("House and Street");XTDINTXT("Addr1","","25","50");X_TR();
XTR();XTDTXT("Town");XTDINTXT("Addr2","","25","50");X_TR();
XTR();XTDTXT("County");XTDINTXT("Addr3","","25","50");X_TR();
XTR();XTDTXT("Country");XTDINTXT("Addr4","","25","50");X_TR();
XTR();XTDTXT("Post Code");XTDINTXT("PostCode","","8","8");X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();;
X_TABLE();
XBR();
XTABLE();
XTR();
XTDHTXT("Item");
XTDHTXT("Title<br>Description");	
XTDHTXT("Qty");
XTDHTXT("Vendor Reserve");	
XTDHTXT("50% Share/Donation");
# XTDHTXT("Photograph<br>(Optional)");
X_TR();
$formseq = 1;
for ($i=1; $i<=6; $i++) {
 XTR();
 XINHID("Status".$formseq,"New");
 XTDINTXT("auctionitem_id".$formseq,"","8","8");
 XTD();XINTXT("auctionitem_itemtitle".$formseq,"","50","100");XBR();XINTEXTAREA("auctionitem_itemdescription".$formseq,"","4","50");X_TD();
 XTDINSELECTHASH(List2Hash("1,2,3,4,5,6,7,8,9,10,11,12"),"auctionitem_itemquantity".$formseq,"");   	 	
 XTDINTXT("auctionitem_vendorreserveprice".$formseq,"","8","8");	
 XTDINSELECTHASH(List2Hash("50%,Donation"),"auctionitem_vendorshare".$formseq,"");
 # XTDLINKTXT("","Upload Photo"); 	 	
 X_TR();
 $formseq++;
}
X_TABLE();
XBR();
$xhash = Lists2Hash("Retain,Dispose","a) Vendor requires the goods to be retained for collection as per the Guidance Notes.<br>,b) Goods may be disposed of at the Auctioneers discretion.");
$auctionitem_unsoldinstructions = "Retain";
XINRADIOHASH($xhash,"auctionitem_unsoldinstructions",$auctionitem_unsoldinstructions);
XBR();XBR();
XINCHECKBOX("auctionitem_vendorconditionsaccepted","Yes","","Vendor has agreed to Conditions of Sale");
XBR();XBR();
XINSUBMIT("Submit");
X_FORM();

XBR();XBR();
XFORM("personreloginin.php","Finalisation");
XINSTDHID();
XINSUBMIT("Finish");
X_FORM();
Calendar_Popup();
// Image_Popup(); CHECK
}

function Auction_AUCTIONONLINERECEIPT_Output() {
XH3("Receive items for auction - following online entry of details");
XPTXT('Please enter the "provisional" reference number and the "new" reference number for the items');
XBR();
XTABLE();
XFORM("auctionitemonlinereceiptin.php","itemsubmission");
XINSTDHID();
XTR();XTDTXT("Provisional System Number");XTDINTXT("ProvisionalRootId","","8","30");X_TR();
XTR();XTDTXT("New Reference");XTDINTXT("NewRootId","","8","30");X_TR();
XTR();XTDTXT("");XTDINSUBMIT("Show Items");X_TR();
X_TABLE();
X_FORM();  
}

function Auction_RECEIPTFINALISATION_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqueryconfirm,jqdatatablesmin";
}

function Auction_RECEIPTFINALISATION_Output ($tpersonid,$admin_vendor) { 
Get_Data('person',$tpersonid);
XH3("Summary of all items received from ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}); 
XTABLE();
XTR();XTDFIXED("80");XTXT("Name");X_TD();XTDTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TR();
XTR();XTDTXT("House/Street");XTDTXT($GLOBALS{'person_addr1'});X_TR();
XTR();XTDTXT("Town/City");XTDTXT($GLOBALS{'person_addr2'});X_TR();
XTR();XTDTXT("County");XTDTXT($GLOBALS{'person_addr3'});X_TR();
XTR();XTDTXT("Country");XTDTXT($GLOBALS{'person_addr4'});X_TR();
XTR();XTDTXT("Postcode");XTDTXT($GLOBALS{'person_postcode'});X_TR();
XTR();XTDTXT("");XTDTXT("");X_TR();
XTR();XTDTXT("Home Tel");XTDTXT($GLOBALS{'person_hometel'});X_TR();
XTR();XTDTXT("Mobile");XTDTXT($GLOBALS{'person_mobiletel'});X_TR();
XTR();XTDTXT("EMail");XTDTXT($GLOBALS{'person_email1'});X_TR();
X_TABLE();
XBR();

$auctionitema = Get_Array('auctionitem',"50502012");
$submitteditemsa = array();
$receiveditemsa = array();
foreach ($auctionitema as $auctionitem_id) {
 Get_Data('auctionitem',"50502012",$auctionitem_id);
 if (($tpersonid == $GLOBALS{'auctionitem_vendorpersonid'})&&($GLOBALS{'auctionitem_receivedbypersonname'} != "")) { array_push($receiveditemsa, $auctionitem_id);}
}

XBR();
if (empty($receiveditemsa)) {} else {
 XTABLE();
 XTR();
 XTDHTXT("Item");	
 XTDHTXT("Title<br>Description");
 XTDHTXT("Qty"); 	
 XTDHTXT("Vendor Reserve");	
 XTDHTXT("Share Sale"); 	
 XTDHTXT("Donation");
 X_TR();		
 foreach ($receiveditemsa as $receiveditem) {
  Get_Data('auctionitem',"50502012",$receiveditem);	 	
  XTR();
  XTDTXT($receiveditem);
  XTDFIXED("400");XTXT($GLOBALS{'auctionitem_itemtitle'});
  XBR();XTABLE();XTR();XTDFIXED("400");XTXT($GLOBALS{'auctionitem_itemdescription'});X_TD();X_TR();X_TABLE();X_TD();
  XTDTXT($GLOBALS{'auctionitem_itemquantity'}); 
  XTDTXT($GLOBALS{'auctionitem_vendorreserveprice'});	
  XTDTXT($GLOBALS{'auctionitem_vendorsharepercentage'});
  XTDTXT($GLOBALS{'auctionitem_vendordonation'});
  X_TR();
 }
 X_TABLE();	
}
}

function Auction_SETUPAUCTIONEVENT_Output() {
$parm0 = "Auction Event|auctionevent||auctionevent_id|auctionevent_id|Yes|No";
$parm1 = "";
$parm1 = $parm1."auctionevent_id|Yes|Event Id|100|Yes|Event Id|KeyText,8,8^";
$parm1 = $parm1."auctionevent_title|Yes|Description|150|Yes|Description|InputText,50,90^";
$parm1 = $parm1."auctionevent_Current|Yes|Current Auction|150|Yes|Current Auction|InputSelectFromList,Yes+No^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Auction_SETUPAUCTIONCATEGORY_Output() {
$parm0 = "Auction Category|auctioncategory||auctioncategory_id|auctioncategory_id|25|No";
$parm1 = "";
$parm1 = $parm1."auctioncategory_id|Yes|Event Id|100|Yes|Event Id|KeyText,8,8^";
$parm1 = $parm1."auctioncategory_name|Yes|Description|150|Yes|Description|InputText,50,90^";
$parm1 = $parm1."auctioncategory_seq|Yes|Seq|150|Yes|Sequence|InputText,8,8^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Auction_MANAGEAUCTIONINPUTS_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqueryconfirm,calendarpopup,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup";
$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,Calendar_Popup";	
}

function Auction_MANAGEAUCTIONINPUTS_Output() {
$parm0 = "Manage Auction Inputs|auctionitem["."50502012"."]|auctioncategory|auctionitem_id|Auction Item Id|8|8|auctionitem_id|25||No";	
$parm1 = "";
$parm1 = $parm1."auctionitem_id|Yes|Item|40|Yes|Auction Item Id|InputText,25,50^";
$parm1 = $parm1."auctionitem_vendorpersonid|No|Vendor Id|50|Yes|Vendor Id|InputText,25,50^";
$parm1 = $parm1."auctionitem_vendorfullname|Yes|Name|50|Yes|Vendor Name|InputText,25,50^";
$parm1 = $parm1."auctionitem_itemtitle|Yes|Title|70|Yes|Item Short Description|InputText,25,50^";
$parm1 = $parm1."auctionitem_itemdescription|No|Description|60|Yes|Item Description|InputText,50,200^";
$parm1 = $parm1."auctionitem_itemquantity|Yes|Qty|20|Yes|Quantity|InputSelectFromList,1+2+3+4+5+6+7+8+9+10+11+12^";
$parm1 = $parm1."auctionitem_vendorconditionsaccepted|No|Conditions Accepted|50|Yes|Conditions Accepted|InputSelectFromList,Yes+No^";
$parm1 = $parm1."auctionitem_unsoldinstructions|No|Unsold|50|Yes|Unsold Instructions|InputSelectFromList,Retain+Dispose^";
$parm1 = $parm1."auctionitem_vendorphoto|Yes|Photo|30|Yes|Photo|InputImage,GLOBALDOMAINWWWURL/domain_advertisers,GLOBALDOMAINWWWPATH/domain_advertisers,150,flex,Auction,auctionitem_id^";
# $parm1 = $parm1."auctionitem_datereceived|Yes|Date Received|50|Yes|Date Received|InputDate^";
$parm1 = $parm1."auctionitem_receivedbypersonname|Yes|Rec By|50|Yes|Received By|InputText,25,50^";
# $parm1 = $parm1."auctionitem_datereceiptissued|No|Date Receipted|50|Yes|Date Receipted|InputDate^";
# $parm1 = $parm1."auctionitem_vendorestimateprice|Yes|Value|50|Yes|Estimated Value|InputText,10,10^";
$parm1 = $parm1."auctionitem_vendorreserveprice|Yes|Reserve|50|Yes|Vendor Reserve|InputText,10,10^";
$parm1 = $parm1."auctionitem_vendorsharepercentage|Yes|Share%|45|Yes|Vendor Share%|InputSelectFromList,50%+0%^";
$parm1 = $parm1."auctionitem_vendordonation|Yes|Donation|50|Yes|Donation|InputSelectFromList,Yes+No^";
$parm1 = $parm1."auctionitem_suitabilityforsale|Yes|Suitable|40|Yes|Suitability|InputSelectFromList,Yes+No^";
$parm1 = $parm1."auctionitem_comments|Yes|Comments|70|Yes|Comments|InputText,50,100^";
$parm1 = $parm1."auctionitem_categoryid|Yes|Category|60|Yes|Category|InputSelectFromTable,auctioncategory,auctioncategory_id,auctioncategory_name,auctioncategory_id^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|55|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
$p0 = "person_id|person_sname|person_fname;";
$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
$p2 =  "program,Search,Update,personCHANGEin.php,,70";
$p3 =  "person_id";
$p4 =  "all";
$p5 =  "person_change,center,center,900,900";
$p6 =  "view";
$p7 =  "buildfulllist"; 
$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Auction_MANAGEAUCTIONCATALOGUE_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,calendarpopup,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,Calendar_Popup";
}

function Auction_MANAGEAUCTIONCATALOGUE_Output() {
$parm0 = "Manage Auction Catalogue|auctionitem["."50502012"."]|auctioncategory|auctionitem_id|auctionitem_id|25|No";	
$parm1 = "";
$parm1 = $parm1."auctionitem_id|Yes|Item Id|40|Yes|Auction Item Id|KeyText,8,8^";
$parm1 = $parm1."auctionitem_vendorpersonid|No|Name|50|Yes|Vendor Name|InputText,25,50^";
$parm1 = $parm1."auctionitem_vendorfullname|Yes|Name|50|Yes|Vendor Name|InputText,25,50^";
$parm1 = $parm1."auctionitem_itemtitle|Yes|Title|50|Yes|Item Short Description|InputText,25,50^";
$parm1 = $parm1."auctionitem_itemdescription|No|Description|60|Yes|Item Description|InputText,50,200^";
$parm1 = $parm1."auctionitem_itemquantity|Yes|Qty|30|Yes|Quantity|InputSelectFromList,1+2+3+4+5+6+7+8+9+10+11+12^";
$parm1 = $parm1."auctionitem_vendorphoto|Yes|Photo|30|Yes|Photo|InputImage,GLOBALDOMAINWWWURL/domain_advertisers,GLOBALDOMAINWWWPATH/domain_advertisers,150,flex,Auction,auctionitem_id^";
# $parm1 = $parm1."auctionitem_datereceived|Yes|Date Received|50|Yes|Date Received|InputDate^";
$parm1 = $parm1."auctionitem_receivedbypersonname|No|Rec By|50|Yes|Received By|InputText,25,50^";
# $parm1 = $parm1."auctionitem_datereceiptissued|No|Date Receipted|50|Yes|Date Receipted|InputDate^";
# $parm1 = $parm1."auctionitem_vendorestimateprice|Yes|Est Value|50|Yes|Estimated Value|InputText,10,10^";
$parm1 = $parm1."auctionitem_vendorreserveprice|Yes|Reserve|50|Yes|Vendor Reserve|InputText,10,10^";
$parm1 = $parm1."auctionitem_vendorsharepercentage|No|Share%|50|Yes|Vendor Share%|InputSelectFromList,50%+0%^";
$parm1 = $parm1."auctionitem_vendordonation|No|Donation|50|Yes|Donation|InputSelectFromList,Yes+No^";
$parm1 = $parm1."auctionitem_suitabilityforsale|Yes|Suitability|50|Yes|Suitability|InputSelectFromList,Yes+No^";
$parm1 = $parm1."auctionitem_comments|No|Comments|50|Yes|Comments|InputText,50,100^";
$parm1 = $parm1."auctionitem_categoryid|Yes|Category|75|Yes|Category|InputSelectFromTable,auctioncategory,auctioncategory_id,auctioncategory_name,auctioncategory_id^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."auctionitem_lotnumber|Yes|Lot No|50|Yes|Lot Number|InputText,10,10^";
$parm1 = $parm1."auctionitem_lottitle|Yes|Lot Title|50|Yes|Lot Title|InputText,25,50^";
$parm1 = $parm1."auctionitem_lotdescription|No|Lot Description|50|Yes|Lot Description|InputText,50,200^";
$parm1 = $parm1."auctionitem_saletargetprice|No|Target Price|50|Yes|Target Price|InputText,10,10^";
$parm1 = $parm1."auctionitem_salereserveprice|Yes|Reserve|50|Yes|Reserve Price|InputText,10,10^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|55|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
$p0 = "person_id|person_sname|person_fname;";
$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
$p2 =  "program,Search,Update,personCHANGEin.php,,70";
$p3 =  "person_id";
$p4 =  "all";
$p5 =  "person_change,center,center,900,900"; 
$p6 =  "view"; 
$p7 =  "buildfulllist"; 
$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Auction_MANAGEAUCTIONSALES_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqueryconfirm,jqdatatablesmin,personselectionpopup";
$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Auction_MANAGEAUCTIONSALES_Output() {
$parm0 = "Manage Auction Sales|auctionitem["."50502012"."]|auctioncategory|auctionitem_id|auctionitem_id|25|No";	
$parm1 = "";
$parm1 = $parm1."auctionitem_id|Yes|Item Id|60|Yes|Auction Item Id|KeyText,8,8^";
$parm1 = $parm1."auctionitem_vendorpersonid|Yes|Name|50|Yes|Vendor Name|InputText,25,50^";
$parm1 = $parm1."auctionitem_vendorfullname|No|Name|50|Yes|Vendor Name|InputText,25,50^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."auctionitem_lotnumber|Yes|Lot Number|50|Yes|Lot Number|InputText,10,10^";
$parm1 = $parm1."auctionitem_lottitle|Yes|Lot Title|50|Yes|Lot Title|InputText,25,50^";
$parm1 = $parm1."auctionitem_lotdescription|No|Lot Description|60|Yes|Lot Description|InputText,50,200^";
$parm1 = $parm1."auctionitem_saletargetprice|No|Target Price|50|Yes|Target Price|InputText,10,10^";
$parm1 = $parm1."auctionitem_salereserveprice|No|Reserve Price|50|Yes|Reserve Price|InputText,10,10^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."auctionitem_categoryid|Yes|Category|70|Yes|Category|InputSelectFromTable,auctioncategory,auctioncategory_id,auctioncategory_name,auctioncategory_id^";;
$parm1 = $parm1."auctionitem_salestatus|Yes|Sale Status|50|Yes|Sale Status|InputSelectFromList,Yes+No^";
$parm1 = $parm1."auctionitem_soldprice|Yes|Sold Price|50|Yes|Sold Price|InputText,10,10^";
$parm1 = $parm1."auctionitem_buyername|Yes|Buyer Name|50|Yes|Buyer Name|InputText,30,90^";
$parm1 = $parm1."auctionitem_buyerpaidstatus|Yes|Payment|50|Yes|Payment|InputSelectFromList,Yes+No^";
$parm1 = $parm1."auctionitem_buyercontactdetails|Yes|Buyer Contact|50|Yes|Buyer Contact|InputText,30,90^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|55|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
$p0 = "person_id|person_sname|person_fname;";
$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
$p2 =  "program,Search,Update,personCHANGEin.php,,70";
$p3 =  "person_id";
$p4 =  "all";
$p5 =  "person_change,center,center,900,900"; 
$p6 =  "view"; 
$p7 =  "buildfulllist"; 
$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}


function Auction_AUCTIONCATALOGUEPRINT_Output() {
XH3("Calalogue Print");
$Q = '"'; $rtfN= 'rtf';
XPTXT("Save the downloaded $Q$rtfN$Q file and open it with Word. The text can then be cut and pasted into the catalogue.");
XBR();
XFORM("auctioncatalogueprintin.php","calalogueprint");
XINSTDHID();
XINSUBMIT("Download list of items for catalogue");
X_FORM();  
}

function Auction_AUCTIONAUCTIONEERPRINT_Output() {
XH3("Print Information for Auctioneer");
$Q = '"'; $rtfN= 'rtf';
XPTXT("Save the downloaded $Q$rtfN$Q file and open it with Word.");
XBR();
XFORM("auctionauctioneerprintin.php","auctioneerprint");
XINSTDHID();
XINSUBMIT("Download list of items for auctioneer");
X_FORM();  
}

function Auction_AUCTIONLOTADMINPRINT_Output() {
XH3("Print Information for Admin - sorted by Category/Lot");
$Q = '"'; $rtfN= 'rtf';
XPTXT("Save the downloaded $Q$rtfN$Q file and open it with Word.");
XBR();
XFORM("auctionlotadminprintin.php","lotprint");
XINSTDHID();
XINSUBMIT("Download list");
X_FORM();  
}

function Auction_AUCTIONINPUTIDADMINPRINT_Output() {
XH3("Print Information for Admin - sorted by Input Reference");
$Q = '"'; $rtfN= 'rtf';
XPTXT("Save the downloaded $Q$rtfN$Q file and open it with Word.");
XBR();
XFORM("auctionitemidadminprintin.php","inputidprint");
XINSTDHID();
XINSUBMIT("Download list");
X_FORM();  
}

function Auction_AUCTIONVENDORADMINPRINT_Output() {
XH3("Print Information for Admin - sorted by Vendor");
$Q = '"'; $rtfN= 'rtf';
XPTXT("Save the downloaded $Q$rtfN$Q file and open it with Word.");
XBR();
XFORM("auctionvendoradminprintin.php","vendorprint");
XINSTDHID();
XINSUBMIT("Download list");
X_FORM();  
}


function Auction_AUCTIONSALEPRINT_Output() {
XH3("This section is under development");	
}


?>