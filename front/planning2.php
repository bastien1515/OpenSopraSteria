<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection();?>
<!doctype HMTL>

<html >

    <head>
        <title>OPEN SOPRA STERIA | Admin</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/admin.css">
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
          Administration des matchs
      </div>
      </div>
      <!--Fin Image accueil-->



      <!-- récupere les valeures de planning 1-->
       <?php
       $libelleMatch=$_POST['libelleMatch'];
       $dateMatch= $_POST['dateMatch'];
       $coefMatch=$_POST['coefMatch'];
       $courtMatch=$_POST['courtMatch'];
       $creneauMatch=$_POST['creneauMatch'];
       $tournoi=$_POST['tournoi'];
       $typeMatch =$_POST['typeMatch'];
       ?>


           <div class = "formulaireA">
               <div class = "ajoutM">
               <h3><div class="bord2"><p>Ajouter un match </p></div></h3>
               </div>

              <center>
                <form method="post">
                   <fieldset>
                   <h4>Sélctionner l'équipe d'arbitres en charge du match</h4>

                   <select onChange="getSelected(this);" name="arbitre">
                      <?php

                      $tabA=$maConnexionBD->getArbitre();

                      // var_dump($tabA);
                      echo "<option value='' > " ;

                      foreach ($tabA as $key => $value ) {
                          echo " <option value=".$value['equipeArbitre']." > ";
                          echo $value['libelleEquipeA'];
                          echo "</option>";
                      }

                      if(isset($_GET["var1"])){
                          $equipeA=$_GET["var1"];

                          foreach ($tabA as $key => $value ) {
                              if($value['equipeArbitre']==$equipeA) {
                                  echo  $value['libelleEquipeA'] . " selectionnée."  ;
                              }
                          }
                      }

                      echo" </select>";

                      ?>
                   </select>

                   <h4>Sélectionner la première équipe de ramasseurs</h4>
                   <select onChange="getSelected(this);" name="ramasseurs1">


                      <?php

                      $tabR1=$maConnexionBD->getRamasseur();

                      // var_dump($tabR1);
                      echo "<option value='' > " ;

                      foreach ($tabR1 as $key => $value ) {
                          echo " <option value=".$value['equipeRamasseurs']." > ";
                          echo $value['libelleEquipeR'];
                          echo "</option>";
                      }

                      if(isset($_GET["var1"])){
                          $equipeR1=$_GET["var1"];

                          foreach ($tabR1 as $key => $value ) {
                              if($value['equipeRamasseurs']==$equipeR1) {
                                  echo  $value['libelleEquipeR'] . " selectionnée comme équipe 1."  ;
                              }
                          }
                      }

                      echo" </select>";
                      ?>


                      <h4>Sélectionner la deuxième équipe de ramasseurs</h4>
                      <select onChange="getSelected(this);" name="ramasseurs2">
                      <?php

                      $tabR2=$maConnexionBD->getRamasseur();

                      // var_dump($tabR1);
                      echo "<option value='' > " ;

                      foreach ($tabR2 as $key => $value ) {
                          echo " <option value=".$value['equipeRamasseurs']." > ";
                          echo $value['libelleEquipeR'];
                          echo "</option>";
                      }

                      if(isset($_GET["var1"])){
                          $equipeR2=$_GET["var1"];

                          foreach ($tabR2 as $key => $value ) {
                              if($value['equipeRamasseurs']==$equipeR2) {
                                  echo  $value['libelleEquipeR'] . " selectionnée comme équipe 2."  ;
                              }
                          }
                      }

                      echo" </select>";
                      ?>

                      <h4>Sélectionner les joueurs</h4>
                      <h4>
                      <?php
                            //Déclaration des variables pour joueurs facultatifs
                            $joueurA2=null;
                            $joueurB2=null;


                            if($tournoi=='Tournoi simple'){
                                //Joueur 1
                                echo 'Joueur 1 : ';
                                echo '<select onChange="getSelected(this);" name="joueurA1">';
                                $tabJA1=$maConnexionBD->getJoueur();
                                echo "<option value='' > " ;
                                foreach ($tabJA1 as $key => $value ) {
                                   echo " <option value=".$value['idjoueur']." > ";
                                   echo $value['nomjoueur'];
                                   echo "</option>";
                                }
                                if(isset($_GET["var1"])){
                                   $joueurA1=$_GET["var1"];
                                   foreach ($tabJA1 as $key => $value ) {
                                       if($value['idjoueur']==$joueurA1) {
                                           echo  $value['nomjoueur'] . " selectionné comme joueur 1."  ;
                                       }
                                   }
                                }
                                echo " </select>";
                                echo "<br/>";

                                //Joueur 2
                                echo 'Joueur 2 : ';
                                echo '<select onChange="getSelected(this);" name="joueurB1">';
                                $tabJB1=$maConnexionBD->getJoueur();
                                echo "<option value='' > " ;
                                foreach ($tabJB1 as $key => $value ) {
                                   echo " <option value=".$value['idjoueur']." > ";
                                   echo $value['nomjoueur'];
                                   echo "</option>";
                                }
                                if(isset($_GET["var1"])){
                                   $joueurB1=$_GET["var1"];
                                   foreach ($tabJB1 as $key => $value ) {
                                       if($value['idjoueur']==$joueurB1) {
                                           echo  $value['nomjoueur'] . " selectionné comme joueur 2."  ;
                                       }
                                   }
                                }
                                echo " </select>";
                                echo "<br/>";


                            }
                            else{
                              //Première équipe
                                echo 'Joueurs équipe 1 : ';
                                echo '<select onChange="getSelected(this);" name="joueurA1">';
                                $tabJA1=$maConnexionBD->getJoueur();
                                echo "<option value='' > " ;
                                foreach ($tabJA1 as $key => $value ) {
                                   echo " <option value=".$value['idjoueur']." > ";
                                   echo $value['nomjoueur'];
                                   echo "</option>";
                                }
                                echo " </select>";
                                echo " ";
                                echo '<select onChange="getSelected(this);" name="joueurA2">';
                                $tabJA2=$maConnexionBD->getJoueur();
                                echo "<option value='' > " ;
                                foreach ($tabJA2 as $key => $value ) {
                                   echo " <option value=".$value['idjoueur']." > ";
                                   echo $value['nomjoueur'];
                                   echo "</option>";
                                }
                                echo " </select>";
                                echo "<br/>";

                              //Deuxième équipe
                                echo 'Joueurs équipe 2 : ';
                                echo '<select onChange="getSelected(this);" name="joueurB1">';
                                $tabJB1=$maConnexionBD->getJoueur();
                                echo "<option value='' > " ;
                                foreach ($tabJB1 as $key => $value ) {
                                   echo " <option value=".$value['idjoueur']." > ";
                                   echo $value['nomjoueur'];
                                   echo "</option>";
                                }
                                echo " </select>";
                                echo " ";
                                echo '<select onChange="getSelected(this);" name="joueurB2">';
                                $tabJB2=$maConnexionBD->getJoueur();
                                echo "<option value='' > " ;
                                foreach ($tabJB2 as $key => $value ) {
                                   echo " <option value=".$value['idjoueur']." > ";
                                   echo $value['nomjoueur'];
                                   echo "</option>";
                                }
                                echo " </select>";
                                echo "<br/>";

                            }

                       ?>
                     </h4>
                        <!-- Quand on sépare en 2 fichier on a 2 forulaires,
                        on est donc obligé de repasser les valeures dans le deuxieme form
                        via des valeures cachées comme ici:
                       -->
                      <input type="hidden" value="<?php echo $libelleMatch?>" name="libelleMatch">
                      <input type="hidden" value="<?php echo $dateMatch?>" name="dateMatch">
                      <input type="hidden" value="<?php echo $coefMatch?>" name="coefMatch">
                      <input type="hidden" value="<?php echo $courtMatch?>" name="courtMatch">
                      <input type="hidden" value="<?php echo $creneauMatch?>" name="creneauMatch">
                      <input type="hidden" value="<?php echo $tournoi?>" name="tournoi">
                      <input type="hidden" value="<?php echo $typeMatch?>" name="typeMatch">

                  <p>
                      <input type="submit" value="valider" name="validerM3">
                  </p>

                  <?php


                      if(isset($_POST['validerM3']))
                      {
                          // on re récupère le tout.
                          $libelleMatch= $_POST['libelleMatch'];
                          $dateMatch= $_POST['dateMatch'];
                          $coefMatch=$_POST['coefMatch'];
                          $courtMatch=$_POST['courtMatch'];
                          $creneauMatch=$_POST['creneauMatch'];
                          $tournoi=$_POST['tournoi'];
                          $typeMatch =$_POST['typeMatch'];

                          $equipeA=$_POST['arbitre'];
                          $equipeR1=$_POST['ramasseurs1'];
                          $equipeR2=$_POST['ramasseurs2'];
                          $joueurA1=$_POST['joueurA1'];
                          $joueurB1=$_POST['joueurB1'];

                          if($tournoi=='Tournoi simple'){
                            $joueurA2=null;
                            $joueurB2=null;
                          }
                          else {
                            $joueurA2=$_POST['joueurA2'];
                            $joueurB2=$_POST['joueurB2'];
                          }

                           $maConnexionBD->ajoutMatch($libelleMatch,$dateMatch,$coefMatch,$courtMatch,$creneauMatch,$typeMatch,$tournoi,$equipeA,$equipeR1,$equipeR2,$joueurA1,$joueurA2,$joueurB1,$joueurB2);


                      }
                  ?>
                </fieldset>
              </form>

           </center>
       </div>

</body>
</html>
