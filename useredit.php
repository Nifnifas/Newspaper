<html>
        <head> 
            <title>Keisti duomenis</title>
        </head>
        <body>   
            <table class="center"><tr><td> <img src="include/topB.png"> </td></tr><tr><td> 
                <?php 
                // useredit.php 
                // vartotojas gali pasikeisti slaptažodį ar email
                // formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos

                session_start();
                // sesijos kontrole
                include("include/meniu.php");
                if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] < $user_roles[DEFAULT_LEVEL]))   { header("Location: logout.php");exit;}
                if ($_SESSION['prev'] == "index")								  
                        {$_SESSION['mail_login'] = $_SESSION['umail'];
                        $_SESSION['passn_login'] = ""; }  //visos kitos turetų būti tuščios
                $_SESSION['prev'] = "useredit"; 
                ?>

 
                        
                        
                        <br><br><table class="center" style="border-width: 2px;"><tr><td>
                                
                                <div class="container">
                                    <h1 class="form-heading">Paskyros redagavimas</h1>
                                        <div class="login-form">
                                            <div class="main-div">
                                                <br>
                                                <form action="procuseredit.php" method="POST"> 
                                                    <div class="form-group">
                                                        <input type="password" name="oldpass" class="form-control" placeholder="Dabartinis slaptažodis"/>
                                                        <?php echo $_SESSION['pass_error']; ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="passn" class="form-control" placeholder="Naujas slaptažodis"/>
                                                        <?php echo $_SESSION['pass_error']; ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="form-control" id="inputPassword" placeholder="El. paštas" value="<?php echo $_SESSION['mail_login']; ?>"/>
                                                        <?php echo $_SESSION['mail_error']; ?>
                                                    </div>
                                                    <center><button type="submit" name="userEdit" class="btn btn-primary">Keisti duomenis</button><center> 
                                                    </div>
                                                </form>
                                            </div>
                                        </div>          
                                </td></tr>
                </table><br><br>          
  </td></tr>
  </table>           
 </body>
</html>
	


