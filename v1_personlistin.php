<<<<<<< HEAD
<?php # personLIin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('MPDF/mpdf.php');

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

	$ltitle = array(); $ltab = array(); $exdir = array(); 			
	$ltitle[1] = "title";    $lfield[1] = 'person_title';      $lwidth[1] = "5";   $exdir[1] = "-1";
	$ltitle[2] = "surname";  $lfield[2] = 'person_sname';      $lwidth[2] = "15";  $exdir[2] = "-1";
	$ltitle[3] = "fname";    $lfield[3] = 'person_fname';      $lwidth[3] = "12";  $exdir[3] = "-1";
	$ltitle[4] = "addr1";    $lfield[4] = 'person_addr1';      $lwidth[4] = "25";  $exdir[4] = "2";
	$ltitle[5] = "addr2";    $lfield[5] = 'person_addr2';      $lwidth[5] = "18";  $exdir[5] = "2";
	$ltitle[6] = "addr3";    $lfield[6] = 'person_addr3';      $lwidth[6] = "14";  $exdir[6] = "2";
	$ltitle[7] = "addr4";    $lfield[7] = 'person_addr4';      $lwidth[7] = "14";  $exdir[7] = "2";
	$ltitle[8] = "postcode"; $lfield[8] = 'person_postcode';   $lwidth[8] = "10";  $exdir[8] = "2";
	$ltitle[9] = "hometel";  $lfield[9] = 'person_hometel';    $lwidth[9] = "13";  $exdir[9] = "1";
	$ltitle[10] = "worktel"; $lfield[10] = 'person_worktel';   $lwidth[10] = "13"; $exdir[10] = "1";
	$ltitle[11] = "mobile";  $lfield[11] = 'person_mobiletel'; $lwidth[11] = "13"; $exdir[11] = "1";
	$ltitle[12] = "email";   $lfield[12] = 'person_email1';     $lwidth[12] = "45"; $exdir[12] = "0";	
	
	$headerhtml = YTR();
	for ($li = 1; $li < 13; $li++) {
		$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR($ltitle[$li],"Navy");
	}
	$headerhtml = $headerhtml.Y_TR();	

	$reporthtml = "";
	$reporthtml = $reporthtml.ML_PrintFrontPage($selectionarray);
	
	$pagecountmax = 35;
	$pagecount = 999;
	foreach ( $personslistarray as $person_id) {
		Get_Data( 'person', $person_id );
		$pagecount++;
		if ($pagecount > $pagecountmax) {
			if ($pagecount != 1000) {
				$reporthtml = $reporthtml.'</table>';
			}
			$pagecount = 0;
			$reporthtml = $reporthtml."<pagebreak />";
			$reporthtml = $reporthtml.'<table border="0">';			
			$reporthtml = $reporthtml.$headerhtml;
		}
		$reporthtml = $reporthtml.YTR();
		for ($li = 1; $li < 13; $li++) {
		  if ($ltitle[$li] == "email") {
		  	$fieldval = GetPersonEmail();
		  } else {
		  	$fieldval = $GLOBALS{$lfield[$li]};		  	
		  }
		  $reporthtml = $reporthtml.YTDTXT(ML_Format( $GLOBALS{$lfield[$li]}, $lwidth[$li], $exdir[$li])); 		  
		}
		$reporthtml = $reporthtml.Y_TR();
	}
	$reporthtml = $reporthtml.Y_TABLE();
	
	$mpdf = new mPDF(
	'',    // mode - default ''
	'A4-L',  // format - A4, for example, default ''
	8,     // font size - default 0
	'Helvetica',    // font family
	10,    // margin_left
	10,    // margin right
	10,    // margin top
	10,    // margin bottom
	20,     // margin header
	9,     // margin footer
	'L');  // L - landscape, P - portrait

	$reporthtml = mb_convert_encoding($reporthtml, 'UTF-8', 'UTF-8'); // trick to avoid issue with non UTF-8 characters
	$mpdf->WriteHTML($reporthtml);
	$mpdf->Output();
}

function ML_Format ($fieldvalue, $width, $exdir) {
	$bits = str_split($fieldvalue);
	$lstring = "";
	if ($GLOBALS{'person_exdirectory'} > "3") {
		$GLOBALS{'person_exdirectory'} = "3";
	}
	if ($GLOBALS{'person_exdirectory'} < "0") {
		$GLOBALS{'person_exdirectory'} = "3";
	}
	if (($GLOBALS{'person_exdirectory'} > $exdir)||(strlen(strstr($GLOBALS{'person_authority'},"MM#"))>0)) {
		$bits = str_split($fieldvalue);
	}
	else {$bits = str_split(".........................................................................");
	}
	$bitcounter = 0;
	foreach ($bits as $bit) {
		if ($bitcounter < $width) {
			$lstring = $lstring.$bit;
		}
		$bitcounter++;
	}
	return $lstring;
}

function ML_PrintFrontPage ($selectionarray) {
	$frontpagehtml = "";
	Get_Data("person",$GLOBALS{'LOGIN_person_id'});
	for ($li = 0; $li < 5; $li++) {
		$frontpagehtml = $frontpagehtml.YBR();
	}
	$frontpagehtml = $frontpagehtml.YTXTCOLOR("<b>"."Membership List - ".$GLOBALS{'domain_longname'}."</b>","Navy");
	$frontpagehtml = $frontpagehtml.YPTXT($GLOBALS{'dd'}."/".$GLOBALS{'mm'}."/".$GLOBALS{'yy'});
	$frontpagehtml = $frontpagehtml.YPTXT("Requested and printed by ".$GLOBALS{'askingperson_fname'}." ".$GLOBALS{'askingperson_sname'});
	$frontpagehtml = $frontpagehtml.YPTXT("The requester has authorisation to view to the following information:-");
	$tsectionsarray = Get_Array_Hash_SortSelect('section',$GLOBALS{'currperiodid'},"section_seq","","");
	foreach ($tsectionsarray as $tsection_name) {
		$frontpagehtml = $frontpagehtml.YTXT("  - ".$tsection_name." section").YBR();
	}
	$frontpagehtml = $frontpagehtml.YPTXT("");
	$frontpagehtml = $frontpagehtml.YPTXT("Selection criteria for this list.");
	foreach ($selectionarray as $selectionelement) {
		$frontpagehtml = $frontpagehtml.YPTXT("  - $selectionelement");
	}
	$frontpagehtml = $frontpagehtml.YPTXT("");
	$frontpagehtml = $frontpagehtml.YPTXT("Ex-directory information is denoted by ......");
	return $frontpagehtml;
}

#------------------------------ Label Print Routines -----------------------------------
function LA_Processing ($personslistarray,$selectionarray){

	$labeltype = $_REQUEST['LabelType'];
	$labelrowsperpage = 8;
	$labelcolsperpage = 2;
	$labellinesperrow = 8;
	$labellinestop = 2;	// fine tuning to centre lable vertically 
	$labelspacesleft = 4;	// fine tuning to centre lable horizontally 	
	$page_format = 'A4';
	$font_size = '11.6';		
	$margin_left = '15';
	$margin_right = '0';		
	$margin_top = '10';
	$margin_bottom = '0';
	
	if ( $labeltype == "8x2" ) { // A4 Avery L7162 - 16 per page)
		$labelrowsperpage = 8;
		$labelcolsperpage = 2;
		$labellinesperrow = 8;
		$labellinestop = 1;
		$labelspacesleft = 5;		
		$page_format = 'A4';
		$font_size = '11.6';		
		$margin_left = '14';
		$margin_right = '0';		
		$margin_top = '10';
		$margin_bottom = '0';
	}

	if ( $labeltype == "6x3" ) {
		// A4 Avery L7162 - 16 per page)
		$labelrowsperpage = 6;
		$labelcolsperpage = 3;
		$labellinesperrow = 11;
		$labellinestop = 2;
		$labelspacesleft = 4;				
		$page_format = 'A4';
		$font_size = '11.7';
		$margin_left = '10';
		$margin_right = '0';
		$margin_top = '8';
		$margin_bottom = '0';
	}	
	
	$labelrowcount = 999;
	$reporthtml = "";		
	$labelarray =Array();
	$hcs = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; // horizontal correction string
	
	$personslistindex = 0; $personslistindexmax = sizeof($personslistarray);
	$morelabels = "1";
	while ($morelabels == "1") {
		for ($ci = 0; $ci < $labelcolsperpage; $ci++) {
			for ($li = 0; $li < $labellinesperrow; $li++) {
				$labelarray[$ci][$li] = "";	
			}
		}
		
		for ($ci = 0; $ci < $labelcolsperpage; $ci++) {
			if ($personslistindex <= $personslistindexmax) {
				$tperson_id = $personslistarray[$personslistindex];
				if ($tperson_id == "selection") {
				    $selectionarrayext = Array("","","","","","",""); $selectionarray=array_merge($selectionarray,$selectionarrayext);
				    $li = 0;
				    for ($lti = 0; $lti < $labellinestop; $lti++) {
				    	$labelarray[$ci][$li] = "";
				    	$li++;
				    }
				    $labelarray[$ci][$li] = "------ selection criteria ------"; 	
				    $labelarray[$ci][$li] = $selectionarray[0];$li++; 	
				    $labelarrayA[$ci][$li] = $selectionarray[1]; $li++; 	
				    $labelarrayA[$ci][$li] = $selectionarray[2]; $li++;	    
				    $labelarrayA[$ci][$li] = $selectionarray[3]; $li++;	
				    $labelarrayA[$ci][$li] = $selectionarray[4]; $li++;	    
				} else {
				   Check_Data("person",$tperson_id);
				   if ($GLOBALS{'IOWARNING'} == "0") {
				   		$li = 0;
				   		for ($lti = 0; $lti < $labellinestop; $lti++) {		   			
				   			$labelarray[$ci][$li] = "";
				   			$li++;
				   		}
					    $labelarray[$ci][$li] = $GLOBALS{'person_title'}." ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}; $li++;	
					    if ($GLOBALS{'person_addr1'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_addr1'}; $li++;}
					    if ($GLOBALS{'person_addr2'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_addr2'}; $li++;} 
					    if ($GLOBALS{'person_addr3'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_addr3'}; $li++;}   	
					    if ($GLOBALS{'person_addr4'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_addr4'}; $li++;}
					    if ($GLOBALS{'person_postcode'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_postcode'}; $li++;}
				   }    	
				}
			} else {
				$morelabels = "0";
			}		
			$personslistindex++;
		}		
		
		$labelrowcount++;
		if ($labelrowcount >= $labelrowsperpage) {
			if ($labelrowcount != 1000) {
				$reporthtml = $reporthtml.'</table>';
				$reporthtml = $reporthtml."<pagebreak />";
			}
			$labelrowcount = 0;
			$reporthtml = $reporthtml.'<table width="100%" style="page-break-inside:avoid" >';			
			$reporthtml = $reporthtml.$headerhtml;
		}
		$reporthtml = $reporthtml.YTR();
		for ($ci = 0; $ci < $labelcolsperpage; $ci++) {
			$thiswidth = 100/$labelcolsperpage;
			$hci = $ci*$labelspacesleft*6;
			$reporthtml = $reporthtml.'<td width="'.$thiswidth.'%"      >';		
			for ($li = 0; $li < $labellinesperrow; $li++) {
			  	$reporthtml = $reporthtml.substr($hcs,0,$hci).YTXT($labelarray[$ci][$li]).YBR(); 		  
			}
			$reporthtml = $reporthtml.Y_TD();
		}
		$reporthtml = $reporthtml.Y_TR();
	}
	$reporthtml = $reporthtml.Y_TABLE();
	
	$mpdf = new mPDF(
	'',    // mode - default ''
	$page_format,  // format - A4, for example, default ''
	$font_size,     // font size - default 0
	'Helvetica',    // font family
	$margin_left,    // margin_left
	$margin_right,    // margin right
	$margin_top,    // margin top
	$margin_bottom,    // margin bottom
	0,     // margin header
	0,     // margin footer
	'P');  // L - landscape, P - portrait

	$reporthtml = mb_convert_encoding($reporthtml, 'UTF-8', 'UTF-8'); // trick to avoid issue with non UTF-8 characters
	$mpdf->WriteHTML($reporthtml);
	$mpdf->Output();
}

#------------------------------ Distribution List Routines -----------------------------------
function DL_Processing ($personslistarray,$selectionarray) {
	
$distlistblock = $_REQUEST['DistListBlock'];
$distlistnewsletterrespect = $_REQUEST['DistListNewsletterRespect'];
if ( $distlistblock == "" ) { $distlistblocknum = 1000; }
else { $distlistblocknum = $distlistblock + 0;}	
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$distlisttexta = Array(); $errordistlisttext = ""; $dontsenddistlisttext = ""; $pcounter = 0; 
$bseq = 0; $bcounter = 0; array_push($distlisttexta,"");
foreach ($personslistarray as $tperson_id) {
 Check_Data("person",$tperson_id);
 if ($GLOBALS{'IOWARNING'} == "0") {
  $personemail = GetPersonEmail();
  if ($personemail != "") {
   $emailats = explode('@', $personemail);	
   if (sizeof($emailats) == 2) {	
	    $distlisttext = $distlisttext.$personemail.", ";
	    if ($bcounter >= $distlistblocknum ) { $bseq++; array_push($distlisttexta,""); $bcounter = 0; }
	    $sendtothisperson = "1";
	    if (($distlistnewsletterrespect == "Yes")&&($GLOBALS{'person_broadcast1'} == "No")) { 
	    	$sendtothisperson = "0";
	    	$dontsenddistlisttext = $dontsenddistlisttext.$personemail.", ";
	    }
	    if ($sendtothisperson == "1") {
		     $distlisttexta[$bseq] = $distlisttexta[$bseq].$GLOBALS{'person_email1'}.", ";
		     $pcounter++; $bcounter++;     
	    }
   } else {
    	$errordistlisttext = $errordistlisttext.$personemail.", ";
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

if ($bseq > 0) {XH5("There are $pcounter emails in this list, split into blocks of ".$distlistblock.".");}
else { XBR();XTXT("There are $pcounter emails in this list"); }
foreach ($distlisttexta as $distlisttext) {	
	XTABLE();XTR();XTDFIXED("600");
	XTXT($distlisttext);
	X_TD();X_TR();X_TABLE();XBR();
} 
XH4("The following invalid emails were skipped");
XTABLE();XTR();XTDFIXED("600");
XTXT($errordistlisttext);
X_TD();X_TR();X_TABLE();
if ($dontsenddistlisttext != "") {
	XH4("The following emails did not permit newsletters");
	XTABLE();XTR();XTDFIXED("600");
	XTXT($dontsenddistlisttext);
	X_TD();X_TR();X_TABLE();
}


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
XBR();XTXT("There are $pcounter ids in this list");
XTABLE();XTR();XTDFIXED("600");
XTXT($distlisttext);
X_TD();X_TR();X_TABLE();
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
			Write_File ($filehandle, "$outmessage"."\n");
		}
	}
	# print "<BR>- People List Download prepared successfully\n";
	Close_File_Write ($filehandle);
	Download_File ($downloadfilename,"keep");
}

function MC_Cleanup () {
$mcdirfiles = Get_Directory_Array ($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'});
foreach ($mcdirfiles as $fullfile) {	
	if (strlen(strstr($fullfile,'mailchimplist_'))>0) {		
		if (($GLOBALS{'site_readonly'} == "OFF")&&($GLOBALS{'domain_readonly'} == "OFF")) {
			$dfile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$fullfile;
			Delete_File ($dfile);
		}
	}
}
=======
<?php # personLIin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('MPDF/mpdf.php');

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

	$ltitle = array(); $ltab = array(); $exdir = array(); 			
	$ltitle[1] = "title";    $lfield[1] = 'person_title';      $lwidth[1] = "5";   $exdir[1] = "-1";
	$ltitle[2] = "surname";  $lfield[2] = 'person_sname';      $lwidth[2] = "15";  $exdir[2] = "-1";
	$ltitle[3] = "fname";    $lfield[3] = 'person_fname';      $lwidth[3] = "12";  $exdir[3] = "-1";
	$ltitle[4] = "addr1";    $lfield[4] = 'person_addr1';      $lwidth[4] = "25";  $exdir[4] = "2";
	$ltitle[5] = "addr2";    $lfield[5] = 'person_addr2';      $lwidth[5] = "18";  $exdir[5] = "2";
	$ltitle[6] = "addr3";    $lfield[6] = 'person_addr3';      $lwidth[6] = "14";  $exdir[6] = "2";
	$ltitle[7] = "addr4";    $lfield[7] = 'person_addr4';      $lwidth[7] = "14";  $exdir[7] = "2";
	$ltitle[8] = "postcode"; $lfield[8] = 'person_postcode';   $lwidth[8] = "10";  $exdir[8] = "2";
	$ltitle[9] = "hometel";  $lfield[9] = 'person_hometel';    $lwidth[9] = "13";  $exdir[9] = "1";
	$ltitle[10] = "worktel"; $lfield[10] = 'person_worktel';   $lwidth[10] = "13"; $exdir[10] = "1";
	$ltitle[11] = "mobile";  $lfield[11] = 'person_mobiletel'; $lwidth[11] = "13"; $exdir[11] = "1";
	$ltitle[12] = "email";   $lfield[12] = 'person_email1';     $lwidth[12] = "45"; $exdir[12] = "0";	
	
	$headerhtml = YTR();
	for ($li = 1; $li < 13; $li++) {
		$headerhtml = $headerhtml.YTDHTXTLEFTCOLOR($ltitle[$li],"Navy");
	}
	$headerhtml = $headerhtml.Y_TR();	

	$reporthtml = "";
	$reporthtml = $reporthtml.ML_PrintFrontPage($selectionarray);
	
	$pagecountmax = 35;
	$pagecount = 999;
	foreach ( $personslistarray as $person_id) {
		Get_Data( 'person', $person_id );
		$pagecount++;
		if ($pagecount > $pagecountmax) {
			if ($pagecount != 1000) {
				$reporthtml = $reporthtml.'</table>';
			}
			$pagecount = 0;
			$reporthtml = $reporthtml."<pagebreak />";
			$reporthtml = $reporthtml.'<table border="0">';			
			$reporthtml = $reporthtml.$headerhtml;
		}
		$reporthtml = $reporthtml.YTR();
		for ($li = 1; $li < 13; $li++) {
		  if ($ltitle[$li] == "email") {
		  	$fieldval = GetPersonEmail();
		  } else {
		  	$fieldval = $GLOBALS{$lfield[$li]};		  	
		  }
		  $reporthtml = $reporthtml.YTDTXT(ML_Format( $GLOBALS{$lfield[$li]}, $lwidth[$li], $exdir[$li])); 		  
		}
		$reporthtml = $reporthtml.Y_TR();
	}
	$reporthtml = $reporthtml.Y_TABLE();
	
	$mpdf = new mPDF(
	'',    // mode - default ''
	'A4-L',  // format - A4, for example, default ''
	8,     // font size - default 0
	'Helvetica',    // font family
	10,    // margin_left
	10,    // margin right
	10,    // margin top
	10,    // margin bottom
	20,     // margin header
	9,     // margin footer
	'L');  // L - landscape, P - portrait

	$reporthtml = mb_convert_encoding($reporthtml, 'UTF-8', 'UTF-8'); // trick to avoid issue with non UTF-8 characters
	$mpdf->WriteHTML($reporthtml);
	$mpdf->Output();
}

function ML_Format ($fieldvalue, $width, $exdir) {
	$bits = str_split($fieldvalue);
	$lstring = "";
	if ($GLOBALS{'person_exdirectory'} > "3") {
		$GLOBALS{'person_exdirectory'} = "3";
	}
	if ($GLOBALS{'person_exdirectory'} < "0") {
		$GLOBALS{'person_exdirectory'} = "3";
	}
	if (($GLOBALS{'person_exdirectory'} > $exdir)||(strlen(strstr($GLOBALS{'person_authority'},"MM#"))>0)) {
		$bits = str_split($fieldvalue);
	}
	else {$bits = str_split(".........................................................................");
	}
	$bitcounter = 0;
	foreach ($bits as $bit) {
		if ($bitcounter < $width) {
			$lstring = $lstring.$bit;
		}
		$bitcounter++;
	}
	return $lstring;
}

function ML_PrintFrontPage ($selectionarray) {
	$frontpagehtml = "";
	Get_Data("person",$GLOBALS{'LOGIN_person_id'});
	for ($li = 0; $li < 5; $li++) {
		$frontpagehtml = $frontpagehtml.YBR();
	}
	$frontpagehtml = $frontpagehtml.YTXTCOLOR("<b>"."Membership List - ".$GLOBALS{'domain_longname'}."</b>","Navy");
	$frontpagehtml = $frontpagehtml.YPTXT($GLOBALS{'dd'}."/".$GLOBALS{'mm'}."/".$GLOBALS{'yy'});
	$frontpagehtml = $frontpagehtml.YPTXT("Requested and printed by ".$GLOBALS{'askingperson_fname'}." ".$GLOBALS{'askingperson_sname'});
	$frontpagehtml = $frontpagehtml.YPTXT("The requester has authorisation to view to the following information:-");
	$tsectionsarray = Get_Array_Hash_SortSelect('section',$GLOBALS{'currperiodid'},"section_seq","","");
	foreach ($tsectionsarray as $tsection_name) {
		$frontpagehtml = $frontpagehtml.YTXT("  - ".$tsection_name." section").YBR();
	}
	$frontpagehtml = $frontpagehtml.YPTXT("");
	$frontpagehtml = $frontpagehtml.YPTXT("Selection criteria for this list.");
	foreach ($selectionarray as $selectionelement) {
		$frontpagehtml = $frontpagehtml.YPTXT("  - $selectionelement");
	}
	$frontpagehtml = $frontpagehtml.YPTXT("");
	$frontpagehtml = $frontpagehtml.YPTXT("Ex-directory information is denoted by ......");
	return $frontpagehtml;
}

#------------------------------ Label Print Routines -----------------------------------
function LA_Processing ($personslistarray,$selectionarray){

	$labeltype = $_REQUEST['LabelType'];
	$labelrowsperpage = 8;
	$labelcolsperpage = 2;
	$labellinesperrow = 8;
	$labellinestop = 2;	// fine tuning to centre lable vertically 
	$labelspacesleft = 4;	// fine tuning to centre lable horizontally 	
	$page_format = 'A4';
	$font_size = '11.6';		
	$margin_left = '15';
	$margin_right = '0';		
	$margin_top = '10';
	$margin_bottom = '0';
	
	if ( $labeltype == "8x2" ) { // A4 Avery L7162 - 16 per page)
		$labelrowsperpage = 8;
		$labelcolsperpage = 2;
		$labellinesperrow = 8;
		$labellinestop = 1;
		$labelspacesleft = 5;		
		$page_format = 'A4';
		$font_size = '11.6';		
		$margin_left = '14';
		$margin_right = '0';		
		$margin_top = '10';
		$margin_bottom = '0';
	}

	if ( $labeltype == "6x3" ) {
		// A4 Avery L7162 - 16 per page)
		$labelrowsperpage = 6;
		$labelcolsperpage = 3;
		$labellinesperrow = 11;
		$labellinestop = 2;
		$labelspacesleft = 4;				
		$page_format = 'A4';
		$font_size = '11.7';
		$margin_left = '10';
		$margin_right = '0';
		$margin_top = '8';
		$margin_bottom = '0';
	}	
	
	$labelrowcount = 999;
	$reporthtml = "";		
	$labelarray =Array();
	$hcs = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; // horizontal correction string
	
	$personslistindex = 0; $personslistindexmax = sizeof($personslistarray);
	$morelabels = "1";
	while ($morelabels == "1") {
		for ($ci = 0; $ci < $labelcolsperpage; $ci++) {
			for ($li = 0; $li < $labellinesperrow; $li++) {
				$labelarray[$ci][$li] = "";	
			}
		}
		
		for ($ci = 0; $ci < $labelcolsperpage; $ci++) {
			if ($personslistindex <= $personslistindexmax) {
				$tperson_id = $personslistarray[$personslistindex];
				if ($tperson_id == "selection") {
				    $selectionarrayext = Array("","","","","","",""); $selectionarray=array_merge($selectionarray,$selectionarrayext);
				    $li = 0;
				    for ($lti = 0; $lti < $labellinestop; $lti++) {
				    	$labelarray[$ci][$li] = "";
				    	$li++;
				    }
				    $labelarray[$ci][$li] = "------ selection criteria ------"; 	
				    $labelarray[$ci][$li] = $selectionarray[0];$li++; 	
				    $labelarrayA[$ci][$li] = $selectionarray[1]; $li++; 	
				    $labelarrayA[$ci][$li] = $selectionarray[2]; $li++;	    
				    $labelarrayA[$ci][$li] = $selectionarray[3]; $li++;	
				    $labelarrayA[$ci][$li] = $selectionarray[4]; $li++;	    
				} else {
				   Check_Data("person",$tperson_id);
				   if ($GLOBALS{'IOWARNING'} == "0") {
				   		$li = 0;
				   		for ($lti = 0; $lti < $labellinestop; $lti++) {		   			
				   			$labelarray[$ci][$li] = "";
				   			$li++;
				   		}
					    $labelarray[$ci][$li] = $GLOBALS{'person_title'}." ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}; $li++;	
					    if ($GLOBALS{'person_addr1'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_addr1'}; $li++;}
					    if ($GLOBALS{'person_addr2'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_addr2'}; $li++;} 
					    if ($GLOBALS{'person_addr3'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_addr3'}; $li++;}   	
					    if ($GLOBALS{'person_addr4'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_addr4'}; $li++;}
					    if ($GLOBALS{'person_postcode'} != "") {$labelarray[$ci][$li] = $GLOBALS{'person_postcode'}; $li++;}
				   }    	
				}
			} else {
				$morelabels = "0";
			}		
			$personslistindex++;
		}		
		
		$labelrowcount++;
		if ($labelrowcount >= $labelrowsperpage) {
			if ($labelrowcount != 1000) {
				$reporthtml = $reporthtml.'</table>';
				$reporthtml = $reporthtml."<pagebreak />";
			}
			$labelrowcount = 0;
			$reporthtml = $reporthtml.'<table width="100%" style="page-break-inside:avoid" >';			
			$reporthtml = $reporthtml.$headerhtml;
		}
		$reporthtml = $reporthtml.YTR();
		for ($ci = 0; $ci < $labelcolsperpage; $ci++) {
			$thiswidth = 100/$labelcolsperpage;
			$hci = $ci*$labelspacesleft*6;
			$reporthtml = $reporthtml.'<td width="'.$thiswidth.'%"      >';		
			for ($li = 0; $li < $labellinesperrow; $li++) {
			  	$reporthtml = $reporthtml.substr($hcs,0,$hci).YTXT($labelarray[$ci][$li]).YBR(); 		  
			}
			$reporthtml = $reporthtml.Y_TD();
		}
		$reporthtml = $reporthtml.Y_TR();
	}
	$reporthtml = $reporthtml.Y_TABLE();
	
	$mpdf = new mPDF(
	'',    // mode - default ''
	$page_format,  // format - A4, for example, default ''
	$font_size,     // font size - default 0
	'Helvetica',    // font family
	$margin_left,    // margin_left
	$margin_right,    // margin right
	$margin_top,    // margin top
	$margin_bottom,    // margin bottom
	0,     // margin header
	0,     // margin footer
	'P');  // L - landscape, P - portrait

	$reporthtml = mb_convert_encoding($reporthtml, 'UTF-8', 'UTF-8'); // trick to avoid issue with non UTF-8 characters
	$mpdf->WriteHTML($reporthtml);
	$mpdf->Output();
}

#------------------------------ Distribution List Routines -----------------------------------
function DL_Processing ($personslistarray,$selectionarray) {
	
$distlistblock = $_REQUEST['DistListBlock'];
$distlistnewsletterrespect = $_REQUEST['DistListNewsletterRespect'];
if ( $distlistblock == "" ) { $distlistblocknum = 1000; }
else { $distlistblocknum = $distlistblock + 0;}	
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$distlisttexta = Array(); $errordistlisttext = ""; $dontsenddistlisttext = ""; $pcounter = 0; 
$bseq = 0; $bcounter = 0; array_push($distlisttexta,"");
foreach ($personslistarray as $tperson_id) {
 Check_Data("person",$tperson_id);
 if ($GLOBALS{'IOWARNING'} == "0") {
  $personemail = GetPersonEmail();
  if ($personemail != "") {
   $emailats = explode('@', $personemail);	
   if (sizeof($emailats) == 2) {	
	    $distlisttext = $distlisttext.$personemail.", ";
	    if ($bcounter >= $distlistblocknum ) { $bseq++; array_push($distlisttexta,""); $bcounter = 0; }
	    $sendtothisperson = "1";
	    if (($distlistnewsletterrespect == "Yes")&&($GLOBALS{'person_broadcast1'} == "No")) { 
	    	$sendtothisperson = "0";
	    	$dontsenddistlisttext = $dontsenddistlisttext.$personemail.", ";
	    }
	    if ($sendtothisperson == "1") {
		     $distlisttexta[$bseq] = $distlisttexta[$bseq].$GLOBALS{'person_email1'}.", ";
		     $pcounter++; $bcounter++;     
	    }
   } else {
    	$errordistlisttext = $errordistlisttext.$personemail.", ";
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

if ($bseq > 0) {XH5("There are $pcounter emails in this list, split into blocks of ".$distlistblock.".");}
else { XBR();XTXT("There are $pcounter emails in this list"); }
foreach ($distlisttexta as $distlisttext) {	
	XTABLE();XTR();XTDFIXED("600");
	XTXT($distlisttext);
	X_TD();X_TR();X_TABLE();XBR();
} 
XH4("The following invalid emails were skipped");
XTABLE();XTR();XTDFIXED("600");
XTXT($errordistlisttext);
X_TD();X_TR();X_TABLE();
if ($dontsenddistlisttext != "") {
	XH4("The following emails did not permit newsletters");
	XTABLE();XTR();XTDFIXED("600");
	XTXT($dontsenddistlisttext);
	X_TD();X_TR();X_TABLE();
}


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
XBR();XTXT("There are $pcounter ids in this list");
XTABLE();XTR();XTDFIXED("600");
XTXT($distlisttext);
X_TD();X_TR();X_TABLE();
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
			Write_File ($filehandle, "$outmessage"."\n");
		}
	}
	# print "<BR>- People List Download prepared successfully\n";
	Close_File_Write ($filehandle);
	Download_File ($downloadfilename,"keep");
}

function MC_Cleanup () {
$mcdirfiles = Get_Directory_Array ($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'});
foreach ($mcdirfiles as $fullfile) {	
	if (strlen(strstr($fullfile,'mailchimplist_'))>0) {		
		if (($GLOBALS{'site_readonly'} == "OFF")&&($GLOBALS{'domain_readonly'} == "OFF")) {
			$dfile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$fullfile;
			Delete_File ($dfile);
		}
	}
}
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
}