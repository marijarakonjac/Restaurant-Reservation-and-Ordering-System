<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<style>
        .star {
            color: gold;
            font-size: 24px;
        }
        
        .half {
            position: relative;
            overflow: hidden;
            border-width: 5px;
        }
        
        .half::before {
            content: '\2605';
            position: absolute;
            left: 0;
            overflow: hidden;
            width: 50%;
        }
</style>

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

function zvezdice($ocena) {
    $pune_zvezdice = floor($ocena);
    $pola_zvezdice = round($ocena - $pune_zvezdice);
    $prazne_zvezdice = 5 - $pune_zvezdice - $pola_zvezdice;

    $zvezdice = str_repeat('<span class="star">&#9733;</span>', $pune_zvezdice);
    if ($pola_zvezdice) {
        $zvezdice .= '<span class="star half">&#11240;</span>';
    }
    
    if($prazne_zvezdice){
        $zvezdice .= str_repeat('<span class="star">&#9734;</span>', $prazne_zvezdice);
    }
    
    return $zvezdice;
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
                    
                    <form method="get" action="">
                        <br>
                        <h3>Opste informacije</h3>
                        <?php
                        require 'dbconnection.php';
                        $result= mysqli_query($con, "select * from restorani");
                        ?>
                        Ukupan broj restorana:<?php echo mysqli_num_rows($result) ?>
                        <?php
                        $result= mysqli_query($con, "select * from gosti");
                        ?>
                        <br>
                        Ukupan broj gostiju:<?php echo mysqli_num_rows($result) ?>
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
                            <th>Ocena</th>
                            <th>U zvezdicama</th>
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
                                        <td><a class="restoran-link" href="gost_detalji_restorana.php?id=<?php echo $row['id']; ?>"><?php echo $row['naziv']; ?></a></td>
                                        <td><?php echo $row['adresa'] ?></td>
                                        <td><?php echo $row['tip'] ?></td>
                                        <td><?php echo $row['ocena'] ?></td>
                                        <td><?php echo zvezdice($row['ocena']) ?></td>
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
                                        <td><a class="restoran-link" href="gost_detalji_restorana.php?id=<?php echo $row['id']; ?>"><?php echo $row['naziv']; ?></a></td>
                                        <td><?php echo $row['adresa'] ?></td>
                                        <td><?php echo $row['tip'] ?></td>
                                        <td><?php echo $row['ocena'] ?></td>
                                        <td><?php echo zvezdice($row['ocena']) ?></td>
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
