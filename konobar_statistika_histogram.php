<?php
$dani = [
    1 => 'Nedelja',
    2 => 'Ponedeljak',
    3 => 'Utorak',
    4 => 'Sreda',
    5 => 'Četvrtak',
    6 => 'Petak',
    7 => 'Subota'
];

require 'dbconnection.php';
date_default_timezone_set('Europe/Belgrade');
$konobar=$_COOKIE['ulogovan'];
$result= mysqli_query($con, "select * from konobari where kor_ime='$konobar'");
$row= mysqli_fetch_assoc($result);
$id_restorana=$row['id_restorana'];

$result= mysqli_query($con, "select dayofweek(datum_i_vreme) as dan, count(*) as broj_rezervacija from rezervacije where id_restorana='$id_restorana' and datum_i_vreme>=DATE_SUB(CURDATE(), INTERVAL 24 MONTH) group by dayofweek(datum_i_vreme)");
$arr=[];
$count=0;
if(mysqli_num_rows($result)>0){
    while($row= mysqli_fetch_assoc($result)){
        $arr[$count]['y']=$row['broj_rezervacija'];
        $broj_dana = $row['dan'];
        $arr[$count]['label']=$dani[$broj_dana];
        $count=$count+1;
    }
}

mysqli_close($con);
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Prosecan broj rezervacija po danima u poslednja 24 meseca"
	},
	axisY: {
		title: "Broj rezervacija"
	},
	data: [{
		type: "column",
		dataPoints: <?php echo json_encode($arr, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>         