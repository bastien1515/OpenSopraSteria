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
    Administration des matchs
</div>
</div>
<!--Fin Image accueil-->





<div class="formulaireA">

  <div class = "ajoutM">
  <h3><div class="bord2"><p>Ajouter un match </p></div></h3>
  </div>
            <center>
                <form action = "planning2.php" method="post">
                <fieldset>
                  <h4>Sélectionner le type de match :</h4>
                  <select name="typeMatch">
                      <option value="Tournoi">Tournoi   </option>
                      <option value="Entrainement">Entrainement </option>
                  </select>

                  <h4>Sélectionner le tournoi (entraînement non concerné):</h4>
                  <select name="tournoi">
                      <option value=""></option>
                      <option value="Tournoi simple">Tournoi Simple </option>
                      <option value="Tournoi double">Tournoi Double </option>
                  </select>

                  <h4>Indiquer l'affiche du match :</h4>
                  <!--Libelle du match (écrire la phase [ex : Demi-finale], le tournoi et les joueurs participants -->
                  <input type="text" name="libelleMatch"><br/>

                  <h4>Indiquer le coefficient à appliquer au match :</h4>
                  <input type="text" name="coefMatch"><br/>


                     <h4>Sélectionner le créneau du match :</h4>
                     <select name="creneauMatch">
                         <option selected>Matin </option>
                         <option>Midi </option>
                         <option>Soirée</option>
                     </select>


                     <h4>Sélectionner la date du match :</h4>
                     <input type="date" id="start" name="dateMatch"

                     min="2020-01-01" max="2020-12-31"> <br/>

                     <h4>Sélectionner le court :</h4>
                     <select name="courtMatch">
                         <option  value="Court central">Court central </option>
                         <option value="Court 1">Court 1 </option>
                         <option value="Court 2">Court 2 </option>

                     </select>


                 <p>
                 <input type="submit" value="valider" name="validerM2">
                 </p>
            </fieldset>
            </form>
            </center>

    <div class = "voirM">
       <h3><div class="bord2"><p>Visualiser le planning des matchs</p></div></h3>
    </div>
        <center>
          <?php
             $tab= $maConnexionBD->afficherMatch();
             foreach ($tab as $key => $value) {
                 echo '<table>';
                 echo '<tr><td id="contenu">'.$value['dateMatch'].'<br></td>';
                 echo '<td>'.$value['creneauMatch'].'<br></td>';
                 echo '<td>'.$value['libelleMatch'].'<br></td>';
                 echo '</tr>';
                 echo'</table><br>';
              }

          ?>

      </div>
    </body>
    </html>
