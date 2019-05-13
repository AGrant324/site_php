<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inevent_id = $_REQUEST['event_id'];
$inmenulist = $_REQUEST['menulist'];
$inevent_title = $_REQUEST['event_title'];
$inevent_excerpt = $_REQUEST['event_excerpt'];
$inevent_report = $_REQUEST['event_report'];
$inevent_featuredimage = $_REQUEST['event_featuredimage_imagename'];
$inevent_categoryid = $_REQUEST['event_categoryid'];
$ddpart = $_REQUEST['event_date_DDpart'];
$mmpart = $_REQUEST['event_date_MMpart'];
$yyyypart = $_REQUEST['event_date_YYYYpart'];
$inevent_venuecode = $_REQUEST['event_venuecode'];
$inevent_date = $yyyypart."-".$mmpart."-".$ddpart;
$inevent_time = StandardTime($_REQUEST['event_time']);
$inevent_contact = $_REQUEST['event_contact'];
$inevent_publicationstatus = $_REQUEST['event_publicationstatus'];
$inevent_archived = $_REQUEST['event_archived'];
$inevent_websiterequested = $_REQUEST['event_websiterequested'];
$inevent_bulletinrequested = $_REQUEST['event_bulletinrequested'];
$inevent_newsletterrequested = $_REQUEST['event_newsletterrequested'];
$inevent_facebookrequested = $_REQUEST['event_facebookrequested'];
$inevent_twitterrequested = $_REQUEST['event_twitterrequested'];
$inevent_showinemail = $_REQUEST['event_showinemail'];
$inevent_bookable = $_REQUEST['event_bookable'];
$inevent_maximumattendees = $_REQUEST['event_maximumattendees'];
$inevent_full = $_REQUEST['event_full'];
$inevent_personorteam = $_REQUEST['event_personorteam'];
$inevent_charge = $_REQUEST['event_charge'];
$inevent_discountpercent = $_REQUEST['event_discountpercent'];
$inevent_discountthreshold = $_REQUEST['event_discountthreshold'];
if( is_array($_REQUEST['event_paymentoptionslist'])) {
	# one of checkboxes selected
	$inevent_paymentoptionslist = Array2List($_REQUEST['event_paymentoptionslist']);
} else {
	$inevent_paymentoptionslist  = "";
}

XH2("Event Composer - ".$inevent_id." - ".$inevent_title);
$action = "updated";
Check_Data("event",$inevent_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("event"); $action = "added"; }

$GLOBALS{'event_id'} = $inevent_id;
$GLOBALS{'event_title'} = $inevent_title;
$GLOBALS{'event_excerpt'} = $inevent_excerpt;
$GLOBALS{'event_report'} = $inevent_report;
$GLOBALS{'event_featuredimage'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'event_featuredimage'},$inevent_featuredimage);
$GLOBALS{'event_categoryid'} = $inevent_categoryid;
if ($GLOBALS{'event_categoryid'} == "") { $GLOBALS{'event_categoryid'} = "Default"; }
$GLOBALS{'event_date'} = $inevent_date;
$GLOBALS{'event_venuecode'} = $inevent_venuecode;
$GLOBALS{'event_time'} = $inevent_time;
$GLOBALS{'event_contact'} = $inevent_contact;
$GLOBALS{'event_publicationstatus'} = $inevent_publicationstatus;
$GLOBALS{'event_archived'} = $inevent_archived;
$GLOBALS{'event_websiterequested'} = $inevent_websiterequested;
$GLOBALS{'event_bulletinrequested'} = $inevent_bulletinrequested;
$GLOBALS{'event_newsletterrequested'} = $inevent_newsletterrequested;
$GLOBALS{'event_facebookrequested'} = $inevent_facebookrequested;
$GLOBALS{'event_twitterrequested'} = $inevent_twitterrequested;
$GLOBALS{'event_showinemail'} = $inevent_showinemail;
$GLOBALS{'event_bookable'} = $inevent_bookable;
$GLOBALS{'event_maximumattendees'} = $inevent_maximumattendees;
$GLOBALS{'event_full'} = $inevent_full;
$GLOBALS{'event_personorteam'} = $inevent_personorteam;
$GLOBALS{'event_charge'} = $inevent_charge;
$GLOBALS{'event_discountpercent'} = $inevent_discountpercent;
$GLOBALS{'event_discountthreshold'} = $inevent_discountthreshold;
$GLOBALS{'event_paymentoptionslist'} = $inevent_paymentoptionslist;
$GLOBALS{'event_createdbypersonid'} = $GLOBALS{'LOGIN_person_id'};

Write_Data("event",$inevent_id);
Webpage_PluginTriggerChanged_Output("event");

XPTXT("Event - ".$inevent_id." ".$inevent_title." ".$action);
XPTXT("This is how the event will be displayed");
Webpage_EVENTVIEW_Output($inevent_id);
XBR();

XH2("Notifiers");
$notifierrequested = "0";
Get_Data("person",$GLOBALS{'event_createdbypersonid'});
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$actiontext1 = "New"; $actiontext2 = "I have created a new";
if ($action == "updated" ) { $actiontext1 = "Updated"; $actiontext2 = "I have updated an "; }
Get_Data("commsmasters");
if ( $GLOBALS{'event_websiterequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_websitepublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Event for Website';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' event to be posted on website.<br><br>';
		$mainmessage = $mainmessage.'Event Title - '.$GLOBALS{'event_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'event_bulletinrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_bulletinpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Event for Bulletin Board';	
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' event to be posted on a bulletin board.<br><br>';
		$mainmessage = $mainmessage.'Event Title - '.$GLOBALS{'event_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'event_newsletterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_newsletterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Event for Newsletter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' event to be included in Newsletter.<br><br>';
		$mainmessage = $mainmessage.'Event Title - '.$GLOBALS{'event_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'event_facebookrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_facebookpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Event for Facebook';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' event to be posted out through Facebook.<br><br>';
		$mainmessage = $mainmessage.'Event Title - '.$GLOBALS{'event_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'event_twitterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_twitterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Event for Twitter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' event to be tweeted through Twitter.<br><br>';
		$mainmessage = $mainmessage.'Event Title - '.$GLOBALS{'event_title'}.'<br><br>';
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
$link = YPGMLINK("webpageeventupdateout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$inevent_id);
XLINKTXT($link,"make further updates to ths event");
XBR();
if ( $inmenulist == 'newslettercomposer' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","NEWSLETTERCOMPOSER");
	XLINKTXT($link,"return to the bnewsletter composer");		
}
if ( $inmenulist == 'eventupdatelist' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","EVENTUPDATELIST");
	XLINKTXT($link,"show my events list");
}

Back_Navigator();
PageFooter("Default","Final");




