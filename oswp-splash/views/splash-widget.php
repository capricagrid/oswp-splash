<?php
	global $wpdb;
	// Fehler anzeigen
	//$wpdb->show_errors();
	
	// Tabellenname erstellen
	$tablename = $wpdb->prefix . "ossplash";
	
	// Auslesen der wp datenbank
	$CONF_db_serveross = $wpdb->get_var( "SELECT CONF_db_server FROM $tablename" );
	$CONF_db_useross = $wpdb->get_var( "SELECT CONF_db_user FROM $tablename" );
	$CONF_db_passoss = $wpdb->get_var( "SELECT CONF_db_pass FROM $tablename" );
	$CONF_db_databaseoss = $wpdb->get_var( "SELECT CONF_db_database FROM $tablename" );
	$CONF_os_nameoss = $wpdb->get_var( "SELECT CONF_os_name FROM $tablename" );
	  
$con = mysqli_connect($CONF_db_serveross,$CONF_db_useross,$CONF_db_passoss,$CONF_db_databaseoss);

// Query the database and get the count

$resultoss1 = mysqli_query($con,"SELECT COUNT(*) FROM Presence") or die("Error: " . mysqli_error($con));
list($totalUsers) = mysqli_fetch_row($resultoss1);

$resultoss2 = mysqli_query($con,"SELECT COUNT(*) FROM regions") or die("Error: " . mysqli_error($con));
list($totalRegions) = mysqli_fetch_row($resultoss2);

$resultoss3 = mysqli_query($con,"SELECT COUNT(*) FROM UserAccounts") or die("Error: " . mysqli_error($con));
list($totalAccounts) = mysqli_fetch_row($resultoss3);

$resultoss4 = mysqli_query($con,"SELECT COUNT(*) FROM GridUser WHERE Login > (UNIX_TIMESTAMP() - (30*86400))") or die("Error: " . mysqli_error($con));
list($activeUsers) = mysqli_fetch_row($resultoss4);

$resultoss5 = mysqli_query($con,"SELECT COUNT(*) FROM GridUser") or die("Error: " . mysqli_error($con));
list($totalGridAccounts) = mysqli_fetch_row($resultoss5);


// Display the results
echo "<h1>$CONF_os_nameoss</h1>";
echo "Nutzer im Grid : ". $totalUsers ."<br>";
echo "Regionen : ". $totalRegions ."<br>";
echo "Aktiv in den letzten 30 Tage : ". $activeUsers ."<br>";
echo "Hypergrid Nutzer : ". $totalGridAccounts ."<br>";
echo "Registrationen : ". $totalAccounts ."<br>";
echo "<h1><font color=#00AA00>Grid ist ONLINE</font></h1></b><br>";
/* echo "<font color=#AA0000>Grid is OFFLINE</font></b>";<br> */

	mysqli_close($con);
	$wpdb->flush(); //Clearing the Cache
?>


