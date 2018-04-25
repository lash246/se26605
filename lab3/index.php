<?php
	
	require_once("corps.php");
    require_once("db.php");
    if(!isset($_SESSION))
    {
        session_start();
    }
    $action = ( array_key_exists( 'action', $_REQUEST) ? $_REQUEST['action'] : "");
    if(isset($_SESSION['idS']))
    {
        $_SESSION['idS'];
    }
    else
    {
        $_SESSION['idS'] = 0;
    }
	
	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING) ?? "";
    $corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
    $incorp_dt = filter_input(INPUT_POST, 'incorp_dt', FILTER_SANITIZE_STRING) ?? "";
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
    $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
    $owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";
	
    switch($action)
    {
        case "Read":
            corpRead($db,$id);
            break;
        case "Update":
            corpUpdate($db,$id);
            break;
		case "Delete":
            corpDelete($db,$id);
            break;
        case "modify":
            corpedit($db,$_SESSION['idS'],$corp,$incorp_dt,$email,$zipcode,$owner,$phone);
            break;
		case "Add":
            corpAdd($db,$corp,$email,$zipcode,$owner,$phone);
            break;
        case "Add2":
            corpAdd2($db);
            break;
        default:
		$corp = getRows($db);
        include_once("corpsTable.php");
    }
	
?>

