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

    <div class="ajoutB">
        <h3><div class="bord2"><p>Ajouter une liasse de billets </p></div></h3>

        <center>
          <form action="admin3.php" method="post">
             <fieldset>
               <h4>Sélectionner le type de billet</h4>
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

               /*  affiche le type selectionné. */
               if(isset($_GET["var1"])){
                   $idtbillet=$_GET["var1"];
               }

               if (isset($idtbillet)){
                 foreach ($tabE as $key => $value ) {
                       if($value['idtbillet']==$idtbillet) {
                echo '<i style="color:whitesmoke;"><br><br>';
                  echo $value['libelletbillet'] . " est le type selectionné"  ;
                  echo '</i>';
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
           <input type="submit" value="Valider" name="validerB">
          </p>

            </fieldset>
           </form>
        </center>
      </div>
