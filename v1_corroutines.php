<?php
function Cor_SETUPCORUSER_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Cor_SETUPCORUSER_Output() {
	$parm0 = "";
	$parm0 = $parm0."Users"."|"; # pagetitle
	$parm0 = $parm0."coruser"."|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname]|"; # othertables
	$parm0 = $parm0."coruser_domanid|"; # keyfieldname
	$parm0 = $parm0."coruser_domanid|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."coruser_domanid|Yes|Domain id|120|Yes|Domain Id|KeyText,25,25^";
	$parm1 = $parm1."coruser_superuserlist||||Yes|Super Users|InputPersonArea,2,100,superusers,Lookup^";
	$parm1 = $parm1."coruser_primeuserlist||||Yes|Prime Users|InputPersonArea,2,100,primeusers,Lookup^";
	$parm1 = $parm1."coruser_otheruserlist||||Yes|Other Users|InputPersonArea,2,100,otherusers,Lookup^";
	$parm1 = $parm1."coruser_readonlyuserlist||||Yes|Read Only Users|InputPersonArea,2,100,readonlyusers,Lookup^";	
	$parm1 = $parm1."coruser_summaryonlyuserlist||||Yes|Summary Only Users|InputPersonArea,2,100,summaryonlyusers,Lookup^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40",
"field,superusers,Select,coruser_superuserlist_input,coruser_superuserlist_personlist,80|
field,primeusers,Select,coruser_primeuserlist_input,coruser_primeuserlist_personlist,80|
field,otherusers,Select,coruser_otheruserlist_input,coruser_otheruserlist_personlist,80|
field,readonlyusers,Select,coruser_readonlyuserlist_input,coruser_readonlyuserlist_personlist,80|
field,summaryonlyusers,Select,coruser_summaryonlyuserlist_input,coruser_summaryonlyuserlist_personlist,80",
"person_id",
"active",
"corusers,50,50,400,400","view",
"buildfulllist"
	);
}

function Cor_SETUPCORPROGRAMME_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";    
}

function Cor_SETUPCORPROGRAMME_Output() {
    $parm0 = "";
    $parm0 = $parm0."Programmes"."|"; # pagetitle
    $parm0 = $parm0."corprogramme"."|"; # primetable
    $parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname]|"; # othertables
    $parm0 = $parm0."corprogramme_name|"; # keyfieldname
    $parm0 = $parm0."corprogramme_name|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."corprogramme_name|Yes|Name|120|Yes|Programme Name|KeyText,8,8^";
    $parm1 = $parm1."corprogramme_description|Yes|Description|200|Yes|Description|InputText,80,100^";
    $parm1 = $parm1."corprogramme_title|Yes|Title|100|Yes|Title|InputText,50,100^";
    $parm1 = $parm1."corprogramme_seq|Yes|Seq|100|Yes|Sequence|InputText,6,10^";
    $parm1 = $parm1."corprogramme_icontext|Yes|Icon Text|60|Yes|Icon Text|InputText,2,2^";
    $parm1 = $parm1."corprogramme_iconcolor|Yes|Icon Colour|80|Yes|Icon Colour|InputSelectFromList,Blue+Green+Silver+Amber+Magneta^";
    $parm1 = $parm1."corprogramme_authorised|Yes|Confidentiality|100|Yes|Authorised|InputSelectFromList,All+AuthorisedOnly^";
    $parm1 = $parm1."corprogramme_authorisedpersonidlist||||Yes|Authorised Users|InputPersonArea,2,100,authorisedusers,Lookup^";      
    $parm1 = $parm1."corprogramme_default|Yes|Default|60|Yes|Default(include blank programmes)|InputSelectFromList,Yes+No^"; 
    $parm1 = $parm1."corprogramme_customtablist||||Yes|Custom Tabs|InputCheckboxFromList,FA2+FA3^"; 
    $parm1 = $parm1."corprogramme_upliftcorsharepercent||||Yes|Cordage Uplift %|InputText,6,6^";
    $parm1 = $parm1."corprogramme_upliftclientsharepercent||||Yes|Client Uplift %|InputText,6,6^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
    $GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40",
"field,authorisedusers,Select,corprogramme_authorisedpersonidlist_input,corprogramme_authorisedpersonidlist_personlist,80",
"person_id",
"active",
"corusers,50,50,400,400","view",
"buildfulllist"
    );
}

function Cor_SETUPCORSURVEYCATEGORY_Output() {
	$parm0 = "";
	$parm0 = $parm0."Survey Type"."|"; # pagetitle
	$parm0 = $parm0."corsurveycategory"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."corsurveycategory_id|"; # keyfieldname
	$parm0 = $parm0."corsurveycategory_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."corsurveycategory_id|Yes|Type|120|Yes|Survey Type|KeyText,15,25^";
	$parm1 = $parm1."corsurveycategory_description||||Yes|Description|InputText,50,100^";
	$parm1 = $parm1."corsurveycategory_seq|Yes|Seq|60|Yes|Sequence|InputText,50,100^";	
	$parm1 = $parm1."corsurveycategory_showbydefault|Yes|Default Show|100|Yes|Show By Default|InputSelectFromList,Yes+No^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);		
}

function Cor_SETUPCOROUTLETCLASS_Output() {
	$parm0 = "";
	$parm0 = $parm0."Outlet Clases"."|"; # pagetitle
	$parm0 = $parm0."coroutletclass"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."coroutletclass_id|"; # keyfieldname
	$parm0 = $parm0."coroutletclass_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."coroutletclass_id|Yes|Outlet Class Id|120|Yes|Outlet Class Id|KeyText,8,8^";
	$parm1 = $parm1."coroutletclass_name|Yes|Class Name|120|Yes|Outlet Class Name|InputText,50,100^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Cor_SETUPCOROUTLETCO_Output() {
	$parm0 = "";
	$parm0 = $parm0."Outlets"."|"; # pagetitle
	$parm0 = $parm0."coroutletco"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."coroutletco_id|"; # keyfieldname
	$parm0 = $parm0."coroutletco_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."coroutletco_id|Yes|Outlet Id|120|Yes|Outlet Id|KeyText,8,8^";
	$parm1 = $parm1."coroutletco_name|Yes|Outlet Name|120|Yes|Outlet Name|InputText,50,100^";
	$parm1 = $parm1."coroutletco_description|Yes|Outlet Description|120|Yes|Outlet Description|InputText,50,100^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Cor_SETUPCORSUPPLIER_Output() {
	$parm0 = "";
	$parm0 = $parm0."Suppliers"."|"; # pagetitle
	$parm0 = $parm0."corsupplier"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."corsupplier_id|"; # keyfieldname
	$parm0 = $parm0."corsupplier_id|"; # sortfieldname
	$parm0 = $parm0."50|"; # pagination
	$parm0 = $parm0."Yes"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."corsupplier_id|Yes|Supplier id|120|Yes|Survey Category|KeyText,15,15^";
	$parm1 = $parm1."corsupplier_name|Yes|Name|100|Yes|Supplier Name|InputText,50,100^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Cor_SETUPCORACCOUNT_Output() {
	$parm0 = "";
	$parm0 = $parm0."Account"."|"; # pagetitle
	$parm0 = $parm0."coraccount"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."coraccount_id|"; # keyfieldname
	$parm0 = $parm0."coraccount_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."coraccount_id|Yes|Account Id|120|Yes|Account Code|KeyText,15,15^";
	$parm1 = $parm1."coraccount_name||||Yes|Account Nmae|InputText,50,100^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Cor_SETUPCORPHASE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Project Phases"."|"; # pagetitle
	$parm0 = $parm0."corphase"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."corphase_name|"; # keyfieldname
	$parm0 = $parm0."corphase_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."corphase_name|Yes|Phase|120|Yes|Project Phase|KeyText,20,40^";
	$parm1 = $parm1."corphase_description|Yes|Description|120|Yes|Description|InputText,50,100^";
	$parm1 = $parm1."corphase_seq|Yes|Seq|60|Yes|Sequence|InputText,5,7^";
	$parm1 = $parm1."corphase_includeinactivelist|Yes|Active|70|Yes|Include in Active List|InputSelectFromList,Yes+No^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Cor_SETUPCORCLASSIFICATION_Output() {
    $parm0 = "";
    $parm0 = $parm0."Site Classification"."|"; # pagetitle
    $parm0 = $parm0."corclassification"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."corclassification_name|"; # keyfieldname
    $parm0 = $parm0."corclassification_seq|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."corclassification_name|Yes|Classification|120|Yes|Site Classification|KeyText,20,40^";
    $parm1 = $parm1."corclassification_description|Yes|Description|120|Yes|Description|InputText,50,100^";
    $parm1 = $parm1."corclassification_seq|Yes|Seq|60|Yes|Sequence|InputText,5,7^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}


function Cor_SETUPAPPROVALSTATUS_Output() {
    $parm0 = "";
    $parm0 = $parm0."Approval Status Types"."|"; # pagetitle
    $parm0 = $parm0."corapprovalstatus"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."corapprovalstatus_name|"; # keyfieldname
    $parm0 = $parm0."corapprovalstatus_seq|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."corapprovalstatus_name|Yes|Approval Status Type|120|Yes|Approval Status Type|KeyText,20,40^";
    $parm1 = $parm1."corapprovalstatus_description|Yes|Description|120|Yes|Description|InputText,50,100^";
    $parm1 = $parm1."corapprovalstatus_seq|Yes|Seq|60|Yes|Sequence|InputText,5,7^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Cor_SETUPCORSCHEME_Output() {
	$parm0 = "";
	$parm0 = $parm0."Scheme"."|"; # pagetitle
	$parm0 = $parm0."corscheme"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."corscheme_name|"; # keyfieldname
	$parm0 = $parm0."corscheme_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."corscheme_name|Yes|Scheme|120|Yes|Scheme|KeyText,15,15^";
	$parm1 = $parm1."corscheme_description||||Yes|Description|InputText,50,100^";
	$parm1 = $parm1."corscheme_seq|Yes|Seq|60|Yes|Sequence|InputText,5,7^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);	
}

function Cor_SETUPCORSITETYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Site Type"."|"; # pagetitle
	$parm0 = $parm0."corsitetype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."corsitetype_name|"; # keyfieldname
	$parm0 = $parm0."corsitetype_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."corsitetype_name|Yes|Site Type|120|Yes|Site Type|KeyText,15,15^";
	$parm1 = $parm1."corsitetype_description||||Yes|Description|InputText,50,100^";
	$parm1 = $parm1."corsitetype_seq|Yes|Seq|60|Yes|Sequence|InputText,5,7^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Cor_SETUPCORDEFAULTVALUE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Default Values"."|"; # pagetitle
	$parm0 = $parm0."cordefaultvalue"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."cordefaultvalue_fieldname|"; # keyfieldname
	$parm0 = $parm0."cordefaultvalue_fieldname|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."cordefaultvalue_fieldname|Yes|Field|120|Yes|Field Name|KeyText,50,100^";
	$parm1 = $parm1."cordefaultvalue_description|Yes|Description|200|Yes|Description|InputText,50,100^";
	$parm1 = $parm1."cordefaultvalue_value|Yes|Value|60|Yes|Value|InputText,6,10^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Cor_CORRESETHISTORYUPLOAD_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
	// $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin,dropzonesettings";
}

function Cor_CORRESETHISTORYUPLOAD_Output () {
	
	XH3("Cordage Database Initial Reset and Load");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMUPLOAD("corresethistoryuploadin.php","upload");
	XINSTDHID();
	XINFILE("file","100000") ;XBR();XBR();
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMIT("Upload!");
	X_FORM();	
	
	/*
	XH3("Cordage Database Initial Reset and Load");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMDROPZONE("corresethistoryuploadin.php","dropzoneform");
	XINSTDHID();
	print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
	print '<span>Drop files here to upload.. or click to browse.</span>'."\n";
	print '</div>'."\n";
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMITID("dropzonesubmit","Upload!");
	X_FORM();
	*/
}

function Cor_CORMASTERHISTORYUPLOAD_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
	// $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin,dropzonesettings";
}

function Cor_CORMASTERHISTORYUPLOAD_Output () {
	
	XH3("Cordage Database Master Tracker Data Load");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMUPLOAD("cormasterhistoryuploadin.php","upload");
	XINSTDHID();
	XPTXT("File Containing Data:-");
	XINFILE("file","100000") ;XBR();XBR();
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMIT("Upload!");
	X_FORM();
	
	/*	
	XH3("Cordage Database Master Tracker Data Load");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMDROPZONE("cormasterhistoryuploadin.php","dropzoneform");
	XINSTDHID();
	print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
	print '<span>Drop files here to upload.. or click to browse.</span>'."\n";
	print '</div>'."\n";
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMITID("dropzonesubmit","Upload!");
	X_FORM();
	*/
}

function Cor_CORSITEADHOCUPLOAD_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
	// $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin,dropzonesettings";
}

function Cor_CORSITEADHOCUPLOAD_Output () {
	
	XH3("Cordage Site Ad Hoc Upload");
	XPTXT('This is used to upload existing spreadsheet information to the database. The spreadsheet must contain a "Header" row to identify fields and "Data" rows for each site.');
	XPTXT('Matching is done by one of the following fields. - "corsite_arkpostcode", "corsite_site" or "corsite_tabname".');	
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMUPLOAD("corsiteadhocuploadin.php","upload");
	XINSTDHID();
	XPTXT("File Containing Data:-");
	XINFILE("file","100000") ;XBR();XBR();
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMIT("Upload!");
	X_FORM();
	
	/*
	XH3("Cordage Site Ad Hoc Upload");
	XPTXT('This is used to upload existing spreadsheet information to the database. The spreadsheet must contain a "Header" row to identify fields and "Data" rows for each site.');
	XPTXT('Matching is done by one of the following fields. - "corsite_arkpostcode", "corsite_site" or "corsite_tabname".');	
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMDROPZONE("corsiteadhocuploadin.php","dropzoneform");
	XINSTDHID();
	print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
	print '<span>Drop files here to upload.. or click to browse.</span>'."\n";
	print '</div>'."\n";
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMITID("dropzonesubmit","Upload!");
	X_FORM();
	*/
}

function Cor_CORARKUPLOAD_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
	// $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin,dropzonesettings";
}

function Cor_CORARKUPLOAD_Output () {

	XH3("Cordage ARK Upload");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMUPLOAD("corarkuploadin.php","upload");
	XINSTDHID();
	XPTXT("File Containing Data:-");
	XINFILE("file","100000") ;XBR();XBR();
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMIT("Upload!");
	X_FORM();
	
	/*
	XH3("Cordage ARK Upload");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMDROPZONE("corarkuploadin.php","dropzoneform");
	XINSTDHID();
	print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
	print '<span>Drop files here to upload.. or click to browse.</span>'."\n";
	print '</div>'."\n";
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMITID("dropzonesubmit","Upload!");
	X_FORM();
	*/

}

function Cor_CORIMGHISTORYUPLOAD_Output () {
	XH3("Cordage Image Data Load");
	XPTXT("This action will link in images already loaded onto the site (initial load only).");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");	
	XBR();
	XFORM("corimghistoryuploadin.php","");
	XH5("Decide whether to preview the results before finalising.");
	XTABLEINVISIBLE();
	XTR();XTDINRADIO("TestorReal","T","checked","Test Mode - view proposed updates");X_TR();
	XTR();XTDINRADIO("TestorReal","R","","Real Mode - make updates permanent");X_TR();
	XTR();XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	XINSTDHID();
	X_FORM();
}

function Cor_CORSAGEUPLOAD_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
	// $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin,dropzonesettings";
}

function Cor_CORSAGEUPLOAD_Output () {
	XH3("Cordage SAGE Initial Load");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMUPLOAD("corsageuploadin.php","upload");
	XINSTDHID();
	XPTXT("File Containing Data:-");
	XINFILE("file","100000") ;XBR();XBR();
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMIT("Upload!");
	X_FORM();
	
	/*	
	XH3("Cordage SAGE Initial Load");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMDROPZONE("corsageuploadin.php","dropzoneform");
	XINSTDHID();
	print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
	print '<span>Drop files here to upload.. or click to browse.</span>'."\n";
	print '</div>'."\n";
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMITID("dropzonesubmit","Upload!");
	X_FORM();
	*/
}

function Cor_CORLANDREGISTRYUPLOAD_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
	// $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin,dropzonesettings";
}

function Cor_CORLANDREGISTRYUPLOAD_Output () {
	
	XH3("Cordage Land Registry Load");
	XPTXT("This action will load Land Registry links data to the site.");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMUPLOAD("corlandregistryuploadin.php","upload");
	XINSTDHID();
	XPTXT("File Containing Data:-");
	XINFILE("file","100000") ;XBR();XBR();
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMIT("Upload!");
	X_FORM();
		
	/*
	XH3("Cordage Land Registry Load");
	XPTXT("This action will load Land Registry links data to the site.");
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XFORMDROPZONE("corlandregistryuploadin.php","dropzoneform");
	XINSTDHID();
	print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
	print '<span>Drop files here to upload.. or click to browse.</span>'."\n";
	print '</div>'."\n";
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMITID("dropzonesubmit","Upload!");
	X_FORM();
	*/
}

function Cor_CORSITELIST_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function Cor_CORSITELIST_Output($activeorfull,$thisprogramme) {

    XH2("Cordage Property Management - ".$thisprogramme);
	XBR();XBR();

	$GLOBALS{'corlevel'} = 0;
	if ( $GLOBALS{'service_cor'} != "" ) {
		Check_Data('coruser');
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_summaryonlyuserlist'})) {$GLOBALS{'corlevel'} = 1;}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_readonlyuserlist'})) {$GLOBALS{'corlevel'} = 2;}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_otheruserlist'})) {$GLOBALS{'corlevel'} = 3;}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_primeuserlist'})) {$GLOBALS{'corlevel'} = 4;}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_superuserlist'})) {$GLOBALS{'corlevel'} = 5;}
		if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {$GLOBALS{'corlevel'} = 5;}
	}	
	if ( $GLOBALS{'corlevel'} > 3 ) {
	    XFORMUPLOADNEWWINDOW("corsiteupdateout.php","New_Site","newsite");
		XINSTDHID();
		XINHID("corsite_id","new");
		XINHID("corsite_version","Live");
		XINHID("corsite_corprogramme",$thisprogramme);
		XINSUBMIT("Create New Site");
		X_FORM();
	}
	
	XFORM("corsitelistout.php","reloadlist");
	XINSTDHID();
	XINHID("FullActive",$activeorfull);
	XINHID("corsite_corprogramme",$thisprogramme);
	BROW();	BCOLTXT("","10"); BCOL("2"); BINSUBMITIDSPECIAL ("refreshlist","info","Reload List"); B_COL(); B_ROW();
	X_FORM();
	
	$personprogrammeauthorised = "0";
	$blankdefaultprogramme = "0";
	Check_Data('corprogramme',$thisprogramme);
	if ($GLOBALS{'IOWARNING'} == "0") {	
	    if ( $GLOBALS{'corprogramme_default'} == "Yes" ) {
	        $blankdefaultprogramme= "1";
	    }
	    if ( $GLOBALS{'corprogramme_authorised'} == "All" ) {
	        $personprogrammeauthorised = "1";
	    } else {
    	    if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'corprogramme_authorisedpersonidlist'})) {	        
    	        $personprogrammeauthorised = "1";
    	    }
	    }
	}
	
	XBR();	
	XDIV("reportdiv","container");
	XTABLEJQDTID("reporttable_list");
	XTHEAD();
	XTRJQDT();
	if ( $GLOBALS{'corlevel'} == 5 ) {
	    XTDHTXT("Site Id");
	}
	XTDHTXT("Pub Ref");
	XTDHTXT("Fin Ref");	
	XTDHTXT("Pub Name");
	XTDHTXT("Region");		
	XTDHTXT("Version");	
	XTDHTXT("Proj Mgr");
	XTDHTXT("Admin");
	XTDHTXT("Status");
	XTDHTXT("Ph1 RAG");	
	XTDHTXT("Ph2 RAG");		
	XTDHTXT("Batch");
	XTDHTXT("");
	if ( $GLOBALS{'corlevel'} == 5 ) {
		XTDHTXT("");			
		XTDHTXT("");
	}
	XTDHTXT("");
	XTDHTXT("Locked");
	X_TR();
	X_THEAD();
	XTBODY();
	XINHID("list_sortcol","0");
	
	$corphase_includeinactivelista = Array();
	$corphase_namea = Get_Array('corphase');
	foreach ($corphase_namea as $corphase_name) {	
		Get_Data('corphase',$corphase_name);
		$corphase_includeinactivelista[$corphase_name] = $GLOBALS{'corphase_includeinactivelist'};
	}

	$corsite2keya = Get_2Key_Array('corsite');
	foreach ($corsite2keya as $corsite2key) {
		$corsitekeya = explode('|',$corsite2key);	
		$corsite_id = $corsitekeya[0];
		$corsite_version = $corsitekeya[1];
		Check_Data('corsite',$corsite_id,$corsite_version);	
		if ($GLOBALS{'IOWARNING'} == "0") {		
			// check that site status for inclusion
		    $includestatus = "0";
			if ( $activeorfull == "Active" ) {
				if (array_key_exists($GLOBALS{'corsite_status'}, $corphase_includeinactivelista)) {
				    if ($corphase_includeinactivelista[$GLOBALS{'corsite_status'}] == "Yes" ) { $includestatus = "1"; }
				}
			} else {
			    $includestatus = "1";
			}
			
			// check person is authorised to see this programme
			$includeprogramme = "0"; $includeblankprogramme = "0";
			if ( $thisprogramme == "" ) {
			    $includeprogramme = "1";
			} else {
			    if ($thisprogramme == $GLOBALS{'corsite_corprogramme'}) {
			        $includeprogramme = "1";
			    }
			    if ($GLOBALS{'corsite_corprogramme'} == "") {
			        if ($blankdefaultprogramme == "1") {
			            $includeprogramme = "1";
			            $includeblankprogramme = "1";
			        }
			    }
			}
			if ($personprogrammeauthorised != "1") { $includeprogramme = "0"; }
			
			if ( ($includestatus == "1")&&($includeprogramme == "1") ) {
				XTRJQDT();	
				if ( $GLOBALS{'corlevel'} == 5 ) {
				    XTDTXT($GLOBALS{'corsite_id'});
				}
				XTDTXT($GLOBALS{'corsite_arkname'});
				XTDTXT($GLOBALS{'corsite_arkfinref'});
				if ( $includeblankprogramme == "1" ) { XTDTXTRED($GLOBALS{'corsite_site'}); }
				else { XTDTXT($GLOBALS{'corsite_site'}); }
				$shortsite = substr($GLOBALS{'corsite_site'}."            ",0,12).$GLOBALS{'corsite_version'};
				XTDTXT($GLOBALS{'corsite_arkregion'});
				if ($GLOBALS{'corsite_version'} == "Live") { XTDTXT($GLOBALS{'corsite_version'}); }
				else {XTDTXTCOLOR($GLOBALS{'corsite_version'},NameToSwatch($GLOBALS{'corsite_version'}));}
				XTDTXT($GLOBALS{'corsite_projectmgrid'});
				XTDTXT($GLOBALS{'corsite_admin'});						
				XTDTXT($GLOBALS{'corsite_status'});
				XTDTXT($GLOBALS{'corsite_proposalph1ragstatus'});	
				XTDTXT($GLOBALS{'corsite_proposalnewrag'});				
				XTDTXT($GLOBALS{'corsite_batch'});
				$link = YPGMLINK("corsiteupdateout.php");
				$link = $link.YPGMSTDPARMS().YPGMPARM("corsite_id",$corsite_id).YPGMPARM("corsite_version",$corsite_version).YPGMPARM("corsite_corprogramme",$thisprogramme);
				// XTDLINKTXT($link,"manage");
				if ( $GLOBALS{'corlevel'} > 2 ) { XTDCLASSLINKTXTNEWWINDOW('updatelink',$link,"manage",$shortsite); }
				else { XTDCLASSLINKTXTNEWWINDOW('updatelink',$link,"view",$shortsite); }	
				if ( $GLOBALS{'corlevel'} == 5 ) {
					$link = YPGMLINK("corsitedatabaseout.php");
					$link = $link.YPGMSTDPARMS().YPGMPARM("corsite_id",$corsite_id).YPGMPARM("corsite_version",$corsite_version);
					XTDLINKTXT($link,"database");		
					$link = YPGMLINK("corsitedeleteconfirm.php");
					$link = $link.YPGMSTDPARMS().YPGMPARM("corsite_id",$corsite_id).YPGMPARM("corsite_version",$corsite_version).YPGMPARM("List","CORSITELIST");
					XTDCLASSLINKTXTNEWWINDOW('deletelink',$link,"delete",$shortsite);
				}
				if ($GLOBALS{'corsite_lockedpersonid'} != "") {
				    if ($GLOBALS{'corsite_lockedpersonid'} == $GLOBALS{'LOGIN_person_id'}) { XTDIMGFLEX("../site_assets/miniLockedByMe.png"); }
				    else { XTDIMGFLEX("../site_assets/miniLockedByOther.png");  }
					XTDTXT($GLOBALS{'corsite_lockedpersonid'}." ".TimestamptoDDMMMbHHcMM($GLOBALS{'corsite_lockedtimestamp'}));
				} else {
					XTDTXT("");
					XTDTXT("");
				}
				X_TR();
			}
		}
	}
	X_TBODY();
	X_TABLE();
	X_DIV("reportdiv");
	XCLEARFLOAT();
}

// special cor number formatting

// class			Database		Display/Input	phpout		  javascript	phpin	
// rag              tinytext		Y(colour)					
// calcin			decimal(8)		n,nnn,nnn		D80ToN80	N80ToF	FToN80	N80ToD80					
// calcinpercent    decimal(5,2)	nn.nn%			D82ToP82	P82ToF	FToP82	P82ToD82	
// calcres          decimal(8)		n,nnn,nnn		D80ToN80	N80ToF	FToN80	N80ToD80
// calcrespercent	decimal(5,2)	nn.nn%			D82ToP82	P82ToF	FToP82	P82ToD82	

function D80ToN80 ($numin) { 
	if (is_string($numin)) { $numin = floatval($numin); }
	return number_format($numin); 
}
function D82ToN82 ($numin) { 
	if (is_string($numin)) { $numin = floatval($numin); }
	return number_format($numin,2); 
}
function D82ToP82 ($numin) { 
	if (is_string($numin)) { $numin = floatval($numin); }	
	return number_format($numin,2).'%'; 
}
function N80ToD80 ($numstring) {
	$numstring = str_replace(',', '', $numstring);
	$numstring = str_replace('(', '', $numstring);
	$numstring = str_replace(')', '', $numstring);
	return intval($numstring);
}
function N82ToD82 ($numstring) {
	$numstring = str_replace(',', '', $numstring);
	$numstring = str_replace('(', '', $numstring);
	$numstring = str_replace(')', '', $numstring);	
	return floatval($numstring);
}
function P82ToD82 ($numstring) {
	$numstring = str_replace('%', '', $numstring);
	return floatval($numstring);
}

function Cor_CORSITEUPDATE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,corsiteupdate,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,corsiteupdate,slimjquerymin,slimimagepopup,bootstrapdatepicker,areyousure,jqueryconfirm";
}


function Cor_CORSITEUPDATE_Output($corsite_id,$corsite_version,$thiscorsite_corprogramme,$currenttab) {
    // $thiscorsite_corprogramme only required if new
    Get_Data('corprogramme',$thiscorsite_corprogramme);
    $GLOBALS{'corlevel'} = 0;
	if ( $GLOBALS{'service_cor'} != "" ) {
		Check_Data('coruser');
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_summaryonlyuserlist'})) {$GLOBALS{'corlevel'} = 1;}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_readonlyuserlist'})) {$GLOBALS{'corlevel'} = 2;}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_otheruserlist'})) {$GLOBALS{'corlevel'} = 3;}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_primeuserlist'})) {$GLOBALS{'corlevel'} = 4;}
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_superuserlist'})) {$GLOBALS{'corlevel'} = 5;}
		if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {$GLOBALS{'corlevel'} = 5;}
	}	
	
	$tabviz = Array();
	// Note" Include 0 for future expandibility - set to same as 1 just in case
	$tabviz["LOC"] = Array("1","1","1","1","1","1");
	$tabviz["STAT"] = Array("1","1","1","1","1","1");
	$tabviz["ASS1"] = Array("1","1","1","1","1","1");
	$tabviz["ASS2"] = Array("1","1","1","1","1","1");
	$tabviz["FA1"] = Array("0","0","1","0","1","1");
	if (FoundInCommaList("FA2",$GLOBALS{'corprogramme_customtablist'})) { $tabviz["FA2"] = Array("0","0","1","0","1","1"); }
	else { $tabviz["FA2"] = Array("0","0","0","0","0","0"); }
	if (FoundInCommaList("FA3",$GLOBALS{'corprogramme_customtablist'})) { $tabviz["FA3"] = Array("0","0","1","0","1","1"); }
	else { $tabviz["FA3"] = Array("0","0","0","0","0","0"); }
	$tabviz["PLNG"] = Array("0","0","1","1","1","1");
	$tabviz["PLNS"] = Array("1","1","1","1","1","1");
	$tabviz["FIN"] = Array("0","0","1","0","1","1");
	$tabviz["SALE"] = Array("0","0","1","0","1","1");
	$tabviz["NOT"] = Array("0","0","1","0","1","1");
	$tabviz["COM"] = Array("0","0","1","0","1","1");
	
	if ($corsite_id == "new") {
	    Initialise_Data('corsite');
	    $corsite_ida = Get_Array('corsite');
	    $cordefaultvaluea = Get_Array('cordefaultvalue');
	    foreach ($cordefaultvaluea as $cordefaultvalue_fieldname) {
	        Get_Data('cordefaultvalue',$cordefaultvalue_fieldname);
	        $GLOBALS{$cordefaultvalue_fieldname} = floatval($GLOBALS{'cordefaultvalue_value'});
	        $GLOBALS{'corsite_status'} = "Dormant";
	    }
	    $headingtext = $GLOBALS{'corsite_site'}."Create new ".$thiscorsite_corprogramme." site";
	} else {
	    Get_Data('corsite', $corsite_id , $corsite_version);
	    $thiscorsite_corprogramme = $GLOBALS{'corsite_corprogramme'};
	    if ( $corsite_version == "Live" ) { $versiontext = "";  }
	    else { $versiontext = ' - <span style="color:'.NameToSwatch($corsite_version).'" > <b>'.$corsite_version.' Version</b></span>';  }
	    if ( $corsite_version == "Live" ) { $versiontext = ""; }
	    else { $versiontext = ' - <span style="color:'.NameToSwatch($corsite_version).'" > <b>'.$corsite_version.' Version</b></span>'; }
	    $headingtext = $GLOBALS{'corsite_site'}." (".$GLOBALS{'corsite_arkregion'}.") ".$versiontext;
	    $tabtitle = substr($GLOBALS{'corsite_site'},0,15)."-".$corsite_version;
	}
	
	XBR();	

	BROW();
	BCOLBOTTOM("10");
	XH3($headingtext);
	XTXT($GLOBALS{'corsite_arkfinref'}." / ".$GLOBALS{'corsite_arksecuritisation'});
	B_COL();
	$srca = $GLOBALS{'domainwwwurl'}."/domain_style/";
	$ragfound = "0"; $approvedfound = "0";
	BCOL("2");
	if ($GLOBALS{'corsite_proposalnewrag'} == "Green") {
		BINBUTTONIDSPECIAL ("RAGButton","success btn-block","Assessment - Green");$ragfound = "1";
	}
	if ($GLOBALS{'corsite_proposalnewrag'} == "Amber") {
		BINBUTTONIDSPECIAL ("RAGButton","warning btn-block","Assessment - Amber");$ragfound = "1";
	}
	if ($GLOBALS{'corsite_proposalnewrag'} == "Red") {
		BINBUTTONIDSPECIAL ("RAGButton","danger btn-block","Assessment - Red");$ragfound = "1";
	}
	if ($ragfound == "0") {
	    BINBUTTONIDSPECIAL ("RAGButton","default btn-block","No Assessment");
	}
	BINBUTTONIDSPECIAL ("ApprovedButton","default btn-block",$GLOBALS{'corsite_approved'});
	
	B_COL();
	B_ROW();	
	
	$GLOBALS{'CROPPARMS'} = Array();	
	
	XFORMUPLOAD("corsiteupdatein.php","corsiteupdateform");
	XINSTDHID();
	XINHID("corsite_id",$corsite_id);
	XINHID("corsite_version",$GLOBALS{'corsite_version'});
	XINHID("corsite_corprogramme",$thiscorsite_corprogramme);
	XINHID("corprogramme_customtablist",$GLOBALS{'corprogramme_customtablist'});
	XINHID("TabTitle",$tabtitle);
	XINHID("SubmitAction","");	
	XINHID("CurrentTab",$currenttab);
	XINHID("coruserlevel",$GLOBALS{'corlevel'});		
	XINHID("corsite_lockedtimestamp",$GLOBALS{'corsite_lockedtimestamp'});	
	XINHID("corsite_lockedpersonid",$GLOBALS{'corsite_lockedpersonid'});
	XINHID("corsite_lastupdatetimestamp",$GLOBALS{'corsite_lastupdatetimestamp'});
	XINHID("corsite_lastupdatepersonid",$GLOBALS{'corsite_lastupdatepersonid'});
	XHR();
	BROW();
	$sep = "";
	$projectmgrtext = "";
	if ($GLOBALS{'corsite_projectmgrid'} != "") { $projectmgrtext = "Project Mananger - ".$GLOBALS{'corsite_projectmgrid'}; $sep = " / ";}
	$admintext = "";
	if ($GLOBALS{'corsite_admin'} != "") {
		$admintext = "Administration - ".$GLOBALS{'corsite_admin'};
	}	
	BCOLTXT($projectmgrtext.$sep.$admintext,"4");
	BCOL("8");	
	XDIVRIGHT("phases","");
	if ($GLOBALS{'corsite_status'} == "Pending Review") { BINBUTTONIDSPECIAL ("Pending_Review","success","Pending Review"); }
	else { BINBUTTONIDSPECIAL ("Pending_Review","secondary","Pending Review"); }	
	if ($GLOBALS{'corsite_status'} == "Assessment") { BINBUTTONIDSPECIAL ("Assessment","success","Assessment"); }
	else { BINBUTTONIDSPECIAL ("Assessment","secondary","Assessment"); }	
	if ($GLOBALS{'corsite_status'} == "Neg-PrePlanning") { BINBUTTONIDSPECIAL ("Neg-PrePlanning","success","Neg-PrePlanning"); }
	else { BINBUTTONIDSPECIAL ("Neg-PrePlanning","secondary","Neg-PrePlanning"); }	
	if ($GLOBALS{'corsite_status'} == "Planning") { BINBUTTONIDSPECIAL ("Planning","success","Planning"); }
	else { BINBUTTONIDSPECIAL ("Planning","secondary","Planning"); }	
	if (($GLOBALS{'corsite_status'} == "Sale")||($GLOBALS{'corsite_salestatus'} == "On Market")) { 
	    BINBUTTONIDSPECIAL ("Sale","success","Sale"); 
	} else { 
	    BINBUTTONIDSPECIAL ("Sale","secondary","Sale"); 
	}	
	if (($GLOBALS{'corsite_status'} == "Legals")||($GLOBALS{'corsite_salestatus'} == "Legals")||($GLOBALS{'corsite_salestatus'} == "Exchanged")) { 
	    BINBUTTONIDSPECIAL ("Legals","success","Legals"); 
	} else { 
	    BINBUTTONIDSPECIAL ("Legals","secondary","Legals"); 
	}
	if (($GLOBALS{'corsite_status'} == "Sold")||($GLOBALS{'corsite_salestatus'} == "Completed")) { 
	    BINBUTTONIDSPECIAL ("Sold","success","Sold"); 
	} else { 
	    BINBUTTONIDSPECIAL ("Sold","secondary","Sold"); 
	}	
	if ($GLOBALS{'corsite_status'} == "Construction") { BINBUTTONIDSPECIAL ("Construction","success","Construction"); }
	else { BINBUTTONIDSPECIAL ("Construction","secondary","Construction"); }		
	if ($GLOBALS{'corsite_status'} == "Shelved") { BINBUTTONIDSPECIAL ("Shelved","success","Shelved"); }
	else { BINBUTTONIDSPECIAL ("Shelved","secondary","Shelved"); }	
	if ($GLOBALS{'corsite_status'} == "Dropped") { BINBUTTONIDSPECIAL ("Dropped","success","Dropped"); }
	else { BINBUTTONIDSPECIAL ("Dropped","secondary","Dropped"); }
	X_DIV("phases");

	B_COL();
	B_ROW();
	XHR();
	BROW();
	
	if ($GLOBALS{'corsite_proposalimage1'} == "" ) { BCOLIMG("../site_assets/NoImage_Flex.png","100","1"); }
	else { BCOLIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'corsite_proposalimage1'},"100","1"); }
	if ($GLOBALS{'corsite_proposalimage2'} == "" ) { BCOLIMG("../site_assets/NoImage_Flex.png","100","1"); }
	else { BCOLIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'corsite_proposalimage2'},"100","1"); }
	if ($GLOBALS{'corsite_proposalimage4'} == "" ) { BCOLIMG("../site_assets/NoImage_Flex.png","100","1"); }
	else { BCOLIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'corsite_proposalimage4'},"100","1"); }
	if ($GLOBALS{'corsite_proposalimage5'} == "" ) { BCOLIMG("../site_assets/NoImage_Flex.png","100","1"); }
	else { BCOLIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'corsite_proposalimage5'},"100","1"); }
	BCOLTXT("","2");

	BCOL("4");
	BIMGID("todolist","../site_assets/ToDoList.png","50");	
	BIMGID("googlemaps","../site_assets/GoogleMaps.png","50");
	BIMGID("landregistry","../site_assets/LandRegistry.png","50");
	BIMGID("planningportal","../site_assets/PlanningPortal.png","50");
	if ( $GLOBALS{'corlevel'} > 2 ) {	
		BIMGID("dropbox","../site_assets/DropBox.png","50");
	}
	BIMGID("mpdfreports","../site_assets/MPDFRelevantReports.png","50");
	BIMGID("versioning","../site_assets/Versioning.png","50");
	
	// print '<a href="file://C:/test.png"><img border="0" src="../site_assets/LocalFolder.png" width="50" height="50"></a>';
	
	$lockedimage = "UnLocked.png";
	
	if ( $GLOBALS{'corsite_lockedpersonid'} != "" ) {
		if ( $GLOBALS{'corsite_lockedpersonid'} == $GLOBALS{'LOGIN_person_id'} ) { $lockedimage = "LockedByMe.png"; }
		else { $lockedimage = "LockedByOther.png"; }
	}
	BIMGID("locked","../site_assets/".$lockedimage,"50");
	B_COL();
	BCOL("2"); 
	if ( $GLOBALS{'corlevel'} > 2 ) {	BINSUBMITNAMESPECIALICON("SaveUnlock","primary","Save","unlock"); }
	BINSUBMITNAMESPECIALICON("CloseSite","warning","Close","unlock"); XBR(); XBR();	
	if ( $GLOBALS{'corlevel'} > 2 ) {
	    BINSUBMITNAMESPECIALICON("SaveLock","primary","Save","lock");
	    BINSUBMITNAMESPECIALICON("SaveClose","primary","Save and Close","unlock"); 
	}
	B_COL();
	B_ROW();
	XBR();
	
	BTABHEADERCONTAINER();
	
	if ($tabviz["LOC"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="LOC") {BTABHEADERITEMACTIVE("LOC","Location");} else {BTABHEADERITEM("LOC","Location");}}
	if ($tabviz["STAT"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="STAT") {BTABHEADERITEMACTIVE("STAT","Action Status");} else {BTABHEADERITEM("STAT","Action Status");}}
	if ($tabviz["ASS1"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="ASS1") {BTABHEADERITEMACTIVE("ASS1","Assessment");} else {BTABHEADERITEM("ASS1","Assessment 1");}}	
	if ($tabviz["ASS2"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="ASS2") {BTABHEADERITEMACTIVE("ASS2","Assessment 2");} else {BTABHEADERITEM("ASS2","Assessment 2");}}    
	if ($tabviz["FA1"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="FA1") {BTABHEADERITEMACTIVE("FA1","Fin Appraisal 1");} else {BTABHEADERITEM("FA1","Fin Appraisal 1");}}    
	if ($tabviz["FA2"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="FA2") {BTABHEADERITEMACTIVE("FA2","Fin Appraisal 2");} else {BTABHEADERITEM("FA2","Fin Appraisal 2");}}
	if ($tabviz["FA3"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="FA3") {BTABHEADERITEMACTIVE("FA3","Fin Appraisal 3");} else {BTABHEADERITEM("FA3","Fin Appraisal 3");}}
	if ($tabviz["PLNG"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="PLNG") {BTABHEADERITEMACTIVE("PLNG","Planning");} else {BTABHEADERITEM("PLNG","Planning");}}
	if ($tabviz["PLNS"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="PLNS") {BTABHEADERITEMACTIVE("PLNS","Plans");} else {BTABHEADERITEM("PLNS","Plans");}}
	if ($tabviz["FIN"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="FIN") {BTABHEADERITEMACTIVE("FIN","Finance and Operations");} else {BTABHEADERITEM("FIN","Finance and Operations");}}	
	if ($tabviz["SALE"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="SALE") {BTABHEADERITEMACTIVE("SALE","Sale");} else {BTABHEADERITEM("SALE","Sale");}}
	if ($tabviz["NOT"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="NOT") {BTABHEADERITEMACTIVE("NOT","Notes");} else {BTABHEADERITEM("NOT","Notes");}}
	if ($tabviz["COM"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="COM") {BTABHEADERITEMACTIVE("COM","Communications");} else {BTABHEADERITEM("COM","Communications");}}
	
	B_TABHEADERCONTAINER();
	
	BTABCONTENTCONTAINER();	
	if ($tabviz["LOC"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="LOC") {BTABCONTENTITEMACTIVE("LOC","Location");} else {BTABCONTENTITEM("LOC","Location");} LOCContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["STAT"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="STAT") {BTABCONTENTITEMACTIVE("STAT","Action Status");} else {BTABCONTENTITEM("STAT","Action Status");} STATContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["ASS1"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="ASS1") {BTABCONTENTITEMACTIVE("ASS1","Assessment");} else {BTABCONTENTITEM("ASS1","Assessment 1");} ASS1ContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["ASS2"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="ASS2") {BTABCONTENTITEMACTIVE("ASS2","Assessment 2");} else {BTABCONTENTITEM("ASS2","Assessment 2");} ASS2ContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["FA1"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="FA1") {BTABCONTENTITEMACTIVE("FA1","Fin Appraisal 1");} else {BTABCONTENTITEM("FA1","Fin Appraisal 1");} FA1ContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["FA2"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="FA2") {BTABCONTENTITEMACTIVE("FA2","Fin Appraisal 2");} else {BTABCONTENTITEM("FA2","Fin Appraisal 2");} FA2ContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["FA3"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="FA3") {BTABCONTENTITEMACTIVE("FA3","Fin Appraisal 3");} else {BTABCONTENTITEM("FA3","Fin Appraisal 3");} FA3ContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["PLNG"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="PLNG") {BTABCONTENTITEMACTIVE("PLNG","Planning");} else {BTABCONTENTITEM("PLNG","Planning");} PLNGContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["PLNS"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="PLNS") {BTABCONTENTITEMACTIVE("PLNS","Plans");} else {BTABCONTENTITEM("PLNS","Plans");} PLNSContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["FIN"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="FIN") {BTABCONTENTITEMACTIVE("FIN","Finance and Operations");} else {BTABCONTENTITEM("FIN","Finance and Operations");} FINContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["SALE"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="SALE") {BTABCONTENTITEMACTIVE("SALE","Sale");} else {BTABCONTENTITEM("SALE","Sale");} SALEContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["NOT"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="NOT") {BTABCONTENTITEMACTIVE("NOT","Notes");} else {BTABCONTENTITEM("NOT","Notes");} NOTContentOutput(); B_TABCONTENTITEM();}
	if ($tabviz["COM"][$GLOBALS{'corlevel'}]=="1") {if ($currenttab=="COM") {BTABCONTENTITEMACTIVE("COM","Communications");} else {BTABCONTENTITEM("COM","Communications");} COMContentOutput(); B_TABCONTENTITEM();}	
	B_TABCONTENTCONTAINER();
	X_FORM();
	XTXTID("TRACETEXT","");
	foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
		$cbits = explode('|',$cropelement);
		SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);   
	} 
	NotesPopup();
	TextareaPopup();
	DateMarkerPopup();
	NewSurveyPopup();
}

function LOCContentOutput() {
	XBR();
	XH3("Location");
	XHRCLASS('underline');
	BROW();
	BCOLTXT("Site Name","1");
	BCOLINTXTID('corsite_site','corsite_site',$GLOBALS{'corsite_site'},"5");
	BCOLTXT("Batch","1");
	BCOLINTXTID('corsite_batch','corsite_batch',$GLOBALS{'corsite_batch'},"2");		
	BCOLTXT("Status","1");
	$xhash = Get_SelectArrays_Hash ("corphase","corphase_name","corphase_name","corphase_seq","","" );
	BCOLINSELECTHASHID ($xhash,'corsite_status','corsite_status',$GLOBALS{'corsite_status'},"2");
	B_ROW();
	
	$classification = ClassifySite();
	
	BROW();
	BCOLTXT("Ph1/Ph2 Status","1");
	BCOLINSELECTHASHID(List2Hash('Ph1InProgress,Ph1Completed,Ph2InProgress,Ph2Completed'),'corsite_proposalphasestatus','corsite_proposalphasestatus',$GLOBALS{'corsite_proposalphasestatus'},"2");
	BCOLTXT("Approval","1");
	$xhash = Get_SelectArrays_Hash ("corapprovalstatus","corapprovalstatus_name","corapprovalstatus_name","corapprovalstatus_seq","","" );
	BCOLINSELECTHASHID ($xhash,'corsite_approved','corsite_approved',$GLOBALS{'corsite_approved'},"2");	
	BCOLTXT("Sales Status","1");
	BCOLINSELECTHASHID (List2Hash(',On Market,Legals,Exchanged,Completed'),'corsite_salestatus','corsite_salestatus',$GLOBALS{'corsite_salestatus'},"2");
	BCOLTXT("Shelved Reason","1");
	BCOLINSELECTHASHID(List2Hash('Cancelled,No HAUV,Long Term'),'corsite_shelvedreasoncode','corsite_shelvedreasoncode',$GLOBALS{'corsite_shelvedreasoncode'},"2");
	B_ROW();		
	BROW();
	BCOLTXT("Project Manager","1");
	BCOLINTXTID('corsite_projectmgrid','corsite_projectmgrid',$GLOBALS{'corsite_projectmgrid'},"2");
	BCOLTXT("Administrator","1");
	BCOLINTXTID('corsite_admin','corsite_admin',$GLOBALS{'corsite_admin'},"2");	
	if (( $GLOBALS{'corlevel'} > 3 )&&(FoundInCommaList("FA2",$GLOBALS{'corprogramme_customtablist'}))) {
	    BCOLTXT("Fin Classification","1");
	    XINHIDID ('corsite_classification','corsite_classification',$classification);
	    BCOLTXTID("classificationtext",$classification,"2");
	} else {
	    BCOLTXT(" ","1");
	    XINHIDID ('corsite_classification','corsite_classification',$classification);
	    BCOLTXTID("classificationtext","","2");
	}
	BCOLTXT("Review Date","1");
	BCOLINDATEID('corsite_shelvedreviewdate','corsite_shelvedreviewdate',$GLOBALS{'corsite_shelvedreviewdate'},"dd/mm/yyyy","2");
	B_ROW();
	
	BROW();
	BCOLTXT("Region","1");
	BCOLINTXTID('corsite_arkregion','corsite_arkregion',$GLOBALS{'corsite_arkregion'},"2");
	BCOLTXT("Ops Contact","1");
	BCOLINTXTID('corsite_punchcontact','corsite_punchcontact',$GLOBALS{'corsite_punchcontact'},"2");
	BCOLTXT("BDM","1");
	BCOLINTXTID('corsite_extlead','corsite_extlead',$GLOBALS{'corsite_extlead'},"2");		
	BCOLTXT("","3");
	B_ROW();
	
	
	XHR();
	BROW();
	BCOL("6");
	if ( $GLOBALS{'corsite_proposalimage1title'} == "" ) { $GLOBALS{'corsite_proposalimage1title'} = "Street View"; }
	BROW(); BCOLINTXTID('corsite_proposalimage1title','corsite_proposalimage1title',$GLOBALS{'corsite_proposalimage1title'},"4"); BCOLTXT("Caption","2"); B_ROW();
	XBR();XBR();
	XINHID("corsite_proposalimage1",$GLOBALS{'corsite_proposalimage1'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "corsite_proposalimage1";
	$imageviewwidth = "90%";
	$imagename = $GLOBALS{'corsite_proposalimage1'};
	$imageuploadto = "Property";
	$imageuploadid = $GLOBALS{'corsite_id'};
	$imageuploadwidth = "800";
	$imageuploadheight = "600";
	$imageuploadfixedsize = "800x500";
	$imagethumbwidth = "400";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
	$imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);		
	B_COL();
	BCOL("6");
	if ( $GLOBALS{'corsite_proposalimage2title'} == "" ) { $GLOBALS{'corsite_proposalimage2title'} = "Aerial View"; }
	BROW(); BCOLINTXTID('corsite_proposalimage2title','corsite_proposalimage2title',$GLOBALS{'corsite_proposalimage2title'},"4"); BCOLTXT("Caption","2"); B_ROW();
	XBR();XBR();
	XINHID("corsite_proposalimage2",$GLOBALS{'corsite_proposalimage2'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "corsite_proposalimage2";
	$imageviewwidth = "90%";
	$imagename = $GLOBALS{'corsite_proposalimage2'};
	$imageuploadto = "Property";
	$imageuploadid = $GLOBALS{'corsite_id'};
	$imageuploadwidth = "800";
	$imageuploadheight = "600";
	$imageuploadfixedsize = "800x500";
	$imagethumbwidth = "400";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
	$imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);	
	B_COL();
	B_ROW();
	XHR();
	BROW();
	BCOL("6");
	XH3("Details");
	XHR();
	BROW();	BCOLTXT("<b>Full Address:</b>","2"); BCOLTXT(" ","8"); B_ROW();
	BROW();	BCOLTXT("Address 1:","4"); BCOLINTXTID('corsite_arkaddr1','corsite_arkaddr1',$GLOBALS{'corsite_arkaddr1'},"6"); B_ROW();
	BROW();	BCOLTXT("Town::","4"); BCOLINTXTID('corsite_arktown','corsite_arktown',$GLOBALS{'corsite_arktown'},"6"); B_ROW();
	BROW();	BCOLTXT("Post Code:","4"); BCOLINTXTID('corsite_arkpostcode','corsite_arkpostcode',$GLOBALS{'corsite_arkpostcode'},"6"); B_ROW();
	BROW();	BCOLTXT("Region:","4"); BCOLINTXTID('corsite_arkregion','corsite_arkregion',$GLOBALS{'corsite_arkregion'},"6"); B_ROW();
	XBR();
	BROW();	BCOLTXT("<b>Location Type:</b>","4"); BCOLINTXTID('corsite_proposallocationtype','corsite_proposallocationtype',$GLOBALS{'corsite_proposallocationtype'},"6"); B_ROW();	
	XBR();
	BROW();	BCOLTXT("<b>Trading Style/Services:</b>","4"); BCOLINTEXTAREAID('corsite_proposaltradingstyle','corsite_proposaltradingstyle',$GLOBALS{'corsite_proposaltradingstyle'},"2","6"); B_ROW();
	XBR();	
	BROW();	BCOLTXT("<b>Trading Licences:</b>","4"); BCOLINTEXTAREAID('corsite_proposaltradinglicences','corsite_proposaltradinglicences',$GLOBALS{'corsite_proposaltradinglicences'},"2","6"); B_ROW();
	XBR();
	BROW();	BCOLTXT("<b>Tenant Lease Start Date:</b>","4"); BCOLINDATEID('corsite_proposaltenantleasestartdate','corsite_proposaltenantleasestartdate',$GLOBALS{'corsite_proposaltenantleasestartdate'},"dd/mm/yyyy","6"); B_ROW();
	XBR();
	BROW();	BCOLTXT("<b>Tenant Lease End Date:</b>","4"); BCOLINDATEID('corsite_proposaltenantleaseenddate','corsite_proposaltenantleaseenddate',$GLOBALS{'corsite_proposaltenantleaseenddate'},"dd/mm/yyyy","6"); B_ROW();
	XBR();	
	BROW();	BCOLTXT("<b>Tenant Lease Type:</b>","4"); BCOLINTXTID('corsite_proposaltenantleasecomment','corsite_proposaltenantleasecomment',$GLOBALS{'corsite_proposaltenantleasecomment'},"6"); B_ROW();
	XBR();	
	BROW();	BCOLTXT("<b>Planning Authority:</b>","4"); BCOLINTXTID('corsite_proposallpa','corsite_proposallpa',$GLOBALS{'corsite_proposallpa'},"6"); B_ROW();
	XBR();		
	B_COL();
	BCOL("6");	
	XH3("Analysis");
	XHR();
	BROW();	BCOLTXT("<b>ACV Listing:</b>","4"); BCOLINTXTID('corsite_proposalacvlisting','corsite_proposalacvlisting',$GLOBALS{'corsite_proposalacvlisting'},"6"); B_ROW();
	BROW();	BCOLTXT("<b>Grade Listing:</b>","4"); BCOLINTXTID('corsite_proposalgradelisting','corsite_proposalgradelisting',$GLOBALS{'corsite_proposalgradelisting'},"6"); B_ROW();	
	BROW();	BCOLTXT("<b>Locally Listed Building:</b>","4"); BCOLINTXTID('corsite_proposallocallisting','corsite_proposallocallisting',$GLOBALS{'corsite_proposallocallisting'},"6"); B_ROW();	
	BROW();	BCOLTXT("<b>Archaeology:</b>","4"); BCOLINTXTID('corsite_proposalheritagegateway','corsite_proposalheritagegateway',$GLOBALS{'corsite_proposalheritagegateway'},"6"); B_ROW();
	BROW();	BCOLTXT("<b>Within Settlement Boundary:</b>","4"); BCOLINTXTID('corsite_proposalsettlementboundary','corsite_proposalsettlementboundary',$GLOBALS{'corsite_proposalsettlementboundary'},"6"); B_ROW();
	BROW();	BCOLTXT("<b>Green Belt:</b>","4"); BCOLINTXTID('corsite_proposalgreenbelt','corsite_proposalgreenbelt',$GLOBALS{'corsite_proposalgreenbelt'},"6"); B_ROW();
	BROW();	BCOLTXT("<b>Conservation Area:</b>","4"); BCOLINTXTID('corsite_proposalconservationarea','corsite_proposalconservationarea',$GLOBALS{'corsite_proposalconservationarea'},"6"); B_ROW();
	BROW();	BCOLTXT("<b>National Park:</b>","4"); BCOLINTXTID('corsite_proposalnationalpark','corsite_proposalnationalpark',$GLOBALS{'corsite_proposalnationalpark'},"6"); B_ROW();
	BROW();	BCOLTXT("<b>Area of Outstanding Natural Beauty:</b>","4"); BCOLINTXTID('corsite_proposalaonb','corsite_proposalaonb',$GLOBALS{'corsite_proposalaonb'},"6"); B_ROW();
	BROW();	BCOLTXT("<b>Tree Preservation Order</b>","4"); BCOLINTXTID('corsite_proposaltpo','corsite_proposaltpo',$GLOBALS{'corsite_proposaltpo'},"6"); B_ROW();
	BROW();	BCOLTXT("<b>Flood Zone</b>","4"); BCOLINTXTID('corsite_proposalfloodzone','corsite_proposalfloodzone',$GLOBALS{'corsite_proposalfloodzone'},"6"); B_ROW();
	BROW();	BCOLTXT("<b>Neighbourhood Plan</b>","4"); BCOLINTXTID('corsite_proposalneighbourhoodplan','corsite_proposalneighbourhoodplan',$GLOBALS{'corsite_proposalneighbourhoodplan'},"6"); B_ROW();
	XBR();
	BROW();	BCOLTXT("<b>Foodstores within 1 Mile:</b>","6"); B_ROW();
	BROW();	BCOLINTEXTAREAID('corsite_proposalfoodstoreswithin1mile','corsite_proposalfoodstoreswithin1mile',$GLOBALS{'corsite_proposalfoodstoreswithin1mile'},"3","10"); B_ROW();
	XBR();				
	BROW();	BCOLTXT("<b>Other Pubs within 1 Mile:</b>","6"); B_ROW();	
	BROW();	BCOLINTEXTAREAID('corsite_proposalpubswithin1mile','corsite_proposalpubswithin1mile',$GLOBALS{'corsite_proposalpubswithin1mile'},"3","10"); B_ROW();
	B_COL();
	B_ROW();
	XBR();
	XHRCLASS('underline');
	XH3("Recent Planning Applications");
	BROW();BCOLINTEXTAREAID('corsite_proposalrecentplanningapplications','corsite_proposalrecentplanningapplications',$GLOBALS{'corsite_proposalrecentplanningapplications'},"3","12");B_ROW();
	XBR();
	XHRCLASS('underline');
	XH3("Links");
	XBR();
	BROW();
	BCOLTXT("Dropbox Sharing Reference","2");
	BCOLINTXTID("corsite_dropboxmasterfolder","corsite_dropboxmasterfolder",$GLOBALS{'corsite_dropboxmasterfolder'},"6");
	BCOLTXT("","4");
	B_ROW();
	XBR();XBR();
	BROW();
	BCOLTXT("GoogleMaps Link","2");
	BCOLINTXTID("corsite_googlemapslink","corsite_googlemapslink",$GLOBALS{'corsite_googlemapslink'},"6");
	BCOLTXT("","4");
	B_ROW();
	XBR();XBR();
	BROW();
	BCOLTXT("Land Registry Link","2");
	BCOLINTXTID("corsite_landregistrylink","corsite_landregistrylink",$GLOBALS{'corsite_landregistrylink'},"6");
	BCOLTXT("","4");
	B_ROW();
	XBR();XBR();
	BROW();
	BCOLTXT("Planning Portal Link","2");
	BCOLINTXTID("corsite_planningportallink","corsite_planningportallink",$GLOBALS{'corsite_planningportallink'},"6");
	BCOLTXT("","4");
	B_ROW();
	XBR();XBR();

}

function STATContentOutput() {
    XBR();
    XH3("Status");
    XHRCLASS('underline');
    XBR();
    BROWTOP();
    BCOLTXT("Ops Feedback - Comments/Actions","3");
    BCOLINTEXTAREAID('corsite_punchactionssummary','corsite_punchactionssummary',$GLOBALS{'corsite_punchactionssummary'},"2","9");
    B_ROW();
    XBR();
    BROWTOP();
    BCOLTXT("Date Reviewed by Ops","3");
    BCOLINDATEID('corsite_punchreviewdate','corsite_punchreviewdate',$GLOBALS{'corsite_punchreviewdate'},"dd/mm/yyyy","1");
    BCOLTXT("Approved by Ops?","2");
    BCOLINSELECTHASHIDCLASS (List2Hash('Y,N,Review'),'corsite_punchactionstatus','rag','corsite_punchactionstatus',$GLOBALS{'corsite_punchactionstatus'},"1");
    BCOLTXT("","5");
    B_ROW();
    XHRCLASS('underline');
    XH3("Status Log");
    BROWEQH();
    BCOLTXT("","2");
    BCOLTXTCOLOR("<b>Date</b>","1","gray","white");    
    BCOLTXTCOLOR("<b>Person</b>","1","gray","white");    
    BCOLTXTCOLOR("<b>Action</b>","7","gray","white");
    BCOL("1");	BINBUTTONIDSPECIAL('wklysummary_add_new',"success","+"); B_COL();
    B_ROW();
    BROW();
    BCOLTXT("Add New Item","2");
    BCOLINTXTID('wklysummary_ddmm','wklysummary_ddmm',$GLOBALS{'dd'}."/".$GLOBALS{'mm'}."/".$GLOBALS{'yy'},"1");    
    BCOLINTXTID('wklysummary_personid','wklysummary_personid',$GLOBALS{'LOGIN_person_id'},"1");
    BCOLINTXTID('wklysummary_action','wklysummary_action',"","7");
    BCOLTXT("","1");
    B_ROW();
    XHR();
    BROWTOP();
    BCOLTXT("<B>Summary<br>(Status and Actions)</B>","2");
    BCOLINTEXTAREAID('corsite_wklysummary','corsite_wklysummary',$GLOBALS{'corsite_wklysummary'},"15","9");
    B_ROW();
    
}


function ASS1ContentOutput() {
	XBR();
	XH3("Assessment 1");
	XHRCLASS('underline');
	XBR();
	BROW();
	BCOLTXT('',"1");BCOLTXT('Y/N',"1");BCOLTXT('<b>Comments</b>',"8");
	B_ROW();
	BROW();
	BCOLTXT('<b>Full Site:</b>',"1");
	BCOLINSELECTHASHID (List2Hash('Y,N'),'corsite_proposalaltusefullsite','corsite_proposalaltusefullsite',$GLOBALS{'corsite_proposalaltusefullsite'},"1");
	BCOLINTXTID('corsite_proposalaltusefullsitecomments','corsite_proposalaltusefullsitecomments',$GLOBALS{'corsite_proposalaltusefullsitecomments'},"8");	
	B_ROW();
	BROW();
	BCOLTXT('<b>Part Site:</b>',"1");
	BCOLINSELECTHASHID (List2Hash('Y,N'),'corsite_proposalaltusepartsite','corsite_proposalaltusepartsite',$GLOBALS{'corsite_proposalaltusepartsite'},"1");
	BCOLINTXTID('corsite_proposalaltusepartsitecomments','corsite_proposalaltusepartsitecomments',$GLOBALS{'corsite_proposalaltusepartsitecomments'},"8");
	B_ROW();
	BROW();
	BCOLTXT('<b>C-Store:</b>',"1");
	BCOLINSELECTHASHID (List2Hash('Y,N'),'corsite_proposalaltusecstore','corsite_proposalaltusecstore',$GLOBALS{'corsite_proposalaltusecstore'},"1");
	BCOLINTXTID('corsite_proposalaltusecstorecomments','corsite_proposalaltusecstorecomments',$GLOBALS{'corsite_proposalaltusecstorecomments'},"8");
	B_ROW();
	BROW();
	BCOLTXT('<b>Residential:</b>',"1");
	BCOLINSELECTHASHID (List2Hash('Y,N'),'corsite_proposalaltuseresi','corsite_proposalaltuseresi',$GLOBALS{'corsite_proposalaltuseresi'},"1");
	BCOLINTXTID('corsite_proposalaltuseresicomments','corsite_proposalaltuseresicomments',$GLOBALS{'corsite_proposalaltuseresicomments'},"8");
	B_ROW();
	BROW();
	BCOLTXT('<b>Upper Parts:</b>',"1");
	BCOLINSELECTHASHID (List2Hash('Y,N'),'corsite_proposalaltuseupper','corsite_proposalaltuseupper',$GLOBALS{'corsite_proposalaltuseupper'},"1");
	BCOLINTXTID('corsite_proposalaltuseuppercomments','corsite_proposalaltuseuppercomments',$GLOBALS{'corsite_proposalaltuseuppercomments'},"8");
	B_ROW();
	BROW();
	BCOLTXT('<b>Other:</b>',"1");
	BCOLINSELECTHASHID (List2Hash('Y,N'),'corsite_proposalaltuseother','corsite_proposalaltuseother',$GLOBALS{'corsite_proposalaltuseother'},"1");
	BCOLINTXTID('corsite_proposalaltuseothercomments','corsite_proposalaltuseothercomments',$GLOBALS{'corsite_proposalaltuseothercomments'},"8");
	B_ROW();
	
	XINHID("OutletCommsDisplayed","Yes");
	XHRCLASS('underline');
	XBR();
	XH3("Outlet Assessment Log");
	XBR();
	$classhash = Get_SelectArrays_Hash ("coroutletclass","coroutletclass_id","coroutletclass_name","coroutletclass_id","","" );
	$cohash = Get_SelectArrays_Hash ("coroutletco","coroutletco_id","coroutletco_name","coroutletco_id","","" );
	$inthash = List2Hash('Y,N,N/A');
	BROWEQH();
	BCOLTXTCOLOR("<b>Class</b>","1","gray","white");	
	BCOLTXTCOLOR("<b>Outlet Co</b>","1","gray","white");	
	BCOLTXTCOLOR("<b>Outlet Name</b>","2","gray","white");
	BCOLTXTCOLOR("<b>Contact</b>","1","gray","white");	
	BCOLTXTCOLOR("<b>Interest</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Comments</b>","4","gray","white");
	BCOLTXTCOLOR("<b>Last Date</b>","1","gray","white");	
	BCOL("1");	BINBUTTONIDSPECIAL('coroutletcomms_add_new',"success","+"); B_COL();
	B_ROW();
	$coroutletcommsa = explode(',',$GLOBALS{'corsite_proposalcoroutletcommsidlist'});
	foreach ($coroutletcommsa as $coroutletcomms_id) {
		Check_Data('coroutletcomms',$coroutletcomms_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
			BROW();
			BCOLINSELECTHASHID ($classhash,'coroutletcomms_coroutletcl==id_'.$coroutletcomms_id,'coroutletcomms_coroutletclassid_'.$coroutletcomms_id,$GLOBALS{'coroutletcomms_coroutletclassid'},"1");			
			BCOLINSELECTHASHID ($cohash,'coroutletcomms_coroutletconame_'.$coroutletcomms_id,'coroutletcomms_coroutletconame_'.$coroutletcomms_id,$GLOBALS{'coroutletcomms_coroutletconame'},"1");
			BCOLINTXTID('coroutletcomms_outletname_'.$coroutletcomms_id,'coroutletcomms_outletname_'.$coroutletcomms_id,$GLOBALS{'coroutletcomms_outletname'},"2");			
			BCOLINTXTID('coroutletcomms_contact_'.$coroutletcomms_id,'coroutletcomms_contact_'.$coroutletcomms_id,$GLOBALS{'coroutletcomms_contact'},"1");
			BCOLINSELECTHASHIDCLASS ($inthash,'coroutletcomms_interest_'.$coroutletcomms_id,'rag','coroutletcomms_interest_'.$coroutletcomms_id,$GLOBALS{'coroutletcomms_interest'},"1");
			BCOLINTEXTAREAID ('coroutletcomms_comment_'.$coroutletcomms_id,'coroutletcomms_comment_'.$coroutletcomms_id,$GLOBALS{'coroutletcomms_comment'},"2","4");
			BCOLINDATEID('coroutletcomms_date_'.$coroutletcomms_id,'coroutletcomms_date_'.$coroutletcomms_id,$GLOBALS{'coroutletcomms_date'},"dd/mm/yyyy","1");
			BCOL("1"); BINBUTTONIDCLASSSPECIAL('coroutletcomms_delete_'.$coroutletcomms_id,"coroutletcommsdelete","danger","x"); B_COL();
			B_ROW();
		}
	}
	XDIV("coroutletcommslistend","");
	X_DIV("coroutletcommslistend");
	XBR();XBR();
	
}

function ASS2ContentOutput() {
	XBR();
	XH3("Assessment 2");
	XHRCLASS('underline');	
	XBR();
    BROW();BCOLTXT('<b>AU Strategy:</b>',"2");BCOLINTXTID('corsite_proposalaltusestrapline','corsite_proposalaltusestrapline',$GLOBALS{'corsite_proposalaltusestrapline'},"10");B_ROW();
    XBR();	
    XDIV("SpecPh1View","");
	    XH3("Initial Assessment");
	    XHR();
	    BROW();
	    BCOL("6");
	    $xhash = List2Hash('Green,Amber,Red');
	    BROW();	BCOLTXT("<b>Cordage Initial Assessment (RAG):</b>","6"); BCOLINSELECTHASHIDCLASS ($xhash,'corsite_proposalph1ragstatus','rag','corsite_proposalph1ragstatus',$GLOBALS{'corsite_proposalph1ragstatus'},"6"); B_ROW();
	    XBR();
	    $xhash = Get_SelectArrays_Hash ("corscheme","corscheme_name","corscheme_name","corscheme_seq","","" );
	    BROW();	BCOLTXT("<b>Scheme:</b>","6"); BCOLINSELECTHASHID ($xhash,'corsite_proposalph1scheme','corsite_proposalph1scheme',$GLOBALS{'corsite_proposalph1scheme'},"6"); B_ROW();
	    XBR();
	    $xhash = Get_SelectArrays_Hash ("corsitetype","corsitetype_name","corsitetype_name","corsitetype_seq","","" );
	    BROW();	BCOLTXT("<b>Type:</b>","6"); BCOLINSELECTHASHID ($xhash,'corsite_proposalph1sitetype','corsite_proposalph1sitetype',$GLOBALS{'corsite_proposalph1sitetype'},"6"); B_ROW();
	    XBR();
	    BROW();	BCOLTXT("<b>Net Proceeds Estimate:</b>","6"); BCOLINTXTIDCLASS('corsite_proposalph1npestimate','calcin','corsite_proposalph1npestimate',$GLOBALS{'corsite_proposalph1npestimate'},"6"); B_ROW();
	    XBR();
        B_COL();
	    BCOL("6");
        B_COL();
        B_ROW();
	    XBR();
	X_DIV("SpecPh1View");	    
    XDIV("SpecPh2View","");
    	BROW();BCOLTXT('<b>Cordage Comment:</b>',"12"); B_ROW();
    	BROW();	BCOLINTEXTAREAID('corsite_proposalaltusecommentary','corsite_proposalaltusecommentary',$GLOBALS{'corsite_proposalaltusecommentary'},"6","12"); B_ROW();
    	XBR();	
    	BROW();	BCOLTXT('<b>WYG Comment:</b>',"12"); B_ROW();
    	BROW();	BCOLINTEXTAREAID('corsite_proposalwygcomment','corsite_proposalwygcomment',$GLOBALS{'corsite_proposalwygcomment'},"6","12"); B_ROW();	
    	XBR();
    	BROW();BCOLTXT('<b>TPA Comment:</b>',"12"); B_ROW();
    	BROW();	BCOLINTEXTAREAID('corsite_proposaltpacomment','corsite_proposaltpacomment',$GLOBALS{'corsite_proposaltpacomment'},"6","12"); B_ROW();
    	XBR();
    	XH3("Financials");
    	XHR();
    	BROW();
    	BCOL("6");
    	$xhash = List2Hash('Green,Amber,Red');
    	BROW();	BCOLTXT("<b>Cordage Assessment (RAG):</b>","4"); BCOLINSELECTHASHIDCLASS ($xhash,'corsite_proposalnewrag','rag','corsite_proposalnewrag',$GLOBALS{'corsite_proposalnewrag'},"6"); B_ROW();	
    	$xhash = Get_SelectArrays_Hash ("corscheme","corscheme_name","corscheme_name","corscheme_seq","","" );
    	BROW();	BCOLTXT("<b>Scheme:</b>","4"); BCOLINSELECTHASHID ($xhash,'corsite_proposalscheme','corsite_proposalscheme',$GLOBALS{'corsite_proposalscheme'},"6"); B_ROW();
    	$xhash = Get_SelectArrays_Hash ("corsitetype","corsitetype_name","corsitetype_name","corsitetype_seq","","" );
    	BROW();	BCOLTXT("<b>Type:</b>","4"); BCOLINSELECTHASHID ($xhash,'corsite_proposaltype','corsite_proposaltype',$GLOBALS{'corsite_proposaltype'},"6"); B_ROW();    	
    	B_COL();
    	B_ROW();
    	XHR();
    	BROW();
    	BCOL("6");
    	if (($GLOBALS{'corsite_buildcomminternally'} == "Y")||($GLOBALS{'corsite_buildresiinternally'} == "Y")) {
    	    // This is a build internally situation
    	    BROW();	BCOLTXT("<b>GDV:</b>","4"); BCOLINTXTIDCLASS('corsite_proposalgdv','calcres','corsite_proposalgdv',D80ToN80($GLOBALS{'corsite_proposalgdv'}),"6"); B_ROW();
    	    XBR();
    	    BROW();	BCOLTXT("<b>Site Purchase Price:</b>","4"); BCOLINTXTIDCLASS('corsite_proposallandpurchasevalue','calcres','corsite_proposallandpurchasevalue',D80ToN80($GLOBALS{'corsite_proposallandpurchasevalue'}),"6"); B_ROW();
    	    XBR();
    	    BROW();	BCOLTXT("<b>Build Cost:</b>","4"); BCOLINTXTIDCLASS('corsite_proposalbuildcost','calcres','corsite_proposalbuildcost',$GLOBALS{'corsite_proposalbuildcost'},"6"); B_ROW();
    	    XBR();
    	    BROW();	BCOLTXT("<b>Net Proceeds:</b>","4"); BCOLINTXTIDCLASS('corsite_proposalnetproceeds','calcres','corsite_proposalnetproceeds',D80ToN80($GLOBALS{'corsite_proposalnetproceeds'}),"6"); B_ROW();
    	    XINHID('corsite_proposaluplift',0); // NA
        } else {
            // all other cases (may refine this later)
            BROW();	BCOLTXT("<b>GVA:</b>","4"); BCOLINTXTIDCLASS('copy_corsite_arkgva','calcres','copy_corsite_arkgva',D80ToN80($GLOBALS{'corsite_arkgva'}),"6"); B_ROW();   
            XBR();
            BROW();	BCOLTXT("<b>GDV:</b>","4"); BCOLINTXTIDCLASS('corsite_proposalgdv','calcres','corsite_proposalgdv',D80ToN80($GLOBALS{'corsite_proposalgdv'}),"6"); B_ROW();
            XINHID('corsite_proposallandpurchasevalue',0); // NA
            XINHID('corsite_proposalbuildcost',0); // NA
            XBR();
            BROW();	BCOLTXT("<b>Net Proceeds:</b>","4"); BCOLINTXTIDCLASS('corsite_proposalnetproceeds','calcres','corsite_proposalnetproceeds',D80ToN80($GLOBALS{'corsite_proposalnetproceeds'}),"6"); B_ROW();
            XBR();
            BROW();	BCOLTXT("<b>Uplift:</b>","4"); BCOLINTXTIDCLASS('corsite_proposaluplift','calcres','corsite_proposaluplift',$GLOBALS{'corsite_proposaluplift'},"6"); B_ROW();	
        }
    	B_COL();
    	BCOL("6");
    	BROW();	BCOLTXT("<b>Submission Fee:</b>","4"); BCOLINTXTIDCLASS('corsite_proposalsubmissionfee','calcres','corsite_proposalsubmissionfee',D80ToN80($GLOBALS{'corsite_proposalsubmissionfee'}),"6"); B_ROW();
    	XBR();
    	BROW();	BCOLTXT("<b>Planning Fee:</b>","4"); BCOLINTXTIDCLASS('corsite_proposalplanningfee','calcres','corsite_proposalplanningfee',D80ToN80($GLOBALS{'corsite_proposalplanningfee'}),"6"); B_ROW();
    	XBR();
    	BROW();	BCOLTXT("<b>Legal Costs:</b>","4"); BCOLINTXTIDCLASS('corsite_proposallegalcosts','calcres','corsite_proposallegalcosts',D80ToN80($GLOBALS{'corsite_proposallegalcosts'}),"6"); B_ROW();		
     	XBR();
    	BROW();	BCOLTXT("<b>CIL/106:</b>","4"); BCOLINTXTIDCLASS('corsite_proposalcil106','calcres','corsite_proposalcil106',D80ToN80($GLOBALS{'corsite_proposalcil106'}),"6"); B_ROW();   	
    	XBR();
    	BROW();	BCOLTXT("<b>Other Costs:</b>","4"); BCOLINTXTIDCLASS('corsite_proposalothercosts','calcres','corsite_proposalothercosts',D80ToN80($GLOBALS{'corsite_proposalothercosts'}),"6"); B_ROW();	
    	B_COL();    	
    	B_ROW();
    	// if ( FoundInCommaList("FA2",$GLOBALS{'corprogramme_customtablist'})) {   	    
        	XHR();
        	BROWTOP();
        	BCOL("6");
        	BROW();	BCOLTXT("<b>Current Financials:</b>","6"); B_ROW();
        	XBR();
        	BROW();	BCOLTXT("Ownership Status:","4"); BCOLINTXTID('corsite_currfinownershipstatus','corsite_currfinownershipstatus',$GLOBALS{'corsite_currfinownershipstatus'},"6"); B_ROW();
        	XBR();
        	BROW();	BCOLTXT("Volume (Barrels):","4"); BCOLINTXTIDCLASS('corsite_currfinbarrelvol','calcin','corsite_currfinbarrelvol',D80ToN80($GLOBALS{'corsite_currfinbarrelvol'}),"6"); B_ROW();
        	XBR();
        	BROW();	BCOLTXT("Passing Rent:","4"); BCOLINTXTIDCLASS('corsite_currfinpassingrent','calcin','corsite_currfinpassingrent',D80ToN80($GLOBALS{'corsite_currfinpassingrent'}),"6"); B_ROW();
        	XBR();
        	BROW();	BCOLTXT("EBITDA:","4"); BCOLINTXTIDCLASS('corsite_currfinlatestebitda','calcin','corsite_currfinlatestebitda',D80ToN80($GLOBALS{'corsite_currfinlatestebitda'}),"6"); B_ROW();
        	B_COL();   
        	B_ROW();
    	// }
    	XBR();
    	BROWTOP();	
    	BCOLTXT("<b>Comparables:</b>","2");
    	BCOLINTEXTAREAID('corsite_proposalcomparables1','corsite_proposalcomparables1',$GLOBALS{'corsite_proposalcomparables1'},"3","10"); 
    	B_ROW();
    	XBR();
    X_DIV("SpecPh2View");
	
	XHR();	
	XH3("Title & Plans");
	BROW();
	BCOL("6");
	
	XINHID("corsite_proposalimage4",$GLOBALS{'corsite_proposalimage4'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "corsite_proposalimage4";
	$imageviewwidth = "90%";
	$imagename = $GLOBALS{'corsite_proposalimage4'};
	$imageuploadto = "Property";
	$imageuploadid = $GLOBALS{'corsite_id'};
	$imageuploadwidth = "500";
	$imageuploadheight = "450";
	$imageuploadfixedsize = "500x450";
	$imagethumbwidth = "400";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
	$imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);	
	
	B_COL();
	BCOL("6");
	
	XINHID("corsite_proposalimage5",$GLOBALS{'corsite_proposalimage5'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "corsite_proposalimage5";
	$imageviewwidth = "90%";
	$imagename = $GLOBALS{'corsite_proposalimage5'};
	$imageuploadto = "Property";
	$imageuploadid = $GLOBALS{'corsite_id'};
	$imageuploadwidth = "500";
	$imageuploadheight = "450";
	$imageuploadfixedsize = "500x450";
	$imagethumbwidth = "400";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
	$imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);	
		
	B_COL();
	B_ROW();
	XBR();
	BROWTOP();
	BCOLTXT("<b>Restrictions:</b>","2"); 
	BCOLINTEXTAREAID('corsite_proposaltitlerestrictions','corsite_proposaltitlerestrictions',$GLOBALS{'corsite_proposaltitlerestrictions'},"3","10"); 
	B_ROW();	
	XBR();
	/*
	XHR();	
	XH3("Local Market Conditions");
	BROW();
	BCOL("6");
	XINHID("corsite_proposalimage3",$GLOBALS{'corsite_proposalimage3'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "corsite_proposalimage3";
	$imageviewwidth = "90%";
	$imagename = $GLOBALS{'corsite_proposalimage3'};
	$imageuploadto = "Property";
	$imageuploadid = $GLOBALS{'corsite_id'};
	$imageuploadwidth = "600";
	$imageuploadheight = "300";
	$imageuploadfixedsize = "600x300";
	$imagethumbwidth = "400";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
	$imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);		
	
	B_COL();
	B_ROW();
	XBR();
	*/

}

function FA1ContentOutput() {
	XBR();
	XH3("Financial Appraisal 1");	
	XHRCLASS('underline');
	XBR();	
	BROWEQH();
	BCOLTXT('<b>AU Strategy:</b>',"2");BCOLTXTID('corsite_proposalaltusestrapline2',$GLOBALS{'corsite_proposalaltusestrapline'},"5");
	BCOLTXTCOLOR("<b>GVA</b>","2","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");	
	BINTXTIDCLASS('corsite_arkgva','calcin','corsite_arkgva',D80ToN80($GLOBALS{'corsite_arkgva'}));
	B_COL();
	BCOLTXT("&nbsp;<br>&nbsp;","2");	
	B_ROW();	
	XBR();	
	BROW();
	BCOLTXT("Commercial Tenant","2");
	BCOLINTXTID("corsite_dispcommtenant","corsite_dispcommtenant",$GLOBALS{'corsite_dispcommtenant'},"2");
	BCOLTXT("Solicitors Instructed","2");		
	BCOLINTXTID("corsite_dispcommsolicitorsinstructed","corsite_dispcommsolicitorsinstructed",$GLOBALS{'corsite_dispcommsolicitorsinstructed'},"2");
	BCOLTXT("Status","2");		
	BCOLINTXTID("corsite_dispcommcontractstatus","corsite_dispcommcontractstatus",$GLOBALS{'corsite_dispcommcontractstatus'},"2");
	B_ROW();
	BROW();
	BCOLTXT("Lease Length","2");	
	BCOLINTXTID("corsite_dispcommleaseterm","corsite_dispcommleaseterm",$GLOBALS{'corsite_dispcommleaseterm'},"2");
	BCOLTXT("Rent Review","2");	
	BCOLINTXTID("corsite_dispcommrentreview","corsite_dispcommrentreview",$GLOBALS{'corsite_dispcommrentreview'},"2");
	BCOLTXT("Start Date","2");	
	BCOLINDATEID("corsite_dispcommleasestartdate","corsite_dispcommleasestartdate",$GLOBALS{'corsite_dispcommleasestartdate'},"dd/mm/yyyy","2");
	B_ROW();
	XBR();	
	XH3("Gross Development Value");
	XHRCLASS('underline');
	BROWEQH();
	BCOLTXTCOLOR("<b>Commercial</b>","1","gray","white");
	$tlist = 'Internal Build,Developer Build';
	$clist = 'Y,N';
	BCOLBACKCOLOR("gray","1");
	BINSELECTHASHID (Lists2Hash($clist,$tlist),'corsite_buildcomminternally','corsite_buildcomminternally',$GLOBALS{'corsite_buildcomminternally'},"1");
	B_COL();
	BCOLTXTCOLOR("<b>Area (sq ft)</b>","1","gray","white");	
	BCOLTXTCOLOR("<b>Rent psf</b>","1","gray","white");	
	BCOLTXTCOLOR("<b>Total Rent pa</b>","1","gray","white");	
	BCOLTXTCOLOR("<b>Yield</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Purchaser's Costs %</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Rent Free Mths</b>","1","gray","white");	
	BCOLTXTCOLOR("<b>Other</b>","1","gray","white");
	BCOLTXTCOLOR("<b>GDV</b>","1","gray","white");
	BCOL("1");	BINBUTTONIDSPECIAL('corcomm_add_new',"success","+"); B_COL();
	BCOLTXT("&nbsp;<br>&nbsp;","1");
	B_ROW();
	
	XINHID("CommDisplayed","Yes");
	$commida = List2Array($GLOBALS{'corsite_dispcorcommidlist'});
	foreach ($commida as $corcomm_id) {
		Check_Data('corcomm',$corcomm_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
			XDIV("corcommsection".$corcomm_id,"");
			BROW();
			BCOLINTXTIDCLASS("corcomm_tenantname_".$corcomm_id,'','corcomm_tenantname_'.$corcomm_id,$GLOBALS{'corcomm_tenantname'},"2");			
			BCOLINTXTIDCLASS("corcomm_area_".$corcomm_id,'calcin','corcomm_area_'.$corcomm_id,D80ToN80($GLOBALS{'corcomm_area'}),"1");
			BCOLINTXTIDCLASS("corcomm_rentpersqftcalc_".$corcomm_id,'calcres','corcomm_rentpersqftcalc_'.$corcomm_id,$GLOBALS{'corcomm_rentpersqftcalc'},"1");
			BCOLINTXTIDCLASS("corcomm_rentperannum_".$corcomm_id,'calcin','corcomm_rentperannum_'.$corcomm_id,$GLOBALS{'corcomm_rentperannum'},"1");
			BCOLINTXTIDCLASS("corcomm_yieldpercent_".$corcomm_id,'calcinpercent','corcomm_yieldpercent_'.$corcomm_id,$GLOBALS{'corcomm_yieldpercent'},"1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLINTXTIDCLASS("corcomm_tenantgdvcalc_".$corcomm_id,'calcres','corcomm_tenantgdvcalc_'.$corcomm_id,D80ToN80($GLOBALS{'corcomm_tenantgdvcalc'}),"1");
			BCOL("1"); BINBUTTONIDCLASSSPECIAL('corcomm_delete_'.$corcomm_id,"commdelete","danger","x"); B_COL();
			BCOLTXT("&nbsp;","1");
			B_ROW();
			BROW();
			BCOLTXT("Purchasers Costs","2");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLINTXTIDCLASS("corcomm_purchaserscostpercent_".$corcomm_id,'calcinpercent','corcomm_purchaserscostpercent_'.$corcomm_id,D82ToP82($GLOBALS{'corcomm_purchaserscostpercent'}),"1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLINTXTIDCLASS("corcomm_purchaserscostgdvcalc_".$corcomm_id,'calcres','corcomm_purchaserscostgdvcalc_'.$corcomm_id,D80ToN80($GLOBALS{'corcomm_purchaserscostgdvcalc'}),"1");
			BCOLTXT("","2");
			B_ROW();
			
			BROWEQHTOPPAD();
			BCOLTXTCOLOR("","7","white","black");
			BCOLTXTCOLOR("<b>Net Capital Value</b>","2","#f2d30c","black");
			BCOLBACKCOLOR("#f2d30c","1");
			BINTXTIDCLASS("corcomm_netcapitalvaluecalc_".$corcomm_id,'calcres','corcomm_netcapitalvaluecalc_'.$corcomm_id,D80ToN80($GLOBALS{'corcomm_netcapitalvaluecalc'}));
			B_COL();
			BCOLTXT("&nbsp;<br>&nbsp;","2");
			B_ROW();
			
			BROW();
			BCOLTXT("Rent Free","2");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLINTXTIDCLASS("corcomm_rentfreemths_".$corcomm_id,'calcin','corcomm_rentfreemths',D80ToN80($GLOBALS{'corcomm_rentfreemths'}),"1");
			BCOLTXT("","1");
			BCOLINTXTIDCLASS("corcomm_rentfreegdvcalc_".$corcomm_id,'calcres','corcomm_rentfreegdvcalc',D80ToN80($GLOBALS{'corcomm_rentfreegdvcalc'}),"1");
			BCOLTXT("","2");
			B_ROW();
			BROW();
			BCOLTXT("Cap Con","2");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLINTXTIDCLASS("corcomm_capcon_".$corcomm_id,'calcin','corcomm_capcon_'.$corcomm_id,D80ToN80($GLOBALS{'corcomm_capcon'}),"1");
			BCOLINTXTIDCLASS("corcomm_capcongdvcalc_".$corcomm_id,'calcres','corcomm_capcongdvcalc_'.$corcomm_id,D80ToN80($GLOBALS{'corcomm_capcongdvcalc'}),"1");
			BCOLTXT("","2");
			B_ROW();
			BROW();
			BCOLTXT("Surrender Cost","2");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLTXT("","1");
			BCOLINTXTIDCLASS("corcomm_surrendercost_".$corcomm_id,'calcin','corcomm_surrendercost_'.$corcomm_id,D80ToN80($GLOBALS{'corcomm_surrendercost'}),"1");
			BCOLINTXTIDCLASS("corcomm_surrendercostgdvcalc_".$corcomm_id,'calcres','corcomm_surrendercostgdvcalc_'.$corcomm_id,D80ToN80($GLOBALS{'co);rcostgdvcalc'}),"1");
			BCOLTXT("","2");
			B_ROW();
			X_DIV("corcommsection".$corcomm_id);			
		}
	}
	XDIV("commlistend","");
	X_DIV("commlistend");	
	$backcolor = "#f2d30c";
	if ( $GLOBALS{'corsite_buildcomminternally'} == 'N' ) { $backcolor = "#85C1E9"; }
	BROWEQHTOPPAD();
	BCOLTXTCOLOR("&nbsp;","2",$backcolor,"black");
	BCOLBACKCOLOR($backcolor,"1");
	BINTXTIDCLASS('corsite_dispcommtotalsqftcalc','calcres','corsite_dispcommtotalsqftcalc',D80ToN80($GLOBALS{'corsite_dispcommtotalsqftcalc'}));
	B_COL();	
	BCOLTXTCOLOR("&nbsp;","4",$backcolor,"black");	
	BCOLTXTCOLOR("<b>Commercial Sale GDV</b>","2",$backcolor,"black");
	BCOLBACKCOLOR($backcolor,"1");
	BINTXTIDCLASS('corsite_dispcommgdvsubtotalcalc','calcres','corsite_dispcommgdvsubtotalcalc',D80ToN80($GLOBALS{'corsite_dispcommgdvsubtotal'}));	
	B_COL();	
	BCOLTXT("&nbsp;<br>&nbsp;","2");		
	B_ROW();

	XBR();
	BROWEQHTOPPAD();
	BCOLTXTCOLOR("<b>Residential</b>","1","gray","white");
	$tlist = 'Internal Build,Developer Build';
	$clist = 'Y,N';
	BCOLBACKCOLOR("gray","1");
	BINSELECTHASHID (Lists2Hash($clist,$tlist),'corsite_buildresiinternally','corsite_buildresiinternally',$GLOBALS{'corsite_buildresiinternally'},"1");
	B_COL();
	BCOLTXTCOLOR("<b>No</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Sqft</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Beds</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Value</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Tot Value</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Disc %</b>","1","gray","white");
	BCOLTXTCOLOR("&nbsp;","1","gray","white");
	BCOLTXTCOLOR("<b>GDV</b>","1","gray","white");
	BCOL("1");	BINBUTTONIDSPECIAL('corresi_add_new',"success","+"); B_COL();
	BCOLTXT("&nbsp;<br>&nbsp;","1");	
	B_ROW();
	
	XINHID("ResiDisplayed","Yes");
	$resiida = List2Array($GLOBALS{'corsite_dispcorresiidlist'});
	foreach ($resiida as $corresi_id) {	
		Check_Data('corresi',$corresi_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
			BROW();
			BCOLINTXTIDCLASS('corresi_class_'.$corresi_id,'','corresi_class_'.$corresi_id,$GLOBALS{'corresi_class'},"2");		
			BCOLINTXTIDCLASS('corresi_quantity_'.$corresi_id,'calcin','corresi_quantity_'.$corresi_id,D80ToN80($GLOBALS{'corresi_quantity'}),"1");
			BCOLINTXTIDCLASS('corresi_area_'.$corresi_id,'calcin','corresi_area_'.$corresi_id,$GLOBALS{'corresi_area'},"1");
			BCOLINTXTIDCLASS('corresi_beds_'.$corresi_id,'','corresi_beds_'.$corresi_id,$GLOBALS{'corresi_beds'},"1");
			BCOLINTXTIDCLASS('corresi_value_'.$corresi_id,'calcin','corresi_value_'.$corresi_id,D80ToN80($GLOBALS{'corresi_value'}),"1");
			BCOLINTXTIDCLASS('corresi_prediscountcalc_'.$corresi_id,'calcres','corresi_prediscountcalc_'.$corresi_id,D80ToN80($GLOBALS{'corresi_prediscountcalc'}),"1");
			BCOLINTXTIDCLASS('corresi_discountpercent_'.$corresi_id,'calcinpercent','corresi_discountpercent_'.$corresi_id,D82ToP82($GLOBALS{'corresi_discountpercent'}),"1");		
			BCOLTXT("&nbsp;","1");
			BCOLINTXTIDCLASS('corresi_postdiscountcalc_'.$corresi_id,'calcres','corresi_postdiscountcalc_'.$corresi_id,D80ToN80($GLOBALS{'corresi_postdiscountcalc'}),"1");
			BCOL("1"); BINBUTTONIDCLASSSPECIAL('corresi_delete_'.$corresi_id,"residelete","danger","x"); B_COL();
			BCOLTXT("&nbsp;","1");
			B_ROW();			
		}		
	}
	XDIV("resilistend","");
	X_DIV("resilistend");
	$backcolor = "#f2d30c";
	if ( $GLOBALS{'corsite_buildresiinternally'} == 'N' ) { $backcolor = "#85C1E9"; }
	BROWEQHTOPPAD();
	BCOLTXTCOLOR("&nbsp;","2",$backcolor,"black");
	BCOLBACKCOLOR($backcolor,"1");
	BINTXTIDCLASS('corsite_dispresitotalunitscalc','calcres','corsite_dispresitotalunitscalc',D80ToN80($GLOBALS{'corsite_dispresitotalunitscalc'}));
	B_COL();
	BCOLBACKCOLOR($backcolor,"1");	
	BINTXTIDCLASS('corsite_dispresitotalsqftcalc','calcres','corsite_dispresitotalsqftcalc',D80ToN80($GLOBALS{'corsite_dispresitotalsqftcalc'}));	
	B_COL();	
	BCOLTXTCOLOR("&nbsp;","3",$backcolor,"black");
	BCOLTXTCOLOR("<b>Residential Sale GDV</b>","2",$backcolor,"black");
	BCOLBACKCOLOR($backcolor,"1");
	BINTXTIDCLASS('corsite_dispresigdvsubtotalcalc','calcres','corsite_dispresigdvsubtotalcalc',D80ToN80($GLOBALS{'corsite_dispresigdvsubtotalcalc'}));
	B_COL();	
		BCOLTXT("&nbsp;<br>&nbsp;","2");	
	B_ROW();
	XBR();
	XDIV("resiothergdvdiv","");
    	BROWEQH();
    	BCOLTXTCOLOR("&nbsp;","7",$backcolor,"black");
    	BCOLTXTCOLOR("<b>Room Lettings GDV</b>","2",$backcolor,"black");
    	BCOLBACKCOLOR($backcolor,"1");
    	BINTXTIDCLASS("corsite_dispresiothergdvcalc","calcres","corsite_dispresiothergdvcalc",D80ToN80($GLOBALS{'corsite_dispresiothergdvcalc'}));
    	B_COL();	
    	BCOLTXT("&nbsp;<br>&nbsp;","2");	
    	B_ROW();
    	XBR();
	X_DIV("resiothergdvdiv");
	BROWEQH();
	BCOLTXTCOLOR("","7","white","black");
	BCOLTXTCOLOR("<b>Total GDV</b>","2","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS('corsite_disptotsitegdvcalc','calcres','corsite_disptotsitegdvcalc',D80ToN80($GLOBALS{'corsite_disptotsitegdvcalc'}));
	B_COL();		
	BCOLTXT("&nbsp;<br>&nbsp;","2");	
	B_ROW();

	XH3("Development");
	XHRCLASS('underline');	
	
	$progtitle = "";
	if ( $GLOBALS{'corprogramme_title'} != "" ) {$progtitle = $GLOBALS{'corprogramme_title'}." ";}
	
	XDIV("InternalBuildDiv","");
		XH4ID("InternalBuildHeader","Internal Build Summary");
		BROW();
		BCOLTXTCOLOR("<b>Internal Build GDV</b><br>&nbsp;","6","#f2f2f2","black");
		BCOLINTXTIDCLASS('corsite_buildingdvtotcalc','calcres','corsite_buildingdvtotcalc',D80ToN80($GLOBALS{'corsite_buildingdvtotcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		XBR();
		BROW();
		BCOLTXT("Land Purchase","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildinlandpurchase","calcin","corsite_buildinlandpurchase",D80ToN80($GLOBALS{'corsite_buildinlandpurchase'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("SDLT (post Apr 2016)","2");
		BCOLINTXTIDCLASS("corsite_buildinsdltpercentcalc",'calcrespercent',"corsite_buildinsdltpercentcalc",D82ToP82($GLOBALS{'corsite_buildinsdltpercentcalc'}),"2");
		BCOLTXT(" ","2");
		BCOLINTXTIDCLASS("corsite_buildinsdltcalc",'calcres','corsite_buildinsdltcalc',D80ToN80($GLOBALS{'corsite_buildinsdltcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Legal Costs","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildinlegals","calcin","corsite_buildinlegals",D80ToN80($GLOBALS{'corsite_buildinlegals'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Agent's Commission - Purchase","2");
		BCOLINTXTIDCLASS("corsite_buildinagentpurchasepercent","calcinpercent","corsite_buildinagentpurchasepercent",D82ToP82($GLOBALS{'corsite_buildinagentpurchasepercent'}),"2");
		BCOLTXT("&nbsp;","2");
		BCOLINTXTIDCLASS('corsite_buildinagentpurchasecalc','calcres','corsite_buildinagentpurchasecalc',D80ToN80($GLOBALS{'corsite_buildinagentpurchasecalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Professional Fees","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildinproffees","calcin","corsite_buildinproffees",D80ToN80($GLOBALS{'corsite_buildinproffees'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("CIL/106 (Old)","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildincil","calcin","corsite_buildincil",D80ToN80($GLOBALS{'corsite_buildincil'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("CIL (sqm | &pound;psm | %)","2");
		BCOLINTXTIDCLASS("corsite_buildincilsqmcalc","calcres","corsite_buildincilsqmcalc",D80ToN80($GLOBALS{'corsite_buildincilsqmcalc'}),"1");
		BCOLINTXTIDCLASS("corsite_buildincilcostpersqm","calcin","corsite_buildincilcostpersqm",D80ToN80($GLOBALS{'corsite_buildincilcostpersqm'}),"1");
		BCOLINTXTIDCLASS("corsite_buildincilpercent","calcinpercent","corsite_buildincilpercent",D82ToP82($GLOBALS{'corsite_buildincilpercent'}),"1");
		BCOLTXT(" ","1");
		BCOLINTXTIDCLASS("corsite_buildincilcalc","calcres","corsite_buildincilcalc",D80ToN80($GLOBALS{'corsite_buildincilcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Section 106","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildin106","calcin","corsite_buildin106",D80ToN80($GLOBALS{'corsite_buildin106'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Development Management Costs","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildinother","calcin","corsite_buildinother",D80ToN80($GLOBALS{'corsite_buildinother'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Build Costs (sqft | &pound;psf | extra%)","2");
		BCOLINTXTIDCLASS("corsite_buildintotalsqftcalc","calcres","corsite_buildintotalsqftcalc",D80ToN80($GLOBALS{'corsite_buildintotalsqftcalc'}),"1");
		BCOLINTXTIDCLASS("corsite_buildincostpersqft","calcin","corsite_buildincostpersqft",D80ToN80($GLOBALS{'corsite_buildincostpersqft'}),"1");
		BCOLINTXTIDCLASS("corsite_buildinextrasqftpercent","calcinpercent","corsite_buildinextrasqftpercent",D82ToP82($GLOBALS{'corsite_buildinextrasqftpercent'}),"1");
		BCOLTXT(" ","1");
		BCOLINTXTIDCLASS("corsite_buildintotalbuildcostcalc","calcres","corsite_buildintotalbuildcostcalc",D80ToN80($GLOBALS{'corsite_buildintotalbuildcostcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Agent's Commission - Sale","2");
		BCOLINTXTIDCLASS("corsite_buildinagentsalepercent","calcinpercent","corsite_buildinagentsalepercent",D82ToP82($GLOBALS{'corsite_buildinagentsalepercent'}),"2");
		BCOLTXT("&nbsp;","2");
		BCOLINTXTIDCLASS('corsite_buildinagentsalecalc','calcres','corsite_buildinagentsalecalc',D80ToN80($GLOBALS{'corsite_buildinagentsalecalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		XBR();		
		BROW();
		BCOLTXTCOLOR("<b>Internal Build Costs Total</b><br>&nbsp;","6","#f2f2f2","black");
		BCOLINTXTIDCLASS('corsite_buildincoststotcalc','calcres','corsite_buildincoststotcalc',D80ToN80($GLOBALS{'corsite_buildincoststotcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		XBR();
		BROWEQH();
		BCOLTXTCOLOR("&nbsp;","7","#f2d30c","black");
		BCOLTXTCOLOR("<b>Internal Build Net Proceeds</b>","2","#f2d30c","black");
		BCOLBACKCOLOR("#f2d30c","1");
		BINTXTIDCLASS('corsite_buildinnpcalc','calcres','corsite_buildinnpcalc',D80ToN80($GLOBALS{'corsite_buildinnpcalc'}));
		B_COL();				
		BCOLTXT("&nbsp;<br>&nbsp;","2");
		B_ROW();
		XBR();
	X_DIV("InternalBuildDiv");			

	
	XDIV("DeveloperBuildDiv","");
		XH4ID("DeveloperBuildHeader","Developer's Build Perspective");
		BROW();
		BCOLTXTCOLOR("<b>Developer Build GDV</b><br>&nbsp;","6","#f2f2f2","black");
		BCOLINTXTIDCLASS('corsite_buildoutgdvtotcalc','calcres','corsite_buildoutgdvtotcalc',D80ToN80($GLOBALS{'corsite_buildoutgdvtotcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		XBR();		
		BROW();
		BCOLTXT("Agent's Commission - Sale","2");	
		BCOLINTXTIDCLASS("corsite_buildoutagentsalepercent","calcinpercent","corsite_buildoutagentsalepercent",D82ToP82($GLOBALS{'corsite_buildoutagentsalepercent'}),"2");
		BCOLTXT("&nbsp;","2");	
		BCOLINTXTIDCLASS('corsite_buildoutagentsalecalc','calcres','corsite_buildoutagentsalecalc',D80ToN80($GLOBALS{'corsite_buildoutagentsalecalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROWEQHTOPPAD();
		BCOLTXT("<b>Value with Planning</b>","2");
		BCOLTXT("&nbsp;</br>&nbsp;","2");
		BCOLTXT("Land Value","1");
		BCOLINTXTIDCLASS('corsite_salelandvaluepercentcalc','calcrespercent','corsite_salelandvaluepercentcalc',D82ToP82($GLOBALS{'corsite_salelandvaluepercentcalc'}),"1");
		BCOLBACKCOLOR("#f2d30c","2");
		BINTXTIDCLASS("corsite_salelandvalue","calcin","corsite_salelandvalue",D80ToN80($GLOBALS{'corsite_salelandvalue'}));	
		B_COL();
		BCOLTXT("Build ROI:","1");
		BCOLINTXTIDCLASS("corsite_buildoutbuilderroipercent","modelinpercent","corsite_buildoutbuilderroipercent",D82ToP82($GLOBALS{'corsite_buildoutbuilderroipercent'}),"1");	
		BCOL("2");	BINBUTTONIDSPECIAL("modelbutton","info","Calc Land Value"); B_COL();
		B_ROW();
		BROW();
		BCOLTXT("SDLT (post Apr 2016)","2");
		BCOLINTXTIDCLASS("corsite_buildoutsdltpercentcalc",'calcrespercent',"corsite_buildoutsdltpercentcalc",D82ToP82($GLOBALS{'corsite_buildoutsdltpercentcalc'}),"2");
		BCOLTXT(" ","2");
		BCOLINTXTIDCLASS("corsite_buildoutsdltcalc",'calcres','corsite_buildoutsdltcalc',D80ToN80($GLOBALS{'corsite_buildoutsdltcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();	
		BROW();
		BCOLTXT("Legal Costs","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildoutlegals","calcin","corsite_buildoutlegals",D80ToN80($GLOBALS{'corsite_buildoutlegals'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();	
		BROW();
		BCOLTXT("Agent's Commission - Purchase","2");
		BCOLINTXTIDCLASS("corsite_buildoutagentpurchasepercent","calcinpercent","corsite_buildoutagentpurchasepercent",D82ToP82($GLOBALS{'corsite_buildoutagentpurchasepercent'}),"2");
		BCOLTXT(" ","2");
		BCOLINTXTIDCLASS('corsite_buildoutagentpurchasecalc','calcres','corsite_buildoutagentpurchasecalc',D80ToN80($GLOBALS{'corsite_buildoutagentpurchasecalc'}),"2");	
		BCOLTXT("&nbsp;","4");
		B_ROW();
		/*	
		BROW();
		BCOLTXT("Tenant Surrender","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildouttenantsurrender","calcin","corsite_buildouttenantsurrender",D80ToN80($GLOBALS{'corsite_buildouttenantsurrender'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		*/	
		BROW();	
		BCOLTXT("Professional Fees","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildoutproffees","calcin","corsite_buildoutproffees",D80ToN80($GLOBALS{'corsite_buildoutproffees'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("CIL (Old)","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildoutcil","calcin","corsite_buildoutcil",D80ToN80($GLOBALS{'corsite_buildoutcil'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("CIL (sqm | &pound;psm | %)","2");
		BCOLINTXTIDCLASS("corsite_buildoutcilsqmcalc","calcres","corsite_buildoutcilsqmcalc",D80ToN80($GLOBALS{'corsite_buildoutcilsqmcalc'}),"1");
		BCOLINTXTIDCLASS("corsite_buildoutcilcostpersqm","calcin","corsite_buildoutcilcostpersqm",D80ToN80($GLOBALS{'corsite_buildoutcilcostpersqm'}),"1");
		BCOLINTXTIDCLASS("corsite_buildoutcilpercent","calcinpercent","corsite_buildoutcilpercent",D82ToP82($GLOBALS{'corsite_buildoutcilpercent'}),"1");		
		BCOLTXT(" ","1");
		BCOLINTXTIDCLASS("corsite_buildoutcilcalc","calcres","corsite_buildoutcilcalc",D80ToN80($GLOBALS{'corsite_buildoutcilcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Section 106","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildout106","calcin","corsite_buildout106",D80ToN80($GLOBALS{'corsite_buildout106'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Development Management Costs","2");
		BCOLTXT(" ","4");
		BCOLINTXTIDCLASS("corsite_buildoutother","calcin","corsite_buildoutother",D80ToN80($GLOBALS{'corsite_buildoutother'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();	
		BROW();
		BCOLTXT("Build Costs (sqft | &pound;psf | extra%)","2");
		BCOLINTXTIDCLASS("corsite_buildouttotalsqftcalc","calcres","corsite_buildouttotalsqftcalc",D80ToN80($GLOBALS{'corsite_buildouttotalsqftcalc'}),"1");	
		BCOLINTXTIDCLASS("corsite_buildoutcostpersqft","calcin","corsite_buildoutcostpersqft",D80ToN80($GLOBALS{'corsite_buildoutcostpersqft'}),"1");	
		BCOLINTXTIDCLASS("corsite_buildoutextrasqftpercent","calcinpercent","corsite_buildoutextrasqftpercent",D82ToP82($GLOBALS{'corsite_buildoutextrasqftpercent'}),"1");
		BCOLTXT(" ","1");
		BCOLINTXTIDCLASS("corsite_buildouttotalbuildcostcalc","calcres","corsite_buildouttotalbuildcostcalc",D80ToN80($GLOBALS{'corsite_buildouttotalbuildcostcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		XBR();
		BROW();	
		BCOLTXTCOLOR("<b>Total Deal Costs Before Interest (ExVAT)</b><br>&nbsp;","6","#f2f2f2","black");	
		BCOLINTXTIDCLASS("corsite_buildouttotaldealcostbeforeintcalc",'calcres','corsite_buildouttotaldealcostbeforeintcalc',D80ToN80($GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'}),"2");	
		BCOLTXT("","1");
		BCOLINTXTIDCLASS("corsite_buildoutgpbeforeintcalc",'calcres','corsite_buildoutgpbeforeintcalc',D80ToN80($GLOBALS{'corsite_buildoutgpbeforeintcalc'}),"1");
		BCOLTXT("<b>Gross Profit Before Interest</b>","2");
		B_ROW();
		
		BROW();
		BCOLTXT("&nbsp;<br>&nbsp;","9");
		BCOLINTXTIDCLASS("corsite_buildoutgpbeforeintpercentcalc",'calcrespercent','corsite_buildoutgpbeforeintpercentcalc',D82ToP82($GLOBALS{'corsite_buildoutgpbeforeintpercentcalc'}),"1");
		BCOLTXT("&nbsp;","2");
		B_ROW();	
		
		BROW();
		BCOLTXT("VATable amount (%vatable|rate)","2");
		BCOLINTXTIDCLASS("corsite_buildoutvatablepercent","calcinpercent","corsite_buildoutvatablepercent",D82ToP82($GLOBALS{'corsite_buildoutvatablepercent'}),"2");
		BCOLTXT("Vat Rate","1");
		BCOLINTXTIDCLASS("corsite_buildoutvatratepercent","calcinpercent","corsite_buildoutvatratepercent",D82ToP82($GLOBALS{'corsite_buildoutvatratepercent'}),"1");
		BCOLINTXTIDCLASS('corsite_buildoutvatcalc','calcres','corsite_buildoutvatcalc',D80ToN80($GLOBALS{'corsite_buildoutvatcalc'}),"2");
		BCOLTXT("&nbsp;","4");				
		B_ROW();
		/*
		BROW();
		BCOLTXT("Financing Costs at Loan to Cost","2");
		BCOLINTXTIDCLASS("corsite_buildoutfinancingltvpercent","calcinpercent","corsite_buildoutfinancingltvpercent",D82ToP82($GLOBALS{'corsite_buildoutfinancingltvpercent'}),"2");
		BCOLTXT("Int Rate","1");
		BCOLINTXTIDCLASS("corsite_buildoutfinancingintratepercent","calcinpercent","corsite_buildoutfinancingintratepercent",D82ToP82($GLOBALS{'corsite_buildoutfinancingintratepercent'}),"1");
		BCOLINTXTIDCLASS("corsite_buildoutfinancingcostscalc",'calcres','corsite_buildoutfinancingcostscalc',D80ToN80($GLOBALS{'corsite_buildoutfinancingcostscalc'}),"2");	
		BCOLTXT("&nbsp;","4");
		B_ROW();
		*/
		BROW();
		BCOLTXT("Financing Costs at Loan to Cost","2");
		BCOLINTXTIDCLASS("corsite_buildoutfinancingltvpercent","calcinpercent","corsite_buildoutfinancingltvpercent",D82ToP82($GLOBALS{'corsite_buildoutfinancingltvpercent'}),"2");	
		BCOLTXT("Net Borrowing","2");
		BCOLINTXTIDCLASS("corsite_buildoutfinancingnetborrowingcalc",'calcres','corsite_buildoutfinancingnetborrowingcalc',D80ToN80($GLOBALS{'corsite_buildoutfinancingnetborrowingcalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();
		BROW();
		BCOLTXT("Financing Interest Rate","2");
		BCOLINTXTIDCLASS("corsite_buildoutfinancingintratepercent","calcinpercent","corsite_buildoutfinancingintratepercent",D82ToP82($GLOBALS{'corsite_buildoutfinancingintratepercent'}),"2");	
		BCOLTXT("Duration (Mths)","1");
		BCOLINTXTIDCLASS("corsite_buildoutfinancingduration","calcin","corsite_buildoutfinancingduration",D80ToN80($GLOBALS{'corsite_buildoutfinancingduration'}),"1");
		BCOLINTXTIDCLASS("corsite_buildoutfinancingcostscalc",'calcres','corsite_buildoutfinancingcostscalc',D80ToN80($GLOBALS{'corsite_buildoutfinancingcostscalc'}),"2");
		BCOLTXT("&nbsp;","4");
		B_ROW();	
		
		XBR();	
		BROW();
		BCOLTXTCOLOR("<b>Total Deal Costs After Interest (ExVAT)</b><br>&nbsp;","6","#f2f2f2","black");	
		BCOLINTXTIDCLASS("corsite_buildouttotaldealcostafterintcalc",'calcres','corsite_buildouttotaldealcostafterintcalc',D80ToN80($GLOBALS{'corsite_buildouttotaldealcostafterintcalc'}),"2");
		BCOLTXT("","1");
		BCOLINTXTIDCLASS("corsite_buildoutnpafterintcalc",'calcres','corsite_buildoutnpafterintcalc',D80ToN80($GLOBALS{'corsite_buildoutnpafterintcalc'}),"1");	
		BCOLTXT("<b>Net Profit after Interest</b>","2");
		B_ROW();	
		BROW();
		BCOLTXT("&nbsp;<br>&nbsp;","9");
		BCOLINTXTIDCLASS("corsite_buildoutnpafterintpercentcalc",'calcrespercent','corsite_buildoutnpafterintpercentcalc',D82ToP82($GLOBALS{'corsite_buildoutnpafterintpercentcalc'}),"1");
		BCOLTXT("","2");
		B_ROW();
		XBR();
		BROW();
		BCOLTXT("","4");	
		BCOLTXT("Tax Rate","1");
		BCOLINTXTIDCLASS("corsite_buildouttaxratepercent","calcinpercent","corsite_buildouttaxratepercent",D82ToP82($GLOBALS{'corsite_buildouttaxratepercent'}),"1");		
		BCOLTXT("","3");	
		BCOLINTXTIDCLASS("corsite_buildoutnpafterintandtaxcalc",'calcres','corsite_buildoutnpafterintandtaxcalc',D80ToN80($GLOBALS{'corsite_buildoutnpafterintandtaxcalc'}),"1");		
		BCOLTXT("<b>Net Profit after Interest and Tax</b>","2");
		B_ROW();
		BROW();
		BCOLTXT("&nbsp;<br>&nbsp;","9");
		BCOLINTXTIDCLASS("corsite_buildoutnpafterintandtaxpercentcalc",'calcrespercent','corsite_buildoutnpafterintandtaxpercentcalc',D82ToP82($GLOBALS{'corsite_buildoutnpafterintandtaxpercentcalc'}),"1");
		BCOLTXT("","2");
		B_ROW();	
		XBR();
		BROWEQH();
		BCOLTXTCOLOR("&nbsp;","7","#f2d30c","black");
		BCOLTXTCOLOR("<b>".$progtitle."Proceeds from Developer Sale</b>","2","#f2d30c","black");
		BCOLBACKCOLOR("#f2d30c","1");
		BINTXTIDCLASS('corsite_buildoutnpcalc','calcres','corsite_buildoutnpcalc',D80ToN80($GLOBALS{'corsite_buildoutnpcalc'}));
		B_COL();		
		BCOLTXT("&nbsp;<br>&nbsp;","2");
		B_ROW();
	X_DIV("DeveloperBuildDiv");	
	
	XHRCLASS('underline');
	BROWEQHTOPPAD();
	BCOLTXTCOLOR("&nbsp;","7","#f2d30c","black");
	BCOLTXTCOLOR("<b>".$progtitle."Gross Proceeds</b>","2","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS('corsite_buildtotalgpcalc','calcres','corsite_buildtotalgpcalc',D80ToN80($GLOBALS{'corsite_buildtotalgpcalc'}));
	B_COL();		
	BCOLTXT("&nbsp;<br>&nbsp;","2");
	B_ROW();

	XINHIDID("corsite_buildtotalgrossproceeds","corsite_buildtotalgrossproceeds",$GLOBALS{'corsite_buildtotalgrossproceeds'});
	// BROW();
	// BCOLTXTCOLOR("<b>Gross Proceeds</b>","6","#c2f0c2","black");
	// BCOLINTXTIDCLASS("corsite_buildtotalgrossproceeds","calcres","corsite_buildtotalgrossproceeds",D80ToN80($GLOBALS{'corsite_buildtotalgrossproceeds'}),"2");
	// BCOLTXT("&nbsp;","4");
	// B_ROW();	
	BROW();
	BCOLTXT("&nbsp;","7");
	BCOLTXT("Planning - Professional Fees","2");
	BCOLINTXTIDCLASS("corsite_buildtotalplanningproffees","calcres","corsite_buildtotalplanningproffees",D80ToN80($GLOBALS{'corsite_buildtotalplanningproffees'}),"1");
	BCOLTXT("&nbsp;","2");
	B_ROW();
	BROW();
	BCOLTXT("&nbsp;","7");
	BCOLTXT("Planning - Submission Fee","2");
	BCOLINTXTIDCLASS("corsite_buildtotalplanningsubmissionfees","calcres","corsite_buildtotalplanningsubmissionfees",D80ToN80($GLOBALS{'corsite_buildtotalplanningsubmissionfees'}),"1");
	BCOLTXT("&nbsp;","2");
	B_ROW();
	BROW();
	BCOLTXT("&nbsp;","7");
	BCOLTXT("Planning - Success Fees","2");
	BCOLINTXTIDCLASS("corsite_buildtotalplanningsuccessfees","calcres","corsite_buildtotalplanningsuccessfees",D80ToN80($GLOBALS{'corsite_buildtotalplanningsuccessfees'}),"1");
	BCOLTXT("&nbsp;","2");
	B_ROW();
	BROW();
	BCOLTXT("&nbsp;","7");
	BCOLTXT("Legal Costs","2");
	BCOLINTXTIDCLASS("corsite_buildtotallegalcosts","calcin","corsite_buildtotallegalcosts",D80ToN80($GLOBALS{'corsite_buildtotallegalcosts'}),"1");
	BCOLTXT("&nbsp;","2");
	B_ROW();	
	BROW();
	BCOLTXT("&nbsp;","7");	
	BCOLTXT("Other Costs","2");
	BCOLINTXTIDCLASS("corsite_buildtotalothercosts","calcin","corsite_buildtotalothercosts",D80ToN80($GLOBALS{'corsite_buildtotalothercosts'}),"1");
	BCOLTXT("&nbsp;","2");
	B_ROW();
	BROW();
	BCOLTXT("&nbsp;","7");
	BCOLTXT("CAPEX","2");
	BCOLINTXTIDCLASS("corsite_buildtotalcapex","calcin","corsite_buildtotalcapex",D80ToN80($GLOBALS{'corsite_buildtotalcapex'}),"1");
	BCOLTXT("&nbsp;","2");
	B_ROW();
	BROW();
	BCOLTXT("&nbsp;","7");
	BCOLTXT("Loss of EBITDA (Closure)","2");
	BCOLINTXTIDCLASS("corsite_buildtotallossofebitda","calcin","corsite_buildtotallossofebitda",D80ToN80($GLOBALS{'corsite_buildtotallossofebitda'}),"1");
	BCOLTXT("Assume 12 Mths","2");
	B_ROW();	
	BROWEQHTOPPAD();
	BCOLTXTCOLOR("&nbsp;","7","#f2d30c","black");	
	BCOLTXTCOLOR("<b>Net Proceeds</b>","2","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS('corsite_buildtotalnetproceeds','calcres','corsite_buildtotalnetproceeds',D80ToN80($GLOBALS{'corsite_buildtotalnetproceeds'}));
	B_COL();	
	BCOLTXT("&nbsp;<br>&nbsp;","2");	
	B_ROW();
	XHRCLASS('underline');
	XDIV("EBITDAReduction","");	
		BROW();
		BCOLTXT("Curr EBITDA","1");
		BCOLINTXTIDCLASS('corsite_currfinlatestebitdacopy','calcres','corsite_currfinlatestebitdacopy',D80ToN80($GLOBALS{'corsite_currfinlatestebitda'}),"1");
		BCOLTXT("Predicted EBITDA %","1");
		BCOLINTXTIDCLASS('corsite_predictedebitdapercent','calcin','corsite_predictedebitdapercent',D82ToP82($GLOBALS{'corsite_predictedebitdapercent'}),"1");
		BCOLTXT("Predicted EBITDA","1");
		BCOLINTXTIDCLASS('corsite_predictedebitdacalc','calcres','corsite_predictedebitdacalc',D80ToN80($GLOBALS{'corsite_predictedebitdacalc'}),"1");
		BCOLTXT("EBITDA Multiple","1");
		BCOLINTXTIDCLASS('corsite_ebitdamultiple','calcin','corsite_ebitdamultiple',D82ToN82($GLOBALS{'corsite_ebitdamultiple'}),"1");
		BCOLTXT("CapVal EBITDA Impact","1");
		BCOLINTXTIDCLASS('corsite_capvalebitdaimpactcalc','calcres','corsite_capvalebitdaimpactcalc',D80ToN80($GLOBALS{'corsite_capvalebitdaimpactcalc'}),"1");
		BCOLTXT("&nbsp;","2");
		B_ROW();
	X_DIV("EBITDAReduction");
	BROWEQHTOPPAD();
	BCOLTXTCOLOR("","7","white","black");
	BCOLTXTCOLOR("<b>Uplift</b>","2","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS('corsite_upliftcalc','calcres','corsite_upliftcalc',D80ToN80($GLOBALS{'corsite_upliftcalc'}));
	B_COL();
	BCOLTXTID('corsite_upliftcalcexplanation',"","2");
	B_ROW();
	
	if ( ($GLOBALS{'corlevel'} > 4 )&&($GLOBALS{'corprogramme_upliftcorsharepercent'} != 0)) {
	    BROWEQHTOPPAD();
	    BCOLTXTCOLOR("","7","white","black");
	    BCOLTXTCOLOR("Cordage Profit Share","1","white","black");
	    BCOLTXT(D82ToP82($GLOBALS{'corprogramme_upliftcorsharepercent'}),"1");
	    XINHIDID("corsite_upliftcorsharepercent","corsite_upliftcorsharepercent",$GLOBALS{'corprogramme_upliftcorsharepercent'});
	    BCOLINTXTIDCLASS('corsite_upliftcorsharecalc','calcres','corsite_upliftcorsharecalc',D80ToN80($GLOBALS{'corsite_upliftcorsharecalc'}),"1");
	    BCOLTXTCOLOR("","2","white","black");
	    B_ROW();
	} else {
	    XINHIDID("corsite_upliftcorsharepercent","corsite_upliftcorsharepercent",$GLOBALS{'corprogramme_upliftcorsharepercent'});
	    XINHIDID("corsite_upliftcorsharecalc","corsite_upliftcorsharecalc",$GLOBALS{'corsite_upliftcorsharecalc'});
	}
	if ( ($GLOBALS{'corlevel'} > 4 )&&($GLOBALS{'corprogramme_upliftclientsharepercent'} != 0)) {
	    BROWEQHTOPPAD();
	    BCOLTXTCOLOR("","7","white","black");
	    BCOLTXTCOLOR("Net ".$GLOBALS{'corprogramme_name'}." Share","1","white","black");
	    BCOLTXT(D82ToP82($GLOBALS{'corprogramme_upliftclientsharepercent'}),"1");
	    XINHIDID("corsite_upliftclientsharepercent","corsite_upliftclientsharepercent",$GLOBALS{'corprogramme_upliftclientsharepercent'});
	    BCOLINTXTIDCLASS('corsite_upliftclientsharecalc','calcres','corsite_upliftclientsharecalc',D80ToN80($GLOBALS{'corsite_upliftclientsharecalc'}),"1");
	    BCOLTXTCOLOR("","2","white","black");
	    B_ROW();
	} else {
	    XINHIDID("corsite_upliftclientsharepercent","corsite_upliftclientsharepercent",$GLOBALS{'corprogramme_upliftclientsharepercent'});
	    XINHIDID("corsite_upliftclientsharecalc","corsite_upliftclientsharecalc",$GLOBALS{'corprogramme_upliftclientsharecalc'});
	}

	
	
}

function FA2ContentOutput() {

	XBR();
	XH3("Financial Appraisal 2");
	XHRCLASS('underline');
	/*
	 XBR();
	BROW();
	BCOLTXT("1","3");
	BCOLTXT("1","1");
	BCOLTXT("1","1");
	BCOLTXT("1","1");
	BCOLTXT("1","6");
	B_ROW();
	*/
	XBR();
	BROW();
	BCOLTXT("","3");
	BCOLTXT("Full Site Disposal","1");
	BCOLTXT("","1");
	BCOLTXT("Part Site Disposal","1");
	BCOLTXT("","6");
	B_ROW();
	XBR();
	BROW();
	BCOLTXT("LTM EBITDA","3");
	BCOLINTXTIDCLASS("corsite_appltmebitdafull","calcin","corsite_appltmebitdafull",D80ToN80($GLOBALS{'corsite_appltmebitdafull'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appltmebitdapart","calcin","corsite_appltmebitdapart",D80ToN80($GLOBALS{'corsite_appltmebitdapart'}),"1");
	BCOLTXT("","6");
	B_ROW();
	BROW();
	BCOLTXT("Capex Opportunity","3");
	BCOLINSELECTHASHID (List2Hash('Yes,No'),'corsite_appcapexoppfull','corsite_appcapexoppfull',$GLOBALS{'corsite_appcapexoppfull'},"1");
	BCOLTXT("","1");
	BCOLINSELECTHASHID (List2Hash('Yes,No'),'corsite_appcapexopppart','corsite_appcapexopppart',$GLOBALS{'corsite_appcapexopppart'},"1");
	BCOLTXT("","6");
	B_ROW();
	BROW();
	BCOLTXT("Capex Spend Required","3");
	BCOLINTXTIDCLASS("corsite_appcapexspendfull","calcin","corsite_appcapexspendfull",D80ToN80($GLOBALS{'corsite_appcapexspendfull'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appcapexspendpart","calcin","corsite_appcapexspendpart",D80ToN80($GLOBALS{'corsite_appcapexspendpart'}),"1");
	BCOLTXT("","6");
	B_ROW();
	BROW();
	BCOLTXT("FWD 12 Month EBITDA","3");
	BCOLINTXTIDCLASS("corsite_appfwdebitdafull","calcin","corsite_appfwdebitdafull",D80ToN80($GLOBALS{'corsite_appfwdebitdafull'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appfwdebitdapart","calcin","corsite_appfwdebitdapart",D80ToN80($GLOBALS{'corsite_appfwdebitdapart'}),"1");
	BCOLTXT("","6");
	B_ROW();
	BROW();
	BCOLTXT("","7");
	$text = "FWD EBITDA could be higher or lower, depending on whether it is:<br>";
	$text = $text."i) A Capex opportunity that will enhance trade;<br>";
	$text = $text."ii) Capex opportunity but defensive and therefore no growth in EBITDA;<br>";
	$text = $text."iii) change in local market factors / tenant etc. lead ops to conclude that fwd EBITDA is likely to decline and remain at that level for the foreseable future";
	BCOLTXTCOLOR($text,"5","#f2f2f2","black");
	B_ROW();
	BROW();
	BCOLTXT("<b>Base Case EBITDA</b>","3");
	BCOLINTXTIDCLASS("corsite_appbaseebitdafullcalc","calcres","corsite_appbaseebitdafullcalc",D80ToN80($GLOBALS{'corsite_appbaseebitdafullcalc'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appbaseebitdapartcalc","calcres","corsite_appbaseebitdapartcalc",D80ToN80($GLOBALS{'corsite_appbaseebitdapartcalc'}),"1");
	BCOLTXT("","1");
	$text = "Scenario 1: If FWD EBITDA > LTM EBITDA then Max(Fwd, LTM EBITDA)<br>";
	$text = $text."Scenario 2: If FWD EBITDA < LTM EBITDA then Min(FWD, LTM EBITDA)";
	BCOLTXTCOLOR($text,"5","#f2f2f2","black");
	B_ROW();
	XBR();
	BROW();
	BCOLTXT("EBITDA Multiple","3");
	BCOLINTXTIDCLASS("corsite_appebitdamultiplefull","calcin","corsite_appebitdamultiplefull",D82ToN82($GLOBALS{'corsite_appebitdamultiplefull'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appebitdamultiplepart","calcin","corsite_appebitdamultiplepart",D82ToN82($GLOBALS{'corsite_appebitdamultiplepart'}),"1");
	BCOLTXT("","6");
	B_ROW();
	XBR();
	BROWEQH();
	BCOLTXTCOLOR("Implied Value","3","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS("corsite_appimpliedvalfullcalc","calcres","corsite_appimpliedvalfullcalc",D80ToN80($GLOBALS{'corsite_appimpliedvalfullcalc'}));
	B_COL();
	BCOLTXTCOLOR("&nbsp;","1","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS("corsite_appimpliedvalpartcalc","calcres","corsite_appimpliedvalpartcalc",D80ToN80($GLOBALS{'corsite_appimpliedvalpartcalc'}));
	B_COL();
	BCOLTXTCOLOR("&nbsp;","1","#f2d30c","black");
	$text = "In the event Ops believe capex can enhance trade, the implied value based off the revised EBITDA is calculated net off capex investment to arrive at a net cash position at which Punch would prefer to sell the property today (not withstanding Time Value of Money today vs. in future)";
	BCOLTXTCOLOR($text,"5","#f2f2f2","black");
	B_ROW();
	XBR();
	BROW();
	BCOLTXT("GVA Value","3");
	BCOLINTXTIDCLASS("corsite_appgvavalfull","calcin","corsite_appgvavalfull",D80ToN80($GLOBALS{'corsite_appgvavalfull'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appgvavalpart","calcin","corsite_appgvavalpart",D80ToN80($GLOBALS{'corsite_appgvavalpart'}),"1");
	BCOLTXT("","6");
	B_ROW();
	XBR();
	BROWEQH();
	BCOLTXTCOLOR("<b>Base Value - Higher of GVA or Implied Value</b>","3","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS("corsite_appbasevalfullcalc","calcres","corsite_appbasevalfullcalc",D80ToN80($GLOBALS{'corsite_appbasevalfullcalc'}));
	B_COL();
	BCOLTXTCOLOR("&nbsp;","1","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS("corsite_appbasevalpartcalc","calcres","corsite_appbasevalpartcalc",D80ToN80($GLOBALS{'corsite_appbasevalpartcalc'}));
	B_COL();
	BCOLTXTCOLOR("&nbsp;","1","#f2d30c","black");
	BCOLTXT("","5");
	B_ROW();

	XBR();
	BROW();
	BCOLTXT("Gross Disposal Proceeds","3");
	BCOLINTXTIDCLASS("corsite_appgdprocfull","calcin","corsite_appgdprocfull",D80ToN80($GLOBALS{'corsite_appgdprocfull'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appgdprocpart","calcin","corsite_appgdprocpart",D80ToN80($GLOBALS{'corsite_appgdprocpart'}),"1");
	BCOLTXT("","6");
	B_ROW();
	BROW();
	BCOLTXT("&nbsp;&nbsp;&nbsp;&nbsp; - Planning Costs","3");
	BCOLINTXTIDCLASS("corsite_appplanningcostsfull","calcin","corsite_appplanningcostsfull",D80ToN80($GLOBALS{'corsite_appplanningcostsfull'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appplanningcostspart","calcin","corsite_appplanningcostspart",D80ToN80($GLOBALS{'corsite_appplanningcostspart'}),"1");
	BCOLTXT("","6");
	B_ROW();
	BROW();
	BCOLTXT("&nbsp;&nbsp;&nbsp;&nbsp; - Legal Costs","3");
	BCOLINTXTIDCLASS("corsite_applegalcostsfull","calcin","corsite_applegalcostsfull",D80ToN80($GLOBALS{'corsite_applegalcostsfull'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_applegalcostspart","calcin","corsite_applegalcostspart",D80ToN80($GLOBALS{'corsite_applegalcostspart'}),"1");
	BCOLTXT("","6");
	B_ROW();
	BROW();
	BCOLTXT("&nbsp;&nbsp;&nbsp;&nbsp; - Other Costs","3");
	BCOLINTXTIDCLASS("corsite_appothercostsfull","calcin","corsite_appothercostsfull",D80ToN80($GLOBALS{'corsite_appothercostsfull'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appothercostspart","calcin","corsite_appothercostspart",D80ToN80($GLOBALS{'corsite_appothercostspart'}),"1");
	BCOLTXT("","6");
	B_ROW();

	XBR();
	BROWEQH();
	BCOLTXTCOLOR("<b>Net proceeds</b>","3","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS("corsite_appnprocfullcalc","calcres","corsite_appnprocfullcalc",D80ToN80($GLOBALS{'corsite_appnprocfullcalc'}));
	B_COL();
	BCOLTXTCOLOR("&nbsp;","1","#f2d30c","black");
	BCOLBACKCOLOR("#f2d30c","1");
	BINTXTIDCLASS("corsite_appnprocpartcalc","calcres","corsite_appnprocpartcalc",D80ToN80($GLOBALS{'corsite_appnprocpartcalc'}));
	B_COL();
	BCOLTXTCOLOR("&nbsp;","1","#f2d30c","black");
	BCOLTXT("","5");
	B_ROW();

	XBR();
	BROW();
	BCOLTXT("Net Proceeds vs Base Value","3");
	BCOLINTXTIDCLASS("corsite_appnprocvsbasevalfullcalc","calcres","corsite_appnprocvsbasevalfullcalc",D80ToN80($GLOBALS{'corsite_appnprocvsbasevalfullcalc'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appnprocvsbasevalpartcalc","calcres","corsite_appnprocvsbasevalpartcalc",D80ToN80($GLOBALS{'corsite_appnprocvsbasevalpartcalc'}),"1");
	BCOLTXT("","6");
	B_ROW();
	BROW();
	BCOLTXT("Net Proceeds vs Base Value%","3");
	BCOLINTXTIDCLASS("corsite_appnprocvsbasevalfullpercentcalc","calcres","corsite_appnprocvsbasevalfullpercentcalc",D82ToP82($GLOBALS{'corsite_appnprocvsbasevalfullpercentcalc'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appnprocvsbasevalpartpercentcalc","calcres","corsite_appnprocvsbasevalpartpercentcalc",D82ToP82($GLOBALS{'corsite_appnprocvsbasevalpartpercentcalc'}),"1");
	BCOLTXT("","6");
	B_ROW();
	BROW();
	BCOLTXT("Retain vs. Dispose","3");
	BCOLINTXTIDCLASS("corsite_appdisposalstrategyfullcalc","calcres","corsite_appdisposalstrategyfullcalc",$GLOBALS{'corsite_appdisposalstrategyfullcalc'},"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appdisposalstrategypartcalc","calcres","corsite_appdisposalstrategypartcalc",$GLOBALS{'corsite_appdisposalstrategypartcalc'},"1");
	BCOLTXT("","6");
	B_ROW();

	XBR();
	BROW();
	BCOLTXT("Implied Multiple","3");
	BCOLINTXTIDCLASS("corsite_appimpliedmultiplefullcalc","calcres","corsite_appimpliedmultiplefullcalc",D82ToN82($GLOBALS{'corsite_appimpliedmultiplefullcalc'}),"1");
	BCOLTXT("","1");
	BCOLINTXTIDCLASS("corsite_appimpliedmultiplepartcalc","calcres","corsite_appimpliedmultiplepartcalc",D82ToN82($GLOBALS{'corsite_appimpliedmultiplepartcalc'}),"1");
	BCOLTXT("","6");
	B_ROW();

}


function FA3ContentOutput() {
    
    XBR();
    XH3("Financial Appraisal 3");
    XHRCLASS('underline');
    
    XBR();
    BROW();
    BCOLTXT("","3");
    BCOLTXT("","3");
    BCOLTXT("","3");
    B_ROW();
    XBR();
    
    BROW();
    BCOLTXT("Number of rooms","2");
    BCOLINTXTIDCLASS("corsite_app2roomqty","calcin","corsite_app2roomqty",D80ToN80($GLOBALS{'corsite_app2roomqty'}),"2");
    BCOLTXT("","2");
    BCOLTXT("","6");
    B_ROW();
    BROW();
    BCOLTXT("Average Daily Rate","2");
    BCOLINTXTIDCLASS("corsite_app2roomdailyrate","calcin","corsite_app2roomdailyrate",D80ToN80($GLOBALS{'corsite_app2roomdailyrate'}),"2");
    BCOLINTXTIDCLASS("corsite_app2roomdailyrevenuecalc","calcres","corsite_app2roomdailyrevenuecalc",D80ToN80($GLOBALS{'corsite_app2roomdailyrevenuecalc'}),"2");
    BCOLTXT("","6");
    B_ROW();
    BROW();
    BCOLTXT("Occupancy","2");
    BCOLINTXTIDCLASS("corsite_app2roomoccupancypercent","calcinpercent","corsite_app2roomoccupancypercent",D80ToN80($GLOBALS{'corsite_app2roomoccupancypercent'}),"2");
    BCOLINTXTIDCLASS("corsite_app2roomoccupancycalc","calcres","corsite_app2roomoccupancycalc",D80ToN80($GLOBALS{'corsite_app2roomoccupancycalc'}),"2");
    BCOLTXT("","6");
    B_ROW();
    BROW();
    BCOLTXT("Margin","2");
    BCOLINTXTIDCLASS("corsite_app2roommarginpercent","calcinpercent","corsite_app2roommarginpercent",D80ToN80($GLOBALS{'corsite_app2roommarginpercent'}),"2");
    BCOLINTXTIDCLASS("corsite_app2roommargincalc","calcres","corsite_app2roommargincalc",D80ToN80($GLOBALS{'corsite_app2roommargincalc'}),"2");
    BCOLTXT("","6");
    B_ROW();
    BROW();
    BCOLTXT("Maintenance","2");
    BCOLINTXTIDCLASS("corsite_app2roommaintenancepercent","calcinpercent","corsite_app2roommaintenancepercent",D80ToN80($GLOBALS{'corsite_app2roommaintenancepercent'}),"2");
    BCOLINTXTIDCLASS("corsite_app2roommaintenancecalc","calcres","corsite_app2roommaintenancecalc",D80ToN80($GLOBALS{'corsite_app2roommaintenancecalc'}),"2");
    BCOLTXT("","6");
    B_ROW();
    BROW();
    BCOLTXT("","2");
    BCOLTXT("","2");
    BCOLINTXTIDCLASS("corsite_app2roomdailyprofitcalc","calcres","corsite_app2roomdailyprofitcalc",D80ToN80($GLOBALS{'corsite_app2roomdailyprofitcalc'}),"2");
    BCOLTXT("","6");
    B_ROW();
    BROW();
    BCOLTXT("Enhanced Annual Profits","2");
    BCOLINTXTIDCLASS("corsite_app2roomannualprofitpercent","calcinpercent","corsite_app2roomannualprofitpercent",D80ToN80($GLOBALS{'corsite_app2roomannualprofitpercent'}),"2");
    BCOLINTXTIDCLASS("corsite_app2roomannualprofitcalc","calcres","corsite_app2roomannualprofitcalc",D80ToN80($GLOBALS{'corsite_app2roomannualprofitcalc'}),"2");
    BCOLTXT("","6");
    B_ROW();
    BROW();
    BCOLTXT("EBITDA Multiple","2");
    BCOLTXT("","2");
    BCOLINTXTIDCLASS("corsite_app2roomebitdamultiple","calcin","corsite_app2roomebitdamultiple",D80ToN80($GLOBALS{'corsite_app2roomebitdamultiple'}),"2");
    BCOLTXT("","2");
    BCOLTXT("","6");
    B_ROW();
    BROW();
    BCOLTXT("EBITDA (GDV)","2");
    BCOLTXT("","2");
    BCOLINTXTIDCLASS("corsite_app2roomebitdacalc","calcres","corsite_app2roomebitdacalc",D80ToN80($GLOBALS{'corsite_app2roomebitdacalc'}),"2");
    BCOLTXT("","2");
    BCOLTXT("","6");
    B_ROW();
}


function PLNGContentOutput() {
	XBR();
	XH3("Planning");
	XHRCLASS('underline');
	XBR();

	BROWTOP();
	BCOLTXT("Planning Summary<br>(WYG Feedback, summary of key points)","3");
	BCOLINTEXTAREAID('corsite_plgplgsummary','corsite_plgplgsummary',$GLOBALS{'corsite_plgplgsummary'},"2","9");
	B_ROW();
	XBR();	

	BROW();
	BCOLTXT("Google/Social Media Update:","3");
	BCOLINTEXTAREAID('corsite_plgsocialmediaobjections','corsite_plgsocialmediaobjections',$GLOBALS{'corsite_plgsocialmediaobjections'},"2","9");
	B_ROW();
	XBR();
	BROW();
	BCOLTXT("Current Planning Submission Type","1");
	BCOLINSELECTHASHID(List2Hash(',PrePlanning,Planning,ReSubmission,Appeal'),'corsite_plgplgsubmittype','corsite_plgplgsubmittype',$GLOBALS{'corsite_plgplgsubmittype'},"1");
	BCOLTXT("","10");
	B_ROW();
	BROW();
    BCOLTXT("Submission Status","1");
	BCOLINSELECTHASHID(List2Hash('InProgress,Submitted,OnHold'),'corsite_plgplgsubmitstatus','corsite_plgplgsubmitstatus',$GLOBALS{'corsite_plgplgsubmitstatus'},"1");
	BCOLTXT("Submission Date","1");
	BCOLINDATEID('corsite_plgplgsubmitdate','corsite_plgplgsubmitdate',$GLOBALS{'corsite_plgplgsubmitdate'},"dd/mm/yyyy","1");	
	BCOLTXT("Submitter Name","1");
	BCOLINTXTID('corsite_plgplgsubmittedby','corsite_plgplgsubmittedby',$GLOBALS{'corsite_plgplgsubmittedby'},"1");
	BCOLTXT("Planning Reference Number","1");
	BCOLINTXTID('corsite_plgplgrefnum','corsite_plgplgrefnum',$GLOBALS{'corsite_plgplgrefnum'},"2");	
	BCOLTXTCOLOR("<b>Tenant Engaged</b><br>&nbsp;","2","gray","white");
	// BCOLINTXTID('corsite_plgtenantengaged','corsite_plgtenantengaged',$GLOBALS{'corsite_plgtenantengaged'},"1");
	if ($GLOBALS{'corsite_plgtenantengaged'} == "") { $GLOBALS{'corsite_plgtenantengaged'} = "N"; }
	BCOLINSELECTHASHIDCLASS (List2Hash('Y,N,NA'),'corsite_plgtenantengaged','rag','corsite_plgtenantengaged',$GLOBALS{'corsite_plgtenantengaged'},"1");
	
	
	B_ROW();
	BROW();
	BCOLTXT("Validation Date","1");
	BCOLINDATEID('corsite_plgplgvalidationdate','corsite_plgplgvalidationdate',$GLOBALS{'corsite_plgplgvalidationdate'},"dd/mm/yyyy","1");
	BCOLTXT("Consultation End Date","1");
	BCOLINDATEID('corsite_plgplgconsultationenddate','corsite_plgplgconsultationenddate',$GLOBALS{'corsite_plgplgconsultationenddate'},"dd/mm/yyyy","1");
	BCOLTXT("Target Determination Date","1"); 
	BCOLINDATEID('corsite_plgtargetdeterminationdate','corsite_plgtargetdeterminationdate',$GLOBALS{'corsite_plgtargetdeterminationdate'},"dd/mm/yyyy","1");
	BCOLTXT("Determination Date","1"); 
	BCOLINDATEID('corsite_plgdeterminationdate','corsite_plgdeterminationdate',$GLOBALS{'corsite_plgdeterminationdate'},"dd/mm/yyyy","1");	
	BCOLTXT("","1");
	BCOLTXTCOLOR("<b>Planning Pack to Tenant</b><br>&nbsp;","2","gray","white");	
	// BCOLINTXTID('corsite_plgtenantpack','corsite_plgtenantpack',$GLOBALS{'corsite_plgtenantpack'},"1");
	if ($GLOBALS{'corsite_plgtenantpack'} == "") { $GLOBALS{'corsite_plgtenantpack'} = "N"; }
	BCOLINSELECTHASHIDCLASS (List2Hash('Y,N,NA'),'corsite_plgtenantpack','rag','corsite_plgtenantpack',$GLOBALS{'corsite_plgtenantpack'},"1");
	B_ROW();
	BROW();
	BCOLTXT("Decision","1");
	BCOLINSELECTHASHID(List2Hash(',Approved,Refused'),'corsite_plgdeterminationresult','corsite_plgdeterminationresult',$GLOBALS{'corsite_plgdeterminationresult'},"1");
	// BCOLTXT("Decision Notes","1");
	// BCOLINTEXTAREAID('corsite_plgdeterminationnotes','corsite_plgdeterminationnotes',$GLOBALS{'corsite_plgdeterminationnotes'},"2","5");	
	// BCOLTXT("","1");
	BCOLTXT("","7");
	BCOLTXTCOLOR("<b>Parish Council Informed</b><br>&nbsp;","2","gray","white");
	// BCOLINTXTID('corsite_plgparishengaged','corsite_plgparishengaged',$GLOBALS{'corsite_plgparishengaged'},"1");
	if ($GLOBALS{'corsite_plgparishengaged'} == "") { $GLOBALS{'corsite_plgparishengaged'} = "N"; }
	BCOLINSELECTHASHIDCLASS (List2Hash('Y,N,NA'),'corsite_plgparishengaged','rag','corsite_plgparishengaged',$GLOBALS{'corsite_plgparishengaged'},"1");
	B_ROW();
	BROW();
	BCOLTXT("Notes","1");
	BCOLINTEXTAREAID('corsite_plgplgnotes','corsite_plgplgnotes',$GLOBALS{'corsite_plgplgnotes'},"2","8");
	BCOLTXTCOLOR("<b>Planning Pack to PC</b><br>&nbsp;","2","gray","white");
	// BCOLINTXTID('corsite_plgparishpack','corsite_plgparishpack',$GLOBALS{'corsite_plgparishpack'},"1");
	if ($GLOBALS{'corsite_plgparishpack'} == "") { $GLOBALS{'corsite_plgparishpack'} = "N"; }
	BCOLINSELECTHASHIDCLASS (List2Hash('Y,N,NA'),'corsite_plgparishpack','rag','corsite_plgparishpack',$GLOBALS{'corsite_plgparishpack'},"1");
	B_ROW();
	XBR();
	XH3("Local Authority");	
	XHRCLASS('underline');	
	XBR();
	BROWTOP();
	BCOLTXT("Council","1");
	BCOLINTEXTAREAID('corsite_plgcouncil','corsite_plgcouncil',$GLOBALS{'corsite_plgcouncil'},"3","5");
	BCOLTXT("Members","1");
	BCOLINTEXTAREAID('corsite_plgcouncilmbrs','corsite_plgcouncilmbrs',$GLOBALS{'corsite_plgcouncilmbrs'},"3","5");
	B_ROW();
	XBR();
	BROWTOP();
	BCOLTXT("Meetings","1");
	BCOLINTEXTAREAID('corsite_plgcouncilmtgdates','corsite_plgcouncilmtgdates',$GLOBALS{'corsite_plgcouncilmtgdates'},"3","5");
	BCOLTXT("Latest Comments:","1");
	BCOLINTEXTAREAID('corsite_plgcouncilcomments','corsite_plgcouncilcomments',$GLOBALS{'corsite_plgcouncilcomments'},"3","5");
	B_ROW();
	XBR();
		
	XH3("Tenant Contact Information");
	XHRCLASS('underline');	
	XBR();
	BROW();		
	BCOLTXT("Name","1");
	BCOLINTXTID('corsite_plgtenantname','corsite_plgtenantname',$GLOBALS{'corsite_plgtenantname'},"2");
	BCOLTXT("Contact","1");
	BCOLINTXTID('corsite_plgtenantcontact','corsite_plgtenantcontact',$GLOBALS{'corsite_plgtenantcontact'},"4");	
	BCOLTXT("","1");
	BCOLTXTCOLOR("<b>Tenant Agreement in Principle</b><br>&nbsp;","2","gray","white");
	if ($GLOBALS{'corsite_plgtenantagreement'} == "") { $GLOBALS{'corsite_plgtenantagreement'} = "N"; }
	BCOLINSELECTHASHIDCLASS (List2Hash('Y,N,NA'),'corsite_plgtenantagreement','rag','corsite_plgtenantagreement',$GLOBALS{'corsite_plgtenantagreement'},"1");
	
	
	B_ROW();

	BROWTOP();
	BCOLTXT("Notes:","1");
	BCOLINTEXTAREAID('corsite_plgtenantcomments','corsite_plgtenantcomments',$GLOBALS{'corsite_plgtenantcomments'},"2","7");	
	BCOLTXT("","1");
	BCOLTXTCOLOR("<b>Tenant Support Letter Signed:</b><br>&nbsp;","2","gray","white");
	if ($GLOBALS{'corsite_plgtenantsupportlettersigned'} == "") { $GLOBALS{'corsite_plgtenantsupportlettersigned'} = "N"; }
	BCOLINSELECTHASHIDCLASS (List2Hash('Y,N,NA'),'corsite_plgtenantsupportlettersigned','rag','corsite_plgtenantsupportlettersigned',$GLOBALS{'corsite_plgtenantsupportlettersigned'},"1");

	B_ROW();

	BROW();
	BCOLTXT("","9");	
	BCOLTXTCOLOR("<b>Surrender Agreement Issued</b><br>&nbsp;","2","gray","white");
	if ($GLOBALS{'corsite_plgtenantsurrenderissued'} == "") { $GLOBALS{'corsite_plgtenantsurrenderissued'} = "N"; }
	BCOLINSELECTHASHIDCLASS (List2Hash('Y,N,NA'),'corsite_plgtenantsurrenderissued','rag','corsite_plgtenantsurrenderissued',$GLOBALS{'corsite_plgtenantsurrenderissued'},"1");
	B_ROW();

	
	BROW();
	BCOLTXT("","9");
	BCOLTXTCOLOR("<b>Surrender Agreement Received</b></br>&nbsp;","2","gray","white");
	if ($GLOBALS{'corsite_plgtenantsurrenderreceived'} == "") { $GLOBALS{'corsite_plgtenantsurrenderreceived'} = "N"; }
	BCOLINSELECTHASHIDCLASS (List2Hash('Y,N,NA'),'corsite_plgtenantsurrenderreceived','rag','corsite_plgtenantsurrenderreceived',$GLOBALS{'corsite_plgtenantsurrenderreceived'},"1");
	B_ROW();
	XBR();
	
	
	XH3("Business Development Information");
	XHRCLASS('underline');
	XBR();
	BROWTOP();
	BCOLTXT("Name","1");
	BCOLINTXTID('corsite_plgbusdevtname','corsite_plgbusdevtname',$GLOBALS{'corsite_plgbusdevtname'},"1");
	BCOLTXT("Contact","1");
	BCOLINTXTID('corsite_plgbusdevtcontact','corsite_plgbusdevtcontact',$GLOBALS{'corsite_plgbusdevtcontact'},"3");	
	BCOLTXT("Latest Comments:","1");
	BCOLINTEXTAREAID('corsite_plgbusdevtcomments','corsite_plgbusdevtcomments',$GLOBALS{'corsite_plgbusdevtcomments'},"3","5");
	B_ROW();
	XBR();	
	
}


function PLNSContentOutput() {
	
	XBR();
	XH3("Plans");
	BROW();
	BCOL("6");
	
	if ( $GLOBALS{'corsite_proposalimage6title'} == "" ) { $GLOBALS{'corsite_proposalimage6title'} = "Flood Zone"; }
	BROW(); BCOLINTXTID('corsite_proposalimage6title','corsite_proposalimage6title',$GLOBALS{'corsite_proposalimage6title'},"4"); B_ROW();
	XBR();	
	XINHID("corsite_proposalimage6",$GLOBALS{'corsite_proposalimage6'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "corsite_proposalimage6";
	$imageviewwidth = "90%";
	$imagename = $GLOBALS{'corsite_proposalimage6'};
	$imageuploadto = "Property";
	$imageuploadid = $GLOBALS{'corsite_id'};
	$imageuploadwidth = "500";
	$imageuploadheight = "450";
	$imageuploadfixedsize = "500x450";
	$imagethumbwidth = "400";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
	   	$imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
	B_COL();
	BCOL("6");
	if ( $GLOBALS{'corsite_proposalimage7title'} == "" ) { $GLOBALS{'corsite_proposalimage7title'} = "Surface Water Flood Risk"; }
	BROW(); BCOLINTXTID('corsite_proposalimage7title','corsite_proposalimage7title',$GLOBALS{'corsite_proposalimage7title'},"4"); B_ROW();
	XBR();
	XINHID("corsite_proposalimage7",$GLOBALS{'corsite_proposalimage7'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "corsite_proposalimage7";
	$imageviewwidth = "90%";
	$imagename = $GLOBALS{'corsite_proposalimage7'};
	$imageuploadto = "Property";
	$imageuploadid = $GLOBALS{'corsite_id'};
	$imageuploadwidth = "500";
	$imageuploadheight = "450";
	$imageuploadfixedsize = "500x450";
	$imagethumbwidth = "400";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
	   	$imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
	B_COL();
	B_ROW();
	XBR();	
	
	XHR();
	XH2("Plan 1");
	BROW(); BCOLINTXTID('corsite_assmtimage1title','corsite_assmtimage1title',$GLOBALS{'corsite_assmtimage1title'},"4"); BCOLTXT("Caption","2"); B_ROW();
	XBR();XBR();
	XINHID("corsite_assmtimage1",$GLOBALS{'corsite_assmtimage1'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "corsite_assmtimage1";
	$imageviewwidth = "90%";
	$imagename = $GLOBALS{'corsite_assmtimage1'};
	$imageuploadto = "Property";
	$imageuploadid = $GLOBALS{'corsite_id'};
	$imageuploadwidth = "800";
	$imageuploadheight = "600";
	$imageuploadfixedsize = "800x600";
	$imagethumbwidth = "400";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
	$imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);	

	XBR();XBR();
	XHR();
	XH2("Plan 2");	
	BROW(); BCOLINTXTID('corsite_assmtimage2title','corsite_assmtimage2title',$GLOBALS{'corsite_assmtimage2title'},"4"); BCOLTXT("Caption","2"); B_ROW();
	XBR();XBR();
	XINHID("corsite_assmtimage2",$GLOBALS{'corsite_assmtimage2'});
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "corsite_assmtimage2";
	$imageviewwidth = "90%";
	$imagename = $GLOBALS{'corsite_assmtimage2'};
	$imageuploadto = "Property";
	$imageuploadid = $GLOBALS{'corsite_id'};
	$imageuploadwidth = "800";	
	$imageuploadheight = "600";
	$imageuploadfixedsize = "800x600";
	$imagethumbwidth = "400";
	XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
	array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
	$imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);	
}


function FINContentOutput() {
		
	XBR();
	XH3("Finance and Operations");
	XHRCLASS('underline');	
	/*
	BROW();
	BCOLTXTCOLOR("Finance and Operations","12","#f2d30c","black");
	B_ROW();
	*/	
	XBR();
	BROW();
	BCOLTXT("Sage Department","2");
	BCOLINTXT('corsite_sagedepartment',$GLOBALS{'corsite_sagedepartment'},"4");	
	BCOLTXT("Quote Ready","1");
	BCOLINSELECTHASHIDCLASS (List2Hash('Y,N'),'corsite_quoteready','rag','corsite_quoteready',$GLOBALS{'corsite_quoteready'},"1");
	BCOLTXT("","4");
	B_ROW();
	XBR();	
	BROW();	
	BCOLTXT("Ops / Finance Update","2");
	BCOLINTEXTAREA('corsite_opsfinupdate',$GLOBALS{'corsite_opsfinupdate'},"3","10");	
	B_ROW();
	XBR();	

	if ( $GLOBALS{'corsite_plgsurveylist'} == "" ) {	
	    // ====  create default survey types if none exist ====================
		$corsurvey_ida = Get_Array('corsurvey');
		$highestcorsurvey_id = "SU00000";
		foreach ($corsurvey_ida as $corsurvey_id) {
			if ( $corsurvey_id > $highestcorsurvey_id ) {$highestcorsurvey_id = $corsurvey_id;}
		}
		$highestcorsurvey_seq = str_replace("SU", "", $highestcorsurvey_id);		

		$corsurveysep = "";
		$corsurveycategoryida = Get_Array('corsurveycategory');
		foreach ($corsurveycategoryida as $corsurveycategory_id) {
			Get_Data('corsurveycategory',$corsurveycategory_id);
			if ($GLOBALS{'corsurveycategory_showbydefault'} == "Yes" ) {				
				Initialise_Data('corsurvey');
				$highestcorsurvey_seq++;
				$corsurvey_id = "SU".substr(("00000".$highestcorsurvey_seq), -5);				
				$GLOBALS{'corsurvey_corsiteid'} = $GLOBALS{'corsite_id'};
				$GLOBALS{'corsurvey_corsiteversion'} = $GLOBALS{'corsite_version'};
				$GLOBALS{'corsurvey_corsurveycategoryid'} = $corsurveycategory_id;
				Write_Data('corsurvey',$corsurvey_id);
				$GLOBALS{'corsite_plgsurveylist'} = $GLOBALS{'corsite_plgsurveylist'}.$corsurveysep.$corsurvey_id;
				$corsurveysep = ",";				
				// XH4("survey - ".$corsurvey_id." ".$GLOBALS{'corsurvey_corsurveycategoryid'});
			}
		}		
		Write_Data('corsite', $GLOBALS{'corsite_id'} , $GLOBALS{'corsite_version'});
		// XH4("Site surveys updated to defaults");
		// XH4($GLOBALS{'corsite_plgsurveylist'});
	}

	XINHID("SurveysDisplayed","Yes");
	BROWEQH();
	// BCOLTXTCOLOR("<b>Cost Type</br>&nbsp;</b>","1","gray","white");
	BCOL("1"); BINBUTTONIDSPECIAL('corsurvey_add_new',"success","Survey +"); B_COL();		
	// BCOLTXTCOLOR("<b>Req'd</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Supplier</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Acc No</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Desc</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Ph 1</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Extras</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Success</b>","1","gray","white");		
	BCOLTXTCOLOR("<b>Tot Quote</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Booked Date</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Completed</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Exc Vat</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Var</b>","1","gray","white");	
	B_ROW();
	XBR();
	
	$suphash = Get_SelectArrays_Hash ("corsupplier","corsupplier_id","corsupplier_name","corsupplier_id","","" );
	$acchash = Get_SelectArrays_Hash ("coraccount","coraccount_id","coraccount_name","coraccount_id","","" );
	$thissurveyida = List2Array($GLOBALS{'corsite_plgsurveylist'});
	foreach ($thissurveyida as $corsurvey_id) {
		Check_Data('corsurvey',$corsurvey_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
			BROW();
			$abbrcorsurveycategorytext = '<img id="corsurvey_delete_'.$corsurvey_id.'" src="../site_assets/minidelete.png" class="surveydelete" />'.substr($GLOBALS{'corsurvey_corsurveycategoryid'},0,10);
			BCOLTXT ($abbrcorsurveycategorytext,"1");
			// BCOLTXTID('corsurvey_corsurveycategoryid_'.$corsurvey_id,$abbrcorsurveycategorytext,"1");
			XINHID('corsurvey_corsurveycategoryid_'.$corsurvey_id,$GLOBALS{'corsurvey_corsurveycategoryid'});
			BCOLINSELECTHASHID ($suphash,'corsurvey_supplier_'.$corsurvey_id,'corsurvey_supplier_'.$corsurvey_id,$GLOBALS{'corsurvey_supplier'},"1");
			BCOLINSELECTHASHID ($acchash,'corsurvey_account_'.$corsurvey_id,'corsurvey_account_'.$corsurvey_id,$GLOBALS{'corsurvey_account'},"1");						
			BCOLINTXTIDCLASS('corsurvey_description_'.$corsurvey_id,'textarea','corsurvey_description_'.$corsurvey_id,$GLOBALS{'corsurvey_description'},"1");			
			BCOL("1");
			BINTXTIDCLASS('corsurvey_ph1quote_'.$corsurvey_id,'calcin quoteval','corsurvey_ph1quote_'.$corsurvey_id,D80ToN80($GLOBALS{'corsurvey_ph1quote'}));
			BINBUTTONIDCLASSSPECIALICONONLY('corsurvey_ph1quoteinvrecddate_marker_'.$corsurvey_id,"quotedatemarker","secondary","file-text-o");			
			XINHID('corsurvey_ph1quoteinvrecddate_'.$corsurvey_id,$GLOBALS{'corsurvey_ph1quoteinvrecddate'});
			B_COL();
			BCOL("1");
			BINTXTIDCLASS('corsurvey_adhocquote_'.$corsurvey_id,'calcin quoteval','corsurvey_adhocquote_'.$corsurvey_id,D80ToN80($GLOBALS{'corsurvey_adhocquote'}));
			BINBUTTONIDCLASSSPECIALICONONLY('corsurvey_adhocquoteinvrecddate_marker_'.$corsurvey_id,"quotedatemarker","secondary","file-text-o");
			XINHID('corsurvey_adhocquoteinvrecddate_'.$corsurvey_id,$GLOBALS{'corsurvey_adhocquoteinvrecddate'});
			B_COL();
			BCOL("1");
			BINTXTIDCLASS('corsurvey_successfee_'.$corsurvey_id,'calcin quoteval','corsurvey_successfee_'.$corsurvey_id,D80ToN80($GLOBALS{'corsurvey_successfee'}));
			BINBUTTONIDCLASSSPECIALICONONLY('corsurvey_successfeeinvrecddate_marker_'.$corsurvey_id,"quotedatemarker","secondary","file-text-o");
			XINHID('corsurvey_successfeeinvrecddate_'.$corsurvey_id,$GLOBALS{'corsurvey_successfeeinvrecddate'});
			B_COL();
			BCOLINTXTIDCLASS('corsurvey_totalquotecalc_'.$corsurvey_id,'calcres','corsurvey_totalquotecalc_'.$corsurvey_id,D80ToN80($GLOBALS{'corsurvey_totalquotecalc'}),"1");		
			BCOLINDATEID('corsurvey_bookeddate_'.$corsurvey_id,'corsurvey_bookeddate_'.$corsurvey_id,$GLOBALS{'corsurvey_bookeddate'},"dd/mm/yyyy","1");
			BCOLINTXTIDCLASS('corsurvey_completed_'.$corsurvey_id,'rag','corsurvey_completed_'.$corsurvey_id,$GLOBALS{'corsurvey_completed'},"1");			
			BCOLTXTID('corsurvey_costexvatsagecalc_'.$corsurvey_id,$GLOBALS{'corsurvey_costexvatsagecalc'},"1");
			BCOLINTXTIDCLASS('corsurvey_costvsquotevarcalc_'.$corsurvey_id,'','corsurvey_costvsquotevarcalc_'.$corsurvey_id,D80ToN80($GLOBALS{'corsurvey_costvsquotevarcalc'}),"1");
			B_ROW();
		}
	}
	XDIV("surveylistend","");
	X_DIV("surveylistend");		
	XBR();
	BROWEQH();			
	BCOLTXTCOLOR("&nbsp;","4","#f2d30c","black");	
	BCOLINTXTIDCLASS("corsite_plgsurveytotalph1quotecalc",'calcres',"corsite_plgsurveytotalph1quotecalc",D80ToN80($GLOBALS{'corsite_plgsurveytotalph1quotecalc'}),"1");
	BCOLINTXTIDCLASS("corsite_plgsurveytotaladhocquotecalc",'calcres',"corsite_plgsurveytotaladhocquotecalc",D80ToN80($GLOBALS{'corsite_plgsurveytotaladhocquotecalc'}),"1");
	BCOLINTXTIDCLASS("corsite_plgsurveytotalsuccessfeecalc",'calcres',"corsite_plgsurveytotalsuccessfeecalc",D80ToN80($GLOBALS{'corsite_plgsurveytotalsuccessfeecalc'}),"1");	
	BCOLINTXTIDCLASS("corsite_plgsurveytotalquotecalc",'calcres',"corsite_plgsurveytotalquotecalc",D80ToN80($GLOBALS{'corsite_plgsurveytotalquotecalc'}),"1");		
	BCOLTXTCOLOR("&nbsp;","2","#f2d30c","black");	
	BCOLINTXTIDCLASS("corsite_plgsurveytotalcostexvatsagecalc","calcres","corsite_plgsurveytotalcostexvatsagecalc",D80ToN80($GLOBALS{'corsite_plgsurveytotalcostexvatsagecalc'}),"1");	
	BCOLINTXTIDCLASS("corsite_plgsurveytotalcostvsquotevarcalc","calcres","corsite_plgsurveytotalcostvsquotevarcalc",D80ToN80($GLOBALS{'corsite_plgsurveytotalcostvsquotevarcalc'}),"1");	
	B_ROW();

	/*
	XBR();	
	XBR();	
	BROW();
	BCOLTXTCOLOR("<b>Cost Type</br>&nbsp;</b>","2","gray","white");
	BCOLTXTCOLOR("<b>Req'd</b>","1","gray","white");
	BCOLTXTCOLOR("<b>C'terparty</b>","1","gray","white");
	BCOLTXTCOLOR("<b></b>","1","gray","white");	
	BCOLTXTCOLOR("<b>Desc</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Quote</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Booked Date</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Inv Issued</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Inv ExVAT</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Var</b>","1","gray","white");
	BCOLTXT("","1");
	B_ROW();
	XBR();
	BROW();
	BCOLTXT("&nbsp;","3");
	BCOLINTXTID("id1","f1","0","1");
	BCOLINTXTID("id1","f1","0","1");
	BCOLINTXTID("id1","f1","0","1");
	BCOLINTXTID("id1","f1","0","1");
	BCOLINTXTID("id1","f1","0","1");
	BCOLINTXTID("id1","f1","0","1");
	BCOLINTXTID("id1","f1","0","1");
	BCOLINTXTID("id1","f1","0","1");
	BCOLTXT("","1");
	B_ROW();	
	BROW();
	BCOLTXTCOLOR("&nbsp;","6","#f2d30c","black");
	BCOLTXTCOLOR("0000","1","#f2d30c","black");
	BCOLTXTCOLOR("&nbsp;","2","#f2d30c","black");
	BCOLTXTCOLOR("0000","1","#f2d30c","black");
	BCOLTXTCOLOR("0000","1","#f2d30c","black");
	BCOLTXT("","1");
	B_ROW();
	XBR();	
	BROW();
	BCOLTXTCOLOR("&nbsp;","3","#f2d30c","black");
	BCOLTXTCOLOR("0000","1","#f2d30c","black");	
	BCOLTXTCOLOR("&nbsp;","2","#f2d30c","black");	
	BCOLTXTCOLOR("0000","1","#f2d30c","black");
	BCOLTXTCOLOR("&nbsp;","2","#f2d30c","black");
	BCOLTXTCOLOR("0000","1","#f2d30c","black");
	BCOLTXTCOLOR("0000","1","#f2d30c","black");
	BCOLTXT("","1");
	B_ROW();	
	*/
	
}

function SALEContentOutput() {
    XBR();
    XH3("Sale");
    XHRCLASS('underline');
    BROW();
    BCOLTXT("Sale Update","2");
    BCOLINTEXTAREA('corsite_dispsummary',$GLOBALS{'corsite_dispsummary'},"3","10");
    B_ROW();
    BROW();
    BCOLTXT("Commercial Interest Summary","2");
    BCOLINTXTID("corsite_dispresioverview","corsite_dispresioverview",$GLOBALS{'corsite_dispresioverview'},"10");
    B_ROW();
    XBR();
    XHR();
    BROW();
    BCOLTXT("Sale Status","1");
    // BCOLINSELECTHASHID (List2Hash(',On Market,Legals,Exchanged,Completed'),'corsite_salestatus','corsite_salestatus',$GLOBALS{'corsite_salestatus'},"2");
    BCOLTXTID('salestatuscopy',$GLOBALS{'corsite_salestatus'},"2");
    // BCOLINTXTIDCLASS('salestatuscopy','calcres','salestatuscopy',$GLOBALS{'corsite_salestatus'},"2");
    BCOLTXT("Agent","1");
    BCOLINTXTID("corsite_saleagent","corsite_saleagent",$GLOBALS{'corsite_saleagent'},"2");
    BCOLTXT("Sale Counterparty","1");
    BCOLINTXTID("corsite_salecounterparty","corsite_salecounterparty",$GLOBALS{'corsite_salecounterparty'},"2");
    BCOLTXT("","3");
    B_ROW();
    BROW();
    BCOLTXT("Solicitors Instructed","1");
    BCOLINSELECTHASHID (List2Hash('Y,N'),'corsite_salebuyersolinstructed','corsite_salebuyersolinstructed',$GLOBALS{'corsite_salebuyersolinstructed'},"2");
    BCOLTXT("Buyer Solicitor","1");
    BCOLINTXTID("corsite_salebuyersolicitor","corsite_salebuyersolicitor",$GLOBALS{'corsite_salebuyersolicitor'},"2");
    BCOLTXT("Vendor Solicitor","1");
    BCOLINTXTID("corsite_salevendorsolicitor","corsite_salevendorsolicitor",$GLOBALS{'corsite_salevendorsolicitor'},"2");
    BCOLTXT("","3");
    B_ROW();
    BROW();
    BCOLTXT("Target Exchange Date","1");
    BCOLINDATEID("corsite_saletargetexchangedate","corsite_saletargetexchangedate",$GLOBALS{'corsite_saletargetexchangedate'},"dd/mm/yyyy","2");
    BCOLTXT("Actual Exchange Date","1");
    BCOLINDATEID("corsite_saleexchangedate","corsite_saleexchangedate",$GLOBALS{'corsite_saleexchangedate'},"dd/mm/yyyy","2");
    BCOLTXT("Target Completion Date","1");
    BCOLINDATEID("corsite_saletargetcompletiondate","corsite_saletargetcompletiondate",$GLOBALS{'corsite_saletargetcompletiondate'},"dd/mm/yyyy","2");
    BCOLTXT("Actual Completion Date","1");
    BCOLINDATEID("corsite_salecompletiondate","corsite_salecompletiondate",$GLOBALS{'corsite_salecompletiondate'},"dd/mm/yyyy","2"); 
    B_ROW();   
    XHR();
    BROW();
    BCOLTXT("Approved Sale Value","1");
    BCOLINTXTIDCLASS('corsite_buildtotalgpcalccopy','calcres','corsite_buildtotalgpcalccopy',D80ToN80($GLOBALS{'corsite_buildtotalgpcalc'}),"2");
    BCOLTXT("Actual Sale Value","1");
    BCOLINTXTIDCLASS('corsite_salelandvalueactual','calcin','corsite_salelandvalueactual',$GLOBALS{'corsite_salelandvalueactual'},"2");
    BCOLTXT("","6");
    B_ROW(); 
}

function NOTContentOutput() {
	XBR();
	XH3("Notes");
	XHRCLASS('underline');
	XBR();
	BROW();
	BCOLINTEXTAREAID ('corsite_notes','corsite_notes',$GLOBALS{'corsite_notes'},"20","8");
	B_ROW();
	XBR();XBR();
}

function COMContentOutput() {
	XBR();
	XH3("Communications Log");
	XHRCLASS('underline');
	XBR();
	
	XINHID("SiteCommsDisplayed","Yes");
	BROWEQH();
	BCOLTXTCOLOR("<b>Date</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Time</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Cordage Ref</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Contact Ref</b>","2","gray","white");	
	BCOLTXTCOLOR("<b>Method</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Discussion Notes</b>","5","gray","white");
	BCOL("1");	BINBUTTONIDSPECIAL('corsitecomms_add_new',"success","+"); B_COL();
	B_ROW();
	$corsitecommsa = Get_Array('corsitecomms',$GLOBALS{'corsite_id'});
	foreach ($corsitecommsa as $corsitecomms_timestamp) {
		Check_Data('corsitecomms',$GLOBALS{'corsite_id'},$corsitecomms_timestamp);			
		if ($GLOBALS{'IOWARNING'} == "0") {
			BROW();			
			BCOLINDATEID('corsitecomms_date_'.$corsitecomms_timestamp,'corsitecomms_date_'.$corsitecomms_timestamp,$GLOBALS{'corsitecomms_date'},"dd/mm/yyyy","1");					
			BCOLINTXTID('corsitecomms_time_'.$corsitecomms_timestamp,'corsitecomms_time_'.$corsitecomms_timestamp,$GLOBALS{'corsitecomms_time'},"1");
			BCOLINTXTID('corsitecomms_corperson_'.$corsitecomms_timestamp,'corsitecomms_corperson_'.$corsitecomms_timestamp,$GLOBALS{'corsitecomms_corperson'},"1");
			BCOLINTXTID('corsitecomms_person_'.$corsitecomms_timestamp,'corsitecomms_person_'.$corsitecomms_timestamp,$GLOBALS{'corsitecomms_person'},"2");			
			$hash = List2Hash("Phone,Email,Text,Visit,Other");
			BCOLINSELECTHASHID ($hash,'corsitecomms_type_'.$corsitecomms_timestamp,'corsitecomms_type_'.$corsitecomms_timestamp,$GLOBALS{'corsitecomms_type'},"1");			
			BCOLINTEXTAREAID ('corsitecomms_message_'.$corsitecomms_timestamp,'corsitecomms_message_'.$corsitecomms_timestamp,$GLOBALS{'corsitecomms_message'},"3","5");		
			BCOL("1"); BINBUTTONIDCLASSSPECIAL('corsitecomms_delete_'.$corsitecomms_timestamp,"corsitecommsdelete","danger","x"); B_COL();
			B_ROW();
		}
	}
	XDIV("corsitecommslistend","");
	X_DIV("corsitecommslistend");
	BROW();		
	XBR();XBR();
}

function NotesPopup() {
	XDIVPOPUP("notespopup","Notes Log");
	BROW();
	BCOLINTEXTAREAID("notescontent","notescontent","","20","11");
	B_ROW();
	XBR();XBR();
	XINBUTTONID("notessave","Save note");
	XINBUTTONIDSPECIAL("notesnosave","warning","Close without saving note");	
	X_DIV("notespopup");
}

function TextareaPopup() {
	XDIVPOPUP("textareapopup","Input");
	BROW();
	BCOLINTEXTAREAID("textareacontent","textareacontent","","10","12");
	B_ROW();
	XBR();XBR();
	XINBUTTONID("textareasave","Save");
	XINBUTTONIDSPECIAL("textareanosave","warning","Don't Save");
	X_DIV("textareapopup");
}

function DateMarkerPopup() {
    XDIVPOPUP("quotedatemarkerpopup","Date");
    BROW();
    BCOLINDATEID("quotedatemarkercontent","quotedatemarkercontent","","dd/mm/yyyy","6");
    B_ROW();
    XBR();XBR();
    XDIVRIGHT("quotedatemarkerpopupbuttons","");
    XINBUTTONID("quotedatemarkersave","Save");XBR();XBR();
    XINBUTTONIDSPECIAL("quotedatemarkernosave","warning","Don't Save");
    X_DIV("quotedatemarkerpopupbuttons");
    X_DIV("quotedatemarkerpopup");
}

function NewSurveyPopup() {
	XDIVPOPUP("newsurveypopup","Survey");
	$corsurveycategory_ida = Get_Array('corsurveycategory');// BINRADIOID ("newcorsurveycategory_id", "newcorsurveycategory_id", $corsurveycategory_id, "", $corsurveycategory_id);
	$xhash = Get_SelectArrays_Hash ("corsurveycategory","corsurveycategory_id","corsurveycategory_description","","","" );
	XINCHECKBOXHASH($xhash,"newcorsurveycategorylist","");
	XBR();
	XINBUTTONID("newsurveyselect","Select");
	XINBUTTONIDSPECIAL("newsurveynoselect","warning","Cancel");
	X_DIV("newsurveypopup");
}

function Cor_CORSITEDELETECONFIRM_Output ($corsite_id,$corsite_version,$list) {
	Get_Data("corsite",$corsite_id,$corsite_version);
	XH3("Delete Site - ".$corsite_id."/".$corsite_version." - ".$GLOBALS{'corsite_site'});
	// $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
	XPTXT("Are you sure you want to delete this site");
	XBR();
	XFORM("corsitedeleteaction.php","deletesite");
	XINSTDHID();
	XINHID("corsite_id",$corsite_id);
	XINHID("corsite_version",$corsite_version);	
	XINHID("List",$list);	
	XINSUBMIT("Confirm Site Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}

function Cor_CORSITEDATABASE_Output($corsite_id,$corsite_version) {

	Get_Data('corsite',$corsite_id,$corsite_version);

	XH2($GLOBALS{'corsite_site'});
	XHR();
	XH2("Database");	
	$tstring = $GLOBALS{"corsite^FIELDS"};
	$tfields = explode('|', $tstring);
	foreach ($tfields as $tfieldelement) {
		BROW();
		BCOLTXT($tfieldelement,"2");
		BCOLINTXT($tfieldelement,$GLOBALS{$tfieldelement},"5");
		BCOLTXT("","5");
		B_ROW();	
	}	
	XHR();
	XH2("Commercial");
	$commida = List2Array($GLOBALS{'corsite_dispcorcommidlist'});
	foreach ($commida as $corcomm_id) {
		Get_Data('corcomm',$corcomm_id);
		XH3($GLOBALS{"corcomm_tenantname"});
		$tstring = $GLOBALS{"corcomm^FIELDS"};
		$tfields = explode('|', $tstring);
		foreach ($tfields as $tfieldelement) {
			BROW();
			BCOLTXT($tfieldelement,"2");
			BCOLINTXT($tfieldelement,$GLOBALS{$tfieldelement},"5");
			BCOLTXT("","5");
			B_ROW();
		}
	}	
	XHR();
	XH2("Residences");
	$resiida = List2Array($GLOBALS{'corsite_dispcorresiidlist'});
	foreach ($resiida as $corresi_id) {
		Get_Data('corresi',$corresi_id);
		XH3($GLOBALS{"corresi_class"});
		$tstring = $GLOBALS{"corresi^FIELDS"};
		$tfields = explode('|', $tstring);
		foreach ($tfields as $tfieldelement) {
			BROW();
			BCOLTXT($tfieldelement,"2");
			BCOLINTXT($tfieldelement,$GLOBALS{$tfieldelement},"5");
			BCOLTXT("","5");
			B_ROW();
		}
	}
	XHR();	
	XH2("Surveys");
	$surveyida = List2Array($GLOBALS{'corsite_plgsurveylist'});
	foreach ($surveyida as $corsurvey_id) {
		Get_Data('corsurvey',$corsurvey_id);
		XH3($GLOBALS{"corsurvey_corsurveycategoryid"});
		$tstring = $GLOBALS{"corsurvey^FIELDS"};
		$tfields = explode('|', $tstring);
		foreach ($tfields as $tfieldelement) {
			BROW();
			BCOLTXT($tfieldelement,"2");
			BCOLINTXT($tfieldelement,$GLOBALS{$tfieldelement},"5");
			BCOLTXT("","5");
			B_ROW();
		}
	}
	XHR();
	XH2("Plans");
	$siteplanida = List2Array($GLOBALS{'corsite_assmtplanlist'});
	foreach ($siteplanida as $corsiteplan_id) {
		Get_Data('corsiteplan',$corsiteplan_id);
		XH3($GLOBALS{"corsiteplan_description"});
		$tstring = $GLOBALS{"corsiteplan^FIELDS"};
		$tfields = explode('|', $tstring);
		foreach ($tfields as $tfieldelement) {
			BROW();
			BCOLTXT($tfieldelement,"2");
			BCOLINTXT($tfieldelement,$GLOBALS{$tfieldelement},"5");
			BCOLTXT("","5");
			B_ROW();
		}
	}		
}

function Cor_CORSAGELIST_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Cor_CORSAGELIST_Output() {
	$parm0 = "";
	$parm0 = $parm0."SAGE List|"; # pagetitle
	$parm0 = $parm0."corsage|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."corsage_id|"; # keyfieldname
	$parm0 = $parm0."corsage_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."corsage_id|Yes|Sage Id|90|Yes|Sage Id|KeyText,12,15^";
	$parm1 = $parm1."corsage_lookup|Yes|Lookup|100|Yes|Lookup|InputText,20,40^";
	/*
	$parm1 = $parm1."corsage_datetext|Yes|DateText|100|Yes|DateText|InputText,20,40^";
	$parm1 = $parm1."corsage_uidcat1|No|UIDCat1|100|Yes|UIDCat1|InputText,20,40^";
	$parm1 = $parm1."corsage_uidcat2|No|UIDCat2|100|Yes|UIDCat2|InputText,20,40^";
	$parm1 = $parm1."corsage_gl|No|GL1|100|Yes|GL1|InputText,20,40^";
	$parm1 = $parm1."corsage_gl2|No|GL2|100|Yes|GL2|InputText,20,40^";
	$parm1 = $parm1."corsage_nc|No|NC|100|Yes|NC|InputText,20,40^";
	$parm1 = $parm1."corsage_type|No|Type|100|Yes|Type|InputText,20,40^";
	$parm1 = $parm1."corsage_dept|No|Dept|100|Yes|Dept|InputText,20,40^";
	$parm1 = $parm1."corsage_department|Yes|Department|100|Yes|Department|InputText,20,40^";	
	$parm1 = $parm1."cordage_proj|Yes|Proj|100|Yes|Proj|InputText,20,40^";
	$parm1 = $parm1."cordage_division|No|Division|100|Yes|Division|InputText,20,40^";
	$parm1 = $parm1."cordage_cat1|No|Cat1|100|Yes|Cat1|InputText,20,40^";
	$parm1 = $parm1."cordage_cat2|No|Cat2|100|Yes|Cat2|InputText,20,40^";
	$parm1 = $parm1."cordage_cat3|No|Cat3|100|Yes|Cat3|InputText,20,40^";
	$parm1 = $parm1."cordage_desc|Yes|Desc|100|Yes|Desc|InputText,20,40^";	
	$parm1 = $parm1."cordage_transactionno|No|TxnNo|100|Yes|TxnNo|InputText,20,40^";
	$parm1 = $parm1."cordage_account|No|Account|100|Yes|Name|InputText,20,40^";
	$parm1 = $parm1."cordage_ref|No|Ref|100|Yes|Ref|InputText,20,40^";
	$parm1 = $parm1."cordage_fy|No|FY|100|Yes|FY|InputText,20,40^";
	$parm1 = $parm1."cordage_qtr|No|Qtr|100|Yes|Qtr|InputText,20,40^";
	$parm1 = $parm1."cordage_date|No|Date|100|Yes|Date|InputText,20,40^";
	$parm1 = $parm1."cordage_tax|No|Tax|100|Yes|Tax|InputText,20,40^";
	*/
 	$parm1 = $parm1."cordage_valueacc|Yes|Value Acc|100|Yes|Value Acc|InputText,20,40^";
 	$parm1 = $parm1."cordage_valuemgmtacc|Yes|Value MgmtAcc|100|Yes|Value MgmtAcc|InputText,20,40^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Cor_CORORIG2COPY_Output() {	
	$corsite_ida = Get_Array('corsite','Live');
	foreach ($corsite_ida as $corsite_id) {
		Get_Data('corsite','Live',$corsite_id);	
		$tstring = $GLOBALS{"corsite^FIELDS"};
		$tfields = explode('|', $tstring);
		foreach ($tfields as $tfieldelement) {
			$nfieldelement = str_replace("corsite_", "corsitecopy_", $tfieldelement);
			$GLOBALS{$nfieldelement} = $GLOBALS{$tfieldelement};			
		}		
		Write_Data('corsitecopy','Live',$corsite_id);	
	}
}	
	
function Cor_CORCOPY2NEW_Output() {
	$corsitecopy_ida = Get_Array('corsitecopy','Live');
	foreach ($corsitecopy_ida as $corsitecopy_id) {
		Get_Data('corsitecopy','Live',$corsitecopy_id);
		$tstring = $GLOBALS{"corsitecopy^FIELDS"};
		$tfields = explode('|', $tstring);
		foreach ($tfields as $tfieldelement) {
			$nfieldelement = str_replace("corsitecopy_", "corsite_", $tfieldelement);
			$GLOBALS{$nfieldelement} = $GLOBALS{$tfieldelement};

		}
		XPTXT($corsitecopy_id);
		Write_Data('corsite',$corsitecopy_id,'Live');		
	}
}

function Cor_CORCOMMCREATE_Output() {
	XPTXT('Create New Commercial Table');
	XBR();XBR();
	XFORMUPLOAD("corcommcreate.php","corcommcreate");
	XINSTDHID();
	XINSUBMIT("Create Table");
	X_FORM();
}

function Cor_CORSITEVERSIONINGOUT_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function Cor_CORSITEVERSIONINGOUT_Output($corsite_id,$thiscorsite_version) {
    Get_Data('corsite',$corsite_id,$thiscorsite_version);
	XH2("Site Versions - ".$GLOBALS{'corsite_site'});
	XBR();XBR();

	$GLOBALS{'corlevel'} = 0;
	if ( $GLOBALS{'service_cor'} != "" ) {
		Check_Data('coruser');
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_readonlyuserlist'})) {$GLOBALS{'corlevel'} = 1;}	
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_otheruserlist'})) { $GLOBALS{'corlevel'} = 2; }
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_primeuserlist'})) { $GLOBALS{'corlevel'} = 3; }
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_superuserlist'})) { $GLOBALS{'corlevel'} = 4; }
		if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $GLOBALS{'corlevel'} = 4; }
	}
	
	XH3("Existing Versions for this site");
	
	XDIV("reportdiv","container");
	XTABLEJQDTID("reporttable_list");
	XTHEAD();
	XTRJQDT();

	XTDHTXT("Site Id");
	XTDHTXT("Site");
	XTDHTXT("Version");
	XTDHTXT("Person");
	XTDHTXT("Strapline");	
	XTDHTXT("Status");
	XTDHTXT("Batch");
	XTDHTXT("");
	XTDHTXT("");
	XTDHTXT("");
	XTDHTXT("");
	XTDHTXT("Locked");
	XTDHTXT("");
	X_TR();
	X_THEAD();
	XTBODY();
	XINHID("list_sortcol","0");

	$corsiteversiona = Get_Array('corsite',$corsite_id);
	foreach ($corsiteversiona as $corsite_version) {
		Check_Data('corsite',$corsite_id,$corsite_version);
		XTRJQDT();		
		XTDTXT($corsite_id);
		XTDTXT($GLOBALS{'corsite_site'});
		if ($GLOBALS{'corsite_version'} == "Live") {XTDTXT($GLOBALS{'corsite_version'}); }
		else { XTDTXTCOLOR($GLOBALS{'corsite_version'},NameToSwatch($GLOBALS{'corsite_version'})); }
		XTDTXT($GLOBALS{'corsite_versionpersonid'});	
		XTDTXT($GLOBALS{'corsite_proposalaltusestrapline'});						
		XTDTXT($GLOBALS{'corsite_status'});
		XTDTXT($GLOBALS{'corsite_batch'});
		$thisprogramme = $GLOBALS{'corsite_corprogramme'};
		$link = YPGMLINK("corsiteupdateout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("corsite_id",$corsite_id).YPGMPARM("corsite_version",$corsite_version).YPGMPARM("corsite_corprogramme",$thisprogramme);
		XTDLINKTXT($link,"manage");

		$link = YPGMLINK("corsitenewversionout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("corsite_id",$corsite_id).YPGMPARM("corsite_version",$corsite_version);
		XTDLINKTXT($link,"new-version");
		
		if ( $corsite_version != "Live" ) {
			$link = YPGMLINK("corsitemakeversionliveout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("corsite_id",$corsite_id).YPGMPARM("corsite_version",$corsite_version);
			XTDLINKTXT($link,"make-live");		
		} else {
			XTDTXT("");
		}
		$link = YPGMLINK("corsitedeleteconfirm.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("corsite_id",$corsite_id).YPGMPARM("corsite_version",$corsite_version).YPGMPARM("List","CORSITEVERSIONINGOUT");
		XTDLINKTXT($link,"delete");
		if ($GLOBALS{'corsite_lockedpersonid'} != "") {
			XTDIMGFLEX("../site_assets/minilock.png");
			XTDTXT($GLOBALS{'corsite_lockedpersonid'}." ".TimestamptoDDMMMbHHcMM($GLOBALS{'corsite_lockedtimestamp'}));
		} else {
			XTDTXT("");
			XTDTXT("");
		}
		X_TR();
	}
	X_TBODY();
	X_TABLE();
	X_DIV("reportdiv");
	XCLEARFLOAT();
}

function Cor_CORSITENEWVERSION_CSSJS () {
	$GLOBALS{'SITEJSOPTIONAL'} = "corsitenewversion";
}

function Cor_CORSITENEWVERSION_Output($corsite_id,$thiscorsite_version) {

	$corsiteversiona = Get_Array('corsite',$corsite_id);
	
	
	Get_Data('corsite',$corsite_id,$thiscorsite_version);
	XH2("Create a New Site Version - ".$GLOBALS{'corsite_site'});
	XPTXT('This will be a replica of the "'.$thiscorsite_version.'" version.');
	XBR();XBR();
	XH3("Select a colour tag to identify the new version;");
	XBR();
	XFORMUPLOAD("corsitenewversionin.php","newversion");
	XINSTDHID();
	XINHID("corsite_id",$corsite_id);
	XINHID("oldcorsite_version",$thiscorsite_version);
	XINHID("newcorsite_version","");		
	BROW();	
	BCOLTXT("&nbsp;<br>&nbsp;<br>&nbsp;","1");
	if (in_array("Gold", $corsiteversiona)) { BCOLTXT("","1"); }	
	else { BCOLTXTIDCOLORCLASS ("Gold","swatch"," <br>Gold<br>","1",NameToSwatch("Gold"),"white"); }
	if (in_array("Silver", $corsiteversiona)) { BCOLTXT("","1"); }	
	else { BCOLTXTIDCOLORCLASS ("Silver","swatch"," <br>Silver<br>","1",NameToSwatch("Silver"),"white"); }
	if (in_array("Bronze", $corsiteversiona)) { BCOLTXT("","1"); }	
	else { BCOLTXTIDCOLORCLASS ("Bronze","swatch"," <br>Bronze<br>","1",NameToSwatch("Bronze"),"white"); }						
	B_ROW();
	XBR();	
	BROW();
	BCOLTXT("&nbsp;<br>&nbsp;<br>&nbsp;","1");
	if (in_array("Green", $corsiteversiona)) { BCOLTXT("","1"); }	
	else { BCOLTXTIDCOLORCLASS ("Green","swatch"," <br>Green<br>","1",NameToSwatch("Green"),"white"); }		
	if (in_array("Amber", $corsiteversiona)) { BCOLTXT("","1"); }	
	else { BCOLTXTIDCOLORCLASS ("Amber","swatch"," <br>Amber<br>","1",NameToSwatch("Amber"),"white"); }			
	if (in_array("Red", $corsiteversiona)) { BCOLTXT("","1"); }	
	else { BCOLTXTIDCOLORCLASS ("Red","swatch"," <br>Red<br>","1",NameToSwatch("Red"),"white"); }				
	B_ROW();
	XBR();
	BROW();
	BCOLTXT("&nbsp;<br>&nbsp;<br>&nbsp;","1");
	
	if (in_array("Navy", $corsiteversiona)) { BCOLTXT("","1"); }	
	else { BCOLTXTIDCOLORCLASS ("Navy","swatch"," <br>Navy<br>","1",NameToSwatch("Navy"),"white"); }		
	if (in_array("Magenta", $corsiteversiona)) { BCOLTXT("","1"); }	
	else { BCOLTXTIDCOLORCLASS ("Magenta","swatch"," <br>Magenta<br>","1",NameToSwatch("Magenta"),"white"); }			
	if (in_array("Indigo", $corsiteversiona)) { BCOLTXT("","1"); }	
	else { BCOLTXTIDCOLORCLASS ("Indigo","swatch"," <br>Indigo<br>","1",NameToSwatch("Indigo"),"white"); }		
	B_ROW();	
	XBR();XBR();	
	XINSUBMIT("Create New Version");
	X_FORM();		
}



function Cor_CORSITEMAKEVERSIONLIVE_Output($corsite_id,$thiscorsite_version) {

    Get_Data('corsite',$corsite_id,$thiscorsite_version);
	XH2('Make the "'.$thiscorsite_version.'" version Live - '.$GLOBALS{'corsite_site'});
	XBR();XBR();	
	XPTXT('This will replace the "Live" version with the "'.$thiscorsite_version.'" version and create a "Backup" of the replaced "Live" version.');
	XBR();XBR();
	XFORMUPLOAD("corsitemakeversionlivein.php","newversion");
	XINSTDHID();
	XINHID("corsite_id",$corsite_id);
	XINHID("corsite_version",$thiscorsite_version);
	XINCHECKBOXYESNO ("deletethisversion","No",'Delete the "'.$thiscorsite_version.'" version upon completion.');
	XBR();XBR();
	XINSUBMIT("Make the version Live");
	X_FORM();

}

function NameToSwatch($name) {
$namelist = 'Gold,Silver,Bronze,Green,Amber,Red,Navy,Magenta,Indigo';	
$colorlist = 'GoldenRod,Silver,DarkGoldenRod,Green,Orange,Red,Navy,Magenta,Indigo';		
$chash = Lists2Hash($namelist,$colorlist);	
return $chash{$name};		
}


function Cor_CORSITEUNLOCK_Output() {
    
    $corsite2keya = Get_2Key_Array('corsite');
    foreach ($corsite2keya as $corsite2key) {
        $corsitekeya = explode('|',$corsite2key);
        $corsite_id = $corsitekeya[0];
        $corsite_version = $corsitekeya[1];
        Check_Data('corsite',$corsite_id,$corsite_version);
        if ($GLOBALS{'IOWARNING'} == "0") {
            if ($GLOBALS{'corsite_lockedpersonid'} != "") {
                $lockedYYYYMMDDHHMMSS  = str_replace("T", "", $GLOBALS{'corsite_lockedtimestamp'});
                // XPTXT($GLOBALS{'currentYYYYMMDDHHMMSS'}." vs ".$lockedYYYYMMDDHHMMSS);
                if (($GLOBALS{'currentYYYYMMDDHHMMSS'} - $lockedYYYYMMDDHHMMSS) <= 20000) {
                    XPTXTCOLOR($corsite_id." ".$corsite_version." ".$GLOBALS{'corsite_site'}." Locked within last hour - NOT AUTOMATICALLY UNLOCKED","red");
                } else {
                    $GLOBALS{'corsite_lockedpersonid'} =  "";
                    $GLOBALS{'corsite_lockedtimestamp'} = "";
                    $GLOBALS{'corsite_lastupdatetimestamp'} = $GLOBALS{'currenttimestamp'};
                    $GLOBALS{'corsite_lastupdatepersonid'} = "";
                    $GLOBALS{'corsite_lastupdatetype'} = "Mass Unlock";
                    XPTXT($corsite_id." ".$corsite_version." ".$GLOBALS{'corsite_site'}." Unlocked");
                    Write_Data('corsite',$corsite_id,$corsite_version);
                }  
            }
        }
    }    
}




function Cor_CORSITECLASSIFY_Output($testorreal) {
    
    XH2("Site Classification - ".$testorreal);
    
    if ( $testorreal == "T" ) {
        XBR();
        $link = YPGMLINK("corsiteclassifyreal.php").YPGMSTDPARMS();
        XLINKBUTTON($link,"I'm OK with this Test. Now reclassify the sites for Real.");
        XBR();XBR();
        XLINKBACKBUTTON("Cancel.");
        XBR();
        XHR();
    }
    
    $reclasscount = 0;
    
    $corsite2keya = Get_2Key_Array('corsite');
    foreach ($corsite2keya as $corsite2key) {
        $corsitekeya = explode('|',$corsite2key);
        $corsite_id = $corsitekeya[0];
        $corsite_version = $corsitekeya[1];
        Check_Data('corsite',$corsite_id,$corsite_version);
        if ($GLOBALS{'IOWARNING'} == "0") {
            $classification = ClassifySite();
            if ($classification == $GLOBALS{'corsite_classification'}) {
                // XPTXT("Id= ".$corsite_id."(".$GLOBALS{'corsite_arkname'}.")| Version= ".$corsite_version." | Site= ".$GLOBALS{'corsite_site'}." | Status= ".$GLOBALS{'corsite_status'}." | ShelvedCode= ".$GLOBALS{'corsite_shelvedreasoncode'}." | PlgDecision= ".$GLOBALS{'corsite_plgdeterminationresult'});
                // XPTXTCOLOR("(Rules) ".$classification." == ".$GLOBALS{'corsite_classification'}." (Spreadsheet)","green");
            } else {
                XPTXT("Id= ".$corsite_id."(".$GLOBALS{'corsite_arkname'}.")| Version= ".$corsite_version." | Site= ".$GLOBALS{'corsite_site'}." | Status= ".$GLOBALS{'corsite_status'}." | ShelvedCode= ".$GLOBALS{'corsite_shelvedreasoncode'}." | PlgDecision= ".$GLOBALS{'corsite_plgdeterminationresult'}." | SaleStatus= ".$GLOBALS{'corsite_salestatus'});
                XPTXTCOLOR("(Rules) ".$classification." != ".$GLOBALS{'corsite_classification'}." (Current DB)","red");
                $GLOBALS{'corsite_classification'} = $classification;
                $reclasscount++;
                if ( $testorreal == "R" ) {                   
                    $GLOBALS{'corsite_lastupdatetimestamp'} = $GLOBALS{'currenttimestamp'};
                    $GLOBALS{'corsite_lastupdatepersonid'} = $GLOBALS{'LOGIN_person_id'};
                    $GLOBALS{'corsite_lastupdatetype'} = "Financial Re-Classification";
                    Write_Data('corsite',$corsite_id,$corsite_version); 
                    XPTXTCOLOR("Updated","green");
                }                
            }            
        }
    }
    if ( $reclasscount == 0 ) { XPTXT("No sites require re-classification");  }
}

function ClassifySite() {
    $classification = "";
    if (($GLOBALS{'corsite_status'} == "Shelved")&&($classification == "")) {
        if ($GLOBALS{'corsite_shelvedreasoncode'} == "Cancelled") {
            $classification = "Cancelled";
        }
    }
    if (($GLOBALS{'corsite_status'} == "Sold")&&($classification == "")) {
        $classification = "Completed";
    }
    if (($GLOBALS{'corsite_salestatus'} == "Exchanged")&&($classification == "")) {
        $classification = "Exchanged";
    }
    if (($GLOBALS{'corsite_status'} == "Neg-PrePlanning")&&($classification == "")) {
        $classification = "Neg PrePlanning";
    }
    if (($GLOBALS{'corsite_status'} == "Planning")&&($classification == "")) {
        if ($GLOBALS{'corsite_plgdeterminationresult'} != "Approved") {
            $classification = "Planning";
        }
    }
    if ((($GLOBALS{'corsite_status'} == "Planning")||($GLOBALS{'corsite_status'} == "Sale")||($GLOBALS{'corsite_status'} == "Legals"))&&($classification == "")) {
        if ($GLOBALS{'corsite_plgdeterminationresult'} == "Approved") {
            $classification = "Planning Obtained";
        }
    }
    if (($GLOBALS{'corsite_status'} == "Pending Review")&&($classification == "")) {
        $classification = "Pending Review";
    }
    if (($GLOBALS{'corsite_status'} == "Assessment")&&($classification == "")) {
        $classification = "Under Assessment";
    }
    if (($GLOBALS{'corsite_status'} == "Shelved")&&($classification == "")) {
        if ($GLOBALS{'corsite_shelvedreasoncode'} == "Long Term") {
            $classification = "Long Term";
        }
    }
    if (($GLOBALS{'corsite_status'} == "Shelved")&&($classification == "")) {
        if ($GLOBALS{'corsite_shelvedreasoncode'} == "No HAUV") {
            $classification = "No HAUV";
        }
    }
    if ($classification == "") {
        $classification = "TBC";
    }
    return $classification;
}

function Cor_CORSITERECALC_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function Cor_CORSITERECALC_Output($mode) {
    
    XH1("Site Recalculation - ".$mode);
    
    XH3("Caution: This page may take some time to load - please wait." );
    
    if ($mode == "Test") {
        XBR();
        $link = YPGMLINK("corsiterecalcreal.php").YPGMSTDPARMS();
        XLINKBUTTON($link,"I'm OK with this Test. Now process the Re-Calculation in Real mode.");
        XBR();
    }
    
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT('Seq');
    XTDHTXT('Id');
    XTDHTXT('Version');
    XTDHTXT('Site Name');
    XTDHTXT('Status');
    XTDHTXT('Type');
    XTDHTXT('Ph2 Status');
    XTDHTXT('New Rag');  
    XTDHTXT('Field');
    XTDHTXT('Old Value');
    XTDHTXT('New Value');
    XTDHTXT('');
    X_TR();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");
    
    $seq = 1;
    $corsite2keya = Get_2Key_Array('corsite');
    foreach ($corsite2keya as $corsite2key) {
        $corsitekeya = explode('|',$corsite2key);
        $corsite_id = $corsitekeya[0];
        $corsite_version = $corsitekeya[1];
        Check_Data('corsite',$corsite_id,$corsite_version);
        if ($GLOBALS{'IOWARNING'} == "0") {	
            $seq++;
            XTRJQDT();
            XTDTXT($seq);
            XTDTXT($corsite_id);
            XTDTXT($GLOBALS{'corsite_version'});
            XTDTXT($GLOBALS{'corsite_site'});
            XTDTXT($GLOBALS{'corsite_status'});
            XTDTXT($GLOBALS{'corsite_proposaltype'});
            XTDTXT($GLOBALS{'corsite_proposalphasestatus'});
            XTDTXT($GLOBALS{'corsite_proposalnewrag'});
            XTDTXT('=========');
            XTDTXT('=========');
            XTDTXT('=========');
            $link = YPGMLINK("corsiteupdateout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("corsite_id",$corsite_id).YPGMPARM("corsite_version",$corsite_version).YPGMPARM("corsite_corprogramme",$thisprogramme);
            XTDCLASSLINKTXTNEWWINDOW('updatelink',$link,"manage",$shortsite);
            X_TR();
            $tstring = $GLOBALS{'corsite'."^FIELDS"};
            $tfields = explode('|', $tstring);
            foreach ($tfields as $tfieldelement) {
                $GLOBALS{'OLD'.$tfieldelement} = $GLOBALS{$tfieldelement};
            }
            
			// ==== Specification Page===============					
	
			// ==== FA1 Commercial ===============	
			$GLOBALS{'corsite_dispcommtotalsqftcalc'} = 0;
			$GLOBALS{'corsite_dispcommtotalbuildcostcalc'} = 0;
			$GLOBALS{'corsite_dispcommgdvsubtotalcalc'} = 0;
        	$commida = List2Array($GLOBALS{'corsite_dispcorcommidlist'});
        	foreach ($commida as $corcomm_id) {
        		Get_Data('corcomm',$corcomm_id);				
				if (($GLOBALS{'corcomm_area'} != "")&&($GLOBALS{'corcomm_area'} != "0")) {
					$GLOBALS{'corcomm_rentpersqftcalc'} = $GLOBALS{'corcomm_rentperannum'} / $GLOBALS{'corcomm_area'};
				} else {
					$GLOBALS{'corcomm_rentpersqftcalc'} = 0;
				}
				$GLOBALS{'corsite_dispcommtotalsqftcalc'} = $GLOBALS{'corsite_dispcommtotalsqftcalc'} + $GLOBALS{'corcomm_area'};
				if (($GLOBALS{'corcomm_yieldpercent'} != "")&&($GLOBALS{'corcomm_yieldpercent'} != "0")) {
					$GLOBALS{'corcomm_tenantgdvcalc'} = ($GLOBALS{'corcomm_rentperannum'} / $GLOBALS{'corcomm_yieldpercent'}) *100;	
				} else {
					$GLOBALS{'corcomm_tenantgdvcalc'} = 0;
				}		
				$GLOBALS{'corcomm_purchaserscostgdvcalc'} = (-1) * $GLOBALS{'corcomm_tenantgdvcalc'} * $GLOBALS{'corcomm_purchaserscostpercent'} / 100;	;
				$GLOBALS{'corcomm_netcapitalvaluecalc'} = $GLOBALS{'corcomm_tenantgdvcalc'} - $GLOBALS{'corcomm_purchaserscostgdvcalc'};
				$GLOBALS{'corcomm_rentfreegdvcalc'} = (-1) * $GLOBALS{'corcomm_rentperannum'} * $GLOBALS{'corcomm_rentfreemths'} / 12;			
				$GLOBALS{'corsite_dispcommgdvsubtotalcalc'} = $GLOBALS{'corsite_dispcommgdvsubtotalcalc'} + $GLOBALS{'corcomm_tenantgdvcalc'} + $GLOBALS{'corcomm_purchaserscostgdvcalc'} +		
				$GLOBALS{'corcomm_rentfreegdvcalc'} + $GLOBALS{'corcomm_capcon'} +	$GLOBALS{'corcomm_surrendercost'};				
			}				
			
			// ==== FA1 Residential ===============
			$GLOBALS{'corsite_dispresitotalunitscalc'} = 0;
			$GLOBALS{'corsite_dispresitotalsqftcalc'} = 0;
			$GLOBALS{'corsite_dispresigdvsubtotalcalc'} = 0;
        	$resiida = List2Array($GLOBALS{'corsite_dispcorresiidlist'});
        	foreach ($resiida as $corresi_id) {	
        		Get_Data('corresi',$corresi_id);			
				$GLOBALS{'corresi_prediscountcalc'}= $GLOBALS{'corresi_quantity'} * $GLOBALS{'corresi_value'};
				$GLOBALS{'corresi_postdiscountcalc'}= $GLOBALS{'corresi_prediscountcalc'}* (100 - $GLOBALS{'corresi_discountpercent'})/100;
				$GLOBALS{'corsite_dispresitotalunitscalc'} = $GLOBALS{'corsite_dispresitotalunitscalc'} + $GLOBALS{'corresi_quantity'};
				$GLOBALS{'corsite_dispresitotalsqftcalc'} = $GLOBALS{'corsite_dispresitotalsqftcalc'} + ( $GLOBALS{'corresi_quantity'} * $GLOBALS{'corresi_area'});
				$GLOBALS{'corsite_dispresigdvsubtotalcalc'} = $GLOBALS{'corsite_dispresigdvsubtotalcalc'} + $GLOBALS{'corresi_postdiscountcalc'};
			}
			$GLOBALS{'corsite_disptotsitegdvcalc'} = $GLOBALS{'corsite_dispcommgdvsubtotalcalc'} + $GLOBALS{'corsite_dispresigdvsubtotalcalc'};
	
			// ==== FA1 Development ===============
			$GLOBALS{'corsite_buildingdvtotcalc'} = 0;
			$GLOBALS{'corsite_buildoutgdvtotcalc'} = 0;
			if ( $GLOBALS{'corsite_buildcomminternally'} == "Y" ) { $GLOBALS{'corsite_buildingdvtotcalc'} = $GLOBALS{'corsite_buildingdvtotcalc'} + $GLOBALS{'corsite_dispcommgdvsubtotalcalc'}; }
			else { $GLOBALS{'corsite_buildoutgdvtotcalc'} = $GLOBALS{'corsite_buildoutgdvtotcalc'} + $GLOBALS{'corsite_dispcommgdvsubtotalcalc'}; }
			if ( $GLOBALS{'corsite_buildresiinternally'} == "Y" ) { $GLOBALS{'corsite_buildingdvtotcalc'} = $GLOBALS{'corsite_buildingdvtotcalc'} + $GLOBALS{'corsite_dispresigdvsubtotalcalc'}; } 
			else { $GLOBALS{'corsite_buildoutgdvtotcalc'} = $GLOBALS{'corsite_buildoutgdvtotcalc'} + $GLOBALS{'corsite_dispresigdvsubtotalcalc'}; }
			
			// ==== Internal Build Perspective ===============
			
			// Note this section will have to be modified to ensure that correct values are left in the case of no internal build = CHECK
			if (( $GLOBALS{'corsite_buildcomminternally'} == "Y" )||( $GLOBALS{'corsite_buildresiinternally'} == "Y" )) { 	
				if (( $GLOBALS{'corsite_buildcomminternally'} == "Y" )&&( $GLOBALS{'corsite_buildresiinternally'} == "Y" )) {
					$GLOBALS{'corsite_buildintotalsqftcalc'} = $GLOBALS{'corsite_dispcommtotalsqftcalc'} + $GLOBALS{'corsite_dispresitotalsqftcalc'};
				}
				if (( $GLOBALS{'corsite_buildcomminternally'} == "Y" )&&( $GLOBALS{'corsite_buildresiinternally'} != "Y" )) {
					$GLOBALS{'corsite_buildintotalsqftcalc'} = $GLOBALS{'corsite_dispcommtotalsqftcalc'};
				}			
				if (( $GLOBALS{'corsite_buildcomminternally'} != "Y" )&&( $GLOBALS{'corsite_buildresiinternally'} == "Y" )) {
					$GLOBALS{'corsite_buildintotalsqftcalc'} = $GLOBALS{'corsite_dispresitotalsqftcalc'};
				}	
				// calculate internal build costs if any internal build
				$GLOBALS{'corsite_buildincoststotcalc'} = 0;
				$GLOBALS{'corsite_buildinagentsalecalc'}= ($GLOBALS{'corsite_buildingdvtotcalc'} * $GLOBALS{'corsite_buildinagentsalepercent'}) / 100;			
				$GLOBALS{'corsite_buildintotalbuildcostcalc'} = $GLOBALS{'corsite_buildintotalsqftcalc'} * $GLOBALS{'corsite_buildincostpersqft'}* ( 100 + $GLOBALS{'corsite_buildinextrasqftpercent'} ) / 100;				
				$GLOBALS{'corsite_buildincoststotcalc'} = $GLOBALS{'corsite_buildinagentsalecalc'}+$GLOBALS{'corsite_buildinlegals'}+$GLOBALS{'corsite_buildinproffees'}+$GLOBALS{'corsite_buildinother'}+$GLOBALS{'corsite_buildintotalbuildcostcalc'};
				$GLOBALS{'corsite_buildinnpcalc'} = $GLOBALS{'corsite_buildingdvtotcalc'}-$GLOBALS{'corsite_buildincoststotcalc'};
			} else {
				// zero internal build costs if no internal build
				$GLOBALS{'corsite_buildintotalsqftcalc'} = 0;
				$GLOBALS{'corsite_buildincoststotcalc'} = 0;
				$GLOBALS{'corsite_buildinagentsalecalc'} = 0;
				$GLOBALS{'corsite_buildinlegals'} = 0;	
				$GLOBALS{'corsite_buildinproffees'} = 0;
				$GLOBALS{'corsite_buildinother'} = 0;			
				$GLOBALS{'corsite_buildinextrasqftpercent'} = 0;			
				$GLOBALS{'corsite_buildintotalbuildcostcalc'} = 0;
				$GLOBALS{'corsite_buildincoststotcalc'} = 0;
				$GLOBALS{'corsite_buildinnpcalc'} = 0;
			}
			// reset input fields with values
			
			// ==== Developer Build Perspective ===============
			
			// Note this section will have to be modified to ensure that correct values are left in the case of no developer build
			
			if (( $GLOBALS{'corsite_buildcomminternally'} == "N" )||( $GLOBALS{'corsite_buildresiinternally'} == "N" )) { 
				if (( $GLOBALS{'corsite_buildcomminternally'} == "N" )&&( $GLOBALS{'corsite_buildresiinternally'} == "N" )) {
					$GLOBALS{'corsite_buildouttotalsqftcalc'} = $GLOBALS{'corsite_dispcommtotalsqftcalc'} + $GLOBALS{'corsite_dispresitotalsqftcalc'};
				}
				if (( $GLOBALS{'corsite_buildcomminternally'} == "N" )&&( $GLOBALS{'corsite_buildresiinternally'} != "N" )) {
					$GLOBALS{'corsite_buildouttotalsqftcalc'} = $GLOBALS{'corsite_dispcommtotalsqftcalc'};
				}			
				if (( $GLOBALS{'corsite_buildcomminternally'} != "N" )&&( $GLOBALS{'corsite_buildresiinternally'} == "N" )) {
					$GLOBALS{'corsite_buildouttotalsqftcalc'} = $GLOBALS{'corsite_dispresitotalsqftcalc'};
				}
				// calculate developer build costs if any developer build
		
				$GLOBALS{'corsite_buildoutagentsalecalc'} = ($GLOBALS{'corsite_buildoutgdvtotcalc'} * $GLOBALS{'corsite_buildoutagentsalepercent'}) / 100;
				if ( $GLOBALS{'corsite_buildoutgdvtotcalc'}== 0 ) { $GLOBALS{'corsite_salelandvaluepercentcalc'} = 0; }
				else { $GLOBALS{'corsite_salelandvaluepercentcalc'}= ($GLOBALS{'corsite_salelandvalue'} / $GLOBALS{'corsite_buildoutgdvtotcalc'})*100; }					
				$tranche1 = 0; $tranche2 = 0;
				if ($GLOBALS{'corsite_salelandvalue'} >= 250000) {
						$tranche1 = 100000;
						$tranche2 = $GLOBALS{'corsite_salelandvalue'} - 249999;				
				} else {
					if ($GLOBALS{'corsite_salelandvalue'} >= 150000) {
						$tranche1 = $GLOBALS{'corsite_salelandvalue'} - 149999;		
					}
				}
				
				$GLOBALS{'corsite_buildoutsdltcalc'} = ($tranche1 * 0.02) + ($tranche2 * 0.05) ;
				// XPTXTCOLOR($GLOBALS{'corsite_buildoutsdltcalc'}." ".$tranche1." ".$tranche2,"red");
				if ( $GLOBALS{'corsite_salelandvalue'} == 0 ) { $GLOBALS{'corsite_buildoutsdltpercentcalc'} = 0; }
				else { $GLOBALS{'corsite_buildoutsdltpercentcalc'} = ($GLOBALS{'corsite_buildoutsdltcalc'} / $GLOBALS{'corsite_salelandvalue'})*100; }				
				$GLOBALS{'corsite_buildoutagentpurchasecalc'} = ($GLOBALS{'corsite_salelandvalue'} * $GLOBALS{'corsite_buildoutagentpurchasepercent'})/100;
				$GLOBALS{'corsite_buildouttotalbuildcostcalc'} = $GLOBALS{'corsite_buildouttotalsqftcalc'} * $GLOBALS{'corsite_buildoutcostpersqft'} * ( 100 + $GLOBALS{'corsite_buildoutextrasqftpercent'} ) / 100;			
				
				$GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'} = $GLOBALS{'corsite_buildoutagentsalecalc'} + $GLOBALS{'corsite_salelandvalue'} + $GLOBALS{'corsite_buildoutsdltcalc'} + $GLOBALS{'corsite_buildoutlegals'} + $GLOBALS{'corsite_buildoutagentpurchasecalc'} + $GLOBALS{'corsite_buildoutother'} + $GLOBALS{'corsite_buildoutcil'} + $GLOBALS{'corsite_buildoutproffees'} + $GLOBALS{'corsite_buildouttotalbuildcostcalc'};
				
				// Net Profit before Interest		
				$GLOBALS{'corsite_buildoutgpbeforeintcalc'} = $GLOBALS{'corsite_buildoutgdvtotcalc'}- $GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'};
				
				if ($GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'} != 0) {
				    $GLOBALS{'corsite_buildoutgpbeforeintpercentcalc'} = ($GLOBALS{'corsite_buildoutgpbeforeintcalc'} / $GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'})*100;
				} else {
				    $GLOBALS{'corsite_buildoutgpbeforeintpercentcalc'} = 0;
				}
				$GLOBALS{'corsite_buildoutvatcalc'} = ($GLOBALS{'corsite_salelandvalue'} * $GLOBALS{'corsite_buildoutvatablepercent'} * $GLOBALS{'corsite_buildoutvatratepercent'})/10000;
				
				$GLOBALS{'corsite_buildoutfinancingnetborrowingcalc'} = ($GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'} * $GLOBALS{'corsite_buildoutfinancingltvpercent'})/100;						
				$GLOBALS{'corsite_buildoutfinancingcostscalc'} = ($GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'} * $GLOBALS{'corsite_buildoutfinancingltvpercent'} * $GLOBALS{'corsite_buildoutfinancingintratepercent'}) * $GLOBALS{'corsite_buildoutfinancingduration'} / 120000;		
				
				$GLOBALS{'corsite_buildouttotaldealcostafterintcalc'} = $GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'} + $GLOBALS{'corsite_buildoutfinancingcostscalc'};
				
				// Net Profit after Interest
				$GLOBALS{'corsite_buildoutnpafterintcalc'} = $GLOBALS{'corsite_buildoutgdvtotcalc'} - $GLOBALS{'corsite_buildouttotaldealcostafterintcalc'};
				
				if ($GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'} != 0) {
				    $GLOBALS{'corsite_buildoutnpafterintpercentcalc'}= ($GLOBALS{'corsite_buildoutnpafterintcalc'} / $GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'})*100;
				} else {
				    $GLOBALS{'corsite_buildoutnpafterintpercentcalc'} = 0;
				}

				// Net Profit after Interest and tax
				$tax = ($GLOBALS{'corsite_buildoutnpafterintcalc'} * $GLOBALS{'corsite_buildouttaxratepercent'})/100;
				
				$GLOBALS{'corsite_buildoutnpafterintandtaxcalc'} = $GLOBALS{'corsite_buildoutnpafterintcalc'} - $tax;
				if ($GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'} != 0) {
				    $GLOBALS{'corsite_buildoutnpafterintandtaxpercentcalc'} = ($GLOBALS{'corsite_buildoutnpafterintandtaxcalc'} / $GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'})*100;
				} else {
				    $GLOBALS{'corsite_buildoutnpafterintandtaxpercentcalc'} = 0;
				}
				
				$GLOBALS{'corsite_buildoutnpcalc'} = $GLOBALS{'corsite_salelandvalue'};
					
			} else { 
				// zero developer build costs if no developer build
				$GLOBALS{'corsite_buildouttotalsqftcalc'} = 0;
				$GLOBALS{'corsite_buildoutagentsalecalc'} = 0;
				$GLOBALS{'corsite_salelandvalue'} = 0;
				$GLOBALS{'corsite_salelandvaluepercentcalc'} = 0;
				$GLOBALS{'corsite_buildoutsdltcalc'}= 0;
				$GLOBALS{'corsite_buildoutsdltpercentcalc'} = 0;
				$GLOBALS{'corsite_buildoutlegals'} = 0;
				$GLOBALS{'corsite_buildoutagentpurchasecalc'} = 0;
				$GLOBALS{'corsite_buildoutother'} = 0;
				$GLOBALS{'corsite_buildoutproffees'} = 0;
				$GLOBALS{'corsite_buildoutcil'} = 0;				
				$GLOBALS{'corsite_buildoutextrasqftpercent'} = 0;	
				$GLOBALS{'corsite_buildouttotalbuildcostcalc'} = 0;			
				
				$GLOBALS{'corsite_buildouttotaldealcostbeforeintcalc'} = 0;
				
				// Net Profit before Interest		
				$GLOBALS{'corsite_buildoutgpbeforeintcalc'} = 0;	
				$GLOBALS{'corsite_buildoutgpbeforeintpercentcalc'} = 0;
				
				$GLOBALS{'corsite_buildoutvatcalc'} = 0;
				
				$GLOBALS{'corsite_buildoutfinancingnetborrowingcalc'} = 0;						
				$GLOBALS{'corsite_buildoutfinancingcostscalc'} = 0;		
				
				$GLOBALS{'corsite_buildouttotaldealcostafterintcalc'} = 0;
				
				// Net Profit after Interest
				$GLOBALS{'corsite_buildoutnpafterintcalc'} = 0;
				$GLOBALS{'corsite_buildoutnpafterintpercentcalc'} = 0;
	
				// Net Profit after Interest and tax
				$tax = 0;
				
				$GLOBALS{'corsite_buildoutnpafterintandtaxcalc'} = 0;
				$GLOBALS{'corsite_buildoutnpafterintandtaxpercentcalc'} = 0;
				$GLOBALS{'corsite_buildoutnpcalc'} = 0;
			}
			
			
			// Net Profit after Interest
	
			// Net Profit after Interest and tax
			
			$GLOBALS{'corsite_buildtotalgpcalc'} = $GLOBALS{'corsite_buildinnpcalc'} + $GLOBALS{'corsite_buildoutnpcalc'};
			
			// ==== Finance and Operations ===============
			
			// ==== Surveys ========================================
			$GLOBALS{'corsite_plgsurveytotalph1quotecalc'} = 0;
			$GLOBALS{'corsite_plgsurveytotaladhocquotecalc'} = 0;
			$GLOBALS{'corsite_plgsurveytotalsuccessfeecalc'} = 0;					
			$GLOBALS{'corsite_plgsurveytotalquotecalc'} = 0;
			$GLOBALS{'corsite_plgsurveytotalcostexvatsagecalc'} = 0;
			$GLOBALS{'corsite_plgsurveytotalcostvsquotevarcalc'} = 0;
			
			$GLOBALS{'corsite_buildtotalplanningsubmissionfees'} = 0;
			$GLOBALS{'corsite_buildtotalplanningproffees'} = 0;

        	$thissurveyida = List2Array($GLOBALS{'corsite_plgsurveylist'});
        	foreach ($thissurveyida as $corsurvey_id) {
        		Get_Data('corsurvey',$corsurvey_id);				
				$GLOBALS{'corsurvey_totalquotecalc'}= $GLOBALS{'corsurvey_ph1quote'} + $GLOBALS{'corsurvey_adhocquote'} + $GLOBALS{'corsurvey_successfee'};
				$GLOBALS{'corsurvey_costvsquotevarcalc'}= $GLOBALS{'corsurvey_totalquotecalc'}- $GLOBALS{'corsurvey_costexvatsagecalc'};				
				$GLOBALS{'corsite_plgsurveytotalph1quotecalc'} = $GLOBALS{'corsite_plgsurveytotalph1quotecalc'} + $GLOBALS{'corsurvey_ph1quote'};
				$GLOBALS{'corsite_plgsurveytotaladhocquotecalc'} = $GLOBALS{'corsite_plgsurveytotaladhocquotecalc'} + $GLOBALS{'corsurvey_adhocquote'};
				$GLOBALS{'corsite_plgsurveytotalsuccessfeecalc'} = $GLOBALS{'corsite_plgsurveytotalsuccessfeecalc'} + $GLOBALS{'corsurvey_successfee'};			
				$GLOBALS{'corsite_plgsurveytotalquotecalc'} = $GLOBALS{'corsite_plgsurveytotalquotecalc'} + $GLOBALS{'corsurvey_totalquotecalc'};
				$GLOBALS{'corsite_plgsurveytotalcostexvatsagecalc'} = $GLOBALS{'corsite_plgsurveytotalcostexvatsagecalc'} + $GLOBALS{'corsurvey_costexvatsagecalc'};
				$GLOBALS{'corsite_plgsurveytotalcostvsquotevarcalc'} = $GLOBALS{'corsite_plgsurveytotalcostvsquotevarcalc'} + $GLOBALS{'corsurvey_costvsquotevarcalc'};	
				if ($GLOBALS{'corsurvey_corsurveycategoryid'} == "AppSubmission") { $GLOBALS{'corsite_buildtotalplanningsubmissionfees'} = $GLOBALS{'corsite_buildtotalplanningsubmissionfees'} + $GLOBALS{'corsurvey_ph1quote'}; }
				else { $GLOBALS{'corsite_buildtotalplanningproffees'} = $GLOBALS{'corsite_buildtotalplanningproffees'} + $GLOBALS{'corsurvey_ph1quote'}; }
			}		
			$GLOBALS{'corsite_buildtotalplanningsuccessfees'} = $GLOBALS{'corsite_plgsurveytotalsuccessfeecalc'};
					
			// ==== Proceeds and Uplift on Financial Appraisal 1 ===========================================				
			$GLOBALS{'corsite_buildtotalgrossproceeds'} = $GLOBALS{'corsite_buildtotalgpcalc'};
			if ( $GLOBALS{'corsite_quoteready'} != "Y") { // override with default values
				// if ( $GLOBALS{'corsite_proposalphasestatus'} == "Ph2Completed") {
					// if (( $GLOBALS{'corsite_proposalnewrag'} == "Green")||( $GLOBALS{'corsite_proposalnewrag'} == "Amber" )) {						
						Get_Data_Hash('cordefaultvalue',"corsite_buildtotalplanningproffees");
						if ($GLOBALS{"IOERROR"} == "1") { $GLOBALS{'corsite_buildtotalplanningproffees'} = 0; } else { $GLOBALS{'corsite_buildtotalplanningproffees'} = $GLOBALS{'cordefaultvalue_value'}; }
						Get_Data_Hash('cordefaultvalue',"corsite_buildtotalplanningsubmissionfees");
						if ($GLOBALS{"IOERROR"} == "1") { $GLOBALS{'corsite_buildtotalplanningsubmissionfees'} = 0; } else { $GLOBALS{'corsite_buildtotalplanningsubmissionfees'} = $GLOBALS{'cordefaultvalue_value'}; }
						Get_Data_Hash('cordefaultvalue',"corsite_buildtotalplanningsuccessfees");
						if ($GLOBALS{"IOERROR"} == "1") { $GLOBALS{'corsite_buildtotalplanningsuccessfees'} = 0; } else { $GLOBALS{'corsite_buildtotalplanningsuccessfees'} = $GLOBALS{'cordefaultvalue_value'}; }	
					// }							
				// }
			}
			$GLOBALS{'corsite_buildtotalnetproceeds'} = $GLOBALS{'corsite_buildtotalgrossproceeds'} - $GLOBALS{'corsite_buildtotalplanningproffees'} - $GLOBALS{'corsite_buildtotalplanningsubmissionfees'} - $GLOBALS{'corsite_buildtotalplanningsuccessfees'} - $GLOBALS{'corsite_buildtotallegalcosts'} - $GLOBALS{'corsite_buildtotalothercosts'} - $GLOBALS{'corsite_buildtotalcapex'} - $GLOBALS{'corsite_buildtotallossofebitda'};

			if ( $GLOBALS{'corsite_proposaltype'} == "Full Site" ) {			
				$GLOBALS{'corsite_predictedebitdapercent'} = 100;			
				$GLOBALS{'corsite_predictedebitdacalc'} = $GLOBALS{'corsite_currfinlatestebitda'};
				$GLOBALS{'corsite_predictedebitdacalc'} = 0;  // ===================== CHECK ========================
				$GLOBALS{'corsite_capvalebitdaimpactcalc'} = 0;
				$GLOBALS{'corsite_upliftcalc'} = $GLOBALS{'corsite_buildtotalnetproceeds'} - $GLOBALS{'corsite_arkgva'};
			}			
			if ( $GLOBALS{'corsite_proposaltype'} == "Part Site" ) {		
				$GLOBALS{'corsite_predictedebitdapercent'} = 100;	
				$GLOBALS{'corsite_predictedebitdacalc'} = $GLOBALS{'corsite_currfinlatestebitda'};
				$GLOBALS{'corsite_predictedebitdacalc'} = 0;  // ===================== CHECK ========================
				$GLOBALS{'corsite_capvalebitdaimpactcalc'} = 0;
				$GLOBALS{'corsite_upliftcalc'} = $GLOBALS{'corsite_buildtotalnetproceeds'};
			}		
			if ( $GLOBALS{'corsite_proposaltype'} == "Split Site" ) {
			    
				$GLOBALS{'corsite_predictedebitdacalc'} = $GLOBALS{'corsite_currfinlatestebitda'} * $GLOBALS{'corsite_predictedebitdapercent'} / 100;	
				$GLOBALS{'corsite_capvalebitdaimpactcalc'}= ($GLOBALS{'corsite_currfinlatestebitda'} - $GLOBALS{'corsite_predictedebitdacalc'}) * $GLOBALS{'corsite_ebitdamultiple'};
				$GLOBALS{'corsite_upliftcalc'} = $GLOBALS{'corsite_buildtotalnetproceeds'} - $GLOBALS{'corsite_capvalebitdaimpactcalc'};
			}
				
			
			// ==== Financial Appraisal 2 =======================================		

			if ( $GLOBALS{'corsite_appfwdebitdafull'}  > $GLOBALS{'corsite_appltmebitdafull'}  ) {
				$GLOBALS{'corsite_appbaseebitdafullcalc'}= Math.max($GLOBALS{'corsite_appfwdebitdafull'},$GLOBALS{'corsite_appltmebitdafull'});
			} else {
				$GLOBALS{'corsite_appbaseebitdafullcalc'}= Math.min($GLOBALS{'corsite_appfwdebitdafull'},$GLOBALS{'corsite_appltmebitdafull'});
			}
			if ( $GLOBALS{'corsite_appfwdebitdapart'}  > $GLOBALS{'corsite_appltmebitdapart'}  ) {
				$GLOBALS{'corsite_appbaseebitdapartcalc'}= Math.max($GLOBALS{'corsite_appfwdebitdapart'},$GLOBALS{'corsite_appltmebitdapart'});
			} else {
				$GLOBALS{'corsite_appbaseebitdapartcalc'}= Math.min($GLOBALS{'corsite_appfwdebitdapart'},$GLOBALS{'corsite_appltmebitdapart'});
			}

			if ( $GLOBALS{'corsite_appcapexoppfull'} == "No" ) {
				$GLOBALS{'corsite_appimpliedvalfullcalc'} = $GLOBALS{'corsite_appbaseebitdafullcalc'}* $GLOBALS{'corsite_appebitdamultiplefull'};		
			} else {
				$GLOBALS{'corsite_appimpliedvalfullcalc'}= ($GLOBALS{'corsite_appbaseebitdafullcalc'}* $GLOBALS{'corsite_appebitdamultiplefull'}) + $GLOBALS{'corsite_appcapexspendfull'} ;	
			}
			if ( $GLOBALS{'corsite_appcapexopppart'} == "No" ) {
				$GLOBALS{'corsite_appimpliedvalpartcalc'} = $GLOBALS{'corsite_appbaseebitdapartcalc'}* $GLOBALS{'corsite_appebitdamultiplepart'};		
			} else {
				$GLOBALS{'corsite_appimpliedvalpartcalc'}= ($GLOBALS{'corsite_appbaseebitdapartcalc'}* $GLOBALS{'corsite_appebitdamultiplepart'}) + $GLOBALS{'corsite_appcapexspendpart'} ;	
			}
			// --------
	
			$GLOBALS{'corsite_appnprocfullcalc'} = $GLOBALS{'corsite_appgdprocfull'} + $GLOBALS{'corsite_appplanningcostsfull'} + $GLOBALS{'corsite_applegalcostsfull'} + $GLOBALS{'corsite_appothercostsfull'};		
			$GLOBALS{'corsite_appnprocpartcalc'} = $GLOBALS{'corsite_appgdprocpart'} + $GLOBALS{'corsite_appplanningcostspart'} + $GLOBALS{'corsite_applegalcostspart'} + $GLOBALS{'corsite_appothercostspart'};		
			// --------	
			$GLOBALS{'corsite_appnprocvsbasevalfullcalc'} = $GLOBALS{'corsite_appnprocfullcalc'} - $GLOBALS{'corsite_appbasevalfullcalc'};
			$GLOBALS{'corsite_appnprocvsbasevalpartcalc'} = $GLOBALS{'corsite_appnprocpartcalc'} - $GLOBALS{'corsite_appbasevalpartcalc'};
			// --------
			if ($GLOBALS{'corsite_appbasevalfullcalc'}== 0 ) { $GLOBALS{'corsite_appnprocvsbasevalfullpercentcalc'} = 0; }
			else { $GLOBALS{'corsite_appnprocvsbasevalfullpercentcalc'}= (($GLOBALS{'corsite_appnprocfullcalc'}/$GLOBALS{'corsite_appbasevalfullcalc'})-1)*100; }
			if ($GLOBALS{'corsite_appbasevalpartcalc'}== 0 ) { $GLOBALS{'corsite_appnprocvsbasevalpartpercentcalc'} = 0; }
			else { $GLOBALS{'corsite_appnprocvsbasevalpartpercentcalc'}= (($GLOBALS{'corsite_appnprocpartcalc'}/$GLOBALS{'corsite_appbasevalpartcalc'})-1)*100; }
			// --------		
			if ( $GLOBALS{'corsite_appnprocvsbasevalfullcalc'} > 0 ) {
				$GLOBALS{'corsite_appdisposalstrategyfullcalc'} = "Dispose";		
			} else {
				$GLOBALS{'corsite_appdisposalstrategyfullcalc'} = "Retain";
			}		
			if ( $GLOBALS{'corsite_appnprocvsbasevalpartcalc'} > 0 ) {
				$GLOBALS{'corsite_appdisposalstrategypartcalc'} = "Dispose";		
			} else {
				$GLOBALS{'corsite_appdisposalstrategypartcalc'} = "Retain";
			}	
			// --------		
			if ( $GLOBALS{'corsite_appbaseebitdafullcalc'}== 0 ) { $GLOBALS{'corsite_appimpliedmultiplefullcalc'} = 0; }
			else { $GLOBALS{'corsite_appimpliedmultiplefullcalc'} = $GLOBALS{'corsite_appnprocfullcalc'} / $GLOBALS{'corsite_appbaseebitdafullcalc'}; }		
			if ( $GLOBALS{'corsite_appbaseebitdapartcalc'}== 0 ) { $GLOBALS{'corsite_appimpliedmultiplepartcalc'} = 0; }
			else { $GLOBALS{'corsite_appimpliedmultiplepartcalc'}= $GLOBALS{'corsite_appnprocpartcalc'} / $GLOBALS{'corsite_appbaseebitdapartcalc'}; }	

			foreach ($tfields as $tfieldelement) {
			    $seq++;
			    if (strlen(strstr($tfieldelement,"percentcalc"))>0) {
			        $GLOBALS{'OLD'.$tfieldelement} = number_format(floatval($GLOBALS{'OLD'.$tfieldelement}),2);
			        $GLOBALS{'NEW'.$tfieldelement} = number_format(floatval($GLOBALS{$tfieldelement}),2);	
			        if ((($GLOBALS{'OLD'.$tfieldelement} - $GLOBALS{'NEW'.$tfieldelement}) > 0.1)||(($GLOBALS{'OLD'.$tfieldelement} - $GLOBALS{'NEW'.$tfieldelement}) < -0.1)) {			            
			            LineOut($seq,$corsite_id,$corsite_version,$tfieldelement,$mode);
			        }
			    } else {		        
			        if ((strlen(strstr($tfieldelement,"calc"))>0)||(strlen(strstr($tfieldelement,"proceeds"))>0)) {
			            $GLOBALS{'OLD'.$tfieldelement} = number_format(floatval($GLOBALS{'OLD'.$tfieldelement}));
			            $GLOBALS{'NEW'.$tfieldelement} = number_format(floatval($GLOBALS{$tfieldelement}));
			            if ((($GLOBALS{'OLD'.$tfieldelement} - $GLOBALS{'NEW'.$tfieldelement}) > 1)||(($GLOBALS{'OLD'.$tfieldelement} - $GLOBALS{'NEW'.$tfieldelement}) < -1)) {
			                LineOut($seq,$corsite_id,$corsite_version,$tfieldelement,$mode);			            
			            }
			        } else {
    			        if ($GLOBALS{'OLD'.$tfieldelement} != $GLOBALS{$tfieldelement}) {
    			            LineOut($seq,$corsite_id,$corsite_version,$tfieldelement,$mode);                       
    			        }
			        }
			    }
			    /*
			    if ($tfieldelement == "corsite_buildtotalnetproceeds") {
			        LineOut($seq,$corsite_id,$corsite_version,$tfieldelement,$mode);
			    }
			    */
			}
        } 
        if ( $mode == "Real") {
            $GLOBALS{'corsite_lastupdatetimestamp'} = $GLOBALS{'currenttimestamp'};
            $GLOBALS{'corsite_lastupdatepersonid'} = $GLOBALS{'LOGIN_person_id'};
            $GLOBALS{'corsite_lastupdatetype'} = "Site Recalculation";           
            Write_Data('corsite',$corsite_id,$corsite_version);
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
}

function LineOut($seq,$corsite_id,$corsite_version,$tfieldelement,$mode) {
    XTRJQDT();
    XTDTXTCOLOR($seq,"#cccccc");
    XTDTXTCOLOR($corsite_id,"#cccccc");
    XTDTXTCOLOR($corsite_version,"#cccccc");
    XTDTXTCOLOR($GLOBALS{'corsite_site'},"#cccccc");
    XTDTXTCOLOR($GLOBALS{'corsite_status'},"#cccccc");
    XTDTXTCOLOR($GLOBALS{'corsite_proposaltype'},"#cccccc");
    XTDTXTCOLOR($GLOBALS{'corsite_proposalphasestatus'},"#cccccc");
    XTDTXTCOLOR($GLOBALS{'corsite_proposalnewrag'},"#cccccc");
    XTDTXT($tfieldelement);
    XTDTXT($GLOBALS{'OLD'.$tfieldelement});    
    XTDTXT($GLOBALS{'NEW'.$tfieldelement});
    if ( $mode == "Real") {
        XTDTXTCOLOR("UPDATED","blue");
    } else {
        XTDTXT('');        
    }
    X_TR();
}









?>