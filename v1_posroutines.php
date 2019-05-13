<?php # posroutines.php

function Pos_SETUPRECEIPT_Output() {
Get_Data('pos','pos');	
$parm0 = "Update Receipt|receipt||receipt_id|receipt_id|25|No";
$parm1 = "";
$parm1 = $parm1."receipt_id|Yes|Id|80|Yes|Receipt Id|KeyGenerated,".$GLOBALS{'pos_posfeederid'}."[00000]^";
$parm1 = $parm1."receipt_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."receipt_customerref|Yes|Customer Ref|150|Yes|Customer Ref|InputText,25,50^";
$parm1 = $parm1."receipt_customeraddress|No|Customer Address|150|Yes|Customer Address|InputText,50,150^";
$parm1 = $parm1."receipt_netamount|No||70|Yes|Total Net Amount|InputText,5,8^";
$parm1 = $parm1."receipt_vatamount|No||90|Yes|Total Vat Amount|InputText,5,8^";
$parm1 = $parm1."receipt_grossamount|Yes|Gross|60|Yes|Total Gross Amount|InputText,5,8^";
$parm1 = $parm1."receipt_paymentmethod|No||90|Yes|Payment Method|InputSelectFromList,Card+Cash+Cheque^";
$parm1 = $parm1."receipt_postandpackingnetamount|No||70|Yes|Post and Packing Net Amount|InputText,5,8^";
$parm1 = $parm1."receipt_postandpackingvatamount|No||90|Yes|Post and Packing Vat Amount|InputText,5,8^";
$parm1 = $parm1."receipt_postandpackinggrossamount|No||60|Yes|Post and Packing Gross Amount|InputText,5,8^";
$parm1 = $parm1."receipt_comments|No|Customer Ref|150|Yes|Other Comments|InputText,25,50^";
$parm1 = $parm1."receipt_status|Yes|Status|70|Yes|Status|InputSelectFromList,Draft+Final^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_programbutton|Yes|View|60|No|View|ProgramButton,posreceiptout.php,receipt_id,receipt_id,newpopup,600,400^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Pos_VIEWRECEIPT_Output() {
$parm0 = "View Receipt|receipt||receipt_id|receipt_id|25|NoAdd";
$parm1 = "";
$parm1 = $parm1."receipt_id|Yes|Id|80|Yes|Receipt Id|KeyText,10,10^";
$parm1 = $parm1."receipt_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."receipt_customerref|Yes|Customer Ref|150|Yes|Customer Ref|InputText,25,50^";
$parm1 = $parm1."receipt_customeraddress|No|Customer Address|150|Yes|Customer Address|InputText,50,150^";
$parm1 = $parm1."receipt_netamount|No||70|Yes|Total Net Amount|InputText,5,8^";
$parm1 = $parm1."receipt_vatamount|No||90|Yes|Total Vat Amount|InputText,5,8^";
$parm1 = $parm1."receipt_grossamount|Yes|Gross|60|Yes|Total Gross Amount|InputText,5,8^";
$parm1 = $parm1."receipt_paymentmethod|No||90|Yes|Patment Method|InputSelectFromList,Card+Cash+Cheque^";
$parm1 = $parm1."receipt_postandpackingnetamount|No||70|Yes|Post and Packing Net Amount|InputText,5,8^";
$parm1 = $parm1."receipt_postandpackingvatamount|No||90|Yes|Post and Packing Vat Amount|InputText,5,8^";
$parm1 = $parm1."receipt_postandpackinggrossamount|No||60|Yes|Post and Packing Gross Amount|InputText,5,8^";
$parm1 = $parm1."receipt_status|Yes|Status|60|Yes|Status|InputSelectFromList,Draft+Final^";
$parm1 = $parm1."generic_programbutton|Yes|View|70|No|View|ProgramButton,posreceiptout.php,receipt_id,receipt_id,newpopup,600,400";
GenericHandler_Output ($parm0,$parm1); 
}


function Pos_SETUPRECEIPTITEM_Output() {
Get_Data('pos','pos');	
$parm0 = "Update Receipt Item|receiptitem|vatrate[mergedkey=vatrate_id+vatrate_dateeffective]|receiptitem_id|receiptitem_id|25|No";
$parm1 = "";
$parm1 = $parm1."receiptitem_id|Yes|Receipt Item Id|90|Yes|Receipt Item Id|KeyGenerated,".$GLOBALS{'pos_posfeederid'}."I[00000]^";
$parm1 = $parm1."receiptitem_receiptid|Yes|Receipt Id|70|Yes|Receipt Id|InputText,10,10^";
$parm1 = $parm1."receiptitem_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."receiptitem_sku|Yes|SKU|170|Yes|SKU|InputText,40,60^";
$parm1 = $parm1."receiptitem_vatrateid|Yes|Vatrate|80|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."receiptitem_grossamount|Yes|Gross|60|Yes|Gross Amount|InputText,5,8^";
$parm1 = $parm1."receiptitem_vatamount|No||90|Yes|Vat Amount|InputTextCalc,10,20,receiptitem_grossamount,vat,receiptitem_vatrateid,receiptitem_date^";
$parm1 = $parm1."receiptitem_netamount|No||70|Yes|Net Amount|InputTextCalc,10,20,receiptitem_grossamount,-,receiptitem_vatamount^";
$parm1 = $parm1."receiptitem_orderstatus|Yes|Order Status|80|Yes|Order Status|InputSelectFromList,Ordered+Delivered^";
$parm1 = $parm1."receiptitem_quantity|Yes|Qty|30|Yes|Quantity|InputSelectFromList,1+2+3+4+5+6+7+8+9^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Pos_VIEWRECEIPTITEM_Output() {
$parm0 = "View Receipt Item|receiptitem|vatrate[mergedkey=vatrate_id+vatrate_dateeffective]|receiptitem_id|receiptitem_id|25|No";
$parm1 = "";
$parm1 = $parm1."receiptitem_id|Yes|Receipt Item Id|90|Yes|Receipt Item Id|InputText,10,10^";
$parm1 = $parm1."receiptitem_receiptid|Yes|Receipt Id|70|Yes|Receipt Id|InputText,10,10^";
$parm1 = $parm1."receiptitem_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."receiptitem_sku|Yes|SKU|170|Yes|SKU|InputText,40,60^";
$parm1 = $parm1."receiptitem_vatrateid|No||80|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."receiptitem_grossamount|Yes|Gross|55|Yes|Gross Amount|InputText,5,8^";
$parm1 = $parm1."receiptitem_vatamount|No||90|Yes|Vat Amount|InputTextCalc,10,20,receiptitem_grossamount,vat,receiptitem_vatrateid,receiptitem_date^";
$parm1 = $parm1."receiptitem_netamount|No||70|Yes|Net Amount|InputTextCalc,10,20,receiptitem_grossamount,-,receiptitem_vatamount^";
$parm1 = $parm1."receiptitem_orderstatus|Yes|Status|65|Yes|Order Status|InputSelectFromList,Ordered+Delivered^";
$parm1 = $parm1."receiptitem_quantity|Yes|Qty|30|Yes|Quantity|InputSelectFromList,1+2+3+4+5+6+7+8+9^";
$parm1 = $parm1."generic_programbutton|Yes|View Receipt|120|No|View Receipt|ProgramButton,posreceiptout.php,receipt_id,receiptitem_receiptid,newpopup,600,400";
## CHECK posreceiptout.php DOES NOT EXIST
GenericHandler_Output ($parm0,$parm1); 
}

function Pos_SETUPBCOPTIONFORMAT_Output() {
$parm0 = "SKU Format|skuformat||skuformat_id|skuformat_id|25|No";
$parm1 = "";
$parm1 = $parm1."skuformat_id|Yes|Id|150|Yes|sku|KeyText,25,40^";
$parm1 = $parm1."skuformat_separator|No||70|Yes|SKU Separator|InputText,1,1^";
$parm1 = $parm1."skuformat_field1|No||70|Yes|Field 1|InputText,15,30^";
$parm1 = $parm1."skuformat_format1|No||70|Yes|Format 1|InputText,60,180)^";
$parm1 = $parm1."skuformat_field2|No||70|Yes|Field 2|InputText,15,30^";
$parm1 = $parm1."skuformat_format2|No||70|Yes|Format 2|InputText,60,180)^";
$parm1 = $parm1."skuformat_field3|No||70|Yes|Field 3|InputText,15,30^";
$parm1 = $parm1."skuformat_format3|No||70|Yes|Format 3|InputText,60,180)^";
$parm1 = $parm1."skuformat_field4|No||70|Yes|Field 4|InputText,15,30^";
$parm1 = $parm1."skuformat_format4|No||70|Yes|Format 4|InputText,60,180)^";
$parm1 = $parm1."skuformat_field5|No||70|Yes|Field 5|InputText,15,30^";
$parm1 = $parm1."skuformat_format5|No||70|Yes|Format 5|InputText,60,180)^";
$parm1 = $parm1."skuformat_field6|No||70|Yes|Field 6|InputText,15,30^";
$parm1 = $parm1."skuformat_format6|No||70|Yes|Format 6|InputText,60,180)^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Pos_SETUPBCOPTION_Output() {
$parm0 = "Big Commerce Options|bcoption||bcoption_name|bcoption_valueindex|10|No";
$parm1 = "";
$parm1 = $parm1."bcoption_name|Yes|Name|120|Yes|Field Name|KeyText,25,25^";
$parm1 = $parm1."bcoption_description|No||70|Yes|Field Description|InputText,25,50^";
$parm1 = $parm1."bcoption_bcdisplayname|Yes|Display Name|120|Yes|Display Name|InputText,25,50^";
$parm1 = $parm1."bcoption_bctype|Yes|Type|70|Yes|Big Commerce Field Type|InputSelectFromList,RB+RT+CS^";
$parm1 = $parm1."generic_programbutton|Yes|Option Values|120|No|Option Values|ProgramButton,posbcoptionvaluesout.php,bcoption_name,bcoption_name,newpopup,900,800^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Pos_BCOPTIONVALUES_CSSJS() {
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";	
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatables,jqueryconfirm";	
}

function Pos_BCOPTIONVALUES_Output($optionname) {
$parm0 = "";
$parm0 = $parm0."BC Option Values - ".$optionname."|"; # pagetitle
$parm0 = $parm0."bcoptionvalue[rootkey=".$optionname."]|"; # primetable
$parm0 = $parm0."|"; # othertables
$parm0 = $parm0."bcoptionvalue_value|"; # keyfieldname
$parm0 = $parm0."bcoptionvalue_value|"; # sortfieldname
$parm0 = $parm0."10|"; # pagination
$parm0 = $parm0."No"; # enable add-copy
$parm1 = "";	
$parm1 = $parm1."bcoptionvalue_value|Yes|Name|100|Yes|Value|KeyText,20,20^";
$parm1 = $parm1."bcoptionvalue_description|Yes|Description|200|Yes|Description|InputText,25,50^";
$parm1 = $parm1."bcoptionvalue_extravalue|Yes|Extra Value|140|Yes|Extra Value|InputText,15,25^";
$parm1 = $parm1."bcoptionvalue_seq|Yes|Seq|70|Yes|Sequence|InputText,5,10^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Pos_SETUPBCOPTIONSET_Output() {
	$parm0 = "";
	$parm0 = $parm0."Product Option Sets|"; # pagetitle
	$parm0 = $parm0."bcoptionset|"; # primetable
	$parm0 = $parm0."bcoption|"; # othertables
	$parm0 = $parm0."bcoptionset_name|"; # keyfieldname
	$parm0 = $parm0."bcoptionset_name|"; # sortfieldname
	$parm0 = $parm0."10|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."bcoptionset_name|Yes|Name|70|Yes|Option Set Name|KeyText,40,40^";
	$parm1 = $parm1."bcoptionset_description|No||70|Yes|Description|InputText,50,100^";
	$parm1 = $parm1."bcoptionset_bcoptionname0|Yes|SKU1|70|Yes|SKU1|InputFixed,Product Code^";	
	$parm1 = $parm1."bcoptionset_bcoptionname1|Yes|SKU2|70|Yes|SKU2|InputSelectFromTable,bcoption,bcoption_name,bcoption_name,bcoption_name^";
	$parm1 = $parm1."bcoptionset_bcoptionname2|Yes|SKU3|70|Yes|SKU3|InputSelectFromTable,bcoption,bcoption_name,bcoption_name,bcoption_name^";	
	$parm1 = $parm1."bcoptionset_bcoptionname3|Yes|SKU4|70|Yes|SKU4|InputSelectFromTable,bcoption,bcoption_name,bcoption_name,bcoption_name^";	
	$parm1 = $parm1."bcoptionset_bcoptionname4|Yes|SKU5|70|Yes|SKU5|InputSelectFromTable,bcoption,bcoption_name,bcoption_name,bcoption_name^";
	// $parm1 = $parm1."bcoptionset_bcoptionname5|Yes|SKU5|70|Yes|SKU5|InputSelectFromTable,bcoption,bcoption_name,bcoption_name,bcoption_name^";
	// $parm1 = $parm1."bcoptionset_bcoptionname6|Yes|SKU6|70|Yes|SKU6|InputSelectFromTable,bcoption,bcoption_name,bcoption_name,bcoption_name^";
	$parm1 = $parm1."generic_programbutton|Yes|Rules|80|No|Rules|ProgramButton,posbcoptionsetrulesout.php,bcoptionset_name,bcoptionset_name,newpopup,900,800^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Pos_BCOPTIONSETRULES_Output($bcoptionset_name) {
	XH2("Product Option Set Rules - ".$bcoptionset_name);
	Get_Data('bcoptionset',$bcoptionset_name);
	XFORM("posbcoptionsetrulesin.php","bcoptionsetrules");
	XINSTDHID();
	XINHID("bcoptionset_name",$bcoptionset_name);
	XTABLE();XTR();
	for ($i = 1; $i <= 6; $i++) {	
		if ($GLOBALS{'bcoptionset_bcoptionname'.$i} != "") {
			XTD();
			XTABLE();
			XTR();			
			XTDHTXT($GLOBALS{'bcoptionset_bcoptionname'.$i});
			X_TR();
			XTR();
			Check_Data('bcoptionsetrule',$bcoptionset_name,$GLOBALS{'bcoptionset_bcoptionname'.$i});				
			if ($GLOBALS{'IOWARNING'} == "0") {		
				$tlist = $GLOBALS{'bcoptionsetrule_valuelist'};
			} else {
				$tlist = "";
			}
			# datatype/rootkey keyfieldname textfieldname sortfieldname selectfieldname selectfieldcondition
			$xhash = Get_SelectArrays_Hash ("bcoptionvalue",$GLOBALS{'bcoptionset_bcoptionname'.$i},"bcoptionvalue_value","bcoptionvalue_value","bcoptionvalue_seq","","" );
			# hash name valuelist
			$inputname = str_replace(' ', '', $GLOBALS{'bcoptionset_bcoptionname'.$i});
			XTDINCHECKBOXHASH ($xhash,$inputname,$tlist);
			X_TR();
			X_TABLE();
			X_TD();
		}
	}
	X_TR();X_TABLE();
	XBR();
	XINSUBMIT("Update");
	X_FORM();
}

function Pos_SETUPBCPRODUCT_Output() {
	$parm0 = "";
	$parm0 = $parm0."Product Rules|"; # pagetitle
	$parm0 = $parm0."bcproduct|"; # primetable
	$parm0 = $parm0."bcproductcategory,bcoptionset|"; # othertables
	$parm0 = $parm0."bcproduct_bcproductid|"; # keyfieldname
	$parm0 = $parm0."bcproduct_bcproductid|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."bcproduct_bcproductid|Yes|Product|80|Yes|Product Id|KeyText,25,25^";
	$parm1 = $parm1."bcproduct_bcproductcategoryname|Yes|Category|150|Yes|Option Set|InputSelectFromTable,bcproductcategory,bcproductcategory_name,bcproductcategory_name,bcproductcategory_name^";
	$parm1 = $parm1."bcproduct_bcoptionsetname|Yes|Option Set|150|Yes|Option Set|InputSelectFromTable,bcoptionset,bcoptionset_name,bcoptionset_name,bcoptionset_name^";
	$parm1 = $parm1."generic_programbutton|Yes|Rules|80|No|Rules|ProgramButton,posbcproductrulesout.php,bcproduct_bcproductid,bcproduct_bcproductid,newpopup,900,800^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Pos_BCPRODUCTRULES_Output($product_id) {
	XH2("Product Rules - ".$product_id);
	Get_Data('bcproduct',$product_id);
	XPTXT("Product Category - ".$GLOBALS{'bcproduct_bcproductcategoryname'});
	Check_Data('bcoptionset',$GLOBALS{'bcproduct_bcoptionsetname'});
	if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data('bcoptionset'); }
	
	XTABLE();
	XTR();XTD();	
	XPTXT("Product Option Set Default");
	echo '<div style="border-style: solid; border-color: green; border-width:2px">';
	XTXT($GLOBALS{'bcproduct_bcoptionsetname'});
	echo '</div>';
	XPTXT("Please note that you must set all option values if you want to override the option set defaults. ");	
	X_TD();X_TR();
	
	
	XTR();XTD();
	XFORM("posbcproductrulesin.php","bcproductrules");
	XINSTDHID();
	XINHID("product_id",$product_id);
	XTABLE();XTR();
	for ($i = 1; $i <= 6; $i++) {
		if ($GLOBALS{'bcoptionset_bcoptionname'.$i} != "") {
			XTD();
			XTABLE();
			XTR();
			XTDHTXT($GLOBALS{'bcoptionset_bcoptionname'.$i});
			X_TR();
			XTR();
			Check_Data('bcoptionsetrule',$GLOBALS{'bcproduct_bcoptionsetname'},$GLOBALS{'bcoptionset_bcoptionname'.$i});
			if ($GLOBALS{'IOWARNING'} == "0") { $oslist = $GLOBALS{'bcoptionsetrule_valuelist'}; } 
			else { $oslist = ""; }
			Check_Data('bcproductrule',$product_id,$GLOBALS{'bcoptionset_bcoptionname'.$i});
			if ($GLOBALS{'IOWARNING'} == "0") { $prlist = $GLOBALS{'bcproductrule_valuelist'}; } 
			else { $prlist = ""; }
			
			# datatype/rootkey keyfieldname textfieldname sortfieldname selectfieldname selectfieldcondition
			$xhash = Get_SelectArrays_Hash ("bcoptionvalue",$GLOBALS{'bcoptionset_bcoptionname'.$i},"bcoptionvalue_value","bcoptionvalue_value","bcoptionvalue_seq","","" );
			# hash name valuelist
			$inputname = str_replace(' ', '', $GLOBALS{'bcoptionset_bcoptionname'.$i});
			// XTDINCHECKBOXHASH ($xhash,$inputname,$tlist);
			
			XTD();
			XINHID($inputname, "");
			XDIV($inputname."div","");
			foreach ($xhash as $key=>$selecttext ) {
				$tselected = "";
				foreach ($prbits as $prbit ) {
					if ($prbit == $key){ 
						$tselected = "checked";
					}
				}
				$foundinbcoptionset = "0";
				foreach ($osbits as $osbit ) {
					if ($osbit == $key){
						$foundinbcoptionset = "1";
					}
				}
				if ($foundinbcoptionset == "0") { echo"<div>"; }
				else {echo '<div style="border-style: solid; border-color: green; border-width:2px">';}
				
				echo '<input type="checkbox" name="'.$inputname.'[]" value="'.$key.'" '.$tselected.'/>&nbsp;'.$selecttext."\n";
				if (($prlist == "")&&($foundinbcoptionset == "1")) { echo '<input type="checkbox" checked="checked" disabled="disabled" />'; }
				
				echo '</div>';
				
				
				XBR();
			}
			X_DIV($inputname."div");
			X_TD();
			
			
			X_TR();
			X_TABLE();
			X_TD();
		}
	}
	X_TR();X_TABLE();
	XBR();
	XINSUBMIT("Update");
	X_FORM();
	

	X_TD();X_TR();
	X_TABLE();	
	
}

function Pos_SETUPPOS_Output() {
$parm0 = "POS Setup|pos[mergedkey=pos_id+pos_dateeffective]|vatrate[mergedkey=vatrate_id+vatrate_dateeffective]|pos_id+pos_dateeffective|pos_id+pos_dateeffective|25|No";
$parm1 = "";
$parm1 = $parm1."pos_id|Yes|pos|60|Yes|pos|KeyText,25,40^";
$parm1 = $parm1."pos_dateeffective|Yes|Date Effective|70|Yes|Date Effective|KeyDate^";
$parm1 = $parm1."pos_defaultvatrateid|No||70|Yes|Default VAT RateId|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."pos_posfeederid|No||70|Yes|Pos Feeder Id|InputText,1,1^";
$parm1 = $parm1."pos_stockmaster|No||70|Yes|Stock Master Control|InputSelectFromList,Yes+No^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Pos_SETUPBCACCESS_Output() {
$parm0 = "Big Commerce Access Setup|bcaccess||bcaccess_id|25|No";
$parm1 = "";
$parm1 = $parm1."bcaccess_id|Yes|pos|60|Yes|pos|KeyText,25,40^";
$parm1 = $parm1."bcaccess_siteurl|No||70|Yes|Site URL|InputText,40,200^";
$parm1 = $parm1."bcaccess_webdavuser|No||70|Yes|WebDav User|InputText,40,200^";
$parm1 = $parm1."bcaccess_webdavpassword|No||70|Yes|WebDav Password|InputText,80,200^";
$parm1 = $parm1."bcaccess_productexportfolderurl|No||70|Yes|Export Folder URL|InputText,80,200^";
$parm1 = $parm1."bcaccess_productimportfolderurl|No||70|Yes|Import Folder URL|InputText,80,200^";
$parm1 = $parm1."bcaccess_imagesimportfolderurl|No||70|Yes|Images Folder URL|InputText,80,200^";
$parm1 = $parm1."bcaccess_homepagefolderurl|No||70|Yes|Homepage Folder URL|InputText,80,200^";
$parm1 = $parm1."bcaccess_stockpagesfolderurl|No||70|Yes|Stock Pages Folder URL|InputText,80,200^";
$parm1 = $parm1."bcaccess_stockrecordsfolderurl|No||70|Yes|Stock Control Folder URL|InputText,80,200^";
$parm1 = $parm1."bcaccess_localproductexportfolder|No||70|Yes|Local Product Exports Folder|InputText,80,200^";
$parm1 = $parm1."bcaccess_localproductimportfolder|No||70|Yes|Local Product Import Folder|InputText,80,200^";
$parm1 = $parm1."bcaccess_localimagesimportfolder|No||70|Yes|Local Images Folder|InputText,80,200^";
$parm1 = $parm1."bcaccess_localhomepagefolder|No||70|Yes|Local Homepage Folder|InputText,80,200^";
$parm1 = $parm1."bcaccess_localstockpagesfolder|No||70|Yes|Local Stock Pages Folder|InputText,80,200^";
$parm1 = $parm1."bcaccess_localstockrecordsfolder|No||70|Yes|Local Stock Control Folder|InputText,80,200^";
$parm1 = $parm1."bcaccess_productparsestring|No||70|Yes|Product Stock Selection - parse string|InputText,40,100^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Pos_SETUPBCPRODUCTCATEGORY_Output() {
$parm0 = "Big Commerce Product Category Setup|bcproductcategory||bcproductcategory_name|25|No";
$parm1 = "";
$parm1 = $parm1."bcproductcategory_name|Yes|pos|200|Yes|pos|KeyText,40,80^";
$parm1 = $parm1."bcproductcategory_active|Yes|Active|60|Yes|Active|InputSelectFromList,Yes+No^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Pos_BCWEBPAGES_Output() {
XH2("Big Commerce Custom Web Inserts");
$link = YPGMLINK("posbcwebpageout.php").YPGMSTDPARMS().YPGMPARM("BCWebPage","Homepage");
XLINKTXT($link,"Homepage");XBR();XBR();
$link = YPGMLINK("posbcwebpageout.php").YPGMSTDPARMS().YPGMPARM("BCWebPage","Stockpage");
XLINKTXT($link,"Stockpage");XBR();		
}

function Pos_NEWRECEIPT_Output() {
Get_Data('pos','pos');	
$highestreceiptid = $GLOBALS{'pos_posfeederid'}."00000";
$thisreceiptid = $GLOBALS{'pos_posfeederid'}."00001"; # Initial value for empty array	
$receipta = Get_Array("receipt");
foreach ($receipta as $receipt_id) {
 if ($receipt_id > $highestreceiptid) { $highestreceiptid = $receipt_id; }
 $thisreceiptid = incrementKey($highestreceiptid);
}
Initialise_Data('receipt');
$GLOBALS{'receipt_date'} = $GLOBALS{'currentYYYY-MM-DD'};
$GLOBALS{'receipt_status'} = "Draft";
Write_Data('receipt',$thisreceiptid);
XH2("New Receipt"); 
Pos_RECEIPT_Output($thisreceiptid);
}

function Pos_RECEIPTRECALCULATE($thisreceiptid) {

Get_Data_Hash_DateEffective('pos',"pos",$GLOBALS{'currentYYYY-MM-DD'});
Get_Data('receipt',$thisreceiptid);
$netamount = floatval($GLOBALS{'receipt_postandpackingnetamount'});
$vatamount = PosCalculateVAT($netamount,$GLOBALS{'receipt_date'},$GLOBALS{'pos_defaultvatrateid'});
$grossamount = $netamount + $vatamount;
$GLOBALS{'receipt_postandpackingvatamount'} = $vatamount;
$GLOBALS{'receipt_postandpackinggrossamount'} = $grossamount;

$receiptitema = Get_Array("receiptitem");
foreach ($receiptitema as $receiptitem_id) {
 Get_Data('receiptitem',$receiptitem_id);	
 if ($GLOBALS{'receiptitem_receiptid'} == $thisreceiptid) {
  $netamount = $netamount + floatval($GLOBALS{'receiptitem_netamount'}); 
  $vatamount = $vatamount + floatval($GLOBALS{'receiptitem_vatamount'});  
  $grossamount = $grossamount + floatval($GLOBALS{'receiptitem_grossamount'});    
 }
}
$GLOBALS{'receipt_netamount'} = $netamount;
$GLOBALS{'receipt_vatamount'} = $vatamount;
$GLOBALS{'receipt_grossamount'} = $grossamount; 
Write_Data('receipt',$thisreceiptid);
}

function Pos_RECEIPT_Output($thisreceiptid) {
XH2("Receipt Update - ".$thisreceiptid." - ".$GLOBALS{'receipt_status'});
Get_Data('pos','pos');	
Get_Data('receipt',$thisreceiptid);	
$highestreceiptitemid = $GLOBALS{'pos_posfeederid'}."I00000";
$thisreceiptitemid = $GLOBALS{'pos_posfeederid'}."I00001"; # Initial value for empy array
$receiptitema = Get_Array("receiptitem");
foreach ($receiptitema as $receiptitem_id) {
 if ($receiptitem_id > $highestreceiptitemid) {
  $highestreceiptitemid = $receiptitem_id;
 }
 $thisreceiptitemid = incrementKey($highestreceiptitemid);
}

XFORM("posreceiptin.php","");
XINSTDHID();
XINHID("receipt_id",$thisreceiptid);
XINHID("receiptitem_id",$thisreceiptitemid);
XTABLE();
if ($GLOBALS{'receipt_status'} == "Draft") {
 XTR();XTDTXT("Date");XTDTXT($GLOBALS{'receipt_date'});X_TR();
 XTR();XTDTXT("Customer Reference");XTDINTXT('receipt_customerref',$GLOBALS{'receipt_customerref'},"30","50");X_TR();
 XTR();XTDTXT("Customer Address");XTDINTEXTAREA('receipt_customeraddress',$GLOBALS{'receipt_customeraddress'},"2","50");X_TR();
 XTR();XTDTXT("Payment Method");
 XTDINSELECTHASH(List2Hash("Card,Cash,Cheque"),'receipt_paymentmethod',$GLOBALS{'receipt_paymentmethod'});
 X_TR();
 XTR();XTDTXT("Post and Packing (Net)");XTDINTXT('receipt_postandpackingnetamount',$GLOBALS{'receipt_postandpackingnetamount'},"10","10");X_TR();
 XTR();XTDTXT("Other Comments");XTDINTEXTAREA('receipt_comments',$GLOBALS{'receipt_comments'},"2","50");X_TR();  
} else {
 XTR();XTDTXT("Date");XTDTXT($GLOBALS{'receipt_date'});X_TR();
 XTR();XTDTXT("Customer Reference");XTDTXT($GLOBALS{'receipt_customerref'});X_TR();
 XTR();XTDTXT("Customer Address");XTDTXT($GLOBALS{'receipt_customeraddress'});X_TR(); 
 XTR();XTDTXT("Payment Method");XTDTXT($GLOBALS{'receipt_paymentmethod'});X_TR();
 XTR();XTDTXT("Post and Packing (Net)");XTDTXT($GLOBALS{'receipt_postandpackingnetamount'});X_TR();
 XTR();XTDTXT("Other Comments");XTDTXT($GLOBALS{'receipt_comments'});X_TR(); 
}
X_TABLE();
if ($GLOBALS{'receipt_status'} == "Draft") {
 XH2("Add a new item");
 XTABLE();
 XTR();
 XTDHTXT("Product Code");
 $bcoptiona = Get_Array('bcoption');
 foreach ($bcoptiona as $bcoption_name) {
 	Get_Data('bcoption',$bcoption_name);	
    XTDHTXT($GLOBALS{'bcoption_name'}); 		
 }
 XTDHTXT("Net Price");
 XTDHTXT("VatRate");
 XTDHTXT("Order Status");
 XTDHTXT("Qty"); 
 X_TR();
 XTR();
 $thishash = Get_Array_Hash ("bcproduct");
 XTDINSELECTHASH ($thishash,"Product","");
 foreach ($bcoptiona as $bcoption_name) {
 	Get_Data('bcoption',$bcoption_name);
 	$thishash = Get_Array_Hash ("bcoptionvalue",$bcoption_name);
 	XTDINSELECTHASH ($thishash,"SKU".$i,""); 	
 }
 XTDINTXT("receiptitem_netamount","","6","10");
 Get_Data_Hash_DateEffective('pos',"pos",$GLOBALS{'currentYYYY-MM-DD'});
 Get_Data_Hash_DateEffective('vatrate',$GLOBALS{'pos_defaultvatrateid'},$GLOBALS{'currentYYYY-MM-DD'});
 $vatratekeyarray = array(); $vatratevaluearray = array();
 $vatratea = Get_Array('vatrate');
 foreach ($vatratea as $tvatrate_id) {
	Get_Data('vatrate',$tvatrate_id);
	array_push($vatratekeyarray, $tvatrate_id);
	$vatratevaluestring = $GLOBALS{'vatrate_description'};
	array_push($vatratevaluearray, $vatratevaluestring);
 } 
 $vatrateselecthash = Arrays2Hash($vatratekeyarray,$vatratevaluearray);
 XTDINSELECTHASH($vatrateselecthash,"receiptitem_vatrateid",$GLOBALS{'vatrate_description'}); 

 $thishash = List2Hash ("Ordered,Delivered");
 XTDINSELECTHASH ($thishash,"receiptitem_orderstatus","");
 $thishash = List2Hash ("1,2,3,4,5,6,7,8,9");
 XTDINSELECTHASH ($thishash,"receiptitem_quantity",""); 
 # XTDINTXT("GrossAmount","","6","10");
 X_TR();
 X_TABLE();  
 XTABLE();XTR();XTDTXT("Barcode");XTDINTXT("SKUBarcode","","96","96");X_TR();X_TABLE();
 XBR();
 XTDINSUBMIT("Update Receipt");
} 
X_FORM();
XHR();
XH2("Receipt");
XTABLE();
XTR();
XTDHTXT("Item No");
XTDHTXT("SKU");
XTDHTXT("Net");
XTDHTXT("Vat");
XTDHTXT("Gross");
XTDHTXT("Status");
if ($GLOBALS{'receipt_status'} == "Draft" ) {   XTDHTXT("Delete"); }
else { XTDHTXT(""); }
X_TR();

$receiptitemcount = 0;
$receiptitema = Get_Array("receiptitem");
foreach ($receiptitema as $receiptitem_id) {
 Get_Data('receiptitem',$receiptitem_id);	
 if ($GLOBALS{'receiptitem_receiptid'} == $thisreceiptid) {
  XTR();
  XTDTXT($receiptitem_id);
  XTDTXT($GLOBALS{'receiptitem_sku'});
  XTDTXT($GLOBALS{'receiptitem_netamount'});
  XTDTXT($GLOBALS{'receiptitem_vatamount'});
  XTDTXT($GLOBALS{'receiptitem_grossamount'});
  XTDTXT($GLOBALS{'receiptitem_orderstatus'});
  XTDTXT($GLOBALS{'receiptitem_quantity'});  
  if ($GLOBALS{'receipt_status'} == "Draft" ) {      
   $link = YPGMLINK("posreceiptitemdeletein.php").YPGMSTDPARMS();
   $link = $link.YPGMPARM("deletereceiptitem_id",$receiptitem_id).YPGMPARM("receipt_id",$thisreceiptid);
   XTDLINKTXT($link,"Delete");
  } else {
   XTDTXT("");
  }
  X_TR();
  $receiptitemcount++;  
 }
}
if ($receiptitemcount == 0) {
 XTR();
 XTDTXT("No receipt items so far");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
 X_TR();	
} else {
	XTR();
	XTDTXT("Post/Packing");
	XTDTXT("");
	XTDTXT($GLOBALS{'receipt_postandpackingnetamount'});
	XTDTXT($GLOBALS{'receipt_postandpackingvatamount'});
	XTDTXT($GLOBALS{'receipt_postandpackinggrossamount'});
	XTDTXT("");	
	XTDTXT("");
	X_TR();	
	XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();	
	XTR();
	XTDTXT("Total");
	XTDTXT("");
	XTDTXT($GLOBALS{'receipt_netamount'});
	XTDTXT($GLOBALS{'receipt_vatamount'});	
	XTDTXT($GLOBALS{'receipt_grossamount'});	
	XTDTXT("");
	XTDTXT("");	
	X_TR();	
}
X_TABLE();
XHR();
XH2("Print and Finalise");
XFORMNEWWINDOW("posreceiptfinaliseprint.php","receipt","receipt");
XINSTDHID();
XINHID("receipt_id",$thisreceiptid);
if ($GLOBALS{'receipt_status'} == "Draft" ) { XTDINSUBMIT("Print and Finalise Receipt"); }
else { XTDINSUBMIT("Re-Print Receipt"); }
X_FORM();
}

function incrementKey($currentkey) { 
$bits = str_split($currentkey);	
$alphapart = "";
$numpart = "";
foreach ($bits as $bit) {
 if (($bit >= "0")&&($bit <= "9")) { $numpart = $numpart.$bit; }
 else { $alphapart = $alphapart.$bit; } 
}
$numpart++;
$numpart = substr("00000".$numpart,-5);
$newkey = $alphapart.$numpart;
return $newkey;
}

function  PosCalculateVAT($net,$vattxndate,$vattxnrateid) {
Get_Data_Hash_DateEffective('vatrate',$vattxnrateid,$vattxndate);		 
$vatrate  = floatval($GLOBALS{'vatrate_rate'}); 
$netamount = floatval($net);
$vatamount = ($netamount*$vatrate)/100;
return $vatamount;
}

function Pos_RECEIPTFINALISEPRINT_Output($treceiptid) {

print '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'."\n";
print '<html>'."\n";
print '<head>'."\n";
print '<title>Receipt - '.$treceiptid.'</title>'."\n";
print '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >'."\n";
XDOMAINCSS ("Webstyle_Default_Final");
XSITEJS ($GLOBALS{'SITEJSOPTIONAL'});
XCSS();
XTXT("body { background-image: none;}");
XTXT("body { background-color: white;}");
XTXT(".bodyclass #pagecontainer { background-image: none;}");
XTXT(".bodyclass #pagecontainer { background-color: white;}");
XTXT(".bodyclass #header { background-image: none;}");
XTXT(".bodyclass #header { background-color: white;}");
XTXT(".bodyclass #page { background-image: none; }");
XTXT(".bodyclass #page { background-color: white;}");
XTXT(".bodyclass #page { margin: 25px;}");
XTXT(".bodyclass p { float: left;}");

X_CSS();
X_HEAD();
XBODY("bodyclass");
XDIV("page","");	
	
Get_Data('skuformat',"sku");
Get_Data('webpage',"Receipt");
Get_Data('receipt',$treceiptid);	
$receiptsourcea = explode("\r", $GLOBALS{'webpage_html'});
foreach ($receiptsourcea as $message) {
 if (strlen(strstr($message,"readmore.gif")) > 0) {	 
  XH2("Receipt Number - ".$treceiptid.'<span style="color:white">_________________________</span> Date - '.$GLOBALS{'receipt_date'});
  XH5("Customer Reference - ".$GLOBALS{'receipt_customerref'}.", ".$GLOBALS{'receipt_customeraddress'});  
  XH5("Payment Method - ".$GLOBALS{'receipt_paymentmethod'}); 
  XH5("Comments - ".$GLOBALS{'receipt_comments'});     
  Get_Data('receipt',$treceiptid);
  XTABLE();
  XTR();
  XTDHTXT("Item No");
  XTDHTXTFIXED("Item Description","300");  
  # XTDHTXT("SKU");
  XTDHTXT("Net");
  XTDHTXT("Vat");
  XTDHTXT("Gross");
  XTDHTXT("Order Status");
  XTDHTXT("Qty");        
  X_TR();

  $receiptitemcount = 0;
  $receiptitema = Get_Array("receiptitem");
  foreach ($receiptitema as $receiptitem_id) {
	Get_Data('receiptitem',$receiptitem_id);
	if ($GLOBALS{'receiptitem_receiptid'} == $treceiptid) {
		XTR();
		XTDTXT($receiptitem_id);
		XTD();
		$skuarray = explode($GLOBALS{'skuformat_separator'},$GLOBALS{'receiptitem_sku'});
		$si = 0; $fi=1;
		foreach ($skuarray as $skuarrayelement) {
         if ($GLOBALS{'skuformat_field'.$fi} != "") {
          XTXT($GLOBALS{'skuformat_field'.$fi}." - ".$skuarray[$si]);XBR();	
         }
         $si++; $fi++;			
		}
		X_TD();
		XTDTXT($GLOBALS{'receiptitem_grossamount'});
		XTDTXT($GLOBALS{'receiptitem_vatamount'});
		XTDTXT($GLOBALS{'receiptitem_netamount'});
		XTDTXT($GLOBALS{'receiptitem_orderstatus'});
		XTDTXT($GLOBALS{'receiptitem_quantity'});				
		X_TR();
		$receiptitemcount++;
	}
  }
  if ($receiptitemcount == 0) {
	XTR();
	XTDTXT("No receipt items so far");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
	X_TR();
  } else {
  	XTR();
  	XTDTXT("Post/Packing");
  	XTDTXT("");
  	# XTDTXT("");  	
  	XTDTXT($GLOBALS{'receipt_postandpackingnetamount'});
  	XTDTXT($GLOBALS{'receipt_postandpackingvatamount'});
  	XTDTXT($GLOBALS{'receipt_postandpackinggrossamount'});
  	XTDTXT("");  	
  	X_TR();  	
	XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
	XTR();
	XTDTXT("Total");
	XTDTXT("");
	XTDTXT($GLOBALS{'receipt_netamount'});
	XTDTXT($GLOBALS{'receipt_vatamount'});
	XTDTXT($GLOBALS{'receipt_grossamount'});
	XTDTXT("");		
	X_TR();
  }
  X_TABLE(); 
  XBR();	

 } else {
  print "$message\n";
 }
}

X_DIV("page");
X_BODY();
X_HTML();

Get_Data('receipt',$treceiptid);
$GLOBALS{'receipt_status'} = "Final";
Write_Data('receipt',$treceiptid);

}

function Pos_BCSTOCKUPDATE_Output() {
	XH2("Big Commerce Exporter - Step 1 of 3");
	$error = "0";
	XH4("Input Files");	
		
	$posfeedera = Get_Array('posfeeder');
	$latestbc_receiptitem_ida = Array();
	$highest_receiptitem_ida = Array();
	$latestbc_stockitemadded_id = "ST00000";
	$highest_stockitemadded_id = "ST00000";
	foreach ($posfeedera as $posfeederid) {
		$latestbc_receiptitem_ida[$posfeederid] = $posfeederid."I00000";
		$highest_receiptitem_ida[$posfeederid] = $posfeederid."I00000";
	}	
	Get_Data('bcaccess','pos');

	
	$dirurl = $GLOBALS{'bcaccess_productexportfolderurl'};
	$filename = "products-".$GLOBALS{'yyyy'}."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'}.".csv";
	$user = $GLOBALS{'bcaccess_webdavuser'};
	$password = $GLOBALS{'bcaccess_webdavpassword'};
	$headerflag = "1";
	$productexportarray = WebDav_Download_File_Array ($dirurl, $filename, $user, $password);
	if ($GLOBALS{'IOWARNING'} == "1") {
		XTXT("<b>ERROR: - No Current Product Export File found - Please re-export</b>");XBR();
		$error = "1";
	} else {
		XTXT('Current Product Export File found - "'.$filename.'"');XBR();		
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
		   $headerindex++;
		  }
		  $headerflag = "0";    	    	
		 } else {
		  if ($productexportbits[$itemindex] == "Product") {
		     if ($productexportbits[$codeindex] == "CONTROL") {
		     	# |LatestStockAdded=ST00000|R-Sales=RI00000|S-Sales=SI00000|  <= Dont change this text
		     	$controlbitsa = explode('|',$productexportbits[$descriptionindex]);
		     	foreach ($controlbitsa as $controlelement) {
		     		$controlbits2a = explode('=',$controlelement);
		     		if ($controlbits2a[0] == "LatestStockAdded")  { 
		     			$latestbc_stockitemadded_id  = $controlbits2a[1];
		     		}    	
		     		foreach ($posfeedera as $posfeederid) {
		     			if ($controlbits2a[0] == $posfeederid."-Sales")  { 
		     				$latestbc_receiptitem_ida[$posfeederid] = $controlbits2a[1];
		     			}  
		     		}
		     	}
		     }
		  } 	
		 }
		}			

		$stockitemaddeda = Get_Array('stockitemadded');
		if (empty($stockitemaddeda)) {
			XTXT("No stock to be added");XBR();
		} else {
			$highest_stockitemadded_id = end($stockitemaddeda);
		}
		
		foreach ($posfeedera as $posfeederid) {
			$dirurl = $GLOBALS{'bcaccess_stockrecordsfolderurl'};
			$filename = $posfeederid."-Sales.csv";
			$user = $GLOBALS{'bcaccess_webdavuser'};
			$password = $GLOBALS{'bcaccess_webdavpassword'};
			$salesarray = WebDav_Download_File_Array ($dirurl, $filename, $user, $password);
			if ($GLOBALS{'IOWARNING'} == "1") {
				XTXT("Warning: - No sales file found on Big Commerce for POS ".$posfeederid.' = "'.$filename.'"');XBR();
			} else {
				XTXT("Sales file found on Big Commerce for POS ".$posfeederid.' = "'.$filename.'"');XBR();
				$saleselement = end($salesarray);
				$salesbits = str_getcsv($saleselement);
				$highest_receiptitem_ida[$posfeederid] = $salesbits[1];
			}	
		}

	}	
	
	XH4("Stock and Sales Records sumary");
	XTABLE();
	XTR();
	XTDHTXT("Input");XTDHTXT("Big Commerce");XTDHTXT("Awaiting Input");XTDHTXT("Action Status");
	X_TR();	
	XTR();
	$stockmessae = ""; 
	if ($highest_stockitemadded_id <= $latestbc_stockitemadded_id ) {
		$stockmessage = "No further stock updates will be made";
	} else {
		$stockmessage = "Latest Updates will be processed";		
	}
	XTDTXT("Stock");XTDTXT($latestbc_stockitemadded_id);XTDTXT($highest_stockitemadded_id);XTDTXT($stockmessage);
	X_TR();	
	foreach ($posfeedera as $posfeederid) {
		$salesmessae = "";
		XTR();
		if ($highest_receiptitem_ida[$posfeederid] <= $latestbc_receiptitem_ida[$posfeederid] ) {
			$salesmessage = "No sales updates will be made for ".$posfeederid;
		} else {
			$salesmessage = "Latest Updates will be processed";
		}
		XTDTXT("Sales - ".$posfeederid);XTDTXT($latestbc_receiptitem_ida[$posfeederid]);XTDTXT($highest_receiptitem_ida[$posfeederid]);XTDTXT($salesmessage);
		X_TR();		
	}	
	X_TABLE();

	XH4("Make Updates");	
	if ( $error == "0" ) {
		XFORMUPLOAD("posstockupdate.php","stockupdate");
		XINSTDHID();
		XTABLE();
		XTR();
		# name, existingalue, text
		XTDINCHECKBOXYESNO ("FullStockRefresh","No","Tick this and upload file if you require a Full Stock Refresh");
		# inputname maxsize
		XTDINFILE ("FullStockRefreshFile","100");
		X_TR();
		X_TABLE();
		XBR();
		XTDINSUBMIT("Continue");
		X_FORM();	
	} else {
		XPTXT("<b>The existing product file must be exported first</b>");
	}

}

function Pos_BCPRODUCTRULESSYNCH_Output() {
	XH2("Sybchronise Big Commerce Product Rules");
	Get_Data('bcaccess','pos');
	$dirurl = $GLOBALS{'bcaccess_productexportfolderurl'};
	$filename = "products-".$GLOBALS{'yyyy'}."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'}.".csv";
	$user = $GLOBALS{'bcaccess_webdavuser'};
	$password = $GLOBALS{'bcaccess_webdavpassword'};
	$productexportarray = WebDav_Download_File_Array ($dirurl, $filename, $user, $password);
	if ($GLOBALS{'IOWARNING'} == "1") {
		XH3("Error - There is no Big Commerce Product Export yet generated for today");
	} else {
		XFORM("posbcproductrulessynch.php","synch");
		XINSTDHID();
		XTDINSUBMIT("Continue");
		X_FORM();
	}
}

function Pos_BCPOSTPOSSALES_Output() {
XH2("Post POS Sales to Big Commerce");
XFORM("posbcpostpossales.php","possales");
XINSTDHID();
XTDINSUBMIT("Post Sales File");
X_FORM();
}

function Pos_ADDTOSTOCK_Output() {
	
	
	$nullhash = array();
	XTABLE();
	XTR();
	XTDTXT("Product Option Set");
	XTDHTXT("Product Code");
	for ($i = 1; $i <= 6; $i++) {
			XTDHTXT("SKU".$i);
	}
	XTDHTXT("Quantity");
	XTDHTXT("Supplier");
	X_TR();
	XTR();
	XTD(); XINSELECTHASH ($nullhash,"OptionSet",""); X_TD(); 
	XTD(); XINSELECTHASH ($nullhash,"ProductCode",""); X_TD(); 
	for ($i = 1; $i <= 6; $i++) {
			XTD(); XINSELECTHASH ($nullhash,"SKU".$i,""); X_TD(); 
	}
	XTD(); XINSELECTHASH ($nullhash,"Quantity",""); X_TD();
	XTD(); XINSELECTHASH ($nullhash,"Supplier",""); X_TD();
	X_TR();
	X_TABLE();
	XBR();	

	
	

}	
	


function Pos_SETUPPOSFEEDER_Output() {
$parm0 = "Point of Sales Devices|posfeeder||posfeeder_id|25|No";
$parm1 = "";
$parm1 = $parm1."posfeeder_id|Yes|Id|60|Yes|Point of Sale Device Id|KeyText,1,1^";
$parm1 = $parm1."posfeeder_title|Yes|Name|70|Yes|Point of Sale Device Name|InputText,40,200^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}
?>