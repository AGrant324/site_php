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

$GLOBALS{'transactiona'} = Array();
$GLOBALS{'analysisa'} = Array();

$GLOBALS{'extract_type'} = "";
$GLOBALS{'extract_acctref'} = "";
$GLOBALS{'extract_nomacctref'} = "";
$GLOBALS{'extract_dept'} = "";
$GLOBALS{'extract_date'} = "";
$GLOBALS{'extract_ref'} = "";
$GLOBALS{'extract_details'} = "";
$GLOBALS{'extract_amountsigned'} = ""; # signed (prefixed by "-" if negative)
$GLOBALS{'extract_netamount'} = ""; # unsigned
$GLOBALS{'extract_vatcode'} = "";
$GLOBALS{'extract_vatamount'} = ""; # unsigned
$GLOBALS{'extract_extraref'} = "";
$GLOBALS{'vatamount'} = "";
$GLOBALS{'netamount'} = "";
 
$GLOBALS{'in_startdate'} = $_REQUEST["StartDate_YYYYpart"]."-".$_REQUEST["StartDate_MMpart"]."-".$_REQUEST["StartDate_DDpart"];  
$GLOBALS{'in_enddate'} = $_REQUEST["EndDate_YYYYpart"]."-".$_REQUEST["EndDate_MMpart"]."-".$_REQUEST["EndDate_DDpart"];
$GLOBALS{'in_action'} = $_REQUEST['Action'];
$GLOBALS{'in_trace'} = $_REQUEST['Trace'];
$GLOBALS{'in_target'} = $_REQUEST['Target'];

XH1("Extract information download for Accountant - ".$GLOBALS{'in_target'});
XPTXT("Dates Requested:  From ".$GLOBALS{'in_startdate'}." To ".$GLOBALS{'in_enddate'});

# Set the extraction parameters for this company 
$companya = Get_Array_Hash('company');
$company_name = $companya[0];
Get_Data('company',$company_name);
$GLOBALS{'IRISDirectorsLoanIntroducedCode'} = "985-2";
$GLOBALS{'IRISDirectorsLoanDrawingCode'} = "985-21";
if ($GLOBALS{'company_companytype'} == "LTD") { 
 $GLOBALS{'IRISDirectorsLoanIntroducedCode'} = "727-2";
 $GLOBALS{'IRISDirectorsLoanDrawingCode'} = "727-21";
}

if (($GLOBALS{'in_action'} == "Trial")||($GLOBALS{'in_action'} == "Submit")) {
 XPTXT("Please dont forget to download the files created by this process");  	
 if ($GLOBALS{'in_target'} == "SAGE") { 
  $TFile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/"."SAGETransasctionFile.csv"; 
  $GLOBALS{'FileHandle'} = fopen($TFile, 'w');
  BankTxn_SAGE_Extract();
  CashTxn_SAGE_Extract();
  TravelTxn_SAGE_Extract();  
  MileageTxn_SAGE_Extract();
  PayrollTxn_SAGE_Extract();
  HomeOfficeTxn_SAGE_Extract();
  SalesInvoice_SAGE_Extract();
  PurchaseInvoice_SAGE_Extract();
  fclose($GLOBALS{'FileHandle'});
  $link = YPGMLINK("genericdownloadin.php").YPGMSTDPARMS();
  $link = $link.YPGMPARM("DownloadFileName",$TFile);
  $link = $link.YPGMPARM("Action","delete");
  XLINKTXT($link,"Download Transaction File");
  XH1("Customer Records");
  $CFile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/"."SAGECustomerFile.csv";
  $GLOBALS{'FileHandle'} = fopen($CFile, 'w');
  Customer_SAGE_Extract();
  fclose($GLOBALS{'FileHandle'});
  $link = YPGMLINK("genericdownloadin.php").YPGMSTDPARMS();
  $link = $link.YPGMPARM("DownloadFileName",$CFile);
  $link = $link.YPGMPARM("Action","delete");
  XLINKTXT($link,"Download Customer File");
  XH1("Supplier Records");
  $SFile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/"."SAGESupplierFile.csv";
  $GLOBALS{'FileHandle'} = fopen($SFile, 'w');
  Supplier_SAGE_Extract();
  fclose($GLOBALS{'FileHandle'});
  XH3("Transaction File Creation");
  $link = YPGMLINK("genericdownloadin.php").YPGMSTDPARMS();
  $link = $link.YPGMPARM("DownloadFileName",$SFile);
  $link = $link.YPGMPARM("Action","delete");
  XLINKTXT($link,"Download Supplier File");
 } 
 if ($GLOBALS{'in_target'} == "IRIS") { 
  $TFile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/"."IRISTransasctionFile.csv";  
  $GLOBALS{'FileHandle'} = fopen($TFile, 'w');	
  BankTxn_IRIS_Extract();
  CashTxn_IRIS_Extract();
  TravelTxn_IRIS_Extract();  
  MileageTxn_IRIS_Extract();
  PayrollTxn_IRIS_Extract();
  HomeOfficeTxn_IRIS_Extract();
  SalesInvoice_IRIS_Extract();
  PurchaseInvoice_IRIS_Extract();
  fclose($GLOBALS{'FileHandle'});
  XH3("Transaction File Creation");  
  $link = YPGMLINK("genericdownloadin.php").YPGMSTDPARMS();
  $link = $link.YPGMPARM("DownloadFileName",$TFile);
  $link = $link.YPGMPARM("Action","delete");  
  XLINKTXT($link,"Download Transaction File");
  IRISSummaryFileCreate();
  IRISAnalysisFileCreate();  
 }
}
if ($GLOBALS{'in_action'} == "UnSubmit") {
 XH3("Records UnSubmitted"); 
 BankTxn_Reset();
 CashTxn_Reset();
 MileageTxn_Reset(); 
 PayrollTxn_Reset();
 HomeOfficeTxn_Reset();
 SalesInvoice_Reset();
 PurchaseInvoice_Reset();  
} 

XBR();XBR();
Back_Navigator();
PageFooter("Default","Final");

# ==================================  SAGE Routines ================================

function  BankTxn_SAGE_Extract() {
 $banktxna = Get_Array('banktxn');
 sort($banktxna); 
 foreach ($banktxna as $banktxn_id) {
  Get_Data('banktxn',$banktxn_id); 
  if (($GLOBALS{'banktxn_date'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'banktxn_date'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'banktxn_processstatus'} != "submitted")) {     	    
   $GLOBALS{'extract_dept'} = "";
   $GLOBALS{'extract_date'} = $GLOBALS{'banktxn_date'};
   $GLOBALS{'extract_ref'} = str_replace(",","",$GLOBALS{'banktxn_id'});
   $GLOBALS{'extract_details'} = str_replace(",","",$GLOBALS{'banktxn_description'});
   $GLOBALS{'extract_extraref'} = "1";  
   if ($GLOBALS{'banktxn_txnfavouriteid'} == "Bank_Bank Charges") {BankTxn_BankCharges_SAGE_Extract();}
   if ($GLOBALS{'banktxn_txnfavouriteid'} == "Bank_Petty Cash") {BankTxn_PettyCash_SAGE_Extract();}   
   if ($GLOBALS{'banktxn_purpose'} == "Customer Receipt") {BankTxn_CustomerReceipt_SAGE_Extract();}   
   if ($GLOBALS{'banktxn_purpose'} == "HMRC") {BankTxn_HMRC_SAGE_Extract();}
   if ($GLOBALS{'banktxn_purpose'} == "Payroll") {BankTxn_Payroll_SAGE_Extract();}
   if ($GLOBALS{'banktxn_purpose'} == "Dividend or Loan") {BankTxn_DividendorLoan_SAGE_Extract();}    
   if ($GLOBALS{'banktxn_purpose'} == "Purchase") {BankTxn_Purchase_SAGE_Extract();}   
   if ($GLOBALS{'banktxn_purpose'} == "Travel") {BankTxn_Purchase_SAGE_Extract();}
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'banktxn_processstatus'} = "submitted";   	
    Write_Data('banktxn',$banktxn_id);
    TracePrint($GLOBALS{'banktxn_id'}." PROCESSED AS FINAL");        	
   } else {
    TracePrint($GLOBALS{'banktxn_id'}." PROCESSED AS TRIAL");       	
   } 
  }
  else {TracePrint($GLOBALS{'banktxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");}
 }
}  
function  BankTxn_BankCharges_SAGE_Extract() {
 $GLOBALS{'extract_type'} = "BP";
 $GLOBALS{'extract_acctref'} = "1200";
 $GLOBALS{'extract_nomacctref'} = "7901";
 $GLOBALS{'extract_netamount'} = $GLOBALS{'banktxn_debit'};
 $GLOBALS{'extract_vatcode'} = "T9";
 $GLOBALS{'extract_vatamount'} = "0";
 if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }		
}
function  BankTxn_PettyCash_SAGE_Extract() {
# JC		1200		08/06/2009	LTSB-0612	RAPHAEL BANK       7929CP . St Pancras Euro 108	477.38	T9	0	1
# JD		1230		08/06/2009	LTSB-0612	RAPHAEL BANK       7929CP . St Pancras Euro 108	477.38	T9	0	1	
 $GLOBALS{'extract_acctref'} = "";
 $GLOBALS{'extract_vatcode'} = "T9";
 $GLOBALS{'extract_vatamount'} = "0";	
 if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
  $GLOBALS{'extract_netamount'} = $GLOBALS{'banktxn_debit'}; 
  $GLOBALS{'extract_type'} = "JC"; 
  $GLOBALS{'extract_nomacctref'} = "1200";    
  if ($GLOBALS{'extract_netamount'} != "0.00") fwrite($GLOBALS{'FileHandle'}, SAGETransactionExtract);
  $GLOBALS{'extract_type'} = "JD";   
  $GLOBALS{'extract_nomacctref'} = "1230";    
  if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }  
 } 
 if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
  $GLOBALS{'extract_netamount'} = $GLOBALS{'banktxn_credit'}; 	
  $GLOBALS{'extract_type'} = "JC"; 
  $GLOBALS{'extract_nomacctref'} = "1230";    
  if ($GLOBALS{'extract_netamount'} != "0.00") fwrite($GLOBALS{'FileHandle'}, SAGETransactionExtract());
  $GLOBALS{'extract_type'} = "JD";     
  $GLOBALS{'extract_nomacctref'} = "1200";    
  if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }  
 } 		
}
function  BankTxn_CustomerReceipt_SAGE_Extract() {
 $GLOBALS{'extract_type'} = "SA";
 $GLOBALS{'extract_acctref'} = $GLOBALS{'banktxn_customerid'};
 $GLOBALS{'extract_nomacctref'} = "1200";
 $GLOBALS{'extract_netamount'} = Calculate($GLOBALS{'banktxn_credit'},"-",$GLOBALS{'banktxn_vat'});
 Get_Data_Hash('vatrate',$GLOBALS{'banktxn_vatrateid'});  
 $GLOBALS{'extract_vatcode'} = $GLOBALS{'vatrate_id'};
 $GLOBALS{'extract_vatamount'} = $GLOBALS{'banktxn_vat'};
 if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }	
} 
function  BankTxn_HMRC_SAGE_Extract() {
 if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
  $GLOBALS{'extract_type'} = "BP";	
  $GLOBALS{'extract_netamount'} = $GLOBALS{'banktxn_debit'}; 
 } 
 if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
  $GLOBALS{'extract_type'} = "BR"; 	
  $GLOBALS{'extract_netamount'} = $GLOBALS{'banktxn_credit'};
 } 	
 $GLOBALS{'extract_acctref'} = "1200";
 $GLOBALS{'extract_nomacctref'} = convertToSageCode($GLOBALS{'banktxn_fincategoryid'});
 $GLOBALS{'extract_vatcode'} = "T9";
 $GLOBALS{'extract_vatamount'} = "0";
 if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }		
}

function  BankTxn_Payroll_SAGE_Extract() {
 $GLOBALS{'extract_type'} = "BP";
 $GLOBALS{'extract_acctref'} = "1200";
 $GLOBALS{'extract_nomacctref'} = "2220";
 $GLOBALS{'extract_netamount'} = $GLOBALS{'banktxn_debit'}; 
 $GLOBALS{'extract_vatcode'} = "T9";
 $GLOBALS{'extract_vatamount'} = "0";
 if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }	
}  

function  BankTxn_Purchase_SAGE_Extract() {
 if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) { # Supplier Payment
# PA	NATIVESP	1200		19/02/2010	B000000013	WP-NATIVE LOGIC LI . CD 7929	5.1	T1	0.89	1
# PI	NATIVESP	7508		19/02/2010	B000000013	WP-NATIVE LOGIC LI . CD 7929	5.1	T1	0.89	1 	 	
  $GLOBALS{'extract_type'} = "PA";
  $GLOBALS{'extract_acctref'} = $GLOBALS{'banktxn_supplierid'};
  if ($GLOBALS{'banktxn_purpose'} == "OSTravel") {$GLOBALS{'extract_acctref'} = "OSTRAVEL";}
  if ($GLOBALS{'banktxn_purpose'} == "UKTravel") {$GLOBALS{'extract_acctref'} = "UKTRAVEL";}
  if ($GLOBALS{'banktxn_purpose'} == "Travel") {$GLOBALS{'extract_acctref'} = "TRAVEL";}    
  $GLOBALS{'extract_nomacctref'} = "1200";	
  $GLOBALS{'extract_netamount'} = Calculate($GLOBALS{'banktxn_debit'},"-",$GLOBALS{'banktxn_vat'});    
  Get_Data_Hash('vatrate',$GLOBALS{'banktxn_vatrateid'});
  $GLOBALS{'extract_vatcode'} = $GLOBALS{'vatrate_id'};
  $GLOBALS{'extract_vatamount'} = $GLOBALS{'banktxn_vat'};
  if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }
  
  if ($GLOBALS{'banktxn_paymenttype'} == "Transaction" ) {
   $GLOBALS{'extract_type'} = "PI";
   $GLOBALS{'extract_nomacctref'} = convertToSageCode($GLOBALS{'banktxn_fincategoryid'});
   if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); } 	
  }
 }
 if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {   # Supplier Credits    CHECK ???
# PI	WATERSTO	9998		08/02/2010	B000000003	WATERSTONES . CD 7929	12.76	T9	2.23	1
# BR	1200	    9998		08/02/2010	B000000003	WATERSTONES . CD 7929	12.76	T9	2.23	1 	
# PC	WATERSTO	7508		08/02/2010	B000000003	WATERSTONES . CD 7929	12.76	T1	2.23	1 	
  $GLOBALS{'extract_type'} = "PI";
  $GLOBALS{'extract_acctref'} = $GLOBALS{'banktxn_supplierid'};
  if ($GLOBALS{'banktxn_purpose'} == "OSTravel") {$GLOBALS{'extract_acctref'} = "OSTRAVEL";}
  if ($GLOBALS{'banktxn_purpose'} == "UKTravel") {$GLOBALS{'extract_acctref'} = "UKTRAVEL";}
  if ($GLOBALS{'banktxn_purpose'} == "Travel") { $GLOBALS{'extract_acctref'} = "TRAVEL"; }      
  $GLOBALS{'extract_nomacctref'} = "9998"; #Suspense Account
  $GLOBALS{'extract_netamount'} = Calculate($GLOBALS{'banktxn_credit'},"-",$GLOBALS{'banktxn_vat'});
  Get_Data_Hash('vatrate',$GLOBALS{'banktxn_vatrateid'});
  $GLOBALS{'extract_vatcode'} = "T9";
  $GLOBALS{'extract_vatamount'} = $GLOBALS{'banktxn_vat'};
  if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }
  $GLOBALS{'extract_type'} = "BR";
  $GLOBALS{'extract_acctref'} = "1200";      
  $GLOBALS{'extract_nomacctref'} = "9998"; #Suspense Account
  $GLOBALS{'extract_vatcode'} = "T9"; 
  if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); } 
  
  if ($GLOBALS{'banktxn_paymenttype'} == "Transaction" ) { 
   $GLOBALS{'extract_type'} = "PC";
   $GLOBALS{'extract_acctref'} = $GLOBALS{'banktxn_supplierid'};
   if ($GLOBALS{'banktxn_purpose'} == "OSTravel") {$GLOBALS{'extract_acctref'} = "OSTRAVEL";}
   if ($GLOBALS{'banktxn_purpose'} == "UKTravel") {$GLOBALS{'extract_acctref'} = "UKTRAVEL";}
   $GLOBALS{'extract_nomacctref'} = convertToSageCode($GLOBALS{'banktxn_fincategoryid'});
   $GLOBALS{'extract_vatcode'} = $GLOBALS{'vatrate_id'};
   if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); } 	
  }  
 }
}  	
function  CashTxn_SAGE_Extract(){

# PA	UKTRAVEL	1230		28/11/2009		Parking	1.95	T0	0	1
# PA	UKTRAVEL	1230		18/12/2009		Parking	2	T0	0	1	
# PI	UKTRAVEL	7400		28/11/2009		Parking	1.95	T0	0	1
# PI	UKTRAVEL	7400		18/12/2009		Parking	2	T0	0	1
	
 $cashtxna = Get_Array('cashtxn');
 foreach ($cashtxna as $cashtxn_id) {
  Get_Data('cashtxn',$cashtxn_id);
  if (($GLOBALS{'cashtxn_date'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'cashtxn_date'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'cashtxn_processstatus'} != "submitted")) {   
   $GLOBALS{'extract_type'} = "PA";
   $GLOBALS{'extract_acctref'} = $GLOBALS{'cashtxn_customerid'}; 
   $GLOBALS{'extract_nomacctref'} = "1230";
   $GLOBALS{'extract_dept'} = "";
   $GLOBALS{'extract_date'} = $GLOBALS{'cashtxn_date'};
   $GLOBALS{'extract_ref'} = $GLOBALS{'cashtxn_id'};
   $GLOBALS{'extract_details'} = $GLOBALS{'cashtxn_description'};
   $GLOBALS{'extract_netamount'} = $GLOBALS{'cashtxn_debit'};  // CHECK 
   Get_Data_Hash('vatrate',$GLOBALS{'cashtxn_vatrateid'});  
   $GLOBALS{'extract_vatcode'} = $GLOBALS{'vatrate_id'};  
   $GLOBALS{'extract_vatamount'} = $GLOBALS{'cashtxn_vat'};
   $GLOBALS{'extract_extraref'} = "1";  	
   if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }
  
   $GLOBALS{'extract_type'} = "PI";  
   $GLOBALS{'extract_acctref'} = $GLOBALS{'cashtxn_supplierid'}; 
   $GLOBALS{'extract_nomacctref'} = convertToSageCode($GLOBALS{'cashtxn_fincategoryid'});
   if ($GLOBALS{'extract_netamount'} != "0.00") fwrite($GLOBALS{'FileHandle'}, SAGETransactionExtract());
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'cashtxn_processstatus'} = "submitted";   	
    Write_Data('cashtxn',$cashtxn_id);
    TracePrint($GLOBALS{'cashtxn_id'}." PROCESSED AS FINAL");        	
   } else {
    TracePrint($GLOBALS{'cashtxn_id'}." PROCESSED AS TRIAL");       	
   }    
  } 
  else {TracePrint($GLOBALS{'cashtxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");}
 }
}

function  TravelTxn_SAGE_Extract(){

# PA	UKTRAVEL	1230		28/11/2009		Parking	1.95	T0	0	1
# PA	UKTRAVEL	1230		18/12/2009		Parking	2	T0	0	1	
# PI	UKTRAVEL	7400		28/11/2009		Parking	1.95	T0	0	1
# PI	UKTRAVEL	7400		18/12/2009		Parking	2	T0	0	1
	
 $traveltxna = Get_Array('traveltxn');
 foreach ($traveltxna as $traveltxn_id) {
  Get_Data('traveltxn',$traveltxn_id);
  if (($GLOBALS{'traveltxn_date'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'traveltxn_date'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'traveltxn_processstatus'} != "submitted")) {   
   $GLOBALS{'extract_type'} = "PA";
   $GLOBALS{'extract_acctref'} = "Travel"; 
   $GLOBALS{'extract_nomacctref'} = "1230";
   $GLOBALS{'extract_dept'} = "";
   $GLOBALS{'extract_date'} = $GLOBALS{'traveltxn_date'};
   $GLOBALS{'extract_ref'} = $GLOBALS{'traveltxn_id'};
   $GLOBALS{'extract_details'} = $GLOBALS{'traveltxn_description'};
   $GLOBALS{'extract_netamount'} = $GLOBALS{'traveltxn_debit'};  // CHECK 
   Get_Data_Hash('vatrate',$GLOBALS{'traveltxn_vatrateid'});  
   $GLOBALS{'extract_vatcode'} = $GLOBALS{'vatrate_id'};  
   $GLOBALS{'extract_vatamount'} = $GLOBALS{'traveltxn_vat'};
   $GLOBALS{'extract_extraref'} = "1";  	
   if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }
  
   $GLOBALS{'extract_type'} = "PI";  
   $GLOBALS{'extract_acctref'} = "Travel"; 
   $GLOBALS{'extract_nomacctref'} = convertToSageCode($GLOBALS{'traveltxn_fincategoryid'});
   if ($GLOBALS{'extract_netamount'} != "0.00") fwrite($GLOBALS{'FileHandle'}, SAGETransactionExtract());
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'traveltxn_processstatus'} = "submitted";   	
    Write_Data('traveltxn',$traveltxn_id);
    TracePrint($GLOBALS{'traveltxn_id'}." PROCESSED AS FINAL");        	
   } else {
    TracePrint($GLOBALS{'traveltxn_id'}." PROCESSED AS TRIAL");       	
   }    
  } 
  else {TracePrint($GLOBALS{'traveltxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");}
 }
}

function  MileageTxn_SAGE_Extract(){

# JC	Mileage	2103		23/06/2010	bbra Mileage	30/11/2001 to 30/11/2017	81	T9	0	1
# JD	Mileage	7304		23/06/2010	bbra Mileage	30/11/2001 to 30/11/2017	73.75	T1	0	1
# JD	Mileage	2201		23/06/2010	bbra Mileage	30/11/2001 to 30/11/2017	7.25	T1	0	1	
  
 $mileagetxna = Get_Array('mileagetxn');
 $persona = Get_Array('person'); 
 foreach ($persona as $person_id) { 
  foreach ($mileagetxna as $mileagetxn_id) {
   Get_Data('mileagetxn',$mileagetxn_id);
   # print $mileagetxn_id." ".$person_id." READ "."<br>\n";
   if ($GLOBALS{'mileagetxn_personid'} == $person_id) {           
    if (($GLOBALS{'mileagetxn_date'} >= $GLOBALS{'in_startdate'})
      &&($GLOBALS{'mileagetxn_date'} <= $GLOBALS{'in_enddate'})
      &&($GLOBALS{'mileagetxn_processstatus'} != "submitted")) {   

     Get_Data_Hash_DateEffective('mileageparm',"Miles",$GLOBALS{'mileagetxn_date'});
     Get_Data_Hash_DateEffective('fuelparm', $GLOBALS{'mileagetxn_fuelparmenginetype'}, $GLOBALS{'mileagetxn_date'});
     Get_Data_Hash_DateEffective('vatrate',"T1", $GLOBALS{'mileagetxn_date'});     
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
     $GLOBALS{'extract_type'} = "JC";
     $GLOBALS{'extract_acctref'} = "Mileage"; 
     $GLOBALS{'extract_nomacctref'} = "2103";
     $GLOBALS{'extract_dept'} = "";
     $GLOBALS{'extract_date'} = $GLOBALS{'mileagetxn_date'};
     $GLOBALS{'extract_ref'} = $person_id." Mileage";
     $GLOBALS{'extract_details'} = YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'in_startdate'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'in_enddate'});
     $GLOBALS{'extract_netamount'} = $GLOBALS{'extract_netamount'};   
     $GLOBALS{'extract_vatcode'} = "T9";
     $GLOBALS{'extract_vatamount'} = "0";
     $GLOBALS{'extract_extraref'} = "1";  	
     if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }           
     
     $GLOBALS{'extract_type'} = "JD";
     $GLOBALS{'extract_nomacctref'} = "7304";
     $GLOBALS{'extract_vatcode'} = $GLOBALS{'vatrate_id'};         
     $GLOBALS{'extract_netamount'} = sprintf("%.2f",($paymenttotal - $vatpayable));
     if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }

     $GLOBALS{'extract_type'} = "JD"; 
     $GLOBALS{'extract_nomacctref'} = "2201";
     $GLOBALS{'extract_netamount'} = sprintf("%.2f",$vatpayable);    	
     if ($GLOBALS{'extract_netamount'} != "0.00") fwrite($GLOBALS{'FileHandle'}, SAGETransactionExtract());

     if ($GLOBALS{'in_action'} == "Submit") {
      $GLOBALS{'mileagetxn_processstatus'} = "submitted";   	
      Write_Data('mileagetxn',$mileagetxn_id);
      TracePrint($mileagetxn_id." ".$person_id." PROCESSED AS FINAL ");      	
     } 
     else { TracePrint($mileagetxn_id." ".$person_id." PROCESSED AS TRIAL "); }       
    }
    else { TracePrint($mileagetxn_id." ".$person_id." OUTSIDE RANGE / ALREADY SUBMITTED"); }
   } 
  }  
 }
}

function  PayrollTxn_SAGE_Extract(){
# JD		7000/1		28/10/2009	Oct-09	Gross Salary - CS	750	T9		1	
# JD		7006/7		28/10/2009	Oct-09	Employers NIC - CS	35.07	T9		1	
# JC		2220		28/10/2009	Oct-09	Net Wages - CS	564.93	T9		1	  net wages gross - it - eenic
# JC		2210		28/10/2009	Oct-09	PAYE - CS	220.14	T9		1	it + eenic  + ernic
	
 $payrolltxna = Get_Array('payrolltxn');
 $persona = Get_Array('person'); 
 foreach ($persona as $person_id) {
  Get_Data('person',$person_id); 	 
  foreach ($payrolltxna as $payrolltxn_id) {
   Get_Data('payrolltxn',$payrolltxn_id);
   # print $payrolltxn_id." ".$person_id." READ "."<br>\n"; 
   if ($GLOBALS{'payrolltxn_personid'} == $person_id) { 	      
    if (($GLOBALS{'payrolltxn_periodend'} >= $GLOBALS{'in_startdate'})
       &&($GLOBALS{'payrolltxn_periodend'} <= $GLOBALS{'in_enddate'})
       &&($GLOBALS{'payrolltxn_processstatus'} != "submitted")) {     
     $grossnum = floatval($GLOBALS{'payrolltxn_gross'}); 
     $incometaxnum = floatval($GLOBALS{'payrolltxn_incometax'}); 
     $employeesNICnum = floatval($GLOBALS{'payrolltxn_employeesNIC'}); 
     $employersNICnum = floatval($GLOBALS{'payrolltxn_employersNIC'});
     if ($GLOBALS{'person_director'} == "Director") { # CHECK
     	$payfincategoryid = "7000";
     	$employersNICfincategoryid = "7006";    	 
     } else { 
     	$payfincategoryid = "7001"; 
     	$employersNICfincategoryid = "7007";     	
     }     
     $grossnum = $GLOBALS{'payrolltxn_gross'};
     $GLOBALS{'extract_type'} = "JD";
     $GLOBALS{'extract_acctref'} = "PAYROLL"; 
     $GLOBALS{'extract_nomacctref'} = $payfincategoryid;
     $GLOBALS{'extract_dept'} = "";
     $GLOBALS{'extract_date'} = $GLOBALS{'payrolltxn_periodend'};
     $GLOBALS{'extract_ref'} = $person_id." Payroll";     
     $GLOBALS{'extract_details'} =  $person_id." "."Gross - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});
     $GLOBALS{'extract_netamount'} = sprintf("%.2f",$grossnum);
     $GLOBALS{'extract_vatcode'} = "T9";
     $GLOBALS{'extract_vatamount'} = "0";
     $GLOBALS{'extract_extraref'} = "1";  	
     if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }

     $GLOBALS{'extract_type'} = "JD"; 
     $GLOBALS{'extract_nomacctref'} = $employersNICfincategoryid;
     $GLOBALS{'extract_details'} =  $person_id." "."Employers NIC - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});     
     $GLOBALS{'extract_netamount'} = sprintf("%.2f",$employersNICnum);    	
     if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }       
     
     $employersNICnum = $GLOBALS{'payrolltxn_employersNIC'};     
     $GLOBALS{'extract_type'} = "JC"; 
     $GLOBALS{'extract_nomacctref'} = "2220";
     $GLOBALS{'extract_details'} =  $person_id." "."Net Wages - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});     
     $GLOBALS{'extract_netamount'} = sprintf("%.2f",($grossnum - $incometaxnum - $employeesNICnum));     	
     if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }

     $GLOBALS{'extract_type'} = "JC";
     $GLOBALS{'extract_nomacctref'} = "2210";     
     $GLOBALS{'extract_details'} =  $person_id." "."PAYE - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});     
     $GLOBALS{'extract_netamount'} = sprintf("%.2f",($incometaxnum + $employeesNICnum + $employersNICnum));              
     if ($GLOBALS{'extract_netamount'} != "0.00") fwrite($GLOBALS{'FileHandle'}, SAGETransactionExtract());

     if ($GLOBALS{'in_action'} == "Submit") {
      $GLOBALS{'payrolltxn_processstatus'} = "submitted";   	
      Write_Data('payrolltxn',$payrolltxn_id);
      TracePrint($payrolltxn_id." ".$person_id." PROCESSED AS FINAL");     	
     } else {
      TracePrint($payrolltxn_id." ".$person_id." PROCESSED AS TRIAL"); 
     }       
    }
    else {TracePrint($payrolltxn_id." ".$person_id." OUTSIDE RANGE / ALREADY SUBMITTED");}     
   } 
  }  
 }
}


function  HomeOfficeTxn_SAGE_Extract(){
	
# JD	HO	7100		31/01/2011	HO00001	2010-02-01 to 2011-01-31	368.71	T9	0	1
# JC	HO	2103		31/01/2011	HO00001	2010-02-01 to 2011-01-31	368.71	T9	0	1

Check_Data('homeoffice',"Home"); 
if ($GLOBALS{'IOWARNING'} == "0") { 
 $roomspercentage = floatval($GLOBALS{'homeoffice_percentage'});

 $homeofficetxna = Get_Array('homeofficetxn');
 foreach ($homeofficetxna as $homeofficetxn_id) {    
  Get_Data('homeofficetxn',$homeofficetxn_id); 
  if (($GLOBALS{'homeofficetxn_periodend'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'homeofficetxn_periodend'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'homeofficetxn_processstatus'} != "submitted")) {     
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
   
   $GLOBALS{'extract_type'} = "JD";
   $GLOBALS{'extract_acctref'} = "HO"; 
   $GLOBALS{'extract_nomacctref'} = "7100";
   $GLOBALS{'extract_date'} = $GLOBALS{'homeofficetxn_periodend'};
   $GLOBALS{'extract_ref'} = $GLOBALS{'homeofficetxn_id'};
   $GLOBALS{'extract_details'} = $GLOBALS{'homeofficetxn_periodstart'}." to ".$GLOBALS{'homeofficetxn_periodend'};
   $GLOBALS{'extract_netamount'} = sprintf("%.2f",$homeofficeexpenses);
   $GLOBALS{'extract_vatcode'} = "T9";
   $GLOBALS{'extract_vatamount'} = "0";
   $GLOBALS{'extract_extraref'} = "1";  	
   if ($GLOBALS{'extract_netamount'} != "0.00") { SAGETransactionExtract(); }
  	
   $GLOBALS{'extract_type'} = "JC"; 
   $GLOBALS{'extract_nomacctref'} = "2103";
   if ($GLOBALS{'extract_netamount'} != "0.00") fwrite($GLOBALS{'FileHandle'}, SAGETransactionExtract());
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'homeofficetxn_processstatus'} = "submitted";   	
    Write_Data('homeofficetxn',$homeofficetxn_id);
    TracePrint($GLOBALS{'homeofficetxn_id'}." ".$homeofficeexpenses." PROCESSED AS FINAL");   	
   } else {
    TracePrint($GLOBALS{'homeofficetxn_id'}." ".$homeofficeexpenses." PROCESSED AS TRIAL");  	
   }       
  } 
  else {TracePrint($GLOBALS{'homeofficetxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");}
 }
}
}

function  SalesInvoice_SAGE_Extract(){
 $salesinvoicea = Get_Array('salesinvoice');
 foreach ($salesinvoicea as $salesinvoice_id) {
  Get_Data('salesinvoice',$salesinvoice_id);
  if (($GLOBALS{'salesinvoice_date'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'salesinvoice_date'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'salesinvoice_processstatus'} != "submitted")) {  
   $GLOBALS{'extract_type'} = "SI";
   $GLOBALS{'extract_acctref'} = $GLOBALS{'salesinvoice_customerid'}; 
   $GLOBALS{'extract_nomacctref'} = convertToSageCode($GLOBALS{'salesinvoice_fincategoryid'});
   $GLOBALS{'extract_dept'} = "";
   $GLOBALS{'extract_date'} = $GLOBALS{'salesinvoice_date'};
   $GLOBALS{'extract_ref'} = $GLOBALS{'salesinvoice_id'};
   $GLOBALS{'extract_details'} = $GLOBALS{'salesinvoice_description'};
   $GLOBALS{'extract_netamount'} = $GLOBALS{'salesinvoice_net'};
   Get_Data_Hash('vatrate',$GLOBALS{'salesinvoice_vatrateid'});  
   $GLOBALS{'extract_vatcode'} = $GLOBALS{'vatrate_id'}; 
   $GLOBALS{'extract_vatamount'} = $GLOBALS{'salesinvoice_vat'};
   $GLOBALS{'extract_extraref'} = "1";  	
   fwrite($GLOBALS{'FileHandle'}, SAGETransactionExtract());
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'salesinvoice_processstatus'} = "submitted";   	
    Write_Data('salesinvoice',$salesinvoice_id);
    TracePrint($GLOBALS{'salesinvoice_id'}." PROCESSED AS FINAL");     	
   } else {
    TracePrint($GLOBALS{'salesinvoice_id'}." PROCESSED AS TRIAL"); 
   }    
  } 
  else {TracePrint($GLOBALS{'salesinvoice_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");}
 }
}

function  PurchaseInvoice_SAGE_Extract(){
 $purchaseinvoicea = Get_Array('purchaseinvoice');
 foreach ($purchaseinvoicea as $purchaseinvoice_id) {
  Get_Data('purchaseinvoice',$purchaseinvoice_id);
  if (($GLOBALS{'purchaseinvoice_date'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'purchaseinvoice_date'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'purchaseinvoice_processstatus'} != "submitted")) {    	
   $GLOBALS{'extract_acctref'} = $GLOBALS{'purchaseinvoice_supplierid'}; 
   $GLOBALS{'extract_nomacctref'} = convertToSageCode($GLOBALS{'purchaseinvoice_fincategoryid'});
   $GLOBALS{'extract_dept'} = "";
   $GLOBALS{'extract_date'} = $GLOBALS{'purchaseinvoice_date'};
   $GLOBALS{'extract_ref'} = $GLOBALS{'purchaseinvoice_id'};
   $GLOBALS{'extract_details'} = $GLOBALS{'purchaseinvoice_description'};
   Get_Data_Hash('vatrate',$GLOBALS{'purchaseinvoice_vatrateid'});  
   $GLOBALS{'extract_vatcode'} = $GLOBALS{'vatrate_id'};    
   if ($GLOBALS{'purchaseinvoice_net'} > 0) { # Account Purchase Invoice 
   	$GLOBALS{'extract_type'} = "PI";
    $GLOBALS{'extract_netamount'} = $GLOBALS{'purchaseinvoice_net'};
    $GLOBALS{'extract_vatamount'} = $GLOBALS{'purchaseinvoice_vat'};	
   } else { # Account Purchase Credit 
   	$GLOBALS{'extract_type'} = "PC";
    $GLOBALS{'extract_netamount'} = RemoveMinus($GLOBALS{'purchaseinvoice_net'}); 
    $GLOBALS{'extract_vatamount'} = RemoveMinus($GLOBALS{'purchaseinvoice_vat'});  	
   }  
   $GLOBALS{'extract_extraref'} = "1";  	
   fwrite($GLOBALS{'FileHandle'}, SAGETransactionExtract());
   
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'purchaseinvoice_processstatus'} = "submitted";   	
    Write_Data('purchaseinvoice',$purchaseinvoice_id);
    TracePrint($GLOBALS{'purchaseinvoice_id'}." PROCESSED AS FINAL"); 	     	
   } else {
    TracePrint($GLOBALS{'purchaseinvoice_id'}." PROCESSED AS TRIAL");   	
   }    
  } 
  else {TracePrint($GLOBALS{'purchaseinvoice_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");}
 }		
}

function  Supplier_SAGE_Extract(){
 $suppliera = Get_Array('supplier');
 foreach ($suppliera as $supplier_id) {
  Get_Data('supplier',$supplier_id);
  TracePrint($GLOBALS{'supplier_id'}); 	
  $datastring = $supplier_id.",".$GLOBALS{'supplier_name'}.",";
  $datastring = $datastring.",,,,,,,,,,,,,,,,,,,,,,,,,,,,1"."\n";	
  fwrite($GLOBALS{'FileHandle'}, $datastring);
 }		
}
function  Customer_SAGE_Extract(){
 $customera = Get_Array('customer');
 foreach ($customera as $customer_id) {
  Get_Data('customer',$customer_id);
  TracePrint($GLOBALS{'customer_id'}); 	
  $datastring = $customer_id.",".$GLOBALS{'customer_name'}.",";
  $datastring = $datastring.",,,,,,,,,,,,,,,,,,,,,,,,,,,,1"."\n";
  fwrite($GLOBALS{'FileHandle'}, $datastring);
 }		
}	

function  Job_SAGE_Extract(){}


function convertToSageCode($parm0) {
 // fincategory_id
 Check_Data('fincategory',$parm0);
 if ($GLOBALS{'IOWARNING'} == "1") {
  print "$parm0 - code not found.<br>";
  return "";
 } else {
  print"$parm0 converted as ".substr($GLOBALS{'fincategory_sageid'},1,4)."<br>";
  return substr($GLOBALS{'fincategory_sageid'},1,4);
 }
}

function  SAGETransactionExtract() {
# type, acctref, nomacctref, dept, date(dd/mm/yyyy), ref, details, netamount, vatcode, vatamount, extraref
$GLOBALS{'extract_dateDDsMMsYYYY'} = YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'extract_date'});
$datastring = "";
$datastring = $datastring.$GLOBALS{'extract_type'}.",".$GLOBALS{'extract_acctref'}.",".$GLOBALS{'extract_nomacctref'}.",".$GLOBALS{'extract_dept'}.",".$GLOBALS{'extract_dateDDsMMsYYYY'}.",";
$datastring = $datastring.$GLOBALS{'extract_ref'}.",".$GLOBALS{'extract_details'}.",".$GLOBALS{'extract_netamount'}.",".$GLOBALS{'extract_vatcode'}.",";
$datastring = $datastring.$GLOBALS{'extract_vatamount'}.",". $GLOBALS{'extract_extraref'}."\n";
fwrite($GLOBALS{'FileHandle'}, $datastring);
}

# ==================================  IRIS Routines ================================

function  BankTxn_IRIS_Extract() {
 $banktxna = Get_Array('banktxn');
 sort($banktxna); 
 foreach ($banktxna as $banktxn_id) {
  Get_Data('banktxn',$banktxn_id);
  if (($GLOBALS{'banktxn_date'} >= $GLOBALS{'in_startdate'})
  &&($GLOBALS{'banktxn_date'} <= $GLOBALS{'in_enddate'})
  &&($GLOBALS{'banktxn_processstatus'} != "submitted")) {
   $GLOBALS{'extract_date'} = $GLOBALS{'banktxn_date'};
   $GLOBALS{'extract_ref'} = str_replace(",","",$GLOBALS{'banktxn_id'});
   $GLOBALS{'extract_details'} = str_replace(",","",$GLOBALS{'banktxn_description'});
   // CHECK Use of txnfavourite id for Bank precludes setup of additional favourites in this category
   if ($GLOBALS{'banktxn_txnfavouriteid'} == "Bank_Bank Charges") {BankTxn_BankCharges_IRIS_Extract();}
   if ($GLOBALS{'banktxn_txnfavouriteid'} == "Bank_Petty Cash") {BankTxn_PettyCash_IRIS_Extract();}   
   if ($GLOBALS{'banktxn_purpose'} == "Customer Receipt") {BankTxn_CustomerReceipt_IRIS_Extract();}   
   if ($GLOBALS{'banktxn_purpose'} == "HMRC") {BankTxn_HMRC_IRIS_Extract();}
   if ($GLOBALS{'banktxn_purpose'} == "Payroll") {BankTxn_Payroll_IRIS_Extract();}
   if ($GLOBALS{'banktxn_purpose'} == "Dividend or Loan") {BankTxn_DividendorLoan_IRIS_Extract();}    
   if ($GLOBALS{'banktxn_purpose'} == "Purchase") {BankTxn_Purchase_IRIS_Extract();}   
   if ($GLOBALS{'banktxn_purpose'} == "Travel") {BankTxn_Purchase_IRIS_Extract();} 
   if ($GLOBALS{'banktxn_purpose'} == "") {
    XTXT("Warning - Bank Transaction - $banktxn_id - ".$GLOBALS{'banktxn_description'}." - not yet allocated");XBR();
   }  
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'banktxn_processstatus'} = "submitted";
    Write_Data('banktxn',$banktxn_id);
    TracePrint($GLOBALS{'banktxn_id'}." PROCESSED AS FINAL");
   } else {
    TracePrint($GLOBALS{'banktxn_id'}." PROCESSED AS TRIAL");
   }
  }
  else {TracePrint($GLOBALS{'banktxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");
  }
 }
}
function  BankTxn_BankCharges_IRIS_Extract() {
 # BankTxn_BankCharges	I378	20		I692	-20
 if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
  IRISTransactionExtract("600-BankCharges","Bank Current Account","692","-".$GLOBALS{'banktxn_debit'},"");	
  IRISTransactionExtract("600-BankCharges","Bank Charges","378",$GLOBALS{'banktxn_debit'},"");
 }
 if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
  IRISTransactionExtract("600-BankCharges","Bank Current Account","692",$GLOBALS{'banktxn_credit'},""); 	
  IRISTransactionExtract("600-BankCharges","Bank Charges","378","-".$GLOBALS{'banktxn_credit'},"");
 }
}
function  BankTxn_PettyCash_IRIS_Extract() {
 # BankTxn_PettyCash	I668	35		I692	-35
 if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
  IRISTransactionExtract("300-PettyCash","Bank Current Account","692","-".$GLOBALS{'banktxn_debit'},"");	
  IRISTransactionExtract("300-PettyCash","Petty Cash","668",$GLOBALS{'banktxn_debit'},"");
 }
 if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
  IRISTransactionExtract("300-PettyCash","Bank Current Account","692",$GLOBALS{'banktxn_credit'},""); 	
  IRISTransactionExtract("300-PettyCash","Petty Cash","668","-".$GLOBALS{'banktxn_credit'},"");
 } 
}

function  BankTxn_CustomerReceipt_IRIS_Extract() {
 # BankTxn_CustomerReceipts	I692	70		I586	-70
 # BankTxn_CustomerReceipts	I586	70		I1 to 10/89	-70    Dummy Sales Invoice if Transaction
 
 if ($GLOBALS{'banktxn_paymenttype'} == "Account" ) {
  if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
   IRISTransactionExtract("100-Sales","Bank Current Account","692","-".$GLOBALS{'banktxn_debit'},"");
   if (CalculateVAT($GLOBALS{'banktxn_debit'},$GLOBALS{'banktxn_date'},$GLOBALS{'banktxn_vatrateid'},"SalesInvoiceReceipt")) {
    IRISTransactionExtract("100-Sales","P.A.Y.E/NIC","755",$GLOBALS{'vatamount'},"");    		
   }
   IRISTransactionExtract("100-Sales","Trade Debtors","586",$GLOBALS{'netamount'},"");
   }
  if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
   IRISTransactionExtract("100-Sales","Bank Current Account","692",$GLOBALS{'banktxn_credit'},"");
   if (CalculateVAT($GLOBALS{'banktxn_credit'},$GLOBALS{'banktxn_date'},$GLOBALS{'banktxn_vatrateid'},"SalesInvoiceReceipt")) {
    IRISTransactionExtract("100-Sales","P.A.Y.E/NIC","755","-".$GLOBALS{'vatamount'},"");   	
   }       
   IRISTransactionExtract("100-Sales","Trade Debtors","586","-".$GLOBALS{'netamount'},""); 
  } 
 } 
 if ($GLOBALS{'banktxn_paymenttype'} != "Account" ) { # transaction
  if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
   IRISTransactionExtract("100-Sales","Bank Current Account","692","-".$GLOBALS{'banktxn_debit'},"");
   if (CalculateVAT($GLOBALS{'banktxn_debit'},$GLOBALS{'banktxn_date'},$GLOBALS{'banktxn_vatrateid'},"TransactionReceipt")) {
    IRISTransactionExtract("100-Sales","P.A.Y.E/NIC","755",$GLOBALS{'vatamount'},"");    	
   }
   IRISTransactionExtract("100-Sales",fincategoryDescription($GLOBALS{'banktxn_fincategoryid'}),convertToIRISCode($GLOBALS{'banktxn_fincategoryid'}),$GLOBALS{'netamount'},"");   
  }
  if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
   IRISTransactionExtract("100-Sales","Bank Current Account","692",$GLOBALS{'banktxn_credit'},"");
   if (CalculateVAT($GLOBALS{'banktxn_credit'},$GLOBALS{'banktxn_date'},$GLOBALS{'banktxn_vatrateid'},"TransactionReceipt")) {
    IRISTransactionExtract("100-Sales","P.A.Y.E/NIC","755","-".$GLOBALS{'vatamount'},"");    		
   } 	
   IRISTransactionExtract("100-Sales",fincategoryDescription($GLOBALS{'banktxn_fincategoryid'}),convertToIRISCode($GLOBALS{'banktxn_fincategoryid'}),"-".$GLOBALS{'netamount'},"");     
  }	
 }	
}

function  BankTxn_HMRC_IRIS_Extract() {
 # BankTxn_HMRC	I755	45		I692	-45
 if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
  IRISTransactionExtract("700-HMRC","Bank Current Account","692","-".$GLOBALS{'banktxn_debit'},"");	
  IRISTransactionExtract("700-HMRC",fincategoryDescription($GLOBALS{'banktxn_fincategoryid'}),convertToIRISCode($GLOBALS{'banktxn_fincategoryid'}),$GLOBALS{'banktxn_debit'},"");
 }
 if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
  IRISTransactionExtract("700-HMRC","Bank Current Account","692",$GLOBALS{'banktxn_credit'},""); 	
  IRISTransactionExtract("700-HMRC",fincategoryDescription($GLOBALS{'banktxn_fincategoryid'}),convertToIRISCode($GLOBALS{'banktxn_fincategoryid'}),"-".$GLOBALS{'banktxn_credit'},"");
 } 
}

function  BankTxn_Payroll_IRIS_Extract() {
 # BankTxn_Payroll	I738	65		I692	-65    738 = Bespoke Code
 if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
  IRISTransactionExtract("400-Payroll","Bank Current Account","692","-".$GLOBALS{'banktxn_debit'},"");
  IRISTransactionExtract("400-Payroll","Payroll Control Account","738",$GLOBALS{'banktxn_debit'},"");  
 }
 if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
  IRISTransactionExtract("400-Payroll","Bank Current Account","692",$GLOBALS{'banktxn_credit'},"");
  IRISTransactionExtract("400-Payroll","Payroll Control Account","738","-".$GLOBALS{'banktxn_credit'},"");
 } 
} 

function  BankTxn_DividendorLoan_IRIS_Extract() {
if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
	IRISTransactionExtract("500-Directors Loan","Bank Current Account","692","-".$GLOBALS{'banktxn_debit'},"");
	IRISTransactionExtract("500-Directors Loan","Directors Monies Repaid",$GLOBALS{'IRISDirectorsLoanDrawingCode'},$GLOBALS{'banktxn_debit'},"1");
}
if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
	IRISTransactionExtract("500-Directors Loan","Bank Current Account","692",$GLOBALS{'banktxn_credit'},"");
	IRISTransactionExtract("DividendorLoan","Directors Monies Repaid",$GLOBALS{'IRISDirectorsLoanIntroducedCode'},"-".$GLOBALS{'banktxn_credit'},"1");
}
}


function  BankTxn_Purchase_IRIS_Extract() {
  # BankTxn_Purchase	I737	55		I692	-55
  # BankTxn_Purchase	Ixxxx	55		I737	-55    Dummy Purchase Invoice if Transaction
 if ($GLOBALS{'banktxn_paymenttype'} == "Account" ) {
  if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
    IRISTransactionExtract("200-Purchases","Bank Current Account","692","-".$GLOBALS{'banktxn_debit'},"");
    if (CalculateVAT($GLOBALS{'banktxn_debit'},$GLOBALS{'banktxn_date'},$GLOBALS{'banktxn_vatrateid'},"PurchaseInvoicePayment")) {
     IRISTransactionExtract("200-Purchases","VAT","755",$GLOBALS{'vatamount'},"");       	
    }     
    IRISTransactionExtract("200-Purchases","Trade Creditors","737",$GLOBALS{'netamount'},"");
 
  }
  if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
    IRISTransactionExtract("200-Purchases","Bank Current Account","692",$GLOBALS{'banktxn_credit'},""); 
    if (CalculateVAT($GLOBALS{'banktxn_credit'},$GLOBALS{'banktxn_date'},$GLOBALS{'banktxn_vatrateid'},"PurchaseInvoicePayment")) {
     IRISTransactionExtract("200-Purchases","VAT","755",$GLOBALS{'vatamount'},"");      	
    }       
    IRISTransactionExtract("200-Purchases","Trade Creditors","737","-".$GLOBALS{'netamount'},"");
  } 
 } 
 if ($GLOBALS{'banktxn_paymenttype'} != "Account" ) { # transaction
  if ( floatval($GLOBALS{'banktxn_debit'}) > 0 ) {
    IRISTransactionExtract("200-Purchases","Bank Current Account","692","-".$GLOBALS{'banktxn_debit'},"");
    if (CalculateVAT($GLOBALS{'banktxn_debit'},$GLOBALS{'banktxn_date'},$GLOBALS{'banktxn_vatrateid'},"TransactionPayment")) {
     IRISTransactionExtract("200-Purchases","VAT","755",$GLOBALS{'vatamount'},"");    	
    }
    IRISTransactionExtract("200-Purchases",fincategoryDescription($GLOBALS{'banktxn_fincategoryid'}),convertToIRISCode($GLOBALS{'banktxn_fincategoryid'}),$GLOBALS{'netamount'},"");   
  }
  if ( floatval($GLOBALS{'banktxn_credit'}) > 0 ) {
    IRISTransactionExtract("200-Purchases","Bank Current Account","692",$GLOBALS{'banktxn_credit'},"");
    if (CalculateVAT($GLOBALS{'banktxn_credit'},$GLOBALS{'banktxn_date'},$GLOBALS{'banktxn_vatrateid'},"TransactionPayment")) {
     IRISTransactionExtract("200-Purchases","VAT","755","-".$GLOBALS{'vatamount'},"");      	
    }    
    IRISTransactionExtract("200-Purchases",fincategoryDescription($GLOBALS{'banktxn_fincategoryid'}),convertToIRISCode($GLOBALS{'banktxn_fincategoryid'}),"-".$GLOBALS{'netamount'},"");     
  }	
 }
}

function  CashTxn_IRIS_Extract(){
 # Cash Purchase	I737	25		I668	-25
 # Cash Purchase	Ixxxx	25		I737	-25
 $cashtxna = Get_Array('cashtxn');
 foreach ($cashtxna as $cashtxn_id) {
  Get_Data('cashtxn',$cashtxn_id);
  if (($GLOBALS{'cashtxn_date'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'cashtxn_date'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'cashtxn_processstatus'} != "submitted")) {
   $GLOBALS{'extract_date'} = $GLOBALS{'cashtxn_date'};
   $GLOBALS{'extract_ref'} = str_replace(",","",$GLOBALS{'cashtxn_id'});
   $GLOBALS{'extract_details'} = str_replace(",","",$GLOBALS{'cashtxn_description'});
   if ($GLOBALS{'cashtxn_paymenttype'} == "Account" ) {
   	if ( floatval($GLOBALS{'cashtxn_debit'}) > 0 ) {
   		IRISTransactionExtract("300-PettyCash","668","-".$GLOBALS{'cashtxn_debit'},"");
   		if (CalculateVAT($GLOBALS{'cashtxn_debit'},$GLOBALS{'cashtxn_date'},$GLOBALS{'cashtxn_vatrateid'},"PurchaseInvoicePayment")) {
    	 IRISTransactionExtract("300-PettyCash","VAT","755",$GLOBALS{'vatamount'},"");  			
   		}   		
   		IRISTransactionExtract("300-PettyCash","737",$GLOBALS{'netamount'},"");	
   	}
   	if ( floatval($GLOBALS{'cashtxn_credit'}) > 0 ) {
   		IRISTransactionExtract("300-PettyCash","668",$GLOBALS{'cashtxn_credit'},"");
   		if (CalculateVAT($GLOBALS{'cashtxn_credit'},$GLOBALS{'cashtxn_date'},$GLOBALS{'cashtxn_vatrateid'},"SalesInvoicePayment")) {
         IRISTransactionExtract("300-PettyCash","VAT","755","-".$GLOBALS{'vatamount'},"");    			
   		}   		
   		IRISTransactionExtract("300-PettyCash","737","-".$GLOBALS{'netamount'},"");
  	}
   }
   if ($GLOBALS{'cashtxn_paymenttype'} != "Account" ) { # transaction
   	if ( floatval($GLOBALS{'cashtxn_debit'}) > 0 ) {
   		IRISTransactionExtract("300-PettyCash","Petty Cash","668","-".$GLOBALS{'cashtxn_debit'},"");
   		if (CalculateVAT($GLOBALS{'cashtxn_debit'},$GLOBALS{'cashtxn_date'},$GLOBALS{'cashtxn_vatrateid'},"TransactionPayment")) {
	     IRISTransactionExtract("300-PettyCash","VAT","755",$GLOBALS{'vatamount'},"");   			
   		}   		
   		IRISTransactionExtract("300-PettyCash",fincategoryDescription($GLOBALS{'cashtxn_fincategoryid'}),convertToIRISCode($GLOBALS{'cashtxn_fincategoryid'}),$GLOBALS{'netamount'},""); 	
   	}
   	if ( floatval($GLOBALS{'cashtxn_credit'}) > 0 ) {
   		IRISTransactionExtract("300-PettyCash","Petty Cash","668",$GLOBALS{'cashtxn_credit'},"");
   		if (CalculateVAT($GLOBALS{'cashtxn_credit'},$GLOBALS{'cashtxn_date'},$GLOBALS{'cashtxn_vatrateid'},"TransactionPayment")) {
   		 IRISTransactionExtract("300-PettyCash","VAT","755","-".$GLOBALS{'vatamount'},"");   			
   		}   		
   		IRISTransactionExtract("300-PettyCash",fincategoryDescription($GLOBALS{'cashtxn_fincategoryid'}),convertToIRISCode($GLOBALS{'cashtxn_fincategoryid'}),"-".$GLOBALS{'netamount'},"");
   	}
   }    
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'cashtxn_processstatus'} = "submitted";   	
    Write_Data('cashtxn',$cashtxn_id);
    TracePrint($GLOBALS{'cashtxn_id'}." PROCESSED AS FINAL");
   } 
   else { TracePrint($GLOBALS{'cashtxn_id'}." PROCESSED AS TRIAL"); }    
  } 
  else {TracePrint($GLOBALS{'cashtxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");  }
 } 
}

function  TravelTxn_IRIS_Extract(){
 # Cash Purchase	I737	25		I668	-25
 # Cash Purchase	Ixxxx	25		I737	-25
 $traveltxna = Get_Array('traveltxn');
 foreach ($traveltxna as $traveltxn_id) {
  Get_Data('traveltxn',$traveltxn_id);
  if (($GLOBALS{'traveltxn_date'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'traveltxn_date'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'traveltxn_processstatus'} != "submitted")) {
   $GLOBALS{'extract_date'} = $GLOBALS{'traveltxn_date'};
   $GLOBALS{'extract_ref'} = str_replace(",","",$GLOBALS{'traveltxn_id'});
   $GLOBALS{'extract_details'} = str_replace(",","",$GLOBALS{'traveltxn_description'});      
   if ( floatval($GLOBALS{'traveltxn_debit'}) > 0 ) {
    IRISTransactionExtract("300-PettyCash","Petty Cash","668","-".$GLOBALS{'traveltxn_debit'},""); 
    if (CalculateVAT($GLOBALS{'traveltxn_debit'},$GLOBALS{'traveltxn_date'},$GLOBALS{'traveltxn_vatrateid'},"TransactionPayment")) {
     IRISTransactionExtract("300-PettyCash","VAT","755",$GLOBALS{'vatamount'},"");    	
    }       	
    IRISTransactionExtract("300-PettyCash",fincategoryDescription($GLOBALS{'traveltxn_fincategoryid'}),convertToIRISCode($GLOBALS{'traveltxn_fincategoryid'}),$GLOBALS{'netamount'},"");	
   }
   if ( floatval($GLOBALS{'traveltxn_credit'}) > 0 ) {
    IRISTransactionExtract("300-PettyCash","Petty Cash","668",$GLOBALS{'traveltxn_credit'},"");
    if (CalculateVAT($GLOBALS{'traveltxn_credit'},$GLOBALS{'traveltxn_date'},$GLOBALS{'traveltxn_vatrateid'},"TransactionPayment")) {
     IRISTransactionExtract("300-PettyCash","VAT","755","-".$GLOBALS{'vatamount'},"");    	
    }    
    IRISTransactionExtract("300-PettyCash",fincategoryDescription($GLOBALS{'traveltxn_fincategoryid'}),convertToIRISCode($GLOBALS{'traveltxn_fincategoryid'}),"-".$GLOBALS{'netamount'},"");
   }
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'traveltxn_processstatus'} = "submitted";   	
    Write_Data('traveltxn',$traveltxn_id);
    TracePrint($GLOBALS{'traveltxn_id'}." PROCESSED AS FINAL");
   } 
   else { TracePrint($GLOBALS{'traveltxn_id'}." PROCESSED AS TRIAL"); }    
  } 
  else {TracePrint($GLOBALS{'traveltxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");  }
 } 
}

function  MileageTxn_IRIS_Extract(){
 # Mileage basis	I266	70			
 # Mileage basis	I755	10			
 # Mileage basis	I727-2	-80    Or 1200/692 if paid (See Row 21 above)  Person to be identified

 $mileagetxna = Get_Array('mileagetxn');
 $persona = Get_Array('person'); 
 foreach ($persona as $person_id) {
  foreach ($mileagetxna as $mileagetxn_id) {
   Get_Data('mileagetxn',$mileagetxn_id);
   # print $mileagetxn_id." ".$person_id." READ "."<br>\n";
   if ($GLOBALS{'mileagetxn_personid'} == $person_id) {   
    if (($GLOBALS{'mileagetxn_date'} >= $GLOBALS{'in_startdate'})
       &&($GLOBALS{'mileagetxn_date'} <= $GLOBALS{'in_enddate'})
       &&($GLOBALS{'mileagetxn_processstatus'} != "submitted")) {
     
     Get_Data_Hash_DateEffective('mileageparm',"Miles",$GLOBALS{'mileagetxn_date'});
     Get_Data_Hash_DateEffective('fuelparm', $GLOBALS{'mileagetxn_fuelparmenginetype'}, $GLOBALS{'mileagetxn_date'});
     Get_Data_Hash_DateEffective('companyvatstatus',$GLOBALS{'mileagetxn_date'});
     Get_Data_Hash_DateEffective('vatrate',"T1",$GLOBALS{'mileagetxn_date'});
  
     $mileagerate = floatval($GLOBALS{'mileageparm_rate'});
     $mileageratevatable = floatval($GLOBALS{'fuelparm_rate'});
     $mileagevatrate = floatval($GLOBALS{'vatrate_rate'});        
     $journeyqty = floatval($GLOBALS{'mileagetxn_journeyqty'});
     if ( $journeyqty == 0 ) { $journeyqty = 1; }
     $mileagetotal = floatval($GLOBALS{'mileagetxn_distance'})*$journeyqty;
     $paymenttotal = $mileagetotal * $mileagerate;
     if (($GLOBALS{'companyvatstatus_vattreatment'} == "NC")||($GLOBALS{'companyvatstatus_vattreatment'} == "NI")) {
      $paymentvatpart = $mileagetotal * $mileageratevatable;
      $paymentnonvatpart = $paymenttotal - $paymentvatpart;
      $vatpayable = $paymentvatpart / (1 + (100 / ($mileagevatrate)));
     } else {
      $paymentvatpart = 0;
      $paymentnonvatpart = $paymenttotal;
      $vatpayable = 0;     	
     }     
     
     $GLOBALS{'extract_date'} = $GLOBALS{'mileagetxn_date'};
     $GLOBALS{'extract_ref'} = $person_id." Mileage";
     $GLOBALS{'extract_details'} = $GLOBALS{'mileagetxn_destination'};     
     IRISTransactionExtract("500-Directors Loan","Directors Monies Introduced",$GLOBALS{'IRISDirectorsLoanIntroducedCode'},"-".sprintf("%.2f",$paymenttotal),$person_id);     
     IRISTransactionExtract("500-Directors Loan","VAT","755",sprintf("%.2f",$vatpayable),"");    
     IRISTransactionExtract("500-Directors Loan","Mileage Expenses","266",sprintf("%.2f",$paymenttotal-$vatpayable),"");
        
     if ($GLOBALS{'in_action'} == "Submit") {
      $GLOBALS{'mileagetxn_processstatus'} = "submitted";
      Write_Data('mileagetxn',$mileagetxn_id);
      TracePrint($mileagetxn_id." ".$person_id." PROCESSED AS FINAL ");
     } 
     else { TracePrint($mileagetxn_id." ".$person_id." PROCESSED AS TRIAL "); }
    }
    else {TracePrint($mileagetxn_id." ".$person_id." OUTSIDE RANGE / ALREADY SUBMITTED"); }    
   }
  }
 }
}

function  PayrollTxn_IRIS_Extract(){
 # Payroll Journals	I44  	40	Productive Labour - (Direct) Gross Pay		
 # Payroll Journals	I45	    11	Productive Labour - (Direct) Employers NIC		
 # Payroll Journals	I255	40	Staff Salaries - (InDirect) Gross Pay		
 # Payroll Journals	I256	11	Staff Salaries - (InDirect) Employers NIC		
 # Payroll Journals	I254-1	40	Directors Salaries - Gross Pay  Person to be identified 	
 # Payroll Journals	I254-5	11	Directors Salaries - Employers NIC	Person to be identified	
 # Payroll Journals I738   -80  Net Salaries (Directors and Staff)
 # Payroll Journals	I755   -73  PAYE &NIC (Directors and Staff)

 $payrolltxna = Get_Array('payrolltxn');
 $persona = Get_Array('person');
 foreach ($persona as $person_id) {
  Get_Data('person',$person_id); 	 
   foreach ($payrolltxna as $payrolltxn_id) {
    Get_Data('payrolltxn',$payrolltxn_id);
    # print $payrolltxn_id." ".$person_id." READ "."<br>\n";
    if ($GLOBALS{'payrolltxn_personid'} == $person_id) { 	       
     if (($GLOBALS{'payrolltxn_periodend'} >= $GLOBALS{'in_startdate'})
        &&($GLOBALS{'payrolltxn_periodend'} <= $GLOBALS{'in_enddate'})
        &&($GLOBALS{'payrolltxn_processstatus'} != "submitted")) {     

      $grossnum = floatval($GLOBALS{'payrolltxn_gross'}); 
      $incometaxnum = floatval($GLOBALS{'payrolltxn_incometax'});
      $employeesNICnum = floatval($GLOBALS{'payrolltxn_employeesNIC'});
      $employersNICnum = floatval($GLOBALS{'payrolltxn_employersNIC'});
      $netnum = $grossnum - $incometaxnum - $employeesNICnum; 

      $GLOBALS{'extract_date'} = $GLOBALS{'payrolltxn_periodend'};
      $GLOBALS{'extract_ref'} = $person_id." Payroll";
      $GLOBALS{'extract_details'} =  $person_id." "."Gross - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});
  
      if ($GLOBALS{'person_director'} == "Director") {
       $GLOBALS{'extract_details'} =  $person_id." "."Gross Salary - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});
       IRISTransactionExtract("400-Payroll","Directors Salaries - Gross Pay","254-1",sprintf("%.2f",$grossnum),$person_id);
       $GLOBALS{'extract_details'} =  $person_id." "."Employers NIC - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});       
       IRISTransactionExtract("400-Payroll","Directors Salaries - Employers NIC","254-5",sprintf("%.2f",$employersNICnum),$person_id);
      } else {
       if ($GLOBALS{'person_labourtype'} == "Direct") {    # Direct Labour       
        $GLOBALS{'extract_details'} =  $person_id." "."Gross Salary - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});
        IRISTransactionExtract("400-Payroll","Direct Labour - Gross Pay","44",sprintf("%.2f",$grossnum),"");
        $GLOBALS{'extract_details'} =  $person_id." "."Employers NIC - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});
        IRISTransactionExtract("400-Payroll","Direct Labour - Employers NIC","45",sprintf("%.2f",$employersNICnum),"");
       } else {   # InDirect Labour       
        $GLOBALS{'extract_details'} =  $person_id." "."Gross Salary - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});        
        IRISTransactionExtract("400-Payroll","Staff Salaries - Gross Pay","255",sprintf("%.2f",$grossnum),"");
        $GLOBALS{'extract_details'} =  $person_id." "."Employers NIC - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});        
        IRISTransactionExtract("400-Payroll","Staff Salaries - Employers NIC","256",sprintf("%.2f",$employersNICnum),"");
       }
      }
      $GLOBALS{'extract_details'} =  $person_id." "."Net Salary - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});
      IRISTransactionExtract("400-Payroll","Payroll Control Account","738","-".sprintf("%.2f",$netnum),"");
      $GLOBALS{'extract_details'} =  $person_id." "."PAYE - ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodstart'})." to ".YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'payrolltxn_periodend'});      
      IRISTransactionExtract("400-Payroll","P.A.Y.E/NIC","755","-".sprintf("%.2f",$incometaxnum + $employeesNICnum + $employersNICnum),""); 

      if ($GLOBALS{'in_action'} == "Submit") {
       $GLOBALS{'payrolltxn_processstatus'} = "submitted";
       Write_Data('payrolltxn',$payrolltxn_id);
       TracePrint($payrolltxn_id." ".$person_id." PROCESSED AS FINAL");     	
      } 
      else { TracePrint($payrolltxn_id." ".$person_id." PROCESSED AS TRIAL"); }
     }
     else {TracePrint($payrolltxn_id." ".$person_id." OUTSIDE RANGE / ALREADY SUBMITTED"); 
    }   
   }
  }
 }
}


function  HomeOfficeTxn_IRIS_Extract(){	
 # HomeOfficeTxn - Fixed Rate Claim	I231	65				7204/231 = Use of Home as Office
 # HomeOfficeTxn - Fixed Rate Claim	I727-2	-65	            Person to be identified 
Check_Data('homeoffice',"Home"); 
if ($GLOBALS{'IOWARNING'} == "0") { 
 $roomspercentage = floatval($GLOBALS{'homeoffice_percentage'});
 $homeofficetxna = Get_Array('homeofficetxn');
 foreach ($homeofficetxna as $homeofficetxn_id) {    
  Get_Data('homeofficetxn',$homeofficetxn_id); 
  if (($GLOBALS{'homeofficetxn_periodend'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'homeofficetxn_periodend'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'homeofficetxn_processstatus'} != "submitted")) {
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

   $GLOBALS{'extract_date'} = $GLOBALS{'homeofficetxn_periodend'};
   $GLOBALS{'extract_ref'} = $GLOBALS{'homeofficetxn_id'};
   $GLOBALS{'extract_details'} = $GLOBALS{'homeofficetxn_periodstart'}." to ".$GLOBALS{'homeofficetxn_periodend'};
   IRISTransactionExtract("500-Directors Loan","Use of Home as Office","231",sprintf("%.2f",$homeofficeexpenses),"");      
   IRISTransactionExtract("500-Directors Loan","Directors Monies Introduced",$GLOBALS{'IRISDirectorsLoanIntroducedCode'},"-".sprintf("%.2f",$homeofficeexpenses),"1"); 
     
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'homeofficetxn_processstatus'} = "submitted";   	
    Write_Data('homeofficetxn',$homeofficetxn_id);
    TracePrint($GLOBALS{'homeofficetxn_id'}." ".$homeofficeexpenses." PROCESSED AS FINAL");   	
   } 
   else { TracePrint($GLOBALS{'homeofficetxn_id'}." ".$homeofficeexpenses." PROCESSED AS TRIAL"); }       
  } 
  else { TracePrint($GLOBALS{'homeofficetxn_id'}." OUTSIDE RANGE / ALREADY SUBMITTED"); }
 }
}
}

function  SalesInvoice_IRIS_Extract(){ 
 # SalesInvoice	I586	85		I1 to 10	-85
 $salesinvoicea = Get_Array('salesinvoice');
 foreach ($salesinvoicea as $salesinvoice_id) {
  Get_Data('salesinvoice',$salesinvoice_id);
  if (($GLOBALS{'salesinvoice_date'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'salesinvoice_date'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'salesinvoice_processstatus'} != "submitted")) { 
   $GLOBALS{'extract_date'} = $GLOBALS{'salesinvoice_date'};
   $GLOBALS{'extract_ref'} = $GLOBALS{'salesinvoice_id'};
   $GLOBALS{'extract_details'} = $GLOBALS{'salesinvoice_description'};
   IRISTransactionExtract("100-Sales","Trade Debtors","586",$GLOBALS{'salesinvoice_gross'},"");
   if (CalculateVAT($GLOBALS{'salesinvoice_gross'},$GLOBALS{'salesinvoice_date'},$GLOBALS{'salesinvoice_vatrateid'},"SalesInvoice")) {
    IRISTransactionExtract("100-Sales","VAT","755","-".$GLOBALS{'vatamount'},"");   	
   }   
     
   IRISTransactionExtract("100-Sales",fincategoryDescription($GLOBALS{'salesinvoice_fincategoryid'}),convertToIRISCode($GLOBALS{'salesinvoice_fincategoryid'}),"-".$GLOBALS{'netamount'},"");
   
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'salesinvoice_processstatus'} = "submitted";   	
    Write_Data('salesinvoice',$salesinvoice_id);
    TracePrint($GLOBALS{'salesinvoice_id'}." PROCESSED AS FINAL");
   } 
   else { TracePrint($GLOBALS{'salesinvoice_id'}." PROCESSED AS TRIAL");}    
  }
  else {TracePrint($GLOBALS{'salesinvoice_id'}." OUTSIDE RANGE / ALREADY SUBMITTED"); }
 }
}

function  PurchaseInvoice_IRIS_Extract(){
 # PurchaseInvoice	Ixxxxx	75		I737	-75

 $purchaseinvoicea = Get_Array('purchaseinvoice');
 foreach ($purchaseinvoicea as $purchaseinvoice_id) {
  Get_Data('purchaseinvoice',$purchaseinvoice_id);
  if (($GLOBALS{'purchaseinvoice_date'} >= $GLOBALS{'in_startdate'})
     &&($GLOBALS{'purchaseinvoice_date'} <= $GLOBALS{'in_enddate'})
     &&($GLOBALS{'purchaseinvoice_processstatus'} != "submitted")) {
   $GLOBALS{'extract_date'} = $GLOBALS{'purchaseinvoice_date'};
   $GLOBALS{'extract_ref'} = $GLOBALS{'purchaseinvoice_id'};
   $GLOBALS{'extract_details'} = $GLOBALS{'purchaseinvoice_description'};
   IRISTransactionExtract("200-Purchases","Trade Creditors","737","-".$GLOBALS{'purchaseinvoice_gross'},"");
   if (CalculateVAT($GLOBALS{'purchaseinvoice_gross'},$GLOBALS{'purchaseinvoice_date'},$GLOBALS{'purchaseinvoice_vatrateid'},"PurchaseInvoice")) {
    IRISTransactionExtract("200-Purchases","VAT","755",$GLOBALS{'vatamount'},"");    	
   }      
   IRISTransactionExtract("200-Purchases",fincategoryDescription($GLOBALS{'purchaseinvoice_fincategoryid'}),convertToIRISCode($GLOBALS{'purchaseinvoice_fincategoryid'}),$GLOBALS{'netamount'},""); 
   if ($GLOBALS{'in_action'} == "Submit") {
    $GLOBALS{'purchaseinvoice_processstatus'} = "submitted";   	
    Write_Data('purchaseinvoice',$purchaseinvoice_id);
    TracePrint($GLOBALS{'purchaseinvoice_id'}." PROCESSED AS FINAL"); 	     	
       } else {
    TracePrint($GLOBALS{'purchaseinvoice_id'}." PROCESSED AS TRIAL");   	
     }
}
else {TracePrint($GLOBALS{'purchaseinvoice_id'}." OUTSIDE RANGE / ALREADY SUBMITTED");
}
 }
}

function convertToIRISCode($parm0) {
 // fincategory_id
 Check_Data('fincategory',$parm0);
 if ($GLOBALS{'IOWARNING'} == "1") {
  print '"'.$parm0.'" - code not found.  - '.$GLOBALS{'banktxn_id'}.' - '.$GLOBALS{'banktxn_description'}."<br>\n";
  return "";
 } else {
  # print"$parm0 converted as ".substr($GLOBALS{'fincategory_irisid'},1,4)."<br>";
  return substr($GLOBALS{'fincategory_irisid'},1,4);
 }
}

function fincategoryDescription($parm0) {
 // fincategory_id
 Check_Data('fincategory',$parm0);
 if ($GLOBALS{'IOWARNING'} == "1") {
  return "???";
 } else {
  # print"$parm0 converted as ".substr($GLOBALS{'fincategory_irisid'},1,4)."<br>";
  return $GLOBALS{'fincategory_description'};
 }
}

function  IRISTransactionExtract($category,$txndescription,$acctref,$amountsigned,$personid) {
# Amount, Account, Narrative, Posting Date(ddmmyy), Work Reference
# extract_amountsigned, extract_acctref, extract_details, extract_date, extract_ref
$GLOBALS{'extract_acctref'} = $acctref;
$GLOBALS{'extract_amountsigned'} = $amountsigned;
$personsubcode = "";
if ($personid != "") {
 if ($personid == "0") { $personsubcode = "*0"; }
 if ($personid == "1") { $personsubcode = "*1"; }
 if (($personid != "0")&&($personid != "1")) {
  Check_Data("person",$personid);	
  if ($GLOBALS{'IOWARNING'} != "1") { 
   if ($GLOBALS{'person_irissubcode'} == "") { $personsubcode = "*0"; }
   else { $personsubcode = "*".$GLOBALS{'person_irissubcode'}; }  	
  }
  else {$personsubcode = "*0";}
 }
}
$datastring = "";
$datastring = $datastring.$GLOBALS{'extract_amountsigned'}.",".$GLOBALS{'extract_acctref'}.",".$GLOBALS{'extract_details'}.",";
$datastring = $datastring.YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'extract_date'}).",". $GLOBALS{'extract_ref'}."\n";
fwrite($GLOBALS{'FileHandle'}, $datastring);
array_push($GLOBALS{'transactiona'}, $GLOBALS{'extract_acctref'}.$personsubcode."#".$personid."#".$datastring);
array_push($GLOBALS{'analysisa'}, $category."#".$txndescription."#".$GLOBALS{'extract_acctref'}.$personsubcode."#".$personid."#".$datastring);
}

function IRISSummaryFileCreate() {
 XH1("IRIS Summary File Creation");
 $stransactiona = $GLOBALS{'transactiona'};
 sort($stransactiona); 
 $SFile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/"."IRISSummaryFile.csv";
 $GLOBALS{'SFileHandle'} = fopen($SFile, 'w');
 $old_extract_acctref = ""; $old_extract_totalamountsigned = "";
 $first = "1";
 foreach ( $stransactiona as $transaction) {
  TracePrint($transaction);
  $bits = explode('#',$transaction);
  $this_extract_acctref = $bits[0];    
  $dbits = explode(',',$bits[2]);
  if (($this_extract_acctref != $old_extract_acctref)&&($first != "1")) {  	
   $datastring = "";
   $datastring = $datastring.$old_extract_totalamountsigned.",".$old_extract_acctref.","."Summary".",";
   $datastring = $datastring."SummaryDate".",". "SummaryRef"."\n";
   fwrite($GLOBALS{'SFileHandle'}, $datastring);
   $old_extract_totalamountsigned = 0;         	
  }
  $old_extract_totalamountsigned = $old_extract_totalamountsigned + $dbits[0];
  $old_extract_acctref  = $this_extract_acctref;
  $first = "0"; 
 }
 $datastring = "";
 $datastring = $datastring.$old_extract_totalamountsigned.",".$old_extract_acctref.","."Summary".",";
 $datastring = $datastring."SummaryDate".",". "SummaryRef"."\n";
 fwrite($GLOBALS{'SFileHandle'}, $datastring);
 fclose($GLOBALS{'SFileHandle'});
 $link = YPGMLINK("genericdownloadin.php").YPGMSTDPARMS();
 $link = $link.YPGMPARM("DownloadFileName",$SFile);
 $link = $link.YPGMPARM("Action","delete");
 XLINKTXT($link,"Download Summary File");
}

function IRISAnalysisFileCreate() {
	XH1("IRIS Analysis File Creation");
	#    $category #  txndescription # extract_acctref # $personid # extract_amountsigned,extract_acctref,extract_details,extract_date,extract_ref 
    $stransactiona = $GLOBALS{'analysisa'};
    sort($stransactiona); 
	$AFile = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/"."IRISAnalysisFile.csv";
	$GLOBALS{'AFileHandle'} = fopen($AFile, 'w');
	$old_extract_category = ""; $old_extract_acctref = ""; $old_extract_totalamountsigned = "";
	$first = "1";
	$datastring = "Summaries".","."".","."".","."".","."".","."".","."\n";
	fwrite($GLOBALS{'AFileHandle'}, $datastring);
	$datastring = "".","."".","."".","."".","."".","."".","."\n";
	fwrite($GLOBALS{'AFileHandle'}, $datastring);		
	foreach ( $stransactiona as $transaction) {
		TracePrint($transaction);
		$bits = explode('#',$transaction);
		$this_extract_category = $bits[0];
		$this_extract_txndescription = $bits[1];		
		$this_extract_acctref = $bits[2];
		$dbits = explode(',',$bits[4]);
		$this_extract_amountsigned = $dbits[0];
		$this_extract_details = $dbits[2];
		$this_extract_date = $dbits[3];
		$this_extract_ref = $dbits[4];	
		if (($this_extract_category.$this_extract_acctref != $old_extract_category.$old_extract_acctref)&&($first != "1")) {
			$datastring = "";
			$datastring = $datastring.$old_extract_category.",".$old_extract_acctref.",".$old_extract_totalamountsigned;
			$datastring = $datastring.",".$old_extract_txndescription."\n";
			fwrite($GLOBALS{'AFileHandle'}, $datastring);
			$old_extract_totalamountsigned = 0;
		}
		$old_extract_category  = $this_extract_category;
		$old_extract_txndescription  = $this_extract_txndescription;		
		$old_extract_acctref  = $this_extract_acctref;
		$old_extract_totalamountsigned = $old_extract_totalamountsigned + $dbits[0];		
		$first = "0";
	}
	$datastring = "";
    $datastring = $datastring.$old_extract_category.",".$old_extract_acctref.",".$old_extract_totalamountsigned;
    $datastring = $datastring.",".$old_extract_txndescription."\n";
	fwrite($GLOBALS{'AFileHandle'}, $datastring);

    # DETAILED Transactions	
    
	$datastring = "".","."".","."".","."".","."".","."".","."\n";
	fwrite($GLOBALS{'AFileHandle'}, $datastring);
	$datastring = "Details".","."".","."".","."".","."".","."".","."\n";
	fwrite($GLOBALS{'AFileHandle'}, $datastring);
	$datastring = "".","."".","."".","."".","."".","."".","."\n";
	fwrite($GLOBALS{'AFileHandle'}, $datastring);		
	foreach ( $stransactiona as $transaction) {
		TracePrint($transaction);
		$bits = explode('#',$transaction);
		$this_extract_category = $bits[0];
		$this_extract_acctref = $bits[2];
		$dbits = explode(',',$bits[4]);
		$this_extract_amountsigned = $dbits[0];
		$this_extract_details = $dbits[2];
		$this_extract_date = $dbits[3];
		$this_extract_ref = $dbits[4];			
        $datastring = "";
        $datastring = $datastring.$this_extract_category.",".$this_extract_acctref.",".$this_extract_amountsigned.",";
        $datastring = $datastring.$this_extract_details.",".$this_extract_date.",".$this_extract_ref;
        fwrite($GLOBALS{'AFileHandle'}, $datastring);
	}

	
	fclose($GLOBALS{'AFileHandle'});
	$link = YPGMLINK("genericdownloadin.php").YPGMSTDPARMS();
	$link = $link.YPGMPARM("DownloadFileName",$AFile);
	$link = $link.YPGMPARM("Action","delete");
	XLINKTXT($link,"Download Analysis File");
}

# ==================================  Reset Routines ================================

function  BankTxn_Reset() {
 XH5("Bank Transactions");
 XTABLE();
 XTR();XTDHTXT("ID");XTDHTXT("Date");XTDHTXT("Description");X_TR();
 $banktxna = Get_Array('banktxn');
 sort($banktxna);
 foreach ($banktxna as $banktxn_id) {
  Get_Data('banktxn',$banktxn_id);
  // XPTXT($GLOBALS{'banktxn_date'}." ".$GLOBALS{'banktxn_processstatus'}." ".$GLOBALS{'in_startdate'}." ".$GLOBALS{'in_enddate'});
  if (($GLOBALS{'banktxn_date'} >= $GLOBALS{'in_startdate'})
  &&($GLOBALS{'banktxn_date'} <= $GLOBALS{'in_enddate'})
  &&($GLOBALS{'banktxn_processstatus'} == "submitted")) {
    $GLOBALS{'banktxn_processstatus'} = "allocated";
    Write_Data('banktxn',$banktxn_id);
    XTR();XTDTXT($GLOBALS{'banktxn_id'});XTDTXT($GLOBALS{'banktxn_date'});XTDTXT($GLOBALS{'banktxn_description'});X_TR();
  } 
 }
 X_TABLE();
}


function  CashTxn_Reset() {
 XH5("Cash Transactions");
 XTABLE();
 XTR();XTDHTXT("ID");XTDHTXT("Date");XTDHTXT("Description");X_TR(); 	
 $cashtxna = Get_Array('cashtxn');
 foreach ($cashtxna as $cashtxn_id) {
  Get_Data('cashtxn',$cashtxn_id);
  if (($GLOBALS{'cashtxn_date'} >= $GLOBALS{'in_startdate'})
  &&($GLOBALS{'cashtxn_date'} <= $GLOBALS{'in_enddate'})
  &&($GLOBALS{'cashtxn_processstatus'} == "submitted")) {
    $GLOBALS{'cashtxn_processstatus'} = "allocated";
    Write_Data('cashtxn',$cashtxn_id);
    XTR();XTDTXT($GLOBALS{'cashtxn_id'});XTDTXT($GLOBALS{'cashtxn_date'});XTDTXT($GLOBALS{'cashtxn_description'});X_TR();
  } 
 }
 X_TABLE();  
}

function  TravelTxn_Reset() {
 XH5("Travel Transactions");
 XTABLE();
 XTR();XTDHTXT("ID");XTDHTXT("Date");XTDHTXT("Description");X_TR(); 	
 $traveltxna = Get_Array('traveltxn');
 foreach ($traveltxna as $traveltxn_id) {
  Get_Data('traveltxn',$traveltxn_id);
  if (($GLOBALS{'traveltxn_date'} >= $GLOBALS{'in_startdate'})
  &&($GLOBALS{'traveltxn_date'} <= $GLOBALS{'in_enddate'})
  &&($GLOBALS{'traveltxn_processstatus'} == "submitted")) {
    $GLOBALS{'traveltxn_processstatus'} = "allocated"; 
    Write_Data('traveltxn',$traveltxn_id);
    XTR();XTDTXT($GLOBALS{'traveltxn_id'});XTDTXT($GLOBALS{'traveltxn_date'});XTDTXT($GLOBALS{'traveltxn_description'});X_TR();
  }  
 }
 X_TABLE();
}

function  MileageTxn_Reset() {
 XH5("Mileage Transactions");
 XTABLE();
 XTR();XTDHTXT("ID");XTDHTXT("Person");XTDHTXT("Date");XTDHTXT("Destination");X_TR(); 	
 $mileagetxna = Get_Array('mileagetxn');
 $persona = Get_Array('person');
 foreach ($persona as $person_id) {
  foreach ($mileagetxna as $mileagetxn_id) {
   Get_Data('mileagetxn',$mileagetxn_id);
   if ($GLOBALS{'mileagetxn_personid'} == $person_id) {   
    if (($GLOBALS{'mileagetxn_date'} >= $GLOBALS{'in_startdate'})
	&&($GLOBALS{'mileagetxn_date'} <= $GLOBALS{'in_enddate'})
    &&($GLOBALS{'mileagetxn_processstatus'} == "submitted")) {
	  $GLOBALS{'mileagetxn_processstatus'} = "allocated";
      Write_Data('mileagetxn',$mileagetxn_id);
      XTR();XTDTXT($GLOBALS{'mileagetxn_id'});XTDTXT($GLOBALS{'mileagetxn_personid'});XTDTXT($GLOBALS{'mileagetxn_date'});XTDTXT($GLOBALS{'mileagetxn_destination'});X_TR();
    }
   }
  }
 }
 X_TABLE();
}


function  PayrollTxn_Reset() {
 XH5("Payroll Transactions");
 XTABLE();
 XTR();XTDHTXT("ID");XTDHTXT("Person");XTDHTXT("Start Date");XTDHTXT("End Date");X_TR(); 	
 $payrolltxna = Get_Array('payrolltxn');
 $persona = Get_Array('person');
 foreach ($persona as $person_id) {
  Get_Data('person',$person_id);
  foreach ($payrolltxna as $payrolltxn_id) {
   Get_Data('payrolltxn',$payrolltxn_id);
	if ($GLOBALS{'payrolltxn_personid'} == $person_id) {
	if (($GLOBALS{'payrolltxn_periodend'} >= $GLOBALS{'in_startdate'})
    &&($GLOBALS{'payrolltxn_periodend'} <= $GLOBALS{'in_enddate'})
    &&($GLOBALS{'payrolltxn_processstatus'} == "submitted")) {     
      $GLOBALS{'payrolltxn_processstatus'} = "allocated";
      Write_Data('payrolltxn',$payrolltxn_id);
      XTR();XTDTXT($GLOBALS{'payrolltxn_id'});XTDTXT($GLOBALS{'person_id'});XTDTXT($GLOBALS{'payrolltxn_periodstart'});XTDTXT($GLOBALS{'payrolltxn_periodend'});X_TR(); 
    }
   }
  }
 }
 X_TABLE();
}


function  HomeOfficeTxn_Reset() {
 XH5("Home Office Transactions");
 XTABLE();
 XTR();XTDHTXT("ID");XTDHTXT("Start Date");XTDHTXT("End Date");X_TR(); 
 Check_Data('homeoffice',"Home");
 if ($GLOBALS{'IOWARNING'} == "0") { 
  $homeofficetxna = Get_Array('homeofficetxn');
  foreach ($homeofficetxna as $homeofficetxn_id) {
   Get_Data('homeofficetxn',$homeofficetxn_id);
   if (($GLOBALS{'homeofficetxn_periodend'} >= $GLOBALS{'in_startdate'})
   &&($GLOBALS{'homeofficetxn_periodend'} <= $GLOBALS{'in_enddate'})
   &&($GLOBALS{'homeofficetxn_processstatus'} == "submitted")) {
     $GLOBALS{'homeofficetxn_processstatus'} = "allocated"; 	
     Write_Data('homeofficetxn',$homeofficetxn_id);
     XTR();XTDTXT($GLOBALS{'homeofficetxn_id'});XTDTXT($GLOBALS{'homeofficetxn_periodstart'});XTDTXT($GLOBALS{'homeofficetxn_periodend'});X_TR(); 
   }
  }
 }
 X_TABLE();
}

function  SalesInvoice_Reset() {
 XH5("Sales Invoices");
 XTABLE();
 XTR();XTDHTXT("ID");XTDHTXT("Date");XTDHTXT("Customer");XTDHTXT("Description");X_TR(); 	
 $salesinvoicea = Get_Array('salesinvoice');
 foreach ($salesinvoicea as $salesinvoice_id) {
  Get_Data('salesinvoice',$salesinvoice_id);
  if (($GLOBALS{'salesinvoice_date'} >= $GLOBALS{'in_startdate'})
  &&($GLOBALS{'salesinvoice_date'} <= $GLOBALS{'in_enddate'})
  &&($GLOBALS{'salesinvoice_processstatus'} == "submitted")) {
    $GLOBALS{'salesinvoice_processstatus'} = "allocated";
    Write_Data('salesinvoice',$salesinvoice_id);
    XTR();XTDTXT($GLOBALS{'salesinvoice_id'});XTDTXT($GLOBALS{'salesinvoice_date'});XTDTXT($GLOBALS{'salesinvoice_customerid'});XTDTXT($GLOBALS{'salesinvoice_description'});X_TR();
  }
 }
 X_TABLE();
}

function  PurchaseInvoice_Reset() {
 XH5("Purchase Invoices");
 XTABLE();
 XTR();XTDHTXT("ID");XTDHTXT("Date");XTDHTXT("Supplier");XTDHTXT("Description");X_TR(); 	
 $purchaseinvoicea = Get_Array('purchaseinvoice');
 foreach ($purchaseinvoicea as $purchaseinvoice_id) {
  Get_Data('purchaseinvoice',$purchaseinvoice_id);
  if (($GLOBALS{'purchaseinvoice_date'} >= $GLOBALS{'in_startdate'})
  &&($GLOBALS{'purchaseinvoice_date'} <= $GLOBALS{'in_enddate'})
  &&($GLOBALS{'purchaseinvoice_processstatus'} == "submitted")) {
    $GLOBALS{'purchaseinvoice_processstatus'} = "allocated"; 
    Write_Data('purchaseinvoice',$purchaseinvoice_id);
    XTR();XTDTXT($GLOBALS{'purchaseinvoice_id'});XTDTXT($GLOBALS{'purchaseinvoice_date'});XTDTXT($GLOBALS{'purchaseinvoice_supplierid'});XTDTXT($GLOBALS{'purchaseinvoice_description'});X_TR();
  }
 }
 X_TABLE();
}

# ================================== Common Routines ======================

function  CreditOrDebit($creditcode,$creditfield,$debitcode,$debitfield) {
}
 
function  RemoveMinus($parm0) {
$tempstring = str_replace("-","",$parm0);
return $tempstring;	
}

function TracePrint ($outtext) {
if ($GLOBALS{'in_trace'} == "on") { print $outtext."<br>\n"; }		
}


function  CalculateVAT($gross,$vattxndate,$vattxnrateid,$vattxntype) {
# None[No Vat] FRI[Flat Rate VAT - Invoice Accounting] FRC[Flat Rate VAT - Cash Accounting] NI[Normal VAT - Invoice Accounting] NC[Normal VAT - Cash Accounting];
# SalesInvoice PurchaseInvoice SalesInvoiceReceipt TransactionReceipt PurchaseInvoicePayment TransactionPayment 

Get_Data_Hash_DateEffective('companyvatstatus',$vattxndate);
# XPTXT($GLOBALS{'companyvatstatus_dateeffective'}."|".$GLOBALS{'companyvatstatus_vattreatment'});
$vatrate  = 0;
if (($GLOBALS{'companyvatstatus_vattreatment'} == "FRI")||($GLOBALS{'companyvatstatus_vattreatment'} == "FRC")) {
 Get_Data_Hash_DateEffective('vatflatrate',$GLOBALS{'companyvatstatus_vatflatrateid'},$vattxndate);	
 $vatrate = floatval($GLOBALS{'vatflatrate_rate'}); 
}
if (($GLOBALS{'companyvatstatus_vattreatment'} == "NI")||($GLOBALS{'companyvatstatus_vattreatment'} == "NC")) {
 Get_Data_Hash_DateEffective('vatrate',$vattxnrateid,$vattxndate);		 
 $vatrate  = floatval($GLOBALS{'vatrate_rate'}); 
}

$vatappliestothistransaction = false;
if ($GLOBALS{'companyvatstatus_vattreatment'} == "FRI") {
 if ($vattxntype == "SalesInvoice") { $vatappliestothistransaction = true; }
 if ($vattxntype == "TransactionReceipt") { $vatappliestothistransaction = true; }
}
if ($GLOBALS{'companyvatstatus_vattreatment'} == "FRC") {
 if ($vattxntype == "SalesInvoiceReceipt") { $vatappliestothistransaction = true; }
 if ($vattxntype == "TransactionReceipt") { $vatappliestothistransaction = true; }
}
if ($GLOBALS{'companyvatstatus_vattreatment'} == "NI") {
 if ($vattxntype == "SalesInvoice") { $vatappliestothistransaction = true; }
 if ($vattxntype == "TransactionReceipt") { $vatappliestothistransaction = true; }
 if ($vattxntype == "PurchaseInvoice") { $vatappliestothistransaction = true; }
 if ($vattxntype == "TransactionPayment") { $vatappliestothistransaction = true; }
 
}
if ($GLOBALS{'companyvatstatus_vattreatment'} == "NC") {
 if ($vattxntype == "SalesInvoiceReceipt") { $vatappliestothistransaction = true; }
 if ($vattxntype == "TransactionReceipt") { $vatappliestothistransaction = true; }
 if ($vattxntype == "PurchaseInvoicePayment") { $vatappliestothistransaction = true; }
 if ($vattxntype == "TransactionPayment") { $vatappliestothistransaction = true; }
}

$grossamount = floatval($gross);
if (($vatappliestothistransaction)&&($vatrate > 0)) {
 $vatamount = $grossamount / (1 + (100 / ($vatrate )));
} else {
 $vatamount = 0;
}
$netamount = $grossamount - $vatamount;	
	
$GLOBALS{'vatamount'} = sprintf("%.2f",$vatamount);	
$GLOBALS{'netamount'} = sprintf("%.2f",$netamount);	
# XPTXT($gross."|".$vattxndate."|".$vattxnrateid."|".$GLOBALS{'companyvatstatus_vattreatment'}."|".$vattxntype."|".$GLOBALS{'netamount'}."|".$GLOBALS{'vatamount'}."|".$GLOBALS{'vatrate_rate'});
return $vatappliestothistransaction;
}



?>

