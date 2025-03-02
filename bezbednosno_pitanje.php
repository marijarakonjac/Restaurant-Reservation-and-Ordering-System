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
                        Bezbednosno pitanje:
                        <br>
                        <?php
                        require 'dbconnection.php';

                        $kor_ime=$_COOKIE['menja_lozinku'];
                        $result= mysqli_query($con, "select * from korisnici where kor_ime='$kor_ime'");
                        if(mysqli_num_rows($result)>0){
                            $row= mysqli_fetch_assoc($result);
                            $pitanje=$row['bez_pitanje'];
                            echo $pitanje;
                        }
                        ?>
                        <br>
                        Odgovor:
                        <br>
                        <input type="text" name="odgovor">
                        <br>
                        <input class="btn btn-light btn-sm" type="submit" name="potvrdi" value="Potvrdi">
                    </form>
                    <?php
                        if(isset($_POST['potvrdi'])){
                            $odgovor_baza=$row['bez_odgovor'];
                            $odgovor=$_POST['odgovor'];
                            if($odgovor==$odgovor_baza){
                                mysqli_close($con);
                                header('Location:postavi_novu_lozinku.php');
                            }else{
                                echo "<span style='color:red'>Netacan odgovor!</span><br>";
                            }
                        }
                        mysqli_close($con);
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
