<?php 

echo "<h4>Character print test - Part 2</h4>";

$string = $_REQUEST["specialchars"];

echo "<br>=================================================================<br>";
echo("<br>Original String<br>");
echo $string;
echo("<br><br>");
echo bin2hex($string);
echo("<br><br>");
echo('<textarea rows="4" cols="50">'.$string.'</textarea>');


echo "<br>=================================================================<br>";
echo("<br>Decoded String<br>");
echo bin2hex(utf8_decode($string));
echo("<br><br>");
echo('<textarea rows="4" cols="50">'.utf8_decode($string).'</textarea>');


echo "<br>=================================================================<br>";
echo("<br>Decoded String with 0D0A replaced  by 0D<br>");
$string = str_replace(chr(13).chr(10),chr(13),$string);
echo bin2hex(utf8_decode($string));
echo("<br><br>");
echo('<textarea rows="4" cols="50">'.utf8_decode($string).'</textarea>');


echo "<br>=================================================================<br>";
echo("<br>CSV File Out String<br>");
$outarray = Array();
array_push($outarray,$string);
echo bin2hex(utf8_decode($outarray[0]));
unlink('file.csv');
$fp = fopen('file.csv', 'w');
fputcsv($fp, $outarray);
fclose($fp);


echo "<br>=================================================================<br>";
echo("<br>Re-Read CSV file as ordinary file<br>");
$fh = fopen('file.csv','r');
while ($line = fgets($fh)) {
    echo "<br>---------------";
    echo "<br>".$line;
    echo "<br>".bin2hex(utf8_decode($line));
}
fclose($fh);


echo "<br>=================================================================<br>";
echo("<br>Re-Read CSV file as CSV file<br>");
if (($handle = fopen("file.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
            echo bin2hex(utf8_decode($data[$c])) . "<br />\n";
            echo('<textarea rows="4" cols="50">'.$data[$c].'</textarea>');
        }
    }
    fclose($handle);
}
echo "<br>=================================================================<br>";
echo "<h4>Now read and save file as filepostexcel.csv</h4>";

print '<form action="specialcharspostexcel.php">'."\n";
print '<input type="submit">'."\n";
print '</form>'."\n";

?> 
