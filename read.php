<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Straipsnio skaitymas</title>
        
                  
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><img src="include/topB.png"></center>
        <br>
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
        echo "<div class=\"container\">
                <center>
                <h2>$row[title]</h2>
                <h6>
                    Autorius: $row[username]
                    <small class=\"text-muted\"> Patalpinta: $row[time_stamp]</small>
                </h6>
                </center>
                <p class=\"lead\" align=\"left\">$row[text]</p>
                </div>";
        $uql = "UPDATE " . TBL_ARTICLES . " SET `views`= '$viewsCount'"
                    . " WHERE `article_id` = '$_SESSION[art]'";
        mysqli_query($db, $uql);
        mysqli_close($db);

    ?>
        <br>	
         </td></tr>
                </table><br><br>   
        
<div class="container">
   <form method="POST" id="comment_form">
    <div class="form-group">
        <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Įveskite komentarą" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <center><input type="submit" name="submit" onclick="refreshPage();" id="submit" class="btn btn-info" value="Komentuoti" /></center>
   </form>
         
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>
</td></tr><tr><td> 
</table>
<script>
function refreshPage(){
    window.location.reload();
}
</script>
<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error !== '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }
 
 $('#submit').click(function(){
      $('#comment_content').load('add_comment.php #comment_content', function() {
           /// can add another function here
      });
   });

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });
});
</script>
        
</body>
</html>