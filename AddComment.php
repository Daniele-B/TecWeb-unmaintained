<?php
	session_start();
	$Opera = $_POST['Opera'];
	$Creatore = $_POST['Creatore'];
	$Commento = htmlspecialchars($_POST['Commento'], ENT_QUOTES, "UTF-8");
	if(isset($_SESSION['Username']))
	{
		$qrStr = "INSERT INTO `commenti`(`Opera`, `Utente`, `Creatore`, `Commento`) VALUES ('".$Opera."','".$_SESSION['Username']."','".$Creatore."','".$Commento."')";
		$myDb= new DbConnector();
    	$myDb->openDBConnection();
    	if($myDb->connected)
    	{
    		if($myDb->doQuery($qrStr)->fetch_assoc())
    		{
    			echo '<div class="comment">';
                echo '  <div class="commentator">'.$_SESSION['Username']."</div>";
                echo $Commento."</div>";
    		}
    		else
    			echo '<script>alert(\'Query failed!\');</script>';
		}
		else
      		echo '<script>alert(\'Database problem!\');</script>';
    }
    else
    	echo '<script>alert(\'Login before!\');</script>';
?>