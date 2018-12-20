<html>
    <head>
        <title>IS Zurnalo redakcija</title>
    </head>
    <body>
        
    </body>
</html>
<?php
// procadmindb.php   admino nurodytus pakeitimus padaro DB
// $_SESSION['ka_keisti'] kuriuos vartotojus, $_SESSION['pakeitimai'] į kokį userlevel
	
session_start();
// cia sesijos kontrole: tik is procadmin
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "procadmin"))
{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");
$_SESSION['prev'] = "procadmindb";

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$i=0;$levels=$_SESSION['pakeitimai'];
foreach ($_SESSION['ka_keisti'] as $user)
  {$level=$levels[$i++];
   if ($level == -1) {
    $uql = "SELECT * FROM " . TBL_USERS . " WHERE username= '$user'";
    $result = mysqli_query($db, $uql);
    $row = mysqli_fetch_array($result);
    $sistema = "sistema";
    $mql = "UPDATE " . TBL_ARTICLES . " SET fk_user_id='$sistema' WHERE fk_user_id= '$row[userid]'";
    if(!mysqli_query($db, $mql)){
        echo "Klaida 1.";
    }
    else{
        
        $cql = "UPDATE " . TBL_COMMENTS . " SET sender_id='$sistema' WHERE sender_id= '$row[userid]'";
        if(!mysqli_query($db, $cql)){
        echo "Klaida 2.";
        }
    else{
        $sql = "DELETE FROM ". TBL_USERS. "  WHERE  username='$user'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida šalinant vartotoją: " . $sql . "<br>" . mysqli_error($db);
		               exit;}
        
    }}}
    else {
            $sql = "UPDATE ". TBL_USERS." SET userlevel='$level' WHERE  username='$user'";
				         if (!mysqli_query($db, $sql)) {
                   echo " DB klaida keičiant vartotojo įgaliojimus: " . $sql . "<br>" . mysqli_error($db);
		               exit;}
   }
  }
echo "<br><br><br><h3>Pakeitimai atlikti sėkmingai!</h3>";
header( "refresh:2;url=admin.php");

?>