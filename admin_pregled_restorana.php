<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>        <link rel="stylesheet" type="text/css" href="stil.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row header">
                <h1>Dobrodosli na veb sistem Kutak dobre hrane</h1> <br/>
            </div>
            <div class="row">
                <div class="menu col-12">
                    <a href="admin_pregled_gosta.php">
                        Pregled gostiju  |
                    </a>
                    <a href="admin_pregled_konobara.php">
                          Pregled konobara  |
                    </a>
                    <a href="admin_pregled_restorana.php">
                          Pregled restorana
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="side col-2"></div>
                <div class="body col-8 full-height"> 
                    <form method="get" action="index.php">
                        <input class="btn btn-light btn-sm" type="submit" name="izloguj" value="Izloguj se">
                    </form>
                    <h3>Lista restorana</h3>
                    <table>
                        <tr>
                            <th>Naziv</th>
                            <th>Adresa</th>
                            <th>Tip</th>
                            <th>Telefon</th>
                            <th>Ocena</th>
                            <th>Kontakt osoba</th>
                            <th>Opis</th>
                            <th>Otvaranje</th>
                            <th>Zatvaranje</th>
                        </tr>
                        <?php
                        require 'dbconnection.php';
                        
                        $result= mysqli_query($con, "select * from restorani");
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){
                                ?>
                        <tr>
                            <td><?php echo $row['naziv'] ?></td>
                            <td><?php echo $row['adresa'] ?></td>
                            <td><?php echo $row['tip'] ?></td>
                            <td><?php echo $row['telefon'] ?></td>
                            <td><?php echo $row['ocena'] ?></td>
                            <td><?php echo $row['kontakt_osoba'] ?></td>
                            <td><?php echo $row['opis'] ?></td>
                            <td><?php echo $row['otvaranje'] ?></td>
                            <td><?php echo $row['zatvaranje'] ?></td>
                        </tr>
                        <?php
                            }
                        }
                        
                        mysqli_close($con);
                        ?>
                    </table>
                    <a href="admin_dodavanje_restorana.php">
                        <input type="button" class="btn btn-light btn-sm" value="Dodaj novi restoran">
                    </a>
                    
                </div>
                <div class="side col-2"></div>
            </div>
            <div class="row footer">
                <p>&copy; 2024 Kutak dobre hrane. </p>
            </div>
        </div>
    </body>
</html>
