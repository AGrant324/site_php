<?php # auctionitempaperreceiptin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_auctionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

Auction_VENDORPWF_Output();
Back_Navigator();
PageFooter("Default","Final");

?>


