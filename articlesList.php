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
                
    <?php
        // operacija1.php
        // skirtapakeisti savo sudaryta operacija pratybose

        session_start();
        // cia sesijos kontrole
        //if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
        //{ header("Location:articles.php");exit;}
        //include("include/nustatymai.php");
        include("include/functions.php");
        include("include/meniu.php");
        $user=$_SESSION['user'];
        $userid = $_SESSION['userid'];
        $userlevel=$_SESSION['ulevel'];
        $_SESSION['prev'] = "articlesList.php";


        $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                $query = "SELECT article_id, category_name, title, text, username, time_stamp, statusas, views "
                    . "FROM " . TBL_ARTICLES . ", " . TBL_USERS . ", " . TBL_CATEGORIES . " WHERE fk_user_id = userid AND category = category_id AND statusas = 2"
                        . " ORDER BY article_id ASC";
                $result = mysqli_query($db, $query);
                if (!$result || (mysqli_num_rows($result) < 1))  
                                {echo "<table class=\"center\" style=\"border-color: white;\"><br><br><tr><td>Straipsnių nėra!</td></tr></table><br>";exit;}
?>
    <table class="center" style="border-color: white;"><br><br><tr><td>
    <?php
        $cc = 1;
        if($userlevel == $user_roles[ADMIN_LEVEL]){
            echo "<table>"; // start a table tag in the HTML
            echo "<tr><td>Nr.</td><td>Antraštė</td><td>Autorius</td><td>Data</td><td>Peržiūros</td></tr>";
            while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
            echo "<tr><td>" . $cc++ . "</td><td>" .$row['title']
                    . "</td><td>" .$row['username'] . "</td><td>" .$row['time_stamp'] . "</td><td><center>" .$row['views'] . "</center></td><td>";
            echo "<form action='read.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button type='submit' name='submit'>Skaityti straipsnį</button></form></td><td>";
                echo "<form action='editArticle.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button type='submit' name='submit'>Redaguoti</button></form>"
                             ."</td><td>" . "<form action=\"procArticleDelete.php\" method=\"post\" onsubmit=\"return confirm('Ar tikrai norite ištrinti šį straipsnį?');\"><input type=\"submit\" value =\"Šalinti\"/><input type=\"hidden\" name=\"article_id\" value=\"$row[article_id]\">";
                echo "</form></td></tr>";
            }
                    echo "</table>"; //Close the table in HTML
        }
        else if ($user == "guest") {
            echo "<table>"; // start a table tag in the HTML
            echo "<tr><td>Nr.</td><td>Antraštė</td></tr>";

            while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                echo "<tr><td>" . $cc++ . "</td><td>" . $row['title'] . "</td><td>";
                echo "<form action='readGuest.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button type='submit' name='submit'>Skaityti santrumpą</button></form></td></tr>";
            }
            echo "</table>"; //Close the table in HTML
        }
        else{
            echo "<table>"; // start a table tag in the HTML
            echo "<tr><td>Nr.</td><td>Antraštė</td><td>Autorius</td><td>Data</td></tr>";

            while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                echo "<tr><td>" . $cc++ . "</td><td>" .$row['title'] 
                    . "</td><td>" .$row['username'] . "</td><td>" .$row['time_stamp'] . "</td><td>";
                echo "<form action='read.php' method='POST'><input name='article_id' value='$row[article_id]' hidden><button type='submit' name='submit'>Skaityti straipsnį</button></form></td></tr>";
            }
            echo "</table>"; //Close the table in HTML
        }
        mysqli_close($db);
?>
			
    </td></tr>
    </table><br>		
    </div><br></table>
</body>
</html>