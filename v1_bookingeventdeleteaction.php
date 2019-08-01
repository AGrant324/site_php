<<<<<<< HEAD
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inevent_id = $_REQUEST['event_id'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

Delete_Data("event",$inevent_id);
XPTXT("Event - ".$inevent_id." deleted");

Booking_EVENTUPDATELIST_Output();

Back_Navigator();
PageFooter("Default","Final");


=======
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inevent_id = $_REQUEST['event_id'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

Delete_Data("event",$inevent_id);
XPTXT("Event - ".$inevent_id." deleted");

Booking_EVENTUPDATELIST_Output();

Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
