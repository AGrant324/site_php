<<<<<<< HEAD
<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$indraw_id = $_REQUEST['draw_id'];
$indrawtxn_personid = $_REQUEST['drawtxn_personid'];
$indrawtxn_totalcharge = $_REQUEST['drawtxn_totalcharge'];
$indrawtxn_ticketquantity = $_REQUEST['drawtxn_ticketquantity'];
$indrawtxn_paymentmethod = $_REQUEST['drawtxn_paymentmethod'];


Get_Data('draw',$indraw_id);
$drawtxnida = GetNextTicketRange($indraw_id,$indrawtxn_ticketquantity);
// returns allocated : drawtxnid, startticketrange, endticketrange

$GLOBALS{'drawtxn_personid'} = $indrawtxn_personid;
$GLOBALS{'drawtxn_paymentduedate'} = $GLOBALS{'currentYYYY-MM-DD'};
$GLOBALS{'drawtxn_paymentdueamount'} = $indrawtxn_totalcharge;
$GLOBALS{'drawtxn_paymentmethod'} = $indrawtxn_paymentmethod;
$GLOBALS{'drawtxn_quantity'} = $indrawtxn_ticketquantity;
$GLOBALS{'drawtxn_startrange'} = $drawtxnida[1];
$GLOBALS{'drawtxn_endrange'} = $drawtxnida[2];

Write_Data('drawtxn',$indraw_id,$drawtxnida[0]);

if ($indrawtxn_paymentmethod == "Card") {
	Booking_DrawPayPalPayment_Output ($indraw_id, $drawtxnida[0], $indrawtxn_personid, $indrawtxn_totalcharge);
}

XHR();
XH4("We have reserved ".$indrawtxn_ticketquantity." tickets for you in the draw, pending successful completion of payment.");

XPTXT($drawtxnida[1]." to ".$drawtxnida[2]);

Back_Navigator();
PageFooter("Default","Final");


=======
<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$indraw_id = $_REQUEST['draw_id'];
$indrawtxn_personid = $_REQUEST['drawtxn_personid'];
$indrawtxn_totalcharge = $_REQUEST['drawtxn_totalcharge'];
$indrawtxn_ticketquantity = $_REQUEST['drawtxn_ticketquantity'];
$indrawtxn_paymentmethod = $_REQUEST['drawtxn_paymentmethod'];


Get_Data('draw',$indraw_id);
$drawtxnida = GetNextTicketRange($indraw_id,$indrawtxn_ticketquantity);
// returns allocated : drawtxnid, startticketrange, endticketrange

$GLOBALS{'drawtxn_personid'} = $indrawtxn_personid;
$GLOBALS{'drawtxn_paymentduedate'} = $GLOBALS{'currentYYYY-MM-DD'};
$GLOBALS{'drawtxn_paymentdueamount'} = $indrawtxn_totalcharge;
$GLOBALS{'drawtxn_paymentmethod'} = $indrawtxn_paymentmethod;
$GLOBALS{'drawtxn_quantity'} = $indrawtxn_ticketquantity;
$GLOBALS{'drawtxn_startrange'} = $drawtxnida[1];
$GLOBALS{'drawtxn_endrange'} = $drawtxnida[2];

Write_Data('drawtxn',$indraw_id,$drawtxnida[0]);

if ($indrawtxn_paymentmethod == "Card") {
	Booking_DrawPayPalPayment_Output ($indraw_id, $drawtxnida[0], $indrawtxn_personid, $indrawtxn_totalcharge);
}

XHR();
XH4("We have reserved ".$indrawtxn_ticketquantity." tickets for you in the draw, pending successful completion of payment.");

XPTXT($drawtxnida[1]." to ".$drawtxnida[2]);

Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
