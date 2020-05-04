<?php include "../inc/dbinfo.inc"; ?>

<html lang="en">


<?php


  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

?>


	<head>
		<title>Entertainment Tracker</title>
	        
	</head>
	<body><center>
		 <body style='background-color:LightBlue;>
		<div id='front-page'>
			<h1><a style='text-decoration: none; Font-Size: 150%' href=''><span><Center>Entertainment Tracker</Center></span></a></h1>
			<div class='space' id='links'><a class="shm-clink" data-clink-sel="" href="Anime.php">Anime</a> <a class="shm-clink" data-clink-sel="" href="Manga.php">Manga</a> <a class="shm-clink" data-clink-sel="" href="Movies.php">Movies</a> <a class="shm-clink" data-clink-sel="" href="Musicals.php">Musicals</a> <a class="shm-clink" data-clink-sel="" href="VideoGames.php">Video Games</a></div>
			</div> 
			<div class='space' id='message'><!--ja31114--p103--></div>
			<div></div>
			<div class='space' id='foot'>


			</div>
		</div>
	</Center></body>
 <footer>
   <style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: red;
  color: white;
  text-align: center;
}
</style>

<div class="footer">
  <p>Made By: Kellen Rouff  Email: KJR62@pitt.edu   Capston 2020</p>
</div> 
</footer> 
</html>


