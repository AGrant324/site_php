<?php # corhistoryuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$indmwssu_id = $_REQUEST['dmwssu_id'];
$indmwssu_clientupdatetimestamp = $_REQUEST['dmwssu_clientupdatetimestamp'];

Check_Data('dmwssu',$indmwssu_id);
if ($GLOBALS{'IOWARNING'} == "0") {
    $GLOBALS{'dmwssu_clientupdatetimestamp'} = $indmwssu_clientupdatetimestamp;
    Write_Data('dmwssu',$indmwssu_id);
    print "0|".$indmwssu_clientupdatetimestamp;
} else {
    print "1|".$indmwssu_clientupdatetimestamp;    
}

?>