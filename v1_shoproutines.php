<?php

function Shop_SETUPSHOP_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Shop_SETUPSHOP_Output() {
    $parm0 = "Shop Update|shop||shop_code|shop_code|25|No";
    $parm1 = "";
    $parm1 = $parm1."shop_code|Yes|Code|50|Yes|Sgop Code|KeyText,15,25^";
    $parm1 = $parm1."shop_name|Yes|Name|100|Yes|Name|InputText,25,50^";
    $parm1 = $parm1."shop_description|No|Description|30|Yes|Description|InputTextArea,6,100^";
    $bannerurldir = "GLOBALDOMAINWWWURL/domain_media";
    $bannerfiledir = "GLOBALDOMAINWWWPATH/domain_media";        
    $parm1 = $parm1."shop_image|No|Image|30|Yes|Image|InputImage,$bannerurldir,$bannerfiledir,600,400,Shop,shop_code^";    
    $parm1 = $parm1."shop_type|No|Type|30|Yes|Type|InputSelectFromList,Internal+External^";
    $parm1 = $parm1."shop_personid|No|Person Id|30|Yes|Club Contact - Person Id|InputText,5,10^";
    $parm1 = $parm1."shop_numberchooser|No|Number|30|Yes|Number Chooser|InputSelectFromList,Yes+No^";
    $parm1 = $parm1."|No|||Yes|External Shop Details|Divider^";
    $parm1 = $parm1."shop_contactname|No|Contact|30|Yes|External Shop Contact Name|InputText,50,150^";
    $parm1 = $parm1."shop_email|No|Email|30|Yes|External Shop Email|InputText,50,150^";
    $parm1 = $parm1."shop_tel|No|Tel|30|Yes|External Shop Tel|InputText,15,50^";
    $parm1 = $parm1."shop_url|No|URL|30|Yes|External Shop URL|InputText,70,150^";
    $parm1 = $parm1."shop_password|No|Website|30|Yes|External Shop Password|InputText,15,50^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}


function Shop_SHOPPING_Output () {
    
    XH3("Club Shop");
    XHR();
    $shopa = Get_Array("shop");
    foreach ($shopa as $shop_code) {
        Get_Data("shop",$shop_code); 
        XHRCLASS("underline");
        XH3($GLOBALS{'shop_name'});
        XBR();
        XLINKIMGNEWWINDOW($GLOBALS{'shop_url'},$GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'shop_image'},$GLOBALS{'shop_name'},"600","400","");
        XBR();XBR();
        XPTXT($GLOBALS{'shop_description'});
        XHRCLASS("underline");
        if ( $GLOBALS{'shop_personid'} != "" ) {
            XH4("Club Contact");
            Check_Data("person",$GLOBALS{'shop_personid'});
            XTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
            XTXT("&nbsp;&nbsp;Mobile: ".$GLOBALS{'person_mobiletel'});
            XTXT("&nbsp;&nbsp;Email: <a href=mailto:".$GLOBALS{'person_email1'}.">".$GLOBALS{'person_email1'}."</a>");
            XHR();
        }  
        
        if ( $GLOBALS{'shop_numberchooser'} == "Yes" ) {
            Get_Data('person',$GLOBALS{'LOGIN_person_id'});
            XH4("My Shirt Number");
            XPTXT("If you are ordering a club shirt that requires a player number, please make sure you have a number allocated to you before you place the order.");
            if ($GLOBALS{'person_shirtnumber'} != "" ) {       
                XTABLEINVISIBLE();
                XTR();XTDTXT("<b>Allocated Shirt Number</b>"); XTDTXT("&nbsp;&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_shirtnumber'}); X_TR();
                X_TABLE(); 
            } else {
                XTABLEINVISIBLE();
                XTR();XTDTXT("<b>Select my shirt number</b>"); XTDTXT("&nbsp;&nbsp;&nbsp;");
                XTD();
                $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SHIRTNUMBERCHOOSER");
                XLINKBUTTONSPECIALNEWWINDOW($link,"Choose my Shirt Number","light","Chooser");
                X_TD();
                X_TR();
                X_TABLE();        
            }
            XHR();
        }       
        
        if ( $GLOBALS{'shop_type'} == "External" ) {
            XH4("Shop Contact");
            XTABLEINVISIBLE();
            XTR();XTDTXT("<b>".$GLOBALS{'shop_name'}." Contact</b>"); XTDTXT("&nbsp;&nbsp;&nbsp;");XTDTXT($GLOBALS{'shop_contactname'}); X_TR();   
            XTR();XTDTXT("<b>Email</b>"); XTDTXT("&nbsp;&nbsp;&nbsp;");XTDTXT("<a href=mailto:".$GLOBALS{'shop_email'}.">".$GLOBALS{'shop_email'}."</a>"); X_TR(); 
            XTR();XTDTXT("<b>Telephone</b>"); XTDTXT("&nbsp;&nbsp;&nbsp;");XTDTXT($GLOBALS{'shop_tel'}); X_TR(); 
            XTR();XTDTXT("<b>Password</b>"); XTDTXT("&nbsp;&nbsp;&nbsp;");XTDTXT($GLOBALS{'shop_password'}); X_TR();            
            X_TABLE();
            XHR();
        }

        XBR();
        XLINKBUTTONNEWWINDOW($GLOBALS{'shop_url'},"Take me to the Shop",$GLOBALS{'shop_name'});
        XBR();
        XHRCLASS("underline");               
    }
    
    
}


?>
