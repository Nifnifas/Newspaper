<?php
//nustatymai.php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "newspaper");
define("TBL_USERS", "users");
define("TBL_ARTICLES", "articles");
define("TBL_CATEGORIES", "categories");
define("TBL_COMMENTS", "comments");
define("TBL_STATUS", "status");

$user_roles=array(      // vartotojų rolių vardai lentelėse ir  atitinkamos userlevel reikšmės
	"Redaktorius"=>"9",
	"Skaitytojas"=>"5",
	"Skaitytojas*"=>"4");   // galioja ir vartotojas "guest", kuris neturi userlevel
define("DEFAULT_LEVEL","Skaitytojas");  // kokia rolė priskiriama kai registruojasi
define("ADMIN_LEVEL","Redaktorius");  // kas turi vartotojų valdymo teisę
define("UZBLOKUOTAS","255");      // vartotojas negali prisijungti kol administratorius nepakeis rolės

$uregister="both";  // kaip registruojami vartotojai
// self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai

// * Email Constants - 
define("EMAIL_FROM_NAME", "Demo");
define("EMAIL_FROM_ADDR", "demo@ktu.lt");
define("EMAIL_WELCOME", false);

?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body></body>
</html>