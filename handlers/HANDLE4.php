<h1>Team by Division Stats</h1>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function

include('./my_connect.php');
$mysqli = get_mysqli_conn();

// SQL statement that pulls stats about teams from specified division
$sql = "SELECT t.tname, t.salarycap, t.capspent, avg(p.points), COUNT(p.protected) "
. "FROM teams t, players p "
. "WHERE t.tid=p.tid AND t.division = ? AND p.protected='no'"
. "GROUP BY t.tname HAVING COUNT(p.protected)> ?";

// Prepared statement that prepares, binds, executes
$stmt = $mysqli->prepare($sql);
$division = $_GET['division']; //gets division from previous page
$unprotected = $_GET['aname']; //gets number of unprotected players from previous page
$stmt->bind_param('ss', $division, $unprotected); 
$stmt->execute();

// Bind result variables 
$stmt->bind_result($tname, $salarycap, $capspent, $pts, $protected); 

echo '<ul>';
printf('Displays teams salary cap, leftover cap, average points only if they have over (inputted) unprotected players . ');
?>
<p></p>

<?php
// Outputs results
while($stmt->fetch())
{
printf('<li>%s, %d, %d, %d (%d)</li>', $tname, $salarycap, $capspent, $pts, $protected);
}
echo '</ul>';

$stmt->close();
$mysqli->close();

?>