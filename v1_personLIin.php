<?php # personLIin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_pdfroutines.php');
require('FPDF/fpdf.php');

Get_Common_Parameters();
GlobalRoutine();

$informat = $_REQUEST['Format'];
$limode = $_REQUEST['LIMode'];

$selectionarray = array(); 
$tsectionslist = "";
foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","") as $testsection_name) {
 $microselection = ""; $microselection = $_REQUEST['MicroSECTION'.$testsection_name];
 if ($microselection == $testsection_name) {$tsectionslist = $tsectionslist.$testsection_name.",";}
} 
array_push($selectionarray, $tsectionslist." section(s)");
foreach (Get_Array_Hash_SortSelect("persontype",$GLOBALS{'currperiodid'},"persontype_seq","","") as $testpersontype_code) {
 Get_Data_Hash("persontype",$GLOBALS{'currperiodid'},$testpersontype_code);	
 $microselection = ""; $microselection = $_REQUEST['MicroPERSONTYPE'.$testpersontype_code];		
 if ($microselection == $testpersontype_code) {array_push($selectionarray, $GLOBALS{'persontype_name'}); }
}
$microselection = ""; $microselection = $_REQUEST['MicroACTIVEplayer'];	
if ($microselection == "player") {array_push($selectionarray, "Active Players");}
$microselection = ""; $microselection = $_REQUEST['MicroACTIVEofficial'];	
if ($microselection == "official") {array_push($selectionarray, "Active Officials");}
for ($imexd = 0; $imexd < 10; $imexd++) {
 Get_Data_Hash("personextradef",$imexd);
 if ($GLOBALS{'$personextradef_syntax'} == "Checkbox") {
  $microselection = ""; $microselection = $_REQUEST['MicroEXTRA'.$imexd];
  if ($microselection != "") {array_push($selectionarray, $GLOBALS{'$personextradef_name'});}
 }
 if ($GLOBALS{'$personextradef_syntax'} == "SelectFromList") {
  $codevaluearray = explode(',', $GLOBALS{'$personextradef_codevalues'});
  foreach ($codevaluearray as $codevalue) {
   $microselection = ""; $microselection = $_REQUEST['MicroEXTRA'.$imexd.$codevalue];
   if ($microselection != "") {array_push($selectionarray, $GLOBALS{'$personextradef_name'});}
  } 
 }   
}

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();
Get_Person_Authority();

$personslistarray0 = array();
$persona = Get_Array('person'); 
foreach ($persona as $tperson_id) {
 Get_Data("person",$tperson_id);
 if (Person_Visibility_Test("view") == true) {
  $marrayelement0 = $GLOBALS{'person_sname'}."             ".$GLOBALS{'person_fname'}."#".$tperson_id;
  array_push($personslistarray0, $marrayelement0);
 }
}
$tglobalsectionsarray = Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","");
sort($personslistarray0);
$personslistarray = array();
foreach ($personslistarray0 as $marrayelement0) {
 $bits = explode('#',$marrayelement0);
 $tperson_id = $bits[1];
 Get_Data("person",$tperson_id);
 $basicselectperson = "0";
 foreach (Get_Array_Hash("section",$GLOBALS{'currperiodid'}) as $testsection_name) {
  $microselection = "";	
  $microselection = $_REQUEST['MicroSECTION'.$testsection_name];
  $tperson_sections = explode(',',$GLOBALS{'person_section'});
  foreach ($tperson_sections as $tperson_section) {  
   if (($microselection == $tperson_section)&&($tperson_section != "")) { $basicselectperson = "1"; }
  }
 }
 if ($limode == "Advanced") {
  $advancedselectperson = "0";
  foreach (Get_Array_Hash("persontype",$GLOBALS{'currperiodid'}) as $testpersontype_code) {
   $microselection = ""; $microselection = $_REQUEST['MicroPERSONTYPE'.$testpersontype_code];
   if (($GLOBALS{'person_type'} == $microselection)&&($GLOBALS{'person_type'} != "")) { $advancedselectperson = "1"; }  
  }
  $microselection = ""; $microselection = $_REQUEST['MicroACTIVEplayer'];
  if ($microselection == "player") { 
  	if ($GLOBALS{'person_activeplayer'} == "Yes") { $advancedselectperson = "1"; }
  }
  $microselection = ""; $microselection = $_REQUEST['MicroACTIVEofficial'];
  if ($microselection == "official") { 
  	if ($GLOBALS{'person_activeofficial'} == "Yes") { $advancedselectperson = "1"; }
  }
  for ($imexd = 0; $imexd < 10; $imexd++) {
   $person_extra_seq = "person_extra".$imexd;  	
   Get_Data_Hash('personextradef',$imexd);
   if ($GLOBALS{'personextradef_syntax'} == "Checkbox") {      
    $microselection = ""; $microselection = $_REQUEST['MicroEXTRA$imexd'];
    if ($microselection != "") {    	
     if ($GLOBALS{$person_extra_seq} == "Yes") { $advancedselectperson = "1"; }
    }
   }
   if ($GLOBALS{'personextradef_syntax'} == "SelectFromList") {
    $codevaluearray = explode (',', $GLOBALS{'personextradef_codevalues'});      
    foreach ($codevaluearray as $codevalue) {    	
     $microselection = ""; $microselection = $_REQUEST['MicroEXTRA'.$imexd.$codevalue];
     if ($microselection != "") {
      $mbits = exp-lode(',', $GLOBALS{$person_extra_seq});
      foreach ($mbits as $mbit) {    	
       if (($mbit == $microselection)&&($GLOBALS{$person_extra_seq} != "")) { $advancedselectperson = "1"; }
      }
     }
    } 
   }  
  }
 }

 $excludeperson = "0";
 if ($GLOBALS{'person_exdirectory'} == "0") { $excludeperson = "1"; }
 if (($informat == "Label")&&($GLOBALS{'person_exdirectory'} < "3")) { $excludeperson = "1"; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#"))>0)  { $excludeperson = "0"; }
 $selectperson = "0";
 if ($basicselectperson == "1") {
   if (($limode == "Advanced")&&($advancedselectperson == "1")) {$selectperson = "1";}
   if ($limode !== "Advanced") {$selectperson = "1";}   
 } 
 if (($selectperson == "1") && ($excludeperson == "0")) {
   array_push($personslistarray, $tperson_id);
 }
}
if ($informat == "List") {ML_Processing($personslistarray,$selectionarray);}
if ($informat == "Label") {LA_Processing($personslistarray,$selectionarray);}
if ($informat == "DistList") {DL_Processing($personslistarray,$selectionarray);}
if ($informat == "IdList") {ID_Processing($personslistarray,$selectionarray);}
if ($informat == "MailChimpList") {MC_Processing($personslistarray,$selectionarray);}

# ------------------------------ People List Routines -----------------------------------
function ML_Processing ($personslistarray,$selectionarray) {
	PDFOPEN ("L", "pt", "A4");

	PTXTSTYLE ("Arial", "", "12", "black");
	foreach ($personslistarray as $tperson_id) {
		Get_Data("person",$tperson_id);
		PTXT (Hello", 0, 12, "L"")''
		
		
	}




}

function ML_ProcessingOld ($personslistarray,$selectionarray) {
$tabpixfactor = 15;
$maxlinecounter = 50;
# PDFOPEN("A","B","C","D");
PDFOPEN ("L", "pt", "A4");
PTXTSTYLE ("Helvetica", "", 15, "black");
ML_PrintFrontPageOld();
$ltitle = array(); $ltab = array(); $exdir = array(); 			
$ltitle[0] = "id";       $lfield[0] = 'person_id';         $ltab[0] = "7";   $exdir[0] = "-1";
$ltitle[1] = "title";    $lfield[1] = 'person_title';      $ltab[1] = "5";   $exdir[1] = "-1";
$ltitle[2] = "surname";  $lfield[2] = 'person_sname';      $ltab[2] = "15";  $exdir[2] = "-1";
$ltitle[3] = "fname";    $lfield[3] = 'person_fname';      $ltab[3] = "12";  $exdir[3] = "-1";
$ltitle[4] = "addr1";    $lfield[4] = 'person_addr1';      $ltab[4] = "25";  $exdir[4] = "2";
$ltitle[5] = "addr2";    $lfield[5] = 'person_addr2';      $ltab[5] = "18";  $exdir[5] = "2";
$ltitle[6] = "addr3";    $lfield[6] = 'person_addr3';      $ltab[6] = "14";  $exdir[6] = "2";
$ltitle[7] = "addr4";    $lfield[7] = 'person_addr4';      $ltab[7] = "14";  $exdir[7] = "2";
$ltitle[8] = "postcode"; $lfield[8] = 'person_postcode';   $ltab[8] = "10";  $exdir[8] = "2";
$ltitle[9] = "hometel";  $lfield[9] = 'person_hometel';    $ltab[9] = "13";  $exdir[9] = "1";
$ltitle[10] = "worktel"; $lfield[10] = 'person_worktel';   $ltab[10] = "13"; $exdir[10] = "1";
$ltitle[11] = "mobile";  $lfield[11] = 'person_mobiletel'; $ltab[11] = "13"; $exdir[11] = "1";
$ltitle[12] = "email";   $lfield[12] = 'person_email';     $ltab[12] = "45"; $exdir[12] = "0";

ML_PrintHeading();
foreach ($personslistarray as $tperson_id) {
 $outmessage = "";
 Get_Data("person",$tperson_id);
 $GLOBALS{'PDFX'} = $GLOBALS{'PDFX'} = 0;
 $GLOBALS{'PDFY'} = $GLOBALS{'PDFTOPY'} - $GLOBALS{'PDFTXTYDELTA'}; 
 for ($li = 0; $li < 13; $li++) {
  PTXT(ML_Format($li,$GLOBALS{$lfield[$li]}),$GLOBALS{'PDFX'},$GLOBALS{'PDFY'});
  $GLOBALS{'PDFX'} = $GLOBALS{'PDFX'} + ($ltab[12]*$tabpixfactor); 
 }
 PBR();
 $linecounter++;
 if ($linecounter > $maxlinecounter) { ML_PrintFooting(); ML_PrintHeading(); }
}
# print "<BR>- People List Download prepared successfully\n";
P_PAGE();
PDFOUTPUT();
PDFFINALISE("report.pdf");
}

function ML_Format ($parm0,$parm1) {
	global $ltitle, $lfield, $ltab, $exdir;
	$bits = str_split($parm1);
	$lstring = "";
	if ($GLOBALS{'person_exdirectory'} > "3") {
		$GLOBALS{'person_exdirectory'} = "3";
	}
	if ($GLOBALS{'person_exdirectory'} < "0") {
		$GLOBALS{'person_exdirectory'} = "3";
	}
	if (($GLOBALS{'person_exdirectory'} > $exdir[$parm0])||(strlen(strstr($GLOBALS{'person_authority'},"MM#"))>0)) {
		$bits = str_split($parm1);
	}
	else {$bits = str_split(".........................................................................");
	}
	$bitcounter = 0;
	foreach ($bits as $bit) {
		if ($bitcounter < $ltab[$parm0]) {
			$lstring = $lstring.$bit;
		}
		$bitcounter++;
	}
	return $lstring;
}
function ML_PrintFrontPage () {
	global $selectionarray;
	PPAGE("A4","landscape");
	Get_Data("person",$GLOBALS{'LOGIN_person_id'});
	for ($li = 0; $li < 5; $li++) {
		PTXTLINE("");
	}
	PTXTSTYLE ("Times-Roman", 25, "red");
	PTXTLINE("People List");
	PTXTSTYLE ("Helvetica", 10, "blue");
	PTXTLINE($GLOBALS{'dd'}."/".$GLOBALS{'mm'}."/".$GLOBALS{'yy'});
	PTXTLINE("Requested and printed by ".$GLOBALS{'askingperson_fname'}." ".$GLOBALS{'askingperson_sname'});
	PTXTLINE("The requester has authorisation to view to the following information:-");
	$tsectionsarray = Get_Array_Hash_SortSelect('section',$GLOBALS{'currperiodid'},"section_seq","","");
	foreach ($tsectionsarray as $tsection_name) {
		PTXTLINE("  - $tsection_name section");
	}
	PTXTLINE("");
	PTXTLINE("Selection criteria for this list.");
	foreach ($selectionarray as $selectionelement) {
		PTXTLINE("  - $selectionelement");
	}
	PTXTLINE("");
	PTXTLINE("Ex-directory information is denoted by ......");
	$linecounter = 0;
	PTXTSTYLE ("Times-Roman", 25, "red");
	PTXT("ABCDEFGHIJK",10,30);

	P_PAGE();
}

function ML_PrintHeading () {
	global $ltitle, $lfield, $ltab, $exdir;
	PPAGE("A4","landscape");
	$GLOBALS{'PDFY'} = $GLOBALS{'PDFY'} - $GLOBALS{'PDFTXTYDELTA'};
	for ($li = 0; $li < 13; $li++) {
		PTXT(ML_Format($li,$GLOBALS{$ltitle[$li]}),$GLOBALS{'PDFX'},$GLOBALS{'PDFY'});
		$GLOBALS{'PDFX'} = $GLOBALS{'PDFX'} + ($ltab[12]*$tabpixfactor);
	}
	PBR();
	$linecounter = 0;
}
function ML_PrintFooting () {
	global $ltitle, $lfield, $ltab, $exdir;
	P_PAGE();
}



# ML_PrintHeadingOld();
# foreach ($personslistarray as $tperson_id) {
#	$outmessage = "";
#	Get_Data("person",$tperson_id);
#	$GLOBALS{'PDFX'} = $GLOBALS{'PDFX'} = 0;
#	$GLOBALS{'PDFY'} = $GLOBALS{'PDFTOPY'} - $GLOBALS{'PDFTXTYDELTA'};
#	for ($li = 0; $li < 13; $li++) {
#		PTXT(ML_FormatOld($li,$GLOBALS{$lfield[$li]}),$GLOBALS{'PDFX'},$GLOBALS{'PDFY'});
#		$GLOBALS{'PDFX'} = $GLOBALS{'PDFX'} + ($ltab[12]*$tabpixfactor);
#	}
#	PBR();
#	$linecounter++;
#	if ($linecounter > $maxlinecounter) {
#		ML_PrintFootingOld(); ML_PrintHeadingOld();
#	}
# }
# print "<BR>- People List Download prepared successfully\n";
# P_PAGE();
# PDFCLOSE();
# PDFFINALISE("report.pdf");
#}

function ML_FormatOld ($parm0,$parm1) {
global $ltitle, $lfield, $ltab, $exdir;
$bits = str_split($parm1); 
$lstring = "";
if ($GLOBALS{'person_exdirectory'} > "3") {$GLOBALS{'person_exdirectory'} = "3";}
if ($GLOBALS{'person_exdirectory'} < "0") {$GLOBALS{'person_exdirectory'} = "3";}
if (($GLOBALS{'person_exdirectory'} > $exdir[$parm0])||(strlen(strstr($GLOBALS{'person_authority'},"MM#"))>0)) { $bits = str_split($parm1); }
else {$bits = str_split(".........................................................................");}
$bitcounter = 0;
foreach ($bits as $bit) {
 if ($bitcounter < $ltab[$parm0]) { $lstring = $lstring.$bit; }
 $bitcounter++; 
}
return $lstring;
}
function ML_PrintFrontPageOld () {
global $selectionarray;	
PPAGE("A4","landscape");	
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
for ($li = 0; $li < 5; $li++) {
   PTXTLINE("");
}
PTXTSTYLE ("Times-Roman", 25, "red");
PTXTLINE("People List");
PTXTSTYLE ("Helvetica", 10, "blue");
PTXTLINE($GLOBALS{'dd'}."/".$GLOBALS{'mm'}."/".$GLOBALS{'yy'});
PTXTLINE("Requested and printed by ".$GLOBALS{'askingperson_fname'}." ".$GLOBALS{'askingperson_sname'});
PTXTLINE("The requester has authorisation to view to the following information:-");
$tsectionsarray = Get_Array_Hash_SortSelect('section',$GLOBALS{'currperiodid'},"section_seq","","");
foreach ($tsectionsarray as $tsection_name) {
 PTXTLINE("  - $tsection_name section");
}
PTXTLINE("");
PTXTLINE("Selection criteria for this list.");
foreach ($selectionarray as $selectionelement) {
 PTXTLINE("  - $selectionelement");
} 
PTXTLINE("");
PTXTLINE("Ex-directory information is denoted by ......");
$linecounter = 0;
PTXTSTYLE ("Times-Roman", 25, "red");
PTXT("ABCDEFGHIJK",10,30);

P_PAGE();
}

function ML_PrintHeadingOld () {
global $ltitle, $lfield, $ltab, $exdir;		
PPAGE("A4","landscape");		
$GLOBALS{'PDFY'} = $GLOBALS{'PDFY'} - $GLOBALS{'PDFTXTYDELTA'}; 
for ($li = 0; $li < 13; $li++) {
 PTXT(ML_Format($li,$GLOBALS{$ltitle[$li]}),$GLOBALS{'PDFX'},$GLOBALS{'PDFY'});
 $GLOBALS{'PDFX'} = $GLOBALS{'PDFX'} + ($ltab[12]*$tabpixfactor); 
}
PBR();
$linecounter = 0;
}
function ML_PrintFootingOld () {
global $ltitle, $lfield, $ltab, $exdir;	
P_PAGE();
}

/*
#------------------------------ Label Print Routines -----------------------------------
function LA_Processing ($personslistarray,$selectionarray){
&LA_Cleanup;
$labelrowsperpage = 8;
$labellinesperrow = 8;
$linecounter = 0;
$maxlinecounter = ($labelrowsperpage * $labellinesperrow) - 7;
$ltab[0] = "70";$ltab[1] = "100";
$QBQ = chr(92); " " = chr(92)."tab "; $QBQpar = chr(92)."par ";
$tabtwipfactor = 80;
$GLOBALS{'IOERRORcode'} = "MLD010";
$downloadfilename = "$GLOBALS{'site_filepath'}/$GLOBALS{'LOGIN_domain_id'}/labelprint_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".rtf";
$GLOBALS{'IOERRORmessage'} = "$downloadfilename - unable to be created";
open (DOWNLOAD, ">$downloadfilename") || &ErrorRoutine;
$outmessage = '{\rtf1\ansi\ansicpg1252\deff0\deflang2057{\fonttbl{\f0\fswiss\fprq2\fcharset0 Arial Narrow;}{\f1\fnil\fcharset0 Arial Narrow;}}';
print DOWNLOAD "$outmessage\n";
$outmessage = '{\colortbl ;\red40\green100\blue255;}';
print DOWNLOAD "$outmessage\n";
$outmessage = '{\*\generator Clubmaster}';
print DOWNLOAD "$outmessage\n";
$outmessage = '\paperw11907\paperh16840\margl1200\margr1200\margt800\margb800\headery0\footery0';
print DOWNLOAD "$outmessage\n";
$outmessage = '\viewkind4\uc1\pard';
$outmessage = "";
$twip = 0;
for ($li = 0; $li < 2; $li++) {
 $twip = $twip + ($ltab[$li]*$tabtwipfactor);
 $outmessage = $outmessage.$QBQ."tx".$twip;
}
print DOWNLOAD "$outmessage\n";
&LA_PrintHeading;
unshift($personslistarray,"selection");
$personslistindex = 0; $personslistindexmax = $#personslistarray;
$morelabels = "1";
while ($morelabels == "1") {
 $labelarrayA =();$labelarrayB =();
 if ($personslistindex <= $personslistindexmax) {
  $tperson_id = $personslistarray[$personslistindex];
  if ($tperson_id == "selection") {
    $selectionarrayext = ("","","","","","",""); $selectionarray=($selectionarray,$selectionarrayext);
    array_push($labelarrayA,"------ selection criteria ------"); 	
    array_push($labelarrayA,$selectionarray[0]); 	
    array_push($labelarrayA,$selectionarray[1]); 	
    array_push($labelarrayA,$selectionarray[2]); 	    
    array_push($labelarrayA,$selectionarray[3]); 	
    array_push($labelarrayA,$selectionarray[4]); 	    
  } else {
   &Check_Data("person",$tperson_id);
   if ($GLOBALS{'IOWARNING'} == "0") {
    array_push($labelarrayA,$GLOBALS{'person_title'}." ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}); 	
    if ($GLOBALS{'person_addr1'} != "") {array_push($labelarrayA,$GLOBALS{'person_addr1'})};
    if ($GLOBALS{'person_addr2'} != "") {array_push($labelarrayA,$GLOBALS{'person_addr2'})};  
    if ($GLOBALS{'person_addr3'} != "") {array_push($labelarrayA,$GLOBALS{'person_addr3'})};     	
    if ($GLOBALS{'person_addr4'} != "") {array_push($labelarrayA,$GLOBALS{'person_addr4'})};
    if ($GLOBALS{'person_postcode'} != "") {array_push($labelarrayA,$GLOBALS{'person_postcode'})};     	
   }
  }  
 } else {$morelabels = "0";}
 $personslistindex++;
 if ($personslistindex <= $personslistindexmax) {
  $tperson_id = $personslistarray[$personslistindex];
  
  if ($GLOBALS{'IOWARNING'} == "0") {
   array_push($labelarrayB,$GLOBALS{'person_title'}." ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}); 	
   if ($GLOBALS{'person_addr1'} != "") {array_push($labelarrayB,$GLOBALS{'person_addr1'})};
   if ($GLOBALS{'person_addr2'} != "") {array_push($labelarrayB,$GLOBALS{'person_addr2'})};  
   if ($GLOBALS{'person_addr3'} != "") {array_push($labelarrayB,$GLOBALS{'person_addr3'})};    	
   if ($GLOBALS{'person_addr4'} != "") {array_push($labelarrayB,$GLOBALS{'person_addr4'})};
   if ($GLOBALS{'person_postcode'} != "") {array_push($labelarrayB,$GLOBALS{'person_postcode'})};   
  }  
 } else {$morelabels = "0";}
 $personslistindex++; 

 $outmessage = "";
 $outmessage = $outmessage.$labelarrayA[0]." ";
 $outmessage = $outmessage.$labelarrayB[0]." ";
 print DOWNLOAD "$outmessage\n";
 $outmessage = '\par';print DOWNLOAD "$outmessage\n";
 $outmessage = ""; 
 $outmessage = $outmessage.$labelarrayA[1]." ";
 $outmessage = $outmessage.$labelarrayB[1]." ";
 print DOWNLOAD "$outmessage\n";
 $outmessage = '\par';print DOWNLOAD "$outmessage\n";
 $outmessage = "";  
 $outmessage = $outmessage.$labelarrayA[2]." ";
 $outmessage = $outmessage.$labelarrayB[2]." ";
 print DOWNLOAD "$outmessage\n";
 $outmessage = '\par';print DOWNLOAD "$outmessage\n";
 $outmessage = "";  
 $outmessage = $outmessage.$labelarrayA[3]." ";
 $outmessage = $outmessage.$labelarrayB[3]." ";
 print DOWNLOAD "$outmessage\n";
 $outmessage = '\par';print DOWNLOAD "$outmessage\n";
 $outmessage = "";  
 $outmessage = $outmessage.$labelarrayA[4]." ";
 $outmessage = $outmessage.$labelarrayB[4]." ";
 print DOWNLOAD "$outmessage\n";
 $outmessage = '\par';print DOWNLOAD "$outmessage\n";
 $outmessage = "";  
 $outmessage = $outmessage.$labelarrayA[5]." ";
 $outmessage = $outmessage.$labelarrayB[5]." ";
 print DOWNLOAD "$outmessage\n";
 $linecounter = $linecounter + $labellinesperrow;
 if ($linecounter > $maxlinecounter) { &LA_PrintFooting; &LA_PrintHeading;  }
 else {
  $outmessage = '\par';print DOWNLOAD "$outmessage\n";
  $outmessage = '\par';print DOWNLOAD "$outmessage\n"; 
  $outmessage = '\par';print DOWNLOAD "$outmessage\n";   
 }
}
$outmessage = "}";
print DOWNLOAD "$outmessage\n";
# print "<BR>- People List Download prepared successfully\n";
close (DOWNLOAD);
&Download_File("$downloadfilename","delete");
}
function LA_PrintHeading {
$outmessage = '\cf1\b\f1\fs21 ';
print DOWNLOAD "$outmessage\n";
# $outmessage = "";
# print DOWNLOAD "$outmessage\n"; 
$outmessage = $QBQ."cf0".$QBQ."b0".$QBQ."f1".$QBQ."par";
print DOWNLOAD "$outmessage\n";
$linecounter = 0;
}
function LA_PrintFooting {
$outmessage = '\page';
print DOWNLOAD "$outmessage\n";
}
function LA_Cleanup {
$mldirfiles = Get_Dir("ML002a","$GLOBALS{'site_filepath'}/$GLOBALS{'LOGIN_domain_id'}");
foreach $tryfile ($mldirfiles) {
  $fullfile = $tryfile;
  &File_Root_Type;
  if ($fileroot =~ m/labelprint_"))>0) { 
    if ($GLOBALS{'site_readonly'} == "OFF") {
      $dfile = "$GLOBALS{'site_filepath'}/$GLOBALS{'LOGIN_domain_id'}/".$tryfile;
      unlink($dfile) || &SilentWarningRoutine; 	
    }
  }  
}  
}
*/

#------------------------------ Distribution List Routines -----------------------------------
function DL_Processing ($personslistarray,$selectionarray) {
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$distlisttext = ""; $errordistlisttext = "";$pcounter = 0; 
foreach ($personslistarray as $tperson_id) {
 Check_Data("person",$tperson_id);
 if ($GLOBALS{'IOWARNING'} == "0") {
  if ($GLOBALS{'person_email1'} != "") {
   $emailblanks = explode(' ', $GLOBALS{'person_email1'});
   $emailats = explode('@', $GLOBALS{'person_email1'});	
   if ((sizeof($emailblanks) == 1)&&(sizeof($emailats) == 2)) {	
    $distlisttext = $distlisttext.$GLOBALS{'person_email1'}.", ";
    $pcounter++;     
   } else {
    $errordistlisttext = $errordistlisttext.$GLOBALS{'person_email1'}.", ";
   }
  }
 } 
}
XH3("Distribution list");
XH4("Selection criteria for this list.");
foreach ($selectionarray as $selectionelement) {
 XTXT(" - $selectionelement");XBR();
} 
XH4("Cut and Paste the following distribution list into your email");
XTABLE();XTR();XTDFIXED("600");
XTXT($distlisttext);
X_TD();X_TR();X_TABLE();
XBR();XTXT("There are $pcounter emails in this list");
XH4("The following invalid emails were skipped");
XTABLE();XTR();XTDFIXED("600");
XTXT($errordistlisttext);
X_TD();X_TR();X_TABLE();
Back_Navigator();
PageFooter("Default","Final");
}

#------------------------------ Id List Routines -----------------------------------
function ID_Processing ($personslistarray,$selectionarray) {
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$distlisttext = ""; $errordistlisttext = "";$pcounter = 0; 
foreach ($personslistarray as $tperson_id) {
 Check_Data("person",$tperson_id);
 if ($GLOBALS{'IOWARNING'} == "0") { 
  $distlisttext = $distlisttext.$tperson_id.", "; 
  $pcounter++; 
 } 
}
XH3("Personal Id list");
XH4("Selection criteria for this list.");
foreach ($selectionarray as $selectionelement) {
 XTXT(" - $selectionelement");XBR();
} 
XH4("Cut and Paste the following distribution list as required");
XTABLE();XTR();XTDFIXED("600");
XTXT($distlisttext);
X_TD();X_TR();X_TABLE();
XBR();XTXT("There are $pcounter ids in this list");
Back_Navigator();
PageFooter("Default","Final");
}

# ------------------------------ MailChimp List Routines -----------------------------------
function MC_Processing ($personslistarray,$selectionarray) {
	MC_Cleanup();
	$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/mailchimplist_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
	$filehandle = Open_File_Write ($downloadfilename);
	foreach ($personslistarray as $tperson_id) {
		Get_Data("person",$tperson_id);
		if ($GLOBALS{'person_email1'} != "") {
			$outmessage = '"'.$GLOBALS{'person_email1'}.'","'.$GLOBALS{'person_fname'}.'","'.$GLOBALS{'person_sname'}.'","'.$GLOBALS{'person_section'}.'"';
			Write_File ($filehandle, "$outmessage");
		}
	}
	# print "<BR>- People List Download prepared successfully\n";
	Close_File ($filehandle);
	Download_File ($downloadfilename,"keep");
}

function MC_Cleanup () {
$mcdirfiles = Get_Directory_Array ($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'});
foreach ($mcdirfiles as $fullfile) {	
	if (strlen(strstr($fullfile,'mailchimplist_'))>0) {		
		if ($GLOBALS{'site_readonly'} == "OFF") {
			$dfile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$fullfile;
			Delete_File ($dfile);
		}
	}
}
}