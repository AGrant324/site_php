<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_NEWSLETTERCOMPOSER_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

for ($newsseq = 0; $newsseq <= 20; $newsseq++) {
	if(isset($_REQUEST["news_id_".$newsseq])) {
		$innews_type = $_REQUEST["news_type_".$newsseq];		
		$innews_id = $_REQUEST["news_id_".$newsseq];		
		$inpublicationrequired = $_REQUEST["publicationrequired_".$newsseq];
		$inpublicationseq = $_REQUEST["publicationseq_".$newsseq];	
		$inpublicationexcerpt = $_REQUEST["publicationexcerpt_".$newsseq];	
		$inarchived = $_REQUEST["archived_".$newsseq];	
		
		if ( $innews_type == "A" ) {
			Get_Data("article",$innews_id);
			$GLOBALS{'article_publicationrequired'} = $inpublicationrequired; 
			$GLOBALS{'article_publicationseq'} = $inpublicationseq;
			$GLOBALS{'article_publicationexcerpt'} = $inpublicationexcerpt;
			$GLOBALS{'article_archived'} = $inarchived;	
			Write_Data("article",$innews_id);
		}
		if ( $innews_type == "E" ) {
			Get_Data("event",$innews_id);
			$GLOBALS{'event_publicationrequired'} = $inpublicationrequired; 
			$GLOBALS{'event_publicationseq'} = $inpublicationseq;
			$GLOBALS{'event_publicationexcerpt'} = $inpublicationexcerpt;
			$GLOBALS{'event_archived'} = $inarchived;	
			Write_Data("event",$innews_id);
		}
		if ( $innews_type == "C" ) {
			Get_Data("course",$innews_id);
			$GLOBALS{'course_publicationrequired'} = $inpublicationrequired;
			$GLOBALS{'course_publicationseq'} = $inpublicationseq;
			$GLOBALS{'course_publicationexcerpt'} = $inpublicationexcerpt;
			$GLOBALS{'course_archived'} = $inarchived;
			Write_Data("course",$innews_id);
		}
	}
}

$inmatchreportsummaries = $_REQUEST["matchreportsummaries"];

Webpage_NEWSLETTERCOMPOSER_Output($inmatchreportsummaries);

XHR();

Webpage_NEWSLETTERGENERATOR_Output($inmatchreportsummaries);

Back_Navigator();
PageFooter("Default","Final");


