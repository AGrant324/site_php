<?php # webpageroutines.inc

function Webpage_TEMPLATEUPDATELIST_Output () {
	XH2("Template Editor");
	XBR();
	XFORMUPLOAD("webpagetemplateupdateout.php","newtemplate");
	XINSTDHID();
	XINHID("template_name","new");
	XINHID("template_status","Final");
	XINSUBMIT("Create New Template");
	X_FORM();
	XBR();	
	XTABLE();
	XTR();
	XTDHTXT("Status");
	XTDHTXT("Name");
        XTDHTXT("Dashboard Style");
	XTDHTXT("NavTopMenu");
	XTDHTXT("Carousel Name");
	XTDHTXT("FullWidth");
	XTDHTXT("Sidebar");
	XTDHTXT("Sidebar Width");
	XTDHTXT("Sidebar Name");
	XTDHTXT("Footer Menus");	
	XTDHTXT("Edit");	
	XTDHTXT("Publish");
	XTDHTXT("Delete");	
	X_TR();
	$itemfound = "0";
	$template_namea = Get_Array('template',"Final");
	foreach ($template_namea as $template_name) {
		Get_Data("template","Final",$template_name);
		$itemfound = "1";
		XTR();
		XTDTXT($template_name);
		XTDTXT("Final");
                XTDTXT($GLOBALS{'template_dashboardstyle'});
		XTDTXT($GLOBALS{'template_navtopmenuenabled'});
		XTDTXT($GLOBALS{'template_headercarouselname'});
		XTDTXT($GLOBALS{'template_fullwidthenabled'});
		XTDTXT($GLOBALS{'template_sidebar'});
		XTDTXT($GLOBALS{'template_sidebarwidth'});
		XTDTXT($GLOBALS{'template_sidebarname'});
		XTDTXT($GLOBALS{'template_footermenuquantity'});		
		$link = YPGMLINK("webpagetemplateupdateout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("template_status","Final").YPGMPARM("template_name",$template_name);
		XTDLINKTXT($link,"edit");		
		$link = YPGMLINK("webpagetemplatepublish.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("template_status","Final").YPGMPARM("template_name",$template_name);
		XTDLINKTXT($link,"publish");
		$link = YPGMLINK("webpagetemplatedeleteconfirm.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("template_status","Final").YPGMPARM("template_name",$template_name);
		XTDLINKTXT($link,"delete");
		X_TR();
	}
	X_TABLE();
	if ($itemfound == "0") {
		XH5("No finalised templates currently exist");
	}
	XBR();
	
	/*
	XH2("Update an existing Draft Template");
	XTABLE();
	XTR();
	XTDHTXT("Status");
	XTDHTXT("Name");
	XTDHTXT("NavTopMenu");
	XTDHTXT("Carousel Name");
	XTDHTXT("FullWidth");
	XTDHTXT("Sidebar");
	XTDHTXT("Sidebar Width");
	XTDHTXT("Footer Menus");	
	XTDHTXT("Edit");
	XTDHTXT("Test");
	XTDHTXT("Finalise");	
	XTDHTXT("Delete");
	X_TR();
	$itemfound = "0";
	$template_namea = Get_Array('template',"Draft");
	foreach ($template_namea as $template_name) {
		Get_Data("template","Draft",$template_name);
		$itemfound = "1";
		XTR();
		XTDTXT($template_name);
		XTDTXT("Draft");
		XTDTXT($GLOBALS{'template_navtopmenuenabled'});
		XTDTXT($GLOBALS{'template_headercarouselname'});
		XTDTXT($GLOBALS{'template_fullwidthenabled'});	
		XTDTXT($GLOBALS{'template_sidebar'});
		XTDTXT($GLOBALS{'template_sidebarwidth'});
		XTDTXT($GLOBALS{'template_footermenuquantity'});	
		$link = YPGMLINK("webpagetemplateupdateout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("template_status","Draft").YPGMPARM("template_name",$template_name);
		XTDLINKTXT($link,"edit");
		$link = YPGMLINK("webpagetemplatetest.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("template_status","Draft").YPGMPARM("template_name",$template_name);
		XTDLINKTXT($link,"test");
		$link = YPGMLINK("webpagetemplatefinalise.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("template_name",$template_name);
		XTDLINKTXT($link,"finalise");
		$link = YPGMLINK("webpagetemplatedeleteconfirm.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("template_status","Draft").YPGMPARM("template_name",$template_name);
		XTDLINKTXT($link,"delete");
		X_TR();
	}
	X_TABLE();
	if ($itemfound == "0") {
		XH5("No draft templates currently exist");
	}
	*/	
}

function Webpage_TEMPLATEUPDATE_Output ( $template_status, $template_name) {
	XFORM("webpagetemplateupdatein.php","templatein");
	XINSTDHID();
	if ($template_name == "new") {
		Initialise_Data('template');
		XH2("Template Editor - New Template");
		XINHID("template_status","Final");
		XINTXT("template_name","","25","25");
	} else {
		Get_Data('template', $template_status, $template_name);
		XH2('Template Editor - "'.$template_name.' '.$template_status.'"');
		XINHID("template_status",$template_status);
		XINHID("template_name",$template_name);
	}
	XBR();XHR();XBR();
        XH3("Dashboard Style");
	XBR();XINCHECKBOXYESNO ("template_dashboardstyle",$GLOBALS{'template_dashboardstyle'},"Dashboard Style enabled");
	XH3("Navigation");
	XBR();XINCHECKBOXYESNO ("template_navtopmenuenabled",$GLOBALS{'template_navtopmenuenabled'},"NavTopMenu enabled");
	XH3("Header Carousel");
	XPTXT("Build Carousels using Carousel Tool");
	$xhash = Get_SelectArrays_Hash ("carousel","carousel_name","carousel_name","carousel_name","","" );
        $xhash[""] = "None";
	XBR();XINSELECTHASH($xhash,"template_headercarouselname",$GLOBALS{'template_headercarouselname'});
	XH3("Page Width");			
	XBR();XINCHECKBOXYESNO ("template_fullwidthenabled",$GLOBALS{'template_fullwidthenabled'},"Full Width enabled");
	XH3("Sidebar");
	XBR();XINSELECTHASH (List2Hash("None,Left,Right"),"template_sidebar",$GLOBALS{'template_sidebar'});
	XH3("Sidebar Width in Twelfths (if enabled)");
	XBR();XINSELECTHASH (List2Hash("0,1,2,3,4,5,6"),"template_sidebarwidth",$GLOBALS{'template_sidebarwidth'});
	XH3("Default Sidebar for this template (if enabled)");
	$xhash = Get_SelectArrays_Hash ("sidebar","sidebar_name","sidebar_name","sidebar_name","","" );
	XBR();XINSELECTHASH($xhash,"template_sidebarname",$GLOBALS{'template_sidebarname'});
	XH3("Footer Menus");	
	XBR();XINSELECTHASH(List2Hash("None,1,2,3,4"),"template_footermenuquantity",$GLOBALS{'template_footermenuquantity'});	
	XBR();XHR();XBR();
	XTDINCHECKBOXYESNO("publish","Yes","Rebuild and publish this template after update");
	XBR();XHR();XBR();
	XINSUBMIT("Update Template");
	X_FORM();
}



function Webpage_TEMPLATEDELETECONFIRM_Output ($template_status, $template_name) {
	XH3('Delete Template - "'.$template_status." - ".$template_name.'"');
	XPTXT("Are you sure you want to delete this template");
	XBR();
	XFORM("webpagetemplatedeleteaction.php","deletetemplate");
	XINSTDHID();
	XINHID("template_status",$template_status);	
	XINHID("template_name",$template_name);
	XINSUBMIT("Confirm Template Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Webpage_TEMPLATEUTILITY_Output() {
	$parm0 = "Finalised Templates|template[rootkey=Final]||template_name|template_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."template_name|Yes|Template Name|120|Yes|Template Name|KeyText,25,25^";
	$parm1 = $parm1."template_navtopmenuenabled|Yes|NavTopMenu|90|Yes|NavTopMenu|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."template_headercarouselenabled|Yes|Header Carousel|80|Yes|Header Carousel Enabled|InputSelectFromList,Yes+No^";	
	$parm1 = $parm1."template_headercarouselname||||Yes|Header Carousel Name|InputText,20,40^";
	$parm1 = $parm1."template_fullwidthenabled|Yes|FullWidth|90|Yes|FullWidth|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."template_footermenusenabled|Yes|Footer|90|Yes|Footer Enabled|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."template_footermenuquantity|Yes|Footer Menus|90|Yes|Footer Menus|InputSelectFromList,None+1+2+3+4^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Edit|80|No|Edit|UpdateButton^";
	$parm1 = $parm1."generic_programbutton|Yes|Publish|80|No|Publish|ProgramButton,webpagetemplatefinalpublish.php,template_name,template_name,newpopup,800,600^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|80|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Webpage_SIDEBARCOMPOSERLIST_Output () {
    XH2("Sidebar Composer.");
    XHR();
    XBR();
    XFORMUPLOAD("webpagesidebarcomposerout.php","newsidebar");
    XINSTDHID();
    XINHID("sidebar_name","new");
    XINSUBMIT("Create New Sidebar");
    X_FORM();
    XBR();
    XDIV("simpletablediv_SideBars","container");
    XTABLEJQDTID("simpletabletable_SideBars");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Name");
    XTDHTXT("Edit");
    XTDHTXT("Publish");
    XTDHTXT("Delete");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $sidebar_namea = Get_Array('sidebar');
    foreach ($sidebar_namea as $sidebar_name) {
        Get_Data("sidebar",$sidebar_name);
        $itemfound = "1";
        XTRJQDT();
        XTDTXT($sidebar_name);
        $link = YPGMLINK("webpagesidebarcomposerout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sidebar_name",$sidebar_name);
        XTDLINKTXT($link,"edit");
        $link = YPGMLINK("webpagesidebarpublish.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sidebar_name",$sidebar_name);
        XTDLINKTXT($link,"publish");
        $link = YPGMLINK("webpagesidebardeleteconfirm.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sidebar_name",$sidebar_name);
        XTDLINKTXT($link,"delete");
        X_TR();
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_SideBars");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No sidebars currently exist");
    }
    XBR();
} 

function Webpage_SIDEBARCOMPOSER_CSSJS () {
    $GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,tinymcesliminit,tinymceslimreturnfromupload,globalroutines,ioroutines,slimjquerymin,webpagecomposer,slimimagepopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "FormattedSection_Popups,FormattedPlugin_Popups,WebPageComposer_Popups";
} 

function Webpage_SIDEBARCOMPOSER_Output ( $sidebar_name) {
    XFORMUPLOAD("webpagesidebarcomposerin.php","sidebarcomposerin");
    XINSTDHID();
    XINHIDID("composermode","composermode","sidebar");
    if ($sidebar_name == "new") {
        Initialise_Data('sidebar');
        XH2("Sidebar Composer - New Sidebar");
        XINTXT("sidebar_name","","25","25");
    } else {
        Get_Data('sidebar', $sidebar_name);
        XH2('Sidebar Composer - "'.$sidebar_name.' '.$sidebar_status.'"');
        XINHID("sidebar_name",$sidebar_name);
    }
    
    XBR();
    XHRCLASS("underline");
    XTABLEINVISIBLE();
    XTR();XTD();XH2('Sidebar Content');X_TD();XTDTXTCOLOR("_______________","white");XTDMIDDLE();
    XINBUTTONIDSPECIAL ("composeraddsectionbutton","secondary","Add Section");
    XINBUTTONIDSPECIAL ("composerpreviewbutton","success","Preview without Markup");
    X_TD();X_TR();
    X_TABLE();
    
    XDIV("composerhtml","");
    if ( $GLOBALS{'sidebar_html'} == "" ) {
        print "<!-- Empty Sidebar -->";
        XBR();XPTXTCOLOR("&nbsp;&nbsp;Sidebar is Empty","Silver");XBR();
    } else {
        $htmla = Webpage_DBHTML2COMPOSER_Output($GLOBALS{'sidebar_html'});
        foreach ($htmla as $message) {
            print $message;
        }
    }
    X_DIV("composerhtml");
    
    XINHID("sidebar_html","");
    
    XBR();
    XHRCLASS("underline");
    XINCHECKBOXYESNO("publish","Yes","Publish this sidebar after update");
    XBR();XBR();
    XINBUTTONIDSPECIAL ("composersubmitbutton","primary","Update Sidebar");
    X_FORM();
}

function Webpage_SIDEBARPREVIEW_CSSJS () {
    $GLOBALS{'SITEJSOPTIONAL'} = "sidebarpreview";
} 

function Webpage_SIDEBARPREVIEW_Output($webpage_templatename,$sidebar_html) {
    $htmla = Webpage_DBHTML2PAGE_Output($sidebar_html,"No");
    XH3("Preview");
    XHRCLASS("underline");
    XBR();
    XDIV("previewcontainer","previewcontainer");\
    XDIV("previewmain","previewmain");
    XPTXT("Main page content");
    XIMGWIDTH("../site_assets/1200x300.png","100%");
    X_DIV("previewmain");   
    XDIV("previewsidebar","previewsidebar");
    XPTXT("Sidebar");
    foreach ($htmla as $message) {
        print $message;
    }
    X_DIV("previewsidebar");   
    X_DIV("previewcontainer");
    XCLEARFLOAT();
}

function Webpage_SIDEBARDELETECONFIRM_Output ($sidebar_name) {
    XH3('Delete Sidebar - "'.$sidebar_name.'"');
    XPTXT("Are you sure you want to delete this sidebar");
    XBR();
    XFORM("webpagesidebardeleteaction.php","deletesidebar");
    XINSTDHID();
    XINHID("sidebar_name",$sidebar_name);
    XINSUBMIT("Confirm Sidebar Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Webpage_SIDEBARPUBLISH_Output($sidebar_name) {
    // republish all webpages that contain this sidebar (or have templates that reference this sidebar).
    Get_Data("sidebar",$sidebar_name);
    XH4('Publication - "'.$sidebar_name);   
    $webpagea = Get_Array("webpage");
    foreach ($webpagea as $webpage_name) {
        Get_Data('webpage', $webpage_name);
        if ($GLOBALS{'webpage_templatename'} == "") {$GLOBALS{'webpage_templatename'} == "Default";}
        $selected = "0";
        if ( $GLOBALS{'webpage_sidebarname'} == $sidebar_name ) { $selected = "1"; }
        else {
            Check_Data('template', "Final", $GLOBALS{'webpage_templatename'});
            if ($GLOBALS{'IOWARNING'} == "0") {
                if ( $GLOBALS{'template_sidebarname'} == $sidebar_name ) { $selected = "1"; }
            }
        }
        if ($selected == "1") {
            Webpage_WEBPAGEPUBLISH_Output($webpage_name);
        }
    }
}

function Webpage_TEMPLATEELEMENTUPDATELIST_Output () {
	XH2("Template Element Editor");
	XBR();
	XH4("Create a new Template Element");
	XFORMUPLOAD("webpagetemplateelementupdateout.php","newtemplateelement");
	XINSTDHID();
	XINHID("templateelement_name","new");
	XINSUBMIT("Create New Template Element");
	X_FORM();
	XBR();	
	XHR();
	XBR();
	XH4("Update an existing Template Element");
	XTABLE();
	XTR();
	XTDHTXT("Name");
	XTDHTXT("Div");
	XTDHTXT("Edit");
	XTDHTXT("Publish");
	XTDHTXT("Delete");
	X_TR();
	$templateelement_namea = Get_Array('templateelement');
	foreach ($templateelement_namea as $templateelement_name) {
		Get_Data("templateelement",$templateelement_name);
		XTR();
		XTDTXT($templateelement_name);
		XTDTXT($GLOBALS{'templateelement_div'});
		$link = YPGMLINK("webpagetemplateelementupdateout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("templateelement_name",$templateelement_name);
		XTDLINKTXT($link,"edit");
		$link = YPGMLINK("webpagetemplateelementpublish.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("templateelement_name",$templateelement_name);
		XTDLINKTXT($link,"publish");
		$link = YPGMLINK("webpagetemplateelementdeleteconfirm.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("templateelement_name",$templateelement_name);
		XTDLINKTXT($link,"delete");
		X_TR();
	}
	X_TABLE();
	if ($itemfound == "0") {
		XH5("No finalised templates currently exist");
	}
}

function Webpage_TEMPLATEELEMENTUPDATE_CSSJS () {
	$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,tinymcesliminit,tinymceslimreturnfromupload,globalroutines,ioroutines,slimjquerymin,slimimagepopup,tinyslimimagepopup,tinyformattedsectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "FormattedSection_Popups";
}

function Webpage_TEMPLATEELEMENTUPDATE_Output ( $templateelement_name) {
	XFORM("webpagetemplateelementupdatein.php","templateelementin");
	XINSTDHID();
	XINHID("TinyMCEUploadTo","TemplateElement");
	XINHID("TinyMCEUploadId",$templateelement_name);
	if ($templateelement_name == "new") {
		Initialise_Data('templateelement');
		XH2("Template Element Editor - New Template Element");
		XINTXT("templateelement_name","","25","25");
	} else {
		Get_Data('templateelement', $templateelement_name);
		XH2('Template Element Editor - "'.$templateelement_name);
		XINHID("templateelement_name",$templateelement_name);
	}
	XH4('Template Element Positioning');
	XTABLE();
	$xhash = Array2Hash(Get_Array('template',"Final"));
	XTR();XTDTXT("Show on Template");XTDINCHECKBOXHASH ($xhash,"templateelement_templatelist",$GLOBALS{'templateelement_templatelist'});X_TR();
	$xhash = List2Hash("navtopmenu,headercarousel,abovecontent,belowcontent,footer,footer2,sitefooter");
	XTR();XTDTXT("Div");XTDINSELECTHASH ($xhash,"templateelement_div",$GLOBALS{'templateelement_div'});X_TR();
	$xhash = List2Hash("absolute,relative");
	XTR();XTDTXT("Position");XTDINSELECTHASH ($xhash,"templateelement_position",$GLOBALS{'templateelement_position'});X_TR();
	XTR();XTDTXT("Inset Top - eg 10% or 20px");XTDINTXT("templateelement_insettop",$GLOBALS{'templateelement_insettop'},"5","5");X_TR();	
	XTR();XTDTXT("Inset Left - eg 10% or 20px");XTDINTXT("templateelement_insetleft",$GLOBALS{'templateelement_insetleft'},"5","5");X_TR();	
	XTR();XTDTXT("Border Width - 0px");XTDINTXT("templateelement_borderwidth",$GLOBALS{'templateelement_borderwidth'},"5","5");X_TR();	
	XTR();XTDTXT("Border Color - eg #666666");XTDINTXT("templateelement_bordercolor",$GLOBALS{'templateelement_bordercolor'},"5","5");X_TR();	
	XTR();XTDTXT("Height - eg 100px");XTDINTXT("templateelement_height",$GLOBALS{'templateelement_height'},"5","5");X_TR();	
	XTR();XTDTXT("Width - eg 100px");XTDINTXT("templateelement_width",$GLOBALS{'templateelement_width'},"5","5");X_TR();	
	X_TABLE();
	XH4('Template Element Content');
	XINTEXTAREAMCE("templateelement_html",$GLOBALS{'templateelement_html'},"20","100");	
	XBR();XHR();XBR();
	XTDINCHECKBOXYESNO("publish","Yes","Rebuild and publish templates after update");
	XBR();XHR();XBR();
	XINSUBMIT("Update Template Element");
	X_FORM();
}

function Webpage_TEMPLATEELEMENTDELETECONFIRM_Output ($templateelement_name) {
	XH3('Delete Template Element - "'.$templateelement_name.'"');
	XPTXT("Are you sure you want to delete this template element");
	XBR();
	XFORM("webpagetemplateelementdeleteaction.php","deletetemplateelement");
	XINSTDHID();
	XINHID("templateelement_name",$templateelement_name);
	XINSUBMIT("Confirm Template Element Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Webpage_TEMPLATEELEMENTUTILITY_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,calendarpopup,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Webpage_TEMPLATEELEMENTUTILITY_Output() {
	$parm0 = "Template Elements|templateelement|template|templateelement_name|templateelement_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."templateelement_name|Yes|Element Name|120|Yes|Element Name|KeyText,25,25^";
	$parm1 = $parm1."templateelement_templatelist||||Yes|Inset Top|InputCheckboxFromTable,template,template_name,template_name,template_name^";	
	$parm1 = $parm1."templateelement_div|Yes|Div|100|Yes|Div|InputSelectFromList,navtopmenu+headercarousel+abovecontent+belowcontent+footer+footer2+sitefooter^";	
	$parm1 = $parm1."templateelement_position||||Yes|Position|InputSelectFromList,absolute+relative^";	
	$parm1 = $parm1."templateelement_insettop||||Yes|Inset Top|InputText,8,12^";
	$parm1 = $parm1."templateelement_insetleft||||Yes|Inset Left|InputText,8,12^";
	$parm1 = $parm1."templateelement_borderwidth||||Yes|Border Width|InputText,8,12^";
	$parm1 = $parm1."templateelement_bordercolor||||Yes|Border Colour|InputText,8,12^";
	$parm1 = $parm1."templateelement_height||||Yes|Height|InputText,8,12^";
	$parm1 = $parm1."templateelement_width||||Yes|Width|InputText,8,12^";	
	$parm1 = $parm1."templateelement_html||||Yes|HTML|InputTextArea,3,50^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Edit|90|No|Edit|UpdateButton^";
	$parm1 = $parm1."generic_programbutton1|Yes|Publish|80|No|Publish|ProgramButton,webpagetemplateelementpublish.php,templateelement_name,templateelement_name,newpopup,800,600^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|80|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Webpage_CAROUSELUPDATE_Output() {
	$parm0 = "Carousels|carousel|template|carousel_name|carousel_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."carousel_name|Yes|Carousel Name|120|Yes|Carousel Name|KeyText,25,25^";
	// $parm1 = $parm1."carousel_templatenamelist|Yes|Template|100|Yes|Template|InputCheckboxFromTable,template,template_name,template_name,template_name^";
	// $parm1 = $parm1."carousel_div|Yes|Div|100|Yes|Div|InputSelectFromList,navtopmenu+headercarousel+abovecontent+belowcontent+footer+footer2+sitefooter^";
	$parm1 = $parm1."carousel_height|Yes|Height|100|Yes|Image Height|InputText,8,12^";
	$parm1 = $parm1."carousel_width|Yes|Width|100|Yes|Image Width|InputText,8,12^";
	$parm1 = $parm1."carousel_screendepth|Yes|Screen Depth|100|Yes|Screen Depth|InputText,8,12^";	
	$parm1 = $parm1."carousel_type|Yes|Type|150|Yes|Carousel Type|InputSelectFromList,Carousel+Parallax+Image^";
	$parm1 = $parm1."carousel_imagerandomise|Yes|Randomise|100|Yes|Image Randomise|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."carousel_speed|Yes|Speed|150|Yes|Transition Speed|InputSelectFromList,1000+2000+3000+4000+5000+6000+7000+8000+9000+10000+15000+20000^";
	$parm1 = $parm1."||||Yes|Parallax Settings|Divider^";	
	$parm1 = $parm1."carousel_headertextcolor||||Yes|Header Text Colour|InputText,8,12^";
	$parm1 = $parm1."carousel_textcolor||||Yes|Text Colour|InputText,8,12^";
	$parm1 = $parm1."carousel_buttonbordercolor||||Yes|Button Border Colour|InputText,8,12^";
	$parm1 = $parm1."carousel_buttonfillcolor||||Yes|Button Fill Colour|InputText,8,12^";
	$parm1 = $parm1."carousel_buttontextcolor||||Yes|Button Text Colour|InputText,8,12^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Configure|90|No|Configure|UpdateButton^";
	$parm1 = $parm1."generic_programbutton1|Yes|Publish|80|No|Publish|ProgramButton,webpagecarouselpublish.php,carousel_name,carousel_name,newpopup,popup,800,600^";
	$parm1 = $parm1."generic_programbutton2|Yes|Edit Images|140|No|Edit Images|ProgramButton,webpagecarouselimgupdatelist.php,carousel_name,carousel_name,newpopup,popup,800,600^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|80|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);	
}

function Webpage_CAROUSELIMGUPDATELIST_Output ($carousel_name) {
	XH2('Carousel Image Editor - "'.$carousel_name.'"');
	XHR();
	XH4('Add a new carousel image to "'.$carousel_name.'"');
	XBR();
	XFORMUPLOAD("webpagecarouselimgupdateout.php","newimage");
	XINSTDHID();
	XINHID("carousel_name",$carousel_name);
	XINHID("carouselimg_id","new");
	XINSUBMIT("Create New Image");
	X_FORM();
	XHR();
	XH4('Update an existing carousel image on "'.$carousel_name.'"');
	XBR();
	XTABLE();
	XTR();
	XTDHTXT("Carousel");
	XTDHTXT("Id");
	XTDHTXT("Seq");
	XTDHTXT("Image Name");
	XTDHTXT("Imgage");	
	XTDHTXT("Update");
	XTDHTXT("Delete");
	X_TR();

	$itemfound = "0";
	$carouselimg_ida = Get_Array('carouselimg',$carousel_name);
	foreach ($carouselimg_ida as $carouselimg_id) {
		Get_Data("carouselimg",$carousel_name, $carouselimg_id);
		$itemfound = "1";
		XTR();
		XTDTXT($carousel_name);
		XTDTXT($carouselimg_id);
		XTDTXT($GLOBALS{'carouselimg_seq'});
		XTDTXT($GLOBALS{'carouselimg_img'});
		if ($GLOBALS{'carouselimg_img'} == "") { XTDTXT(""); }
		else {XTDIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_style/".$GLOBALS{'carouselimg_img'},"100"); }
		$link = YPGMLINK("webpagecarouselimgupdateout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("carousel_name",$carousel_name).YPGMPARM("carouselimg_id",$carouselimg_id);
		XTDLINKTXT($link,"update");
		$link = YPGMLINK("webpagecarouselimgdeleteconfirm.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("carousel_name",$carousel_name).YPGMPARM("carouselimg_id",$carouselimg_id);
		XTDLINKTXT($link,"delete");
		X_TR();
	}
	X_TABLE();
	if ($itemfound == "0") {
		XH5("No carousel images set up so far for ".$carousel_name);
	}
}

function Webpage_CAROUSELIMGUPDATE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,imagepopup,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Webpage_CAROUSELIMGUPDATE_Output ($carousel_name,$carouselimg_id) {
	Get_Data('carousel', $carousel_name);
	if ($carouselimg_id == "new") {
		Initialise_Data('carouselimg');
		$carouselimg_ida = Get_Array('carouselimg',$carousel_name);
		$highestcarouselimg_id = "CI00000";
		foreach ($carouselimg_ida as $carouselimg_id) {
			$highestcarouselimg_id = $carouselimg_id;
		}
		$highestcarouselimg_seq = str_replace("CI", "", $highestcarouselimg_id);
		$highestcarouselimg_seq++;
		$carouselimg_id = "CI".substr(("00000".$highestcarouselimg_seq), -5);
		XH2("Carousel Image Editor - New Image - ".$carouselimg_id);
	} else {
		Get_Data('carouselimg', $carousel_name, $carouselimg_id);
		XH2("Carousel Image Editor - ".$carousel_name." - ".$carouselimg_id);
	}
	
	XFORMUPLOAD("webpagecarouselimgupdatein.php","carouselimgin");
	XINSTDHID();
	XINHID("carousel_name",$carousel_name);
	XINHID("carouselimg_id",$carouselimg_id);
	XHR();	
	XH4('Image Reference');
	XTXT($carousel_name."-".$carouselimg_id);
	XHR();	
	XH4('Sequence');
	XINTXT("carouselimg_seq",$GLOBALS{'carouselimg_seq'},"5","10");
	XHR();
	XH3('Carousel Image');
	XINHID("carouselimg_img",$GLOBALS{'carouselimg_img'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "carouselimg_img";
	$imageviewwidth = "300";
	$imagename = $GLOBALS{'carouselimg_img'};
	$imageuploadto = "Carousel";
	$imageuploadid = $carousel_name."-".$carouselimg_id;
	$imageuploadwidth = $GLOBALS{'carousel_width'};
	$imageuploadheight = $GLOBALS{'carousel_height'};	
	$imagethumbwidth = "200";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	XHR();	
	if ( $GLOBALS{'carousel_type'} == "Parallax"  ) {	
		if (($GLOBALS{'carousel_width'} != "")&&($GLOBALS{'carousel_height'} != "")) {
			// $parallaximageheight = strval(intval($GLOBALS{'carousel_height'}*1.5));
			// $imageuploadfixedsize = $GLOBALS{'carousel_width'}."x".$parallaximageheight;
			$imageuploadfixedsize = $GLOBALS{'carousel_width'}."x".$GLOBALS{'carousel_height'};
		} else {
			$imageuploadfixedsize = "";
		}
		XH4('Additional Parallax Overlay Elements');
		XPTXT("Empty values result in that element not being displayed");
		XTABLE();
		XTR();XTDTXT("Heading");XTDINTXT("carouselimg_header",$GLOBALS{'carouselimg_header'},"40","80");X_TR();
		XTR();XTDTXT("Text");XTDINTXT("carouselimg_text",$GLOBALS{'carouselimg_text'},"80","150");X_TR();		
		XTR();XTDTXT("Button Text");XTDINTXT("carouselimg_buttontext",$GLOBALS{'carouselimg_buttontext'},"40","80");X_TR();		
		XTR();XTDTXT("Button Link");XTDINTXT("carouselimg_buttonlink",$GLOBALS{'carouselimg_buttonlink'},"150","300");X_TR();		
		X_TABLE();
		XHR();
	} else {
		if (($GLOBALS{'carousel_width'} != "")&&($GLOBALS{'carousel_height'} != "")) {
			$imageuploadfixedsize = $GLOBALS{'carousel_width'}."x".$GLOBALS{'carousel_height'};
		} else {
			$imageuploadfixedsize = "";
		}
	}
	
	XINSUBMIT("Update Carousel Image");
	X_FORM();
	
	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
	
}

function Webpage_CAROUSELIMGDELETECONFIRM_Output ($carousel_name, $carouselimg_id) {
	Get_Data("carouselimg",$carousel_name,$carouselimg_id);
	XH3('Carousel Image - "'.$carousel_name." - ".$carouselimg_id.'"');
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this carousel image");
	XBR();
	XFORM("webpagecarouselimgdeleteaction.php","deletecarouseling");
	XINSTDHID();
	XINHID("carousel_name",$carousel_name);
	XINHID("carouselimg_id",$carouselimg_id);	
	XINSUBMIT("Confirm Carousel Image Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Webpage_MENUUPDATE_Output() {
	$parm0 = "Menus|menu||menu_id|menu_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."menu_id|Yes|Menu Id|80|Yes|Menu Name|KeyGenerated,M[00000]^";
	$parm1 = $parm1."menu_title|Yes|Title|150|Yes|Title|InputText,50,100^";		
	$parm1 = $parm1."menu_position|Yes|Position|100|Yes|Position|InputSelectFromList,NavTopMenu+FooterMenu1+FooterMenu2+FooterMenu3+FooterMenu4^";
	$parm1 = $parm1."menu_style|Yes|Style|100|Yes|Style|InputSelectFromList,NavTopStyle+FooterStyle^";
	$parm1 = $parm1."menu_hide|Yes|Hide|60|Yes|Hide|InputSelectFromList,Display+Hide^";
	$parm1 = $parm1."generic_updatebutton|Yes|Edit|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_programbutton1|Yes|MenuItems|100|No|MenuItems|ProgramButton,webpagemenuitemupdate.php,menu_id,menu_id,samewindow,,^";
	$parm1 = $parm1."generic_programbutton2|Yes|Publish|100|No|Publish|ProgramButton,webpagemenupublish.php,menu_id,menu_id,samewindow,,^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Webpage_MENUITEMUPDATE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm,jquerynestable";
    $GLOBALS{'SITEJSOPTIONAL'} = "jquerynestable,jqueryconfirm,menuitemupdate";
    $GLOBALS{'SITEPOPUPHTML'} = "WebPageMenuItem_Popup";
}

function Webpage_MENUITEMUPDATE_Output($menu_id) {
    // Note: this works for a 1 or 2 level structure
    Get_Data('menu',$menu_id);
    // ===== select relevant menu items =============
    $menuitemtemparray = Array();
    $menuitema = Get_Array('menuitem',$menu_id);
    foreach ($menuitema as $menuitem_id) {
        Get_Data("menuitem",$menu_id,$menuitem_id);
        if ($GLOBALS{'menuitem_menuid'} == $menu_id) {
            $menulevela = explode('/',$GLOBALS{'menuitem_seq'});
            $menuitem_level = count($menulevela);
            $arrayelement = $GLOBALS{'menuitem_seq'}."#".$menuitem_id."#".$menuitem_level;
            array_push($menuitemtemparray, $arrayelement);
        }
    }
    sort ($menuitemtemparray);
    
    XH2('Update Menu - "'.$GLOBALS{'menu_title'}.'"');
    XPTXT("Drag and Drop the menu items until you get the structure you require.");
    XHRCLASS("underline");
    $oldmenuitem_level = 0;
    $nid = 0;
    XNESTCONTAINER();
    foreach ($menuitemtemparray as $arrayelement) {
        // print("========= ".$arrayelement."<br>");
        $mibit3s = explode("#",$arrayelement);
        $menuitem_id = $mibit3s[1];
        $menuitem_level = intval($mibit3s[2]);
        Get_Data('menuitem', $menu_id, $menuitem_id);
        
        if (($menuitem_level - $oldmenuitem_level) > 0) {
            // Open First in new list
            XNESTOL();
            $nid++;
            XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});  
            XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});      
        }
        if (($menuitem_level - $oldmenuitem_level) == 0) {
            // Continue list           
            X_NESTLI();
            $nid++;
            XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});  
            XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});   
        }
        if (($menuitem_level - $oldmenuitem_level) < 0) {
            // End Old list and Open First in new list
            X_NESTLI();
            X_NESTOL();
            X_NESTLI();
            $nid++;
            XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});  
            XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});   
        }
        $oldmenuitem_level = $menuitem_level;
    }
    // End nestings
    X_NESTLI();
    X_NESTOL();
    X_NESTCONTAINER ();
    XBR();
    XINBUTTONIDSPECIAL ("menu-add","success","Add New Menu Item.");
    XBR();
    
    XFORM("webpagemenuitemupdatein.php","webpagemenuitemupdatein");
    XINSTDHID();
    XINHID("menu_id",$menu_id);
    XHRCLASS("underline");
    XBR();
    // print '<textarea class="form-control" id="json_outputview" rows="5"></textarea>'."\n";
    XINHIDID("json_output","json_output","");
    XBR();
    XINCHECKBOXYESNO("publish","Yes","Publish this menu after update");
    XBR();XBR();
    XINSUBMIT ("Update Menu");
    X_FORM();
}

function WebPageMenuItem_Popup () {    
    XDIVPOPUP("webpagemenuitempopup","Menu Item");
    XINHIDID("nid","nid","");
    XDIV("MenuItemTextDiv","menuitemtextdiv");
    XH3("Text");
    XINTXTID("MenuItemText","MenuItemText","","25","50");
    X_DIV("MenuItemTextDiv");
    XDIV("MenuItemTargetTypeDiv","menuitemtargettypediv");
    XH3("Target Type");
    XINSELECTHASH (List2Hash("Webpage,URL,Login,Registration,Contacts,Results,Facebook,Twitter,Instagram"),"MenuItemTargetType","");
    X_DIV("MenuItemTargetTypeDiv");
    XDIV("MenuItemWebpageNameDiv","menuitemwebpagenamediv");
    XH3("WebpageName");
    $whash = Get_SelectArrays_Hash ("webpage","webpage_name","webpage_name","","","" );
    XINSELECTHASH ($whash,"MenuItemWebpageName","");
    X_DIV("MenuItemWebpageNameDiv");
    XDIV("MenuItemUrlDiv","menuitemurldiv");
    XH3("Web Link");
    XINTXTID("MenuItemUrl","MenuItemUrl","","50","100");
    X_DIV("MenuItemUrlDiv");
    XDIV("MenuItemHideDiv","menuitemhidediv");
    XH3("Hide");
    XINSELECTHASH (List2Hash("Display,Hide,InActive"),"MenuItemHide","");
    X_DIV("MenuItemHideDiv");
    XBR();
    XINBUTTONIDSPECIAL("webpagemenuitemupdatebutton","primary","Update");
    XINBUTTONIDSPECIAL("webpagemenuitemcancelbutton","warning","Cancel");
    XBR();
    X_DIV("webpagemenuitempopup");
}

function Webpage_MENUPUBLISHALL_Output() {
    $menua = Get_Array('menu');
    foreach ($menua as $menu_id) { 
        Get_Data("menu",$menu_id);
        Webpage_MENUPUBLISH_Output($menu_id); 
    }
    Webpage_TEMPLATEPUBLISHALL_Output();
    Webpage_WEBPAGEPUBLISHALL_Output();
}

function Webpage_MENUPUBLISH_Output($menu_id) {
	// ===== select relevant menu items =============
    Get_Data("menu",$menu_id);
	$menuitemtemparray = Array();
	$menuitema = Get_Array('menuitem',$menu_id);
	foreach ($menuitema as $menuitem_id) {
		Get_Data("menuitem",$menu_id,$menuitem_id);
		if ($GLOBALS{'menuitem_menuid'} == $menu_id) {
			$menulevela = explode('/',$GLOBALS{'menuitem_seq'});
			$menuitem_level = count($menulevela);
			$menuitem_dropdown = "";
			$arrayelement = $GLOBALS{'menuitem_seq'}."#".$menuitem_id."#".$menuitem_level."#".$menuitem_dropdown;
			array_push($menuitemtemparray, $arrayelement);
		}
	}
	rsort ($menuitemtemparray);
	$oldmenuitem_level = 1;
	// ===== mark dropdown points =============
	$menuitemtemp2array = Array();
	foreach ($menuitemtemparray as $arrayelement) {
		$mibit3s = explode("#",$arrayelement);
		$menuitem_seq = $mibit3s[0];
		$menuitem_id = $mibit3s[1];
		$menuitem_level = $mibit3s[2];
		if ($oldmenuitem_level - $menuitem_level == 1 ) {
			$menuitem_dropdown = "1";
		}
		else { $menuitem_dropdown = "0";
		}
		$arrayelement = $menuitem_seq."#".$menuitem_id."#".$menuitem_level."#".$menuitem_dropdown;
		array_push($menuitemtemp2array, $arrayelement);
		$oldmenuitem_level = $menuitem_level;
	}
	sort ($menuitemtemp2array);
	
	XH2('Publish Menu - "'.$GLOBALS{'menu_title'}.'"');
	XH3("Structure is as follows");XBR();
	
	XTABLE();
	XTR();XTDHTXT("Menu Item");XTDHTXT("Target");XTDHTXT("Link");X_TR();
	$oldmenuitem_level = 1;
	$mhtmla = Array();
	
	if ( $GLOBALS{'menu_style'} == "NavTopStyle") {
		array_push($mhtmla, BNAVCONTAINER());
		array_push($mhtmla, BNAVIMAGECONTAINER());
	
		array_push($mhtmla, '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">');
		array_push($mhtmla, '<span class="sr-only">Toggle navigation</span>');
		array_push($mhtmla, '<span class="icon-bar"></span>');
		array_push($mhtmla, '<span class="icon-bar"></span>');
		array_push($mhtmla, '<span class="icon-bar"></span>');
		array_push($mhtmla, '</button>');
		if ($GLOBALS{'domain_id'} == 'havanthockeyclub') {
			array_push($mhtmla, '<img alt="HHC" src="'.$GLOBALS{'domainwwwurl'}.'/domain_style/HHCMenuLogoOnDarkWithTextV1.png" height="50px">');
		}
		
		array_push($mhtmla, B_NAVIMAGECONTAINER());
		array_push($mhtmla, BNAVMENUCONTAINER());
		foreach ($menuitemtemp2array as $arrayelement) {
			// print("========= ".$arrayelement."<br>");
			$mibit3s = explode("#",$arrayelement);
			$menuitem_id = $mibit3s[1];
			$menuitem_level = $mibit3s[2];
			$menuitem_dropdown = $mibit3s[3];
			Get_Data('menuitem', $menu_id, $menuitem_id);
	
			//======== create target link Webpage+URL+Login+Registration+Contacts+Results ========
			$targetlink = "#";
			if ($GLOBALS{'menuitem_targettype'} == "Webpage") {
				Get_Data('webpage', $GLOBALS{'menuitem_webpagename'});
				$targetlink = $GLOBALS{'domainwwwurl'}."/".$GLOBALS{'webpage_address'};
			}
			if ($GLOBALS{'menuitem_targettype'} == "URL") {
				$targetlink = $GLOBALS{'menuitem_url'};
			}
			if ($GLOBALS{'menuitem_targettype'} == "Login") {
				$targetlink = YEXTPGMLINK("personloginout.php").YPGMMINPARMS();
			}
			if ($GLOBALS{'menuitem_targettype'} == "AccountRegistration") {
				$targetlink = YEXTPGMLINK("accountregistrationout.php").YPGMMINPARMS();
			}	
			if ($GLOBALS{'menuitem_targettype'} == "Results") {
				$targetlink = YEXTPGMLINK("frsresultsboardout.php").YPGMMINPARMS();
			}
			if ($GLOBALS{'menuitem_targettype'} == "Contacts") {
				$targetlink = YEXTPGMLINK("personcontactsout.php").YPGMMINPARMS();
			}
			if ($GLOBALS{'menuitem_targettype'} == "Facebook") {
				$targetlink = $GLOBALS{'menuitem_url'};
			}
			if ($GLOBALS{'menuitem_targettype'} == "Twitter") {
				$targetlink = $GLOBALS{'menuitem_url'};
			}			
			if ($GLOBALS{'menuitem_targettype'} == "Instagram") {
				$targetlink = $GLOBALS{'menuitem_url'};
			}			
			
			if ($menuitem_level < $oldmenuitem_level) {
				if ($oldmenuitem_level - $menuitem_level == 1) {
					// print("Up 1<br>");
					array_push($mhtmla, B_NAVDROPDOWN());
				}
			}			
			if ($menuitem_dropdown == "1") {
				// print("Down<br>");
				array_push($mhtmla, BNAVDROPDOWN($targetlink,$GLOBALS{'menuitem_text'}));
			} else {
				// print("Normal<br>");
				if ($GLOBALS{'menuitem_targettype'} == "Webpage") {
				 	array_push($mhtmla, BNAVMENUITEM ($targetlink,$GLOBALS{'menuitem_text'}));
				}
				if ($GLOBALS{'menuitem_targettype'} == "URL") {
					array_push($mhtmla, BNAVMENUITEMNEWWINDOW ($targetlink,$GLOBALS{'menuitem_text'}));
				}
				if ($GLOBALS{'menuitem_targettype'} == "Login") {
					array_push($mhtmla, BNAVMENULOGINITEM ($targetlink,$GLOBALS{'menuitem_text'}));
				}
				if ($GLOBALS{'menuitem_targettype'} == "AccountRegistration") {
				    array_push($mhtmla, BNAVMENULOGINITEM ($targetlink,$GLOBALS{'menuitem_text'}));
				}
				if ($GLOBALS{'menuitem_targettype'} == "Results") {
					array_push($mhtmla, BNAVMENUITEM ($targetlink,$GLOBALS{'menuitem_text'}));
				}				
				if ($GLOBALS{'menuitem_targettype'} == "Contacts") {
					array_push($mhtmla, BNAVMENUITEM ($targetlink,$GLOBALS{'menuitem_text'}));
				}				
				if ($GLOBALS{'menuitem_targettype'} == "Facebook") {
					array_push($mhtmla, BNAVMENUITEMNEWWINDOW ($targetlink,'<i class="fa fa-facebook" aria-hidden="true"></i>'));
				}
				if ($GLOBALS{'menuitem_targettype'} == "Twitter") {
					array_push($mhtmla, BNAVMENUITEMNEWWINDOW ($targetlink,'<i class="fa fa-twitter" aria-hidden="true"></i>'));
				}
				if ($GLOBALS{'menuitem_targettype'} == "Instagram") {
					array_push($mhtmla, BNAVMENUITEMNEWWINDOW ($targetlink,'<i class="fa fa-instagram" aria-hidden="true"></i>'));
				}					
			}
			$oldmenuitem_level = $menuitem_level;
			$offset = "";
			if ($menuitem_level == 2) {
				$offset = "----";
			}
			XTR();XTDTXT($offset.$GLOBALS{'menuitem_text'});XTDTXT($GLOBALS{'menuitem_targettype'});XTDTXT($targetlink);X_TR();
		}
		if ($menuitem_level == 1) {
		}
		if ($menuitem_level == 2) {
			array_push($mhtmla, B_NAVDROPDOWN());
		}
		array_push($mhtmla, B_NAVMENUCONTAINER());
		array_push($mhtmla, B_NAVCONTAINER());
	}
	if ( $GLOBALS{'menu_style'} == "FooterStyle") {
		array_push($mhtmla, '<div class="panel panel-footer">');
		array_push($mhtmla, '<div class="panel-heading">');
		array_push($mhtmla, '<h4>'.$GLOBALS{'menu_title'}.'</h4>');
		array_push($mhtmla, '</div>');
		array_push($mhtmla, '<div class="panel-body">');
		foreach ($menuitemtemp2array as $arrayelement) {
			// print("========= ".$arrayelement."<br>");
			$mibit3s = explode("#",$arrayelement);
			$menuitem_id = $mibit3s[1];
			$menuitem_level = $mibit3s[2];
			$menuitem_dropdown = $mibit3s[3];
			Get_Data('menuitem', $menu_id, $menuitem_id);
	
			//======== create target link Webpage+URL+Login+Registration+Contacts+Results ========
			$targetlink = "#";
			if ($GLOBALS{'menuitem_targettype'} == "Webpage") {
				Get_Data('webpage', $GLOBALS{'menuitem_webpagename'});
				$targetlink = $GLOBALS{'domainwwwurl'}."/".$GLOBALS{'webpage_address'};
			}
			if ($GLOBALS{'menuitem_targettype'} == "URL") {
				$targetlink = $GLOBALS{'menuitem_url'};
			}
			if ($GLOBALS{'menuitem_targettype'} == "Login") {
				$targetlink = YEXTPGMLINK("personloginout.php").YPGMMINPARMS();
			}
			if ($GLOBALS{'menuitem_targettype'} == "AccountRegistration") {
				$targetlink = YEXTPGMLINK("personregistrationout.php").YPGMMINPARMS();
			}
			if ($GLOBALS{'menuitem_targettype'} == "Results") {
				$targetlink = YEXTPGMLINK("frsresultsboardout.php").YPGMMINPARMS();
			}
			if ($GLOBALS{'menuitem_targettype'} == "Contacts") {
				$targetlink = YEXTPGMLINK("personcontactsout.php").YPGMMINPARMS();
			}
			array_push($mhtmla, '<p><a href="'.$targetlink.'">'.$GLOBALS{'menuitem_text'}.'</a></p>');
			XTR();XTDTXT($offset.$GLOBALS{'menuitem_text'});XTDTXT($GLOBALS{'menuitem_targettype'});XTDTXT($targetlink);X_TR();
		}
		array_push($mhtmla, '</div>');
		array_push($mhtmla, '</div>');
	}
	
	X_TABLE();
	
	$fh = Open_File_Write($GLOBALS{'domainwwwpath'}."/domain_style/".$GLOBALS{'menu_position'}.".html");
	foreach ($mhtmla as $hmessage) {
		Write_File($fh, $hmessage."\n");
	}
	Close_File_Write($fh);
}

function Webpage_Insert($webpagename,$starttext,$endtext,$insertedhtmla) {
	$inmessagea = Get_File_Array ($GLOBALS{'domainwwwpath'}."/".$GLOBALS{'webpage_address'});
	$outmessagea = Array();
	$section=1;
	foreach ($inmessagea as $inmessage) {
		if ($section == 1) {
			array_push($outmessagea,$inmessage);
		}
		if (($section == 1)&&(strlen(strstr($inmessage,$starttext))>0)) {
		    $outmessagea = array_merge($outmessagea,$insertedhtmla);
			$section=2;
		}
		if (($section == 2)&&(strlen(strstr($inmessage,$endtext))>0)) {
			$section=3;
		}
		if ($section == 3) {
			array_push($outmessagea,$inmessage);
		}
	}

	$fh = Open_File_Write($GLOBALS{'domainwwwpath'}."/".$GLOBALS{'webpage_address'});
	foreach ($outmessagea as $outmessage) {
		Write_File($fh, $outmessage."\n");
	}
	Close_File_Write($fh);
}


function Webpage_WEBPAGECOMPOSERLIST_Output () {
	XH2("Webpage Editor");
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XHR();
	XH2("Creating a new Webpage");
	XPTXT("Simply enter your webpage name and create a new webpage.");
	XPTXT("In order to show on the website a webpage must also be allocated to one of the menus.");
	XFORMUPLOAD("webpagecomposerout.php","newwebpage");
	XINSTDHID();
	XINHID("webpage_action","new");
	XINHID("webpage_html","");	
	XINHID("menulist","webpageupdatelist");
	XTABLE();
	XTR();XTDHTXT("Webpage Name");XTDHTXT("");X_TR();
	XTR();XTD();XINTXT("webpage_name","","40","40");X_TD();XTD();XINSUBMIT("Create New WebPage");X_TD();X_TR();
	X_TABLE();
	X_FORM();
	XBR();
	XHR();
	XH2("Updating an existing Webpage");
	XPTXT("Simply select a webpage from the menu lists.");
	$menuitemarray = Array();
	$webpageallocatedarray = Array();
	$menua = Get_Array('menu');
	foreach ($menua as $menu_id) {
		Get_Data('menu',$menu_id);
		$menuitema = Get_Array('menuitem',$menu_id);	
		foreach ($menuitema as $menuitem_id) {
			Get_Data('menuitem',$menu_id,$menuitem_id);
			array_push( $menuitemarray , $menu_id."#".$GLOBALS{'menuitem_seq'}."#".$GLOBALS{'menuitem_text'}."#".$GLOBALS{'menuitem_targettype'}."#".$GLOBALS{'menuitem_webpagename'});
			if ( $GLOBALS{'menuitem_targettype'} == "Webpage") { array_push( $webpageallocatedarray , $GLOBALS{'menuitem_webpagename'}); }
		}	
	}

	$webpagea = Get_Array('webpage');
	foreach ($webpagea as $webpage_name) {
		if (in_array($webpage_name, $webpageallocatedarray)) {}
		else { array_push( $menuitemarray , "M99999"."###"."Webpage"."#".$webpage_name); }
	
	}
	sort($menuitemarray);
	
	$oldmenu_id = "";
	$first = "1"; $found = "0";
	foreach ($menuitemarray as $element) {
		$mibits = explode('#',$element);		
		$menu_id = $mibits[0];
		$menuitem_seq = $mibits[1];
		$menuitem_text = $mibits[2];		
		$menuitem_targettype = $mibits[3];
		$menuitem_webpagename = $mibits[4];
		$insettxt = ""; $levela = explode('/',$menuitem_seq); $level = count($levela);
		for ($inset = 1; $inset < $level; $inset++) { $insettxt = "--".$insettxt; }
		
		if ( $menu_id != $oldmenu_id ) {
			if ($first != "1") {
				X_TABLE();
			}
			$first = "0";
			if ( $menu_id == "M99999") {
				XH2("Webpages not yet allocated to Menus");
			} else {
				Get_Data('menu',$menu_id);
				XH2("Menu - ".$menu_id." - ".$GLOBALS{'menu_title'});
			}
			XTABLE();
			XTR();
			XTDHTXT("Menu Item");
			XTDHTXT("Target");
			XTDHTXT("Webpage Name");
			XTDHTXT("Hide");
			XTDHTXT("Controller");
			XTDHTXT("Userid");
			XTDHTXT("Template");
			XTDHTXT("Sidebar");
			XTDHTXT("Composer");
			XTDHTXT("Delete");
			XTDHTXT("WebView");
			XTDHTXT("FacebookView");
			X_TR();
		}
		
		if ($menuitem_targettype == "Webpage") {
			Check_Data("webpage",$menuitem_webpagename);
			if ($GLOBALS{'IOWARNING'} == "0") {
				$canupdate = "0";
				if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) {
					$canupdate = "1";
				}
				if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'webpage_userid'})) {
					$canupdate = "1";
				}
				if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'webpage_controller'})) {
					$canupdate = "1";
				}
				$found = "1";
				XTR();
				XTDTXT($insettxt.$menuitem_text);
				XTDTXT($menuitem_targettype);				
				XTDTXT($menuitem_webpagename);				
				XTDTXT($GLOBALS{'webpage_hide'});
				XTDTXT($GLOBALS{'webpage_controller'});
				XTDTXT($GLOBALS{'webpage_userid'});
				XTDTXT($GLOBALS{'webpage_templatename'});
				XTDTXT($GLOBALS{'webpage_sidebarname'});
				if ( $canupdate == "1") {				
					$link = YPGMLINK("webpagecomposerout.php");
					$link = $link.YPGMSTDPARMS().YPGMPARM("webpage_action","update").YPGMPARM("webpage_name",$menuitem_webpagename).YPGMPARM("menulist","webpageupdatelist");
					XTDLINKTXT($link,"composer");
					$link = YPGMLINK("webpagedeleteconfirm.php");
					$link = $link.YPGMSTDPARMS().YPGMPARM("webpage_name",$menuitem_webpagename);
					XTDLINKTXT($link,"delete");
					$link = YPGMLINK("webpagewebview.php");
					$link = $link.YPGMSTDPARMS().YPGMPARM("webpage_name",$menuitem_webpagename);
					XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
					$link = YPGMLINK("webpagefbview.php");
					$link = $link.YPGMSTDPARMS().YPGMPARM("webpage_name",$menuitem_webpagename);
					XTDLINKTXTNEWPOPUP($link,"view","view","center","center","800","800");
					
				} else {
					XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
				}
				X_TR();
			}
		} else {
			XTR();
			XTDTXT($insettxt.$menuitem_text);
			XTDTXT($menuitem_targettype);		
			XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
			XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
			X_TR();
		}
		
		
		
		$oldmenu_id = $menu_id;
	}
	if ($found == "1") {
		X_TABLE();
	}

}

function Webpage_WEBPAGEDELETECONFIRM_Output ($webpage_name) {
	XH3('Delete Webpage - "'.$webpage_name.'"');
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this webpage");
	XBR();
	XFORM("webpagedeleteaction.php","deletewebpage");
	XINSTDHID();
	XINHID("webpage_name",$webpage_name);
	XINSUBMIT("Confirm Webpage Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Webpage_WEBPAGECOMPOSER_CSSJS () {
    $GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "tinymceslimcallupload,tinymcesliminit,tinymceslimreturnfromupload,globalroutines,ioroutines,slimjquerymin,webpagecomposer,slimimagepopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "FormattedSection_Popups,FormattedPlugin_Popups,WebPageComposer_Popups";
}

function Webpage_WEBPAGECOMPOSER_Output ($webpage_action, $webpage_name) {
    
    XFORMUPLOAD("webpagecomposerin.php","webpagecomposerin");
    XINSTDHID();
    XINHIDID("composermode","composermode","webpage");
    if ($webpage_action == "new") {
        Initialise_Data('webpage');
        XH2('Webpage Composer - "'.$webpage_name.'" - New Webpage' );
        $GLOBALS{'webpage_templatename'} = "Default";
        $GLOBALS{'webpage_controller'} = $GLOBALS{'LOGIN_person_id'};
    } else {
        Get_Data('webpage',$webpage_name);
        XH2('Webpage Composer - "'.$webpage_name.'"' );
    }
    XINHID("webpage_name",$webpage_name);
    XINHID("TinyMCEUploadTo","WebPage");
    XINHID("TinyMCEUploadId",$webpage_name);
    XINHID("webpage_format","5");
    XHRCLASS("underline"); 
    XH2('Settings');
    XTABLE();
    $templatea = Get_Array("template","Final");
    $xhash = Array2Hash($templatea);
    XTR();
    XTDTXT("Template");
    XTDINSELECTHASH ($xhash,"webpage_templatename",$GLOBALS{'webpage_templatename'});
    X_TR();
    $sidebara = Get_Array("sidebar");
    $xhash = Array2Hash($sidebara);
    XTR();
    XTDTXT("SideBar (If Required)");
    XTDINSELECTHASH ($xhash,"webpage_sidebarname",$GLOBALS{'webpage_sidebarname'});
    X_TR();
    $canmodifyowners = "0";
    if (strlen(strstr($GLOBALS{'person_authority'},"#Domain#"))>0) {
        $canmodifyowners = "1";
    }
    if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'webpage_controller'})) {
        $canmodifyowners = "1";
    }
    if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'webpage_userid'})) {
        $canmodifyowners = "1";
    }
    if ( $canmodifyowners == "1" ) {
        XTR();
        XTDTXT("Webpage Controller");
        XTD();
        XINTXTID("webpage_controller","webpage_controller",$GLOBALS{'webpage_controller'},"50","100");
        XINBUTTONIDSPECIAL("LookupController","info","Lookup");XBR();
        XTXTID("webpage_controllerlist",View_Person_List($GLOBALS{'webpage_controller'}));
        X_TD();
        X_TR();
        XTR();
        XTDTXT("Other people authorised to update webpage");
        XTD();
        XINTXTID("webpage_userid","webpage_userid",$GLOBALS{'webpage_userid'},"50","100");
        XINBUTTONIDSPECIAL("LookupUserid","info","Lookup");XBR();
        XTXTID("webpage_useridlist",View_Person_List($GLOBALS{'webpage_userid'}));
        X_TD();
        X_TR();
    } else {
        XTR();
        XTDTXT("Webpage Controller");
        XTDTXT(View_Person_List($GLOBALS{'webpage_controller'}));
        X_TR();
        XTR();
        XTDTXT("Other people authorised to update webpage");
        XTDTXT(View_Person_List($GLOBALS{'webpage_userid'}));
        X_TR();
    }
    X_TABLE();

    XBR();
    XHRCLASS("underline"); 
    XTABLEINVISIBLE();
    XTR();XTD();XH2('Page Content');X_TD();XTDTXTCOLOR("_______________","white");XTDMIDDLE();
    XINBUTTONIDSPECIAL ("composeraddsectionbutton","secondary","Add Section");
    XINBUTTONIDSPECIAL ("composerpreviewbutton","success","Preview without Markup");
    X_TD();X_TR();
    X_TABLE();
    
    XINHID("webpage_html","");
    XINHID("webpage_pluginlist","");
    
    $fullwidthenabled = "No";
    Check_Data('template', "Final", $webpage_templatename);
    if ($GLOBALS{'IOWARNING'} == "0") { $fullwidthenabled = $GLOBALS{'template_fullwidthenabled'}; }
    
    XDIV("composerhtml","");   
    if ( $GLOBALS{'webpage_html'} == "" ) {
        print "<!-- Empty Page -->";
        XBR();XPTXTCOLOR("Page is Empty","Silver");       
    } else {
        // correct any known issues
        $GLOBALS{'webpage_html'} = str_replace('/FSEND �>','/FSEND -->',$GLOBALS{'webpage_html'});
        $GLOBALS{'webpage_html'} = str_replace('/FSEND --><!-- FSSTART','/FSEND -->'."\n".'<!-- FSSTART',$GLOBALS{'webpage_html'});
        $htmla = Webpage_DBHTML2COMPOSER_Output($GLOBALS{'webpage_html'});
        foreach ($htmla as $message) {
            print $message;
        }              
    }
    X_DIV("composerhtml");
    
    XBR();
    XHRCLASS("underline");
    XINCHECKBOXYESNO("publish","Yes","Publish this page after update");
    XBR();XBR();
    XINBUTTONIDSPECIAL ("composersubmitbutton","primary","Update Webpage.");
    X_FORM();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,LookupController,Select,webpage_controller,webpage_controllerlist,100|field,LookupUserid,Select,webpage_userid,webpage_useridlist,100",
        "person_id",
        "active",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
}

function Webpage_WEBPAGEPUBLISHALL_Output() {
	$webpagea = Get_Array("webpage");
	foreach ($webpagea as $webpage_name) {
		Webpage_WEBPAGEPUBLISH_Output($webpage_name);
	}
}

function Webpage_WEBPAGEPUBLISHALLSELECTED_Output( $templatelist ) {
	$webpagea = Get_Array("webpage");
	foreach ($webpagea as $webpage_name) {
		Get_Data('webpage', $webpage_name);
		if ($GLOBALS{'webpage_templatename'} == "") {$GLOBALS{'webpage_templatename'} == "Default";}
		if (FoundInCommaList($GLOBALS{'webpage_templatename'},$templatelist)) { 
			Webpage_WEBPAGEPUBLISH_Output($webpage_name);
		}
	}
}

function Webpage_WEBPAGEPREVIEW_Output($webpage_templatename,$webpage_sidebarname,$webpage_html) {
    
    // This routine simulates any sidebars by using the Default template 
	$fullwidthenabled = "No";
	Check_Data('template', "Final", $webpage_templatename);
	if ($GLOBALS{'IOWARNING'} == "0") { $fullwidthenabled = $GLOBALS{'template_fullwidthenabled'}; }
	$htmlma = Webpage_DBHTML2PAGE_Output($webpage_html,$fullwidthenabled);

	if (( $GLOBALS{'template_sidebar'} == "Left" )||( $GLOBALS{'template_sidebar'} == "Right" )) {    
	    $sidebarname = $GLOBALS{'template_sidebarname'};
	    if ( $webpage_sidebarname != "" ) { $sidebarname = $webpage_sidebarname; }
	    Check_Data('sidebar', $sidebarname);
	    if ($GLOBALS{'IOWARNING'} == "0") {
	        $htmlsa = Webpage_DBHTML2PAGE_Output($GLOBALS{'sidebar_html'},"No");
	    }
	}
	
	XH3("Preview");
	XHRCLASS("underline");
	XBR();	
	if (( $GLOBALS{'template_sidebar'} == "" )||( $GLOBALS{'template_sidebar'} == "None" )) {
	    foreach ($htmlma as $message) { print $message; }
	}
	if ( $GLOBALS{'template_sidebar'} == "Left" ) {
	    $sidebarwidthnum = intval($GLOBALS{'template_sidebarwidth'});
	    $mainwidthnum = 12 - $sidebarwidthnum;
	    BROWTOP();
	    BCOL($sidebarwidthnum);
	    foreach ($htmlsa as $message) { print $message; }
	    B_COL();
	    BCOL($mainwidthnum);
	    foreach ($htmlma as $message) { print $message; }
	    B_COL();
	    B_ROW();
	}
	if ( $GLOBALS{'template_sidebar'} == "Right" ) {
	    $sidebarwidthnum = intval($GLOBALS{'template_sidebarwidth'});
	    $mainwidthnum = 12 - $sidebarwidthnum;
	    BROWTOP();
	    BCOL($mainwidthnum);
	    foreach ($htmlma as $message) { print $message; }
	    B_COL();
	    BCOL($sidebarwidthnum);
	    foreach ($htmlsa as $message) { print $message; }
	    B_COL();
	    B_ROW();
	}
}

function WebPageComposer_Popups () {
    
    XDIVPOPUP("formattedsectionsettingspopup","Formatted Section Settings");
    XINHIDID("formattedsectionid","formattedsectionid","");
    XDIV("FSBackgroundColorDiv","formattedsettingdiv");
    XH3("Background Color");
    XINTXTID("FSBackgroundColor","FSBackgroundColor","","5","10");
    X_DIV("FSBackgroundColorDiv");
    XDIV("FSPaddingTopDiv","formattedsettingdiv");
    XH3("Padding Top");
    XINTXTID("FSPaddingTop","FSPaddingTop","","5","10");
    X_DIV("FSPaddingTopDiv");
    XDIV("FSPaddingBottomDiv","formattedsettingdiv");
    XH3("Padding Bottom");
    XINTXTID("FSPaddingBottom","FSPaddingBottom","","5","10");
    X_DIV("FSPaddingBottomDiv");
    XDIV("FSParallaxSpeedDiv","formattedsettingdiv");
    XH3("Speed");
    XINTXTID("FSParallaxSpeed","FSParallaxSpeed","","5","10");
    X_DIV("FSParallaxSpeedDiv");
    XDIV("FSParallaxHeightDiv","formattedsettingdiv");
    XH3("Height");
    XINTXTID("FSParallaxHeight","FSParallaxHeight","","5","10");
    X_DIV("FSParallaxHeightDiv");
    XBR();XHR();
    XINBUTTONIDSPECIAL("formattedsectionsettingsupdatebutton","primary","Apply these settings");
    XINBUTTONIDSPECIAL("formattedsectionsettingscancelbutton","warning","Cancel");
    XBR();
    X_DIV("formattedsectionsettingspopup");
    
    XDIVPOPUP("editabletextpopup","Editable Text");
    XINTXTID("editabletext","editabletext","","50","100");
    XBR();XBR();
    XINBUTTONIDCLASS("editabletextsavebutton","editabletextsavebutton","Save");
    XINBUTTONIDCLASS("editabletextclosebutton","editabletextclosebutton","Close");
    XBR();
    X_DIV("editabletextpopup");  
    
    XDIVPOPUP("editabletieredtextpopup","Editable Text");
    XTXT("Header");XBR();
    XINTXTID("editabletieredtext1","editabletieredtext1","","50","100");XBR();XBR();
    XTXT("SubHeader");XBR();
    XINTXTID("editabletieredtext2","editabletieredtext2","","50","100");XBR();
    XBR();XBR();
    XINBUTTONIDCLASS("editabletieredtextsavebutton","editabletieredtextsavebutton","Save");
    XINBUTTONIDCLASS("editabletieredtextclosebutton","editabletieredtextclosebutton","Close");
    XBR();XBR();
    X_DIV("editabletieredtextpopup"); 

    XDIVPOPUP("editabletextareapopup","Editable Textarea");
    XPTXTCOLOR('Note: Use the source code editor "&lt;&gt;" if you need advanced formatting.',"green");
    XINTEXTAREAMCEID("editabletextarea","editabletextarea","","","10","100");
    XBR();
    XINBUTTONIDCLASS("editabletextareasavebutton","editabletextareasavebutton","Save");
    XINBUTTONIDCLASS("editabletextareaclosebutton","editabletextareaclosebutton","Close");
    XBR();
    X_DIV("editabletextareapopup");  
    
    XDIVPOPUP("editabletextlinkpopup","Editable Text Link");
    XTXT("Text");XBR();
    XINTXTID("editabletextlinktext","editabletextlinktext","","50","100");XBR();
    XTXT("Link (including http:// or https://");XBR();
    XINTXTID("editabletextlinklink","editabletextlinklink","","100","200");XBR();
    XINBUTTONIDCLASS("editabletextlinksavebutton","editabletextlinksavebutton","Save");
    XINBUTTONIDCLASS("editabletextlinkclosebutton","editabletextlinkclosebutton","Close");
    XBR();XBR();
    X_DIV("editabletextlinkpopup"); 
    
    XDIVPOPUP("editabletabpopup","Editable Tab");
    XTXT("Text");XBR();
    XINTXTID("editabletabtext","editabletabtext","","50","100");XBR();
    XBR();
    XINBUTTONIDCLASS("editabletabsavebutton","editabletabsavebutton","Save");
    XINBUTTONIDCLASS("editabletabclosebutton","editabletabclosebutton","Close");
    XBR();XBR();
    X_DIV("editabletabpopup"); 

    XDIVPOPUP("editablemappopup","Editable Map Link");
    XPTXT("Cut and paste the embedded map link into this box.");
    XINTXTID("editablemap","editablemap","","200","400");
    XBR();XBR();
    XINBUTTONIDCLASS("editablemapsavebutton","editablemapsavebutton","Save");
    XINBUTTONIDCLASS("editablemapclosebutton","editablemapclosebutton","Close");
    XBR();XBR();
    X_DIV("editablemappopup");   
    
    XDIVPOPUP("editableimgpopup","Editable Image");
    // XINHID("editableimg",$GLOBALS{'article_featuredimage'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "editable_img";
    $imageviewwidth = "600";
    $imagename = "";
    $imageuploadto = "Webpage";
    $imageuploadid = "";
    $imageuploadwidth = "800";
    $imageuploadheight = "flex";
    $imageuploadfixedsize = "750x500";
    $imagethumbwidth = "200";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);	
    XBR();XBR();
    XINBUTTONIDCLASS("editableimgsavebutton","editableimgsavebutton","Save");
    XINBUTTONIDCLASS("editableimgclosebutton","editableimgclosebutton","Close");
    XBR();XBR();
    X_DIV("editableimgpopup"); 
    
    SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
        $imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
    
    XDIVPOPUP("editablebackgroundimgpopup","Editable Background Image");
    // XINHID("editablebackgroundimg",$GLOBALS{'article_featuredimage'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "editable_backgroundimg";
    $imageviewwidth = "600";
    $imagename = "";
    $imageuploadto = "Webpage";
    $imageuploadid = "";
    $imageuploadwidth = "800";
    $imageuploadheight = "flex";
    $imageuploadfixedsize = "750x500";
    $imagethumbwidth = "200";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    XBR();XBR();
    XINBUTTONIDCLASS("editablebackgroundimgsavebutton","editablebackgroundimgsavebutton","Save");
    XINBUTTONIDCLASS("editablebackgroundimgclosebutton","editablebackgroundimgclosebutton","Close");
    XBR();XBR();
    X_DIV("editablebackgroundimgpopup"); 
    
    SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
        $imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
    
    XDIVPOPUP("editablefastackpopup","Editable Font Awesome Stack");
    XTXT("Font Awesome Icon");XBR();
    XINTXTID("editablefastackicon","editablefastackicon","","50","100");
    XINBUTTONIDCLASSSPECIAL("facheatsheet","facheatsheet","info","LookUp");
    XBR();
    XBR();
    XINBUTTONIDCLASS("editablefastacksavebutton","editablefastacksavebutton","Save");
    XINBUTTONIDCLASS("editablefastackclosebutton","editablefastackclosebutton","Close");
    XBR();XBR();
    X_DIV("editablefastackpopup"); 
    
    XDIVPOPUP("facheatsheetpopup","Font Awesome Icons");
       
    $faraw = InitialiseFA();

    BTABHEADERCONTAINER();   
    $lastgroup = "";
    foreach ($faraw as $farawelement) {
        $rbits = explode("|",$farawelement);
        if ( $rbits[0] != $lastgroup) {
            $tabname = str_replace(" ","",$rbits[0]);
            if ($lastgroup == "") { BTABHEADERITEMACTIVE($tabname,$rbits[0]); }
            else { BTABHEADERITEM($tabname,$rbits[0]); }
            $lastgroup = $rbits[0];
        }
    }
    B_TABHEADERCONTAINER();

    BTABCONTENTCONTAINER();    
    $lastgroup = "";
    $colindex = 999;
    foreach ($faraw as $farawelement) {
        $rbits = explode("|",$farawelement);
        if ( $rbits[0] != $lastgroup) {
            $tabname = str_replace(" ","",$rbits[0]);
            if ($lastgroup == "") { 
                BTABCONTENTITEMACTIVE($tabname);               
            } else { 
                B_ROW();
                B_TABCONTENTITEM();
                BTABCONTENTITEM($tabname);               
            }
            XH3($rbits[0]);
            $lastgroup = $rbits[0];
            $colindex = 999;
        }
        if ($colindex >5) {
            if ( $colindex < 999 ) { B_ROW(); } 
            BROW();
            $colindex = 0;
        }
        $iconname = str_replace("fa-","",$rbits[1]);
        
        print '<div class="col-md-2 col-sm-4">'."\n";
        print '<div class="media">'."\n";
        print '<div class="pull-left">'."\n";
        print '<span class="fa-stack fa-2x">'."\n";
        print '<i class="fa fa-circle fa-stack-2x text-primary"></i>'."\n";
        print '<i class="fa '.$rbits[1].' fa-stack-1x fa-inverse selectablefaicon"></i>'."\n";
        print '</span>'."\n";
        print '</div>'."\n";
        print '<div class="media-body">'."\n";
        print '<div class="selectablefatext">'."\n";
        print $iconname."\n";
        print '</div>'."\n";
        print '</div>'."\n";
        print '</div>'."\n";
        print '</div>'."\n";
        $colindex++;
    }
    B_ROW();
    B_TABCONTENTITEM();
    B_TABCONTENTCONTAINER();
    
    X_DIV("editablefastackpopup");     
}

function Webpage_WEBPAGEPUBLISH_Output($webpage_name) {
	Get_Data("webpage",$webpage_name);
	XH4('Publication - "'.$webpage_name);
	
	if ($GLOBALS{'webpage_templatename'} == "") { $GLOBALS{'webpage_templatename'} = "Default"; }
	
	$templatefullname = $GLOBALS{'domainwwwpath'}."/domain_style/"."Template_".$GLOBALS{'webpage_templatename'}."_Final.html";
	$pagefullname = $GLOBALS{'domainwwwpath'}."/".$GLOBALS{'webpage_address'};
	// XH3($templatefullname.' to '.$pagefullname);
	copy($templatefullname, $pagefullname);
	
	$fullwidthenabled = "No";
	Check_Data('template', "Final", $GLOBALS{'webpage_templatename'});
	if ($GLOBALS{'IOWARNING'} == "0") { $fullwidthenabled = $GLOBALS{'template_fullwidthenabled'}; }
	$htmla = Webpage_DBHTML2PAGE_Output($GLOBALS{'webpage_html'},$fullwidthenabled);	
	Webpage_Insert($GLOBALS{'webpage_address'},"START_MAINCONTENT","END_MAINCONTENT",$htmla);

	if (( $GLOBALS{'template_sidebar'} == "Left" )||( $GLOBALS{'template_sidebar'} == "Right" )) {
	    $sidebarname = $GLOBALS{'template_sidebarname'};
	    if ( $GLOBALS{'webpage_sidebarname'} != "" ) { $sidebarname = $GLOBALS{'webpage_sidebarname'}; }
	    Check_Data('sidebar', $sidebarname);
        if ($GLOBALS{'IOWARNING'} == "0") {
	        $htmla = Webpage_DBHTML2PAGE_Output($GLOBALS{'sidebar_html'},"No");
	        Webpage_Insert($GLOBALS{'webpage_address'},"START_SIDEBARCONTENT","END_SIDEBARCONTENT",$htmla);
        }
	}

	XPTXTCOLOR('Webpage re-publication successful for "'.$webpage_name.'"',"green");
}

function String2PluginType($htmlrawline) {
    // <img src="../site_assets/Plugin_ItemListA.png" width="100%">[ItemListA:Category=Event_All;Date=Future;SortBy=Date;SortSeq=Asc;Show=Full;Max=10;]
    $plugintype = "";
    $xbits1a = explode('[',$htmlrawline);
    $xbits2a = explode(']',$xbits1a[1]);
    $xbits3a = explode(':',$xbits2a[0]);
    $plugintype = $xbits3a[0];
    return $plugintype;
}

function String2PluginParmString($htmlrawline) {
    // <img src="../site_assets/Plugin_ItemListA.png" width="100%">[ItemListA:Category=Event_All;Date=Future;SortBy=Date;SortSeq=Asc;Show=Full;Max=10;]
    $parmstring = "";
    $xbits1a = explode('[',$htmlrawline);
    $xbits2a = explode(']',$xbits1a[1]);
    $parmstring = $xbits2a[0];
    return $parmstring;
}

function String2PluginParmVals($htmlrawline) {
    // <img src="../site_assets/Plugin_ItemListA.png" width="100%">[ItemListA:Category=Event_All;Date=Future;SortBy=Date;SortSeq=Asc;Show=Full;Max=10;]
    $parmvala = Array();
    $xbits1a = explode('[',$htmlrawline);
    $xbits2a = explode(']',$xbits1a[1]);
    $xbits3a = explode(':',$xbits2a[0]);
    $xbits4a = explode(';',$xbits3a[1]);
    foreach ($xbits4a as $pvstring) {
        if ($pvstring != "") {
            $pvbits = explode('=',$pvstring);
            array_push($parmvala,$pvbits[1]);
        }
    }
    return $parmvala;
} 

function DeCodeEmbed($instring) {
    $outstring = $instring;  
    $outstring = str_replace('&lt;',"<",$outstring);
    $outstring = str_replace('&gt;',">",$outstring);
    $outstring = str_replace('&quot;','"',$outstring);
    $outstring = str_replace('&amp;lt;',"<",$outstring);
    $outstring = str_replace('&amp;gt;',">",$outstring);
    $outstring = str_replace('&amp;quot;','"',$outstring);
    return $outstring;
}

function Webpage_DBHTML2PAGE_Output($webpage_html,$fullwidthenabled) {
	
    $htmla = Array();
    // clean out the unnecessary extra html
    $webpage_html = str_replace('<p>&nbsp;</p>', '', $webpage_html);
    $webpage_html = str_replace('<p><!--', '<!--', $webpage_html);	
    $webpage_html = str_replace('--></p>', '-->', $webpage_html);
    $webpage_html = str_replace('<!-- FORMSTART', '', $webpage_html);
    $webpage_html = str_replace('FORMEND -->', '', $webpage_html);
    // print($webpage_html);

    $htmlrawa = explode('<',$webpage_html);
    $first = "1";
    $excludeline = "0";

    $hi = 0;
    while ( $hi < sizeof($htmlrawa) ) {
        $htmlrawline = $htmlrawa[$hi];
            $mustincludeline = "0";
            if ($first == "0") { $htmlrawline = '<'.$htmlrawline; }
            $first = "0";
            $specialexpansion = "0";

            // ==== Look for plugins that can be expanded ===========
            // <p id="pparms_1" class="Plugin T20181013012946" style="word-break: break-all;"><img src="//localhost/havanthockeyclub/domain_style/Plugin_T20181013012946_Plugin_Instagram.png" width="100%">[T20181013012946:Source=EmbeddedHTML;]</p>
            // <input type="hidden" id="pembed_1" name="pembed_1" value="DVADFVASDASDF AW">

            if (strlen(strstr($htmlrawline,'class="Plugin ')) > 0) {
            $specialexpansion = "1";
            $hi++; $htmlrawline = $htmlrawa[$hi]; // skip <p
            $GLOBALS{'plugin_parameters'} = String2PluginParmVals($htmlrawline);
            $plugin_id = String2PluginType($htmlrawline);
            array_push($htmla,'<!-- PLUGIN ['.String2PluginParmString($htmlrawline).'] -->');
            $parma = $GLOBALS{'plugin_parameters'};
            if ($parma[0] == "EmbeddedHTML") {
            } else {
                    include $GLOBALS{'domainfilepath'}."/plugins/".$plugin_id."_pagephp.php";
                    $htmla = array_merge($htmla, $GLOBALS{'pluginhtmla'}); 

            }
            $hi++; $hi++; // move to embed line
            $htmlrawline = $htmlrawa[$hi];
            if (strlen(stristr($htmlrawline,'id="pembed_'))>0) {
                $hbits = explode('value=',$htmlrawline);
                $jbits = explode('"',$hbits[1]);
                $embedcode = $jbits[1];
                array_push($htmla, DeCodeEmbed($embedcode));
            }
            array_push($htmla,'<!-- /PLUGIN -->');	
            }

            if ($specialexpansion == "0") {   
                    $mustincludeline = "0";
                    // process Formatted Section lines
                    if (strlen(strstr($htmlrawline,' FSSTART')) > 0) { $excludeline = "1"; }
                    if (strlen(strstr($htmlrawline,'/FSSTART')) > 0) { 
                            $excludeline = "2";
                            if ($fstype == "Parallax") {
                                $htmlrawline = '</div><!-- close bootstrap container -->';
                            } else {
                                $htmlrawline = '<section style="background-color:'.$fsbackgroundcolor.'; padding-top:'.$fspaddingtop.'; padding-bottom:'.$fspaddingbottom.';">'."\n";;
                            }	
                            $mustincludeline = "1";
                    }
                    if (strlen(strstr($htmlrawline,' FSDIVIDER')) > 0) { $excludeline = "1"; }
                    if (strlen(strstr($htmlrawline,'/FSDIVIDER')) > 0) { $excludeline = "2"; }
                    if (strlen(strstr($htmlrawline,' FSSYMBOL')) > 0) { $excludeline = "1"; }
                    if (strlen(strstr($htmlrawline,'/FSSYMBOL')) > 0) { $excludeline = "2"; }			
                    if (strlen(strstr($htmlrawline,'Formatted Section - ')) > 0) {
                        $oldcontenta = explode('(',$htmlrawline);
                        $oldcontentb = explode(')',$oldcontenta[1]);
                        $parmstring = $oldcontentb[0];
                        $fstype = GetTinyParmValue($parmstring, "Type");
                        $fsbackgroundcolor = GetTinyParmValue($parmstring, "BackgroundColor");
                        $fspaddingtop = GetTinyParmValue($parmstring, "PaddingTop");
                        if (strlen(strstr($fspaddingtop,'px')) > 0) { } else { $fspaddingtop = $fspaddingtop."px"; }
                        $fspaddingbottom = GetTinyParmValue($parmstring, "PaddingBottom");
                        if (strlen(strstr($fspaddingbottom,'px')) > 0) { } else { $fspaddingbottom = $fspaddingbottom."px"; }
                    }
                    if (strlen(strstr($htmlrawline,' FSEND')) > 0) { $excludeline = "1"; }
                    if (strlen(strstr($htmlrawline,'/FSEND')) > 0) { 
                            $excludeline = "2"; 
                            $htmlrawline = '</section>'."\n";
                            if ($fstype == "Parallax") { 
                                if ( $fullwidthenabled == "Yes" ) { array_push($htmla,'<div class="container-fluid"><!-- re-open bootstrap container -->'."\n"); }
                                else { array_push($htmla,'<div class="container"><!-- re-open bootstrap container -->'."\n"); }					    
                            } 	
                            $mustincludeline = "1";
                    }	

                    // process Formatted Plugin lines
                    if (strlen(strstr($htmlrawline,' PSTART')) > 0) { $excludeline = "1"; }
                    if (strlen(strstr($htmlrawline,'/PSTART')) > 0) { $excludeline = "2"; }
                    if (strlen(strstr($htmlrawline,' PEND')) > 0) { $excludeline = "1"; }
                    if (strlen(strstr($htmlrawline,'/PEND')) > 0) { $excludeline = "2"; }	

                    if (strlen(strstr($htmlrawline,'editablepluginarea')) > 0) { // remove dotted border
                        // <div class="editablepluginarea" style="height: auto; width: 100%; border: 2px dotted navy; text-align: left; padding-top: 0px;">
                        $htmlrawline = str_replace("border: 2px dotted navy;","",$htmlrawline);		    
                    }	

                    if (strlen(strstr($htmlrawline,'editablemapbuttondiv')) > 0) { // skip 3 lines
                        $hi++;$hi++;$hi++;$hi++;		    
                        $htmlrawline = $htmlrawa[$hi];
                        $excludeline = "2";
                    }			    

                    // process Parallax lines (Note: Deprecated as of March 2018 in favour of formatted section)
                    if (strlen(strstr($htmlrawline,' PARALLAX')) > 0) { 
                            $excludeline = "1";
                            $parimgsrc = "";
                            $parheading = "";
                            $partext = "";
                            $parbuttontext = "";
                            $parbuttonlink = "";
                    }
                    if (strlen(strstr($htmlrawline,'Parallax Effect - ')) > 0) {
                            $oldcontenta = explode('(',$htmlrawline);
                            $oldcontentb = explode(')',$oldcontenta[1]);
                            $parmstring = $oldcontentb[0];
                            $parspeed = GetTinyParmValue($parmstring, "Speed");
                            $parheight = GetTinyParmValue($parmstring, "Height");				
                    }			
                    if (strlen(strstr($htmlrawline,'parimage_')) > 0) {	
                            $pbitsa = explode('src="',$htmlrawline);
                            $pbitsb = explode('"',$pbitsa[1]);
                            $pbitsc = explode('?',$pbitsb[0]);
                            $pbitsd = explode('/',$pbitsc[0]);
                            $parimgsrc = $pbitsb[0];
                            $parimgname = $pbitsd[count($pbitsd)-1];
                    }
                    if (strlen(strstr($htmlrawline,'parheading_')) > 0) { $parheading = GetTinyXParmValue($htmlrawline, 'parheading_'); }
                    if (strlen(strstr($htmlrawline,'partext_')) > 0) { $partext = GetTinyXParmValue($htmlrawline, 'partext_'); }			
                    if (strlen(strstr($htmlrawline,'parbuttontext_')) > 0) { $parbuttontext = GetTinyXParmValue($htmlrawline, 'parbuttontext_'); }
                    if (strlen(strstr($htmlrawline,'parbuttonlink_')) > 0) { $parbuttonlink = GetTinyXParmValue($htmlrawline, 'parbuttonlink_'); }
                    if ((strlen(strstr($parbuttonlink,'http')) > 0)||($parbuttonlink== '')) {}
                    else { $parbuttonlink = "http://".$parbuttonlink; }
                    if (strlen(strstr($htmlrawline,'/PARALLAX')) > 0) { 
                            $excludeline = "2"; 
                            array_push($htmla,'</div><!-- close bootstrap container -->'."\n");
                            if ($parimgname != "") {
                                    $sbitsa = explode('/',$parimgsrc);
                                    list($owidth, $oheight) = getimagesize($GLOBALS{'domainwwwpath'}."/domain_media/".$parimgname);
                                    // array_push($htmla,'<div class="parallaxcontainer">'."\n");
                                    array_push($htmla,'<div class="bg-holder" style="background-image: url('.$parimgsrc.');" data-width="'.$owidth.'" data-height="'.$oheight.'">'."\n");
                                    array_push($htmla,'<div class="content intro">'."\n");
                            }
                            if ($parheading != "") {
                                    array_push($htmla,'<h1>'.$parheading.'</h1>'."\n");
                            }
                            if ($partext != "") {
                                    array_push($htmla,'<p>'.$partext.'</p>'."\n");
                            }
                            if ($partext != "$parbuttontext") {	
                                    array_push($htmla,'<div class="cta">'."\n");
                                    array_push($htmla,'<a href="'.$parbuttonlink.'" class="btn-cta">'.$parbuttontext.'</a>'."\n");
                                    array_push($htmla,'</div>'."\n");
                            }
                            array_push($htmla,'</div>'."\n");
                            array_push($htmla,'</div>'."\n");
                            // array_push($htmla,'</div>'."\n");								
                            if ( $fullwidthenabled == "Yes" ) { array_push($htmla,'<div class="container-fluid"><!-- re-open bootstrap container -->'."\n"); } 
                            else { array_push($htmla,'<div class="container"><!-- re-open bootstrap container -->'."\n"); }				
                    }			

                    if ($excludeline == "0") { array_push($htmla,$htmlrawline); }
                    if ($mustincludeline == "1") { array_push($htmla,$htmlrawline); }
                    if ($excludeline == "2") { $excludeline = "0"; }			
            }
            $hi++;
    };
    return $htmla;
}

function Webpage_DBHTML2COMPOSER_Output($webpage_html) {
    
    $htmla = Array();    
    $htmlrawa = explode('<',$webpage_html);
    $excludeline = "0";
    $hi = 0;
    while ( $hi < sizeof($htmlrawa) ) {
        $htmlraw = $htmlrawa[$hi];
        if (($htmlraw != "")&&($htmlraw != "\n")) {
            $htmlrawline = '<'.$htmlraw;
            $mustincludeline = "0";
            // process Formatted Section lines
            if (strlen(strstr($htmlrawline,' FSSTART')) > 0) { $excludeline = "1"; $mustincludeline = "1";}
            if (strlen(strstr($htmlrawline,'/FSSTART')) > 0) {
                array_push($htmla,'<hr class="fshr" style="border-top: 1px solid #e6e6e6; margin-top: 4px; margin-bottom: 4px;">'."\n");
                $excludeline = "2";
                $mustincludeline = "1";
            }
            if (strlen(strstr($htmlrawline,' FSDIVIDER')) > 0) { $excludeline = "1"; }
            if (strlen(strstr($htmlrawline,'/FSDIVIDER')) > 0) { $excludeline = "2"; }
            if (strlen(strstr($htmlrawline,' FSSYMBOL')) > 0) { $excludeline = "1"; }
            if (strlen(strstr($htmlrawline,'/FSSYMBOL')) > 0) { $excludeline = "2"; }
            if (strlen(strstr($htmlrawline,'Formatted Section - ')) > 0) {
                $lbits = explode('Formatted Section - ',$htmlrawline);
                $mbits = explode(' ',$lbits[1]);
                $fsnum = $mbits[0];
                // insert the control buttons
                array_push($htmla,'<hr class="fshr" style="border-top: 3px solid Navy; margin-bottom: 5px;">'."\n");
                array_push($htmla,'<button id="fssettings_'.$fsnum.'" type="button" class="fssettings btn btn-primary" title="settings"><span><i class="fa fa-cog"></i></span></button>'."\n");
                array_push($htmla,'<button id="fsmovedown_'.$fsnum.'" type="button" class="fsmovedown btn btn-secondary" title="move down"><span><i class="fa fa-angle-double-down"></i></span></button>'."\n");
                array_push($htmla,'<button id="fsmoveup_'.$fsnum.'" type="button" class="fsmoveup btn btn-secondary" title="move up"><span><i class="fa fa-angle-double-up"></i></span></button>'."\n");
                array_push($htmla,'<button id="fsdelete_'.$fsnum.'" type="button" class="fsdelete btn btn-danger" title="delete"><span><i class="fa fa-remove"></i></span></button>&nbsp;&nbsp;'."\n");
                array_push($htmla,$htmlrawline);
                $hi++;
                $htmlrawline = '<'.$htmlrawa[$hi]; // closing span of title line                
                $mustincludeline = "1";
            }
            if (strlen(strstr($htmlrawline,' FSEND')) > 0) { $excludeline = "1"; $mustincludeline = "1";}
            if (strlen(strstr($htmlrawline,'/FSEND')) > 0) {
                $excludeline = "2";
                $mustincludeline = "1";
            }

            // process Formatted Plugin lines
            if (strlen(strstr($htmlrawline,' PSTART')) > 0) { $excludeline = "1"; $mustincludeline = "1";}
            if (strlen(strstr($htmlrawline,'/PSTART')) > 0) {
                array_push($htmla,'<hr class="fshr" style="border-top: 1px solid #e6e6e6; margin-top: 4px; margin-bottom: 4px;">'."\n");
                $excludeline = "2";
                $mustincludeline = "1";
            }
            if (strlen(strstr($htmlrawline,'Plugin - ')) > 0) {
                $lbits = explode('Plugin - ',$htmlrawline);
                $fsnum = $lbits[1][0];
                // insert the control buttons
                array_push($htmla,'<button id="psettings_'.$fsnum.'" type="button" class="psettings btn btn-info" title="settings"><span><i class="fa fa-cog"></i></span></button>'."\n");
                array_push($htmla,'<button id="pdelete_'.$fsnum.'" type="button" class="pdelete btn btn-danger" title="delete"><span><i class="fa fa-remove"></i></span></button>&nbsp;&nbsp;'."\n");
                array_push($htmla,$htmlrawline);
                $hi++;
                $htmlrawline = '<'.$htmlrawa[$hi]; // closing span of title line
                $mustincludeline = "1";
            }
            if (strlen(strstr($htmlrawline,' PEND')) > 0) { $excludeline = "1"; $mustincludeline = "1";}
            if (strlen(strstr($htmlrawline,'/PEND')) > 0) {
                $excludeline = "2";
                $mustincludeline = "1";
            }

            if ($excludeline == "0") { array_push($htmla,$htmlrawline); }
            if ($mustincludeline == "1") { array_push($htmla,$htmlrawline); }
            if ($excludeline == "2") { $excludeline = "0"; }
        }
        $hi++;
    }
    return $htmla;
}

function GetTinyParmValue($parmstring, $parmname) {	
	$pbitsa = explode($parmname."[",$parmstring);
	$pbitsb = explode(']',$pbitsa[1]);
	// XPTXT($parmstring." ".$parmname." ".$pbitsb[0]);
	return $pbitsb[0];
}

function GetTinyXParmValue($instring, $searchstring) {;
	// <h1 id="parheading_1" style="color: blue;" align="center">New Heading
	$xbitsa = explode('>',$instring);	
	// XPTXT($instring." ".$searchstring." ".$xbitsa[1]);
	return $xbitsa[1];
}

function Webpage_WEBPAGEASSIGNTOMENU_Output($webpage_name) {
	$foundinmenu = "0";
	$menua = Get_Array('menu');
	foreach ($menua as $menu_id) {
		Get_Data('menu', $menu_id);
		$menuitema = Get_Array('menuitem',$menu_id);
		foreach ($menuitema as $menuitem_id) {
			Get_Data('menuitem',$menu_id,$menuitem_id);
			if (($GLOBALS{'menuitem_targettype'} == "Webpage")&&( $GLOBALS{'menuitem_webpagename'} == $webpage_name )) {
				$foundinmenu = "1";
				// XPTXT('Info: Webpage - "'.$webpage_name.'" found in "'.$GLOBALS{'menu_title'}.'" menu.' );
			}
		}
	}
	if ( $foundinmenu == "0" ) {
		XH2('Note: Webpage - "'.$webpage_name.'" not yet assigned to any menu.' );
		XFORM("webpageassigntomenu.php","assigntomenuin");
		XINSTDHID();
		XINHID("webpage_name",$webpage_name);
		$menua = Get_Array('menu');
		foreach ($menua as $menu_id) {
			Get_Data('menu', $menu_id);
			XBR();XINCHECKBOXYESNO ("menu_id_".$menu_id,"No",$GLOBALS{'menu_title'});
		}
		XBR();XBR();
		XINSUBMIT("Assign webpage to menu");
		X_FORM();
	}
}

function Webpage_WEBPAGEUTILITY_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Webpage_WEBPAGEUTILITY_Output() {
	$parm0 = "";
	$parm0 = $parm0."Webpage|"; # pagetitle
	$parm0 = $parm0."webpage|"; # primetable
	$parm0 = $parm0."person,template[rootkey=Final]|"; # othertables
	$parm0 = $parm0."webpage_name|"; # keyfieldname
	$parm0 = $parm0."webpage_name|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."webpage_name|Yes|Name|140|Yes|Webpage Name|KeyText,25,50^";
	$parm1 = $parm1."webpage_userid||||Yes|Menu Name|InputPerson,10,20,User,Lookup^";
	$parm1 = $parm1."webpage_address||||Yes|Address|InputText,50,100^";
	$parm1 = $parm1."webpage_hide|Yes|Display<br>Hide|60|Yes|Display<br>Hide|InputSelectFromList,Display+Hide+InActive^";
	// $parm1 = $parm1."webpage_fixedformat||||Yes|Fixed Format|InputText,25,50^";
	// $parm1 = $parm1."webpage_sequence|Yes|Seq|150|Yes|Sequence|InputText,25,50^";
	$parm1 = $parm1."webpage_controller|Yes|Controller|100|Yes|Controller|InputPerson,10,20,Controller,Lookup^";
	// $parm1 = $parm1."webpage_buttext||||Yes|Button Text|InputText,25,50^";
	// $parm1 = $parm1."webpage_bannertext||||Yes|Banner Text|InputText,25,50^";
	// $parm1 = $parm1."webpage_webstyleid||||Yes|Style Id|InputSelectFromList,Final+Draft^";
	// $parm1 = $parm1."webpage_specialfilename||||Yes|Special Filename|InputText,50,100^";
	// $parm1 = $parm1."webpage_webstylename||||Yes|Webstyle Name|InputSelectFromTable,webstyle,webstyle_name,webstyle_name,webstyle_name^";
	$parm1 = $parm1."webpage_format||||Yes|Format|InputSelectFromList,1+2+3+4+5+6^";
	$parm1 = $parm1."webpage_html||||Yes|HTML|InputTextArea,3,50^";
	$parm1 = $parm1."webpage_templatename||||Yes|Template Name|InputSelectFromTable,template,template_name,template_name,template_name^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Edit|90|No|Edit|UpdateButton^";
	$parm1 = $parm1."generic_programbutton1|Yes|Update|90|No|Update|ProgramButton,webpagecomposerout.php,webpage_name,webpage_name,newpopup,800,600^";
	$parm1 = $parm1."generic_programbutton2|Yes|Publish|90|No|Publish|ProgramButton,webpagepublish.php,webpage_name,webpage_name,newpopup,800,600^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|90|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "person_id|person_sname|person_fname";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,User,User..,webpage_userid_input,webpage_userid_personlist,50|field,Controller,Controller..,webpage_controller_input,webpage_controller_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "person_change,center,center,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Page_Select_Hash() {
$webpagea = Get_Array_Hash("webpage");
$webpagetemparray = Array(); $maxbuthierarchy = 0;
foreach ($webpagea as $webpage_name) {
 Get_Data_Hash("webpage",$webpage_name);
 $webbit5s = explode("/",$GLOBALS{'webpage_sequence'}); 
 $buthierarchy = sizeof($webbit5s);
 $arrayelement = $GLOBALS{'webpage_sequence'}."/000/000/000/000/000/000/000/000/000"."#".$webpage_name."#".$buthierarchy."#".$GLOBALS{'webpage_hide'};
 array_push($webpagetemparray, $arrayelement);
}
sort ($webpagetemparray);
$wn = 0; $ka = Array(); $kv = Array();
foreach ($webpagetemparray as $arrayelement) {
 if ($wn <= sizeof($webpagetemparray)) {
  $webbit3s = explode("#",$webpagetemparray[$wn]);
  $webpage_name = $webbit3s[1];
  $authorised = Check_Webpage_Authorisation();
  if ($authorised == "1") {
   $buthierarchy = $webbit3s[2];
   $webpage_hide = $webbit3s[3];
   $webpagestatus = "";
   if ($webpage_hide  == "Hide") {
    $webpagestatus = "(HIDDEN)";
   }
   if ($webpage_hide  == "InActive") {
  	$webpagestatus = "(INACTIVE)";
   }
   $buttext = $webpage_name." ".$webpagestatus; 
   for ($inset = 1; $inset < $buthierarchy; $inset++) {
    $buttext = "--".$buttext;
   }
   array_push($ka, $webpage_name);
   array_push($kv, $buttext);   
  } 
 }
 $wn++;
}
return Arrays2Hash($ka,$kv);
}

function Check_Webpage_Authorisation() {	
return "1";	
}

function Webpage_WEBSITEPUBLISHALL_Output( ) {
    Webpage_TEMPLATEPUBLISHALL_Output();
    Webpage_WEBPAGEPUBLISHALL_Output();
    Webpage_MENUPUBLISHALL_Output();
}

// ===========  Template Publishers ================

function Webpage_TEMPLATEPUBLISHALL_Output( ) {
	$templatea = Get_Array("template","Final");
	foreach ($templatea as $template_name) {
		Webpage_TEMPLATEPUBLISH_Output( "Final",$template_name );
	}	
}


function Webpage_TEMPLATEPUBLISH_Output( $template_status,$template_name ) {

    // XH4("Template Publish - ".$template_name." - ".$template_status)

    Get_Data('template', $template_status, $template_name);
    
    // Insert CSS for all the Template Elements
    $cssa = Array();
    $templateelement_namea = Get_Array('templateelement');
    foreach ($templateelement_namea as $templateelement_name) {
        Get_Data("templateelement",$templateelement_name);
        if (FoundInCommaList($template_name,$GLOBALS{'templateelement_templatelist'})) {
            if ($GLOBALS{'templateelement_bordercolor'} == "") {
                $GLOBALS{'templateelement_bordercolor'} = "transparent";
            }
            array_push($cssa, 'div#TemplateElement_'.$templateelement_name.' {');
            array_push($cssa, '   position: '.$GLOBALS{'templateelement_position'}.'; ');
            array_push($cssa, '   top: '.$GLOBALS{'templateelement_insettop'}.'; ');
            array_push($cssa, '   left: '.$GLOBALS{'templateelement_insetleft'}.'; ');
            array_push($cssa, '   border: '.$GLOBALS{'templateelement_borderwidth'}.' solid '.$GLOBALS{'templateelement_bordercolor'}.'; ');
            array_push($cssa, '   height: '.$GLOBALS{'templateelement_height'}.'; ');
            array_push($cssa, '   width: '.$GLOBALS{'templateelement_width'}.'; ');
            array_push($cssa, '   z-index: 100; ');
            array_push($cssa, '} ');
        }
    }

    array_push($cssa, 'body  { ');
    array_push($cssa, '   background-color: #FFF;');
    if ( $GLOBALS{'template_navtopmenuenabled'} == "Yes" ) {
        array_push($cssa, '   padding-top: 50px;'); // allow for nav bar
    }  else {
        array_push($cssa, '   padding-top: 0px;');
    }
    array_push($cssa, '} ');
    array_push($cssa, '');

    array_push($cssa, '.floathoriz { ');
    array_push($cssa, '	float: left; ');
    array_push($cssa, '} ');

    array_push($cssa, '');
    array_push($cssa, '.clearfloat { ');
    array_push($cssa, '   clear:both; ');
    array_push($cssa, '   height:0; ');
    array_push($cssa, '   font-size: 1px; ');
    array_push($cssa, '   line-height: 0px; ');
    array_push($cssa, '} ');
    array_push($cssa, 'textarea.textareamain { ');
    array_push($cssa, '   font-size:10pt; ');
    array_push($cssa, '   font-family:Arial; ');
    array_push($cssa, '   color:Navy; ');
    array_push($cssa, '} ');
    array_push($cssa, 'input.inputmain {');
    array_push($cssa, '   font-size:10pt; ');
    array_push($cssa, '   font-family:Arial; ');
    array_push($cssa, '   color:Navy; ');
    array_push($cssa, '} ');
    /*
     array_push($cssa, 'h1.h1main { text-align: left; font-size:12pt; font-family:Arial; color:Navy;} ');
     array_push($cssa, 'h2.h2main { text-align: left; font-size:11pt; font-family:Arial; color:Navy;} ');
     array_push($cssa, 'h3.h3main { text-align: left; font-size:10pt; font-family:Arial; color:Navy;} ');
     array_push($cssa, 'h4.h4main { text-align: left; font-size:9pt; font-family:Arial; color:Navy;} ');
     array_push($cssa, 'h5.h5main { text-align: left; font-size:8pt; font-family:Arial; color:Navy;} ');
     array_push($cssa, 'h6.h6main { text-align: left; font-size:7pt; font-family:Arial; color:Navy;} ');
     */
    array_push($cssa, '.tablemain {');
    array_push($cssa, '   margin: 1px;');
    array_push($cssa, '   text-align: left;');
    array_push($cssa, '   border-width: 1px 1px 1px 1px;');
    array_push($cssa, '   border-color: Gray;');
    array_push($cssa, '   border-style: solid;');
    array_push($cssa, '   border-collapse: collapse;');
    array_push($cssa, '}');
    array_push($cssa, '.tablemain th{');
    array_push($cssa, '   vertical-align: top;');
    array_push($cssa, '   font-family: Arial;');
    array_push($cssa, '   font-size: 10pt;');
    array_push($cssa, '   font-weight: normal;');
    array_push($cssa, '   padding: 4px;');
    array_push($cssa, '   color: Black;');
    // array_push($cssa, '   background: url("'.$GLOBALS{'site_asseturl'}.'/tableheadercellbackground.png") repeat-x;');
    array_push($cssa, '   border-width: 1px;');
    array_push($cssa, '   background-color:#e6e6e6;');
    array_push($cssa, '   border-color: Gray;');
    array_push($cssa, '   border-style: solid;');
    array_push($cssa, '}');
    array_push($cssa, '.tablemain .even td {');
    array_push($cssa, '   vertical-align: top;');
    array_push($cssa, '   font-family: Arial;');
    array_push($cssa, '   font-size: 10pt;');
    array_push($cssa, '   padding: 4px;');
    array_push($cssa, '   color: Navy;');
    array_push($cssa, '   background-color:#f9f9f9;');
    array_push($cssa, '   border-width: 0px 1px 0px 0px ;');
    array_push($cssa, '   border-color: Gray;');
    array_push($cssa, '   border-style: solid;');
    array_push($cssa, '}');
    array_push($cssa, '.tablemain .odd td {');
    array_push($cssa, '   vertical-align: top;');
    array_push($cssa, '   font-family: Arial;');
    array_push($cssa, '   font-size: 10pt;');
    array_push($cssa, '   padding: 4px;');
    array_push($cssa, '   color: Navy;');
    array_push($cssa, '   background-color: white;');
    array_push($cssa, '   border-width: 0px 1px 0px 0px ;');
    array_push($cssa, '   border-color: Gray;');
    array_push($cssa, '   border-style: solid;');
    array_push($cssa, '}');
    array_push($cssa, '.tablemain tr:hover td {');
    array_push($cssa, '   background-color : #f6f6f6;');
    array_push($cssa, '}');
    array_push($cssa, '.tablemain .tableinvisible table{');
    array_push($cssa, '   border-width: 0px 0px 0px 0px ;');
    array_push($cssa, '}');
    array_push($cssa, '.tablemain .tableinvisible td {');
    array_push($cssa, '   border-width: 0px 0px 0px 0px ;');
    array_push($cssa, '}');
    array_push($cssa, 'img.linkcue {');
    array_push($cssa, '   position: absolute;');
    array_push($cssa, '   border: 0px;');
    array_push($cssa, '   bottom: 3px;');
    array_push($cssa, '   right: 3px');
    array_push($cssa, '} ');
    array_push($cssa, '.swatch td { ');
    array_push($cssa, '   border-width: 2px; ');
    array_push($cssa, '   background-color: White; ');
    array_push($cssa, '   border-color: Silver; ');
    array_push($cssa, '   border-style: solid; }');
    // array_push($cssa, '.yui-skin-sam .yui-crop .yui-crop-mask {');
    // array_push($cssa, '    background-color: gray;');
    // array_push($cssa, '    opacity: 0;');
    // array_push($cssa, '}');
    // array_push($cssa, '.yui-skin-sam .yui-crop .yui-resize {');
    // array_push($cssa, '    border: 1px dashed #FFFFFF;');
    // array_push($cssa, '    opacity: 1;');
    // array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '');
    array_push($cssa, '.nav-tabs>li>a {');
    array_push($cssa, '  background-color: #99A3A4; ');
    array_push($cssa, '  border-color: #777777;');
    array_push($cssa, '  padding: 10px;');        
    array_push($cssa, '  color:#fff;');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '/* active tab color */');
    array_push($cssa, '.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {');
    array_push($cssa, '  color:#fff;');
    array_push($cssa, '  color: #fff;');
    array_push($cssa, '  background-color: #111111;');
    array_push($cssa, '  border: 1px solid #888888;');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '/* hover tab color */');
    array_push($cssa, '.nav-tabs>li>a:hover {');
    array_push($cssa, '  color:#fff;');
    array_push($cssa, '  border-color: #000000;');
    array_push($cssa, '  background-color: #616A6B;');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, 'footer {');
    // array_push($cssa, '    margin: 30px 0;');
    array_push($cssa, '    padding: 30px;    ');
    array_push($cssa, '    background-color: #111111;');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '.panel-footer { ');
    array_push($cssa, '    background-color: transparent;');
    array_push($cssa, '    color: white;');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, ".eaclass {");
    array_push($cssa, "	  border-radius: 10px;");
    array_push($cssa, "	  border: 2px solid #777777;");
    array_push($cssa, "	  padding: 30px;");
    array_push($cssa, "	  width: 100%;");
    array_push($cssa, "	  max-width: 800px;");
    array_push($cssa, "	  -webkit-box-shadow: 2px 2px 2px 2px #eee;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */");
    array_push($cssa, "	  -moz-box-shadow:    2px 2px 2px 2px #eee;  /* Firefox 3.5 - 3.6 */");
    array_push($cssa, "	  box-shadow:         2px 2px 2px 2px #eee;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */");
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '.bcontainer { ');
    array_push($cssa, '   padding-top: 15px;   ');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '.btimage { ');
    array_push($cssa, '   width: 100%; ');
    array_push($cssa, '   border: 1px solid #888888;');
    array_push($cssa, '   box-shadow: 2px 2px 2px #AAA;');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '.btexcerpt { ');
    array_push($cssa, '   margin-top: 20px;');
    array_push($cssa, '   width: 100%; ');
    array_push($cssa, '}');

    array_push($cssa, '.btexcerpt a { ');
    array_push($cssa, '  color: #333;');
    array_push($cssa, '}');

    array_push($cssa, '');
    array_push($cssa, '.biimage { ');
    array_push($cssa, '   float: left;');
    array_push($cssa, '   width: 33%; ');
    array_push($cssa, '   border: 1px solid #888888;');
    array_push($cssa, '   box-shadow: 2px 2px 2px #AAA;');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '.biexcerpt { ');
    array_push($cssa, '   margin-left: 7%;');
    array_push($cssa, '   float: right;');
    array_push($cssa, '    width: 60%;   ');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '.biexcerpt a { ');
    array_push($cssa, '  color: #333;');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '.bexcerpt a { ');
    array_push($cssa, '  color: #333;');
    array_push($cssa, '   ');
    array_push($cssa, '}');
    array_push($cssa, '');
    array_push($cssa, '.carousel-fade .carousel-inner .item {');
    array_push($cssa, '	opacity: 0;');
    array_push($cssa, '	-webkit-transition-property: opacity;');
    array_push($cssa, '	-moz-transition-property: opacity;');
    array_push($cssa, '	-o-transition-property: opacity;');
    array_push($cssa, '	transition-property: opacity;');
    array_push($cssa, '}');
    array_push($cssa, '.carousel-fade .carousel-inner .active {');
    array_push($cssa, '	opacity: 1;');
    array_push($cssa, '}');
    array_push($cssa, '.carousel-fade .carousel-inner .active.left,');
    array_push($cssa, '.carousel-fade .carousel-inner .active.right {');
    array_push($cssa, '	left: 0;');
    array_push($cssa, '	opacity: 0;');
    array_push($cssa, '	z-index: 1;');
    array_push($cssa, '}');
    array_push($cssa, '.carousel-fade .carousel-inner .next.left,');
    array_push($cssa, '.carousel-fade .carousel-inner .prev.right {');
    array_push($cssa, '	opacity: 1;');
    array_push($cssa, '}');
    array_push($cssa, '.carousel-fade .carousel-control {');
    array_push($cssa, '	z-index: 2;');
    array_push($cssa, '}');
    array_push($cssa, '.formattedsectiondiv {');
    array_push($cssa, '  border-style: dotted;');
    array_push($cssa, '  border-width: 1px;');
    array_push($cssa, '  border-color: #ff3366;');
    array_push($cssa, '}');
    array_push($cssa, '.parallaxcontainer {');
    array_push($cssa, '  width: 100%;');
    array_push($cssa, '  height: 100%;');
    array_push($cssa, '}');
    array_push($cssa, '.parallax-window {');
    array_push($cssa, 'min-height: 300px;');
    array_push($cssa, 'background: transparent;');
    array_push($cssa, '}');
    // array_push($cssa, 'section {');
    // array_push($cssa, 'padding: 25px 0 35px;');
    // array_push($cssa, 'background: #fff;');
    // array_push($cssa, '}');
    array_push($cssa, '.innerpage {');
    array_push($cssa, 'padding: 15px 15px 15px;');
    array_push($cssa, 'background: #fff;');
    array_push($cssa, '}');
    $fh = Open_File_Write($GLOBALS{'domainwwwpath'}."/domain_style/"."Webstyle_".$template_name."_".$template_status.".css");
    foreach ($cssa as $cmessage) {
        Write_File($fh, $cmessage."\n");
    }
    Close_File_Write($fh);

    $htmla = Array();
    array_push($htmla, '<!DOCTYPE html>');
    array_push($htmla, '<!-- TEMPLATE - '.$template_status." ".$template_name.' -->');
    array_push($htmla, '<html lang="en">');
    array_push($htmla, '<head>');
    array_push($htmla, '<!-- START_META -->');
    array_push($htmla, '<meta charset="utf-8">');
    array_push($htmla, '<meta http-equiv="X-UA-Compatible" content="IE=edge">');
    array_push($htmla, '<meta name="viewport" content="width=device-width, initial-scale=1">');
    array_push($htmla, '<meta name="description" content="">');
    array_push($htmla, '<meta name="author" content="">');
    array_push($htmla, '<!-- END_META -->');
    array_push($htmla, '<!-- START_TITLE -->');
    array_push($htmla, '<title>'.$GLOBALS{'domain_longname'}.'</title>');
    array_push($htmla, '<!-- END_TITLE -->');
    array_push($htmla, '<!-- START_CSSJSCORE -->');
    if ( $GLOBALS{'template_dashboardstyle'} == "Yes" ) {
        array_push($htmla, YSITETEMPLATEDASHCSS('bootstrap'));
        array_push($htmla, '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'site_templateurl'}.'dash/font-awesome/css/font-awesome.min.css">');
        array_push($htmla, YSITETEMPLATEDASHCSS('fontastic'));	
        array_push($htmla, YSITETEMPLATEDASHCSS('roboto'));	
        array_push($htmla, YSITETEMPLATEDASHCSS('graspmobileprogresscirclemin'));	
        array_push($htmla, YSITETEMPLATEDASHCSS('mcustomscrollbar'));	
        array_push($htmla, YSITETEMPLATEDASHCSS('stylegreenpremium'));
        array_push($htmla, YSITETEMPLATEDASHCSS('custom'));
        array_push($htmla, YSITETEMPLATEDASHJS('jquerymin'));
        array_push($htmla, YSITETEMPLATEDASHJS('poppermin'));
        // array_push($htmla, '<script type="text/javascript" src="'.$GLOBALS{'site_templateurl'}.'dash/js/popper/umd/popper.min.js"></script>');
        array_push($htmla, YSITETEMPLATEDASHJS('bootstrapmin'));
        array_push($htmla, YSITETEMPLATEDASHJS('graspmobileprogresscirclemin'));       
        array_push($htmla, YSITETEMPLATEDASHJS('jquerycookie'));
        // array_push($htmla, YSITETEMPLATEDASHJS('chartmin'));
        array_push($htmla, YSITETEMPLATEDASHJS('jqueryvalidatemin'));
        array_push($htmla, YSITETEMPLATEDASHJS('mcustomscrollbarconcatmin'));
        // array_push($htmla, YSITETEMPLATEDASHJS('chartshome'));          
        array_push($htmla, YSITETEMPLATEDASHJS('homepremium'));           
        array_push($htmla, YSITETEMPLATEDASHJS('front'));    
    } else {
        array_push($htmla, YSITETEMPLATECSS('bootstrap'));
        array_push($htmla, YSITETEMPLATECSS('template'));
        array_push($htmla, YSITETEMPLATECSS('carouselfade'));	
        array_push($htmla, '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'site_templateurl'}.'/font-awesome/css/font-awesome.min.css">');
        array_push($htmla, YSITETEMPLATEJS('jquery'));
        array_push($htmla, YSITETEMPLATEJS('bootstrap'));
    }
    array_push($htmla, YSITEJS('jqueryuimin'));
    array_push($htmla, YSITEJS('jquerycookie'));
    array_push($htmla, YSITEJS('setglobals'));	
    array_push($htmla, YSITEJS('menuinserter'));
    array_push($htmla, YSITEJS('advertiser'));
    array_push($htmla, YSITEJS('viewaspopup'));
    array_push($htmla, YSITEJS('jqpopup'));
    array_push($htmla, YSITEJS('headercarousel'));
    array_push($htmla, YSITEJS('shortcodeexpander'));
    array_push($htmla, YSITEJS('jqdatatablesmin'));
    array_push($htmla, YSITEJS('simpletable'));
    array_push($htmla, YSITEJS('parallaxscrollmin'));
    array_push($htmla, YSITEJS('parallax'));
    array_push($htmla, YSITEJS('jqueryslick'));
    array_push($htmla, YSITEJS('slickslider'));
    array_push($htmla, YSITECSS('basicjqslidermin'));
    array_push($htmla, YSITECSS('jqpopup'));
    array_push($htmla, YSITECSS('jqueryui'));
    array_push($htmla, YSITECSS('jqdatatables'));
    array_push($htmla, YSITECSS('parallax'));
    array_push($htmla, YSITECSS('jqueryslick'));
    array_push($htmla, YSITECSS('jqueryslicktheme'));

    // if ( $GLOBALS{'template_dashboardstyle'} == "Yes" ) {} else {
        array_push($htmla, YDOMAINCSS('Webstyle_'.$template_name.'_'.$template_status));
    // }

    array_push($htmla, '<!-- END_CSSJSCORE -->');
    array_push($htmla, '<!-- START_CSSJSOPTIONAL -->');
    array_push($htmla, '<!-- END_CSSJSOPTIONAL -->');
    array_push($htmla, '</head>');
    array_push($htmla, '<body>');
    array_push($htmla, '<!-- START_NAVTOPMENU-->');
    if ( $GLOBALS{'template_navtopmenuenabled'} == "Yes" ) {
        array_push($htmla, '<div id="navtopmenu" >');   
        $nhtmla = Get_File_Array($GLOBALS{'domainwwwpath'}."/domain_style/NavTopMenu.html");
        foreach ($nhtmla as $nhmessage) {
            array_push($htmla, $nhmessage);
        }
        
        // array_push($htmla, '<p id="navtopmenuinsert">'.$GLOBALS{'domainwwwcorsurl'}.'/domain_style/NavTopMenu.html</p>');
        if (count(InsertTemplateElementHTML( $template_name, "navtopmenu" ))>0) {
                $htmla = array_merge($htmla,  InsertTemplateElementHTML( $template_name, "navtopmenu" ));
        }
        array_push($htmla, '</div><!-- end navtopmenu -->');        
    }

    array_push($htmla, '<!-- END_NAVTOPMENU -->');
    // configure header with carousels and any template elements
    $htmla = array_merge($htmla, InsertCarouselHTML( $template_name, $GLOBALS{'template_headercarouselname'} ));
    array_push($htmla, ' ');
    array_push($htmla, '<!-- START_JSPARMSCORE -->');
    array_push($htmla, '<input type="hidden" id="JSServiceId" name="JSServiceId" value="'.$GLOBALS{'LOGIN_service_id'}.'">');
    array_push($htmla, '<input type="hidden" id="JSDomainId" name="JSDomainId" value="'.$GLOBALS{'LOGIN_domain_id'}.'">');
    array_push($htmla, '<input type="hidden" id="JSModeId" name="JSModeId" value="'.$GLOBALS{'LOGIN_mode_id'}.'">');
    array_push($htmla, '<input type="hidden" id="JSSitePHPURL" name="JSSitePHPURL" value="'.$GLOBALS{'site_phpurl'}.'">');
    array_push($htmla, '<input type="hidden" id="JSSitePerlURL" name="JSSitePerlURL" value="'.$GLOBALS{'site_perlurl'}.'">');	
    array_push($htmla, '<input type="hidden" id="JSSiteWWWURL" name="JSSiteWWWURL" value="'.$GLOBALS{'site_wwwurl'}.'">');	
    array_push($htmla, '<input type="hidden" id="JSSiteWWWPath" name="JSSiteWWWPath" value="'.$GLOBALS{'site_wwwpath'}.'">');
    array_push($htmla, '<input type="hidden" id="JSSiteFilePath" name="JSSiteFilePath" value="'.$GLOBALS{'site_filepath'}.'">');	
    array_push($htmla, '<input type="hidden" id="JSDomainWWWURL" name="JSDomainWWWURL" value="'.$GLOBALS{'domainwwwurl'}.'">');
    array_push($htmla, '<input type="hidden" id="JSDomainWWWPath" name="JSDomainWWWPath" value="'.$GLOBALS{'domainwwwpath'}.'">');
    array_push($htmla, '<input type="hidden" id="JSDomainFilePath" name="JSDomainFilePath" value="'.$GLOBALS{'domainfilepath'}.'">');
    array_push($htmla, '<input type="hidden" id="JSCodeVersion" name="JSCodeVersion" value="'.$GLOBALS{'codeversion'}.'">');
    array_push($htmla, '<input type="hidden" id="JSActualURL" name="JSActualURL" value="'.$GLOBALS{'domain_actualurl'}.'">');
    array_push($htmla, '<!-- END_JSPARMSCORE -->');
    array_push($htmla, '<!-- START_JSPARMSDYNAMIC -->');
    array_push($htmla, '<!-- END_JSPARMSDYNAMIC -->');
    if ( $GLOBALS{'template_fullwidthenabled'} == "Yes" ) {	array_push($htmla, '<div class="container-fluid">'); }
    else { array_push($htmla, '<div class="container">'); }
    // array_push($htmla, '<div id="main" >');
    array_push($htmla, '<!-- START_ABOVECONTENT -->');
    array_push($htmla, '<div id="abovecontent" >');
    if (count(InsertTemplateElementHTML( $template_name, "abovecontent" ))>0) {
            $htmla = array_merge($htmla,  InsertTemplateElementHTML( $template_name, "abovecontent" ));
    }
    array_push($htmla, '</div><!-- end abovecontent -->');
    array_push($htmla, '<!-- END_ABOVECONTENT-->');
    if ( $GLOBALS{'template_dashboardstyle'} == "Yes" ) {
        array_push($htmla, '<div id="content" >');
        array_push($htmla, '<!-- START_DASHBOARDSTYLECONTENT -->');
        array_push($htmla, '<!-- END_DASHBOARDSTYLECONTENT-->');
        array_push($htmla, '</div><!-- end content -->');
    } else {          
        if (( $GLOBALS{'template_sidebar'} == "" )||( $GLOBALS{'template_sidebar'} == "None" )) {
            array_push($htmla, '<div id="content" >');
            array_push($htmla, '<!-- START_MAINCONTENT -->');
            array_push($htmla, '<!-- END_MAINCONTENT-->');
            array_push($htmla, '</div><!-- end content -->');
        }
        if ( $GLOBALS{'template_sidebar'} == "Left" ) {	
            $sidebarwidthnum = intval($GLOBALS{'template_sidebarwidth'});
            $mainwidthnum = 12 - $sidebarwidthnum;    
            array_push($htmla, '<div id="content" >');	    
            array_push($htmla, '<div class="row">');
            array_push($htmla, '<div class="col-md-'.strval($sidebarwidthnum).'">');
            array_push($htmla, '<!-- START_SIDEBARCONTENT -->');
            array_push($htmla, '<!-- END_SIDEBARCONTENT-->');
            array_push($htmla, '</div>');
            array_push($htmla, '<div class="col-md-'.strval($mainwidthnum).'">');
            array_push($htmla, '<!-- START_MAINCONTENT -->');
            array_push($htmla, '<!-- END_MAINCONTENT-->');
            array_push($htmla, '</div>');
            array_push($htmla, '</div>');
            array_push($htmla, '</div><!-- end content -->');
        }
        if ( $GLOBALS{'template_sidebar'} == "Right" ) {
            $sidebarwidthnum = intval($GLOBALS{'template_sidebarwidth'});
            $mainwidthnum = 12 - $sidebarwidthnum;
            array_push($htmla, '<div id="content" >');
            array_push($htmla, '<div class="row">');
            array_push($htmla, '<div class="col-md-'.strval($mainwidthnum).'">');
            array_push($htmla, '<!-- START_MAINCONTENT -->');
            array_push($htmla, '<!-- END_MAINCONTENT-->');
            array_push($htmla, '</div>');
            array_push($htmla, '<div class="col-md-'.strval($sidebarwidthnum).'">');
            array_push($htmla, '<!-- START_SIDEBARCONTENT -->');
            array_push($htmla, '<!-- END_SIDEBARCONTENT-->');
            array_push($htmla, '</div>');	    
            array_push($htmla, '</div>');
            array_push($htmla, '</div><!-- end content -->');
        }
    }
    array_push($htmla, '<!-- START_BELOWCONTENT -->');
    array_push($htmla, '<div id="belowcontent" >');
    if (count(InsertTemplateElementHTML( $template_name, "belowcontent" ))>0) {
            $htmla = array_merge($htmla,  InsertTemplateElementHTML( $template_name, "belowcontent" ));
    }
    array_push($htmla, '</div><!-- end belowcontent -->');
    array_push($htmla, '<!-- END_BELOWCONTENT-->');
    // array_push($htmla, '</div><!-- end main -->');
    array_push($htmla, '</div><!-- end bootstrap container -->');
    array_push($htmla, '<!-- START_FOOTER -->');	
    if ($GLOBALS{'template_footermenuquantity'} != "None") {
        array_push($htmla, '<footer>');    
        if ($GLOBALS{'template_footermenuquantity'} >= "1") {
                array_push($htmla, '<div class="row">');
                array_push($htmla, '<div class="col-md-3">');
                array_push($htmla, '<!-- STARTMENU=FOOTERMENU1-->');
                $nhtmla = Get_File_Array($GLOBALS{'domainwwwpath'}."/domain_style/FooterMenu1.html");
                foreach ($nhtmla as $nhmessage) {
                    array_push($htmla, $nhmessage);
                }
                // array_push($htmla, '<p id="footermenu1insert">'.$GLOBALS{'domainwwwcorsurl'}.'/domain_style/FooterMenu1.html</p>');
                array_push($htmla, '<!-- ENDMENU=FOOTERMENU1 -->');
                array_push($htmla, '</div>');
        }
        if ($GLOBALS{'template_footermenuquantity'} >= "2") {
                array_push($htmla, '<div class="col-md-3">');
                array_push($htmla, '<!-- STARTMENU=FOOTERMENU2-->');
                $nhtmla = Get_File_Array($GLOBALS{'domainwwwpath'}."/domain_style/FooterMenu2.html");
                foreach ($nhtmla as $nhmessage) {
                    array_push($htmla, $nhmessage);
                }
                // array_push($htmla, '<p id="footermenu2insert">'.$GLOBALS{'domainwwwcorsurl'}.'/domain_style/FooterMenu2.html</p>');
                array_push($htmla, '<!-- ENDMENU=FOOTERMENU2 -->');
                array_push($htmla, '</div>');
        }
        if ($GLOBALS{'template_footermenuquantity'} >= "3") {
                array_push($htmla, '<div class="col-md-3">');
                array_push($htmla, '<!-- STARTMENU=FOOTERMENU3-->');
                $nhtmla = Get_File_Array($GLOBALS{'domainwwwpath'}."/domain_style/FooterMenu3.html");
                foreach ($nhtmla as $nhmessage) {
                    array_push($htmla, $nhmessage);
                }
                // array_push($htmla, '<p id="footermenu3insert">'.$GLOBALS{'domainwwwcorsurl'}.'/domain_style/FooterMenu3.html</p>');
                array_push($htmla, '<!-- ENDMENU=FOOTERMENU3 -->');
                array_push($htmla, '</div>');
        }
        if ($GLOBALS{'template_footermenuquantity'} >= "4") {
                array_push($htmla, '<div class="col-md-3">');
                array_push($htmla, '<!-- STARTMENU=FOOTERMENU4-->');
                $nhtmla = Get_File_Array($GLOBALS{'domainwwwpath'}."/domain_style/FooterMenu4.html");
                foreach ($nhtmla as $nhmessage) {
                    array_push($htmla, $nhmessage);
                }
                // array_push($htmla, '<p id="footermenu4insert">'.$GLOBALS{'domainwwwcorsurl'}.'/domain_style/FooterMenu4.html</p>');
                array_push($htmla, '<!-- ENDMENU=FOOTERMENU4 -->');
                array_push($htmla, '</div>');	
        }
        if ($GLOBALS{'template_footermenuquantity'} >= "1") {
            array_push($htmla, '</div>');
        }
        if (count(InsertTemplateElementHTML( $template_name, "footer" )>0)) {
                $htmla = array_merge($htmla,  InsertTemplateElementHTML( $template_name, "footer" ));
        }
        array_push($htmla, '</footer>');
    }
    array_push($htmla, '<!-- END_FOOTER -->');
    array_push($htmla, '<!-- START_FOOTER2 -->');
    array_push($htmla, '<div id="footer2" >');
    if (count(InsertTemplateElementHTML( $template_name, "footer2" ))>0) {
            $htmla = array_merge($htmla,  InsertTemplateElementHTML( $template_name, "footer2" ));
    }
    array_push($htmla, '</div><!-- end footer2 -->');
    array_push($htmla, '<!-- END_FOOTER2 -->');
    array_push($htmla, '<!-- START_SITEFOOTER -->');
    array_push($htmla, '<div id="sitefooter" >');
    if (count(InsertTemplateElementHTML( $template_name, "sitefooter" ))>0) {
            $htmla = array_merge($htmla,  InsertTemplateElementHTML( $template_name, "sitefooter" ));
    }
    array_push($htmla, '</div><!-- end sitefooter -->');
    array_push($htmla, '<!-- END_SITEFOOTER --> ');
    array_push($htmla, '<!-- START_POPUPCORE -->');
    array_push($htmla, '<div id="popup_alert" >');
    array_push($htmla, '<table class="tableinvisible" border="0" cellspacing="3" cellpadding="2">');
    array_push($htmla, '<tr>');
    array_push($htmla, '<td nowrap valign="top" >');
    array_push($htmla, '<img id="popup_alertimg" src="'.$GLOBALS{'site_asseturl'}.'/zzz.jpg" border="0" />');
    array_push($htmla, '</td>');
    array_push($htmla, '<td valign="top" width="350">');
    array_push($htmla, '<a id="popup_alertmessage" >Alert Message</a>');
    array_push($htmla, '<br/>');
    array_push($htmla, '<br/>');
    array_push($htmla, '<button type="button" id="popup_alertOKbutton">Close</button>');
    array_push($htmla, '</td>');
    array_push($htmla, '</tr>');
    array_push($htmla, '</table>');
    array_push($htmla, '</div><!-- end #popup_alert -->');
    array_push($htmla, '<div id="popup_confirm" >');
    array_push($htmla, '<table class="tableinvisible" border="0" cellspacing="3" cellpadding="2">');
    array_push($htmla, '<tr>');
    array_push($htmla, '<td nowrap valign="top" >');
    array_push($htmla, '<img id="popup_confirmimg" src="'.$GLOBALS{'site_asseturl'}.'/zzz.jpg" border="0" />');
    array_push($htmla, '</td>');
    array_push($htmla, '<td valign="top" width="350">');
    array_push($htmla, '<a id="popup_confirmmessage" >Confirm Message</a>');
    array_push($htmla, '<br/>');
    array_push($htmla, '<br/>');
    array_push($htmla, '<button type="button" id="popup_confirmcancelbutton">Cancel</button>');
    array_push($htmla, '<button type="button" id="popup_confirmOKbutton">OK</button>');
    array_push($htmla, '<br/>');
    array_push($htmla, '<br/>');			
    array_push($htmla, '</td>');
    array_push($htmla, '</tr>');
    array_push($htmla, '</table>');
    array_push($htmla, '</div><!-- end #popup_alert -->');

    array_push($htmla, '<div id="popup_imagemodal" >');
    array_push($htmla, '<!-- Creates the bootstrap modal where the image will appear -->');
    array_push($htmla, '<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">');
    array_push($htmla, '<div class="modal-dialog">');
    array_push($htmla, '<div class="modal-content">');
    array_push($htmla, '<div class="modal-header">');
    array_push($htmla, '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>');
    array_push($htmla, '<h4 class="modal-title" id="myModalLabel">Image Viewer</h4>');
    array_push($htmla, '</div>');
    array_push($htmla, '<div class="modal-body">');
    array_push($htmla, '<img src="" id="imagepreview" style="width: 700px; height: 450px;" >');
    array_push($htmla, '</div>');
    array_push($htmla, '<div class="modal-footer">');
    array_push($htmla, '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    array_push($htmla, '</div>');
    array_push($htmla, '</div>');
    array_push($htmla, '</div>');
    array_push($htmla, '</div>');
    array_push($htmla, '</div><!-- end #popup_imagemodal -->');

    array_push($htmla, '<!-- START_POPUPOPTIONAL -->');
    array_push($htmla, '<!-- END_POPUPOPTIONAL -->');
    array_push($htmla, '<!-- START_CSSJSCORE2 -->');
    /*
    array_push($htmla, '<script>');
    array_push($htmla, '$(".carousel").carousel({');
    array_push($htmla, 'interval: '.$GLOBALS{'carousel_speed'}.' //changes the speed');
    array_push($htmla, '})');
    array_push($htmla, '</script> ');
    */
    array_push($htmla, '<!-- END_CSSJSCORE2 -->');
    array_push($htmla, '</body>');

    $fh = Open_File_Write($GLOBALS{'domainwwwpath'}."/domain_style/"."Template_".$template_name."_".$template_status.".html");
    foreach ($htmla as $hmessage) {
            Write_File($fh, $hmessage."\n");
    }
    Close_File_Write($fh);

    XPTXTCOLOR('Template successfully published.',"green");
    XHR();
}


function InsertTemplateElementHTML( $template_name, $templatediv ) {	
    $thtmla = Array();
    $templateelement_namea = Get_Array('templateelement');
    foreach ($templateelement_namea as $templateelement_name) {
            Get_Data("templateelement",$templateelement_name);
            if (FoundInCommaList($template_name,$GLOBALS{'templateelement_templatelist'})) {
                    if ( $GLOBALS{'templateelement_div'} == $templatediv ) {
                            array_push($thtmla, '<div id="TemplateElement_'.$templateelement_name.'" >');
                            array_push($thtmla, $GLOBALS{'templateelement_html'});
                            array_push($thtmla, '</div><!-- TemplateElement_'.$templateelement_name.' -->');
                    }
            }
    }
    return $thtmla;
}

function InsertCarouselHTML( $template_name, $carousel_name ) {
	$thtmla = Array();	
	
	array_push($thtmla, '<!-- START_HEADER -->');
	// 1. setup header with Carousel, Parallax, SimpleImage or nothing.	
	if ( $carousel_name == "" ) {
		array_push($thtmla, '<header id="headercarousel">');
		array_push($thtmla, '</header>');
	} else {
		Check_Data("carousel",$carousel_name);
		if ($GLOBALS{'IOWARNING'} == "0" ) {
			
			if ($GLOBALS{'carousel_type'} == "Carousel" ) {
				array_push($thtmla, '<!-- Bootstrap Carousel -->');
				array_push($thtmla, '<header id="headercarousel" class="carousel slide carousel-fade" data-ride="carousel">');
				array_push($thtmla, '<!-- Parameters -->');	
				$headercarouselparms = $GLOBALS{'carousel_type'}."|".$GLOBALS{'carousel_height'}."|".$GLOBALS{'carousel_width'}."|".$GLOBALS{'carousel_speed'}."|".$GLOBALS{'carousel_imagerandomise'}."|".$GLOBALS{'carousel_screendepth'};	
				array_push($thtmla, '<input type="hidden" id="headercarouselparms" name="headercarouselparms" value="'.$headercarouselparms.'">');			
				array_push($thtmla, '<!-- Indicators -->');
				array_push($thtmla, '<ol class="carousel-indicators">');
				$first = "1"; $cseq = 0;
				$carouselimg_ida = Get_Array_Hash_SortSelect('carouselimg',$carousel_name,"carouselimg_seq","","");
				foreach ($carouselimg_ida as $carouselimg_id) {
				    XPTXT($carouselimg_id);
					Get_Data('carouselimg',$carousel_name,$carouselimg_id);
					if ( $first == "1" ) {
						array_push($thtmla, '<li data-target="#headercarousel" data-slide-to="0" class="active"></li>');
						$first = "0";
					} else {
						array_push($thtmla, '<li data-target="#headercarousel" data-slide-to="'.$cseq.'"></li>');
					}
					$cseq++;
				}				
				array_push($thtmla, '</ol>');
				array_push($thtmla, '<!-- Wrapper for slides -->');
				array_push($thtmla, '<div class="carousel-inner">');				
				
				$first = "1";
				$carouselimg_ida = Get_Array_Hash_SortSelect('carouselimg',$carousel_name,"carouselimg_seq","","");
				foreach ($carouselimg_ida as $carouselimg_id) {
					Get_Data('carouselimg',$carousel_name,$carouselimg_id);
					if ( $first == "1" ) {
						array_push($thtmla, '<div class="item active">');
						$first = "0";
					} else {
						array_push($thtmla, '<div class="item">');
					}
					array_push($thtmla, '<div class="fill" style="background-image:url('."'".$GLOBALS{'domainwwwurl'}.'/domain_style/'.$GLOBALS{'carouselimg_img'}."');".'"'.'></div>');					
					array_push($thtmla, '<div class="carousel-caption">');
					array_push($thtmla, '<h2></h2>');
					array_push($thtmla, '</div>');
					array_push($thtmla, '</div>');					
				}
				array_push($thtmla, '</div>');
				array_push($thtmla, '<!-- Controls -->');
				array_push($thtmla, '<a class="left carousel-control" href="#headercarousel" data-slide="prev">');
				array_push($thtmla, '<span class="icon-prev"></span>');
				array_push($thtmla, '</a>');
				array_push($thtmla, '<a class="right carousel-control" href="#headercarousel" data-slide="next">');
				array_push($thtmla, '<span class="icon-next"></span>');
				array_push($thtmla, '</a>');
			}
			
			if ($GLOBALS{'carousel_type'} == "Parallax" ) {
				array_push($thtmla, '<!-- Parallax Carousel -->');
				array_push($thtmla, '<!-- Parameters -->');
				$headercarouselparms = $GLOBALS{'carousel_type'}."|".$GLOBALS{'carousel_height'}."|".$GLOBALS{'carousel_width'}."|".$GLOBALS{'carousel_speed'}."|".$GLOBALS{'carousel_imagerandomise'}."|".$GLOBALS{'carousel_screendepth'};
				array_push($thtmla, '<input type="hidden" id="headercarouselparms" name="headercarouselparms" value="'.$headercarouselparms.'">');
				array_push($thtmla, '<!-- Images -->');
				
				$imageseq = 0;
				$firstimage = "";
				$firstheader = "";
				$firsttext = "";
				$firstbuttontext = "";
				$firstbuttonlink = "";
				$carouselimg_ida = Get_Array_Hash_SortSelect('carouselimg',$carousel_name,"carouselimg_seq","","");
				foreach ($carouselimg_ida as $carouselimg_id) {
					Get_Data('carouselimg',$carousel_name, $carouselimg_id);
					$imageseq++;
					if ($imageseq == 1) { 
						$firstimage = $GLOBALS{'domainwwwurl'}.'/domain_style/'.$GLOBALS{'carouselimg_img'}; 
						$firstheader = $GLOBALS{'carouselimg_header'};
						$firsttext = $GLOBALS{'carouselimg_text'};
						$firstbuttontext = $GLOBALS{'carouselimg_buttontext'};
						$firstbuttonlink = $GLOBALS{'carouselimg_buttonlink'};
					}
					array_push($thtmla, '<input type="hidden" class="headerparallaximage" id="headerparallaximage_'.$imageseq.'" value="'.$GLOBALS{'domainwwwurl'}.'/domain_style/'.$GLOBALS{'carouselimg_img'}.'">');
					array_push($thtmla, '<input type="hidden" class="headerparallaxheader" id="headerparallaxheader_'.$imageseq.'" value="'.$GLOBALS{'carouselimg_header'}.'">');					
					array_push($thtmla, '<input type="hidden" class="headerparallaxtext" id="headerparallaxtext_'.$imageseq.'" value="'.$GLOBALS{'carouselimg_text'}.'">');						
					array_push($thtmla, '<input type="hidden" class="headerparallaxbuttontext" id="headerparallaxbuttontext_'.$imageseq.'" value="'.$GLOBALS{'carouselimg_buttontext'}.'">');						
					array_push($thtmla, '<input type="hidden" class="headerparallaxbuttonlink" id="headerparallaxbuttonlink_'.$imageseq.'" value="'.$GLOBALS{'carouselimg_buttonlink'}.'">');							
				}	
				array_push($thtmla, '<div class="bg-holder" id="headercarousel" style="background-image: url('.$firstimage.');" data-width="'.$GLOBALS{'carousel_width'}.'" data-height="'.$GLOBALS{'carousel_height'}.'">');
				array_push($thtmla, '<div class="content intro">');
				if ( $firstheader != "") {array_push($thtmla, '<h1 id="headerparallaxheader" >'.$firstheader.'</h1>');}
				if ( $firsttext != "") {array_push($thtmla, '<p id="headerparallaxtext" >'.$firsttext.'</p>');}
				if ( $firstbuttontext != "") { 
					array_push($thtmla, '<div class="cta">');
					array_push($thtmla, '<a  id="headerparallaxbutton" href="'.$firstbuttonlink.'" class="btn-cta">'.$firstbuttontext.'</a>');
					array_push($thtmla, '</div>');
				}
				array_push($thtmla, '</div>');
			}
			
			if ($GLOBALS{'carousel_type'} == "Image" ) {
				array_push($thtmla, '<!-- Image Carousel -->');
				array_push($thtmla, '<!-- Parameters -->');
				$headercarouselparms = $GLOBALS{'carousel_type'}."|".$GLOBALS{'carousel_height'}."|".$GLOBALS{'carousel_width'}."|".$GLOBALS{'carousel_speed'}."|".$GLOBALS{'carousel_imagerandomise'}."|".$GLOBALS{'carousel_screendepth'};
				array_push($thtmla, '<input type="hidden" id="headercarouselparms" name="headercarouselparms" value="'.$headercarouselparms.'">');
				array_push($thtmla, '<!-- Images -->');
				$imageseq = 0;
				$firstimage = "";
				$carouselimg_ida = Get_Array_Hash_SortSelect('carouselimg',$carousel_name,"carouselimg_seq","","");
				foreach ($carouselimg_ida as $carouselimg_id) {
					Get_Data('carouselimg',$carousel_name, $carouselimg_id);
					$imageseq++;
					if ($imageseq == 1) {
						$firstimage = $GLOBALS{'domainwwwurl'}.'/domain_style/'.$GLOBALS{'carouselimg_img'};
					}
					array_push($thtmla, '<input type="hidden" class="headersimpleimage" id="headersimpleimage_'.$imageseq.'" value="'.$GLOBALS{'domainwwwurl'}.'/domain_style/'.$GLOBALS{'carouselimg_img'}.'">');
				}
				array_push($thtmla, '<div id="headercarousel" class="imagefill" style="background-image: url('.$firstimage.'); height: '.$GLOBALS{'carousel_height'}.'px;">');
				// array_push($thtmla, '<div id="headercarousel" style="background-image: url('.$firstimage.'); width: 100%;">');
				// <div id="headercarouselx" style="background-image: url(//localhost/havanthockeyclub/domain_style/Carousel_SimpleImage-CI00001_IMGIG0708_FixedSize_1024x200.jpg); width: 1024px; height: 200px;">
			}
			
		}

	}
	
	// 2. add any template elements into this section
	if (count(InsertTemplateElementHTML( $template_name, "headercarousel" ))>0) {
		$thtmla = array_merge($thtmla,  InsertTemplateElementHTML( $template_name, "headercarousel" ));
	}
	
	// 3. close header section
	if ( $carousel_name == "" ) {}
	else {
		if ($GLOBALS{'carousel_type'} == "Carousel" ) { array_push($thtmla, '</header><!-- end headercarousel -->'); array_push($thtmla, '<!-- End_Bootstrap Carousel -->'); }		
		if ($GLOBALS{'carousel_type'} == "Parallax" ) { array_push($thtmla, '</div>'); array_push($thtmla, '<!-- End Parallax Carousel -->');}
		if ($GLOBALS{'carousel_type'} == "Image" ) { array_push($thtmla, '</div>'); array_push($thtmla, '<!-- End Image Carousel -->'); }			
	}
	array_push($thtmla, '<!-- END_HEADER -->');
	
	return $thtmla;
}

function FormattedSection_Popups () {
    XDIVPOPUP("formattedsectionpopup","Formatted Section");
    XH5("Select the format you would like to use");
    XHR();
    BTABHEADERCONTAINER();
    BTABHEADERITEMACTIVE("HeadersAndText","Headers and Text");
    BTABHEADERITEM("ImageWithText","Image with Text");
    BTABHEADERITEM("Images","Images");
    BTABHEADERITEM("Panels","Panels");
    BTABHEADERITEM("Slider","Carousel");
    BTABHEADERITEM("Tabs","Tabs");
    BTABHEADERITEM("Accordion","Accordion");
    BTABHEADERITEM("Messages","Messages");
    BTABHEADERITEM("Parallax","Parallax");
    BTABHEADERITEM("ContactUs","ContactUs");
    BTABHEADERITEM("PluginAreas","Plugin Areas");
    B_TABHEADERCONTAINER();
    
    BTABCONTENTCONTAINER();
    BTABCONTENTITEMACTIVE("HeadersAndText");
    XDIV("","formattedsectiondisplay");
    XBR();XBR();XTXT("Header ");XINBUTTONIDCLASS("Header","formattedselectionbutton","Select");XBR();XBR();
    XFILEFSHTML("../site_template/Header_1.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");;
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Text Columns"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("TextColumnsHeader","TextColumnsHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"TextColumnsBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"TextColumnsCols","2");
    XINBUTTONIDCLASS("TextColumns","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/TextColumns_2.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    
    BTABCONTENTITEM("ImageWithText");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Image With Right Text"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("ImageWithRightTextHeader","ImageWithTextAHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImageWithRightTextBackColor","White");
    XINBUTTONIDCLASS("ImageWithRightText","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/ImageWithRightText_1.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Image With Left Text"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("ImageWithLeftTextHeader","ImageWithLeftTextHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImageWithLeftTextBackColor","White");
    XINBUTTONIDCLASS("ImageWithLeftText","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/ImageWithLeftText_1.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");   
    B_TABCONTENTITEM();
    
    BTABCONTENTITEM("Images");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Full Width Image - Narrow"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("ImageWideNarrowHeader","ImageWideNarrowHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImageWideNarrowBackColor","White");
    XINBUTTONIDCLASS("ImageWideNarrow","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/ImageWideNarrow_1.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");   
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Full Width Image"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("ImageWideHeader","ImageWideHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImageWideBackColor","White");
    XINBUTTONIDCLASS("ImageWide","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/ImageWide_1.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");   
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Full Width Image - Tall"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("ImageWideTallHeader","ImageWideTallHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImageWideTallBackColor","White");
    XINBUTTONIDCLASS("ImageWideTall","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/ImageWideTall_1.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Image Grids"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("ImagesHeader","ImagesHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImagesBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"ImagesCols","2");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"ImagesRows","1");
    XINBUTTONIDCLASS("Images","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/Images_3.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Image Grids with SubText"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("ImagesWithSubtextHeader","ImagesWithSubTextHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImagesWithSubtextBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"ImagesWithSubTextCols","4");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"ImagesWithSubTextRows","1");
    XINBUTTONIDCLASS("ImagesWithSubText","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/ImagesWithSubText_4.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    
    BTABCONTENTITEM("Slider");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Image Carousel "); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("SliderHeader","SliderHeader","","");
    XTXT("Images Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"SliderCols","3");
    XINBUTTONIDCLASS("Slider","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/Slider_3.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    
    BTABCONTENTITEM("Panels");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Icon Panels Large"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("IconPanelsLargeHeader","IconPanelsLargeHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"IconPanelsLargeBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"IconPanelsLargeCols","4");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"IconPanelsLargeRows","1");
    XINBUTTONIDCLASS("IconPanelsLarge","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/IconPanelsLarge_4.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Symbol Panels Large"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("SymbolPanelsLargeHeader","SymbolPanelsLargeHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"SymbolPanelsLargeBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"SymbolPanelsLargeCols","4");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"SymbolPanelsLargeRows","1");
    XINBUTTONIDCLASS("SymbolPanelsLarge","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/SymbolPanelsLarge_4.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Icon Panels Small"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("IconPanelsSmallHeader","IconPanelsSmallHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"IconPanelsSmallBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4"),"IconPanelsSmallCols","3");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"IconPanelsSmallRows","1");
    XINBUTTONIDCLASS("IconPanelsSmall","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/IconPanelsSmall_3.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Symbol Panels Small"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("SymbolPanelsSmallHeader","SymbolPanelsSmallHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"SymbolPanelsSmallBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4"),"SymbolPanelsSmallCols","");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"SymbolPanelsSmallRows","");
    XINBUTTONIDCLASS("SymbolPanelsSmall","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/SymbolPanelsSmall_3.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Text Panels"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("TextPanelsHeader","TextPanelsHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"TextPanelsBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"TextPanelsCols","4");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"TextPanelsRows","1");
    XINBUTTONIDCLASS("TextPanels","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/TextPanels_4.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Image Panels"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("ImagePanelsHeader","ImagePanelsHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImagePanelsBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"ImagePanelsCols","4");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"ImagePanelsRows","1");
    XINBUTTONIDCLASS("ImagePanels","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/ImagePanels_4.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Team Panels"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("TeamPanelsHeader","TeamPanelsHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"TeamPanelsBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"TeamPanelsCols","4");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"TeamPanelsRows","1");
    XINBUTTONIDCLASS("TeamPanels","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/TeamPanels_4.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Pricing Panels"); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("PricingPanelsHeader","PricingPanelsHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"PricingPanelsBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"PricingPanelsCols","4");
    XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"PricingPanelsRows","1");
    XINBUTTONIDCLASS("PricingPanels","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/PricingPanels_4.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    
    BTABCONTENTITEM("Tabs");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Tabs "); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("TabsHeader","TabsHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"TabsBackColor","White");
    XTXT("Tabs Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"TabsCols","");
    XINBUTTONIDCLASS("Tabs","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/Tabs_4.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    BTABCONTENTITEM("Accordion");
    XBR();XH3("Accordion "); XHR();
    XDIV("","formattedsectiondisplay");
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("Accordion","Accordion","","");
    XTXT("Dropdowns Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6,7,8,9"),"AccordionCols","4");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"AccordionBackColor","White");
    XINBUTTONIDCLASS("Accordion","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/Accordion_4.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    
    BTABCONTENTITEM("Messages");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Action Message "); XHR();
    XTXT("Header Required - ");XINCHECKBOXYESNOID ("MessageActionHeader","MessageActionHeader","","");
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"MessageActionBackColor","White");
    XINBUTTONIDCLASS("MessageAction","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/MessageAction_1.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    
    BTABCONTENTITEM("Parallax");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Parallax "); XHR();
    XTXT("Speed - ");XINSELECTHASH (List2Hash("0.2,0.4,0.6,0.8"),"ParallaxSpeed","0.4");
    XTXT("Height - ");XINSELECTHASH (List2Hash("20%,25%,30%,35%"),"ParallaxHeading","30%");
    XINBUTTONIDCLASS("Parallax","formattedselectionbutton","Select");XBR();XBR();XBR();
    // XHR();
    // XCLEARFLOAT();
    XFILEFSHTML("../site_template/Parallax_1.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    
    BTABCONTENTITEM("ContactUs");
    XDIV("","formattedsectiondisplay");
    XBR();XH3("Contact Us "); XHR();
    XINBUTTONIDCLASS("ContactUs","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/ContactUs_1.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    
    BTABCONTENTITEM("PluginAreas");
    XDIV("","formattedsectiondisplay");
    
    XBR();XH3("Plain Plugin Areas"); XHR();
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImagesBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"PluginsPlainCols","2");
    // XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"PluginsPlainRows","1");
    XINBUTTONIDCLASS("PluginsPlain","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/PluginsPlain_2.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");

    XDIV("","formattedsectiondisplay");
    XBR();XH3("Panel Plugin Areas"); XHR();
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImagesBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"PluginsPanelsCols","2");
    // XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"PluginsPanelsRows","1");
    XINBUTTONIDCLASS("PluginsPanels","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/PluginsPanels_2.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");

    XDIV("","formattedsectiondisplay");
    XBR();XH3("Tabbed Plugin Areas"); XHR();
    XTXT("Background Color - ");XINSELECTHASH (List2Hash("Transparent,White,LightGray"),"ImagesBackColor","White");
    XTXT("Cols Required - ");XINSELECTHASH (List2Hash("1,2,3,4,5,6"),"PluginsTabsCols","2");
    // XTXT("Rows Required - ");XINSELECTHASH (List2Hash("1,2,3"),"PluginsTabsRows","1");
    XINBUTTONIDCLASS("PluginsTabs","formattedselectionbutton","Select");XBR();XBR();XBR();
    XFILEFSHTML("../site_template/PluginsTabs_3.html");XBR();XHR();
    X_DIV("formattedsectiondisplay");
    B_TABCONTENTITEM();
    
    B_TABCONTENTCONTAINER();
    X_DIV("formattedsectionpopup");
    
}


function FormattedPlugin_Popups () {
    
    XDIVPOPUP("formattedpluginpopup","Plugins");
    XH5("Select the plugin you would like to insert");
    XHR();
    
    // ========= ceate tabs and selection buttons for each plugin =================
    BTABHEADERCONTAINER();
    $plugincategorya = Get_Array('plugincategory');
    foreach ($plugincategorya as $plugincategory_name) {
        Get_Data("plugincategory",$plugincategory_name);
        $tabref = str_replace(" "," ",$plugincategory_name);       
        BTABHEADERITEM($tabref,$plugincategory_name);
    }
    B_TABHEADERCONTAINER();
    
    BTABCONTENTCONTAINER();
    foreach ($plugincategorya as $plugincategory_name) {
        Get_Data("plugincategory",$plugincategory_name);
        $tabref = str_replace(" "," ",$plugincategory_name);
        BTABCONTENTITEM($tabref);
        
        $plugina = Get_Array('plugin');
        foreach ($plugina as $plugin_id) {
            Get_Data("plugin",$plugin_id);
            if ( $GLOBALS{'plugin_category'} == $plugincategory_name ) {                
                $parmdefaultstring = "";
                if ($GLOBALS{'plugin_parmlist'} != "") {
                    $GLOBALS{'plugin_parmlist'} = Strip_CRandLF($GLOBALS{'plugin_parmlist'});
                    $parametera = explode(";",$GLOBALS{'plugin_parmlist'});
                    foreach ($parametera as $parameterstring) {
                        if ( $parameterstring != "" ) {
                            $parmbitsa = explode('|',$parameterstring);
                            $parmname = $parmbitsa[0];
                            $parmtitle = $parmbitsa[1];
                            $parmtype = $parmbitsa[2];
                            $parmsyntax = $parmbitsa[3];
                            $parmdefaultval = $parmbitsa[4];
                            $syntaxa = explode(',',$parmsyntax);
                            $parmdefaultstring = $parmdefaultstring.$parmname."=".$parmdefaultval.";";
                        }
                    }
                } else {
                    if ($GLOBALS{'plugin_embeddedhtml'} == "Yes") {
                        $parmdefaultstring = "Source=EmbeddedHTML;"; 
                    }                    
                }                
                XDIV("","formattedsectiondisplay");
                XBR();XH3($GLOBALS{'plugin_name'}); XHR();
                XINBUTTONIDCLASS("Plugin_".$plugin_id,"formattedpluginselectionbutton","Select");XBR();XBR();XBR();
                XINHID("Plugin_".$plugin_id."_Name",$GLOBALS{'plugin_name'});
                XINHID("Plugin_".$plugin_id."_Parmdefaults",$parmdefaultstring);
                XINHID("Plugin_".$plugin_id."_Image",$GLOBALS{'plugin_image'});
                // XINHID("Plugin_".$plugin_id."_Parmlist","Rows");
                XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_style/".$GLOBALS{'plugin_image'},"100%");XBR();XHR();
                X_DIV("formattedsectiondisplay");
            }
        }
        B_TABCONTENTITEM(); 
    }

    B_TABCONTENTCONTAINER();
    X_DIV("formattedpluginpopup");
    
    // ========= ceate popups for each plugin =================
    $plugina = Get_Array('plugin');
    foreach ($plugina as $plugin_id) {
        Get_Data("plugin",$plugin_id);
        XDIVCLASSPOPUP("Plugin_".$plugin_id."_Settings_Popup","formattedpluginsettingspopup","Plugin - ".$GLOBALS{'plugin_name'});       
        /*
        ParmName|ParmTitle|InputText|size,max;
        ParmName|ParmTitle|InputTextArea|rows,cols;
        ParmName|ParmTitle|InputFixed|value;
        ParmName|ParmTitle|InputSelectFromTable|tablename,keyfieldname,textfieldname,sortfieldname;
        ParmName|ParmTitle|InputRadioFromTable|tablename,keyfieldname,textfieldname,sortfieldname;
        ParmName|ParmTitle|InputCheckboxFromTable|tablename,keyfieldname,textfieldname,sortfieldname;
        ParmName|ParmTitle|InputSelectFromList|xk,yk;� � � � <--- OR xk[xt],yk[yt]
        ParmName|ParmTitle|InputRadioFromList|xk,yk;� � � � <--- OR xk[xt],yk[yt]
        ParmName|ParmTitle|InputCheckboxFromList|xk,yk;� � � � <--- OR xk[xt],yk[yt]� �
        */
        $GLOBALS{'plugin_parmlist'} = Strip_CRandLF($GLOBALS{'plugin_parmlist'});
        if ($GLOBALS{'plugin_parmlist'} != "") {
            $parametera = explode(";",$GLOBALS{'plugin_parmlist'});        
            foreach ($parametera as $parameterstring) {
                if ( $parameterstring != "" ) {
                    $parmbitsa = explode('|',$parameterstring);
                    $parmname = $parmbitsa[0];
                    $parmtitle = $parmbitsa[1];
                    $parmtype = $parmbitsa[2];
                    $parmsyntax = $parmbitsa[3];
                    $syntaxa = explode(',',$parmsyntax);
                    BROW();
                    BCOLTXT($parmtitle,"6");
                    if ( $parmtype == "InputText") {
                        BCOLINTXTID($plugin_id."_".$parmname,$parmname,"","6");               
                    }
                    if ( $parmtype == "InputSelectFromTable") {
                        $xhash = Get_SelectArrays_Hash ($syntaxa[0],$syntaxa[1],$syntaxa[2],$syntaxa[3],"","" );
                        $xhash["All"] = "All";
                        BCOLINSELECTHASHID($xhash,$plugin_id."_".$parmname,$parmname,"","6");
                    }
                    if ( $parmtype == "InputSelectFromList") {
                        BCOLINSELECTHASHID(List2Hash($parmsyntax),$plugin_id."_".$parmname,$parmname,"","6");          
                    }
                    B_ROW();
                }
            }
        }
        if ($GLOBALS{'plugin_embeddedhtml'} == "Yes") {
            BROW();
            BCOLTXT("Embedded HTML","2");
            BCOLINTEXTAREAID($plugin_id."_EmbeddedHTML","EmbeddedHTML","","6","10");
            B_ROW();
        }
        XHR();
        XINBUTTONIDCLASS ("Plugin_".$plugin_id."_Settings_Button", "formattedpluginsettingsupdatebutton", "Apply these settings");
        XINBUTTONIDCLASS ("Plugin_".$plugin_id."_Settings_CancelButton", "formattedpluginsettingscancelbutton", "Cancel");
        XBR();
        X_DIV("Plugin_".$plugin_id."_Settings_Popup");         
    }   
}

function XFILEFSHTML ($file) {
    $htmla = Get_File_Array($file);
    foreach ($htmla as $message ) {
        $exclude = "0";
        if ( strlen(strstr($message,' FSDIVIDER')) > 0) { $exclude = "1"; }
        if ( strlen(strstr($message,' FSSYMBOL')) > 0) { $exclude = "1"; }
        if ( $exclude == "0" ) { print($message."\n"); }       
    }
}

function InitialiseFA() {
    $fa = Array();
    $faraw = Array (               
        "Arrows|fa-angle-double-down",
        "Arrows|fa-angle-double-left",
        "Arrows|fa-angle-double-right",
        "Arrows|fa-angle-double-up",
        "Arrows|fa-angle-down",
        "Arrows|fa-angle-left",
        "Arrows|fa-angle-right",
        "Arrows|fa-angle-up",
        "Arrows|fa-arrow-circle-down",
        "Arrows|fa-arrow-circle-left",
        "Arrows|fa-arrow-circle-o-down",
        "Arrows|fa-arrow-circle-o-left",
        "Arrows|fa-arrow-circle-o-right",
        "Arrows|fa-arrow-circle-o-up",
        "Arrows|fa-arrow-circle-right",
        "Arrows|fa-arrow-circle-up",
        "Arrows|fa-arrow-down",
        "Arrows|fa-arrow-left",
        "Arrows|fa-arrow-right",
        "Arrows|fa-arrow-up",
        "Arrows|fa-arrows",
        "Arrows|fa-arrows-alt",
        "Arrows|fa-arrows-h",
        "Arrows|fa-arrows-v",
        "Arrows|fa-backward",
        "Arrows|fa-caret-down",
        "Arrows|fa-caret-left",
        "Arrows|fa-caret-right",
        "Arrows|fa-caret-square-o-down",
        "Arrows|fa-caret-square-o-left",
        "Arrows|fa-caret-square-o-right",
        "Arrows|fa-caret-square-o-up",
        "Arrows|fa-caret-up",
        "Arrows|fa-chevron-circle-down",
        "Arrows|fa-chevron-circle-left",
        "Arrows|fa-chevron-circle-right",
        "Arrows|fa-chevron-circle-up",
        "Arrows|fa-chevron-down",
        "Arrows|fa-chevron-left",
        "Arrows|fa-chevron-right",
        "Arrows|fa-chevron-up",
        "Arrows|fa-cloud-download",
        "Arrows|fa-cloud-upload",
        "Arrows|fa-compress",
        "Arrows|fa-download",
        "Arrows|fa-exchange",
        "Arrows|fa-expand",
        "Arrows|fa-external-link",
        "Arrows|fa-external-link-square",
        "Arrows|fa-fast-backward",
        "Arrows|fa-fast-forward",
        "Arrows|fa-forward",
        "Arrows|fa-hand-o-down",
        "Arrows|fa-hand-o-left",
        "Arrows|fa-hand-o-right",
        "Arrows|fa-hand-o-up",
        "Arrows|fa-history",
        "Arrows|fa-level-down",
        "Arrows|fa-level-up",
        "Arrows|fa-location-arrow",
        "Arrows|fa-long-arrow-down",
        "Arrows|fa-long-arrow-left",
        "Arrows|fa-long-arrow-right",
        "Arrows|fa-long-arrow-up",
        "Arrows|fa-mail-forward",
        "Arrows|fa-mail-reply",
        "Arrows|fa-mail-reply-all",
        "Arrows|fa-play",
        "Arrows|fa-random",
        "Arrows|fa-recycle",
        "Arrows|fa-reply",
        "Arrows|fa-reply-all",
        "Arrows|fa-retweet",
        "Arrows|fa-share",
        "Arrows|fa-share-square",
        "Arrows|fa-share-square-o",
        "Arrows|fa-sign-in",
        "Arrows|fa-sign-out",
        "Arrows|fa-sort",
        "Arrows|fa-sort-alpha-asc",
        "Arrows|fa-sort-alpha-desc",
        "Arrows|fa-sort-amount-asc",
        "Arrows|fa-sort-amount-desc",
        "Arrows|fa-sort-asc",
        "Arrows|fa-sort-desc",
        "Arrows|fa-sort-down",
        "Arrows|fa-sort-numeric-asc",
        "Arrows|fa-sort-numeric-desc",
        "Arrows|fa-sort-up",
        "Arrows|fa-step-backward",
        "Arrows|fa-step-forward",
        "Arrows|fa-toggle-down",
        "Arrows|fa-toggle-left",
        "Arrows|fa-toggle-right",
        "Arrows|fa-toggle-up",
        "Arrows|fa-unsorted",
        "Arrows|fa-upload",
        "Arrows|fa-youtube-play",
        "Travel|fa-ambulance",
        "Travel|fa-anchor",
        "Travel|fa-automobile",
        "Travel|fa-bicycle",
        "Travel|fa-building",
        "Travel|fa-building-o",
        "Travel|fa-bus",
        "Travel|fa-cab",
        "Travel|fa-car",
        "Travel|fa-compass",
        "Travel|fa-dashboard",
        "Travel|fa-fighter-jet",
        "Travel|fa-globe",
        "Travel|fa-h-square",
        "Travel|fa-home",
        "Travel|fa-map-marker",
        "Travel|fa-plane",
        "Travel|fa-road",
        "Travel|fa-rocket",
        "Travel|fa-shopping-cart",
        "Travel|fa-space-shuttle",
        "Travel|fa-suitcase",
        "Travel|fa-tachometer",
        "Travel|fa-taxi",
        "Travel|fa-truck",
        "Travel|fa-wheelchair",
        "Communication|fa-at",
        "Communication|fa-comment",
        "Communication|fa-comment-o",
        "Communication|fa-comments",
        "Communication|fa-comments-o",
        "Communication|fa-envelope",
        "Communication|fa-envelope-o",
        "Communication|fa-envelope-square",
        "Communication|fa-inbox",
        "Communication|fa-mail-forward",
        "Communication|fa-mail-reply",
        "Communication|fa-mail-reply-all",
        "Communication|fa-quote-left",
        "Communication|fa-quote-right",
        "Communication|fa-reply",
        "Communication|fa-reply-all",
        "Communication|fa-send",
        "Communication|fa-send-o",
        "Stars|fa-asterisk",
        "Stars|fa-star",
        "Stars|fa-star-half",
        "Stars|fa-star-half-empty",
        "Stars|fa-star-half-full",
        "Stars|fa-star-half-o",
        "Stars|fa-star-o",
        "Design|fa-adjust",
        "Design|fa-crop",
        "Design|fa-crosshairs",
        "Design|fa-eyedropper",
        "Design|fa-image",
        "Design|fa-magic",
        "Design|fa-paint-brush",
        "Design|fa-pencil",
        "Design|fa-pencil-square",
        "Design|fa-pencil-square-o",
        "Design|fa-photo",
        "Design|fa-picture-o",
        "Design|fa-qrcode",
        "Design|fa-tint",
        "Charts|fa-area-chart",
        "Charts|fa-bar-chart",
        "Charts|fa-bar-chart-o",
        "Charts|fa-line-chart",
        "Charts|fa-pie-chart",
        "Control|fa-angle-left",
        "Control|fa-angle-right",
        "Control|fa-cogs",
        "Control|fa-filter",
        "Control|fa-gears",
        "Control|fa-plug",
        "Control|fa-power-off",
        "Control|fa-refresh",
        "Control|fa-sliders",
        "Control|fa-stop",
        "Control|fa-toggle-off",
        "Control|fa-toggle-on",
        "Control|fa-wrench",
        "Events|fa-birthday-cake",
        "Events|fa-certificate",
        "Events|fa-flag-checkered",
        "Events|fa-futbol-o",
        "Events|fa-gift",
        "Events|fa-graduation-cap",
        "Events|fa-mortar-board",
        "Events|fa-soccer-ball-o",
        "Events|fa-tree",
        "Events|fa-trophy",
        "Events|fa-university",
        "Help|fa-info",
        "Help|fa-info-circle",
        "Help|fa-question",
        "Help|fa-question-circle",
        "Flags|fa-flag",
        "Flags|fa-flag-checkered",
        "Flags|fa-flag-o",
        "Text Editor|fa-align-center",
        "Text Editor|fa-align-justify",
        "Text Editor|fa-align-left",
        "Text Editor|fa-align-right",
        "Text Editor|fa-bold",
        "Text Editor|fa-chain",
        "Text Editor|fa-chain-broken",
        "Text Editor|fa-clipboard",
        "Text Editor|fa-columns",
        "Text Editor|fa-copy",
        "Text Editor|fa-cut",
        "Text Editor|fa-dedent",
        "Text Editor|fa-edit",
        "Text Editor|fa-eraser",
        "Text Editor|fa-file",
        "Text Editor|fa-file-o",
        "Text Editor|fa-file-text",
        "Text Editor|fa-file-text-o",
        "Text Editor|fa-files-o",
        "Text Editor|fa-floppy-o",
        "Text Editor|fa-font",
        "Text Editor|fa-header",
        "Text Editor|fa-indent",
        "Text Editor|fa-italic",
        "Text Editor|fa-link",
        "Text Editor|fa-list",
        "Text Editor|fa-list-alt",
        "Text Editor|fa-list-ol",
        "Text Editor|fa-list-ul",
        "Text Editor|fa-outdent",
        "Text Editor|fa-paperclip",
        "Text Editor|fa-paragraph",
        "Text Editor|fa-paste",
        "Text Editor|fa-repeat",
        "Text Editor|fa-rotate-left",
        "Text Editor|fa-rotate-right",
        "Text Editor|fa-save",
        "Text Editor|fa-scissors",
        "Text Editor|fa-strikethrough",
        "Text Editor|fa-subscript",
        "Text Editor|fa-superscript",
        "Text Editor|fa-table",
        "Text Editor|fa-text-height",
        "Text Editor|fa-text-width",
        "Text Editor|fa-th",
        "Text Editor|fa-th-large",
        "Text Editor|fa-th-list",
        "Text Editor|fa-underline",
        "Text Editor|fa-undo",
        "Text Editor|fa-unlink",
        "Form|fa-check-square",
        "Form|fa-check-square-o",
        "Form|fa-circle",
        "Form|fa-circle-o",
        "Form|fa-dot-circle-o",
        "Form|fa-minus-square",
        "Form|fa-minus-square-o",
        "Form|fa-plus-square",
        "Form|fa-plus-square-o",
        "Form|fa-square",
        "Form|fa-square-o",
        "Media|fa-arrows-alt",
        "Media|fa-backward",
        "Media|fa-compress",
        "Media|fa-eject",
        "Media|fa-expand",
        "Media|fa-fast-backward",
        "Media|fa-fast-forward",
        "Media|fa-film",
        "Media|fa-forward",
        "Media|fa-headphones",
        "Media|fa-microphone",
        "Media|fa-microphone-slash",
        "Media|fa-music",
        "Media|fa-pause",
        "Media|fa-play",
        "Media|fa-play-circle",
        "Media|fa-play-circle-o",
        "Media|fa-step-backward",
        "Media|fa-step-forward",
        "Media|fa-stop",
        "Media|fa-ticket",
        "Media|fa-video-camera",
        "Media|fa-volume-down",
        "Media|fa-volume-off",
        "Media|fa-volume-up",
        "Media|fa-youtube-play",
        "Maths|fa-minus",
        "Maths|fa-minus-circle",
        "Maths|fa-plus",
        "Maths|fa-plus-circle",
        "Maths|fa-times",
        "Maths|fa-times-circle",
        "Maths|fa-times-circle-o",
        "Technology|fa-calculator",
        "Technology|fa-camera",
        "Technology|fa-camera-retro",
        "Technology|fa-cloud",
        "Technology|fa-cloud-download",
        "Technology|fa-cloud-upload",
        "Technology|fa-code",
        "Technology|fa-code-fork",
        "Technology|fa-database",
        "Technology|fa-desktop",
        "Technology|fa-download",
        "Technology|fa-fax",
        "Technology|fa-gamepad",
        "Technology|fa-hdd-o",
        "Technology|fa-keyboard-o",
        "Technology|fa-laptop",
        "Technology|fa-mobile",
        "Technology|fa-mobile-phone",
        "Technology|fa-phone",
        "Technology|fa-phone-square",
        "Technology|fa-print",
        "Technology|fa-qrcode",
        "Technology|fa-rss",
        "Technology|fa-rss-square",
        "Technology|fa-signal",
        "Technology|fa-tablet",
        "Technology|fa-terminal",
        "Technology|fa-tty",
        "Technology|fa-upload",
        "Technology|fa-wifi",
        "Food and Drink|fa-beer",
        "Food and Drink|fa-birthday-cake",
        "Food and Drink|fa-coffee",
        "Food and Drink|fa-cutlery",
        "Food and Drink|fa-glass",
        "Food and Drink|fa-lemon-o",
        "Food and Drink|fa-spoon",
        "Nature|fa-bug",
        "Nature|fa-globe",
        "Nature|fa-leaf",
        "Nature|fa-lemon-o",
        "Nature|fa-paw",
        "Nature|fa-tree",
        "Weather|fa-bolt",
        "Weather|fa-cloud",
        "Weather|fa-flash",
        "Weather|fa-moon-o",
        "Weather|fa-sun-o",
        "Weather|fa-umbrella",
        "Emergency|fa-ambulance",
        "Emergency|fa-bullhorn",
        "Emergency|fa-exclamation",
        "Emergency|fa-exclamation-circle",
        "Emergency|fa-exclamation-triangle",
        "Emergency|fa-fire",
        "Emergency|fa-fire-extinguisher",
        "Emergency|fa-hospital-o",
        "Emergency|fa-life-bouy",
        "Emergency|fa-life-buoy",
        "Emergency|fa-life-ring",
        "Emergency|fa-life-saver",
        "Emergency|fa-medkit",
        "Emergency|fa-stethoscope",
        "Emergency|fa-support",
        "Emergency|fa-warning",
        "Warnings|fa-ban",
        "Warnings|fa-bell",
        "Warnings|fa-bell-o",
        "Warnings|fa-bell-slash",
        "Warnings|fa-bell-slash-o",
        "Warnings|fa-bomb",
        "Warnings|fa-exclamation",
        "Warnings|fa-exclamation-circle",
        "Warnings|fa-exclamation-triangle",
        "Warnings|fa-key",
        "Warnings|fa-lock",
        "Warnings|fa-shield",
        "Warnings|fa-unlock",
        "Warnings|fa-unlock-alt",
        "Warnings|fa-warning",
        "Organisation|fa-archive",
        "Organisation|fa-barcode",
        "Organisation|fa-calendar",
        "Organisation|fa-calendar-o",
        "Organisation|fa-folder",
        "Organisation|fa-folder-o",
        "Organisation|fa-folder-open",
        "Organisation|fa-folder-open-o",
        "Organisation|fa-remove",
        "Organisation|fa-reorder",
        "Organisation|fa-search",
        "Organisation|fa-search-minus",
        "Organisation|fa-search-plus",
        "Organisation|fa-sitemap",
        "Organisation|fa-tag",
        "Organisation|fa-tags",
        "Organisation|fa-tasks",
        "Organisation|fa-thumb-tack",
        "Organisation|fa-trash",
        "Organisation|fa-trash-o",
        "3D|fa-book",
        "3D|fa-cube",
        "3D|fa-cubes",
        "3D|fa-language",
        "3D|fa-paper-plane",
        "3D|fa-paper-plane-o",
        "Power|fa-plug",
        "Power|fa-power-off",
        "Payment|fa-bank",
        "Payment|fa-cc-amex",
        "Payment|fa-cc-discover",
        "Payment|fa-cc-mastercard",
        "Payment|fa-cc-paypal",
        "Payment|fa-cc-stripe",
        "Payment|fa-cc-visa",
        "Payment|fa-credit-card",
        "Payment|fa-google-wallet",
        "Payment|fa-paypal",
        "Currency|fa-bitcoin",
        "Currency|fa-btc",
        "Currency|fa-cny",
        "Currency|fa-dollar",
        "Currency|fa-eur",
        "Currency|fa-euro",
        "Currency|fa-gbp",
        "Currency|fa-ils",
        "Currency|fa-inr",
        "Currency|fa-jpy",
        "Currency|fa-krw",
        "Currency|fa-money",
        "Currency|fa-rmb",
        "Currency|fa-rouble",
        "Currency|fa-rub",
        "Currency|fa-ruble",
        "Currency|fa-rupee",
        "Currency|fa-shekel",
        "Currency|fa-sheqel",
        "Currency|fa-try",
        "Currency|fa-turkish-lira",
        "Currency|fa-usd",
        "Currency|fa-won",
        "Currency|fa-yen",
        "Carts|fa-credit-card",
        "Carts|fa-shopping-cart",
        "Spinners|fa-circle-o-notch",
        "Spinners|fa-cog",
        "Spinners|fa-gear",
        "Spinners|fa-refresh",
        "Spinners|fa-spinner",
        "Filetypes|fa-file",
        "Filetypes|fa-file-archive-o",
        "Filetypes|fa-file-audio-o",
        "Filetypes|fa-file-code-o",
        "Filetypes|fa-file-excel-o",
        "Filetypes|fa-file-image-o",
        "Filetypes|fa-file-movie-o",
        "Filetypes|fa-file-o",
        "Filetypes|fa-file-pdf-o",
        "Filetypes|fa-file-photo-o",
        "Filetypes|fa-file-picture-o",
        "Filetypes|fa-file-powerpoint-o",
        "Filetypes|fa-file-sound-o",
        "Filetypes|fa-file-text",
        "Filetypes|fa-file-text-o",
        "Filetypes|fa-file-video-o",
        "Filetypes|fa-file-word-o",
        "Filetypes|fa-file-zip-o",
        "People|fa-child",
        "People|fa-eye",
        "People|fa-eye-slash",
        "People|fa-female",
        "People|fa-frown-o",
        "People|fa-group",
        "People|fa-heart",
        "People|fa-heart-o",
        "People|fa-male",
        "People|fa-meh-o",
        "People|fa-smile-o",
        "People|fa-thumbs-down",
        "People|fa-thumbs-o-down",
        "People|fa-thumbs-o-up",
        "People|fa-thumbs-up",
        "People|fa-user",
        "People|fa-user-md",
        "People|fa-users",
        "Ticks and Crosses|fa-check",
        "Ticks and Crosses|fa-check-circle",
        "Ticks and Crosses|fa-check-circle-o",
        "Ticks and Crosses|fa-check-square",
        "Ticks and Crosses|fa-check-square-o",
        "Ticks and Crosses|fa-close",
        "Ticks and Crosses|fa-times",
        "Ticks and Crosses|fa-times-circle",
        "Ticks and Crosses|fa-times-circle-o",
        "Legal|fa-briefcase",
        "Legal|fa-cc",
        "Legal|fa-copyright",
        "Legal|fa-gavel",
        "Legal|fa-institution",
        "Misc|fa-bars",
        "Misc|fa-binoculars",
        "Misc|fa-bookmark",
        "Misc|fa-bookmark-o",
        "Misc|fa-bullseye",
        "Misc|fa-circle-thin",
        "Misc|fa-clock-o",
        "Misc|fa-ellipsis-h",
        "Misc|fa-ellipsis-v",
        "Misc|fa-flask",
        "Misc|fa-lightbulb-o",
        "Misc|fa-magnet",
        "Misc|fa-navicon",
        "Misc|fa-newspaper-o",
        "Misc|fa-puzzle-piece",
        "Brands|fa-adn",
        "Brands|fa-android",
        "Brands|fa-angellist",
        "Brands|fa-apple",
        "Brands|fa-behance",
        "Brands|fa-behance-square",
        "Brands|fa-bitbucket",
        "Brands|fa-bitbucket-square",
        "Brands|fa-bitcoin",
        "Brands|fa-btc",
        "Brands|fa-codepen",
        "Brands|fa-css3",
        "Brands|fa-delicious",
        "Brands|fa-deviantart",
        "Brands|fa-digg",
        "Brands|fa-dribbble",
        "Brands|fa-dropbox",
        "Brands|fa-drupal",
        "Brands|fa-empire",
        "Brands|fa-facebook",
        "Brands|fa-facebook-square",
        "Brands|fa-foursquare",
        "Brands|fa-ge",
        "Brands|fa-git",
        "Brands|fa-git-square",
        "Brands|fa-github",
        "Brands|fa-github-alt",
        "Brands|fa-github-square",
        "Brands|fa-gittip",
        "Brands|fa-google",
        "Brands|fa-google-plus",
        "Brands|fa-google-plus-square",
        "Brands|fa-google-wallet",
        "Brands|fa-hacker-news",
        "Brands|fa-html5",
        "Brands|fa-instagram",
        "Brands|fa-ioxhost",
        "Brands|fa-joomla",
        "Brands|fa-jsfiddle",
        "Brands|fa-lastfm",
        "Brands|fa-lastfm-square",
        "Brands|fa-linkedin",
        "Brands|fa-linkedin-square",
        "Brands|fa-linux",
        "Brands|fa-maxcdn",
        "Brands|fa-meanpath",
        "Brands|fa-openid",
        "Brands|fa-pagelines",
        "Brands|fa-paypal",
        "Brands|fa-pied-piper",
        "Brands|fa-pied-piper-alt",
        "Brands|fa-pinterest",
        "Brands|fa-pinterest-square",
        "Brands|fa-qq",
        "Brands|fa-ra",
        "Brands|fa-rebel",
        "Brands|fa-reddit",
        "Brands|fa-reddit-square",
        "Brands|fa-renren",
        "Brands|fa-share-alt",
        "Brands|fa-share-alt-square",
        "Brands|fa-skype",
        "Brands|fa-slack",
        "Brands|fa-slideshare",
        "Brands|fa-soundcloud",
        "Brands|fa-spotify",
        "Brands|fa-stack-exchange",
        "Brands|fa-stack-overflow",
        "Brands|fa-steam",
        "Brands|fa-steam-square",
        "Brands|fa-stumbleupon",
        "Brands|fa-stumbleupon-circle",
        "Brands|fa-tencent-weibo",
        "Brands|fa-trello",
        "Brands|fa-tumblr",
        "Brands|fa-tumblr-square",
        "Brands|fa-twitch",
        "Brands|fa-twitter",
        "Brands|fa-twitter-square",
        "Brands|fa-vimeo-square",
        "Brands|fa-vine",
        "Brands|fa-vk",
        "Brands|fa-wechat",
        "Brands|fa-weibo",
        "Brands|fa-weixin",
        "Brands|fa-windows",
        "Brands|fa-wordpress",
        "Brands|fa-xing",
        "Brands|fa-xing-square",
        "Brands|fa-yahoo",
        "Brands|fa-yelp",
        "Brands|fa-youtube",
        "Brands|fa-youtube-play",
        "Brands|fa-youtube-square"
    );
    return $faraw;

}

// ==========================================
include 'v1_pluginroutines.php';
// include 'v1_pluginroutines2.php';
// ==========================================


?>
