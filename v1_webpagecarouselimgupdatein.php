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

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

XTDTXT($carousel_name);
XTDTXT($carouselimg_id);

$incarousel_name = $_REQUEST['carousel_name'];
$incarouselimg_id = $_REQUEST['carouselimg_id'];
$incarouselimg_seq = $_REQUEST['carouselimg_seq'];
$incarouselimg_img = $_REQUEST['carouselimg_img_imagename'];
$incarouselimg_header = $_REQUEST['carouselimg_header'];
$incarouselimg_text = $_REQUEST['carouselimg_text'];
$incarouselimg_buttontext = $_REQUEST['carouselimg_buttontext'];
$incarouselimg_buttonlink = $_REQUEST['carouselimg_buttonlink'];

XH2("Carousel Image Editor - ".$incarousel_name." - ".$incarouselimg_id);
$action = "updated";
Check_Data("carouselimg", $incarousel_name, $incarouselimg_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("carouselimg"); $action = "added"; }

$GLOBALS{'carouselimg_id'} = $incarouselimg_id;
$GLOBALS{'carouselimg_seq'} = $incarouselimg_seq;
$GLOBALS{'carouselimg_img'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_style",$GLOBALS{'carouselimg_img'},$incarouselimg_img);
$GLOBALS{'carouselimg_header'} = $incarouselimg_header;
$GLOBALS{'carouselimg_text'} = $incarouselimg_text;
$GLOBALS{'carouselimg_buttontext'} = $incarouselimg_buttontext;
$GLOBALS{'carouselimg_buttonlink'} = $incarouselimg_buttonlink;
Write_Data("carouselimg", $incarousel_name, $incarouselimg_id);
XPTXT("Carousel Image - ".$carousel_name." - ".$carouselimg_id);
XPTXT("This is how the image will be displayed");

XBR();XBR();XIMGFLEX($GLOBALS{'domainwwwurl'}."/domain_style/".$GLOBALS{'carouselimg_img'});

XBR();
XHR();
XBR();
$link = YPGMLINK("webpagecarouselimgupdateout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("carousel_name",$incarousel_name).YPGMPARM("carouselimg_id",$incarouselimg_id);
XLINKTXT($link,"make further updates to ths carousel image");
XBR();
$link = YPGMLINK("webpagecarouselimgupdatelist.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("carousel_name",$incarousel_name);
XLINKTXT($link,"return to list of images in this carousel");
XBR();
$link = YPGMLINK("webpagecarouselpublish.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("carousel_name",$incarousel_name);
XLINKTXT($link,"republish this carousel on the website");
XBR();

Back_Navigator();
PageFooter("Default","Final");


