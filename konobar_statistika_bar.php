<?php

require 'dbconnection.php';
date_default_timezone_set('Europe/Belgrade');
$konobar=$_COOKIE['ulogovan'];
 
$currentDayOfWeek = date('w');
$startOfWeek = date('Y-m-d', strtotime('-'.$currentDayOfWeek.' days'));

$result= mysqli_query($con, "select dayname(datum_i_vreme) as dan, sum(broj_osoba) as broj_gostiju from rezervacije where konobar='$konobar' and datum_i_vreme>='$startOfWeek' and datum_i_vreme<=curdate() group by dayname(datum_i_vreme)");
$arr=[];
$count=0;
if(mysqli_num_rows($result)>0){
    while($row= mysqli_fetch_assoc($result)){
        $arr[$count]['y']=$row['broj_gostiju'];
        $arr[$count]['label']=$row['dan'];
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
	title:{
		text: "Broj gostiju u ovoj nedelji"
	},
	axisY: {
		title: "Broj gostiju",
		includeZero: true,
	},
	data: [{
		type: "bar",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
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