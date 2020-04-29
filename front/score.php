<?php session_start();
include_once("ClasseConnexion.php");
$co = new Connection();?>
<!doctype HMTL>
<html >
    <head>
        <title>OPEN SOPRA STERIA </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css">
    </head>
 <body>
   <script type="text/javascript">
   var param="";
   var i=1;
       function getSelected(sel) {
            var idMatch = sel.options[sel.selectedIndex].value;
            a=idMatch;
             window.location.href ="score.php?var1="+a;
       }

   </script>

     <div class = "block1"> <!-- page d'accueil du site ! -->
     <h1>OPEN TOURNOI SOPRA STERIA</h1>


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
             $co->disconnect();
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
               <h2 class = "texteaccueil">Renseigner un score</h2>
             </div>

             <div class = "inscription">
               <center>
                 <form action ="score2.php" method="post" id="demoForm" class="demoForm">
                   <!-- Sélection du match -->
                   <h6>Sélectionner le match :</h6>
                   <select onChange="getSelected(this);" name="idmatch">
                     <?php
                        $tab=$co->getMatchs();
                        echo "<option value='' > " ;
                        foreach ($tab as $key => $value ) {
                             echo " <option value=".$value['idmatch']." > ";
                             echo $value['libellematch'];
                             echo "</option>";
                        }
                     ?>
                   </select>
                   <br/><br/>
                   <!-- Confirmation du match -->
                   <?php
                     if(isset($_GET["var1"])){
                         $idmatch=$_GET["var1"];
                         foreach ($tab as $key => $value ) {
                             $estjoue = $co->getEstJoue($idmatch);
                             if($value['idmatch']==$idmatch && $estjoue !=1) {
                                 $_SESSION['idmatch'] = $idmatch;
                                 echo  'Souhaitez-vous enregistrer le score
                                        relatif au match suivant : '.$value['libellematch'].' ?<br/><br/>' ;
                                 echo '<input type="submit" value="confirmer" name="validerM">';
                             }
                             else{
                               if($value['idmatch']==$idmatch && $estjoue !=0){
                                 echo 'Ce match a déja été joué. Impossible de remplir les scores à nouveau.';
                               }
                             }
                         }
                     }
                   ?>
                 </form>
               </center>
             </div>
           </div>

     </div>
 </body>
</html>
