<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   

Get_Common_Parameters();
GlobalRoutine();

$inaccredcriteria_schemeid = $_REQUEST['accredcriteria_schemeid'];
$inaccredcriteria_clubid = $_REQUEST['accredcriteria_clubid'];
$inaccredcriteria_id = $_REQUEST['accredcriteria_id'];
$inaccredcriteria_inspectionimagelist = $_REQUEST['accredcriteria_inspectionimagelist'];
$inaccredupdate = $_REQUEST['AccredUpdate'];
$inevidenceseq = $_REQUEST['EvidenceSeq'];

// a_01       section
// a_01_09    criteria
// a_01_09_e01 evidence
// a_01_09_e01_i01 data
// a_01_09_01_e02 evidence
// a_01_09_01_e02_i01 data
$abits = explode("_",$inaccredcriteria_id); // evidence id
if ( count($abits) == 4 ) {
    $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2];
    $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
} else { // count = 5
    $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
    $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3]."_".$abits[4];
}
Check_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$inaccredcriteria_id);
if ($GLOBALS{'IOWARNING'} == "0") {

    if ($GLOBALS{'accredcriteria_inspectionimagelist'} == "") { $existingimagelista = Array(); }
    else { $existingimagelista = explode(',',$GLOBALS{'accredcriteria_inspectionimagelist'}); }
    
    $inputimagelista = Array(); 
    if ($inaccredcriteria_inspectionimagelist == "") { $inputimagelista = Array(); }
    else { $inputimagelista = explode(',',$inaccredcriteria_inspectionimagelist); }
    
    $newimagelista = Array();     
    foreach ( $inputimagelista as $inputimage) {
        if ($inputimage != "") {
            $newimage = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media","",$inputimage);
            array_push($newimagelista,$newimage);
        }
    };
    
    foreach ($existingimagelista as $existingimage) {
        if (in_array($existingimage, $newimagelista)) {} else {
            unset($existingimage);
        }
    }
    
    $GLOBALS{'accredcriteria_inspectionimagelist'} = Array2List($newimagelista);
    Write_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$inaccredcriteria_id);

    print "0|Update Successful|".$inaccredcriteria_schemeid."|".$inaccredcriteria_clubid."|".$inaccredcriteria_id."|".$GLOBALS{'accredcriteria_inspectionimagelist'};
} else {
    print "1|No Accreditation Record Found|".$inaccredcriteria_schemeid."|".$inaccredcriteria_clubid."|".$inaccredcriteria_id;
}




