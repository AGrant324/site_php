<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,jqdatatablesfixedcolumnsmin,report";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$setuppersonid = $_REQUEST["SetupPersonId"];
$setuppersonpsw = $_REQUEST["SetupPersonPsw"];

XH2("Client Setup");

$recsep = chr(135); // double cross
$fieldsep = chr(134); // dagger  
$testorreal = "R";
 
$post = array (
    // 'ServiceId' => $GLOBALS{'LOGIN_service_id'},
    'ServiceId' => "dmws",
    // 'DomainId' => $GLOBALS{'LOGIN_domain_id'},
    'DomainId' => "dmwsportal",
    'ModeId' => $GLOBALS{'LOGIN_mode_id'},
    'PersonId' => $GLOBALS{'LOGIN_person_id'},
    'SessionId' => $GLOBALS{'LOGIN_session_id'},
    'SetupPersonId' => $setuppersonid,
    'SetupPersonPsw' => $setuppersonpsw
);

$ch = curl_init($GLOBALS{'site_synchroniseurl'}."/site_php/v1_dmwsclientsetupprovider.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

/*
XH1("Raw Response");
print $response."\n"; 
// $responsea = explode($recsep,$response);
// foreach ($responsea as $responseelement) { print $responseelement."\n"; }
*/

XBR();
XH1("Setup Information Downloaded");

XPTXT("Your current cases and reference data have now been loaded onto the client machine.");
XPTXTCOLOR("<b>Now Logout and Re-Login with your Personal Id.</b>","green");


XDIV("reportdiv_download","container");
XTABLEJQDTID("reporttable_download");
XTHEAD();
XTRJQDT();
XTDTXT("Seq");
XTDTXT("Table");
XTDTXT("Key");
XTDTXT("Data");
XTDTXT("Action");
X_TR();
X_THEAD();
XTBODY();  

$downseq = 0;
$responsea = explode($recsep,$response);
foreach ($responsea as $responseelement) {
    if ( $responseelement != "" ) {
        $fielddataa = explode($fieldsep,$responseelement);
        $identifiera = explode("_",$fielddataa[0]);
        $thistable = $identifiera[0];
        $recordtype = $identifiera[1];
        
        if ( $recordtype == "downloadheader" ) {
            if ($GLOBALS{$thistable."^KEYS"} == "2") {            
                $tablek1ida = Get_Array($thistable);
                foreach ($tablek1ida as $table_k1id) {
                    if ($testorreal == "R") { 
                        if ($thistable != 'person') {
                            Delete_Data($thistable,$table_k1id);
                            // XPTXTCOLOR($thistable." ".$table_k1id." deleted","orange");
                        }
                    }
                }
            }
            if ($GLOBALS{$thistable."^KEYS"} == "3") {
                $tablek1ida = Get_Array($thistable);
                foreach ($tablek1ida as $table_k1id) {
                    $tablek2ida = Get_Array($thistable,$table_k1id);               
                    foreach ($tablek2ida as $table_k2id) {
                        if ($testorreal == "R") {
                            if ($thistable != 'person') {
                                Delete_Data($thistable,$table_k1id,$table_k2id); 
                                // XPTXTCOLOR($thistable." ".$table_k1id." ".$table_k2id." deleted","orange");
                            }
                        }                    
                    }
                }
            }
        }
        if ( $recordtype == "downloaddata" ) {
            $downseq++;
            Initialise_Data($thistable);
            
            $tstring = $GLOBALS{$thistable."^FIELDS"};
            $tfields = explode('|', $tstring);
            $fi = 0;
            foreach ($tfields as $tfieldelement) {
                $fi++;
                $GLOBALS{$tfieldelement} = $fielddataa[$fi];
            }       
            if ($GLOBALS{$thistable."^KEYS"} == "2") {
                if ($testorreal == "R") { Write_Data($thistable,$fielddataa[2]); }
                $key = $fielddataa[2];
                $writetext = $thistable." ".$fielddataa[2]." updated";
            }
            if ($GLOBALS{$thistable."^KEYS"} == "3") {
                if ($testorreal == "R") { Write_Data($thistable,$fielddataa[2],$fielddataa[3]); }
                $key = $fielddataa[2]."-".$fielddataa[3];
                $writetext = $thistable." ".$fielddataa[2]." ".$fielddataa[3]." updated";
            }
            XTRJQDT();
            XTDTXT($downseq);
            XTDTXT($identifiera[0]);
            XTDTXT($key);
            XTDTXT(mb_strimwidth(str_replace($fieldsep, '_', $responseelement), 0, 100, ""));
            XTDTXT($writetext);
            X_TR();
        }
    }
}    
    
X_TBODY();
X_TABLE();
X_DIV("reportdiv_download");
XCLEARFLOAT();

Back_Navigator();
PageFooter("Default","Final");


?>


