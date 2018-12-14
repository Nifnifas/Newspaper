<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}
include("include/nustatymai.php");


?>


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

    <table style="border-width: 2px; border-style: dotted;"><tr><td>
         Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr>
	</table><br>
        
<div align="center">
                                        <table> <tr><td>
                                                    <form action="procnewarticle.php" method="POST" class="newarticle">              
                                                <center style="font-size:18pt;"><b>Naujas straipsnis</b></center>
										
								<p style="text-align:left;">Kategorija:<br>
                                                                <input class ="s1" name="category" type="text" value=""><br>
        							</p>
                                                                
                                                                <p style="text-align:left;">Antraste<br>
                                                                    <input class ="s1" name="title" type="text" value=""><br>
                                                                </p>  
                                    
                                                                <p style="text-align:left;">Tekstas:<br>
          							<input class ="s1" name="text" type="text" value=""><br>
        							</p> 
                                                                
								
                      	
                                    <p style="text-align:left;">
                                    <input type="submit" value="Talpinti">
                                    </p>
                                    </form>
                                    </td></tr>
			                    </table>
			
			
</div><br></table>
</body>
</html>