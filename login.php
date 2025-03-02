<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require 'dbconnection.php';

$result= mysqli_query($con, "select * from korisnici where kor_ime='$kor_ime'");

if(mysqli_num_rows($result)>0){
    $row= mysqli_fetch_assoc($result);
    $lozinka_kript = $row['lozinka'];
    if($row['tip']=='admin'){
        echo "<span style='color:red'>Admin ne moze da se prijavi putem ove forme.</span>";
    }else{
        if($row['tip']=='gost'){
            $result_status= mysqli_query($con, "select status from gosti where kor_ime='$kor_ime'");
            $row_status= mysqli_fetch_assoc($result_status);
        }else{
            $result_status= mysqli_query($con, "select status from konobari where kor_ime='$kor_ime'");
            $row_status= mysqli_fetch_assoc($result_status);
        }
        $status=$row_status['status'];

        if($status=='deaktiviran'){
            echo "<span style='color:red'>Vas nalog je deaktiviran.</span>";
        }else if($status=='odbijen'){
            echo "<span style='color:red'>Vasa registracija je odbijena.</span>";
        }else if($status=='blokiran'){
            echo "<span style='color:red'>Vas nalog je blokiran.</span>";
        }else if($status=='cekanje'){
            echo "<span style='color:red'>Vasa registracija ceka na odobrenje.</span>";
        }else{
            if($row['tip']=='gost'){
                if(password_verify($lozinka, $lozinka_kript)){
                    setcookie('ulogovan', $row['kor_ime']);
                    header('Location: gost_profil.php');
                }else{
                    echo "<span style='color:red'>Netacna lozinka!</span>";
                }
            }else if($row['tip']=='konobar'){
                if(password_verify($lozinka, $lozinka_kript)){
                    setcookie('ulogovan', $row['kor_ime']);
                    header('Location: konobar_profil.php');
                }else{
                    echo "<span style='color:red'>Netacna lozinka!</span>";
                }
            }
        }
    }
}else{
    echo "<span style='color:red'>Nepostojeci korisnik</span>";
}
mysqli_close($con);
?>