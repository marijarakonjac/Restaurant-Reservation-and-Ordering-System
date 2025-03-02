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
                    <br/>            
                    <form method="post" action="">
                        Korisnicko ime: <input type-="text" name="kor_ime">
                        <br>
                        Lozinka: <input type="password" name="lozinka">
                        <br>
                        <input class="btn btn-light btn-sm" type="submit" name="prijava" value="Prijava">
                    </form>
                    <?php
                    if(isset($_POST['prijava'])){
                        $kor_ime=$_POST['kor_ime'];
                        $lozinka=$_POST['lozinka'];
                        if(empty($kor_ime)||empty($lozinka)){
                            echo "<span style='color:red'>Niste uneli sva potrebna polja!</span>";
                        }else{
                            require 'dbconnection.php';

                            $result= mysqli_query($con, "select * from korisnici where kor_ime='$kor_ime'");
                            if(mysqli_num_rows($result)>0){
                                $row= mysqli_fetch_assoc($result);
                                if($lozinka==$row['lozinka']){
                                    setcookie('ulogovan', $row['kor_ime']);
                                    mysqli_close($con);
                                    header('Location: admin_pregled_gosta.php');
                                }else{
                                    echo "<span style='color:red'>Netacna lozinka!</span>";
                                }
                            }else{
                                echo "<span style='color:red'>Nepostojeci admin</span>";
                            }
                            mysqli_close($con);
                        }
                    }
                    ?>
                <br/><br/><br/><br/>
                </div>
                <div class="side col-2"></div>
            </div>
            <div class="row footer">
                <p>&copy; 2024 Kutak dobre hrane. </p>
            </div>
        </div>
    </body>
</html>
