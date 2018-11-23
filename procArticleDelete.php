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
  
// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM " . TBL_ARTICLES . " WHERE article_id= $_SERVER[QUERY_STRING]";
if(mysqli_query($conn, $sql)){
    echo "Records were deleted successfully.";
    header( "refresh:1;url=articlesList.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close($conn);
//header("Location:articles.php");exit;
?>
  
  