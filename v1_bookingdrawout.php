<<<<<<< HEAD
<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Booking_EventBooking_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$indraw_id = $_REQUEST['draw_id'];

Booking_DrawBooking_Output($indraw_id,"","","");

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
Booking_EventBooking_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$indraw_id = $_REQUEST['draw_id'];

Booking_DrawBooking_Output($indraw_id,"","","");

Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
