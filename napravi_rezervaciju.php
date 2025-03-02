<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
date_default_timezone_set('Europe/Belgrade'); 
require 'dbconnection.php';

$gost=$_COOKIE['ulogovan'];
$broj_osoba=$_POST['broj_osoba'];
$datum=$_POST['datum'];
$vreme=$_POST['vreme'];
$zahtev=$_POST['zahtev'];
$id_restorana=$_POST['id_restorana'];

$datum_vreme = $datum . ' ' . $vreme;
$rezervacija_timestamp = strtotime($datum_vreme);
$trenutno_timestamp = time();

if(!(empty($datum)||empty($vreme)||empty($broj_osoba))){
    if ($rezervacija_timestamp > $trenutno_timestamp) {

        $result= mysqli_query($con, "select otvaranje, zatvaranje from restorani where id='$id_restorana'");
        $row= mysqli_fetch_assoc($result);
        $otvaranje_timestamp = strtotime($datum . ' ' . $row['otvaranje']);
        $zatvaranje_kraj_timestamp = strtotime($datum . ' ' . $row['zatvaranje']);
        $rezervacija_kraj_timestamp = $rezervacija_timestamp + (3 * 60 * 60);

        if($rezervacija_timestamp >= $otvaranje_timestamp && $rezervacija_kraj_timestamp <= $zatvaranje_kraj_timestamp){
            $result_sto= mysqli_query($con, "select * from stolovi where id_restorana='$id_restorana' and broj_osoba >= '$broj_osoba'");
            if(mysqli_num_rows($result_sto)>0){
                $sto_slobodan = false;
                while ($row_sto = mysqli_fetch_assoc($result_sto)) {
                    $sto_id = $row_sto['id'];

                    $result_rezervacije = mysqli_query($con, "SELECT * FROM rezervacije WHERE id_stola='$sto_id' AND (
                        (datum_i_vreme <= FROM_UNIXTIME('$rezervacija_timestamp') AND DATE_ADD(datum_i_vreme, INTERVAL IF(produzavanje = 1, 4, 3) HOUR) > FROM_UNIXTIME('$rezervacija_timestamp'))
                        OR
                        (datum_i_vreme >= FROM_UNIXTIME('$rezervacija_timestamp') AND datum_i_vreme < DATE_ADD(FROM_UNIXTIME('$rezervacija_timestamp'), INTERVAL IF(produzavanje = 1, 4, 3) HOUR))
                    )");

                    if (mysqli_num_rows($result_rezervacije) == 0) {
                        $sto_slobodan = true;
                        break;
                    }
                }
                if ($sto_slobodan) {
                    mysqli_query($con, "INSERT INTO rezervacije (id_restorana, gost, broj_osoba, datum_i_vreme, dodatni_zahtev, id_stola, status) VALUES ('$id_restorana', '$gost', '$broj_osoba', FROM_UNIXTIME('$rezervacija_timestamp'), '$zahtev', '$sto_id','cekanje')") ;
                    echo "Uspesna rezervacija!";
                    
                } else {
                    echo "<span style='color:red'>Nema slobodnog stola sa traženim kapacitetom u datom vremenu.</span><br>";
                }
            }else{
                echo "<span style='color:red'>Ne postoji sto za trazeni broj osoba!</span><br>";
            }
        }else{
            echo "<span style='color:red'>Vreme rezervacije je van radnog vremena kuhinje restorana!</span><br>";
        }
    }else{
        echo "<span style='color:red'>Vreme rezervacije ne moze biti u proslosti!</span><br>";
    }
}else{
    echo "<span style='color:red'>Niste uneli sve potrebne podatke!</span><br>";
}

mysqli_close($con);
?>