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
                <div class="side col-2"></div>
                <div class="body col-8 full-height">
                    <form method="get" action="index.php">
                        <input class="btn btn-light btn-sm" type="submit" name="pocetna" value="Pocetna">
                    </form>
                    <br>
                    <form method="post" action="">
                        Nova lozinka: <input type="password" name="nova_lozinka">
                        <br>
                        Ponovite novu lozinku: <input type="password" name="nova_ponovo">
                        <br>
                        <input class="btn btn-light btn-sm" type="submit" name="potvrdi" value="Potvrdi">
                    </form>
                    <?php
                    if(isset($_POST['potvrdi'])){
                        require 'dbconnection.php';

                        $kor_ime=$_COOKIE['menja_lozinku'];
                        $nova_lozinka=$_POST['nova_lozinka'];
                        $nova_ponovo=$_POST['nova_ponovo'];
                        $nova_kript = password_hash($nova_lozinka, PASSWORD_BCRYPT);
                        $regex_lozinka = '/^(?=[a-zA-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[#?!@$%^&*-]).{6,10}$/';

                        $result = mysqli_query($con, "select * from korisnici where kor_ime='$kor_ime'");
                        $row= mysqli_fetch_assoc($result);

                        if(empty($nova_lozinka)||empty($nova_ponovo)){
                            echo "<span style='color:red'>Niste popunili sva potrebna polja!</span>";
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
