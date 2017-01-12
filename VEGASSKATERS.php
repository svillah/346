<h1>Skaters</h1>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();

//SQL statement that pulls player stats
$sql = "SELECT DISTINCT p.tid, CONCAT(p.firstname, ' ', p.lastname) AS p_name, p.age, p.caphit, p.goals, p.assists, p.Points, s.sposition, s.handles "
. "FROM players p JOIN skaters s ON (p.pid = s.pid) "
. "WHERE p.Protected LIKE 'NO' AND p.GamesPlayed >30 AND p.points > 10 AND p.age<33 AND p.Position NOT LIKE 'G' ORDER BY p.tid ASC ";

// Prepared statement that prepares, binds, executes, binds result variables
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($tid, $name, $age, $caphit, $goals, $assists, $points, $sposition, $shandles);

//print statements outlining information about the results
echo '<ul>';
printf('All skaters that are unprotected and have played over 30 games, scored more than 10 points and are under the age of 33. ');
?>
<p></p>

<?php
printf('Team - player name, age, cap hit, goals, assists, points - position - handles ');
?>
<p></p>

<?php

while($stmt->fetch())
{
//prints out actual results
printf('<table>%s - %s, %d, %.2f, %d, %d, %d - %s - %s</table>', $tid, $name, $age, $caphit, $goals, $assists, $points, $sposition, $shandles);
}
echo '</ul>';

$stmt->close();
$mysqli->close();

?>
