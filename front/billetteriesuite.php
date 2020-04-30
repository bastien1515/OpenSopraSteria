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
    <script type="text/javascript" src="script.js"></script>
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
        echo '<input button class="bouton" type="submit" name="deco" value="Se deconnecter">';
        echo '</form>';
          if(isset($_POST['deco']))
          {
                 $maConnexionBD->disconnect();
          }
    }
    else{
        echo '<a href = "seconnecter.php"><button class="bouton" type="button"> Se Connecter </button></a>';
        echo '<a href = "sinscrire.php"><button class="bouton" type="button"> S&apos;Inscrire </button></a>';
        echo '<body onLoad="alert(\'Vous devez vous connecter pour poursuivre votre commande (ou vous inscrire en cliquant sur le bouton)\')">';
        echo '<meta http-equiv="refresh" content="0;URL=seconnecter.php">';
    }
    ?>

  </ul>
  <!--Fin du menu-->

  <!--Image d'accueil-->
  <div class="accueil">
    <img class="photo1" src="../images/terrebattue.jpg">
    <div class="texte">
      Bienvenue sur l'Espace Billetterie !
  </div>
</div>
  <!--Fin Image accueil-->

<!--Choix-->
  <div class="formulaire">
              <form method="post">
                    <h6><div class="bord2"><p>Votre billet :</p></div></h6>
                          <?php  if (isset($_POST['select'])){
                                $_SESSION['idmatchcommande']=$_POST['select'];
                            }

                         //   echo "Votre billet :  ".$_SESSION['idmatchcommande'];

                            $idmatch= $_SESSION['idmatchcommande'];
                            ?>

<h5>
                       <?php
                       $_SESSION['libellematch']= $maConnexionBD -> getlibellematch($_SESSION ['idmatchcommande']);
                       echo "Match sélectionné : ".$_SESSION ['libellematch'];
                       ?>
</h5>

                   <h6>Type de billet : </h6>
                    <select onChange="getSelected(this);" name="libelletbillet">
                      <?php
                      $tabE=$maConnexionBD->gettbillet2($idmatch);
                      echo "<option value='' > " ;
                      foreach ($tabE as $key => $value ) {
                      echo "<option value=".$value['libelletbillet']."> ";
                      echo $value['libelletbillet'];
                      $_SESSION['libelletbillet']=$value['libelletbillet'];
                      }
                      ?>
                      </select>

             <!--       <div id="promo" style="display:none;" class="promo">
             cette ligne permettra de cacher le champ, à afficher en Javascript ensuite quand un billet promo sera selectionné
             -->
                   <div id="promo" style="display:none;">
                   <h6>Code promo  :  </h6>
                        <input type = "text" name = "libelleP"> <br/>
                     </div>

                     <div id="licencie"  style="display: none;">
                    <h6>Numéro de licence :  </h6>
                        <input type = 'textarea' name = "numlicence" >
                     </div>
                   </br>


                     <h6> Votre emplacement :  </h6>
                     <select onChange="getSelected(this);" name="libelleemplacement">
                       <?php
                         $tabE=$maConnexionBD->getEmplacements();
                         echo "<option value='' > " ;
                         foreach ($tabE as $key => $value ) {
                             echo "<option value=".$value['libelleemplacement']."> ";
                             echo $value['libelleemplacement'];
                         }
                       ?>
                     </select>

                     </br>
                     </br>
                     </br>
                       <input type="submit" name = "valider" value = "Enregister le choix">
                         </form>


                        <?php
                        // ici , fin de formulaire, on récupère tt ce qu'on veut récupérer

                       if(isset($_POST['valider'])){

                         $libelle=$_POST["libelletbillet"];

                         if ($libelle=="licencie"){
                           $numlicence = $_POST['numlicence'];
                           $maConnexionBD->verifnumlicencie($numlicence);
                           $_SESSION['numlicencie']=$numlicence;
                         }

                         if($libelle=="promo"){
                          $libellepromo= $_POST['libelleP'];
                          $maConnexionBD->verifpromo2($libellepromo);
                          $_SESSION['libellepromo']=$libellepromo;
                          $_SESSION['idpromo']= $maConnexionBD->getidpromo($_SESSION['libellepromo']);
                         }

                           $_SESSION['libelletbillet']= $libelle;
                           $_SESSION['idtbillet'] = $maConnexionBD-> getidtbillet($libelle);
                           $_SESSION['libelleemplacement'] = $_POST['libelleemplacement'];
                           $_SESSION['idemplacement']=$maConnexionBD ->getidemplacement($_SESSION['libelleemplacement']);
                       }
                       ?>
                     </br>

                       <a href = billetteriechoixemplacement.php >
                         <input type='submit' value="Page suivante" name="co">
                        </a>
              </div>
<!-- Fin du choix-->
<footer>
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
</footer>
</body>
</html>
