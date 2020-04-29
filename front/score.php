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

      <script type="text/javascript">
      var param="";
      var i=1;
          function getSelected(sel) {
               var idMatch = sel.options[sel.selectedIndex].value;
               a=idMatch;
                window.location.href ="score.php?var1="+a;
          }
      </script>


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


      <div class = "formulaireA">
              <h3><div class="bord2"><p>Ajout de Scores </p></div></h3>

         <center>
           <form action="score2.php" method="post">
              <fieldset>
                <h4>Sélectionner le match :</h4>
                <select onChange="getSelected(this);" name="idmatch">
                <?php
                   $tab=$maConnexionBD->getMatchs();

                    echo "<option value='' > " ; // première ligne vide pour afficher rien au chargement de la page

                    foreach ($tab as $key => $value ) {

                        echo " <option value=".$value['idmatch']." > ";
                        echo $value['libellematch'];
                        echo "</option>";
                    }

                ?>
                </select>
                <br/><br/>
                <!-- Confirmation du match -->
                <h4>
                <?php
                  if(isset($_GET["var1"])){
                      $idmatch=$_GET["var1"];
                      foreach ($tab as $key => $value ) {
                          $estjoue = $maConnexionBD->getEstJoue($idmatch);
                          if($value['idmatch']==$idmatch && $estjoue !=1) {
                              $_SESSION['idmatch'] = $idmatch;
                              echo  'Souhaitez-vous enregistrer le score
                                     relatif au match suivant : '.$value['libellematch'].' ?<br/><br/>' ;
                              echo '<input type="submit" value="confirmer" name="validerM">';
                          }
                          else{
                            if($value['idmatch']==$idmatch && $estjoue !=0){
                              echo 'Ce match a déja été joué. Impossible de remplir les scores à nouveau.';
                            }
                          }
                      }
                  }
                ?>
              </h4>

              </fieldset>
              </form>
            </center>
          </div>

        </body>
        </html>
