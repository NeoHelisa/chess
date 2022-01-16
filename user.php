<?php
    if(isset($_POST['user']))
{   $u_szachy = "unimax_szachy";  
    $b_szachy = "unimax_szachy";
    $h_szachy = 'Szachy!';
    $con = mysqli_connect('localhost',$u_szachy, $h_szachy ,$b_szachy);
    
    echo $_POST['user'];
    $user = $_POST["user"];
    $s = 'select user, pass from admin where user = "'.$user.'"';
    $q1 = mysqli_query($con, $s);
    echo mysqli_num_rows($q1);
    if(mysqli_num_rows($q1)>0)
    {
       $r = mysqli_fetch_assoc($q1);
        if($_POST['pass'] != $r['pass'] || $user != $r['user'])
        {
            echo "Hasło niepoprawne!";
        }
        else
        {
            {
                header("Location: index.php?c=".$_GET['c']."&h=1");
                exit();
            }
        }
    }
}
else {
    echo "<script type='text/javascript'>alert('For testing purposes! login: admin, password: admin');</script>";
    echo "<form method='POST' action='user.php?c=".$_GET['c']."'>";
    echo "Login: <input type='text' name='user'> <br/><br/>";
    echo "Hasło: <input type='password' name='pass'> <br/><br/>
            <input type='submit' value='Zaloguj' >
    </form>";
}