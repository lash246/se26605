<?php
// people table view
foreach ($people as $person) {
	echo $person['corp'] ." " . $person['incorp_dt'] . " " . $person['email'] ." ". $person['zipcode'] ." " . $person['owner'] ." " . $person['phone'];
	echo "<br />";
	
}
?>
<form action='index.php' method='get'>
	<input type='submit' name='action' value="Add" />
</form>