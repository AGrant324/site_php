<<<<<<< HEAD
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");

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
$inpsw1 = $_REQUEST['PersonPsw1'];
$inpsw2 = $_REQUEST['PersonPsw2'];

if (($inpsw1 != "")&&($inpsw1 != $inpsw2)) {
 XH3("Passwords do not match - please retry");
 Auction_CONTACTDETAILSUPDATE_Output(); 	
} else {
 Get_Data('person',$GLOBALS{'LOGIN_person_id'});
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
 if ($inpsw1 != "") {$GLOBALS{'person_password'} = XCrypt($inpsw1,$GLOBALS{'LOGIN_person_id'},"encrypt"); }
 Write_Data('person',$GLOBALS{'LOGIN_person_id'});
 XPTXT("Thank you $infname - updates successful");
 Auction_CONTACTDETAILSUPDATE_Output();
}

AuctionVendor_Navigator();
PageFooter("Default","Final");

?>
=======
<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");

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
$inpsw1 = $_REQUEST['PersonPsw1'];
$inpsw2 = $_REQUEST['PersonPsw2'];

if (($inpsw1 != "")&&($inpsw1 != $inpsw2)) {
 XH3("Passwords do not match - please retry");
 Auction_CONTACTDETAILSUPDATE_Output(); 	
} else {
 Get_Data('person',$GLOBALS{'LOGIN_person_id'});
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
 if ($inpsw1 != "") {$GLOBALS{'person_password'} = XCrypt($inpsw1,$GLOBALS{'LOGIN_person_id'},"encrypt"); }
 Write_Data('person',$GLOBALS{'LOGIN_person_id'});
 XPTXT("Thank you $infname - updates successful");
 Auction_CONTACTDETAILSUPDATE_Output();
}

AuctionVendor_Navigator();
PageFooter("Default","Final");

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
