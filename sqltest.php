

<?php # sqltest.php

print "<h3>Hello this is an sql test</h3>";

$dbconnect = "mysql";
$hostconnect = "localhost";
$userconnect = "root";
$pswconnect = "root";

$dbconnect = "cw";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";

$dbconnect = "ocz";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";

$dbconnect = "pandp";
$hostconnect = "localhost";
$userconnect = "picket01_db1_ms";
$pswconnect = "N4wbCifJm";

$dbconnect = "dmws";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";

IODBCONNECT($dbconnect,$hostconnect,$userconnect,$pswconnect);
IOSETUP();

function IODBCONNECT ($db, $host, $user, $password) {
print "IODBCONNECT Called - ".$db." ".$host." ".$user." ".$password."<br>\n";	
$mysqli   = mysqli_connect($host, $user, $password, $db);
if (mysqli_connect_errno($mysqli)) {
    echo '<p class="error">Apologies - The database is not available at this time - please try again later.</p>';
}
# print "IODBCONNECT completed<br>\n";
$GLOBALS{'IOSQL'} = $mysqli;
}

function IOSETUP () {
print "IOSETUP Called<br>\n";	 
$tfields = array();
$tablearray = array();
$q = 'SHOW TABLES';
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
if (mysqli_num_rows($r) > 0) { 
 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
  array_push($tablearray, $row[0]);
  print $row[0]."<br>\n";   
 }
}

}


?>

