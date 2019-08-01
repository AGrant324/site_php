<<<<<<< HEAD
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
FBHeader();

$incategoryid = $_REQUEST['CategoryId'];
$indate = $_REQUEST['Date'];
$insortby = $_REQUEST['SortBy'];
$insortseq = $_REQUEST['SortSeq'];
$inshow = $_REQUEST['Show'];
$inmax = $_REQUEST['Max'];

Webpage_FBSTYLE_Output();
Webpage_EVENTLISTGENERATOR_Output($incategoryid,$indate,$insortby,$insortseq,$inshow,$inmax);

FBFooter();

=======
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
FBHeader();

$incategoryid = $_REQUEST['CategoryId'];
$indate = $_REQUEST['Date'];
$insortby = $_REQUEST['SortBy'];
$insortseq = $_REQUEST['SortSeq'];
$inshow = $_REQUEST['Show'];
$inmax = $_REQUEST['Max'];

Webpage_FBSTYLE_Output();
Webpage_EVENTLISTGENERATOR_Output($incategoryid,$indate,$insortby,$insortseq,$inshow,$inmax);

FBFooter();

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
