<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Straipsnio skaitymas</title>
        
                  
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><img src="include/topB.png"></center>
        <body>
<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole
//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
//{ header("Location:articles.php");exit;}
include("include/meniu.php");
include("include/functions.php");
$user=$_SESSION['user'];
$userid = $_SESSION['userid'];
$userlevel=$_SESSION['ulevel'];
if(isset($_POST['article_id'])){
    $_SESSION['art'] = $_POST['article_id'];
}
else{
    $_SESSION['art'];
}

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$query = "SELECT article_id, category_name, title, text, username, time_stamp, views "
            . "FROM " . TBL_ARTICLES . ", " . TBL_USERS . ", " . TBL_CATEGORIES . " WHERE article_id = $_SESSION[art]  AND fk_user_id = userid AND category = category_id ORDER BY article_id ASC";
	$result = mysqli_query($db, $query);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę `articles`"; exit;}
?>

 <br><br><table class="center" style="border-width: 2px; border-color: white;"><tr><td>
<?php

    $row = mysqli_fetch_array($result);   //Creates a loop to loop through results
    $viewsCount = $row['views']+1;
    $short = shorterText($row['text'], 600);
    echo "<div class=\"container\">
            <center>
            <h2>$row[title]</h2>
            <h6>
                Autorius: $row[username]
                <small class=\"text-muted\"> Patalpinta: $row[time_stamp]</small>
            </h6>
            </center>
            <p class=\"lead\" align=\"left\">$short</p>
            <p class=\"lead\" align=\"center\" style=\"color:red;\">Norėdami perskaityti visą straipsnį turite užsiregistruoti!</p>
            <center><button type=\"submit\" onclick=\"window.location.href='register.php'\" class=\"btn btn-default reply\">Registracija</button></center>
            </div>";
    $uql = "UPDATE " . TBL_ARTICLES . " SET `views`= '$viewsCount'"
                . " WHERE `article_id` = '$_SESSION[art]'";
    mysqli_query($db, $uql);
    mysqli_close($db);
    
?>
     <br>	
         </td></tr>
                </table><br><br>  
</body>
</html>