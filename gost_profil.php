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
                    <form method="post" action="" enctype="multipart/form-data">
                        <h3>Vas profil</h3>
                        <?php
                        require 'dbconnection.php';
                        $kor_ime=$_COOKIE['ulogovan'];
                        $result= mysqli_query($con, "select * from gosti where kor_ime='$kor_ime'");
                        $row= mysqli_fetch_assoc($result);
                        ?><table>
                            <tr>
                                <td>Ime:</td>
                                <td><?php echo $row['ime'] ?></td>
                                <td><input type="text" name="novo_ime" placeholder="Novo ime"></td>
                            </tr>
                            <tr>
                                <td>Prezime:</td>
                                <td><?php echo $row['prezime'] ?></td>
                                <td><input type="text" name="novo_prezime" placeholder="Novo prezime"></td>
                            </tr>
                            <tr>
                                <td>Adresa:</td>
                                <td><?php echo $row['adresa'] ?></td>
                                <td><input type="text" name="nova_adresa" placeholder="Nova adresa"></td>
                            </tr>
                            <tr>
                                <td>I-mejl:</td>
                                <td><?php echo $row['mejl'] ?></td>
                                <td><input type="text" name="novi_mejl" placeholder="Novi i-mejl"></td>
                            </tr>
                            <tr>
                                <td>Kontakt telefon:</td>
                                <td><?php echo $row['telefon'] ?></td>
                                <td><input type="text" name="novi_telefon" placeholder="Novi kontakt telefon"></td>
                            </tr>
                            <tr>
                                <td>Broj kreditne kartice:</td>
                                <td><?php echo $row['kartica'] ?></td>
                                <td><input type="text" name="nova_kartica" placeholder="Novi broj kreditne kartice"></td>
                            </tr>
                            <tr>
                                <td>Slika:</td>
                                <td><img src="<?php echo htmlspecialchars($row['slika']); ?>" alt="Slika"></td>
                                <td><input type="file" name="nova_slika" id="nova_slika" accept="image/jpeg, image/png"></td>
                            </tr>
                            <tr>
                                <td><input class="btn btn-light btn-sm" type="submit" name="azuriraj" value="Azuriraj podatke"></td>
                            </tr>
                        </table>
                    </form>
                    <?php
                        if(isset($_POST['azuriraj'])){
                            require 'gost_azuriranje_podataka.php';
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
