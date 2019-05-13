<?php # corhistoryuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$testorreal = $_REQUEST['TestorReal'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


$corsite_ida = Get_Array('corsite');
foreach ($corsite_ida as $corsite_id) { 

	$imagefound = "0";
	Get_Data('corsite',$corsite_id,'Live');

	$corsite_arkoutletname = $GLOBALS{'corsite_arkoutletname'};	
	$corsite_tabname = $GLOBALS{'corsite_tabname'};	
	$GLOBALS{'corsite_arkoutletname'} = rtrim($GLOBALS{'corsite_arkoutletname'}, " ");
	if ($GLOBALS{'corsite_tabname'} == "") { $GLOBALS{'corsite_tabname'} = $GLOBALS{'corsite_arkoutletname'}; } 
	if ($GLOBALS{'corsite_batch'} == "Batch 1") { $GLOBALS{'corsite_tabname'} = $GLOBALS{'corsite_arkoutletname'}; } 
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P1.jpg";
	$corsite_tabname = $GLOBALS{'corsite_tabname'};	
		
	XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "500");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "600", $inwidth, $inheight);   		
		if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage1'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P1"."_FixedSize_800x500.jpg";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage1'});		
	}
	$GLOBALS{'corsite_proposalimage1title'} = "Site View";
		
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P2.jpg";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "500");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
			if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "600", $inwidth, $inheight);   		
		if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage2'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P2"."_FixedSize_800x500.jpg";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage2'});		
	}
	$GLOBALS{'corsite_proposalimage2title'} = "Site View";
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P3.jpg";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "500");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
			if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "600", $inwidth, $inheight);   		
		if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage3'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P3"."_FixedSize_800x500.jpg";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage3'});		
	}
	$GLOBALS{'corsite_proposalimage3title'} = "Plan";		
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P4.jpg";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("500", "450");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
			if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "600", $inwidth, $inheight);   		
		if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage4'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P4"."_FixedSize_500x450.jpg";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage4'});		
	}
	$GLOBALS{'corsite_proposalimage4title'} = "Plan";	
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P5.jpg";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("500", "450");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
			if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "600", $inwidth, $inheight);   		
		if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage5'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P5"."_FixedSize_500x450.jpg";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage5'});		
	}
	$GLOBALS{'corsite_proposalimage5title'} = "Plan";	
	
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_PA.jpg";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "600");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
			if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "600", $inwidth, $inheight);   		
		if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
		$GLOBALS{'corsite_assmtimage1'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."PA"."_FixedSize_800x600.jpg";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_assmtimage1'});		
	}
	$GLOBALS{'corsite_assmtimage1title'} = "Title Plan";			
	
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_PB.jpg";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "600");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
			if ($imagetype == "jpg") {$current_image = imagecreatefromjpeg($imagefullname);}
		if ($imagetype == "JPG") {$current_image = imagecreatefromjpeg($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "600", $inwidth, $inheight);   		
		if ($imagetype == "jpg") {imagejpeg($canvas, $imagefullname);}
		if ($imagetype == "JPG") {imagejpeg($canvas, $imagefullname);}
		$GLOBALS{'corsite_assmtimage2'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."PB"."_FixedSize_800x600.jpg";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_assmtimage2'});		
	}
	$GLOBALS{'corsite_assmtimage2title'} = "Title Plan";		
	
	
	
	
	
	
	
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P1.png";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "500");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
		if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "500", $inwidth, $inheight);   		
		if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
		if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage1'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P1"."_FixedSize_800x500.png";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage1'});		
	}
	$GLOBALS{'corsite_proposalimage1title'} = "Site View";
		
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P2.png";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "500");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
		if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "500", $inwidth, $inheight);   		
		if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
		if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage2'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P2"."_FixedSize_800x500.png";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage2'});		
	}
	$GLOBALS{'corsite_proposalimage2title'} = "Site View";
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P3.png";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "500");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
		if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "500", $inwidth, $inheight);   		
		if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
		if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage3'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P3"."_FixedSize_800x500.png";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage3'});		
	}
	$GLOBALS{'corsite_proposalimage3title'} = "Plan";		
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P4.png";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("500", "450");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
		if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "500", "450", $inwidth, $inheight);   		
		if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
		if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage4'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P4"."_FixedSize_500x450.png";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage4'});		
	}
	$GLOBALS{'corsite_proposalimage4title'} = "Plan";	
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_P5.png";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("500", "450");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
		if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "500", "450", $inwidth, $inheight);   		
		if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
		if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
		$GLOBALS{'corsite_proposalimage5'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."P5"."_FixedSize_500x450.png";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_proposalimage5'});		
	}
	$GLOBALS{'corsite_proposalimage5title'} = "Plan";	
	
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_PA.png";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "600");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
		if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "600", $inwidth, $inheight);   		
		if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
		if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
		$GLOBALS{'corsite_assmtimage1'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."PA"."_FixedSize_800x600.png";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_assmtimage1'});		
	}
	$GLOBALS{'corsite_assmtimage1title'} = "Title Plan";			
	
	
	$imagefullname = $GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_tabname'}."_PB.png";	
	// XPTXT("Check for - ".$imagefullname);	
	if (file_exists($imagefullname)) {
		$imagefound = "1";
		XPTXT("Found - ".$imagefullname);					
		$canvas = imagecreatetruecolor("800", "600");			
		list($inwidth, $inheight) = getimagesize($imagefullname);		
		$bits = explode("/",$imagefullname);
		$imagename = end($bits);
		$bits = explode(".",$imagename);
		$imagetype = end($bits);
		if ($imagetype == "png") {$current_image = imagecreatefrompng($imagefullname);}
		if ($imagetype == "PNG") {$current_image = imagecreatefrompng($imagefullname);}		  
		#  imagecopyresampled ( resource dest_image, resource source_image, int dest_x, int dest_y, int source_x, int source_y, int dest_width, int dest_height, int source_width, int source_height);  
		imagecopyresampled ( $canvas, $current_image, 0, 0, 0, 0, "800", "600", $inwidth, $inheight);   		
		if ($imagetype == "png") {imagepng($canvas, $imagefullname);}
		if ($imagetype == "PNG") {imagepng($canvas, $imagefullname);}
		$GLOBALS{'corsite_assmtimage2'} = "Property_".$corsite_id."_".$GLOBALS{'corsite_tabname'}."PB"."_FixedSize_800x600.png";		
		copy($imagefullname,$GLOBALS{'domainwwwpath'}."/domain_media/".$GLOBALS{'corsite_assmtimage2'});		
	}
	$GLOBALS{'corsite_assmtimage2title'} = "Title Plan";			
	
	if ( $imagefound == "1" ) {
		$GLOBALS{'corsite_tabname'} = $corsite_tabname;
		$GLOBALS{'corsite_arkoutletname'} = $corsite_arkoutletname;			
		if ($testorreal == "R") { Write_Data('corsite',$corsite_id,'Live'); }
		XH4("========= Images Loaded ======== ".$corsite_id." ".$GLOBALS{'corsite_site'});	
	}		
}


Back_Navigator();
PageFooter("Default","Final");


?>



