<?php session_start();
include_once("ClasseConnexion.php");
$co = new Connection();?>
<!doctype HMTL>
<html >

    <head>
        <title>OPEN SOPRA STERIA </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css">
    </head>
 <body>

     <div class = "block1"> <!-- page d'accueil du site ! -->
     <h1>OPEN TOURNOI SOPRA STERIA</h1>

     <?php
     if(isset($_SESSION['mail'])){
       if($_SESSION['mail']=='admin'){
         echo '<div class = "block3">
             <nav>
             <ul id = "menu"><!-- menu de navigation du site -->
                <li><img src="logosopra.png" width="70%" height="70%"> </li>
                 <li><a href = "joueur.php"> Adminstration des joueurs </a> </li>
                 <li> <a href = "planning1.php"> Administration des matchs </a></li>
                 <li> <a href="admin.php">  Administration de la billeterie </a></li>
                 <li> <a href="score.php"> Administration des scores </a></li>';

          echo '<form action="" method="post">';
          echo '<input class="favorite styled" type="submit" name="deco" value="Se deconnecter">';
          echo '</form>';
        	if(isset($_POST['deco']))
        	{
             $co->disconnect();
             echo '<body onLoad="alert(\'Déconnexion...\')">';
             echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
        	}
         echo '</ul></nav></div>';
       }
       else{
        echo '<body onLoad="alert(\' Acces refusé \')">';
        echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
       }
     }
     else{
       echo '<body onLoad="alert(\' Acces refusé \')">';
       echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
     }
     ?>
  </body>
</html>
