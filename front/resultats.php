<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection();?>
<!doctype HMTL>

<html >

    <head>
        <title>OPEN SOPRA STERIA | Résultats</title>
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
    Résultats des matchs joués
</div>
</div>
<!--Fin Image accueil-->


<!--Page-->
<div class=formulaire>

<h5>
<?php
   $tabM= $maConnexionBD->getmatchsjoues();
   if (empty($tabM)==FALSE){
     foreach ($tabM as $keyM => $valueM) {
         echo '<center><fieldset>';
         echo 'Date : '.$valueM['dateMatch'].', ';
         echo  $valueM['creneauMatch'].'. Match : ';
         echo  $valueM['libelleMatch'].'<br/><br/>';

         $idmatch = $valueM['idmatch'];
         $scoreA = $maConnexionBD->getscoreA($idmatch);
         $scoreB = $maConnexionBD->getscoreB($idmatch);

         if($valueM['tournoi']=='Tournoi double'){

          $tabA = $maConnexionBD->getEquipeA($idmatch);
          $tabB = $maConnexionBD->getEquipeB($idmatch);
          echo '<table border="2px" cellspacing="5" cellpadding="()" align="center">';
          //Première ligne : Equipe A
          echo '<tr><td id="contenu" align="center">';
          echo  $tabA[0][1].' et '.$tabA[0][2].'</td>';
          foreach($scoreA as $keyA => $valueA){
            echo '<td id="contenu" align="center">'.$valueA['nbjeux'].'</td>';
          }
          echo '</tr>';

          //Deuxième ligne : Equipe B
          echo '<tr><td id="contenu" align="center">';
          echo  $tabB[0][1].' et '.$tabB[0][2].'</td>';
          foreach($scoreB as $keyB => $valueB){
            echo '<td id="contenu" align="center">'.$valueB['nbjeux'].'</td>';
          }
          echo '</tr>';

          echo '</table>';
          echo '</fieldset></center><br/><br/>';
        }
        else{//tournoi simple

          $tabJ = $maConnexionBD->getJoueursSimple($idmatch);

          echo '<table border="1" cellspacing="2" cellpadding="2" align="center">';
          //Première ligne : Equipe A
          echo '<tr><td id="contenu" align="center">';
          echo  $tabJ[0][1];
          foreach($scoreA as $keyA => $valueA){
            echo '<td id="contenu" align="center">'.$valueA['nbjeux'].'</td>';
          }
          echo '</tr>';

          //Deuxième ligne : Equipe B
          echo '<tr><td id="contenu" align="center">';
          echo  $tabJ[0][2];
          foreach($scoreB as $keyB => $valueB){
            echo '<td id="contenu" align="center">'.$valueB['nbjeux'].'</td>';
          }
          echo '</tr>';

          echo '</table>';
          echo '</fieldset></center><br/><br/>';

        }
      }
    }
?>
</h5>
</div>

<!--Fin page-->


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
