<?php
require ('File/PDF.php');
require ('HTTP/Download.php');
$p = &File_PDF::factory('P', 'mm', 'A4');
$p->open();
$p->setMargins(50, 50);
$p->addPage('P');
$p->setFont('arial', '', 15);
$p->write(10, 'This is some text');
$p->text(10, 20, 'Hello');
$p->close();
$p->output('hello.pdf'); 
?>
