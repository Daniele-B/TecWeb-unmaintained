<?php
	require_once "DbConnector.php";
//pass per account admin AdminIsHere

	session_start();
	$pwd= htmlspecialchars($_POST["pwd"], ENT_QUOTES, "UTF-8");//cleaning the input
	$usr= htmlspecialchars($_POST["usr"], ENT_QUOTES, "UTF-8");
	$_SESSION["isLogged"] = "false";
	$_SESSION["Username"] = $usr;
	//connecting to db
	$myDb= new DbConnector();
	$myDb->openDBConnection();
	
	if($myDb->connected){
	
		$result = $myDb->doQuery("select * from artisti where Username='".$usr."'");//excecute query
		if($result && $result->num_rows==1){//if return only one row
			while ($row = $result->fetch_assoc()) {
				if (password_verify($pwd, $row["Password"])) {
					$_SESSION["isLogged"] = "true";
					echo 'Success';
				} else {
					echo 'Invalid password';
				} 
			}
		}else{
			echo 'Invalid Username';
		}
	}
	else 
		echo "Connection Error";
	$myDb->disconnect();
?>