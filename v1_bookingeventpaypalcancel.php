<?php # bookingcoursepaypalcancel.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

XTXTCOLOR("Debit Card / Credit Card via Paypal cancelled - please contact us if you would like to pay with alternative means.","Orange");
XBR();
XHR();

Back_Navigator();
PageFooter("Default","Final");

?>
