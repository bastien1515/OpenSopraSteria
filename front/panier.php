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
      echo"Identifiant de votre billet : ".$_SESSION['idmatchcommande'];
      echo "<br><br><br>";
      echo "Affiche du match : ".$_SESSION['libellematch'];
      echo "<br><br><br>";
      echo"Type de billet :".$_SESSION['libelletbillet'];
      echo "<br><br><br>";
      echo "Emplacement : ".$_SESSION ['libelleemplacement']
      ?>
  </h5>

      <h6>
<div class="bord"><br>Prix du billet simple : </div><br>

    <?php
       $_SESSION['prixtbillet']=$maConnexionBD ->getprixtbillet($_SESSION['idtbillet']);
       echo"".$_SESSION['prixtbillet']."€";
       echo"<br><br><br>";

       $_SESSION['coefmatch']=$maConnexionBD ->getcoefmatch($_SESSION['idmatchcommande']);


       $_SESSION['coeffpromo']=$maConnexionBD ->getcoeffpromo($_SESSION['idpromo']);


       $_SESSION['coeffemplacement']=$maConnexionBD ->getcoeffemplacement($_SESSION['idemplacement']);


      $ajoutprixtotal = $_SESSION['prixtbillet']*$_SESSION['coefmatch']*$_SESSION['coeffemplacement'];
      if ($_SESSION['libelletbillet']=='promo' or $_SESSION['libelletbillet']=='journéeSolidaritée'){
          $totalpromo =$_SESSION['prixtbillet']*$_SESSION['coeffpromo'];

      $prixtotal = $_SESSION['prixtbillet']+$ajoutprixtotal-$totalpromo;
      }

      else{

      $prixtotal = $_SESSION['prixtbillet']+$ajoutprixtotal;}

      echo "Prix final après application des coefficients :  ";
      echo"<br><br>";
       echo"".$prixtotal."€";

      $_SESSION['prixtotal']=$prixtotal;

    ?>
  </h6>

<input type="hidden" value="<?php echo $prixtotal?>" name="prixtotal">;

<output type = 'text' name = "billet">  </output> <br/>

     <p>
        <input type="submit" value="Valider" name="co">
    </p>

</form>

 <?php
     $montant = $_SESSION['prixtotal'];
     $idclient= $_SESSION['idclient'];
     $idemplacement=$_SESSION['idemplacement'];
     $idpromo=$_SESSION['idpromo'];
     $idtbillet=$maConnexionBD->getidtbillet($_SESSION['libelletbillet']);

     $maConnexionBD->ajoutCommande($idclient,$idemplacement,$idtbillet,$idpromo,$montant);


     $idbillet=$maConnexionBD->getBilletByMatch($_SESSION['idmatchcommande']);

     $maConnexionBD->quantitemoins($idbillet);

     // récuperer idbillet
 ?>

 <?php

 $_SESSION['nomclient'] = $maConnexionBD -> getnomclient($_SESSION['mail']);

 $_SESSION['prenomclient'] = $maConnexionBD -> getprenomclient($_SESSION['mail']);
 $_SESSION['telephoneclient']=  $maConnexionBD -> getelephoneclient($_SESSION['mail']);
 $_SESSION['datematch']= $maConnexionBD -> getdatematch($_SESSION['idmatchcommande']);
 $_SESSION['creneaumatch']= $maConnexionBD -> getcreneaumatch($_SESSION['idmatchcommande']);?>


 <a href ="billet.php" >
   <input type='submit' value="Imprimer le billet" name="pdf">
  </a>

</div>
  <!-- Fin page-->

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
