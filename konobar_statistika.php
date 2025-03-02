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
                    <a href="konobar_profil.php">
                        Profil  |
                    </a>
                    <a href="konobar_rezervacije.php">
                          Rezervacije  |
                    </a>
                    <a href="konobar_dostave.php">
                          Dostave  |
                    </a>
                    <a href="konobar_statistika.php">
                          Statistika
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
                    <div class="button-row">
                        <a class="btn btn-light btn-sm restoran-link" href="konobar_statistika_bar.php" target="chartIframe">Bar dijagram</a>
                        <a class="btn btn-light btn-sm restoran-link" href="konobar_statistika_pita.php" target="chartIframe">Pie dijagram</a>
                        <a class="btn btn-light btn-sm restoran-link" href="konobar_statistika_histogram.php" target="chartIframe">Histogram</a>
                    </div>
                    <div>
                        <iframe name="chartIframe" src="konobar_statistika_bar.php" width="100%" height="400px" scrolling="auto"></iframe>
                    </div>
                </div>
                <div class="side col-2"></div>
            </div>
            <div class="row footer">
                <p>&copy; 2024 Kutak dobre hrane. </p>
            </div>
        </div>
    </body>
</html>
