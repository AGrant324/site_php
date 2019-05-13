<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_setuproutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();

$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "slimjquerymin,slimimagepopup,jqueryconfirm";

PageHeader("Default","Final");
Back_Navigator(); 

XH1("Image 1");
// =================== Slim Image Cropper Output =======================
$imagefieldname = "test_featuredimage1";
$imageviewwidth = "300";
$imagename = "Article_T88888_123456.jpg";
$imageuploadto = "Article";
$imageuploadid = "T88888";
$imageuploadwidth = "600";
$imageuploadheight = "flex";
$imageuploadfixedsize = "";
$imagethumbwidth = "";
XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto );
SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid, 
$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);

XH1("Image 2");
$imagefieldname = "test_featuredimage2";
$imageviewwidth = "300";
$imagename = "Article_T99999_123456.jpg";
$imageuploadto = "Article";
$imageuploadid = "T99999";
$imageuploadwidth = "600";
$imageuploadheight = "flex";
$imageuploadfixedsize = "";
$imagethumbwidth = "";
XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto );
SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);


Back_Navigator();
PageFooter("Default","Final");



?>


