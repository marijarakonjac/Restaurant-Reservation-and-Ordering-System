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

                    <table>
                        <tr>
                            <th>Naziv</th>
                            <th>Cena</th>
                            <th>Sastojci</th>
                            <th>Slika</th>
                        </tr>
                        <?php
                        $id_restorana=$_COOKIE['id_restorana'];

                        require 'dbconnection.php';
                        $result= mysqli_query($con, "select * from jela where id_restorana='$id_restorana'");
                        if(mysqli_num_rows($result)>0){
                            while($row= mysqli_fetch_assoc($result)){
                                ?>
                        <tr>
                            <td><?php echo $row['naziv'] ?></td>
                            <td><?php echo $row['cena'] ?></td>
                            <td><?php echo $row['sastojci'] ?></td>
                            <td><img src="<?php echo htmlspecialchars($row['slika']); ?>" alt="Slika" style="width: 100px; height: auto;"></td>
                            <form method="post" action="">
                                <td><input type="number" name="kolicina"></td>
                                <td><input class="btn btn-light btn-sm" type="submit" name="dodaj" value="Dodaj u korpu"></td>
                                <input type="hidden" name="cena" value="<?php echo $row['cena'] ?>">
                                <input type="hidden" name="id_jela" value="<?php echo $row['id'] ?>">
                            </form>
                        </tr>
                        <?php
                            }
                        }
                        mysqli_close($con);
                        ?>
                        <tr><td>
                        <a href="gost_korpa.php">
                            <input class="btn btn-light btn-sm" type="button" name="korpa" value="Pregled korpe">
                        </a>
                        </td></tr>
                    </table>
                    <?php
                    if(isset($_POST['dodaj'])){
                        if(empty($_POST['kolicina'])){
                            echo "<span style='color:red'>Niste uneli kolicinu!</span>";
                        }else{
                            require 'dbconnection.php';
                            $gost=$_COOKIE['ulogovan'];
                            $kolicina=$_POST['kolicina'];
                            $cena=$_POST['cena'];
                            $id_jela=$_POST['id_jela'];

                            mysqli_query($con, "insert into korpa (id_jela, kolicina, cena, gost) values ('$id_jela','$kolicina','$cena','$gost')");
                            mysqli_close($con);
                        }
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
