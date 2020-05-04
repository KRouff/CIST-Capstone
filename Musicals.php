<?php include "../inc/dbinfo.inc"; ?>
<html>
<body><Center>
<body style='background-color:LightBlue'>

<h1>Musicals</h1>
<div class='space' id='links'><a class="shm-clink" data-clink-sel="" href="Home.php">Home</a> <a class="shm-clink" data-clink-sel="" href="Anime.php">Anime</a> <a class="shm-clink" data-clink-sel="" href="Manga.php">Manga</a> <a class="shm-clink" data-clink-sel="" href="Movies.php">Movies</a> <a class="shm-clink" data-clink-sel="" href="Musicals.php">Musicals</a> <a class="shm-clink" data-clink-sel="" href="VideoGames.php">Video Games</a></div>

<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the Musicals table exists. */
  VerifyMusicalsTable($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the Musicals table. */
  $Musicals_name = htmlentities($_POST['NAME']);
  $Musicals_rating = htmlentities($_POST['RATING']);

  if (strlen($Musicals_name) || strlen($Musicals_rating)) {
    AddMusicals($connection, $Musicals_name, $Musicals_rating);}


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
        <input type="int" name="RATING" maxlength="5" size="10" />
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

$result = mysqli_query($connection, "SELECT * FROM Musicals");

while($query_data = mysqli_fetch_row($result)) {
echo "<form action=Musicals.php method=post>";  
echo "<tr>";
  echo "<td>", $query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>";
  ECHO "<td>","<a href=MusicalUp1.php?ID=$query_data[0]>1</a>","<a href=MusicalUp2.php?ID=$query_data[0]>2</a>","<a href=MusicalUp3.php?ID=$query_data[0]>3</a>","<a href=MusicalUp4.php?ID=$query_data[0]>4</a>","<a href=MusicalUp5.php?ID=$query_data[0]>5</a>","</td>";
  echo "<td>","<a href=MusicalsDelete.php?ID=$query_data[0]>DELETE</a>" , "</td>";
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

/* Add an Musicals to the table. */
function AddMusicals($connection, $name, $rating) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $rating);

   $query = "INSERT INTO Musicals (NAME, RATING) VALUES ('$n', '$a');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding Musicals data.</p>");
}

function DeleteMusicals($connection, $name, $rating) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $rating);

   $query = "DELETE FROM Musicals WHERE $name=$_POST;";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding Musicals data.</p>");
}


/* Check whether the table exists and, if not, create it. */
function VerifyMusicalsTable($connection, $dbName) {
  if(!TableExists("Musicals", $connection, $dbName))
  {
     $query = "CREATE TABLE Musicals (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         NAME VARCHAR(45),
         RATING int(5)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
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


