<?php # namevalue.php

print "Content-type: text/html\n\n";
print "<h2>NameValue called</h2>\n";
print_r ($_REQUEST);
print "<h2>Fields</h2>\n";
foreach ($_REQUEST as $key => $selecttext ) {
 print "<P>The field with the NAME attribute equal to <B>$key</B> had a VALUE equal to <B>$selecttext</B>";
}
?>
