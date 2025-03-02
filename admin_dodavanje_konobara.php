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
                <div class="menu col-12">
                    <a href="admin_pregled_gosta.php">
                        Pregled gostiju  |
                    </a>
                    <a href="admin_pregled_konobara.php">
                          Pregled konobara  |
                    </a>
                    <a href="admin_pregled_restorana.php">
                          Pregled restorana
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="side col-2"></div>
                <div class="body col-8 full-height">          
                    <form method="get" action="index.php">
                        <input class="btn btn-light btn-sm" type="submit" name="izloguj" value="Izloguj se">
                    </form>
                    <h3>Nalog za novog konobara</h3>
                    <form method="post" action="" enctype="multipart/form-data">
                        Korisnicko ime:<input type="text" name="kor_ime">
                        <br>
                        Lozinka:<input type="password" name="lozinka">
                        <br>
                        Naziv restorana:<input type="text" name="restoran">
                        <br>
                        Bezbednosno pitanje:
                        <br>
                        <textarea id="id" name="bez_pitanje" rows="5" cols="50"></textarea>
                        <br>
                        Odgovor na bezbednosno pitanje:
                        <br>
                        <textarea id="id" name="bez_odgovor" rows="5" cols="50"></textarea>
                        <br>
                        Ime:<input type-="text" name="ime">
                        <br>
                        Prezime: <input type-="text" name="prezime">
                        <br>
                        Pol: <input type="radio" name="pol" value="M">M
                             <input type="radio" name="pol" value="Z">Z 
                        <br>
                        Adresa:<input type="text" name="adresa">
                        <br>
                        Kontakt telefon:<input type="text" name="telefon">
                        <br>
                        I-mejl adresa: <input type="text" name="mejl">
                        <br>
                        Profilna slika:<input type="file" name="slika" id="slika" accept=".jpg, .jpeg, .png">
                        <br>
                        <input class="btn btn-light btn-sm" type="submit" name="registruj" value="Registruj konobara">
                    </form>
                    <?php
                    if(isset($_POST['registruj'])){
                        require 'registruj_konobara.php';
                    }
                    ?>
                    <br/><br><br>
                </div>
                <div class="side col-2"></div>
            </div>
            <div class="row footer">
                <p>&copy; 2024 Kutak dobre hrane. </p>
            </div>
        </div>
    </body>
</html>
