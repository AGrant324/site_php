<<<<<<< HEAD
<?php # membershipoptionsout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PopUpHeader();
Check_Session_Validity();

XH3("Membership - ".$GLOBALS{'currperiodid'});
$tpersontypea = Get_Array_Hash('persontype',$GLOBALS{'currperiodid'});
XTABLE();
XTR();
XTDHTXT("Membership Type");
XTDHTXT("Annual Fee");
X_TR();
foreach ($tpersontypea as $tpersontype ) {
	Get_Data_Hash('persontype',$GLOBALS{'currperiodid'},$tpersontype);
	if ($GLOBALS{'persontype_selectable'} == "Yes") {
		XTR();
		XTDTXT($GLOBALS{'persontype_name'});
		XTDTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualoneofffee'});
		X_TR();
	}
}
X_TABLE();
XH4("It is also possible to pay the following membership types as a series of staged payments");
XTABLE();
XTR();
XTDHTXT("Membership Type");
XTDHTXT("Number of Payments");
XTDHTXT("Monthly Payments");
XTDHTXT("Total");
X_TR();
foreach ($tpersontypea as $tpersontype ) {
	Get_Data_Hash('persontype',$GLOBALS{'currperiodid'},$tpersontype);
	if (($GLOBALS{'persontype_selectable'} == "Yes")&&(intval($GLOBALS{'persontype_annualstagedfee'}) > 0)) {	
		XTR();
		XTDTXT($GLOBALS{'persontype_name'});
		XTDTXT(intval($GLOBALS{'persontype_annualstagedrecurringpayments'}));		
		XTDTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedrecurringfee'});
		XTDTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedfee'});
		X_TR();
		
	}

}
X_TABLE();

PopUpFooter ();

=======
<?php # membershipoptionsout.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PopUpHeader();
Check_Session_Validity();

XH3("Membership - ".$GLOBALS{'currperiodid'});
$tpersontypea = Get_Array_Hash('persontype',$GLOBALS{'currperiodid'});
XTABLE();
XTR();
XTDHTXT("Membership Type");
XTDHTXT("Annual Fee");
X_TR();
foreach ($tpersontypea as $tpersontype ) {
	Get_Data_Hash('persontype',$GLOBALS{'currperiodid'},$tpersontype);
	if ($GLOBALS{'persontype_selectable'} == "Yes") {
		XTR();
		XTDTXT($GLOBALS{'persontype_name'});
		XTDTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualoneofffee'});
		X_TR();
	}
}
X_TABLE();
XH4("It is also possible to pay the following membership types as a series of staged payments");
XTABLE();
XTR();
XTDHTXT("Membership Type");
XTDHTXT("Number of Payments");
XTDHTXT("Monthly Payments");
XTDHTXT("Total");
X_TR();
foreach ($tpersontypea as $tpersontype ) {
	Get_Data_Hash('persontype',$GLOBALS{'currperiodid'},$tpersontype);
	if (($GLOBALS{'persontype_selectable'} == "Yes")&&(intval($GLOBALS{'persontype_annualstagedfee'}) > 0)) {	
		XTR();
		XTDTXT($GLOBALS{'persontype_name'});
		XTDTXT(intval($GLOBALS{'persontype_annualstagedrecurringpayments'}));		
		XTDTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedrecurringfee'});
		XTDTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedfee'});
		X_TR();
		
	}

}
X_TABLE();

PopUpFooter ();

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
