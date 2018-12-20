<?php

session_start();
// cia sesijos kontrole
//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
//{ header("Location:articles.php");exit;}
include("include/nustatymai.php");
include("include/functions.php");
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] < $user_roles[DEFAULT_LEVEL]))   { header("Location: logout.php");exit;}
$_SESSION['prev'] = "add_comment.php"; 
//$connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$connect = new PDO('mysql:host=localhost;dbname=lukkru2', 'lukkru2', 'Bijaerov3ceebair');

$error = '';
$comment_name = '';
$comment_content = '';


if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Jūs neįvedėte komentaro!</p>';
}
else
{
    $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 $query = "
 INSERT INTO " . TBL_COMMENTS . " 
 (parent_comment_id, comment, sender_id, fk_article_id) 
 VALUES (:parent_comment_id, :comment, :sender_id, :fk_article_id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':sender_id' => $_SESSION['userid'],
   ':fk_article_id' => $_SESSION['art']
  )
 );
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
