<!DOCTYPE html>
<html>
<head>
	<title>TechHead Assignment2</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="1.css">
</head>

<body>

<div class="form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	Name: <input type="text" name="name">
	Roll number: <input type="text" name="roll">
	<input type="submit" name="submit">
	<input type="submit" name="button" value="Clear All Data">
</form>
</div>

<div class="status">
	<?php 
		$user = "root";
		$pass = "";
		$server = "localhost";
		$db = "TH Assignment";
		$conn = new mysqli($server,$user,$pass,$db);
	?>

	<div class="Connection">
		<?php 
		echo "\r\n SQL Connection Status: ";

		if ($conn->connect_error){
			die(nl2br("Connection failed: ".$conn->connect_error)."\r\n");
		}
		else echo nl2br("Connected "."\r\n");
		?>
	</div>
	<div class="Delete">
	<?php 
	if (isset($_POST["button"])){
		$randomName = "DELETE FROM Table1;";
		if ( $conn-> query($randomName) === true){
			echo nl2br("Deleted Successfully \r\n");
		}
		else {
			echo nl2br("Error: ".$conn->error."\r\n");
		}
	}
	?>
</div>
	<div class="Update">
		<?php
	if (isset($_POST["name"]) && isset($_POST["roll"])){
		$name = $_POST["name"];
		$roll = $_POST["roll"];

		if ($name != "" and $roll != ""){
			$query = "INSERT INTO Table1 ( Name , rollNumber ) VALUES ('$name', '$roll');";
			if ( $conn-> query($query) === true){
				echo nl2br($name." Updated Successfully \r\n");
			}
			else {
				echo nl2br("Error: ".$conn->error."\r\n");
			}
		}
	}
	?>
	</div>
</div>

<div class="table">
<table>
	<td>Serial Number</th>
	<th>Name</th>
	<th>Roll number</th>
	<?php
	$GLOBALS['count'] = 1;
	$result = $conn->query("SELECT name , rollNumber FROM Table1");
	function createTable($result) {
    $table = '<table><tr>';
    while ($rows = mysqli_fetch_assoc($result)) {
    $table .= '<tr>';
    $table .= '<td>'.$GLOBALS['count'].'</td>';
    $GLOBALS['count'] += 1;
    foreach ($rows as $row) $table .= '<td>'.$row.'</td>';
    $table .= '</tr>';
    }
    return $table; 
}
echo createTable($result);
?>
</table>
</div>

</body>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</html>