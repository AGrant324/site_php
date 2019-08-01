<?php

function Webpage_SETUPARTICLECATEGORY_Output() {
	$parm0 = "Article Category|articlecategory||articlecategory_id|articlecategory_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."articlecategory_id|Yes|Category|100|Yes|Article Category|KeyText,8,8^";
	$parm1 = $parm1."articlecategory_name|Yes|Title|150|Yes|Title|InputText,50,90^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Webpage_ARTICLEUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Webpage_ARTICLEUTILITY_Output() {
	$parm0 = "Articles|article|person,articlecategory|article_id|article_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."article_id|Yes|Id|40|Yes|Article Id|KeyGenerated,A[00000]^";
	$parm1 = $parm1."article_categoryid|Yes|Category|60|Yes|Category|InputSelectFromTable,articlecategory,articlecategory_id,articlecategory_name,articlecategory_id^";
	// $parm1 = $parm1."article_priority|Yes|Priority|40|Yes|Article Priority|InputSelectFromList,1+2+3^";
	$parm1 = $parm1."article_priority|Yes|Priority|40|Yes|Article Priority|InputText,25,50^";
	$parm1 = $parm1."article_title|Yes|Title|40|Yes|Article Title|InputText,25,50^";
	$parm1 = $parm1."article_excerpt|No||40|Yes|Article Excerpt|InputTextArea,3,50^";	
	// $parm1 = $parm1."article_report|No||40|Yes|Article Report|InputTextArea,10,50^";
	$parm1 = $parm1."article_date|Yes|Date|40|Yes|Date|InputDate^";
	$parm1 = $parm1."article_author|Yes|Author|40|Yes|Author|InputPerson,10,20,Author,Lookup^";
	$parm1 = $parm1."article_createdbypersonid|Yes|CreatedBy|40|Yes|Article Created By|InputPerson,10,20,CreatedBy,Lookup^";	
	$parm1 = $parm1."article_featuredimage|Yes|Photo|30|Yes|Featured Image|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,600,flex,Article,article_id^";
	$parm1 = $parm1."article_featuredimagecaption|No||40|Yes|Featured Image Caption|InputText,25,50^";
	$parm1 = $parm1."article_publicationstatus|Yes|Status|40|Yes|Publication Status|InputSelectFromList,Draft+Ready+Published^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";		
	GenericHandler_Output ($parm0,$parm1);

	$p0 = "person_id|person_sname|person_fname";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Author,Author..,article_author_input,article_author_personlist,50|field,CreatedBy,CreatedBy..,article_createdbypersonid_input,article_createdbypersonid_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "person_change,center,center,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);	
}

function Webpage_SETUPEVENTCATEGORY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Webpage_SETUPEVENTCATEGORY_Output() {
	$parm0 = "Event Category|eventcategory|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|eventcategory_id|eventcategory_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."eventcategory_id|Yes|Category|100|Yes|Event Category|KeyText,8,8^";
	$parm1 = $parm1."eventcategory_name|Yes|Title|150|Yes|Title|InputText,50,90^";
	$parm1 = $parm1."eventcategory_treasurer|No|||Yes|Treasurer|InputPerson,10,20,Treasurer,Lookup^";
	$parm1 = $parm1."eventcategory_banksort|No||30|Yes|Bank Sort Code|InputText,8,8^";
	$parm1 = $parm1."eventcategory_bankaccount|No||30|Yes|Bank Account Code|InputText,8,8^";
	$parm1 = $parm1."eventcategory_bankaccountname|No||30|Yes|Bank Account Name|InputText,25,50^";
	$parm1 = $parm1."eventcategory_paypalemail|No||30|Yes|Pay Pal Email|InputText,25,50^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "this,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Treasurer,Treasurer..,eventcategory_treasurer_input,eventcategory_treasurer_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "eventcategory,center,center,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Webpage_EVENTUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,calendarpopup,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,Calendar_Popup";
}

function Webpage_EVENTUTILITY_Output() {
	$parm0 = "Events|event|person,eventcategory|event_id|event_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."event_id|Yes|Event Id|60|Yes|Event Id|KeyGenerated,E[00000]^";
	$parm1 = $parm1."event_categoryid|Yes|Category|100|Yes|Category|InputSelectFromTable,eventcategory,eventcategory_id,eventcategory_name,eventcategory_id^";
	$parm1 = $parm1."event_priority|Yes|Priority|60|Yes|Event Priority|InputSelectFromList,1+2+3^";
	$parm1 = $parm1."event_title|Yes|Title|150|Yes|Event Title|InputText,25,50^";
	$parm1 = $parm1."event_excerpt|No||40|Yes|Event Excerpt|InputTextArea,3,50^";	
	// $parm1 = $parm1."event_report|No||40|Yes|Event Report|InputTextArea,10,50^";
	$parm1 = $parm1."event_date|Yes|Date|80|Yes|Event Date|InputDate^";
	$parm1 = $parm1."event_contact|Yes|Contact|80|Yes|Event Contact|InputPerson,10,20,Contact,Lookup^";
	$parm1 = $parm1."event_createdbypersonid|Yes|CreatedBy|80|Yes|Event Created By|InputPerson,10,20,CreatedBy,Lookup^";	
	$parm1 = $parm1."event_featuredimage|Yes|Photo|50|Yes|Featured Image|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,600,flex,Event,event_id^";
	$parm1 = $parm1."event_featuredimagecaption|No||40|Yes|Featured Image Caption|InputText,25,50^";
	$parm1 = $parm1."event_publicationstatus|Yes|Status|70|Yes|Publication Status|InputSelectFromList,Draft+Ready+Published^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";	
	GenericHandler_Output ($parm0,$parm1);
	
	$p0 = "person_id|person_sname|person_fname";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Contact,Contact..,event_contact_input,event_contact_personlist,50|field,CreatedBy,CreatedBy..,event_createdbypersonid_input,event_createdbypersonid_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "person_change,center,center,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Webpage_NEWSLETTERCOMPOSER_CSSJS() { 
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "newslettercomposer,jqueryconfirm";
}

function Webpage_NEWSLETTERCOMPOSER_Output($matchreportsummaries) {
	XH2("Newsletter Composer");
	XHR();		
	
	XH2("Step 1; Select the latest Articles and Events to include");	

	$link = YPGMLINK("webpagearticleupdateout.php").YPGMSTDPARMS();
	$link = $link.YPGMPARM("article_id","new");
	$link = $link.YPGMPARM("menulist","newslettercomposer");
	XLINKBUTTON($link,"Create New Article");
	$link = YPGMLINK("webpageeventupdateout.php").YPGMSTDPARMS();
	$link = $link.YPGMPARM("event_id","new");
	$link = $link.YPGMPARM("menulist","newslettercomposer");
	XLINKBUTTON($link,"Create New Event");
	$link = YPGMLINK("bookingcourseout.php").YPGMSTDPARMS();
	$link = $link.YPGMPARM("course_id","new");
	$link = $link.YPGMPARM("menulist","newslettercomposer");
	XLINKBUTTON($link,"Create New Course");
	XBR();XBR();
	
	XFORM("webnewslettercomposerin.php","newslettercomposer");
	XINSTDHID();
	
	$combineda = Array();
	$articlea = Get_Array('article');
	foreach ($articlea as $article_id) {
		Get_Data("article",$article_id);
		$publicationseq = $GLOBALS{'article_publicationseq'};
		$excludenow = "2"; # makes included items com to top
		if ( $GLOBALS{'article_archived'} == "Yes") { $excludenow = "0"; $publicationseq = ""; } 
		if ( $GLOBALS{'article_publicationrequired'} == "Yes") { $excludenow = "2"; }
		if ( $GLOBALS{'article_publicationstatus'} != "Draft") { 
			array_push($combineda, $excludenow."|".$GLOBALS{'article_date'}."|".$publicationseq."|"."A"."|".$article_id);
		}	
	}
	$eventa = Get_Array('event');
	foreach ($eventa as $event_id) {
		Get_Data("event",$event_id);
		$publicationseq = $GLOBALS{'event_publicationseq'};
		$excludenow = "2"; # makes included items com to top
		if ( $GLOBALS{'event_archived'} == "Yes") { $excludenow = "0"; $publicationseq = ""; } 
		if ( $GLOBALS{'event_publicationrequired'} == "Yes") { $excludenow = "2"; } 
		if ( $GLOBALS{'event_publicationstatus'} != "Draft") { 
			array_push($combineda, $excludenow."|".$GLOBALS{'event_date'}."|".$publicationseq."|"."E"."|".$event_id);
		}
	}
	$coursea = Get_Array('course');
	foreach ($coursea as $course_id) {
		Get_Data("course",$course_id);
		$publicationseq = $GLOBALS{'course_publicationseq'};
		$excludenow = "2"; # makes included items come to top - REVERSE SORT
		if ( $GLOBALS{'course_archived'} == "Yes") { $excludenow = "0"; $publicationseq = ""; }
		if ( $GLOBALS{'course_publicationrequired'} == "Yes") { $excludenow = "2"; }
		if ( $GLOBALS{'course_publicationstatus'} != "Draft") { 
			array_push($combineda, $excludenow."|".$GLOBALS{'course_datestart'}."|".$publicationseq."|"."C"."|".$course_id);
		}
	}
	array_push($combineda, "1||||");
	rsort($combineda);

	XTABLE();
	XTR();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date");
	XTDHTXT("Author<br>/Contact");
	XTDHTXT("Status");	
	XTDHTXT("Featured<br>Image");	
	XTDHTXT("Include<br>Now");
	XTDHTXT("Sequence");
	XTDHTXT("Excerpt<br>Only");
	XTDHTXT("Put in<br>Archive");	
	XTDHTXT("Edit");
	XTDHTXT("Newsletter<br>View");
	XTDHTXT("Facebook<br>View");
	X_TR();
	
	$archivemax = 20;
	$archivecount = 0;
	$newsseq = 0;
	foreach ($combineda as $combinedelement) {
		if ($archivecount <= $archivemax ) {
			$bitsa = explode("|", $combinedelement);
			if ( $bitsa[3] == "A"  ) {
				$article_id = $bitsa[4];
				Get_Data("article",$article_id);
				if ( $GLOBALS{'article_archived'} == "Yes") { $archivecount++; }
				XINHID("news_type_".$newsseq,"A");
				XINHID("news_id_".$newsseq,$article_id);
				XTR();
				XTDTXT($article_id);
				XTDTXT($GLOBALS{'article_title'});
				XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'article_date'}));
				XTDTXT($GLOBALS{'article_author'});
				if ($GLOBALS{'article_publicationstatus'} == "") { XTDTXT($GLOBALS{'article_publicationstatus'}); }
				if ($GLOBALS{'article_publicationstatus'} == "Draft") { XTD();XTXTCOLOR($GLOBALS{'article_publicationstatus'},"red");X_TD(); }
				if ($GLOBALS{'article_publicationstatus'} == "Ready") { XTD();XTXTCOLOR($GLOBALS{'article_publicationstatus'},"orange");X_TD(); }		
				if ($GLOBALS{'article_publicationstatus'} == "Published") { XTD();XTXTCOLOR($GLOBALS{'article_publicationstatus'},"green");X_TD(); }		
				if ($GLOBALS{'article_featuredimage'} == "") { XTDTXT(""); }
				else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'article_featuredimage'},"50"); }
				$publicationrequired = $GLOBALS{'article_publicationrequired'}; 
				if ( $publicationrequired != "Yes" ) { $publicationrequired = "No"; }
				XTDINCHECKBOXYESNO("publicationrequired_".$newsseq,$publicationrequired,"");
				XTDINTXT("publicationseq_".$newsseq,$GLOBALS{'article_publicationseq'},"3","3");
				$publicationexcerpt = $GLOBALS{'article_publicationexcerpt'}; 
				if ( $publicationexcerpt != "Yes" ) { $publicationexcerpt = "No"; }
				XTDINCHECKBOXYESNO("publicationexcerpt_".$newsseq,$publicationexcerpt,"");
				$archived = $GLOBALS{'article_archived'}; 
				if ( $archived != "Yes" ) { $archive = "No"; }
				XTDINCHECKBOXYESNO("archived_".$newsseq,$archived,"");
				$link = YPGMLINK("webpagearticleupdateout.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$article_id).YPGMPARM("menulist","composer");
				XTDLINKTXT($link,"edit");
				$link = YPGMLINK("webpagearticlewebview.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$article_id);
				XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
				$link = YPGMLINK("webpagearticlefbview.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$article_id);
				XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
				X_TR();
				$newsseq++;
			}
			if ( $bitsa[3] == "E"  ) {
				$event_id = $bitsa[4];
				Get_Data("event",$event_id);
				if ( $GLOBALS{'event_archived'} == "Yes") { $archivecount++; }
				XINHID("news_type_".$newsseq,"E");
				XINHID("news_id_".$newsseq,$event_id);
				XTR();
				XTDTXT($event_id);
				XTDTXT($GLOBALS{'event_title'});
				XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
				XTDTXT($GLOBALS{'event_contact'});
				if ($GLOBALS{'event_publicationstatus'} == "") { XTDTXT($GLOBALS{'event_publicationstatus'}); }
				if ($GLOBALS{'event_publicationstatus'} == "Draft") { XTD();XTXTCOLOR($GLOBALS{'event_publicationstatus'},"red");X_TD(); }
				if ($GLOBALS{'event_publicationstatus'} == "Ready") { XTD();XTXTCOLOR($GLOBALS{'event_publicationstatus'},"orange");X_TD(); }		
				if ($GLOBALS{'event_publicationstatus'} == "Published") { XTD();XTXTCOLOR($GLOBALS{'event_publicationstatus'},"green");X_TD(); }		
				if ($GLOBALS{'event_featuredimage'} == "") { XTDTXT(""); }
				else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'},"50"); }
				$publicationrequired = $GLOBALS{'event_publicationrequired'}; 
				if ( $publicationrequired != "Yes" ) { $publicationrequired = "No"; }
				XTDINCHECKBOXYESNO("publicationrequired_".$newsseq,$publicationrequired,"");
				XTDINTXT("publicationseq_".$newsseq,$GLOBALS{'event_publicationseq'},"3","3");
				$publicationexcerpt = $GLOBALS{'event_publicationexcerpt'}; 
				if ( $publicationexcerpt != "Yes" ) { $publicationexcerpt = "No"; }
				XTDINCHECKBOXYESNO("publicationexcerpt_".$newsseq,$publicationexcerpt,"");
				$archived = $GLOBALS{'event_archived'}; 
				if ( $archived != "Yes" ) { $archived = "No"; }
				XTDINCHECKBOXYESNO("archived_".$newsseq,$archived,"");
				$link = YPGMLINK("webpageeventupdateout.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id).YPGMPARM("menulist","composer");
				XTDLINKTXT($link,"edit");
				$link = YPGMLINK("webpageeventwebview.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id);
				XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
				$link = YPGMLINK("webpageeventfbview.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id);
				XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
				X_TR();
				$newsseq++;
			}
			if ( $bitsa[3] == "C"  ) {
				$course_id = $bitsa[4];
				Get_Data("course",$course_id);
				if ( $GLOBALS{'course_archived'} == "Yes") { $archivecount++; }
				XINHID("news_type_".$newsseq,"C");
				XINHID("news_id_".$newsseq,$course_id);
				XTR();
				XTDTXT($course_id);
				XTDTXT($GLOBALS{'course_title'});
				if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
					XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
				} else {
					XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));
				}
				XTDTXT($GLOBALS{'course_contact'});		
				if ($GLOBALS{'course_publicationstatus'} == "") { XTDTXT($GLOBALS{'course_publicationstatus'}); }
				if ($GLOBALS{'course_publicationstatus'} == "Draft") { XTD();XTXTCOLOR($GLOBALS{'course_publicationstatus'},"red");X_TD(); }
				if ($GLOBALS{'course_publicationstatus'} == "Ready") { XTD();XTXTCOLOR($GLOBALS{'course_publicationstatus'},"orange");X_TD(); }		
				if ($GLOBALS{'course_publicationstatus'} == "Published") { XTD();XTXTCOLOR($GLOBALS{'course_publicationstatus'},"green");X_TD(); }	
				if ($GLOBALS{'course_featuredimage'} == "") {
					XTDTXT("");
				}
				else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"50");
				}
				$publicationrequired = $GLOBALS{'course_publicationrequired'};
				if ( $publicationrequired != "Yes" ) {
					$publicationrequired = "No";
				}
				XTDINCHECKBOXYESNO("publicationrequired_".$newsseq,$publicationrequired,"");
				XTDINTXT("publicationseq_".$newsseq,$GLOBALS{'course_publicationseq'},"3","3");
				$publicationexcerpt = $GLOBALS{'course_publicationexcerpt'};
				if ( $publicationexcerpt != "Yes" ) { $publicationexcerpt = "No"; }
				XTDINCHECKBOXYESNO("publicationexcerpt_".$newsseq,$publicationexcerpt,"");
				$archived = $GLOBALS{'course_archived'};
				if ( $archived != "Yes" ) {
					$archived = "No";
				}
				XTDINCHECKBOXYESNO("archived_".$newsseq,$archived,"");
				$link = YPGMLINK("bookingcourseupdateout.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id).YPGMPARM("menulist","composer").YPGMPARM("action","update");
				XTDLINKTXT($link,"edit");
				$link = YPGMLINK("webpagecoursewebview.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
				XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
				$link = YPGMLINK("webpagecoursefbview.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
				XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
				X_TR();
				$newsseq++;
			}		
			if ( $bitsa[0] == "1"  ) {
				XTR();
				XTDHTXT("Archived");
				XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");
				XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");
				XTDHTXT("");XTDHTXT("");		
				X_TR();
			}
		}
	}
	X_TABLE();
	XBR();
	XHR();	
	XH2("Step 2; Include Match Report Summaries if required.");
	XINCHECKBOXYESNO("matchreportsummaries",$matchreportsummaries,"Include Match Report Summaries");
	XBR();
	XHR();
	XH2("Step 3: Preview Newsletter");
	XINSUBMIT("Preview Latest Changes to Newsletter");XBR();XBR();
	
	X_FORM();
	XBR();
	XHRCLASS ("underline");
}

function EAHTML2PAGE($eahtmlin,$maxwidth) {    
    // clean out the unnecessary extra html
    $eahtmlin = str_replace('<p>&nbsp;</p>', '', $eahtmlin);
    $eahtmlin = str_replace('<p><!--', '<!--', $eahtmlin);
    $eahtmlin = str_replace('--></p>', '-->', $eahtmlin);
    
    $eahtmlout = "";
    $eahtmlrawa = explode('<',$eahtmlin);
    $first = "1";
    
    $hi = 0;
    while ( $hi < sizeof($eahtmlrawa) ) {
        $eahtmlrawline = $eahtmlrawa[$hi];
        if ( $first != "1" ) { $eahtmlrawline = '<'.$eahtmlrawline; }
        $first = "0";
        // Constrain all images to width of container - $maxwidth
        // <img src="//localhost/havanthockeyclub/domain_media/Event_E00024_AreaMap900.jpeg?1527498886486" width="800" height="742" />
        if (strlen(strstr($eahtmlrawline,'<img src=')) > 0) {
           if (strlen(strstr($eahtmlrawline,'width="')) > 0) {          
                $wbits1 = explode('width="',$eahtmlrawline);
                $wbits2 = explode('"',$wbits1[1]);               
                if ( $wbits2[0] > $maxwidth) {
                    $origwstring = 'width="'.$wbits2[0].'"';
                    $replwstring = 'width="100%"';                  
                    $eahtmlrawline = str_replace($origwstring, $replwstring, $eahtmlrawline);
                    if (strlen(strstr($eahtmlrawline,'height="')) > 0) {
                        $hbits1 = explode('height="',$eahtmlrawline);
                        $hbits2 = explode('"',$hbits1[1]);
                        $orighstring = 'height="'.$hbits2[0].'"';
                        $replhstring = '';
                        $eahtmlrawline = str_replace($orighstring, $replhstring, $eahtmlrawline);
                    }
                }
            }
        }

        $eahtmlout = $eahtmlout.$eahtmlrawline;
        $hi++;
    };
    return $eahtmlout;
}


function Webpage_WEBSTYLE_Output() {
	print "<style>\n";
	print ".eaclass {\n";
	print "	border-radius: 10px;\n";
	print "	border: 2px solid #777777;\n";
	print "	padding: 30px;\n";
	print "	width: 100%;\n";
	print "	max-width: 800px;\n";
	print "	-webkit-box-shadow: 2px 2px 2px 2px #eee;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */\n";
	print "	-moz-box-shadow:    2px 2px 2px 2px #eee;  /* Firefox 3.5 - 3.6 */\n";
	print "	box-shadow:         2px 2px 2px 2px #eee;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */\n";
	print "</style>\n";
}

function Webpage_NEWSLETTERSTYLE_Output() {
	print "<style>\n";
	print ".eaclass {\n";
	print "	border-radius: 10px;\n";
	print "	border: 2px solid #777777;\n";
	print "	padding: 20px;\n";
	print "	width: 600px;\n";
	print "	-webkit-box-shadow: 2px 2px 2px 2px #eee;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */\n";
	print "	-moz-box-shadow:    2px 2px 2px 2px #eee;  /* Firefox 3.5 - 3.6 */\n";
	print "	box-shadow:         2px 2px 2px 2px #eee;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */\n";
	print "</style>\n";
}

function Webpage_FBSTYLE_Output() {
	print "<style>\n";
	print ".eaclass {\n";	
	print "	border: 2px solid #777777;\n";
	print "	padding: 30px;\n";
	print "	width: 90%;\n";

	print "	-webkit-box-shadow: 2px 2px 2px 2px #eee;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */\n";
	print "	-moz-box-shadow:    2px 2px 2px 2px #eee;  /* Firefox 3.5 - 3.6 */\n";
	print "	box-shadow:         2px 2px 2px 2px #eee;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */\n";
	print "</style>\n";
}

function Webpage_NEWSLETTERGENERATOR_Output($matchreportsummaries) {

    XINBUTTONIDSPECIAL ("copynewsletter","warning","I'm OK with this - Now Copy Content Ready to Paste into MailChimp");
    XH2("Newsletter Preview");
	XBR();XBR();

	XDIV("newslettercontent","");
    Webpage_NEWSLETTERSTYLE_Output();	
	$combineda = Array();
	$articlea = Get_Array('article');
	foreach ($articlea as $article_id) {
		Get_Data("article",$article_id);
		if ( $GLOBALS{'article_publicationrequired'} == "Yes" ) {
			array_push($combineda, $GLOBALS{'article_publicationseq'}."|".$GLOBALS{'article_date'}."|"."A"."|".$article_id);
		}
	}
	$eventa = Get_Array('event');
	foreach ($eventa as $event_id) {
		Get_Data("event",$event_id);
		if ( $GLOBALS{'event_publicationrequired'} == "Yes" ) {
			array_push($combineda, $GLOBALS{'event_publicationseq'}."|".$GLOBALS{'event_date'}."|"."E"."|".$event_id);
		}
	}
	$coursea = Get_Array('course');
	foreach ($coursea as $course_id) {
		Get_Data("course",$course_id);
		if ( $GLOBALS{'course_publicationrequired'} == "Yes" ) {
			array_push($combineda, $GLOBALS{'course_publicationseq'}."|".$GLOBALS{'course_datestart'}."|"."C"."|".$course_id);
		}
	}
	sort($combineda);

	foreach ($combineda as $combinedelement) {
		$bitsa = explode("|", $combinedelement);
		if ( $bitsa[2] == "A"  ) {
			Get_Data("article",$bitsa[3]);
			if ($GLOBALS{'article_publicationstatus'} == "Published") {
			    if ( $GLOBALS{'article_publicationexcerpt'} != "Yes" )	{
    				XDIV($bitsa[2],"eaclass" );
    				XH3($GLOBALS{'article_title'});
    				XTXT($GLOBALS{'article_excerpt'});
    				if ($GLOBALS{'article_featuredimage'} != "") {
    				    XBR();XBR();XIMGWIDTH(Field2URL($GLOBALS{'domainwwwurl'})."/domain_media/".$GLOBALS{'article_featuredimage'},"95%");
    				}
    				XBR();XBR();
    				XTXT(EAHTML2PAGE($GLOBALS{'article_report'},"470"));
    				XBR();
    				Check_Data("person",$GLOBALS{'article_author'});
    				if ($GLOBALS{'IOWARNING'} == "0" ) { 
    					XTXT("Author - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$GLOBALS{'person_sname'});	
    				} else {
    					XTXT("Author - ".$GLOBALS{'article_author'});	
    				}
    				XBR();
    				XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'article_date'}));
    				XBR();
    				X_DIV($bitsa[2]);
    				XBR();
			    } else {
			        XDIV($bitsa[2],"eaclass" );
    			    XTABLEINVISIBLE();
    			    XTR();
    			    if ($GLOBALS{'article_featuredimage'} != "") {
    			        XTDTOP();
    			        XIMG(Field2URL($GLOBALS{'domainwwwurl'})."/domain_media/".$GLOBALS{'article_featuredimage'},"150","","");
    			        X_TD();
    			        XTDTXT("&nbsp;&nbsp;&nbsp;");
    			    }
    			    XTDTOP();
    			    XH3TOP($GLOBALS{'article_title'});
    			    XBR();
    			    XTXT($GLOBALS{'article_excerpt'});
    			    XBR();XBR();
    			    $link = YPGMLINK("webpagearticlewebview.php");
    			    $link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$bitsa[3]);
    			    XLINKTXTNEWPOPUP($link,"Read More..","articleview","100","100","800","800");
    			    X_TD();
    			    X_TR();
    			    X_TABLE();
    			    X_DIV($bitsa[2]);
    			    XBR();		        
			    }
			}
		}
		if ( $bitsa[2] == "E"  ) {
			Get_Data("event",$bitsa[3]);
			if ($GLOBALS{'event_publicationstatus'} == "Published") {
			    if ( $GLOBALS{'event_publicationexcerpt'} != "Yes" )	{
    				XDIV($bitsa[2],"eaclass" );
    				XH3($GLOBALS{'event_title'});
    				XTXT($GLOBALS{'event_excerpt'});
    				if ($GLOBALS{'event_featuredimage'} != "") {
    				    XBR();XBR();XIMGWIDTH(Field2URL($GLOBALS{'domainwwwurl'})."/domain_media/".$GLOBALS{'event_featuredimage'},'95%');
    				}
    				XBR();XBR();
    				XTXT(EAHTML2PAGE($GLOBALS{'event_report'},"470"));
    				XBR();
    				Check_Data("person",$GLOBALS{'event_contact'});
    				if ($GLOBALS{'IOWARNING'} == "0" ) {
    					$showmobiletel = ""; $showemail = "";
    					if ($GLOBALS{'person_mobiletel'} != "" ) { $showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'}; }
    					if ($GLOBALS{'person_email1'} != "" ) { $showemail = "Email: ".$GLOBALS{'person_email1'}; }				
    					XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$showmobiletel." ".$showemail);
    				} else {
    					XTXT("Contact - ".$GLOBALS{'event_contact'});
    				}
    				XBR();
    				XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
    				XBR();
    				XTXT("Time - ".$GLOBALS{'event_time'});
    				XBR();
    				Check_Data('venue',$GLOBALS{'event_venuecode'});
    				XTXT("Venue - ".$GLOBALS{'venue_name'});
    				XBR();
    							
    				if ($GLOBALS{'event_full'} == "Yes") { XH4("Sorry this event is now fully booked."); }	
    				if ($GLOBALS{'event_personorteam'} == "Team") { XTXT("This is a team event").XBR(); }	
    				
    				if ($GLOBALS{'event_bookable'} == "Yes") {
    					if ($GLOBALS{'event_charge'} != 0) {
    						if ($GLOBALS{'event_personorteam'} == "Team") { 
    							XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
    						} else { 
    							XTXT("Charge per person - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
    							if ($GLOBALS{'event_discountpercent'} != "") {
    								XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
    							}				
    						}
    					}
    					XBR();XBR();
    					$link = YPGMLINK("bookingeventout.php");
    					$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
    					XLINKBUTTONNEWWINDOW ($link,"Book This Event","Booking");	
    				} else {
    					if ($GLOBALS{'event_charge'} != 0) {
    						if ($GLOBALS{'event_personorteam'} == "Team") { 
    							XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
    						} else { 
    							XTXT("Charge per person - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
    							if ($GLOBALS{'event_discountpercent'} != "") {
    								XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
    							}				
    						}
    					}
    				}   
    				X_DIV($bitsa[2]);
    				XBR();
			    } else {
			        XDIV($bitsa[2],"eaclass" );
			        XTABLEINVISIBLE();
			        XTR();
			        if ($GLOBALS{'event_featuredimage'} != "") {
			            XTDTOP();
			            XIMG(Field2URL($GLOBALS{'domainwwwurl'})."/domain_media/".$GLOBALS{'event_featuredimage'},"150","","");
			            X_TD();
			            XTDTXT("&nbsp;&nbsp;&nbsp;");
			        }
			        XTDTOP();
			        XH3TOP($GLOBALS{'event_title'});
			        XBR();
			        XTXT($GLOBALS{'event_excerpt'});
			        XBR();XBR();
			        $link = YPGMLINK("webpageeventwebview.php");
			        $link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$bitsa[3]);
			        XLINKTXTNEWPOPUP($link,"Read More..","eventview","100","100","800","800");
			        X_TD();
			        X_TR();
			        X_TABLE();
			        X_DIV($bitsa[2]);
			        XBR();	
			    }    		
			}
		}
		if ( $bitsa[2] == "C"  ) {
			Get_Data("course",$bitsa[3]);
			if ($GLOBALS{'course_publicationstatus'} == "Published") {
			    if ( $GLOBALS{'course_publicationexcerpt'} != "Yes" )	{
    				XDIV($bitsa[2],"eaclass" );
    				XH3($GLOBALS{'course_title'});
    				XTXT($GLOBALS{'course_excerpt'});
    				if ($GLOBALS{'course_featuredimage'} != "") {
    				    XBR();XBR();XIMGWIDTH(Field2URL($GLOBALS{'domainwwwurl'})."/domain_media/".$GLOBALS{'course_featuredimage'},"95%");
    				}
    				XBR();XBR();
    				XTXT(EAHTML2PAGE($GLOBALS{'course_description'},"470"));
    				XBR();
    				Check_Data("person",$GLOBALS{'course_contact'});
    				if ($GLOBALS{'IOWARNING'} == "0" ) {
    					$showmobiletel = ""; $showemail = "";
    					if ($GLOBALS{'person_mobiletel'} != "" ) {
    						$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
    					}
    					if ($GLOBALS{'person_email1'} != "" ) {
    						$showemail = "Email: ".$GLOBALS{'person_email1'};
    					}
    					XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." | ".$showmobiletel." | ".$showemail);
    				} else {
    					XTXT("Contact - ".$GLOBALS{'course_contact'});
    				}
    				XBR();
    				XTXT("Venue - ".$GLOBALS{'course_venue'});
    				XBR();
    				if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
    					XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
    				} else {
    					XTXT("Dates - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
    				}
    				XBR();
    				XTXT("Time - ".$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'});
    				XBR();XBR();
    				if ($GLOBALS{'course_charge'} == 0) {
    					XTXT("Free of Charge");
    				} else {
    					XTXT("Charge - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_charge'}, 2, '.', ''));
    					if ( $GLOBALS{'course_prepaidcharge'} != 0 ) {
    						XTXT(" : If pre-paid online - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_prepaidcharge'}, 2, '.', ''));
    					}
    					if ( $GLOBALS{'course_earlycharge'} != 0 ) {
    						XTXT(" : If pre-paid online before - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_earlychargedate'})." - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_earlycharge'}, 2, '.', ''));
    					}
    				}
    				if ($GLOBALS{'course_partchargepermitted'} == "Yes") {
    					XPTXT($GLOBALS{'course_partchargeinstructions'});
    				}
    				XBR();XBR();
    				if ($GLOBALS{'course_paymentoptionslist'} != "") {
        				$link = YPGMLINK("bookingcourseout.php");
        				$link = $link.YPGMMINPARMS().YPGMPARM("course_id",$bitsa[3]);
        				XLINKBUTTONNEWWINDOW ($link,"Book This Course","Booking");
        				XBR();
    				}
    				X_DIV($bitsa[2]);
    				XBR();
			    } else {
			        XDIV($bitsa[2],"eaclass" );
			        XTABLEINVISIBLE();
			        XTR();
			        if ($GLOBALS{'course_featuredimage'} != "") {
			            XTDTOP();
			            XIMG(Field2URL($GLOBALS{'domainwwwurl'})."/domain_media/".$GLOBALS{'course_featuredimage'},"150","","");
			            X_TD();
			            XTDTXT("&nbsp;&nbsp;&nbsp;");
			        }
			        XTDTOP();
			        XH3TOP($GLOBALS{'course_title'});
			        XBR();
			        XTXT($GLOBALS{'course_excerpt'});
			        XBR();XBR();
			        $link = YPGMLINK("webpagecoursewebview.php");
			        $link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$bitsa[3]);
			        XLINKTXTNEWPOPUP($link,"Read More..","courseview","100","100","800","800");
			        X_TD();
			        X_TR();
			        X_TABLE();
			        X_DIV($bitsa[2]);
			        XBR();	
			    }
			}
		}
	}
	XBR();XBR();XBR();
	
	if ( $matchreportsummaries == "Yes") {
		Frs_NEWSLASTWEEKSRESULTS_Output($GLOBALS{'currperiodid'});
	}
	X_DIV("newslettercontent");
	
}

function Webpage_EVENTLISTGENERATOR_Output($categoryid,$fpdate,$sortby,$sortseq,$show,$max) {
    XH2("Upcoming Events");
	XBR();XBR();

	// defaults set by shortcodeexpander
	$combineda = Array();
	$eventa = Get_Array('event');
	foreach ($eventa as $event_id) {
		Get_Data("event",$event_id);
		$usethisevent = "1";
		if ( $GLOBALS{'event_publicationstatus'} != "Published" ) { $usethisevent = "0"; }	
		if ( ($categoryid != $GLOBALS{'event_categoryid'})&&($categoryid != "all")&&($categoryid != "All") ) { $usethisevent = "0"; }
		if ( ($fpdate == "future")||($fpdate == "Future") ) {
			if ( $GLOBALS{'event_date'} < $GLOBALS{'currentYYYY-MM-DD'} ) { $usethisevent = "0"; }			
		}
		if ( ($fpdate == "past")||($fpdate == "Past") ) {
			if ( $GLOBALS{'event_date'} < $GLOBALS{'currentYYYY-MM-DD'} ) { $usethisevent = "0"; }		
		}
		if ( $usethisevent == "1") {
		    if ( ($sortby == "date")||($sortby == "Date") ) { $sortvalue = $GLOBALS{'event_date'}; }
		    if ( ($sortby == "title")||($sortby == "Title") ) { $sortvalue = $GLOBALS{'event_title'}; };
		    
			array_push($combineda, $sortvalue."|".$event_id);
		}
	}
	if ( ($sortseq == "asc")||($sortseq == "Asc") ) { sort($combineda);  }
	if ( ($sortseq == "desc")||($sortseq == "Desc") ) { rsort($combineda);  }
	$eventcount = 0;
	foreach ($combineda as $combinedelement) {
		if ($eventcount < $max) {
			$eventcount++;
			$bitsa = explode("|", $combinedelement);
			$event_id = $bitsa[1];
			Get_Data("event",$event_id);
			if ( ($show == "full")||($show == "Full") )	{
				XDIV($bitsa[1],"eaclass" );
				XH2($GLOBALS{'event_title'});
				XTXT($GLOBALS{'event_excerpt'});
				if ($GLOBALS{'event_featuredimage'} != "") {
					XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'},"100%");
				}
				XBR();XBR();
				XTXT($GLOBALS{'event_report'});
				XBR();
				Check_Data("person",$GLOBALS{'event_contact'});
				if ($GLOBALS{'IOWARNING'} == "0" ) { 
					$showmobiletel = ""; $showemail = "";
					if ($GLOBALS{'person_mobiletel'} != "" ) { $showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'}; }
					if ($GLOBALS{'person_email1'} != "" ) { $showemail = "Email: ".$GLOBALS{'person_email1'}; }				
					XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
				} else {
					XTXT("Contact - ".$GLOBALS{'event_contact'});	
				}
				XBR();
				XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
				XBR();
				XTXT("Time - ".$GLOBALS{'event_time'});
				XBR();
				Check_Data('venue',$GLOBALS{'event_venuecode'});
				XTXT("Venue - ".$GLOBALS{'venue_name'});
				XBR();XBR();
				
				if ($GLOBALS{'event_full'} == "Yes") { XH4("Sorry this event is now fully booked."); }	
				if ($GLOBALS{'event_personorteam'} == "Team") { XTXT("This is a team event").XBR(); }	
				
				if ($GLOBALS{'event_bookable'} == "Yes") {
					if ($GLOBALS{'event_charge'} != 0) {
						if ($GLOBALS{'event_personorteam'} == "Team") { 
							XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
						} else { 
							XTXT("Charge per person - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
							if ($GLOBALS{'event_discountpercent'} != "") {
								XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
							}				
						}
					}
					XBR();XBR();
					$link = YPGMLINK("bookingeventout.php");
					$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
					XLINKBUTTONNEWWINDOW ($link,"Book This Event","Booking");	
				} else {
					if ($GLOBALS{'event_charge'} != 0) {
						if ($GLOBALS{'event_personorteam'} == "Team") { 
							XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
						} else { 
							XTXT("Charge per person - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
							if ($GLOBALS{'event_discountpercent'} != "") {
								XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
							}				
						}
					}
				}												
				X_DIV($bitsa[1]);
				XBR();XBR();
			}
			if ( ($show == "excerpt")||($show == "Excerpt") )	{
				XDIV($bitsa[1],"eaclass" );
				XTABLEINVISIBLE();
				XTR();
				if ($GLOBALS{'event_featuredimage'} != "") {
					XTDTOP();
					XIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'},"100","","");
					X_TD();
				}
				XTDTOP();
				XH2($GLOBALS{'event_title'});
				XBR();
				XTXT($GLOBALS{'event_excerpt'});
				XBR();XBR();
				$link = YPGMLINK("webpageeventwebview.php");
				$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
				XLINKTXTNEWPOPUP($link,"Read More..","eventview","100","100","800","800");
				X_TD();
				X_TR();
				X_TABLE();
				X_DIV($bitsa[1]);
				XBR();
			}
		}
	}
	if ( $eventcount == 0 ) {	    
	    XPTXT("Watch this space for more events.");
	}
	
	XBR();XBR();XBR();
}

function Webpage_DRAWLISTGENERATOR_Output($categoryid,$fpdate,$sortby,$sortseq,$show,$max) {
	XH2("Upcoming Raffles");
	XBR();XBR();

	// defaults set by shortcodeexpander
	$combineda = Array();
	$drawa = Get_Array('draw');
	foreach ($drawa as $draw_id) {
		Get_Data("draw",$draw_id);
		$usethisdraw = "1";
		if ( $GLOBALS{'draw_publicationstatus'} != "Published" ) { $usethisdraw = "0"; }
		if ( ($categoryid != $GLOBALS{'draw_categoryid'})&&($categoryid != "all")&&($categoryid != "All") ) { $usethisdraw = "0"; }
		if ( ($fpdate == "future")||($fpdate == "Future") ) { 
		    if ( $GLOBALS{'draw_date'} < $GLOBALS{'currentYYYY-MM-DD'} ) { $usethisdraw = "0"; } 
		}
		if ( ($fpdate == "past")||($fpdate == "Past") ) {
		    if ( $GLOBALS{'draw_date'} < $GLOBALS{'currentYYYY-MM-DD'} ) { $usethisdraw = "0"; } 
		}
		if ( $usethisdraw == "1") {
		    if ( ($sortby == "date")||($sortby == "Date") ) { $sortvalue = $GLOBALS{'draw_date'}; }
		    if ( ($sortby == "title")||($sortby == "Title") ) { $sortvalue = $GLOBALS{'draw_title'}; };
			array_push($combineda, $sortvalue."|".$draw_id);
		}
	}
	if ( ($sortseq == "asc")||($sortseq == "Asc") ) { sort($combineda);  }
	if ( ($sortseq == "desc")||($sortseq == "Desc") ) { rsort($combineda);  }
	
	$drawcount = 0;
	foreach ($combineda as $combinedelement) {
		if ($drawcount < $max) {
			$drawcount++;
			$bitsa = explode("|", $combinedelement);
			Get_Data("draw",$bitsa[1]);
			if ( ($show == "full")||($show == "Full") )	{
				XDIV($bitsa[1],"eaclass" );
				XH2($GLOBALS{'draw_title'});
				XTXT($GLOBALS{'draw_excerpt'});
				if ($GLOBALS{'draw_featuredimage'} != "") {
					XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'},"100%");
				}
				XBR();XBR();
				XTXT($GLOBALS{'draw_description'});
				XBR();
				Check_Data("person",$GLOBALS{'draw_contact'});
				if ($GLOBALS{'IOWARNING'} == "0" ) {
					$showmobiletel = ""; $showemail = "";
					if ($GLOBALS{'person_mobiletel'} != "" ) {
						$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
					}
					if ($GLOBALS{'person_email1'} != "" ) {
						$showemail = "Email: ".$GLOBALS{'person_email1'};
					}
					XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
				} else {
					XTXT("Contact - ".$GLOBALS{'draw_contact'});
				}
				XBR();
				XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
				XBR();
				XTXT("Time - ".$GLOBALS{'draw_time'});
				XBR();
				Check_Data('venue',$GLOBALS{'draw_venuecode'});
				XTXT("Venue - ".$GLOBALS{'venue_name'});
				XBR();XBR();
				if ($GLOBALS{'draw_full'} == "Yes") {
					XH5("Sorry this draw is now fully booked.");
				}
				if ($GLOBALS{'draw_charge'} != 0) {
					XTXT("Charge per ticket - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'draw_charge'}, 2, '.', ''));
				}
				XBR();XBR();
				$link = YPGMLINK("bookingdrawout.php");
				$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
				XLINKBUTTONNEWWINDOW ($link,"Book This Event","Booking");
				X_DIV($bitsa[1]);
				XBR();XBR();
			}
			if ( ($show == "excerpt")||($show == "Excerpt") )	{
				XDIV($bitsa[1],"eaclass" );
				XTABLEINVISIBLE();
				XTR();
				if ($GLOBALS{'draw_featuredimage'} != "") {
					XTDTOP();
					XIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'},"100","","");
					X_TD();
				}
				XTDTOP();
				XH2($GLOBALS{'draw_title'});
				XBR();
				XTXT($GLOBALS{'draw_excerpt'});
				XBR();XBR();
				$link = YPGMLINK("webpagedrawwebview.php");
				$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$bitsa[1]);
				XLINKTXTNEWPOPUP($link,"Read More..","drawview","100","100","800","800");
				X_TD();
				X_TR();
				X_TABLE();
				X_DIV($bitsa[1]);
				XBR();
			}
		}
	}
	XBR();XBR();XBR();
}

function Webpage_ARTICLELISTGENERATOR_Output($categoryid,$sortby,$sortseq,$show,$max) {
	XH2("Recent Articles");
	XBR();XBR();

	// defaults set by shortcodeexpander
	$combineda = Array();
	$articlea = Get_Array('article');
	foreach ($articlea as $article_id) {
		Get_Data("article",$article_id);
		$usethisarticle = "1";
		if ( $GLOBALS{'article_publicationstatus'} != "Published" ) { $usethisarticle = "0"; }	
		if ( ($categoryid != $GLOBALS{'article_categoryid'})&&($categoryid != "all")&&($categoryid != "All") ) { $usethisarticle = "0"; }
		if ( ($fpdate == "future")||($fpdate == "Future") ) {
			if ( $GLOBALS{'article_date'} <= $GLOBALS{'currentYYYY-MM-DD'} ) { $usethisarticle = "0"; }			
		}
		if ( ($fpdate == "past")||($fpdate == "Past") ) {
			if ( $GLOBALS{'article_date'} >= $GLOBALS{'currentYYYY-MM-DD'} ) { $usethisarticle = "0"; }		
		}
		if ( $usethisarticle == "1") {
		    if ( ($sortby == "date")||($sortby == "Date") ) { $sortvalue = $GLOBALS{'article_date'}; }
		    if ( ($sortby == "title")||($sortby == "Title") ) { $sortvalue = $GLOBALS{'article_title'}; };			
			array_push($combineda, $sortvalue."|".$article_id);
		}
	}
	if ( ($sortseq == "asc")||($sortseq == "Asc") ) { sort($combineda);  }
	if ( ($sortseq == "desc")||($sortseq == "Desc") ) { rsort($combineda);  }

	$articlecount = 0;
	foreach ($combineda as $combinedelement) {
		if ($articlecount < $max) {
			$articlecount++;
			$bitsa = explode("|", $combinedelement);
			$article_id = $bitsa[1];
			Get_Data("article",$article_id);
			if ( ($show == "full")||($show == "Full") )	{
				XDIV($bitsa[1],"eaclass" );
				XH2($GLOBALS{'article_title'});
				XTXT($GLOBALS{'article_excerpt'});
				if ($GLOBALS{'article_featuredimage'} != "") {
					XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'article_featuredimage'},"100%");
			}
				XBR();XBR();
				XTXT($GLOBALS{'article_report'});
				XBR();
				XTXT("Author - ".$GLOBALS{'article_author'});
				XBR();
				XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'article_date'}));
				XBR();
				X_DIV($bitsa[1]);
				XBR();
			}
			if ( ($show == "excerpt")||($show == "Excerpt") )	{
				XDIV($bitsa[1],"eaclass" );
				XTABLEINVISIBLE();
				XTR();
				if ($GLOBALS{'article_featuredimage'} != "") {
					XTDTOP();
					XIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'article_featuredimage'},"100","","");
					X_TD();
				}
				XTDTOP();
				XH2($GLOBALS{'article_title'});
				XBR();
				XTXT($GLOBALS{'article_excerpt'});
				XBR();XBR();
				$link = YPGMLINK("webpagearticlewebview.php");
				$link = $link.YPGMMINPARMS().YPGMPARM("article_id",$bitsa[1]);
				XLINKTXTNEWPOPUP($link,"Read More..","eventview","100","100","800","800");
				X_TD();
				X_TR();
				X_TABLE();
				X_DIV($bitsa[1]);
				XBR();
			}
		}
	}
	XBR();XBR();XBR();
}

function Webpage_COURSELISTGENERATOR_Output($categoryid,$fpdate,$sortby,$sortseq,$show,$max) {
	XH3("Upcoming Courses");
	XBR();XBR();

	// defaults set by shortcodeexpander
	$combineda = Array();
	$coursea = Get_Array('course');
	foreach ($coursea as $course_id) {
		Get_Data("course",$course_id);
		$usethiscourse = "1";
		if ( $GLOBALS{'course_publicationstatus'} != "Published" ) { $usethiscourse = "0"; }	
		if ( ($categoryid != $GLOBALS{'course_categoryid'})&&($categoryid != "all")&&($categoryid != "All") ) { $usethiscourse = "0"; }
		if ( ($fpdate == "future")||($fpdate == "Future") ) {
			if ( $GLOBALS{'course_datestart'} < $GLOBALS{'currentYYYY-MM-DD'} ) {
				$usethiscourse = "0";
			}
		}
		if ( ($fpdate == "past")||($fpdate == "Past") ) {
			if ( $GLOBALS{'course_datestart'} > $GLOBALS{'currentYYYY-MM-DD'} ) {
				$usethiscourse = "0";
			}
		}
		if ( $usethiscourse == "1") {
		    if ( ($sortby == "date")||($sortby == "Date") ) {
				$sortvalue = $GLOBALS{'course_datestart'};
			}
			if ( ($sortby == "title")||($sortby == "Title") ) {
				$sortvalue = $GLOBALS{'course_title'};
			}
			array_push($combineda, $sortvalue."|".$course_id);
		}
	}
	if ( ($sortseq == "asc")||($sortseq == "Asc") ) { sort($combineda);  }
	if ( ($sortseq == "desc")||($sortseq == "Desc") ) { rsort($combineda);  }
	
	$coursecount = 0;
	foreach ($combineda as $combinedelement) {
		if ($coursecount < $max) {
			$coursecount++;
			$bitsa = explode("|", $combinedelement);
			$course_id = $bitsa[1];
			Get_Data("course",$course_id);
			if ( ($show == "full")||($show == "full") )	{
				XDIV($bitsa[1],"eaclass" );
				XH2($GLOBALS{'course_title'});
				XTXT($GLOBALS{'course_excerpt'});
				if ($GLOBALS{'course_featuredimage'} != "") {
					XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"100%");
				}
				XBR();XBR();
				XTXT($GLOBALS{'course_description'});
				XBR();
				XHR();
				XBR();
				Check_Data("person",$GLOBALS{'course_contact'});
				if ($GLOBALS{'IOWARNING'} == "0" ) {
					$showmobiletel = ""; $showemail = "";
					if ($GLOBALS{'person_mobiletel'} != "" ) {
						$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
					}
					if ($GLOBALS{'person_email1'} != "" ) {
						$showemail = "Email: ".$GLOBALS{'person_email1'};
					}
					XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
				} else {
					XTXT("Contact - ".$GLOBALS{'course_contact'});
				}
				XBR();
				if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
					XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
				} else {
					XTXT("Dates - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));
				}
				XBR();
				XTXT("Time - ".$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'});
				XBR();
				XTXT("Venue - ".$GLOBALS{'course_venue'});
				XBR();XBR();
				if ($GLOBALS{'course_charge'} == 0) {
					XTXT("Free of Charge");
				} else {
					XTXT("Charge - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_charge'}, 2, '.', ''));
					if ( $GLOBALS{'course_prepaidcharge'} != 0 ) {
						XTXT(" : If pre-paid online - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_prepaidcharge'}, 2, '.', ''));
					}
					if ( $GLOBALS{'course_earlycharge'} != 0 ) {
						// CHECK
						// XTXT(" : If pre-paid online before - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_earlychargedate'})." - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_earlycharge'}, 2, '.', ''));
					}
				}
				if ($GLOBALS{'course_partchargepermitted'} == "Yes") {
					XPTXT($GLOBALS{'course_partchargeinstructions'});
				}			
				XBR();XBR();
				if ($GLOBALS{'course_googlemapsembed'} != "") {
					XDIV("XXX","YYY");
					XTXT($GLOBALS{'course_googlemapsembed'});
					X_DIV("XXX");
					XBR();
				}
				XBR();XBR();
				
				if ($GLOBALS{'course_paymentoptionslist'} != "") {
    				$link = YPGMLINK("bookingcourseout.php");
    				$link = $link.YPGMMINPARMS().YPGMPARM("course_id",$course_id);
    				XLINKBUTTONNEWWINDOW ($link,"Book This Course","Booking");
    				XBR();XBR();
				}
				
				X_DIV($bitsa[1]);
				XBR();
			}
			if ( ($show == "excerpt")||($show == "Excerpt") )	{
				XDIV($bitsa[1],"eaclass" );
				XTABLEINVISIBLE();
				XTR();
				if ($GLOBALS{'course_featuredimage'} != "") {
					XTDTOP();
					XIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"200","","");
					X_TD();
					XTDFIXED("10");XTXT(' ');X_TD();
				}
				XTDTOP();
				XH3($GLOBALS{'course_title'});
				XBR();
				XTXT($GLOBALS{'course_excerpt'});
				XBR();XBR();
				if ($GLOBALS{'course_paymentoptionslist'} != "") {
    				$link = YPGMLINK("bookingcourseout.php");
    				$link = $link.YPGMMINPARMS().YPGMPARM("course_id",$course_id);
    				XLINKBUTTONNEWWINDOW ($link,"Read More / Book This Course","Booking");
				}
				X_TD();
				X_TR();
				X_TABLE();				
				X_DIV($bitsa[1]);
				XBR();
			}
		}
	}
	XBR();XBR();XBR();
}

function Webpage_ARTICLEVIEW_CSSJS () {

}


function Webpage_ARTICLEVIEW_Output($article_id) {
    Webpage_WEBSTYLE_Output();	
	// XH2("Article - ".$article_id);
	Get_Data("article",$article_id);
	XDIV($article_id,"eaclass" );
	XH2($GLOBALS{'article_title'});
	XTXT($GLOBALS{'article_excerpt'});
	if ($GLOBALS{'article_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'article_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT(EAHTML2PAGE($GLOBALS{'article_report'},"740"));
	XBR();
	Check_Data("person",$GLOBALS{'article_author'});
	if ($GLOBALS{'IOWARNING'} == "0" ) { 
		XTXT("Author - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});	
	} else {
		XTXT("Author - ".$GLOBALS{'article_author'});	
	}
	XBR();
	XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'article_date'}));
	XBR();
	X_DIV($article_id);
}

function Webpage_EVENTVIEW_CSSJS () {

}

function Webpage_EVENTVIEW_Output($event_id) {
    Webpage_WEBSTYLE_Output();
	// XH2("Event - ".$event_id);
	Get_Data("event",$event_id);
	XDIV($event_id,"eaclass" );
	XH2($GLOBALS{'event_title'});
	XTXT($GLOBALS{'event_excerpt'});
	if ($GLOBALS{'event_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT(EAHTML2PAGE($GLOBALS{'event_report'},"740"));
	XBR();
	Check_Data("person",$GLOBALS{'event_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) { 
		$showmobiletel = ""; $showemail = "";
		if ($GLOBALS{'person_mobiletel'} != "" ) { $showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'}; }
		if ($GLOBALS{'person_email1'} != "" ) { $showemail = "Email: ".$GLOBALS{'person_email1'}; }				
		XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
	} else {
		XTXT("Contact - ".$GLOBALS{'event_contact'});	
	}
	XBR();
	XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
	XBR();
	XTXT("Time - ".$GLOBALS{'event_time'});
	XBR();
	Check_Data('venue',$GLOBALS{'event_venuecode'});
	XTXT("Venue - ".$GLOBALS{'venue_name'});
	XBR();XBR();
	
	if ($GLOBALS{'event_full'} == "Yes") { XH4("Sorry this event is now fully booked."); }
	if ($GLOBALS{'event_personorteam'} == "Team") { XTXT("This is a team event").XBR(); }	
	
	if ($GLOBALS{'event_bookable'} == "Yes") {
		if ($GLOBALS{'event_charge'} != 0) {
			if ($GLOBALS{'event_personorteam'} == "Team") { 
				XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
			} else { 
				XTXT($chargetext.$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
				if ($GLOBALS{'event_discountpercent'} != "") {
					XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
				}				
			}
		}
		XBR();XBR();
		$link = YPGMLINK("bookingeventout.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
		XLINKBUTTONNEWWINDOW ($link,"Book This Event","Booking");	
	} else {
		if ($GLOBALS{'event_charge'} != 0) {
			if ($GLOBALS{'event_personorteam'} == "Team") { 
				XTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
			} else { 
				XTXT($chargetext.$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
				if ($GLOBALS{'event_discountpercent'} != "") {
					XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
				}				
			}
		}
	}
	X_DIV($event_id);
}


function Webpage_DRAWVIEW_CSSJS () {

}

function Webpage_DRAWVIEW_Output($draw_id) {
    Webpage_WEBSTYLE_Output();
	// XH2("Event - ".$draw_id);
	Get_Data("draw",$draw_id);
	XDIV($draw_id,"eaclass" );
	XH2($GLOBALS{'draw_title'});
	XTXT($GLOBALS{'draw_excerpt'});
	if ($GLOBALS{'draw_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT(EAHTML2PAGE($GLOBALS{'draw_description'},"740"));
	XBR();XBR();
	Check_Data("person",$GLOBALS{'draw_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) { 
		$showmobiletel = ""; $showemail = "";
		if ($GLOBALS{'person_mobiletel'} != "" ) { $showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'}; }
		if ($GLOBALS{'person_email1'} != "" ) { $showemail = "Email: ".$GLOBALS{'person_email1'}; }				
		XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
	} else {
		XTXT("Contact - ".$GLOBALS{'draw_contact'});	
	}
	XBR();
	XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
	XBR();
	XTXT("Time - ".$GLOBALS{'draw_time'});
	XBR();
	Check_Data('venue',$GLOBALS{'draw_venuecode'});
	XTXT("Venue - ".$GLOBALS{'venue_name'});
	XBR();XBR();
	
	if ($GLOBALS{'draw_full'} == "Yes") { XH4("Sorry this draw is now fully booked."); }
	
	XTXT("Charge per ticket - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'draw_charge'}, 2, '.', ''));
	if ($GLOBALS{'draw_discountpercent'} != "") {
		XBR();XBR();XTXT("<B>Note:</B>  If you buy ".$GLOBALS{'draw_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'draw_discountpercent'}."%");
	}
	XBR();XBR();
	$link = YPGMLINK("bookingdrawout.php");
	$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
	XLINKBUTTONNEWWINDOW ($link,"Buy Tickets","Booking");	
	X_DIV($draw_id);
}


function Webpage_COURSEVIEW_CSSJS () {

}

function Webpage_COURSEVIEW_Output($course_id) {
	Webpage_WEBSTYLE_Output();
	Get_Data("course",$course_id);
	XDIV($course_id,"eaclass" );
	XH2($GLOBALS{'course_title'});
	XTXT($GLOBALS{'course_excerpt'});
	if ($GLOBALS{'course_featuredimage'} != "") {
		XBR();XBR();XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"100%");
	}
	XBR();XBR();
	XTXT(EAHTML2PAGE($GLOBALS{'course_description'},"740"));
	XBR();
	XHR();
	XBR();
	Check_Data("person",$GLOBALS{'course_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$showmobiletel = ""; $showemail = "";
		if ($GLOBALS{'person_mobiletel'} != "" ) {
			$showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
		}
		if ($GLOBALS{'person_email1'} != "" ) {
			$showemail = "Email: ".$GLOBALS{'person_email1'};
		}
		XTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
	} else {
		XTXT("Contact - ".$GLOBALS{'course_contact'});
	}
	XBR();
	XTXT("Venue - ".$GLOBALS{'course_venue'});
	XBR();
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		XTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
	} else {
		XTXT("Dates - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));
	}
	XBR();
	XTXT("Time - ".$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'});
	XBR();XBR();
	if ($GLOBALS{'course_charge'} == 0) {
		XTXT("Free of Charge");
	} else {
		XTXT("Charge - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_charge'}, 2, '.', ''));
		if ( $GLOBALS{'course_prepaidcharge'} != 0 ) {
			XTXT(" : If pre-paid online - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_prepaidcharge'}, 2, '.', ''));
		}
		if ( $GLOBALS{'course_earlycharge'} != 0 ) {
			XTXT(" : If pre-paid online before - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_earlychargedate'})." - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_earlycharge'}, 2, '.', ''));
		}
		if ($GLOBALS{'course_partchargepermitted'} == "Yes") {
			XPTXT($GLOBALS{'course_partchargeinstructions'});
		}
	}
	XBR();XBR();
	if ($GLOBALS{'course_paymentoptionslist'} != "") {
    	$link = YPGMLINK("bookingcourseout.php");
    	$link = $link.YPGMMINPARMS().YPGMPARM("course_id",$course_id);
    	XLINKBUTTONNEWWINDOW ($link,"Book This Course","Booking");
    	XBR();XBR();
	}
	X_DIV($course_id);
}

function Webpage_FBARTICLEVIEW_CSSJS () {

}

function Webpage_FBARTICLEVIEW_Output($article_id) {
	Webpage_FBSTYLE_Output();
	Get_Data("article",$article_id);
	XH2("Create Facebook Note from Article - ".$article_id);
	XHR();
	$imagelink = $GLOBALS{'site_asseturl'}."/NewFaceBookNote.jpg";
	XIMGFLEX($imagelink);
	XPTXT('1. Copy and Paste the following into the Title"');
	XTEXTAREA("candptitle","1","80");
	print $GLOBALS{'article_title'};
	X_TEXTAREA();
	XBR();
	XPTXT('2. Copy and Paste the following where it says "Write something".');
	XPTXT('(This only seems to transfer styles properly using Firefox or Chrome browser !!  )');	
	print'<table border="1">';
	print'<td style="width: 500px;">';
	$newfbstring = $GLOBALS{'article_excerpt'}."<br>"."<br>";
	if ($GLOBALS{'article_report'} != "") {
		$newfbstring = $newfbstring.$GLOBALS{'article_report'}."<br>"."<br>";
	}
	Check_Data("person",$GLOBALS{'article_author'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$newfbstring = $newfbstring."Author: ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}."<br>";
	} else {
		$newfbstring = $newfbstring."Author: ".$GLOBALS{'article_author'}."<br>";
	}
	$newfbstring = $newfbstring."Event Date: ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'article_date'})."<br>"."<br>"."\n";	
	$link = YPGMLINK("webpagearticlewebview.php");
	$link = $link.YPGMMINPARMS().YPGMPARM("article_id",$article_id);
	$newfbstring = $newfbstring.YLINKTXTNEWWINDOW(Field2URL($link),"View Full Article in Browser","view");	
	print $newfbstring;
	X_TD();X_TR();
	X_TABLE();
	XBR();
	if ($GLOBALS{'article_featuredimage'} != "") {
		XPTXT('3. Save the following image (using right click) and then drag and drop into Facebook as directed.');	
		$fbstring = XBR();XIMGFLEX($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'article_featuredimage'});
	}
	XBR();XBR();XBR();
	XHR();XBR();	
}

function Webpage_FBEVENTVIEW_CSSJS () {

}

function Webpage_FBEVENTVIEW_Output($event_id) {
	Webpage_FBSTYLE_Output();

	Get_Data("event",$event_id);
	XH2("Create Facebook Note from Event - ".$event_id);
	XHR();
	$imagelink = $GLOBALS{'site_asseturl'}."/NewFaceBookNote.jpg";
	XIMGFLEX($imagelink);
	XPTXT('1. Copy and Paste the following into the Title"');
	XTEXTAREA("candptitle","1","80");
	print $GLOBALS{'event_title'};
	X_TEXTAREA();
	XBR();
	XPTXT('2. Copy and Paste the following where it says "Write something".');
	XPTXT('(This only seems to transfer styles properly using Firefox or Chrome browser !!  )');		
	print'<table border="1">';
	print'<td style="width: 500px;">';
	$newfbstring = $GLOBALS{'event_excerpt'}."<br>"."<br>";
	if ($GLOBALS{'event_report'} != "") {
		$newfbstring = $newfbstring.$GLOBALS{'event_report'}."<br>"."<br>";
	}
	Check_Data("person",$GLOBALS{'event_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$newfbstring = $newfbstring."Contact: ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail."<br>";;
	} else {
		$newfbstring = $newfbstring."Contact: ".$GLOBALS{'event_contact'}."<br>";;
	}
	$newfbstring = $newfbstring."Event Date: ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'})."<br>";
	$newfbstring = $newfbstring."Time - ".$GLOBALS{'event_time'}."<br><br>";
	Check_Data('venue',$GLOBALS{'event_venuecode'});
	$newfbstring = $newfbstring."Venue - ".$GLOBALS{'venue_name'}."<br><br>";

	if ($GLOBALS{'event_full'} == "Yes") { $newfbstring = $newfbstring."<br><h5>Sorry this event is now fully booked</h5>"; }	
	if ($GLOBALS{'event_personorteam'} == "Team") { $newfbstring = $newfbstring."This is a team event"."<br>"; }	
	
	if ($GLOBALS{'event_bookable'} == "Yes") {
		if ($GLOBALS{'event_charge'} != 0) {
			if ($GLOBALS{'event_personorteam'} == "Team") { $chargetext = "Charge per team - "; }
			else { $chargetext = "Charge per person - "; }
			$newfbstring = $newfbstring.$chargetext.$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', '')."<br><br>";
		}
		$link = YPGMLINK("webpageeventwebview.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
		$newfbstring = $newfbstring.YLINKTXTNEWWINDOW(Field2URL($link),"View/Book this Event","view");
	} else {
		if ($GLOBALS{'event_charge'} != 0) {
			if ($GLOBALS{'event_personorteam'} == "Team") { 
				$newfbstring = $newfbstring."Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', '')."<br><br>";
			} else { 
				$newfbstring = $newfbstring."Charge per person - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', '')."<br><br>";
				if ($GLOBALS{'event_discountpercent'} != "") {
					$newfbstring = $newfbstring."<br><br><B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%";
				}
			}	
		}
		$link = YPGMLINK("webpageeventwebview.php");
		$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
		$newfbstring = $newfbstring.YLINKTXTNEWWINDOW(Field2URL($link),"View Full Event Details","view");
	}	
	print $newfbstring;
	X_TD();X_TR();
	X_TABLE();
	XBR();
	if ($GLOBALS{'event_featuredimage'} != "") {
		XPTXT('3. Save the following image (using right click) and then drag and drop into Facebook as directed.');	
		$fbstring = XBR();XIMGFLEX($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'});
	}
	XBR();XBR();XBR();
	XHR();XBR();
}


function Webpage_FBDRAWVIEW_CSSJS () {

}

function Webpage_FBDRAWVIEW_Output($draw_id) {
	Webpage_FBSTYLE_Output();

	Get_Data("draw",$draw_id);
	XH2("Create Facebook Note from Raffle - ".$draw_id);
	XHR();
	$imagelink = $GLOBALS{'site_asseturl'}."/NewFaceBookNote.jpg";
	XIMGFLEX($imagelink);
	XPTXT('1. Copy and Paste the following into the Title"');
	XTEXTAREA("candptitle","1","80");
	print $GLOBALS{'draw_title'};
	X_TEXTAREA();
	XBR();
	XPTXT('2. Copy and Paste the following where it says "Write something".');
	XPTXT('(This only seems to transfer styles properly using Firefox or Chrome browser !!  )');		
	print'<table border="1">';
	print'<td style="width: 500px;">';
	$newfbstring = $GLOBALS{'draw_excerpt'}."<br>"."<br>";
	if ($GLOBALS{'draw_description'} != "") {
		$newfbstring = $newfbstring.$GLOBALS{'draw_description'}."<br>"."<br>";
	}
	Check_Data("person",$GLOBALS{'draw_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$newfbstring = $newfbstring."Contact: ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail."<br>";;
	} else {
		$newfbstring = $newfbstring."Contact: ".$GLOBALS{'draw_contact'}."<br>";;
	}
	$newfbstring = $newfbstring."Raffle Date: ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'})."<br>";
	$newfbstring = $newfbstring."Time - ".$GLOBALS{'draw_time'}."<br><br>";
	Check_Data('venue',$GLOBALS{'draw_venuecode'});
	$newfbstring = $newfbstring."Venue - ".$GLOBALS{'venue_name'}."<br><br>";	
	if ($GLOBALS{'draw_full'} == "Yes") {
		$newfbstring = $newfbstring."<br><h5>Sorry this raffle is now fully booked</h5>";
	}
	if ($GLOBALS{'draw_charge'} != 0) {
		$newfbstring = $newfbstring."Charge per ticket - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'draw_charge'}, 2, '.', '')."<br><br>";
	}
	$link = YPGMLINK("webpagedrawwebview.php");
	$link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
	$newfbstring = $newfbstring.YLINKTXTNEWWINDOW(Field2URL($link),"View/Buy Tickets for this Raffle","view");	
	print $newfbstring;
	X_TD();X_TR();
	X_TABLE();
	XBR();
	if ($GLOBALS{'draw_featuredimage'} != "") {
		XPTXT('3. Save the following image (using right click) and then drag and drop into Facebook as directed.');	
		$fbstring = XBR();XIMGFLEX($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'});
	}
	XBR();XBR();XBR();
	XHR();XBR();
}

function Webpage_EVENTUPDATELIST_Output () {
	Get_Data("commsmasters");
	XH2("Event Composer");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XH4("How to create Events");
	XPTXT("You can create a new event or update one of your existing events.");
	XPTXT("Once you have created an event it will be submitted to the co-ordinator who will post it on the website, include it in a newsletter, or post it on facebook and twitter as requested.");
	XPTXT("Events can be composed in a draft status initially and then published.");
	XBR();
	XFORMUPLOAD("webpageeventupdateout.php","newevent");
	XINSTDHID();
	XINHID("event_id","new");
	XINHID("menulist","eventupdatelist");
	XINSUBMIT("Create New Event");
	X_FORM();
	XBR();
	XBR();XBR();
	XDIV("simpletablediv_Events","container");
	XTABLEJQDTID("simpletabletable_Events");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Id");
	XTDHTXT("Title");
	XTDHTXT("Date");
	XTDHTXT("Status");	
	XTDHTXT("Contact");	
	XTDHTXT("Featured<br>Image");
	XTDHTXT("Edit");
	XTDHTXT("Delete");
	XTDHTXT("WebView");
	XTDHTXT("FacebookView");
	X_TR();
	X_THEAD();
	XTBODY();

	$itemfound = "0";
	$event_ida = Get_Array('event');
	$event_ida = array_reverse($event_ida);
	foreach ($event_ida as $event_id) {
		Get_Data("event",$event_id);
		$canupdate = "0";
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'event_createdbypersonid'}) { $canupdate = "1"; }
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'event_contact'}) { $canupdate = "1"; }
		if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) { $canupdate = "1"; }
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_eventeditorlist'})) { $canupdate = "1"; }			
		if ( $canupdate == "1") {
			$itemfound = "1";
			XTR();
			XTDTXT($event_id);
			XTDTXT($GLOBALS{'event_title'});
			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
			if ($GLOBALS{'event_publicationstatus'} == "") { XTDTXT($GLOBALS{'event_publicationstatus'}); }
			if ($GLOBALS{'event_publicationstatus'} == "Draft") { XTD();XTXTCOLOR($GLOBALS{'event_publicationstatus'},"red");X_TD(); }
			if ($GLOBALS{'event_publicationstatus'} == "Ready") { XTD();XTXTCOLOR($GLOBALS{'event_publicationstatus'},"orange");X_TD(); }		
			if ($GLOBALS{'event_publicationstatus'} == "Published") { XTD();XTXTCOLOR($GLOBALS{'event_publicationstatus'},"green");X_TD(); }	
			XTDTXT($GLOBALS{'event_contact'});	
			if ($GLOBALS{'event_featuredimage'} == "") { XTDTXT(""); }
			else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'},"100"); }
			$link = YPGMLINK("webpageeventupdateout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id).YPGMPARM("menulist","eventupdatelist");
			XTDLINKTXT($link,"update");
			$link = YPGMLINK("webpageeventdeleteconfirm.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id);
			XTDLINKTXT($link,"delete");			
			$link = YPGMLINK("webpageeventwebview.php");
			$link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
			XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
			$link = YPGMLINK("webpageeventfbview.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("event_id",$event_id);
			XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
			X_TR();
		}
	}
	X_TBODY();
	X_TABLE();
	X_DIV("simpletablediv_Events");
	XCLEARFLOAT();
	if ($itemfound == "0") { XH5("No events created by me so far"); }
}

function Webpage_EVENTDELETECONFIRM_Output ($event_id) {
	Get_Data("event",$event_id);
	XH3("Delete Event - ".$event_id." - ".$GLOBALS{'event_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this event");
	XBR();
	XFORM("webpageeventdeleteaction.php","deleteevent");
	XINSTDHID();
	XINHID("event_id",$event_id);
	XINSUBMIT("Confirm Event Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Webpage_EVENTUPDATE_CSSJS () {
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,tinymcesliminit,tinymceslimreturnfromupload,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,tinyslimimagepopup,tinyformattedsectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,FormattedSection_Popups";	
}

function Webpage_EVENTUPDATE_Output ($eventid, $menulist) {
	if ($eventid == "new") {
		Initialise_Data('event');
		$GLOBALS{'event_publicationstatus'} = "Draft";
		$event_ida = Get_Array('event');
		$highestevent_id = "E00000";
		foreach ($event_ida as $event_id) {
			$highestevent_id = $event_id;
		}
		$highestevent_seq = str_replace("E", "", $highestevent_id);
		$highestevent_seq++;
		$eventid = "E".substr(("00000".$highestevent_seq), -5);
		XH2("Event Composer - New Event - ".$eventid);
	} else {
		Get_Data('event', $eventid);
		XH2("Event Composer - ".$eventid." - ".$GLOBALS{'event_title'});
	}
	// $helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;
	XFORMUPLOAD("webpageeventupdatein.php","eventin");
	XINSTDHID();
	XINHID("event_id",$eventid);
	XINHID("menulist",$menulist);	
	XINHID("TinyMCEUploadTo","Event");
	XINHID("TinyMCEUploadId",$eventid);
	XHR();
	XH2('Title');
	XINTXT("event_title",$GLOBALS{'event_title'},"50","100");		
	XH2('Short excerpt.');
	XINTEXTAREA("event_excerpt",$GLOBALS{'event_excerpt'},"3","100");
	XH2('Full description of event.');
	XINTEXTAREAMCE("event_report",$GLOBALS{'event_report'},"20","100");
	XH2('Featured Image.');	
	XINHID("event_featuredimage",$GLOBALS{'event_featuredimage'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "event_featuredimage";
	$imageviewwidth = "300";
	$imagename = $GLOBALS{'event_featuredimage'};
	$imageuploadto = "Event";
	$imageuploadid = $eventid;
	$imageuploadwidth = "800";
	$imageuploadheight = "flex";
	$imageuploadfixedsize = "";
	$imagethumbwidth = "200";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);	
	XHR();	
	XH2("Event Category");	
	$xhash = Get_SelectArrays_Hash ("eventcategory","eventcategory_id","eventcategory_name","eventcategory_name","","" );
	XINSELECTHASH($xhash,"event_categoryid",$GLOBALS{'event_categoryid'});
	XH2("Event Schedule");
	XH4('Venue');	
	$xhash = Get_SelectArrays_Hash ("venue","venue_code","venue_name","venue_code","","" );
	XINSELECTHASH($xhash,"event_venuecode",$GLOBALS{'event_venuecode'});
	XH4('Date');
	XINDATEYYYY_MM_DD("event_date",$GLOBALS{'event_date'});
	XH4('Time');
	XINTXT("event_time",$GLOBALS{'event_time'},"10","50");	
	XH4('Contact');
	XINTXTID("event_contact","event_contact",$GLOBALS{'event_contact'},"50","100");
	XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
	XTXTID("event_contactname",View_Person_List($GLOBALS{'event_contact'}));
	XHR();
	XH2('Event Booking');	
	XINCHECKBOXYESNO ("event_bookable",$GLOBALS{'event_bookable'},"Event Bookable");XBR();
	XINRADIOHASHHORIZONTAL (List2Hash("Person,Team"),"event_personorteam",$GLOBALS{'event_personorteam'});
	XH4('Capacity');
	XINTXT("event_maximumattendees",$GLOBALS{'event_maximumattendees'},"7","7");XBR();
	XINCHECKBOXYESNO ("event_full",$GLOBALS{'event_full'},"Event Full");
	XHR();
	XH4('Charges');
	XINTXT("event_charge",$GLOBALS{'event_charge'},"7","7");XTXT("Base charge per ticket.");XBR();
	XINTXT("event_discountpercent",$GLOBALS{'event_discountpercent'},"7","7");XTXT("Discount % (If offered)");XBR();
	XINTXT("event_discountthreshold",$GLOBALS{'event_discountthreshold'},"7","7");XTXT("Discount Threshold (If offered)");XBR();
	XH4('Payment Method Options');
	$xhash = List2Hash("Card,Cheque,Cash,BankTransfer");
	XINCHECKBOXHASH ($xhash,"event_paymentoptionslist",$GLOBALS{'event_paymentoptionslist'});		
	XHR();
	XH2('Publication Status');
	$canpublish = "0";
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'event_createdbypersonid'}) { $canpublish = "1"; }
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'event_contact'}) { $canpublish = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) { $canpublish = "1"; }
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_eventeditorlist'})) { $canpublish = "1"; }	
	if ( $GLOBALS{'event_publicationstatus'} == "Published" ) { $canpublish = "1"; }
	if ( $canpublish == "1" ) { $xhash = Lists2Hash("Draft,Ready,Published","Draft,Ready to Publish,Published"); }
	else { $xhash = Lists2Hash("Draft,Ready","Draft,Ready to Publish"); }
	XINRADIOHASH ($xhash,"event_publicationstatus",$GLOBALS{'event_publicationstatus'});XBR();
	XHR();
	XH2('Publication Channels Requested');
	XINCHECKBOXYESNO("event_websiterequested",$GLOBALS{'event_websiterequested'},"Website");	
	XINCHECKBOXYESNO("event_bulletinrequested",$GLOBALS{'event_bulletinrequested'},"Bulletin Board");
	XINCHECKBOXYESNO("event_newsletterrequested",$GLOBALS{'event_newsletterrequested'},"Newsletter");
	XINCHECKBOXYESNO("event_facebookrequested",$GLOBALS{'event_facebookrequested'},"Facebook");
	XINCHECKBOXYESNO("event_twitterrequested",$GLOBALS{'event_twitterrequested'},"Twitter");
	XINCHECKBOXYESNO("event_showinemail",$GLOBALS{'event_showinemail'},"Show in Match Fixture Reminder");
	XBR();
	XHR();
	XBR();
	XINSUBMIT("Update Event");
	// XINBUTTONIDSPECIAL("previewbutton","success","Preview");
	X_FORM();
	
	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
	// Go_Back_To_EventArticleList;XBR();

    $GLOBALS{'PersonSelectPopupParameters'} = array(
		"this,person_id|person_sname|person_fname|person_section",
		"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
		"field,Lookup,Select,event_contact,event_contactname,100",
		"person_id",
		"all",
		"search,center,center,800,600",
	  	"view",
		"buildfulllist"
	);
}

// ================================


function Webpage_FBCOURSEVIEW_CSSJS () {

}

function Webpage_FBCOURSEVIEW_Output($course_id) {
	Webpage_FBSTYLE_Output();

	Get_Data("course",$course_id);
	XH2("Create Facebook Note from Course - ".$course_id);
	XHR();
	$imagelink = $GLOBALS{'site_asseturl'}."/NewFaceBookNote.jpg";
	XIMGFLEX($imagelink);
	XPTXT('1. Copy and Paste the following into the Title"');
	XTEXTAREA("candptitle","1","80");
	print $GLOBALS{'course_title'};
	X_TEXTAREA();
	XBR();
	XPTXT('2. Copy and Paste the following where it says "Write something".');
	XPTXT('(This only seems to transfer styles properly using Firefox or Chrome browser !!  )');
	print'<table border="1">';
	print'<td style="width: 500px;">';
	$newfbstring = $GLOBALS{'course_excerpt'}."<br>"."<br>";
	if ($GLOBALS{'course_description'} != "") {
		$newfbstring = $newfbstring.$GLOBALS{'course_description'}."<br>"."<br>";
	}
	Check_Data("person",$GLOBALS{'course_contact'});
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$newfbstring = $newfbstring."Contact: ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail."<br>";
	} else {
		$newfbstring = $newfbstring."Contact: ".$GLOBALS{'course_contact'}."<br>";
	}
	$newfbstring = $newfbstring.$GLOBALS{'course_venue'}."<br>"."<br>";
	if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
		$newfbstring = $newfbstring."Course Date: ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})."<br>"."<br>"."\n";
	} else {
		$newfbstring = $newfbstring."Course Dates: ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})."<br>"."<br>"."\n";
	}
	$link = YPGMLINK("webpagecoursewebview.php");
	$link = $link.YPGMMINPARMS().YPGMPARM("course_id",$course_id);
	$newfbstring = $newfbstring.YLINKTXTNEWWINDOW(Field2URL($link),"View Full Event Details in Browser","view");
	print $newfbstring;
	X_TD();X_TR();
	X_TABLE();
	XBR();
	if ($GLOBALS{'course_featuredimage'} != "") {
		XPTXT('3. Save the following image (using right click) and then drag and drop into Facebook as directed.');
		$fbstring = XBR();XIMGFLEX($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'});
	}
	XBR();XBR();XBR();
	XHR();XBR();
}

function Webpage_ARTICLEUPDATELIST_Output () {
    $GLOBALS{'LOGIN_canvas_id'} = "M";
	Get_Data("commsmasters");
	XH2("Article Composer");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	if ($GLOBALS{'LOGIN_canvas_id'} != "M") {
    	XH4("How to create Articles");
    	XPTXT("You can create a new article or update one of your existing articles.");
    	XPTXT("Once you have created an article it will be submitted to the co-ordinator who will post it on the website, include it in a newsletter, or post it on facebook and twitter as requested.");
    	XPTXT("Articles can be composed in a draft status initially and then published.");
	}
	XBR();
	XFORMUPLOAD("webpagearticleupdateout.php","newarticle");
	XINSTDHID();
	XINHID("article_id","new");
	XINHID("menulist","articleupdatelist");	
	XINSUBMIT("Create New Article");
	X_FORM();

	XBR();XBR();XBR();
	XDIV("simpletablediv_Articles","container");
	XTABLECOMPACTJQDTID("simpletabletable_Articles");
	XTHEAD();
	XTRJQDT();
	if ($GLOBALS{'LOGIN_canvas_id'} == "M") {
    	XTDHTXT("Title");
    	XTDHTXT("Featured<br>Image");
    	XTDHTXT("Update");
    	XTDHTXT("Delete");
	} else {
	    XTDHTXT("Id");
	    XTDHTXT("Title");
	    XTDHTXT("Date");
	    XTDHTXT("Status");
	    XTDHTXT("Author");
	    XTDHTXT("Featured<br>Image");
	    XTDHTXT("Update");
	    XTDHTXT("Delete");
	    XTDHTXT("WebView");
	    XTDHTXT("FacebookView");
	}
	X_TR();
	X_THEAD();
	XTBODY();

	$itemfound = "0";
	$article_ida = Get_Array('article');
	$article_ida = array_reverse($article_ida);
	foreach ($article_ida as $article_id) {
		Get_Data("article",$article_id);
		$canupdate = "0";
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'article_createdbypersonid'}) { $canupdate = "1"; }
		if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'article_contact'}) { $canupdate = "1"; }
		if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) { $canupdate = "1"; }
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_articleeditorlist'})) { $canupdate = "1"; }			
		if ( $canupdate == "1") {
			$itemfound = "1";
			XTR();
			if ($GLOBALS{'LOGIN_canvas_id'} == "M") {
			    XTDTXT($GLOBALS{'article_title'}." (".$GLOBALS{'article_publicationstatus'}.")");
			    if ($GLOBALS{'article_featuredimage'} == "") { XTDTXT(""); }
			    else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'article_featuredimage'},"50"); }
			    $link = YPGMLINK("webpagearticleupdateout.php");
			    $link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$article_id).YPGMPARM("menulist","articleupdatelist");
			    XTDLINKTXT($link,"update");
			    $link = YPGMLINK("webpagearticledeleteconfirm.php");
			    $link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$article_id);
			    XTDLINKTXT($link,"delete");	    
			} else {
			    XTDTXT($article_id);
			    XTDTXT($GLOBALS{'article_title'});
			    XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'article_date'}));
			    if ($GLOBALS{'article_publicationstatus'} == "") { XTDTXT($GLOBALS{'article_publicationstatus'}); }
			    if ($GLOBALS{'article_publicationstatus'} == "Draft") { XTD();XTXTCOLOR($GLOBALS{'article_publicationstatus'},"red");X_TD(); }
			    if ($GLOBALS{'article_publicationstatus'} == "Ready") { XTD();XTXTCOLOR($GLOBALS{'article_publicationstatus'},"orange");X_TD(); }
			    if ($GLOBALS{'article_publicationstatus'} == "Published") { XTD();XTXTCOLOR($GLOBALS{'article_publicationstatus'},"green");X_TD(); }
			    XTDTXT($GLOBALS{'article_author'});
			    if ($GLOBALS{'article_featuredimage'} == "") { XTDTXT(""); }
			    else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'article_featuredimage'},"100"); }
			    $link = YPGMLINK("webpagearticleupdateout.php");
			    $link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$article_id).YPGMPARM("menulist","articleupdatelist");
			    XTDLINKTXT($link,"update");
			    $link = YPGMLINK("webpagearticledeleteconfirm.php");
			    $link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$article_id);
			    XTDLINKTXT($link,"delete");
			    $link = YPGMLINK("webpagearticlewebview.php");
			    $link = $link.YPGMMINPARMS().YPGMPARM("article_id",$article_id);
			    XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
			    $link = YPGMLINK("webpagearticlefbview.php");
			    $link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$article_id);
			    XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");			    
			}
			X_TR();
		}
	}
	X_TBODY();
	X_TABLE();
	X_DIV("simpletablediv_Articles");
	XCLEARFLOAT();
	if ($itemfound == "0") { XH5("No articles created by me so far"); }
}

function Webpage_ARTICLEDELETECONFIRM_Output ($article_id) {
	Get_Data("article",$article_id);
	XH3("Delete Article - ".$article_id." - ".$GLOBALS{'article_title'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this article");
	XBR();
	XFORM("webpagearticledeleteaction.php","deletearticle");
	XINSTDHID();
	XINHID("article_id",$article_id);
	XINSUBMIT("Confirm Article Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Webpage_ARTICLEUPDATE_CSSJS () {
    if ($GLOBALS{'LOGIN_canvas_id'} == "M") { $tinyinit = "tinymceslimmobileinit"; }
    else { $tinyinit = "tinymcesliminit"; }    
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,".$tinyinit.",tinymceslimreturnfromupload,globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,tinyslimimagepopup,tinyformattedsectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}


function Webpage_ARTICLEUPDATE_Output ($articleid,$menulist) {
	
    if ($articleid == "new") {
		Initialise_Data('article');
		$GLOBALS{'article_publicationstatus'} = "Draft";
		$article_ida = Get_Array('article');
		$highestarticle_id = "A00000";
		foreach ($article_ida as $article_id) {
			$highestarticle_id = $article_id;
		}
		$highestarticle_seq = str_replace("A", "", $highestarticle_id);
		$highestarticle_seq++;
		$articleid = "A".substr(("00000".$highestarticle_seq), -5);
		XH2("New Article - ".$articleid);

	} else {
		Get_Data('article', $articleid);
		XH2($articleid." - ".$GLOBALS{'article_title'});
	}
	// $helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;
	XFORMUPLOAD("webpagearticleupdatein.php","articlein");
	XINSTDHID();
	XINHID("article_id",$articleid);
	XINHID("menulist",$menulist);	
	XINHID("TinyMCEUploadTo","Article");
	XINHID("TinyMCEUploadId",$articleid);
	XHR();
	XH2('Title');
	BROW("");
	BCOLINTXT("article_title",$GLOBALS{'article_title'},"12");XBR();
	B_ROW();
	// XINTXT("article_title",$GLOBALS{'article_title'},"50","100");
	XH2('Short Excerpt');
	BROW("");
	BCOLINTEXTAREA ("article_excerpt",$GLOBALS{'article_excerpt'},"3","12");
	B_ROW();
	// XINTEXTAREA("article_excerpt",$GLOBALS{'article_excerpt'},"3","60");
	XH2('Main Content');
	XINTEXTAREAMCE("article_report",$GLOBALS{'article_report'},"20","100");
	XH2('Featured Image');
	XINHID("article_featuredimage",$GLOBALS{'article_featuredimage'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "article_featuredimage";
	$imageviewwidth = "300";
	$imagename = $GLOBALS{'article_featuredimage'};
	$imageuploadto = "Article";
	$imageuploadid = $articleid;
	$imageuploadwidth = "800";
	$imageuploadheight = "flex";
	$imageuploadfixedsize = "";
	$imagethumbwidth = "200";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);	
	XHR();
	
	if ($GLOBALS{'LOGIN_canvas_id'} == "M") {
	    XINHID("article_date",$GLOBALS{'currentYYYY-MM-DD'});
	    XINHID("article_author",$GLOBALS{'LOGIN_person_id'});
	} else {
	    XH2('Article Date');
	    if ($GLOBALS{'article_date'} == "") { $GLOBALS{'article_date'} = $GLOBALS{'currentYYYY-MM-DD'}; }
	    XINDATEYYYY_MM_DD("article_date",$GLOBALS{'article_date'});
	    XH2('Article Author');
	    if ($GLOBALS{'article_author'} == "") { $GLOBALS{'article_author'} = $GLOBALS{'LOGIN_person_id'}; }
	    XINTXTID("article_author","article_author",$GLOBALS{'article_author'},"50","100");
	    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
	    XTXTID("article_authorname",View_Person_List($GLOBALS{'article_author'}));
	    XHR();
	}
	XH2('Publication Status');
	$canpublish = "0";
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'article_createdbypersonid'}) { $canpublish = "1"; }
	if ( $GLOBALS{'LOGIN_person_id'} == $GLOBALS{'article_contact'}) { $canpublish = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) { $canpublish = "1"; }
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_articleeditorlist'})) { $canpublish = "1"; }	
	if ( $GLOBALS{'article_publicationstatus'} == "Published" ) { $canpublish = "1"; }
	if ( $canpublish == "1" ) { $xhash = Lists2Hash("Draft,Ready,Published","Draft,Ready to Publish,Published"); }
	else { $xhash = Lists2Hash("Draft,Ready","Draft,Ready to Publish"); }
	XINRADIOHASH ($xhash,"article_publicationstatus",$GLOBALS{'article_publicationstatus'});XBR();
	XINCHECKBOXYESNO ("article_archived",$GLOBALS{'article_archived'},"Article Archived");
	XHR();
	XH2('Notify Channel Co-ordinators');
	Get_Data("commsmasters");
	XINCHECKBOXYESNO("article_websiterequested",$GLOBALS{'article_websiterequested'},"Website - ".CMNameList($GLOBALS{'commsmasters_websitepublisherlist'}));XBR();
	
	XINCHECKBOXYESNO("article_bulletinrequested",$GLOBALS{'article_bulletinrequested'},"Bulletin Board - ".CMNameList($GLOBALS{'commsmasters_bulletinpublisherlist'}));XBR();	
	
	XINCHECKBOXYESNO("article_newsletterrequested",$GLOBALS{'article_newsletterrequested'},"Newsletter - ".CMNameList($GLOBALS{'commsmasters_newsletterpublisherlist'}));XBR();
	
	XINCHECKBOXYESNO("article_facebookrequested",$GLOBALS{'article_facebookrequested'},"Facebook - ".CMNameList($GLOBALS{'commsmasters_facebookpublisherlist'}));XBR();
	
	XINCHECKBOXYESNO("article_twitterrequested",$GLOBALS{'article_twitterrequested'},"Twitter - ".CMNameList($GLOBALS{'commsmasters_twitterpublisherlist'}));XBR();
	XBR();
	XHR();
	XBR();
	XINSUBMIT("Update Article");
	X_FORM();
	
	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);

	// Go_Back_To_EventArticleList;XBR();

    $GLOBALS{'PersonSelectPopupParameters'} = array(
		"this,person_id|person_sname|person_fname|person_section",
		"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
		"field,Lookup,Select,article_author,article_authorname,100",
		"person_id",
		"all",
		"search,center,center,800,600",
	  	"view",
		"buildfulllist"
	);
}

function CMNameList($plist) {
    $plista = explode(",",$plist);
    $namelist = ""; $psep = "";
    foreach ($plista as $plistid) {
        Check_Data("person",$plistid);
        if ($GLOBALS{'IOWARNING'} == "0" ) {
            $namelist = $namelist.$psep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
            $psep = " & ";
        }
    }
    return "(".$namelist.")";
}

function Weblink_Select_Table () {
	XTABLE();
	XTR();
	XTDTXT('Cut and paste the weblink for the webpage you wist to refer to<br>e.g. "http://news.google.com"');
	XTDINTXT("WebLink",$weblink,"50","400");
	X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
}

# ----------------- Bulletins --------------------------------

function Webpage_BULLETINBOARDEDIT_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";
}

function Webpage_BULLETINBOARDEDIT_Output ($bulletinboard_name){
	XH2("Bulletin Board Edit");
	XHR();
	XH4("Introduction");
	XPTXT("A Bulletin is a link to another element of the website and consists of some text and an image posted on a Bulletin Board.");
	XPTXT("This page allows you to review the status of a Bulletin Board - amending, resequencing (by changing date) or deleting Bulletins as required.");
	XPTXT("In order for these changes to take effect the Bulleting Board will need to be republished.");	
	XHR();
	XH3('Existing Bulletins posted to the "'.$bulletinboard_name.'" bulletin board.');
	Get_Data("bulletinboard",$bulletinboard_name);

	$bulletinboardmax = $GLOBALS{'bulletinboard_max'}*1;
	$bulletinboardkeepmax = 100; // default
	if ($GLOBALS{'bulletinboard_keepmax'} != "" ) { $bulletinboardkeepmax = $GLOBALS{'bulletinboard_keepmax'}*1; }
	$fontcolor = $GLOBALS{'bulletinboard_fontcolor'};
	$fonthovercolor = $GLOBALS{'bulletinboard_fonthovercolor'};
	$fontsize = $GLOBALS{'bulletinboard_fontsize'};
	$showdates = $GLOBALS{'bulletinboard_showdates'};
	$topstoryenabled = $GLOBALS{'bulletinboard_topstoryenabled'};
	$topstorytextposition = $GLOBALS{'bulletinboard_topstorytextposition'};
	$topstoryimagewidth = $GLOBALS{'bulletinboard_topstoryimagewidth'};
	$imagewidth = $GLOBALS{'bulletinboard_imagewidth'};
	$textmax = $GLOBALS{'bulletinboard_textmax'}*1;

	$bulletintemparray = Array();
	$bulletina = Get_Array('bulletin');
	foreach ($bulletina as $bulletin_id) {
		Get_Data("bulletin",$bulletin_id);
		$arrayelement = $GLOBALS{'bulletin_date'}."#".$bulletin_id;
		array_push($bulletintemparray, $arrayelement);
	}
	rsort ($bulletintemparray);

	XBR();
	XFORM ("bulletinboardpublish.php", "Published");
	XINSTDHID();
	XINHID("bulletinboard_name",$bulletinboard_name);
	XINSUBMIT ("Re-Publish Bulletin Board");
	X_FORM();
	
	XBR();
	$tbulletinlink = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","WUBul").YPGMPARM("FixedBulletinBoard",$bulletinboard_name);
	XLINKTXT($tbulletinlink,"Create New Bulletin");XBR();XBR();
	XTABLE();
	$columnwidth = "200";
	if ($GLOBALS{'bulletinboard_topstoryimagewidth'} != "") {
		$columnwidth = $GLOBALS{'bulletinboard_topstoryimagewidth'};
	}
	XTR();XTDHTXTFIXED("Current View","200");XTDHTXTFIXED("Target",$columnwidth);XTDHTXTFIXED("Date","100");XTDHTXTFIXED("Display Status","100");XTDHTXTFIXED("View/Edit","100");X_TR();
	$bulletinboardcount = 0;
	foreach ($bulletintemparray as $arrayelement) {
		$bulbit3s = explode("#",$arrayelement);
		$bulletin_id = $bulbit3s[1];
		Get_Data('bulletin', $bulletin_id);
		if ($GLOBALS{'bulletin_bulletinboardname'} == $bulletinboard_name) {
			if ($GLOBALS{'bulletin_hide'} != "Hide") {
				$bulletinboardcount++;
			}
			if ($bulletinboardcount == $bulletinboardmax+1) {
				XTR();XTDHTXT("more...");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
			}
			if ($bulletinboardcount < $bulletinboardkeepmax+1) {			
    			XTR();
    			XTD();
    			$captionstring = "<b>".$GLOBALS{'bulletin_header'}.".</b> ".$GLOBALS{'bulletin_text'};
    			if (strlen($captionstring) > ($GLOBALS{'bulletinboard_textmax'} + 8)) {
    				$captionstring = substr($captionstring, 0, ($GLOBALS{'bulletinboard_textmax'} + 8))."...";
    			}
    			if ($GLOBALS{'bulletinboard_showdates'} == "Yes") {
    				$captionstring = $captionstring." - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'bulletin_date'});
    			}
    			if (($bulletinboardcount == 1)&&($GLOBALS{'bulletinboard_topstoryenabled'} == "Yes")&&($bulletinboardcount <= $bulletinboardmax)&&($GLOBALS{'bulletin_hide'} != "Hide")) {
    				if ($GLOBALS{'bulletinboard_topstorytextposition'} == "Above image") {
    					XTXT($captionstring);
    				}
    				if ($GLOBALS{'bulletin_image'} != "") {
    					$imageurl = $GLOBALS{'domainwwwurl'}.'/domain_media/'.$GLOBALS{'bulletin_image'};
    					XIMG($imageurl,$GLOBALS{'bulletinboard_topstoryimagewidth'},"","0");XBR();
    				}
    				if ($GLOBALS{'bulletinboard_topstorytextposition'} != "Above image") {
    					XTXT($captionstring);
    				}
    			} else {
    				if ($GLOBALS{'bulletin_image'} != "") {
    					XTABLEINVISIBLE();
    					XTR();
    					$imageurl = $GLOBALS{'domainwwwurl'}.'/domain_media/'.$GLOBALS{'bulletin_image'}; 
    					XTDIMG($imageurl,$GLOBALS{'bulletinboard_imagewidth'},"","0");
    					XTDTXT($captionstring);
    					X_TR();
    					X_TABLE();
    				} else {
    					XTXT($captionstring);
    				}
    			}
    			X_TD();
    			XTD();
    			$bulletin_targetdescription = "";
    			if ($GLOBALS{'bulletin_ref'} == "P") {
    				$bulletin_refdescription = "Link to Webpage";
    				Check_Data("webpage",$GLOBALS{'bulletin_target'});
    				$webpage_name = "unidentified webpage";
    				if ($GLOBALS{'IOWARNING'} == "0" ) {
    					$webpage_name = $GLOBALS{'webpage_name'};
    				}
    				$anchortext = " - Top of Page";
    				if ($GLOBALS{'bulletin_anchor'} != "") {
    					$anchortext = ' - "'.$GLOBALS{'bulletin_anchor'}.'" anchor point';
    				}
    				$bulletin_targetdescription = $GLOBALS{'bulletin_target'}.$anchortext;
    			}
    			if ($GLOBALS{'bulletin_ref'} == "L") {
    				$bulletin_refdescription = "Link to External URL";
    				$bulletin_targetdescription = $GLOBALS{'bulletin_target'} ;
    			}			
    			if ($GLOBALS{'bulletin_ref'} == "E") {
    				$bulletin_refdescription = "Link to Event";
    				Check_Data("event",$GLOBALS{'bulletin_target'});
    				$event_title = "unidentified event";
    				if ($GLOBALS{'IOWARNING'} == "0" ) {
    					$event_title = $GLOBALS{'event_title'};
    				}
    				$bulletin_targetdescription = $event_title;
    			}
    			if ($GLOBALS{'bulletin_ref'} == "A") {
    				$bulletin_refdescription = "Link to Article";
    				$article_title = "unidentified article";
    				if ($GLOBALS{'IOWARNING'} == "0" ) {
    					$article_title = $GLOBALS{'article_title'};
    				}
    				$bulletin_targetdescription = $article_title;
    			}
    			if ($GLOBALS{'bulletin_ref'} == "C") {
    				$bulletin_refdescription = "Link to Course";
    				$course_title = "unidentified course";
    				if ($GLOBALS{'IOWARNING'} == "0" ) {
    					$course_title = $GLOBALS{'course_title'};
    				}
    				$bulletin_targetdescription = $course_title;
    			}
    			if ($GLOBALS{'bulletin_ref'} == "R") {
    				$bulletin_refdescription = "Link to Match Report";
    				$bits = str_split($GLOBALS{'bulletin_target'});
    				if ($GLOBALS{'bulletin_periodid'} != "") {
    					$period_id = $GLOBALS{'bulletin_periodid'};
    				}
    				else { $period_id = $GLOBALS{'currperiodid'};
    				}
    				$team_code = $bits[0].$bits[1];
    				$team_name = "unidentified team";
    				Check_Data("team",$period_id,$team_code);
    				if ($GLOBALS{'IOWARNING'} == "0" ) {
    					$team_name = $GLOBALS{'team_name'};
    				}
    				Check_Data("frs",$period_id,$team_code,$GLOBALS{'bulletin_target'});
    				if ($GLOBALS{'IOWARNING'} == "0" ) {
    					$bulletin_targetdescription = $team_name." vs ".$GLOBALS{'frs_oppo'}." on ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'});
    				}
    				else { $bulletin_targetdescription = $period_id."|".$team_code."|".$GLOBALS{'bulletin_target'}."- not identified" ;
    				}
    			}
    			XTXTBOLD($bulletin_refdescription);XBR();
    			XTXT($bulletin_targetdescription);
    			X_TD();
    
    			XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'bulletin_date'}));
    
    			if ($GLOBALS{'bulletin_hide'} == "Hide") {
    				XTDTXT("<b>Hide</b>");
    			}
    			else {XTDTXT("Display");
    			}		
    			
    			XTD();
    			XLINKTXT($GLOBALS{'bulletin_linkurl'},"View Link");XBR();
    			$tbulletinlink = YPGMLINK("bulletineditout.php").YPGMSTDPARMS().YPGMPARM("bulletinboard_name",$bulletinboard_name).YPGMPARM("bulletin_id",$bulletin_id);
    			XLINKTXT($tbulletinlink,"Edit Bulletin");XBR();
    			$tbulletinlink = YPGMLINK("bulletindeleteconfirm.php").YPGMSTDPARMS().YPGMPARM("bulletin_id",$bulletin_id);
    			$tbulletinlink = $tbulletinlink.YPGMPARM("FixedBulletinBoard",$fixedbulletinboard).YPGMPARM("ReturnTo","BulletinBoardEdit");
    			XLINKTXT($tbulletinlink,"Delete Bulletin");XBR();			
    			X_TD();
    			X_TR();
			} else {
			    XPTXTCOLOR("Old Bulletin Removed - ".$GLOBALS{'bulletin_header'},"green");
			    // Get_Data('bulletin', $bulletin_id);
			}
		}
	}
	X_TD();X_TR();X_TABLE();
}


function Webpage_BULLETINCREATEA_Output () {
	$fixedbulletinboard = "";
	if((isset($_REQUEST['FixedBulletinBoard'])&&$_REQUEST['FixedBulletinBoard']!="")) { $fixedbulletinboard = $_REQUEST["FixedBulletinBoard"]; }
	XH2("Bulletin Creation");
	// $helplink = "WebMaster/WebPageUpdateBul_Output/webpageupdateBul_output.html"; Help_Link();
	XHR();
	XH4("Introduction");
	XPTXT("A Bulletin is a link to another element of the website and consists of some text and an image posted on a Bulletin Board. (Bulletin Boards are typically placed on the home page of the website).");
	XPTXT("If you are authorised, then the Bulletin Board is republished with the new Bulletin. Otherwise, a note will be sent to the appropriate Bulletin Board owner asking them to review and publish the Bulletin for you.");	
	XHR();
	XH4("Option 1 - Refer Bulletin to a Web Page");
	XFORM("bulletincreateain.php","webpagebulletins");
	XINSTDHID();
	XINHID("FixedBulletinBoard",$fixedbulletinboard);
	XINHID("BulletinRef","P");
	Webpage_Select_Table();
	X_FORM();
	XH4("Option 2 - Refer Bulletin to a WebLink");
	XFORM("bulletincreateain.php","weblinkbulletins");
	XINSTDHID();
	XINHID("FixedBulletinBoard",$fixedbulletinboard);
	XINHID("BulletinRef","L");
	Weblink_Select_Table();
	X_FORM();
	XH4("Option 3 - Refer Bulletin to an Event");
	XFORM("bulletincreateain.php","eventbulletins");
	XINSTDHID();
	XINHID("FixedBulletinBoard",$fixedbulletinboard);
	XINHID("BulletinRef","E");
	Event_Select_Table();
	X_FORM();
	XH4("Option 4 - Refer Bulletin to an Article");
	XFORM("bulletincreateain.php","articlebulletins");
	XINSTDHID();
	XINHID("FixedBulletinBoard",$fixedbulletinboard);
	XINHID("BulletinRef","A");
	Article_Select_Table();
	X_FORM();
	XH4("Option 5 - Refer Bulletin to a Course");
	XFORM("bulletincreateain.php","coursebulletins");
	XINSTDHID();
	XINHID("FixedBulletinBoard",$fixedbulletinboard);
	XINHID("BulletinRef","C");
	Course_Select_Table();
	X_FORM();
	if ( $GLOBALS{'service_frs'} != "" ) {
		XH4("Option 6 - Refer Bulletin to a Match Report");
		XFORM("bulletincreateain.php","matchreportbulletins");
		XINSTDHID();
		XINHID("FixedBulletinBoard",$fixedbulletinboard);
		XINHID("BulletinRef","R");
		Team_Select_Table();
		X_FORM();
	}
}

function Webpage_BULLETINDELETECONFIRM_Output ($bulletin_id,$fixedbulletinboard,$returnto) {
	Get_Data("bulletin",$bulletin_id);
	XH3("Delete Bulletin - ".$bulletin_id." - ".$GLOBALS{'bulletin_header'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this bulletin");
	XBR();
	XFORM("bulletindeleteaction.php","deletebulletin");
	XINSTDHID();
	XINHID("bulletin_id",$bulletin_id);
	XINHID("FixedBulletinBoard",$fixedbulletinboard);	
	XINHID("ReturnTo",$returnto);	
	XINSUBMIT("Confirm Bulletin Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Webpage_Select_Table () {
	$selectedpagelist = array();
	$webpagetemparray = array();
	$webpagefound = "0";
	foreach (Get_Array('webpage') as $webpage_name) {
		array_push($selectedpagelist,$webpage_name);
		$webpagefound = "1";
	}

	if ( $webpagefound == "0" ) {
		XPTXT("No webpages found to select from.");
	} else {
		XTABLE();
		XTR();
		XTDTXTWIDTH("Enter the name of the page that would like the bulletin to link to", "200");
		XTD();
		XINSELECT("WebpageName");
		XINOPTION("","selected","Select WebPage");
		foreach ($selectedpagelist as $webpage_name) {
			Get_Data("webpage",$webpage_name);
			$webbit5s = explode("/",$GLOBALS{'webpage_sequence'});
			$buthierarchy = count($webbit5s);
			$arrayelement = $GLOBALS{'webpage_sequence'}."/000/000/000/000/000/000/000/000/000"."#".$webpage_name."#".$buthierarchy;
			array_push($webpagetemparray, $arrayelement);
		}
		sort($webpagetemparray);
		foreach ($webpagetemparray as $webpagetemparrayelement) {
			$webbit3s = explode("#",$webpagetemparrayelement);
			$webpage_name = $webbit3s[1];
			$buthierarchy = $webbit3s[2];
			$buttext = $webpage_name;
			for ($inset = 1; $inset < $buthierarchy; $inset++) {
				$buttext = "--".$buttext;
			}
			XINOPTION($webpage_name,"",$buttext);
		}
	}
	XIN_SELECT();
	X_TD();
	X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
}

function Event_Select_Table () {
	$selectedeventlist = Array();
	$eventfound = "0";
	foreach (Get_Array('event') as $event_id) {
		array_push($selectedeventlist,$event_id);
		$eventfound = "1";
	}
	if ( $eventfound == "0" ) {
		XPTXT("There are no events to select from");
	} else {
		XTABLE();
		XTR();
		XTDTXT("Enter the title of the event");
		XTD();
		XINSELECT ("EventId");
		XINOPTION("","selected","Select Event");
		foreach ($selectedeventlist as $event_id) {	
			Get_Data("event", $event_id);
			XINOPTION($event_id,"",$GLOBALS{'event_title'});
		}
		XIN_SELECT();
		X_TD();
		X_TR();
		XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
		X_TABLE();
	}
}

function Article_Select_Table () {
	$selectedarticlelist = Array(); $articlefound = "0";
	foreach (Get_Array('article') as $article_id) {
		array_push($selectedarticlelist,$article_id);
		$articlefound = "1";
	}
	if ( $articlefound == "0" ) {
		XPTXT("There are no articles to select from");
	} else {
		XTABLE();
		XTR();
		XTDTXT("Enter the title of the article");
		XTD();
		XINSELECT ("ArticleId");
		XINOPTION("","selected","Select Article");
		foreach ($selectedarticlelist as $article_id) {
			Get_Data("article", $article_id);
			XINOPTION($article_id,"",$GLOBALS{'article_title'});
		}
		XIN_SELECT();
		X_TD();
		X_TR();
		XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
		X_TABLE();
	}
}

function Course_Select_Table () {
	$selectedcourselist = Array(); $coursefound = "0";
	foreach (Get_Array('course') as $course_id) {
		array_push($selectedcourselist,$course_id);
		$coursefound = "1";
	}
	if ( $coursefound == "0" ) {
		XPTXT("There are no courses to select from");
	} else {
		XTABLE();
		XTR();
		XTDTXT("Enter the title of the course");
		XTD();
		XINSELECT ("CourseId");
		XINOPTION("","selected","Select Course");
		foreach ($selectedcourselist as $course_id) {
			Get_Data("course", $course_id);
			XINOPTION($course_id,"",$GLOBALS{'course_title'});
		}
		XIN_SELECT();
		X_TD();
		X_TR();
		XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
		X_TABLE();
	}
}

function Team_Select_Table () {
	$teamlist = Array(); $selectedteamlist = Array(); $teamfound = "0";
	foreach (Get_Array("team",$GLOBALS{'currperiodid'}) as $tteam_code) {	
		array_push($teamlist, $tteam_code);
	}
	sort($teamlist);
	foreach ($teamlist as $tteam_code) {	
		foreach (Get_Array_Hash("section",$GLOBALS{'currperiodid'}) as $tsection_name) {
			Get_Data_Hash('section',$GLOBALS{'currperiodid'},$tsection_name);
			$sectionlist = $GLOBALS{'section_teams'};
			if ( FoundInCommaList($tteam_code,$sectionlist) ) {
				$fsection = $tsection_name;
			}
		}
		$authorised = "0";
		$searchstring = "RM#TeamCaptain=".$tteam_code."#,"; if (strpos($GLOBALS{'person_authority'}, $searchstring) !== false ) { $authorised = "1"; }
		$searchstring = "RM#TeamMgr=".$tteam_code."#,"; if (strpos($GLOBALS{'person_authority'}, $searchstring) !== false ) { $authorised = "1"; }
		$searchstring = "RM#TeamCoach=".$tteam_code."#,"; if (strpos($GLOBALS{'person_authority'}, $searchstring) !== false ) { $authorised = "1"; }
		$searchstring = "RM#TeamRM=".$tteam_code."#,"; if (strpos($GLOBALS{'person_authority'}, $searchstring) !== false ) { $authorised = "1"; }
		$searchstring = "RM#SectionLeader=".$fsection."#,"; if (strpos($GLOBALS{'person_authority'}, $searchstring) !== false ) { $authorised = "1"; }
		$searchstring = "RM#SectionRM=".$fsection."#,"; if (strpos($GLOBALS{'person_authority'}, $searchstring) !== false ) { $authorised = "1"; }
		$searchstring = "RM#Domain#,"; if (strpos($GLOBALS{'person_authority'}, $searchstring) !== false ) { $authorised = "1"; }
		$searchstring = "DM#Domain#,"; if (strpos($GLOBALS{'person_authority'}, $searchstring) !== false ) { $authorised = "1"; }
		
		$teamfound = "0";
		if ($authorised == "1") {
			array_push($selectedteamlist,$tteam_code);
			$teamfound = "1";
		}
	}
	if ( $teamfound == "0" ) {
		XPTXT("You are not authorised to use this option");
	} else {
		XTABLE();
		XTR();
		XTDTXT("Enter the name of the team");
		XTD();
		XINSELECT ("TeamCode");
		XINOPTION("","selected","Select Team");
		foreach ($selectedteamlist as $tteam_code) {	
			Get_Data_Hash("team",$GLOBALS{'currperiodid'}, $tteam_code);
			XINOPTION($tteam_code,"",$GLOBALS{'team_name'});
		}
		XIN_SELECT();
		X_TD();
		X_TR();
		XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
		X_TABLE();
	}
}

function Webpage_BULLETINCREATEB_Output ($season, $team_code, $fixedbulletinboard) {

	$frsa = Get_Array('frs',$GLOBALS{'currperiodid'}, $team_code);
	Get_Data("team",$GLOBALS{'currperiodid'},$team_code);
	XH2("Match Fixtures - ".$GLOBALS{'team_name'});
	
	XTABLE();
	XTR();
	XTDHTXT("Date");XTDHTXT("Opposition");XTDHTXT("Home/<BR>Away");XTDHTXT("League/<BR>Cup");XTDHTXT("Venue");
	XTDHTXT("Time");XTDHTXT("Info");
	XTDHTXT("");XTDHTXT("Result");XTDHTXT("F");XTDHTXT("A");XTDHTXT("");
	X_TR();
	$fixturesfound = "0";
	foreach ($frsa as $xfilename)  {
		$fixturesfound = "1";
		$bits = explode('.', $xfilename );
		$frs_id = $bits[0];
		Get_Data("frs",$GLOBALS{'currperiodid'},$team_code,$frs_id);
		XTR();
		XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'frs_date'}));
		$tclublink = "";
		if ($GLOBALS{'frs_oppoteamkey'} != "") {
			$teamsplit = explode('^', $GLOBALS{'frs_oppoteamkey'} );
			$oppoclub_name = $teamsplit[0]; $oppoteam_name = $teamsplit[1];
			Check_Data('oppoclub',$oppoclub_name);
			if ($GLOBALS{'IOWARNING'} == "0") {
				Get_Data('oppoclub',$oppoclub_name); $tclublink = $GLOBALS{'oppoclub_link'};
			}
		}
		if ($tclublink != "") {
		    XTDLINKTXT(Field2URL($tclublink),$GLOBALS{'frs_oppo'});
		}
		else {XTDTXT($GLOBALS{'frs_oppo'});
		}
		XTDTXT($GLOBALS{'frs_ha'});XTDTXT($GLOBALS{'frs_lcf'});
		if ($GLOBALS{'frs_ha'} == "H") {
			Check_Data('venue',$GLOBALS{'frs_venue'});
			if ($GLOBALS{'IOWARNING'} == "0" ) {
				XTDTXT($GLOBALS{'venue_name'});
			}
			else { 
				XTDTXT($GLOBALS{'frs_venue'});
			}
		}
		if ($GLOBALS{'frs_ha'} == "A") {
			XTDTXT($GLOBALS{'frs_awayvenue'});
		}		
		if (($GLOBALS{'frs_ha'} != "H")&&($GLOBALS{'frs_ha'} != "A")) {
			XTDTXT("");
		}
		/*
		$tvenue_name = ""; $tvenue_link = ""; $tempvenuetxt = "";
		if ($GLOBALS{'frs_venue'} != "") {
			Get_Data_Hash('venue',$GLOBALS{'frs_venue'});
			if ($GLOBALS{'IOWARNING'} == "0") {
				$tvenue_name = $GLOBALS{'venue_name'};
				$tvenue_link = "http://".$GLOBALS{'venue_link'};
				$tempvenuetxt = $tvenue_name; # temp nasty
			}
			else { $tvenue_name = $GLOBALS{'frs_venue'};
			$tempvenuetxt = $tvenue_name; # temp nasty
			}
		}
		if (($GLOBALS{'frs_netvenueref'} != "")&&($tvenue_link == "")) {
			if (ExtractNetRef($GLOBALS{'frs_netvenueref'},0) == "LOCAL") {
				$tvenue_code = ExtractNetRef($GLOBALS{'frs_netvenueref'},1);
				Get_Data_Hash('venue',$tvenue_code);
				$tvenue_name = $GLOBALS{'venue_name'};
				$tvenue_link = "http://".$GLOBALS{'venue_link'};
			}
			else {
				$tvenue_name = &Network_Venue_Name($oppoclub_name, $GLOBALS{'frs_netvenueref'});
				$tvenue_link = &Network_Venue_Link($oppoclub_name, $GLOBALS{'frs_netvenueref'});
			}
		}
		# if ($tvenue_link != "") {XTDLINKTXT($tvenue_link,$tvenue_name);} else {XTDTXT($tvenue_name);};
		XTDTXT($tempvenuetxt); # temp nasty
		*/
		XTDTXT($GLOBALS{'frs_time'});XTDTXT($GLOBALS{'frs_info'});
		if ($GLOBALS{'frs_cancellation'} == "Yes") {
		$cancelled = '<span style="color:red"><b>Cancelled</b></span>';
		} else {$cancelled = "";
			} XTDTXT($cancelled);
		XTDTXT($GLOBALS{'frs_result'});XTDTXT($GLOBALS{'frs_gf'});XTDTXT($GLOBALS{'frs_ga'});
		$link = YPGMLINK("bulletincreatebin.php").YPGMSTDPARMS();
		$link = $link.YPGMPARM("bulletin_periodid",$GLOBALS{'currperiodid'}).YPGMPARM("bulletin_target",$frs_id).YPGMPARM("FixedBulletinBoard",$fixedbulletinboard);
		XTDLINKTXT($link,"create bulletin");
			X_TR();
		}
		X_TABLE();
		if ($fixturesfound == "0") {
		print "<P>No fixtures have yet been entered\n";
		}	
	
}

function Webpage_BULLETINCREATEC_CSSJS () {

	$GLOBALS{'SITECSSOPTIONAL'} = "slim,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Webpage_BULLETINCREATEC_Output ($bulletinref, $bulletintarget, $bulletinanchor, $bulletinperiodid, $fixedbulletinboard) {
	if ($bulletinperiodid == "") { $bulletinperiodid = $GLOBALS{'currentperiodid'}; }
	// This routine maps bulletins from a single linkpoint to multiple bulletin boards	
	/*
	$pageselect = "";
	$weblink = "";
	$event_id = "";
	$article_id = "";
	$course_id = "";
	$thisfrs_id = "";
	$team_code = "";
	*/
	$targetimageavailable = "";
	
	//============== Header ======================
    XHR();
	Webpage_BulletinTargetHeader ($bulletinref,$bulletintarget,"",$bulletinperiodid);

    //============== Prepare array of bulletins that reference this target ======================    
    $bulletina = Get_Array("bulletin");
    $existingbulletinfound = "0";
    $bulsourcearray = array();
    foreach ($bulletina as $bulletin_id) {
    	Get_Data("bulletin",$bulletin_id);
    	// XH5($bulletin_id." - ".$GLOBALS{'bulletin_target'}." - ".$GLOBALS{'bulletin_ref'});	
    	if (($bulletinref == $GLOBALS{'bulletin_ref'})&&($bulletintarget == $GLOBALS{'bulletin_target'})) {	
    		$existingbulletinfound = "1";
    		$bulletinboardname = $GLOBALS{'bulletin_bulletinboardname'};
    		$bulletindate = $GLOBALS{'bulletin_date'};
    		$bulletinheader = $GLOBALS{'bulletin_header'};
    		$bulletintext = $GLOBALS{'bulletin_text'};
    		$bulletinimage = $GLOBALS{'bulletin_image'};
    		$bulletinlinkinfo = $GLOBALS{'bulletin_target'};
    		$bulletinref = $GLOBALS{'bulletin_ref'};
    		$bulletinanchor = $GLOBALS{'bulletin_anchor'};
    		$bulletinperiodid = $GLOBALS{'bulletin_periodid'};
    		$bulletinhide = $GLOBALS{'bulletin_hide'};
    		$bulsourcearrayelement = $bulletinboardname."#".$bulletindate."#".$bulletinheader."#".$bulletintext."#".$bulletinimage."#".$bulletinlinkinfo."#".$bulletinref."#".$bulletinanchor."#".$bulletinperiodid."#".$bulletinhide."#".$bulletin_id;
    		array_push($bulsourcearray, $bulsourcearrayelement);
    	}
    }    
    rsort($bulsourcearray);

    // $helplink = "WebMaster/WebPageUpdate_Bulletin_Output/webpageupdate_bulletin_output.html"; Help_Link;

    $sourcetext = "";
    if ($bulletinref == "P") { $sourcetext = "Page"; }  
    if ($bulletinref == "L") { $sourcetext = "Link"; }      
    if ($bulletinref == "R") { $sourcetext = "Match"; }          
    if ($bulletinref == "E") { $sourcetext = "Event"; }
    if ($bulletinref == "A") { $sourcetext = "Article"; }    
    if ($bulletinref == "C") { $sourcetext = "Course"; }

    // =============== existing  bulletins referencing this source 
    $formseq = 1;
    if (empty($bulsourcearray)) {
    	XHR();
    	XPTXT("There are no existing bulletins referencing this ".$sourcetext);
    } else {    	
    	XHR();
    	XH4("Existing bulletins referencing this ".$sourcetext);
	    foreach ($bulsourcearray as $message) {
	    	#  Class#Date#Type#Header#Text#Image#Linkinfo#Ref#Anchor
	    	$bulletinbits = explode('#', $message);
		    $bulletinboardname = $bulletinbits[0];
		    $bulletindate = $bulletinbits[1];
		    $bulletinheader = $bulletinbits[2];
		    $bulletintext = $bulletinbits[3];
		    $bulletinimage = $bulletinbits[4];
		    $bulletinlinkinfo = $bulletinbits[5];
		    $bulletinref = $bulletinbits[6];
	    	$bulletinanchor = $bulletinbits[7];
	    	$bulletinperiodid = $bulletinbits[8];
	    	$bulletinhide = $bulletinbits[9];    	    	
	    	$bulletinid = $bulletinbits[10]; 
		    XFORMUPLOAD("bulletincreatecin.php","bulletin_creation_".$bulletinboardname);
		    XINSTDHID();
		    XINHID("bulletin_ref".$formseq,$bulletinref);
		    XINHID("bulletin_target".$formseq,$bulletintarget); 
		    XINHID('FixedBulletinBoard'.$formseq,$fixedbulletinboard);
		    XINHID("FormSeq",$formseq);  
	    	XINHID('bulletin_id'.$formseq,$bulletinid);
	    	XINHID('bulletin_bulletinboardname'.$formseq,$bulletinboardname);
	    	XINHID("bulletin_targetimageavailable".$formseq,"NA");	
	    	// XINHID("bulletin_imageold".$formseq,$bulletinimage);		      	
		    XTABLE();
	    	XTR();XTDHTXT("");XTDHTXT("Existing Bulletin (".$bulletinid.")");X_TR();
    		Get_Data('bulletinboard',$bulletinboardname);
    		$postedtext = '"'.$bulletinboardname.'" bulletin board located on the "'.$GLOBALS{'bulletinboard_webpagename'}.'" page.';
	    	XTR();XTDTXT("Already posted on :-");XTDTXT($postedtext);X_TR();			
	    	XTR();XTDTXT("Date");XTDINDATEYYYY_MM_DD('bulletin_date'.$formseq,$bulletindate);X_TR();
	    	if ($bulletinref == "P") { XTR();XTDTXT("Anchor (Optional)");XTDINTXT('bulletin_anchor'.$formseq,$bulletinanchor,"20","20");X_TR(); }
			else {XINHID("bulletin_anchor".$formseq,"");}	
			// =================== Slim Image Cropper Output =======================
			$imagefieldname = "bulletin_image".$formseq;
			$imageviewwidth = "300";
			$imagename = $bulletinimage;
			$imageuploadto = "Bulletin";
			$imageuploadid = $bulletinid;
			$imageuploadwidth = "300";
			$imageuploadheight = "flex";
			$imageuploadfixedsize = "";
			$imagethumbwidth = "200";
			XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);						
			X_TD();X_TR();
			XTR();XTDTXT("Caption Introduction");XTDINTXT('bulletin_header'.$formseq,$bulletinheader,"20","20");X_TR();
			XTR();XTDTXT("Caption");XTDINTEXTAREA('bulletin_text'.$formseq,$bulletintext,"3","30");X_TR();
			XTR();XTDTXT("Displayed/Hidden"); XTD();
			if ($bulletinhide == "Display") {$checked = "checked";} else {$checked = "";}
			XINRADIO("bulletin_hide".$formseq,"Display",$checked,"Display Bulletin");
			if ($GLOBALS{'bulletin_hide'} == "Hide") {$checked = "checked";} else {$checked = "";}
			XINRADIO("bulletin_hide".$formseq,"Hide",$checked,"Hide Bulletin");
			X_TD();X_TR();
			if (AuthorisedToPublishBulletins($bulletinboardname)) {
				XTR();XTDTXT("");XTDINCHECKBOXYESNO("RePublish".$formseq,"Yes",'Automatically republish "'.$bulletinboardname.'" Bulletin Board after update');X_TR();
			}
			// XTR();XTDTXT("Delete");XTDINCHECKBOX ('bulletin_delete'.$formseq,"Delete","","Remove Bulletin");X_TR();
			XTR();XTDTXT("");
			XTD();
			XINSUBMIT("Update this Bulletin");
			$tbulletinlink = YPGMLINK("bulletindeleteconfirm.php").YPGMSTDPARMS().YPGMPARM("bulletin_id",$bulletin_id);
			$tbulletinlink = $tbulletinlink.YPGMPARM("FixedBulletinBoard",$fixedbulletinboard).YPGMPARM("ReturnTo","BULLETINCREATEC");
			XLINKBUTTON($tbulletinlink,"Delete this Bulletin");
			X_TD();
			X_TR();			
			X_TABLE();
			X_FORM();
			XBR();XBR();	
	    	$formseq++;
		}  
    }
    
    //============ new bulletin ============================
    
    $highestbulletinid = "B000000";
    $duplicate = "0";
    foreach (Get_Array("bulletin") as $bulletin_id) {
    	if ( $bulletin_id > $highestbulletinid ) {
    		$highestbulletinid = $bulletin_id;
    	}
    }
    $highestbulletinidnum = (int)substr($highestbulletinid,1,6);
    $nextbulletinid = "B".substr("000000".(string)($highestbulletinidnum+1),-6);
    
    $targetheaderavailable = "";
    $targettextavailable = "";
    $targetimageavailable = "";
    if ($bulletinref == "E") {
    	Check_Data("event",$bulletintarget);
    	if ($GLOBALS{'IOWARNING'} == "0" ) {
    		$targetsoursedescription = "Suggested image from Event";
    		$targetheaderavailable = $GLOBALS{'event_title'};
    		$targettextavailable = $GLOBALS{'event_excerpt'};
    		$targetimageavailable = $GLOBALS{'event_featuredimage'};
    	}
    }
    if ($bulletinref == "A") {
    	Check_Data("article",$bulletintarget);
    	if ($GLOBALS{'IOWARNING'} == "0" ) {
    		$targetsoursedescription = "Suggested image from Article";
    		$targetheaderavailable = $GLOBALS{'article_title'};
    		$targettextavailable = $GLOBALS{'article_excerpt'};
    		$targetimageavailable = $GLOBALS{'article_featuredimage'};
    	}
    }
    if ($bulletinref == "C") {
    	Check_Data("course",$bulletintarget);
    	if ($GLOBALS{'IOWARNING'} == "0" ) {
    		$targetsoursedescription = "Suggested image from Course";
    		$targetheaderavailable = $GLOBALS{'course_title'};
    		$targettextavailable = $GLOBALS{'course_excerpt'};
    		$targetimageavailable = $GLOBALS{'course_featuredimage'};
    	}
    }
    if ($bulletinref == "R") {
    	Check_Data("frs",$bulletinperiodid,$bulletintarget);
    	if ($GLOBALS{'IOWARNING'} == "0" ) {
    		$targetsoursedescription = "Suggested image from Match Report";
    		$targetheaderavailable = "";
    		$targettextavailable = $GLOBALS{'frs_reportheadline'};
    		$targetimageavailable = $GLOBALS{'frs_reportphotofilename'};
    	}
    }
    
    XHR();
    XH4("Create a new bulletin referencing this ".$sourcetext);
    if (!empty($bulsourcearray)) {
    	XPTXT("Caution: There are already bulletins referencing this ".$sourcetext);
    	XPTXT("You may wish, however, to create an additional bulletin for this ".$sourcetext." on another bulletin board.");
    }
    XFORMUPLOAD("bulletincreatecin.php","bulletin_creation");
    XINSTDHID();
    XINHID("bulletin_ref0",$bulletinref);
    XINHID("bulletin_target0",$bulletintarget);
    XINHID('FixedBulletinBoard0',$fixedbulletinboard);    
    XINHID("FormSeq","0");
    XINHID('bulletin_id0',"");
    XTABLE();
    XTR();XTDHTXT("");XTDHTXT("New Bulletin");X_TR();
    $bulletinboardnamea = Get_Array('bulletinboard');
    $bulletinboardpagenamea = Array();
    foreach ($bulletinboardnamea as $bulletinboard_name) {
    	Get_Data('bulletinboard',$bulletinboard_name);
    	array_push ($bulletinboardpagenamea,'"'.$bulletinboard_name.'" bulletin board located on the "'.$GLOBALS{'bulletinboard_webpagename'}.'" page.');
    }
    $xhash = Arrays2Hash($bulletinboardnamea,$bulletinboardpagenamea);
    XTR();XTDTXT("Post this to:-");XTDINSELECTHASH ($xhash,"bulletin_bulletinboardname0",$fixedbulletinboard);X_TR();
    XTR();XTDTXT("Date");XTDINDATEYYYY_MM_DD('bulletin_date0',$GLOBALS{'currentYYYY-MM-DD'});X_TR();
    if ($bulletinref == "P") {
    	XTR();XTDTXT("Anchor (Optional)");XTDINTXT('bulletin_anchor0',"","20","20");X_TR();
    }
    else { XINHID("bulletin_anchor0","");
    }
    
    XTR();XTDTXT("Image<br>(max 200px wide)");XTD();
    if ($targetimageavailable != "") {
    	XINHID("bulletin_targetimageavailable0","Yes");
    	XTXT($targetsoursedescription);XBR();
    	XIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$targetimageavailable,"200","","0");XBR();XBR();
    }
    XHR(); 
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "bulletin_image0";
    $imageviewwidth = "300";
    $imagename = "";
    $imageuploadto = "Bulletin";
    $imageuploadid = $nextbulletinid;
    $imageuploadwidth = "300";
    $imageuploadheight = "flex";
    $imageuploadfixedsize = "";
    $imagethumbwidth = "200";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    X_TD();X_TR();
    XTR();XTDTXT("Caption Introduction");XTDINTXT('bulletin_header0',$targetheaderavailable,"20","20");X_TR();
    XTR();XTDTXT("Caption");XTDINTEXTAREA('bulletin_text0',$targettextavailable,"3","30");X_TR();
    XTR();XTDTXT("Displayed/Hidden"); XTD();
    if ($GLOBALS{'bulletin_hide'} == "Display") {
    	$checked = "checked";
    } else {$checked = "";
    }
    XINRADIO("bulletin_hide0","Display",$checked,"Display Bulletin");
    if ($GLOBALS{'bulletin_hide'} == "Hide") {
    	$checked = "checked";
    } else {$checked = "";
    }
    XINRADIO("bulletin_hide0","Hide",$checked,"Hide Bulletin");
    X_TD();X_TR();
    if (AuthorisedToPublishBulletins($bulletinboardname)) {
    	XTR();XTDTXT("");XTDINCHECKBOXYESNO("RePublish0","Yes",'Automatically republish the selected Bulletin Board after update');X_TR();
    }
    XTR();XTDTXT("");XTDINSUBMIT("Create New Bulletin");X_TR();
    X_TABLE();
    X_FORM();
    
    // Now create the slim image popup areas for existing and new bulletins
    $formseq = 1;
    if (empty($bulsourcearray)) {}
    else {
    	foreach ($bulsourcearray as $message) {
    		#  Class#Date#Type#Header#Text#Image#Linkinfo#Ref#Anchor
    		$bulletinbits = explode('#', $message);
	    	$bulletinid = $bulletinbits[10]; 
	    	$bulletinimage = $bulletinbits[4];	    	   
	    	// =================== Slim Image Cropper Parameters =======================
	    	$imagefieldname = "bulletin_image".$formseq;
	    	$imageviewwidth = "300";
	    	$imagename = $bulletinimage;
	    	$imageuploadto = "Bulletin";
	    	$imageuploadid = $bulletinid;
	    	$imageuploadwidth = "300";
	    	$imageuploadheight = "flex";
	    	$imageuploadfixedsize = "";
	    	$imagethumbwidth = "200";    
		    SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
		    $imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
		    $formseq++;
    	}
    }
    $formseq = 0;
    // =================== Slim Image Cropper Parameters =======================
    $imagefieldname = "bulletin_image".$formseq;
    $imageviewwidth = "300";
    $imagename = "";
    $imageuploadto = "Bulletin";
    $imageuploadid = $nextbulletinid;
    $imageuploadwidth = "300";
    $imageuploadheight = "flex";
    $imageuploadfixedsize = "";
    $imagethumbwidth = "200";
    SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
    $imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);  
}

function BulletinLink ($tbulletin_ref,$tbulletin_target,$tbulletin_anchor,$tbulletin_periodid){
	$tbulletinlink = "";
	if ($tbulletin_ref == "P") {
		Check_Data("webpage",$tbulletin_target);
		if ($GLOBALS{'IOWARNING'} == "0" ) {
			$tbulletinlink = $GLOBALS{'domainwwwurl'}."/".$GLOBALS{'webpage_address'};
		}
	}
	if ($tbulletin_ref == "E") {
		$tbulletinlink = YPGMLINK("webpageeventwebview.php").YPGMMINPARMS().YPGMPARM("event_id",$tbulletin_target);
	}
	if ($tbulletin_ref == "A") {
		$tbulletinlink = YPGMLINK("webpagearticlewebview.php").YPGMMINPARMS().YPGMPARM("article_id",$tbulletin_target);
	}
	if ($tbulletin_ref == "C") {
		$tbulletinlink = YPGMLINK("webpagecoursewebview.php").YPGMMINPARMS().YPGMPARM("course_id",$tbulletin_target);
	}
	if ($tbulletin_ref == "R") {
		if ($tbulletin_periodid == "") {
			$tbulletin_periodid = $GLOBALS{'currperiodid'};
		}
		$tbulletinlink = YPGMLINK("frsteamresultdisplay.php").YPGMSTDPARMS();
		$tbulletinlink = $tbulletinlink.YPGMPARM("Season",$tbulletin_periodid).YPGMPARM("frs_id",$tbulletin_target);
	}
	if ($tbulletin_ref == "L") {
		$tbulletinlink = $tbulletin_target;
	}
	return $tbulletinlink;
}

function Webpage_BULLETINEDIT_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Webpage_BULLETINEDIT_Output ($bulletinboard_name,$bulletin_id){
	// this edits a specific bulletin already on a bulletin board
	Get_Data('bulletin', $bulletin_id);
	Webpage_BulletinTargetHeader ($GLOBALS{'bulletin_ref'},$GLOBALS{'bulletin_target'},$GLOBALS{'bulletin_anchor'},$GLOBALS{'bulletin_periodid'});
	XFORMUPLOAD("bulletineditin.php","");
	XINSTDHID();	
	XINHID("bulletinboard_name",$bulletinboard_name);
	XINHID("bulletin_id",$bulletin_id);	
	XTABLE();
	XTR();XTDHTXTFIXED("","200");XTDHTXTFIXED("","200");X_TR();
	Get_Data('bulletinboard',$bulletinboard_name);
	$postedtext = '"'.$bulletinboard_name.'" bulletin board located on the "'.$GLOBALS{'bulletinboard_webpagename'}.'" page.';
	XTR();XTDTXT("Already posted on :-");XTDTXT($postedtext);X_TR();	
	XTR();XTDTXT("Date");XTDINDATEYYYY_MM_DD('bulletin_date',$GLOBALS{'bulletin_date'});X_TR();
	if ($GLOBALS{'bulletin_ref'} == "P") {
		XTR();XTDTXT("Anchor (Optional)");XTDINTXT('bulletin_anchor',$GLOBALS{'bulletin_anchor'},"20","20");X_TR();
	}
	else {XINHID("bulletin_anchor","");
	}
	XTR();XTDTXT("Image<br>(max 200px wide)");XTD();
	XINHID("bulletin_image",$GLOBALS{'bulletin_image'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "bulletin_image";
	$imageviewwidth = "300";
	$imagename = $GLOBALS{'bulletin_image'};
	$imageuploadto = "Bulletin";
	$imageuploadid = $bulletin_id;
	$imageuploadwidth = "300";
	$imageuploadheight = "flex";
	$imageuploadfixedsize = "";
	$imagethumbwidth = "200";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);	

	X_TD();X_TR();
	XTR();XTDTXT("Caption Introduction");XTDINTXT('bulletin_header',$GLOBALS{'bulletin_header'},"20","20");X_TR();
	XTR();XTDTXT("Caption");XTDINTEXTAREA('bulletin_text',$GLOBALS{'bulletin_text'},"3","30");X_TR();
	XTR();XTDTXT("Displayed/Hidden"); XTD();
	if ($GLOBALS{'bulletin_hide'} == "Display") {
		$checked = "checked";
	} else {$checked = "";
	}
	XINRADIO("bulletin_hide","Display",$checked,"Display Bulletin");
	if ($GLOBALS{'bulletin_hide'} == "Hide") {
		$checked = "checked";
	} else {$checked = "";
	}
	XINRADIO("bulletin_hide","Hide",$checked,"Hide Bulletin");
	X_TD();X_TR();
	XTR();XTDTXT("");XTDINCHECKBOXYESNO("RePublish","Yes",'Automatically republish "'.$bulletinboard_name.'" Bulletin Board after update');X_TR();
	// XTR();XTDTXT("Delete");XTDINCHECKBOX ('bulletin_delete',"Delete","","Remove Bulletin");X_TR();
	XTR();XTDTXT("");XTDINSUBMITNAME ("Update Bulletin",'bulletin_update');X_TR();
	X_TABLE();
	X_FORM();
	XBR();
	$tbulletinlink = YPGMLINK("bulletinboardeditout.php").YPGMSTDPARMS().YPGMPARM("bulletinboard_name",$bulletinboard_name);
	XLINKTXT($tbulletinlink,'Return to "'.$bulletinboard_name.'" Bulletin Board Edit');XBR();
	
	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
}

function AuthorisedToPublishBulletins($bulletinboardname) {
	$authorisedtopublish = false;
	Get_Data("person",$GLOBALS{'LOGIN_person_id'});
	Get_Person_Authority();
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $authorisedtopublish = true; }  		
	if (strlen(strstr($GLOBALS{'person_authority'},"WM#Domain"))>0) { $authorisedtopublish = true; }
	if (strlen(strstr($GLOBALS{'person_authority'},"NM#Domain"))>0) { $authorisedtopublish = true; } 	
	Get_Data("commsmasters");
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'commsmasters_bulletinpublisherlist'})) { $authorisedtopublish = true;}
	$bulletinboardnamea = Get_Array('bulletinboard');
	foreach ($bulletinboardnamea as $bulletinboard_name) {
		Get_Data('bulletinboard',$bulletinboard_name);
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'bulletinboard_controllers'})) { $authorisedtopublish = true;}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'bulletinboard_users'})) { $authorisedtopublish = true;}
	}
	return $authorisedtopublish;
}

function Webpage_BulletinTargetHeader ($bulletinref, $bulletintarget, $bulletinanchor, $bulletinperiodid){
// this displays the target for a bulletin that is being created or edited
// XH2($bulletinref."|".$bulletintarget."|".$bulletinanchor."|".$bulletinperiodid);
if ($bulletinperiodid == "") { $bulletinperiodid = $GLOBALS{'currentperiodid'}; } 
if ($bulletinref == "P") {
	Check_Data("webpage",$bulletintarget);
	$webpage_name = "unidentified webpage";
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$webpage_name = $GLOBALS{'webpage_name'};
	}
	$anchortext = " - Top of Page";
	$anchorvalue = "";
	if ($bulletinanchor != "") {
		$anchortext = ' - "'.$bulletinanchor.'" anchor point';
		$anchorvalue = '#'.$bulletinanchor;
	}
	XH2('Bulletin Edit : link back to the "'.$webpage_name.'" page'.$anchortext);
	$bulletinlink = $GLOBALS{'domainwwwurl'}."/".$GLOBALS{'webpage_address'}.$anchorvalue;
	XLINKTXTNEWPOPUP($bulletinlink,"View ".$webpage_name." Page","View Page","200","200","600","600");
}
if ($bulletinref == "L") {
	$weblink = $bulletintarget;
	XH2("External Link - $weblink");
	$bulletinlink = $weblink;
	XLINKTXTNEWPOPUP($weblink,"View Exteral Link","View Exteral Link","200","200","600","600");
}
if ($bulletinref == "E") {
	Check_Data("event",$bulletintarget);
	$event_title = "unidentified";
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$targetimageavailable = $GLOBALS{'event_featuredimage'};
		$event_title = $GLOBALS{'event_title'};
	}
	XH2('Bulletin Edit : link back to "'.$event_title.'" event');
	$bulletinlink = YPGMLINK("webpageeventwebview.php").YPGMSTDPARMS().YPGMPARM("event_id",$bulletintarget);
	XLINKTXTNEWPOPUP($bulletinlink,"View Event","View Event","200","200","600","600");
}
if ($bulletinref == "A") {
	Check_Data("article",$bulletintarget);
	$article_title = "unidentified";
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$targetimageavailable = $GLOBALS{'article_featuredimage'};
		$article_title = $GLOBALS{'article_title'};
	}
	XH2('Bulletin Edit : link back to "'.$article_title.'" article');
	$bulletinlink = YPGMLINK("webpagearticlewebview.php").YPGMSTDPARMS().YPGMPARM("article_id",$bulletintarget);
	XLINKTXTNEWPOPUP($bulletinlink,"View Article","View Article","200","200","600","600");
}
if ($bulletinref == "C") {
	Check_Data("course",$bulletintarget);
	$event_title = "unidentified";
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		$targetimageavailable = $GLOBALS{'course_featuredimage'};
		$course_title = $GLOBALS{'course_title'};
	}
	XH2('Bulletin Edit : link back to "'.$GLOBALS{'course_title'}.'" course');
	$bulletinlink = YPGMLINK("webpagecoursewebview.php").YPGMSTDPARMS().YPGMPARM("course_id",$bulletintarget);
	XLINKTXTNEWPOPUP($bulletinlink,"View Course","View Course","200","200","600","600");
}
if ($bulletinref == "R") {
	$thisfrs_id = $bulletintarget;
	$team_code = substr($thisfrs_id,0,2);
	// XH2($bulletinref."|".$bulletintarget."|".$bulletinanchor."|".$bulletinperiodid);
	Check_Data("frs",$bulletinperiodid,$team_code,$thisfrs_id);
	if ($GLOBALS{'IOWARNING'} == "0" ) {
		Check_Data("team",$bulletinperiodid,$team_code);
		if ($GLOBALS{'IOWARNING'} == "0" ) {
			$team_name = $GLOBALS{'team_name'};
			XH2('Bulletin Edit : link back to match report - '.$thisfrs_id.' - '.$GLOBALS{'team_name'}.' vs '.$GLOBALS{'frs_oppo'});
			$bulletinlink = YPGMLINK("frsteamresultdisplay.php").YPGMSTDPARMS().YPGMPARM("frs_id",$thisfrs_id);
			XLINKTXTNEWPOPUP($bulletinlink,"View Match Rerort","View Match Report","200","200","600","600");
		} else {
			XH2('Bulletin Edit : link back to match report - '.$thisfrs_id.' - '."Unidentified Team".' vs '.$GLOBALS{'frs_oppo'});
			$bulletinlink = YPGMLINK("frsteamresultdisplay.php").YPGMSTDPARMS().YPGMPARM("frs_id",$thisfrs_id);
			XLINKTXTNEWPOPUP($bulletinlink,"View Match Rerort","View Match Report","200","200","600","600");
		}

	} else {
		XH2('Bulletin Edit : link back to unidentified match report');
	}
}
XBR();XBR();
}

function Webpage_PLUGINCATEGORY_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Webpage_PLUGINCATEGORY_Output() {
    $parm0 = "Plugin Category Update|plugincategory||plugincategory_name|plugincategory_name|No|No";
    $parm1 = "";
    $parm1 = $parm1."plugincategory_name|Yes|Category Name|100|Yes|Plugin Category Name|KeyText,25,50^";
    $parm1 = $parm1."plugincategory_title|Yes|Description|150|Yes|Description|InputText,50,90^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Webpage_PLUGINUTILITY_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Webpage_PLUGINUTILITY_Output() {
    $parm0 = "PlugIns|plugin|plugincategory|plugin_id|plugin_id|25|Yes";
    $parm1 = "";
    $parm1 = $parm1."plugin_id|Yes|Id|40|Yes|Plugin Id|KeyTimestamp^";    
    $parm1 = $parm1."plugin_name|Yes|Name|120|Yes|Plugin Name|InputText,25,50^";
    $parm1 = $parm1."plugin_image|No||30|Yes|Plugin Image|InputImage,GLOBALDOMAINWWWURL/domain_style,GLOBALDOMAINWWWPATH/domain_style,800,flex,Plugin,plugin_id^";
    $parm1 = $parm1."plugin_type|Yes|Type|70|Yes|Plugin Type|InputSelectFromList,Static+Dynamic^";
    $parm1 = $parm1."plugin_category|Yes|Category|70|Yes|Category|InputSelectFromTable,plugincategory,plugincategory_name,plugincategory_title,plugincategory_name^";
    $parm1 = $parm1."plugin_triggers|Yes|Triggers|100|Yes|Plugin Triggers|InputTextArea,3,50^";
    $parm1 = $parm1."plugin_parmlist|No|||Yes|Parameter List|InputTextArea,4,90^";
    $parm1 = $parm1."plugin_embeddedhtml|No|||Yes|Embedded HTML|InputSelectFromList,Yes+No^";
    $parm1 = $parm1."plugin_pagephp|No|||Yes|Webpage PHP|InputTextArea,6,90^";
    $parm1 = $parm1."plugin_pagejs|No|||Yes|Webpage Javascript|InputTextArea,3,90^";
    $parm1 = $parm1."plugin_dynamicphp|No|||Yes|Dynamic PHP|InputTextArea,3,90^";
    $parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    $parm2 = "Activate Plugins|plugingenerate.php|SpecialAction=Generate";	
    GenericHandler_Output ($parm0,$parm1,$parm2);    
}

function Webpage_PluginTriggerChanged_Output($trigger) {
    $pluginselecteda = Array();
    $plugina = Get_Array('plugin');
    foreach ($plugina as $plugin_id) {
        Get_Data("plugin",$plugin_id);  
        if (FoundInCommaList( $trigger,$GLOBALS{'plugin_triggers'}) ) {
            array_push($pluginselecteda,$plugin_id); 
        }
    }
    $pluginselecteda = array_unique($pluginselecteda);
    
    foreach (Get_Array('webpage') as $webpage_name) {
        $republish = "0";
        Get_Data("webpage",$webpage_name);
        $webplugina = explode(",",$GLOBALS{'webpage_pluginlist'});
        foreach ($webplugina as $pluginstring) {
            // [Tyyyymmddhhmmss:Category=All;Date=Future;SortBy=Date;SortSeq=Asc;Show=Full;Max=10;]
            $ptype = String2PluginType($pluginstring);
            $wparmvala = String2PluginParmVals($pluginstring);           
            if (in_array($ptype, $pluginselecteda)) {
                $republish = "1";
            }
        }
        if ( $republish == "1" ) {
            Webpage_WEBPAGEPUBLISH_Output($webpage_name);
        }
    }
}

function Webpage_PluginPluginChanged_Output($pluginid) {
    foreach (Get_Array('webpage') as $webpage_name) {
        $republish = "0";
        Get_Data("webpage",$webpage_name);
        $webplugina = explode(",",$GLOBALS{'webpage_pluginlist'});
        foreach ($webplugina as $pluginstring) {
            $tpluginid = String2PluginType($pluginstring);
            if ( $pluginid == $tpluginid ) {
                $republish = "1";
            }
        }
        if ( $republish == "1" ) {
            Webpage_WEBPAGEPUBLISH_Output($webpage_name);
        }
    }
}

