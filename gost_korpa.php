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

                    <table>
                        <tr>
                            <th>Naziv jela</th>
                            <th>Kolicina</th>
                            <th>Cena</th>
                            <th>Sastojci</th>
                            <th>Slika</th>
                        </tr>
                        <?php
                        $id_restorana=$_COOKIE['id_restorana'];
                        $gost=$_COOKIE['ulogovan'];
                        
                        require 'dbconnection.php';
                        $result= mysqli_query($con, "select k.id, k.id_jela, j.naziv, k.kolicina, j.cena, j.sastojci, j.slika from korpa k join jela j on k.id_jela=j.id where j.id_restorana='$id_restorana' and k.gost='$gost'");
                        if(mysqli_num_rows($result)>0){
                            $ukupan_iznos =0;
                            while($row= mysqli_fetch_assoc($result)){
                                $ukupan_iznos+=$row['cena']*$row['kolicina'];
                                ?>
                        <tr>
                            <form method="post" action="">
                                <td><?php echo $row['naziv'] ?></td>
                                <td><?php echo $row['kolicina'] ?></td>
                                <td><?php echo $row['cena'] ?></td>
                                <td><?php echo $row['sastojci'] ?></td>
                                <td><img src="<?php echo htmlspecialchars($row['slika']); ?>" alt="Slika" style="width: 100px; height: auto;"></td>
                                <td><input class="btn btn-light btn-sm" type="submit" name="ukloni" value="Ukloni"></td>
                                <input type="hidden" name="id_korpe" value="<?php echo $row['id']; ?>">
                            </form>
                        </tr>
                        <?php
                            }
                            ?>
                        <tr>
                            <td colspan="3" style="text-align: right;"><strong>Ukupan iznos:</strong></td>
                            <td><strong><?php echo $ukupan_iznos; ?></strong></td>
                        </tr>
                        <?php
                        }else {
                            echo "<tr><td colspan='7'>Korpa je prazna.</td></tr>";
                        }
                        mysqli_close($con);
                        ?>
                    </table>
                    <br>
                    <form method="get" action="">
                        <input class="btn btn-light btn-sm" type="submit" name="zavrsi" value="Zavrsi narudzbinu">
                    </form>
                    <br>
                    <a href="gost_jelovnik.php">
                        <input class="btn btn-light btn-sm" type="button" name="nazad" value="Nazad na jelovnik">
                    </a>
                    
                    <?php
                    if(isset($_POST['ukloni'])){
                        require 'dbconnection.php';
                        
                        $id_korpe=$_POST['id_korpe'];
                        mysqli_query($con, "delete from korpa where id='$id_korpe'");
                        
                        mysqli_close($con);
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                    
                    if(isset($_GET['zavrsi'])){
                        $id_restorana=$_COOKIE['id_restorana'];
                        $gost=$_COOKIE['ulogovan'];
                        require 'dbconnection.php';
                        date_default_timezone_set('Europe/Belgrade'); 
                        
                        $result = mysqli_query($con, "select k.id, k.id_jela, j.cena, k.kolicina from korpa k join jela j on k.id_jela = j.id where j.id_restorana = '$id_restorana' and k.gost = '$gost'");
                        if(mysqli_num_rows($result)>0){
                            $ukupan_iznos = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $ukupan_iznos += $row['cena'] * $row['kolicina'];
                            }

                            mysqli_query($con, "insert into narudzbine (id_restorana, gost, datum_i_vreme, status, iznos) values ('$id_restorana', '$gost', NOW(),'cekanje', '$ukupan_iznos')");
                            $id_narudzbine = mysqli_insert_id($con);

                            $result = mysqli_query($con, "select k.id, k.id_jela, j.naziv, k.kolicina, j.cena, j.sastojci, j.slika from korpa k join jela j on k.id_jela=j.id where j.id_restorana='$id_restorana' and k.gost='$gost'"); 
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id_jela = $row['id_jela'];
                                $kolicina = $row['kolicina'];
                                mysqli_query($con, "insert into stavke_narudzbine (id_narudzbine, id_jela, kolicina) values ('$id_narudzbine','$id_jela','$kolicina')");
                            }

                            mysqli_query($con, "delete from korpa where gost='$gost'");
                        }else{
                            echo "<span style='color:red'>Korpa je prazna!</span>";
                        }
                        mysqli_close($con);
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
