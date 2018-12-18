<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole
//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
//{ header("Location:articles.php");exit;}
include("include/nustatymai.php");
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

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Demo projektas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><img src="include/top.png"></center>
        </td></tr><tr><td> 
        </table>
        <br>

    <table  class="center" style="border-width: 2px; border-style: dotted;"><tr><td>
                Atgal į [<a href="articlesList.php">Straipsniai</a>]
      </td></tr>
	</table><br>
        <table style="width:100%">
<?php

    $row = mysqli_fetch_array($result);   //Creates a loop to loop through results
    $viewsCount = $row['views']+1;
    $short = shorterText($row['text'], 600);
    echo "<div class=\"container\">
            <h2>$row[title]</h2>
            <h6>
                Autorius: $row[username]
                <small class=\"text-muted\"> Patalpinta: $row[time_stamp]</small>
            </h6>
            <p class=\"lead\" align=\"left\">$short</p>
            <p class=\"lead\" align=\"center\" style=\"color:red;\">Norėdami perskaityti visą straipsnį turite užsiregistruoti!</p>
            <button type=\"submit\" onclick=\"window.location.href='register.php'\" class=\"btn btn-default reply\">Registracija</button>
            </div>";
    $uql = "UPDATE " . TBL_ARTICLES . " SET `views`= '$viewsCount'"
                . " WHERE `article_id` = '$_SESSION[art]'";
    mysqli_query($db, $uql);
    mysqli_close($db);
    
?>
        <br>	
</body>
</html>