<!DOCTYPE html>
<html>
<head>
<meta charset = "UTF-8">
</head>
<body>
<?php include 'menu.inc'; ?>
<h1>Ass 2</h1>
<a href= "backup1.php">Backup</a>
<br>

</body>
</html>
<?php
$dsn = 'mysql:host=localhost;dbname=ict3715althealth';
$username = 'root';
$password = 'ndr@123FYO';
$db = new PDO($dsn, $username, $password);

//get all client info
$query = 'SELECT Client_id AS ClientID , concat(C_name, C_surname) AS ClientName
FROM tblclientinfo 
WHERE MONTH(Client_id) = 04 
AND DAY(Client_id) = 28';
$statement2 = $db->prepare($query);
//$statement2->bindValue(':Client_id', $Client_id);
//$statement2->bindValue(':Inv_Date', $Inv_Date);
$statement2->execute();
$rows = $statement2->fetchAll(); 
$statement2->closeCursor();


echo'<br><table>
	<tr>
	<th style="border:solid;">ClientID</th>
	<th style="border:solid;">ClientName</th>
	
	</tr>';
	
	foreach($rows as $row){
		echo"<tr>
		<td style='border:solid;'>".$row['ClientID']."</td>
		<td style='border:solid;'>".$row['ClientName']."</td>
		
		
		</tr>";
	}
	echo'</table>';





//get all invoice info
$query = 'SELECT tblclientinfo.Client_id AS ClientID, concat(C_name,C_surname) AS Client, Inv_Num AS INVOICENUMBER, Inv_Date AS INVOICEDATE
FROM tblclientinfo, tblinv_info 
WHERE tblclientinfo.Client_id = tblinv_info.Client_id 
AND YEAR(Inv_Date) < 2020 
AND Inv_paid = N
ORDER BY Client ASC';
$statement1 = $db->prepare($query);
$statement1->execute();
$rows = $statement1->fetchAll();
$statement1->closeCursor();

echo'<br><table>
	<tr>
	<th style="border:solid;">ClientID</th>
	<th style="border:solid;">Client</th>
	<th style="border:solid;">INVOICEDATE</th>
	<th style="border:solid;">INVOICENUMBER</th>
	</tr>';
	
	foreach($rows as $row){
		echo"<tr>
		<td style='border:solid;'>".$row['ClientID']."</td>
		<td style='border:solid;'>".$row['Client']."</td>
		<td style='border:solid;'>".$row['INVOICENUMBER']."</td>
		<td style='border:solid;'>".$row['INVOICEDATE']."</td>
		</tr>";
	}
	echo'</table>';



//get all invoice item
$query = 'SELECT tblsupplements.Supplement_id AS SUPPLIMENT, concat(tblsupplier_info.Supplier_ID,Contact_person,Supplier_Tel) AS SUPPLIERINFORMATION, Min_levels AS MINLEVELS, Current_Stock_levels AS CURRENTSTOCK 
FROM tblsupplements, tblsupplier_info 
WHERE tblsupplements.Supplier_ID = tblsupplier_info.Supplier_ID 
AND Min_levels < Current_stock_levels 
GROUP BY tblsupplier_info.Supplier_ID';
$statement2 = $db->prepare($query);
$statement2->execute();
$rows = $statement2->fetchAll();
$statement2->closeCursor();

echo'<br><table>
	<tr>
	<th style="border:solid;">SUPPLIMENT</th>
	<th style="border:solid;">SUPPLIERINFORMATION</th>
	<th style="border:solid;">MINLEVELS</th>
	<th style="border:solid;">CURRENTSTOCK</th>
	</tr>';
	
	foreach($rows as $row){
		echo"<tr>
		<td style='border:solid;'>".$row['SUPPLIMENT']."</td>
		<td style='border:solid;'>".$row['SUPPLIERINFORMATION']."</td>
		<td style='border:solid;'>".$row['MINLEVELS']."</td>
		<td style='border:solid;'>".$row['CURRENTSTOCK']."</td>
		</tr>";
	}
	echo'</table>';



//get all reference
$query = 'SELECT concat(ci.Client_id, C_name,C_surname) AS CLIENT, COUNT(*) AS FREQUENCY 
FROM tblclientinfo ci, tblinv_info ii, tblinv_items it, tblsupplements s 
WHERE ci.Client_id = ii.Client_id 
AND ii.Inv_Num = it.Inv_Num AND it.Supplement_id = s.Supplement_id 
AND year(Inv_Date) >= 2018 
AND year(Inv_Date) <= 2019 
GROUP BY S.supplement_id 
ORDER BY Frequency DESC 
LIMIT 10';
$statement3 = $db->prepare($query);
$statement3->execute();
$rows = $statement3->fetchAll();
$statement3->closeCursor();

echo'<br><table>
	<tr>
	<th style="border:solid;">CLIENT</th>
	<th style="border:solid;">FREQUENCY</th>
	</tr>';
	
	foreach($rows as $row){
		echo"<tr>
		<td style='border:solid;'>".$row['CLIENT']."</td>
		<td style='border:solid;'>".$row['FREQUENCY']."</td>
		</tr>";
	}
	echo'</table>';



//get all suppliments
$query = 'SELECT COUNT(*) AS NUMOFPURCHASES, DATE_FORMAT(Inv_Date,%M) AS MONTH 
FROM tblinv_info 
WHERE year(Inv_Date) >= 2012 
GROUP BY MONTH';
$statement4 = $db->prepare($query);
$statement4->execute();
$rows = $statement4->fetchAll();
$statement4->closeCursor();

echo'<br><table>
	<tr>
	<th style="border:solid;">NUMOFPURCHASES</th>
	<th style="border:solid;">MONTH</th>
	</tr>';
	
	foreach($rows as $row){
		echo"<tr>
		<td style='border:solid;'>".$row['NUMOFPURCHASES']."</td>
		<td style='border:solid;'>".$row['MONTH']."</td>
		</tr>";
	}
	echo'</table>';


//get all supplier info
$query = 'SELECT Client_id AS CLIENT, C_Tel_H AS HOME, C_Tel_W AS WORK, C_Tel_C AS CELL, C_Email AS E-MAIL 
FROM tblclientinfo 
WHERE C_Tel_C = " " 
AND C_Email = " "';
$statement2 = $db->prepare($query);
$statement2->execute();
$rows = $statement2->fetchAll();
$statement2->closeCursor();

echo'<br><table>
	<tr>
	<th style="border:solid;">CLIENT</th>
	<th style="border:solid;">HOME</th>
	<th style="border:solid;">WORK</th>
	<th style="border:solid;">CELL</th>
	<th style="border:solid;">E-MAIL</th>
	</tr>';
	
	foreach($rows as $row){
		echo"<tr>
		<td style='border:solid;'>".$row['CLIENT']."</td>
		<td style='border:solid;'>".$row['HOME']."</td>
		<td style='border:solid;'>".$row['WORK']."</td>
		<td style='border:solid;'>".$row['CELL']."</td>
		<td style='border:solid;'>".$row['E-MAIL']."</td>
		</tr>";
	}
	echo'</table>';
?>