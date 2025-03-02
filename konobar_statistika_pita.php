<?php
require 'dbconnection.php';
$konobar=$_COOKIE['ulogovan'];
$result= mysqli_query($con, "select * from konobari where kor_ime='$konobar'");
$row= mysqli_fetch_assoc($result);
$id_restorana=$row['id_restorana'];

$result= mysqli_query($con, "select konobar, sum(broj_osoba) as broj_gostiju from rezervacije where id_restorana='$id_restorana' and status='potvrdjeno' group by konobar");
$arr=[];
$count=0;
if(mysqli_num_rows($result)>0){
    while($row= mysqli_fetch_assoc($result)){
        $arr[$count]['y']=$row['broj_gostiju'];
        $arr[$count]['label']=$row['konobar'];
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
	title: {
		text: "Raspodela gostiju medju konobarima"
	},
	data: [{
		type: "pie",
		indexLabel: "{label} ({y})",
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