<h1>Select NHL Team</h1>

<form action="HANDLE2.php" method="get">

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();

$name = 'To update the protected state of a player, please choose the team the player is on.';
 echo $name;
?>
<p></p>

<?php
//SQL statement that pulls all teams from table teams
$sql = "SELECT t.tname, t.tid "
. "FROM teams t ";

// Prepared statement that prepares, binds, executes, binds result variables
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($tname, $tid);

//allows user to pick team
echo '<label for="team">Pick Team: </label>'; 
echo '<select name="team">'; 
while ($stmt->fetch()) 
{
printf ('<option value="%s">%s</option>', $tid, $tname); //prints options
}
echo '</select><br>'; 

/* close statement and connection*/ 
$stmt->close(); 
$mysqli->close();
?>

<br>
<input type="submit" value="Continue"/>
</br>
</form>
</body>

