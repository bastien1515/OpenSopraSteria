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

<script type="text/javascript">
      var param="";
      var i=1;
          function getSelected(sel) {
               var idMatch = sel.options[sel.selectedIndex].value; // recupere le champ value de l'option (l'ID)
              // alert(sel.options[sel.selectedIndex].text); // récupere le texte stocké dans l'option
               a=idMatch;
               window.location.href ="admin2.php?var1="+a;
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
    Administration de la billetterie
</div>
</div>
<!--Fin Image accueil-->


<div class = "formulaireA">
          <h3><div class="bord2"><p>Veuillez confirmer l'ajout de la liasse de billets </p></div></h3>

        <center>
          <form method="post">
             <fieldset>

        <p>
        <input type="submit" value="confirmer" name="validerBi">
        </p>


     </center>

<?php

//echo $idMatch;
//     echo $_COOKIE['idmatch'];
//marche pas en cookie

if(isset($_POST['validerBi']))
{
$idbillet= $_SESSION['idtbillet'];
$idmatch= $_SESSION['idmatch'];
//récuperer valeures des ID
$libelle=$_SESSION['libelle'];
$quantite=$_SESSION['quantite'];


echo  $idbillet;
echo $idmatch;

echo $libelle;
echo $quantite;

$maConnexionBD->ajoutBillet($idmatch,$idbillet,$quantite,$libelle);
}
?>

</body>
</html>
