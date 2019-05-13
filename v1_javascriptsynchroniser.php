<?php # javascriptdataprovider.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
if ($GLOBALS{'LOGIN_loginmode_id'} == "0") { Get_Data("person_".$GLOBALS{'LOGIN_service_id'},$GLOBALS{'LOGIN_person_id'}); }
Get_Person_Authority();

$traceinfocaptured = "0";
$traceinfostring = "";	
# INPUT
# DataRequestList = table1,table2[condition][condition][condition],table3
# Conditions
# [rootkey=val1] - records with this rootkey
# [fieldvalue=fieldname:val1+val2+val3] - selects field with any of these values
# [mergedkey=fieldname1+fieldname2] - rootkey for table1 is merged decomes 'vatrate_id+vatrate_dateeffective'
# [returnedfields=field1name+field2name+field3name],table3 - returns only selected fields - do not use for prime table ??? (why seems to work provided keys returned)
# [site=all] - returns information for all domains on site
# [site=unique] - single record at site level
# person table receives special treatment to preserve visibility rules
# OUTPUT
# tablex_keys|2^ - Number of keys in table
# tablex_rootkey|rootkeyvalue^ - Rootkey
# tablex_header|field1header|field2header|field3header^ - FieldNames returned
# tablex_data|field1value|field2value|field3value^ - FieldValues returned
# mergedkey - combines headers and keys with +

# DataRequestList = table1[site=all] - returns information for all domains on site
# DataRequestList = table1[fieldvalue=fieldname:val1+val2+val3],table2,table3 - only for selectfield values
# DataRequestList = table1[rootkey=val1],table2,table3 - rootkey for table 1 
# DataRequestList = table1[mergedkey=fieldname1+fieldname2],table2,table3 - rootkey for table1 is merged decomes 'vatrate_id/vatrate_dateeffective'
# DataRequestList = table1,table2[returnedfields=field1name+field2name+field3name],table3 - returns only selected fields
# Output Records = table3_data|field1|field2|field3^ -  
$datarequestlist = $_REQUEST["DataRequestList"];
# print $datarequestlist;
# $traceinfocaptured = "1";
# $traceinfostring = $datarequestlist."|";
$datarequestlista = explode(',', $datarequestlist);
$mergedkeyseparator = '+';;
$fieldvalueseparator = "+";
$returnedfieldseparator = "+";



foreach ($datarequestlista as $datarequestlistelement) {
 $normalaccessrequired = "1";
 $rootkeyrequired = "0";
 $rootkeyvalue = "";    	
 $fieldvaluerequired = "0";
 $fieldvaluea = Array();
 $fieldvaluefieldname = "";   
 $mergedkeyrequired = "0";
 $mergedkeyfields = Array();
 $returnedfieldsrequired = "0";
 $returnedfields = Array();
 $siteaccessrequired = "0";  

 if (strlen(strstr($datarequestlistelement,"["))>0) { # conditions have been specified
  $conditiona = explode('[', $datarequestlistelement);
  $dt = $conditiona[0];  
  $ci = 0; foreach ($conditiona as $tcondition) { $conditiona[$ci] = str_replace("]","",$tcondition); $ci++; }       
  foreach ($conditiona as $tcondition) {  
   $cfields = explode('=', $tcondition);

   if (strlen(strstr($tcondition,"rootkey="))>0) {
    # just one rootkeylevel in this implementation
   	# [rootkey=val1] - records woith this rootkey    
    $rootkeyrequired = "1";
    $normalaccessrequired = "0";
    $afields = explode('=', $tcondition);
    $rootkeyvalue = $afields[1];  	   
   }
   if (strlen(strstr($tcondition,"fieldvalue="))>0) {   	
   	# just one set of field values in this implementation - satisfies 'OR' logic
   	# [fieldvalue=fieldname:val1+val2+val3] - selects field with any of these values   		
    $fieldvaluerequired = "1"; 
    $afields = explode('=', $tcondition);
    $bfields = explode(':', $afields[1]);
    $fieldvaluefieldname = $bfields[0];
    $fieldvaluea = explode($fieldvalueseparator, $bfields[1]); 
   }
   $mergedkeyfields = Array();   
   if (strlen(strstr($tcondition,"mergedkey="))>0) {
   	# [mergedkey=fieldname1+fieldname2] - rootkey for table1 is merged decomes 'vatrate_id+vatrate_dateeffective'   	
    $mergedkeyrequired = "1";
    $normalaccessrequired = "0";   
    $afields = explode('=', $tcondition);
    $mergedkeyfields = explode($mergedkeyseparator, $afields[1]);
   }
   $returnedfields = Array();
   if (strlen(strstr($tcondition,"returnedfields="))>0) {
   	# [returnedfields=field1name+field2name+field3name],table3 - returns only selected fields   	
    $returnedfieldsrequired = "1";
    $afields = explode('=', $tcondition);   
    $returnedfields = explode($returnedfieldseparator, $afields[1]);
   }
   if (strlen(strstr($tcondition,"site="))>0) {
   	# [site=all] - returns information for all domains on site   	
    $siteaccessrequired = "1";
    $normalaccessrequired = "0";
   }   
   
  } 
 } else { # simple table situation
   $dt = $datarequestlistelement; 		
 }
 
 # ==== issue keys and fields for for database ============================================  
 if ($mergedkeyrequired == "1") { $tkeys = $GLOBALS{$dt."^KEYS"} -1;} else {$tkeys = $GLOBALS{$dt."^KEYS"};}
 $datastring = $dt."_keys|".$tkeys;
 print "$datastring"."^";
 if ($rootkeyrequired == "1") {
  $datastring = $dt."_rootkey|".$rootkeyvalue;
  print "$datastring"."^";
 }

 $tstring = $GLOBALS{$dt."^FIELDS"}; 
 $tfields = explode('|', $tstring);
 $datastring = $dt."_header";
 $mergedkeyindex = Array(0,0);
 $tfieldindex = 0;   
 foreach ($tfields as $tfieldelement) {
  if (($mergedkeyrequired == "1")&&($tfieldelement == $mergedkeyfields[0])) {  $mergedkeyindex[0] = $tfieldindex; }
  if (($mergedkeyrequired == "1")&&($tfieldelement == $mergedkeyfields[1])) {  $mergedkeyindex[1] = $tfieldindex; } 	
  if ($returnedfieldsrequired == "1") {
   foreach ($returnedfields as $returnedfieldelement) {
    if ($tfieldelement == $returnedfieldelement) {
     $datastring = $datastring."|".$tfieldelement;
    }
   }
  } else {
    $datastring = $datastring."|".$tfieldelement;
  } 	
  $tfieldindex++;  
 }
 if ($mergedkeyrequired == "1") {$datastring = str_replace($mergedkeyfields[0]."|".$mergedkeyfields[1],$mergedkeyfields[0].$mergedkeyseparator.$mergedkeyfields[1],$datastring);}
 print "$datastring"."^";

 # ==== issue data for database ============================================
 if ($normalaccessrequired == "1") { 
  if ($GLOBALS{$dt."^KEYS"} == 1) {$datakeya = Get_Array($dt."_");} // CHECK nasty 
  else {$datakeya = Get_Array($dt);}
 }
 if ($siteaccessrequired == "1") { $datakeya = Get_Array($dt."_"); }  	 
 if ($rootkeyrequired == "1") { $datakeya = Get_Array($dt,$rootkeyvalue); }
 if ($mergedkeyrequired == "1") { $datakeya = Get_Array_Mergedkey($dt,$mergedkeyfields[0],$mergedkeyfields[1]); } 

 sort($datakeya);
 foreach ($datakeya as $datakey) {
  $personrejected = "0";
  $recordselected = "0";  
  
  if ($normalaccessrequired == "1") { 
   if ($GLOBALS{$dt."^KEYS"} == 1) {Get_Data($dt."_".$datakey);}  // nasty  	
   else { 
   	Get_Data($dt,$datakey);
   	 
    if ($dt == "person") {
      # ------------------- special processing for person data ----------------------------------
      if ($GLOBALS{'person_email1'} == "") { $GLOBALS{'person_email1'} = $GLOBALS{'person_email3'} ;}	
      if (Person_Visibility_Test("view")) { 
      	# Person_Redaction_Filter(); 
      } else { $personrejected = "1"; }
      if ($datakey == "") { $personrejected = "1"; } 
    }
   }
  }
  if ($mergedkeyrequired == "1") {
   $mergedkeyvaluea = explode($mergedkeyseparator, $datakey);
   Get_Data($dt,$mergedkeyvaluea[0],$mergedkeyvaluea[1]);
  }  
  if ($siteaccessrequired == "1") { Get_Data($dt."_".$datakey); }  	 
  if ($rootkeyrequired == "1") { Get_Data($dt,$rootkeyvalue,$datakey); }  

  if ($fieldvaluerequired == "1") {
   foreach ($fieldvaluea as $fieldvalue) {
   	if ($GLOBALS{$fieldvaluefieldname} == $fieldvalue) {$recordselected = "1"; }
   }	 	 	
  } 
  else {  $recordselected = "1"; } 
  
  if (($recordselected == "1")&&($personrejected == "0")) {
   $datastring = $dt."_data";
   $tfieldindex = 0; 
   foreach ($tfields as $tfieldelement) {
   	if ($returnedfieldsrequired == "1") {
     foreach ($returnedfields as $returnedfieldelement) {
      if ($tfieldelement == $returnedfieldelement) { $datastring = $datastring."|".$GLOBALS{$tfieldelement}; }
     }      	
   	} else {
     if (($mergedkeyrequired == "1")&&($tfieldindex == $mergedkeyindex[1])) { $datastring = $datastring.$mergedkeyseparator.$GLOBALS{$tfieldelement}; }
     else { $datastring = $datastring."|".$GLOBALS{$tfieldelement}; }      		
   	}
    $tfieldindex++;
   }
   print "$datastring"."^"; 
  }    
 }
}
if ($traceinfocaptured == "1") {     print "trace_info|".$traceinfostring."^"; 


}
?>