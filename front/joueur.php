<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection();?>
<!doctype HMTL>

<html >

    <head>
        <title>OPEN SOPRA STERIA | Admin</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css">
    </head>

    <body>

      <!--menu-->
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
          Administration des joueurs
      </div>
      </div>
      <!--Fin Image accueil-->


  <div class = "formulaireA">
        <div class = "ajoutJ">
        <h3><div class="bord2"><p>Ajouter un joueur </p></div></h3>
        </div>

          <center>
            <!-- Formulaire de saisie-->
            <form method="post">
              <fieldset>

              <h4>Indiquer le nom du joueur :</h4>
              <input type="text" name="nomjoueur" />
              <br/>

              <h4>Indiquer le prénom du joueur :</h4>
              <input type="text" name="prenomjoueur" />
              <br />

              <h4>Indiquer la date de naissance du joueur :</h4>
              <input type="date" id="start" name="datenaissance"
              min="1900-01-01" max="2009-12-31">
              <br />

              <h4>Indiquer la nationalité du joueur :</h4>
              <input type="text" name="nationalite" />
              <br />

              <h4>Indiquer le classement ATP du joueur :</h4>
              <input type="text" name="classementATP" />
              <br />

              <br />
              <input type="submit" value="valider" name="validerJ" />
              <br />

            </fieldset>
            </form>
          </center>

          <!-- Récupération des variables et envoie à la fonction-->
          <?php

            if(isset($_POST['validerJ'])){
              $nom = $_REQUEST['nomjoueur'];
              $prenom = $_REQUEST['prenomjoueur'];
              $daten = $_REQUEST['datenaissance'];
              $pays = $_REQUEST['nationalite'];
              $atp = $_REQUEST['classementATP'];

              //Test
              //echo $nom." ".$prenom." "."<br />".$daten." ".$pays." ".$atp;

              //Fonction
              $maConnexionBD->ajoutJoueur($nom,$prenom,$daten,$pays,$atp);
            }
          ?>
        </div>
  </body>
  </html>
