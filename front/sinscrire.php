<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Sopra Steria | Inscription </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css"/>
    </head>


    <body>
      <!--menu-->
          <ul class="menu">
            <img src="../images/logosopra.png" width="5%" height="10%">
            <li><a href="accueil.php" data-hover="Accueil">Accueil</a></li>
            <li><a href="actualites.php" data-hover="Actualités">Actualités</a></li>
            <li><a href="planningfront.php" data-hover="Résultats">Résultats</a></li>
            <li><a href="planningfront.php" data-hover="Planning">Planning Matchs</a></li>
            <li><a href="billetterie.php" data-hover="Billetterie">Billetterie</a></li>

            <?php
            if(isset($_SESSION['mail'])){
                echo '<form action="" method="post">';
                echo '<input button class="bouton" type="submit" name="deco" value="Se deconnecter">';
                echo '</form>';
                  if(isset($_POST['deco']))
                  {
                         $co->disconnect();
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
           Espace Inscription Open Sopra Steria
       </div>
     </div>
      <!--Fin Image accueil-->


      <!--Formulaire-->
      <div class = "formulaire">
          <form action = "sinscrire.php" method="post">
                  <h6> Nom :</h6>
                      <input type="text" name="nom"><br/>
                 <h6>Prénom :</h6>
                      <input type="text" name="prenom"><br/>
                  <h6>Téléphone :</h6>
                      <input type="text" name="telephone"><br/>
                  <h6>Adresse Mail :</h6>
                      <input type="text" name="mail"><br/>
                  <h6>Mot de passe :</h6>
                      <input type="password" name="pass1"><br/>
                  <h6>Confirmation du mot de passe :</h6>
                      <input type="password" name="pass2"><br/>
                   <p>
                      <input type="submit" value="Inscription" name="co">
                  </p>
              </form>

              <?php
              include_once("ClasseConnexion.php");
              $maConnexionBD = new Connection(); //nouvel objet connexion
              if(isset($_POST['co'])){
                   $nom = $_REQUEST['nom'];
                   $prenom = $_REQUEST['prenom'];
                   $telephone = $_REQUEST['telephone'];
                   $mail = $_REQUEST['mail'];
                   $pass1 = $_REQUEST['pass1'];
                   $pass2 = $_REQUEST['pass2'];
                  
                   if ($pass1!=$pass2 ){
                        echo '  <body onLoad="alert(\'Erreur. Les deux mots de passe saisis sont différents.\')">   ';
                   }
                   else{
                         $pass_crypte= password_hash($pass1, PASSWORD_BCRYPT); // cryptage du mdp

                         $maConnexionBD->inscription($nom,$prenom,$telephone,$mail,$pass_crypte);
                   }
               }
             ?>
          </div>
          <!--Fin du Formulaire-->

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
