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
                     var idMatch = sel.options[sel.selectedIndex].value; // recupere le champ value de l'option (l'ID)
                    // alert(sel.options[sel.selectedIndex].text); // récupere le texte stocké dans l'option
                     a=idMatch;
                     window.location.href ="admin.php?var1="+a;
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

          <div class="ajoutB">
              <h3><div class="bord2"><p>Ajouter unE liasse de billets </p></div></h3>

                <center>
                  <form action="admin2.php" method="post">
                   <fieldset>
                     <h4>Sélectionner le match :</h4>

                     <select onChange="getSelected(this);" name="idmatch">
                     <?php
                        $tabE=$maConnexionBD->getMatchs();
                         // tabE est un tableau de tableau
                         // var_dump($tabE); // pour tester le résultat
                         echo "<option value='' > " ; // première ligne vide pour afficher rien au chargement de la page

                         foreach ($tabE as $key => $value ) {
                             // il faudra donner un nom au select
                             echo " <option value=".$value['idmatch']." > ";
                             echo $value['libellematch'];
                             //  si je veux afficher qu'une colonne d'un tuple je parcours le premier tableau avec la clef.
                             echo "</option>";
                         }

                         //   $maConnexionBD->setQuantiteBillet(45,1); test fonction


                     ?>
                     </select>


                     <?php
                     echo'<h4>';
                     /*  affiche le match selectionné. */
                     if(isset($_GET["var1"])){
                         $idMatch=$_GET["var1"];

                         foreach ($tabE as $key => $value ) {
                             if($value['idmatch']==$idMatch) {
                                 echo  $value['libellematch'] . " selectionné";
                                         }
                         }
                     }

                     /* stockage de l'id match en session. */
                     if(isset($_GET["var1"])){

                          $idMatch=$_GET["var1"];  // récupere l'idMatch dans l'URL
                          $_SESSION['idmatch'] = $idMatch; // stocke l'idMatch en variable de session
                     }
                     ?>


                     <h4> Libellé :</h4>
                     <input type="text" name="libelleB"><br/>

                     <h4>Quantité voulue :</h4>
                     <input type="text" name="quantiteB"><br/>

                     <p>
                       <input type="submit" value="valider" name="validerB">
                     </p>

                      </fieldset>
                     </form>
                    </center>
                   </div>



              <div class="suppression">
              <h3><div class="bord2"><p>Supprimer une liasse de billets </p></div></h3>

                  <center>
                       <form action="admin.php" method="post">
                        <fieldset>
                          <!-- ici on fera plutot des listes déroulantes pour ces deux champs ou on selectionne les objets présents en BD -->
                         <h4>Sélectionner les billets à supprimer :</h4>

                         <select onChange="getSelected(this);" name="idmatch">

                         <?php

                        $tabE=$maConnexionBD->getIdBillets();
                         // tabE est un tableau de tableau

                         // var_dump($tabE); // pour tester le résultat
                         echo "<option value='' > " ; // première ligne vide pour afficher rien au chargement de la page
                         foreach ($tabE as $key => $value ) {
                             // il faudra donner un nom au select
                             echo " <option value=".$value['idbillet']." > ";
                             echo $value['libellebillet'];
                             //  si je veux afficher qu'une colonne d'un tuple je parcours le premier tableau avec la clef.
                             echo "</option>";
                         }

                      //   $maConnexionBD->setQuantiteBillet(45,1); test fonction

                         ?>
                         </select>

                         <?php
                         /*  affiche le match selectionné. */
                         if(isset($_GET["var1"])){
                             $idbillet=$_GET["var1"];
                             $_SESSION['oui']=$idbillet;

                             foreach ($tabE as $key => $value ) {
                                 if($value['idbillet']==$idbillet) {
                                     echo  $value['libellebillet'] . " selectionné"  ;
                                 }
                             }
                         }
                         ?>

                     <p>
                     <input type="submit" value="Valider" name="validerB">
                     </p>
                   </fieldset>
                     </form>

                      <?php
                         if(isset($_POST['validerB'])){
                             $maConnexionBD->supprimerBillets($_SESSION['oui']);
                         }
                      ?>

                  </center>
              </div>



      <div class = "ajoutE">
          <h3><div class="bord2"><p>Ajouter un emplacement </p></div></h3>

                  <center>
                      <form action = "admin.php" method="post">
                      <fieldset>
                      <h4> Libellé : </h4>
                          <input type="text" name="libelleE"><br/>

                      <h4>Coefficient :</h4>
                          <input type="text" name="coeffE"><br/>

                       <p>
                          <input type="submit" value="Valider" name="validerE">
                      </p>
                  </fieldset>
                  </form>

                  <?php

                   if(isset($_POST['validerE'])) {

                       $libelleE = $_REQUEST['libelleE'];
                       $coeffE = $_REQUEST['coeffE'];
                       $maConnexionBD->ajoutEmplacement($libelleE,$coeffE);
                   }
                 ?>

               </center>
             </div>


          <div class = "ajoutC">
              <h3><div class="bord2"><p>Ajouter un code promo </p></div></h3>

                  <center>
                      <form action = "admin.php" method="post">
                      <fieldset>
                      <h4> Libellé :</h4>
                          <input type="text" name="libelleP"><br/>

                     <h4>Coefficient : </h4>
                          <input type="text" name="coeffP"><br/>

                     <h4>Billet concerné :</h4>

                         <select name="tbillet">
                         <option value="1" > Promo </option>
                         <option value="4" > Billet solidarité </option>
                         </select>

                      <p>
                          <input type="submit" value="Valider" name="validerP">
                      </p>
                      </fieldset>
                      </form>

                    <h5> <?php
                   if(isset($_POST['validerP'])) {

                   $libelleP = $_POST['libelleP'];
                   $coeffP = $_POST['coeffP'];
                   $idtbillet = $_POST['tbillet'];
                   $maConnexionBD->ajoutcodepromo($libelleP,$coeffP,$idtbillet);
                   }
                     ?></h5>


                  </center>
              </div>
          </div>

</body>
</html>
