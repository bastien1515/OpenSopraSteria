<?php
session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
?>
<!DOCTYPE html>
<html>
  <head>
      <title>Open Sopra Steria | Billetterie </title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/design.css"/>
  </head>

  <body>

    <!--menu-->
    <ul class="menu">
      <img src="../images/logosopra.png" width="5%" height="10%">
      <li><a href="accueil.php" data-hover="Accueil">Accueil</a></li>
      <li><a href="actualites.php" data-hover="Actualités">Actualités</a></li>
      <li><a href="resultats.php" data-hover="Résultats">Résultats</a></li>
      <li><a href="planningfront.php" data-hover="Planning">Planning Matchs</a></li>
      <li><a href="billetterie.php" data-hover="Billetterie">Billetterie</a></li>

      <?php
      if(isset($_SESSION['mail'])){
          echo '<form action="" method="post">';
          echo '<input class="bouton" type="submit" name="deco" value="Se deconnecter">';
          echo '</form>';
            if(isset($_POST['deco']))
            {
                   $maConnexionBD->disconnect();
            }
      }
      else{
          echo '<a href = "seconnecter.php"><button class="bouton" type="button"> Se Connecter </button></a>';
          echo '<a href = "sinscrire.php"><button class="bouton" type="button"> S&apos;Inscrire </button></a>';
      }
      ?>

    </ul>
    <!--Fin du menu-->

    <!--Image d'accueil-->
    <div class="accueil">
      <img class="photo1" src="../images/terrebattue.jpg">
      <div class="texte">
        Suivez nos toutes dernières actualités !
      </div>
    </div>
    <!--Fin Image accueil-->

    <!--actualités du moment-->
    <div id="actusdumoment">
    <figure class="actu">
      <img src="../images/actu1.jpg" alt="actu1" />
      <div class="date">28 avril 2020</div>
      <figcaption>
        <h2>Bientôt la 5ème édition à Lyon, que de souvenirs !</h2>
        <p>Un chiffre symbolique. Et qui laisse supposer une histoire déjà riche ! Et oui : qui dit cinquième édition de l’Open Sopra Steria de Lyon en 2020, dit aussi quatre éditions précédentes pleines de belles choses et de grandes émotions.</p>
        <a href="actualites.php" class="Lire">En savoir plus</a>
      </figcaption>
    </figure>

    <figure class="actu"><img src="../images/actu2.png" alt="actu2" />
      <div class="date">30 avril 2020</div>
      <figcaption>
        <h2>Le planning des matchs est maintenant disponible !</h2>
        <p>Qui dit « nouvelle édition », dit forcément… « nouvelle affiche » et… « nouveau planning » ! <br> Découvrez dès à présent la planification de vos matchs et réservez vos places !  </p>
        <a href="actualites.php" class="Lire">En savoir plus</a>
      </figcaption>
    </figure>

    <figure class="actu"><img src="../images/actu3.jpg" alt="actu3" />
      <div class="date">13 avril 2020</div>
      <figcaption>
        <h2>Revivez la finale de l'an passé !</h2>
        <p>Corentin Moutet remporte l’Open Sopra Steria 2019 ! Lui qui avait été éliminé au premier tour les deux années passées a dominé Elias Ymer en finale : 6-4 6-4, en 1h50 ! <br> Revivez ce match de folie !</p>
        <a href="actualites.php" class="Lire">En savoir plus</a>
      </figcaption>
    </figure>

    </div>
    <!--fin des actualités du moment-->

    <br/><br/><br/><br/><br/>

  <!--bas de page-->
      <footer>
        <div class = "bas">
            <ul id = "bottom1">
              <li>Nos réseaux sociaux</li> <br><br><br>
            </ul>
    
            <ul id = "bottom2">
            <li> <a href = "https://www.instagram.com/opensoprasteriadelyon/?hl=fr"> <img id = "logo" src = "../images/logoinstagram.png"> </a></li>
            <li> <a href = "https://www.facebook.com/opensoprasteria/"> <img id = "logo" src ="../images/logofacebook.png"> </a></li>
            <li> <a href = "https://twitter.com/opensoprasteria?lang=fr"> <img id = "logo" src = "../images/logotwitter.png"></a></li>
            </ul>
        </div>
  <!--fin bas de page-->
    </footer>
  </body>
</html>
