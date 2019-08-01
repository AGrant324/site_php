<<<<<<< HEAD
<?php 

echo "<h4>Character print test - Part 3</h4>";

echo "<br>=================================================================<br>";
echo("<br>Re-Read CSV file as CSV file<br>");
if (($handle = fopen("filepostexcel.csv", "r")) !== FALSE) {
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
=======
<?php 

echo "<h4>Character print test - Part 3</h4>";

echo "<br>=================================================================<br>";
echo("<br>Re-Read CSV file as CSV file<br>");
if (($handle = fopen("filepostexcel.csv", "r")) !== FALSE) {
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
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
