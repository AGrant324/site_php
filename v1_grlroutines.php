<<<<<<< HEAD
<?php

function Grl_SETUPGRLLEAGUE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Grl_SETUPGRLLEAGUE_Output() {
    $parm0 = "";
    $parm0 = $parm0."League Competition Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlleague[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlleague_id|"; # keyfieldname
    $parm0 = $parm0."grlleague_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlleague_id|Yes|Id|60|Yes|League Code|KeyText,20,20^";
    $parm1 = $parm1."grlleague_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLCUP_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Grl_SETUPGRLCUP_Output() {
    $parm0 = "";
    $parm0 = $parm0."Cup Competition Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlcup[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlcup_id|"; # keyfieldname
    $parm0 = $parm0."grlcup_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlcup_id|Yes|Id|60|Yes|Cup Code|KeyText,20,20^";
    $parm1 = $parm1."grlcup_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLCLUB_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Grl_SETUPGRLCLUB_Output() {
    $parm0 = "";
    $parm0 = $parm0."Club Setup - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlclub[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."grlteam[rootkey=".$GLOBALS{'currperiodid'}."],grlvenue|"; # othertables
    $parm0 = $parm0."grlclub_id|"; # keyfieldname
    $parm0 = $parm0."grlclub_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlclub_id|Yes|Id|60|Yes|Club Code|KeyText,20,20^";
    $parm1 = $parm1."grlclub_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlclub_teamlist|Yes|Teams|100|Yes|Teams|InputSelectFromTable,grlteam,grlteam_id,grlteam_name,grlteam_name^";
    $parm1 = $parm1."grlclub_primevenueid|Yes|Main Venue|100|Yes|Main Venue|InputSelectFromTable,grlvenue,grlvenue_id,grlvenue_name,grlvenue_name^";
    $parm1 = $parm1."grlclub_othervenueid|Yes|Other Venue|100|Yes|Other Venue|InputSelectFromTable,grlvenue,grlvenue_id,grlvenue_name,grlvenue_name^";
    $parm1 = $parm1."grlclub_logo|Yes|Logo|100|Yes|Club Logo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,250,250,Club,grlclub_id^";
    $parm1 = $parm1."grlclub_introduction|No|||Yes|Description|InputTextArea,6,80^";   
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLTEAM_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Grl_SETUPGRLTEAM_Output() {
    $parm0 = "";
    $parm0 = $parm0."Team Setup - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlteam[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."grlleague[rootkey=".$GLOBALS{'currperiodid'}."],grlcup[rootkey=".$GLOBALS{'currperiodid'}."],person[returnedfields=person_domainid+person_id+person_sname+person_fname]|"; # othertables
    $parm0 = $parm0."grlteam_id|"; # keyfieldname
    $parm0 = $parm0."grlteam_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlteam_id|Yes|Id|60|Yes|Team Code|KeyText,20,20^";
    $parm1 = $parm1."grlteam_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlteam_mgr|Yes|Manager|250|Yes|Manager|InputText,30,60^";
    $parm1 = $parm1."grlteam_coach|Yes|Coach|250|Yes|Coach|InputText,30,60^";
    $parm1 = $parm1."grlteam_captain|Yes|Captain|250|Yes|Captain|InputText,30,60^";
    $parm1 = $parm1."grlteam_admin|Yes|Admin|250|Yes|Administrator|InputPerson,20,40,Administrator,Lookup^";
    $parm1 = $parm1."grlteam_grlleagueid|Yes|League|250|Yes|League|InputSelectFromTable,grlleague,grlleague_id,grlleague_name,grlleague_id^";
    $parm1 = $parm1."grlteam_grlcupid|Yes|Cup|250|Yes|Cup|InputSelectFromTable,grlcup,grlcup_id,grlcup_name,grlcup_id^";
    $parm1 = $parm1."grlteam_squadlist|Yes|Squad|250|Yes|Squad|InputTextArea,5,40^";
    $parm1 = $parm1."grlteam_photo|Yes|Photo|250|Yes|Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,1000,400,Team,grlteam_id^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);

$GLOBALS{'PersonSelectPopupParameters'} = array(
    "other,person_domainid|person_id|person_sname|person_fname",
    "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40",
    "field,Administrator,Select,grlteam_admin_input,grlteam_admin_personlist,70",
    "person_id",
    "active",
    "team,50,50,400,400",
    "view",
    "buildfulllist"
);

}

function Grl_SETUPGRLVENUE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Grl_SETUPGRLVENUE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Venue Setup - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlvenue|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlvenue_id|"; # keyfieldname
    $parm0 = $parm0."grlvenue_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlvenue_id|Yes|Id|60|Yes|League Code|KeyText,20,20^";
    $parm1 = $parm1."grlvenue_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlvenue_address|Yes|Address|250|Yes|Address|InputTextArea,4,30^";
    $parm1 = $parm1."grlvenue_postcode|Yes|PostCode|50|Yes|PostCode|InputText,30,60^";
    $parm1 = $parm1."grlvenue_mapref|Yes|MapRef|250|Yes|MapRef|InputTextArea,4,30^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLPLAYER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Grl_SETUPGRLPLAYER_Output() {
    $parm0 = "";
    $parm0 = $parm0."Player Setup|"; # pagetitle
    $parm0 = $parm0."grlplayer|"; # primetable
    $parm0 = $parm0."grlteam[rootkey=".$GLOBALS{'currperiodid'}."]|"; # othertables
    $parm0 = $parm0."grlplayer_id|"; # keyfieldname
    $parm0 = $parm0."grlplayer_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlplayer_id|Yes|Id|60|Yes|Player Id|KeyText,10,10^";
    $parm1 = $parm1."grlplayer_fname|Yes|First Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlplayer_sname|Yes|SurName|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlplayer_photo|No|Photo|30|Yes|Player Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,200,300,Player,grlplayer_id^";
    $parm1 = $parm1."grlplayer_profile|Yes|Profile|250|Yes|Profile|InputTextArea,5,40^";
    $parm1 = $parm1."grlplayer_position|Yes|Position|250|Yes|Position|InputText,30,60^";
    $parm1 = $parm1."grlplayer_teamid|Yes|Team|250|Yes|Team|InputSelectFromTable,grlteam,grlteam_id,grlteam_name,grlteam_name^";
    $parm1 = $parm1."grlplayer_email|Yes|Email|250|Yes|Email|InputText,30,60^";
    $parm1 = $parm1."grlplayer_mobile|Yes|Mobile|250|Yes|Mobile|InputText,15,20^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}


function Grl_SETUPGRLOFFICIAL_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Grl_SETUPGRLOFFICIAL_Output() {
    $parm0 = "";
    $parm0 = $parm0."Official Setup|"; # pagetitle
    $parm0 = $parm0."grlofficial|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlofficial_id|"; # keyfieldname
    $parm0 = $parm0."grlofficial_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."grlofficial_id|Yes|Id|60|Yes|Official Id|KeyText,10,10^";
    $parm1 = $parm1."grlofficial_fname|Yes|First Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlofficial_sname|Yes|SurName|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlofficial_photo|No|Photo|30|Yes|Player Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,200,300,Official,grlofficial_id^";
    $parm1 = $parm1."grlofficial_profile|Yes|Profile|250|Yes|Profile|InputTextArea,5,40^";
    $parm1 = $parm1."grlofficial_email|Yes|Email|250|Yes|Email|InputText,30,60^";
    $parm1 = $parm1."grlofficial_mobile|Yes|Mobile|250|Yes|Mobile|InputText,15,20^"; 
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLPLAYERSTATTYPES_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Grl_SETUPGRLPLAYERSTATTYPES_Output() {
    $parm0 = "";
    $parm0 = $parm0."Player Statistics Types - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlplayerstattype[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlplayerstattype_code|"; # keyfieldname
    $parm0 = $parm0."grlplayerstattype_code|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."grlplayerstattype_code|Yes|Id|60|Yes|Player Stat Id|KeyText,2,2^";
    $parm1 = $parm1."grlplayerstattype_title|No||60|Yes|Header Title|InputText,30,60^";
    $parm1 = $parm1."grlplayerstattype_name|Yes|Description|200|Yes|Description|InputText,30,60^";
    $parm1 = $parm1."grlplayerstattype_values|No||60|Yes|Code Values|InputSelectFromList,Numeric+Checkbox^";
    $parm1 = $parm1."grlplayerstattype_msdisplay|Yes|Display|60|Yes|Display on Match Stats|InputSelectFromList,Yes+No^";
    $parm1 = $parm1."grlplayerstattype_mscount|Yes|Max|60|Yes|Match Stats Display Max|InputText,2,2^";
    $parm1 = $parm1."grlplayerstattype_mrdisplay|No||60|Yes|Display on Match Results|InputSelectFromList,Yes+No^";
    $parm1 = $parm1."grlplayerstattype_playoff|No||60|Yes|Player/Official|InputSelectFromList,P+O^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_RecalcStats($periodid,$leagueid) {
    // XH1("Grl_RecalcStats ".$periodid." ".$leagueid);
    $leaguetablea = Array();   
    Get_Data('grlleague',$periodid,$leagueid);
    $teama = List2Array($GLOBALS{'grlleague_teamlist'});
    // $teama = Get_Array('grlleaguetable',$periodid,$leagueid);
    // XPTXT($GLOBALS{'grlleague_teamlist'});
    foreach ($teama as $teamid) {  
        // XPTXT($teamid);
        $leaguetablea[$teamid] = Array();
        Get_Data('grlteam',$periodid,$teamid);
        $leaguetablea[$teamid]["teamname"] = $GLOBALS{'grlteam_name'};
        $leaguetablea[$teamid]["played"] = 0;
        $leaguetablea[$teamid]["hw"] = 0;
        $leaguetablea[$teamid]["hd"] = 0;
        $leaguetablea[$teamid]["hl"] = 0;
        $leaguetablea[$teamid]["aw"] = 0;
        $leaguetablea[$teamid]["ad"] = 0;
        $leaguetablea[$teamid]["al"] = 0;
        $leaguetablea[$teamid]["tw"] = 0;
        $leaguetablea[$teamid]["td"] = 0;
        $leaguetablea[$teamid]["tl"] = 0;
        $leaguetablea[$teamid]["tgf"] = 0;
        $leaguetablea[$teamid]["tga"] = 0;
        $leaguetablea[$teamid]["tgdiff"] = 0;
        $leaguetablea[$teamid]["points"] = 0;
    }   
    XPTXT($GLOBALS{'currperiodid'}." ".$leagueid); 
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},"L-".$leagueid);
    foreach ($matcha as $match_id) {
        Get_Data('grlmatch',$GLOBALS{'currperiodid'},"L-".$leagueid,$match_id);
        $ignorematch = "0";
        if (strlen(strstr($GLOBALS{'grlmatch_score'},"P")) > 0) { $ignorematch = "1"; }
        if (strlen(strstr($GLOBALS{'grlmatch_score'},"-")) > 0) { } else { $ignorematch = "1"; }        
        if ($ignorematch == "0") {
            $hometeamid = $GLOBALS{'grlmatch_hometeamid'};
            $awayteamid = $GLOBALS{'grlmatch_awayteamid'};

            $leaguetablea[$hometeamid]["played"]++;
            $leaguetablea[$hometeamid]["tgf"] = $leaguetablea[$hometeamid]["tgf"] + $GLOBALS{'grlmatch_homegfull'};
            $leaguetablea[$hometeamid]["tga"] = $leaguetablea[$hometeamid]["tga"] + $GLOBALS{'grlmatch_awaygfull'};
            $leaguetablea[$hometeamid]["tgdiff"] = $leaguetablea[$hometeamid]["tgdiff"] + $GLOBALS{'grlmatch_homegfull'} - $GLOBALS{'grlmatch_awaygfull'}  ;               
            $leaguetablea[$awayteamid]["played"]++;
            $leaguetablea[$awayteamid]["tgf"] = $leaguetablea[$awayteamid]["tgf"] + $GLOBALS{'grlmatch_awaygfull'};
            $leaguetablea[$awayteamid]["tga"] = $leaguetablea[$awayteamid]["tga"] + $GLOBALS{'grlmatch_homegfull'};
            $leaguetablea[$awayteamid]["tgdiff"] = $leaguetablea[$awayteamid]["tgdiff"] + $GLOBALS{'grlmatch_awaygfull'} - $GLOBALS{'grlmatch_homegfull'}  ;
    
            if ( $GLOBALS{'grlmatch_homegfull'} > $GLOBALS{'grlmatch_awaygfull'} ) {  // home win
                $leaguetablea[$hometeamid]["hw"]++;            
                $leaguetablea[$hometeamid]["tw"]++;
                $leaguetablea[$hometeamid]["points"] = $leaguetablea[$hometeamid]["points"] + 3;                                 
                $leaguetablea[$awayteamid]["al"]++;
                $leaguetablea[$awayteamid]["tl"]++;
            }       
            if ( $GLOBALS{'grlmatch_homegfull'} == $GLOBALS{'grlmatch_awaygfull'} ) {  // draw
                $leaguetablea[$hometeamid]["hd"]++;
                $leaguetablea[$hometeamid]["td"]++;
                $leaguetablea[$hometeamid]["points"] = $leaguetablea[$hometeamid]["points"] + 1;           
                $leaguetablea[$awayteamid]["ad"]++;
                $leaguetablea[$awayteamid]["td"]++;
                $leaguetablea[$awayteamid]["points"] = $leaguetablea[$awayteamid]["points"] + 1;
            }  
            if ( $GLOBALS{'grlmatch_homegfull'} < $GLOBALS{'grlmatch_awaygfull'} ) {   // away win
                $leaguetablea[$hometeamid]["hl"]++;
                $leaguetablea[$hometeamid]["tl"]++;
                $leaguetablea[$awayteamid]["aw"]++;
                $leaguetablea[$awayteamid]["tw"]++;
                $leaguetablea[$awayteamid]["points"] = $leaguetablea[$awayteamid]["points"] + 3;
            }
        }
    }
    
    foreach ($teama as $teamid) {
        $GLOBALS{'grlleaguetable_grlteamname'} = $leaguetablea[$teamid]["teamname"];
        $GLOBALS{'grlleaguetable_played'} = $leaguetablea[$teamid]["played"];
        $GLOBALS{'grlleaguetable_hw'} = $leaguetablea[$teamid]["hw"];
        $GLOBALS{'grlleaguetable_hd'} = $leaguetablea[$teamid]["hd"];
        $GLOBALS{'grlleaguetable_hl'} = $leaguetablea[$teamid]["hl"];
        $GLOBALS{'grlleaguetable_aw'} = $leaguetablea[$teamid]["aw"];
        $GLOBALS{'grlleaguetable_ad'} = $leaguetablea[$teamid]["ad"];
        $GLOBALS{'grlleaguetable_al'} = $leaguetablea[$teamid]["al"];
        $GLOBALS{'grlleaguetable_tw'} = $leaguetablea[$teamid]["tw"];
        $GLOBALS{'grlleaguetable_td'} = $leaguetablea[$teamid]["td"];
        $GLOBALS{'grlleaguetable_tl'} = $leaguetablea[$teamid]["tl"];
        $GLOBALS{'grlleaguetable_tgf'} = $leaguetablea[$teamid]["tgf"];
        $GLOBALS{'grlleaguetable_tga'} = $leaguetablea[$teamid]["tga"];
        $GLOBALS{'grlleaguetable_tgdiff'} = $leaguetablea[$teamid]["tgdiff"];
        $GLOBALS{'grlleaguetable_points'} = $leaguetablea[$teamid]["points"];
        Write_Data("grlleaguetable",$periodid,$leagueid,$teamid);
        // XPTXT($teamid." ".$GLOBALS{'grlleaguetable_played'});
    }  
}

function Grl_LeagueResults_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";	
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,grlleagueresults,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "LeagueResults_Popup";
}


function Grl_LeagueResults_Output($parma) {
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
    
    $leagueid = $parma[0];
    $GLOBALS{'pluginhtmla'} = Array();
    $leaguematcha = Array();
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},$leagueid);
    Get_Array('grlplayer');
    foreach ($matcha as $match_id){
        $hgoallist = "";
        $agoallist = "";
        $number = "";
        //XH3($match_id);
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
        $leaguematcha[$matchmonth][$match_id][5] = $hgoallist;
        $leaguematcha[$matchmonth][$match_id][6] = $agoallist;
        $leaguematcha[$matchmonth][$match_id][7] = $GLOBALS{'grlmatch_attendance'};
        $leaguematcha[$matchmonth][$match_id][8] = $GLOBALS{'grlmatch_verifiedby'};
    }
    
    $currentmonth = "February";
    
    XINHIDID("currperiodid","currperiodid",$GLOBALS{'currperiodid'});
    XINHIDID("competitionid","competitionid",$leagueid);
    
    BTABDIV("TableTabs");
    BTABHEADERCONTAINER();   
    $mi = 0;
    foreach ($monthsa as $month){
        $mi++;        
        if ($month == $currentmonth) { BTABHEADERITEMACTIVE($month,$mthsa[$mi]); } else { BTABHEADERITEM($month,$mthsa[$mi]); }    
    }
    B_TABHEADERCONTAINER();
    B_TABDIV();

    BTABCONTENTCONTAINER();
    foreach ($monthsa as $month){
        if ($month == $currentmonth) { BTABCONTENTITEMACTIVE($month); } else { BTABCONTENTITEM($month); }       
        XH3($month);
        XDIV("simpletablediv_GRLResultsHTMLA_L-Premier_".$month,"container");
        XTABLEJQDTID("simpletabletable_GRLResultsHTMLA_L-Premier_".$month);
        XTHEAD();
        XTRJQDT();
        XTDTXT('Match Time');
        XTDTXT('Home');
        XTDTXT('Score');
        XTDTXT('Away');
        XTDTXT('Match Att.');
        XTDTXT('');
        XTDTXT('');
        X_TR();
        X_THEAD();
        XTBODY();
        
        $matchdatetest = "";
        $counter = "0";
        foreach ($leaguematcha[$month] as $match_id => $varray) {
            if (($matchdatetest == $leaguematcha[$month][$match_id][0])){ } else {
                $mydate = strtotime($leaguematcha[$month][$match_id][0]);
                $newdate = date('F jS Y', $mydate);
                XTRJQDT();
                XTDBACKCOLOR('black');XTDBACKCOLOR('black');XTDTXTBACKTXTCOLOR($newdate,'black','white');XTDBACKCOLOR('black');XTDBACKCOLOR('black');XTDBACKCOLOR('black');XTDBACKCOLOR('black');
                X_TR();
                $matchdatetest = $leaguematcha[$month][$match_id][0];
            }
            XTRJQDT();
            print '<td style= "vertical-align: top;"><font color="grey">'.$leaguematcha[$month][$match_id][1].'</font></td>';
            print '<td style= "vertical-align: top;"><font size="3" color="darkblue">'."<b>".$leaguematcha[$month][$match_id][2]."</b></font><br><font color='grey'>".$leaguematcha[$month][$match_id][5].'</font></td>';
            print '<td style= "vertical-align: top;"><b>'.$leaguematcha[$month][$match_id][3].'</b></td>';
            print '<td style= "vertical-align: top;"><font size="3" color="darkblue">'."<b>".$leaguematcha[$month][$match_id][4]."</b></font><br><font color='grey'>".$leaguematcha[$month][$match_id][6].'</font></td>';
            print '<td style= "vertical-align: top;"><font color="grey">'."Att.".$leaguematcha[$month][$match_id][7].'</font></td>';
            XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsupdatebutton","resultsupdatebutton","primary","Update");X_TD();
            if ($leaguematcha[$month][$match_id][8] != "") {
                XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","success","Verified");X_TD(); 
            } else {
                XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","warning","Verify");X_TD(); 
            }
            X_TR();
            $counter++;
        }
        X_TBODY();
        X_TABLE();
        X_DIV("simpletablediv_GRLResultsHTMLA_L-Premier_".$month);
        XCLEARFLOAT();
        B_TABCONTENTITEM();
        
    }
    B_TABCONTENTCONTAINER();
    
    XBR();XBR();
    XH5("Update Log");
    XDIV("updateLog","");
    XTXT("No updates have been made in this session so far");
    X_DIV("updateLog");
    XTXTID("TRACETEXT","");
    
}

function LeagueResults_Popup () {
    XDIVPOPUP("leagueresultspopup","League Results");
    XDIV("leagueresultspopupcontainer","");
    
    XH3ID("matchtitle","");
    XHRCLASS('underline');
    BROW();
    BCOLTXT("Date","2");
    BCOLINTXTID('matchdate','matchdate',"Sept 6th","2");
    BCOLTXT("Time","2");
    BCOLINTXTID('matchtime','matchtime',"13:00","2");
    BCOLTXT("Attendance","2");
    BCOLINTXTID('attendance','attendance',"1,234","2");
    B_ROW();
    XHRCLASS('underline');
    XH3("Result");
    BROW();
    BCOLTXT("","2");
    BCOLTXT("Home","2");
    BCOLTXT("Away","2");
    B_ROW();
    BROW();
    BCOLTXT("Half Time","2");
    BCOLINTXTID('homeghalf','homeghalf',"0","2");
    BCOLINTXTID('awayghalf','awayghalf',"0","2");
    B_ROW();
    BROW();
    BCOLTXT("Full Time","2");
    BCOLINTXTID('homegfull','homegfull',"0","2");
    BCOLINTXTID('awaygfull','awaygfull',"0","2");
    B_ROW();
    XHRCLASS('underline');
    // Element      Class         id
    // Add New .hstat_addnew   hstat_G_addnew
    // Row	   .hstat_row	   hstat_G_rowseq_row
    // Stat	   .hstat_stat	   hstat_G_rowseq_playerid
    //   	   .hstat_stat	   hstat_G_rowseq_time
    //         .hstat_stat	   hstat_G_rowseq_extra
    // Delete  .hstat_delete   hstat_G_rowseq_delete
    // Div                     hstat_G_listend
    
    XH3("Home Team Statistics");
    $grlplayerstattypea = Get_Array("grlplayerstattype",$GLOBALS{'currperiodid'});
    foreach ($grlplayerstattypea as $grlplayerstattypecode){
        Get_Data("grlplayerstattype",$GLOBALS{'currperiodid'},$grlplayerstattypecode);
        XH4($GLOBALS{'grlplayerstattype_title'});
        BROW();
        BCOLTXTCOLOR("<b>Name</b>","6","gray","white");
        BCOLTXTCOLOR("<b>Time</b>","2","gray","white");
        BCOLTXTCOLOR("<b>Type</b>","2","gray","white");
        BCOL("1"); BINBUTTONIDCLASSSPECIAL('hstat_'.$grlplayerstattypecode."_addnew",'hstat_addnew',"success","+"); B_COL();
        BCOLTXT("","1");
        B_ROW();
        XDIV("hstat_".$grlplayerstattypecode."_listend","");
        X_DIV("hstat_".$grlplayerstattypecode."_listend");
        XHRCLASS('underline');
    }
    
    XH3("Away Team Statistics");
    $grlplayerstattypea = Get_Array("grlplayerstattype",$GLOBALS{'currperiodid'});
    foreach ($grlplayerstattypea as $grlplayerstattypecode){
        Get_Data("grlplayerstattype",$GLOBALS{'currperiodid'},$grlplayerstattypecode);
        XH4($GLOBALS{'grlplayerstattype_title'});
        BROW();
        BCOLTXTCOLOR("<b>Name</b>","6","gray","white");
        BCOLTXTCOLOR("<b>Time</b>","2","gray","white");
        BCOLTXTCOLOR("<b>Type</b>","2","gray","white");
        BCOL("1"); BINBUTTONIDCLASSSPECIAL('astat_'.$grlplayerstattypecode."_addnew",'astat_addnew',"success","+"); B_COL();
        BCOLTXT("","1");
        B_ROW();
        XDIV("astat_".$grlplayerstattypecode."_listend","");
        X_DIV("astat_".$grlplayerstattypecode."_listend");
        XHRCLASS('underline');
    }
    X_DIV("leagueresultspopupcontainer");
    XBR();XBR();
    XINBUTTONIDSPECIAL("leagueresultspopupupdatebutton","primary","Update");
    XINBUTTONIDSPECIAL("leagueresultspopupclosebutton","warning","Close");
    X_DIV("leagueresultspopup");
}

function Grl_LeagueOfficialResults_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "grlleagueofficialresults,jqueryconfirm";
}

function Grl_LeagueOfficialResults_Output($parma) {
  
    $leagueid = $parma[0];
    XH3("Official Match Results");
    
    XDIV("GRLMatchKeyDiv","matchkeycontainer");
    BROW(); BCOLTXT("Please enter your Match Key","12"); B_ROW();
    BROW(); BCOLINTXTID("MatchKey","MatchKey","","6"); BINBUTTONIDSPECIAL ("MatchKeyEnter","primary","Enter"); B_ROW();    
    XBR();XBR();
    X_DIV("GRLMatchKeyDiv");
    
    $first = "1";
    XDIV("simpletablediv_GRLMatches","container");
    XTABLEJQDTID("simpletabletable_GRLMatches");
    XTHEAD();
    XTRJQDT();
    XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    $leaguematcha = Array();
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},$leagueid);
    foreach ($matcha as $match_id){
        Get_Data('grlmatch',$GLOBALS{'currperiodid'},$leagueid,$match_id);
        //XH3($GLOBALS{'grlmatch_hometeamname'});
        $matchdate = $GLOBALS{'grlmatch_date'};
        if (($GLOBALS{'grlmatch_date'} == $GLOBALS{'currentYYYY-MM-DD'})&&($first == "1")) {
            XTRJQDT();
            XTDTXT($GLOBALS{'grlmatch_hometeamname'});
            XTDTXT("vs");
            XTDTXT($GLOBALS{'grlmatch_awayteamname'});
            XTD();
            $link = YPGMLINK("grlleagueofficialresults2out.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("grlmatch_id",$match_id);
            XLINKBUTTONSPECIAL($link,"Update",'success');
            X_TD();
            X_TR();
            $first = "0";
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_GRLMatches");
    XCLEARFLOAT();
    XBR();
    XBR();
}

function Grl_LeagueOfficialResults2_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm,jqueryuisignature,";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,grlleagueofficialresults2,jqueryconfirm,jqueryuisignature,";
}

function Grl_LeagueOfficialResults2_Output($parma,$thisgrlmatch_id) {    
    $leagueid = $parma[0];
    Get_Data('grlmatch',$GLOBALS{'currperiodid'},$leagueid,$thisgrlmatch_id);

    XINHIDID("currperiodid","currperiodid",$GLOBALS{'currperiodid'});
    XINHIDID("competitionid","competitionid",$leagueid);
    XINHIDID("grlmatch_id","grlmatch_id",$thisgrlmatch_id);    
    XINHIDID("grlhometeamid","grlhometeamid",$GLOBALS{'grlmatch_hometeamid'});    
    XINHIDID("grlawayteamid","grlawayteamid",$GLOBALS{'grlmatch_awayteamid'}); 
    Get_Data('grlteam',$GLOBALS{'currperiodid'},$GLOBALS{'grlmatch_hometeamid'});
    XINHIDID("grlhometeamsquadlist","grlhometeamsquadlist",$GLOBALS{'grlteam_squadlist'});    
    Get_Data('grlteam',$GLOBALS{'currperiodid'},$GLOBALS{'grlmatch_awayteamid'});
    XINHIDID("grlawayteamsquadlist","grlawayteamsquadlist",$GLOBALS{'grlteam_squadlist'});    
    
    XH3($GLOBALS{'grlmatch_hometeamname'}." vs ".$GLOBALS{'grlmatch_awayteamname'});
    XHRCLASS('underline');
    XDIV("simpletablediv_DateTime","container");
    XTABLEJQDTID("simpletabletable_DateTime");
    XTHEAD();
    XTRJQDT();
    XTDTXT("");XTDTXT("");
    X_TR();
    X_THEAD();
    XTBODY();    
    XTRJQDT();
    XTDTXT("Date");
    XTDINTXTID('matchdate','matchdate',$GLOBALS{'grlmatch_date'},"10","10");
    X_TR();
    XTRJQDT();
    XTDTXT("Time");
    XTDINTXTID('matchtime','matchtime',$GLOBALS{'grlmatch_time'},"10","10");
    X_TR();
    XTRJQDT();
    XTDTXT("Attendance");
    XTDINTXTID('attendance','attendance',$GLOBALS{'grlmatch_attendance'},"10","10");
    X_TR();
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_DateTime");
    XCLEARFLOAT();
    XHRCLASS('underline');
    XH4("Match Result");
    XDIV("simpletablediv_Result","container");
    XTABLEJQDTID("simpletabletable_Result");
    XTHEAD();
    XTRJQDT();
    XTDTXT("");XTDTXT("");XTDTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    XTRJQDT();
    XTDTXT("");
    XTDTXT($GLOBALS{'grlmatch_hometeamname'});
    XTDTXT($GLOBALS{'grlmatch_awayteamname'});
    X_TR();
    XTRJQDT();
    XTDTXT("Half Time");
    XTDINTXTID("homeghalf","homeghalf",$GLOBALS{'grlmatch_homeghalf'},"2","2");
    XTDINTXTID("awayghalf","awayghalf",$GLOBALS{'grlmatch_awayghalf'},"2","2");
    X_TR();
    XTRJQDT();
    XTDTXT("Full Time");
    XTDINTXTID("homegfull","homegfull",$GLOBALS{'grlmatch_homegfull'},"2","2");
    XTDINTXTID("awaygfull","awaygfull",$GLOBALS{'grlmatch_awaygfull'},"2","2");
    X_TR();
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_Result");
    XCLEARFLOAT();
    XHRCLASS('underline');
    XH3("Match Stats");
    
    // Element      Class         id
    // Add New .hstat_addnew   hstat_G_addnew
    // Row	   .hstat_row	   hstat_G_rowseq_row
    // Stat	   .hstat_stat	   hstat_G_rowseq_playerid
    //   	   .hstat_stat	   hstat_G_rowseq_time
    //         .hstat_stat	   hstat_G_rowseq_extra
    // Delete  .hstat_delete   hstat_G_rowseq_delete
    // Div                     hstat_G_listend
    
    
    XDIV("statsdiv","statsdiv");
    // XH4("Home Team Statistics");
    XINBUTTONIDSPECIAL("squadlistbutton_".$GLOBALS{'grlmatch_hometeamid'},"info","Home Team");
    $grlplayerstattypea = Get_Array("grlplayerstattype",$GLOBALS{'currperiodid'});
    foreach ($grlplayerstattypea as $grlplayerstattypecode){
        Get_Data("grlplayerstattype",$GLOBALS{'currperiodid'},$grlplayerstattypecode);
        XH4($GLOBALS{'grlplayerstattype_title'});
        BROW();
        BCOLTXTCOLOR("<b>Name</b>","6","gray","white");
        BCOLTXTCOLOR("<b>Time</b>","2","gray","white");
        BCOLTXTCOLOR("<b>Type</b>","2","gray","white");
        BCOL("1"); BINBUTTONIDCLASSSPECIAL('hstat_'.$grlplayerstattypecode."_addnew",'hstat_addnew',"success","+"); B_COL();
        BCOLTXT("","1");
        B_ROW();
        XDIV("hstat_".$grlplayerstattypecode."_listend","");
        X_DIV("hstat_".$grlplayerstattypecode."_listend");
        XHRCLASS('underline');
    }
    
    // XH4("Away Team Statistics");
    XINBUTTONIDSPECIAL("squadlistbutton_".$GLOBALS{'grlmatch_awayteamid'},"info","Away Team");
    $grlplayerstattypea = Get_Array("grlplayerstattype",$GLOBALS{'currperiodid'});
    foreach ($grlplayerstattypea as $grlplayerstattypecode){
        Get_Data("grlplayerstattype",$GLOBALS{'currperiodid'},$grlplayerstattypecode);
        XH4($GLOBALS{'grlplayerstattype_title'});
        BROW();
        BCOLTXTCOLOR("<b>Name</b>","6","gray","white");
        BCOLTXTCOLOR("<b>Time</b>","2","gray","white");
        BCOLTXTCOLOR("<b>Type</b>","2","gray","white");
        BCOL("1"); BINBUTTONIDCLASSSPECIAL('astat_'.$grlplayerstattypecode."_addnew",'astat_addnew',"success","+"); B_COL();
        BCOLTXT("","1");
        B_ROW();
        XDIV("astat_".$grlplayerstattypecode."_listend","");
        X_DIV("astat_".$grlplayerstattypecode."_listend");
        XHRCLASS('underline');
    }
    XBR();XBR();
        
    XH3("Signature");
    // XPTXT($GLOBALS{'dmwssux_signature'});
    XINHIDIDDQ("grlmatch_signature","grlmatch_signature",$GLOBALS{'grlmatch_signature'});
    XINHIDIDDQ("mirrorsignature","mirrorsignature","");
    
    XDIV("noSignature","");
    XBR();
    XTXT("No signature recorded");
    XBR();
    X_DIV("noSignature");
    
    XDIV("drawSignature","kbw-signaturedraw");
    X_DIV("drawSignature");
    XBR();
    BINBUTTONIDSPECIAL("drawSignatureClear","warning","Remove Signature");
    BINBUTTONIDSPECIAL("drawSignatureUpdate","primary","Enter Signature");
    
    XBR();XBR();
    XINBUTTONIDSPECIAL("matchresultupdatebutton","primary","Update");
    XINBUTTONIDSPECIAL("matchresultclosebutton","warning","Close");
    X_DIV("statsdiv");
    
    XBR();XBR();
    XH5("Update Log");
    XDIV("updateLog","");
    XTXT("No updates have been made in this session so far");
    X_DIV("updateLog");
    XTXTID("TRACETEXT","");
    
    SquadList_Popup ($GLOBALS{'grlmatch_hometeamid'});
    SquadList_Popup ($GLOBALS{'grlmatch_awayteamid'});
    GRLSignaturePopup();
}

function SquadList_Popup ($thisgrlteamid) {
    Get_Data('grlteam',$GLOBALS{'currperiodid'},$thisgrlteamid);
    $squada = List2Array($GLOBALS{'grlteam_squadlist'});
    XDIVPOPUP("squadlistpopup_".$thisgrlteamid,"Squad List");
    XDIV("squadlistpopupcontainer_".$thisgrlteamid,"");   
    XH3ID("squadtitle","");
    XHRCLASS('underline');
    XDIV("simpletablediv_GRLSquadlist_".$thisgrlteamid,"container");
    XTABLEJQDTID("simpletabletable_GRLSquadlist_".$thisgrlteamid);
    XTHEAD();
    XTRJQDT();
    XTDTXT('Photo');
    XTDTXT('Player Id');
    XTDTXT('Shirt No');
    XTDTXT('First Name');
    XTDTXT('Surname');
    XTDTXT('League Approved');
    X_TR();
    X_THEAD();
    XTBODY();
    
    $shirtno = 1;
    foreach ($squada as $playerid) {
        Get_Data("grlplayer",$playerid);
        XTRJQDT();      
        XTDIMGWIDTH($GLOBALS{'domainwwwcorsurl'}."/domain_media/player".$shirtno.".jpeg","100px");
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_id'}.'</td>';
        print '<td style= "vertical-align: top;">'.$shirtno.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_fname'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_sname'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_registrationdate'}.'</td>';
        X_TR();
        $shirtno++;
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_GRLSquadlist_".$thisgrlteamid);
    XCLEARFLOAT();
    XBR();
    XINBUTTONIDSPECIAL("squadlistpopupclosebutton_".$thisgrlteamid,"warning","Close");
    X_DIV("squadlistpopupcontainer_".$thisgrlteamid);
    X_DIV("squadlistpopup_".$thisgrlteamid);
}

function GRLSignaturePopup() {
    XDIVPOPUP("signaturepopup","Signature");
    XDIV("captureSignaturePopup","kbw-signature");
    
    
    X_DIV("captureSignaturePopup");
    XBR();XBR();
    XINBUTTONID("signaturepopupSave","Save");
    XINBUTTONID("signaturepopupClear","Clear");
    XINBUTTONIDSPECIAL("signaturepopupClose","warning","Close");
    X_DIV("signaturepopup");
}

function Grl_LeagueREgistration_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,grlleagueresults,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "LeagueResults_Popup";
}


function Grl_LeagueRegistration_Output($parma) {
    $leagueid = $parma[0];
    XH1("League Registration - ".$leagueid);
    XINHIDID("currperiodid","currperiodid",$GLOBALS{'currperiodid'});
    XINHIDID("competitionid","competitionid",$leagueid);
    
    XHRCLASS('underline');
    XH2("Registration Transactions");
    
    XDIV("simpletablediv_GRLRegistrationTxns","container");
    XTABLEJQDTID("simpletabletable_GRLRegistrationTxns");
    XTHEAD();
    XTRJQDT();
    XTDTXT('Type');
    XTDTXT('Player Id');
    XTDTXT('First Name');
    XTDTXT('Surname');
    XTDTXT('Season');
    XTDTXT('RequestedBy');
    XTDTXT('TransferFrom');
    XTDTXT('Raised Date');
    XTDTXT('Player Approved');
    XTDTXT('Transfer Approved');
    XTDTXT('League Approved');
    XTDTXT('');
    XTDTXT('');
    X_TR();
    X_THEAD();
    XTBODY();
    $grlregistrationtxna = Get_Array("grlregistrationtxn","Open");
    foreach ($grlregistrationtxna as $grlregistrationtxnid){
        Get_Data("grlregistrationtxn","Open",$grlregistrationtxnid);
        Get_Data("grlplayer",$GLOBALS{'grlregistrationtxn_grlplayerid'});
        XTRJQDT();
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_type'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_id'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_fname'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_sname'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_periodid'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_askinggrlclubid'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_fromgrlclubid'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_askingdate'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_playerapproveddate'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_fromapproveddate'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_leagueapproveddate'}.'</td>';
        XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsupdatebutton","resultsupdatebutton","primary","Update");X_TD();
        if ($GLOBALS{'grlplayer_registrationapprovedby'} != "") {
            XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","success","Approved");X_TD();
        } else {
            XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","warning","Approve");X_TD();
        }
        X_TR();
        $counter++;
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_GRLRegistrationActions");
    XCLEARFLOAT();    

    XHRCLASS('underline');
    XH2("Registered Players");
    
    BTABDIV("TableTabs");
    BTABHEADERCONTAINER();
    
    Get_Data("grlleague",$GLOBALS{'currperiodid'},$leagueid);
    $grlteama = List2Array($GLOBALS{'grlleague_teamlist'});
    
    foreach ($grlteama as $grlteamid) {
        Get_Data("grlteam",$GLOBALS{'currperiodid'},$grlteamid);
        BTABHEADERITEM($grlteamid,$grlteamid);
    }
    B_TABHEADERCONTAINER();
    B_TABDIV();
    
    BTABCONTENTCONTAINER();
    foreach ($grlteama as $grlteamid) {
        Get_Data("grlteam",$GLOBALS{'currperiodid'},$grlteamid);
        $squada = List2Array($GLOBALS{'grlteam_squadlist'});
        BTABCONTENTITEM($grlteamid);
        XH3($grlteamid);
        
        XDIV("simpletablediv_GRLRegistration_".$grlteamid,"container");
        XTABLEJQDTID("simpletabletable_GRLRegistration_".$grlteamid);
        XTHEAD();
        XTRJQDT();
        XTDTXT('Player Id');
        XTDTXT('First Name');
        XTDTXT('Surname');
        XTDTXT('Season');
        XTDTXT('Date');
        XTDTXT('Approved By');
        XTDTXT('');
        XTDTXT('');
        X_TR();
        X_THEAD();
        XTBODY();
        foreach ($squada as $playerid) {
            Get_Data("grlplayer",$playerid);
            XTRJQDT();
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_id'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_fname'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_sname'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_registrationperiodid'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_registrationdate'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_registrationapprovedby'}.'</td>';
            XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsupdatebutton","resultsupdatebutton","primary","Update");X_TD();
            if ($GLOBALS{'grlplayer_registrationapprovedby'} != "") {
                XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","success","Approved");X_TD();
            } else {
                XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","warning","Approve");X_TD();
            }
            X_TR();
            $counter++;
        }
        X_TBODY();
        X_TABLE();
        X_DIV("simpletablediv_GRLRegistration_".$grlteamid);
        XCLEARFLOAT();
        B_TABCONTENTITEM();
        
    }
    B_TABCONTENTCONTAINER();
    
    XBR();XBR();
    XH5("Update Log");
    XDIV("updateLog","");
    XTXT("No updates have been made in this session so far");
    X_DIV("updateLog");
    XTXTID("TRACETEXT","");
    
}
    


// ==========================================
include 'v1_grlroutinesb.php';
// ==========================================

=======
<?php

function Grl_SETUPGRLLEAGUE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Grl_SETUPGRLLEAGUE_Output() {
    $parm0 = "";
    $parm0 = $parm0."League Competition Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlleague[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlleague_id|"; # keyfieldname
    $parm0 = $parm0."grlleague_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlleague_id|Yes|Id|60|Yes|League Code|KeyText,20,20^";
    $parm1 = $parm1."grlleague_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLCUP_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Grl_SETUPGRLCUP_Output() {
    $parm0 = "";
    $parm0 = $parm0."Cup Competition Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlcup[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlcup_id|"; # keyfieldname
    $parm0 = $parm0."grlcup_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlcup_id|Yes|Id|60|Yes|Cup Code|KeyText,20,20^";
    $parm1 = $parm1."grlcup_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLCLUB_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Grl_SETUPGRLCLUB_Output() {
    $parm0 = "";
    $parm0 = $parm0."Club Setup - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlclub[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."grlteam[rootkey=".$GLOBALS{'currperiodid'}."],grlvenue|"; # othertables
    $parm0 = $parm0."grlclub_id|"; # keyfieldname
    $parm0 = $parm0."grlclub_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlclub_id|Yes|Id|60|Yes|Club Code|KeyText,20,20^";
    $parm1 = $parm1."grlclub_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlclub_teamlist|Yes|Teams|100|Yes|Teams|InputSelectFromTable,grlteam,grlteam_id,grlteam_name,grlteam_name^";
    $parm1 = $parm1."grlclub_primevenueid|Yes|Main Venue|100|Yes|Main Venue|InputSelectFromTable,grlvenue,grlvenue_id,grlvenue_name,grlvenue_name^";
    $parm1 = $parm1."grlclub_othervenueid|Yes|Other Venue|100|Yes|Other Venue|InputSelectFromTable,grlvenue,grlvenue_id,grlvenue_name,grlvenue_name^";
    $parm1 = $parm1."grlclub_logo|Yes|Logo|100|Yes|Club Logo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,250,250,Club,grlclub_id^";
    $parm1 = $parm1."grlclub_introduction|No|||Yes|Description|InputTextArea,6,80^";   
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLTEAM_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Grl_SETUPGRLTEAM_Output() {
    $parm0 = "";
    $parm0 = $parm0."Team Setup - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlteam[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."grlleague[rootkey=".$GLOBALS{'currperiodid'}."],grlcup[rootkey=".$GLOBALS{'currperiodid'}."],person[returnedfields=person_domainid+person_id+person_sname+person_fname]|"; # othertables
    $parm0 = $parm0."grlteam_id|"; # keyfieldname
    $parm0 = $parm0."grlteam_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlteam_id|Yes|Id|60|Yes|Team Code|KeyText,20,20^";
    $parm1 = $parm1."grlteam_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlteam_mgr|Yes|Manager|250|Yes|Manager|InputText,30,60^";
    $parm1 = $parm1."grlteam_coach|Yes|Coach|250|Yes|Coach|InputText,30,60^";
    $parm1 = $parm1."grlteam_captain|Yes|Captain|250|Yes|Captain|InputText,30,60^";
    $parm1 = $parm1."grlteam_admin|Yes|Admin|250|Yes|Administrator|InputPerson,20,40,Administrator,Lookup^";
    $parm1 = $parm1."grlteam_grlleagueid|Yes|League|250|Yes|League|InputSelectFromTable,grlleague,grlleague_id,grlleague_name,grlleague_id^";
    $parm1 = $parm1."grlteam_grlcupid|Yes|Cup|250|Yes|Cup|InputSelectFromTable,grlcup,grlcup_id,grlcup_name,grlcup_id^";
    $parm1 = $parm1."grlteam_squadlist|Yes|Squad|250|Yes|Squad|InputTextArea,5,40^";
    $parm1 = $parm1."grlteam_photo|Yes|Photo|250|Yes|Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,1000,400,Team,grlteam_id^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);

$GLOBALS{'PersonSelectPopupParameters'} = array(
    "other,person_domainid|person_id|person_sname|person_fname",
    "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40",
    "field,Administrator,Select,grlteam_admin_input,grlteam_admin_personlist,70",
    "person_id",
    "active",
    "team,50,50,400,400",
    "view",
    "buildfulllist"
);

}

function Grl_SETUPGRLVENUE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Grl_SETUPGRLVENUE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Venue Setup - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlvenue|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlvenue_id|"; # keyfieldname
    $parm0 = $parm0."grlvenue_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlvenue_id|Yes|Id|60|Yes|League Code|KeyText,20,20^";
    $parm1 = $parm1."grlvenue_name|Yes|Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlvenue_address|Yes|Address|250|Yes|Address|InputTextArea,4,30^";
    $parm1 = $parm1."grlvenue_postcode|Yes|PostCode|50|Yes|PostCode|InputText,30,60^";
    $parm1 = $parm1."grlvenue_mapref|Yes|MapRef|250|Yes|MapRef|InputTextArea,4,30^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLPLAYER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Grl_SETUPGRLPLAYER_Output() {
    $parm0 = "";
    $parm0 = $parm0."Player Setup|"; # pagetitle
    $parm0 = $parm0."grlplayer|"; # primetable
    $parm0 = $parm0."grlteam[rootkey=".$GLOBALS{'currperiodid'}."]|"; # othertables
    $parm0 = $parm0."grlplayer_id|"; # keyfieldname
    $parm0 = $parm0."grlplayer_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = "";
    $parm1 = $parm1."grlplayer_id|Yes|Id|60|Yes|Player Id|KeyText,10,10^";
    $parm1 = $parm1."grlplayer_fname|Yes|First Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlplayer_sname|Yes|SurName|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlplayer_photo|No|Photo|30|Yes|Player Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,200,300,Player,grlplayer_id^";
    $parm1 = $parm1."grlplayer_profile|Yes|Profile|250|Yes|Profile|InputTextArea,5,40^";
    $parm1 = $parm1."grlplayer_position|Yes|Position|250|Yes|Position|InputText,30,60^";
    $parm1 = $parm1."grlplayer_teamid|Yes|Team|250|Yes|Team|InputSelectFromTable,grlteam,grlteam_id,grlteam_name,grlteam_name^";
    $parm1 = $parm1."grlplayer_email|Yes|Email|250|Yes|Email|InputText,30,60^";
    $parm1 = $parm1."grlplayer_mobile|Yes|Mobile|250|Yes|Mobile|InputText,15,20^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}


function Grl_SETUPGRLOFFICIAL_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Grl_SETUPGRLOFFICIAL_Output() {
    $parm0 = "";
    $parm0 = $parm0."Official Setup|"; # pagetitle
    $parm0 = $parm0."grlofficial|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlofficial_id|"; # keyfieldname
    $parm0 = $parm0."grlofficial_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."grlofficial_id|Yes|Id|60|Yes|Official Id|KeyText,10,10^";
    $parm1 = $parm1."grlofficial_fname|Yes|First Name|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlofficial_sname|Yes|SurName|250|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."grlofficial_photo|No|Photo|30|Yes|Player Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,200,300,Official,grlofficial_id^";
    $parm1 = $parm1."grlofficial_profile|Yes|Profile|250|Yes|Profile|InputTextArea,5,40^";
    $parm1 = $parm1."grlofficial_email|Yes|Email|250|Yes|Email|InputText,30,60^";
    $parm1 = $parm1."grlofficial_mobile|Yes|Mobile|250|Yes|Mobile|InputText,15,20^"; 
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_SETUPGRLPLAYERSTATTYPES_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Grl_SETUPGRLPLAYERSTATTYPES_Output() {
    $parm0 = "";
    $parm0 = $parm0."Player Statistics Types - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
    $parm0 = $parm0."grlplayerstattype[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."grlplayerstattype_code|"; # keyfieldname
    $parm0 = $parm0."grlplayerstattype_code|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."grlplayerstattype_code|Yes|Id|60|Yes|Player Stat Id|KeyText,2,2^";
    $parm1 = $parm1."grlplayerstattype_title|No||60|Yes|Header Title|InputText,30,60^";
    $parm1 = $parm1."grlplayerstattype_name|Yes|Description|200|Yes|Description|InputText,30,60^";
    $parm1 = $parm1."grlplayerstattype_values|No||60|Yes|Code Values|InputSelectFromList,Numeric+Checkbox^";
    $parm1 = $parm1."grlplayerstattype_msdisplay|Yes|Display|60|Yes|Display on Match Stats|InputSelectFromList,Yes+No^";
    $parm1 = $parm1."grlplayerstattype_mscount|Yes|Max|60|Yes|Match Stats Display Max|InputText,2,2^";
    $parm1 = $parm1."grlplayerstattype_mrdisplay|No||60|Yes|Display on Match Results|InputSelectFromList,Yes+No^";
    $parm1 = $parm1."grlplayerstattype_playoff|No||60|Yes|Player/Official|InputSelectFromList,P+O^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Grl_RecalcStats($periodid,$leagueid) {
    // XH1("Grl_RecalcStats ".$periodid." ".$leagueid);
    $leaguetablea = Array();   
    Get_Data('grlleague',$periodid,$leagueid);
    $teama = List2Array($GLOBALS{'grlleague_teamlist'});
    // $teama = Get_Array('grlleaguetable',$periodid,$leagueid);
    // XPTXT($GLOBALS{'grlleague_teamlist'});
    foreach ($teama as $teamid) {  
        // XPTXT($teamid);
        $leaguetablea[$teamid] = Array();
        Get_Data('grlteam',$periodid,$teamid);
        $leaguetablea[$teamid]["teamname"] = $GLOBALS{'grlteam_name'};
        $leaguetablea[$teamid]["played"] = 0;
        $leaguetablea[$teamid]["hw"] = 0;
        $leaguetablea[$teamid]["hd"] = 0;
        $leaguetablea[$teamid]["hl"] = 0;
        $leaguetablea[$teamid]["aw"] = 0;
        $leaguetablea[$teamid]["ad"] = 0;
        $leaguetablea[$teamid]["al"] = 0;
        $leaguetablea[$teamid]["tw"] = 0;
        $leaguetablea[$teamid]["td"] = 0;
        $leaguetablea[$teamid]["tl"] = 0;
        $leaguetablea[$teamid]["tgf"] = 0;
        $leaguetablea[$teamid]["tga"] = 0;
        $leaguetablea[$teamid]["tgdiff"] = 0;
        $leaguetablea[$teamid]["points"] = 0;
    }   
    XPTXT($GLOBALS{'currperiodid'}." ".$leagueid); 
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},"L-".$leagueid);
    foreach ($matcha as $match_id) {
        Get_Data('grlmatch',$GLOBALS{'currperiodid'},"L-".$leagueid,$match_id);
        $ignorematch = "0";
        if (strlen(strstr($GLOBALS{'grlmatch_score'},"P")) > 0) { $ignorematch = "1"; }
        if (strlen(strstr($GLOBALS{'grlmatch_score'},"-")) > 0) { } else { $ignorematch = "1"; }        
        if ($ignorematch == "0") {
            $hometeamid = $GLOBALS{'grlmatch_hometeamid'};
            $awayteamid = $GLOBALS{'grlmatch_awayteamid'};

            $leaguetablea[$hometeamid]["played"]++;
            $leaguetablea[$hometeamid]["tgf"] = $leaguetablea[$hometeamid]["tgf"] + $GLOBALS{'grlmatch_homegfull'};
            $leaguetablea[$hometeamid]["tga"] = $leaguetablea[$hometeamid]["tga"] + $GLOBALS{'grlmatch_awaygfull'};
            $leaguetablea[$hometeamid]["tgdiff"] = $leaguetablea[$hometeamid]["tgdiff"] + $GLOBALS{'grlmatch_homegfull'} - $GLOBALS{'grlmatch_awaygfull'}  ;               
            $leaguetablea[$awayteamid]["played"]++;
            $leaguetablea[$awayteamid]["tgf"] = $leaguetablea[$awayteamid]["tgf"] + $GLOBALS{'grlmatch_awaygfull'};
            $leaguetablea[$awayteamid]["tga"] = $leaguetablea[$awayteamid]["tga"] + $GLOBALS{'grlmatch_homegfull'};
            $leaguetablea[$awayteamid]["tgdiff"] = $leaguetablea[$awayteamid]["tgdiff"] + $GLOBALS{'grlmatch_awaygfull'} - $GLOBALS{'grlmatch_homegfull'}  ;
    
            if ( $GLOBALS{'grlmatch_homegfull'} > $GLOBALS{'grlmatch_awaygfull'} ) {  // home win
                $leaguetablea[$hometeamid]["hw"]++;            
                $leaguetablea[$hometeamid]["tw"]++;
                $leaguetablea[$hometeamid]["points"] = $leaguetablea[$hometeamid]["points"] + 3;                                 
                $leaguetablea[$awayteamid]["al"]++;
                $leaguetablea[$awayteamid]["tl"]++;
            }       
            if ( $GLOBALS{'grlmatch_homegfull'} == $GLOBALS{'grlmatch_awaygfull'} ) {  // draw
                $leaguetablea[$hometeamid]["hd"]++;
                $leaguetablea[$hometeamid]["td"]++;
                $leaguetablea[$hometeamid]["points"] = $leaguetablea[$hometeamid]["points"] + 1;           
                $leaguetablea[$awayteamid]["ad"]++;
                $leaguetablea[$awayteamid]["td"]++;
                $leaguetablea[$awayteamid]["points"] = $leaguetablea[$awayteamid]["points"] + 1;
            }  
            if ( $GLOBALS{'grlmatch_homegfull'} < $GLOBALS{'grlmatch_awaygfull'} ) {   // away win
                $leaguetablea[$hometeamid]["hl"]++;
                $leaguetablea[$hometeamid]["tl"]++;
                $leaguetablea[$awayteamid]["aw"]++;
                $leaguetablea[$awayteamid]["tw"]++;
                $leaguetablea[$awayteamid]["points"] = $leaguetablea[$awayteamid]["points"] + 3;
            }
        }
    }
    
    foreach ($teama as $teamid) {
        $GLOBALS{'grlleaguetable_grlteamname'} = $leaguetablea[$teamid]["teamname"];
        $GLOBALS{'grlleaguetable_played'} = $leaguetablea[$teamid]["played"];
        $GLOBALS{'grlleaguetable_hw'} = $leaguetablea[$teamid]["hw"];
        $GLOBALS{'grlleaguetable_hd'} = $leaguetablea[$teamid]["hd"];
        $GLOBALS{'grlleaguetable_hl'} = $leaguetablea[$teamid]["hl"];
        $GLOBALS{'grlleaguetable_aw'} = $leaguetablea[$teamid]["aw"];
        $GLOBALS{'grlleaguetable_ad'} = $leaguetablea[$teamid]["ad"];
        $GLOBALS{'grlleaguetable_al'} = $leaguetablea[$teamid]["al"];
        $GLOBALS{'grlleaguetable_tw'} = $leaguetablea[$teamid]["tw"];
        $GLOBALS{'grlleaguetable_td'} = $leaguetablea[$teamid]["td"];
        $GLOBALS{'grlleaguetable_tl'} = $leaguetablea[$teamid]["tl"];
        $GLOBALS{'grlleaguetable_tgf'} = $leaguetablea[$teamid]["tgf"];
        $GLOBALS{'grlleaguetable_tga'} = $leaguetablea[$teamid]["tga"];
        $GLOBALS{'grlleaguetable_tgdiff'} = $leaguetablea[$teamid]["tgdiff"];
        $GLOBALS{'grlleaguetable_points'} = $leaguetablea[$teamid]["points"];
        Write_Data("grlleaguetable",$periodid,$leagueid,$teamid);
        // XPTXT($teamid." ".$GLOBALS{'grlleaguetable_played'});
    }  
}

function Grl_LeagueResults_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";	
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,grlleagueresults,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "LeagueResults_Popup";
}


function Grl_LeagueResults_Output($parma) {
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
    
    $leagueid = $parma[0];
    $GLOBALS{'pluginhtmla'} = Array();
    $leaguematcha = Array();
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},$leagueid);
    Get_Array('grlplayer');
    foreach ($matcha as $match_id){
        $hgoallist = "";
        $agoallist = "";
        $number = "";
        //XH3($match_id);
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
        $leaguematcha[$matchmonth][$match_id][5] = $hgoallist;
        $leaguematcha[$matchmonth][$match_id][6] = $agoallist;
        $leaguematcha[$matchmonth][$match_id][7] = $GLOBALS{'grlmatch_attendance'};
        $leaguematcha[$matchmonth][$match_id][8] = $GLOBALS{'grlmatch_verifiedby'};
    }
    
    $currentmonth = "February";
    
    XINHIDID("currperiodid","currperiodid",$GLOBALS{'currperiodid'});
    XINHIDID("competitionid","competitionid",$leagueid);
    
    BTABDIV("TableTabs");
    BTABHEADERCONTAINER();   
    $mi = 0;
    foreach ($monthsa as $month){
        $mi++;        
        if ($month == $currentmonth) { BTABHEADERITEMACTIVE($month,$mthsa[$mi]); } else { BTABHEADERITEM($month,$mthsa[$mi]); }    
    }
    B_TABHEADERCONTAINER();
    B_TABDIV();

    BTABCONTENTCONTAINER();
    foreach ($monthsa as $month){
        if ($month == $currentmonth) { BTABCONTENTITEMACTIVE($month); } else { BTABCONTENTITEM($month); }       
        XH3($month);
        XDIV("simpletablediv_GRLResultsHTMLA_L-Premier_".$month,"container");
        XTABLEJQDTID("simpletabletable_GRLResultsHTMLA_L-Premier_".$month);
        XTHEAD();
        XTRJQDT();
        XTDTXT('Match Time');
        XTDTXT('Home');
        XTDTXT('Score');
        XTDTXT('Away');
        XTDTXT('Match Att.');
        XTDTXT('');
        XTDTXT('');
        X_TR();
        X_THEAD();
        XTBODY();
        
        $matchdatetest = "";
        $counter = "0";
        foreach ($leaguematcha[$month] as $match_id => $varray) {
            if (($matchdatetest == $leaguematcha[$month][$match_id][0])){ } else {
                $mydate = strtotime($leaguematcha[$month][$match_id][0]);
                $newdate = date('F jS Y', $mydate);
                XTRJQDT();
                XTDBACKCOLOR('black');XTDBACKCOLOR('black');XTDTXTBACKTXTCOLOR($newdate,'black','white');XTDBACKCOLOR('black');XTDBACKCOLOR('black');XTDBACKCOLOR('black');XTDBACKCOLOR('black');
                X_TR();
                $matchdatetest = $leaguematcha[$month][$match_id][0];
            }
            XTRJQDT();
            print '<td style= "vertical-align: top;"><font color="grey">'.$leaguematcha[$month][$match_id][1].'</font></td>';
            print '<td style= "vertical-align: top;"><font size="3" color="darkblue">'."<b>".$leaguematcha[$month][$match_id][2]."</b></font><br><font color='grey'>".$leaguematcha[$month][$match_id][5].'</font></td>';
            print '<td style= "vertical-align: top;"><b>'.$leaguematcha[$month][$match_id][3].'</b></td>';
            print '<td style= "vertical-align: top;"><font size="3" color="darkblue">'."<b>".$leaguematcha[$month][$match_id][4]."</b></font><br><font color='grey'>".$leaguematcha[$month][$match_id][6].'</font></td>';
            print '<td style= "vertical-align: top;"><font color="grey">'."Att.".$leaguematcha[$month][$match_id][7].'</font></td>';
            XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsupdatebutton","resultsupdatebutton","primary","Update");X_TD();
            if ($leaguematcha[$month][$match_id][8] != "") {
                XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","success","Verified");X_TD(); 
            } else {
                XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","warning","Verify");X_TD(); 
            }
            X_TR();
            $counter++;
        }
        X_TBODY();
        X_TABLE();
        X_DIV("simpletablediv_GRLResultsHTMLA_L-Premier_".$month);
        XCLEARFLOAT();
        B_TABCONTENTITEM();
        
    }
    B_TABCONTENTCONTAINER();
    
    XBR();XBR();
    XH5("Update Log");
    XDIV("updateLog","");
    XTXT("No updates have been made in this session so far");
    X_DIV("updateLog");
    XTXTID("TRACETEXT","");
    
}

function LeagueResults_Popup () {
    XDIVPOPUP("leagueresultspopup","League Results");
    XDIV("leagueresultspopupcontainer","");
    
    XH3ID("matchtitle","");
    XHRCLASS('underline');
    BROW();
    BCOLTXT("Date","2");
    BCOLINTXTID('matchdate','matchdate',"Sept 6th","2");
    BCOLTXT("Time","2");
    BCOLINTXTID('matchtime','matchtime',"13:00","2");
    BCOLTXT("Attendance","2");
    BCOLINTXTID('attendance','attendance',"1,234","2");
    B_ROW();
    XHRCLASS('underline');
    XH3("Result");
    BROW();
    BCOLTXT("","2");
    BCOLTXT("Home","2");
    BCOLTXT("Away","2");
    B_ROW();
    BROW();
    BCOLTXT("Half Time","2");
    BCOLINTXTID('homeghalf','homeghalf',"0","2");
    BCOLINTXTID('awayghalf','awayghalf',"0","2");
    B_ROW();
    BROW();
    BCOLTXT("Full Time","2");
    BCOLINTXTID('homegfull','homegfull',"0","2");
    BCOLINTXTID('awaygfull','awaygfull',"0","2");
    B_ROW();
    XHRCLASS('underline');
    // Element      Class         id
    // Add New .hstat_addnew   hstat_G_addnew
    // Row	   .hstat_row	   hstat_G_rowseq_row
    // Stat	   .hstat_stat	   hstat_G_rowseq_playerid
    //   	   .hstat_stat	   hstat_G_rowseq_time
    //         .hstat_stat	   hstat_G_rowseq_extra
    // Delete  .hstat_delete   hstat_G_rowseq_delete
    // Div                     hstat_G_listend
    
    XH3("Home Team Statistics");
    $grlplayerstattypea = Get_Array("grlplayerstattype",$GLOBALS{'currperiodid'});
    foreach ($grlplayerstattypea as $grlplayerstattypecode){
        Get_Data("grlplayerstattype",$GLOBALS{'currperiodid'},$grlplayerstattypecode);
        XH4($GLOBALS{'grlplayerstattype_title'});
        BROW();
        BCOLTXTCOLOR("<b>Name</b>","6","gray","white");
        BCOLTXTCOLOR("<b>Time</b>","2","gray","white");
        BCOLTXTCOLOR("<b>Type</b>","2","gray","white");
        BCOL("1"); BINBUTTONIDCLASSSPECIAL('hstat_'.$grlplayerstattypecode."_addnew",'hstat_addnew',"success","+"); B_COL();
        BCOLTXT("","1");
        B_ROW();
        XDIV("hstat_".$grlplayerstattypecode."_listend","");
        X_DIV("hstat_".$grlplayerstattypecode."_listend");
        XHRCLASS('underline');
    }
    
    XH3("Away Team Statistics");
    $grlplayerstattypea = Get_Array("grlplayerstattype",$GLOBALS{'currperiodid'});
    foreach ($grlplayerstattypea as $grlplayerstattypecode){
        Get_Data("grlplayerstattype",$GLOBALS{'currperiodid'},$grlplayerstattypecode);
        XH4($GLOBALS{'grlplayerstattype_title'});
        BROW();
        BCOLTXTCOLOR("<b>Name</b>","6","gray","white");
        BCOLTXTCOLOR("<b>Time</b>","2","gray","white");
        BCOLTXTCOLOR("<b>Type</b>","2","gray","white");
        BCOL("1"); BINBUTTONIDCLASSSPECIAL('astat_'.$grlplayerstattypecode."_addnew",'astat_addnew',"success","+"); B_COL();
        BCOLTXT("","1");
        B_ROW();
        XDIV("astat_".$grlplayerstattypecode."_listend","");
        X_DIV("astat_".$grlplayerstattypecode."_listend");
        XHRCLASS('underline');
    }
    X_DIV("leagueresultspopupcontainer");
    XBR();XBR();
    XINBUTTONIDSPECIAL("leagueresultspopupupdatebutton","primary","Update");
    XINBUTTONIDSPECIAL("leagueresultspopupclosebutton","warning","Close");
    X_DIV("leagueresultspopup");
}

function Grl_LeagueOfficialResults_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "grlleagueofficialresults,jqueryconfirm";
}

function Grl_LeagueOfficialResults_Output($parma) {
  
    $leagueid = $parma[0];
    XH3("Official Match Results");
    
    XDIV("GRLMatchKeyDiv","matchkeycontainer");
    BROW(); BCOLTXT("Please enter your Match Key","12"); B_ROW();
    BROW(); BCOLINTXTID("MatchKey","MatchKey","","6"); BINBUTTONIDSPECIAL ("MatchKeyEnter","primary","Enter"); B_ROW();    
    XBR();XBR();
    X_DIV("GRLMatchKeyDiv");
    
    $first = "1";
    XDIV("simpletablediv_GRLMatches","container");
    XTABLEJQDTID("simpletabletable_GRLMatches");
    XTHEAD();
    XTRJQDT();
    XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    $leaguematcha = Array();
    $matcha = Get_Array('grlmatch',$GLOBALS{'currperiodid'},$leagueid);
    foreach ($matcha as $match_id){
        Get_Data('grlmatch',$GLOBALS{'currperiodid'},$leagueid,$match_id);
        //XH3($GLOBALS{'grlmatch_hometeamname'});
        $matchdate = $GLOBALS{'grlmatch_date'};
        if (($GLOBALS{'grlmatch_date'} == $GLOBALS{'currentYYYY-MM-DD'})&&($first == "1")) {
            XTRJQDT();
            XTDTXT($GLOBALS{'grlmatch_hometeamname'});
            XTDTXT("vs");
            XTDTXT($GLOBALS{'grlmatch_awayteamname'});
            XTD();
            $link = YPGMLINK("grlleagueofficialresults2out.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("grlmatch_id",$match_id);
            XLINKBUTTONSPECIAL($link,"Update",'success');
            X_TD();
            X_TR();
            $first = "0";
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_GRLMatches");
    XCLEARFLOAT();
    XBR();
    XBR();
}

function Grl_LeagueOfficialResults2_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm,jqueryuisignature,";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,grlleagueofficialresults2,jqueryconfirm,jqueryuisignature,";
}

function Grl_LeagueOfficialResults2_Output($parma,$thisgrlmatch_id) {    
    $leagueid = $parma[0];
    Get_Data('grlmatch',$GLOBALS{'currperiodid'},$leagueid,$thisgrlmatch_id);

    XINHIDID("currperiodid","currperiodid",$GLOBALS{'currperiodid'});
    XINHIDID("competitionid","competitionid",$leagueid);
    XINHIDID("grlmatch_id","grlmatch_id",$thisgrlmatch_id);    
    XINHIDID("grlhometeamid","grlhometeamid",$GLOBALS{'grlmatch_hometeamid'});    
    XINHIDID("grlawayteamid","grlawayteamid",$GLOBALS{'grlmatch_awayteamid'}); 
    Get_Data('grlteam',$GLOBALS{'currperiodid'},$GLOBALS{'grlmatch_hometeamid'});
    XINHIDID("grlhometeamsquadlist","grlhometeamsquadlist",$GLOBALS{'grlteam_squadlist'});    
    Get_Data('grlteam',$GLOBALS{'currperiodid'},$GLOBALS{'grlmatch_awayteamid'});
    XINHIDID("grlawayteamsquadlist","grlawayteamsquadlist",$GLOBALS{'grlteam_squadlist'});    
    
    XH3($GLOBALS{'grlmatch_hometeamname'}." vs ".$GLOBALS{'grlmatch_awayteamname'});
    XHRCLASS('underline');
    XDIV("simpletablediv_DateTime","container");
    XTABLEJQDTID("simpletabletable_DateTime");
    XTHEAD();
    XTRJQDT();
    XTDTXT("");XTDTXT("");
    X_TR();
    X_THEAD();
    XTBODY();    
    XTRJQDT();
    XTDTXT("Date");
    XTDINTXTID('matchdate','matchdate',$GLOBALS{'grlmatch_date'},"10","10");
    X_TR();
    XTRJQDT();
    XTDTXT("Time");
    XTDINTXTID('matchtime','matchtime',$GLOBALS{'grlmatch_time'},"10","10");
    X_TR();
    XTRJQDT();
    XTDTXT("Attendance");
    XTDINTXTID('attendance','attendance',$GLOBALS{'grlmatch_attendance'},"10","10");
    X_TR();
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_DateTime");
    XCLEARFLOAT();
    XHRCLASS('underline');
    XH4("Match Result");
    XDIV("simpletablediv_Result","container");
    XTABLEJQDTID("simpletabletable_Result");
    XTHEAD();
    XTRJQDT();
    XTDTXT("");XTDTXT("");XTDTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    XTRJQDT();
    XTDTXT("");
    XTDTXT($GLOBALS{'grlmatch_hometeamname'});
    XTDTXT($GLOBALS{'grlmatch_awayteamname'});
    X_TR();
    XTRJQDT();
    XTDTXT("Half Time");
    XTDINTXTID("homeghalf","homeghalf",$GLOBALS{'grlmatch_homeghalf'},"2","2");
    XTDINTXTID("awayghalf","awayghalf",$GLOBALS{'grlmatch_awayghalf'},"2","2");
    X_TR();
    XTRJQDT();
    XTDTXT("Full Time");
    XTDINTXTID("homegfull","homegfull",$GLOBALS{'grlmatch_homegfull'},"2","2");
    XTDINTXTID("awaygfull","awaygfull",$GLOBALS{'grlmatch_awaygfull'},"2","2");
    X_TR();
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_Result");
    XCLEARFLOAT();
    XHRCLASS('underline');
    XH3("Match Stats");
    
    // Element      Class         id
    // Add New .hstat_addnew   hstat_G_addnew
    // Row	   .hstat_row	   hstat_G_rowseq_row
    // Stat	   .hstat_stat	   hstat_G_rowseq_playerid
    //   	   .hstat_stat	   hstat_G_rowseq_time
    //         .hstat_stat	   hstat_G_rowseq_extra
    // Delete  .hstat_delete   hstat_G_rowseq_delete
    // Div                     hstat_G_listend
    
    
    XDIV("statsdiv","statsdiv");
    // XH4("Home Team Statistics");
    XINBUTTONIDSPECIAL("squadlistbutton_".$GLOBALS{'grlmatch_hometeamid'},"info","Home Team");
    $grlplayerstattypea = Get_Array("grlplayerstattype",$GLOBALS{'currperiodid'});
    foreach ($grlplayerstattypea as $grlplayerstattypecode){
        Get_Data("grlplayerstattype",$GLOBALS{'currperiodid'},$grlplayerstattypecode);
        XH4($GLOBALS{'grlplayerstattype_title'});
        BROW();
        BCOLTXTCOLOR("<b>Name</b>","6","gray","white");
        BCOLTXTCOLOR("<b>Time</b>","2","gray","white");
        BCOLTXTCOLOR("<b>Type</b>","2","gray","white");
        BCOL("1"); BINBUTTONIDCLASSSPECIAL('hstat_'.$grlplayerstattypecode."_addnew",'hstat_addnew',"success","+"); B_COL();
        BCOLTXT("","1");
        B_ROW();
        XDIV("hstat_".$grlplayerstattypecode."_listend","");
        X_DIV("hstat_".$grlplayerstattypecode."_listend");
        XHRCLASS('underline');
    }
    
    // XH4("Away Team Statistics");
    XINBUTTONIDSPECIAL("squadlistbutton_".$GLOBALS{'grlmatch_awayteamid'},"info","Away Team");
    $grlplayerstattypea = Get_Array("grlplayerstattype",$GLOBALS{'currperiodid'});
    foreach ($grlplayerstattypea as $grlplayerstattypecode){
        Get_Data("grlplayerstattype",$GLOBALS{'currperiodid'},$grlplayerstattypecode);
        XH4($GLOBALS{'grlplayerstattype_title'});
        BROW();
        BCOLTXTCOLOR("<b>Name</b>","6","gray","white");
        BCOLTXTCOLOR("<b>Time</b>","2","gray","white");
        BCOLTXTCOLOR("<b>Type</b>","2","gray","white");
        BCOL("1"); BINBUTTONIDCLASSSPECIAL('astat_'.$grlplayerstattypecode."_addnew",'astat_addnew',"success","+"); B_COL();
        BCOLTXT("","1");
        B_ROW();
        XDIV("astat_".$grlplayerstattypecode."_listend","");
        X_DIV("astat_".$grlplayerstattypecode."_listend");
        XHRCLASS('underline');
    }
    XBR();XBR();
        
    XH3("Signature");
    // XPTXT($GLOBALS{'dmwssux_signature'});
    XINHIDIDDQ("grlmatch_signature","grlmatch_signature",$GLOBALS{'grlmatch_signature'});
    XINHIDIDDQ("mirrorsignature","mirrorsignature","");
    
    XDIV("noSignature","");
    XBR();
    XTXT("No signature recorded");
    XBR();
    X_DIV("noSignature");
    
    XDIV("drawSignature","kbw-signaturedraw");
    X_DIV("drawSignature");
    XBR();
    BINBUTTONIDSPECIAL("drawSignatureClear","warning","Remove Signature");
    BINBUTTONIDSPECIAL("drawSignatureUpdate","primary","Enter Signature");
    
    XBR();XBR();
    XINBUTTONIDSPECIAL("matchresultupdatebutton","primary","Update");
    XINBUTTONIDSPECIAL("matchresultclosebutton","warning","Close");
    X_DIV("statsdiv");
    
    XBR();XBR();
    XH5("Update Log");
    XDIV("updateLog","");
    XTXT("No updates have been made in this session so far");
    X_DIV("updateLog");
    XTXTID("TRACETEXT","");
    
    SquadList_Popup ($GLOBALS{'grlmatch_hometeamid'});
    SquadList_Popup ($GLOBALS{'grlmatch_awayteamid'});
    GRLSignaturePopup();
}

function SquadList_Popup ($thisgrlteamid) {
    Get_Data('grlteam',$GLOBALS{'currperiodid'},$thisgrlteamid);
    $squada = List2Array($GLOBALS{'grlteam_squadlist'});
    XDIVPOPUP("squadlistpopup_".$thisgrlteamid,"Squad List");
    XDIV("squadlistpopupcontainer_".$thisgrlteamid,"");   
    XH3ID("squadtitle","");
    XHRCLASS('underline');
    XDIV("simpletablediv_GRLSquadlist_".$thisgrlteamid,"container");
    XTABLEJQDTID("simpletabletable_GRLSquadlist_".$thisgrlteamid);
    XTHEAD();
    XTRJQDT();
    XTDTXT('Photo');
    XTDTXT('Player Id');
    XTDTXT('Shirt No');
    XTDTXT('First Name');
    XTDTXT('Surname');
    XTDTXT('League Approved');
    X_TR();
    X_THEAD();
    XTBODY();
    
    $shirtno = 1;
    foreach ($squada as $playerid) {
        Get_Data("grlplayer",$playerid);
        XTRJQDT();      
        XTDIMGWIDTH($GLOBALS{'domainwwwcorsurl'}."/domain_media/player".$shirtno.".jpeg","100px");
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_id'}.'</td>';
        print '<td style= "vertical-align: top;">'.$shirtno.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_fname'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_sname'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_registrationdate'}.'</td>';
        X_TR();
        $shirtno++;
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_GRLSquadlist_".$thisgrlteamid);
    XCLEARFLOAT();
    XBR();
    XINBUTTONIDSPECIAL("squadlistpopupclosebutton_".$thisgrlteamid,"warning","Close");
    X_DIV("squadlistpopupcontainer_".$thisgrlteamid);
    X_DIV("squadlistpopup_".$thisgrlteamid);
}

function GRLSignaturePopup() {
    XDIVPOPUP("signaturepopup","Signature");
    XDIV("captureSignaturePopup","kbw-signature");
    
    
    X_DIV("captureSignaturePopup");
    XBR();XBR();
    XINBUTTONID("signaturepopupSave","Save");
    XINBUTTONID("signaturepopupClear","Clear");
    XINBUTTONIDSPECIAL("signaturepopupClose","warning","Close");
    X_DIV("signaturepopup");
}

function Grl_LeagueREgistration_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,grlleagueresults,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "LeagueResults_Popup";
}


function Grl_LeagueRegistration_Output($parma) {
    $leagueid = $parma[0];
    XH1("League Registration - ".$leagueid);
    XINHIDID("currperiodid","currperiodid",$GLOBALS{'currperiodid'});
    XINHIDID("competitionid","competitionid",$leagueid);
    
    XHRCLASS('underline');
    XH2("Registration Transactions");
    
    XDIV("simpletablediv_GRLRegistrationTxns","container");
    XTABLEJQDTID("simpletabletable_GRLRegistrationTxns");
    XTHEAD();
    XTRJQDT();
    XTDTXT('Type');
    XTDTXT('Player Id');
    XTDTXT('First Name');
    XTDTXT('Surname');
    XTDTXT('Season');
    XTDTXT('RequestedBy');
    XTDTXT('TransferFrom');
    XTDTXT('Raised Date');
    XTDTXT('Player Approved');
    XTDTXT('Transfer Approved');
    XTDTXT('League Approved');
    XTDTXT('');
    XTDTXT('');
    X_TR();
    X_THEAD();
    XTBODY();
    $grlregistrationtxna = Get_Array("grlregistrationtxn","Open");
    foreach ($grlregistrationtxna as $grlregistrationtxnid){
        Get_Data("grlregistrationtxn","Open",$grlregistrationtxnid);
        Get_Data("grlplayer",$GLOBALS{'grlregistrationtxn_grlplayerid'});
        XTRJQDT();
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_type'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_id'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_fname'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_sname'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_periodid'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_askinggrlclubid'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_fromgrlclubid'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_askingdate'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_playerapproveddate'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_fromapproveddate'}.'</td>';
        print '<td style= "vertical-align: top;">'.$GLOBALS{'grlregistrationtxn_leagueapproveddate'}.'</td>';
        XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsupdatebutton","resultsupdatebutton","primary","Update");X_TD();
        if ($GLOBALS{'grlplayer_registrationapprovedby'} != "") {
            XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","success","Approved");X_TD();
        } else {
            XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","warning","Approve");X_TD();
        }
        X_TR();
        $counter++;
    }
    X_TBODY();
    X_TABLE();
    X_DIV("simpletablediv_GRLRegistrationActions");
    XCLEARFLOAT();    

    XHRCLASS('underline');
    XH2("Registered Players");
    
    BTABDIV("TableTabs");
    BTABHEADERCONTAINER();
    
    Get_Data("grlleague",$GLOBALS{'currperiodid'},$leagueid);
    $grlteama = List2Array($GLOBALS{'grlleague_teamlist'});
    
    foreach ($grlteama as $grlteamid) {
        Get_Data("grlteam",$GLOBALS{'currperiodid'},$grlteamid);
        BTABHEADERITEM($grlteamid,$grlteamid);
    }
    B_TABHEADERCONTAINER();
    B_TABDIV();
    
    BTABCONTENTCONTAINER();
    foreach ($grlteama as $grlteamid) {
        Get_Data("grlteam",$GLOBALS{'currperiodid'},$grlteamid);
        $squada = List2Array($GLOBALS{'grlteam_squadlist'});
        BTABCONTENTITEM($grlteamid);
        XH3($grlteamid);
        
        XDIV("simpletablediv_GRLRegistration_".$grlteamid,"container");
        XTABLEJQDTID("simpletabletable_GRLRegistration_".$grlteamid);
        XTHEAD();
        XTRJQDT();
        XTDTXT('Player Id');
        XTDTXT('First Name');
        XTDTXT('Surname');
        XTDTXT('Season');
        XTDTXT('Date');
        XTDTXT('Approved By');
        XTDTXT('');
        XTDTXT('');
        X_TR();
        X_THEAD();
        XTBODY();
        foreach ($squada as $playerid) {
            Get_Data("grlplayer",$playerid);
            XTRJQDT();
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_id'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_fname'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_sname'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_registrationperiodid'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_registrationdate'}.'</td>';
            print '<td style= "vertical-align: top;">'.$GLOBALS{'grlplayer_registrationapprovedby'}.'</td>';
            XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsupdatebutton","resultsupdatebutton","primary","Update");X_TD();
            if ($GLOBALS{'grlplayer_registrationapprovedby'} != "") {
                XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","success","Approved");X_TD();
            } else {
                XTD();XINBUTTONIDCLASSSPECIAL ($match_id."_resultsverifybutton","resultsupdatebutton","warning","Approve");X_TD();
            }
            X_TR();
            $counter++;
        }
        X_TBODY();
        X_TABLE();
        X_DIV("simpletablediv_GRLRegistration_".$grlteamid);
        XCLEARFLOAT();
        B_TABCONTENTITEM();
        
    }
    B_TABCONTENTCONTAINER();
    
    XBR();XBR();
    XH5("Update Log");
    XDIV("updateLog","");
    XTXT("No updates have been made in this session so far");
    X_DIV("updateLog");
    XTXTID("TRACETEXT","");
    
}
    


// ==========================================
include 'v1_grlroutinesb.php';
// ==========================================

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>