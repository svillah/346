<h1>Select NHL Division</h1>

<form action="HANDLE4.php" method="get">

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
?>

<?php
//SQL statement that pulls NHL divisions
$sql = "SELECT DISTINCT t.division "
. "FROM teams t ";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($division);

//allows user to pick division from drop down

echo '<label for="division">Pick Division: </label>'; 
echo '<select name="division">'; 
while ($stmt->fetch()) 
{
printf ('<option value="%s">%s</option>', $division, $division); 
}
echo '</select><br>'; 
?>
<p></p>

<?php
//allows user to pick minimum amount of players who are unprotected
echo '<label for="division">Minimum amount of unprotected players: </label>'; 
echo '<input type="number" min="0" max="50" name="aname" value=""/><br>';

/* close statement and connection*/ 
$stmt->close(); 
$mysqli->close();
?>

<br>
<input type="submit" value="Continue"/>
</br>
</form>
</body>