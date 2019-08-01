<<<<<<< HEAD
<?php # setupsqlmaintainout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');
Get_Common_Parameters();
GlobalRoutine();
$cookiename = $_REQUEST['CookieName'];
$cookievalue = $_REQUEST['CookieValue'];
$cookiehours = $_REQUEST['CookieHours'];
setcookie($cookiename, $cookievalue, time()+($cookiehours*3600));
PageHeader("Default","Final");
Back_Navigator();
XH2("Setup Cookies");
XH5("Cookie setup - ".$cookiename." ".$cookievalue." ".$cookiehours);
Back_Navigator();
PageFooter("Default","Final");
=======
<?php # setupsqlmaintainout.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');
Get_Common_Parameters();
GlobalRoutine();
$cookiename = $_REQUEST['CookieName'];
$cookievalue = $_REQUEST['CookieValue'];
$cookiehours = $_REQUEST['CookieHours'];
setcookie($cookiename, $cookievalue, time()+($cookiehours*3600));
PageHeader("Default","Final");
Back_Navigator();
XH2("Setup Cookies");
XH5("Cookie setup - ".$cookiename." ".$cookievalue." ".$cookiehours);
Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>