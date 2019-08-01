<<<<<<< HEAD
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$indraw_id = $_REQUEST['draw_id'];
$inmenulist = $_REQUEST['menulist'];
$indraw_title = $_REQUEST['draw_title'];
$indraw_excerpt = $_REQUEST['draw_excerpt'];
$indraw_description = $_REQUEST['draw_description'];
$indraw_featuredimage = $_REQUEST['draw_featuredimage_imagename'];
$indraw_drawcategoryid = $_REQUEST['draw_drawcategoryid'];
$ddpart = $_REQUEST['draw_date_DDpart'];
$mmpart = $_REQUEST['draw_date_MMpart'];
$yyyypart = $_REQUEST['draw_date_YYYYpart'];
$indraw_date = $yyyypart."-".$mmpart."-".$ddpart;
$indraw_time = StandardTime($_REQUEST['draw_time']);
$indraw_contact = $_REQUEST['draw_contact'];
$indraw_venuecode = $_REQUEST['draw_venuecode'];
if( is_array($_REQUEST['draw_paymentoptionslist'])) {
	# one of checkboxes selected
	$indraw_paymentoptionslist = Array2List($_REQUEST['draw_paymentoptionslist']);
} else {
	$indraw_paymentoptionslist  = "";
}
$indraw_charge = $_REQUEST['draw_charge'];
$indraw_discountpercent = $_REQUEST['draw_discountpercent'];
$indraw_discountthreshold = $_REQUEST['draw_discountthreshold'];
$indraw_startrange = $_REQUEST['draw_startrange'];
$indraw_endrange = $_REQUEST['draw_endrange'];
$indraw_full = $_REQUEST['draw_full'];
$indraw_selectedrangelist = $_REQUEST['draw_selectedrangelist'];
$indraw_tsandcs = $_REQUEST['draw_tsandcs'];
$indraw_publicationstatus = $_REQUEST['draw_publicationstatus'];
$indraw_archived = $_REQUEST['draw_archived'];
$indraw_websiterequested = $_REQUEST['draw_websiterequested'];
$indraw_bulletinrequested = $_REQUEST['draw_bulletinrequested'];
$indraw_newsletterrequested = $_REQUEST['draw_newsletterrequested'];
$indraw_facebookrequested = $_REQUEST['draw_facebookrequested'];
XH2("Raffle Update - ".$indraw_id." - ".$indraw_title);
$action = "updated";
Check_Data("draw",$indraw_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("draw"); $action = "added"; }

$GLOBALS{'draw_id'} = $indraw_id;
$GLOBALS{'draw_title'} = $indraw_title;
$GLOBALS{'draw_excerpt'} = $indraw_excerpt;
$GLOBALS{'draw_description'} = $indraw_description;
$GLOBALS{'draw_featuredimage'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'draw_featuredimage'},$indraw_featuredimage);
$GLOBALS{'draw_drawcategoryid'} = $indraw_drawcategoryid;
$GLOBALS{'draw_date'} = $indraw_date;
$GLOBALS{'draw_time'} = $indraw_time;
$GLOBALS{'draw_contact'} = $indraw_contact;
$GLOBALS{'draw_maximumattendees'} = $indraw_maximumattendees;
$GLOBALS{'draw_full'} = $indraw_full;
$GLOBALS{'draw_venuecode'} = $indraw_venuecode;
$GLOBALS{'draw_paymentoptionslist'} = $indraw_paymentoptionslist;
$GLOBALS{'draw_charge'} = $indraw_charge;
$GLOBALS{'draw_discountpercent'} = $indraw_discountpercent;
$GLOBALS{'draw_discountthreshold'} = $indraw_discountthreshold;
$GLOBALS{'draw_startrange'} = $indraw_startrange;
$GLOBALS{'draw_endrange'} = $indraw_endrange;
$GLOBALS{'draw_full'} = $indraw_full;
$GLOBALS{'draw_selectedrangelist'} = $indraw_selectedrangelist;
$GLOBALS{'draw_tsandcs'} = $indraw_tsandcs;
$GLOBALS{'draw_publicationstatus'} = $indraw_publicationstatus;
$GLOBALS{'draw_archived'} = $indraw_archived;
$GLOBALS{'draw_websiterequested'} = $indraw_websiterequested;
$GLOBALS{'draw_bulletinrequested'} = $indraw_bulletinrequested;
$GLOBALS{'draw_newsletterrequested'} = $indraw_newsletterrequested;
$GLOBALS{'draw_facebookrequested'} = $indraw_facebookrequested;
$GLOBALS{'draw_twitterrequested'} = $indraw_twitterrequested;
$GLOBALS{'draw_createdbypersonid'} = $GLOBALS{'LOGIN_person_id'};

Write_Data("draw",$indraw_id);
XPTXT("Raffle - ".$indraw_id." ".$indraw_title." ".$action);
Webpage_PluginTriggerChanged_Output("draw");
XPTXT("This is how the draw will be displayed");
Webpage_DRAWVIEW_Output($indraw_id);
XBR();

XH2("Notifiers");
$notifierrequested = "0";
Get_Data("person",$GLOBALS{'draw_createdbypersonid'});
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$actiontext1 = "New"; $actiontext2 = "I have created a new";
if ($action == "updated" ) { $actiontext1 = "Updated"; $actiontext2 = "I have updated a "; }
Get_Data("commsmasters");
if ( $GLOBALS{'draw_websiterequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_websitepublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Raffle for Website';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' draw to be posted on website.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'draw_bulletinrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_bulletinpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Raffle for Bulletin Board';	
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' draw to be posted on a bulletin board.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'draw_newsletterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_newsletterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.'Raffle for Newsletter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' draw to be included in Newsletter.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'draw_facebookrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_facebookpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Raffle for Facebook';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' draw to be posted out through Facebook.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'draw_twitterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_twitterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Raffle for Twitter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' raffle to be tweeted through Twitter.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $notifierrequested == "0" ) { XPTXT("No notifiers requested"); }
XBR();
XHR();
XBR();
$link = YPGMLINK("bookingdrawupdateout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$indraw_id);
XLINKTXT($link,"make further updates to ths raffle");
XBR();
if ( $inmenulist == 'newslettercomposer' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","NEWSLETTERCOMPOSER");
	XLINKTXT($link,"return to the newsletter composer");		
}
if ( $inmenulist == 'drawupdatelist' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","COURSEUPDATELIST");
	XLINKTXT($link,"show my raffle list");
}

Back_Navigator();
PageFooter("Default","Final");


=======
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_bookingroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$indraw_id = $_REQUEST['draw_id'];
$inmenulist = $_REQUEST['menulist'];
$indraw_title = $_REQUEST['draw_title'];
$indraw_excerpt = $_REQUEST['draw_excerpt'];
$indraw_description = $_REQUEST['draw_description'];
$indraw_featuredimage = $_REQUEST['draw_featuredimage_imagename'];
$indraw_drawcategoryid = $_REQUEST['draw_drawcategoryid'];
$ddpart = $_REQUEST['draw_date_DDpart'];
$mmpart = $_REQUEST['draw_date_MMpart'];
$yyyypart = $_REQUEST['draw_date_YYYYpart'];
$indraw_date = $yyyypart."-".$mmpart."-".$ddpart;
$indraw_time = StandardTime($_REQUEST['draw_time']);
$indraw_contact = $_REQUEST['draw_contact'];
$indraw_venuecode = $_REQUEST['draw_venuecode'];
if( is_array($_REQUEST['draw_paymentoptionslist'])) {
	# one of checkboxes selected
	$indraw_paymentoptionslist = Array2List($_REQUEST['draw_paymentoptionslist']);
} else {
	$indraw_paymentoptionslist  = "";
}
$indraw_charge = $_REQUEST['draw_charge'];
$indraw_discountpercent = $_REQUEST['draw_discountpercent'];
$indraw_discountthreshold = $_REQUEST['draw_discountthreshold'];
$indraw_startrange = $_REQUEST['draw_startrange'];
$indraw_endrange = $_REQUEST['draw_endrange'];
$indraw_full = $_REQUEST['draw_full'];
$indraw_selectedrangelist = $_REQUEST['draw_selectedrangelist'];
$indraw_tsandcs = $_REQUEST['draw_tsandcs'];
$indraw_publicationstatus = $_REQUEST['draw_publicationstatus'];
$indraw_archived = $_REQUEST['draw_archived'];
$indraw_websiterequested = $_REQUEST['draw_websiterequested'];
$indraw_bulletinrequested = $_REQUEST['draw_bulletinrequested'];
$indraw_newsletterrequested = $_REQUEST['draw_newsletterrequested'];
$indraw_facebookrequested = $_REQUEST['draw_facebookrequested'];
XH2("Raffle Update - ".$indraw_id." - ".$indraw_title);
$action = "updated";
Check_Data("draw",$indraw_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("draw"); $action = "added"; }

$GLOBALS{'draw_id'} = $indraw_id;
$GLOBALS{'draw_title'} = $indraw_title;
$GLOBALS{'draw_excerpt'} = $indraw_excerpt;
$GLOBALS{'draw_description'} = $indraw_description;
$GLOBALS{'draw_featuredimage'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'draw_featuredimage'},$indraw_featuredimage);
$GLOBALS{'draw_drawcategoryid'} = $indraw_drawcategoryid;
$GLOBALS{'draw_date'} = $indraw_date;
$GLOBALS{'draw_time'} = $indraw_time;
$GLOBALS{'draw_contact'} = $indraw_contact;
$GLOBALS{'draw_maximumattendees'} = $indraw_maximumattendees;
$GLOBALS{'draw_full'} = $indraw_full;
$GLOBALS{'draw_venuecode'} = $indraw_venuecode;
$GLOBALS{'draw_paymentoptionslist'} = $indraw_paymentoptionslist;
$GLOBALS{'draw_charge'} = $indraw_charge;
$GLOBALS{'draw_discountpercent'} = $indraw_discountpercent;
$GLOBALS{'draw_discountthreshold'} = $indraw_discountthreshold;
$GLOBALS{'draw_startrange'} = $indraw_startrange;
$GLOBALS{'draw_endrange'} = $indraw_endrange;
$GLOBALS{'draw_full'} = $indraw_full;
$GLOBALS{'draw_selectedrangelist'} = $indraw_selectedrangelist;
$GLOBALS{'draw_tsandcs'} = $indraw_tsandcs;
$GLOBALS{'draw_publicationstatus'} = $indraw_publicationstatus;
$GLOBALS{'draw_archived'} = $indraw_archived;
$GLOBALS{'draw_websiterequested'} = $indraw_websiterequested;
$GLOBALS{'draw_bulletinrequested'} = $indraw_bulletinrequested;
$GLOBALS{'draw_newsletterrequested'} = $indraw_newsletterrequested;
$GLOBALS{'draw_facebookrequested'} = $indraw_facebookrequested;
$GLOBALS{'draw_twitterrequested'} = $indraw_twitterrequested;
$GLOBALS{'draw_createdbypersonid'} = $GLOBALS{'LOGIN_person_id'};

Write_Data("draw",$indraw_id);
XPTXT("Raffle - ".$indraw_id." ".$indraw_title." ".$action);
Webpage_PluginTriggerChanged_Output("draw");
XPTXT("This is how the draw will be displayed");
Webpage_DRAWVIEW_Output($indraw_id);
XBR();

XH2("Notifiers");
$notifierrequested = "0";
Get_Data("person",$GLOBALS{'draw_createdbypersonid'});
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$actiontext1 = "New"; $actiontext2 = "I have created a new";
if ($action == "updated" ) { $actiontext1 = "Updated"; $actiontext2 = "I have updated a "; }
Get_Data("commsmasters");
if ( $GLOBALS{'draw_websiterequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_websitepublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Raffle for Website';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' draw to be posted on website.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'draw_bulletinrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_bulletinpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Raffle for Bulletin Board';	
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' draw to be posted on a bulletin board.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'draw_newsletterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_newsletterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.'Raffle for Newsletter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' draw to be included in Newsletter.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'draw_facebookrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_facebookpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Raffle for Facebook';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' draw to be posted out through Facebook.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'draw_twitterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_twitterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Raffle for Twitter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' raffle to be tweeted through Twitter.<br><br>';
		$mainmessage = $mainmessage.'Raffle Title - '.$GLOBALS{'draw_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $notifierrequested == "0" ) { XPTXT("No notifiers requested"); }
XBR();
XHR();
XBR();
$link = YPGMLINK("bookingdrawupdateout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$indraw_id);
XLINKTXT($link,"make further updates to ths raffle");
XBR();
if ( $inmenulist == 'newslettercomposer' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","NEWSLETTERCOMPOSER");
	XLINKTXT($link,"return to the newsletter composer");		
}
if ( $inmenulist == 'drawupdatelist' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","COURSEUPDATELIST");
	XLINKTXT($link,"show my raffle list");
}

Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
