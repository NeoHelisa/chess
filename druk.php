<?php
$con = mysqli_connect('localhost',$u_szachy, $h_szachy ,$b_szachy);
$q = mysqli_query($con, 'select * from gracze order by rank');
echo '
<h1>KLUB SZACHOWY </h1><h2>Lista rankingowa 15min + 10s</h2>
<br><table class="tab">';
while($r = mysqli_fetch_assoc($q))
{
     echo "<tr>
             <td>".$r['rank'].". </td>
             <td>".$r['imie']." ".$r['nazwisko']."</td>
             <td>".$r['klasa'].$r['litera']."</td>
         </tr>";
}
echo '</table><br/><br/>';