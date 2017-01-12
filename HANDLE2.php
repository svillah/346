<h1>Pick Player from Team</h1>

<form action="HANDLE2A.php" method="get"/>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();


// SQL statement that pulls all players from specified team
$sql = "SELECT p.pid, CONCAT(p.firstName, ' ', p.lastName) "
. "FROM players p, teams t " 
. "WHERE p.tid=t.tid AND t.tid = ? ";

// Prepared statement that prepares, binds, executes, binds result variables
$stmt = $mysqli->prepare($sql);
$tid = $_GET['team'];  		//obtains team specified from previous page
// "i" for integer, "d" for double, "s" for string, "b" for blob 
$stmt->bind_param('s', $tid); 	//binds tid to '?' in query
$stmt->execute();
$stmt->bind_result($pid, $player); 

//allows user to pick player from team
echo '<label for="player">Pick Player: </label>'; 
echo '<select name="player">'; 
while ($stmt->fetch()) 
{
printf ('<option value="%s">%s</option>', $pid, $player); 
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