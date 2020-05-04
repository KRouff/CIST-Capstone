\<?php include "../inc/dbinfo.inc"; ?>
<html>
<body><Center>
<body style='background-color:LightBlue'>

<h1>Anime</h1>
<div class='space' id='links'><a class="shm-clink" data-clink-sel="" href="Home.php">Home</a> <a class="shm-clink" data-clink-sel="" href="Anime.php">Anime</a> <a class="shm-clink" data-clink-sel="" href="Manga.php">Manga</a> <a class="shm-clink" data-clink-sel="" href="Movies.php">Movies</a> <a class="shm-clink" data-clink-sel="" href="Musicals.php">Musicals</a> <a class="shm-clink" data-clink-sel="" href="VideoGames.php">Video Games</a></div>

<?php


  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the Anime table exists. */
  VerifyAnimeTable($connection, DB_DATABASE);

 /* import */
 importcsv($connection, DB_DATABASE); 

  /* If input fields are populated, add a row to the Anime table. */
  $anime_name = htmlentities($_POST['NAME']);
  $anime_rating = htmlentities($_POST['RATING']);
  $anime_watched = htmlentities($_POST['WATCHED']);

  if (strlen($anime_name) || strlen($anime_rating) || strlen($anime_watched)) {
    Addanime($connection, $anime_name, $anime_rating, $anime_watched);}


?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>NAME</td>
      <td>RATING</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="NAME" maxlength="45" size="50" />
      </td>
      <td>
        <input type="int" name="RATING" maxlength="8" size="10" />
      </td>
      <td>
        <input type="submit" value="Add Data" />
      </td>
    </tr>
  </table>
</form>

<!-- Display table data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>NAME</td>
    <td>RATING</td>
    <td>SET RATING</td>
    <td>DELETE</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM ANIMES");

while($query_data = mysqli_fetch_row($result)) {
echo "<form action=Anime.php method=post>";  
echo "<tr>";
  echo "<td>", $query_data[0] , "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>";
  ECHO "<td>","<a href=AnimeUpdate1.php?ID=$query_data[0]>1</a>","<a href=AnimeUpdate2.php?ID=$query_data[0]>2</a>","<a href=AnimeUpdate3.php?ID=$query_data[0]>3</a>","<a href=AnimeUpdate4.php?ID=$query_data[0]>4</a>","<a href=AnimeUpdate5.php?ID=$query_data[0]>5</a>", "</td>";
  echo "<td>", "<a href=AnimeDelete.php?ID=$query_data[0]>DELETE</a>" , "</td>";
  echo "</tr>";
echo "</form>";
}
?>

</table>

<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>

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


<?php

/* Add an anime to the table. */
function Addanime($connection, $name, $rating, $watched) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $rating);
   $w = mysqli_real_escape_string($connection, $watched);

   $queryadd = "INSERT INTO ANIMES (NAME, RATING, WATCHED) VALUES ('$n', '$a', '$w')";

   if(!mysqli_query($connection, $queryadd)) echo("<p>Error adding Anime data.</p>");
}

function Deleteanime($connection, $name, $rating) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $rating);
   $w = mysqli_real_escape_string($connection, $watched);

   $querydel = "DELETE FROM ANIMES WHERE $name=$_POST;";

   if(!mysqli_query($connection, $querydel)) echo("<p>Error deleting Anime data.</p>");
}

function Updateanime($connection, $name, $rating, $watched) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $rating);
   $w = mysqli_real_escape_string($connection, $watched);

   $queryup =  "UPDATE ANIME SET $rating='$_POST[rate]' WHERE $name=$_POST;";

   if(!mysqli_query($connection, $queryup)) echo("<p>Error updating Anime data.</p>");
}



/* Check whether the table exists and, if not, create it. */
function VerifyanimeTable($connection, $dbName) {
  if(!TableExists("ANIMES", $connection, $dbName))
  {
     $querycte = "CREATE TABLE ANIMES (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         NAME VARCHAR(45),
         RATING int(5),
         WATCHED CHAR(3)
       )";

     if(!mysqli_query($connection, $querycte)) echo("<p>Error creating table.</p>");
  }
}

/*import csv. */
function Importcsv($connection, $dbname) {
$import = "LOAD DATA INFILE './database/Animes.cvs' INTO TABLE ANIMES";
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);
  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?> 


