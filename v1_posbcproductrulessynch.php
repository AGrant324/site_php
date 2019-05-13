<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

XH2("Big Commerce Product Rules Synchronisation");

$Q = '"';$POUND = '£';$MINUS= '-';$COMMA= ',';$QQ= '"';$HASH= '#'; $QCQ = '","';	

$productexportarray = Array();  # ARRAY imported product export file from big commerce
$categorya = Array(); # ARRAY DATA categoryname
$errorsfound = "0";

$optionindexa = Array(); 
$bcoptiona = Get_Array('bcoption');
foreach ($bcoptiona as $bcoptionid) {
	Get_Data('bcoption',$bcoptionid);
	$optionindexa[$GLOBALS{'bcoption_name'}] = $bcoptionid;
}

Get_Data('bcaccess','pos');
$dirurl = $GLOBALS{'bcaccess_productexportfolderurl'};
$filename = "products-".$GLOBALS{'yyyy'}."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'}.".csv";
$user = $GLOBALS{'bcaccess_webdavuser'};
$password = $GLOBALS{'bcaccess_webdavpassword'};
$productexportarray = WebDav_Download_File_Array ($dirurl, $filename, $user, $password);

if ($GLOBALS{'IOWARNING'} == "1") { XH3("Error: - Product ExportFile not found"); }


#Header               |Product             |Rule
#==========================================================
#Item Type            |Product             |Rule
#Product Name         |Product Code        |Rule Syntax
#Product Code/SKU     |Product Code        |N/A
#Product Description  |Product Description |N/A
#Category             |Category            |N/A
#Allow Purchases?     |N/A           	   |Y/N

$headerflag = "1";
$lastproductid = "";

$bcoptionseta = Get_Array('bcoptionset');
foreach ($bcoptionseta as $bcoptionsetname) {
	// Delete_Data('bcoptionset',$bcoptionsetname);
	// XTXT('bcoptionset'." ".$bcoptionsetname." Deleted");XBR();
}

$bcproductrulea = Get_Array('bcproductrule');
foreach ($bcproductrulea as $bcproductid) {
	Delete_Data('bcproductrule',$bcproductid);
	// XTXT('bcproductrule'." ".$bcproductid." Deleted");XBR();	
}

foreach ($productexportarray as $productexportarrayelement) {	
 $productexportbits = str_getcsv($productexportarrayelement);	
 if ($headerflag == "1") {
  $headerindex = 0;	
  foreach ($productexportbits as $productexportbit) {	 
   # ===============  setup the indexes to get information from the export file ================================	
   if ($productexportbit == "Item Type") {$itemindex = $headerindex; }
   if ($productexportbit == "Product Id") {$idindex = $headerindex; }
   if ($productexportbit == "Product Code/SKU") {$codeindex = $headerindex; } 		 	
   if ($productexportbit == "Product Name") {$nameindex = $headerindex; } 
   if ($productexportbit == "Option Set") {$optionsetindex = $headerindex; } 
   if ($productexportbit == "Product Description") {$descriptionindex = $headerindex; } 	
   if ($productexportbit == "Category") {$categoryindex = $headerindex; }
   if ($productexportbit == "Allow Purchases?") {$ruleyesnoindex = $headerindex; }  

   $headerindex++;
  }
  $headerflag = "0";    	    	
 } else {
  if ($productexportbits[$itemindex] == "Product") {
  	$ignorerules = "1"; 
  	if (strlen(strstr($productexportbits[$categoryindex],$GLOBALS{'bcaccess_productparsestring'}))>0) {
  		$ignorerules = "0";
  		// Ladies Shoes;Ladies Shoes/Custom Ballroom
  		$categorystring = "";
  		if ($productexportbits[$categoryindex] != "") {
	  		$cbits = explode(";",$productexportbits[$categoryindex]);
	  		$categorystring = $cbits[sizeof($cbits) - 1];   			
	  		Check_Data('bcproductcategory',$categorystring);
	  		if ($GLOBALS{'IOWARNING'} == "1") {
	  			Initialise_Data('bcproductcategory');
	  		}
	  		$GLOBALS{'bcproductcategory_active'} = "Yes";
	  		Write_Data('bcproductcategory',$categorystring);  		
  		}
  		
  		Check_Data('bcproduct',$productexportbits[$codeindex]);
  		if ($GLOBALS{'IOWARNING'} == "1") {
  			Initialise_Data('bcproduct');
  		}   		
  		$GLOBALS{'bcproduct_bcproductcategoryname'} = $productexportbits[$categoryindex];
  		$GLOBALS{'bcproduct_bcoptionsetname'} = $productexportbits[$optionsetindex];
  		Write_Data('bcproduct',$productexportbits[$codeindex]);  		
  	 	// XTXT("Product - ".$productexportbits[$codeindex]." Cat==> ".$categorystring." OptSet==> ".$productexportbits[$optionsetindex]);XBR();
  	 	$lastproductid = $productexportbits[$codeindex];
     }
  } 
  
  if (strlen(strstr($productexportbits[$itemindex],"Rule"))>0) {
  	 // [RT]Style=06
  	 // [RT]Style=30,Style=31,Style=32,Style=33,Style=34,Style=35,Style=36
  	 if ($ignorerules == "0") {
  	 	if ($productexportbits[$ruleyesnoindex] == "Y" ) {
	  	 	// XTXT("Rule --- ".$productexportbits[$nameindex]);XBR();	  	 	
	  	 	$rbits = explode(']',$productexportbits[$nameindex]);
		  	$rbits1 = explode('[',$rbits[0]);
		  	$rulesyntaxtype = $rbits1[1]; 
		  	$rulea = explode(',',$rbits[1]);
		  	foreach ($rulea as $rulestring) {
		  		$rbits2 = explode('=',$rulestring);
		  		$optionname = $rbits2[0];
		  		$optionvalue = $rbits2[1];
		  	 	Check_Data('bcproductrule',$lastproductid,$optionname);
		  	 	if ($GLOBALS{'IOWARNING'} == "1") {
		  	 		Initialise_Data('bcproductrule');
		  	 	}		  		
		  		$GLOBALS{'bcproductrule_valuelist'} = CommaList_Add ($GLOBALS{'bcproductrule_valuelist'}, $optionvalue);
		  	}
			// XTXT("bcproductrule"." ".$lastproductid." ".$optionname." ".$optionvalue);XBR();		
		  	Write_Data('bcproductrule',$lastproductid,$optionname);
	  	 }
  	 }
  } 
  
//  if (strlen(strstr($productexportbits[$itemindex],"SKU"))>0) {
// 	$skubits = explode('-',$productexportbits[$codeindex]);
//  	$skuproductid = $skubits[0];
//  	if ($skuproductid == $lastproductid) {
//  	potentially capture option fields from sku for new pos feeder devices	
//  	}
//  }  
  
  
 }
}

if ($errorsfound == "0") {
 XH5("PROCESS COMPLETED SUCCESSFULLY");
} else {
 XH5("PROCESS COMPLETED WITH ERRORS");		
}

Back_Navigator();
PageFooter("Default","Final");


function PadOut($input,$size) {
$tpad = "000000".$input;
$r="";
if ($size == 1) {$r = substr($tpad,-1);}
if ($size == 2) {$r = substr($tpad,-2);}
if ($size == 3) {$r = substr($tpad,-3);}
if ($size == 4) {$r = substr($tpad,-4);}
if ($size == 5) {$r = substr($tpad,-5);}
if ($size == 6) {$r = substr($tpad,-6);}
# XPTXT($input." ".$size." ".$r);	
return $r;
}



?>


