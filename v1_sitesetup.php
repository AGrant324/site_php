<?php

// site setup

print "Content-type: text/html\n\n";
print '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'."\n";
print '<html>'."\n";
print '<head>'."\n";
print '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >'."\n";
print '<title>Site Setup</title>'."\n";
print '<style type="text/css">'."\n";
print 'body {background:url("../site_assets/back.jpg") no-repeat;margin-left:250px;margin-top:250px;color:navy;}'."\n";
print '</style>'."\n"; 
print '</head>'."\n";
print '<body>'."\n";
print '<h1>Welcome to Connective Solutions Site Setup - Part 1 of 2</h1>'."\n";
print '<h3>1. Check Pre-requisite actions</h3>'."\n";
print 'Before you run this setup script, please make sure that you have completed the following actions'."\n";
print '<ul>'."\n";
print '<li>Use FTP to install the release package to site</li>'."\n";
print '<li>Establish an SQL database (with no tables) and also a user with appropriate permissions</li>'."\n";
print '<li>Ensure SQL Design schema (sqldesign.csv) is loaded into site_sql</li>'."\n";
print '<li>Ensure Service Configuration Data (setup_service_sql) is loaded into site_sql</li>'."\n";
print '</ul>'."\n";
print '<h3>2. Setup</h3>'."\n";

print '<form name="TForm" action="v1_sitesetup2.php" method="post">'."\n";
print '<table border="2px">'."\n";

print '<tr><td><p>'."\n";
print '<h3>Password</h3>'."\n";
print '<input type="password" name="Password" value="" size="12" maxlength="12" >'."\n";
print '<br><br>'."\n";
print '</td></tr>'."\n";

print '<tr><td><p>'."\n";
print '<h3>Site Name</h3>'."\n";
print '<input id="SiteName" name="SiteName" value="My Site Title" size="75" maxlength="150">'."\n";
print '<h3>Site Script Directory URL - e.g www.mysite.com [<a style="color:red;">A</a>]</h3>'."\n";
print '<input id="SiteScriptDirURL" name="SiteScriptDirURL" value="www.mysite.com" size="75" maxlength="150">'."\n";
print '<h3>Protocol</h3>'."\n";
print '<select name="Protocol">'."\n";
print '<option value="http">http</option>'."\n";
print '<option value="https">https</option>'."\n";
print"</select>\n";
print '<br><br>'."\n";
print '</td></tr>'."\n";

print '<tr><td><p>'."\n";
print '<h3>Website Structure Type (See options below) [<a style="color:red;">B</a>]</h3>'."\n";

print '<table>'."\n";
print '<tr><td><p>'."\n";
print 'Normal Site 0'."\n";
print '</td><td><p>'."\n";
print '<input type="radio" name="Structure" value="Normal0">'."\n";
print '</td><td><p>'."\n";
print '</td></tr>'."\n";

print '<tr><td><p>'."\n";
print 'Normal Site 1'."\n";
print '</td><td><p>'."\n";
print '<input type="radio" name="Structure" value="Normal1">'."\n";
print '</td><td><p>'."\n";
print '</td></tr>'."\n";

print '<tr><td><p>'."\n";
print 'Test/Extra Directory Site 0'."\n";
print '</td><td><p>'."\n";
print '<input type="radio" name="Structure" value="ExtraDir0">'."\n";
print '</td></tr>'."\n";

print '<tr><td><p>'."\n";
print 'Test/Extra Directory Site 1'."\n";
print '</td><td><p>'."\n";
print '<input type="radio" name="Structure" value="ExtraDir1">'."\n";
print '</td></tr>'."\n";
print '</table>'."\n";

print '<h3>Server Type</h3>'."\n";
print '<select name="Server">'."\n";
print '<option value="Normal">Normal</option>'."\n";
print '<option value="W">Test (e.g. Wamp)</option>'."\n";
print"</select>\n";
print '<br><br>'."\n";

print '<h3>Extra Directory (only if www not at same level as scripts)[<a style="color:red;">E</a>]</h3>'."\n";
print '<input id="RootExtraDirectory" name="RootExtraDirectory" value="" size="50" maxlength="100">'."\n";
print '<br><br>'."\n";
print '</td></tr>'."\n";


print '<tr><td><p>'."\n";
print '<h3>Mode_id for new service</h3>'."\n";
print '<select name="ModeId">'."\n";
print '<option value="0">Mode 0 - "Central Multi-Domain Site"</option>'."\n";
print '<option value="1">Mode 1 - "Standalone Site"</option>'."\n";
print "</select>\n";
print '<h3>Domain_id (only if Mode = "1" | Mode 0 is defaulted to Service_id) [<a style="color:red;">C</a>]</h3>'."\n";
print '<input name="DomainId" value="" size="20" maxlength="40">'."\n";
print '<br><br>'."\n";
print '</td></tr>'."\n";

print '<tr><td><p>'."\n";
print '<h3>Service_id for new service (Determines which db variant is used) [<a style="color:red;"><b>D</b></a>]</h3>'."\n";
print '<select name="ServiceId">'."\n";
print '<option value="cw">cw - Bookkeeping</option>'."\n";
print '<option value="sw">sw - Club</option>'."\n";
print '<option value="ocz">ocz - Sports Club</option>'."\n";
print '<option value="aw">aw - Auction</option>'."\n";
print '<option value="pos">pos - Point of Sale</option>'."\n";
print '<option value="cor">cor - Property Management</option>'."\n";
print '<option value="dmws">dmws - Welfare Support</option>'."\n";
print '<option value="grl">grl - GrassRoots League</option>'."\n";
print '<option value="care">care - Care Support</option>'."\n";
print '<option value="db">db - Data Management</option>'."\n";
print '<option value="kb">kb - Knowledge Base</option>'."\n";
print '<option value="sfm">sfm - Sports Facilities Management</option>'."\n";
print"</select>\n";
print"<br>\n";
print '<h3>Service_id Suffix - (If multiple databases of same name are on site)</h3>'."\n";
print '<input name="ServiceIdSuffix" value="" size="5" maxlength="20">'."\n";
print '<br><br>'."\n";
print '</td></tr>'."\n";

print '<tr><td><p>'."\n";
print '<h3>FirstName - Surname (lower case)</h3>'."\n";
print '<input name="FirstName" value="Barry" size="20" maxlength="40">'."\n";
print '<input name="SurName" value="Bradley" size="20" maxlength="40">'."\n";
print '</td></tr>'."\n";

print '<tr><td><p>'."\n";
print '<h3>Database parameters - dbname(or "multidb" for test) - host - user - password</h3>'."\n";
print '<input name="DBName" value="" size="15" maxlength="40">'."\n";
print '<input name="DBHost" value="" size="15" maxlength="40">'."\n";
print '<input name="DBUser" value="" size="15" maxlength="40">'."\n";
print '<input name="DBPassword" value="" size="15" maxlength="40">'."\n";
print '<br><br>'."\n";
print '</td></tr>'."\n";

print '<tr><td><p><p>'."\n";
print '<input type="submit" value="Setup">'."\n";
print '</td></tr>'."\n";

print '</table>'."\n";
print '</form>'."\n";

print '</hr><br>'."\n";
print '<h2>Website Structure Options</h2>'."\n";
print '<img src="../site_assets/sitesetup.png" width="100%">'."\n";

print '</body>'."\n";
print '</html>'."\n";

?>