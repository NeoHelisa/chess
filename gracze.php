<?php

$id = 0;
$imie = "";
$nazw = "";
$klasa = 1;
$litera  = "";
if(isset($_GET['co'])){
    if($_GET['co'] == "gu")
    {
        $z2 = mysqli_query($con, 'delete from gracze
        where id = '.$_GET['id']);
    }
    if($_GET['co'] == "gp")
    {
        $z3 = mysqli_query($con, 'select * from gracze where id='.$_GET['id']);
        $r = mysqli_fetch_assoc($z3);
        $id = $r['id'];
        $imie = $r['imie'];
        $nazw = $r['nazwisko'];
        $klasa = $r['klasa'];
        $litera  = $r['litera'];
    }
}
if(isset($_POST['imie']))
    {   
        $id = $_POST['id'];
        $imie = $_POST['imie'];
        $nazw = $_POST['nazw'];
        $klasa = $_POST['klasa'];
        $litera =  $_POST['litera'];
        if($id == 0)
        {
            $z1 = mysqli_query($con, 'insert into gracze (imie, nazwisko, klasa, litera) values ("'.$imie.'","'.$nazw.'", '.$klasa.', "'.$litera.'")');
        }
        else {
            $z1 = mysqli_query($con, 'update gracze set imie ="'.$imie.'",nazwisko = "'.$nazw.'", klasa = '.$klasa.', litera = "'.$litera.'" where id='.$id);
            $id = 0;
            $imie = "";
            $nazw = "";
            $klasa = 1;
            $litera  = "";
            }
    }
    echo ' <div> <h1> Gracze </h1><br/>
    <form method="POST" action="index.php?c=4&h=1">
    <input type="hidden" name="id" value='.$id.'>
    Imie:
    <input type="text" name="imie" value='.$imie.'>
    Nazwisko: 
    <input type="text" name="nazw" value='.$nazw.'>
    Klasa:
    <input type="number" name="klasa" max="5" min="1" value='.$klasa.'>&nbsp<input type="text" name="litera" maxlength="2" pattern="[a-z]" style="width: 50px" value='.$litera.'><br/><br/>
    <input type="submit" value="Zapisz">
    </form> </div>
    ';
    $z1 = mysqli_query($con, 'select * from gracze order by nazwisko');
    echo "<table class='tab' style='margin-right: auto; margin-left:auto;'> <tr> <th>Nazwisko</th> <th>Imie</th> <th>Klasa</th></tr>";
    while($r = mysqli_fetch_assoc($z1))
    {
        echo "<tr>
        <td>".$r['nazwisko'].'</td>
        <td>'.$r['imie'].'</td>
        <td>'.$r['klasa'].$r['litera']."</td>
        <td><a href='index.php?c=4&co=gu&id=".$r['id']."&h=1'>Usuń</a></td>
        <td><a href='index.php?c=4&co=gp&id=".$r['id']."&h=1'>Popraw</a></td>
        </tr>";
    }
    echo "</table>";
