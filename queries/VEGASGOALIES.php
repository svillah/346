<h1>Goalies</h1>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();

//SQL statement that pulls player stats
$sql = "SELECT DISTINCT p.tid, CONCAT(p.firstname, ' ', p.lastname) AS p_name, p.age, p.caphit, g.save, g.goalsAgainstAvg, g.saves "
. "FROM players p JOIN goalies g ON (p.pid = g.pid) "
. "WHERE p.Protected LIKE 'NO' AND p.GamesPlayed >12 AND p.Position LIKE 'G' AND g.save > 0.9 ORDER BY p.tid ASC ";

// Prepared statement that prepares, binds, executes, binds result variables
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($tid, $name, $age, $caphit, $save, $againstavg, $saves);

//print statements outlining information about the results
echo '<ul>';
printf('All goalies that are unprotected and have played over 12 games and save percentage over 90 percent. ');
?>
<p></p>

<?php
printf('Team - player name, age, cap hit - save percentage - goals against average - saves ');
?>
<p></p>

<?php
//prints out actual results
while($stmt->fetch())
{
printf('<table>%s - %s, %d - %.2f - %.2f - %d - %d</table>', $tid, $name, $age, $caphit, $save, $againstavg, $saves);
}
echo '</ul>';

$stmt->close();
$mysqli->close();

?>
