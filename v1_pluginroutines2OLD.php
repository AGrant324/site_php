<?php

// ========== Bulletin Board =====================

function Plugin_BulletinBoard_Publish ($webpage_name,$parmvala) {
    // [BulletinBoard:Name=Test;]
    $bulletinboard_name = $parmvala[0];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('The "'.$bulletinboard_name.'" Bulletin Board on "'.$webpage_name.'" page has been re-published',"green");
    // <!-- PLUGIN [BulletinBoard:Name=Test;] -->
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [BulletinBoard:Name='.$bulletinboard_name.";",'/PLUGIN',BulletinBoardHTMLGen($parmvala));
}

function BulletinBoardHTMLGen($parma) {
    $bulletinboardname = $parma[0];
	// XH2($bulletinboardname);
	Get_Data("bulletinboard",$bulletinboardname);
	$bulletinboardmax = $GLOBALS{'bulletinboard_max'}*1;
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
		if (($GLOBALS{'bulletin_bulletinboardname'} == $bulletinboardname)&&($GLOBALS{'bulletin_hide'} != "Hide")) {
			$arrayelement = $GLOBALS{'bulletin_date'}."#".$bulletin_id;
			array_push($bulletintemparray, $arrayelement);
		}
	}
	rsort ($bulletintemparray);

	$bbhtmla = Array();
	
	$bulletinboardcount = 0;
	foreach ($bulletintemparray as $arrayelement) {
		$bulbit3s = explode("#",$arrayelement);
		$bulletin_id = $bulbit3s[1];
		Get_Data('bulletin', $bulletin_id);
		if ($GLOBALS{'bulletin_hide'} != "Hide") {
			$bulletinboardcount++;
		}
		
		if ($bulletinboardcount < $bulletinboardmax+1) {
			array_push($bbhtmla, YDIV("","bcontainer"));
			$captionstring = "<b>".$GLOBALS{'bulletin_header'}.".</b> ".$GLOBALS{'bulletin_text'};
			if (strlen($captionstring) > ($GLOBALS{'bulletinboard_textmax'} + 8)) {
				$captionstring = substr($captionstring, 0, ($GLOBALS{'bulletinboard_textmax'} + 8))."...";
			}
			if ($GLOBALS{'bulletinboard_showdates'} == "Yes") {
				$captionstring = $captionstring." - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'bulletin_date'});
			}
			if (($bulletinboardcount == 1)&&($GLOBALS{'bulletinboard_topstoryenabled'} == "Yes")&&($bulletinboardcount <= $bulletinboardmax)&&($GLOBALS{'bulletin_hide'} != "Hide")) {
				if ($GLOBALS{'bulletinboard_topstorytextposition'} == "Above image") {
					array_push($bbhtmla, YDIV("","btexcerpt"));
					array_push($bbhtmla, YLINKTXT($GLOBALS{'bulletin_linkurl'},$captionstring));
					array_push($bbhtmla, Y_DIV("","btexcerpt"));
				}
				if ($GLOBALS{'bulletin_image'} != "") {
					$imageurl = $GLOBALS{'domainwwwurl'}.'/domain_media/'.$GLOBALS{'bulletin_image'};
					array_push($bbhtmla, YDIV("","btimage"));
					array_push($bbhtmla, YLINKIMGWIDTH($GLOBALS{'bulletin_linkurl'},$imageurl,"100%"));
					array_push($bbhtmla, Y_DIV("","btimage"));
				}
				if ($GLOBALS{'bulletinboard_topstorytextposition'} != "Below Image") {
					array_push($bbhtmla, YDIV("","btexcerpt"));
					array_push($bbhtmla, YLINKTXT($GLOBALS{'bulletin_linkurl'},$captionstring));
					array_push($bbhtmla, Y_DIV("","btexcerpt"));
				}
				array_push($bbhtmla, YHR());
			} else {
				if ($GLOBALS{'bulletin_image'} != "") {
					array_push($bbhtmla, YDIV("","biimage"));
					$imageurl = $GLOBALS{'domainwwwurl'}.'/domain_media/'.$GLOBALS{'bulletin_image'};
					array_push($bbhtmla, YLINKIMGWIDTH($GLOBALS{'bulletin_linkurl'},$imageurl,"100%"));
					array_push($bbhtmla, Y_DIV("","biimage"));
					array_push($bbhtmla, YDIV("","biexcerpt"));
					array_push($bbhtmla, YLINKTXT($GLOBALS{'bulletin_linkurl'},$captionstring));
					array_push($bbhtmla, Y_DIV("","biexcerpt"));
					array_push($bbhtmla, YCLEARFLOAT());
				} else {
					array_push($bbhtmla, YDIV("","bexcerpt"));
					array_push($bbhtmla, YLINKTXT($GLOBALS{'bulletin_linkurl'},$captionstring));
					array_push($bbhtmla, Y_DIV("","bexcerpt"));
					array_push($bbhtmla, YCLEARFLOAT());
				}
			}
			array_push($bbhtmla, Y_DIV("","bcontainer"));
		}		
	}
	return($bbhtmla);
}

// ========== Item Lists =====================

function Plugin_ItemListA_Publish ($webpage_name,$parmvala) {
    // [ItemListA:Category=Article_All;Date=Past;SortBy=Date;SortSeq=Asc;Show=Full;Max=10;]
    $itemcategory = $parmvala[0];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('ItemListA '.$itemcategory.' on "'.$webpage_name.'" page has been re-published',"green");
    $itemcategorya = explode('_',$itemcategory);
    if ($itemcategorya[0] == "Event") {       
        Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [ItemListA:Category='.$itemcategory.";",'/PLUGIN',EventListHTMLAGen($parmvala));
    }
    if ($itemcategorya[0] == "Article") {
        Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [ItemListA:Category='.$itemcategory.";",'/PLUGIN',ArticleListHTMLAGen($parmvala));
    }
    if ($itemcategorya[0] == "Course") {
        Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [ItemListA:Category='.$itemcategory.";",'/PLUGIN',CourseListHTMLAGen($parmvala));
    }
    if ($itemcategorya[0] == "Draw") {
        Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [ItemListA:Category='.$itemcategory.";",'/PLUGIN',DrawListHTMLAGen($parmvala));
    }
}

function EventListHTMLAGen($parma) {
    $category = $parma[0];
    $cbits = explode("_",$category);
    $categoryid = $cbits[1];
    $fpdate = $parma[1];
    $sortby = $parma[2];
    $sortseq = $parma[3];
    $show = $parma[4];
    $max = $parma[5];
    // XH1($categoryid." ".$fpdate." ".$sortby." ".$sortseq." ".$show." ".$max);
    
    $GLOBALS{'pluginhtmla'} = Array();
    WH2("Upcoming Events");
    
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
                WDIV($bitsa[1],"eaclass" );
                WH2($GLOBALS{'event_title'});
                WTXT($GLOBALS{'event_excerpt'});
                if ($GLOBALS{'event_featuredimage'} != "") {
                    WBR();WBR();
                    WIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'},"100%");
                }
                WBR();WBR();
                WTXT(EAHTML2PAGE($GLOBALS{'event_report'},"740"));
                WBR();
                Check_Data("person",$GLOBALS{'event_contact'});
                if ($GLOBALS{'IOWARNING'} == "0" ) {
                    $showmobiletel = ""; $showemail = "";
                    if ($GLOBALS{'person_mobiletel'} != "" ) { $showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'}; }
                    if ($GLOBALS{'person_email1'} != "" ) { $showemail = "Email: ".$GLOBALS{'person_email1'}; }
                    WTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
                } else {
                    WTXT("Contact - ".$GLOBALS{'event_contact'});
                }
                WBR();
                WTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'event_date'}));
                WBR();
                WTXT("Time - ".$GLOBALS{'event_time'});
                WBR();
                Check_Data('venue',$GLOBALS{'event_venuecode'});
                WTXT("Venue - ".$GLOBALS{'venue_name'});
                WBR();WBR();
                
                if ($GLOBALS{'event_full'} == "Yes") { WH4("Sorry this event is now fully booked."); }
                if ($GLOBALS{'event_personorteam'} == "Team") { WTXT("This is a team event").YBR(); }
                
                if ($GLOBALS{'event_bookable'} == "Yes") {
                    if ($GLOBALS{'event_charge'} != 0) {
                        if ($GLOBALS{'event_personorteam'} == "Team") {
                            WTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
                        } else {
                            WTXT("Charge per person - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
                            if ($GLOBALS{'event_discountpercent'} != "") {
                                WBR();WBR();
                                WTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
                            }
                        }
                    }
                    WBR();WBR();
                    $link = YPGMLINK("bookingeventout.php");
                    $link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
                    WLINKBUTTONNEWWINDOW ($link,"Book This Event","Booking");
                } else {
                    if ($GLOBALS{'event_charge'} != 0) {
                        if ($GLOBALS{'event_personorteam'} == "Team") {
                            WTXT("Charge per team - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
                        } else {
                            XTXT("Charge per person - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'event_charge'}, 2, '.', ''));
                            if ($GLOBALS{'event_discountpercent'} != "") {
                                WBR();WBR();;
                                WTXT("<B>Note:</B>  If you buy ".$GLOBALS{'event_discountthreshold'}." or more tickets you get a discount of ".$GLOBALS{'event_discountpercent'}."%");
                            }
                        }
                    }
                }
                W_DIV($bitsa[1]);
                WBR();WBR();
            }
            if ( ($show == "excerpt")||($show == "Excerpt") )	{
                WDIV($bitsa[1],"eaclass" );
                WTABLEINVISIBLE();
                WTR();
                if ($GLOBALS{'event_featuredimage'} != "") {
                    WTDTOPWIDTH("40%");
                    WIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'event_featuredimage'},"100%","","");
                    W_TD();
                }
                WTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");
                WTDTOP();
                WH3($GLOBALS{'event_title'});
                WBR();
                WTXT($GLOBALS{'event_excerpt'});
                WBR().WBR();
                $link = YPGMLINK("webpageeventwebview.php");
                $link = $link.YPGMMINPARMS().YPGMPARM("event_id",$event_id);
                WLINKTXTNEWPOPUP($link,"Read More..","eventview","100","100","800","800");
                W_TD();
                W_TR();
                W_TABLE();
                W_DIV($bitsa[1]);
                WBR();
            }
        }
    }
    return($GLOBALS{'pluginhtmla'});
}


function DrawListHTMLAGen($parma) {
    $category = $parma[0];
    $cbits = explode("_",$category);
    $categoryid = $cbits[1];
    $fpdate = $parma[1];
    $sortby = $parma[2];
    $sortseq = $parma[3];
    $show = $parma[4];
    $max = $parma[5];
    // XH1($categoryid." ".$fpdate." ".$sortby." ".$sortseq." ".$show." ".$max);
    
    $GLOBALS{'pluginhtmla'} = Array();
    WH2("Upcoming Raffles");
    
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
                WDIV($bitsa[1],"eaclass" );
                WH2($GLOBALS{'draw_title'});
                WTXT($GLOBALS{'draw_excerpt'});
                if ($GLOBALS{'draw_featuredimage'} != "") {
                    WBR();WBR();
                    WIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'},"100%");
                }
                WBR();WBR();
                WTXT(EAHTML2PAGE($GLOBALS{'draw_description'},"740"));
                WBR();
                Check_Data("person",$GLOBALS{'draw_contact'});
                if ($GLOBALS{'IOWARNING'} == "0" ) {
                    $showmobiletel = ""; $showemail = "";
                    if ($GLOBALS{'person_mobiletel'} != "" ) {
                        $showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
                    }
                    if ($GLOBALS{'person_email1'} != "" ) {
                        $showemail = "Email: ".$GLOBALS{'person_email1'};
                    }
                    WTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
                } else {
                    WTXT("Contact - ".$GLOBALS{'draw_contact'});
                }
                WBR();
                WTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'draw_date'}));
                WBR();
                WTXT("Time - ".$GLOBALS{'draw_time'});
                WBR();
                Check_Data('venue',$GLOBALS{'draw_venuecode'});
                WTXT("Venue - ".$GLOBALS{'venue_name'});
                WBR();WBR();
                if ($GLOBALS{'draw_full'} == "Yes") {
                    WH5("Sorry this draw is now fully booked.");
                }
                if ($GLOBALS{'draw_charge'} != 0) {
                    WTXT("Charge per ticket - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'draw_charge'}, 2, '.', ''));
                }
                WBR();WBR();
                $link = YPGMLINK("bookingdrawout.php");
                $link = $link.YPGMMINPARMS().YPGMPARM("draw_id",$draw_id);
                WLINKBUTTONNEWWINDOW ($link,"Book This Event","Booking");
                W_DIV($bitsa[1]);
                WBR();WBR();
            }
            if ( ($show == "excerpt")||($show == "Excerpt") )	{
                WDIV($bitsa[1],"eaclass" );
                WTABLEINVISIBLE();
                WTR();
                if ($GLOBALS{'draw_featuredimage'} != "") {
                    WTDTOPWIDTH("40%");
                    WIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'draw_featuredimage'},"100%","","");
                    W_TD();
                }
                WTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");
                WTDTOP();
                WH3($GLOBALS{'draw_title'});
                WBR();
                WTXT($GLOBALS{'draw_excerpt'});
                WBR();WBR();
                $link = YPGMLINK("webpagedrawwebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("draw_id",$bitsa[1]);
                WLINKTXTNEWPOPUP($link,"Read More..","drawview","100","100","800","800");
                W_TD();
                W_TR();
                W_TABLE();
                W_DIV($bitsa[1]);
                WBR();
            }
        }
    }
    return($GLOBALS{'pluginhtmla'});
}

function ArticleListHTMLAGen($parma) {
    $category = $parma[0];
    $cbits = explode("_",$category);
    $categoryid = $cbits[1];
    $fpdate = $parma[1];
    $sortby = $parma[2];
    $sortseq = $parma[3];
    $show = $parma[4];
    $max = $parma[5];
    // XH1($categoryid." ".$fpdate." ".$sortby." ".$sortseq." ".$show." ".$max);
    
    $GLOBALS{'pluginhtmla'} = Array();
    WH2("Recent Articles");
    
    $combineda = Array();
    $articlea = Get_Array('article');
    foreach ($articlea as $article_id) {
        Get_Data("article",$article_id);
        $usethisarticle = "1";
        if ( $GLOBALS{'article_publicationstatus'} != "Published" ) { $usethisarticle = "0"; }
        if ( ($categoryid != $GLOBALS{'article_categoryid'})&&($categoryid != "all")&&($categoryid != "All") ) { $usethisarticle = "0"; }
        if ( ($fpdate == "future")||($fpdate == "Future") ) {
            if ( $GLOBALS{'article_date'} < $GLOBALS{'currentYYYY-MM-DD'} ) { $usethisarticle = "0"; }
        }
        if ( ($fpdate == "past")||($fpdate == "Past") ) {
            if ( $GLOBALS{'article_date'} > $GLOBALS{'currentYYYY-MM-DD'} ) { $usethisarticle = "0"; }
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
                WDIV($bitsa[1],"eaclass" );
                WH2($GLOBALS{'article_title'});
                WTXT($GLOBALS{'article_excerpt'});
                if ($GLOBALS{'article_featuredimage'} != "") {
                    WBR();WBR();
                    WIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'article_featuredimage'},"100%");
                }
                WBR();WBR();
                WTXT(EAHTML2PAGE($GLOBALS{'article_report'},"740"));
                WBR();
                WTXT("Author - ".$GLOBALS{'article_author'});
                WBR();
                WTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'article_date'}));
                WBR();
                W_DIV($bitsa[1]);
                WBR();
            }
            if ( ($show == "excerpt")||($show == "Excerpt") )	{
                WDIV($bitsa[1],"eaclass" );
                WTABLEINVISIBLE();
                WTR();
                if ($GLOBALS{'article_featuredimage'} != "") {
                    WTDTOPWIDTH("40%");
                    WIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'article_featuredimage'},"100%","","");
                    W_TD();
                }
                WTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");
                WTDTOP();
                WH3($GLOBALS{'article_title'});
                WBR();
                WTXT($GLOBALS{'article_excerpt'});
                WBR();WBR();
                $link = YPGMLINK("webpagearticlewebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("article_id",$bitsa[1]);
                WLINKTXTNEWPOPUP($link,"Read More..","eventview","100","100","800","800");
                W_TD();
                W_TR();
                W_TABLE();
                W_DIV($bitsa[1]);
                WBR();
            }
        }
    }
    return($GLOBALS{'pluginhtmla'});
}

function CourseListHTMLAGen($parma) {
    $category = $parma[0];
    $cbits = explode("_",$category);
    $categoryid = $cbits[1];
    $fpdate = $parma[1];
    $sortby = $parma[2];
    $sortseq = $parma[3];
    $show = $parma[4];
    $max = $parma[5];
    // XH1($categoryid." ".$fpdate." ".$sortby." ".$sortseq." ".$show." ".$max);
    
    $GLOBALS{'pluginhtmla'} = Array();
    WH2("Upcoming Courses");
    
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
                WDIV($bitsa[1],"eaclass" );
                WH2($GLOBALS{'course_title'});
                WTXT($GLOBALS{'course_excerpt'});
                if ($GLOBALS{'course_featuredimage'} != "") {
                    WBR();WBR();
                    WIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"100%");
                }
                WBR();WBR();
                WTXT(EAHTML2PAGE($GLOBALS{'course_description'},"740"));
                WBR();
                WHR();
                WBR();
                Check_Data("person",$GLOBALS{'course_contact'});
                if ($GLOBALS{'IOWARNING'} == "0" ) {
                    $showmobiletel = ""; $showemail = "";
                    if ($GLOBALS{'person_mobiletel'} != "" ) {
                        $showmobiletel = "Mob: ".$GLOBALS{'person_mobiletel'};
                    }
                    if ($GLOBALS{'person_email1'} != "" ) {
                        $showemail = "Email: ".$GLOBALS{'person_email1'};
                    }
                    WTXT("Contact - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$showmobiletel." ".$showemail);
                } else {
                    WTXT("Contact - ".$GLOBALS{'course_contact'});
                }
                WBR();
                if (($GLOBALS{'course_dateend'} == "")||($GLOBALS{'course_datestart'} == $GLOBALS{'course_dateend'})) {
                    WTXT("Date - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'}));
                } else {
                    WTXT("Dates - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_datestart'})." to ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_dateend'}));
                }
                WBR();
                WTXT("Time - ".$GLOBALS{'course_timestart'}." to ".$GLOBALS{'course_timeend'});
                WBR();
                WTXT("Venue - ".$GLOBALS{'course_venue'});
                WBR();WBR();
                if ($GLOBALS{'course_charge'} == 0) {
                    WTXT("Free of Charge");
                } else {
                    WTXT("Charge - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_charge'}, 2, '.', ''));
                    if ( $GLOBALS{'course_prepaidcharge'} != 0 ) {
                        WTXT(" : If pre-paid online - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_prepaidcharge'}, 2, '.', ''));
                    }
                    if ( $GLOBALS{'course_earlycharge'} != 0 ) {
                        // CHECK
                        // WTXT(" : If pre-paid online before - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'course_earlychargedate'})." - ".$GLOBALS{'countrycurrencysymbol'}.number_format($GLOBALS{'course_earlycharge'}, 2, '.', ''));
                    }
                }
                if ($GLOBALS{'course_partchargepermitted'} == "Yes") {
                    WPTXT($GLOBALS{'course_partchargeinstructions'});
                }
                WBR();WBR();
                if ($GLOBALS{'course_googlemapsembed'} != "") {
                    WDIV("XXX","YYY");
                    WTXT($GLOBALS{'course_googlemapsembed'});
                    W_DIV("XXX");
                    WBR();
                }
                WBR();WBR();
                $link = YPGMLINK("bookingcourseout.php");
                $link = $link.YPGMMINPARMS().YPGMPARM("course_id",$course_id);
                WLINKBUTTONNEWWINDOW ($link,"Book This Course","Booking");
                WBR();WBR();
                W_DIV($bitsa[1]);
                WBR();
            }
            if ( ($show == "excerpt")||($show == "Excerpt") )	{
                WDIV($bitsa[1],"eaclass" );
                WTABLEINVISIBLE();
                WTR();
                if ($GLOBALS{'course_featuredimage'} != "") {
                    WTDTOPWIDTH("40%");
                    WIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'course_featuredimage'},"100%","","");
                    W_TD();
                    WTDFIXED("10");
                    WTXT(' ');
                    W_TD();
                }
                WTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");
                WTDTOP();
                WH3($GLOBALS{'course_title'});
                WBR();
                WTXT($GLOBALS{'course_excerpt'});
                WBR();WBR();
                $link = YPGMLINK("bookingcourseout.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("course_id",$course_id);
                WLINKBUTTONNEWWINDOW ($link,"Read More / Book This Course","Booking");
                W_TD();
                W_TR();
                W_TABLE();
                W_DIV($bitsa[1]);
                WBR();
            }
        }
    }
    return($GLOBALS{'pluginhtmla'});
}

// ========== GRL =====================


function Plugin_GRLLeagueTableA_Publish ($webpage_name,$parmvala) {
    // [GRLLeagueTableA:League=West;]
    $grlleague_id = $parmvala[0];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLLeagueTableA('.$grlleague_id.') on "'.$webpage_name.'" page has been re-published',"green");
    // <!-- PLUGIN [GRLLeagueTableA:League=West;] -->
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLLeagueTableA:League='.$grlleague_id.";",'/PLUGIN',GRLLeagueTableAHTMLAGen($parmvala));
}


function GRLLeagueTableAHTMLAGen($parma) {
    $leagueid = $parma[0];
    // XH1($leagueid);
    
    $GLOBALS{'pluginhtmla'} = Array();
    
    $leagueteama = Array();
    $teama = Get_Array('grlleaguetable',$GLOBALS{'currperiodid'},$leagueid);
    foreach ($teama as $teamid) {
        Get_Data('grlleaguetable',$GLOBALS{'currperiodid'},$leagueid,$teamid);
        $sortstring1 = substr("0000".$GLOBALS{'grlleaguetable_points'},-4);
        $sortstring2 = substr("0000".(string)(1000+$GLOBALS{'grlleaguetable_tgdiff'}),-4);
        $leagueteamelement = $sortstring1."|".$sortstring2."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_grlteamname'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_played'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_hw'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_hd'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_hl'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_aw'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_ad'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_al'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tw'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_td'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tl'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tgf'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tga'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tgdiff'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_points'};
        array_push($leagueteama,$leagueteamelement);
    }
    rsort ($leagueteama);
    
    // WH3($leagueid." - ".$periodid);
    
    WDIV("simpletablediv_GRLLeagueTableA_".$periodid."_".$leagueid,"container");
    WTABLECOMPACTJQDTID("simpletabletable_GRLLeagueTableA_".$periodid."_".$leagueid);
    WTHEAD();
    WTRJQDT();
    WTDTXT('');
    WTDTXT('');
    WTDTXT('p');
    WTDTXT('hw');
    WTDTXT('hd');
    WTDTXT('hl');
    WTDTXT('aw');
    WTDTXT('ad');
    WTDTXT('al');
    WTDTXT('tw');
    WTDTXT('td');
    WTDTXT('tl');
    WTDTXT('tgf');
    WTDTXT('tga');
    WTDTXT('tgdiff');
    WTDTXT('points');
    W_TR();
    W_THEAD();
    WTBODY();
    
    $li = 0;
    foreach ($leagueteama as $leagueteamelement) {
        // XPTXT($leagueteamelement);
        $rowa = explode('|',$leagueteamelement);
        WTRJQDT();
        $li++;
        WTDTXT($li);
        for ($x = 2; $x <= 16; $x++) {
            WTDTXT($rowa[$x]);
        }
        W_TR();
    }
    
    W_TBODY();
    W_TABLE();
    W_DIV("simpletablediv_GRLLeagueTableA_".$periodid."_".$leagueid);
    WCLEARFLOAT();
    
    return($GLOBALS{'pluginhtmla'});
}



function Plugin_GRLLeagueTableB_Publish ($webpage_name,$parmvala) {
    // [GRLLeagueTableB:League=West;]
    $grlleague_id = $parmvala[0];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLLeagueTableB('.$grlleague_id.') on "'.$webpage_name.'" page has been re-published',"green");
    // <!-- PLUGIN [GRLLeagueTableB:League=West;] -->
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLLeagueTableB:League='.$grlleague_id.";",'/PLUGIN',GRLLeagueTableBHTMLAGen($parmvala));
}


function GRLLeagueTableBHTMLAGen($parma) {
    $leagueid = $parma[0];
    // XH1($leagueid);
    
    $GLOBALS{'pluginhtmla'} = Array();
    
    $leagueteama = Array();
    $teama = Get_Array('grlleaguetable',$GLOBALS{'currperiodid'},$leagueid);
    foreach ($teama as $teamid) {
        Get_Data('grlleaguetable',$GLOBALS{'currperiodid'},$leagueid,$teamid);
        $sortstring1 = substr("0000".$GLOBALS{'grlleaguetable_points'},-4);
        $sortstring2 = substr("0000".(string)(1000+$GLOBALS{'grlleaguetable_tgdiff'}),-4);
        $leagueteamelement = $sortstring1."|".$sortstring2."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_grlteamname'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_played'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tw'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_td'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tl'}."|";
        // $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tgf'}."|";
        // $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tga'}."|";
        // $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_tgdiff'}."|";
        $leagueteamelement = $leagueteamelement.$GLOBALS{'grlleaguetable_points'};
        array_push($leagueteama,$leagueteamelement);
    }
    rsort ($leagueteama);
    
    // WH3($leagueid." - ".$periodid);
    
    WDIV("simpletablediv_GRLLeagueTableB_".$periodid."_".$leagueid,"container");
    WTABLECOMPACTJQDTID("simpletabletable_GRLLeagueTableB_".$periodid."_".$leagueid);
    WTHEAD();
    WTRJQDT();
    WTDTXT('');
    WTDTXT('p');
    WTDTXT('w');
    WTDTXT('d');
    WTDTXT('l');
    // WTDTXT('gf');
    // WTDTXT('ga');
    // WTDTXT('gdiff');
    WTDTXT('points');
    W_TR();
    W_THEAD();
    WTBODY();
    
    $li = 0;
    foreach ($leagueteama as $leagueteamelement) {
        // XPTXT($leagueteamelement);
        $rowa = explode('|',$leagueteamelement);
        WTRJQDT();
        $li++;
        for ($x = 2; $x <= 7; $x++) {
            WTDTXT($rowa[$x]);
        }
        W_TR();
    }
    
    W_TBODY();
    W_TABLE();
    W_DIV("simpletablediv_GRLLeagueTableB_".$periodid."_".$leagueid);
    WCLEARFLOAT();
    
    return($GLOBALS{'pluginhtmla'});
}

function Plugin_GRLResults_Publish ($webpage_name,$parmvala) {
    // [GRLResults:League=West;]
    $grlleague_id = $parmvala[0];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLResults('.$grlleague_id.') on "'.$webpage_name.'" page has been re-published',"green");
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLResults:League='.$grlleague_id.";",'/PLUGIN',GRLResultsHTMLAGen($parmvala));
}

function GRLResultsHTMLAGen($parma) {
    $leagueid = "L-".$parma[0];
    $GLOBALS{'pluginhtmla'} = Array();
    $monthsa = Array();
    $monthsa[1] = 'January';
    $monthsa[2] = 'February';
    $monthsa[3] = 'March';
    $monthsa[4] = 'April';
    $monthsa[5] = 'May';
    $monthsa[6] = 'June';
    $monthsa[7] = 'July';
    $monthsa[8] = 'August';
    $monthsa[9] = 'September';
    $monthsa[10] = 'October';
    $monthsa[11] = 'November';
    $monthsa[12] = 'December';
    $mthsa = Array();
    $mthsa[1] = 'Jan';
    $mthsa[2] = 'Feb';
    $mthsa[3] = 'Mar';
    $mthsa[4] = 'Apr';
    $mthsa[5] = 'May';
    $mthsa[6] = 'Jun';
    $mthsa[7] = 'Jul';
    $mthsa[8] = 'Aug';
    $mthsa[9] = 'Sep';
    $mthsa[10] = 'Oct';
    $mthsa[11] = 'Nov';
    $mthsa[12] = 'Dec';
    
    $GLOBALS{'pluginhtmla'} = Array();
    $leaguematcha = Array();
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},$leagueid);
    Get_Array('grlplayer');
    foreach ($matcha as $match_id){
        $hgoallist = "";
        $agoallist = "";
        $number = "";
        // XH3($match_id);
        
        Get_Data('grlmatch',$GLOBALS{'currperiodid'},$leagueid,$match_id);
        //XH3($GLOBALS{'grlmatch_hometeamname'});
        $matchdate = $GLOBALS{'grlmatch_date'};
        $matchdatea = explode("-",$matchdate);
        $monthnumbera = str_split($matchdatea[1]);
        if ($monthnumbera[0] == "0"){
            $number = $monthnumbera[1];
        }
        else{
            $number = $matchdatea[1];
        }
        $matchmonth = $monthsa[$number];
        $leaguematcha[$matchmonth][$match_id] = Array();

        //XH3($number." -- ".$monthsa[$number]);
        $matchtime = $GLOBALS{'grlmatch_time'};
        $matchscore = $GLOBALS{'grlmatch_homegfull'}." - ".$GLOBALS{'grlmatch_awaygfull'};
        if ($GLOBALS{'grlmatch_hometeamstatslist'} != null){
            $hstatslista = explode("|",$GLOBALS{'grlmatch_hometeamstatslist'});
            foreach ($hstatslista as $hevent){
                $goaltime = "";
                $goalstatus = "";
                $playername = "";
                $heventa = explode(",",$hevent);
                $playerid = $heventa[0];
                Get_Data('grlplayer',$playerid);
                $playername = $GLOBALS{'grlplayer_fname'}." ".$GLOBALS{'grlplayer_sname'};
                if ($heventa[1] == "G"){
                    $goaltime = $heventa[2];
                    if (array_key_exists(3,$heventa)){
                        $goalstatus = " ".$heventa[3];
                    }
                    if ($hgoallist == ""){
                        $hgoallist = $playername." ".$goaltime."'".$goalstatus;
                    }
                    else{$hgoallist = $playername." ".$goaltime."' ".$goalstatus."<br>".$hgoallist;}
                }
            }
            //XH3($hgoallist);
        }
        if ($GLOBALS{'grlmatch_awayteamstatslist'} != null){
            $astatslista = explode("|",$GLOBALS{'grlmatch_awayteamstatslist'});
            foreach ($astatslista as $aevent){
                $goaltime = "";
                $goalstatus = "";
                $playername = "";
                $aeventa = explode(",",$aevent);
                $playerid = $aeventa[0];
                Get_Data('grlplayer',$playerid);
                $playername = $GLOBALS{'grlplayer_fname'}." ".$GLOBALS{'grlplayer_sname'};
                if ($aeventa[1] == "G"){
                    $goaltime = $aeventa[2];
                    if (array_key_exists(3,$aeventa)){
                        $goalstatus = " ".$aeventa[3];
                    }
                    if ($agoallist == ""){
                        $agoallist = $playername." ".$goaltime."'".$goalstatus;
                    }
                    else{$agoallist = $playername." ".$goaltime."' ".$goalstatus."<br>".$agoallist;}
                }
            }
            //XH3($hgoallist);
        }
        $leaguematcha[$matchmonth][$match_id][0] = $GLOBALS{'grlmatch_date'};
        $leaguematcha[$matchmonth][$match_id][1] = $matchtime;
        $leaguematcha[$matchmonth][$match_id][2] = $GLOBALS{'grlmatch_hometeamname'};
        $leaguematcha[$matchmonth][$match_id][3] = $matchscore;
        $leaguematcha[$matchmonth][$match_id][4] = $GLOBALS{'grlmatch_awayteamname'};
        $leaguematcha[$matchmonth][$match_id][5] = $hgoallist;;
        $leaguematcha[$matchmonth][$match_id][6] = $agoallist;
        $leaguematcha[$matchmonth][$match_id][7] = $GLOBALS{'grlmatch_attendance'};
        
    }
    
    $currentmonth = "February";
    
    WTABDIV("TableTabs");
    WTABHEADERCONTAINER();
    $mi = 0;
    foreach ($monthsa as $month){
        $mi++;
        if ($month == $currentmonth) { WTABHEADERITEMACTIVE($month,$mthsa[$mi]); } else { WTABHEADERITEM($month,$mthsa[$mi]); }
    }
    W_TABHEADERCONTAINER();
    W_TABDIV();
    
    WTABCONTENTCONTAINER();
    foreach ($monthsa as $month){
        if ($month == $currentmonth) { WTABCONTENTITEMACTIVE($month); } else { WTABCONTENTITEM($month); }
        // WH3($leagueid.": ".$month);
        WDIV("simpletablediv_GRLResultsHTMLA_".$leagueid."_".$month,"container");
        WTABLEJQDTID("simpletabletable_GRLResultsHTMLA_".$leagueid."_".$month);
        WTHEAD();
        WTRJQDT();
        WTDTXT('Match Time');
        WTDTXT('Home');
        WTDTXT('Score');
        WTDTXT('Away');
        WTDTXT('Match Att.');
        W_TR();
        W_THEAD();
        WTBODY();
        
        $matchdatetest = "";
        $counter = "0";
        if (empty($leaguematcha[$month])) {} else {
            foreach ($leaguematcha[$month] as $key => $varray) {
                if (($matchdatetest == $leaguematcha[$month][$key][0])){
                    WTRJQDT();
                    WTXT('<td style= "vertical-align: top;"><font color="grey">'.$leaguematcha[$month][$key][1].'</font>');
                    WTXT('<td style= "vertical-align: top;"><font size="3" color="darkblue">'."<b>".$leaguematcha[$month][$key][2]."</b></font><br><font color='grey'>".$leaguematcha[$month][$key][5].'</font>');
                    WTXT('<td style= "vertical-align: top;"><b>'.$leaguematcha[$month][$key][3].'</b>');
                    WTXT('<td style= "vertical-align: top;"><font size="3" color="darkblue">'."<b>".$leaguematcha[$month][$key][4]."</b></font><br><font color='grey'>".$leaguematcha[$month][$key][6].'</font>');
                    WTXT('<td style= "vertical-align: top;"><font color="grey">'."Att.".$leaguematcha[$month][$key][7].'</font>');
                    W_TR();
                    $counter++;
                }
                else {
                    $mydate = strtotime($leaguematcha[$month][$key][0]);
                    $newdate = date('F jS Y', $mydate);
                    WTRJQDT();
                    WTDBACKCOLOR('black');WTDBACKCOLOR('black');WTDTXTBACKTXTCOLOR($newdate,'black','white');WTDBACKCOLOR('black');WTDBACKCOLOR('black');
                    W_TR();
                    WTRJQDT();
                    WTXT('<td style= "vertical-align: top;"><font color="grey">'.$leaguematcha[$month][$key][1].'</font>');
                    WTXT('<td style= "vertical-align: top;"><font size="3" color="darkblue">'."<b>".$leaguematcha[$month][$key][2]."</b></font><br><font color='grey'>".$leaguematcha[$month][$key][5].'</font>');
                    WTXT('<td style= "vertical-align: top;"><b>'.$leaguematcha[$month][$key][3].'</b>');
                    WTXT('<td style= "vertical-align: top;"><font size="3" color="darkblue">'."<b>".$leaguematcha[$month][$key][4]."</b></font><br><font color='grey'>".$leaguematcha[$month][$key][6].'</font>');
                    WTXT('<td style= "vertical-align: top;"><font color="grey">'."Att.".$leaguematcha[$month][$key][7].'</font>');
                    W_TR();
                    $matchdatetest = $leaguematcha[$month][$key][0];
                    $counter++;
                }
            }
        }
        W_TBODY();
        W_TABLE();
        W_DIV("simpletablediv_GRLResultsHTMLA_".$leagueid."_".$month);
        WCLEARFLOAT();
        W_TABCONTENTITEM();
        
    }
    W_TABCONTENTCONTAINER();
    
    return($GLOBALS{'pluginhtmla'});
    
}


function Plugin_GRLResultsGrid_Publish ($webpage_name,$parmvala) {
    // [GRLResultsGrid:League=West;]
    $grlleague_id = $parmvala[0];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLResultsGrid('.$grlleague_id.') on "'.$webpage_name.'" page has been re-published',"green");
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLResultsGrid:League='.$grlleague_id.";",'/PLUGIN',GRLResultsGridHTMLAGen($parmvala));
}


function GRLResultsGridHTMLAGen($parma) {
    $leagueid = "L-".$parma[0];
    $GLOBALS{'pluginhtmla'} = Array();
    $leaguematcha = Array();
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},$leagueid);
    $teama = Array();
    foreach ($matcha as $match_id){
        Get_Data('grlmatch',$GLOBALS{'currperiodid'},$leagueid,$match_id);
        $matchida = explode("-",$match_id);
        $matchteams = $matchida[1]."-".$matchida[2];
        if(!in_array($matchida[1], $teama, true)){
            array_push($teama, $matchida[1]);
        }
        $matchscore = $GLOBALS{'grlmatch_homegfull'}." - ".$GLOBALS{'grlmatch_awaygfull'};
        $leaguematcha[$matchteams][0] = $matchscore;
    }
    //print_r($teama);
    WDIV("simpletablediv_GRLResultsHTMLA_".$leagueid."_".$month,"container");
    WTABLECOMPACTJQDTID("simpletabletable_GRLResultsHTMLA_".$leagueid."_".$month);
    WTHEAD();
    /*
    WTXT('<style>
    table, th, td {
        border: 3px solid grey;
        border-collapse: collapse;
    }
    td {
        text-align: center;
    }
    </style>');
    */
    WTRJQDT();
    WTDTXTBACKTXTCOLOR("",'darkblue','white');
    foreach ($teama as $team){
        $teamid = substr($team,0,3);
        WTDTXTBACKTXTCOLOR($teamid,'darkblue','white');
    }
    W_THEAD();
    WTBODY();
    
    WTRJQDT();
    
    foreach ($teama as $team){
        $teamid = substr($team,0,3);
        WTRJQDT();
        WTDTXTBACKTXTCOLOR($teamid,'darkblue','white');
        foreach ($teama as $team2){
            $teamkey = $team."-".$team2;
            if ($team != $team2){
                WTDTXT($leaguematcha[$teamkey][0]);
            }
            else{WTDBACKCOLOR('lightgrey');}
        }
        W_TR();
    }

    W_TBODY();
    W_TABLE();
    W_DIV("simpletablediv_GRLResultsHTMLA_".$leagueid."_".$month);
    WCLEARFLOAT();
    
    return($GLOBALS{'pluginhtmla'});
}

function Plugin_GRLAttendance_Publish ($webpage_name,$parmvala) {
    // [GRLAttendance:League=West;]
    $grlleague_id = $parmvala[0];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLAttendance('.$grlleague_id.') on "'.$webpage_name.'" page has been re-published',"green");
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLAttendance:League='.$grlleague_id.";",'/PLUGIN',GRLAttendanceHTMLAGen($parmvala));
}


function GRLAttendanceHTMLAGen($parma) {
    $leagueid = "L-".$parma[0];
    $GLOBALS{'pluginhtmla'} = Array();
    $leaguestatsa = Array();
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},$leagueid);
    $teama = Array();
    foreach ($matcha as $match_id){
        Get_Data('grlmatch',$GLOBALS{'currperiodid'},$leagueid,$match_id);
        $ignorematch = "0";
        if ((strlen(strstr($GLOBALS{'grlmatch_score'},"P")) > 0)||(strlen(strstr($GLOBALS{'grlmatch_score'},"A")) > 0)) { $ignorematch = "1"; }
        if (strlen(strstr($GLOBALS{'grlmatch_score'},"-")) > 0) { } else { $ignorematch = "1"; }
        if ($ignorematch == "0") {
            $matchida = explode("-",$match_id);
            $thisteam = $matchida[1];
            if (isset($leaguestatsa[$thisteam]) == "TRUE"){
                
            }
            else{$leaguestatsa[$thisteam] = Array();}
            
            $attendance = floatval($GLOBALS{'grlmatch_attendance'});
            //XH3($attendance);
            if(!in_array($thisteam, $teama, true)){
                array_push($teama, $thisteam);
            }
            array_push($leaguestatsa[$thisteam],$attendance);            
        }
    }
    //print_r($leaguestatsa["Tiverton"]);
    foreach ($teama as $team){
        $teamstatsa[$team] = Array();
        $matches = sizeof($leaguestatsa[$team]);
        $maxatt = max($leaguestatsa[$team]);
        $minatt = min($leaguestatsa[$team]);
        $totalatt = array_sum($leaguestatsa[$team]);
        $averageatt = round($totalatt/$matches);
        $teamstatsa[$team] = Array($matches,$maxatt,$minatt,$totalatt,$averageatt);
    }
    //print_r($teamstatsa);
    WDIV("simpletablediv_GRLAttendanceHTMLA_".$leagueid."_".$month,"container");
    WTABLEJQDTID("simpletabletable_GRLAttendanceHTMLA_".$leagueid."_".$month);
    WTHEAD();
    WTRJQDT();
    WTDTXTBACKTXTCOLOR("Team",'darkblue','white');
    WTDTXTBACKTXTCOLOR("Matches",'darkblue','white');
    WTDTXTBACKTXTCOLOR("Highest",'darkblue','white');
    WTDTXTBACKTXTCOLOR("Lowest",'darkblue','white');
    WTDTXTBACKTXTCOLOR("Total",'darkblue','white');
    WTDTXTBACKTXTCOLOR("Average",'darkblue','white');
    W_THEAD();
    WTBODY();

    foreach ($teama as $team){
        WTRJQDT();
        WTDTXT($team);
        WTDTXT($teamstatsa[$team][0]);
        WTDTXT($teamstatsa[$team][1]);
        WTDTXT($teamstatsa[$team][2]);
        WTDTXT($teamstatsa[$team][3]);
        WTDTXT($teamstatsa[$team][4]);
        W_TR();
    }
    
    W_TBODY();
    W_TABLE();
    W_DIV("simpletablediv_GRLAttendanceHTMLA_".$leagueid."_".$month);
    WCLEARFLOAT();
    
    return($GLOBALS{'pluginhtmla'});
}

function Plugin_GRLFormTable_Publish ($webpage_name,$parmvala) {
    // [GRLFormTable:League=West;]
    $grlleague_id = $parmvala[0];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLFormTable('.$grlleague_id.') on "'.$webpage_name.'" page has been re-published',"green");
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLFormTable:League='.$grlleague_id.";",'/PLUGIN',GRLFormTableHTMLAGen($parmvala));
}


function GRLFormTableHTMLAGen($parma) {
    $leagueid = "L-".$parma[0];
    $btnclassa = Array();
    $btnclassa["W"] = "success";
    $btnclassa["L"] = "danger";
    $btnclassa["D"] = "basic";
    $GLOBALS{'pluginhtmla'} = Array();
    $leaguematcha = Array();
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},$leagueid);
    $teama = Array();
    foreach ($matcha as $match_id){
        $hgamestatus = "";
        $agamestatus = "";
        Get_Data('grlmatch',$GLOBALS{'currperiodid'},$leagueid,$match_id);
        $ignorematch = "0";
        if ((strlen(strstr($GLOBALS{'grlmatch_score'},"P")) > 0)||(strlen(strstr($GLOBALS{'grlmatch_score'},"A")) > 0)) { $ignorematch = "1"; }
        if (strlen(strstr($GLOBALS{'grlmatch_score'},"-")) > 0) { } else { $ignorematch = "1"; }
        if ($ignorematch == "0") {
            $matchdate = $GLOBALS{'grlmatch_date'};
            $hteam = $GLOBALS{'grlmatch_hometeamname'};
            $ateam = $GLOBALS{'grlmatch_awayteamname'};
            if (isset($leaguematcha[$hteam]) == TRUE){
                
            }
            else{$leaguematcha[$hteam] = Array();}
            if (isset($leaguematcha[$ateam]) == TRUE){
                
            }
            else{$leaguematcha[$ateam] = Array();}
            if(!in_array($hteam, $teama, true)){
                array_push($teama, $hteam);
            }
            $matchscore = $GLOBALS{'grlmatch_score'};
            $scorea = explode("-",$matchscore);
            
            $hscore = floatval($scorea[0]);
            $ascore = floatval($scorea[1]);
            
            if($hscore > $ascore){
                $hgamestatus = "W";
                $agamestatus = "L";
            }
            elseif($hscore < $ascore){
                $hgamestatus = "L";
                $agamestatus = "W";
            }
            else{
                $hgamestatus = "D";
                $agamestatus = "D";
            }
            array_push($leaguematcha[$hteam], $hgamestatus);
            array_push($leaguematcha[$ateam], $agamestatus);
        }
    }
    //print_r($leaguematcha);
    foreach ($teama as $team){
        $teamforma[$team] = array_slice($leaguematcha[$team],-6,6);
    }
    //print_r($teamforma);
    WDIV("simpletablediv_GRLFormTableHTMLA_".$leagueid,"container");
    WTABLECOMPACTJQDTID("simpletabletable_GRLFormTableHTMLA_".$leagueid);
    WTHEAD();
    /*
    WTXT('<style>
    table, th, td {
        border-collapse: collapse;
    }
    th{
        text-align: center;
    }
    td {
        text-align: left;
    }
    </style>');
    */
    WTRJQDT();
    WTDTXTBACKTXTCOLOR("Team",'darkblue','white');
    WTDTXTBACKTXTCOLOR("",'darkblue','white');
    WTDTXTBACKTXTCOLOR("",'darkblue','white');
    WTDTXTBACKTXTCOLOR("",'darkblue','white');
    WTDTXTBACKTXTCOLOR("",'darkblue','white');
    WTDTXTBACKTXTCOLOR("",'darkblue','white');
    WTDTXTBACKTXTCOLOR("",'darkblue','white');
    W_THEAD();
    WTBODY();
    foreach ($teamforma as $key => $varray){
        $btnid = "";
        $btnid = str_replace(" ","",$key);
        WTRJQDT();
        // WTDTXT('<font color="darkblue">'."<b>".$key.'</b></font>');
        WTDTXT($key);
        for ($i = 5;$i>=0;$i--){
            // WTDINBUTTONIDSPECIAL($btnid.$i,$btnclassa[$teamforma[$key][$i]],'<font size="75%">'.$teamforma[$key][$i].'</font>');
            WTDINBUTTONIDSPECIAL($btnid.$i,$btnclassa[$teamforma[$key][$i]],$teamforma[$key][$i]);
        }
        W_TR();
    }
    W_TBODY();
    W_TABLE();
    W_DIV("simpletablediv_GRLFormTableHTMLA_".$leagueid);
    WCLEARFLOAT();
    
    return($GLOBALS{'pluginhtmla'});
}

function Plugin_GRLGoalsTable_Publish ($webpage_name,$parmvala) {
    // [GRLGoalsTable:League=West;]
    $grlleague_id = $parmvala[0];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLGoalsTable('.$grlleague_id.') on "'.$webpage_name.'" page has been re-published',"green");
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLGoalsTable:League='.$grlleague_id.";",'/PLUGIN',GRLGoalsTableHTMLAGen($parmvala));
}

function GRLGoalsTableHTMLAGen($parma) {
    $leagueid = "L-".$parma[0];
    $GLOBALS{'pluginhtmla'} = Array();
    $leaguematcha = Array();
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},$leagueid);
    $playera = Get_Array('grlplayer');
    $teama = Array();
    foreach ($matcha as $match_id){
        $hgamestatus = "";
        $agamestatus = "";
        Get_Data('grlmatch',$GLOBALS{'currperiodid'},$leagueid,$match_id);
        $ignorematch = "0";
        if ((strlen(strstr($GLOBALS{'grlmatch_score'},"P")) > 0)||(strlen(strstr($GLOBALS{'grlmatch_score'},"A")) > 0)) { $ignorematch = "1"; }
        if (strlen(strstr($GLOBALS{'grlmatch_score'},"-")) > 0) { } else { $ignorematch = "1"; }
        if ($GLOBALS{'grlmatch_score'} != "0-0"){} else{$ignorematch = "1";};
        if ($ignorematch == "0") {
            if ($GLOBALS{'grlmatch_homegfull'} != 0){
                $matchida = explode("-",$match_id);
                $hteam = $matchida[1];
                $ateam = $matchida[2];
                $hstatslist = $GLOBALS{'grlmatch_hometeamstatslist'};
                $hstatslista = explode("|",$hstatslist);
                foreach($hstatslista as $hstatslist){
                    $hstatslistbitsa = explode(",",$hstatslist);
                    $hscorerid = $hstatslistbitsa[0];
                    Get_Data('grlplayer',$hscorerid);
                    $hscorername = $GLOBALS{'grlplayer_fname'}." ".$GLOBALS{'grlplayer_sname'};
                    if(isset($leaguematcha[$hscorerid]["name"])){
                        
                    }
                    else{$leaguematcha[$hscorerid]["name"] = Array();}
                    $leaguematcha[$hscorerid]["name"] = $hscorername;
                    if(isset($leaguematcha[$hscorerid]["team"])){
                        
                    }
                    else{$leaguematcha[$hscorerid]["team"] = Array();
                    }
                    if(isset($leaguematcha[$hscorerid]["goals"])){
                        
                    }
                    else{$leaguematcha[$hscorerid]["goals"] = Array();}
                    if(isset($leaguematcha[$hscorerid]["pen"])){
                        
                    }
                    else{
                        $leaguematcha[$hscorerid]["pen"] = Array();
                        $leaguematcha[$hscorerid]["pen"][0] = 0;
                    }
                    if(isset($leaguematcha[$hscorerid]["total"])){
                        
                    }
                    else{$leaguematcha[$hscorerid]["total"] = Array();}
                    $heventtype = $hstatslistbitsa[1];
                    if ($heventtype == "G"){
                        $hgoaltime = $hstatslistbitsa[2];
                        $hgoalstatus = $hstatslistbitsa[3]; //Null, Pen, or OG.
                        
                        $leaguematcha[$hscorerid]["team"] = $GLOBALS{'grlmatch_hometeamname'};
                        if($hgoalstatus == null){
                            $leaguematcha[$hscorerid]["goals"][0]++;
                        }
                        if($hgoalstatus == "Pen"){
                            $leaguematcha[$hscorerid]["pen"][0]++;
                        }
                        $leaguematcha[$hscorerid]["total"][0]++;
                    }
                }
            }
            if ($GLOBALS{'grlmatch_awaygfull'} != 0){
                foreach($hstatslista as $hstatslist){
                    $astatslist = $GLOBALS{'grlmatch_awayteamstatslist'};
                    $astatslista = explode("|",$astatslist);
                    $astatslistbitsa = explode(",",$astatslist);
                    $ascorerid = $astatslistbitsa[0];
                    Get_Data('grlplayer',$ascorerid);
                    $ascorername = $GLOBALS{'grlplayer_fname'}." ".$GLOBALS{'grlplayer_sname'};
                    if(isset($leaguematcha[$ascorerid]["name"])){
                        
                    }
                    else{$leaguematcha[$ascorerid]["name"] = Array();}
                    $leaguematcha[$ascorerid]["name"] = $ascorername;
                    if(isset($leaguematcha[$ascorerid]["team"])){
                        
                    }
                    else{$leaguematcha[$ascorerid]["team"] = Array();}
                    if(isset($leaguematcha[$ascorerid]["goals"])){
                        
                    }
                    else{$leaguematcha[$ascorerid]["goals"] = Array();}
                    if(isset($leaguematcha[$ascorerid]["pen"])){
                        
                    }
                    else{
                        $leaguematcha[$ascorerid]["pen"] = Array();
                        $leaguematcha[$ascorerid]["pen"][0] = 0;
                    }
                    if(isset($leaguematcha[$ascorerid]["total"])){
                        
                    }
                    else{$leaguematcha[$ascorerid]["total"] = Array();}
                    $aeventtype = $astatslistbitsa[1];
                    if ($aeventtype == "G"){
                        $agoaltime = $astatslistbitsa[2];
                        $agoalstatus = $aatatslistbitsa[3]; //Null, Pen, or OG.
                        
                        $leaguematcha[$ascorerid]["team"] = $GLOBALS{'grlmatch_awayteamname'};;
                        
                        if($agoalstatus == "Pen"){
                            $leaguematcha[$ascorerid]["pen"][0]++;
                            $leaguematcha[$ascorerid]["total"][0]++;
                        }
                        else{
                            $leaguematcha[$ascorerid]["goals"][0]++;
                            $leaguematcha[$ascorerid]["total"][0]++;
                        }
                    }
                    
                }
            }
            
        }
    }
    
    //print_r($teamforma);
    WDIV("simpletablediv_GRLGoalsTableHTMLA_".$leagueid,"container");
    WTABLECOMPACTJQDTID("simpletabletable_GRLGoalsTableHTMLA_".$leagueid);
    WTHEAD();
    WTRJQDT();
    WTDTXTBACKTXTCOLOR("Name",'darkblue','white');
    WTDTXTBACKTXTCOLOR("Total",'darkblue','white');
    WTDTXTBACKTXTCOLOR("Team",'darkblue','white');
    WTDTXTBACKTXTCOLOR("Breakdown",'darkblue','white');
    W_THEAD();
    WTBODY();
    foreach ($leaguematcha as $key => $varray){
        WTRJQDT();
        WTDTXT('<font color="darkblue">'."<b>".$leaguematcha[$key]["name"].'</b></font>');
        WTDTXT($leaguematcha[$key]["total"][0]);
        WTDTXT('<b>'.$leaguematcha[$key]["team"].'</b>');
        if ($leaguematcha[$key]["pen"][0] != "0"){
            WTDTXT("Goal (".$leaguematcha[$key]["goals"][0].") Penalty(".$leaguematcha[$key]["pen"][0].")");
        }
        else{WTDTXT("Goal (".$leaguematcha[$key]["goals"][0].")");}
        W_TR();
    }
    
    W_TBODY();
    W_TABLE();
    W_DIV("simpletablediv_GRLGoalsTableHTMLA_".$leagueid);
    WCLEARFLOAT();
    
    return($GLOBALS{'pluginhtmla'});
}




function Plugin_GRLFTLeagueTable_Publish ($webpage_name,$parmvala) {
    // [GRLFTLeagueTable:LRCode=195936733;DivisionCode=867436999;]
    $lrcode = $parmvala[0];
    $divisioncode = $parmvala[1];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLFTLeagueTable('.$lrcode."/".$divisioncode.') on "'.$webpage_name.'" page has been re-published',"green");
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLFTLeagueTable:LRCode='.$lrcode.';DivisionCode='.$divisioncode.';','/PLUGIN',GRLFTLeagueTableHTMLAGen($parmvala));
}

function GRLFTLeagueTableHTMLAGen($parma) {
    $lrcode = $parma[0];
    $divisioncode = $parma[1]; 
    
    $lrcode = '48767171';
    $divisioncode = '867436999'; 
    
    $GLOBALS{'pluginhtmla'} = Array();   
    
    WTXT('<div id="lrep48767171" style="width: 100%;">');
    WTXT('Data loading....<a href="http://fulltime-league.thefa.com/Index.do?divisionseason='.$divisioncode.'">click here for Premier</a>');
    WTXT('<br/><br/><a href="http://www.thefa.com/FULL-TIME">FULL-TIME Home</a></div>'); 
    WTXT('<script language="javascript" type="text/javascript"> var lrcode = '."'".$lrcode."'".' </script>'); 
    WTXT('<script language="Javascript" type="text/javascript" src="https://fulltime-league.thefa.com/client/api/cs1.js?v2"></script>');

    return($GLOBALS{'pluginhtmla'});
}

function Plugin_GRLFTResults_Publish ($webpage_name,$parmvala) {
    // [GRLFTLeagueTable:LRCode=195936733;DivisionCode=867436999;]
    $lrcode = $parmvala[0];
    $divisioncode = $parmvala[1];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLFTResults('.$lrcode."/".$divisioncode.') on "'.$webpage_name.'" page has been re-published',"green");
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLFTResults:LRCode='.$lrcode.';DivisionCode='.$divisioncode.';','/PLUGIN',GRLFTResultsHTMLAGen($parmvala));
}

function GRLFTResultsHTMLAGen($parma) {
    $lrcode = $parma[0];
    $divisioncode = $parma[1];
    
    $lrcode = '665473333';
    $divisioncode = '867436999'; 
    
    $GLOBALS{'pluginhtmla'} = Array();
    WTXT('<div id="lrep665473333" style="width: 100%;">');
    WTXT('Data loading....<a href="http://fulltime-league.thefa.com/Index.do?divisionseason='.$divisioncode.'">click here for Premier</a>');
    WTXT('<br/><br/><a href="http://www.thefa.com/FULL-TIME">FULL-TIME Home</a></div>'); 
    WTXT('<script language="javascript" type="text/javascript"> var lrcode = '."'".$lrcode."'".' </script>');
    WTXT('<script language="Javascript" type="text/javascript" src="https://fulltime-league.thefa.com/client/api/cs1.js?v2"></script>');
    return($GLOBALS{'pluginhtmla'});
    
    
}

function Plugin_GRLFTFixtures_Publish ($webpage_name,$parmvala) {
    // [GRLFTFixtures:LRCode=195936733;DivisionCode=867436999;]
    $lrcode = $parmvala[0];
    $divisioncode = $parmvala[1];
    Get_Data("webpage",$webpage_name);
    XPTXTCOLOR('GRLFTFixtures('.$lrcode."/".$divisioncode.') on "'.$webpage_name.'" page has been re-published',"green");
    Webpage_Insert($GLOBALS{'webpage_address'},'PLUGIN [GRLFTFixtures:LRCode='.$lrcode.';DivisionCode='.$divisioncode.';','/PLUGIN',GRLFTFixturesHTMLAGen($parmvala));
}

function GRLFTFixturesHTMLAGen($parma) {
    $lrcode = $parma[0];
    $divisioncode = $parma[1];
    
    $lrcode = '862415960';
    $divisioncode = '52885843'; 
    
    $GLOBALS{'pluginhtmla'} = Array();
    WTXT('<div id="lrep862415960" style="width: 100%;">');
    WTXT('Data loading....<a href="http://fulltime-league.thefa.com/Index.do?divisionseason='.$divisioncode.'">click here for Premier Division</a>');
    WTXT('<br/><br/><a href="http://www.thefa.com/FULL-TIME">FULL-TIME Home</a></div>'); 
    WTXT('<script language="javascript" type="text/javascript"> var lrcode = '."'".$lrcode."'".' </script>');
    WTXT('<script language="Javascript" type="text/javascript" src="https://fulltime-league.thefa.com/client/api/cs1.js?v2"></script>');
    return($GLOBALS{'pluginhtmla'});
}

function GRLLeagueScraperHTMLAGen ($parma) {
    $leagueid = "L-".$parma[0];
    $html = file_get_contents('https://fulltime.thefa.com/ff/DivisionDetails?divisionid=766947256&leagueid=3355283&seasonid=278099192');
    $htmla = explode("<",$html);
    foreach ($htmla as $htmlline){
        print "&lt;".$htmlline."<br>\n";
    }
}
