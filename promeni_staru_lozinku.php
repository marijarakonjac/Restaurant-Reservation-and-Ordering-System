<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require 'dbconnection.php';

$kor_ime=$_POST['kor_ime'];
$stara_lozinka=$_POST['stara_lozinka'];
$nova_lozinka=$_POST['nova_lozinka'];
$nova_ponovo=$_POST['nova_ponovo'];
$nova_kript = password_hash($nova_lozinka, PASSWORD_BCRYPT);
$regex_lozinka = '/^(?=[a-zA-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[#?!@$%^&*-]).{6,10}$/';

$result = mysqli_query($con, "select * from korisnici where kor_ime='$kor_ime'");
$row= mysqli_fetch_assoc($result);

if(empty($stara_lozinka)||empty($nova_lozinka)||empty($nova_ponovo)){
    echo "<span style='color:red'>Niste popunili sva potrebna polja!</span>";
}else if(mysqli_num_rows($result)==0){
    echo "<span style='color:red'>Nepostojeci korisnik!</span>";
}else if(!password_verify($stara_lozinka, $row['lozinka'])){
    echo "<span style='color:red'>Nepostojeca stara lozinka!</span><br>";
}else if (!preg_match($regex_lozinka, $nova_lozinka)){
    echo "<span style='color:red'>Uneli ste lozinku u nepravilnom formatu!</span><br>";
}else if(!($nova_ponovo==$nova_lozinka)){
    echo "<span style='color:red'>Niste ponovili ispravno novu lozinku!</span><br>";
}else{
    mysqli_query($con, "update korisnici set lozinka='$nova_kript' where kor_ime='$kor_ime'");
    if($row['tip']=='gost'){
        mysqli_query($con, "update gosti set lozinka='$nova_kript' where kor_ime='$kor_ime'");
    }else if($row['tip']=='konobar'){
        mysqli_query($con, "update konobari set lozinka='$nova_kript' where kor_ime='$kor_ime'");
    }
    mysqli_close($con);
    header("Location: index.php");  
}
mysqli_close($con);
?>