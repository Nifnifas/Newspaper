<?php
// register.php registracijos forma
// jei pats registruojasi rolė = DEFAULT_LEVEL, jei registruoja ADMIN_LEVEL vartotojas, rolę parenka
// Kaip atsiranda vartotojas: nustatymuose $uregister=
//                                         self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai galimi
// formos laukus tikrins procregister.php

    session_start();
    if (empty($_SESSION['prev'])) { header("Location: logout.php");exit;} // registracija galima kai nera userio arba adminas
// kitaip kai sesija expirinasi blogai, laikykim, kad prev vistik visada nustatoma
    include("include/nustatymai.php");
    include("include/functions.php");
    if ($_SESSION['prev'] != "procregister")  inisession("part");  // pradinis bandymas registruoti

    $_SESSION['prev']="register";
?>
        <html>
        <head>  
            <title>Registracija</title>
        </head>
        <body>   
            <table class="center"><tr><td><img src="include/top.png"></td></tr><tr><td><br>
                                <table class="center" style="border-width: 2px;"><tr><td>
                                
                                <div class="container">
                                    <h1 class="form-heading">Registracijos langas</h1>
                                        <div class="login-form">
                                            <div class="main-div">
                                                <div class="panel">
                                                    <p>Įveskite vartotojo vardą ir slaptažodį</p>
                                                </div>
                                                <form action="procregister.php" method="POST"> 
                                                    <div class="form-group">
                                                        <input type="text" name="name" class="form-control" id="inputUsername" placeholder="Vartotojo vardas"/>
                                                        <?php echo $_SESSION['name_error'];?>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="form-control" id="inputPassword" placeholder="El. paštas"/>
                                                        <?php echo $_SESSION['mail_error']; ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="pass" class="form-control" id="inputPassword" placeholder="Slaptažodis"/>
                                                        <?php echo $_SESSION['pass_error']; ?>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm"><button type="submit" name="registracija" class="btn btn-primary">Registruotis</button></div>
                                                            <div class="col-sm"><input type="button" value="Pradinis puslapis" name="registracija" onclick="location.href='index.php'" class="btn btn-primary"/></div>
                                                        </div>
                                                    </div>
                                                </form>
                                                                               
                                            </div>
                                        </div>          
                                </div>
                        </td></tr>
                </table><br><br>          
        </body>
    </html>