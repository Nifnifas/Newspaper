<html>
    <head>
        <title>Straipsnio skaitymas</title>        
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><img src="include/top.png"></center>
        <br>
        <?php
        // operacija1.php
        // skirtapakeisti savo sudaryta operacija pratybose

        session_start();
        // cia sesijos kontrole
        include("include/meniu.php");

        $_SESSION['art'] = $_POST['article_id'];

        $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                $query = "SELECT article_id, category, title, text "
                    . "FROM " . TBL_ARTICLES . ", " . TBL_CATEGORIES . " WHERE article_id = $_SESSION[art]  AND category = category_id";
                $result = mysqli_query($db, $query);
                if (!$result || (mysqli_num_rows($result) < 1))  
                                {echo "Klaida skaitant lentelę `articles`"; exit;}
                $row = mysqli_fetch_array($result);
                mysqli_close($db);
        ?>
        
        <br><br><table class="center" style="border-width: 2px;"><tr><td>                              
                                <div class="container">
                                    <h1 class="form-heading">Straipsnio redagavimas</h1>
                                        <div class="login-form">
                                            <div class="main-div">
                                                <div class="panel">
                                                    <p>Pakeiskite norimus laukus</p>
                                                </div>
                                                <form action="procArticleEdit.php" method="POST"> 
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <input class ="s1" name="id" type="text" value="<?php echo $row['article_id']; ?>" hidden/>
                                                                <?php
                                                                    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                                                                    if (!$conn) {
                                                                        die("Connection failed: " . mysqli_connect_error());
                                                                    }
                                                                    $sql_u = "SELECT category_id, category_name FROM " . TBL_CATEGORIES;
                                                                    $res_u = mysqli_query($conn, $sql_u);
                                                                                                echo "<select class=\"custom-select\" name=\"category\">";
                                                                                                foreach($res_u as $key => $val) {
                                                                                                        $selected = "";
                                                                                                        if(isset($data['category_id']) && $data['category_id'] == $val['category_id']) {
                                                                                                                $selected = " selected='selected'";
                                                                                                        }
                                                                                                        echo "<option{$selected} value='{$val['category_id']}'>{$val['category_name']}</option>";
                                                                                                }
                                                                                                echo "</select>";
                                                                                                ?>
                                                        <div class="input-group-append">
                                                            <label class="input-group-text" for="inputGroupSelect02">Kategorijos</label>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="title" class="form-control" placeholder="Antraštė" value="<?php echo $row['title']; ?>" required=""/>
                                                    </div>
                                                    <div class="form-group">
                                                       <?php include("include/summerNote.php");?>
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-primary">Įkelti</button>
                                                </form>                       
                                            </div>
                                        </div>          
                                </div>
                        </td></tr>
                </table><br><br>
</body>
</html>