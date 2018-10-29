<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
  <meta name="description" content="Online artwork database"/>
  <meta name="keywords" content="artwork,picture,image,database"/>
  <meta name="author" content="Daniele Bianchin, Pardeep Singh, Davide Liu, Harwinder Singh"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="Style/style.css"/>
  <link rel="stylesheet" href="Style/upload_style.css"/>
  <script type="text/javascript" src="script.js" ></script>
  <title>Artbit</title>
</head>

<body>
  <?php
  require_once "header.php";
  require_once "loginModal.php";
  require_once "searchModal.php";
  require_once "signUpModal.php";
  require_once "editProfileModal.php";
  require_once "DbConnector.php";
  ?>
  <div class="section"><!--upload form-->
    <div class="title"><h1>Register your artwork</h1></div>
    <form action="" method="post" enctype="multipart/form-data" id="upload">

        <label>Title:</label>
        <input type="text" placeholder="Title" name="title" maxlength="20" required="">

        <label>Category:</label>
        <select name="category">
          <option value="landscape">Landscape</option>
          <option value="fantasy">Fantasy</option>
          <option value="abstract">Abstract</option>
          <option value="cartoon">Cartoon</option>
          <option value="portrait">Portrait</option>
          <option value="nature">Nature</option>
          <option value="others">Others</option>
        </select>

        <label>Description:</label>
        <textarea type="text" name="description" maxlength="300" placeholder="Description"></textarea>

        <label>Artwork:</label>
        <input type="file" name="artwork" accept=".png, .jpg, .jpeg" required=""/>

        <button type="submit">Upload</button>
      </form>
  </div>
  <?php
  if(isset($_POST["title"]) && isset($_FILES['artwork'])){ //l'upload può partire solo se il TITOLO e l'IMMAGINE sono stati selezionati
    if(!isset($_SESSION["isLogged"])){
      echo '<script type="text/javascript">openLoginModal();</script>';
      exit();
    }
  	$title= htmlspecialchars($_POST["title"], ENT_QUOTES, "UTF-8");
  	$category= htmlspecialchars($_POST["category"], ENT_QUOTES, "UTF-8");
  	$description= htmlspecialchars($_POST["description"], ENT_QUOTES, "UTF-8");
  	$filename = $_FILES['artwork']['name'];
  	$filetmp = $_FILES['artwork']['tmp_name'];
    $filesize = $_FILES['artwork']['size'];
    $username = $_SESSION["Username"];
  	$time = date('Y-m-d h:i:s');
  	//connecting to db
  	$myDb= new DbConnector();
  	$myDb->openDBConnection();
  	if($filesize>5242880 || $filesize==0)
  	  echo '<p class="error_message">File size is too big (max 5Mb)</p>';
  	else if($myDb->connected){
			//check if title already exists
			$result = $myDb->doQuery("select Nome from Opere where Nome='".$title."' and Artista='".$username."'");
			if($result->fetch_assoc())
				echo '<p class="error_message">You have already uploaded an artwork with this name</p>';
			else{
				//store compressed image
				$destination_img = "Images/Art/".$username."/".$title.".jpeg";
				compress($filetmp, $destination_img, 80);
				//update database
				$result = $myDb->doQuery("insert into Opere values ('$title','$description','$time','$username','$category')");
				echo '<p class="success_message">Update successfully</p>';
			}
			$myDb->disconnect();
  	}
  	else
  		echo '<p class="error_message">Connection error</p>';
  }
  function compress($source, $destination, $quality) {

      $info = getimagesize($source);

      if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source);

      elseif ($info['mime'] == 'image/jpg')
          $image = imagecreatefromgif($source);

      elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source);

      imagejpeg($image, $destination, $quality);
  }
  ?>
</body>
</html>