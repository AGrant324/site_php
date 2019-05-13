<?php # finallocatewizard.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$companya = Get_Array_Hash('company');
$company_name = $companya[0];
Get_Data('company',$company_name);

$wizaction = $_REQUEST["WizAction"];
$actiontaken = "0";


if ($wizaction == "propose") {
 print "openingtext"."|"."Action Requested: Make any new allocation proposals"."^";
 $noactionmessage = "No new proposals found to make"; 		
 $banktxna = Get_Array('banktxn');
 $processedbanktxna = array(); 
 foreach ($banktxna as $banktxn_id) {  
  Get_Data('banktxn',$banktxn_id);
  if (($GLOBALS{'banktxn_processstatus'} == "submitted")||($GLOBALS{'banktxn_processstatus'} == "allocated")) {
   array_push($processedbanktxna, $banktxn_id);
  }
 }	
 $revprocessedbanktxna = array_reverse($processedbanktxna);	
 foreach ($banktxna as $thisbanktxn_id) {  
  Get_Data('banktxn',$thisbanktxn_id);
  if ($GLOBALS{'banktxn_processstatus'} == "raw") {
   $thisbanktxn_description = $GLOBALS{'banktxn_description'};
   $found = "0";    
   $thatbanktxnindex = 0;
   while (($found == "0")&&($thatbanktxnindex < sizeof($revprocessedbanktxna))) { 
    $thatbanktxn_id = $revprocessedbanktxna[$thatbanktxnindex];
   	Get_Data('banktxn',$thatbanktxn_id);
    // print ($thisbanktxn_description."!".$GLOBALS{'banktxn_description'}."<br>"); 
    if ( Match($thisbanktxn_description, $GLOBALS{'banktxn_description'}) ) {  
     $found = "1"; $actiontaken = "1";    		
     $thisbanktxn_purpose = $GLOBALS{'banktxn_purpose'};
     $thisbanktxn_txnfavouriteid = $GLOBALS{'banktxn_txnfavouriteid'};
     $thisbanktxn_comment = $GLOBALS{'banktxn_comment'};
     $thisbanktxn_supplierid = $GLOBALS{'banktxn_supplierid'};
     $thisbanktxn_paymenttype = $GLOBALS{'banktxn_paymenttype'};
     $thisbanktxn_vatrateid = $GLOBALS{'banktxn_vatrateid'};
     $thisbanktxn_vat = $GLOBALS{'banktxn_vat'};
     $thisbanktxn_customerid = $GLOBALS{'banktxn_customerid'};     
     $thisbanktxn_fincategoryid = $GLOBALS{'banktxn_fincategoryid'};
     $thisbanktxn_jobid = $GLOBALS{'banktxn_jobid'}; 

     if (($thisbanktxn_txnfavouriteid != "")&&
        ($thisbanktxn_vatrateid != "")&&     
        ($thisbanktxn_vatrateid != "")&&
        ($thisbanktxn_fincategoryid != "")) {
      Get_Data('banktxn',$thisbanktxn_id);        
      $GLOBALS{'banktxn_processstatus'} = "proposed";  	 		
      $GLOBALS{'banktxn_purpose'} = $thisbanktxn_purpose;
      $GLOBALS{'banktxn_txnfavouriteid'} = $thisbanktxn_txnfavouriteid;
      $GLOBALS{'banktxn_comment'} = $thisbanktxn_comment;
      $GLOBALS{'banktxn_supplierid'} = $thisbanktxn_supplierid;
      $GLOBALS{'banktxn_paymenttype'} = $thisbanktxn_paymenttype;
      $GLOBALS{'banktxn_vatrateid'} = $thisbanktxn_vatrateid;
      $GLOBALS{'banktxn_vat'} = $thisbanktxn_vat;
      $GLOBALS{'banktxn_fincategoryid'} = $thisbanktxn_fincategoryid;     
      $GLOBALS{'banktxn_customerid'} = $thisbanktxn_customerid;
      $GLOBALS{'banktxn_jobid'} = $thisbanktxn_jobid;
      Write_Data('banktxn',$thisbanktxn_id); 

      print "data|".$GLOBALS{'banktxn_id'}."|".
      $GLOBALS{'banktxn_date'}."|".$GLOBALS{'banktxn_txntype'}."|".$GLOBALS{'banktxn_description'}."|".
      $GLOBALS{'banktxn_debit'}."|".$GLOBALS{'banktxn_credit'}."|"."Proposed as ".$GLOBALS{'banktxn_txnfavouriteid'}."^";  
     }     
    }
    $thatbanktxnindex++;
   }
  }
 } 
}

if ($wizaction == "confirm") {
 print "openingtext"."|"."Action Requested: Confirm all existing allocation proposals"."^";
 $noactionmessage = "No proposals found to confirm";  		
 $banktxna = Get_Array('banktxn');
 foreach ($banktxna as $banktxn_id) {
  Get_Data('banktxn',$banktxn_id);
  if ($GLOBALS{'banktxn_processstatus'} == "proposed") {
   $actiontaken = "1";        	 		
   $GLOBALS{'banktxn_processstatus'} = "allocated";  	
   Write_Data('banktxn',$banktxn_id);

     print "data|".$GLOBALS{'banktxn_id'}."|".
   $GLOBALS{'banktxn_date'}."|".$GLOBALS{'banktxn_txntype'}."|".$GLOBALS{'banktxn_description'}."|".
   $GLOBALS{'banktxn_debit'}."|".$GLOBALS{'banktxn_credit'}."|"."Confirmed as ".$GLOBALS{'banktxn_txnfavouriteid'}."^";;    
  }
 }
}

if ($wizaction == "reject") {
 print "openingtext"."|"."Action Requested: Reject all existing allocation proposals"."^";
 $noactionmessage = "No proposals found to reject";  	 			
 $banktxna = Get_Array('banktxn');
 foreach ($banktxna as $banktxn_id) {
  Get_Data('banktxn',$banktxn_id);
  if ($GLOBALS{'banktxn_processstatus'} == "proposed") {
   $actiontaken = "1";          	
   $GLOBALS{'banktxn_processstatus'} = "raw";  	 		
   $GLOBALS{'banktxn_purpose'} = "";
   $GLOBALS{'banktxn_txnfavouriteid'} = "";
   $GLOBALS{'banktxn_txnfavouriteid'} = "";
   $GLOBALS{'banktxn_txnfavouriteid'} = "";
   $GLOBALS{'banktxn_txnfavouriteid'} = "";
   $GLOBALS{'banktxn_comment'} = "";
   $GLOBALS{'banktxn_supplierid'} = "";
   $GLOBALS{'banktxn_paymenttype'} = "";
   $GLOBALS{'banktxn_vatrateid'} = "";
   $GLOBALS{'banktxn_vat'} = "";
   $GLOBALS{'banktxn_fincategoryid'} = "";   
   $GLOBALS{'banktxn_customerid'} = "";
   $GLOBALS{'banktxn_jobid'} = "";
   Write_Data('banktxn',$banktxn_id);
   print "data|".$GLOBALS{'banktxn_id'}."|".
   $GLOBALS{'banktxn_date'}."|".$GLOBALS{'banktxn_txntype'}."|".$GLOBALS{'banktxn_description'}."|".
   $GLOBALS{'banktxn_debit'}."|".$GLOBALS{'banktxn_credit'}."|"."Previous Proposal Rejected"."^"; 
  }
 }
}
if ($actiontaken == "0") { print "closingtext"."|".$noactionmessage."|".""."^"; }

function Match ($source, $target) {
 // input: strings to comnpare - output: true or false depending on allocation comparison rules
 // print ($source."|".$target."\n");
 $sourcea = str_replace(" ","",$source);
 $sourceb = str_replace(".","",$sourcea);
 $sourcestr = $sourceb;
 $sourcelen = strlen($sourcestr);
 $targeta = str_replace(" ","",$target);
 $targetb = str_replace(".","",$targeta);
 $targetstr = $targetb;
 $targetlen = strlen($targetstr);
 $maxlen = $sourcelen;
 if ($targetlen > $sourcelen) { $maxlen = $targetlen; }
 // print ($sourcestr."|".$targetstr."|".$maxlen."\n");
 $sourcechar = "";  $targetchar = "";
 $matchedchars = 0; $unmatchedchars = 0;
 $matchmin = 10;
 if ($GLOBALS{'company_matchminallocate'} != "") { $matchmin = floatval($GLOBALS{'company_matchminallocate'}); }
 $nomatchmax = 4;
 if ($GLOBALS{'company_nomatchmaxallocate'} != "") { $nomatchmax = floatval($GLOBALS{'company_nomatchmaxallocate'}); }
 for ($ci=1; $ci<=$maxlen; $ci++) {
  if ($ci > $sourcelen) { $sourcechar = "!"; } else { $sourcechar = substr($sourcestr, $ci, 1); }
  if ($ci > $targetlen) { $targetchar = "!"; } else { $targetchar = substr($targetstr, $ci, 1); }
  if ($sourcechar == $targetchar) { $matchedchars++; } 
  else {$unmatchedchars++;} 
 }
 // print ($matchedchars."|".$unmatchedchars."\n");
 $result = false;
 if (($matchedchars >= $matchmin)||($unmatchedchars == 0)) { $result = true; }
 if ($unmatchedchars > $nomatchmax) { $result = false; }
 return $result;
}


?>


