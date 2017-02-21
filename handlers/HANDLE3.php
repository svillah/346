<h1>Goalies from Team</h1>

<form action="UPDATE_CAPSPENT3.php" method="get"/>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function

include('./my_connect.php');
$mysqli = get_mysqli_conn();

// SQL statement that pulls goalie stats
$sql = "SELECT t.tname, CONCAT(p.firstname, ' ',p.lastname) AS player_name, p.caphit, p.protected, g1.save "
. "FROM players p, teams t, goalies g1 "
. "WHERE g1.pid = p.pid AND t.tname = ? AND p.tid=t.tid AND p.pid IN (SELECT g.pid FROM goalies g WHERE g.save < ?)  "
. "ORDER BY p.caphit ";

// Prepared statement that prepares, binds, executes, binds result variables
$stmt = $mysqli->prepare($sql);
$tname = $_GET['team'];		//pulls specified team name from previous page
$q1 = $_GET['q1']; 		//pulls specified save percentage from previous pg
$stmt->bind_param('sd', $tname, $q1);	//binds specified parameters 
$stmt->execute();
$stmt->bind_result($tname, $player, $caphit, $protected, $per); //binds query results

echo '<ul>';
printf('To see team, name, cap hit of goalies whose save percentage is less than the (inputted) percentage ');
?>
<p></p>

<?php
printf('If empty, there are no goalies that fulfill requirements. ');
?>
<p></p>

<?php
while($stmt->fetch())
{
//prints out results
printf('<li>%s, %s, %.2f, %s - (%.4f)</li>', $tname, $player, $caphit, $protected, $per);
}
echo '</ul>';

$stmt->close();
$mysqli->close();

?>