<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole
//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
//{ header("Location:articles.php");exit;}
include("include/nustatymai.php");
include("include/functions.php");
$user=$_SESSION['user'];
$userid =$_SESSION['userid'];

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$query = "SELECT article_id, category_name, fk_user_id, title, time_stamp, statusas_name "
            . "FROM " . TBL_ARTICLES . ", " . TBL_USERS . ", " . TBL_CATEGORIES . ", " . TBL_STATUS . " WHERE fk_user_id = userid AND category = category_id AND statusas = status_id"
                . " ORDER BY statusas_name ASC";
	$result = mysqli_query($db, $query);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Straipsnių nėra!";  
                            echo "<table style=\"border-width: 2px; border-style: dotted;\"><tr><td>
         Atgal į [<a href=\"index.php\">Pradžia</a>]</td></tr>
	</table><br>";exit;}
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Demo projektas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><img src="include/top.png"></center>
        </td></tr><tr><td> 

    <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
        [<a href="newarticle.php">Naujas straipsnis</a>]
      </td></tr>
	</table><br>
<?php
    $count = 0;
    echo "<table>"; // start a table tag in the HTML
    echo "<tr><td>Antraštė</td><td>Kategorija</td><td>Data</td><td>Būsena</td></tr>";
    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        if($userid == $row['fk_user_id']){
            echo "<tr><td>" . $row['title'] . "</td><td>" .$row['category_name']
                . "</td><td>" .$row['time_stamp'] . "</td><td>" .$row['statusas_name']
                . "</td><td>" . "<form action='read.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button type='submit' name='submit'>Skaityti straipsnį</button></form>" 
                . "</td><td>" . "<form action='editArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button type='submit' name='submit'>Redaguoti</button></form>" 
                . "</td><td>" . "<form action=\"procArticleDelete.php\" method=\"post\" onsubmit=\"return confirm('Ar tikrai norite ištrinti šį straipsnį?');\"><input type=\"submit\" value =\"Šalinti\"/><input type=\"hidden\" name=\"article_id\" value=\"$row[article_id]\">"
                . "</form></td></tr>";
            $count++;
        }
    }
    echo "</table>";
    mysqli_close($db);
    
    if($count == 0){
        echo "<b>Jūs dar neturite savo sukurtų straipsnių!</b>";exit;
    }
?>
			
			
    </div><br></table>
</body>
</html>