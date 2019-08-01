<<<<<<< HEAD
<?php # finroutines.php

function Fin_SETUPCWDOMAIN_CSSJS () {
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines";
}

function Fin_SETUPCWDOMAIN_Output() {
XH2("Financial Setup Wizard");
XH5("Initial setup: Follow the steps in the following sequence to set up your company.");
XPTXT("A pop up window will appear for each step.");
XTABLE();
XTR();
XTDHTXT("Steps");XTDHTXT("");XTDHTXT("");XTDHTXT("Guidance");
X_TR();
XTR();
XTDTXT("Step 1");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCOMPANY");
XLINKTXTNEWPOPUP($link,"Setup Company","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPCOMPANY.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets the type of company (eg Sole Trader, Limited Comany etc.) and the type of Business (eg Professional Services, Manufacturing etc.). From this information the system selects the approproiate financial categories to be used. ");
X_TR();
XTR();
XTDTXT("Step 2");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPALLOCATION");
XLINKTXTNEWPOPUP($link,"Setup Allocation Rules","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPALLOCATION.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This determines how much control you wish to have when allocating transactions to financial categories.");
X_TR();
XTR();
XTDTXT("Step 3");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPBANK");
XLINKTXTNEWPOPUP($link,"Setup Bank Accounts","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPBANK.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up your Bank Accounts");
X_TR();
XTR();
XTDHTXT("Optional Steps");XTDHTXT("");XTDHTXT("");XTDHTXT("");
X_TR();
XTR();
XTDTXT("Step 4");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPSUPPLIER");
XLINKTXTNEWPOPUP($link,"Setup Suppliers","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPSUPPLIER.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up your regular Suppliers (optional - you can do this as you go if preferred.)");
X_TR();
XTR();
XTDTXT("Step 5");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCUSTOMER");
XLINKTXTNEWPOPUP($link,"Setup Customers","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPCUSTOMER.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up your regular Customers (optional - you can do this as you go if preferred.)");
X_TR();
XTR();
XTDTXT("Step 6");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPHOMEOFFICE");
XLINKTXTNEWPOPUP($link,"Setup Home Office parameters","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPHOMEOFFICE.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up the rules that are used to calculate your home office expenses.");
X_TD();
X_TR();
XTR();
XTDTXT("Step 7");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMILEAGEFAVOURITE");
XLINKTXTNEWPOPUP($link,"Setup Milerage Destinations","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPMILEAGEFAVOURITE.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up your regular trip destinations (optional - you can do this as you go if preferred.)");
X_TR();
XTR();
XTDTXT("Step 8");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCWPERSON");
XLINKTXTNEWPOPUP($link,"Setup Payroll Employees","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPCWPERSON.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This defines the people that will feature in your accounts (e.g payroll employees)");
X_TR();
X_TABLE();
}

function Fin_UPDATECWREFERENCEDATA_Output () {
 XH3("Implement the latest Financial Reference Data");
 XPTXT("This action ensure you have the latest VAT rates, Fuel rates etc.");
 XBR();
 XFORM("finupdatecwreferencedata.php","");
 XTDINSUBMIT("Go");
 XINSTDHID();
 X_FORM();
}

function Fin_SETUPCOMPANY_Output() {
$parm0 = "Company|company||company_name|company_name|25|No";
$parm1 = "";
$parm1 = $parm1."company_name|Yes|Name|80|Yes|Name|KeyText,40,60^";
$list = "ST[Sole Trader]+P[Partnership]+LTD[Limited Company]+LLP[LLP]"; 
$parm1 = $parm1."company_companytype|Yes|Company Type|120|Yes|Company Type|InputRadioFromList,".$list."^";			
$list = "PS[Professional Services]+CONSUL[Consultant]+CONSTR[Construction]+RETAIL[Retail]+RESELL[Reseller]+MFG[Manufacturing]"; 
$parm1 = $parm1."company_businesssectorlist|Yes|Business|180|Yes|Business Sector|InputCheckboxFromList,".$list."^";
$parm1 = $parm1."company_registrationnumber|No|||Yes|Company Registration Number |InputText,40,60^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."company_finyearstart|No|||Yes|Financial Year Start|InputDate^";
$parm1 = $parm1."company_processhorizon|No|||Yes|Process Horizon|InputSelectFromList,3months+6months+12months+24months^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."company_hometreatment|No|||Yes|Home Treatment|InputRadioFromList,FEXP[Fully Expensed basis]+FRATE[Flat Rate Basis]^";
$parm1 = $parm1."company_cartreatment|No|||Yes|Car Treatment|InputRadioFromList,FEXP[Fully Expensed Basis]+MILE[Mileage Basis]^";		
$list = "UKO[UK Travel Only]+FTO[Foreign Travel Only]+All[Both Types of Travel]"; 
$parm1 = $parm1."company_traveltreatment|No|||Yes|Travel Treatment|InputRadioFromList,".$list."^";			
$list = "None[None]+DO[Director Only]+SO[Staff Only]+All[Director and Staff]"; 
$parm1 = $parm1."company_payrolltreatment|Yes|Payroll|55|Yes|Payroll Treatment|InputRadioFromList,".$list."^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."company_bankcurrentacounttreatment|No|Curr|25|Yes|Bank Charges/Interest|InputRadioFromList,Yes+No^";
$parm1 = $parm1."company_creditcardtreatment|No|Credit|25|Yes|Credit Card|InputRadioFromList,Yes+No^";
$parm1 = $parm1."company_bankdepositaccounttreatment|No|Dep|250|Yes|Deposit Account|InputRadioFromList,Yes+No^";
$parm1 = $parm1."company_pettycashtreatment|No|Cash|25|Yes|Petty Cash|InputRadioFromList,Yes+No^";
$parm1 = $parm1."company_loantreatment|No|Loan|25|Yes|Loan or Mortgage|InputRadioFromList,Yes+No^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
$parm2 = "Finish and update default financial categories|finsetdefaultfincategories.php|";
GenericHandler_Output ($parm0,$parm1,$parm2);
}

function Fin_SETUPCOMPANYVATSTATUS_Output() {
$parm0 = "Company VAT Status|companyvatstatus|vatflatrate|companyvatstatus_dateeffective|companyvatstatus_dateeffective|No|No";
$parm1 = "";
$parm1 = $parm1."companyvatstatus_dateeffective|Yes|Date Effective|130|Yes|Status Date Effective|KeyDate^";
$parm1 = $parm1."companyvatstatus_vatregistrationnumber|No|||Yes|VAT Registration Number (if VATable)|InputText,40,60^";	
$list = "None[No Vat]+FRI[Flat Rate VAT - Invoice Accounting]+FRC[Flat Rate VAT - Cash Accounting]+NI[Normal VAT - Invoice Accounting]+NC[Normal VAT - Cash Accounting]";
$parm1 = $parm1."companyvatstatus_vattreatment|Yes|VAT|120|Yes|VAT Treatment|InputRadioFromList,".$list."^";
$parm1 = $parm1."companyvatstatus_vatperiod|No|||Yes|VAT Period (if VATable)|InputRadioFromList,1months+3months+12months^";
$parm1 = $parm1."companyvatstatus_vatflatrateid|No|||Yes|VAT Flat Rate (if VATable)|InputRadioFromTable,vatflatrate,vatflatrate_id,vatflatrate_description,vatflatrate_id^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
$parm2 = "Finish and update default financial categories|finsetdefaultfincategories.php|";
GenericHandler_Output ($parm0,$parm1,$parm2);
}


function Fin_SETUPALLOCATION_Output() {
 $parm0 = "Allocation Rules|company||company_name|company_name|No|No";
 $parm1 = "";
 $parm1 = $parm1."company_name|Yes|Id|80|Yes|Id|KeyText,40,60^";
 $parm1 = $parm1."company_enablefullfavouritesallocate|Yes|Enable Favourites|110|Yes|Enable Favourites|InputRadioFromList,Yes+No^";
 $parm1 = $parm1."||||Yes||Divider^"; 
 $parm1 = $parm1."company_showsupplierallocate|No|Supplier|60|Yes|Show Supplier|InputRadioFromList,Yes+No^";
 $parm1 = $parm1."company_showcustomerallocate|No|Customer|70|Yes|Show Customer|InputRadioFromList,Yes+No^";
 $parm1 = $parm1."company_showpaymenttypeallocate|No|Payment Type|80|Yes|Show Payment Type|InputRadioFromList,Yes+No^"; 
 $parm1 = $parm1."company_showvatallocate|No|VAT|50|Yes|Show VAT|InputRadioFromList,Yes+No^"; 
 $parm1 = $parm1."company_showfincategoryallocate|No|FinCategory|70|Yes|Show Financial Category|InputRadioFromList,Yes+No^"; 
 $parm1 = $parm1."company_showjoballocate|No|Job|50|Yes|Show Job|InputRadioFromList,Yes+No^";
 $parm1 = $parm1."company_showcommentallocate|No|Comment|70|Yes|Show Comment|InputRadioFromList,Yes+No^"; 
 $parm1 = $parm1."||||Yes||Divider^";
 $parm1 = $parm1."company_matchminallocate|Yes|Min Match|70|Yes|Minimum Characters Matched|InputSelectFromList,5+6+7+8+9+10+15+20+25^"; 
 $parm1 = $parm1."company_nomatchmaxallocate|Yes|Max UnMatch|80|Yes|Maximum Characters UnMatched|InputSelectFromList,1+2+3+4+5+6+7+8^";
 $parm1 = $parm1."company_filteroutallocatelist|No|Filter|80|Yes|Filter out controls.<br>e.g. SPLIT[,][0]+SPLIT[,][2]</br>|InputText,50,200^";
 
# SPLIT[,][0]+SPLIT[,][2]
 
 $parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
 $parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";     
 GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPBANK_Output() {
$parm0 = "Bank Account|bank|bankupload|bank_id|bank_name|25|No";
$parm1 = "";
$parm1 = $parm1."bank_id|Yes|Id|70|Yes|Bank Id|KeyText,8,8^";
$parm1 = $parm1."bank_name|Yes|Name|150|Yes|Bank Name|InputText,25,40^";
$parm1 = $parm1."bank_type|Yes|Type|70|Yes|Bank Type|InputSelectFromList,current+deposit+other^";
$parm1 = $parm1."bank_sort|Yes|Sort|70|Yes|Bank Sort Code|InputText,6,6^";
$parm1 = $parm1."bank_account|Yes|Account|70|Yes|Bank Account Code|InputText,8,8^";
$parm1 = $parm1."bank_bankuploadid|No|Upload Format|90|Yes|Upload Format|InputSelectFromTable,bankupload,bankupload_id,bankupload_name,bankupload_id^";
$parm1 = $parm1."bank_openingbalancedate|No||90|Yes|Opening Balance Date|InputDate^";
$parm1 = $parm1."bank_openingbalance|No||90|Yes|Opening Balance|InputText,10,15^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_BANKRECONCILIATION_Output() {
$parm0 = "Bank Account|bank|bankupload|bank_id|bank_name|25|No";
$parm1 = "";
$parm1 = $parm1."bank_id|Yes|Id|70|Yes|Bank Id|KeyText,8,8^";
$parm1 = $parm1."bank_name|Yes|Name|150|Yes|Bank Name|InputText,25,40^";
$parm1 = $parm1."bank_type|Yes|Type|70|Yes|Bank Type|InputSelectFromList,current+deposit+other^";
$parm1 = $parm1."bank_sort|Yes|Sort|70|Yes|Bank Sort Code|InputText,6,6^";
$parm1 = $parm1."bank_account|Yes|Account|70|Yes|Bank Account Code|InputText,8,8^";
$parm1 = $parm1."bank_bankuploadid|No|Upload Format|90|Yes|Upload Format|InputSelectFromTable,bankupload,bankupload_id,bankupload_name,bankupload_id^";
$parm1 = $parm1."bank_openingbalancedate|Yes|Opening Balance Date|90|Yes|Opening Balance Date|InputDate^";
$parm1 = $parm1."bank_openingbalance|Yes|Opening Balance|90|Yes|Opening Balance|InputText,10,15^";
$parm1 = $parm1."generic_programbutton|Yes|Reconcile|100|No|Reconcile|ProgramButton,bankreconciliationout.php,bank_id,bank_id,newpopup,800,600^";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPBANKUPLOADFORMAT_Output() {
$parm0 = "Bank Upload Format|bankupload||bankupload_id|bankupload_name|25|No";
$parm1 = "";
$parm1 = $parm1."bankupload_id|Yes|Id|70|Yes|Bank Id|KeyText,8,8^";
$parm1 = $parm1."bankupload_name|Yes|Name|150|Yes|Bank Name|InputText,25,40^";
$parm1 = $parm1."bankupload_filetype|Yes|Type|60|Yes|File Type|InputSelectFromList,csv+qif+ofx^";
$parm1 = $parm1."||||Yes|CSV Columns (only required for csv file types)|Divider^";
$parm1 = $parm1."bankupload_header|Yes|Header|90|Yes|Header Record|InputSelectFromList,Yes+No^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_sortoffset|No|SortCode|90|Yes|SortCode Column|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_sortfilter|No|Col A|90|Yes|Col A Format|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_accountoffset|No|AccountCode|90|Yes|AccountCode|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_accountfilter|No|Col A|90|Yes|Col A Format|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_dateoffset|No|Date|90|Yes|Date|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_dateformat|No|Date|90|Yes|Date|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_txntypeoffset|No|Type|90|Yes|Type|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_descriptionoffset|No|Description|90|Yes|Description|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_debitoffset|No|Debit|90|Yes|Debit|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_debitfilter|No|Debit|90|Yes|Debit|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_creditoffset|No|Credit|90|Yes|Credit|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_creditfilter|No|Credit|90|Yes|Credit|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_balanceoffset|No|Balance|90|Yes|Balance|InputSelectFromList,".$formatlist."^";

$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_BANKUPLOADFORMATWIZARD_CSSJS () {
 $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bankuploadformat";
 $GLOBALS{'SITEPOPUPHTML'} = "Fin_Bankupload_Popup,Fin_BewBankupload_Popup,Fin_UpdateBankupload_Popup,Fin_DeleteBankupload_Popup"; 
}

function Fin_BANKUPLOADFORMATWIZARD_Output () {	
 # XINSTDHID();
 XH3("Bank File - CSV Format Wizard");
 XPTXT("This wizard allows you to select a csv file of bank transactions and to then train the system how to extract the necessary financial information.");
 XH5("Step 1 of 3. Upload a csv Bank File that you would like to train.");
 XFORMUPLOAD ("javascriptcsvfileprovider.php", "fileuploadform");
 XINSTDHID();
 XINFILEID("filebrowse_button","FileUploadName","1000000");XTXT(" ==> ");XINBUTTONID("fileupload_button","Upload File");
 X_FORM();
 XDIV("ViewInput","");
 XBR();XTXTID("bankupload_filename","Select a record to convert");
 XDIV("testinputtableouter","");
 XDIV("testinputtable","");
 X_DIV("testinputtable");
 X_DIV("testinputtableouter");
 X_DIV("ViewInput");

 XDIV("Output",""); 	
 XH5("Step 2 of 3. Train the system how to read this csv Bank File.");
 XDIV("Format","");
 XINBUTTONID("TryExisting","Try one of the existing csv formats.");XBR();XBR();
 X_DIV("Format");
 XINCHECKBOXID ("bankuploadheader","bankuploadheader","","","Input file contains header row");
 XTABLEFIXEDID("InputTable","990"); 
 XTR();XTDHTXTFIXED("Input",",90");XTDHTXTFIXED("A",",80");XTDHTXTFIXED("B",",80");XTDHTXTFIXED("C",",80");XTDHTXTFIXED("D",",80");
 XTDHTXTFIXED("E",",80");XTDHTXTFIXED("F",",80");XTDHTXTFIXED("G",",80");XTDHTXTFIXED("H",",80");XTDHTXTFIXED("I","80");X_TR(); 
 $thash = List2Hash("Sort,Account,Sort_Account,DD.MM.YY,DD.MM.YYYY,DD.Mon.YY,MM.DD.YY,Txn Type,Description,Debit,Credit,Debit/Credit,Balance,Not Used");
 XTR();XTDHTXTID("bankuploadid","New Format");
 XTHINSELECTHASH($thash,"Format0","");XTHINSELECTHASH($thash,"Format1","");XTHINSELECTHASH($thash,"Format2","");XTHINSELECTHASH($thash,"Format3","");
 XTHINSELECTHASH($thash,"Format4","");XTHINSELECTHASH($thash,"Format5","");XTHINSELECTHASH($thash,"Format6","");XTHINSELECTHASH($thash,"Format7","");XTHINSELECTHASH($thash,"Format8","");X_TR();
 XTR();XTDTXT("Input");XTD();XTXTID("InCol0","");X_TD();XTD();XTXTID("InCol1","");X_TD();XTD();XTXTID("InCol2","");X_TD();XTD();XTXTID("InCol3","");X_TD();XTD();XTXTID("InCol4","");X_TD();
 XTD();XTXTID("InCol5","");X_TD();XTD();XTXTID("InCol6","");X_TD();XTD();XTXTID("InCol7","");X_TD();XTD();XTXTID("InCol8","");X_TD();X_TR();
 XTR();XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");X_TR();
 X_TABLE(); 
 XBR();XTXT("This Bank File record has been interpreted as follows:"); XBR();
 XTABLEID("OutputTable"); 
 XTR();XTDHTXT("Output");XTDHTXT("Sort");XTDHTXT("Account");XTDHTXT("Date");XTDHTXT("TxnType");XTDHTXT("Description");XTDHTXT("Debit");XTDHTXT("Credit");XTDHTXT("Balance");XTDHTXT("");X_TR();
 XTR();XTDHTXT("Format");XTDHTXT("123456");XTDHTXT("12345678");XTDHTXT("2015-02-31");XTDHTXT("Text");XTDHTXT("Text");XTDHTXT("123.45");XTDHTXT("123.45");XTDHTXT("123.45");XTDHTXT("");X_TR();
 XTR();XTDTXT("Output");XTD();XTXTID("OutCol0","");X_TD();XTD();XTXTID("OutCol1","");X_TD();XTD();XTXTID("OutCol2","");X_TD();XTD();XTXTID("OutCol3","");X_TD();XTD();XTXTID("OutCol4","");X_TD();
 XTD();XTXTID("OutCol5","");X_TD();XTD();XTXTID("OutCol6","");X_TD();XTD();XTXTID("OutCol7","");X_TD();XTD();XTXTID("OutResult","");X_TD();X_TR();
 XTR();XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");X_TR();
 X_TABLE();
 X_DIV("Output"); 
 XDIV("Save",""); 
 XH5("Step 3 of 3. Save the result");
 XINBUTTONID("bankuploadupdate_button","Update existing format");
 XINBUTTONID("bankuploadnew_button","Save as a new format");
 XINBUTTONID("bankuploadcancel_button","Cancel");
 X_DIV("Save");
 
 XH5("Update Log");
 XDIV("updateLog","");
 XTXT("No updates have been made in this session so far");
 X_DIV("updateLog");
}

function Fin_Bankupload_Popup() {
 XDIVPOPUP("bankuploadDialog","Existing Bank Formats");
 XDIV("bankuploadtableouter","");
 XDIV("bankuploadtable","");
 X_DIV("bankuploadtable");
 X_DIV("bankuploadtableouter");
 XINBUTTONIDCLASS("bankuploadDialogSave","bankuploadDialogSave","Save");
 XINBUTTONIDCLASS("bankuploadDialogClose","bankuploadDialogClose","Close");
 XBR();
 X_DIV("bankuploadDialog");
}
function Fin_NewBankupload_Popup() { 
 XDIVPOPUP("newBankuploadDialog","Create New Bank Upload Format");
 XTABLE();
 XTR();XTDTXT("New Format Id");XTDINTXTID("nbankuploadidinput","nbankuploadidinput","","8","8");X_TR();
 XTR();XTDTXT("New Format Description");XTDINTXTID("nbankuploadnameinput","nbankuploadnameinput","","20","50");X_TR();
 X_TABLE();
 XINBUTTONIDCLASS("newBankuploadDialogSave","newBankuploadDialogSave","Save");
 XINBUTTONIDCLASS("newBankuploadDialogClose","newBankuploadDialogClose","Close");
 XBR();
 X_DIV("newBankuploadDialog");
}
function Fin_UpdateBankupload_Popup() { 
 XDIVPOPUP("updateBankuploadDialog","Update Bank Upload Format");
 XBR();XTXTID("bankuploadupdate_warning","Please confirm that you wish to update this Format?");
 X_DIV("updateBankuploadDialog");
}
function Fin_DeleteBankupload_Popup() { 
 XDIVPOPUP("deleteBankuploadDialog","Delete Bank Upload Format");
 XBR();XTXTID("bankuploaddelete_warning","Are you sure you want to delete this Format?");
 X_DIV("deleteBankuploadDialog"); 
}

function Fin_SETUPVATPERIOD_Output() {
$parm0 = "VAT Period Update|vatperiod||vatperiod_id|vatperiod_id|No|No";
$parm1 = "";
$parm1 = $parm1."vatperiod_id|Yes|Id|90|Yes|Vat Rate Id|KeyText,8,8^";
$parm1 = $parm1."vatperiod_description|Yes|Description|150|Yes|Description|InputText,25,40^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPVATRATE_Output() {
$parm0 = "Vat Rate Update|vatrate[mergedkey=vatrate_id+vatrate_dateeffective]||vatrate_id+vatrate_dateeffective|vatrate_id+vatrate_dateeffective|No|No";
$parm1 = "";
$parm1 = $parm1."vatrate_id|Yes|Id|130|Yes|Vat Rate Id|KeyText,8,8^";
$parm1 = $parm1."vatrate_dateeffective|Yes|Date Effective|130|Yes|Vat Rate Date Effective|KeyDate^";
$parm1 = $parm1."vatrate_description|Yes|Description|150|Yes|Description|InputText,25,40^";
$parm1 = $parm1."vatrate_rate|Yes|Rate|90|Yes|Rate|InputText,5,5^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPVATFLATRATE_Output() {
$parm0 = "Vat Flat Rate Update|vatflatrate[mergedkey=vatflatrate_id+vatflatrate_dateeffective]||vatflatrate_id+vatflatrate_dateeffective|vatflatrate_id+vatflatrate_dateeffective|No|No";
$parm1 = "";
$parm1 = $parm1."vatflatrate_id|Yes|Id|130|Yes|Vat Flat Rate Id|KeyText,8,8^";
$parm1 = $parm1."vatflatrate_dateeffective|Yes|Date Effective|130|Yes|Vat Flat Rate Date Effective|KeyDate^";
$parm1 = $parm1."vatflatrate_description|Yes|Description|150|Yes|Description|InputText,25,40^";
$parm1 = $parm1."vatflatrate_rate|Yes|Rate|90|Yes|Rate|InputText,5,5^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPFINCATEGORY_Output() {
$parm0 = "Financial Category Update|fincategory||fincategory_id|fincategory_id|25|No";
$parm1 = "";
$parm1 = $parm1."fincategory_id|Yes|Id|25|Yes|Fin Category Id|KeyText,8,8^";
$parm1 = $parm1."fincategory_subheader|Yes|Subheader|50|Yes|Sub Header Description|InputRadioFromList,Yes+No^";
$parm1 = $parm1."fincategory_description|Yes|Description|100|Yes|Description|InputText,25,40^";
$parm1 = $parm1."fincategory_sageid|Yes|Sage|50|Yes|Sage Code|InputText,4,6^";
$parm1 = $parm1."fincategory_irisid|Yes|IRIS|55|Yes|IRIS Code|InputText,4,6^";
$list = "Bank+Purchase+Travel+Customer Receipt+Payroll+HMRC+Dividend or Loan"; 
$parm1 = $parm1."fincategory_purpose|No|||Yes|Transaction Type|InputRadioFromList,".$list."^";
$parm1 = $parm1."fincategory_pettycashitem|No|Petty Caash|50|Yes|Petty Cash Item|InputRadioFromList,Yes+No^";
$parm1 = $parm1."||||Yes|Used in following situations|Divider^";
$list = "PS[Professional Services]+CONSUL[Consultant]+CONSTR[Construction]+RETAIL[Retail]+RESELL[Reseller]+MFG[Manufacturing]"; 
$parm1 = $parm1."fincategory_businesssectorlist|No|Business|60|Yes|Business Sector|InputCheckboxFromList,".$list."^";
$parm1 = $parm1."||||Yes|... as well as ....|Divider^";
$parm1 = $parm1."fincategory_useunconditional|Yes|Use Always|50|Yes|Use Always|InputRadioFromList,Yes+No^";
$parm1 = $parm1."||||Yes||Divider^";
$list = "ST[Sole Trader]+P[Partnership]+LTD[Limited Company]+LLP[LLP]"; 
$parm1 = $parm1."fincategory_companytypelist|No|Company|60|Yes|Company Type|InputCheckboxFromList,".$list."^";			
$list = "None[No Vat]+FRI[Flat Rate VAT - Invoice Accounting]+FRC[Flat Rate VAT - Cash Accounting]+NI[Normal VAT - Invoice Accounting]+NC[Normal VAT - Cash Accounting]"; 
$parm1 = $parm1."fincategory_vattreatmentlist|No|VAT|55|Yes|VAT Treatment|InputCheckboxFromList,".$list."^";
$parm1 = $parm1."fincategory_hometreatmentlist|No|Home|55|Yes|Home Treatment|InputCheckboxFromList,FEXP[Fully Expensed basis]+FRATE[Flat Rate Basis]^";
$parm1 = $parm1."fincategory_cartreatmentlist|No|Car|55|Yes|Car Treatment|InputCheckboxFromList,FEXP[Fully Expensed Basis]+MILE[Mileage Basis]^";	
$list = "None[None]+DO[Director Only]+SO[Staff Only]+All[Director and Staff]"; 
$parm1 = $parm1."fincategory_payrolltreatmentlist|No|Payroll|55|Yes|Payroll Treatment|InputCheckboxFromList,".$list."^";
$parm1 = $parm1."fincategory_bankcurrentacounttreatmentlist|No|Curr|25|Yes|Bank Charges-Interest|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."fincategory_creditcardtreatmentlist|No|Credit|25|Yes|Credit Card|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."fincategory_bankdepositaccounttreatmentlist|No|Dep|250|Yes|Deposit Account|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."fincategory_pettycashtreatmentlist|No|Cash|25|Yes|Petty Cash|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."fincategory_loantreatmentlist|No|Loan|25|Yes|Loan or Mortgage|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."||||Yes|Resulting Selection|Divider^";
$parm1 = $parm1."fincategory_usedefaulted|Yes|Defaulted|50|Yes|Defaulted|KeyText,8,8^";
$parm1 = $parm1."fincategory_useselected|Yes|Selected|50|Yes|Custom Selection|InputRadioFromList,Yes+No^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETDEFAULTFINCATEGORIES_Output () {
XH3("Set the Default Financial Categories");
XPTXT("This action will set up the required financial categories for the company.");
XBR();
XFORM("finsetdefaultfincategories.php","");
XTDINSUBMIT("Go");
XINSTDHID();
X_FORM();
}

function Fin_IMPORTFINCATEGORY_Output () {
XH3("Financial Categories Import");
XPTXT("Please select file containing financial category information to upload.");
# $helplink = "SalesMaster/Setup_ADVERTISER_Output/setup_advertiser_output.html"; Help_Link;
XFORMUPLOAD("finimportfincategoriesin.php","finimportfincategoriesin");
XINSTDHID();
XINFILE("FinCategoryFile","100000");
XBR();
XINSUBMIT("Upload");
}

function Fin_CONVERTFINCATEGORY_Output () {
XH3("Convert Financial Categories");
XBR();
XFORM("finconvertfincategories.php","");
XTDINSUBMIT("Go");
XINSTDHID();
X_FORM();
}

function Fin_SETUPSUPPLIER_Output() {
$parm0 = "Supplier Update|supplier||supplier_id|supplier_name|25|No";
$parm1 = "";
$parm1 = $parm1."supplier_id|Yes|Id|90|Yes|Supplier Id|KeyText,8,8^";
$parm1 = $parm1."supplier_name|Yes|Name|180|Yes|Supplier Name|InputText,25,40^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 	
}

function Fin_SETUPCUSTOMER_Output() {
$parm0 = "Customer Update|customer||customer_id|customer_name|25|No";
$parm1 = "";
$parm1 = $parm1."customer_id|Yes|Id|90|Yes|Customer Id|KeyText,8,8^";
$parm1 = $parm1."customer_name|Yes|Name|180|Yes|Customer Name|InputText,25,40^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPJOB_Output() {
$parm0 = "Job Update|job|customer|job_id|job_id|25|No";
$parm1 = "";
$parm1 = $parm1."job_id|Yes|Id|90|Yes|Job Id|KeyText,8,8^";
$parm1 = $parm1."job_description|Yes|Description|180|Yes|Description|InputText,25,40^";
$parm1 = $parm1."job_customerid|Yes|Customer Id|90|Yes|Customer Id|InputSelectFromTable,customer,customer_id,customer_name,customer_name^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPTXNTEMPLATE_Output() {
$parm0 = "Transaction Templates |txntemplate||txntemplate_purpose|txntemplate_purpose|25|No";
$parm1 = "";
$parm1 = $parm1."txntemplate_purpose|Yes|Transaction Type|110|Yes|Transaction Type|KeyText,20,40^";
$parm1 = $parm1."txntemplate_comment|Yes|Comment|70|Yes|Comment|InputSelectFromList,Optional^";
$parm1 = $parm1."txntemplate_supplierid|Yes|Supplier|70|Yes|Supplier|InputSelectFromList,NA+Selected^";
$parm1 = $parm1."txntemplate_paymenttype|Yes|Payment Type|70|Yes|Payment Type|InputSelectFromList,NA+Selected^";
$parm1 = $parm1."txntemplate_vatrateid|Yes|VAT Rate|70|Yes|VAT Rate|InputSelectFromList,Defaulted+Selected^";
$parm1 = $parm1."txntemplate_fincategoryid|Yes|Fin Cat|70|Yes|Financial Category|InputSelectFromList,Defaulted+Selected^";
$parm1 = $parm1."txntemplate_customerid|Yes|Customer|70|Yes|Customer|InputSelectFromList,NA+Selected^";
$parm1 = $parm1."txntemplate_jobid|Yes|Job|70|Yes|Job Id|InputSelectFromList,NA+Optional^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPTXNFAVOURITE_Output() {
$parm0 = "Transaction Favoutites |txnfavourite|txntemplate,supplier,customer,vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory|txnfavourite_id|txnfavourite_id|25|No";
$parm1 = "";
$parm1 = $parm1."txnfavourite_id|Yes|Id|120|Yes|Id|KeyText,20,40^";
$parm1 = $parm1."txnfavourite_purpose|Yes|Type|70|Yes|Transaction type|InputSelectFromTable,txntemplate,txntemplate_purpose,txntemplate_purpose,txntemplate_purpose^";;
$parm1 = $parm1."txnfavourite_comment|No|Comment|70|Yes|Comment|InputText,40,60^";
$parm1 = $parm1."txnfavourite_supplierid|Yes|Supplier Id|70|Yes|Supplier Id|InputSelectFromTable,supplier,supplier_id,supplier_name,supplier_name^";
$parm1 = $parm1."txnfavourite_paymenttype|Yes|Payment Type|70|Yes|Payment Type|InputSelectFromList,Account+Transaction^";
$parm1 = $parm1."txnfavourite_vatrateid|Yes|Vatrate|70|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."txnfavourite_fincategoryid|Yes|Fin Category|70|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."txnfavourite_customerid|Yes|Customer Id|70|Yes|Customer Id|InputSelectFromTable,customer,customer_id,customer_name,customer_name^";
$parm1 = $parm1."txnfavourite_jobid|Yes|Job Id|70|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."txnfavourite_usedefaulted|Yes|Defaulted|50|Yes|Defaulted|InputRadioFromList,Yes+No^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPMILEAGEPARM_Output() {
$parm0 = "Mileage Parameter Update|mileageparm[mergedkey=mileageparm_unit+mileageparm_dateeffective]||mileageparm_unit+mileageparm_dateeffective|mileageparm_unit+mileageparm_dateeffective|No|No";
$parm1 = "";
$parm1 = $parm1."mileageparm_unit|Yes|Distance Unit|180|Yes|Distance Unit|KeyText,12,12^";
$parm1 = $parm1."mileageparm_dateeffective|Yes|Date Effective|180|Yes|Date Effective|KeyDate^";
$parm1 = $parm1."mileageparm_rate|Yes|Rate|100|Yes|Rate|InputText,5,8^";
$parm1 = $parm1."mileageparm_rateover10k|Yes|Rate over 10K|100|Yes|Rate over 10K|InputText,5,8^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPFUELPARM_Output() {
 $parm0 = "Fuel Parameter Update|fuelparm[mergedkey=fuelparm_enginetype+fuelparm_dateeffective]||fuelparm_enginetype+fuelparm_dateeffective|fuelparm_enginetype+fuelparm_dateeffective|25|No";
 $parm1 = "";
 $parm1 = $parm1."fuelparm_enginetype|Yes|Engine Type|300|Yes|Engine Type|KeyText,25,25^";
 $parm1 = $parm1."fuelparm_dateeffective|Yes|Date Effective|300|Yes|Date Effective|KeyDate^";
 $parm1 = $parm1."fuelparm_rate|Yes|Fuel Rate|100|Yes|Fuel Rate|InputText,5,8^";
 $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
 $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
 GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPMILEAGEFAVOURITE_Output() {
$parm0 = "Mileage Favoutite Destinations|mileagefavourite||mileagefavourite_id|mileagefavourite_destination|25|No";
$parm1 = "";
$parm1 = $parm1."mileagefavourite_id|Yes|Id|60|Yes|Id|KeyText,20,40^";
$parm1 = $parm1."mileagefavourite_destination|Yes|Destination|120|Yes|Destination|InputText,40,60^";
$parm1 = $parm1."mileagefavourite_distance|Yes|Distance|90|Yes|Distance|InputText,5,8^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_MILEAGE_Output() {
$parm0 = "Mileage Transactions|mileagetxn|mileagefavourite,person,fuelparm[mergedkey=fuelparm_enginetype+fuelparm_dateeffective]|mileagetxn_id|mileagetxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."mileagetxn_id|Yes|Id|50|Yes|Id|KeyGenerated,M[00000]^";
$parm1 = $parm1."mileagetxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."mileagetxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."mileagetxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."mileagetxn_personid|Yes|Person|40|Yes|Personal Id|InputSelectFromTable,person,person_id,person_id,person_sname^";
$parm1 = $parm1."mileagetxn_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."mileagetxn_favouriteid|No|Favourite|90|Yes|Favourite|InputSelectFromTableCustom,mileagefavourite,mileagefavourite_id,mileagefavourite_destination,mileagefavourite_destination,destination+distance^";
$parm1 = $parm1."mileagetxn_destination|Yes|Destination|120|Yes|Destination|InputText,40,60^";
$parm1 = $parm1."mileagetxn_distance|Yes|Distance|50|Yes|Distance|InputText,5,8^";
$parm1 = $parm1."mileagetxn_journeyqty|Yes|Qty|50|Yes|Journey Qty|InputText,5,8^";
$parm1 = $parm1."mileagetxn_comment|No|Comment|90|Yes|Comment|InputText,40,60^";
$parm1 = $parm1."mileagetxn_fuelparmenginetype|Yes|Engine Type|100|Yes|Engine Type|InputSelectFromTableDateEffective,fuelparm,fuelparm_enginetype,fuelparm_enginetype,fuelparm_enginetype,mileagetxn_date^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_FINASSET_Output() {
$parm0 = "Financial Assets|finasset|vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory|finasset_id|finasset_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."finasset_id|Yes|Id|50|Yes|Id|KeyGenerated,FA[00000]^";
$parm1 = $parm1."finasset_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."finasset_value|Yes|Value|70|Yes|Asset Value|InputText,10,20^";
$parm1 = $parm1."finasset_depreciationperiod|Yes|Depreciation Period|70|Yes|Depreciation Period|InputText,2,2^";
$parm1 = $parm1."finasset_description|Yes|Description|90|Yes|Description|InputText,25,50^";
$parm1 = $parm1."finasset_vatrateid|Yes|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."finasset_vat|No|Vat|90|Yes|Vat|InputTextCalc,10,20,cashtxn_debit,vat,cashtxn_vatrateid,cashtxn_date^";
$parm1 = $parm1."finasset_fincategoryid|No|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."finasset_jobid|No|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_DEPRECIATIONTXN_Output() {
$parm0 = "Depreciation Transactions|depreciationtxn|vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory,finasset|depreciationtxn_id|depreciationtxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."depreciationtxn_id|Yes|Id|50|Yes|Id|KeyGenerated,DP[00000]^";
$parm1 = $parm1."depreciationtxn_finassetid|Yes|Asset Id|50|Yes|Asset Id|InputSelectFromTable,finasset,finasset_id,finasset_description,finasset_id^";
$parm1 = $parm1."depreciationtxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."depreciationtxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."depreciationtxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."depreciationtxn_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."depreciationtxn_value|Yes|Depreciation Value|70|Yes|Depreciation Value|InputText,10,20^";
$parm1 = $parm1."depreciationtxn_description|Yes|Description|90|Yes|Description|InputText,25,50^";
$parm1 = $parm1."depreciationtxn_vatrateid|Yes|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."depreciationtxn_vat|No|Vat|90|Yes|Vat|InputTextCalc,10,20,cashtxn_debit,vat,cashtxn_vatrateid,cashtxn_date^";
$parm1 = $parm1."depreciationtxn_fincategoryid|No|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."depreciationtxn_jobid|No|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_MAINTAINBANKFILELIST_Output () {
XH3("Bank Transaction Upload");
# $helplink = "SalesMaster/Setup_ADVERTISERSLIST_Output/setup_advertiserslist_output.html"; Help_Link;
XH5("List of existing bank file uploads");
XTABLE();
$bankfilea = Get_Array('bankfile');
$formseq = 0;
$firstbankfile = "1";
foreach ($bankfilea as $bankfile_id) {
 Get_Data('bankfile',$bankfile_id);
 if ($firstbankfile == "1") {
  XTR();
  XTDHTXT("Bank File Id");
  XTDHTXT("Bank Id");
  XTDHTXT("BankFormat Id");  
  XTDHTXT("File");
  XTDHTXT("Comment");
  XTDHTXT("Date Start");
  XTDHTXT("Date End");
  XTDHTXT("Range Start");
  XTDHTXT("Range End");
  XTDHTXT("Status");
  XTDHTXT("");
  XTDHTXT("");
  X_TR();
  $firstbankfile = "0";  
 } 
 XTR();
 XTDTXT($GLOBALS{'bankfile_id'});
 XTDTXT($GLOBALS{'bankfile_bankid'});
 XTDTXT($GLOBALS{'bankfile_bankuploadid'}); 
 XTDTXT($GLOBALS{'bankfile_file'});
 XTDTXT($GLOBALS{'bankfile_comment'});   
 XTDTXT($GLOBALS{'bankfile_periodstart'}); 
 XTDTXT($GLOBALS{'bankfile_periodend'});
 XTDTXT($GLOBALS{'bankfile_banktxnidrangestart'});
 XTDTXT($GLOBALS{'bankfile_banktxnidrangeend'});    
 XTDTXT($GLOBALS{'bankfile_status'}); 
 $link = YPGMLINK("finbankfileuploadlistin.php").YPGMSTDPARMS();
 $link = $link.YPGMPARM("BankFileId",$bankfile_id).YPGMPARM("ACD","C");  
 XTDLINKTXT($link,"review");
 $link = YPGMLINK("finbankfileuploadlistin.php").YPGMSTDPARMS();
 $link = $link.YPGMPARM("BankFileId",$bankfile_id).YPGMPARM("ACD","D");     
 XTDLINKTXT($link,"delete");
 X_TR();
 $formseq++;
}
X_TABLE();
if ($firstbankfile == "1") {XPTXT("There are currently no Bank Files loaded.");}
XBR();XBR();
XFORM("finbankfileuploadlistin.php","bankuploadformatadd");
XINSTDHID();
XINHID("ACD","A");
XINHID("BankFileId","");
XINSUBMIT("Upload a new Bank File");
X_FORM();
}		

function Fin_MAINTAINBANKFILE_Output ($acd) {
XH3("Bank Transaction Maintenance - ".$GLOBALS{'bankfile_id'});
# $helplink = "SalesMaster/Setup_ADVERTISER_Output/setup_advertiser_output.html"; Help_Link;
XFORMUPLOAD("finbankfileuploadin.php","bankfileuploadin");
XINSTDHID();
XINHID("ACD",$acd);
XINHID("BankFileId",$GLOBALS{'bankfile_id'});
if ($acd == "A") {
 XTABLE();
 XTR();XTDHTXT("Bank File Information");XTDHTXT("");X_TR();
 XTR();XTDTXT("Bank File Id");XTDTXT($GLOBALS{'bankfile_id'});X_TR(); 
 $bankkeyarray = array(); $bankvaluearray = array();
 $banka = Get_Array('bank');
 foreach ($banka as $tbank_id) {
  Get_Data('bank',$tbank_id);
  array_push($bankkeyarray, $tbank_id);
  $bankvaluestring = $GLOBALS{'bank_name'};
  array_push($bankvaluearray, $bankvaluestring);
 }
 $bankselecthash = Arrays2Hash($bankkeyarray,$bankvaluearray);
 XTR();XTDTXT("Bank Account"); XTDINSELECTHASH($bankselecthash,"BankFileBankId","");X_TR(); 
 $bankuploadkeyarray = array(); $bankuploadvaluearray = array(); 
 $bankuploada = Get_Array('bankupload');
 foreach ($bankuploada as $tbankupload_id) {
  Get_Data('bankupload',$tbankupload_id);
  array_push($bankuploadkeyarray, $tbankupload_id); 
  $bankuploadvaluestring = $GLOBALS{'bankupload_name'};
  array_push($bankuploadvaluearray, $bankuploadvaluestring);
 }
 $bankuploadselecthash = Arrays2Hash($bankuploadkeyarray,$bankuploadvaluearray);
 XTR();XTDTXT("Bank Format"); XTDINSELECTHASH($bankuploadselecthash,"BankFileBankUploadId","");X_TR();
 XTR();XTDTXT("File Containing Data");XTDINFILE("BankFileFile","100000");X_TR();
 XTR();XTDTXT("Comment");XTDINTXT("BankFileComment",$GLOBALS{'bankfile_comment'},"25","25");X_TR();
 XTR();XTDTXT("");XTD();XINSUBMITNAME("Cancel","Cancel");XINSUBMITNAME("Update","Update");X_TD();X_TR();
 X_TABLE();
}
if ($acd == "C") {
 XTABLE();
 XTR();XTDHTXT("Bank File Information");XTDHTXT("");X_TR();
 XTR();XTDTXT("Bank File Id");XTDTXT($GLOBALS{'bankfile_id'});X_TR(); 
 Get_Data('bank',$GLOBALS{'bankfile_bankid'});
 XTR();XTDTXT("Bank Account");XTDTXT($GLOBALS{'bank_name'});X_TR();
 XTR();XTDTXT("File Containing Data");XTDTXT($GLOBALS{'bankfile_file'});X_TR();
 XTR();XTDTXT("File Upload Format");XTDTXT($GLOBALS{'bankfile_bankuploadid'});X_TR(); 
 XTR();XTDTXT("Comment");XTDINTXT("BankFileComment",$GLOBALS{'bankfile_comment'},"25","25");X_TR();
 XTR();XTDTXT("Date From");XTDTXT($GLOBALS{'bankfile_periodstart'});X_TR(); 
 XTR();XTDTXT("Date To");XTDTXT($GLOBALS{'bankfile_periodend'});X_TR(); 
 XTR();XTDTXT("Transaction Range From");XTDTXT($GLOBALS{'bankfile_banktxnidrangestart'});X_TR();
 XTR();XTDTXT("Transaction Range To");XTDTXT($GLOBALS{'bankfile_banktxnidrangeend'});X_TR();  
 XTR();XTDTXT("");XTD();XINSUBMITNAME("Cancel","Cancel");XINSUBMITNAME("Update","Update");X_TD();X_TR();
 X_TABLE();
}
if ($acd == "D") {
 XBR(); 
 XTXT("Do you really want to delete this file and remove all the uploaded bank transactions");
 XBR();XBR();
 XINSUBMITNAME("Delete","Confirm Delete");
 XINSUBMITNAME("Cancel","Cancel");
 XBR();XBR();
} 	
X_FORM();
}

function Fin_ALLOCATEBANK_Output1() {
XH3("Allocate bank records to accounts");
XFORM("finallocatebank1.php","allocate11");
XINSTDHID();
XINHID("RangeRaw","no");
XINCHECKBOX ("RangeRaw","raw","checked","select unallocated records");
XINHID("RangeAllocated","no");
XBR();XINCHECKBOX ("RangeAllocated","allocated","checked","review previously allocated records");
XINHID("RangeSubmitted","no");
XBR();XINCHECKBOX ("RangeSubmitted","submitted","","select records previously submitted to accountant");
XBR();XBR();
XINSUBMIT("Allocate!");
X_FORM();
}

function Fin_ALLOCATE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm,finallocate";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report,finallocate,slimjquerymin,slimimagepopup,bootstrapdatepicker,areyousure,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "Fin_Allocate_Popup,Fin_NewFavourite_Popup,Fin_NewSupplier_Popup,Fin_NewCustomer_Popup,Fin_NewJob_Popup,Fin_AllocationClone_Popup,Fin_Wizard_Popup";	
}

function Fin_ALLOCATE_Output($parm0,$parm1) {
# bankorcash, range

# ========= Main page ===================== 
XDIV("finallocatediv","");
$bankorcash = $parm0;
$range = $parm1;
$displayrange = str_replace("raw", "unallocated", $range);
if ($bankorcash == "Bank") { 
    XH3("Allocate bank records to accounts");
    XPTXT($displayrange);
}
else { 
    XH3("Allocate cash records to accounts");
    XPTXT($displayrange);
}
XINHID("BankorCash",$bankorcash);
XINHID("Range",$range);
XTABLE();XTR();XTD();
XTXT("Allocation Wizard ==>");
XINBUTTONID("wizpropose","Propose New Allocations based on history");
XINBUTTONID("wizconfirm","Confirm all Proposals");
XINBUTTONID("wizreject","Reject all Proposals");
X_TD();X_TR();X_TABLE();

XTABLEJQDTID("banktxntable");
XTHEAD();
XTRJQDT();
XTDHTXTFIXED("Id","85");
XTDHTXTFIXED("Date","80");
XTDHTXTFIXED("Type","50");
XTDHTXTFIXED("Description","290");
XTDHTXTFIXED("Debit","50");
XTDHTXTFIXED("Credit","50");
XTDHTXTFIXED("Allocate","50");
XTDHTXTFIXED("Me Too","40");
XTDHTXTFIXED("Status","170");        
X_TR();
X_THEAD();
XTBODY();
X_TBODY();
X_TABLE();	

XFORM("personreloginin.php","allocatemasterform");
XINSTDHID();

XINSUBMIT("Finish");
X_FORM();

XH5("Update Log");
XDIV("updateLog","");
XTXT("No updates have been made in this session so far");
X_DIV("updateLog");

XTXTID("TRACETEXT","");

X_DIV("finallocatediv");
}
# ========= End of Main page ================

# ========= Allocation dialogue popup box ================
function Fin_Allocate_Popup() {
XDIVPOPUP("allocationDialog","Transaction Allocation");
XTABLEINVISIBLE();
XTR();

# ----- left panel ------------
print '<td valign="top" width="45%" >'."\n";
XDIV("allocationinput","");
XH5ID("allocationinput_header","Transaction"); 
XTABLE();
XTREVEN();XTDTXT("Date");XTDTXT("Type");XTDTXT("Description");XTDTXT("Debit");XTDTXT("Credit");X_TR();
XTRODD();XTDTXTID("allocate_banktxn_date",".....");XTDTXTID("allocate_banktxn_txntype",".....");XTDTXTID("allocate_banktxn_description",".....");
XTDTXTID("allocate_banktxn_debit",".....");XTDTXTID("allocate_banktxn_credit",".....");X_TR();
X_TABLE();
X_DIV("allocationinput");

XDIV("allocation","");
XH4ID("allocate_header","Favourite Allocations");
XPTXT("Select one of the following transaction types.");
print '<table bgcolor="white"'."/n";
XTR();XTD();
XDIV("favouriteallocations","");
X_DIV("favouriteallocations");
X_TD();
X_TR();X_TABLE();
XBR();
X_DIV("allocation");
X_TD();

# ----- central gutter ------------
print '<td valign="top" width="10%" bgcolor="white" >'."\n";
X_TD();

# ----- right panel ------------
print '<td valign="top" width="45%" >'."\n";
XDIV("allocationresult","");
XH5ID("allocationresult_header","Allocation Result");
XH5ID("allocationresult_message","No Allocation made so far");
XFORM("finallocatein.php","allocateresultform");
XINSTDHID();
XINHID("idinput","idinput","XXXX");
XINHID("purposeinput","purposeinput","XXXX");
XTABLE();
$nullhash = array();
XTRID("purposerow");XTD();XTXT("transaction type:");X_TD();XTD();XTXTID("purposetext","");X_TD();X_TR();
XTRID("favouritenamerow");XTD();XTXT("favourite name:");X_TD();XTD();XTXTID("favouritenametext","");XINBUTTONID("newfavouritebutton","New");X_TD();X_TR();
XTRID("separator1row");XTH();XTXT("");X_TH();
print '<th align="right" valign="top"><small><small><a id="moreorlesstext">more detail...</a></small></small></th>'."\n";
X_TR();
XTRID("supplieridrow");XTD();XTXT("supplier:");X_TD();XTD();XINSELECTHASH ($nullhash,"supplieridinput","");XINBUTTONID("newsupplierbutton","New");X_TD();X_TR();
XTRID("paymenttyperow");XTD();XTXT("payment type:");X_TD();XTD();XINSELECTHASH ($nullhash,"paymenttypeinput","");X_TD();X_TR();
XTRID("vatrateidrow");XTD();XTXT("vat rate:");X_TD();XTD();XINSELECTHASH ($nullhash,"vatrateidinput","");X_TD();X_TR();
XTRID("vatrow");XTD();XTXT("vat:");X_TD();XTD();XTXT("calculated ");XTXTID("vatratepercenttext","");XTXT(" ==>");XINTXTID("vatinput","vatinput","","10","20");X_TD();X_TR();
XTRID("fincategoryidrow");XTD();XTXT("financial category:");X_TD();XTD();XINSELECTHASH ($nullhash,"fincategoryidinput","");X_TD();X_TR();
XTRID("customeridrow");XTD();XTXT("customer:");X_TD();XTD();XINSELECTHASH ($nullhash,"customeridinput","");XINBUTTONID("newcustomerbutton","New");X_TD();X_TR();
XTRID("separator2row");XTH();XTXT("");X_TH();XTH();XTXT("");X_TH();X_TR();
XTRID("jobidrow");XTD();XTXT("job:");X_TD();XTD();XINSELECTHASH ($nullhash,"jobidinput","");XINBUTTONID("newjobbutton","New");X_TD();X_TR();
XTRID("commentrow");XTD();XTXT("comment:");X_TD();XTD();XINTXTID("commentinput","commentinput","","20","50");XBR();
XINCHECKBOXID("addtobankdescription","addtobankdescription","Yes","","Add to Bank Description");X_TD();X_TR();
X_TABLE();
X_FORM();
X_DIV("allocationresult");
X_TD();

X_TR();X_TABLE();
XINBUTTONIDCLASS("allocationDialogSave","allocationDialogSave","Save");
XINBUTTONIDCLASS("allocationDialogClose","allocationDialogClose","Close");
XBR();
X_DIV("allocationDialog");
}
# ========= End of Allocation dialogue popup box ================

# ========= New Favourite popup box ================
function Fin_NewFavourite_Popup() {
XDIVPOPUP("newFavouriteDialog","Create New Favourite");
XTXTID("nffavouritepurposetext","");XBR();XBR();
XTABLE();
XTR();XTDTXT("New Favourite Name");XTDINTXTID("nffavouritenameinput","nffavouritenameinput","","20","50");X_TR();
X_TABLE();
XINBUTTONIDCLASS("newFavouriteDialogSave","newFavouriteDialogSave","Save");
XINBUTTONIDCLASS("newFavouriteDialogClose","newFavouriteDialogClose","Close");
XBR();
X_DIV("newFavouriteDialog");
}
# ========= New Supplier popup box ================
function Fin_NewSupplier_Popup() {
XDIVPOPUP("newSupplierDialog","Create New Supplier");
XTABLE();
XTR();XTDTXT("New Supplier Id");XTDINTXTID("nssupplieridinput","nssupplieridinput","","8","8");X_TR();
XTR();XTDTXT("New Supplier Name");XTDINTXTID("nssuppliernameinput","nssuppliernameinput","","20","50");X_TR();
X_TABLE();
XINBUTTONIDCLASS("newSupplierDialogSave","newSupplierDialogSave","Save");
XINBUTTONIDCLASS("newSupplierDialogClose","newSupplierDialogClose","Close");
XBR();
X_DIV("newSupplierDialog");
}
# ========= New Cstomer popup box ================
function Fin_NewCustomer_Popup() {
XDIVPOPUP("newCustomerDialog","Create New Customer");
XTABLE();;
XTR();XTDTXT("New Customer Id");XTDINTXTID("nccustomeridinput","nccustomeridinput","","8","8");X_TR();
XTR();XTDTXT("New Customer Name");XTDINTXTID("nccustomernameinput","nccustomernameinput","","20","50");X_TR();
X_TABLE();
XINBUTTONIDCLASS("newCustomerDialogSave","newCustomerDialogSave","Save");
XINBUTTONIDCLASS("newCustomerDialogClose","newCustomerDialogClose","Close");
XBR();
X_DIV("newCustomerDialog");
}
# ========= New Job popup box ================
function Fin_NewJob_Popup() {
XDIVPOPUP("newJobDialog","Create New Customer");
XTABLE();
$nullhash = array();
XTR();XTDTXT("New Job Id");XTDINTXTID("njjobidinput","njjobidinput","","8","8");X_TR();
XTR();XTDTXT("New Job Name");XTDINTXTID("njjobnameinput","njjobnameinput","","20","50");X_TR();
# XTR;XTDTXT("Customer Id");XTD();XINSELECTHASH ($nullhash,"nscustomeridinput","");X_TD();X_TR();
X_TABLE();
XINBUTTONIDCLASS("newJobDialogSave","newJobDialogSave","Save");
XINBUTTONIDCLASS("newJobDialogClose","newJobDialogClose","Close");
XBR();
X_DIV("newJobDialog");
}
# ========= AllocationClone popup box ================
function Fin_AllocationClone_Popup() {
XDIVPOPUP("allocationCloneDialog","Similar Allocations");
XTXTID("allocationclonetext","");XBR();XBR();
XTABLEJQDTID("allocationclonetable");
XTHEAD();
XTRJQDT();
XTDHTXTFIXED("Id","70");
XTDHTXTFIXED("Date","70");
XTDHTXTFIXED("Type","20");
XTDHTXTFIXED("Description","300");
XTDHTXTFIXED("Debit","50");
XTDHTXTFIXED("Credit","50");
X_TR();
X_THEAD();
XTBODY();
X_TBODY();
X_TABLE();	

XINBUTTONIDCLASS("allocationCloneDialogSave","allocationCloneDialogSave","Accept and Save");
XINBUTTONIDCLASS("allocationCloneDialogClose","allocationCloneDialogClose","Close");
XBR();
X_DIV("allocationCloneDialog");
}
# ========= Wizard popup box ================
function Fin_Wizard_Popup() {
XDIVPOPUP("wizardDialog","Allocation Wizard");
XH5ID("wizardopeningtext","");XBR();
XTABLEJQDTID("wizardresponsetable");
XTHEAD();
XTRJQDT();
XTDHTXTFIXED("Id","70");
XTDHTXTFIXED("Date","70");
XTDHTXTFIXED("Type","20");
XTDHTXTFIXED("Description","250");
XTDHTXTFIXED("Debit","50");
XTDHTXTFIXED("Credit","50");
XTDHTXTFIXED("Action","250");
X_TR();
X_THEAD();
XTBODY();
X_TBODY();
X_TABLE();	

XBR();XTXTID("wizardclosingtext","");
XINBUTTONIDCLASS("wizardDialogSave","wizardDialogSave","Apply Proposals");
XINBUTTONIDCLASS("wizardDialogClose","wizardDialogClose","Close");
XBR();
X_DIV("wizardDialog");
}

function Fin_PURCHASEINVOICE_Output() {
$parm0 = "Purchase Accounts|purchaseinvoice|supplier,job,vatrate[mergedkey=vatrate_id+vatrate_dateeffective],fincategory[fieldvalue=fincategory_purpose:Purchase]|purchaseinvoice_id|purchaseinvoice_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."purchaseinvoice_id|Yes|Id|55|Yes|Id|KeyGenerated,PI[00000]^";
$parm1 = $parm1."purchaseinvoice_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."purchaseinvoice_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."purchaseinvoice_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."purchaseinvoice_description|Yes|Description|90|Yes|Description|InputText,50,80^";
$parm1 = $parm1."purchaseinvoice_supplierid|Yes|Supplier Id|90|Yes|Supplier Id|InputSelectFromTable,supplier,supplier_id,supplier_name,supplier_name^";
$parm1 = $parm1."purchaseinvoice_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."purchaseinvoice_net|Yes|Net|60|Yes|Net|InputText,10,20^";
$parm1 = $parm1."purchaseinvoice_vatrateid|NO|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,purchaseinvoice_date^";
$parm1 = $parm1."purchaseinvoice_vat|NO|Vat|90|Yes|Vat|InputText,10,20^";
$parm1 = $parm1."purchaseinvoice_gross|No|Gross|90|Yes|Gross|InputText,10,20^";
$parm1 = $parm1."purchaseinvoice_jobid|No|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."purchaseinvoice_fincategoryid|NO|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|65|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|65|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SALESINVOICE_Output() {
$parm0 = "Sales Invoices|salesinvoice|customer,job,vatrate[mergedkey=vatrate_id+vatrate_dateeffective],fincategory[fieldvalue=fincategory_purpose:Customer Receipt]|salesinvoice_id|salesinvoice_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."salesinvoice_id|Yes|Id|50|Yes|Id|KeyGenerated,SI[00000]^";
$parm1 = $parm1."salesinvoice_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."salesinvoice_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."salesinvoice_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."salesinvoice_description|Yes|Description|90|Yes|Description|InputText,50,80^";
$parm1 = $parm1."salesinvoice_customerid|Yes|Customer Id|90|Yes|Customer Id|InputSelectFromTable,customer,customer_id,customer_name,customer_name^";
$parm1 = $parm1."salesinvoice_date|Yes|Date|80|Yes|Date|InputDate^";
$parm1 = $parm1."salesinvoice_net|No|Net|90|Yes|Net|InputText,10,20^";
$parm1 = $parm1."salesinvoice_vatrateid|NO|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,salesinvoice_date^";
$parm1 = $parm1."salesinvoice_vat|NO|Vat|90|Yes|Vat|InputText,10,20^";
$parm1 = $parm1."salesinvoice_gross|Yes|Gross|90|Yes|Gross|InputText,10,20^";
$parm1 = $parm1."salesinvoice_jobid|NO|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."salesinvoice_fincategoryid|NO|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|65|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|65|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_PETTYCASH_Output() {
$parm0 = "Petty Cash Transactions|cashtxn|supplier,customer,vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory[fieldvalue=fincategory_pettycashitem:Yes]|cashtxn_id|cashtxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."cashtxn_id|Yes|Id|55|Yes|Id|KeyGenerated,CB[00000]^";
$parm1 = $parm1."cashtxn_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."cashtxn_type|No|Type|90|No|Type|InputFixed,Cash^";
$parm1 = $parm1."cashtxn_debit|Yes|Debit|50|Yes|Debit|InputText,10,20^";
$parm1 = $parm1."cashtxn_credit|Yes|Credit|50|Yes|Credit|InputText,10,20^";
$parm1 = $parm1."cashtxn_vatrateid|Yes|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."cashtxn_currency|No|Currency|90|No|Currency|InputFixed,GBP^";
$parm1 = $parm1."cashtxn_exchangerate|No|Exchange Rate|90|No|Exchange Rate|InputFixed,1.00^";
$parm1 = $parm1."cashtxn_purpose|No|Purpose|90|Yes|Purpose|InputSelectFromList,Purchase+Receipt^";
$parm1 = $parm1."cashtxn_description|Yes|Description|90|Yes|Description|InputText,25,50^";
$parm1 = $parm1."cashtxn_fincategoryid|No|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."cashtxn_vat|No|Vat|90|Yes|Vat|InputTextCalc,10,20,cashtxn_debit,vat,cashtxn_vatrateid,cashtxn_date^";
$parm1 = $parm1."cashtxn_supplierid|No|Supplier Id|90|Yes|Supplier Id|InputSelectFromTable,supplier,supplier_id,supplier_name,supplier_name^";
$parm1 = $parm1."cashtxn_paymenttype|No|Payment Type|90|Yes|Payment Type|InputSelectFromList,Account+Transaction^";
$parm1 = $parm1."cashtxn_customerid|No|Customer Id|90|Yes|Customer Id|InputSelectFromTable,customer,customer_id,customer_name,customer_name^";
$parm1 = $parm1."cashtxn_jobid|No|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."cashtxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."cashtxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."cashtxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_TRAVELLOG_Output() {
$parm0 = "Travel Transactions[Enter all cash transactions. Credit card transactions may also be recorded if you wish to create a complete log.]|traveltxn|vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory[fieldvalue=fincategory_purpose:Travel]|traveltxn_id|travetxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."traveltxn_id|Yes|Id|55|Yes|Id|KeyGenerated,TT[00000]^";
$parm1 = $parm1."traveltxn_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."traveltxn_type|No|Type|60|No|Type|InputFixed,Cash^";
$parm1 = $parm1."traveltxn_debit|Yes|Debit|50|Yes|Debit|InputText,10,20^";
$parm1 = $parm1."traveltxn_credit|Yes|Credit|50|Yes|Credit|InputText,10,20^";
$parm1 = $parm1."traveltxn_type|Yes|Type|50|Yes|Type|InputSelectFromList,Cash+Bank^";
$parm1 = $parm1."traveltxn_vatrateid|No|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."traveltxn_purpose|Yes|Purpose|60|Yes|Purpose|InputSelectFromList,Air Fare+Taxi+Train+Bus+Meals+Hotel+Conference+Other^";
$parm1 = $parm1."traveltxn_description|Yes|Description|100|Yes|Description|InputText,25,50^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."traveltxn_currency|No|Currency|90|No|Currency|InputFixed,GBP^";
$parm1 = $parm1."traveltxn_exchangerate|No|Exchange Rate|90|No|Exchange Rate|InputFixed,1.00^";
$parm1 = $parm1."traveltxn_fincategoryid|No|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."traveltxn_vat|No|Vat|90|Yes|Vat|InputTextCalc,10,20,traveltxn_debit,vat,traveltxn_vatrateid,traveltxn_date^";
$parm1 = $parm1."traveltxn_jobid|Yes|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."traveltxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."traveltxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."traveltxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_PAYROLL_Output() {
$parm0 = "Payroll Transactions|payrolltxn|person|payrolltxn_id|payrolltxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."payrolltxn_id|Yes|Id|45|Yes|Id|KeyGenerated,P[00000]^";

$parm1 = $parm1."payrolltxn_personid|Yes|Person|40|Yes|Personal Id|InputSelectFromTable,person,person_id,person_id,person_sname^";
$parm1 = $parm1."payrolltxn_periodstart|Yes|Period Start|70|Yes|Date|InputDate^";
$parm1 = $parm1."payrolltxn_periodend|Yes|Period End|70|Yes|Date|InputDate^";
$parm1 = $parm1."payrolltxn_gross|Yes|Gross Pay|60|Yes|Gross Pay|InputText,10,20^";
$parm1 = $parm1."payrolltxn_incometax|No|Income Tax|90|Yes|Income Tax|InputText,10,20^";
$parm1 = $parm1."payrolltxn_employeesNIC|No|Employees NIC|90|Yes|Employees NIC|InputText,10,20^";
$parm1 = $parm1."payrolltxn_net|No|Net Pay|90|Yes|Net Pay|InputText,10,20^";
$parm1 = $parm1."payrolltxn_employersNIC|NO|Employers NIC|90|Yes|Employers NIC|InputText,10,20^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."payrolltxn_comment|Yes|Comment|90|Yes|Comment|InputText,50,80^";
$parm1 = $parm1."payrolltxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."payrolltxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."payrolltxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPHOMEOFFICE_Output() {
$parm0 = "Home Office Parameters|homeoffice||homeoffice_id|homeoffice_id|25|No";
$parm1 = "";
$parm1 = $parm1."homeoffice_id|Yes|Id|60|Yes|Id|KeyText,20,40^";
$parm1 = $parm1."homeoffice_description|Yes|Description|100|Yes|Description|InputText,40,60^";
$parm1 = $parm1."homeoffice_roomstotal|Yes|Total Rooms|60|Yes|Total Rooms in Home|InputText,5,8^";
$parm1 = $parm1."homeoffice_roomsused|Yes|Rooms Used|60|Yes|Rooms Used for Business|InputText,5,8^";
$parm1 = $parm1."homeoffice_percentage|Yes|Percentage|60|Yes|Percentage|InputTextCalc,5,8,homeoffice_roomsused,/%,homeoffice_roomstotal^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_HOMEOFFICE_Output() {
$parm0 = "Home Office Transactions|homeofficetxn|homeoffice|homeofficetxn_id|homeofficetxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."homeofficetxn_id|Yes|Id|60|Yes|Id|KeyGenerated,HO[00000]^";
$parm1 = $parm1."homeofficetxn_periodstart|Yes|Period Start|90|Yes|Period Start|InputDate^";
$parm1 = $parm1."homeofficetxn_periodend|Yes|Period End|90|Yes|Period End|InputDate^";
$parm1 = $parm1."homeofficetxn_insurancehome|No|Insurance - Home|90|Yes|Insurance - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_counciltaxhome|No|Council Tax - Home|90|Yes|Council Tax - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_mortgagehome|No|Mortgage - Home|90|Yes|Mortgage - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_renthome|No|Rent - Home|90|Yes|Rent - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_maintenancehome|No|Maintenance - Home|90|Yes|Maintenance - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_utilitieshome|No|Utilities - Home|90|Yes|Utilities - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_telephonehome|No|Telephone - Home|90|Yes|Telephone - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_broadbandhome|No|Broadband - Home|90|Yes|Broadband - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_waterhome|No|Water - Home|90|Yes|Water Home|InputText,5,8^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."homeofficetxn_comment|Yes|Comment|90|Yes|Comment|InputText,50,80^";
$parm1 = $parm1."homeofficetxn_insurancebus|No|Insurance - Business|90|Yes|Insurance - Business|InputTextCalc,5,8,homeofficetxn_insurancehome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_counciltaxbus|No|Council Tax - Business|90|Yes|Council Tax - Business|InputTextCalc,5,8,homeofficetxn_counciltaxhome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_mortgagebus|No|Mortgage - Business|90|Yes|Mortgage - Business|InputTextCalc,5,8,homeofficetxn_mortgagehome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_rentbus|No|Rent - Business|90|Yes|Rent - Business|InputTextCalc,5,8,homeofficetxn_renthome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_maintenancebus|No|Maintenance - Business|90|Yes|Maintenance  - Business|InputTextCalc,5,8,homeofficetxn_maintenancehome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_utilitiesbus|No|Utilities - Business|90|Yes|Utilities - Business|InputTextCalc,5,8,homeofficetxn_utilitieshome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_telephonebus|No|Telephone - Business|90|Yes|Telephone - Business|InputTextCalc,5,8,homeofficetxn_telephonehome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_broadbandbus|No|Broadband - Business|90|Yes|Broadband - Business|InputTextCalc,5,8,homeofficetxn_broadbandhome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_waterbus|No|Water - Business|90|Yes|Water - Business|InputTextCalc,5,8,homeofficetxn_waterhome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."homeofficetxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."homeofficetxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."homeofficetxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPCWPERSON_Output() {
$parm0 = "Person Payroll Status|person||person_id|person_id|25|No";
$parm1 = "";
$parm1 = $parm1."person_id|Yes|Id|60|Yes|Id|KeyText,20,40^";
$parm1 = $parm1."person_fname|Yes|First Name|100|Yes|First Name|InputText,40,60^";
$parm1 = $parm1."person_sname|Yes|Surname|100|Yes|Surname|InputText,40,60^";
$parm1 = $parm1."person_director|Yes|Director|100|Yes|Director|InputSelectFromList,Director+Staff^";
$parm1 = $parm1."person_labourtype|Yes|Labour Type|100|Yes|Labour Type|InputSelectFromList,Direct+Indirect^";
$parm1 = $parm1."person_irissubcode|Yes|IRIS Code|100|Yes|IRIS Code|InputSelectFromList,1+2+3+4+5+6^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}


function Fin_EXTRACTFORACCOUNTANT_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";
}

function Fin_EXTRACTFORACCOUNTANT_Output () {
XH3("Extract information download for Accountant");
XFORM("finextractforaccountant.php","extractforaccountant");
XINSTDHID();
XINHID("Trace","off");
XTABLE();
XTR();XTD();XINRADIO ("Target","IRIS","checked","Extract records for IRIS" );X_TD();X_TR();
XTR();XTD();XINRADIO ("Target","SAGE","","Extract records for SAGE" );X_TD();X_TR();
X_TABLE();
XBR();
XTABLE();
XTR();XTDTXT("Start Date for Extract");XTDINDATEYYYY_MM_DD ("StartDate","");X_TR(); 
XTR();XTDTXT("End Date for Extract");XTDINDATEYYYY_MM_DD ("EndDate","");X_TR();
X_TABLE();
XBR();XINRADIO ("Action","Trial","checked","Trial" );
XBR();XINRADIO ("Action","Submit","","Submit to Accountant" );
XBR();XINRADIO ("Action","UnSubmit","","Re-open records for continued processing - UnSubmit" );
XBR();XBR();XINCHECKBOX ("Trace","on","","Show Audit Trail");
XBR();XBR();XINSUBMIT("Prepare Information for Download");
X_FORM();
}


function Fin_VATREPORT_CSSJS () {
 # XPTXT("Fin_VATREPORT_CSSJS");
 $GLOBALS{'YUICSSOPTIONAL'} = "fonts,button,container,paginator,datatable,calendar";
 $GLOBALS{'YUIJSOPTIONAL'} = "yahoo-dom-event,logger,animation,element,dragdrop,button,container,paginator,datasource,datatable,calendar";
 $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,calendarpopup";
}

function Fin_VATREPORT_Output () {
 XH3("VAT Report");
 XFORM("finvatreport.php","vatreport");
 XINSTDHID();
 XINHID("Trace","off");
 XTABLE();
 XTR();XTDTXT("Start Date for reporting period");XTDINDATEYYYY_MM_DD ("StartDate","");X_TR();
 XTR();XTDTXT("End Date for reporting period");XTDINDATEYYYY_MM_DD ("EndDate","");X_TR();
 X_TABLE();
 XBR();XBR();XINCHECKBOX ("Trace","on","","Show Audit Trail");
 XBR();XBR();XINSUBMIT("Generate Report");
 X_FORM();
 XDIV("cal1Containerouter","yui-skin-sam");
 XDIV("cal1Container","");
 X_DIV("cal1Container");
 X_DIV("cal1Containerouter");
}

function Fin_SetDefaultFinancialCategories () {
XH4("Set Default Financial Categories");
$companya = Get_Array('company');
foreach ($companya as $company_name) { 
  XH5("Company Characteristics - $company_name");
  Get_Data('company',$company_name);
  XTABLE();
  XTR();XTDTXT('name');XTDTXT($GLOBALS{'company_name'});X_TR();
  XTR();XTDTXT('registrationnumber');XTDTXT($GLOBALS{'company_registrationnumber'});X_TR();
  XTR();XTDTXT('companytype');XTDTXT($GLOBALS{'company_companytype'});X_TR();
  XTR();XTDTXT('businesssector');XTDTXT($GLOBALS{'company_businesssectorlist'});X_TR();
  XTR();XTDTXT('finyearstart');XTDTXT($GLOBALS{'company_finyearstart'});X_TR();
  XTR();XTDTXT('processhorizon');XTDTXT($GLOBALS{'company_processhorizon'});X_TR();
  XTR();XTDTXT('vattreatment');XTDTXT($GLOBALS{'company_vattreatment'});X_TR();
  XTR();XTDTXT('vatregistrationdate');XTDTXT($GLOBALS{'company_vatregistrationdate'});X_TR();
  XTR();XTDTXT('vatregistrationnumber');XTDTXT($GLOBALS{'company_vatregistrationnumber'});X_TR();
  XTR();XTDTXT('vatregistrationstart');XTDTXT($GLOBALS{'company_vatregistrationstart'});X_TR();
  XTR();XTDTXT('vatperiod');XTDTXT($GLOBALS{'company_vatperiod'});X_TR();
  XTR();XTDTXT('hometreatment');XTDTXT($GLOBALS{'company_hometreatment'});X_TR();
  XTR();XTDTXT('cartreatment');XTDTXT($GLOBALS{'company_cartreatment'});X_TR();
  # XTR();XTDTXT('traveltreatment');XTDTXT($GLOBALS{'company_traveltreatment'});X_TR();
  XTR();XTDTXT('payrolltreatment');XTDTXT($GLOBALS{'company_payrolltreatment'});X_TR();
  XTR();XTDTXT('bankcurrentacounttreatment');XTDTXT($GLOBALS{'company_bankcurrentacounttreatment'});X_TR();
  XTR();XTDTXT('creditcardtreatment');XTDTXT($GLOBALS{'company_creditcardtreatment'});X_TR();
  XTR();XTDTXT('bankdepositaccounttreatment');XTDTXT($GLOBALS{'company_bankdepositaccounttreatment'});X_TR();
  XTR();XTDTXT('pettycashtreatment');XTDTXT($GLOBALS{'company_pettycashtreatment'});X_TR();
  XTR();XTDTXT('loantreatment');XTDTXT($GLOBALS{'company_loantreatment'});X_TR();
  X_TABLE();
  
  XH5("Set Defaults");
  $fincategorya = Get_Array('fincategory');   
  foreach ($fincategorya as $fincategory_id) {
   if (substr($fincategory_id,0,1) == "F") {     
    Get_Data('fincategory',$fincategory_id);  
    $firstcriteria = "0";
    $barray = explode(",",$GLOBALS{'company_businesssectorlist'});
    foreach ($barray as $businesssector) { 
     if (FoundInCommaList($businesssector,$GLOBALS{'fincategory_businesssectorlist'})) {$firstcriteria = "1";}
    }   
    $secondcriteria = "0";
    if ($GLOBALS{'fincategory_useunconditional'} != "") {
     $secondcriteria = "1"; 
     # print "<br>----- Use Unconditionally";   
    }       
    if (FoundInCommaList($GLOBALS{'company_companytype'},$GLOBALS{'fincategory_companytypelist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_vattreatment'},$GLOBALS{'fincategory_vattreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_hometreatment'},$GLOBALS{'fincategory_hometreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_cartreatment'},$GLOBALS{'fincategory_cartreatmentlist'})) {$secondcriteria = "1";}
    # if (FoundInCommaList($GLOBALS{'company_traveltreatment'},$GLOBALS{'fincategory_traveltreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_payrolltreatment'},$GLOBALS{'fincategory_payrolltreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_bankcurrentacounttreatment'},$GLOBALS{'fincategory_bankcurrentacounttreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_creditcardtreatment'},$GLOBALS{'fincategory_creditcardtreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_bankdepositaccounttreatment'},$GLOBALS{'fincategory_bankdepositaccounttreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_pettycashtreatment'},$GLOBALS{'fincategory_pettycashtreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_loantreatment'},$GLOBALS{'fincategory_loantreatmentlist'})) {$secondcriteria = "1";}
    if ($GLOBALS{'fincategory_subheader'} == "Yes") {$firstcriteria = "1"; $secondcriteria = "1";}
    if (($firstcriteria == "1")&&($secondcriteria == "1")) { 
     $GLOBALS{'fincategory_usedefaulted'} = "Yes"; 
     Write_Data('fincategory',$fincategory_id);
     print "<br>$fincategory_id - ".$GLOBALS{'fincategory_description'}." <b>Defaulted</b>\n";    
    } else {
     print "<br>$fincategory_id - ".$GLOBALS{'fincategory_description'}." Not Defaulted\n";    
    }
   }
  }
 } 
}

=======
<?php # finroutines.php

function Fin_SETUPCWDOMAIN_CSSJS () {
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines";
}

function Fin_SETUPCWDOMAIN_Output() {
XH2("Financial Setup Wizard");
XH5("Initial setup: Follow the steps in the following sequence to set up your company.");
XPTXT("A pop up window will appear for each step.");
XTABLE();
XTR();
XTDHTXT("Steps");XTDHTXT("");XTDHTXT("");XTDHTXT("Guidance");
X_TR();
XTR();
XTDTXT("Step 1");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCOMPANY");
XLINKTXTNEWPOPUP($link,"Setup Company","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPCOMPANY.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets the type of company (eg Sole Trader, Limited Comany etc.) and the type of Business (eg Professional Services, Manufacturing etc.). From this information the system selects the approproiate financial categories to be used. ");
X_TR();
XTR();
XTDTXT("Step 2");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPALLOCATION");
XLINKTXTNEWPOPUP($link,"Setup Allocation Rules","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPALLOCATION.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This determines how much control you wish to have when allocating transactions to financial categories.");
X_TR();
XTR();
XTDTXT("Step 3");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPBANK");
XLINKTXTNEWPOPUP($link,"Setup Bank Accounts","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPBANK.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up your Bank Accounts");
X_TR();
XTR();
XTDHTXT("Optional Steps");XTDHTXT("");XTDHTXT("");XTDHTXT("");
X_TR();
XTR();
XTDTXT("Step 4");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPSUPPLIER");
XLINKTXTNEWPOPUP($link,"Setup Suppliers","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPSUPPLIER.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up your regular Suppliers (optional - you can do this as you go if preferred.)");
X_TR();
XTR();
XTDTXT("Step 5");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCUSTOMER");
XLINKTXTNEWPOPUP($link,"Setup Customers","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPCUSTOMER.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up your regular Customers (optional - you can do this as you go if preferred.)");
X_TR();
XTR();
XTDTXT("Step 6");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPHOMEOFFICE");
XLINKTXTNEWPOPUP($link,"Setup Home Office parameters","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPHOMEOFFICE.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up the rules that are used to calculate your home office expenses.");
X_TD();
X_TR();
XTR();
XTDTXT("Step 7");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMILEAGEFAVOURITE");
XLINKTXTNEWPOPUP($link,"Setup Milerage Destinations","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPMILEAGEFAVOURITE.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This sets up your regular trip destinations (optional - you can do this as you go if preferred.)");
X_TR();
XTR();
XTDTXT("Step 8");
XTD();
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCWPERSON");
XLINKTXTNEWPOPUP($link,"Setup Payroll Employees","newsetupwindow","center","center","900","900");XBR();
X_TD();XTD();
$imageurl = $GLOBALS{'site_asseturl'}."/SETUPCWPERSON.png";
XLINKIMGNEWPOPUP ($link,$imageurl,"100","100","0","newsetupwindow","center","center","900","900");
X_TD();
XTDTXT("This defines the people that will feature in your accounts (e.g payroll employees)");
X_TR();
X_TABLE();
}

function Fin_UPDATECWREFERENCEDATA_Output () {
 XH3("Implement the latest Financial Reference Data");
 XPTXT("This action ensure you have the latest VAT rates, Fuel rates etc.");
 XBR();
 XFORM("finupdatecwreferencedata.php","");
 XTDINSUBMIT("Go");
 XINSTDHID();
 X_FORM();
}

function Fin_SETUPCOMPANY_Output() {
$parm0 = "Company|company||company_name|company_name|25|No";
$parm1 = "";
$parm1 = $parm1."company_name|Yes|Name|80|Yes|Name|KeyText,40,60^";
$list = "ST[Sole Trader]+P[Partnership]+LTD[Limited Company]+LLP[LLP]"; 
$parm1 = $parm1."company_companytype|Yes|Company Type|120|Yes|Company Type|InputRadioFromList,".$list."^";			
$list = "PS[Professional Services]+CONSUL[Consultant]+CONSTR[Construction]+RETAIL[Retail]+RESELL[Reseller]+MFG[Manufacturing]"; 
$parm1 = $parm1."company_businesssectorlist|Yes|Business|180|Yes|Business Sector|InputCheckboxFromList,".$list."^";
$parm1 = $parm1."company_registrationnumber|No|||Yes|Company Registration Number |InputText,40,60^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."company_finyearstart|No|||Yes|Financial Year Start|InputDate^";
$parm1 = $parm1."company_processhorizon|No|||Yes|Process Horizon|InputSelectFromList,3months+6months+12months+24months^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."company_hometreatment|No|||Yes|Home Treatment|InputRadioFromList,FEXP[Fully Expensed basis]+FRATE[Flat Rate Basis]^";
$parm1 = $parm1."company_cartreatment|No|||Yes|Car Treatment|InputRadioFromList,FEXP[Fully Expensed Basis]+MILE[Mileage Basis]^";		
$list = "UKO[UK Travel Only]+FTO[Foreign Travel Only]+All[Both Types of Travel]"; 
$parm1 = $parm1."company_traveltreatment|No|||Yes|Travel Treatment|InputRadioFromList,".$list."^";			
$list = "None[None]+DO[Director Only]+SO[Staff Only]+All[Director and Staff]"; 
$parm1 = $parm1."company_payrolltreatment|Yes|Payroll|55|Yes|Payroll Treatment|InputRadioFromList,".$list."^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."company_bankcurrentacounttreatment|No|Curr|25|Yes|Bank Charges/Interest|InputRadioFromList,Yes+No^";
$parm1 = $parm1."company_creditcardtreatment|No|Credit|25|Yes|Credit Card|InputRadioFromList,Yes+No^";
$parm1 = $parm1."company_bankdepositaccounttreatment|No|Dep|250|Yes|Deposit Account|InputRadioFromList,Yes+No^";
$parm1 = $parm1."company_pettycashtreatment|No|Cash|25|Yes|Petty Cash|InputRadioFromList,Yes+No^";
$parm1 = $parm1."company_loantreatment|No|Loan|25|Yes|Loan or Mortgage|InputRadioFromList,Yes+No^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
$parm2 = "Finish and update default financial categories|finsetdefaultfincategories.php|";
GenericHandler_Output ($parm0,$parm1,$parm2);
}

function Fin_SETUPCOMPANYVATSTATUS_Output() {
$parm0 = "Company VAT Status|companyvatstatus|vatflatrate|companyvatstatus_dateeffective|companyvatstatus_dateeffective|No|No";
$parm1 = "";
$parm1 = $parm1."companyvatstatus_dateeffective|Yes|Date Effective|130|Yes|Status Date Effective|KeyDate^";
$parm1 = $parm1."companyvatstatus_vatregistrationnumber|No|||Yes|VAT Registration Number (if VATable)|InputText,40,60^";	
$list = "None[No Vat]+FRI[Flat Rate VAT - Invoice Accounting]+FRC[Flat Rate VAT - Cash Accounting]+NI[Normal VAT - Invoice Accounting]+NC[Normal VAT - Cash Accounting]";
$parm1 = $parm1."companyvatstatus_vattreatment|Yes|VAT|120|Yes|VAT Treatment|InputRadioFromList,".$list."^";
$parm1 = $parm1."companyvatstatus_vatperiod|No|||Yes|VAT Period (if VATable)|InputRadioFromList,1months+3months+12months^";
$parm1 = $parm1."companyvatstatus_vatflatrateid|No|||Yes|VAT Flat Rate (if VATable)|InputRadioFromTable,vatflatrate,vatflatrate_id,vatflatrate_description,vatflatrate_id^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
$parm2 = "Finish and update default financial categories|finsetdefaultfincategories.php|";
GenericHandler_Output ($parm0,$parm1,$parm2);
}


function Fin_SETUPALLOCATION_Output() {
 $parm0 = "Allocation Rules|company||company_name|company_name|No|No";
 $parm1 = "";
 $parm1 = $parm1."company_name|Yes|Id|80|Yes|Id|KeyText,40,60^";
 $parm1 = $parm1."company_enablefullfavouritesallocate|Yes|Enable Favourites|110|Yes|Enable Favourites|InputRadioFromList,Yes+No^";
 $parm1 = $parm1."||||Yes||Divider^"; 
 $parm1 = $parm1."company_showsupplierallocate|No|Supplier|60|Yes|Show Supplier|InputRadioFromList,Yes+No^";
 $parm1 = $parm1."company_showcustomerallocate|No|Customer|70|Yes|Show Customer|InputRadioFromList,Yes+No^";
 $parm1 = $parm1."company_showpaymenttypeallocate|No|Payment Type|80|Yes|Show Payment Type|InputRadioFromList,Yes+No^"; 
 $parm1 = $parm1."company_showvatallocate|No|VAT|50|Yes|Show VAT|InputRadioFromList,Yes+No^"; 
 $parm1 = $parm1."company_showfincategoryallocate|No|FinCategory|70|Yes|Show Financial Category|InputRadioFromList,Yes+No^"; 
 $parm1 = $parm1."company_showjoballocate|No|Job|50|Yes|Show Job|InputRadioFromList,Yes+No^";
 $parm1 = $parm1."company_showcommentallocate|No|Comment|70|Yes|Show Comment|InputRadioFromList,Yes+No^"; 
 $parm1 = $parm1."||||Yes||Divider^";
 $parm1 = $parm1."company_matchminallocate|Yes|Min Match|70|Yes|Minimum Characters Matched|InputSelectFromList,5+6+7+8+9+10+15+20+25^"; 
 $parm1 = $parm1."company_nomatchmaxallocate|Yes|Max UnMatch|80|Yes|Maximum Characters UnMatched|InputSelectFromList,1+2+3+4+5+6+7+8^";
 $parm1 = $parm1."company_filteroutallocatelist|No|Filter|80|Yes|Filter out controls.<br>e.g. SPLIT[,][0]+SPLIT[,][2]</br>|InputText,50,200^";
 
# SPLIT[,][0]+SPLIT[,][2]
 
 $parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
 $parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";     
 GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPBANK_Output() {
$parm0 = "Bank Account|bank|bankupload|bank_id|bank_name|25|No";
$parm1 = "";
$parm1 = $parm1."bank_id|Yes|Id|70|Yes|Bank Id|KeyText,8,8^";
$parm1 = $parm1."bank_name|Yes|Name|150|Yes|Bank Name|InputText,25,40^";
$parm1 = $parm1."bank_type|Yes|Type|70|Yes|Bank Type|InputSelectFromList,current+deposit+other^";
$parm1 = $parm1."bank_sort|Yes|Sort|70|Yes|Bank Sort Code|InputText,6,6^";
$parm1 = $parm1."bank_account|Yes|Account|70|Yes|Bank Account Code|InputText,8,8^";
$parm1 = $parm1."bank_bankuploadid|No|Upload Format|90|Yes|Upload Format|InputSelectFromTable,bankupload,bankupload_id,bankupload_name,bankupload_id^";
$parm1 = $parm1."bank_openingbalancedate|No||90|Yes|Opening Balance Date|InputDate^";
$parm1 = $parm1."bank_openingbalance|No||90|Yes|Opening Balance|InputText,10,15^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_BANKRECONCILIATION_Output() {
$parm0 = "Bank Account|bank|bankupload|bank_id|bank_name|25|No";
$parm1 = "";
$parm1 = $parm1."bank_id|Yes|Id|70|Yes|Bank Id|KeyText,8,8^";
$parm1 = $parm1."bank_name|Yes|Name|150|Yes|Bank Name|InputText,25,40^";
$parm1 = $parm1."bank_type|Yes|Type|70|Yes|Bank Type|InputSelectFromList,current+deposit+other^";
$parm1 = $parm1."bank_sort|Yes|Sort|70|Yes|Bank Sort Code|InputText,6,6^";
$parm1 = $parm1."bank_account|Yes|Account|70|Yes|Bank Account Code|InputText,8,8^";
$parm1 = $parm1."bank_bankuploadid|No|Upload Format|90|Yes|Upload Format|InputSelectFromTable,bankupload,bankupload_id,bankupload_name,bankupload_id^";
$parm1 = $parm1."bank_openingbalancedate|Yes|Opening Balance Date|90|Yes|Opening Balance Date|InputDate^";
$parm1 = $parm1."bank_openingbalance|Yes|Opening Balance|90|Yes|Opening Balance|InputText,10,15^";
$parm1 = $parm1."generic_programbutton|Yes|Reconcile|100|No|Reconcile|ProgramButton,bankreconciliationout.php,bank_id,bank_id,newpopup,800,600^";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPBANKUPLOADFORMAT_Output() {
$parm0 = "Bank Upload Format|bankupload||bankupload_id|bankupload_name|25|No";
$parm1 = "";
$parm1 = $parm1."bankupload_id|Yes|Id|70|Yes|Bank Id|KeyText,8,8^";
$parm1 = $parm1."bankupload_name|Yes|Name|150|Yes|Bank Name|InputText,25,40^";
$parm1 = $parm1."bankupload_filetype|Yes|Type|60|Yes|File Type|InputSelectFromList,csv+qif+ofx^";
$parm1 = $parm1."||||Yes|CSV Columns (only required for csv file types)|Divider^";
$parm1 = $parm1."bankupload_header|Yes|Header|90|Yes|Header Record|InputSelectFromList,Yes+No^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_sortoffset|No|SortCode|90|Yes|SortCode Column|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_sortfilter|No|Col A|90|Yes|Col A Format|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_accountoffset|No|AccountCode|90|Yes|AccountCode|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_accountfilter|No|Col A|90|Yes|Col A Format|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_dateoffset|No|Date|90|Yes|Date|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_dateformat|No|Date|90|Yes|Date|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_txntypeoffset|No|Type|90|Yes|Type|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_descriptionoffset|No|Description|90|Yes|Description|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_debitoffset|No|Debit|90|Yes|Debit|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_debitfilter|No|Debit|90|Yes|Debit|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_creditoffset|No|Credit|90|Yes|Credit|InputSelectFromList,".$formatlist."^";

$formatlist = "Sort+Account+Sort_Account+DD.MM.YY+DD.MM.YYYY+DD.Mon.YY+MM.DD.YY+Txn Type+Description+Debit+Credit+Debit/Credit+Balance+Not Used";
$parm1 = $parm1."bankupload_creditfilter|No|Credit|90|Yes|Credit|InputSelectFromList,".$formatlist."^";

$formatlist = "0[ColA]+1[ColB]+2[ColC]+3[ColD]+4[ColE]+5[ColF]+6[ColG]+7[ColH]+8[ColI]";
$parm1 = $parm1."bankupload_balanceoffset|No|Balance|90|Yes|Balance|InputSelectFromList,".$formatlist."^";

$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_BANKUPLOADFORMATWIZARD_CSSJS () {
 $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bankuploadformat";
 $GLOBALS{'SITEPOPUPHTML'} = "Fin_Bankupload_Popup,Fin_BewBankupload_Popup,Fin_UpdateBankupload_Popup,Fin_DeleteBankupload_Popup"; 
}

function Fin_BANKUPLOADFORMATWIZARD_Output () {	
 # XINSTDHID();
 XH3("Bank File - CSV Format Wizard");
 XPTXT("This wizard allows you to select a csv file of bank transactions and to then train the system how to extract the necessary financial information.");
 XH5("Step 1 of 3. Upload a csv Bank File that you would like to train.");
 XFORMUPLOAD ("javascriptcsvfileprovider.php", "fileuploadform");
 XINSTDHID();
 XINFILEID("filebrowse_button","FileUploadName","1000000");XTXT(" ==> ");XINBUTTONID("fileupload_button","Upload File");
 X_FORM();
 XDIV("ViewInput","");
 XBR();XTXTID("bankupload_filename","Select a record to convert");
 XDIV("testinputtableouter","");
 XDIV("testinputtable","");
 X_DIV("testinputtable");
 X_DIV("testinputtableouter");
 X_DIV("ViewInput");

 XDIV("Output",""); 	
 XH5("Step 2 of 3. Train the system how to read this csv Bank File.");
 XDIV("Format","");
 XINBUTTONID("TryExisting","Try one of the existing csv formats.");XBR();XBR();
 X_DIV("Format");
 XINCHECKBOXID ("bankuploadheader","bankuploadheader","","","Input file contains header row");
 XTABLEFIXEDID("InputTable","990"); 
 XTR();XTDHTXTFIXED("Input",",90");XTDHTXTFIXED("A",",80");XTDHTXTFIXED("B",",80");XTDHTXTFIXED("C",",80");XTDHTXTFIXED("D",",80");
 XTDHTXTFIXED("E",",80");XTDHTXTFIXED("F",",80");XTDHTXTFIXED("G",",80");XTDHTXTFIXED("H",",80");XTDHTXTFIXED("I","80");X_TR(); 
 $thash = List2Hash("Sort,Account,Sort_Account,DD.MM.YY,DD.MM.YYYY,DD.Mon.YY,MM.DD.YY,Txn Type,Description,Debit,Credit,Debit/Credit,Balance,Not Used");
 XTR();XTDHTXTID("bankuploadid","New Format");
 XTHINSELECTHASH($thash,"Format0","");XTHINSELECTHASH($thash,"Format1","");XTHINSELECTHASH($thash,"Format2","");XTHINSELECTHASH($thash,"Format3","");
 XTHINSELECTHASH($thash,"Format4","");XTHINSELECTHASH($thash,"Format5","");XTHINSELECTHASH($thash,"Format6","");XTHINSELECTHASH($thash,"Format7","");XTHINSELECTHASH($thash,"Format8","");X_TR();
 XTR();XTDTXT("Input");XTD();XTXTID("InCol0","");X_TD();XTD();XTXTID("InCol1","");X_TD();XTD();XTXTID("InCol2","");X_TD();XTD();XTXTID("InCol3","");X_TD();XTD();XTXTID("InCol4","");X_TD();
 XTD();XTXTID("InCol5","");X_TD();XTD();XTXTID("InCol6","");X_TD();XTD();XTXTID("InCol7","");X_TD();XTD();XTXTID("InCol8","");X_TD();X_TR();
 XTR();XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");X_TR();
 X_TABLE(); 
 XBR();XTXT("This Bank File record has been interpreted as follows:"); XBR();
 XTABLEID("OutputTable"); 
 XTR();XTDHTXT("Output");XTDHTXT("Sort");XTDHTXT("Account");XTDHTXT("Date");XTDHTXT("TxnType");XTDHTXT("Description");XTDHTXT("Debit");XTDHTXT("Credit");XTDHTXT("Balance");XTDHTXT("");X_TR();
 XTR();XTDHTXT("Format");XTDHTXT("123456");XTDHTXT("12345678");XTDHTXT("2015-02-31");XTDHTXT("Text");XTDHTXT("Text");XTDHTXT("123.45");XTDHTXT("123.45");XTDHTXT("123.45");XTDHTXT("");X_TR();
 XTR();XTDTXT("Output");XTD();XTXTID("OutCol0","");X_TD();XTD();XTXTID("OutCol1","");X_TD();XTD();XTXTID("OutCol2","");X_TD();XTD();XTXTID("OutCol3","");X_TD();XTD();XTXTID("OutCol4","");X_TD();
 XTD();XTXTID("OutCol5","");X_TD();XTD();XTXTID("OutCol6","");X_TD();XTD();XTXTID("OutCol7","");X_TD();XTD();XTXTID("OutResult","");X_TD();X_TR();
 XTR();XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");X_TR();
 X_TABLE();
 X_DIV("Output"); 
 XDIV("Save",""); 
 XH5("Step 3 of 3. Save the result");
 XINBUTTONID("bankuploadupdate_button","Update existing format");
 XINBUTTONID("bankuploadnew_button","Save as a new format");
 XINBUTTONID("bankuploadcancel_button","Cancel");
 X_DIV("Save");
 
 XH5("Update Log");
 XDIV("updateLog","");
 XTXT("No updates have been made in this session so far");
 X_DIV("updateLog");
}

function Fin_Bankupload_Popup() {
 XDIVPOPUP("bankuploadDialog","Existing Bank Formats");
 XDIV("bankuploadtableouter","");
 XDIV("bankuploadtable","");
 X_DIV("bankuploadtable");
 X_DIV("bankuploadtableouter");
 XINBUTTONIDCLASS("bankuploadDialogSave","bankuploadDialogSave","Save");
 XINBUTTONIDCLASS("bankuploadDialogClose","bankuploadDialogClose","Close");
 XBR();
 X_DIV("bankuploadDialog");
}
function Fin_NewBankupload_Popup() { 
 XDIVPOPUP("newBankuploadDialog","Create New Bank Upload Format");
 XTABLE();
 XTR();XTDTXT("New Format Id");XTDINTXTID("nbankuploadidinput","nbankuploadidinput","","8","8");X_TR();
 XTR();XTDTXT("New Format Description");XTDINTXTID("nbankuploadnameinput","nbankuploadnameinput","","20","50");X_TR();
 X_TABLE();
 XINBUTTONIDCLASS("newBankuploadDialogSave","newBankuploadDialogSave","Save");
 XINBUTTONIDCLASS("newBankuploadDialogClose","newBankuploadDialogClose","Close");
 XBR();
 X_DIV("newBankuploadDialog");
}
function Fin_UpdateBankupload_Popup() { 
 XDIVPOPUP("updateBankuploadDialog","Update Bank Upload Format");
 XBR();XTXTID("bankuploadupdate_warning","Please confirm that you wish to update this Format?");
 X_DIV("updateBankuploadDialog");
}
function Fin_DeleteBankupload_Popup() { 
 XDIVPOPUP("deleteBankuploadDialog","Delete Bank Upload Format");
 XBR();XTXTID("bankuploaddelete_warning","Are you sure you want to delete this Format?");
 X_DIV("deleteBankuploadDialog"); 
}

function Fin_SETUPVATPERIOD_Output() {
$parm0 = "VAT Period Update|vatperiod||vatperiod_id|vatperiod_id|No|No";
$parm1 = "";
$parm1 = $parm1."vatperiod_id|Yes|Id|90|Yes|Vat Rate Id|KeyText,8,8^";
$parm1 = $parm1."vatperiod_description|Yes|Description|150|Yes|Description|InputText,25,40^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPVATRATE_Output() {
$parm0 = "Vat Rate Update|vatrate[mergedkey=vatrate_id+vatrate_dateeffective]||vatrate_id+vatrate_dateeffective|vatrate_id+vatrate_dateeffective|No|No";
$parm1 = "";
$parm1 = $parm1."vatrate_id|Yes|Id|130|Yes|Vat Rate Id|KeyText,8,8^";
$parm1 = $parm1."vatrate_dateeffective|Yes|Date Effective|130|Yes|Vat Rate Date Effective|KeyDate^";
$parm1 = $parm1."vatrate_description|Yes|Description|150|Yes|Description|InputText,25,40^";
$parm1 = $parm1."vatrate_rate|Yes|Rate|90|Yes|Rate|InputText,5,5^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPVATFLATRATE_Output() {
$parm0 = "Vat Flat Rate Update|vatflatrate[mergedkey=vatflatrate_id+vatflatrate_dateeffective]||vatflatrate_id+vatflatrate_dateeffective|vatflatrate_id+vatflatrate_dateeffective|No|No";
$parm1 = "";
$parm1 = $parm1."vatflatrate_id|Yes|Id|130|Yes|Vat Flat Rate Id|KeyText,8,8^";
$parm1 = $parm1."vatflatrate_dateeffective|Yes|Date Effective|130|Yes|Vat Flat Rate Date Effective|KeyDate^";
$parm1 = $parm1."vatflatrate_description|Yes|Description|150|Yes|Description|InputText,25,40^";
$parm1 = $parm1."vatflatrate_rate|Yes|Rate|90|Yes|Rate|InputText,5,5^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPFINCATEGORY_Output() {
$parm0 = "Financial Category Update|fincategory||fincategory_id|fincategory_id|25|No";
$parm1 = "";
$parm1 = $parm1."fincategory_id|Yes|Id|25|Yes|Fin Category Id|KeyText,8,8^";
$parm1 = $parm1."fincategory_subheader|Yes|Subheader|50|Yes|Sub Header Description|InputRadioFromList,Yes+No^";
$parm1 = $parm1."fincategory_description|Yes|Description|100|Yes|Description|InputText,25,40^";
$parm1 = $parm1."fincategory_sageid|Yes|Sage|50|Yes|Sage Code|InputText,4,6^";
$parm1 = $parm1."fincategory_irisid|Yes|IRIS|55|Yes|IRIS Code|InputText,4,6^";
$list = "Bank+Purchase+Travel+Customer Receipt+Payroll+HMRC+Dividend or Loan"; 
$parm1 = $parm1."fincategory_purpose|No|||Yes|Transaction Type|InputRadioFromList,".$list."^";
$parm1 = $parm1."fincategory_pettycashitem|No|Petty Caash|50|Yes|Petty Cash Item|InputRadioFromList,Yes+No^";
$parm1 = $parm1."||||Yes|Used in following situations|Divider^";
$list = "PS[Professional Services]+CONSUL[Consultant]+CONSTR[Construction]+RETAIL[Retail]+RESELL[Reseller]+MFG[Manufacturing]"; 
$parm1 = $parm1."fincategory_businesssectorlist|No|Business|60|Yes|Business Sector|InputCheckboxFromList,".$list."^";
$parm1 = $parm1."||||Yes|... as well as ....|Divider^";
$parm1 = $parm1."fincategory_useunconditional|Yes|Use Always|50|Yes|Use Always|InputRadioFromList,Yes+No^";
$parm1 = $parm1."||||Yes||Divider^";
$list = "ST[Sole Trader]+P[Partnership]+LTD[Limited Company]+LLP[LLP]"; 
$parm1 = $parm1."fincategory_companytypelist|No|Company|60|Yes|Company Type|InputCheckboxFromList,".$list."^";			
$list = "None[No Vat]+FRI[Flat Rate VAT - Invoice Accounting]+FRC[Flat Rate VAT - Cash Accounting]+NI[Normal VAT - Invoice Accounting]+NC[Normal VAT - Cash Accounting]"; 
$parm1 = $parm1."fincategory_vattreatmentlist|No|VAT|55|Yes|VAT Treatment|InputCheckboxFromList,".$list."^";
$parm1 = $parm1."fincategory_hometreatmentlist|No|Home|55|Yes|Home Treatment|InputCheckboxFromList,FEXP[Fully Expensed basis]+FRATE[Flat Rate Basis]^";
$parm1 = $parm1."fincategory_cartreatmentlist|No|Car|55|Yes|Car Treatment|InputCheckboxFromList,FEXP[Fully Expensed Basis]+MILE[Mileage Basis]^";	
$list = "None[None]+DO[Director Only]+SO[Staff Only]+All[Director and Staff]"; 
$parm1 = $parm1."fincategory_payrolltreatmentlist|No|Payroll|55|Yes|Payroll Treatment|InputCheckboxFromList,".$list."^";
$parm1 = $parm1."fincategory_bankcurrentacounttreatmentlist|No|Curr|25|Yes|Bank Charges-Interest|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."fincategory_creditcardtreatmentlist|No|Credit|25|Yes|Credit Card|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."fincategory_bankdepositaccounttreatmentlist|No|Dep|250|Yes|Deposit Account|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."fincategory_pettycashtreatmentlist|No|Cash|25|Yes|Petty Cash|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."fincategory_loantreatmentlist|No|Loan|25|Yes|Loan or Mortgage|InputCheckboxFromList,Yes+No^";
$parm1 = $parm1."||||Yes|Resulting Selection|Divider^";
$parm1 = $parm1."fincategory_usedefaulted|Yes|Defaulted|50|Yes|Defaulted|KeyText,8,8^";
$parm1 = $parm1."fincategory_useselected|Yes|Selected|50|Yes|Custom Selection|InputRadioFromList,Yes+No^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETDEFAULTFINCATEGORIES_Output () {
XH3("Set the Default Financial Categories");
XPTXT("This action will set up the required financial categories for the company.");
XBR();
XFORM("finsetdefaultfincategories.php","");
XTDINSUBMIT("Go");
XINSTDHID();
X_FORM();
}

function Fin_IMPORTFINCATEGORY_Output () {
XH3("Financial Categories Import");
XPTXT("Please select file containing financial category information to upload.");
# $helplink = "SalesMaster/Setup_ADVERTISER_Output/setup_advertiser_output.html"; Help_Link;
XFORMUPLOAD("finimportfincategoriesin.php","finimportfincategoriesin");
XINSTDHID();
XINFILE("FinCategoryFile","100000");
XBR();
XINSUBMIT("Upload");
}

function Fin_CONVERTFINCATEGORY_Output () {
XH3("Convert Financial Categories");
XBR();
XFORM("finconvertfincategories.php","");
XTDINSUBMIT("Go");
XINSTDHID();
X_FORM();
}

function Fin_SETUPSUPPLIER_Output() {
$parm0 = "Supplier Update|supplier||supplier_id|supplier_name|25|No";
$parm1 = "";
$parm1 = $parm1."supplier_id|Yes|Id|90|Yes|Supplier Id|KeyText,8,8^";
$parm1 = $parm1."supplier_name|Yes|Name|180|Yes|Supplier Name|InputText,25,40^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 	
}

function Fin_SETUPCUSTOMER_Output() {
$parm0 = "Customer Update|customer||customer_id|customer_name|25|No";
$parm1 = "";
$parm1 = $parm1."customer_id|Yes|Id|90|Yes|Customer Id|KeyText,8,8^";
$parm1 = $parm1."customer_name|Yes|Name|180|Yes|Customer Name|InputText,25,40^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPJOB_Output() {
$parm0 = "Job Update|job|customer|job_id|job_id|25|No";
$parm1 = "";
$parm1 = $parm1."job_id|Yes|Id|90|Yes|Job Id|KeyText,8,8^";
$parm1 = $parm1."job_description|Yes|Description|180|Yes|Description|InputText,25,40^";
$parm1 = $parm1."job_customerid|Yes|Customer Id|90|Yes|Customer Id|InputSelectFromTable,customer,customer_id,customer_name,customer_name^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPTXNTEMPLATE_Output() {
$parm0 = "Transaction Templates |txntemplate||txntemplate_purpose|txntemplate_purpose|25|No";
$parm1 = "";
$parm1 = $parm1."txntemplate_purpose|Yes|Transaction Type|110|Yes|Transaction Type|KeyText,20,40^";
$parm1 = $parm1."txntemplate_comment|Yes|Comment|70|Yes|Comment|InputSelectFromList,Optional^";
$parm1 = $parm1."txntemplate_supplierid|Yes|Supplier|70|Yes|Supplier|InputSelectFromList,NA+Selected^";
$parm1 = $parm1."txntemplate_paymenttype|Yes|Payment Type|70|Yes|Payment Type|InputSelectFromList,NA+Selected^";
$parm1 = $parm1."txntemplate_vatrateid|Yes|VAT Rate|70|Yes|VAT Rate|InputSelectFromList,Defaulted+Selected^";
$parm1 = $parm1."txntemplate_fincategoryid|Yes|Fin Cat|70|Yes|Financial Category|InputSelectFromList,Defaulted+Selected^";
$parm1 = $parm1."txntemplate_customerid|Yes|Customer|70|Yes|Customer|InputSelectFromList,NA+Selected^";
$parm1 = $parm1."txntemplate_jobid|Yes|Job|70|Yes|Job Id|InputSelectFromList,NA+Optional^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPTXNFAVOURITE_Output() {
$parm0 = "Transaction Favoutites |txnfavourite|txntemplate,supplier,customer,vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory|txnfavourite_id|txnfavourite_id|25|No";
$parm1 = "";
$parm1 = $parm1."txnfavourite_id|Yes|Id|120|Yes|Id|KeyText,20,40^";
$parm1 = $parm1."txnfavourite_purpose|Yes|Type|70|Yes|Transaction type|InputSelectFromTable,txntemplate,txntemplate_purpose,txntemplate_purpose,txntemplate_purpose^";;
$parm1 = $parm1."txnfavourite_comment|No|Comment|70|Yes|Comment|InputText,40,60^";
$parm1 = $parm1."txnfavourite_supplierid|Yes|Supplier Id|70|Yes|Supplier Id|InputSelectFromTable,supplier,supplier_id,supplier_name,supplier_name^";
$parm1 = $parm1."txnfavourite_paymenttype|Yes|Payment Type|70|Yes|Payment Type|InputSelectFromList,Account+Transaction^";
$parm1 = $parm1."txnfavourite_vatrateid|Yes|Vatrate|70|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."txnfavourite_fincategoryid|Yes|Fin Category|70|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."txnfavourite_customerid|Yes|Customer Id|70|Yes|Customer Id|InputSelectFromTable,customer,customer_id,customer_name,customer_name^";
$parm1 = $parm1."txnfavourite_jobid|Yes|Job Id|70|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."txnfavourite_usedefaulted|Yes|Defaulted|50|Yes|Defaulted|InputRadioFromList,Yes+No^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_SETUPMILEAGEPARM_Output() {
$parm0 = "Mileage Parameter Update|mileageparm[mergedkey=mileageparm_unit+mileageparm_dateeffective]||mileageparm_unit+mileageparm_dateeffective|mileageparm_unit+mileageparm_dateeffective|No|No";
$parm1 = "";
$parm1 = $parm1."mileageparm_unit|Yes|Distance Unit|180|Yes|Distance Unit|KeyText,12,12^";
$parm1 = $parm1."mileageparm_dateeffective|Yes|Date Effective|180|Yes|Date Effective|KeyDate^";
$parm1 = $parm1."mileageparm_rate|Yes|Rate|100|Yes|Rate|InputText,5,8^";
$parm1 = $parm1."mileageparm_rateover10k|Yes|Rate over 10K|100|Yes|Rate over 10K|InputText,5,8^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPFUELPARM_Output() {
 $parm0 = "Fuel Parameter Update|fuelparm[mergedkey=fuelparm_enginetype+fuelparm_dateeffective]||fuelparm_enginetype+fuelparm_dateeffective|fuelparm_enginetype+fuelparm_dateeffective|25|No";
 $parm1 = "";
 $parm1 = $parm1."fuelparm_enginetype|Yes|Engine Type|300|Yes|Engine Type|KeyText,25,25^";
 $parm1 = $parm1."fuelparm_dateeffective|Yes|Date Effective|300|Yes|Date Effective|KeyDate^";
 $parm1 = $parm1."fuelparm_rate|Yes|Fuel Rate|100|Yes|Fuel Rate|InputText,5,8^";
 $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
 $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
 GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPMILEAGEFAVOURITE_Output() {
$parm0 = "Mileage Favoutite Destinations|mileagefavourite||mileagefavourite_id|mileagefavourite_destination|25|No";
$parm1 = "";
$parm1 = $parm1."mileagefavourite_id|Yes|Id|60|Yes|Id|KeyText,20,40^";
$parm1 = $parm1."mileagefavourite_destination|Yes|Destination|120|Yes|Destination|InputText,40,60^";
$parm1 = $parm1."mileagefavourite_distance|Yes|Distance|90|Yes|Distance|InputText,5,8^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_MILEAGE_Output() {
$parm0 = "Mileage Transactions|mileagetxn|mileagefavourite,person,fuelparm[mergedkey=fuelparm_enginetype+fuelparm_dateeffective]|mileagetxn_id|mileagetxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."mileagetxn_id|Yes|Id|50|Yes|Id|KeyGenerated,M[00000]^";
$parm1 = $parm1."mileagetxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."mileagetxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."mileagetxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."mileagetxn_personid|Yes|Person|40|Yes|Personal Id|InputSelectFromTable,person,person_id,person_id,person_sname^";
$parm1 = $parm1."mileagetxn_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."mileagetxn_favouriteid|No|Favourite|90|Yes|Favourite|InputSelectFromTableCustom,mileagefavourite,mileagefavourite_id,mileagefavourite_destination,mileagefavourite_destination,destination+distance^";
$parm1 = $parm1."mileagetxn_destination|Yes|Destination|120|Yes|Destination|InputText,40,60^";
$parm1 = $parm1."mileagetxn_distance|Yes|Distance|50|Yes|Distance|InputText,5,8^";
$parm1 = $parm1."mileagetxn_journeyqty|Yes|Qty|50|Yes|Journey Qty|InputText,5,8^";
$parm1 = $parm1."mileagetxn_comment|No|Comment|90|Yes|Comment|InputText,40,60^";
$parm1 = $parm1."mileagetxn_fuelparmenginetype|Yes|Engine Type|100|Yes|Engine Type|InputSelectFromTableDateEffective,fuelparm,fuelparm_enginetype,fuelparm_enginetype,fuelparm_enginetype,mileagetxn_date^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_FINASSET_Output() {
$parm0 = "Financial Assets|finasset|vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory|finasset_id|finasset_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."finasset_id|Yes|Id|50|Yes|Id|KeyGenerated,FA[00000]^";
$parm1 = $parm1."finasset_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."finasset_value|Yes|Value|70|Yes|Asset Value|InputText,10,20^";
$parm1 = $parm1."finasset_depreciationperiod|Yes|Depreciation Period|70|Yes|Depreciation Period|InputText,2,2^";
$parm1 = $parm1."finasset_description|Yes|Description|90|Yes|Description|InputText,25,50^";
$parm1 = $parm1."finasset_vatrateid|Yes|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."finasset_vat|No|Vat|90|Yes|Vat|InputTextCalc,10,20,cashtxn_debit,vat,cashtxn_vatrateid,cashtxn_date^";
$parm1 = $parm1."finasset_fincategoryid|No|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."finasset_jobid|No|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_DEPRECIATIONTXN_Output() {
$parm0 = "Depreciation Transactions|depreciationtxn|vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory,finasset|depreciationtxn_id|depreciationtxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."depreciationtxn_id|Yes|Id|50|Yes|Id|KeyGenerated,DP[00000]^";
$parm1 = $parm1."depreciationtxn_finassetid|Yes|Asset Id|50|Yes|Asset Id|InputSelectFromTable,finasset,finasset_id,finasset_description,finasset_id^";
$parm1 = $parm1."depreciationtxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."depreciationtxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."depreciationtxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."depreciationtxn_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."depreciationtxn_value|Yes|Depreciation Value|70|Yes|Depreciation Value|InputText,10,20^";
$parm1 = $parm1."depreciationtxn_description|Yes|Description|90|Yes|Description|InputText,25,50^";
$parm1 = $parm1."depreciationtxn_vatrateid|Yes|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."depreciationtxn_vat|No|Vat|90|Yes|Vat|InputTextCalc,10,20,cashtxn_debit,vat,cashtxn_vatrateid,cashtxn_date^";
$parm1 = $parm1."depreciationtxn_fincategoryid|No|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."depreciationtxn_jobid|No|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_MAINTAINBANKFILELIST_Output () {
XH3("Bank Transaction Upload");
# $helplink = "SalesMaster/Setup_ADVERTISERSLIST_Output/setup_advertiserslist_output.html"; Help_Link;
XH5("List of existing bank file uploads");
XTABLE();
$bankfilea = Get_Array('bankfile');
$formseq = 0;
$firstbankfile = "1";
foreach ($bankfilea as $bankfile_id) {
 Get_Data('bankfile',$bankfile_id);
 if ($firstbankfile == "1") {
  XTR();
  XTDHTXT("Bank File Id");
  XTDHTXT("Bank Id");
  XTDHTXT("BankFormat Id");  
  XTDHTXT("File");
  XTDHTXT("Comment");
  XTDHTXT("Date Start");
  XTDHTXT("Date End");
  XTDHTXT("Range Start");
  XTDHTXT("Range End");
  XTDHTXT("Status");
  XTDHTXT("");
  XTDHTXT("");
  X_TR();
  $firstbankfile = "0";  
 } 
 XTR();
 XTDTXT($GLOBALS{'bankfile_id'});
 XTDTXT($GLOBALS{'bankfile_bankid'});
 XTDTXT($GLOBALS{'bankfile_bankuploadid'}); 
 XTDTXT($GLOBALS{'bankfile_file'});
 XTDTXT($GLOBALS{'bankfile_comment'});   
 XTDTXT($GLOBALS{'bankfile_periodstart'}); 
 XTDTXT($GLOBALS{'bankfile_periodend'});
 XTDTXT($GLOBALS{'bankfile_banktxnidrangestart'});
 XTDTXT($GLOBALS{'bankfile_banktxnidrangeend'});    
 XTDTXT($GLOBALS{'bankfile_status'}); 
 $link = YPGMLINK("finbankfileuploadlistin.php").YPGMSTDPARMS();
 $link = $link.YPGMPARM("BankFileId",$bankfile_id).YPGMPARM("ACD","C");  
 XTDLINKTXT($link,"review");
 $link = YPGMLINK("finbankfileuploadlistin.php").YPGMSTDPARMS();
 $link = $link.YPGMPARM("BankFileId",$bankfile_id).YPGMPARM("ACD","D");     
 XTDLINKTXT($link,"delete");
 X_TR();
 $formseq++;
}
X_TABLE();
if ($firstbankfile == "1") {XPTXT("There are currently no Bank Files loaded.");}
XBR();XBR();
XFORM("finbankfileuploadlistin.php","bankuploadformatadd");
XINSTDHID();
XINHID("ACD","A");
XINHID("BankFileId","");
XINSUBMIT("Upload a new Bank File");
X_FORM();
}		

function Fin_MAINTAINBANKFILE_Output ($acd) {
XH3("Bank Transaction Maintenance - ".$GLOBALS{'bankfile_id'});
# $helplink = "SalesMaster/Setup_ADVERTISER_Output/setup_advertiser_output.html"; Help_Link;
XFORMUPLOAD("finbankfileuploadin.php","bankfileuploadin");
XINSTDHID();
XINHID("ACD",$acd);
XINHID("BankFileId",$GLOBALS{'bankfile_id'});
if ($acd == "A") {
 XTABLE();
 XTR();XTDHTXT("Bank File Information");XTDHTXT("");X_TR();
 XTR();XTDTXT("Bank File Id");XTDTXT($GLOBALS{'bankfile_id'});X_TR(); 
 $bankkeyarray = array(); $bankvaluearray = array();
 $banka = Get_Array('bank');
 foreach ($banka as $tbank_id) {
  Get_Data('bank',$tbank_id);
  array_push($bankkeyarray, $tbank_id);
  $bankvaluestring = $GLOBALS{'bank_name'};
  array_push($bankvaluearray, $bankvaluestring);
 }
 $bankselecthash = Arrays2Hash($bankkeyarray,$bankvaluearray);
 XTR();XTDTXT("Bank Account"); XTDINSELECTHASH($bankselecthash,"BankFileBankId","");X_TR(); 
 $bankuploadkeyarray = array(); $bankuploadvaluearray = array(); 
 $bankuploada = Get_Array('bankupload');
 foreach ($bankuploada as $tbankupload_id) {
  Get_Data('bankupload',$tbankupload_id);
  array_push($bankuploadkeyarray, $tbankupload_id); 
  $bankuploadvaluestring = $GLOBALS{'bankupload_name'};
  array_push($bankuploadvaluearray, $bankuploadvaluestring);
 }
 $bankuploadselecthash = Arrays2Hash($bankuploadkeyarray,$bankuploadvaluearray);
 XTR();XTDTXT("Bank Format"); XTDINSELECTHASH($bankuploadselecthash,"BankFileBankUploadId","");X_TR();
 XTR();XTDTXT("File Containing Data");XTDINFILE("BankFileFile","100000");X_TR();
 XTR();XTDTXT("Comment");XTDINTXT("BankFileComment",$GLOBALS{'bankfile_comment'},"25","25");X_TR();
 XTR();XTDTXT("");XTD();XINSUBMITNAME("Cancel","Cancel");XINSUBMITNAME("Update","Update");X_TD();X_TR();
 X_TABLE();
}
if ($acd == "C") {
 XTABLE();
 XTR();XTDHTXT("Bank File Information");XTDHTXT("");X_TR();
 XTR();XTDTXT("Bank File Id");XTDTXT($GLOBALS{'bankfile_id'});X_TR(); 
 Get_Data('bank',$GLOBALS{'bankfile_bankid'});
 XTR();XTDTXT("Bank Account");XTDTXT($GLOBALS{'bank_name'});X_TR();
 XTR();XTDTXT("File Containing Data");XTDTXT($GLOBALS{'bankfile_file'});X_TR();
 XTR();XTDTXT("File Upload Format");XTDTXT($GLOBALS{'bankfile_bankuploadid'});X_TR(); 
 XTR();XTDTXT("Comment");XTDINTXT("BankFileComment",$GLOBALS{'bankfile_comment'},"25","25");X_TR();
 XTR();XTDTXT("Date From");XTDTXT($GLOBALS{'bankfile_periodstart'});X_TR(); 
 XTR();XTDTXT("Date To");XTDTXT($GLOBALS{'bankfile_periodend'});X_TR(); 
 XTR();XTDTXT("Transaction Range From");XTDTXT($GLOBALS{'bankfile_banktxnidrangestart'});X_TR();
 XTR();XTDTXT("Transaction Range To");XTDTXT($GLOBALS{'bankfile_banktxnidrangeend'});X_TR();  
 XTR();XTDTXT("");XTD();XINSUBMITNAME("Cancel","Cancel");XINSUBMITNAME("Update","Update");X_TD();X_TR();
 X_TABLE();
}
if ($acd == "D") {
 XBR(); 
 XTXT("Do you really want to delete this file and remove all the uploaded bank transactions");
 XBR();XBR();
 XINSUBMITNAME("Delete","Confirm Delete");
 XINSUBMITNAME("Cancel","Cancel");
 XBR();XBR();
} 	
X_FORM();
}

function Fin_ALLOCATEBANK_Output1() {
XH3("Allocate bank records to accounts");
XFORM("finallocatebank1.php","allocate11");
XINSTDHID();
XINHID("RangeRaw","no");
XINCHECKBOX ("RangeRaw","raw","checked","select unallocated records");
XINHID("RangeAllocated","no");
XBR();XINCHECKBOX ("RangeAllocated","allocated","checked","review previously allocated records");
XINHID("RangeSubmitted","no");
XBR();XINCHECKBOX ("RangeSubmitted","submitted","","select records previously submitted to accountant");
XBR();XBR();
XINSUBMIT("Allocate!");
X_FORM();
}

function Fin_ALLOCATE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm,finallocate";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report,finallocate,slimjquerymin,slimimagepopup,bootstrapdatepicker,areyousure,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "Fin_Allocate_Popup,Fin_NewFavourite_Popup,Fin_NewSupplier_Popup,Fin_NewCustomer_Popup,Fin_NewJob_Popup,Fin_AllocationClone_Popup,Fin_Wizard_Popup";	
}

function Fin_ALLOCATE_Output($parm0,$parm1) {
# bankorcash, range

# ========= Main page ===================== 
XDIV("finallocatediv","");
$bankorcash = $parm0;
$range = $parm1;
$displayrange = str_replace("raw", "unallocated", $range);
if ($bankorcash == "Bank") { 
    XH3("Allocate bank records to accounts");
    XPTXT($displayrange);
}
else { 
    XH3("Allocate cash records to accounts");
    XPTXT($displayrange);
}
XINHID("BankorCash",$bankorcash);
XINHID("Range",$range);
XTABLE();XTR();XTD();
XTXT("Allocation Wizard ==>");
XINBUTTONID("wizpropose","Propose New Allocations based on history");
XINBUTTONID("wizconfirm","Confirm all Proposals");
XINBUTTONID("wizreject","Reject all Proposals");
X_TD();X_TR();X_TABLE();

XTABLEJQDTID("banktxntable");
XTHEAD();
XTRJQDT();
XTDHTXTFIXED("Id","85");
XTDHTXTFIXED("Date","80");
XTDHTXTFIXED("Type","50");
XTDHTXTFIXED("Description","290");
XTDHTXTFIXED("Debit","50");
XTDHTXTFIXED("Credit","50");
XTDHTXTFIXED("Allocate","50");
XTDHTXTFIXED("Me Too","40");
XTDHTXTFIXED("Status","170");        
X_TR();
X_THEAD();
XTBODY();
X_TBODY();
X_TABLE();	

XFORM("personreloginin.php","allocatemasterform");
XINSTDHID();

XINSUBMIT("Finish");
X_FORM();

XH5("Update Log");
XDIV("updateLog","");
XTXT("No updates have been made in this session so far");
X_DIV("updateLog");

XTXTID("TRACETEXT","");

X_DIV("finallocatediv");
}
# ========= End of Main page ================

# ========= Allocation dialogue popup box ================
function Fin_Allocate_Popup() {
XDIVPOPUP("allocationDialog","Transaction Allocation");
XTABLEINVISIBLE();
XTR();

# ----- left panel ------------
print '<td valign="top" width="45%" >'."\n";
XDIV("allocationinput","");
XH5ID("allocationinput_header","Transaction"); 
XTABLE();
XTREVEN();XTDTXT("Date");XTDTXT("Type");XTDTXT("Description");XTDTXT("Debit");XTDTXT("Credit");X_TR();
XTRODD();XTDTXTID("allocate_banktxn_date",".....");XTDTXTID("allocate_banktxn_txntype",".....");XTDTXTID("allocate_banktxn_description",".....");
XTDTXTID("allocate_banktxn_debit",".....");XTDTXTID("allocate_banktxn_credit",".....");X_TR();
X_TABLE();
X_DIV("allocationinput");

XDIV("allocation","");
XH4ID("allocate_header","Favourite Allocations");
XPTXT("Select one of the following transaction types.");
print '<table bgcolor="white"'."/n";
XTR();XTD();
XDIV("favouriteallocations","");
X_DIV("favouriteallocations");
X_TD();
X_TR();X_TABLE();
XBR();
X_DIV("allocation");
X_TD();

# ----- central gutter ------------
print '<td valign="top" width="10%" bgcolor="white" >'."\n";
X_TD();

# ----- right panel ------------
print '<td valign="top" width="45%" >'."\n";
XDIV("allocationresult","");
XH5ID("allocationresult_header","Allocation Result");
XH5ID("allocationresult_message","No Allocation made so far");
XFORM("finallocatein.php","allocateresultform");
XINSTDHID();
XINHID("idinput","idinput","XXXX");
XINHID("purposeinput","purposeinput","XXXX");
XTABLE();
$nullhash = array();
XTRID("purposerow");XTD();XTXT("transaction type:");X_TD();XTD();XTXTID("purposetext","");X_TD();X_TR();
XTRID("favouritenamerow");XTD();XTXT("favourite name:");X_TD();XTD();XTXTID("favouritenametext","");XINBUTTONID("newfavouritebutton","New");X_TD();X_TR();
XTRID("separator1row");XTH();XTXT("");X_TH();
print '<th align="right" valign="top"><small><small><a id="moreorlesstext">more detail...</a></small></small></th>'."\n";
X_TR();
XTRID("supplieridrow");XTD();XTXT("supplier:");X_TD();XTD();XINSELECTHASH ($nullhash,"supplieridinput","");XINBUTTONID("newsupplierbutton","New");X_TD();X_TR();
XTRID("paymenttyperow");XTD();XTXT("payment type:");X_TD();XTD();XINSELECTHASH ($nullhash,"paymenttypeinput","");X_TD();X_TR();
XTRID("vatrateidrow");XTD();XTXT("vat rate:");X_TD();XTD();XINSELECTHASH ($nullhash,"vatrateidinput","");X_TD();X_TR();
XTRID("vatrow");XTD();XTXT("vat:");X_TD();XTD();XTXT("calculated ");XTXTID("vatratepercenttext","");XTXT(" ==>");XINTXTID("vatinput","vatinput","","10","20");X_TD();X_TR();
XTRID("fincategoryidrow");XTD();XTXT("financial category:");X_TD();XTD();XINSELECTHASH ($nullhash,"fincategoryidinput","");X_TD();X_TR();
XTRID("customeridrow");XTD();XTXT("customer:");X_TD();XTD();XINSELECTHASH ($nullhash,"customeridinput","");XINBUTTONID("newcustomerbutton","New");X_TD();X_TR();
XTRID("separator2row");XTH();XTXT("");X_TH();XTH();XTXT("");X_TH();X_TR();
XTRID("jobidrow");XTD();XTXT("job:");X_TD();XTD();XINSELECTHASH ($nullhash,"jobidinput","");XINBUTTONID("newjobbutton","New");X_TD();X_TR();
XTRID("commentrow");XTD();XTXT("comment:");X_TD();XTD();XINTXTID("commentinput","commentinput","","20","50");XBR();
XINCHECKBOXID("addtobankdescription","addtobankdescription","Yes","","Add to Bank Description");X_TD();X_TR();
X_TABLE();
X_FORM();
X_DIV("allocationresult");
X_TD();

X_TR();X_TABLE();
XINBUTTONIDCLASS("allocationDialogSave","allocationDialogSave","Save");
XINBUTTONIDCLASS("allocationDialogClose","allocationDialogClose","Close");
XBR();
X_DIV("allocationDialog");
}
# ========= End of Allocation dialogue popup box ================

# ========= New Favourite popup box ================
function Fin_NewFavourite_Popup() {
XDIVPOPUP("newFavouriteDialog","Create New Favourite");
XTXTID("nffavouritepurposetext","");XBR();XBR();
XTABLE();
XTR();XTDTXT("New Favourite Name");XTDINTXTID("nffavouritenameinput","nffavouritenameinput","","20","50");X_TR();
X_TABLE();
XINBUTTONIDCLASS("newFavouriteDialogSave","newFavouriteDialogSave","Save");
XINBUTTONIDCLASS("newFavouriteDialogClose","newFavouriteDialogClose","Close");
XBR();
X_DIV("newFavouriteDialog");
}
# ========= New Supplier popup box ================
function Fin_NewSupplier_Popup() {
XDIVPOPUP("newSupplierDialog","Create New Supplier");
XTABLE();
XTR();XTDTXT("New Supplier Id");XTDINTXTID("nssupplieridinput","nssupplieridinput","","8","8");X_TR();
XTR();XTDTXT("New Supplier Name");XTDINTXTID("nssuppliernameinput","nssuppliernameinput","","20","50");X_TR();
X_TABLE();
XINBUTTONIDCLASS("newSupplierDialogSave","newSupplierDialogSave","Save");
XINBUTTONIDCLASS("newSupplierDialogClose","newSupplierDialogClose","Close");
XBR();
X_DIV("newSupplierDialog");
}
# ========= New Cstomer popup box ================
function Fin_NewCustomer_Popup() {
XDIVPOPUP("newCustomerDialog","Create New Customer");
XTABLE();;
XTR();XTDTXT("New Customer Id");XTDINTXTID("nccustomeridinput","nccustomeridinput","","8","8");X_TR();
XTR();XTDTXT("New Customer Name");XTDINTXTID("nccustomernameinput","nccustomernameinput","","20","50");X_TR();
X_TABLE();
XINBUTTONIDCLASS("newCustomerDialogSave","newCustomerDialogSave","Save");
XINBUTTONIDCLASS("newCustomerDialogClose","newCustomerDialogClose","Close");
XBR();
X_DIV("newCustomerDialog");
}
# ========= New Job popup box ================
function Fin_NewJob_Popup() {
XDIVPOPUP("newJobDialog","Create New Customer");
XTABLE();
$nullhash = array();
XTR();XTDTXT("New Job Id");XTDINTXTID("njjobidinput","njjobidinput","","8","8");X_TR();
XTR();XTDTXT("New Job Name");XTDINTXTID("njjobnameinput","njjobnameinput","","20","50");X_TR();
# XTR;XTDTXT("Customer Id");XTD();XINSELECTHASH ($nullhash,"nscustomeridinput","");X_TD();X_TR();
X_TABLE();
XINBUTTONIDCLASS("newJobDialogSave","newJobDialogSave","Save");
XINBUTTONIDCLASS("newJobDialogClose","newJobDialogClose","Close");
XBR();
X_DIV("newJobDialog");
}
# ========= AllocationClone popup box ================
function Fin_AllocationClone_Popup() {
XDIVPOPUP("allocationCloneDialog","Similar Allocations");
XTXTID("allocationclonetext","");XBR();XBR();
XTABLEJQDTID("allocationclonetable");
XTHEAD();
XTRJQDT();
XTDHTXTFIXED("Id","70");
XTDHTXTFIXED("Date","70");
XTDHTXTFIXED("Type","20");
XTDHTXTFIXED("Description","300");
XTDHTXTFIXED("Debit","50");
XTDHTXTFIXED("Credit","50");
X_TR();
X_THEAD();
XTBODY();
X_TBODY();
X_TABLE();	

XINBUTTONIDCLASS("allocationCloneDialogSave","allocationCloneDialogSave","Accept and Save");
XINBUTTONIDCLASS("allocationCloneDialogClose","allocationCloneDialogClose","Close");
XBR();
X_DIV("allocationCloneDialog");
}
# ========= Wizard popup box ================
function Fin_Wizard_Popup() {
XDIVPOPUP("wizardDialog","Allocation Wizard");
XH5ID("wizardopeningtext","");XBR();
XTABLEJQDTID("wizardresponsetable");
XTHEAD();
XTRJQDT();
XTDHTXTFIXED("Id","70");
XTDHTXTFIXED("Date","70");
XTDHTXTFIXED("Type","20");
XTDHTXTFIXED("Description","250");
XTDHTXTFIXED("Debit","50");
XTDHTXTFIXED("Credit","50");
XTDHTXTFIXED("Action","250");
X_TR();
X_THEAD();
XTBODY();
X_TBODY();
X_TABLE();	

XBR();XTXTID("wizardclosingtext","");
XINBUTTONIDCLASS("wizardDialogSave","wizardDialogSave","Apply Proposals");
XINBUTTONIDCLASS("wizardDialogClose","wizardDialogClose","Close");
XBR();
X_DIV("wizardDialog");
}

function Fin_PURCHASEINVOICE_Output() {
$parm0 = "Purchase Accounts|purchaseinvoice|supplier,job,vatrate[mergedkey=vatrate_id+vatrate_dateeffective],fincategory[fieldvalue=fincategory_purpose:Purchase]|purchaseinvoice_id|purchaseinvoice_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."purchaseinvoice_id|Yes|Id|55|Yes|Id|KeyGenerated,PI[00000]^";
$parm1 = $parm1."purchaseinvoice_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."purchaseinvoice_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."purchaseinvoice_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."purchaseinvoice_description|Yes|Description|90|Yes|Description|InputText,50,80^";
$parm1 = $parm1."purchaseinvoice_supplierid|Yes|Supplier Id|90|Yes|Supplier Id|InputSelectFromTable,supplier,supplier_id,supplier_name,supplier_name^";
$parm1 = $parm1."purchaseinvoice_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."purchaseinvoice_net|Yes|Net|60|Yes|Net|InputText,10,20^";
$parm1 = $parm1."purchaseinvoice_vatrateid|NO|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,purchaseinvoice_date^";
$parm1 = $parm1."purchaseinvoice_vat|NO|Vat|90|Yes|Vat|InputText,10,20^";
$parm1 = $parm1."purchaseinvoice_gross|No|Gross|90|Yes|Gross|InputText,10,20^";
$parm1 = $parm1."purchaseinvoice_jobid|No|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."purchaseinvoice_fincategoryid|NO|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|65|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|65|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SALESINVOICE_Output() {
$parm0 = "Sales Invoices|salesinvoice|customer,job,vatrate[mergedkey=vatrate_id+vatrate_dateeffective],fincategory[fieldvalue=fincategory_purpose:Customer Receipt]|salesinvoice_id|salesinvoice_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."salesinvoice_id|Yes|Id|50|Yes|Id|KeyGenerated,SI[00000]^";
$parm1 = $parm1."salesinvoice_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."salesinvoice_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."salesinvoice_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."salesinvoice_description|Yes|Description|90|Yes|Description|InputText,50,80^";
$parm1 = $parm1."salesinvoice_customerid|Yes|Customer Id|90|Yes|Customer Id|InputSelectFromTable,customer,customer_id,customer_name,customer_name^";
$parm1 = $parm1."salesinvoice_date|Yes|Date|80|Yes|Date|InputDate^";
$parm1 = $parm1."salesinvoice_net|No|Net|90|Yes|Net|InputText,10,20^";
$parm1 = $parm1."salesinvoice_vatrateid|NO|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,salesinvoice_date^";
$parm1 = $parm1."salesinvoice_vat|NO|Vat|90|Yes|Vat|InputText,10,20^";
$parm1 = $parm1."salesinvoice_gross|Yes|Gross|90|Yes|Gross|InputText,10,20^";
$parm1 = $parm1."salesinvoice_jobid|NO|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."salesinvoice_fincategoryid|NO|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|65|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|65|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_PETTYCASH_Output() {
$parm0 = "Petty Cash Transactions|cashtxn|supplier,customer,vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory[fieldvalue=fincategory_pettycashitem:Yes]|cashtxn_id|cashtxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."cashtxn_id|Yes|Id|55|Yes|Id|KeyGenerated,CB[00000]^";
$parm1 = $parm1."cashtxn_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."cashtxn_type|No|Type|90|No|Type|InputFixed,Cash^";
$parm1 = $parm1."cashtxn_debit|Yes|Debit|50|Yes|Debit|InputText,10,20^";
$parm1 = $parm1."cashtxn_credit|Yes|Credit|50|Yes|Credit|InputText,10,20^";
$parm1 = $parm1."cashtxn_vatrateid|Yes|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."cashtxn_currency|No|Currency|90|No|Currency|InputFixed,GBP^";
$parm1 = $parm1."cashtxn_exchangerate|No|Exchange Rate|90|No|Exchange Rate|InputFixed,1.00^";
$parm1 = $parm1."cashtxn_purpose|No|Purpose|90|Yes|Purpose|InputSelectFromList,Purchase+Receipt^";
$parm1 = $parm1."cashtxn_description|Yes|Description|90|Yes|Description|InputText,25,50^";
$parm1 = $parm1."cashtxn_fincategoryid|No|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."cashtxn_vat|No|Vat|90|Yes|Vat|InputTextCalc,10,20,cashtxn_debit,vat,cashtxn_vatrateid,cashtxn_date^";
$parm1 = $parm1."cashtxn_supplierid|No|Supplier Id|90|Yes|Supplier Id|InputSelectFromTable,supplier,supplier_id,supplier_name,supplier_name^";
$parm1 = $parm1."cashtxn_paymenttype|No|Payment Type|90|Yes|Payment Type|InputSelectFromList,Account+Transaction^";
$parm1 = $parm1."cashtxn_customerid|No|Customer Id|90|Yes|Customer Id|InputSelectFromTable,customer,customer_id,customer_name,customer_name^";
$parm1 = $parm1."cashtxn_jobid|No|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."cashtxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."cashtxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."cashtxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_TRAVELLOG_Output() {
$parm0 = "Travel Transactions[Enter all cash transactions. Credit card transactions may also be recorded if you wish to create a complete log.]|traveltxn|vatrate[mergedkey=vatrate_id+vatrate_dateeffective],job,fincategory[fieldvalue=fincategory_purpose:Travel]|traveltxn_id|travetxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."traveltxn_id|Yes|Id|55|Yes|Id|KeyGenerated,TT[00000]^";
$parm1 = $parm1."traveltxn_date|Yes|Date|70|Yes|Date|InputDate^";
$parm1 = $parm1."traveltxn_type|No|Type|60|No|Type|InputFixed,Cash^";
$parm1 = $parm1."traveltxn_debit|Yes|Debit|50|Yes|Debit|InputText,10,20^";
$parm1 = $parm1."traveltxn_credit|Yes|Credit|50|Yes|Credit|InputText,10,20^";
$parm1 = $parm1."traveltxn_type|Yes|Type|50|Yes|Type|InputSelectFromList,Cash+Bank^";
$parm1 = $parm1."traveltxn_vatrateid|No|Vatrate|90|Yes|Vatrate|InputSelectFromTableDateEffective,vatrate,vatrate_id,vatrate_description,vatrate_id,currentdate^";
$parm1 = $parm1."traveltxn_purpose|Yes|Purpose|60|Yes|Purpose|InputSelectFromList,Air Fare+Taxi+Train+Bus+Meals+Hotel+Conference+Other^";
$parm1 = $parm1."traveltxn_description|Yes|Description|100|Yes|Description|InputText,25,50^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."traveltxn_currency|No|Currency|90|No|Currency|InputFixed,GBP^";
$parm1 = $parm1."traveltxn_exchangerate|No|Exchange Rate|90|No|Exchange Rate|InputFixed,1.00^";
$parm1 = $parm1."traveltxn_fincategoryid|No|Fin Category|90|Yes|Fin Category|InputSelectFromTable,fincategory,fincategory_id,fincategory_description,fincategory_id^";
$parm1 = $parm1."traveltxn_vat|No|Vat|90|Yes|Vat|InputTextCalc,10,20,traveltxn_debit,vat,traveltxn_vatrateid,traveltxn_date^";
$parm1 = $parm1."traveltxn_jobid|Yes|Job Id|90|Yes|Job Id|InputSelectFromTable,job,job_id,job_description,job_description^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."traveltxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."traveltxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."traveltxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|60|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|60|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_PAYROLL_Output() {
$parm0 = "Payroll Transactions|payrolltxn|person|payrolltxn_id|payrolltxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."payrolltxn_id|Yes|Id|45|Yes|Id|KeyGenerated,P[00000]^";

$parm1 = $parm1."payrolltxn_personid|Yes|Person|40|Yes|Personal Id|InputSelectFromTable,person,person_id,person_id,person_sname^";
$parm1 = $parm1."payrolltxn_periodstart|Yes|Period Start|70|Yes|Date|InputDate^";
$parm1 = $parm1."payrolltxn_periodend|Yes|Period End|70|Yes|Date|InputDate^";
$parm1 = $parm1."payrolltxn_gross|Yes|Gross Pay|60|Yes|Gross Pay|InputText,10,20^";
$parm1 = $parm1."payrolltxn_incometax|No|Income Tax|90|Yes|Income Tax|InputText,10,20^";
$parm1 = $parm1."payrolltxn_employeesNIC|No|Employees NIC|90|Yes|Employees NIC|InputText,10,20^";
$parm1 = $parm1."payrolltxn_net|No|Net Pay|90|Yes|Net Pay|InputText,10,20^";
$parm1 = $parm1."payrolltxn_employersNIC|NO|Employers NIC|90|Yes|Employers NIC|InputText,10,20^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."payrolltxn_comment|Yes|Comment|90|Yes|Comment|InputText,50,80^";
$parm1 = $parm1."payrolltxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."payrolltxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."payrolltxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPHOMEOFFICE_Output() {
$parm0 = "Home Office Parameters|homeoffice||homeoffice_id|homeoffice_id|25|No";
$parm1 = "";
$parm1 = $parm1."homeoffice_id|Yes|Id|60|Yes|Id|KeyText,20,40^";
$parm1 = $parm1."homeoffice_description|Yes|Description|100|Yes|Description|InputText,40,60^";
$parm1 = $parm1."homeoffice_roomstotal|Yes|Total Rooms|60|Yes|Total Rooms in Home|InputText,5,8^";
$parm1 = $parm1."homeoffice_roomsused|Yes|Rooms Used|60|Yes|Rooms Used for Business|InputText,5,8^";
$parm1 = $parm1."homeoffice_percentage|Yes|Percentage|60|Yes|Percentage|InputTextCalc,5,8,homeoffice_roomsused,/%,homeoffice_roomstotal^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Fin_HOMEOFFICE_Output() {
$parm0 = "Home Office Transactions|homeofficetxn|homeoffice|homeofficetxn_id|homeofficetxn_id|25|Yes";
$parm1 = "";
$parm1 = $parm1."homeofficetxn_id|Yes|Id|60|Yes|Id|KeyGenerated,HO[00000]^";
$parm1 = $parm1."homeofficetxn_periodstart|Yes|Period Start|90|Yes|Period Start|InputDate^";
$parm1 = $parm1."homeofficetxn_periodend|Yes|Period End|90|Yes|Period End|InputDate^";
$parm1 = $parm1."homeofficetxn_insurancehome|No|Insurance - Home|90|Yes|Insurance - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_counciltaxhome|No|Council Tax - Home|90|Yes|Council Tax - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_mortgagehome|No|Mortgage - Home|90|Yes|Mortgage - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_renthome|No|Rent - Home|90|Yes|Rent - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_maintenancehome|No|Maintenance - Home|90|Yes|Maintenance - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_utilitieshome|No|Utilities - Home|90|Yes|Utilities - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_telephonehome|No|Telephone - Home|90|Yes|Telephone - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_broadbandhome|No|Broadband - Home|90|Yes|Broadband - Home|InputText,5,8^";
$parm1 = $parm1."homeofficetxn_waterhome|No|Water - Home|90|Yes|Water Home|InputText,5,8^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."homeofficetxn_comment|Yes|Comment|90|Yes|Comment|InputText,50,80^";
$parm1 = $parm1."homeofficetxn_insurancebus|No|Insurance - Business|90|Yes|Insurance - Business|InputTextCalc,5,8,homeofficetxn_insurancehome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_counciltaxbus|No|Council Tax - Business|90|Yes|Council Tax - Business|InputTextCalc,5,8,homeofficetxn_counciltaxhome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_mortgagebus|No|Mortgage - Business|90|Yes|Mortgage - Business|InputTextCalc,5,8,homeofficetxn_mortgagehome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_rentbus|No|Rent - Business|90|Yes|Rent - Business|InputTextCalc,5,8,homeofficetxn_renthome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_maintenancebus|No|Maintenance - Business|90|Yes|Maintenance  - Business|InputTextCalc,5,8,homeofficetxn_maintenancehome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_utilitiesbus|No|Utilities - Business|90|Yes|Utilities - Business|InputTextCalc,5,8,homeofficetxn_utilitieshome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_telephonebus|No|Telephone - Business|90|Yes|Telephone - Business|InputTextCalc,5,8,homeofficetxn_telephonehome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_broadbandbus|No|Broadband - Business|90|Yes|Broadband - Business|InputTextCalc,5,8,homeofficetxn_broadbandhome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."homeofficetxn_waterbus|No|Water - Business|90|Yes|Water - Business|InputTextCalc,5,8,homeofficetxn_waterhome,*%,homeoffice[Home]_percentage^";
$parm1 = $parm1."||||Yes||Divider^";
$parm1 = $parm1."homeofficetxn_processstatus|No|Process Status|100|Yes|Process Status|InputHidden,Open^";
$parm1 = $parm1."homeofficetxn_finstatus|No|Fin Status|100|Yes|Fin Status|InputHidden,Open^";
$parm1 = $parm1."homeofficetxn_vatstatus|No|VAT Status|100|Yes|VAT Status|InputFixed,Open^";
$parm1 = $parm1."generic_addcopybutton|Yes|AddCopy|70|No|AddCopy|AddCopyButton^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1);
}

function Fin_SETUPCWPERSON_Output() {
$parm0 = "Person Payroll Status|person||person_id|person_id|25|No";
$parm1 = "";
$parm1 = $parm1."person_id|Yes|Id|60|Yes|Id|KeyText,20,40^";
$parm1 = $parm1."person_fname|Yes|First Name|100|Yes|First Name|InputText,40,60^";
$parm1 = $parm1."person_sname|Yes|Surname|100|Yes|Surname|InputText,40,60^";
$parm1 = $parm1."person_director|Yes|Director|100|Yes|Director|InputSelectFromList,Director+Staff^";
$parm1 = $parm1."person_labourtype|Yes|Labour Type|100|Yes|Labour Type|InputSelectFromList,Direct+Indirect^";
$parm1 = $parm1."person_irissubcode|Yes|IRIS Code|100|Yes|IRIS Code|InputSelectFromList,1+2+3+4+5+6^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}


function Fin_EXTRACTFORACCOUNTANT_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";
}

function Fin_EXTRACTFORACCOUNTANT_Output () {
XH3("Extract information download for Accountant");
XFORM("finextractforaccountant.php","extractforaccountant");
XINSTDHID();
XINHID("Trace","off");
XTABLE();
XTR();XTD();XINRADIO ("Target","IRIS","checked","Extract records for IRIS" );X_TD();X_TR();
XTR();XTD();XINRADIO ("Target","SAGE","","Extract records for SAGE" );X_TD();X_TR();
X_TABLE();
XBR();
XTABLE();
XTR();XTDTXT("Start Date for Extract");XTDINDATEYYYY_MM_DD ("StartDate","");X_TR(); 
XTR();XTDTXT("End Date for Extract");XTDINDATEYYYY_MM_DD ("EndDate","");X_TR();
X_TABLE();
XBR();XINRADIO ("Action","Trial","checked","Trial" );
XBR();XINRADIO ("Action","Submit","","Submit to Accountant" );
XBR();XINRADIO ("Action","UnSubmit","","Re-open records for continued processing - UnSubmit" );
XBR();XBR();XINCHECKBOX ("Trace","on","","Show Audit Trail");
XBR();XBR();XINSUBMIT("Prepare Information for Download");
X_FORM();
}


function Fin_VATREPORT_CSSJS () {
 # XPTXT("Fin_VATREPORT_CSSJS");
 $GLOBALS{'YUICSSOPTIONAL'} = "fonts,button,container,paginator,datatable,calendar";
 $GLOBALS{'YUIJSOPTIONAL'} = "yahoo-dom-event,logger,animation,element,dragdrop,button,container,paginator,datasource,datatable,calendar";
 $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,calendarpopup";
}

function Fin_VATREPORT_Output () {
 XH3("VAT Report");
 XFORM("finvatreport.php","vatreport");
 XINSTDHID();
 XINHID("Trace","off");
 XTABLE();
 XTR();XTDTXT("Start Date for reporting period");XTDINDATEYYYY_MM_DD ("StartDate","");X_TR();
 XTR();XTDTXT("End Date for reporting period");XTDINDATEYYYY_MM_DD ("EndDate","");X_TR();
 X_TABLE();
 XBR();XBR();XINCHECKBOX ("Trace","on","","Show Audit Trail");
 XBR();XBR();XINSUBMIT("Generate Report");
 X_FORM();
 XDIV("cal1Containerouter","yui-skin-sam");
 XDIV("cal1Container","");
 X_DIV("cal1Container");
 X_DIV("cal1Containerouter");
}

function Fin_SetDefaultFinancialCategories () {
XH4("Set Default Financial Categories");
$companya = Get_Array('company');
foreach ($companya as $company_name) { 
  XH5("Company Characteristics - $company_name");
  Get_Data('company',$company_name);
  XTABLE();
  XTR();XTDTXT('name');XTDTXT($GLOBALS{'company_name'});X_TR();
  XTR();XTDTXT('registrationnumber');XTDTXT($GLOBALS{'company_registrationnumber'});X_TR();
  XTR();XTDTXT('companytype');XTDTXT($GLOBALS{'company_companytype'});X_TR();
  XTR();XTDTXT('businesssector');XTDTXT($GLOBALS{'company_businesssectorlist'});X_TR();
  XTR();XTDTXT('finyearstart');XTDTXT($GLOBALS{'company_finyearstart'});X_TR();
  XTR();XTDTXT('processhorizon');XTDTXT($GLOBALS{'company_processhorizon'});X_TR();
  XTR();XTDTXT('vattreatment');XTDTXT($GLOBALS{'company_vattreatment'});X_TR();
  XTR();XTDTXT('vatregistrationdate');XTDTXT($GLOBALS{'company_vatregistrationdate'});X_TR();
  XTR();XTDTXT('vatregistrationnumber');XTDTXT($GLOBALS{'company_vatregistrationnumber'});X_TR();
  XTR();XTDTXT('vatregistrationstart');XTDTXT($GLOBALS{'company_vatregistrationstart'});X_TR();
  XTR();XTDTXT('vatperiod');XTDTXT($GLOBALS{'company_vatperiod'});X_TR();
  XTR();XTDTXT('hometreatment');XTDTXT($GLOBALS{'company_hometreatment'});X_TR();
  XTR();XTDTXT('cartreatment');XTDTXT($GLOBALS{'company_cartreatment'});X_TR();
  # XTR();XTDTXT('traveltreatment');XTDTXT($GLOBALS{'company_traveltreatment'});X_TR();
  XTR();XTDTXT('payrolltreatment');XTDTXT($GLOBALS{'company_payrolltreatment'});X_TR();
  XTR();XTDTXT('bankcurrentacounttreatment');XTDTXT($GLOBALS{'company_bankcurrentacounttreatment'});X_TR();
  XTR();XTDTXT('creditcardtreatment');XTDTXT($GLOBALS{'company_creditcardtreatment'});X_TR();
  XTR();XTDTXT('bankdepositaccounttreatment');XTDTXT($GLOBALS{'company_bankdepositaccounttreatment'});X_TR();
  XTR();XTDTXT('pettycashtreatment');XTDTXT($GLOBALS{'company_pettycashtreatment'});X_TR();
  XTR();XTDTXT('loantreatment');XTDTXT($GLOBALS{'company_loantreatment'});X_TR();
  X_TABLE();
  
  XH5("Set Defaults");
  $fincategorya = Get_Array('fincategory');   
  foreach ($fincategorya as $fincategory_id) {
   if (substr($fincategory_id,0,1) == "F") {     
    Get_Data('fincategory',$fincategory_id);  
    $firstcriteria = "0";
    $barray = explode(",",$GLOBALS{'company_businesssectorlist'});
    foreach ($barray as $businesssector) { 
     if (FoundInCommaList($businesssector,$GLOBALS{'fincategory_businesssectorlist'})) {$firstcriteria = "1";}
    }   
    $secondcriteria = "0";
    if ($GLOBALS{'fincategory_useunconditional'} != "") {
     $secondcriteria = "1"; 
     # print "<br>----- Use Unconditionally";   
    }       
    if (FoundInCommaList($GLOBALS{'company_companytype'},$GLOBALS{'fincategory_companytypelist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_vattreatment'},$GLOBALS{'fincategory_vattreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_hometreatment'},$GLOBALS{'fincategory_hometreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_cartreatment'},$GLOBALS{'fincategory_cartreatmentlist'})) {$secondcriteria = "1";}
    # if (FoundInCommaList($GLOBALS{'company_traveltreatment'},$GLOBALS{'fincategory_traveltreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_payrolltreatment'},$GLOBALS{'fincategory_payrolltreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_bankcurrentacounttreatment'},$GLOBALS{'fincategory_bankcurrentacounttreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_creditcardtreatment'},$GLOBALS{'fincategory_creditcardtreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_bankdepositaccounttreatment'},$GLOBALS{'fincategory_bankdepositaccounttreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_pettycashtreatment'},$GLOBALS{'fincategory_pettycashtreatmentlist'})) {$secondcriteria = "1";}
    if (FoundInCommaList($GLOBALS{'company_loantreatment'},$GLOBALS{'fincategory_loantreatmentlist'})) {$secondcriteria = "1";}
    if ($GLOBALS{'fincategory_subheader'} == "Yes") {$firstcriteria = "1"; $secondcriteria = "1";}
    if (($firstcriteria == "1")&&($secondcriteria == "1")) { 
     $GLOBALS{'fincategory_usedefaulted'} = "Yes"; 
     Write_Data('fincategory',$fincategory_id);
     print "<br>$fincategory_id - ".$GLOBALS{'fincategory_description'}." <b>Defaulted</b>\n";    
    } else {
     print "<br>$fincategory_id - ".$GLOBALS{'fincategory_description'}." Not Defaulted\n";    
    }
   }
  }
 } 
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>