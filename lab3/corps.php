<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    function getRows($db){
        $stmt = $db->prepare("SELECT * FROM corps");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

	/*READ ALL FIELDS FROM DB*/
    function corpRead($db,$id)
	{
		$sql = $db->prepare("SELECT * FROM corps WHERE id = :id");
        $sql->bindParam(':id',$id,PDO::PARAM_INT);
        $sql->execute();
        $results = $sql->fetch(PDO::FETCH_ASSOC);
        $_SESSION['idS'] = $id;
        ?>

		<b>Corporation ID: </b><?php echo $results['id']?><br>
		<b>Corporation Name: </b><?php echo $results['corp']?><br>
		<b>Date: </b><?php echo $results['incorp_dt']?><br>
		<b>Email: </b><?php echo $results['email']?><br>
		<b>Zip Code: </b><?php echo $results['zipcode']?><br>
		<b>Owner: </b><?php echo $results['owner']?><br>
		<b>Phone Number: </b><?php echo $results['phone']?><br>
 
        <div >
            <a id="links" href="?action=Update&id=<?php echo $results['id'] ?>">Update</a>
            <a id="links" href="?action=Delete&id=<?php echo $results['id'] ?>">Delete</a>
            <a id="links" href="index.php">Back</a>
        </div>
        <?php
    }

    //UPDATE
    function corpUpdate($db,$id)
	{
        $_SESSION['idS'] = $id;
        $sql = $db->prepare("SELECT * FROM corps WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $results = $sql->fetch(PDO::FETCH_ASSOC);
        ?>
		<!-- UPDATE FORM -->
        <div >
        <form method="post" action="index.php">
            <b>Corporation Name </b> <input type="text" name="corp" id="corp" value="<?php echo $results['corp']; ?>" /> <br>
            <b>Date </b> <input type="text" name="incorp_dt" id="incorp_dt" value="<?php echo $results['incorp_dt']; ?>" /><br>
            <b>Email </b> <input type="text" name="email" id="email" value="<?php echo $results['email']; ?>" /> <br>
            <b>Zip Code </b> <input type="text" name="zipcode" id="zipcode" value="<?php echo $results['zipcode']; ?>" /> <br>
            <b>Owner </b> <input type="text" name="owner" id="owner" value="<?php echo $results['owner']; ?>" /> <br>
            <b>Phone Number </b> <input type="text" name="phone" id="phone" value="<?php echo $results['phone']; ?>" /> <br>
          <div>
             <input type="submit" name="action" value="modify">
             <a href="index.php">Back</a>
          </div>
         </div>
        </form>
        <?php
    }
	
	//EDIT FIELDS
    function corpedit($db,$id,$corp,$incorp_dt,$email,$zipcode,$owner,$phone)
    {
        $sql = $db->prepare("UPDATE corps SET corp = :corp, incorp_dt = :incorp_dt,email = :email, zipcode = :zipcode, owner = :owner, phone = :phone WHERE id = :id");
        $sql->bindValue(':id',$_SESSION['idS'],PDO::PARAM_INT);
        $sql->bindParam(':corp', $corp, PDO::PARAM_STR);
        $sql->bindParam(':incorp_dt', $incorp_dt, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':zipcode', $zipcode, PDO::PARAM_INT);
        $sql->bindParam(':owner', $owner, PDO::PARAM_STR);
        $sql->bindParam(':phone', $phone, PDO::PARAM_STR);
        $sql->execute();
        $sql = $db->prepare("SELECT * FROM corps WHERE id = :id");
        $sql->bindParam(':id',$_SESSION['idS'], PDO::PARAM_INT);
        $sql->execute();
        $results = $sql->fetch(PDO::FETCH_ASSOC);

        ?>
        <h1 >Updated!</h1>
		<!-- THE UPDATED FIELDS  -->
		<b>Corporation ID: </b><?php echo $results['id']?><br>
		<b>Corporation Name: </b><?php echo $results['corp']?><br>
		<b>Date: </b><?php echo $results['incorp_dt']?><br>
		<b>Email: </b><?php echo $results['email']?><br>
		<b>Zip Code: </b><?php echo $results['zipcode']?><br>
		<b>Owner: </b><?php echo $results['owner']?><br>
		<b>Phone Number: </b><?php echo $results['phone']?><br>

        <div >
         <a href="index.php">Back</a>
        </div>
        <?php
    }
	
	//DELETE FIELDS
    function corpDelete($db,$id){		
        $sql = $db->prepare("SELECT * FROM corps WHERE id = :id");
        $sql->bindParam(':id',$id,PDO::PARAM_INT);
        $sql->execute();
        $results = $sql->fetch(PDO::FETCH_ASSOC);
        $sql = $db->prepare("DELETE FROM corps WHERE id = :id");
        $sql->bindParam(':id',$id,PDO::PARAM_INT);
        $sql->execute();
        ?>
        <h1> <?php echo $results['corp'] ?> has been deleted!</h1>
        <a id="deleteButton" href="index.php">Back</a>
        <?php
    }

    function corpAdd2($db)
	{
        ?>
        <div >
        <form method="post" action="index.php">
		<!-- ADD CORP -->
        <b>Corporation Name </b> <input type="text" name="corp" id="corp" /> <br>
        <b>Email </b> <input type="text" name="email" id="email" /> <br>
        <b>Zip Code </b> <input type="text" name="zipcode" id="zipcode" /> <br>
        <b>Owner </b> <input type="text" name="owner" id="owner" title="Enter a name." /> <br>
        <b>Phone Number </b> <input type="text" name="phone" id="phone" /> <br>

        <?php
        $corp = filter_input(INPUT_GET, 'corp', FILTER_SANITIZE_STRING) ?? "";
        $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING) ?? "";
        $zipcode = filter_input(INPUT_GET, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
        $owner = filter_input(INPUT_GET, 'owner', FILTER_SANITIZE_STRING) ?? "";
        $phone = filter_input(INPUT_GET, 'phone', FILTER_SANITIZE_STRING) ?? "";
        ?>
        <div >
         <input id="add2Button" type="submit" name="action" value="Add">
         <a  href="index.php">Back</a>
        </div>           
        </div>
        </form>
    <?php
    }

    function corpAdd($db,$corp,$email,$zipcode,$owner,$phone)
	{
        try {
            $sql = $db->prepare("INSERT INTO corps VALUES (null,:corp,NOW(),:email,:zipcode,:owner,:phone)");
            $sql->bindParam(':corp', $corp);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':zipcode', $zipcode);
            $sql->bindParam(':owner', $owner);
            $sql->bindParam(':phone', $phone);
            $sql->execute();
            ?>
            <h1>New corp added!</h1>
            <a href="index.php">Back</a>
            <?php
        }
        catch(PDOException $e){
            die("Couldn't add the company to the database.");
        }
    }
?>