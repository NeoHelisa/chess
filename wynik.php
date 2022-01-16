<?php
$z1 = mysqli_query($con, 'select * from gracze order by nazwisko');
// [0] - id, [1] - imie, [2] - nazwisko, [3] - klasa, [4] - litera, [5] - rank,
$id = 0;
$id1 = 0;
$id2 = 0;
$wynik = 1;
$data = date('Y-m-d');

if(isset($_GET['co'])){
    if($_GET['co'] == "u")
    {
        $z2 = mysqli_query($con, 'delete from wyniki
        where main_id = '.$_GET['id']);
    }
    if($_GET['co'] == "p")
    {
        
        $z3 = mysqli_query($con, 'select * from wyniki where main_id='.$_GET['id']);
        $r = mysqli_fetch_assoc($z3);
        $id = $r['main_id'];
        $id1 = $r['id1'];
        $id2 = $r['id2'];
        $wynik = $r['wynik'];
        $data  = $r['data'];
        
    }
}

if(isset($_POST['id1']))
    {   
        $id = $_POST['id'];
        $id1 = $_POST['id1'];
        $id2 = $_POST['id2'];
        $wynik = $_POST['wynik'];
        $data  = $_POST['data'];
        if($id == 0)
        {
            $z1 = mysqli_query($con, 'insert into wyniki (id1, id2, wynik, data) values ("'.$id1.'","'.$id2.'", '.$wynik.', "'.$data.'")');
        }
        else {
            $z1 = mysqli_query($con, 'update wyniki set id1 ="'.$id1.'",id2 = "'.$id2.'", wynik = '.$wynik.', data = "'.$data.'" where main_id='.$id);
            
            $id = 0;
            $id1 = 0;
            $id2 = 0;
            $wynik = 1;
            $data = date('Y-m-d');
            }
    }

if(isset($_POST['id1']))  
{
        
        if($_POST['id2']==0){
            if($_POST['wynik'] == 0) 
                {
                    $q1 = mysqli_query($con, 'select max(rank)+1 as maxr from gracze');
                    $r = mysqli_fetch_row($q1);  
                    $q2 = mysqli_query($con, 'update gracze set rank = '.$r['maxr'].' where id ='.$_POST['id1']);
                }
            else
                {
                    $q1 = mysqli_query($con, 'update gracze set rank = rank + 1 where rank >='.$_POST['wynik']);
                    $q2 = mysqli_query($con, 'update gracze set rank = '.$_POST['wynik'].' where id ='.$_POST['id1']);
                }
        }        
        else
        {
           if($_POST['wynik'] == 1)
            { 
            $q1 = mysqli_query($con, 'update gracze set rank = rank + 1 where id = '.$_POST['id1']);
            $q2 = mysqli_query($con, 'update gracze set rank = rank - 1 where id = '.$_POST['id2']);
            }
        }   
        $q1 = mysqli_query($con, "insert into wyniki(id1, id2, wynik, data) values ('".$_POST['id1']."', '".$_POST['id2']."', '".$_POST['wynik']."', '".$_POST['data']."')");
}
    

      
            
else {      
    echo '<center> <h1> Wyniki </h1><br/>
            <form method="POST" action="index.php?c=3&h=1">
            <input type="hidden" name="id" value='.$id.'>
                <select name="id1">
                    <option> Gracz1 </option>';

        while($r = mysqli_fetch_row($z1))
        {   
            if($r[0] == $id1)
            echo "<option value='".$r[0]."' selected> ".$r[1]." ".$r[2]." </option>";
            else
            echo "<option value='".$r[0]."'> ".$r[1]." ".$r[2]."</option>";
        }
            echo '</select>

           
                <select name="id2">
                    <option value="0"> Gracz2 </option>';
                    
            mysqli_data_seek($z1, 0);
        while($r = mysqli_fetch_array($z1))
        {
            if($r[0] == $id2)
            echo "<option value='".$r[0]."' selected> ".$r[1]." ".$r[2]." </option>";
            else
            echo "<option value='".$r[0]."'> ".$r[1]." ".$r[2]."</option>";
        }
            echo '</select>';
        echo '&nbsp &nbsp';
            echo '<input type="number" name="wynik" value="'.$wynik.'" style="width:60px">
            <input type="date" name="data" value="'.$data.'">
            <br/><br/>
                <input type="submit" value="Ustaw">
                </form></center>';

          
        
            $z10 = mysqli_query($con, 'select wyniki.main_id, wyniki.id1, gracze.nazwisko as nazw1, wyniki.id2, t.nazw2, wyniki.wynik, wyniki.data 
            from wyniki, gracze, (select wyniki.main_id, wyniki.id2, gracze.nazwisko as nazw2
            from wyniki, gracze
            where wyniki.id2 = gracze.id) t
            where wyniki.id1 = gracze.id AND t.main_id = wyniki.main_id group by wyniki.main_id order by data desc');
            
            
            echo "<table class='tab' style='margin-right: auto; margin-left:auto;'> <tr> <th>Gracz 1</th> <th>Gracz 2</th> <th>Wynik</th> <th>Data</th><th></th><th></th><tr>";
            while ($r = mysqli_fetch_array($z10))
            {
                echo "<tr>
                <td>".$r['nazw1'].'</td>
                <td>'.$r['nazw2'].'</td>
                <td>'.$r['wynik'].'</td>
                <td>'.$r['data']."</td>
                <td><a href='index.php?c=3&co=p&id=".$r['main_id']."&h=1'> &nbsp &nbsp Popraw &nbsp </a></td>
                <td><a href='index.php?c=3&co=u&id=".$r['main_id']."&h=1'> &nbsp Usuń &nbsp </a></td>
                </tr>";
        
           }
            echo "</table>";  
        }

