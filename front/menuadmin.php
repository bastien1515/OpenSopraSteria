<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Sopra Steria | Admin </title>
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

             //alert(idEmplacement);

             a=idMatch;
             //window.location.href = "admin.php?var1=" + a;

            // window.location.href = "admin.php?var1=" + a + "&var2=" + b + "&var3=" + c ;
             //window.location.href = "admin.php?var1=" + a;
           // setParam(a);
             // bon la fonction prend les memes valeurs pour les 3, faudrait faire 3 fonctions je pense


              window.location.href ="admin.php?var1="+a;
        }
        /*
        function getSelectedE(sel){
            var idEmplacement = sel.options[sel.selectedIndex].value;
            b=idEmplacement;
          //  window.location.href = "admin.php?var2=" + b;
            setParam(b);
        }

        function getSelectedP(sel){
            var idPromo = sel.options[sel.selectedIndex].value;
            c=idPromo;
            //window.location.href = "admin.php?var3=" + c;
            setParam(c);

        }

        function setParam(id){
            param = param + "var"+i+"="+id;
            alert(param);
            i++;
            window.location.href ="admin.php?"+param

        }
        */
    </script>


    <!--menu-->
      <ul class="menu">
      <img src="../images/logosopra.png" width="5%" height="10%">
      <li><a href="joueur.php" data-hover="Joueur">Gestion Joueurs</a></li>
      <li><a href="planning1.php" data-hover="Match">Gestion Matchs</a></li>
      <li><a href="admin.php" data-hover="Billet">Gestion Billetterie</a></li>
      <li><a href="score.php" data-hover="Score">Gestion Scores</a></li>';
<?php
      echo '<form action="" method="post">';
      echo '<input class="bouton" type="submit" name="deco" value="Se deconnecter">';
      echo '</form>';
     if(isset($_POST['deco']))
     {
         $maConnexionBD->disconnect();
         echo '<body onLoad="alert(\'Déconnexion...\')">';
         echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
     }
?>
      </ul>
    <!--Fin du menuA-->

    <!--Image d'accueil-->
    <div class="accueil">
      <img class="photo1" src="../images/terrebattue.jpg">
      <div class="texte">
        Bienvenue sur l'Espace Administrateur
    </div>
    </div>
    <!--Fin Image accueil-->
  </body>
  </html>
