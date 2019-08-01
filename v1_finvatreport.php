<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$GLOBALS{'extracttransactiona'} = Array();                

$GLOBALS{'capture_id'} = "";
$GLOBALS{'capture_txnfavouriteid'} = "";
$GLOBALS{'capture_customersupplierid'} = "";
$GLOBALS{'capture_fincategoryid'} = "";
$GLOBALS{'capture_date'} = "";
$GLOBALS{'capture_description'} = "";
$GLOBALS{'capture_debit'} = "";
$GLOBALS{'capture_credit'} = "";
$GLOBALS{'capture_vatrateid'} = "";
$GLOBALS{'capture_vat'} = "";
$GLOBALS{'capture_paymenttype'} = "";

$GLOBALS{'extract_vatreportsection'} = "";
$GLOBALS{'extract_id'} = "";
$GLOBALS{'extract_txnfavouriteid'} = "";
$GLOBALS{'extract_customersupplierid'} = "";
$GLOBALS{'extract_fincategoryid'} = "";
$GLOBALS{'extract_date'} = "";
$GLOBALS{'extract_description'} = "";
$GLOBALS{'extract_debit'} = "";
$GLOBALS{'extract_credit'} = "";
$GLOBALS{'extract_vatrateid'} = "";
$GLOBALS{'extract_vat'} = "";
$GLOBALS{'extract_paymenttype'} = "";
 
$GLOBALS{'$in_startdate'} = $_REQUEST["StartDate_YYYYpart"]."-".$_REQUEST["StartDate_MMpart"]."-".$_REQUEST["StartDate_DDpart"];  
$GLOBALS{'$in_enddate'} = $_REQUEST["EndDate_YYYYpart"]."-".$_REQUEST["EndDate_MMpart"]."-".$_REQUEST["EndDate_DDpart"];
$GLOBALS{'$in_trace'} = $_REQUEST['Trace'];

XH1("VAT Report");
XPTXT("A downloadable summary report and a detailed transaction file is also created by this process");  
	
BankTxn_VAT_Capture();
CashTxn_VAT_Capture();
MileageTxn_VAT_Capture();
PayrollTxn_VAT_Capture();
HomeOfficeTxn_VAT_Capture();
SalesInvoice_VAT_Capture();
PurchaseInvoice_VAT_Capture();

VATReportCreate(); 

XBR();XBR();
Back_Navigator();
PageFooter("Default","Final");


# ==================================  IRIS Routines ================================

function  BankTxn_VAT_Capture() {
 $banktxna = Get_Array('banktxn');
 foreach ($banktxna as $banktxn_id) {
  Get_Data('banktxn',$banktxn_id);
  if (($GLOBALS{'banktxn_date'} >= $GLOBALS{'$in_startdate'})
  &&($GLOBALS{'banktxn_date'} <= $GLOBALS{'$in_enddate'})) {
   
   $GLOBALS{'capture_id'} = $GLOBALS{'banktxn_id'};
   $GLOBALS{'capture_txnfavouriteid'} = $GLOBALS{'banktxn_txnfavouriteid'};
   $GLOBALS{'capture_customersupplierid'} = $GLOBALS{'banktxn_supplierid'}.$GLOBALS{'banktxn_customerid'};
   $GLOBALS{'capture_fincategoryid'} = $GLOBALS{'banktxn_fincategoryid'};
   $GLOBALS{'capture_date'} = $GLOBALS{'banktxn_date'};
   $GLOBALS{'capture_description'} = str_replace(",","",$GLOBALS{'banktxn_description'});
   $GLOBALS{'capture_debit'} = $GLOBALS{'banktxn_debit'};
   $GLOBALS{'capture_credit'} = $GLOBALS{'banktxn_credit'};
   $GLOBALS{'capture_vatrateid'} = $GLOBALS{'banktxn_vatrateid'};
   $GLOBALS{'capture_vat'} = $GLOBALS{'banktxn_vat'};
   $GLOBALS{'capture_paymenttype'} = $GLOBALS{'banktxn_paymenttype'};
   VATTransactionExtract();
   TracePrint($GLOBALS{'banktxn_id'}." PROCESSED");
  }
  else {TracePrint($GLOBALS{'banktxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED"); }
 }
}

function  CashTxn_VAT_Capture(){
 $cashtxna = Get_Array('cashtxn');
 foreach ($cashtxna as $cashtxn_id) {
  Get_Data('cashtxn',$cashtxn_id);
  if (($GLOBALS{'cashtxn_date'} >= $GLOBALS{'$in_startdate'})
     &&($GLOBALS{'cashtxn_date'} <= $GLOBALS{'$in_enddate'})) {

   $GLOBALS{'capture_id'} = $GLOBALS{'banktxn_id'};
   $GLOBALS{'capture_txnfavouriteid'} = $GLOBALS{'cashtxn_txnfavouriteid'};
   $GLOBALS{'capture_customersupplierid'} = $GLOBALS{'cashtxn_supplierid'}.$GLOBALS{'cashtxn_customerid'};
   $GLOBALS{'capture_fincategoryid'} = $GLOBALS{'cashtxn_fincategoryid'};
   $GLOBALS{'capture_date'} = $GLOBALS{'cashtxn_date'};
   $GLOBALS{'capture_description'} = str_replace(",","",$GLOBALS{'cashtxn_description'});
   $GLOBALS{'capture_debit'} = $GLOBALS{'cashtxn_debit'};
   $GLOBALS{'capture_credit'} = $GLOBALS{'cashtxn_credit'};
   $GLOBALS{'capture_vatrateid'} = $GLOBALS{'cashtxn_vatrateid'};
   $GLOBALS{'capture_vat'} = $GLOBALS{'cashtxn_vat'};
   $GLOBALS{'capture_paymenttype'} = $GLOBALS{'cashtxn_paymenttype'};  
   VATTransactionExtract();
   TracePrint($GLOBALS{'cashtxn_id'}." PROCESSED");   
  } 
  else {TracePrint($GLOBALS{'cashtxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");  }
 } 
}


function  MileageTxn_VAT_Capture(){

 $mileagetxna = Get_Array('mileagetxn');
 $persona = Get_Array('person'); 
 foreach ($persona as $person_id) {
  foreach ($mileagetxna as $mileagetxn_id) {
   Get_Data('mileagetxn',$mileagetxn_id);
   # print $mileagetxn_id." ".$person_id." READ "."<br>\n";
   if ($GLOBALS{'mileagetxn_personid'} == $person_id) {   
    if (($GLOBALS{'mileagetxn_date'} >= $GLOBALS{'$in_startdate'})
       &&($GLOBALS{'mileagetxn_date'} <= $GLOBALS{'$in_enddate'})) {
     
     Get_Data_Hash_DateEffective('mileageparm',"Miles",$GLOBALS{'mileagetxn_date'});
     Get_Data_Hash_DateEffective('fuelparm', $GLOBALS{'mileagetxn_fuelparmenginetype'}, $GLOBALS{'mileagetxn_date'});
     Get_Data_Hash_DateEffective('vatrate',"T1",$GLOBALS{'mileagetxn_date'});
      
     $mileagerate = floatval($GLOBALS{'mileageparm_rate'});
     $mileageratevatable = floatval($GLOBALS{'fuelparm_rate'});
     $mileagevatrate = floatval($GLOBALS{'vatrate_rate'});
     $journeyqty = floatval($GLOBALS{'mileagetxn_journeyqty'});
     if ( $journeyqty == 0 ) { $journeyqty = 1; }
     $mileagetotal = floatval($GLOBALS{'mileagetxn_distance'})*$journeyqty;
     $paymenttotal = $mileagetotal * $mileagerate;
     $paymentvatpart = $mileagetotal * $mileageratevatable;
     $paymentnonvatpart = $paymenttotal - $paymentvatpart;
     $vatpayable = $paymentvatpart / (1 + (100 / ($mileagevatrate)));    
     
     $GLOBALS{'capture_id'} = $GLOBALS{'mileagetxn_id'};
     $GLOBALS{'capture_txnfavouriteid'} = "";
     $GLOBALS{'capture_customersupplierid'} = "";
     $GLOBALS{'capture_fincategoryid'} = "F181";
     $GLOBALS{'capture_date'} = $GLOBALS{'mileagetxn_date'};
     $GLOBALS{'capture_description'} = $person_id." ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'$in_startdate'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'$in_enddate'});   
     $GLOBALS{'capture_debit'} = sprintf("%.2f",$paymenttotal);
     $GLOBALS{'capture_credit'} = "";
     $GLOBALS{'capture_vatrateid'} = "T1";
     $GLOBALS{'capture_vat'} = sprintf("%.2f",$paymentvatpart);
     $GLOBALS{'capture_paymenttype'} = "";
     VATTransactionExtract();
     $GLOBALS{'capture_fincategoryid'} = "F605";     
     VATTransactionExtract();     

     TracePrint($mileagetxn_id." ".$person_id." PROCESSED");
    }
    else {TracePrint($mileagetxn_id." ".$person_id." OUTSIDE RANGE / ALREADY SUBMITTED"); }    
   }
  }
 }
}

function  PayrollTxn_VAT_Capture(){

 $payrolltxna = Get_Array('payrolltxn');
 $persona = Get_Array('person');
 foreach ($persona as $person_id) {
  Get_Data('person',$person_id); 	 
  foreach ($payrolltxna as $payrolltxn_id) {
   Get_Data('payrolltxn',$payrolltxn_id);
   # print $payrolltxn_id." ".$person_id." READ "."<br>\n";
   if ($GLOBALS{'payrolltxn_personid'} == $person_id) { 	       
    if (($GLOBALS{'payrolltxn_periodend'} >= $GLOBALS{'$in_startdate'})
       &&($GLOBALS{'payrolltxn_periodend'} <= $GLOBALS{'$in_enddate'})) {

     $grossnum = floatval($GLOBALS{'payrolltxn_gross'}); 
     $incometaxnum = floatval($GLOBALS{'payrolltxn_incometax'});
     $employeesNICnum = floatval($GLOBALS{'payrolltxn_employeesNIC'});
     $employersNICnum = floatval($GLOBALS{'payrolltxn_employersNIC'});
     $netnum = $grossnum - $incometaxnum - $employeesNICnum; 
  
     if ($GLOBALS{'person_director'} == "Director") { $payrollfincategory_id = "F166"; } # Director
     else { 
      if ($GLOBALS{'person_labourtype'} == "Direct") { $payrollfincategory_id = "F162"; } # Direct Labour
      else { $payrollfincategory_id = "F164"; } # InDirect Labour    i.e. staff
     }
     $GLOBALS{'capture_id'} = $GLOBALS{'payrolltxn_id'};
     $GLOBALS{'capture_txnfavouriteid'} = "";
     $GLOBALS{'capture_customersupplierid'} = "";
     $GLOBALS{'capture_fincategoryid'} = $payrollfincategory_id;
     $GLOBALS{'capture_date'} = $GLOBALS{'payrolltxn_periodend'};
     $GLOBALS{'capture_description'} = $person_id." "."Gross Salary - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});   
     $GLOBALS{'capture_debit'} = sprintf("%.2f",$grossnum);
     $GLOBALS{'capture_credit'} = "";
     $GLOBALS{'capture_vatrateid'} = "T9";
     $GLOBALS{'capture_vat'} = "";
     $GLOBALS{'capture_paymenttype'} = "";
     VATTransactionExtract();
     TracePrint($payrolltxn_id." ".$person_id." PROCESSED");
    }
    else {TracePrint($payrolltxn_id." ".$person_id." OUTSIDE RANGE / ALREADY SUBMITTED"); }
   }
  }
 }
}


function  HomeOfficeTxn_VAT_Capture(){	
Check_Data('homeoffice',"Home"); 
if ($GLOBALS{'IOWARNING'} == "0") { 
 $roomspercentage = floatval($GLOBALS{'homeoffice_percentage'});
 $homeofficetxna = Get_Array('homeofficetxn');
 foreach ($homeofficetxna as $homeofficetxn_id) {    
  Get_Data('homeofficetxn',$homeofficetxn_id); 
  if (($GLOBALS{'homeofficetxn_periodend'} >= $GLOBALS{'$in_startdate'})
     &&($GLOBALS{'homeofficetxn_periodend'} <= $GLOBALS{'$in_enddate'})) {
   
   $insurancehome = floatval($GLOBALS{'homeofficetxn_insurancehome'});
   $counciltaxhome = floatval($GLOBALS{'homeofficetxn_counciltaxhome'});
   $mortgagehome = floatval($GLOBALS{'homeofficetxn_mortgagehome'});
   $renthome = floatval($GLOBALS{'homeofficetxn_renthome'});
   $maintenancehome = floatval($GLOBALS{'homeofficetxn_maintenancehome'});
   $utilitieshome = floatval($GLOBALS{'homeofficetxn_utilitieshome'});
   $telephonehome = floatval($GLOBALS{'homeofficetxn_telephonehome'});
   $broadbandhome = floatval($GLOBALS{'homeofficetxn_broadbandhome'});
   $waterhome = floatval($GLOBALS{'homeofficetxn_waterhome'});
   $totalhome = $insurancehome+$counciltaxhome+$mortgagehome+$renthome+$maintenancehome+$utilitieshome+$telephonehome+$broadbandhome+$waterhome;
   $homeofficeexpenses = $totalhome * $roomspercentage / 100;
     
   $GLOBALS{'capture_id'} = $GLOBALS{'homeofficetxn_id'};
   $GLOBALS{'capture_txnfavouriteid'} = "";
   $GLOBALS{'capture_customersupplierid'} = "";
   $GLOBALS{'capture_fincategoryid'} = "F155";
   $GLOBALS{'capture_date'} = $GLOBALS{'homeofficetxn_periodend'};
   $GLOBALS{'capture_description'} = $GLOBALS{'homeofficetxn_periodstart'}." to ".$GLOBALS{'homeofficetxn_periodend'}; 
   $GLOBALS{'capture_debit'} = sprintf("%.2f",$homeofficeexpenses);
   $GLOBALS{'capture_credit'} = "";
   $GLOBALS{'capture_vatrateid'} = "T9";
   $GLOBALS{'capture_vat'} = "";
   $GLOBALS{'capture_paymenttype'} = "";
   VATTransactionExtract();
   TracePrint($GLOBALS{'homeofficetxn_id'}." ".$homeofficeexpenses." PROCESSED");      
  } 
  else { TracePrint($GLOBALS{'homeofficetxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED"); }
 }
}
}

function  SalesInvoice_VAT_Capture(){ 
 # SalesInvoice	I586	85		I1 to 10	-85
 $salesinvoicea = Get_Array('salesinvoice');
 foreach ($salesinvoicea as $salesinvoice_id) {
  Get_Data('salesinvoice',$salesinvoice_id);
  if (($GLOBALS{'salesinvoice_date'} >= $GLOBALS{'$in_startdate'})
     &&($GLOBALS{'salesinvoice_date'} <= $GLOBALS{'$in_enddate'})) { 

   $GLOBALS{'capture_id'} = $GLOBALS{'salesinvoice_id'};
   $GLOBALS{'capture_txnfavouriteid'} = "";
   $GLOBALS{'capture_customersupplierid'} = $GLOBALS{'salesinvoice_customerid'};;
   $GLOBALS{'capture_fincategoryid'} = $GLOBALS{'salesinvoice_fincategoryid'};
   $GLOBALS{'capture_date'} = $GLOBALS{'salesinvoice_date'};
   $GLOBALS{'capture_description'} = $GLOBALS{'salesinvoice_description'};
   $GLOBALS{'capture_debit'} = $GLOBALS{'salesinvoice_gross'};
   $GLOBALS{'capture_credit'} = "";
   $GLOBALS{'capture_vatrateid'} =  $GLOBALS{'salesinvoice_vatrateid'};
   $GLOBALS{'capture_vat'} = $GLOBALS{'salesinvoice_vat'};
   $GLOBALS{'capture_paymenttype'} = "Account";
   VATTransactionExtract();
   TracePrint($GLOBALS{'salesinvoice_id'}." PROCESSED AS TRIAL");   
  }
  else {TracePrint($GLOBALS{'salesinvoice_id'}." OUTSIDE RANGE / ALREADY SUBMITTED"); }
 }
}

function  PurchaseInvoice_VAT_Capture(){
 # PurchaseInvoice	Ixxxxx	75		I737	-75

 $purchaseinvoicea = Get_Array('purchaseinvoice');
 foreach ($purchaseinvoicea as $purchaseinvoice_id) {
  Get_Data('purchaseinvoice',$purchaseinvoice_id);
  if (($GLOBALS{'purchaseinvoice_date'} >= $GLOBALS{'$in_startdate'})
     &&($GLOBALS{'purchaseinvoice_date'} <= $GLOBALS{'$in_enddate'})) {
   $GLOBALS{'capture_id'} = $GLOBALS{'purchaseinvoice_id'};
   $GLOBALS{'capture_txnfavouriteid'} = "";
   $GLOBALS{'capture_customersupplierid'} = $GLOBALS{'purchaseinvoice_supplierid'};;
   $GLOBALS{'capture_fincategoryid'} = $GLOBALS{'purchaseinvoice_fincategoryid'};
   $GLOBALS{'capture_date'} = $GLOBALS{'purchaseinvoice_date'};
   $GLOBALS{'capture_description'} = $GLOBALS{'purchaseinvoice_description'};
   $GLOBALS{'capture_debit'} = "";
   $GLOBALS{'capture_credit'} = $GLOBALS{'purchaseinvoice_gross'};
   $GLOBALS{'capture_vatrateid'} =  $GLOBALS{'purchaseinvoice_vatrateid'};
   $GLOBALS{'capture_vat'} = $GLOBALS{'purchaseinvoice_vat'};
   $GLOBALS{'capture_paymenttype'} = "Account";
   VATTransactionExtract();
   TracePrint($GLOBALS{'purchaseinvoice_id'}." PROCESSED AS TRIAL");   	
  }
  else {TracePrint($GLOBALS{'purchaseinvoice_id'}." OUTSIDE RANGE / ALREADY SUBMITTED"); }
 }
}
  
function  VATTransactionExtract() {

 $GLOBALS{'extract_vatreportsection'} = "";
 $GLOBALS{'extract_id'} = $GLOBALS{'capture_id'};
 $GLOBALS{'extract_txnfavouriteid'} = $GLOBALS{'capture_txnfavouriteid'};
 $GLOBALS{'extract_customersupplierid'} = $GLOBALS{'capture_customersupplierid'};
 $GLOBALS{'extract_fincategoryid'} = $GLOBALS{'capture_fincategoryid'};
 $GLOBALS{'extract_date'} = $GLOBALS{'capture_date'};
 $GLOBALS{'extract_description'} = $GLOBALS{'capture_description'};
 $GLOBALS{'extract_debit'} = $GLOBALS{'capture_debit'};
 $GLOBALS{'extract_credit'} = $GLOBALS{'capture_credit'};
 $GLOBALS{'extract_vatrateid'} = $GLOBALS{'capture_vatrateid'};
 $GLOBALS{'extract_vat'} = $GLOBALS{'capture_vat'};
 $GLOBALS{'extract_paymenttype'} = $GLOBALS{'capture_paymenttype'};
 
 $GLOBALS{'extract_vatreportsection'} = "NonVAT";
 if (($GLOBALS{'extract_fincategoryid'} >= "F100")&&($GLOBALS{'extract_fincategoryid'} <= "F299")) { $GLOBALS{'extract_vatreportsection'} = "7-".$GLOBALS{'extract_vatrateid'}; }
 if (($GLOBALS{'extract_fincategoryid'} >= "F300")&&($GLOBALS{'extract_fincategoryid'} <= "F399")) { $GLOBALS{'extract_vatreportsection'} = "6-".$GLOBALS{'extract_vatrateid'}; }
 if ($GLOBALS{'extract_vatrateid'} == "T9") {  $GLOBALS{'extract_vatreportsection'} = "NonVAT-T9"; }
 if ($GLOBALS{'extract_fincategoryid'} == "") { $GLOBALS{'extract_vatreportsection'} = "UnAllocated"; } 
 
 $datastring = $GLOBALS{'extract_vatreportsection'};
 $datastring = $datastring.",".$GLOBALS{'extract_id'};
 $datastring = $datastring.",".$GLOBALS{'extract_txnfavouriteid'};
 $datastring = $datastring.",".$GLOBALS{'extract_customersupplierid'};
 $datastring = $datastring.",".$GLOBALS{'extract_fincategoryid'};
 $datastring = $datastring.",".$GLOBALS{'extract_date'};
 $datastring = $datastring.",".$GLOBALS{'extract_description'};
 $datastring = $datastring.",".$GLOBALS{'extract_debit'};
 $datastring = $datastring.",".$GLOBALS{'extract_credit'};
 $datastring = $datastring.",".$GLOBALS{'extract_vatrateid'};
 $datastring = $datastring.",".$GLOBALS{'extract_vat'};
 $datastring = $datastring.",".$GLOBALS{'extract_paymenttype'}."\n";
 array_push($GLOBALS{'extracttransactiona'}, $datastring);
}

function VATReportCreate() {
 
 $vatsectionarray = Array(0,0,0,0,0,0,0,0,0,0); 
 
 $stransactiona = $GLOBALS{'extracttransactiona'};
 sort($stransactiona);
 $VDFile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/"."VATDetailReport.csv";
 $filehandle = fopen($VDFile, 'w');
 $reportsection = 0;
 $firstsale = "1"; $firstpurchase = "1"; $firstpurchase = "1"; $firstnonvat = "1"; $firstnonvatt9 = "1"; $firstunallocated = "1";
 
 
 
 foreach ($stransactiona as $stransaction) {
  TracePrint($stransaction);
  $bits = explode(',',$stransaction);  
  $bitsa = explode('-',$bits[0]);  
  if ($bitsa[0] == "6") {
   if ($firstsale == "1") {fwrite($filehandle, "SALES"."\n"); $firstsale = "0";}
   $vatsectionarray[6] = $vatsectionarray[6] - floatval($bits[7]) + floatval($bits[8]) - floatval($bits[10]); 
   $vatsectionarray[1] = $vatsectionarray[1] + floatval($bits[10]);
   $reportsection = 0;     
  }
  if ($bitsa[0] == "7") {
   if ($reportsection == 0) {
    fwrite($filehandle, ",,,,,,,,,,,,".sprintf("%.2f",$vatsectionarray[6]).","."Total value of sales - excluding VAT"."\n");    
    fwrite($filehandle, ",,,,,,,,,,,,".sprintf("%.2f",$vatsectionarray[1]).","."VAT due in this period on sales"."\n");    
   }
   if ($firstpurchase == "1") { fwrite($filehandle, "PURCHASES"."\n"); $firstpurchase = "0";}
   $vatsectionarray[7] = $vatsectionarray[7] + floatval($bits[7]) - floatval($bits[8]) - floatval($bits[10]); 
   $vatsectionarray[4] = $vatsectionarray[4] + floatval($bits[10]);
   $reportsection = 1;       
  }
  if ($bitsa[0] == "NonVAT") { if ($reportsection == 1) {
    fwrite($filehandle, ",,,,,,,,,,,,".sprintf("%.2f",$vatsectionarray[7]).","."Total value of purchases - excluding VAT"."\n");    
    fwrite($filehandle, ",,,,,,,,,,,,".sprintf("%.2f",$vatsectionarray[4]).","."VAT reclaimed in this period on purchases"."\n");
   	if ($firstnonvat == "0") {	fwrite($filehandle, "NON-VATABLE"."\n"); $firstnonvat = "0";  }       
   } 
   $reportsection = 2;   
  }
  if ($bitsa[0] == "NonVAT-T9") {
   if ($reportsection == 2) {
    fwrite($filehandle, "\n");
    fwrite($filehandle, "\n");     
   }
   if ($firstnonvatt9 == "1") { 	fwrite($filehandle, "NON-VATT9"."\n"); $firstnonvatt9 = "0";   }
   $reportsection = 3;
  }
  if ($bitsa[0] == "UnAllocated") {
  	if ($reportsection == 3) {
  		fwrite($filehandle, "\n");
  		fwrite($filehandle, "\n");
  	}
  	if ($firstunallocated == "1") {	fwrite($filehandle, "UNALLOCATED"."\n"); $firstunallocated = "0";	}
  	$reportsection = 4;
  }  
  fwrite($filehandle, $stransaction);  
 }
 fclose($filehandle);

 $vatsectionarray[3] = $vatsectionarray[1] + $vatsectionarray[2];
 $vatsectionarray[3] = $vatsectionarray[1] - $vatsectionarray[4]; 
 
 XTABLE(); 
 XTR();XTDTXT("VAT due in this period on sales");XTDTXT("1");XTDTXT(sprintf("%.2f",$vatsectionarray[1]));X_TR();
 XTR();XTDTXT("VAT due in this period on EC acquisition");XTDTXT("2");XTDTXT(sprintf("%.2f",$vatsectionarray[2]));X_TR();
 XTR();XTDTXT("Total VAT due (sum of boxes 1 and 2)");XTDTXT("3");XTDTXT(sprintf("%.2f",$vatsectionarray[3]));X_TR(); 
 XTR();XTDTXT("VAT reclaimed in this period on purchases");XTDTXT("4");XTDTXT(sprintf("%.2f",$vatsectionarray[4]));X_TR(); 
 XTR();XTDTXT("Net VAT to be paid to Customs or reclaimed by you");XTDTXT("5");XTDTXT(sprintf("%.2f",$vatsectionarray[5]));X_TR(); 
 XTR();XTDTXT("Total value of sales, excluding VAT");XTDTXT("6");XTDTXT(sprintf("%.2f",$vatsectionarray[6]));X_TR(); 
 XTR();XTDTXT("Total value of purchases, excluding VAT");XTDTXT("7");XTDTXT(sprintf("%.2f",$vatsectionarray[7]));X_TR();
 XTR();XTDTXT("Total value of EC sales, excluding VAT");XTDTXT("8");XTDTXT(sprintf("%.2f",$vatsectionarray[8]));X_TR();
 XTR();XTDTXT("Total value of EC purchases, excluding VAT");XTDTXT("9");XTDTXT(sprintf("%.2f",$vatsectionarray[9]));X_TR(); 
 XTABLE();
 XBR();

 
 $VSFile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/"."VATSummaryReport.csv";
 $filehandle = fopen($VSFile, 'w');
 fwrite($filehandle, "Company Name"."\n");
 fwrite($filehandle, "VAT Period Start"."\n");
 fwrite($filehandle, "VAT Period End"."\n");
 fwrite($filehandle, ",,,,,,,"."\n"); 
 fwrite($filehandle, "VAT due in this period on sales".",1,".sprintf("%.2f",$vatsectionarray[1])."\n");
 fwrite($filehandle, "VAT due in this period on EC acquisition".",2,".sprintf("%.2f",$vatsectionarray[2])."\n");
 fwrite($filehandle, "Total VAT due (sum of boxes 1 and 2)".",3,".sprintf("%.2f",$vatsectionarray[3])."\n");
 fwrite($filehandle, "VAT reclaimed in this period on purchases".",4,".sprintf("%.2f",$vatsectionarray[4])."\n");
 fwrite($filehandle, "Net VAT to be paid to Customs or reclaimed by you".",5,".sprintf("%.2f",$vatsectionarray[5])."\n");
 fwrite($filehandle, "Total value of sales - excluding VAT".",6,".sprintf("%.2f",$vatsectionarray[6])."\n");
 fwrite($filehandle, "Total value of purchases - excluding VAT".",7,".sprintf("%.2f",$vatsectionarray[7])."\n");
 fwrite($filehandle, "Total value of EC sales - excluding VAT".",8,".sprintf("%.2f",$vatsectionarray[8])."\n");
 fwrite($filehandle, "Total value of EC purchases - excluding VAT".",9,".sprintf("%.2f",$vatsectionarray[9])."\n");
 $link = YPGMLINK("genericdownloadin.php").YPGMSTDPARMS();
 $link = $link.YPGMPARM("DownloadFileName",$VSFile);
 $link = $link.YPGMPARM("Action","delete");
 XLINKTXT($link,"Download VAT Summary File"); 
 XBR(); 
 $link = YPGMLINK("genericdownloadin.php").YPGMSTDPARMS();
 $link = $link.YPGMPARM("DownloadFileName",$VDFile);
 $link = $link.YPGMPARM("Action","delete");
 XLINKTXT($link,"Download VAT Audit Trail File");
}

# ================================== Common Routines ======================

function  CreditOrDebit($creditcode,$creditfield,$debitcode,$debitfield) {
}
 
function  RemoveMinus($parm0) {
 $tempstring = str_replace("-","",$parm0);
 return $tempstring;	
}

function TracePrint ($outtext) {
 if ($GLOBALS{'$in_trace'} == "on") { print $outtext."<br>\n"; }		
}

?>

