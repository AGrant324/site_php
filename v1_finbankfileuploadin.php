<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$GLOBALS{'bankfile_id'} = $_REQUEST["BankFileId"];
$acd = $_REQUEST["ACD"];
if ($acd == "A") {
 if(isset($_POST['Cancel'])){
  XH5("Bank File Upload Cancelled.");
  Fin_MAINTAINBANKFILELIST_Output ();
 }
 if(isset($_POST['Update'])){ 
  XH3("Bank Transactions Upload - ".$GLOBALS{'bankfile_id'});

  Get_Data('bankfile',$GLOBALS{'bankfile_id'});
  $bank_id = $_REQUEST["BankFileBankId"];
  Get_Data('bank',$bank_id);
  $GLOBALS{'bankupload_id'} = $_REQUEST["BankFileBankUploadId"];
  Get_Data('bankupload',$GLOBALS{'bankupload_id'});
  $maxfilesize = "1000000";
  $continuewithupload  = "1";
  # uploadname filepath filename allowedfiletypes maxsize add/update prefix
  $uploadstring = Upload_File("BankFileFile",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"","text/csv/qif/ofx/TEXT/CSV/QIF/OFX",$maxfilesize,"","","","");
  # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
  $uploadstringa = explode("|",$uploadstring);
  $uploadfilename = $uploadstringa[2];
  $uploadfilenamea = explode(".",$uploadfilename);  
  $uploadfiletype = $uploadfilenamea[1];  
  # Error(1/0)|Message|filename|filesize|width|height

  if (($uploadfiletype == "csv")||($uploadfiletype == "qif")||($uploadfiletype == "ofx")||
      ($uploadfiletype == "CSV")||($uploadfiletype == "QIF")||($uploadfiletype == "OGX")) {
   $previouslyuploaded = "0";
   $bankfilea = Get_Array('bankfile');
   foreach ($bankfilea as $bankfile_id) {
    Get_Data('bankfile',$bankfile_id);
    if ($GLOBALS{'bankfile_file'} == $uploadfilename) { $previouslyuploaded = "1"; }     	
   }
   if ($previouslyuploaded == "1") {
    XH5("Bank records not uploaded.");
    XTXT("Caution:-The file ".$uploadfilename." has already been loaded. Reloading it could result in duplicate transactions.");
    XTXT("If you wish to upload the information anyway, then change the filename and reload.");
    $continuewithupload  = "0";
   }  
   if ($continuewithupload  == "1") {
    XTXT($uploadstringa[1].' using "'.$GLOBALS{'bankupload_id'}.'" Format.');   
    $banktxna = Get_Array('banktxn');
    sort($banktxna);
    $lastbanktxn_id = end($banktxna); 
    Check_Data('banktxn',$lastbanktxn_id);
    if ($GLOBALS{'IOWARNING'} == "1") {$nextbanktxn_id = 1;}
    else {
     $nextbanktxn_id = str_replace("B", "", $GLOBALS{'banktxn_id'});
     $nextbanktxn_id++;
    }
    if (($uploadfiletype == "csv")||($uploadfiletype == "CSV")) { CSV_Import($uploadfilename,$nextbanktxn_id); }
    if (($uploadfiletype == "qif")||($uploadfiletype == "QIF")) { QIF_Import($uploadfilename,$nextbanktxn_id); }
    if (($uploadfiletype == "ofx")||($uploadfiletype == "OFX")) { OFX_Import($uploadfilename,$nextbanktxn_id); }        
   }    
  }
 } 
}
if ($acd == "C") {
 if(isset($_POST['Cancel'])){
  XPTXT("Bank File Update Cancelled.");
  Fin_MAINTAINBANKFILELIST_Output ();
 }
 if(isset($_POST['Update'])){
  XH3("Bank Transactions Update - ".$GLOBALS{'bankfile_id'});
  Get_Data('bankfile',$GLOBALS{'bankfile_id'});
  $GLOBALS{'bankfile_comment'} = $_REQUEST["BankFileComment"];
  Write_Data('bankfile',$GLOBALS{'bankfile_id'});
  XH5("Comments Updated.");
 }  	    	
}
if ($acd == "D") {
 XH3("Bank Transactions Delete - ".$GLOBALS{'bankfile_id'});

 if(isset($_POST['Delete'])){
  XH5("Bank File and any previously uploaded Transactions shown below have been deleted."); 
  XTABLE();
  Get_Data('bankfile',$GLOBALS{'bankfile_id'});
  $banktxna = Get_Array('banktxn');
  $firsttxndelete = "1";
  foreach ($banktxna as $banktxn_id) {
   Get_Data('banktxn',$banktxn_id); 	
   $keep = "1";
   if (($GLOBALS{'banktxn_id'} >= $GLOBALS{'bankfile_banktxnidrangestart'})
       &&($GLOBALS{'banktxn_id'} <= $GLOBALS{'bankfile_banktxnidrangeend'})) {$keep = "0";} 	
   if ($keep == "0") {
    if ($firsttxndelete == "1") {
     XTR();
     XTDHTXT("Id");
     XTDHTXT("Sort");
     XTDHTXT("Account");
     XTDHTXT("Date");
     XTDHTXT("Txn Type");
     XTDHTXT("Description");
     XTDHTXT("Debit");
     XTDHTXT("Credit");
     XTDHTXT("Balance");
     XTDHTXT("");     
     X_TR();
     $firsttxndelete = "0";
    }
    XTR();
    XTDTXT($GLOBALS{'banktxn_id'});  
    XTDTXT($GLOBALS{'banktxn_sort'});
    XTDTXT($GLOBALS{'banktxn_account'});
    XTDTXT($GLOBALS{'banktxn_date'});  
    XTDTXT($GLOBALS{'banktxn_txntype'}) ;
    XTDTXT($GLOBALS{'banktxn_description'});
    XTDTXT($GLOBALS{'banktxn_debit'});
    XTDTXT($GLOBALS{'banktxn_credit'});
    XTDTXT($GLOBALS{'banktxn_balance'});
    XTDTXT('<font color="red"><b>DELETED</b></font>');     
    X_TR();    	
   	Delete_Data('banktxn',$banktxn_id);
   }  	
  }
  X_TABLE();
  if ($firsttxndelete == "1") {XPTXT("No transactions found to delete");}  
  if ($GLOBALS{'bankfile_file'} != "") {
   $deletefilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$GLOBALS{'bankfile_file'};
   if (file_exists($deletefilename)) {  unlink($deletefilename); }
  }
  Check_Data('bankfile',$GLOBALS{'bankfile_id'});
  if ($GLOBALS{'IOWARNING'} == "0") { Delete_Data('bankfile',$GLOBALS{'bankfile_id'});  }  
 } 
 if(isset($_POST['Cancel'])){ 
  XH5("Delete Cancelled - no action taken."); 	
 }	
}

$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS();
$link = $link.YPGMPARM("SelectId","UPLOADBANK");  
XBR();XBR();XLINKTXT($link,"review bank file upload list and add new entry");

Back_Navigator();
PageFooter("Default","Final");

# ========== Output Field Display Routines ==========================================================

function stringSplit($tstring) {
 $xstring = str_replace("'","",$tstring);;
 $ssep = "";
 if (strlen(strstr($tstring,"-"))>0) { $ssep = "-"; } 
 if (strlen(strstr($tstring,"/"))>0) { $ssep = "/"; } 
 if (strlen(strstr($tstring,"_"))>0) { $ssep = "_"; } 
 if (strlen(strstr($tstring," "))>0) { $ssep = " "; } 
 if ($ssep != "") { return explode($ssep, $xstring);}
 else { $nullarray = Array("",""); return $nullarray; }
}

function stringToIntLength($instring,$length) {
 $m_strOut = preg_replace("/[^0-9,.]/", "", $instring);
 $minuslength = 0 - $length;
 return substr("0000000000".$m_strOut,$minuslength); 
}

function stringToDec2String($tstring) {
 if ( $tstring == "" ) { return ""; }
 $tdarray = str_split($tstring);
 $result = true;
 foreach ($tdarray as $char) {
 	if ($char < "0") {
 		if (($char == ".")||($char == "-")||($char == ",")) {
 		} else { $result = false;
 		}
 	}
 	if ($char > "9") {
 		if (($char == ".")||($char == "-")||($char == ",")) {
 		} else { $result = false;
 		}
 	}
 }
 if ( $result ) { return number_format($tstring,2); } 
 else { return $tstring; }
}

function DateFilter ($dstring, $ftype) { 
# field filter("DD-MMM-YY","DD/MM/YYYY") returns YYYY-MM-DD
 $darray = Array();
 $dd = "";
 $mm = "";
 $yyyy = "";
 if ($ftype ==  "YYYYMMDD" ) {
  $dd = substr($dstring, 6, 2);
  $mm = substr($dstring, 4, 2);
  $yyyy = substr($dstring, 0, 4);
 } 
 if ($ftype ==  "DD.MM.YY" ) {
  $darray = dateStringToArray($dstring);
  $dd = stringToIntLength($darray[0],2);
  $mm = stringToIntLength($darray[1],2);
  $yyyy = "20".$darray[2];   	
 }
 if ($ftype == "DD.MM.YYYY" ) {
  $darray = dateStringToArray($dstring);
  $dd = stringToIntLength($darray[0],2);
  $mm = stringToIntLength($darray[1],2);
  $yyyy = $darray[2]; 	 
 }
 if ($ftype == "DD.Mon.YY" ) {
  $darray = dateStringToArray($dstring);
  $dd = stringToIntLength($darray[0],2);
  $montommarray = Array ();
  $montommarray["Jan"] = "01";
  $montommarray["Feb"] = "02";
  $montommarray["Mar"] = "03";
  $montommarray["Apr"] = "04";
  $montommarray["May"] = "05";
  $montommarray["Jun"] = "06";
  $montommarray["Jul"] = "07";
  $montommarray["Aug"] = "08";
  $montommarray["Sep"] = "09";
  $montommarray["Oct"] = "10";
  $montommarray["Nov"] = "11";
  $montommarray["Dec"] = "12";
  if (array_key_exists($darray[1], $montommarray)) { $mm = $montommarray[$darray[1]]; } else { $mm = "??"; }
  $yyyy = "20".$darray[2];  	 
 }
 if ($ftype == "MM.DD.YY" ) {
  $darray = dateStringToArray($dstring);
  $dd = stringToIntLength($darray[1],2);
  $mm = stringToIntLength($darray[0],2);
  $yyyy = $darray[2];   	 
 }
return $yyyy."-".$mm."-".$dd;
}

function dateStringToArray($datestring) {
 $tdarray = Array();
 $ssep = ""; 
 if (strlen(strstr($datestring,"-"))>0) { $ssep = "-"; }
 if (strlen(strstr($datestring,"/"))>0) { $ssep = "/"; }
 if (strlen(strstr($datestring,"_"))>0) { $ssep = "_"; }
 if (strlen(strstr($datestring," "))>0) { $ssep = " "; } 
 if ($ssep != "") {	
  return explode($ssep, $datestring); 
 }
 else { 
  $nullarray = Array("","",""); 
  return $nullarray; 
 } 
}

# ========== Output Field Display Routines ==========================================================

function IntegerDisplay($dstring, $dlength) {
 $xstring = preg_replace("/\-/", "", $dstring);
 $xstring = preg_replace("/\'/", "", $xstring);
 $tdarray = str_split($xstring);
 $result = true;
 foreach ($tdarray as $char) { 	
  if ($char < "0") { $result = false; }  
  if ($char > "9") { $result = false; }  
 }
 if ( $result ) { 
  $minuslength = 0 - $dlength;
  $ystring = substr("0000000000".$xstring,$minuslength);
  return '<font color="' . "green" . '"><b>' . $ystring . '</b></font>';    
 } 
 else {
  return '<font color="' ."red" . '"><b>' . $dstring . '</b></font>';
  $GLOBALS{'recordupdateerror'} = "1";
 } 
}

function IntegerDB($dstring) {
 $xstring = preg_replace("/\-/", "", $dstring);
 $xstring = preg_replace("/\'/", "", $xstring);	
 return $xstring;
}

function DateDisplay($dstring) {
 $tdarray = str_split($dstring."??????????");
 $result = true;
 $postpoint = "0"; 
 $deccount = 0;
 if (($tdarray[0] < "0")||($tdarray[0] > "9")) { $result = false; }  
 if (($tdarray[1] < "0")||($tdarray[1] > "9")) { $result = false; }   
 if (($tdarray[2] < "0")||($tdarray[2] > "9")) { $result = false; }   
 if (($tdarray[3] < "0")||($tdarray[3] > "9")) { $result = false; }
 $floatnum = (int)($tdarray[0].$tdarray[1].$tdarray[2].$tdarray[3]);
 if (($floatnum < 2000)||($floatnum >2025)) { $result = false; }  
 if ($tdarray[4] != "-") { $result = false; }  
 if (($tdarray[5] < "0")||($tdarray[5] > "9")) { $result = false; }   
 if (($tdarray[6] < "0")||($tdarray[6] > "9")) { $result = false; }
 $floatnum = (int)($tdarray[5].$tdarray[6]);
 if (($floatnum < 1)||($floatnum >12)) { $result = false; }   
 if ($tdarray[7] != "-") { $result = false; }   
 if (($tdarray[8] < "0")||($tdarray[8] > "9")) { $result = false; }   
 if (($tdarray[9] < "0")||($tdarray[9] > "9")) { $result = false; }
 $floatnum = (int)($tdarray[8].$tdarray[9]);
 if (($floatnum < 1)||($floatnum >31)) { $result = false; }   
 if (strlen($dstring) != 10) { $result = false; }  
 if ( $result ) { $resultcolor = "green"; } else { $resultcolor = "red"; $GLOBALS{'recordupdateerror'} = "1"; } 
 return '<font color="' . $resultcolor . '"><b>' . $dstring . '</b></font>';
}

function DateDB($dstring) {
 return $dstring;
}

function TextDisplay($dstring) {
 return '<font color="' . "green" . '"><b>' . $dstring . '</b></font>';
}

function TextDB($dstring) {
 return $dstring;
}

function AmountDisplay($dstring) {
 $result = true;
 if ($dstring != "") { 
  $tdarray = str_split($dstring); 
  $postpoint = "0"; 
  $deccount = 0; $tdindex = 0;
  foreach ($tdarray as $char) { 	
   if (($char >= "0")&&($char <= "9")&&($postpoint == "1")) { $deccount++; }    
   if ($char < "0") { if (($char == ".")||($char == "-")||($char == ",")) {} else { $result = false; } } 
   if ($char > "9") { if (($char == ".")||($char == "-")||($char == ",")) {} else { $result = false; } } 
   if ($char == ".") { $postpoint = "1"; }
   if (($char == "-")&&($tdindex != 0)) { $result = false; } 
   $tdindex++;
  }
  if ($deccount != 2) { $result = false; } 
 }
 if ( $result ) { $resultcolor = "green"; } else { $resultcolor = "red"; $GLOBALS{'recordupdateerror'} = "1"; } 
 return '<font color="' . $resultcolor . '"><b>' . $dstring . '</b></font>';
}

function AmountDB($dstring) {
 return $dstring;
}


function CSV_Import($puploadfilename,$pnextbanktxn_id) {
 $uploadperiodstart = "9999-99-99";
 $uploadperiodend   = "0000-00-00";
 $uploadrangestart  = "B999999999";
 $uploadrangeend    = "B000000000";
 XTABLE();
 XTR();
 XTDHTXT("Id");
 XTDHTXT("Sort");
 XTDHTXT("Account");
 XTDHTXT("Date");
 XTDHTXT("Txn Type");
 XTDHTXT("Description");
 XTDHTXT("Debit");
 XTDHTXT("Credit");
 XTDHTXT("Balance");
 XTDHTXT("");
 X_TR();
 $records = Get_File_Array ($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$_FILES["BankFileFile"]["name"]);
 for ($i=0; $i<10; $i++) {
  $ftype = $GLOBALS{'bankupload_col'.$i};
  if (($ftype == "DD.MM.YY" )||($ftype == "DD.MM.YYYY" )||($ftype == "DD.Mon.YY" )||($ftype == "MM.DD.YY" )) {
   $bankupload_dateoffset	= $i;
   $bankupload_dateformat = $ftype;
   # print "<br>DATE bankupload_col".$i." ".$bankupload_dateoffset." ".$bankupload_dateformat."<br>\n";
  }
 }	
 
 # re-sort bankfile records into date sequence
 $sortedbankfilea = array();
 $headerfound = "0";
 foreach ($records as $recordelement) {
  if ($recordelement != "") {
   $upmessage = CSV_In_Filter($recordelement);
   $uploadcsv = explode("|",$upmessage);
   $datefield = $uploadcsv[$bankupload_dateoffset];
   if ($datefield != "") {
    if (($GLOBALS{'bankupload_header'} == "Yes")&&($headerfound == "0")) {
     $headerfound = "1";
    } else {
     $sortedbankfileelement = DateFilter($datefield,$bankupload_dateformat)."|".$recordelement;
     # print $sortedbankfileelement."<br>\n";
     array_push($sortedbankfilea,$sortedbankfileelement);
    }
   }
  }
 }
 sort($sortedbankfilea);
		 
 $adduploaderror = "0";
 # ---- Pass 1 - verify the input file ------------------------------------------------
 XH5("Verifying the bank file for errors using this format.");
 $recordindex = 0;
 $tnextbanktxn_id = $pnextbanktxn_id;
 foreach ($sortedbankfilea as $sortedbankfileelement) {
  $rbits = explode("|",$sortedbankfileelement);
  $recordindex++;
  $recordelement = $rbits[1];
  if ($recordelement != "") {
   $GLOBALS{'recordupdateerror'} = "0";
   $upmessage = CSV_In_Filter($recordelement);
   $uploadcsv = explode("|",$upmessage);
   $GLOBALS{'banktxn_id'} = "B".substr("000000000".$tnextbanktxn_id, -9, 9);
   $displaybanktxn_sort = "";
   $displaybanktxn_account = "";
   $displaybanktxn_date = "";
   $displaybanktxn_txntype = "";
   $displaybanktxn_description = "";
   $displaybanktxn_debit = "";
   $displaybanktxn_credit = "";
   $displaybanktxn_balance = "";
   for ($i=0; $i<10; $i++) {
    $ftype = $GLOBALS{"bankupload_col".$i}; 	
    if ($ftype == "Sort" ) {
     $displaybanktxn_sort = IntegerDisplay($uploadcsv[$i],6);      
    }
    if ($ftype == "Account" ) {
     $displaybanktxn_account = IntegerDisplay($uploadcsv[$i],8);
    }
    if ($ftype == "Sort_Account" ) {
     $tarray = stringSplit($uploadcsv[$i]);
     $displaybanktxn_sort = IntegerDisplay($tarray[0],6);
     $displaybanktxn_account = IntegerDisplay($tarray[1],8);
    }
    if (($ftype == "DD.MM.YY" )||($ftype == "DD.MM.YYYY" )||($ftype == "DD.Mon.YY" )||($ftype == "MM.DD.YY" )) {
		$standarddate = DateFilter($uploadcsv[$i],$ftype);
		$displaybanktxn_date = DateDisplay($standarddate);
    }
    if ($ftype == "Txn Type" ) {
		$displaybanktxn_txntype = TextDisplay($uploadcsv[$i]);
    }
    if ($ftype == "Description" ) {
	       	$displaybanktxn_description  = TextDisplay($uploadcsv[$i]);	 
    }
    if ($ftype == "Debit" ) {
		$displaybanktxn_debit  = AmountDisplay(stringToDec2String($uploadcsv[$i]));
    }
    if ($ftype == "Credit" ) {
		$displaybanktxn_credit  = AmountDisplay(stringToDec2String($uploadcsv[$i]));
    }
    if ($ftype == "Debit/Credit" ) {
     if (strlen(strstr($uploadcsv[$i],"-"))>0) {
			$displaybanktxn_debit  = AmountDisplay(stringToDec2String($uploadcsv[$i]));
			$displaybanktxn_credit  = "";
     } else {
			$displaybanktxn_debit  = "";
			$displaybanktxn_credit  = AmountDisplay(stringToDec2String($uploadcsv[$i]));
     }
    }
    if ($ftype == "Balance" ) {
			$displaybanktxn_balance  = AmountDisplay(stringToDec2String($uploadcsv[$i]));
    }
   }
   XTR();
   XTDTXT("B".substr("000000000".$tnextbanktxn_id, -9, 9));  
   XTDTXT($displaybanktxn_sort);
   XTDTXT($displaybanktxn_account);
   XTDTXT($displaybanktxn_date);
   XTDTXT($displaybanktxn_txntype) ;
   XTDTXT($displaybanktxn_description);
   print "<td align=right>\n";XTXT($displaybanktxn_debit);X_TD();
   print "<td align=right>\n";XTXT($displaybanktxn_credit);X_TD();
   print "<td align=right>\n";XTXT($displaybanktxn_balance);X_TD();
   if ( $GLOBALS{'recordupdateerror'} == "0" ) {
    XTDTXT('<font color="green"><b>OK</b></font>');
   } 
   else { XTDTXT('<font color="red"><b>ERROR</b></font>'); $adduploaderror = "1";
  }
  X_TR();
  $tnextbanktxn_id++;
  }
 }
 X_TABLE();
		 
 # ---- Pass 2 - update the database if there are no errors ------------------------------------------------
	
 if ( $adduploaderror == "0") {
  XH5("No Errors Found.");
  $recordindex = 0;
  $tnextbanktxn_id = $pnextbanktxn_id;
  foreach ($sortedbankfilea as $sortedbankfileelement) {
   $rbits = explode("|",$sortedbankfileelement);
   $recordindex++;
   $recordelement = $rbits[1];
   if ($recordelement != "") {
    $upmessage = CSV_In_Filter($recordelement);
    $uploadcsv = explode("|",$upmessage);
    Initialise_Data('banktxn');
    $GLOBALS{'banktxn_id'} = "B".substr("000000000".$tnextbanktxn_id, -9, 9);
    $GLOBALS{'banktxn_processstatus'} = "raw";
    $GLOBALS{'banktxn_finstatus'} = "open";
    $GLOBALS{'banktxn_vatstatus'} = "open";
    $GLOBALS{'banktxn_bankuploadid'} = $_REQUEST["BankFileBankUploadId"];
    for ($i=0; $i<10; $i++) {
     $ftype = $GLOBALS{"bankupload_col".$i};
     if ($ftype == "Sort" ) {
      $GLOBALS{'banktxn_sort'} = IntegerDB($uploadcsv[$i],6);
     }
     if ($ftype == "Account" ) {
      $GLOBALS{'banktxn_account'} = IntegerDB($uploadcsv[$i],8);
     }
     if ($ftype == "Sort_Account" ) {
      $tarray = stringSplit($uploadcsv[$i]);
      $GLOBALS{'banktxn_sort'} = IntegerDB($tarray[0],6);
      $GLOBALS{'banktxn_account'} = IntegerDB($tarray[1],8);
     }
     if (($ftype == "DD.MM.YY" )||($ftype == "DD.MM.YYYY" )||($ftype == "DD.Mon.YY" )||($ftype == "MM.DD.YY" )) {
      $standarddate = DateFilter($uploadcsv[$i],$ftype);
      $GLOBALS{'banktxn_date'} = DateDB($standarddate);
     }
     if ($ftype == "Txn Type" ) {
      $GLOBALS{'banktxn_txntype'} = TextDB($uploadcsv[$i]);
     }
     if ($ftype == "Description" ) {
      $GLOBALS{'banktxn_description'} = TextDB($uploadcsv[$i]);
     }
     if ($ftype == "Debit" ) {
      $GLOBALS{'banktxn_debit'} = AmountDB($uploadcsv[$i]);
     }
     if ($ftype == "Credit" ) {
      $GLOBALS{'banktxn_credit'} = AmountDB($uploadcsv[$i]);
     }
     if ($ftype == "Debit/Credit" ) {
      if (strlen(strstr($uploadcsv[$i],"-"))>0) {
       $GLOBALS{'banktxn_debit'} = AmountDB($uploadcsv[$i]);
       $GLOBALS{'banktxn_credit'} = "";
      } else {
       $GLOBALS{'banktxn_debit'} = "";
       $GLOBALS{'banktxn_credit'} = AmountDB($uploadcsv[$i]);
      }
     }
     if ($ftype == "Balance" ) {
      $GLOBALS{'banktxn_balance'} = AmountDB($uploadcsv[$i]);
     }
    }
    if ($uploadrangestart >= $GLOBALS{'banktxn_id'}) { $uploadrangestart = $GLOBALS{'banktxn_id'}; }
    if ($uploadrangeend <= $GLOBALS{'banktxn_id'}) { $uploadrangeend = $GLOBALS{'banktxn_id'}; }
    if ($uploadperiodstart >= $GLOBALS{'banktxn_date'}) { $uploadperiodstart = $GLOBALS{'banktxn_date'}; }
    if ($uploadperiodend <= $GLOBALS{'banktxn_date'}) { $uploadperiodend = $GLOBALS{'banktxn_date'}; }
    Write_Data('banktxn',$GLOBALS{'banktxn_id'});
    # XBR();XTXT($GLOBALS{'banktxn_id'}." updated");
    $tnextbanktxn_id++;
   }
  }
  $GLOBALS{'bankfile_bankid'} = $_REQUEST["BankFileBankId"];
  $GLOBALS{'bankfile_bankuploadid'} = $_REQUEST["BankFileBankUploadId"];
  $GLOBALS{'bankfile_comment'} = $_REQUEST["BankFileComment"];
  $GLOBALS{'bankfile_periodstart'} = $uploadperiodstart;
  $GLOBALS{'bankfile_periodend'} = $uploadperiodend;
  $GLOBALS{'bankfile_file'} = $puploadfilename;
  $GLOBALS{'bankfile_status'} = "uploaded";
  $GLOBALS{'bankfile_banktxnidrangestart'} = $uploadrangestart;
  $GLOBALS{'bankfile_banktxnidrangeend'} = $uploadrangeend;
  Write_Data('bankfile',$GLOBALS{'bankfile_id'});
  # XBR();XTXT($GLOBALS{'bankfile_id'}." updated");
 }
 else {
  XH5("Errors found in Bank File.");
  XTXT('"'.$_FILES["BankFileFile"]["name"].'" - Not Saved');   
  unlink($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$_FILES["BankFileFile"]["name"]);
  Delete_Data('bankfile',$GLOBALS{'bankfile_id'});
  XBR();XBR();
 }
}

function QIF_Import($puploadfilename,$pnextbanktxn_id) {
 # !Type:Bank
 # D30/04/2012
 # PWWW.THUS.NET CD 7937
 # T-18.00
 # ^
 $uploadperiodstart = "9999-99-99";
 $uploadperiodend   = "0000-00-00";
 $uploadrangestart  = "B999999999";
 $uploadrangeend    = "B000000000";
 XTABLE();
 XTR();
 XTDHTXT("Id");
 XTDHTXT("Date");
 XTDHTXT("Description");
 XTDHTXT("Debit");
 XTDHTXT("Credit");
 XTDHTXT("");
 X_TR();
 $records = Get_File_Array ($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$_FILES["BankFileFile"]["name"]);
 # re-sort bankfile records into date sequence
 $sortedbankfilea = array();
 foreach ($records as $recordelement) {
  $chara = str_split($recordelement);
  $cntlchar = $chara[0];
  $minusdatalength = 0 - strlen($recordelement) + 1 ;
  $recorddata = substr($recordelement,$minusdatalength);    
  if ($cntlchar == "!") {
   $datadate = "";
   $datadescription = "";
   $dataamount = "";
  }
  if ($cntlchar == "^") {
  	$sortedbankfileelement = DateFilter($datadate,"DD.MM.YYYY")."|".$datadate."|".$datadescription."|".$dataamount;
  	# print $sortedbankfileelement."<br>\n";
  	array_push($sortedbankfilea,$sortedbankfileelement);  	
  	$datadate = "";
  	$datadescription = "";
  	$dataamount = "";
  }
  if ($cntlchar == "D") { $datadate = $recorddata; }   
  if ($cntlchar == "P") { $datadescription = $recorddata; } 	
  if ($cntlchar == "T") { $dataamount = $recorddata; } 	
 }
 sort($sortedbankfilea);
			
 $adduploaderror = "0";
 # ---- Pass 1 - verify the input file ------------------------------------------------
 XH5("Verifying the bank file for errors using this format.");
 $recordindex = 0;
 $tnextbanktxn_id = $pnextbanktxn_id;
 foreach ($sortedbankfilea as $sortedbankfileelement) {
  $rbits = explode("|",$sortedbankfileelement);
  $recordindex++;
  if ($rbits[0] != "") {
   $GLOBALS{'recordupdateerror'} = "0";
   $GLOBALS{'banktxn_id'} = "B".substr("000000000".$tnextbanktxn_id, -9, 9);
   $standarddate = DateFilter($rbits[1],"DD.MM.YYYY");
   $displaybanktxn_date = DateDisplay($standarddate);
   $displaybanktxn_description = TextDisplay($rbits[2]);
   if (strlen(strstr($rbits[3],"-"))>0) {
    $displaybanktxn_debit  = AmountDisplay(stringToDec2String($rbits[3]));
    $displaybanktxn_credit  = "";
   } else {
    $displaybanktxn_debit  = "";
    $displaybanktxn_credit  = AmountDisplay(stringToDec2String($rbits[3]));
   }
   XTR();
   XTDTXT("B".substr("000000000".$tnextbanktxn_id, -9, 9));
   XTDTXT($displaybanktxn_date);
   XTDTXT($displaybanktxn_description);
   print "<td align=right>\n";XTXT($displaybanktxn_debit);X_TD();
   print "<td align=right>\n";XTXT($displaybanktxn_credit);X_TD();
   if ( $GLOBALS{'recordupdateerror'} == "0" ) {
    XTDTXT('<font color="green"><b>OK</b></font>');
   } else { 
   	XTDTXT('<font color="red"><b>ERROR</b></font>'); $adduploaderror = "1";
   }
   X_TR();
   $tnextbanktxn_id++;
  }
 }
 X_TABLE();
					
 # ---- Pass 2 - update the database if there are no errors ------------------------------------------------
	
 if ( $adduploaderror == "0") {
  XH5("No Errors Found.");
  $recordindex = 0;
  $tnextbanktxn_id = $pnextbanktxn_id;
  foreach ($sortedbankfilea as $sortedbankfileelement) {
   $rbits = explode("|",$sortedbankfileelement);
   $recordindex++;
   if ($rbits[0] != "") {
    $GLOBALS{'recordupdateerror'} = "0";
    Initialise_Data('banktxn');
    $GLOBALS{'banktxn_id'} = "B".substr("000000000".$tnextbanktxn_id, -9, 9);
    $GLOBALS{'banktxn_processstatus'} = "raw";
    $GLOBALS{'banktxn_finstatus'} = "open";
    $GLOBALS{'banktxn_vatstatus'} = "open";
    $GLOBALS{'banktxn_bankuploadid'} = $_REQUEST["BankFileBankUploadId"];
    $standarddate = DateFilter($rbits[1],"DD.MM.YYYY");
    $GLOBALS{'banktxn_date'} = DateDB($standarddate);
    $GLOBALS{'banktxn_description'} = TextDB($rbits[2]);
    if (strlen(strstr($rbits[3],"-"))>0) {
     $GLOBALS{'banktxn_debit'} = AmountDB($rbits[3]);
     $GLOBALS{'banktxn_credit'} = "";
    } else {
     $GLOBALS{'banktxn_debit'} = "";
     $GLOBALS{'banktxn_credit'} = AmountDB($rbits[3]);
    }  	
    if ($uploadrangestart >= $GLOBALS{'banktxn_id'}) { $uploadrangestart = $GLOBALS{'banktxn_id'}; }
    if ($uploadrangeend <= $GLOBALS{'banktxn_id'}) { $uploadrangeend = $GLOBALS{'banktxn_id'}; }
    if ($uploadperiodstart >= $GLOBALS{'banktxn_date'}) { $uploadperiodstart = $GLOBALS{'banktxn_date'}; }
    if ($uploadperiodend <= $GLOBALS{'banktxn_date'}) { $uploadperiodend = $GLOBALS{'banktxn_date'}; }
    # Write_Data('banktxn',$GLOBALS{'banktxn_id'});
    # XBR();XTXT($GLOBALS{'banktxn_id'}." updated");
    $tnextbanktxn_id++;
   }
  }
  $GLOBALS{'bankfile_bankid'} = $_REQUEST["BankFileBankId"];
  $GLOBALS{'bankfile_bankuploadid'} = $_REQUEST["BankFileBankUploadId"];
  $GLOBALS{'bankfile_comment'} = $_REQUEST["BankFileComment"];
  $GLOBALS{'bankfile_periodstart'} = $uploadperiodstart;
  $GLOBALS{'bankfile_periodend'} = $uploadperiodend;
  $GLOBALS{'bankfile_file'} = $puploadfilename;
  $GLOBALS{'bankfile_status'} = "uploaded";
  $GLOBALS{'bankfile_banktxnidrangestart'} = $uploadrangestart;
  $GLOBALS{'bankfile_banktxnidrangeend'} = $uploadrangeend;
  # Write_Data('bankfile',$GLOBALS{'bankfile_id'});
  # XBR();XTXT($GLOBALS{'bankfile_id'}." updated");
 }
 else {
  XH5("Errors found in Bank File.");
  XTXT('"'.$_FILES["BankFileFile"]["name"].'" - Not Saved');
  unlink($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$_FILES["BankFileFile"]["name"]);
  Delete_Data('bankfile',$GLOBALS{'bankfile_id'});
  XBR();XBR();
 }
}

function OFX_Import($puploadfilename,$pnextbanktxn_id) {
 # <BANKACCTFROM>
 # <BANKID>600524</BANKID>
 # <ACCTID>20640943</ACCTID>
 # <ACCTTYPE>CHECKING</ACCTTYPE>
 # </BANKACCTFROM>
 # <STMTTRN>
 # <TRNTYPE>POS</TRNTYPE>
 # <DTPOSTED>20120103</DTPOSTED>
 # <TRNAMT>-11.79</TRNAMT>
 # <FITID>201201030003</FITID>
 # <NAME>MARKS AND SPENCER</NAME>
 # <MEMO>CHICHESTER GB , 8298 30DEC11</MEMO>
 # </STMTTRN>
 $uploadperiodstart = "9999-99-99";
 $uploadperiodend   = "0000-00-00";
 $uploadrangestart  = "B999999999";
 $uploadrangeend    = "B000000000";
 XTABLE();
 XTR();
 XTDHTXT("Id");
 XTDHTXT("Sort");
 XTDHTXT("Account");
 XTDHTXT("Date");
 XTDHTXT("Txn Type");
 XTDHTXT("Description");
 XTDHTXT("Debit");
 XTDHTXT("Credit");
 XTDHTXT("");
 X_TR();
 $records = Get_File_Array ($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$_FILES["BankFileFile"]["name"]);
 # re-sort bankfile records into date sequence

 $datasort = "";
 $dataaccount = "";
 $datatxntype = "";
 $datadate = "";
 $dataname = "";
 $datamemo = "";
 $dataamount = "";
 $sortedbankfilea = array();
 foreach ($records as $recordelement) {
  if (strlen(strstr($recordelement,"<"))>0) {
   $recordelement = str_replace(">", "|", $recordelement);
   $recordelement = str_replace("<", "|", $recordelement);
   # print "<br>".$recordelement."\n";
   $rbits = explode("|",$recordelement); 	
   if ($rbits[1] == "BANKID") { $datasort = $rbits[2]; }
   if ($rbits[1] == "ACCTID") { $dataaccount = $rbits[2]; }
   if ($rbits[1] == "TRNTYPE") { $datatxntype = $rbits[2]; }		
   if ($rbits[1] == "DTPOSTED") { $datadate = $rbits[2]; }
   if ($rbits[1] == "TRNAMT") { $dataamount = $rbits[2]; }
   if ($rbits[1] == "NAME") { $dataname = $rbits[2]; }
   if ($rbits[1] == "MEMO") {	$datamemo = $rbits[2]; }
   if ($rbits[1] == "/STMTTRN") {				
    $sortedbankfileelement = DateFilter($datadate,"YYYYMMDD")."|".$datasort."|".$dataaccount."|".$datadate."|".$datatxntype."|".$dataname."|".$datamemo."|".$dataamount;
    # print $sortedbankfileelement."<br>\n";
    array_push($sortedbankfilea,$sortedbankfileelement);
    $datatxntype = "";
    $datadate = "";
    $dataname = "";
    $datamemo = "";   
    $dataamount = "";   
   }  
  }
 }
 sort($sortedbankfilea);
	
 $adduploaderror = "0";
 # ---- Pass 1 - verify the input file ------------------------------------------------
 XH5("Verifying the bank file for errors using this format.");
 $recordindex = 0;
 $tnextbanktxn_id = $pnextbanktxn_id;
 foreach ($sortedbankfilea as $sortedbankfileelement) {
	$rbits = explode("|",$sortedbankfileelement);
	$recordindex++;
	if ($rbits[0] != "") {
		$GLOBALS{'recordupdateerror'} = "0";
		$GLOBALS{'banktxn_id'} = "B".substr("000000000".$tnextbanktxn_id, -9, 9);
		$displaybanktxn_sort = IntegerDisplay($rbits[1],6);
		$displaybanktxn_account = IntegerDisplay($rbits[2],8);		
		$standarddate = DateFilter($rbits[3],"YYYYMMDD");
		$displaybanktxn_date = DateDisplay($standarddate);
		$displaybanktxn_type = TextDisplay($rbits[4]);		
		$displaybanktxn_description = TextDisplay($rbits[5]." ".$rbits[6]);		
		if (strlen(strstr($rbits[7],"-"))>0) {
			$displaybanktxn_debit  = AmountDisplay(stringToDec2String($rbits[7]));
			$displaybanktxn_credit  = "";
		} else {
			$displaybanktxn_debit  = "";
			$displaybanktxn_credit  = AmountDisplay(stringToDec2String($rbits[7]));
		}
		XTR();
		XTDTXT("B".substr("000000000".$tnextbanktxn_id, -9, 9));
		XTDTXT($displaybanktxn_sort);		
		XTDTXT($displaybanktxn_account);				
		XTDTXT($displaybanktxn_date);
		XTDTXT($displaybanktxn_type);		
		XTDTXT($displaybanktxn_description);
		print "<td align=right>\n";XTXT($displaybanktxn_debit);X_TD();
		print "<td align=right>\n";XTXT($displaybanktxn_credit);X_TD();
		if ( $GLOBALS{'recordupdateerror'} == "0" ) {
			XTDTXT('<font color="green"><b>OK</b></font>');
		} else {
			XTDTXT('<font color="red"><b>ERROR</b></font>'); $adduploaderror = "1";
		}
		X_TR();
		$tnextbanktxn_id++;
	}
 }
 X_TABLE();
	
 # ---- Pass 2 - update the database if there are no errors ------------------------------------------------

 if ( $adduploaderror == "0") {
  XH5("No Errors Found.");
  $recordindex = 0;
  $tnextbanktxn_id = $pnextbanktxn_id;
  foreach ($sortedbankfilea as $sortedbankfileelement) {
   $rbits = explode("|",$sortedbankfileelement);
   $recordindex++;
   if ($rbits[0] != "") {
    $GLOBALS{'recordupdateerror'} = "0";
    Initialise_Data('banktxn');
    $GLOBALS{'banktxn_id'} = "B".substr("000000000".$tnextbanktxn_id, -9, 9);
    $GLOBALS{'banktxn_processstatus'} = "raw";
    $GLOBALS{'banktxn_finstatus'} = "open";
    $GLOBALS{'banktxn_vatstatus'} = "open";
    $GLOBALS{'banktxn_bankuploadid'} = $_REQUEST["BankFileBankUploadId"];
    $GLOBALS{'banktxn_sort'} = IntegerDB($rbits[1],6);
    $GLOBALS{'banktxn_account'} = IntegerDB($rbits[2],8);
    $standarddate = DateFilter($rbits[3],"YYYYMMDD");
    $GLOBALS{'banktxn_date'} = DateDB($standarddate);
    $GLOBALS{'banktxn_txntype'} = IntegerDB($rbits[4],8);    
    $GLOBALS{'banktxn_description'} = TextDB($rbits[5]." ".$rbits[6]);
    if (strlen(strstr($rbits[7],"-"))>0) {
     $GLOBALS{'banktxn_debit'} = AmountDB($rbits[7]);
     $GLOBALS{'banktxn_credit'} = "";
    } else {
     $GLOBALS{'banktxn_debit'} = "";
     $GLOBALS{'banktxn_credit'} = AmountDB($rbits[7]);
    }
    if ($uploadrangestart >= $GLOBALS{'banktxn_id'}) { $uploadrangestart = $GLOBALS{'banktxn_id'}; }
    if ($uploadrangeend <= $GLOBALS{'banktxn_id'}) { $uploadrangeend = $GLOBALS{'banktxn_id'}; }
    if ($uploadperiodstart >= $GLOBALS{'banktxn_date'}) { $uploadperiodstart = $GLOBALS{'banktxn_date'}; }
    if ($uploadperiodend <= $GLOBALS{'banktxn_date'}) { $uploadperiodend = $GLOBALS{'banktxn_date'}; }
    # Write_Data('banktxn',$GLOBALS{'banktxn_id'});
    # XBR();XTXT($GLOBALS{'banktxn_id'}." updated");
    $tnextbanktxn_id++;
   }
  }
  $GLOBALS{'bankfile_bankid'} = $_REQUEST["BankFileBankId"];
  $GLOBALS{'bankfile_bankuploadid'} = $_REQUEST["BankFileBankUploadId"];
  $GLOBALS{'bankfile_comment'} = $_REQUEST["BankFileComment"];
  $GLOBALS{'bankfile_periodstart'} = $uploadperiodstart;
  $GLOBALS{'bankfile_periodend'} = $uploadperiodend;
  $GLOBALS{'bankfile_file'} = $puploadfilename;
  $GLOBALS{'bankfile_status'} = "uploaded";
  $GLOBALS{'bankfile_banktxnidrangestart'} = $uploadrangestart;
  $GLOBALS{'bankfile_banktxnidrangeend'} = $uploadrangeend;
  # Write_Data('bankfile',$GLOBALS{'bankfile_id'});
  # XBR();XTXT($GLOBALS{'bankfile_id'}." updated");
 }
 else {
  XH5("Errors found in Bank File.");
  XTXT('"'.$_FILES["BankFileFile"]["name"].'" - Not Saved');
  unlink($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$_FILES["BankFileFile"]["name"]);
  Delete_Data('bankfile',$GLOBALS{'bankfile_id'});
  XBR();XBR();
 }
}

?>

