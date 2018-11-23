<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}
include("include/nustatymai.php");
            
$_SESSION['art'] = $_SERVER['QUERY_STRING'];

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$query = "SELECT article_id, category, title, text "
            . "FROM " . TBL_ARTICLES . ", " . TBL_CATEGORIES . " WHERE article_id = $_SERVER[QUERY_STRING]  AND category = category_id";
	$result = mysqli_query($db, $query);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę `articles`"; exit;}
        $row = mysqli_fetch_array($result);
        mysqli_close($db);
?>


<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Straipsniai</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
	</table><br>

<div align="center">
                                        <table> <tr><td>
                                                    <form action="procArticleEdit.php" method="POST" class="editedarticle">              
                                                <center style="font-size:18pt;"><b>Redaguoti straipsnį</b></center>
                                                
                                                                <p style="text-align:left;">ID:<br>
                                                                <input class ="s1" name="id" type="text" value="<?php echo $_SERVER['QUERY_STRING']; ?>"><br>
        							</p>
								<p style="text-align:left;">Kategorija:<br>
                                                                <input class ="s1" name="category" type="text" value="<?php echo $row['category']; ?>"><br>
        							</p>
                                                                
                                                                <p style="text-align:left;">Antraste<br>
                                                                    <input class ="s1" name="title" type="text" value="<?php echo $row['title']; ?>"><br>
                                                                </p>  
                                    
                                                                <p style="text-align:left;">Tekstas:<br>
          							<input class ="s1" name="text" type="text" value="<?php echo $row['text']; ?>"><br>
        							</p> 

								
                      	
                                    <p style="text-align:left;">
                                    <input type="submit" value="Patvirtinti">
                                    </p>
                                    </form>
                                    </td></tr>
			               </table>
			
			
        </div><br>
</body>
</html>