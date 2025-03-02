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
                    <a href="konobar_profil.php">
                        Profil  |
                    </a>
                    <a href="konobar_rezervacije.php">
                          Rezervacije  |
                    </a>
                    <a href="konobar_dostave.php">
                          Dostave  |
                    </a>
                    <a href="konobar_statistika.php">
                          Statistika
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

                    <h3>Narudzbine na cekanju</h3>
                    <table>
                        <tr>
                            <th>Gost</th>
                            <th>Datum i vreme</th>
                            <th>Iznos</th>
                            <th>Stavke narudzbine</th>
                        </tr>
                        <?php
                        require 'dbconnection.php';
                        $result= mysqli_query($con, "select * from narudzbine where status='cekanje'");
                        if(mysqli_num_rows($result)>0){
                            while($row= mysqli_fetch_assoc($result)){
                                ?>
                        <tr>
                            <td><?php echo $row['gost'] ?></td>
                            <td><?php echo $row['datum_i_vreme'] ?></td>
                            <td><?php echo $row['iznos'] ?></td>
                            <td>
                                <?php
                                $id_narudzbine=$row['id'];
                                $result_stavke= mysqli_query($con, "select s.kolicina, j.naziv from stavke_narudzbine s join jela j on s.id_jela=j.id where s.id_narudzbine='$id_narudzbine'");
                                if(mysqli_num_rows($result_stavke)>0){
                                    echo "<ul>";
                                    while($stavka = mysqli_fetch_assoc($result_stavke)) {
                                        echo "<li>" . $stavka['naziv'] . " (Kolicina: " . $stavka['kolicina'] . ")</li>";
                                    }
                                    echo "</ul>";
                                }
                                ?>
                            </td>
                            <td>
                                <form method="post" action="">
                                    <input class="btn btn-light btn-sm" type="submit" name="odbij" value="Odbij">
                                    <input class="btn btn-light btn-sm" type="submit" name="potvrdi" value="Potvrdi">
                                    <select name="procenjeno_vreme">
                                        <option value="20-30 minuta">20-30 minuta</option>
                                        <option value="30-40 minuta">30-40 minuta</option>
                                        <option value="50-60 minuta">50-60 minuta</option>
                                    </select>
                                    <input type="hidden" name="id_narudzbine" value="<?php echo $row['id']; ?>">
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        mysqli_close($con);
                        ?>
                    </table>
                    <?php
                    if(isset($_POST['potvrdi'])){
                        require 'dbconnection.php';
                        $id_narudzbine=$_POST['id_narudzbine'];
                        $procenjeno_vreme=$_POST['procenjeno_vreme'];
                        mysqli_query($con, "update narudzbine set status='potvrdjeno', procenjeno_vreme='$procenjeno_vreme' where id='$id_narudzbine'");
                        mysqli_close($con);
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                    if(isset($_POST['odbij'])){
                        require 'dbconnection.php';
                        $id_narudzbine=$_POST['id_narudzbine'];
                        mysqli_query($con, "update narudzbine set status='odbijeno' where id='$id_narudzbine'");
                        mysqli_close($con);
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                    ?>
                    
                </div>
                <div class="side col-2"></div>
            </div>
            <div class="row footer">
                <p>&copy; 2024 Kutak dobre hrane. </p>
            </div>
        </div>
    </body>
</html>
