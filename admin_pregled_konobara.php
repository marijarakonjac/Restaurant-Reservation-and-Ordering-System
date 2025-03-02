<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>        <link rel="stylesheet" type="text/css" href="stil.css">
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
                    <h3>Lista konobara</h3>
                    <table>
                        <tr>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Restoran</th>
                            <th>Pol</th>
                            <th>Bezbednosno pitanje</th>
                            <th>Odgovor</th>
                            <th>Adresa</th>
                            <th>Telefon</th>
                            <th>I-mejl</th>
                            <th>Slika</th>
                            <th>Azuriranje</th>
                            <th>Deaktiviranje</th>
                        </tr>
                        <?php
                        require 'dbconnection.php';
                        
                        $result= mysqli_query($con, "select * from konobari");
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){
                                ?>
                        <tr>
                            <td><?php echo $row['ime'] ?></td>
                            <td><?php echo $row['prezime'] ?></td>
                            <td>
                                <?php
                                $id=$row['id_restorana'];
                                $result_restoran= mysqli_query($con, "select naziv from restorani where id='$id'");
                                $row_restoran= mysqli_fetch_assoc($result_restoran);
                                echo $row_restoran['naziv'];
                                ?>
                            </td>
                            <td><?php echo $row['pol'] ?></td>
                            <td><?php echo $row['bez_pitanje'] ?></td>
                            <td><?php echo $row['bez_odgovor'] ?></td>
                            <td><?php echo $row['adresa'] ?></td>
                            <td><?php echo $row['telefon'] ?></td>
                            <td><?php echo $row['mejl'] ?></td>
                            <td><img src="<?php echo htmlspecialchars($row['slika']); ?>" alt="Slika" style="width: 50px; height: auto;"></td>
                            <td>
                                <a href="admin_azuriranje_konobara.php?kor_ime=<?php echo $row['kor_ime']?>">
                                    <input type="button" class="btn btn-light btn-sm" value="Azuriraj">
                                </a>
                            </td>
                        <form method="post" action="">
                            <td><input type="submit" class="btn btn-light btn-sm" name="deaktiviraj" value="Deaktiviraj"></td>
                            <input type="hidden" name="konobar" value="<?php echo $row['kor_ime'] ?>"
                        </form>
                        </tr>
                        <?php
                            }
                        }
                        
                        mysqli_close($con);
                        ?>
                    </table>
                    <a href="admin_dodavanje_konobara.php">
                        <input type="button" class="btn btn-light btn-sm" value="Dodaj novog konobara">
                    </a>
                    <?php
                    
                    if(isset($_POST['azuriraj'])){
                        $konobar=$_POST['konobar'];
                        setcookie('azuriranje',$konobar);
                        header('Location: admin_azuriranje_konobara.php');
                    }
                    
                    if(isset($_POST['deaktiviraj'])){
                        $konobar=$_POST['konobar'];
                        require 'dbconnection.php';
                        
                        mysqli_query($con, "update konobari set status='deaktiviran' where kor_ime='$konobar'");
                        mysqli_query($con, "update korisnici set status='deaktiviran' where kor_ime='$konobar'");
                        
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
