<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$indrawid = $_REQUEST['draw_id'];
Booking_DRAWTICKETADMIN_Output ($indrawid);

XBR();XBR();
$link = YPGMLINK("bookingdrawpaymentadminout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$indrawid);
XLINKTXT($link,"manage payments for this draw");
XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","DRAWADMINLIST");
XLINKTXT($link,"show my draw list");

Back_Navigator();
PageFooter("Default","Final");

