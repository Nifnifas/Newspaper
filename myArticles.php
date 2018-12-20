<html>
    <head>
        <title>Mano straipsniai</title>
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><img src="include/topB.png"></center>
        </td></tr><tr><td> 
                
        <?php
        // operacija1.php
        // skirtapakeisti savo sudaryta operacija pratybose

        session_start();
        // cia sesijos kontrole
        //if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
        //{ header("Location:articles.php");exit;}
        include("include/meniu.php");
        include("include/functions.php");
        // cia sesijos kontrole
        if (!isset($_SESSION['prev']) || $_SESSION['ulevel'] < $user_roles[DEFAULT_LEVEL] || $_SESSION['ulevel'] == 5)   { header("Location: logout.php");exit;}
        $_SESSION['prev'] = "myArticles.php";
        $user=$_SESSION['user'];
        $userid=$_SESSION['userid'];

        $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                $query = "SELECT article_id, category_name, fk_user_id, title, time_stamp, statusas_name "
                    . "FROM " . TBL_ARTICLES . ", " . TBL_USERS . ", " . TBL_CATEGORIES . ", " . TBL_STATUS . " WHERE fk_user_id = userid AND fk_user_id = '$userid' AND category = category_id AND statusas = status_id"
                        . " ORDER BY statusas_name ASC";
                $result = mysqli_query($db, $query);
                if (!$result || (mysqli_num_rows($result) < 1))  
                                {echo "<table class=\"center\" style=\"border-color: white;\"><br><br><tr><td>Jūs dar neturite savo straipsnių!</td></tr></table><br>";exit;}
        ?>


                <table class="center" style="border-color: white;"><br><br><tr><td>

 
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col"></th>
                  <th scope="col" style="text-align: center">Mano straipsniai</th>
                  <th scope="col" style="text-align: center">Įkėlimo data</th>
                  <th scope="col" style="text-align: center">Statusas</th>
                  <th colspan="2" style="text-align: center">Funkcijos</th>
                </tr>
              </thead>
              <tbody> <?php
                        $count = 1;
                        while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                            echo "<tr><th scope=\"row\"><button class='btn btn-link' disabled>" . $count++ . "</button></th><td>";
                            echo "<form action='read.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button class='btn btn-link' type='submit' name='submit'>$row[title]</button></form></td><td style=\"text-align: center\">";
                            echo "<button class='btn btn-link' disabled><b>" . $row['time_stamp'] . "</b></td><td style=\"text-align: center\">";
                            echo "<button class='btn btn-link' disabled><b>" . $row['statusas_name'] . "</b></td><td>";
                            echo "<form action='editArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button class=\"btn btn-outline-warning\" type='submit' name='submit'>Redaguoti</button></form>"
                                         ."</td><td>" . "<form action=\"procArticleDelete.php\" method=\"post\" onsubmit=\"return confirm('Ar tikrai norite ištrinti šį straipsnį?');\"><button class=\"btn btn-outline-danger\" type=\"submit\">Šalinti</button><input type=\"hidden\" name=\"article_id\" value=\"$row[article_id]\">";
                            echo "</form></td></tr>";
                        }
            echo "</tbody></table>"; // start a table tag in the HTML
    mysqli_close($db);
    
    if($count-- == 0){
        echo "<b>Jūs dar neturite savo sukurtų straipsnių!</b>";exit;
    }
?>
                </td></tr>
	</table><br>
			
			
    </div><br></table>
</body>
</html>