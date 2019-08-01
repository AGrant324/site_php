<<<<<<< HEAD
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_grlroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$inleague = $_REQUEST['League'];

// XH2($inleague);

=======
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_grlroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$inleague = $_REQUEST['League'];

// XH2($inleague);

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
Grl_LeagueTableAPlugin_Output($GLOBALS{'currperiodid'},$inleague);