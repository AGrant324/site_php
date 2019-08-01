<<<<<<< HEAD
<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Booking_CourseBooking_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$incourse_id = $_REQUEST['course_id'];

Booking_CourseBooking_Output($incourse_id,"","","0000-00-00");

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
Booking_CourseBooking_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$incourse_id = $_REQUEST['course_id'];

Booking_CourseBooking_Output($incourse_id,"","","0000-00-00");

Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
