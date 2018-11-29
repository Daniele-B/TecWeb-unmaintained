<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
      <meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
      <meta name="description" content="Online artwork database"/>
      <meta name="keywords" content="artwork,picture,image,database"/>
      <meta name="author" content="Daniele Bianchin, Pardeep Singh, Davide Liu, Harwinder Singh"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" href="Style/style.css"/>
      <link rel="stylesheet" href="viewStyle.css"/>
      <script type="text/javascript" src="script.js" ></script>
      <script type="text/javascript" src="imagezoom.js" ></script>
      <script type="text/javascript" src="ajaxComment.js" ></script>
      <title>Artbit</title>
    </head>
    <body onload="eventListnerforLoginModal()">

    <?php
      require_once "header.php";
      require_once "loginModal.php";
      require_once "searchModal.php";
      require_once "signUpModal.php";
      require_once "editProfileModal.php";
      require_once "DbConnector.php";
      require_once "functions.php";

      $Title = $_GET['Title'];
      $Artist = $_GET['Artist'];

      $myDb= new DbConnector();
      $myDb->openDBConnection();
      if($myDb->connected)
      {
       if(isset($Title) && isset($Artist))
       {
        $qrStr = 'SELECT Artista, Nome, Descrizione, Categoria, Data_upload FROM opere WHERE Artista ="'.$Artist.'"'.' AND Nome ="'.$Title.'"';
        $result = $myDb->doQuery($qrStr);
        if(isset($result) && ($result->num_rows === 1))
        {
          $row = $result->fetch_assoc();
          $Title = $row['Nome'];
          $Artist = $row['Artista'];
          $Description = $row['Descrizione'];
          $Category = $row['Categoria'];
          $Date = $row['Data_upload'];
          $qrStr = 'SELECT Opera FROM likes WHERE Opera="'.$Title.'"'.' AND Creatore="'.$Artist.'"';
          $Likes = $myDb->doQuery($qrStr)->num_rows;
          $qrStr = 'SELECT Opera FROM commenti WHERE Opera="'.$Title.'"'.' AND Creatore="'.$Artist.'"';
          $Comments = $myDb->doQuery($qrStr)->num_rows;
          $qrStr = 'SELECT Nome, Cognome FROM artisti WHERE Username="'.$Artist.'"';
          $result = $myDb->doQuery($qrStr);
          $row = $result->fetch_assoc();
          $ArtistName = $row['Nome'] . $row['Cognome'];
          
          if ( is_session_started() === FALSE || (!isset($_SESSION['Username']))){
            $isLiked = false;
          }else if(isset($_SESSION['Username'])){
            $isLiked = boolImageLiked($ArtistName,$_SESSION['Username'],$Title)['Result'];
          }
        }
        else
           echo "<script> window.location.replace('404.php') </script>";
       }
       else
         echo "<script> window.location.replace('404.php') </script>";
      }
      else
        echo '<script>alert(\'Database problem!\');</script>';
    ?>
    <h1 id="artworkTitle"><?php echo $Title; ?></h1>
    <div id="imageAndCommentSection" class="container1024">
    <!--Lense-->
      <div id="imageContainer">
        <div class="img-magnifier-glass" id="glass"></div>
        <img id="myimage" src=<?php echo "'Images/Art/".$Artist."/".$Title.".jpeg'";?>  onLoad="magnify('myimage', 3)" alt=<?php echo '"'.$Title.'"' ?> >
      </div>
    <!--Description-->
        <div id="description-comments">
          <div class="commentator">Description</div>
          <div id="main-description"><?php echo $Description; ?></div>
          <div><?php echo ' <div class="commentator">By: <a href="gallery.php?gallerySearch='.$Artist.'">'.$Artist.'</a></div>' ?></div>
          <div><div class="commentator">Artist: <?php echo $ArtistName; ?></div></div>
          <div><div class="commentator">Uploaded on: <?php echo $Date; ?></div></div>
          <div><div class="commentator">Category: <?php echo $Category; ?></div></div>
          <?php
            if($isLiked == true){
              echo '<div class="like-btn like-btn-added" onclick="btnLikeOnClick(this)" id="LikeBtn_'.$numFig.'"></div>';
            }else{
              echo '<div class="like-btn" onclick="btnLikeOnClick(this)" id="LikeBtn_'.$numFig.'"></div>';
            }
          ?>
          <div><div class="commentator">Likes: <?php echo $Likes; ?></div></div>
          <div><div class="commentator">Comments: <?php echo $Comments; ?></div></div>
        </div>
        </div>
        <div id="commentSection" class="container1024">
        <div class="comment">
        <div class="commentator">
        <?php
          if($myDb->connected && isset($_SESSION['Username']))
              echo $_SESSION['Username'];
            else
              echo "Login to comment."
         ?>
         </div>
         <?php
          $en = !isset($_SESSION['Username']) ? "disabled=\"disabled\"" : "";
         ?>
         <textarea name="input-comment" id="texxt" <?php echo  $en?>> </textarea>
      <?php
          echo '<input type="button" value="comment" id="comment-btn" onclick="doComment(\''.$Title.'\',\''.$Artist.'\')" '.$en.'></div>';
        ?>
        <?php
            if($myDb->connected)
            {
              $qrStr = 'SELECT Commento, Utente FROM commenti WHERE Opera ="'.$Title.'"';
              $result = $myDb->doQuery($qrStr);
              if(isset($result) && ($result->num_rows > 0))
              {
                while($row = $result->fetch_assoc())
                {
                  echo '<div class="comment">';
                  echo '  <div class="commentator"><a href="gallery.php?gallerySearch='.$row['Utente'].'">'.$row['Utente'].'</a></div>';
                  echo $row['Commento']."</div>";
                }
              }
            }
          ?>
      </div>
    <?php require_once "footer.html"?>
    </div>
    </body>