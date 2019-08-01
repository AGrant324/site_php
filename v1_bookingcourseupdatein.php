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

$incourse_id = $_REQUEST['course_id'];
$inmenulist = $_REQUEST['menulist'];
$incourse_title = $_REQUEST['course_title'];
$incourse_excerpt = $_REQUEST['course_excerpt'];
$incourse_description = $_REQUEST['course_description'];
$incourse_featuredimage = $_REQUEST['course_featuredimage_imagename'];
$incourse_coursecategoryid = $_REQUEST['course_coursecategoryid'];
$ddpart = $_REQUEST['course_datestart_DDpart'];
$mmpart = $_REQUEST['course_datestart_MMpart'];
$yyyypart = $_REQUEST['course_datestart_YYYYpart'];
$incourse_datestart = $yyyypart."-".$mmpart."-".$ddpart;
$ddpart = $_REQUEST['course_dateend_DDpart'];
$mmpart = $_REQUEST['course_dateend_MMpart'];
$yyyypart = $_REQUEST['course_dateend_YYYYpart'];
$incourse_dateend = $yyyypart."-".$mmpart."-".$ddpart;
$incourse_weeklyrepeating = $_REQUEST['course_weeklyrepeating'];
$incourse_timestart = StandardTime($_REQUEST['course_timestart']);
$incourse_timeend = StandardTime($_REQUEST['course_timeend']);
$incourse_contact = $_REQUEST['course_contact'];
$incourse_maximumattendees = $_REQUEST['course_maximumattendees'];
$incourse_full = $_REQUEST['course_full'];
$incourse_venue = $_REQUEST['course_venue'];
$incourse_venuecode = $_REQUEST['course_venuecode'];
$incourse_googlemapsembed = $_REQUEST['course_googlemapsembed'];
if( is_array($_REQUEST['course_paymentoptionslist'])) {
	# one of checkboxes selected
	$incourse_paymentoptionslist = Array2List($_REQUEST['course_paymentoptionslist']);
} else {
	$incourse_paymentoptionslist  = "";
}
$incourse_charge = $_REQUEST['course_charge'];
$incourse_prepaidcharge = $_REQUEST['course_prepaidcharge'];
$incourse_earlycharge = $_REQUEST['course_earlycharge'];
$ddpart = $_REQUEST['course_earlychargedate_DDpart'];
$mmpart = $_REQUEST['course_earlychargedate_MMpart'];
$yyyypart = $_REQUEST['course_earlychargedate_YYYYpart'];
$incourse_earlychargedate = $yyyypart."-".$mmpart."-".$ddpart;
$incourse_partchargepermitted = $_REQUEST['course_partchargepermitted'];
$incourse_partchargeinstructions = $_REQUEST['course_partchargeinstructions'];
$incourse_requirements = $_REQUEST['course_requirements'];
$incourse_tsandcs = $_REQUEST['course_tsandcs'];
$incourse_publicationstatus = $_REQUEST['course_publicationstatus'];
$incourse_archived = $_REQUEST['course_archived'];
$incourse_websiterequested = $_REQUEST['course_websiterequested'];
$incourse_bulletinrequested = $_REQUEST['course_bulletinrequested'];
$incourse_newsletterrequested = $_REQUEST['course_newsletterrequested'];
$incourse_facebookrequested = $_REQUEST['course_facebookrequested'];
XH2("Course Update - ".$incourse_id." - ".$incourse_title);
$action = "updated";
Check_Data("course",$incourse_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("course"); $action = "added"; }

$GLOBALS{'course_id'} = $incourse_id;
$GLOBALS{'course_title'} = $incourse_title;
$GLOBALS{'course_excerpt'} = $incourse_excerpt;
$GLOBALS{'course_description'} = $incourse_description;
$GLOBALS{'course_featuredimage'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'course_featuredimage'},$incourse_featuredimage);
$GLOBALS{'course_coursecategoryid'} = $incourse_coursecategoryid;
$GLOBALS{'course_datestart'} = $incourse_datestart;
$GLOBALS{'course_dateend'} = $incourse_dateend;
$GLOBALS{'course_weeklyrepeating'} = $incourse_weeklyrepeating;
$GLOBALS{'course_timestart'} = $incourse_timestart;
$GLOBALS{'course_timeend'} = $incourse_timeend;
$GLOBALS{'course_contact'} = $incourse_contact;
$GLOBALS{'course_maximumattendees'} = $incourse_maximumattendees;
$GLOBALS{'course_full'} = $incourse_full;
$GLOBALS{'course_venue'} = $incourse_venue;
$GLOBALS{'course_venuecode'} = $incourse_venuecode;
$GLOBALS{'course_googlemapsembed'} = $incourse_googlemapsembed;
$GLOBALS{'course_paymentoptionslist'} = $incourse_paymentoptionslist;
$GLOBALS{'course_charge'} = $incourse_charge;
$GLOBALS{'course_prepaidcharge'} = $incourse_prepaidcharge;
$GLOBALS{'course_earlycharge'} = $incourse_earlycharge;
$GLOBALS{'course_earlychargedate'} = $incourse_earlychargedate;
$GLOBALS{'course_partchargepermitted'} = $incourse_partchargepermitted;
$GLOBALS{'course_partchargeinstructions'} = $incourse_partchargeinstructions;
$GLOBALS{'course_requirements'} = $incourse_requirements;
$GLOBALS{'course_tsandcs'} = $incourse_tsandcs;
$GLOBALS{'course_publicationstatus'} = $incourse_publicationstatus;
$GLOBALS{'course_archived'} = $incourse_archived;
$GLOBALS{'course_websiterequested'} = $incourse_websiterequested;
$GLOBALS{'course_bulletinrequested'} = $incourse_bulletinrequested;
$GLOBALS{'course_newsletterrequested'} = $incourse_newsletterrequested;
$GLOBALS{'course_facebookrequested'} = $incourse_facebookrequested;
$GLOBALS{'course_twitterrequested'} = $incourse_twitterrequested;
$GLOBALS{'course_createdbypersonid'} = $GLOBALS{'LOGIN_person_id'};

Write_Data("course",$incourse_id);
XPTXT("Course - ".$incourse_id." ".$incourse_title." ".$action);
Webpage_PluginTriggerChanged_Output("article");
XPTXT("This is how the course will be displayed");
Webpage_COURSEVIEW_Output($incourse_id);
XBR();

XH2("Notifiers");
$notifierrequested = "0";
Get_Data("person",$GLOBALS{'course_createdbypersonid'});
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$actiontext1 = "New"; $actiontext2 = "I have created a new";
if ($action == "updated" ) { $actiontext1 = "Updated"; $actiontext2 = "I have updated a "; }
Get_Data("commsmasters");
if ( $GLOBALS{'course_websiterequested'} == "Yes" ) {
    $notifierrequested = "1";
    Check_Data("person",$GLOBALS{'commsmasters_websitepublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Website';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be posted on website.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'course_bulletinrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_bulletinpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Bulletin Board';	
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be posted on a bulletin board.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'course_newsletterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_newsletterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Newsletter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be included in Newsletter.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'course_facebookrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_facebookpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Facebook';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be posted out through Facebook.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'course_twitterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_twitterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Twitter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be tweeted through Twitter.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
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
$link = YPGMLINK("bookingcourseupdateout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$incourse_id).YPGMPARM("action","update");
XLINKTXT($link,"make further updates to ths course");
XBR();
if ( $inmenulist == 'newslettercomposer' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","NEWSLETTERCOMPOSER");
	XLINKTXT($link,"return to the newsletter composer");		
}
if ( $inmenulist == 'courseupdatelist' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","COURSEUPDATELIST");
	XLINKTXT($link,"show my course list");
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

$incourse_id = $_REQUEST['course_id'];
$inmenulist = $_REQUEST['menulist'];
$incourse_title = $_REQUEST['course_title'];
$incourse_excerpt = $_REQUEST['course_excerpt'];
$incourse_description = $_REQUEST['course_description'];
$incourse_featuredimage = $_REQUEST['course_featuredimage_imagename'];
$incourse_coursecategoryid = $_REQUEST['course_coursecategoryid'];
$ddpart = $_REQUEST['course_datestart_DDpart'];
$mmpart = $_REQUEST['course_datestart_MMpart'];
$yyyypart = $_REQUEST['course_datestart_YYYYpart'];
$incourse_datestart = $yyyypart."-".$mmpart."-".$ddpart;
$ddpart = $_REQUEST['course_dateend_DDpart'];
$mmpart = $_REQUEST['course_dateend_MMpart'];
$yyyypart = $_REQUEST['course_dateend_YYYYpart'];
$incourse_dateend = $yyyypart."-".$mmpart."-".$ddpart;
$incourse_weeklyrepeating = $_REQUEST['course_weeklyrepeating'];
$incourse_timestart = StandardTime($_REQUEST['course_timestart']);
$incourse_timeend = StandardTime($_REQUEST['course_timeend']);
$incourse_contact = $_REQUEST['course_contact'];
$incourse_maximumattendees = $_REQUEST['course_maximumattendees'];
$incourse_full = $_REQUEST['course_full'];
$incourse_venue = $_REQUEST['course_venue'];
$incourse_venuecode = $_REQUEST['course_venuecode'];
$incourse_googlemapsembed = $_REQUEST['course_googlemapsembed'];
if( is_array($_REQUEST['course_paymentoptionslist'])) {
	# one of checkboxes selected
	$incourse_paymentoptionslist = Array2List($_REQUEST['course_paymentoptionslist']);
} else {
	$incourse_paymentoptionslist  = "";
}
$incourse_charge = $_REQUEST['course_charge'];
$incourse_prepaidcharge = $_REQUEST['course_prepaidcharge'];
$incourse_earlycharge = $_REQUEST['course_earlycharge'];
$ddpart = $_REQUEST['course_earlychargedate_DDpart'];
$mmpart = $_REQUEST['course_earlychargedate_MMpart'];
$yyyypart = $_REQUEST['course_earlychargedate_YYYYpart'];
$incourse_earlychargedate = $yyyypart."-".$mmpart."-".$ddpart;
$incourse_partchargepermitted = $_REQUEST['course_partchargepermitted'];
$incourse_partchargeinstructions = $_REQUEST['course_partchargeinstructions'];
$incourse_requirements = $_REQUEST['course_requirements'];
$incourse_tsandcs = $_REQUEST['course_tsandcs'];
$incourse_publicationstatus = $_REQUEST['course_publicationstatus'];
$incourse_archived = $_REQUEST['course_archived'];
$incourse_websiterequested = $_REQUEST['course_websiterequested'];
$incourse_bulletinrequested = $_REQUEST['course_bulletinrequested'];
$incourse_newsletterrequested = $_REQUEST['course_newsletterrequested'];
$incourse_facebookrequested = $_REQUEST['course_facebookrequested'];
XH2("Course Update - ".$incourse_id." - ".$incourse_title);
$action = "updated";
Check_Data("course",$incourse_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("course"); $action = "added"; }

$GLOBALS{'course_id'} = $incourse_id;
$GLOBALS{'course_title'} = $incourse_title;
$GLOBALS{'course_excerpt'} = $incourse_excerpt;
$GLOBALS{'course_description'} = $incourse_description;
$GLOBALS{'course_featuredimage'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'course_featuredimage'},$incourse_featuredimage);
$GLOBALS{'course_coursecategoryid'} = $incourse_coursecategoryid;
$GLOBALS{'course_datestart'} = $incourse_datestart;
$GLOBALS{'course_dateend'} = $incourse_dateend;
$GLOBALS{'course_weeklyrepeating'} = $incourse_weeklyrepeating;
$GLOBALS{'course_timestart'} = $incourse_timestart;
$GLOBALS{'course_timeend'} = $incourse_timeend;
$GLOBALS{'course_contact'} = $incourse_contact;
$GLOBALS{'course_maximumattendees'} = $incourse_maximumattendees;
$GLOBALS{'course_full'} = $incourse_full;
$GLOBALS{'course_venue'} = $incourse_venue;
$GLOBALS{'course_venuecode'} = $incourse_venuecode;
$GLOBALS{'course_googlemapsembed'} = $incourse_googlemapsembed;
$GLOBALS{'course_paymentoptionslist'} = $incourse_paymentoptionslist;
$GLOBALS{'course_charge'} = $incourse_charge;
$GLOBALS{'course_prepaidcharge'} = $incourse_prepaidcharge;
$GLOBALS{'course_earlycharge'} = $incourse_earlycharge;
$GLOBALS{'course_earlychargedate'} = $incourse_earlychargedate;
$GLOBALS{'course_partchargepermitted'} = $incourse_partchargepermitted;
$GLOBALS{'course_partchargeinstructions'} = $incourse_partchargeinstructions;
$GLOBALS{'course_requirements'} = $incourse_requirements;
$GLOBALS{'course_tsandcs'} = $incourse_tsandcs;
$GLOBALS{'course_publicationstatus'} = $incourse_publicationstatus;
$GLOBALS{'course_archived'} = $incourse_archived;
$GLOBALS{'course_websiterequested'} = $incourse_websiterequested;
$GLOBALS{'course_bulletinrequested'} = $incourse_bulletinrequested;
$GLOBALS{'course_newsletterrequested'} = $incourse_newsletterrequested;
$GLOBALS{'course_facebookrequested'} = $incourse_facebookrequested;
$GLOBALS{'course_twitterrequested'} = $incourse_twitterrequested;
$GLOBALS{'course_createdbypersonid'} = $GLOBALS{'LOGIN_person_id'};

Write_Data("course",$incourse_id);
XPTXT("Course - ".$incourse_id." ".$incourse_title." ".$action);
Webpage_PluginTriggerChanged_Output("article");
XPTXT("This is how the course will be displayed");
Webpage_COURSEVIEW_Output($incourse_id);
XBR();

XH2("Notifiers");
$notifierrequested = "0";
Get_Data("person",$GLOBALS{'course_createdbypersonid'});
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$actiontext1 = "New"; $actiontext2 = "I have created a new";
if ($action == "updated" ) { $actiontext1 = "Updated"; $actiontext2 = "I have updated a "; }
Get_Data("commsmasters");
if ( $GLOBALS{'course_websiterequested'} == "Yes" ) {
    $notifierrequested = "1";
    Check_Data("person",$GLOBALS{'commsmasters_websitepublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Website';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be posted on website.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'course_bulletinrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_bulletinpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Bulletin Board';	
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be posted on a bulletin board.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'course_newsletterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_newsletterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Newsletter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be included in Newsletter.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'course_facebookrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_facebookpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Facebook';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be posted out through Facebook.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'course_twitterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_twitterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Course for Twitter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' course to be tweeted through Twitter.<br><br>';
		$mainmessage = $mainmessage.'Course Title - '.$GLOBALS{'course_title'}.'<br><br>';
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
$link = YPGMLINK("bookingcourseupdateout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$incourse_id).YPGMPARM("action","update");
XLINKTXT($link,"make further updates to ths course");
XBR();
if ( $inmenulist == 'newslettercomposer' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","NEWSLETTERCOMPOSER");
	XLINKTXT($link,"return to the newsletter composer");		
}
if ( $inmenulist == 'courseupdatelist' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","COURSEUPDATELIST");
	XLINKTXT($link,"show my course list");
}

Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
