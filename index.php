<html>
 <head>
    <meta charset="utf-8">
    <link rel="Stylesheet" href="szachy.css">
    <title>Szachy</title>
 </head>
 <body>
     <div id="container">
    <div id='lewy'>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div id="baner">
        <h1>KLUB <br/> SZACHOWY</h1>
    </div>
</a>
    <div id="lewy2">
        <br><br><br>
        <p>
        <a href="<?php echo $_SERVER['PHP_SELF']."?c=1&h=0"; ?>" >Ranking &nbsp 3min + 2s</a><br/><br/>
        
        <a href="<?php echo $_SERVER['PHP_SELF']."?c=2&h=0"; ?>">Ranking &nbsp 15min + 10s</a><br/><br/>

        <a href="<?php echo $_SERVER['PHP_SELF']."?c=4&h=0"; ?>">Gracze</a><br/><br/>

        <a href="<?php echo $_SERVER['PHP_SELF']."?c=3&h=0"; ?>">Wyniki</a><br/><br/>
        
        </p>
    </div>
    </div>
    
    <div id="prawy" style="justify-content:center; text-align:center">
     <?php
        $u_szachy = "uni_szachy";    //database username
        $b_szachy = "uni_szachy";    //database name
        $h_szachy = 'Szachy!';          //database user password
        $con = mysqli_connect('localhost',$u_szachy, $h_szachy ,$b_szachy);
        if(isset($_GET['c'])){

        switch($_GET['c'])
        {
            case 1:
                include 'blitz.php';
            break;
            case 2:
                include 'rapid.php';
            break;
            case 3:
                if($_GET['h'] == 0)
                include 'user.php';
              else
                include 'wynik.php';
            break;
            case 4:
                if($_GET['h'] == 0)
                include 'user.php';
              else
            include 'gracze.php';
            break;
        }
    } else {
        echo "<img src='szachy.jpeg' style='margin-right: auto; margin-left:auto;' alt='szachy'>";
    }
     ?>
    </div>
    </div>
 </body>
</html>