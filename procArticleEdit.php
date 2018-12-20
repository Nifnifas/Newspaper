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
          if (!isset($_SESSION['prev']) || $_SESSION['ulevel'] < $user_roles[DEFAULT_LEVEL] || $_SESSION['ulevel'] == 5)   { header("Location: logout.php");exit;}
        $_SESSION['prev'] = "procArticleEdit.php";
  $id = $_POST['id'];
  $category = $_POST['category'];
  $title = $_POST['title'];
  $text = $_POST['text'];
  $status = "1";
// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	
$sql = "UPDATE " . TBL_ARTICLES . " SET `category`= '$category', `title`= '$title', `text`= '$text', `statusas` = '$status' WHERE `article_id` = '$id'";

if(mysqli_query($conn, $sql)){
    echo "<br><br><br><h3>Straipsnis atnaujintas sėkmingai! Laukite redaktoriaus patvirtinimo.</h3>";
    header( "refresh:2;url=myArticles.php");
} else{
    echo "Klaida: $sql. " . mysqli_error($conn);
}

mysqli_close($conn);
//header("Location:articles.php");exit;
?>
  
  