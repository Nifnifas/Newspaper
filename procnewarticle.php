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
 
  $category = $_POST['category'];
  $title = $_POST['title'];
  $text = $_POST['text'];
  $fk_user_id = $_SESSION['userid'];
  $_SESSION['prev'] = "procnewarticle";

        // registracijos formos lauku  kontrole
        /*if (checkname($user))
		{ // vardas  geras,  nuskaityti vartotoja is DB
      
		 list($dbuname)=checkdb($user);  //patikrinam DB       
         if ($dbuname)  {  // jau yra toks vartotojas DB
		     $_SESSION['name_error']= 
				 "<font size=\"2\" color=\"#ff0000\">* Tokiu vardu jau yra registruotas vartotojas</font>";
				 }*/

// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO " . TBL_ARTICLES . " (
        category, 
        title, 
        text, 
        fk_user_id
    )
    VALUES (
        '$category',
            '$title',
                '$text',
                    '$fk_user_id'
                
        )";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    header( "refresh:2;url=articles.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
//header("Location:articles.php");exit;
?>
  
  