<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<?php
function pretrazi_restoran($sortiranje,$kolona,$ime,$adresa,$tip){
    
    $where_sekvenca='';
    $pocetak=0;
    
    if(!empty($ime)){
        $where_sekvenca.=" naziv like '%$ime%'";
        $pocetak=1;
    }
    if(!empty($adresa)){
        if($pocetak==0){
            $where_sekvenca.=" adresa like '%$adresa%'";
        }else{
            $where_sekvenca.=" and adresa like '%$adresa%'";
        }
        $pocetak=1;
    }
    if(!empty($tip)){
        if($pocetak==0){
            $where_sekvenca.=" tip like '%$tip%'";
        }else{
            $where_sekvenca.=" and tip like '%$tip%'";
        }
        $pocetak=1;
    }
    
    if($sortiranje=='neopadajuce'){
        $redosled='ASC';
    }else{
        $redosled='DESC';
    }
    
    if($pocetak==1){
        $sekvenca = "select * from restorani where $where_sekvenca order by $kolona $redosled";
    }else{
        $sekvenca = "select * from restorani order by $kolona $redosled";
    }
    return $sekvenca;
}
?>

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
                <div class="side col-2"></div>
                <div class="body col-8 full-height">
                    <br/>            
                    <form method="post" action="">
                        Korisnicko ime: <input type-="text" name="kor_ime">
                        <br>
                        Lozinka: <input type="password" name="lozinka">
                        <br>
                        <input type="submit" class="btn btn-light btn-sm" name="prijava" value="Prijava">
                        <br>
                        Gost ste,a nemate nalog? <input class="btn btn-light btn-sm" type="submit" name="registracija" value="Registrujte se">
                        <br>
                        Zaboravili ste lozinku? <input class="btn btn-light btn-sm" type="submit" name="promeni_lozinku" value="Promenite lozinku">
                    </form>
                    
                    <?php
                    if(isset($_POST['prijava'])){
                        $kor_ime=$_POST['kor_ime'];
                        $lozinka=$_POST['lozinka'];
                        if(empty($kor_ime)||empty($lozinka)){
                            echo "<span style='color:red'>Niste uneli sva potrebna polja!</span>";
                        }else{
                            require 'login.php';
                        }
                    }
                    if(isset($_POST['registracija'])){
                        header('Location: signup_gost.php');
                    }
                    if(isset($_POST['promeni_lozinku'])){
                        header('Location: promeni_lozinku.php');
                    }
                    ?>
                    
                    
                    <form method="get" action="">
                        <br>
                        <h3>Opste informacije</h3>
                        <?php
                        date_default_timezone_set('Europe/Belgrade'); 
                        require 'dbconnection.php';
                        $result= mysqli_query($con, "select * from restorani");
                        ?>
                        Ukupan broj restorana:<?php echo mysqli_num_rows($result) ?>
                        <?php
                        $result= mysqli_query($con, "select * from gosti");
                        ?>
                        <br>
                        Ukupan broj gostiju:<?php echo mysqli_num_rows($result) ?>
                        <br>
                        Broj rezervacija u poslednjih 24h: 
                        <?php
                        require 'dbconnection.php';
                        $result= mysqli_query($con, "select * from rezervacije where datum_i_vreme >= NOW() - INTERVAL 1 DAY and datum_i_vreme<NOW()");
                        echo mysqli_num_rows($result);
                        mysqli_close($con);
                        ?>,
                        sedam dana:
                        <?php
                        require 'dbconnection.php';
                        $result= mysqli_query($con, "select * from rezervacije where datum_i_vreme >= NOW() - INTERVAL 7 DAY and datum_i_vreme<NOW()");
                        echo mysqli_num_rows($result);
                        mysqli_close($con);
                        ?>,
                        mesec dana:
                        <?php
                        require 'dbconnection.php';
                        $result= mysqli_query($con, "select * from rezervacije where datum_i_vreme >= NOW() - INTERVAL 1 MONTH and datum_i_vreme<NOW()");
                        echo mysqli_num_rows($result);
                        mysqli_close($con);
                        ?>
                        <br><br>
                        <h3>Pretrazite restorane</h3>
                        Sortiraj:
                        <select name="sortiranje">
                            <option>neopadajuce</option>
                            <option>nerastuce</option>
                        </select> 
                        po:
                        <select name="kolona">
                            <option>naziv</option>
                            <option>adresa</option>
                            <option>tip</option>
                        </select>
                        <br>
                        Pretrazi: 
                        po imenu:<input type="text" name="pretraga_ime">
                        po adresi: <input type="text" name="pretraga_adresa">
                        po tipu: <input type="text" name="pretraga_tip">
                        <br>
                        <input class="btn btn-light btn-sm" type="submit" name="pretrazi" value="Pretrazi">
                        <br>
                    </form>
                    
                    <table>
                        <tr>
                            <th>Restoran</th>
                            <th>Adresa</th>
                            <th>Tip</th>
                            <th>Konobari</th>
                        </tr>
                        <?php
                        if(isset($_GET['pretrazi'])){
                            $sekvenca = pretrazi_restoran($_GET['sortiranje'],$_GET['kolona'], $_GET['pretraga_ime'],$_GET['pretraga_adresa'],$_GET['pretraga_tip']);
                            require 'dbconnection.php';
                            $result= mysqli_query($con, $sekvenca);
                            if(mysqli_num_rows($result)>0){
                                while($row= mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['naziv'] ?></td>
                                        <td><?php echo $row['adresa'] ?></td>
                                        <td><?php echo $row['tip'] ?></td>
                                        <?php
                                        $id=$row['id'];
                                        $result2= mysqli_query($con, "select * from konobari where id_restorana='$id'");
                                        if(mysqli_num_rows($result2)>0){
                                            while($row2= mysqli_fetch_assoc($result2)){
                                                ?>
                                        <td><?php echo $row2['ime'].' '.$row2['prezime'] ?></td>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tr>
                        <?php
                                }
                            }
                            mysqli_close($con);
                        }
                        ?>
                         
                         <?php
                         if(!isset($_GET['pretrazi'])){
                            require 'dbconnection.php';
                            $result= mysqli_query($con, "select * from restorani");
                            if(mysqli_num_rows($result)>0){
                                while($row= mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['naziv'] ?></td>
                                        <td><?php echo $row['adresa'] ?></td>
                                        <td><?php echo $row['tip'] ?></td>
                                        <?php
                                        $id=$row['id'];
                                        $result2= mysqli_query($con, "select * from konobari where id_restorana='$id'");
                                        if(mysqli_num_rows($result2)>0){
                                            while($row2= mysqli_fetch_assoc($result2)){
                                                ?>
                                        <td><?php echo $row2['ime'].' '.$row2['prezime'] ?></td>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tr>
                        <?php
                                }
                            }
                            mysqli_close($con);
                         }
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
