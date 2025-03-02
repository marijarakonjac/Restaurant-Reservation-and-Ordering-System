<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require 'dbconnection.php';

$kor_ime=$_COOKIE['ulogovan'];
$novo_ime=$_POST['novo_ime'];
$novo_prezime=$_POST['novo_prezime'];
$nova_adresa=$_POST['nova_adresa'];
$novi_mejl=$_POST['novi_mejl'];
$novi_telefon=$_POST['novi_telefon'];

$regex_mejl = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 

if(!empty($novo_ime)){
    mysqli_query($con,"UPDATE konobari SET ime='$novo_ime' WHERE kor_ime='$kor_ime'");
    mysqli_query($con,"UPDATE korisnici SET ime='$novo_ime' WHERE kor_ime='$kor_ime'");
}
if(!empty($novo_prezime)){
    mysqli_query($con,"UPDATE konobari SET prezime='$novo_prezime' WHERE kor_ime='$kor_ime'");
    mysqli_query($con,"UPDATE korisnici SET prezime='$novo_prezime' WHERE kor_ime='$kor_ime'");
}
if(!empty($nova_adresa)){
    mysqli_query($con,"UPDATE konobari SET adresa='$nova_adresa' WHERE kor_ime='$kor_ime'");
    mysqli_query($con,"UPDATE korisnici SET adresa='$nova_adresa' WHERE kor_ime='$kor_ime'");
}
if(!empty($novi_mejl)){
    if(!preg_match($regex_mejl, $novi_mejl)) {
        echo "<span style='color:red'>Uneli ste i-mejl u nepravilnom formatu!</span><br>";
    }else{
        mysqli_query($con,"UPDATE konobari SET mejl='$novi_mejl' WHERE kor_ime='$kor_ime'");
        mysqli_query($con,"UPDATE korisnici SET mejl='$novi_mejl' WHERE kor_ime='$kor_ime'");
    }
}
if(!empty($novi_telefon)){
    mysqli_query($con,"UPDATE konobari SET telefon='$novi_telefon' WHERE kor_ime='$kor_ime'");
    mysqli_query($con,"UPDATE korisnici SET telefon='$novi_telefon' WHERE kor_ime='$kor_ime'");
}
if(isset($_FILES['nova_slika']) && $_FILES['nova_slika']['error'] === UPLOAD_ERR_OK) {
    $putanja = $_FILES['nova_slika']['tmp_name'];
    $naziv = $_FILES['nova_slika']['name'];
    $naziv_niz = explode(".", $naziv);
    $ekstenzija = strtolower(end($naziv_niz));

    $dozvoljene_ekstenzije = array('jpg', 'jpeg', 'png');
    if (in_array($ekstenzija, $dozvoljene_ekstenzije)) {
        list($sirina, $visina) = getimagesize($putanja);
        if ($sirina >= 100 && $visina >= 100 && $sirina <= 300 && $visina <= 300) {
            $nova_putanja = 'slike/' . $kor_ime.'.'.$ekstenzija;
            
            copy($putanja, $nova_putanja);
            mysqli_query($con, "UPDATE konobari SET slika='$nova_putanja' WHERE kor_ime='$kor_ime'");
            mysqli_query($con, "UPDATE korisnici SET slika='$nova_putanja' WHERE kor_ime='$kor_ime'");
        } else {
            echo "<span style='color:red'>Slika mora biti izmedju 100x100 i 300x30110 piksela!</span><br>";
        }
    } else {
        echo "<span style='color:red'>Slika mora biti JPG ili PNG!</span><br>";
    }
}

mysqli_close($con);
?>