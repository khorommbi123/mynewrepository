
<!DOCTYPE html>
<html>
<head>
<meta charset = "UTF-8">
</head>
<body>
<?php include 'menu.inc'; ?>
<h1>Task 1</h1>

 <?php
 ///////////task1///////////
 
//function to calculate hourlyWage
function calculateHourlyWage($hoursworked, $hourlywage = 20){
	$salary = $hoursworked * $hourlywage;
	return $salary;
}
	//function call 
	$hourlywage = 20;
	$hourlyworked = 13;
	echo calculateHourlyWage(35);
	echo '<br>';
	echo calculateHourlyWage(4, 200);
	echo '<br/>';
?>
<br><br>
<iframe src="Task1.txt" height="400" scrolling="yes" width="1200px">
 <p>Your browser does not support iframes.</p>
 </iframe>
</body>
</html>