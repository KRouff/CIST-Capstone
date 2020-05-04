<?php include "../inc/dbinfo.inc"; ?>

<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);
  $Update = "UPDATE VideoGames SET RATING=4  WHERE ID='$_GET[ID]'";

  if ( mysqli_query($connection, $Update))
	header("refresh:1; url=VideoGames.php");
  else
	echo "Failed to update";
?>

