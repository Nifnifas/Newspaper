<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole
//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
//{ header("Location:articles.php");exit;}
include("include/nustatymai.php");
include("include/functions.php");


$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$query = "SELECT article_id, category_name, title, text, username, time_stamp "
            . "FROM " . TBL_ARTICLES . ", " . TBL_USERS . ", " . TBL_CATEGORIES . " WHERE fk_user_id = userid AND category = category_id ORDER BY article_id ASC";
	$result = mysqli_query($db, $query);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę `articles`"; exit;}
?>


<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Straipsniai</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
        [<a href="newarticle.php">Naujas straipsnis</a>]
      </td></tr>
	</table><br>
<?php

    echo "<table>"; // start a table tag in the HTML
    echo "<tr><td> </td><td>Name</td><td>So</td><td>kaip</td><td>va</td></tr>";
    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['article_id'] . "</td><td>" . $row['category_name'] . "</td><td>" .$row['title'] . "</td><td>" .shorterText($row['text'], 7) 
                . "</td><td>" . "<a href='read.php?$row[article_id]'>Skaityti straipsnį</a>" . "</td><td>" .$row['username'] . "</td><td>" .$row['time_stamp'] 
                . "</td><td>" . "<a href='editArticle.php?$row[article_id]'>Redaguoti</a>" . "</td><td>" . "<a onclick=\"return confirm('Ar tikrai norite ištrinti?');\" href=\"procArticleDelete.php?$row[article_id]\">Šalinti</a>" . "</td></tr>";  //$row['index'] the index here is a field name
    }
    echo "</table>"; //Close the table in HTML

    mysqli_close($db);
?>
			
			
        </div><br>
</body>
</html>