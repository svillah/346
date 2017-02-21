<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include('./my_connect.php');
$mysqli = get_mysqli_conn();

// SQL statement that updates actual table
$sql = "UPDATE players p "
. "SET p.protected = ? "
. "WHERE p.pid = ? ";

// Prepared statement that prepares, binds, executes, binds result variables
$stmt = $mysqli->prepare($sql);		//prepares
$player = $_GET['player']; 		//gets player pid from previous page
$protected = $_GET['q1'];		//gets player protected status from previous pg
$stmt->bind_param('si', $protected, $player); 	//binds parameters

// execute function returns boolean indicating success, database has been updated
if ($stmt->execute()) 
{ 
echo '<h1>Success!</h1>'; 
echo '<p>Player ' . $player . ' protected status updated to ' . $protected . '.</p>'; 
} 
else 
{
echo '<h1>You Failed</h1>'; 	//error statement
echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error; 
} 
$stmt->close(); 
$mysqli->close();
?>

<p>
<a href="DATABASE2.php">Return to list</a>
</p>
</body>