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
                    <h3>Neobradjene rezervacije</h3>
                    <table>
                        <tr>
                            <th>Gost</th>
                            <th>Broj osoba</th>
                            <th>Datum i vreme</th>
                            <th>Dodatni zahtev</th>
                        </tr>
                        <?php
                        require 'dbconnection.php';
                        $konobar=$_COOKIE['ulogovan'];

                        $result= mysqli_query($con, "select id_restorana from konobari where kor_ime='$konobar'");
                        $row= mysqli_fetch_assoc($result);
                        $id_restorana=$row['id_restorana'];

                        $result2= mysqli_query($con, "select * from rezervacije where id_restorana='$id_restorana' and status='cekanje' order by datum_i_vreme asc");
                        if(mysqli_num_rows($result2)>0){
                            while($row2= mysqli_fetch_assoc($result2)){
                                ?>
                        <tr>
                            <td><?php echo $row2['gost'] ?></td>
                            <td><?php echo $row2['broj_osoba'] ?></td>
                            <td><?php echo $row2['datum_i_vreme'] ?></td>
                            <td><?php echo $row2['dodatni_zahtev'] ?></td>
                            <form method="post" action="">
                                <td><input class="btn btn-light btn-sm" type="submit" name="potvrdi" value="Potvrdi"></td>
                                <td><input class="btn btn-light btn-sm" type="submit" name="odbij" value="Odbij"></td>
                                <input type="hidden" name="id_rezervacije" value="<?php echo $row2['id']; ?>">
                                <td><textarea name="komentar" rows="2" cols="30" placeholder="Unesite komentar za odbijanje"></textarea></td>
                            </form>
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
                        $id_rezervacije=$_POST['id_rezervacije'];
                        $konobar=$_COOKIE['ulogovan'];
                        mysqli_query($con, "update rezervacije set status='potvrdjeno', konobar='$konobar' where id='$id_rezervacije'");
                        mysqli_close($con);
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                    if(isset($_POST['odbij'])){
                        require 'dbconnection.php';
                        $id_rezervacije=$_POST['id_rezervacije'];
                        $komentar=$_POST['komentar'];
                        $konobar=$_COOKIE['ulogovan'];
                        
                        if (empty($komentar)) {
                            echo "<span style='color:red'>Komentar je obavezan kada odbijate rezervaciju.</span><br>";
                        } else {
                            mysqli_query($con, "UPDATE rezervacije SET status='odbijeno', konobar='$konobar', komentar='$komentar' WHERE id='$id_rezervacije'");
                            echo "<meta http-equiv='refresh' content='0'>";
                        }
                        mysqli_close($con);
                    }
                    ?>
                    
                    
                    
                    <h3>Potvrdjene rezervacije</h3>
                    <table>
                        <tr>
                            <th>Gost</th>
                            <th>Broj osoba</th>
                            <th>Datum i vreme</th>
                            <th>Dodatni zahtev</th>
                            <th>Pojavljivanje?</th>
                            <th>Produzavanje</th>
                        </tr>
                        <?php
                        require 'dbconnection.php';
                        $konobar=$_COOKIE['ulogovan'];
                        date_default_timezone_set('Europe/Belgrade'); 

                        $result= mysqli_query($con, "select id_restorana from konobari where kor_ime='$konobar'");
                        $row= mysqli_fetch_assoc($result);
                        $id_restorana=$row['id_restorana'];
                        
                        $result2= mysqli_query($con, "select * from rezervacije where id_restorana='$id_restorana' and status='potvrdjeno'");
                        if(mysqli_num_rows($result2)>0){
                            while($row2= mysqli_fetch_assoc($result2)){
                                $datum_i_vreme = new DateTime($row2['datum_i_vreme']);
                                $trenutno = new DateTime();
                                $interval = $trenutno->diff($datum_i_vreme);
                                $minutes_diff = $interval->i + ($interval->h * 60);

                                if ($minutes_diff >= 30) {
                                    ?>
                            <tr>
                                <td><?php echo $row2['gost'] ?></td>
                                <td><?php echo $row2['broj_osoba'] ?></td>
                                <td><?php echo $row2['datum_i_vreme'] ?></td>
                                <td><?php echo $row2['dodatni_zahtev'] ?></td>
                                <form method="get" action="">
                                    <td>
                                        <?php
                                        if($row2['pojavljivanje']==''){
                                        ?>
                                        <input class="btn btn-light btn-sm" type="submit" name="da" value="Da">
                                            <input class="btn btn-light btn-sm" type="submit" name="ne" value="Ne">
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($row2['produzavanje']==0){
                                        ?>
                                        <input class="btn btn-light btn-sm" type="submit" name="produzi" value="Produzi sto">
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <input type="hidden" name="id_rezervacije" value="<?php echo $row2['id']; ?>">
                                    <input type="hidden" name="gost" value="<?php echo $row2['gost']; ?>">
                                </form>
                            </tr>
                            <?php
                                }
                            }
                        }
                        mysqli_close($con);
                        ?>
                    </table>
                    
                    <?php
                    if(isset($_GET['da'])){
                        
                        require 'dbconnection.php';
                        $id_rezervacije=$_GET['id_rezervacije'];
                        $konobar=$_COOKIE['ulogovan'];
                        
                        mysqli_query($con, "update rezervacije set pojavljivanje='da' where id='$id_rezervacije'");
                        mysqli_close($con);
                    }
                    if(isset($_GET['ne'])){
                        require 'dbconnection.php';
                        $id_rezervacije=$_GET['id_rezervacije'];
                        $konobar=$_COOKIE['ulogovan'];
                        $gost=$_GET['gost'];
                        
                        mysqli_query($con, "update gosti set nepojavljivanje=nepojavljivanje+1 where kor_ime='$gost'");
                        mysqli_query($con, "update rezervacije set pojavljivanje='ne' where id='$id_rezervacije'");
                        
                        $result= mysqli_query($con, "select * from gosti where kor_ime='$gost'");
                        $row= mysqli_fetch_assoc($result);
                        if($row['nepojavljivanje']==3){
                            mysqli_query($con, "update gosti set status='blokiran' where kor_ime='$gost'");
                        }
                        
                        mysqli_query($con, "update rezervacije set id_stola='' where id='$id_rezervacije'");
                        mysqli_close($con);
                    }
                    if(isset($_GET['produzi'])){
                        $id_rezervacije=$_GET['id_rezervacije'];
                        
                        require 'dbconnection.php';
                        
                        $result= mysqli_query($con, "select * from rezervacije where id='$id_rezervacije'");
                        $row= mysqli_fetch_assoc($result);
                        if($row['produzavanje']==1){
                            echo "<span style='color:red'>Već ste produžili ovu rezervaciju jednom tokom boravka gostiju.</span><br>";
                        }else{
                            mysqli_query($con, "update rezervacije set produzavanje=1 where id='$id_rezervacije'");
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
