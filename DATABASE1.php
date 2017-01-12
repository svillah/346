<body>
<h1>TOP COACHES</h1>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);

// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();

$sql = "SELECT t.tname, CONCAT(c.firstName, ' ', c.lastName) AS coach_name, t.salarycap, t.capspent "
. "FROM teams t "
. "JOIN coaches c "
. "ON t.tid=c.tid "
. "WHERE c.games > 200 AND c.wins > 100 "
. "ORDER BY t.tname ";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($team_name, $coach, $salarycap, $capspent);

echo '<ul>';
printf('To see what conference have the most experienced coaches (games over 200) with a good winning record (wins over 100). Also displays salary cap and cap left over. ');
?>
<p></p>

<?php
while($stmt->fetch())
{
printf('<li>%s, %s, %d, %d</li>', $team_name, $coach, $salarycap, $capspent);
}
echo '</ul>';

$stmt->close();
$mysqli->close();

?>