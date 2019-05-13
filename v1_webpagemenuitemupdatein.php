<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_MENUITEMUPDATE_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inmenu_id = $_REQUEST['menu_id'];
$injson_output = $_REQUEST['json_output'];
$inpublish = $_REQUEST['publish'];

// XPTXT($injson_output);

/*

[
{"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"Home","targettype":"Webpage","text":"Home","id":1},
{"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"Club","targettype":"Webpage","text":"Club Info","id":2,"children":
    [
    {"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"AboutHavantHC","targettype":"Webpage","text":"About Us","id":3},
    {"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"","targettype":"Contacts","text":"Contacts","id":4},
    {"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"Directions","targettype":"Webpage","text":"Directions","id":5},
    {"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"Forthcoming_Events","targettype":"Webpage","text":"Events","id":6}
    ]
},
{"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"Mens","targettype":"Webpage","text":"Mens","id":7,"children":
    [
    {"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"Mens","targettype":"Webpage","text":"Mens Section","id":8},
    {"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"Mens Training","targettype":"Webpage","text":"Mens Training","id":9}
    ]
},
{"deleted":0,"new":0,"hide":"Display","url":"","webpagename":"","targettype":"Results","text":"Fixtures ","id":17},
{"deleted":0,"new":0,"hide":"Display","url":"https://twitter.com/havanthc","webpagename":"","targettype":"Twitter","text":"Twitter","id":21},
{"deleted":"1","new":0,"hide":"Display","url":"","webpagename":"2011","targettype":"Webpage","text":"Instagram","id":22},
{"deleted":0,"new":1,"hide":"Display","url":"","webpagename":2011,"targettype":"Webpage","text":"NewItem","id":503}
]

*/


$menuitema = Get_Array('menuitem',$inmenu_id);
foreach ($menuitema as $menuitem_id) {
    Get_Data("menuitem",$inmenu_id,$menuitem_id);
    Write_Data("menuitem",$inmenu_id."BAK",$menuitem_id);
    Delete_Data("menuitem",$inmenu_id,$menuitem_id);
}


$injson_output = str_replace('[', "", $injson_output);
$json_outputa = explode("{",$injson_output);

$menuitemseq = 0; 
$level = 1;
$level1seqn = 0;
$level1seqs = "";
$level2seqn = 0;
$level2seqs = "";

foreach ($json_outputa as $json_line) {
    $json_line = str_replace('}', "", $json_line);
    // XPTXT($level." = ".$json_line);
    $jbitsa = explode(",",$json_line);
    foreach ($jbitsa as $jbit) {
        $jbit = str_replace('http:', "http|", $jbit); // gets round the colon problem
        $jbit = str_replace('https:', "https|", $jbit);
        $kbits = explode(':',$jbit);
        $kbits[0] = trim($kbits[0],'"');
        $kbits[0] = rtrim($kbits[0],'"');
        $kbits[1] = trim($kbits[1],'"');
        $kbits[1] = rtrim($kbits[1],'"');
        $kbits[1] = str_replace('http|', "http:", $kbits[1]);
        $kbits[1] = str_replace('https|', "https:", $kbits[1]);
        if ( $kbits[0] == 'deleted' ) { $deleted = $kbits[1]; }
        if ( $kbits[0] == 'new' ) { $new = $kbits[1]; }
        if ( $kbits[0] == 'hide' ) { $hide = $kbits[1]; }
        if ( $kbits[0] == 'url' ) { $url = $kbits[1]; }
        if ( $kbits[0] == 'webpagename' ) { $webpagename = $kbits[1]; }
        if ( $kbits[0] == 'targettype' ) { $targettype = $kbits[1]; }
        if ( $kbits[0] == 'text' ) { $text = $kbits[1]; }
        if ( $kbits[0] == 'nid' ) { $nid = $kbits[1]; }      
    }
    if ( $deleted == "0" ) {
        if ($level == 1) {
            $seqstring = "00".$level1seqn;
            $endseqstring = substr($seqstring, -2);
            $level1seqs = "S".$endseqstring;
            $seq = $level1seqs;
        }
        if ($level == 2) {
            $seqstring = "00".$level2seqn;
            $endseqstring = substr($seqstring, -2);
            $level2seqs = "S".$endseqstring;
            $seq = $level1seqs."/".$level2seqs;
        }
        // XPTXT($level."|".$seq." = ".$json_line);
        $seqstring = "00000".$menuitemseq;
        $endseqstring = substr($seqstring, -5);
        $thismenuitem_id = "MI".$endseqstring;
        
        if ($level == 1) {
            $GLOBALS{'menuitem_parentmenuitemname'} = "";
        }
        if ($level == 2) {
            $GLOBALS{'menuitem_parentmenuitemname'} = $lastlevel1text;
        }
        $GLOBALS{'menuitem_seq'} = $seq;
        $GLOBALS{'menuitem_text'} = $text;
        $GLOBALS{'menuitem_targettype'} = $targettype;
        $GLOBALS{'menuitem_webpagename'} = $webpagename;
        $GLOBALS{'menuitem_url'} = $url;
        $GLOBALS{'menuitem_hide'} = $hide;
        Write_Data("menuitem",$inmenu_id,$thismenuitem_id);
        // XPTXT("Write_Data ".$inmenu_id." ".$thismenuitem_id);
        
        if ($level == 1) {
            $lastlevel1text = $GLOBALS{'menuitem_text'};
            $level1seqn++;
        }
        if ($level == 2) {
            $level2seqn++;
        }
    }
    $menuitemseq++;
    if (strlen(strstr($json_line,'"children":'))>0) {
        $level = $level + 1;
        $level1seqn++;
    }
    if (strlen(strstr($json_line,']'))>0) {
        $level = $level - 1;
    } 
}


if ( $inpublish == "Yes" ) {
    XPTXTCOLOR("Menu updated and republished","green");
    Webpage_MENUPUBLISH_Output($inmenu_id);
    Webpage_TEMPLATEPUBLISHALL_Output();
    Webpage_WEBPAGEPUBLISHALL_Output();
} else {
    XPTXTCOLOR("Menu updated but not republished","orange");
}

XBR();
$link = YPGMLINK("webpagemenuitemupdate.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("menu_id",$inmenu_id);
XLINKTXT($link,"make further changes to this menu");

XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","MENUUPDATE");
XLINKTXT($link,"show my menu list");

Back_Navigator();
PageFooter("Default","Final");

?>

