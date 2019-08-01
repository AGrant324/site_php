<?php 

echo "<h4>Character print test</h4>";


$string = "Notes line 1
Notes line 2
Notes line 3
Notes line 4";


echo("<br><br>");

echo $string;

echo("<br>Original String<br>");

echo bin2hex($string);

echo("<br><br>");

echo('<textarea rows="4" cols="50">'.$string.'</textarea>');

echo("<br>Original String<br>");

echo bin2hex(utf8_decode($string));

echo("<br>Decoded String<br>");

echo('<textarea rows="4" cols="50">'.utf8_decode($string).'</textarea>');

$outarray = Array();
array_push($outarray,$string);

echo("<br>CSV File Out String<br>");

echo bin2hex(utf8_decode($outarray[0]));

$fp = fopen('file.csv', 'w+');
fputcsv($fp, $outarray);
fclose($fp);

echo("<br>Re-Read CSV file as ordinary file<br>");

$fh = fopen('file.csv','r');
while ($line = fgets($fh)) {
    echo "<br>=======================";
    echo "<br>".$line;
    echo "<br>".bin2hex(utf8_decode($line));
}
fclose($fh);

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

?> 
