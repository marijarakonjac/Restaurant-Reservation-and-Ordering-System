<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="stil.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row header">
                <h1>Dobrodosli na veb sistem Kutak dobre hrane</h1> <br/>
            </div>
            <div class="row">
                <div class="menu col-12">
                    <a href="gost_profil.php">
                        Profil  |
                    </a>
                    <a href="gost_restorani.php">
                          Restorani  |
                    </a>
                    <a href="gost_rezervacije.php">
                          Rezervacije  |
                    </a>
                    <a href="gost_dostava.php">
                          Dostava hrane
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="side col-2"></div>
                <div class="body col-8 full-height"> 
                    <form method="get" action="index.php">
                        <input class="btn btn-light btn-sm" type="submit" name="izloguj" value="Izloguj se">
                    </form>
                    <br>
                    <h3>Aktuelne dostave</h3>
                    
                    <table>
                        <tr>
                            <th>Naziv restorana</th>
                            <th>Status narudzbine</th>
                            <th>Procenjeno vreme dostave</th>
                        </tr>
                        <?php
                        date_default_timezone_set('Europe/Belgrade'); 
                        $gost=$_COOKIE['ulogovan'];
                        require 'dbconnection.php';
                        
                        $result= mysqli_query($con, "select n.id, r.naziv, n.status, n.procenjeno_vreme from narudzbine n join restorani r on n.id_restorana=r.id where n.gost='$gost' and n.datum_i_vreme > NOW()");
                        if(mysqli_num_rows($result)>0){
                            while($row= mysqli_fetch_assoc($result)){
                                ?>
                        <tr>
                            <td><?php echo $row['naziv'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td><?php echo $row['procenjeno_vreme'] ?></td>
                        </tr>
                        <?php
                            }
                        }
                        
                        mysqli_close($con);
                        ?>
                    </table>
                    
                    <h3>Arhiva dostava</h3>
                    <table>
                        <tr>
                            <th>Naziv restorana</th>
                            <th>Iznos racuna</th>
                            <th>Datum dostave</th>
                        </tr>
                        <?php
                        $gost=$_COOKIE['ulogovan'];
                        require 'dbconnection.php';
                        
                        $result= mysqli_query($con, "select n.id, r.naziv, n.status, n.datum_i_vreme, n.iznos from narudzbine n join restorani r on n.id_restorana=r.id where n.gost='$gost' and n.status='potvrdjeno' order by n.datum_i_vreme desc");
                        if(mysqli_num_rows($result)>0){
                            while($row= mysqli_fetch_assoc($result)){
                                ?>
                        <tr>
                            <td><?php echo $row['naziv'] ?></td>
                            <td><?php echo $row['iznos'] ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row['datum_i_vreme'])); ?></td>
                        </tr>
                        <?php
                            }
                        }
                        
                        mysqli_close($con);
                        ?>
                    </table>
                    
                </div>
                <div class="side col-2"></div>
            </div>
            <div class="row footer">
                <p>&copy; 2024 Kutak dobre hrane. </p>
            </div>
        </div>
    </body>
</html>
