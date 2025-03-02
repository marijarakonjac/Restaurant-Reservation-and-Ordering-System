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
                    <h3>Novi restoran</h3>
                    <form method="post" action="" enctype="multipart/form-data">
                        Naziv:<input type="text" name="naziv">
                        <br>
                        Tip:<input type="text" name="tip">
                        <br>
                        Adresa:<input type="text" name="adresa">
                        <br>
                        Kratak opis:
                        <br>
                        <textarea id="id" name="opis" rows="5" cols="50"></textarea>
                        <br>
                        Kontakt osoba:<input type-="text" name="kontakt">
                        <br>
                        Broj telefona:<input type="text" name="telefon">
                        <br>
                        Radno vreme kuhinje:
                        <br>
                        od: <input type="time" name="otvaranje">
                        <br>
                        do: <input type="time" name="zatvaranje">
                        <br>
                        Broj stolova:<input type="number" name="broj_stolova" id="broj_stolova" onchange="generisiTabelu()"><br>
                        <div id="tabela"></div>
                        <br>
                        <input class="btn btn-light btn-sm" type="submit" name="registruj" value="Registruj restoran">
                    </form>
                    <?php
                    if(isset($_POST['registruj'])){
                        require 'registruj_restoran.php';
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
        <script>
            function generisiTabelu() {
                const brojStolova = document.getElementById('broj_stolova').value;
                let tabela = document.getElementById('tabela');
                tabela.innerHTML = '';
                for (let i = 1; i <= brojStolova; i++) {
                    tabela.innerHTML += `Sto ${i}: Maksimalan broj ljudi: <input type="number" name="sto_${i}_max"><br>`;
                }
            }
        </script>
    </body>
</html>
