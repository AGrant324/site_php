<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$incarousel_name = $_REQUEST['carousel_name'];
$incarouselimg_id = $_REQUEST['carouselimg_id'];

Delete_Data("carouselimg",$incarousel_name,$incarouselimg_id);
XPTXT('Carousel Image - "'.$incarousel_name."-".$incarouselimg_id.'" deleted');

Webpage_CAROUSELIMGUPDATELIST_Output($incarousel_name);

Back_Navigator();
PageFooter("Default","Final");


