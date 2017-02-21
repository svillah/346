<h1>Maximum Cap Leftover</h1>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();

// SQL statement that general manager with the most cap leftover
$sql = "SELECT CONCAT(gm.firstname,' ', gm.lastname) AS General_Manager, gm.tid, t.capspent "
. "FROM generalManagers gm, teams t "
. "WHERE gm.tid=t.tid AND gm.tid IN (SELECT t1.tid FROM teams t1 WHERE t1.capspent = (SELECT MAX(t2.capspent) FROM teams t2)) ";

// Prepared statement that prepares, binds, executes, binds result variables
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($gm, $tid, $capspent);

echo '<ul>';
printf('To find the general manager from the team who has the biggest cap left over. ');
?>
<p></p>

<?php
while($stmt->fetch())
{
//fetches results from query
printf('<li>%s, %s, %d</li>', $gm, $tid, $capspent);
}
echo '</ul>';

$stmt->close();
$mysqli->close();

?>