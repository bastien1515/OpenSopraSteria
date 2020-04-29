<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection();?>
<!doctype HMTL>

<html >

    <head>
        <title>OPEN SOPRA STERIA | Planning Matchs</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css">
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
      echo '<input class="bouton" type="submit" name="deco" value="Se Déconnecter">';
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
    Planning des matchs à venir
</div>
</div>
<!--Fin Image accueil-->


<!--Page-->

<div class ="formulaire">

  <?php
   echo '<table border="2px" cellspacing="5" cellpadding="5" align="center">
   <tr>
   <td id="entete" align="center">Date</td>
   <td id="entete" align="center">Affiche</td>
   <td id="entete" align="center">Créneau</td>
   </tr>';
   $tab= $maConnexionBD->getmatchsavenir();
   if(empty($tab)==FALSE){
     foreach ($tab as $key => $value) {
         echo '<fieldset>';
         echo '<tr><td id="contenu" align="center">'.$value['dateMatch'].'</td>';
         echo '<td id="contenu" align="center">'.$value['libelleMatch'].'</td>';
         echo '<td id="contenu" align="center">'.$value['creneauMatch'].'</td>';
         echo '</tr></fieldset>';
      }
   }
   echo '</table>';
  ?>

</div>
<!-- Fin Page-->


<!--bas de page-->
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

</body>
</html>
