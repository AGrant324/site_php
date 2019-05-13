<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Dmws_DMWSSULIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$indmwssu_id = $_REQUEST['dmwssu_id'];
$inlist = $_REQUEST['List'];
$inliststatus = $_REQUEST['ListStatus'];

Check_Data('dmwssu',$indmwssu_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    Check_Data('dmwssux',$indmwssu_id);
    if ($GLOBALS{'IOWARNING'} == "0") {
        $dmwssu_ida = Get_Array('dmwssu');
        $highestdmwssu_id = "SU00000";
        foreach ($dmwssu_ida as $tdmwssu_id) {
            if ( $tdmwssu_id > $highestdmwssu_id ) { $highestdmwssu_id = $tdmwssu_id; }
        }
        $highestdmwssu_seq = str_replace("SU", "", $highestdmwssu_id);
        $highestdmwssu_seq++;
        $newdmwssu_id = "SU".substr(("00000".$highestdmwssu_seq), -5);
        
        // Retain selected information
        
        // retain $GLOBALS{'dmwssux_nhsnumber'} = "";
        // retain $GLOBALS{'dmwssux_sname'} = "";
        // retain $GLOBALS{'dmwssux_fname'} = "";
        // retain $GLOBALS{'dmwssux_title'} = "";
        // retain $GLOBALS{'dmwssux_likedname'} = "";
        // retain $GLOBALS{'dmwssux_address'} = "";
        // retain $GLOBALS{'dmwssux_postcode'} = "";
        // retain $GLOBALS{'dmwssux_primetel'} = "";
        // retain $GLOBALS{'dmwssux_mobiletel'} = "";
        // retain $GLOBALS{'dmwssux_email'} = "";
        // retain $GLOBALS{'dmwssux_serviceno'} = "";
        $GLOBALS{'dmwssux_signature'} = "";
        
        $GLOBALS{'dmwssu_lockedtimestamp'} = "";
        $GLOBALS{'dmwssu_lockedpersonid'} = "";
        $GLOBALS{'dmwssu_lastupdatetimestamp'} = "";
        $GLOBALS{'dmwssu_lastupdatepersonid'} = "";
        $GLOBALS{'dmwssu_lastupdatetype'} = "";
        $GLOBALS{'dmwssu_clientupdatetimestamp'} = "";
        // retain $GLOBALS{'dmwssu_dmwscontractid'} = "";
        // retain $GLOBALS{'dmwssu_dmwscontractlocationid'} = "";
        // retain $GLOBALS{'dmwssu_dmwstitleid'} = "";
        // retain $GLOBALS{'dmwssu_likedname'} = "";
        // retain $GLOBALS{'dmwssu_gender'} = "";
        // retain $GLOBALS{'dmwssu_dob'} = "0000-00-00";
        // retain $GLOBALS{'dmwssu_age'} = "";
        // retain $GLOBALS{'dmwssu_county'} = "";
        // retain $GLOBALS{'dmwssu_postcodearea'} = "";
        // retain $GLOBALS{'dmwssu_marriagestatus'} = "";
        // retain $GLOBALS{'dmwssu_equalityforminterest'} = "";
        // retain $GLOBALS{'dmwssu_ethnicity'} = "";
        // retain $GLOBALS{'dmwssu_ethnicityalternative'} = "";
        // retain $GLOBALS{'dmwssu_disabilitylist'} = "";
        // retain $GLOBALS{'dmwssu_sexualorientation'} = "";
        // retain $GLOBALS{'dmwssu_sexualorientationalternative'} = "";
        // retain $GLOBALS{'dmwssu_religion'} = "";
        // retain $GLOBALS{'dmwssu_religionalternative'} = "";
        // retain $GLOBALS{'dmwssu_workingpattern'} = "";
        // retain $GLOBALS{'dmwssu_caringresponsibilitylist'} = "";
        // retain $GLOBALS{'dmwssu_modspecificlist'} = "";
        // retain $GLOBALS{'dmwssu_dementia'} = "";
        // retain $GLOBALS{'dmwssu_aggressive'} = "";
        // retain $GLOBALS{'dmwssu_safeguarding'} = "";
        // retain $GLOBALS{'dmwssu_dmwssafeguardingissuetypeid'} = "";
        // retain $GLOBALS{'dmwssu_mentalhealth'} = "";
        // retain $GLOBALS{'dmwssu_mentalcapacity'} = "";
        // retain $GLOBALS{'dmwssu_deceased'} = "";
        // retain $GLOBALS{'dmwssu_aggressivefamilymember'} = "";
        // retain $GLOBALS{'dmwssu_alcoholmisuse'} = "";
        // retain $GLOBALS{'dmwssu_druguser'} = "";
        // retain $GLOBALS{'dmwssu_inappropriateadvances'} = "";
        // retain $GLOBALS{'dmwssu_infectionconcern'} = "";
        // retain $GLOBALS{'dmwssu_dmwswosafeguardingissuelist'} = "";
        // retain $GLOBALS{'dmwssu_dmwssafeguardingissuelist'} = "";
        // retain $GLOBALS{'dmwssu_dmwscontractlocationtypeid'} = "";
        // retain $GLOBALS{'dmwssu_dmwssafeguardeetypeid'} = "";
        // retain $GLOBALS{'dmwssu_dmwssafeguardeereasontypeid'} = "";
        //=========== Service Details
        // retain $GLOBALS{'dmwssu_dmwsserviceid'} = "";
        // retain $GLOBALS{'dmwssu_servicerank'} = "";
        // retain $GLOBALS{'dmwssu_serviceunit'} = "";
        // retain $GLOBALS{'dmwssu_serviceregiment'} = "";
        // retain $GLOBALS{'dmwssu_dmwsuservicestatusid'} = "";
        // retain $GLOBALS{'dmwssu_servicestatusother'} = "";
        // retain $GLOBALS{'dmwssu_serviceworkplace'} = "";
        // retain $GLOBALS{'dmwssu_servicedischargedate'} = "0000-00-00";
        // retain $GLOBALS{'dmwssu_servicepolicenumber'} = "";
        // retain $GLOBALS{'dmwssu_servicemodoutofarea'} = "";
        // retain $GLOBALS{'dmwssu_dmwsoccupationalissuetypeid'} = "";
        // retain $GLOBALS{'dmwssu_dmwspreviousoccupationtypeid'} = "";
        // retain $GLOBALS{'dmwssu_dmwspreviousoccupationtypeother'} = "";
        //=========== Referral Details
        $GLOBALS{'dmwssu_referraldate'} = "0000-00-00";
        $GLOBALS{'dmwssu_referraltime'} = "";
        $GLOBALS{'dmwssu_dmwslocation'} = "";
        $GLOBALS{'dmwssu_referrername'} = "";
        $GLOBALS{'dmwssu_referrerorg'} = "";
        $GLOBALS{'dmwssu_referrertel'} = "";
        $GLOBALS{'dmwssu_referreremail'} = "";
        $GLOBALS{'dmwssu_referralrecdby'} = "";
        // retain $GLOBALS{'dmwssu_serviceunitsite'} = "";
        // retain $GLOBALS{'dmwssu_serviceunitcontact'} = "";
        // retain $GLOBALS{'dmwssu_serviceunitcontacttel'} = "";
        // retain $GLOBALS{'dmwssu_disabilitytypelist'} = "";
        // retain $GLOBALS{'dmwssu_caringresponsibilitytypelist'} = "";
        // retain $GLOBALS{'dmwssu_specialunitreferral'} = "";
        // retain $GLOBALS{'dmwssu_originatingcountry'} = "";
        //=========== Referral Agreements
        $GLOBALS{'dmwssu_consentsigned'} = "";
        $GLOBALS{'dmwssu_consentuploaded'} = "";
        //=========== Consent Form Agreements
        $GLOBALS{'dmwssu_signatureproxy'} = "";
        $GLOBALS{'dmwssu_signatureproxyname'} = "";
        $GLOBALS{'dmwssu_consentgiven'} = "";
        $GLOBALS{'dmwssu_consentdate'} = "";
        $GLOBALS{'dmwssu_readandunderstood'} = "";
        $GLOBALS{'dmwssu_personalinfostorage'} = "";
        $GLOBALS{'dmwssu_makingreferrals'} = "";
        $GLOBALS{'dmwssu_supportcommunicationlist'} = "";
        $GLOBALS{'dmwssu_eventscommunicationlist'} = "";
        $GLOBALS{'dmwssu_reportcommunicationlist'} = "";
        //=========== Support Type
        $GLOBALS{'dmwssu_dmwssupporttypeid'} = "";
        //=========== MedicalLocation and Admission Details
        $GLOBALS{'dmwssu_dmwslocationtypeid'} = "";
        $GLOBALS{'dmwssu_locationname'} = "";
        $GLOBALS{'dmwssu_locationsite'} = "";
        $GLOBALS{'dmwssu_locationcontact'} = "";
        $GLOBALS{'dmwssu_locationtel'} = "";
        $GLOBALS{'dmwssu_dmwsadmissionreasonid'} = "";
        $GLOBALS{'dmwssu_dmwsadmissiontypeid'} = "";
        $GLOBALS{'dmwssu_dmwsadmissiondate'} = "0000-00-00";
        //=========== Key Case Milestones
        $GLOBALS{'dmwssu_initialvisitdate'} = "0000-00-00";
        $GLOBALS{'dmwssu_initialvisittime'} = "";
        $GLOBALS{'dmwssu_dischargedate'} = "0000-00-00";
        $GLOBALS{'dmwssu_deathdate'} = "0000-00-00";
        $GLOBALS{'dmwssu_followupagreed'} = "";
        $GLOBALS{'dmwssu_surveyissued'} = "";
        $GLOBALS{'dmwssu_surveycompleted'} = "";
        $GLOBALS{'dmwssu_usecaseconsent'} = "";
        $GLOBALS{'dmwssu_usecaseanonymity'} = "";
        $GLOBALS{'dmwssu_casecloseddate'} = "0000-00-00";
        //=========== Key Case Measurements
        $GLOBALS{'dmwssu_initialcomplexityscore'} = 0;
        $GLOBALS{'dmwssu_finalcomplexityscore'} = 0;
        $GLOBALS{'dmwssu_initialprogressscore'} = 0;
        $GLOBALS{'dmwssu_finalprogressscore'} = 0;
        $GLOBALS{'dmwssu_initialwellbeingscore'} = 0;
        $GLOBALS{'dmwssu_finalwellbeingscore'} = 0;
        $GLOBALS{'dmwssu_familysupportedO18'} = 0;
        $GLOBALS{'dmwssu_familysupportedU18'} = 0;
        $GLOBALS{'dmwssu_staffsupported'} = 0;
        $GLOBALS{'dmwssu_firstclinicapptdate'} = "0000-00-00";
        $GLOBALS{'dmwssu_medicalstayduration'} = 0;
        $GLOBALS{'dmwssu_medicalapptsattended'} = 0;
        $GLOBALS{'dmwssu_medicalapptsmissed'} = 0;
        $GLOBALS{'dmwssu_timeoffworkexpected'} = 0;
        $GLOBALS{'dmwssu_timeoffworkactual'} = 0;
        $GLOBALS{'dmwssu_losexpected'} = 0;
        $GLOBALS{'dmwssu_losactual'} = 0;
        $GLOBALS{'dmwssu_primarycarelist'} = "";
        $GLOBALS{'dmwssu_primarycareother'} = "";
        $GLOBALS{'dmwssu_secondarycarelist'} = "";
        $GLOBALS{'dmwssu_secondarycareother'} = "";
        $GLOBALS{'dmwssu_independentlivinglist'} = "";
        $GLOBALS{'dmwssu_independentlivingother'} = "";
        $GLOBALS{'dmwssu_socialisolationlist'} = "";
        $GLOBALS{'dmwssu_socialisolationother'} = "";
        $GLOBALS{'dmwssu_employmentlist'} = "";
        $GLOBALS{'dmwssu_employmentother'} = "";
        $GLOBALS{'dmwssu_familywoemail'} = "";
        $GLOBALS{'dmwssu_unitaware'} = "";
        $GLOBALS{'dmwssu_unitwoname'} = "";
        $GLOBALS{'dmwssu_unitwotel'} = "";
        $GLOBALS{'dmwssu_unitwoemail'} = "";
        $GLOBALS{'dmwssu_notes'} = "";
        //=========== Contacts
        // retain $GLOBALS{'dmwssu_nokname'} = "";
        // retain $GLOBALS{'dmwssu_nokrelationship'} = "";
        // retain $GLOBALS{'dmwssu_nokcontacttel'} = "";
        // retain $GLOBALS{'dmwssu_nokcontactemail'} = "";
        // retain $GLOBALS{'dmwssu_emergencyname'} = "";
        // retain $GLOBALS{'dmwssu_emergencyrelationship'} = "";
        // retain $GLOBALS{'dmwssu_emergencycontacttel'} = "";
        // retain $GLOBALS{'dmwssu_emergencycontactemail'} = "";
        // retain $GLOBALS{'dmwssu_woname'} = "";
        // retain $GLOBALS{'dmwssu_familyaware'} = "";
        // retain $GLOBALS{'dmwssu_familywoname'} = "";
        // retain $GLOBALS{'dmwssu_familywotel'} = "";

        
        Write_Data('dmwssu',$newdmwssu_id);
        Write_Data('dmwssux',$newdmwssu_id);
        XPTXTCOLOR("New Case for ".$GLOBALS{'dmwssux_fname'}." ".$GLOBALS{'dmwssux_sname'}." created - ".$GLOBALS{'dmwssu_id'},"green");
    }
    if ($inlist == "DMWSSULIST") {
        // new case option only currently on closed case list
        $nextliststatus = "Open";
        if ($inliststatus == "Closed") { $nextliststatus = "Open"; }
        Dmws_DMWSSULIST_Output($nextliststatus);
    } else { // for further expansion
        
    }
} else {
    XPTXTCOLOR("Error: ".$indmwssu_id." Not Found");
}

Back_Navigator();
PageFooter("Default","Final");

?>


