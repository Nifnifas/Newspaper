<html>
    <head>
        <title>IS Zurnalo redakcija</title>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
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
  
  