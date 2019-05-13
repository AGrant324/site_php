<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

$infullstockrefresh = $_REQUEST["FullStockRefresh"];

XH2("Big Commerce Exporter - Step 2 of 3");

if ($infullstockrefresh == "Yes" ) { XH4("Full Stock Refresh");	}

$Q = '"';$POUND = '£';$MINUS= '-';$COMMA= ',';$QQ= '"';$HASH= '#'; $QCQ = '","';	

$uniqueref = "$actyr-$actmon-$actmday-$acthr$actmin$actsec";

$audittrail = Open_File_Write ("C:WatkinsDanceShoes/StockManager/ExpressPagesImport/Audittrail.csv");

$productexportarray = Array();  # ARRAY imported product export file from big commerce
$productcatalogueh = Array(); # HASH KEY productcode DATA productcode|productdescription  
$skuexporta = Array(); # ARRAY DATA size|skucode|stock
$categorya = Array(); # ARRAY DATA categoryname
$categoryskucounth = Array(); # HASH KEY categoryname DATA countofskusincategory
$errorsfound = "0";
$totalstock = 0;

$bcproductcategorya = Get_Array('bcproductcategory');
foreach ($bcproductcategorya as $bcproductcategory_name) {
	array_push($categorya,bcproductcategory_name); $categoryskucounth[bcproductcategory_name] = 0;
}

# === emty existing holding databases =============
$bcproducttempa = Get_Array('bcproducttemp');
foreach ($bcproducttempa as $productid) {
	$bcskutempa = Get_Array('bcskutemp',$productid);
	foreach ($bcskutempa as $skuid) {
		Delete_Data('bcskutemp',$productid, $skuid);			
	}
	Delete_Data('bcproducttemp',$productid);
}

Get_Data('bcaccess','pos');
$dirurl = $GLOBALS{'bcaccess_productexportfolderurl'};
$filename = "products-".$GLOBALS{'yyyy'}."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'}.".csv";
$user = $GLOBALS{'bcaccess_webdavuser'};
$password = $GLOBALS{'bcaccess_webdavpassword'};
$productexportarray = WebDav_Download_File_Array ($dirurl, $filename, $user, $password);

if ($GLOBALS{'IOWARNING'} == "1") { XH3("Error: - Product ExportFile not found"); }

$audittrail = Open_File_Write($GLOBALS{'bcaccess_localstockpagesfolder'}."/Audittrail.csv");
Write_File ($audittrail,"AUDIT TRAIL - ".$uniqueref.",,,,");
Write_File ($audittrail,",,,,,");
  

#Header               |Product             |SKU
#==========================================================
#Item Type            |Product             |SKU
#Product Code/SKU     |Product Code        |SKU Code
#Product Description  |Product Description |N/A
#Current Stock Level  |N/A                 |Current Stock
#Category             |Category            |N/A

#==== set temporary sales feeder indices ===================
$feederindexa = Array();
$feederindex = 1;
$posfeedera = Get_Array('posfeeder');
foreach ($posfeedera as $posfeederid) {
	$feederindexa[$posfeederid] = $feederindex;
	$feederindex++;
}

#==== set reference points defaults ===================
$latestbc_receiptitem_ida = Array();
$highest_receiptitem_ida = Array();
$latestbc_stockitemadded_id = "ST00000";
$highest_stockitemadded_id = "ST00000";
foreach ($posfeedera as $posfeederid) {
	$latestbc_receiptitem_ida[$posfeederid] = $posfeederid."I00000";
	$highest_receiptitem_ida[$posfeederid] = $posfeederid."I00000";
}

#==== build temporary database from bigcommerce product downloads ====================

$headerflag = "1";
$lastproductid = "";

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
   if ($productexportbit == "Product Description") {$descriptionindex = $headerindex; } 	
   if ($productexportbit == "Current Stock Level") {$stockindex = $headerindex; }
   if ($productexportbit == "Low Stock Level") {$lowstockindex = $headerindex; }  		
   if ($productexportbit == "Category") {$categoryindex = $headerindex; }
   $outputheaderstring = frontend($productexportarrayelement,$categoryindex);
   $headerindex++;
  }
  $headerflag = "0";    	    	
 } else {
  if ($productexportbits[$itemindex] == "Product") {
  	 if (strlen(strstr($productexportbits[$categoryindex],$GLOBALS{'bcaccess_productparsestring'}))>0) {
	   	$GLOBALS{'bcproducttemp_data'} = frontend($productexportarrayelement,$categoryindex);
	   	$GLOBALS{'bcproducttemp_category'} = $productexportbits[$categoryindex];
	   	$GLOBALS{'bcproducttemp_description'} = $productexportbits[$descriptionindex];
	   	Write_Data('bcproducttemp',$productexportbits[$codeindex]);
	    # XPTXT('PRODUCT'." ".$productexportbits[$codeindex]);
	    $lastproductid = $productexportbits[$codeindex];
     }
     if ($productexportbits[$codeindex] == "CONTROL") {
     	# |LatestStockAdded=ST00000|R-Sales=RI00000|S-Sales=SI00000|  <= Dont change this text
     	$outputcontrolstring = frontend($productexportarrayelement,$categoryindex);
     	$controlbitsa = explode('|',$productexportbits[$descriptionindex]);
        # XPTXT($productexportbits[$descriptionindex]);
     	foreach ($controlbitsa as $controlelement) {
     		$controlbits2a = explode('=',$controlelement);
     		if ($controlbits2a[0] == "LatestStockAdded")  { 
     			$latestbc_stockitemadded_id = $controlbits2a[1];
     			Write_File ($audittrail,"LatestStockAdded".",".$latestbc_stockitemadded_id.",,,,");
     		}    	
     		foreach ($posfeedera as $posfeederid) {
     			if ($controlbits2a[0] == $posfeederid."-Sales")  { 
     				$latestbc_receiptitem_ida[$posfeederid] = $controlbits2a[1];
     				Write_File ($audittrail,$posfeederid."-Sales".",".$latestbc_receiptitem_ida[$posfeederid].",,,,");
     			}  
     		}
     	}
     }
  } 	
  if (strlen(strstr($productexportbits[$itemindex],"SKU"))>0) {
  	$productexportbits[$codeindex] = str_replace(' ', '_', $productexportbits[$codeindex]);
  	$skubits = explode('-',$productexportbits[$codeindex]);
  	$skuproductid = $skubits[0];
  	if ($skuproductid == $lastproductid) {
  		$GLOBALS{'bcskutemp_data'} = frontend($productexportarrayelement,$categoryindex);
	  	$GLOBALS{'bcskutemp_initialbcstockqty'} = $productexportbits[$stockindex];
		$GLOBALS{'bcskutemp_stockaddedqty'} = 0;
		$GLOBALS{'bcskutemp_possalesqty1'} = 0;
		$GLOBALS{'bcskutemp_possalesqty2'} = 0;
		$GLOBALS{'bcskutemp_possalesqty3'} = 0;
		$GLOBALS{'bcskutemp_possalesqty4'} = 0;
		$GLOBALS{'bcskutemp_possalesqty5'} = 0;
		if ($infullstockrefresh == "Yes" ) { $GLOBALS{'bcskutemp_finalbcstockqty'} = 0; } 	
	  	else { $GLOBALS{'bcskutemp_finalbcstockqty'} = $productexportbits[$stockindex]; } 	
	  	Write_Data('bcskutemp',$lastproductid, $productexportbits[$codeindex]);
	  	Write_File ($audittrail,'INITIALSTOCK'.",".$lastproductid.",".$productexportbits[$codeindex].",".$GLOBALS{'bcskutemp_initialbcstockqty'});
  	}
  } 	
 }
}
Write_File ($audittrail,",,,,,");

#==== add in any stock ====================
if ($infullstockrefresh == "Yes" ) {
	$stockitemaddeda = Get_Array('stockitemadded');
	foreach ($stockitemaddeda as $stockitemaddedid) {
		Delete_Data('stockitemadded',$stockitemaddedid);
		// XPTXT($stockitemaddedid." deleted");
	}
	XPTXT($_FILES["FullStockRefreshFile"]["name"]);
	# uploadname filepath filename allowedfiletypes maxsize add/update prefix
	$maxfilesize = "1000000";
	$uploadstring = Upload_File("FullStockRefreshFile",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"","text/csv/qif/ofx/TEXT/CSV/QIF/OFX",$maxfilesize,"","","","");
	# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
	$stockrefresha = Get_File_Array ($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$_FILES["FullStockRefreshFile"]["name"]);	
	$highest_stockitemadded_id = "ST00000";
	$latestbc_stockitemadded_id = "ST00000";
	foreach ($stockrefresha as $stockrefreshelement) {
		// Product Code 	Style	Shoe Size	Width	Heel Style	Current Stock Level   Supplier Name
		// 2505BE	1	2.5	Regular	2001	1    Supplier
		// XPTXT($stockrefreshelement);		
		$sbits = explode(',',$stockrefreshelement);
		if ($sbits[0] == "Product Code") {}
		else {
			$highest_stockitemadded_id = incrementKey($highest_stockitemadded_id);
			$GLOBALS{'stockitemadded_date'} = $GLOBALS{'currentYYYY-MM-DD'};
			$GLOBALS{'stockitemadded_sku'} = "";
			$sep = ""; $skupartseq = 0;
			Check_Data('bcproduct',$sbits[0]);
			if ($GLOBALS{'IOWARNING'} == "0") {
				Check_Data('bcoptionset',$GLOBALS{'bcproduct_bcoptionsetname'});
				if ($GLOBALS{'IOWARNING'} == "1") {
					Initialise_Data('bcoptionset');
				}
				for ($i = 0; $i <= 6; $i++) {
					if ( $GLOBALS{'bcoptionset_bcoptionname'.$i} != "" ) {
						if ($i == 1) {$sbit = PadOut($sbits[$i],2); } else { $sbit = $sbits[$i]; }  # CHECK - NASTY
						$GLOBALS{'stockitemadded_skupart'.$i} = $sbit;
						// $GLOBALS{'stockitemadded_sku'} = $GLOBALS{'stockitemadded_sku'}.$sep.$sbits[$skupartseq-1]; done later
						$GLOBALS{'stockitemadded_quantity'} = $sbits[5];
						$GLOBALS{'stockitemadded_stocksuppliername'} = $sbits[6];				
						$sep = "-";
					}
				}
				Write_Data('stockitemadded',$highest_stockitemadded_id);			
				// XPTXT($highest_stockitemadded_id." added");
			}
			
		}
	}
}

$stockitemaddeda = Get_Array('stockitemadded');
foreach ($stockitemaddeda as $stockitemaddedid) {
	Get_Data('stockitemadded',$stockitemaddedid);
	$GLOBALS{'stockitemadded_sku'} = "";
	Get_Data('bcproduct',$GLOBALS{'stockitemadded_skupart0'});
	Check_Data('bcoptionset',$GLOBALS{'bcproduct_bcoptionsetname'});
	if ($GLOBALS{'IOWARNING'} == "1") {
		Initialise_Data('bcoptionset');
	}
	$skutext = "";
	$sep = "";		
	for ($i = 0; $i <= 6; $i++) {
		if ( $GLOBALS{'bcoptionset_bcoptionname'.$i} != "" ) {
			$skutext = $skutext.$sep.$GLOBALS{'stockitemadded_skupart'.$i};			
			$sep = "-";
		}		
	}	
	$skutext = str_replace(' ', '_', $skutext);
	$GLOBALS{'stockitemadded_sku'} = $skutext;	
	Write_Data('stockitemadded',$stockitemaddedid);
	if ($stockitemaddedid > $latestbc_stockitemadded_id) {
		if ($stockitemaddedid > $highest_stockitemadded_id) { $highest_stockitemadded_id = $stockitemaddedid; }
		$skubits = explode('-',$GLOBALS{'stockitemadded_sku'});
		$productid = $skubits[0];
		Check_Data('bcskutemp',$productid,$GLOBALS{'stockitemadded_sku'});
		if ($GLOBALS{'IOWARNING'} == "0") {
			$GLOBALS{'bcskutemp_stockaddedqty'} = $GLOBALS{'bcskutemp_stockaddedqty'} + $GLOBALS{'stockitemadded_quantity'};
			# XPTXT("SKU UPDATED - ".$GLOBALS{'stockitemadded_quantity'});			
			$GLOBALS{'bcskutemp_finalbcstockqty'} = $GLOBALS{'bcskutemp_finalbcstockqty'} + $GLOBALS{'stockitemadded_quantity'};
		} else {
			# XPTXT("SKU ADDED - ".$GLOBALS{'stockitemadded_quantity'});
		  	$GLOBALS{'bcskutemp_data'} = "";
		  	$GLOBALS{'bcskutemp_initialbcstockqty'} = 0;
			$GLOBALS{'bcskutemp_stockaddedqty'} =  $GLOBALS{'stockitemadded_quantity'};	
			$GLOBALS{'bcskutemp_possalesqty1'} = 0;
			$GLOBALS{'bcskutemp_possalesqty2'} = 0;
			$GLOBALS{'bcskutemp_possalesqty3'} = 0;
			$GLOBALS{'bcskutemp_possalesqty4'} = 0;
			$GLOBALS{'bcskutemp_possalesqty5'} = 0;
		  	$GLOBALS{'bcskutemp_finalbcstockqty'} = $GLOBALS{'stockitemadded_quantity'};	
		}
		Write_Data('bcskutemp',$productid,$GLOBALS{'stockitemadded_sku'});
		Write_File ($audittrail,'STOCKADDED'.",".$stockitemaddedid.",".$GLOBALS{'stockitemadded_sku'}.",".$GLOBALS{'stockitemadded_quantity'}.","."PROCESSED");
	} else {
		Write_File ($audittrail,'STOCKADDED'.",".$stockitemaddedid.",".$GLOBALS{'stockitemadded_sku'}.",".$GLOBALS{'stockitemadded_quantity'}.","."NOT PROCESSED");		
	}
}
Write_File ($audittrail,",,,,,");

#==== decrement for any pos sales ====================

foreach ($posfeedera as $posfeederid) {
	$dirurl = $GLOBALS{'bcaccess_stockrecordsfolderurl'};
	$filename = $posfeederid."-Sales.csv";
	$user = $GLOBALS{'bcaccess_webdavuser'};
	$password = $GLOBALS{'bcaccess_webdavpassword'};
	$salesarray = WebDav_Download_File_Array ($dirurl, $filename, $user, $password);
	
	if ($GLOBALS{'IOWARNING'} == "1") {
		XTXT("Warning: - No sales file for POS ".$posfeederid);XBR();
		Write_File ($audittrail,"SALES FILE-".$posfeederid.","."NONE FOUND".",,,");
	} else {
		Write_File ($audittrail,"SALES FILE-".$posfeederid.",".$filename.",,,");		
		foreach ($salesarray as $saleselement) {
			$salesbits = str_getcsv($saleselement);
			$receiptitem_id = $salesbits[1];
			$receiptitem_sku = $salesbits[4];
			$receiptitem_orderstatus = $salesbits[9];			
			$receiptitem_quantity = $salesbits[10];
			if ($receiptitem_id > $latestbc_receiptitem_ida[$posfeederid]) {
				if ($receiptitem_id > $highest_receiptitem_ida[$posfeederid]) { $highest_receiptitem_ida[$posfeederid] = $receiptitem_id; }
				if ($receiptitem_orderstatus == "Delivered") {
					$skubits = explode('-',$receiptitem_sku);
					$productid = $skubits[0];
					$feederfield = 'bcskutemp_possalesqty'.$feederindexa[$posfeederid];
					Check_Data('bcskutemp',$productid,$receiptitem_sku);
					if ($GLOBALS{'IOWARNING'} == "0") {
						$GLOBALS{$feederfield} = $GLOBALS{$feederfield} - $receiptitem_quantity;
						if ($infullstockrefresh == "Yes" ) {  } 	
	  					else { $GLOBALS{'bcskutemp_finalbcstockqty'} = $GLOBALS{'bcskutemp_finalbcstockqty'} - $receiptitem_quantity; } 			
					} else {
					  	$GLOBALS{'bcskutemp_data'} = "";
					  	$GLOBALS{'bcskutemp_initialbcstockqty'} = 0;
						$GLOBALS{'bcskutemp_stockaddedqty'} = 0;	
						$GLOBALS{'bcskutemp_stockaddedqty'} = 0;
						$GLOBALS{'bcskutemp_possalesqty1'} = 0;
						$GLOBALS{'bcskutemp_possalesqty2'} = 0;
						$GLOBALS{'bcskutemp_possalesqty3'} = 0;
						$GLOBALS{'bcskutemp_possalesqty4'} = 0;
						$GLOBALS{'bcskutemp_possalesqty5'} = 0;
						$GLOBALS{$feederfield} = 0 - $receiptitem_quantity;				
						if ($infullstockrefresh == "Yes" ) {  } 	
	  					else { $GLOBALS{'bcskutemp_finalbcstockqty'} = 0 - $receiptitem_quantity; } 
					}
					Write_Data('bcskutemp',$productid,$receiptitem_sku);
					Write_File ($audittrail,'SALESUBTRACTED'.",".$receiptitem_id.",".$receiptitem_sku.",".$receiptitem_quantity.",".$receiptitem_orderstatus.","."PROCESSED - DELIVERED");
				} else {
					Write_File ($audittrail,'SALESUBTRACTED'.",".$receiptitem_id.",".$receiptitem_sku.",".$receiptitem_quantity.",".$receiptitem_orderstatus.","."PROCESSED - PUT ON ORDER");					
				}
			} else {
				Write_File ($audittrail,'SALESUBTRACTED'.",".$receiptitem_id.",".$receiptitem_sku.",".$receiptitem_quantity.",".$receiptitem_orderstatus.","."NOT PROCESSED");									
			}
		}		
	}	
}
Write_File ($audittrail,",,,,,");

#==== display results ====================
$initialbctotalstock = 0;
$finalbctotalstock = 0;
XH4("Summary of Stock Sales and Stock Increments");
XTABLE();
XTR();
XTDHTXT("Product");
XTDHTXT("SKU");
XTDHTXT("BCStock");
if ($infullstockrefresh == "Yes" ) { XTDHTXT("<b>StockReset</b>"); }
else {XTDHTXT("StockAdded");} 
foreach ($posfeedera as $posfeederid) { XTDHTXT("POS-".$posfeederid); }
if ($infullstockrefresh == "Yes" ) { XTDHTXT("<b>ResetBCStock</b>"); }
else {XTDHTXT("UpdatedBCStock"); }
XTDHTXT("");
X_TR();
XTR();
XTDHTXT("");
XTDHTXT("");
XTDHTXT("");
XTDHTXT($latestbc_stockitemadded_id);
foreach ($posfeedera as $posfeederid) {
	XTDHTXT($latestbc_receiptitem_ida[$posfeederid]);
}
XTDHTXT("");
XTDHTXT("");
X_TR();

$bcproducttempa = Get_Array('bcproducttemp');
foreach ($bcproducttempa as $productid) {
	XTR();
	XTDTXT($productid);
	XTDTXT("");
	XTDTXT("");
	XTDTXT("");
	foreach ($posfeedera as $posfeederid) { XTDTXT(""); }
	XTDTXT("");
	XTDTXT("");
	X_TR();	
	$bcskutempa = Get_Array('bcskutemp',$productid);
	foreach ($bcskutempa as $skuid) {
		Get_Data('bcskutemp',$productid,$skuid);
		XTR();
		XTDTXT("");
		XTDTXT($skuid);
		$skuexportbits2 = explode('-',$skuid  );
		$skuproductcode = $skuexportbits2[0];
		$skuproductcorecode = substr($skuproductcode,0,4);
		$skuproductcategorycode = substr($skuproductcode,4,1);
		$skustylecode = PadOut($skuexportbits2[1],2);
		$skusizecode = $skuexportbits2[2];
		$imagemessage = "";
		$imagename = $skuproductcorecode.$skustylecode.$skuproductcategorycode.".jpg";
		if (file_exists("C:WatkinsDanceShoes/Images/".$imagename)) {} else { $imagemessage = "No Image Found - ".$imagename; }			
		XTDTXT($GLOBALS{'bcskutemp_initialbcstockqty'});
		$initialbctotalstock = $initialbctotalstock + $GLOBALS{'bcskutemp_initialbcstockqty'};
		if ($GLOBALS{'bcskutemp_stockaddedqty'} != 0) {
			if ($infullstockrefresh == "Yes" ) { XTDTXT("<b>".$GLOBALS{'bcskutemp_stockaddedqty'}."</b>"); }
			else {XTDTXT($GLOBALS{'bcskutemp_stockaddedqty'}); }
  		} else { XTDTXT(""); }
		foreach ($posfeedera as $posfeederid) { 
			if ($GLOBALS{'bcskutemp_possalesqty'.$feederindexa[$posfeederid]} != 0) { 
				XTDTXT($GLOBALS{'bcskutemp_possalesqty'.$feederindexa[$posfeederid]});
			} else { XTDTXT(""); } 
		}
		// $finalstocktxt = "";
		// if ($GLOBALS{'bcskutemp_finalbcstockqty'} > 0 ) { $finalstocktxt = '<span style="color:green">'.$GLOBALS{'bcskutemp_finalbcstockqty'}.'</span>'; }
		// if ($GLOBALS{'bcskutemp_finalbcstockqty'} = 0 ) { $finalstocktxt = '<span style="color:orange">'.$GLOBALS{'bcskutemp_finalbcstockqty'}.'</span>'; }		
		// if ($GLOBALS{'bcskutemp_finalbcstockqty'} < 0 ) { $finalstocktxt = '<span style="color:red">'.$GLOBALS{'bcskutemp_finalbcstockqty'}.'</span>'; }
		$stockmessage = "";
		if ($GLOBALS{'bcskutemp_finalbcstockqty'} == 0 ) { $stockmessage = " (Zero Stock!!)"; }		
		if ($GLOBALS{'bcskutemp_finalbcstockqty'} < 0 ) { $stockmessage = " (Negative Stock!!)"; }	
		XTDTXT($GLOBALS{'bcskutemp_finalbcstockqty'}.$stockmessage);
		XTDTXT($imagemessage);		
		$finalbctotalstock = $finalbctotalstock + $GLOBALS{'bcskutemp_finalbcstockqty'};		
		X_TR();
	}
}
XTR();
XTDHTXT("");
XTDHTXT("");
XTDHTXT($initialbctotalstock);
XTDHTXT($highest_stockitemadded_id);
foreach ($posfeedera as $posfeederid) {
	XTDHTXT($highest_receiptitem_ida[$posfeederid]);
}
XTDHTXT($finalbctotalstock);
XTDHTXT("");
X_TR();
X_TABLE();
XH4("Files Created");

Write_File ($audittrail,",,,,,");

#==== refactor and create array by category and shoe size in preparation for webpage creation ====================

$bcproducttempa = Get_Array('bcproducttemp');
foreach ($bcproducttempa as $productid) {
	Get_Data('bcproducttemp',$productid);
	$newcategory = "1";
	foreach ($categorya as $categoryelement) {
		if ($categoryelement == $GLOBALS{'bcproducttemp_category'}) {
			$newcategory = "0";
		}
	}
	if ($newcategory == "1") {
		array_push($categorya,$GLOBALS{'bcproducttemp_category'});
		$categoryskucounth[$GLOBALS{'bcproducttemp_category'}] = 0;
		Write_File ($audittrail,"CATEGORY ADDED".",".$GLOBALS{'bcproducttemp_category'}.",,,");
	}
	$productcatalogueh{$productid} = $productid."|".$GLOBALS{'bcproducttemp_category'}."|".$GLOBALS{'bcproducttemp_description'};
	# Write_File ($audittrail,$productid."=".$productid."|".$GLOBALS{'bcproducttemp_category'}."|".$GLOBALS{'bcproducttemp_description'});	

	$bcskutempa = Get_Array('bcskutemp',$productid);
	foreach ($bcskutempa as $skuid) {
		Get_Data('bcskutemp',$productid,$skuid);
		$skuexportbits2 = explode('-',$GLOBALS{'bcskutemp_skuid'}  );
		$skuproductcode = $skuexportbits2[0];
		$skuproductcorecode = substr($skuproductcode,0,4);
		$skuproductcategorycode = substr($skuproductcode,4,1);
		$skustylecode = PadOut($skuexportbits2[1],2);			
		$skusizecode = $skuexportbits2[2];			
		$include = "0";
		if ($GLOBALS{'bcskutemp_finalbcstockqty'} > 0) { $include = "1"; }
		$imagename = $skuproductcorecode.$skustylecode.$skuproductcategorycode.".jpg";
		if (file_exists("C:WatkinsDanceShoes/Images/".$imagename)) { $include = "1"; }		
		if ($include == "1") {			
			if (strlen(strstr($skusizecode,'.'))>0 ) {} 
			else { $skusizecode = $skusizecode.".0";	}
			$skusizecode = PadOut($skusizecode,5);
			array_push($skuexporta,$skusizecode."|".$skuid."|".$GLOBALS{'bcskutemp_finalbcstockqty'});
			Write_File ($audittrail,"SKU ADDED".",".$skusizecode."|".$skuid."|".$GLOBALS{'bcskutemp_finalbcstockqty'}.",,,");
		}		
	}
}
sort($skuexporta);
Write_File ($audittrail,",,,,,");

# determine which categories have stock to display by counting skus
foreach ($skuexporta as $skuexportelement) {	
 # XPTXT($skuexportelement." SKU PROCESSED");
 Write_File ($audittrail,"SKU PROCESSED".",".$skuexportelement).",,,";  	
 $skuexportbits1 = explode('|',$skuexportelement);
 $skucode = $skuexportbits1[1];  	
 $skuexportbits2 = explode('-',$skucode);  	
 $skuproductcode = $skuexportbits2[0];
 # XPTXT($skuproductcode." SKUPRODUCTCODE");       
 $productcatalogueelement = $productcatalogueh{$skuproductcode}; 
 # XPTXT($productcatalogueelement." PRODUCTELEMENT");       
 $productcataloguebits = explode('|',$productcatalogueelement);
 $categoryskucounth{$productcataloguebits[1]} = $categoryskucounth{$productcataloguebits[1]} + 1;
 Write_File ($audittrail," SKU FOUND".",".$productcataloguebits[1].",,,");
 # XPTXT($skuproductcode." ".$productcataloguebits[1]." SKU FOUND");      
}  

#==== format stock lists ====================
Write_File ($audittrail,",,,,");
Write_File ($audittrail,"OUTPUT".",,,,");
Write_File ($audittrail,",,,,");
foreach ($categorya as $categoryelement) {	
 Write_File ($audittrail,"CATEGORY"."|".$categoryelement.",,,");
 $categoryelementbits = explode('/',$categoryelement);
 # "Express Delivery/Ladies Latin" "Express Delivery/Boys"
 $categoryclass = $categoryelementbits[1];       
 if (strlen(strstr($categoryelement,$GLOBALS{'bcaccess_productparsestring'})) >0) {	 
  $expresspagename = $categoryelement;
  $expresspagename = str_replace('/', '-', $expresspagename);
  $expresspagename = str_replace(' ', '_', $expresspagename);  
  $expresspageoutput = Open_File_Write ($GLOBALS{'bcaccess_localstockpagesfolder'}."/".$expresspagename.".html");
  
  # XPTXT($categoryelement." CATEGORY STOCK ".$categoryskucounth{$categoryelement});
  if ($categoryskucounth{$categoryelement} == 0) {
   Write_File ($expresspageoutput,'<h4>Sorry - No items available in this category at present.</h4>');
   Write_File ($expresspageoutput,'<p>We can always arrange for shoes to be custom made for you.</p>');     	 	
  }else {  
   Write_File ($expresspageoutput,'<div id="'.sizetabs.'">');
   $oldskusizecode = "";	 
   Write_File ($expresspageoutput,'<ul>');    
   foreach ($skuexporta as $skuexportelement) {		
    $skuexportbits1 = explode('|',$skuexportelement);
    if (strlen(strstr($skuexportbits1[1],'-'))>0) {	    
     $skucode = $skuexportbits1[1];  	
     $skuexportbits2 = explode('-',$skuexportbits1[1]);  	
     $skuproductcode = $skuexportbits2[0];
     $skuproductcorecode = substr($skuproductcode,0,4); 
     $skustylecode = $skuexportbits2[1];   
     $skusizecode = $skuexportbits2[2];
     $skusizecodediv = $skusizecode; 
     $skusizecodediv = str_replace('.', '-', $skusizecodediv);     
     $skuwidthcode = $skuexportbits2[3];   
     $skuheelcode = $skuexportbits2[4];
     $productcatalogueelement = $productcatalogueh{$skuproductcode};   
     $productcataloguebits = explode('|',$productcatalogueelement);     
     if ($categoryelement == $productcataloguebits[1]) {
      if ($skusizecode != $oldskusizecode) {
       Write_File ($expresspageoutput,'<li><a href="#'.$skusizecodediv.'"> Size '.$skusizecode.'</a></li>');
       $oldskusizecode = $skusizecode;      	
      }     	
     }        
    }
   }
   Write_File ($expresspageoutput,'</ul>'); 
     
   $oldskusizecode = "";	  	
   foreach ($skuexporta as $skuexportelement) {		
    $skuexportbits1 = explode('|',$skuexportelement);
    if (strlen(strstr($skuexportbits1[1],'-'))>0) {	    
     $skucode = $skuexportbits1[1];  	
     $skuexportbits2 = explode('-',$skuexportbits1[1]);  	
     $skuproductcode = $skuexportbits2[0];
     $skuproductcorecode = substr($skuproductcode,0,4);
     $skuproductcategorycode = substr($skuproductcode,4,1);
     $skuproductcustexpresscode = substr($skuproductcode,5,1);       
     $skustylecode = $skuexportbits2[1];     // NASTY
     $skusizecode = $skuexportbits2[2];
     $skusizecodediv = $skuexportbits2[2];
     $skusizecodediv = str_replace('.', '-', $skusizecodediv);
     $skuwidthcode = $skuexportbits2[3];   
     $skuheelcode = $skuexportbits2[4];
     $productcatalogueelement = $productcatalogueh{$skuproductcode};   
     $productcataloguebits = explode('|',$productcatalogueelement);
     if ($categoryelement == $productcataloguebits[1]) {
      if ($skusizecode != $oldskusizecode) {
       if ($oldskusizecode != "") {
        Write_File ($expresspageoutput,'</tbody>');     	
        Write_File ($expresspageoutput,'</table>');
        Write_File ($expresspageoutput,'</div>');      
       }
       Write_File ($expresspageoutput,'<div id="'.$skusizecodediv.'"><h3>Size '.$skusizecode.'</h3>');     
       Write_File ($expresspageoutput,'<table style="text-align: left;" border="0" cellspacing="2" cellpadding="2">');
       Write_File ($expresspageoutput,'<tbody>');  
       Write_File ($expresspageoutput,'<tr>');  
       if ($skuproductcustexpresscode == "E") { $grad = "pinkgrad"; } else { $grad = "bluegrad"; }
       Write_File ($expresspageoutput,'<td style="vertical-align: middle; padding:5px; background-image: url('."'".'http://www.watkinsdanceshoes.co.uk/product_images/import/'.$grad.'.png'."'".'); background-repeat: repeat-x; color: #ffffff; width: 200px;">Image</td>');
       Write_File ($expresspageoutput,'<td style="vertical-align: middle; padding:5px; background-image: url('."'".'http://www.watkinsdanceshoes.co.uk/product_images/import/'.$grad.'.png'."'".'); background-repeat: repeat-x; color: #ffffff; width: 200px;">Description</td>');
       Write_File ($expresspageoutput,'<td style="vertical-align: middle; padding:5px; background-image: url('."'".'http://www.watkinsdanceshoes.co.uk/product_images/import/'.$grad.'.png'."'".'); background-repeat: repeat-x; color: #ffffff; width: 80px;">Product</td>');
       Write_File ($expresspageoutput,'<td style="vertical-align: middle; padding:5px; background-image: url('."'".'http://www.watkinsdanceshoes.co.uk/product_images/import/'.$grad.'.png'."'".'); background-repeat: repeat-x; color: #ffffff; width: 80px;">Style</td>');
       Write_File ($expresspageoutput,'<td style="vertical-align: middle; padding:5px; background-image: url('."'".'http://www.watkinsdanceshoes.co.uk/product_images/import/'.$grad.'.png'."'".'); background-repeat: repeat-x; color: #ffffff; width: 80px;">Size</td>');
       Write_File ($expresspageoutput,'<td style="vertical-align: middle; padding:5px; background-image: url('."'".'http://www.watkinsdanceshoes.co.uk/product_images/import/'.$grad.'.png'."'".'); background-repeat: repeat-x; color: #ffffff; width: 80px;">Width</td>');
       
       Check_Data('bcproduct',$skuproductcode);  // NASTY
	   Check_Data('bcoptionset',$GLOBALS{'bcproduct_bcoptionsetname'});   // NASTY
	   if ($GLOBALS{'bcoptionset_bcoptionname4'} == "Heel") {  // NASTY
        Write_File ($expresspageoutput,'<td style="vertical-align: middle; padding:5px; background-image: url('."'".'http://www.watkinsdanceshoes.co.uk/product_images/import/'.$grad.'.png'."'".'); background-repeat: repeat-x; color: #ffffff; width: 80px;">Heel</td>');
       }
       Write_File ($expresspageoutput,'<td style="vertical-align: middle; padding:5px; background-image: url('."'".'http://www.watkinsdanceshoes.co.uk/product_images/import/'.$grad.'.png'."'".'); background-repeat: repeat-x; color: #ffffff; width: 80px;">View</td>');
       Write_File ($expresspageoutput,'</tr>');
       $oldskusizecode = $skusizecode;      	
      }     	   
      Write_File ($audittrail,"EXPRESSPAGEOUTPUT".",".$category|$skuproductcode|$skuexportelement).",,,,";
      Write_File ($expresspageoutput,'<tr>');  
 
      $skucodelink = "";
      $sep = "";
      if ($GLOBALS{'bcoptionset_bcoptionname0'} != "") { $skucodelink = $skucodelink.$sep.$GLOBALS{'bcoptionset_bcoptionname0'}.'='.$skuexportbits2[0]; $sep = ','; }
      if ($GLOBALS{'bcoptionset_bcoptionname1'} != "") { $skucodelink = $skucodelink.$sep.$GLOBALS{'bcoptionset_bcoptionname1'}.'='.$skuexportbits2[1]; $sep = ','; }     
      if ($GLOBALS{'bcoptionset_bcoptionname2'} != "") { $skucodelink = $skucodelink.$sep.$GLOBALS{'bcoptionset_bcoptionname2'}.'='.$skuexportbits2[2]; $sep = ','; }
      if ($GLOBALS{'bcoptionset_bcoptionname3'} != "") { $skucodelink = $skucodelink.$sep.$GLOBALS{'bcoptionset_bcoptionname3'}.'='.$skuexportbits2[3]; $sep = ','; }       
      if ($GLOBALS{'bcoptionset_bcoptionname4'} != "") { $skucodelink = $skucodelink.$sep.$GLOBALS{'bcoptionset_bcoptionname4'}.'='.$skuexportbits2[4]; $sep = ','; }
      if ($GLOBALS{'bcoptionset_bcoptionname5'} != "") { $skucodelink = $skucodelink.$sep.$GLOBALS{'bcoptionset_bcoptionname5'}.'='.$skuexportbits2[5]; $sep = ','; }      
      if ($GLOBALS{'bcoptionset_bcoptionname6'} != "") { $skucodelink = $skucodelink.$sep.$GLOBALS{'bcoptionset_bcoptionname6'}.'='.$skuexportbits2[6]; $sep = ','; } 

      $skucodelink = str_replace(" ", "_", $skucodelink);
      $imagename = $skuproductcorecode.$skustylecode.$skuproductcategorycode.".jpg";   
      if (file_exists("C:WatkinsDanceShoes/Images/".$imagename)) {
      } else {      
       Write_File ($audittrail,"Warning".",".$imagename." - Not Found".",,,");
       $imagename = "NoImage.jpg";
      } 
      Write_File ($expresspageoutput,'<td style="vertical-align: middle;"><a href="http://www.watkinsdanceshoes.co.uk/'.$skuproductcode.'/?skutype=stock,'.$skucodelink.'" target="_blank"><img style="border: 0px solid; width: 150px;"'
             .' src="http://www.watkinsdanceshoes.co.uk/product_images/import/'.$imagename.'" alt="" /></a></td>');
      Write_File ($expresspageoutput,'<td style="vertical-align: middle;">'.$productcataloguebits[1].'</td>');
      Write_File ($expresspageoutput,'<td style="vertical-align: middle;">'.$skuproductcode.'</td>');
      Write_File ($expresspageoutput,'<td style="vertical-align: middle;">'.$skustylecode.'</td>');
      Write_File ($expresspageoutput,'<td style="vertical-align: middle;">'.$skusizecode.'</td>');
      Write_File ($expresspageoutput,'<td style="vertical-align: middle;">'.$skuwidthcode.'</td>');
	  if ($GLOBALS{'bcoptionset_bcoptionname4'} == "Heel") {  // NASTY
       Write_File ($expresspageoutput,'<td style="vertical-align: middle;"><a href="http://www.watkinsdanceshoes.co.uk/'.$skuproductcode.'/?skutype=stock,'.$skucodelink.'" target="_blank"><img style="border: 0px solid; width: 60px;"'
             .' src="http://www.watkinsdanceshoes.co.uk/product_images/import/'.$skuheelcode.'.png" alt="" /></a></td>');     
      }
      Write_File ($expresspageoutput,'<td style="vertical-align: middle;"><a href="http://www.watkinsdanceshoes.co.uk/'.$skuproductcode.'/?skutype=stock,'.$skucodelink.'" target="_blank">View</a></td>');
      Write_File ($expresspageoutput,'</tr>');
     }        
    }        	   
   }
   Write_File ($expresspageoutput,'</tbody>');   
   Write_File ($expresspageoutput,'</table>');     
   Write_File ($expresspageoutput,'</div>');  
   if ($heelrequired{$categoryclass} == "Yes") {
    Write_File ($expresspageoutput,'<p>Please note that the heel style may differ from that shown on the shoe image</p>');
   }   
  }
  Close_File($expresspageoutput);
  XTXT($GLOBALS{'bcaccess_localstockpagesfolder'}."/".$expresspagename.".html"." Created");XBR();
 }
}

#==== create importable  procuct file ====================
$productfilename = "products-".$GLOBALS{'yyyy'}."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'}."-upload.csv";
$productfileoutput = Open_File_Write ($GLOBALS{'bcaccess_localproductimportfolder'}."/".$productfilename);
Write_File ($productfileoutput,$outputheaderstring);

$bcproducttempa = Get_Array('bcproducttemp');
foreach ($bcproducttempa as $productid) {
	Get_Data('bcproducttemp',$productid);
	Write_File ($productfileoutput,$GLOBALS{'bcproducttemp_data'});	
	$bcskutempa = Get_Array('bcskutemp',$productid);
	foreach ($bcskutempa as $skuid) {

		Get_Data('bcskutemp',$productid,$skuid);			
		# 1601LE-04-3-Regular-2899
		# [RT]Style=04,[RT]Shoe Size=3,[RB]Width=Regular,[CS]Heel=2899:294.preview.png			
		$skubits = explode('-',$skuid);
		$stockstyle = PadOut($skubits[1],2);
		$stockshoesize = $skubits[2];
		$stockwidth = $skubits[3];
		$stockheel = $skubits[4];
		$stockskuoptions = '"'."[RT]Style=".$stockstyle.",";
		Check_Data('bcproduct',$skubits[0]);  // NASTY
		Check_Data('bcoptionset',$GLOBALS{'bcproduct_bcoptionsetname'});   // NASTY
		if ($GLOBALS{'bcoptionset_bcoptionname2'} == "Shoe Size") {			
			$stockskuoptions = $stockskuoptions."[RT]Shoe Size=".$stockshoesize.",";
		}
		if ($GLOBALS{'bcoptionset_bcoptionname2'} == "Shoe Size") {	  // NASTY	
			$stockskuoptions = $stockskuoptions."[RT]Childrens Shoe Size=".$stockshoesize.",";
		}
		if ($GLOBALS{'bcoptionset_bcoptionname3'} == "Width") {  // NASTY
			$stockskuoptions = $stockskuoptions."[RB]Width=".$stockwidth.'"';  
		}
		if ($GLOBALS{'bcoptionset_bcoptionname4'} == "Heel") {  // NASTY
			$stockskuoptions = $stockskuoptions."[CS]Heel=".$stockheel.":".$heels{$stockheel}.".preview.png".",";
		}			 
		// XTXT($skuid." ".$stockskuoptions);XBR();		
		if ($GLOBALS{'bcskutemp_data'} == "") { # New SKU - was not on downloaded file
			$skurecordbits = Array();
			for( $i = 0; $i < $categoryindex+1; $i++ ) { $skurecordbits[$i] = ""; }			
			$skurecordbits[$itemindex] = "SKU";	
			$skurecordbits[$codeindex] = $GLOBALS{'bcskutemp_skuid'};		
			$skurecordbits[$nameindex] = $stockskuoptions;
			$skurecordbits[$stockindex] = $GLOBALS{'bcskutemp_finalbcstockqty'};		
			$skurecordbits[$lowstockindex] = "1";
			$GLOBALS{'bcskutemp_data'} = array2csv($skurecordbits);
		} else { # Update stockquantity on existing SKU record  - update option details to ensure of any corrections
			$GLOBALS{'bcskutemp_data'} = supersub($GLOBALS{'bcskutemp_data'},$nameindex,$stockskuoptions);
			$GLOBALS{'bcskutemp_data'} = supersub($GLOBALS{'bcskutemp_data'},$stockindex,$GLOBALS{'bcskutemp_finalbcstockqty'});
		}
		Write_File ($productfileoutput,$GLOBALS{'bcskutemp_data'});		
	}
}
# <p>|LatestStockAdded=ST00066|R-Sales=RI00077|S-Sales=SI00088|&nbsp; &lt;= Dont change this text</p>
$controlparameters = "<p>|LatestStockAdded=".$highest_stockitemadded_id."|";
foreach ($posfeedera as $posfeederid) {
	$controlparameters = $controlparameters.$posfeederid."-Sales=".$highest_receiptitem_ida[$posfeederid]."|";
}
$controlparameters = $controlparameters."&nbsp; &lt;= Dont change this text</p>";
$outputcontrolstring = supersub($outputcontrolstring,$descriptionindex,$controlparameters);
Write_File ($productfileoutput,$outputcontrolstring);
Close_File($productfileoutput);
XTXT($GLOBALS{'bcaccess_localproductimportfolder'}."/".$productfilename." Created");XBR();

XH4("Upload Results to Big Commerce");
XFORMUPLOAD("posstockupdatefinalise.php","stockupdatefinalise");
XINSTDHID();
XTDINSUBMIT("Continue");
X_FORM(); 

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

function frontend($longcsvstring,$lastindex) {
	$longbits = str_getcsv($longcsvstring);	
	$shortbits = array_slice($longbits, 0, $lastindex+1);
	return array2csv($shortbits);
}

function supersub($csvstring,$subindex,$subvalue) {
	$csvarray = str_getcsv($csvstring);
	$csvarray[$subindex] = $subvalue;
	return array2csv($csvarray);
}

function array2csv($array) {
	$csv = "";
	for( $i = 0; $i < count($array); $i++ ) {
		$csv .= '"' . str_replace('"', '""', $array[$i]) . '"';
		if( $i < count($array) - 1 ) $csv .= ",";
	}
	// XTXT(count($array)." ".$csv);XBR();
	return $csv;
}

?>


