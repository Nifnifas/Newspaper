<html>
    <head>
        <title>Straipsnio įkėlimas</title>
    </head>
    <body>
        
        <table class="center"><tr><td><img src="include/topB.png"></td></tr><tr><td><br>
                                
<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole


include("include/meniu.php");
?>
  <br><br><table class="center" style="border-width: 2px;"><tr><td>                              
                                <div class="container">
                                    <h1 class="form-heading">Straipsnio įkėlimas</h1>
                                        <div class="login-form">
                                            <div class="main-div">
                                                <div class="panel">
                                                    <p>Užpildykite visus laukus</p>
                                                </div>
                                                <form action="procnewarticle.php" method="POST"> 
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            
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
                                                        <input type="text" name="title" class="form-control" placeholder="Antraštė" required=""/>
                                                    </div>
                                                    <div class="form-group">
                                                       <?php include("include/summerNote.php");?>
                                                    </div>
                                                    <center><button type="submit" name="submit" class="btn btn-primary">Įkelti</button></center>
                                                </form>                       
                                            </div>
                                        </div>          
                                </div>
                        </td></tr>
                </table><br><br>
        </body>
</html>
<script>
$('#btn-id').click(function(e){
    e.stopPropagation()
});
</script>