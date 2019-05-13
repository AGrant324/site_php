<?php # pdfroutines.php

// ============== doc structure ============================
function PSTART() { 
	$GLOBALS{'pdfr'} = ''; // CHECK - This really means reset style
}
function PPAGEBREAK() {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<pagebreak />'."\n";
}
function PEND() {
}

// ============== csv output ============================
function PCSVHARRAY($csvharray) {
    $GLOBALS{'pdfcsvha'} = $csvharray;
}
function PCSVARRAY($csvarray) {
    $GLOBALS{'pdfcsva'} = $csvarray;
}

// ============== tables ============================
function PTABLE() { 
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<table style="overflow: wrap" >'."\n"; 
}
function PTABLEBOX() {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<table style="border:1px, solid black;">'."\n";
}
function P_TABLE() { 
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'</table>'."\n";  
}
function PROW() { 
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<tr>'."\n"; 
}
function P_ROW() { 
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'</tr>'."\n";  
}
function PCOL() { 
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td style="padding: 5px 5px 5px 5px;">'."\n"; 
}
function PCOLTOP() { 
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td valign="top" style="padding: 5px 5px 5px 5px;">'."\n"; 
}
function PCOLWIDTH($width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 5px 5px 5px 5px;" >'."\n";
}
function PCOLTOPWIDTH($width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td valign="top" width="'.px($width).'" style="padding: 5px 5px 5px 5px;" >'."\n";
}
function PCOLTOPWIDTHCONDENSED($width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td valign="top" width="'.px($width).'" style="padding: 1px 5px 1px 5px;" >'."\n";
}
function PCOLLEFTWIDTH($width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 5px 5px 5px 0px;" >'."\n";
}
function PCOLRIGHTWIDTH($width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="right" width="'.px($width).'" style="padding: 5px 0px 5px 5px;" >'."\n";
}
function PCOLRIGHT() {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="right" style="padding: 5px 5px 5px 5px;" >'."\n";
}
function PCOLCENTER() {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="center" style="padding: 5px 5px 5px 5px;" >'."\n";
}
function P_COL() { 
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'</td>'."\n"; 
}

// ============== formatting ============================
function PHR() {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<hr/>'."\n"; 
}
function PBR() {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<br>'."\n"; 
}

// ============== text ============================
function PTEXT($text) { 
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.$text."\n"; 
}
function PTEXTBOLD($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<b>'.$text.'</b>'."\n";
}
function PCOLTEXT($text) { 
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td style="padding: 5px 5px 5px 5px;" >'.$text.'</td>'."\n"; 
}
function PCOLTEXTRIGHT($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="right" style="padding: 5px 5px 5px 5px;" >'.$text.'</td>'."\n";
}
function PCOLTEXTCOLOUR($text, $textcolor, $backcolor) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.'">'.$text.'</span></td>'."\n";
}
function PCOLTEXTBOLD($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td style="padding: 5px 5px 5px 5px;" ><b>'.$text.'</b></td>'."\n";
}
function PCOLTEXTBOLDWIDTH($text,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 5px 5px 5px 5px;" ><b>'.$text.'</b></td>'."\n";
}
function PCOLTEXTLEFTBOLDWIDTH($text,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 5px 5px 5px 0px;" ><b>'.$text.'</b></td>'."\n";
}
function PCOLTEXTWIDTH($text,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 5px 5px 5px 5px;" >'.$text.'</td>'."\n";
}
function PCOLTEXTWIDTHCONDENSED($text,$width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 1px 5px 1px 5px;" >'.$text.'</td>'."\n";
}
function PCOLTEXTBOLDWIDTHCONDENSED($text,$width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 1px 5px 1px 5px;" ><b>'.$text.'</b></td>'."\n";
}
function PCOLTEXTLEFTWIDTH($text,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 5px 5px 5px 0px;" >'.$text.'</td>'."\n";
}
function PCOLTEXTLEFTWIDTHCONDENSED($text,$width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 1px 5px 1px 0px;" >'.$text.'</td>'."\n";
}
function PCOLTEXTCOLOURWIDTH($text,$textcolor,$backcolor,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" width="'.px($width).'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.'">'.$text.'</span></td>'."\n";
}
function PCOLTEXTCOLOURWIDTHCONDENSED($text,$textcolor,$backcolor,$width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" width="'.px($width).'" style="padding: 1px 5px 1px 5px" ><span style="color:'.$textcolor.'">'.$text.'</span></td>'."\n";
}
function PCOLTEXTBOLDCOLOURWIDTHCONDENSED($text,$textcolor,$backcolor,$width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" width="'.px($width).'" style="padding: 1px 5px 1px 5px" ><span style="color:'.$textcolor.'"><b>'.$text.'</b></span></td>'."\n";
}
function PCOLTEXTCENTRECOLOURWIDTH($text,$textcolor,$backcolor,$width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="center" bgcolor="'.$backcolor.'" width="'.px($width).'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.'">'.$text.'</span></td>'."\n";
}
function PPARA($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<p>'.$text.'</p>'."\n";
}
function PCOLPARA($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td style="padding: 5px 5px 5px 5px;" >'.'<p>'.$text.'</p>'.'</td>'."\n";
}
function PCOLPARAWIDTH($text,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 5px 5px 5px 5px;" >'.'<p>'.$text.'</p>'.'</td>'."\n";
}
function PH1($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h1>'.$text.'</h1>'."\n";
}
function PH2($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h2>'.$text.'</h2>'."\n";
}
function PH3($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h3>'.$text.'</h3>'."\n";
}
function PH4($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h4>'.$text.'</h4>'."\n";
}
function PH5($text) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h5>'.$text.'</h5>'."\n";
}

// ============== text from database fields============================
// set up markup colours
function PFIELDMARKUPCOLOURS ($validcolor,$invalidcolor) {
	$GLOBALS{'validcolor'} = $validcolor;
	$GLOBALS{'invalidcolor'} = $invalidcolor;
}
// Simple field value
function PFIELD ($fieldname) {
	return $GLOBALS{$fieldname};
}
// text fields
function PTEXTFIELD ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.$GLOBALS{$fieldname}."\n";
}
function PTEXTFIELDBOLD ($fieldname) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}."<b>".$GLOBALS{$fieldname}."</b>"."\n";
}
function PTEXTFIELDMARKUP ($fieldname) {
	if ($GLOBALS{$fieldname} == "") { $backcolor = $GLOBALS{'invalidcolor'}; $text = "..............";}
	else { $backcolor = $GLOBALS{'validcolor'}; $text = $GLOBALS{$fieldname};}
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<span style="background-color: '.$backcolor.'">'.$text.'</span>'."\n";
}

// text fields in columns
function PCOLTEXTFIELD ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td style="padding: 5px 5px 5px 5px;" >'.$GLOBALS{$fieldname}.'</td>'."\n";
}
function PCOLTEXTFIELDWIDTH ($fieldname,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 5px 5px 5px 5px;" >'.$GLOBALS{$fieldname}.'</td>'."\n";
}
function PCOLTEXTFIELDWIDTHCONDENSED ($fieldname,$width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 1px 5px 1px 5px;" >'.$GLOBALS{$fieldname}.'</td>'."\n";
}
function PCOLTEXTFIELDBOLDWIDTHCONDENSED ($fieldname,$width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 1px 5px 1px 5px;" ><b>'.$GLOBALS{$fieldname}.'</b></td>'."\n";
}
function PCOLTEXTFIELDMARKUP ($fieldname) {	
	if ($GLOBALS{$fieldname} == "") { $backcolor = $GLOBALS{'invalidcolor'}; }
	else { $backcolor = $GLOBALS{'validcolor'}; }	
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" style="padding: 5px 5px 5px 5px;" >'.$GLOBALS{$fieldname}.'</td>'."\n";
}
function PCOLTEXTFIELDMARKUPWIDTH ($fieldname,$width) {
	if ($GLOBALS{$fieldname} == "") { $backcolor = $GLOBALS{'invalidcolor'}; }
	else { $backcolor = $GLOBALS{'validcolor'}; }	
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" width="'.px($width).'" style="padding: 5px 5px 5px 5px;" >'.$GLOBALS{$fieldname}.'</td>'."\n";
}
function PCOLTEXTFIELDCOLOUR($fieldname, $textcolor, $backcolor) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.';" >'.$GLOBALS{$fieldname}.'</span></td>'."\n";
}
function PCOLTEXTFIELDCOLOURWIDTH($fieldname, $textcolor, $backcolor, $width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" bgcolor="'.$backcolor.'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.';" >'.$GLOBALS{$fieldname}.'</span></td>'."\n";
}

function PCOLTEXTFIELDCOLOURWIDTHCONDENSED($fieldname, $textcolor, $backcolor, $width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" bgcolor="'.$backcolor.'" style="padding: 1px 5px 1px 5px;" ><span style="color:'.$textcolor.';" >'.$GLOBALS{$fieldname}.'</span></td>'."\n";
}
function PCOLTEXTFIELDBOLDCOLOURWIDTHCONDENSED($fieldname, $textcolor, $backcolor, $width) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" bgcolor="'.$backcolor.'" style="padding: 1px 5px 1px 5px;" ><span style="color:'.$textcolor.';" ><b>'.$GLOBALS{$fieldname}.'</b></span></td>'."\n";
}
function PCOLTEXTFIELDCOLOURBOX($fieldname, $textcolor, $backcolor) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td style="border:1px, solid black;" bgcolor="'.$backcolor.'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.';" >'.$GLOBALS{$fieldname}.'</span></td>'."\n";
}


// numeric
function PCOLTEXTFIELDNUM ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="right" style="padding: 5px 5px 5px 5px;" >'.number_format($GLOBALS{$fieldname}).'</td>'."\n";
}
function PCOLTEXTFIELDNUMWIDTH ($fieldname,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" align="right" style="padding: 5px 5px 5px 5px;" >'.number_format($GLOBALS{$fieldname}).'</td>'."\n";
}
function PCOLTEXTFIELDNUMMARKUP ($fieldname) {
	if ($GLOBALS{$fieldname} == "") { $backcolor = $GLOBALS{'invalidcolor'}; }
	else { $backcolor = $GLOBALS{'validcolor'}; }	
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" align="right" style="padding: 5px 5px 5px 5px;" >'.number_format($GLOBALS{$fieldname}).'</td>'."\n";
}
function PCOLTEXTFIELDNUMMARKUPWIDTH ($fieldname,$width) {
	if ($GLOBALS{$fieldname} == "") { $backcolor = $GLOBALS{'invalidcolor'}; }
	else { $backcolor = $GLOBALS{'validcolor'}; }	
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" bgcolor="'.$backcolor.'" align="right" style="padding: 5px 5px 5px 5px;" >'.number_format($GLOBALS{$fieldname}).'</td>'."\n";
}
function PCOLTEXTFIELDNUMCOLOUR($fieldname, $textcolor, $backcolor) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="right" bgcolor="'.$backcolor.'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.';" >'.number_format($GLOBALS{$fieldname}).'</span></td>'."\n";
}
function PCOLTEXTFIELDNUMCOLOURWIDTH($fieldname, $textcolor, $backcolor,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" align="right" bgcolor="'.$backcolor.'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.';" >'.number_format($GLOBALS{$fieldname}).'</span></td>'."\n";
}

// currency
function PCOLTEXTFIELDCURR ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="right" style="padding: 5px 5px 5px 5px;" >'."&pound;".number_format($GLOBALS{$fieldname}).'</td>'."\n";
}
function PCOLTEXTFIELDCURRWIDTH ($fieldname,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" align="right" style="padding: 5px 5px 5px 5px;" >'."&pound;".number_format($GLOBALS{$fieldname}).'</td>'."\n";
}
function PCOLTEXTFIELDCURRMARKUP ($fieldname) {
	if ($GLOBALS{$fieldname} == "") { $backcolor = $GLOBALS{'invalidcolor'}; }
	else { $backcolor = $GLOBALS{'validcolor'}; }	
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" align="right" style="padding: 5px 5px 5px 5px;" >'."&pound;".number_format($GLOBALS{$fieldname}).'</td>'."\n";
}
function PCOLTEXTFIELDCURRMARKUPWIDTH ($fieldname,$width) {
	if ($GLOBALS{$fieldname} == "") { $backcolor = $GLOBALS{'invalidcolor'}; }
	else { $backcolor = $GLOBALS{'validcolor'}; }	
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" bgcolor="'.$backcolor.'" align="right" style="padding: 5px 5px 5px 5px;" >'."&pound;".number_format($GLOBALS{$fieldname}).'</td>'."\n";
}
function PCOLTEXTCURRMARKUPWIDTH ($val,$width) {
    if ($val == "") { $backcolor = $GLOBALS{'invalidcolor'}; }
    else { $backcolor = $GLOBALS{'validcolor'}; }
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" bgcolor="'.$backcolor.'" align="right" style="padding: 5px 5px 5px 5px;" >'."&pound;".number_format($val).'</td>'."\n";
}
function PCOLTEXTFIELDCURRCOLOUR($fieldname, $textcolor, $backcolor) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="right" bgcolor="'.$backcolor.'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.';" >'."&pound;".number_format($GLOBALS{$fieldname}).'</span></td>'."\n";
}
function PCOLTEXTFIELDCURRCOLOURWIDTH($fieldname, $textcolor, $backcolor, $width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" align="right" bgcolor="'.$backcolor.'" style="padding: 5px 5px 5px 5px;" ><span style="color:'.$textcolor.';" >'."&pound;".number_format($GLOBALS{$fieldname}).'</span></td>'."\n";
}

// percent
function PCOLTEXTFIELDPERCENT ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td align="right" style="padding: 5px 5px 5px 5px;" >'.number_format($GLOBALS{$fieldname},2).'%'.'</td>'."\n";
}
function PCOLTEXTFIELDPERCENTWIDTH ($fieldname,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" align="right" style="padding: 5px 5px 5px 5px;" >'.number_format($GLOBALS{$fieldname},2).'%'.'</td>'."\n";
}
function PCOLTEXTFIELDPERCENTMARKUP ($fieldname) {
	if ($GLOBALS{$fieldname} == "") { $backcolor = $GLOBALS{'invalidcolor'}; }
	else { $backcolor = $GLOBALS{'validcolor'}; }	
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td bgcolor="'.$backcolor.'" align="right" style="padding: 5px 5px 5px 5px;" >'.number_format($GLOBALS{$fieldname},2).'%'.'</td>'."\n";
}
function PCOLTEXTFIELDPERCENTMARKUPWIDTH ($fieldname,$width) {
	if ($GLOBALS{$fieldname} == "") { $backcolor = $GLOBALS{'invalidcolor'}; }
	else { $backcolor = $GLOBALS{'validcolor'}; }	
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" bgcolor="'.$backcolor.'" align="right" style="padding: 5px 5px 5px 5px;" >'.number_format($GLOBALS{$fieldname},2).'%'.'</td>'."\n";
}

// RAG fields
function PCOLTEXTFIELDRAGWIDTH($fieldname,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" bgcolor="'.Val2RAG($GLOBALS{$fieldname}).'" style="padding: 5px 5px 5px 5px;" ><span style="color:black;" >'.$GLOBALS{$fieldname}.'</span></td>'."\n";
}



// paragraph
function PPARAFIELD ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<p>'.$GLOBALS{$fieldname}.'</p>'."\n";
}
function PCOLPARAFIELD ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td style="padding: 5px 5px 5px 5px;" >'.'<p>'.$GLOBALS{$fieldname}.'</p>'.'</td>'."\n";
}
function PCOLPARAFIELDWIDTH ($fieldname,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td width="'.px($width).'" style="padding: 5px 5px 5px 5px;" >'.'<p>'.$GLOBALS{$fieldname}.'</p>'.'</td>'."\n";
}
function PH1FIELD ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h1>'.$GLOBALS{$fieldname}.'</h1>'."\n";
}
function PH2FIELD ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h2>'.$GLOBALS{$fieldname}.'</h2>'."\n";
}
function PH3FIELD ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h3>'.$GLOBALS{$fieldname}.'</h3>'."\n";
}
function PH4FIELD ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h4>'.$GLOBALS{$fieldname}.'</h4>'."\n";
}
function PH5FIELD ($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<h5>'.$GLOBALS{$fieldname}.'</h5>'."\n";
}


// ============== images ============================ 
function PIMG($imagename) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="'.PIMGSRC($imagename).'" />'."\n";
}
function PCOLIMG($imagename) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td valign="top">'.'<img src="'.PIMGSRC($imagename).'" />'.'</td>'."\n";
}
function PIMGSIZED($imagename,$width,$height) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="'.PIMGSRC($imagename).'" width="'.px($width).'" height="'.$height.'" />'."\n";
}
function PCOLIMGSIZED($imagename,$width,$height) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td valign="top">'.'<img src="'.PIMGSRC($imagename).'" width="'.px($width).'" height="'.$height.'" />'.'</td>'."\n";
}
function PIMGSRC($imagename) {
	$imageurl =  '../site_assets/NoImage_Flex.png';
	if ($imagename != "") {
		$imageurl =  $GLOBALS{'domainwwwurl'}."/domain_media/".$imagename;
	}
	return $imageurl;
}
function PIMGASSETSIZED($assetimagename,$width,$height) {
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="'.PIMGASSETSRC($assetimagename).'" width="'.px($width).'" height="'.$height.'" />'."\n";
}
function PIMGASSETSRC($assetimagename) {
    $imageurl =  '../site_assets/NoImage_Flex.png';
    if ($assetimagename != "") {
        $imageurl =  '../site_assets/'.$assetimagename;
    }
    return $imageurl;
}

function PIMGLIBRARY($assetcode) {
    Check_Data('asset',$GLOBALS{'LOGIN_domain_id'},$assetcode);
    // $imageurl =  '../site_assets/NoImage_Flex.png';
    if ($GLOBALS{'asset_file'}  != "") {
        //The file path to our image.
        $imagePath = $GLOBALS{'site_filepath'}.'/'.$GLOBALS{'LOGIN_domain_id'}.'/assets/'.$GLOBALS{'asset_file'};
        //Get the extension of the file using the pathinfo function.
        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
        //Get the file data.
        $data = file_get_contents($imagePath);
        //Encode the data into Base 64 using the base64_encode function.
        $dataEncoded = base64_encode($data);
        //Construct our base64 string.
        $base64Str = 'data:image/' . $extension . ';base64,' . $dataEncoded;
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="' . $base64Str . '" width="100%" />'."\n"; 
    } 
}

function PIMGBASE64PNG($fieldname,$width) {
    $prefix = 'data:image/png;base64,';
    $str = $GLOBALS{$fieldname}; 
    if ($str != "") {
        if (substr($str, 0, strlen($prefix)) == $prefix) {
            $str = substr($str, strlen($prefix));
        }
        $binary = base64_decode($str);
        $dima = getimagesizefromstring($binary);  // width, height
        $pxwidth = px($width);
        $pxheight = $pxwidth * $dima[1] / $dima[0];
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="data:image/png;base64,' . $str . '" width="'.$pxwidth.'" height="'.$pxheight.'" />'."\n";       
    } else {
          
    } 
}

function PIMGBASE64PNGSIZED($fieldname,$width,$height) {
    $prefix = 'data:image/png;base64,';
    $str = $GLOBALS{$fieldname};
    if (substr($str, 0, strlen($prefix)) == $prefix) {
        $str = substr($str, strlen($prefix));
    }
    $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="data:image/png;base64,' . $str . '" style="border-style: solid; border-width: 1px;" border="1" width="'.px($width).'" height="'.$height.'" />'."\n";
}

function PGRAPHBASE64PNG($reportid) {
    $reporttypecode = substr($reportid,0,2);
    if ($reporttypecode == "RP") { Check_Data('report',$reportid); }
    if ($reporttypecode == "RM") { Check_Data('mpdfreport',$reportid); }
    if ($GLOBALS{'IOWARNING'} == "0") {
        $prefix = 'data:image/png;base64,';
        if ($reporttypecode == "RP") { $str = $GLOBALS{'report_graphimage'}; }
        if ($reporttypecode == "RM") { $str = $GLOBALS{'mpdfreport_graphimage'}; }
        if ($str != "") {
            if (substr($str, 0, strlen($prefix)) == $prefix) {
                $str = substr($str, strlen($prefix));
            }
            $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="data:image/png;base64,' . $str . '" width="100%" />'."\n";
        } else {
            $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<p>Report not found</p>'."\n";
        }
    }
}

function PCUSTOMGRAPH($reportgraphtype, $reportgraphcaption, $gxheader, $gyheader, $gdata, $extratableparms,$extrathparms) {  
    // see http://highcharttable.org for documentation
    // $reportgraphtype 
    // $reportgraphcaption  
    // $gxheader - 1 dimensional array
    // $gyheader - 1 dimensional array
    // $gdata - 2 dimensional associative array     key[gxheaderval,gyheaderval] = dataval
    // $extratableparms
    // $extrathparms
    if ($GLOBALS{'MPDFREPORTMODE'} == "web") {
        
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<table class="table highchart" data-graph-container-before="1" '.$extratableparms." ";
    
        if ( $reportgraphtype == "pie" ) {
            $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.' data-graph-datalabels-enabled=1 ';
        }
        
        $coli = 1;
        foreach ($gyheader as $ykey => $yvalue) {
            if ($yvalue == "Red") { $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'data-graph-color-'.$coli.'="red" ';  }
            if ($yvalue == "Amber") { $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'data-graph-color-'.$coli.'="orange" ';  }
            if ($yvalue == "Green") { $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'data-graph-color-'.$coli.'="green" ';  }
            if ($yvalue == "") { $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'data-graph-color-'.$coli.'="silver" ';  }
            $coli++;
        }
        
        if ( $reportgraphcaption == "" ) { $reportgraphcaption = $reporttitle; }
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.' data-graph-type="'.$reportgraphtype.'" ';
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.' >'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<caption>'.$reportgraphcaption.'</caption>'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<thead>'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<tr>'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<th></th>'."\n";
        
        foreach ($gyheader as $ykey => $yvalue) {
            if ($yvalue == "") { $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<th '.$extrathparms.'>None</th>'."\n";  }
            else { $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<th '.$extrathparms.'>'.$yvalue.'</th>'."\n"; }
        }
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'</tr>'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'</thead>'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<tbody>'."\n";
        
        foreach ($gxheader as $xkey => $xvalue) {
            $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<tr>'."\n";
            $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td>'.$xvalue.'</td>'."\n";
            foreach ($gyheader as $ykey => $yvalue) {
                $yvalue = $gdata[$xvalue][$yvalue];
                // data-graph-name="January" data-graph-item-color="#ccc"
                $color = "";
                if ($xvalue == "Red") { $color = ' data-graph-item-color="red" ';  }
                if ($xvalue == "Amber") { $color = ' data-graph-item-color="orange" ';  }
                if ($xvalue == "Green") { $color = ' data-graph-item-color="green" ';  }
                if ($xvalue == "") { $color = ' data-graph-item-color="silver" ';  }
                $pielabel = "";
                if ( $reportgraphtype == "pie" ) { $pielabel = ' data-graph-name="'.$xvalue.' '.$yvalue.'" '; }
                $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td'.$color.$pielabel.'>'.$yvalue.'</td>'."\n";
            }
            $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'</tr>'."\n";
        }
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'</tbody>'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'</table>'."\n";
        XBR();
        BROW();
        BCOL("3"); BINBUTTONIDSPECIAL("SaveGraphImage","info","Save Graph Image"); B_COL();
        B_ROW();
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<canvas id="myCanvas" width="600" height="600"'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'style="border:1px solid #c3c3c3;">'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'</canvas>'."\n";
        $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img id="myImage" src="../site_assets/NoImage_Flex.png" height="600" >'."\n";
        XINHIDID("mpdfreport_graphimage","mpdfreport_graphimage","");
        
    } else {
        $prefix = 'data:image/png;base64,';
        $str = $GLOBALS{'mpdfreport_graphimage'};
        if ($str != "") {
            if (substr($str, 0, strlen($prefix)) == $prefix) {
                $str = substr($str, strlen($prefix));
            }
            $binary = base64_decode($str);
            $dima = getimagesizefromstring($binary);  // width, height
            $pxwidth = px($width);
            $pxheight = $pxwidth * $dima[1] / $dima[0];
            $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="data:image/png;base64,' . $str . '" width="'.$pxwidth.'" height="'.$pxheight.'" />'."\n";  
        } else {
            $GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<p>Graph not found</p>'."\n";  
        }
    }
}

// ============== images from database fields============================
function PIMGFIELD($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="'.PIMGFIELDSRC($fieldname).'" />'."\n";
}
function PIMGFIELDWIDTH($fieldname,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="'.PIMGFIELDSRC($fieldname).'" width="'.px($width).'"  />'."\n";
}
function PIMGFIELDWIDTHBOX($fieldname,$width) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="'.PIMGFIELDSRC($fieldname).'" width="'.px($width).'" style="border:1px, solid black;" />'."\n";
}
function PCOLIMGFIELD($fieldname) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td valign="top">'.'<img src="'.PIMGFIELDSRC($fieldname).'" />'.'</td>'."\n";
}
function PIMGFIELDSIZED($fieldname,$width,$height) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<img src="'.PIMGFIELDSRC($fieldname).'" width="'.px($width).'" height="'.$height.'" />'."\n";
}
function PCOLIMGFIELDSIZED($fieldname,$width,$height) {
	$GLOBALS{'pdfr'} = $GLOBALS{'pdfr'}.'<td valign="top">'.'<img src="'.PIMGFIELDSRC($fieldname).'" width="'.px($width).'" height="'.$height.'" />'.'</td>'."\n";
}
function PIMGFIELDSRC($fieldname) {
	$imageurl =  '../site_assets/NoImage_Flex.png';
	if ($GLOBALS{$fieldname} != "") {
		$imageurl =  $GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{$fieldname};
	}
	return $imageurl;
}

// ============== pixel routine ============================

function px($widthstring) {
	$nominalA4pxwidth = 700;
	if (strlen(strstr($widthstring,'%'))>0) {	
		$widthnum = floatval(str_replace("%", "", $widthstring));	
		if ($GLOBALS{'mpdfreport_pagelayout'} == "" ) { $GLOBALS{'mpdfreport_pagelayout'} = "A4"; }
		if ( $GLOBALS{'mpdfreport_pagelayout'} == "A4" ) { $pagewidth = 210;}
		if ( $GLOBALS{'mpdfreport_pagelayout'} == "A4-L" ) { $pagewidth = 297; }
		if ( $GLOBALS{'mpdfreport_pagelayout'} == "A3" ) { $pagewidth = 297;  }
		if ( $GLOBALS{'mpdfreport_pagelayout'} == "A3-L" ) { $pagewidth = 420; }
		$pxwidth = ($nominalA4pxwidth*$pagewidth/210)*($widthnum/100);
		return intval($pxwidth);
	} else {
		return $widthstring;
	}
}

// ============== database calls ============================

function PGETPRIMETABLEARRAY() {
	$maxselection = 10; $selectionindex = 0; $firstmax = "1";	
	if (strlen(strstr($GLOBALS{'mpdfreport_primetable'},','))>0) {
	    $primetablea = explode(",",$GLOBALS{'mpdfreport_primetable'});
	    $primetable = $primetablea[0];
	    $primetablepair = $primetablea[1];
	} else {
	    $primetable = $GLOBALS{'mpdfreport_primetable'};
	    $primetablepair = "";
	}	
	if ($GLOBALS{'mpdfreport_maxselection'} > 0) { $maxselection = $GLOBALS{'mpdfreport_maxselection'}; }
	$outkeyarray = Array();	
	$tarray = Get_NKey_Array($primetable);	
	foreach($tarray as $tkeylist) {
		$keyarray = explode('|',$tkeylist);
		if ( count($keyarray) == 1 ) { Get_Data($primetable,$keyarray[0]); }		
		if ( count($keyarray) == 2 ) { Get_Data($primetable,$keyarray[0],$keyarray[1]); }
		if ( count($keyarray) == 3 ) { Get_Data($primetable,$keyarray[0],$keyarray[1],$keyarray[2]); }
		if ( $primetablepair != "" ) {
		    if ( count($keyarray) == 1 ) { Get_Data($primetablepair,$keyarray[0]); }		
		    if ( count($keyarray) == 2 ) { Get_Data($primetablepair,$keyarray[0],$keyarray[1]); }
		    if ( count($keyarray) == 3 ) { Get_Data($primetablepair,$keyarray[0],$keyarray[1],$keyarray[2]); }
		}
		$selectfieldvaluea = Array(); $selectfieldcompa = Array(); $selectfieldformata = Array(); 
		if ( $GLOBALS{'MPDFREPORTFILTER'} != "" ) {
			$seltesta = explodeAND($GLOBALS{'MPDFREPORTFILTER'});
			$fi = 0;
			foreach ( $seltesta as $seltest) {
			    $fi++;
				$selbits = explodeCOMP($seltest);
				$selectfieldcompa{$fi."_".$selbits[0]} = $selbits[1];
				$selectfieldvaluea{$fi."_".$selbits[0]} = $selbits[2];
				$selectfieldformata{$fi."_".$selbits[0]} = $selbits[3];
			}
		}		
		$selected = "1";
		foreach($selectfieldvaluea as $k => $v) {
		    $kbits = explode("_",$k);
		    $kfield = $kbits[1]."_".$kbits[2];
		    $selected = ReSelection($selected,$kfield,$selectfieldcompa{$k},$v,$selectfieldformata{$k});
		}
		if ( $selected == "1" ) {
			$selectionindex++;
			if ( $selectionindex <= $maxselection ) {
				array_push($outkeyarray, $tkeylist); 
			} else {				
				if ( $firstmax == "1" ) {
					PH3("Warning: Maximum number (".$GLOBALS{'mpdfreport_maxselection'}.") of report elements exceeded.");
					$firstmax = "0";
				}
			}
		}
	}
	if ( $selectionindex > $maxselection ) {
		PH4("Total report elements found = ".$selectionindex.".");
		PPAGEBREAK();
	}
	return $outkeyarray;
}

function PGETPRIMETABLEARRAYRECORD($tkeylist) {   
    if (strlen(strstr($GLOBALS{'mpdfreport_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'mpdfreport_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'mpdfreport_primetable'};
        $primetablepair = "";
    }	
	$keyarray = explode('|',$tkeylist);
	if ( count($keyarray) == 1 ) { Get_Data($primetable,$keyarray[0]); }		
	if ( count($keyarray) == 2 ) { Get_Data($primetable,$keyarray[0],$keyarray[1]); }
	if ( count($keyarray) == 3 ) { Get_Data($primetable,$keyarray[0],$keyarray[1],$keyarray[2]); }
	if ( $primetablepair != "" ) {
	    if ( count($keyarray) == 1 ) { Get_Data($primetablepair,$keyarray[0]); }
	    if ( count($keyarray) == 2 ) { Get_Data($primetablepair,$keyarray[0],$keyarray[1]); }
	    if ( count($keyarray) == 3 ) { Get_Data($primetablepair,$keyarray[0],$keyarray[1],$keyarray[2]); }
	}
}

function PGETPRIMETABLESPECIFICRECORD() {
    if (strlen(strstr($GLOBALS{'mpdfreport_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'mpdfreport_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'mpdfreport_primetable'};
        $primetablepair = "";
    }	
	$keyarray = explode(',',$GLOBALS{'MPDFREPORTKEYVALUELIST'});
	if ( count($keyarray) == 1 ) { Get_Data($primetable,$keyarray[0]); }		
	if ( count($keyarray) == 2 ) { Get_Data($primetable,$keyarray[0],$keyarray[1]); }
	if ( count($keyarray) == 3 ) { Get_Data($primetable,$keyarray[0],$keyarray[1],$keyarray[2]); }
	if ( $primetablepair != "" ) {
	    if ( count($keyarray) == 1 ) { Get_Data($primetablepair,$keyarray[0]); }
	    if ( count($keyarray) == 2 ) { Get_Data($primetablepair,$keyarray[0],$keyarray[1]); }
	    if ( count($keyarray) == 3 ) { Get_Data($primetablepair,$keyarray[0],$keyarray[1],$keyarray[2]); }
	}
}

?>