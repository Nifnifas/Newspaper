<html>
    <head>
        <title>Nepatvirtinti straipsniai</title>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><img src="include/topB.png"></center>
        </td></tr><tr><td>
<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include("include/meniu.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL]))   { header("Location: logout.php");exit;}
$_SESSION['prev'] = "newArticlesList.php";

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

	$query = "SELECT article_id, category_name, title, text, username, time_stamp, statusas_name "
            . "FROM " . TBL_ARTICLES . ", " . TBL_USERS . ", " . TBL_CATEGORIES . ", " . TBL_STATUS . " WHERE fk_user_id = userid AND category = category_id"
                . " AND statusas = status_id AND statusas != 2 AND statusas != 4 ORDER BY article_id ASC";
	$result = mysqli_query($db, $query);
	if (!$result || (mysqli_num_rows($result) < 1))  
                                {echo "<table class=\"center\" style=\"border-color: white;\"><br><br><tr><td>Nepatvirtintų straipsnių nėra!</td></tr></table><br>";exit;}
?>

 <table class="center" style="border-color: white;"><br><br><tr><td>

            <table class="table">
              <thead class="thead-light">
                  <tr><th colspan="8" style="text-align: center">Nepatvirtinti straipsniai</th></tr>
                <tr>
                  <th scope="col"></th>
                  <th scope="col" style="text-align: center">Straipsnis</th>
                  <th scope="col" style="text-align: center">Autorius</th>
                  <th scope="col">Kategorija</th>
                  <th scope="col" style="text-align: center">Statusas</th>
                  <th colspan="5" style="text-align: center">Funkcijos</th>
                </tr>
              </thead>
              <tbody> <?php
                        $cc = 1;
                        while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                            echo "<tr><th scope=\"row\"><button class='btn btn-link' disabled>" . $cc++ . "</button></th><td>";
                            echo "<form action='read.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button class='btn btn-link' type='submit' name='submit'>$row[title]</button></form></td><td style=\"text-align: center\">";
                            echo "<button class='btn btn-link' disabled><b style=\"color: brown\">" . $row['username'] . "</b></td><td style=\"text-align: center\">";
                            echo "<button class='btn btn-link' disabled><b style=\"color: blue\">" . $row['category_name'] . "</b></td><td style=\"text-align: center\">";
                            echo "<button class='btn btn-link' disabled><b>" . $row['statusas_name'] . "</b></td><td>";
                            echo "<form action='changeStatusArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><input name='status_id' value='2' hidden><button class=\"btn btn-outline-success\" type='submit' name='submit'>Patvirtinti</button></form>"
                . "</td><td>" . "<form action='changeStatusArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><input name='status_id' value='3' hidden><button class=\"btn btn-outline-warning\" type='submit' name='submit'>Prašyti pataisymų</button></form>"
                . "</td><td>" . "<form action='changeStatusArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><input name='status_id' value='4' hidden><button class=\"btn btn-outline-danger\" type='submit' name='submit'>Atmesti</button></form>";
                            echo "</td></tr>";
                        }
            echo "</tbody></table>"; // start a table tag in the HTML
    mysqli_close($db);
?>
              </td></tr>
    </table><br>		
    </div><br></table>
</body>
</html>