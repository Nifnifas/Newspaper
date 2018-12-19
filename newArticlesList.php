<html>
    <head>
        <title>Demo projektas</title>
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><img src="include/top.png"></center>
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
$_SESSION['prev'] = "newArticlesList.php";

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$query = "SELECT article_id, category_name, title, text, username, time_stamp, statusas_name "
            . "FROM " . TBL_ARTICLES . ", " . TBL_USERS . ", " . TBL_CATEGORIES . ", " . TBL_STATUS . " WHERE fk_user_id = userid AND category = category_id"
                . " AND statusas = status_id AND statusas = 1 ORDER BY article_id ASC";
	$result = mysqli_query($db, $query);
	if (!$result || (mysqli_num_rows($result) < 1))  
                                {echo "<table class=\"center\" style=\"border-color: white;\"><br><br><tr><td>Nepatvirtintų straipsnių nėra!</td></tr></table><br>";exit;}
?>

 <table class="center" style="border-color: white;"><br><br><tr><td>
<?php

    echo "<table>"; // start a table tag in the HTML
    echo "<tr><td>ID</td><td>Kategorija</td><td>Antraštė</td><td>Santrumpa</td><td>Autorius</td><td>Data</td><td>Statusas</td></tr>";
    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['article_id'] . "</td><td>" . $row['category_name'] . "</td><td>" .$row['title'] . "</td><td>" .shorterText($row['text'], 7)
                . "</td><td>" .$row['username'] . "</td><td>" .$row['time_stamp'] . "</td><td>" .$row['statusas_name']
                . "</td><td>" . "<form action='read.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button type='submit' name='submit'>Skaityti</button></form>"
                . "</td><td>" . "<form action='changeStatusArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><input name='status_id' value='2' hidden><button type='submit' name='submit'>Patvirtinti</button></form>"
                . "</td><td>" . "<form action='changeStatusArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><input name='status_id' value='3' hidden><button type='submit' name='submit'>Prašyti pataisymų</button></form>"
                . "</td><td>" . "<form action='changeStatusArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><input name='status_id' value='4' hidden><button type='submit' name='submit'>Atmesti</button></form>"
                . "</td><td>" . "<form action='editArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button type='submit' name='submit'>Redaguoti</button></form>" 
                . "</td><td>" . "<form action=\"procArticleDelete.php\" method=\"post\" onsubmit=\"return confirm('Ar tikrai norite ištrinti šį straipsnį?');\"><input type=\"submit\" value =\"Šalinti\"/><input type=\"hidden\" name=\"article_id\" value=\"$row[article_id]\">"
                . "</form></td></tr>";
    }
    echo "</table>"; //Close the table in HTML
    mysqli_close($db);
?>
</td></tr>
    </table><br>		
    </div><br></table>
</body>
</html>