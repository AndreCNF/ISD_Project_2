<html>
	<body>
		<h1><a href = "http://web.tecnico.ulisboa.pt/ist181579/sibd/proj/HomePage.php" style="color:MediumSeaGreen;text-decoration: none;">Vetpital</a></h1>
		<form action="ResultSearch.php" method="post">
			<h3>Please introduce the following informations</h3>
			<p>Animal name: </p>
			<input type="text" name="animal_name"/>
			<p>Owner name: </p> 
			<input type="text" name="owner_name"/>
			<p>Client VAT: 
				<select name="client_vat">
<?php
		# Establishing the connection with the database
		$host = "db.tecnico.ulisboa.pt";
		$user = "ist181579";
		$pass = "utfv5127";
		$dsn = "mysql:host=$host;dbname=$user";
		try
		{
			$connection = new PDO($dsn, $user, $pass);
		}
		catch(PDOException $exception)
		{
			echo("<p>Error: ");
			echo($exception->getMessage());
			echo("</p>");
			exit();
		}
		
		# Get the existent clients VAT
		$sql = "SELECT VAT FROM client ORDER BY VAT";
		$result = $connection->query($sql);
		if ($result == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error: {$info[2]}</p>");
			exit();
		}
		foreach($result as $row)
		{
			$client_vat = $row['VAT'];
			echo("<option value=\"$client_vat\">$client_vat</option>");
		}
	$connection = null;
?>
				</select>
			</p>
			<p><input type="submit" value="Search"/></p>
		</form>
		<form action="new_client.php" method="post">
			<p><input type="submit" value="Register new client"/></p>
			<input type="hidden" value="Search.php" name="from"/>
		</form>
	</body>
</html>
