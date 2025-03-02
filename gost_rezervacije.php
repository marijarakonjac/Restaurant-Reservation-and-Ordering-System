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
        
                .star-rating {
            direction: rtl;
            display: inline-block;
            font-size: 0;
            position: relative;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 32px;
            color: gold;
            cursor: pointer;
            display: inline-block;
            margin: 0;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input[type="radio"]:checked ~ label {
            color: #ffcc00;
        }
</style>
<?php
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
                    <br>

                    <h3>Aktuelne rezervacije</h3>
                    <table>
                        <tr>
                            <th>Datum i vreme</th>
                            <th>Naziv restorana</th>
                            <th>Adresa</th>
                        </tr>
                        <?php
                        date_default_timezone_set('Europe/Belgrade'); 
                        require 'dbconnection.php';
                        $gost=$_COOKIE['ulogovan'];
                        
                        $result= mysqli_query($con, "select r.id, r.datum_i_vreme, res.naziv, res.adresa from rezervacije r join restorani res on r.id_restorana=res.id where r.gost='$gost' and r.datum_i_vreme>NOW() order by r.datum_i_vreme asc");
                        $sada=new DateTime();
                        
                        while($row= mysqli_fetch_assoc($result)){
                            $rezervacija_vreme = new DateTime($row['datum_i_vreme']);
                            $interval = $rezervacija_vreme->diff($sada);
                            $minutes_diff = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
                            ?>
                        <tr>
                            <td><?php echo $row['datum_i_vreme'] ?></td>
                            <td><?php echo $row['naziv'] ?></td>
                            <td><?php echo $row['adresa'] ?></td>
                            <td>
                                <?php
                                if($minutes_diff>=45){
                                    ?>
                                <form method="post" action="">
                                    <input class="btn btn-light btn-sm" type="submit" name="otkazi" value="Otkazi">
                                    <input type="hidden" name="id_rezervacije" value="<?php echo $row['id'] ?>">
                                </form>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        
                        <?php
                        }
                        mysqli_close($con);
                        ?>
                    </table>
                    
                    <?php
                    if(isset($_POST['otkazi'])){
                        require 'dbconnection.php';
                        $id_rezervacije=$_POST['id_rezervacije'];
                        
                        mysqli_query($con, "delete from rezervacije where id='$id_rezervacije'");
                        mysqli_close($con);
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                    ?>
                        
                        
                        <h3>Istekle rezervacije</h3>
                        <table>
                            <tr>
                                <th>Datum</th>
                                <th>Naziv restorana</th>
                                <th>Komentar</th>
                                <th>Ocena</th>
                                <th>U zvezdicama</th>
                            </tr>
                            <?php
                            require 'dbconnection.php';
                            $result= mysqli_query($con, "select r.id, r.datum_i_vreme, r.id_restorana, res.naziv, k.komentar, k.ocena, r.pojavljivanje from rezervacije r join restorani res on r.id_restorana=res.id left join komentari k on r.id=k.id_rezervacije where r.gost='$gost' and r.datum_i_vreme<=NOW() order by r.datum_i_vreme desc");
                            while($row= mysqli_fetch_assoc($result)){
                                ?>
                            <tr>
                                <td><?php echo $row['datum_i_vreme'] ?></td>
                                <td><?php echo $row['naziv'] ?></td>
                                <?php
                                if(!empty($row['komentar'])){
                                    ?>
                                    <td><?php echo $row['komentar'] ?></td>
                                <?php
                                }
                                if(!empty($row['ocena'])){
                                    ?>
                                    <td><?php echo $row['ocena'] ?></td>
                                    <td><?php echo zvezdice($row['ocena']) ?></td>
                                <?php
                                }
                                if(empty($row['komentar']) && empty($row['ocena']) && $row['pojavljivanje'] == 'da'){
                                    ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <form method="post" action="">
                                        <td>
                                            <input class="btn btn-light btn-sm" type="submit" name="dodaj" value="Dodaj komentar">
                                            <input type="hidden" name="id_rezervacije" value="<?php echo $row['id'] ?>">
                                            <input type="hidden" name="id_restorana" value="<?php echo $row['id_restorana'] ?>">
                                        </td>
                                    </form>
                                <?php    
                                }
                                ?>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <?php
                        if(isset($_POST['dodaj'])){
                            $id_rezervacije=$_POST['id_rezervacije'];
                            $id_restorana=$_POST['id_restorana'];
                            ?>
                        
                        <form method="get" action="">
                            Komentarisite i ocenite iskustvo:
                            <br>
                            <textarea name="komentar" rows="2" cols="30" placeholder="Vas komentar"></textarea>
                            <br>
                            Ocena:
                            <div class="star-rating">
                                <input type="radio" name="rating" id="rating-5" value="5"><label for="rating-5">&#9733;</label>
                                <input type="radio" name="rating" id="rating-4" value="4"><label for="rating-4">&#9733;</label>
                                <input type="radio" name="rating" id="rating-3" value="3"><label for="rating-3">&#9733;</label>
                                <input type="radio" name="rating" id="rating-2" value="2"><label for="rating-2">&#9733;</label>
                                <input type="radio" name="rating" id="rating-1" value="1"><label for="rating-1">&#9733;</label>
                            </div>
                            <br>
                            <input class="btn btn-light btn-sm" type="submit" name="potvrdi" value="Potvrdi">
                            <input type="hidden" name="id_rezervacije" value="<?php echo $id_rezervacije ?>">
                            <input type="hidden" name="id_restorana" value="<?php echo $id_restorana ?>">
                        </form>
                        <?php
                        }
                        if(isset($_GET['potvrdi'])){
                            require 'dbconnection.php';
                            $ocena=$_GET['rating'];
                            $komentar=$_GET['komentar'];
                            $id_restorana=$_GET['id_restorana'];
                            $id_rezervacije=$_GET['id_rezervacije'];
                            $gost=$_COOKIE['ulogovan'];
                            
                            mysqli_query($con, "insert into komentari (id_restorana, id_rezervacije, gost, komentar, ocena) values ('$id_restorana', '$id_rezervacije', '$gost','$komentar','$ocena')");
                           
                            $result = mysqli_query($con, "select avg(ocena) as prosecna_ocena from komentari where id_restorana = '$id_restorana'");
                            $row = mysqli_fetch_assoc($result);
                            $nova_prosecna_ocena = $row['prosecna_ocena'];
                            mysqli_query($con, "update restorani set ocena = '$nova_prosecna_ocena' where id = '$id_restorana'");

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
