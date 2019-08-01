<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inreceiptitemid = $_REQUEST["receiptitem_id"];
$inreceiptid = $_REQUEST["receipt_id"];
$inreceiptcustomerref = $_REQUEST["receipt_customerref"];
$inreceiptcustomeraddress = $_REQUEST["receipt_customeraddress"];
$inreceiptpaymentmethod = $_REQUEST["receipt_paymentmethod"];
$inreceiptpostandpackingnetamount = $_REQUEST["receipt_postandpackingnetamount"];
$inreceiptcomments = $_REQUEST["receipt_comments"];


Get_Data('receipt',$inreceiptid);
$GLOBALS{'receipt_customerref'} = $inreceiptcustomerref;
$GLOBALS{'receipt_customeraddress'} = $inreceiptcustomeraddress;
$GLOBALS{'receipt_paymentmethod'} = $inreceiptpaymentmethod;
$GLOBALS{'receipt_postandpackingnetamount'} = $inreceiptpostandpackingnetamount;
$GLOBALS{'receipt_comments'} = $inreceiptcomments;
Write_Data('receipt',$inreceiptid);

$receiptitementered = "0";
Initialise_Data('receiptitem');
$GLOBALS{'receiptitem_id'} = $inreceiptitemid;
$GLOBALS{'receiptitem_receiptid'} = $inreceiptid;
$GLOBALS{'receiptitem_date'} = $GLOBALS{'currentYYYY-MM-DD'};

Get_Data('skuformat',"sku");

if ($_REQUEST["SKUBarcode"] != "") {
	$barcodeindex = 0;
	$inbarcodebits = explode($GLOBALS{'skuformat_separator'},$_REQUEST["SKUBarcode"]);
	$GLOBALS{'receiptitem_sku'} = "";
	for ($i = 1; $i <= 6; $i++) {
		if ($GLOBALS{'skuformat_field'.$i} != "" ) {
			if ($inbarcodebits[$barcodeindex] != "") { $receiptitementered = "1"; }
			$GLOBALS{'receiptitem_sku'} = $GLOBALS{'receiptitem_sku'}.$separator.$inbarcodebits[$barcodeindex];
			$separator = $GLOBALS{'skuformat_separator'};
			$barcodeindex++;
		}
	}
	$netamount = floatval($inbarcodebits[$barcodeindex]);$barcodeindex++;
	$GLOBALS{'receiptitem_netamount'} = $netamount;	
	$GLOBALS{'receiptitem_vatrateid'} = $inbarcodebits[$barcodeindex];$barcodeindex++;		
	$vatamount = PosCalculateVAT($netamount,$GLOBALS{'receiptitem_date'},$GLOBALS{'receiptitem_vatrateid'});
	$grossamount = $netamount + $vatamount;
	$GLOBALS{'receiptitem_vatamount'} = $vatamount;
	$GLOBALS{'receiptitem_grossamount'} = $grossamount;
	$GLOBALS{'receiptitem_orderstatus'} = "Delivered";
	$GLOBALS{'receiptitem_quantity'} = "1";	
} else {
	$separator = "";
	$GLOBALS{'receiptitem_sku'} = "";
	for ($i = 1; $i <= 6; $i++) {
	 if ($GLOBALS{'skuformat_field'.$i} != "" ) {
	  if ($_REQUEST["SKU".$i] != "") { $receiptitementered = "1"; }
	  $GLOBALS{'receiptitem_sku'} = $GLOBALS{'receiptitem_sku'}.$separator.$_REQUEST["SKU".$i];
	  $separator = $GLOBALS{'skuformat_separator'};  
	 }
	}
	$netamount = floatval($_REQUEST['receiptitem_netamount']);	
	$GLOBALS{'receiptitem_vatrateid'} = $_REQUEST['receiptitem_vatrateid'];
	$vatamount = PosCalculateVAT($netamount,$GLOBALS{'receiptitem_date'},$GLOBALS{'receiptitem_vatrateid'});
	$grossamount = $netamount + $vatamount;
	$GLOBALS{'receiptitem_netamount'} = $netamount;
	$GLOBALS{'receiptitem_vatamount'} = $vatamount;
	$GLOBALS{'receiptitem_grossamount'} = $grossamount;
	$GLOBALS{'receiptitem_orderstatus'} = $_REQUEST['receiptitem_orderstatus'];
	$GLOBALS{'receiptitem_quantity'} = $_REQUEST['receiptitem_quantity'];		
}






if ( $receiptitementered == "1" ) {Write_Data('receiptitem',$inreceiptitemid);}

Pos_RECEIPTRECALCULATE($inreceiptid);
Pos_RECEIPT_Output($inreceiptid);

Back_Navigator();
PageFooter("Default","Final");

?>


