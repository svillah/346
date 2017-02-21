<h1>Update Player Protection Status</h1>

<form action="UPDATE_CAPSPENT2.php" method="get"/>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();

// SQL statement that pulls protected status of player with specified pid
$sql = "SELECT p.protected "
. "FROM players p "
. "WHERE p.pid= ? ";

// Prepared statement that prepares, binds, executes, binds result variables
$stmt = $mysqli->prepare($sql);
$player_id = $_GET['player']; 		//obtains player pid from previous page 
$stmt->bind_param('s', $player_id);	//binds player pid to ? in above query 
$stmt->execute();
$stmt->bind_result($protected);		//binds the pulled status from query 

/* obtains results from queries */ 
if ($stmt->fetch()) 
{ 
echo '<input type="hidden" name="player" value="' . $player_id . '"/>'; 
echo '<label for="aname">Update Protected Status for Player ' . $player_id . ', currently with Status of '.$protected.' to: </label>'; 
echo '<INPUT TYPE="radio" NAME="q1" VALUE="yes">Yes	
<INPUT TYPE="radio" NAME="q1" VALUE="no">No<br>';
} 
else
{
echo '<label for="aname">Record not found</label>'; 
}
/* close statement and connection*/ 
$stmt->close(); 
$mysqli->close();
?>
<br>
<input type="submit" value="Update"/>
</br>
</form>