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
                    
                    <?php
                    require 'dbconnection.php';
                    
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        setcookie('id_restorana',$id);
                        $result = mysqli_query($con, "SELECT * FROM restorani WHERE id = '$id'");
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <form method="post" action="">
                        <h3>Detalji i rezervacija</h3>
                        <table>
                            <tr>
                                <td>Naziv:  </td>
                                <td><?php echo $row['naziv'] ?></td>
                            </tr>
                            <tr>
                                <td>Adresa: </td>
                                <td><?php echo $row['adresa'] ?></td>
                            </tr>
                            <tr>
                                <td>Tip:    </td>
                                <td><?php echo $row['tip'] ?></td>
                            </tr>
                            <tr>
                                <td>Telefon:    </td>
                                <td><?php echo $row['telefon'] ?></td>
                            </tr>
                            <tr>
                                <td>Komentari:  </td>
                                <td>
                                <?php
                                $id_restorana=$row['id'];
                                $result2 = mysqli_query($con, "SELECT * FROM komentari WHERE id_restorana = '$id_restorana'");
                                if(mysqli_num_rows($result2)>0){
                                    while($row2= mysqli_fetch_assoc($result2)){
                                    echo $row2['gost'].': '.$row2['komentar'].'<br>';
                                    }
                                }
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Mapa:   </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="gost_jelovnik.php">
                                    <input class="btn btn-light btn-sm" type="button" name="jelovnik" value="Pogledaj jelovnik">
                                    </a>
                                </td>
                            </tr>
                            <br>
                            <tr>
                                <th>Napravite rezervaciju:</th>
                            </tr>
                            <tr>
                                <td>Datum i vreme: </td>
                                <td><input type="date" name="datum"><input type="time" name="vreme"></td>
                            </tr>
                            <tr>
                                <td>Broj osoba: </td>
                                <td><input type="number" name="broj_osoba"></td>
                            </tr>
                            <tr>
                                <td>Dodatni zahtev: </td>
                                <td><textarea id="zahtev" name="zahtev" rows="5" cols="50"></textarea></td>
                            </tr>
                            <tr>
                                <td><input class="btn btn-light btn-sm" type="submit" name="rezervisi" value="Rezervisi"></td>
                            </tr>
                            <input type="hidden" name="id_restorana" value="<?php echo $row['id']; ?>">
                        </table>
                    </form>
                    <?php
                    mysqli_close($con);
                    }
                    if(isset($_POST['rezervisi'])){
                        require 'napravi_rezervaciju.php';
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
