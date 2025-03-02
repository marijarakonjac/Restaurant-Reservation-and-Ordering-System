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
                        <h3>Znate staru lozinku?</h3>
                        Vase korisnicko ime: <input type="text" name="kor_ime">
                        <br>
                        Stara lozinka: <input type="password" name="stara_lozinka">
                        <br>
                        Nova lozinka: <input type="password" name="nova_lozinka">
                        <br>
                        Ponovite novu lozinku: <input type="password" name="nova_ponovo">
                        <br>
                        <input class="btn btn-light btn-sm" type="submit" name="potvrdi" value="Potvrdi">
                        <br><br>
                        <h3>Ne znate staru lozinku?</h3>
                        Unesite korisnicko ime: <input type="text" name="kor_ime2">
                        <br>
                        <input class="btn btn-light btn-sm" type="submit" name="sledece" value="Sledece">
                    </form>
                    <?php
                        if (isset($_POST['potvrdi'])){
                            require 'promeni_staru_lozinku.php';
                        }
                        if (isset($_POST['sledece'])){
                            require 'dbconnection.php';
                            $kor_ime=$_POST['kor_ime2'];
                            $result= mysqli_query($con, "select * from korisnici where kor_ime='$kor_ime'");
                            if(mysqli_num_rows($result)>0){
                                setcookie('menja_lozinku', $kor_ime);
                                mysqli_close($con);
                                header('Location:bezbednosno_pitanje.php');
                            }else{
                                echo "<span style='color:red'>Nepostojece korisnicko ime!</span><br>";
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
