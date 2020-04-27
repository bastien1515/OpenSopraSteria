<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Sopra Steria | Inscription </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="design.css"/>
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

    <?php
    if(isset($_SESSION['mail'])){
      if($_SESSION['mail']=='admin'){
        echo '<div class = "block3">
            <nav>
            <ul id = "menu"><!-- menu de navigation du site -->
               <li><img src="logosopra.png" width="70%" height="70%"> </li>
                <li><a href = "joueur.php"> Adminstration des joueurs </a> </li>
                <li> <a href = "planning1.php"> Administration des matchs </a></li>
                <li> <a href="admin.php">  Administration de la billeterie </a></li>
                <li> <a href="score.php"> Administration des scores </a></li>';

         echo '<form action="" method="post">';
         echo '<input class="favorite styled" type="submit" name="deco" value="Se deconnecter">';
         echo '</form>';
        if(isset($_POST['deco']))
        {
            $maConnexionBD->disconnect();
            echo '<body onLoad="alert(\'Déconnexion...\')">';
            echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
        }
        echo '</ul></nav></div>';
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

             <div class = "container">
                 <div class = "bloc1">

                 </div>

                 <div class = "bloc22">
                     <div class = "titres">
                         <h2  class = "texteaccueil">Ajouter une liasse de Billets</h2>
                     </div>

                     <div class = "inscription">

                             <center>
                                  <form action="admin3.php" method="post" id="demoForm" class="demoForm">
                                     <fieldset>
                                     <!-- ici on fera plutot des listes déroulantes pour ces deux champs ou on selectionne les objets présents en BD -->



                                    <h6>Selectionner le type de billet</h6>
                                    <select onChange="getSelected(this);">
                                    <?php

                                    $tabE=$maConnexionBD->gettbillet();
                                    // tabE est un tableau de tableau

                                    // var_dump($tabE);
                                    echo "<option value='' > " ;

                                    foreach ($tabE as $key => $value ) {
                                        // il faudra donner un nom au select
                                        echo " <option value=".$value['idtbillet']." > ";
                                        echo $value['libelletbillet'];
                                        //  si je veux afficher qu'une colonne d'un tuple je parcours le premier tableau avec la clef.
                                        echo "</option>";
                                    }

                                    echo" </select>";

                                    /*  affiche l'emplacement selectionné. */
                                    if(isset($_GET["var1"])){
                                        $idtbillet=$_GET["var1"];
                                    }

                                    if (isset($idtbillet)){                                        foreach ($tabE as $key => $value ) {
                                            if($value['idtbillet']==$idtbillet) {
                                                echo  $value['libelletbillet'] . " selectionné"  ;
                                            }
                                        }
                                    }


                       /* stockage de l'id match en session. */
                        if(isset($_GET["var1"])){
                             $idtbillet=$_GET["var1"];  // récupere l'id du type billet dans l'URL
                             $_SESSION['idtbillet'] = $idtbillet; // stocke l'idMatch en variable de session

                        }


                            if(isset($_POST['validerB']))
                            {
                                $_SESSION['libelle']= $_POST['libelleB'];
                               $_SESSION['quantite']= $_POST['quantiteB'];
                                //récuperer valeures des ID


                            }


                                    ?>






                                <p>
                                <input type="submit" value="valider" name="validerB">
                                </p>
                                </form>



                             </center>
                         </div>
                     </div>
                 </div>
             </div>




                             </center>
                         </div>
                     </div>
                 </div>
             </div>




           </body>
           </html>
