<<<<<<< HEAD
<?php

require_once('MPDF/mpdf.php');

$html = '
<h1><a name="top"></a>mPDF</h1>
<h2>Basic HTML Example</h2>
This file demonstrates most of the HTML elements.
<h3>Heading 3</h3>
<h4>Heading 4</h4>
<h5>Heading 5</h5>
<h6>Heading 6</h6>
<table border="1">
<tr>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
</tr>
<tr>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
</tr>
<tr>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
</tr>
</table>
';
 
$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();
?>
=======
<?php

require_once('MPDF/mpdf.php');

$html = '
<h1><a name="top"></a>mPDF</h1>
<h2>Basic HTML Example</h2>
This file demonstrates most of the HTML elements.
<h3>Heading 3</h3>
<h4>Heading 4</h4>
<h5>Heading 5</h5>
<h6>Heading 6</h6>
<table border="1">
<tr>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
</tr>
<tr>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
</tr>
<tr>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
<td>fe eqg tew</td>
</tr>
</table>
';
 
$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();
?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
