<<<<<<< HEAD
<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_SHIRTNUMBERCHOOSER_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

XH2("Shirt Number Chooser");

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inperson_id = $_REQUEST["person_id"];
$infrsplayernumber_code = $_REQUEST["frsplayernumber_code"];
$inaction = $_REQUEST["action"];

Check_Data("person",$inperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    if ( $inaction == "Select") {       
        $GLOBALS{'frsplayernumber_allocationtype'} = "Player";
        $GLOBALS{'frsplayernumber_personid'} = $inperson_id;
        $GLOBALS{'frsplayernumber_teamcode'} = "";       
        Write_Data("frsplayernumber","Club",$infrsplayernumber_code);
        $GLOBALS{'person_shirtnumber'} = $infrsplayernumber_code; 
        Write_Data("person",$inperson_id);
        XPTXTCOLOR("Congratulations you have been allocated shirt number ".$infrsplayernumber_code,"green");
    }
    if ( $inaction == "DeSelect") {
        Delete_Data("frsplayernumber","Club",$infrsplayernumber_code);
        $GLOBALS{'person_shirtnumber'} = "";
        Write_Data("person",$inperson_id);
        XPTXTCOLOR("Shirt number ".$infrsplayernumber_code." has now been de-allocated","green");
    }
    
} else {
    XPTXTCOLOR("Invalid person id.","red");
}

Frs_SHIRTNUMBERCHOOSER_Output($inperson_id);

Back_Navigator();
PageFooter("Default","Final");

?>


=======
<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_SHIRTNUMBERCHOOSER_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

XH2("Shirt Number Chooser");

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inperson_id = $_REQUEST["person_id"];
$infrsplayernumber_code = $_REQUEST["frsplayernumber_code"];
$inaction = $_REQUEST["action"];

Check_Data("person",$inperson_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    if ( $inaction == "Select") {       
        $GLOBALS{'frsplayernumber_allocationtype'} = "Player";
        $GLOBALS{'frsplayernumber_personid'} = $inperson_id;
        $GLOBALS{'frsplayernumber_teamcode'} = "";       
        Write_Data("frsplayernumber","Club",$infrsplayernumber_code);
        $GLOBALS{'person_shirtnumber'} = $infrsplayernumber_code; 
        Write_Data("person",$inperson_id);
        XPTXTCOLOR("Congratulations you have been allocated shirt number ".$infrsplayernumber_code,"green");
    }
    if ( $inaction == "DeSelect") {
        Delete_Data("frsplayernumber","Club",$infrsplayernumber_code);
        $GLOBALS{'person_shirtnumber'} = "";
        Write_Data("person",$inperson_id);
        XPTXTCOLOR("Shirt number ".$infrsplayernumber_code." has now been de-allocated","green");
    }
    
} else {
    XPTXTCOLOR("Invalid person id.","red");
}

Frs_SHIRTNUMBERCHOOSER_Output($inperson_id);

Back_Navigator();
PageFooter("Default","Final");

?>


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
