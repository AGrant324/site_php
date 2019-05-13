<?php

function SFM_SETUPSFMCLUB_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function SFM_SETUPSFMCLUB_Output() {
    $parm0 = "";
    $parm0 = $parm0."Club Setup"."|"; # pagetitle
    $parm0 = $parm0."sfmclub"."|"; # primetable
    $parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
    $parm0 = $parm0."sfmclub_id|"; # keyfieldname
    $parm0 = $parm0."sfmclub_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmclub_id|Yes|Set Id|120|Yes|Set Id|KeyText,25,25^";
    $parm1 = $parm1."sfmclub_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmclub_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmclub_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmclub_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmclub_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmclub_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";  
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "other,person_domainid|person_id|person_sname|person_fname",
        "person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40",
        "field,administrator,Select,sfmclub_adminpersonid_input,sfmclub_adminpersonid_personlist,80|
field,otheradministrator,Select,sfmclub_otheradminpersonidlist_input,sfmclub_otheradminpersonidlist_personlist,80|
field,otherreadonly,Select,sfmclub_otherreadonlypersonidlist_input,sfmclub_otherreadonlypersonidlist_personlist,80|
field,floodinspector,Select,sfmclub_floodinspectoridlist_input,sfmclub_floodinspectoridlist_personlist,80|
field,groundinspector,Select,sfmclub_groundinspectoridlist_input,sfmclub_groundinspectoridlist_personlist,80",
        "person_id",
        "active",
        "sfmclubusers,50,50,400,400","view",
        "buildfulllist"
    );        
}

function SFM_SETUPSFMSET_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function SFM_SETUPSFMSET_Output() {
    $parm0 = "";
    $parm0 = $parm0."Club Sets"."|"; # pagetitle
    $parm0 = $parm0."sfmset"."|"; # primetable
    $parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
    $parm0 = $parm0."sfmset_id|"; # keyfieldname
    $parm0 = $parm0."sfmset_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmset_id|Yes|Set Id|120|Yes|Set Id|KeyText,25,25^";
    $parm1 = $parm1."sfmset_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmset_clubregistrationkey||||Yes|Club Registration Key|InputText,20,40^";
    $parm1 = $parm1."sfmset_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmset_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmset_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmset_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmset_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";  
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "other,person_domainid|person_id|person_sname|person_fname",
        "person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40",
        "field,administrator,Select,sfmset_adminpersonid_input,sfmset_adminpersonid_personlist,80|
field,otheradministrator,Select,sfmset_otheradminpersonidlist_input,sfmset_otheradminpersonidlist_personlist,80|
field,otherreadonly,Select,sfmset_otherreadonlypersonidlist_input,sfmset_otherreadonlypersonidlist_personlist,80|
field,floodinspector,Select,sfmset_floodinspectoridlist_input,sfmset_floodinspectoridlist_personlist,80|
field,groundinspector,Select,sfmset_groundinspectoridlist_input,sfmset_groundinspectoridlist_personlist,80",
        "person_id",
        "active",
        "sfmsetusers,50,50,400,400","view",
        "buildfulllist"
    );        
}

function SFM_SETUPSFMLEAGUE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function SFM_SETUPSFMLEAGUE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Leagues"."|"; # pagetitle
    $parm0 = $parm0."sfmleague"."|"; # primetable
    $parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
    $parm0 = $parm0."sfmleague_id|"; # keyfieldname
    $parm0 = $parm0."sfmleague_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmleague_id|Yes|League Id|120|Yes|League Id|KeyText,25,25^";
    $parm1 = $parm1."sfmleague_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmleague_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    $parm1 = $parm1."sfmleague_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmleague_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmleague_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmleague_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmleague_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";  
    $parm1 = $parm1."generic_programbutton|Yes|Setup Divisions|80|No|Setup Divisions|ProgramButton,sfmdivisionsetupout.php,sfmleague_id,sfmleague_id,samewindow,,^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "other,person_domainid|person_id|person_sname|person_fname",
        "person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40",
        "field,administrator,Select,sfmleague_adminpersonid_input,sfmleague_adminpersonid_personlist,80|
field,otheradministrator,Select,sfmleague_otheradminpersonidlist_input,sfmleague_otheradminpersonidlist_personlist,80|
field,otherreadonly,Select,sfmleague_otherreadonlypersonidlist_input,sfmleague_otherreadonlypersonidlist_personlist,80|
field,floodinspector,Select,sfmleague_floodinspectoridlist_input,sfmleague_floodinspectoridlist_personlist,80|
field,groundinspector,Select,sfmleague_groundinspectoridlist_input,sfmleague_groundinspectoridlist_personlist,80",
        "person_id",
        "active",
        "sfmleagueusers,50,50,400,400","view",
        "buildfulllist"
    ); 
}

function SFM_SETUPSFMDIVISION_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function SFM_SETUPSFMDIVISION_Output($sfmleague_id) {
    Get_Data("sfmleague",$sfmleague_id);
    $parm0 = "";
    $parm0 = $parm0.$GLOBALS{"sfmleague_name"}." Divisions "."|"; # pagetitle
    $parm0 = $parm0."sfmdivision[rootkey=".$sfmleague_id."]"."|"; # primetable
    $parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname]|"; # othertables
    $parm0 = $parm0."sfmdivision_id|"; # keyfieldname
    $parm0 = $parm0."sfmdivision_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmdivision_id|Yes|League Id|120|Yes|League Id|KeyText,25,25^";
    $parm1 = $parm1."sfmdivision_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmdivision_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    $parm1 = $parm1."sfmdivision_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmdivision_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmdivision_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmdivision_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmdivision_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";      
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "other,person_domainid|person_id|person_sname|person_fname",
        "person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40",
        "field,administrator,Select,sfmdivision_adminpersonid_input,sfmdivision_adminpersonid_personlist,80|
field,otheradministrator,Select,sfmdivision_otheradminpersonidlist_input,sfmdivision_otheradminpersonidlist_personlist,80|
field,otherreadonly,Select,sfmdivision_otherreadonlypersonidlist_input,sfmdivision_otherreadonlypersonidlist_personlist,80|
field,floodinspector,Select,sfmdivision_floodinspectoridlist_input,sfmdivision_floodinspectoridlist_personlist,80|
field,groundinspector,Select,sfmdivision_groundinspectoridlist_input,sfmdivision_groundinspectoridlist_personlist,80",
        "person_id",
        "active",
        "sfmdivisionusers,50,50,400,400","view",
        "buildfulllist"
    );
}

function SFM_SETUPSFMDIVISIONOLD_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";	
}

function SFM_SETUPSFMDIVISIONOLD_Output($sfmleague_id) {
    Get_Data("sfmleague",$sfmleague_id);
    $parm0 = "";
    $parm0 = $parm0.$GLOBALS{"sfmleague_name"}." Divisions "."|"; # pagetitle
    $parm0 = $parm0."sfmdivision[rootkey=".$sfmleague_id."]"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."sfmdivision_id|"; # keyfieldname
    $parm0 = $parm0."sfmdivision_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmdivision_id|Yes|League Id|120|Yes|League Id|KeyText,25,25^";
    $parm1 = $parm1."sfmdivision_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmdivision_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    /*
    $parm1 = $parm1."sfmdivision_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmdivision_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmdivision_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmdivision_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmdivision_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^"; 
     */     
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMCOUNTY_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function SFM_SETUPSFMCOUNTY_Output() {
    $parm0 = "";
    $parm0 = $parm0."County Associations"."|"; # pagetitle
    $parm0 = $parm0."sfmcounty"."|"; # primetable
    $parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
    $parm0 = $parm0."sfmcounty_id|"; # keyfieldname
    $parm0 = $parm0."sfmcounty_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmcounty_id|Yes|League Id|120|Yes|League Id|KeyText,25,25^";
    $parm1 = $parm1."sfmcounty_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmcounty_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    $parm1 = $parm1."sfmcounty_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmcounty_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmcounty_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmcounty_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmcounty_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";    
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "other,person_domainid|person_id|person_sname|person_fname",
        "person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40",
        "field,administrator,Select,sfmcounty_adminpersonid_input,sfmcounty_adminpersonid_personlist,80|
field,otheradministrator,Select,sfmcounty_otheradminpersonidlist_input,sfmcounty_otheradminpersonidlist_personlist,80|
field,otherreadonly,Select,sfmcounty_otherreadonlypersonidlist_input,sfmcounty_otherreadonlypersonidlist_personlist,80|
field,floodinspector,Select,sfmcounty_floodinspectoridlist_input,sfmcounty_floodinspectoridlist_personlist,80|
field,groundinspector,Select,sfmcounty_groundinspectoridlist_input,sfmcounty_groundinspectoridlist_personlist,80",
        "person_id",
        "active",
        "sfmcountyusers,50,50,400,400","view",
        "buildfulllist"
    ); 
}

function SFM_SETUPSFMNGB_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function SFM_SETUPSFMNGB_Output() {
    $parm0 = "";
    $parm0 = $parm0."National Governing Bodies"."|"; # pagetitle
    $parm0 = $parm0."sfmngb"."|"; # primetable
    $parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
    $parm0 = $parm0."sfmngb_id|"; # keyfieldname
    $parm0 = $parm0."sfmngb_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmngb_id|Yes|League Id|120|Yes|League Id|KeyText,25,25^";
    $parm1 = $parm1."sfmngb_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmngb_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    $parm1 = $parm1."sfmngb_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmngb_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmngb_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmngb_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmngb_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";     
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "other,person_domainid|person_id|person_sname|person_fname",
        "person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40",
        "field,administrator,Select,sfmngb_adminpersonid_input,sfmngb_adminpersonid_personlist,80|
field,otheradministrator,Select,sfmngb_otheradminpersonidlist_input,sfmngb_otheradminpersonidlist_personlist,80|
field,otherreadonly,Select,sfmngb_otherreadonlypersonidlist_input,sfmngb_otherreadonlypersonidlist_personlist,80|
field,floodinspector,Select,sfmngb_floodinspectoridlist_input,sfmngb_floodinspectoridlist_personlist,80|
field,groundinspector,Select,sfmngb_groundinspectoridlist_input,sfmngb_groundinspectoridlist_personlist,80",
        "person_id",
        "active",
        "sfmngbusers,50,50,400,400","view",
        "buildfulllist"
    ); 
}

function SFM_SETUPSFMPITCH_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMPITCH_Output() {
	$parm0 = "";
	$parm0 = $parm0."Pitch Types"."|"; # pagetitle
	$parm0 = $parm0."sfmpitchtype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmpitchtype_id|"; # keyfieldname
	$parm0 = $parm0."sfmpitchtype_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmpitchtype_id|Yes|Pitch Type|120|Yes|Pitch Type|KeyText,12,12^";
	$parm1 = $parm1."sfmpitchtype_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."sfmpitchtype_description||||Yes|Description|InputText,100,200^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMPITCHMANUFACTURER_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMPITCHMANUFACTURER_Output() {
	$parm0 = "";
	$parm0 = $parm0."Pitch Manufacturers"."|"; # pagetitle
	$parm0 = $parm0."sfmpitchmanufacturer"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmpitchmanufacturer_id|"; # keyfieldname
	$parm0 = $parm0."sfmpitchmanufacturer_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmpitchmanufacturer_id|Yes|Supplier Id|120|Yes|Supplier Id|KeyText,12,12^";
	$parm1 = $parm1."sfmpitchmanufacturer_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMPITCHCONTRACTOR_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMPITCHCONTRACTOR_Output() {
	$parm0 = "";
	$parm0 = $parm0."Pitch Contractors"."|"; # pagetitle
	$parm0 = $parm0."sfmpitchcontractor"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmpitchcontractor_id|"; # keyfieldname
	$parm0 = $parm0."sfmpitchcontractor_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmpitchcontractor_id|Yes|Installer Id|120|Yes|Installer Id|KeyText,12,12^";
	$parm1 = $parm1."sfmpitchcontractor_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTGROUNDTYPE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMFLOODLIGHTGROUNDTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Floodlight Ground Types"."|"; # pagetitle
	$parm0 = $parm0."sfmfloodlightgroundtype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmfloodlightgroundtype_id|"; # keyfieldname
	$parm0 = $parm0."sfmfloodlightgroundtype_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmfloodlightgroundtype_id|Yes|Ground Type|120|Yes|Ground Type|KeyText,12,12^";
	$parm1 = $parm1."sfmfloodlightgroundtype_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."sfmfloodlightgroundtype_description||||Yes|Description|InputText,100,200^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTBASETYPE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMFLOODLIGHTBASETYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Floodlight Base Types"."|"; # pagetitle
	$parm0 = $parm0."sfmfloodlightbasetype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmfloodlightbasetype_id|"; # keyfieldname
	$parm0 = $parm0."sfmfloodlightbasetype_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmfloodlightbasetype_id|Yes|Base Type|120|Yes|Base Type|KeyText,12,12^";
	$parm1 = $parm1."sfmfloodlightbasetype_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."sfmfloodlightbasetype_description||||Yes|Description|InputText,100,200^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTCOLUMNTYPE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMFLOODLIGHTCOLUMNTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Floodlight Column Types"."|"; # pagetitle
	$parm0 = $parm0."sfmfloodlightcolumntype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmfloodlightcolumntype_id|"; # keyfieldname
	$parm0 = $parm0."sfmfloodlightcolumntype_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmfloodlightcolumntype_id|Yes|Column Type|120|Yes|Column Type|KeyText,12,12^";
	$parm1 = $parm1."sfmfloodlightcolumntype_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."sfmfloodlightcolumntype_description||||Yes|Description|InputText,100,200^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTBALLASTTYPE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMFLOODLIGHTBALLASTTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Floodlight Ballast Types"."|"; # pagetitle
	$parm0 = $parm0."sfmfloodlightballasttype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmfloodlightballasttype_id|"; # keyfieldname
	$parm0 = $parm0."sfmfloodlightballasttype_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmfloodlightballasttype_id|Yes|Ballast Type|120|Yes|Ballast Type|KeyText,12,12^";
	$parm1 = $parm1."sfmfloodlightballasttype_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."sfmfloodlightballasttype_description||||Yes|Description|InputText,100,200^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTCAPACITORTYPE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;
}

function SFM_SETUPSFMFLOODLIGHTCAPACITORTYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Floodlight Condenser Types"."|"; # pagetitle
    $parm0 = $parm0."sfmfloodlightcapacitortype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."sfmfloodlightcapacitortype_id|"; # keyfieldname
    $parm0 = $parm0."sfmfloodlightcapacitortype_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmfloodlightcapacitortype_id|Yes|Condenser Type|120|Yes|Condenser Type|KeyText,12,12^";
    $parm1 = $parm1."sfmfloodlightcapacitortype_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmfloodlightcapacitortype_description||||Yes|Description|InputText,100,200^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTLAMPTYPE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;
}

function SFM_SETUPSFMFLOODLIGHTLAMPTYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Floodlight Lamp Types"."|"; # pagetitle
    $parm0 = $parm0."sfmfloodlightlamptype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."sfmfloodlightlamptype_id|"; # keyfieldname
    $parm0 = $parm0."sfmfloodlightlamptype_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmfloodlightlamptype_id|Yes|Lamp Type|120|Yes|Lamp Type|KeyText,12,12^";
    $parm1 = $parm1."sfmfloodlightlamptype_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmfloodlightlamptype_description||||Yes|Description|InputText,100,200^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTFIXTURETYPE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;
}

function SFM_SETUPSFMFLOODLIGHTFIXTURETYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Floodlight Fixture Types"."|"; # pagetitle
    $parm0 = $parm0."sfmfloodlightdressingroomtype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."sfmfloodlightfixturetype_id|"; # keyfieldname
    $parm0 = $parm0."sfmfloodlightfixturetype_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmfloodlightfixturetype_id|Yes|Fixture Type|120|Yes|Fixture Type|KeyText,12,12^";
    $parm1 = $parm1."sfmfloodlightfixturetype_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmfloodlightfixturetype_description||||Yes|Description|InputText,100,200^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTIGNITERTYPE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMFLOODLIGHTIGNITERTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Floodlight Igniter Types"."|"; # pagetitle
	$parm0 = $parm0."sfmfloodlightignitertype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmfloodlightignitertype_id|"; # keyfieldname
	$parm0 = $parm0."sfmfloodlightignitertype_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmfloodlightignitertype_id|Yes|Igniter Type|120|Yes|Igniter Type|KeyText,12,12^";
	$parm1 = $parm1."sfmfloodlightignitertype_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."sfmfloodlightignitertype_description||||Yes|Description|InputText,100,200^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTMANUFACTURER_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMFLOODLIGHTMANUFACTURER_Output() {
	$parm0 = "";
	$parm0 = $parm0."Floodlight Manufacturers"."|"; # pagetitle
	$parm0 = $parm0."sfmfloodlightmanufacturer"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmfloodlightmanufacturer_id|"; # keyfieldname
	$parm0 = $parm0."sfmfloodlightmanufacturer_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmfloodlightmanufacturer_id|Yes|Manufacturer Id|120|Yes|Supplier Id|KeyText,12,12^";
	$parm1 = $parm1."sfmfloodlightmanufacturer_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTCONTRACTOR_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;	
}

function SFM_SETUPSFMFLOODLIGHTCONTRACTOR_Output() {
	$parm0 = "";
	$parm0 = $parm0."Floodlight Contractors"."|"; # pagetitle
	$parm0 = $parm0."sfmfloodlightcontractor"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."sfmfloodlightcontractor_id|"; # keyfieldname
	$parm0 = $parm0."sfmfloodlightcontractor_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmfloodlightcontractor_id|Yes|Installer Id|120|Yes|Installer Id|KeyText,12,12^";
	$parm1 = $parm1."sfmfloodlightcontractor_name|Yes|Name|150|Yes|Name|InputText,50,100^";	
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMVISITTYPE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;
}

function SFM_SETUPSFMVISITTYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Visit Type"."|"; # pagetitle
    $parm0 = $parm0."sfmvisittype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."sfmvisittype_id|"; # keyfieldname
    $parm0 = $parm0."sfmvisittype_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmvisittype_id|Yes|Visit Type|120|Yes|Visit Type|KeyText,12,12^";
    $parm1 = $parm1."sfmvisittype_title|Yes|Title|150|Yes|Title|InputText,50,100^";
    $parm1 = $parm1."sfmvisittype_description||||Yes|Description|InputText,100,200^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMRECTIFICATIONTYPE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;
}

function SFM_SETUPSFMRECTIFICATIONTYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Rectification Type"."|"; # pagetitle
    $parm0 = $parm0."sfmrectificationtype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."sfmrectificationtype_id|"; # keyfieldname
    $parm0 = $parm0."sfmrectificationtype_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmrectificationtype_id|Yes|Visit Type|120|Yes|Rectification Type|KeyText,12,12^";
    $parm1 = $parm1."sfmrectificationtype_title|Yes|Title|150|Yes|Title|InputText,50,100^";
    $parm1 = $parm1."sfmrectificationtype_description||||Yes|Description|InputText,100,200^";    
    $parm1 = $parm1."sfmrectificationtype_costbanda|Yes|Cost A|150|Yes|Cost A|InputText,10,20^";
    $parm1 = $parm1."sfmrectificationtype_costbandb|Yes|Cost B|150|Yes|Cost B|InputText,10,20^";
    $parm1 = $parm1."sfmrectificationtype_costbandc|Yes|Cost C|150|Yes|Cost C|InputText,10,20^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMREVIEWCONDITIONS_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";;
}

function SFM_SETUPSFMREVIEWCONDITIONS_Output() {
    $parm0 = "";
    $parm0 = $parm0."Review Conditions"."|"; # pagetitle
    $parm0 = $parm0."sfmreviewconditions"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."sfmreviewconditions_id|"; # keyfieldname
    $parm0 = $parm0."sfmreviewconditions_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmreviewconditions_id|Yes|Lamp Type|120|Yes|Lamp Type|KeyText,12,12^";
    $parm1 = $parm1."sfmreviewconditions_title|Yes|Title|150|Yes|Title|InputText,50,100^";
    $parm1 = $parm1."sfmreviewconditions_description||||Yes|Description|InputText,100,200^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFLOODLIGHTMETER_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,dropzonebasicfilepopup,jqdatatablesmin,jqueryconfirm";	
}

function SFM_SETUPSFMFLOODLIGHTMETER_Output() {
	$parm0 = "";
	$parm0 = $parm0."Floodlight Meters"."|"; # pagetitle
	$parm0 = $parm0."sfmfloodlightmeter"."|"; # primetable
	$parm0 = $parm0."sfmcompany|"; # othertables
	$parm0 = $parm0."sfmfloodlightmeter_serialno|"; # keyfieldname
	$parm0 = $parm0."sfmfloodlightmeter_serialno|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."sfmfloodlightmeter_serialno|Yes|Light Meter Serial Nn|120|Yes|Light Meter Serial No|KeyText,12,25^";
	$parm1 = $parm1."sfmfloodlightmeter_type|Yes|Type|150|Yes|Type|InputText,50,100^";
	$parm1 = $parm1."sfmfloodlightmeter_description||||Yes|Description|InputText,100,200^";
	$parm1 = $parm1."sfmfloodlightmeter_calibrationdate||||Yes|Calibration Date|InputDate^";
	$parm1 = $parm1."sfmfloodlightmeter_calibrationcertificate|Yes|Certificate|70|Yes|Certificate|InputFile,GLOBALDOMAINWWWPATH/domain_temp,GLOBALDOMAINFILEPATH/assets,LightmeterCertificate,sfmfloodlightmeter_serialno^";
	$parm1 = $parm1."sfmfloodlightmeter_personid|Yes|PersonId|70|Yes|PersonId|InputText,8,8^";
	$parm1 = $parm1."sfmfloodlightmeter_companyid||||Yes|Company|InputSelectFromTable,sfmcompany,sfmcompany_id,sfmcompany_name,sfmcompany_id^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMCOMPANY_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,dropzonebasicfilepopup,jqdatatablesmin,jqueryconfirm";
}

function SFM_SETUPSFMCOMPANY_Output() {
    $parm0 = "";
    $parm0 = $parm0."Companies"."|"; # pagetitle
    $parm0 = $parm0."sfmcompany"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."sfmcompany_id|"; # keyfieldname
    $parm0 = $parm0."sfmcompany_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmcompany_id|Yes|Company|120|Yes|Company|KeyText,20,25^";
    $parm1 = $parm1."sfmcompany_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmcompany_contactfname|Contact First Name|Type|150|Yes|Contact First Name|InputText,50,100^";
    $parm1 = $parm1."sfmcompany_contactsname|Yes|Contact Last Name|150|Yes|Contact Last Name|InputText,50,100^";
    $parm1 = $parm1."sfmcompany_contactemail|Yes|Email|150|Yes|Email|InputText,50,100^";
    $parm1 = $parm1."sfmcompany_contactworktel|Yes|Tel|150|Yes|Telephone|InputText,50,100^";
    $parm1 = $parm1."sfmcompany_addr1||||Yes|Address 1|InputText,50,100^";
    $parm1 = $parm1."sfmcompany_addr2||||Yes|Address 2|InputText,50,100^";
    $parm1 = $parm1."sfmcompany_addr3||||Yes|Address 3|InputText,50,100^";
    $parm1 = $parm1."sfmcompany_addr4||||Yes|Address 4|InputText,50,100^";
    $parm1 = $parm1."sfmcompany_postcode||||Yes|Post Code|InputText,50,100^";
    // $parm1 = $parm1."sfmcompany_logo||||Yes|Logo|InputText,50,100^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SFMSETLIST_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function SFM_SFMSETLIST_Output() {
    XH2("Sports Facilities Management"); 
    Get_Person_Authority();
    $selectedcount = 0;
    $selectedleaguea = Array();
    $sfmcluba = Get_Array('sfmclub');	
    foreach ($sfmcluba as $sfmclub_id) {
        Get_Data('sfmclub',$sfmclub_id);
        $selected = "0";     

        if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmclub_adminpersonid'}) ) {
           $selected = "1"; $selectedcount++;
        }     
        if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmclub_otheradminpersonidlist'}) ) {
           $selected = "1"; $selectedcount++;
        }           
        if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmclub_otherreadonlypersonidlist'}) ) {
           $selected = "1"; $selectedcount++;
        }              
        if ($GLOBALS{'sfmuserleague'} != "") {        
            $myleaguea = List2Array($GLOBALS{'sfmuserleague'});
            foreach ( $myleaguea as $myleague_id ) {
                if ($myleague_id != '') {
                    Check_Data('sfmleague',$myleague_id);
                    if ($GLOBALS{'IOWARNING'} == "0") { 
                        if ( FoundInCommaList($myleague_id,$GLOBALS{'sfmclub_sfmleagueid'}) ) {
                            $selected = "1"; $selectedcount++;
                        }
                    }
                }
            }
        }
 
        if ($GLOBALS{'sfmusercounty'} != "") {        
            $mycountya = List2Array($GLOBALS{'sfmusercounty'});
            foreach ( $mycountya as $mycounty_id ) {
                if ($mycounty_id != '') {
                    Check_Data('sfmcounty',$mycounty_id);
                    if ($GLOBALS{'IOWARNING'} == "0") { 
                        if ( FoundInCommaList($mycounty_id,$GLOBALS{'sfmclub_sfmcountyid'}) ) {
                            $selected = "1"; $selectedcount++;
                        }
                    }
                }
            }
        }
        
        if ($GLOBALS{'sfmuserngb'} != "") {        
            $selected = "1"; $selectedcount++;
        }        
        
        if ($GLOBALS{'sfmuserset'} != "") {        
            $myseta = List2Array($GLOBALS{'sfmuserset'});
            foreach ( $myseta as $myset_id ) {
                if ($myset_id != '') {
                    Check_Data('sfmset',$myset_id);
                    if ($GLOBALS{'IOWARNING'} == "0") { 
                        if ( FoundInCommaList($myset_id,$GLOBALS{'sfmclub_sfmsetid'}) ) {
                            $selected = "1"; $selectedcount++;
                        }
                    }
                }
            }
        }
        
        // $selected = "1"; 
    
        if ($selected == "1") {
            if ($GLOBALS{'sfmclub_sfmleagueid'} != "") {
                // XPTXT($GLOBALS{'sfmuserleague'}.":".$GLOBALS{'sfmclub_sfmleagueid'});
                if (in_array($GLOBALS{'sfmclub_sfmleagueid'}, $selectedleaguea)) {} else {
                    array_push($selectedleaguea,$GLOBALS{'sfmclub_sfmleagueid'});
                }
            }
        }
    } 
    sort($selectedleaguea);
    // print_r ($selectedleaguea) ;
    
    XBR();XBR();
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("League Name");
    XTDHTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");

    foreach($selectedleaguea as $sfmleague_id) { 
        Check_Data('sfmleague',$sfmleague_id);
        if ($GLOBALS{'IOWARNING'} == "0") { 
            XTRJQDT();
            XTDTXT($GLOBALS{'sfmleague_name'});		
            $link = YPGMLINK("sfmclublistout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("sfmleague_id",$sfmleague_id);
            XTDLINKTXT($link,"select");	
            X_TR();	
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();    
}

function SFM_SFMCLUBLIST_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function SFM_SFMCLUBLIST_Output($sfmleague_id) {
	Get_Data('sfmleague',$sfmleague_id);
        XH2("Sports Facilities Management - ".$GLOBALS{'sfmleague_name'});
	XBR();XBR();
	XDIV("reportdiv","container");
	XTABLEJQDTID("reporttable_list");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Club Ref");
	XTDHTXT("Club Name");
	XTDHTXT("");
	X_TR();
	X_THEAD();
	XTBODY();
	XINHID("list_sortcol","0");

	$sfmcluba = Get_Array('sfmclub');	
	foreach ($sfmcluba as $sfmclub_id) {
            Get_Data('sfmclub',$sfmclub_id);
            if ($GLOBALS{'sfmclub_sfmleagueid'} == $sfmleague_id) {
                XTRJQDT();
                XTDTXT($sfmclub_id);
                XTDTXT($GLOBALS{'sfmclub_name'});		
                $link = YPGMLINK("sfmclubupdateout.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id);
                XTDLINKTXT($link,"select");	
                X_TR();
            }    
	}
	X_TBODY();
	X_TABLE();
	X_DIV("reportdiv");
	XCLEARFLOAT();
}

function SFM_SFMCLUBUPDATE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jqdatatables,jqueryconfirm,sfmclubupdate";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,sfmclubupdate,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm,jqdatatablesmin,areyousure";
}

function SFM_SFMCLUBUPDATE_Output($sfmclub_id,$currenttab) {
    
    $GLOBALS{'sfmlevel'} = 4;

    if ($sfmclub_id == "new") {
        Initialise_Data('sfmclub');
        $sfmdefaultvaluea = Get_Array('sfmdefaultvalue');
        foreach ($sfmdefaultvaluea as $sfmdefaultvalue_fieldname) {
            Get_Data('sfmdefaultvalue',$sfmdefaultvalue_fieldname);
            $GLOBALS{$sfmdefaultvalue_fieldname} = floatval($GLOBALS{'sfmdefaultvalue_value'});
        }
        $hesfmclubngtext = "Create new club";
    } else {
        Get_Data('sfmclub', $sfmclub_id);
        // XH2("Pitch ".$GLOBALS{'sfmclub_groundidlist'});
        Check_Data('sfmground', $GLOBALS{'sfmclub_groundidlist'});      
        $headingtext = "Club -".$GLOBALS{'sfmclub_name'}." - Ground(".$GLOBALS{'sfmground_name'}.")";
    }
    XBR();
    
    BROW();
    BCOLBOTTOM("8");
    XH3($headingtext);
    B_COL();
    $srca = $GLOBALS{'domainwwwurl'}."/domain_style/";
    $ragfound = "0"; $approvedfound = "0";
    
    BCOL("4");
    BIMG($GLOBALS{'domainwwwurl'}."/domain_media/GrassRootsLogo.png","80","1");
    BINBUTTONIDSPECIAL ("SupportButton","success","Member<br>Support");
    B_COL();
    B_ROW();
    
    $GLOBALS{'CROPPARMS'} = Array();
    
    XFORMUPLOAD("sfmclubupdatein.php","sfmclubupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmground_id",$GLOBALS{'sfmclub_groundidlist'});
    XINHID("sfmset_id",$GLOBALS{'sfmclub_sfmsetid'});
    XINHID("SubmitAction","");
    XINHID("CurrentTab",$currenttab);
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});
    XHR();
    BROW();
    BCOL("7");
    if ($GLOBALS{'sfmclub_logo'} == "" ) { BIMG("../site_assets/NoImage_Flex.png","100","1"); }
    else { BIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'sfmclub_logo'},"100","1"); }
    if ($GLOBALS{'sfmclub_image1'} == "" ) { BIMG("../site_assets/NoImage_Flex.png","100","1"); }
    else { BIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'sfmclub_image1'},"100","1"); }
    if ($GLOBALS{'sfmclub_image2'} == "" ) { BIMG("../site_assets/NoImage_Flex.png","100","1"); }
    else { BIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'sfmclub_image2'},"100","1"); }
    B_COL();
    BCOL("3");
    BIMGID("website","../site_assets/Website.png","50");
    BIMGID("googlemaps","../site_assets/GoogleMaps.png","50");
    BIMGID("pitchfinder","../site_assets/PitchFinder.png","50");
    if ( $GLOBALS{'sfmlevel'} > 2 ) {
        BIMGID("cloudstorage","../site_assets/CloudStorage.png","50");
    }
    BIMGID("mpdfreports","../site_assets/MPDFRelevantReports.png","50");
    
    B_COL();
    BCOL("2");
    if ( $GLOBALS{'sfmlevel'} > 2 ) {	BINBUTTONIDSPECIAL("Save","primary","Save"); }
    BINBUTTONIDSPECIAL("Close","warning","Close"); XBR(); XBR();
    B_COL();
    B_ROW();
    XBR();
    
    if ($currenttab == "") { $currenttab = "CLUB"; }
    
    BTABHEADERCONTAINER();   
    if ($currenttab=="CLUB") {BTABHEADERITEMACTIVECLASS("CLUB","Club","GRBTab");} else {BTABHEADERITEMCLASS("CLUB","Club","GRBTab");}
    if ($currenttab=="GROUNDSTATUS") {BTABHEADERITEMACTIVECLASS("GROUNDSTATUS","Ground Grading Status","FATab");} else {BTABHEADERITEMCLASS("GROUNDSTATUS","Ground","FATab");}
    // if ($currenttab=="PITCH") {BTABHEADERITEMACTIVECLASS("PITCH","Pitch","FATab");} else {BTABHEADERITEMCLASS("PITCH","Pitch","FATab");}
    if ($currenttab=="FLOODSTATUS") {BTABHEADERITEMACTIVECLASS("FLOODSTATUS","Floodlighting Status","FATab");} else {BTABHEADERITEMCLASS("FLOODSTATUS","Floodlights","FATab");}
    if ($currenttab=="GRSUPPORT") {BTABHEADERITEMACTIVECLASS("GRSUPPORT","Other Support","GRGTab");} else {BTABHEADERITEMCLASS("GRSUPPORT","Other Support","GRGTab");}
    // if ($currenttab=="CLUBPROJECTS") {BTABHEADERITEMACTIVECLASS("CLUBPROJECTS","Projects","GRGTab");} else {BTABHEADERITEMCLASS("CLUBPROJECTS","Projects","GRGTab");}
    // if ($currenttab=="CLUBINVESTMENT") {BTABHEADERITEMACTIVECLASS("CLUBINVESTMENT","Investment","GRGTab");} else {BTABHEADERITEMCLASS("CLUBINVESTMENT","Investment","GRGTab");}
    // if ($currenttab=="CLUBSPONSORSHIP") {BTABHEADERITEMACTIVECLASS("CLUBSPONSORSHIP","Sponsorship","GRGTab");} else {BTABHEADERITEMCLASS("CLUBSPONSORSHIP","Sponsorship","GRGTab");}
    // if ($currenttab=="CLUBOPERATIONS") {BTABHEADERITEMACTIVECLASS("CLUBUTILITIES","Operations","GRGTab");} else {BTABHEADERITEMCLASS("CLUBUTILITIES","Operations","GRGTab");}
    // if ($currenttab=="CLUBWEBSITE") {BTABHEADERITEMACTIVECLASS("CLUBWEBSITE","Website","GRGTab");} else {BTABHEADERITEMCLASS("CLUBWEBSITE","Website","GRGTab");}
    if ($currenttab=="CLUBNOTES") {BTABHEADERITEMACTIVECLASS("CLUBNOTES","Notes","GRGTab");} else {BTABHEADERITEMCLASS("CLUBNOTES","Notes","GRGTab");}
    B_TABHEADERCONTAINER();
    
    BTABCONTENTCONTAINER();
    if ($currenttab=="CLUB") {BTABCONTENTITEMACTIVE("CLUB");} else {BTABCONTENTITEM("CLUB");} CLUBNCONTACTSContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="GROUNDSTATUS") {BTABCONTENTITEMACTIVE("GROUNDSTATUS");} else {BTABCONTENTITEM("GROUNDSTATUS");} GROUNDSTATUSContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="PITCH") {BTABCONTENTITEMACTIVE("PITCH");} else {BTABCONTENTITEM("PITCH");} PITCHContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="FLOODSTATUS") {BTABCONTENTITEMACTIVE("FLOODSTATUS");} else {BTABCONTENTITEM("FLOODSTATUS");} FLOODSTATUSContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="GRSUPPORT") {BTABCONTENTITEMACTIVE("GRSUPPORT");} else {BTABCONTENTITEM("GRSUPPORT");} GRSUPPORTContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="CLUBPROJECTS") {BTABCONTENTITEMACTIVE("CLUBPROJECTS");} else {BTABCONTENTITEM("CLUBPROJECTS");} CLUBPROJECTSContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="CLUBINVESTMENT") {BTABCONTENTITEMACTIVE("CLUBINVESTMENT");} else {BTABCONTENTITEM("CLUBINVESTMENT");} CLUBINVESTMENTContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="CLUBSPONSORSHIP") {BTABCONTENTITEMACTIVE("CLUBSPONSORSHIP");} else {BTABCONTENTITEM("CLUBSPONSORSHIP");} CLUBSPONSORSHIPContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="CLUBUTILITIES") {BTABCONTENTITEMACTIVE("CLUBUTILITIES");} else {BTABCONTENTITEM("CLUBUTILITIES");} CLUBUTILITIESContentOutput(); B_TABCONTENTITEM();    
    // if ($currenttab=="CLUBWEBSITE") {BTABCONTENTITEMACTIVE("CLUBWEBSITE");} else {BTABCONTENTITEM("CLUBWEBSITE");} CLUBWEBSITEContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="CLUBNOTES") {BTABCONTENTITEMACTIVE("CLUBNOTES");} else {BTABCONTENTITEM("CLUBNOTES");} CLUBNOTESContentOutput(); B_TABCONTENTITEM();
    B_TABCONTENTCONTAINER();
    X_FORM();
    XTXTID("TRACETEXT","");
    XDIV("updateLog","");
    X_DIV("updateLog");
    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function CLUBNCONTACTSContentOutput() {
    XBR();
    XH3("Club");
    XHRCLASS('underline');
    BROW(); BCOLTXT("Name","1"); BCOLINTXTID('sfmclub_name','sfmclub_name',$GLOBALS{'sfmclub_name'},"3"); B_ROW();    
    XBR();
    
    XH3("Chairman");
    BROW();
    BCOLTXT("Title","1"); BCOLINTXTID('sfmclub_chairmancontacttitle','sfmclub_chairmancontacttitle',$GLOBALS{'sfmclub_chairmancontacttitle'},"3");
    BCOLTXT("First Name","1"); BCOLINTXTID('sfmclub_chairmancontactfname','sfmclub_chairmancontactfname',$GLOBALS{'sfmclub_chairmancontactfname'},"3");
    BCOLTXT("Surname","1"); BCOLINTXTID('sfmclub_chairmancontactsname','sfmclub_chairmancontactsname',$GLOBALS{'sfmclub_chairmancontactsname'},"3");
    B_ROW();
    BROW();
    BCOLTXT("EMail","1"); BCOLINTXTID('sfmclub_chairmancontactemail','sfmclub_chairmancontactemail',$GLOBALS{'sfmclub_chairmancontactemail'},"3");
    BCOLTXT("Tel:","1"); BCOLINTXTID('sfmclub_chairmancontacttel','sfmclub_chairmancontacttel',$GLOBALS{'sfmclub_chairmancontacttel'},"3");
    BCOLTXT("Mobile:","1"); BCOLINTXTID('sfmclub_chairmancontactmobiletel','sfmclub_chairmancontactmobiletel',$GLOBALS{'sfmclub_chairmancontactmobiletel'},"3");
    B_ROW();
    XBR();
    
    XH3("Address");
    BROW();
    BCOL("4");BROW();BCOLTXT("Address 1","4"); BCOLINTXTID('sfmclub_addr1','sfmclub_addr1',$GLOBALS{'sfmclub_addr1'},"8");B_ROW();B_COL();
    BCOL("4");BROW();BCOLTXT("Address 2","4"); BCOLINTXTID('sfmclub_addr2','sfmclub_addr2',$GLOBALS{'sfmclub_addr2'},"8");B_ROW();B_COL();
    BCOL("4");BROW();BCOLTXT("Address 3","4"); BCOLINTXTID('sfmclub_addr3','sfmclub_addr3',$GLOBALS{'sfmclub_addr3'},"8");B_ROW();B_COL();
    B_ROW();
    BROW();
    BCOL("4");BROW();BCOLTXT("County 1","4"); BCOLINTXTID('sfmclub_addr4','sfmclub_addr4',$GLOBALS{'sfmclub_addr4'},"8");B_ROW();B_COL();
    BCOL("4");BROW();BCOLTXT("Post Code 2","4"); BCOLINTXTID('sfmclub_postcode','sfmclub_postcode',$GLOBALS{'sfmclub_postcode'},"8");B_ROW();B_COL();
    B_ROW();
    
    XBR();
    BROW();
    BCOLTXT("Club Website","2");
    BCOLINTXTID("sfmclub_website","sfmclub_website",$GLOBALS{'sfmclub_website'},"10");
    B_ROW();
    BROW();
    BCOLTXT("GoogleMaps Link","2");
    BCOLINTXTID("sfmclub_googlemapslink","sfmclub_googlemapslink",$GLOBALS{'sfmclub_googlemapslink'},"10");
    B_ROW();
    BROW();
    BCOLTXT("PitchFinder Link","2");
    BCOLINTXTID("sfmclub_pitchfinderlink","sfmclub_pitchfinderlink",$GLOBALS{'sfmclub_pitchfinderlink'},"10");
    B_ROW();
    
    BROW();
    BCOL("4");
    XHR();
    XH3("Club Logo");
    XBR();
    XINHID("sfmclub_logo",$GLOBALS{'sfmclub_logo'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmclub_logo";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmclub_logo'};
    $imageuploadto = "Club";
    $imageuploadid = $GLOBALS{'sfmclub_id'}."Logo";
    $imageuploadwidth = "300";
    $imageuploadheight = "300";
    $imageuploadfixedsize = "300x300";
    $imagethumbwidth = "300";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    B_COL();
    B_ROW();
    
    XHR();
    XH3("Images");
    BROW();
    BCOL("6");
    if ( $GLOBALS{'sfmclub_image1title'} == "" ) { $GLOBALS{'sfmclub_image1title'} = "General View"; }
    BROW(); BCOLINTXTID('sfmclub_image1title','sfmclub_image1title',$GLOBALS{'sfmclub_image1title'},"4"); BCOLTXT("Caption","2"); B_ROW();
    XBR();
    XINHID("sfmclub_image1",$GLOBALS{'sfmclub_image1'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmclub_image1";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmclub_image1'};
    $imageuploadto = "Club";
    $imageuploadid = $GLOBALS{'sfmclub_id'}."Image1";
    $imageuploadwidth = "800";
    $imageuploadheight = "500";
    $imageuploadfixedsize = "800x500";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    B_COL();
    BCOL("6");
    if ( $GLOBALS{'sfmclub_image2title'} == "" ) { $GLOBALS{'sfmclub_image2title'} = "Pitch View"; }
    BROW(); BCOLINTXTID('sfmclub_image2title','sfmclub_image2title',$GLOBALS{'sfmclub_image2title'},"4"); BCOLTXT("Caption","2"); B_ROW();
    XBR();
    XINHID("sfmclub_image2",$GLOBALS{'sfmclub_image2'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmclub_image2";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmclub_image2'};
    $imageuploadto = "Club";
    $imageuploadid = $GLOBALS{'sfmclub_id'}."Image2";
    $imageuploadwidth = "800";
    $imageuploadheight = "500";
    $imageuploadfixedsize = "800x500";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    B_COL();
    B_ROW();
    XBR();
    XH3("Other Contacts");
    XHRCLASS('underline');
    XBR();
    XH4("Secretary");
    BROW();
    BCOLTXT("Title","1"); BCOLINTXTID('sfmclub_secretarycontacttitle','sfmclub_secretarycontacttitle',$GLOBALS{'sfmclub_secretarycontacttitle'},"3");
    BCOLTXT("First Name","1"); BCOLINTXTID('sfmclub_secretarycontactfname','sfmclub_secretarycontactfname',$GLOBALS{'sfmclub_secretarycontactfname'},"3");
    BCOLTXT("Surname","1"); BCOLINTXTID('sfmclub_secretarycontactsname','sfmclub_secretarycontactsname',$GLOBALS{'sfmclub_secretarycontactsname'},"3");
    B_ROW();
    BROW();
    BCOLTXT("EMail","1"); BCOLINTXTID('sfmclub_secretarycontactemail','sfmclub_secretarycontactemail',$GLOBALS{'sfmclub_secretarycontactemail'},"3");
    BCOLTXT("Tel:","1"); BCOLINTXTID('sfmclub_secretarycontacttel','sfmclub_secretarycontacttel',$GLOBALS{'sfmclub_secretarycontacttel'},"3");
    BCOLTXT("Mobile:","1"); BCOLINTXTID('sfmclub_secretarycontactmobiletel','sfmclub_secretarycontactmobiletel',$GLOBALS{'sfmclub_secretarycontactmobiletel'},"3");
    B_ROW();
    XHR();
    XH4("Ground Contact");
    BROW();
    BCOLTXT("Title","1"); BCOLINTXTID('sfmclub_groundcontacttitle','sfmclub_groundcontacttitle',$GLOBALS{'sfmclub_groundcontacttitle'},"3");
    BCOLTXT("First Name","1"); BCOLINTXTID('sfmclub_groundcontactfname','sfmclub_groundcontactfname',$GLOBALS{'sfmclub_groundcontactfname'},"3");
    BCOLTXT("Surname","1"); BCOLINTXTID('sfmclub_groundcontactsname','sfmclub_groundcontactsname',$GLOBALS{'sfmclub_groundcontactsname'},"3");
    B_ROW();
    BROW();
    BCOLTXT("EMail","1"); BCOLINTXTID('sfmclub_groundcontactemail','sfmclub_groundcontactemail',$GLOBALS{'sfmclub_groundcontactemail'},"3");
    BCOLTXT("Tel:","1"); BCOLINTXTID('sfmclub_groundcontacttel','sfmclub_groundcontacttel',$GLOBALS{'sfmclub_groundcontacttel'},"3");
    BCOLTXT("Mobile:","1"); BCOLINTXTID('sfmclub_groundcontactmobiletel','sfmclub_groundcontactmobiletel',$GLOBALS{'sfmclub_groundcontactmobiletel'},"3");
    B_ROW();
    XHR();
    XH4("Contact Notes");
    BROW();
    BCOLINTEXTAREAID ('sfmclub_contactnotes','sfmclub_contactnotes',$GLOBALS{'sfmclub_contactnotes'},"20","8");
    B_ROW();
    XBR();
    XH3("Access");
    XHRCLASS('underline');
    XBR();
    BROWEQH();
    BCOLTXT("","1");
    BCOLTXTCOLOR("<b>Id</b>","1","gray","white");
    BCOLTXTCOLOR("<b>First Name</b>","2","gray","white");
    BCOLTXTCOLOR("<b>Last Name</b>","2","gray","white");
    BCOLTXTCOLOR("<b>eMail</b>","3","gray","white");
    BCOLTXTCOLOR("<b>Access</b>","2","gray","white");
    BCOL("1"); BINBUTTONIDSPECIAL('sfmclubperson_add_new',"success","+"); B_COL();
    B_ROW();
    
    $clubpersonadmina = List2Array($GLOBALS{'sfmclub_admininstratorpersonidlist'});
    $clubpersonreadonlya = List2Array($GLOBALS{'sfmclub_readonlypersonidlist'});
    $clubpersona = array_merge($clubpersonadmina, $clubpersonreadonlya);
    foreach ($clubpersona as $person_id) {
        Check_Data('person',$person_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            BROW();
            XINHID('sfmclubperson_startfield_'.$person_id,"");
            BCOLTXT("","1");
            BCOLTXTID('sfmclubperson_personid_'.$person_id,$person_id,"1");
            BCOLINTXTID('sfmclubperson_fname_'.$person_id,'sfmclubperson_fname_'.$person_id,$GLOBALS{'person_fname'},"2");
            BCOLINTXTID('sfmclubperson_sname_'.$person_id,'sfmclubperson_sname_'.$person_id,$GLOBALS{'person_sname'},"2");
            BCOLINTXTID('sfmclubperson_email1_'.$person_id,'sfmclubperson_email1_'.$person_id,$GLOBALS{'person_email1'},"3");
            $xhash = List2Hash("Administrator,ReadOnly");
            $currentauthority = "";
            if (in_array($person_id, $clubpersonadmina)) { $currentauthority = "Administrator"; }
            if (in_array($person_id, $clubpersonreadonlya)) { $currentauthority = "ReadOnly"; }
            BCOLINSELECTHASHID ($xhash,'sfmclubperson_authority_'.$person_id,'sfmclubperson_authority_'.$person_id,$currentauthority,"2");
            BCOL("1");
            BINBUTTONIDCLASSSPECIAL('sfmclubperson_delete_'.$person_id,"sfmclubpersondelete","danger","x");
            B_COL();
            XINHID('sfmclubperson_endfield_'.$person_id,"");
            B_ROW();
        }
    }
    XDIV("sfmclubpersonlistend","");
    X_DIV("sfmclubpersonlistend"); 
    XBR();
}

function GROUNDSTATUSContentOutput() {
    XBR();

    XH3("Ground Grading");
    XHRCLASS('underline');
    BROW();
    BCOL("4"); BINBUTTONIDSPECIAL("GroundGrading","info","Ground Grading - Club Self Assessment"); B_COL();
    BCOLTXT("","8");
    B_ROW(); 
    XBR();
    $link = YPGMLINK("sfmgroundgradingmatrixout.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmground_id",$GLOBALS{'sfmclub_groundidlist'});
    XLINKTXT($link,"Compare against all grading levels");
    XBR();
    XH3("Current Status");
    XHR('');
    
    /*
    sfmground_gradingtarget
    sfmground_gradingachieved
    
    sfmground_lastgroundreviewdate
    sfmground_lastgroundreviewerdate
    sfmground_groundgrading
    sfmground_nexgroundreviewdate
    */
    BROW();
    BCOLTXT("Grading Achieved","1");
    $keylist = ('FAGroundGradingA,FAGroundGradingB,FAGroundGradingC,FAGroundGradingD,FAGroundGradingE,FAGroundGradingF,FAGroundGradingG,FAGroundGradingH');
    $valuelist = ('A,B,C,D,E,F,G,H');
    $xhash = Lists2Hash($keylist,$valuelist);
    BCOLINSELECTHASHID ($xhash,'sfmground_gradingachieved','sfmground_gradingachieved',$GLOBALS{'sfmground_gradingachieved'},"1");
    BCOLTXT("Grading Reqd","1");
    BCOLINSELECTHASHID ($xhash,'sfmground_gradingtarget','sfmground_gradingtarget',$GLOBALS{'sfmground_gradingtarget'},"1");
    B_ROW();
    XBR();   
    BROW();
    BCOLTXT("Last Review Date","1");
    BCOLINDATEID('sfmground_lastgroundreviewdate','sfmground_lastgroundreviewdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_lastgroundreviewdate'}),'dd/mm/yyyy',"2");
    BCOLTXT("Last Review Decision","1");
    BCOLINTXTID('sfmground_lastgroundreviewerdecision','sfmground_lastgroundreviewerdecision',$GLOBALS{'sfmground_lastgroundreviewerdecision'},"2");       
    BCOLTXT("Reviewer","1");
    BCOLINTXTID('sfmground_lastgroundreviewername','sfmground_lastgroundreviewername',$GLOBALS{'sfmground_lastgroundreviewername'},"2");
    BCOLTXT("Next Review Date","1");
    BCOLINDATEID('sfmground_nextgroundreviewdate','sfmground_nextgroundreviewdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_nextgroundreviewdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    XBR();
    BROWTOP();
    BCOLTXT("Last Review Decision Notes","1");
    BCOLINTEXTAREAID('sfmground_lastgroundreviewerdecisionnotes','sfmground_lastgroundreviewerdecisionnotes',$GLOBALS{'sfmground_lastgroundreviewerdecisionnotes'},"4","11");
    B_ROW();
    XBR();
    
    XHRCLASS('underline');
    XH3("Rectifications Outstanding");
    
    XDIV("simpletablediv_rectifications","rectificationscontainer");
    XTABLEJQDTID("simpletabletable_rectifications");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Ref");
    XTDHTXT("Result");
    XTDHTXT("Description");
    XTDHTXT("Type");
    XTDHTXT("Due Date");
    XTDHTXT("Status");
    X_TR();
    X_THEAD();
    XTBODY();
    
    $sfmrectification_ida = Get_Array("sfmrectification",$GLOBALS{'sfmclub_groundidlist'});
    foreach ($sfmrectification_ida as $sfmrectification_id) {
        Get_Data("sfmrectification",$GLOBALS{'sfmclub_groundidlist'},$sfmrectification_id);
            XTRJQDT();
            XTDTXT($GLOBALS{'sfmrectification_sourceref'});
            XTDTXT($GLOBALS{'sfmrectification_inspectionresult'});
            XTDTXT($GLOBALS{'sfmrectification_inspectioncomments'});
            XTDTXT($GLOBALS{'sfmrectification_rectificationtypeid'});
            XTDTXT($GLOBALS{'sfmrectification_duedate'});
            XTDTXT($GLOBALS{'sfmrectification_status'});
            X_TR();
    }
    
    X_TBODY();
    X_TABLE();
    // XINHID("rectifications_sortcol","0");     
    X_DIV("simpletablediv_rectifications");
    XCLEARFLOAT(); 
    
    XHRCLASS('underline');
    XH3("Current Condition");

    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Ground</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmground_dressingroomrag','rag','sfmground_dressingroomrag',$GLOBALS{'sfmground_dressingroomrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmground_dressingroomragcomments','sfmground_dressingroomragcomments',$GLOBALS{'sfmground_dressingroomragcomments'},"2","6");
    // BCOLTXT("Replacement Date","1");
    // BCOLINDATEID('sfmground_groundreplacementdate','sfmground_groundreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_groundreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Spectators</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmground_spectatorrag','rag','sfmground_spectatorrag',$GLOBALS{'sfmground_spectatorrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmground_spectatorragcomments','sfmground_spectatorragcomments',$GLOBALS{'sfmground_spectatorragcomments'},"2","6");
    // BCOLTXT("Replacement Date","1");
    // BCOLINDATEID('sfmground_groundreplacementdate','sfmground_groundreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_groundreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Dressing Rooms</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmground_dressingroomrag','rag','sfmground_dressingroomrag',$GLOBALS{'sfmground_dressingroomrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmground_dressingroomragcomments','sfmground_dressingroomragcomments',$GLOBALS{'sfmground_dressingroomragcomments'},"2","6");
    // BCOLTXT("Replacement Date","1");
    // BCOLINDATEID('sfmground_groundreplacementdate','sfmground_groundreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_groundreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Medical</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmground_medicalrag','rag','sfmground_medicalrag',$GLOBALS{'sfmground_medicalrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmground_medicalragcomments','sfmground_medicalragcomments',$GLOBALS{'sfmground_medicalragcomments'},"2","6");
    // BCOLTXT("Replacement Date","1");
    // BCOLINDATEID('sfmground_medicalreplacementdate','sfmground_medicalreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_medicalreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();

    XBR();
    XHRCLASS('underline');
    XH3("Ground Grading Inspections");
    XBR();
    $link = YPGMLINK("sfmgroundvisitout.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'});
    $link = $link.YPGMPARM("sfmgroundvisit_sfmgroundid",$GLOBALS{'sfmground_id'}).YPGMPARM("sfmgroundvisit_id","New");
    XLINKBUTTONSPECIAL($link,"New Inspection",'primary');
    XBR();XBR();
    
    XDIV("simpletablediv_groundvisit","container");
    XTABLEJQDTID("simpletabletable_groundvisit");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Date");
    XTDHTXT("Type");
    XTDHTXT("Target");
    XTDHTXT("Reviewer");
    XTDHTXT("Decision");
    XTDHTXT("");
    XTDHTXT("");
    X_TR();
    X_THEAD();
    XTBODY();

    $sfmgroundvisita = Get_Array('sfmgroundvisit',$GLOBALS{'sfmclub_groundidlist'});
    foreach ($sfmgroundvisita as $sfmgroundvisit_id) {
        Get_Data('sfmgroundvisit',$GLOBALS{'sfmclub_groundidlist'},$sfmgroundvisit_id);
        XTRJQDT();
        XTDTXT($GLOBALS{'sfmgroundvisit_date'});
        XTDTXT($GLOBALS{'sfmgroundvisit_type'});
        XTDTXT($GLOBALS{'sfmgroundvisit_gradingtarget'});
        XTDTXT($GLOBALS{'sfmgroundvisit_reviewername'});
        XTDTXT($GLOBALS{'sfmgroundvisit_reviewerdecision'});
        $link = YPGMLINK("sfmgroundvisitout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmgroundvisit_sfmgroundid",$GLOBALS{'sfmgroundvisit_sfmgroundid'}).YPGMPARM("sfmgroundvisit_id",$sfmgroundvisit_id);
        XTDLINKTXT($link,"select");
        $link = YPGMLINK("sfmgroundvisitdeleteconfirm.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmgroundvisit_sfmgroundid",$GLOBALS{'sfmgroundvisit_sfmgroundid'}).YPGMPARM("sfmgroundvisit_id",$sfmgroundvisit_id);
        XTDLINKTXT($link,"delete");
        X_TR();
    }
    X_TBODY();
    X_TABLE();
    XINHID("groundvisit_sortcol","0");    
    X_DIV("simpletablediv_groundvisit");
    XCLEARFLOAT();
}

/*
function PITCHContentOutput() {
    XBR();
    XH3("Pitch");
    XHRCLASS('underline');
    XBR();
}
*/

function FLOODSTATUSContentOutput() {
    XBR();
    BROW();
    BCOL("2"); BINBUTTONIDSPECIAL("FloodlightSpecification","info","Floodlight Specification"); B_COL();
    B_ROW();
    XH3("Floodlighting");
    XHRCLASS('underline');
    XH3("Current Status");
    XHR('');
    
    BROW();
    BCOLTXT("Last Review Decision","1");
    BCOLINTXTIDCLASS('sfmground_lastfloodlightreviewdecision','rag','sfmground_lastfloodlightreviewdecision',$GLOBALS{'sfmground_lastfloodlightreviewdecision'},"3");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Last Review Date","1");
    BCOLINDATEID('sfmground_lastfloodlightreviewdate','sfmground_lastfloodlightreviewdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_lastfloodlightreviewdate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Inspector","1");
    BCOLINTXTID('sfmground_lastfloodlightreviewername','sfmground_lastfloodlightreviewername',$GLOBALS{'sfmground_lastfloodlightreviewername'},"3");
    BCOLTXT("Next Review Date","1");
    BCOLINDATEID('sfmground_nextfloodlightreviewdate','sfmground_nextfloodlightreviewdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_nextfloodlightreviewdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Avg Lux","1");
    BCOLINTXTID('sfmground_floodlightavglux','sfmground_floodlightavglux',$GLOBALS{'sfmground_floodlightavglux'},"3");
    BCOLTXT("Avg Lux Reqd","1");
    BCOLINTXTID('sfmground_floodlightavgluxreqd','sfmground_floodlightavgluxreqd',$GLOBALS{'sfmground_floodlightavgluxreqd'},"3");
    BCOLTXT("Lamps not working","1");
    BCOLINTXTID('sfmground_floodlightlampnotworking','sfmground_floodlightlampnotworking',$GLOBALS{'sfmground_floodlightlampnotworking'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Min Lux","1");
    BCOLINTXTID('sfmground_floodlightminlux','sfmground_floodlightminlux',$GLOBALS{'sfmground_floodlightminlux'},"3");
    BCOLTXT("Max Lux","1");
    BCOLINTXTID('sfmground_floodlightmaxlux','sfmground_floodlightmaxlux',$GLOBALS{'sfmground_floodlightmaxlux'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Min / Max","1");
    BCOLINTXTID('sfmground_floodlightminmaxlux','sfmground_floodlightminmaxlux',$GLOBALS{'sfmground_floodlightminmaxlux'},"3");
    BCOLTXT("Min / Max Reqd","1");
    BCOLINTXTID('sfmground_floodlightminmaxluxreqd','sfmground_floodlightminmaxluxreqd',$GLOBALS{'sfmground_floodlightminmaxluxreqd'},"3");
    BCOLTXT("Min / Avg","1");
    BCOLINTXTID('sfmground_floodlightminavglux','sfmground_floodlightminavglux',$GLOBALS{'sfmground_floodlightminavglux'},"3");
    B_ROW();
    BROWTOP();
    BCOLTXT("Lighting Comments/Actions","1");
    BCOLINTEXTAREAID('sfmground_floodlightluxcomments','sfmground_floodlightluxcomments',$GLOBALS{'sfmground_floodlightluxcomments'},"4","11");
    B_ROW();
    BROWTOP();
    BCOLTXT("Condition Comments/Actions","1");
    BCOLINTEXTAREAID('sfmground_floodlightconditioncomments','sfmground_floodlightconditioncomments',$GLOBALS{'sfmground_floodlightconditioncomments'},"4","11");
    B_ROW();
    XBR();
    
    XHR();
    XH3("Current Condition and Replacement Projection");
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Columns</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmground_floodlightcolumnrag','rag','sfmground_floodlightcolumnrag',$GLOBALS{'sfmground_floodlightcolumnrag'},"2");
    BCOLTXT("Replacement Date","1");
    BCOLINDATEID('sfmground_floodlightcolumnreplacementdate','sfmground_floodlightcolumnreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_floodlightcolumnreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Fixtures</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmground_floodlightfixturerag','rag','sfmground_floodlightfixturerag',$GLOBALS{'sfmground_floodlightfixturerag'},"2");
    BCOLTXT("Replacement Date","1");
    BCOLINDATEID('sfmground_floodlightfixturereplacementdate','sfmground_floodlightfixturereplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_floodlightfixturereplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Electrics</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmground_floodlightelectricsrag','rag','sfmground_floodlightelectricsrag',$GLOBALS{'sfmground_floodlightelectricsrag'},"2");
    BCOLTXT("Replacement Date","1");
    BCOLINDATEID('sfmground_floodlightelectricsreplacementdate','sfmground_floodlightelectricsreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmground_floodlightelectricsreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Spillage</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmground_floodlightspillluxrag','rag','sfmground_floodlightspillluxrag',$GLOBALS{'sfmground_floodlightspillluxrag'},"2");
    B_ROW();   
    XBR();
    XH3("Floodlight Inspections and Maintenance");
    XHRCLASS('underline'); 
    
    XBR();
    $link = YPGMLINK("sfmfloodlightvisitout.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'});
    $link = $link.YPGMPARM("sfmfloodlightvisit_sfmgroundid",$GLOBALS{'sfmground_id'}).YPGMPARM("sfmfloodlightvisit_id","New");
    XLINKBUTTONSPECIAL($link,"New Visit",'primary');
    XBR();XBR();
    
    XDIV("simpletablediv_floodvisit","container");
    XTABLEJQDTID("simpletabletable_floodvisit");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Date");
    XTDHTXT("Type");
    XTDHTXT("Reviewer");
    XTDHTXT("Decision");
    XTDHTXT("");
    XTDHTXT("");
    X_TR();
    X_THEAD();
    XTBODY();

    
    $sfmfloodlightvisita = Get_Array('sfmfloodlightvisit',$GLOBALS{'sfmclub_groundidlist'});
    foreach ($sfmfloodlightvisita as $sfmfloodlightvisit_id) {
        Get_Data('sfmfloodlightvisit',$GLOBALS{'sfmclub_groundidlist'},$sfmfloodlightvisit_id);
        XTRJQDT();
        XTDTXT($GLOBALS{'sfmfloodlightvisit_date'});
        XTDTXT($GLOBALS{'sfmfloodlightvisit_type'});
        XTDTXT($GLOBALS{'sfmfloodlightvisit_reviewername'});
        XTDTXT($GLOBALS{'sfmfloodlightvisit_reviewerdecision'});
        $link = YPGMLINK("sfmfloodlightvisitout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmfloodlightvisit_sfmgroundid",$GLOBALS{'sfmfloodlightvisit_sfmgroundid'}).YPGMPARM("sfmfloodlightvisit_id",$sfmfloodlightvisit_id);
        XTDLINKTXT($link,"select");
        $link = YPGMLINK("sfmfloodlightvisitdeleteconfirm.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmfloodlightvisit_sfmgroundid",$GLOBALS{'sfmfloodlightvisit_sfmgroundid'}).YPGMPARM("sfmfloodlightvisit_id",$sfmfloodlightvisit_id);
        XTDLINKTXT($link,"delete");
        X_TR();
    }
    X_TBODY();
    X_TABLE();
    XINHID("floodvisit_sortcol","0");    
    X_DIV("simpletablediv_floodvisit");
    XCLEARFLOAT();
   

}

function GRSUPPORTContentOutput() {
    XBR();
    XH3("Other Grassroot Support to Clubs");
    XHRCLASS('underline');
    XBR();
}

/*
function CLUBINVESTMENTContentOutput() {
    XBR();
    XH3("Investment");
    XHRCLASS('underline');
    XBR();
}

function CLUBSPONSORSHIPContentOutput() {
    XBR();
    XH3("Sponsorship");
    XHRCLASS('underline');
    XBR();
}

function CLUBUTILITIESContentOutput() {
    XBR();
    XH3("Utilities");
    XHRCLASS('underline');
    XBR();
}

function CLUBWEBSITEContentOutput() {
    XBR();
    XH3("Website");
    XHRCLASS('underline');
    XBR();
}

function CLUBPROJECTSContentOutput() {
    XBR();
    XH3("Projects");
    XHRCLASS('underline');
    XBR();
}
*/

function CLUBNOTESContentOutput() {
    XBR();
    XH3("Notes");
    XHRCLASS('underline');
    XBR();
    BROW();
    BCOLINTEXTAREAID ('sfmclub_notes','sfmclub_notes',$GLOBALS{'sfmclub_notes'},"20","8");
    B_ROW();
    XBR();XBR();
}

function SFM_SFMGROUNDGRADING_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,accredviewlist,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,areyousure,jqueryconfirm,jqdatatablesmin,report";
}

function SFM_SFMGROUNDGRADING_Output($sfmclub_id,$sfmground_id,$reqdaccredscheme_id) {
    XH2($sfmclub_id);
    Check_Data('accredscheme',$reqdaccredscheme_id);
    $accredschemea = Get_Array('accredscheme');
    Check_Data('accredcriteria',$reqdaccredscheme_id,$sfmclub_id,"a_01");
    Library_ACCREDVIEWLIST_Output ($reqdaccredscheme_id,$sfmclub_id,"Maintain","");
    XBR();
    XHRCLASS("underline");
    XBR();
    $link = YPGMLINK("sfmgroundgradingclubsetup.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id).YPGMPARM("accredscheme_id",$reqdaccredscheme_id).YPGMPARM("mode","upgrade");
    XLINKTXT($link,"Update ".$GLOBALS{'accredscheme_name'}." to latest criteria.");  
    XBR();
    $accredschemea = Get_Array('accredscheme');
    foreach ($accredschemea as $accredscheme_id) {        
        if ($accredscheme_id != $reqdaccredscheme_id) {
            Check_Data('accredcriteria',$accredscheme_id,$sfmclub_id,"a_01");
            if ($GLOBALS{'IOWARNING'} == "0" ) {
                Check_Data('accredscheme',$accredscheme_id);
                $link = YPGMLINK("sfmgroundgradingresponsecopy.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id).YPGMPARM("accredscheme_id",$reqdaccredscheme_id).YPGMPARM("fromaccredscheme_id",$accredscheme_id);
                XBR(); XLINKTXT($link,"Copy responses from ".$GLOBALS{'accredscheme_name'}." self assessment"); 
            }
        }
    }
    XBR();XBR();
    $link = YPGMLINK("sfmgroundgradingmanage.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id);
    XLINKTXT($link,"Manage Ground Grading Self Assessments");  
}

function SFM_SFMFLOODLIGHTVISIT_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,sfmfloodlightvisitupdate,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm,jqdatatablesmin,report,areyousure";
}

function SFM_SFMFLOODLIGHTVISIT_Output($sfmclub_id,$sfmfloodlightvisit_sfmgroundid,$sfmfloodlightvisit_id,$currenttab) {
     
    $GLOBALS{'sfmlevel'} = 4;

    Get_Data('sfmclub', $sfmclub_id);
    // XH2("Pitch ".$GLOBALS{'sfmclub_groundidlist'});
    Check_Data('sfmground', $GLOBALS{'sfmclub_groundidlist'}); 
    if ( $sfmfloodlightvisit_id == "New" ) {
        Initialise_Data('sfmfloodlightvisit');
        $GLOBALS{'sfmfloodlightvisit_id'} = $GLOBALS{'currenttimestamp'};
        $GLOBALS{'sfmfloodlightvisit_type'} = "LLTBiennial";
        $GLOBALS{'sfmfloodlightvisit_date'} = $GLOBALS{'currentYYYY-MM-DD'};
        $GLOBALS{'sfmfloodlightvisit_starttime'} = $GLOBALS{'acthh'}.":".$GLOBALS{'actmm'};
        $GLOBALS{'sfmfloodlightvisit_pitchlength'} = $GLOBALS{'sfmground_pitchlength'};
        $GLOBALS{'sfmfloodlightvisit_pitchwidth'} = $GLOBALS{'sfmground_pitchwidth'};
        $GLOBALS{'sfmfloodlightvisit_columnqty'} = $GLOBALS{'sfmground_floodlightcolumnqty'};
        $GLOBALS{'sfmfloodlightvisit_columnheight'} = $GLOBALS{'sfmground_floodlightcolumnheight'};
        $GLOBALS{'sfmfloodlightvisit_columntypeid'} = $GLOBALS{'sfmground_floodlightcolumntypeid'};
        $GLOBALS{'sfmfloodlightvisit_columnmanufacturerid'} = $GLOBALS{'sfmground_floodlightcolumnmanufacturerid'};
        $GLOBALS{'sfmfloodlightvisit_columninstalldate'} = $GLOBALS{'sfmground_floodlightcolumninstalldate'};
        $GLOBALS{'sfmfloodlightvisit_fixtureqty'} = $GLOBALS{'sfmground_floodlightfixtureqty'};
        $GLOBALS{'sfmfloodlightvisit_pitchorientation'} = $GLOBALS{'sfmground_pitchorientation'};
        $GLOBALS{'sfmfloodlightvisit_dugoutposition'} = $GLOBALS{'sfmground_dugoutposition'};
        $GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'} = $GLOBALS{'sfmground_sfmpitchtypeid'};
        
        $GLOBALS{'sfmfloodlightvisit_fixturetypeid'} = $GLOBALS{'sfmground_floodlightfixturetypeid'};
        $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'} = $GLOBALS{'sfmground_floodlightfixturemanufacturerid'};
        $GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'} = $GLOBALS{'sfmground_floodlightfixtureinstalldate'};
        $GLOBALS{'sfmfloodlightvisit_lamptypeid'} = $GLOBALS{'sfmground_floodlightlamptypeid'};
        
        $GLOBALS{'sfmfloodlightvisit_gridpointinset'} = 2.5;
        $GLOBALS{'sfmfloodlightvisit_gridpointslength'} = 11;
        $GLOBALS{'sfmfloodlightvisit_gridpointswidth'} = 8;
        $GLOBALS{'sfmfloodlightvisit_targetpoints'} = 88;
        $GLOBALS{'sfmfloodlightvisit_lightmeterserialno'} = "";
        $sfmfloodlightmetera = Get_Array('sfmfloodlightmeter');
        foreach ( $sfmfloodlightmetera as $sfmfloodlightmeter_serialno ) {
            Get_Data('sfmfloodlightmeter',$sfmfloodlightmeter_serialno);
            if ( $GLOBALS{'sfmfloodlightmeter_personid'} == $GLOBALS{'LOGIN_person_id'} ) {
                $GLOBALS{'sfmfloodlightvisit_lightmeterserialno'} = $sfmfloodlightmeter_serialno;
            }
        }
        Write_Data('sfmfloodlightvisit', $sfmfloodlightvisit_sfmgroundid, $sfmfloodlightvisit_id);
    } else {
        Check_Data('sfmfloodlightvisit', $sfmfloodlightvisit_sfmgroundid, $sfmfloodlightvisit_id);
    }
    
    $headingtext = $GLOBALS{'sfmground_name'}." - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_date'});
    XH2("Floodlighting Visit - ".$headingtext);
    
    XFORMUPLOAD("sfmfloodlightvisitupdatein.php","sfmfloodlightvisitupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfloodlightvisit_sfmgroundid",$sfmfloodlightvisit_sfmgroundid);
    XINHID("sfmfloodlightvisit_id",$sfmfloodlightvisit_id);
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});
    XINHID("SubmitAction","");
    XINHID("CurrentTab",$currenttab);
    XINHID("sfmfloodlightvisit_heatmap","");
    
    $GLOBALS{'CROPPARMS'} = Array();
    
    BROW();
    BCOLTXT("","9");
    BCOL("2");
    if ( $GLOBALS{'sfmlevel'} > 2 ) {	BINBUTTONIDSPECIAL("Save","primary","Save"); }
    BINBUTTONIDSPECIAL("Close","warning","Close"); XBR(); XBR();
    B_COL();
    B_ROW();
    
    BROW();
    BCOL("2"); BINBUTTONIDSPECIAL("FloodlightSpecification","info","Floodlight Specification"); B_COL();
    BCOL("2"); BIMGID("mpdfreports","../site_assets/MPDFRelevantReports.png","50"); B_COL();
    B_ROW();
    XBR();
    if ($currenttab == "") { $currenttab = "GGRAD"; }
    BTABHEADERCONTAINER();
    if ($currenttab=="FVISIT") {BTABHEADERITEMACTIVE("FVISIT","Visit Details");} else {BTABHEADERITEM("FVISIT","Visit Details");}
    if ($currenttab=="FVISITLLTEST") {BTABHEADERITEMACTIVE("FVISITLLTEST","Light Test");} else {BTABHEADERITEM("FVISITLLTEST","Light Test");}
    if ($currenttab=="FVISITRECTIFICATION") {BTABHEADERITEMACTIVE("FVISITRECTIFICATION","Rectifications");} else {BTABHEADERITEM("FVISITRECTIFICATION","Rectifications");}
    if ($currenttab=="FVISITCONDITION") {BTABHEADERITEMACTIVE("FVISITCONDITION","Condition");} else {BTABHEADERITEM("FVISITCONDITION","Condition");}
    if ($currenttab=="FVISITIMAGES") {BTABHEADERITEMACTIVE("FVISITIMAGES","Images");} else {BTABHEADERITEM("FVISITIMAGES","Images");}
    if ($currenttab=="FVISITNOTES") {BTABHEADERITEMACTIVE("FVISITNOTES","Notes");} else {BTABHEADERITEM("FVISITNOTES","Notes");}
    B_TABHEADERCONTAINER();
    BTABCONTENTCONTAINER();
    if ($currenttab=="FVISIT") {BTABCONTENTITEMACTIVE("FVISIT");} else {BTABCONTENTITEM("FVISIT");} FVISITContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="FVISITLLTEST") {BTABCONTENTITEMACTIVE("FVISITLLTEST");} else {BTABCONTENTITEM("FVISITLLTEST");} FVISITLLTESTContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="FVISITRECTIFICATION") {BTABCONTENTITEMACTIVE("FVISITRECTIFICATION");} else {BTABCONTENTITEM("FVISITRECTIFICATION");} FVISITRECTIFICATIONContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="FVISITCONDITION") {BTABCONTENTITEMACTIVE("FVISITCONDITION");} else {BTABCONTENTITEM("FVISITCONDITION");} FVISITCONDITIONContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="FVISITIMAGES") {BTABCONTENTITEMACTIVE("FVISITIMAGES");} else {BTABCONTENTITEM("FVISITIMAGES");} FVISITIMAGESContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="FVISITNOTES") {BTABCONTENTITEMACTIVE("FVISITNOTES");} else {BTABCONTENTITEM("FVISITNOTES");} FVISITNOTESContentOutput(); B_TABCONTENTITEM();
    B_TABCONTENTCONTAINER();
    
    X_FORM();
    XTXTID("TRACETEXT","");
    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function FVISITContentOutput() {
    
    XBR();
    XH3("Floodlight Visit");
    XHRCLASS('underline');
    
    BROW();
    BCOLTXT("Review Type","1");
    $xhash = Get_SelectArrays_Hash ("sfmvisittype","sfmvisittype_id","sfmvisittype_title","sfmvisittype_id","","" );
    BCOLINSELECTHASHID ($xhash,'sfmfloodlightvisit_type','sfmfloodlightvisit_type',$GLOBALS{'sfmfloodlightvisit_type'},"3");
    BCOLTXT("Reviewer Name","1");
    BCOLINTXTID('sfmfloodlightvisit_reviewername','sfmfloodlightvisit_reviewername',$GLOBALS{'sfmfloodlightvisit_reviewername'},"3");
    BCOLTXT("Reviewer Role","1");
    BCOLINTXTID('sfmfloodlightvisit_reviewerrole','sfmfloodlightvisit_reviewerrole',$GLOBALS{'sfmfloodlightvisit_reviewerrole'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Reviewer Tel","1");
    BCOLINTXTID('sfmfloodlightvisit_reviewertel','sfmfloodlightvisit_reviewertel',$GLOBALS{'sfmfloodlightvisit_reviewertel'},"3");
    BCOLTXT("Reviewer EMail","1");
    BCOLINTXTID('sfmfloodlightvisit_revieweremail','sfmfloodlightvisit_revieweremail',$GLOBALS{'sfmfloodlightvisit_revieweremail'},"3");
    BCOLTXT("Club Rep","1");
    BCOLINTXTID('sfmfloodlightvisit_clubrepname','sfmfloodlightvisit_clubrepname',$GLOBALS{'sfmfloodlightvisit_clubrepname'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Date","1");
    BCOLINDATEID('sfmfloodlightvisit_date','sfmfloodlightvisit_date_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_date'}),'dd/mm/yyyy',"3"); 
    BCOLTXT("Start","1");
    BCOLINTXTID ("sfmfloodlightvisit_starttime","sfmfloodlightvisit_starttime",$GLOBALS{'sfmfloodlightvisit_starttime'},"3");
    BCOLTXT("Finish","1");
    BCOLINTXTID ("sfmfloodlightvisit_endtime","sfmfloodlightvisit_endtime",$GLOBALS{'sfmfloodlightvisit_endtime'},"3");
    BCOLTXT("","4");
    B_ROW();
    XHR();
    BROW();     
    BCOLTXT("Club","1");
    BCOLTXT($GLOBALS{'sfmclub_name'},"3");
    BCOLTXT("League","1");
    Check_Data("sfmleague",$GLOBALS{'sfmclub_sfmleagueid'});
    BCOLTXT($GLOBALS{'sfmleague_name'},"3");
    BCOLTXT("Pitch","1");
    BCOLTXT($GLOBALS{'sfmground_name'},"3");
    B_ROW(); 
    BROW();
    BCOLTXT("Address","1");
    BCOLTXT($GLOBALS{'sfmclub_addr1'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT($GLOBALS{'sfmclub_addr2'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT($GLOBALS{'sfmclub_addr3'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT($GLOBALS{'sfmclub_addr4'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT($GLOBALS{'sfmclub_postcode'},"3");
    BCOLTXT("","8");
    B_ROW();
    XBR();
    
    XHR();
    XH3("Approvals");
    BROW();
    BCOLTXT($GLOBALS{'sfmfloodlightvisit_reviewername'},"6");
    BCOLTXT($GLOBALS{'sfmfloodlightvisit_clubrepname'},"6");
    B_ROW();
    BROW();
    BCOLIMG ($GLOBALS{'sfmfloodlightvisit_reviewersignature'},"150","6");
    BCOLIMG ($GLOBALS{'sfmfloodlightvisit_clubrepsignature'},"150","6");
    B_ROW();
}

function FVISITLLTESTContentOutput() {
    XBR();
    XH3("Light Level Test");
    XHRCLASS('underline');
    XBR();
    
    $luxgridresultsa = Array();
    if ( $GLOBALS{'sfmfloodlightvisit_gridluxresults'} != "" ) {
        $luxgridresultsa = List2Array($GLOBALS{'sfmfloodlightvisit_gridluxresults'});
    }
    XINHIDID('sfmfloodlightvisit_gridluxresults','sfmfloodlightvisit_gridluxresults',$GLOBALS{'sfmfloodlightvisit_gridluxresults'});
    
    // else { for ($li=0; $li<=88; $li++) { array_push($luxgridresultsa,rand ( 90 , 180 )); } }
    BROW();
    BCOLTXT("Review Decision","1");
    BCOLINTXTIDCLASS('sfmfloodlightvisit_reviewerdecision','rag','sfmfloodlightvisit_reviewerdecision',$GLOBALS{'sfmfloodlightvisit_reviewerdecision'},"3");
    B_ROW();
    XHR();
  
    BROW();
    BCOLTXT("Column Qty","2");
    BCOLINTXTIDCLASS('sfmfloodlightvisit_columnqty','static','sfmfloodlightvisit_columnqty',$GLOBALS{'sfmfloodlightvisit_columnqty'},"2");
    BCOLTXT("Column Height","2");
    BCOLINTXTIDCLASS('sfmfloodlightvisit_columnheight','static','sfmfloodlightvisit_columnheight',$GLOBALS{'sfmfloodlightvisit_columnheight'},"2");
    BCOLTXT("Column Type","2");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightcolumntype","sfmfloodlightcolumntype_id","sfmfloodlightcolumntype_name","sfmfloodlightcolumntype_id","","" );
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_columntypeid','static','sfmfloodlightvisit_columntypeid',$GLOBALS{'sfmfloodlightvisit_columntypeid'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Column Manufacturer","2");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_columnmanufacturerid','static','sfmfloodlightvisit_columnmanufacturerid',$GLOBALS{'sfmfloodlightvisit_columnmanufacturerid'},"2");
    BCOLTXT("Column Install Date","2");
    BCOLINDATEIDCLASS('sfmfloodlightvisit_columninstalldate','sfmfloodlightvisit_columninstalldate_dd/mm/yyyy','static',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_columninstalldate'}),'dd/mm/yyyy',"2");
    BCOLTXT("Hoist Available","1");
    $xhash = List2Hash("Yes,No,NA");
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_columnhoistavailable','static','sfmfloodlightvisit_columnhoistavailable',$GLOBALS{'sfmfloodlightvisit_columnhoistavailable'},"2");
    B_ROW(); 
    XHR();
    BROW();
    BCOLTXT("Fixtures Qty","2");
    BCOLINTXTIDCLASS('sfmfloodlightvisit_fixtureqty','static','sfmfloodlightvisit_fixtureqty',$GLOBALS{'sfmfloodlightvisit_fixtureqty'},"2");
    BCOLTXT("Light Source","2");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightfixturetype","sfmfloodlightfixturetype_id","sfmfloodlightfixturetype_name","sfmfloodlightfixturetype_id","","" );
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_fixturetypeid','static','sfmfloodlightvisit_fixturetypeid',$GLOBALS{'sfmfloodlightvisit_fixturetypeid'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Fixtures Manufacturer","2");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_fixturemanufacturerid','static','sfmfloodlightvisit_fixturemanufacturerid',$GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'},"2");
    BCOLTXT("Fixtures Install Date","2");
    BCOLINDATEIDCLASS('sfmfloodlightvisit_fixtureinstalldate','sfmfloodlightvisit_fixtureinstalldate_dd/mm/yyyy','static',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    BCOLTXT("Wattage","2");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightlamptype","sfmfloodlightlamptype_id","sfmfloodlightlamptype_name","sfmfloodlightlamptype_id","","" );
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_lamptypeid','static','sfmfloodlightvisit_lamptypeid',$GLOBALS{'sfmfloodlightvisit_lamptypeid'},"2");
    B_ROW();
    
    XHR();
    BROW();
    BCOLTXT("Pitch Length","1");
    BCOLINTXTIDCLASS('sfmfloodlightvisit_pitchlength','static','sfmfloodlightvisit_pitchlength',$GLOBALS{'sfmfloodlightvisit_pitchlength'},"1");
    BCOLTXT("Pitch Width","1");
    BCOLINTXTIDCLASS('sfmfloodlightvisit_pitchwidth','static','sfmfloodlightvisit_pitchwidth',$GLOBALS{'sfmfloodlightvisit_pitchwidth'},"1");
    BCOLTXT("Sideline Inset","1");
    BCOLINTXTID('sfmfloodlightvisit_gridpointinset','sfmfloodlightvisit_gridpointinset',$GLOBALS{'sfmfloodlightvisit_gridpointinset'},"1");
    B_ROW();
    BROW();
    BCOLTXT("GridPoints Length","1");
    BCOLINTXTID('sfmfloodlightvisit_gridpointslength','sfmfloodlightvisit_gridpointslength',$GLOBALS{'sfmfloodlightvisit_gridpointslength'},"1");
    BCOLTXT("GridPoints Width","1");
    BCOLINTXTID('sfmfloodlightvisit_gridpointswidth','sfmfloodlightvisit_gridpointswidth',$GLOBALS{'sfmfloodlightvisit_gridpointswidth'},"1");
    BCOLTXT("GridLength","1");
    BCOLINTXTID('sfmfloodlightvisit_gridsizelength','sfmfloodlightvisit_gridsizelength',$GLOBALS{'sfmfloodlightvisit_gridsizelength'},"1");
    BCOLTXT("GridWidth","1");
    BCOLINTXTID('sfmfloodlightvisit_gridsizewidth','sfmfloodlightvisit_gridsizewidth',$GLOBALS{'sfmfloodlightvisit_gridsizewidth'},"1");
    B_ROW();
    XHR();
    
    BROW();
    BCOLTXT("Weather","1");
    $xhash = Get_SelectArrays_Hash ("sfmreviewconditions","sfmreviewconditions_id","sfmreviewconditions_title","sfmreviewconditions_id","","" );
    BCOLINSELECTHASHID ($xhash,'sfmfloodlightvisit_conditions','sfmfloodlightvisit_conditions',$GLOBALS{'sfmfloodlightvisit_conditions'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("Meter Serial No","1");
    BCOLINTXTID('sfmfloodlightvisit_lightmeterserialno','sfmfloodlightvisit_lightmeterserialno',$GLOBALS{'sfmfloodlightvisit_lightmeterserialno'},"3");
    BCOLTXT("Meter Type","1");
    BCOLTXT($GLOBALS{'sfmfloodlightvisit_lightmetertype'},"3");
    BCOLTXT("Calibration Date","1");
    BCOLTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'sfmfloodlightvisit_lightmetercalibrationdate'}),"3");
    B_ROW();
    BROW();
    BCOLTXT("","4");
    BCOLTXT("Owner","1");
    $GLOBALS{'sfmcompany_name'} = "";
    Check_Data('sfmcompany',$GLOBALS{'sfmfloodlightvisit_lightmetercompanyid'});
    BCOLTXT($GLOBALS{'sfmcompany_name'},"3");
    BCOLTXT("Expiry Date","1");
    BCOLTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'sfmfloodlightvisit_lightmeterexpirydate'}),"3");
    B_ROW();
    XHR();
    XBR();
    
    BROW();
    BCOLTXT("Dugouts","1");
    $xhash = List2Hash("Left,Right");
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_dugoutposition','static','sfmfloodlightvisit_dugoutposition',$GLOBALS{'sfmfloodlightvisit_dugoutposition'},"2");
    BCOLTXT("Orientation","1");
    $xhash = List2Hash("East,NorthEast,North,NorthWest,West");
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_pitchorientation','static','sfmfloodlightvisit_pitchorientation',$GLOBALS{'sfmfloodlightvisit_pitchorientation'},"2");
    BCOLTXT("","2");
    BCOL("2");
    if ( $GLOBALS{'sfmfloodlightvisit_pitchorientation'} == "" ) { $GLOBALS{'sfmfloodlightvisit_pitchorientation'} = "North";  }
    BIMGID("compass","../site_assets/".$GLOBALS{'sfmfloodlightvisit_pitchorientation'}.".gif","100");
    B_COL();
    B_ROW();
    XBR();
    
    /*
    BROW();
    BCOL("3");
    BINBUTTONIDSPECIALICON ("SpeechStart","success","Start","microphone");
    BINBUTTONIDSPECIALICON ("SpeechStop","danger","Stop","microphone-slash");
    XBR();
    XBR();
    BINTXTID("SpeechIn","SpeechIn","");
    B_COL();
    BCOLTXT("Orientation<BR>","3");
    $xhash = List2Hash("East,NorthEast,North,NorthWest,West");
    BCOLINSELECTHASHID ($xhash,'sfmfloodlightvisit_pitchorientation','sfmfloodlightvisit_pitchorientation',$GLOBALS{'sfmfloodlightvisit_pitchorientation'},"2");
    BCOL("2");
    if ( $GLOBALS{'sfmfloodlightvisit_pitchorientation'} == "" ) { $GLOBALS{'sfmfloodlightvisit_pitchorientation'} = "North";  }
    BIMGID("sfmfloodlightvisit_pitchorientation","../site_assets/".$GLOBALS{'sfmfloodlightvisit_pitchorientation'}.".gif","100");
    B_COL();
    B_ROW();
    XHR();
    */
    
    $pitchcol = "#A2D9CE";
    $pitchhalfcol = "#D4EFDF";
    $outercol = "#16A085";
    $outerhalfcol = "#45B39D";
    $columnmaplist = "Col1=S01B,Col2=S11B,Col3=S11A,Col4=S01A";
    if ($GLOBALS{'sfmfloodlightvisit_columnqty'} == 4) { $columnmaplist = "Col1=S01B,Col2=S11B,Col3=S11A,Col4=S01A"; }
    if ($GLOBALS{'sfmfloodlightvisit_columnqty'} == 6) { $columnmaplist = "Col1=S01B,Col2=S06B,Col3=S11B,Col4=S11A,Col5=S06A,Col6=S01A"; }
    if ($GLOBALS{'sfmfloodlightvisit_columnqty'} == 8) { $columnmaplist = "Col1=S01B,Col2=S04B,Col3=S08B,Col4=S11B,Col5=S11A,Col6=S08A,Col7=S04A,Col8=S01A"; }
    $columnmapa = Array();
    $columnmaplista = explode(',',$columnmaplist);
    foreach ($columnmaplista as $columnmaplistelement) {
        $xbits = explode("=",$columnmaplistelement);
        $columnmapa[$xbits[1]] = $xbits[0];
    }
    
    BROW();
    $icontext = '<span class="fa-stack fas" style="font-size:10px;color:white;"><i class="fa fa-circle-thin fa-stack-2x" style="color:#AED6F1;"></i><i class="fa fa-circle fa-stack-1x" style="color:#AED6F1;"></i></span></i>';
    BCOLTXTCOLOR($icontext,"1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("GOAL","1",$outercol,"white");
    BCOLTXTCOLOR("LINE","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    B_ROW();
    $li = 0;
    for ($yi=1; $yi<=11; $yi++) {
        BROW();
        BCOLTXTCOLOR("&nbsp;","1",$outercol,"white");
        for ($xi=1; $xi<=8; $xi++) {
            BCOLTXTCOLOR("&nbsp;","1",$pitchcol,"white");
        }
        BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
        B_ROW();
        /*
        BROW();
        BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
        for ($xi=1; $xi<=8; $xi++) {
            BCOLTXTCOLOR($yi.".".$xi.".xxx","1",$pitchcol,"black");
        }
        BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
        B_ROW();
        */
        BROW();
        $ys = substr(("0000".(string) $yi), -2);
        $gridyas = "S".$ys."A";
        $hash = List2Hash("Col1,Col2,Col3,Col4,Col5,Col6,Col7,Col8,Dugout");
        if ($yi == 6) {$thispcol = $pitchhalfcol; $thisocol = $outerhalfcol;}
        else {$thispcol = $pitchcol; $thisocol = $outercol;}
        BCOLBACKCOLOR($thisocol,"1");
        $value = "";
        if (array_key_exists($gridyas, $columnmapa)) {
            $value = $columnmapa[$gridyas];
        }
        BINSELECTHASHIDCLASS ($hash,$gridyas,"sidething",$gridyas,$value);
        B_COL();
        for ($xi=1; $xi<=8; $xi++) {
            $ys = substr(("0000".(string) $yi), -2);
            $xs = substr(("0000".(string) $xi), -2);
            $gridyxs = "G".$ys.$xs;            
            BCOLBACKCOLOR($thispcol,"1");
            BINTXTIDCLASS ($gridyxs,"pitchpoint",$gridyxs,$luxgridresultsa[$li]);
            $li++;
            B_COL();
        }
        $gridybs = "S".$ys."B";
        BCOLBACKCOLOR($thisocol,"1");
        $value = "";
        if (array_key_exists($gridybs, $columnmapa)) {
            $value = $columnmapa[$gridybs];
        }
        BINSELECTHASHIDCLASS ($hash,$gridybs,"sidething",$gridybs,$value);
        B_COL();
        B_ROW();
    }
    BROW();
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    for ($xi=1; $xi<=8; $xi++) {
        BCOLTXTCOLOR("&nbsp;","1",$pitchcol,"white");
    }
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    B_ROW();
    BROW();
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("GOAL","1",$outercol,"white");
    BCOLTXTCOLOR("LINE","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    BCOLTXTCOLOR("&nbsp","1",$outercol,"white");
    B_ROW();
    // XBR();
    // BINBUTTONIDSPECIALICON ("Calculate","primary","Calculate","calculator");
    
    XBR();XBR();
    BROW();
    BCOLTXT("Avg Lux","1");
    BCOLINTXTID('sfmfloodlightvisit_avglux','sfmfloodlightvisit_avglux',$GLOBALS{'sfmfloodlightvisit_avglux'},"1");
    BCOLTXT("Avg Lux Reqd","1");
    BCOLINTXTID('sfmfloodlightvisit_avgluxreqd','sfmfloodlightvisit_avgluxreqd',$GLOBALS{'sfmfloodlightvisit_avgluxreqd'},"1");
    BCOLTXT("Min Lux","1");
    BCOLINTXTID('sfmfloodlightvisit_minlux','sfmfloodlightvisit_minlux',$GLOBALS{'sfmfloodlightvisit_minlux'},"1");
    BCOLTXT("Max Lux","1");
    BCOLINTXTID('sfmfloodlightvisit_maxlux','sfmfloodlightvisit_maxlux',$GLOBALS{'sfmfloodlightvisit_maxlux'},"1");
    B_ROW();
    
    BROW();
    BCOLTXT("Min / Max","1");
    BCOLINTXTID('sfmfloodlightvisit_minmaxlux','sfmfloodlightvisit_minmaxlux',$GLOBALS{'sfmfloodlightvisit_minmaxlux'},"1");
    BCOLTXT("Min / Max Reqd","1");
    BCOLINTXTID('sfmfloodlightvisit_minmaxluxreqd','sfmfloodlightvisit_minmaxluxreqd',$GLOBALS{'sfmfloodlightvisit_minmaxluxreqd'},"1");
    BCOLTXT("Min / Avg","1");
    BCOLINTXTID('sfmfloodlightvisit_minavglux','sfmfloodlightvisit_minavglux',$GLOBALS{'sfmfloodlightvisit_minavglux'},"1");
    B_ROW();
    
    BROW();
    BCOLTXT("CV","1");
    BCOLINTXTID('sfmfloodlightvisit_cv','sfmfloodlightvisit_cv',$GLOBALS{'sfmfloodlightvisit_cv'},"1");
    BCOLTXT("Deviation","1");
    BCOLINTXTID('sfmfloodlightvisit_deviation','sfmfloodlightvisit_deviation',$GLOBALS{'sfmfloodlightvisit_deviation'},"1");
    B_ROW();
    
    
    BROW();
    BCOLTXT("Lamps not working","1");
    BCOLINTXTID('sfmfloodlightvisit_lampnotworking','sfmfloodlightvisit_lampnotworking',$GLOBALS{'sfmfloodlightvisit_lampnotworking'},"1");
    B_ROW();
    
    BROWTOP();
    BCOLTXT("Comments / Actions","1");
    BCOLINTEXTAREAID('sfmfloodlightvisit_luxcomments','sfmfloodlightvisit_luxcomments',$GLOBALS{'sfmfloodlightvisit_luxcomments'},"4","11");
    B_ROW();
    
    XBR();
    XH3("Light Map");
    XHRCLASS('underline');
    XPTXT("Average Rquirement of ".$GLOBALS{'sfmfloodlightvisit_avgluxreqd'});
    XBR();
    print '<canvas id="myCanvas" width="249" height="415"'."\n";
    print 'style="border:1px solid #c3c3c3;">'."\n";
    print '</canvas>'."\n";   
}

function FVISITRECTIFICATIONContentOutput() {
    XBR();
    BROW();
    BCOL("2");BTXT("Band");B_COL();
    BCOL("4");
    BINRADIOHASHINLINE(list2hash("A,B,C"),'sfmfloodlightvisit_reviewerrectificationcostband',$GLOBALS{'sfmfloodlightvisit_reviewerrectificationcostband'});
    B_COL();
    B_ROW();
    XBR();
    BROW();
    BCOL("2");BTXT("Required Rectifications");B_COL();
    BCOL("4");
    $xhash = Array();
    $sfmrectificationtypea = Get_Array("sfmrectificationtype");
    foreach ($sfmrectificationtypea as $sfmrectificationtype_id) {
        Get_Data("sfmrectificationtype",$sfmrectificationtype_id);
        $cost = ""; $estimatetext = "";
        if ( $GLOBALS{'sfmfloodlightvisit_reviewerrectificationcostband'} == "A") { $cost = $GLOBALS{'sfmrectificationtype_costbanda'}; }
        if ( $GLOBALS{'sfmfloodlightvisit_reviewerrectificationcostband'} == "B") { $cost = $GLOBALS{'sfmrectificationtype_costbanda'}; }
        if ( $GLOBALS{'sfmfloodlightvisit_reviewerrectificationcostband'} == "B") { $cost = $GLOBALS{'sfmrectificationtype_costbanda'}; }
        if ( $cost != "") ( $estimatetext =  " - Estimate &pound;".$cost);
        $xhash[$sfmrectificationtype_id] = $GLOBALS{'sfmrectificationtype_title'}.$estimatetext;
    }
    BINCHECKBOXHASH ($xhash,'sfmfloodlightvisit_reviewerrectificationsreqd',$GLOBALS{'sfmfloodlightvisit_reviewerrectificationsreqd'});
    B_COL();
    B_ROW();
    XBR();
}

function FVISITCONDITIONContentOutput() {
    XBR();
    XH3("Condition and Replacement Projection");
    XHRCLASS('underline');
    BROW();
    $xhash = List2Hash('Good,Fair,Poor');
    BCOLTXT("<b>General Condition</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_generalconditionrag','rag','sfmfloodlightvisit_generalconditionrag',$GLOBALS{'sfmfloodlightvisit_generalconditionrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfloodlightvisit_conditioncomments','sfmfloodlightvisit_conditioncomments',$GLOBALS{'sfmfloodlightvisit_conditioncomments'},"2","6");
    B_ROW();
    XHRCLASS('underline');
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Columns</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_columnrag','rag','sfmfloodlightvisit_columnrag',$GLOBALS{'sfmfloodlightvisit_columnrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfloodlightvisit_columnragcomments','sfmfloodlightvisit_columnragcomments',$GLOBALS{'sfmfloodlightvisit_columnragcomments'},"2","6");
    BCOLTXT("Replacement Date","1");
    BCOLINDATEID('sfmfloodlightvisit_columnreplacementdate','sfmfloodlightvisit_columnreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_columnreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Fixtures</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_fixturerag','rag','sfmfloodlightvisit_fixturerag',$GLOBALS{'sfmfloodlightvisit_fixturerag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfloodlightvisit_fixtureragcomments','sfmfloodlightvisit_fixtureragcomments',$GLOBALS{'sfmfloodlightvisit_fixtureragcomments'},"2","6");
    BCOLTXT("Replacement Date","1");
    BCOLINDATEID('sfmfloodlightvisit_fixturereplacementdate','sfmfloodlightvisit_fixturereplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_fixturereplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Electrics</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_electricsrag','rag','sfmfloodlightvisit_electricsrag',$GLOBALS{'sfmfloodlightvisit_electricsrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfloodlightvisit_electricscomments','sfmfloodlightvisit_electricsragcomments',$GLOBALS{'sfmfloodlightvisit_electricsragcomments'},"2","6");
    BCOLTXT("Replacement Date","1");
    BCOLINDATEID('sfmfloodlightvisit_electricsreplacementdate','sfmfloodlightvisit_electricsreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_electricsreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Spillage</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_spillluxrag','rag','sfmfloodlightvisit_spillluxrag',$GLOBALS{'sfmfloodlightvisit_spillluxrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfloodlightvisit_spillluxragcomments','sfmfloodlightvisit_spillluxragcomments',$GLOBALS{'sfmfloodlightvisit_spillluxragcomments'},"2","6");
    B_ROW(); 
    XBR();
    /*
    BROWTOP();
    BCOLTXT("Condition Comments/Actions","1");
    BCOLINTEXTAREAID('sfmfloodlightvisit_conditioncomments','sfmfloodlightvisit_conditioncomments',$GLOBALS{'sfmfloodlightvisit_conditioncomments'},"4","11");
    B_ROW();
    */
}

function FVISITIMAGESContentOutput() {
    if ( $GLOBALS{'sfmfloodlightvisit_image1caption'} == "" ) { $GLOBALS{'sfmfloodlightvisit_image1caption'} = "General View"; }
    /*
     BROW();
     BCOLXS("4"); BTXT('Caption');B_COL();
     BCOLXS("8"); BINTXTID('sfmfloodlightvisit_image1caption','sfmfloodlightvisit_image1caption',$GLOBALS{'sfmfloodlightvisit_image1caption'});B_COL();
     B_ROW();
     */
    XBR();
    BROW();
    BCOL("6");
    XINHID("sfmfloodlightvisit_image1",$GLOBALS{'sfmfloodlightvisit_image1'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfloodlightvisit_image1";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfloodlightvisit_image1'};
    $imageuploadto = "FloodVisit";
    $imageuploadid = $GLOBALS{'sfmfloodlightvisit_id'}."Image1";
    $imageuploadwidth = "800";
    $imageuploadheight = "500";
    $imageuploadfixedsize = "800x500";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    B_COL();
    B_ROW();
    XHR();
    if ( $GLOBALS{'sfmfloodlightvisit_image2caption'} == "" ) { $GLOBALS{'sfmfloodlightvisit_image2caption'} = "General View"; }
    /*
     BROW();
     // BCOLXS("4"); BTXT('Caption');B_COL();
     BCOLXS("8"); BINTXTID('sfmfloodlightvisit_image2caption','sfmfloodlightvisit_image2caption',$GLOBALS{'sfmfloodlightvisit_image2caption'});B_COL();
     B_ROW();
     */
    BROW();
    BCOL("6");
    XINHID("sfmfloodlightvisit_image2",$GLOBALS{'sfmfloodlightvisit_image2'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfloodlightvisit_image2";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfloodlightvisit_image2'};
    $imageuploadto = "FloodVisit";
    $imageuploadid = $GLOBALS{'sfmfloodlightvisit_id'}."Image2";
    $imageuploadwidth = "800";
    $imageuploadheight = "500";
    $imageuploadfixedsize = "800x500";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    B_COL();
    B_ROW();
}

function FVISITNOTESContentOutput() {
    XBR();
    XH3("Visit Notes");
    XHRCLASS('underline');
    XBR();
    BROW();
    BCOLINTEXTAREAID ('sfmfloodlightvisit_notes','sfmfloodlightvisit_notes',$GLOBALS{'sfmfloodlightvisit_notes'},"20","8");
    B_ROW();
    XBR();XBR();
}

function SFM_SFMFLOODLIGHTVISITDELETECONFIRM_Output($sfmclub_id,$sfmfloodlightvisit_sfmgroundid,$sfmfloodlightvisit_id) {
    Get_Data('sfmfloodlightvisit', $sfmfloodlightvisit_sfmgroundid, $sfmfloodlightvisit_id);
    XH3("Delete Floodlighting Visit - ".$sfmfloodlightvisit_sfmgroundid."/".$sfmfloodlightvisit_id);
    XPTXT("Are you sure you want to delete this visit");
    XBR();
    XFORM("sfmfloodlightvisitdeleteaction.php","deletevisit");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfloodlightvisit_sfmgroundid",$sfmfloodlightvisit_sfmgroundid);
    XINHID("sfmfloodlightvisit_id",$sfmfloodlightvisit_id);
    XINSUBMIT("Confirm Visit Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}
    
function SFM_SFMFLOODLIGHTSPECIFICATION_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,sfmfloodlightspecificationupdate,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm,jqdatatablesmin,report,areyousure";
}

function SFM_SFMFLOODLIGHTSPECIFICATION_Output($sfmclub_id,$sfmground_id) {
    
    // === Create key records if the dont exist ==================
    Check_Data('sfmground',$sfmground_id);
    Check_Data('sfmfloodlightcolumn',$sfmground_id,"0");
    if ($GLOBALS{'IOWARNING'} == "1") {
        Initialise_Data("sfmfloodlightcolumn");       
        $GLOBALS{'sfmfloodlightcolumn_qty'} =  $GLOBALS{'sfmground_floodlightcolumnqty'};
        $GLOBALS{'sfmfloodlightcolumn_fixtureqty'} =  $GLOBALS{'sfmground_floodlightfixtureqty'};
        $GLOBALS{'sfmfloodlightcolumn_columntypeid'} =  $GLOBALS{'sfmground_floodlightcolumntypeid'};
        $GLOBALS{'sfmfloodlightcolumn_columnheight'} =  $GLOBALS{'sfmground_floodlightcolumnheight'};
        Write_Data('sfmfloodlightcolumn',$sfmground_id,"0");
        XPTXTCOLOR("New Column Specification Master Record Created","green");
    }
    Check_Data('sfmfloodlightelement',$sfmground_id,"0","0");
    if ($GLOBALS{'IOWARNING'} == "1") {
        Initialise_Data("sfmfloodlightelement");
        Write_Data('sfmfloodlightelement',$sfmground_id,"0","0");
        XPTXTCOLOR("New Element Specification Master Record Created","green");
    }
    
    $GLOBALS{'sfmlevel'} = 4;
    
    XBR();
    Get_Data('sfmclub', $sfmclub_id);
    Get_Data('sfmground', $GLOBALS{'sfmclub_groundidlist'});
    
    BROW();
    BCOL("8");
    if ($GLOBALS{'sfmclub_logo'} == "" ) { BIMG("../site_assets/NoImage_Flex.png","100","1"); }
    else { BIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'sfmclub_logo'},"100","1"); }
    if ($GLOBALS{'sfmclub_image1'} == "" ) { BIMG("../site_assets/NoImage_Flex.png","100","1"); }
    else { BIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'sfmclub_image1'},"100","1"); }
    if ($GLOBALS{'sfmclub_image2'} == "" ) { BIMG("../site_assets/NoImage_Flex.png","100","1"); }
    else { BIMG($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'sfmclub_image2'},"100","1"); }
    B_COL();
    BCOLTXT("","2");
    BCOL("2");
    if ( $GLOBALS{'sfmlevel'} > 2 ) {	BINBUTTONIDSPECIAL("Save","primary","Save"); }
    BINBUTTONIDSPECIAL("Close","warning","Close"); XBR(); XBR();
    B_COL();
    B_ROW();
    XBR();
  
    XFORMUPLOAD("sfmfloodlightspecificationupdatein.php","sfmfloodlightspecificationupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmground_id",$sfmground_id);
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});
    XINHID("SubmitAction","");
    
    $GLOBALS{'CROPPARMS'} = Array();

 
    $colfixtureqtya = Array();
    $colfixtureqtya[4] = Array();
    $colfixtureqtya[6] = Array();
    $colfixtureqtya[8] = Array();
    $colfixtureqtya[4][4] = Array('','1','1','1','1');
    $colfixtureqtya[4][8] = Array('','2','2','2','2');
    $colfixtureqtya[4][12] = Array('','3','3','3','3');
    $colfixtureqtya[4][16] = Array('','4','4','4','4');
    $colfixtureqtya[4][20] = Array('','5','5','5','5');
    
    $colfixtureqtya[6][6] = Array('','1','1','1','1','1','1');
    $colfixtureqtya[4][8] = Array('','2','2','2','2','1','1');
    $colfixtureqtya[4][12] = Array('','3','3','3','3','1','1');
    $colfixtureqtya[4][16] = Array('','4','4','4','4','1','1');
    $colfixtureqtya[4][20] = Array('','5','5','5','5','1','1');
    
    $colrowa = Array();
    $colrowa[4] = Array();
    $colrowa[6] = Array();
    $colrowa[8] = Array();
    $colrowa[4][1] = Array('','4','1');
    $colrowa[4][2] = Array('','3','2');
    $colrowa[6][1] = Array('','6','1');
    $colrowa[6][2] = Array('','5','2');
    $colrowa[6][3] = Array('','4','3');
    $colrowa[6][1] = Array('','8','1');
    $colrowa[6][2] = Array('','7','2');
    $colrowa[6][3] = Array('','6','3');
    $colrowa[6][4] = Array('','5','4');  
    
    $GLOBALS{'CROPPARMS'} = Array();
    
    $headingtext = $GLOBALS{'sfmclub_name'}." - ".$GLOBALS{'sfmground_name'};
    XH3("Floodlight Specification - ".$headingtext);
    XHRCLASS('underline');
    XBR();
    
    $maxcolqty=8;
    
    BTABDIV('floodlightcolumntabmenu');
    BTABHEADERCONTAINER();
    BTABHEADERITEMACTIVE("TabCol0","Summary");
    for ($ci=1; $ci<=$maxcolqty; $ci++ ) {
        Check_Data('sfmfloodlightcolumn',$GLOBALS{'sfmground_id'},$ci);
        if ($GLOBALS{'IOWARNING'} == "0") {
            BTABHEADERITEM("TabCol".$ci,"Column ".$ci);
        }
    }
    B_TABHEADERCONTAINER();
    BTABCONTENTCONTAINER();
    BTABCONTENTITEMACTIVE("TabCol0");
    Get_Data('sfmfloodlightcolumn',$GLOBALS{'sfmground_id'},"0");
    ColSummaryContent();
    B_TABCONTENTITEM();
    for ($ci=1; $ci<=$maxcolqty; $ci++ ) {
        Check_Data('sfmfloodlightcolumn',$GLOBALS{'sfmground_id'},$ci);
        if ($GLOBALS{'IOWARNING'} == "0") {
            BTABCONTENTITEM("TabCol".$ci);
            $colno = $ci;
            ColContent($ci);
            B_TABCONTENTITEM();
        }
    }
    B_TABCONTENTCONTAINER();
    B_TABDIV();
    
    X_FORM();
    XTXTID("TRACETEXT","");
    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function ColSummaryContent() {
    XBR();
    XINHID('sfmfloodlightcolumn_startfield_0',"");  
    BROW();
    BCOL("6");
    BROW();BCOLTXT("Columns","3");BCOLINTXTID("sfmfloodlightcolumn_qty_0","sfmfloodlightcolumn_qty_0",$GLOBALS{'sfmfloodlightcolumn_qty'},"3");B_ROW();
    BROW();BCOLTXT("Total Fixtures","3");BCOLINTXTID("sfmfloodlightcolumn_fixtureqty_0","sfmfloodlightcolumn_fixtureqty_0",$GLOBALS{'sfmfloodlightcolumn_fixtureqty'},"3");B_ROW();
    B_COL();
    BCOL("6");
    BINBUTTONIDSPECIALICON ("ReplicateSpec","success","Create Datailed Information ","clone");
    BINBUTTONIDSPECIALICON ("DeReplicateSpec","danger","Remove Detailed Information ","minus-circle");
    B_COL();
    B_ROW();
    XHR();
    
    
    BROW();
    BCOL("6");
    XH3("Column Specification");
    ColSummarySection();
    B_COL();
    BCOL("6");
    XH3("Element Specification");
    LampSummarySection();
    B_COL();
    B_ROW();
    
}

function ColContent($colid) {
    XBR();
    BROW();
    BCOLCENTER("4");
    BROW();
    BCOLTXTCOLOR("<b>Column ".$GLOBALS{'sfmfloodlightcolumn_id'}." Specification</b>","12","white","blue");
    B_ROW();
    XBR();
    echo '<div style="background-color: #E5E8E8;">'."\n";
    LampGrid();
    X_DIV("");
    XBR();
    ColSection($colid);
    B_COL();
    BCOLCENTER("8");
    LampSection($colid);
    B_COL();
    B_ROW();
}

function LampGrid() { 
    $lampconfiga = explode("-",$GLOBALS{'sfmfloodlightcolumn_lampconfig'});
    $lampi = 0;
    BROW();    
    BCOL("6");
    XBR();
    $thiscolqty = $GLOBALS{'sfmground_floodlightcolumnqty'};
    $thiscol = $GLOBALS{'sfmfloodlightcolumn_id'};
    $imagename = "ColPos".$thiscolqty.$thiscol;
    XIMG("../site_assets/ColPos/".$imagename.".png","100","138","");
    B_COL();
    BCOL("6");
    XBR();
    foreach ($lampconfiga as $rowcount) {      
        BROW();
        BCOLCENTER("12");
        XDIV("","");
        for ($rli=1; $rli<=$rowcount; $rli++ ) {
            $lampi++;
            BINBUTTONIDSPECIAL ("Element".$lampi,"warning","L".$lampi);
        }
        X_DIV("");
        B_COL();
        B_ROW();
        XBR();
    }
    B_COL();
    B_ROW();
    XHR();
}

function ColSummarySection() {
    
    $colmax = $GLOBALS{'sfmfloodlightcolumn_qty'};
    if ($colmax == 0) { $colmax = 4; }
    
    $colposa = Array();
    $colposa[4] = Array(4,1,3,2);
    $colposa[6] = Array(6,1,5,2,4,3);
    $colposa[8] = Array(8,1,7,2,6,3,5,4);    
       
    $xyconfiga = Array();
    $xconfiga = Array();
    $yconfiga = Array();   
    if ($GLOBALS{'sfmfloodlightcolumn_xyconfig'} != "") {
        // 1[33.5-48.8],2[33.5-48.8] etc
        $xyconfiga = explode (",",$GLOBALS{'sfmfloodlightcolumn_xyconfig'}); 
        foreach ($xyconfiga as $xyconfig) {
            $bitsa = explode ("[",$xyconfig);
            $bitsb = explode("]",$bitsa[1]);
            $bitsc = explode("-",$bitsb[0]);
            $xconfiga[$bitsa[0]] = $bitsc[0];
            $yconfiga[$bitsa[0]] = $bitsc[1];
        }
    }
    $lampconfiga = Array();
    if ($GLOBALS{'sfmfloodlightcolumn_lampconfig'} != "") {
        // 1[3-2],2[3-2] etc
        $lampconfiga = explode (",",$GLOBALS{'sfmfloodlightcolumn_lampconfig'});
        foreach ($lampconfiga as $lampconfig) {
            $bitsa = explode ("[",$lampconfig);
            $bitsb = explode("]",$bitsa[1]);
            $lampconfiga[$bitsa[0]] = $bitsb[0];
        }
    }
     
    $colid = "0";
    
    $li = 0;
    for ($rowi=1; $rowi<=($colmax/2); $rowi++) {
        $outercolor = "#F9E79F";
        $innercolor = "#A2D9CE";
        BROWEQH();
        $lefti = $colposa[$colmax][$li];
        BCOLBACKCOLOR($outercolor,"2");BTXT("<b>Column ".$lefti."<br>&nbsp;</b>");B_COL();
        BCOLBACKCOLOR($innercolor,"1");
        echo '<i class="fa fa-arrow-left" aria-hidden="true"></i>';
        B_COL();
        if (isset($xconfiga[$lefti])) { $val = $xconfiga[$lefti]; } else { $val = ""; }
        BCOLBACKCOLOR($innercolor,"2");BINTXTIDCLASS("ColX".$lefti,"xconfig","ColX".$lefti,$val);B_COL();
        BCOLTXTCOLOR("&nbsp;<br>&nbsp;","1",$innercolor,"gray");
        BCOLTXTCOLOR("&nbsp;<br>&nbsp;","1",$innercolor,"gray");
        $righti = $colmax + 1 - $lefti;
        if (isset($xconfiga[$righti])) { $val = $xconfiga[$righti]; } else { $val = ""; }
        BCOLBACKCOLOR($innercolor,"2");BINTXTIDCLASS("ColX".$righti,"xconfig","ColX".$righti,$val);B_COL();
        BCOLBACKCOLOR($innercolor,"1");
        echo '<i class="fa fa-arrow-right" aria-hidden="true"></i>';
        B_COL();
        BCOLBACKCOLOR($outercolor,"2");BTXT("<b>Column ".$righti."<br>&nbsp;</b>");B_COL();
        B_ROW();
        
        if ($rowi<=($colmax/4)) { $updown = "up"; } else { $updown = "down"; }
        
        BROWEQH();
        $lefti = $colposa[$colmax][$li];
        if (isset($lampconfiga[$lefti])) { $val = $lampconfiga[$lefti]; } else { $val = ""; }
        BCOLBACKCOLOR($outercolor,"2");BINTXTIDCLASS("ColC".$lefti,"lampconfig","ColC".$lefti,$val);B_COL();
        BCOLBACKCOLOR($innercolor,"1");
        echo '<i class="fa fa-arrow-'.$updown.'" aria-hidden="true"></i>';
        B_COL();
        if (isset($yconfiga[$lefti])) { $val = $yconfiga[$lefti]; } else { $val = ""; }
        BCOLBACKCOLOR($innercolor,"2");BINTXTIDCLASS("ColY".$lefti,"yconfig","ColY".$lefti,$val);B_COL();
        BCOLTXTCOLOR("&nbsp;<br>&nbsp;","1",$innercolor,"gray");
        BCOLTXTCOLOR("&nbsp;<br>&nbsp;","1",$innercolor,"gray");
        $righti = $colmax + 1 - $lefti;
        if (isset($yconfiga[$righti])) { $val = $yconfiga[$righti]; } else { $val = ""; }
        BCOLBACKCOLOR($innercolor,"2");BINTXTIDCLASS("ColY".$righti,"yconfig","ColY".$righti,$val);B_COL();
        BCOLBACKCOLOR($innercolor,"1");
        echo '<i class="fa fa-arrow-'.$updown.'" aria-hidden="true"></i>';
        B_COL();
        if (isset($lampconfiga[$righti])) { $val = $lampconfiga[$righti]; } else { $val = ""; }
        BCOLBACKCOLOR($outercolor,"2");BINTXTIDCLASS("ColC".$righti,"lampconfig","ColC".$righti,$val);B_COL();
        
        B_ROW();
        XHR();
        $li = $li + 2;
    }
    
    BROW();BCOLTXT("Type","6");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightcolumntype","sfmfloodlightcolumntype_id","sfmfloodlightcolumntype_name","sfmfloodlightcolumntype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightcolumn_columntypeid_".$colid,"sfmfloodlightcolumn_columntypeid_".$colid,$GLOBALS{'sfmfloodlightcolumn_columntypeid'},"6");
    B_ROW();
    BROW();BCOLTXT("Height","6");BCOLINTXTID("sfmfloodlightcolumn_columnheight_".$colid,"sfmfloodlightcolumn_columnheight_".$colid,$GLOBALS{'sfmfloodlightcolumn_columnheight'},"6");B_ROW();
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BROW();BCOLTXT("Manufacturer","6");
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightcolumn_columnmanufacturerid_".$colid,"sfmfloodlightcolumn_columnmanufacturerid_".$colid,$GLOBALS{'sfmfloodlightcolumn_columnmanufacturerid'},"6");
    B_ROW();
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BROW();BCOLTXT("Contractor","6");
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightcolumn_columncontractorid_".$colid,"sfmfloodlightcolumn_columncontractorid_".$colid,$GLOBALS{'sfmfloodlightcolumn_columncontractorid'},"6");
    B_ROW();
    BROW();BCOLTXT("Install Date","6");
    BCOLINDATEID("columninstalldate_".$colid,"sfmfloodlightcolumn_columninstalldate_".$colid.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightcolumn_columninstalldate'}),'dd/mm/yyyy',"6");
    B_ROW();
    BROW();BCOLTXT("Upgrade Date","6");
    BCOLINDATEID("sfmfloodlightcolumn_columnupgradedate_".$colid,"sfmfloodlightcolumn_columnupgradedate_".$colid.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightcolumn_columnupgradedate'}),'dd/mm/yyyy',"6");
    B_ROW();
    BROW();BCOLTXT("Replacement Date","6");
    BCOLINDATEID("sfmfloodlightcolumn_columnreplacementdate_".$colid,"sfmfloodlightcolumn_columnreplacementdate_".$colid.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightcolumn_columnreplacementdate'}),'dd/mm/yyyy',"6");
    B_ROW();
    XINHIDID("sfmfloodlightcolumn_lampconfig_".$colid,"sfmfloodlightcolumn_lampconfig_".$colid,$GLOBALS{'sfmfloodlightcolumn_lampconfig'});
    /*
    BROW();
    BCOLTXT("Element Configuration<br>1[3-2],2[3-2] etc","6");BCOLINTEXTAREAID("sfmfloodlightcolumn_lampconfig_".$colid,"sfmfloodlightcolumn_lampconfig_".$colid,$GLOBALS{'sfmfloodlightcolumn_lampconfig'},"4","6");
    B_ROW();
    */
    XINHIDID("sfmfloodlightcolumn_xyconfig_".$colid,"sfmfloodlightcolumn_xyconfig_".$colid,$GLOBALS{'sfmfloodlightcolumn_xyconfig'});
    /*
    BROW();
    BCOLTXT("Column XY-Co-ords<br>1[33.5-48.8],2[33.5-48.8] etc","6");BCOLINTEXTAREAID("sfmfloodlightcolumn_xyconfig_".$colid,"sfmfloodlightcolumn_xyconfig_".$colid,$GLOBALS{'sfmfloodlightcolumn_xyconfig'},"4","6");
    B_ROW();
    */
    XHR();
    XH3("Images");
    XHRCLASS('underline');
    BROW();
    BCOL("12");
    if ( $GLOBALS{'sfmfloodlightcolumn_image1title'} == "" ) { $GLOBALS{'sfmfloodlightcolumn_image1title'} = "Floodlights 1"; }
    BROW(); BCOLINTXTID('sfmfloodlightcolumn_image1title_0','sfmfloodlightcolumn_image1title_0',$GLOBALS{'sfmfloodlightcolumn_image1title'},"4"); BCOLTXT("Caption","2"); B_ROW();
    XBR();
    XINHID("sfmfloodlightcolumn_image1_0",$GLOBALS{'sfmfloodlightcolumn_image1'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfloodlightcolumn_image1_0";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfloodlightcolumn_image1'};
    $imageuploadto = "FloodSpec";
    $imageuploadid = $GLOBALS{'sfmclub_groundidlist'}."Image1";
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
    BROW();
    BCOL("12");
    if ( $GLOBALS{'sfmfloodlightcolumn_image2title'} == "" ) { $GLOBALS{'sfmfloodlightcolumn_image2title'} = "Floodlights 2"; }
    BROW(); BCOLINTXTID('sfmfloodlightcolumn_image2title_0','sfmfloodlightcolumn_image2title_0',$GLOBALS{'sfmfloodlightcolumn_image2title'},"4"); BCOLTXT("Caption","2"); B_ROW();
    XBR();
    XINHID("sfmfloodlightcolumn_image2_0",$GLOBALS{'sfmfloodlightcolumn_image2'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfloodlightcolumn_image2_0";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfloodlightcolumn_image2'};
    $imageuploadto = "FloodSpec";
    $imageuploadid = $GLOBALS{'sfmclub_groundidlist'}."Image2";
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
    
    XINHID('sfmfloodlightcolumn_endfield_'.$colid,"");
}


function ColSection() {
    $colid = $GLOBALS{'sfmfloodlightcolumn_id'};
    XINHID('sfmfloodlightcolumn_startfield_'.$colid,"");
    BROW();BCOLTXT("X-Coord","6");BCOLINTXTID("xval_".$colid,"xval_".$colid,$GLOBALS{'sfmfloodlightcolumn_xval'},"6");B_ROW();
    BROW();BCOLTXT("Y-Coord","6");BCOLINTXTID("yval_".$colid,"yval_".$colid,$GLOBALS{'sfmfloodlightcolumn_yval'},"6");B_ROW();    
    BROW();BCOLTXT("Type","6");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightcolumntype","sfmfloodlightcolumntype_id","sfmfloodlightcolumntype_name","sfmfloodlightcolumntype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightcolumn_columntypeid_".$colid,"sfmfloodlightcolumn_columntypeid_".$colid,$GLOBALS{'sfmfloodlightcolumn_columntypeid'},"6");
    B_ROW();
    BROW();BCOLTXT("Height","6");BCOLINTXTID("columnheight_".$colid,"columnheight_".$colid,$GLOBALS{'sfmfloodlightcolumn_columnheight'},"6");B_ROW();
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BROW();BCOLTXT("Manufacturer","6");
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightcolumn_columnmanufacturerid_".$colid,"sfmfloodlightcolumn_columnmanufacturerid_".$colid,$GLOBALS{'sfmfloodlightcolumn_columnmanufacturerid'},"6");
    B_ROW();
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BROW();BCOLTXT("Contractor","6");
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightcolumn_columncontractorid_".$colid,"sfmfloodlightcolumn_columncontractorid_".$colid,$GLOBALS{'sfmfloodlightcolumn_columncontractorid'},"6");
    B_ROW();
    BROW();BCOLTXT("Install Date","6");
    BCOLINDATEID("columninstalldate_".$colid,"sfmfloodlightcolumn_columninstalldate_".$colid.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightcolumn_columninstalldate'}),'dd/mm/yyyy',"6");
    B_ROW();
    BROW();BCOLTXT("Upgrade Date","6");
    BCOLINDATEID("sfmfloodlightcolumn_columnupgradedate_".$colid,"sfmfloodlightcolumn_columnupgradedate_".$colid.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightcolumn_columnupgradedate'}),'dd/mm/yyyy',"6");
    B_ROW();
    BROW();BCOLTXT("Replacement Date","6");
    BCOLINDATEID("sfmfloodlightcolumn_columnreplacementdate_".$colid,"sfmfloodlightcolumn_columnreplacementdate_".$colid.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightcolumn_columnreplacementdate'}),'dd/mm/yyyy',"6");
    B_ROW();
    XINHID('sfmfloodlightcolumn_endfield_'.$colid,"");
}

function LampSummarySection() {
    $colid = 0; $lampi = "0";
    XINHID('sfmfloodlightelement_startfield_'.$colid."_".$lampi,"");
    Get_Data('sfmfloodlightelement',$GLOBALS{'sfmground_id'},$GLOBALS{'sfmfloodlightcolumn_id'},$lampi);
    XBR();
    BROW();BCOLTXTCOLOR("<b>Fixture</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightfixturetype","sfmfloodlightfixturetype_id","sfmfloodlightfixturetype_name","sfmfloodlightfixturetype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_fixturetypeid_".$colid."_".$lampi,"sfmfloodlightelement_fixturetypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_fixturetypeid'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_fixturemanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_fixturemanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_fixturemanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_fixtureinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_fixtureinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_fixtureinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_fixtureupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_fixtureupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_fixtureupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_fixturereplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_fixturereplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_fixturereplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Lamp</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightlamptype","sfmfloodlightlamptype_id","sfmfloodlightlamptype_name","sfmfloodlightlamptype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_lamptypeid_".$colid."_".$lampi,"sfmfloodlightelement_lamptypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_lamptypeid'},"3");
    BCOLTXT("Serial No","3");
    BCOLINTXTID("sfmfloodlightelement_lampserialno_".$colid."_".$lampi,"sfmfloodlightelement_lampserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_lampserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_lampmanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_lampmanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_lampmanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_lampupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampreplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_lampreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Ballast</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightballasttype","sfmfloodlightballasttype_id","sfmfloodlightballasttype_name","sfmfloodlightballasttype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_ballasttypeid_".$colid."_".$lampi,"sfmfloodlightelement_ballasttypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballasttypeid'},"3");
    BCOLTXT("Serial No","3");
    BCOLINTXTID("sfmfloodlightelement_ballastserialno_".$colid."_".$lampi,"sfmfloodlightelement_ballastserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballastserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"ballastmanufacturerid_".$colid."_".$lampi,"ballastmanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballastmanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_ballastupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_ballastupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_ballastupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("ballastreplacementdate_".$colid."_".$lampi,"ballastreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_ballastreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Capacitor</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightcapacitortype","sfmfloodlightcapacitortype_id","sfmfloodlightcapacitortype_name","sfmfloodlightcapacitortype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_capacitortypeid_".$colid."_".$lampi,"sfmfloodlightelement_capacitortypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitortypeid'},"3");
    BCOLTXT("Serial No","3");
    BCOLINTXTID("capacitorserialno_".$colid."_".$lampi,"capacitorserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitorserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_capacitormanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_capacitormanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitormanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_capacitorupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_capacitorupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_capacitorupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_capacitorreplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_capacitorreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_capacitorreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Igniter</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightignitertype","sfmfloodlightignitertype_id","sfmfloodlightignitertype_name","sfmfloodlightignitertype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_ignitertypeid_".$colid."_".$lampi,"sfmfloodlightelement_ignitertypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ignitertypeid'},"3");
    BCOLTXT("Serial No","3");
    BCOLINTXTID("sfmfloodlightelement_igniterserialno_".$colid."_".$lampi,"sfmfloodlightelement_igniterserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_igniterserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_ignitermanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_ignitermanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ignitermanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_igniterupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_igniterupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_igniterupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_igniterreplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_igniterreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_igniterreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XINHID('sfmfloodlightelement_endfield_'.$colid."_".$lampi,"");
}

function LampSection($colid) {
    $fixtureqty = $GLOBALS{'sfmfloodlightcolumn_fixtureqty'}; 
    BROW();
    BCOLTXTCOLOR("<b>Fixtures and Lamps on Column ".$colid."</b>","12","white","blue");
    BCOLTXT("","6");
    XBR();XBR();
    B_ROW();
    BTABHEADERCONTAINER();
    $first = "1";
    for ($li=1; $li<=$fixtureqty; $li++ ) {
        $tabid = "LTAB".$colid.$li;
        if ($first == "1") {BTABHEADERITEMACTIVE($tabid,"Lamp".$li);}
        else {BTABHEADERITEM($tabid,"Lamp".$li);}
        $first = "0";
    }
    B_TABHEADERCONTAINER();
    
    BTABCONTENTCONTAINER();
    $first = "1";
    for ($li=1; $li<=$fixtureqty; $li++ ) {
        $tabid = "LTAB".$colid.$li;
        if ($first == "1") { BTABCONTENTITEMACTIVE($tabid); }
        else { BTABCONTENTITEM($tabid); }
        $first = "0";
        LampTabContent($colid,$li); 
        B_TABCONTENTITEM();
    }
    B_TABCONTENTCONTAINER();  
}

function LampTabContent($colid,$lampi) {
    // XPTXT($lampi);
    XINHID('sfmfloodlightelement_startfield_'.$colid."_".$lampi,"");
    Get_Data('sfmfloodlightelement',$GLOBALS{'sfmground_id'},$GLOBALS{'sfmfloodlightcolumn_id'},$lampi);
    XBR();
    BROW();BCOLTXTCOLOR("<b>Fixture</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightfixturetype","sfmfloodlightfixturetype_id","sfmfloodlightfixturetype_name","sfmfloodlightfixturetype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_fixturetypeid_".$colid."_".$lampi,"sfmfloodlightelement_fixturetypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_fixturetypeid'},"3");
    BCOLTXT("Serial No","3");
    BCOLINTXTID("sfmfloodlightelement_fixtureserialno_".$colid."_".$lampi,"sfmfloodlightelement_fixtureserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_fixtureserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_fixturemanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_fixturemanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_fixturemanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_fixtureinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_fixtureinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_fixtureinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_fixtureupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_fixtureupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_fixtureupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_fixturereplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_fixturereplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_fixturereplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Lamp</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightlamptype","sfmfloodlightlamptype_id","sfmfloodlightlamptype_name","sfmfloodlightlamptype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_lamptypeid_".$colid."_".$lampi,"sfmfloodlightelement_lamptypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_lamptypeid'},"3");
    BCOLTXT("Serial No","3");
    BCOLINTXTID("sfmfloodlightelement_lampserialno_".$colid."_".$lampi,"sfmfloodlightelement_lampserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_lampserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_lampmanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_lampmanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_lampmanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_lampupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampreplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_lampreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Ballast</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightballasttype","sfmfloodlightballasttype_id","sfmfloodlightballasttype_name","sfmfloodlightballasttype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_ballasttypeid_".$colid."_".$lampi,"sfmfloodlightelement_ballasttypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballasttypeid'},"3");
    BCOLTXT("Serial No","3");
    BCOLINTXTID("sfmfloodlightelement_ballastserialno_".$colid."_".$lampi,"sfmfloodlightelement_ballastserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballastserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"ballastmanufacturerid_".$colid."_".$lampi,"ballastmanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballastmanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_ballastupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_ballastupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_ballastupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("ballastreplacementdate_".$colid."_".$lampi,"ballastreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_ballastreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Capacitor</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightcapacitortype","sfmfloodlightcapacitortype_id","sfmfloodlightcapacitortype_name","sfmfloodlightcapacitortype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_capacitortypeid_".$colid."_".$lampi,"sfmfloodlightelement_capacitortypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitortypeid'},"3");
    BCOLTXT("Serial No","3");
    BCOLINTXTID("capacitorserialno_".$colid."_".$lampi,"capacitorserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitorserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_capacitormanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_capacitormanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitormanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_capacitorupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_capacitorupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_capacitorupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_capacitorreplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_capacitorreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_capacitorreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Igniter</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightignitertype","sfmfloodlightignitertype_id","sfmfloodlightignitertype_name","sfmfloodlightignitertype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_ignitertypeid_".$colid."_".$lampi,"sfmfloodlightelement_ignitertypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ignitertypeid'},"3");
    BCOLTXT("Serial No","3");
    BCOLINTXTID("sfmfloodlightelement_igniterserialno_".$colid."_".$lampi,"sfmfloodlightelement_igniterserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_igniterserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_ignitermanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_ignitermanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ignitermanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_igniterupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_igniterupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_igniterupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_igniterreplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_igniterreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_igniterreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XINHID('sfmfloodlightelement_endfield_'.$colid."_".$lampi,"");
}

function SFM_SFMCLUBSUMMARYGENERATE_Output() {
    XH3("Club Data Generate Utility");
    $sfmgrounda = Get_Array('sfmground');
    foreach ($sfmgrounda as $sfmground_id) {
        Get_Data('sfmground',$sfmground_id);
        XPTXT($sfmground_id." ground ");
        $sfmfloodlightvisita = Get_Array('sfmfloodlightvisit',$sfmground_id);
        foreach ($sfmfloodlightvisita as $sfmfloodlightvisit_id) {
            Get_Data('sfmfloodlightvisit',$sfmground_id,$sfmfloodlightvisit_id); 
            XPTXT($sfmground_id." visit ");
            $GLOBALS{'sfmground_floodlightcolumnrag'} = "Green";
            $GLOBALS{'sfmground_floodlightcolumnragcomments'} = "";
            $GLOBALS{'sfmground_floodlightcolumnreplacementdate'} = "";
            $GLOBALS{'sfmground_floodlightbaserag'} = "Green";
            $GLOBALS{'sfmground_floodlightbaseragcomments'} = "";
            $GLOBALS{'sfmground_floodlightbasereplacementdate'} = "";
            $GLOBALS{'sfmground_floodlightfixturerag'} = "Green";
            $GLOBALS{'sfmground_floodlightfixtureragcomments'} = "";
            $GLOBALS{'sfmground_floodlightfixturereplacementdate'} = "";
            $GLOBALS{'sfmground_floodlightelectricsrag'} = "Green";
            $GLOBALS{'sfmground_floodlightelectricsragcomments'} = "";
            $GLOBALS{'sfmground_floodlightelectricsreplacementdate'} = "";
            $GLOBALS{'sfmground_floodlightlamprag'} = "Green";
            $GLOBALS{'sfmground_floodlightlampragcomments'} = "";
            $GLOBALS{'sfmground_floodlightlampreplacementdate'} = "";
            $GLOBALS{'sfmground_floodlightspillluxrag'} = "Green";
            
            $GLOBALS{'sfmground_lastfloodlightreviewdate'} = $GLOBALS{'sfmfloodlightvisit_date'};
            $GLOBALS{'sfmground_lastfloodlightreviewername'} = $GLOBALS{'sfmfloodlightvisit_reviewername'};
            $GLOBALS{'sfmground_lastfloodlightreviewdecision'} = $GLOBALS{'sfmfloodlightvisit_reviewerdecision'};
            $GLOBALS{'sfmground_floodlightavglux'} = $GLOBALS{'sfmfloodlightvisit_avglux'};
            $GLOBALS{'sfmground_floodlightavgluxreqd'} = $GLOBALS{'sfmfloodlightvisit_averageluxreqd'};
            $GLOBALS{'sfmground_floodlightminlux'} = $GLOBALS{'sfmfloodlightvisit_minlux'};
            $GLOBALS{'sfmground_floodlightmaxlux'} = $GLOBALS{'sfmfloodlightvisit_maxlux'};
            $GLOBALS{'sfmground_floodlightminmaxlux'} = $GLOBALS{'sfmfloodlightvisit_minmaxlux'};
            $GLOBALS{'sfmground_floodlightminmaxluxreqd'} = $GLOBALS{'sfmfloodlightvisit_minmaxluxreqd'};
            $GLOBALS{'sfmground_floodlightminavglux'} = $GLOBALS{'sfmfloodlightvisit_minavglux'};
        }
        Write_Data('sfmground',$sfmground_id);
        XPTXT($sfmground_id." updated");
    }
}

function SFM_SFMREPLICATEALL_Output() {   
    XH3("Column/Lamp Replicate Utilitry");   
    $sfmgrounda = Get_Array('sfmground');
    foreach ($sfmgrounda as $sfmground_id) {
        SFMREPLICATESPEC($sfmground_id);
    }
}

function SFM_SFMFLOODLIGHTSPECGENERATE_Output() {
    XH3("Floodlight Spec Generate Utility");
    $sfmgrounda = Get_Array('sfmground');
    foreach ($sfmgrounda as $sfmground_id) {
        Get_Data('sfmground',$sfmground_id);
        XPTXT($sfmground_id." ground ");
        $sfmfloodlightvisita = Get_Array('sfmfloodlightvisit',$sfmground_id);
        foreach ($sfmfloodlightvisita as $sfmfloodlightvisit_id) {
            Get_Data('sfmfloodlightvisit',$sfmground_id,$sfmfloodlightvisit_id);   

            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_pitchlength'}." <= ".$GLOBALS{'sfmground_pitchlength'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_pitchwidth'}." <= ".$GLOBALS{'sfmground_pitchwidth'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_columnqty'}." <= ".$GLOBALS{'sfmground_floodlightcolumnqty'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_columnheight'}." <= ".$GLOBALS{'sfmground_floodlightcolumnheight'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_columntypeid'}." <= ".$GLOBALS{'sfmground_floodlightcolumntypeid'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_fixtureqty'}." <= ".$GLOBALS{'sfmground_floodlightfixtureqty'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_pitchorientation'}." <= ".$GLOBALS{'sfmground_pitchorientation'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_dugoutposition'}." <= ".$GLOBALS{'sfmground_dugoutposition'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'}." <= ".$GLOBALS{'sfmground_sfmpitchtypeid'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_fixturetypeid'}." <= ".$GLOBALS{'sfmground_floodlightfixturetypeid'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'}." <= ".$GLOBALS{'sfmground_floodlightfixturemanufacturerid'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_lamptypeid'}." <= ".$GLOBALS{'sfmground_floodlightlamptypeid'},"green");
            
            
            $GLOBALS{'sfmground_pitchlength'} = $GLOBALS{'sfmfloodlightvisit_pitchlength'};
            $GLOBALS{'sfmground_pitchwidth'} = $GLOBALS{'sfmfloodlightvisit_pitchwidth'};
            $GLOBALS{'sfmfloodlightvisit_columnqty'} = $GLOBALS{'sfmground_floodlightcolumnqty'};
            $GLOBALS{'sfmfloodlightvisit_columnheight'} = $GLOBALS{'sfmground_floodlightcolumnheight'};
            $GLOBALS{'sfmfloodlightvisit_columntypeid'} = $GLOBALS{'sfmground_floodlightcolumntypeid'};
            $GLOBALS{'sfmfloodlightvisit_fixtureqty'} = $GLOBALS{'sfmground_floodlightfixtureqty'};
            $GLOBALS{'sfmfloodlightvisit_pitchorientation'} = $GLOBALS{'sfmground_pitchorientation'};
            $GLOBALS{'sfmfloodlightvisit_dugoutposition'} = $GLOBALS{'sfmground_dugoutposition'};
            $GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'} = $GLOBALS{'sfmground_sfmpitchtypeid'};
            
            $GLOBALS{'sfmfloodlightvisit_fixturetypeid'} = $GLOBALS{'sfmground_floodlightfixturetypeid'};
            $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'} = $GLOBALS{'sfmground_floodlightfixturemanufacturerid'};            
            $GLOBALS{'sfmfloodlightvisit_lamptypeid'} = $GLOBALS{'sfmground_floodlightlamptypeid'};

            XPTXT($sfmground_id." ".$sfmfloodlightvisit_id." synchronised");
            Write_Data('sfmfloodlightvisit',$sfmground_id,$sfmfloodlightvisit_id);
            Write_Data('sfmground',$sfmground_id);
        }

    }
}

function SFMREPLICATESPEC($sfmground_id) {    
    $colfixtureqtya = Array();
    $colfixtureqtya[4] = Array();
    $colfixtureqtya[6] = Array();
    $colfixtureqtya[8] = Array();
    $colfixtureqtya[4][4] = Array('','1','1','1','1');
    $colfixtureqtya[4][8] = Array('','2','2','2','2');
    $colfixtureqtya[4][12] = Array('','3','3','3','3');
    $colfixtureqtya[4][16] = Array('','4','4','4','4');
    $colfixtureqtya[4][20] = Array('','5','5','5','5');
    
    $colfixtureqtya[6][6] = Array('','1','1','1','1','1','1');
    $colfixtureqtya[6][12] = Array('','2','2','2','2','2','2');
    $colfixtureqtya[6][16] = Array('','3','2','3','3','2','3');
    $colfixtureqtya[6][18] = Array('','3','3','3','3','3','3');
    $colfixtureqtya[6][21] = Array('','3','4','3','4','4','3'); // ??
    $colfixtureqtya[6][24] = Array('','4','4','4','4','4','4');
    
    $colfixtureqtya[8][8] = Array('','1','1','1','1','1','1','1','1');
    $colfixtureqtya[8][16] = Array('','2','2','2','2','2','2','2','2');
    $colfixtureqtya[8][24] = Array('','3','3','3','3','3','3','3','3');
    
    $lampmapa = Array();
    $lampmapa[1] = "1";
    $lampmapa[2] = "2";
    $lampmapa[3] = "1-2";
    $lampmapa[4] = "2-2";
    $lampmapa[5] = "2-3";
    $lampmapa[6] = "3-3";
    
    Get_Data('sfmground',$sfmground_id);
    $colqty = 0;
    $fixtureqty = 0;
    $summarylampconfig = "";
    Check_Data('sfmfloodlightcolumn',$sfmground_id,"0");
    if ($GLOBALS{'IOWARNING'} == "0") {
        Check_Data('sfmfloodlightelement',$sfmground_id,"0","0");
        XPTXT($sfmground_id." ground ".$GLOBALS{'sfmfloodlightcolumn_qty'}.' '.$GLOBALS{'sfmfloodlightcolumn_fixtureqty'});
        if ($GLOBALS{'IOWARNING'} == "0") {
            $summarylampconfig = ""; $summsep = "";
            $colqty = $GLOBALS{'sfmfloodlightcolumn_qty'};
            $fixtureqty = $GLOBALS{'sfmfloodlightcolumn_fixtureqty'};
            $defaultcolfixtureqty = (int)$fixtureqty/$colqty;
            for ($ci=1; $ci<=$colqty; $ci++ ) {
                $GLOBALS{'sfmfloodlightcolumn_qty'} = "1";
                $GLOBALS{'sfmfloodlightcolumn_location'} = $ci;
                if (isset($colfixtureqtya[$colqty][$fixtureqty])) {
                    $GLOBALS{'sfmfloodlightcolumn_fixtureqty'} = $colfixtureqtya[$colqty][$fixtureqty][$ci];
                    $GLOBALS{'sfmfloodlightcolumn_lampconfig'} = $lampmapa[$GLOBALS{'sfmfloodlightcolumn_fixtureqty'}];
                } else {
                    $GLOBALS{'sfmfloodlightcolumn_fixtureqty'} = $defaultcolfixtureqty;
                    $GLOBALS{'sfmfloodlightcolumn_lampconfig'} = $lampmapa[$defaultcolfixtureqty];
                }
                $summarylampconfig = $summarylampconfig.$summsep.$ci."[".$GLOBALS{'sfmfloodlightcolumn_lampconfig'}."]";
                $summsep = ",";
                Write_Data('sfmfloodlightcolumn',$sfmground_id,$ci);
                XPTXTCOLOR($ci." column ".$GLOBALS{'sfmfloodlightcolumn_lampconfig'},"red");
                for ($li=1; $li<=$GLOBALS{'sfmfloodlightcolumn_fixtureqty'}; $li++ ) {
                    $GLOBALS{'sfmfloodlightelement_location'} = $li;
                    Write_Data('sfmfloodlightelement',$sfmground_id,$ci,$li);
                    XPTXTCOLOR($li." lamp ","green");
                }
            }
            // == set lamp configuration for whole system ======
            Get_Data('sfmfloodlightcolumn',$sfmground_id,"0");
            $GLOBALS{'sfmfloodlightcolumn_lampconfig'} = $summarylampconfig;
            Write_Data('sfmfloodlightcolumn',$sfmground_id,"0");
        }
            
        $GLOBALS{'sfmground_floodlightcolumnqty'} = $colqty;
        $GLOBALS{'sfmground_floodlightfixtureqty'} = $fixtureqty;
        Write_Data('sfmground',$sfmground_id);
        
        XPTXT($sfmground_id." updated: ".$colqty." ".$fixtureqty." ".$summarylampconfig);
    }
}

function SFM_SFMDEREPLICATEALL_Output() {
    XH3("Column/Lamp DeReplicate Utilitry");
    $sfmgrounda = Get_Array('sfmground');
    foreach ($sfmgrounda as $sfmground_id) {
        SFMDEREPLICATESPEC($sfmground_id);
    }
}


function SFMDEREPLICATESPEC($sfmground_id) {    
    $cola = Get_Array('sfmfloodlightcolumn',$sfmground_id);
    foreach ($cola as $colid) {
        if ($colid != "0") {
            Delete_Data('sfmfloodlightcolumn',$sfmground_id,$colid);
            XPTXTCOLOR($sfmground_id.": Column".$colid." removed","green");
        }
    }
    $cola = Get_Array('sfmfloodlightelement',$sfmground_id);
    foreach ($cola as $colid) {
        if ($colid != "0") {
            $elementa = Get_Array('sfmfloodlightelement',$sfmground_id,$colid);
            foreach ($elementa as $elementid) {
                if ($elementid != "0") {
                    Delete_Data('sfmfloodlightelement',$sfmground_id,$colid,$elementid);
                    XPTXTCOLOR($sfmground_id.": Element".$colid." ".$elementid." removed","green");
                }
            }
        }
    }
}


// ====== Light Test App ========

function SFM_SFMLLTAPPSETLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,getscreensize";
}

function SFM_SFMLLTAPPSETLIST_Output() {
    XH2("Light Level Test App");
    XBR();XBR();
    XDIV("simpletablediv","container");
    XTABLECOMPACTJQDTID("simpletabletable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Set Name");
    XTDHTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");
    
    $sfmseta = Get_Array('sfmset');
    foreach ($sfmseta as $sfmset_id) {
        Get_Data('sfmset',$sfmset_id);
        XTRJQDT();
        XTDTXT($GLOBALS{'sfmset_name'});
        $link = YPGMLINK("sfmappclublistout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmset_id",$sfmset_id);
        XTDLINKTXT($link,"select");
        X_TR();
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv");
    XCLEARFLOAT();
}

function SFM_SFMLLTAPPCLUBLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function SFM_SFMLLTAPPCLUBLIST_Output($sfmset_id) {
    Get_Data('sfmset',$sfmset_id);
    XH2("Light Level Test App - ".$GLOBALS{'sfmset_name'});
    XBR();XBR();
    XDIV("simpletablediv","container");
    XTABLECOMPACTJQDTID("simpletabletable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Club Name");
    XTDHTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");

    $sfmcluba = Get_Array('sfmclub');
    foreach ($sfmcluba as $sfmclub_id) {
        Get_Data('sfmclub',$sfmclub_id);
        if ($GLOBALS{'sfmclub_sfmsetid'} == $sfmset_id) {
            XTRJQDT();
            XTDTXT($GLOBALS{'sfmclub_name'});
            $link = YPGMLINK("sfmlltapplauncher.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id);
            XTDLINKTXT($link,"select");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv");
    XCLEARFLOAT();
    XINHID("ScreenHeight","");
    XINHID("ScreenWidth","");        
}

function SFM_SFMLLTAPPLAUNCHER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,getscreensize";
}

function SFM_SFMLLTAPPLAUNCHER_Output($screenheight,$screenwidth,$sfmclub_id) {
    Get_Data('sfmclub',$sfmclub_id);
    Get_Data('sfmground',$GLOBALS{'sfmclub_groundidlist'});
    $sfmfloodlightvisita = Get_Array('sfmfloodlightvisit',$GLOBALS{'sfmclub_groundidlist'});
    $lastsfmfloodlightvisit_id = "";
    foreach ($sfmfloodlightvisita as $sfmfloodlightvisit_id) {
        $visitfound = "1";
        $lastsfmfloodlightvisit_id = $sfmfloodlightvisit_id;
    }
    
    XH2($GLOBALS{'sfmclub_name'});
    if ( $lastsfmfloodlightvisit_id != "" ) {
        Get_Data('sfmfloodlightvisit',$GLOBALS{'sfmclub_groundidlist'},$lastsfmfloodlightvisit_id);
        XFORMUPLOAD("sfmlltappout.php","sfmclubupdateformold");
        XINSTDHID();
        XINHID("VisitAction","Update");
        XINHID("ScreenHeight",$screenheight);
        XINHID("ScreenWidth",$screenwidth);
        XINHID("sfmclub_id",$sfmclub_id);
        XINHID("sfmground_id",$GLOBALS{'sfmclub_groundidlist'});
        XINHID("sfmfloodlightvisit_id",$lastsfmfloodlightvisit_id);
        XINSUBMIT("Update Last LLT - ".YYYY_MM_DDtoDDsMMsYY($GLOBALS{'sfmfloodlightvisit_date'}));
        X_FORM();
        XBR();       
        XFORMUPLOAD("sfmlltappout.php","sfmclubupdateformnew");
        XINSTDHID();
        XINHID("VisitAction","ReTest");
        XINHID("ScreenHeight",$screenheight);
        XINHID("ScreenWidth",$screenwidth);
        XINHID("sfmclub_id",$sfmclub_id);
        XINHID("sfmground_id",$GLOBALS{'sfmclub_groundidlist'});
        XINHID("sfmfloodlightvisit_id",$lastsfmfloodlightvisit_id);
        BINSUBMITIDSPECIAL ("ReTest","warning","Start New ReTest");
        X_FORM(); 
    }
    XHR();
    XFORMUPLOAD("sfmlltappout.php","sfmclubupdateformnew");
    XINSTDHID();
    XINHID("VisitAction","New");
    XINHID("ScreenHeight",$screenheight);
    XINHID("ScreenWidth",$screenwidth);
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmground_id",$GLOBALS{'sfmclub_groundidlist'});
    XINHID("sfmfloodlightvisit_id","New");
    XINSUBMIT("Start New Biennial LLT");
    X_FORM();

}

function SFM_SFMLLTAPP_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jsignature";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,sfmlltapp,jqueryconfirm,jsignaturemin";
}

function SFM_SFMLLTAPP_Output($screenheight,$screenwidth,$sfmclub_id,$sfmground_id,$sfmfloodlightvisit_id,$visitaction) {
    Get_Data('sfmclub',$sfmclub_id);
    Get_Data('sfmground',$sfmground_id);
    if ( $visitaction == "New" ) {
        Initialise_Data("sfmfloodlightvisit");       
        $GLOBALS{'sfmfloodlightvisit_id'} = $GLOBALS{'currenttimestamp'};
        $GLOBALS{'sfmfloodlightvisit_type'} = "LLTBiennial";
        $GLOBALS{'sfmfloodlightvisit_date'} = $GLOBALS{'currentYYYY-MM-DD'};
        $GLOBALS{'sfmfloodlightvisit_starttime'} = $GLOBALS{'acthh'}.":".$GLOBALS{'actmm'};
        $GLOBALS{'sfmfloodlightvisit_pitchlength'} = $GLOBALS{'sfmground_pitchlength'};
        $GLOBALS{'sfmfloodlightvisit_pitchwidth'} = $GLOBALS{'sfmground_pitchwidth'};        
        $GLOBALS{'sfmfloodlightvisit_columnqty'} = $GLOBALS{'sfmground_floodlightcolumnqty'};
        $GLOBALS{'sfmfloodlightvisit_columnheight'} = $GLOBALS{'sfmground_floodlightcolumnheight'};
        $GLOBALS{'sfmfloodlightvisit_columntypeid'} = $GLOBALS{'sfmground_floodlightcolumntypeid'};
        $GLOBALS{'sfmfloodlightvisit_columnmanufacturerid'} = $GLOBALS{'sfmground_floodlightcolumnmanufacturerid'};
        $GLOBALS{'sfmfloodlightvisit_columninstalldate'} = $GLOBALS{'sfmground_floodlightcolumninstalldate'};
        $GLOBALS{'sfmfloodlightvisit_fixtureqty'} = $GLOBALS{'sfmground_floodlightfixtureqty'};
        $GLOBALS{'sfmfloodlightvisit_pitchorientation'} = $GLOBALS{'sfmground_pitchorientation'};
        $GLOBALS{'sfmfloodlightvisit_dugoutposition'} = $GLOBALS{'sfmground_dugoutposition'};
        $GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'} = $GLOBALS{'sfmground_sfmpitchtypeid'};
        
        $GLOBALS{'sfmfloodlightvisit_fixturetypeid'} = $GLOBALS{'sfmground_floodlightfixturetypeid'};
        $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'} = $GLOBALS{'sfmground_floodlightfixturemanufacturerid'};
        $GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'} = $GLOBALS{'sfmground_floodlightfixtureinstalldate'};
        $GLOBALS{'sfmfloodlightvisit_lamptypeid'} = $GLOBALS{'sfmground_floodlightlamptypeid'};

        $GLOBALS{'sfmfloodlightvisit_gridpointinset'} = 2.5;
        $GLOBALS{'sfmfloodlightvisit_gridpointslength'} = 11;
        $GLOBALS{'sfmfloodlightvisit_gridpointswidth'} = 8;
        $GLOBALS{'sfmfloodlightvisit_targetpoints'} = 88;
        $GLOBALS{'sfmfloodlightvisit_lightmeterserialno'} = "";
        $sfmfloodlightmetera = Get_Array('sfmfloodlightmeter');
        foreach ( $sfmfloodlightmetera as $sfmfloodlightmeter_serialno ) {
           Get_Data('sfmfloodlightmeter',$sfmfloodlightmeter_serialno);
           if ( $GLOBALS{'sfmfloodlightmeter_personid'} == $GLOBALS{'LOGIN_person_id'} ) {            
               $GLOBALS{'sfmfloodlightvisit_lightmeterserialno'} = $sfmfloodlightmeter_serialno;
           }
        }
    } 
    if ( $visitaction == "Update" ) {
        Get_Data('sfmfloodlightvisit',$sfmground_id,$sfmfloodlightvisit_id);
    }
    if ( $visitaction == "ReTest" ) {
        Get_Data('sfmfloodlightvisit',$sfmground_id,$sfmfloodlightvisit_id);
        $GLOBALS{'sfmfloodlightvisit_id'} = $GLOBALS{'currenttimestamp'};
        $GLOBALS{'sfmfloodlightvisit_type'} = "LLTReTest";
        $GLOBALS{'sfmfloodlightvisit_date'} = $GLOBALS{'currentYYYY-MM-DD'}; 
        $GLOBALS{'sfmfloodlightvisit_starttime'} = $GLOBALS{'acthh'}.":".$GLOBALS{'actmm'};
        $sfmfloodlightvisit_id = "New";
    }

    $GLOBALS{'CROPPARMS'} = Array(); 
    
    XFORMUPLOAD("sfmlltappin.php","sfmlltappinform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmground_id",$sfmground_id);
    XINHID("sfmfloodlightvisit_id",$sfmfloodlightvisit_id);
    XINHID("SpecificationChanged","");
    XINHID("VisitAction","Update");
    XINHID("SubmitAction",$visitaction);
    XINHID("ScreenHeight",$screenheight);
    XINHID("ScreenWidth",$screenwidth);   
    XINHID("sfmfloodlightvisit_heatmap","");  

    XDIV("HeaderDiv","");
    XTXT($GLOBALS{'sfmclub_name'});   
    X_DIV("HeaderDiv");
    
    Get_Data("person",$GLOBALS{'LOGIN_person_id'});
    
    XDIV("InitDiv","");
    XBR();
    BROW();
    BCOLXS("4");BTXT("Date");B_COL();
    BCOLXS("8");BINDATEID('sfmfloodlightvisit_date','sfmfloodlightvisit_date_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_date'}),'dd/mm/yyyy');B_COL();    
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Inspector");B_COL();
    if ($GLOBALS{'sfmfloodlightvisit_reviewername'} == "") { $GLOBALS{'sfmfloodlightvisit_reviewername'} = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}; }
    BCOLXS("8");BINTXTID ("sfmfloodlightvisit_reviewername","sfmfloodlightvisit_reviewername",$GLOBALS{'sfmfloodlightvisit_reviewername'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Club Rep");B_COL();
    BCOLXS("8");BINTXTID ("sfmfloodlightvisit_clubrepname","sfmfloodlightvisit_clubrepname",$GLOBALS{'sfmfloodlightvisit_clubrepname'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Pitch Type");B_COL();
    $xhash = Get_SelectArrays_Hash ("sfmpitchtype","sfmpitchtype_id","sfmpitchtype_name","sfmpitchtype_id","","" );
    BCOLXS("8");BINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_sfmpitchtypeid','static','sfmfloodlightvisit_sfmpitchtypeid',$GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Orientation");B_COL();
    $xhash = List2Hash ("West,NorthWest,North,NorthEast,East");
    BCOLXS("8");BINSELECTHASHIDCLASS ($xhash,"sfmfloodlightvisit_pitchorientation",'static',"sfmfloodlightvisit_pitchorientation",$GLOBALS{'sfmfloodlightvisit_pitchorientation'});B_COL();
    // BCOLXS("8");BINTXTIDCLASS ("sfmfloodlightvisit_pitchorientation",'static',"pitchorientation",$GLOBALS{'sfmfloodlightvisit_pitchorientation'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Dugouts");B_COL();
    $xhash = List2Hash ("Left,Right,None");
    BCOLXS("8");BINSELECTHASHIDCLASS ($xhash,"sfmfloodlightvisit_dugoutposition",'static',"sfmfloodlightvisit_dugoutposition",$GLOBALS{'sfmfloodlightvisit_dugoutposition'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Weather");B_COL();
    $xhash = Get_SelectArrays_Hash ("sfmreviewconditions","sfmreviewconditions_id","sfmreviewconditions_title","sfmreviewconditions_id","","" );
    BCOLXS("8");BINSELECTHASHID ($xhash,'sfmfloodlightvisit_conditions','sfmfloodlightvisit_conditions',$GLOBALS{'sfmfloodlightvisit_conditions'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Meter Serial");B_COL();
    BCOLXS("8");BINTXTID ("sfmfloodlightvisit_lightmeterserialno","sfmfloodlightvisit_lightmeterserialno",$GLOBALS{'sfmfloodlightvisit_lightmeterserialno'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("System Hrs");B_COL();
    BCOLXS("8");BINTXTID ("sfmfloodlightvisit_systemhrs","sfmfloodlightvisit_systemhrs",$GLOBALS{'sfmfloodlightvisit_systemhrs'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Elec Meter");B_COL();
    BCOLXS("8");BINTXTID ("sfmfloodlightvisit_electricmeter","sfmfloodlightvisit_electricmeter",$GLOBALS{'sfmfloodlightvisit_electricmeter'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Gas Meter");B_COL();
    BCOLXS("8");BINTXTID ("sfmfloodlightvisit_gasmeter","sfmfloodlightvisit_gasmeter",$GLOBALS{'sfmfloodlightvisit_gasmeter'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("4");BTXT("Start Time");B_COL();
    BCOLXS("8");BINTXTID ("sfmfloodlightvisit_starttime","sfmfloodlightvisit_starttime",$GLOBALS{'sfmfloodlightvisit_starttime'});B_COL();
    B_ROW();
    XBR();
   
    BROW();
    BCOLXS("6"); XINBUTTONIDCLASSSPECIAL ("InitDivBackButton","AppNavButton","primary","Back"); B_COL();
    BCOLXS("6"); XINBUTTONIDCLASSSPECIAL ("InitDivNextButton","AppNavButton","primary","Next"); B_COL();
    B_ROW();
    XBR();XBR();
    X_DIV("InitDiv");

    XDIV("DimDiv","");    
    XBR();
    BROW();
    BCOLXS("5");BTXT("Light Source");B_COL();
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightfixturetype","sfmfloodlightfixturetype_id","sfmfloodlightfixturetype_name","sfmfloodlightfixturetype_id","","" );
    BCOLXS("7");BINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_fixturetypeid','static','sfmfloodlightvisit_fixturetypeid',$GLOBALS{'sfmfloodlightvisit_fixturetypeid'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("5");BTXT("Floodlight Qty");B_COL();
    BCOLXS("7");BINTXTIDCLASS ("sfmfloodlightvisit_fixtureqty",'static',"sfmfloodlightvisit_fixtureqty",$GLOBALS{'sfmfloodlightvisit_fixtureqty'});B_COL();
    B_ROW();     
    BROW();
    BCOLXS("5");BTXT("Not Working");B_COL();
    BCOLXS("7");BINTXTID ("sfmfloodlightvisit_lampnotworking","sfmfloodlightvisit_lampnotworking",$GLOBALS{'sfmfloodlightvisit_lampnotworking'});B_COL();
    B_ROW();  
    BROW();
    BCOLXS("5");BTXT("Wattage");B_COL();
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightlamptype","sfmfloodlightlamptype_id","sfmfloodlightlamptype_name","sfmfloodlightlamptype_id","","" );
    BCOLXS("7");BINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_lamptypeid','static','sfmfloodlightvisit_lamptypeid',$GLOBALS{'sfmfloodlightvisit_lamptypeid'});B_COL();
    B_ROW(); 
    BROW();
    BCOLXS("5");BTXT("Manufacturer");B_COL();
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLXS("7");BINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_fixturemanufacturerid','static','sfmfloodlightvisit_fixturemanufacturerid',$GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("5");BTXT("Fixture Installed");B_COL();
    BCOLXS("7");BINDATEIDCLASS('sfmfloodlightvisit_fixtureinstalldate','sfmfloodlightvisit_fixtureinstalldate_dd/mm/yyyy','static',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'}),'dd/mm/yyyy');B_COL();
    B_ROW();
    BROW();
    BCOLXS("5");BTXT("Column Qty");B_COL();
    BCOLXS("7");BINTXTIDCLASS ("sfmfloodlightvisit_columnqty",'static',"sfmfloodlightvisit_columnqty",$GLOBALS{'sfmfloodlightvisit_columnqty'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("5");BTXT("Column Height");B_COL();
    BCOLXS("7");BINTXTIDCLASS ("sfmfloodlightvisit_columnheight",'static',"sfmfloodlightvisit_columnheight",$GLOBALS{'sfmfloodlightvisit_columnheight'});B_COL();
    B_ROW();    
    BROW();
    BCOLXS("5");BTXT("Column Type");B_COL();
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightcolumntype","sfmfloodlightcolumntype_id","sfmfloodlightcolumntype_name","sfmfloodlightcolumntype_id","","" );
    BCOLXS("7");BINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_columntypeid','static','sfmfloodlightvisit_columntypeid',$GLOBALS{'sfmfloodlightvisit_columntypeid'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("5");BTXT("Hoist Avail");B_COL();
    $xhash = List2Hash ("Yes,No,NA");
    BCOLXS("7");BINSELECTHASHIDCLASS ($xhash,"sfmfloodlightvisit_columnhoistavailable",'static',"sfmfloodlightvisit_columnhoistavailable",$GLOBALS{'sfmfloodlightvisit_columnhoistavailable'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("5");BTXT("Manufacturer");B_COL();
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLXS("7");BINSELECTHASHIDCLASS ($xhash,'sfmfloodlightvisit_columnmanufacturerid','static','sfmfloodlightvisit_columnmanufacturerid',$GLOBALS{'sfmfloodlightvisit_columnmanufacturerid'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("5");BTXT("Column Installed");B_COL();
    BCOLXS("7");BINDATEIDCLASS('sfmfloodlightvisit_columninstalldate','sfmfloodlightvisit_columninstalldate_dd/mm/yyyy','static',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_columninstalldate'}),'dd/mm/yyyy');B_COL();
    B_ROW();
    XBR();
    BROW();
    BCOLXS("3");BTXT("<b>Grid:</b>");B_COL();
    BCOLXS("3");BTXT("<b>Points</b>");B_COL();
    BCOLXS("3");BTXT("<b>Size</b>");B_COL();
    BCOLXS("3");BTXT("<b>Spacing</b>");B_COL();
    B_ROW();
    BROW();
    BCOLXS("3");BTXT("Length:");B_COL();
    BCOLXS("3");BINTXTID ("sfmfloodlightvisit_gridpointslength","sfmfloodlightvisit_gridpointslength",$GLOBALS{'sfmfloodlightvisit_gridpointslength'});B_COL();
    BCOLXS("3");BINTXTID ("sfmfloodlightvisit_pitchlength","sfmfloodlightvisit_pitchlength",$GLOBALS{'sfmfloodlightvisit_pitchlength'});B_COL();
    BCOLXS("3");BINTXTID ("sfmfloodlightvisit_gridsizelength","sfmfloodlightvisit_gridsizelength",$GLOBALS{'sfmfloodlightvisit_gridsizelength'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("3");BTXT("Width:");B_COL();
    BCOLXS("3");BINTXTID ("sfmfloodlightvisit_gridpointswidth","sfmfloodlightvisit_gridpointswidth",$GLOBALS{'sfmfloodlightvisit_gridpointswidth'});B_COL();
    BCOLXS("3");BINTXTID ("sfmfloodlightvisit_pitchwidth","sfmfloodlightvisit_pitchwidth",$GLOBALS{'sfmfloodlightvisit_pitchwidth'});B_COL();
    BCOLXS("3");BINTXTID ("sfmfloodlightvisit_gridsizewidth","sfmfloodlightvisit_gridsizewidth",$GLOBALS{'sfmfloodlightvisit_gridsizewidth'});B_COL();
    B_ROW();

    XBR();
    BROW();
    BCOLXS("5");XINBUTTONIDCLASSSPECIAL ("DimDivBackButton","AppNavButton","primary","Back");B_COL();
    BCOLXS("7");XINBUTTONIDCLASSSPECIAL ("DimDivNextButton","AppNavButton","primary","Next");B_COL();
    B_ROW(); 
    XBR();XBR();
    X_DIV("DimDiv");
    
    XDIV("GridDiv","");
 
    // setup column maps
    $columnmaplist = "1,11";
    $colnumleft = "4,3";
    $colnumright = "1,2";
    if ($GLOBALS{'sfmfloodlightvisit_columnqty'} == 4) {
        $columnmaplist = "1,11";
        $colnumleft = "4,3";
        $colnumright = "1,2";
    }
    if ($GLOBALS{'sfmfloodlightvisit_columnqty'} == 6) {
        $columnmaplist = "1,6,11";
        $colnumleft = "6,5,4";
        $colnumright = "1,2,3";
    }
    if ($GLOBALS{'sfmfloodlightvisit_columnqty'} == 8) {
        $columnmaplist = "1,4,8,11";
        $colnumleft = "8,7,6,5";
        $colnumright = "1,2,3,4";
    }
    $columnmaplefta = Array();
    $columnmaprighta = Array();
    $columnnumlefta = explode(',',$colnumleft);
    $columnnumrighta = explode(',',$colnumright);
    $columnmaplista = explode(',',$columnmaplist);
    $ri = 0;
    foreach ($columnmaplista as $colrow) {
        $columnmaplefta[intval($colrow)] = $columnnumlefta[$ri];
        $columnmaprighta[intval($colrow)] = $columnnumrighta[$ri];
        $ri++;
    }
    
    $luxgridresultsa = Array();
    if ( $GLOBALS{'sfmfloodlightvisit_gridluxresults'} != "" ) {
        $luxgridresultsa = List2Array($GLOBALS{'sfmfloodlightvisit_gridluxresults'});
    } else {
        $sep = "";
        for ($gi=0; $gi<89; $gi++) {
            array_push($luxgridresultsa,"0");
            $GLOBALS{'sfmfloodlightvisit_gridluxresults'} = $GLOBALS{'sfmfloodlightvisit_gridluxresults'}.$sep."0"; $sep =",";
        }
    }
    
    XINHIDID('sfmfloodlightvisit_gridluxresults','sfmfloodlightvisit_gridluxresults',$GLOBALS{'sfmfloodlightvisit_gridluxresults'});
    // XDIV("GridPitchOuter","GridPitchOuter");
    XDIV("GridPitch","GridPitch");
    // XBR();
    //==== Top Row =====
    $li=0;
    $wi=0;
    $linn = substr("00".$li,-2);
    $winn = substr("00".$wi,-2);
    XDIV("S".$linn.$winn,"GridCLSide");
    $icontext = '<img src="../site_assets/roundel.png" width="10px" height="10px">';
    XTXT("");
    X_DIV("S".$linn.$winn);
    for ($wi=1; $wi<9; $wi++) {       
        $linn = substr("00".$li,-2);
        $winn = substr("00".$wi,-2);
        XDIV("S".$linn.$winn,"GridTBSide");
        XTXT("");
        X_DIV("S".$linn.$winn);
    }
    $wi=9;
    $linn = substr("00".$li,-2);
    $winn = substr("00".$wi,-2);
    XDIV("S".$linn.$winn,"GridCRSide");
    XTXT("");
    X_DIV("S".$linn.$winn);
    //==== Main Rows =====
    $gi = 0;
    for ($li=1; $li<12; $li++) {
        $wi=0;
        $linn = substr("00".$li,-2);
        $winn = substr("00".$wi,-2);
        XDIV("S".$linn.$winn,"GridLSide");
        if (array_key_exists($li, $columnmaplefta)) {
            $icontext = '<img src="../site_assets/NumSquare'.$columnmaplefta[$li].'.png" width="20px" height="20px">';
        } else {
            if ((($li == 5)||($li == 7))&&($GLOBALS{"sfmground_dugoutposition"} == "Left")) {
                $icontext = '<img src="../site_assets/dugout.png" width="20px" height="20px">';
            } else {
                $icontext = '';
            }
        }
        XTXT($icontext);
        X_DIV("S".$linn.$winn);
        for ($wi=1; $wi<9; $wi++) {
            $linn = substr("00".$li,-2);
            $winn = substr("00".$wi,-2);
            XDIV("G".$linn.$winn,"GridSquare");
            XTXT($luxgridresultsa[$gi]);
            $gi++;
            X_DIV("G".$linn.$winn);
        }
        $wi=9;
        $linn = substr("00".$li,-2);
        $winn = substr("00".$wi,-2);
        XDIV("S".$linn.$winn,"GridRSide");
        if (array_key_exists($li, $columnmaplefta)) {
            $icontext = '<img src="../site_assets/NumSquare'.$columnmaprighta[$li].'.png" width="20px" height="20px">';
        } else {
            if ((($li == 5)||($li == 7))&&($GLOBALS{"sfmground_dugoutposition"} == "Right")) {
                $icontext = '<img src="../site_assets/dugout.png" width="20px" height="20px">';
            } else {
                $icontext = '';
            }
        }
        XTXT($icontext);
        X_DIV("S".$linn.$winn);
    }
    
    //==== Bottom Row =====
    $li=12;
    $wi=0;
    $linn = substr("00".$li,-2);
    $winn = substr("00".$wi,-2);
    XDIV("S".$linn.$winn,"GridCLSide");
    XTXT("");
    X_DIV("S".$linn.$winn);
    for ($wi=1; $wi<9; $wi++) {
        $linn = substr("00".$li,-2);
        $winn = substr("00".$wi,-2);
        XDIV("S".$linn.$winn,"GridTBSide");
        if (array_key_exists($li, $columnmaprighta)) {
            $icontext = "&nbsp;".'<img src="../site_assets/NumSquare'.$columnmaprighta[$li].'.png" width="20px" height="20px">';
        } else {
            if ((($li == 5)||($li == 7))&&($GLOBALS{"sfmground_dugoutposition"} == "Left")) {
                $icontext = '<img src="../site_assets/dugout.png" width="15px" height="15px">';
            } else {
                $icontext = '';
            }
        }
        XTXT($icontext);
        X_DIV("S".$linn.$winn);
    } 
    $wi=9;
    $linn = substr("00".$li,-2);
    $winn = substr("00".$wi,-2);
    XDIV("S".$linn.$winn,"GridCRSide");
    XTXT("");
    X_DIV("S".$linn.$winn);
    
    X_DIV("GridPitch");
    // X_DIV("GridPitchOuter"); 
    
    XDIV("GridNavOuter","GridNavOuter"); 
    XDIV("GridNavLeft","GridNavLeft");
    XBR();XBR();
    XINBUTTONIDCLASSSPECIAL ("GridDivEnterButton","GridAppNavButton","warning","Enter");
    XBR();XBR();XBR();
    XINBUTTONIDCLASSSPECIAL ("GridDivBackButton","GridAppNavButton","primary","Back");    
    X_DIV("GridNavLeft");

    XDIV("GridNavCenter","GridNavCenter");
    XBR();
    $buttstyle = "info";
    XINBUTTONIDCLASSSPECIAL ("GN_1","GridNumButton",$buttstyle,"1");
    XINBUTTONIDCLASSSPECIAL ("GN_2","GridNumButton",$buttstyle,"2");
    XINBUTTONIDCLASSSPECIAL ("GN_3","GridNumButton",$buttstyle,"3");
    XINBUTTONIDCLASSSPECIAL ("GN_4","GridNumButton",$buttstyle,"4");
    XINBUTTONIDCLASSSPECIAL ("GN_5","GridNumButton",$buttstyle,"5");
    XINBUTTONIDCLASSSPECIAL ("GN_6","GridNumButton",$buttstyle,"6");
    XINBUTTONIDCLASSSPECIAL ("GN_7","GridNumButton",$buttstyle,"7");
    XINBUTTONIDCLASSSPECIAL ("GN_8","GridNumButton",$buttstyle,"8");
    XINBUTTONIDCLASSSPECIAL ("GN_9","GridNumButton",$buttstyle,"9");
    XINBUTTONIDCLASSSPECIAL ("GN_C","GridNumButton",$buttstyle,"C");
    XINBUTTONIDCLASSSPECIAL ("GN_0","GridNumButton",$buttstyle,"0");
    XINBUTTONIDCLASSSPECIAL ("GN_B","GridNumButton",$buttstyle,"B");
    X_DIV("GridNavCenter");
    
    XDIV("GridNavRight","GridNavRight");
    XBR();XBR();
    XDIV("GridReadingBox","GridReadingBox");
    XTXTID("Reading","");
    X_DIV("GridReadingBox");
    XBR();XBR();
    XINBUTTONIDCLASSSPECIAL ("GridDivNextButton","GridAppNavButton","primary","Next");
    X_DIV("GridNavRight");
    X_DIV("GridNavOuter"); 

    X_DIV("GridDiv");
    
    
    XDIV("ResDiv","");
    
        XDIV("HeatMapOuter","HeatMapOuter");
        XDIV("HeatMap","HeatMap");
        
        print '<canvas id="myCanvas" width="249" height="415"'."\n";
        print 'style="border:1px solid #c3c3c3;">'."\n";
        print '</canvas>'."\n";
        
        X_DIV("HeatMap");
        X_DIV("HeatMapOuter");
        XCLEARFLOAT ();
        
        if ( $GLOBALS{'sfmfloodlightvisit_avgluxreqd'} == 0 ) { $GLOBALS{'sfmfloodlightvisit_avgluxreqd'} = 120; }
        if ( $GLOBALS{'sfmfloodlightvisit_minmaxluxreqd'} == 0 ) { $GLOBALS{'sfmfloodlightvisit_minmaxluxreqd'} = 0.25; }

        XDIV("ResData","");
        BROW();
        BCOLXS("3"); BTXT("Target Av"); B_COL();
        BCOLXS("3"); BINTXTID ("sfmfloodlightvisit_avgluxreqd","sfmfloodlightvisit_avgluxreqd",D82ToN80($GLOBALS{'sfmfloodlightvisit_avgluxreqd'})); B_COL();
        BCOLXS("3"); BTXT("Actual Av"); B_COL();
        // BCOLXS("3"); BINTXTID ("sfmfloodlightvisit_avglux","sfmfloodlightvisit_avglux",D82ToN80($GLOBALS{'sfmfloodlightvisit_avglux'})); B_COL();
        BCOLXS("3"); BINTXTIDCOLOR("sfmfloodlightvisit_avglux","sfmfloodlightvisit_avglux",D82ToN80($GLOBALS{'sfmfloodlightvisit_avglux'}),"white","black"); B_COL();
        B_ROW(); 
        BROW();
        BCOLXS("3"); BTXT("Tgt Min/Max"); B_COL();
        BCOLXS("3"); BINTXTID ("sfmfloodlightvisit_minmaxluxreqd","sfmfloodlightvisit_minmaxluxreqd",$GLOBALS{'sfmfloodlightvisit_minmaxluxreqd'}); B_COL();
        BCOLXS("3"); BTXT("Act Min/Max"); B_COL();
        // BCOLXS("3"); BINTXTID ("sfmfloodlightvisit_minmaxlux","sfmfloodlightvisit_minmaxlux",$GLOBALS{'sfmfloodlightvisit_minmaxlux'}); B_COL();
        BCOLXS("3"); BINTXTIDCOLOR("sfmfloodlightvisit_minmaxlux","sfmfloodlightvisit_minmaxlux",D82ToN80($GLOBALS{'sfmfloodlightvisit_minmaxlux'}),"white","black"); B_COL();
        B_ROW(); 
        BROW();
        BCOLXS("3"); BTXT("Min"); B_COL();
        BCOLXS("3"); BINTXTID ("sfmfloodlightvisit_minlux","sfmfloodlightvisit_minlux",D82ToN80($GLOBALS{'sfmfloodlightvisit_minlux'})); B_COL();
        BCOLXS("3"); BTXT("Max"); B_COL();
        BCOLXS("3"); BINTXTID ("sfmfloodlightvisit_maxlux","sfmfloodlightvisit_maxlux",D82ToN80($GLOBALS{'sfmfloodlightvisit_maxlux'})); B_COL();
        B_ROW(); 
        BROW();
        BCOLXS("3"); BTXT("Uniformity"); B_COL();
        BCOLXS("3"); BINTXTID ("sfmfloodlightvisit_minavglux","sfmfloodlightvisit_minavglux",$GLOBALS{'sfmfloodlightvisit_minavglux'}); B_COL();
        BCOLXS("3"); BTXT("CV"); B_COL();
        BCOLXS("3"); BINTXTID ("sfmfloodlightvisit_cv","sfmfloodlightvisit_cv",$GLOBALS{'sfmfloodlightvisit_cv'}); B_COL();
        B_ROW(); 
        BROW();
        BCOLXS("3"); BTXT("Deviation"); B_COL();
        BCOLXS("3"); BINTXTID ("sfmfloodlightvisit_deviation","sfmfloodlightvisit_deviation",D82ToN80($GLOBALS{'sfmfloodlightvisit_deviation'})); B_COL();
        BCOLXS("3"); BTXT(""); B_COL();
        BCOLXS("3");BTXT("");B_COL();        
        B_ROW();
        XBR();
        BROW();
        BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("ResDivBackButton","AppNavButton","primary","Back");B_COL();
        BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("ResDivNextButton","AppNavButton","primary","Next");B_COL();
        B_ROW();
        XBR();XBR();
        X_DIV("ResData");

    X_DIV("ResDiv");
    
    XDIV("DecisionDiv","");
        XBR();
        BROW();
        BCOLXS("4");BTXT("Decision");B_COL();
        $passfail = "0";
        if ( $GLOBALS{'sfmfloodlightvisit_reviewerdecision'} == "Fail") {
            BCOLXS("8");
            // XINBUTTONIDCLASSSPECIAL ("PassFailButton","PassFailButton","danger","Fail");
            BINTXTIDCOLOR ("PassFailButton","PassFailButton","Fail","Red","black");
            XINHID("sfmfloodlightvisit_reviewerdecision","Fail"); 
            B_COL();
            $passfail = "1";
        }
        if ( $GLOBALS{'sfmfloodlightvisit_reviewerdecision'} == "Pass") {
            BCOLXS("8");
            // XINBUTTONIDCLASSSPECIAL ("PassFailButton","PassFailButton","success","Pass");
            BINTXTIDCOLOR ("PassFailButton","PassFailButton","Pass","green","black");
            XINHID("sfmfloodlightvisit_reviewerdecision","Pass"); 
            B_COL();
            $passfail = "1";
        }
        if ( $passfail == "0") {
            BCOLXS("8");
            // XINBUTTONIDCLASSSPECIAL ("PassFailButton","PassFailButton","indo","Not Yet Determined");
            BINTXTIDCOLOR ("PassFailButton","PassFailButton","Not Yet Determined","silver","black");
            XINHID("sfmfloodlightvisit_reviewerdecision",""); 
            B_COL();
            $passfail = "1";
        }
        B_ROW();
        XBR();
        
        BROW(); BCOLXS("12");BTXT("<b>Uniformity and Avg Lux</b>");B_COL(); B_ROW();
        BROW(); BCOLXS("12");BINTEXTAREA ("sfmfloodlightvisit_luxcomments",$GLOBALS{'sfmfloodlightvisit_luxcomments'},"6");B_COL(); B_ROW();
        XBR();
        
        XHR();
        BROW(); BCOLXS("12");BTXT("<b>General Condition</b>");B_COL(); B_ROW();
        BCOLXS("6");BINSELECTHASHIDCLASS (List2Hash("Good,Fair,Poor"),'sfmfloodlightvisit_generalconditionrag','rag','sfmfloodlightvisit_generalconditionrag',$GLOBALS{'sfmfloodlightvisit_generalconditionrag'});B_COL();
        XBR();XBR();
        BROW(); BCOLXS("12");BTXT("<b>General Condition/Comments</b>");B_COL(); B_ROW();
        BROW(); BCOLXS("12");BINTEXTAREA ("sfmfloodlightvisit_conditioncomments",$GLOBALS{'sfmfloodlightvisit_conditioncomments'},"6");B_COL(); B_ROW();
        XBR();
        
        BROW();
        BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("DecisionDivBackButton","AppNavButton","primary","Back");B_COL();
        BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("DecisionDivNextButton","AppNavButton","primary","Next");B_COL();
        B_ROW();
        XBR();XBR();
    X_DIV("DecisionDiv");
    
    XDIV("SigDiv","");
      
        XBR();
        BROW(); BCOLXS("12");BTXTID("ReviewerSignatureHeader","Reviewer Signature - ".$GLOBALS{'sfmfloodlightvisit_reviewername'});B_COL(); B_ROW();
        // BROW(); BCOLXS("12");BINTEXTAREA ("sfmfloodlightvisit_reviewersignature",$GLOBALS{'sfmfloodlightvisit_reviewersignature'},"6");B_COL(); B_ROW();
        XINHIDID(sfmfloodlightvisit_reviewersignature,sfmfloodlightvisit_reviewersignature,$GLOBALS{'sfmfloodlightvisit_reviewersignature'});
        print '<div id="sfmfloodlightvisit_reviewersignature_signatureparent" class="signatureparent">'."\n";
        print '<div id="sfmfloodlightvisit_reviewersignature_signature" class="signature"></div>'."\n";
        print '</div>'."\n";
        BROW();
        BCOLXS("3");BINBUTTONIDSPECIALICONBEFORE("sfmfloodlightvisit_reviewersignature_siglockbutton","info","UnLock","unlock");B_COL();
        BCOLXS("3");XINBUTTONIDSPECIAL ("sfmfloodlightvisit_reviewersignature_sigclearbutton","warning","Clear");B_COL();
        B_ROW();
        XBR();

        BROW(); BCOLXS("12");BTXTID("ClubrepSignatureHeader","Club Signature - ".$GLOBALS{'sfmfloodlightvisit_clubrepname'});B_COL(); B_ROW();
        // BROW(); BCOLXS("12");BINTEXTAREA ("sfmfloodlightvisit_clubrepsignature",$GLOBALS{'sfmfloodlightvisit_clubrepsignature'},"6");B_COL(); B_ROW();
        XINHIDID(sfmfloodlightvisit_clubrepsignature,sfmfloodlightvisit_clubrepsignature,$GLOBALS{'sfmfloodlightvisit_clubrepsignature'});
        print '<div id="sfmfloodlightvisit_clubrepsignature_signatureparent" class="signatureparent">'."\n";
        print '<div id="sfmfloodlightvisit_clubrepsignature_signature" class="signature"></div>'."\n";
        print '</div>'."\n"; 
        BROW();
        BCOLXS("3");BINBUTTONIDSPECIALICONBEFORE("sfmfloodlightvisit_clubrepsignature_siglockbutton","info","UnLock","unlock");B_COL();
        BCOLXS("2");XINBUTTONIDSPECIAL ("sfmfloodlightvisit_clubrepsignature_sigclearbutton","warning","Clear");B_COL();
        B_ROW();
        XBR();
        BROW();
        BCOLXS("4");BTXT("End Time");B_COL();
        BCOLXS("8");BINTXTID ("sfmfloodlightvisit_endtime","sfmfloodlightvisit_endtime",$GLOBALS{'sfmfloodlightvisit_endtime'});B_COL();
        B_ROW();
        XBR();
        BROW();
        BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("SigDivBackButton","AppNavButton","primary","Back");B_COL();
        BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("SigDivNextButton","AppNavButton","primary","Next");B_COL();
        B_ROW();
        XBR();
        BROW();
        BCOLXS("12");XINBUTTONIDCLASSSPECIAL ("SigDivSaveButton","AppNavButton","success","Quick Save");B_COL();
        B_ROW();
        
    X_DIV("SigDiv");
    
    XDIV("ImgDiv","");
    if ( $GLOBALS{'sfmfloodlightvisit_image1caption'} == "" ) { $GLOBALS{'sfmfloodlightvisit_image1caption'} = "General View"; }
    /*
     BROW();
     BCOLXS("4"); BTXT('Caption');B_COL();
     BCOLXS("8"); BINTXTID('sfmfloodlightvisit_image1caption','sfmfloodlightvisit_image1caption',$GLOBALS{'sfmfloodlightvisit_image1caption'});B_COL();
     B_ROW();
     */
    XBR();
    BROW();
    BCOLXS("12");
    XINHID("sfmfloodlightvisit_image1",$GLOBALS{'sfmfloodlightvisit_image1'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfloodlightvisit_image1";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfloodlightvisit_image1'};
    $imageuploadto = "FloodVisit";
    $imageuploadid = $GLOBALS{'sfmfloodlightvisit_id'}."Image1";
    $imageuploadwidth = "800";
    $imageuploadheight = "500";
    $imageuploadfixedsize = "800x500";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    B_COL();
    B_ROW();
    XHR();
    if ( $GLOBALS{'sfmfloodlightvisit_image2caption'} == "" ) { $GLOBALS{'sfmfloodlightvisit_image2caption'} = "General View"; }
    /*
     BROW();
     // BCOLXS("4"); BTXT('Caption');B_COL();
     BCOLXS("8"); BINTXTID('sfmfloodlightvisit_image2caption','sfmfloodlightvisit_image2caption',$GLOBALS{'sfmfloodlightvisit_image2caption'});B_COL();
     B_ROW();
     */
    BROW();
    BCOLXS("12");
    XINHID("sfmfloodlightvisit_image2",$GLOBALS{'sfmfloodlightvisit_image2'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfloodlightvisit_image2";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfloodlightvisit_image2'};
    $imageuploadto = "FloodVisit";
    $imageuploadid  = $GLOBALS{'sfmfloodlightvisit_id'}."Image2";
    $imageuploadwidth = "800";
    $imageuploadheight = "500";
    $imageuploadfixedsize = "800x500";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    B_COL();
    B_ROW();
    
    XHR();
    BROW();
    BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("ImgDivBackButton","AppNavButton","primary","Back");B_COL();
    BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("ImgDivNextButton","AppNavButton","primary","Next");B_COL();
    B_ROW();
    XBR();
    BROW();
    BCOLXS("12");XINBUTTONIDCLASSSPECIAL ("ImgDivSaveButton","AppNavButton","success","Quick Save");B_COL();
    B_ROW();
    XBR();XBR();
    X_DIV("ImgDiv");
    
    XDIV("NotesDiv","");
    XBR();

    BROW();
    BCOLXS("4");BTXT("Band");B_COL();
    BCOLXS("8");
    BINRADIOHASHINLINE(list2hash("A,B,C"),'sfmfloodlightvisit_reviewerrectificationcostband',$GLOBALS{'sfmfloodlightvisit_reviewerrectificationcostband'});
    B_COL();
    B_ROW();
    XBR();
    BROW();
    BCOLXS("4");BTXT("Required Rectifications");B_COL();
    BCOLXS("8");
    $xhash = Array();
    $sfmrectificationtypea = Get_Array("sfmrectificationtype");
    foreach ($sfmrectificationtypea as $sfmrectificationtype_id) {
        Get_Data("sfmrectificationtype",$sfmrectificationtype_id);
        $cost = ""; $estimatetext = "";
        if ( $GLOBALS{'sfmfloodlightvisit_reviewerrectificationcostband'} == "A") { $cost = $GLOBALS{'sfmrectificationtype_costbanda'}; }
        if ( $GLOBALS{'sfmfloodlightvisit_reviewerrectificationcostband'} == "B") { $cost = $GLOBALS{'sfmrectificationtype_costbanda'}; }
        if ( $GLOBALS{'sfmfloodlightvisit_reviewerrectificationcostband'} == "B") { $cost = $GLOBALS{'sfmrectificationtype_costbanda'}; }
        if ( $cost != "") ( $estimatetext =  " - Estimate &pound;".$cost);
        $xhash[$sfmrectificationtype_id] = $GLOBALS{'sfmrectificationtype_title'}.$estimatetext;
    }
    BINCHECKBOXHASH ($xhash,'sfmfloodlightvisit_reviewerrectificationsreqd',$GLOBALS{'sfmfloodlightvisit_reviewerrectificationsreqd'});
    B_COL();
    B_ROW();
    XHR();
    
    BROW();BCOLXS("12");BTXT("<b>Condition</b>");B_COL(); B_ROW();
    XBR();
    BROW();
    BCOLXS("2");BTXT("Col");B_COL();
    BCOLXS("4");BINSELECTHASHIDCLASS (List2Hash("Red,Amber,Green"),'sfmfloodlightvisit_columnrag','rag','sfmfloodlightvisit_columnrag',$GLOBALS{'sfmfloodlightvisit_columnrag'});B_COL();
    BCOLXS("2");BTXT("Fix");B_COL();
    BCOLXS("4");BINSELECTHASHIDCLASS (List2Hash("Red,Amber,Green"),'sfmfloodlightvisit_fixturerag','rag','sfmfloodlightvisit_fixturerag',$GLOBALS{'sfmfloodlightvisit_fixturerag'});B_COL();
    B_ROW();
    BROW();
    BCOLXS("2");BTXT("Elec");B_COL();
    BCOLXS("4");BINSELECTHASHIDCLASS (List2Hash("Red,Amber,Green"),'sfmfloodlightvisit_electricsrag','rag','sfmfloodlightvisit_electricsrag',$GLOBALS{'sfmfloodlightvisit_electricsrag'});B_COL();
    BCOLXS("2");BTXT("Spill");B_COL();
    BCOLXS("4");BINSELECTHASHIDCLASS (List2Hash("Red,Amber,Green"),'sfmfloodlightvisit_spillluxrag','rag','sfmfloodlightvisit_spillluxrag',$GLOBALS{'sfmfloodlightvisit_spillluxrag'});B_COL();
    B_ROW();
    XHR();
    
    BROW();
    BCOLXS("6");BTXT("Additional Notes","6");B_COL();
    B_ROW();
    BROW(); BCOLXS("12");BINTEXTAREA ("sfmfloodlightvisit_notes",$GLOBALS{'sfmfloodlightvisit_notes'},"5");B_COL(); B_ROW();
    XBR();
    BROW();
    BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("NotesDivBackButton","AppNavButton","primary","Back");B_COL();
    BCOLXS("6");XINBUTTONIDCLASSSPECIAL ("NotesDivFinishButton","AppNavButton","success","Finish");B_COL();
    B_ROW();
    XBR();XBR();
    X_DIV("NotesDiv");
    
    X_FORM();
    XTXTID("TRACETEXT","");
    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function D82ToN80 ($numin) {
    if (is_string($numin)) { $numin = floatval($numin); }
    return number_format($numin);
}

function SFM_ClubRegistration_Output () {
    XH2("Club Registration");
    XPTXT("Please enter the registration group and key you received.");
    XFORM("sfmclubregistrationin.php","sfmclubregistration");
    XINSTDHID();
    XH3("Registration Group");
    XINTXT("sfmset_id", "", "30", "80"  );
    XH3("Registration Key");
    XINTXT("sfmset_clubregistrationkey", "", "30", "80"  );
    XBR();XBR();
    XINSUBMIT("Submit");
    X_FORM();
}

function SFM_ClubRegistrationCompletion_Output ($sfmset_id) {
    XH2("Club Registration");
    XPTXT("Please provide us with some information to help set up your club.");
    XFORM("sfmclubregistrationcompletionin.php","clubregistration");
    XINSTDHID();
    XINHID("sfmset_id",$sfmset_id);
    XH3("Club Details");
    XTABLE();
    XTR();XTDTXT("Club Name<br>e.g. Easthampton Football Club");XTDINTXT("sfmclub_name","","50","80");X_TR();
    XTR();XTDTXT("Organisation Shortcode<br>e.g. EasthamptonFC");XTDINTXT("sfmclub_id","","25","50");X_TR();
    X_TABLE();
    
    XH3("Club Administrator Contact Details");
    XPTXT("You will be able to add additional club contacts later");
    XTABLE();
    XTR();XTDTXT("First Name");XTDINTXT("person_fname","","25","50");X_TR();
    XTR();XTDTXT("Inits");XTDINTXT("person_tinits","","25","50");X_TR();
    XTR();XTDTXT("Surname");XTDINTXT("person_sname","","25","50");X_TR();
    XTR();XTDTXT("House and Street");XTDINTXT("person_addr1","","25","50");X_TR();
    XTR();XTDTXT("Town");XTDINTXT("person_addr2","","25","50");X_TR();
    XTR();XTDTXT("State/County");XTDINTXT("person_addr3","","25","50");X_TR();
    XTR();XTDTXT("Country");XTDINTXT("person_addr4","","25","50");X_TR();
    XTR();XTDTXT("Post Code/ZIP");XTDINTXT("person_postcode","","25","50");X_TR();
    XTR();XTDTXT("Mobile Number");XTDINTXT("person_mobiletel","","25","50");X_TR();
    XTR();XTDTXT("Email");XTDINTXT("person_email1","","25","50");X_TR();
    X_TABLE();
    
    XBR();
    XINSUBMIT("Submit");
    X_FORM();
}

function SFM_SFMGROUNDVISIT_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,sfmgroundvisitupdate,accredviewlist,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm,jqdatatablesmin,report,areyousure";
}

function SFM_SFMGROUNDVISIT_Output($sfmclub_id,$sfmgroundvisit_sfmgroundid,$sfmgroundvisit_id,$currenttab) {
    
    $GLOBALS{'sfmlevel'} = 4;
    
    Get_Data('sfmclub', $sfmclub_id);
    // XH2("Pitch ".$GLOBALS{'sfmclub_groundidlist'});
    Check_Data('sfmground', $GLOBALS{'sfmclub_groundidlist'});
    if ( $sfmgroundvisit_id == "New" ) {
        Initialise_Data('sfmgroundvisit');
        $GLOBALS{'sfmgroundvisit_id'} = $GLOBALS{'currenttimestamp'};
        $sfmgroundvisit_id = $GLOBALS{'currenttimestamp'};
        $GLOBALS{'sfmgroundvisit_type'} = "GGInspection";
        $GLOBALS{'sfmgroundvisit_date'} = $GLOBALS{'currentYYYY-MM-DD'};
        $GLOBALS{'sfmgroundvisit_starttime'} = $GLOBALS{'acthh'}.":".$GLOBALS{'actmm'};
        $GLOBALS{'sfmgroundvisit_pitchlength'} = $GLOBALS{'sfmground_pitchlength'};
        $GLOBALS{'sfmgroundvisit_pitchwidth'} = $GLOBALS{'sfmground_pitchwidth'};
        $GLOBALS{'sfmgroundvisit_pitchorientation'} = $GLOBALS{'sfmground_pitchorientation'};
        $GLOBALS{'sfmgroundvisit_dugoutposition'} = $GLOBALS{'sfmground_dugoutposition'};
        $GLOBALS{'sfmgroundvisit_sfmpitchtypeid'} = $GLOBALS{'sfmground_sfmpitchtypeid'};
        $GLOBALS{'sfmgroundvisit_gradingtarget'} = $GLOBALS{'sfmground_gradingtarget'};
        
        // initialise inspection stats with self assessment stats
        $accredcriteriaa = Get_Array("accredcriteria",$GLOBALS{'sfmground_gradingtarget'},$GLOBALS{'sfmclub_groundidlist'});
        foreach ($accredcriteriaa as $accredcriteria_id) {
            Get_Data("accredcriteria",$GLOBALS{'sfmground_gradingtarget'},$GLOBALS{'sfmclub_groundidlist'},$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id,"orange");
            if ($GLOBALS{'accredcriteria_type'} == "data") { 
                $GLOBALS{'accredcriteria_inspectiondataradioresult'} = $GLOBALS{'accredcriteria_dataradioresult'};
                $GLOBALS{'accredcriteria_inspectiondatacheckboxresult'} = $GLOBALS{'accredcriteria_datacheckboxresult'};
                $GLOBALS{'accredcriteria_inspectiondatatextresult'} = $GLOBALS{'accredcriteria_datatextresult'};
            }
            Write_Data("accredcriteria",$GLOBALS{'sfmground_gradingtarget'},$GLOBALS{'sfmclub_groundidlist'},$accredcriteria_id);
        }
        
        Write_Data('sfmgroundvisit', $sfmgroundvisit_sfmgroundid, $sfmgroundvisit_id);
    } else {
        Check_Data('sfmgroundvisit', $sfmgroundvisit_sfmgroundid, $sfmgroundvisit_id);
    }
    
    $headingtext = $GLOBALS{'sfmground_name'}." - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmgroundvisit_date'});
    XH2("Ground Grading Inspection - ".$headingtext);
    
    XFORMUPLOAD("sfmgroundvisitupdatein.php","sfmgroundvisitupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmgroundvisit_sfmgroundid",$sfmgroundvisit_sfmgroundid);
    XINHID("sfmgroundvisit_id",$sfmgroundvisit_id);
    XINHID("sfmgroundvisit_gradingtarget",$GLOBALS{'sfmgroundvisit_gradingtarget'});
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});
    XINHID("GroundGradingChanged","");
    XINHID("SubmitAction","");
    XINHID("CurrentTab",$currenttab);
    
    $GLOBALS{'CROPPARMS'} = Array();
    
    BROW();
    BCOLTXT("","9");
    BCOL("2");
    if ( $GLOBALS{'sfmlevel'} > 2 ) {	BINBUTTONIDSPECIAL("Save","primary","Save"); }
    BINBUTTONIDSPECIAL("Close","warning","Close"); XBR(); XBR();
    B_COL();
    B_ROW();
    
    BROW();
    BCOLTXT("","6");
    BCOL("2"); BIMGID("mpdfreports","../site_assets/MPDFRelevantReports.png","50"); B_COL();
    B_ROW();
    XBR();
    if ($currenttab == "") { $currenttab = "GVISIT"; }
    BTABHEADERCONTAINER();
    if ($currenttab=="GVISIT") {BTABHEADERITEMACTIVE("GVISIT","Inspection Details");} else {BTABHEADERITEM("GVISIT","Inspection Details");}
    if ($currenttab=="GVISITGGRAD") {BTABHEADERITEMACTIVE("GVISITGGRAD","Ground Grading Checksheet");} else {BTABHEADERITEM("GVISITGGRAD","Ground Grading Checksheet");}
    if ($currenttab=="GVISITASSESSMENT") {BTABHEADERITEMACTIVE("GVISITASSESSMENT","Assessment");} else {BTABHEADERITEM("GVISITASSESSMENT","Assessment");}
    if ($currenttab=="GVISITCONDITION") {BTABHEADERITEMACTIVE("GVISITCONDITION","Condition");} else {BTABHEADERITEM("GVISITCONDITION","Condition");}
    if ($currenttab=="GVISITIMAGES") {BTABHEADERITEMACTIVE("GVISITIMAGES","Images");} else {BTABHEADERITEM("GVISITIMAGES","Images");}
    if ($currenttab=="GVISITNOTES") {BTABHEADERITEMACTIVE("GVISITNOTES","Notes");} else {BTABHEADERITEM("GVISITNOTES","Notes");}
    B_TABHEADERCONTAINER();
    BTABCONTENTCONTAINER();
    if ($currenttab=="GVISIT") {BTABCONTENTITEMACTIVE("GVISIT");} else {BTABCONTENTITEM("GVISIT");} GVISITContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="GVISITGGRAD") {BTABCONTENTITEMACTIVE("GVISITGGRAD");} else {BTABCONTENTITEM("GVISITGGRAD");} GVISITGGRADContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="GVISITASSESSMENT") {BTABCONTENTITEMACTIVE("GVISITASSESSMENT");} else {BTABCONTENTITEM("GVISITASSESSMENT");} GVISITASSESSMENTContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="GVISITCONDITION") {BTABCONTENTITEMACTIVE("GVISITCONDITION");} else {BTABCONTENTITEM("GVISITCONDITION");} GVISITCONDITIONContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="GVISITIMAGES") {BTABCONTENTITEMACTIVE("GVISITIMAGES");} else {BTABCONTENTITEM("GVISITIMAGES");} GVISITIMAGESContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="GVISITNOTES") {BTABCONTENTITEMACTIVE("GVISITNOTES");} else {BTABCONTENTITEM("GVISITNOTES");} GVISITNOTESContentOutput(); B_TABCONTENTITEM();
    B_TABCONTENTCONTAINER();
    
    X_FORM();
    XTXTID("TRACETEXT","");
    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function GVISITContentOutput() {
    
    XBR();
    XH3("Inspection Visit Details");
    XHRCLASS('underline');
    
    BROW();
    BCOLTXT("Review Type","1");
    $xhash = Get_SelectArrays_Hash ("sfmvisittype","sfmvisittype_id","sfmvisittype_title","sfmvisittype_id","","" );
    BCOLINSELECTHASHID ($xhash,'sfmgroundvisit_type','sfmgroundvisit_type',$GLOBALS{'sfmgroundvisit_type'},"3");
    BCOLTXT("Reviewer Name","1");
    BCOLINTXTID('sfmgroundvisit_reviewername','sfmgroundvisit_reviewername',$GLOBALS{'sfmgroundvisit_reviewername'},"3");
    BCOLTXT("Reviewer Role","1");
    BCOLINTXTID('sfmgroundvisit_reviewerrole','sfmgroundvisit_reviewerrole',$GLOBALS{'sfmgroundvisit_reviewerrole'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Reviewer Tel","1");
    BCOLINTXTID('sfmgroundvisit_reviewertel','sfmgroundvisit_reviewertel',$GLOBALS{'sfmgroundvisit_reviewertel'},"3");
    BCOLTXT("Reviewer EMail","1");
    BCOLINTXTID('sfmgroundvisit_revieweremail','sfmgroundvisit_revieweremail',$GLOBALS{'sfmgroundvisit_revieweremail'},"3");
    BCOLTXT("Club Rep","1");
    BCOLINTXTID('sfmgroundvisit_clubrepname','sfmgroundvisit_clubrepname',$GLOBALS{'sfmgroundvisit_clubrepname'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Date","1");
    BCOLINDATEID('sfmgroundvisit_date','sfmgroundvisit_date_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmgroundvisit_date'}),'dd/mm/yyyy',"3");
    BCOLTXT("Start","1");
    BCOLINTXTID ("sfmgroundvisit_starttime","sfmgroundvisit_starttime",$GLOBALS{'sfmgroundvisit_starttime'},"3");
    BCOLTXT("Finish","1");
    BCOLINTXTID ("sfmgroundvisit_endtime","sfmgroundvisit_endtime",$GLOBALS{'sfmgroundvisit_endtime'},"3");
    BCOLTXT("","4");
    B_ROW();
    XHR();
    BROW();
    BCOLTXT("Club","1");
    BCOLTXT($GLOBALS{'sfmclub_name'},"3");
    BCOLTXT("League","1");
    Check_Data("sfmleague",$GLOBALS{'sfmclub_sfmleagueid'});
    BCOLTXT($GLOBALS{'sfmleague_name'},"3");
    BCOLTXT("Pitch","1");
    BCOLTXT($GLOBALS{'sfmground_name'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Address","1");
    BCOLTXT($GLOBALS{'sfmclub_addr1'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT($GLOBALS{'sfmclub_addr2'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT($GLOBALS{'sfmclub_addr3'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT($GLOBALS{'sfmclub_addr4'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT($GLOBALS{'sfmclub_postcode'},"3");
    BCOLTXT("","8");
    B_ROW();
    XBR();
    
    XHR();
    XH3("Approvals");
    BROW();
    BCOLTXT($GLOBALS{'sfmgroundvisit_reviewername'},"6");
    BCOLTXT($GLOBALS{'sfmgroundvisit_clubrepname'},"6");
    B_ROW();
    BROW();
    BCOLIMG ($GLOBALS{'sfmgroundvisit_reviewersignature'},"150","6");
    BCOLIMG ($GLOBALS{'sfmgroundvisit_clubrepsignature'},"150","6");
    B_ROW();
}

function GVISITGGRADContentOutput() {
    XBR();
    XH3("Ground Grading Checksheet");
    XHRCLASS('underline');
    XBR();
    
    $inaccredscheme_id = $GLOBALS{'sfmgroundvisit_gradingtarget'};
    $inaccredcriteria_clubid = $_REQUEST['sfmclub_id'];
    Library_ACCREDVIEWLIST_Output ($inaccredscheme_id,$inaccredcriteria_clubid,"Inspect","");
}

function GVISITASSESSMENTContentOutput() {

    XBR();
    BROW();
    BCOLTXT("","10");
    BCOL("2"); BINBUTTONIDSPECIAL("GroundGrading","info","Ground Grading"); B_COL();
    B_ROW();
    XH3("Ground Grading Assessment");
    XHRCLASS('underline');

    BROW();
    BCOLTXT("Grading Level Assessed","2");
    $keylist = ('FAGroundGradingA,FAGroundGradingB,FAGroundGradingC,FAGroundGradingD,FAGroundGradingE,FAGroundGradingF,FAGroundGradingG,FAGroundGradingH');
    $valuelist = ('A,B,C,D,E,F,G,H');
    $xhash = Lists2Hash($keylist,$valuelist);
    BCOLINSELECTHASHID ($xhash,'sfmgroundvisit_gradingtarget','sfmgroundvisit_gradingtarget',$GLOBALS{'sfmgroundvisit_gradingtarget'},"1");
    B_ROW();
    BROW();
    BCOLTXT("Grading Decision","2");
    $xhash = List2Hash('Pass,Advisory,Fail');
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmgroundvisit_reviewerdecision','rag','sfmgroundvisit_reviewerdecision',$GLOBALS{'sfmgroundvisit_reviewerdecision'},"1"); 
    B_ROW();
    XBR();
    BROWTOP();
    BCOLTXT("Decision Notes","2");
    BCOLINTEXTAREAID('sfmgroundvisit_reviewerdecisionnotes','sfmgroundvisit_reviewerdecisionnotes',$GLOBALS{'sfmgroundvisit_reviewerdecisionnotes'},"4","8");
    B_ROW();
    XBR();
   
    XHRCLASS('underline');
    XH3("Rectifications Required");
    XBR();
    // BINBUTTONIDSPECIALICON ("RefreshRectifications","success","Refresh","circle-notch");
    
    XDIV("simpletablediv_visitrectifications","visitrectificationscontainer");
    XTABLEJQDTID("simpletabletable_visitrectifications");
    XTHEAD();
    XTRJQDT();
    // XTDHTXT("Id");
    XTDHTXT("Ref");
    XTDHTXT("Topic");
    XTDHTXT("Result");
    XTDHTXT("Description");
    // XTDHTXT("Type");
    XTDHTXT("Due Date");
    XTDHTXT("Status");
    X_TR();
    X_THEAD();
    XTBODY();
     
    $sfmrectification_ida = Get_Array("sfmrectification",$GLOBALS{'sfmgroundvisit_sfmgroundid'});
    foreach ($sfmrectification_ida as $sfmrectification_id) {
        Get_Data("sfmrectification",$GLOBALS{'sfmgroundvisit_sfmgroundid'},$sfmrectification_id);
        if ($GLOBALS{'sfmrectification_source'} == "GroundVisit") {
            if ($GLOBALS{'sfmrectification_sourceid'} == $GLOBALS{'sfmgroundvisit_id'}) {
                XTRJQDT();
                // XTDTXT($GLOBALS{'sfmrectification_sourceid'});
                XTDTXT($GLOBALS{'sfmrectification_sourceref'});
                XTDTXT($GLOBALS{'sfmrectification_evidencerequirement'});
                XTDTXT($GLOBALS{'sfmrectification_inspectionresult'});
                XTDTXT($GLOBALS{'sfmrectification_inspectioncomments'});
                // XTDTXT($GLOBALS{'sfmrectification_rectificationtypeid'});
                XTDTXT($GLOBALS{'sfmrectification_duedate'});
                XTDTXT($GLOBALS{'sfmrectification_status'});
                X_TR();
            }
        }
    }

    X_TBODY();
    X_TABLE(); 
    
    X_DIV("simpletablediv_visitrectifications");
    // XINHID("visitrectifications_sortcol","0");     
    XCLEARFLOAT();
}

function GVISITCONDITIONContentOutput() {
    XBR();
    XH3("Condition of Facilities");
    XHRCLASS('underline');
    BROW();
    $xhash = List2Hash('Good,Fair,Poor');
    BCOLTXT("<b>General Condition</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmgroundvisit_generalconditionrag','rag','sfmgroundvisit_generalconditionrag',$GLOBALS{'sfmgroundvisit_generalconditionrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmgroundvisit_generalconditionragcomments','sfmgroundvisit_generalconditionragcomments',$GLOBALS{'sfmgroundvisit_generalconditionragcomments'},"4","5");
    B_ROW();
    XHRCLASS('underline');
    XH4("Specific Details");XBR();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Ground</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmgroundvisit_groundrag','rag','sfmgroundvisit_groundrag',$GLOBALS{'sfmgroundvisit_groundrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmgroundvisit_groundragcomments','sfmgroundvisit_groundragcomments',$GLOBALS{'sfmgroundvisit_groundragcomments'},"4","5");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Spectator</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmgroundvisit_spectatorrag','rag','sfmgroundvisit_spectatorrag',$GLOBALS{'sfmgroundvisit_spectatorrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmgroundvisit_spectatorragcomments','sfmgroundvisit_spectatorragcomments',$GLOBALS{'sfmgroundvisit_spectatorragcomments'},"4","5");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Dressing Rooms</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmgroundvisit_dressingroomrag','rag','sfmgroundvisit_dressingroomrag',$GLOBALS{'sfmgroundvisit_dressingroomrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmgroundvisit_dressingroomragcomments','sfmgroundvisit_dressingroomragcomments',$GLOBALS{'sfmgroundvisit_dressingroomragcomments'},"4","5");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Medical</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmgroundvisit_medicalrag','rag','sfmgroundvisit_medicalrag',$GLOBALS{'sfmgroundvisit_medicalrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmgroundvisit_medicalragcomments','sfmgroundvisit_medicalragcomments',$GLOBALS{'sfmgroundvisit_medicalragcomments'},"4","5");
    B_ROW();
    XBR();
}

function GVISITIMAGESContentOutput() {
    if ( $GLOBALS{'sfmgroundvisit_image1caption'} == "" ) { $GLOBALS{'sfmgroundvisit_image1caption'} = "General View"; }
    /*
     BROW();
     BCOLXS("4"); BTXT('Caption');B_COL();
     BCOLXS("8"); BINTXTID('sfmgroundvisit_image1caption','sfmgroundvisit_image1caption',$GLOBALS{'sfmgroundvisit_image1caption'});B_COL();
     B_ROW();
     */
    XBR();
    BROW();
    BCOL("6");
    XINHID("sfmgroundvisit_image1",$GLOBALS{'sfmgroundvisit_image1'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmgroundvisit_image1";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmgroundvisit_image1'};
    $imageuploadto = "GroundVisit";
    $imageuploadid = $GLOBALS{'sfmgroundvisit_id'}."Image1";
    $imageuploadwidth = "800";
    $imageuploadheight = "500";
    $imageuploadfixedsize = "800x500";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    B_COL();
    B_ROW();
    XHR();
    if ( $GLOBALS{'sfmgroundvisit_image2caption'} == "" ) { $GLOBALS{'sfmgroundvisit_image2caption'} = "General View"; }
    /*
     BROW();
     // BCOLXS("4"); BTXT('Caption');B_COL();
     BCOLXS("8"); BINTXTID('sfmgroundvisit_image2caption','sfmgroundvisit_image2caption',$GLOBALS{'sfmgroundvisit_image2caption'});B_COL();
     B_ROW();
     */
    BROW();
    BCOL("6");
    XINHID("sfmgroundvisit_image2",$GLOBALS{'sfmgroundvisit_image2'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmgroundvisit_image2";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmgroundvisit_image2'};
    $imageuploadto = "GroundVisit";
    $imageuploadid = $GLOBALS{'sfmgroundvisit_id'}."Image2";
    $imageuploadwidth = "800";
    $imageuploadheight = "500";
    $imageuploadfixedsize = "800x500";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
    
    B_COL();
    B_ROW();
}

function GVISITNOTESContentOutput() {
    XBR();
    XH3("Visit Notes");
    XHRCLASS('underline');
    XBR();
    BROW();
    BCOLINTEXTAREAID ('sfmgroundvisit_notes','sfmgroundvisit_notes',$GLOBALS{'sfmgroundvisit_notes'},"20","8");
    B_ROW();
    XBR();XBR();
}

function SFM_SFMGROUNDVISITDELETECONFIRM_Output($sfmclub_id,$sfmgroundvisit_sfmgroundid,$sfmgroundvisit_id) {
    Get_Data('sfmgroundvisit', $sfmgroundvisit_sfmgroundid, $sfmgroundvisit_id);
    XH3("Delete Ground Grading Visit - ".$sfmgroundvisit_sfmgroundid."/".$sfmgroundvisit_id);
    XPTXT("Are you sure you want to delete this visit");
    XBR();
    XFORM("sfmgroundvisitdeleteaction.php","deletevisit");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmgroundvisit_sfmgroundid",$sfmgroundvisit_sfmgroundid);
    XINHID("sfmgroundvisit_id",$sfmgroundvisit_id);
    XINSUBMIT("Confirm Visit Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function SFM_ACCREDCRITERIADATAUPLOAD_Output () {
    
    XH3("Accreditation Criteria Data Load");
    XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
    XFORMUPLOAD("sfmaccredcritertiadatauploadin.php","upload");
    XINSTDHID();
    XPTXT("File Containing Data:-");
    XINFILE("file","100000") ;XBR();XBR();
    XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
    XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
    XBR();
    XINSUBMIT("Upload!");
    X_FORM();
}

function SFM_SFMGROUNDGRADINGMATRIX_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function SFM_SFMGROUNDGRADINGMATRIX_Output ($insfmground_id) {
 
    XH2("Ground Grading Comparison");
    Get_Data("sfmground",$insfmground_id);
    
    $schema = Get_Array("accredscheme");
    XBR();
    XDIV("simpletablediv","container");
    XTABLEJQDTID("simpletabletable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Section");
    XTDHTXT("Ref");
    XTDHTXT("Topic");
    XTDHTXT("Data");
    XTDHTXT("Value");
    foreach ($schema as $accredscheme_id) {
        if ( $accredscheme_id == $GLOBALS{'sfmground_gradingtarget'} ) {    
            XTDTXTBACKTXTCOLOR(substr($accredscheme_id,-1),"#D1F2EB","black");
        } else {
            XTDHTXT(substr($accredscheme_id,-1));
        }
    }
    X_TR();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");
    
    $ida = Get_Array("accredcriteria","FAGroundGradingA","sfm");
    foreach ($ida as $accredcriteria_id) {
        Get_Data("accredcriteria","FAGroundGradingA","sfm",$accredcriteria_id);

        if ($GLOBALS{"accredcriteria_type"} == "section") {	
            $thisref = $GLOBALS{'accredcriteria_ref'};
            $thissection = $GLOBALS{'accredcriteria_section'};
            XTRJQDT();
            XTDTXT($thissection);
            XTDTXT("");
            XTDTXT("");
            XTDTXT("");
            XTDTXT("");
            foreach ($schema as $accredscheme_id) {
                 XTDTXT("");
            }
            X_TR();
        }

        if ($GLOBALS{"accredcriteria_type"} == "criteria") {
            $thisref = $GLOBALS{'accredcriteria_ref'};
            $thiscriteria = $GLOBALS{'accredcriteria_section'};
            $firstcriteria = "1";
        }

        if ($GLOBALS{"accredcriteria_type"} == "data") {
            $thisdatafieldtitle = $GLOBALS{'accredcriteria_datafieldtitle'};
            $thisdatafieldname = $GLOBALS{'accredcriteria_datafieldname'};
            $dbits = explode("_",$thisdatafieldname);
            $thisdatafieldvalue = "";
            if ($dbits[0] == "sfmground") {
                $thisdatafieldvalue = $GLOBALS{'sfmground_'.$dbits[1]};
            }
            XTRJQDT();
            XTDTXT("");
            if ( $firstcriteria == "1" ) {
                XTDTXT($thisref);
                XTDTXT($thiscriteria);
            } else {
                XTDTXT("");
                XTDTXT("");
            }
            $firstcriteria = "0";
            XTDTXT($thisdatafieldtitle);
            XTDTXT($thisdatafieldvalue);
            foreach ($schema as $accredscheme_id) {
                Get_Data("accredcriteria",$accredscheme_id,"sfm",$accredcriteria_id);                
                if ( $accredscheme_id == $GLOBALS{'sfmground_gradingtarget'} ) {               
                    if ($thisdatafieldvalue >= $GLOBALS{'accredcriteria_datatargetreqd'}) {
                        XTDTXTBACKTXTCOLOR($GLOBALS{'accredcriteria_datatargetreqd'},"#D1F2EB","black");
                    } else {
                        XTDTXTBACKTXTCOLOR($GLOBALS{'accredcriteria_datatargetreqd'},"#FADBD8","black");
                    }
                } else {
                    if ($thisdatafieldvalue >= $GLOBALS{'accredcriteria_datatargetreqd'}) {
                        XTDTXTBACKTXTCOLOR($GLOBALS{'accredcriteria_datatargetreqd'},"#E8F6F3","black");
                    } else {
                        XTDTXTBACKTXTCOLOR($GLOBALS{'accredcriteria_datatargetreqd'},"#FDEDEC","black");
                    }
                }
            }
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv");
    XCLEARFLOAT();
    XINHID("ScreenHeight","");
    XINHID("ScreenWidth","");   
}

function SFM_SFMGROUNDGRADINGDELETECONFIRM_Output($sfmclub_id,$accredscheme_id) {
    XH3("Delete Ground Grading Self Assessment - ".$sfmclub_id."/".$accredscheme_id);
    XPTXT("Are you sure you want to delete this groundgrading information? All self assessments and inspection comments for this level will be removed.");
    XBR();
    XFORM("sfmgroundgradingdeleteaction.php","deletegroundgrading");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("accredscheme_id",$accredscheme_id);
    XINSUBMIT("Confirm Ground Grading Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function SFM_SFMGROUNDGRADINGMANAGE_Output($sfmclub_id) {
    XH3("Ground Grading Self Assessment Management");
    $accredschemea = Get_Array('accredscheme');
    foreach ($accredschemea as $accredscheme_id) {        
        Check_Data('accredscheme',$accredscheme_id);
        Check_Data('accredcriteria',$accredscheme_id,$sfmclub_id,"a_01");
        if ($GLOBALS{'IOWARNING'} == "0" ) {
            $link = YPGMLINK("sfmgroundgradingdeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id).YPGMPARM("accredscheme_id",$accredscheme_id);
            XBR(); XLINKTXT($link,"Delete ".$GLOBALS{'accredscheme_name'}." self assessment");
        }
    }
}

?>