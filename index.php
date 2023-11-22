<style>

    div 
    {
        background-color: lightblue             ;
        border          : solid 2px #888        ;
    }
    
    table, th, td {
        border: 2px solid black;
        border-collapse: collapse;
    }   

    table td 
    {
        background-color: lightblue;
    }

    table tr 
    {
        text-align: center;
        background-color:aqua;
    }


</style>

<?php

    $server = "localhost";
    $user = "root";
    $dbpw = "12345678";
    $db = "felhasznalok";

    $adb = mysqli_connect($server, $user, $dbpw, $db);
        
    $sql =      "
                SELECT * 
                FROM user
                ";

    $tabla = mysqli_query($adb, $sql);
    
    print "<table border=2>";

    print   "   <tr>
                    <th>uid</th>
                    <th>unev</th>
                    <th>upw</th>
                    <th>uirszam</th>
                    <th>udatum</th>
                    <th>ustatusz</th>
                    <th>umail</th>
                    <th>login</th>
                </tr>
            ";

    while($ciklus1 = mysqli_fetch_array($tabla))
    {
        $belepesek = mysqli_query($adb, "
                        SELECT * 
                        FROM login
                        WHERE luid = '$ciklus1[uid]'");

        $osszes_belepesek = "";
        while($ciklus2 = mysqli_fetch_array($belepesek))
        {
            $osszes_belepesek .= "$ciklus2[lbe]<br>";
        }
        print "
                <tr>
                    <td>$ciklus1[uid]</td>
                    <td>$ciklus1[unev]</td>
                    <td>$ciklus1[upw]</td>
                    <td>$ciklus1[uirszam]</td>
                    <td>$ciklus1[udatum]</td>
                    <td>\"$ciklus1[ustatusz]\"</td>
                    <td>$ciklus1[umail]</td>
                    <td>$osszes_belepesek</td>
                </tr>
            ";
    }

    
    print "</table>";

    mysqli_close( $adb );
?>
