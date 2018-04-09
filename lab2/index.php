<?php
require_once("db.php");
require_once("corp.php");
$action = $_REQUEST['action'];
$corp = $_POST['corp'];
$incorp_dt = $_POST['incorp_dt'];
$email = $_POST['email'];
$zipcode = $_POST['zipcode'];
$owner = $_POST['owner'];
$phone = $_POST['phone'];
switch ($action){
	case "Add":
		include_once("corpForm.php");
		break;
	case "Save":
		savePerson($db, $corp, $incorp_dt, $email, $zipcode, $owner, $phone);
		// get all the rows
		$people = getRows();
		// display the rows
		include_once("corpTable.php");
		break;
	default:
		// get all the rows
		$people = getRows();
		// display the rows
		include_once("corpTable.php");
}