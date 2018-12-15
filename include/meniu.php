<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userid = $_SESSION['userid'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";
        if ($_SESSION['user'] != "guest") echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";
        echo "[<a href=\"articlesList.php\">Straipsniai</a>] &nbsp;&nbsp;";


     //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        if (($userlevel == $user_roles["Skaitytojas"]) || ($userlevel == $user_roles[ADMIN_LEVEL] )) {
            echo "[<a href=\"myArticles.php\">Mano straipsniai</a>] &nbsp;&nbsp;";
        }   
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "[<a href=\"newArticlesList.php\">Nepatvirtinti straipsniai</a>] &nbsp;&nbsp;";
                echo "[<a href=\"admin.php\">Vartotojų valdymas</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
    
 