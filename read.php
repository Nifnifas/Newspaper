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
            . "FROM " . TBL_ARTICLES . ", " . TBL_USERS . ", " . TBL_CATEGORIES . " WHERE article_id = $_SERVER[QUERY_STRING]  AND fk_user_id = userid AND category = category_id ORDER BY article_id ASC";
	$result = mysqli_query($db, $query);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę `articles`"; exit;}
?>


<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>---</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <table style="border-width: 2px; border-style: dotted;"><tr><td>
                Atgal į [<a href="articlesList.php">Straipsniai</a>]
      </td></tr>
	</table><br>
<?php

    echo "<table>"; // start a table tag in the HTML
    $row = mysqli_fetch_array($result);   //Creates a loop to loop through results
    echo "<tr><td>" . $row['category_name'] . "</td><td>" .$row['title'] . "</td><td>" .$row['username'] . "</td><td>" .$row['time_stamp'] . "</td></tr>";  //$row['index'] the index here is a field name
                   
    

    echo "</table>"; //Close the table in HTML
    echo "$row[text]";

    mysqli_close($db);
?>
			
			
        </div><br>
</body>
</html>