<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Sopra Steria | Inscription </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css"/>
    </head>

    <body>
    <script type="text/javascript">
    var param="";
    var i=1;
        function getSelected(sel) {
             var idMatch = sel.options[sel.selectedIndex].value; // recupere le champ value de l'option (l'ID)

             a=idMatch;
              window.location.href ="admingeneral.php?var1="+a;
        }

    </script>

      <div class = "block3">
          <nav>
          <ul id = "menu"><!-- menu de navigation du site -->
             <li><img src="logosopra.png" width="70%" height="70%"> </li>
              <li><a href = "#"> Actualités </a> </li>
              <li> <a href = "#">  Billeterie </a></li>
              <li> <a href="#">Planning Match</a></li>
              <li> <a href="#">Résultats</a></li>
             <a href = "seconnecter.php"><button class="favorite styled" type="button"> Se Connecter </button></a>
             <a href = "sinscrire.php"><button class="favorite styled" type="button"> S'Inscrire </button></a>
             </ul></nav></div>

             <div class = "container">
                 <div class = "bloc1">

                 </div>

                 <div class = "bloc22">
                     <div class = "titres">
                         <h2  class = "texteaccueil">Supprimer une liasse de billet</h2>
                     </div>

                     <div class = "inscription">

                             <center>
                                  <form action="admingeneral.php" method="post" id="demoForm" class="demoForm">
                                     <fieldset>
                                     <!-- ici on fera plutot des listes déroulantes pour ces deux champs ou on selectionne les objets présents en BD -->
                                    <h6>Selectionner les billets à supprimer :</h6>

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
                                <input type="submit" value="valider" name="validerB">
                                </p>

                                </form>
                                 <?php
                                    if(isset($_POST['validerB'])){
                                        $maConnexionBD->supprimerBillets($_SESSION['oui']);
                                    }
                                 ?>

                             </center>
                         </div>
                     </div>
                 </div>
             </div>


             <div class = "container">
                 <div class = "bloc2">

                 </div>





              <div class = "container">
                 <div class = "bloc2">

                 </div>

                 <div class = "bloc3">
                     <div class = "titres">
                         <h2  class = "texteaccueil">Ajout Emplacement</h2>
                     </div>

                     <div class = "inscription">

                             <center>
                                 <form action = "admingeneral.php" method="post">
                                 <h6> Libelle</h6>
                                     <input type="text" name="libelleE"><br/>
                                <h6>Coefficient:</h6>
                                     <input type="text" name="coeffE"><br/>



                                  <p>
                                     <input type="submit" value="Valider" name="validerE">
                                 </p>
                             </form>
                             <?php

                            	if(isset($_POST['validerE'])) {

                            	    $libelleE = $_REQUEST['libelleE'];
                            	    $coeffE = $_REQUEST['coeffE'];
                               		$maConnexionBD->ajoutEmplacement($libelleE,$coeffE);
                            	}

                            ?>



                            <div class = "bloc4">
                     <div class = "titres">
                         <h2  class = "texteaccueil">Ajout code promo</h2>
                     </div>

                     <div class = "inscription">

                             <center>
                                 <form action = "admingeneral.php" method="post">
                                 <h6> Libelle</h6>
                                     <input type="text" name="libelleP"><br/>
                                <h6>Coefficient:</h6>
                                     <input type="text" name="coeffP"><br/>


                                        <h6>billet concerné:  </h6>

                                     <select name="tbillet">

                                   <option value="1" > Promo </option>

                                   <option value="4" > billet solidaritée </option>


                                       </select>


                                     <p>
                                     <input type="submit" value="Valider" name="validerP">
                                 </p>
                                 </form>




                                <?php

                             	if(isset($_POST['validerP'])) {

                        	    $libelleP = $_POST['libelleP'];
                        	    $coeffP = $_POST['coeffP'];
                              $idtbillet= $_POST['tbillet'];

                              echo $libelleP ;
                        	    echo $coeffP ;
                              echo $idtbillet;

                        	    $maConnexionBD->ajoutcodepromo($libelleP,$coeffP,$idtbillet);

                        	    }


                                ?>


                             </center>
                         </div>
                     </div>
                 </div>
             </div>




           </body>
           </html>
