<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require 'dbconnection.php';

$naziv=$_POST['naziv'];
$tip=$_POST['tip'];
$adresa=$_POST['adresa'];
$opis=$_POST['opis'];
$kontakt_osoba=$_POST['kontakt'];
$telefon=$_POST['telefon'];
$otvaranje=$_POST['otvaranje'];
$zatvaranje=$_POST['zatvaranje'];
$broj_stolova=$_POST['broj_stolova'];

if(empty($naziv)||empty($tip)||empty($adresa)||empty($opis)||empty($kontakt_osoba)||empty($telefon)||empty($otvaranje)||empty($zatvaranje)||empty($broj_stolova)){
    echo "<span style='color:red'>Niste uneli sva potrebna polja!</span>";
}else{
    mysqli_query($con, "insert into restorani (naziv, adresa, tip, telefon, kontakt_osoba, opis, otvaranje, zatvaranje) values ('$naziv', '$adresa','$tip','$telefon','$kontakt_osoba','$opis','$otvaranje','$zatvaranje')");
    $id_restorana = mysqli_insert_id($con);

    for($i=1;$i<=$broj_stolova;$i++){
        $max=$_POST["sto_".$i."_max"];
        if(!empty($max)){
            mysqli_query($con, "insert into stolovi (id_restorana, broj_osoba) values ('$id_restorana', '$max')");
        }
    }
}

mysqli_close($con);
?>