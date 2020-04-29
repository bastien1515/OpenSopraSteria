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
  <form action="billetteriesuite.php" method="post">
<h6><div class="bord2"><p>Faites votre choix :</p></div></h6>

  <table name= 'tableaudesalome' id="tableau" >
<tr>

<td id = "entete"> Date </td>
<td id = "entete"> Match </td>
<td id = "entete">Quantité restante</td>
<td id ="entete"> Choisissez votre billet </td>


<?php
$i=1;
$tabE= $maConnexionBD->colonnedatebillet();

foreach ($tabE as $key => $value) {
echo "<tr><td>$value[dateMatch]<br></td>";
echo "<td>$value[libelleMatch]<br></td>";
echo "<td>"; $maConnexionBD->quantiteBillets($value['idmatch']);  echo "<br></td>";
echo "<td><center><input type=radio id='choix$i' name='select' value=$value[idmatch]></center></td></tr>";
$i++;
}
?>
</tr>
</table>

<input type="submit" value="Suivant" name="co" > </a>

</form>
</div>
<br><br><br><br><br>
<!--Fin Choix-->


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
