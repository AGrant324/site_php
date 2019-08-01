<?php # testwrite

require_once('testroutines.php');

TestRoutine();

$filename = "../cgi-bin/sqlconnect.txt";
$fp = @fopen($filename, "r") or die;
$fdata = fread($fp, filesize($filename));
while(!feof($fp)){
	$fdata .= fgets($fp, 1024);
}
fclose($fp);
print $fdata;

print "<br>READ1";

$filename = "../testfilephpRH.txt";
$fp = @fopen($filename, "r") or die;
$fdata = fread($fp, filesize($filename));
while(!feof($fp)){
	$fdata .= fgets($fp, 1024);
}
fclose($fp);
print $fdata;

print "<br>READ2";

$filename = "../testfilephpWH.txt";
$fp = @fopen($filename, "w") or die;
fwrite($fp, "56789");
fclose($fp);

print "<br>WRITE1";

$filename = "../../cgi-files/havanthockeyclub/assets/testfilephpWA.txt";
$fp = @fopen($filename, "w") or die;
fwrite($fp, "BBBBB");
fclose($fp);

print "<br>WRITE2";

$filename = "../../cgi-files/havanthockeyclub/assets/testfilephpDA.txt";
$fp = @fopen($filename, "w") or die;
fwrite($fp, "BBBBB");
fclose($fp);

print "<br>WRITE3";

$filename = "../../cgi-files/havanthockeyclub/assets/testfilephpDA.txt";
print "<br>$filename";
unlink($filename);

print "<br>DELETE1";



















?>
