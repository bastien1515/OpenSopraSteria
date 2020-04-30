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
    <script type="text/javascript"></script>
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
      Récapitulatif de votre commande
  </div>
</div>
  <!--Fin Image accueil-->


<!--Page-->
<div class ="formulaire">
        <form action = "panier.php" method="post">
  <h6><div class="bord2"><p>Votre billet : </p></div></h6>

<h5>
        <?php
        echo"Identifiant de votre billet :  ".$_SESSION['idmatchcommande'];
        echo "<br><br><br>";


        echo"Type de billet : ".$_SESSION['libelletbillet'];
        echo "<br><br><br>";

       // echo "votre idtbillet est  : ".$_SESSION['idtbillet'];
        //echo "<br>";
        echo "Votre emplacement : " .$_SESSION['libelleemplacement'];
        echo "<br><br><br>";
      //  echo "id du client connecté : ".$_SESSION['idclient'];

        /* Ces variables la on évitera de les afficher.
        Le soucis c'est que si l'utilisateur a rentré une fois un num licencié,
        il sera sauvegardé tant que la session est ouverte.

        echo" votre code promo est :".$_SESSION['libellepromo'];
        echo "<br>";
        echo"votre numéro de licencié est :".$_SESSION['numlicencie'];
        echo "<br>";
       // echo "libellé de votre billet :  ".$_SESSION['libellematchcommande'];
        */
        ?>
</h5>

        <output type = 'text' name = "billet">  </output> <br/>

         <p>
             <a href = panier.php>
            <input type="submit" value="paiement" name="co">
            </a>
        </p>
        </form>
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


</body>
</html>
