<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();
Setup_KBSECTION_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$injson_output = $_REQUEST['json_output'];
// XPTXT($injson_output);

/*
$kbsectionrarysectiona = Get_Array('kbsection');
foreach ($kbsectiona as $kbsection_id) {
    Get_Data("kbsection",$kbsection_id);
    Write_Data("kbsection",$kbsection_id."BAK");
    Delete_Data("kbsection",$kbsection_id);
}
*/

$injson_output = str_replace('[', "", $injson_output);
$json_outputa = explode("{",$injson_output);

$level = 1;
$level1seqn = 0;
$level1seqs = "";
$level2seqn = 0;
$level2seqs = "";
$level3seqn = 0;
$level3seqs = "";
$level4seqn = 0;
$level4seqs = "";
$level5seqn = 0;
$level5seqs = "";

foreach ($json_outputa as $json_line) {
    $json_line = str_replace('}', "", $json_line);
    if ($json_line !== "") {
        // XPTXT($level." = ".$json_line);
        $jbitsa = explode(",",$json_line);
        foreach ($jbitsa as $jbit) {
            $kbits = explode(':',$jbit);
            $kbits[0] = trim($kbits[0],'"');
            $kbits[0] = rtrim($kbits[0],'"');
            $kbits[1] = trim($kbits[1],'"');
            $kbits[1] = rtrim($kbits[1],'"');
            if ( $kbits[0] == 'deleted' ) { $deleted = $kbits[1]; }
            if ( $kbits[0] == 'new' ) { $new = $kbits[1]; }
            if ( $kbits[0] == 'ref' ) { $ref = $kbits[1]; }
            if ( $kbits[0] == 'type' ) { $type = $kbits[1]; }
            if ( $kbits[0] == 'title' ) { $title = $kbits[1]; }
            if ( $kbits[0] == 'kbsectionid' ) { $kbsectionid = $kbits[1]; }
            if ( $kbits[0] == 'id' ) { $id = $kbits[1]; }      
        }
        if ( $deleted == 0 ) {
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
            if ($level == 3) {
                $seqstring = "00".$level3seqn;
                $endseqstring = substr($seqstring, -2);
                $level3seqs = "S".$endseqstring;
                $seq = $level1seqs."/".$level2seqs."/".$level3seqs;
            }
            if ($level == 4) {
                $seqstring = "00".$level4seqn;
                $endseqstring = substr($seqstring, -2);
                $level4seqs = "S".$endseqstring;
                $seq = $level1seqs."/".$level2seqs."/".$level3seqs."/".$level4seqs;
            }
            if ($level == 5) {
                $seqstring = "00".$level5seqn;
                $endseqstring = substr($seqstring, -2);
                $level5seqs = "S".$endseqstring;
                $seq = $level1seqs."/".$level2seqs."/".$level3seqs."/".$level4seqs."/".$level5seqs;
            }
            // XPTXT($level."|".$seq." = ".$json_line);
            $GLOBALS{'kbsection_title'} = $title;
            $GLOBALS{'kbsection_type'} = $type;
            $GLOBALS{'kbsection_ref'} = $ref;
            $GLOBALS{'kbsection_sequence'} = $seq;
            // XPTXT("Write_Data ".$kbsectionid." ".$title);
            Write_Data("kbsection",$kbsectionid);
            
            if ($level == 1) { $level1seqn++; }
            if ($level == 2) { $level2seqn++; }
            if ($level == 3) { $level3seqn++; }
            if ($level == 4) { $level4seqn++; }
            if ($level == 5) { $level5seqn++; }
        } else {
            Check_Data("kbsection",$kbsectionid);
            if ($GLOBALS{'IOWARNING'} == "0") {
                // XPTXT("Delete_Data ".$kbsectionid." ".$title);
                Delete_Data("kbsection",$kbsectionid);
            }
        }
            
        if (strlen(strstr($json_line,'"children":'))>0) {
            $level = $level + 1;
            $level1seqn++;
        }
        if (strlen(strstr($json_line,']'))>0) {
            $level = $level - 1;
        }
    }
}

XPTXTCOLOR("Knowledgebase Structure updated","green");

$kbsectiona = Get_Array("kbsection");
$kbsectiontemparray = Array();
foreach ( $kbsectiona as $kbsection_id ) {
    Get_Data("kbsection",$kbsection_id);
    $kblevela = explode('/',$GLOBALS{'kbsection_sequence'});
    $kblevel = count($kblevela);
    $arrayelement = $GLOBALS{'kbsection_sequence'}."#".$kbsection_id;
    array_push($kbsectiontemparray, $arrayelement);
}
sort ($kbsectiontemparray);

$htmlacc = "";
$oldkbsection_type = "";
$htmlacc = $htmlacc.YACCORDIONCONTAINER();
foreach ($kbsectiontemparray as $arrayelement) {
    $mibit3s = explode("#",$arrayelement);
    $kbsection_id = $mibit3s[1];
    Get_Data("kbsection",$kbsection_id);
    if ( $GLOBALS{'kbsection_ref'} == "" ) {
        $GLOBALS{'kbsection_ref'} = $GLOBALS{'kbsection_title'};
        $GLOBALS{'kbsection_ref'} = str_replace(" ", "", $GLOBALS{'kbsection_ref'});
    }
    if ($GLOBALS{'kbsection_type'} != $oldkbsection_type) {
        if ( $oldkbsection_type == "" ) {
            $htmlacc = $htmlacc.YACCORDIONSECTION($GLOBALS{'kbsection_ref'},$GLOBALS{'kbsection_title'});
        } else {
            if ( $GLOBALS{'kbsection_type'} == "HelpSection" ) { 
                $htmlacc = $htmlacc.Y_ACCORDIONSECTION();
                $htmlacc = $htmlacc.YACCORDIONSECTION($GLOBALS{'kbsection_ref'},$GLOBALS{'kbsection_title'});                
            }
            if ( $GLOBALS{'kbsection_type'} == "HelpItem" ) {
                $htmlacc = $htmlacc.YACCORDIONITEM($GLOBALS{'kbsection_ref'},$GLOBALS{'kbsection_title'});
            }
        }
    } else {
        if ( $GLOBALS{'kbsection_type'} == "HelpSection" ) {            
            $htmlacc = $htmlacc.Y_ACCORDIONSECTION(); 
            $htmlacc = $htmlacc.YACCORDIONSECTION($GLOBALS{'kbsection_ref'},$GLOBALS{'kbsection_title'});            
        }
        if ( $GLOBALS{'kbsection_type'} == "HelpItem" ) {
            $htmlacc = $htmlacc.YACCORDIONITEM($GLOBALS{'kbsection_ref'},$GLOBALS{'kbsection_title'});
        }
    }
    $oldkbsection_type = $GLOBALS{'kbsection_type'};
}
$htmlacc = $htmlacc.Y_ACCORDIONSECTION();
$htmlacc = $htmlacc.Y_ACCORDIONCONTAINER();
        
print $htmlacc;

Setup_KBSECTION_Output();

XBR();
$link = YPGMLINK("kbsectionupdate.php");
$link = $link.YPGMSTDPARMS();
XLINKTXT($link,"make further changes to the knowledgebase structure");


Back_Navigator();
PageFooter("Default","Final");

function YACCORDIONCONTAINER () {
    $htmlstr = "";
    $htmlstr = $htmlstr.'<div class="row">'."\n";
    $htmlstr = $htmlstr.'<div class="col-lg-12">'."\n";
    $htmlstr = $htmlstr.'<div class="panel-group" id="accordion">'."\n";
    return $htmlstr;   
}
function Y_ACCORDIONCONTAINER () {
    $htmlstr = "";
    $htmlstr = $htmlstr.'</div>'."\n";
    $htmlstr = $htmlstr.'</div>'."\n";
    $htmlstr = $htmlstr.'</div>'."\n";
    return $htmlstr;   
}
function YACCORDIONSECTION ($ref,$title) {
    $htmlstr = "";
    $htmlstr = $htmlstr.'<div class="panel panel-default">'."\n";
    $htmlstr = $htmlstr.'<div class="panel-heading">'."\n";
    $htmlstr = $htmlstr.'<h4 class="panel-title">'."\n";
    $htmlstr = $htmlstr.'<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#'.$ref.'">'.$title.'</a>'."\n";
    $htmlstr = $htmlstr.'</h4>'."\n";
    $htmlstr = $htmlstr.'</div>'."\n";
    $htmlstr = $htmlstr.'<div id="'.$ref.'" class="panel-collapse collapse">'."\n";
    $htmlstr = $htmlstr.'<div class="panel-body">'."\n";
    return $htmlstr;
}
function Y_ACCORDIONSECTION () {
    $htmlstr = "";
    $htmlstr = $htmlstr.'</div>'."\n";
    $htmlstr = $htmlstr.'</div>'."\n";
    $htmlstr = $htmlstr.'</div>'."\n";
    return $htmlstr;
}
function YACCORDIONITEM ($ref,$title) {
    $htmlstr = "";
    $htmlstr = $htmlstr.'<a href="'.$GLOBALS{'domainwwwurl'}.'/Help-'.$ref.'.html">'."\n";
    $htmlstr = $htmlstr.$title."\n";
    $htmlstr = $htmlstr.'</a><br>'."\n";
    return $htmlstr;
}



?>

