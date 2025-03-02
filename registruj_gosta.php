<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require 'dbconnection.php';

$kor_ime=$_POST['kor_ime'];
$lozinka=$_POST['lozinka'];
$bez_pitanje = $_POST['bez_pitanje'];
$bez_odgovor = $_POST['bez_odgovor'];
$ime=$_POST['ime'];
$prezime=$_POST['prezime'];
$adresa=$_POST['adresa'];
$telefon=$_POST['telefon'];
$mejl=$_POST['mejl'];
$kartica=$_POST['kartica'];
if(isset($_POST['pol'])){
    $pol=$_POST['pol'];
}else{
    $pol="";
}
$lozinka_kript =password_hash($lozinka, PASSWORD_BCRYPT);

$regex_mejl = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
$regex_lozinka = '/^(?=[a-zA-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[#?!@$%^&*-]).{6,10}$/';
$regex_kartica = '/^[0-9]{16}$/';

$postojece_ime=0;
$result= mysqli_query($con, "select * from gosti where kor_ime='$kor_ime'");
if(mysqli_num_rows($result)>0){
    $postojece_ime=1;
}
$postojeci_mejl=0;
$result= mysqli_query($con, "select * from gosti where mejl='$mejl'");
if(mysqli_num_rows($result)>0){
    $postojeci_mejl=1;
}

if(empty($kor_ime)||empty($lozinka)||empty($bez_pitanje)||empty($bez_odgovor)||empty($ime)||empty($prezime)||empty($pol)
        ||empty($adresa)||empty($telefon)||empty($mejl)||empty($kartica)){
        echo "<span style='color:red'>Niste uneli sva potrebna polja!</span>";
}
else if(!preg_match($regex_mejl, $mejl)) {
    echo "<span style='color:red'>Uneli ste i-mejl u nepravilnom formatu!</span><br>";
}
else if (!preg_match($regex_lozinka, $lozinka)) {
    echo "<span style='color:red'>Uneli ste lozinku u nepravilnom formatu!</span><br>";
}         
else if (!preg_match($regex_kartica, $kartica)) {
    echo "<span style='color:red'>Uneli ste broj kartice u nepravilnom formatu!</span><br>";
}
else if($postojece_ime){
    echo "<span style='color:red'>Vec postoji gost sa unetim korisnickim imenom!</span><br>";
}
else if($postojeci_mejl){
    echo "<span style='color:red'>Vec postoji gost sa unetom mejl adresom!</span><br>";
}
else if(isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
    $putanja = $_FILES['slika']['tmp_name'];
    $naziv = $_FILES['slika']['name'];
    $naziv_niz = explode(".", $naziv);
    $ekstenzija = strtolower(end($naziv_niz));

    $dozvoljene_ekstenzije = array('jpg', 'jpeg', 'png');
    if (in_array($ekstenzija, $dozvoljene_ekstenzije)) {
        list($sirina, $visina) = getimagesize($putanja);
        if ($sirina >= 100 && $visina >= 100 && $sirina <= 300 && $visina <= 300) {
            $nova_putanja = 'slike/' . $kor_ime.'.'.$ekstenzija;

            if(copy($putanja, $nova_putanja)) {
                $profilna_slika = $nova_putanja;
                mysqli_query($con, "insert into korisnici (kor_ime, lozinka, ime, prezime, pol, tip, bez_pitanje, bez_odgovor, adresa, telefon, mejl, slika) values ('$kor_ime','$lozinka_kript','$ime','$prezime','$pol','gost','$bez_pitanje','$bez_odgovor','$adresa','$telefon','$mejl','$profilna_slika')");
                mysqli_query($con, "insert into gosti (kor_ime, lozinka, ime, prezime, pol, bez_pitanje, bez_odgovor, adresa, telefon, kartica, mejl, slika, status) values ('$kor_ime','$lozinka_kript','$ime','$prezime','$pol','$bez_pitanje','$bez_odgovor','$adresa','$telefon','$kartica','$mejl','$profilna_slika','cekanje')");
            } else {
                echo "<span style='color:red'>Greska prilikom kopiranja slike!</span><br>";
            }
        } else {
            echo "<span style='color:red'>Slika mora biti izmedju 100x100 i 300x30110 piksela!</span><br>";
        }
    } else {
        echo "<span style='color:red'>Slika mora biti JPG ili PNG!</span><br>";
    }
} else {
    $profilna_slika = 'slike/podrazumevana.jpg';
    mysqli_query($con, "insert into korisnici (kor_ime, lozinka, ime, prezime, pol, tip, bez_pitanje, bez_odgovor, adresa, telefon, mejl, slika) values ('$kor_ime','$lozinka_kript','$ime','$prezime','$pol','gost','$bez_pitanje','$bez_odgovor','$adresa','$telefon','$mejl','$profilna_slika')");
    mysqli_query($con, "insert into gosti (kor_ime, lozinka, ime, prezime, pol, bez_pitanje, bez_odgovor, adresa, telefon, kartica, mejl, slika, status) values ('$kor_ime','$lozinka_kript','$ime','$prezime','$pol','$bez_pitanje','$bez_odgovor','$adresa','$telefon','$kartica','$mejl','$profilna_slika','cekanje')");
}
mysqli_close($con);
?>