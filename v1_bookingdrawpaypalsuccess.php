<?php # bookingdrawpaypalsuccess.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

XTXTCOLOR("Debit Card / Credit Card via Paypal successfully processed.","Green");
XBR();
XHR();

$indraw_id = $_REQUEST['draw_id'];
$indrawtxn_id = $_REQUEST['drawtxn_id'];
$indrawtxn_paymentdueamount = $_REQUEST['drawtxn_paymentdueamount'];
Get_Data('draw',$indraw_id);
Get_Data('drawtxn',$indraw_id,$indrawtxn_id);
$GLOBALS{'drawtxn_paymentdate'} = $GLOBALS{'currentYYYY-MM-DD'};
$GLOBALS{'drawtxn_paymentamount'} = $indrawtxn_paymentdueamount;
Write_Data('drawtxn',$indraw_id,$indrawtxn_id);

Get_Data('person',$GLOBALS{'drawtxn_personid'});
$thisfname = $GLOBALS{'person_fname'};
$thissname = $GLOBALS{'person_sname'};
$thisemail = $GLOBALS{'person_email1'};
if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email3'}; }
if ( $thisemail == "" ) { $thisemail = $GLOBALS{'person_email2'}; }   		

XPTXT('Thank you, We have received a raffle payment of '.$GLOBALS{'countrycurrencysymbol'}.number_format($indrawtxn_paymentdueamount, 2, '.', '').' for '.$thisfname.' '.$thissname.'.');

XH2($GLOBALS{'draw_title'});
Check_Data("person",$GLOBALS{'draw_contact'});
if ($GLOBALS{'IOWARNING'} == "0" ) {
	$showmobiletel = ""; $showemail = "";
	if ($GLOBALS{'person_mobiletel'} != "" ) {$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};}
	if ($GLOBALS{'person_email1'} != "" ) {$showemail = "Email: ".$GLOBALS{'person_email1'};}
	XTXT("Draw Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
} else {
	XTXT("Draw Contact - ".$GLOBALS{'draw_contact'});
}
XBR();
XTXT("Draw Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
XBR();
XTXT("Draw Time - ".$GLOBALS{'draw_time'});
XBR();
Check_Data('venue',$GLOBALS{'draw_venuecode'});
XTXT("Draw Venue - ".$GLOBALS{'venue_name'});
XBR();

XH5("A confirmatory email has been sent.");

XBR();XINBUTTONCLOSEWINDOW("Close");

Back_Navigator();
PageFooter("Default","Final"); 

?>
