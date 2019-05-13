<?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');

Get_Common_Parameters();
GlobalRoutine();
Setup_LIBRARYSECTION_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$injson_output = $_REQUEST['json_output'];
// XPTXT($injson_output);

/*
$librarysectiona = Get_Array('librarysection');
foreach ($librarysectiona as $librarysection_id) {
    Get_Data("librarysection",$librarysection_id);
    Write_Data("librarysection",$librarysection_id."BAK");
    Delete_Data("librarysection",$librarysection_id);
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
            if ( $kbits[0] == 'security' ) { $security = $kbits[1]; }
            if ( $kbits[0] == 'hide' ) { $hide = $kbits[1]; }
            if ( $kbits[0] == 'title' ) { $title = $kbits[1]; }
            if ( $kbits[0] == 'librarysectionid' ) { $librarysectionid = $kbits[1]; }
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
            $GLOBALS{'librarysection_title'} = $title;
            $GLOBALS{'librarysection_hide'} = $hide;
            $GLOBALS{'librarysection_sequence'} = $seq;
            $GLOBALS{'librarysection_security'} = $security; 
            // XPTXT("Write_Data ".$librarysectionid." ".$title);
            Write_Data("librarysection",$librarysectionid);
            
            if ($level == 1) { $level1seqn++; }
            if ($level == 2) { $level2seqn++; }
            if ($level == 3) { $level3seqn++; }
            if ($level == 4) { $level4seqn++; }
            if ($level == 5) { $level5seqn++; }
        } else {
            Check_Data("librarysection",$librarysectionid);
            if ($GLOBALS{'IOWARNING'} == "0") {
                // XPTXT("Delete_Data ".$librarysectionid." ".$title);
                Delete_Data("librarysection",$librarysectionid);
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

XPTXTCOLOR("Library Structure updated","green");

Setup_LIBRARYSECTION_Output();

XBR();
$link = YPGMLINK("librarysectionupdate.php");
$link = $link.YPGMSTDPARMS();
XLINKTXT($link,"make further changes to the library structure");


Back_Navigator();
PageFooter("Default","Final");

?>

