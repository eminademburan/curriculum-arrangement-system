<?php
$hostServer = "dijkstra.cs.bilkent.edu.tr";
$dbUserName = "adem.buran";
$dbPassword = "Yfle8psq";
$dbName = "adem_buran";

//make the database connection
$adress = mysqli_connect( $hostServer, $dbUserName, $dbPassword,$dbName);

//if database connectıon fails give meaninful mesage to user
if( $adress == false )
{
	echo "Database connection fail";
}
?>