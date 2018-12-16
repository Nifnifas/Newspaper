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
$uql = "SELECT * FROM " . TBL_COMMENTS . " WHERE parent_comment_id = $_POST[comment_id]";
$result = mysqli_query($conn, $uql);
if (mysqli_num_rows($result) > 0){
    echo "Klaida! Trinti šį komentarą galėsite tik tada, kai ištrinsite visus atsakymus į šį komentarą!";
    header( "refresh:1;url=read.php");
}
else{
    $sql = "DELETE FROM " . TBL_COMMENTS . " WHERE comment_id = $_POST[comment_id]";
    if(mysqli_query($conn, $sql)){
        echo "Komentaras ištrintas sėkmingai!";
        header( "refresh:1;url=read.php");
    }
}
mysqli_close($conn);
?>
  
  