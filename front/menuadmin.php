<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Sopra Steria | Admin </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css">
    </head>

    <body>
    <script type="text/javascript">
    var param="";
    var i=1;
        function getSelected(sel) {
             var idMatch = sel.options[sel.selectedIndex].value;
             a=idMatch;
              window.location.href ="admin.php?var1="+a;
        }
    </script>


    <!--menu-->
      <!--<ul class="menu">
      <img src="../images/logosopra.png" width="5%" height="10%">
      <li><a href="joueur.php" data-hover="Joueur">Gestion Joueurs</a></li>
      <li><a href="planning1.php" data-hover="Match">Gestion Matchs</a></li>
      <li><a href="admin.php" data-hover="Billet">Gestion Billetterie</a></li>
      <li><a href="score.php" data-hover="Score">Gestion Scores</a></li>';-->
      <?php
      if(isset($_SESSION['mail'])){
        if($_SESSION['mail']=='admin'){
          echo '<ul class= "menu">
                  <img src="../images/logosopra.png" width="5%" height="10%">
                  <li><a href = "joueur.php" data-hover="Joueur">Gestion Joueurs</a></li>
                  <li><a href = "planning1.php" data-hover="Match">Gestion Matchs</a></li>
                  <li><a href="admin.php" data-hover="Billet">Gestion Billetterie</a></li>
                  <li><a href="score.php" data-hover="Score">Gestion Scores</a></li>';

           echo '<form action="" method="post">';
           echo '<input class="bouton" type="submit" name="deco" value="Se déconnecter">';
           echo '</form>';
           if(isset($_POST['deco']))
           {
              $maConnexionBD->disconnect();
              echo '<body onLoad="alert(\'Déconnexion...\')">';
              echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
           }
          echo '</ul>';
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
      
    <!--Fin du menuA-->

    <!--Image d'accueil-->
    <div class="accueil">
      <img class="photo1" src="../images/terrebattue.jpg">
      <div class="texte">
        Bienvenue sur l'Espace Administrateur
    </div>
    </div>
    <!--Fin Image accueil-->
  </body>
  </html>
