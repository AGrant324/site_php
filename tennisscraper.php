<?php 

/*
<div class="placeholder">&nbsp;</div>
    <table class="display-table width-90 center-margin cellpadding-4 no-cellspacing">
    <tr>
  <td colspan="3" class="valign-top left-align">
  <h4 class="listheading">South Hants Lawn Tennis Club</h4></td>
  </tr>
  <tr>
  <td class="width-1">&nbsp;</td>
  <td>Northlands RoadSouthampton</td>
  <td class="telrow">(023) 8077 6648</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  <td>Hampshire, SO15 2LN</td>
  <td class="emailrow">    
  <a href="mailto:joining@shltc.org"> joining@shltc.org</a>
  </td>  </tr>
  <tr>
  <td>&nbsp;</td>
  <td><a href="Javascript:PostCodeMap('SO15+2LN')">see it on the map</a></td>
  <td class="websiterow">    <a href="http://www.shltc.org" target="_blank" title=""> shltc.org</a>&nbsp;
  </td>  </tr>
  <tr>
  <td colspan="3">
  <!-- table starts -->
  <table class="courtinfo-table">
  <tr>
  <td class="width-30"><h5>Courts</h5></td>
  <td class="width-15 center-align">clay</td>
  <td class="width-15 center-align">grass</td>
  <td class="width-15 center-align">hard</td>
  <td class="width-15 center-align">carpet</td>
  </tr>
  <tr>
  <td>&nbsp;&nbsp;indoor</td>
  <td class="center-align">-</td>
  <td class="center-align">-</td>
  <td class="center-align">-</td>
  <td class="center-align">-</td>
  </tr>
  <tr>
  <td>&nbsp;&nbsp;outdoor (floodlit)</td>
  <td class="center-align">-</td>
  <td class="center-align">-</td>
  <td class="center-align">-</td>
  <td class="center-align">-</td>
  </tr>
  <tr>
  <td>&nbsp;&nbsp;outdoor (not floodlit)</td>
  <td class="center-align">-</td>
  <td class="center-align">4</td>
  <td class="center-align">-</td>
  <td class="center-align">-</td>
  </tr>
  </table>
  <!-- table ends -->  </td>
  </tr>
  </table>
*/

$batch = $_REQUEST["Batch"];
$tr1 = "R";
$tr2 = "T";


$countya = Array();

if ( $batch == "A" ) {array_push($countya, "Berkshire"); }
if ( $batch == "A" ) {array_push($countya, "Buckinghamshire"); }
if ( $batch == "W" ) {array_push($countya, "East Sussex"); }
if ( $batch == "A" ) {array_push($countya, "Hampshire"); }
if ( $batch == "A" ) {array_push($countya, "Kent"); }
if ( $batch == "B" ) {array_push($countya, "Middlesex"); }
if ( $batch == "B" ) {array_push($countya, "Oxfordshire"); }
if ( $batch == "C" ) {array_push($countya, "Surrey"); }
if ( $batch == "X" ) {array_push($countya, "West Sussex"); }
if ( $batch == "C" ) {array_push($countya, "Bedfordshire"); }
if ( $batch == "C" ) {array_push($countya, "Cambridgeshire"); }
if ( $batch == "C" ) {array_push($countya, "Essex"); }
if ( $batch == "D" ) {array_push($countya, "Hertfordshire"); }
if ( $batch == "D" ) {array_push($countya, "Norfolk"); }
if ( $batch == "D" ) {array_push($countya, "Suffolk"); }
if ( $batch == "D" ) {array_push($countya, "Cheshire"); }
if ( $batch == "D" ) {array_push($countya, "Cumbria"); }
if ( $batch == "E" ) {array_push($countya, "Lancashire"); }
if ( $batch == "E" ) {array_push($countya, "Herefordshire"); }
if ( $batch == "E" ) {array_push($countya, "Shropshire"); }
if ( $batch == "E" ) {array_push($countya, "Staffordshire"); }
if ( $batch == "F" ) {array_push($countya, "Warwickshire"); }
if ( $batch == "F" ) {array_push($countya, "Worcestershire"); }
if ( $batch == "F" ) {array_push($countya, "Durham"); }
if ( $batch == "F" ) {array_push($countya, "Northumberland"); }
if ( $batch == "X" ) {array_push($countya, "East Yorkshire"); }
if ( $batch == "X" ) {array_push($countya, "North Yorkshire"); }
if ( $batch == "Y" ) {array_push($countya, "South Yorkshire"); }
if ( $batch == "Y" ) {array_push($countya, "West Yorkshire"); }
if ( $batch == "G" ) {array_push($countya, "Devon"); }
if ( $batch == "G" ) {array_push($countya, "Dorset"); }
if ( $batch == "G" ) {array_push($countya, "Cornwall"); }
if ( $batch == "G" ) {array_push($countya, "Gloucestershire"); }
if ( $batch == "H" ) {array_push($countya, "Somerset"); }
if ( $batch == "H" ) {array_push($countya, "Wiltshire"); }
if ( $batch == "H" ) {array_push($countya, "Derbyshire"); }
if ( $batch == "H" ) {array_push($countya, "Northamptonshire"); }
if ( $batch == "I" ) {array_push($countya, "Nottinghamshire"); }
if ( $batch == "I" ) {array_push($countya, "Leicestershire"); }
if ( $batch == "I" ) {array_push($countya, "Lincolnshire"); }
if ( $batch == "I" ) {array_push($countya, "Rutland"); }
$countypagesa = Array();

foreach ($countya as $county) {
    sleep(1);
    echo $county."<br>";
    if ($tr1 == "R") {
        $url = 'http://tennishub.co.uk/tennis-clubs-by-county/'.$county;
        $url = str_replace(" ","%20",$url);
        $html = file_get_contents($url);
        $htmla = explode("<",$html);
        foreach ($htmla as $htmlline) {
            if (strlen(strstr($htmlline,"Page 1 of"))>0){
                $hbits = explode(" of ",$htmlline);
                $kbits = explode(" ",$hbits[1]);
                $countypagesa[$county] = intval($kbits[0]);
                echo $county." ".$kbits[0]."<br>";
            }
        }
    }
}

echo "============================<br>";

$ci = 0;

foreach ($countya as $county) {
    // if (strlen(strstr($county," "))>0) {} else {    
    $ci++;
    if ( $ci < 5 ) {
        
        for ($pi = 1; $pi <= $countypagesa[$county]; $cp++) {
            sleep(1);
            $clubname = "";
            $clubaddr = "";
            $clubpostcode = "";
            $clubtel = "";
            $clubemail = "";
            $clubwebsite = "";
            $indoor = Array();
            $outdoorf = Array();
            $outdoornf = Array();                          
            
            if ($pi == 1) { $endtext = ""; }
            else { $endtext = "/".$pi; }
            $url = 'http://tennishub.co.uk/tennis-clubs-by-county/'.urlencode($county).$endtext;
            echo $url."<br>";
            if ($tr2 == "R") {
                $html = file_get_contents($url);
                $htmla = explode("<",$html);
                $hi = -1;
                foreach ($htmla as $htmlline) {
                    $hi++;
                    
                    // <h4 class="listheading">Amherst Tennis</h4>
                    if (strlen(strstr($htmlline,'class="listheading"')) > 0){
                        $abits = explode('>',$htmla[$hi]);
                        $clubname = $abits[1];
                    }
                    
                    // <td>Northlands RoadSouthampton</td>
                    // <td class="telrow">(023) 8077 6648</td>
                    if (strlen(strstr($htmlline,'class="telrow"')) > 0){
                        $abits = explode('>',$htmla[$hi]);
                        $clubtel = $abits[1];
                        
                        $abits = explode('>',$htmla[$hi-2]);
                        $clubaddr = $abits[1];
                    }
                    
                    // <td>Hampshire, SO15 2LN</td>
                    // <td class="emailrow">
                    // <a href="mailto:joining@shltc.org"> joining@shltc.org</a>
                    if (strlen(strstr($htmlline,'class="emailrow"')) > 0){
                        $abits = explode('>',$htmla[$hi-2]);
                        $clubpostcode = $abits[1];
                        $abits = explode('>',$htmla[$hi+1]);
                        $clubemail = $abits[1];
                    }
                    
                    //   <td class="websiterow">    <a href="http://www.shltc.org" target="_blank" title=""> shltc.org</a>&nbsp;
                    if (strlen(strstr($htmlline,'class="websiterow"')) > 0){
                        $abits = explode('>',$htmla[$hi+1]);
                        $clubwebsite = $abits[1];
                    }
                    
                    // <td>&nbsp;&nbsp;indoor</td>
                    // <td class="center-align">-</td>
                    // <td class="center-align">-</td>
                    // <td class="center-align">-</td>
                    // <td class="center-align">-</td>
                    // </tr>
                    if (strlen(strstr($htmlline,';indoor')) > 0){
                        $abits = explode('>',$htmla[$hi+2]);
                        $indoor[0] = $abits[1];
                        $abits = explode('>',$htmla[$hi+4]);
                        $indoor[1] = $abits[1];
                        $abits = explode('>',$htmla[$hi+6]);
                        $indoor[2] = $abits[1];
                        $abits = explode('>',$htmla[$hi+8]);
                        $indoor[3] = $abits[1];
                    }
                    if (strlen(strstr($htmlline,';outdoor (floodlit)')) > 0){
                        $abits = explode('>',$htmla[$hi+2]);
                        $outdoorf[0] = $abits[1];
                        $abits = explode('>',$htmla[$hi+4]);
                        $outdoorf[1] = $abits[1];
                        $abits = explode('>',$htmla[$hi+6]);
                        $outdoorf[2] = $abits[1];
                        $abits = explode('>',$htmla[$hi+8]);
                        $outdoorf[3] = $abits[1];
                    }
                    if (strlen(strstr($htmlline,';outdoor (not floodlit)')) > 0){
                        $abits = explode('>',$htmla[$hi+2]);
                        $outdoornf[0] = $abits[1];
                        $abits = explode('>',$htmla[$hi+4]);
                        $outdoornf[1] = $abits[1];
                        $abits = explode('>',$htmla[$hi+6]);
                        $outdoornf[2] = $abits[1];
                        $abits = explode('>',$htmla[$hi+8]);
                        $outdoornf[3] = $abits[1];
                    }
                    if (strlen(strstr($htmlline,'-- table ends --')) > 0){
                        echo $clubname."|";
                        echo $clubaddr."|";
                        echo $clubpostcode."|";
                        echo $clubtel."|";
                        echo $clubemail."|";
                        echo $clubwebsite."|";
                        echo $indoor[0]."|".$indoor[1]."|".$indoor[2]."|".$indoor[3]."|";
                        echo $outdoorf[0]."|".$outdoorf[1]."|".$outdoorf[2]."|".$outdoorf[3]."|";
                        echo $outdoornf[0]."|".$outdoornf[1]."|".$outdoornf[2]."|".$outdoornf[3]."|<br>";
                        
                        $clubname = "";
                        $clubaddr = "";
                        $clubpostcode = "";
                        $clubtel = "";
                        $clubemail = "";
                        $clubwebsite = "";
                        $indoor = Array();
                        $outdoorf = Array();
                        $outdoornf = Array();
                    }
                }
            }
        }       

    // }
    }
}



?>

