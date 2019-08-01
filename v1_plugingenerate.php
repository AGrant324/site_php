<<<<<<< HEAD
<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_PLUGINUTILITY_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

if (file_exists($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/plugins")) { } else {    
    // print "<br>".$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/plugins"."\n";
    mkdir($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/plugins", 0777);
    XBR();XBR();    
}

$plugina = Get_Array('plugin');
foreach ($plugina as $plugin_id) {
    Get_Data("plugin",$plugin_id);
    $GLOBALS{'IOERRORcode'} = "PLUG001";
    $GLOBALS{'IOERRORmessage'} = "plugin file write error";
    $pluginphpfile = Open_File_Write ($GLOBALS{'domainfilepath'}."/plugins/".$plugin_id."_pagephp.php");
    Write_File ($pluginphpfile,$GLOBALS{'plugin_pagephp'});
    Close_File_Write($pluginphpfile);
    XPTXTCOLOR($plugin_id." - ".$GLOBALS{'plugin_name'}." - plugin activated","green");
}

Webpage_PLUGINUTILITY_Output();

Back_Navigator();
PageFooter("Default","Final");

=======
<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_PLUGINUTILITY_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

if (file_exists($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/plugins")) { } else {    
    // print "<br>".$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/plugins"."\n";
    mkdir($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/plugins", 0777);
    XBR();XBR();    
}

$plugina = Get_Array('plugin');
foreach ($plugina as $plugin_id) {
    Get_Data("plugin",$plugin_id);
    $GLOBALS{'IOERRORcode'} = "PLUG001";
    $GLOBALS{'IOERRORmessage'} = "plugin file write error";
    $pluginphpfile = Open_File_Write ($GLOBALS{'domainfilepath'}."/plugins/".$plugin_id."_pagephp.php");
    Write_File ($pluginphpfile,$GLOBALS{'plugin_pagephp'});
    Close_File_Write($pluginphpfile);
    XPTXTCOLOR($plugin_id." - ".$GLOBALS{'plugin_name'}." - plugin activated","green");
}

Webpage_PLUGINUTILITY_Output();

Back_Navigator();
PageFooter("Default","Final");

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
