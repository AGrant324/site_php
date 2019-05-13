<?php # frsteamresultin.php

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

$inarticle_id = $_REQUEST['article_id'];
$inmenulist = $_REQUEST['menulist'];
$inarticle_title = $_REQUEST['article_title'];
$inarticle_excerpt = $_REQUEST['article_excerpt'];
$inarticle_report = $_REQUEST['article_report'];
$inarticle_featuredimage = $_REQUEST['article_featuredimage_imagename'];
$ddpart = $_REQUEST['article_date_DDpart'];
$mmpart = $_REQUEST['article_date_MMpart'];
$yyyypart = $_REQUEST['article_date_YYYYpart'];
$inarticle_date = $yyyypart."-".$mmpart."-".$ddpart;
$inarticle_author = $_REQUEST['article_author'];
$inarticle_publicationstatus = $_REQUEST['article_publicationstatus'];
$inarticle_archived = $_REQUEST['article_archived'];
$inarticle_websiterequested = $_REQUEST['article_websiterequested'];
$inarticle_bulletinrequested = $_REQUEST['article_bulletinrequested'];
$inarticle_newsletterrequested = $_REQUEST['article_newsletterrequested'];
$inarticle_facebookrequested = $_REQUEST['article_facebookrequested'];
$inarticle_twitterrequested = $_REQUEST['article_twitterrequested'];

XH2("Article Composer - ".$inarticle_id." - ".$inarticle_title);
$action = "updated";
Check_Data("article",$inarticle_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("article"); $action = "added"; }

$GLOBALS{'article_id'} = $inarticle_id;
$GLOBALS{'article_title'} = $inarticle_title;
$GLOBALS{'article_excerpt'} = $inarticle_excerpt;
$GLOBALS{'article_report'} = $inarticle_report;
$GLOBALS{'article_featuredimage'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'article_featuredimage'},$inarticle_featuredimage);
$GLOBALS{'article_date'} = $inarticle_date;
$GLOBALS{'article_author'} = $inarticle_author;
$GLOBALS{'article_publicationstatus'} = $inarticle_publicationstatus;
$GLOBALS{'article_archived'} = $inarticle_archived;
$GLOBALS{'article_websiterequested'} = $inarticle_websiterequested;
$GLOBALS{'article_bulletinrequested'} = $inarticle_bulletinrequested;
$GLOBALS{'article_newsletterrequested'} = $inarticle_newsletterrequested;
$GLOBALS{'article_facebookrequested'} = $inarticle_facebookrequested;
$GLOBALS{'article_twitterrequested'} = $inarticle_twitterrequested;
$GLOBALS{'article_createdbypersonid'} = $GLOBALS{'LOGIN_person_id'};

Write_Data("article",$inarticle_id);
Webpage_PluginTriggerChanged_Output("article");

XPTXT("Article - ".$inarticle_id." ".$inarticle_title." ".$action);
XPTXT("This is how the article will be displayed");
Webpage_ARTICLEVIEW_Output($inarticle_id);
XBR();

XH2("Notifiers");
$notifierrequested = "0";
Get_Data("person",$GLOBALS{'article_createdbypersonid'});
$askingperson_email = $GLOBALS{'person_email1'};
$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$actiontext1 = "New"; $actiontext2 = "I have created a new";
if ($action == "updated" ) { $actiontext1 = "Updated"; $actiontext2 = "I have updated an "; }
Get_Data("commsmasters");
if ( $GLOBALS{'article_websiterequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_websitepublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Article for Website';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' article to be posted on website.<br><br>';
		$mainmessage = $mainmessage.'Article Title - '.$GLOBALS{'article_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'article_bulletinrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_bulletinpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Article for Bulletin Board';	
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' article to be posted on a bulletin board.<br><br>';
		$mainmessage = $mainmessage.'Article Title - '.$GLOBALS{'article_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'article_newsletterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_newsletterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Article for Newsletter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' article to be included in Newsletter.<br><br>';
		$mainmessage = $mainmessage.'Article Title - '.$GLOBALS{'article_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'article_facebookrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_facebookpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Article for Facebook';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' article to be posted out through Facebook.<br><br>';
		$mainmessage = $mainmessage.'Article Title - '.$GLOBALS{'article_title'}.'<br><br>';
		$mainmessage = $mainmessage.'Many Thanks,<br><br>'.$askingperson_fname;
		$emailcontent = $mainmessage;
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
		$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
		$emailfooter2 = "Please do not reply to this message";
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
}
if ( $GLOBALS{'article_twitterrequested'} == "Yes" ) {
    $notifierrequested = "1";
	Check_Data("person",$GLOBALS{'commsmasters_twitterpublisherlist'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$emailto = $GLOBALS{'person_email1'};
		$emailcc = "";
		$emailbcc = "";
		$emailsubject = $actiontext1.' Article for Twitter';
		$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
		$mainmessage = $mainmessage.$actiontext2.' article to be tweeted through Twitter.<br><br>';
		$mainmessage = $mainmessage.'Article Title - '.$GLOBALS{'article_title'}.'<br><br>';
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
$link = YPGMLINK("webpagearticleupdateout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$inarticle_id);
XLINKTXT($link,"make further updates to ths article");
XBR();
if ( $inmenulist == 'newslettercomposer' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","NEWSLETTERCOMPOSER");
	XLINKTXT($link,"return to the newsletter composer");		
}
if ( $inmenulist == 'articleupdatelist' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","ARTICLEUPDATELIST");
	XLINKTXT($link,"show my articles list");
}

Back_Navigator();
PageFooter("Default","Final");


