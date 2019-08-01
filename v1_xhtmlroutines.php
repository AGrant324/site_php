<?php # xhtmlroutines

// ------------- XHTML subroutines XXX -----------------------------------------
function XDOCTYPE () { echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n";}
function XHTML () { echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">'."\n";}
function X_HTML () { echo '</html>'."\n"; }
function XHEAD () { echo '<head>'."\n"; }
function X_HEAD () { echo '</head>'."\n"; }
function XMETA () { echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />'."\n";}
# title
function XTITLE ($parm0) { echo '<title>'.$parm0.'</title>'."\n"; }
# imported css sheet
function XSTYLE ($parm0) { echo '<style type="text/css" media="all">@import "'.$parm0.'";</style>'."\n"; }
# body class
function XBODY ($parm0) { echo '<body class="'.$parm0.'">'."\n"; }
function X_BODY () { echo '</body>'."\n"; }

function XDIV ($id,$class) {
    if ($id == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$id.'" ';}
    if ($class == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$class.'" ';}
    echo '<div'.$tidtxt.$tclasstxt.'>'."\n";
}
function YDIV ($id,$class) {
    if ($id == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$id.'" ';}
    if ($class == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$class.'" ';}
    return '<div'.$tidtxt.$tclasstxt.'>'."\n";
}
function WDIV ($id,$class) {array_push($GLOBALS{'pluginhtmla'}, YDIV($id,$class));}
function XDIVWIDTH ($id,$class,$width) {
    if ($id == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$id.'" ';}
    if ($class == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$class.'" ';}
    if ($width == "") {$twidthtxt = "";} else {$twidthtxt = ' style="width:'.$width.'";';}
    echo '<div'.$tidtxt.$tclasstxt.$twidthtxt.'>'."\n";
}

# id class height
function XDIVSCROLL ($parm0,$parm1,$parm1) {
    if ($parm0 == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$parm0.'" ';}
    if ($parm1 == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$parm1.'" ';}
    if ($parm1 == "") {$theighttxt = "";} else {$theighttxt = ' max-height:'.$parm1;}
    echo '<div'.$tidtxt.$tclasstxt.' style="overflow-y: scroll; '.$theighttxt.'">'."\n";
}
# id class style
function XDIVCLASSSTYLEWIDTH ($parm0,$parm1,$parm2,$parm3) {
    if ($parm0 == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$parm0.'" ';}
    if ($parm1 == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$parm1.'" ';}
    if ($parm2 == "") {$tstyletxt = "";} else {$tstylext = ' style="'.$parm2.'" ';}
    if ($parm3 == "") {$twidthtxt = "";} else {$twidthtxt = ' width="'.$parm3.'" ';}
    echo '<div'.$tidtxt.$tclasstxt.$tstylext.$twidthtxt.'>'."\n";
}
# id class
function XDIVRIGHT ($parm0,$parm1) {
    if ($parm0 == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$parm0.'" ';}
    if ($parm1 == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$parm1.'" ';}
    echo '<div align="right"'.$tidtxt.$tclasstxt.'>'."\n";
}

function X_DIV ($id) { echo '</div><!-- end #'.$id.' -->'."\n"; }
function Y_DIV ($id) { return '</div><!-- end #'.$id.' -->'."\n"; }
function W_DIV ($id) {array_push($GLOBALS{'pluginhtmla'}, Y_DIV($id));}

# id title
function XDIVPOPUP ($parm0,$parm1) {
if ($parm0 == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$parm0.'" ';}
if ($parm1 == "") {$ttitletxt = "";} else {$ttitletxt = ' title="'.$parm1.'" ';}
echo '<div'.$tidtxt.$ttitletxt.'>'."\n"; }
# id class title
function XDIVCLASSPOPUP ($parm0,$parm1,$parm2) {
if ($parm0 == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$parm0.'" ';}
if ($parm1 == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$parm1.'" ';}
if ($parm2 == "") {$ttitletxt = "";} else {$ttitletxt = ' title="'.$parm2.'" ';}
echo '<div'.$tidtxt.$tclasstxt.$ttitletxt.'>'."\n"; }
# divid
function X_DIVPOPUP ($parm0) { echo '</div><!-- end #'.$parm0.' -->'."\n"; }
function XCOMMENT ($parm0) { echo '<!-- '.$parm0.' -->'."\n";}
function XCLEARFLOAT () { echo '<br class="clearfloat" />'."\n"; }
function YCLEARFLOAT () { return '<br class="clearfloat" />'."\n"; }
function WCLEARFLOAT () { array_push($GLOBALS{'pluginhtmla'}, YCLEARFLOAT()); }
function XCR () { echo "\n"; }
function XBR () {echo '<br/>'."\n"; }
function YBR () { return  '<br/>'."\n";}
function WBR () {array_push($GLOBALS{'pluginhtmla'}, YBR());}
function XHR () {echo '<hr/>'."\n"; }
function YHR () { return  '<hr/>'."\n";}
function WHR () {array_push($GLOBALS{'pluginhtmla'}, YHR());}
function XHRCLASS ($parm0) {echo '<hr class="'.$parm0.'"/>'."\n"; }

function YPAGEBREAK() { return  '<pagebreak />'."\n";}

# text
function XLABEL ($text) {echo '<label>'.$text.'</label>'."\n"; }
function XPTXT ($text) {echo '<p>'.$text.'</p>'."\n";}
function YPTXT ($text) {return '<p>'.$text.'</p>'."\n";}
function WPTXT ($text) {array_push($GLOBALS{'pluginhtmla'}, YPTXT($text));}
function XPTXTID ($id,$text) {echo '<p id="'.$id.'">'.$text.'</p>'."\n"; }
function XP () {echo '<p>'."\n"; }
function X_P () {echo '</p>'."\n"; }
function XTXT ($text) {echo $text."\n"; }
function YTXT ($text) {return  $text."\n";}
function WTXT ($text) {array_push($GLOBALS{'pluginhtmla'}, YTXT($text));}
function XTXTBOLD ($text) {echo '<b>'.$text.'&nbsp;</b>'."\n";}
function XTXTID ($id,$text) {echo '<a id="'.$id.'">'.$text.'</a>'."\n"; }
function YTXTID ($id,$text) {return '<a id="'.$id.'">'.$text.'</a>'."\n"; }
function XTXTIDCLASS ($id,$class,$text) {echo '<a id="'.$id.'" class="'.$class.' ">'.$text.'</a>'."\n"; }

function  XTXTCOLOR ($text,$color) {
    if ($color == "") { $fc1="";$fc2=""; }
    else {$fc1="<font color=$color>";$fc2="</font>";	}
    echo  $fc1.$text.$fc2."\n";
}
function  YTXTCOLOR ($text,$color) {
    if ($color == "") { $fc1="";$fc2=""; }
    else {$fc1="<font color=$color>";$fc2="</font>";	}
    return  $fc1.$text.$fc2."\n";
}
function  XPTXTCOLOR ($text,$color) {
    if ($color == "") { $fc1="";$fc2=""; }
    else {$fc1="<font color=$color>";$fc2="</font>";	}
    echo  '<p>'.$fc1.$text.$fc2.'</p>'."\n"; ;
}
function  YPTXTCOLOR ($text,$color) {
    if ($color == "") { $fc1="";$fc2=""; }
    else {$fc1="<font color=$color>";$fc2="</font>";	}
    return  '<p>'.$fc1.$text.$fc2.'</p>'."\n"; ;
}
function WPTXTCOLOR ($text,$color) {array_push($GLOBALS{'pluginhtmla'}, YPTXTCOLOR($text,$color));}

# keys values existing
function  YTXTCHECKLIST ($parm0,$parm1,$parm2) {
$tstring = "<table border=1>";
$tkeyarray = $parm0; $tvaluearray = $parm1;
for ($ti = 0; $ti < sizeof($tkeyarray); $ti++) {
 $tstring .= "<tr>";
 $tmultikeyarray = explode (",",$parm2); $tfound = "0";
 foreach ($tmultikeyarray as $tkey ) {
  if ($tkey == $tkeyarray[$ti]) {$tfound = "1"; }
 }
 if ($tfound == "1") {	$tstring .= "<td>x</td>"; }
 else {$tstring .= "<td width = 10></td>";}
 $tstring .= "<td>".$tvaluearray[$ti]."</td>";
 $tstring .= "</tr>";
}
$tstring .= "</table>";
return "$tstring";
}

function XTDTXT ($text) {echo '<td>'.$text.'</td>'."\n"; }
function XTHTXT ($text) {echo '<th>'.$text.'</th>'."\n"; }
function YTDTXT ($text) {return '<td>'.$text.'</td>'."\n"; }
function WTDTXT ($text) {array_push($GLOBALS{'pluginhtmla'}, YTDTXT($text));}
function XTDTXTFIXED ($text,$width) {echo '<td width="'.$width.'">  '.$text.'&nbsp;</td>'."\n"; }
function XTDTXTHIGHLIGHT ($text) {
	if ($GLOBALS{'webstyletroddeven'} == "odd") { $bgtxt = 'style="background-color:#b3ffd9"'; }
	else { $bgtxt = 'style="background-color:#b3ffd9"'; }
	echo '<td '.$bgtxt.' >'.$text.'</td>'."\n";
}

function XTDTXTBACKTXTCOLOR ($text,$parm2,$parm1) {echo '<td style="background-color: '.$parm2.'; color: '.$parm1.';">'.$text.'</td>'."\n"; }
function XTDTXTIDBACKTXTCOLOR ($id,$text,$parm2,$parm1) {echo '<td style="background-color: '.$parm2.'; color: '.$parm1.';"><a id="'.$id.'">'.$text.'</a></td>'."\n"; }
function YTDTXTBACKTXTCOLOR ($text,$parm2,$parm1) {return '<td style="background-color: '.$parm2.'; color: '.$parm1.';">'.$text.'</td>'."\n"; }
function WTDTXTBACKTXTCOLOR ($text,$parm2,$parm1) {array_push($GLOBALS{'pluginhtmla'}, YTDTXTBACKTXTCOLOR($text,$parm2,$parm1));}
function XTDTXTCOLOR ($text,$parm1) {echo '<td style="color: '.$parm1.';">'.$text.'</td>'."\n"; }
function YTDTXTCOLOR ($text, $parm1) {return '<td color="'.$parm1.'">'.$text.'</td>'."\n"; }
function XTDTXTRED ($text) {echo '<td><span style="color: red;">'.$text.'</span></td>'."\n"; }
function XTDTXTAMBER ($text) {echo '<td><span style="color: orange;">'.$text.'</span></td>'."\n"; }
function XTDTXTGREEN ($text) {echo '<td><span style="color: green;">'.$text.'</span></td>'."\n"; }
function XTDTXTID ($id,$text) {echo '<td><a id="'.$id.'">'.$text.'</a></td>'."\n"; }
function XTXTIDUNDERLINE ($id,$text) { echo '<span style="text-decoration: underline;"><a id="'.$id.'">'.$text.'</a></span>'."\n";}
function XTDTXTIDUNDERLINE ($id,$text) {echo '<td><span style="text-decoration: underline;"><a id="'.$id.'">'.$text.'</a></span></td>'."\n"; }
function XTDTXTBOLD ($text) {echo '<td><b>'.$text.'&nbsp;</b></td>'."\n"; }
function XTDTXTWIDTH ($text,$width) {echo '<td width="'.$width.'"> '.$text.'&nbsp;</td>'."\n"; }
function XTDTXTIDWIDTH ($id,$text,$width) {echo '<td width="'.$width.'"><a id="'.$id.'">'.$text.'&nbsp;</a></td>'."\n"; }
function YTDTXTWIDTH ($text,$width) {return '<td style="width: '.$width.'px;"> '.$text.'&nbsp;</td>'."\n"; }
function WTDHTXTWIDTH ($text,$width) {array_push($GLOBALS{'pluginhtmla'}, YTDHTXTWIDTH($text,$width));}
function XTDTXTC ($text) {echo '<td align="center">'.$text.'&nbsp;</td>'."\n"; }
function XTDTXTTOP ($text) {echo '<td valign="top">'.$text.'&nbsp;</td>'."\n"; }
function XTDHTXT ($text) {echo '<th>'.$text.'</th>'."\n"; }
function YTDHTXT ($text) {return '<th>'.$text.'</th>'."\n"; }
function WTDHTXT ($text) {array_push($GLOBALS{'pluginhtmla'}, YTDHTXT($text));}
function XTDHTXTCOLOR ($text, $color) {echo '<th color="'.$color.'">'.$text.'</th>'."\n"; }
function YTDHTXTFIXEDLEFTCOLOR ($text, $width, $color) {return '<th  width="'.$width.'" align="left" color="'.$color.'">'.$text.'</th>'."\n"; }
function YTDHTXTLEFTCOLOR ($text, $color) {return '<th align="left" color="'.$color.'">'.$text.'</th>'."\n"; }
function YTDHTXTTOPLEFTCOLOR ($text, $color) {return '<th valign="top" align="left" color="'.$color.'">'.$text.'</th>'."\n"; }
function XTDHTXTID ($id,$text) {echo '<th><a id="'.$id.'">'.$text.'</a></th>'."\n"; }
function XTDHTXTIDCLASS ($id, $class,$text) {echo '<th><a id="'.$id.'" class="'.$class.'">'.$text.'</a></th>'."\n"; }
function XTDHTXTC ($text) {echo '<th align="center">'.$text.'&nbsp;</th>'."\n"; }
function XTDHTXTFIXED ($text,$width) {echo '<th width="'.$width.'">  '.$text.'&nbsp;</th>'."\n"; }
function XTDHTXTTITLE ($text,$title) {echo '<th title="'.$title.'">  '.$text.'&nbsp;</th>'."\n"; }
function XTDHLINKTXTNEWWINDOW ($link,$text,$title,$winname) {$winname = "_".$winname; echo '<th title="'.$title.'"> <a href="'.$link.'" target="'.$winname.'">'.$text.'</a></th>'."\n"; }
function XTDHTXTSMALLER ($text) {echo '<th> <small>'.$text.'&nbsp; </small></th>'."\n"; }
function XTDHTXTVERTICAL ($text) {echo '<th class="verticalheader"><div><span>'.$text.'</span></div></th>'."\n"; }
# name, value, size, maxlength
function XINTXT ($parm0,$parm1,$parm2,$parm3) {echo '<input type="textbox" class="inputmain" name="'.$parm0.'" value="'.$parm1.'" size="'.$parm2.'" maxlength="'.$parm3.'">'."\n"; }
# id, name, value, size, maxlength
function XINTXTID ($parmid,$parm0,$parm1,$parm2,$parm3) {echo '<input type="textbox" class="inputmain" id="'.$parmid.'" name="'.$parm0.'" value="'.$parm1.'" size="'.$parm2.'" maxlength="'.$parm3.'">'."\n"; }
# name, value, size, maxlength
function XINTXTC ($parm0,$parm1,$parm2,$parm3) {echo '<input type="textbox" class="inputmain" align="center" name="'.$parm0.'" value="'.$parm1.'" size="'.$parm2.'" maxlength="'.$parm3.'">'."\n"; }
# name, value, size, maxlength
function XTDINTXT ($parm0,$parm1,$parm2,$parm3) {echo '<td nowrap valign="top"> <input type="textbox" class="inputmain" name="'.$parm0.'" value="'.$parm1.'" size="'.$parm2.'" maxlength="'.$parm3.'"></td>'."\n"; }
# name, value, size, maxlength
function XTDINTXTBACKCOLOR ($parm0,$parm1,$parm2,$parm3,$bordercolor) {echo '<td nowrap valign="top" style="background-color: '.$bordercolor.';"> <input type="textbox" class="inputmain" name="'.$parm0.'" value="'.$parm1.'" size="'.$parm2.'" maxlength="'.$parm3.'"></td>'."\n"; }
# id, name, value, size, maxlength
function XTDINTXTID ($parm0,$parm1,$parm2,$parm3,$parm4) {echo '<td nowrap valign="top"> <input type="textbox" class="inputmain" id="'.$parm0.'" name="'.$parm1.'" value="'.$parm2.'" size="'.$parm3.'" maxlength="'.$parm4.'"></td>'."\n"; }
# name, value, size, maxlength
function XINPSW ($parm0,$parm1,$parm2,$parm3) {echo '<input type=password name="'.$parm0.'" value="'.$parm1.'" size="'.$parm2.'" maxlength="'.$parm3.'">'."\n"; }
# name, value, size, maxlength
# name, value, size, maxlength
function XTDINPSW ($parm0,$parm1,$parm2,$parm3) {echo '<td> <input type=password name="'.$parm0.'" value="'.$parm1.'" size="'.$parm2.'" maxlength="'.$parm3.'"></td>'."\n"; }
# id, name, value, size, maxlength
function XINPERSONID ($parmid,$parm0,$parm1,$parm2,$parm3) {
    XINTXTID($parmid,$parm0,$parm1,$parm2,$parm3);
    XINBUTTONIDSPECIAL($parmid."_lookupbutton","info","Lookup");XBR();
    XTXTID($parmid."_personlist",View_Person_List($parm3));
}
# id, name, value, size, maxlength
function XTDINPERSONID ($parmid,$parm0,$parm1,$parm2,$parm3) {XTD(); XINPERSONID ($parmid,$parm0,$parm1,$parm2,$parm3); X_TD();}
# name, value
function XTDINTEL ($parm0,$parm1) {
$tela= ""; $teln = "";
if ($parm1 == "") {$tela= ""; $teln = "";}
else {
 $telbits = explode(' ', $parm1);
 if (sizeof($telbits) == 2) {$tela = $telbits[0]; $teln = $telbits[1];}
 if (sizeof($telbits) == 3) {$tela = $telbits[0]." ".$telbits[1]; $teln = $telbits[2];}
}
print '<td nowrap valign="top" >';
print '<input name="'.$parm0.'_CODEpart" value="'.$tela.'" size=6 maxlength=10> ';
print '<input name="'.$parm0.'_NUMpart" value="'.$teln.'" size=6 maxlength=7>';
print ' e.g.  07777 112233';
print "</td>\n";
}
# id, name, value
function XTDINTELID ($parmid,$parm0,$parm1) {
$tela= ""; $teln = "";
if ($parm1 == "") {$tela= ""; $teln = "";}
else {
 $telbits = explode(' ', $parm1);
 if (sizeof($telbits) == 2) {$tela = $telbits[0]; $teln = $telbits[1];}
 if (sizeof($telbits) == 3) {$tela = $telbits[0]." ".$telbits[1]; $teln = $telbits[2];}
}
print '<td nowrap valign="top" >';
print '<input id="'.$parm0.'_CODEpart"  name="'.$parm0.'_CODEpart" value="'.$tela.'" size=6 maxlength=10> ';
print '<input id="'.$parm0.'_NUMpart" name="'.$parm0.'_NUMpart" value="'.$teln.'" size=6 maxlength=7>';
print ' e.g.  07777 112233';
print "</td>\n";
}
function XTEXTAREANEW ($rows,$cols) {echo '<textarea rows="'.$rows.'" cols="'.$cols.'">'."\n"; }
function YTEXTAREANEW ($rows,$cols) {return '<textarea rows="'.$rows.'" cols="'.$cols.'">'."\n"; }
# name, rows, cols  WHAT ABOUT OUTPUT TEXT
function XTEXTAREA ($parm0,$rows,$parm2) {echo '<textarea name="'.$parm0.'" rows="'.$rows.'" cols="'.$parm2.'">'."\n"; }
# name, rows, cols
function XTEXTAREASMALLER ($parm0,$parm1) {echo '<textarea name="'.$parm0.'" rows="'.$parm1.'" cols="'.$parm2.'" style=$Q font-size:8pt; font-family: Arial;$Q>'."\n"; }
# name, rows, cols
function XTEXTAREANOSCROLLSMALLER ($parm0,$parm1,$parm2) {echo '<textarea name="'.$parm0.'" rows="'.$parm1.'" cols="'.$parm2.'" style=$Q overflow:hidden; font-size:8pt; font-family: Arial;$Q>'."\n"; }

function X_TEXTAREA () {echo '</textarea>'."\n"; }
function Y_TEXTAREA () {return '</textarea>'."\n"; }
function W_TEXTAREA () {array_push($GLOBALS{'pluginhtmla'}, Y_TEXTAREA());}
# name, value, rows, cols
function XTDINTEXTAREA ($parm0,$parm1,$parm2,$parm3) {echo '<td> <textarea  class="inputmain" wrap="soft" name="'.$parm0.'" rows="'.$parm2.'" cols="'.$parm3.'">'.$parm1.'</textarea></td>'."\n"; }
# name, value, rows, cols, width
function XTDINTEXTAREAFIXED ($parm0,$parm1,$parm2,$parm3,$parm4) {echo '<td width="'.$parm4.'"> <textarea class="textareamain" wrap=physical name="'.$parm0.'" rows="'.$parm2.'" cols="'.$parm3.'">'.$parm1.'</textarea></td>'."\n"; }
# name, value, rows, cols
function XTDINTEXTAREAC ($parm0,$parm1,$parm2,$parm3) {echo '<td align="center"> <textarea class="textareamain" wrap=physical name="'.$parm0.'" rows="'.$parm2.'" cols="'.$parm3.'">'.$parm1.'</textarea></td>'."\n"; }
# name, value, rows, cols
function XINTEXTAREA ($parm0,$parm1,$parm2,$parm3) {echo '<textarea class="textareamain" name="'.$parm0.'" rows="'.$parm2.'" cols="'.$parm3.'">'.$parm1.'</textarea>'."\n"; }
# name, value, rows, cols
function XINTEXTAREAMCE ($parm0,$parm1,$parm2,$parm3) {echo '<textarea id="mceTextarea" class="mceEditor" name="'.$parm0.'" rows="'.$parm2.'" cols="'.$parm3.'">'.$parm1.'</textarea>'."\n"; }
# id name, value, rows, cols
function XINTEXTAREAMCEID ($parm0,$parm1,$parm2,$parm3) {echo '<textarea id="'.$parm0.'" class="mceEditor" name="'.$parm1.'" rows="'.$parm3.'" cols="'.$parm4.'">'.$parm2.'</textarea>'."\n"; }
# id, name, value, rows, cols
function XINTEXTAREAID ($parmid,$parm0,$parm1,$parm2,$parm3) {echo '<textarea class="textareamain" id="'.$parmid.'" name="'.$parm0.'" rows="'.$parm2.'" cols="'.$parm3.'">'.$parm1.'</textarea>'."\n"; }
# name, value, rows, cols
function XINTEXTAREAFIXED ($parm0,$parm1,$parm2,$parm3) {echo '<textarea class="textareamain" wrap=physical name="'.$parm0.'" rows="'.$parm2.'" cols="'.$parm3.'">'.$parm1.'</textarea>'."\n"; }

function XH1 ($text) {echo '<h1 class="h1main">'.$text.'</h1>'."\n"; }
function YH1 ($text) {return '<h1 class="h1main">'.$text.'</h1>'."\n";}
function WH1 ($text) {array_push($GLOBALS{'pluginhtmla'}, YH1($text));}
function XH2 ($text) {echo '<h2 class="h2main">'.$text.'</h2>'."\n";}
function YH2 ($text) {return '<h2 class="h2main">'.$text.'</h2>'."\n";}
function WH2 ($text) {array_push($GLOBALS{'pluginhtmla'}, YH2($text));}
function XH3 ($text) {echo '<h3 class="h3main">'.$text.'</h3>'."\n";}
function XH3COLOR ($text,$color) {echo '<h3 class="h3main" style="color: '.$color.';">'.$text.'</h3>'."\n";}
function XH3TOP ($text) {echo '<h3 class="h3main" style="margin-top: 0px;">'.$text.'</h3>'."\n";}
function XH3ID ($id, $text) {echo '<h3 class="h3main" id="'.$id.'">'.$text.'</h3>'."\n";} # CHECK
function YH3 ($text) {return '<h3 class="h3main">'.$text.'</h3>'."\n";}
function WH3 ($text) {array_push($GLOBALS{'pluginhtmla'}, YH3($text));}
function XH4 ($text) {echo '<h4 class="h4main">'.$text.'</h4>'."\n";}
function XH4ID ($id, $text) {echo '<h4 class="h4main" id="'.$id.'">'.$text.'</h4>'."\n";} # CHECK
function YH4 ($text) {return '<h4 class="h4main">'.$text.'</h4>'."\n";}
function WH4 ($text) {array_push($GLOBALS{'pluginhtmla'}, YH4($text));}
function XH5 ($text) {echo '<h5 class="h5main">'.$text.'</h5>'."\n";}
function XH5ID ($id, $text) {echo '<h5 class="h5main" id="'.$id.'">'.$text.'</h5>'."\n";} # CHECK
function YH5 ($text) {return '<h5 class="h5main">'.$text.'</h5>'."\n";}
function WH5 ($text) {array_push($GLOBALS{'pluginhtmla'}, YH5($text));}

function XTABLE() { $GLOBALS{'webstyletroddeven'} = "odd"; echo '<table class="tablemain">'."\n"; }
function YTABLE () {$GLOBALS{'webstyletroddeven'} = "odd"; return "<table>\n";}
function WTABLE () {array_push($GLOBALS{'pluginhtmla'}, YTABLE());}
function XTABLEID ($parm0) { $GLOBALS{'webstyletroddeven'} = "odd"; echo '<table id="'.$parm0.'" class="tablemain">'."\n"; }
function XTABLECLASS ($parm0,$parm1) { $GLOBALS{'webstyletroddeven'} = "odd"; echo '<table id="'.$parm0.'" class="'.$parm1.'">'."\n"; }
function XTABLEJQDTID ($id) { echo '<table id="'.$id.'" class="display" cellspacing="0" width="100%">'."\n"; }
function YTABLEJQDTID ($id) { return '<table id="'.$id.'" class="display" cellspacing="0" width="100%">'."\n"; }
function WTABLEJQDTID ($id) {array_push($GLOBALS{'pluginhtmla'}, YTABLEJQDTID($id));}
function XTABLECOMPACTJQDTID ($id) { echo '<table id="'.$id.'" class="display compact" cellspacing="0" width="100%">'."\n"; }
function YTABLECOMPACTJQDTID ($id) { return '<table id="'.$id.'" class="display compact" cellspacing="0" width="100%">'."\n"; }
function WTABLECOMPACTJQDTID ($id) {array_push($GLOBALS{'pluginhtmla'}, YTABLECOMPACTJQDTID($id));}
function XTABLEFIXEDID ($id, $width) { $GLOBALS{'webstyletroddeven'} = "odd"; echo '<table id="'.$id.'" class="tablemain" width="'.$width.'">'."\n"; }
function XTABLENAV () { echo '<table border="0" cellspacing="0" cellpadding="0" valign="top">'."\n"; }
function XTABLEINVISIBLE () {$GLOBALS{'webstyletableinvisible'} = "1"; echo '<table class="tableinvisible" border="0" cellspacing="3" cellpadding="2">'."\n"; }
function YTABLEINVISIBLE () {$GLOBALS{'webstyletableinvisible'} = "1"; return '<table class="tableinvisible" border="0" cellspacing="3" cellpadding="2">'."\n"; }
function WTABLEINVISIBLE () {array_push($GLOBALS{'pluginhtmla'}, YTABLEINVISIBLE());}
function X_TABLE () {$GLOBALS{'webstyletableinvisible'} = "0"; echo '</table>'."\n"; }
function Y_TABLE () {$GLOBALS{'webstyletableinvisible'} = "0"; return  "</table>\n";}
function W_TABLE () {array_push($GLOBALS{'pluginhtmla'}, Y_TABLE());}
function XTR () {TRODDEVEN(); echo '<tr '.TRCLASS().'>'."\n"; }
function YTR () {TRODDEVEN(); return  '<tr '.TRCLASS().'>'."\n";}
function WTR () {array_push($GLOBALS{'pluginhtmla'}, YTR());}
function XTRINVISIBLE () {echo '<tr>'."\n"; }
function XTRJQDT() {echo '<tr>'."\n"; }
function YTRJQDT() {return '<tr>'."\n"; }
function WTRJQDT () {array_push($GLOBALS{'pluginhtmla'}, YTRJQDT());}
function XTRID ($id) {TRODDEVEN(); echo '<tr '.TRCLASS().' id="'.$id.'">'."\n"; }
function XTRC () {TRODDEVEN(); echo '<tr '.TRCLASS().' align="center">'."\n";}
function TRODDEVEN () {
 if ( $GLOBALS{'webstyletableinvisible'} != "1" ) {
  if ( $GLOBALS{'webstyletroddeven'} == "odd" ) { $GLOBALS{'webstyletroddeven'} = "even";} else {$GLOBALS{'webstyletroddeven'} = "odd";}
 }
}
function TRCLASS () {if ( $GLOBALS{'webstyletableinvisible'} == "1" ) {return "";} else {return ' class="'.$GLOBALS{'webstyletroddeven'}.'"';}}
function XTREVEN () { echo '<tr class="even">'."\n"; }
function XTRODD () { echo '<tr class="odd">'."\n";}
function X_TR () {echo '</tr>'."\n"; }
function Y_TR () {return  "</tr>\n";}
function W_TR () {array_push($GLOBALS{'pluginhtmla'}, Y_TR());}
function XTD () {echo '<td>'."\n";}
function YTD () {return  '<td>'."\n"; }
function WTD () {array_push($GLOBALS{'pluginhtmla'}, YTD());}
function XTDID ($id) {echo '<td id="'.$id.'" >'."\n"; }
function XTDBACKCOLOR ($bgcolor) {echo '<td  style="background-color:'.$bgcolor.'">'."\n";}
function YTDBACKCOLOR ($bgcolor) {return '<td  style="background-color:'.$bgcolor.'">'."\n";}
function WTDBACKCOLOR ($bgcolor) {array_push($GLOBALS{'pluginhtmla'}, YTDBACKCOLOR ($bgcolor));}
function XTDBACKTXTCOLOR ($bgcolor, $color) {echo '<td style="background-color: '.$bgcolor.'; color: '.$color.';">'."\n";}
function YTDBACKTXTCOLOR ($bgcolor, $color) {return '<td style="background-color: '.$bgcolor.'; color: '.$color.';">'."\n";}
function WTDBACKTXTCOLOR ($bgcolor, $color) {array_push($GLOBALS{'pluginhtmla'}, YTDBACKTXTCOLOR ($bgcolor, $color));}
function XTDFIXED ($width) {echo '<td width="'.$width.'">'."\n";}
function YTDFIXED ($width) {return '<td width="'.$width.'">'."\n"; }
function WTDFIXED ($width) {array_push($GLOBALS{'pluginhtmla'}, YTDFIXED($width));}
function XTDC () {echo '<td align="center">'."\n";}
function XTDTOP () {echo '<td valign="top">'."\n";}
function YTDTOP () {return '<td valign="top" >'."\n";}
function WTDTOP () {array_push($GLOBALS{'pluginhtmla'}, YTDTOP());}
function XTDMIDDLE () {echo '<td valign="middle">'."\n";}
function XTDBOTTOM () {echo '<td valign="bottom">'."\n";}
function XTDTOPWIDTH ($width) {echo '<td valign="top" width="'.$width.'">'."\n";}
function YTDTOPWIDTH ($width) {return '<td valign="top" width="'.$width.'">'."\n";}
function WTDTOPWIDTH ($width) {array_push($GLOBALS{'pluginhtmla'}, YTDTOPWIDTH($width));}
function X_TD () {echo '</td>'."\n"; }
function Y_TD () {return  "</td>\n";}
function W_TD () {array_push($GLOBALS{'pluginhtmla'}, Y_TD());}

function XTHEAD () {echo  '<thead>'."\n"; }
function YTHEAD () {return  '<thead>'."\n"; }
function WTHEAD () {array_push($GLOBALS{'pluginhtmla'}, YTHEAD());}
function X_THEAD () {echo  "</thead>\n";}
function Y_THEAD () {return  "</thead>\n"; }
function W_THEAD () {array_push($GLOBALS{'pluginhtmla'}, Y_THEAD());}
function XTBODY () {echo  '<tbody>'."\n"; }
function YTBODY () {return  '<tbody>'."\n"; }
function WTBODY () {array_push($GLOBALS{'pluginhtmla'}, YTBODY());}
function X_TBODY () {echo  "</tbody>\n";}
function Y_TBODY () {return  "</tbody>\n";}
function W_TBODY () {array_push($GLOBALS{'pluginhtmla'}, Y_TBODY());}
function XTFOOT () {echo  '<tfoot>'."\n"; }
function YTFOOT () {return  '<tfoot>'."\n"; }
function WTFOOT () {array_push($GLOBALS{'pluginhtmla'}, YTFOOT());}
function X_TFOOT () {echo  "</tfoot>\n";}
function Y_TFOOT () {return  "</tfoot>\n";}
function W_TFOOT () {array_push($GLOBALS{'pluginhtmla'}, Y_TFOOT());}
function XTH () {echo '<th>'."\n";}
function X_TH () {echo '</th>'."\n";}
function XTHC () {$GLOBALS{'webstyletroddeven'} = "odd"; echo '<th align="center" valign="top">'."\n";}

function XIMGFLEX ($imagesrc) {echo '<img src="'.$imagesrc.'" />'."\n"; }
function XIMGWIDTH ($imagesrc,$width) {echo '<img src="'.$imagesrc.'" width="'.$width.'" />'."\n"; }
function YIMGWIDTH ($imagesrc,$width) {return '<img src="'.$imagesrc.'" width="'.$width.'" />'."\n"; }
function WIMGWIDTH ($imagesrc,$width) {array_push($GLOBALS{'pluginhtmla'}, YIMGWIDTH($imagesrc,$width));}

function XIMGCLASSALT ($imagesrc,$class,$alt) {echo '<img class="'.$class.'" src="'.$imagesrc.'" alt="'.$alt.'"/>'."\n"; }
function XIMGFLEXID ($id,$imagesrc) {echo '<img id="'.$id.'" src="'.$imagesrc.'" border="0" />'."\n"; }
function YIMGFLEX ($imagesrc) {$outstr = '<img src="'.$imagesrc.'" />'."\n"; return $outstr;}
function WIMGFLEX ($imagesrc) {array_push($GLOBALS{'pluginhtmla'}, YIMGFLEX($imagesrc));}
function XIMG ($imagesrc,$width,$height,$border) {echo '<img src="'.$imagesrc.'" width="'.$width.'" height="'.$height.'"  border="'.$border.'">'."\n"; }
function YIMG ($imagesrc,$width,$height,$border) {return '<img src="'.$imagesrc.'" width="'.$width.'" height="'.$height.'"  border="'.$border.'">'."\n"; }
function WIMG ($imagesrc,$width,$height,$border) {array_push($GLOBALS{'pluginhtmla'}, YIMG($imagesrc,$width,$height,$border));}
function XIMGID ($id,$imagesrc,$width,$height,$border) {
    if ($height != "") {$heighttext = ' height="'.$height.'"'; } else {$heighttext = ""; }
    echo '<img id="'.$id.'" src="'.$imagesrc.'" width="'.$width.'"'.$heighttext.' border="'.$border.'">'."\n"; }
function XTDIMG ($imagesrc,$width,$height,$border) {echo '<td> <img src="'.$imagesrc.'" width="'.$width.'" height="'.$height.'" border="'.$border.'" /></td>'."\n"; }
function XTDIMGWIDTH ($imagesrc,$width) {echo '<td> <img src="'.$imagesrc.'" width="'.$width.'" /></td>'."\n"; }
function XTDIMGFLEX ($imagesrc) {echo '<td> <img src="'.$imagesrc.'" /></td>'."\n"; }

function XGRAPHBASE64PNG($reportid) {
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
            print '<img src="data:image/png;base64,' . $str . '" width="100%" />'."\n";
        } else {
            XPTXT('Report not found');
        }
    }
}

function XBUTTON ($text) {echo '<button type="button" class="btn btn-primary">'.$text.'</button>'."\n"; }
function XBUTTONSPECIAL ($text,$class) {echo '<button type="button" class="btn btn-'.$class.'">'.$text.'</button>'."\n"; }

function XLINKIMGFLEXNEWWINDOW ($link,$imagesrc,$window){
     $winname = "_".$window; echo '<a href="'.$link.'" target="'.$winname.'"><img src="'.$imagesrc.'" border=0 /></a>'."\n";
}
function XLINKIMG ($link,$imagesrc,$width,$height,$border) {echo '<a href="'.$link.'"><img src="'.$imagesrc.'" width="'.$width.'" height="'.$height.'" border="'.$border.'" /></a>'."\n"; }
function XLINKIMGID ($link,$id,$imagesrc,$width,$height,$border) {echo '<a href="'.$link.'"><img  id="'.$id.'" src="'.$imagesrc.'" width="'.$width.'" height="'.$height.'" border="'.$border.'" /></a>'."\n"; }
function YLINKIMG ($link,$imagesrc,$width,$height,$border) {$outstr = '<a href="'.$link.'"><img src="'.$imagesrc.'" width="'.$width.'" height="'.$height.'" border="'.$border.'" /></a>'."\n"; return $outstr; }
function YLINKIMGWIDTH ($link,$imagesrc,$width) {
    $outstr = '<a href="'.$link.'"><img src="'.$imagesrc.'" width="'.$width.'" /></a>'."\n"; return $outstr;
}
function XLINKIMGFLEX ($link,$imagesrc) {echo '<a href="'.$link.'"><img src="'.$imagesrc.'" border=0 /></a>'."\n"; }
function XLINKBUTTON ($link,$text) {echo '<a href="'.$link.'"><button type="button" class="btn btn-primary">'.$text.'</button></a>'."\n"; }
function XLINKBUTTONSPECIAL ($link,$text,$class) {
    echo '<a href="'.$link.'"><button type="button" class="btn btn-'.$class.'">'.$text.'</button></a>'."\n";
}
# link, text, class, tooltip
function XLINKBUTTONSPECIALTOOLTIP ($link,$text,$class,$tooltip) {
    echo '<a href="'.$link.'"><button type="button" class="btn btn-'.$class.'" data-toggle="tooltip" title="'.$tooltip.'" >'.$text.'</button></a>'."\n";
}
function XLINKBUTTONNEWWINDOW ($link,$text,$window) {$winname = "_".$window; echo '<a href="'.$link.'" target="'.$winname.'"><button type="button" class="btn btn-primary" >'.$text.'</button></a>'."\n"; }
function YLINKBUTTONNEWWINDOW ($link,$text,$window) {$winname = "_".$window; return '<a href="'.$link.'" target="'.$winname.'"><button type="button" class="btn btn-primary" >'.$text.'</button></a>'."\n"; }
function WLINKBUTTONNEWWINDOW ($link,$text,$window) {array_push($GLOBALS{'pluginhtmla'}, YLINKBUTTONNEWWINDOW ($link,$text,$window));}
function XLINKBUTTONSPECIALNEWWINDOW ($link,$text,$class,$window) {$winname = "_".$window; echo '<a href="'.$link.'" target="'.$winname.'"><button type="button" class="btn btn-'.$class.'" >'.$text.'</button></a>'."\n"; }
function XLINKBACKBUTTON ($text) {$atext="history.go(-1)"; echo '<a onClick="'.$atext.'"><button type="button" class="btn btn-warning">'.$text.'</button></a>'."\n"; }
function XLINKBUTTONRIGHT ($link,$text) {echo '<div align="right" ><a href="'.$link.'"><button type="button" class="btn btn-primary">'.$text.'</button></a></div>'."\n"; }
function YLINKIMGFLEX ($link,$imagesrc) {$outstr = '<a href="'.$link.'"><img src="'.$imagesrc.'" border=0 /></a>'."\n"; return $outstr; }
function YLINKIMGFLEXNEWWINDOW ($link,$imagesrc,$window){
    $winname = "_".$window; $outstr = '<a href="'.$link.'" target="'.$winname.'"><img src="'.$imagesrc.'" border=0 /></a>'."\n"; return $outstr;
}
function XTDLINKIMGFLEX ($link,$imagesrc) {echo '<td> <a href="'.$link.'"><img src="'.$imagesrc.'" border=0 /></a></td>'."\n"; }
# link imagesrc, imageid
function XTDLINKIMGOVERFLEX ($link,$imagesrc,$parm2) {echo '<td align="center" valign="middle"> <a href="'.$link.'" onmouseover="document.'.$parm2.'.border=1 onmouseout="document.'.$parm2.'.border=0" ><img src="'.$imagesrc.'" border="zero" name="'.$parm2.'" /></a></td>'."\n"; }
# link,imagesrc,width,height,border,wintitle,top,left,height,width
function XLINKIMGNEWPOPUP($parm0,$imagesrc,$width,$height,$parm4,$parm5,$parm6,$parm7,$parm8,$parm9) {
    print '<a><img src="'.$imagesrc.'" width="'.$width.'" height="'.$height.'" border="'.$parm4.'" onclick="return popitup('."'".$parm0."','".$parm5."','".$parm6."','".$parm7."','".$parm8."','".$parm9."'".')'.'" /></a>'."\n";
}

function XLINKIMGNEWWINDOW($link,$imagesrc,$window,$width,$height,$border) {
    $winname = "_".$window; print '<a href="'.$link.'" target="'.$winname.'"><img src="'.$imagesrc.'" width="'.$width.'" height="'.$height.'" border="'.$border.'"></a>'."\n";
}
function YLINKIMGNEWWINDOW($link,$imagesrc,$window,$width,$height,$border) {
    $winname = "_".$window; return '<a href="'.$link.'" target="'.$winname.'"><img src="'.$imagesrc.'" width="'.$width.'" height="'.$height.'" border="'.$border.'"></a>'."\n";
}
function WLINKIMGNEWWINDOW ($link,$imagesrc,$window,$width,$height,$border) {array_push($GLOBALS{'pluginhtmla'}, YLINKIMGNEWWINDOW($link,$imagesrc,$window,$width,$height,$border));}

function XIMGPERSON ( $personid, $width) {
	$from = $GLOBALS{'domainfilepath'}."/personphotos/".$GLOBALS{'person_photo'};
	if (($GLOBALS{'person_photo'} != "")&&(file_exists($from))) {
		$imagefilebits = explode('.', $GLOBALS{'person_photo'});
		$imagetype = $imagefilebits[1];
		$epersonid = XCrypt($personid,"MTNX","encrypt");
		$phototempname = "temp_".$epersonid.'.'.$imagetype;
		$to = $GLOBALS{'domainwwwpath'}."/domain_temp/".$phototempname;
		copy($from, $to);
		$photofullsitename = $GLOBALS{'domainwwwurl'}."/domain_temp/".$phototempname;
		XIMGWIDTH($photofullsitename,$width);
	} else {
		$photofullsitename = $GLOBALS{'site_asseturl'}."/NoPhoto.png";
		XIMGWIDTH($photofullsitename,$width);
	}
}



# id pdfsrc, width, height, border
function XOBJECTID ($parm0,$parm1,$parm2,$parm3,$parm4) {
 if ($parm3 == "") {$heighttext = ' height="'.$parm3.'"'; } else {$heighttext = ""; }
 $obitsa = explode('.', $parm1);
 $typetext = "";
 if (($obitsa[1] == "pdf")||($obitsa[1] == "PDF")) {$typetext  = "application/pdf";}
 print '<object id="'.$parm0.'" type="'.$typetext.'" data="'.$parm1.'" width="'.$parm2.'"'.$heighttext.' border="'.$parm4.'">'."\n";
 # print 'alt : <a href="'.$parm1.'">pdf</a>'."\n";
 print '</object>'."\n";
}
# id pdfsrc
function XOBJECTFLEXID ($parm0,$parm1) {
 print '<object id="'.$parm0.'" type="application/pdf" data="'.$parm1.'">'."\n";
 # print 'alt : <a href="'.$parm1.'">pdf</a>'."\n";
 print '</object>'."\n";
}
# id assetfilename
function XASSETFILEDOWNLOADLINKNEWWINDOWID ($id,$assetfilename) {
    if ( $GLOBALS{'site_clientservermode'} == "Client") {
        $link = $GLOBALS{'site_synchroniseurl'}."/site_php/".$GLOBALS{'codeversion'}."_assetfiledownloadin.php";
        $link = $link.'?ServiceId=dmws&DomainId=dmwsportal&PersonId=&ModeId=1&SessionId=&LoginModeId=1&MenuId='.$GLOBALS{'LOGIN_menu_id'}.'&FrameId='.$GLOBALS{'LOGIN_frame_id'};
    } else {
        $link = YPGMLINK("assetfiledownloadin.php").YPGMSTDPARMS();
    }
    $link = $link.YPGMPARM("AssetFileName",$assetfilename);
    echo '<a  id="'.$id.'" href="'.$link.'" target="download">Download File</a>'."\n";
}
# link, imagename, width, height, border
function XTDLINKIMG ($parm0,$parm1,$parm2,$parm3,$parm4) {echo '<td> <a href="'.$parm0.'"><img src="'.$parm1.'" width="'.$parm2.'" height="'.$parm3.'" border="'.$parm4.'" /></a></td>'."\n"; }
# link, faicon, width, height
function XTDLINKICON ($link,$icon,$width,$height) {echo '<td> <a href="'.$link.'"><i class="fa fa-refresh fa-'.$icon.'" width="'.$width.'" height="'.$height.'" ></i></a></td>'."\n"; }
# link text
function XLINKTXTID ($parm0,$parm1,$parm2) {echo '<a  id="'.$parm0.'" href="'.$parm1.'">'.$parm2.'</a>'."\n"; }
# link text
function XLINKTXT ($parm0,$parm1) {	echo '<a href="'.$parm0.'">'.$parm1.'</a>'."\n";}
# link text
function YLINKTXT ($parm0,$parm1) {$outstr = '<a href="'.$parm0.'">'.$parm1.'</a>'."\n"; return $outstr;}
# link text window
function YLINKTXTNEWWINDOW ($parm0,$parm1,$parm2) {$winname = "_".$parm2; $outstr = '<a href="'.$parm0.'" target="'.$winname.'">'.$parm1.'</a>'."\n"; return $outstr;}
# link text
function YLINKH3 ($parm0,$parm1) {$outstr = '<a href="'.$parm0.'"><h3>'.$parm1.'</h3></a>'."\n"; return $outstr;}
# text
function XLINKBACK ($parm0) {$atext="history.go(-1)"; echo '<a onClick="'.$atext.'">'.$parm0.'</a>'."\n"; }
# link text newwindowname
function XLINKTXTNEWWINDOW ($parm0,$parm1,$parm2) {$winname = "_".$parm2; echo '<a href="'.$parm0.'" target="'.$winname.'">'.$parm1.'</a>'."\n"; }
# link text colour newwindowname
function XLINKTXTCOLORNEWWINDOW ($parm0,$parm1,$parmc,$parm2) {$winname = "_".$parm2; echo '<a href="'.$parm0.'" target="'.$winname.'"><font color="'.$parmc.'">'.$parm1.'</font></a>'."\n"; }
# link text
function XTDLINKTXT ($parm0,$parm1) {echo '<td><a href="'.$parm0.'">'.$parm1.'</a></td>'."\n"; }
# link text
function XTHLINKTXT ($parm0,$parm1) {echo '<th><a href="'.$parm0.'">'.$parm1.'</a></th>'."\n"; }
# link text newwindowname
function XTDLINKTXTNEWWINDOW ($parm0,$parm1,$parm2) {$winname = "_".$parm2; echo '<td> <a href="'.$parm0.'" target="'.$winname.'">'.$parm1.'</a></td>'."\n"; }
# link text newwindowname
function XTDCLASSLINKTXTNEWWINDOW ($class,$parm0,$parm1,$parm2) {
	$winname = "_".$parm2; echo '<td> <a class="'.$class.'" href="'.$parm0.'" target="'.$winname.'">'.$parm1.'</a></td>'."\n";
}
# link text newwindowname
function YCLASSLINKTXTNEWWINDOW ($class,$parm0,$parm1,$parm2) {
	$winname = "_".$parm2; return '<a class="'.$class.'" href="'.$parm0.'" target="'.$winname.'">'.$parm1.'</a>'."\n";
}

function XLINKTXTNEWPOPUP($link,$text,$window,$top,$left,$height,$width) {
    print '<a href="'.$link.'" onclick="return popitup('."'".$link."','".$window."','".$top."','".$left."','".$height."','".$width."'".')">'.$text."</a>\n";
}
function YLINKTXTNEWPOPUP($link,$text,$window,$top,$left,$height,$width) {
    return '<a href="'.$link.'" onclick="return popitup('."'".$link."','".$window."','".$top."','".$left."','".$height."','".$width."'".')">'.$text."</a>\n";
}
function WLINKTXTNEWPOPUP ($link,$text,$window,$top,$left,$height,$width) {array_push($GLOBALS{'pluginhtmla'}, YLINKTXTNEWPOPUP($link,$text,$window,$top,$left,$height,$width));}

function XTDLINKTXTNEWPOPUP($link,$text,$window,$parm3,$left,$height,$width) {
    print '<td><a href="'.$link.'" onclick="return popitup('."'".$link."','".$window."','".$top."','".$left."','".$height."','".$width."'".')">'.$text."</a></td>\n";
}

# link text
function XLINKH3 ($parm0,$parm1) {	echo '<a href="'.$parm0.'"><h3>'.$parm1.'</h3></a>'."\n";}
# selectname
function XINSELECT ($parm0) {echo '<select id="'.$parm0.'" name="'.$parm0.'">'."\n"; }
# value, selected, text
function XINOPTION ($parm0,$parm1,$parm2) {echo '<option value="'.$parm0.'" '.$parm1.'>'.$parm2.'</option>'."\n"; }
function XIN_SELECT () {echo '</select>'."\n"; }
# hash id/name value
function XINSELECTHASH ($parm0,$parm1,$parm2) {
XINSELECT($parm1);if ($parm2 == "") {XINOPTION("","selected","?");}
foreach ($parm0 as $key=>$selecttext ) {
 $tselected = "";
 if ($parm2 == $key){$tselected = "selected";}
 XINOPTION($key,$tselected,$selecttext);
}
XIN_SELECT();}
# hash name value
function XTDINSELECTHASH ($parm0,$parm1,$parm2) {
XTD(); XINSELECTHASH($parm0,$parm1,$parm2); X_TD();}
# hash name value
function XTHINSELECTHASH ($parm0,$parm1,$parm2) {
XTH(); XINSELECTHASH($parm0,$parm1,$parm2); X_TH();
}
function XINBUTTONID ($parm0,$parm1) {print '<button id="'.$parm0.'" type="button" class="btn btn-primary">'.$parm1.'</button>'."\n"; }
function XINBUTTONIDSPECIAL ($parm0,$parm1,$parm2) {print '<button id="'.$parm0.'" type="button" class="btn btn-'.$parm1.'">'.$parm2.'</button>'."\n"; }
function YINBUTTONIDSPECIAL ($parm0,$parm1,$parm2) {return '<button id="'.$parm0.'" type="button" class="btn btn-'.$parm1.'">'.$parm2.'</button>'."\n"; }
function WINBUTTONIDSPECIAL ($parm0,$parm1,$parm2) {array_push($GLOBALS{'pluginhtmla'}, YINBUTTONIDSPECIAL($parm0,$parm1,$parm2));}
// function XINBUTTONIDSPINNER ($parm0,$parm1) {print '<button id="'.$parm0.'" type="button" class="btn btn-primary has-spinner">'.'<span class="spinner"><i class="fa fa-refresh fa-spin"></i></span>&nbsp;'.$parm1.'</button>'."\n"; }
function XINBUTTONIDSPECIALTOOLTIP ($parm0,$parm1,$parm2,$parm3) {print '<button id="'.$parm0.'" type="button" class="btn btn-'.$parm1.'" data-toggle="tooltip" title="'.$parm3.'">'.$parm2.'</button>'."\n";}
//print '<button id="'.$id.'" type="button" class="btn btn-'.$type.'" data-toggle="tooltip" title="'.$tooltip.'" >'.$text.'</button>'."\n";}
function XINBUTTONIDSPINNER ($parm0,$parm1) {
    print '<button id="'.$parm0.'" type="button" class="btn btn-primary" style="display: none;" >'.'<span><i class="fa fa-refresh fa-spin"></i></span>&nbsp;'.$parm1.'</button>'."\n";
}
function XINBUTTONIDCLASS ($parm0,$parm1,$parm2) {print '<button id="'.$parm0.'" class="'.$parm1.' btn btn-primary" type="button" class="btn btn-primary">'.$parm2.'</button>'."\n"; }
function XINBUTTONIDCLASSSPECIAL ($parm0,$parm1,$parm2,$parm3) {print '<button id="'.$parm0.'" class="'.$parm1.' btn btn-'.$parm2.'" type="button" >'.$parm3.'</button>'."\n"; }
function XTDINBUTTONID ($parm0,$parm1) {print '<td><button id="'.$parm0.'" type="button" class="btn btn-primary">'.$parm1.'</button></td>'."\n"; }
function XTDINBUTTONIDSPECIAL ($parm0,$parm1,$parm2) {print '<td><button id="'.$parm0.'" type="button" class="btn btn-'.$parm1.'">'.$parm2.'</button></td>'."\n"; }
function YTDINBUTTONIDSPECIAL ($parm0,$parm1,$parm2) {return '<td><button id="'.$parm0.'" type="button" class="btn btn-'.$parm1.'">'.$parm2.'</button></td>'."\n"; }
function WTDINBUTTONIDSPECIAL ($parm0,$parm1,$parm2) {array_push($GLOBALS{'pluginhtmla'}, YTDINBUTTONIDSPECIAL($parm0,$parm1,$parm2));}
# buttontext
function XINBUTTONCLOSEWINDOW ($parm0) {
    print '<div align="right"><button type="button" class="btn btn-primary" onclick="javascript:window.close()">'.$parm0.'</button></div>'."\n";
}
# buttontext
function XINBUTTONCLOSEWINDOWLEFT ($parm0) {
    print '<div align="left"><button type="button" class="btn btn-primary" onclick="javascript:window.close()">'.$parm0.'</button></div>'."\n";
}
# buttontext
function XINBUTTONBACK ($parm0) {
	print '<button type="button" class="btn btn-primary" onClick="history.go(-1)">'.$parm0.'</button>'."\n";
}
function YINSELECT ($parm0) {return '<select id="'.$parm0.'" name="'.$parm0.'">'."\n"; }
# value, selected, text
function YINOPTION ($parm0,$parm1,$parm2) {return '<option value="'.$parm0.'" '.$parm1.'>'.$parm2.'</option>'."\n"; }
function YIN_SELECT () {return '</select>'."\n"; }
# hash id/name value
function YINSELECTHASH ($parm0,$parm1,$parm2) {
$thtml = "";
$thtml .= YINSELECT($parm1);if ($parm2 == "") {$thtml .= YINOPTION("","selected","?");}
foreach ($parm0 as $key=>$selecttext ) {
 $tselected = "";
 if ($parm2 == $key){$tselected = "selected";}
 $thtml .= YINOPTION($key,$tselected,$selecttext);
}
$thtml .= YIN_SELECT();
return $thtml;
}
# hash name value
function YTDINSELECTHASH ($parm0,$parm1,$parm2) {
$thtml = "";
$thtml .= YTD(); $thtml .= YINSELECTHASH($parm0,$parm1,$parm2); $thtml .= Y_TD();
return $thtml;
}

# name, value, selected, text
function XINRADIO ($parm0,$parm1,$parm2,$parm3) {echo '<input type="radio" name="'.$parm0.'" value="'.$parm1.'" '.$parm2.'/>&nbsp;'.$parm3."\n"; }
# name, value, selected, text
function XTDINRADIO ($parm0,$parm1,$parm2,$parm3) {XTD(); XINRADIO($parm0,$parm1,$parm2,$parm3); X_TD();}
# hash name value
function XINRADIOHASH ($parm0,$parm1,$parm2) {
XDIV($parm1."div","");
foreach ($parm0 as $key=>$selecttext ) {
 $tselected = "";
 if ($parm2 == $key){$tselected = "checked";}
 XINRADIO($parm1,$key,$tselected,$selecttext);
 XBR();
}
X_DIV($parm1."div");
}

# hash name value
function XINRADIOHASHHORIZONTAL ($parm0,$parm1,$parm2) {
XDIV($parm1."div","");
foreach ($parm0 as $key=>$selecttext ) {
 $tselected = "";
 if ($parm2 == $key){$tselected = "checked";}
 XINRADIO($parm1,$key,$tselected,$selecttext);
}
X_DIV($parm1."div");
}

function XTDINRADIOHASH ($parm0,$parm1,$parm2) {
XTD(); XINRADIOHASH($parm0,$parm1,$parm2); X_TD();}
function XTDINRADIOHASHHORIZONTAL ($parm0,$parm1,$parm2) {
XTD(); XINRADIOHASHHORIZONTAL($parm0,$parm1,$parm2); X_TD();
}
# id, name, value, selected, text
function XINRADIOID ($parmid,$parm0,$parm1,$parm2,$parm3) {	echo '<input type="radio" id="'.$parmid.'" name="'.$parm0.'" value="'.$parm1.'" '.$parm2.'/>&nbsp;'.$parm3."\n"; }
# id, name, value, selected, text
function XTDINRADIOID ($parmid,$parm0,$parm1,$parm2,$parm3) { XTD(); XINRADIOID($parmid,$parm0,$parm1,$parm2,$parm3); X_TD(); }
# id, name value
function XINRADIOHASHID ($parmid,$parm0,$parm1,$parm2) {
XDIV($parm1."div","");
foreach ($parm0 as $key=>$selecttext ) {
 $tselected = "";
 if ($parm2 == $key){ $tselected = "checked";	}
 XINRADIOID($parmid.$selecttext,$parm1,$key,$tselected,$selecttext);
 XBR();
}
X_DIV($parm1."div");
}
function XTDINRADIOHASHID ($parmid,$parm0,$parm1,$parm2) {
XTD(); XINRADIOHASHID($parmid,$parm0,$parm1,$parm2); X_TD();
}

function XINCHECKBOX ($name,$value,$checked,$text) {
echo '<input type="checkbox" name="'.$name.'" value="'.$value.'" '.$checked.'/>&nbsp;'.$text."\n"; }
# name, value, checked, text
function XTDINCHECKBOX ($parm0,$parm1,$parm2,$parm3) {echo '<td> <input type="checkbox" id="'.$parm0.'" name="'.$parm0.'" value="'.$parm1.'" '.$parm2.'/>&nbsp;'.$parm3.'</td>'."\n"; }

# name, existingvalue, text
function XINCHECKBOXYESNO ($parm0,$parm1,$parm2) {
 XINHID($parm0, "No");
 $tselected = ""; if ( $parm1 == "Yes" ) {$tselected = "checked";}
 echo '<input type="checkbox" name="'.$parm0.'" value="Yes" '.$tselected.'/>&nbsp;'.$parm2."\n";
}
# id, name, existingvalue, text
function XINCHECKBOXYESNOID ($parmid,$parm0,$parm1,$parm2) {
 XINHIDID($parmid."_hidden",$parm0,"No");
 $tselected = ""; if ( $parm1 == "Yes" ) {$tselected = "checked";}
 echo '<input type="checkbox" id="'.$parmid.'" name="'.$parm0.'" value="Yes" '.$tselected.'/>&nbsp;'.$parm2."\n";
}
function XTDINCHECKBOXYESNOID ($parmid,$parm0,$parm1,$parm2) {
XTD(); XINCHECKBOXYESNOID($parmid,$parm0,$parm1,$parm2); X_TD();
}

function XINCHECKBOXCONFIRMACTION ($parm0,$parm1,$parm2) {
 XINHID($parm0, "No");
 $tselected = ""; if ( $parm1 == "Yes" ) {$tselected = "checked";}
 echo '<input id="ConfirmActionTestBox" type="checkbox" name="'.$parm0.'" value="Yes" '.$tselected.'/>&nbsp;'.$parm2."\n";
}
# name, existingalue, text
function XTDINCHECKBOXYESNO ($parm0,$parm1,$parm2) {
XTD(); XINCHECKBOXYESNO($parm0,$parm1,$parm2); X_TD();}
# name, existingvalue, text
function XINCHECKBOXYN ($parm0,$parm1,$parm2) {
 XINHID($parm0, "N");
 $tselected = ""; if ( $parm1 == "Y" ) {$tselected = "checked";}
 echo '<input type="checkbox" name="'.$parm0.'" value="Y" '.$tselected.'/>&nbsp;'.$parm2."\n";
}
# id, name, existingvalue, text
function XINCHECKBOXYNID ($parmid,$parm0,$parm1,$parm2) {
 XINHID($parm0, "N");
 $tselected = ""; if ( $parm1 == "Y" ) {$tselected = "checked";}
 echo '<input type="checkbox" id="'.$parmid.'" name="'.$parm0.'" value="Y" '.$tselected.'/>&nbsp;'.$parm2."\n";
}
# name, existingalue, text
function XTDINCHECKBOXYN ($parm0,$parm1,$parm3) {
XTD(); XINCHECKBOXYN($parm0,$parm1,$parm2); X_TD();}

# id, name, existingvalue, text
function XINCHECKBOXYNULLID ($parmid,$parm0,$parm1,$parm2) {
 XINHIDID($parmid."_hidden",$parm0,"");
 $tselected = ""; if ( $parm1 == "Y" ) {$tselected = "checked";}
 echo '<label><input type="checkbox" id="'.$parmid.'" name="'.$parm0.'" value="Y" '.$tselected.'/>&nbsp;'.$parm2."</label>\n";
}
function XTDINCHECKBOXYNULLID ($parmid,$parm0,$parm1,$parm2) {
XTD(); XINCHECKBOXYNULLID($parmid,$parm0,$parm1,$parm2); X_TD();
}

# hash name valuelist
function XINCHECKBOXHASH ($parm0,$parm1,$parm2) {
XINHID($parm1, "");
$vbits = explode(',', $parm2);
XDIV($parm1."div","");
foreach ($parm0 as $key=>$selecttext ) {
 $tselected = "";
 foreach ($vbits as $vbit ) {
 	if ($vbit == $key){$tselected = "checked";}
 }
 echo '<input type="checkbox" name="'.$parm1.'[]" value="'.$key.'" '.$tselected.'/>&nbsp;'.$selecttext."\n";
 XBR();
}
X_DIV($parm1."div");
}
# hash name valuelist
function XTDINCHECKBOXHASH ($parm0,$parm1,$parm2) {
XTD(); XINCHECKBOXHASH($parm0,$parm1,$parm2); X_TD();}

# id, name, value, checked, text
function XINCHECKBOXID ($parmid,$parm0,$parm1,$parm2,$parm3) {
echo '<input type="checkbox" id="'.$parmid.'" name="'.$parm0.'" value="'.$parm1.'" '.$parm2.'/>&nbsp;'.$parm3."\n"; }
# id, name, value, checked, text
function YINCHECKBOXID ($parmid,$parm0,$parm1,$parm2,$parm3) {
return '<input type="checkbox" id="'.$parmid.'" name="'.$parm0.'" value="'.$parm1.'" '.$parm2.'/>&nbsp;'.$parm3."\n";
}

# checkboxname, value, checked, text
function XTDINCHECKBOXID ($parmid,$parm0,$parm1,$parm2,$parm3) {echo '<td> <input type="checkbox" id="'.$parm0.'" name="'.$parm0.'" value="'.$parm1.'" '.$parm2.'/>&nbsp;'.$parm3.'</td>'."\n"; }

# id inputname maxsize tempprefix(eg _temp) prefix
function XINFILEID ($parm0,$parm1,$parm2) {XINHID("MaxSize",$parm2); echo '<input type="file" id="'.$parm0.'" name="'.$parm1.'">'."\n"; }
# inputname maxsize
function XINFILE ($parm0,$parm1) {XINHID($parm0."MaxSize",$parm1); echo '<input type="file" id="'.$parm0.'" name="'.$parm0.'">'."\n"; }
# inputname maxsize
function XTDINFILE ($parm0,$parm1) {XINHID($parm0."MaxSize",$parm1); echo '<td> <input type="file" name="'.$parm0.'"></td>'."\n"; }
# inputname maxsize filename
function XTDINFILEPRESET ($parm0,$parm1,$parm2) {XINHID($parm0."MaxSize",$parm1); echo '<td> <input type="file" name="'.$parm0.'" value="'.$parm2.'"></td>'."\n"; }
# submitname
function XINSUBMIT ($parm0) {echo '<input type="submit" class="btn btn-primary" value="'.$parm0.'">'."\n"; }

# id submitname
function XINSUBMITID ($parm0,$parm1) {echo '<input id="'.$parm0.'" type="submit" class="btn btn-primary" value="'.$parm1.'">'."\n"; }
# submitname
function XTDINSUBMIT ($parm0) {echo '<td> <input type="submit" class="btn btn-primary" value="'.$parm0.'"></td>'."\n"; }
# name text
function XINSUBMITNAME ($parm0,$parm1) {echo '<input id="'.$parm0.'" name="'.$parm0.'" type="submit" class="btn btn-primary" value="'.$parm1.'">'."\n"; }
# text name/id
function XTDINSUBMITNAME ($parm0,$parm1) {echo '<td> <input type="submit" class="btn btn-primary" id="'.$parm1.'" name="'.$parm1.'" value="'.$parm0.'"></td>'."\n"; }
# program, id
function XFORM ($parm0, $parm1) {
$pbits = explode('.', $parm0);
if ($pbits[1] == "cgi") {$tpgmpath = $GLOBALS{'site_perlurl'};}
if ($pbits[1] == "php") {$tpgmpath = $GLOBALS{'site_phpurl'};}
echo '<form name="'.$parm1.'" action="'.$tpgmpath.'/'.$GLOBALS{'codeversion'}.'_'.$parm0.'" method=post>'."\n";
}
# program, window, id
function XFORMNEWWINDOW ($parm0, $parm1, $parm2) {
$pbits = explode('.', $parm0);
if ($pbits[1] == "cgi") {$tpgmpath = $GLOBALS{'site_perlurl'};}
if ($pbits[1] == "php") {$tpgmpath = $GLOBALS{'site_phpurl'};}
echo '<form name="'.$parm2.'" action="'.$tpgmpath.'/'.$GLOBALS{'codeversion'}.'_'.$parm0.'" method=post target="'.$parm1.'"'.">\n";
}
# program, id
function XFORMUPLOAD ($parm0, $parm1) {
$pbits = explode('.', $parm0);
if ($pbits[1] == "cgi") {$tpgmpath = $GLOBALS{'site_perlurl'};}
if ($pbits[1] == "php") {$tpgmpath = $GLOBALS{'site_phpurl'};}
echo '<form id="'.$parm1.'"  action="'.$tpgmpath.'/'.$GLOBALS{'codeversion'}.'_'.$parm0.'" method=post enctype="multipart/form-data">'."\n";
}
# program, window, id
function XFORMUPLOADNEWWINDOW ($parm0, $parm1, $parm2) {
    $pbits = explode('.', $parm0);
    if ($pbits[1] == "cgi") {$tpgmpath = $GLOBALS{'site_perlurl'};}
    if ($pbits[1] == "php") {$tpgmpath = $GLOBALS{'site_phpurl'};}
    echo '<form id="'.$parm1.'"  action="'.$tpgmpath.'/'.$GLOBALS{'codeversion'}.'_'.$parm0.'" method=post enctype="multipart/form-data" target="'.$parm1.'">'."\n";
}
# program, id
function XFORMDROPZONE ($parm0, $parm1) {
$pbits = explode('.', $parm0);
if ($pbits[1] == "cgi") {$tpgmpath = $GLOBALS{'site_perlurl'};}
if ($pbits[1] == "php") {$tpgmpath = $GLOBALS{'site_phpurl'};}
// echo '<form id="'.$parm1.'" class="dropzone" method=post enctype="multipart/form-data" action="'.$tpgmpath.'/'.$GLOBALS{'codeversion'}.'_'.$parm0.'" >'."\n";
echo '<form id="'.$parm1.'" class="dropzone" method="post" enctype="multipart/form-data" action="'.$tpgmpath.'/'.$GLOBALS{'codeversion'}.'_'.$parm0.'" >'."\n";

}
# name, value
function XINHID ($parm0,$parm1) {echo '<input type=hidden id="'.$parm0.'" name="'.$parm0.'" value="'.$parm1.'">'."\n"; }
# id, name, value
function XINHIDID ($parm0,$parm1,$parm2) {echo '<input type=hidden id="'.$parm0.'" name="'.$parm1.'" value="'.$parm2.'">'."\n"; }
# id, name, value
function XINHIDIDDQ ($parm0,$parm1,$parm2) {echo '<input type=hidden id="'.$parm0.'" name="'.$parm1.'" value='."'".$parm2."'".'>'."\n"; }
# id, name, value
# common std parameters
function XINSTDHID () {
XINHID("ServiceId",$GLOBALS{'LOGIN_service_id'});XINHID("DomainId",$GLOBALS{'LOGIN_domain_id'});XINHID("ModeId",$GLOBALS{'LOGIN_mode_id'});
XINHID("PersonId",$GLOBALS{'LOGIN_person_id'});XINHID("SessionId",$GLOBALS{'LOGIN_session_id'});
XINHID("LoginModeId",$GLOBALS{'LOGIN_loginmode_id'});XINHID("MenuId",$GLOBALS{'LOGIN_menu_id'});XINHID("FrameId",$GLOBALS{'LOGIN_frame_id'});
if ( $GLOBALS{'LOGIN_orgtype_id'} != "" ) { XINHID("OrgTypeId",$GLOBALS{'LOGIN_orgtype_id'}); }
if ( $GLOBALS{'LOGIN_org_id'} != "" ) { XINHID("OrgId",$GLOBALS{'LOGIN_org_id'}) ;}
}
# min std parameters
function XINMINHID () {
XINHID("ServiceId",$GLOBALS{'LOGIN_service_id'});XINHID("DomainId",$GLOBALS{'LOGIN_domain_id'});XINHID("ModeId",$GLOBALS{'LOGIN_mode_id'});
XINHID("LoginModeId",$GLOBALS{'LOGIN_loginmode_id'});XINHID("MenuId",$GLOBALS{'LOGIN_menu_id'});XINHID("FrameId",$GLOBALS{'LOGIN_frame_id'});
}
function X_FORM () {echo '</form>'."\n"; }

# program name
function YPGMLINK ($parm0) {
$pbits = explode('.', $parm0);
if ($pbits[1] == "cgi") {$tpgmpath = $GLOBALS{'site_perlurl'};}
if ($pbits[1] == "php") {$tpgmpath = $GLOBALS{'site_phpurl'};}
$outstr = $GLOBALS{'site_protocol'}.":".$tpgmpath."/".$GLOBALS{'codeversion'}."_".$parm0."?";
return $outstr;}

# program name
function YEXTPGMLINK ($parm0) {
$pbits = explode('.', $parm0);
if ($pbits[1] == "cgi") {$tpgmpath = $GLOBALS{'site_perlurl'};}
if ($pbits[1] == "php") {$tpgmpath = $GLOBALS{'site_phpurl'};}
$outstr = $GLOBALS{'site_protocol'}.":".$tpgmpath."/".$GLOBALS{'codeversion'}."_".$parm0."?";
return $outstr;}
# program name
function YEXTPGMLINKHTTPS ($parm0) {
$pbits = explode('.', $parm0);
if ($pbits[1] == "cgi") {$tpgmpath = $GLOBALS{'site_perlurl'};}
if ($pbits[1] == "php") {$tpgmpath = $GLOBALS{'site_phpurl'};}
$outstr = "https:".$tpgmpath."/".$GLOBALS{'codeversion'}."_".$parm0."?";
return $outstr;}
# standard parameters
function YPGMSTDPARMS () {
$outstr = 'ServiceId='.$GLOBALS{'LOGIN_service_id'}.'&DomainId='.$GLOBALS{'LOGIN_domain_id'}.'&PersonId='.$GLOBALS{'LOGIN_person_id'}.'&ModeId='.$GLOBALS{'LOGIN_mode_id'}.
'&SessionId='.$GLOBALS{'LOGIN_session_id'}.'&LoginModeId='.$GLOBALS{'LOGIN_loginmode_id'}.'&MenuId='.$GLOBALS{'LOGIN_menu_id'}.'&FrameId='.$GLOBALS{'LOGIN_frame_id'};
if ( $GLOBALS{'LOGIN_orgtype_id'} != "" ) { $outstr = $outstr.'&OrgTypeId='.$GLOBALS{'LOGIN_orgtype_id'}; }
if ( $GLOBALS{'LOGIN_org_id'} != "" ) { $outstr = $outstr.'&OrgId='.$GLOBALS{'LOGIN_org_id'}; }
return $outstr; }
# standard parameters
function YPGMMINPARMS () {
$outstr = 'ServiceId='.$GLOBALS{'LOGIN_service_id'}.'&DomainId='.$GLOBALS{'LOGIN_domain_id'}.'&ModeId='.$GLOBALS{'LOGIN_mode_id'}.
'&LoginModeId='.$GLOBALS{'LOGIN_loginmode_id'}.'&MenuId='.$GLOBALS{'LOGIN_menu_id'}.'&FrameId='.$GLOBALS{'LOGIN_frame_id'}; return $outstr; }
# parmname, parmvalue
function YPGMFIRSTPARM ($parm0,$parm1) {$outstr = $parm0."=".$parm1; return $outstr;}
# parmname, parmvalue
function YPGMPARM ($parm0,$parm1) {$outstr = "&".$parm0."=".$parm1; return $outstr;}
# parmname, parmvalue
function YPGMPARMDATE ($parm0,$yyyyummudda) {
	$yyyy=$yyyyummudda[0].$yyyyummudda[1].$yyyyummudda[2].$yyyyummudda[3];
	$mm=$yyyyummudda[5].$yyyyummudda[6];
	$dd=$yyyyummudda[8].$yyyyummudda[9];
	$outstr = "&".$parm0."_YYYYpart=".$yyyy."&".$parm0."_MMpart=".$mm."&".$parm0."_DDpart=".$dd;
	return $outstr;
}
# codebase, code, archive, width, height
function XAPPLET ($parm0,$parm1,$parm2,$parm3,$parm4) {echo '<applet codebase="'.$parm0.'" code="'.$parm1.'" archive="'.$parm2.'" width="'.$parm3.'" height="'.$parm4.'">'."\n"; }
# codebase, classid, archive, width, height
function XOBJECT ($parm0,$parm1,$parm2,$parm3) { # CHECK is this actually used
  $codetype="application/java";
  echo '<object codetype=$Q$codetype$Q codebase="'.$parm0.'" classid="'.$parm1.'" width="'.$parm2.'" height="'.$parm3.'">'."\n";
  echo '<p>This program requires a Java-enabled browser.</p>'."\n";
}
# name, value
function XPARAM ($parm0,$parm1) {echo '<param name="'.$parm0.'" value="'.$parm1.'">'."\n"; }

function X_APPLET () {echo '</applet>'."\n"; }

function X_OBJECT () {echo '</object>'."\n"; }


# nameroot date(YYYY-MM-DD)
function XINDATEYYYY_MM_DD ($name,$value) {
if ($value == "" ) { $value = "0000-00-00"; }
$vbits = explode("-",$value);
$outvalue = $vbits[2]."/".$vbits[1]."/".$vbits[0];
if ($outvalue == "00/00/0000") { $outvalue = ""; }
echo '<div class="form-group">'."\n";
echo '<div class="input-group">'."\n";
echo '<input id="'.$name."_DateInput".'" name="'.$name."_DateInput".'" type="text" class="datepicker form-control"  value="'.$outvalue.'" />'."\n";
echo '<div class="input-group-addon" style="cursor: pointer;" onclick="$('."'#".$name.'_DateInput'."'".').focus();">'."\n";
echo '<i class="fa fa-calendar"></i>'."\n";
echo '</div>'."\n";
echo '</div>'."\n";
echo '</div>'."\n";
XINHID ($name."_DDpart",$vbits[2]);
XINHID ($name."_MMpart",$vbits[1]);
XINHID ($name."_YYYYpart",$vbits[0]);
}

function XINDATEYYYY_MM_DD_AGE ($name,$value) {
if ($value == "" ) { $value = "0000-00-00"; }
$vbits = explode("-",$value);
$outvalue = $vbits[2]."/".$vbits[1]."/".$vbits[0];
if ($outvalue == "00/00/0000") { $outvalue == ""; }
echo '<div class="form-group">'."\n";
echo '<div class="input-group">'."\n";
echo '<input id="'.$name."_DateInput".'" name="'.$name."_DateInput".'" type="text" class="datepicker form-control"  value="'.$outvalue.'" />'."\n";
echo '<div class="input-group-addon" style="cursor: pointer;" onclick="$('."'#".$name.'_DateInput'."'".').focus();">'."\n";
echo '<i class="fa fa-calendar"></i>'."\n";
echo '</div>'."\n";
echo '</div>'."\n";
echo '</div>'."\n";
XINHID ($name."_DDpart",$vbits[2]);
XINHID ($name."_MMpart",$vbits[1]);
XINHID ($name."_YYYYpart",$vbits[0]);
}

function XINDATEYYYY_MM_DD_AGEID ($id,$name,$value) {
if ($value == "" ) { $value = "0000-00-00"; }
$vbits = explode("-",$value);
$outvalue = $vbits[2]."/".$vbits[1]."/".$vbits[0];
if ($outvalue == "00/00/0000") { $outvalue == ""; }
echo '<div class="form-group">'."\n";
echo '<div class="input-group">'."\n";
echo '<input id="'.$id."_DateInput".'" name="'.$name."_DateInput".'" type="text" class="datepicker form-control"  value="'.$outvalue.'" />'."\n";
echo '<div class="input-group-addon" style="cursor: pointer;" onclick="$('."'#".$name.'_DateInput'."'".').focus();">'."\n";
echo '<i class="fa fa-calendar"></i>'."\n";
echo '</div>'."\n";
echo '</div>'."\n";
echo '</div>'."\n";
XINHID ($name."_DDpart",$vbits[2]);
XINHID ($name."_MMpart",$vbits[1]);
XINHID ($name."_YYYYpart",$vbits[0]);
}
# nameroot date(YYYY-MM-DD)
function XTDINDATEYYYY_MM_DD ($name,$value) {
	XTD();XINDATEYYYY_MM_DD($name,$value);	X_TD();
}
function XTDINDATEYYYY_MM_DD_AGE ($name,$value) {
	XTD(); XINDATEYYYY_MM_DD_AGE($name,$value);	X_TD();
}
function XTDINDATEYYYY_MM_DD_AGEID ($id,$name,$value) {
	XTD(); XINDATEYYYY_MM_DD_AGEID($id,$name,$value);	X_TD();
}

# list of TINYMCE Javascript required
function XTINYMCEJS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
  $key = "STATIC_TINYMCEJS_".$lbitselement;
  echo '<script type="text/javascript" src="'.$GLOBALS{'site_tinymceurl'}.'/'.$GLOBALS{$key}.'"></script>'."\n";
 }
}
}
# list of YUI CSS required
function XYUICSS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
  $key = "STATIC_YUICSS_".$lbitselement;
  echo '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'site_yuiurl'}.'/'.$GLOBALS{$key}.'" />'."\n";
 }
}
}
function XYUI3CSS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
  $key = "STATIC_YUI3CSS_".$lbitselement;
  echo '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'siteyui3url'}.'/'.$GLOBALS{$key}.'" />'."\n";
 }
}
}
# list of YUI Javascript required
function XYUIJS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
  $key = "STATIC_YUIJS_".$lbitselement;
  echo '<script type="text/javascript" src="'.$GLOBALS{'site_yuiurl'}.'/'.$GLOBALS{$key}.'"></script>'."\n";
 }
}
}
function XYUI3JS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
  $key = "STATIC_YUI3JS_".$lbitselement;
  echo '<script type="text/javascript" src="'.$GLOBALS{'siteyui3url'}.'/'.$GLOBALS{$key}.'"></script>'."\n";
 }
}
}
# list of specific site CSS required
function XSITECSS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
 	$lastmodtimestamp = date ("ymdHis", filemtime("../site_css/".$GLOBALS{'codeversion'}."_".$lbitselement.".css"));
	echo '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'site_cssurl'}.'/'.$GLOBALS{'codeversion'}."_".$lbitselement.'.css?'.$lastmodtimestamp.'" />'."\n";
 }
}
}
# list of specific site CSS required
function YSITECSS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
 	// avoid cacheing of modified versions
 	$lastmodtimestamp = date ("ymdHis", filemtime("../site_css/".$GLOBALS{'codeversion'}."_".$lbitselement.".css"));
	return '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'site_cssurl'}.'/'.$GLOBALS{'codeversion'}."_".$lbitselement.'.css?'.$lastmodtimestamp.'" />';
 }
}
}
# list of specific site CSS required
function YSITETEMPLATECSS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
 	// avoid cacheing of modified versions
 	$lastmodtimestamp = date ("ymdHis", filemtime("../site_template/css/".$GLOBALS{'codeversion'}."_".$lbitselement.".css"));
	return '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'site_templateurl'}.'/css/'.$GLOBALS{'codeversion'}."_".$lbitselement.'.css?'.$lastmodtimestamp.'" />';
 }
}
}
# list of specific site CSS required
function YSITETEMPLATEDASHCSS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
 	// avoid cacheing of modified versions
 	$lastmodtimestamp = date ("ymdHis", filemtime("../site_templatedash/css/".$GLOBALS{'codeversion'}."_".$lbitselement.".css"));
	return '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'site_templateurl'}.'dash/css/'.$GLOBALS{'codeversion'}."_".$lbitselement.'.css?'.$lastmodtimestamp.'" />';
 }
}
}
# list of specific site Javascript required
function XSITEJS ($parm0) {
$lbits = explode(',', $parm0);
foreach ($lbits as $lbitselement) {
 if ($lbitselement != "" ) {
  // avoid cacheing of modified versions
  $lastmodtimestamp = date ("ymdHis", filemtime("../site_javascript/".$GLOBALS{'codeversion'}."_".$lbitselement.".js"));
  echo '<script type="text/javascript" src="'.$GLOBALS{'site_jsurl'}.'/'.$GLOBALS{'codeversion'}."_".$lbitselement.'.js?'.$lastmodtimestamp.'"></script>'."\n";
 }
}
}
# list of specific site Javascript required
function YSITEJS ($parm0) {
	$lbits = explode(',', $parm0);
	foreach ($lbits as $lbitselement) {
		if ($lbitselement != "" ) {
			// avoid cacheing of modified versions
			$lastmodtimestamp = date ("ymdHis", filemtime("../site_javascript/".$GLOBALS{'codeversion'}."_".$lbitselement.".js"));
			return '<script type="text/javascript" src="'.$GLOBALS{'site_jsurl'}.'/'.$GLOBALS{'codeversion'}."_".$lbitselement.'.js?'.$lastmodtimestamp.'"></script>';
		}
	}
}
# list of specific site Javascript required
function YSITETEMPLATEJS ($parm0) {
	$lbits = explode(',', $parm0);
	foreach ($lbits as $lbitselement) {
		if ($lbitselement != "" ) {
			// avoid cacheing of modified versions
			$lastmodtimestamp = date ("ymdHis", filemtime("../site_template/js/".$GLOBALS{'codeversion'}."_".$lbitselement.".js"));
			return '<script type="text/javascript" src="'.$GLOBALS{'site_templateurl'}.'/js/'.$GLOBALS{'codeversion'}."_".$lbitselement.'.js?'.$lastmodtimestamp.'"></script>';
		}
	}
}
# list of specific site Javascript required
function YSITETEMPLATEDASHJS ($parm0) {
	$lbits = explode(',', $parm0);
	foreach ($lbits as $lbitselement) {
		if ($lbitselement != "" ) {
			// avoid cacheing of modified versions
			$lastmodtimestamp = date ("ymdHis", filemtime("../site_templatedash/js/".$GLOBALS{'codeversion'}."_".$lbitselement.".js"));
			return '<script type="text/javascript" src="'.$GLOBALS{'site_templateurl'}.'dash/js/'.$GLOBALS{'codeversion'}."_".$lbitselement.'.js?'.$lastmodtimestamp.'"></script>';
		}
	}
}
# list of specific external Javascript required
function XEXTERNALJS ($parm0) {
    $lbits = explode(',', $parm0);
    foreach ($lbits as $lbitselement) {
        if ($lbitselement != "" ) {
            echo '<script type="text/javascript" src="'.$lbitselement.'"></script>'."\n";
        }
    }
}
# include html for popups
function XSITEPOPUPS ($parm0) {
 $lbits = explode(',', $parm0);
 foreach ($lbits as $lbitselement) {
  if ($lbitselement != "" ) {
  call_user_func($lbitselement);
  }
 }
}

# list of specific domain CSS required
function XDOMAINCSS ($parm0) {
	$lbits = explode(',', $parm0);
	foreach ($lbits as $lbitselement) {
		if ($lbitselement != "" ) {
			// avoid cacheing of modified versions
	 		$lastmodtimestamp = date ("ymdHis", filemtime($GLOBALS{'domainwwwpath'}."/domain_style/".$lbitselement.".css"));
			echo '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'domainwwwurl'}."/domain_style".'/'.$lbitselement.'.css?'.$lastmodtimestamp.'" />'."\n";
		}
	}
}
# list of specific domain CSS required
function YDOMAINCSS ($parm0) {
	$lbits = explode(',', $parm0);
	foreach ($lbits as $lbitselement) {
		if ($lbitselement != "" ) {
			// avoid cacheing of modified versions
	 		$lastmodtimestamp = date ("ymdHis", filemtime($GLOBALS{'domainwwwpath'}."/domain_style/".$lbitselement.".css"));
			return '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'domainwwwurl'}."/domain_style".'/'.$lbitselement.'.css?'.$lastmodtimestamp.'" />';
		}
	}
}

function XCSS () {
print '<style type="text/css">'."\n";
}
function X_CSS () {
print '</style>'."\n";
}

// Bootstrap shortcuts
// Naming convention
// "B" - Indicates this is a responsive bootstrap html element
// "_" - Indicates the end of an element e.g. B_ROW();
// "ROW" - Is the start or end of a row
// "COL" - Indicates that this element is to be contained in a Column - the column width is provided as a parameter.
//       - note: BCOL("3"); by itself simply starts a new column of width 3.
// "IN" - Indicates that this is an input field returning an value for the specified "name" parameter.
// "TXT" - example of element type - valid values are -  "TXT, "TEXTAREA, IMG, DATE, RADIO, CHECKBOX, SELECT
// "RIGHT - alignment
// "ID" - Indicates that an Id ius being set for this field so that Javascript can identify it.
// "CLASS" - Indicates that a specific class is being set for ths field - used by either CSS or Javascript
// "COLOR" - Indicates a colour override to the default CSS
// "HASH" - Indicates that the field values will be provided in the form of a hash (associative array)
// "SPECIAL" - Is used for things like bootstrap button colour types - eg warning, info etc

function BCONTAINER () {echo '<div class="container">'."\n"; }
function B_CONTAINER () {echo '</div>'."\n"; }

function BROW () {echo '<div class="row">'."\n"; }
function BROWTOP () {echo '<div class="row">'."\n"; }
function BROWEQH () {echo '<div class="row row-eq-height">'."\n"; }
function BROWEQHTOPPAD () {echo '<div class="row row-eq-height" style="padding-top: 6px" >'."\n"; }
function B_ROW () {echo '</div>'."\n"; }

function BCOL ($cols) {echo '<div class="col-md-'.$cols.'">'."\n"; }
function BCOLMD ($cols) {echo '<div class="col-md-'.$cols.'">'."\n"; }
function BCOLXS ($cols) {echo '<div class="col-xs-'.$cols.'">'."\n"; }
function BCOLBACKCOLOR ($color,$cols) { echo '<div class="col-md-'.$cols.'" style="background-color:'.$color.';">'."\n"; }
function BCOLCOLOR ($backcolor,$textcolor,$cols) { echo '<div class="col-md-'.$cols.'" style="background-color:'.$backcolor.'; color:'.$textcolor.';">'."\n"; }
function BCOLXSCOLOR ($backcolor,$textcolor,$cols) { echo '<div class="col-xs-'.$cols.'" style="background-color:'.$backcolor.'; color:'.$textcolor.';">'."\n"; }
function BCOLBOTTOM ($cols) {echo '<div class="align-bottom col-md-'.$cols.'">'."\n"; }
function BCOLCENTER ($cols) {echo '<div class="align-bottom col-md-'.$cols.'" style="text-align: center" >'."\n"; }
function BCOLRIGHT ($cols) {echo '<div class="align-bottom col-md-'.$cols.'" style="text-align: right" >'."\n"; }
function BCOLWRAP ($cols) { echo '<div class="col-md-'.$cols.'" style="word-break: break-all;">'."\n"; }
function B_COL () {echo '</div>'."\n"; }

function BTXT ($text) {echo $text; }
function BTXTID ($id,$text) {echo '<span id="'.$id.'">'.$text.'</span>'."\n"; }
function BCOLTXT ($text,$cols) {echo '<div class="vcenter col-md-'.$cols.'">'.$text.'</div>'."\n"; }
function BCOLTXTRIGHT ($text,$cols) {
	echo '<div class="vcenter col-md-'.$cols.'" ><span style="float: right; display:inline">'.$text.'</span></div>'."\n";
}
function BCOLTXTCOLOR ($text,$cols,$backcolor,$textcolor) { echo '<div class="vcenter col-md-'.$cols.'" style="background-color:'.$backcolor.'; color:'.$textcolor.';">'.$text.'</div>'."\n"; }
function BCOLTXTRIGHTCOLORID ($id,$text,$cols,$backcolor,$textcolor) {
	echo '<div  id="'.$id.'"  class="vcenter col-md-'.$cols.'" style="background-color:'.$backcolor.'; color:'.$textcolor.';"><span style="float: right; display:inline">'.$text.'</span></div>'."\n";
}
function BCOLTXTCENTERCOLORID ($id,$text,$cols,$backcolor,$textcolor) {
    echo '<div  id="'.$id.'" class="vcenter col-sm-'.$cols.'" style="text-align:center; background-color:'.$backcolor.'; color:'.$textcolor.';">'.$text.'</div>'."\n";
}
function BTXTIMGID ($id,$text,$src,$textcolor) {
    echo '<div  id="'.$id.'"  class="phase vcenter" style="background-image: url('.$src.'); color:'.$textcolor.';">'.$text.'</div>'."\n";
}
function BCOLTXTIMGID ($id,$text,$cols,$src,$textcolor) {
	echo '<div  id="'.$id.'"  class="phase vcenter col-md-'.$cols.'" style="background-image: url('.$src.'); color:'.$textcolor.';">'.$text.'</div>'."\n";
}

function BCOLTXTID ($id,$text,$cols) { echo '<div id="'.$id.'" class="vcenter  col-md-'.$cols.'">'.$text.'</div>'."\n"; }
function BCOLTXTIDCOLOR ($id,$text,$cols,$backcolor,$textcolor) { echo '<div id="'.$id.'" class="vcenter col-md-'.$cols.'" style="background-color:'.$backcolor.'; color:'.$textcolor.';">'.$text.'</div>'."\n"; }
function BCOLTXTIDCOLORBORDER ($id,$text,$cols,$backcolor,$bordercolor,$textcolor) { echo '<div id="'.$id.'" class="vcenter col-md-'.$cols.'" style="background-color:'.$backcolor.'; border-color:'.$bordercolor.'; border-style: solid; border-width: 2px; color:'.$textcolor.';">'.$text.'</div>'."\n"; }
function BCOLTXTIDCOLORCLASS ($id,$class,$text,$cols,$backcolor,$textcolor) {
	echo '<div id="'.$id.'" class="'.$class.' vcenter col-md-'.$cols.'" style="background-color:'.$backcolor.'; color:'.$textcolor.';">'.$text.'</div>'."\n";
}


function BIMG ($src,$height) { echo '<img src="'.$src.'" height="'.$height.'" >'."\n"; }
function BIMGFIT ($src) { echo '<img src="'.$src.'" class="img-fluid">'."\n"; }
function BCOLIMG ($src,$height,$cols) { echo '<div class="col-md-'.$cols.'"><img src="'.$src.'" height="'.$height.'" ></div>'."\n"; }
function BCOLIMGHEIGHT ($src,$height,$cols) { echo '<div class="col-md-'.$cols.'"><img src="'.$src.'" height="'.$height.'" ></div>'."\n"; }
function BCOLIMGWIDTH ($src,$height,$cols) { echo '<div class="col-md-'.$cols.'"><img src="'.$src.'" width="'.$height.'" ></div>'."\n"; }
function BLINKIMGNEWPOPUP($link,$src,$height,$wintitle,$top,$left,$wheight,$wheight) {
	echo '<a><img src="'.$src.'" height="'.$height.'" onclick="return popitup('."'".$link."','".$wintitle."','".$top."','".$left."','".$wheight."','".$wheight."'".')'.'" /></a>'."\n";
}
function BIMGID ($id,$src,$height) { echo '<img id="'.$id.'" src="'.$src.'" height="'.$height.'" >'."\n"; }
function BCOLIMGID ($id,$src,$height,$cols) { echo '<div class="col-md-'.$cols.'"><img id="'.$id.'" src="'.$src.'" height="'.$height.'" ></div>'."\n"; }
function BCOLINTXT ($name,$value,$cols) {echo '<div class="col-md-'.$cols.'"><input type="text" name="'.$name.'" class="form-control" value="'.$value.'"></div>'."\n"; }
function BCOLINTXTID ($id,$name,$value,$cols) {echo '<div class="col-md-'.$cols.'"><input id="'.$id.'" name="'.$name.'" class="form-control" type="text" value="'.$value.'"></div>'."\n"; }
function BINTXTID ($id,$name,$value) {echo '<input id="'.$id.'" name="'.$name.'" class="form-control" type="text" value="'.$value.'">'."\n"; }
function BCOLINNUMID ($id,$name,$value,$cols) {echo '<div class="col-md-'.$cols.'"><input id="'.$id.'" name="'.$name.'" class="form-control" type="number" value="'.$value.'"></div>'."\n"; }
function BINPSWID ($id,$name,$placeholder) {echo '<input type="password" id="'.$id.'" name="'.$name.'" class="form-control" type="text" placeholder="'.$placeholder.'" required="" >'."\n"; }
function BCOLINPSWID ($id,$name,$placeholder,$cols) {echo '<div class="col-md-'.$cols.'"><input type="password" id="'.$id.'" name="'.$name.'" class="form-control" type="text" placeholder="'.$placeholder.'" required="" ></div>'."\n"; }

function Val2RAG ($val) {
    $vala = Array("","Y","Yes","N","No","Green","Amber","Red","NA","Pending","Partial","Pass","Fail","Advisory");
    $raga = Array("white","#b3ffd9","#b3ffd9","#ff9999","#ff9999","#b3ffd9","#ffd65c","#ff9999","white","white","#ffd65c","#b3ffd9","#ff9999","#ffd65c");
	$ragindex = array_search($val, $vala);
	if ($ragindex !== false) { return $raga[$ragindex]; }
	else { return "white";}
}
function BINTXTIDCLASS ($id,$class,$name,$value) {
    if ( substr_count($class, 'rag') > 0) {
		$styletext = 'style="background-color: '.Val2RAG($value).'; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'ragmand') > 0) {
	    $class = $class." mandcheck";
	    if ($value == "?"){
	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{
	        $styletext = 'style="background-color: '.Val2RAG($value).'; color: black; text-align: right;"';
	    }
	}
	if ( substr_count($class, 'calcin') > 0) {
		$styletext = 'style="background-color: MintCream; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'calcinpercent') > 0) {
		$styletext = 'style="background-color: MintCream; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'modelinpercent') > 0) {
		$styletext = 'style="background-color: #e6ffff; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'calcres') > 0) {
		$styletext = 'style="background-color: lightgray; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'calcrespercent') > 0) {
		$styletext = 'style="background-color: lightgray; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'mand') > 0) {
	    $class = $class." mandcheck";
	    if ($value == null){
	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
	}
	echo '<input id="'.$id.'" name="'.$name.'" class="'.$class.' form-control" '.$styletext.' type="text" value="'.$value.'">'."\n";
}
function BCOLINTXTIDCLASS ($id,$class,$name,$value,$cols) {
	if ( substr_count($class, 'rag') > 0) {
		$styletext = 'style="background-color: '.Val2RAG($value).'; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'ragMand') > 0) {
	    if ($value == "?"){
	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{
	    $styletext = 'style="background-color: '.Val2RAG($value).'; color: black; text-align: right;"';
	    }
	}
	if ( substr_count($class, 'calcin') > 0) {
		$styletext = 'style="background-color: MintCream; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'calcinpercent') > 0) {
		$styletext = 'style="background-color: MintCream; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'modelinpercent') > 0) {
		$styletext = 'style="background-color: #e6ffff; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'calcres') > 0) {
		$styletext = 'style="background-color: lightgray; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'calcrespercent') > 0) {
		$styletext = 'style="background-color: lightgray; color: black; text-align: right;"';
	}
	if ( substr_count($class, 'mand') > 0) {
	    $class = $class." mandcheck";
	    if ($value == null){
	    $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
	}
	if ( substr_count($class, 'contMand') > 0) {
	    $class = $class." mandcheck";
	    if ($value == "0" || $value == null || $value == ""){
	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
	}
	if ( substr_count($class, 'outMand') > 0) {
	    $class = $class." mandcheck";
	    if ($value == null || $value == ""){
	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
	}
	echo '<div class="col-md-'.$cols.'"><input id="'.$id.'" name="'.$name.'" class="'.$class.' form-control" '.$styletext.' type="text" value="'.$value.'"></div>'."\n";
}
function BINTXTIDCOLOR ($id,$name,$value,$bcolor,$tcolor) {
    $styletext = 'style="background-color: '.$bcolor.'; color: '.$tcolor.'; text-align: right;"';
    echo '<input id="'.$id.'" name="'.$name.'" class="'.$class.' form-control" '.$styletext.' type="text" value="'.$value.'">'."\n";
}
function BCOLINTXTIDCOLOR ($id,$name,$value,$cols,$bcolor,$tcolor) {
    $styletext = 'style="background-color: '.$bcolor.'; color: '.$tcolor.'; text-align: right;"';
    echo '<div class="col-md-'.$cols.'"><input id="'.$id.'" name="'.$name.'" class="'.$class.' form-control" '.$styletext.' type="text" value="'.$value.'"></div>'."\n";
}
function BINTEXTAREA ($name,$value,$rows) {
    echo '<textarea name="'.$name.'" class="form-control" rows="'.$rows.'">'.$value.'</textarea>'."\n";
}

// xs seems to stop tyextarea from being put in 50% on small screens
function BCOLTEXTAREA ($value,$rows,$cols) {
	echo '<div class="col-md-'.$cols.'"><textarea rows="'.$rows.'">'.$value.'</textarea></div>'."\n";
}
function BCOLINTEXTAREA ($name,$value,$rows,$cols) {
	echo '<div class="col-md-'.$cols.'"><textarea name="'.$name.'" class="form-control" rows="'.$rows.'">'.$value.'</textarea></div>'."\n";
}
function BCOLINTEXTAREAID ($id,$name,$value,$rows,$cols) {
	echo '<div class="col-md-'.$cols.'"><textarea id="'.$id.'" name="'.$name.'" class="form-control" rows="'.$rows.'">'.$value.'</textarea></div>'."\n";
}
function BCOLINTEXTAREAIDCLASS ($id,$class,$name,$value,$rows,$cols) {
    if ( substr_count($class, 'mand') > 0) {
        $class = $class." mandcheck";
        if ($value == null){
            $styletext = 'style="background-color: pink; color: black; text-align: left;"';
        }
        else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
    }
    echo '<div class="col-md-'.$cols.'"><textarea id="'.$id.'" name="'.$name.'" class="'.$class.' form-control" '.$styletext.' rows="'.$rows.'">'.$value.'</textarea></div>'."\n";
}
function BINDATE ($name,$value,$dateformat) {
	echo '<input name="'.$name.'" class="datepicker form-control" value="'.$value.'">'."\n";
}
function BCOLINDATE ($name,$value,$dateformat,$cols) {
	echo '<div class="col-md-'.$cols.'"><input name="'.$name.'" class="datepicker form-control" value="'.$value.'"></div>'."\n";
}
function BINDATEID ($id,$name,$value,$dateformat) {
	echo '<input id="'.$id.'" name="'.$name.'" class="datepicker form-control" value="'.$value.'">'."\n";
}
function BINDATEIDCLASS ($id,$name,$class,$value,$dateformat) {
    if ( substr_count($class, 'mand') > 0) {
        $class = $class." mandcheck";
        if ($value == null || $value == ""){
            $styletext = 'style="background-color: pink; color: black; text-align: left;"';
        } else {
            $styletext = 'style="background-color: white; color: black; text-align: left;"';
        }
        echo '<input id="'.$id.'" name="'.$name.'" class="datepicker form-control '.$class.'" '.$styletext.' value="'.$value.'">'."\n";
    } else {
        echo '<input id="'.$id.'" name="'.$name.'" class="datepicker form-control '.$class.'" '.$styletext.' value="'.$value.'">'."\n";
    }
}
function BCOLINDATEID ($id,$name,$value,$dateformat,$cols) {
	echo '<div class="col-md-'.$cols.'"><input id="'.$id.'" name="'.$name.'" class="datepicker form-control" value="'.$value.'"></div>'."\n";
}
function BCOLINDATEIDCLASS ($id,$name,$class,$value,$dateformat,$cols) {
    if ( substr_count($class, 'mand') > 0) {
        $class = $class." mandcheck";
         if ($value == null || $value == ""){
            $styletext = 'style="background-color: pink; color: black; text-align: left;"';
        }
        else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
    }
    echo '<div class="col-md-'.$cols.'"><input id="'.$id.'" name="'.$name.'" class="datepicker form-control '.$class.'" '.$styletext.' value="'.$value.'"></div>'."\n";
}
function BCOLINDATETIMEID ($id,$name,$value,$dateformat,$cols) {
	echo '<div class="col-md-'.$cols.'"><input id="'.$id.'" name="'.$name.'" class="datetimepicker form-control" value="'.$value.'"></div>'."\n";
}
function BCOLINDATEIDCAL ($id,$name,$value,$dateformat,$cols) {
	echo '<div class="col-md-'.$cols.'">'."\n";
	echo '<div class="input-group date">'."\n";
	echo '<input id="'.$id.'" name="'.$name.'" type="text" class="datepicker form-control" data-date-format="'.$dateformat.'" value="'.$value.'">'."\n";
	echo '<div class="input-group-addon">'."\n";
	echo '<span class="glyphicon glyphicon-th"></span>'."\n";
	echo '</div>'."\n";
	echo '</div>'."\n";
	echo '</div>'."\n";
}

function BCOLINTOGGLEYESNO ($name,$value,$cols) {
	XINHID($name, "No");
	$checked = "";	if ($value == "Yes") { $checked = "checked"; }
	echo '<div class="col-md-'.$cols.'"><input type="checkbox" name="'.$name.'" class="form-control" '.$checked.' data-toggle="toggle" value="Yes"></div>'."\n";
}

function BINSELECT ($name) {echo '<select name="'.$name.'" class="form-control">'."\n"; }
function BINSELECTID ($id,$name) {echo '<select id="'.$id.'"  name="'.$name.'" class="form-control">'."\n"; }
function BINSELECTIDCOLOR ($id,$name,$bcolor,$tcolor) {
    $styletext = 'style="background-color: '."Red".'; color: '.$tcolor.'; text-align: left;"';
    echo '<select id="'.$id.'"  name="'.$name.' '.$styletext.' class="form-control">'."\n";
}
function BINSELECTIDCLASS ($id,$class,$name,$value) {

	if ( substr_count($class, 'ragmand') > 0) {
	    if ($value == "?"){
	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{
	        $styletext = 'style="background-color: '.Val2RAG($value).'; color: black; text-align: right;"';
	    }
	}
	if ( substr_count($class, 'mand') > 0) {
	    if ($value == null){
	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
	}
	echo '<select id="'.$id.'" name="'.$name.'" '.$styletext.' class="'.$class.' form-control">'."\n";
}
function B_INSELECT () {echo '</select >'."\n"; }
function BINOPTION ($value,$selected,$text) {echo '<option value="'.$value.'" '.$selected.'>'.$text.'</option>'."\n"; }
function BINOPTIONCLASS ($class,$value,$selected,$text) {echo '<option value="'.$value.'" '.$selected.'>'.$text.'</option>'."\n"; }
function BCOLINSELECTHASH ($hash,$name,$value,$cols) {
    BCOL($cols);BINSELECTHASH($hash,$name,$value);B_COL ();
}
function BINSELECTHASH ($hash,$name,$value) {
    BINSELECT($name,$value);
    if ($value == "") { BINOPTION("","selected","?"); }
    else {BINOPTION("","","?");}
    foreach ($hash as $key=>$selecttext ) {
        $tselected = "";
        if ($value == $key){ $tselected = "selected"; }
        BINOPTION($key,$tselected,$selecttext);
    }
    B_INSELECT();
}
function BINSELECTHASHNOQ ($hash,$name,$value) {
    BINSELECT($name,$value);
    // if ($value == "") { BINOPTION("","selected","?"); }
    // else {BINOPTION("","","?");}
    foreach ($hash as $key=>$selecttext ) {
        $tselected = "";
        if ($value == $key){ $tselected = "selected"; }
        BINOPTION($key,$tselected,$selecttext);
    }
    B_INSELECT();
}
function BCOLINSELECTHASHID ($hash,$id,$name,$value,$cols) {
	BCOL($cols);BINSELECTHASHID($hash,$id,$name,$value);B_COL ();
}
function BINSELECTHASHID ($hash,$id,$name,$value) {
	BINSELECTID($id,$name,$value);
	if ($value == "") { BINOPTION("","selected","?"); }
	else {BINOPTION("","","?");}
	foreach ($hash as $key=>$selecttext ) {
		$tselected = "";
		if ($value == $key){ $tselected = "selected"; }
		BINOPTION($key,$tselected,$selecttext);
	}
	B_INSELECT();
}
function BINSELECTHASHIDCLASS ($hash,$id,$class,$name,$value) {
	BINSELECTIDCLASS($id,$class,$name,$value);
	if ($value == "") { BINOPTION("","selected","?"); }
	else {BINOPTION("","","?");}
	foreach ($hash as $key=>$selecttext ) {
		$tselected = "";
		if ($value == $key){ $tselected = "selected"; }
		BINOPTIONCLASS($class,$key,$tselected,$selecttext);
	}
	if ( substr_count($class, 'mand') > 0) {
	    $class = $class." mandcheck";
	    if ($value == '?'){
	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
	}
	if ( substr_count($class, 'ragMand') > 0) {
	    $class = $class." mandcheck";
	    if ($value == "?" || $value == null || $value == ""){
	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	    }
	    else{
	        $styletext = 'style="background-color: '.Val2RAG($value).'; color: black; text-align: right;"';
	    }
	}
	B_INSELECT();
}

//AG func
function BCOLINSELECTHASHIDCLASSDISABLED ($hash,$id,$class,$name,$value,$cols,$disabled) {
  // echo "string1";
  // echo "DDATA".$id."|".$class."|".$name."|".$value."|"."<br>";
  if (isset($cols)) {
    BCOL($cols);
  }
  if (isset($class)) {
    BINSELECTIDCLASS($id,$class,$name,$value);
    // echo "<br>tete";
  	if ($value == "") { BINOPTION("","selected","?"); }
  	else {BINOPTION("","","?");}
  	foreach ($hash as $key=>$selecttext ) {
  		$tselected = "";
      if ($value == $key){ $tselected .= "selected "; }
  		if ($disabled[$key] == 1){ $tselected .= "disabled "; }
  		BINOPTIONCLASS($class,$key,$tselected,$selecttext);
  	}
  	if ( substr_count($class, 'mand') > 0) {
  	    $class = $class." mandcheck";
  	    if ($value == '?'){
  	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
  	    }
  	    else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
  	}
  	if ( substr_count($class, 'ragMand') > 0) {
  	    $class = $class." mandcheck";
  	    if ($value == "?" || $value == null || $value == ""){
  	        $styletext = 'style="background-color: pink; color: black; text-align: left;"';
  	    }
  	    else{
  	        $styletext = 'style="background-color: '.Val2RAG($value).'; color: black; text-align: right;"';
  	    }
  	}
  }else{
    BINSELECTID($id,$name,$value);
    // echo "<br>tete";
  	if ($value == "") { BINOPTION("","selected","?"); }
  	else {BINOPTION("","","?");}
    // echo $hash;
    // echo "<br>";
  	foreach ($hash as $key=>$selecttext ) {
  		$tselected = "";
      if ($value == $key){ $tselected .= "selected "; }
  		if ($disabled[$key] == 1){ $tselected .= "disabled "; }
  		BINOPTION($key,$tselected,$selecttext);
  	}
  }
  B_INSELECT();
  // BINSELECTIDCLASS($id,$class,$name,$value);
  // // echo "<br>tete";
	// if ($value == "") { BINOPTION("","selected","?"); }
	// else {BINOPTION("","","?");}
	// foreach ($hash as $key=>$selecttext ) {
	// 	$tselected = "";
  //   if ($value == $key){ $tselected .= "selected "; }
	// 	if ($disabled[$key] == 1){ $tselected .= "disabled "; }
	// 	BINOPTIONCLASS($class,$key,$tselected,$selecttext);
	// }
	// if ( substr_count($class, 'mand') > 0) {
	//     $class = $class." mandcheck";
	//     if ($value == '?'){
	//         $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	//     }
	//     else{$styletext = 'style="background-color: white; color: black; text-align: left;"';}
	// }
	// if ( substr_count($class, 'ragMand') > 0) {
	//     $class = $class." mandcheck";
	//     if ($value == "?" || $value == null || $value == ""){
	//         $styletext = 'style="background-color: pink; color: black; text-align: left;"';
	//     }
	//     else{
	//         $styletext = 'style="background-color: '.Val2RAG($value).'; color: black; text-align: right;"';
	//     }
	// }
	// B_INSELECT();
  if (isset($cols)) {
    B_COL ();
  }
}

function BCOLINSELECTHASHIDCLASS ($hash,$id,$class,$name,$value,$cols) {
	BCOL($cols);BINSELECTHASHIDCLASS($hash,$id,$class,$name,$value);B_COL ();
}

function CheckedIf ($field1,$field2) {
    if ($field1 == $field2) { return "Checked"; }
    else { return ""; }
}

function BINRADIOID ($idname, $name, $value, $checked, $text) {
    echo '<div class="radio"><label><input id="'.$idname.'" type="radio" name="'.$name.'" value="'.$value.'" '.$checked.'>'.$text.'</label></div>'."\n";
}
function BINRADIOIDCLASS ($idname, $class, $name, $value, $selected, $text) {
	echo '<div class="radio"><label><input id="'.$idname.'" class="'.$class.'" type="radio" name="'.$name.'" value="'.$value.'" '.$selected.'>'.$text.'</label></div>'."\n";
}

// function BINRADIOIDCLASSSPECIAL ($idname, $class, $type, $name, $value, $selected, $text) {
// 	echo '<div id="'.$idname.'_div" class="radio '.$type.'"><input id="'.$idname.'" class="'.$class.'" type="radio" name="'.$name.'" value="'.$value.'" '.$selected.'>'.$text.'<label for="'.$idname.'"></label></div>'."\n";;
// }

// BCOL("1");BINRADIOIDCLASSSPECIAL ("dmwswellbeing_qproblemmanagement5", "wellbeingradio", "radio-primary", "dmwswellbeing_qproblemmanagement", "5", "", "", "1");B_COL();

// <label class="specialbtn active">
// <input type="radio" name='gender1' checked><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>  Male</span>
// </label>

function BINRADIOIDCLASSTICKBASE ($id, $radioclass, $colortype, $name, $value, $checked, $text) {
	// based on https://codepen.io/BrianSassaman/pen/iLrpC
	print '<label  id="'.$id.'_label" class="radiobtn">'."\n";
	print '<input type="radio" class="'.$radioclass.'" id="'.$id.'" name="'.$name.'" '.$checked.' value="'.$value.'"><i id="'.$id.'_icon" class="radio-base fa fa-square-o fa-2x"></i><span>'.$text.'</span>'."\n";
	print '</label>'."\n";
}

function BCOLINRADIOID ($idname, $name, $value, $selected, $text, $cols) {
	BCOL($cols);BINRADIOID ($idname, $name, $value, $selected, $text);B_COL ();
}

function BINRADIOHASH ($hash,$name,$valuelist) {
    XINHID($name, "");
    $vbits = explode(',', $valuelist);
    XDIV($name."div","");
    echo '<fieldset>'."\n";
    foreach ($hash as $key=>$selecttext ) {
        $fieldid = $name."_".$key.
        $tchecked = "";
        foreach ($vbits as $vbit ) {
            if ($vbit == $key){ $tchecked = "checked"; }
        }
        echo '<label class="radio">'."\n";
        echo '<input id='.$fieldid.' type="radio" name="'.$name.'['.$key.']" '.$tchecked.' >'."\n";
        echo $selecttext."\n";
        echo '</label>'."\n";
    }
    echo '</fieldset>'."\n";
    X_DIV($name."div");
}

function BINRADIOHASHINLINE ($hash,$name,$valuelist) {
    XINHID($name, "");
    $vbits = explode(',', $valuelist);
    XDIV($name."div","");
    echo '<fieldset>'."\n";
    foreach ($hash as $key=>$selecttext ) {
        $fieldid = $name."_".$key.
        $tchecked = "";
        foreach ($vbits as $vbit ) {
            if ($vbit == $key){ $tchecked = "checked"; }
        }
        echo '<label class="radio-inline">'."\n";
        echo '<input id='.$fieldid.' type="radio" name="'.$name.'['.$key.']" '.$tchecked.' >'."\n";
        echo $selecttext."\n";
        echo '</label>'."\n";
    }
    echo '</fieldset>'."\n";
    X_DIV($name."div");
}

function BINCHECKBOX ($name, $value, $checked, $text) {
	echo '<div class="checkbox"><label><input type="checkbox" name="'.$name.'" value="'.$value.'" '.$checked.'/>&nbsp;'.$text.'</label></div>'."\n";
}
function BCOLINCHECKBOX ($name, $value, $checked, $text, $cols) {
	BCOL($cols);BINCHECKBOX ($name, $value, $checked, $text);B_COL ();
}
function BINCHECKBOXYN ($name,$value,$text) {
	XINHID($name, "N");
	$tselected = ""; if ( $value == "Y" ) {
		$tselected = "checked";
	}
	echo '<div class="checkbox"><label><input type="checkbox" name="'.$name.'" value="Y" '.$tselected.'/>&nbsp;'.$text.'</label></div>'."\n";
}
function BCOLINCHECKBOXYN ($name,$value,$text,$cols) {
	BCOL($cols);BINCHECKBOXYN ($name, $value, $text);B_COL ();
}
function BINCHECKBOXYESNO ($idname,$value,$text) {
	XINHID($idname, "No");
	$tselected = ""; if ( $value == "Yes" ) {
		$tselected = "checked";
	}
	echo '<div class="checkbox"><label><input  id='.$idname.' type="checkbox" name="'.$idname.'" value="Yes" '.$tselected.'/>&nbsp;'.$text.'</label></div>'."\n";
}

function BINCHECKBOXYESNOCLASS ($idname,$class,$value,$text) {
    XINHID($idname, "No");
    $tselected = ""; if ( $value == "Yes" ) {
        $tselected = "checked";
    }
    echo '<div class="checkbox"><label><input  id='.$idname.' type="checkbox" name="'.$idname.'" value="Yes" class="'.$class.'"  '.$tselected.'/>&nbsp;'.$text.'</label></div>'."\n";
}

function BCOLINCHECKBOXYESNO ($idname,$value,$text,$cols) {
	BCOL($cols);BINCHECKBOXYESNO ($idname, $value, $text);B_COL ();
}
function BINCHECKBOXHASH ($hash,$name,$valuelist) {
    XINHID($name, "");
	$vbits = explode(',', $valuelist);
	XDIV($name."div","");
	echo '<fieldset>'."\n";
	foreach ($hash as $key=>$selecttext ) {
	    $fieldid = $name."_".$key.
		$tchecked = "";
		foreach ($vbits as $vbit ) {
		    if ($vbit == $key){ $tchecked = "checked"; }
		}
		echo '<div class="checkbox checkbox-primary">'."\n";
		echo '<input id="'.$fieldid.'" type="checkbox" name="'.$name.'['.$key.']" '.$tchecked.' >'."\n";
		echo '<label for="'.$fieldid.'">'."\n";
		echo $selecttext."\n";
		echo '</label>'."\n";
		echo '</div>'."\n";
	}
	echo '</fieldset>'."\n";
	X_DIV($name."div");
}

function BINCHECKBOXHASHCLASS ($hash,$name,$valuelist,$class) {
    XINHID($name, "");
    $vbits = explode(',', $valuelist);
    XDIV($name."div","");
    echo '<fieldset>'."\n";
    foreach ($hash as $key=>$selecttext ) {
        $fieldid = $name."_".$key.
        $tchecked = "";
        foreach ($vbits as $vbit ) {
            if ($vbit == $key){ $tchecked = "checked"; }
        }
        echo '<div class="checkbox checkbox-primary">'."\n";
        echo '<input id='.$fieldid.' type="checkbox" name="'.$name.'['.$key.']" '.$tchecked.' class="'.$class.'">'."\n";
        echo '<label for='.$fieldid.'>'."\n";
        echo $selecttext."\n";
        echo '</label>'."\n";
        echo '</div>'."\n";
    }
    echo '</fieldset>'."\n";
    X_DIV($name."div");
}

function BINCHECKBOXHASHINLINE ($hash,$name,$valuelist) {
    XINHID($name, "");
    $vbits = explode(',', $valuelist);
    XDIV($name."div","");
    echo '<fieldset>'."\n";
    foreach ($hash as $key=>$selecttext ) {
        $fieldid = $name."_".$key.
        $tchecked = "";
        foreach ($vbits as $vbit ) {
            if ($vbit == $key){ $tchecked = "checked"; }
        }
        echo '<label class="checkbox-inline">'."\n";
        echo '<input id='.$fieldid.' type="checkbox" name="'.$name.'['.$key.']" '.$tchecked.' >'."\n";
        echo $selecttext."\n";
        echo '</label>'."\n";
    }
    echo '</fieldset>'."\n";
    X_DIV($name."div");
}

function BCOLINCHECKBOXHASH ($hash,$name,$valuelist,$cols) {
    BCOL($cols);BINCHECKBOXHASH ($hash,$name,$valuelist);B_COL ();
}

function BCOLINCHECKBOXHASHCLASS ($hash,$name,$valuelist,$class,$cols) {
    BCOL($cols);BINCHECKBOXHASHCLASS ($hash,$name,$valuelist,$class);B_COL ();
}

function BINCHECKBOXHASHTOOLTIP ($hash,$name,$valuelist,$tooltip) {
    XINHID($name, "");
    $vbits = explode(',', $valuelist);
    XDIV($name."div","");
    echo '<fieldset>'."\n";
    foreach ($hash as $key=>$selecttext ) {
        $fieldid = $name."_".$key.
        $tchecked = "";
        $cbits = explode('|', $selecttext);
        $selecttext = $cbits[0];
        $tooltip = $cbits[1];
        //$tooltip = $cbits[1];
        foreach ($vbits as $vbit ) {
            if ($vbit == $key){ $tchecked = "checked"; }
        }
        echo '<div class="checkbox checkbox-primary">'."\n";
        echo '<input id='.$fieldid.' type="checkbox" name="'.$name.'['.$key.']" '.$tchecked.' >'."\n";
        echo '<label for='.$fieldid.' data-toggle="tooltip" title="'.$tooltip.'">'."\n";
        echo $selecttext."\n";
        echo '</label>'."\n";
        echo '</div>'."\n";
    }
    echo '</fieldset>'."\n";
    X_DIV($name."div");
}
function BCOLINCHECKBOXHASHTOOLTIP ($hash,$name,$valuelist,$tooltip,$cols) {
    BCOL($cols);BINCHECKBOXHASH ($hash,$name,$valuelist,$tooltip);B_COL ();
}



function BINBUTTONID ($id,$text) {print '<button id="'.$id.'" type="button" class="btn btn-primary">'.$text.'</button>'."\n"; }
function BINBUTTONIDSPECIAL ($id,$type,$text) {print '<button id="'.$id.'" type="button" class="btn btn-'.$type.'">'.$text.'</button>'."\n"; }

function BINBUTTONIDSPECIALTOOLTIP ($id,$type,$text,$tooltip) {
    print '<button id="'.$id.'" type="button" class="btn btn-'.$type.'" data-toggle="tooltip" title="'.$tooltip.'" >'.$text.'</button>'."\n";
}

function BINBUTTONNAMESPECIAL ($idname,$type,$text) {print '<button id="'.$idname.'" name="'.$idname.'" type="button" class="btn btn-'.$type.'">'.$text.'</button>'."\n"; }
function BINSUBMITNAMESPECIALICON ($idname,$type,$text,$icon) {print '<button id="'.$idname.'" name="'.$idname.'" type="submit" class="btn btn-'.$type.'">'.$text.'&nbsp;<span><i class="fa fa-refresh fa-'.$icon.'"></i></span></button>'."\n"; }
function BINBUTTONIDSPINNER ($id,$text) {
	print '<button id="'.$id.'" type="button" class="btn btn-primary" style="display: none;" >'.'<span><i class="fa fa-refresh fa-spin"></i></span>&nbsp;'.$text.'</button>'."\n";
}
function BINBUTTONIDCLASS ($id,$class,$text) {print '<button id="'.$id.'" class="'.$class.' btn btn-primary" type="button" class="btn btn-primary">'.$text.'</button>'."\n"; }
function BINBUTTONIDCLASSSPECIAL ($id,$class,$type,$text) {
	print '<button id="'.$id.'" class="'.$class.' btn btn-'.$type.'" type="button" >'.$text.'</button>'."\n";
}
function BINBUTTONIDSPECIALICON ($idname,$type,$text,$icon) {print '<button id="'.$idname.'" type="button" class="btn btn-'.$type.'">'.$text.'&nbsp;<span><i class="fa fa-refresh fa-'.$icon.'"></i></span></button>'."\n"; }
function BINBUTTONIDSPECIALICONBEFORE ($idname,$type,$text,$icon) {print '<button id="'.$idname.'" type="button" class="btn btn-'.$type.'"><span><i class="fa fa-refresh fa-'.$icon.'"></i></span>'.'&nbsp;'.$text.'</button>'."\n"; }

function BINBUTTONIDCLASSSPECIALICONONLY ($id,$class,$type,$icon) {
    print '<button id="'.$id.'" type="button" class="'.$class.' btn btn-'.$type.'"><span><i class="fa fa-refresh fa-'.$icon.'"></i></span></button>'."\n";
}

function BINSUBMITID ($id,$text) {print '<button id="'.$id.'" type="submit" class="btn btn-primary">'.$text.'</button>'."\n"; }
function BINSUBMITIDSPECIAL ($id,$type,$text) {print '<button id="'.$id.'" type="submit" class="btn btn-'.$type.'">'.$text.'</button>'."\n"; }
function BCOLINSUBMITID ($id,$text,$cols) {BCOL($cols);BINSUBMITID($id,$text);B_COL ();}

function BNAVCONTAINER () {return '<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"><div class="container">'."\n";}
function B_NAVCONTAINER () {return '</div></nav>'."\n";}
function BNAVIMAGECONTAINER () {return '<div class="navbar-header">'."\n";}
function B_NAVIMAGECONTAINER () {return '</div>'."\n";}
function BNAVMENUCONTAINER () {return '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><ul class="nav navbar-nav navbar-right">'."\n";}
function B_NAVMENUCONTAINER () {return '</div>'."\n";}
function BNAVMENUITEM ($link,$text) {return '<li><a href="'.$link.'">'.$text.'</a></li>'."\n";}
function BNAVMENUITEMNEWWINDOW ($link,$text) {return '<li><a href="'.$link.'" target="newwindow">'.$text.'</a></li>'."\n";}
function BNAVMENULOGINITEM ($link,$text) {return '<li><a id="nav_Login" href="'.$link.'">'.$text.'</a></li>'."\n";}
function BNAVDROPDOWN ($link,$text) {return '<li class="dropdown"><a href="'.$link.'" class="dropdown-toggle" data-toggle="dropdown">'.$text.' <b class="caret"></b></a><ul class="dropdown-menu">'."\n";}
function B_NAVDROPDOWN () {return '</ul></li>'."\n";}

function BTABDIV ($parm0) {echo '<div id="'.$parm0.'" class="btabdiv">'."\n";}
function YTABDIV ($parm0) {return '<div id="'.$parm0.'" class="btabdiv">'."\n";}
function WTABDIV ($parm0) {array_push($GLOBALS{'pluginhtmla'}, YTABDIV($parm0));}
function BTABHEADERCONTAINER () {echo '<ul class="nav nav-tabs">'."\n";}
function YTABHEADERCONTAINER () {return '<ul class="nav nav-tabs">'."\n";}
function WTABHEADERCONTAINER () {array_push($GLOBALS{'pluginhtmla'}, YTABHEADERCONTAINER());}

// Caused by differences between Bootstrap 3 and 4 - putting active on a rather than li
function BTABHEADERITEMACTIVE ($parm0,$parm1) {
    if ( $GLOBALS{'dashboardstyle'} == "1" ) { echo '<li id="'.$parm0.'_header"><a data-toggle="tab" class="active" href="#'.$parm0.'">'.$parm1.'</a></li>'."\n"; }
    else {echo '<li id="'.$parm0.'_header" class="active"><a data-toggle="tab" href="#'.$parm0.'">'.$parm1.'</a></li>'."\n";}
}
function BTABHEADERITEMACTIVECLASS ($parm0,$parm1,$class) {
    if ( $GLOBALS{'dashboardstyle'} == "1" ) { echo '<li id="'.$parm0.'_header"><a data-toggle="tab" class="active '.$class.'" href="#'.$parm0.'">'.$parm1.'</a></li>'."\n";}
    else {echo '<li id="'.$parm0.'_header" class="active '.$class.'"><a data-toggle="tab" href="#'.$parm0.'">'.$parm1.'</a></li>'."\n";}
}
function YTABHEADERITEMACTIVE ($parm0,$parm1) {
    if ( $GLOBALS{'dashboardstyle'} == "1" ) { return '<li id="'.$parm0.'_header"><a data-toggle="tab" class="active" href="#'.$parm0.'">'.$parm1.'</a></li>'."\n"; }
    else {return '<li id="'.$parm0.'_header" class="active"><a data-toggle="tab" href="#'.$parm0.'">'.$parm1.'</a></li>'."\n";}
}
function WTABHEADERITEMACTIVE ($parm0,$parm1) {array_push($GLOBALS{'pluginhtmla'}, YTABHEADERITEMACTIVE($parm0,$parm1));}

function BTABHEADERITEM ($parm0,$parm1) {echo '<li id="'.$parm0.'_header"><a data-toggle="tab" href="#'.$parm0.'">'.$parm1.'</a></li>'."\n";}
function BTABHEADERITEMCLASS ($parm0,$parm1,$class) {echo '<li id="'.$parm0.'_header" class="'.$class.'"><a data-toggle="tab" href="#'.$parm0.'">'.$parm1.'</a></li>'."\n";}
function YTABHEADERITEM ($parm0,$parm1) {return '<li id="'.$parm0.'_header"><a data-toggle="tab" href="#'.$parm0.'">'.$parm1.'</a></li>'."\n";}
function WTABHEADERITEM ($parm0,$parm1) {array_push($GLOBALS{'pluginhtmla'}, YTABHEADERITEM($parm0,$parm1));}
function B_TABHEADERCONTAINER () {echo '</ul>'."\n";}
function Y_TABHEADERCONTAINER () {return '</ul>'."\n";}
function W_TABHEADERCONTAINER () {array_push($GLOBALS{'pluginhtmla'}, Y_TABHEADERCONTAINER());}
function BTABCONTENTCONTAINER () {echo '<div class="tab-content">'."\n";}
function YTABCONTENTCONTAINER () {return '<div class="tab-content">'."\n";}
function WTABCONTENTCONTAINER () {array_push($GLOBALS{'pluginhtmla'}, YTABCONTENTCONTAINER());}
function BTABCONTENTITEMACTIVE ($parm0) {echo '<div id="'.$parm0.'" class="tab-pane active">'."\n";}
function YTABCONTENTITEMACTIVE ($parm0) {return '<div id="'.$parm0.'" class="tab-pane active">'."\n";}
function WTABCONTENTITEMACTIVE ($parm0) {array_push($GLOBALS{'pluginhtmla'}, YTABCONTENTITEMACTIVE($parm0));}
function BTABCONTENTITEM ($parm0) {echo '<div id="'.$parm0.'" class="tab-pane">'."\n";}
function YTABCONTENTITEM ($parm0) {return '<div id="'.$parm0.'" class="tab-pane">'."\n";}
function WTABCONTENTITEM ($parm0) {array_push($GLOBALS{'pluginhtmla'}, YTABCONTENTITEM($parm0));}
function B_TABCONTENTITEM () {echo '</div>'."\n";}
function Y_TABCONTENTITEM () {return '</div>'."\n";}
function W_TABCONTENTITEM () {array_push($GLOBALS{'pluginhtmla'}, Y_TABCONTENTITEM());}
function B_TABCONTENTCONTAINER () {echo '</div>'."\n";}
function Y_TABCONTENTCONTAINER () {return '</div>'."\n";}
function W_TABCONTENTCONTAINER () {array_push($GLOBALS{'pluginhtmla'}, Y_TABCONTENTCONTAINER());}
function B_TABDIV () {echo '</div>'."\n";}
function Y_TABDIV () {return '</div>'."\n";}
function W_TABDIV () {array_push($GLOBALS{'pluginhtmla'}, Y_TABDIV());}

function BACCORDDIV ($accordionid) { echo '<div class="panel-group" id="'.$accordionid.'">'."\n"; }
function BACCORDPANEL () { echo '<div class="panel panel-default">'."\n"; }
function BACCORDPANELHEADING () { echo '<div class="panel-heading"><div class="panel-title">'."\n"; }
function BACCORDPANELHEADINGA ($accordionid, $contentid) { echo '<a data-toggle="collapse" data-parent="#'.$accordionid.'" href="#'.$contentid.'">'."\n"; }
function B_ACCORDPANELHEADINGA () { echo '</a>'."\n"; }
function B_ACCORDPANELHEADING () { echo '</div></div>'."\n"; }
function BACCORDPANELCONTENT ($contentid) { echo '<div id="'.$contentid.'" class="panel-collapse collapse in"><div class="panel-body">'."\n"; }
function B_ACCORDPANELCONTENT () { echo '</div></div>'."\n"; }
function B_ACCORDPANEL () { echo '</div>'."\n"; }
function B_ACCORDDIV () { echo '</div>'."\n"; }

function BTEXTPANELDIV ($textpanelid,$panels) {
    if ($panels == "1") { $bstrapcols = "col-md-12"; }
    if ($panels == "2") { $bstrapcols = "col-md-6"; }
    if ($panels == "3") { $bstrapcols = "col-md-4"; }
    if ($panels == "4") { $bstrapcols = "col-md-3 col-sm-6"; }
    if ($panels == "5") { $bstrapcols = "col-md-2 col-sm-6"; }
    if ($panels == "6") { $bstrapcols = "col-md-2 col-sm-4"; }
    echo '<div id="'.$textpanelid.'" class="'.$bstrapcols.'">'."\n";
    echo '<div class="panel panel-default">'."\n";
}
function BTEXTPANELHEADING () {
    echo '<div class="panel-heading">'."\n";
}
function B_TEXTPANELHEADING () { echo '</div>'."\n"; }
function BTEXTPANELCONTENT ($contentid) {
    echo '<div class="panel-body">'."\n";
}
function B_TEXTPANELCONTENT () { echo '</div>'."\n"; }
function B_TEXTPANELDIV () { echo '</div></div>'."\n"; }

# menuname
function XTABDIV ($parm0) {echo '<div class="yui-skin-sam"><div id="'.$parm0.'" class="yui-navset">'."\n";}
function XTABHEADERCONTAINER () {echo '<ul class="yui-nav">'."\n";}
# tabid tabtext selected
function XTABHEADERITEM ($parm0,$parm1,$parm2) {
if ($parm2 == "selected" ) {$tselected = ' class="selected"'; } else {$tselected = "";}
echo '<li'.$tselected.'><a href="#'.$parm0.'"><em>'.$parm1.'</em></a></li>'."\n";}
function X_TABHEADERCONTAINER () {echo '</ul>'."\n";}
function XTABCONTENTCONTAINER () {echo '<div class="yui-content">'."\n";}
# tabid
function XTABCONTENTITEM ($parm0) {echo '<div id="'.$parm0.'">'."\n";}
function X_TABCONTENTITEM () {echo '</div>'."\n";}
function X_TABCONTENTCONTAINER () {echo '</div>'."\n";}
function X_TABDIV () {echo '</div></div>'."\n";}
# tabindex linktext
function XTABLINKTXT ($parm0,$parm1) {print '<a href="javascript:gotoTab('.$parm0.')">'.$parm1.'</a>'."\n";}
# tabindex linktext
function XTDTABLINKIMGFLEX ($parm0,$parm1) {print '<td nowrap valign="top"> <a href="javascript:gotoTab('.$parm0.')"><img src="'.$parm1.'" border=0 /></a> </td>'."\n";}

function XUL ($parm0,$parm1) {
if ($parm0 == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$parm0.'" ';}
if ($parm1 == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$parm1.'" ';}
echo '<ul'.$tidtxt.$tclasstxt.'>'."\n"; }
function X_UL () { echo '</ul>'."\n"; }
function XLI ($parm0,$parm1) {
if ($parm0 == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$parm0.'" ';}
if ($parm1 == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$parm1.'" ';}
echo '<li'.$tidtxt.$tclasstxt.'>'."\n"; }
function X_LI () { echo '</li>'."\n"; }

function XLITXT ($parm0) {
    echo '<li>'.$parm0.'</li>'."\n";
}
function XAHREF($href){
echo '<a href="'.$href.'">'."\n";
}
function XAHREFNEWWINDOW($href,$winname){
echo '<a href="'.$href.'"target="'.$winname.'">'."\n";
}
function XAHREFIDCLASS($href,$id,$class){
echo '<a id="'.$id.'" class="'.$class.'" href="'.$href.'" >'."\n";
}

function XAHREFCLASS($href,$class){
echo '<a class="'.$class.'" href="'.$href.'">'."\n";
}
function XA ($parm0,$parm1) {
if ($parm0 == "") {$tidtxt = "";} else {$tidtxt = ' id="'.$parm0.'" ';}
if ($parm1 == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$parm1.'" ';}
echo '<a'.$tidtxt.$tclasstxt.'>'."\n"; }
function X_A () { echo '</a>'."\n"; }

function XNESTCONTAINER () {
    echo '<div class="dd nestable" id="nestable">'."\n";
}
function X_NESTCONTAINER () {
    echo '</div>'."\n";
}
function XNESTOL () {
    echo '<ol class="dd-list">'."\n";
}
function X_NESTOL () {
    echo '</ol>'."\n";
}
function XNESTMENULI ($nid,$text,$targettype,$webpagename,$url,$hide) {
    echo '<li class="dd-item"';
    echo ' data-id="'.$nid.'"';
    echo ' data-text="'.$text.'"';
    echo ' data-targettype="'.$targettype.'"';
    echo ' data-webpagename="'.$webpagename.'"';
    echo ' data-url="'.$url.'"';
    echo ' data-hide="'.$hide.'"';
    echo ' data-new="0"';
    echo ' data-deleted="0"';
    echo '>'."\n";
}
function XNESTSECTIONLI ($nid,$seq,$ref,$name,$description) {
    echo '<li class="dd-item"';
    echo ' section-id="'.$nid.'"';
    echo ' section-seq="'.$seq.'"';
    echo ' section-ref="'.$ref.'"';
    echo ' section-name="'.$name.'"';
    echo ' section-description="'.$description.'"';
    echo ' section-new="0"';
    echo ' section-deleted="0"';
    echo '>'."\n";
}
function XNESTSECTIONITEM ($nid,$name,$description) {
    echo '<div class="dd-handle">'.$text."\n";
    echo '<span class="button-type btn btn-secondary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '</span>'."\n";
    echo '</div>'."\n";
    echo '<li>'.$name.'</li>';
    echo '<span class="button-edit btn btn-primary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-pencil" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
    echo '<span class="button-delete btn btn-danger btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-times" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
}
function XNESTCRITERIALI ($nid,$text,$subcriteria,$help,$template) {
    echo '<li class="dd-item"';
    echo ' criteria-id="'.$nid.'"';
    echo ' criteria-text="'.$text.'"';
    echo ' criteria-subcriteria="'.$subcriteria.'"';
    echo ' criteria-template="'.$template.'"';
    echo ' criteria-hide="'.$hide.'"';
    echo ' criteria-new="0"';
    echo ' criteria-deleted="0"';
    echo '>'."\n";
}
function XNESTCRITERIAITEM ($nid,$name,$description) {
    echo '<div class="dd-handle">'.$text."\n";
    echo '<span class="button-type btn btn-secondary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '</span>'."\n";
    echo '</div>'."\n";
    echo '<li>'.$name.'</li>';
    echo '<li>'.$description.'</li>';
    echo '<span class="button-edit btn btn-primary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-pencil" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
    echo '<span class="button-delete btn btn-danger btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-times" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
}
function XNESTEVIDENCELI ($nid,$text,$docsreqd,$imgsreqd) {
    echo '<li class="dd-item"';
    echo ' evidence-id="'.$nid.'"';
    echo ' evidence-text="'.$text.'"';
    echo ' evidence-docsreqd="'.$docsreqd.'"';
    echo ' evidence-imgsreqd="'.$imgsreqd.'"';
    echo ' evidence-new="0"';
    echo ' evidence-deleted="0"';
    echo '>'."\n";
}
function XNESTEVIDENCEITEM ($nid,$name) {
    echo '<div class="dd-handle">'.$text."\n";
    echo '<span class="button-type btn btn-secondary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '</span>'."\n";
    echo '</div>'."\n";
    echo '<li>'.$name.'</li>';
    echo '<span class="button-edit btn btn-primary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-pencil" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
    echo '<span class="button-delete btn btn-danger btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-times" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
}
function XNESTDATALI ($nid,$fieldname,$fieldtitle,$questiontype,$textquestion,$radioquestionvals,$checkboxvals,$datavals) {
    echo '<li class="dd-item"';
    echo ' data-id="'.$nid.'"';
    echo ' data-fieldname="'.$fieldname.'"';
    echo ' data-fieldtitle="'.$fieldtitle.'"';
    echo ' data-questiontype="'.$questiontype.'"';
    echo ' data-url="'.$url.'"';
    echo ' data-new="0"';
    echo ' data-deleted="0"';
    echo '>'."\n";
}
function XNESTDATAITEM ($nid,$fieldtitle,$questiontype) {
    echo '<div class="dd-handle">'.$text."\n";
    echo '<span class="button-type btn btn-secondary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '</span>'."\n";
    echo '</div>'."\n";
    echo '<li>'.$name.'</li>';
    echo '<li>'.$questiontype.'</li>';
    echo '<span class="button-edit btn btn-primary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-pencil" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
    echo '<span class="button-delete btn btn-danger btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-times" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
}
function XNESTLIBSECTIONLI ($nid,$librarysectionid,$title,$hide,$security) {
    echo '<li class="dd-item"';
    echo ' data-id="'.$nid.'"';
    echo ' data-librarysectionid="'.$librarysectionid.'"';
    echo ' data-title="'.$title.'"';
    echo ' data-hide="'.$hide.'"';
    echo ' data-security="'.$security.'"';
    echo ' data-new="0"';
    echo ' data-deleted="0"';
    echo '>'."\n";
}
function XNESTKBSECTIONLI ($nid,$kbsectionid,$title,$type,$ref) {
    echo '<li class="dd-item"';
    echo ' data-id="'.$nid.'"';
    echo ' data-kbsectionid="'.$kbsectionid.'"';
    echo ' data-title="'.$title.'"';
    echo ' data-type="'.$type.'"';
    echo ' data-ref="'.$ref.'"';
    echo ' data-new="0"';
    echo ' data-deleted="0"';
    echo '>'."\n";
}
function X_NESTLI () {
    echo '</li>'."\n";
}

function XNESTMENUITEM ($nid,$text,$targettype) {
    if ($targettype == "Webpage") { $targettypeicon = "fa fa-file"; }
    if ($targettype == "URL") { $targettypeicon = "fa fa-link"; }
    if ($targettype == "Login") { $targettypeicon = "fa fa-sign-in"; }
    if ($targettype == "AccountRegistration") { $targettypeicon = "far fa-registered"; }
    if ($targettype == "Results") { $targettypeicon = "fa fa-trophy"; }
    if ($targettype == "Contacts") { $targettypeicon = "fa fa-users"; }
    if ($targettype == "Facebook") { $targettypeicon = "fa fa-facebook-square"; }
    if ($targettype == "Twitter") { $targettypeicon = "fa fa-twitter"; }
    if ($targettype == "Instagram") { $targettypeicon = "fa fa-instagram"; }
    echo '<div class="dd-handle">'.$text."\n";
    echo '<span class="button-type btn btn-secondary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="'.$targettypeicon.'" aria-hidden="false"></i>'."\n";
    echo '</span>'."\n";
    echo '</div>'."\n";
    echo '<span class="button-edit btn btn-primary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-pencil" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
    echo '<span class="button-delete btn btn-danger btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-times" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
}

function XNESTLIBSECTIONITEM ($nid,$title) {
    echo '<div class="dd-handle">'.$title."\n";
    echo '</div>'."\n";
    echo '<span class="button-edit btn btn-primary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-pencil" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
    echo '<span class="button-delete btn btn-danger btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-times" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
}
function XNESTKBSECTIONITEM ($nid,$title,$type,$reftext) {
    $class = "dd-handle";
    $treftext = "";
    if ( $type == "HelpSection" ) {
        $class = "dd-handle-alt";
        $treftext = "";
    }
    if ( $type == "HelpItem" ) {
        $class = "dd-handle";
        $treftext = " (".$reftext.")";
    }

    echo '<div class="'.$class.'">'.$title.$treftext."\n";
    echo '</div>'."\n";
    echo '<span class="button-edit btn btn-primary btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-pencil" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
    echo '<span class="button-delete btn btn-danger btn-xs pull-right" data-owner-id="'.$nid.'">'."\n";
    echo '<i class="fa fa-times" aria-hidden="true"></i>'."\n";
    echo '</span>'."\n";
}
/*START bootstrapious macros*/
function XCARD(){
  echo "<div class='card'>";
}

function X_CARD(){
  echo "</div>";
}

function XCARDTXT($title,$content){
  echo "<div class='card'>";
  XH3ID("cardTitle",$title);
  XPTXT($content);
  echo "</div>";
}

function X_CARDTXT(){
  echo "</div>";
}

function XSECTION($class){
  echo "<br>\n<section class='".$class."'>";
}

function X_SECTION(){
  echo "</section><br>";
}

function XCARDDROPDOWN($id){
  echo "<div id='".$id."-wrapper' class='card updates ".$id."'>";
  echo "<div id='".$id."-header' class='card-header d-flex justify-content-between align-items-center'>";
  echo "<h5 class='h5 display'><a data-toggle='collapse' data-parent='#".$id."-wrapper' href='#".$id."-box' aria-expanded='true' aria-controls='".$id."-box' class=''>".$id."</a></h5>";
  echo "<a data-toggle='collapse' data-parent='#".$id."-wrapper' href='#".$id."-box' aria-expanded='true' aria-controls='".$id."-box' class=''><i class='fa fa-angle-down'></i></a>";
  echo"</div>";
  echo"<div id='".$id."-box' role='tabpanel' class='collapse show'>";
  echo"
  <ul class='".$id." list-unstyled'>
  ";
}

function XCARDDROPDOWNCONTENT($content){
  echo"<li>".$content."</li>";
}

function X_CARDDROPDOWN(){
  echo"</ul></div></div>";
}

function XFOOTER($class){
  echo "<footer class='".$class."'>";
}

function X_FOOTER(){
  echo "</footer>";
}

function XSIDEHEADING($text){
  print '<h5 class="sidenav-heading">'.$text.'</h5>'."\n";
}

function XSIDEIMG($url){
  print '<img src="'.$url.'" class="sideNavImg">'."\n";
}

function XSEPERATOR(){
  print '<hr style="border-color:#CCCCCC" />'."\n";
}

function XI($class){
  print"<i class='".$class."'>";
}

function X_I(){
  print"</i>";
}

function XDROPDOWN($link,$text,$icon){
  print '<li><a href="'.$link.'" aria-expanded="false" data-toggle="collapse"> <i class="'.$icon.'"></i>'.$text.'</a>'."\n";
}

function XNAVCLASS($class){
  print "<nav class='".$class."'>";
}

function X_NAV(){
  print "</nav>";
}

function XHEADER($class){
  print '<header class="'.$class.'">'."\n";
}

function X_HEADER(){
  print '</header>'."\n";
}

function XSPAN($class,$text){
  if ($class == "") {$tclasstxt = "";} else {$tclasstxt = ' class="'.$class.'" ';}
  print "<span ".$tclasstxt.">".$text."</span>";
}

function XHEADTXT($text){
    print '<strong class="text-primary">'.$text.'</strong>';
}

// BB Adaptations

function BSECTION(){
    echo '<br><section class="statistics">'."\n";
}

function B_SECTION(){
    echo '</section><br>'."\n";
}

function BSECTIONROW(){
    echo '<div class="container-fluid" >'."\n";
    echo '<div class="row d-flex" >'."\n";
}

function B_SECTIONROW(){
    echo '</div>'."\n";
    echo '</div>'."\n";
}

function BCOLCARD($cols){
    echo '<div class="col-md-'.$cols.'" >'."\n";
    echo '<div class="card income" >'."\n";
}

function B_COLCARD(){
    echo '</div>'."\n";
    echo '</div>'."\n";
}

function BCOLCARDDROPDOWN($id,$cols){  // doesnt fully work
    echo '<div class="col-md-'.$cols.'" >'."\n";
    echo "<div id='".$id."-wrapper' class='card updates ".$id."'>"."\n";
    echo "<div id='".$id."-header' class='card-header d-flex justify-content-between align-items-center'>"."\n";
    echo "<h5 class='h5 display'><a data-toggle='collapse' data-parent='#".$id."-wrapper' href='#".$id."-box' aria-expanded='true' aria-controls='".$id."-box' class=''>".$id."</a></h5>"."\n";
    echo "<a data-toggle='collapse' data-parent='#".$id."-wrapper' href='#".$id."-box' aria-expanded='true' aria-controls='".$id."-box' class=''><i class='fa fa-angle-down'></i></a>"."\n";
    echo "</div>"."\n";
    echo "<div id='".$id."-box' role='tabpanel' class='collapse show'>"."\n";
}

function B_COLCARDDROPDOWN(){  // doesnt fully work
    echo '</div>'."\n";
    echo '</div>'."\n";
    echo '</div>'."\n";
}

function XTDCLASSID($id,$class){
  // var_dump($id);
  if ($id) { $id1="id='".$id."'";}
  if ($class) { $class1="class='".$class."'";}
  echo "<td ".$id1." ".$class1.">";
}

function XTHCLASSID($id,$class){
  // var_dump($id);
  if ($id) { $id1="id='".$id."'";}
  if ($class) { $class1="class='".$class."'";}
  echo "<th ".$id1." ".$class1.">";
}

function XTHCOL($colspan){
  echo "<th colspan='".$colspan."'>";
}

function XTDCOL($colspan){
  echo "<td colspan='".$colspan."'>";
}

function XLIPSUM(){
  echo "
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus maximus lectus non neque pulvinar, sit amet rutrum quam ornare. Maecenas sit amet nisl orci. Cras ac erat nec elit porttitor vehicula. Vivamus ac arcu porta, vestibulum ante ac, porta turpis. Aliquam aliquet ex at quam elementum, nec cursus quam laoreet. Nam commodo lectus in consectetur sagittis. Quisque fermentum vitae dolor sit amet viverra.";
}

function XPSMALL($text){
  echo "<p class='smallText'>".$text."</p>";
}

function XPNORMAL($text){
  echo "<p class='normalText'>".$text."</p>";
}

function XPLARGE($text){
  echo "<p class='largeText'>".$text."</p>";
}
?>
