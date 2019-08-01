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
    $parm1 = $parm1."sfmclub_id|Yes|Club Id|120|Yes|Club Id|KeyText,35,35^";
    $parm1 = $parm1."sfmclub_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmclub_gender|Yes|Gender|50|Yes|Gender|InputRadioFromList,M[Male]+F[Female]+X[Male and Female]^";
    $parm1 = $parm1."sfmclub_sfmteamidlist|Yes|Team List|150|No|Team List|Text^";
    $parm1 = $parm1."sfmclub_sfmleagueidlist|Yes|League List|150|No|League Id|Text^";
    $parm1 = $parm1."sfmclub_sfmdivisionidlist|Yes|Division List|150|No|Division Id|Text^";
    $parm1 = $parm1."sfmclub_sfmfacilityidlist|Yes|Facilities List|150|No|Facility Ids|Text^";
    $parm1 = $parm1."sfmclub_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmclub_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmclub_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmclub_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmclub_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton^";
    $parm1 = $parm1."generic_programbutton1|Yes|Key Change|100|No|Key Change|ProgramButton,sfmkeychangeout.php,sfmclub_id,sfmclub_id,samewindow,,";
    
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

function SFM_SETUPSFMTEAM_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function SFM_SETUPSFMTEAM_Output() {
    $parm0 = "";
    $parm0 = $parm0."Team Setup"."|"; # pagetitle
    $parm0 = $parm0."sfmteam"."|"; # primetable
    $parm0 = $parm0."sfmclub,sfmleague,sfmdivision|"; # othertables
    $parm0 = $parm0."sfmteam_id|"; # keyfieldname
    $parm0 = $parm0."sfmteam_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmteam_id|Yes|Team Id|120|Yes|Team Id|KeyText,35,35^";
    $parm1 = $parm1."sfmteam_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmteam_gender|Yes|Gender|50|Yes|Gender|InputRadioFromList,M[Male]+F[Female]+X[Male and Female]^";
    $parm1 = $parm1."sfmteam_sfmclubid|Yes|Club|150|Yes|Club Id|InputSelectFromTable,sfmclub,sfmclub_id,sfmclub_name,sfmclub_id^";
    $parm1 = $parm1."sfmteam_sfmleagueid|Yes|League|150|Yes|League Id|Text^";
    $parm1 = $parm1."sfmteam_sfmdivisionid|Yes|Division|150|Yes|Division Id|InputSelectFromTable,sfmdivision,sfmdivision_id,sfmdivision_name,sfmdivision_id^";
    $parm1 = $parm1."sfmteam_sfmfacilityidlist|Yes|Facilities|150|Yes|Facility Ids|InputText,20,40^";
    $parm1 = $parm1."sfmteam_step|Yes|Step|20|Yes|Step|Text^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton^";
    $parm1 = $parm1."generic_programbutton1|Yes|Key Change|100|No|Key Change|ProgramButton,sfmkeychangeout.php,sfmteam_id,sfmteam_id,samewindow,,";    
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMFACILITY_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function SFM_SETUPSFMFACILITY_Output() {
    $parm0 = "";
    $parm0 = $parm0."Facility Setup"."|"; # pagetitle
    $parm0 = $parm0."sfmfacility"."|"; # primetable
    $parm0 = $parm0."sfmcounty|"; # othertables
    $parm0 = $parm0."sfmfacility_id|"; # keyfieldname
    $parm0 = $parm0."sfmfacility_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmfacility_id|Yes|Facility Id|120|Yes|Facility Id|KeyText,35,35^";
    $parm1 = $parm1."sfmfacility_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmfacility_sfmcountyid|Yes|County|150|Yes|County|InputSelectFromTable,sfmcounty,sfmcounty_id,sfmcounty_name,sfmcounty_id^";
    $parm1 = $parm1."sfmfacility_sfmteamidlist|Yes|Team List|150|Yes|Team Ids|Text^";
    $parm1 = $parm1."sfmfacility_sfmdivisionidlist|Yes|Division List|150|Yes|Division Ids|Text^";
    $parm1 = $parm1."sfmfacility_step|Yes|Step|150|Yes|Step|Text^";
    $parm1 = $parm1."sfmfacility_gradingtarget|Yes|Ground Grading|150|Yes|Ground Grading|Text^";
    $parm1 = $parm1."sfmfacility_ref||||Yes|PitchFinder Facility Ref|InputText,10,20^";
    $parm1 = $parm1."sfmfacility_siteref||||Yes|PitchFinder Site Ref|InputText,10,20^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Users|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton^";
    $parm1 = $parm1."generic_programbutton1|Yes|Key Change|100|No|Key Change|ProgramButton,sfmkeychangeout.php,sfmfacility_id,sfmfacility_id,samewindow,,";      
    GenericHandler_Output ($parm0,$parm1);
}

function SFM_SETUPSFMLEAGUE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function SFM_SETUPSFMLEAGUE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Leagues"."|"; # pagetitle
    $parm0 = $parm0."sfmleague"."|"; # primetable
    $parm0 = $parm0."accredscheme,person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
    $parm0 = $parm0."sfmleague_id|"; # keyfieldname
    $parm0 = $parm0."sfmleague_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmleague_id|Yes|League Id|120|Yes|League Id|KeyText,35,35^";
    $parm1 = $parm1."sfmleague_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmleague_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    $parm1 = $parm1."sfmleague_gradingtarget|Yes|Grading|120|Yes|Ground Grading Requirement|InputSelectFromTable,accredscheme,accredscheme_id,accredscheme_name,accredscheme_id^";
    $parm1 = $parm1."sfmleague_step|Yes|Step|120|Yes|Step|InputText,10,20^";    
    $parm1 = $parm1."sfmleague_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmleague_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmleague_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmleague_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmleague_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";
    $parm1 = $parm1."sfmleague_logo|Yes|Logo|30|Yes|Logo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,300,300,Logo,sfmleague_id^";
    // $parm1 = $parm1."generic_programbutton|Yes|Setup Divisions|80|No|Setup Divisions|ProgramButton,sfmdivisionsetupout.php,sfmleague_id,sfmleague_id,samewindow,,^";
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
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function SFM_SETUPSFMDIVISION_Output() {
    $parm0 = "";
    $parm0 = $parm0."Divisions "."|"; # pagetitle
    $parm0 = $parm0."sfmdivision|"; # primetable
    $parm0 = $parm0."sfmleague,accredscheme,person[returnedfields=person_domainid+person_id+person_sname+person_fname]|"; # othertables
    $parm0 = $parm0."sfmdivision_id|"; # keyfieldname
    $parm0 = $parm0."sfmdivision_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmdivision_id|Yes|Division Id|120|Yes|Division Id|KeyText,35,35^";
    $parm1 = $parm1."sfmdivision_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmdivision_sfmleagueid|Yes|League Id|120|Yes|League Id|InputSelectFromTable,sfmleague,sfmleague_id,sfmleague_name,sfmleague_id^";
    $parm1 = $parm1."sfmdivision_gender|Yes|Gender|150|Yes|Gender|InputRadioFromList,M[Male]+F[Female]+X[Male and Female]^";    
    $parm1 = $parm1."sfmdivision_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    $parm1 = $parm1."sfmdivision_gradingtarget|Yes|Grading|120|Yes|Ground Grading Requirement|InputSelectFromTable,accredscheme,accredscheme_id,accredscheme_name,accredscheme_id^";
    $parm1 = $parm1."sfmdivision_step|Yes|Step|120|Yes|Step|InputText,2,2^";
    $parm1 = $parm1."sfmdivision_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmdivision_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmdivision_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmdivision_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmdivision_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";
    $parm1 = $parm1."sfmdivision_logo||||Yes|Logo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,300,300,Logo,sfmdivision_id^";
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

function SFM_SETUPSFMOPERATOR_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function SFM_SETUPSFMOPERATOR_Output() {
    $parm0 = "";
    $parm0 = $parm0."Facilities Operators "."|"; # pagetitle
    $parm0 = $parm0."sfmoperator|"; # primetable
    $parm0 = $parm0."sfmcounty,person[returnedfields=person_domainid+person_id+person_sname+person_fname]|"; # othertables
    $parm0 = $parm0."sfmoperator_id|"; # keyfieldname
    $parm0 = $parm0."sfmoperator_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."sfmoperator_id|Yes|Operator Id|120|Yes|Operator Id|KeyText,35,35^";
    $parm1 = $parm1."sfmoperator_name|Yes|Operator Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmoperator_sfmcountyid|Yes|County Id|120|Yes|County Id|InputSelectFromTable,sfmcounty,sfmcounty_id,sfmcounty_name,sfmcounty_id^";
    $parm1 = $parm1."sfmoperator_contacttitle||||Yes|Title|InputText,10,20^";
    $parm1 = $parm1."sfmoperator_contactfname|Yes|First Name|150|Yes|First Name|InputText,50,100^";
    $parm1 = $parm1."sfmoperator_contactsname|Yes|Last Name|150|Yes|Last Name|InputText,50,100^";
    $parm1 = $parm1."sfmoperator_contactemail||||Yes|Contact Email|InputText,50,100^";
    $parm1 = $parm1."sfmoperator_contacttel||||Yes|Contact Tel|InputText,50,100^";
    $parm1 = $parm1."sfmoperator_contactmobile||||Yes|Contact Mobile|InputText,50,100^";
    $parm1 = $parm1."sfmoperator_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    $parm1 = $parm1."sfmoperator_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
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

function SFM_SETUPSFMCOUNTY_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
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
    $parm1 = $parm1."sfmcounty_id|Yes|County Id|120|Yes|County Id|KeyText,35,35^";
    $parm1 = $parm1."sfmcounty_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmcounty_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    $parm1 = $parm1."sfmcounty_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmcounty_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmcounty_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmcounty_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmcounty_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";
    $parm1 = $parm1."sfmcounty_logo|Yes|Logo|30|Yes|Logo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,300,300,Logo,sfmcounty_id^";
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
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
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
    $parm1 = $parm1."sfmngb_id|Yes|NGB Id|120|Yes|NGB Id|KeyText,35,35^";
    $parm1 = $parm1."sfmngb_name|Yes|Name|150|Yes|Name|InputText,50,100^";
    $parm1 = $parm1."sfmngb_website|Yes|Website|150|Yes|Website|InputText,50,100^";
    $parm1 = $parm1."sfmngb_adminpersonid||||Yes|Administrator|InputPersonArea,2,100,administrator,Lookup^";
    $parm1 = $parm1."sfmngb_otheradminpersonidlist||||Yes|Other Administrators|InputPersonArea,2,100,otheradministrator,Lookup^";
    $parm1 = $parm1."sfmngb_otherreadonlypersonidlist||||Yes|Other Read Only Users|InputPersonArea,2,100,otherreadonly,Lookup^";
    $parm1 = $parm1."sfmngb_floodinspectoridlist||||Yes|Floodlight Inspectors|InputPersonArea,2,100,floodinspector,Lookup^";
    $parm1 = $parm1."sfmngb_groundinspectoridlist||||Yes|Ground Grading Inspectors|InputPersonArea,2,100,groundinspector,Lookup^";
    $parm1 = $parm1."sfmngb_logo|Yes|Logo|30|Yes|Logo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,300,300,Logo,sfmngb_id^";
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
    $parm1 = $parm1."sfmvisittype_id|Yes|Visit Type|120|Yes|Visit Type|KeyText,25,25^";
    $parm1 = $parm1."sfmvisittype_title|Yes|Title|150|Yes|Title|InputText,50,100^";
    $parm1 = $parm1."sfmvisittype_description||||Yes|Description|InputText,100,200^";
    $parm1 = $parm1."sfmvisittype_type|Yes|Title|150|Yes|Type|InputSelectFromList,Flood[Floodlighting]+Ground[Ground Grading]^";
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
        $parm1 = $parm1."sfmfloodlightmeter_calibrationdate|Yes|Calibration|100|Yes|Calibration Date|InputDate^";
        $parm1 = $parm1."sfmfloodlightmeter_expirydate|Yes|Expiry|100|Yes|Expiry Date|InputDate^";
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

function SFM_SFMLISTS_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function SFM_SFMBYLEAGUELIST_Output() {
    XH2("Leagues");
    Get_Person_Authority();
    $selecteda = Array();

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

    $sfmleaguea = Get_Array('sfmleague');
    foreach($sfmleaguea as $sfmleague_id) {
        Get_Data('sfmleague',$sfmleague_id);
        $selected = "0";
        if ( $GLOBALS{'sfmuserngb'} != "" ) { $selected = "1"; }
        if ( FoundInCommaList($sfmleague_id,$GLOBALS{'sfmuserleague'}) ) { $selected = "1"; }
        if ( $selected == "1" ) {
            XTRJQDT();
            XTDTXT($GLOBALS{'sfmleague_name'});
            $link = YPGMLINK("sfmclublistout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("ListType","LEAGUE2CLUB").YPGMPARM("sfmleague_id",$sfmleague_id);
            XTDLINKTXT($link,"view teams in this league");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
}

function SFM_SFMLEAGUE2TEAMLIST_Output($sfmleague_id) {
	Get_Data('sfmleague',$sfmleague_id);
        XH2("Team List - ".$GLOBALS{'sfmleague_name'});
	XBR();XBR();
	XDIV("reportdiv","container");
	XTABLEJQDTID("reporttable_list");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Team Name");
        XTDHTXT("Division");
	XTDHTXT("Club Name");
	XTDHTXT("");
	X_TR();
	X_THEAD();
	XTBODY();
	XINHID("list_sortcol","0");

        $sfmteama = Get_Array('sfmteam');
        foreach ($sfmteama as $sfmteam_id) {
            Get_Data('sfmteam',$sfmteam_id);
            $selected = "0";
            if ( $GLOBALS{'sfmuserngb'} != "" ) { $selected = "1"; }
            if ( $GLOBALS{'sfmteam_sfmleagueid'} == $sfmleague_id ) { $selected = "1"; }
            if ( $selected == "1" ) {
                Check_Data("sfmdivision",$GLOBALS{'sfmteam_sfmdivisionid'});
                if ($GLOBALS{'IOWARNING'} == "0") { $divisionname = $GLOBALS{'sfmdivision_name'}; }              
                else { $divisionname = "Not Found";}
                Check_Data("sfmclub",$GLOBALS{'sfmteam_sfmclubid'});
                if ($GLOBALS{'IOWARNING'} == "0") {
                    XTRJQDT();
                    XTDTXT($GLOBALS{'sfmteam_name'});
                    XTDTXT($divisionname);
                    XTDTXT($GLOBALS{'sfmclub_name'});
                    $linksstr = ""; 
                    $sfmfacilityida = List2Array($GLOBALS{'sfmclub_sfmfacilityidlist'});
                    $sep = "";
                    foreach ( $sfmfacilityida as $sfmfacilityid ) {
                        Check_Data("sfmfacility",$sfmfacilityid);
                        if ($GLOBALS{'IOWARNING'} == "0" ) { 
                            $name = $GLOBALS{'sfmfacility_name'};  
                            $link = YPGMLINK("sfmclubupdateout.php");
                            $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmteam_sfmclubid'}).YPGMPARM("sfmfacility_id",$sfmfacilityid);
                        } else { 
                            $name = $nameid." - Not Found"; 
                        }
                        $linksstr = $linksstr.$sep.YLINKTXTNEWWINDOW($link,$name,$name);
                        $sep = "<br>";
                    }
                    XTDTXT($linksstr);
                    X_TR();
                } else {
                    XTRJQDT();
                    XTDTXT($GLOBALS{'sfmteam_name'});
                    XTDTXT($divisionname);
                    XTDTXT("Not Found");
                    XTDTXT("");
                    X_TR();
                }
            }
	}
	X_TBODY();
	X_TABLE();
	X_DIV("reportdiv");
	XCLEARFLOAT();
}



function SFM_SFMBYCOUNTYLIST_Output() {
    XH2("Counties");
    Get_Person_Authority();
    $selecteda = Array();

    XBR();XBR();
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("County");
    XTDHTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");

    $sfmcountya = Get_Array('sfmcounty');
    foreach($sfmcountya as $sfmcounty_id) {
        Get_Data('sfmcounty',$sfmcounty_id);
        $selected = "0";
        if ( $GLOBALS{'sfmuserngb'} != "" ) { $selected = "1"; }
        if ( FoundInCommaList($sfmcounty_id,$GLOBALS{'sfmusercounty'}) ) { $selected = "1"; }
        if ( $selected == "1" ) {
            XTRJQDT();
            XTDTXT($GLOBALS{'sfmcounty_name'});
            $link = YPGMLINK("sfmclublistout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("ListType","COUNTY2CLUB").YPGMPARM("sfmcounty_id",$sfmcounty_id);
            XTDLINKTXT($link,"view clubs in this county");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
}



function SFM_SFMCOUNTY2CLUBLIST_Output($sfmcounty_id) {
	Get_Data('sfmcounty',$sfmcounty_id);
        XH2("Club List - ".$GLOBALS{'sfmleague_name'});
	XBR();XBR();
	XDIV("reportdiv","container");
	XTABLEJQDTID("reporttable_list");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Club Name");
	XTDHTXT("View Club Facilities");
	X_TR();
	X_THEAD();
	XTBODY();
	XINHID("list_sortcol","0");

        $sfmcluba = Get_Array('sfmclub');
        foreach ($sfmcluba as $sfmclub_id) {
            Get_Data('sfmclub',$sfmclub_id);
            $selected = "0";
            if ( $GLOBALS{'sfmuserngb'} != "" ) { $selected = "1"; }
            if ( FoundInCommaList($sfmcounty_id,$GLOBALS{'sfmclub_sfmcountyid'}) ) { $selected = "1"; }           
            if ( $selected == "1" ) {
                XTRJQDT();
                XTDTXT($GLOBALS{'sfmclub_name'});
                $linksstr = ""; 
                $sfmfacilityida = List2Array($GLOBALS{'sfmclub_sfmfacilityidlist'});
                $sep = "";
                foreach ( $sfmfacilityida as $sfmfacilityid ) {
                    Check_Data("sfmfacility",$sfmfacilityid);
                    if ($GLOBALS{'IOWARNING'} == "0" ) { 
                        $name = $GLOBALS{'sfmfacility_name'};  
                        $link = YPGMLINK("sfmclubupdateout.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id).YPGMPARM("sfmfacility_id",$sfmfacility_id);
                    } else { 
                        $name = $nameid." - Not Found"; 
                    }
                    $linksstr = $linksstr.$sep.YLINKTXTNEWWINDOW($link,$name,$name);
                    $sep = "<br>";
                }
                XTDTXT($linksstr);
                X_TR();
            }
	}

	X_TBODY();
	X_TABLE();
	X_DIV("reportdiv");
	XCLEARFLOAT();
}


function SFM_SFMSEARCHLIST_Output() {
        XH2("Club List");
	XBR();XBR();
	XDIV("reportdiv","container");
	XTABLEJQDTID("reporttable_list");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Club Name");        
        XTDHTXT("Teams");
        XTDHTXT("League");
        XTDHTXT("Division");
        XTDHTXT("County");
        XTDHTXT("Chairman");
        XTDHTXT("View Club Facilities");  
	X_TR();
	X_THEAD();
	XTBODY();
	XINHID("list_sortcol","0");

        $sfmcluba = Get_Array('sfmclub');
        foreach ($sfmcluba as $sfmclub_id) {
            Get_Data('sfmclub',$sfmclub_id);
            $selected = "1";
            if ( $GLOBALS{'sfmuserngb'} != "" ) { $selected = "1"; }
            if ( $selected == "1" ) {
                XTRJQDT();
                XTDTXT($GLOBALS{'sfmclub_name'});

                XTDTXT(List2Names('sfmclub_sfmteamidlist'));
                XTDTXT(List2Names('sfmclub_sfmleagueidlist')); 
                XTDTXT(List2Names('sfmclub_sfmdivisionidlist'));
                XTDTXT($GLOBALS{'sfmclub_sfmcountyid'});
                XTDTXT($GLOBALS{'sfmclub_chairmancontactfname'}." ".$GLOBALS{'sfmclub_chairmancontactsname'});
                $linksstr = ""; 
                $sfmfacility_ida = List2Array($GLOBALS{'sfmclub_sfmfacilityidlist'});
                $sep = "";
                foreach ( $sfmfacility_ida as $sfmfacility_id ) {
                    Check_Data("sfmfacility",$sfmfacility_id);
                    if ($GLOBALS{'IOWARNING'} == "0" ) { 
                        $name = $GLOBALS{'sfmfacility_name'};  
                        $link = YPGMLINK("sfmclubupdateout.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id).YPGMPARM("sfmfacility_id",$sfmfacility_id);
                    } else { 
                        $name = $nameid." - Not Found"; 
                    }
                    // $linksstr = $linksstr.$sep.YLINKTXTNEWWINDOW($link,$name,$name);
                    $linksstr = $linksstr.$sep.YLINKTXT($link,$name);
                    $sep = "<br>";
                }
                XTDTXT($linksstr);
                X_TD();
                X_TR();
            }
	}
	X_TBODY();
	X_TABLE();
	X_DIV("reportdiv");
	XCLEARFLOAT();
}

function List2Names ($list) {
    $lista = explode("_",$list);
    $endstr = $lista[1];
    $tablebit = str_replace("idlist","",$endstr);
    $namesstr = ""; 
    $namea = List2Array($GLOBALS{$list});
    $sep = "";
    foreach ( $namea as $nameid ) {
        // XPTXT($tablebit." | ".$nameid);
        Check_Data($tablebit,$nameid);
        if ($GLOBALS{'IOWARNING'} == "0" ) { $name = $GLOBALS{$tablebit.'_name'};  }
        else { $name = "Not Found"; }
        $namesstr = $namesstr.$sep.$name;
        $sep = "<br>";
    }
    return $namesstr;
}

function SFM_SFMCLUBUPDATE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jqdatatables,jqueryconfirm,sfmclubupdate";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,sfmclubupdate,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm,jqdatatablesmin,areyousure,report";
}

function SFM_SFMCLUBUPDATEMULTI_Output($sfmclub_id,$sfmfacility_id,$currenttab) {

    Get_Data("sfmclub",$sfmclub_id);
    Get_Data("sfmfacility",$sfmfacility_id);
    $GLOBALS{'sfmlevel'} = 4;
    SFM_SFMCLUBUPDATETITLE_Output("Club: ".$GLOBALS{'sfmclub_name'}." | Facility: ".$GLOBALS{'sfmfacility_name'});

    $GLOBALS{'CROPPARMS'} = Array();

    XFORMUPLOAD("sfmclubupdatein.php","sfmclubupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfacility_id",$sfmfacility_id);
    XINHID("sfmset_id",$GLOBALS{'sfmclub_sfmsetid'});
    XINHID("SubmitAction","");
    XINHID("DataScope","Multi");
    XINHID("CurrentTab",$currenttab);
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});

    SFM_SFMCLUBUPDATEMULTIHEADER_Output();

    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");
    if ($currenttab == "") { $currenttab = "FACILITY"; }

    BTABHEADERCONTAINER();
    if ($currenttab=="") {BTABHEADERITEMACTIVECLASS("FACILITY","Facility","FATab");} else {BTABHEADERITEMCLASS("FACILITY","Facility","FATab");}   
    if ($currenttab=="GROUNDSTATUS") {BTABHEADERITEMACTIVECLASS("GROUNDSTATUS","Ground Grading Status","FATab");} else {BTABHEADERITEMCLASS("GROUNDSTATUS","Ground Grading Status","FATab");}
    // if ($currenttab=="PITCH") {BTABHEADERITEMACTIVECLASS("PITCH","Pitch","FATab");} else {BTABHEADERITEMCLASS("PITCH","Pitch","FATab");}
    if ($currenttab=="FLOODSTATUS") {BTABHEADERITEMACTIVECLASS("FLOODSTATUS","Floodlighting Status","FATab");} else {BTABHEADERITEMCLASS("FLOODSTATUS","Floodlighting Status","FATab");}
    // if ($currenttab=="GRSUPPORT") {BTABHEADERITEMACTIVECLASS("GRSUPPORT","Other Support","GRGTab");} else {BTABHEADERITEMCLASS("GRSUPPORT","Other Support","GRGTab");}
    // if ($currenttab=="CLUBPROJECTS") {BTABHEADERITEMACTIVECLASS("CLUBPROJECTS","Projects","GRGTab");} else {BTABHEADERITEMCLASS("CLUBPROJECTS","Projects","GRGTab");}
    // if ($currenttab=="CLUBINVESTMENT") {BTABHEADERITEMACTIVECLASS("CLUBINVESTMENT","Investment","GRGTab");} else {BTABHEADERITEMCLASS("CLUBINVESTMENT","Investment","GRGTab");}
    // if ($currenttab=="CLUBSPONSORSHIP") {BTABHEADERITEMACTIVECLASS("CLUBSPONSORSHIP","Sponsorship","GRGTab");} else {BTABHEADERITEMCLASS("CLUBSPONSORSHIP","Sponsorship","GRGTab");}
    // if ($currenttab=="CLUBOPERATIONS") {BTABHEADERITEMACTIVECLASS("CLUBUTILITIES","Operations","GRGTab");} else {BTABHEADERITEMCLASS("CLUBUTILITIES","Operations","GRGTab");}
    // if ($currenttab=="CLUBWEBSITE") {BTABHEADERITEMACTIVECLASS("CLUBWEBSITE","Website","GRGTab");} else {BTABHEADERITEMCLASS("CLUBWEBSITE","Website","GRGTab");}
    if ($currenttab=="CLUB") {BTABHEADERITEMACTIVECLASS("CLUB","Club Info","GRBTab");} else {BTABHEADERITEMCLASS("CLUB","Club Info","GRBTab");}    
    if ($currenttab=="LIBRARY") {BTABHEADERITEMACTIVECLASS("LIBRARY","Club Library","GRBTab");} else {BTABHEADERITEMCLASS("LIBRARY","Club Library","GRBTab");}       
    if ($currenttab=="CLUBNOTES") {BTABHEADERITEMACTIVECLASS("CLUBNOTES","Notes","GRGTab");} else {BTABHEADERITEMCLASS("CLUBNOTES","Notes","GRGTab");}
    B_TABHEADERCONTAINER();

    BTABCONTENTCONTAINER();
    if ($currenttab=="FACILITY") {BTABCONTENTITEMACTIVE("FACILITY");} else {BTABCONTENTITEM("FACILITY");} 
    FACILITYINFOContentOutput(); 
    B_TABCONTENTITEM();
    if ($currenttab=="GROUNDSTATUS") {BTABCONTENTITEMACTIVE("GROUNDSTATUS");} else {BTABCONTENTITEM("GROUNDSTATUS");} GROUNDSTATUSContentOutput($sfmfacility_id); B_TABCONTENTITEM();
    // if ($currenttab=="PITCH") {BTABCONTENTITEMACTIVE("PITCH");} else {BTABCONTENTITEM("PITCH");} PITCHContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="FLOODSTATUS") {BTABCONTENTITEMACTIVE("FLOODSTATUS");} else {BTABCONTENTITEM("FLOODSTATUS");} FLOODSTATUSContentOutput($sfmfacility_id); B_TABCONTENTITEM();
    // if ($currenttab=="GRSUPPORT") {BTABCONTENTITEMACTIVE("GRSUPPORT");} else {BTABCONTENTITEM("GRSUPPORT");} GRSUPPORTContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="CLUBPROJECTS") {BTABCONTENTITEMACTIVE("CLUBPROJECTS");} else {BTABCONTENTITEM("CLUBPROJECTS");} CLUBPROJECTSContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="CLUBINVESTMENT") {BTABCONTENTITEMACTIVE("CLUBINVESTMENT");} else {BTABCONTENTITEM("CLUBINVESTMENT");} CLUBINVESTMENTContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="CLUBSPONSORSHIP") {BTABCONTENTITEMACTIVE("CLUBSPONSORSHIP");} else {BTABCONTENTITEM("CLUBSPONSORSHIP");} CLUBSPONSORSHIPContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="CLUBUTILITIES") {BTABCONTENTITEMACTIVE("CLUBUTILITIES");} else {BTABCONTENTITEM("CLUBUTILITIES");} CLUBUTILITIESContentOutput(); B_TABCONTENTITEM();
    // if ($currenttab=="CLUBWEBSITE") {BTABCONTENTITEMACTIVE("CLUBWEBSITE");} else {BTABCONTENTITEM("CLUBWEBSITE");} CLUBWEBSITEContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="CLUB") {BTABCONTENTITEMACTIVE("CLUB");} else {BTABCONTENTITEM("CLUB");} CLUBCONTACTSContentOutput(); B_TABCONTENTITEM();
    if ($currenttab=="LIBRARY") {BTABCONTENTITEMACTIVE("LIBRARY");} else {BTABCONTENTITEM("LIBRARY");} CLUBLIBRARYContentOutput(); B_TABCONTENTITEM();       
    if ($currenttab=="CLUBNOTES") {BTABCONTENTITEMACTIVE("CLUBNOTES");} else {BTABCONTENTITEM("CLUBNOTES");} CLUBNOTESContentOutput(); B_TABCONTENTITEM();
    B_TABCONTENTCONTAINER();
    X_FORM();
    XTXTID("TRACETEXT","");
    XDIV("updateLog","");
    X_DIV("updateLog");
    B_COLCARD();
    B_SECTIONROW();
    B_SECTION();
    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function SFM_SFMCLUBUPDATECLUB_Output($sfmclub_id) {
    $GLOBALS{'sfmlevel'} = 4;
    Get_Data('sfmclub', $sfmclub_id);
    SFM_SFMCLUBUPDATETITLE_Output("Club Contact Information");

    $GLOBALS{'CROPPARMS'} = Array();

    XFORMUPLOAD("sfmclubupdatein.php","sfmclubupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfacility_id",$sfmfacility_id);
    XINHID("sfmset_id",$GLOBALS{'sfmclub_sfmsetid'});
    XINHID("SubmitAction","");
    XINHID("DataScope","Club");
    XINHID("CurrentTab",$currenttab);
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});

    SFM_SFMCLUBUPDATEACTION_Output("Top");
    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");
    CLUBCONTACTSContentOutput();
    B_COLCARD();
    B_SECTIONROW();
    B_SECTION();
    SFM_SFMCLUBUPDATEACTION_Output("Bottom");
    X_FORM();
    XTXTID("TRACETEXT","");
    XDIV("updateLog","");
    X_DIV("updateLog");

    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function SFM_SFMCLUBUPDATEFACILITY_Output($sfmclub_id,$sfmfacility_id) {
    $GLOBALS{'sfmlevel'} = 4;
    Get_Data('sfmclub', $sfmclub_id);
    Get_Data('sfmfacility', $sfmfacility_id);
    SFM_SFMCLUBUPDATETITLE_Output("Location: ".$sfmfacility_id);
    $GLOBALS{'CROPPARMS'} = Array();

    XFORMUPLOAD("sfmclubupdatein.php","sfmclubupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfacility_id",$sfmfacility_id);
    XINHID("sfmset_id",$GLOBALS{'sfmclub_sfmsetid'});
    XINHID("SubmitAction","");
    XINHID("DataScope","Facility");
    XINHID("CurrentTab",$currenttab);
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});

    SFM_SFMCLUBUPDATEACTION_Output("Top");
    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");
    FACILITYINFOContentOutput();
    B_COLCARD();
    B_SECTIONROW();
    B_SECTION();
    SFM_SFMCLUBUPDATEACTION_Output("Bottom");
    X_FORM();
    XTXTID("TRACETEXT","");
    XDIV("updateLog","");
    X_DIV("updateLog");

    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }

}

function SFM_SFMCLUBUPDATEGROUND_Output($sfmclub_id,$sfmfacility_id) {
    $GLOBALS{'sfmlevel'} = 4;
    Get_Data('sfmclub', $sfmclub_id);
    Get_Data('sfmfacility', $sfmfacility_id);
    SFM_SFMCLUBUPDATETITLE_Output("Ground Grading: ".$sfmfacility_id);
    $GLOBALS{'CROPPARMS'} = Array();

    XFORMUPLOAD("sfmclubupdatein.php","sfmclubupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfacility_id",$sfmfacility_id);
    XINHID("sfmset_id",$GLOBALS{'sfmclub_sfmsetid'});
    XINHID("SubmitAction","");
    XINHID("DataScope","Ground");
    XINHID("CurrentTab",$currenttab);
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});

    SFM_SFMCLUBUPDATEACTION_Output("Top");
    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");
    GROUNDSTATUSContentOutput($sfmfacility_id);
    B_COLCARD();
    B_SECTIONROW();
    B_SECTION();
    SFM_SFMCLUBUPDATEACTION_Output("Bottom");
    X_FORM();
    XTXTID("TRACETEXT","");
    XDIV("updateLog","");
    X_DIV("updateLog");

    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function SFM_SFMCLUBUPDATEFLOOD_Output($sfmclub_id,$sfmfacility_id) {
    $GLOBALS{'sfmlevel'} = 4;
    Get_Data('sfmclub', $sfmclub_id);
    Get_Data('sfmfacility', $sfmfacility_id);
    SFM_SFMCLUBUPDATETITLE_Output("Floodlighting: ".$sfmfacility_id);

    $GLOBALS{'CROPPARMS'} = Array();

    XFORMUPLOAD("sfmclubupdatein.php","sfmclubupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfacility_id",$sfmfacility_id);
    XINHID("sfmset_id",$GLOBALS{'sfmclub_sfmsetid'});
    XINHID("SubmitAction","");
    XINHID("DataScope","Flood");
    XINHID("CurrentTab",$currenttab);
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});

    SFM_SFMCLUBUPDATEACTION_Output("Top");
    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");
    FLOODSTATUSContentOutput($sfmfacility_id);
    B_COLCARD();
    B_SECTIONROW();
    B_SECTION();
    SFM_SFMCLUBUPDATEACTION_Output("Bottom");
    X_FORM();
    XTXTID("TRACETEXT","");
    XDIV("updateLog","");
    X_DIV("updateLog");

    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function SFM_SFMCLUBUPDATETITLE_Output($subject) {
    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");
    BROW();
    BCOL("8");
    if ( $sfmclub_id == "" ) { XH2($subject); }
    else { XH2($clubid.": ".$subject); }
    B_COL();
    BCOLRIGHT("4");
    
    if ($GLOBALS{'sfmfacility_pitchfinderlink'} != "") {
        XINHID("pitchfinderlink",$GLOBALS{'sfmfacility_pitchfinderlink'});
        BIMGID("pitchfinder","../site_assets/PitchFinder.png","50");
    } else {
        XIMG("../site_assets/NoPitchFinder.png","","50px","");
    }
    if ($GLOBALS{'sfmfacility_googlemapslink'} != "") {
        XINHID("googlemapslink",$GLOBALS{'sfmfacility_googlemapslink'});
        BIMGID("googlemaps","../site_assets/GoogleMaps.png","50");
    } else {
        XIMG("../site_assets/NoGoogleMaps.png","","50px","");
    }
    if ($GLOBALS{'sfmclub_website'} != "") {
        XINHID("websitelink",$GLOBALS{'sfmclub_website'});
        BIMGID("website","../site_assets/Website.png","50");
    } else {
        XIMG("../site_assets/NoWebsite.png","","50px","");
    }
    XLINKIMGNEWWINDOW(Field2URL("www.grassrootspower.support/GrassrootsPowerSupport.html"),$GLOBALS{'domainwwwurl'}."/domain_media/GrassRootsIcon.png","_Website","","50px","");
    B_COL();
    B_ROW();       
    B_COLCARD();   
    B_SECTIONROW();
    B_SECTION();
}

function SFM_SFMCLUBUPDATEACTION_Output($pos) {
    BROW();
    BCOLTXT("","9");
    BCOL("1");
    if ( $GLOBALS{'sfmlevel'} > 2 ) { BINBUTTONIDSPECIAL("Save".$pos,"primary","Save"); }
    B_COL();
    BCOL("1");
    BINBUTTONIDSPECIAL("Close".$pos,"warning","Close");
    B_COL();
    BCOLTXT("","1");
    B_ROW();
}

function SFM_SFMCLUBUPDATEMULTIHEADER_Output() {
    BSECTION();
    BSECTIONROW();

    BCOLCARD("6");
    BROW();
    BCOL("6");
    if ($GLOBALS{'sfmfacility_image1'} == "" ) { BIMGFIT("../site_assets/NoImage_Flex.png"); }
    else { BIMGFIT($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'sfmfacility_image1'}); }
    B_COL();
    BCOL("6");
    if ($GLOBALS{'sfmfacility_image2'} == "" ) { BIMGFIT("../site_assets/NoImage_Flex.png"); }
    else { BIMGFIT($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'sfmfacility_image2'}); }
    B_COL();
    B_ROW();
    B_COLCARD();

    BCOLCARD("3");
    if ( $GLOBALS{'sfmlevel'} > 2 ) {	BINBUTTONIDSPECIAL("Save","primary","Save"); XBR();}
    BINBUTTONIDSPECIAL("Close","warning","Close");
    B_COLCARD();

    BCOLCARD("3");
    XH4("Other Facilities");
    $thisfacility = $GLOBALS{'sfmfacility_id'};
    if ( $thisfacility == $GLOBALS{'sfmclub_sfmfacilityidlist'} ) { // only 1
       XPTXT("None");
    } else {
        $linksstr = ""; 
        $sfmfacilityida = List2Array($GLOBALS{'sfmclub_sfmfacilityidlist'});
        $sep = "";
        foreach ( $sfmfacilityida as $sfmfacilityid ) {
            if ( $sfmfacilityid != $thisfacility ) {
                Check_Data("sfmfacility",$sfmfacilityid);
                if ($GLOBALS{'IOWARNING'} == "0" ) { 
                    $name = $GLOBALS{'sfmfacility_name'};  
                    $link = YPGMLINK("sfmclubupdateout.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmfacility_id",$sfmfacilityid);
                } else { 
                    $name = $nameid." - Not Found"; 
                }
                $linksstr = $linksstr.$sep.YLINKTXTNEWWINDOW($link,$name,$name);
                $sep = "<br>";
            }
        }
        Check_Data("sfmfacility",$thisfacility); // Just to reset
        XTXT($linksstr);
    }    
    B_COLCARD();

    /*
    BCOLCARD("2");
    BIMG($GLOBALS{'domainwwwurl'}."/domain_media/GrassRootsLogo.png","80","1");
    BINBUTTONIDSPECIAL ("SupportButton","success","Member Support");
    B_COLCARD();
    */
    
    B_SECTIONROW();
    B_SECTION();
}

function CLUBCONTACTSContentOutput() {
    XBR();
    XHRCLASS('underline');
    XH3("Club Details");
    XBR();
    BROW(); BCOLTXT("Name","1"); BCOLINTXTID('sfmclub_name','sfmclub_name',$GLOBALS{'sfmclub_name'},"3"); B_ROW();
    XBR();

    XH3("Chairman");
    BROW();
    BCOLTXT("Title","1"); BCOLINTXTID('sfmclub_chairmancontacttitle','sfmclub_chairmancontacttitle',$GLOBALS{'sfmclub_chairmancontacttitle'},"3");
    BCOLTXT("First Name","1"); BCOLINTXTID('sfmclub_chairmancontactfname','sfmclub_chairmancontactfname',$GLOBALS{'sfmclub_chairmancontactfname'},"3");
    BCOLTXT("Surname","1"); BCOLINTXTID('sfmclub_chairmancontactsname','sfmclub_chairmancontactsname',$GLOBALS{'sfmclub_chairmancontactsname'},"3");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Email","1"); BCOLINTXTID('sfmclub_chairmancontactemail','sfmclub_chairmancontactemail',$GLOBALS{'sfmclub_chairmancontactemail'},"3");
    BCOLTXT("Telephone","1"); BCOLINTXTID('sfmclub_chairmancontacttel','sfmclub_chairmancontacttel',$GLOBALS{'sfmclub_chairmancontacttel'},"3");
    BCOLTXT("Mobile","1"); BCOLINTXTID('sfmclub_chairmancontactmobiletel','sfmclub_chairmancontactmobiletel',$GLOBALS{'sfmclub_chairmancontactmobiletel'},"3");
    B_ROW();
    XBR();

    XH3("Address");
    BROW();
    BCOLTXT("Address 1","1"); BCOLINTXTID('sfmclub_addr1','sfmclub_addr1',$GLOBALS{'sfmclub_addr1'},"3");

    BCOLTXT("Address 2","1"); BCOLINTXTID('sfmclub_addr2','sfmclub_addr2',$GLOBALS{'sfmclub_addr2'},"3");
    BCOLTXT("Address 3","1"); BCOLINTXTID('sfmclub_addr3','sfmclub_addr3',$GLOBALS{'sfmclub_addr3'},"3");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("County","1"); BCOLINTXTID('sfmclub_addr4','sfmclub_addr4',$GLOBALS{'sfmclub_addr4'},"3");
    BCOLTXT("Post Code","1"); BCOLINTXTID('sfmclub_postcode','sfmclub_postcode',$GLOBALS{'sfmclub_postcode'},"3");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Club Website","1");
    BCOLINTXTID("sfmclub_website","sfmclub_website",$GLOBALS{'sfmclub_website'},"7");
    B_ROW();
    XHR();

    XH3("Other Contacts");
    XBR();
    XH4("Secretary");
    BROW();
    BCOLTXT("Title","1"); BCOLINTXTID('sfmclub_secretarycontacttitle','sfmclub_secretarycontacttitle',$GLOBALS{'sfmclub_secretarycontacttitle'},"3");
    BCOLTXT("First Name","1"); BCOLINTXTID('sfmclub_secretarycontactfname','sfmclub_secretarycontactfname',$GLOBALS{'sfmclub_secretarycontactfname'},"3");
    BCOLTXT("Surname","1"); BCOLINTXTID('sfmclub_secretarycontactsname','sfmclub_secretarycontactsname',$GLOBALS{'sfmclub_secretarycontactsname'},"3");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Email","1"); BCOLINTXTID('sfmclub_secretarycontactemail','sfmclub_secretarycontactemail',$GLOBALS{'sfmclub_secretarycontactemail'},"3");
    BCOLTXT("Telephone","1"); BCOLINTXTID('sfmclub_secretarycontacttel','sfmclub_secretarycontacttel',$GLOBALS{'sfmclub_secretarycontacttel'},"3");
    BCOLTXT("Mobile","1"); BCOLINTXTID('sfmclub_secretarycontactmobiletel','sfmclub_secretarycontactmobiletel',$GLOBALS{'sfmclub_secretarycontactmobiletel'},"3");
    B_ROW();
    XBR();
    XH4("Ground Contact");
    BROW();
    BCOLTXT("Title","1"); BCOLINTXTID('sfmclub_groundcontacttitle','sfmclub_groundcontacttitle',$GLOBALS{'sfmclub_groundcontacttitle'},"3");
    BCOLTXT("First Name","1"); BCOLINTXTID('sfmclub_groundcontactfname','sfmclub_groundcontactfname',$GLOBALS{'sfmclub_groundcontactfname'},"3");
    BCOLTXT("Surname","1"); BCOLINTXTID('sfmclub_groundcontactsname','sfmclub_groundcontactsname',$GLOBALS{'sfmclub_groundcontactsname'},"3");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Email","1"); BCOLINTXTID('sfmclub_groundcontactemail','sfmclub_groundcontactemail',$GLOBALS{'sfmclub_groundcontactemail'},"3");
    BCOLTXT("Telephone","1"); BCOLINTXTID('sfmclub_groundcontacttel','sfmclub_groundcontacttel',$GLOBALS{'sfmclub_groundcontacttel'},"3");
    BCOLTXT("Mobile","1"); BCOLINTXTID('sfmclub_groundcontactmobiletel','sfmclub_groundcontactmobiletel',$GLOBALS{'sfmclub_groundcontactmobiletel'},"3");
    B_ROW();
    XHR();XBR();
    XH4("Contact Notes");
    BROW();
    BCOLINTEXTAREAID ('sfmclub_contactnotes','sfmclub_contactnotes',$GLOBALS{'sfmclub_contactnotes'},"8","8");
    B_ROW();
    XBR();
    XHRCLASS('underline');
    BROW();
    BCOL("4");
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
    XH3("Club Images");
    BROW();
    BCOL("6");
    if ( $GLOBALS{'sfmclub_image1title'} == "" ) { $GLOBALS{'sfmclub_image1title'} = "General View"; }
    BROW();
     BCOLTXT("Caption","2"); BCOLINTXTID('sfmclub_image1title','sfmclub_image1title',$GLOBALS{'sfmclub_image1title'},"4"); B_ROW();
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
    BROW();
     BCOLTXT("Caption","2"); BCOLINTXTID('sfmclub_image2title','sfmclub_image2title',$GLOBALS{'sfmclub_image2title'},"4"); B_ROW();
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
    XHRCLASS('underline');
    
    XH3("Access");
  
    XBR();
    BROWEQH();
    BCOLTXT("","1");
    BCOLTXTCOLOR("<b>Id</b>","1","gray","white");
    BCOLTXTCOLOR("<b>First Name</b>","2","gray","white");
    BCOLTXTCOLOR("<b>Last Name</b>","2","gray","white");
    BCOLTXTCOLOR("<b>Email</b>","3","gray","white");
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
    XBR();XBR();
}

function FACILITYINFOContentOutput() {
    XBR();
    XHRCLASS('underline');
    XH3("Facility Details");
    BROW(); BCOLTXT("Name","1"); BCOLINTXTID('sfmfacility_name','sfmfacility_name',$GLOBALS{'sfmfacility_name'},"3"); B_ROW();
    XBR();

    XH3("Address");
    BROW();
    BCOLTXT("Address 1","1"); BCOLINTXTID('sfmfacility_addr1','sfmfacility_addr1',$GLOBALS{'sfmfacility_addr1'},"3");

    BCOLTXT("Address 2","1"); BCOLINTXTID('sfmfacility_addr2','sfmfacility_addr2',$GLOBALS{'sfmfacility_addr2'},"3");
    BCOLTXT("Address 3","1"); BCOLINTXTID('sfmfacility_addr3','sfmfacility_addr3',$GLOBALS{'sfmfacility_addr3'},"3");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("County","1"); BCOLINTXTID('sfmfacility_addr4','sfmfacility_addr4',$GLOBALS{'sfmfacility_addr4'},"3");
    BCOLTXT("Post Code","1"); BCOLINTXTID('sfmfacility_postcode','sfmfacility_postcode',$GLOBALS{'sfmfacility_postcode'},"3");
    B_ROW();
    XBR();
    XHR();
    BROW();
    BCOLTXT("Google<wbr>Maps Link","1");
    BCOLINTXTID("sfmfacility_googlemapslink","sfmfacility_googlemapslink",$GLOBALS{'sfmfacility_googlemapslink'},"7");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Pitch<wbr>Finder Link","1");
    BCOLINTXTID("sfmfacility_pitchfinderlink","sfmfacility_pitchfinderlink",$GLOBALS{'sfmfacility_pitchfinderlink'},"7");
    B_ROW();
    XHR();
    
    XH3("Facility Images");
    BROW();
    BCOL("6");
    if ( $GLOBALS{'sfmfacility_image1title'} == "" ) { $GLOBALS{'sfmfacility_image1title'} = "General View"; }
    BROW();
     BCOLTXT("Caption","2"); BCOLINTXTID('sfmfacility_image1title','sfmfacility_image1title',$GLOBALS{'sfmfacility_image1title'},"4"); B_ROW();
    XBR();
    XINHID("sfmfacility_image1",$GLOBALS{'sfmfacility_image1'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfacility_image1";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfacility_image1'};
    $imageuploadto = "Facility";
    $imageuploadid = $GLOBALS{'sfmfacility_id'}."Image1";
    $imageuploadwidth = "800";
    $imageuploadheight = "500";
    $imageuploadfixedsize = "800x500";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);

    B_COL();
    BCOL("6");
    if ( $GLOBALS{'sfmfacility_image2title'} == "" ) { $GLOBALS{'sfmfacility_image2title'} = "Pitch View"; }
    BROW();
     BCOLTXT("Caption","2"); BCOLINTXTID('sfmfacility_image2title','sfmfacility_image2title',$GLOBALS{'sfmfacility_image2title'},"4"); B_ROW();
    XBR();
    XINHID("sfmfacility_image2",$GLOBALS{'sfmfacility_image2'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfacility_image2";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfacility_image2'};
    $imageuploadto = "Facility";
    $imageuploadid = $GLOBALS{'sfmfacility_id'}."Image2";
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
}


function GROUNDSTATUSContentOutput($thissfmfacility_id) {
    XBR();
    BROW();
    BCOL("4"); 
    $link = YPGMLINK("sfmclubupdatein.php").YPGMSTDPARMS().YPGMPARM("SubmitAction","GroundGrading").YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmfacility_id",$thissfmfacility_id);
    $link = $link.YPGMPARM("sfmfacility_gradingtarget",$GLOBALS{'sfmfacility_gradingtarget'});    
    XLINKBUTTONSPECIAL ($link,"Ground Grading - Club Self Assessment","info");
    B_COL();
    BCOL("4");
    $link = YPGMLINK("sfmgroundgradingmatrixout.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmfacility_id",$thissfmfacility_id);
    XLINKBUTTONSPECIAL ($link,"Compare against all grading levels","info");
    B_COL();
    BCOLTXT("","4");
    B_ROW();
    XBR();
    XHR('');
    XH3("Current Status");
    /*
    sfmfacility_gradingtarget
    sfmfacility_gradingachieved

    sfmfacility_lastgroundreviewdate
    sfmfacility_lastgroundreviewerdate
    sfmfacility_groundgrading
    sfmfacility_nexgroundreviewdate
    */
    BROW();
    BCOLTXT("Grading Achieved","2");
    $keylist = ('FAWGroundGradingA,FAWGroundGradingB,FAGroundGradingA,FAGroundGradingB,FAGroundGradingC,FAGroundGradingD,FAGroundGradingE,FAGroundGradingF,FAGroundGradingG,FAGroundGradingH');
    $valuelist = ('WA,WB,A,B,C,D,E,F,G,H');
    $xhash = Lists2Hash($keylist,$valuelist);
    BCOLINSELECTHASHID ($xhash,'sfmfacility_gradingachieved','sfmfacility_gradingachieved',$GLOBALS{'sfmfacility_gradingachieved'},"2");
    BCOLTXT("Grading Reqd","2");
    BCOLINSELECTHASHID ($xhash,'sfmfacility_gradingtarget','sfmfacility_gradingtarget',$GLOBALS{'sfmfacility_gradingtarget'},"2");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Last Review Date","2");
    BCOLINDATEID('sfmfacility_lastgroundreviewdate','sfmfacility_lastgroundreviewdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_lastgroundreviewdate'}),'dd/mm/yyyy',"2");
    BCOLTXT("Last Review Decision","2");
    BCOLINTXTID('sfmfacility_lastgroundreviewerdecision','sfmfacility_lastgroundreviewerdecision',$GLOBALS{'sfmfacility_lastgroundreviewerdecision'},"2");
    BCOLTXT("Reviewer","2");
    BCOLINTXTID('sfmfacility_lastgroundreviewername','sfmfacility_lastgroundreviewername',$GLOBALS{'sfmfacility_lastgroundreviewername'},"2");
    B_ROW();
    BROWTOP();
    BCOLTXT("Next Review Date","2");
    BCOLINDATEID('sfmfacility_nextgroundreviewdate','sfmfacility_nextgroundreviewdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_nextgroundreviewdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    XBR();
    BROWTOP();
    BCOLTXT("Last Review Decision Notes","2");
    BCOLINTEXTAREAID('sfmfacility_lastgroundreviewerdecisionnotes','sfmfacility_lastgroundreviewerdecisionnotes',$GLOBALS{'sfmfacility_lastgroundreviewerdecisionnotes'},"4","10");
    B_ROW();
    XBR();XBR();

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

    $sfmrectification_ida = Get_Array("sfmrectification",$thissfmfacility_id);
    foreach ($sfmrectification_ida as $sfmrectification_id) {
        Get_Data("sfmrectification",$thissfmfacility_id,$sfmrectification_id);
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
    XBR();XBR();

    XHRCLASS('underline');
    XH3("Current Condition");
    XBR();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Ground</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacility_groundrag','rag','sfmfacility_groundrag',$GLOBALS{'sfmfacility_groundrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfacility_groundragcomments','sfmfacility_groundragcomments',$GLOBALS{'sfmfacility_groundragcomments'},"3","8");
    // BCOLTXT("Replacement Date","1");
    // BCOLINDATEID('sfmfacility_groundreplacementdate','sfmfacility_groundreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_groundreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Spectators</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacility_spectatorrag','rag','sfmfacility_spectatorrag',$GLOBALS{'sfmfacility_spectatorrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfacility_spectatorragcomments','sfmfacility_spectatorragcomments',$GLOBALS{'sfmfacility_spectatorragcomments'},"3","8");
    // BCOLTXT("Replacement Date","1");
    // BCOLINDATEID('sfmfacility_groundreplacementdate','sfmfacility_groundreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_groundreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Dressing Rooms</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacility_dressingroomrag','rag','sfmfacility_dressingroomrag',$GLOBALS{'sfmfacility_dressingroomrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfacility_dressingroomragcomments','sfmfacility_dressingroomragcomments',$GLOBALS{'sfmfacility_dressingroomragcomments'},"3","8");
    // BCOLTXT("Replacement Date","1");
    // BCOLINDATEID('sfmfacility_groundreplacementdate','sfmfacility_groundreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_groundreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Medical</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacility_medicalrag','rag','sfmfacility_medicalrag',$GLOBALS{'sfmfacility_medicalrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfacility_medicalragcomments','sfmfacility_medicalragcomments',$GLOBALS{'sfmfacility_medicalragcomments'},"3","8");
    // BCOLTXT("Replacement Date","1");
    // BCOLINDATEID('sfmfacility_medicalreplacementdate','sfmfacility_medicalreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_medicalreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();

    XBR();
    XHRCLASS('underline');
    XH3("Ground Grading Inspections");
    XBR();
    $link = YPGMLINK("sfmfacilityvisitout.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'});
    $link = $link.YPGMPARM("sfmfacilityvisit_sfmfacilityid",$GLOBALS{'sfmfacility_id'}).YPGMPARM("sfmfacilityvisit_id","New");
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

    $sfmfacilityvisita = Get_Array('sfmfacilityvisit',$thissfmfacility_id);
    foreach ($sfmfacilityvisita as $sfmfacilityvisit_id) {
        Get_Data('sfmfacilityvisit',$thissfmfacility_id,$sfmfacilityvisit_id);
        XTRJQDT();
        XTDTXT($GLOBALS{'sfmfacilityvisit_date'});
        XTDTXT($GLOBALS{'sfmfacilityvisit_type'});
        XTDTXT($GLOBALS{'sfmfacilityvisit_gradingtarget'});
        XTDTXT($GLOBALS{'sfmfacilityvisit_reviewername'});
        XTDTXT($GLOBALS{'sfmfacilityvisit_reviewerdecision'});
        $link = YPGMLINK("sfmfacilityvisitout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmfacilityvisit_sfmfacilityid",$GLOBALS{'sfmfacilityvisit_sfmfacilityid'}).YPGMPARM("sfmfacilityvisit_id",$sfmfacilityvisit_id);
        XTDLINKTXT($link,"select");
        $link = YPGMLINK("sfmfacilityvisitdeleteconfirm.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmfacilityvisit_sfmfacilityid",$GLOBALS{'sfmfacilityvisit_sfmfacilityid'}).YPGMPARM("sfmfacilityvisit_id",$sfmfacilityvisit_id);
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

function FLOODSTATUSContentOutput($thissfmfacility_id) {
    XBR();
    BROW();
    BCOL("2"); BINBUTTONIDSPECIAL("FloodlightSpecification","info","Floodlight Specification"); B_COL();
    B_ROW();
    XBR();
    XHRCLASS('underline');
    XH3("Current Floodlights Status - ".$thissfmfacility_id);
    XBR('');

    BROW();
    BCOLTXT("Last Review Decision","2");
    BCOLINTXTIDCLASS('sfmfacility_lastfloodlightreviewdecision','rag','sfmfacility_lastfloodlightreviewdecision',$GLOBALS{'sfmfacility_lastfloodlightreviewdecision'},"2");
    BCOLTXT("","4");
    BCOLTXT("Legacy Review","2");
    BCOLINCHECKBOXYESNO ('sfmfacility_lastfloodlightreviewlegacytest', $GLOBALS{'sfmfacility_lastfloodlightreviewlegacytest'}, "", "2");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Last Review Date","2");
    BCOLINDATEID('sfmfacility_lastfloodlightreviewdate','sfmfacility_lastfloodlightreviewdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_lastfloodlightreviewdate'}),'dd/mm/yyyy',"2");
    BCOLTXT("Inspector","2");
    BCOLINTXTID('sfmfacility_lastfloodlightreviewername','sfmfacility_lastfloodlightreviewername',$GLOBALS{'sfmfacility_lastfloodlightreviewername'},"2");
    BCOLTXT("Next Review Date","2");
    BCOLINDATEID('sfmfacility_nextfloodlightreviewdate','sfmfacility_nextfloodlightreviewdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_nextfloodlightreviewdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    BCOLTXT("Avg Lux","2");
    BCOLINTXTID('sfmfacility_floodlightavglux','sfmfacility_floodlightavglux',$GLOBALS{'sfmfacility_floodlightavglux'},"2");
    BCOLTXT("Avg Lux Reqd","2");
    BCOLINTXTID('sfmfacility_floodlightavgluxreqd','sfmfacility_floodlightavgluxreqd',$GLOBALS{'sfmfacility_floodlightavgluxreqd'},"2");
    BCOLTXT("Lamps not working","2");
    BCOLINTXTID('sfmfacility_floodlightlampnotworking','sfmfacility_floodlightlampnotworking',$GLOBALS{'sfmfacility_floodlightlampnotworking'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Min Lux","2");
    BCOLINTXTID('sfmfacility_floodlightminlux','sfmfacility_floodlightminlux',$GLOBALS{'sfmfacility_floodlightminlux'},"2");
    BCOLTXT("Max Lux","2");
    BCOLINTXTID('sfmfacility_floodlightmaxlux','sfmfacility_floodlightmaxlux',$GLOBALS{'sfmfacility_floodlightmaxlux'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Min / Max","2");
    BCOLINTXTID('sfmfacility_floodlightminmaxlux','sfmfacility_floodlightminmaxlux',$GLOBALS{'sfmfacility_floodlightminmaxlux'},"2");
    BCOLTXT("Min / Max Reqd","2");
    BCOLINTXTID('sfmfacility_floodlightminmaxluxreqd','sfmfacility_floodlightminmaxluxreqd',$GLOBALS{'sfmfacility_floodlightminmaxluxreqd'},"2");
    BCOLTXT("Min / Avg","2");
    BCOLINTXTID('sfmfacility_floodlightminavglux','sfmfacility_floodlightminavglux',$GLOBALS{'sfmfacility_floodlightminavglux'},"2");
    B_ROW();
    BROWTOP();
    BCOLTXT("Lighting Comments/Actions","2");
    BCOLINTEXTAREAID('sfmfacility_floodlightluxcomments','sfmfacility_floodlightluxcomments',$GLOBALS{'sfmfacility_floodlightluxcomments'},"4","10");
    B_ROW();
    BROWTOP();
    BCOLTXT("Condition Comments/Actions","2");
    BCOLINTEXTAREAID('sfmfacility_floodlightconditioncomments','sfmfacility_floodlightconditioncomments',$GLOBALS{'sfmfacility_floodlightconditioncomments'},"4","10");
    B_ROW();
    XBR();

    XHR();
    XH3("Current Condition and Replacement Projection");
    XBR();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Columns</b>","2"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacility_floodlightcolumnrag','rag','sfmfacility_floodlightcolumnrag',$GLOBALS{'sfmfacility_floodlightcolumnrag'},"2");
    BCOLTXT("Replacement Date","2");
    BCOLINDATEID('sfmfacility_floodlightcolumnreplacementdate','sfmfacility_floodlightcolumnreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_floodlightcolumnreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Fixtures</b>","2"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacility_floodlightfixturerag','rag','sfmfacility_floodlightfixturerag',$GLOBALS{'sfmfacility_floodlightfixturerag'},"2");
    BCOLTXT("Replacement Date","2");
    BCOLINDATEID('sfmfacility_floodlightfixturereplacementdate','sfmfacility_floodlightfixturereplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_floodlightfixturereplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Electrics</b>","2"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacility_floodlightelectricsrag','rag','sfmfacility_floodlightelectricsrag',$GLOBALS{'sfmfacility_floodlightelectricsrag'},"2");
    BCOLTXT("Replacement Date","2");
    BCOLINDATEID('sfmfacility_floodlightelectricsreplacementdate','sfmfacility_floodlightelectricsreplacementdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacility_floodlightelectricsreplacementdate'}),'dd/mm/yyyy',"2");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Spillage</b>","2"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacility_floodlightspillluxrag','rag','sfmfacility_floodlightspillluxrag',$GLOBALS{'sfmfacility_floodlightspillluxrag'},"2");
    B_ROW();
    XBR();

    XHRCLASS('underline');
    XH3("Floodlight Inspections and Maintenance");
    XBR();
    $link = YPGMLINK("sfmfloodlightvisitout.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'});
    $link = $link.YPGMPARM("sfmfloodlightvisit_sfmfacilityid",$GLOBALS{'sfmfacility_id'}).YPGMPARM("sfmfloodlightvisit_id","New");
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


    $sfmfloodlightvisita = Get_Array('sfmfloodlightvisit',$thissfmfacility_id);
    foreach ($sfmfloodlightvisita as $sfmfloodlightvisit_id) {
        Get_Data('sfmfloodlightvisit',$thissfmfacility_id,$sfmfloodlightvisit_id);
        XTRJQDT();
        XTDTXT($GLOBALS{'sfmfloodlightvisit_date'});
        XTDTXT($GLOBALS{'sfmfloodlightvisit_type'});
        XTDTXT($GLOBALS{'sfmfloodlightvisit_reviewername'});
        XTDTXT($GLOBALS{'sfmfloodlightvisit_reviewerdecision'});
        $link = YPGMLINK("sfmfloodlightvisitout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmfloodlightvisit_sfmfacilityid",$GLOBALS{'sfmfloodlightvisit_sfmfacilityid'}).YPGMPARM("sfmfloodlightvisit_id",$sfmfloodlightvisit_id);
        XTDLINKTXT($link,"select");
        $link = YPGMLINK("sfmfloodlightvisitdeleteconfirm.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$GLOBALS{'sfmclub_id'}).YPGMPARM("sfmfloodlightvisit_sfmfacilityid",$GLOBALS{'sfmfloodlightvisit_sfmfacilityid'}).YPGMPARM("sfmfloodlightvisit_id",$sfmfloodlightvisit_id);
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

function CLUBLIBRARYContentOutput() {
    XBR();
    XH3("Library");
    XHRCLASS('underline');
    XBR();
    $assetclubid = "Club-".$GLOBALS{'sfmclub_id'};
    Library_LIBRARYINDEX_Output ("Maintain",$assetclubid);
    XBR();XBR();
}

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

function SFM_SFMGROUNDGRADING_Output($sfmclub_id,$sfmfacility_id,$reqdaccredscheme_id) {
    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");
    XH2("Facility: ".$sfmfacility_id);
    Check_Data('accredscheme',$reqdaccredscheme_id);
    $accredschemea = Get_Array('accredscheme');
    Check_Data('accredcriteria',$reqdaccredscheme_id,$sfmfacility_id,"a_01");
    Library_ACCREDVIEWLIST_Output ($reqdaccredscheme_id,$sfmfacility_id,"Maintain","");
    XBR();
    XHRCLASS("underline");
    XBR();
    $link = YPGMLINK("sfmgroundgradingfacilitysetup.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id).YPGMPARM("sfmfacility_id",$sfmfacility_id).YPGMPARM("accredscheme_id",$reqdaccredscheme_id).YPGMPARM("mode","upgrade");
    XLINKTXT($link,"Update ".$GLOBALS{'accredscheme_name'}." to latest criteria.");
    XBR();
    $accredschemea = Get_Array('accredscheme');
    foreach ($accredschemea as $accredscheme_id) {
        if ($accredscheme_id != $reqdaccredscheme_id) {
            Check_Data('accredcriteria',$accredscheme_id,$sfmfacility_id,"a_01");
            if ($GLOBALS{'IOWARNING'} == "0" ) {
                Check_Data('accredscheme',$accredscheme_id);
                $link = YPGMLINK("sfmgroundgradingresponsecopy.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id).YPGMPARM("sfmfacility_id",$sfmfacility_id).YPGMPARM("accredscheme_id",$reqdaccredscheme_id).YPGMPARM("fromaccredscheme_id",$accredscheme_id);
                XBR(); XLINKTXT($link,"Copy responses from ".$GLOBALS{'accredscheme_name'}." self assessment");
            }
        }
    }
    XBR();XBR();
    $link = YPGMLINK("sfmgroundgradingmanage.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id).YPGMPARM("sfmfacility_id",$sfmfacility_id);
    XLINKTXT($link,"Manage Ground Grading Self Assessments");
    B_COLCARD();
    B_SECTIONROW();
    B_SECTION();
}

function SFM_SFMFLOODLIGHTVISIT_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,sfmfloodlightvisitupdate,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm,jqdatatablesmin,report,areyousure";
}

function SFM_SFMFLOODLIGHTVISIT_Output($sfmclub_id,$sfmfloodlightvisit_sfmfacilityid,$sfmfloodlightvisit_id,$currenttab) {

    $GLOBALS{'sfmlevel'} = 4;

    Get_Data('sfmclub', $sfmclub_id);
    // XH2("Pitch ".$sfmfloodlightvisit_sfmfacilityid);
    Check_Data('sfmfacility', $sfmfloodlightvisit_sfmfacilityid);
    if ( $sfmfloodlightvisit_id == "New" ) {
        Initialise_Data('sfmfloodlightvisit');
        $GLOBALS{'sfmfloodlightvisit_id'} = $GLOBALS{'currenttimestamp'};
        $GLOBALS{'sfmfloodlightvisit_type'} = "LLTBiennial";
        $GLOBALS{'sfmfloodlightvisit_date'} = $GLOBALS{'currentYYYY-MM-DD'};
        $GLOBALS{'sfmfloodlightvisit_starttime'} = $GLOBALS{'acthh'}.":".$GLOBALS{'actmm'};
        $GLOBALS{'sfmfloodlightvisit_pitchlength'} = $GLOBALS{'sfmfacility_pitchlength'};
        $GLOBALS{'sfmfloodlightvisit_pitchwidth'} = $GLOBALS{'sfmfacility_pitchwidth'};
        $GLOBALS{'sfmfloodlightvisit_columnqty'} = $GLOBALS{'sfmfacility_floodlightcolumnqty'};
        $GLOBALS{'sfmfloodlightvisit_columnheight'} = $GLOBALS{'sfmfacility_floodlightcolumnheight'};
        $GLOBALS{'sfmfloodlightvisit_columntypeid'} = $GLOBALS{'sfmfacility_floodlightcolumntypeid'};
        $GLOBALS{'sfmfloodlightvisit_columnmanufacturerid'} = $GLOBALS{'sfmfacility_floodlightcolumnmanufacturerid'};
        $GLOBALS{'sfmfloodlightvisit_columninstalldate'} = $GLOBALS{'sfmfacility_floodlightcolumninstalldate'};
        $GLOBALS{'sfmfloodlightvisit_fixtureqty'} = $GLOBALS{'sfmfacility_floodlightfixtureqty'};
        $GLOBALS{'sfmfloodlightvisit_pitchorientation'} = $GLOBALS{'sfmfacility_pitchorientation'};
        $GLOBALS{'sfmfloodlightvisit_dugoutposition'} = $GLOBALS{'sfmfacility_dugoutposition'};
        $GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'} = $GLOBALS{'sfmfacility_sfmpitchtypeid'};

        $GLOBALS{'sfmfloodlightvisit_fixturetypeid'} = $GLOBALS{'sfmfacility_floodlightfixturetypeid'};
        $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'} = $GLOBALS{'sfmfacility_floodlightfixturemanufacturerid'};
        $GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'} = $GLOBALS{'sfmfacility_floodlightfixtureinstalldate'};
        $GLOBALS{'sfmfloodlightvisit_lamptypeid'} = $GLOBALS{'sfmfacility_floodlightlamptypeid'};

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
        Write_Data('sfmfloodlightvisit', $sfmfloodlightvisit_sfmfacilityid, $sfmfloodlightvisit_id);
    } else {
        Check_Data('sfmfloodlightvisit', $sfmfloodlightvisit_sfmfacilityid, $sfmfloodlightvisit_id);
    }

    $headingtext = $GLOBALS{'sfmfacility_name'}." - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_date'});
    XH2("Floodlighting Visit - ".$headingtext);

    XFORMUPLOAD("sfmfloodlightvisitupdatein.php","sfmfloodlightvisitupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfloodlightvisit_sfmfacilityid",$sfmfloodlightvisit_sfmfacilityid);
    XINHID("sfmfloodlightvisit_id",$sfmfloodlightvisit_id);
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});
    XINHID("SubmitAction","");
    XINHID("SpecificationChanged","");
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
    BCOLTXT("Review Type","2");
    $xhash = Get_SelectArrays_Hash ("sfmvisittype","sfmvisittype_id","sfmvisittype_title","sfmvisittype_id","sfmvisittype_type","Flood" );
    BCOLINSELECTHASHID ($xhash,'sfmfloodlightvisit_type','sfmfloodlightvisit_type',$GLOBALS{'sfmfloodlightvisit_type'},"2");
    BCOLTXT("Reviewer Name","1");
    BCOLINTXTID('sfmfloodlightvisit_reviewername','sfmfloodlightvisit_reviewername',$GLOBALS{'sfmfloodlightvisit_reviewername'},"2");
    BCOLTXT("Reviewer Role","2");
    BCOLINTXTID('sfmfloodlightvisit_reviewerrole','sfmfloodlightvisit_reviewerrole',$GLOBALS{'sfmfloodlightvisit_reviewerrole'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Reviewer Tel","2");
    BCOLINTXTID('sfmfloodlightvisit_reviewertel','sfmfloodlightvisit_reviewertel',$GLOBALS{'sfmfloodlightvisit_reviewertel'},"2");
    BCOLTXT("Reviewer EMail","2");
    BCOLINTXTID('sfmfloodlightvisit_revieweremail','sfmfloodlightvisit_revieweremail',$GLOBALS{'sfmfloodlightvisit_revieweremail'},"2");
    BCOLTXT("Club Rep","2");
    BCOLINTXTID('sfmfloodlightvisit_clubrepname','sfmfloodlightvisit_clubrepname',$GLOBALS{'sfmfloodlightvisit_clubrepname'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Date","2");
    BCOLINDATEID('sfmfloodlightvisit_date','sfmfloodlightvisit_date_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightvisit_date'}),'dd/mm/yyyy',"2");
    BCOLTXT("Start","2");
    BCOLINTXTID ("sfmfloodlightvisit_starttime","sfmfloodlightvisit_starttime",$GLOBALS{'sfmfloodlightvisit_starttime'},"2");
    BCOLTXT("Finish","2");
    BCOLINTXTID ("sfmfloodlightvisit_endtime","sfmfloodlightvisit_endtime",$GLOBALS{'sfmfloodlightvisit_endtime'},"2");
    B_ROW();
    
    BROW();
    BCOLTXT("","8");
    BCOLTXT("Legacy Review","2");
    BCOLINCHECKBOXYESNO ('sfmfloodlightvisit_legacytest', $GLOBALS{'sfmfloodlightvisit_legacytest'}, "", "2");
    B_ROW();
    
    XHR();
    BROW();
    BCOLTXT("Club","2");
    BCOLTXT($GLOBALS{'sfmclub_name'},"2");
    BCOLTXT("League","2");
    Check_Data("sfmleague",$GLOBALS{'sfmclub_sfmleagueidlist'});
    BCOLTXT($GLOBALS{'sfmleague_name'},"2");
    BCOLTXT("Pitch","2");
    BCOLTXT($GLOBALS{'sfmfacility_name'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Address","2");
    BCOLTXT($GLOBALS{'sfmclub_addr1'},"2");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT($GLOBALS{'sfmclub_addr2'},"3");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","2");
    BCOLTXT($GLOBALS{'sfmclub_addr3'},"2");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","2");
    BCOLTXT($GLOBALS{'sfmclub_addr4'},"2");
    BCOLTXT("","8");
    B_ROW();
    BROW();
    BCOLTXT("","2");
    BCOLTXT($GLOBALS{'sfmclub_postcode'},"2");
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
    BCOLTXT("Hoist Available","2");
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

function SFM_SFMFLOODLIGHTVISITDELETECONFIRM_Output($sfmclub_id,$sfmfloodlightvisit_sfmfacilityid,$sfmfloodlightvisit_id) {
    Get_Data('sfmfloodlightvisit', $sfmfloodlightvisit_sfmfacilityid, $sfmfloodlightvisit_id);
    XH3("Delete Floodlighting Visit - ".$sfmfloodlightvisit_sfmfacilityid."/".$sfmfloodlightvisit_id);
    XPTXT("Are you sure you want to delete this visit");
    XBR();
    XFORM("sfmfloodlightvisitdeleteaction.php","deletevisit");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfloodlightvisit_sfmfacilityid",$sfmfloodlightvisit_sfmfacilityid);
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

function SFM_SFMFLOODLIGHTSPECIFICATION_Output($sfmclub_id,$sfmfacility_id) {

    // === Create key records if the dont exist ==================
    Check_Data('sfmfacility',$sfmfacility_id);
    Check_Data('sfmfloodlightcolumn',$sfmfacility_id,"0");
    if ($GLOBALS{'IOWARNING'} == "1") {
        Initialise_Data("sfmfloodlightcolumn");
        $GLOBALS{'sfmfloodlightcolumn_qty'} =  $GLOBALS{'sfmfacility_floodlightcolumnqty'};
        $GLOBALS{'sfmfloodlightcolumn_fixtureqty'} =  $GLOBALS{'sfmfacility_floodlightfixtureqty'};
        $GLOBALS{'sfmfloodlightcolumn_columntypeid'} =  $GLOBALS{'sfmfacility_floodlightcolumntypeid'};
        $GLOBALS{'sfmfloodlightcolumn_columnheight'} =  $GLOBALS{'sfmfacility_floodlightcolumnheight'};
        Write_Data('sfmfloodlightcolumn',$sfmfacility_id,"0");
        XPTXTCOLOR("New Column Specification Master Record Created","green");
    }
    Check_Data('sfmfloodlightelement',$sfmfacility_id,"0","0");
    if ($GLOBALS{'IOWARNING'} == "1") {
        Initialise_Data("sfmfloodlightelement");
        Write_Data('sfmfloodlightelement',$sfmfacility_id,"0","0");
        XPTXTCOLOR("New Element Specification Master Record Created","green");
    }

    $GLOBALS{'sfmlevel'} = 4;

    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");

    XBR();
    Get_Data('sfmclub', $sfmclub_id);
    Get_Data('sfmfacility', $sfmfacility_id);

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
    XINHID("sfmfacility_id",$sfmfacility_id);
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

    $headingtext = $GLOBALS{'sfmclub_name'}." - ".$GLOBALS{'sfmfacility_name'};
    XH3("Floodlight Specification - ".$headingtext);
    XHRCLASS('underline');
    XBR();

    $maxcolqty=8;

    BTABDIV('floodlightcolumntabmenu');
    BTABHEADERCONTAINER();
    BTABHEADERITEMACTIVE("TabCol0","Summary");
    for ($ci=1; $ci<=$maxcolqty; $ci++ ) {
        Check_Data('sfmfloodlightcolumn',$GLOBALS{'sfmfacility_id'},$ci);
        if ($GLOBALS{'IOWARNING'} == "0") {
            BTABHEADERITEM("TabCol".$ci,"Column ".$ci);
        }
    }
    B_TABHEADERCONTAINER();
    BTABCONTENTCONTAINER();
    BTABCONTENTITEMACTIVE("TabCol0");
    Get_Data('sfmfloodlightcolumn',$GLOBALS{'sfmfacility_id'},"0");
    ColSummaryContent();
    B_TABCONTENTITEM();
    for ($ci=1; $ci<=$maxcolqty; $ci++ ) {
        Check_Data('sfmfloodlightcolumn',$GLOBALS{'sfmfacility_id'},$ci);
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

    B_COLCARD();
    B_SECTIONROW();
    B_SECTION();

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
    BINBUTTONIDSPECIALICON ("ReplicateSpec","success","Create Detailed Information ","clone");
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
    $thiscolqty = $GLOBALS{'sfmfacility_floodlightcolumnqty'};
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
    BROW();
    BCOLTXT("Caption","2"); BCOLINTXTID('sfmfloodlightcolumn_image1title_0','sfmfloodlightcolumn_image1title_0',$GLOBALS{'sfmfloodlightcolumn_image1title'},"4");  B_ROW();
    XBR();
    XINHID("sfmfloodlightcolumn_image1_0",$GLOBALS{'sfmfloodlightcolumn_image1'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfloodlightcolumn_image1_0";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfloodlightcolumn_image1'};
    $imageuploadto = "FloodSpec";
    $imageuploadid = $GLOBALS{'sfmfloodlightcolumn_sfmfacilityid'}."Image1";
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
    BROW();
    BCOLTXT("Caption","2"); BCOLINTXTID('sfmfloodlightcolumn_image2title_0','sfmfloodlightcolumn_image2title_0',$GLOBALS{'sfmfloodlightcolumn_image2title'},"4");  B_ROW();
    XBR();
    XINHID("sfmfloodlightcolumn_image2_0",$GLOBALS{'sfmfloodlightcolumn_image2'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfloodlightcolumn_image2_0";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfloodlightcolumn_image2'};
    $imageuploadto = "FloodSpec";
    $imageuploadid = $GLOBALS{'sfmfloodlightcolumn_sfmfacilityid'}."Image2";
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
    Get_Data('sfmfloodlightelement',$GLOBALS{'sfmfacility_id'},$GLOBALS{'sfmfloodlightcolumn_id'},$lampi);
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
    BCOLTXT("Product Code","3");
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
    BCOLTXT("Product Code","3");
    BCOLINTXTID("sfmfloodlightelement_ballastserialno_".$colid."_".$lampi,"sfmfloodlightelement_ballastserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballastserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_ballastmanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_ballastmanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballastmanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_ballastupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_ballastupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_ballastupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_ballastreplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_ballastreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_ballastreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Capacitor</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightcapacitortype","sfmfloodlightcapacitortype_id","sfmfloodlightcapacitortype_name","sfmfloodlightcapacitortype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_capacitortypeid_".$colid."_".$lampi,"sfmfloodlightelement_capacitortypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitortypeid'},"3");
    BCOLTXT("Product Code","3");
    BCOLINTXTID("sfmfloodlightelement_capacitorserialno_".$colid."_".$lampi,"sfmfloodlightelement_capacitorserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitorserialno'},"3");
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
    BCOLTXT("Product Code","3");
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
    Get_Data('sfmfloodlightelement',$GLOBALS{'sfmfacility_id'},$GLOBALS{'sfmfloodlightcolumn_id'},$lampi);
    XBR();
    BROW();BCOLTXTCOLOR("<b>Fixture</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightfixturetype","sfmfloodlightfixturetype_id","sfmfloodlightfixturetype_name","sfmfloodlightfixturetype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_fixturetypeid_".$colid."_".$lampi,"sfmfloodlightelement_fixturetypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_fixturetypeid'},"3");
    BCOLTXT("Product Code","3");
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
    BCOLTXT("Product Code","3");
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
    BCOLTXT("Product Code","3");
    BCOLINTXTID("sfmfloodlightelement_ballastserialno_".$colid."_".$lampi,"sfmfloodlightelement_ballastserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballastserialno'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Manufacturer","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightmanufacturer","sfmfloodlightmanufacturer_id","sfmfloodlightmanufacturer_name","sfmfloodlightmanufacturer_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_ballastmanufacturerid_".$colid."_".$lampi,"sfmfloodlightelement_ballastmanufacturerid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_ballastmanufacturerid'},"3");
    BCOLTXT("Install Date","3");
    BCOLINDATEID("sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi,"sfmfloodlightelement_lampinstalldate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_lampinstalldate'}),'dd/mm/yyyy',"3");
    B_ROW();
    BROW();
    BCOLTXT("Upgrade Date","3");
    BCOLINDATEID("sfmfloodlightelement_ballastupgradedate_".$colid."_".$lampi,"sfmfloodlightelement_ballastupgradedate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_ballastupgradedate'}),'dd/mm/yyyy',"3");
    BCOLTXT("Replacement Date","3");
    BCOLINDATEID("sfmfloodlightelement_ballastreplacementdate_".$colid."_".$lampi,"sfmfloodlightelement_ballastreplacementdate_".$colid."_".$lampi.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfloodlightelement_ballastreplacementdate'}),'dd/mm/yyyy',"3");
    B_ROW();
    XBR();
    BROW();BCOLTXTCOLOR("<b>Capacitor</b>","6","white","blue");BCOLTXT("","6");B_ROW();
    BROW();
    BCOLTXT("Type","3");
    $xhash = Get_SelectArrays_Hash ("sfmfloodlightcapacitortype","sfmfloodlightcapacitortype_id","sfmfloodlightcapacitortype_name","sfmfloodlightcapacitortype_id","","" );
    BCOLINSELECTHASHID ($xhash,"sfmfloodlightelement_capacitortypeid_".$colid."_".$lampi,"sfmfloodlightelement_capacitortypeid_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitortypeid'},"3");
    BCOLTXT("Product Code","3");
    BCOLINTXTID("sfmfloodlightelement_capacitorserialno_".$colid."_".$lampi,"sfmfloodlightelement_capacitorserialno_".$colid."_".$lampi,$GLOBALS{'sfmfloodlightelement_capacitorserialno'},"3");
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
    BCOLTXT("Product Code","3");
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
    $sfmfacilitya = Get_Array('sfmfacility');
    foreach ($sfmfacilitya as $sfmfacility_id) {
        Get_Data('sfmfacility',$sfmfacility_id);
        XPTXT($sfmfacility_id." ground ");
        $sfmfloodlightvisita = Get_Array('sfmfloodlightvisit',$sfmfacility_id);
        foreach ($sfmfloodlightvisita as $sfmfloodlightvisit_id) {
            Get_Data('sfmfloodlightvisit',$sfmfacility_id,$sfmfloodlightvisit_id);
            XPTXT($sfmfacility_id." visit ");
            $GLOBALS{'sfmfacility_floodlightcolumnrag'} = "Green";
            $GLOBALS{'sfmfacility_floodlightcolumnragcomments'} = "";
            $GLOBALS{'sfmfacility_floodlightcolumnreplacementdate'} = "";
            $GLOBALS{'sfmfacility_floodlightbaserag'} = "Green";
            $GLOBALS{'sfmfacility_floodlightbaseragcomments'} = "";
            $GLOBALS{'sfmfacility_floodlightbasereplacementdate'} = "";
            $GLOBALS{'sfmfacility_floodlightfixturerag'} = "Green";
            $GLOBALS{'sfmfacility_floodlightfixtureragcomments'} = "";
            $GLOBALS{'sfmfacility_floodlightfixturereplacementdate'} = "";
            $GLOBALS{'sfmfacility_floodlightelectricsrag'} = "Green";
            $GLOBALS{'sfmfacility_floodlightelectricsragcomments'} = "";
            $GLOBALS{'sfmfacility_floodlightelectricsreplacementdate'} = "";
            $GLOBALS{'sfmfacility_floodlightlamprag'} = "Green";
            $GLOBALS{'sfmfacility_floodlightlampragcomments'} = "";
            $GLOBALS{'sfmfacility_floodlightlampreplacementdate'} = "";
            $GLOBALS{'sfmfacility_floodlightspillluxrag'} = "Green";

            $GLOBALS{'sfmfacility_lastfloodlightreviewdate'} = $GLOBALS{'sfmfloodlightvisit_date'};
            $GLOBALS{'sfmfacility_lastfloodlightreviewername'} = $GLOBALS{'sfmfloodlightvisit_reviewername'};
            $GLOBALS{'sfmfacility_lastfloodlightreviewdecision'} = $GLOBALS{'sfmfloodlightvisit_reviewerdecision'};
            $GLOBALS{'sfmfacility_floodlightavglux'} = $GLOBALS{'sfmfloodlightvisit_avglux'};
            $GLOBALS{'sfmfacility_floodlightavgluxreqd'} = $GLOBALS{'sfmfloodlightvisit_averageluxreqd'};
            $GLOBALS{'sfmfacility_floodlightminlux'} = $GLOBALS{'sfmfloodlightvisit_minlux'};
            $GLOBALS{'sfmfacility_floodlightmaxlux'} = $GLOBALS{'sfmfloodlightvisit_maxlux'};
            $GLOBALS{'sfmfacility_floodlightminmaxlux'} = $GLOBALS{'sfmfloodlightvisit_minmaxlux'};
            $GLOBALS{'sfmfacility_floodlightminmaxluxreqd'} = $GLOBALS{'sfmfloodlightvisit_minmaxluxreqd'};
            $GLOBALS{'sfmfacility_floodlightminavglux'} = $GLOBALS{'sfmfloodlightvisit_minavglux'};
        }
        Write_Data('sfmfacility',$sfmfacility_id);
        XPTXT($sfmfacility_id." updated");
    }
}

function SFM_SFMREPLICATEALL_Output() {
    XH3("Column/Lamp Replicate Utilitry");
    $sfmfacilitya = Get_Array('sfmfacility');
    foreach ($sfmfacilitya as $sfmfacility_id) {
        SFMREPLICATESPEC($sfmfacility_id);
    }
}

function SFM_SFMFLOODLIGHTSPECGENERATE_Output() {
    XH3("Floodlight Spec Generate Utility");
    $sfmfacilitya = Get_Array('sfmfacility');
    foreach ($sfmfacilitya as $sfmfacility_id) {
        Get_Data('sfmfacility',$sfmfacility_id);
        XPTXT($sfmfacility_id." ground ");
        $sfmfloodlightvisita = Get_Array('sfmfloodlightvisit',$sfmfacility_id);
        foreach ($sfmfloodlightvisita as $sfmfloodlightvisit_id) {
            Get_Data('sfmfloodlightvisit',$sfmfacility_id,$sfmfloodlightvisit_id);

            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_pitchlength'}." <= ".$GLOBALS{'sfmfacility_pitchlength'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_pitchwidth'}." <= ".$GLOBALS{'sfmfacility_pitchwidth'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_columnqty'}." <= ".$GLOBALS{'sfmfacility_floodlightcolumnqty'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_columnheight'}." <= ".$GLOBALS{'sfmfacility_floodlightcolumnheight'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_columntypeid'}." <= ".$GLOBALS{'sfmfacility_floodlightcolumntypeid'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_fixtureqty'}." <= ".$GLOBALS{'sfmfacility_floodlightfixtureqty'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_pitchorientation'}." <= ".$GLOBALS{'sfmfacility_pitchorientation'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_dugoutposition'}." <= ".$GLOBALS{'sfmfacility_dugoutposition'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'}." <= ".$GLOBALS{'sfmfacility_sfmpitchtypeid'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_fixturetypeid'}." <= ".$GLOBALS{'sfmfacility_floodlightfixturetypeid'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'}." <= ".$GLOBALS{'sfmfacility_floodlightfixturemanufacturerid'},"green");
            XPTXTCOLOR($GLOBALS{'sfmfloodlightvisit_lamptypeid'}." <= ".$GLOBALS{'sfmfacility_floodlightlamptypeid'},"green");


            $GLOBALS{'sfmfacility_pitchlength'} = $GLOBALS{'sfmfloodlightvisit_pitchlength'};
            $GLOBALS{'sfmfacility_pitchwidth'} = $GLOBALS{'sfmfloodlightvisit_pitchwidth'};
            $GLOBALS{'sfmfloodlightvisit_columnqty'} = $GLOBALS{'sfmfacility_floodlightcolumnqty'};
            $GLOBALS{'sfmfloodlightvisit_columnheight'} = $GLOBALS{'sfmfacility_floodlightcolumnheight'};
            $GLOBALS{'sfmfloodlightvisit_columntypeid'} = $GLOBALS{'sfmfacility_floodlightcolumntypeid'};
            $GLOBALS{'sfmfloodlightvisit_fixtureqty'} = $GLOBALS{'sfmfacility_floodlightfixtureqty'};
            $GLOBALS{'sfmfloodlightvisit_pitchorientation'} = $GLOBALS{'sfmfacility_pitchorientation'};
            $GLOBALS{'sfmfloodlightvisit_dugoutposition'} = $GLOBALS{'sfmfacility_dugoutposition'};
            $GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'} = $GLOBALS{'sfmfacility_sfmpitchtypeid'};

            $GLOBALS{'sfmfloodlightvisit_fixturetypeid'} = $GLOBALS{'sfmfacility_floodlightfixturetypeid'};
            $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'} = $GLOBALS{'sfmfacility_floodlightfixturemanufacturerid'};
            $GLOBALS{'sfmfloodlightvisit_lamptypeid'} = $GLOBALS{'sfmfacility_floodlightlamptypeid'};

            XPTXT($sfmfacility_id." ".$sfmfloodlightvisit_id." synchronised");
            Write_Data('sfmfloodlightvisit',$sfmfacility_id,$sfmfloodlightvisit_id);
            Write_Data('sfmfacility',$sfmfacility_id);
        }

    }
}

function SFMREPLICATESPEC($sfmfacility_id) {
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

    Get_Data('sfmfacility',$sfmfacility_id);
    $colqty = 0;
    $fixtureqty = 0;
    $summarylampconfig = "";
    Check_Data('sfmfloodlightcolumn',$sfmfacility_id,"0");
    if ($GLOBALS{'IOWARNING'} == "0") {
        Check_Data('sfmfloodlightelement',$sfmfacility_id,"0","0");
        XPTXT($sfmfacility_id." ground ".$GLOBALS{'sfmfloodlightcolumn_qty'}.' '.$GLOBALS{'sfmfloodlightcolumn_fixtureqty'});
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
                Write_Data('sfmfloodlightcolumn',$sfmfacility_id,$ci);
                XPTXTCOLOR($ci." column ".$GLOBALS{'sfmfloodlightcolumn_lampconfig'},"red");
                for ($li=1; $li<=$GLOBALS{'sfmfloodlightcolumn_fixtureqty'}; $li++ ) {
                    $GLOBALS{'sfmfloodlightelement_location'} = $li;
                    Write_Data('sfmfloodlightelement',$sfmfacility_id,$ci,$li);
                    XPTXTCOLOR($li." lamp ","green");
                }
            }
            // == set lamp configuration for whole system ======
            Get_Data('sfmfloodlightcolumn',$sfmfacility_id,"0");
            $GLOBALS{'sfmfloodlightcolumn_lampconfig'} = $summarylampconfig;
            Write_Data('sfmfloodlightcolumn',$sfmfacility_id,"0");
        }

        $GLOBALS{'sfmfacility_floodlightcolumnqty'} = $colqty;
        $GLOBALS{'sfmfacility_floodlightfixtureqty'} = $fixtureqty;
        Write_Data('sfmfacility',$sfmfacility_id);

        XPTXT($sfmfacility_id." updated: ".$colqty." ".$fixtureqty." ".$summarylampconfig);
    }
}

function SFM_SFMDEREPLICATEALL_Output() {
    XH3("Column/Lamp DeReplicate Utilitry");
    $sfmfacilitya = Get_Array('sfmfacility');
    foreach ($sfmfacilitya as $sfmfacility_id) {
        SFMDEREPLICATESPEC($sfmfacility_id);
    }
}


function SFMDEREPLICATESPEC($sfmfacility_id) {
    $cola = Get_Array('sfmfloodlightcolumn',$sfmfacility_id);
    foreach ($cola as $colid) {
        if ($colid != "0") {
            Delete_Data('sfmfloodlightcolumn',$sfmfacility_id,$colid);
            XPTXTCOLOR($sfmfacility_id.": Column".$colid." removed","green");
        }
    }
    $cola = Get_Array('sfmfloodlightelement',$sfmfacility_id);
    foreach ($cola as $colid) {
        if ($colid != "0") {
            $elementa = Get_Array('sfmfloodlightelement',$sfmfacility_id,$colid);
            foreach ($elementa as $elementid) {
                if ($elementid != "0") {
                    Delete_Data('sfmfloodlightelement',$sfmfacility_id,$colid,$elementid);
                    XPTXTCOLOR($sfmfacility_id.": Element".$colid." ".$elementid." removed","green");
                }
            }
        }
    }
}


// ====== Light Test App ========

function SFM_SFMLLTAPPLEAGUELIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,getscreensize";
}

function SFM_SFMLLTAPPLEAGUELIST_Output() {
    XH2("Light Level Test App");
    XBR();XBR();
    XDIV("simpletablediv","container");
    XTABLECOMPACTJQDTID("simpletabletable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("League Name");
    XTDHTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");

    $sfmleaguea = Get_Array('sfmleague');
    foreach ($sfmleaguea as $sfmleague_id) {
        Get_Data('sfmleague',$sfmleague_id);
        XTRJQDT();
        XTDTXT($GLOBALS{'sfmleague_name'});
        $link = YPGMLINK("sfmappclublistout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("sfmleague_id",$sfmleague_id);
        XTDLINKTXT($link,"select");
        X_TR();
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv");
    XCLEARFLOAT();
}

function SFM_SFMLLTAPPPITCHLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function SFM_SFMLLTAPPPITCHLIST_Output($sfmleague_id) {
    Get_Data('sfmleague',$sfmleague_id);
    XH2("Light Level Test App - ".$GLOBALS{'sfmleague_name'});
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
        if ($GLOBALS{'sfmclub_sfmleagueidlist'} == $sfmleague_id) {
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
    Get_Data('sfmfacility',$GLOBALS{'sfmclub_sfmfacilityidlist'});
    $sfmfloodlightvisita = Get_Array('sfmfloodlightvisit',$GLOBALS{'sfmclub_sfmfacilityidlist'});
    $lastsfmfloodlightvisit_id = "";
    foreach ($sfmfloodlightvisita as $sfmfloodlightvisit_id) {
        $visitfound = "1";
        $lastsfmfloodlightvisit_id = $sfmfloodlightvisit_id;
    }

    XH2($GLOBALS{'sfmclub_name'});
    if ( $lastsfmfloodlightvisit_id != "" ) {
        Get_Data('sfmfloodlightvisit',$GLOBALS{'sfmclub_sfmfacilityidlist'},$lastsfmfloodlightvisit_id);
        XFORMUPLOAD("sfmlltappout.php","sfmclubupdateformold");
        XINSTDHID();
        XINHID("VisitAction","Update");
        XINHID("ScreenHeight",$screenheight);
        XINHID("ScreenWidth",$screenwidth);
        XINHID("sfmclub_id",$sfmclub_id);
        XINHID("sfmfacility_id",$GLOBALS{'sfmclub_sfmfacilityidlist'});
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
        XINHID("sfmfacility_id",$GLOBALS{'sfmclub_sfmfacilityidlist'});
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
    XINHID("sfmfacility_id",$GLOBALS{'sfmclub_sfmfacilityidlist'});
    XINHID("sfmfloodlightvisit_id","New");
    XINSUBMIT("Start New Biennial LLT");
    X_FORM();

}

function SFM_SFMLLTAPP_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jsignature";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,sfmlltapp,jqueryconfirm,jsignaturemin";
}

function SFM_SFMLLTAPP_Output($screenheight,$screenwidth,$sfmclub_id,$sfmfacility_id,$sfmfloodlightvisit_id,$visitaction) {
    Get_Data('sfmclub',$sfmclub_id);
    Get_Data('sfmfacility',$sfmfacility_id);
    if ( $visitaction == "New" ) {
        Initialise_Data("sfmfloodlightvisit");
        $GLOBALS{'sfmfloodlightvisit_id'} = $GLOBALS{'currenttimestamp'};
        $GLOBALS{'sfmfloodlightvisit_type'} = "LLTBiennial";
        $GLOBALS{'sfmfloodlightvisit_date'} = $GLOBALS{'currentYYYY-MM-DD'};
        $GLOBALS{'sfmfloodlightvisit_starttime'} = $GLOBALS{'acthh'}.":".$GLOBALS{'actmm'};
        $GLOBALS{'sfmfloodlightvisit_pitchlength'} = $GLOBALS{'sfmfacility_pitchlength'};
        $GLOBALS{'sfmfloodlightvisit_pitchwidth'} = $GLOBALS{'sfmfacility_pitchwidth'};
        $GLOBALS{'sfmfloodlightvisit_columnqty'} = $GLOBALS{'sfmfacility_floodlightcolumnqty'};
        $GLOBALS{'sfmfloodlightvisit_columnheight'} = $GLOBALS{'sfmfacility_floodlightcolumnheight'};
        $GLOBALS{'sfmfloodlightvisit_columntypeid'} = $GLOBALS{'sfmfacility_floodlightcolumntypeid'};
        $GLOBALS{'sfmfloodlightvisit_columnmanufacturerid'} = $GLOBALS{'sfmfacility_floodlightcolumnmanufacturerid'};
        $GLOBALS{'sfmfloodlightvisit_columninstalldate'} = $GLOBALS{'sfmfacility_floodlightcolumninstalldate'};
        $GLOBALS{'sfmfloodlightvisit_fixtureqty'} = $GLOBALS{'sfmfacility_floodlightfixtureqty'};
        $GLOBALS{'sfmfloodlightvisit_pitchorientation'} = $GLOBALS{'sfmfacility_pitchorientation'};
        $GLOBALS{'sfmfloodlightvisit_dugoutposition'} = $GLOBALS{'sfmfacility_dugoutposition'};
        $GLOBALS{'sfmfloodlightvisit_sfmpitchtypeid'} = $GLOBALS{'sfmfacility_sfmpitchtypeid'};

        $GLOBALS{'sfmfloodlightvisit_fixturetypeid'} = $GLOBALS{'sfmfacility_floodlightfixturetypeid'};
        $GLOBALS{'sfmfloodlightvisit_fixturemanufacturerid'} = $GLOBALS{'sfmfacility_floodlightfixturemanufacturerid'};
        $GLOBALS{'sfmfloodlightvisit_fixtureinstalldate'} = $GLOBALS{'sfmfacility_floodlightfixtureinstalldate'};
        $GLOBALS{'sfmfloodlightvisit_lamptypeid'} = $GLOBALS{'sfmfacility_floodlightlamptypeid'};

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
        Get_Data('sfmfloodlightvisit',$sfmfacility_id,$sfmfloodlightvisit_id);
    }
    if ( $visitaction == "ReTest" ) {
        Get_Data('sfmfloodlightvisit',$sfmfacility_id,$sfmfloodlightvisit_id);
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
    XINHID("sfmfacility_id",$sfmfacility_id);
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
            if ((($li == 5)||($li == 7))&&($GLOBALS{"sfmfacility_dugoutposition"} == "Left")) {
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
            if ((($li == 5)||($li == 7))&&($GLOBALS{"sfmfacility_dugoutposition"} == "Right")) {
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
            if ((($li == 5)||($li == 7))&&($GLOBALS{"sfmfacility_dugoutposition"} == "Left")) {
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

function SFM_SFMFACILITYVISIT_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,sfmfacilityvisitupdate,accredviewlist,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm,jqdatatablesmin,report,areyousure";
}

function SFM_SFMFACILITYVISIT_Output($sfmclub_id,$sfmfacilityvisit_sfmfacilityid,$sfmfacilityvisit_id,$currenttab) {

    $GLOBALS{'sfmlevel'} = 4;

    Get_Data('sfmclub', $sfmclub_id);
    // XH2("Facility ".$sfmfacilityvisit_sfmfacilityid);
    Check_Data('sfmfacility', $sfmfacilityvisit_sfmfacilityid);
    if ( $sfmfacilityvisit_id == "New" ) {
        Initialise_Data('sfmfacilityvisit');
        $GLOBALS{'sfmfacilityvisit_id'} = $GLOBALS{'currenttimestamp'};
        $sfmfacilityvisit_id = $GLOBALS{'currenttimestamp'};
        $GLOBALS{'sfmfacilityvisit_type'} = "GGInspection";
        $GLOBALS{'sfmfacilityvisit_date'} = $GLOBALS{'currentYYYY-MM-DD'};
        $GLOBALS{'sfmfacilityvisit_starttime'} = $GLOBALS{'acthh'}.":".$GLOBALS{'actmm'};
        $GLOBALS{'sfmfacilityvisit_pitchlength'} = $GLOBALS{'sfmfacility_pitchlength'};
        $GLOBALS{'sfmfacilityvisit_pitchwidth'} = $GLOBALS{'sfmfacility_pitchwidth'};
        $GLOBALS{'sfmfacilityvisit_pitchorientation'} = $GLOBALS{'sfmfacility_pitchorientation'};
        $GLOBALS{'sfmfacilityvisit_dugoutposition'} = $GLOBALS{'sfmfacility_dugoutposition'};
        $GLOBALS{'sfmfacilityvisit_sfmpitchtypeid'} = $GLOBALS{'sfmfacility_sfmpitchtypeid'};
        $GLOBALS{'sfmfacilityvisit_gradingtarget'} = $GLOBALS{'sfmfacility_gradingtarget'};

        // initialise inspection stats with self assessment stats
        $accredcriteriaa = Get_Array("accredcriteria",$GLOBALS{'sfmfacility_gradingtarget'},$sfmfacilityvisit_sfmfacilityid);
        foreach ($accredcriteriaa as $accredcriteria_id) {
            Get_Data("accredcriteria",$GLOBALS{'sfmfacility_gradingtarget'},$sfmfacilityvisit_sfmfacilityid,$accredcriteria_id);
            // XPTXTCOLOR($accredcriteria_id,"orange");
            if ($GLOBALS{'accredcriteria_type'} == "data") {
                $GLOBALS{'accredcriteria_inspectiondataradioresult'} = $GLOBALS{'accredcriteria_dataradioresult'};
                $GLOBALS{'accredcriteria_inspectiondatacheckboxresult'} = $GLOBALS{'accredcriteria_datacheckboxresult'};
                $GLOBALS{'accredcriteria_inspectiondatatextresult'} = $GLOBALS{'accredcriteria_datatextresult'};
            }
            Write_Data("accredcriteria",$GLOBALS{'sfmfacility_gradingtarget'},$sfmfacilityvisit_sfmfacilityid,$accredcriteria_id);
        }

        Write_Data('sfmfacilityvisit', $sfmfacilityvisit_sfmfacilityid, $sfmfacilityvisit_id);
    } else {
        Check_Data('sfmfacilityvisit', $sfmfacilityvisit_sfmfacilityid, $sfmfacilityvisit_id);
    }

    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");
    $headingtext = $GLOBALS{'sfmfacility_name'}." - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacilityvisit_date'});
    XH2("Ground Grading Inspection - ".$headingtext);
    B_COLCARD();
    B_SECTIONROW();
    B_SECTION();

    XFORMUPLOAD("sfmfacilityvisitupdatein.php","sfmfacilityvisitupdateform");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfacilityvisit_sfmfacilityid",$sfmfacilityvisit_sfmfacilityid);
    XINHID("sfmfacilityvisit_id",$sfmfacilityvisit_id);
    XINHID("sfmfacilityvisit_gradingtarget",$GLOBALS{'sfmfacilityvisit_gradingtarget'});
    XINHID("sfmuserlevel",$GLOBALS{'sfmlevel'});
    XINHID("GroundGradingChanged","");
    XINHID("SubmitAction","");
    XINHID("CurrentTab",$currenttab);

    $GLOBALS{'CROPPARMS'} = Array();

    BROW();
    BCOLTXT("","9");
    BCOL("2");
    if ( $GLOBALS{'sfmlevel'} > 2 ) {	BINBUTTONIDSPECIAL("SaveTop","primary","Save"); }
    BINBUTTONIDSPECIAL("CloseTop","warning","Close"); XBR();
    B_COL();
    B_ROW();
    
    BSECTION();
    BSECTIONROW();
    BCOLCARD("12");
    
    BROW();
    BCOLTXT("","11");
    BCOL("1"); BIMGID("mpdfreports","../site_assets/MPDFRelevantReports.png","50"); B_COL();
    B_ROW();
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
    B_COLCARD();
    B_SECTIONROW();
    B_SECTION();
    
    BROW();
    BCOLTXT("","9");
    BCOL("2");
    if ( $GLOBALS{'sfmlevel'} > 2 ) {	BINBUTTONIDSPECIAL("SaveBottom","primary","Save"); }
    BINBUTTONIDSPECIAL("CloseBottom","warning","Close"); XBR();
    B_COL();
    B_ROW();

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
    $xhash = Get_SelectArrays_Hash ("sfmvisittype","sfmvisittype_id","sfmvisittype_title","sfmvisittype_id","sfmvisittype_type","Ground" );
    BCOLINSELECTHASHID ($xhash,'sfmfacilityvisit_type','sfmfacilityvisit_type',$GLOBALS{'sfmfacilityvisit_type'},"3");
    BCOLTXT("Reviewer Name","1");
    BCOLINTXTID('sfmfacilityvisit_reviewername','sfmfacilityvisit_reviewername',$GLOBALS{'sfmfacilityvisit_reviewername'},"3");
    BCOLTXT("Reviewer Role","1");
    BCOLINTXTID('sfmfacilityvisit_reviewerrole','sfmfacilityvisit_reviewerrole',$GLOBALS{'sfmfacilityvisit_reviewerrole'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Reviewer Tel","1");
    BCOLINTXTID('sfmfacilityvisit_reviewertel','sfmfacilityvisit_reviewertel',$GLOBALS{'sfmfacilityvisit_reviewertel'},"3");
    BCOLTXT("Reviewer EMail","1");
    BCOLINTXTID('sfmfacilityvisit_revieweremail','sfmfacilityvisit_revieweremail',$GLOBALS{'sfmfacilityvisit_revieweremail'},"3");
    BCOLTXT("Club Rep","1");
    BCOLINTXTID('sfmfacilityvisit_clubrepname','sfmfacilityvisit_clubrepname',$GLOBALS{'sfmfacilityvisit_clubrepname'},"3");
    B_ROW();
    BROW();
    BCOLTXT("Date","1");
    BCOLINDATEID('sfmfacilityvisit_date','sfmfacilityvisit_date_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'sfmfacilityvisit_date'}),'dd/mm/yyyy',"3");
    BCOLTXT("Start","1");
    BCOLINTXTID ("sfmfacilityvisit_starttime","sfmfacilityvisit_starttime",$GLOBALS{'sfmfacilityvisit_starttime'},"3");
    BCOLTXT("Finish","1");
    BCOLINTXTID ("sfmfacilityvisit_endtime","sfmfacilityvisit_endtime",$GLOBALS{'sfmfacilityvisit_endtime'},"3");
    BCOLTXT("","4");
    B_ROW();
    XHR();
    BROW();
    BCOLTXT("Club","1");
    BCOLTXT($GLOBALS{'sfmclub_name'},"3");
    BCOLTXT("League","1");
    Check_Data("sfmleague",$GLOBALS{'sfmclub_sfmleagueidlist'});
    BCOLTXT($GLOBALS{'sfmleague_name'},"3");
    BCOLTXT("Pitch","1");
    BCOLTXT($GLOBALS{'sfmfacility_name'},"3");
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
    BCOLTXT($GLOBALS{'sfmfacilityvisit_reviewername'},"6");
    BCOLTXT($GLOBALS{'sfmfacilityvisit_clubrepname'},"6");
    B_ROW();
    BROW();
    BCOLIMG ($GLOBALS{'sfmfacilityvisit_reviewersignature'},"150","6");
    BCOLIMG ($GLOBALS{'sfmfacilityvisit_clubrepsignature'},"150","6");
    B_ROW();
}

function GVISITGGRADContentOutput() {
    XBR();
    XH3("Ground Grading Checksheet");
    XHRCLASS('underline');
    XBR();

    $inaccredscheme_id = $GLOBALS{'sfmfacilityvisit_gradingtarget'};
    $inaccredcriteria_clubid = $_REQUEST['sfmclub_id'];
    Library_ACCREDVIEWLIST_Output ($inaccredscheme_id,$inaccredcriteria_clubid,"Inspect","");
}

function GVISITASSESSMENTContentOutput() {

    XBR();    
    XH3("Ground Grading Assessment");
    XHRCLASS('underline');

    BROW();
    BCOLTXT("Grading Level Assessed","2");
    $keylist = ('FAGroundGradingA,FAGroundGradingB,FAGroundGradingC,FAGroundGradingD,FAGroundGradingE,FAGroundGradingF,FAGroundGradingG,FAGroundGradingH');
    $valuelist = ('A,B,C,D,E,F,G,H');
    $xhash = Lists2Hash($keylist,$valuelist);
    BCOLINSELECTHASHID ($xhash,'sfmfacilityvisit_gradingtarget','sfmfacilityvisit_gradingtarget',$GLOBALS{'sfmfacilityvisit_gradingtarget'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Grading Decision","2");
    $xhash = List2Hash('Pass,Advisory,Fail');
    BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacilityvisit_reviewerdecision','rag','sfmfacilityvisit_reviewerdecision',$GLOBALS{'sfmfacilityvisit_reviewerdecision'},"2");
    B_ROW();
    XBR();
    BROWTOP();
    BCOLTXT("Decision Notes","2");
    BCOLINTEXTAREAID('sfmfacilityvisit_reviewerdecisionnotes','sfmfacilityvisit_reviewerdecisionnotes',$GLOBALS{'sfmfacilityvisit_reviewerdecisionnotes'},"4","8");
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

    $sfmrectification_ida = Get_Array("sfmrectification",$GLOBALS{'sfmfacilityvisit_sfmfacilityid'});
    foreach ($sfmrectification_ida as $sfmrectification_id) {
        Get_Data("sfmrectification",$GLOBALS{'sfmfacilityvisit_sfmfacilityid'},$sfmrectification_id);
        if ($GLOBALS{'sfmrectification_source'} == "GroundVisit") {
            if ($GLOBALS{'sfmrectification_sourceid'} == $GLOBALS{'sfmfacilityvisit_id'}) {
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
    BCOLTXT("<b>General Condition</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacilityvisit_generalconditionrag','rag','sfmfacilityvisit_generalconditionrag',$GLOBALS{'sfmfacilityvisit_generalconditionrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfacilityvisit_generalconditionragcomments','sfmfacilityvisit_generalconditionragcomments',$GLOBALS{'sfmfacilityvisit_generalconditionragcomments'},"4","5");
    B_ROW();
    XHRCLASS('underline');
    XH4("Specific Details");XBR();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Ground</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacilityvisit_groundrag','rag','sfmfacilityvisit_groundrag',$GLOBALS{'sfmfacilityvisit_groundrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfacilityvisit_groundragcomments','sfmfacilityvisit_groundragcomments',$GLOBALS{'sfmfacilityvisit_groundragcomments'},"4","5");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Spectator</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacilityvisit_spectatorrag','rag','sfmfacilityvisit_spectatorrag',$GLOBALS{'sfmfacilityvisit_spectatorrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfacilityvisit_spectatorragcomments','sfmfacilityvisit_spectatorragcomments',$GLOBALS{'sfmfacilityvisit_spectatorragcomments'},"4","5");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Dressing Rooms</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacilityvisit_dressingroomrag','rag','sfmfacilityvisit_dressingroomrag',$GLOBALS{'sfmfacilityvisit_dressingroomrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfacilityvisit_dressingroomragcomments','sfmfacilityvisit_dressingroomragcomments',$GLOBALS{'sfmfacilityvisit_dressingroomragcomments'},"4","5");
    B_ROW();
    BROW();
    $xhash = List2Hash('Green,Amber,Red');
    BCOLTXT("<b>Medical</b>","1"); BCOLINSELECTHASHIDCLASS ($xhash,'sfmfacilityvisit_medicalrag','rag','sfmfacilityvisit_medicalrag',$GLOBALS{'sfmfacilityvisit_medicalrag'},"2");
    BCOLTXT("Comments","1");
    BCOLINTEXTAREAID('sfmfacilityvisit_medicalragcomments','sfmfacilityvisit_medicalragcomments',$GLOBALS{'sfmfacilityvisit_medicalragcomments'},"4","5");
    B_ROW();
    XBR();
}

function GVISITIMAGESContentOutput() {
    if ( $GLOBALS{'sfmfacilityvisit_image1caption'} == "" ) { $GLOBALS{'sfmfacilityvisit_image1caption'} = "General View"; }
    /*
     BROW();
     BCOLXS("4"); BTXT('Caption');B_COL();
     BCOLXS("8"); BINTXTID('sfmfacilityvisit_image1caption','sfmfacilityvisit_image1caption',$GLOBALS{'sfmfacilityvisit_image1caption'});B_COL();
     B_ROW();
     */
    XBR();
    BROW();
    BCOL("6");
    XINHID("sfmfacilityvisit_image1",$GLOBALS{'sfmfacilityvisit_image1'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfacilityvisit_image1";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfacilityvisit_image1'};
    $imageuploadto = "GroundVisit";
    $imageuploadid = $GLOBALS{'sfmfacilityvisit_id'}."Image1";
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
    if ( $GLOBALS{'sfmfacilityvisit_image2caption'} == "" ) { $GLOBALS{'sfmfacilityvisit_image2caption'} = "General View"; }
    /*
     BROW();
     // BCOLXS("4"); BTXT('Caption');B_COL();
     BCOLXS("8"); BINTXTID('sfmfacilityvisit_image2caption','sfmfacilityvisit_image2caption',$GLOBALS{'sfmfacilityvisit_image2caption'});B_COL();
     B_ROW();
     */
    BROW();
    BCOL("6");
    XINHID("sfmfacilityvisit_image2",$GLOBALS{'sfmfacilityvisit_image2'});
    // =================== Slim Image Cropper Output =======================
    $imagefieldname = "sfmfacilityvisit_image2";
    $imageviewwidth = "90%";
    $imagename = $GLOBALS{'sfmfacilityvisit_image2'};
    $imageuploadto = "GroundVisit";
    $imageuploadid = $GLOBALS{'sfmfacilityvisit_id'}."Image2";
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
    BCOLINTEXTAREAID ('sfmfacilityvisit_notes','sfmfacilityvisit_notes',$GLOBALS{'sfmfacilityvisit_notes'},"20","8");
    B_ROW();
    XBR();XBR();
}

function SFM_SFMFACILITYVISITDELETECONFIRM_Output($sfmclub_id,$sfmfacilityvisit_sfmfacilityid,$sfmfacilityvisit_id) {
    Get_Data('sfmfacilityvisit', $sfmfacilityvisit_sfmfacilityid, $sfmfacilityvisit_id);
    XH3("Delete Ground Grading Visit - ".$sfmfacilityvisit_sfmfacilityid."/".$sfmfacilityvisit_id);
    XPTXT("Are you sure you want to delete this visit");
    XBR();
    XFORM("sfmfacilityvisitdeleteaction.php","deletevisit");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfacilityvisit_sfmfacilityid",$sfmfacilityvisit_sfmfacilityid);
    XINHID("sfmfacilityvisit_id",$sfmfacilityvisit_id);
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

function SFM_SFMGROUNDGRADINGMATRIX_Output ($insfmfacility_id) {

    XH2("Ground Grading Comparison");
    Get_Data("sfmfacility",$insfmfacility_id);

    $sortschemea = Array();
    $schema = Get_Array("accredscheme");
    foreach ($schema as $schemeid) {
        Get_Data("accredscheme",$schemeid);
        if (( $GLOBALS{'accredscheme_type'} == "Grading" )&&( $GLOBALS{'accredscheme_active'} == "Yes" )) {
            array_push($sortschemea,$GLOBALS{'accredscheme_ranking'}."|".$schemeid."|".$GLOBALS{'accredscheme_shortname'});
        }
    }
    
    sort($sortschemea);
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
    foreach ($sortschemea as $element) {
        $sbits = explode("|",$element);
        $accredscheme_id = $sbits[1];
        $shortname = $sbits[2];
        if ( $accredscheme_id == $GLOBALS{'sfmfacility_gradingtarget'} ) {
            XTDTXTBACKTXTCOLOR($shortname,"#D1F2EB","black");
        } else {
            XTDHTXT($shortname);
        }
    }
    X_TR();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");

    $ida = Get_Array("accredcriteria","FAWGroundGradingA","sfm");
    foreach ($ida as $accredcriteria_id) {
        Get_Data("accredcriteria","FAWGroundGradingA","sfm",$accredcriteria_id);

        if ($GLOBALS{"accredcriteria_type"} == "section") {
            $thisref = $GLOBALS{'accredcriteria_ref'};
            $thissection = $GLOBALS{'accredcriteria_section'};
            XTRJQDT();
            XTDTXT($thissection);
            XTDTXT("");
            XTDTXT("");
            XTDTXT("");
            XTDTXT("");
            foreach ($sortschemea as $element) {
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
            if ($dbits[0] == "sfmfacility") {
                $thisdatafieldvalue = $GLOBALS{'sfmfacility_'.$dbits[1]};
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
  
            foreach ($sortschemea as $element) {
                $sbits = explode("|",$element);
                $accredscheme_id = $sbits[1];             
                Check_Data("accredcriteria",$accredscheme_id,"sfm",$accredcriteria_id);
                if ($GLOBALS{'IOWARNING'} == "0") {
                    if ( $GLOBALS{'accredcriteria_datatargetreqd'} != "" ) {
                        // target exists
                        if ( $accredscheme_id == $GLOBALS{'sfmfacility_gradingtarget'} ) {
                            if ( CheckCompliance($thisdatafieldvalue) == "1" ) {
                                XTDTXTBACKTXTCOLOR($GLOBALS{'accredcriteria_datatargetreqd'},"#D1F2EB","black");
                            } else {
                                XTDTXTBACKTXTCOLOR($GLOBALS{'accredcriteria_datatargetreqd'},"#FADBD8","black");
                            }
                        } else {
                            if ( CheckCompliance($thisdatafieldvalue) == "1") {                                
                                XTDTXTBACKTXTCOLOR($GLOBALS{'accredcriteria_datatargetreqd'},"#E8F6F3","black");
                            } else {
                                XTDTXTBACKTXTCOLOR($GLOBALS{'accredcriteria_datatargetreqd'},"#FDEDEC","black");
                            }
                        }
                    } else {
                        // No target exists
                        if ( $accredscheme_id == $GLOBALS{'sfmfacility_gradingtarget'} ) {
                            XTDTXTBACKTXTCOLOR("","#F2F2F2","black");
                        } else {
                            XTDTXTBACKTXTCOLOR("","#F8F8F8","black");
                        }
                    }
                } else {
                    XTDTXTBACKTXTCOLOR("","white","black");
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

function CheckCompliance( $thisdatafieldvalue ) {
    // only used if target exists
    $result = "0";
    if ( $GLOBALS{'accredcriteria_datatargetreqd'} != "" ) {
        if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Text") { // actually a numeric check
            $thisdatafieldvaluenum = (float)$thisdatafieldvalue;
            $thistargetvaluenum = (float)$GLOBALS{'accredcriteria_datatargetreqd'};
            if ($thisdatafieldvaluenum >= $thistargetvaluenum) { $result = "1"; }
        }
        if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Radio") {
            $valuea = Array();
            $rbits = explode(",",$GLOBALS{'accredcriteria_dataradioquestions'});
            foreach($rbits as $rbit) {
                $sbits = explode("=",$rbit);
                array_push($valuea,$sbits[0]);
            }
            $thisdatafieldvalueindex = array_search($thisdatafieldvalue, $valuea);
            $thistargetvalueindex = array_search($GLOBALS{'accredcriteria_datatargetreqd'}, $valuea);
            if ($thisdatafieldvalueindex <= $thistargetvalueindex) { $result = "1"; }
        }    
    } else {
        $result = "1";
    }
    /*
    if ($GLOBALS{'accredcriteria_id'} == 'a_04_01_e01_i03') {
        XPTXT("GGGGGG ".$GLOBALS{'accredcriteria_schemeid'}." ".$thisdatafieldvalueindex." vs ".$thistargetvalueindex." | ".$result);
    } 
    */      
    return $result;
}




function SFM_SFMGROUNDGRADINGDELETECONFIRM_Output($sfmclub_id,$sfmfacility_id,$accredscheme_id) {
    XH3("Delete Ground Grading Self Assessment - ".$sfmfacility_id."/".$accredscheme_id);
    XPTXT("Are you sure you want to delete this groundgrading information? All self assessments and inspection comments for this level will be removed.");
    XBR();
    XFORM("sfmgroundgradingdeleteaction.php","deletegroundgrading");
    XINSTDHID();
    XINHID("sfmclub_id",$sfmclub_id);
    XINHID("sfmfacility_id",$sfmfacility_id);    
    XINHID("accredscheme_id",$accredscheme_id);
    XINSUBMIT("Confirm Ground Grading Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function SFM_SFMGROUNDGRADINGMANAGE_Output($sfmclub_id,$sfmfacility_id) {
    XH3("Ground Grading Self Assessment Management");
    $accredschemea = Get_Array('accredscheme');
    foreach ($accredschemea as $accredscheme_id) {
        Check_Data('accredscheme',$accredscheme_id);
        Check_Data('accredcriteria',$accredscheme_id,$sfmfacility_id,"a_01");
        if ($GLOBALS{'IOWARNING'} == "0" ) {
            $link = YPGMLINK("sfmgroundgradingdeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("sfmclub_id",$sfmclub_id).YPGMPARM("sfmfacility_id",$sfmfacility_id).YPGMPARM("accredscheme_id",$accredscheme_id);
            XBR(); XLINKTXT($link,"Delete ".$GLOBALS{'accredscheme_name'}." self assessment");
        }
    }
}

function SFM_SFMFACILITYCREATOR_Output () {

    // copy ground to facility
    /*
    $sfmgrounda = Get_Array("sfmground");
    foreach ($sfmgrounda as $sfmground_id) {
        Get_Data("sfmground",$sfmground_id);
        Check_Data("sfmfacility",$sfmground_id);
        if ($GLOBALS{'IOWARNING'} == "1") {
            $tstring = $GLOBALS{"sfmground"."^FIELDS"}; $tfields = explode('|', $tstring);
            foreach ($tfields as $tfieldelement) {
                $tbits = explode("_",$tfieldelement);
                $GLOBALS{"sfmfacility_".$tbits[1]} = $GLOBALS[$tfieldelement];
            }
            $GLOBALS{"sfmfacility_sfmclubidlist"} = $GLOBALS{"sfmground_sfmclubid"};
            XPTXTCOLOR($sfmground_id." created","red");
            Write_Data("sfmfacility",$sfmground_id);
        } else {
            XPTXTCOLOR($sfmground_id." already exists","green");
        }
    }

    // copy ground visit to facility visit

    $sfmgroundvisit2keya = Get_NKey_Array("sfmgroundvisit");
    foreach ($sfmgroundvisit2keya as $sfmgroundvisit2key) {
        $sfmgroundvisitkeya = explode('|',$sfmgroundvisit2key);
        $sfmfacilityvisit_sfmfacilityid = $sfmgroundvisitkeya[0];
        $sfmfacilityvisit_id = $sfmgroundvisitkeya[1];
        Get_Data('sfmgroundvisit',$sfmfacilityvisit_sfmfacilityid,$sfmfacilityvisit_id);
        Check_Data('sfmfacilityvisit',$sfmfacilityvisit_sfmfacilityid,$sfmfacilityvisit_id);
        if ($GLOBALS{'IOWARNING'} == "1") {
            $tstring = $GLOBALS{"sfmgroundvisit"."^FIELDS"}; $tfields = explode('|', $tstring);
            foreach ($tfields as $tfieldelement) {
                $tbits = explode("_",$tfieldelement);
                $GLOBALS{"sfmfacilityvisit_".$tbits[1]} = $GLOBALS[$tfieldelement];
            }
            XPTXTCOLOR($sfmfacilityvisit_sfmfacilityid." ".$sfmfacilityvisit_id." created","red");
            Write_Data("sfmfacilityvisit",$sfmfacilityvisit_sfmfacilityid,$sfmfacilityvisit_id);
        } else {
            XPTXTCOLOR($sfmfacilityvisit_sfmfacilityid." ".$sfmfacilityvisit_id." already exists","green");
        }
    }

    // reset ground fields to facility fields

    $nkeya = Get_NKey_Array('accredcriteria');
    foreach ($nkeya as $nkey) {
        $ka = explode('|',$nkey);
        Get_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
        $thisaccredcriteria_id = $ka[2];
        if ($GLOBALS{'accredcriteria_type'} == "data") {
            if ($GLOBALS{'accredcriteria_datafieldname'} != "") {
                $olddatafieldname = $GLOBALS{'accredcriteria_datafieldname'};
                if (strlen(stristr($olddatafieldname,"sfmfacility_"))>0) {} else {
                    $GLOBALS{'accredcriteria_datafieldname'} = str_replace("sfmground_", "sfmfacility_", $GLOBALS{'accredcriteria_datafieldname'});
                    XPTXTCOLOR($GLOBALS{'accredcriteria_clubid'}." ".$GLOBALS{'accredcriteria_id'}.": ".$olddatafieldname." ==> ".$GLOBALS{'accredcriteria_datafieldname'},"blue");
                    Write_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
                }
            }
        }
    }

    // create teams
    $sfmcluba = Get_Array("sfmclub");
    foreach ($sfmcluba as $sfmclub_id) {
        Get_Data("sfmclub",$sfmclub_id);
        Check_Data('sfmteam',$sfmclub_id);
        if ($GLOBALS{'IOWARNING'} == "1") {
            Initialise_Data('sfmteam');
            XPTXTCOLOR($sfmclub_id." team created","red");
            $GLOBALS{'sfmteam_name'} = $GLOBALS{'sfmclub_name'};
            $GLOBALS{'sfmteam_sfmclubid'} = $sfmclub_id;
            $GLOBALS{'sfmteam_sfmleagueid'} = $GLOBALS{'sfmclub_sfmleagueidlist'};
            $GLOBALS{'sfmteam_sfmdivisionid'} = $GLOBALS{'sfmclub_sfmdivisionidlist'};
            $GLOBALS{'sfmteam_sfmfacilityidlist'} = $GLOBALS{'sfmclub_sfmfacilityidlist'};
            Write_Data("sfmteam",$sfmclub_id);
        } else {
            XPTXTCOLOR($sfmclub_id." team already exists","green");
        }
    }
    */

    // facility linkks
    $sfmfacilitya = Get_Array("sfmfacility");
    foreach ($sfmfacilitya as $sfmfacility_id) {
        Get_Data("sfmfacility",$sfmfacility_id);
        Check_Data('sfmclub',$sfmfacility_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            XPTXTCOLOR($sfmfacility_id." links updated","orange");
            $GLOBALS{'sfmfacility_sfmclubidlist'} = $sfmfacility_id;
            $GLOBALS{'sfmfacility_sfmteamidlist'} = $sfmfacility_id;
            $GLOBALS{'sfmfacility_sfmleagueidlist'} = $GLOBALS{'sfmclub_sfmleagueidlist'};
            $GLOBALS{'sfmfacility_sfmdivisionidlist'} = $GLOBALS{'sfmclub_sfmdivisionidlist'};
            $GLOBALS{'sfmfacility_sfmcountyid'} = $GLOBALS{'sfmclub_sfmcountyid'};
            Write_Data("sfmfacility",$sfmfacility_id);
        }
    }
}

function SFM_SFMDATALISTSUPDATE_Output () {

    $GLOBALS{'sfmdivision_sfmleagueida'} = Array();
    $GLOBALS{'sfmdivision_stepa'} = Array();
    $GLOBALS{'sfmdivision_gradingtargeta'} = Array();    
    
    $GLOBALS{'sfmclub_sfmfacilityidlista'} = Array();
    $GLOBALS{'sfmclub_sfmteamidlista'} = Array();
    $GLOBALS{'sfmclub_sfmleagueidlista'} = Array();
    $GLOBALS{'sfmclub_sfmdivisionidlista'} = Array();

    $GLOBALS{'sfmfacility_sfmclubidlista'} = Array();
    $GLOBALS{'sfmfacility_sfmteamidlista'} = Array();
    $GLOBALS{'sfmfacility_sfmleagueidlista'} = Array();
    $GLOBALS{'sfmfacility_sfmdivisionidlista'} = Array();

    $sfmdivisiona = Get_Array("sfmdivision");
    foreach ( $sfmdivisiona as $sfmdivision_id ) {
        Get_Data("sfmdivision",$sfmdivision_id);
        if ( $GLOBALS{'sfmdivision_sfmleagueid'} != "" ) {
            $GLOBALS{'sfmdivision_sfmleagueida'}[$sfmdivision_id] = $GLOBALS{'sfmdivision_sfmleagueid'};
        }
        if ( $GLOBALS{'sfmdivision_step'} != "" ) {
            $GLOBALS{'sfmdivision_stepa'}[$sfmdivision_id] = $GLOBALS{'sfmdivision_step'};
        }
        if ( $GLOBALS{'sfmdivision_gradingtarget'} != "" ) {
            $GLOBALS{'sfmdivision_gradingtargeta'}[$sfmdivision_id] = $GLOBALS{'sfmdivision_gradingtarget'};
        }
    }
    // print_r($GLOBALS{'sfmdivision_stepa'});
    
    $sfmteama = Get_Array("sfmteam");
    foreach ( $sfmteama as $sfmteam_id ) {
        Get_Data("sfmteam",$sfmteam_id);
        $teamchanged = "0";
        $teamleague_id = "";
        if ( array_key_exists($GLOBALS{'sfmteam_sfmdivisionid'}, $GLOBALS{'sfmdivision_sfmleagueida'}) ) {            
            $GLOBALS{'sfmteam_sfmleagueid'} = $GLOBALS{'sfmdivision_sfmleagueida'}[$GLOBALS{'sfmteam_sfmdivisionid'}];
            // XPTXT("team-step ".$sfmteam_id." ".$GLOBALS{'sfmteam_sfmdivisionid'}." ".$GLOBALS{'sfmteam_sfmleagueid'});
            $teamleague_id = $GLOBALS{'sfmteam_sfmleagueid'};
            $teamchanged = "1";
        }       
        if ( array_key_exists($GLOBALS{'sfmteam_sfmdivisionid'}, $GLOBALS{'sfmdivision_stepa'}) ) {            
            $GLOBALS{'sfmteam_step'} = $GLOBALS{'sfmdivision_stepa'}[$GLOBALS{'sfmteam_sfmdivisionid'}];
            // XPTXT("team-step ".$sfmteam_id." ".$GLOBALS{'sfmteam_sfmdivisionid'}." ".$GLOBALS{'sfmteam_step'});
            $teamchanged = "1";
        }
        if ( $teamchanged = "1" ) {
            Write_Data("sfmteam",$sfmteam_id);
        }
        
        // ==== sfmclub_sfmteamidlist =====
        AddToListA("sfmclub_sfmteamidlista",$GLOBALS{'sfmteam_sfmclubid'},$sfmteam_id);
        $xbits = List2Array($GLOBALS{'sfmteam_sfmfacilityidlist'});
        foreach ( $xbits as $xfacilityid ) {
            // ==== sfmfacility_sfmteamidlist =====
            AddToListA("sfmfacility_sfmteamidlista",$xfacilityid,$sfmteam_id);
            // ==== sfmfacility_sfmclubidlist =====
            AddToListA("sfmfacility_sfmclubidlista",$xfacilityid,$GLOBALS{'sfmteam_sfmclubid'});
            // ==== $sfmfacility_sfmleagueidlista =====
            AddToListA("sfmfacility_sfmleagueidlista",$xfacilityid,$teamleague_id);
            // ==== $sfmfacility_sfmdivisionidlista =====
            AddToListA("sfmfacility_sfmdivisionidlista",$xfacilityid,$GLOBALS{'sfmteam_sfmdivisionid'});

            // ==== sfmclub_sfmfacilityidlist =====
            AddToListA("sfmclub_sfmfacilityidlista",$GLOBALS{'sfmteam_sfmclubid'},$xfacilityid);
             // ==== $sfmclub_sfmleagueidlista =====
            AddToListA("sfmclub_sfmleagueidlista",$GLOBALS{'sfmteam_sfmclubid'},$teamleague_id);
            // ==== $sfmclub_sfmdivisionidlista =====
            AddToListA("sfmclub_sfmdivisionidlista",$GLOBALS{'sfmteam_sfmclubid'},$GLOBALS{'sfmteam_sfmdivisionid'});
        }
    }

    // print_r ( $GLOBALS{'sfmclub_sfmfacilityidlista'});
    // print_r ( $GLOBALS{'sfmclub_sfmteamidlista'});
    // print_r ( $GLOBALS{'sfmclub_sfmleagueidlista'});
    // print_r ( $GLOBALS{'sfmclub_sfmdivisionidlista'});

    // print_r ( $GLOBALS{'sfmfacility_sfmclubidlista'});
    // print_r ( $GLOBALS{'sfmfacility_sfmteamidlista'});
    // print_r ( $GLOBALS{'sfmfacility_sfmleagueidlista'});
    // print_r ( $GLOBALS{'sfmfacility_sfmdivisionidlista'});

    $sfmcluba = Get_Array("sfmclub");
    foreach ( $sfmcluba as $sfmclub_id ) {
        Get_Data("sfmclub",$sfmclub_id);
        if ( array_key_exists($sfmclub_id, $GLOBALS{'sfmclub_sfmfacilityidlista'}) ) { $GLOBALS{'sfmclub_sfmfacilityidlist'} = $GLOBALS{'sfmclub_sfmfacilityidlista'}[$sfmclub_id]; }
        else { $GLOBALS{'sfmclub_sfmfacilityidlist'} = ""; }
        if ( array_key_exists($sfmclub_id, $GLOBALS{'sfmclub_sfmteamidlista'}) ) { $GLOBALS{'sfmclub_sfmteamidlist'} = $GLOBALS{'sfmclub_sfmteamidlista'}[$sfmclub_id]; }
        else { $GLOBALS{'sfmclub_sfmteamidlist'} = ""; }
        if ( array_key_exists($sfmclub_id, $GLOBALS{'sfmclub_sfmleagueidlista'}) ) { $GLOBALS{'sfmclub_sfmleagueidlist'} = $GLOBALS{'sfmclub_sfmleagueidlista'}[$sfmclub_id]; }
        else { $GLOBALS{'sfmclub_sfmleagueidlist'} = ""; }
        if ( array_key_exists($sfmclub_id, $GLOBALS{'sfmclub_sfmdivisionidlista'}) ) { $GLOBALS{'sfmclub_sfmdivisionidlist'} = $GLOBALS{'sfmclub_sfmdivisionidlista'}[$sfmclub_id]; }
        else { $GLOBALS{'sfmclub_sfmdivisionidlist'} = ""; }
        // XPTXTCOLOR($sfmclub_id." | ".$GLOBALS{'sfmclub_sfmfacilityidlist'}." | ".$GLOBALS{'sfmclub_sfmteamidlist'}." | ".$GLOBALS{'sfmclub_sfmleagueidlist'}." | ".$GLOBALS{'sfmclub_sfmdivisionidlist'},"green");
        $divisiona = List2Array($GLOBALS{'sfmclub_sfmdivisionidlist'});
        foreach ( $divisiona as $divisionid ) {
            if ( array_key_exists($divisionid, $GLOBALS{'sfmdivision_stepa'}) ) {
                $divstep = $GLOBALS{'sfmdivision_stepa'}[$divisionid];
                if ($GLOBALS{'sfmclub_step'} == "") { 
                    $GLOBALS{'sfmclub_step'} = $divstep;
                    // XPTXT("club-step ".$sfmclub_id." ".$divisionid." ".$GLOBALS{'sfmclub_step'});
                } else { 
                    if ( $divstep <= $GLOBALS{'sfmclub_step'} ) { 
                        $GLOBALS{'sfmclub_step'} = $divstep;
                        // XPTXT("club-step ".$sfmclub_id." ".$divisionid." ".$GLOBALS{'sfmclub_step'});
                    } 
                }
            }
        }
        Write_Data("sfmclub",$sfmclub_id);
    }

    XPTXT("Data List update completed successfully");

    $sfmfacilitya = Get_Array("sfmfacility");
    foreach ( $sfmfacilitya as $sfmfacility_id ) {
        Get_Data("sfmfacility",$sfmfacility_id);
        if ( array_key_exists($sfmfacility_id, $GLOBALS{'sfmfacility_sfmclubidlista'}) ) { $GLOBALS{'sfmfacility_sfmclubidlist'} = $GLOBALS{'sfmfacility_sfmclubidlista'}[$sfmfacility_id]; }
        else { $GLOBALS{'sfmfacility_sfmclubidlist'} = ""; }
        if ( array_key_exists($sfmfacility_id, $GLOBALS{'sfmfacility_sfmteamidlista'}) ) { $GLOBALS{'sfmfacility_sfmteamidlist'} = $GLOBALS{'sfmfacility_sfmteamidlista'}[$sfmfacility_id]; }
        else { $GLOBALS{'sfmfacility_sfmteamidlist'} = ""; }
        if ( array_key_exists($sfmfacility_id, $GLOBALS{'sfmfacility_sfmleagueidlista'}) ) { $GLOBALS{'sfmfacility_sfmleagueidlist'} = $GLOBALS{'sfmfacility_sfmleagueidlista'}[$sfmfacility_id]; }
        else { $GLOBALS{'sfmfacility_sfmleagueidlist'} = ""; }
        if ( array_key_exists($sfmfacility_id, $GLOBALS{'sfmfacility_sfmdivisionidlista'}) ) { $GLOBALS{'sfmfacility_sfmdivisionidlist'} = $GLOBALS{'sfmfacility_sfmdivisionidlista'}[$sfmfacility_id]; }
        else { $GLOBALS{'sfmfacility_sfmdivisionidlist'} = ""; }
        // XPTXTCOLOR($sfmfacility_id." | ".$GLOBALS{'sfmfacility_sfmclubidlist'}." | ".$GLOBALS{'sfmfacility_sfmteamidlist'}." | ".$GLOBALS{'sfmfacility_sfmleagueidlist'}." | ".$GLOBALS{'sfmfacility_sfmdivisionidlist'},"orange");
        if ( $GLOBALS{'sfmfacility_name'} == "") {
            Check_Data("sfmclub",$GLOBALS{'sfmfacility_sfmclubidlist'});
            if ($GLOBALS{'IOWARNING'} == "0" ) {
                $GLOBALS{'sfmfacility_name'} =  $GLOBALS{'sfmclub_name'};
                // XPTXT($GLOBALS{'sfmclub_name'});
            }
        }
        $divisiona = List2Array($GLOBALS{'sfmfacility_sfmdivisionidlist'});
        foreach ( $divisiona as $divisionid ) {
            if ( array_key_exists($divisionid, $GLOBALS{'sfmdivision_stepa'}) ) {
                $divstep = $GLOBALS{'sfmdivision_stepa'}[$divisionid];
                if ($GLOBALS{'sfmfacility_step'} == "") { 
                   $GLOBALS{'sfmfacility_step'} = $divstep; 
                   // XPTXT("facility-step ".$sfmfacility_id." ".$divisionid." ".$GLOBALS{'sfmfacility_step'});
                   if ( array_key_exists($divisionid, $GLOBALS{'sfmdivision_gradingtargeta'}) ) {
                       $GLOBALS{'sfmfacility_gradingtarget'} = $GLOBALS{'sfmdivision_gradingtargeta'}[$divisionid]; 
                       // XPTXT("facility-grading ".$sfmfacility_id." ".$divisionid." ".$GLOBALS{'sfmfacility_gradingtarget'});
                   } 
                } else { 
                    if ( $divstep <= $GLOBALS{'sfmfacility_step'} ) { 
                        $GLOBALS{'sfmfacility_step'} = $divstep;
                        // XPTXT("facility-step ".$sfmfacility_id." ".$divisionid." ".$GLOBALS{'sfmfacility_step'});
                        if ( array_key_exists($divisionid, $GLOBALS{'sfmdivision_gradingtargeta'}) ) {
                            $GLOBALS{'sfmfacility_gradingtarget'} = $GLOBALS{'sfmdivision_gradingtargeta'}[$divisionid];
                            // XPTXT("facility-grading ".$sfmfacility_id." ".$divisionid." ".$GLOBALS{'sfmfacility_gradingtarget'});
                        } 
                    }   
                }
            }
        }
        Write_Data("sfmfacility",$sfmfacility_id);
    }
}

function AddToListA ($listarrayname,$key,$value) {
    if ( ($key != "")&&($value != "")) {
        if ( array_key_exists($key, $GLOBALS{$listarrayname}) ) {
            $GLOBALS{$listarrayname}[$key] = CommaList_Add($GLOBALS{$listarrayname}[$key], $value);
        } else {
            $GLOBALS{$listarrayname}[$key] = $value;
        }
    }
}

function SFM_SFMCOPYIMAGES_Output () { 
    $sfmcluba = Get_Array("sfmclub");
    foreach ( $sfmcluba as $sfmclub_id ) {
        Get_Data("sfmclub",$sfmclub_id);
        $sfmfacilityidlista = List2Array($GLOBALS{'sfmclub_sfmfacilityidlist'});
        foreach ( $sfmfacilityidlista as $sfmfacility_id ) {
            Check_Data("sfmfacility",$sfmfacility_id);
            if ($GLOBALS{'IOWARNING'} == "0") {
                $GLOBALS{'sfmfacility_addr1'} = $GLOBALS{'sfmclub_addr1'};
                $GLOBALS{'sfmfacility_addr2'} = $GLOBALS{'sfmclub_addr2'};
                $GLOBALS{'sfmfacility_addr3'} = $GLOBALS{'sfmclub_addr3'};
                $GLOBALS{'sfmfacility_addr4'} = $GLOBALS{'sfmclub_addr4'};
                $GLOBALS{'sfmfacility_postcode'} = $GLOBALS{'sfmclub_postcode'};
                $GLOBALS{'sfmfacility_googlemapslink'} = $GLOBALS{'sfmclub_googlemapslink'};
                $GLOBALS{'sfmfacility_pitchfinderlink'} = $GLOBALS{'sfmclub_pitchfinderlink'};                
                $GLOBALS{'sfmfacility_image1'} = str_replace("Club_","Facility_",$GLOBALS{'sfmclub_image1'});
                FacilityImageCopy( $GLOBALS{'sfmclub_image1'} );
                $GLOBALS{'sfmfacility_image1caption'} = $GLOBALS{'sfmclub_image1caption'};
                $GLOBALS{'sfmfacility_image2'} = str_replace("Club_","Facility_",$GLOBALS{'sfmclub_image2'});
                FacilityImageCopy( $GLOBALS{'sfmclub_image2'} );
                $GLOBALS{'sfmfacility_image2caption'} = $GLOBALS{'sfmclub_image2caption'};
                $GLOBALS{'sfmfacility_image3'} = str_replace("Club_","Facility_",$GLOBALS{'sfmclub_image3'});
                FacilityImageCopy( $GLOBALS{'sfmclub_image3'} );
                $GLOBALS{'sfmfacility_image3caption'} = $GLOBALS{'sfmclub_image3caption'};
                $GLOBALS{'sfmfacility_image4'} = str_replace("Club_","Facility_",$GLOBALS{'sfmclub_image4'});
                FacilityImageCopy( $GLOBALS{'sfmclub_image4'} );
                $GLOBALS{'sfmfacility_image4caption'} = $GLOBALS{'sfmclub_image4caption'};
                $GLOBALS{'sfmfacility_image5'} = str_replace("Club_","Facility_",$GLOBALS{'sfmclub_image5'});
                FacilityImageCopy( $GLOBALS{'sfmclub_image5'} );
                $GLOBALS{'sfmfacility_image5caption'} = $GLOBALS{'sfmclub_image5caption'};
                $GLOBALS{'sfmfacility_locationmap'} = $GLOBALS{'sfmclub_locationmap'};
                Write_Data("sfmfacility",$sfmfacility_id);
                XPTXT("Images moved for - ".$sfmfacility_id);
            }
        }
    }     
}

function FacilityImageCopy( $imagename ) {
    
    if ( $imagename != "" ) {
        $newimagename = str_replace("Club","Facility",$imagename);
        $from = $GLOBALS{'domainwwwpath'}."/domain_media/".$imagename;
        $to = $GLOBALS{'domainwwwpath'}."/domain_media/".$newimagename;
        copy($from, $to);
        XPTXTCOLOR($imagename." copied to ".$newimagename,"green");
    }
 
}

function SFM_SFMTEAMDIVISIONDOWNLOAD_Output() {
    XH3("Team Promotion/Demotion Management");
    XBR();
    XHR();
    XH3("Step 1: Download the existing Team/Division structure (csv file)");
    XBR();
    XFORM("sfmteamdivisiondownloadin.php","download");
    XINSTDHID();
    XINSUBMIT("Download File");
    X_FORM();
    XBR();
    XHR();
    XH3("Step 2: Make Changes to the downloaded file");
    XBR();
    XBR();
    XHR();
    
    XH3("Step 3: Upload the modified file (csv file)");
    XFORMUPLOAD("sfmteamdivisionuploadin.php","upload");
    XINSTDHID();
    XPTXT("Note: You will get a chance to verify update before committing changes.");
    XBR();
    XPTXT("File Containing Data:-");
    XINFILE("file","10000000") ;XBR();XBR();
    XINHID("TestorReal","T");
    XINHID("FirstOrConfirm","First");    
    XBR();
    XINSUBMIT("Upload!");
    X_FORM();
     
}

function SFM_SFMKEYCHANGEDOWNLOAD_Output() {
    XH3("Database Key Change Management");
    XBR();
    XHR();
    XH3("Step 1: Download the existing Database Keys (csv file)");
    XBR();
    XFORM("sfmkeychangedownloadin.php","download");
    XINSTDHID();
    XINSUBMIT("Download File");
    X_FORM();
    XBR();
    XHR();
    XH3("Step 2: Identify Key Changes in the downloaded file");
    XBR();
    XBR();
    XHR();
    XH3("Step 3: Upload the modified file (csv file)");
    XFORMUPLOAD("sfmkeychangeuploadin.php","upload");
    XINSTDHID();
    XPTXT("Note: You will get a chance to verify update before committing changes.");
    XBR();
    XPTXT("File Containing Data:-");
    XINFILE("file","10000000") ;XBR();XBR();
    XINHID("TestorReal","T");
    XINHID("FirstOrConfirm","First");    
    XBR();
    XINSUBMIT("Upload!");
    X_FORM();
}



function SFM_SETUPSFMADDTEAM_Output() {
    XH3("Add New Team");
    XBR();
 

    XFORM("sfmaddteamconfirm.php","addteam");
    XINSTDHID();
  
    BROW();
    BCOLTXT("Team Name*","2");
    BCOLINTXT("newsfmteam_name","","3");
    BCOLTXTRIGHT("Id","1");
    BCOLINTXT("newsfmteam_id","","3");
    BCOLTXTID("newteamidmessage","","4");    
    B_ROW(); 
    
    XHR();   
    XH3("Division");
    BROW();
    BCOLTXT("Name*","2");
    $xhash = Get_SelectArrays_Hash ("sfmdivision","sfmdivision_id","sfmdivision_name","sfmdivision_id","","" );
    BCOLINSELECTHASHID ($xhash,'sfmdivision_id','sfmdivision_id',"","3");
    B_ROW();  
 
    XHR();
    XH3("Facility");
    BROW();   
    BCOLTXT("Existing Facility","2");
    $xhash = Get_SelectArrays_Hash ("sfmfacility","sfmfacility_id","sfmfacility_name","sfmfacility_id","","" );
    BCOLINSELECTHASHID ($xhash,'sfmfacility_id','sfmfacility_id',"","3");
    B_ROW(); 
    XPTXT("or");
    BROW();
    BCOLTXT("New Facility Name","2");
    BCOLINTXT("newsfmfacility_name","","3");
    BCOLTXTRIGHT("Id","1");
    BCOLINTXT("newsfmfacility_id","","3");
    BCOLTXTID("newfacilityidmessage","","3"); 
    B_ROW();   
    
    XHR();
    XH3("Club");
    BROW();   
    BCOLTXT("Existing Club","2");
    $xhash = Get_SelectArrays_Hash ("sfmclub","sfmclub_id","sfmclub_name","sfmclub_id","","" );
    BCOLINSELECTHASHID ($xhash,'sfmclub_id','sfmclub_id',"","3");
    B_ROW(); 
    XPTXT("or");
    BROW();
    BCOLTXT("New Club Name","2");
    BCOLINTXT("newsfmclub_name","","3");
    BCOLTXTRIGHT("Id","1");
    BCOLINTXT("newsfmclub_id","","3");
    BCOLTXTID("newclubidmessage","","3");
    B_ROW();
    
    XHR();
    XINSUBMIT("Add Team");
    X_FORM();
    
    
    
    
    
    
}

?>





