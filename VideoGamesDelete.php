<?php include "../inc/dbinfo.inc"; ?>

<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);
  $deletion = "DELETE FROM VideoGames WHERE ID='$_GET[ID]'";

if(mysqli_query($connection, $deletion))
{header("refresh:1; url=VideoGames.php");}
else
{echo "ERROR";}

?>
