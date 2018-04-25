
<h1> Corporations App </h1>
<form action="index.php" method="get">
        <?php

    foreach($corp as $corporation) 
	{
    ?>
        <tr><br>
         <td>
          <?php
           echo $corporation["corp"];
          ?>
         </td>
            <td><a href="?action=Read&id=<?php echo $corporation['id'] ?>">Read</a></td>
            <td><a href="?action=Update&id=<?php echo $corporation['id'] ?>">Update</a></td>
            <td><a href="?action=Delete&id=<?php echo $corporation['id'] ?>">Delete</a></td>
        </tr>
        <?php
    }
    ?>      
 <center>
  <a href="?action=Add2">create</a>
 <h2>4/25/2018 La-Shaun Christie</h2>
 </center>
</form>
