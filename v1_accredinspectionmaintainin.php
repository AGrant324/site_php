<<<<<<< HEAD
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   

Get_Common_Parameters();
GlobalRoutine();

$inaccredcriteria_schemeid = $_REQUEST['accredcriteria_schemeid'];
$inaccredcriteria_clubid = $_REQUEST['accredcriteria_clubid'];
$inaccredcriteria_id = $_REQUEST['accredcriteria_id'];
$inaccredcriteria_inspectionresult = $_REQUEST['accredcriteria_inspectionresult'];
$inaccredcriteria_inspectioncomments = $_REQUEST['accredcriteria_inspectioncomments'];
$inevidencedatalist = $_REQUEST['evidencedatalist']; // comma separated
$inevidencedataresultlist = $_REQUEST['evidencedataresultlist']; // pipe separated

Check_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$inaccredcriteria_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    $GLOBALS{'accredcriteria_inspectionresult'} = $inaccredcriteria_inspectionresult;
    $GLOBALS{'accredcriteria_inspectioncomments'} = $inaccredcriteria_inspectioncomments;
    Write_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$inaccredcriteria_id);
    
    $evidencedatalista = explode(",",$inevidencedatalist);
    $evidencedataresultlista = explode("|",$inevidencedataresultlist);
    
    $ri = 0;
    foreach ($evidencedatalista as $data_id) {
        Check_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$data_id);
        $GLOBALS{'accredcriteria_inspectiondatatextresult'} = "";
        if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Text" ) {
            $GLOBALS{'accredcriteria_inspectiondatatextresult'} = $evidencedataresultlista[$ri];
        }
        if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Radio" ) {
            $GLOBALS{'accredcriteria_inspectiondataradioresult'} = $evidencedataresultlista[$ri];
        }
        if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Checkbox" ) {
            $GLOBALS{'accredcriteria_inspectiondatacheckboxresult'} = $evidencedataresultlista[$ri];           
        }        
        $ri++;
        $GLOBALS{'accredcriteria_inspectiondatacondition'} = $evidencedataresultlista[$ri];  
        $ri++;
        Write_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$data_id);
    }
    print "0|Update Successful|".$inaccredcriteria_schemeid."|".$inaccredcriteria_clubid."|".$inaccredcriteria_id."|".$inaccredcriteria_inspectionresult."|".$inaccredcriteria_inspectioncomments;
} else {
    print "1|No Accreditation Record Found";
}



=======
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   

Get_Common_Parameters();
GlobalRoutine();

$inaccredcriteria_schemeid = $_REQUEST['accredcriteria_schemeid'];
$inaccredcriteria_clubid = $_REQUEST['accredcriteria_clubid'];
$inaccredcriteria_id = $_REQUEST['accredcriteria_id'];
$inaccredcriteria_inspectionresult = $_REQUEST['accredcriteria_inspectionresult'];
$inaccredcriteria_inspectioncomments = $_REQUEST['accredcriteria_inspectioncomments'];
$inaccredcriteria_inspectioncondition = $_REQUEST['accredcriteria_inspectioncondition'];
$inaccredcriteria_inspectionconditioncomments = $_REQUEST['accredcriteria_inspectionconditioncomments'];
$inevidencedatalist = $_REQUEST['evidencedatalist']; // comma separated
$inevidencedataresultlist = $_REQUEST['evidencedataresultlist']; // pipe separated

Check_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$inaccredcriteria_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    $GLOBALS{'accredcriteria_inspectionresult'} = $inaccredcriteria_inspectionresult;
    $GLOBALS{'accredcriteria_inspectioncomments'} = $inaccredcriteria_inspectioncomments;
    $GLOBALS{'accredcriteria_inspectioncondition'} = $inaccredcriteria_inspectioncondition;
    $GLOBALS{'accredcriteria_inspectionconditioncomments'} = $inaccredcriteria_inspectionconditioncomments;
    Write_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$inaccredcriteria_id);
    
    $evidencedatalista = explode(",",$inevidencedatalist);
    $evidencedataresultlista = explode("|",$inevidencedataresultlist);
    
    $ri = 0;
    foreach ($evidencedatalista as $data_id) {
        Check_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$data_id);
        $GLOBALS{'accredcriteria_inspectiondatatextresult'} = "";
        if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Text" ) {
            $GLOBALS{'accredcriteria_inspectiondatatextresult'} = $evidencedataresultlista[$ri];
        }
        if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Radio" ) {
            $GLOBALS{'accredcriteria_inspectiondataradioresult'} = $evidencedataresultlista[$ri];
        }
        if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Checkbox" ) {
            $GLOBALS{'accredcriteria_inspectiondatacheckboxresult'} = $evidencedataresultlista[$ri];           
        }        
        $ri++;
        $GLOBALS{'accredcriteria_inspectiondatacondition'} = $evidencedataresultlista[$ri];  
        $ri++;
        Write_Data("accredcriteria",$inaccredcriteria_schemeid,$inaccredcriteria_clubid,$data_id);
    }
    print "0|Update Successful|".$inaccredcriteria_schemeid."|".$inaccredcriteria_clubid."|".$inaccredcriteria_id."|".$inaccredcriteria_inspectionresult."|".$inaccredcriteria_inspectioncomments;
} else {
    print "1|No Accreditation Record Found";
}



>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
