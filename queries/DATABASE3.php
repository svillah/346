<h1>Select NHL Team</h1>

<form action="HANDLE3.php" method="get">

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
?>

<?php
// SQL statement that pulls all team names and team IDs
$sql = "SELECT t.tname, t.tid "
. "FROM teams t ";

// Prepared statement that prepares, binds, executes, binds result variables
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($tname, $tid);	//binds two columns from query

//allows user to pick team 
echo '<label for="team">Pick Team: </label>'; 
echo '<select name="team">'; 
while ($stmt->fetch()) 
{
printf ('<option value="%s">%s</option>', $tname, $tname); 
}
echo '</select><br>'; 
?>
<p></p>

<?php
//allows user to pick save percentage
echo '<label for="team">Pick all players with saves BELOW x percentage </label>';
echo '<INPUT TYPE="radio" NAME="q1" VALUE="0.75">75
<INPUT TYPE="radio" NAME="q1" VALUE="0.80">80
<INPUT TYPE="radio" NAME="q1" VALUE="0.85">85
<INPUT TYPE="radio" NAME="q1" VALUE="0.90">90
<INPUT TYPE="radio" NAME="q1" VALUE="0.95">95<br>'; 

/* close statement and connection*/ 
$stmt->close(); 
$mysqli->close();
?>

<br>
<input type="submit" value="Continue"/>
</br>
</form>
</body>