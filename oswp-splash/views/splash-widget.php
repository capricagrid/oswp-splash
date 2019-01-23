<!-- This file is used to markup the public-facing widget. -->

<?php
// Konfig Anfang
/* MySQL Database */
$CONF_db_server   = "localhost";		     //Your Database-Server
$CONF_db_user  = "databaseuser";       	             // login
$CONF_db_pass    = "password";     	     // password
$CONF_db_database   = "opensimdatabasename"; // Name of BDD
// Konfig Ende

// Hier steht der Code der Funktion(en), die die eigentliche Funktionalität enthält

//<!-- Datenbankabfrage Statistik -->


//include("./includes/config.php");
  
$con = mysqli_connect($CONF_db_server,$CONF_db_user,$CONF_db_pass,$CONF_db_database);

// Query the database and get the count

$result1 = mysqli_query($con,"SELECT COUNT(*) FROM Presence") or die("Error: " . mysqli_error($con));
list($totalUsers) = mysqli_fetch_row($result1);

$result2 = mysqli_query($con,"SELECT COUNT(*) FROM regions") or die("Error: " . mysqli_error($con));
list($totalRegions) = mysqli_fetch_row($result2);

$result3 = mysqli_query($con,"SELECT COUNT(*) FROM UserAccounts") or die("Error: " . mysqli_error($con));
list($totalAccounts) = mysqli_fetch_row($result3);

$result4 = mysqli_query($con,"SELECT COUNT(*) FROM GridUser WHERE Login > (UNIX_TIMESTAMP() - (30*86400))") or die("Error: " . mysqli_error($con));
list($activeUsers) = mysqli_fetch_row($result4);

// Display the results
echo "<b><h2>Grid Status</h2>";
echo "<div id='stats2'><b>Nutzer im Grid</font> : ". $totalUsers ."<br>";
echo "Regionen</font> : ". $totalRegions ."<font #FFFFFF><br>";
echo "Aktiv in den letzten 30 Tage</font> : ". $activeUsers ."<br>";
echo "Nutzer</font> : ". $totalAccounts ."<br>";
echo "<font color=#00AA00>Grid is ONLINE</font></b><br></div>";
/* echo "<font color=#AA0000>Grid is OFFLINE</font></b>";<br></div> */
?>


