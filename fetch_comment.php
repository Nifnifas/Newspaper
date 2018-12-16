<?php
session_start();
// cia sesijos kontrole
//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
//{ header("Location:articles.php");exit;}
include("include/nustatymai.php");
include("include/functions.php");
$user=$_SESSION['user'];
$userid = $_SESSION['userid'];
$userlevel=$_SESSION['ulevel'];
//$connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$connect = new PDO('mysql:host=localhost;dbname=newspaper', 'root', '');

$query = "SELECT username, date, comment, comment_id FROM " . TBL_COMMENTS . ", " . TBL_USERS . 
        " WHERE sender_id = userid AND parent_comment_id = '0' AND fk_article_id = '$_SESSION[art]' ORDER BY comment_id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row){
    if($userlevel == $user_roles[ADMIN_LEVEL]){
        $output .= '
            <div class="panel panel-default">
             <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
             <div class="panel-body">'.$row["comment"].'</div>
                 <div class="panel-footer" align="right"><form action="delete_comment.php" method="post"><button type="submit" class="btn btn-default reply">Šalinti</button><input type="hidden" name="comment_id" value="'.$row["comment_id"].'"></form><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Atsakyti</button></div>
            </div>
            ';
        $output .= get_reply_comment($connect, $row["comment_id"]);
    }
    else{
        $output .= '
            <div class="panel panel-default">
             <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
             <div class="panel-body">'.$row["comment"].'</div>
                 <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Atsakyti</button></div>
            </div>
            ';
        $output .= get_reply_comment($connect, $row["comment_id"]);
    }
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
 $user=$_SESSION['user'];
 $userid = $_SESSION['userid'];
 $userlevel=$_SESSION['ulevel'];
 $adminLevel = 9;
 $query = "SELECT username, date, comment, comment_id FROM " . TBL_COMMENTS . ", " . TBL_USERS . 
         " WHERE sender_id = userid AND parent_comment_id = '" . $parent_id ."' AND fk_article_id = '$_SESSION[art]' ORDER BY comment_id DESC";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row){
      if($userlevel == $adminLevel){
            $output .= '
                <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
                 <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
                 <div class="panel-body">'.$row["comment"].'</div>
                 <div class="panel-footer" align="right"><form action="delete_comment.php" method="post"><button type="submit" class="btn btn-default reply">Šalinti</button><input type="hidden" name="comment_id" value="'.$row["comment_id"].'"></form><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Atsakyti</button></div>
                </div>
                ';
            $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
      }
      else{
          $output .= '
                <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
                 <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
                 <div class="panel-body">'.$row["comment"].'</div>
                 <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Atsakyti</button></div>
                </div>
                ';
          $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
      }
    }
 }
 return $output;
}

?>
