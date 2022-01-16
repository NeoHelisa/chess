<?php 

$z1 = mysqli_query($con, 'select * from gracze order by rank');

echo "<h1>Ranking 3min + 2s</h1>";
echo "<table class='tab' style='margin-right: auto; margin-left:auto;''>
<th>Ranking</th>
<th>Imie</th>
<th>Nazwisko</th>
<th>Klasa</th>";
while($r = mysqli_fetch_assoc($z1))
{
    echo "<tr>
    <td>".$r['blitz'].'</td>
    <td>'.$r['imie'].'</td>
    <td>'.$r['nazwisko'].'</td>
    <td>'.$r['klasa'].$r['litera']."</td>
    </tr>";
};
echo "</table>";