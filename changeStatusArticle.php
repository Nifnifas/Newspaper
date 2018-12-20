<html>
    <head>
        <title>IS Zurnalo redakcija</title>
    </head>
    <body>
        
    </body>
</html>

<?php
// procregister.php tikrina registracijos reikšmes
// įvedimo laukų reikšmes issaugo $_SESSION['xxxx_login'], xxxx-name, pass, mail
// jei randa klaidų jas sužymi $_SESSION['xxxx_error']
// jei vardas, slaptažodis ir email tinka, įraso naują vartotoja į DB, nukreipia į index.php
// po klaidų- vel į register.php 

session_start(); 
// cia sesijos kontrole
//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "newarticle"))
//{ header("Location: articles.php");exit;}

  include("include/nustatymai.php");
  include("include/functions.php");
 if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL]))   { header("Location: logout.php");exit;}
  $_SESSION['prev'] = "changeStatusArticle.php";
  $id = $_POST['article_id'];
  $status = $_POST['status_id'];

// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE " . TBL_ARTICLES . " SET `statusas`= '$status' WHERE `article_id` = '$id'";

if (mysqli_query($conn, $sql)) {
    echo "<br><br><br><h3>Straipsnio statusas sėkmingai pakeistas!</h3>";
    header( "refresh:1;url=newArticlesList.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
//header("Location:articles.php");exit;
?>
  
  