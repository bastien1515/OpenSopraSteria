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
          Administration des scores
      </div>
      </div>
      <!--Fin Image accueil-->


      <!-- Récupération du match dans le formulaire, des joueurs dans la bd -->
      <?php
         $idmatch=$_SESSION['idmatch'];
         if($idmatch!=null){
           $tournoi=$maConnexionBD->getTournoi($idmatch);
           if($tournoi=='Tournoi simple'){
             $joueurA1=$maConnexionBD->getJoueurA1($idmatch);
             $joueurB1=$maConnexionBD->getJoueurB1($idmatch);
             $joueurA2=null;
             $joueurB2=null;
           }
           else {
             $joueurA1=$maConnexionBD->getJoueurA1($idmatch);
             $joueurB1=$maConnexionBD->getJoueurB1($idmatch);
             $joueurA2=$maConnexionBD->getJoueurA2($idmatch);
             $joueurB2=$maConnexionBD->getJoueurB2($idmatch);
           }
         }
         else{
           echo "Erreur lors de la récupération du match.";
         }
       ?>


       <div class = "formulaireA">
            <h3><div class="bord2"><p>Ajout de scores </p></div></h3>

                 <center>
                   <form method="post">
                      <fieldset>
                        <table border="2" cellspacing="5" cellpadding="5" align="center">
                          <tr><!--Première ligne du tableau-->
                            <!--Première cellule-->
                            <td id="entete" align="center">
                              Equipe A<br/>
                              <h4>
                              <?php
                                 if($tournoi=='Tournoi simple'){
                                   $j = $joueurA1;
                                   $repA1 = $maConnexionBD->getNomJoueur($j);
                                   echo $repA1;
                                 }
                                 else {
                                   $j = $joueurA1;
                                   $repA1 = $maConnexionBD->getNomJoueur($j);
                                   $j = $joueurA2;
                                   $repA2 = $maConnexionBD->getNomJoueur($j);
                                   echo $repA1." et ".$repA2;
                                 }
                               ?>
                             </h4>
                            </td>
                            <!--Deuxième cellule-->
                            <td id="entete" align="center">
                              Equipe B<br/>
                              <h4>
                              <?php
                                 if($tournoi=='Tournoi simple'){
                                   $j = $joueurB1;
                                   $repB1 = $maConnexionBD->getNomJoueur($j);
                                   echo $repB1;
                                 }
                                 else {
                                   $j = $joueurB1;
                                   $repB1 = $maConnexionBD->getNomJoueur($j);
                                   $j = $joueurB2;
                                   $repB2 = $maConnexionBD->getNomJoueur($j);
                                   echo $repB1." et ".$repB2;
                                 }
                               ?>
                             </h4>
                            </td>
                          </tr><!--Fin de la première ligne du tableau-->
                          <?php
                             //Variable qui permet d'éviter le recopie de lignes de code
                             $options = '<option value=0>0</option>
                                         <option value=1>1</option>
                                         <option value=2>2</option>
                                         <option value=3>3</option>
                                         <option value=4>4</option>
                                         <option value=5>5</option>
                                         <option value=6>6</option>
                                         <option value=7>7</option>';
                           ?>
                          <tr><!--Ligne set n°1-->
                            <td id="contenu" align="center"><!--Equipe A-->
                                 Jeux remportés lors du set n°1<br/>
                                 <?php
                                     echo '<select name="Aset1">'.
                                           $options.'</select>';
                                  ?>
                            </td>
                            <td id="contenu" align="center"><!--Equipe B-->
                                 Jeux remportés lors du set n°1<br/>
                                 <?php
                                     echo '<select name="Bset1">'.
                                           $options.'</select>';
                                  ?>
                            </td>
                          </tr>

                          <tr><!--Ligne set n°2-->
                           <td id="contenu" align="center"><!--Equipe A-->
                                Jeux remportés lors du set n°2<br/>
                                <?php
                                    echo '<select name="Aset2">'.
                                          $options.'</select>';
                                 ?>
                           </td>
                           <td id="contenu" align="center"><!--Equipe B-->
                                Jeux remportés lors du set n°2<br/>
                                <?php
                                    echo '<select name="Bset2">'.
                                          $options.'</select>';
                                 ?>
                           </td>
                          </tr>

                          <tr><!--Ligne set n°3-->
                           <td id="contenu" align="center"><!--Equipe A-->
                                Jeux remportés lors du set n°3<br/>
                                <?php
                                    echo '<select name="Aset3">'.
                                          $options.'</select>';
                                 ?>
                           </td>
                           <td id="contenu" align="center"><!--Equipe B-->
                                Jeux remportés lors du set n°3<br/>
                                <?php
                                    echo '<select name="Bset3">'.
                                          $options.'</select>';
                                 ?>
                           </td>
                          </tr>

                        </table>
                        <br/>
                        <input type="submit" value="Confirmer ce score" name="validerS" />
                        <br />
                        <?php //Récupération des scores par set des équipes, puis fonction
                          if(isset($_POST['validerS'])){
                            $Aset1 = $_REQUEST['Aset1'];
                            $Bset1 = $_REQUEST['Bset1'];
                            $Aset2 = $_REQUEST['Aset2'];
                            $Bset2 = $_REQUEST['Bset2'];
                            $Aset3 = $_REQUEST['Aset3'];
                            $Bset3 = $_REQUEST['Bset3'];

                            $maConnexionBD->ajoutScore($idmatch,$joueurA1,$joueurB1,$joueurA2,$joueurB2,
                                            $Aset1,$Bset1,$Aset2,$Bset2,$Aset3,$Bset3);
                          }
                        ?>
                      </form>
                    </center>
                  </div>

      </body>
     </html>
